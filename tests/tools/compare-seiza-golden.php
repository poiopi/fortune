<?php
declare(strict_types=1);

/**
 * compare-seiza-golden.php
 *
 * tests/cases/seiza-golden.php（1830ケース全数）に対して、
 * seizaEngine()のrawを照合する。
 *
 * 実行方法: php tests/tools/compare-seiza-golden.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';

$golden = require __DIR__ . '/../cases/seiza-golden.php';
$cases = $golden['cases'];

$pass = 0; $fail = 0; $failDetails = [];

foreach ($cases as $i => $case) {
    $input = $case['input'];
    $expected = $case['expected'];

    $result = seizaEngine($input['month'], $input['day'], $input['timeZoneCode']);
    $raw = $result['raw'];

    $rawExpected = ['signIndex' => $expected['signIndex'], 'innerTypeIndex' => $expected['innerTypeIndex'], 'timeZoneIndex' => $expected['timeZoneIndex']];

    if ($raw === $rawExpected) {
        $pass++;
    } else {
        $fail++;
        $failDetails[] = ['index' => $i, 'input' => $input, 'expected' => $rawExpected, 'actual' => $raw];
        if (count($failDetails) > 10) break; // 大量失敗時に出力が肥大化しないようにする
    }
}

$total = count($cases);
echo "=== seiza-engine Golden Master 照合結果 ({$total}件) ===\n\n";
echo "raw PASS={$pass} FAIL={$fail}\n";

if ($fail === 0) {
    echo "\n総合結果: PASS={$total} FAIL=0 (全数一致)\n";
    exit(0);
}

echo "\n詳細（最大10件）:\n";
foreach ($failDetails as $f) {
    echo "--- case #{$f['index']} ---\n";
    echo "input:    " . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "expected: " . json_encode($f['expected'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "actual:   " . json_encode($f['actual'], JSON_UNESCAPED_UNICODE) . "\n\n";
}
exit(1);
