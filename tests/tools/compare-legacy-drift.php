<?php
declare(strict_types=1);

/**
 * compare-legacy-drift.php
 *
 * Step5-A: 「本番反映直前のドリフト検知」専用スクリプト。
 * tests/cases/legacy-drift-snapshot.php（現行の生きているshichu.php/seiza.phpのJSから
 * ブラウザ経由で直接抽出した値）に対して、inc/shichu-engine.php・inc/seiza-engine.phpの
 * raw出力を突合する。
 *
 * これはtests/cases/shichu-golden.php・seiza-golden.php（Step1凍結スナップショット、恒久的な
 * 回帰防止用）とは別物。目的は「Step1完了後にlegacyページ側が編集されていないか」の
 * 一度限りの最終確認。
 *
 * 比較対象（固定。詳細はlegacy-drift-snapshot.phpのコメント参照）:
 *   shichu raw: yearPillar/monthPillar/dayPillar/hourPillar/dayStrength/tenGodGrid/tenchusatsuBranches/daiyun
 *   seiza raw : signIndex/innerTypeIndex/timeZoneIndex
 *   対象外: scores/influence/archetype/extras
 *
 * 実行方法: php tests/tools/compare-legacy-drift.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';

$snapshot = require __DIR__ . '/../cases/legacy-drift-snapshot.php';

$allPass = true;
$failDetails = [];

/**
 * shichuEngine()のraw.dayStrengthは{label,cls}のみ（Rule1: rawは最小限の事実のみ、
 * descは意図的にhighlights側（SHICHU_STRENGTH_DESC）へ再配置済み・内容一致確認済み）。
 * legacy JSのdayStrengthは{label,cls,desc}を返すため、比較はlabel/clsのみに限定する。
 */
function normalizeDayStrength(array $ds): array {
    return ['label' => $ds['label'], 'cls' => $ds['cls']];
}

// ── shichu ──
$shichuFields = ['yearPillar', 'monthPillar', 'dayPillar', 'hourPillar', 'tenGodGrid', 'tenchusatsuBranches', 'daiyun'];
$shichuPass = 0;
$shichuFail = 0;
foreach ($snapshot['shichu'] as $i => $case) {
    $input = $case['input'];
    $result = shichuEngine(['year' => $input['year'], 'month' => $input['month'], 'day' => $input['day'], 'hour' => $input['hour'], 'gender' => $input['gender']]);
    $raw = $result['raw'];
    foreach ($shichuFields as $field) {
        if ($raw[$field] === $case['expected'][$field]) {
            $shichuPass++;
        } else {
            $shichuFail++;
            $failDetails[] = ['group' => 'shichu', 'index' => $i, 'field' => $field, 'input' => $input, 'expected' => $case['expected'][$field], 'actual' => $raw[$field]];
        }
    }
    if (normalizeDayStrength($raw['dayStrength']) === normalizeDayStrength($case['expected']['dayStrength'])) {
        $shichuPass++;
    } else {
        $shichuFail++;
        $failDetails[] = ['group' => 'shichu', 'index' => $i, 'field' => 'dayStrength', 'input' => $input, 'expected' => normalizeDayStrength($case['expected']['dayStrength']), 'actual' => normalizeDayStrength($raw['dayStrength'])];
    }
}

// ── seiza zodiac ──
$seizaZodiacFields = ['signIndex', 'innerTypeIndex'];
$seizaPass = 0;
$seizaFail = 0;
foreach ($snapshot['seiza_zodiac'] as $i => $case) {
    $input = $case['input'];
    $result = seizaEngine($input['month'], $input['day'], 'U');
    $raw = $result['raw'];
    foreach ($seizaZodiacFields as $field) {
        if ($raw[$field] === $case['expected'][$field]) {
            $seizaPass++;
        } else {
            $seizaFail++;
            $failDetails[] = ['group' => 'seiza_zodiac', 'index' => $i, 'field' => $field, 'input' => $input, 'expected' => $case['expected'][$field], 'actual' => $raw[$field]];
        }
    }
}

// ── seiza timezone ──
foreach ($snapshot['seiza_timezone'] as $i => $case) {
    $input = $case['input'];
    $result = seizaEngine(1, 1, $input['timeZoneCode']);
    $raw = $result['raw'];
    if ($raw['timeZoneIndex'] === $case['expected']['timeZoneIndex']) {
        $seizaPass++;
    } else {
        $seizaFail++;
        $failDetails[] = ['group' => 'seiza_timezone', 'index' => $i, 'field' => 'timeZoneIndex', 'input' => $input, 'expected' => $case['expected']['timeZoneIndex'], 'actual' => $raw['timeZoneIndex']];
    }
}

echo "=== Step5-A Legacy Drift Check ===\n\n";
echo sprintf("shichu raw (%d件×8項目):  PASS=%d FAIL=%d\n", count($snapshot['shichu']), $shichuPass, $shichuFail);
echo sprintf("seiza raw  (%d件):        PASS=%d FAIL=%d\n", count($snapshot['seiza_zodiac']) + count($snapshot['seiza_timezone']), $seizaPass, $seizaFail);

$allPass = ($shichuFail === 0 && $seizaFail === 0);

echo "\n";
if ($allPass) {
    echo "総合結果: PASS（現行shichu.php/seiza.phpとsanseiEngineのraw出力に差異なし。ドリフトなし）\n";
    exit(0);
}

echo "総合結果: FAIL。詳細:\n\n";
foreach ($failDetails as $f) {
    echo "--- {$f['group']} #{$f['index']} field={$f['field']} ---\n";
    echo "input:    " . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "expected: " . json_encode($f['expected'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "actual:   " . json_encode($f['actual'], JSON_UNESCAPED_UNICODE) . "\n\n";
}
exit(1);
