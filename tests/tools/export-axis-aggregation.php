<?php
declare(strict_types=1);

/**
 * export-axis-aggregation.php
 *
 * shichu/tarot/seizaの既存ResultData Snapshotから3占術分の組み合わせを50件サンプリングし、
 * docs/sansei-engine-design.md §5「Trait Aggregation」の契約を、axis-engine.phpの
 * axis_aggregateTraits()とは独立に再実装して期待値を算出し、
 * tests/cases/axis-aggregation-snapshot.php へ書き出す。
 *
 * 実行方法: php tests/tools/export-axis-aggregation.php
 */

function independent_aggregateTraits(array $resultDatas): array {
    $aggregated = [];
    foreach ($resultDatas as $rd) {
        foreach ($rd['traits'] as $name => $trait) {
            if (!isset($aggregated[$name])) $aggregated[$name] = ['permanent' => 0, 'transient' => 0, 'total' => 0];
            if ($trait['type'] === 'permanent') $aggregated[$name]['permanent'] += $trait['score'];
            elseif ($trait['type'] === 'transient') $aggregated[$name]['transient'] += $trait['score'];
            $aggregated[$name]['total'] += $trait['score'];
        }
    }
    ksort($aggregated);
    return $aggregated;
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

$shichuSnap = require __DIR__ . '/../cases/shichu-resultdata-snapshot.php';
$tarotSnap = require __DIR__ . '/../cases/tarot-resultdata-snapshot.php';
$seizaSnap = require __DIR__ . '/../cases/seiza-resultdata-snapshot.php';

$shichuCases = $shichuSnap['cases'];
$tarotCases = $tarotSnap['cases'];
$seizaCases = $seizaSnap['cases'];

const SAMPLE_COUNT = 50;
$combos = [];
for ($i = 0; $i < SAMPLE_COUNT; $i++) {
    $s = $shichuCases[$i % count($shichuCases)];
    $t = $tarotCases[$i % count($tarotCases)];
    $z = $seizaCases[$i % count($seizaCases)];
    $combos[] = [
        'shichuInput' => $s['input'],
        'tarotInput' => $t['input'],
        'seizaInput' => $z['input'],
        'resultDatas' => [$s['resultData'], $t['resultData'], $z['resultData']],
    ];
}

$snapshotCases = [];
foreach ($combos as $combo) {
    $snapshotCases[] = [
        'shichuInput' => $combo['shichuInput'],
        'tarotInput' => $combo['tarotInput'],
        'seizaInput' => $combo['seizaInput'],
        'expected' => independent_aggregateTraits($combo['resultDatas']),
    ];
}

$doc = [
    'generator' => 'docs/sansei-engine-design.md §5（独立再実装：export-axis-aggregation.php）',
    'note' => '3占術のResultData Snapshotから' . SAMPLE_COUNT . '件の組み合わせをサンプリングし、Trait Aggregationの期待値を独立実装で算出したもの。',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($snapshotCases),
    'cases' => $snapshotCases,
];

$out = "<?php\n" .
    "// tests/cases/axis-aggregation-snapshot.php\n" .
    "// Aggregation Snapshot: 3占術のResultDataからのtraits集約の期待値。\n" .
    "// 生成元: tests/tools/export-axis-aggregation.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/axis-aggregation-snapshot.php', $out);
echo "Wrote " . count($snapshotCases) . " aggregation cases to tests/cases/axis-aggregation-snapshot.php\n";
