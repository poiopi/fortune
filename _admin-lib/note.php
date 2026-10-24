<?php
declare(strict_types=1);

/**
 * _admin-lib/note.php
 *
 * note の投稿支援（ADMIN_STAGE2_PROPOSAL.md 3-5、ADMIN_FULLSPEC_PROPOSAL.md F12）。
 * note には公式の投稿APIが無いため、投稿は手動。管理画面は本文のコピー・投稿URLの記録・RSSからの自動記録を受け持つ。
 *   - 記録先は note_posts（1行＝noteに出した記事1本）。「今日」の目標の note はこの表の posted_on で数える
 *   - 今日の note 枠（post_queue の platform='note'）に結び付けたときは queue_id を入れる
 *   - RSS：noteのヘルプはクリエイターページから RSS を取得できると案内している。URL は https://note.com/<ID>/rss（2026-10-24 実測で HTTP 200・RSS 2.0）
 * 設定キー：note_user_id（ID。未設定なら config の note_username、'' なら note は使わない）／note_rss_checked_at／note_rss_error
 */

const ADMIN_NOTE_ORIGIN = 'https://note.com';
/** RSS から拾う記事の古さの上限（日）。日付をまたいだ直後の取得でも前日の分を取りこぼさないため2日 */
const ADMIN_NOTE_RSS_DAYS = 2;
const ADMIN_NOTE_ID_PATTERN = '/^[A-Za-z0-9_]{1,50}$/';

/** note のID。使わない設定（空）なら null */
function admin_note_user_id(): ?string
{
    $id = admin_setting('note_user_id') ?? (string) (admin_config()['note_username'] ?? '');
    return $id !== '' && preg_match(ADMIN_NOTE_ID_PATTERN, $id) === 1 ? $id : null;
}

function admin_note_enabled(): bool
{
    return admin_note_user_id() !== null;
}

function admin_note_profile_url(): ?string
{
    $id = admin_note_user_id();
    return $id === null ? null : ADMIN_NOTE_ORIGIN . '/' . $id;
}

/** 手入力のURLとして受け付ける形：https://note.com/ で始まる */
function admin_note_is_valid_url(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false && str_starts_with($url, ADMIN_NOTE_ORIGIN . '/');
}

/**
 * 今日の note 枠（ストックの note 本文から作られた投稿枠）。無ければ null。
 * 戻り値：post_queue の行 ＋ stock（admin_stock_get）＋ note_title・note_body
 */
function admin_note_today_slot(DateTimeImmutable $now): ?array
{
    $stmt = admin_db()->prepare(
        "SELECT * FROM post_queue WHERE platform = 'note' AND slot_date = ? AND status NOT IN ('canceled', 'skipped') ORDER BY id DESC LIMIT 1"
    );
    $stmt->execute([$now->format('Y-m-d')]);
    $row = $stmt->fetch();
    if ($row === false) {
        return null;
    }
    $stock = admin_stock_get((int) $row['stock_id']);
    $row['stock'] = $stock;
    $row['note_title'] = (string) ($stock['bodies']['note']['title'] ?? '') !== '' ? (string) $stock['bodies']['note']['title'] : (string) ($stock['title'] ?? '');
    $row['note_body'] = $stock !== null ? admin_stock_render_body($stock, 'note') : '';
    return $row;
}

/** 今日の note 枠が、まだ投稿済みになっていないか（手動投稿待ち・予約中・保留） */
function admin_note_slot_is_open(?array $slot): bool
{
    return $slot !== null && in_array($slot['status'], ['manual_pending', 'scheduled', 'held'], true);
}

/** 指定日に note に出した記事（新しい順） */
function admin_note_posts_on(string $date): array
{
    $stmt = admin_db()->prepare('SELECT * FROM note_posts WHERE posted_on = ? ORDER BY id DESC');
    $stmt->execute([$date]);
    return $stmt->fetchAll();
}

/** 記録する。同じURLが記録済みなら記録しない。戻り値：記録した行のID（記録済みなら null） */
function admin_note_insert(?string $url, ?string $title, string $postedOn, string $source, ?int $queueId): ?int
{
    if ($url !== null) {
        $stmt = admin_db()->prepare('SELECT id FROM note_posts WHERE url = ?');
        $stmt->execute([$url]);
        if ($stmt->fetchColumn() !== false) {
            return null;
        }
    }
    admin_db()->prepare('INSERT INTO note_posts (url, title, posted_on, source, queue_id, created_at) VALUES (?, ?, ?, ?, ?, ?)')
        ->execute([$url, $title, $postedOn, $source, $queueId, admin_now()]);
    return (int) admin_db()->lastInsertId();
}

