<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 誕生花セクション用プロバイダ（Phase2新規ロジック）
//
// inc/dayinfo/birth-flowers-data.php の365日分データ（DAYINFO_BIRTH_FLOWERS）
// をそのまま参照する。データ内容自体はこのファイルでは一切変更しない。
//
// 2/29（うるう日）はデータ対象外のため、該当日は available=false を返す
// （他のセクションの「情報がありません」パターンと同じ扱い）。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../birth-flowers-data.php';

function getFlowerInfo(DateTimeImmutable $date): array {
    $key = $date->format('m-d');

    if (!isset(DAYINFO_BIRTH_FLOWERS[$key])) {
        return ['available' => false];
    }

    $flower = DAYINFO_BIRTH_FLOWERS[$key];

    return [
        'available' => true,
        'name'      => $flower['name'],
        'meaning'   => $flower['meaning'],
        'url'       => null, // 解説記事は現状存在しないためnull固定（将来のリンク化に備えた構造）
    ];
}
