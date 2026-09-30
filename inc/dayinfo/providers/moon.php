<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 月齢・月相セクション用プロバイダ（Phase1-B新規ロジック）
//
// 月齢は「その日の正午（JST）− 直前の朔の瞬間」の日数（正午月齢）。
// 朔の瞬間は六曜と同じ旧暦テーブル（inc/lunar-calendar.php）から取るため、
// 旧暦1日（朔日）と月齢の計算元は常に一致する。
// テーブルの範囲外（1899-01〜2101-12の外）だけ、従来の平均朔望月による近似式で求める。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../oracle.php';
require_once __DIR__.'/../../lunar-calendar.php';

// 範囲外フォールバック用の近似式の定数（2000-01-06 付近の平均朔が基準）
const MOON_SYNODIC_PERIOD_DAYS = 29.53059;
const MOON_BASE_NEW_MOON_JD    = 2451550;

// 月相名→解説記事slugの変換表（Phase3-1で追加した月相ガイド記事へのリンク用）
const DAYINFO_MOON_ARTICLE_SLUGS = [
    '新月' => 'shingetsu', '三日月' => 'mikazuki', '上弦の月' => 'jougen', '十三夜月' => 'juusanya',
    '満月' => 'mangetsu', '十六夜月' => 'izayoi', '下弦の月' => 'kagen', '二十六夜月' => 'nijuurokuya',
];

// 月齢（0〜約29.8。朔望月の長さによる）から8区分の月相名・絵文字を返す
function moonPhaseFromAge(float $age): array {
    // 各区分の境界値（朔望月を8等分し、新月(0)を中心にした区分）
    $boundaries = [1.84566, 5.53699, 9.22831, 12.91963, 16.61096, 20.30228, 23.99361, 27.68493];
    $phases = [
        ['name' => '新月',       'symbol' => '🌑', 'description' => '月が見えなくなる、すべての始まりを象徴する日。新しいことを始める、願い事をするのに向いています。'],
        ['name' => '三日月',     'symbol' => '🌒', 'description' => '細い光が姿を見せ始める、成長の初期段階。小さな一歩を積み重ねることが実を結びやすいでしょう。'],
        ['name' => '上弦の月',   'symbol' => '🌓', 'description' => '半分が輝く、決断と行動の日。迷いを断ち切り、前へ進む勢いをつけるのに向いています。'],
        ['name' => '十三夜月',   'symbol' => '🌔', 'description' => '満月まであと一歩、期待が高まる日。仕上げに向けて集中力を高めるとよいでしょう。'],
        ['name' => '満月',       'symbol' => '🌕', 'description' => '月が最も満ちる、物事の集大成を象徴する日。これまでの努力が実を結びやすいでしょう。'],
        ['name' => '十六夜月',   'symbol' => '🌖', 'description' => '満月からわずかに欠け始める、余韻を味わう日。得たものを振り返り、感謝する時間に向いています。'],
        ['name' => '下弦の月',   'symbol' => '🌗', 'description' => '半分に欠けていく、手放しと整理の日。不要なものを見直し、身軽になるのに向いています。'],
        ['name' => '二十六夜月', 'symbol' => '🌘', 'description' => '光が細くなり、静けさが増す日。次の新月へ向けて心身を休め、内省するのに向いています。'],
    ];

    foreach ($boundaries as $i => $b) {
        if ($age < $b) {
            return $phases[$i];
        }
    }
    return $phases[0]; // age >= 27.68493（次の新月に近い日。朔望月の長さにより最大約29.8まで）
}

// JST暦日のJDNにおける正午月齢。旧暦テーブルの範囲外なら null
function moonAgeFromNewMoonTable(int $jdn): ?float {
    $moments = lunarNewMoonMomentsJst();
    $n = count($moments);
    // 朔の瞬間はJST基準ユリウス日なので、JDNの値そのものがその日の正午（JST）にあたる
    $noon = (float)$jdn;
    if ($n < 2 || $noon < $moments[0] || $noon >= $moments[$n - 1]) {
        return null;
    }
    // 正午以前で最後の朔を二分探索
    $lo = 0; $hi = $n - 2;
    while ($lo < $hi) {
        $mid = ($lo + $hi + 1) >> 1;
        if ($moments[$mid] <= $noon) {
            $lo = $mid;
        } else {
            $hi = $mid - 1;
        }
    }
    return $noon - $moments[$lo];
}

// 範囲外フォールバック：平均朔望月で割った余りによる近似（誤差は最大1日程度）
function moonAgeApprox(int $jdn): float {
    $age = fmod($jdn - MOON_BASE_NEW_MOON_JD, MOON_SYNODIC_PERIOD_DAYS);
    return $age < 0 ? $age + MOON_SYNODIC_PERIOD_DAYS : $age;
}

function getMoonInfo(DateTimeImmutable $date): array {
    $jdn = myGregorianToJD((int)$date->format('Y'), (int)$date->format('n'), (int)$date->format('j'));

    $rawAge = moonAgeFromNewMoonTable($jdn) ?? moonAgeApprox($jdn);

    $phase = moonPhaseFromAge($rawAge);
    $slug  = DAYINFO_MOON_ARTICLE_SLUGS[$phase['name']] ?? null;

    return [
        'available'   => true,
        'age'         => round($rawAge, 1),
        'phase_name'  => $phase['name'],
        'symbol'      => $phase['symbol'],
        'description' => $phase['description'],
        'url'         => $slug !== null ? "/articles/calendar/moon/{$slug}/" : null,
    ];
}
