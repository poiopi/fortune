<?php
declare(strict_types=1);

/**
 * inc/love-bundle.php
 *
 * Bundle選定（docs/love/10-bundle.md）。入力はPrimitiveのみ（原則3・9。
 * Style／Tendency／Influenceは一切参照しない）。
 *
 * sanseiの axis_selectTop2() / axis_getIdentityBundle() と同じ選定パターン
 * （上位2つを優先順位リストで決定的にタイブレークして選ぶ）を、Primitiveへ
 * 独自実装したもの（Level2相当。コードは共有しない。原則6）。
 *
 * Love DomainはPermanent Engineであり、Today Bundle相当（transientベース）を
 * 持たないため、20通り1種類のみ（sanseiの40通り＝IdentityBundle20＋TodayBundle20
 * とは規模が異なる）。
 */

require_once __DIR__ . '/love-primitive-mapping.php';

/**
 * AXIS_PRIORITY_ORDER（inc/axis-vocabulary.php）をPrimitive名へ1:1で置き換えたもの。
 * sansei自身、この優先順位の決定根拠は文書化されていない。新たな恣意的基準を
 * 作らず、既存の順序をそのまま継承する（docs/love/10-bundle.md）。
 */
const PRIMITIVE_PRIORITY_ORDER = [
    PRIMITIVE_ACTION, PRIMITIVE_RELIABILITY, PRIMITIVE_SENSITIVITY, PRIMITIVE_AUTONOMY, PRIMITIVE_TRANSFORM,
];

const PRIMITIVE_CODE = [
    PRIMITIVE_ACTION      => 'ACT',
    PRIMITIVE_RELIABILITY => 'REL',
    PRIMITIVE_SENSITIVITY => 'SEN',
    PRIMITIVE_AUTONOMY    => 'AUT',
    PRIMITIVE_TRANSFORM   => 'TRA',
];

/**
 * Primitive値をpermanentスコアの降順で選び、同点はPRIMITIVE_PRIORITY_ORDERで
 * 決定的にタイブレークして上位2つを返す（axis_selectTop2()と同じロジック）。
 *
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array{0: string, 1: string} [主軸, 副軸]
 */
function love_selectTop2Primitives(array $primitives): array {
    $entries = [];
    foreach (PRIMITIVE_PRIORITY_ORDER as $priorityIndex => $name) {
        $entries[] = ['name' => $name, 'score' => $primitives[$name] ?? 0, 'priorityIndex' => $priorityIndex];
    }
    usort($entries, function ($a, $b) {
        if ($a['score'] !== $b['score']) return $b['score'] <=> $a['score'];
        return $a['priorityIndex'] <=> $b['priorityIndex'];
    });
    return [$entries[0]['name'], $entries[1]['name']];
}

function love_bundleId(string $primaryPrimitive, string $secondaryPrimitive): string {
    return 'LOVE_' . PRIMITIVE_CODE[$primaryPrimitive] . '_' . PRIMITIVE_CODE[$secondaryPrimitive];
}

/**
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array{id: string, primary: string, secondary: string}
 */
function love_selectBundle(array $primitives): array {
    [$primary, $secondary] = love_selectTop2Primitives($primitives);
    return [
        'id' => love_bundleId($primary, $secondary),
        'primary' => $primary,
        'secondary' => $secondary,
    ];
}

/**
 * Bundle ID → Text ID（docs/love/10-bundle.md）。20エントリ全てを定義する
 * （出現率が低い/0でも省略しない。将来trait mapping変更でID未定義エラーに
 * ならないようにするため）。出現率の低い8通りはtext_*_sharedへ共有する。
 */
const BUNDLE_TEXT_ID_MAP = [
    'LOVE_REL_SEN' => 'text_rel_sen',
    'LOVE_REL_ACT' => 'text_rel_act',
    'LOVE_SEN_ACT' => 'text_sen_act',
    'LOVE_SEN_REL' => 'text_sen_rel',
    'LOVE_ACT_REL' => 'text_act_rel',
    'LOVE_ACT_SEN' => 'text_act_sen',
    'LOVE_REL_TRA' => 'text_rel_tra',
    'LOVE_SEN_TRA' => 'text_sen_tra',
    'LOVE_REL_AUT' => 'text_rel_aut',
    'LOVE_TRA_ACT' => 'text_tra_act',
    'LOVE_TRA_REL' => 'text_tra_rel',
    'LOVE_ACT_TRA' => 'text_act_tra',
    'LOVE_TRA_SEN' => 'text_tra_shared',
    'LOVE_SEN_AUT' => 'text_aut_shared',
    'LOVE_AUT_REL' => 'text_aut_shared',
    'LOVE_AUT_TRA' => 'text_aut_shared',
    'LOVE_TRA_AUT' => 'text_aut_shared',
    'LOVE_ACT_AUT' => 'text_aut_shared',
    'LOVE_AUT_SEN' => 'text_aut_shared',
    'LOVE_AUT_ACT' => 'text_aut_shared',
];

function love_resolveBundleTextId(string $bundleId): string {
    if (!isset(BUNDLE_TEXT_ID_MAP[$bundleId])) {
        throw new InvalidArgumentException("Text IDが未定義のBundle: {$bundleId}");
    }
    return BUNDLE_TEXT_ID_MAP[$bundleId];
}
