<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/scheduler.php
 *
 * 投稿予定（post_queue）の割り当てと、投稿時刻の処理。
 *  - 毎時：先 ADMIN_ASSIGN_DAYS 日分の空いている投稿枠へ、曜日ごとの種別でストックを自動割り当て
 *  - 毎分：投稿時刻が来た行を処理（確認モードで未承認 → 保留＋通知 / 連携済み → 自動投稿 / 自動投稿の部品があるのに未連携 → スキップ＋通知（1日1回）
 *          / 部品が無いSNS（note）→ 手動投稿待ち＋通知）。送信中（sending）の行の続き（公開・再試行）も毎分1段階ずつ進める
 *  - 翌日分の未承認・ストック残量は、朝のまとめ通知（notify.php）の「やること」で知らせる（段階2で21時の通知を廃止）
 *
 * 投稿枠 = slot_date が同じ行の集まり。ユーザーが「取消」した枠は canceled の行が残り、自動では埋め直さない。
 * note の別枠（assigned_by = ADMIN_NOTE_LANE）：「noteだけ」で予約した行・「今日のnoteにする」で入れた行。投稿枠には数えず、
 * 差し替え・取消・割り当て・空き枠の判定（admin_sns_slot_rows などの枠の関数）からは見えない。同じ日の Threads の枠に触らないため（段階2）。
 * システムが外す場合（差し替え・アーカイブ・割り当てやり直し）は行を削除する。
 */

const ADMIN_ASSIGN_DAYS = 7;
/** note の別枠の印（post_queue.assigned_by） */
const ADMIN_NOTE_LANE = 'note_lane';
const ADMIN_STOCK_LOW_DAYS = 3;

const ADMIN_QUEUE_STATUS_LABELS = [
    'scheduled'      => '予約中',
    'sending'        => '送信中',
    'manual_pending' => '手動投稿待ち',
    'posted'         => '投稿済',
    'held'           => '保留（未承認）',
    'failed'         => '失敗',
    'skipped'        => 'スキップ',
    'canceled'       => '取消',
    'deleted'        => '削除済み',
];

/** 1回のcron（毎分）で自動投稿の処理を進める行数の上限（1行あたりのAPI呼び出しは最大3回） */
const ADMIN_SNS_AUTO_ROWS_PER_RUN = 5;

const ADMIN_WEEKDAY_LABELS = ['日', '月', '火', '水', '木', '金', '土'];

/** ローテーション [weekday => rule]（platforms は配列に展開） */
function admin_rotation_rules(bool $activeOnly = true): array
{
    $rules = [];
    $sql = 'SELECT * FROM rotation_rules' . ($activeOnly ? ' WHERE active = 1' : '') . ' ORDER BY weekday';
    foreach (admin_db()->query($sql) as $row) {
        $row['platforms'] = json_decode($row['platforms'], true) ?: [];
        $rules[(int) $row['weekday']] = $row;
    }
    return $rules;
}

function admin_slot_scheduled_at(string $date, string $time): DateTimeImmutable
{
    return new DateTimeImmutable($date . ' ' . $time . ':00');
}

/** 「9/29（火）」。$markToday なら今日は「9/29（火・今日）」 */
function admin_date_label(string $date, bool $markToday = false): string
{
    $d = new DateTimeImmutable($date);
    $today = $markToday && $d->format('Y-m-d') === (new DateTimeImmutable('today'))->format('Y-m-d') ? '・今日' : '';
    return $d->format('n/j') . '（' . ADMIN_WEEKDAY_LABELS[(int) $d->format('w')] . $today . '）';
}

/**
 * 割り当て候補のストック。一度もキューに載っていない（取消・スキップ以外の行が無い）未承認・承認済のもの。
 * スキップ（自動投稿できない日に飛ばした枠）は投稿されていないので、ストックは未使用に戻る（ADMIN_IMPL_PLAN.md 14-6 Q4）。
 * 承認済を優先し、古いものから。$kind=null なら全種別。
 */
