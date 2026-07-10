<?php
declare(strict_types=1);

/**
 * export-bundle-ids.php
 *
 * tests/cases/axis-values-snapshot.php（50件）を入力とし、
 * axis-engine.php の axis_selectTop2() とは独立にIdentity/Today Bundle IDを算出し、
 * tests/cases/bundle-id-snapshot.php へ書き出す。
 *
 * Step2-3bの時点ではBundleの本文（archetype/advice等）ではなく、
 * 「どのBundle IDが選ばれるか」だけを検証する（文章はStep2-3cで書き換わるため）。
 *
 * 実行方法: php tests/tools/export-bundle-ids.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-vocabulary.php';

function independent_selectTop2(array $axisValues, string $rankKey): array {
    $entries = [];
    foreach (AXIS_PRIORITY_ORDER as $priorityIndex => $axisName) {
        $score = $axisValues[$axisName][$rankKey] ?? 0;
        $entries[] = ['axis' => $axisName, 'score' => $score, 'priorityIndex' => $priorityIndex];
    }
    usort($entries, function ($a, $b) {
        if ($a['score'] !== $b['score']) return $b['score'] <=> $a['score'];
        return $a['priorityIndex'] <=> $b['priorityIndex'];
    });
    return [$entries[0]['axis'], $entries[1]['axis']];
}

function independent_bundleId(string $prefix, string $primary, string $secondary): string {
    return $prefix . '_' . AXIS_CODE[$primary] . '_' . AXIS_CODE[$secondary];
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

$axisSnapshot = require __DIR__ . '/../cases/axis-values-snapshot.php';

$bundleCases = [];
foreach ($axisSnapshot['cases'] as $case) {
    $axisValues = $case['expected'];
    [$idPrimary, $idSecondary] = independent_selectTop2($axisValues, 'permanent');
    [$tdPrimary, $tdSecondary] = independent_selectTop2($axisValues, 'transient');
    $bundleCases[] = [
        'shichuInput' => $case['shichuInput'],
        'tarotInput' => $case['tarotInput'],
        'seizaInput' => $case['seizaInput'],
        'expected' => [
            'identityBundleId' => independent_bundleId('ID', $idPrimary, $idSecondary),
            'todayBundleId' => independent_bundleId('TD', $tdPrimary, $tdSecondary),
        ],
    ];
}

$doc = [
    'generator' => 'axis-vocabulary.php AXIS_PRIORITY_ORDER（独立再実装：export-bundle-ids.php）',
    'basedOn' => 'tests/cases/axis-values-snapshot.php',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($bundleCases),
    'cases' => $bundleCases,
];

$out = "<?php\n" .
    "// tests/cases/bundle-id-snapshot.php\n" .
    "// Bundle ID Snapshot: Axis値からIdentity/Today Bundle IDを選ぶロジックの期待値。\n" .
    "// 本文（archetype/advice等）は対象外（Step2-3cで書き換わるため）。\n" .
    "// 生成元: tests/tools/export-bundle-ids.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/bundle-id-snapshot.php', $out);
echo "Wrote " . count($bundleCases) . " bundle ID cases to tests/cases/bundle-id-snapshot.php\n";
