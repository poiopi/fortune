<?php
declare(strict_types=1);

/**
 * inc/seiza-engine.php
 *
 * seiza.php の星座・内面タイプ判定（クライアントサイドJavaScript）をPHPへ忠実に移植したもの。
 * docs/sansei-engine-design.md（Step0）/ docs/engine-template.md の手順に基づく。
 *
 * shichuと異なり、太陽星座・内面タイプの判定は「月日」のみに依存し「年」は使わない
 * （西洋占星術の性質上、正しい）。そのため seizaEngine() は年を受け取らない
 * （raw = 実際に使う値だけを入力とする、という原則をここでも守る）。
 *
 * 入力空間は「月日366通り×時間帯5種＝1830通り」の有限集合のため、Golden Masterは
 * サンプリングではなく全数（tarotと同じ考え方）。
 *
 * Step1-9時点では raw のみを返す。traits・meta・highlights・extras は Step1-10〜1-12で追加する。
 *
 * 正しさの基準は tests/cases/seiza-golden.php（Golden Master、1830件全数）。
 */

require_once __DIR__ . '/seiza-data.php';
require_once __DIR__ . '/seiza-trait-mapping.php';

function seiza_getZodiacIndex(int $month, int $day): int {
    $FIRST_SIGN = [0,1,2,3,4,5,6,7,8,9,10,11];
    $CUTOFF     = [19,18,20,19,20,21,22,22,22,23,21,21];
    $m = $month - 1;
    return $day <= $CUTOFF[$m] ? $FIRST_SIGN[$m] : ($FIRST_SIGN[$m] + 1) % 12;
}

function seiza_getInnerTypeIndex(int $month, int $day): int {
    return ($month * 31 + $day) % 12;
}

function seiza_getTimeZoneIndex(string $code): int {
    $map = ['M' => 0, 'D' => 1, 'N' => 2, 'L' => 3, 'U' => 4];
    return $map[$code] ?? 4;
}

// ═══════════════════════════════════════════════════
// traits変換（inc/seiza-trait-mapping.php が単一の情報源。Rule ID: Z001〜Z019）
// element・qualityはrawではなくsignIndexからその場で導出する（派生値をrawへ保存しない）。
// timeZoneIndexはtraitsマッピングの対象外（性格特性ではなく文脈情報のため）。
// ═══════════════════════════════════════════════════
/**
 * @return array<string, array{score:int, type:string}>
 */
function seiza_computeTraits(int $signIndex, int $innerTypeIndex): array {
    $sign = SEIZA_SIGNS[$signIndex];
    $element = $sign['element'];
    $quality = $sign['quality'];

    $traits = [];
    $add = function (string $trait, int $score) use (&$traits) {
        if (!isset($traits[$trait])) $traits[$trait] = ['score' => 0, 'type' => 'permanent'];
        $traits[$trait]['score'] += $score;
    };

    foreach (SEIZA_TRAIT_MAPPING['element'][$element] ?? [] as $rule) $add($rule['trait'], $rule['score']);
    foreach (SEIZA_TRAIT_MAPPING['quality'][$quality] ?? [] as $rule) $add($rule['trait'], $rule['score']);
    foreach (SEIZA_TRAIT_MAPPING['innerType'][$innerTypeIndex] ?? [] as $rule) $add($rule['trait'], $rule['score']);

    return $traits;
}

// ═══════════════════════════════════════════════════
// meta: ResultData自身の見出し。HTMLの<title>とは無関係
// ═══════════════════════════════════════════════════
/** @return array{title:string, subtitle:string} */
function seiza_computeMeta(array $raw): array {
    $sign = SEIZA_SIGNS[$raw['signIndex']];
    $inner = SEIZA_INNER_TYPES[$raw['innerTypeIndex']];
    // seiza.php本体と同じ「ニックネーム」ロジック（inner.prefix + sign.suffix）を流用
    $nickname = $inner['prefix'] . $sign['suffix'];
    return [
        'title' => '西洋占星術',
        'subtitle' => "{$sign['name']}・{$nickname}",
    ];
}

// ═══════════════════════════════════════════════════
// highlights: 既存解説文からの抽出（新規に文章を生成しない）
// ═══════════════════════════════════════════════════
/** @return string[] */
function seiza_computeHighlights(array $raw): array {
    return [
        SEIZA_SIGN_DESC[$raw['signIndex']],
        SEIZA_INNER_TYPES[$raw['innerTypeIndex']]['desc'],
    ];
}

// ═══════════════════════════════════════════════════
// extras: 表示用の付加データのみ（raw項目の複製はしない）
// {type, label, value} のオブジェクト配列で統一する（shichu・tarotと同じ形式）
// ═══════════════════════════════════════════════════
/** @return array<int, array{type:string, label:string, value:mixed}> */
function seiza_computeExtras(array $raw): array {
    $sign = SEIZA_SIGNS[$raw['signIndex']];
    $element = SEIZA_ELEMENTS[$sign['element']];
    $quality = SEIZA_QUALITIES[$sign['quality']];
    $tz = SEIZA_TIME_ZONES[$raw['timeZoneIndex']];

    return [
        ['type' => 'love_style', 'label' => '恋愛スタイル', 'value' => SEIZA_LOVE_STYLE[$raw['signIndex']]],
        ['type' => 'jobs', 'label' => '向いている仕事', 'value' => SEIZA_JOBS[$raw['signIndex']]],
        ['type' => 'element', 'label' => 'エレメント', 'value' => ['name' => $element['name'], 'desc' => $element['desc']]],
        ['type' => 'quality', 'label' => 'クオリティ', 'value' => ['name' => $quality['name'], 'desc' => $quality['desc']]],
        ['type' => 'time_zone', 'label' => '生まれた時間帯', 'value' => ['label' => $tz['label'], 'desc' => $tz['desc']]],
    ];
}

/**
 * 与えられた月日・時間帯からResultDataを組み立てる純粋関数。
 *
 * @return array{
 *   meta: array{title:string, subtitle:string},
 *   raw: array{signIndex:int, innerTypeIndex:int, timeZoneIndex:int},
 *   traits: array,
 *   highlights: string[],
 *   extras: array
 * }
 */
function seizaEngine(int $month, int $day, string $timeZoneCode): array {
    $raw = [
        'signIndex' => seiza_getZodiacIndex($month, $day),
        'innerTypeIndex' => seiza_getInnerTypeIndex($month, $day),
        'timeZoneIndex' => seiza_getTimeZoneIndex($timeZoneCode),
    ];

    return [
        'meta' => seiza_computeMeta($raw),
        'raw' => $raw,
        'traits' => seiza_computeTraits($raw['signIndex'], $raw['innerTypeIndex']),
        'highlights' => seiza_computeHighlights($raw),
        'extras' => seiza_computeExtras($raw),
    ];
}
