<?php
declare(strict_types=1);

/**
 * test-sansei-e2e.php
 *
 * sansei.php（Step3で統合エンジンへ移行済み）を実際にPOSTリクエストとして実行し、
 * 四柱推命・タロット・星座・sanseiEngine()・sansei.php表示までの一気通貫を確認する。
 *
 * Snapshotはロジックの正しさを守るが、UIとの結合（エンジンのrequire漏れ・関数名衝突・
 * 変数の受け渡しミス等）は別に確認する必要があるため、これは意図的にSnapshotとは
 * 別の検証として用意する。
 *
 * 確認する内容:
 *   - PHPエラー・警告が出ないこと
 *   - archetype/summary/advice/scores/influenceが表示されること
 *   - 複数回実行して壊れないこと（タロットはランダム抽選のため）
 *
 * 実行方法: php tests/tools/test-sansei-e2e.php
 */

function run_sansei_once(string $name, string $birthday): array {
    $php = PHP_BINARY;
    $script = __DIR__ . '/_sansei_e2e_runner.php';
    $cmd = escapeshellarg($php) . ' ' . escapeshellarg($script) . ' '
        . escapeshellarg($name) . ' ' . escapeshellarg($birthday) . ' 2>&1';
    exec($cmd, $output, $exitCode);
    return ['exitCode' => $exitCode, 'output' => implode("\n", $output)];
}

$runnerCode = <<<'PHP'
<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['PHP_SELF'] = '/sansei.php';
$_POST['name'] = $argv[1];
$_POST['birthday'] = $argv[2];

ob_start();
require __DIR__ . '/../../test.life-fun.net/sansei.php';
$html = ob_get_clean();

if (preg_match('/(Notice|Warning|Deprecated|Fatal error|Parse error):/i', $html, $m)) {
    fwrite(STDERR, "PHP_ISSUE:" . $m[0] . "\n");
    exit(1);
}

$checks = [
    'result-section表示' => strpos($html, 'id="result"') !== false,
    'archetype表示'      => strpos($html, 'class="result-hero"') !== false && preg_match('/<h2>[^<]+<\/h2>/u', $html) === 1,
    'summary表示'        => strpos($html, 'result-hero-sub') !== false,
    'advice表示'         => strpos($html, '今日の開運アドバイス') !== false,
    'scores表示'         => substr_count($html, 'class="stars"') >= 4,
    'influence表示'      => substr_count($html, 'influence-row') >= 3,
];

$allOk = true;
foreach ($checks as $label => $ok) {
    echo ($ok ? 'OK' : 'NG') . " {$label}\n";
    if (!$ok) $allOk = false;
}
exit($allOk ? 0 : 1);
PHP;

file_put_contents(__DIR__ . '/_sansei_e2e_runner.php', $runnerCode);

$cases = [
    ['名前太郎', '1990-05-15'],
    ['花子', '1985-12-31'],
    ['サンプル', '2000-02-29'], // 閏年境界
];

$allPass = true;
foreach ($cases as [$name, $birthday]) {
    echo "--- {$birthday} ---\n";
    $result = run_sansei_once($name, $birthday);
    echo $result['output'] . "\n";
    if ($result['exitCode'] !== 0) $allPass = false;
}

unlink(__DIR__ . '/_sansei_e2e_runner.php');

if ($allPass) {
    echo "\n総合結果: sansei.php E2E確認 PASS（PHPエラーなし・主要項目すべて表示）\n";
    exit(0);
}
echo "\n総合結果: FAIL\n";
exit(1);
