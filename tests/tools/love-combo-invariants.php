<?php
declare(strict_types=1);

/**
 * love-combo-invariants.php
 *
 * MBTI×血液型 組み合わせ記事（articles/love/mbti-blood/）の生成物に対する
 * 構造的不変条件（invariants）をチェックする。tools/generate-combo-articles.php
 * でテンプレート・文言を変更して再生成するたびに実行し、生成器のバグを
 * 記事内容ではなく機械的なルールで検出する。
 *
 * チェック内容:
 *   1. combo-data-64.json が正確に64件
 *   2. slug の重複なし
 *   3. prev/next が単一の直線チェーン（循環なし、64件全てが1本で連結）
 *   4. 全64記事の<title>が重複なし
 *   5. sitemap.xml のmbti-blood記事URL件数が64件と一致
 *
 * 実行方法: php tests/tools/love-combo-invariants.php
 */

$root = __DIR__ . '/../..';
$dataFile = $root . '/docs/love/combo-data-64.json';
$articlesDir = $root . '/test.life-fun.net/articles/love/mbti-blood';
$sitemapFile = $root . '/test.life-fun.net/sitemap.xml';

$fail = 0;
$log = [];

function check(string $label, bool $ok, string $detail = ''): void {
    global $fail, $log;
    if (!$ok) $fail++;
    $log[] = sprintf("[%s] %s%s", $ok ? 'PASS' : 'FAIL', $label, $detail !== '' ? " — {$detail}" : '');
}

// ---- 1. JSON件数 ----
$data = json_decode(file_get_contents($dataFile), true);
$combos = $data['combos'] ?? [];
check('combo-data-64.json count === 64', count($combos) === 64, 'actual=' . count($combos));

// ---- 2. slug重複なし ----
$slugs = array_column($combos, 'slug');
$dupSlugs = array_diff_assoc($slugs, array_unique($slugs));
check('no duplicate slugs in JSON', count($dupSlugs) === 0, count($dupSlugs) > 0 ? implode(',', $dupSlugs) : '');

// ---- ファイル存在確認 ----
$missingFiles = [];
foreach ($slugs as $slug) {
    if (!file_exists("$articlesDir/$slug/index.php")) $missingFiles[] = $slug;
}
check('all 64 article files exist', count($missingFiles) === 0, implode(',', $missingFiles));

// ---- 3. prev/nextチェーン ----
function extractUrl(string $content, string $field): ?string {
    if (preg_match("/'$field'\s*=>\s*\[.*?'url'\s*=>\s*'([^']*)'/s", $content, $m)) {
        return basename(rtrim($m[1], '/'));
    }
    return null;
}
$prevMap = []; $nextMap = [];
foreach ($slugs as $slug) {
    $file = "$articlesDir/$slug/index.php";
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    $prevMap[$slug] = extractUrl($content, 'prev');
    $nextMap[$slug] = extractUrl($content, 'next');
}
// 期待順序 = JSON配列の並び順（自然順）
$chainErrors = [];
foreach ($slugs as $i => $slug) {
    $expectedPrev = $i > 0 ? $slugs[$i - 1] : null;
    $expectedNext = $i < count($slugs) - 1 ? $slugs[$i + 1] : null;
    if (($prevMap[$slug] ?? null) !== $expectedPrev) $chainErrors[] = "$slug: prev expected=$expectedPrev actual=" . ($prevMap[$slug] ?? 'null');
    if (($nextMap[$slug] ?? null) !== $expectedNext) $chainErrors[] = "$slug: next expected=$expectedNext actual=" . ($nextMap[$slug] ?? 'null');
}
check('prev/next chain matches natural order (no cycles/gaps)', count($chainErrors) === 0, count($chainErrors) > 0 ? ($chainErrors[0] . (count($chainErrors) > 1 ? ' (+' . (count($chainErrors) - 1) . ' more)' : '')) : '');

// head/tail一意性の追加確認（万一チェーンが分岐/合流していないか）
$headCount = count(array_filter($prevMap, fn($v) => $v === null));
$tailCount = count(array_filter($nextMap, fn($v) => $v === null));
check('exactly one chain head (prev=null)', $headCount === 1, "count=$headCount");
check('exactly one chain tail (next=null)', $tailCount === 1, "count=$tailCount");

// ---- 4. タイトル重複なし ----
$titles = [];
foreach ($slugs as $slug) {
    $file = "$articlesDir/$slug/index.php";
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    if (preg_match("/'title'\s*=>\s*'([^']*)'/", $content, $m)) {
        $titles[$slug] = $m[1];
    }
}
$dupTitles = array_diff_assoc($titles, array_unique($titles));
check('all 64 titles unique', count($dupTitles) === 0, count($dupTitles) > 0 ? implode(',', array_keys($dupTitles)) : '');
check('all 64 articles have a title', count($titles) === 64, 'found=' . count($titles));

// ---- 5. sitemap件数一致 ----
$sitemapXml = file_get_contents($sitemapFile);
preg_match_all('#<loc>https://life-fun\.net/articles/love/mbti-blood/([a-z-]+)/</loc>#', $sitemapXml, $sitemapMatches);
$sitemapSlugs = $sitemapMatches[1] ?? [];
check('sitemap.xml has exactly 64 mbti-blood article URLs', count($sitemapSlugs) === 64, 'actual=' . count($sitemapSlugs));
$missingFromSitemap = array_diff($slugs, $sitemapSlugs);
check('every JSON slug present in sitemap.xml', count($missingFromSitemap) === 0, implode(',', $missingFromSitemap));

// ---- 結果出力 ----
echo "=== Love Combo Invariants ===\n\n";
foreach ($log as $line) echo $line . "\n";
echo "\n";

if ($fail === 0) {
    echo "総合結果: ALL PASS\n";
    exit(0);
}
echo "総合結果: {$fail} FAILURE(S)\n";
exit(1);