/**
 * note の枠が「投稿済」になったとき（admin_sns_mark_posted から呼ぶ）。note の枠でなければ何もしない。
 * 同じURLが RSS で記録済みならその行に枠を結び付け、無ければ新しく記録する。
 */
function admin_note_record_from_queue(int $queueId): void
{
    $stmt = admin_db()->prepare("SELECT q.*, s.title AS stock_title FROM post_queue q JOIN post_stock s ON s.id = q.stock_id WHERE q.id = ? AND q.platform = 'note' AND q.status = 'posted'");
    $stmt->execute([$queueId]);
    $row = $stmt->fetch();
    if ($row === false) {
        return;
    }
    $linked = admin_db()->prepare('SELECT 1 FROM note_posts WHERE queue_id = ?');
    $linked->execute([$queueId]);
    if ($linked->fetchColumn() !== false) {
        return;
    }
    $url = $row['post_url'];
    if ($url !== null) {
        $update = admin_db()->prepare('UPDATE note_posts SET queue_id = ? WHERE url = ? AND queue_id IS NULL');
        $update->execute([$queueId, $url]);
        if ($update->rowCount() > 0) {
            return;
        }
    }
    $postedOn = substr((string) ($row['posted_at'] ?? admin_now()), 0, 10);
    // 記録の名前は note のタイトル（無ければストックの管理用タイトル）
    $noteTitle = (string) (admin_stock_get((int) $row['stock_id'])['bodies']['note']['title'] ?? '');
    admin_note_insert($url, $noteTitle !== '' ? $noteTitle : (string) $row['stock_title'], $postedOn, 'manual', $queueId);
}

/**
 * 「今日」画面・1本道からの手入力。今日の note 枠があればその枠を投稿済にし（記録は admin_note_record_from_queue）、
 * 無ければ枠なしで記録する。戻り値：画面に出す文
 */
function admin_note_record_manual(string $url, DateTimeImmutable $now): string
{
    if (!admin_note_is_valid_url($url)) {
        throw new InvalidArgumentException('noteの記事のURL（https://note.com/ で始まるURL）を貼ってください。');
    }
    $slot = admin_note_today_slot($now);
    if (admin_note_slot_is_open($slot)) {
        admin_sns_mark_posted((int) $slot['id'], $url);
        return '今日のnoteを投稿済にしました。';
    }
    if (admin_note_insert($url, null, $now->format('Y-m-d'), 'manual', null) === null) {
        return 'このURLは記録済みです。';
    }
    return '今日のnoteとして記録しました。';
}

/**
 * note の別枠（ADMIN_NOTE_LANE）に1行入れる。同じ日の Threads の枠には触らない。
 * その日に note の行が既にあれば入れない（1日1本）。ただし別枠の「予約中」の行だけは入れ替える。
 * $status：'scheduled'（時刻が来たら手動投稿待ち）／'manual_pending'（今すぐ投稿待ち＝「今日のnoteにする」）
 * 戻り値：入れ替えた行があったか
 */
function admin_note_lane_add(int $stockId, string $date, DateTimeImmutable $at, string $status = 'scheduled'): bool
{
    $stmt = admin_db()->prepare("SELECT id, assigned_by, status FROM post_queue WHERE platform = 'note' AND slot_date = ? AND status NOT IN ('canceled', 'skipped')");
    $stmt->execute([$date]);
    $replace = [];
    foreach ($stmt->fetchAll() as $row) {
        if ($row['assigned_by'] === ADMIN_NOTE_LANE && $row['status'] === 'scheduled') {
            $replace[] = (int) $row['id'];
            continue;
        }
        throw new RuntimeException(admin_date_label($date) . 'は、すでに note の枠があります（投稿予定の画面で確認・取消してから入れてください）');
    }
    foreach ($replace as $id) {
        admin_db()->prepare('DELETE FROM post_queue WHERE id = ?')->execute([$id]);
    }
    admin_db()->prepare(
        "INSERT INTO post_queue (stock_id, platform, slot_date, scheduled_at, assigned_by, status, created_at, updated_at) VALUES (?, 'note', ?, ?, ?, ?, ?, ?)"
    )->execute([$stockId, $date, $at->format(DATE_ATOM), ADMIN_NOTE_LANE, $status, admin_now(), admin_now()]);
    return $replace !== [];
}

