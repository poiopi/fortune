<?php
declare(strict_types=1);

/**
 * export-shichu-traits.php
 *
 * docs/shichu-trait-mapping.md（Rule ID: S001〜S013）を、shichu-engine.php の
 * shichu_computeTraits() とは独立に再実装し、tests/cases/shichu-golden.php の
 * raw（既にGolden Masterとして検証済み）からtraitsの期待値を算出して
 * tests/cases/shichu-traits.php へ書き出す。
 *
 * 目的：shichuEngine()側の実装がMapping Table仕様と食い違っていないかを、
 * 同じコードを呼ばない別実装との突き合わせで確認するため（自己参照的な検証を避ける）。
 *
 * 実行方法: php tests/tools/export-shichu-traits.php
 */

const TRAIT_ACTION    = '行動力';
const TRAIT_CARE      = '慎重さ';
const TRAIT_STABILITY = '安定性';
const TRAIT_INDEP     = '独立';
const TRAIT_PASSION   = '情熱';
const TRAIT_CHANGE    = '変化';
const TRAIT_CHALLENGE = '挑戦';
const TRAIT_DUTY      = '責任感';
const TRAIT_INTUITION = '直感';

/**
 * docs/shichu-trait-mapping.md の対応表を、独立にそのまま書き下したもの。
 * shichu-engine.php の実装とはコードを共有しない。
 */
function independent_computeTraits(array $raw): array {
    $traits = [];
    $add = function (string $trait, int $score) use (&$traits) {
        if (!isset($traits[$trait])) $traits[$trait] = ['score' => 0, 'type' => 'permanent'];
        $traits[$trait]['score'] += $score;
    };

    // S001-S003
    if ($raw['dayStrength']['label'] === '身強') $add(TRAIT_ACTION, 2);
    if ($raw['dayStrength']['label'] === '身弱') $add(TRAIT_CARE, 2);
    if ($raw['dayStrength']['label'] === '中和') $add(TRAIT_STABILITY, 2);

    // S004-S013（十神名で判定。tenGodIndexではなく別軸＝JUSSHIN_NAMESの並びから独立に再現）
    $jusshinNames = ['比肩','劫財','食神','傷官','偏財','正財','偏官','正官','偏印','印綬'];
    $ruleByName = [
        '比肩' => TRAIT_INDEP,     // S004
        '劫財' => TRAIT_ACTION,    // S005
        '食神' => TRAIT_PASSION,   // S006
        '傷官' => TRAIT_CHANGE,    // S007
        '偏財' => TRAIT_ACTION,    // S008
        '正財' => TRAIT_STABILITY, // S009
        '偏官' => TRAIT_CHALLENGE, // S010
        '正官' => TRAIT_DUTY,      // S011
        '偏印' => TRAIT_INTUITION, // S012
        '印綬' => TRAIT_CARE,      // S013
    ];
    foreach ($raw['tenGodGrid'] as $entry) {
        $name = $jusshinNames[$entry['tenGodIndex']] ?? null;
        if ($name === null) continue;
        $trait = $ruleByName[$name] ?? null;
        if ($trait !== null) $add($trait, 1);
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

$golden = require __DIR__ . '/../cases/shichu-golden.php';
$traitCases = [];
foreach ($golden['cases'] as $case) {
    $traitCases[] = [
        'input' => $case['input'],
        'expected' => independent_computeTraits($case['expected']),
    ];
}

$doc = [
    'generator' => 'docs/shichu-trait-mapping.md（独立再実装：export-shichu-traits.php）',
    'basedOnGolden' => 'tests/cases/shichu-golden.php',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($traitCases),
    'cases' => $traitCases,
];

$out = "<?php\n" .
    "// tests/cases/shichu-traits.php\n" .
    "// Trait Snapshot: docs/shichu-trait-mapping.md の対応表を、tests/cases/shichu-golden.php の\n" .
    "// rawに適用した期待値。shichu-engine.php の実装とは独立に計算している。\n" .
    "// 生成元: tests/tools/export-shichu-traits.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/shichu-traits.php', $out);
echo "Wrote " . count($traitCases) . " trait cases to tests/cases/shichu-traits.php\n";
