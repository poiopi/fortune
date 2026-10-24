<?php
declare(strict_types=1);

/**
 * _admin-lib/qr.php
 *
 * QRコードをインラインSVGで描く（2段階認証の設定画面用）。
 * 符号化は同梱ライブラリ vendor/qrcode/qrcode.php（kazuhikoarase/qrcode-generator、MIT。出典は同じフォルダの SOURCE.txt）。
 * ここでは型番（大きさ）を選ぶことと、モジュールの白黒をSVGにすることだけを行う。
 * 外部CDN・インラインのstyle/scriptは使わない（CSP：img-src 'self' data:、style-src 'self'）。大きさは admin.css の .qr で指定する。
 * ライブラリはグローバルにクラス名・定数を定義するため、使う画面でだけ読み込む（bootstrap.php では読み込まない）。
 */

/** 文字列（バイト列そのまま・8bitモード）をQRにしたSVG要素。誤り訂正レベルM、周囲に4モジュールの余白。 */
function admin_qr_svg(string $text, string $label): string
{
    require_once __DIR__ . '/vendor/qrcode/qrcode.php';

    $level = QR_ERROR_CORRECT_LEVEL_M;
    $data = new QR8BitByte($text);
    $typeNumber = null;
    for ($t = 1; $t <= 40; $t++) {
        $capacityBits = 0;
        foreach (QRRSBlock::getRSBlocks($t, $level) as $block) {
            $capacityBits += $block->getDataCount() * 8;
        }
        if (4 + $data->getLengthInBits($t) + strlen($text) * 8 <= $capacityBits) {
            $typeNumber = $t;
            break;
        }
    }
    if ($typeNumber === null) {
        throw new RuntimeException('QRコードに入りきらない長さです');
    }

    $qr = new QRCode();
    $qr->setTypeNumber($typeNumber);
    $qr->setErrorCorrectLevel($level);
    $qr->addData($text, QR_MODE_8BIT_BYTE);
    $qr->make();

    $count = $qr->getModuleCount();
    $margin = 4;
    $size = $count + $margin * 2;
    $path = '';
    for ($r = 0; $r < $count; $r++) {
        for ($c = 0; $c < $count; $c++) {
            if ($qr->isDark($r, $c)) {
                $path .= 'M' . ($c + $margin) . ' ' . ($r + $margin) . 'h1v1h-1z';
            }
        }
    }

    return '<svg class="qr" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $size . ' ' . $size . '"'
        . ' role="img" aria-label="' . h($label) . '" shape-rendering="crispEdges">'
        . '<rect width="' . $size . '" height="' . $size . '" fill="#ffffff"/>'
        . '<path fill="#000000" d="' . $path . '"/></svg>';
}
