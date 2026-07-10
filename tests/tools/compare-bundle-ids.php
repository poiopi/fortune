<?php
declare(strict_types=1);

/**
 * compare-bundle-ids.php
 *
 * tests/cases/bundle-id-snapshot.php（50ケース）に対して、axis-engine.php の
 * axis_getIdentityBundle() / axis_getTodayBundle() が選ぶBundle IDを照合する。
 * 本文（archetype/advice等）は比較対象外。
 *
 * 実行方法: php tests/tools/compare-bundle-ids.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';

$snapshot = require __DIR__ . '/../cases/bundle-id-snapshot.php';
$pass = 0; $fail = 0; $failDetails = [];

foreach ($snapshot['cases'] as $i => $case) {
    $shichuResult = shichuEngine([
        'year' => $case['shichuInput']['year'], 'month' => $case['shichuInput']['month'],
        'day' => $case['shichuInput']['day'], 'hour' => $case['shichuInput']['hour'],
        'gender' => $case['shichuInput']['gender'],
    ]);
    $tarotResult = tarotEngine($case['tarotInput']['cardOrder'], $case['tarotInput']['isUpright']);
    $seizaResult = seizaEngine($case['seizaInput']['month'], $case['seizaInput']['day'], $case['seizaInput']['timeZoneCode']);

    $aggregated = axis_aggregateTraits([$shichuResult, $tarotResult, $seizaResult]);
    $axisValues = axis_computeAxes($aggregated);

    $actual = [
        'identityBundleId' => axis_getIdentityBundle($axisValues)['id'],
        'todayBundleId' => axis_getTodayBundle($axisValues)['id'],
    ];

    if ($actual === $case['expected']) {
        $pass++;
    } else {
        $fail++;
        if (count($failDetails) < 5) $failDetails[] = ['index' => $i, 'expected' => $case['expected'], 'actual' => $actual];
    }
}

$total = count($snapshot['cases']);
echo "=== axis-engine Bundle ID Snapshot 照合結果 ({$total}件) ===\n\nPASS={$pass} FAIL={$fail}\n";

if ($fail === 0) {
    echo "\n総合結果: PASS={$total} FAIL=0\n";
    exit(0);
}

echo "\n詳細:\n";
foreach ($failDetails as $f) {
    echo "--- case #{$f['index']} ---\n";
    echo "expected: " . json_encode($f['expected'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "actual:   " . json_encode($f['actual'], JSON_UNESCAPED_UNICODE) . "\n\n";
}
exit(1);
