<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/scheduler.php
 *
 * 投稿予定（post_queue）の割り当てと、投稿時刻の処理。
 *  - 毎時：先 ADMIN_ASSIGN_DAYS 日分の空いている投稿枠へ、曜日ごとの種別でストックを自動割り当て
 *  - 毎分：投稿時刻が来た行を処理（確認モードで未承認 → 保留＋通知 / 連携済み → 自動投稿 / それ以外 → 手動投稿待ち＋通知）
 *  - 毎日21時：翌日分の未承認リマインド、ストック残量の通知
 *
 * 投稿枠 = slot_date が同じ行の集まり。ユーザーが「取消」した枠は canceled の行が残り、自動では埋め直さない。
 * システムが外す場合（差し替え・アーカイブ・割り当てやり直し）は行を削除する。
 */

const ADMIN_ASSIGN_DAYS = 7;
const ADMIN_STOCK_LOW_DAYS = 3;

const ADMIN_QUEUE_STATUS_LABELS = [
    'scheduled'      => '予約中',
    'manual_pending' => '手動投稿待ち',
    'posted'         => '投稿済',
    'held'           => '保留（未承認）',
    'failed'         => '失敗',
    'canceled'       => '取消',
];

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

function admin_date_label(string $date): string
{
    $d = new DateTimeImmutable($date);
    return $d->format('n/j') . '（' . ADMIN_WEEKDAY_LABELS[(int) $d->format('w')] . '）';
}

/**
 * 割り当て候補のストック。一度もキューに載っていない（取消以外の行が無い）未承認・承認済のもの。
 * 承認済を優先し、古いものから。$kind=null なら全種別。
 */
function admin_sns_candidates(?string $kind, int $limit = 100): array
{
    $sql = "SELECT s.* FROM post_stock s
            WHERE s.status IN ('approved', 'pending_review')
              AND NOT EXISTS (SELECT 1 FROM post_queue q WHERE q.stock_id = s.id AND q.status <> 'canceled')"
        . ($kind !== null ? ' AND s.kind = ?' : '')
        . " ORDER BY CASE s.status WHEN 'approved' THEN 0 ELSE 1 END, s.id LIMIT " . (int) $limit;
    $stmt = admin_db()->prepare($sql);
    $stmt->execute($kind !== null ? [$kind] : []);
    return $stmt->fetchAll();
}

