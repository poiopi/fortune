<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 九星（年九星・月九星）セクション用プロバイダ
//
// kyusei.php は単体ページとしてHTML出力まで行うファイルのため直接requireできない。
// 計算ロジック本体（calcKyusei/calcMonthStar/getKyuseiData）は
// inc/kyusei-core.php に切り出し済みなので、そちらを利用する。
//
// ここでは「その日（カレンダー上の日付）自体が属する年の年家九星・月家九星」を
// 求める用途で calcKyusei()/calcMonthStar() を使う（日九星は対象外・Phase1-A範囲外）。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../kyusei-core.php';

function getKyuseiInfo(DateTimeImmutable $date): array {
    $y = (int)$date->format('Y');
    $m = (int)$date->format('n');
    $d = (int)$date->format('j');

    $yearStar  = calcKyusei($y, $m, $d);
    $monthStar = calcMonthStar($y, $m, $d);

    $yearData  = getKyuseiData($yearStar);
    $monthData = getKyuseiData($monthStar);

    return [
        'available' => true,
        'year' => [
            'star'   => $yearStar,
            'name'   => $yearData['name'],
            'en'     => $yearData['en'],
            'element'=> $yearData['element'],
            'symbol' => $yearData['symbol'],
        ],
        'month' => [
            'star'   => $monthStar,
            'name'   => $monthData['name'],
            'en'     => $monthData['en'],
            'element'=> $monthData['element'],
            'symbol' => $monthData['symbol'],
        ],
    ];
}
