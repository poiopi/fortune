<?php
declare(strict_types=1);

/**
 * compare-tarot-resultdata.php
 *
 * 保存済みの tests/cases/tarot-resultdata-snapshot.php と、現在の tarotEngine() の
 * 出力を再生成なしで比較する。
 *
 * 実行方法: php tests/tools/compare-tarot-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';

$snapshot = require __DIR__ . '/../cases/tarot-resultdata-snapshot.php';
$pass = 0; $fail = 0; $failDetails = [];

foreach ($snapshot['cases'] as $i => $case) {
    $input = $case['input'];
    $actual = tarotEngine($input['cardOrder'], $input['isUpright']);
    if ($actual === $case['resultData']) {
        $pass++;
    } else {
        $fail++;
        if (count($failDetails) < 5) $failDetails[] = ['index' => $i, 'input' => $input];
    }
}

$total = count($snapshot['cases']);
echo "=== tarot ResultData Snapshot 照合結果 ({$total}件) ===\n\nPASS={$pass} FAIL={$fail}\n";
if ($fail === 0) { echo "\n総合結果: PASS={$total} FAIL=0\n"; exit(0); }
foreach ($failDetails as $f) echo "--- case #{$f['index']} ---\n" . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
exit(1);
