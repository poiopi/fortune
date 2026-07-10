<?php
declare(strict_types=1);

/**
 * blood-trait-coverage.php
 *
 * inc/blood-trait-mapping.php（B001〜B009）を棚卸しし、各traitが何件のルールで
 * 使われているかを集計する。0件のtraitがあればMappingの偏りにすぐ気付ける。
 *
 * 実行方法: php tests/tools/blood-trait-coverage.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/blood-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/trait-vocabulary.php';

$allTraits = [TRAIT_ACTION, TRAIT_CARE, TRAIT_STABILITY, TRAIT_INDEP, TRAIT_PASSION, TRAIT_CHANGE, TRAIT_CHALLENGE, TRAIT_DUTY, TRAIT_INTUITION];
$counts = array_fill_keys($allTraits, 0);
$noContribution = [];

foreach (['A', 'B', 'O', 'AB'] as $type) {
    $rules = BLOOD_TRAIT_MAPPING[$type] ?? [];
    if (count($rules) === 0) $noContribution[] = $type;
    foreach ($rules as $rule) $counts[$rule['trait']]++;
}

echo "=== blood Trait Coverage ===\n\n";
$missing = [];
foreach ($allTraits as $t) {
    $mark = $counts[$t] > 0 ? '○' : '×';
    echo sprintf("%-8s %s  (%d件)\n", $t, $mark, $counts[$t]);
    if ($counts[$t] === 0) $missing[] = $t;
}

echo "\n寄与なしの型: " . count($noContribution) . "件\n";
foreach ($noContribution as $n) echo "  - {$n}\n";

if (count($missing) > 0) {
    echo "\n[警告] 1度も使われていないtraitがあります: " . implode(', ', $missing) . "\n";
    exit(1);
}
echo "\n全9種のtraitが最低1回は出現しています。\n";
exit(0);
