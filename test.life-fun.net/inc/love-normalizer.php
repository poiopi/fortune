<?php
declare(strict_types=1);

/**
 * inc/love-normalizer.php
 *
 * Primitive／Style／Tendencyの生スコアをHigh/Mid/Lowへ変換する（docs/love/08-normalizer.md）。
 * スコアの絶対値ではなく、9216通り全数（tests/cases/love-primitives-snapshot.php・
 * tests/cases/love-style-tendency-snapshot.php）から算出した実測百分位（P33/P67）に
 * おける母集団上の位置を表す。
 *
 * Primitive／Style／Tendencyそれぞれ独立した閾値を持つ（共通の閾値テーブルは
 * 採用しない。docs/love/08-normalizer.md参照：分布の形も値域も異なるため）。
 *
 * 実際のLow/Mid/High比率は33/33/33に均等ではない（例：自立性はLow65.6%等）。
 * これは離散値かつ特定の値に集中する分布から生じる自然な結果であり、意図的な調整は
 * 行わない（母集団上の真の相対位置を表すことを優先する）。
 */

require_once __DIR__ . '/love-primitive-mapping.php';
require_once __DIR__ . '/love-style.php';
require_once __DIR__ . '/love-tendency.php';

const NORMALIZE_PRIMITIVE_THRESHOLDS = [
    PRIMITIVE_ACTION      => ['p33' => 2, 'p67' => 4],
    PRIMITIVE_RELIABILITY => ['p33' => 4, 'p67' => 7],
    PRIMITIVE_SENSITIVITY => ['p33' => 4, 'p67' => 6],
    PRIMITIVE_AUTONOMY    => ['p33' => 1, 'p67' => 2],
    PRIMITIVE_TRANSFORM   => ['p33' => 2, 'p67' => 3],
];

const NORMALIZE_STYLE_THRESHOLDS = [
    '積極性'     => ['p33' => 3.20, 'p67' => 4.40],
    '愛情表現'   => ['p33' => 3.40, 'p67' => 4.80],
    '包容力'     => ['p33' => 4.40, 'p67' => 5.80],
    '独占欲'     => ['p33' => 2.20, 'p67' => 3.60],
    '惚れやすさ' => ['p33' => 3.20, 'p67' => 4.20],
    '嫉妬深さ'   => ['p33' => -0.40, 'p67' => 1.60],
    '恋愛の慎重さ' => ['p33' => 3.00, 'p67' => 4.60],
];

const NORMALIZE_TENDENCY_THRESHOLDS = [
    '結婚志向' => ['p33' => 2.14, 'p67' => 4.20],
    '浮気耐性' => ['p33' => 1.70, 'p67' => 3.90],
];

/**
 * @param array<string, int|float> $scores
 * @param array<string, array{p33: int|float, p67: int|float}> $thresholds
 * @param string $label エラーメッセージ用（'Primitive'|'Style'|'Tendency'）
 * @return array<string, string> 名前 => 'Low'|'Mid'|'High'
 */
function love_classify(array $scores, array $thresholds, string $label): array {
    $result = [];
    foreach ($scores as $name => $score) {
        $t = $thresholds[$name] ?? null;
        if ($t === null) {
            throw new InvalidArgumentException("Normalizer閾値が未定義の{$label}: {$name}");
        }
        if ($score <= $t['p33']) {
            $result[$name] = 'Low';
        } elseif ($score <= $t['p67']) {
            $result[$name] = 'Mid';
        } else {
            $result[$name] = 'High';
        }
    }
    return $result;
}

/**
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array<string, string> Primitive名 => 'Low'|'Mid'|'High'
 */
function love_normalizePrimitives(array $primitives): array {
    return love_classify($primitives, NORMALIZE_PRIMITIVE_THRESHOLDS, 'Primitive');
}

/**
 * @param array<string, float> $styles love_computeStyles()の出力
 * @return array<string, string> Style名 => 'Low'|'Mid'|'High'
 */
function love_normalizeStyles(array $styles): array {
    return love_classify($styles, NORMALIZE_STYLE_THRESHOLDS, 'Style');
}

/**
 * @param array<string, float> $tendencies love_computeTendencies()の出力
 * @return array<string, string> Tendency名 => 'Low'|'Mid'|'High'
 */
function love_normalizeTendencies(array $tendencies): array {
    return love_classify($tendencies, NORMALIZE_TENDENCY_THRESHOLDS, 'Tendency');
}
