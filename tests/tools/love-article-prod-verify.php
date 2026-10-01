<?php
/**
 * tests/tools/love-article-prod-verify.php
 *
 * 恋愛記事の事実検証ツール ④本番反映後の自動照合（DEVELOPMENT_RULES.md「記事の事実検証ルール」ルール4）。
 *
 * 【使い方】（本番照合は本番反映が終わってから実行する。実行前にManager／ユーザーの指示を受けること）
 *   php tests/tools/love-article-prod-verify.php --base=https://life-fun.net --expect=<json> --out=<出力先フォルダ>
 *       本番照合。--base は必須（--only-local でないときに省略すると本番にアクセスせず、使い方を表示して終了コード2で終わる）。
 *   php tests/tools/love-article-prod-verify.php --only-local --expect=<json> --out=<出力先フォルダ>
 *       本番にはアクセスせず、ローカルのツリー（--local-root）の描画と、修正後の文の有無だけを確認する
 *   php tests/tools/love-article-prod-verify.php --base=http://127.0.0.1:8772 --local-root=<ツリー> --expect=<json> --out=<出力先フォルダ>
 *       （本番の代わりにローカルサーバーを相手にして、このスクリプト自体の動作を確かめる用）
 *
 *   --expect      love-article-prod-expect.php で作った期待値 JSON。必須
 *   --out         結果の保存先フォルダ。必須。リポジトリの外（一時フォルダ等）を指定する（リポジトリ内は拒否）
 *   --local-root  ローカルで描画するツリー。既定はリポジトリのルート（＝本番用ツリー）。
 *                 STG用ツリーを見るときは <リポジトリ>/test.life-fun.net
 *   --port        ローカル描画用ポート（既定 8771）。使用中なら起動せずに終了する
 *   --delay       本番へのリクエスト間隔ms（既定 300）
 *
 *   例（Git Bash）:
 *     php tests/tools/love-article-prod-verify.php --only-local --expect="$TMP/prod_expect.json" --out="$TMP/pv"
 *
 * 【やること】
 *   1. ローカルのツリー（--local-root）の /articles/love/ 配下の全ページ（index.php から列挙）を
 *      PHPビルトインサーバー＋tests/tools/lib/love-article-render-router.php（mt_srand固定）で描画する。
 *      サーバーは起動時に控えたPIDを taskkill /F /PID で止める（例外・致命的エラーで途中終了した場合もシャットダウン処理で停止）。
 *   2. 同じURLを本番（--base）から取得する（--only-local のときは取得しない）。
 *   3. 照合（ページごと）:
 *      - HTTP 200（本番・ローカルとも）
 *      - HTML に PHP の Warning/Notice/Deprecated/Fatal の文字列が無い（本番・ローカルとも）
 *      - 本文領域（tests/tools/lib/love-article-text.php：art-hero〜ナビカードの手前。GAタグ・script・ランダムなナビカード・
 *        共通フッターの日付は除外）のテキストが、本番とローカルで一致する
 *      - 期待値 JSON の「修正後の文」がすべて含まれ、「旧文」が1つも含まれない
 *        （本番・ローカルの両方。ローカルで成り立たないときは、そのツリーが未更新）
 *   4. 結果を <--out>/result.txt に書き、FAILがあれば終了コード1。
 * 終了コード: 0=ALL PASS / 1=FAIL / 2=引数・環境のエラー、またはローカル描画中の異常終了（サーバーは停止してから終了する）
 */
ini_set('memory_limit', '1G');
require __DIR__ . '/lib/love-article-text.php';
$REPO = str_replace('\\', '/', realpath(__DIR__ . '/../..'));
$ROUTER = str_replace('\\', '/', __DIR__ . '/lib/love-article-render-router.php');

function usage(string $msg): void {
    fwrite(STDERR, "エラー: $msg\n"
        . "使い方:\n"
        . "  php tests/tools/love-article-prod-verify.php --base=https://life-fun.net --expect=<json> --out=<dir> [--local-root=<ツリー>]   本番照合\n"
        . "  php tests/tools/love-article-prod-verify.php --only-local --expect=<json> --out=<dir> [--local-root=<ツリー>]             本番にアクセスせずローカルだけ確認\n"
        . "  php tests/tools/love-article-prod-verify.php --base=http://127.0.0.1:8772 --local-root=<ツリー> --expect=<json> --out=<dir>   スクリプト自体の動作確認\n"
        . "  オプション: --port=8771 --delay=300\n");
    exit(2);
}
function absPath(string $p): string {
    $p = str_replace('\\', '/', $p);
    if (!preg_match('#^([A-Za-z]:)?/#', $p)) $p = str_replace('\\', '/', getcwd()) . '/' . $p;
    $rest = [];
    $cur = rtrim($p, '/');
    while ($cur !== '' && !file_exists($cur)) { $rest[] = basename($cur); $parent = dirname($cur); if ($parent === $cur) break; $cur = $parent; }
    $base = file_exists($cur) ? str_replace('\\', '/', realpath($cur)) : $cur;
    return rtrim($base . ($rest ? '/' . implode('/', array_reverse($rest)) : ''), '/');
}
function isInside(string $path, string $dir): bool {
    $p = strtolower(rtrim($path, '/')) . '/'; $d = strtolower(rtrim($dir, '/')) . '/';
    return strncmp($p, $d, strlen($d)) === 0;
}

