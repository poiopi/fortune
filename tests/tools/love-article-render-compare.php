<?php
/**
 * tests/tools/love-article-render-compare.php
 *
 * 恋愛記事の事実検証ツール ③描画と差分（DEVELOPMENT_RULES.md「記事の事実検証ルール」ルール2の③）。
 * 修正前のサイト（--before）と修正後のサイト（--after）の /articles/ 配下の全ページを
 * PHPビルトインサーバーで描画し、次を機械判定する。
 *   (a) 修正後の全ページが HTTP 200
 *   (b) PHP Warning/Notice/Deprecated/Fatal が 0件（修正後の error_log と HTML の両方。修正前の件数も記録）
 *   (c) HTMLに差分があるページ集合 ＝ 対象ページ集合（--targets）。対象外はバイト一致。
 *       対象ページ内は、AutoLink（class="al-link" の文脈リンク）を除いたタグ列（タグ名・属性・順序）が同一で、
 *       テキストノードだけが変わっていること。AutoLink の位置・本数の変化は別に一覧する（本文が変わると移動・増減しうるため）。
 *
 * 使い方:
 *   php tests/tools/love-article-render-compare.php --before=<修正前のサイトのルート> --targets=<対象URLリスト> --out=<出力先フォルダ>
 *       [--after=<修正後のサイトのルート>] [--ports=8761,8762]
 *
 *   --before   修正前のサイトのルート（test.life-fun.net に相当するフォルダ。修正前のコピー）。必須
 *   --after    修正後のサイトのルート。既定はリポジトリの test.life-fun.net
 *   --targets  今回の対象ページのURLパスを1行1件で書いたテキストファイル（例: /articles/love/mbti/intp/）。必須
 *              空行と # で始まる行は無視。先頭・末尾の / は補う。
 *   --out      出力先フォルダ。必須。リポジトリの外（一時フォルダ等）を指定する（リポジトリ内は拒否）
 *   --ports    ビルトインサーバーのポート（修正前,修正後）。既定 8761,8762。使用中なら起動せずに終了する
 *
 *   例（Git Bash）:
 *     php tests/tools/love-article-render-compare.php --before="$TMP/before/test.life-fun.net" \
 *         --targets="$TMP/targets.txt" --out="$TMP/render"
 *
 * 出力（--out 配下）:
 *   render_before/ render_after/   描画したHTML（ファイル名はURLの / を _ に置換）
 *   render_before_error.log ほか   各サーバーの error_log・標準出力・標準エラー
 *   render_result.txt              判定結果（標準出力と同じ）
 *   render_diff_pages.txt          HTMLに差分があったページ（love-article-diff-report.php・love-article-prod-expect.php の入力）
 *   render_meta.json               ページ数・対象・ルートなどのメタ情報（love-article-diff-report.php が使う）
 *   render_pids.txt                起動したサーバーのPID
 *
 * サーバーは tests/tools/lib/love-article-render-router.php（乱数シード固定）で起動し、
 * 起動時に控えたPIDを taskkill /F /PID で停止する（DEVELOPMENT_RULES.md「ローカル検証作業の必須ルール」。
 * プロセス名での一括終了はしない）。例外・致命的エラーで途中終了した場合もシャットダウン処理で停止する。
 *
 * 終了コード: 0=PASS / 1=FAIL / 2=引数・環境のエラー、または描画中の異常終了（サーバーは停止してから終了する）
 */
ini_set('memory_limit', '1G');

$REPO = str_replace('\\', '/', realpath(__DIR__ . '/../..'));
$ROUTER = str_replace('\\', '/', __DIR__ . '/lib/love-article-render-router.php');

function usage(string $msg): void {
    fwrite(STDERR, "エラー: $msg\n使い方:\n"
        . "  php tests/tools/love-article-render-compare.php --before=<修正前のサイトのルート> --targets=<対象URLリスト> --out=<出力先フォルダ>\n"
        . "      [--after=<修正後のサイトのルート（既定: リポジトリの test.life-fun.net）>] [--ports=8761,8762]\n");
    exit(2);
}
/** まだ存在しないパスも含めて絶対パス化（存在する最も近い祖先を realpath で解決） */
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

