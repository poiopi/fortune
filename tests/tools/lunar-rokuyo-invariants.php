<?php
declare(strict_types=1);

/**
 * lunar-rokuyo-invariants.php
 *
 * 旧暦テーブルと六曜計算が 1900-01-01〜2100-12-31 の全日で満たすべき性質を検証する。
 * （test-bootstrap.php により E_ALL の警告・通知はすべて例外＝FAIL 扱い）
 *
 *   1. 全日で lunarFromJdn() が null にならない（テーブル範囲内。近似式へのフォールバックが起きない）
 *   2. jdToLunar() の月・日がテーブル（lunarFromJdn）と一致する
 *   3. myGregorianToJD() が gregoriantojd() と同じ JDN を返す（テーブルのJDN体系と一致）
 *   4. 旧1/1 と 旧7/1 は先勝（閏7月の1日も月番号7なので先勝）
 *   5. 旧暦の月の長さは 29日 か 30日
 *   6. 旧暦の1年（旧1/1 から次の旧1/1 まで）は 12ヶ月 か 13ヶ月。13ヶ月の年だけ閏月が1つある
 *   7. oracle.php の getRokuyo() と sansei.php の sansei_getRokuyo() の六曜名が全日で一致する
 *   8. 六曜は (旧暦月 + 旧暦日) % 6 で決まる（閏月は元の月番号）
 *
 * 実行方法: php tests/tools/lunar-rokuyo-invariants.php
 */

require __DIR__ . '/lunar/test-bootstrap.php';

$fails = [];
$fail = function (string $msg) use (&$fails) { if (count($fails) < 50) $fails[] = $msg; else $fails[50] = '...（以下省略）'; };

$from = gregoriantojd(1, 1, 1900);
$to   = gregoriantojd(12, 31, 2100);
$days = 0; $newYear = 0; $shichigatsu = 0;

try {
    for ($jdn = $from; $jdn <= $to; $jdn++) {
        $days++;
        [$m, $d, $y] = array_map('intval', explode('/', jdtogregorian($jdn)));
        $ymd = sprintf('%04d-%02d-%02d', $y, $m, $d);

        if (myGregorianToJD($y, $m, $d) !== $jdn) $fail("{$ymd}: myGregorianToJD と gregoriantojd が不一致");

        $l = lunarFromJdn($jdn);
        if ($l === null) { $fail("{$ymd}: lunarFromJdn が null（テーブル範囲外）"); continue; }

        $j = jdToLunar($jdn);
        if ($j['month'] !== $l['month'] || $j['day'] !== $l['day']) $fail("{$ymd}: jdToLunar とテーブルが不一致");

        $name = getRokuyo($y, $m, $d)['name'];
        if ($name !== LUNAR_ROKUYO_NAMES[($l['month'] + $l['day']) % 6]) $fail("{$ymd}: 六曜が (月+日)%6 と不一致");
        if (sansei_getRokuyo($y, $m, $d)['name'] !== $name) $fail("{$ymd}: getRokuyo と sansei_getRokuyo が不一致");

        if ($l['day'] === 1 && ($l['month'] === 1 || $l['month'] === 7)) {
            if ($l['month'] === 1 && !$l['leap']) $newYear++;
            if ($l['month'] === 7) $shichigatsu++;
            if ($name !== '先勝') $fail("{$ymd}: 旧{$l['month']}/1 が先勝でない（{$name}）");
        }
    }

    // 月の長さ・1年の月数（1900-2100 にかかる朔望月）
    $t = lunarTable();
    $n = count($t);
    $monthsChecked = 0; $yearsChecked = 0;
    $yearStart = null; $yearMonths = 0; $yearLeaps = 0;
    for ($i = 0; $i < $n - 1; $i++) {
        $len = $t[$i + 1][0] - $t[$i][0];
        if ($t[$i + 1][0] > $from && $t[$i][0] <= $to) {
            $monthsChecked++;
            if ($len !== 29 && $len !== 30) $fail(lunar_ymd($t[$i][0]) . ": 旧暦の月の長さが {$len} 日");
        }
        if ($t[$i][1] === 1 && $t[$i][2] === 0) {
            if ($yearStart !== null && $t[$yearStart][0] <= $to) {
                $yearsChecked++;
                $label = lunar_ymd($t[$yearStart][0]);
                if ($yearMonths !== 12 && $yearMonths !== 13) $fail("{$label} 始まりの旧暦年が {$yearMonths} ヶ月");
                if (($yearMonths === 13) !== ($yearLeaps === 1) || $yearLeaps > 1) $fail("{$label} 始まりの旧暦年: {$yearMonths}ヶ月・閏{$yearLeaps}");
            }
            $yearStart = $i; $yearMonths = 0; $yearLeaps = 0;
        }
        if ($yearStart !== null) { $yearMonths++; if ($t[$i][2] === 1) $yearLeaps++; }
    }
} catch (Throwable $e) {
    $fail('例外/警告: ' . get_class($e) . ': ' . $e->getMessage() . ' @ ' . basename($e->getFile()) . ':' . $e->getLine());
}

echo "性質テスト: 1900-01-01〜2100-12-31 全 {$days} 日\n";
echo "  旧1/1（平月）: {$newYear} 回 / 旧7/1: {$shichigatsu} 回 を先勝として確認\n";
echo "  月の長さ確認: {$monthsChecked} 朔望月 / 1年の月数確認: {$yearsChecked} 年\n";
echo '  警告・エラー: ' . (count(array_filter($fails, fn($f) => str_starts_with($f, '例外/警告'))) ) . " 件\n";
if ($fails) {
    foreach ($fails as $f) echo "  FAIL {$f}\n";
    echo "FAIL\n";
    exit(1);
}
echo "PASS\n";
exit(0);
