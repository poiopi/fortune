<?php
declare(strict_types=1);

/**
 * export-blood-traits.php
 *
 * inc/blood-trait-mapping.php（B001〜B009）を、blood-engine.php の
 * blood_computeTraits() とは独立に再実装し、4型全件に対して期待値を算出し、
 * tests/cases/blood-traits.php へ書き出す。
 *
 * あわせてType Coverage（4型全部がtraitsを持つか）と、Axisベクトルの
 * 相互衝突（4型が同一のAxisベクトルにならないか）を確認する。
 *
 * 実行方法: php tests/tools/export-blood-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/blood-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/axis-mapping.php';

function independent_computeTraits(string $type): array {
    $traits = [];
    $add = function (string $t, int $s) use (&$traits) {
        if (!isset($traits[$t])) $traits[$t] = ['score' => 0, 'type' => 'permanent'];
        $traits[$t]['score'] += $s;
    };
    foreach (BLOOD_TRAIT_MAPPING[$type] ?? [] as $r) $add($r['trait'], $r['score']);
    ksort($traits);
    return $traits;
}

function traitsToAxisVector(array $traits): array {
    $axes = [AXIS_ACTION => 0, AXIS_RELIABILITY => 0, AXIS_SENSITIVITY => 0, AXIS_AUTONOMY => 0, AXIS_TRANSFORM => 0];
    foreach ($traits as $traitName => $v) {
        foreach (AXIS_MAPPING[$traitName] ?? [] as $rule) {
            $axes[$rule['axis']] += $v['score'];
        }
    }
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

$types = array_keys(BLOOD_DATA);
if (count($types) !== 4) throw new Exception('BLOOD_DATAは4件のはずが' . count($types) . '件');

$traitCases = [];
$emptyTypes = [];
$axisVectors = [];
foreach ($types as $type) {
    $expected = independent_computeTraits($type);
    if (count($expected) === 0) $emptyTypes[] = $type;
    $traitCases[] = ['input' => ['type' => $type], 'expected' => $expected];
    $axisVectors[$type] = traitsToAxisVector($expected);
}

if (count($emptyTypes) > 0) {
    fwrite(STDERR, "[警告] traitsが空の型があります: " . implode(', ', $emptyTypes) . "\n");
    exit(1);
}
echo "Type Coverage: 全4型がtraitsを持つことを確認\n";

// Axisベクトルの相互衝突チェック（最適化はしない。衝突の有無だけを報告する）
echo "\n=== Axisベクトル ===\n";
foreach ($axisVectors as $type => $vec) {
    echo sprintf("%-4s %s\n", $type, json_encode($vec, JSON_UNESCAPED_UNICODE));
}
$collision = false;
$typeList = array_keys($axisVectors);
for ($i = 0; $i < count($typeList); $i++) {
    for ($j = $i + 1; $j < count($typeList); $j++) {
        if ($axisVectors[$typeList[$i]] === $axisVectors[$typeList[$j]]) {
            echo "[警告] {$typeList[$i]}と{$typeList[$j]}のAxisベクトルが衝突しています\n";
            $collision = true;
        }
    }
}
if ($collision) { fwrite(STDERR, "Axisベクトルの衝突が見つかりました\n"); exit(1); }
echo "4型とも相互に異なるAxisベクトルであることを確認\n";

$doc = [
    'generator' => 'inc/blood-trait-mapping.php（独立再実装：export-blood-traits.php）',
    'basedOn' => '4型全件（A/B/O/AB）',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($traitCases),
    'cases' => $traitCases,
];

$out = "<?php\n" .
    "// tests/cases/blood-traits.php\n" .
    "// Trait Snapshot: inc/blood-trait-mapping.php を4型全件に適用した期待値。\n" .
    "// 生成元: tests/tools/export-blood-traits.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/blood-traits.php', $out);
echo "\nWrote " . count($traitCases) . " trait cases to tests/cases/blood-traits.php\n";
