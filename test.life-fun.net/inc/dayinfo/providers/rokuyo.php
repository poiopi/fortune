<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 六曜セクション用プロバイダ
//
// 既存の inc/oracle.php の getRokuyo() へ委譲するだけの薄いラッパー。
// ロジック自体は変更しない。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../oracle.php';

function getRokuyoInfo(DateTimeImmutable $date): array {
    $y = (int)$date->format('Y');
    $m = (int)$date->format('n');
    $d = (int)$date->format('j');

    $r = getRokuyo($y, $m, $d);

    return [
        'available' => true,
        'name'      => $r['name'],
        'en'        => $r['en'],
        'class'     => $r['class'],
        'desc'      => $r['desc'],
    ];
}
