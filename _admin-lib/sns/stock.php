<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/stock.php
 *
 * 投稿ストック（ネタ帳）の登録・検証・編集・承認と、本文の {link} 置換。
 * status：pending_review（未承認）/ approved（承認済）/ archived（アーカイブ）
 */

const ADMIN_STOCK_STATUS_LABELS = [
    'pending_review' => '未承認',
    'approved'       => '承認済',
    'archived'       => 'アーカイブ',
];
const ADMIN_STOCK_SOURCE_LABELS = [
    'generated' => '自動生成',
    'quiz_data' => '既存クイズ',
    'manual'    => '手書き',
];

function admin_post_mode(): string
{
    return admin_setting('post_mode') === 'auto' ? 'auto' : 'review';
}

/** 種別一覧 [kind => row]（sort順） */
function admin_post_kinds(bool $activeOnly = false): array
{
    $sql = 'SELECT * FROM post_kinds' . ($activeOnly ? ' WHERE active = 1' : '') . ' ORDER BY sort, kind';
    $kinds = [];
    foreach (admin_db()->query($sql) as $row) {
        $kinds[$row['kind']] = $row;
    }
    return $kinds;
}

function admin_kind_label(string $kind): string
{
    return admin_post_kinds()[$kind]['label'] ?? $kind;
}

/** ストック1件（bodies付き）。無ければ null */
function admin_stock_get(int $id): ?array
{
    $stmt = admin_db()->prepare('SELECT * FROM post_stock WHERE id = ?');
    $stmt->execute([$id]);
    $stock = $stmt->fetch();
    if ($stock === false) {
        return null;
    }
    $stock['bodies'] = [];
    $bodies = admin_db()->prepare('SELECT platform, title, body FROM post_stock_bodies WHERE stock_id = ?');
    $bodies->execute([$id]);
    foreach ($bodies as $row) {
        $stock['bodies'][$row['platform']] = ['title' => $row['title'], 'body' => $row['body']];
    }
    return $stock;
}

/** リンク先URLに SNS別のUTMを付ける（既存クイズの投稿文と同じ形：utm_source / utm_medium=social / utm_campaign） */
function admin_utm_url(string $linkUrl, string $platform, string $kind): string
{
    $campaign = admin_post_kinds()[$kind]['utm_campaign'] ?? $kind;
    return $linkUrl . (str_contains($linkUrl, '?') ? '&' : '?')
        . http_build_query(['utm_source' => $platform, 'utm_medium' => 'social', 'utm_campaign' => $campaign]);
}

/** 投稿に使う本文（{link} をUTM付きURLに置換）。既存クイズの本文は {link} を含まないのでそのまま */
function admin_stock_render_body(array $stock, string $platform): string
{
    $body = $stock['bodies'][$platform]['body'] ?? '';
    if (str_contains($body, '{link}') && ($stock['link_url'] ?? '') !== '') {
        $body = str_replace('{link}', admin_utm_url($stock['link_url'], $platform, $stock['kind']), $body);
    }
    return $body;
}

/**
 * 入力の検証（取り込み・手書き・編集で共通）。問題が無ければ空配列。
 * $data = ['kind', 'title', 'link_url', 'bodies' => [platform => ['title' => ?, 'body' => ]]]
 */
function admin_stock_validate(array $data): array
{
    $errors = [];
    $kinds = admin_post_kinds(true);

    if (!is_string($data['kind'] ?? null) || !isset($kinds[$data['kind']])) {
        $errors[] = '種別が正しくありません（' . implode(' / ', array_keys($kinds)) . '）';
    }
    $title = $data['title'] ?? null;
    if (!is_string($title) || trim($title) === '' || mb_strlen($title) > 100) {
        $errors[] = 'タイトルは1〜100文字で入力してください';
    }

    $link = $data['link_url'] ?? '';
    if (!is_string($link)) {
        $errors[] = 'リンク先URLの形式が正しくありません';
        $link = '';
    }
    if ($link !== '') {
        if (!str_starts_with($link, admin_config()['site_url'] . '/') || filter_var($link, FILTER_VALIDATE_URL) === false) {
            $errors[] = 'リンク先URLは ' . admin_config()['site_url'] . '/ で始まるURLにしてください';
        }
        if (stripos($link, 'utm_') !== false) {
            $errors[] = 'リンク先URLにUTMを付けないでください（管理画面が自動で付けます）';
        }
    }

    $bodies = $data['bodies'] ?? null;
    if (!is_array($bodies) || $bodies === []) {
        $errors[] = '本文が1つもありません';
        return $errors;
    }
    foreach ($bodies as $platform => $body) {
        if (!isset(ADMIN_SNS_PLATFORMS[$platform])) {
            $errors[] = '未対応のSNSです：' . $platform;
            continue;
        }
        $def = ADMIN_SNS_PLATFORMS[$platform];
        $label = $def['label'];
        $text = is_array($body) ? ($body['body'] ?? null) : null;
        if (!is_string($text) || trim($text) === '') {
            $errors[] = $label . '：本文が空です';
            continue;
        }
        if ($def['needs_title'] && (!is_string($body['title'] ?? null) || trim($body['title']) === '')) {
            $errors[] = $label . '：タイトルが必要です';
        }
        if (str_contains($text, '{link}') && $link === '') {
            $errors[] = $label . '：本文に {link} があるのにリンク先URLがありません';
        }
        if (isset($kinds[$data['kind'] ?? ''])) {
            // 文字数・リンク数の判定は自動投稿の直前の確認と同じ部品（platforms.php）を使う
            $rendered = $link !== '' ? str_replace('{link}', admin_utm_url($link, $platform, $data['kind']), $text) : $text;
            array_push($errors, ...admin_sns_text_errors($platform, $rendered));
        }
    }
    return $errors;
}

