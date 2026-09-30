<?php
declare(strict_types=1);

/**
 * compare-lunar-arachne.php
 *
 * 六曜（oracle.php の getRokuyo() と sansei.php の sansei_getRokuyo()）を、外部カレンダー
 * （暦のページ arachne.jp。tests/cases/lunar-arachne-rokuyo.php に固定済み）と全日照合する。
 *
 * 正解は外部カレンダーのデータ（現行出力ではない）。
 * PASS 条件: 採取できた全日で 100% 一致すること。
 * 不一致時は、その日の旧暦（計算値）・朔の時刻・近くの中気の情報を表示する。
 *
 * 実行方法: php tests/tools/compare-lunar-arachne.php
 */

require __DIR__ . '/lunar/test-bootstrap.php';

$fx = require __DIR__ . '/../cases/lunar-arachne-rokuyo.php';

$total = 0; $ok = 0; $fails = [];
foreach ($fx['days'] as $date => $expected) {
    $total++;
    [$y, $m, $d] = array_map('intval', explode('-', $date));
    $o = getRokuyo($y, $m, $d)['name'];
    $s = sansei_getRokuyo($y, $m, $d)['name'];
    if ($o === $expected && $s === $expected) { $ok++; continue; }
    $l = lunarFromJdn(gregoriantojd($m, $d, $y));
    $fails[] = sprintf('%s 期待=%s getRokuyo=%s sansei=%s 旧暦(計算)=%s%d/%d',
        $date, $expected, $o, $s, $l && $l['leap'] ? '閏' : '', $l['month'] ?? 0, $l['day'] ?? 0);
}

$months = $fx['fetched'];
echo '外部カレンダー(arachne) 六曜照合: ' . count($months) . " か月 / {$total} 日\n";
if ($fx['unavailable']) {
    echo '  取得不可の月: ';
    foreach ($fx['unavailable'] as $ym => $why) echo "{$ym}({$why}) ";
    echo "\n";
}
printf("  一致 %d / %d 日 (%.2f%%)\n", $ok, $total, $total ? $ok * 100 / $total : 0);
if ($total === 0 || $fails) {
    foreach ($fails as $f) echo "  FAIL {$f}\n";
    echo "FAIL\n";
    exit(1);
}
echo "PASS\n";
exit(0);