/** note の別枠の行を取り消す（投稿予定の画面）。まだ投稿済でないものだけ */
function admin_note_lane_cancel(int $queueId): void
{
    admin_db()->prepare(
        "UPDATE post_queue SET status = 'canceled', updated_at = ? WHERE id = ? AND platform = 'note' AND assigned_by = ? AND status IN ('scheduled', 'held', 'manual_pending')"
    )->execute([admin_now(), $queueId, ADMIN_NOTE_LANE]);
}

/** その日の note の別枠の行（投稿予定の画面で Threads の枠とは別に出す） */
function admin_note_lane_rows(string $date): array
{
    $stmt = admin_db()->prepare(
        "SELECT q.*, s.title FROM post_queue q JOIN post_stock s ON s.id = q.stock_id WHERE q.platform = 'note' AND q.assigned_by = ? AND q.slot_date = ? ORDER BY q.id"
    );
    $stmt->execute([ADMIN_NOTE_LANE, $date]);
    return $stmt->fetchAll();
}

/**
 * 「今日のnoteにする」の候補：note 本文があり、まだ note として使っていない（取消・スキップ以外の note の行が無い）ストック。
 * 承認済を先に、古いものから
 */
function admin_note_candidates(int $limit = 10): array
{
    $stmt = admin_db()->prepare(
        "SELECT s.* FROM post_stock s JOIN post_stock_bodies b ON b.stock_id = s.id AND b.platform = 'note'
         WHERE s.status IN ('approved', 'pending_review')
           AND NOT EXISTS (SELECT 1 FROM post_queue q WHERE q.stock_id = s.id AND q.platform = 'note' AND q.status NOT IN ('canceled', 'skipped'))
         ORDER BY CASE s.status WHEN 'approved' THEN 0 ELSE 1 END, s.id LIMIT " . (int) $limit
    );
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * 「今日のnoteにする」：候補のストックを今日の note（別枠・手動投稿待ち）にする。未承認なら承認もする（画面で確認してから押す）。
 * 戻り値：承認もしたか
 */
function admin_note_set_today(int $stockId, DateTimeImmutable $now): bool
{
    $ids = array_map('intval', array_column(admin_note_candidates(1000), 'id'));
    if (!in_array($stockId, $ids, true)) {
        throw new RuntimeException('このストックは今日のnoteにできません（note本文が無いか、すでに使っています）');
    }
    $stock = admin_stock_get($stockId);
    $approved = false;
    if ($stock['status'] !== 'approved') {
        admin_stock_set_status($stockId, 'approved');
        $approved = true;
    }
    admin_note_lane_add($stockId, $now->format('Y-m-d'), $now, 'manual_pending');
    return $approved;
}

/** RSS で見つけた記事（枠に結び付いていない今日の分）を、今日の note 枠に結び付けて枠を投稿済にする */
function admin_note_link_to_today(int $notePostId, DateTimeImmutable $now): void
{
    $stmt = admin_db()->prepare('SELECT * FROM note_posts WHERE id = ? AND queue_id IS NULL AND posted_on = ?');
    $stmt->execute([$notePostId, $now->format('Y-m-d')]);
    $post = $stmt->fetch();
    $slot = admin_note_today_slot($now);
    if ($post === false || !admin_note_slot_is_open($slot)) {
        throw new InvalidArgumentException('結び付けられる記事・枠がありません（すでに記録済みの可能性があります）。');
    }
    admin_sns_mark_posted((int) $slot['id'], (string) $post['url']);
}

/** 今日 RSS で見つけたが、今日の note 枠に結び付いていない記事（今日の枠がまだ開いているときだけ） */
function admin_note_unlinked_today(DateTimeImmutable $now): array
{
    if (!admin_note_slot_is_open(admin_note_today_slot($now))) {
        return [];
    }
    return array_values(array_filter(admin_note_posts_on($now->format('Y-m-d')), static fn (array $p): bool => $p['queue_id'] === null && $p['url'] !== null));
}

/**
 * RSS を取りに行く関数（URL → [HTTPコード, 本文]）。検証では差し替えて、note.com へ通信しない。
 * $set で差し替え、$reset で既定（curl）に戻す。
 */
function admin_note_rss_transport(?callable $set = null, bool $reset = false): callable
{
    static $transport = null;
    if ($reset) {
        $transport = null;
    } elseif ($set !== null) {
        $transport = $set;
    }
    return $transport ?? 'admin_note_curl_get';
}

/** 既定の取得（curl。タイムアウト10秒・https だけ・リダイレクトは3回まで）。戻り値：[HTTPコード, 本文]。接続できなければ RuntimeException */
function admin_note_curl_get(string $url): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 3,
        CURLOPT_PROTOCOLS      => CURLPROTO_HTTPS,
        CURLOPT_USERAGENT      => 'life-fun-admin/1.0 (+' . admin_config()['site_url'] . ')',
    ]);
    $body = curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $errno = curl_errno($ch);
    curl_close($ch);
    if ($errno !== 0 || !is_string($body)) {
        throw new RuntimeException('noteに接続できません（curl ' . $errno . '）');
    }
    return [$code, $body];
}

