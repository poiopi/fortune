<?php
declare(strict_types=1);

/**
 * compare-shichu-traits.php
 *
 * shichuEngine()（test.life-fun.net/inc/shichu-engine.php）の traits 出力を、
 * tests/cases/shichu-traits.php（Trait Snapshot）と100件照合する。
 *
 * 実行方法: php tests/tools/compare-shichu-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';

$snapshot = require __DIR__ . '/../cases/shichu-traits.php';
$cases = $snapshot['cases'];

$pass = 0;
$fail = 0;
$failDetails = [];

foreach ($cases as $i => $case) {
    $input = $case['input'];
    $expectedTraits = $case['expected'];
    $birth = ['year' => $input['year'], 'month' => $input['month'], 'day' => $input['day'], 'hour' => $input['hour'], 'gender' => $input['gender']];

    $result = shichuEngine($birth);
    $actualTraits = $result['traits'];
    ksort($actualTraits);

    if ($actualTraits === $expectedTraits) {
        $pass++;
    } else {
        $fail++;
        $failDetails[] = ['index' => $i, 'input' => $input, 'expected' => $expectedTraits, 'actual' => $actualTraits];
    }
}

$total = count($cases);
echo "=== shichu-engine traits Trait Snapshot 照合結果 ({$total}件) ===\n\n";
echo "PASS={$pass} FAIL={$fail}\n";

if ($fail === 0) {
    echo "\n総合結果: PASS={$total} FAIL=0 (100件完全一致)\n";
    exit(0);
}

echo "\n詳細:\n";
foreach ($failDetails as $f) {
    echo "--- case #{$f['index']} ---\n";
    echo "input:    " . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "expected: " . json_encode($f['expected'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "actual:   " . json_encode($f['actual'], JSON_UNESCAPED_UNICODE) . "\n\n";
}
exit(1);
