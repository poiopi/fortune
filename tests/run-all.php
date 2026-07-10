<?php
declare(strict_types=1);

/**
 * tests/run-all.php
 *
 * 3占術（shichu/tarot/seiza）すべての検証（Golden Master・Trait Snapshot・Coverage・
 * ResultData Validator）をまとめて実行し、一覧で結果を表示する。
 *
 * リファクタリングや占術追加のたびにこれ一本を実行すれば、全体の回帰確認ができる。
 *
 * 実行方法: php tests/run-all.php
 */

$phpBin = PHP_BINARY;
$toolsDir = __DIR__ . '/tools';

$suites = [
    'Shichu' => [
        'Golden Master' => "{$toolsDir}/compare-shichu-golden.php",
        'Trait Snapshot' => "{$toolsDir}/compare-shichu-traits.php",
        'Coverage' => "{$toolsDir}/shichu-trait-coverage.php",
        'ResultData' => "{$toolsDir}/compare-shichu-resultdata.php",
    ],
    'Tarot' => [
        'Golden Master' => "{$toolsDir}/compare-tarot-golden.php",
        'Trait Snapshot' => "{$toolsDir}/compare-tarot-traits.php",
        'Coverage' => "{$toolsDir}/tarot-trait-coverage.php",
        'ResultData' => "{$toolsDir}/compare-tarot-resultdata.php",
    ],
    'Seiza' => [
        'Golden Master' => "{$toolsDir}/compare-seiza-golden.php",
        'Trait Snapshot' => "{$toolsDir}/compare-seiza-traits.php",
        'Coverage' => "{$toolsDir}/seiza-trait-coverage.php",
        'ResultData' => "{$toolsDir}/compare-seiza-resultdata.php",
    ],
    'AxisEngine' => [
        'Aggregation' => "{$toolsDir}/compare-axis-aggregation.php",
        'Axis Values' => "{$toolsDir}/compare-axis-values.php",
        'Bundle ID' => "{$toolsDir}/compare-bundle-ids.php",
        'Boundary Cases' => "{$toolsDir}/test-axis-boundary-cases.php",
        'SanseiResult' => "{$toolsDir}/compare-sansei-resultdata.php",
    ],
    'Sansei.php (UI)' => [
        'E2E' => "{$toolsDir}/test-sansei-e2e.php",
    ],
    'Step5-A (Legacy Drift)' => [
        'Legacy Drift Check' => "{$toolsDir}/compare-legacy-drift.php",
    ],
];

$allPass = true;
$results = [];

foreach ($suites as $name => $checks) {
    $results[$name] = [];
    foreach ($checks as $label => $script) {
        $cmd = escapeshellarg($phpBin) . ' ' . escapeshellarg($script) . ' 2>&1';
        exec($cmd, $output, $exitCode);
        $pass = $exitCode === 0;
        $results[$name][$label] = ['pass' => $pass, 'output' => $output];
        if (!$pass) $allPass = false;
    }
}

echo "========================================\n";
echo " 三星統合鑑定エンジン 統合検証\n";
echo "========================================\n\n";

foreach ($results as $name => $checks) {
    echo "{$name}\n";
    foreach ($checks as $label => $result) {
        $mark = $result['pass'] ? 'PASS' : 'FAIL';
        echo sprintf("  %-16s %s\n", $label, $mark);
    }
    echo "\n";
}

echo "========================================\n";
if ($allPass) {
    echo " ALL PASS\n";
    echo "========================================\n";
    exit(0);
}

echo " FAILURES DETECTED\n";
echo "========================================\n\n";
foreach ($results as $name => $checks) {
    foreach ($checks as $label => $result) {
        if (!$result['pass']) {
            echo "--- {$name} / {$label} ---\n";
            echo implode("\n", $result['output']) . "\n\n";
        }
    }
}
exit(1);
