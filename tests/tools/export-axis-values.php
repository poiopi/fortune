<?php
declare(strict_types=1);

/**
 * export-axis-values.php
 *
 * tests/cases/axis-aggregation-snapshot.php（Aggregation Snapshot、50件）を入力とし、
 * inc/axis-mapping.php（A001〜A009）を axis-engine.php の axis_computeAxes() とは
 * 独立に再実装して、Axis Snapshotの期待値を算出し tests/cases/axis-values-snapshot.php へ書き出す。
 *
 * 実行方法: php tests/tools/export-axis-values.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-mapping.php';

function independent_computeAxes(array $aggregatedTraits): array {
    $axes = [];
    foreach ($aggregatedTraits as $traitName => $values) {
        $rules = AXIS_MAPPING[$traitName] ?? [];
        foreach ($rules as $rule) {
            $axisName = $rule['axis'];
            if (!isset($axes[$axisName])) $axes[$axisName] = ['permanent' => 0, 'transient' => 0, 'total' => 0];
            $axes[$axisName]['permanent'] += $values['permanent'];
            $axes[$axisName]['transient'] += $values['transient'];
            $axes[$axisName]['total'] += $values['total'];
        }
    }
    ksort($axes);
    return $axes;
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

$aggSnapshot = require __DIR__ . '/../cases/axis-aggregation-snapshot.php';

$axisCases = [];
foreach ($aggSnapshot['cases'] as $case) {
    $axisCases[] = [
        'shichuInput' => $case['shichuInput'],
        'tarotInput' => $case['tarotInput'],
        'seizaInput' => $case['seizaInput'],
        'expected' => independent_computeAxes($case['expected']),
    ];
}

$doc = [
    'generator' => 'inc/axis-mapping.php（独立再実装：export-axis-values.php）',
    'basedOn' => 'tests/cases/axis-aggregation-snapshot.php',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($axisCases),
    'cases' => $axisCases,
];

$out = "<?php\n" .
    "// tests/cases/axis-values-snapshot.php\n" .
    "// Axis Snapshot: Aggregation SnapshotにAxis変換（A001〜A009）を適用した期待値。\n" .
    "// 生成元: tests/tools/export-axis-values.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/axis-values-snapshot.php', $out);
echo "Wrote " . count($axisCases) . " axis cases to tests/cases/axis-values-snapshot.php\n";