/** フォームやJSONの入力を保存用の形にそろえる */
function admin_stock_normalize(array $data): array
{
    $bodies = [];
    foreach ((array) ($data['bodies'] ?? []) as $platform => $body) {
        $text = is_array($body) ? trim((string) ($body['body'] ?? '')) : '';
        if ($text === '') {
            continue;
        }
        $bodies[(string) $platform] = [
            'title' => is_array($body) && trim((string) ($body['title'] ?? '')) !== '' ? trim((string) $body['title']) : null,
            'body'  => $text,
        ];
    }
    return [
        'kind'     => is_string($data['kind'] ?? null) ? $data['kind'] : '',
        'title'    => is_string($data['title'] ?? null) ? trim($data['title']) : '',
        'link_url' => is_string($data['link_url'] ?? null) ? trim($data['link_url']) : '',
        'notes'    => is_string($data['notes'] ?? null) ? trim($data['notes']) : '',
        'bodies'   => $bodies,
    ];
}

/**
 * 新規登録（検証済みの normalize 後データ）。確認モードなら「未承認」、自動モードなら「承認済」で登録する。
 */
function admin_stock_create(array $data, string $source, ?string $extId, ?int $batchId): int
{
    $now = admin_now();
    $status = admin_post_mode() === 'auto' ? 'approved' : 'pending_review';
    admin_db()->prepare(
        'INSERT INTO post_stock (ext_id, kind, title, link_url, source, status, import_batch_id, notes, created_at, approved_at, updated_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    )->execute([
        $extId, $data['kind'], $data['title'], $data['link_url'] !== '' ? $data['link_url'] : null, $source, $status,
        $batchId, $data['notes'] !== '' ? $data['notes'] : null, $now, $status === 'approved' ? $now : null, $now,
    ]);
    $id = (int) admin_db()->lastInsertId();
    admin_stock_save_bodies($id, $data['bodies']);
    return $id;
}

function admin_stock_save_bodies(int $id, array $bodies): void
{
    admin_db()->prepare('DELETE FROM post_stock_bodies WHERE stock_id = ?')->execute([$id]);
    $insert = admin_db()->prepare('INSERT INTO post_stock_bodies (stock_id, platform, title, body) VALUES (?, ?, ?, ?)');
    foreach ($bodies as $platform => $body) {
        $insert->execute([$id, $platform, $body['title'], $body['body']]);
    }
}

/** 内容の比較用（タイトル・リンク・本文） */
function admin_stock_fingerprint(array $stock): string
{
    $bodies = $stock['bodies'];
    ksort($bodies);
    return json_encode([$stock['kind'], $stock['title'], (string) ($stock['link_url'] ?? ''), $bodies], JSON_UNESCAPED_UNICODE);
}

/**
 * 編集の保存。内容が変わったら edited=1（自動モード切替の目安「修正ゼロ2週間」の計測用）。
 * 戻り値：内容が変わったか
 */
function admin_stock_update(int $id, array $data): bool
{
    $before = admin_stock_get($id);
    if ($before === null) {
        throw new RuntimeException('ストックが見つかりません');
    }
    $after = ['kind' => $data['kind'], 'title' => $data['title'], 'link_url' => $data['link_url'], 'bodies' => $data['bodies']];
    $changed = admin_stock_fingerprint($before) !== admin_stock_fingerprint($after);

    admin_db()->prepare(
        'UPDATE post_stock SET kind = ?, title = ?, link_url = ?, notes = ?, edited = CASE WHEN ? THEN 1 ELSE edited END, updated_at = ? WHERE id = ?'
    )->execute([
        $data['kind'], $data['title'], $data['link_url'] !== '' ? $data['link_url'] : null,
        $data['notes'] !== '' ? $data['notes'] : null, $changed ? 1 : 0, admin_now(), $id,
    ]);
    admin_stock_save_bodies($id, $data['bodies']);
    return $changed;
}

