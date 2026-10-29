<?php
declare(strict_types=1);

/**
 * api/threads-image.php
 *
 * Threads の画像付き投稿で、Threads（Meta）が image_url から画像を取りに来る先（ADMIN_IMPL_PLAN.md 18節）。
 * ?q=<投稿の行ID>&s=<署名>。署名が合い、その行がまだ投稿中（予約中・送信中）で、予定時刻の前後の間だけ画像を出す。
 * それ以外はすべて 404（どの条件で断ったかは返さない）。画像はデータ置き場にあり、ここ以外からは読めない。
 * ログインは不要（Meta が取りに来るため）。STG はサイト全体に Basic認証があるため、Meta は STG の画像を取りに来られない。
 */

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true)) {
    http_response_code(405);
    exit;
}

$image = null;
try {
    $image = admin_threads_image_for_serving((int) ($_GET['q'] ?? 0), (string) ($_GET['s'] ?? ''), new DateTimeImmutable('now'));
    $path = $image !== null ? admin_note_image_path((string) $image['file']) : null;
} catch (Throwable $e) {
    error_log('[threads-image] ' . get_class($e) . ': ' . $e->getMessage());
    $image = null;
}
if ($image === null || !is_file($path)) {
    http_response_code(404);
    exit;
}

header('Content-Type: ' . ($image['mime'] === 'image/png' ? 'image/png' : 'image/jpeg'));
header('Content-Length: ' . (string) filesize($path));
header('Cache-Control: no-store');
header('X-Robots-Tag: noindex, nofollow');
header('X-Content-Type-Options: nosniff');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    readfile($path);
}
