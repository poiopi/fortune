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
 *   【2026-10-01追加】（docs/love/12-combo-classification.md 2-2節・8-2節）
 *   6. JSONの comboSecondary（同数時はPRIMITIVE_PRIORITY_ORDER）・comboSecondaryTies・yieldedPrimary・
 *      yieldedAsSecondaryCount/Rate を、スナップショットから再計算した値と照合
 *   7. 拮抗型の本文（結論・因果テーブル・因果説明・FAQ）の「副軸として残る（◯%）」・件数が yieldedAsSecondary* と一致し、
 *      最多の副軸が別のときは「（最も多い副軸は◯◯の◯%・◯件）」を併記
 *   8. 生成記事に閾値つきの形容詞（「高確率」「一部残る」）が残っていない
 *   9. 副軸が同数（comboSecondaryTies）のときは、まとめに「（◯◯も同数の◯%）」を併記
 *  10. 協調型の集中度の文：組み合わせが両方の単体を上回るときだけ「さらに強く」「よりも高い集中度」
 *  11. 血液型の要素が単体主軸へ寄与しない記事（B型）に「B型由来の誠実性」「誠実性に強く寄与」が無い
 *  12. 生成器の対象記事（enfj-bを含む62本）が、生成器の現在の出力とバイト一致（手修正の混入・再生成で失われる差分が無い）
 *
 * 実行方法: php tests/tools/love-combo-invariants.php
 *           php tests/tools/love-combo-invariants.php --root=<サイトのルート> [--data=<combo-data-64.json>]
 *           （--root 既定: test.life-fun.net。修正前のコピーや本番用ツリーに対しても実行できる）
 *           （--root を指定しても、検査6〜12の構造（inc/のマッピング定数）は常にリポジトリの test.life-fun.net/inc/ を使う）
 */

$root = __DIR__ . '/../..';
$opts = getopt('', ['root:', 'data:']);
$siteRoot = rtrim($opts['root'] ?? ($root . '/test.life-fun.net'), '/\\');
$dataFile = $opts['data'] ?? ($root . '/docs/love/combo-data-64.json');
$articlesDir = $siteRoot . '/articles/love/mbti-blood';
$sitemapFile = $siteRoot . '/sitemap.xml';

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

// ======================================================================
// 6〜12.【2026-10-01追加】副軸・同数・形容詞・協調型・B型・生成器一致
// ======================================================================
// 構造（マッピング定数）は --root の指定に関わらず、スナップショット生成元・生成器と同じリポジトリの test.life-fun.net/inc/ を読み取り専用で使う
ini_set('memory_limit', '2G');
require_once $root . '/test.life-fun.net/inc/trait-vocabulary.php';
require_once $root . '/test.life-fun.net/inc/axis-vocabulary.php';
require_once $root . '/test.life-fun.net/inc/blood-trait-mapping.php';
require_once $root . '/test.life-fun.net/inc/axis-mapping.php';
require_once $root . '/test.life-fun.net/inc/love-primitive-mapping.php';
$primName = ['ACT' => '行動主導性', 'REL' => '誠実性', 'SEN' => '情動性', 'AUT' => '自立性', 'TRA' => '変化志向'];
$prio = ['ACT' => 0, 'REL' => 1, 'SEN' => 2, 'AUT' => 3, 'TRA' => 4];
$sortCnt = function (array $cnt) use ($prio): array { uksort($cnt, fn($a, $b) => ($cnt[$b] <=> $cnt[$a]) ?: ($prio[$a] <=> $prio[$b])); return $cnt; };

