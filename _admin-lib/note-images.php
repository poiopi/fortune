<?php
declare(strict_types=1);

/**
 * _admin-lib/note-images.php
 *
 * ストックに付ける note 用の画像（見出し画像1枚・本文中の画像 最大5枚）。
 * - 受け付けるのは PNG・JPEG だけ。5MB まで。サーバー（GD）で画像を作り直してから保存する
 *   （画像に見せかけたファイル・埋め込まれた情報〈撮影場所など〉を取り除くため。ADMIN_FULLSPEC_PROPOSAL.md N8）
 * - 保存先はデータ置き場の note-images/（Webからは読めない。Git・アップロードの対象外）。画面へは admin/sns/stock-image.php から出す
 * - 毎日のバックアップ（データベースだけ）には入らない。元の画像は手元の docs/sns-stock/note-images/ に残す
 */

const ADMIN_NOTE_IMAGE_DIR = 'note-images';
const ADMIN_NOTE_IMAGE_MAX_BYTES = 5 * 1024 * 1024;
/** 長い辺がこれを超えたら縮める（note の推奨より十分大きい値） */
const ADMIN_NOTE_IMAGE_MAX_SIDE = 2560;
const ADMIN_NOTE_IMAGE_BODY_MAX = 5;
const ADMIN_NOTE_IMAGE_ROLES = ['eyecatch' => '見出し画像', 'body' => '本文の画像'];

/** ストックの画像（見出し画像 → 本文の画像1, 2, … の順） */
function admin_note_images(int $stockId): array
{
    $stmt = admin_db()->prepare("SELECT * FROM post_stock_images WHERE stock_id = ? ORDER BY CASE role WHEN 'eyecatch' THEN 0 ELSE 1 END, seq");
    $stmt->execute([$stockId]);
    return $stmt->fetchAll();
}

function admin_note_image_get(int $imageId): ?array
{
    $stmt = admin_db()->prepare('SELECT * FROM post_stock_images WHERE id = ?');
    $stmt->execute([$imageId]);
    return $stmt->fetch() ?: null;
}

/** 画像の名前（画面・保存するファイル名に使う）：「見出し画像」「画像1」 */
function admin_note_image_label(array $image): string
{
    return $image['role'] === 'eyecatch' ? '見出し画像' : '画像' . (int) $image['seq'];
}

function admin_note_image_path(string $file): string
{
    if (preg_match('/^[a-z0-9-]+\.(?:png|jpg)$/', $file) !== 1) {
        throw new RuntimeException('画像のファイル名が不正です');
    }
    return admin_data_path(ADMIN_NOTE_IMAGE_DIR . '/' . $file);
}

/**
 * 画像を保存する（同じ役割・番号の画像があれば置き換える）。$tmpPath はアップロードされた一時ファイル。
 * 戻り値：保存した行のID。受け付けられないときは InvalidArgumentException（画面に出す文）
 */
