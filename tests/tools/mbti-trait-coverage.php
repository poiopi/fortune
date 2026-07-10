<?php
declare(strict_types=1);

/**
 * mbti-trait-coverage.php
 *
 * inc/mbti-trait-mapping.php（M001〜M009）を棚卸しし、各traitが何件のルールで
 * 使われているかを集計する。0件のtraitがあればMappingの偏りにすぐ気付ける。
 *
 * 実行方法: php tests/tools/mbti-trait-coverage.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/trait-vocabulary.php';

$allTraits = [TRAIT_ACTION, TRAIT_CARE, TRAIT_STABILITY, TRAIT_INDEP, TRAIT_PASSION, TRAIT_CHANGE, TRAIT_CHALLENGE, TRAIT_DUTY, TRAIT_INTUITION];
$counts = array_fill_keys($allTraits, 0);
$noContribution = [];

foreach (['E', 'I', 'S', 'N', 'T', 'F', 'J', 'P'] as $letter) {
    $rules = MBTI_TRAIT_MAPPING[$letter] ?? [];
    if (count($rules) === 0) $noContribution[] = $letter;
    foreach ($rules as $rule) $counts[$rule['trait']]++;
}

echo "=== mbti Trait Coverage ===\n\n";
$missing = [];
foreach ($allTraits as $t) {
    $mark = $counts[$t] > 0 ? '○' : '×';
    echo sprintf("%-8s %s  (%d件)\n", $t, $mark, $counts[$t]);
    if ($counts[$t] === 0) $missing[] = $t;
}

echo "\n寄与なしの文字: " . count($noContribution) . "件\n";
foreach ($noContribution as $n) echo "  - {$n}\n";

if (count($missing) > 0) {
    echo "\n[警告] 1度も使われていないtraitがあります: " . implode(', ', $missing) . "\n";
    exit(1);
}
echo "\n全9種のtraitが最低1回は出現しています。\n";
exit(0);
