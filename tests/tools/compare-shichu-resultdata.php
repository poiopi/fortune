<?php
declare(strict_types=1);

/**
 * compare-shichu-resultdata.php
 *
 * 保存済みの tests/cases/shichu-resultdata-snapshot.php と、現在の shichuEngine() の
 * 出力を再生成なしで比較する（Golden Master・Trait Snapshotの比較スクリプトと同じ役割）。
 * ResultData Validatorだけでは検知できない、meta/highlights/extrasの値そのものの
 * リグレッションを検知する。
 *
 * 実行方法: php tests/tools/compare-shichu-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';

$snapshot = require __DIR__ . '/../cases/shichu-resultdata-snapshot.php';
$pass = 0; $fail = 0; $failDetails = [];

foreach ($snapshot['cases'] as $i => $case) {
    $input = $case['input'];
    $birth = ['year' => $input['year'], 'month' => $input['month'], 'day' => $input['day'], 'hour' => $input['hour'], 'gender' => $input['gender']];
    $actual = shichuEngine($birth);
    if ($actual === $case['resultData']) {
        $pass++;
    } else {
        $fail++;
        if (count($failDetails) < 5) $failDetails[] = ['index' => $i, 'input' => $input];
    }
}

$total = count($snapshot['cases']);
echo "=== shichu ResultData Snapshot 照合結果 ({$total}件) ===\n\nPASS={$pass} FAIL={$fail}\n";
if ($fail === 0) { echo "\n総合結果: PASS={$total} FAIL=0\n"; exit(0); }
foreach ($failDetails as $f) echo "--- case #{$f['index']} ---\n" . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
exit(1);
