<?php
declare(strict_types=1);

/**
 * compare-moon-age-naoj.php
 *
 * STG版 inc/dayinfo/providers/moon.php の正午月齢・月相名を検証する。
 * 正解は国立天文台「暦要項 朔弦望」の朔時刻（tests/cases/lunar-naoj-saku.php に固定済み）であり、現行出力ではない。
 *
 * PASS 条件:
 *   1. 国立天文台の朔がそろう期間の全日で、正午月齢（国立天文台の朔から計算）との差が 0.003日（約4分）以内
 *      かつ表示値（小数1桁）の差が 0.1 以内。
 *      月相名は、区分の境界から 0.003日以上離れている日は全件一致。
 *   2. 1900-01-01〜2100-12-31 の全日で、月齢が 0 以上 29.9 未満で、翌日には +1 されるか、朔をまたいで 1 未満に戻る。
 *      月相名は DAYINFO_MOON_ARTICLE_SLUGS のキーのいずれかで、記事URLがある。
 *   3. 旧暦テーブルの範囲外（1899-01-01, 2102-06-01）でも警告なしで値を返す（近似式フォールバック）。
 *   4. 固定例（2026-02 の朔 2/17 21:01 JST 前後）が期待どおり。
 *
 * 実行方法: php tests/tools/compare-moon-age-naoj.php
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');
set_error_handler(static function (int $no, string $msg, string $file, int $line): bool {
    throw new ErrorException($msg, 0, $no, $file, $line);
});

require_once __DIR__ . '/../../test.life-fun.net/inc/dayinfo/providers/moon.php';

const MOON_TOL_DAYS = 0.003;

$fail = [];

function moonDate(int $jdn): DateTimeImmutable {
    [$m, $d, $y] = array_map('intval', explode('/', jdtogregorian($jdn)));
    return new DateTimeImmutable(sprintf('%04d-%02d-%02d', $y, $m, $d));
}

// ── 1. 国立天文台の朔との照合（全日） ─────────────────────────────
$fx = require __DIR__ . '/../cases/lunar-naoj-saku.php';
$naoj = [];
foreach ($fx['years'] as $list) {
    foreach ($list as [$date, $hm]) {
        [$y, $m, $d] = array_map('intval', explode('-', $date));
        [$hh, $mi] = array_map('intval', explode(':', $hm));
        $naoj[] = gregoriantojd($m, $d, $y) - 0.5 + ($hh * 60 + $mi) / 1440; // JST基準ユリウス日
    }
}
sort($naoj);

$days = 0; $maxDiff = 0.0; $maxAt = ''; $nameChecked = 0; $nameSkipped = 0;
$boundaries = [1.84566, 5.53699, 9.22831, 12.91963, 16.61096, 20.30228, 23.99361, 27.68493];
for ($i = 0; $i < count($naoj) - 1; $i++) {
    // 連続する2つの朔が 1 朔望月（29.2〜29.9日）離れている区間だけ使う（取得不可の年をまたがない）
    $len = $naoj[$i + 1] - $naoj[$i];
    if ($len < 29.2 || $len > 29.9) continue;
    for ($jdn = (int)ceil($naoj[$i]); $jdn <= $naoj[$i + 1]; $jdn++) {
        $ref = $jdn - $naoj[$i];
        if ($ref < 0 || $jdn >= $naoj[$i + 1]) continue;
        $days++;
        $raw = moonAgeFromNewMoonTable($jdn);
        $info = getMoonInfo(moonDate($jdn));
        $ymd = moonDate($jdn)->format('Y-m-d');
        if ($raw === null) { $fail[] = "{$ymd}: テーブルから月齢を取得できない"; continue; }
        $diff = $raw - $ref;
        if (abs($diff) > abs($maxDiff)) { $maxDiff = $diff; $maxAt = $ymd; }
        if (abs($diff) > MOON_TOL_DAYS) $fail[] = sprintf('%s: 月齢 %.4f / 国立天文台基準 %.4f', $ymd, $raw, $ref);
        if (abs($info['age'] - round($ref, 1)) > 0.1 + 1e-9) $fail[] = sprintf('%s: 表示値 %.1f / 国立天文台基準 %.1f', $ymd, $info['age'], $ref);
        $nearBoundary = false;
        foreach ($boundaries as $b) if (abs($ref - $b) < MOON_TOL_DAYS) $nearBoundary = true;
        if ($nearBoundary) { $nameSkipped++; continue; }
        $nameChecked++;
        $expected = moonPhaseFromAge($ref)['name'];
        if ($info['phase_name'] !== $expected) $fail[] = "{$ymd}: 月相名 {$info['phase_name']} / 国立天文台基準 {$expected}";
    }
}
$years = array_keys($fx['years']);
echo '1. 国立天文台の朔との照合: ' . min($years) . '〜' . max($years) . "年, {$days}日\n";
printf("   正午月齢の差 最大 %+.4f日（%+.1f分, %s）／月相名 %d日照合（境界付近 %d日は除外）\n", $maxDiff, $maxDiff * 1440, $maxAt, $nameChecked, $nameSkipped);
if ($days < 8000) $fail[] = "照合日数が少なすぎる（{$days}日）";

// ── 2. 全期間の不変条件 ───────────────────────────────────────────
$from = gregoriantojd(1, 1, 1900); $to = gregoriantojd(12, 31, 2100);
$prev = null; $maxAge = 0.0; $resets = 0;
for ($jdn = $from; $jdn <= $to; $jdn++) {
    $ymd = moonDate($jdn)->format('Y-m-d');
    $raw = moonAgeFromNewMoonTable($jdn);
    $info = getMoonInfo(moonDate($jdn));
    if ($raw === null) { $fail[] = "{$ymd}: テーブル範囲外になっている"; $prev = null; continue; }
    if ($raw < 0 || $raw >= 29.9) $fail[] = sprintf('%s: 月齢が範囲外 %.4f', $ymd, $raw);
    $maxAge = max($maxAge, $raw);
    if ($prev !== null) {
        if (abs($raw - $prev - 1) < 1e-9) {
            // 通常：1日進む
        } elseif ($raw < 1.0 && $prev > 28.0) {
            $resets++;
        } else {
            $fail[] = sprintf('%s: 前日 %.4f → 当日 %.4f の変化が不正', $ymd, $prev, $raw);
        }
    }
    $prev = $raw;
    if (!isset(DAYINFO_MOON_ARTICLE_SLUGS[$info['phase_name']]) || $info['url'] === null || $info['available'] !== true) {
        $fail[] = "{$ymd}: 月相名・記事URLが不正（{$info['phase_name']}）";
    }
}
printf("2. 全期間 1900〜2100年: %d日, 朔で戻った回数 %d, 月齢の最大 %.3f\n", $to - $from + 1, $resets, $maxAge);

// ── 3. 範囲外フォールバック ───────────────────────────────────────
foreach (['1899-01-01', '2102-06-01'] as $s) {
    $jdn = gregoriantojd((int)substr($s, 5, 2), (int)substr($s, 8, 2), (int)substr($s, 0, 4));
    if (moonAgeFromNewMoonTable($jdn) !== null) $fail[] = "{$s}: 範囲外のはずがテーブルから値が返った";
    $info = getMoonInfo(new DateTimeImmutable($s));
    if ($info['available'] !== true || $info['age'] < 0 || $info['age'] >= 29.6) $fail[] = "{$s}: フォールバックの値が不正";
}
echo "3. 範囲外フォールバック: 1899-01-01, 2102-06-01\n";

// ── 4. 固定例（国立天文台: 朔 2026-02-17 21:01 JST） ─────────────
$fixed = [
    '2026-02-15' => [27.3, '二十六夜月'],
    '2026-02-17' => [29.3, '新月'],
    '2026-02-19' => [1.6, '新月'],
    '2026-02-20' => [2.6, '三日月'],
];
foreach ($fixed as $s => [$age, $name]) {
    $info = getMoonInfo(new DateTimeImmutable($s));
    if (abs($info['age'] - $age) > 1e-9 || $info['phase_name'] !== $name) {
        $fail[] = "{$s}: 月齢{$info['age']} {$info['phase_name']}（期待 月齢{$age} {$name}）";
    }
}
echo "4. 固定例: " . count($fixed) . "件\n";

if ($fail) {
    foreach (array_slice($fail, 0, 30) as $f) echo "  FAIL {$f}\n";
    if (count($fail) > 30) echo '  …ほか ' . (count($fail) - 30) . " 件\n";
    echo "FAIL\n";
    exit(1);
}
echo "PASS\n";
exit(0);