$opts = getopt('', ['before:', 'after:', 'targets:', 'out:', 'ports:']);
foreach (['before', 'targets', 'out'] as $k) if (!isset($opts[$k]) || !is_string($opts[$k]) || trim($opts[$k]) === '') usage("--$k を指定してください");
$beforeRoot = absPath($opts['before']);
$afterRoot = absPath($opts['after'] ?? ($REPO . '/test.life-fun.net'));
$targetsFile = absPath($opts['targets']);
$OUT = absPath($opts['out']);
[$portB, $portA] = array_map('intval', explode(',', $opts['ports'] ?? '8761,8762') + [1 => 0]);
if ($portB <= 0 || $portA <= 0 || $portB === $portA) usage('--ports は異なる2つのポートを「修正前,修正後」で指定してください');
foreach (['--before' => $beforeRoot, '--after' => $afterRoot] as $k => $r) if (!is_dir("$r/articles")) usage("$k に articles/ がありません: $r");
if (!is_file($targetsFile)) usage("--targets のファイルがありません: $targetsFile");
if (isInside($OUT, $REPO)) usage("--out はリポジトリの外を指定してください（tests/ やサイトのツリーに出力を書かないため）: $OUT");

$sides = [
    'before' => ['root' => $beforeRoot, 'port' => $portB],
    'after'  => ['root' => $afterRoot, 'port' => $portA],
];
foreach ($sides as $name => $cfg) {
    $fp = @fsockopen('127.0.0.1', $cfg['port'], $en, $es, 1);
    if ($fp) { fclose($fp); usage("ポート {$cfg['port']}（$name 用）は使用中です。--ports で別のポートを指定してください"); }
}

// URL一覧はディレクトリから列挙（articles/ 配下の index.php）
$enumUrls = function (string $root): array {
    $urls = [];
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/articles', FilesystemIterator::SKIP_DOTS));
    foreach ($it as $f) if ($f->getFilename() === 'index.php') $urls[] = str_replace('\\', '/', substr($f->getPath(), strlen($root))) . '/';
    sort($urls);
    return $urls;
};
$urls = $enumUrls($afterRoot);
$urlsBefore = $enumUrls($beforeRoot);

// 対象ページ集合
$targets = [];
foreach (file($targetsFile, FILE_IGNORE_NEW_LINES) as $line) {
    $line = trim($line);
    if ($line === '' || $line[0] === '#') continue;
    $u = '/' . trim($line, '/') . '/';
    if (!in_array($u, $urls, true)) usage("--targets のURLが修正後のサイトにありません: $u");
    $targets[$u] = true;
}
if (!$targets) usage('--targets に対象URLが1件もありません');

set_error_handler(function (int $no, string $str, string $file, int $line) {
    if (!(error_reporting() & $no)) return false; // @ で抑止したもの
    throw new ErrorException($str, 0, $no, $file, $line);
});
$mk = function (string $d) { if (!is_dir($d) && !mkdir($d, 0777, true)) throw new RuntimeException("フォルダを作れません: $d"); };
$put = function (string $f, string $s) { if (file_put_contents($f, $s) === false) throw new RuntimeException("書き込み失敗: $f"); };
$mk($OUT);
foreach (array_keys($sides) as $name) { $mk("$OUT/render_$name"); foreach (glob("$OUT/render_$name/*.html") as $old) if (is_file($old)) unlink($old); }