$opts = getopt('', ['base:', 'local-root:', 'port:', 'out:', 'only-local', 'delay:', 'expect:']);
$onlyLocal = isset($opts['only-local']);
if (!$onlyLocal && (!isset($opts['base']) || !is_string($opts['base']) || trim($opts['base']) === '')) {
    usage('--base=URL を指定してください（誤って本番へアクセスしないよう、既定値はありません）。');
}
foreach (['expect', 'out'] as $k) if (!isset($opts[$k]) || !is_string($opts[$k]) || trim($opts[$k]) === '') usage("--$k を指定してください");
$base = $onlyLocal ? '' : rtrim($opts['base'], '/');
$localRoot = absPath($opts['local-root'] ?? $REPO);
$port = (int)($opts['port'] ?? 8771);
$outDir = absPath($opts['out']);
$delayMs = (int)($opts['delay'] ?? 300);
$expectFile = absPath($opts['expect']);
if (!is_dir("$localRoot/articles/love")) usage("--local-root に articles/love/ がありません: $localRoot");
if (!is_file($expectFile)) usage("--expect のファイルがありません: $expectFile");
$expect = json_decode(file_get_contents($expectFile), true);
if (!is_array($expect)) usage("--expect を JSON として読めません: $expectFile");
if (isInside($outDir, $REPO)) usage("--out はリポジトリの外を指定してください（tests/ やサイトのツリーに出力を書かないため）: $outDir");
if ($port <= 0) usage('--port が不正です');
$fp = @fsockopen('127.0.0.1', $port, $en, $es, 1);
if ($fp) { fclose($fp); usage("ポート $port は使用中です。--port で別のポートを指定してください"); }

foreach (["$outDir/local", "$outDir/remote"] as $d) if (!is_dir($d) && !mkdir($d, 0777, true)) usage("フォルダを作れません: $d");
$urls = [];
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("$localRoot/articles/love", FilesystemIterator::SKIP_DOTS));
foreach ($it as $f) if ($f->getFilename() === 'index.php') $urls[] = str_replace('\\', '/', substr($f->getPath(), strlen($localRoot))) . '/';
sort($urls);
foreach (array_keys($expect) as $u) if (!in_array($u, $urls, true)) $urls[] = $u;

// ---- サーバー停止（PID指定。途中終了時はシャットダウン処理で停止） ----
$SERVER = null;   // ['proc' => resource, 'pid' => int, 'port' => int, 'stopped' => bool]
$STOPLOG = [];
function stopServer(): void {
    global $SERVER, $STOPLOG;
    if ($SERVER === null || $SERVER['stopped']) return;
    $o = [];
    exec("taskkill /F /PID {$SERVER['pid']} 2>&1", $o, $rc);
    $STOPLOG[] = "ローカルサーバー pid={$SERVER['pid']} taskkill rc=$rc " . trim(implode(' ', $o));
    if (is_resource($SERVER['proc'])) @proc_close($SERVER['proc']);
    $SERVER['stopped'] = true;
    sleep(1);
    $o = [];
    exec("tasklist /FI \"PID eq {$SERVER['pid']}\" /NH 2>&1", $o);
    $alive = (bool)preg_grep('/php/i', $o);
    $fp = @fsockopen('127.0.0.1', $SERVER['port'], $en, $es, 1);
    $listening = (bool)$fp; if ($fp) fclose($fp);
    $STOPLOG[] = "ローカルサーバー pid={$SERVER['pid']} alive_after_stop=" . ($alive ? 'YES' : 'no') . " port {$SERVER['port']} listening_after_stop=" . ($listening ? 'YES' : 'no');
}
register_shutdown_function(function () {
    global $SERVER, $STOPLOG;
    if ($SERVER === null || $SERVER['stopped']) return;
    stopServer();
    fwrite(STDERR, "途中終了のためサーバーを停止しました:\n  " . implode("\n  ", $STOPLOG) . "\n");
});
set_error_handler(function (int $no, string $str, string $file, int $line) {
    if (!(error_reporting() & $no)) return false; // @ で抑止したもの
    throw new ErrorException($str, 0, $no, $file, $line);
});
$put = function (string $f, string $s) { if (file_put_contents($f, $s) === false) throw new RuntimeException("書き込み失敗: $f"); };

