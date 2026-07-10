<?php
declare(strict_types=1);

/**
 * inc/blood-engine.php
 *
 * 血液型（A/B/O/AB）のEngine。既存ページが存在しないため、raw計算は
 * 「入力された型をそのまま返す」だけの恒等関数になる（docs/love/07-implementation.md）。
 *
 * meta/highlights/extrasはBLOOD_DATA（既存の解説文）からの転記のみで、新しい
 * 解釈は加えない。extrasは新規コンテンツを発明せず空配列とする
 * （inc/blood-data.phpのコメント参照：famousに相当するデータは持たない）。
 *
 * 正しさの基準：4種類のみの有限入力のため、Golden Master・Trait Snapshotは
 * A/B/O/AB全数（4件）で足りる。
 */

require_once __DIR__ . '/blood-data.php';
require_once __DIR__ . '/blood-trait-mapping.php';

/** @return array{title: string, subtitle: string} */
function blood_computeMeta(array $raw): array {
    $type = BLOOD_DATA[$raw['type']];
    return [
        'title' => '血液型診断',
        'subtitle' => $type['name'],
    ];
}

// ═══════════════════════════════════════════════════
// traits変換（inc/blood-trait-mapping.php が単一の情報源。Rule ID: B001〜B009）
// ═══════════════════════════════════════════════════
/**
 * @return array<string, array{score:int, type:string}>
 */
function blood_computeTraits(string $type): array {
    $traits = [];
    $add = function (string $trait, int $score) use (&$traits) {
        if (!isset($traits[$trait])) $traits[$trait] = ['score' => 0, 'type' => 'permanent'];
        $traits[$trait]['score'] += $score;
    };

    foreach (BLOOD_TRAIT_MAPPING[$type] ?? [] as $rule) $add($rule['trait'], $rule['score']);

    return $traits;
}

// ═══════════════════════════════════════════════════
// highlights: 既存解説文からの抽出（新規に文章を生成しない）
// ═══════════════════════════════════════════════════
/** @return string[] */
function blood_computeHighlights(array $raw): array {
    return [
        BLOOD_DATA[$raw['type']]['desc'],
    ];
}

/**
 * @param string $type 'A'|'B'|'O'|'AB'
 * @return array{
 *   meta: array{title:string, subtitle:string},
 *   raw: array{type:string},
 *   traits: array<string, array{score:int, type:string}>,
 *   highlights: string[],
 *   extras: array<int, array{type:string, label:string, value:mixed}>
 * }
 */
function bloodEngine(string $type): array {
    $raw = [
        'type' => $type,
    ];

    return [
        'meta' => blood_computeMeta($raw),
        'raw' => $raw,
        'traits' => blood_computeTraits($raw['type']),
        'highlights' => blood_computeHighlights($raw),
        'extras' => [],
    ];
}
