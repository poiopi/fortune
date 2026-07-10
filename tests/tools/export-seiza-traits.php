<?php
declare(strict_types=1);

/**
 * export-seiza-traits.php
 *
 * inc/seiza-trait-mapping.php（Z001〜Z019）を、seiza-engine.php の
 * seiza_computeTraits() とは独立に再実装し、tests/cases/seiza-golden.php の
 * 1830入力すべてに対して期待値を算出し、tests/cases/seiza-traits.php へ書き出す。
 *
 * 実行方法: php tests/tools/export-seiza-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-trait-mapping.php';

function independent_computeTraits(int $signIndex, int $innerTypeIndex): array {
    $sign = SEIZA_SIGNS[$signIndex];
    $traits = [];
    $add = function (string $t, int $s) use (&$traits) {
        if (!isset($traits[$t])) $traits[$t] = ['score' => 0, 'type' => 'permanent'];
        $traits[$t]['score'] += $s;
    };
    foreach (SEIZA_TRAIT_MAPPING['element'][$sign['element']] ?? [] as $r) $add($r['trait'], $r['score']);
    foreach (SEIZA_TRAIT_MAPPING['quality'][$sign['quality']] ?? [] as $r) $add($r['trait'], $r['score']);
    foreach (SEIZA_TRAIT_MAPPING['innerType'][$innerTypeIndex] ?? [] as $r) $add($r['trait'], $r['score']);
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

$golden = require __DIR__ . '/../cases/seiza-golden.php';
$traitCases = [];
foreach ($golden['cases'] as $case) {
    $expected = $case['expected'];
    $traitCases[] = [
        'input' => $case['input'],
        'expected' => independent_computeTraits($expected['signIndex'], $expected['innerTypeIndex']),
    ];
}

$doc = [
    'generator' => 'inc/seiza-trait-mapping.php（独立再実装：export-seiza-traits.php）',
    'basedOnGolden' => 'tests/cases/seiza-golden.php',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($traitCases),
    'cases' => $traitCases,
];

$out = "<?php\n" .
    "// tests/cases/seiza-traits.php\n" .
    "// Trait Snapshot: inc/seiza-trait-mapping.php を1830入力に適用した期待値。\n" .
    "// 生成元: tests/tools/export-seiza-traits.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/seiza-traits.php', $out);
echo "Wrote " . count($traitCases) . " trait cases to tests/cases/seiza-traits.php\n";