// ---- サーバー起動・停止（PID指定） ----
$SERVERS = [];   // name => ['proc' => resource, 'pid' => int, 'port' => int, 'stopped' => bool]
$STOPLOG = [];
function stopServers(): void {
    global $SERVERS, $STOPLOG;
    foreach ($SERVERS as $name => &$s) {
        if ($s['stopped']) continue;
        $o = [];
        exec("taskkill /F /PID {$s['pid']} 2>&1", $o, $rc);
        $STOPLOG[] = "server $name pid={$s['pid']} taskkill rc=$rc " . trim(implode(' ', $o));
        if (is_resource($s['proc'])) @proc_close($s['proc']);
        $s['stopped'] = true;
    }
    unset($s);
    if ($SERVERS) sleep(1);
    foreach ($SERVERS as $name => $s) {
        $o = [];
        exec("tasklist /FI \"PID eq {$s['pid']}\" /NH 2>&1", $o);
        $alive = (bool)preg_grep('/php/i', $o);
        $fp = @fsockopen('127.0.0.1', $s['port'], $en, $es, 1);
        $listening = (bool)$fp; if ($fp) fclose($fp);
        $STOPLOG[] = "server $name pid={$s['pid']} alive_after_stop=" . ($alive ? 'YES' : 'no') . " port {$s['port']} listening_after_stop=" . ($listening ? 'YES' : 'no');
    }
}
register_shutdown_function(function () {
    global $SERVERS, $STOPLOG;
    $pending = array_filter($SERVERS, fn($s) => !$s['stopped']);
    if (!$pending) return;
    stopServers();
    fwrite(STDERR, "途中終了のためサーバーを停止しました:\n  " . implode("\n  ", $STOPLOG) . "\n");
});

$codes = [];
try {
    foreach ($sides as $name => $cfg) {
        $errLog = "$OUT/render_{$name}_error.log";
        if (is_file($errLog)) unlink($errLog);
        $cmd = [PHP_BINARY, '-d', 'display_errors=0', '-d', 'log_errors=1', '-d', "error_log=$errLog", '-d', 'error_reporting=' . E_ALL,
                '-S', "127.0.0.1:{$cfg['port']}", '-t', $cfg['root'], $ROUTER];
        $p = proc_open($cmd, [0 => ['pipe', 'r'], 1 => ['file', "$OUT/render_{$name}_server.out", 'w'], 2 => ['file', "$OUT/render_{$name}_server.err", 'w']], $pipes);
        if (!is_resource($p)) throw new RuntimeException("サーバーを起動できません（{$name}）");
        $SERVERS[$name] = ['proc' => $p, 'pid' => proc_get_status($p)['pid'], 'port' => $cfg['port'], 'stopped' => false];
    }
    $put("$OUT/render_pids.txt", json_encode(array_map(fn($s) => $s['pid'], $SERVERS)) . "\n");
    foreach ($SERVERS as $name => $s) {   // 待ち受け開始を待つ（最大15秒）
        $ready = false;
        for ($i = 0; $i < 30 && !$ready; $i++) { $fp = @fsockopen('127.0.0.1', $s['port'], $en, $es, 1); if ($fp) { fclose($fp); $ready = true; } else usleep(500000); }
        if (!$ready) throw new RuntimeException("サーバー（$name, port {$s['port']}）が起動しません");
    }

    $ctx = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 60]]);
    foreach ($sides as $name => $cfg) {
        foreach ($urls as $u) {
            $html = @file_get_contents("http://127.0.0.1:{$cfg['port']}$u", false, $ctx);
            $code = 0;
            foreach ($http_response_header ?? [] as $h) if (preg_match('#^HTTP/\S+ (\d+)#', $h, $m)) $code = (int)$m[1];
            $codes[$name][$u] = $code;
            $put("$OUT/render_$name/" . str_replace('/', '_', $u) . '.html', (string)$html);
        }
    }
} catch (Throwable $e) {
    stopServers();
    fwrite(STDERR, "異常終了: " . get_class($e) . ': ' . $e->getMessage() . " ({$e->getFile()}:{$e->getLine()})\n"
        . "サーバーは停止しました:\n  " . implode("\n  ", $STOPLOG) . "\n");
    exit(2);
} finally {
    stopServers();
}
restore_error_handler();
$log = $STOPLOG;

