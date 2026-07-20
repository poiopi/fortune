<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService
//
// 「その日の情報」を返す共通データ層。HTMLは一切返さない
// （表示ロジックはcalendar/day.php等の呼び出し側に置く）。
//
// 将来的にはカレンダー月表示・日別詳細ページ・API・Googleカレンダー連携
// すべてがこの関数を使う想定。Provider登録機構やinterfaceは使わず、
// 素朴な関数呼び出しの集合として実装する（過剰設計を避けるため）。
//
// Phase1-Aでは既存ロジックへの委譲のみで完結する3セクション
// （六曜・星座・九星の年月）のみを対象とする。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/providers/rokuyo.php';
require_once __DIR__.'/providers/lucky.php';
require_once __DIR__.'/providers/seiza.php';
require_once __DIR__.'/providers/kyusei.php';

// セクションの表示順（PHP連想配列は挿入順を保持するため、UI側はforeachするだけでよい）
const DAYINFO_SECTION_ORDER = ['rokuyo', 'lucky', 'seiza', 'kyusei'];

function getDayInfo(DateTimeImmutable $date): array {
    static $cache = [];

    $key = $date->format('Y-m-d');
    if (isset($cache[$key])) {
        return $cache[$key];
    }

    $weekdayNames = ['日', '月', '火', '水', '木', '金', '土'];

    $sectionBuilders = [
        'rokuyo' => 'getRokuyoInfo',
        'lucky'  => 'getLuckyInfo',
        'seiza'  => 'getSeizaInfo',
        'kyusei' => 'getKyuseiInfo',
    ];

    $sections = [];
    foreach (DAYINFO_SECTION_ORDER as $sectionKey) {
        $builder = $sectionBuilders[$sectionKey];
        $sections[$sectionKey] = $builder($date);
    }

    $result = [
        'meta' => [
            'date'           => $key,
            'weekday'        => $weekdayNames[(int)$date->format('w')],
            'schema_version' => 1,
        ],
        'sections' => $sections,
    ];

    $cache[$key] = $result;

    return $result;
}
