<?php
declare(strict_types=1);

/**
 * compare-tarot-traits.php
 *
 * tarotEngine()のtraits出力を、tests/cases/tarot-traits.php（Trait Snapshot）と
 * 44件照合する。
 *
 * 実行方法: php tests/tools/compare-tarot-traits.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';

$snapshot = require __DIR__ . '/../cases/tarot-traits.php';
$cases = $snapshot['cases'];

$pass = 0; $fail = 0; $failDetails = [];

foreach ($cases as $i => $case) {
    $input = $case['input'];
    $expected = $case['expected'];

    $result = tarotEngine($input['cardOrder'], $input['isUpright']);
    $actual = $result['traits'];
    ksort($actual);

    if ($actual === $expected) {
        $pass++;
    } else {
        $fail++;
        $failDetails[] = ['index' => $i, 'input' => $input, 'expected' => $expected, 'actual' => $actual];
    }
}

$total = count($cases);
echo "=== tarot-engine traits Trait Snapshot 照合結果 ({$total}件) ===\n\n";
echo "PASS={$pass} FAIL={$fail}\n";

if ($fail === 0) {
    echo "\n総合結果: PASS={$total} FAIL=0 (44件完全一致)\n";
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
