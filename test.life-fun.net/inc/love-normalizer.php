<?php
declare(strict_types=1);

/**
 * inc/love-normalizer.php
 *
 * Primitiveの生スコアをHigh/Mid/Lowへ変換する（docs/love/08-normalizer.md）。
 * スコアの絶対値ではなく、9216通り全数（tests/cases/love-primitives-snapshot.php）
 * から算出した実測百分位（P33/P67）における母集団上の位置を表す。
 *
 * Primitiveごとに独立した閾値を持つ（共通閾値は採用しない。docs/love/08-normalizer.md
 * 参照：Trait Mappingの構造上、Primitiveごとにスケールが本質的に異なるため）。
 *
 * 各Primitiveの実際のLow/Mid/High比率は33/33/33に均等ではない（自立性はLow65.6%等）。
 * これは離散値かつ特定の値に集中する分布から生じる自然な結果であり、意図的な調整は
 * 行わない（母集団上の真の相対位置を表すことを優先する）。
 */

require_once __DIR__ . '/love-primitive-mapping.php';

const NORMALIZE_PRIMITIVE_THRESHOLDS = [
    PRIMITIVE_ACTION      => ['p33' => 2, 'p67' => 4],
    PRIMITIVE_RELIABILITY => ['p33' => 4, 'p67' => 7],
    PRIMITIVE_SENSITIVITY => ['p33' => 4, 'p67' => 6],
    PRIMITIVE_AUTONOMY    => ['p33' => 1, 'p67' => 2],
    PRIMITIVE_TRANSFORM   => ['p33' => 2, 'p67' => 3],
];

/**
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array<string, string> Primitive名 => 'Low'|'Mid'|'High'
 */
function love_normalizePrimitives(array $primitives): array {
    $result = [];
    foreach ($primitives as $name => $score) {
        $t = NORMALIZE_PRIMITIVE_THRESHOLDS[$name] ?? null;
        if ($t === null) {
            throw new InvalidArgumentException("Normalizer閾値が未定義のPrimitive: {$name}");
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
