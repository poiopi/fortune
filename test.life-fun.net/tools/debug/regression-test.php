<?php
/**
 * AutoLink v2 回帰テスト
 *
 * 実行方法（ローカルPHPが必要。C:\php にインストール済み）：
 *   C:\php\php.exe tools/debug/regression-test.php
 *
 * auto-link.php を変更したら、STG/本番へ反映する前に必ずこれを実行し、
 * 全項目がPASSすることを確認してから反映すること。
 *
 * 設計思想・確認手順の詳細は同ディレクトリの README.md を参照。
 */

declare(strict_types=1);

$root = dirname(__DIR__, 2); // test.life-fun.net/
require_once $root . '/inc/auto-link.php';

$results = []; // ['name'=>..., 'pass'=>bool, 'detail'=>string[]]

function test(string $name, callable $fn): void {
    global $results;
    $detail = [];
    $passed = $fn($detail);
    $results[] = ['name' => $name, 'pass' => $passed, 'detail' => $detail];
    echo ($passed ? '[PASS] ' : '[FAIL] ') . $name . "\n";
    foreach ($detail as $d) {
        echo '       - ' . $d . "\n";
    }
}

function normPath(string $p): string { return str_replace('\\', '/', $p); }

echo "==================================================\n";
echo "AutoLink v2 回帰テスト\n";
echo "==================================================\n\n";

global $_autoLinkMap;

// ------------------------------------------------------------
test('no_single_char_keywords（1文字キーワード禁止）', function (array &$detail): bool {
    global $_autoLinkMap;
    $ok = true;
    foreach ($_autoLinkMap as $kw => $v) {
        if (mb_strlen($kw) === 1) {
            $detail[] = "1文字キーワードが見つかりました: '{$kw}'";
            $ok = false;
        }
    }
    return $ok;
});

// ------------------------------------------------------------
test('slug_match（currentSlugとマップ側slugの整合性）', function (array &$detail) use ($root): bool {
    global $_autoLinkMap;
    $calledSlugs = []; // 正規化した絶対パス => currentSlug文字列 or '(dynamic)' or '(delegated:...)'
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/articles'));
    foreach ($rii as $file) {
        if ($file->getExtension() !== 'php') continue;
        $content = file_get_contents($file->getPathname());
        $key = normPath($file->getPathname());
        if (preg_match('/autoLink\(\s*\$html\s*,\s*\'([^\']*)\'\s*\)/', $content, $m)) {
            $calledSlugs[$key] = $m[1];
        } elseif (preg_match('/autoLink\(\$html,\s*\$\w+\[\'slug\'\]\)/', $content)) {
            $calledSlugs[$key] = '(dynamic)';
        } elseif (preg_match('/require\s+__DIR__\s*\.\s*\'\/\.\.\/(_[a-zA-Z-]+-tpl\.php)\'/', $content, $tm)) {
            // 個別データを定義し共通テンプレート(_xxx-tpl.php)へ委譲するページ
            // (mbti/_type-tpl.php, seiza/_sign-tpl.php等)。テンプレート側が
            // 動的slugを使っていることは別途手動で確認済みとして信頼する。
            $calledSlugs[$key] = '(delegated:' . $tm[1] . ')';
        }
    }

    $ok = true;
    foreach ($_autoLinkMap as $kw => [$url, $slug]) {
        $expectedFile = normPath($root) . rtrim($url, '/') . '/index.php';
        if (!file_exists($expectedFile)) continue; // 記事ファイル以外のURLはスキップ
        if (!isset($calledSlugs[$expectedFile])) {
            $detail[] = "「{$kw}」の対象ファイルに autoLink() 呼び出しが見つからない: {$expectedFile}";
            $ok = false;
            continue;
        }
        $actual = $calledSlugs[$expectedFile];
        if ($actual === '(dynamic)') continue;
        if (str_starts_with($actual, '(delegated:')) continue;
        if ($actual !== $slug) {
            $detail[] = "「{$kw}」: マップ側slug='{$slug}' / 実際の呼び出しslug='{$actual}'（不一致）: {$expectedFile}";
            $ok = false;
        }
    }
    return $ok;
});

// ------------------------------------------------------------
$selfLinkSamples = [
    ['keyword' => '甲（きのえ）', 'slug' => 'kinoe'],
    ['keyword' => '愚者',         'slug' => 'fool'],
    ['keyword' => 'INTJ',         'slug' => 'intj'],
    ['keyword' => '大地の精霊',   'slug' => 'daichi'],
    ['keyword' => '貫索星',       'slug' => 'kansaku'],
    ['keyword' => '一白水星',     'slug' => 'ippaku'],
    ['keyword' => '運命数33',     'slug' => 'numerology-33'],
    ['keyword' => '先勝',         'slug' => 'senshou'],
    ['keyword' => '六曜',         'slug' => 'rokuyo'],
    ['keyword' => '陰陽五行',     'slug' => 'gogyo'],
    ['keyword' => '特別な吉日',   'slug' => 'kichijitsu'],
];
foreach ($selfLinkSamples as $s) {
    test("self_link_exclusion（{$s['keyword']}）", function (array &$detail) use ($s): bool {
        $testHtml = '<p>これは' . $s['keyword'] . 'のテストです。</p>';
        $result = autoLink($testHtml, $s['slug']);
        if (str_contains($result, '<a ')) {
            $detail[] = "自己リンクを生成: {$result}";
            return false;
        }
        return true;
    });
}

