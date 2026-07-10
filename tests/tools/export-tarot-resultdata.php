<?php
declare(strict_types=1);

/**
 * export-tarot-resultdata.php
 *
 * tarotEngine()（Step1-8完成版）をGolden Masterの44入力すべてに対して実行し、
 * meta/raw/traits/highlights/extras の完全なResultData（TarotResult）を
 * tests/cases/tarot-resultdata-snapshot.php へ書き出す。
 *
 * 実行方法: php tests/tools/export-tarot-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';

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

$golden = require __DIR__ . '/../cases/tarot-golden.php';

$snapshotCases = [];
foreach ($golden['cases'] as $case) {
    $input = $case['input'];
    $result = tarotEngine($input['cardOrder'], $input['isUpright']);
    $snapshotCases[] = ['input' => $input, 'resultData' => $result];
}

$doc = [
    'generator' => 'test.life-fun.net/inc/tarot-engine.php (Step1-8完成版)',
    'note' => 'meta/raw/traits/highlights/extrasを含む完全なResultData（TarotResult）のスナップショット。',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($snapshotCases),
    'cases' => $snapshotCases,
];

$out = "<?php\n" .
    "// tests/cases/tarot-resultdata-snapshot.php\n" .
    "// TarotResult（完全なResultData）のスナップショット。\n" .
    "// 生成元: tests/tools/export-tarot-resultdata.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/tarot-resultdata-snapshot.php', $out);
echo "Wrote " . count($snapshotCases) . " ResultData snapshots to tests/cases/tarot-resultdata-snapshot.php\n";
