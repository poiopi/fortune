<?php
declare(strict_types=1);

/**
 * inc/love-style.php
 *
 * Style（恋愛スタイル）導出式。docs/love/04-style.mdの一覧をそのままPHP配列へ
 * 写像したもの（単一の情報源）。新しい設計判断は加えない。
 *
 * 各Styleは、5つのPrimitiveの加重和として定義する（負の重みは許容するが、
 * Primitive自体の意味は変えない。docs/love/01-principles.md 原則11）。
 * 係数は仮値であり、docs/love/04-style.mdの「重複確認」節の検証を経て確定した
 * ものである。9216通りの実データで再較正する場合はdocs/love/04-style.mdと
 * 同時に更新する。
 */

require_once __DIR__ . '/love-primitive-mapping.php';

const LOVE_STYLE_MAPPING = [
    '積極性' => [
        ['primitive' => PRIMITIVE_ACTION, 'weight' => 0.6],
        ['primitive' => PRIMITIVE_SENSITIVITY, 'weight' => 0.4],
    ],
    '愛情表現' => [
        ['primitive' => PRIMITIVE_ACTION, 'weight' => 0.3],
        ['primitive' => PRIMITIVE_SENSITIVITY, 'weight' => 0.7],
    ],
    '包容力' => [
        ['primitive' => PRIMITIVE_RELIABILITY, 'weight' => 0.6],
        ['primitive' => PRIMITIVE_SENSITIVITY, 'weight' => 0.4],
    ],
    '独占欲' => [
        ['primitive' => PRIMITIVE_SENSITIVITY, 'weight' => 0.7],
        ['primitive' => PRIMITIVE_AUTONOMY, 'weight' => -0.3],
    ],
    '惚れやすさ' => [
        ['primitive' => PRIMITIVE_SENSITIVITY, 'weight' => 0.6],
        ['primitive' => PRIMITIVE_TRANSFORM, 'weight' => 0.4],
    ],
    '嫉妬深さ' => [
        ['primitive' => PRIMITIVE_SENSITIVITY, 'weight' => 0.6],
        ['primitive' => PRIMITIVE_RELIABILITY, 'weight' => -0.4],
    ],
    '恋愛の慎重さ' => [
        ['primitive' => PRIMITIVE_RELIABILITY, 'weight' => 0.6],
        ['primitive' => PRIMITIVE_AUTONOMY, 'weight' => 0.4],
    ],
];

/**
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array<string, float> Style名 => 加重和スコア
 */
function love_computeStyles(array $primitives): array {
    $styles = [];
    foreach (LOVE_STYLE_MAPPING as $styleName => $terms) {
        $value = 0.0;
        foreach ($terms as $term) {
            $value += $term['weight'] * ($primitives[$term['primitive']] ?? 0);
        }
        $styles[$styleName] = $value;
    }
    return $styles;
}