function admin_sns_candidates(?string $kind, int $limit = 100): array
{
    $sql = "SELECT s.* FROM post_stock s
            WHERE s.status IN ('approved', 'pending_review')
              AND NOT EXISTS (SELECT 1 FROM post_queue q WHERE q.stock_id = s.id AND q.status NOT IN ('canceled', 'skipped'))"
        . ($kind !== null ? ' AND s.kind = ?' : '')
        . " ORDER BY CASE s.status WHEN 'approved' THEN 0 ELSE 1 END, s.id LIMIT " . (int) $limit;
    $stmt = admin_db()->prepare($sql);
    $stmt->execute($kind !== null ? [$kind] : []);
    return $stmt->fetchAll();
}

/**
 * そのストックを投稿する SNS：ローテーションの投稿先のうち本文があるもの ＋ note本文があれば note。
 * $date を渡すと、その日に note の別枠（ADMIN_NOTE_LANE）の行があるときは note を加えない（note は1日1本）
 */
function admin_sns_slot_platforms(array $rulePlatforms, int $stockId, ?string $date = null): array
{
    $stock = admin_stock_get($stockId);
    $platforms = array_values(array_filter($rulePlatforms, static fn (string $p): bool => isset($stock['bodies'][$p])));
    $laneTaken = $date !== null && array_filter(admin_note_lane_rows($date), static fn (array $r): bool => !in_array($r['status'], ['canceled', 'skipped'], true)) !== [];
    if (isset($stock['bodies']['note']) && !in_array('note', $platforms, true) && !$laneTaken) {
        $platforms[] = 'note';
    }
    return $platforms;
}

function admin_sns_create_slot_rows(int $stockId, string $date, DateTimeImmutable $scheduledAt, array $platforms, string $assignedBy): void
{
    $insert = admin_db()->prepare(
        "INSERT INTO post_queue (stock_id, platform, slot_date, scheduled_at, assigned_by, status, created_at, updated_at)
         VALUES (?, ?, ?, ?, ?, 'scheduled', ?, ?)"
    );
    foreach ($platforms as $platform) {
        $insert->execute([$stockId, $platform, $date, $scheduledAt->format(DATE_ATOM), $assignedBy, admin_now(), admin_now()]);
    }
}

function admin_sns_slot_rows(string $date): array
{
    $stmt = admin_db()->prepare('SELECT * FROM post_queue WHERE slot_date = ? AND assigned_by <> ? ORDER BY id');
    $stmt->execute([$date, ADMIN_NOTE_LANE]);
    return $stmt->fetchAll();
}

/** その日の今の割り当て（最後に作られた行）のストックID。行が無ければ null */
function admin_sns_slot_current_stock_id(string $date): ?int
{
    $stmt = admin_db()->prepare('SELECT stock_id FROM post_queue WHERE slot_date = ? AND assigned_by <> ? ORDER BY id DESC LIMIT 1');
    $stmt->execute([$date, ADMIN_NOTE_LANE]);
    $id = $stmt->fetchColumn();
    return $id === false ? null : (int) $id;
}

/**
 * 先 ADMIN_ASSIGN_DAYS 日分の空いている枠を埋める。戻り値：割り当てた枠の数
 */
function admin_sns_assign(?DateTimeImmutable $now = null): int
{
    $now ??= new DateTimeImmutable('now');
    $rules = admin_rotation_rules();
    $assigned = 0;

    for ($i = 0; $i < ADMIN_ASSIGN_DAYS; $i++) {
        $day = $now->modify('+' . $i . ' day');
        $rule = $rules[(int) $day->format('w')] ?? null;
        if ($rule === null) {
            continue;
        }
        $date = $day->format('Y-m-d');
        $scheduledAt = admin_slot_scheduled_at($date, $rule['post_time']);
        if ($scheduledAt <= $now || admin_sns_slot_rows($date) !== []) {
            continue;
        }
        foreach (admin_sns_candidates($rule['kind'], 20) as $candidate) {
            $platforms = admin_sns_slot_platforms($rule['platforms'], (int) $candidate['id'], $date);
            if ($platforms !== []) {
                admin_sns_create_slot_rows((int) $candidate['id'], $date, $scheduledAt, $platforms, 'rotation');
                $assigned++;
                break;
            }
        }
    }
    return $assigned;
}

