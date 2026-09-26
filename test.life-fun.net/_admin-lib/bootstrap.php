<?php
declare(strict_types=1);

/**
 * _admin-lib/bootstrap.php
 *
 * 管理画面の各ページの先頭で読み込む共通処理。
 *   require_once __DIR__ . '/../_admin-lib/bootstrap.php';
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/audit.php';
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/crypto.php';
require_once __DIR__ . '/notify.php';
require_once __DIR__ . '/jobs.php';
require_once __DIR__ . '/sns/platforms.php';
require_once __DIR__ . '/sns/stock.php';
require_once __DIR__ . '/sns/import.php';
require_once __DIR__ . '/sns/scheduler.php';

date_default_timezone_set(admin_config()['timezone']);

// エラー内容は画面に出さず、データ置き場のログにだけ残す
ini_set('display_errors', '0');
ini_set('log_errors', '1');
try {
    ini_set('error_log', admin_ensure_data_dir() . '/php-error.log');
} catch (Throwable $e) {
    // データ置き場を作れない場合はサーバー既定のログのまま
}

/**
 * Webリクエストか（cronからの実行ではないか）。
 * ロリポップcronのSAPIが cli か cgi か未確認のため、SAPIではなく REQUEST_METHOD の有無で判定する。
 */
function admin_is_web(): bool
{
    return isset($_SERVER['REQUEST_METHOD']);
}

if (admin_is_web()) {
    header('X-Robots-Tag: noindex, nofollow');
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: same-origin');
    header('Cache-Control: no-store');
    header("Content-Security-Policy: default-src 'self'; style-src 'self'; script-src 'self'; img-src 'self' data:; frame-ancestors 'none'; form-action 'self'; base-uri 'none'");

    set_exception_handler(static function (Throwable $e): void {
        error_log('[admin] ' . get_class($e) . ': ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
        if (!headers_sent()) {
            http_response_code(500);
        }
        echo '<!DOCTYPE html><html lang="ja"><head><meta charset="utf-8"><meta name="robots" content="noindex, nofollow">'
            . '<title>エラー</title></head><body><h1>エラーが発生しました</h1>'
            . '<p>時間をおいてもう一度お試しください。続く場合は管理者に連絡してください。</p></body></html>';
    });
} else {
    // cron から実行された場合：HTMLではなく短いテキストを出す（cron結果メールに載る）
    set_exception_handler(static function (Throwable $e): void {
        error_log('[admin-cron] ' . get_class($e) . ': ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
        echo 'admin cron error: ', get_class($e), ': ', $e->getMessage(), "\n";
        exit(1);
    });
}