// スナップショットから独立に再計算（tools/build-combo-data.php を通さない）
$snap = require $root . '/tests/cases/love-final-snapshot.php';
$byM = []; $byB = []; $byMB = [];
foreach ($snap['cases'] as $c) {
    [, $p1, $p2] = explode('_', $c['expected']['bundleId']);
    $m = $c['input']['mbti']; $b = $c['input']['blood'];
    $byM[$m][$p1] = ($byM[$m][$p1] ?? 0) + 1;
    $byB[$b][$p1] = ($byB[$b][$p1] ?? 0) + 1;
    $byMB["$m-$b"][] = [$p1, $p2];
}
unset($snap);
$recalc = [];
foreach ($byMB as $k => $rows) {
    [$m, $b] = explode('-', $k);
    $mP = array_key_first($sortCnt($byM[$m])); $bP = array_key_first($sortCnt($byB[$b]));
    $pc = []; foreach ($rows as [$p1]) $pc[$p1] = ($pc[$p1] ?? 0) + 1; $pc = $sortCnt($pc); $cP = array_key_first($pc);
    $sec = []; foreach ($rows as [$p1, $p2]) if ($p1 === $cP) $sec[$p2] = ($sec[$p2] ?? 0) + 1; $sec = $sortCnt($sec);
    $top = array_key_first($sec); $pm = array_sum($sec);
    $class = ($cP === $mP && $cP === $bP) ? '協調型' : ($cP === $bP ? '拮抗型（血液型優勢）' : ($cP === $mP ? '拮抗型（MBTI優勢）' : '転換型'));
    $y = $class === '拮抗型（MBTI優勢）' ? $bP : ($class === '拮抗型（血液型優勢）' ? $mP : null);
    $recalc[strtolower($m) . '-' . strtolower($b)] = [
        'comboSecondary' => $top, 'comboSecondaryCount' => $sec[$top], 'primaryMatchCount' => $pm,
        'comboSecondaryTies' => array_values(array_filter(array_keys($sec), fn($s) => $s !== $top && $sec[$s] === $sec[$top])),
        'yieldedPrimary' => $y, 'yieldedAsSecondaryCount' => $y !== null ? ($sec[$y] ?? 0) : null,
        'yieldedAsSecondaryRate' => $y !== null ? round(($sec[$y] ?? 0) / $pm * 100, 1) : null,
    ];
}
$jsonErr = [];
foreach ($combos as $c) {
    $r = $recalc[$c['slug']] ?? null;
    foreach (['comboSecondary', 'comboSecondaryCount', 'primaryMatchCount', 'comboSecondaryTies', 'yieldedPrimary', 'yieldedAsSecondaryCount', 'yieldedAsSecondaryRate'] as $k) {
        if (!array_key_exists($k, $c)) { $jsonErr[] = "{$c['slug']}: $k missing"; continue; }
        $a = $c[$k]; $e = $r[$k];
        if (is_float($e) || is_float($a)) { if ($a === null || $e === null || abs((float)$a - (float)$e) > 1e-9) $jsonErr[] = "{$c['slug']}: $k json=" . json_encode($a) . " recalc=" . json_encode($e); }
        elseif ($a !== $e) $jsonErr[] = "{$c['slug']}: $k json=" . json_encode($a) . " recalc=" . json_encode($e);
    }
}
check('6. JSON secondary/ties/yielded* match snapshot recalculation', count($jsonErr) === 0, $jsonErr ? ($jsonErr[0] . (count($jsonErr) > 1 ? ' (+' . (count($jsonErr) - 1) . ' more)' : '')) : '');