/** 先 ADMIN_ASSIGN_DAYS 日で、ローテーションがあるのに割り当てが無い（取消も無い）日 */
function admin_sns_empty_slots(?DateTimeImmutable $now = null): array
{
    $now ??= new DateTimeImmutable('now');
    $rules = admin_rotation_rules();
    $empty = [];
    for ($i = 0; $i < ADMIN_ASSIGN_DAYS; $i++) {
        $day = $now->modify('+' . $i . ' day');
        $rule = $rules[(int) $day->format('w')] ?? null;
        if ($rule === null) {
            continue;
        }
        $date = $day->format('Y-m-d');
        if (admin_slot_scheduled_at($date, $rule['post_time']) > $now && admin_sns_slot_rows($date) === []) {
            $empty[] = ['date' => $date, 'kind' => $rule['kind']];
        }
    }
    return $empty;
}

/**
 * 投稿時刻が来た行を処理する（毎分）。戻り値：処理した行数
 */
function admin_sns_process_due(?DateTimeImmutable $now = null): int
{
    $now ??= new DateTimeImmutable('now');
    $stmt = admin_db()->prepare(
        "SELECT q.*, s.status AS stock_status, s.title AS stock_title FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
         WHERE q.status = 'scheduled' AND q.scheduled_at <= ? ORDER BY q.scheduled_at, q.id"
    );
    $stmt->execute([$now->format(DATE_ATOM)]);
    $rows = $stmt->fetchAll();
    $update = admin_db()->prepare('UPDATE post_queue SET status = ?, last_error = ?, updated_at = ? WHERE id = ?');
    $queueUrl = admin_absolute_admin_url('/sns/');
    // 自動投稿は1回のcronで進める行数に上限を設ける（超えた分は予約中のまま次の回へ）。1回のcronの中では待たない（sleep しない）
    $autoBudget = ADMIN_SNS_AUTO_ROWS_PER_RUN;
    $handled = 0;
    if (function_exists('admin_threads_begin_run')) {
        admin_threads_begin_run();
    }

    foreach ($rows as $row) {
        $label = admin_sns_label($row['platform']);
        if (admin_post_mode() === 'review' && $row['stock_status'] !== 'approved') {
            $update->execute(['held', '確認モードで未承認のため投稿しませんでした', admin_now(), $row['id']]);
            admin_notify('sns_held', "未承認のため投稿を保留しました（{$label}）\n「{$row['stock_title']}」\n{$queueUrl}");
            $handled++;
            continue;
        }
        if (admin_sns_has_publisher($row['platform'])) {
            if (!admin_sns_is_connected($row['platform'])) {
                admin_sns_skip_unconnected($row, $now);
                $handled++;
                continue;
            }
            if ($autoBudget <= 0) {
                continue;
            }
            $autoBudget--;
            $handled++;
            ('admin_sns_' . $row['platform'] . '_publish')($row, $now);
            continue;
        }
        $update->execute(['manual_pending', null, admin_now(), $row['id']]);
        $stock = admin_stock_get((int) $row['stock_id']);
        admin_notify('sns_manual', "投稿時刻です。{$label}に手動で投稿してください。\n「{$row['stock_title']}」\n\n"
            . admin_stock_render_body($stock, $row['platform']) . "\n\n投稿したら管理画面で「投稿済にする」を押してください。\n{$queueUrl}");
        $handled++;
    }

    // 送信中（コンテナ作成後の公開・再試行待ち）で、次の処理時刻が来た行
    $sending = admin_db()->prepare(
        "SELECT q.*, s.status AS stock_status, s.title AS stock_title FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
         WHERE q.status = 'sending' AND (q.next_attempt_at IS NULL OR q.next_attempt_at <= ?) ORDER BY q.next_attempt_at, q.id"
    );
    $sending->execute([$now->format(DATE_ATOM)]);
    foreach ($sending->fetchAll() as $row) {
        if ($autoBudget <= 0 || !admin_sns_has_publisher($row['platform'])) {
            continue;
        }
        $autoBudget--;
        $handled++;
        ('admin_sns_' . $row['platform'] . '_publish')($row, $now);
    }

    // 投稿済みで投稿URLだけ取れなかった行の補完（残りの枠で）
    if ($autoBudget > 0 && function_exists('admin_threads_backfill_permalinks')) {
        admin_threads_backfill_permalinks($now, $autoBudget);
    }
    return $handled;
}

