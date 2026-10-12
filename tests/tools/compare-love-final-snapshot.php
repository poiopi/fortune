<?php
declare(strict_types=1);

/**
 * compare-love-final-snapshot.php
 *
 * tests/cases/love-final-snapshot.php が、今の inc から生成し直した結果と generatedAt 以外すべて一致することを検査する
 * （run-all の 'Love Engine' / 'Final Snapshot'）。
 * 照合のロジックは持たない。compare-love-composer-snapshot.php --target=final をそのまま呼び出し、終了コードを返すだけ。
 *
 * 実行方法: php tests/tools/compare-love-final-snapshot.php [--expect=<ファイル>]
 *   --expect は、わざと壊したコピーで FAIL することを確かめるときだけ使う（そのまま compare-love-composer-snapshot.php に渡す）。
 * 終了コード: 0=ALL PASS / 1=FAIL あり（compare-love-composer-snapshot.php の終了コード）
 */

$opts = getopt('', ['expect:']);
$cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__DIR__ . '/compare-love-composer-snapshot.php') . ' --target=final'
    . (isset($opts['expect']) ? ' --expect=' . escapeshellarg($opts['expect']) : '');
passthru($cmd, $code);
exit($code);