function admin_stock_set_status(int $id, string $status): void
{
    if (!isset(ADMIN_STOCK_STATUS_LABELS[$status])) {
        throw new InvalidArgumentException('不正な状態: ' . $status);
    }
    admin_db()->prepare(
        "UPDATE post_stock SET status = ?, approved_at = CASE WHEN ? = 'approved' THEN ? ELSE approved_at END, updated_at = ? WHERE id = ?"
    )->execute([$status, $status, admin_now(), admin_now(), $id]);
}

/**
 * 日時を指定して予約する（ADMIN_PLAN.md 4章2「予約（日時指定）」。テスト投稿・ローテーション外の臨時投稿用）。
 * 投稿先 $platforms は Threads・note から選ぶ（段階2：note 本文があれば note の枠も同じ日に作れる。note は投稿時刻に「手動投稿待ち」になり、
 * その日の「今日」画面に本文が出る）。既定は Threads だけ（従来どおり）。
 * note だけを選んだときは note の別枠に入れ（admin_note_lane_add）、同じ日の Threads の枠には触らない。
 * 条件：承認済み・選んだ投稿先すべての本文がある・まだ投稿枠に載っていない（取消・スキップは除く）・指定日時が今より後。
 * 既存の予約ロジック（1日1枠＝slot_date ごとの行の集まり）に沿い、その日に枠があれば差し替える（admin_sns_replace_slot と同じ扱い。
 * 投稿済・手動投稿待ち・送信中・削除済み、公開されたか確認できていない失敗（コンテナIDあり）を含む枠は差し替えない）。
 * 外すのは予約中・保留・取消の行だけで、スキップ・失敗の行は履歴として残す。差し替えで外れたストックは未使用に戻る。
 * 戻り値：差し替えた（外した）予約があったか
 */
function admin_sns_schedule_at(int $stockId, DateTimeImmutable $at, ?DateTimeImmutable $now = null, array $platforms = ['threads']): bool
{
    $now ??= new DateTimeImmutable('now');
    $stock = admin_stock_get($stockId);
    if ($stock === null) {
        throw new RuntimeException('ストックが見つかりません');
    }
    if ($stock['status'] !== 'approved') {
        throw new RuntimeException('承認済みのストックだけ予約できます。先に承認してください');
    }
    $platforms = array_values(array_unique(array_intersect($platforms, ['threads', 'note'])));
    if ($platforms === []) {
        throw new RuntimeException('投稿先を1つ以上選んでください');
    }
    foreach ($platforms as $platform) {
        if (!isset($stock['bodies'][$platform])) {
            throw new RuntimeException('このストックには ' . admin_sns_label($platform) . ' の本文がありません');
        }
    }
    if ($at <= $now) {
        throw new RuntimeException('過去の日時には予約できません');
    }
    $used = admin_db()->prepare("SELECT COUNT(*) FROM post_queue WHERE stock_id = ? AND status NOT IN ('canceled', 'skipped')");
    $used->execute([$stockId]);
    if ((int) $used->fetchColumn() > 0) {
        throw new RuntimeException('このストックは既に投稿枠に載っています（予約中・投稿済など）。投稿予定の画面で確認してください');
    }
    $date = $at->format('Y-m-d');
    if ($platforms === ['note']) {
        // noteだけ：別枠に入れる（同じ日の Threads の枠には触らない）
        return admin_note_lane_add($stockId, $date, $at);
    }
    $rows = admin_sns_slot_rows($date);
    foreach ($rows as $row) {
        if (in_array($row['status'], ['posted', 'manual_pending', 'sending', 'deleted'], true)) {
            throw new RuntimeException(admin_date_label($date) . 'は投稿済・手動投稿待ち・送信中の枠があるため予約できません');
        }
    }
    if (admin_sns_slot_has_unconfirmed($rows)) {
        throw new RuntimeException(ADMIN_SNS_UNCONFIRMED_MESSAGE);
    }
    if (in_array('note', $platforms, true) && array_filter(admin_note_lane_rows($date), static fn (array $r): bool => !in_array($r['status'], ['canceled', 'skipped'], true)) !== []) {
        throw new RuntimeException(admin_date_label($date) . 'は、すでに note の別枠があります（note のチェックを外すか、投稿予定の画面で別枠を取り消してください）');
    }
    // 予約中・保留・取消の行だけ外す（スキップ・失敗の行は履歴として残す）
    $removed = admin_sns_remove_slot_rows($date);
    admin_sns_create_slot_rows($stockId, $date, $at, $platforms, 'manual');
    return $removed > 0;
}
