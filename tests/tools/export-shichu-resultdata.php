<?php
declare(strict_types=1);

/**
 * export-shichu-resultdata.php
 *
 * shichuEngine()（Step1-4完成版）を Golden Master の100入力すべてに対して実行し、
 * meta/raw/traits/highlights/extras の完全なResultData（ShichuResult）を
 * tests/cases/shichu-resultdata-snapshot.php へ書き出す。
 *
 * 目的：
 *   1. tarot・seizaがResultData化する際の「完成見本」として参照する
 *   2. 将来 shichuEngine() をリファクタした際の回帰基準にする
 *
 * 実行方法: php tests/tools/export-shichu-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';

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

$snapshotCases = [];
foreach ($golden['cases'] as $case) {
    $input = $case['input'];
    $birth = ['year' => $input['year'], 'month' => $input['month'], 'day' => $input['day'], 'hour' => $input['hour'], 'gender' => $input['gender']];
    $result = shichuEngine($birth);
    $snapshotCases[] = ['input' => $input, 'resultData' => $result];
}

$doc = [
    'generator' => 'test.life-fun.net/inc/shichu-engine.php (Step1-4完成版)',
    'note' => 'meta/raw/traits/highlights/extrasを含む完全なResultData（ShichuResult）のスナップショット。tarot・seizaのResultData化の完成見本、および将来のリファクタ時の回帰基準として使う。',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($snapshotCases),
    'cases' => $snapshotCases,
];

$out = "<?php\n" .
    "// tests/cases/shichu-resultdata-snapshot.php\n" .
    "// ShichuResult（完全なResultData）のスナップショット。tarot・seizaの完成見本。\n" .
    "// 生成元: tests/tools/export-shichu-resultdata.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/shichu-resultdata-snapshot.php', $out);
echo "Wrote " . count($snapshotCases) . " ResultData snapshots to tests/cases/shichu-resultdata-snapshot.php\n";
