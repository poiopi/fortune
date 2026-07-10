<?php
declare(strict_types=1);

/**
 * compare-tarot-golden.php
 *
 * tests/cases/tarot-golden.php（22×2=44ケース全数）に対して、
 * tarotEngine()のraw、および inc/tarot-data.php のルックアップ結果を照合する。
 *
 * 実行方法: php tests/tools/compare-tarot-golden.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';

$golden = require __DIR__ . '/../cases/tarot-golden.php';
$cases = $golden['cases'];

$rawPass = 0; $rawFail = 0;
$lookupPass = 0; $lookupFail = 0;
$failDetails = [];

foreach ($cases as $i => $case) {
    $input = $case['input'];
    $expected = $case['expected'];

    $result = tarotEngine($input['cardOrder'], $input['isUpright']);
    $raw = $result['raw'];

    $rawExpected = ['deckVersion' => $input['deckVersion'], 'cardOrder' => $input['cardOrder'], 'isUpright' => $input['isUpright']];
    if ($raw === $rawExpected) {
        $rawPass++;
    } else {
        $rawFail++;
        $failDetails[] = ['index' => $i, 'field' => 'raw', 'input' => $input, 'expected' => $rawExpected, 'actual' => $raw];
    }

    // ルックアップ照合（inc/tarot-data.phpの内容がGolden Masterと一致するか）
    $card = TAROT_DATA[$raw['cardOrder']];
    $keywords = $raw['isUpright'] ? $card['upright'] : $card['reversed'];
    $message = $raw['isUpright'] ? $card['upright_msg'] : $card['reversed_msg'];
    $lookupActual = ['name' => $card['name'], 'en' => $card['en'], 'img' => $card['img'], 'keywords' => $keywords, 'message' => $message];

    if ($lookupActual === $expected) {
        $lookupPass++;
    } else {
        $lookupFail++;
        $failDetails[] = ['index' => $i, 'field' => 'lookup', 'input' => $input, 'expected' => $expected, 'actual' => $lookupActual];
    }
}

$total = count($cases);
echo "=== tarot-engine Golden Master 照合結果 ({$total}件) ===\n\n";
echo sprintf("%-10s PASS (%d/%d)\n", 'raw', $rawPass, $total);
echo sprintf("%-10s %s (%d/%d)\n", 'lookup', $lookupFail === 0 ? 'PASS' : 'FAIL', $lookupPass, $total);

if ($rawFail === 0 && $lookupFail === 0) {
    echo "\n総合結果: PASS={$total} FAIL=0 (44件完全一致)\n";
    exit(0);
}

echo "\n詳細:\n";
foreach ($failDetails as $f) {
    echo "--- case #{$f['index']} field={$f['field']} ---\n";
    echo "input:    " . json_encode($f['input'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "expected: " . json_encode($f['expected'], JSON_UNESCAPED_UNICODE) . "\n";
    echo "actual:   " . json_encode($f['actual'], JSON_UNESCAPED_UNICODE) . "\n\n";
}
exit(1);
