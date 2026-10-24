<?php
declare(strict_types=1);

// note 用の画像を出す（ログイン中だけ）。?id=<画像ID>、&download=1 で保存（ダウンロード）。
// 画像はデータ置き場（Webから読めない場所）にあるため、この画面を通して出す。保存時にサーバーで作り直した PNG・JPEG だけを扱う。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

$image = admin_note_image_get((int) ($_GET['id'] ?? 0));
$path = $image !== null ? admin_note_image_path((string) $image['file']) : null;
if ($image === null || !is_file($path)) {
    http_response_code(404);
    exit;
}
$stock = admin_stock_get((int) $image['stock_id']);
$base = preg_replace('/[^A-Za-z0-9_.-]/', '', (string) ($stock['ext_id'] ?? '')) ?: 'stock-' . (int) $image['stock_id'];
$name = $base . '-' . ($image['role'] === 'eyecatch' ? 'eyecatch' : 'image' . (int) $image['seq']) . ($image['mime'] === 'image/png' ? '.png' : '.jpg');

header('Content-Type: ' . ($image['mime'] === 'image/png' ? 'image/png' : 'image/jpeg'));
header('Content-Length: ' . (string) filesize($path));
header('Content-Disposition: ' . (isset($_GET['download']) ? 'attachment' : 'inline') . '; filename="' . $name . '"');
header('Cache-Control: private, max-age=300');
readfile($path);
