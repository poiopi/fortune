#!/bin/bash
# tools/qa-combo-articles.sh
#
# MBTI×血液型 組み合わせ記事（articles/love/mbti-blood/）の生成後QAパイプライン。
# tools/generate-combo-articles.php の実行後に走らせる。
#
# チェック内容:
#   1. php -l 全64記事＋ハブ＋テンプレート
#   2. HTTP 200 全64記事（要: preview server on localhost:8811）
#   3. レンダリング出力にPHPエラー文字列が含まれないこと
#   4. prev/nextチェーン整合性（combo-data-64.jsonの順序と一致）
#   5. ハブ($_PUBLISHED)に64件全て掲載されていること
#
# 使い方: bash tools/qa-combo-articles.sh
# 終了コード: 0=全パス、1=いずれか失敗

set -u
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
BASE="$ROOT/test.life-fun.net/articles/love/mbti-blood"
DATA="$ROOT/docs/love/combo-data-64.json"
HOST="http://localhost:8811"
FAILURES=0

echo "=== 1. php -l ==="
lint_fail=0
for f in "$BASE"/*/index.php "$BASE"/index.php "$BASE"/_combo-tpl.php; do
  if ! php -l "$f" > /dev/null 2>&1; then
    echo "LINT FAIL: $f"
    php -l "$f"
    lint_fail=$((lint_fail+1))
  fi
done
echo "php -l failures: $lint_fail"
FAILURES=$((FAILURES+lint_fail))

echo "=== 2+3. HTTP 200 + error-string scan ==="
slugs=$(php -r '$d=json_decode(file_get_contents($argv[1]),true); foreach($d["combos"] as $c) echo $c["slug"]."\n";' "$DATA" | tr -d '\r')
http_fail=0
for slug in $slugs; do
  code=$(curl -s -o /tmp/qa_out.html -w "%{http_code}" "$HOST/articles/love/mbti-blood/$slug/" --max-time 20)
  errcount=$(grep -ci "fatal error\|parse error\|warning:" /tmp/qa_out.html)
  if [ "$code" != "200" ] || [ "$errcount" != "0" ]; then
    echo "HTTP FAIL: $slug HTTP=$code errstrings=$errcount"
    http_fail=$((http_fail+1))
  fi
done
echo "HTTP failures: $http_fail"
FAILURES=$((FAILURES+http_fail))

echo "=== 4. prev/next chain ==="
chain_out=$(php -r '
$d = json_decode(file_get_contents($argv[1]), true);
$base = $argv[2];
$slugs = array_column($d["combos"], "slug");
$errors = 0;
function extractField($content, $field) {
    if (preg_match("/\x27{$field}\x27\s*=>\s*\[.*?\x27url\x27\s*=>\s*\x27([^\x27]*)\x27/s", $content, $m)) {
        return basename(rtrim($m[1], "/"));
    }
    return null;
}
foreach ($slugs as $i => $slug) {
    $file = "$base/$slug/index.php";
    if (!file_exists($file)) { echo "MISSING: $slug\n"; $errors++; continue; }
    $content = file_get_contents($file);
    $expectedPrev = $i > 0 ? $slugs[$i - 1] : null;
    $expectedNext = $i < count($slugs) - 1 ? $slugs[$i + 1] : null;
    $actualPrev = extractField($content, "prev");
    $actualNext = extractField($content, "next");
    if ($actualPrev !== $expectedPrev) { echo "$slug: prev expected=$expectedPrev actual=$actualPrev\n"; $errors++; }
    if ($actualNext !== $expectedNext) { echo "$slug: next expected=$expectedNext actual=$actualNext\n"; $errors++; }
}
echo "chain errors: $errors\n";
exit($errors > 0 ? 1 : 0);
' "$DATA" "$BASE")
echo "$chain_out"
if echo "$chain_out" | grep -qv "chain errors: 0"; then
  if ! echo "$chain_out" | grep -q "chain errors: 0"; then
    FAILURES=$((FAILURES+1))
  fi
fi

echo "=== 5. hub inclusion ==="
hub_fail=0
for slug in $slugs; do
  if ! grep -q "'slug'=>'$slug'" "$BASE/index.php"; then
    echo "HUB MISSING: $slug"
    hub_fail=$((hub_fail+1))
  fi
done
hub_count=$(grep -c "'slug'=>" "$BASE/index.php")
echo "hub entries: $hub_count, missing: $hub_fail"
if [ "$hub_count" != "64" ]; then hub_fail=$((hub_fail+1)); fi
FAILURES=$((FAILURES+hub_fail))

echo ""
echo "=== RESULT: total failures: $FAILURES ==="
exit $([ "$FAILURES" -eq 0 ] && echo 0 || echo 1)
