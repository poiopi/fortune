<?php
declare(strict_types=1);

/**
 * _admin-lib/jobs.php
 *
 * cron ディスパッチャが動かすジョブの定義と記録（ADMIN_IMPL_PLAN.md 2章：cronは1環境1本）。
 * 毎週のジョブは、処理を割り当てる段階（Phase 5）で ADMIN_JOBS に追加する。
 */

const ADMIN_JOBS = [
    // 毎分：生存記録（jobs テーブルの更新そのものが生存記録になる）＋投稿時刻が来たSNS投稿の処理
    'minutely' => ['label' => '毎分',            'schedule' => 'minutely'],
    // 毎時：SNS投稿の先7日分の自動割り当て
    'hourly'   => ['label' => '毎時',            'schedule' => 'hourly'],
    // 毎日 03:00：古い記録の削除
    'daily'    => ['label' => '毎日（深夜3時）', 'schedule' => 'daily', 'hour' => 3],
    // 毎日 21:00：翌日分の未承認リマインド・ストック残量の通知
    'evening'  => ['label' => '毎日（21時）',   'schedule' => 'daily', 'hour' => 21],
];

/** cron が止まっているとみなすまでの分数（警告バー・ダッシュボード） */
const ADMIN_CRON_STALE_MINUTES = 5;

/** 古い記録の保存日数 */
const ADMIN_RETENTION_DAYS = [
    'login_attempts' => ['column' => 'attempted_at', 'days' => 90],
    'audit_logs'     => ['column' => 'at',           'days' => 90],
    'cron_runs'      => ['column' => 'started_at',   'days' => 30],
    'notifications'  => ['column' => 'sent_at',      'days' => 90],
];

/** $now 時点で直近に来た実行予定時刻（これ以降に一度も動いていなければ実行する）。 */
function admin_job_last_slot(array $def, DateTimeImmutable $now): DateTimeImmutable
{
    switch ($def['schedule']) {
        case 'minutely':
            return $now->setTime((int) $now->format('H'), (int) $now->format('i'));
        case 'hourly':
            return $now->setTime((int) $now->format('H'), 0);
        case 'daily':
            $slot = $now->setTime($def['hour'], 0);
            return $slot > $now ? $slot->modify('-1 day') : $slot;
        default:
            throw new InvalidArgumentException('未対応のスケジュール: ' . $def['schedule']);
    }
}

function admin_job_state(string $job): ?array
{
    $stmt = admin_db()->prepare('SELECT * FROM jobs WHERE job = ?');
    $stmt->execute([$job]);
    return $stmt->fetch() ?: null;
}

function admin_job_is_due(string $job, DateTimeImmutable $now): bool
{
    $state = admin_job_state($job);
    if ($state === null || $state['last_started_at'] === null) {
        return true;
    }
    return new DateTimeImmutable($state['last_started_at']) < admin_job_last_slot(ADMIN_JOBS[$job], $now);
}

/**
 * ジョブを1つ実行して記録する。毎分ジョブは成功時に cron_runs へ書かない（jobs の更新のみ）。
 */
function admin_run_job(string $job, callable $handler): void
{
    $startedAt = admin_now();
    admin_db()->prepare(
        "INSERT INTO jobs (job, last_started_at, last_status) VALUES (?, ?, 'running')
         ON CONFLICT(job) DO UPDATE SET last_started_at = excluded.last_started_at, last_status = 'running'"
    )->execute([$job, $startedAt]);

    try {
        $message = (string) $handler();
        $status = 'ok';
    } catch (Throwable $e) {
        $message = get_class($e) . ': ' . $e->getMessage();
        $status = 'failed';
        error_log('[admin-cron] job ' . $job . ' failed: ' . $message);
    }

    $finishedAt = admin_now();
    admin_db()->prepare('UPDATE jobs SET last_finished_at = ?, last_status = ?, last_message = ? WHERE job = ?')
        ->execute([$finishedAt, $status, $message, $job]);

    if ($job !== 'minutely' || $status !== 'ok') {
        admin_db()->prepare('INSERT INTO cron_runs (job, started_at, finished_at, status, message) VALUES (?, ?, ?, ?, ?)')
            ->execute([$job, $startedAt, $finishedAt, $status, $message]);
    }
    if ($status !== 'ok') {
        admin_notify('cron_job_failed', 'cronジョブ「' . ADMIN_JOBS[$job]['label'] . '」が失敗しました。' . "\n" . $message);
    }
}

function admin_job_handler(string $job): callable
{
    return match ($job) {
        'minutely' => static fn (): string => ($n = admin_sns_process_due()) > 0 ? 'SNS投稿の時刻処理 ' . $n . '件' : '',
        'hourly'   => static fn (): string => 'SNS投稿の割り当て ' . admin_sns_assign() . '枠',
        'daily'    => 'admin_job_cleanup',
        'evening'  => static fn (): string => admin_sns_evening(),
    };
}

function admin_job_cleanup(): string
{
    $deleted = [];
    foreach (ADMIN_RETENTION_DAYS as $table => $rule) {
        $before = (new DateTimeImmutable('-' . $rule['days'] . ' days'))->format(DATE_ATOM);
        $stmt = admin_db()->prepare("DELETE FROM {$table} WHERE {$rule['column']} < ?");
        $stmt->execute([$before]);
        $deleted[] = $table . ' ' . $stmt->rowCount() . '件';
    }
    return '古い記録を削除：' . implode('、', $deleted);
}

/** cron の生存状況：['state' => 'ok'|'stale'|'never', 'last' => ?string] */
function admin_cron_health(): array
{
    $state = admin_job_state('minutely');
    if ($state === null || $state['last_started_at'] === null) {
        return ['state' => 'never', 'last' => null];
    }
    $stale = new DateTimeImmutable($state['last_started_at']) < new DateTimeImmutable('-' . ADMIN_CRON_STALE_MINUTES . ' minutes');
    return ['state' => $stale ? 'stale' : 'ok', 'last' => $state['last_started_at']];
}
