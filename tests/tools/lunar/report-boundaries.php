<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/report-boundaries.php
 *
 * 境界ケースのレポート（レポート専用。テストではない）。
 *
 * A. 朔が JST 0時の前後5分以内の18件：朔の時刻（JST、秒）・ΔT・テーブル上の朔日・
 *    国立天文台データがある年は照合結果
 * B. 中気が JST 0時の前後30分以内で朔の日と重なる5件（指示書の列挙。日付は低精度版での日付）：
 *    高精度/低精度の中気時刻と差、近くの朔の時刻、月番号の判定（高精度/低精度）と、
 *    中気が0時の反対側へずれた場合に月番号が変わるか（感度）
 * C. 高精度版で、中気が JST 0時の前後30分以内かつ朔の日と重なるもの（1900〜2100全件の再列挙）
 *
 * 実行方法: php tests/tools/lunar/report-boundaries.php
 */

require_once __DIR__ . '/lunar-builder.php';
require_once __DIR__ . '/fetch-arachne.php'; // lunar_saku_boundary_dates()

$table = require __DIR__ . '/../../../test.life-fun.net/inc/lunar-table.php';
$naoj = (require __DIR__ . '/../../cases/lunar-naoj-saku.php')['years'];
$byJdn = []; foreach ($table as $r) $byJdn[$r[0]] = $r;

function rb_k(float $moment): int { return (int)round(($moment - 2451550.09766) / 29.530588861); }
function rb_offMidnight(float $moment): float { // JST 0時からの符号付き秒（+: 0時より後）
    $f = $moment + 0.5 - floor($moment + 0.5);
    return ($f < 0.5 ? $f : $f - 1) * 86400;
}
function rb_ymd(int $jdn): string { [$m, $d, $y] = explode('/', jdtogregorian($jdn)); return sprintf('%04d-%02d-%02d', $y, $m, $d); }

echo "=== A. 朔の境界ケース（朔がJST 0時の前後5分以内）===\n";
echo "指定日       | 朔の時刻(JST)        | 0時から  | ΔT(秒) | テーブル朔日 | 国立天文台\n";
foreach (lunar_saku_boundary_dates() as $date) {
    [$y, $m, $d] = array_map('intval', explode('-', $date));
    $jdn = gregoriantojd($m, $d, $y);
    $row = null;
    foreach ([$jdn, $jdn - 1, $jdn + 1] as $j) if (isset($byJdn[$j])) { $row = $byJdn[$j]; break; }
    if ($row === null) { echo "{$date} | テーブルに近傍の朔なし\n"; continue; }
    $jde = astro_newMoonJDE(rb_k($row[3]));
    $dt = astro_deltaT($jde);
    $nj = '-（データなし）';
    if (isset($naoj[$y])) {
        $nj = '該当なし';
        foreach ($naoj[$y] as [$nd, $nt]) {
            if (abs(gregoriantojd((int)substr($nd, 5, 2), (int)substr($nd, 8, 2), (int)substr($nd, 0, 4)) - $row[0]) <= 1) {
                $nj = "{$nd} {$nt}" . ($nd === rb_ymd($row[0]) ? ' 日付一致' : ' 日付不一致');
            }
        }
    }
    printf("%s | %s | %+6.0f秒 | %6.2f | %s   | %s\n", $date, astro_momentToJstString($row[3]), rb_offMidnight($row[3]), $dt, rb_ymd($row[0]), $nj);
}

$hi = lunar_build(1899, 2101, 'high');
$lo = lunar_build(1899, 2101, 'low');
$fmtMonth = fn($e) => ($e['leap'] ? '閏' : '') . $e['month'];
$monthsAround = function (array $L, int $jdn) use ($fmtMonth): string {
    foreach ($L as $i => $e) {
        if ($e['jdn'] <= $jdn && (!isset($L[$i + 1]) || $L[$i + 1]['jdn'] > $jdn)) {
            $p = $L[$i - 1]; $n = $L[$i + 1];
            return "前月{$fmtMonth($p)}→当月{$fmtMonth($e)}→次月{$fmtMonth($n)}";
        }
    }
    return '?';
};

echo "\n=== B. 中気の境界ケース（指示書の5件）===\n";
foreach ([['1965-10-24', 210], ['2012-05-21', 60], ['2017-07-23', 120], ['2052-11-21', 240], ['2053-01-20', 300]] as [$date, $lon]) {
    [$y, $m, $d] = array_map('intval', explode('-', $date));
    $g = gregoriantojd($m, $d, $y);
    $mh = astro_jdeToJstMoment(astro_solarTermJDE((float)$lon, (float)$g, 'high'));
    $ml = astro_jdeToJstMoment(astro_solarTermJDE((float)$lon, (float)$g, 'low'));
    $jh = astro_momentToJdn($mh);
    $saku = null;
    foreach ($table as $r) if (abs($r[0] - $jh) <= 1) { $saku = $r; break; }
    echo "{$date} [{$lon}°]\n";
    printf("  中気 高精度 %s（0時から%+.1f分） / 低精度 %s（差 %+.1f分）\n",
        astro_momentToJstString($mh), rb_offMidnight($mh) / 60, astro_momentToJstString($ml), ($ml - $mh) * 1440);
    echo '  近くの朔     ' . ($saku ? astro_momentToJstString($saku[3]) : 'なし') . "\n";
    echo '  月番号 高精度: ' . $monthsAround($hi, $jh) . "\n";
    echo '  月番号 低精度: ' . $monthsAround($lo, $jh) . "\n";
    // 感度：高精度の中気を0時の反対側へ（時刻差+1分だけ）ずらした場合
    $shift = -(rb_offMidnight($mh) / 60) + (rb_offMidnight($mh) >= 0 ? -1 : 1);
    $alt = lunar_build($y - 1, $y + 1, 'high', ["{$lon}@" . jdtogregorian($jh) => $shift]);
    $base = lunar_build($y - 1, $y + 1, 'high');
    $changed = [];
    foreach ($base as $i => $e) {
        if ($e['month'] !== $alt[$i]['month'] || $e['leap'] !== $alt[$i]['leap']) {
            $changed[] = rb_ymd($e['jdn']) . "朔の月 {$fmtMonth($e)}→{$fmtMonth($alt[$i])}";
        }
    }
    echo '  感度（中気が0時の反対側の日付だった場合）: ' . ($changed ? '月番号が変わる: ' . implode(', ', $changed) : '月番号は変わらない') . "\n";
}

echo "\n=== C. 高精度版で「中気がJST 0時の前後30分以内かつ朔の日（前後1日）と重なる」もの（1900〜2100）===\n";
$sakuDays = []; foreach ($table as $r) $sakuDays[$r[0]] = true;
for ($y = 1900; $y <= 2100; $y++) {
    foreach (range(0, 330, 30) as $lon) {
        $mh = astro_jdeToJstMoment(astro_solarTermJDE((float)$lon, gregoriantojd(3, 20, $y) + $lon / 360 * 365.2422, 'high'));
        $off = rb_offMidnight($mh);
        if (abs($off) >= 1800) continue;
        $j = astro_momentToJdn($mh);
        $other = $off >= 0 ? $j - 1 : $j + 1;
        if (isset($sakuDays[$j]) || isset($sakuDays[$other])) {
            printf("  %s [%3d°] 0時から%+.1f分\n", astro_momentToJstString($mh), $lon, $off / 60);
        }
    }
}
