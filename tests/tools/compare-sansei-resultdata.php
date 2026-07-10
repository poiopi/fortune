<?php
declare(strict_types=1);

/**
 * compare-sansei-resultdata.php
 *
 * 保存済みの tests/cases/sansei-resultdata-snapshot.php と、現在の sanseiEngine() の
 * 出力を再生成なしで比較する（Golden Master・Trait Snapshot等と同じ役割）。
 *
 * 実行方法: php tests/tools/compare-sansei-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';

$snapshot = require __DIR__ . '/../cases/sansei-resultdata-snapshot.php';
$pass = 0; $fail = 0; $failDetails = [];

foreach ($snapshot['cases'] as $i => $case) {
    $shichuResult = shichuEngine([
        'year' => $case['shichuInput']['year'], 'month' => $case['shichuInput']['month'],
        'day' => $case['shichuInput']['day'], 'hour' => $case['shichuInput']['hour'],
        'gender' => $case['shichuInput']['gender'],
    ]);
    $tarotResult = tarotEngine($case['tarotInput']['cardOrder'], $case['tarotInput']['isUpright']);
    $seizaResult = seizaEngine($case['seizaInput']['month'], $case['seizaInput']['day'], $case['seizaInput']['timeZoneCode']);

    $actual = sanseiEngine(['shichu' => $shichuResult, 'tarot' => $tarotResult, 'seiza' => $seizaResult]);

    if ($actual === $case['sanseiResult']) {
        $pass++;
    } else {
        $fail++;
        if (count($failDetails) < 5) $failDetails[] = ['index' => $i];
    }
}

$total = count($snapshot['cases']);
echo "=== SanseiResult Snapshot 照合結果 ({$total}件) ===\n\nPASS={$pass} FAIL={$fail}\n";
if ($fail === 0) { echo "\n総合結果: PASS={$total} FAIL=0\n"; exit(0); }
foreach ($failDetails as $f) echo "--- case #{$f['index']} で不一致 ---\n";
exit(1);
