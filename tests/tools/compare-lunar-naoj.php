<?php
declare(strict_types=1);

/**
 * compare-lunar-naoj.php
 *
 * 旧暦テーブル（test.life-fun.net/inc/lunar-table.php）の朔の日付を、
 * 国立天文台「暦要項 朔弦望」（tests/cases/lunar-naoj-saku.php に固定済み）と照合する。
 *
 * 正解は国立天文台のデータ（現行出力ではない）。
 * PASS 条件: 採取できた全年について、朔の日付（JST暦日）が 100% 一致すること
 *           （国立天文台の朔がすべてテーブルにあり、その年のテーブルの朔もすべて国立天文台にある）。
 * 朔の時刻（分）の差は参考として最大値を表示する（国立天文台の表記は分単位）。
 *
 * 実行方法: php tests/tools/compare-lunar-naoj.php
 */

require __DIR__ . '/lunar/test-bootstrap.php';

$fx = require __DIR__ . '/../cases/lunar-naoj-saku.php';
$table = lunarTable();
$byJdn = [];
foreach ($table as $r) $byJdn[$r[0]] = $r;

$total = 0; $ok = 0; $fail = [];
$maxDiff = 0.0; $maxAt = '';
foreach ($fx['years'] as $year => $list) {
    $naojJdns = [];
    foreach ($list as [$date, $hm]) {
        $total++;
        [$y, $m, $d] = array_map('intval', explode('-', $date));
        [$hh, $mi] = array_map('intval', explode(':', $hm));
        $jdn = gregoriantojd($m, $d, $y);
        $naojJdns[$jdn] = true;
        if (!isset($byJdn[$jdn])) {
            $fail[] = "{$date} {$hm}: テーブルにこの日の朔がない";
            continue;
        }
        $ok++;
        $naojMoment = $jdn - 0.5 + ($hh * 60 + $mi) / 1440;
        $diff = ($byJdn[$jdn][3] - $naojMoment) * 1440; // 分（計算値 - 国立天文台）
        if (abs($diff) > abs($maxDiff)) { $maxDiff = $diff; $maxAt = "{$date} {$hm}"; }
    }
    // 逆方向：その年のテーブルの朔がすべて国立天文台にあるか
    $from = gregoriantojd(1, 1, (int)$year); $to = gregoriantojd(12, 31, (int)$year);
    foreach ($table as $r) {
        if ($r[0] >= $from && $r[0] <= $to && !isset($naojJdns[$r[0]])) {
            $fail[] = lunar_ymd($r[0]) . ': テーブルの朔が国立天文台に無い';
        }
    }
}

$years = array_keys($fx['years']);
echo "国立天文台 朔の日付照合: 対象 " . count($years) . "年（" . min($years) . '〜' . max($years) . "）\n";
if ($fx['unavailable']) echo '  取得不可の年: ' . implode(',', array_keys($fx['unavailable'])) . "\n";
printf("  一致 %d / %d 件 (%.1f%%)\n", $ok, $total, $total ? $ok * 100 / $total : 0);
printf("  朔時刻の差（計算値 - 国立天文台、分）: 最大 %+.2f 分（%s）\n", $maxDiff, $maxAt);

if ($total === 0 || $fail) {
    foreach ($fail as $f) echo "  FAIL {$f}\n";
    echo "FAIL\n";
    exit(1);
}
echo "PASS\n";
exit(0);