/**
 * 自動投稿の部品があるのに未連携・連携エラーのとき：その枠はスキップし、ストックは未使用に戻す（ADMIN_IMPL_PLAN.md 14-6 Q4）。
 * 通知は SNS ごとに1日1回まで（settings に最終通知日を保存）。
 */
function admin_sns_skip_unconnected(array $row, DateTimeImmutable $now): void
{
    $label = admin_sns_label($row['platform']);
    admin_db()->prepare("UPDATE post_queue SET status = 'skipped', last_error = ?, next_attempt_at = NULL, updated_at = ? WHERE id = ?")
        ->execute([$label . 'と連携していない（または連携が切れている）ためスキップしました。ストックは未使用に戻りました', admin_now(), $row['id']]);
    admin_sns_notify_disconnected($row['platform'], $now, false, "「{$row['stock_title']}」の投稿をスキップしました（ストックは未使用に戻り、後の日に回ります）。");
}

/**
 * 「連携が切れています」の通知。$force=false なら同じ日に2回目以降は送らない（$force=true でも最終通知日は更新する）。
 * 戻り値：送ったか
 */
function admin_sns_notify_disconnected(string $platform, DateTimeImmutable $now, bool $force, string $detail = ''): bool
{
    $key = 'sns_disconnected_notified_on_' . $platform;
    $today = $now->format('Y-m-d');
    if (!$force && admin_setting($key) === $today) {
        return false;
    }
    admin_set_setting($key, $today);
    admin_notify('sns_disconnected', admin_sns_label($platform) . "の連携が切れています。連携し直してください（設定→SNS連携）。\n"
        . ($detail !== '' ? $detail . "\n" : '') . admin_absolute_admin_url('/sns/accounts'), true);
    return true;
}

/** 種別ごとの残り：['kind' => ['label', 'count', 'per_week', 'days']] */
function admin_sns_stock_days_left(): array
{
    $perWeek = [];
    foreach (admin_rotation_rules() as $rule) {
        $perWeek[$rule['kind']] = ($perWeek[$rule['kind']] ?? 0) + 1;
    }
    $result = [];
    foreach (admin_post_kinds(true) as $kind => $row) {
        $count = count(admin_sns_candidates($kind, 1000));
        $weekly = $perWeek[$kind] ?? 0;
        $result[$kind] = [
            'label'    => $row['label'],
            'count'    => $count,
            'per_week' => $weekly,
            'days'     => $weekly > 0 ? intdiv($count * 7, $weekly) : null,
        ];
    }
    return $result;
}

/** 差し替え・日時指定予約・枠外しで外す（削除する）行の状態。スキップ・失敗・投稿済などの履歴の行は残す */
const ADMIN_SNS_REMOVABLE_STATUSES = ['scheduled', 'held', 'canceled'];
const ADMIN_SNS_UNCONFIRMED_MESSAGE = '公開されたか確認できていない投稿があるため差し替えできません。履歴で再試行するか Threads 上を確認してください';