// 記事の読み込み（配列として評価）
function loadComboArticle(string $file): ?array {
    if (!file_exists($file)) return null;
    $src = preg_replace('/^<\?php\s*/', '', file_get_contents($file));
    $src = str_replace("require __DIR__ . '/../_combo-tpl.php';", '', $src);
    $item = null; eval($src); return $item;
}
// 生成器の対象（手動実装でスキップされる記事を除く）。スキップ一覧は生成器から読む
preg_match('/\$alreadyPublished\s*=\s*\[([^\]]*)\]/', file_get_contents($root . '/tools/generate-combo-articles.php'), $sk);
preg_match_all("/'([a-z]+-[a-z]+)'/", $sk[1] ?? '', $skm);
$skipped = $skm[1];
$errs = ['7' => [], '8' => [], '9' => [], '10' => [], '11' => []];
$byslug = []; foreach ($combos as $c) $byslug[$c['slug']] = $c;
foreach ($combos as $c) {
    $slug = $c['slug']; $a = loadComboArticle("$articlesDir/$slug/index.php");
    if ($a === null) { $errs['7'][] = "$slug: not loadable"; continue; }
    $generated = !in_array($slug, $skipped, true);
    $txt = json_encode($a, JSON_UNESCAPED_UNICODE);
    $r = $recalc[$slug];
    // 7. 拮抗型の副軸の記述（生成記事。手動実装記事も数値の一致は確認）
    if (str_starts_with($c['classification'], '拮抗型') && $generated) {
        $y = $r['yieldedAsSecondaryCount']; $rate = $r['yieldedAsSecondaryRate']; $pm = $r['primaryMatchCount'];
        $yName = $primName[$r['yieldedPrimary']];
        $row = null; foreach ($a['causalRows'] as $cr) if ($cr['adopted'] === false) $row = $cr['result'];
        $expRow = $y > 0 ? "主軸としては不採用。副軸として残る（{$rate}%）" : '主軸としては不採用。副軸にも現れない（0件）';
        if ($row !== $expRow) $errs['7'][] = "$slug: causalRows「{$row}」≠「{$expRow}」";
        $needConc = $y > 0 ? "{$rate}%（{$pm}件中{$y}件）で副軸として残ります" : "（{$pm}件）では副軸にも現れません";
        if (mb_strpos($a['conclusion'], $needConc) === false) $errs['7'][] = "$slug: conclusion lacks「{$needConc}」";
        $needExp = "{$yName}は、";
        $expExp = $y > 0 ? "（{$pm}件）のうち{$rate}%（{$y}件）で副軸として残ります" : "（{$pm}件）では副軸にも現れません";
        if (mb_strpos($a['causal_explanation'], $needExp) === false || mb_strpos($a['causal_explanation'], $expExp) === false) $errs['7'][] = "$slug: causal_explanation lacks「{$needExp}…{$expExp}」";
        $topNote = "（最も多い副軸は{$primName[$r['comboSecondary']]}の{$c['comboSecondaryRate']}%・{$r['comboSecondaryCount']}件）";
        $hasNote = mb_strpos($a['causal_explanation'], '最も多い副軸は') !== false;
        if ($r['yieldedPrimary'] !== $r['comboSecondary'] && mb_strpos($a['causal_explanation'], $topNote) === false) $errs['7'][] = "$slug: 最多副軸の併記が無い「{$topNote}」";
        if ($r['yieldedPrimary'] === $r['comboSecondary'] && $hasNote) $errs['7'][] = "$slug: 最多副軸が同じなのに併記がある";
        $faqA = $a['faq'][1]['a'] ?? '';
        if ($y > 0 ? !str_starts_with($faqA, '完全には消えません。') || mb_strpos($faqA, "{$rate}%（{$pm}件中{$y}件）") === false : mb_strpos($faqA, '副軸にも現れません') === false) $errs['7'][] = "$slug: FAQ「" . mb_substr($faqA, 0, 40) . "」";
    }
    // 8. 閾値つきの形容詞（生成記事）
    if ($generated) foreach (['高確率', '一部残る'] as $w) if (mb_strpos($txt, $w) !== false) $errs['8'][] = "$slug: 「{$w}」";
    // 9. 副軸の同数の併記
    $mat = implode('', $a['matome']);
    $tieNote = $r['comboSecondaryTies'] ? '（' . implode('・', array_map(fn($t) => $primName[$t], $r['comboSecondaryTies'])) . "も同数の{$c['comboSecondaryRate']}%）" : null;
    if ($tieNote !== null && mb_strpos($mat, $tieNote) === false) $errs['9'][] = "$slug: まとめに「{$tieNote}」が無い";
    if ($tieNote === null && mb_strpos($mat, 'も同数の') !== false) $errs['9'][] = "$slug: 同数でないのに併記がある";
    // 10. 協調型の集中度の文
    if ($c['classification'] === '協調型') {
        $above = $c['comboPrimaryRate'] > $c['mbtiPrimaryRate'] && $c['comboPrimaryRate'] > $c['bloodPrimaryRate'];
        $saysAbove = mb_strpos($txt, 'さらに強く') !== false || mb_strpos($txt, 'よりも高い集中度') !== false;
        if ($above !== $saysAbove) $errs['10'][] = "$slug: combo={$c['comboPrimaryRate']} mbti={$c['mbtiPrimaryRate']} blood={$c['bloodPrimaryRate']} 「さらに強く/よりも高い集中度」=" . ($saysAbove ? 'あり' : 'なし');
        if (!$above && mb_strpos($txt, 'より高い一方') === false && mb_strpos($txt, '上回りません') === false) $errs['10'][] = "$slug: 両単体を上回らないのに分岐文が無い";
    }
    // 11. 血液型の要素が単体主軸へ寄与しないのに「由来」「強く寄与」と書いていないか
    $bloodPrimJa = $primName[$c['bloodPrimary']];
    $contrib = false;
    foreach (BLOOD_TRAIT_MAPPING[$c['blood']] as $rule) { $axis = AXIS_MAPPING[$rule['trait']][0]['axis']; if (PRIMITIVE_AXIS_MAP[$bloodPrimJa] === $axis) $contrib = true; }
    if (!$contrib) {
        foreach (["{$c['blood']}型由来の{$bloodPrimJa}", "{$bloodPrimJa}に強く寄与", "{$bloodPrimJa}）に強く寄与"] as $w) if (mb_strpos($txt, $w) !== false) $errs['11'][] = "$slug: 「{$w}」";
    }
}
check('7. 拮抗型の「副軸として残る」記述が yieldedAsSecondary* と一致し、最多副軸が別なら併記', count($errs['7']) === 0, $errs['7'] ? ($errs['7'][0] . (count($errs['7']) > 1 ? ' (+' . (count($errs['7']) - 1) . ' more)' : '')) : '');
check('8. 生成記事に閾値つきの形容詞（高確率・一部残る）が無い', count($errs['8']) === 0, $errs['8'] ? ($errs['8'][0] . (count($errs['8']) > 1 ? ' (+' . (count($errs['8']) - 1) . ' more)' : '')) : '');
check('9. 副軸の同数（comboSecondaryTies）を併記', count($errs['9']) === 0, $errs['9'] ? ($errs['9'][0] . (count($errs['9']) > 1 ? ' (+' . (count($errs['9']) - 1) . ' more)' : '')) : '');
check('10. 協調型の集中度の文の分岐（両単体を上回るときだけ「さらに強く」）', count($errs['10']) === 0, $errs['10'] ? ($errs['10'][0] . (count($errs['10']) > 1 ? ' (+' . (count($errs['10']) - 1) . ' more)' : '')) : '');
check('11. 寄与しない血液型に「由来」「強く寄与」が無い（B型の誠実性）', count($errs['11']) === 0, $errs['11'] ? ($errs['11'][0] . (count($errs['11']) > 1 ? ' (+' . (count($errs['11']) - 1) . ' more)' : '')) : '');