// ---- 1. ローカル描画 ----
$errLog = "$outDir/local_error.log"; if (is_file($errLog)) unlink($errLog);
$get = function (string $url) {
    $ctx = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 60, 'header' => "User-Agent: life-fun-prod-verify/1.0\r\n"]]);
    $html = @file_get_contents($url, false, $ctx); $code = 0;
    foreach ($http_response_header ?? [] as $h) if (preg_match('#^HTTP/\S+ (\d+)#', $h, $m)) $code = (int)$m[1];
    return [$code, (string)$html];
};
$local = [];
try {
    $cmd = [PHP_BINARY, '-d', 'display_errors=0', '-d', 'log_errors=1', '-d', "error_log=$errLog", '-S', "127.0.0.1:$port", '-t', $localRoot, $ROUTER];
    $proc = proc_open($cmd, [0 => ['pipe', 'r'], 1 => ['file', "$outDir/local_server.out", 'w'], 2 => ['file', "$outDir/local_server.err", 'w']], $pipes);
    if (!is_resource($proc)) throw new RuntimeException('ローカルサーバーを起動できません');
    $SERVER = ['proc' => $proc, 'pid' => proc_get_status($proc)['pid'], 'port' => $port, 'stopped' => false];
    $put("$outDir/local_server.pid", "{$SERVER['pid']}\n");
    $ready = false;   // 待ち受け開始を待つ（最大15秒）
    for ($i = 0; $i < 30 && !$ready; $i++) { $fp = @fsockopen('127.0.0.1', $port, $en, $es, 1); if ($fp) { fclose($fp); $ready = true; } else usleep(500000); }
    if (!$ready) throw new RuntimeException("ローカルサーバー（port {$port}）が起動しません");
    foreach ($urls as $u) { $local[$u] = $get("http://127.0.0.1:$port$u"); $put("$outDir/local/" . str_replace('/', '_', $u) . '.html', $local[$u][1]); }
} catch (Throwable $e) {
    stopServer();
    fwrite(STDERR, "異常終了: " . get_class($e) . ': ' . $e->getMessage() . " ({$e->getFile()}:{$e->getLine()})\n"
        . "サーバーは停止しました:\n  " . implode("\n  ", $STOPLOG) . "\n");
    exit(2);
} finally {
    stopServer();
}

// ---- 2. 本番取得 ----
$remote = [];
if (!$onlyLocal) foreach ($urls as $u) {
    $remote[$u] = $get($base . $u);
    $put("$outDir/remote/" . str_replace('/', '_', $u) . '.html', $remote[$u][1]);
    usleep($delayMs * 1000);
}
restore_error_handler();

// ---- 3. 照合 ----
$errRe = '/<b>(Warning|Notice|Deprecated|Fatal error)<\/b>:|(Warning|Notice|Deprecated|Fatal error): .{0,200} in .{0,200} on line \d+/';
$fails = []; $stats = ['pages' => count($urls), 'expectPages' => count($expect), 'must' => 0, 'mustNot' => 0];
$checkExpect = function (string $side, string $u, string $html) use ($expect, &$fails, &$stats) {
    if (!isset($expect[$u])) return;
    $sent = array_flip(mainSentences($html));
    foreach ($expect[$u]['must'] as $s) { $stats['must']++; if (!isset($sent[$s])) $fails[] = "[$side] $u 修正後の文が無い: " . mb_strimwidth($s, 0, 100, '…'); }
    foreach ($expect[$u]['mustNot'] as $s) { $stats['mustNot']++; if (isset($sent[$s])) $fails[] = "[$side] $u 旧文が残っている: " . mb_strimwidth($s, 0, 100, '…'); }
};
foreach ($urls as $u) {
    [$lc, $lh] = $local[$u];
    if ($lc !== 200) $fails[] = "[local] $u HTTP $lc";
    if (preg_match($errRe, $lh)) $fails[] = "[local] $u PHPエラー文字列あり";
    $checkExpect('local', $u, $lh);
    if ($onlyLocal) continue;
    [$rc2, $rh] = $remote[$u];
    if ($rc2 !== 200) { $fails[] = "[remote] $u HTTP $rc2"; continue; }
    if (preg_match($errRe, $rh)) $fails[] = "[remote] $u PHPエラー文字列あり";
    if (mainText($lh) !== mainText($rh)) {
        $a = explode("\n", mainText($lh)); $b = explode("\n", mainText($rh));
        $onlyL = array_values(array_diff($a, $b)); $onlyR = array_values(array_diff($b, $a));
        $fails[] = "[diff] $u 本文が不一致 ローカルのみ: " . mb_strimwidth($onlyL[0] ?? '-', 0, 80, '…') . " ／ 本番のみ: " . mb_strimwidth($onlyR[0] ?? '-', 0, 80, '…');
    }
    $checkExpect('remote', $u, $rh);
}
$logLines = file_exists($errLog) ? count(preg_grep('/(Warning|Notice|Deprecated|Fatal error)/', file($errLog))) : 0;
if ($logLines) $fails[] = "[local] error_log に Warning等 $logLines 件";

$res = [];
$res[] = "本番照合 " . date('c');
$res[] = "base=" . ($onlyLocal ? '(only-local)' : $base) . " local-root=$localRoot expect=$expectFile ページ数={$stats['pages']} 期待文のあるページ={$stats['expectPages']} 照合した文 must={$stats['must']} mustNot={$stats['mustNot']}";
$res = array_merge($res, $STOPLOG);
$res[] = $fails ? count($fails) . " FAILURE(S)" : 'ALL PASS';
$res = array_merge($res, $fails);
file_put_contents("$outDir/result.txt", implode("\n", $res) . "\n");
echo implode("\n", array_slice($res, 0, 60)), "\n";
exit($fails ? 1 : 0);