/** 失敗（failed）のうち、コンテナ作成済み（公開されたか確認できていない）の行があるか */
function admin_sns_slot_has_unconfirmed(array $rows): bool
{
    foreach ($rows as $row) {
        if ($row['status'] === 'failed' && (string) ($row['container_id'] ?? '') !== '') {
            return true;
        }
    }
    return false;
}

/** その枠の予約を外す（ADMIN_SNS_REMOVABLE_STATUSES の行だけ削除）。戻り値：削除した行数 */
function admin_sns_remove_slot_rows(string $date): int
{
    $placeholders = implode(', ', array_fill(0, count(ADMIN_SNS_REMOVABLE_STATUSES), '?'));
    $stmt = admin_db()->prepare("DELETE FROM post_queue WHERE slot_date = ? AND assigned_by <> ? AND status IN ({$placeholders})");
    $stmt->execute([$date, ADMIN_NOTE_LANE, ...ADMIN_SNS_REMOVABLE_STATUSES]);
    return $stmt->rowCount();
}

/**
 * 枠のストックを差し替える（取消・保留の枠にも使える）。投稿済・手動投稿待ち・送信中・削除済み、
 * 公開されたか確認できていない失敗（コンテナIDあり）を含む枠は不可。スキップ・失敗の行は履歴として残す
 */
function admin_sns_replace_slot(string $date, int $stockId): void
{
    $rows = admin_sns_slot_rows($date);
    foreach ($rows as $row) {
        if (in_array($row['status'], ['posted', 'manual_pending', 'sending', 'deleted'], true)) {
            throw new RuntimeException('投稿済・手動投稿待ち・送信中を含む枠は差し替えられません');
        }
    }
    if (admin_sns_slot_has_unconfirmed($rows)) {
        throw new RuntimeException(ADMIN_SNS_UNCONFIRMED_MESSAGE);
    }
    $rule = admin_rotation_rules()[(int) (new DateTimeImmutable($date))->format('w')] ?? null;
    $scheduledAt = $rows !== []
        ? new DateTimeImmutable($rows[0]['scheduled_at'])
        : admin_slot_scheduled_at($date, $rule['post_time'] ?? '20:00');
    $basePlatforms = $rule['platforms'] ?? array_values(array_diff(array_unique(array_column($rows, 'platform')), ['note']));

    $platforms = admin_sns_slot_platforms($basePlatforms, $stockId, $date);
    if ($platforms === []) {
        throw new RuntimeException('このストックには投稿先SNSの本文がありません');
    }
    admin_sns_remove_slot_rows($date);
    admin_sns_create_slot_rows($stockId, $date, $scheduledAt, $platforms, 'manual');
}

/** ユーザーによる取消：枠は空のまま残し、自動では埋め直さない */
function admin_sns_cancel_slot(string $date): void
{
    admin_db()->prepare(
        "UPDATE post_queue SET status = 'canceled', updated_at = ? WHERE slot_date = ? AND assigned_by <> ? AND status IN ('scheduled', 'held', 'manual_pending')"
    )->execute([admin_now(), $date, ADMIN_NOTE_LANE]);
}

/** 取消・保留の枠を外してストックを戻す（投稿時刻前なら次の毎時処理で自動割り当てされる） */
function admin_sns_release_slot(string $date): void
{
    admin_sns_remove_slot_rows($date);
}

/** アーカイブ・割り当てやり直しのとき：まだ投稿時刻が来ていない予約だけを外す */
function admin_sns_unschedule_stock(int $stockId): void
{
    admin_db()->prepare("DELETE FROM post_queue WHERE stock_id = ? AND status = 'scheduled'")->execute([$stockId]);
}

function admin_sns_reset_future_rotation(): void
{
    admin_db()->prepare("DELETE FROM post_queue WHERE assigned_by = 'rotation' AND status = 'scheduled' AND scheduled_at > ?")
        ->execute([admin_now()]);
}

