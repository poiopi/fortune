<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 吉日セクション用プロバイダ（Phase1-B新規ロジック）
//
// 干支（十干十二支）の計算には、既存のinc/oracle.phpのmyGregorianToJD()
// （Julian Day Number算出。ロジック自体は変更せずそのまま利用）と、
// 既にshichu.php（四柱推命ページ）で本番稼働している校正済みの干支計算式
// を移植して利用する（shichu.php自体は変更しない）。
//
//   干支サイクル番号 = (JDN + 49) % 60　（0=甲子,1=乙丑,...,5=己巳,...,59=癸亥）
//   十干 = サイクル番号 % 10（0=甲,1=乙,2=丙,3=丁,4=戊,5=己,6=庚,7=辛,8=壬,9=癸）
//   十二支 = サイクル番号 % 12（0=子,1=丑,2=寅,3=卯,4=辰,5=巳,6=午,7=未,8=申,9=酉,10=戌,11=亥）
//
// 校正根拠: shichu.phpのgetDayPillar()内コメントより
// 「1900/1/1 = 甲戌（stem=0, branch=10）、JDN(1900/1/1)=2415021、
//   (2415021+49)%60=10」。inc/oracle.phpのmyGregorianToJD(1900,1,1)が
// 同じく2415021を返すことを確認済みのため、このファイルでも同じ式を使う。
//
// 天赦日・一粒万倍日の判定に必要な二十四節気の節入り日算出も、
// shichu.phpのgetSolarTermDay()と同一の近似式（河内式）をPHPに移植して使う。
//
// 一粒万倍日（ichiryumanbai）は、節月（節入り日〜次の節入り前日）ごとに
// 割り当てられた十二支2種類のいずれかに該当する日で判定する。この対応表は
// 複数の独立した外部情報源（koyomikisetsu.com / saijigoyomi.com /
// benricho.org）で内容が一致することを確認済みのものを採用している：
//   小寒〜立春前日: 卯・子   立春〜啓蟄前日: 丑・午   啓蟄〜清明前日: 酉・寅
//   清明〜立夏前日: 子・卯   立夏〜芒種前日: 卯・辰   芒種〜小暑前日: 巳・午
//   小暑〜立秋前日: 酉・午   立秋〜白露前日: 子・未   白露〜寒露前日: 卯・申
//   寒露〜立冬前日: 酉・午   立冬〜大雪前日: 酉・戌   大雪〜小寒前日: 亥・子
// 節月の判定は、shichu.phpのgetMonthPillar()と同じロジック
// （対象日がその月の節入り日より前なら前月の節月として扱う）を用いる。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../oracle.php';

// 干支サイクル番号（0〜59, 0=甲子）を返す
function kichijitsuKanshiCycle(DateTimeImmutable $date): int {
    $jdn = myGregorianToJD((int)$date->format('Y'), (int)$date->format('n'), (int)$date->format('j'));
    return (($jdn + 49) % 60 + 60) % 60;
}

// 節入り日（該当月内の日番号）を返す。shichu.php の getSolarTermDay() と同一の近似式。
// month=2→立春, month=5→立夏, month=8→立秋, month=11→立冬 の日を求める用途で使用。
function kichijitsuSolarTermDay(int $year, int $month): int {
    $c20 = [6.3811, 4.6295, 6.3826, 5.5820, 6.3180, 6.5000, 7.9280, 7.9922, 8.2587, 8.4328, 7.3306, 7.9584];
    $c21 = [5.4055, 3.8708, 6.3780, 4.8120, 5.5200, 5.6780, 7.1080, 7.5008, 7.6460, 7.9000, 6.9000, 7.1800];
    $idx = $month - 1;
    if ($year >= 2000) {
        $y = $year - 2000;
        return (int)floor($c21[$idx] + 0.2422 * $y) - (int)floor($y / 4);
    }
    $y = $year - 1900;
    return (int)floor($c20[$idx] + 0.2422 * $y) - (int)floor(($y - 1) / 4);
}

// 節月インデックス（1〜12）を返す。1=小寒〜立春前日、2=立春〜啓蟄前日、
// ...、12=大雪〜小寒前日。shichu.phpのgetMonthPillar()と同じロジック
// （対象日の月の節入り日より前なら、前月の節月として扱う）を年をまたぐ
// ケースも含めて踏襲している（このファイルでは月インデックスのみ必要なため
// 年の繰り上げ処理は行わない）。
function kichijitsuSolarMonthIndex(DateTimeImmutable $date): int {
    $year  = (int)$date->format('Y');
    $month = (int)$date->format('n');
    $day   = (int)$date->format('j');

    $termDay = kichijitsuSolarTermDay($year, $month);
    if ($day < $termDay) {
        $month--;
        if ($month === 0) {
            $month = 12;
        }
    }
    return $month;
}

