<?php
declare(strict_types=1);

/**
 * compare-shichu-golden.php
 *
 * tests/cases/shichu-golden.php（Golden Master）に対して、
 * test.life-fun.net/inc/shichu-engine.php の shichuEngine() を実行し、
 * 項目（関数）ごとにPASS/FAILを報告する。
 *
 * どの関数（yearPillar, monthPillar, dayPillar, hourPillar, dayStrength,
 * tenGodGrid, tenchusatsuBranches, daiyun）で差異が出たかを切り分けられるようにするため、
 * ケース全体の一致だけでなく、項目単位でも集計する。
 *
 * 実行方法: php tests/tools/compare-shichu-golden.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';

$golden = require __DIR__ . '/../cases/shichu-golden.php';
$cases = $golden['cases'];

$fields = ['yearPillar', 'monthPillar', 'dayPillar', 'hourPillar', 'dayStrength', 'tenGodGrid', 'tenchusatsuBranches', 'daiyun'];
$fieldPass = array_fill_keys($fields, 0);
$fieldFail = array_fill_keys($fields, 0);
$caseFail = [];

foreach ($cases as $i => $case) {
    $input = $case['input'];
    $expected = $case['expected'];
    $birth = ['year' => $input['year'], 'month' => $input['month'], 'day' => $input['day'], 'hour' => $input['hour'], 'gender' => $input['gender']];

    $result = shichuEngine($birth);
    $raw = $result['raw'];

    $caseHadFail = false;
    foreach ($fields as $field) {
        if ($raw[$field] === $expected[$field]) {
            $fieldPass[$field]++;
        } else {
            $fieldFail[$field]++;
            $caseHadFail = true;
            $caseFail[] = [
                'index' => $i,
                'input' => $input,
                'field' => $field,
                'expected' => $expected[$field],
                'actual' => $raw[$field],
            ];
        }
    }
}

$total = count($cases);
echo "=== shichu-engine Golden Master 照合結果 ({$total}件) ===\n\n";
foreach ($fields as $field) {
    $pass = $fieldPass[$field];
    $fail = $fieldFail[$field];
    $mark = $fail === 0 ? 'PASS' : 'FAIL';
    echo sprintf("%-22s %s (%d/%d)\n", $field, $mark, $pass, $total);
}

$allPass = array_sum($fieldFail) === 0;
echo "\n";
if ($allPass) {
    echo "総合結果: PASS={$total} FAIL=0 (100件完全一致)\n";
    exit(0);
}

echo "総合結果: 差異あり。詳細:\n\n";
foreach ($caseFail as $f) {
    echo "--- case #{$f['index']} field={$f['field']} ---\n";
    echo "input:    " . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "expected: " . json_encode($f['expected'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "actual:   " . json_encode($f['actual'], JSON_UNESCAPED_UNICODE) . "\n\n";
}
exit(1);
