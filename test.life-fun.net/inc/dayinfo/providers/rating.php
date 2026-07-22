<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 総合運・恋愛運・仕事運・金運セクション用プロバイダ
//
// 日付ごとに決定的な値（同じ日付なら常に同じ結果）を1〜5の整数で返す。
// シードは inc/oracle.php の getLuckyItems() が使う crc32(日付文字列) とは
// 別の専用サフィックス（'::rating'）を混ぜており、mt_rand()の呼び出し順序
// を共有しないため、getLuckyItems()側の乱数列には一切影響を与えない。
// inc/oracle.php 自体は変更しない。
// ══════════════════════════════════════════════════════════════════

function getRatingInfo(DateTimeImmutable $date): array {
    $seed = crc32($date->format('Y-m-d').'::rating');
    mt_srand($seed);

    $overall = mt_rand(1, 5);
    $love    = mt_rand(1, 5);
    $work    = mt_rand(1, 5);
    $money   = mt_rand(1, 5);

    return [
        'available' => true,
        'overall'   => $overall,
        'love'      => $love,
        'work'      => $work,
        'money'     => $money,
    ];
}
