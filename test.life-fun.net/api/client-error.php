<?php
declare(strict_types=1);

/**
 * api/client-error.php
 *
 * 公開ページのJSエラー・姓名判断の未登録字を受け取り、管理画面のDBへ記録する（ADMIN_IMPL_PLAN.md 10章 A）。
 * 送り元は inc/footer.php の window.lfReport（navigator.sendBeacon）。中身の検証・回数制限は _admin-lib/monitor.php。
 * 何を受け取っても 204 だけを返す（記録したか・捨てたかは送り元に知らせない）。
 */

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$raw = (string) file_get_contents('php://input', false, null, 0, ADMIN_MONITOR_MAX_BODY + 1);
http_response_code(204);
try {
    admin_monitor_receive($raw);
} catch (Throwable $e) {
    error_log('[admin-monitor] ' . get_class($e) . ': ' . $e->getMessage());
}