/** RSS を取得して配列にする：[['title', 'url', 'posted_on'], ...]。失敗は RuntimeException */
function admin_note_fetch_rss_items(string $userId): array
{
    if (!function_exists('simplexml_load_string')) {
        throw new RuntimeException('サーバーで RSS を読む機能（SimpleXML）が使えません');
    }
    [$code, $body] = (admin_note_rss_transport())(ADMIN_NOTE_ORIGIN . '/' . rawurlencode($userId) . '/rss');
    if ($code !== 200) {
        throw new RuntimeException('noteが HTTP ' . $code . ' を返しました（IDが正しいか確認してください）');
    }
    $previous = libxml_use_internal_errors(true);
    $xml = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NONET | LIBXML_NOCDATA);
    libxml_use_internal_errors($previous);
    if ($xml === false || !isset($xml->channel)) {
        throw new RuntimeException('noteの更新情報（RSS）の形式を読めません');
    }
    $tz = new DateTimeZone(admin_config()['timezone']);
    $items = [];
    foreach ($xml->channel->item as $item) {
        $url = trim((string) $item->link);
        $time = date_create_immutable(trim((string) $item->pubDate));
        if (!admin_note_is_valid_url($url) || $time === false) {
            continue;
        }
        $items[] = ['title' => trim((string) $item->title), 'url' => $url, 'posted_on' => $time->setTimezone($tz)->format('Y-m-d')];
    }
    return $items;
}

/**
 * 毎時：RSS から新しい記事を拾って記録する。今日の note 枠とタイトルが一致すれば、その枠を投稿済にする。
 * 一致しなければ記録だけして、「今日」画面に「今日のnoteとして記録」（枠への結び付け）を出す。
 * 失敗は note_rss_error に残し（「今日」のやることに出る）、すぐ届く通知にはしない。戻り値：cronの記録用の短い文
 */
function admin_note_rss_tick(DateTimeImmutable $now): string
{
    $userId = admin_note_user_id();
    if ($userId === null) {
        return 'note：IDが未設定';
    }
    try {
        $items = admin_note_fetch_rss_items($userId);
    } catch (RuntimeException $e) {
        admin_set_setting('note_rss_error', $e->getMessage());
        admin_set_setting('note_rss_checked_at', admin_now());
        return 'note：' . $e->getMessage();
    }
    admin_set_setting('note_rss_error', '');
    admin_set_setting('note_rss_checked_at', admin_now());

    $oldest = $now->modify('-' . (ADMIN_NOTE_RSS_DAYS - 1) . ' days')->format('Y-m-d');
    $today = $now->format('Y-m-d');
    $slot = admin_note_today_slot($now);
    $added = 0;
    foreach ($items as $item) {
        if ($item['posted_on'] < $oldest || $item['posted_on'] > $today) {
            continue;
        }
        if (admin_note_insert($item['url'], $item['title'], $item['posted_on'], 'rss', null) === null) {
            continue;
        }
        $added++;
        if ($item['posted_on'] === $today && admin_note_slot_is_open($slot) && admin_note_same_title($item['title'], $slot['note_title'])) {
            admin_sns_mark_posted((int) $slot['id'], $item['url']);
            $slot = null;
        }
    }
    return 'note：新しい記事 ' . $added . '件';
}

/** タイトルの一致（前後の空白・全角空白の違いは無視） */
function admin_note_same_title(string $a, string $b): bool
{
    $normalize = static fn (string $s): string => preg_replace('/[\s\x{3000}]+/u', '', $s) ?? $s;
    return $a !== '' && $normalize($a) === $normalize($b);
}
