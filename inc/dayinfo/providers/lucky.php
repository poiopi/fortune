<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: ラッキーアイテムセクション用プロバイダ
//
// 既存の inc/oracle.php の getLuckyItems() へ委譲するだけの薄いラッパー。
// getLuckyItems()はcrc32(日付文字列)をシードにしているため、
// 任意の日付に対応済み（今日限定ではない）。ロジック自体は変更しない。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../oracle.php';

function getLuckyInfo(DateTimeImmutable $date): array {
    $luckyItems = getLuckyItems($date->format('Y-m-d'));

    return [
        'available' => true,
        'message'   => $luckyItems['message'],
        'color'     => [
            'name'    => $luckyItems['color']['name'],
            'meaning' => $luckyItems['color']['meaning'],
        ],
        'number' => $luckyItems['number'],
        'items'  => $luckyItems['items'],
    ];
}
