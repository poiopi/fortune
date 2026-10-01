<?php
/**
 * tests/tools/love-article-diff-report.php
 *
 * 恋愛記事の事実検証ツール：目視用の差分レポート（DEVELOPMENT_RULES.md「記事の事実検証ルール」ルール3）。
 * love-article-render-compare.php が保存した描画済みHTML（render_before/ render_after/）から本文テキストを文単位で取り出し、
 * 変わった文だけを「変更前 → 変更後」で並べた HTML を作る。
 * 先頭に、生成記事（/articles/love/mbti-blood/）の変化を文型ごとにまとめた要約節を置く
 * （数値・MBTIタイプ・血液型・性格プリミティブ名を記号に置き換えて、同じ変化をまとめる）。
 *
 * 使い方:
 *   php tests/tools/love-article-diff-report.php --in=<render-compare の --out> --out=<出力する html のパス>
 *
 *   例（Git Bash）:
 *     php tests/tools/love-article-diff-report.php --in="$TMP/render" --out="$TMP/diff_report.html"
 *
 *   --out はリポジトリの外（一時フォルダ等）を指定する（リポジトリ内は拒否）。
 * 終了コード: 0=作成した / 2=引数・入力のエラー
 */
ini_set('memory_limit', '1G');
$REPO = str_replace('\\', '/', realpath(__DIR__ . '/../..'));

