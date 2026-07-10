<?php
declare(strict_types=1);

/**
 * test-axis-boundary-cases.php
 *
 * axis-engine.php のBundle選択について、境界ケース4件を確認する。
 *   1. Permanentが全軸0
 *   2. Transientが全軸0
 *   3. PermanentとTransientで上位2軸が完全に逆転
 *   4. 5軸すべて同点（permanent・transientとも）
 *
 * Golden Master的な「JSとの一致」ではなく、設計通りの決定的な挙動になっているかを
 * 目視確認するための境界テスト。
 *
 * 実行方法: php tests/tools/test-axis-boundary-cases.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';

function axisSet(array $values): array {
    $out = [];
    foreach ($values as $axis => [$p, $t]) {
        $out[$axis] = ['permanent' => $p, 'transient' => $t, 'total' => $p + $t];
    }
    return $out;
}

$cases = [];

// ① Permanentが全軸0（Transientのみに差がある）
$cases['① Permanentが全軸0'] = axisSet([
    AXIS_ACTION      => [0, 5],
    AXIS_RELIABILITY => [0, 1],
    AXIS_SENSITIVITY => [0, 0],
    AXIS_AUTONOMY    => [0, 0],
    AXIS_TRANSFORM   => [0, 3],
]);

// ② Transientが全軸0（Permanentのみに差がある）
$cases['② Transientが全軸0'] = axisSet([
    AXIS_ACTION      => [5, 0],
    AXIS_RELIABILITY => [1, 0],
    AXIS_SENSITIVITY => [0, 0],
    AXIS_AUTONOMY    => [0, 0],
    AXIS_TRANSFORM   => [3, 0],
]);

// ③ PermanentとTransientで上位2軸が完全に逆転
// permanent上位2: 行動性(10)・堅実性(8)  /  transient上位2: 変革性(10)・自律性(8)
$cases['③ 上位2軸が完全逆転'] = axisSet([
    AXIS_ACTION      => [10, 0],
    AXIS_RELIABILITY => [8, 0],
    AXIS_SENSITIVITY => [1, 1],
    AXIS_AUTONOMY    => [0, 8],
    AXIS_TRANSFORM   => [0, 10],
]);

// ④ 5軸すべて同点（permanent・transientとも）
$cases['④ 5軸すべて同点'] = axisSet([
    AXIS_ACTION      => [3, 3],
    AXIS_RELIABILITY => [3, 3],
    AXIS_SENSITIVITY => [3, 3],
    AXIS_AUTONOMY    => [3, 3],
    AXIS_TRANSFORM   => [3, 3],
]);

$allOk = true;
foreach ($cases as $label => $axisValues) {
    echo "=== {$label} ===\n";
    $identity = axis_getIdentityBundle($axisValues);
    $today = axis_getTodayBundle($axisValues);
    $summary = axis_composeSummary($identity['summaryBase'], $today['summaryOverlay']);

    echo "IdentityBundle ID: {$identity['id']} (主:{$identity['primaryAxis']} 副:{$identity['secondaryAxis']})\n";
    echo "TodayBundle ID:    {$today['id']} (主:{$today['primaryAxis']} 副:{$today['secondaryAxis']})\n";
    echo "Archetype: {$identity['archetype']}\n";
    echo "Summary:   {$summary}\n";
    echo "Advice:    {$today['advice']}\n\n";
}

// 期待される決定性の検証
$errors = [];

// ①: Permanent全軸0 → 優先順位順で [行動性, 堅実性] になるはず
$id1 = axis_getIdentityBundle($cases['① Permanentが全軸0']);
if ($id1['id'] !== 'ID_ACT_REL') $errors[] = "①IdentityがID_ACT_RELにならない: {$id1['id']}";

// ②: Transient全軸0 → 優先順位順で [行動性, 堅実性] になるはず
$td2 = axis_getTodayBundle($cases['② Transientが全軸0']);
if ($td2['id'] !== 'TD_ACT_REL') $errors[] = "②TodayがTD_ACT_RELにならない: {$td2['id']}";

// ③: IdentityとTodayが完全に異なる軸ペアになるはず（重なりがない）
$id3 = axis_getIdentityBundle($cases['③ 上位2軸が完全逆転']);
$td3 = axis_getTodayBundle($cases['③ 上位2軸が完全逆転']);
if ($id3['id'] !== 'ID_ACT_REL') $errors[] = "③IdentityがID_ACT_RELにならない: {$id3['id']}";
if ($td3['id'] !== 'TD_TRA_AUT') $errors[] = "③TodayがTD_TRA_AUTにならない: {$td3['id']}";

// ④: 5軸すべて同点 → Identity/Todayとも優先順位順で[行動性,堅実性]になるはず
$id4 = axis_getIdentityBundle($cases['④ 5軸すべて同点']);
$td4 = axis_getTodayBundle($cases['④ 5軸すべて同点']);
if ($id4['id'] !== 'ID_ACT_REL') $errors[] = "④IdentityがID_ACT_RELにならない: {$id4['id']}";
if ($td4['id'] !== 'TD_ACT_REL') $errors[] = "④TodayがTD_ACT_RELにならない: {$td4['id']}";

if (count($errors) === 0) {
    echo "総合結果: 全境界ケースが期待通りの決定的な挙動\n";
    exit(0);
}
echo "総合結果: 問題あり\n";
foreach ($errors as $e) echo "  - {$e}\n";
exit(1);
