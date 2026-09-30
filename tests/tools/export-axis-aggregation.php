<?php
declare(strict_types=1);

/**
 * export-axis-aggregation.php
 *
 * shichu/tarot/seizaの既存ResultData Snapshotから3占術分の組み合わせを50件サンプリングし
 * （＋12星座カバレッジ用に各signIndex 1件ずつ計12件を追加、合計62件）、
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

// 12星座カバレッジ（2026-10-01追加）：上の50件はseiza-resultdataの先頭50件＝全件山羊座のため、
// 星座固有のtraits（element・quality）の差がAxis以降のテストに現れなかった。
// signIndex 0〜11それぞれについて、seiza-resultdataのcasesで最初に現れる1件を追加する。
// shichu/tarotは上のループと同じく通し番号 $i（SAMPLE_COUNT から続ける）の剰余で選ぶ。
$firstIndexBySign = [];
foreach ($seizaCases as $idx => $z) {
    $signIndex = $z['resultData']['raw']['signIndex'];
    if (!isset($firstIndexBySign[$signIndex])) $firstIndexBySign[$signIndex] = $idx;
}
ksort($firstIndexBySign);
if (count($firstIndexBySign) !== 12) throw new Exception('seiza-resultdata に12星座が揃っていない');
$i = SAMPLE_COUNT;
foreach ($firstIndexBySign as $seizaIdx) {
    $s = $shichuCases[$i % count($shichuCases)];
    $t = $tarotCases[$i % count($tarotCases)];
    $z = $seizaCases[$seizaIdx];
    $combos[] = [
        'shichuInput' => $s['input'],
        'tarotInput' => $t['input'],
        'seizaInput' => $z['input'],
        'resultDatas' => [$s['resultData'], $t['resultData'], $z['resultData']],
    ];
    $i++;
}
$signCoverageCount = count($firstIndexBySign);

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
    'note' => '3占術のResultData Snapshotから' . SAMPLE_COUNT . '件の組み合わせをサンプリングし（seizaは先頭' . SAMPLE_COUNT . '件＝全件山羊座）、'
        . 'さらに12星座カバレッジとして各signIndexの最初の1件を使った' . $signCoverageCount . '件を追加して、Trait Aggregationの期待値を独立実装で算出したもの。',
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
