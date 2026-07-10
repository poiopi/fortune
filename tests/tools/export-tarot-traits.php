<?php
declare(strict_types=1);

/**
 * export-tarot-traits.php
 *
 * inc/tarot-trait-mapping.php（Rule ID: T001〜T044）を、tarot-engine.php の
 * tarot_computeTraits() とは独立に再実装し、tests/cases/tarot-golden.php の
 * 44入力すべてに対して期待値を算出し、tests/cases/tarot-traits.php へ書き出す。
 *
 * 実行方法: php tests/tools/export-tarot-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-trait-mapping.php';

function independent_computeTraits(int $cardOrder, bool $isUpright): array {
    $rules = TAROT_TRAIT_MAPPING[$cardOrder][$isUpright ? 'upright' : 'reversed'];
    $traits = [];
    foreach ($rules as $rule) {
        $t = $rule['trait'];
        if (!isset($traits[$t])) $traits[$t] = ['score' => 0, 'type' => 'transient'];
        $traits[$t]['score'] += $rule['score'];
    }
    ksort($traits);
    return $traits;
}

function phpVal($v, int $indent): string {
    $pad = str_repeat('    ', $indent);
    $pad1 = str_repeat('    ', $indent + 1);
    if ($v === null) return 'null';
    if (is_bool($v)) return $v ? 'true' : 'false';
    if (is_int($v) || is_float($v)) return (string)$v;
    if (is_string($v)) return "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], $v) . "'";
    if (is_array($v)) {
        if (count($v) === 0) return '[]';
        $isList = array_keys($v) === range(0, count($v) - 1);
        $items = [];
        foreach ($v as $k => $item) {
            $keyPart = $isList ? '' : "'" . $k . "' => ";
            $items[] = $pad1 . $keyPart . phpVal($item, $indent + 1);
        }
        return "[\n" . implode(",\n", $items) . ",\n" . $pad . ']';
    }
    throw new Exception('unsupported type');
}

$golden = require __DIR__ . '/../cases/tarot-golden.php';
$traitCases = [];
foreach ($golden['cases'] as $case) {
    $input = $case['input'];
    $traitCases[] = [
        'input' => $input,
        'expected' => independent_computeTraits($input['cardOrder'], $input['isUpright']),
    ];
}

$doc = [
    'generator' => 'inc/tarot-trait-mapping.php（独立再実装：export-tarot-traits.php）',
    'basedOnGolden' => 'tests/cases/tarot-golden.php',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($traitCases),
    'cases' => $traitCases,
];

$out = "<?php\n" .
    "// tests/cases/tarot-traits.php\n" .
    "// Trait Snapshot: inc/tarot-trait-mapping.php を44入力に適用した期待値。\n" .
    "// 生成元: tests/tools/export-tarot-traits.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/tarot-traits.php', $out);
echo "Wrote " . count($traitCases) . " trait cases to tests/cases/tarot-traits.php\n";
