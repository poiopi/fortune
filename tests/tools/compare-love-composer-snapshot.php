<?php
declare(strict_types=1);

/**
 * compare-love-composer-snapshot.php
 *
 * 恋愛傾向診断の Snapshot（tests/cases/love-composer-snapshot.php、任意で love-final-snapshot.php）が、
 * 今の inc から生成し直した結果と generatedAt 以外すべて一致することを検査する。
 * inc（Composer・Normalizer・式・マッピング等）を変えたのに Snapshot を作り直し忘れた／
 * Snapshot だけ手で書き換えた、という食い違いを検出するためのもの。
 *
 * 生成は export 側（tests/tools/export-love-composer-snapshot.php・export-love-final-snapshot.php）の
 * ロジックをそのまま使う。export は変更しない：export のソースを一時フォルダへ写し、
 *   - 書き出し先（file_put_contents(__DIR__ . '/../cases/<Snapshot名>', $out)）だけを一時ファイルに向け、
 *   - それ以外の __DIR__ は元の tests/tools を指すように置き換えて、
 * 子プロセスで実行する。書き出し先の文が1か所でなければ（export の書き方が変わったら）FAIL にして止める。
 * 照合は、改行を LF にそろえ、generatedAt の行だけを除いたファイル内容の完全一致（バイト一致）。
 *
 * 実行方法:
 *   php tests/tools/compare-love-composer-snapshot.php                       （composer Snapshot。run-all の 'Composer Snapshot'）
 *   php tests/tools/compare-love-composer-snapshot.php --target=final        （final Snapshot。run-all の 'Final Snapshot'（compare-love-final-snapshot.php）。
 *                                                                            子プロセスの最大メモリは実測 約124MB（2026-10-06、memory_get_peak_usage(true)）。上限は -d memory_limit=1G）
 *   php tests/tools/compare-love-composer-snapshot.php --target=all          （両方）
 *   --expect=<ファイル> : 照合先の Snapshot を差し替える（わざと壊したコピーで FAIL することを確かめるときだけ使う。--target=all とは併用不可）
 * 終了コード: 0=ALL PASS / 1=FAIL あり
 */

// final Snapshot（約20MB）を2つ文字列で持ち、不一致のときは行に分けるため、デフォルトの128MBでは足りないことがある
ini_set('memory_limit', '2G');

$opts = getopt('', ['target:', 'expect:']);
$target = $opts['target'] ?? 'composer';
$TARGETS = [
    'composer' => ['export' => 'export-love-composer-snapshot.php', 'snapshot' => 'love-composer-snapshot.php'],
    'final' => ['export' => 'export-love-final-snapshot.php', 'snapshot' => 'love-final-snapshot.php'],
];
if ($target === 'all') $run = array_keys($TARGETS);
elseif (isset($TARGETS[$target])) $run = [$target];
else { fwrite(STDERR, "--target は composer / final / all のいずれか\n"); exit(2); }
if (isset($opts['expect']) && count($run) !== 1) { fwrite(STDERR, "--expect は --target=composer か final と一緒に使う\n"); exit(2); }

$toolsDir = realpath(__DIR__);
$casesDir = realpath(__DIR__ . '/../cases');

$fail = 0;
$log = [];
function check(string $label, bool $ok, string $detail = ''): void {
    global $fail, $log;
    if (!$ok) $fail++;
    $log[] = sprintf("[%s] %s%s", $ok ? 'PASS' : 'FAIL', $label, $detail !== '' ? " — {$detail}" : '');
}

/** 改行を LF にそろえ、generatedAt の行を1行だけ固定の文字列に置き換える。置き換えた件数も返す */
function normalizeSnapshot(string $s): array {
    $s = str_replace("\r\n", "\n", $s);
    $s = preg_replace("/^    'generatedAt' => '[^'\\n]*',\$/m", "    'generatedAt' => '(generatedAt)',", $s, -1, $n);
    return [$s, $n];
}

/** 最初に違う行（行番号・期待・実際）。違いが無ければ null */
function firstDiff(string $a, string $b): ?string {
    $la = explode("\n", $a); $lb = explode("\n", $b);
    $n = max(count($la), count($lb));
    for ($i = 0; $i < $n; $i++) {
        if (($la[$i] ?? null) !== ($lb[$i] ?? null)) {
            return sprintf('%d行目 期待「%s」 / 生成「%s」（行数 期待%d・生成%d）', $i + 1, trim($la[$i] ?? '(無し)'), trim($lb[$i] ?? '(無し)'), count($la), count($lb));
        }
    }
    return null;
}

$tmpDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'love-snapshot-compare-' . getmypid();
if (!is_dir($tmpDir) && !mkdir($tmpDir, 0777, true)) { fwrite(STDERR, "一時フォルダを作れない: {$tmpDir}\n"); exit(2); }

$stats = [];
foreach ($run as $name) {
    $t = $TARGETS[$name];
    $src = file_get_contents("{$toolsDir}/{$t['export']}");
    // 書き出し先だけを一時ファイルへ
    $tmpOut = "{$tmpDir}/{$t['snapshot']}";
    $writeStmt = "file_put_contents(__DIR__ . '/../cases/{$t['snapshot']}', \$out);";
    $count = substr_count($src, $writeStmt);
    check("[{$name}] export の書き出し先の文が1か所（{$t['export']}）", $count === 1, $count === 1 ? '' : "{$count}か所。export の書き方が変わったため、このテストの置き換え方法を見直すこと");
    if ($count !== 1) continue;
    $src = str_replace($writeStmt, 'file_put_contents(' . var_export($tmpOut, true) . ', $out);', $src);
    // 残りの __DIR__（inc・入力 Snapshot の読み込み）は元の tests/tools を指す
    $src = str_replace('__DIR__', var_export($toolsDir, true), $src);
    // 子プロセスの最大メモリを標準エラーへ（照合結果の表示用）
    $src = rtrim($src) . "\nfwrite(STDERR, 'PEAK_MEMORY=' . memory_get_peak_usage(true) . \"\\n\");\n";
    $tmpScript = "{$tmpDir}/{$t['export']}";
    file_put_contents($tmpScript, $src);
    if (is_file($tmpOut)) unlink($tmpOut);

    $t0 = microtime(true);
    // 子プロセスは php.ini の既定（128MB）に左右されないよう、上限を明示する（final の export は自分でも 1024M を設定している）
    exec(escapeshellarg(PHP_BINARY) . ' -d memory_limit=1G ' . escapeshellarg($tmpScript) . ' 2>&1', $out, $code);
    $sec = microtime(true) - $t0;
    @unlink($tmpScript);
    $peak = 0; foreach ($out as $line) if (preg_match('/^PEAK_MEMORY=(\d+)$/', $line, $m)) $peak = (int)$m[1];
    $stats[$name] = sprintf('生成 %.1f秒・子プロセスの最大メモリ %dMB', $sec, intdiv($peak, 1024 * 1024));
    check("[{$name}] export のロジックで生成し直せた", $code === 0 && is_file($tmpOut), $code === 0 ? '' : "終了コード {$code}: " . implode(' / ', array_slice($out, -3)));
    $out = [];
    if ($code !== 0 || !is_file($tmpOut)) { @unlink($tmpOut); continue; }

    $expectFile = $opts['expect'] ?? "{$casesDir}/{$t['snapshot']}";
    [$exp, $ne] = normalizeSnapshot((string)file_get_contents($expectFile));
    [$act, $na] = normalizeSnapshot((string)file_get_contents($tmpOut));
    unlink($tmpOut);
    check("[{$name}] generatedAt の行が1行ずつ", $ne === 1 && $na === 1, "期待 {$ne}行・生成 {$na}行");
    $diff = $exp === $act ? null : firstDiff($exp, $act);
    check("[{$name}] " . basename($expectFile) . ' が生成し直した結果と generatedAt 以外すべて一致', $diff === null, $diff ?? '');
    unset($exp, $act);
}
@rmdir($tmpDir);

echo "=== Love Snapshot Regeneration Compare ===\n\n";
foreach ($log as $line) echo $line . "\n";
foreach ($stats as $name => $s) echo "  {$name}: {$s}\n";
echo '  照合側の最大メモリ ' . intdiv(memory_get_peak_usage(true), 1024 * 1024) . "MB\n";
echo "\n";
if ($fail === 0) {
    echo "総合結果: ALL PASS\n";
    exit(0);
}
echo "総合結果: {$fail} FAILURE(S)\n";
exit(1);