function usage(string $msg): void {
    fwrite(STDERR, "エラー: $msg\n使い方:\n  php tests/tools/love-article-diff-report.php --in=<render-compare の --out> --out=<出力する html のパス>\n");
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

$pages = file("$IN/render_diff_pages.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$meta = is_file("$IN/render_meta.json") ? json_decode(file_get_contents("$IN/render_meta.json"), true) : null;

function bodySentences(string $html): array {
    $html = preg_replace('#<(script|style|noscript)\b.*?</\1>#is', '', $html);
    $html = preg_replace('#^.*?<body[^>]*>#is', '', $html);
    $html = preg_replace('#<(header|footer|nav)\b.*?</\1>#is', "\n", $html); // サイト共通部分を除く
    $html = preg_replace('#<(br|/p|/div|/li|/td|/th|/tr|/h[1-6]|/dt|/dd|/table)\b[^>]*>#i', "\n", $html);
    $text = html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8');
    $out = [];
    foreach (preg_split('/\n+/u', $text) as $line) {
        $line = trim(preg_replace('/[ \t\x{3000}]+/u', ' ', $line));
        if ($line === '') continue;
        foreach (preg_split('/(?<=。)/u', $line) as $s) { $s = trim($s); if ($s !== '') $out[] = $s; }
    }
    return $out;
}
/** LCSで差分の塊（削除列・追加列）を求める */
function hunks(array $a, array $b): array {
    $n = count($a); $m = count($b);
    $L = array_fill(0, $n + 1, array_fill(0, $m + 1, 0));
    for ($i = $n - 1; $i >= 0; $i--) for ($j = $m - 1; $j >= 0; $j--) $L[$i][$j] = $a[$i] === $b[$j] ? $L[$i + 1][$j + 1] + 1 : max($L[$i + 1][$j], $L[$i][$j + 1]);
    $i = $j = 0; $out = []; $del = []; $add = [];
    while ($i < $n || $j < $m) {
        if ($i < $n && $j < $m && $a[$i] === $b[$j]) { if ($del || $add) { $out[] = [$del, $add]; $del = $add = []; } $i++; $j++; }
        elseif ($j < $m && ($i >= $n || $L[$i][$j + 1] >= $L[$i + 1][$j])) $add[] = $b[$j++];
        else $del[] = $a[$i++];
    }
    if ($del || $add) $out[] = [$del, $add];
    return $out;
}
/** 文型（数値・タイプ名・血液型・Primitive名を記号に置換） */
function pattern(string $s): string {
    $s = preg_replace('/[EI][NS][TF][JP]/u', '{MBTI}', $s);
    $s = preg_replace('/(AB|A|B|O)型/u', '{血液型}', $s);
    $s = preg_replace('/行動主導性|誠実性|情動性|自立性|変化志向/u', '{P}', $s);
    $s = preg_replace('/[0-9]+(\.[0-9]+)?/u', '{n}', $s);
    return $s;
}
$h = fn($s) => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');

$perPage = []; $groups = []; $total = 0;
foreach ($pages as $u) {
    $k = str_replace('/', '_', $u) . '.html';
    $hs = hunks(bodySentences(file_get_contents("$IN/render_before/$k")), bodySentences(file_get_contents("$IN/render_after/$k")));
    $perPage[$u] = $hs; $total += count($hs);
    if (str_contains($u, '/mbti-blood/')) foreach ($hs as [$d, $a]) {
        $key = implode(' ／ ', array_map('pattern', $d)) . ' ⇒ ' . implode(' ／ ', array_map('pattern', $a));
        $groups[$key]['pages'][] = basename(rtrim($u, '/'));
        $groups[$key]['ex'] ??= [$d, $a, basename(rtrim($u, '/'))];
    }
}
uasort($groups, fn($x, $y) => count($y['pages']) <=> count($x['pages']));
$nGen = count(array_filter($pages, fn($u) => str_contains($u, '/mbti-blood/')));
$nHand = count($pages) - $nGen;
$nOther = $meta ? $meta['pages'] - count($pages) : null;

ob_start();
?><!doctype html><html lang="ja"><head><meta charset="utf-8"><title>差分レポート（恋愛記事）</title>
<style>
body{font-family:sans-serif;max-width:1200px;margin:20px auto;line-height:1.6;color:#222}
h1{font-size:22px}h2{font-size:18px;border-bottom:2px solid #888;margin-top:36px}h3{font-size:15px;margin:22px 0 6px}
table{border-collapse:collapse;width:100%;margin:6px 0 14px}td,th{border:1px solid #ccc;padding:6px 8px;vertical-align:top;font-size:13px}
th{background:#f3f3f3;width:50%}.del{background:#fff0f0}.add{background:#f0fff2}.meta{color:#666;font-size:12px}
.pat{font-family:monospace;font-size:12px;color:#444}.toc a{margin-right:10px;font-size:13px}
</style></head><body>
<h1>差分レポート：恋愛記事</h1>
<p class="meta">比較元：修正前／修正後のサイトを PHP ビルトインサーバーで描画したHTML（乱数シード固定）から本文テキストを文単位で抽出し、変わった文だけを表示。サイト共通のヘッダー・フッター・ナビ・スクリプトは除外。<br>
<?php if ($meta): ?>修正前：<?= $h($meta['before']) ?>／修正後：<?= $h($meta['after']) ?>（描画 <?= $h($meta['generatedAt']) ?>、判定 <?= $h($meta['result']) ?>）<br><?php endif; ?>
対象 <?= count($pages) ?>ページ（mbti-blood 以外 <?= $nHand ?>＋生成記事 <?= $nGen ?>）、変更箇所 <?= $total ?>か所。<?php if ($nOther !== null): ?>対象外の<?= $nOther ?>ページはHTMLがバイト一致（render_result.txt）。<?php endif; ?></p>

<h2>1. 生成記事（mbti-blood、<?= $nGen ?>記事）の文型別の要約</h2>
<p class="meta">数値は{n}、MBTIタイプは{MBTI}、血液型は{血液型}、性格プリミティブ名は{P}に置き換えて、同じ変化をまとめています。各行の例は1記事分です。全ページの一覧は3章。</p>
<?php $gi = 0; foreach ($groups as $key => $g): $gi++; [$d, $a, $ex] = $g['ex']; ?>
<h3>文型<?= $gi ?>（<?= count($g['pages']) ?>記事）</h3>
<p class="meta">該当：<?= $h(implode(', ', $g['pages'])) ?></p>
<table><tr><th>変更前（例：<?= $h($ex) ?>）</th><th>変更後</th></tr><tr><td class="del"><?= $h(implode("\n", $d)) ?: '（なし）' ?></td><td class="add"><?= $h(implode("\n", $a)) ?: '（なし）' ?></td></tr></table>
<?php endforeach; ?>

<h2>2. 手書き記事（mbti-blood 以外、<?= $nHand ?>記事）</h2>
<?php foreach ($perPage as $u => $hs): if (str_contains($u, '/mbti-blood/')) continue; ?>
<h3><?= $h($u) ?>（<?= count($hs) ?>か所）</h3>
<table><tr><th>変更前</th><th>変更後</th></tr>
<?php foreach ($hs as [$d, $a]): ?><tr><td class="del"><?= nl2br($h(implode("\n", $d))) ?: '（なし）' ?></td><td class="add"><?= nl2br($h(implode("\n", $a))) ?: '（なし）' ?></td></tr><?php endforeach; ?>
</table>
<?php endforeach; ?>

<h2>3. 生成記事（ページごと）</h2>
<?php foreach ($perPage as $u => $hs): if (!str_contains($u, '/mbti-blood/')) continue; ?>
<h3><?= $h($u) ?>（<?= count($hs) ?>か所）</h3>
<table><tr><th>変更前</th><th>変更後</th></tr>
<?php foreach ($hs as [$d, $a]): ?><tr><td class="del"><?= nl2br($h(implode("\n", $d))) ?: '（なし）' ?></td><td class="add"><?= nl2br($h(implode("\n", $a))) ?: '（なし）' ?></td></tr><?php endforeach; ?>
</table>
<?php endforeach; ?>
</body></html>
<?php
if (file_put_contents($OUTFILE, ob_get_clean()) === false) usage("書き込み失敗: $OUTFILE");
echo "out=$OUTFILE\n";
echo "pages=" . count($pages) . " hunks=$total groups=" . count($groups) . "\n";
foreach ($groups as $key => $g) echo count($g['pages']) . "\t" . mb_strimwidth($key, 0, 220, '…') . "\n";
