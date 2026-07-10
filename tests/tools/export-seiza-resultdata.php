<?php
declare(strict_types=1);

/**
 * export-seiza-resultdata.php
 *
 * seizaEngine()（Step1-12完成版）をGolden Masterの1830入力すべてに対して実行し、
 * ResultData Validatorで全件検証したうえで、全1830件をtests/cases/seiza-resultdata-snapshot.php
 * へ保存する（shichu・tarotと同じ「全件保存」方式に統一。tests/はgitignore済みのため
 * リポジトリ肥大化の心配はない。Validatorだけでは検知できないmeta/highlights/extrasの
 * 将来リグレッションも、この全件Snapshotで守る）。
 *
 * 実行方法: php tests/tools/export-seiza-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/resultdata-validator.php';

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

$golden = require __DIR__ . '/../cases/seiza-golden.php';

// 全1830件をResultData Validatorで検証しつつ、Snapshotとして保存する
$pass = 0; $fail = 0; $failSamples = [];
$snapshotCases = [];
foreach ($golden['cases'] as $case) {
    $input = $case['input'];
    $result = seizaEngine($input['month'], $input['day'], $input['timeZoneCode']);
    try {
        validateResultData($result);
        $pass++;
    } catch (InvalidArgumentException $e) {
        $fail++;
        if (count($failSamples) < 5) $failSamples[] = ['input' => $input, 'error' => $e->getMessage()];
    }
    $snapshotCases[] = ['input' => $input, 'resultData' => $result];
}
echo "validateResultData (全{$golden['caseCount']}件): PASS={$pass} FAIL={$fail}\n";
foreach ($failSamples as $f) {
    echo "  FAIL: " . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . " => {$f['error']}\n";
}

$doc = [
    'generator' => 'test.life-fun.net/inc/seiza-engine.php (Step1-12完成版)',
    'note' => 'meta/raw/traits/highlights/extrasを含む完全なResultData（SeizaResult）のスナップショット。Golden Masterの1830件全件を保存する（shichu・tarotと同じ方式）。',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($snapshotCases),
    'cases' => $snapshotCases,
];

$out = "<?php\n" .
    "// tests/cases/seiza-resultdata-snapshot.php\n" .
    "// SeizaResult（完全なResultData）のスナップショット。1830件全件。\n" .
    "// 生成元: tests/tools/export-seiza-resultdata.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/seiza-resultdata-snapshot.php', $out);
echo "Wrote " . count($snapshotCases) . " ResultData snapshots to tests/cases/seiza-resultdata-snapshot.php\n";
