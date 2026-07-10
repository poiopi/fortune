<?php
declare(strict_types=1);

/**
 * export-mbti-traits.php
 *
 * inc/mbti-trait-mapping.php（M001〜M009）を、mbti-engine.php の
 * mbti_computeTraits() とは独立に再実装し、16タイプ全件に対して期待値を算出し、
 * tests/cases/mbti-traits.php へ書き出す。
 *
 * あわせてType Coverage（全16タイプがtraitsを持つか、空配列になるタイプがないか）
 * を確認する。
 *
 * 実行方法: php tests/tools/export-mbti-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-trait-mapping.php';

function independent_computeTraits(string $type): array {
    $traits = [];
    $add = function (string $t, int $s) use (&$traits) {
        if (!isset($traits[$t])) $traits[$t] = ['score' => 0, 'type' => 'permanent'];
        $traits[$t]['score'] += $s;
    };
    foreach (str_split($type) as $letter) {
        foreach (MBTI_TRAIT_MAPPING[$letter] ?? [] as $r) $add($r['trait'], $r['score']);
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

$types = array_keys(MBTI_DATA);
if (count($types) !== 16) throw new Exception('MBTI_DATAは16件のはずが' . count($types) . '件');

$traitCases = [];
$emptyTypes = [];
foreach ($types as $type) {
    $expected = independent_computeTraits($type);
    if (count($expected) === 0) $emptyTypes[] = $type;
    $traitCases[] = ['input' => ['type' => $type], 'expected' => $expected];
}

if (count($emptyTypes) > 0) {
    fwrite(STDERR, "[警告] traitsが空のタイプがあります: " . implode(', ', $emptyTypes) . "\n");
    exit(1);
}
echo "Type Coverage: 全16タイプがtraitsを持つことを確認\n";

$doc = [
    'generator' => 'inc/mbti-trait-mapping.php（独立再実装：export-mbti-traits.php）',
    'basedOn' => '16タイプ全件（tests/cases/mbti-golden.phpとは無関係。traitsは4文字タイプにのみ依存するため）',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($traitCases),
    'cases' => $traitCases,
];

$out = "<?php\n" .
    "// tests/cases/mbti-traits.php\n" .
    "// Trait Snapshot: inc/mbti-trait-mapping.php を16タイプ全件に適用した期待値。\n" .
    "// 生成元: tests/tools/export-mbti-traits.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/mbti-traits.php', $out);
echo "Wrote " . count($traitCases) . " trait cases to tests/cases/mbti-traits.php\n";
