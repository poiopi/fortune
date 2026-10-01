<?php
/**
 * tests/tools/love-article-prod-expect.php
 *
 * 恋愛記事の事実検証ツール：本番照合（love-article-prod-verify.php）の期待値を作る。
 * love-article-render-compare.php が保存した描画済みHTML（render_before/ render_after/）のうち、
 * 差分のあったページ（render_diff_pages.txt）について、本文領域（tests/tools/lib/love-article-text.php）の文を比べ、
 * 「修正後に含まれるべき文（must）」と「含まれてはならない旧文（mustNot）」を JSON に書き出す。
 *   { "/articles/love/...": {"must": [...], "mustNot": [...]} }
 *
 * 使い方:
 *   php tests/tools/love-article-prod-expect.php --in=<render-compare の --out> --out=<出力する json のパス>
 *
 *   例（Git Bash）:
 *     php tests/tools/love-article-prod-expect.php --in="$TMP/render" --out="$TMP/prod_expect.json"
 *
 *   --out はリポジトリの外（一時フォルダ等）を指定する（リポジトリ内は拒否）。
 * 終了コード: 0=作成した / 2=引数・入力のエラー
 */
require __DIR__ . '/lib/love-article-text.php';
$REPO = str_replace('\\', '/', realpath(__DIR__ . '/../..'));

function usage(string $msg): void {
    fwrite(STDERR, "エラー: $msg\n使い方:\n  php tests/tools/love-article-prod-expect.php --in=<render-compare の --out> --out=<出力する json のパス>\n");
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
$opts = getopt('', ['in:', 'out:']);
foreach (['in', 'out'] as $k) if (!isset($opts[$k]) || !is_string($opts[$k]) || trim($opts[$k]) === '') usage("--$k を指定してください");
$IN = absPath($opts['in']);
$OUTFILE = absPath($opts['out']);
if (!is_file("$IN/render_diff_pages.txt") || !is_dir("$IN/render_before") || !is_dir("$IN/render_after")) usage("--in に render-compare の出力（render_diff_pages.txt・render_before/・render_after/）がありません: $IN");
if (isInside($OUTFILE, $REPO)) usage("--out はリポジトリの外を指定してください: $OUTFILE");
if (!is_dir(dirname($OUTFILE)) && !mkdir(dirname($OUTFILE), 0777, true)) usage('出力先フォルダを作れません: ' . dirname($OUTFILE));

$out = [];
foreach (file("$IN/render_diff_pages.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $u) {
    $k = str_replace('/', '_', $u) . '.html';
    $b = mainSentences(file_get_contents("$IN/render_before/$k"));
    $a = mainSentences(file_get_contents("$IN/render_after/$k"));
    $must = array_values(array_diff($a, $b));
    $mustNot = array_values(array_diff($b, $a));
    $out[$u] = ['must' => $must, 'mustNot' => $mustNot];
}
if (file_put_contents($OUTFILE, json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)) === false) usage("書き込み失敗: $OUTFILE");
$m = array_sum(array_map(fn($x) => count($x['must']), $out)); $n = array_sum(array_map(fn($x) => count($x['mustNot']), $out));
echo "out=$OUTFILE\n";
echo "pages=" . count($out) . " must=$m mustNot=$n\n";
foreach ($out as $u => $x) if (!$x['must'] || !$x['mustNot']) echo "  note: $u must=" . count($x['must']) . " mustNot=" . count($x['mustNot']) . "\n";