// 12. 生成器の現在の出力と記事のバイト一致（一時ディレクトリへ生成。STGの記事は書き換えない）
$tmpOut = sys_get_temp_dir() . '/love-combo-invariants-' . getmypid();
exec(escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($root . '/tools/generate-combo-articles.php') . ' ' . escapeshellarg('--out=' . $tmpOut) . ' 2>&1', $genOut, $genCode);
$genDiff = [];
if ($genCode !== 0) $genDiff[] = 'generator failed: ' . implode(' ', $genOut);
foreach ($slugs as $slug) {
    if (in_array($slug, $skipped, true)) continue;
    $g = "$tmpOut/$slug/index.php";
    if (!file_exists($g) || !file_exists("$articlesDir/$slug/index.php") || file_get_contents($g) !== file_get_contents("$articlesDir/$slug/index.php")) $genDiff[] = $slug;
    if (file_exists($g)) { unlink($g); }
    if (is_dir("$tmpOut/$slug")) rmdir("$tmpOut/$slug");
}
if (is_dir($tmpOut)) @rmdir($tmpOut);
check('12. 生成器の対象' . (64 - count($skipped)) . '本（enfj-bを含む）が生成器の現在の出力とバイト一致', count($genDiff) === 0 && !in_array('enfj-b', $skipped, true), $genDiff ? (implode(',', array_slice($genDiff, 0, 8)) . (count($genDiff) > 8 ? ' (+' . (count($genDiff) - 8) . ' more)' : '')) : 'skip=' . implode(',', $skipped));

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