// ---- 判定 ----
$page = fn(string $side, string $u) => file_get_contents("$OUT/render_$side/" . str_replace('/', '_', $u) . '.html');
$res = [];
$res[] = "# 描画比較（修正前 / 修正後）";
$res[] = "修正前: $beforeRoot";
$res[] = "修正後: $afterRoot";
$res[] = "ページ数（ディレクトリから列挙）: 修正後 " . count($urls) . " / 修正前 " . count($urlsBefore) . "（一覧一致: " . ($urls === $urlsBefore ? 'yes' : 'NO') . "）";
$res[] = '';
// (a)
$non200 = array_filter($codes['after'], fn($c) => $c !== 200);
$non200b = array_filter($codes['before'], fn($c) => $c !== 200);
$res[] = "(a) HTTP 200: 修正後 " . (count($urls) - count($non200)) . "/" . count($urls) . "（200以外 " . count($non200) . "件" . ($non200 ? ': ' . json_encode($non200) : '') . "）／修正前 200以外 " . count($non200b) . "件";
$okA = count($non200) === 0;
// (b)
$errPat = '/(PHP )?(Warning|Notice|Deprecated|Fatal error|Parse error)\s*:/';
$logCount = []; $htmlHitCount = [];
foreach (array_keys($sides) as $name) {
    $f = "$OUT/render_{$name}_error.log";
    $lines = file_exists($f) ? array_values(array_filter(file($f, FILE_IGNORE_NEW_LINES), fn($l) => preg_match($errPat, $l))) : [];
    $logCount[$name] = $lines;
    $htmlHits = [];
    foreach ($urls as $u) { $h = $page($name, $u); if (preg_match('/<b>(Warning|Notice|Deprecated|Fatal error)<\/b>:|(Warning|Notice|Deprecated|Fatal error): .* in .* on line \d+/', $h)) $htmlHits[] = $u; }
    $htmlHitCount[$name] = count($htmlHits);
    $kinds = [];
    foreach ($lines as $l) if (preg_match('/(Warning|Notice|Deprecated|Fatal error|Parse error):\s*(.{0,80})/', $l, $m)) $kinds["{$m[1]}: {$m[2]}"] = ($kinds["{$m[1]}: {$m[2]}"] ?? 0) + 1;
    $res[] = "(b) $name: error_log の Warning/Notice/Deprecated/Fatal " . count($lines) . "件、HTML内のエラー文字列 " . count($htmlHits) . "ページ";
    foreach ($kinds as $k => $v) $res[] = "      {$v}件  $k";
}
$okB = count($logCount['after']) === 0 && $htmlHitCount['after'] === 0;
// (c)
$diffPages = [];
foreach ($urls as $u) if (!in_array($u, $urlsBefore, true) || $page('before', $u) !== $page('after', $u)) $diffPages[] = $u;
$tset = array_keys($targets); sort($tset); $dset = $diffPages; sort($dset);
$missing = array_diff($tset, $dset); $extra = array_diff($dset, $tset);
$nGen = count(array_filter($tset, fn($u) => str_contains($u, '/mbti-blood/')));
$res[] = "(c) HTMLに差分があるページ: " . count($dset) . "件 ／ 対象ページ集合: " . count($tset) . "件（mbti-blood 以外 " . (count($tset) - $nGen) . "＋mbti-blood（生成記事） {$nGen}）";
$res[] = "    集合一致: " . ($missing || $extra ? 'NO' : 'yes') . ($missing ? ' 差分が無い対象: ' . implode(',', $missing) : '') . ($extra ? ' 対象外の差分: ' . implode(',', $extra) : '');
$res[] = "    対象外ページ（" . (count($urls) - count($tset)) . "件）はバイト一致: " . ($extra ? 'NO' : 'yes');
// 対象ページ内：タグ列が同一で、テキストノードだけが変わっているか
// AutoLink（inc/autolink の文脈リンク。<a ... class="al-link">）は本文の語の初出に付くため、
// 本文が変わるとリンクの位置が移動・増減する。これはタグ列の比較から外し、別に一覧する。
function tokens(string $h, ?array &$al = null): array {
    preg_match_all('/<[^>]*>|[^<]+/u', $h, $m);
    $out = []; $skipClose = 0; $al = [];
    foreach ($m[0] as $t) {
        if (preg_match('/^<a [^>]*class="al-link"[^>]*>$/', $t)) { $skipClose++; preg_match('/href="([^"]*)"/', $t, $hm); $al[] = $hm[1] ?? '?'; continue; }
        if ($t === '</a>' && $skipClose > 0) { $skipClose--; continue; }
        if ($t[0] !== '<' && $out && end($out)[0] !== '<') { $out[count($out) - 1] .= $t; continue; }
        $out[] = $t;
    }
    return $out;
}
$structOk = true; $textChanged = 0; $parents = []; $alMoves = [];
foreach ($dset as $u) {
    if (!in_array($u, $urlsBefore, true)) { $structOk = false; $res[] = "    修正前に存在しないページ: $u"; continue; }
    $a = tokens($page('before', $u), $alA); $b = tokens($page('after', $u), $alB);
    if ($alA !== $alB) {
        $ca = array_count_values($alA); $cb = array_count_values($alB); $d = [];
        foreach ($ca + $cb as $h => $_) { $x = ($cb[$h] ?? 0) - ($ca[$h] ?? 0); if ($x) $d[] = sprintf('%+d %s', $x, $h); }
        $alMoves[] = "$u: AutoLink " . count($alA) . "→" . count($alB) . "本" . ($d ? '（増減: ' . implode(', ', $d) . '）' : '（同じリンク先・位置のみ移動）');
    }
    $ta = array_values(array_filter($a, fn($t) => $t[0] === '<')); $tb = array_values(array_filter($b, fn($t) => $t[0] === '<'));
    if ($ta !== $tb) { $structOk = false; $res[] = "    タグ列が異なる: $u"; continue; }
    // テキストノードを、直前の開始タグ（親）ごとに比較
    $seqA = []; $seqB = []; $cur = '';
    foreach ($a as $t) { if ($t[0] === '<') { $cur = $t; } else $seqA[] = [$cur, $t]; }
    $cur = '';
    foreach ($b as $t) { if ($t[0] === '<') { $cur = $t; } else $seqB[] = [$cur, $t]; }
    if (count($seqA) !== count($seqB)) { $structOk = false; $res[] = "    テキストノード数が異なる: $u"; continue; }
    foreach ($seqA as $i => [$pa, $xa]) if ($xa !== $seqB[$i][1]) { $textChanged++; preg_match('/^<\/?([a-zA-Z0-9]+)([^>]*)/', $pa, $pm); $tag = strtolower($pm[1] ?? '?'); if ($tag === 'script') $tag .= preg_match('/ld\+json/', $pm[2] ?? '') ? '(ld+json)' : ''; $parents[$tag] = ($parents[$tag] ?? 0) + 1; }
}
arsort($parents);
$res[] = "    対象ページ内の差分: AutoLink（al-link）を除いたタグ列（タグ名・属性・順序）は全ページで同一=" . ($structOk ? 'yes' : 'NO') . "、変わったテキストノード " . $textChanged . "個（直前のタグ別: " . json_encode($parents, JSON_UNESCAPED_UNICODE) . "）";
$res[] = "    AutoLinkの位置・本数が変わったページ: " . count($alMoves) . "件";
foreach ($alMoves as $x) $res[] = "      $x";
$okC = !$missing && !$extra && $structOk;
$res[] = '';
$res[] = '総合: ' . ($okA && $okB && $okC ? 'PASS' : 'FAIL') . "  (a)=" . ($okA ? 'PASS' : 'FAIL') . " (b)=" . ($okB ? 'PASS' : 'FAIL') . " (c)=" . ($okC ? 'PASS' : 'FAIL');
$res[] = '';
$res = array_merge($res, $log);
file_put_contents("$OUT/render_result.txt", implode("\n", $res) . "\n");
file_put_contents("$OUT/render_diff_pages.txt", implode("\n", $dset) . "\n");
file_put_contents("$OUT/render_meta.json", json_encode([
    'generatedAt' => date('c'), 'before' => $beforeRoot, 'after' => $afterRoot, 'targetsFile' => $targetsFile,
    'pages' => count($urls), 'targets' => $tset, 'diffPages' => $dset, 'result' => ($okA && $okB && $okC ? 'PASS' : 'FAIL'),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n");
echo implode("\n", $res), "\n";
exit($okA && $okB && $okC ? 0 : 1);
