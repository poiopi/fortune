<?php
declare(strict_types=1);

/**
 * inc/love-primitive-mapping.php
 *
 * Shared Axis LibraryのAxisを恋愛ドメインの語彙（Primitive）へ翻訳する
 * Anti-Corruption Layer（docs/love/02-domain-map.md 2節）。
 *
 * Axisと1:1対応を維持し、増減させない（docs/love/01-principles.md 原則11・12、
 * docs/love/03-primitives.md）。
 *
 * Primitiveは各Axisの`permanent`値のみを読む。`transient`・`total`は使わない
 * （原則12：Love DomainはPermanent Engineであり、同一入力では常に同一結果を
 * 返す。将来transientを持つSource Engineを追加しても、その寄与はLove Domainの
 * 外側にある別レイヤーとしてのみ扱う）。
 *
 * このファイルはLevel 1関数（axis_aggregateTraits／axis_computeAxes）の出力のみに
 * 依存する。Level 2関数（axis_getIdentityBundle等）・Source Engineの生ResultDataへは
 * 一切依存しない（原則5・6・10）。
 */

require_once __DIR__ . '/axis-vocabulary.php';

const PRIMITIVE_ACTION     = '行動主導性';
const PRIMITIVE_RELIABILITY = '誠実性';
const PRIMITIVE_SENSITIVITY = '情動性';
const PRIMITIVE_AUTONOMY   = '自立性';
const PRIMITIVE_TRANSFORM  = '変化志向';

const PRIMITIVE_AXIS_MAP = [
    PRIMITIVE_ACTION      => AXIS_ACTION,
    PRIMITIVE_RELIABILITY => AXIS_RELIABILITY,
    PRIMITIVE_SENSITIVITY => AXIS_SENSITIVITY,
    PRIMITIVE_AUTONOMY    => AXIS_AUTONOMY,
    PRIMITIVE_TRANSFORM   => AXIS_TRANSFORM,
];

/**
 * @param array<string, array{permanent:int, transient:int, total:int}> $axisValues axis_computeAxes()の出力
 * @return array<string, int> Primitive名 => permanentスコア
 */
function love_computePrimitives(array $axisValues): array {
    $primitives = [];
    foreach (PRIMITIVE_AXIS_MAP as $primitiveName => $axisName) {
        $primitives[$primitiveName] = $axisValues[$axisName]['permanent'] ?? 0;
    }
    return $primitives;
}
