<?php
declare(strict_types=1);

/**
 * compare-seiza-traits.php
 *
 * seizaEngine()のtraits出力を、tests/cases/seiza-traits.php（Trait Snapshot）と
 * 1830件照合する。
 *
 * 実行方法: php tests/tools/compare-seiza-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';

$snapshot = require __DIR__ . '/../cases/seiza-traits.php';
$cases = $snapshot['cases'];

$pass = 0; $fail = 0; $failDetails = [];

foreach ($cases as $i => $case) {
    $input = $case['input'];
    $expected = $case['expected'];

    $result = seizaEngine($input['month'], $input['day'], $input['timeZoneCode']);
    $actual = $result['traits'];
    ksort($actual);

    if ($actual === $expected) {
        $pass++;
    } else {
        $fail++;
        if (count($failDetails) < 10) {
            $failDetails[] = ['index' => $i, 'input' => $input, 'expected' => $expected, 'actual' => $actual];
        }
    }
}

$total = count($cases);
echo "=== seiza-engine traits Trait Snapshot 照合結果 ({$total}件) ===\n\n";
echo "PASS={$pass} FAIL={$fail}\n";

if ($fail === 0) {
    echo "\n総合結果: PASS={$total} FAIL=0 (全件一致)\n";
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