function admin_note_image_save(int $stockId, string $role, int $seq, string $tmpPath): int
{
    if (!isset(ADMIN_NOTE_IMAGE_ROLES[$role])) {
        throw new InvalidArgumentException('画像の種類が正しくありません');
    }
    $seq = $role === 'eyecatch' ? 0 : $seq;
    if ($role === 'body' && ($seq < 1 || $seq > ADMIN_NOTE_IMAGE_BODY_MAX)) {
        throw new InvalidArgumentException('本文の画像の番号は 1〜' . ADMIN_NOTE_IMAGE_BODY_MAX . ' です');
    }
    if (admin_stock_get($stockId) === null) {
        throw new InvalidArgumentException('ストックが見つかりません');
    }
    if (!function_exists('imagecreatefrompng')) {
        throw new InvalidArgumentException('サーバーで画像を扱う機能（GD）が使えないため、画像を保存できません');
    }
    $bytes = @filesize($tmpPath);
    if ($bytes === false || $bytes === 0) {
        throw new InvalidArgumentException('画像ファイルを読めません');
    }
    if ($bytes > ADMIN_NOTE_IMAGE_MAX_BYTES) {
        throw new InvalidArgumentException('画像が大きすぎます（5MBまで）');
    }
    $info = @getimagesize($tmpPath);
    if ($info === false || !in_array($info[2], [IMAGETYPE_PNG, IMAGETYPE_JPEG], true)) {
        throw new InvalidArgumentException('PNG か JPEG の画像だけ使えます');
    }
    if ($info[0] < 1 || $info[1] < 1 || $info[0] * $info[1] > 40_000_000) {
        throw new InvalidArgumentException('画像の大きさ（縦横のピクセル数）が扱えない値です');
    }

    // 作り直す：読み込み → （大きすぎれば縮小）→ 書き出し。元のファイルはそのまま使わない
    $isPng = $info[2] === IMAGETYPE_PNG;
    $src = $isPng ? @imagecreatefrompng($tmpPath) : @imagecreatefromjpeg($tmpPath);
    if ($src === false) {
        throw new InvalidArgumentException('画像を読み込めません（壊れている可能性があります）');
    }
    [$w, $h] = [imagesx($src), imagesy($src)];
    $scale = min(1, ADMIN_NOTE_IMAGE_MAX_SIDE / max($w, $h));
    [$nw, $nh] = [max(1, (int) round($w * $scale)), max(1, (int) round($h * $scale))];
    $dst = imagecreatetruecolor($nw, $nh);
    if ($isPng) {
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagefill($dst, 0, 0, imagecolorallocatealpha($dst, 0, 0, 0, 127));
    }
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);
    imagedestroy($src);

    $dir = admin_assert_writable_path(admin_data_path(ADMIN_NOTE_IMAGE_DIR));
    if (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir)) {
        imagedestroy($dst);
        throw new RuntimeException('画像の保存先フォルダを作れません');
    }
    $file = $stockId . '-' . $role . '-' . $seq . '-' . bin2hex(random_bytes(6)) . ($isPng ? '.png' : '.jpg');
    $path = admin_assert_writable_path(admin_note_image_path($file));
    $ok = $isPng ? imagepng($dst, $path, 6) : imagejpeg($dst, $path, 90);
    imagedestroy($dst);
    if (!$ok) {
        @unlink($path);
        throw new RuntimeException('画像を保存できません');
    }
    @chmod($path, 0600);

    $old = admin_db()->prepare('SELECT * FROM post_stock_images WHERE stock_id = ? AND role = ? AND seq = ?');
    $old->execute([$stockId, $role, $seq]);
    $oldRow = $old->fetch();
    admin_db()->prepare(
        'INSERT INTO post_stock_images (stock_id, role, seq, file, mime, width, height, bytes, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
         ON CONFLICT(stock_id, role, seq) DO UPDATE SET file = excluded.file, mime = excluded.mime, width = excluded.width,
           height = excluded.height, bytes = excluded.bytes, created_at = excluded.created_at'
    )->execute([$stockId, $role, $seq, $file, $isPng ? 'image/png' : 'image/jpeg', $nw, $nh, (int) filesize($path), admin_now()]);
    if ($oldRow !== false) {
        @unlink(admin_assert_writable_path(admin_note_image_path((string) $oldRow['file'])));
    }
    $stmt = admin_db()->prepare('SELECT id FROM post_stock_images WHERE stock_id = ? AND role = ? AND seq = ?');
    $stmt->execute([$stockId, $role, $seq]);
    return (int) $stmt->fetchColumn();
}

/**
 * 「今日」画面・1本道に出す画像の並び（縮小表示と「保存」ボタン）。画像が無ければ空文字。
 * 見出し画像は note の「見出し画像を追加」へ、本文の画像は本文の［画像n］の位置へ入れる、と添える。
 * $body（note の本文）に目印が無い画像は「好きな位置へ」と添える
 */
function admin_note_render_images(array $images, string $body = ''): string
{
    if ($images === []) {
        return '';
    }
    $html = '<div class="image-grid">';
    foreach ($images as $image) {
        $label = admin_note_image_label($image);
        $src = admin_url('/sns/stock-image?id=' . (int) $image['id']);
        $hint = $image['role'] === 'eyecatch' ? 'noteの「見出し画像を追加」へ'
            : (str_contains($body, '［' . $label . '］') ? '本文の［' . h($label) . '］の行を消して、その位置へ' : '本文の入れたい位置へ（本文に目印はありません）');
        $html .= '<figure class="image-card"><img src="' . h($src) . '" alt="' . h($label) . '" loading="lazy">'
            . '<figcaption><strong>' . h($label) . '</strong>　' . $hint . '</figcaption>'
            . '<a class="btn btn--ghost btn--small" href="' . h($src . '&download=1') . '">' . h($label) . 'を保存</a></figure>';
    }
    return $html . '</div>';
}

function admin_note_image_delete(int $imageId): ?array
{
    $image = admin_note_image_get($imageId);
    if ($image === null) {
        return null;
    }
    admin_db()->prepare('DELETE FROM post_stock_images WHERE id = ?')->execute([$imageId]);
    @unlink(admin_assert_writable_path(admin_note_image_path((string) $image['file'])));
    return $image;
}