/** そのストックを投稿する SNS：ローテーションの投稿先のうち本文があるもの ＋ note本文があれば note */
function admin_sns_slot_platforms(array $rulePlatforms, int $stockId): array
{
    $stock = admin_stock_get($stockId);
    $platforms = array_values(array_filter($rulePlatforms, static fn (string $p): bool => isset($stock['bodies'][$p])));
    if (isset($stock['bodies']['note']) && !in_array('note', $platforms, true)) {
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
    $stmt = admin_db()->prepare('SELECT * FROM post_queue WHERE slot_date = ? ORDER BY id');
    $stmt->execute([$date]);
    return $stmt->fetchAll();
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
            $platforms = admin_sns_slot_platforms($rule['platforms'], (int) $candidate['id']);
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

    foreach ($rows as $row) {
        $label = admin_sns_label($row['platform']);
        if (admin_post_mode() === 'review' && $row['stock_status'] !== 'approved') {
            $update->execute(['held', '確認モードで未承認のため投稿しませんでした', admin_now(), $row['id']]);
            admin_notify('sns_held', "未承認のため投稿を保留しました（{$label}）\n「{$row['stock_title']}」\n{$queueUrl}");
            continue;
        }
        if (admin_sns_is_connected($row['platform'])) {
            // 自動投稿の部品は SNS 連携時に追加する（MVP では到達しない）
            continue;
        }
        $update->execute(['manual_pending', null, admin_now(), $row['id']]);
        $stock = admin_stock_get((int) $row['stock_id']);
        admin_notify('sns_manual', "投稿時刻です。{$label}に手動で投稿してください。\n「{$row['stock_title']}」\n\n"
            . admin_stock_render_body($stock, $row['platform']) . "\n\n投稿したら管理画面で「投稿済にする」を押してください。\n{$queueUrl}");
    }
    return count($rows);
}

/** 毎日21時：翌日分の未承認リマインドとストック残量の通知 */
function admin_sns_evening(?DateTimeImmutable $now = null): string
{
    $now ??= new DateTimeImmutable('now');
    $messages = [];

    if (admin_post_mode() === 'review') {
        $tomorrow = $now->modify('+1 day')->format('Y-m-d');
        $stmt = admin_db()->prepare(
            "SELECT DISTINCT s.title FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
             WHERE q.slot_date = ? AND q.status = 'scheduled' AND s.status <> 'approved'"
        );
        $stmt->execute([$tomorrow]);
        $titles = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if ($titles !== []) {
            admin_notify('sns_tomorrow_unapproved', '明日（' . admin_date_label($tomorrow) . '）の投稿がまだ承認されていません。'
                . "\n「" . implode('」「', $titles) . "」\n承認しないと投稿時刻に保留になります。\n" . admin_absolute_admin_url('/sns/'));
            $messages[] = '翌日の未承認 ' . count($titles) . '件を通知';
        }
    }

    $low = array_filter(admin_sns_stock_days_left(), static fn (array $k): bool => $k['per_week'] > 0 && $k['days'] < ADMIN_STOCK_LOW_DAYS);
    if ($low !== []) {
        $lines = array_map(static fn (array $k): string => $k['label'] . '：残り' . $k['count'] . '件（約' . $k['days'] . '日分）', $low);
        admin_notify('sns_stock_low', "投稿ストックが少なくなっています。\n" . implode("\n", $lines) . "\n" . admin_absolute_admin_url('/sns/stock'));
        $messages[] = 'ストック残少を通知';
    }
    return $messages === [] ? '通知なし' : implode('、', $messages);
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

/** 枠のストックを差し替える（取消・保留の枠にも使える）。投稿済・手動投稿待ちを含む枠は不可 */
function admin_sns_replace_slot(string $date, int $stockId): void
{
    $rows = admin_sns_slot_rows($date);
    foreach ($rows as $row) {
        if (in_array($row['status'], ['posted', 'manual_pending'], true)) {
            throw new RuntimeException('投稿済・手動投稿待ちを含む枠は差し替えられません');
        }
    }
    $rule = admin_rotation_rules()[(int) (new DateTimeImmutable($date))->format('w')] ?? null;
    $scheduledAt = $rows !== []
        ? new DateTimeImmutable($rows[0]['scheduled_at'])
        : admin_slot_scheduled_at($date, $rule['post_time'] ?? '20:00');
    $basePlatforms = $rule['platforms'] ?? array_values(array_diff(array_unique(array_column($rows, 'platform')), ['note']));

    $platforms = admin_sns_slot_platforms($basePlatforms, $stockId);
    if ($platforms === []) {
        throw new RuntimeException('このストックには投稿先SNSの本文がありません');
    }
    admin_db()->prepare('DELETE FROM post_queue WHERE slot_date = ?')->execute([$date]);
    admin_sns_create_slot_rows($stockId, $date, $scheduledAt, $platforms, 'manual');
}

/** ユーザーによる取消：枠は空のまま残し、自動では埋め直さない */
function admin_sns_cancel_slot(string $date): void
{
    admin_db()->prepare(
        "UPDATE post_queue SET status = 'canceled', updated_at = ? WHERE slot_date = ? AND status IN ('scheduled', 'held', 'manual_pending')"
    )->execute([admin_now(), $date]);
}

/** 取消・保留の枠を外してストックを戻す（投稿時刻前なら次の毎時処理で自動割り当てされる） */
function admin_sns_release_slot(string $date): void
{
    admin_db()->prepare("DELETE FROM post_queue WHERE slot_date = ? AND status IN ('scheduled', 'held', 'canceled')")
        ->execute([$date]);
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
}

/** 保留中の枠を、承認済みなら手動投稿待ちにする */
function admin_sns_held_to_manual(string $date): int
{
    $stmt = admin_db()->prepare(
        "UPDATE post_queue SET status = 'manual_pending', last_error = NULL, updated_at = ?
         WHERE slot_date = ? AND status = 'held' AND stock_id IN (SELECT id FROM post_stock WHERE status = 'approved')"
    );
    $stmt->execute([admin_now(), $date]);
    return $stmt->rowCount();
}
