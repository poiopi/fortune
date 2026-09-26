<?php
declare(strict_types=1);

/**
 * _admin-lib/cron/dispatch.php
 *
 * ロリポップ cron から毎分実行するディスパッチャ（1環境1本。ADMIN_IMPL_PLAN.md 2章）。
 *   cron 実行ファイルパス（STG）：test.life-fun.net/_admin-lib/cron/dispatch.php
 * 正常時は何も出力しない（cron 結果メールが毎分届くのを防ぐ）。
 */

// Webからは実行させない（_admin-lib/.htaccess でも拒否済み。二重の守り）
if (isset($_SERVER['REQUEST_METHOD'])) {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../cron-probe.php';

$lockFile = admin_ensure_data_dir() . '/dispatch.lock';
$lock = fopen($lockFile, 'c');
if ($lock === false) {
    throw new RuntimeException('ロックファイルを開けません');
}

// 前回の処理がまだ動いていれば、今回は何もしない
if (flock($lock, LOCK_EX | LOCK_NB)) {
    try {
        $now = new DateTimeImmutable('now');
        foreach (array_keys(ADMIN_JOBS) as $job) {
            if (admin_job_is_due($job, $now)) {
                admin_run_job($job, admin_job_handler($job));
            }
        }
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

// cron 実行時間テストは長時間動くため、メインのロックを外してから実行する
if (admin_claim_cron_probe()) {
    admin_run_cron_probe();
}
