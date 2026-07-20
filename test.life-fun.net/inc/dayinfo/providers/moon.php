<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 月齢・月相セクション用プロバイダ（Phase1-B新規ロジック）
//
// 天体暦APIは使わず、既知の新月基準日（2000-01-06 18:14 UTC、
// Julian Day 2451550。inc/oracle.phpのjdToLunar()が使う新月基準日と
// 同一の値を用いて一貫性を保っている）から対象日までの経過日数を、
// 朔望月周期（29.53059日）で割った余りとして月齢を求める近似式。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../oracle.php';

const MOON_SYNODIC_PERIOD_DAYS = 29.53059;
const MOON_BASE_NEW_MOON_JD    = 2451550; // 2000-01-06 新月（jdToLunar()と同一基準）

// 月齢（0〜29.53059）から8区分の月相名・絵文字を返す
function moonPhaseFromAge(float $age): array {
    // 各区分の境界値（朔望月を8等分し、新月(0)を中心にした区分）
    $boundaries = [1.84566, 5.53699, 9.22831, 12.91963, 16.61096, 20.30228, 23.99361, 27.68493];
    $phases = [
        ['name' => '新月',       'symbol' => '🌑'],
        ['name' => '三日月',     'symbol' => '🌒'],
        ['name' => '上弦の月',   'symbol' => '🌓'],
        ['name' => '十三夜月',   'symbol' => '🌔'],
        ['name' => '満月',       'symbol' => '🌕'],
        ['name' => '十六夜月',   'symbol' => '🌖'],
        ['name' => '下弦の月',   'symbol' => '🌗'],
        ['name' => '二十六夜月', 'symbol' => '🌘'],
    ];

    foreach ($boundaries as $i => $b) {
        if ($age < $b) {
            return $phases[$i];
        }
    }
    return $phases[0]; // age >= 27.68493（次の新月に近い残り約1.8日）
}

function getMoonInfo(DateTimeImmutable $date): array {
    $jd = myGregorianToJD((int)$date->format('Y'), (int)$date->format('n'), (int)$date->format('j'));

    $daysSinceNewMoon = $jd - MOON_BASE_NEW_MOON_JD;
    $rawAge = fmod($daysSinceNewMoon, MOON_SYNODIC_PERIOD_DAYS);
    if ($rawAge < 0) {
        $rawAge += MOON_SYNODIC_PERIOD_DAYS;
    }

    $phase = moonPhaseFromAge($rawAge);

    return [
        'available'  => true,
        'age'        => round($rawAge, 1),
        'phase_name' => $phase['name'],
        'symbol'     => $phase['symbol'],
    ];
}
