<?php
declare(strict_types=1);

/**
 * tools/add-love-sitemap-urls.php
 *
 * test.life-fun.net/articles/love/ 配下の実在ページ（ハブ＋記事）を
 * ファイルシステムから列挙し、test.life-fun.net/sitemap.xml へ追記する。
 *
 * - 既にsitemapに存在するURLはスキップ（冪等）
 * - 規約は既存エントリに合わせる:
 *     ハブ   = <url>ブロック複数行、changefreq=monthly、priority=0.7
 *     記事   = 1行圧縮、changefreq=monthly、priority=0.6
 * - lastmodは実行日
 *
 * 使い方: php tools/add-love-sitemap-urls.php [--dry-run]
 */

$root = __DIR__ . '/..';
$loveDir = $root . '/test.life-fun.net/articles/love';
$sitemapFile = $root . '/test.life-fun.net/sitemap.xml';
$dryRun = in_array('--dry-run', $argv, true);
$today = date('Y-m-d');

// 1. URL列挙（実在するindex.phpのみ）
$hubs = ['https://life-fun.net/articles/love/'];
$articles = [];
foreach (scandir($loveDir) as $cat) {
    if ($cat[0] === '.' || !is_dir("$loveDir/$cat")) continue;
    if (!file_exists("$loveDir/$cat/index.php")) continue;
    $hubs[] = "https://life-fun.net/articles/love/$cat/";
    foreach (scandir("$loveDir/$cat") as $slug) {
        if ($slug[0] === '.' || $slug[0] === '_' || !is_dir("$loveDir/$cat/$slug")) continue;
        if (!file_exists("$loveDir/$cat/$slug/index.php")) continue;
        $articles[] = "https://life-fun.net/articles/love/$cat/$slug/";
    }
}
sort($hubs);
sort($articles);
echo "Found: " . count($hubs) . " hubs, " . count($articles) . " articles\n";

// 2. 既存sitemapとの突合
$xml = file_get_contents($sitemapFile);
$newHubs = array_values(array_filter($hubs, fn($u) => strpos($xml, "<loc>$u</loc>") === false));
$newArticles = array_values(array_filter($articles, fn($u) => strpos($xml, "<loc>$u</loc>") === false));
echo "New (not yet in sitemap): " . count($newHubs) . " hubs, " . count($newArticles) . " articles\n";

if (count($newHubs) === 0 && count($newArticles) === 0) {
    echo "Nothing to add.\n";
    exit(0);
}

// 3. XMLブロック生成
$block = "\n  <!-- Love Content Platform（恋愛傾向診断 解説記事群） -->\n";
foreach ($newHubs as $u) {
    $block .= "  <url>\n    <loc>$u</loc>\n    <lastmod>$today</lastmod>\n    <changefreq>monthly</changefreq>\n    <priority>0.7</priority>\n  </url>\n\n";
}
foreach ($newArticles as $u) {
    $block .= "  <url><loc>$u</loc><lastmod>$today</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>\n";
}
$block .= "\n";

// 4. </urlset>直前に挿入
$pos = strrpos($xml, '</urlset>');
if ($pos === false) { fwrite(STDERR, "ERROR: </urlset> not found\n"); exit(1); }
$newXml = substr($xml, 0, $pos) . $block . substr($xml, $pos);

if ($dryRun) {
    echo "--dry-run: not writing. Block preview (first 800 chars):\n";
    echo substr($block, 0, 800) . "\n";
    exit(0);
}

file_put_contents($sitemapFile, $newXml);

// 5. XML整形式チェック
$doc = new DOMDocument();
if (!@$doc->load($sitemapFile)) {
    fwrite(STDERR, "ERROR: sitemap.xml is not well-formed after insertion\n");
    exit(1);
}
$urlCount = $doc->getElementsByTagName('url')->length;
echo "sitemap.xml updated. Total <url> entries: $urlCount (well-formed OK)\n";