// 天赦日: 季節ごとに特定の干支と一致する日
// 春(立春〜立夏前)=戊寅（stem4,branch2）/ 夏(立夏〜立秋前)=甲午（stem0,branch6）/
// 秋(立秋〜立冬前)=戊申（stem4,branch8）/ 冬(立冬〜立春前)=甲子（stem0,branch0）
function isTenshabi(DateTimeImmutable $date): bool {
    $year  = (int)$date->format('Y');
    $month = (int)$date->format('n');
    $day   = (int)$date->format('j');

    $risshun = kichijitsuSolarTermDay($year, 2);
    $rikka   = kichijitsuSolarTermDay($year, 5);
    $risshu  = kichijitsuSolarTermDay($year, 8);
    $rittou  = kichijitsuSolarTermDay($year, 11);

    if (($month > 2 || ($month === 2 && $day >= $risshun)) && ($month < 5 || ($month === 5 && $day < $rikka))) {
        $season = 'spring';
    } elseif (($month > 5 || ($month === 5 && $day >= $rikka)) && ($month < 8 || ($month === 8 && $day < $risshu))) {
        $season = 'summer';
    } elseif (($month > 8 || ($month === 8 && $day >= $risshu)) && ($month < 11 || ($month === 11 && $day < $rittou))) {
        $season = 'autumn';
    } else {
        $season = 'winter';
    }

    $cycle  = kichijitsuKanshiCycle($date);
    $stem   = $cycle % 10;
    $branch = $cycle % 12;

    return match ($season) {
        'spring' => $stem === 4 && $branch === 2,
        'summer' => $stem === 0 && $branch === 6,
        'autumn' => $stem === 4 && $branch === 8,
        'winter' => $stem === 0 && $branch === 0,
    };
}

// 寅の日: 十二支が「寅」（branch=2）の日。12日周期。
function isToraNoHi(DateTimeImmutable $date): bool {
    return kichijitsuKanshiCycle($date) % 12 === 2;
}

// 己巳の日: 十干「己」（stem=5）かつ十二支「巳」（branch=5）の日。60日周期。
// （60サイクル中、stem=5とbranch=5を同時に満たすのはcycle=5のみ）
function isTsuchinotoMi(DateTimeImmutable $date): bool {
    return kichijitsuKanshiCycle($date) === 5;
}

// 一粒万倍日: 節月ごとに割り当てられた十二支2種類のいずれかに該当する日
// （branch番号: 0=子,1=丑,2=寅,3=卯,4=辰,5=巳,6=午,7=未,8=申,9=酉,10=戌,11=亥）
function isIchiryuManbai(DateTimeImmutable $date): bool {
    $branchTable = [
        1  => [3, 0],   // 小寒〜立春前日: 卯・子
        2  => [1, 6],   // 立春〜啓蟄前日: 丑・午
        3  => [9, 2],   // 啓蟄〜清明前日: 酉・寅
        4  => [0, 3],   // 清明〜立夏前日: 子・卯
        5  => [3, 4],   // 立夏〜芒種前日: 卯・辰
        6  => [5, 6],   // 芒種〜小暑前日: 巳・午
        7  => [9, 6],   // 小暑〜立秋前日: 酉・午
        8  => [0, 7],   // 立秋〜白露前日: 子・未
        9  => [3, 8],   // 白露〜寒露前日: 卯・申
        10 => [9, 6],   // 寒露〜立冬前日: 酉・午
        11 => [9, 10],  // 立冬〜大雪前日: 酉・戌
        12 => [11, 0],  // 大雪〜小寒前日: 亥・子
    ];

    $solarMonth = kichijitsuSolarMonthIndex($date);
    $branch     = kichijitsuKanshiCycle($date) % 12;

    return in_array($branch, $branchTable[$solarMonth], true);
}

function getKichijitsuInfo(DateTimeImmutable $date): array {
    $days = [];

    if (isIchiryuManbai($date)) {
        $days[] = ['name' => '一粒万倍日', 'url' => '/articles/calendar/kichijitsu/ichiryumanbai/'];
    }
    if (isTenshabi($date)) {
        $days[] = ['name' => '天赦日', 'url' => '/articles/calendar/kichijitsu/tenshabi/'];
    }
    if (isToraNoHi($date)) {
        $days[] = ['name' => '寅の日', 'url' => '/articles/calendar/kichijitsu/tora/'];
    }
    if (isTsuchinotoMi($date)) {
        $days[] = ['name' => '己巳の日', 'url' => '/articles/calendar/kichijitsu/tsuchinotomi/'];
    }

    return [
        'available' => count($days) > 0,
        'days'       => $days,
    ];
}
