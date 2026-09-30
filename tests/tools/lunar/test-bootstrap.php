<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/test-bootstrap.php
 *
 * Lunar/Rokuyo スイート共通の読み込み（開発専用）。
 *   - E_ALL の警告・通知をすべて例外に変換する（警告0件を検証するため）
 *   - STG版 inc/oracle.php（getRokuyo / jdToLunar / myGregorianToJD）と
 *     inc/lunar-calendar.php（lunarFromJdn 等）を読み込む
 *   - STG版 sansei.php を GET として読み込み、出力を捨てて sansei_getRokuyo() を使えるようにする
 *     （oracle.php と同時に読み込んでも関数名衝突が起きないことの確認も兼ねる）
 *   ※このファイルは各テストのグローバルスコープで require すること
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');
set_error_handler(static function (int $no, string $msg, string $file, int $line): bool {
    throw new ErrorException($msg, 0, $no, $file, $line);
});

const LUNAR_STG_DIR = __DIR__ . '/../../../test.life-fun.net';

require_once LUNAR_STG_DIR . '/inc/oracle.php';
require_once LUNAR_STG_DIR . '/inc/lunar-calendar.php';

const LUNAR_ROKUYO_NAMES = ['大安', '赤口', '先勝', '友引', '先負', '仏滅'];

// sansei.php はグローバルスコープで読み込む必要がある（ページ内の global 参照のため、関数内 require は不可）
if (!function_exists('sansei_getRokuyo')) {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['PHP_SELF'] = '/sansei.php';
    ob_start();
    try {
        require LUNAR_STG_DIR . '/sansei.php';
    } finally {
        $lunarSanseiHtml = (string)ob_get_clean();
    }
    if (preg_match('/(Notice|Warning|Deprecated|Fatal error|Parse error):/i', $lunarSanseiHtml, $lunarM)) {
        throw new RuntimeException('sansei.php 読み込み時にPHPエラー出力: ' . $lunarM[0]);
    }
    unset($lunarSanseiHtml, $lunarM);
}

function lunar_ymd(int $jdn): string {
    [$m, $d, $y] = array_map('intval', explode('/', jdtogregorian($jdn)));
    return sprintf('%04d-%02d-%02d', $y, $m, $d);
}
