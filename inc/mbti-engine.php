<?php
declare(strict_types=1);

/**
 * inc/mbti-engine.php
 *
 * mbti.php の10問診断ロジック（calcMbti()、クライアントサイドJavaScript）を
 * PHPへ忠実に移植したもの。docs/engine-template.md / docs/love/07-implementation.md
 * の手順に基づく（Phase 1-5：Trait Mapping。4文字タイプコードをinc/mbti-trait-mapping.php
 * 経由でtraitsへ変換する）。
 *
 * meta/highlights/extrasはMBTI_DATA（既存の解説文・有名人リスト）からの転記のみで、
 * 新しい解釈は加えない（docs/engine-template.mdの手順6の原則をmeta等にも適用）。
 *
 * 正しさの基準は tests/cases/mbti-golden.php（Golden Master、1024件全数）。rawの
 * 形はPhase 1-3から変えていないため、Golden Master比較は引き続き成立する。
 */

require_once __DIR__ . '/mbti-data.php';
require_once __DIR__ . '/mbti-trait-mapping.php';

/**
 * calcMbti()のスコアリング・タイブレーク規則をそのまま移植する。
 * 同点の場合はE/S/T/Jを優先する（mbti.php本体と同一）。
 *
 * @param array<int, int> $answers 10問分の回答（各0または1）
 */
function mbti_calcType(array $answers): string {
    $scores = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];
    foreach (MBTI_QUESTION_DIMS as $i => $dim) {
        $letters = str_split($dim);
        $scores[$letters[$answers[$i]]]++;
    }
    return ($scores['E'] >= $scores['I'] ? 'E' : 'I')
         . ($scores['S'] >= $scores['N'] ? 'S' : 'N')
         . ($scores['T'] >= $scores['F'] ? 'T' : 'F')
         . ($scores['J'] >= $scores['P'] ? 'J' : 'P');
}

/** @return array{title: string, subtitle: string} */
function mbti_computeMeta(array $raw): array {
    $type = MBTI_DATA[$raw['type']];
    return [
        'title' => 'MBTI診断',
        'subtitle' => "{$raw['type']}・{$type['name']}",
    ];
}

// ═══════════════════════════════════════════════════
// traits変換（inc/mbti-trait-mapping.php が単一の情報源。Rule ID: M001〜M009）
// 4文字タイプコードを1文字ずつ分解し、各文字のルールを合算する。
// ═══════════════════════════════════════════════════
/**
 * @return array<string, array{score:int, type:string}>
 */
function mbti_computeTraits(string $type): array {
    $traits = [];
    $add = function (string $trait, int $score) use (&$traits) {
        if (!isset($traits[$trait])) $traits[$trait] = ['score' => 0, 'type' => 'permanent'];
        $traits[$trait]['score'] += $score;
    };

    foreach (str_split($type) as $letter) {
        foreach (MBTI_TRAIT_MAPPING[$letter] ?? [] as $rule) $add($rule['trait'], $rule['score']);
    }

    return $traits;
}

// ═══════════════════════════════════════════════════
// highlights: 既存解説文からの抽出（新規に文章を生成しない）
// ═══════════════════════════════════════════════════
/** @return string[] */
function mbti_computeHighlights(array $raw): array {
    return [
        MBTI_DATA[$raw['type']]['desc'],
    ];
}

// ═══════════════════════════════════════════════════
// extras: 表示用の付加データのみ（raw項目の複製はしない）
// {type, label, value} のオブジェクト配列で統一する（shichu・tarot・seizaと同じ形式）
// ═══════════════════════════════════════════════════
/** @return array<int, array{type:string, label:string, value:mixed}> */
function mbti_computeExtras(array $raw): array {
    return [
        ['type' => 'famous', 'label' => '同じタイプの有名人', 'value' => MBTI_DATA[$raw['type']]['famous']],
    ];
}

/**
 * @return array{
 *   meta: array{title:string, subtitle:string},
 *   raw: array{type:string},
 *   traits: array<string, array{score:int, type:string}>,
 *   highlights: string[],
 *   extras: array<int, array{type:string, label:string, value:mixed}>
 * }
 */
function mbti_buildResultData(string $type): array {
    $raw = ['type' => $type];

    return [
        'meta' => mbti_computeMeta($raw),
        'raw' => $raw,
        'traits' => mbti_computeTraits($raw['type']),
        'highlights' => mbti_computeHighlights($raw),
        'extras' => mbti_computeExtras($raw),
    ];
}

/**
 * @param array<int, int> $answers 10問分の回答（各0または1）
 * @return array{
 *   meta: array{title:string, subtitle:string},
 *   raw: array{type:string},
 *   traits: array<string, array{score:int, type:string}>,
 *   highlights: string[],
 *   extras: array<int, array{type:string, label:string, value:mixed}>
 * }
 */
function mbtiEngine(array $answers): array {
    return mbti_buildResultData(mbti_calcType($answers));
}

/**
 * mbtiEngine()は10問回答からのみResultDataを構築できるが、既にMBTIタイプを
 * 知っている利用者向けに、タイプコードから直接ResultDataを構築する入口
 * （love.phpが使う。docs/love/07-implementation.mdの(a)案：love.php自体は
 * 10問診断UIを持たず、既知のタイプを直接受け取る）。
 *
 * @param string $type 4文字のMBTIタイプコード（例：'ENTP'）
 * @return array{
 *   meta: array{title:string, subtitle:string},
 *   raw: array{type:string},
 *   traits: array<string, array{score:int, type:string}>,
 *   highlights: string[],
 *   extras: array<int, array{type:string, label:string, value:mixed}>
 * }
 */
function mbtiEngineFromType(string $type): array {
    if (!isset(MBTI_DATA[$type])) {
        throw new InvalidArgumentException("不正なMBTIタイプ: {$type}");
    }
    return mbti_buildResultData($type);
}
