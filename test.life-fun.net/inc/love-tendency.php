<?php
declare(strict_types=1);

/**
 * inc/love-tendency.php
 *
 * Tendency（推定傾向）導出式。docs/love/05-tendency.mdの一覧をそのままPHP配列へ
 * 写像したもの（単一の情報源）。導出の仕組みはStyle（inc/love-style.php）と同じ
 * （5 Primitiveの加重和）。異なるのは、性格による説明力に限界がある概念である
 * ため、表示時は断定を避ける（Writing Rules側の責務。ここでは扱わない）。
 */

require_once __DIR__ . '/love-primitive-mapping.php';

const LOVE_TENDENCY_MAPPING = [
    '結婚志向' => [
        ['primitive' => PRIMITIVE_RELIABILITY, 'weight' => 0.7],
        ['primitive' => PRIMITIVE_TRANSFORM, 'weight' => -0.3],
    ],
    '浮気耐性' => [
        ['primitive' => PRIMITIVE_RELIABILITY, 'weight' => 0.7],
        ['primitive' => PRIMITIVE_ACTION, 'weight' => -0.3],
    ],
];

/**
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array<string, float> Tendency名 => 加重和スコア
 */
function love_computeTendencies(array $primitives): array {
    $tendencies = [];
    foreach (LOVE_TENDENCY_MAPPING as $name => $terms) {
        $value = 0.0;
        foreach ($terms as $term) {
            $value += $term['weight'] * ($primitives[$term['primitive']] ?? 0);
        }
        $tendencies[$name] = $value;
    }
    return $tendencies;
}
