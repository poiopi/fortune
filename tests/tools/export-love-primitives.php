<?php
declare(strict_types=1);

/**
 * export-love-primitives.php
 *
 * Source Engine（MBTI・Blood・Seiza）→ axis_aggregateTraits() → axis_computeAxes()
 * → love_computePrimitives() という統合パイプライン全体のGolden Master／
 * Coverageレポートを生成する。
 *
 * 入力空間：MBTI 16タイプ × Blood 4種 × Seiza (signIndex×innerTypeIndex) 12×12=144
 *          = 9216通り、全数（docs/engine-template.md Rule2：1万件未満は全数方針）。
 * Seizaは「12星座」だけでなく signIndex と innerTypeIndex の両方にtraitsが依存する
 * （seiza-trait-mapping.php参照）ため、12ではなく144を使う。timeZoneCodeはtraitsに
 * 寄与しないため対象外（seiza_computeTraits()の引数を見ても分かる通り）。
 *
 * MBTI・Bloodの型→traits変換は、それぞれの既存Golden Master／Trait Snapshotで
 * 既に検証済みのため、ここでは mbti_computeTraits()／blood_computeTraits() を
 * そのまま呼び出す（型コードを直接渡す。10問回答やユーザー入力の再現はしない）。
 * Seizaも同様にseiza_computeTraits(signIndex, innerTypeIndex)を直接呼び出す
 * （月日→signIndex/innerTypeIndex変換は既存のseiza-golden.phpで別途検証済み）。
 *
 * 実行方法: php tests/tools/export-love-primitives.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-primitive-mapping.php';

$mbtiTypes = array_keys(MBTI_DATA);
$bloodTypes = array_keys(BLOOD_DATA);
if (count($mbtiTypes) !== 16) throw new Exception('MBTIは16件のはず');
if (count($bloodTypes) !== 4) throw new Exception('Bloodは4件のはず');

// MBTI・Bloodのtraitsは型ごとに1回だけ計算すればよい（16+4回で足りる。9216回は不要）
$mbtiTraitsByType = [];
foreach ($mbtiTypes as $t) $mbtiTraitsByType[$t] = mbti_computeTraits($t);
$bloodTraitsByType = [];
foreach ($bloodTypes as $t) $bloodTraitsByType[$t] = blood_computeTraits($t);

// Seizaのtraitsは(signIndex, innerTypeIndex)の144通りごとに1回
$seizaTraitsByPair = [];
for ($sign = 0; $sign < 12; $sign++) {
    for ($inner = 0; $inner < 12; $inner++) {
        $seizaTraitsByPair["$sign,$inner"] = seiza_computeTraits($sign, $inner);
    }
}
if (count($seizaTraitsByPair) !== 144) throw new Exception('Seizaの組み合わせは144件のはず');

$allTraits = [TRAIT_ACTION, TRAIT_CARE, TRAIT_STABILITY, TRAIT_INDEP, TRAIT_PASSION, TRAIT_CHANGE, TRAIT_CHALLENGE, TRAIT_DUTY, TRAIT_INTUITION];
$allPrimitives = [PRIMITIVE_ACTION, PRIMITIVE_RELIABILITY, PRIMITIVE_SENSITIVITY, PRIMITIVE_AUTONOMY, PRIMITIVE_TRANSFORM];

$cases = [];
$primitiveStats = [];
foreach ($allPrimitives as $p) $primitiveStats[$p] = [];

foreach ($mbtiTypes as $mbtiType) {
    foreach ($bloodTypes as $bloodType) {
        foreach ($seizaTraitsByPair as $pairKey => $seizaTraits) {
            [$sign, $inner] = explode(',', $pairKey);

            $resultDatas = [
                'mbti' => ['traits' => $mbtiTraitsByType[$mbtiType]],
                'blood' => ['traits' => $bloodTraitsByType[$bloodType]],
                'seiza' => ['traits' => $seizaTraits],
            ];

            $aggregated = axis_aggregateTraits(array_values($resultDatas));
            $axisValues = axis_computeAxes($aggregated);
            $primitives = love_computePrimitives($axisValues);

            foreach ($allPrimitives as $p) $primitiveStats[$p][] = $primitives[$p];

            $cases[] = [
                'input' => ['mbti' => $mbtiType, 'blood' => $bloodType, 'seizaSign' => (int)$sign, 'seizaInnerType' => (int)$inner],
                'expected' => ['axis' => $axisValues, 'primitives' => $primitives],
            ];
        }
    }
}

$total = count($cases);
if ($total !== 9216) throw new Exception("9216件のはずが{$total}件");
echo "全数生成: {$total}件\n";

// ─────────────────────────────────────────────
// Primitive Coverage: 全Primitiveが最低1回は非ゼロ値を取るか
// ─────────────────────────────────────────────
echo "\n=== Primitive Coverage ===\n";
$missingPrimitives = [];
foreach ($allPrimitives as $p) {
    $nonZero = count(array_filter($primitiveStats[$p], fn($v) => $v !== 0));
    $mark = $nonZero > 0 ? '○' : '×';
    echo sprintf("%-10s %s  (非ゼロ %d/%d件)\n", $p, $mark, $nonZero, $total);
    if ($nonZero === 0) $missingPrimitives[] = $p;
}
if (count($missingPrimitives) > 0) {
    fwrite(STDERR, "[警告] 常にゼロのPrimitiveがあります: " . implode(', ', $missingPrimitives) . "\n");
    exit(1);
}

// ─────────────────────────────────────────────
// Primitive分布（平均・最小・最大・中央値・標準偏差）
// ─────────────────────────────────────────────
function median(array $values): float {
    sort($values);
    $n = count($values);
    $mid = intdiv($n, 2);
    return $n % 2 === 0 ? ($values[$mid - 1] + $values[$mid]) / 2 : $values[$mid];
}
function stddev(array $values): float {
    $mean = array_sum($values) / count($values);
    $variance = array_sum(array_map(fn($v) => ($v - $mean) ** 2, $values)) / count($values);
    return sqrt($variance);
}

echo "\n=== Primitive分布（9216件） ===\n";
echo sprintf("%-10s %8s %8s %8s %8s %8s\n", 'Primitive', '平均', '最小', '最大', '中央値', '標準偏差');
foreach ($allPrimitives as $p) {
    $values = $primitiveStats[$p];
    echo sprintf(
        "%-10s %8.2f %8d %8d %8.1f %8.2f\n",
        $p,
        array_sum($values) / count($values),
        min($values),
        max($values),
        median($values),
        stddev($values)
    );
}

// ─────────────────────────────────────────────
// PHP値変換・書き出し
// ─────────────────────────────────────────────
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

$doc = [
    'generator' => 'Source Engines -> axis_aggregateTraits() -> axis_computeAxes() -> love_computePrimitives()（独立再実装ではなく実運用コードそのものを通した記録）',
    'basedOn' => 'MBTI16 x Blood4 x Seiza(signIndex12 x innerTypeIndex12=144) = 9216通り全数',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => $total,
    'cases' => $cases,
];

$out = "<?php\n" .
    "// tests/cases/love-primitives-snapshot.php\n" .
    "// Golden Master: Source Engine統合パイプライン（Trait集約→Axis→Primitive）を\n" .
    "// 9216通り全件に適用した期待値。\n" .
    "// 生成元: tests/tools/export-love-primitives.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/love-primitives-snapshot.php', $out);
echo "\nWrote {$total} cases to tests/cases/love-primitives-snapshot.php\n";
