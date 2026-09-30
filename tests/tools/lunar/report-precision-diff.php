<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/report-precision-diff.php
 *
 * 中気の計算精度による差の一覧（レポート専用。テストではない）。
 *   高精度: Meeus ch.32 VSOP87省略版＋ch.22章動＋光行差（テーブル生成に使用）
 *   低精度: Meeus ch.25 冒頭の低精度式（誤差 最大約0.01°≒15分）
 * 1900-01〜2100-12 に朔がある全朔望月について、月番号・閏フラグの差異を列挙する。
 * あわせて、中気の日付（JST暦日）が両者で変わるものと、中気時刻の差の最大値を表示する。
 *
 * 実行方法: php tests/tools/lunar/report-precision-diff.php
 */

require_once __DIR__ . '/lunar-builder.php';

$hi = lunar_build(1899, 2101, 'high');
$lo = lunar_build(1899, 2101, 'low');
if (count($hi) !== count($lo)) { echo "朔望月数が異なる\n"; exit(1); }

$from = gregoriantojd(1, 1, 1900); $to = gregoriantojd(12, 31, 2100);
$n = 0; $diffs = []; $termDayDiffs = []; $maxMin = 0.0; $maxAt = '';
foreach ($hi as $i => $h) {
    $l = $lo[$i];
    if ($h['jdn'] !== $l['jdn']) { echo "朔の日付が異なる（あり得ない）\n"; exit(1); }
    if ($h['jdn'] < $from || $h['jdn'] > $to) continue;
    $n++;
    $fmt = fn($e) => ($e['leap'] ? '閏' : '') . $e['month'] . '月';
    if ($h['month'] !== $l['month'] || $h['leap'] !== $l['leap']) {
        $diffs[] = sprintf('%s 朔: 高精度=%s 低精度=%s', astro_momentToJstString($h['moment']), $fmt($h), $fmt($l));
    }
}

// 中気単位の比較（1900-2100）
for ($y = 1900; $y <= 2100; $y++) {
    foreach (range(0, 330, 30) as $lon) {
        $g = gregoriantojd(3, 20, $y) + $lon / 360 * 365.2422;
        $mh = astro_jdeToJstMoment(astro_solarTermJDE((float)$lon, $g, 'high'));
        $ml = astro_jdeToJstMoment(astro_solarTermJDE((float)$lon, $g, 'low'));
        $dm = ($ml - $mh) * 1440;
        if (abs($dm) > abs($maxMin)) { $maxMin = $dm; $maxAt = astro_momentToJstString($mh) . " [{$lon}°]"; }
        if (astro_momentToJdn($mh) !== astro_momentToJdn($ml)) {
            $termDayDiffs[] = sprintf('[%3d°] 高精度 %s / 低精度 %s', $lon, astro_momentToJstString($mh), astro_momentToJstString($ml));
        }
    }
}

echo "対象: 1900-01〜2100-12 に朔がある {$n} 朔望月\n";
echo '月番号・閏フラグの差異: ' . count($diffs) . " 件\n";
foreach ($diffs as $d) echo "  {$d}\n";
printf("中気時刻の差（低精度 - 高精度）: 最大 %+.1f 分（%s）\n", $maxMin, $maxAt);
echo '中気の日付（JST暦日）が変わるもの: ' . count($termDayDiffs) . " 件\n";
foreach ($termDayDiffs as $d) echo "  {$d}\n";
