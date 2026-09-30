<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/lunar-builder.php
 *
 * 朔（新月）と中気から旧暦の朔望月リストを組み立てる（開発専用）。
 * generate-lunar-table.php・各種レポート/テストから共通で使う。
 *
 * 閏月ルール（冬至ルール）
 *   - 冬至（太陽視黄経270°）を含む月を11月とする。
 *   - ある冬至月から次の冬至月までの月数が13のときだけ、その間で最初の
 *     「中気を含まない月」を閏月とし、前月と同じ月番号を付ける。
 *   - 12のときは閏月なし（中気を含まない月があっても通常の月番号で数える）。
 *   - 例外処理（天保暦の「正月・冬至月優先」等の特則）は一切入れない。
 *   - このルールをそのまま適用すると 2033年は「閏11月」になる（いわゆる2033年問題）。
 *     2015年に日本カレンダー暦文化振興協会が閏11月を推奨しており、事実上の標準。
 *
 * 日付判定はすべて JST 暦日で行う（朔の日・中気の日とも floor(JD(UT)+9/24+0.5)）。
 * 中気が朔と同じ日にある場合、その中気はその朔から始まる月に含まれる。
 */

require_once __DIR__ . '/astro.php';

/**
 * @param int    $y1        出力する最初の年（この年の1/1以降に朔がある月から）
 * @param int    $y2        出力する最後の年（この年の12/31以前に朔がある月まで）
 * @param string $precision 'high'（VSOP87省略版）/'low'（ch.25低精度）: 中気の計算精度
 * @param array<string, float> $termShiftMinutes レポート用の感度分析フック。
 *        キー "黄経@YYYY-MM-DD"（その精度で計算した中気のJST日付）の中気を指定分だけずらす。テーブル生成では使わない。
 * @return array<int, array{jdn:int, moment:float, month:int, leap:bool, chu:array<int, array{lon:int, jdn:int, moment:float}>}>
 */
function lunar_build(int $y1, int $y2, string $precision = 'high', array $termShiftMinutes = []): array {
    $margin = 3; // 冬至アンカーを両端の外側に確保するための余白（年）
    $k0 = (int)floor(($y1 - $margin - 2000) * 12.3685);
    $k1 = (int)ceil(($y2 + $margin - 2000) * 12.3685);

    $moons = [];
    for ($k = $k0; $k <= $k1; $k++) {
        $m = astro_jdeToJstMoment(astro_newMoonJDE($k));
        $moons[] = ['jdn' => astro_momentToJdn($m), 'moment' => $m];
    }

    $terms = []; // 中気
    for ($y = $y1 - $margin; $y <= $y2 + $margin; $y++) {
        for ($lon = 0; $lon < 360; $lon += 30) {
            $guess = gregoriantojd(3, 20, $y) + $lon / 360 * 365.2422;
            $m = astro_jdeToJstMoment(astro_solarTermJDE((float)$lon, $guess, $precision));
            $key = $lon . '@' . jdtogregorian(astro_momentToJdn($m));
            if (isset($termShiftMinutes[$key])) $m += $termShiftMinutes[$key] / 1440;
            $terms[] = ['lon' => $lon, 'jdn' => astro_momentToJdn($m), 'moment' => $m];
        }
    }
    usort($terms, fn($a, $b) => $a['moment'] <=> $b['moment']);

    $L = [];
    $ti = 0; $nt = count($terms);
    for ($i = 0; $i < count($moons) - 1; $i++) {
        $s = $moons[$i]['jdn']; $e = $moons[$i + 1]['jdn'];
        while ($ti < $nt && $terms[$ti]['jdn'] < $s) $ti++;
        $chu = [];
        for ($j = $ti; $j < $nt && $terms[$j]['jdn'] < $e; $j++) $chu[] = $terms[$j];
        $L[] = ['jdn' => $s, 'moment' => $moons[$i]['moment'], 'chu' => $chu];
    }

    $W = [];
    foreach ($L as $i => $e) {
        foreach ($e['chu'] as $c) if ($c['lon'] === 270) { $W[] = $i; break; }
    }
    for ($w = 0; $w < count($W) - 1; $w++) {
        $a = $W[$w]; $b = $W[$w + 1]; $n = $b - $a;
        if ($n !== 12 && $n !== 13) {
            throw new RuntimeException("冬至月の間隔が異常: {$n}（" . jdtogregorian($L[$a]['jdn']) . '）');
        }
        $leapDone = ($n === 12);
        $m = 11;
        $L[$a]['month'] = 11; $L[$a]['leap'] = false;
        for ($i = $a + 1; $i < $b; $i++) {
            if (!$leapDone && count($L[$i]['chu']) === 0) {
                $L[$i]['month'] = $m; $L[$i]['leap'] = true; $leapDone = true;
                continue;
            }
            $m = $m % 12 + 1;
            $L[$i]['month'] = $m; $L[$i]['leap'] = false;
        }
        if (!$leapDone) {
            throw new RuntimeException('13ヶ月の年に中気のない月が見つからない（' . jdtogregorian($L[$a]['jdn']) . '）');
        }
    }

    $from = gregoriantojd(1, 1, $y1);
    $to   = gregoriantojd(12, 31, $y2);
    $out = [];
    foreach ($L as $e) {
        if ($e['jdn'] < $from || $e['jdn'] > $to) continue;
        if (!isset($e['month'])) throw new RuntimeException('月番号未確定の朔望月: ' . jdtogregorian($e['jdn']));
        $out[] = $e;
    }
    return $out;
}
