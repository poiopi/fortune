<?php
declare(strict_types=1);

/**
 * export-love-style-tendency.php
 *
 * tests/cases/love-primitives-snapshot.php（9216通り全数、既存）のPrimitive値に
 * love_computeStyles()／love_computeTendencies()（実運用コード）を適用し、
 * Style／Tendencyの分布・百分位を算出したうえで、
 * tests/cases/love-style-tendency-snapshot.php へ書き出す。
 *
 * Primitive Snapshotと同じ思想（docs/love/07-implementation.mdの「Style/Tendency
 * Snapshot」）：将来Style/Tendencyの導出式・係数を変更しても、この時点の値からの
 * 差分を機械的に検知できるようにする。
 *
 * 実行方法: php tests/tools/export-love-style-tendency.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/love-primitive-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-style.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-tendency.php';

$snapshot = require __DIR__ . '/../cases/love-primitives-snapshot.php';
$primitiveCases = $snapshot['cases'];
$total = count($primitiveCases);
if ($total !== 9216) throw new Exception("love-primitives-snapshot.phpは9216件のはずが{$total}件");

$styleNames = array_keys(LOVE_STYLE_MAPPING);
$tendencyNames = array_keys(LOVE_TENDENCY_MAPPING);

$cases = [];
$styleStats = array_fill_keys($styleNames, []);
$tendencyStats = array_fill_keys($tendencyNames, []);

foreach ($primitiveCases as $case) {
    $primitives = $case['expected']['primitives'];
    $styles = love_computeStyles($primitives);
    $tendencies = love_computeTendencies($primitives);

    foreach ($styleNames as $s) $styleStats[$s][] = $styles[$s];
    foreach ($tendencyNames as $t) $tendencyStats[$t][] = $tendencies[$t];

    $cases[] = [
        'input' => $case['input'],
        'expected' => ['styles' => $styles, 'tendencies' => $tendencies],
    ];
}

echo "全数生成: {$total}件\n";

function percentile(array $sorted, float $p): float {
    $n = count($sorted);
    $idx = ($p / 100) * ($n - 1);
    $lo = (int)floor($idx);
    $hi = (int)ceil($idx);
    if ($lo === $hi) return (float)$sorted[$lo];
    $frac = $idx - $lo;
    return $sorted[$lo] + ($sorted[$hi] - $sorted[$lo]) * $frac;
}
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

function report(string $title, array $stats): void {
    echo "\n=== {$title}分布（9216件） ===\n";
    echo sprintf("%-14s %8s %8s %8s %8s %8s %8s %8s\n", '項目', '平均', '最小', '最大', '中央値', '標準偏差', 'P33', 'P67');
    foreach ($stats as $name => $values) {
        $sorted = $values;
        sort($sorted);
        echo sprintf(
            "%-14s %8.2f %8.1f %8.1f %8.1f %8.2f %8.2f %8.2f\n",
            $name,
            array_sum($values) / count($values),
            min($values),
            max($values),
            median($values),
            stddev($values),
            percentile($sorted, 33.33),
            percentile($sorted, 66.67)
        );
    }
}

report('Style', $styleStats);
report('Tendency', $tendencyStats);

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
    'generator' => 'love_computeStyles() / love_computeTendencies()（実運用コード）をlove-primitives-snapshot.phpへ適用',
    'basedOn' => 'tests/cases/love-primitives-snapshot.php（9216通り全数）',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => $total,
    'cases' => $cases,
];

$out = "<?php\n" .
    "// tests/cases/love-style-tendency-snapshot.php\n" .
    "// Golden Master: Style/Tendency導出式を9216通り全件に適用した期待値。\n" .
    "// 生成元: tests/tools/export-love-style-tendency.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/love-style-tendency-snapshot.php', $out);
echo "\nWrote {$total} cases to tests/cases/love-style-tendency-snapshot.php\n";