function admin_sns_mark_posted(int $queueId, string $postUrl): void
{
    admin_db()->prepare(
        "UPDATE post_queue SET status = 'posted', posted_at = ?, post_url = ?, updated_at = ? WHERE id = ? AND status IN ('manual_pending', 'scheduled', 'held')"
    )->execute([admin_now(), $postUrl !== '' ? $postUrl : null, admin_now(), $queueId]);
    // note の枠なら「今日」の目標にも数える（note.php）
    admin_note_record_from_queue($queueId);
}

/**
 * 保留中の枠を、承認済みなら今から投稿する。
 * 自動投稿できるSNS（連携済みのThreads）は予約時刻を今にして次の毎分処理で自動投稿し、
 * 自動投稿の部品が無いSNS（note）は手動投稿待ちにする。未連携の自動投稿SNSの行は保留のまま残す。
 * 戻り値：['auto' => 自動投稿に回した件数, 'manual' => 手動投稿待ちにした件数, 'unconnected' => 未連携で残した件数]
 */
function admin_sns_held_post_now(string $date): array
{
    $stmt = admin_db()->prepare(
        "SELECT q.id, q.platform FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
         WHERE q.slot_date = ? AND q.assigned_by <> ? AND q.status = 'held' AND s.status = 'approved'"
    );
    $stmt->execute([$date, ADMIN_NOTE_LANE]);
    $result = ['auto' => 0, 'manual' => 0, 'unconnected' => 0];
    $toAuto = admin_db()->prepare(
        "UPDATE post_queue SET status = 'scheduled', scheduled_at = ?, last_error = NULL, updated_at = ? WHERE id = ? AND status = 'held'"
    );
    $toManual = admin_db()->prepare(
        "UPDATE post_queue SET status = 'manual_pending', last_error = NULL, updated_at = ? WHERE id = ? AND status = 'held'"
    );
    foreach ($stmt->fetchAll() as $row) {
        if (admin_sns_has_publisher($row['platform'])) {
            if (!admin_sns_is_connected($row['platform'])) {
                $result['unconnected']++;
                continue;
            }
            $toAuto->execute([admin_now(), admin_now(), $row['id']]);
            $result['auto'] += $toAuto->rowCount();
            continue;
        }
        $toManual->execute([admin_now(), $row['id']]);
        $result['manual'] += $toManual->rowCount();
    }
    return $result;
}

/**
 * 失敗した自動投稿の行を再試行する（履歴・投稿予定の「再試行」ボタン）。
 * 失敗回数を0に戻し、送信中にして次の毎分処理に回す。保存済みのコンテナIDがあれば、作り直す前にその状態を確認する（二重投稿防止）。
 * 差し替え前のストックの行（その日の今の割り当てと違うストックの行）は再試行できない。
 */
function admin_sns_retry(int $queueId): void
{
    $stmt = admin_db()->prepare('SELECT platform, slot_date, stock_id FROM post_queue WHERE id = ?');
    $stmt->execute([$queueId]);
    $row = $stmt->fetch() ?: ['platform' => '', 'slot_date' => '', 'stock_id' => 0];
    if (!admin_sns_has_publisher((string) $row['platform'])) {
        throw new RuntimeException('自動投稿できないSNSの枠は再試行できません');
    }
    if (admin_sns_slot_current_stock_id((string) $row['slot_date']) !== (int) $row['stock_id']) {
        throw new RuntimeException('この日は別のストックが予約されています');
    }
    $stmt = admin_db()->prepare(
        "UPDATE post_queue SET status = 'sending', attempts = 0, next_attempt_at = ?, last_error = NULL, updated_at = ?
         WHERE id = ? AND status = 'failed'"
    );
    $stmt->execute([admin_now(), admin_now(), $queueId]);
    if ($stmt->rowCount() !== 1) {
        throw new RuntimeException('失敗した投稿ではないため再試行できません');
    }
}