// ------------------------------------------------------------
$digitTests = [
    ['html' => '<p>運命数33は特別です。</p>', 'bad' => '運命数<a href="/articles/numerology/3/"'],
    ['html' => '<p>運命数22は特別です。</p>', 'bad' => '運命数<a href="/articles/numerology/2/"'],
    ['html' => '<p>運命数11は特別です。</p>', 'bad' => '運命数<a href="/articles/numerology/1/"'],
];
foreach ($digitTests as $t) {
    test('digit_collision（' . strip_tags($t['html']) . '）', function (array &$detail) use ($t): bool {
        $result = autoLink($t['html'], '__none__');
        if (str_contains($result, $t['bad'])) {
            $detail[] = "桁衝突を検出: {$result}";
            return false;
        }
        return true;
    });
}

// ------------------------------------------------------------
test('banned_words（過去に誤爆した語・単一漢字の再登録防止）', function (array &$detail): bool {
    global $_autoLinkMap;
    $bannedWords = [
        '木','火','土','金','水','月','星','力','塔',
        '甲','乙','丙','丁','戊','己','庚','辛','壬','癸',
        '世界','正義','恋人','戦車','吉日',
    ];
    $ok = true;
    foreach ($bannedWords as $w) {
        if (isset($_autoLinkMap[$w])) {
            $detail[] = "禁止リストの単語「{$w}」が登録されています";
            $ok = false;
        }
    }
    return $ok;
});

// ------------------------------------------------------------
// 助詞バリエーション：運命数11／が11／は11／の11 が全て正しくリンクされ、
// かつ数字が続く別のキーワードに壊されないこと
test('particle_variations（運命数の助詞バリエーション）', function (array &$detail): bool {
    $cases = [
        '運命数11は特別です。' => '/articles/numerology/11/',
        '運命数が11の人は。'   => '/articles/numerology/11/',
        '運命数は11でした。'   => '/articles/numerology/11/',
        '運命数の11を持つ人。' => '/articles/numerology/11/',
    ];
    $ok = true;
    foreach ($cases as $text => $expectedUrl) {
        $result = autoLink("<p>{$text}</p>", '__none__');
        if (!str_contains($result, 'href="' . $expectedUrl . '"')) {
            $detail[] = "「{$text}」が {$expectedUrl} へリンクされなかった: {$result}";
            $ok = false;
        }
    }
    return $ok;
});

// ------------------------------------------------------------
// HTML構造保護：<p>の中にある他タグ（img属性等）の中身は書き換えない
test('html_structure_protection（属性値の中は書き換えない）', function (array &$detail): bool {
    // alt属性の中に偶然キーワードと同じ文字列がある場合、属性値の中に<a>を
    // 挿入して壊してしまわないか
    $html = '<p><img src="x.png" alt="愚者の絵"> 愚者について解説します。</p>';
    $result = autoLink($html, '__none__');
    $ok = true;
    if (preg_match('/alt="[^"]*<a[^"]*"/', $result)) {
        $detail[] = "alt属性の中に<a>タグが挿入され、属性値が破壊された: {$result}";
        $ok = false;
    }
    return $ok;
});

// ------------------------------------------------------------
// 既存リンク保護：<a href="...">の中はリンク化しない
test('existing_link_protection（既存の<a>タグの中は再リンクしない）', function (array &$detail): bool {
    $html = '<p>詳しくは<a href="/other/">愚者について</a>のページへ。</p>';
    $result = autoLink($html, '__none__');
    // 既存の<a>の中に、さらに<a>がネストして挿入されていないか
    if (preg_match('/<a[^>]*>[^<]*<a[^>]*>/', $result)) {
        return false;
    }
    return true;
});

// ------------------------------------------------------------
// 参考情報（PASS/FAIL判定はしない）：意味が曖昧なキーワードの新規混入検出
// ------------------------------------------------------------
echo "\n[参考] 登録済みキーワードが対象カテゴリ以外の<p>タグ内で使われていないか（要目視確認）\n";
$allText = [];
$rii2 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/articles'));
foreach ($rii2 as $file) {
    if ($file->getExtension() !== 'php') continue;
    $allText[$file->getPathname()] = file_get_contents($file->getPathname());
}
$suspicious = 0;
foreach ($_autoLinkMap as $kw => [$url, $slug]) {
    if (mb_strlen($kw) < 2) continue;
    foreach ($allText as $path => $content) {
        if (str_contains($path, DIRECTORY_SEPARATOR . $slug . DIRECTORY_SEPARATOR)) continue;
        if (str_contains($path, 'auto-link.php')) continue;
        if (preg_match('/<p[^>]*>[^<]*' . preg_quote($kw, '/') . '/u', $content)) {
            $suspicious++;
            if ($suspicious <= 20) {
                echo "  [要確認] 「{$kw}」が " . str_replace($root . DIRECTORY_SEPARATOR, '', $path) . " の<p>タグ内に出現\n";
            }
        }
    }
}
if ($suspicious === 0) {
    echo "  [OK] 対象外ページでの出現は見つかりませんでした\n";
} else {
    echo "  → 上記 {$suspicious} 件は自動判定できません。文脈を読んで意味が一致しているか目視確認してください。\n";
}

// ------------------------------------------------------------
$pass = count(array_filter($results, fn($r) => $r['pass']));
$total = count($results);
$fail = $total - $pass;

echo "\n==================================================\n";
echo "結果: PASS={$pass} / FAIL={$fail} / 総テスト数={$total}\n";
echo $fail === 0 ? "全項目PASS。反映して問題ありません。\n" : "FAILが{$fail}件あります。反映前に修正してください。\n";
echo "==================================================\n";

exit($fail === 0 ? 0 : 1);
