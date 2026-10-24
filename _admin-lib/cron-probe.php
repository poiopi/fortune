<?php
declare(strict_types=1);

/**
 * _admin-lib/cron-probe.php
 *
 * cron 実行時間テスト（ADMIN_IMPL_PLAN.md P5）。設定画面のボタンで予約し、次の cron で1回だけ動く。
 * cron 環境の PHP 情報と外部HTTPS接続を記録し、10秒ごとに生存時刻を書きながら最大 ADMIN_PROBE_MAX_SECONDS 秒待つ。
 * 途中でサーバーに止められた場合、最後に書かれた秒数が「実際に動ける上限の目安」になる。
 *
 * 設定キー：cron_probe_status（requested / running / done）、cron_probe_result（JSON）
 */

const ADMIN_PROBE_MAX_SECONDS = 300;
const ADMIN_PROBE_INTERVAL = 10;

function admin_request_cron_probe(): void
{
    admin_set_setting('cron_probe_status', 'requested');
    admin_delete_setting('cron_probe_result');
}

/** 予約されていれば実行権を取って true（同時に2つの cron が動いても1つだけが実行する）。 */
function admin_claim_cron_probe(): bool
{
    $stmt = admin_db()->prepare(
        "UPDATE settings SET value = 'running', updated_at = ? WHERE key = 'cron_probe_status' AND value = 'requested'"
    );
    $stmt->execute([admin_now()]);
    return $stmt->rowCount() === 1;
}

function admin_run_cron_probe(): void
{
    $result = [
        'started_at'         => admin_now(),
        'php_version'        => PHP_VERSION,
        'sapi'               => PHP_SAPI,
        'max_execution_time' => (string) ini_get('max_execution_time'),
        'memory_limit'       => (string) ini_get('memory_limit'),
        'https'              => [],
        'alive_seconds'      => 0,
        'last_alive_at'      => admin_now(),
        'finished'           => false,
    ];

    foreach (['https://discord.com/api/v10/gateway', admin_config()['site_url'] . '/robots.txt'] as $url) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 10]);
        curl_exec($ch);
        $result['https'][$url] = curl_errno($ch) !== 0
            ? 'error ' . curl_errno($ch)
            : (string) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
    admin_set_setting('cron_probe_result', json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

    // PHP 側の上限は記録済みなので外し、サーバー側で止められるまでの時間を測る
    set_time_limit(0);
    $start = time();
    while (time() - $start < ADMIN_PROBE_MAX_SECONDS) {
        sleep(ADMIN_PROBE_INTERVAL);
        $result['alive_seconds'] = time() - $start;
        $result['last_alive_at'] = admin_now();
        admin_set_setting('cron_probe_result', json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    $result['finished'] = true;
    admin_set_setting('cron_probe_result', json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    admin_set_setting('cron_probe_status', 'done');
}

/**
 * 画面表示用：['status' => 'none'|'requested'|'running'|'done'|'stopped', 'result' => ?array]
 * running のまま生存時刻が 3 × 間隔 以上更新されていなければ「途中で止められた」とみなす。
 */
function admin_cron_probe_view(): array
{
    $status = admin_setting('cron_probe_status') ?? 'none';
    $json = admin_setting('cron_probe_result');
    $result = $json === null ? null : json_decode($json, true);

    if ($status === 'running' && is_array($result)
        && strtotime($result['last_alive_at']) < time() - ADMIN_PROBE_INTERVAL * 3) {
        $status = 'stopped';
    }
    return ['status' => $status, 'result' => is_array($result) ? $result : null];
}
