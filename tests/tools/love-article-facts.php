<?php
declare(strict_types=1);

/**
 * tests/tools/love-article-facts.php
 *
 * 恋愛記事（articles/love/ 配下）に書かれた数値・比較の主張を、
 * Golden Master（tests/cases/love-final-snapshot.php、9216件）から
 * 独立に再計算した値と照合する「記事の事実照合テスト」。
 *
 * 独立性のため、期待値は docs/love/combo-data-64.json や記事内の数値を正解として使わず、
 * スナップショットの各ケース（入力・Primitive・Style/Tendencyの区分・Bundle ID・文章ID）から
 * その都度集計する。inc/ のマッピング定数（Trait・Axis・Style/Tendency式・星座データ）は
 * 「どの入力がどのPrimitiveへ加算されるか」という構造の確認にだけ読み込む（スナップショット生成元と同じ test.life-fun.net/inc/ を読み取り専用で）。
 * --root で別のツリー（本番用ツリー等）を照合するときも、構造はスナップショットに合わせて常にリポジトリの test.life-fun.net/inc/ を使う。
 *
 * 照合対象は次の3つの宣言的な表で持つ。
 *   1. $RULES  : カテゴリ（mbti/seiza/blood/style/tendency/bundle/mbti-blood）ごとの照合規則。
 *                各規則は「記事のどこを（フィールド・正規表現）」「何と比べるか（スナップショットからの算出）」を持つ。
 *   2. $CLAIMS : 個別記事の文の主張（正規表現＋算出クロージャ）。
 *                - required=true : 修正後の正しい主張。本文に見つからなければ FAIL（MISSING）。
 *                - required=false: 誤りを見分ける意味的な検査。本文に該当する文があれば算出値と比べ、
 *                                  成り立たなければ FAIL（旧文が残っている／再発した場合に検出）。
 *   3. $WEIGHT_CLAIMS : 指標とプリミティブの重み関係の言い回し（「Pへの依存度が高い」「主に Pで決まる」「P・Qで決まる」等）。
 *                全記事を文単位で走査し、式の係数（inc/love-style.php・inc/love-tendency.php）と照合する（5b 節）。
 *   （5c 節）「同じ数値になる理由」：血液型・MBTI・星座の記事で「(P)が主軸のため、(比較相手)と同じ数値」「計算式に(P)を含まないため、〜と同じ数値」を
 *                文単位で拾い、比較相手と寄与が異なる Primitive が式に含まれないか（inc のマッピング）と分布の一致（スナップショット）で判定する。
 *   （5d 節）「主軸を理由にした文」：「(P)が主軸(のため|の指標です|である一方)」の後の結論（高い・低い・近い・同じ数値）が、式の各項の寄与差
 *                （重み × スナップショットの Primitive 平均の差）で説明できるかを判定する。説明できない（要判断）文は、
 *                $CLAIMS に 'mainReason' => true の個別の主張を登録して照合する（判定基準は 5d 節のコメント）。
 *   （5e 節）「程度の語と理由の主従」（2026-10-07）：全記事・全フィールドの比較の文（全体平均・血液型・星座・MBTIタイプとの比較、4血液型の最上級）について、
 *                程度の語（大きく／修飾なし／やや／わずかに／ほぼ同水準／近い水準）・向き・書かれた数値と、理由に挙げた項の主従（寄与差の分解）を照合する。
 *                基準は 5e 節のコメントと docs/love/09-writing-rules.md「記事の数値の程度の語」。以前の checkOverallAvg・5 節の (20)・(27) は 5e に統合した。
 *   （5f 節）「照合できない」一覧の判断（2026-10-07）：5e が出す「照合できない程度の語」「照合できない理由」の各件に、事実を手作業で確かめた
 *                結果と照合できない理由（$UNVERIFIABLE）を対応づけて表示する。対応の無い件は「未判断」と表示し、件数を末尾に出す。
 *                2026-10-07（Reviewer MJ-4）：未判断が1件でもあれば FAIL（kind UNJUDGED）。程度の語の登録は 'hit'（拾った語）が必須で、1つの登録は一覧の1件だけに対応する。
 *
 * 新しい数値主張を記事に足したら、$RULES で拾えない文は $CLAIMS に1行追加すること
 * （DEVELOPMENT_RULES.md「記事の事実検証ルール」）。
 *
 * 実行方法:
 *   php tests/tools/love-article-facts.php                         （既定: test.life-fun.net）
 *   php tests/tools/love-article-facts.php --root=<test.life-fun.net に相当するサイトのルート>     （本番用ツリー）
 *   php tests/tools/love-article-facts.php --root=<コピー> --verbose        （PASSも表示）
 * 終了コード: 0=ALL PASS / 1=FAIL あり
 *
 * 照合できない主張の種類（網羅できていない範囲）は実行結果の末尾と tests/README.md に記載。
 */

ini_set('memory_limit', '2G');
$repo = realpath(__DIR__ . '/../..');
$opts = getopt('', ['root:', 'verbose']);
$root = rtrim(str_replace('\\', '/', $opts['root'] ?? ($repo . '/test.life-fun.net')), '/');
$verbose = isset($opts['verbose']);
$artDir = $root . '/articles/love';
if (!is_dir($artDir)) { fwrite(STDERR, "articles/love not found under $root\n"); exit(2); }

foreach (['trait-vocabulary', 'axis-vocabulary', 'mbti-trait-mapping', 'blood-trait-mapping', 'seiza-trait-mapping',
          'axis-mapping', 'love-primitive-mapping', 'love-style', 'love-tendency', 'seiza-data'] as $f) {
    require_once $repo . '/test.life-fun.net/inc/' . $f . '.php';
}

// ======================================================================
// 0. 定数・スナップショット
// ======================================================================
const P_CODE = ['行動主導性' => 'ACT', '誠実性' => 'REL', '情動性' => 'SEN', '自立性' => 'AUT', '変化志向' => 'TRA'];
const P_PRIO = ['ACT' => 0, 'REL' => 1, 'SEN' => 2, 'AUT' => 3, 'TRA' => 4];
const TYPES = ['ENTP','INTP','ENTJ','INTJ','ENFP','INFP','ENFJ','INFJ','ESTP','ISTP','ESTJ','ISTJ','ESFP','ISFP','ESFJ','ISFJ'];
const BLOODS = ['A', 'B', 'O', 'AB'];
$P_NAME = array_flip(P_CODE);
$METRICS = array_merge(array_keys(LOVE_STYLE_MAPPING), array_keys(LOVE_TENDENCY_MAPPING));
$MET_RE = '(?:' . implode('|', $METRICS) . ')';
$PRIM_RE = '(?:' . implode('|', array_keys(P_CODE)) . ')';
$TYPE_RE = '[EI][NS][TF][JP]';
$SIGN_NAMES = array_column(SEIZA_SIGNS, 'name');
$SIGN_RE = '(?:' . implode('|', $SIGN_NAMES) . ')';

$snap = require $repo . '/tests/cases/love-final-snapshot.php';
$CASES = [];
foreach ($snap['cases'] as $c) {
    [, $p1, $p2] = explode('_', $c['expected']['bundleId']);
    $CASES[] = [
        'm' => $c['input']['mbti'], 'b' => $c['input']['blood'], 's' => $c['input']['seizaSign'], 't' => $c['input']['seizaInnerType'],
        'p' => $c['expected']['primitives'],
        'lv' => $c['expected']['stylesNormalized'] + $c['expected']['tendenciesNormalized'],
        'bid' => $c['expected']['bundleId'], 'tid' => $c['expected']['bundleTextId'], 'p1' => $p1, 'p2' => $p2,
    ];
}
$SNAP_AT = $snap['generatedAt'];
unset($snap);
$N_ALL = count($CASES);

// ======================================================================
// 1. 集計ヘルパー（すべてスナップショットから）
// ======================================================================
/** 条件（m/b/s/t/p1/p2 の完全一致、または 'fn'）で絞ったケース集合（メモ化） */
function sub(array $f = []): array {
    static $memo = [];
    ksort($f);
    $key = json_encode($f, JSON_UNESCAPED_UNICODE);
    if (!isset($memo[$key])) {
        $memo[$key] = array_values(array_filter($GLOBALS['CASES'], function ($c) use ($f) {
            foreach ($f as $k => $v) {
                if (is_array($v)) { if (!in_array($c[$k], $v, true)) return false; }
                elseif ($c[$k] !== $v) return false;
            }
            return true;
        }));
    }
    return $memo[$key];
}
function pct(int $a, int $n): float { return $n ? $a * 100 / $n : 0.0; }
/** High/Mid/Low の割合（未丸め）と件数 */
function lvDist(array $cs, string $metric): array {
    $h = ['High' => 0, 'Mid' => 0, 'Low' => 0];
    foreach ($cs as $c) $h[$c['lv'][$metric]]++;
    $n = count($cs);
    return ['High' => pct($h['High'], $n), 'Mid' => pct($h['Mid'], $n), 'Low' => pct($h['Low'], $n), 'raw' => $h, 'n' => $n];
}
function high(array $f, string $metric): float { return lvDist(sub($f), $metric)['High']; }
/** 最頻の区分（同数なら複数） */
function modal(array $d): array { $mx = max($d['raw']); return array_keys(array_filter($d['raw'], fn($v) => $v === $mx)); }
/** 件数降順・同数は PRIMITIVE_PRIORITY_ORDER（ACT>REL>SEN>AUT>TRA） */
function countBy(array $cs, string $key): array {
    $cnt = [];
    foreach ($cs as $c) $cnt[$c[$key]] = ($cnt[$c[$key]] ?? 0) + 1;
    uksort($cnt, function ($a, $b) use ($cnt) {
        return ($cnt[$b] <=> $cnt[$a]) ?: ((P_PRIO[$a] ?? 9) <=> (P_PRIO[$b] ?? 9)) ?: strcmp((string)$a, (string)$b);
    });
    return $cnt;
}
function near($written, float $actual, float $tol = 0.05): bool { return is_numeric($written) && abs((float)$written - $actual) <= $tol + 1e-9; }
function r1(float $v): string { return (string)round($v, 1); }
function fmtD(array $d): string { return sprintf('H%s/M%s/L%s', r1($d['High']), r1($d['Mid']), r1($d['Low'])); }
function primOfTrait(string $trait): string {
    $axis = AXIS_MAPPING[$trait][0]['axis'];
    foreach (PRIMITIVE_AXIS_MAP as $p => $a) if ($a === $axis) return $p;
    throw new RuntimeException($trait);
}
/** あるPrimitiveへ加算される入力（経路）の一覧。構造の確認用（inc/のマッピングから） */
function sourcesOf(string $primJa): array {
    $out = [];
    foreach (MBTI_TRAIT_MAPPING as $letter => $rules) foreach ($rules as $r) if (primOfTrait($r['trait']) === $primJa) $out[] = ['kind' => 'mbti', 'key' => $letter, 'kw' => $r['keyword'], 'score' => $r['score']];
    foreach (BLOOD_TRAIT_MAPPING as $bt => $rules) foreach ($rules as $r) if (primOfTrait($r['trait']) === $primJa) $out[] = ['kind' => 'blood', 'key' => $bt, 'kw' => $r['keyword'], 'score' => $r['score']];
    foreach (SEIZA_TRAIT_MAPPING['element'] as $i => $rules) foreach ($rules as $r) if (primOfTrait($r['trait']) === $primJa) $out[] = ['kind' => 'element', 'key' => SEIZA_ELEMENTS[$i]['name'], 'kw' => $r['keyword'], 'score' => $r['score']];
    foreach (SEIZA_TRAIT_MAPPING['quality'] as $i => $rules) foreach ($rules as $r) if (primOfTrait($r['trait']) === $primJa) $out[] = ['kind' => 'quality', 'key' => SEIZA_QUALITIES[$i]['name'], 'kw' => $r['keyword'], 'score' => $r['score']];
    foreach (SEIZA_TRAIT_MAPPING['innerType'] as $i => $rules) foreach ($rules as $r) if (primOfTrait($r['trait']) === $primJa) $out[] = ['kind' => 'innerType', 'key' => SEIZA_INNER_TYPES[$i]['name'], 'kw' => $r['keyword'], 'score' => $r['score']];
    return $out;
}
function traitsOf(string $primJa): array {
    $t = [];
    foreach (AXIS_MAPPING as $trait => $m) if (primOfTrait($trait) === $primJa) $t[] = $trait;
    return $t;
}
/** MBTIの文字が寄与するPrimitive */
function letterPrims(string $letter): array { return array_values(array_unique(array_map(fn($r) => primOfTrait($r['trait']), MBTI_TRAIT_MAPPING[$letter]))); }
function typeContribLetters(string $type, string $primJa): array { return array_values(array_filter(str_split($type), fn($l) => in_array($primJa, letterPrims($l), true))); }
function signIndex(string $name): int { return array_search($name, array_column(SEIZA_SIGNS, 'name'), true); }
/** 式（Style/Tendency）の Primitive => 重み */
function formulaOf(string $metric): array {
    $f = LOVE_STYLE_MAPPING[$metric] ?? LOVE_TENDENCY_MAPPING[$metric];
    $o = []; foreach ($f as $t) $o[$t['primitive']] = $t['weight'];
    return $o;
}
/** MBTI単体／血液型単体／組み合わせの主軸と、組み合わせ記事の分類・順位（tools/build-combo-data.phpとは独立に実装） */
function comboInfo(string $m, string $b): array {
    static $memo = [];
    if (isset($memo["$m-$b"])) return $memo["$m-$b"];
    $dom = function (array $cs): array { $cnt = countBy($cs, 'p1'); $k = array_key_first($cnt); return [$k, round(pct($cnt[$k], count($cs)), 1), $cnt]; };
    [$mP, $mR] = $dom(sub(['m' => $m]));
    [$bP, $bR] = $dom(sub(['b' => $b]));
    $cs = sub(['m' => $m, 'b' => $b]);
    [$cP, $cR, $pc] = $dom($cs);
    $class = ($cP === $mP && $cP === $bP) ? '協調型' : ($cP === $bP ? '拮抗型（血液型優勢）' : ($cP === $mP ? '拮抗型（MBTI優勢）' : '転換型'));
    $pmCases = sub(['m' => $m, 'b' => $b, 'p1' => $cP]);
    $sec = countBy($pmCases, 'p2');
    $yield = $class === '拮抗型（MBTI優勢）' ? $bP : ($class === '拮抗型（血液型優勢）' ? $mP : null);
    // 64通りの順位（集中度降順→MBTIキー昇順→血液型キー昇順。12-combo-classification.md 2-2節）と5段階
    static $all = null;
    if ($all === null) {
        $all = [];
        foreach (TYPES as $tm) foreach (BLOODS as $tb) { [, $r] = $dom(sub(['m' => $tm, 'b' => $tb])); $all[] = ['k' => "$tm-$tb", 'm' => $tm, 'b' => $tb, 'r' => $r]; }
        usort($all, fn($x, $y) => ($y['r'] <=> $x['r']) ?: strcmp($x['m'], $y['m']) ?: strcmp($x['b'], $y['b']));
    }
    $rank = 1 + array_search("$m-$b", array_column($all, 'k'), true);
    $asc = array_column($all, 'r'); sort($asc);
    [$p20, $p40, $p60, $p80] = [$asc[(int)round(0.2 * 63)], $asc[(int)round(0.4 * 63)], $asc[(int)round(0.6 * 63)], $asc[(int)round(0.8 * 63)]];
    $level = $cR > $p80 ? '集中しやすい' : ($cR > $p60 ? 'やや集中しやすい' : ($cR > $p40 ? '平均的' : ($cR > $p20 ? '分散しやすい' : '非常に分散しやすい')));
    return $memo["$m-$b"] = ['n' => count($cs), 'mP' => $mP, 'mR' => $mR, 'bP' => $bP, 'bR' => $bR, 'cP' => $cP, 'cR' => $cR, 'class' => $class,
        'pm' => count($pmCases), 'sec' => $sec, 'yield' => $yield, 'rank' => $rank, 'pctile' => round($rank / 64 * 100, 1), 'level' => $level];
}

// ======================================================================
// 2. 記事の読み込み・判定の記録
// ======================================================================
function loadArticle(string $file): ?array {
    $src = file_get_contents($file);
    $src = preg_replace('/^<\?php\s*/', '', $src);
    $src = preg_replace("/require __DIR__ \\. '\\/\\.\\.\\/_[a-z-]+-tpl\\.php';\\s*$/", '', $src);
    $item = null; $type = null;
    eval($src);
    return $item ?? $type;
}
/** 配列中の文字列を [パス => 文字列] で列挙（HTMLはタグを除去） */
function leaves(array $a, string $prefix = ''): array {
    $o = [];
    foreach ($a as $k => $v) {
        $p = $prefix === '' ? (string)$k : "$prefix.$k";
        if (is_array($v)) $o += leaves($v, $p);
        elseif (is_string($v)) $o[$p] = html_entity_decode(strip_tags($v), ENT_QUOTES, 'UTF-8');
    }
    return $o;
}
function sentences(string $s): array { return array_values(array_filter(array_map('trim', preg_split('/(?<=。)|\n/u', $s)), fn($x) => $x !== '')); }

$RESULTS = []; $FAILS = []; $ARTICLES_CHECKED = [];
/**
 * KNOWN：今回の修正範囲外で見つかった同種の誤り。FAILとして数えず、要判断として表示する。
 * 'text' は登録時点の該当フィールドの全文（判定に渡される文字列そのもの）。これと完全一致するときだけ KNOWN を適用し、
 * 1文字でも変わったら通常どおり FAIL（または規則で再判定）になる。
 */
$KNOWN = [];  // 2026-10-06：2026-10-01に登録した4件（blood/ab-love×2・mbti/enfj・mbti/isfp）は記事を修正して解消（5節に修正後の主張と旧文の検査を登録）
function chk(string $art, string $rule, bool $ok, string $detail, string $kind = 'FACT', ?string $text = null): void {
    global $RESULTS, $FAILS, $KNOWN, $ARTICLES_CHECKED;
    $ARTICLES_CHECKED[$art] = true;
    $k = $KNOWN["$art|$rule"] ?? null;
    $status = $ok ? 'PASS' : (($k !== null && $text !== null && $text === $k['text']) ? 'KNOWN' : 'FAIL');
    $RESULTS[] = [$status, $art, $rule, $detail, $kind];
    if ($status === 'FAIL') $FAILS[] = end($RESULTS);
}

// ======================================================================
// 3. 共通の文パターン（カテゴリをまたいで使う）
// ======================================================================
/** Style/Tendency の H/M/L 配列（high/mid/low）をスナップショットの分布と照合 */
function checkDistArray(string $art, string $where, array $arr, array $f, string $metric): void {
    $d = lvDist(sub($f), $metric);
    $ok = near($arr['high'] ?? null, $d['High']) && near($arr['mid'] ?? null, $d['Mid']) && near($arr['low'] ?? null, $d['Low']);
    chk($art, "dist:$where", $ok, "$metric 記事=H{$arr['high']}/M{$arr['mid']}/L{$arr['low']} 実測=" . fmtD($d));
}
/** topBundle（最多のBundle） */
function checkTopBundle(string $art, array $tb, array $f): void {
    $cs = sub($f); $cnt = countBy($cs, 'bid'); $mx = reset($cnt);
    $id = 'LOVE_' . P_CODE[$tb['primary']] . '_' . P_CODE[$tb['secondary']];
    $ok = ($cnt[$id] ?? 0) === $mx && near($tb['pct'], pct($mx, count($cs)));
    chk($art, 'topBundle', $ok, "記事={$id} {$tb['pct']}% 実測最多=" . array_key_first($cnt) . ' ' . r1(pct($mx, count($cs))) . '%');
}
// 「全体平均（X%）を上回る／より低め」等（全体平均の値・向き・程度の語）は 5e 節で全記事・全フィールドをまとめて照合する。
// 2026-10-07：以前の checkOverallAvg（星座・血液型の注記、値と向き）・checkOverallAvgFree（FAQ・まとめ）と 5 節の (20)（星座の注記の程度の語）を 5e に統合した
// （checkOverallAvg の「より」の分岐に「わずかに」が無かった漏れも、5e の共通の正規表現で解消）。
/** 「(PRIM)への寄与」と書いた Primitive が、その指標の式に含まれるか（注記の理由づけの取り違え検出） */
function checkNoteMentionsFormula(string $art, string $where, string $note, string $metric): void {
    global $PRIM_RE;
    if (!preg_match_all("/((?:$PRIM_RE)(?:・(?:$PRIM_RE))*)(?:へ|への|に)(?:の)?寄与/u", $note, $mm)) return;
    $f = formulaOf($metric);
    $ps = []; foreach ($mm[1] as $list) foreach (explode('・', $list) as $p) $ps[$p] = true;
    foreach (array_keys($ps) as $p) chk($art, "noteFormula:$where", isset($f[$p]), "$metric の注記が「{$p}への寄与」を理由にしている（式: " . implode('・', array_keys($f)) . '）', 'SEM', $note);
}
/** 本文中の「(指標)（High x%）」「「指標」がHigh x%」= その記事の対象（$f）の値 */
function checkMetricParen(string $art, string $where, string $text, array $f): void {
    global $MET_RE;
    if (preg_match_all("/($MET_RE)（(High|Mid|Low)([\d.]+)%/u", $text, $mm, PREG_SET_ORDER)) {
        foreach ($mm as $m) { $d = lvDist(sub($f), $m[1]); chk($art, "metricParen:$where", near($m[3], $d[$m[2]]), "{$m[0]} 実測={$m[2]}" . r1($d[$m[2]])); }
    }
    if (preg_match_all("/「($MET_RE)」が(High|Mid|Low)([\d.]+)%(?:・(High|Mid|Low)([\d.]+)%)?/u", $text, $mm, PREG_SET_ORDER)) {
        foreach ($mm as $m) {
            $d = lvDist(sub($f), $m[1]);
            $ok = near($m[3], $d[$m[2]]) && (empty($m[4]) || near($m[5], $d[$m[4]]));
            chk($art, "metricQuote:$where", $ok, "{$m[0]} 実測=" . fmtD($d));
        }
    }
}
/** 「(主語の集合)と(完全に|全く)同じ(分布|数値|値)」（$key: 'm' or 's'） */
function checkSameAs(string $art, string $where, string $text, string $metric, array $self, string $key, string $listRe): void {
    if (!preg_match_all("/((?:$listRe)(?:・(?:$listRe))*)と(?:完全に|全く)同じ(?:分布|数値|値)/u", $text, $mm)) return;
    $mine = lvDist(sub($self), $metric)['raw'];
    foreach ($mm[1] as $list) foreach (explode('・', $list) as $o) {
        $oth = $key === 's' ? signIndex($o) : $o;
        $their = lvDist(sub([$key => $oth]), $metric)['raw'];
        chk($art, "sameAs:$where", $mine === $their, "$metric が {$o} と同じ と記載 自=" . json_encode($mine) . " 相手=" . json_encode($their));
    }
}

// ======================================================================
// 4. カテゴリ別の照合規則（宣言的な表）
//    'scope' => 記事ディレクトリのglob, 'desc' => 照合内容, 'fn' => 記事ごとの照合
// ======================================================================
$RULES = [];

// ---- 4-1. MBTI記事（mbti/*：MBTIタイプ単体576件） ----
$RULES[] = ['scope' => 'mbti/*', 'desc' => 'Style/Tendency分布・topBundle・注記の比較/最上級/同率/同一分布/最頻区分・本文の指標値', 'fn' => function (string $art, array $a) {
    global $TYPE_RE, $MET_RE, $PRIM_RE;
    $T = strtoupper($a['code']); $f = ['m' => $T];
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) {
        checkDistArray($art, "$g.$metric", $arr, $f, $metric);
        $note = $arr['note'] ?? ''; if ($note === '') continue;
        $d = lvDist(sub($f), $metric);
        checkNoteMentionsFormula($art, "$g.$metric", $note, $metric);
        checkSameAs($art, "$g.$metric", $note, $metric, $f, 'm', $TYPE_RE);
        // 「◯◯（High x%）」「◯◯の x%」「◯◯はLow x%」＝他タイプの同じ指標
        $rest = $note;
        if (preg_match_all("/($TYPE_RE)(?:（(High|Mid|Low)?\s*([\d.]+)%|の([\d.]+)%|は(High|Mid|Low)([\d.]+)%)/u", $note, $mm, PREG_SET_ORDER)) {
            foreach ($mm as $m) {
                [$lv, $v] = isset($m[6]) && $m[6] !== '' ? [$m[5], $m[6]] : (isset($m[4]) && $m[4] !== '' ? ['High', $m[4]] : [($m[2] ?: 'High'), $m[3]]);
                $od = lvDist(sub(['m' => $m[1]]), $metric);
                chk($art, "typeRef:$g.$metric", near($v, $od[$lv]), "{$m[0]} 実測 {$m[1]} $lv=" . r1($od[$lv]));
                $rest = str_replace($m[0], '', $rest);
            }
        }
        // 自身の値（他タイプ名を含まない文の「High x%」）
        foreach (sentences($rest) as $s) {
            if (preg_match("/$TYPE_RE/u", $s)) continue;
            if (preg_match_all('/(High|Mid|Low)(?:は|が)?([\d.]+)%/u', $s, $mm, PREG_SET_ORDER)) {
                foreach ($mm as $m) chk($art, "selfValue:$g.$metric", near($m[2], $d[$m[1]]), "{$m[0]} 実測=" . fmtD($d));
            }
        }
        // 最頻区分の主張
        $mod = modal($d);
        $modalClaims = [];
        if (preg_match_all('/(High|Mid|Low)が(?:優勢|最多|中心|多数)/u', $note, $mm)) foreach ($mm[1] as $x) $modalClaims[] = [$x, $x . 'が優勢等'];
        if (preg_match_all('/最も多いのは(High|Mid|Low)の([\d.]+)%/u', $note, $mm, PREG_SET_ORDER)) foreach ($mm as $m) { $modalClaims[] = [$m[1], $m[0]]; chk($art, "modalValue:$g.$metric", near($m[2], $d[$m[1]]), "{$m[0]} 実測=" . fmtD($d)); }
        if (preg_match_all('/(High|Mid|Low)([\d.]+)%が最も多く/u', $note, $mm, PREG_SET_ORDER)) foreach ($mm as $m) $modalClaims[] = [$m[1], $m[0]];
        if (preg_match('/(High|Mid|Low)の割合が最も高く/u', $note, $m)) $modalClaims[] = [$m[1], $m[0]];
        if (preg_match('/Mid付近/u', $note)) $modalClaims[] = ['Mid', 'Mid付近'];
        if (preg_match('/中間的な分布/u', $note)) $modalClaims[] = ['Mid', '中間的な分布'];
        foreach ($modalClaims as [$lv, $label]) chk($art, "modal:$g.$metric", in_array($lv, $mod, true), "「{$label}」 実測=" . fmtD($d), 'SEM');
        // 全16タイプ中の最高値／最低値（High率）と同率
        if (preg_match_all("/全16タイプ中の?最(高|低)値(?:は|で、)((?:$TYPE_RE)(?:・$TYPE_RE)*)(?:と同率の|、)([\d.]+)%/u", $note, $mm, PREG_SET_ORDER)
            + preg_match_all("/((?:$TYPE_RE)(?:・$TYPE_RE)*)と並び最(低|高)値の([\d.]+)%/u", $note, $mm2, PREG_SET_ORDER)) {
            $items = [];
            foreach ($mm as $m) $items[] = [$m[1], $m[2], $m[3], $m[0]];
            foreach ($mm2 ?? [] as $m) $items[] = [$m[2], $m[1], $m[3], $m[0]];
            $hs = []; foreach (TYPES as $t) $hs[$t] = round(high(['m' => $t], $metric), 1);
            foreach ($items as [$hl, $list, $v, $label]) {
                $ext = $hl === '高' ? max($hs) : min($hs);
                $act = array_keys(array_filter($hs, fn($x) => $x == $ext)); sort($act);
                $claimed = explode('・', $list); if ($hs[$T] == (float)$v) $claimed[] = $T; $claimed = array_values(array_unique($claimed)); sort($claimed);
                chk($art, "extreme:$g.$metric", $claimed === $act && near($v, $ext), "「{$label}」 実測 最{$hl}値=" . $ext . ' ' . implode('・', $act), 'SEM');
            }
        }
        // 「((P)・(P)|(P)と(P))(のみ)?で決まる」＝式のPrimitive集合
        if (preg_match("/^($PRIM_RE)(?:・|と)($PRIM_RE)(?:のみ)?で(?:決まる|構成される)/u", $note, $m)) {
            $fs = array_keys(formulaOf($metric)); $cl = [$m[1], $m[2]]; sort($fs); sort($cl);
            chk($art, "formulaPrims:$g.$metric", $fs === $cl, "{$m[0]} 式=" . implode('・', $fs), 'SEM');
        }
        if (preg_match("/^($PRIM_RE)から($PRIM_RE)を差し引く/u", $note, $m)) {
            $fo = formulaOf($metric);
            chk($art, "formulaSign:$g.$metric", ($fo[$m[1]] ?? 0) > 0 && ($fo[$m[2]] ?? 0) < 0, "{$m[0]}", 'SEM');
        }
    }
    checkTopBundle($art, $a['topBundle'], $f);
    foreach (leaves(['faq' => $a['faq'], 'matome' => $a['matome'], 'causal_explanation' => $a['causal_explanation']]) as $w => $t) checkMetricParen($art, $w, $t, $f);
}];

// ---- 4-2. 星座記事（seiza/*：星座単体768件） ----
$RULES[] = ['scope' => 'seiza/*', 'desc' => 'Style/Tendency分布・topBundle・MBTI別ランキング（星座内）・注記の同一値/理由づけ・本文の指標値（全体平均の値・向き・程度は 5e 節）', 'fn' => function (string $art, array $a) {
    global $SIGN_RE;
    $si = signIndex($a['name']); $f = ['s' => $si];
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) {
        checkDistArray($art, "$g.$metric", $arr, $f, $metric);
        $note = $arr['note'] ?? ''; if ($note === '') continue;
        checkNoteMentionsFormula($art, "$g.$metric", $note, $metric);
        checkSameAs($art, "$g.$metric", $note, $metric, $f, 's', $SIGN_RE);
    }
    checkTopBundle($art, $a['topBundle'], $f);
    checkRanking($art, 'mbtiRanking', $a['mbtiRanking'], $a['mbti_intro'], fn($t, $metric) => high(['s' => $si, 'm' => $t], $metric));
    foreach (leaves(['faq' => $a['faq'], 'matome' => $a['matome']]) as $w => $t) checkMetricParen($art, $w, $t, $f);  // 全体平均の値・向き・程度は 5e 節
}];
/** ランキング配列（type/pct）。対象指標は導入文に書かれた指標の中から一致するものを探す */
function checkRanking(string $art, string $where, array $rank, string $intro, callable $valueOf): void {
    global $METRICS;
    $cands = array_values(array_filter($METRICS, fn($m) => mb_strpos($intro, $m) !== false));
    if (!$cands) $cands = $METRICS;
    $best = null;
    foreach ($cands as $metric) {
        $bad = [];
        foreach ($rank as $r) { $v = $valueOf($r['type'], $metric); if (!near($r['pct'], $v)) $bad[] = "{$r['type']} 記事={$r['pct']} 実測=" . r1($v); }
        $listed = array_column($rank, 'type');
        $vals = array_column($rank, 'pct');
        $sorted = $vals; rsort($sorted);
        if ($vals !== $sorted) $bad[] = '降順でない';
        if (count($listed) < 16) { $minListed = min($vals); foreach (TYPES as $t) if (!in_array($t, $listed, true) && round($valueOf($t, $metric), 1) > $minListed) $bad[] = "未掲載の{$t}が掲載最小値より高い"; }
        if (!$bad) { $best = [$metric, []]; break; }
        if ($best === null || count($bad) < count($best[1])) $best = [$metric, $bad];
    }
    chk($art, "ranking:$where", $best[1] === [], "指標={$best[0]} 件数=" . count($rank) . ($best[1] ? ' 不一致: ' . implode(' / ', array_slice($best[1], 0, 4)) : ''));
}

// ---- 4-3. 血液型記事（blood/*：血液型単体2304件） ----
$RULES[] = ['scope' => 'blood/*', 'desc' => 'Style/Tendency分布・4血液型の比較表・MBTI別ランキング（血液型内）・topBundle（比較の値・向き・程度は 5e 節）', 'fn' => function (string $art, array $a) {
    $B = $a['code']; $f = ['b' => $B];
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) {
        checkDistArray($art, "$g.$metric", $arr, $f, $metric);
        $note = $arr['note'] ?? ''; if ($note === '') continue;
        checkNoteMentionsFormula($art, "$g.$metric", $note, $metric);  // 比較の値・向き・程度は 5e 節
    }
    foreach ($a['compareTable'] as $row) foreach (BLOODS as $bt) {
        $v = high(['b' => $bt], $row['metric']);
        chk($art, "compareTable.{$row['metric']}.$bt", near($row[$bt], $v), "記事={$row[$bt]} 実測=" . r1($v));
    }
    checkTopBundle($art, $a['topBundle'], $f);
    checkRanking($art, 'mbtiRanking', $a['mbtiRanking'], $a['mbti_intro'], fn($t, $metric) => high(['b' => $B, 'm' => $t], $metric));
    foreach (leaves(['faq' => $a['faq'], 'matome' => $a['matome']]) as $w => $t) checkMetricParen($art, $w, $t, $f);
}];

// ---- 4-4. Style／Tendency記事（style/*, tendency/*：9216件全体） ----
$styleTendencyRule = function (string $art, array $a) {
    global $TYPE_RE, $PRIM_RE, $MET_RE;
    $metric = $a['name'];
    $d = lvDist(sub(), $metric);
    $o = $a['overall'];
    chk($art, 'overall', near($o['high'], $d['High']) && near($o['mid'], $d['Mid']) && near($o['low'], $d['Low']), "記事=H{$o['high']}/M{$o['mid']}/L{$o['low']} 実測=" . fmtD($d));
    // 計算式の表記
    if (preg_match_all("/($PRIM_RE) × ([\d.]+)/u", $a['formula_expr'], $mm, PREG_SET_ORDER)) {
        $fo = formulaOf($metric); $ok = count($mm) === count($fo);
        foreach ($mm as $i => $m) { $sign = $i === 0 ? 1 : (preg_match('/[－\-−]\s*' . preg_quote($m[0], '/') . '/u', $a['formula_expr']) ? -1 : 1); $ok = $ok && abs(($fo[$m[1]] ?? 99) - $sign * (float)$m[2]) < 1e-9; }
        chk($art, 'formula_expr', $ok, $a['formula_expr']);
    }
    $hsM = []; foreach (TYPES as $t) $hsM[$t] = high(['m' => $t], $metric);
    foreach ($a['mbtiRanking'] as $r) chk($art, "mbtiRanking.{$r['type']}", near($r['pct'], $hsM[$r['type']]), "記事={$r['pct']} 実測=" . r1($hsM[$r['type']]));
    $vals = array_column($a['mbtiRanking'], 'pct'); $s = $vals; rsort($s);
    chk($art, 'mbtiRanking.order', $vals === $s && count($vals) === 16, '降順・16件');
    foreach ($a['bloodBreakdown'] as $r) { $bt = str_replace('型', '', $r['type']); $v = high(['b' => $bt], $metric); chk($art, "bloodBreakdown.{$r['type']}", near($r['pct'], $v), "記事={$r['pct']} 実測=" . r1($v)); }
    foreach ($a['bundleCorrelation'] as $r) {
        preg_match("/^($PRIM_RE)が主軸/u", $r['primitive'], $m);
        $v = high(['p1' => P_CODE[$m[1]]], $metric);
        chk($art, "bundleCorrelation.{$m[1]}", near($r['pct'], $v), "記事={$r['pct']} 実測=" . r1($v));
    }
    foreach ($a['relatedMbti'] ?? [] as $r) if (preg_match("/^($TYPE_RE)（High([\d.]+)%）/u", $r['label'], $m)) chk($art, "relatedMbti.{$m[1]}", near($m[2], $hsM[$m[1]]), "{$r['label']} 実測=" . r1($hsM[$m[1]]));
    // 「(TYPE・TYPE)（x%）が（全16タイプ中）最も高く／低く」
    $r1 = []; foreach ($hsM as $t => $v) $r1[$t] = round($v, 1);
    if (preg_match_all("/((?:$TYPE_RE)(?:・$TYPE_RE)*)（([\d.]+)%）が(?:全16タイプ中)?最も(高く|低く)/u", $a['mbti_body'], $mm, PREG_SET_ORDER)) foreach ($mm as $m) {
        $ext = $m[3] === '高く' ? max($r1) : min($r1); $act = array_keys(array_filter($r1, fn($x) => $x == $ext)); sort($act);
        $cl = explode('・', $m[1]); sort($cl);
        chk($art, 'mbti_body.extreme', $cl === $act && near($m[2], $ext), "「{$m[0]}」 実測=" . implode('・', $act) . " $ext", 'SEM');
    }
    $hsB = []; foreach (BLOODS as $bt) $hsB[$bt] = round(high(['b' => $bt], $metric), 1);
    if (preg_match_all('/((?:A|B|O|AB)型(?:[・\/](?:A|B|O|AB)型)*)（([\d.]+)%）が最も(高く|低く)/u', $a['blood_body'], $mm, PREG_SET_ORDER)) foreach ($mm as $m) {
        $ext = $m[3] === '高く' ? max($hsB) : min($hsB); $act = array_keys(array_filter($hsB, fn($x) => $x == $ext)); sort($act);
        preg_match_all('/(AB|A|B|O)型/u', $m[1], $cm); $cl = $cm[1]; sort($cl);
        chk($art, 'blood_body.extreme', $cl === $act && near($m[2], $ext), "「{$m[0]}」 実測=" . implode('・', $act) . " $ext", 'SEM');
    }
    if (preg_match('/((?:A|B|O|AB))型(?:（([\d.]+)%）|が([\d.]+)%と)突出して(?:高く|おり)/u', $a['blood_body'], $m)) {
        $v = $m[2] !== '' ? $m[2] : $m[3]; $others = $hsB; unset($others[$m[1]]);
        chk($art, 'blood_body.standout', near($v, $hsB[$m[1]]) && $hsB[$m[1]] > max($others), "「{$m[0]}」 実測=" . json_encode($hsB), 'SEM');
    }
    // 「(指標)（(PRIM)主軸で x%）」
    if (preg_match_all("/($MET_RE)（($PRIM_RE)主軸で([\d.]+)%）/u", $a['bundle_body'], $mm, PREG_SET_ORDER)) foreach ($mm as $m) {
        $v = high(['p1' => P_CODE[$m[2]]], $m[1]); chk($art, 'bundle_body.ref', near($m[3], $v), "{$m[0]} 実測=" . r1($v));
    }
};
$RULES[] = ['scope' => 'style/*', 'desc' => '全体分布・計算式・MBTI/血液型/主軸別High率・最高/最低/突出の主張', 'fn' => $styleTendencyRule];
$RULES[] = ['scope' => 'tendency/*', 'desc' => '同上（Tendency）', 'fn' => $styleTendencyRule];
// 2026-10-06（6段階化）：levels_intro が6段階の説明文であること、levels の High・Mid・Low が結果画面の表示文
// （test.life-fun.net/inc/love-style-texts.php・love-tendency-texts.php）の L6・L3・L1 と一字一句一致すること。期待値は文言バンクから取る
const LEVELS_INTRO_6 = '実際の診断結果は6つの段階で文章が変わります。次はHigh・Mid・Lowそれぞれの代表的な文章（Highはいちばん高い段階、Midは真ん中の段階のひとつ、Lowはいちばん低い段階の文章）です';
$levelsRule = function (string $art, array $a) {
    require_once $GLOBALS['repo'] . '/test.life-fun.net/inc/love-style-texts.php';
    require_once $GLOBALS['repo'] . '/test.life-fun.net/inc/love-tendency-texts.php';
    $intro = (string)($a['levels_intro'] ?? '');
    $ok = str_contains($intro, LEVELS_INTRO_6);
    chk($art, 'levels_intro.6stage', $ok, '[levels_intro] ' . ($ok ? '6段階の説明文あり' : '6段階の説明文が無い: ' . mb_strimwidth($intro, 0, 60, '…')), $ok ? 'CLAIM' : 'MISSING');
    $mt = (string)($a['name'] ?? '');
    $bank = LOVE_STYLE_TEXTS[$mt] ?? LOVE_TENDENCY_TEXTS[$mt] ?? null;
    if ($bank === null) { chk($art, 'levels.bank', false, "項目「{$mt}」の表示文が文言バンクに無い", 'CLAIM'); return; }
    foreach (['High' => 'L6', 'Mid' => 'L3', 'Low' => 'L1'] as $k => $lv) {
        $ok = ($a['levels'][$k] ?? null) === $bank[$lv];
        chk($art, "levels.$k=$lv", $ok, "[levels.$k] " . ($ok ? "{$mt} {$lv}の表示文と一致" : "{$mt} {$lv}の表示文と一致しない（期待: {$bank[$lv]}）"), 'CLAIM');
    }
};
$RULES[] = ['scope' => 'style/*', 'desc' => 'levels_intro（6段階の説明）・levels（High=L6・Mid=L3・Low=L1の表示文）', 'fn' => $levelsRule];
$RULES[] = ['scope' => 'tendency/*', 'desc' => '同上（Tendency）', 'fn' => $levelsRule];

// ---- 4-5. Bundle記事（bundle/*：主軸Primitive別） ----
$RULES[] = ['scope' => 'bundle/*', 'desc' => '出現率・件数・副軸内訳・グループ内のStyle/Tendency分布・5グループ比較・MBTI別該当率', 'fn' => function (string $art, array $a) {
    global $P_NAME;
    $code = $a['primitiveCode']; $f = ['p1' => $code]; $cs = sub($f); $n = count($cs);
    chk($art, 'sampleSize', $a['sampleSize'] === $n, "記事={$a['sampleSize']} 実測=$n");
    chk($art, 'pct', near($a['pct'], pct($n, $GLOBALS['N_ALL'])), "記事={$a['pct']} 実測=" . round(pct($n, $GLOBALS['N_ALL']), 3));
    $sec = countBy($cs, 'p2');
    foreach ($a['breakdown'] as $r) {
        [$p, $s2] = explode('×', $r['label']); $c2 = $sec[P_CODE[$s2]] ?? 0;
        $ok = $P_NAME[$code] === $p && $r['count'] === $c2 && near($r['pctOfAll'], pct($c2, $GLOBALS['N_ALL']), 0.0005) && near($r['pctOfGroup'], pct($c2, $n));
        chk($art, "breakdown.{$r['label']}", $ok, "記事={$r['count']}件/{$r['pctOfAll']}/{$r['pctOfGroup']} 実測={$c2}件/" . round(pct($c2, $GLOBALS['N_ALL']), 3) . '/' . r1(pct($c2, $n)));
    }
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) checkDistArray($art, "$g.$metric", $arr, $f, $metric);
    foreach ($a['groupCompare'] as $r) {
        $pc = P_CODE[str_replace('型', '', $r['name'])]; $v = pct(count(sub(['p1' => $pc])), $GLOBALS['N_ALL']);
        chk($art, "groupCompare.{$r['name']}", near($r['pct'], $v, 0.0005), "記事={$r['pct']} 実測=" . round($v, 3));
    }
    foreach ($a['mbtiRanking'] as $r) { $v = pct(count(sub(['m' => $r['type'], 'p1' => $code])), 576); chk($art, "mbtiRanking.{$r['type']}", near($r['pct'], $v), "記事={$r['pct']} 実測=" . r1($v)); }
}];

// ---- 4-6. MBTI×血液型 組み合わせ記事（mbti-blood/*：144件） ----
$RULES[] = ['scope' => 'mbti-blood/*', 'desc' => '分類・単体/組み合わせ主軸率・副軸として残る件数と割合・最多副軸・同数・集中度順位/5段階・Style/Tendency分布・Bundle内訳・寄与の記述', 'fn' => function (string $art, array $a) {
    global $PRIM_RE, $P_NAME;
    [$mL, $bL] = explode('-', basename($art)); $m = strtoupper($mL); $b = strtoupper($bL);
    $ci = comboInfo($m, $b); $f = ['m' => $m, 'b' => $b];
    $cPj = $P_NAME[$ci['cP']];
    chk($art, 'classification', $a['classification'] === $ci['class'], "記事={$a['classification']} 実測={$ci['class']}");
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) checkDistArray($art, "$g.$metric", $arr, $f, $metric);
    $bc = countBy(sub($f), 'bid'); $okB = count($a['bundleBreakdown']) === count($bc); $bad = [];
    foreach ($a['bundleBreakdown'] as $r) {
        [$p, $s2] = explode('×', $r['label']); $id = 'LOVE_' . P_CODE[$p] . '_' . P_CODE[$s2];
        if (($bc[$id] ?? -1) !== $r['count'] || !near($r['pct'], pct($bc[$id] ?? 0, 144))) { $okB = false; $bad[] = "{$r['label']} 記事={$r['count']} 実測=" . ($bc[$id] ?? 0); }
    }
    chk($art, 'bundleBreakdown', $okB, $bad ? implode(' / ', $bad) : count($bc) . '通り');
    $secCount = fn(string $pj) => $ci['sec'][P_CODE[$pj]] ?? 0;
    $txt = leaves(['conclusion' => $a['conclusion'], 'classification_desc' => $a['classification_desc'], 'causal_explanation' => $a['causal_explanation'],
        'causalRows' => $a['causalRows'], 'faq' => $a['faq'], 'matome' => $a['matome'], 'conceptLinks' => $a['conceptLinks'], 'rarity_note' => $a['rarity_note'], 'rarityRank' => $a['rarityRank']]);
    $all = implode("\n", $txt);
    // 組み合わせの主軸率
    if (preg_match_all('/144パターン中([\d.]+)%/u', $all, $mm)) foreach ($mm[1] as $v) chk($art, 'comboPrimaryRate', near($v, $ci['cR']), "記事=$v 実測={$ci['cR']}");
    // 単体の主軸率（因果テーブル）
    foreach ($a['causalRows'] as $row) {
        if (preg_match("/^($PRIM_RE) ([\d.]+)%（(576|2304)パターン中）/u", $row['solo'], $mm)) {
            [$pp, $rr] = $mm[3] === '576' ? [$ci['mP'], $ci['mR']] : [$ci['bP'], $ci['bR']];
            chk($art, 'soloPrimary', P_CODE[$mm[1]] === $pp && near($mm[2], $rr), "{$row['solo']} 実測={$P_NAME[$pp]} $rr");
        }
        if (preg_match('/^主軸として採用（([\d.]+)%）/u', $row['result'], $mm)) chk($art, 'causalRows.adopted', near($mm[1], $ci['cR']), "{$row['result']}");
    }
    // 主軸を譲った側が副軸として残る件数・割合（本文の主張を件数で照合）
    $yieldClaims = [];
    if (preg_match_all("/($PRIM_RE)は、($PRIM_RE)が主軸になったケース（(\d+)件）のうち([\d.]+)%（(\d+)件）で副軸として残/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) $yieldClaims[] = [$x[1], $x[2], (int)$x[3], $x[4], (int)$x[5], $x[0]];
    if (preg_match_all("/(?:由来の|優勢な)($PRIM_RE)は(?:主軸を譲っても消えるわけではなく、)?($PRIM_RE)が主軸になったケースの([\d.]+)%(?:（(\d+)件中(\d+)件）)?で副軸として残/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) $yieldClaims[] = [$x[1], $x[2], isset($x[4]) && $x[4] !== '' ? (int)$x[4] : null, $x[3], isset($x[5]) && $x[5] !== '' ? (int)$x[5] : null, $x[0]];
    if (preg_match_all("/($PRIM_RE)が主軸になったケースの([\d.]+)%(?:（(\d+)件中(\d+)件）)?で($PRIM_RE)が副軸として残/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) $yieldClaims[] = [$x[5], $x[1], isset($x[3]) && $x[3] !== '' ? (int)$x[3] : null, $x[2], isset($x[4]) && $x[4] !== '' ? (int)$x[4] : null, $x[0]];
    foreach ($yieldClaims as [$sp, $pp, $n, $rate, $k, $label]) {
        $act = $secCount($sp);
        $ok = $pp === $cPj && ($n === null || $n === $ci['pm']) && ($k === null || $k === $act) && near($rate, pct($act, $ci['pm']));
        chk($art, 'secondaryRemains', $ok, "「{$label}」 実測={$sp} {$act}/{$ci['pm']}件=" . r1(pct($act, $ci['pm'])) . '%', 'SEM');
    }
    if (preg_match_all("/($PRIM_RE)は、?($PRIM_RE)が主軸になったケース（(\d+)件）では副軸にも現れません/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) {
        chk($art, 'secondaryAbsent', $x[2] === $cPj && (int)$x[3] === $ci['pm'] && $secCount($x[1]) === 0, "「{$x[0]}」 実測={$x[1]} " . $secCount($x[1]) . '件', 'SEM');
    }
    foreach ($a['causalRows'] as $row) {
        if (preg_match('/副軸として残る（([\d.]+)%）/u', $row['result'], $mm)) { $y = $ci['yield']; $act = $y ? ($ci['sec'][$y] ?? 0) : -1; chk($art, 'causalRows.remains', $y !== null && $act > 0 && near($mm[1], pct($act, $ci['pm'])), "{$row['result']} 実測=" . ($y ? r1(pct($act, $ci['pm'])) : '-')); }
        if (preg_match('/副軸にも現れない（0件）/u', $row['result'])) { $y = $ci['yield']; chk($art, 'causalRows.absent', $y !== null && ($ci['sec'][$y] ?? 0) === 0, "{$row['result']}"); }
    }
    // 最多の副軸（併記）
    $topSecCnt = reset($ci['sec']);
    if (preg_match_all("/最も多い副軸は($PRIM_RE)の([\d.]+)%・(\d+)件/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) {
        chk($art, 'topSecondary', $secCount($x[1]) === $topSecCnt && (int)$x[3] === $topSecCnt && near($x[2], pct($topSecCnt, $ci['pm'])), "「{$x[0]}」 実測最多=" . $P_NAME[array_key_first($ci['sec'])] . " $topSecCnt");
    }
    // まとめ：「X は、Y が主軸のケースの Z% で副軸として残る（W も同数の Z%）」＝最多の副軸
    if (preg_match_all("/($PRIM_RE)は、($PRIM_RE)が主軸のケースの([\d.]+)%で副軸として残る(?:（((?:$PRIM_RE)(?:・$PRIM_RE)*)も同数の([\d.]+)%）)?/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) {
        $ties = array_keys(array_filter($ci['sec'], fn($v) => $v === $topSecCnt));
        $claimedTies = isset($x[4]) && $x[4] !== '' ? array_map(fn($p) => P_CODE[$p], explode('・', $x[4])) : [];
        $ok = $x[2] === $cPj && $secCount($x[1]) === $topSecCnt && near($x[3], pct($topSecCnt, $ci['pm']));
        foreach ($claimedTies as $tc) $ok = $ok && (($ci['sec'][$tc] ?? 0) === $topSecCnt);
        chk($art, 'matome.secondary', $ok, "「{$x[0]}」 実測最多=" . implode('・', array_map(fn($c) => $P_NAME[$c], $ties)) . " $topSecCnt/{$ci['pm']}");
    }
    foreach ($a['conceptLinks'] as $cl) if (preg_match('/副軸として([\d.]+)%残るBundle/u', $cl['desc'], $x)) {
        $pj = str_replace('型', '', $cl['name']); chk($art, 'conceptLinks.secondary', near($x[1], pct($secCount($pj), $ci['pm'])), "{$cl['name']} {$cl['desc']} 実測=" . r1(pct($secCount($pj), $ci['pm'])));
    }
    // 単体の主軸率の本文表記（MBTI単体X%・◯型単体Y%）
    if (preg_match_all('/MBTI(?:単体)?([\d.]+)%/u', $all, $mm)) foreach ($mm[1] as $v) chk($art, 'mbtiPrimaryRate', near($v, $ci['mR']), "MBTI単体 記事=$v 実測={$ci['mR']}");
    if (preg_match_all('/' . $b . '型(?:単体)?([\d.]+)%/u', $all, $mm)) foreach ($mm[1] as $v) chk($art, 'bloodPrimaryRate', near($v, $ci['bR']), "{$b}型単体 記事=$v 実測={$ci['bR']}");
    // 協調型の集中度の比較
    if (preg_match('/さらに強く|よりも高い集中度/u', $all)) chk($art, 'kyochoAboveBoth', $ci['cR'] > $ci['mR'] && $ci['cR'] > $ci['bR'], "組み合わせ{$ci['cR']} MBTI{$ci['mR']} 血液型{$ci['bR']}", 'SEM');
    if (preg_match('/単体（([\d.]+)%）より高い一方、[^（]*単体（([\d.]+)%）よりは低く/u', $all, $x)) chk($art, 'kyochoBetween', $ci['cR'] > (float)$x[1] && $ci['cR'] < (float)$x[2], $x[0]);
    // 集中度の順位・5段階
    if (preg_match_all('/64通り中(\d+)位/u', $all, $mm)) foreach ($mm[1] as $v) chk($art, 'rank', (int)$v === $ci['rank'], "記事={$v}位 実測={$ci['rank']}位");
    if (preg_match_all('/上位([\d.]+)%相当/u', $all, $mm)) foreach ($mm[1] as $v) chk($art, 'percentile', near($v, $ci['pctile']), "記事=$v 実測={$ci['pctile']}");
    chk($art, 'level', ($a['rarityLevel'] ?? '') === $ci['level'], "記事={$a['rarityLevel']} 実測={$ci['level']}");
    // 「◯◯由来の(P)」：その入力が本当にPへ寄与するか
    if (preg_match_all("/(" . $m . "|" . $b . "型)由来の($PRIM_RE)/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) {
        $contrib = $x[1] === $m ? typeContribLetters($m, $x[2]) !== [] : count(array_filter(BLOOD_TRAIT_MAPPING[$b], fn($r) => primOfTrait($r['trait']) === $x[2])) > 0;
        chk($art, 'derivedFrom', $contrib, "「{$x[0]}」", 'SEM');
    }
    if (preg_match("/{$m}と{$b}型が、たまたま同じPrimitive（($PRIM_RE)）に強く寄与する構造/u", $all, $x)) {
        $okM = typeContribLetters($m, $x[1]) !== []; $okB = count(array_filter(BLOOD_TRAIT_MAPPING[$b], fn($r) => primOfTrait($r['trait']) === $x[1])) > 0;
        chk($art, 'bothContribute', $okM && $okB, "「{$x[0]}」 MBTI寄与=" . ($okM ? 'あり' : 'なし') . " {$b}型寄与=" . ($okB ? 'あり' : 'なし'), 'SEM');
    }
    // 「ENFPではN（直感）・F（情熱）が情動性へ寄与」：文字の寄与
    if (preg_match_all("/{$m}(?:では|は)((?:[EINSTFJP]（[^）]+）)(?:・[EINSTFJP]（[^）]+）)*)が(?:同じく)?($PRIM_RE)へ/u", $all, $mm, PREG_SET_ORDER)) foreach ($mm as $x) {
        preg_match_all('/([EINSTFJP])（/u', $x[1], $lt); $act = typeContribLetters($m, $x[2]); sort($act); $cl = $lt[1]; sort($cl);
        chk($art, 'letterContrib', $cl === $act, "「{$x[0]}」 実際の寄与文字=" . implode('・', $act), 'SEM');
    }
}];

// ======================================================================
// 5. 個別記事の主張（宣言的な表）
//    'art' => 記事, 'where' => フィールド（'*'は記事全体の文字列）, 're' => 正規表現,
//    'required' => 修正後の正しい主張（見つからなければFAIL）, 'expect' => fn($m) => [bool, 実測の説明]
// ======================================================================
$H = fn(array $f, string $metric) => round(high($f, $metric), 1);
$srcKeys = fn(string $pj, ?string $kind = null) => array_map(fn($s) => "{$s['kind']}:{$s['key']}:+{$s['score']}", array_values(array_filter(sourcesOf($pj), fn($s) => $kind === null || $s['kind'] === $kind)));
$primMax = function (string $pj): int { $mx = 0; foreach ($GLOBALS['CASES'] as $c) $mx = max($mx, $c['p'][$pj]); return $mx; };
$tvEI = function (string $metric, array $fa, array $fb): float { $a = lvDist(sub($fa), $metric); $b = lvDist(sub($fb), $metric); return (abs($a['High'] - $b['High']) + abs($a['Mid'] - $b['Mid']) + abs($a['Low'] - $b['Low'])) / 2; };
$traShareSign = fn(int $si) => round(pct(count(sub(['s' => $si, 'p1' => 'TRA'])), 768), 1);
$sixEarthAir = array_values(array_filter(range(0, 11), fn($i) => in_array(SEIZA_SIGNS[$i]['element'], [1, 2], true)));
$metricsWithAct = function (string $list) { $bad = []; foreach (explode('・', $list) as $mt) if (!isset(formulaOf($mt)['行動主導性'])) $bad[] = $mt; return $bad; };
$actReasonExpect = function ($m) use ($metricsWithAct) { $bad = $metricsWithAct($m[1]); return [$bad === [], $bad ? implode('・', $bad) . 'の式に行動主導性は含まれない' : '全指標の式に行動主導性あり']; };
$dokusenSame = function () use ($sixEarthAir) {
    $raws = array_map(fn($i) => lvDist(sub(['s' => $i]), '独占欲')['raw'], $sixEarthAir);
    $noContrib = true; foreach (['情動性', '自立性'] as $pj) foreach (sourcesOf($pj) as $s) if (($s['kind'] === 'element' && in_array($s['key'], ['地', '風'], true)) || ($s['kind'] === 'quality' && $s['key'] === '活動宮')) $noContrib = false;
    return count(array_unique(array_map('json_encode', $raws))) === 1 && count($sixEarthAir) === 6 && $noContrib && array_keys(formulaOf('独占欲')) === ['情動性', '自立性'];
};
$capLibSameAct = fn() => lvDist(sub(['s' => signIndex('山羊座')]), '積極性')['raw'] === lvDist(sub(['s' => signIndex('天秤座')]), '積極性')['raw']
    && lvDist(sub(['s' => signIndex('山羊座')]), '愛情表現')['raw'] === lvDist(sub(['s' => signIndex('天秤座')]), '愛情表現')['raw'];
/** 積極性・愛情表現＝行動主導性と情動性、独占欲＝情動性と自立性の式で、天秤座・山羊座のエレメント（風・地）・クオリティ（活動宮）が情動性・自立性へ加算しない */
$libCapFormulaOk = function (): bool {
    $set = function (string $mt) { $k = array_keys(formulaOf($mt)); sort($k); return $k; };
    $ok = $set('積極性') === ['情動性', '行動主導性'] && $set('愛情表現') === ['情動性', '行動主導性'] && $set('独占欲') === ['情動性', '自立性'];
    foreach ([signIndex('天秤座'), signIndex('山羊座')] as $si) {
        $el = SEIZA_ELEMENTS[SEIZA_SIGNS[$si]['element']]['name']; $qu = SEIZA_QUALITIES[SEIZA_SIGNS[$si]['quality']]['name'];
        foreach (['情動性', '自立性'] as $pj) foreach (sourcesOf($pj) as $s) if (($s['kind'] === 'element' && $s['key'] === $el) || ($s['kind'] === 'quality' && $s['key'] === $qu)) $ok = false;
    }
    return $ok && SEIZA_SIGNS[signIndex('天秤座')]['quality'] === SEIZA_SIGNS[signIndex('山羊座')]['quality'];
};
/** 全9216件での各指標（Style7＋Tendency2）の Low 率（未丸め、昇順） */
$lowRates = function (): array { $r = []; foreach ($GLOBALS['METRICS'] as $mt) $r[$mt] = lvDist(sub([]), $mt)['Low']; asort($r); return $r; };
$lowRangeStr = function () use ($lowRates): string { $r = $lowRates(); $mn = array_key_first($r); $mx = array_key_last($r); return "Low率 最小={$mn}" . r1($r[$mn]) . " 最大={$mx}" . r1($r[$mx]); };
/** 結果画面の表示文（test.life-fun.net/inc/love-style-texts.php・love-tendency-texts.php）の全文 */
$displayTexts = function (): array {
    require_once $GLOBALS['repo'] . '/test.life-fun.net/inc/love-style-texts.php';
    require_once $GLOBALS['repo'] . '/test.life-fun.net/inc/love-tendency-texts.php';
    $all = [LOVE_STYLE_TEXTS, LOVE_TENDENCY_TEXTS]; $o = [];
    array_walk_recursive($all, function ($v) use (&$o) { if (is_string($v)) $o[] = $v; });
    return $o;
};
/** 結果画面の表示名（test.life-fun.net/inc/love-display-labels.php の LOVE_ITEM_LABELS）：項目名 => 表示名 */
$displayLabels = function (): array {
    require_once $GLOBALS['repo'] . '/test.life-fun.net/inc/love-display-labels.php';
    return array_map(fn($v) => $v['label'], LOVE_ITEM_LABELS);
};
/**
 * 引用した表示名（「恋の進め方」など）が LOVE_ITEM_LABELS の表示名と一字一句一致し、$kind（'style'/'tendency'/null）の項目のものであること。
 * $all=true（「〜という名前」）のときは、その種類の表示名をすべて挙げていること。
 */
$labelQuoteExpect = function (string $quoted, ?string $kind, bool $all = false) use ($displayLabels): array {
    preg_match_all('/「([^」]+)」/u', $quoted, $q); $labels = $displayLabels();
    $keys = $kind === 'style' ? array_keys(LOVE_STYLE_MAPPING) : ($kind === 'tendency' ? array_keys(LOVE_TENDENCY_MAPPING) : array_keys($labels));
    $pool = array_values(array_intersect_key($labels, array_flip($keys))); $bad = [];
    foreach ($q[1] as $l) if (!in_array($l, $pool, true)) $bad[] = $l;
    if ($all) { $a = $q[1]; $b = $pool; sort($a); sort($b); if ($a !== $b) $bad[] = '列挙が全項目と一致しない（' . implode('・', $pool) . '）'; }
    return [$q[1] !== [] && $bad === [], $bad ? 'LOVE_ITEM_LABELS に無い／種類が違う: ' . implode(' ', $bad) : '表示名=' . implode('・', $q[1])];
};
/** 結果画面（test.life-fun.net/love.php）の結果の見出し（class="result-section-title"） */
$screenSections = function (): array {
    preg_match_all('/class="result-section-title">([^<]+)</u', (string)file_get_contents($GLOBALS['repo'] . '/test.life-fun.net/love.php'), $mm);
    return $mm[1];
};
/**
 * 診断の入力（test.life-fun.net/love.php のソース）：API が受け取る $input のキー、フォームの入力見出し（class="select-title"）、
 * 生年月日を月・日に分けて love_diagnose に渡しているか（星座は生年月日から決まる）。2026-10-06追加（kekka-no-mikata の FAQ）
 */
$loveInputs = function (): array {
    $src = (string)file_get_contents($GLOBALS['repo'] . '/test.life-fun.net/love.php');
    preg_match_all('/\$input\[\'([a-zA-Z_]+)\'\]/u', $src, $k); $keys = array_values(array_unique($k[1])); sort($keys);
    preg_match_all('/class="select-title">([^<]+)</u', $src, $t);
    $fromBirthday = (bool)preg_match('/\[,\s*\$month,\s*\$day\]\s*=\s*array_map\(\'intval\',\s*explode\(\'-\',\s*\$birthday\)\)/u', $src)
        && (bool)preg_match('/love_diagnose\(\$mbtiType,\s*\$bloodType,\s*\$month,\s*\$day/u', $src);
    return ['keys' => $keys, 'titles' => $t[1], 'fromBirthday' => $fromBirthday];
};
/** 入力欄が MBTI・血液型・生年月日の3つで、星座の入力欄は無く、星座は生年月日（月・日）から決まること */
$inputsAreMbtiBloodBirthday = function () use ($loveInputs): array {
    $in = $loveInputs();
    $titlesOk = count($in['titles']) === 3 && str_contains($in['titles'][0] ?? '', 'MBTI') && str_contains($in['titles'][1] ?? '', '血液型') && str_contains($in['titles'][2] ?? '', '生年月日');
    $noSeiza = array_filter($in['titles'], fn($x) => str_contains($x, '星座')) === [];
    $ok = $in['keys'] === ['birthday', 'blood', 'mbti'] && $titlesOk && $noSeiza && $in['fromBirthday'];
    return [$ok, 'love.php 入力キー=' . implode('・', $in['keys']) . ' 入力見出し=' . implode('／', $in['titles']) . ' 星座=' . ($in['fromBirthday'] ? '生年月日の月・日から算出' : '生年月日からの算出を確認できない')];
};
$sectionQuoteExpect = function (string $quoted) use ($screenSections): array {
    preg_match_all('/「([^」]+)」/u', $quoted, $q); $bad = array_values(array_diff($q[1], $screenSections()));
    return [$q[1] !== [] && $bad === [], $bad ? 'love.php の結果の見出しに無い: ' . implode('・', $bad) : '見出し=' . implode('・', $q[1])];
};
/** 式の Primitive 集合（昇順） */
$fset = function (string $mt): array { $k = array_keys(formulaOf($mt)); sort($k); return $k; };
/** 血液型ごとの Primitive への寄与（inc/blood-trait-mapping.php）：Primitive => 合計スコア */
$bloodContrib = function (string $bt): array { $o = []; foreach (BLOOD_TRAIT_MAPPING[$bt] as $r) { $p = primOfTrait($r['trait']); $o[$p] = ($o[$p] ?? 0) + $r['score']; } ksort($o); return $o; };
/**
 * 入力1つ（血液型 'b' => 'AB'／MBTI 'm' => 'ENFJ'／星座 's' => 星座の番号）が各 Primitive へ加算するスコアの合計（inc のマッピングから）。
 * 星座はエレメントとクオリティの寄与（内面タイプは星座によらず全12通りが同じ件数ずつ入るため含めない）。
 */
function contribOf(string $kind, $key): array {
    $rules = [];
    if ($kind === 'b') $rules = BLOOD_TRAIT_MAPPING[$key];
    elseif ($kind === 'm') foreach (str_split($key) as $l) $rules = array_merge($rules, MBTI_TRAIT_MAPPING[$l]);
    elseif ($kind === 's') $rules = array_merge(SEIZA_TRAIT_MAPPING['element'][SEIZA_SIGNS[$key]['element']], SEIZA_TRAIT_MAPPING['quality'][SEIZA_SIGNS[$key]['quality']]);
    $o = []; foreach ($rules as $r) { $p = primOfTrait($r['trait']); $o[$p] = ($o[$p] ?? 0) + $r['score']; }
    $o = array_filter($o, fn($v) => $v !== 0); ksort($o);
    return $o;
}
/** 2つの入力で寄与が異なる Primitive の集合 */
function contribDiff(string $kind, $a, $b): array {
    $x = contribOf($kind, $a); $y = contribOf($kind, $b); $d = [];
    foreach (array_unique(array_merge(array_keys($x), array_keys($y))) as $p) if (($x[$p] ?? 0) !== ($y[$p] ?? 0)) $d[] = $p;
    sort($d);
    return $d;
}
/** AB型の「計算式に行動主導性を含まないため、O型と完全に同じ数値」（指標1つ）：式に行動主導性が無い・AB型とO型の違いは行動主導性だけ・分布が一致 */
$abNoActNote = function (string $mt): callable {
    return function ($m) use ($mt): array {
        $noAct = !isset(formulaOf($mt)['行動主導性']); $diff = contribDiff('b', 'AB', 'O');
        $same = lvDist(sub(['b' => 'AB']), $mt)['raw'] === lvDist(sub(['b' => 'O']), $mt)['raw'];
        return [$noAct && $diff === ['行動主導性'] && $same, formulaStr($mt) . ' AB型とO型で寄与が異なるPrimitive=' . implode('・', $diff) . ' 分布' . ($same ? 'が一致' : 'が違う')];
    };
};
/** AB型の「行動主導性を含まない指標（列挙）は、行動主導性以外の寄与がO型と同じため完全に同じ数値」 */
$abNoActExpect = function ($m) use ($bloodContrib): array {
    $listed = explode('・', $m[1]); $noAct = array_values(array_filter($GLOBALS['METRICS'], fn($mt) => !isset(formulaOf($mt)['行動主導性'])));
    $a = $listed; $b = $noAct; sort($a); sort($b);
    $ab = $bloodContrib('AB'); $o = $bloodContrib('O'); $abX = $ab; $oX = $o; unset($abX['行動主導性'], $oX['行動主導性']);
    $diffP = array_values(array_unique(array_merge(array_keys(array_diff_assoc($ab, $o)), array_keys(array_diff_assoc($o, $ab)))));
    $same = []; foreach ($listed as $mt) if (lvDist(sub(['b' => 'AB']), $mt)['raw'] !== lvDist(sub(['b' => 'O']), $mt)['raw']) $same[] = $mt;
    $ok = $a === $b && $abX === $oX && $diffP === ['行動主導性'] && $same === [];
    return [$ok, '行動主導性を含まない指標=' . implode('・', $noAct) . ' AB=' . json_encode($ab, JSON_UNESCAPED_UNICODE) . ' O=' . json_encode($o, JSON_UNESCAPED_UNICODE) . ($same ? ' 分布が違う: ' . implode('・', $same) : '')];
};
/** 天秤座・山羊座のエレメント・クオリティが情動性へ加算しない（inc の星座マッピング）＋2星座の積極性・愛情表現の分布が同じ（スナップショット） */
$libCapSenZero = function () use ($capLibSameAct): array {
    $contrib = [];
    foreach (['天秤座', '山羊座'] as $nm) {
        $si = signIndex($nm); $el = SEIZA_ELEMENTS[SEIZA_SIGNS[$si]['element']]['name']; $qu = SEIZA_QUALITIES[SEIZA_SIGNS[$si]['quality']]['name'];
        $contrib[$nm] = array_sum(array_map(fn($s) => $s['score'], array_filter(sourcesOf('情動性'), fn($s) => ($s['kind'] === 'element' && $s['key'] === $el) || ($s['kind'] === 'quality' && $s['key'] === $qu))));
    }
    $ok = $contrib['天秤座'] === 0 && $contrib['山羊座'] === 0 && $capLibSameAct() && isset(formulaOf('積極性')['情動性']) && isset(formulaOf('愛情表現')['情動性']);
    return [$ok, '情動性への寄与 天秤座=' . $contrib['天秤座'] . ' 山羊座=' . $contrib['山羊座'] . ' 積極性・愛情表現の分布' . ($capLibSameAct() ? 'は同じ' : 'が違う')];
};

$CLAIMS = [
    // ---- guide/9216-patterns ----
    ['art' => 'guide/9216-patterns', 'where' => '*', 'required' => true, 're' => '/ENTPの576件のうち積極性がHighになるのは([\d.]+)%/u',
     'expect' => fn($m) => [near($m[1], high(['m' => 'ENTP'], '積極性')), 'ENTP積極性High=' . r1(high(['m' => 'ENTP'], '積極性'))]],
    ['art' => 'guide/9216-patterns', 'where' => '*', 'required' => false, 're' => '/積極性がHighになるのは([EI][NS][TF][JP])で([\d.]+)%/u',
     'expect' => fn($m) => [near($m[2], high(['m' => $m[1]], '積極性')), "{$m[1]}積極性High=" . r1(high(['m' => $m[1]], '積極性')) . '（100%になるのはENTP×O型等の組み合わせ）']],
    ['art' => 'guide/9216-patterns', 'where' => '*', 'required' => true, 're' => '/Bundle『(誠実性)×(情動性)』は9216件中([\d.]+)%/u',
     'expect' => fn($m) => [near($m[3], pct(count(sub(['bid' => 'LOVE_REL_SEN'])), 9216)), 'LOVE_REL_SEN=' . r1(pct(count(sub(['bid' => 'LOVE_REL_SEN'])), 9216))]],
    // ---- guide/bundle-guide ----
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => true, 're' => '/上位6通り（[^）]*）だけで全体の([\d.]+)%/u',
     'expect' => function ($m) { $c = array_slice(countBy($GLOBALS['CASES'], 'bid'), 0, 6); return [near($m[1], pct(array_sum($c), 9216)), r1(pct(array_sum($c), 9216))]; }],
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => true, 're' => '/9〜20位自立性が絡む8通り＋残り合計([\d.]+)%/u',
     'expect' => function ($m) { $c = array_slice(countBy($GLOBALS['CASES'], 'bid'), 0, 8); return [near($m[1], 100 - pct(array_sum($c), 9216)), r1(100 - pct(array_sum($c), 9216))]; }],
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => true, 're' => '/自立性が主軸または副軸に入る8通りは、合計しても約([\d.]+)%/u',
     'expect' => function ($m) { $n = count(array_filter($GLOBALS['CASES'], fn($c) => $c['p1'] === 'AUT' || $c['p2'] === 'AUT')); return [near($m[1], pct($n, 9216)), r1(pct($n, 9216))]; }],
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => true, 're' => '/最も少ないLOVE_AUT_ACT・LOVE_AUT_SENはそれぞれ実測(\d+)件/u',
     'expect' => function ($m) { $c = countBy($GLOBALS['CASES'], 'bid'); $mn = min($c); return [($c['LOVE_AUT_ACT'] ?? 0) === (int)$m[1] && ($c['LOVE_AUT_SEN'] ?? 0) === (int)$m[1] && $mn === (int)$m[1], "AUT_ACT=" . ($c['LOVE_AUT_ACT'] ?? 0) . " AUT_SEN=" . ($c['LOVE_AUT_SEN'] ?? 0) . " 最少=$mn"]; }],
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => true, 're' => '/自立性に加算されるのは、MBTIのI（内向、\+1）、血液型B型の「マイペース」（\+2）、星座の内面タイプのうち表現型（\+1）・自由型（\+2）に限られ、星座のエレメント・クオリティからは加算されません。そのため到達しうる最大値は(\d+)で、他の4プリミティブ（最大(\d+)〜(\d+)）/u',
     'expect' => function ($m) use ($srcKeys, $primMax) {
        $s = $srcKeys('自立性'); sort($s); $exp = ['blood:B:+2', 'innerType:自由型:+2', 'innerType:表現型:+1', 'mbti:I:+1']; sort($exp);
        $oth = array_map($primMax, ['行動主導性', '誠実性', '情動性', '変化志向']);
        return [$s === $exp && $primMax('自立性') === (int)$m[1] && min($oth) === (int)$m[2] && max($oth) === (int)$m[3], '経路=' . implode(',', $s) . ' 最大=' . $primMax('自立性') . ' 他=' . implode('/', $oth)]; }],
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => true, 're' => '/自立性というプリミティブに加算される経路が、MBTIのI（内向）・血液型B型・星座の一部の内面タイプに限られ、到達しうる最大値（(\d+)）が他の4プリミティブ（(\d+)〜(\d+)）より低い/u',
     'expect' => function ($m) use ($primMax) { $oth = array_map($primMax, ['行動主導性', '誠実性', '情動性', '変化志向']); return [$primMax('自立性') === (int)$m[1] && min($oth) === (int)$m[2] && max($oth) === (int)$m[3], '最大=' . $primMax('自立性')]; }],
    ['art' => 'guide/bundle-guide', 'where' => 'body', 'required' => false, 'all' => true, 're' => '/<tr><td>(\d+)<\/td><td>(行動主導性|誠実性|情動性|自立性|変化志向)×(行動主導性|誠実性|情動性|自立性|変化志向)<\/td><td>([\d.]+)%<\/td><\/tr>/u', 'raw' => true,
     'expect' => function ($m) { $c = countBy($GLOBALS['CASES'], 'bid'); $id = 'LOVE_' . P_CODE[$m[2]] . '_' . P_CODE[$m[3]]; $pos = array_search($id, array_keys($c), true) + 1; return [$pos === (int)$m[1] && near($m[4], pct($c[$id], 9216)), "{$id} 実測 {$pos}位 " . r1(pct($c[$id], 9216))]; }],
    // ---- guide/kekka-no-mikata・style-guide：High/Mid/Low の割合と結果画面の表示（2026-10-01修正）----
    // 実測の3段階の割合は均等ではない（Low率は指標ごとに異なる）。結果画面（love.php renderResult）は段階名・点数・Bundle ID を表示しない
    ['art' => 'guide/kekka-no-mikata', 'where' => '*', 'required' => true, 're' => "/Lowの割合は項目によって([\\d.]+)%（($MET_RE)）〜([\\d.]+)%（($MET_RE)）/u",
     'expect' => function ($m) use ($lowRates, $lowRangeStr) { $r = $lowRates();
        return [near($m[1], min($r)) && near($m[1], $r[$m[2]]) && near($m[3], max($r)) && near($m[3], $r[$m[4]]), $lowRangeStr()]; }],
    ['art' => 'guide/style-guide', 'where' => '*', 'required' => true, 're' => "/($MET_RE)はLowが([\\d.]+)%/u",
     'expect' => function ($m) use ($lowRates) { $r = $lowRates(); return [near($m[2], $r[$m[1]]), "{$m[1]} Low率=" . r1($r[$m[1]])]; }],
    // 旧文：均等割合（「下位33%」「中位34%」「上位33%」「上位33%・中位34%・下位33%」「上位33%がHigh、下位33%がLow」）。全指標の実測がその割合（±0.5）なら成り立つ
    // 2026-10-06：対象を guide/* から全記事へ広げた（style/sekkyokusei-love の normalizer_body に同じ文型があったため）。mbti-blood の「上位◯%相当」（集中度の順位）は対象外
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/(?:上位|中位|下位)[\d.]+%(?!相当)(?:が(?:High|Mid|Low))?(?:[・、](?:上位|中位|下位)[\d.]+%(?!相当)(?:が(?:High|Mid|Low))?)*/u',
     'expect' => function ($m) use ($lowRangeStr) { preg_match_all('/(上位|中位|下位)([\d.]+)%/u', $m[0], $ps, PREG_SET_ORDER); $bad = [];
        foreach ($ps as $p) { $lv = ['上位' => 'High', '中位' => 'Mid', '下位' => 'Low'][$p[1]]; foreach ($GLOBALS['METRICS'] as $mt) { $v = lvDist(sub([]), $mt)[$lv]; if (!near($p[2], $v, 0.5)) $bad[] = "{$mt}{$lv}=" . r1($v); } }
        return [$bad === [], '実測は均等ではない（' . $lowRangeStr() . '）' . ($bad ? ' 不一致: ' . implode(' ', array_slice(array_unique($bad), 0, 6)) . (count(array_unique($bad)) > 6 ? ' …' : '') : '')]; }],
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/3段階で表示されます/u',
     'expect' => fn($m) => [false, '結果画面（love.php renderResult）は段階（High/Mid/Low）を表示しない']],
    ['art' => '*', 'where' => '*', 'required' => false, 're' => "/「(?:$MET_RE)は(?:High|Mid|Low)」|「恋愛タイプは(?:LOVE_)?[A-Z]{3}_[A-Z]{3}」/u",
     'expect' => fn($m) => [false, '結果画面に「指標は段階名」「恋愛タイプはBundle ID」の表記は出ない（表示は文章のみ）']],
    // 表示文の引用：「〜」のように／という前向きな傾向として表示、の引用句が結果画面の表示文（inc/love-style-texts.php・love-tendency-texts.php）のどれかに部分一致すること。旧文「じっくり相手を見てから動く」は表示文に無い
    // 2026-10-06：対象を guide/* から全記事へ広げ、「「〜」という前向きな傾向として表示」の形も扱う（style/sekkyokusei-love の FAQ の旧文「じっくり相手をよく知ってから一歩を踏み出す」を検出するため）
    // 2026-10-06（6段階化）：引用の前に段階の書き方（「いちばん低い段階」「いちばん高い段階」）があれば、引用がその記事の項目の L1／L6 の表示文に含まれること。
    // 項目は記事の 'name'（style/*・tendency/* のみ）。「Low判定のうち」「Highのうち」があれば、低い＝Low・高い＝High と対応していること
    // 2026-10-06（M1追加）：「「〜」という前向きな表現で示され」の形も扱う（tendency/kekkonshikou-love・uwakitaisei-love の FAQ）
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/(?:(?:(?<lv>Low判定|High)のうち)?いちばん(?<stage>低い|高い)段階(?:でも|では))?「(?<q>[^」]+)」(?:のように|という)前向きな(?:傾向として表示|表現で示され)/u',
     'expect' => function ($m, string $rel = '', array $a = []) use ($displayTexts) {
        $q = $m['q']; $hit = array_filter($displayTexts(), fn($t) => mb_strpos($t, $q) !== false);
        if (!$hit) return [false, '表示文（inc/love-style-texts.php・love-tendency-texts.php）に含まれない引用'];
        $stage = $m['stage'] ?? ''; if ($stage === '') return [true, ''];
        $lvKey = $stage === '低い' ? 'L1' : 'L6';
        $lv = $m['lv'] ?? ''; if ($lv !== '' && ($lv === 'High') !== ($lvKey === 'L6')) return [false, "「{$lv}のうち」と「いちばん{$stage}段階」が対応しない"];
        $mt = (fnmatch('style/*', $rel) || fnmatch('tendency/*', $rel)) ? (string)($a['name'] ?? '') : '';
        $bank = LOVE_STYLE_TEXTS[$mt] ?? LOVE_TENDENCY_TEXTS[$mt] ?? null;
        if ($bank === null) return [false, '段階を書いた引用だが、記事の項目を特定できない（style/*・tendency/* 以外）'];
        $ok = mb_strpos($bank[$lvKey], $q) !== false;
        return [$ok, "{$mt} {$lvKey}" . ($ok ? 'の表示文に含まれる' : "の表示文に含まれない（{$lvKey}: {$bank[$lvKey]}）")]; }],
    // ---- 経路の「〜からのみ」（全記事共通の意味検査：MBTI以外からも加算されるなら誤り） ----
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/(自立性|変化志向)(?:というプリミティブ)?は、?MBTIの[IP]（[^）]*）からのみ/u',
     'expect' => fn($m) => [count(array_filter(sourcesOf($m[1]), fn($s) => $s['kind'] !== 'mbti')) === 0, "{$m[1]}のMBTI以外の経路=" . implode(',', array_map(fn($s) => $s['key'], array_filter(sourcesOf($m[1]), fn($s) => $s['kind'] !== 'mbti')))]],
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/(自立性|誠実性)[^。]*?E型(?:に|には)(?:一切|全く)寄与し/u',
     'expect' => function ($m) { $n = count(array_filter($GLOBALS['CASES'], fn($c) => $c['m'][0] === 'E' && $c['p'][$m[1]] > 0)); return [$n === 0, "E型で{$m[1]}>0のケース={$n}件（血液型・星座からも加算される）"]; }],
    ['art' => 'style/horeyasusa-love', 'where' => 'formula_explanation', 'required' => false, 're' => '/^変化志向はE\/IやT\/Fの違いには影響されず、もっぱらJ\/P/u',
     'expect' => fn($m) => [false, 'MBTI以外（B型の自由・風・柔軟宮・革新型）からも変化志向は加算される']],
    // ---- style/shinchousa-love ----
    ['art' => 'style/shinchousa-love', 'where' => 'mbti_body', 'required' => true, 're' => '/E（外向）の文字は誠実性・自立性のどちらにも寄与しないため、上位6タイプはすべてI型です（ただしINTP・INFPの([\d.]+)%は、ESTJ・ESFJの([\d.]+)%を下回ります）/u',
     'expect' => function ($m) use ($H) { $hs = []; foreach (TYPES as $t) $hs[$t] = high(['m' => $t], '恋愛の慎重さ'); arsort($hs); $top6 = array_slice(array_keys($hs), 0, 6);
        $ok = array_intersect(letterPrims('E'), ['誠実性', '自立性']) === [] && count(array_filter($top6, fn($t) => $t[0] === 'I')) === 6 && $hs[array_keys($hs)[5]] > $hs[array_keys($hs)[6]]
            && near($m[1], $hs['INTP']) && near($m[1], $hs['INFP']) && near($m[2], $hs['ESTJ']) && near($m[2], $hs['ESFJ']) && (float)$m[1] < (float)$m[2];
        return [$ok, '上位6=' . implode('・', $top6) . ' INTP=' . r1($hs['INTP']) . ' ESTJ=' . r1($hs['ESTJ'])]; }],
    ['art' => 'style/shinchousa-love', 'where' => 'mbti_body', 'required' => false, 're' => '/I型が軒並み上位/u',
     'expect' => function ($m) { $i = []; $e = []; foreach (TYPES as $t) { $v = high(['m' => $t], '恋愛の慎重さ'); if ($t[0] === 'I') $i[] = $v; else $e[] = $v; } return [min($i) > max($e), 'I型の最小=' . r1(min($i)) . ' E型の最大=' . r1(max($e))]; }],
    ['art' => 'style/shinchousa-love', 'where' => 'formula_explanation', 'required' => true, 're' => '/MBTIの4文字の中で自立性を伸ばすのはI（内向・独立由来）だけで、E（外向）の文字は誠実性にも自立性にも加算されません（MBTI以外では、血液型B型や星座の一部の内面タイプからも自立性が加算されます）。そのため、恋愛の慎重さはE\/Iの違いが特に色濃く出る指標です/u',
     'expect' => function ($m) use ($srcKeys) { $mb = $srcKeys('自立性', 'mbti'); $nonM = array_values(array_filter(sourcesOf('自立性'), fn($s) => $s['kind'] !== 'mbti')); $kinds = array_unique(array_column($nonM, 'kind')); sort($kinds);
        return [$mb === ['mbti:I:+1'] && array_intersect(letterPrims('E'), ['誠実性', '自立性']) === [] && $kinds === ['blood', 'innerType'] && array_unique(array_column(array_filter($nonM, fn($s) => $s['kind'] === 'blood'), 'key')) === ['B'], 'MBTI経路=' . implode(',', $mb) . ' MBTI以外=' . implode(',', $kinds)]; }],
    ['art' => 'style/shinchousa-love', 'where' => 'faq', 'required' => true, 're' => '/誠実性・自立性は、MBTIの4文字の中ではI（内向）が両方を伸ばし、E（外向）はどちらも伸ばしません/u',
     'expect' => fn($m) => [count(array_intersect(letterPrims('I'), ['誠実性', '自立性'])) === 2 && array_intersect(letterPrims('E'), ['誠実性', '自立性']) === [], 'I→' . implode('・', letterPrims('I')) . ' E→' . implode('・', letterPrims('E'))]],
    ['art' => 'style/shinchousa-love', 'where' => 'matome', 'required' => true, 're' => '/MBTIの4文字の中で自立性を伸ばすのはIだけ（Eは誠実性・自立性のどちらにも加算されない）のため、E\/Iの違いが特に色濃く出る指標/u',
     'expect' => fn($m) => [array_map(fn($s) => $s['key'], array_values(array_filter(sourcesOf('自立性'), fn($s) => $s['kind'] === 'mbti'))) === ['I'], '']],
    ['art' => 'style/shinchousa-love', 'where' => '*', 'required' => false, 're' => '/E\/Iの違いが最も色濃く/u',
     'expect' => fn($m) => [false, 'ユーザー決定（2026-10-01）で「特に色濃く」に弱めた。指標の取り方しだいで最大にならない（High率の差では積極性の方が大きい）']],
    // ---- style/horeyasusa-love ----
    ['art' => 'style/horeyasusa-love', 'where' => 'formula_explanation', 'required' => true, 're' => '/^MBTIの4文字の中では、変化志向はE\/IやT\/Fの違いには影響されず、もっぱらJ\/P（P型か否か）で決まります。.*ENTPとINTPはどちらもHigh([\d.]+)%で同じ値/u',
     'expect' => fn($m) => [array_map(fn($s) => $s['key'], array_values(array_filter(sourcesOf('変化志向'), fn($s) => $s['kind'] === 'mbti'))) === ['P'] && near($m[1], high(['m' => 'ENTP'], '惚れやすさ')) && near($m[1], high(['m' => 'INTP'], '惚れやすさ')), 'ENTP=' . r1(high(['m' => 'ENTP'], '惚れやすさ')) . ' INTP=' . r1(high(['m' => 'INTP'], '惚れやすさ'))]],
    ['art' => 'style/horeyasusa-love', 'where' => 'faq', 'required' => true, 're' => '/MBTIの4文字の中ではP（知覚）だけが伸ばし、J（判断）からは伸びません（MBTI以外では、血液型B型の「自由」、星座の風・柔軟宮、内面タイプの革新型からも加算されます）/u',
     'expect' => function ($m) use ($srcKeys) { $s = array_map(fn($x) => "{$x['kind']}:{$x['key']}", array_values(array_filter(sourcesOf('変化志向'), fn($x) => $x['kind'] !== 'mbti'))); sort($s); $exp = ['blood:B', 'element:風', 'innerType:革新型', 'quality:柔軟宮']; sort($exp);
        $kw = array_column(array_filter(sourcesOf('変化志向'), fn($x) => $x['kind'] === 'blood'), 'kw');
        return [$s === $exp && $kw === ['自由'] && $srcKeys('変化志向', 'mbti') === ['mbti:P:+2'], 'MBTI以外の経路=' . implode(',', $s)]; }],
    // ---- bundle/autonomy-type ----
    ['art' => 'bundle/autonomy-type', 'where' => 'faq', 'required' => true, 're' => '/自立性が主軸の4通りも、変化志向×自立性（LOVE_TRA_AUT[^）]*）も、同じ共通文（自立性型の文章）を使います。変化志向型の文章が表示されるのは、主軸が変化志向で副軸が行動主導性・誠実性・情動性のケースです/u',
     'expect' => function ($m) { $tid = []; foreach ($GLOBALS['CASES'] as $c) $tid[$c['bid']][$c['tid']] = true;
        $ok = true; foreach (['LOVE_AUT_ACT', 'LOVE_AUT_REL', 'LOVE_AUT_SEN', 'LOVE_AUT_TRA', 'LOVE_TRA_AUT'] as $id) $ok = $ok && array_keys($tid[$id] ?? []) === ['text_aut_shared'];
        foreach (['LOVE_TRA_ACT', 'LOVE_TRA_REL', 'LOVE_TRA_SEN'] as $id) foreach (array_keys($tid[$id] ?? ['-' => 1]) as $t) $ok = $ok && str_starts_with((string)$t, 'text_tra');
        return [$ok, 'TRA_AUT→' . implode(',', array_keys($tid['LOVE_TRA_AUT'] ?? [])) . ' TRA_SEN→' . implode(',', array_keys($tid['LOVE_TRA_SEN'] ?? []))]; }],
    ['art' => 'bundle/autonomy-type', 'where' => 'faq', 'required' => false, 're' => '/変化志向×自立性（LOVE_TRA_AUT[^）]*）は変化志向型の文章を使います/u',
     'expect' => function ($m) { $t = array_unique(array_column(sub(['bid' => 'LOVE_TRA_AUT']), 'tid')); return [count($t) === 1 && str_starts_with($t[0], 'text_tra'), 'LOVE_TRA_AUTの文章ID=' . implode(',', $t)]; }],
    ['art' => 'bundle/autonomy-type', 'where' => 'breakdown_intro', 'required' => true, 're' => '/自立性×行動主導性（LOVE_AUT_ACT）は9216パターン中(\d+)件（INTJ・INTP・ISTPのB型×牡羊座×自由型）/u',
     'expect' => function ($m) { $cs = sub(['bid' => 'LOVE_AUT_ACT']); $d = array_map(fn($c) => "{$c['m']}-{$c['b']}-" . SEIZA_SIGNS[$c['s']]['name'] . '-' . SEIZA_INNER_TYPES[$c['t']]['name'], $cs); sort($d);
        return [count($cs) === (int)$m[1] && $d === ['INTJ-B-牡羊座-自由型', 'INTP-B-牡羊座-自由型', 'ISTP-B-牡羊座-自由型'], implode(',', $d)]; }],
    ['art' => 'bundle/autonomy-type', 'where' => 'bloodSeizaNote', 'required' => true, 're' => '/MBTIのIタイプ（内向）に限られます。血液型別ではB型のみで([\d.]+)%、A型・O型・AB型では0%です。星座別でも天秤座([\d.]+)%が最も高い/u',
     'expect' => function ($m) { $cs = sub(['p1' => 'AUT']); $onlyI = count(array_filter($cs, fn($c) => $c['m'][0] !== 'I')) === 0; $bs = []; foreach (BLOODS as $bt) $bs[$bt] = pct(count(sub(['b' => $bt, 'p1' => 'AUT'])), 2304);
        $ss = []; foreach (range(0, 11) as $i) $ss[$i] = round(pct(count(sub(['s' => $i, 'p1' => 'AUT'])), 768), 1); $mx = max($ss);
        return [$onlyI && near($m[1], $bs['B']) && $bs['A'] + $bs['O'] + $bs['AB'] == 0 && near($m[2], $ss[signIndex('天秤座')]) && $ss[signIndex('天秤座')] == $mx, 'B=' . r1($bs['B']) . ' 天秤座=' . $ss[signIndex('天秤座')] . " 最大=$mx"]; }],
    // ---- bundle/transform-type ----
    ['art' => 'bundle/transform-type', 'where' => 'causal_intro', 'required' => true, 're' => '/ただ1つのtraitからのみ加算されるプリミティブです。同じく1つのtraitからのみ加算される自立性に次いで、加算される経路が限られています/u',
     'expect' => function ($m) { $n = []; foreach (array_keys(P_CODE) as $pj) $n[$pj] = count(sourcesOf($pj)); $oth = $n; unset($oth['自立性'], $oth['変化志向']);
        return [count(traitsOf('変化志向')) === 1 && count(traitsOf('自立性')) === 1 && $n['自立性'] < $n['変化志向'] && $n['変化志向'] < min($oth), '経路数=' . json_encode($n, JSON_UNESCAPED_UNICODE)]; }],
    ['art' => 'bundle/transform-type', 'where' => 'causal_intro', 'required' => false, 're' => '/5つの中でも経路がとりわけ限定的/u',
     'expect' => function ($m) { $n = []; foreach (array_keys(P_CODE) as $pj) $n[$pj] = count(sourcesOf($pj)); return [$n['変化志向'] === min($n) && count(array_keys($n, min($n))) === 1, '経路数=' . json_encode($n, JSON_UNESCAPED_UNICODE)]; }],
    ['art' => 'bundle/transform-type', 'where' => 'bloodSeizaNote', 'required' => true, 're' => '/B型が([\d.]+)%と突出して高く、A型は([\d.]+)%とほぼ存在しません.*星座別では双子座（風・柔軟宮）が([\d.]+)%と最も高く、風・柔軟宮のどちらも持たない(\d+)星座はいずれも([\d.]+)%以下です。地の星座でも、柔軟宮の乙女座は([\d.]+)%です/u',
     'expect' => function ($m) use ($traShareSign) { $bs = []; foreach (BLOODS as $bt) $bs[$bt] = round(pct(count(sub(['b' => $bt, 'p1' => 'TRA'])), 2304), 1);
        $ss = []; foreach (range(0, 11) as $i) $ss[$i] = $traShareSign($i); $gem = signIndex('双子座');
        $none = array_values(array_filter(range(0, 11), fn($i) => SEIZA_SIGNS[$i]['element'] !== 2 && SEIZA_SIGNS[$i]['quality'] !== 2));
        $ok = near($m[1], $bs['B']) && $bs['B'] == max($bs) && near($m[2], $bs['A']) && near($m[3], $ss[$gem]) && $ss[$gem] == max($ss) && count(array_keys($ss, max($ss))) === 1
            && SEIZA_SIGNS[$gem]['element'] === 2 && SEIZA_SIGNS[$gem]['quality'] === 2 && count($none) === (int)$m[4] && max(array_map(fn($i) => $ss[$i], $none)) <= (float)$m[5]
            && SEIZA_SIGNS[signIndex('乙女座')]['element'] === 1 && SEIZA_SIGNS[signIndex('乙女座')]['quality'] === 2 && near($m[6], $ss[signIndex('乙女座')]);
        return [$ok, 'B=' . $bs['B'] . ' A=' . $bs['A'] . ' 星座=' . json_encode(array_combine(array_column(SEIZA_SIGNS, 'name'), $ss), JSON_UNESCAPED_UNICODE)]; }],
    ['art' => 'bundle/transform-type', 'where' => 'bloodSeizaNote', 'required' => false, 're' => '/地のエレメントを持つ星座はいずれも([\d.]+)%程度/u',
     'expect' => function ($m) use ($traShareSign) { $bad = []; foreach (range(0, 11) as $i) if (SEIZA_SIGNS[$i]['element'] === 1 && abs($traShareSign($i) - (float)$m[1]) > 0.15) $bad[] = SEIZA_SIGNS[$i]['name'] . $traShareSign($i); return [$bad === [], $bad ? '外れ: ' . implode(',', $bad) : '']; }],
    // ---- mbti/* 個別 ----
    ['art' => 'mbti/esfj', 'where' => 'tendencies.浮気耐性.note', 'required' => true, 're' => '/High([\d.]+)%と、誠実性がS単独のESFP（High([\d.]+)%）より高くなります（最も多いのはMidの([\d.]+)%）/u',
     'expect' => fn($m) => [near($m[1], high(['m' => 'ESFJ'], '浮気耐性')) && near($m[2], high(['m' => 'ESFP'], '浮気耐性')) && (float)$m[1] > (float)$m[2] && typeContribLetters('ESFP', '誠実性') === ['S'] && modal(lvDist(sub(['m' => 'ESFJ']), '浮気耐性')) === ['Mid'], 'ESFJ=' . fmtD(lvDist(sub(['m' => 'ESFJ']), '浮気耐性'))]],
    ['art' => 'mbti/estj', 'where' => 'styles.恋愛の慎重さ.note', 'required' => true, 're' => '/High([\d.]+)%と、誠実性がS単独のESTP（([\d.]+)%）を上回ります（最も多いのはMidの([\d.]+)%）/u',
     'expect' => fn($m) => [near($m[1], high(['m' => 'ESTJ'], '恋愛の慎重さ')) && near($m[2], high(['m' => 'ESTP'], '恋愛の慎重さ')) && typeContribLetters('ESTP', '誠実性') === ['S'] && modal(lvDist(sub(['m' => 'ESTJ']), '恋愛の慎重さ')) === ['Mid'], 'ESTJ=' . fmtD(lvDist(sub(['m' => 'ESTJ']), '恋愛の慎重さ'))]],
    ['art' => 'mbti/estj', 'where' => 'tendencies.結婚志向.note', 'required' => true, 're' => '/Lowは([\d.]+)%にとどまり、High([\d.]+)%・Mid([\d.]+)%に集まります/u',
     'expect' => function ($m) { $d = lvDist(sub(['m' => 'ESTJ']), '結婚志向'); return [near($m[1], $d['Low']) && near($m[2], $d['High']) && near($m[3], $d['Mid']) && $d['Low'] < min($d['High'], $d['Mid']), fmtD($d)]; }],
    ['art' => 'mbti/esfp', 'where' => 'tendencies.浮気耐性.note', 'required' => true, 're' => '/どちらも単独寄与（S・E）で、Lowが([\d.]+)%と半数を超えます（S・J二重のESFJはLow([\d.]+)%）/u',
     'expect' => function ($m) { $d = lvDist(sub(['m' => 'ESFP']), '浮気耐性'); return [near($m[1], $d['Low']) && $d['Low'] > 50 && near($m[2], lvDist(sub(['m' => 'ESFJ']), '浮気耐性')['Low']) && typeContribLetters('ESFP', '誠実性') === ['S'] && typeContribLetters('ESFP', '行動主導性') === ['E'] && typeContribLetters('ESFJ', '誠実性') === ['S', 'J'], fmtD($d)]; }],
    ['art' => 'mbti/estp', 'where' => 'styles.独占欲.note', 'required' => true, 're' => '/全16タイプ中の最低値で、ISTP・ESTJ・ISTJと同率の([\d.]+)%/u',
     'expect' => function ($m) { $hs = []; foreach (TYPES as $t) $hs[$t] = round(high(['m' => $t], '独占欲'), 1); $mn = min($hs); $act = array_keys($hs, $mn); sort($act); return [$act === ['ESTJ', 'ESTP', 'ISTJ', 'ISTP'] && near($m[1], $mn), '最低値=' . $mn . ' ' . implode('・', $act)]; }],
    ['art' => 'mbti/istp', 'where' => 'styles.独占欲.note', 'required' => true, 're' => '/全16タイプ中の最低値で、ESTP・ESTJ・ISTJと同率の([\d.]+)%/u',
     'expect' => function ($m) { $hs = []; foreach (TYPES as $t) $hs[$t] = round(high(['m' => $t], '独占欲'), 1); $mn = min($hs); $act = array_keys($hs, $mn); sort($act); return [$act === ['ESTJ', 'ESTP', 'ISTJ', 'ISTP'] && near($m[1], $mn), '最低値=' . $mn . ' ' . implode('・', $act)]; }],
    ['art' => 'mbti/infj', 'where' => 'styles.嫉妬深さ.note', 'required' => true, 're' => '/どちらも二重に伸びますが、情動性の係数の方が大きいため打ち消し合いきらず、High([\d.]+)%が最も多くなります/u',
     'expect' => function ($m) { $d = lvDist(sub(['m' => 'INFJ']), '嫉妬深さ'); $fo = formulaOf('嫉妬深さ'); return [near($m[1], $d['High']) && modal($d) === ['High'] && abs($fo['情動性']) > abs($fo['誠実性']) && count(typeContribLetters('INFJ', '情動性')) === 2 && count(typeContribLetters('INFJ', '誠実性')) === 2, fmtD($d)]; }],
    ['art' => 'mbti/intj', 'where' => 'matome', 'required' => true, 're' => '/Iの慎重さ由来の誠実性寄与とJの責任感由来の誠実性寄与が重なる二重構造（((?:[EI][NS][TF][JP])(?:・[EI][NS][TF][JP])*)にも共通）/u',
     'expect' => function ($m) { $act = array_values(array_filter(TYPES, fn($t) => $t !== 'INTJ' && str_contains($t, 'I') && str_contains($t, 'J'))); sort($act); $cl = explode('・', $m[1]); sort($cl); return [$cl === $act, 'I・Jを持つ他タイプ=' . implode('・', $act)]; }],
    ['art' => 'mbti/intj', 'where' => '*', 'required' => false, 're' => '/Iの慎重さ由来の誠実性寄与とJの責任感由来の誠実性寄与が重なる、([EI][NS][TF][JP])だけの二重構造/u',
     'expect' => function ($m) { $act = array_values(array_filter(TYPES, fn($t) => str_contains($t, 'I') && str_contains($t, 'J'))); return [$act === [$m[1]], 'I・Jを持つタイプ=' . implode('・', $act)]; }],
    ['art' => 'mbti/infp', 'where' => 'styles.積極性.note', 'required' => true, 're' => '/ENTP\/INTP\/ENFP\/INFPの4タイプの中で、そのどちらも持たないのはINFPだけです。そのため、この4タイプの中で最もLowに偏ります/u',
     'expect' => function ($m) { $four = ['ENTP', 'INTP', 'ENFP', 'INFP']; $noET = array_values(array_filter($four, fn($t) => !str_contains($t, 'E') && !str_contains($t, 'T'))); $lows = []; foreach ($four as $t) $lows[$t] = lvDist(sub(['m' => $t]), '積極性')['Low'];
        return [$noET === ['INFP'] && max($lows) === $lows['INFP'] && count(array_keys($lows, max($lows))) === 1, 'Low=' . json_encode(array_map('r1', $lows))]; }],
    ['art' => 'mbti/infp', 'where' => '*', 'required' => false, 're' => '/INFPはそのどちらも持たない唯一のタイプ/u',
     'expect' => function ($m) { $noET = array_values(array_filter(TYPES, fn($t) => !str_contains($t, 'E') && !str_contains($t, 'T'))); return [$noET === ['INFP'], 'E・Tを持たないタイプ=' . implode('・', $noET)]; }],
    ['art' => 'mbti/infp', 'where' => 'matome', 'required' => true, 're' => '/情動性にはN・Fが二重に寄与するため、独占欲（High([\d.]+)%）・惚れやすさ（High([\d.]+)%）ではHighが目立つ。誠実性への寄与はIのみのため、恋愛の慎重さはLowが([\d.]+)%を占める/u',
     'expect' => function ($m) { $f = ['m' => 'INFP']; $a = lvDist(sub($f), '独占欲'); $b = lvDist(sub($f), '惚れやすさ'); $c = lvDist(sub($f), '恋愛の慎重さ');
        return [typeContribLetters('INFP', '情動性') === ['N', 'F'] && typeContribLetters('INFP', '誠実性') === ['I'] && near($m[1], $a['High']) && modal($a) === ['High'] && near($m[2], $b['High']) && modal($b) === ['High'] && near($m[3], $c['Low']) && modal($c) === ['Low'], '独占欲' . fmtD($a) . ' 惚れやすさ' . fmtD($b) . ' 慎重さ' . fmtD($c)]; }],
    ['art' => 'mbti/infp', 'where' => 'matome', 'required' => false, 're' => '/((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ))+)ではHighが目立つ/u',
     'expect' => function ($m) { $bad = []; foreach (explode('・', $m[1]) as $mt) { $d = lvDist(sub(['m' => 'INFP']), $mt); if (modal($d) !== ['High']) $bad[] = "$mt " . fmtD($d); } return [$bad === [], implode(' / ', $bad)]; }],
    ['art' => 'mbti/intp', 'where' => 'styles.恋愛の慎重さ.note', 'required' => true, 're' => '/積極性と並んで、E\/Iの違いが大きく表れる指標です（ENTPと比べてLowが([\d.]+)ポイント下がり、積極性のHighの低下([\d.]+)ポイントと同程度）/u',
     'expect' => function ($m) use ($H) { $dl = round(lvDist(sub(['m' => 'ENTP']), '恋愛の慎重さ')['Low'], 1) - round(lvDist(sub(['m' => 'INTP']), '恋愛の慎重さ')['Low'], 1); $dh = $H(['m' => 'ENTP'], '積極性') - $H(['m' => 'INTP'], '積極性');
        return [near($m[1], $dl) && near($m[2], $dh), 'Low差=' . r1($dl) . ' 積極性High差=' . r1($dh)]; }],
    ['art' => 'mbti/intp', 'where' => 'styles.恋愛の慎重さ.note', 'required' => false, 're' => '/E\/Iの違いが最も顕著/u',
     'expect' => function ($m) use ($tvEI, $METRICS) { $tv = []; foreach ($METRICS as $mt) $tv[$mt] = $tvEI($mt, ['m' => 'ENTP'], ['m' => 'INTP']); arsort($tv); return [array_key_first($tv) === '恋愛の慎重さ', 'ENTP→INTPの分布差 最大=' . array_key_first($tv) . ' ' . r1(reset($tv)) . ' 恋愛の慎重さ=' . r1($tv['恋愛の慎重さ'])]; }],
    // INTP 積極性の注記（2026-10-01修正）：ENTPとの違いは E（外向）による行動主導性への加算の有無だけ。I の寄与先（誠実性・自立性）は積極性の式に入らない
    ['art' => 'mbti/intp', 'where' => 'styles.積極性.note', 'required' => true, 're' => '/^行動主導性（Tから）と情動性（Nから）で決まる指標です。ENTPとの違いは、E（外向）による行動主導性への加算がないことで（Iが寄与する誠実性・自立性は積極性の式に含まれません）、Highに偏らずMid〜Lowにも幅広く分布しています。ENTP（High([\d.]+)%）と比べるとHighの割合は大きく下がります/u',
     'expect' => function ($m) { $fo = formulaOf('積極性'); $iP = letterPrims('I'); $dI = lvDist(sub(['m' => 'INTP']), '積極性'); $hE = high(['m' => 'ENTP'], '積極性');
        $ok = array_keys($fo) === ['行動主導性', '情動性'] && typeContribLetters('INTP', '行動主導性') === ['T'] && typeContribLetters('INTP', '情動性') === ['N']
            && letterPrims('E') === ['行動主導性'] && array_intersect($iP, array_keys($fo)) === [] && typeContribLetters('ENTP', '行動主導性') === ['E', 'T']
            && near($m[1], $hE) && $dI['High'] < $hE && modal($dI) !== ['High'];
        return [$ok, '式=' . implode('・', array_keys($fo)) . ' Iの寄与先=' . implode('・', $iP) . ' INTP' . fmtD($dI) . ' ENTP High=' . r1($hE)]; }],
    ['art' => 'mbti/intp', 'where' => 'styles.積極性.note', 'required' => false, 're' => "/Iによる($PRIM_RE(?:・$PRIM_RE)*)への寄与も加わるため/u",
     'expect' => function ($m) { $bad = array_values(array_filter(explode('・', $m[1]), fn($p) => !isset(formulaOf('積極性')[$p]))); return [$bad === [], $bad ? implode('・', $bad) . 'は積極性の式（' . implode('・', array_keys(formulaOf('積極性'))) . '）に含まれない' : '']; }],
    ['art' => 'mbti/estp', 'where' => 'topBundle.note', 'required' => true, 're' => '/行動主導性が主軸のケースは([\d.]+)%（副軸が誠実性・情動性・変化志向などに分かれる）で、誠実性が主軸のケース（([\d.]+)%）の約2倍です。誠実性が主軸になる(\d+)件のうち(\d+)件はA型との組み合わせです/u',
     'expect' => function ($m) { $cs = sub(['m' => 'ESTP']); $act = count(sub(['m' => 'ESTP', 'p1' => 'ACT'])); $rel = sub(['m' => 'ESTP', 'p1' => 'REL']); $relA = count(array_filter($rel, fn($c) => $c['b'] === 'A'));
        $ratio = $act / max(1, count($rel)); return [near($m[1], pct($act, 576)) && near($m[2], pct(count($rel), 576)) && $ratio >= 1.9 && $ratio < 2.2 && (int)$m[3] === count($rel) && (int)$m[4] === $relA, "ACT主軸=$act REL主軸=" . count($rel) . " うちA型=$relA"]; }],
    ['art' => 'mbti/estp', 'where' => 'topBundle.note', 'required' => false, 're' => '/誠実性が主軸になる場合がやや多い/u',
     'expect' => function ($m) { $a = count(sub(['m' => 'ESTP', 'p1' => 'ACT'])); $r = count(sub(['m' => 'ESTP', 'p1' => 'REL'])); return [$r > $a, "主軸の件数 誠実性=$r 行動主導性=$a"]; }],
    // ---- seiza/* 個別 ----
    ['art' => 'seiza/virgo', 'where' => 'tendencies.結婚志向.note', 'required' => true, 're' => '/^誠実性×0\.7－変化志向×0\.3で決まる指標です。地由来の誠実性がプラスに働くため、柔軟宮由来の変化志向（計算式ではマイナス）があっても全体平均（([\d.]+)%）をやや上回ります/u',
     // 2026-10-07：「を上回ります」→「をやや上回ります」（差 +7.0。修飾なしは 10〜20 ポイント。5e 節）。程度（差 10 未満）もここで照合する
     'expect' => function ($m) { $fo = formulaOf('結婚志向'); $si = signIndex('乙女座'); $d = high(['s' => $si], '結婚志向') - high([], '結婚志向');
        return [abs(($fo['誠実性'] ?? 0) - 0.7) < 1e-9 && abs(($fo['変化志向'] ?? 0) + 0.3) < 1e-9 && count($fo) === 2 && SEIZA_SIGNS[$si]['element'] === 1 && SEIZA_SIGNS[$si]['quality'] === 2 && near($m[1], high([], '結婚志向')) && $d > 0 && $d < 10, '乙女座=' . r1(high(['s' => $si], '結婚志向')) . ' 全体=' . r1(high([], '結婚志向')) . sprintf('（差%+.1f）', $d)]; }],
    // 2026-10-07（Reviewer M-2）：浮気耐性（差 +3.1）を「やや高く」、愛情表現（山羊座側 +4.7）を「やや」つきで積極性（+11.2、修飾なし）と分けた。程度は fixed-20261007b と 5e で照合する
    ['art' => 'seiza/virgo', 'where' => 'faq', 'required' => true, 're' => '/恋愛の慎重さは完全に同じ数値になります。.*行動主導性がマイナスに働く浮気耐性では乙女座の方がやや高く（High([\d.]+)%・山羊座([\d.]+)%）、プラスに働く積極性（山羊座([\d.]+)%・乙女座([\d.]+)%）では山羊座の方が高く、愛情表現（山羊座([\d.]+)%・乙女座([\d.]+)%）でも山羊座の方がやや高くなります/u',
     'expect' => function ($m) { $v = ['s' => signIndex('乙女座')]; $c = ['s' => signIndex('山羊座')];
        $ok = lvDist(sub($v), '恋愛の慎重さ')['raw'] === lvDist(sub($c), '恋愛の慎重さ')['raw'] && formulaOf('浮気耐性')['行動主導性'] < 0 && formulaOf('積極性')['行動主導性'] > 0 && formulaOf('愛情表現')['行動主導性'] > 0
            && near($m[1], high($v, '浮気耐性')) && near($m[2], high($c, '浮気耐性')) && (float)$m[1] > (float)$m[2]
            && near($m[3], high($c, '積極性')) && near($m[4], high($v, '積極性')) && (float)$m[3] > (float)$m[4]
            && near($m[5], high($c, '愛情表現')) && near($m[6], high($v, '愛情表現')) && (float)$m[5] > (float)$m[6];
        return [$ok, "浮気耐性 乙女" . r1(high($v, '浮気耐性')) . '/山羊' . r1(high($c, '浮気耐性')) . " 積極性 山羊" . r1(high($c, '積極性')) . '/乙女' . r1(high($v, '積極性'))]; }],
    ['art' => 'seiza/virgo', 'where' => 'faq', 'required' => false, 're' => '/浮気耐性など行動主導性が絡む指標では乙女座の方が高く/u',
     'expect' => function ($m) { $bad = []; foreach ($GLOBALS['METRICS'] as $mt) if (isset(formulaOf($mt)['行動主導性']) && high(['s' => signIndex('乙女座')], $mt) <= high(['s' => signIndex('山羊座')], $mt)) $bad[] = $mt; return [$bad === [], '乙女座の方が高くない指標=' . implode('・', $bad)]; }],
    // 2026-10-06：積極性・愛情表現が同じになる理由に「どちらも情動性へ寄与しない」を加えた（式に情動性が入るため、行動主導性の強さが同じだけでは理由として不足）。
    // 情動性への寄与がゼロであることは inc の星座マッピングから、2星座の分布が同じことはスナップショットから確かめる（$libCapSenZero）
    ['art' => 'seiza/capricorn', 'where' => 'mbti_intro', 'required' => true, 're' => '/天秤座と同じ数値になります（積極性([\d.]+)%・独占欲([\d.]+)%等）。積極性・愛情表現は、活動宮由来の行動主導性が同じ強さで、どちらも情動性へ寄与しないため、独占欲は、どちらも情動性・自立性へ寄与しないためです（独占欲は地・風の6星座すべてで同じ値）/u',
     'expect' => function ($m) use ($capLibSameAct, $dokusenSame, $libCapSenZero) { [$z, $zd] = $libCapSenZero(); return [$z && $capLibSameAct() && $dokusenSame() && near($m[1], high(['s' => signIndex('山羊座')], '積極性')) && near($m[2], high(['s' => signIndex('山羊座')], '独占欲')), $zd]; }],
    ['art' => 'seiza/capricorn', 'where' => 'faq', 'required' => true, 're' => '/積極性・愛情表現は、どちらもクオリティ（活動宮）が共通しており行動主導性への寄与が同じ強さで、どちらも情動性へ寄与しないから、独占欲は、どちらも情動性・自立性へ寄与しないからです（独占欲は地・風の6星座すべてで同じ値）/u',
     'expect' => function ($m) use ($capLibSameAct, $dokusenSame, $libCapSenZero) { [$z, $zd] = $libCapSenZero(); return [$z && $capLibSameAct() && $dokusenSame(), $zd]; }],
    ['art' => 'seiza/libra', 'where' => 'mbti_intro', 'required' => true, 're' => '/積極性・愛情表現は、活動宮由来の行動主導性が同じ強さで、どちらも情動性へ寄与しないため、独占欲は、どちらも情動性・自立性へ寄与しないためです（独占欲は地・風の6星座すべてで同じ値）/u',
     'expect' => function ($m) use ($capLibSameAct, $dokusenSame, $libCapSenZero) { [$z, $zd] = $libCapSenZero(); return [$z && $capLibSameAct() && $dokusenSame(), $zd]; }],
    ['art' => 'seiza/libra', 'where' => 'faq', 'required' => true, 're' => '/独占欲は情動性・自立性で決まる指標で、どちらの星座も情動性・自立性へ寄与しないため同じ数値になります（地・風の6星座すべてで同じ値）/u',
     'expect' => fn($m) => [$capLibSameAct() && $dokusenSame(), '']],
    ['art' => 'seiza/libra', 'where' => 'matome', 'required' => true, 're' => '/積極性・愛情表現は行動主導性への寄与の強さが山羊座と同じで、どちらも情動性へ寄与しないため、独占欲はどちらも情動性・自立性へ寄与しないため、山羊座と完全に同じ数値になる/u',
     'expect' => function ($m) use ($capLibSameAct, $dokusenSame, $libCapSenZero) { [$z, $zd] = $libCapSenZero(); return [$z && $capLibSameAct() && $dokusenSame(), $zd]; }],
    // 天秤座 causal_explanation（2026-10-01修正、同日再修正）：積極性・愛情表現は行動主導性と情動性、独占欲は情動性と自立性で決まる。
    // 両星座は活動宮で行動主導性への寄与が同じ、情動性・自立性へはどちらも寄与しない（地・風・活動宮のいずれも情動性・自立性へ加算しない）。誠実性が主軸の指標では差
    ['art' => 'seiza/libra', 'where' => 'causal_explanation', 'required' => true, 're' => '/風は「知性・変化」という特性を通じて変化志向に、活動宮は「行動を起こすイニシアチブ」という特性を通じて行動主導性に、それぞれ寄与します。積極性・愛情表現は行動主導性と情動性、独占欲は情動性と自立性で決まる指標です。天秤座と山羊座は、同じ活動宮のため行動主導性への寄与の強さが同じで、情動性・自立性へはどちらも寄与しないため（独占欲は地・風の6星座すべてで同じ値）、これらの指標は山羊座と完全に同じ数値になります。一方、山羊座が誠実性（地）を持つのに対し天秤座は変化志向（風）を持つため、誠実性が主軸の指標では差が生まれます/u',
     'expect' => function ($m) use ($capLibSameAct, $dokusenSame, $srcKeys, $libCapFormulaOk) {
        if (!$libCapFormulaOk()) return [false, '式または情動性・自立性への寄与が記事の説明と異なる: ' . formulaStr('積極性') . ' ' . formulaStr('愛情表現') . ' ' . formulaStr('独占欲')];
        $li = signIndex('天秤座'); $ci = signIndex('山羊座');
        $relMain = array_values(array_filter($GLOBALS['METRICS'], function ($mt) { $fo = formulaOf($mt); if (!isset($fo['誠実性'])) return false; foreach ($fo as $w) if (abs($w) > abs($fo['誠実性'])) return false; return true; }));
        $diff = []; foreach ($relMain as $mt) $diff[$mt] = lvDist(sub(['s' => $li]), $mt)['raw'] !== lvDist(sub(['s' => $ci]), $mt)['raw'];
        $ok = SEIZA_SIGNS[$li]['element'] === 2 && SEIZA_SIGNS[$li]['quality'] === 0 && SEIZA_SIGNS[$ci]['element'] === 1 && SEIZA_SIGNS[$ci]['quality'] === 0
            && in_array('element:風:+1', $srcKeys('変化志向', 'element'), true) && in_array('quality:活動宮:+1', $srcKeys('行動主導性', 'quality'), true)
            && in_array('element:地:+2', $srcKeys('誠実性', 'element'), true) && !array_filter(sourcesOf('行動主導性'), fn($s) => $s['kind'] === 'element' && in_array($s['key'], ['地', '風'], true))
            && $capLibSameAct() && $dokusenSame() && $relMain !== [] && !in_array(false, $diff, true);
        $hi = []; foreach ($relMain as $mt) $hi[] = "$mt 天秤" . r1(high(['s' => $li], $mt)) . '/山羊' . r1(high(['s' => $ci], $mt));
        return [$ok, '誠実性が主軸の指標: ' . implode(' ', $hi) . ' 積極性High=' . r1(high(['s' => $li], '積極性')) . '/' . r1(high(['s' => $ci], '積極性')) . ' 独占欲High=' . r1(high(['s' => $li], '独占欲')) . '/' . r1(high(['s' => $ci], '独占欲'))]; }],
    ['art' => 'seiza/libra', 'where' => 'causal_explanation', 'required' => false, 're' => '/行動主導性への寄与の強さ[^。]*同じです。そのため((?:積極性|愛情表現|独占欲)(?:・(?:積極性|愛情表現|独占欲))+)は山羊座と完全に同じ数値/u', 'expect' => $actReasonExpect],
    // 旧文（2026-10-01再修正前）：積極性・愛情表現が同じ理由を行動主導性だけで説明していた。式には情動性も入るため、理由として不足
    ['art' => 'seiza/libra', 'where' => 'causal_explanation', 'required' => false, 're' => '/((?:積極性|愛情表現)(?:・(?:積極性|愛情表現))*)は、同じ活動宮を持つ山羊座と行動主導性への寄与の強さが同じため/u',
     'expect' => function ($m) { $bad = []; foreach (explode('・', $m[1]) as $mt) if (array_keys(formulaOf($mt)) !== ['行動主導性']) $bad[] = formulaStr($mt); return [$bad === [], $bad ? '式に行動主導性以外も含まれる（同じ数値になる理由として、情動性への寄与も同じ＝どちらもゼロであることが必要）: ' . implode(' ', $bad) : '']; }],
    // 天秤座 FAQ（2026-10-01修正）：旧文「積極性・愛情表現は、行動主導性というプリミティブへの依存度が高い指標」は愛情表現（情動性×0.7）で誤り。旧文の検出は 5b の dependsHigh-prim が担う
    ['art' => 'seiza/libra', 'where' => 'faq', 'required' => true, 're' => '/積極性・愛情表現は、行動主導性と情動性で決まる指標です。天秤座と山羊座はどちらもクオリティが活動宮で行動主導性への寄与の強さが同じであるうえ、どちらの星座も情動性へは寄与しないため、これらの指標では同じ数値になります/u',
     'expect' => fn($m) => [$libCapFormulaOk() && $capLibSameAct(), formulaStr('積極性') . ' ' . formulaStr('愛情表現')]],
    // 「(指標の列挙)が同じなのは行動主導性（活動宮）のため」：列挙した指標の式に行動主導性が含まれるか（seiza全体）
    ['art' => 'seiza/*', 'where' => '*', 'required' => false, 'rule' => 'ACT-reason', 're' => '/((?:積極性|愛情表現|独占欲|包容力|惚れやすさ|嫉妬深さ|恋愛の慎重さ)(?:・(?:積極性|愛情表現|独占欲|包容力|惚れやすさ|嫉妬深さ|恋愛の慎重さ))+)は、[^。]*同じ数値になります(?:（[^）]*）)?。これは、行動主導性が活動宮由来/u', 'expect' => $actReasonExpect],
    ['art' => 'seiza/*', 'where' => '*', 'required' => false, 'rule' => 'ACT-reason', 're' => '/((?:積極性|愛情表現|独占欲)(?:・(?:積極性|愛情表現|独占欲))+)については同じ数値になります。どちらもクオリティ（活動宮）が共通しており、行動主導性/u', 'expect' => $actReasonExpect],
    ['art' => 'seiza/*', 'where' => '*', 'required' => false, 'rule' => 'ACT-reason', 're' => '/((?:積極性|愛情表現|独占欲)(?:・(?:積極性|愛情表現|独占欲))+)は、行動主導性というプリミティブへの依存度が高い指標/u', 'expect' => $actReasonExpect],
    ['art' => 'seiza/*', 'where' => '*', 'required' => false, 'rule' => 'ACT-reason', 're' => '/行動主導性への寄与の強さ(?:が|は、)[^。]*?同じ(?:です。そのため|ため、)((?:積極性|愛情表現|独占欲)(?:・(?:積極性|愛情表現|独占欲))+)は/u', 'expect' => $actReasonExpect],
    // 旧文（2026-10-06修正前の天秤座・山羊座）：積極性・愛情表現が同じ理由を「行動主導性が同じ強さ」だけで説明していた。式に情動性も入るため理由として不足
    ['art' => 'seiza/*', 'where' => '*', 'required' => false, 're' => '/積極性・愛情表現は[^。]*?行動主導性(?:への寄与)?(?:の強さ)?が(?:山羊座と|天秤座と)?同じ(?:強さ)?(?:のため|ため|だから)、独占欲/u',
     'expect' => function ($m) { $bad = []; foreach (['積極性', '愛情表現'] as $mt) if (array_keys(formulaOf($mt)) !== ['行動主導性']) $bad[] = formulaStr($mt); return [$bad === [], $bad ? '式に行動主導性以外も含まれる（同じ数値になる理由として、情動性への寄与も同じ＝どちらもゼロであることが必要）: ' . implode(' ', $bad) : '']; }],

    // ---- 2026-10-06 記事の誤りのまとめ修正 ----
    // blood/ab-love：O型と同じ数値になるのは「行動主導性を含まない指標」（AB型とO型の違いは行動主導性への寄与（O型2・AB型1）だけ）
    ['art' => 'blood/ab-love', 'where' => 'causal_explanation', 'required' => true, 're' => '/行動主導性を含まない指標（((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性))*)）は、行動主導性以外の寄与がO型と同じため、O型と完全に同じ数値/u',
     'expect' => $abNoActExpect],
    ['art' => 'blood/ab-love', 'where' => 'faq.0.a', 'required' => true, 're' => '/行動主導性を含まない指標（((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性))*)）は、行動主導性以外の寄与がO型と同じため完全に同じ数値/u',
     'expect' => $abNoActExpect],
    // 旧文：「情動性が主軸（になる）の指標（列挙）」。列挙した指標すべてで情動性が最大の正の重みなら成り立つ
    // 2026-10-06（ab-love 2回目）：「情動性が主軸の6指標（列挙）」のように数字が入った形も拾う（数字があれば列挙の個数とも照合）
    ['art' => 'blood/*', 'where' => '*', 'required' => false, 're' => '/情動性が主軸(?:に(?:なる)?|の)(?:(\d+)つの|(\d+))?指標（((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性))*)）/u',
     'expect' => function ($m) {
        $list = explode('・', $m[3]); $n = ($m[1] ?? '') !== '' ? (int)$m[1] : (($m[2] ?? '') !== '' ? (int)$m[2] : null);
        $bad = array_values(array_filter($list, fn($mt) => dominantPrim($mt) !== '情動性'));
        $cntOk = $n === null || $n === count($list);
        return [$bad === [] && $cntOk, ($bad ? '情動性が最大の重みでない: ' . implode(' ', array_map('formulaStr', $bad)) : '') . ($cntOk ? '' : " 個数={$n} 列挙=" . count($list))]; }],
    // mbti/enfj：独占欲は情動性・自立性で決まる。ENFPと変わらないのは、行動主導性・情動性への寄与が同じで、自立性へはJ/Pのどちらも寄与しないため
    ['art' => 'mbti/enfj', 'where' => 'causal_explanation', 'required' => true, 're' => '/積極性・愛情表現は行動主導性・情動性、独占欲は情動性・自立性で決まる指標です。行動主導性・情動性への寄与はENFPと同じで、自立性への寄与もJ\/Pの違いでは変わらない（どちらも自立性へは寄与しない）ため、これらの指標はENFPと変わりません/u',
     'expect' => function ($m) use ($fset) {
        $same = []; foreach (['積極性', '愛情表現', '独占欲'] as $mt) $same[$mt] = lvDist(sub(['m' => 'ENFJ']), $mt)['raw'] === lvDist(sub(['m' => 'ENFP']), $mt)['raw'];
        $ok = $fset('積極性') === ['情動性', '行動主導性'] && $fset('愛情表現') === ['情動性', '行動主導性'] && $fset('独占欲') === ['情動性', '自立性']
            && typeContribLetters('ENFJ', '行動主導性') === typeContribLetters('ENFP', '行動主導性') && typeContribLetters('ENFJ', '情動性') === typeContribLetters('ENFP', '情動性')
            && typeContribLetters('ENFJ', '自立性') === [] && typeContribLetters('ENFP', '自立性') === [] && !in_array(false, $same, true);
        return [$ok, formulaStr('独占欲') . ' 自立性への寄与 ENFJ=' . implode('', typeContribLetters('ENFJ', '自立性')) . ' ENFP=' . implode('', typeContribLetters('ENFP', '自立性')) . ' 分布が同じ=' . json_encode($same, JSON_UNESCAPED_UNICODE)]; }],
    // 旧文：「行動主導性・情動性のみで決まる指標（列挙）」。列挙した指標の式がすべて行動主導性・情動性だけなら成り立つ
    ['art' => 'mbti/*', 'where' => '*', 'required' => false, 're' => '/行動主導性・情動性のみで決まる指標（((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性))*)）/u',
     'expect' => function ($m) use ($fset) { $bad = array_values(array_filter(explode('・', $m[1]), fn($mt) => array_diff($fset($mt), ['情動性', '行動主導性']) !== [])); return [$bad === [], $bad ? implode(' ', array_map('formulaStr', $bad)) : '']; }],
    // mbti/isfp：恋愛の慎重さは誠実性・自立性、結婚志向は誠実性・変化志向で決まり、どちらもT/Fからは加算されない
    ['art' => 'mbti/isfp', 'where' => 'faq', 'required' => true, 're' => '/恋愛の慎重さは誠実性・自立性、結婚志向は誠実性・変化志向で決まり、どちらもT\/Fからは加算されないため、T\/Fの違いに影響されず両者で完全に同じ分布になります/u',
     'expect' => function ($m) use ($fset) {
        $tf = array_merge(letterPrims('T'), letterPrims('F'));
        $same = []; foreach (['恋愛の慎重さ', '結婚志向'] as $mt) $same[$mt] = lvDist(sub(['m' => 'ISFP']), $mt)['raw'] === lvDist(sub(['m' => 'ISTP']), $mt)['raw'];
        $ok = $fset('恋愛の慎重さ') === ['自立性', '誠実性'] && $fset('結婚志向') === ['変化志向', '誠実性'] && array_intersect($tf, ['誠実性', '自立性', '変化志向']) === [] && !in_array(false, $same, true);
        return [$ok, 'T/Fの寄与先=' . implode('・', array_unique($tf)) . ' 分布が同じ=' . json_encode($same, JSON_UNESCAPED_UNICODE)]; }],
    ['art' => 'mbti/*', 'where' => '*', 'required' => false, 're' => '/(恋愛の慎重さ・結婚志向)は(誠実性・変化志向)のみで決ま/u',
     'expect' => function ($m) use ($fset) { $cl = explode('・', $m[2]); $bad = array_values(array_filter(explode('・', $m[1]), fn($mt) => array_diff($fset($mt), $cl) !== [])); return [$bad === [], $bad ? implode(' ', array_map('formulaStr', $bad)) : '']; }],
    // style/sekkyokusei-love：境目は P33・P67 だが、実際の割合は均等にならない（スナップショットから再計算）
    ['art' => 'style/sekkyokusei-love', 'where' => 'normalizer_body', 'required' => true, 're' => '/実際の割合はHigh([\d.]+)%・Mid([\d.]+)%・Low([\d.]+)%と、ちょうど3分の1ずつにはなりません/u',
     'expect' => function ($m) { $d = lvDist(sub([]), '積極性'); $uneven = abs($d['High'] - 100 / 3) > 0.5 || abs($d['Mid'] - 100 / 3) > 0.5 || abs($d['Low'] - 100 / 3) > 0.5;
        return [near($m[1], $d['High']) && near($m[2], $d['Mid']) && near($m[3], $d['Low']) && $uneven, '積極性 ' . fmtD($d)]; }],
    // 旧文：境目を「均等な3分割を狙う／狙ったものではない」と説明（2026-10-06修正前の kekka-no-mikata・sekkyokusei-love）
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/均等な3分割を狙/u',
     'expect' => fn($m) => [false, '境目は実測データの下から3分の1・3分の2の位置（P33・P67）。割合が均等にならないのは同じ値の人がまとまっているため']],
    // 旧文：結果画面の表示内容（2026-10-06修正前の kekka-no-mikata・primitive-guide）。画面に出るのは入力の組み合わせ・恋愛タイプの解説文・「恋愛スタイル」「推定される傾向」の各項目（表示名・一行説明・解説文）・関連記事
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/のみが表示されます/u',
     'expect' => fn($m) => [false, '結果画面の表示内容の説明として不正確（love.php renderResult）']],
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/表示されるのは[^。]*Style・Tendency・Bundleです/u',
     'expect' => fn($m) => [false, '結果画面に Style・Tendency・Bundle という名前の項目は出ない（love.php renderResult）']],
    // 旧文：正式な項目名が画面に出ると読める書き方（2026-10-06修正前の style-guide・tendency-guide）。画面は表示名（inc/love-display-labels.php）で出す
    ['art' => '*', 'where' => '*', 'required' => false, 're' => "/診断結果に出てくる「($MET_RE)」/u",
     'expect' => fn($m) => [false, "結果画面に正式な項目名「{$m[1]}」は出ない（表示名は「" . ($displayLabels()[$m[1]] ?? '?') . '」）']],
    // 修正後の画面の説明：引用した表示名が LOVE_ITEM_LABELS と一字一句一致すること・引用した見出しが love.php の結果の見出しにあること
    ['art' => 'guide/style-guide', 'where' => 'lead', 'required' => true, 're' => '/診断結果の(「[^」]+」)に並ぶ項目（画面では((?:「[^」]+」)+)などの名前で表示）/u',
     'expect' => function ($m) use ($labelQuoteExpect, $sectionQuoteExpect) { [$a, $ad] = $labelQuoteExpect($m[2], 'style'); [$b, $bd] = $sectionQuoteExpect($m[1]); return [$a && $b, "$ad $bd"]; }],
    ['art' => 'guide/tendency-guide', 'where' => 'lead', 'required' => true, 're' => '/診断結果の(「[^」]+」)に並ぶ項目（画面では((?:「[^」]+」)+)という名前で表示）/u',
     'expect' => function ($m) use ($labelQuoteExpect, $sectionQuoteExpect) { [$a, $ad] = $labelQuoteExpect($m[2], 'tendency', true); [$b, $bd] = $sectionQuoteExpect($m[1]); return [$a && $b, "$ad $bd"]; }],
    ['art' => 'guide/kekka-no-mikata', 'where' => 'body', 'required' => true, 're' => '/結果画面には段階の名前や点数は表示せず、表示名（((?:「[^」]+」)+)など）・一行の説明・解説文を/u',
     'expect' => fn($m) => $labelQuoteExpect($m[1], null)],
    // 2026-10-06：「入力した組み合わせ（MBTI・血液型・星座）」を「入力したMBTI・血液型と、生年月日から決まる星座の組み合わせ」に修正（星座は入力欄ではない）
    ['art' => 'guide/kekka-no-mikata', 'where' => 'body', 'required' => true, 're' => '/診断結果の画面に表示されるのは、入力したMBTI・血液型と、生年月日から決まる星座の組み合わせ、恋愛タイプ（Bundle）にもとづく解説文、((?:「[^」]+」)+)の各項目（表示名・一行の説明・解説文）、関連記事へのリンクです/u',
     'expect' => fn($m) => $sectionQuoteExpect($m[1])],
    ['art' => 'guide/primitive-guide', 'where' => 'body', 'required' => true, 're' => '/実際に表示されるのは、Primitiveから計算された後のStyle・Tendency・Bundleにもとづく文章（恋愛タイプの解説文と、((?:「[^」]+」)+)の各項目の表示名・一行の説明・解説文）です/u',
     'expect' => fn($m) => $sectionQuoteExpect($m[1])],
    // 引用した表示名の一般検査（全記事）：「画面では「〜」」「表示名（「〜」」の引用は LOVE_ITEM_LABELS の表示名であること
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/(?:画面では|表示名（)((?:「[^」]+」)+)/u',
     'expect' => fn($m) => $labelQuoteExpect($m[1], null)],
    // 旧文（2026-10-06 6段階化の前の style/*・tendency/*）：段階の書き方が無い「Low判定でも「〜」」「Highは「〜」」の引用、3通りの表示と読める levels_intro
    // 2026-10-06（M1追加）：「という前向きな表現で示され」の形も旧文として検出する（tendency/* の FAQ）
    ['art' => 'style/*', 'where' => '*', 'required' => false, 're' => '/(?:Low判定でも|Highは)「[^」]+」という前向きな(?:傾向として表示|表現で示され)/u',
     'expect' => fn($m) => [false, '段階の書き方が無い引用。結果画面の文章は6段階（L1〜L6）で変わり、引用した文が出るのはいちばん低い段階（L1）／いちばん高い段階（L6）だけ']],
    ['art' => 'tendency/*', 'where' => '*', 'required' => false, 're' => '/(?:Low判定でも|Highは)「[^」]+」という前向きな(?:傾向として表示|表現で示され)/u',
     'expect' => fn($m) => [false, '段階の書き方が無い引用。結果画面の文章は6段階（L1〜L6）で変わり、引用した文が出るのはいちばん低い段階（L1）／いちばん高い段階（L6）だけ']],
    ['art' => 'style/*', 'where' => '*', 'required' => false, 're' => '/High\/Mid\/Lowそれぞれ次のように表示されます/u',
     'expect' => fn($m) => [false, '結果画面の文章は6段階（L1〜L6）で変わり、High/Mid/Lowの3通りではない']],
    ['art' => 'tendency/*', 'where' => '*', 'required' => false, 're' => '/High\/Mid\/Lowそれぞれ次のように表示されます/u',
     'expect' => fn($m) => [false, '結果画面の文章は6段階（L1〜L6）で変わり、High/Mid/Lowの3通りではない']],

    // ---- 2026-10-06 blood/ab-love（2回目）：O型と同じ数値になる理由を「情動性が主軸／主な要素」から「計算式に行動主導性を含まない」へ ----
    // （既存の claim 番号を変えないよう末尾に追加。旧文の検査は 5c 節の「同じ数値になる理由」と claim#73）
    ['art' => 'blood/ab-love', 'where' => 'styles.独占欲.note', 'required' => true, 're' => '/計算式に行動主導性を含まないため、O型と完全に同じ数値になります/u',
     'expect' => $abNoActNote('独占欲')],
    ['art' => 'blood/ab-love', 'where' => 'styles.惚れやすさ.note', 'required' => true, 're' => '/計算式に行動主導性を含まないため、O型と完全に同じ数値になります/u',
     'expect' => $abNoActNote('惚れやすさ')],
    ['art' => 'blood/ab-love', 'where' => 'matome', 'required' => true, 're' => '/行動主導性を含まない(?:(\d+)つの|(\d+))?指標（((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性))*)）はO型と完全に同じ数値/u',
     'expect' => function ($m) use ($abNoActExpect) {
        $n = ($m[1] ?? '') !== '' ? (int)$m[1] : (($m[2] ?? '') !== '' ? (int)$m[2] : null);
        [$ok, $d] = $abNoActExpect([$m[0], $m[3]]); $cntOk = $n === null || $n === count(explode('・', $m[3]));
        return [$ok && $cntOk, $d . ($cntOk ? '' : " 個数={$n} 列挙=" . count(explode('・', $m[3])))]; }],

    // ---- 2026-10-06 guide/kekka-no-mikata の入力欄・levels_intro のかっこ書き（既存の claim 番号を変えないよう末尾に移動） ----
    // 修正後：入力欄は MBTI・血液型・生年月日で、星座は生年月日から決まる（love.php のソース）
    ['art' => 'guide/kekka-no-mikata', 'where' => 'body', 'required' => true, 're' => '/入力したMBTI・血液型と、生年月日から決まる星座/u',
     'expect' => fn($m) => $inputsAreMbtiBloodBirthday()],
    // 旧文：星座も入力したと読める書き方（2026-10-06修正前の kekka-no-mikata FAQ）。love.php に星座の入力欄があるときだけ成り立つ
    ['art' => '*', 'where' => '*', 'required' => false, 're' => '/入力した組み合わせ（MBTI・血液型・星座）/u',
     'expect' => function ($m) use ($loveInputs) { $in = $loveInputs(); $seizaInput = array_filter($in['titles'], fn($x) => str_contains($x, '星座')) !== [];
        return [$seizaInput, '星座は入力欄ではなく生年月日から決まる（love.php 入力見出し=' . implode('／', $in['titles']) . '）']; }],
    // 旧文：levels_intro のかっこ書きが2つ続く形「…の文章）です（…）。」（2026-10-06修正前の sekkyokusei・kekkonshikou・uwakitaisei）
    ['art' => '*', 'where' => 'levels_intro', 'required' => false, 're' => '/）です（/u',
     'expect' => fn($m) => [false, 'かっこ書きが2つ続く。2つ目のかっこは外して次の文に分ける']],
];

// ---- 2026-10-06 「主軸を理由にした文」の書き直し（12件。5d 節の走査で「要判断」だった文） ----
// 主軸（誠実性）だけでは結論を説明できなかった注記を、結論と理由（どの項がどれだけ効いているか）が事実と一致する文に直した。
// 各文を required=true で登録し、寄与の有無・向き（inc のマッピング）、項の大小・High 率（スナップショット）を照合する。
// 項の大小は termsDiff()（式の重み × Primitive 平均の差、スコア単位）で比べる。言い回しの判定基準は次のとおり。
//   「大きく低い」        : High 率の差が 20 ポイント以上
//   「わずかに低い」      : 全体平均より低く、差が 5 ポイント未満
//   「おおむね補う」      : 補う側の項が、下げる側の項と逆向きで、その絶対値の 0.75 倍以上・未満（差し引きでわずかに下がる）
//                           2026-10-07：「一部打ち消す／補う」（0.2 倍以上 0.75 倍未満）を加え、重ならないように下限を 0.5 倍から 0.75 倍に上げた（RATIO_MOSTLY・RATIO_PARTIAL。既存の該当文は 0.80・0.94 で変わらず成立）
//   「ほぼ同水準」「差は小さく」: High 率の差が 1 ポイント未満
//   「わずかに上乗せ」    : 誠実性の項がプラスで、0.2 未満
//   「やや高め」          : 全体平均より高く、差が 10 ポイント未満
//   「主因」「前者がやや大きい」: 主とした項の絶対値が他方より大きい（「やや」は他方の 1.5 倍未満、「ともに効き」は他方が主の半分以上）
/** 2つの集合（sub() の条件）の Primitive 平均の差に式の重みを掛けた項（Primitive => スコア） */
function termsDiff(string $mt, array $fSelf, array $fBase): array {
    $mean = function (array $cs): array { $o = []; foreach (P_CODE as $pj => $_) $o[$pj] = array_sum(array_map(fn($c) => $c['p'][$pj], $cs)) / max(1, count($cs)); return $o; };
    $a = $mean(sub($fSelf)); $b = $mean(sub($fBase)); $o = [];
    foreach (formulaOf($mt) as $pj => $w) $o[$pj] = $w * ($a[$pj] - $b[$pj]);
    return $o;
}
function termsStr(array $t): string { $s = []; foreach ($t as $pj => $v) $s[] = sprintf('%s%+.2f', $pj, $v); return implode(' ', $s); }
/** 星座のエレメント・クオリティが Primitive へ加算するスコア（inc の星座マッピング） */
function seizaSrc(int $si, string $pj): array {
    $el = SEIZA_ELEMENTS[SEIZA_SIGNS[$si]['element']]['name']; $qu = SEIZA_QUALITIES[SEIZA_SIGNS[$si]['quality']]['name']; $e = 0; $q = 0;
    foreach (sourcesOf($pj) as $s) { if ($s['kind'] === 'element' && $s['key'] === $el) $e += $s['score']; if ($s['kind'] === 'quality' && $s['key'] === $qu) $q += $s['score']; }
    return ['element' => $e, 'quality' => $q, 'el' => $el, 'qu' => $qu];
}
/** 星座の Primitive へ加算する源（エレメント・クオリティの名前、加算があるものだけ） */
function seizaSrcNames(int $si, string $pj): array { $s = seizaSrc($si, $pj); $o = []; if ($s['element'] > 0) $o[] = $s['el']; if ($s['quality'] > 0) $o[] = $s['qu']; return $o; }
$EL_QU_RE = '(?:火|地|風|水|活動宮|不動宮|柔軟宮)';

// (1) blood/b-love 結婚志向：誠実性の寄与が無いのは O型・AB型と同じ。B型だけ「変化」（keyword 自由）から変化志向が加算され、式で差し引かれるため最も低い
$CLAIMS[] = ['art' => 'blood/b-love', 'where' => 'tendencies.結婚志向.note', 'required' => true, 'mainReason' => true,
    're' => '/^誠実性が主軸の指標です。O型・AB型と同じく誠実性の寄与は無く、「([^」]+)」由来の変化志向が差し引かれるため、4血液型の中で最も低い水準です。$/u',
    'expect' => function ($m) {
        $mt = '結婚志向'; $fo = formulaOf($mt); $c = []; foreach (BLOODS as $bt) $c[$bt] = contribOf('b', $bt);
        $traitOk = count(array_filter(BLOOD_TRAIT_MAPPING['B'], fn($r) => $r['trait'] === $m[1] && primOfTrait($r['trait']) === '変化志向')) > 0;
        $hs = []; foreach (BLOODS as $bt) $hs[$bt] = high(['b' => $bt], $mt);
        $tO = termsDiff($mt, ['b' => 'B'], ['b' => 'O']); $tAB = termsDiff($mt, ['b' => 'B'], ['b' => 'AB']);
        $ok = dominantPrim($mt) === '誠実性' && ($fo['変化志向'] ?? 0) < 0
            && !isset($c['B']['誠実性']) && !isset($c['O']['誠実性']) && !isset($c['AB']['誠実性']) && ($c['A']['誠実性'] ?? 0) > 0
            && ($c['B']['変化志向'] ?? 0) > 0 && !isset($c['O']['変化志向']) && !isset($c['AB']['変化志向']) && $traitOk
            && abs($tO['誠実性']) < 1e-9 && $tO['変化志向'] < 0 && abs($tAB['誠実性']) < 1e-9 && $tAB['変化志向'] < 0
            && $hs['B'] < min($hs['A'], $hs['O'], $hs['AB']);
        return [$ok, "Trait「{$m[1]}」→変化志向=" . ($traitOk ? 'B型にあり' : '無し') . ' 誠実性 A=' . ($c['A']['誠実性'] ?? 0) . ' B/O/AB=' . ($c['B']['誠実性'] ?? 0) . '/' . ($c['O']['誠実性'] ?? 0) . '/' . ($c['AB']['誠実性'] ?? 0)
            . ' 変化志向 B=' . ($c['B']['変化志向'] ?? 0) . ' vsO ' . termsStr($tO) . ' vsAB ' . termsStr($tAB) . ' High A/B/O/AB=' . implode('/', array_map('r1', $hs))]; }];
// (2) blood/o-love 包容力：A型より大きく低い（誠実性の寄与の差）、B型より高い（情動性の寄与）、AB型と同じ値
$CLAIMS[] = ['art' => 'blood/o-love', 'where' => 'styles.包容力.note', 'required' => true, 'mainReason' => true,
    're' => '/^誠実性が主軸の指標です。O型は誠実性への寄与が無いためA型より大きく低い一方、(.+?)由来の情動性の寄与でB型よりは高く、AB型と同じ([\d.]+)%です。$/u',
    'expect' => function ($m) {
        $mt = '包容力'; $c = []; foreach (BLOODS as $bt) $c[$bt] = contribOf('b', $bt);
        $traitOk = count(array_filter(BLOOD_TRAIT_MAPPING['O'], fn($r) => $r['trait'] === $m[1] && primOfTrait($r['trait']) === '情動性')) > 0;
        $hs = []; foreach (BLOODS as $bt) $hs[$bt] = high(['b' => $bt], $mt);
        $tA = termsDiff($mt, ['b' => 'O'], ['b' => 'A']); $tB = termsDiff($mt, ['b' => 'O'], ['b' => 'B']);
        $same = lvDist(sub(['b' => 'O']), $mt)['raw'] === lvDist(sub(['b' => 'AB']), $mt)['raw'];
        $ok = dominantPrim($mt) === '誠実性' && !isset($c['O']['誠実性']) && ($c['A']['誠実性'] ?? 0) > 0 && $tA['誠実性'] < 0 && abs($tA['誠実性']) > abs($tA['情動性'])
            && $hs['A'] - $hs['O'] >= 20 && $traitOk && ($c['O']['情動性'] ?? 0) > 0 && !isset($c['B']['情動性']) && !isset($c['B']['誠実性'])
            && abs($tB['誠実性']) < 1e-9 && $tB['情動性'] > 0 && $hs['O'] > $hs['B'] && $same && near($m[2], $hs['O']) && near($m[2], $hs['AB']);
        return [$ok, "Trait「{$m[1]}」→情動性=" . ($traitOk ? 'O型にあり' : '無し') . ' vsA ' . termsStr($tA) . ' vsB ' . termsStr($tB) . ' High A/B/O/AB=' . implode('/', array_map('r1', $hs)) . ' O・AB分布' . ($same ? '一致' : '不一致')]; }];
// (3) seiza 包容力（牡羊座・蟹座・魚座・射手座）：誠実性の寄与が無い分の低下（－）を、エレメント由来の情動性（＋）がおおむね補い、全体平均よりわずかに低い
foreach (['aries', 'cancer', 'pisces', 'sagittarius'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'styles.包容力.note', 'required' => true, 'mainReason' => true,
        're' => "/^誠実性が主軸の指標です。誠実性への寄与が無い分の低下を、($EL_QU_RE)由来の情動性への寄与がおおむね補うため、全体平均（([\\d.]+)%）よりわずかに低い水準です。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '包容力'; $si = signIndex((string)($a['name'] ?? '')); $r = seizaSrc($si, '誠実性'); $e = seizaSrc($si, '情動性');
            $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
            $ok = dominantPrim($mt) === '誠実性' && $r['element'] === 0 && $r['quality'] === 0 && seizaSrcNames($si, '情動性') === [$m[1]]
                && $t['誠実性'] < 0 && $t['情動性'] > 0 && abs($t['情動性']) >= RATIO_MOSTLY[0] * abs($t['誠実性']) && abs($t['情動性']) < abs($t['誠実性'])
                && near($m[2], $ov) && $self < $ov && $ov - $self < 5;
            return [$ok, "{$a['name']}（{$e['el']}・{$e['qu']}）誠実性への加算=" . ($r['element'] + $r['quality']) . ' 情動性の源=' . implode('・', seizaSrcNames($si, '情動性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov)]; }];
}
// (4) seiza 恋愛の慎重さ（獅子座・蠍座）：不動宮由来の誠実性がわずかに上乗せ、差は小さく全体平均とほぼ同水準
foreach (['leo', 'scorpio'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'styles.恋愛の慎重さ.note', 'required' => true, 'mainReason' => true,
        're' => '/^誠実性が主軸の指標です。不動宮由来の寄与で誠実性がわずかに上乗せされますが差は小さく、全体平均（([\d.]+)%）とほぼ同水準です。$/u',
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '恋愛の慎重さ'; $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
            $ok = dominantPrim($mt) === '誠実性' && seizaSrcNames($si, '誠実性') === ['不動宮'] && $t['誠実性'] > 0 && $t['誠実性'] < 0.2
                && near($m[1], $ov) && abs($self - $ov) < 1;
            return [$ok, "{$a['name']} 誠実性の源=" . implode('・', seizaSrcNames($si, '誠実性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov)]; }];
}
// (5) seiza 結婚志向（獅子座・蠍座）：主因は差し引かれる変化志向への寄与が無いこと（＋）、従は不動宮由来の誠実性（＋）
foreach (['leo', 'scorpio'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'tendencies.結婚志向.note', 'required' => true, 'mainReason' => true,
        're' => '/^誠実性が主軸の指標です。差し引かれる変化志向への寄与が無いことを主因に、不動宮由来の誠実性も加わり、全体平均（([\d.]+)%）よりやや高めです。$/u',
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '結婚志向'; $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
            $ok = dominantPrim($mt) === '誠実性' && (formulaOf($mt)['変化志向'] ?? 0) < 0 && seizaSrcNames($si, '変化志向') === [] && seizaSrcNames($si, '誠実性') === ['不動宮']
                && $t['変化志向'] > 0 && $t['誠実性'] > 0 && $t['変化志向'] > $t['誠実性'] && near($m[1], $ov) && $self > $ov && $self - $ov < 10;
            return [$ok, "{$a['name']} 変化志向の源=" . (implode('・', seizaSrcNames($si, '変化志向')) ?: 'なし') . ' 誠実性の源=' . implode('・', seizaSrcNames($si, '誠実性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov)]; }];
}
// (6) seiza 結婚志向（天秤座・双子座）：主因は誠実性の寄与が無いこと（－）、従は差し引かれる変化志向（－）。双子座は両方が効き、誠実性の差がやや大きい
$CLAIMS[] = ['art' => 'seiza/libra', 'where' => 'tendencies.結婚志向.note', 'required' => true, 'mainReason' => true,
    're' => "/^誠実性が主軸の指標です。誠実性への寄与が無いことが主因で、($EL_QU_RE(?:・$EL_QU_RE)*)由来の変化志向が差し引かれる分も加わり、全体平均（([\\d.]+)%）より低めの([\\d.]+)%です。$/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '結婚志向'; $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $ok = dominantPrim($mt) === '誠実性' && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '変化志向') === explode('・', $m[1])
            && $t['誠実性'] < 0 && $t['変化志向'] < 0 && abs($t['誠実性']) > abs($t['変化志向']) && near($m[2], $ov) && near($m[3], $self) && $self < $ov;
        return [$ok, "{$a['name']} 変化志向の源=" . implode('・', seizaSrcNames($si, '変化志向')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov)]; }];
$CLAIMS[] = ['art' => 'seiza/gemini', 'where' => 'tendencies.結婚志向.note', 'required' => true, 'mainReason' => true,
    're' => "/^誠実性が主軸の指標です。誠実性の寄与が無いことと、($EL_QU_RE(?:・$EL_QU_RE)*)由来の変化志向が差し引かれることがともに効き（前者がやや大きい）、全体平均（([\\d.]+)%）より低めです。$/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '結婚志向'; $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $r = abs($t['誠実性']) / max(1e-9, abs($t['変化志向']));
        $ok = dominantPrim($mt) === '誠実性' && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '変化志向') === explode('・', $m[1])
            && $t['誠実性'] < 0 && $t['変化志向'] < 0 && $r > 1 && $r < 1.5 && abs($t['変化志向']) >= 0.5 * abs($t['誠実性']) && near($m[2], $ov) && $self < $ov;
        return [$ok, "{$a['name']} 変化志向の源=" . implode('・', seizaSrcNames($si, '変化志向')) . ' vs全体 ' . termsStr($t) . sprintf(' 比=%.2f', $r) . ' High ' . r1($self) . ' / 全体' . r1($ov)]; }];

// ---- 2026-10-06（Reviewer 差し戻し対応）：5d の検出漏れ修正（M1・m3）で見つかった星座記事の注記と、同じ理由づけの FAQ を修正 ----
// 上の判定基準に次を加える（いずれも High 率は星座単体768件、全体平均は9216件）。
//   「低め」              : 全体平均より低く、差が 10 ポイント以上 20 ポイント未満
//   「やや低め」「やや低い」: 全体平均より低く、差が 10 ポイント未満
//   「小さい」「ごく小さい」: 従とした項の絶対値が、主因とした項の絶対値の 0.2 倍未満
//   「おおむね打ち消す」  : 「おおむね補う」と同じ（打ち消す側の項が逆向きで、もう一方の絶対値の半分以上・未満）
//   「他の指標よりも全体平均に近い」: その星座の他の全指標（Style 7・Tendency 2）より、High 率と全体平均の差の絶対値が小さい
// (7) seiza/aquarius 恋愛の慎重さ：獅子座・蠍座の (4) と同じ書き方に、不動宮が共通の星座と同じ数値である文を加えたもの
$CLAIMS[] = ['art' => 'seiza/aquarius', 'where' => 'styles.恋愛の慎重さ.note', 'required' => true, 'mainReason' => true,
    're' => "/^誠実性が主軸の指標です。不動宮由来の寄与で誠実性がわずかに上乗せされますが差は小さく、全体平均（([\\d.]+)%）とほぼ同水準です。同じ不動宮を持つ((?:$SIGN_RE)(?:・(?:$SIGN_RE))*)と完全に同じ数値です。$/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '恋愛の慎重さ'; $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $others = []; $sameOk = true;
        foreach (explode('・', $m[2]) as $o) { $oi = signIndex($o); $q = SEIZA_QUALITIES[SEIZA_SIGNS[$oi]['quality']]['name']; $eq = lvDist(sub(['s' => $si]), $mt)['raw'] === lvDist(sub(['s' => $oi]), $mt)['raw']; $sameOk = $sameOk && $q === '不動宮' && $eq; $others[] = "{$o}（{$q}・分布" . ($eq ? '一致' : '不一致') . '）'; }
        $ok = dominantPrim($mt) === '誠実性' && seizaSrcNames($si, '誠実性') === ['不動宮'] && $t['誠実性'] > 0 && $t['誠実性'] < 0.2
            && near($m[1], $ov) && abs($self - $ov) < 1 && $sameOk;
        return [$ok, "{$a['name']} 誠実性の源=" . implode('・', seizaSrcNames($si, '誠実性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov) . ' 比較相手 ' . implode(' ', $others)]; }];
// (8) seiza/aquarius 嫉妬深さ：主因は情動性への寄与が無いこと（－）、不動宮由来の誠実性が差し引かれる分（－）は小さい。差は 10〜20 ポイント（低め）
//     2026-10-06：「ごく小さく」→「小さく」。誠実性の項／情動性の項の比が獅子座・蠍座 (9) と同じ 0.11 なので、言い回しをそろえた（判定基準は同じ 0.2 倍未満）
$CLAIMS[] = ['art' => 'seiza/aquarius', 'where' => 'styles.嫉妬深さ.note', 'required' => true,
    're' => "/^情動性から誠実性を差し引く指標です。情動性への寄与が無いことが主因で、($EL_QU_RE)由来の誠実性が差し引かれる分は小さく、全体平均（([\\d.]+)%）より低めの([\\d.]+)%です。$/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '嫉妬深さ'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $ok = ($fo['情動性'] ?? 0) > 0 && ($fo['誠実性'] ?? 0) < 0 && seizaSrcNames($si, '情動性') === [] && seizaSrcNames($si, '誠実性') === [$m[1]]
            && $t['情動性'] < 0 && $t['誠実性'] < 0 && abs($t['誠実性']) < 0.2 * abs($t['情動性'])
            && near($m[2], $ov) && near($m[3], $self) && $ov - $self >= 10 && $ov - $self < 20;
        return [$ok, "{$a['name']} 情動性の源=" . (implode('・', seizaSrcNames($si, '情動性')) ?: 'なし') . ' 誠実性の源=' . implode('・', seizaSrcNames($si, '誠実性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', $self - $ov)]; }];
// (9) seiza 嫉妬深さ（獅子座・蠍座）：主因はエレメント由来の情動性（＋）、不動宮由来の誠実性が差し引かれる分（－）は小さい。差は 10 ポイント未満（やや高い）
foreach (['leo', 'scorpio'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'styles.嫉妬深さ.note', 'required' => true,
        're' => "/^情動性から誠実性を差し引く指標です。($EL_QU_RE)由来の情動性への寄与が主因で、($EL_QU_RE)由来の誠実性が差し引かれる分は小さいため、全体平均（([\\d.]+)%）よりやや高い([\\d.]+)%です。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '嫉妬深さ'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
            $ok = ($fo['情動性'] ?? 0) > 0 && ($fo['誠実性'] ?? 0) < 0 && seizaSrcNames($si, '情動性') === [$m[1]] && seizaSrcNames($si, '誠実性') === [$m[2]]
                && $t['情動性'] > 0 && $t['誠実性'] < 0 && abs($t['誠実性']) < 0.2 * abs($t['情動性'])
                && near($m[3], $ov) && near($m[4], $self) && $self > $ov && $self - $ov < 10;
            return [$ok, "{$a['name']} 情動性の源=" . implode('・', seizaSrcNames($si, '情動性')) . ' 誠実性の源=' . implode('・', seizaSrcNames($si, '誠実性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', $self - $ov)]; }];
}
// (10) seiza 浮気耐性（蟹座・牡羊座）：主因は誠実性への寄与が無いこと（－）、従は活動宮（牡羊座は火も）由来の行動主導性（式で差し引かれる、－）。
//      蟹座は差 10 ポイント未満（やや低め）、牡羊座は 10〜20 ポイント（低め）
foreach (['cancer', 'aries'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'tendencies.浮気耐性.note', 'required' => true, 'mainReason' => true,
        're' => "/^誠実性が主軸の指標です。誠実性への寄与が無いことが主因で、($EL_QU_RE(?:・$EL_QU_RE)*)由来の行動主導性がマイナスに働く分も加わり、全体平均（([\\d.]+)%）より(やや)?低めの([\\d.]+)%です。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '浮気耐性'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt); $d = $ov - $self;
            $degOk = $m[3] === 'やや' ? ($d > 0 && $d < 10) : ($d >= 10 && $d < 20);
            $ok = dominantPrim($mt) === '誠実性' && ($fo['行動主導性'] ?? 0) < 0 && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '行動主導性') === explode('・', $m[1])
                && $t['誠実性'] < 0 && $t['行動主導性'] < 0 && abs($t['誠実性']) > abs($t['行動主導性'])
                && near($m[2], $ov) && near($m[4], $self) && $degOk;
            return [$ok, "{$a['name']} 誠実性の源=" . (implode('・', seizaSrcNames($si, '誠実性')) ?: 'なし') . ' 行動主導性の源=' . implode('・', seizaSrcNames($si, '行動主導性')) . ' vs全体 ' . sprintf('誠実性%+.3f 行動主導性%+.3f', $t['誠実性'], $t['行動主導性']) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f、記事「%s低め」）', -$d, $m[3])]; }];
}
// (11) seiza/cancer FAQ（浮気耐性）：注記 (10) と同じ因果（主因＝誠実性の寄与が無い、従＝行動主導性）。差 10 ポイント未満（やや低い）
$CLAIMS[] = ['art' => 'seiza/cancer', 'where' => 'faq', 'required' => true,
    // 2026-10-06（Reviewer m4）：2つ目の星座名も名前付きで捕捉し、記事の星座名と一致するかを照合する（(15)(16) と同じ方式）
    're' => "/($SIGN_RE)は「浮気耐性」が全体平均（([\\d.]+)%）よりやや低い([\\d.]+)%という傾向を示しています。これは(?<s2>$SIGN_RE)の構造から誠実性への寄与が無いことを主因に、計算式上マイナスに働く行動主導性を押し上げる分も加わった構造上の理由によるもの/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '浮気耐性'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $ok = $m[1] === ($a['name'] ?? null) && $m['s2'] === ($a['name'] ?? null) && ($fo['行動主導性'] ?? 0) < 0 && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '行動主導性') !== []
            && $t['誠実性'] < 0 && $t['行動主導性'] < 0 && abs($t['誠実性']) > abs($t['行動主導性'])
            && near($m[2], $ov) && near($m[3], $self) && $self < $ov && $ov - $self < 10;
        return [$ok, "{$a['name']} 行動主導性の源=" . implode('・', seizaSrcNames($si, '行動主導性')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov)]; }];
// (12) seiza/gemini 惚れやすさ：情動性への寄与が無い分（－）を、風・柔軟宮由来の変化志向（＋）がおおむね打ち消し、全体平均よりわずかに低い（5 ポイント未満）。
//      「他の指標と比べると、全体平均にいちばん近い水準」は、双子座の他の全指標より全体平均との差の絶対値が小さいこと
//      2026-10-06：1文（約110字）を2文に分けた（事実は同じ。旧「他の指標よりも全体平均に近い」と同じ判定）
$CLAIMS[] = ['art' => 'seiza/gemini', 'where' => 'styles.惚れやすさ.note', 'required' => true,
    're' => "/^情動性と変化志向で決まる指標です。情動性への寄与が無い分の低下を、($EL_QU_RE(?:・$EL_QU_RE)*)由来の変化志向への寄与がおおむね打ち消すため、全体平均（([\\d.]+)%）よりわずかに低い程度にとどまります。他の指標と比べると、全体平均にいちばん近い水準です。$/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        global $METRICS;
        $mt = '惚れやすさ'; $fs = array_keys(formulaOf($mt)); sort($fs); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $gap = abs($self - $ov); $closer = [];
        foreach ($METRICS as $mt2) if ($mt2 !== $mt) { $g2 = abs(high(['s' => $si], $mt2) - high([], $mt2)); if ($g2 <= $gap) $closer[] = $mt2 . sprintf('(%.1f)', $g2); }
        $ok = $fs === ['変化志向', '情動性'] || $fs === ['情動性', '変化志向'];
        $ok = $ok && seizaSrcNames($si, '情動性') === [] && seizaSrcNames($si, '変化志向') === explode('・', $m[1])
            && $t['情動性'] < 0 && $t['変化志向'] > 0 && abs($t['変化志向']) >= RATIO_MOSTLY[0] * abs($t['情動性']) && abs($t['変化志向']) < abs($t['情動性'])
            && near($m[2], $ov) && $self < $ov && $ov - $self < 5 && $closer === [];
        return [$ok, "{$a['name']} 変化志向の源=" . implode('・', seizaSrcNames($si, '変化志向')) . ' vs全体 ' . termsStr($t) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', $self - $ov) . ' 差がこれ以下の他指標=' . (implode('・', $closer) ?: 'なし')]; }];

// ---- 2026-10-06（続き）：5d の修正で見つかった水瓶座の浮気耐性の注記と、同じ理由づけの FAQ（水瓶座・牡羊座）、蠍座の浮気耐性の注記を修正 ----
// 判定基準は上の 2 ブロックと同じ（「やや高め」「やや高く」「やや上回る」：全体平均より高く、差が 10 ポイント未満。
// 「低い」（「やや」なし）：全体平均より低く、差が 10 ポイント以上。「主因」：主とした項の絶対値が他方より大きい）
/** seiza 浮気耐性で、行動主導性への寄与が無いこと（＋）が主因、従が誠実性（＋）、差 10 ポイント未満で高いこと */
$uwakiNoActUp = function (int $si, string $quSrc, $ovWritten, $selfWritten = null): array {
    $mt = '浮気耐性'; $fo = formulaOf($mt); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
    $ok = dominantPrim($mt) === '誠実性' && ($fo['行動主導性'] ?? 0) < 0 && seizaSrcNames($si, '行動主導性') === [] && seizaSrcNames($si, '誠実性') === [$quSrc]
        && $quSrc === SEIZA_QUALITIES[SEIZA_SIGNS[$si]['quality']]['name']
        && $t['行動主導性'] > 0 && $t['誠実性'] > 0 && $t['行動主導性'] > $t['誠実性']
        && near($ovWritten, $ov) && ($selfWritten === null || near($selfWritten, $self)) && $self > $ov && $self - $ov < 10;
    return [$ok, SEIZA_SIGNS[$si]['name'] . ' 行動主導性の源=' . (implode('・', seizaSrcNames($si, '行動主導性')) ?: 'なし') . ' 誠実性の源=' . implode('・', seizaSrcNames($si, '誠実性'))
        . ' vs全体 ' . sprintf('誠実性%+.3f 行動主導性%+.3f', $t['誠実性'], $t['行動主導性']) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', $self - $ov)];
};
// (13) seiza/aquarius 浮気耐性：主因は差し引かれる行動主導性への寄与が無いこと（＋）、従は不動宮由来の誠実性（＋）。結婚志向 (5) と同じ書き方
$CLAIMS[] = ['art' => 'seiza/aquarius', 'where' => 'tendencies.浮気耐性.note', 'required' => true, 'mainReason' => true,
    're' => "/^誠実性が主軸の指標です。差し引かれる行動主導性への寄与が無いことを主因に、($EL_QU_RE)由来の誠実性も加わり、全体平均（([\\d.]+)%）よりやや高めです。/u",
    'expect' => fn($m, string $rel = '', array $a = []) => $uwakiNoActUp(signIndex((string)($a['name'] ?? '')), $m[1], $m[2])];
// (14) seiza/scorpio 浮気耐性：(13) と同じ因果（蠍座と水瓶座は浮気耐性の分布が同じ）。程度「やや高く」は修正前のまま
$CLAIMS[] = ['art' => 'seiza/scorpio', 'where' => 'tendencies.浮気耐性.note', 'required' => true,
    're' => "/^差し引かれる行動主導性への寄与が無いことを主因に、($EL_QU_RE)由来の誠実性もプラスに働くため、全体平均（([\\d.]+)%）よりやや高くなります。$/u",
    'expect' => fn($m, string $rel = '', array $a = []) => $uwakiNoActUp(signIndex((string)($a['name'] ?? '')), $m[1], $m[2])];
// (15) seiza/aquarius FAQ（浮気耐性）：注記 (13) と同じ因果。差 10 ポイント未満（やや上回る）
$CLAIMS[] = ['art' => 'seiza/aquarius', 'where' => 'faq', 'required' => true,
    're' => "/($SIGN_RE)は「浮気耐性」がHigh([\\d.]+)%と全体平均（([\\d.]+)%）をやや上回っています。これは($SIGN_RE)が計算式上マイナスに働く行動主導性に寄与しないことを主因に、($SIGN_RE)を構成するクオリティ（($EL_QU_RE)）が誠実性というプリミティブに寄与する分も加わった構造上の理由によるもの/u",
    'expect' => function ($m, string $rel = '', array $a = []) use ($uwakiNoActUp) {
        $name = (string)($a['name'] ?? ''); [$ok, $d] = $uwakiNoActUp(signIndex($name), $m[6], $m[3], $m[2]);
        return [$ok && $m[1] === $name && $m[4] === $name && $m[5] === $name, $d]; }];
// (16) seiza/aries FAQ（浮気耐性）：注記 (10) と同じ因果（主因＝誠実性の寄与が無い、従＝行動主導性）。蟹座 (11) と同じ書き方で、差 10 ポイント以上（「やや」なしの「低い」）
$CLAIMS[] = ['art' => 'seiza/aries', 'where' => 'faq', 'required' => true,
    're' => "/($SIGN_RE)は「浮気耐性」が全体平均（([\\d.]+)%）より低い([\\d.]+)%という傾向を示しています。これは($SIGN_RE)の構造から誠実性への寄与が無いことを主因に、計算式上マイナスに働く行動主導性を押し上げる分も加わった構造上の理由によるもの/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '浮気耐性'; $fo = formulaOf($mt); $name = (string)($a['name'] ?? ''); $si = signIndex($name); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt);
        $ok = $m[1] === $name && $m[4] === $name && dominantPrim($mt) === '誠実性' && ($fo['行動主導性'] ?? 0) < 0 && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '行動主導性') !== []
            && $t['誠実性'] < 0 && $t['行動主導性'] < 0 && abs($t['誠実性']) > abs($t['行動主導性'])
            && near($m[2], $ov) && near($m[3], $self) && $self < $ov && $ov - $self >= 10;
        return [$ok, "{$name} 誠実性の源=" . (implode('・', seizaSrcNames($si, '誠実性')) ?: 'なし') . ' 行動主導性の源=' . implode('・', seizaSrcNames($si, '行動主導性')) . ' vs全体 ' . sprintf('誠実性%+.3f 行動主導性%+.3f', $t['誠実性'], $t['行動主導性']) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', $self - $ov)]; }];
// (17) 旧文の検出（required=false）：星座記事の FAQ で、1つの要因だけを挙げる「構造上の理由によるもの」の形
//      「これは(星座)を構成する(エレメント|クオリティ)（X）が(P)というプリミティブに寄与する構造上の理由」
//      「これは(星座)が計算式上マイナスに働く(P)を押し上げる構造上の理由」
//      挙げた P が、直前の文の指標で全体平均との寄与差の絶対値が最大の項（主因）でなければ FAIL（2026-10-06修正前の水瓶座・牡羊座の FAQ）。
//      主因を挙げている文（例：山羊座の結婚志向）は PASS。MBTI 記事の同じ形の文は比較相手が文ごとに違うため対象外
$CLAIMS[] = ['art' => 'seiza/*', 'where' => 'faq', 'required' => false,
    're' => "/($SIGN_RE)は「($MET_RE)」が[^。]*。これは(?:$SIGN_RE)(?:を構成する(?:エレメント|クオリティ)（{$EL_QU_RE}）が($PRIM_RE)というプリミティブに寄与する|が計算式上マイナスに働く($PRIM_RE)を押し上げる)構造上の理由/u",
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = $m[2]; $p = ($m[3] ?? '') !== '' ? $m[3] : $m[4]; $si = signIndex($m[1]); $t = termsDiff($mt, ['s' => $si], []);
        $main = null; foreach ($t as $pj => $v) if ($main === null || abs($v) > abs($t[$main])) $main = $pj;
        return [$p === $main, "{$m[1]} {$mt} 挙げた要因={$p} 主因={$main} vs全体 " . termsStr($t)]; }];

// ---- 2026-10-06（Reviewer 差し戻し M2）：修正した旧文を意味的に検出する検査（required=false。DEVELOPMENT_RULES「記事の事実検証ルール」5） ----
// 期待値はすべて termsDiff()（星座単体 vs 全体）と high() から計算する。判定基準は上の 3 ブロックと同じ。
// 注：gemini:35（惚れやすさ）の旧文「変化志向の二重寄与があるぶん、他の指標よりは全体平均に近い水準です」は、事実の誤りではなく
//     言い回しの精緻化（理由を「情動性の低下を変化志向が打ち消す」と明示）で直したものなので、旧文の検査は登録しない。
/** 注記のフィールド名（'嫉妬深さ.note' 等。where が 'styles'／'tendencies' のとき）から指標名を取り出す */
$noteMetric = function (string $w): ?string { $mt = explode('.', $w)[0]; return in_array($mt, $GLOBALS['METRICS'], true) && str_ends_with($w, '.note') ? $mt : null; };
// (18) 嫉妬深さ：「両方に寄与があり互いに打ち消し合う」は、差し引かれる誠実性の項が情動性の項の半分以上あるときだけ成り立つ
//      （2026-10-06修正前の獅子座・蠍座の注記。誠実性の項は情動性の項の 0.11 倍で、打ち消し合うとは言えない）
$CLAIMS[] = ['art' => 'seiza/*', 'where' => 'styles.嫉妬深さ.note', 'required' => false,
    're' => '/両方に寄与があり互いに打ち消し合う/u',
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '嫉妬深さ'; $t = termsDiff($mt, ['s' => signIndex((string)($a['name'] ?? ''))], []);
        $r = abs($t['誠実性']) / max(1e-9, abs($t['情動性']));
        return [abs($t['誠実性']) >= 0.5 * abs($t['情動性']), ($a['name'] ?? '') . ' vs全体 ' . termsStr($t) . sprintf(' 誠実性/情動性の比=%.2f（0.5以上で「打ち消し合う」）', $r)]; }];
// (19) 浮気耐性：「誠実性がプラスに働くため」で始まる注記は、誠実性の項が寄与差の絶対値で最大（主因）のときだけ成り立つ
//      （2026-10-06修正前の蠍座の注記。主因は差し引かれる行動主導性への寄与が無いこと）
$CLAIMS[] = ['art' => 'seiza/*', 'where' => 'tendencies.浮気耐性.note', 'required' => false,
    're' => '/^誠実性がプラスに働くため/u',
    'expect' => function ($m, string $rel = '', array $a = []) {
        $mt = '浮気耐性'; $t = termsDiff($mt, ['s' => signIndex((string)($a['name'] ?? ''))], []);
        $main = null; foreach ($t as $pj => $v) if ($main === null || abs($v) > abs($t[$main])) $main = $pj;
        return [$main === '誠実性' && $t['誠実性'] > 0, ($a['name'] ?? '') . " 主因={$main} vs全体 " . termsStr($t)]; }];
// (20) 2026-10-07：注記の程度「全体平均（X%）より(やや)?(低め|高め|低い|高い)」の検査は 5e 節（全記事・全フィールド・全比較相手の程度の語）に統合した。
//      以前の (20) は星座の注記だけ・「わずかに」「大きく」「上回／下回」「ほぼ同水準」を対象外にしており、また「低い」「高い」（修飾なし）は 10 ポイント以上（上限なし）としていた。
//      5e では修飾なしを「低め」「低い」等の語尾によらず 10 ポイント以上 20 ポイント未満にそろえた（基準は 5e 節のコメントと docs/love/09-writing-rules.md「記事の数値の程度の語」）。
// (21) 「(P)(が主軸で|への)寄与が無(い一方|く)、…(Q)(がマイナスに働く|への寄与がある|への寄与（…）を持つ)ため」：
//      「ため」が後半の Q にかかり、Q を理由に挙げている。Q が寄与差の絶対値で最大の項（主因）でなければ FAIL
//      （2026-10-06修正前の魚座・射手座の結婚志向、天秤座・射手座の浮気耐性。主因はいずれも誠実性の寄与が無いこと）
//      2026-10-06（続き）：血液型記事（blood/*）にも広げた。比較相手は「ため」の後の結論で決める：
//        「4血液型の中で最も…」→ 他の3血液型すべて、「(X)型（…）より」→ X型。Q がすべての比較相手で寄与差の絶対値が最大の項（主因）でなければ FAIL。
//        比較相手を特定できない形は、照合できていないので FAIL（要判断）にする。
//        （2026-10-06修正前の B型の独占欲「情動性への寄与が無い一方、自立性がマイナスに働くため、4血液型の中で最も低い」。
//          A型との差は自立性だけだが、O型・AB型との差の主因は情動性の寄与が無いこと）
$subReasonMain = function (array $t): string { $main = null; foreach ($t as $pj => $v) if ($main === null || abs($v) > abs($t[$main])) $main = $pj; return $main; };
$subReasonTerms = fn(array $t): string => implode(' ', array_map(fn($k, $v) => sprintf('%s%+.3f', $k, $v), array_keys($t), $t));
foreach (['seiza', 'blood'] as $srCat) foreach (['styles', 'tendencies'] as $g) {
    $CLAIMS[] = ['art' => "$srCat/*", 'where' => $g, 'required' => false, 'rule' => "subReason-$g",
        're' => "/(?<a>$PRIM_RE)(?:が主軸で|への)寄与が無(?:い一方|く)、(?:計算式で)?(?:マイナスに働く)?(?<q>$PRIM_RE)(?:がマイナスに働く|への寄与(?:がある|（[^）]*）を持つ))ため(?<c>[^。]*)/u",
        'expect' => function ($m, string $rel = '', array $a = [], string $w = '') use ($noteMetric, $srCat, $subReasonMain, $subReasonTerms) {
            $mt = $noteMetric($w); if ($mt === null) return [true, "{$w} は注記ではない（対象外）"];
            if ($srCat === 'seiza') {
                $t = termsDiff($mt, ['s' => signIndex((string)($a['name'] ?? ''))], []); $main = $subReasonMain($t);
                return [$m['q'] === $main, "{$mt} 理由に挙げた項={$m['q']} 主因={$main} vs全体 " . $subReasonTerms($t)];
            }
            $self = (string)($a['code'] ?? ''); $bases = [];
            if (preg_match('/4血液型の中で最も/u', $m['c'])) { foreach (BLOODS as $bt) if ($bt !== $self) $bases[] = $bt; }
            elseif (preg_match('/(AB|A|B|O)型(?:（[^）]*）)?より/u', $m['c'], $y)) { $bases[] = $y[1]; }
            if (!$bases) return [false, "{$mt} 理由に挙げた項={$m['q']} 比較相手を結論から特定できない（要判断）"];
            $ok = true; $ds = [];
            foreach ($bases as $bt) { $t = termsDiff($mt, ['b' => $self], ['b' => $bt]); $main = $subReasonMain($t); $ok = $ok && $main === $m['q']; $ds[] = "vs{$bt}型 主因={$main} " . $subReasonTerms($t); }
            return [$ok, "{$mt} 理由に挙げた項={$m['q']} " . implode(' ／ ', $ds)]; }];
}

// ---- 2026-10-06（Reviewer 差し戻し対応・続き）：結婚志向（魚座・射手座）と浮気耐性（天秤座・射手座）の注記を、天秤座 (6)・蟹座 (10) と同じ形に修正 ----
// (22) seiza 結婚志向（魚座・射手座）：主因は誠実性への寄与が無いこと（－）、従は柔軟宮由来の変化志向（式で差し引かれる、－）。差 10〜20 ポイント（低め）
foreach (['pisces', 'sagittarius'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'tendencies.結婚志向.note', 'required' => true, 'mainReason' => true,
        're' => "/^誠実性が主軸の指標です。誠実性への寄与が無いことが主因で、($EL_QU_RE(?:・$EL_QU_RE)*)由来の変化志向が差し引かれる分も加わり、全体平均（([\\d.]+)%）より低めの([\\d.]+)%です。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '結婚志向'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt); $d = $ov - $self;
            $ok = dominantPrim($mt) === '誠実性' && ($fo['変化志向'] ?? 0) < 0 && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '変化志向') === explode('・', $m[1])
                && $t['誠実性'] < 0 && $t['変化志向'] < 0 && abs($t['誠実性']) > abs($t['変化志向'])
                && near($m[2], $ov) && near($m[3], $self) && $d >= 10 && $d < 20;
            return [$ok, "{$a['name']} 誠実性の源=" . (implode('・', seizaSrcNames($si, '誠実性')) ?: 'なし') . ' 変化志向の源=' . implode('・', seizaSrcNames($si, '変化志向')) . ' vs全体 ' . sprintf('誠実性%+.3f 変化志向%+.3f', $t['誠実性'], $t['変化志向']) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', -$d)]; }];
}
// (23) seiza 浮気耐性（天秤座・射手座）：蟹座・牡羊座の (10) と同じ因果・同じ書き方（主因＝誠実性への寄与が無い、従＝行動主導性）。
//      天秤座は活動宮由来、射手座は火由来。いずれも差 10 ポイント未満（やや低め）
foreach (['libra', 'sagittarius'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'tendencies.浮気耐性.note', 'required' => true, 'mainReason' => true,
        're' => "/^誠実性が主軸の指標です。誠実性への寄与が無いことが主因で、($EL_QU_RE(?:・$EL_QU_RE)*)由来の行動主導性がマイナスに働く分も加わり、全体平均（([\\d.]+)%）より(やや)?低めの([\\d.]+)%です。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '浮気耐性'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt); $d = $ov - $self;
            $degOk = $m[3] === 'やや' ? ($d > 0 && $d < 10) : ($d >= 10 && $d < 20);
            $ok = dominantPrim($mt) === '誠実性' && ($fo['行動主導性'] ?? 0) < 0 && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '行動主導性') === explode('・', $m[1])
                && $t['誠実性'] < 0 && $t['行動主導性'] < 0 && abs($t['誠実性']) > abs($t['行動主導性'])
                && near($m[2], $ov) && near($m[4], $self) && $degOk;
            return [$ok, "{$a['name']} 誠実性の源=" . (implode('・', seizaSrcNames($si, '誠実性')) ?: 'なし') . ' 行動主導性の源=' . implode('・', seizaSrcNames($si, '行動主導性')) . ' vs全体 ' . sprintf('誠実性%+.3f 行動主導性%+.3f', $t['誠実性'], $t['行動主導性']) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f、記事「%s低め」）', -$d, $m[3])]; }];
}

// ---- 2026-10-06（続き）：程度の語の不一致（「より低め」→「よりやや低め」、差 10 ポイント未満）と B型の独占欲の理由づけを修正 ----
// 旧文「より低め」（やや なし）は (20) を全注記に広げたことで検出する（差 10 ポイント未満のため FAIL）。B型の独占欲の旧文は (21) を blood/* に広げて検出する。
// (24) seiza 恋愛の慎重さ（双子座・天秤座）：差は誠実性の項だけ（－）。自立性はどの星座のエレメント・クオリティからも加算されず、自立性の項は 0。
//      差 10 ポイント未満（やや低め）。旧文「誠実性・自立性のどちらにも(星座)の構造から寄与が無いため」は、差を生まない自立性も理由に挙げていたため (27) で検出する
// 2026-10-07：牡羊座・蟹座・魚座・射手座を追加（指示 3。旧文「誠実性・自立性のどちらも(星座)の構造からは直接伸びません。実測では…やや低めの結果になっています」は、
// 差を生まない自立性を理由に挙げていたため、5e 節の reason（自立性は寄与差が0）で検出する）
foreach (['gemini', 'libra', 'aries', 'cancer', 'pisces', 'sagittarius'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'styles.恋愛の慎重さ.note', 'required' => true,
        're' => "/^誠実性への寄与が無いため、全体平均（([\\d.]+)%）よりやや低めです。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '恋愛の慎重さ'; $fs = array_keys(formulaOf($mt)); sort($fs); $name = (string)($a['name'] ?? ''); $si = signIndex($name);
            $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt); $d = $ov - $self;
            $autSign = array_values(array_filter(sourcesOf('自立性'), fn($s) => in_array($s['kind'], ['element', 'quality'], true)));
            $ok = $fs === ['自立性', '誠実性'] && seizaSrcNames($si, '誠実性') === [] && $autSign === []
                && $t['誠実性'] < 0 && abs($t['自立性']) < 1e-9 && near($m[1], $ov) && $d > 0 && $d < 10;
            return [$ok, "{$name} 誠実性の源=" . (implode('・', seizaSrcNames($si, '誠実性')) ?: 'なし') . ' 自立性へのエレメント・クオリティの加算=' . count($autSign) . '件'
                . ' vs全体 ' . sprintf('誠実性%+.3f 自立性%+.3f', $t['誠実性'], $t['自立性']) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', -$d)]; }];
}
// (25) seiza 浮気耐性（魚座・双子座）：主因は誠実性への寄与が無いこと（－）。差し引かれる行動主導性への寄与も無い分（＋）は逆向きで、誠実性の項の 0.3 倍
//      （「おおむね打ち消す」の基準（2026-10-07 から 0.75 倍。以前は 0.5 倍）未満のため、主因だけを挙げる書き方のまま。0.3 倍は「一部打ち消す」の幅だが、
//      打ち消す側の項は書かなくてもよい（書くなら「一部」）。差 10 ポイント未満（やや低め）
//      2026-10-06（続き）：双子座を追加。旧文「誠実性・行動主導性のどちらにも双子座の構造から直接の寄与が無いため」は、
//      押し上げる向き（＋）の行動主導性も「低い」理由に挙げていたため (27) の向きの判定で検出する
foreach (['pisces', 'gemini'] as $slug) {
    $CLAIMS[] = ['art' => "seiza/$slug", 'where' => 'tendencies.浮気耐性.note', 'required' => true,
        're' => "/^誠実性への寄与が無いため、全体平均（([\\d.]+)%）よりやや低めです。$/u",
        'expect' => function ($m, string $rel = '', array $a = []) {
            $mt = '浮気耐性'; $fo = formulaOf($mt); $si = signIndex((string)($a['name'] ?? '')); $t = termsDiff($mt, ['s' => $si], []); $self = high(['s' => $si], $mt); $ov = high([], $mt); $d = $ov - $self;
            $ok = dominantPrim($mt) === '誠実性' && ($fo['行動主導性'] ?? 0) < 0 && seizaSrcNames($si, '誠実性') === [] && seizaSrcNames($si, '行動主導性') === []
                && $t['誠実性'] < 0 && abs($t['行動主導性']) < RATIO_MOSTLY[0] * abs($t['誠実性']) && near($m[1], $ov) && $d > 0 && $d < 10;
            return [$ok, "{$a['name']} 誠実性の源=" . (implode('・', seizaSrcNames($si, '誠実性')) ?: 'なし') . ' 行動主導性の源=' . (implode('・', seizaSrcNames($si, '行動主導性')) ?: 'なし')
                . ' vs全体 ' . sprintf('誠実性%+.3f 行動主導性%+.3f（比%.2f）', $t['誠実性'], $t['行動主導性'], abs($t['行動主導性']) / max(1e-9, abs($t['誠実性']))) . ' High ' . r1($self) . ' / 全体' . r1($ov) . sprintf('（差%+.1f）', -$d)]; }];
}
// (26) blood/b-love 独占欲：O型・AB型との差の主因は情動性への寄与が無いこと（－1.4）、従は「独立」由来の自立性（式で差し引かれる、－0.6）。
//      A型とは情動性の寄与が無い点が同じで（情動性の項 0）、差は自立性の項だけ。High は 4血液型で最も低い
$CLAIMS[] = ['art' => 'blood/b-love', 'where' => 'styles.独占欲.note', 'required' => true,
    're' => '/^O型・AB型との差は、情動性への寄与が無いことが主因で、「([^」]+)」由来の自立性がマイナスに働く分も加わります。情動性の寄与が無い点が同じA型とは自立性の分だけ差がつき、4血液型の中で最も低い水準です。$/u',
    'expect' => function ($m) {
        $mt = '独占欲'; $fo = formulaOf($mt); $c = []; foreach (BLOODS as $bt) $c[$bt] = contribOf('b', $bt);
        $traitOk = count(array_filter(BLOOD_TRAIT_MAPPING['B'], fn($r) => $r['trait'] === $m[1] && primOfTrait($r['trait']) === '自立性')) > 0;
        $hs = []; foreach (BLOODS as $bt) $hs[$bt] = high(['b' => $bt], $mt);
        $tA = termsDiff($mt, ['b' => 'B'], ['b' => 'A']); $tO = termsDiff($mt, ['b' => 'B'], ['b' => 'O']); $tAB = termsDiff($mt, ['b' => 'B'], ['b' => 'AB']);
        $ok = ($fo['情動性'] ?? 0) > 0 && ($fo['自立性'] ?? 0) < 0 && $traitOk
            && !isset($c['B']['情動性']) && !isset($c['A']['情動性']) && ($c['O']['情動性'] ?? 0) > 0 && ($c['AB']['情動性'] ?? 0) > 0
            && ($c['B']['自立性'] ?? 0) > 0 && !isset($c['A']['自立性']) && !isset($c['O']['自立性']) && !isset($c['AB']['自立性'])
            && $tO['情動性'] < 0 && $tO['自立性'] < 0 && abs($tO['情動性']) > abs($tO['自立性'])
            && $tAB['情動性'] < 0 && $tAB['自立性'] < 0 && abs($tAB['情動性']) > abs($tAB['自立性'])
            && abs($tA['情動性']) < 1e-9 && $tA['自立性'] < 0
            && $hs['B'] < min($hs['A'], $hs['O'], $hs['AB']);
        return [$ok, "Trait「{$m[1]}」→自立性=" . ($traitOk ? 'B型にあり' : '無し') . ' vsA ' . termsStr($tA) . ' vsO ' . termsStr($tO) . ' vsAB ' . termsStr($tAB) . ' High A/B/O/AB=' . implode('/', array_map('r1', $hs))]; }];
// (27) 旧文の検出（required=false）：星座記事の注記「(P)・(Q)のどちらにも(星座)の構造から(直接の)?寄与が無いため」で、
//      挙げた P・Q のうち全体平均との寄与差が 0 の項（星座で差が生まれない項）を理由に挙げていれば FAIL
//      （2026-10-06修正前の双子座・天秤座の恋愛の慎重さ。自立性はどの星座のエレメント・クオリティからも加算されない）。
//      2026-10-06（続き）：向きの判定を追加。「ため」の後の結論「全体平均（X%）より…(低|高)」の向きと、挙げた項の寄与差の符号が逆
//      （「低い」の理由に寄与差が＋の項を挙げている、またはその逆）なら FAIL。結論の向きを特定できない形は照合できていないので FAIL（要判断）。
//      （2026-10-06修正前の双子座の浮気耐性。式は 誠実性×0.7－行動主導性×0.3 で、行動主導性の寄与が無いことは浮気耐性を押し上げる向き（＋0.18））
//      2026-10-07：(27) は 5e 節の「理由の主従」（列挙した項・列挙しない「どちらにも〜寄与が無いため」・「〜のみのため」等を全記事・全フィールドで照合）に統合した。
//      判定（寄与差が 0 の項・結論と逆向きの項を理由に挙げていれば FAIL）は 5e と同じ。結論の向きを特定できない形は 5e の「照合できない理由」として出力する。

// ---- 2026-10-07：程度の語・理由の主従の修正（指示 1〜4 と、5e 節の走査で見つかった同じ種類の不一致） ----
// 直した文をすべて required=true の主張として登録する（DEVELOPMENT_RULES「記事の事実検証ルール」5）。旧文は 5e 節の一般の検査（degree:* ／ reason@*）で FAIL する。
// 各主張は、文全体の正規表現（書かれた数値はグループ）と、次の宣言（$FIXED の 'spec'）から期待値を inc・スナップショットで計算して照合する。
//   'vals' => [グループ番号 => [指標, 比較相手]]  書かれた High 率（比較相手 'self'＝記事の主体、'all'＝9216件全体、'b:O'・'m:ENTP'・'s:山羊座'）
//   'cmp'  => [[ 'm' => 指標の配列, 'base' => 比較相手（配列可。'top'＝4血液型の最上級）, 'deg' => 程度, 'w' => 語, 以下は任意 ], ...]
//               程度・向きは degreeJudge()（5e 節と同じ基準）、'top' は自身が4血液型の最高（最低）であること
//     'main'    => P        主因と書いた項：寄与差（termsDiff）の絶対値が最大で、結論の向きに働く
//     'cited'   => [P, ...] 理由に挙げた項：主因を含み、どれも結論と逆向きでなく、どれも少なくとも1つの比較相手で寄与差が 0 でない
//     'add'     => [P, ...] 「〜分も加わり」と従として挙げた項：結論の向きに働き、主因より小さい
//     'counter' => [P, 下限, 上限]  打ち消す側の項：結論と逆向きで、主因の項に対する絶対値の比が [下限, 上限)
//     'zero'    => [P, ...] 差を生まない項（寄与差が 0）
//     'wsign'   => [P => ±1]  「プラスに働く」「マイナスに働く」「差し引かれる」と書いた項の、式での重みの符号
//     'src'     => [P => [源...]] ／ 'srcGroup' => [P => グループ番号]  星座のエレメント・クオリティのうち P へ加算する源（seizaSrcNames）
//     'reasonOnly' => 1|-1   程度を照合せず、'base' の相手との理由（main・cited・add・zero 等）だけを、この向きで照合する（2026-10-07、相手を分けて書いた理由）
// 打ち消す側の比の語（5 節の「おおむね補う」と同じ考え方。2026-10-07 に「一部」を加え、重ならないように「おおむね」の下限を 0.5 から 0.75 に上げた）:
//   「一部打ち消す」: 0.2 以上 0.75 未満（双子座・天秤座の嫉妬深さは 誠実性+0.33 ／ 情動性−0.60 ＝ 0.56。水瓶座・乙女座・天秤座の惚れやすさは 変化志向+0.17 ／ 情動性−0.60 ＝ 0.28）
//   「おおむね打ち消す／補う」: 0.75 以上 1 未満（既存の (3) 0.80、(12) 0.94）
//   「小さい」（従の項。同じ向き）: 0.2 未満（既存の (8)(9)）
const RATIO_PARTIAL = [0.2, 0.75];
const RATIO_MOSTLY = [0.75, 1.0];
function fixedBase(string $b, string $rel, array $a): array {
    if ($b === 'all') return [];
    if ($b === 'self') return fixedSelf($rel, $a);
    [$k, $v] = explode(':', $b, 2);
    return [$k => $k === 's' ? signIndex($v) : $v];
}
function fixedSelf(string $rel, array $a): array {
    $cat = explode('/', $rel)[0];
    return $cat === 'seiza' ? ['s' => signIndex((string)$a['name'])] : ($cat === 'blood' ? ['b' => (string)$a['code']] : ['m' => strtoupper((string)$a['code'])]);
}
function fixedClaimCheck(array $m, string $rel, array $a, array $spec): array {
    $self = fixedSelf($rel, $a); $ok = true; $info = [];
    foreach ($spec['vals'] ?? [] as $gi => [$mt, $b]) { $v = high(fixedBase($b, $rel, $a), $mt); $ok = $ok && near($m[$gi], $v); $info[] = "{$mt}({$b})記事={$m[$gi]}/実測=" . r1($v); }
    foreach ($spec['cmp'] as $c) {
        $bases = $c['base'] === 'top' ? array_map(fn($bt) => ['b' => $bt], array_values(array_diff(BLOODS, [$self['b'] ?? '']))) : array_map(fn($b) => fixedBase($b, $rel, $a), (array)$c['base']);
        foreach ($c['m'] as $mt) {
            $hs = high($self, $mt); $fo = formulaOf($mt);
            if ($c['base'] === 'top') {
                $all = []; foreach (BLOODS as $bt) $all[$bt] = round(high(['b' => $bt], $mt), 1);
                $up = $c['w'] === '高'; $dir = $up ? 1 : -1;
                $okD = $all[$self['b']] == ($up ? max($all) : min($all)); $info[] = "{$mt} 最" . ($up ? '高' : '低') . ($okD ? '' : 'でない') . ' ' . json_encode($all);
            } elseif (isset($c['reasonOnly'])) {
                // 2026-10-07：比較相手を分けて書いた理由（「O型・AB型との差は…、A型とは…」）。程度は同じ文の別の 'cmp' で照合し、ここでは指定した相手との理由だけを照合する
                $okD = true; $dir = $c['reasonOnly'];
            } else {
                $okD = true; $dir = preg_match('/^(?:高|上回|上が)/u', $c['w']) ? 1 : -1;
                foreach ($bases as $bf) { [$o1, $why] = degreeJudge($c['deg'], $c['w'], $hs - high($bf, $mt)); $okD = $okD && $o1; $info[] = sprintf('%s 差%+.1f', $mt, $hs - high($bf, $mt)) . " $why"; }
            }
            $ok = $ok && $okD;
            $nonzero = [];
            foreach ($bases as $bf) {
                $t = termsDiff($mt, $self, $bf); $mains = mainTerms($t); $mx = $mains ? abs($t[$mains[0]]) : 0.0;
                if ($mains === []) continue;  // 同率の相手（寄与差がすべて 0）
                if (isset($c['main'])) $ok = $ok && in_array($c['main'], $mains, true) && $t[$c['main']] * $dir > 1e-9;
                if (isset($c['cited'])) {
                    $cited = array_values(array_intersect($c['cited'], array_keys($fo)));
                    $ok = $ok && $cited !== [] && array_intersect($mains, $cited) !== [];
                    foreach ($cited as $p) { $ok = $ok && $t[$p] * $dir >= -1e-9; if (abs($t[$p]) > 1e-9) $nonzero[$p] = true; }
                }
                foreach ($c['add'] ?? [] as $p) $ok = $ok && $t[$p] * $dir > 1e-9 && abs($t[$p]) < $mx;
                if (isset($c['counter'])) { [$p, $lo, $hi] = $c['counter']; $r = abs($t[$p]) / max(1e-9, $mx); $ok = $ok && $t[$p] * $dir < -1e-9 && $r >= $lo && $r < $hi; $info[] = sprintf('%s/主因の比=%.2f', $p, $r); }
                foreach ($c['zero'] ?? [] as $p) $ok = $ok && abs($t[$p] ?? 0.0) < 1e-9;
                $info[] = termsStr($t);
            }
            if (isset($c['cited'])) foreach (array_intersect($c['cited'], array_keys($fo)) as $p) $ok = $ok && isset($nonzero[$p]);
            foreach ($c['wsign'] ?? [] as $p => $sg) $ok = $ok && isset($fo[$p]) && $fo[$p] * $sg > 0;
            foreach ($c['src'] ?? [] as $p => $names) { $act = seizaSrcNames($self['s'], $p); $ok = $ok && $act === $names; $info[] = "{$p}の源=" . (implode('・', $act) ?: 'なし'); }
            foreach ($c['srcGroup'] ?? [] as $p => $gi) { $act = seizaSrcNames($self['s'], $p); $ok = $ok && $act === explode('・', $m[$gi]); $info[] = "{$p}の源=" . (implode('・', $act) ?: 'なし'); }
            // 2026-10-07：'letter' => [[文字, P], ...]  「(文字)による(P)への寄与」：自身のタイプがその文字を持ち、比較相手は持たず、その文字が P に寄与する（inc の MBTI マッピング）
            foreach ($c['letter'] ?? [] as [$L, $p]) {
                $okL = in_array($p, letterPrims($L), true) && str_contains((string)($self['m'] ?? ''), $L);
                foreach ($bases as $bf) $okL = $okL && isset($bf['m']) && !str_contains($bf['m'], $L);
                $ok = $ok && $okL; $info[] = "{$L}→{$p}" . ($okL ? '' : '（不一致）');
            }
        }
    }
    return [$ok, implode(' ', $info)];
}
/** 文（数値の位置に {v}、星座のエレメント・クオリティの位置に {src}）から正規表現を作る。$anchor=true は注記全体と一致 */
function fixedRe(string $s, bool $anchor = false): string {
    $q = str_replace(['\{v\}', '\{src\}'], ['([\d.]+)', '((?:火|地|風|水|活動宮|不動宮|柔軟宮)(?:・(?:火|地|風|水|活動宮|不動宮|柔軟宮))*)'], preg_quote($s, '/'));
    return '/' . ($anchor ? '^' : '') . $q . ($anchor ? '$' : '') . '/u';
}
$P_REL = '誠実性'; $P_SEN = '情動性'; $P_ACT = '行動主導性'; $P_AUT = '自立性'; $P_TRA = '変化志向';
$FIXED = [
    // 指示 1：嫉妬深さ（双子座・天秤座）。主因＝情動性への寄与が無いこと、差し引かれる誠実性への寄与も無いことが一部打ち消す（比 0.56）
    [['seiza/gemini', 'seiza/libra'], 'styles.嫉妬深さ.note', true, '情動性から誠実性を差し引く指標です。情動性への寄与が無いことが主因で、差し引かれる誠実性への寄与も無いことがそれを一部打ち消すため、全体平均（{v}%）よりやや低い程度にとどまります。',
        ['vals' => [1 => ['嫉妬深さ', 'all']], 'cmp' => [['m' => ['嫉妬深さ'], 'base' => 'all', 'deg' => 'やや', 'w' => '低い', 'main' => $P_SEN, 'counter' => [$P_REL, RATIO_PARTIAL[0], RATIO_PARTIAL[1]], 'wsign' => [$P_REL => -1], 'src' => [$P_SEN => [], $P_REL => []]]]]],
    // 指示 2：「大きく」を外した注記（差 10〜20）
    [['seiza/libra'], 'styles.包容力.note', true, '誠実性・情動性のどちらにも天秤座の構造から寄与が無いため、全体平均（{v}%）より低くなります。',
        ['vals' => [1 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => '', 'w' => '低く', 'cited' => [$P_REL, $P_SEN], 'src' => [$P_REL => [], $P_SEN => []]]]]],
    [['seiza/cancer'], 'styles.積極性.note', true, '情動性・行動主導性の両方に直接寄与する構造により、全体平均（{v}%）を上回ります。',
        ['vals' => [1 => ['積極性', 'all']], 'cmp' => [['m' => ['積極性'], 'base' => 'all', 'deg' => '', 'w' => '上回', 'cited' => [$P_SEN, $P_ACT]]]]],
    [['seiza/taurus'], 'styles.包容力.note', true, '誠実性・情動性から構成される指標です。誠実性が地・不動宮の二重寄与で強く伸びるため、全体平均（{v}%）を上回ります。',
        ['vals' => [1 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => '', 'w' => '上回', 'cited' => [$P_REL], 'src' => [$P_REL => ['地', '不動宮']]]]]],
    [['seiza/virgo'], 'tendencies.浮気耐性.note', true, '誠実性がプラスに働く一方、行動主導性への寄与が無くマイナス項が発生しないため、全体平均（{v}%）を上回ります。',
        ['vals' => [1 => ['浮気耐性', 'all']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 'all', 'deg' => '', 'w' => '上回', 'cited' => [$P_REL, $P_ACT], 'wsign' => [$P_REL => 1, $P_ACT => -1], 'src' => [$P_ACT => []]]]]],
    [['seiza/taurus'], 'styles.惚れやすさ.note', true, '情動性・変化志向のどちらにも牡牛座の構造から寄与が無いため、全体平均（{v}%）より低くなります。',
        ['vals' => [1 => ['惚れやすさ', 'all']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '低く', 'cited' => [$P_SEN, $P_TRA], 'src' => [$P_SEN => [], $P_TRA => []]]]]],
    [['seiza/capricorn'], 'styles.惚れやすさ.note', true, '情動性・変化志向のどちらにも山羊座の構造から寄与が無いため、全体平均（{v}%）より低くなります。',
        ['vals' => [1 => ['惚れやすさ', 'all']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '低く', 'cited' => [$P_SEN, $P_TRA], 'src' => [$P_SEN => [], $P_TRA => []]]]]],
    // 指示 4：惚れやすさ（水瓶座・天秤座・乙女座）。主因＝情動性への寄与が無いこと、変化志向（＋0.17）が一部打ち消す（比 0.28）。差 10〜20（低め）
    [['seiza/aquarius', 'seiza/libra', 'seiza/virgo'], 'styles.惚れやすさ.note', true, '情動性と変化志向で決まる指標です。情動性への寄与が無いことが主因で、{src}由来の変化志向への寄与がそれを一部打ち消すものの、全体平均（{v}%）より低めです。',
        ['vals' => [2 => ['惚れやすさ', 'all']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'main' => $P_SEN, 'counter' => [$P_TRA, RATIO_PARTIAL[0], RATIO_PARTIAL[1]], 'src' => [$P_SEN => []], 'srcGroup' => [$P_TRA => 1]]]]],
    // 5e の走査：修飾なしの「上回る」で差 10 未満 →「やや上回る」
    [['seiza/capricorn', 'seiza/virgo'], 'styles.包容力.note', false, '誠実性が主軸の指標です。地由来の寄与により、全体平均（{v}%）をやや上回ります。',
        ['vals' => [1 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回', 'cited' => [$P_REL], 'src' => [$P_REL => ['地']]]]]],
    [['seiza/capricorn'], 'tendencies.浮気耐性.note', false, '誠実性はプラス、行動主導性はマイナスに働きますが、誠実性の寄与の方が強いため、全体平均（{v}%）をやや上回ります。',
        ['vals' => [1 => ['浮気耐性', 'all']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回', 'main' => $P_REL, 'counter' => [$P_ACT, 0.0, 1.0], 'wsign' => [$P_REL => 1, $P_ACT => -1]]]]],
    [['seiza/leo'], 'styles.包容力.note', false, '誠実性・情動性の両方に獅子座の構造から直接寄与するため、全体平均（{v}%）をやや上回ります。',
        ['vals' => [1 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回', 'cited' => [$P_REL, $P_SEN], 'src' => [$P_REL => ['不動宮'], $P_SEN => ['火']]]]]],
    [['seiza/scorpio'], 'styles.包容力.note', false, '誠実性・情動性の両方に蠍座の構造から直接寄与するため、全体平均（{v}%）をやや上回ります。',
        ['vals' => [1 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回', 'cited' => [$P_REL, $P_SEN], 'src' => [$P_REL => ['不動宮'], $P_SEN => ['水']]]]]],
    [['seiza/leo', 'seiza/scorpio'], 'faq', false, '「包容力」がHigh{v}%と全体平均（{v}%）をやや上回っています。',
        ['vals' => [1 => ['包容力', 'self'], 2 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回']]]],
    [['seiza/leo'], 'matome', false, 'Love Engineの実測（768パターン）では、火（エレメント）→情動性・行動主導性、不動宮（クオリティ）→誠実性という構造的な寄与により、包容力（High{v}%）が全体平均をやや上回る。',
        ['vals' => [1 => ['包容力', 'self']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回', 'cited' => [$P_SEN, $P_REL], 'src' => [$P_SEN => ['火'], $P_REL => ['不動宮']]]]]],
    [['seiza/scorpio'], 'matome', false, 'Love Engineの実測（768パターン）では、水（エレメント）→情動性、不動宮（クオリティ）→誠実性という構造的な寄与により、包容力（High{v}%）が全体平均をやや上回る。',
        ['vals' => [1 => ['包容力', 'self']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => 'やや', 'w' => '上回', 'cited' => [$P_SEN, $P_REL], 'src' => [$P_SEN => ['水'], $P_REL => ['不動宮']]]]]],
    // 5e の走査：愛情表現。差 20 以上 →「大きく上回る」、差 10 未満 →「やや高く」
    [['seiza/leo', 'seiza/sagittarius'], 'styles.愛情表現.note', true, '情動性の重みが大きい指標のため、火（情熱）由来の寄与で全体平均（{v}%）を大きく上回ります。',
        ['vals' => [1 => ['愛情表現', 'all']], 'cmp' => [['m' => ['愛情表現'], 'base' => 'all', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN], 'src' => [$P_SEN => ['火']]]]]],
    [['seiza/pisces', 'seiza/scorpio'], 'styles.愛情表現.note', true, '情動性の重みが大きい指標のため、水（感情・共感）由来の寄与で全体平均（{v}%）よりやや高くなります。',
        ['vals' => [1 => ['愛情表現', 'all']], 'cmp' => [['m' => ['愛情表現'], 'base' => 'all', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_SEN], 'src' => [$P_SEN => ['水']]]]]],
    // 5e の走査：まとめ・因果の説明（数値の無い「全体平均より…」）
    [['seiza/aries'], 'matome', false, 'Love Engineの実測（768パターン）では、火（エレメント）→情動性・行動主導性、活動宮（クオリティ）→行動主導性という構造的な寄与により、積極性・愛情表現が全体平均を大きく上回り、独占欲・惚れやすさ・嫉妬深さも全体平均より高くなる。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 'all', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN, $P_ACT], 'src' => [$P_SEN => ['火'], $P_ACT => ['火', '活動宮']]],
                   ['m' => ['独占欲', '惚れやすさ', '嫉妬深さ'], 'base' => 'all', 'deg' => '', 'w' => '高く', 'cited' => [$P_SEN]]]]],
    [['seiza/aries'], 'matome', false, '誠実性への直接の寄与が無いため、包容力・恋愛の慎重さ・結婚志向は全体平均並みかやや低め。',
        ['cmp' => [['m' => ['包容力', '恋愛の慎重さ', '結婚志向'], 'base' => 'all', 'deg' => 'やや', 'w' => '低め', 'cited' => [$P_REL], 'zero' => [], 'src' => [$P_REL => []]]]]],
    [['seiza/cancer'], 'matome', false, 'Love Engineの実測（768パターン）では、水（エレメント）→情動性、活動宮（クオリティ）→行動主導性という構造的な寄与により、愛情表現が全体平均を大きく上回り、積極性・独占欲・惚れやすさ・嫉妬深さも全体平均より高くなる。',
        ['cmp' => [['m' => ['愛情表現'], 'base' => 'all', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN, $P_ACT], 'src' => [$P_SEN => ['水'], $P_ACT => ['活動宮']]],
                   ['m' => ['積極性', '独占欲', '惚れやすさ', '嫉妬深さ'], 'base' => 'all', 'deg' => '', 'w' => '高く', 'cited' => [$P_SEN]]]]],
    [['seiza/capricorn'], 'matome', false, '情動性・変化志向への直接の寄与が無いため、惚れやすさ（High{v}%）は全体平均より低い。',
        ['vals' => [1 => ['惚れやすさ', 'self']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '低い', 'cited' => [$P_SEN, $P_TRA], 'src' => [$P_SEN => [], $P_TRA => []]]]]],
    [['seiza/leo'], 'matome', false, '火から情動性・行動主導性の両方に寄与するため積極性（High{v}%）も全体平均を上回り、',
        ['vals' => [1 => ['積極性', 'self']], 'cmp' => [['m' => ['積極性'], 'base' => 'all', 'deg' => '', 'w' => '上回', 'cited' => [$P_SEN, $P_ACT], 'src' => [$P_SEN => ['火'], $P_ACT => ['火']]]]]],
    [['seiza/libra', 'seiza/pisces', 'seiza/sagittarius'], 'matome', false, '誠実性への直接の寄与が無いため、結婚志向は全体平均より低め、恋愛の慎重さ・浮気耐性は全体平均よりやや低め。',
        ['cmp' => [['m' => ['結婚志向'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'cited' => [$P_REL], 'src' => [$P_REL => []]],
                   ['m' => ['恋愛の慎重さ', '浮気耐性'], 'base' => 'all', 'deg' => 'やや', 'w' => '低め', 'cited' => [$P_REL]]]]],
    [['seiza/taurus'], 'matome', false, '一方、情動性・変化志向への寄与が無いため惚れやすさ（High{v}%）は全体平均より低く、嫉妬深さ（High{v}%）は差し引かれる誠実性が二重に効くことが主因で全体平均より大きく低い。',
        ['vals' => [1 => ['惚れやすさ', 'self'], 2 => ['嫉妬深さ', 'self']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '低く', 'cited' => [$P_SEN, $P_TRA], 'src' => [$P_SEN => [], $P_TRA => []]],
                   ['m' => ['嫉妬深さ'], 'base' => 'all', 'deg' => '大きく', 'w' => '低い', 'main' => $P_REL, 'wsign' => [$P_REL => -1], 'src' => [$P_REL => ['地', '不動宮']]]]]],
    [['seiza/taurus'], 'causal_explanation', false, '行動主導性・情動性への寄与は無いため、積極性・愛情表現・独占欲・惚れやすさは全体平均より低めになり、嫉妬深さは差し引かれる誠実性が二重に効くことが主因で全体平均より大きく低くなります。',
        ['cmp' => [['m' => ['積極性', '愛情表現', '独占欲', '惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'cited' => [$P_ACT, $P_SEN], 'src' => [$P_ACT => [], $P_SEN => []]],
                   ['m' => ['嫉妬深さ'], 'base' => 'all', 'deg' => '大きく', 'w' => '低く', 'main' => $P_REL, 'wsign' => [$P_REL => -1]]]]],
    // 5e の走査：FAQ の理由の主従
    [['seiza/gemini'], 'faq', false, '「結婚志向」はHigh{v}%と全体平均（{v}%）より低めですが、これは双子座の構造上、誠実性への寄与が無いことが主因で、変化志向がマイナスに働く項として二重に効く分も加わるためです。',
        ['vals' => [1 => ['結婚志向', 'self'], 2 => ['結婚志向', 'all']], 'cmp' => [['m' => ['結婚志向'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'main' => $P_REL, 'add' => [$P_TRA], 'wsign' => [$P_TRA => -1], 'src' => [$P_REL => [], $P_TRA => ['風', '柔軟宮']]]]]],
    [['seiza/virgo'], 'faq', false, '「浮気耐性」がHigh{v}%と全体平均（{v}%）を上回っています。浮気耐性は誠実性から行動主導性を差し引く指標で、乙女座ではエレメント（地）由来の誠実性への寄与が主因です。そのうえ乙女座は行動主導性への寄与を一切持たないため差し引かれる分も無く、誠実性の効果がそのまま表れやすくなっています。',
        ['vals' => [1 => ['浮気耐性', 'self'], 2 => ['浮気耐性', 'all']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 'all', 'deg' => '', 'w' => '上回', 'main' => $P_REL, 'add' => [$P_ACT], 'wsign' => [$P_REL => 1, $P_ACT => -1], 'src' => [$P_REL => ['地'], $P_ACT => []]]]]],
    [['seiza/virgo'], 'matome', false, '行動主導性への寄与が一切無いため、浮気耐性（High{v}%）は誠実性の効果が薄まらずそのまま表れ、山羊座（High{v}%）よりやや高くなる。',
        ['vals' => [1 => ['浮気耐性', 'self'], 2 => ['浮気耐性', 's:山羊座']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 's:山羊座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'src' => [$P_ACT => []]]]]],
    // 5e の走査：血液型
    [['blood/a-love'], 'styles.独占欲.note', true, '情動性への寄与が無いため、O型・AB型より大きく低くなります。',
        ['cmp' => [['m' => ['独占欲'], 'base' => ['b:O', 'b:AB'], 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_SEN]]]]],
    // 2026-10-07（Reviewer 差し戻し m-2）：blood/a-love のまとめ（積極性・愛情表現・惚れやすさ・嫉妬深さ）は相手を分けて書き直したため、下の $FIXED_B に移した
    [['blood/ab-love'], 'styles.積極性.note', false, '行動主導性がO型より弱いため、O型（High{v}%）より大きく低くなります。',
        ['vals' => [1 => ['積極性', 'b:O']], 'cmp' => [['m' => ['積極性'], 'base' => 'b:O', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN]]]]],
    [['blood/ab-love'], 'styles.愛情表現.note', false, '行動主導性の影響は小さいため、O型（{v}%）よりやや低い程度にとどまります。',
        ['vals' => [1 => ['愛情表現', 'b:O']], 'cmp' => [['m' => ['愛情表現'], 'base' => 'b:O', 'deg' => 'やや', 'w' => '低い', 'cited' => [$P_ACT], 'zero' => [$P_SEN]]]]],
    [['blood/ab-love'], 'causal_explanation', false, '行動主導性が絡む指標（積極性・愛情表現・浮気耐性）ではO型と差がつき、行動主導性がプラスに働く積極性はO型より大きく低く、愛情表現はO型よりやや低くなります。行動主導性がマイナスに働く浮気耐性は、逆にO型よりやや高くなります。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'b:O', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_ACT], 'wsign' => [$P_ACT => 1]],
                   ['m' => ['愛情表現'], 'base' => 'b:O', 'deg' => 'やや', 'w' => '低く', 'cited' => [$P_ACT]],
                   ['m' => ['浮気耐性'], 'base' => 'b:O', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'wsign' => [$P_ACT => -1]]]]],
    [['blood/b-love'], 'tendencies.浮気耐性.note', true, 'O型と同じく誠実性への寄与は無いものの、計算式でマイナスに働く行動主導性への寄与も無いため、O型（{v}%）よりやや高くなります。',
        ['vals' => [1 => ['浮気耐性', 'b:O']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 'b:O', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    // 2026-10-07（Reviewer 差し戻し m-2）：blood/b-love の FAQ（結婚志向）とまとめ（包容力・独占欲・結婚志向）は相手を分けて書き直したため、下の $FIXED_B に移した
    // 5e の走査：MBTI
    [['mbti/enfp'], 'styles.嫉妬深さ.note', false, '誠実性はどちらのタイプもほぼ0のため、情動性の差がそのまま反映され、ENTP（High{v}%）を大きく上回ります。',
        ['vals' => [1 => ['嫉妬深さ', 'm:ENTP']], 'cmp' => [['m' => ['嫉妬深さ'], 'base' => 'm:ENTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN], 'zero' => [$P_REL]]]]],
    [['mbti/enfp'], 'faq', false, '「独占欲」の指標はHigh{v}%とENTP（{v}%）を大きく上回る傾向が見られます。情動性が二重に伸びる構造による影響で',
        ['vals' => [1 => ['独占欲', 'self'], 2 => ['独占欲', 'm:ENTP']], 'cmp' => [['m' => ['独占欲'], 'base' => 'm:ENTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN]]]]],
    [['mbti/esfj'], 'faq', false, 'Sは誠実性に、Nは情動性に寄与するため、ESFJは誠実性が絡む指標（恋愛の慎重さ・浮気耐性）でENFJより高い一方、',
        ['cmp' => [['m' => ['恋愛の慎重さ', '浮気耐性'], 'base' => 'm:ENFJ', 'deg' => '', 'w' => '高い', 'cited' => [$P_REL]]]]],
    [['mbti/esfp'], 'faq', false, 'Fは情動性に、Tは行動主導性に寄与するため、ESFPは情動性が絡む指標（愛情表現・独占欲・惚れやすさ・嫉妬深さ）でESTPを大きく上回る傾向があります。',
        ['cmp' => [['m' => ['愛情表現', '独占欲', '惚れやすさ', '嫉妬深さ'], 'base' => 'm:ESTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN]]]]],
    [['mbti/infj'], 'faq', false, 'そのためINFJは誠実性がI・J二重で伸び、恋愛の慎重さ・浮気耐性でENFJを大きく上回り、結婚志向もENFJより高い傾向があります。',
        ['cmp' => [['m' => ['恋愛の慎重さ', '浮気耐性'], 'base' => 'm:ENFJ', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL]],
                   ['m' => ['結婚志向'], 'base' => 'm:ENFJ', 'deg' => '', 'w' => '高い', 'cited' => [$P_REL]]]]],
    [['mbti/infp'], 'faq', false, 'Fは情動性に寄与するため、INFPは情動性に依存する指標（愛情表現・独占欲・惚れやすさ・嫉妬深さ）が高くなりやすく、独占欲・惚れやすさ・嫉妬深さはINTPを大きく上回り、愛情表現もINTPより高い傾向があります。',
        ['cmp' => [['m' => ['独占欲', '惚れやすさ', '嫉妬深さ'], 'base' => 'm:INTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN]],
                   ['m' => ['愛情表現'], 'base' => 'm:INTP', 'deg' => '', 'w' => '高い', 'cited' => [$P_SEN]]]]],
    [['mbti/intj'], 'faq', false, 'そのためINTJは誠実性がI・J二重で伸び、恋愛の慎重さでENTJを大きく上回り、結婚志向・浮気耐性もENTJより高い傾向があります。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => 'm:ENTJ', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL]],
                   ['m' => ['結婚志向', '浮気耐性'], 'base' => 'm:ENTJ', 'deg' => '', 'w' => '高い', 'cited' => [$P_REL]]]]],
    [['mbti/isfp'], 'faq', false, 'Iは誠実性・自立性の両方に寄与するため、ISFPは誠実性が絡む指標（恋愛の慎重さ・結婚志向・浮気耐性）が高くなりやすく、恋愛の慎重さ・浮気耐性はESFPを大きく上回り、結婚志向もESFPより高い傾向があります。',
        ['cmp' => [['m' => ['恋愛の慎重さ', '浮気耐性'], 'base' => 'm:ESFP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL]],
                   ['m' => ['結婚志向'], 'base' => 'm:ESFP', 'deg' => '', 'w' => '高い', 'cited' => [$P_REL]]]]],
    [['mbti/isfp'], 'faq', false, '行動主導性が絡む積極性ではISTPよりやや低くなります（行動主導性への寄与がISFPには全く無いため）。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'm:ISTP', 'deg' => 'やや', 'w' => '低く', 'cited' => [$P_ACT]]]]],
    [['mbti/istj'], 'faq', false, 'ただしTは行動主導性に、Fは情動性に寄与するため、浮気耐性（行動主導性が絡む）ではISTJがISFJより低く、',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 'm:ISFJ', 'deg' => '', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['mbti/istp'], 'faq', false, 'Iは誠実性・自立性の両方に寄与するため、ISTPは誠実性が絡む指標（恋愛の慎重さ・結婚志向）が高くなりやすく、恋愛の慎重さはESTPを大きく上回り、結婚志向もESTPより高い傾向があります。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => 'm:ESTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL]],
                   ['m' => ['結婚志向'], 'base' => 'm:ESTP', 'deg' => '', 'w' => '高い', 'cited' => [$P_REL]]]]],
];
foreach ($FIXED as [$arts, $where, $anchor, $sentence, $spec]) foreach ($arts as $art) {
    $CLAIMS[] = ['art' => $art, 'where' => $where, 'required' => true, 'rule' => 'fixed-20261007', 're' => fixedRe($sentence, $anchor),
        'expect' => fn($m, string $rel = '', array $a = []) => fixedClaimCheck($m, $rel, $a, $spec)];
}

// ---- 2026-10-07（Reviewer 差し戻し：M-2・m-2 と、5e の走査で見つかった同じ種類の不一致の修正） ----
// 直した文をすべて required=true で登録する（rule 'fixed-20261007b'。spec の書き方は上の $FIXED と同じ。'reasonOnly' は相手を分けて書いた理由）。
// 旧文は 5e 節の一般の検査（degree:* ／ reason@*。M-1 で加えた「上がる／下がる」「Xの方が」「Bundle の主軸別」の形と、
// m-2 で加えた「挙げた項が一部の相手と差を生まないのに相手を分けていない」の判定）で FAIL する（修正前のコピー C:/tmp/love-m-before で確認）。
$FIXED_B = [
    // M-2：MBTI
    [['mbti/esfj'], 'faq', false, '情動性が絡む指標（愛情表現・独占欲・惚れやすさ・嫉妬深さ）ではENFJより大きく下がる傾向があります。',
        ['cmp' => [['m' => ['愛情表現', '独占欲', '惚れやすさ', '嫉妬深さ'], 'base' => 'm:ENFJ', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_SEN]]]]],
    [['mbti/intj'], 'faq', false, '積極性は行動主導性に依存する指標で、行動主導性がE・T二重で伸びるENTJの方が大きく高くなります。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'm:ENTJ', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_ACT]]]]],
    [['mbti/isfp'], 'faq', false, 'ISFPは情動性が絡む指標（独占欲・惚れやすさ）でISTPを大きく上回り、愛情表現・包容力・嫉妬深さでもISTPより高い一方、',
        ['cmp' => [['m' => ['独占欲', '惚れやすさ'], 'base' => 'm:ISTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_SEN]],
                   ['m' => ['愛情表現', '包容力', '嫉妬深さ'], 'base' => 'm:ISTP', 'deg' => '', 'w' => '高い', 'cited' => [$P_SEN]]]]],
    [['mbti/enfj'], 'styles.惚れやすさ.note', true, '情動性と変化志向で決まる指標です。ENFJは変化志向への寄与が無いため、ENFP（High{v}%）より大きく下がります。',
        ['vals' => [1 => ['惚れやすさ', 'm:ENFP']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'm:ENFP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['mbti/enfj'], 'tendencies.結婚志向.note', false, '誠実性・変化志向で決まる指標です。ENFJは誠実性がプラスに働き変化志向のマイナス要因も無いため、ENFP（High{v}%）より上がります。',
        ['vals' => [1 => ['結婚志向', 'm:ENFP']], 'cmp' => [['m' => ['結婚志向'], 'base' => 'm:ENFP', 'deg' => '', 'w' => '上が', 'cited' => [$P_REL, $P_TRA], 'wsign' => [$P_REL => 1, $P_TRA => -1]]]]],
    [['mbti/entj'], 'tendencies.結婚志向.note', true, '誠実性・変化志向で決まる指標です。ENTJは誠実性がプラスに、変化志向の寄与が無いためマイナス要因も無くなり、ENTP（High{v}%）よりHighの割合が上がります。',
        ['vals' => [1 => ['結婚志向', 'm:ENTP']], 'cmp' => [['m' => ['結婚志向'], 'base' => 'm:ENTP', 'deg' => '', 'w' => '上が', 'cited' => [$P_REL, $P_TRA], 'wsign' => [$P_REL => 1, $P_TRA => -1]]]]],
    [['mbti/esfj'], 'styles.惚れやすさ.note', true, '情動性と変化志向で決まる指標です。変化志向への寄与が無いため、ESFP（High{v}%）より大きく下がります。',
        ['vals' => [1 => ['惚れやすさ', 'm:ESFP']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'm:ESFP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['mbti/estj'], 'styles.積極性.note', true, '行動主導性・情動性で決まる指標です。行動主導性は二重（E・T）に伸びますが、情動性への寄与が皆無なため、ENTJ（High{v}%）より大きく下がります。',
        ['vals' => [1 => ['積極性', 'm:ENTJ']], 'cmp' => [['m' => ['積極性'], 'base' => 'm:ENTJ', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_SEN], 'zero' => [$P_ACT]]]]],
    [['mbti/estp'], 'styles.積極性.note', true, '行動主導性・情動性で決まる指標です。行動主導性はENTPと同じく二重に伸びますが、情動性への寄与が無いため、ENTP（High{v}%）より大きく下がります。',
        ['vals' => [1 => ['積極性', 'm:ENTP']], 'cmp' => [['m' => ['積極性'], 'base' => 'm:ENTP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_SEN], 'zero' => [$P_ACT]]]]],
    [['mbti/infp'], 'styles.嫉妬深さ.note', true, '情動性から誠実性を差し引く指標です。情動性はENFPと同じですが、INFPはIによる誠実性への寄与があり差し引かれる分が大きいため、ENFP（{v}%）よりHighの割合は下がります。',
        ['vals' => [1 => ['嫉妬深さ', 'm:ENFP']], 'cmp' => [['m' => ['嫉妬深さ'], 'base' => 'm:ENFP', 'deg' => '', 'w' => '下が', 'cited' => [$P_REL], 'zero' => [$P_SEN], 'wsign' => [$P_REL => -1]]]]],
    [['mbti/enfp'], 'tendencies.浮気耐性.note', true, '誠実性と行動主導性で決まる指標です。行動主導性はENTP（E・T二重）より弱いため、ENTP（High{v}%）よりややHighの割合が上がります。',
        ['vals' => [1 => ['浮気耐性', 'm:ENTP']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 'm:ENTP', 'deg' => 'やや', 'w' => '上が', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['mbti/estj'], 'faq', false, 'ESTJは誠実性が絡む指標（恋愛の慎重さ・結婚志向・浮気耐性）でENTJより高く、包容力もENTJよりやや高い一方、情動性への寄与が完全に無くなるため、愛情表現・独占欲・嫉妬深さはENTJより大きく下がり、惚れやすさもENTJより下がります。',
        ['cmp' => [['m' => ['恋愛の慎重さ', '結婚志向', '浮気耐性'], 'base' => 'm:ENTJ', 'deg' => '', 'w' => '高く', 'cited' => [$P_REL]],
                   ['m' => ['包容力'], 'base' => 'm:ENTJ', 'deg' => 'やや', 'w' => '高い', 'main' => $P_REL],
                   ['m' => ['愛情表現', '独占欲', '嫉妬深さ'], 'base' => 'm:ENTJ', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_SEN]],
                   ['m' => ['惚れやすさ'], 'base' => 'm:ENTJ', 'deg' => '', 'w' => '下が', 'cited' => [$P_SEN]]]]],
    [['mbti/istp'], 'faq', false, 'ISTPは恋愛の慎重さでINTPを大きく上回り、結婚志向・浮気耐性など誠実性が絡む指標でもINTPより高く、包容力もINTPよりやや高い一方、情動性が絡む指標（愛情表現・独占欲・惚れやすさ・嫉妬深さ）ではINTPより大きく下がります。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => 'm:INTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL]],
                   ['m' => ['結婚志向', '浮気耐性'], 'base' => 'm:INTP', 'deg' => '', 'w' => '高く', 'cited' => [$P_REL]],
                   ['m' => ['包容力'], 'base' => 'm:INTP', 'deg' => 'やや', 'w' => '高い', 'main' => $P_REL],
                   ['m' => ['愛情表現', '独占欲', '惚れやすさ', '嫉妬深さ'], 'base' => 'm:INTP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_SEN]]]]],
    [['mbti/enfj'], 'matome', false, '惚れやすさは変化志向の影響でENFPより大きく下がり、嫉妬深さは誠実性の負の影響でENFPより下がる。',
        ['cmp' => [['m' => ['惚れやすさ'], 'base' => 'm:ENFP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_TRA], 'zero' => [$P_SEN]],
                   ['m' => ['嫉妬深さ'], 'base' => 'm:ENFP', 'deg' => '', 'w' => '下が', 'cited' => [$P_REL], 'zero' => [$P_SEN], 'wsign' => [$P_REL => -1]]]]],
    // M-2：星座
    [['seiza/virgo'], 'faq', false, '行動主導性がマイナスに働く浮気耐性では乙女座の方がやや高く（High{v}%・山羊座{v}%）、プラスに働く積極性（山羊座{v}%・乙女座{v}%）では山羊座の方が高く、愛情表現（山羊座{v}%・乙女座{v}%）でも山羊座の方がやや高くなります。',
        ['vals' => [1 => ['浮気耐性', 'self'], 2 => ['浮気耐性', 's:山羊座'], 3 => ['積極性', 's:山羊座'], 4 => ['積極性', 'self'], 5 => ['愛情表現', 's:山羊座'], 6 => ['愛情表現', 'self']],
         'cmp' => [['m' => ['浮気耐性'], 'base' => 's:山羊座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]],
                   ['m' => ['積極性'], 'base' => 's:山羊座', 'deg' => '', 'w' => '低く', 'cited' => [$P_ACT], 'wsign' => [$P_ACT => 1]],
                   ['m' => ['愛情表現'], 'base' => 's:山羊座', 'deg' => 'やや', 'w' => '低く', 'cited' => [$P_ACT], 'wsign' => [$P_ACT => 1]]]]],
    [['seiza/libra'], 'mbti_intro', false, '誠実性が絡む指標（恋愛の慎重さ・結婚志向）では、地由来の誠実性への寄与を持つ山羊座の方が大きく高くなります。',
        ['cmp' => [['m' => ['恋愛の慎重さ', '結婚志向'], 'base' => 's:山羊座', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_REL], 'src' => [$P_REL => []]]]]],
    // m-2：血液型（比較相手ごとに主因が違う・挙げた項が一部の相手と差を生まない文を、相手を分けて書いた）
    [['blood/a-love'], 'causal_explanation', false, '行動主導性・情動性・自立性・変化志向のどれにも寄与せず、行動主導性・情動性への寄与が無いため積極性・愛情表現は全体平均を大きく下回り、情動性・変化志向への寄与が無いため惚れやすさも全体平均を下回ります。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 'all', 'deg' => '大きく', 'w' => '下回', 'cited' => [$P_ACT, $P_SEN]],
                   ['m' => ['惚れやすさ'], 'base' => 'all', 'deg' => '', 'w' => '下回', 'cited' => [$P_SEN, $P_TRA]]]]],
    [['blood/a-love'], 'styles.惚れやすさ.note', true, '情動性と変化志向で決まる指標です。O型・AB型との差は情動性への寄与が無いことによるもので、B型とは変化志向への寄与が無い分だけ差がつき、4血液型の中で最も低い水準です。',
        ['cmp' => [['m' => ['惚れやすさ'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['惚れやすさ'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_SEN], 'zero' => [$P_TRA]],
                   ['m' => ['惚れやすさ'], 'base' => ['b:B'], 'reasonOnly' => -1, 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['blood/a-love'], 'styles.嫉妬深さ.note', true, '情動性から誠実性を差し引く指標です。差し引かれる誠実性への寄与が強いことが主因で、4血液型の中で最も低い水準です（O型・AB型とは、情動性への寄与が無い分も差がつきます）。',
        ['cmp' => [['m' => ['嫉妬深さ'], 'base' => 'top', 'deg' => '', 'w' => '低', 'main' => $P_REL, 'wsign' => [$P_REL => -1]],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'main' => $P_REL, 'add' => [$P_SEN]],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:B'], 'reasonOnly' => -1, 'main' => $P_REL, 'zero' => [$P_SEN]]]]],
    [['blood/a-love'], 'tendencies.浮気耐性.note', true, 'A型の強い誠実性寄与が主因で、4血液型の中で最も高い水準です（O型・AB型とは、差し引かれる行動主導性への寄与が無い分も差がつきます）。',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 'top', 'deg' => '', 'w' => '高', 'main' => $P_REL],
                   ['m' => ['浮気耐性'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => 1, 'main' => $P_REL, 'add' => [$P_ACT], 'wsign' => [$P_ACT => -1]],
                   ['m' => ['浮気耐性'], 'base' => ['b:B'], 'reasonOnly' => 1, 'main' => $P_REL, 'zero' => [$P_ACT]]]]],
    [['blood/a-love'], 'faq', false, '惚れやすさは情動性と変化志向で決まる指標で、O型・AB型との差は情動性への寄与が無いこと、B型との差は変化志向への寄与が無いことによるもので、慎重に相手を見極めるスタイルと解釈できます。',
        ['cmp' => [['m' => ['惚れやすさ'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['惚れやすさ'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_SEN], 'zero' => [$P_TRA]],
                   ['m' => ['惚れやすさ'], 'base' => ['b:B'], 'reasonOnly' => -1, 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['blood/a-love'], 'matome', false, '行動主導性・情動性への直接の寄与が無いため、積極性・愛情表現は4血液型の中で最も低い水準になる（B型と同率）。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 'top', 'deg' => '', 'w' => '低', 'cited' => [$P_ACT, $P_SEN]]]]],
    [['blood/a-love'], 'matome', false, '惚れやすさも4血液型の中で最も低く、O型・AB型との差は情動性への寄与が無いこと、B型との差は変化志向への寄与が無いことによる。',
        ['cmp' => [['m' => ['惚れやすさ'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['惚れやすさ'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_SEN], 'zero' => [$P_TRA]],
                   ['m' => ['惚れやすさ'], 'base' => ['b:B'], 'reasonOnly' => -1, 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['blood/a-love'], 'matome', false, '嫉妬深さは、差し引かれる誠実性への寄与が強いことが主因で、4血液型の中で最も低い水準になる（O型・AB型とは情動性への寄与が無い分も差がつく）。',
        ['cmp' => [['m' => ['嫉妬深さ'], 'base' => 'top', 'deg' => '', 'w' => '低', 'main' => $P_REL, 'wsign' => [$P_REL => -1]],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'main' => $P_REL, 'add' => [$P_SEN]]]]],
    [['blood/b-love'], 'styles.包容力.note', true, '誠実性・情動性から構成される指標です。A型との差は誠実性への寄与が無いことによるもので、O型・AB型とは情動性への寄与が無い分だけ差がつき、4血液型の中で最も低い水準です。',
        ['cmp' => [['m' => ['包容力'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['包容力'], 'base' => ['b:A'], 'reasonOnly' => -1, 'cited' => [$P_REL], 'zero' => [$P_SEN]],
                   ['m' => ['包容力'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_SEN], 'zero' => [$P_REL]]]]],
    [['blood/b-love'], 'faq', false, '独占欲は情動性から自立性を差し引く指標で、O型・AB型との差は情動性への寄与が無いことが主因で、マイナスに働く自立性への寄与を持つ分も加わり、A型とは自立性への寄与の分だけ差がつきます。',
        ['cmp' => [['m' => ['独占欲'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['独占欲'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'main' => $P_SEN, 'add' => [$P_AUT], 'wsign' => [$P_AUT => -1]],
                   ['m' => ['独占欲'], 'base' => ['b:A'], 'reasonOnly' => -1, 'cited' => [$P_AUT], 'zero' => [$P_SEN]]]]],
    [['blood/b-love'], 'faq', false, '「結婚志向」はHigh{v}%と4血液型の中で最も低めですが、これはB型の構造上、A型との差は誠実性への寄与が無いことが主因で、同じく誠実性への寄与が無いO型・AB型とは、計算式でマイナスに働く変化志向への寄与を持つ分だけ差がつくためです。',
        ['vals' => [1 => ['結婚志向', 'self']], 'cmp' => [['m' => ['結婚志向'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['結婚志向'], 'base' => ['b:A'], 'reasonOnly' => -1, 'main' => $P_REL],
                   ['m' => ['結婚志向'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_TRA], 'zero' => [$P_REL], 'wsign' => [$P_TRA => -1]]]]],
    [['blood/b-love'], 'matome', false, '包容力は、A型との差は誠実性への寄与が無いことによるもので、O型・AB型とは情動性への寄与が無い分だけ差がつき、4血液型の中で最も低い水準になる。',
        ['cmp' => [['m' => ['包容力'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['包容力'], 'base' => ['b:A'], 'reasonOnly' => -1, 'cited' => [$P_REL], 'zero' => [$P_SEN]],
                   ['m' => ['包容力'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_SEN], 'zero' => [$P_REL]]]]],
    [['blood/b-love'], 'matome', false, '独占欲は、O型・AB型との差は情動性への寄与が無いことが主因で、差し引かれる自立性への寄与の分も加わり、A型とは自立性への寄与の分だけ差がつき、4血液型の中で最も低い水準になる。',
        ['cmp' => [['m' => ['独占欲'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['独占欲'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'main' => $P_SEN, 'add' => [$P_AUT], 'wsign' => [$P_AUT => -1]],
                   ['m' => ['独占欲'], 'base' => ['b:A'], 'reasonOnly' => -1, 'cited' => [$P_AUT], 'zero' => [$P_SEN]]]]],
    [['blood/b-love'], 'matome', false, '結婚志向は、A型との差は誠実性への寄与が無いことが主因で、O型・AB型とは差し引かれる変化志向への寄与の分だけ差がつき、4血液型の中で最も低い水準になる。',
        ['cmp' => [['m' => ['結婚志向'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['結婚志向'], 'base' => ['b:A'], 'reasonOnly' => -1, 'main' => $P_REL, 'add' => [$P_TRA]],
                   ['m' => ['結婚志向'], 'base' => ['b:O', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_TRA], 'zero' => [$P_REL], 'wsign' => [$P_TRA => -1]]]]],
    [['blood/o-love'], 'causal_explanation', false, '積極性・愛情表現は、A型・B型との差は行動主導性・情動性の両方に寄与することによるもので、AB型とは行動主導性の分だけ差がつき、4血液型の中で最も高くなります。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 'top', 'deg' => '', 'w' => '高'],
                   ['m' => ['積極性', '愛情表現'], 'base' => ['b:A', 'b:B'], 'reasonOnly' => 1, 'cited' => [$P_ACT, $P_SEN]],
                   ['m' => ['積極性', '愛情表現'], 'base' => ['b:AB'], 'reasonOnly' => 1, 'cited' => [$P_ACT], 'zero' => [$P_SEN]]]]],
    [['blood/o-love'], 'causal_explanation', false, '独占欲・惚れやすさは、情動性への寄与により4血液型の中で最も高くなります（AB型と同率）。',
        ['cmp' => [['m' => ['独占欲', '惚れやすさ'], 'base' => 'top', 'deg' => '', 'w' => '高', 'cited' => [$P_SEN]]]]],
    [['blood/o-love'], 'causal_explanation', false, '嫉妬深さは、A型との差は差し引かれる誠実性への寄与が無いことが主因で、B型とは情動性への寄与の分だけ差がつき、4血液型の中で最も高くなります（AB型と同率）。',
        ['cmp' => [['m' => ['嫉妬深さ'], 'base' => 'top', 'deg' => '', 'w' => '高'],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:A'], 'reasonOnly' => 1, 'main' => $P_REL, 'wsign' => [$P_REL => -1]],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:B'], 'reasonOnly' => 1, 'cited' => [$P_SEN], 'zero' => [$P_REL]]]]],
    [['blood/o-love'], 'causal_explanation', false, '一方、誠実性への寄与は無いため、誠実性が主軸の包容力・結婚志向は全体平均より低め、恋愛の慎重さ・浮気耐性は全体平均より大きく低くなります。',
        ['cmp' => [['m' => ['包容力', '結婚志向'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'cited' => [$P_REL]],
                   ['m' => ['恋愛の慎重さ', '浮気耐性'], 'base' => 'all', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_REL]]]]],
    [['blood/o-love'], 'styles.積極性.note', true, 'A型・B型との差は行動主導性・情動性の両方に直接寄与することによるもので、AB型とは行動主導性の分だけ差がつき、4血液型の中で最も高い水準です。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'top', 'deg' => '', 'w' => '高'],
                   ['m' => ['積極性'], 'base' => ['b:A', 'b:B'], 'reasonOnly' => 1, 'cited' => [$P_ACT, $P_SEN]],
                   ['m' => ['積極性'], 'base' => ['b:AB'], 'reasonOnly' => 1, 'cited' => [$P_ACT], 'zero' => [$P_SEN]]]]],
    [['blood/o-love'], 'styles.嫉妬深さ.note', true, '情動性から誠実性を差し引く指標です。A型との差は差し引かれる誠実性への寄与が無いことが主因で、B型とは情動性への寄与の分だけ差がつき、4血液型の中で最も高い水準です（AB型と同率）。',
        ['cmp' => [['m' => ['嫉妬深さ'], 'base' => 'top', 'deg' => '', 'w' => '高'],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:A'], 'reasonOnly' => 1, 'main' => $P_REL, 'wsign' => [$P_REL => -1]],
                   ['m' => ['嫉妬深さ'], 'base' => ['b:B'], 'reasonOnly' => 1, 'cited' => [$P_SEN], 'zero' => [$P_REL]]]]],
    [['blood/o-love'], 'styles.恋愛の慎重さ.note', true, '誠実性・自立性で決まる指標です。A型との差は誠実性への寄与が無いこと、B型との差は自立性への寄与が無いことによるもので、4血液型の中で最も低い水準です（AB型と同率）。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['恋愛の慎重さ'], 'base' => ['b:A'], 'reasonOnly' => -1, 'cited' => [$P_REL], 'zero' => [$P_AUT]],
                   ['m' => ['恋愛の慎重さ'], 'base' => ['b:B'], 'reasonOnly' => -1, 'cited' => [$P_AUT], 'zero' => [$P_REL]]]]],
    [['blood/o-love'], 'tendencies.浮気耐性.note', true, '誠実性はプラス、行動主導性はマイナスに働きます。A型との差は誠実性への寄与が無いことが主因で、B型・AB型とは差し引かれる行動主導性への寄与の分だけ差がつき、4血液型の中で最も低い水準です。',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 'top', 'deg' => '', 'w' => '低'],
                   ['m' => ['浮気耐性'], 'base' => ['b:A'], 'reasonOnly' => -1, 'main' => $P_REL, 'add' => [$P_ACT]],
                   ['m' => ['浮気耐性'], 'base' => ['b:B', 'b:AB'], 'reasonOnly' => -1, 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['blood/o-love'], 'faq', false, '積極性の計算式に使われる行動主導性・情動性の両方に直接寄与する構造によるもので、AB型とは行動主導性の分だけ差がつきます。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'top', 'deg' => '', 'w' => '高'],
                   ['m' => ['積極性'], 'base' => ['b:A', 'b:B'], 'reasonOnly' => 1, 'cited' => [$P_ACT, $P_SEN]],
                   ['m' => ['積極性'], 'base' => ['b:AB'], 'reasonOnly' => 1, 'cited' => [$P_ACT], 'zero' => [$P_SEN]]]]],
    [['blood/o-love'], 'matome', false, '積極性（High{v}%）は、A型・B型との差は行動主導性・情動性の両方に寄与することによるもので、AB型とは行動主導性の分だけ差がつき、4血液型の中で最も高い。',
        ['vals' => [1 => ['積極性', 'self']], 'cmp' => [['m' => ['積極性'], 'base' => 'top', 'deg' => '', 'w' => '高'],
                   ['m' => ['積極性'], 'base' => ['b:A', 'b:B'], 'reasonOnly' => 1, 'cited' => [$P_ACT, $P_SEN]],
                   ['m' => ['積極性'], 'base' => ['b:AB'], 'reasonOnly' => 1, 'cited' => [$P_ACT], 'zero' => [$P_SEN]]]]],
    // 指示 3 の走査（5e の形を広げて見つかった程度の語の不一致、比較相手があいまいな「単独寄与のみのタイプより」の書き直し）
    [['mbti/enfj'], 'faq', false, '変化志向が関わる惚れやすさ（ENFP High{v}%→ENFJ High{v}%）では大きく下がります。',
        ['vals' => [1 => ['惚れやすさ', 'm:ENFP'], 2 => ['惚れやすさ', 'self']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'm:ENFP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['mbti/infj'], 'faq', false, '変化志向が関わる惚れやすさはINFP（{v}%）よりINFJ（{v}%）で大きく下がります。',
        ['vals' => [1 => ['惚れやすさ', 'm:INFP'], 2 => ['惚れやすさ', 'self']], 'cmp' => [['m' => ['惚れやすさ'], 'base' => 'm:INFP', 'deg' => '大きく', 'w' => '下が', 'cited' => [$P_TRA], 'zero' => [$P_SEN]]]]],
    [['mbti/intj'], 'faq', false, '誠実性に依存する指標（恋愛の慎重さ・結婚志向・浮気耐性）では、恋愛の慎重さでINTP（誠実性はIのみ）を大きく上回り、結婚志向・浮気耐性もINTPより高くなる傾向があります。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => 'm:INTP', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL]],
                   ['m' => ['結婚志向', '浮気耐性'], 'base' => 'm:INTP', 'deg' => '', 'w' => '高く', 'cited' => [$P_REL]]]]],
    [['seiza/cancer'], 'causal_explanation', false, '浮気耐性（誠実性−行動主導性）は牡羊座よりやや高くなります。',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 's:牡羊座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['seiza/cancer'], 'matome', false, '浮気耐性は牡羊座よりやや高くなる。',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 's:牡羊座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL]]]]],
    [['seiza/scorpio'], 'causal_explanation', false, '浮気耐性（誠実性−行動主導性）は獅子座よりやや高くなります。',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 's:獅子座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['mbti/infj'], 'styles.包容力.note', true, '誠実性・情動性から構成される指標です。両方が二重に伸びるINFJだけの構造により、全体平均（{v}%）を大きく上回ります（全16タイプ中の最高値はISFJ、80.4%）。',
        ['vals' => [1 => ['包容力', 'all']], 'cmp' => [['m' => ['包容力'], 'base' => 'all', 'deg' => '大きく', 'w' => '上回', 'cited' => [$P_REL, $P_SEN]]]]],
    [['mbti/infj'], 'tendencies.浮気耐性.note', true, '誠実性と行動主導性で決まる指標です。誠実性が二重に伸びる一方、行動主導性への寄与が皆無なため、全体平均（{v}%）を上回ります（全16タイプ中の最高値はISFJ、82.6%）。',
        ['vals' => [1 => ['浮気耐性', 'all']], 'cmp' => [['m' => ['浮気耐性'], 'base' => 'all', 'deg' => '', 'w' => '上回', 'cited' => [$P_REL, $P_ACT], 'wsign' => [$P_ACT => -1]]]]],
    [['mbti/infj'], 'styles.嫉妬深さ.note', false, '（INFPの{v}%より低く、ENFPの{v}%より大きく低い）',
        ['vals' => [1 => ['嫉妬深さ', 'm:INFP'], 2 => ['嫉妬深さ', 'm:ENFP']], 'cmp' => [['m' => ['嫉妬深さ'], 'base' => 'm:INFP', 'deg' => '', 'w' => '低く', 'main' => $P_REL],
                   ['m' => ['嫉妬深さ'], 'base' => 'm:ENFP', 'deg' => '大きく', 'w' => '低い', 'main' => $P_REL]]]],
    // 2026-10-07（Reviewer MJ-1）：第2文の理由を相手を分けて書き直したため、第2文まで含めて登録し直した（旧第2文「I（内向）とJ（判断）の両方が誠実性に寄与し、
    // かつ行動主導性への寄与が皆無」は、INFP との差を生まない行動主導性（寄与差 0）を相手を分けずに理由に挙げていた。5e の reason で FAIL する）。
    // INFP との差は誠実性（J）だけ（+1.40）、ENFJ との差は誠実性（I、+1.40）が主因で行動主導性（E が無い、+0.60）が従
    [['mbti/infj'], 'faq', false, 'INFJは「浮気耐性」がHigh{v}%・Low3.1%と、誠実性への寄与が1文字だけのINFPより高く、ENFJを大きく上回る傾向を示しています。これは、INFPとの差はJ（判断）による誠実性への寄与によるもので、ENFJとはI（内向）による誠実性への寄与が主因で、行動主導性への寄与が無い分も加わるためです（誠実性がI・S・Jの三重寄与になるISFJではさらに高いHigh{v}%になります）。',
        ['vals' => [1 => ['浮気耐性', 'self'], 2 => ['浮気耐性', 'm:ISFJ']],
         'cmp' => [['m' => ['浮気耐性'], 'base' => 'm:INFP', 'deg' => '', 'w' => '高く', 'cited' => [$P_REL], 'zero' => [$P_ACT], 'letter' => [['J', $P_REL]]],
                   ['m' => ['浮気耐性'], 'base' => 'm:ENFJ', 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL, 'add' => [$P_ACT], 'wsign' => [$P_ACT => -1], 'letter' => [['I', $P_REL]]]]]],
    [['mbti/infj'], 'matome', false, '誠実性がI・J二重で伸びるため、包容力（High{v}%）は誠実性への寄与が1文字だけのINFP・ENFJより大きく上がり、浮気耐性（High{v}%）もINFPより高く、ENFJを大きく上回る（',
        ['vals' => [1 => ['包容力', 'self'], 2 => ['浮気耐性', 'self']], 'cmp' => [['m' => ['包容力'], 'base' => ['m:INFP', 'm:ENFJ'], 'deg' => '大きく', 'w' => '上が', 'cited' => [$P_REL]],
                   ['m' => ['浮気耐性'], 'base' => 'm:INFP', 'deg' => '', 'w' => '高く', 'cited' => [$P_REL]],
                   ['m' => ['浮気耐性'], 'base' => 'm:ENFJ', 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL]]]],
    [['mbti/intj'], 'causal_explanation', false, 'この二重寄与により、恋愛の慎重さは誠実性への寄与が1文字だけのINTP・ENTJを大きく上回り、結婚志向・浮気耐性もINTP・ENTJより高いHighの割合を示します。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL],
                   ['m' => ['結婚志向', '浮気耐性'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '', 'w' => '高い', 'main' => $P_REL]]]],
    [['mbti/intj'], 'styles.包容力.note', true, '誠実性・情動性から構成される指標です。I・J二重の誠実性寄与により、誠実性への寄与が1文字だけのINTP・ENTJよりHighの割合が大きく高くなります（全16タイプ中の最高値はISFJ、80.4%）。',
        ['cmp' => [['m' => ['包容力'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '大きく', 'w' => '高く', 'cited' => [$P_REL], 'zero' => [$P_SEN]]]]],
    [['mbti/intj'], 'styles.嫉妬深さ.note', true, '情動性から誠実性を差し引く指標です。I・J二重の誠実性がマイナスに働くため、誠実性への寄与が1文字だけのINTP・ENTJよりHighの割合が低くなります（全16タイプ中の最低値はISTJ、0%）。',
        ['cmp' => [['m' => ['嫉妬深さ'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '', 'w' => '低く', 'cited' => [$P_REL], 'zero' => [$P_SEN], 'wsign' => [$P_REL => -1]]]]],
    [['mbti/intj'], 'styles.恋愛の慎重さ.note', true, '誠実性・自立性のみで決まる指標です。I・J二重の誠実性寄与により、誠実性への寄与が1文字だけのINTP・ENTJよりHighの割合が大きく高くなります（全16タイプ中の最高値はISTJ・ISFJと同率の77.1%）。',
        ['cmp' => [['m' => ['恋愛の慎重さ'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '大きく', 'w' => '高く', 'main' => $P_REL]]]],
    [['mbti/intj'], 'tendencies.結婚志向.note', true, '誠実性・変化志向で決まる指標です。I・J二重の誠実性寄与により、誠実性への寄与が1文字だけのINTP・ENTJよりHighの割合が高くなります（全16タイプ中の最高値はISTJ・ISFJと同率の72%）。',
        ['cmp' => [['m' => ['結婚志向'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '', 'w' => '高く', 'main' => $P_REL]]]],
    [['mbti/intj'], 'faq', false, 'INTJは「恋愛の慎重さ」がHigh{v}%と、誠実性への寄与が1文字だけのINTP・ENTJを大きく上回る傾向が見られます。',
        ['vals' => [1 => ['恋愛の慎重さ', 'self']], 'cmp' => [['m' => ['恋愛の慎重さ'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL]]]],
    // 2026-10-07（Reviewer m-4・読みやすさ）：176字の1文を2文に分けた（事実は同じ。第2文は「この二重寄与により」で前の文の理由を受け、5e は前置きとして主因（誠実性）を照合する）
    [['mbti/intj'], 'matome', false, '恋愛の慎重さ（High{v}%）は誠実性への寄与が1文字だけのINTP・ENTJを大きく上回る。この二重寄与により、結婚志向（High{v}%）・浮気耐性（High{v}%）もINTP・ENTJより高くなる（',
        ['vals' => [1 => ['恋愛の慎重さ', 'self'], 2 => ['結婚志向', 'self'], 3 => ['浮気耐性', 'self']],
         'cmp' => [['m' => ['恋愛の慎重さ'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL],
                   ['m' => ['結婚志向', '浮気耐性'], 'base' => ['m:INTP', 'm:ENTJ'], 'deg' => '', 'w' => '高く', 'main' => $P_REL]]]],
    [['mbti/isfj'], 'faq', false, '包容力・恋愛の慎重さ・浮気耐性でESFJをさらに大きく上回る傾向があります。',
        ['cmp' => [['m' => ['包容力', '恋愛の慎重さ', '浮気耐性'], 'base' => 'm:ESFJ', 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL]]]],
    [['mbti/istj'], 'faq', false, '恋愛の慎重さ・結婚志向・浮気耐性でESTJをさらに大きく上回る傾向があります。',
        ['cmp' => [['m' => ['恋愛の慎重さ', '結婚志向', '浮気耐性'], 'base' => 'm:ESTJ', 'deg' => '大きく', 'w' => '上回', 'main' => $P_REL]]]],
    // 指示 3 の走査（「の方が控えめ」を拾う形を加えて見つかった向きの誤り）：AB型の FAQ。浮気耐性は AB型の方が高い（+5.4）
    [['blood/ab-love'], 'faq', false, '行動主導性が絡む指標（積極性・愛情表現・浮気耐性）のうち、行動主導性がプラスに働く積極性はO型より大きく低く、愛情表現はO型よりやや低く、マイナスに働く浮気耐性は逆にO型よりやや高くなります。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'b:O', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN], 'wsign' => [$P_ACT => 1]],
                   ['m' => ['愛情表現'], 'base' => 'b:O', 'deg' => 'やや', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN], 'wsign' => [$P_ACT => 1]],
                   ['m' => ['浮気耐性'], 'base' => 'b:O', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
];
foreach ($FIXED_B as [$arts, $where, $anchor, $sentence, $spec]) foreach ($arts as $art) {
    $CLAIMS[] = ['art' => $art, 'where' => $where, 'required' => true, 'rule' => 'fixed-20261007b', 're' => fixedRe($sentence, $anchor),
        'expect' => fn($m, string $rel = '', array $a = []) => fixedClaimCheck($m, $rel, $a, $spec)];
}
// ---- 2026-10-07（Reviewer 差し戻し：MJ-2・MJ-3・Minor（aries）の修正） ----
// 直した文をすべて required=true で登録する（rule 'fixed-20261007c'。spec の書き方は $FIXED と同じ）。
// 程度の語は表（docs/love/09-writing-rules.md「記事の数値の程度の語」）にある語だけにした：「穏やか」「控えめ」「高めに出やすく」（比較相手なし）「さらに低め」（比較相手なし）を、
// 指標ごとに幅を分けた表の語に直した。旧文は 5e の「照合できない程度の語」に出て、5f の登録が無いため FAIL:UNJUDGED になる（修正前のコピー C:/tmp/love-n-before で確認）。
$FIXED_C = [
    // MJ-2：射手座の因果の説明。全体平均との差は 積極性 +14.6（主因＝情動性 +0.40、従＝行動主導性 +0.25）、愛情表現 +20.4（主因＝情動性 +0.70、従＝行動主導性 +0.125）
    [['seiza/sagittarius'], 'causal_explanation', false, 'さらに、情動性への寄与を主因に、行動主導性への寄与の分も加わり、積極性は全体平均より高め、愛情表現は全体平均を大きく上回ります。',
        ['cmp' => [['m' => ['積極性'], 'base' => 'all', 'deg' => '', 'w' => '高め', 'main' => $P_SEN, 'add' => [$P_ACT], 'src' => [$P_SEN => ['火'], $P_ACT => ['火']]],
                   ['m' => ['愛情表現'], 'base' => 'all', 'deg' => '大きく', 'w' => '上回', 'main' => $P_SEN, 'add' => [$P_ACT]]]]],
    // MJ-3：蟹座と牡羊座の差。積極性 −21.1（大きく）、愛情表現 −4.95（わずかに。丸めない差で 5 未満）。差は行動主導性だけ（情動性は同じ）
    [['seiza/cancer'], 'causal_explanation', false, 'そのため蟹座は、積極性は牡羊座より大きく低く、愛情表現は牡羊座よりわずかに低く、浮気耐性（誠実性−行動主導性）は牡羊座よりやや高くなります。',
        ['cmp' => [['m' => ['積極性'], 'base' => 's:牡羊座', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN]],
                   ['m' => ['愛情表現'], 'base' => 's:牡羊座', 'deg' => 'わずかに', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN]],
                   ['m' => ['浮気耐性'], 'base' => 's:牡羊座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['seiza/cancer'], 'matome', false, '火の行動力のぶん行動主導性への寄与は牡羊座の方が強く、蟹座は積極性が牡羊座より大きく低く、愛情表現が牡羊座よりわずかに低く、浮気耐性は牡羊座よりやや高くなる。',
        ['cmp' => [['m' => ['積極性'], 'base' => 's:牡羊座', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN], 'src' => [$P_ACT => ['活動宮']]],
                   ['m' => ['愛情表現'], 'base' => 's:牡羊座', 'deg' => 'わずかに', 'w' => '低く', 'cited' => [$P_ACT], 'zero' => [$P_SEN]],
                   ['m' => ['浮気耐性'], 'base' => 's:牡羊座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL]]]]],
    // MJ-3（5f の「穏やか」）：魚座と射手座、蠍座と獅子座の差は 積極性 −14.1・愛情表現 −10.9 で、2指標とも 10〜20（修飾なし「低め」）。差は行動主導性だけ
    [['seiza/pisces'], 'causal_explanation', false, '魚座は行動主導性への寄与を持たないため、積極性・愛情表現は射手座より低めに出て、浮気耐性（誠実性−行動主導性）は射手座よりやや高くなります。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 's:射手座', 'deg' => '', 'w' => '低め', 'cited' => [$P_ACT], 'zero' => [$P_SEN], 'src' => [$P_ACT => []]],
                   ['m' => ['浮気耐性'], 'base' => 's:射手座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    [['seiza/pisces'], 'matome', false, '魚座は行動主導性への寄与を持たないため、積極性・愛情表現は射手座より低めで、浮気耐性は射手座よりやや高くなる。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 's:射手座', 'deg' => '', 'w' => '低め', 'cited' => [$P_ACT], 'zero' => [$P_SEN], 'src' => [$P_ACT => []]],
                   ['m' => ['浮気耐性'], 'base' => 's:射手座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL]]]]],
    [['seiza/scorpio'], 'causal_explanation', false, '蠍座は行動主導性への寄与を持たないため、積極性・愛情表現は獅子座より低めに出て、浮気耐性（誠実性−行動主導性）は獅子座よりやや高くなります。',
        ['cmp' => [['m' => ['積極性', '愛情表現'], 'base' => 's:獅子座', 'deg' => '', 'w' => '低め', 'cited' => [$P_ACT], 'zero' => [$P_SEN], 'src' => [$P_ACT => []]],
                   ['m' => ['浮気耐性'], 'base' => 's:獅子座', 'deg' => 'やや', 'w' => '高く', 'cited' => [$P_ACT], 'zero' => [$P_REL], 'wsign' => [$P_ACT => -1]]]]],
    // MJ-3（o-love の「控えめ」）：全体平均との差は 結婚志向 −16.2・包容力 −11.8（10〜20、低め）、恋愛の慎重さ −22.1・浮気耐性 −22.2（20 以上、大きく）。主因はいずれも誠実性
    [['blood/o-love'], 'faq', false, '「結婚志向」はHigh{v}%と全体平均（{v}%）より低めですが、これはO型の構造上、誠実性への寄与が無いためです。',
        ['vals' => [1 => ['結婚志向', 'self'], 2 => ['結婚志向', 'all']], 'cmp' => [['m' => ['結婚志向'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'cited' => [$P_REL]]]]],
    [['blood/o-love'], 'matome', false, '誠実性への直接の寄与が無いため、包容力・結婚志向は全体平均より低め、恋愛の慎重さ・浮気耐性は全体平均より大きく低くなる。',
        ['cmp' => [['m' => ['包容力', '結婚志向'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'cited' => [$P_REL]],
                   ['m' => ['恋愛の慎重さ', '浮気耐性'], 'base' => 'all', 'deg' => '大きく', 'w' => '低く', 'cited' => [$P_REL]]]]],
    // Minor（aries）：浮気耐性 −14.0。主因は誠実性（−0.583）、従は差し引かれる行動主導性（火・活動宮、−0.425）。
    // 旧文「浮気耐性は行動主導性のマイナス影響でさらに低めになる」は従因だけを理由に挙げ、「さらに」が前の文の誠実性を受けると読めないため、主因が分かる形に直した
    [['seiza/aries'], 'matome', false, '浮気耐性は、誠実性への寄与が無いことが主因で、差し引かれる行動主導性への寄与（火・活動宮）の分も加わり、全体平均より低めになる。',
        ['cmp' => [['m' => ['浮気耐性'], 'base' => 'all', 'deg' => '', 'w' => '低め', 'main' => $P_REL, 'add' => [$P_ACT], 'wsign' => [$P_ACT => -1], 'src' => [$P_REL => [], $P_ACT => ['火', '活動宮']]]]]],
];
foreach ($FIXED_C as [$arts, $where, $anchor, $sentence, $spec]) foreach ($arts as $art) {
    $CLAIMS[] = ['art' => $art, 'where' => $where, 'required' => true, 'rule' => 'fixed-20261007c', 're' => fixedRe($sentence, $anchor),
        'expect' => fn($m, string $rel = '', array $a = []) => fixedClaimCheck($m, $rel, $a, $spec)];
}
// MJ-3（5f の方針の統一）：魚座の mbti_intro。比較の主体・相手が MBTI との組み合わせ（部分集合）どうしなので fixedClaimCheck の代わりに個別に照合する。
// 魚座×ENTJ・ENTP 62.5%、射手座×ENTJ・ENTP 70.8%（差 −8.3、「やや」）
$CLAIMS[] = ['art' => 'seiza/pisces', 'where' => 'mbti_intro', 'required' => true, 'rule' => 'fixed-20261007c',
    're' => '/行動主導性が高いMBTIタイプ（ENTJ・ENTP）と組み合わさると([\d.]+)%まで伸びます。火の行動力を通じて行動主導性にも寄与する射手座では同じ組み合わせで([\d.]+)%となり、魚座はそれよりやや低い水準です。/u',
    'expect' => function ($m): array {
        $et = ['ENTJ', 'ENTP']; $hp = high(['s' => signIndex('魚座'), 'm' => $et], '積極性'); $hs = high(['s' => signIndex('射手座'), 'm' => $et], '積極性');
        [$ok, $why] = degreeJudge('やや', '低い', $hp - $hs);
        return [$ok && near($m[1], $hp) && near($m[2], $hs), '魚座×ENTJ・ENTP=' . r1($hp) . ' 射手座×ENTJ・ENTP=' . r1($hs) . sprintf(' 差%+.1f ', $hp - $hs) . $why];
    }];
// 旧文の検出（required=false）：「星座による上乗せは穏やか」は 5e の比較の形にも一覧の語にも当てはまらない（「と比べると、…穏やかです」）ため、旧文として個別に登録する。
// 「穏やか」は程度の表に無い語（docs/love/09-writing-rules.md）なので、この文があれば FAIL
$CLAIMS[] = ['art' => 'seiza/pisces', 'where' => 'mbti_intro', 'required' => false, 'rule' => 'old-20261007c', 're' => '/と比べると、星座による上乗せは穏やかです/u',
    'expect' => fn($m): array => [false, '「穏やか」は程度の表に無い語（差の幅を表さない）。表の語で書く（魚座×ENTJ・ENTP と射手座×ENTJ・ENTP の差 −8.3 は「やや」）']];
// Bundle の主軸別の比較（style/tendency の bundle_body。記事の主体が星座・血液型・MBTI でないため fixedClaimCheck の代わりに個別に照合する）。
// 比較の主体・相手はスナップショットの主軸（p1）別の High 率。程度は degreeJudge（5e と同じ基準）
$bundleCmp = function (string $subj, string $ax, string $om, string $oax, string $deg, string $w): callable {
    return function ($m) use ($subj, $ax, $om, $oax, $deg, $w): array {
        $hs = high(['p1' => P_CODE[$ax]], $subj); $hb = high(['p1' => P_CODE[$oax]], $om);
        [$ok, $why] = degreeJudge($deg, $w, $hs - $hb);
        return [$ok && near($m[1], $hs) && near($m[2], $hb), "{$ax}主軸の{$subj}=" . r1($hs) . " {$oax}主軸の{$om}=" . r1($hb) . sprintf(' 差%+.1f ', $hs - $hb) . $why];
    };
};
$CLAIMS[] = ['art' => 'style/aijouhyougen-love', 'where' => 'bundle_body', 'required' => true, 'rule' => 'fixed-20261007b', 're' => '/Bundleの主軸が情動性のケースでは愛情表現のHigh率が([\d.]+)%に達し、積極性（([\d.]+)%）より大きく高くなります。/u',
    'expect' => $bundleCmp('愛情表現', '情動性', '積極性', '情動性', '大きく', '高く')];
$CLAIMS[] = ['art' => 'style/aijouhyougen-love', 'where' => 'bundle_body', 'required' => true, 'rule' => 'fixed-20261007b', 're' => '/逆に行動主導性が主軸のケースでは([\d.]+)%にとどまり、積極性（([\d.]+)%）より大きく低くなります。/u',
    'expect' => $bundleCmp('愛情表現', '行動主導性', '積極性', '行動主導性', '大きく', '低く')];
$CLAIMS[] = ['art' => 'style/shinchousa-love', 'where' => 'bundle_body', 'required' => true, 'rule' => 'fixed-20261007b', 're' => '/Bundleの主軸が誠実性のケースでは恋愛の慎重さのHigh率が([\d.]+)%に達し、包容力（誠実性主軸で([\d.]+)%）をやや上回ります。/u',
    'expect' => $bundleCmp('恋愛の慎重さ', '誠実性', '包容力', '誠実性', 'やや', '上回')];
$CLAIMS[] = ['art' => 'tendency/uwakitaisei-love', 'where' => 'bundle_body', 'required' => true, 'rule' => 'fixed-20261007b', 're' => '/Bundleの主軸が誠実性のケースでは浮気耐性のHigh率が([\d.]+)%に達し、結婚志向（([\d.]+)%）と近い水準です。/u',
    'expect' => $bundleCmp('浮気耐性', '誠実性', '結婚志向', '誠実性', '', '近い水準')];
// 旧文の検出（required=false）：5e の一般の検査では対象の指標を特定できず「照合できない程度の語」に入るため FAIL しなかった旧文（修正前のコピーで確認）。
// 「(P)が絡む指標で」「これらが主軸となる指標では」が指す指標（式に P を含む指標／最大の正の重みが P の指標）をすべて取り、書かれた程度の語が全指標で成り立つかを degreeJudge で照合する
$oldDegree = function (string $selfKey, string $selfVal, ?array $base, array $metrics, string $deg, string $w): callable {
    return function ($m) use ($selfKey, $selfVal, $base, $metrics, $deg, $w): array {
        $bad = [];
        foreach ($metrics as $mt) { $d = high([$selfKey => $selfVal], $mt) - high($base ?? [], $mt); [$ok] = degreeJudge($deg, $w, $d); if (!$ok) $bad[] = sprintf('%s %+.1f', $mt, $d); }
        return [$bad === [], '「' . ($deg === '' ? '修飾なし' : $deg) . "{$w}」に合わない指標: " . (implode(' ／ ', $bad) ?: 'なし')];
    };
};
$metricsWith = fn(string $pj): array => array_values(array_filter($METRICS, fn($mt) => isset(formulaOf($mt)[$pj])));
$metricsDom = fn(array $pjs): array => array_values(array_filter($METRICS, fn($mt) => in_array(dominantPrim($mt), $pjs, true)));
$CLAIMS[] = ['art' => 'mbti/isfp', 'where' => 'faq', 'required' => false, 'rule' => 'old-20261007b', 're' => '/ISFPは情動性が絡む指標でISTPより高い一方/u',
    'expect' => $oldDegree('m', 'ISFP', ['m' => 'ISTP'], $metricsWith('情動性'), '', '高い')];
$CLAIMS[] = ['art' => 'mbti/estj', 'where' => 'faq', 'required' => false, 'rule' => 'old-20261007b', 're' => '/ESTJは誠実性が絡む指標でENTJよりやや高い一方/u',
    'expect' => $oldDegree('m', 'ESTJ', ['m' => 'ENTJ'], $metricsWith('誠実性'), 'やや', '高い')];
$CLAIMS[] = ['art' => 'mbti/estj', 'where' => 'faq', 'required' => false, 'rule' => 'old-20261007b', 're' => '/情動性への寄与が完全に無くなるため、惚れやすさ・嫉妬深さなどが大きく下がります/u',
    'expect' => $oldDegree('m', 'ESTJ', ['m' => 'ENTJ'], ['惚れやすさ', '嫉妬深さ'], '大きく', '下が')];
$CLAIMS[] = ['art' => 'mbti/istp', 'where' => 'faq', 'required' => false, 'rule' => 'old-20261007b', 're' => '/ISTPは誠実性が絡む指標でINTPより高い一方/u',
    'expect' => $oldDegree('m', 'ISTP', ['m' => 'INTP'], $metricsWith('誠実性'), '', '高い')];
$CLAIMS[] = ['art' => 'blood/a-love', 'where' => 'causal_explanation', 'required' => false, 'rule' => 'old-20261007b', 're' => '/行動主導性・情動性・自立性・変化志向のどれにも寄与しないため、これらが主軸となる指標では全体平均を大きく下回ります/u',
    'expect' => $oldDegree('b', 'A', null, $metricsDom(['行動主導性', '情動性', '自立性', '変化志向']), '大きく', '下回')];
// 「単独寄与のみのタイプより」（INTJ・INFJ）：単独寄与のタイプ＝誠実性に寄与する文字（I・S・J）が1つだけのタイプ（inc の MBTI マッピングから求める。ENFJ・ENTJ・ESFP・ESTP・INFP・INTP）。
// 旧文は比較相手が6タイプにわたり、程度の語・向きがすべての相手で成り立つとは限らない（INTJ の嫉妬深さは ESTP より高い）。一般の検査では比較相手を特定できず「照合できない」に入っていた
// （INTJ の結婚志向の注記の旧文は、単独寄与の6タイプすべてと比べて差が +13.4〜+19.3 で「修飾なし」に合っていたため登録しない。直したのは比較相手の明示だけ）
$singleRel = array_values(array_filter(TYPES, fn($t) => count(typeContribLetters($t, '誠実性')) === 1));
$oldSingle = function (string $self, array $metrics, string $deg, string $w) use ($singleRel): callable {
    return function ($m) use ($self, $metrics, $deg, $w, $singleRel): array {
        $bad = [];
        foreach ($metrics as $mt) foreach ($singleRel as $t) { $d = high(['m' => $self], $mt) - high(['m' => $t], $mt); [$ok] = degreeJudge($deg, $w, $d); if (!$ok) $bad[] = sprintf('%s vs%s %+.1f', $mt, $t, $d); }
        return [$bad === [], '単独寄与のタイプ（' . implode('・', $singleRel) . '）に対して「' . ($deg === '' ? '修飾なし' : $deg) . "{$w}」に合わない: " . (implode(' ／ ', $bad) ?: 'なし')];
    };
};
foreach ([
    ['mbti/intj', 'causal_explanation', '/誠実性に依存する指標（恋愛の慎重さ・結婚志向・浮気耐性）で単独寄与のみのタイプより高いHighの割合を示します/u', 'INTJ', ['恋愛の慎重さ', '結婚志向', '浮気耐性'], '', '高い'],
    ['mbti/intj', 'styles.包容力.note', '/単独寄与のみのタイプよりHighの割合が高くなります（全16タイプ中の最高値はISFJ、80\.4%）/u', 'INTJ', ['包容力'], '', '高く'],
    ['mbti/intj', 'styles.嫉妬深さ.note', '/単独寄与のみのタイプよりHighの割合が低くなります/u', 'INTJ', ['嫉妬深さ'], '', '低く'],
    ['mbti/intj', 'styles.恋愛の慎重さ.note', '/単独寄与のみのタイプよりHighの割合が高くなります/u', 'INTJ', ['恋愛の慎重さ'], '', '高く'],
    ['mbti/intj', 'faq', '/「恋愛の慎重さ」がHigh41\.8%と、単独寄与のみのタイプより高い傾向/u', 'INTJ', ['恋愛の慎重さ'], '', '高い'],
    ['mbti/intj', 'matome', '/恋愛の慎重さ（High41\.8%）・結婚志向（High39\.2%）・浮気耐性（High35\.8%）が単独寄与のみのタイプより高くなる/u', 'INTJ', ['恋愛の慎重さ', '結婚志向', '浮気耐性'], '', '高く'],
    ['mbti/infj', 'faq', '/「浮気耐性」がHigh48\.1%・Low3\.1%と、単独寄与のみのタイプより高い傾向/u', 'INFJ', ['浮気耐性'], '', '高い'],
    ['mbti/infj', 'matome', '/包容力（High68\.4%）・浮気耐性（High48\.1%）が単独寄与のみのタイプより大きく上がる/u', 'INFJ', ['包容力', '浮気耐性'], '大きく', '上が'],
] as [$art, $where, $re, $self, $mts, $deg, $w])
    $CLAIMS[] = ['art' => $art, 'where' => $where, 'required' => false, 'rule' => 'old-20261007b', 're' => $re, 'expect' => $oldSingle($self, $mts, $deg, $w)];
// INFJ の浮気耐性の注記「Highが大きく上がります」（比較相手なし）：全体平均（+14.9）と比べても単独寄与のタイプ（INFP +19.8）と比べても 20 未満
$CLAIMS[] = ['art' => 'mbti/infj', 'where' => 'tendencies.浮気耐性.note', 'required' => false, 'rule' => 'old-20261007b', 're' => '/行動主導性への寄与が皆無なため、Highが大きく上がります/u',
    'expect' => $oldDegree('m', 'INFJ', null, ['浮気耐性'], '大きく', '上が')];
// INFJ の嫉妬深さの注記「（ENFPの72.2%・INFPの59.0%よりは低い）」：ENFP との差 −29.2 は「大きく」（修飾なしは 10〜20）
$CLAIMS[] = ['art' => 'mbti/infj', 'where' => 'styles.嫉妬深さ.note', 'required' => false, 'rule' => 'old-20261007b', 're' => '/（ENFPの72\.2%・INFPの59\.0%よりは低い）/u',
    'expect' => function ($m): array { $bad = []; foreach (['ENFP', 'INFP'] as $t) { $d = high(['m' => 'INFJ'], '嫉妬深さ') - high(['m' => $t], '嫉妬深さ'); [$ok] = degreeJudge('', '低い', $d); if (!$ok) $bad[] = sprintf('vs%s %+.1f', $t, $d); }
        return [$bad === [], '「修飾なし低い」に合わない: ' . (implode(' ／ ', $bad) ?: 'なし')]; }];
// 「控えめ」は程度の表に無い語なので、向き（AB型の方が低い）だけを照合する。浮気耐性は AB型の方が高く、向きが逆
$CLAIMS[] = ['art' => 'blood/ab-love', 'where' => 'faq', 'required' => false, 'rule' => 'old-20261007b', 're' => '/行動主導性が絡む指標（積極性・愛情表現・浮気耐性）ではAB型の方が控えめになります/u',
    'expect' => function ($m): array { $bad = []; foreach (['積極性', '愛情表現', '浮気耐性'] as $mt) { $d = high(['b' => 'AB'], $mt) - high(['b' => 'O'], $mt); if ($d >= 0) $bad[] = sprintf('%s %+.1f', $mt, $d); }
        return [$bad === [], '「控えめ」（AB型の方が低い）に合わない指標: ' . (implode(' ／ ', $bad) ?: 'なし')]; }];
$CLAIMS[] = ['art' => 'blood/o-love', 'where' => 'causal_explanation', 'required' => false, 'rule' => 'old-20261007b', 're' => '/誠実性・自立性・変化志向への寄与は無いため、これらが主軸の指標では低めになります/u',
    'expect' => $oldDegree('b', 'O', null, $metricsDom(['誠実性', '自立性', '変化志向']), '', '低め')];

// ======================================================================
// 5b. 指標とプリミティブの重み関係の主張（宣言的な表、2026-10-01追加）
//     「Xは Pへの依存度が高い」「主に Pで決まる」「Pが主軸の指標」「P・Qで決まる」等の文を、
//     inc/love-style.php・inc/love-tendency.php の式の係数（formulaOf()、数値は表に直書きしない）と照合する。
//     全記事・全フィールドを文単位で走査する（個別記事の文を登録しなくても拾う）。
//
//   'id'    : 規則名（結果の rule 欄は "weight:<id>@<フィールド>"。KNOWN のキーにも使う）
//   're'    : 正規表現。名前付きグループ
//               p  = 主張したプリミティブ（列挙可。「行動主導性（Tから）と情動性（Nから）」の注記つきも可）
//               m  = 対象指標の列挙（任意。無ければ下記「対象指標の決め方」で決める。m3/m4/m5 は同じ意味の別位置で、m→m3→m4→m5 の順に使う）
//               o  = 比較相手の指標（reversed / heavierThanMetric）
//               q  = 比較相手のプリミティブ（heavier のみ）
//               w / w2 = 文中に書かれた係数（任意。書かれていれば式の係数と一致するかも見る）
//   'judge' : 判定の種類
//     dominant : 各指標で、P が「最大の正の重み」を持つ。すなわち w(P) > 0 かつ、他のすべてのプリミティブ Q について
//                w(P) > |w(Q)|（厳密に大きい）。同率最大（w(P) = |w(Q)|）は「主に P で決まる」とは言えないため不一致とする。
//                P は1つだけ（複数書かれていたら不一致）。
//     set      : 「P・Q（のみ）で決まる」。各指標の式のプリミティブ集合 ⊆ 主張した集合、かつ 列挙した指標の式の和集合 = 主張した集合
//                （指標が1つなら集合の完全一致）。
//     contains : 「P に依存する指標」「P が絡む／関わる指標」。各指標の式に、主張したプリミティブの少なくとも1つが含まれる。
//     absent   : 「P に依存しない」。各指標の式に、主張したプリミティブがどれも含まれない。
//     heavier  : 「P の重みが Q より大きい」。w(P) > |w(Q)|。
//     reversed : 「(指標O)と重みが逆」。対象指標と指標O の式のプリミティブ集合が同じで、最大の正の重みのプリミティブが異なる。
//     heavierThanMetric : 「(指標O)より P への依存が強い」。対象指標での w(P) > 指標Oでの w(P)（O の式に P が無ければ 0 とみなす）。
//   'pair'  : true のとき、m/p に加えて m2/p2 の組も同じ判定で照合する（「Xは P・Q、Yは R・Sで決まる」）。
//
//   対象指標の決め方（m が無いとき、上から順に）:
//     (1) 文頭の「(指標の列挙)は／が／の」  (2) フィールドが styles.<指標>.note / tendencies.<指標>.note ならその指標
//     (3) Style/Tendency記事（style/*・tendency/*）で、文中に記事の指標以外の指標名が無ければ記事の指標
//     (4) 決まらなければ照合せず「照合できなかった重み主張」として末尾に表示する（FAILには数えない）
// ======================================================================
$PA = "(?:$PRIM_RE)(?:（[^）]*）|×[\d.]+)?";
$PLIST = "$PA(?:(?:・|と|、|＋|－)$PA)*";
$MLIST = "(?:$MET_RE)(?:・(?:$MET_RE))*";
$WEIGHT_CLAIMS = [
    ['id' => 'dependsHigh-prim',  'judge' => 'dominant', 're' => "/(?<m>$MLIST)は、?(?<p>$PRIM_RE)というプリミティブへの依存度が高い/u"],
    ['id' => 'dependsHigh',       'judge' => 'dominant', 're' => "/(?<p>$PRIM_RE)への依存度?が(?:特に|非常に)?高い(?:指標|Style|Tendency)?(?:（(?:(?<m>$MLIST)|(?<w>[\d.]+))）)?/u"],
    ['id' => 'leaningWeight',     'judge' => 'dominant', 're' => "/(?:(?<m>$MLIST)(?:は|が)、?)?(?<p>$PRIM_RE)寄りの重み/u"],
    ['id' => 'dependsMoreThan',   'judge' => 'heavierThanMetric', 're' => "/(?:(?<m>$MLIST)(?:は|が)、?)?(?<o>$MET_RE)より(?<p>$PRIM_RE)への依存(?:度)?が(?:強|高|大き)/u"],
    ['id' => 'mainlyDecided',     'judge' => 'dominant', 're' => "/(?:(?<m>$MLIST)(?:は|が)、?)?主に(?<p>$PRIM_RE)(?:で|によって)決ま/u"],
    ['id' => 'almostOnly',        'judge' => 'dominant', 're' => "/(?:(?<m>$MLIST)(?:は|が)、?)?ほぼ(?<p>$PRIM_RE)だけで決ま/u"],
    ['id' => 'mainAxisMetric',    'judge' => 'dominant', 're' => "/(?<p>$PRIM_RE)が(?:主軸|中心)(?:の|となる|になる)指標(?:（(?<m>$MLIST)）)?/u"],
    ['id' => 'weightLarge',       'judge' => 'dominant', 're' => "/(?:(?<m>$MLIST)は、?)?(?<p>$PRIM_RE)の(?:重み|影響)が(?:最も|特に)?(?:大き[いく]|主)[^。（]{0,8}(?:（(?<w>[\d.]+)）)?/u"],
    ['id' => 'weightReversed',    'judge' => 'reversed', 're' => "/(?:(?<m>$MLIST)と)?(?<o>$MET_RE)(?:（[^）]*）)?(?:と同じ2つのプリミティブ[^。]*?|とは|は同じ2つのプリミティブ[^。]*?)重み(?:が|を)逆/u"],
    ['id' => 'weightHeavier',     'judge' => 'heavier',  're' => "/(?:(?<m>$MLIST)は、?)?(?<p>$PRIM_RE)の重みが(?<q>$PRIM_RE)より大き[いく][^。（]*(?:（(?<w>[\d.]+):(?<w2>[\d.]+)）)?/u"],
    ['id' => 'effective',         'judge' => 'dominant', 're' => "/(?:(?<m>$MLIST)(?:は|では)、?)?(?<p>$PRIM_RE)が(?:よく|強く)?効いて/u"],
    ['id' => 'decidedBy',         'judge' => 'set',      're' => "/(?:(?<m>$MLIST)(?:は|が|など)、?)?(?<!主に)(?<!ほぼ)(?<p>$PLIST)(?:の2つ)?(?:のみ)?で(?:決ま|構成され)(?:る(?:指標（(?<m4>$MLIST)）|「(?<m3>$MLIST)」|(?<m5>$MLIST)))?/u"],
    ['id' => 'decidedByPair',     'judge' => 'set', 'pair' => true, 're' => "/(?<m>$MLIST)は(?<p>$PLIST)、(?<m2>$MLIST)は(?<p2>$PLIST)で決ま/u"],
    ['id' => 'dependsOn',         'judge' => 'contains', 're' => "/(?:(?<m>$MLIST)など)?(?<p>$PLIST)(?:に|へ)依存する(?:指標|Style|Tendency)?(?:（(?<m4>$MLIST)）)?/u"],
    ['id' => 'involves',          'judge' => 'contains', 're' => "/(?:(?<m>$MLIST)など)?(?<p>$PLIST)が(?:絡む|関わる)(?:指標(?:（(?<m4>$MLIST)）)?|(?<m3>$MLIST))/u"],
    ['id' => 'notDependsOn',      'judge' => 'absent',   're' => "/(?:(?<m>$MLIST)は、?)?(?<p>$PLIST)(?:に|へ)(?:は)?依存しない/u"],
];
/** 照合対象にした文を除き、重み関係の語を含む文を「照合できなかった重み主張」として拾う語 */
$WEIGHT_WORDS_RE = '/依存|主に|ほぼ[^。]{0,10}だけ|効いて|重み|係数|比重|主軸(?:の|となる|になる)指標|で決ま|影響が大き|強く影響|左右/u';

function formulaStr(string $metric): string {
    $s = ''; foreach (formulaOf($metric) as $p => $w) $s .= ($s === '' ? '' : ($w < 0 ? '－' : '＋')) . $p . '×' . abs($w);
    return "$metric=$s";
}
/** 最大の正の重みを持つプリミティブ（同率最大なら null） */
function dominantPrim(string $metric): ?string {
    $fo = formulaOf($metric); arsort($fo); $p = array_key_first($fo); $w = $fo[$p];
    if ($w <= 0) return null;
    foreach ($fo as $q => $wq) if ($q !== $p && abs($wq) >= $w) return null;
    return $p;
}
/** 重み主張1件の判定。戻り値 [ok, 説明] */
function judgeWeight(string $judge, array $metrics, array $prims, ?string $q, ?string $w, ?string $w2, ?string $other = null): array {
    $bad = [];
    if ($judge === 'set') {
        $union = [];
        foreach ($metrics as $mt) { $fs = array_keys(formulaOf($mt)); $union = array_merge($union, $fs); if (array_diff($fs, $prims)) $bad[] = "$mt の式に主張外の" . implode('・', array_diff($fs, $prims)); }
        $union = array_unique($union); sort($union); $cl = array_unique($prims); sort($cl);
        if ($union !== $cl) $bad[] = '式のプリミティブ集合=' . implode('・', $union) . ' 主張=' . implode('・', $cl);
    } else {
        foreach ($metrics as $mt) {
            $fo = formulaOf($mt);
            if ($judge === 'dominant') {
                $d = dominantPrim($mt);
                if (count($prims) !== 1) $bad[] = 'dominant にはプリミティブを1つだけ書く';
                elseif ($d !== $prims[0]) $bad[] = "$mt の最大の正の重みは " . ($d ?? '同率で無し');
                elseif ($w !== null && $w !== '' && abs($fo[$prims[0]] - (float)$w) > 1e-9) $bad[] = "$mt の {$prims[0]} の係数は {$fo[$prims[0]]}（記事 $w）";
            } elseif ($judge === 'contains') {
                if (!array_intersect($prims, array_keys($fo))) $bad[] = "$mt の式に " . implode('・', $prims) . ' が無い';
            } elseif ($judge === 'absent') {
                if (array_intersect($prims, array_keys($fo))) $bad[] = "$mt の式に " . implode('・', array_intersect($prims, array_keys($fo))) . ' がある';
            } elseif ($judge === 'reversed') {
                $ka = array_keys($fo); $ko = array_keys(formulaOf($other)); sort($ka); sort($ko);
                if ($mt === $other || $ka !== $ko || dominantPrim($mt) === null || dominantPrim($mt) === dominantPrim($other)) $bad[] = "$mt と $other の重みは逆になっていない";
            } elseif ($judge === 'heavierThanMetric') {
                $wa = $fo[$prims[0]] ?? 0; $wo = formulaOf($other)[$prims[0]] ?? 0;
                if (!($wa > $wo)) $bad[] = "$mt の {$prims[0]}={$wa} は {$other} の {$wo} より大きくない";
            } elseif ($judge === 'heavier') {
                $wp = $fo[$prims[0]] ?? null; $wq = $fo[$q] ?? null;
                if ($wp === null || $wq === null || !($wp > abs($wq))) $bad[] = "$mt の {$prims[0]}=" . ($wp ?? '無') . " {$q}=" . ($wq ?? '無');
                elseif ($w !== null && $w !== '' && (abs($wp - (float)$w) > 1e-9 || abs(abs($wq) - (float)$w2) > 1e-9)) $bad[] = "$mt の係数は {$wp}:" . abs($wq) . "（記事 $w:$w2）";
            }
        }
    }
    return [$bad === [], ($bad ? implode(' / ', $bad) . ' → ' : '') . implode(' ', array_map('formulaStr', $other !== null ? array_merge($metrics, [$other]) : $metrics))];
}

// ======================================================================
// 6. 実行
// ======================================================================
$articleFiles = [];
foreach (glob($artDir . '/*/*/index.php') as $file) {
    $rel = substr(dirname($file), strlen($artDir) + 1);
    $articleFiles[$rel] = $file;
}
ksort($articleFiles);
$loaded = [];
foreach ($articleFiles as $rel => $file) $loaded[$rel] = loadArticle($file);
$MAIN_REASON_CLAIMS = [];  // 'mainReason' => true の主張が本文に一致した箇所 [記事, フィールド, 一致した文字列, claim番号, 判定]（5d 節で使う）

foreach ($RULES as $rule) {
    foreach ($loaded as $rel => $a) {
        if (!fnmatch($rule['scope'], $rel)) continue;
        if (!is_array($a)) { chk($rel, 'load', false, '記事配列を読み込めない'); continue; }
        ($rule['fn'])($rel, $a);
    }
}
foreach ($CLAIMS as $i => $cl) {
    $targets = array_filter(array_keys($loaded), fn($rel) => fnmatch($cl['art'], $rel));
    if ($cl['required'] && !$targets) { chk($cl['art'], "claim#$i", false, '記事が存在しない', 'MISSING'); continue; }
    $found = false;
    foreach ($targets as $rel) {
        $a = $loaded[$rel]; if (!is_array($a)) continue;
        if ($cl['where'] === '*') $texts = leaves($a);
        else { $v = $a; foreach (explode('.', $cl['where']) as $k) $v = $v[$k] ?? null; $texts = is_array($v) ? leaves($v) : (is_string($v) ? [$cl['where'] => html_entity_decode(strip_tags($v), ENT_QUOTES, 'UTF-8')] : []); }
        if (!empty($cl['raw'])) { $v = $a; foreach (explode('.', $cl['where']) as $k) $v = $v[$k] ?? null; $texts = [$cl['where'] => preg_replace('/\s+(?=<)/', '', (string)$v)]; }
        if ($cl['where'] === 'body' && empty($cl['raw'])) $texts = [ 'body' => preg_replace('/\s+/u', '', html_entity_decode(strip_tags(preg_replace('/<\/t[dh]>/', '', (string)$a['body'])), ENT_QUOTES, 'UTF-8')) ] + $texts;
        foreach ($texts as $w => $t) {
            if (!preg_match_all($cl['re'], $t, $mm, PREG_SET_ORDER)) continue;
            foreach ($mm as $m) {
                $found = true;
                [$ok, $detail] = ($cl['expect'])($m, $rel, $a, $w);  // 記事のパス・配列・一致したフィールドも渡す（使わない expect は無視する）
                if (!empty($cl['mainReason'])) $MAIN_REASON_CLAIMS[] = [$rel, $w, $m[0], $i, $ok];  // 5d で「要判断」の文をこの主張で照合済みとする
                $label = mb_strimwidth($m[0], 0, 90, '…');
                chk($rel, isset($cl['rule']) ? "{$cl['rule']}@$w" : "claim#$i", $ok, "[$w] 「{$label}」" . ($detail !== '' ? " → $detail" : ''), $cl['required'] ? 'CLAIM' : 'SEM', $t);
            }
        }
    }
    if ($cl['required'] && !$found) chk($cl['art'], "claim#$i", false, "[{$cl['where']}] 修正後の主張が本文に見つからない: " . mb_strimwidth($cl['re'], 0, 110, '…'), 'MISSING');
}

// テンプレートの旧見出し（2026-10-06）：記事の $item には見出しが無いため、テンプレートのファイルの中身で検査する。
// 目次と h2 の「High・Mid・Lowの違い」は、6段階で文章が変わり記事は代表的な文章を載せる本文に合わないため「段階ごとの文章の例」に修正済み。
// テンプレートは記事ではないため、照合した記事の数（$ARTICLES_CHECKED）には含めず、カテゴリ別の集計では「template」として出す
foreach (['style/_style-tpl.php', 'tendency/_tendency-tpl.php'] as $tplFile) {
    $tpl = "template/$tplFile";
    $src = is_file("$artDir/$tplFile") ? (string)file_get_contents("$artDir/$tplFile") : null;
    if ($src === null) { chk($tpl, 'tpl:load', false, 'テンプレートが無い', 'MISSING'); unset($ARTICLES_CHECKED[$tpl]); continue; }
    $n = substr_count($src, 'High・Mid・Lowの違い');
    chk($tpl, 'tpl:oldLevelsHeading', $n === 0, $n === 0 ? '旧見出し「High・Mid・Lowの違い」なし' : "旧見出し「High・Mid・Lowの違い」が {$n} か所残っている（目次・h2）", 'SEM');
    unset($ARTICLES_CHECKED[$tpl]);
}

// 5b の重み主張：全記事・全フィールドを文単位で照合
$WEIGHT_UNRESOLVED = []; $WEIGHT_UNMATCHED = []; $WEIGHT_N = 0;
$listOf = fn(string $s, string $re) => preg_match_all("/$re/u", $s, $x) ? array_values(array_unique($x[0])) : [];
foreach ($loaded as $rel => $a) {
    if (!is_array($a)) continue;
    $artMetric = (fnmatch('style/*', $rel) || fnmatch('tendency/*', $rel)) && in_array($a['name'] ?? '', $METRICS, true) ? $a['name'] : null;
    foreach (leaves($a) as $where => $text) {
        $ctxMetric = preg_match("/^(?:styles|tendencies)\\.($MET_RE)\\./u", $where, $x) ? $x[1] : null;
        foreach (sentences($text) as $s) {
            $hit = false;
            foreach ($WEIGHT_CLAIMS as $wc) {
                if (!preg_match_all($wc['re'], $s, $mm, PREG_SET_ORDER)) continue;
                foreach ($mm as $m) {
                    $mFirst = ''; foreach (['m', 'm3', 'm4', 'm5'] as $gk) if (($m[$gk] ?? '') !== '') { $mFirst = $m[$gk]; break; }
                    $pairs = [[$mFirst, $m['p'] ?? '']];
                    if (!empty($wc['pair'])) $pairs[] = [$m['m2'], $m['p2']];
                    foreach ($pairs as [$mStr, $pStr]) {
                        $metrics = $mStr !== '' ? explode('・', $mStr) : [];
                        if (!$metrics && preg_match("/^($MLIST)(?:は|が|の)/u", $s, $x)) $metrics = explode('・', $x[1]);
                        if (!$metrics && $ctxMetric !== null) $metrics = [$ctxMetric];
                        if (!$metrics && $artMetric !== null && array_diff($listOf($s, $MET_RE), [$artMetric, $m['o'] ?? '']) === []) $metrics = [$artMetric];
                        $label = mb_strimwidth($m[0], 0, 80, '…');
                        $hit = true;
                        if (!$metrics) { $WEIGHT_UNRESOLVED[] = "$rel [$where] {$wc['id']}「{$label}」（対象指標を特定できない）"; continue; }
                        $WEIGHT_N++;
                        [$ok, $detail] = judgeWeight($wc['judge'], $metrics, $listOf($pStr, $PRIM_RE), $m['q'] ?? null, $m['w'] ?? null, $m['w2'] ?? null, ($m['o'] ?? '') !== '' ? $m['o'] : null);
                        chk($rel, "weight:{$wc['id']}@$where", $ok, "「{$label}」 → $detail", 'SEM', $text);
                    }
                }
            }
            if (!$hit && preg_match($WEIGHT_WORDS_RE, $s) && preg_match("/$PRIM_RE/u", $s) && ($artMetric !== null || preg_match("/$MET_RE|指標|Style|Tendency/u", $s))) $WEIGHT_UNMATCHED[] = "$rel [$where] 「" . mb_strimwidth($s, 0, 90, '…') . '」';
        }
    }
}

// ======================================================================
// 5c. 「同じ数値になる理由」の検査（2026-10-06追加、blood/ab-love の誤りから）
//     血液型・MBTI・星座の記事で、「(P)が主軸／主な要素(のため|なので)、(比較相手)と(完全に)同じ数値」
//     「計算式に(P)を含まないため、(比較相手)と(完全に)同じ数値」を文単位で拾い、次のように判定する。
//       - 比較相手と寄与が異なる Primitive の集合 D を inc のマッピングから求める（contribDiff）。
//       - 結論（同じ数値）が成り立つ ⇔ D がその指標の式に1つも含まれない かつ スナップショットの分布が一致。
//       - 理由が「主軸／主な要素」の文は、結論が成り立っていても理由の誤りとして FAIL
//         （主軸が同じでも、違う Primitive が式に入っていれば数値は変わる。同じになる理由は「違う Primitive を含まない」こと）。
//       - 理由が「(P)を含まない」の文は、D ⊆ 書かれた P、書かれた P が式に無い、分布が一致 のとき PASS。
//     対象指標は注記（styles.<指標>.note 等）から、比較相手は文中の血液型・星座・MBTIタイプから決める。
// ======================================================================
$SAME_REASON_N = 0; $SAME_REASON_UNRESOLVED = [];
$BLOOD_T_RE = '(?:AB|A|B|O)型';
foreach ($loaded as $rel => $a) {
    if (!is_array($a)) continue;
    $cat = explode('/', $rel)[0];
    if ($cat === 'blood') { $kind = 'b'; $self = $a['code'] ?? null; $tRe = $BLOOD_T_RE; }
    elseif ($cat === 'mbti') { $kind = 'm'; $self = strtoupper((string)($a['code'] ?? '')); $tRe = $TYPE_RE; }
    elseif ($cat === 'seiza') { $kind = 's'; $self = signIndex((string)($a['name'] ?? '')); $tRe = $SIGN_RE; }
    else continue;
    foreach (leaves($a) as $where => $text) {
        $ctxMetric = preg_match("/^(?:styles|tendencies)\\.($MET_RE)\\./u", $where, $x) ? $x[1] : null;
        foreach (sentences($text) as $s) {
            $forms = [];
            if (preg_match_all("/(?<p>$PRIM_RE)が(?:主軸|主な要素)(?:のため|なので)、(?<t>$tRe)と(?:完全に)?同じ数値/u", $s, $mm, PREG_SET_ORDER)) foreach ($mm as $m) $forms[] = ['mainAxis', $m];
            if (preg_match_all("/(?:計算式に)?(?<p>(?:$PRIM_RE)(?:・(?:$PRIM_RE))*)を含まないため、(?<t>$tRe)と(?:完全に)?同じ数値/u", $s, $mm, PREG_SET_ORDER)) foreach ($mm as $m) $forms[] = ['excludes', $m];
            foreach ($forms as [$form, $m]) {
                $label = mb_strimwidth($m[0], 0, 80, '…');
                $metrics = $ctxMetric !== null ? [$ctxMetric] : (preg_match("/^($MLIST)(?:は|が|の)/u", $s, $x) ? explode('・', $x[1]) : []);
                if (!$metrics) { $SAME_REASON_UNRESOLVED[] = "$rel [$where] 「{$label}」（対象指標を特定できない）"; continue; }
                $other = $kind === 'b' ? str_replace('型', '', $m['t']) : ($kind === 's' ? signIndex($m['t']) : $m['t']);
                $diff = contribDiff($kind, $self, $other);
                $prims = explode('・', $m['p']);
                foreach ($metrics as $mt) {
                    $SAME_REASON_N++;
                    $fo = formulaOf($mt);
                    $inF = array_values(array_intersect($diff, array_keys($fo)));
                    $same = lvDist(sub([$kind => $self]), $mt)['raw'] === lvDist(sub([$kind => $other]), $mt)['raw'];
                    $holds = $inF === [] && $same;
                    $info = formulaStr($mt) . " {$m['t']}と寄与が異なるPrimitive=" . (implode('・', $diff) ?: 'なし') . ' 分布' . ($same ? 'が一致' : 'が違う');
                    if ($form === 'mainAxis') {
                        chk($rel, "sameReason:mainAxis@$where", false, "「{$label}」 → 理由の誤り：同じ数値になるかは主軸ではなく、寄与の違うPrimitiveが式に含まれるかで決まる（結論は" . ($holds ? '成り立つ' : '成り立たない') . "） $info", 'SEM', $text);
                    } else {
                        $ok = $holds && array_diff($diff, $prims) === [] && array_intersect($prims, array_keys($fo)) === [];
                        chk($rel, "sameReason:excludes@$where", $ok, "「{$label}」 → $info", 'SEM', $text);
                    }
                }
            }
        }
    }
}

// ======================================================================
// 5d. 「主軸を理由にした文」の検査（2026-10-06追加。一時走査 scan-mainaxis-reason.php を常時動く検査にしたもの）
//     blood・mbti・seiza・style・tendency・bundle・guide の記事から、「(P)が(主軸|主な要素)(のため|なので|の指標です)」を
//     理由として結論を述べる文を文単位で拾い、次のように判定する（mbti-blood は 4-6 節で別に照合するため対象外）。
//       (1) 「Pが主軸」：P がその指標の式で最大の正の重み（dominantPrim）でなければ 誤り。
//       (2) 結論が「(比較相手)と(完全に)同じ数値」：寄与の異なる Primitive が式に含まれず分布が一致すれば成り立つ。
//           理由が「のため」（主軸のため同じ）なら 誤り、「の指標です」なら主軸の文は指標の説明として 成立（5c 節と同じ考え方）。
//       (3) 結論が方向（全体平均より高い／低い・4血液型で最も高い／低い・◯型と比べて大きく低い・近い／ほぼ同水準・中程度）：
//           比較相手ごとに、式の各項の寄与差（重み × スナップショットの Primitive 平均の差）を出し、
//           - 実測の向きが結論と逆 → 誤り
//           - 「の指標です」の後の文が主軸以外の項（「Qがマイナスに働く」「Qへの寄与が無い」「Qの寄与のみ」）を理由に挙げていれば、
//             その項が結論の向きに働き、かつ寄与差の絶対値が最大のとき 成立、そうでなければ 要判断
//           - 主軸の寄与差が結論の向きに働かない（ゼロ・逆向き）→「のため」なら 誤り、「の指標です」なら 要判断
//           - 他の項の寄与差の合計のほうが主軸より大きい → 要判断
//           - 「近い／ほぼ同水準／中程度」は、主軸・他の項とも寄与差の絶対値が 0.05 未満のときだけ 成立（それ以外は 要判断）
//           - 結論の形を判定できない → 要判断
//       (4) (2) と (3) の両方の結論が同じ注記にあるときは両方を判定し、悪い方（成立＜要判断＜誤り）を採る（2026-10-06、Reviewer M1）。
//       (5) 「(P)が主軸である一方、…計算式でマイナスに働く(Q)…ため、(結論)」の形も対象にする（2026-10-06、Reviewer m3）。
//           結論はその文の残り。理由に挙げた項 Q（「計算式(上|で)マイナスに働くQ」も含む）が寄与差の絶対値が最大の項（主因）でなければ 要判断。
//     程度の語（やや／大きく／わずかに／ほぼ）は 5d では判定しない。程度は $CLAIMS の個別の主張（判定基準は 5 節の mainReason の主張のコメント）で照合する。
//     要判断の文は、その文全体を含む個別の主張（$CLAIMS の 'mainReason' => true、required）が同じ記事・フィールドで本文に一致していれば
//     「個別の主張で照合」（寄与の向き・項の大小・数値はその主張で照合する）として PASS、そうでなければ FAIL。
//     誤りは常に FAIL。走査（一時スクリプト）からの変更は、方向の言い回しに「わずかに」を加えたことと、上の (4)(5)。
// ======================================================================
$MAIN_REASON_N = ['成立' => 0, '個別の主張で照合' => 0, '要判断' => 0, '誤り' => 0];
$meanPrims = function (array $f): array { static $memo = []; $k = json_encode($f); if (isset($memo[$k])) return $memo[$k]; $cs = sub($f); $o = []; foreach (P_CODE as $pj => $_) $o[$pj] = array_sum(array_map(fn($c) => $c['p'][$pj], $cs)) / count($cs); return $memo[$k] = $o; };
$decompose = function (string $mt, string $P, array $self, array $base) use ($meanPrims): array {
    $a = $meanPrims($self); $b = $meanPrims($base); $main = 0.0; $other = 0.0; $parts = []; $terms = [];
    foreach (formulaOf($mt) as $q => $w) { $v = $w * ($a[$q] - $b[$q]); $terms[$q] = $v; if ($q === $P) $main += $v; else $other += $v; $parts[] = sprintf('%s%+.2f', $q, $v); }
    return [$main, $other, implode(' ', $parts), $terms];
};
$MLIST_MR = "(?:$MET_RE)(?:・(?:$MET_RE))*";
foreach ($loaded as $rel => $a) {
    if (!is_array($a)) continue;
    $cat = explode('/', $rel)[0];
    if (!in_array($cat, ['blood', 'mbti', 'seiza', 'style', 'tendency', 'bundle', 'guide'], true)) continue;
    $kind = null; $self = null; $tRe = null;
    if ($cat === 'blood') { $kind = 'b'; $self = $a['code']; $tRe = $BLOOD_T_RE; }
    elseif ($cat === 'mbti') { $kind = 'm'; $self = strtoupper((string)$a['code']); $tRe = $TYPE_RE; }
    elseif ($cat === 'seiza') { $kind = 's'; $self = signIndex((string)$a['name']); $tRe = $SIGN_RE; }
    $artMetric = in_array($cat, ['style', 'tendency'], true) && in_array($a['name'] ?? '', $METRICS, true) ? $a['name'] : null;
    foreach (leaves($a) as $where => $text) {
        $ctxMetric = preg_match("/^(?:styles|tendencies)\\.($MET_RE)\\./u", $where, $x) ? $x[1] : null;
        $sents = sentences($text);
        foreach ($sents as $si => $s) {
            if (!preg_match("/(?<p>$PRIM_RE)が(?<k>主軸|主な要素)(?<f>のため|なので|の指標です|である一方)/u", $s, $m)) continue;
            if ($m['k'] === '主な要素' && $m['f'] !== 'のため' && $m['f'] !== 'なので') continue;
            $P = $m['p'];
            $form = $m['f'] === 'の指標です' ? 'の指標です' : ($m['f'] === 'である一方' ? 'である一方' : 'のため');
            $concl = $form !== 'の指標です' ? mb_substr($s, mb_strpos($s, $m[0]) + mb_strlen($m[0])) : implode('', array_slice($sents, $si + 1));
            $sentence = $form !== 'の指標です' ? $s : $s . $concl;
            $metrics = $ctxMetric !== null ? [$ctxMetric] : ($artMetric !== null ? [$artMetric] : (preg_match("/^($MLIST_MR)(?:は|が|の)/u", $s, $x) ? explode('・', $x[1]) : []));
            $judge = null; $why = [];
            if (!$metrics) { $judge = '要判断'; $why[] = '対象の指標を特定できない'; $axisMsg = ''; }
            else {
                $mt = $metrics[0];
                $axisOk = dominantPrim($mt) === $P;
                $axisMsg = $axisOk ? "「{$P}が主軸」は成立（" . formulaStr($mt) . '）' : "「{$P}が主軸」は不成立：最大の正の重みは " . (dominantPrim($mt) ?? '同率で無し') . '（' . formulaStr($mt) . '）';
                $rank = ['成立' => 0, '要判断' => 1, '誤り' => 2];
                $sameJudge = null;
                if ($kind === null) { $judge = '要判断'; $why[] = '記事に比較の主体が無い（血液型・MBTI・星座の記事ではない）'; }
                else {
                if (preg_match("/(?<t>(?:$tRe)(?:・(?:$tRe))*)と(?:完全に)?同じ数値/u", $concl, $x)) {
                    preg_match_all("/$tRe/u", $x['t'], $tt); $holdsAll = true;
                    foreach ($tt[0] as $t) {
                        $o = $kind === 'b' ? str_replace('型', '', $t) : ($kind === 's' ? signIndex($t) : $t);
                        $diff = contribDiff($kind, $self, $o); $inF = array_intersect($diff, array_keys(formulaOf($mt)));
                        $same = lvDist(sub([$kind => $self]), $mt)['raw'] === lvDist(sub([$kind => $o]), $mt)['raw'];
                        $holdsAll = $holdsAll && !$inF && $same;
                        $why[] = "{$t}と寄与が異なるPrimitive=" . (implode('・', $diff) ?: 'なし') . '（式に' . ($inF ? implode('・', $inF) . 'あり' : '含まれない') . '）分布' . ($same ? '一致' : '不一致');
                    }
                    if (!$holdsAll) { $sameJudge = '誤り'; $why[] = '結論（同じ数値）が成り立たない'; }
                    elseif ($form !== 'の指標です') { $sameJudge = '誤り'; $why[] = '理由が誤り（同じ数値になるのは寄与の違うPrimitiveが式に含まれないため。主軸では説明できない）'; }
                    else { $sameJudge = $axisOk ? '成立' : '誤り'; $why[] = '同じ数値は別の文の理由（構造）で成立。主軸の文は指標の説明'; }
                }
                // 2026-10-06（Reviewer M1）：「同じ数値」の結論があっても、同じ注記に方向・水準の結論（全体平均…ほぼ同水準／上回る／下回る 等）があれば
                // それも判定し、両方のうち悪い方（成立＜要判断＜誤り）を採る。以前は「同じ数値」の分岐で判定が終わり、方向の主張が照合されていなかった。
                {
                    $dir = null; $bases = [];
                    // 2026-10-06（Reviewer M1 の残り）：「をやや上回」「をわずかに下回」等も方向として拾う（以前は「を(大きく)?上回／下回」だけで、程度の語が付くと方向を判定せず素通りしていた）
                    if (preg_match('/全体平均（[\d.]+%）(?:を(?:大きく|やや|わずかに)?上回|より(?:大きく|やや|わずかに)?高)/u', $concl)) { $dir = 1; $bases = [[]]; }
                    elseif (preg_match('/全体平均（[\d.]+%）(?:を(?:大きく|やや|わずかに)?下回|より(?:大きく|やや|わずかに)?低)/u', $concl)) { $dir = -1; $bases = [[]]; }
                    elseif (preg_match('/全体平均（[\d.]+%）(?:とほぼ同水準|と近い水準)/u', $concl)) { $dir = 0; $bases = [[]]; }
                    elseif ($kind === 'b' && preg_match('/4血液型の中で(?:突出して高い|最も高い)/u', $concl)) { $dir = 1; foreach (BLOODS as $bt) if ($bt !== $self && !preg_match('/（' . $bt . '型と同率）/u', $concl)) $bases[] = ['b' => $bt]; }
                    elseif ($kind === 'b' && preg_match('/4血液型の中で最も低い/u', $concl)) { $dir = -1; foreach (BLOODS as $bt) if ($bt !== $self) $bases[] = ['b' => $bt]; }
                    elseif ($kind === 'b' && preg_match('/((?:AB|A|B|O))型と比べて大きく低く/u', $concl, $y)) { $dir = -1; $bases = [['b' => $y[1]]]; }
                    elseif ($kind === 'b' && preg_match('/中程度の水準/u', $concl)) { $dir = 0; foreach (BLOODS as $bt) if ($bt !== $self) $bases[] = ['b' => $bt]; }
                    if ($dir === null) {
                        // 2026-10-06（Reviewer M1 の残り）：「同じ数値」は判定できても、方向・水準の結論らしき語があるのに上の形に当てはまらなければ、
                        // その方向を照合できていないので 要判断 にする（同じ数値の判定が 誤り ならそちらを採る）
                        if ($sameJudge !== null && (mb_strpos($concl, '全体平均（') !== false || preg_match('/上回|下回|高め|低め|高い|低い|同水準|近い/u', $concl))) {
                            $judge = $rank[$sameJudge] > $rank['要判断'] ? $sameJudge : '要判断'; $why[] = '方向の結論を判定できない';
                        }
                        elseif ($sameJudge !== null) $judge = $sameJudge;
                        else { $judge = '要判断'; $why[] = '結論の形を判定できない'; }
                    }
                    else {
                        $worst = '成立'; $cited = null;
                        // 理由に挙げた項：「Qがマイナスに働く」「Qへの寄与が無い」「Qの寄与のみ」「計算式(上|で)マイナスに働くQ」（2026-10-06 m3：「Pが主軸である一方」の形も対象）
                        if ($form !== 'のため' && preg_match_all("/計算式(?:上|で)?マイナスに働く($PRIM_RE)|($PRIM_RE)(?:がマイナスに働く|への寄与が無い|の寄与のみ)/u", $concl, $cz, PREG_SET_ORDER)) foreach ($cz as $z) { $q = ($z[1] ?? '') !== '' ? $z[1] : $z[2]; if ($q !== $P && isset(formulaOf($mt)[$q])) { $cited = $q; break; } }
                        if ($cited !== null) $why[] = "記事が理由に挙げた項={$cited}";
                        foreach ($bases as $bf) {
                            [$main, $other, $parts, $terms] = $decompose($mt, $P, [$kind => $self], $bf);
                            $hs = high([$kind => $self], $mt); $hb = high($bf, $mt);
                            $line = sprintf('vs %s：High %.1f%% / %.1f%%、寄与差 %s（主軸%+.2f・他%+.2f）', $bf === [] ? '全体' : ($bf['b'] . '型'), $hs, $hb, $parts, $main, $other);
                            if ($dir === 0) {
                                $j = (abs($main) < 0.05 && abs($other) < 0.05) ? '成立' : '要判断';
                                if ($j !== '成立') $line .= ' → 主軸または他の項の寄与差があり「近い」を主軸で説明できない';
                            } elseif (($hs <=> $hb) !== $dir) { $j = '誤り'; $line .= ' → 実測の方向が逆'; }
                            elseif ($cited !== null) {
                                $cv = $terms[$cited]; $mx = max(array_map('abs', $terms));
                                if ($cv * $dir > 1e-9 && abs($cv) >= $mx - 1e-9) $j = '成立';
                                else { $j = '要判断'; $line .= " → 記事が挙げた理由（{$cited}" . sprintf('%+.2f', $cv) . '）より他の項の寄与差のほうが大きい'; }
                            }
                            elseif ($main * $dir <= 1e-9) { $j = $form === 'のため' ? '誤り' : '要判断'; $line .= ' → 主軸の寄与差では説明できない（主軸の差が' . (abs($main) < 1e-9 ? 'ゼロ' : '逆向き') . '）'; }
                            elseif (abs($other) > abs($main)) { $j = '要判断'; $line .= ' → 他の項の影響のほうが大きい'; }
                            else $j = '成立';
                            if ($rank[$j] > $rank[$worst]) $worst = $j;
                            $why[] = $line;
                        }
                        $dirJudge = $axisOk ? $worst : '誤り';
                        $judge = ($sameJudge !== null && $rank[$sameJudge] > $rank[$dirJudge]) ? $sameJudge : $dirJudge;
                    }
                }
                }
            }
            $status = $judge;
            if ($judge === '要判断') foreach ($MAIN_REASON_CLAIMS as [$cr, $cw, $cm, $ci, $cok]) if ($cr === $rel && $cw === $where && mb_strpos($cm, $sentence) !== false) { $status = '個別の主張で照合'; $why[] = "→ claim#{$ci}（" . ($cok ? 'PASS' : 'FAIL') . '）で寄与の向き・項の大小・数値を照合'; break; }
            $MAIN_REASON_N[$status]++;
            $label = mb_strimwidth($sentence, 0, 80, '…');
            chk($rel, "mainReason@$where", $status === '成立' || $status === '個別の主張で照合', "[{$status}] 「{$label}」 → " . ($axisMsg !== '' ? "$axisMsg ／ " : '') . implode(' ／ ', $why), 'SEM', $text);
        }
    }
}

// ======================================================================
// 5e. 程度の語と理由の主従（2026-10-07追加。checkOverallAvg・5 節の (20)・(27) を統合）
//     全記事・全フィールド（注記・FAQ・まとめ・因果の説明等）を走査し、比較の形を拾って次の2つを照合する。
//
//   (a) 程度の語（rule "degree:<形>@<フィールド>"）
//       比較の形（比較相手は記事から特定できるものだけ）：
//         overall : 「全体平均（X%）より(大きく|やや|わずかに)?(低め|高め|低い|高い|低く|高く)」「全体平均（X%）を(大きく|やや|わずかに)?(上回|下回)」
//                   「全体平均（X%）と(ほぼ同水準|近い水準)」（自身＝記事の星座・血液型・MBTIタイプ、比較相手＝9216件全体）
//         blood   : 血液型記事の「(X型(・Y型)*)(（x%）)?(より(は)?|と比べて)…」「(X型)（x%）(に近い水準|とほぼ同水準)」（比較相手＝列挙した血液型それぞれ）
//         sign    : 星座記事の「(星座)（(High)?x%）より…」（比較相手＝その星座）
//         type    : MBTI記事の「(TYPE)（(High|Mid|Low)?x%）(より|を)…」「(TYPE)より…」（比較相手＝そのタイプ）
//         top     : 血液型記事の「4血液型の中で(最も|突出して)(高|低)」（最上級。「（X型と同率）」は同率の相手）
//       2026-10-07（Reviewer M-1・指示 3）で加えた形：
//         上がる／下がる : 上の overall・blood・sign・type の「より」の代わりに「より(大きく|やや|わずかに)?(Highの割合が)?(大きく|やや|わずかに)?(上が|下が)」
//                   「と比べ(ると|て)、?(Highの割合が)?…(上が|下が)」「から(Y（w%）へ)?(最も)?…(上が|下が)」「よりY（w%）で…(上が|下が)」
//                   「よりHighの割合が(大きく|やや|わずかに)?(高|低)」（上が＝自身が上、下が＝自身が下）
//         さらに  : 「よりさらに高い」「をさらに大きく上回る」は「さらに」を除いた語で判定（「さらに」は程度の表に無い語）
//         sign・type の括弧 : 数値の無い括弧（「牡羊座（火・活動宮）より」「INTP（誠実性はIのみ）より」）と、数値の前の注記（「INTJ（Pが無くHigh39.2%）より」）。
//                   星座の数値は省略可。タイプは列挙可（「INTP・ENTJより」＝比較相手はそれぞれ）
//         type（MBTI記事のみ）: 「（X High v%→自身 High w%）では…下が」（矢印の前が比較相手）、「(X)のv%より…」
//         hoga    : 「(X)の方が(大きく|やや|わずかに)?(高|低)」。X が比較相手なら向きを反転（「ENTJの方が高い」＝自身が下）。
//                   X が自身なら、直後の括弧か同じ文にただ1つ出てくる別の星座・血液型・タイプを比較相手とする
//         implicit: 「Highの割合が(大きく|…)?(上が|下が)」「(では|で)(逆に)?(大きく|…)?(上が|下が)」で、同じ文のこの語より前に別の星座・血液型・タイプがただ1つ出てくるもの
//         bundle  : Style／Tendency 記事の「Bundleの主軸が(P)のケースでは(指標)のHigh率が v%…、(指標2)（(Q主軸で)?w%）(より|を|と)…」（スナップショットの主軸 p1 別）
//         style   : Style／Tendency 記事の「(X型)（v%）は…、(Y型)より…」「(TYPE…)のv%は、(TYPE…)のw%を(上回|下回)」（指標は記事の指標）
//       差 d ＝ 自身の High 率 − 比較相手の High 率（ポイント、スナップショットから未丸めで計算）。基準（docs/love/09-writing-rules.md「記事の数値の程度の語」）:
//         大きく                : |d| ≥ 20
//         修飾なし              : 10 ≤ |d| < 20（「低め」「低い」「低く」「上回る」「下回る」等、語尾によらない）
//         やや                  : |d| < 10
//         わずかに              : |d| < 5
//         ほぼ同水準            : |d| < 1
//         近い水準              : |d| < 5（「わずかに」と同じ幅。「ほぼ同水準」より広い。差 5 以上 10 未満は「近い水準」ではなく「やや」で書く。
//                                 「やや」は 10 未満の差に使う語で、5 未満の差にも使える）
//       境目は丸めない差で判定する（記事に書いた小数1桁の値どうしの引き算とは最大 0.1 ずれる）。
//         最も（最上級）        : 自身が4血液型の最高（最低）。同率（小数1桁で一致）の相手は「（X型と同率）」に書かれた血液型と一致すること
//         突出して（最上級）    : 最上級に加えて、2番目との差が 20 以上（「大きく」と同じ幅）
//       向き（高・上回 → d > 0、低・下回 → d < 0）と、書かれた比較相手の数値（X%）も照合する。
//       「上回る／下回る」に修飾が無いときも、向きだけでなく 10〜20 ポイントとする（向きだけ＝0 超とすると、修飾なしの幅 0〜20 が
//       「やや」（10 未満）・「わずかに」（5 未満）と重なり、語から差の大きさを読み取れなくなる。2026-10-07 時点の記事で、修飾なしの「上回る」が
//       +6.5〜+14.7、「やや上回る」が +2.8 と、同じ大きさの差が別の語で書かれていたため）。
//       指標は、注記ならフィールド（styles.<指標>.note）、それ以外は文中の「指標」（1つだけ）、無ければ同じフィールドの直前の文の指標。
//       特定できない文・比較相手を特定できない文（style/tendency/bundle/guide の記事の比較、「単独寄与のみのタイプより」等）は、照合せず
//       「照合できない程度の語」として末尾に一覧を出す（5f の登録が無ければ FAIL:UNJUDGED。2026-10-07）。mbti-blood は 4-6 節と不変条件テストで照合するため対象外。
//
//   (b) 理由の主従（rule "reason@<フィールド>"）
//       方向の比較（ほぼ同水準・近い水準以外）について、理由の範囲（注記はその比較の直前まで（前の比較より後）、それ以外は比較を含む文の比較より前と後ろ、次の文まで）から
//       理由に挙げた Primitive を拾い、比較相手ごとに式の各項の寄与差（termsDiff：重み × スナップショットの Primitive 平均の差）と照合する。
//       式の説明（「PからQを差し引く指標です」「P・Qで決まる指標です」「Pが主軸の指標です」等）は理由に数えない。
//         - 「(P)…(が|を)主因」：P が寄与差の絶対値が最大の項（主因）で、結論の向きに働くこと。
//           2026-10-07（m-4）：続けて「(Q)…がそれを(一部|おおむね)(打ち消|補)」と書いていれば、Q が結論と逆向きで、主因に対する比が
//           「一部」＝[0.2, 0.75)・「おおむね」＝[0.75, 1) に入ること。2026-10-07（MJ-1・MJ-2）：続けて「(Q)…分も加わ」と書いていれば、従因 Q が結論の向きに働き、主因より小さいこと。それ以外の形の比は 5 節の個別の主張で照合する。
//         - それ以外：拾った形（下の $REASON_FORMS）で挙げた項の集合 C について
//             ・どの比較相手でも、主因が C に含まれること（主因が 0 のときを除く）
//             ・C のどの項も、どの比較相手でも結論と逆向きでないこと
//             ・C のどの項も、少なくとも1つの比較相手で寄与差が 0 でないこと（差を生まない項を理由にしない）
//             ・2026-10-07（m-2）：比較相手が複数のとき、C のどの項も、どの比較相手とも差を生むこと（一部の相手と寄与差が 0 の項を挙げるなら、相手を分けて書く）
//           相手を分けて書いた理由（「(X型(・Y型)*)との差は…、(Z型)とは…」）は、相手ごとにその区切りの理由で照合する（区切りに無い相手は区切りの前の部分）。2026-10-07（MJ-1）：MBTIタイプ・星座も同じ（「INFPとの差は…、ENFJとは…」。理由の範囲に「(タイプ|星座)との差は」があるときだけ区切る）。
//           「AためXが、BためYが、それぞれ…」は、指標ごとにその指標の前の理由（A または B）だけを理由の範囲にする（m-3）。
//           MBTI の文字の対比（「Sは誠実性に、Nは情動性に寄与するため」）と、前の文を受ける理由（文頭の「そのため」「この違いが」等）、
//           同じ文の前の比較から引き継いだ理由、「一方」の前の文の前半の理由は、前置き（setup）として主因が含まれるかだけを照合する
//           （一方の文字の項が指標によっては逆向きになる・前の比較のための理由を含むため。逆向き・寄与差 0 の判定には使わない）。
//           「〜ものの」「〜ありますが」「〜があっても」のように譲歩の形で挙げた項は理由に数えない。
//       「(P)が主軸(のため|なので|の指標です|である一方)」を含む注記・文は 5d 節で照合するため、ここでは理由を照合しない（二重管理を避ける）。
//       ただし「(Q)…(が|を)主因」と書いた文は、5d が主因の項を判定しないため、ここで主因を照合する（変異テストで、主因の入れ替えが個別の主張でしか検出されなかったため）。
//       理由の範囲に式の Primitive が出てくるのに拾える形が無いものは「照合できない理由」として一覧を出す（5f の登録が無ければ FAIL:UNJUDGED）。
//       2026-10-07（MJ-1）：比較の後ろの理由の範囲（次の文）は、同じ文の後ろに別の比較があっても、その比較と同じ範囲（次の文の最初の比較の手前まで）を当てる。
//       同じ文の後ろの比較が次の文の理由を使ったのに、前の比較に理由の形も式の項も無いときは「照合できない理由」に出す。
// ======================================================================
$DEG_N = 0; $REASON_N = 0; $DEG_UNMATCHED = []; $REASON_UNMATCHED = []; $DEG_SKIPPED_CAT = [];
const DEG_WORD_RE = '(?<deg>大きく|やや|わずかに)?(?<w>低め|高め|低い|高い|低く|高く)';
/** 程度の語の判定。$d は自身 − 比較相手（ポイント） */
function degreeJudge(string $deg, string $w, float $d): array {
    if ($w === 'ほぼ同水準') return [abs($d) < 1, '「ほぼ同水準」＝差1未満'];
    if ($w === '近い水準') return [abs($d) < 5, '「近い水準」＝差5未満'];
    $up = (bool)preg_match('/^(?:高|上回|上が)/u', $w); $a = abs($d);
    [$ok, $rng] = match ($deg) { '大きく' => [$a >= 20, '20以上'], 'やや' => [$a < 10, '10未満'], 'わずかに' => [$a < 5, '5未満'], default => [$a >= 10 && $a < 20, '10以上20未満'] };
    $dirOk = $up ? $d > 0 : $d < 0;
    return [$ok && $dirOk, '「' . ($deg === '' ? '修飾なし' : $deg) . "」＝差{$rng}・向き" . ($up ? '上' : '下') . ($dirOk ? '' : '（実測は逆向き）')];
}
/** 寄与差の項のうち絶対値が最大の項（同値なら複数） */
function mainTerms(array $t): array { $mx = max(array_map('abs', $t)); return $mx < 1e-9 ? [] : array_keys(array_filter($t, fn($v) => abs($v) >= $mx - 1e-9)); }
/** 理由の形（cited＝理由に挙げた項。'list' の名前付きグループが無い列挙形は式の全 Primitive） */
$P5 = "(?:$PRIM_RE)";
$NX5 = "(?:(?!{$P5})[^。、])";  // 別の Primitive 名をまたがない1文字（「情動性が無く誠実性が…マイナスに働く」で、情動性をマイナスの項と取り違えないため）
$REASON_FORMS = [
    // 「P・Qのどちらにも〜寄与が無いため」「どちらも〜伸びません。」。列挙が無ければ式の全 Primitive。直後が「ため」「。」「で」のときだけ（「どちらにも寄与しないA型」のような連体修飾は理由ではない）
    ['id' => 'listNoContrib', 're' => "/(?:(?<l>{$P5}(?:・{$P5})*)の?)?(?:どちらにも|どちらも)[^。、]*?(?:寄与が無い|寄与しない|伸びません|寄与がありません)(?=ため|。|で)/u"],
    ['id' => 'bothContrib',   're' => "/[^。、]*?両方[^。]*?寄与(?:する|し)/u", 'inMatch' => true],
    ['id' => 'arrow',         're' => "/→(?<l>{$P5}(?:・{$P5})*)/u"],
    ['id' => 'only',          're' => "/(?<p>{$P5})の(?:単独)?寄与のみ/u"],
    // 2026-10-07：「皆無」「ない」「加算がない」「寄与が(ISFP)には全く無い」も拾う（MBTI 記事の注記・FAQ）
    ['id' => 'noContrib',     're' => "/(?<l>{$P5}(?:・{$P5})*)(?:への(?:直接の)?(?:寄与|加算)(?:も|が|は|を)?(?:[^。、]{0,8}?には)?|が)(?:一切|全く|完全に)?(?:無|ない|なく|持たな|ありません|皆無)/u"],
    ['id' => 'mainAxisDe',    're' => "/(?<p>{$P5})が主軸で/u"],
    ['id' => 'minus',         're' => "/(?<p>{$P5})(?:は|が){$NX5}{0,15}?マイナスに(?:強く)?働|マイナスに働く(?<p2>{$P5})|(?<p3>{$P5})が差し引かれ|差し引かれる(?<p4>{$P5})/u"],
    // 2026-10-07：「A型とは自立性の分だけ差がつき」「誠実性への寄与が無い分も加わり」（相手を分けて書く形。docs/love/09-writing-rules.md）
    ['id' => 'portion',       're' => "/(?<p>{$P5})(?:への(?:寄与|加算))?(?:が無い|の)?分(?:だけ|も)/u"],
    ['id' => 'plus',          're' => "/(?<p>{$P5})(?:は|が)プラス/u"],
    ['id' => 'stronger',      're' => "/(?<p>{$P5})(?:の寄与の方|が)強/u"],
    ['id' => 'double',        're' => "/(?<p>{$P5})(?:が|の|は){$NX5}{0,12}?二重(?:寄与|で|に|、)|(?<p2>{$P5})寄与により/u"],
    // 2026-10-07（指示 3 (a)）：MBTI の文字の寄与。「Sは誠実性に、Nは情動性に寄与するため」「Fは情動性に寄与するため」は書かれた Primitive を、
    // 「Iによる寄与があるぶん」「Jによる寄与があるため」は inc の MBTI マッピングでその文字が寄与する Primitive（letterPrims）を理由に挙げた項とする
    // letterPair は「違う文字がそれぞれどの Primitive に寄与するか」の前置き（setup）として扱う：主因がこの中に含まれることは照合するが、
    // 指標によっては一方の文字の項が結論と逆向きになる（ESFP と ESTP の愛情表現の T→行動主導性）ので、逆向き・寄与差 0 の判定には使わない
    // 「Pは変化志向、Jは誠実性に寄与します」のように、列挙の前の方で「に」を省いた形も拾う
    ['id' => 'letterPair',    're' => "/[EISNTFJP](?:（[^）]*）)?は(?<l>{$P5}(?:・{$P5})*)(?:のみ|の両方)?(?:に(?=、[EISNTFJP](?:（[^）]*）)?は|寄与)|(?=、[EISNTFJP](?:（[^）]*）)?は))/u", 'setup' => true],
    ['id' => 'letterBy',      're' => "/(?<L>[EISNTFJP])による寄与(?:が|も)?(?:ある|あり)/u"],
    ['id' => 'diffOf',        're' => "/(?<p>{$P5})の差(?:が|で|に|により)/u"],
    ['id' => 'combination',   're' => "/この(?<l>{$P5}(?:・{$P5})*)という組み合わせ/u"],
    ['id' => 'subTerm',       're' => "/(?<p>{$P5})を(?:副次項|項)に持つ/u"],
    // 2026-10-07（指示 3 (a)）：「変化志向が関わるため」「変化志向のマイナス分があるため」「行動主導性への寄与は牡羊座の方が強く」
    ['id' => 'involvedBecause', 're' => "/(?<p>{$P5})が(?:関わる|絡む)ため/u"],
    ['id' => 'lose',          're' => "/(?<p>{$P5})への寄与を失/u"],
    ['id' => 'noMinus',       're' => "/(?<p>{$P5})のマイナス(?:分|要因)?(?:が|は)?(?:無|ない|なく|皆無)/u"],
    ['id' => 'minusPart',     're' => "/(?<p>{$P5})のマイナス(?:分|要因)?(?:が|も)?(?:ある|あり|働)/u"],
    ['id' => 'strongerOther', 're' => "/(?<p>{$P5})への寄与は[^。、]{1,8}の方が強/u"],
    ['id' => 'effectOf',      're' => "/(?<p>{$P5})の(?:負の)?影響(?:で|により|を受け)/u"],
    ['id' => 'heavyMetric',   're' => "/(?<p>{$P5})の重みが大きい指標のため/u"],
    // 2026-10-07（Reviewer MJ-1）：「J（判断）による誠実性への寄与によるもので」の「による」も拾う（infj の FAQ。それまで記事に「寄与による」は無かった）
    ['id' => 'contribHas',    're' => "/(?<p>{$P5})(?:への|の)(?:強い)?寄与(?:（[^）]*）)?(?:が|は|を)?(?:ある|あり|により|による|で|持つ)/u"],
    ['id' => 'primitiveOf',   're' => "/(?<p>{$P5})という(?:プリミティブ)?に(?:寄与|集約)/u"],
    ['id' => 'weaker',        're' => "/(?<p>{$P5})(?:の寄与)?(?:が|は){$NX5}{0,25}?弱/u"],
    ['id' => 'smallEffect',   're' => "/(?<p>{$P5})の影響は小さ/u"],
    ['id' => 'concessive',    're' => "/(?<p>{$P5})(?:（[^）]*）)?が(?:あっても|あるものの)/u", 'counter' => true],
];
/** 理由の範囲 $R から挙げた項を拾う。戻り値 ['main' => 主因として書いた項|null, 'cited' => [...], 'counter' => [...], 'forms' => [...], 'mentioned' => [...]] */
$reasonParse = function (string $R, array $fprims, bool $allowScope = true) use ($REASON_FORMS, $P5, $TYPE_RE, $SIGN_RE, &$reasonParse): array {
    $s = preg_replace([
        "/{$P5}(?:×[\\d.]+)?(?:(?:・|と|、|＋|－|から){$P5}(?:×[\\d.]+)?)+(?:を差し引く|のみで決まる|で決まる|から構成される|から計算される)指標(?:です|ですが|で)?/u",
        "/{$P5}が主軸の指標です/u", "/{$P5}の重みが大きい指標です/u", "/{$P5}への寄与が1文字だけの/u",
    ], '', $R);
    $mentioned = []; foreach ($fprims as $p) if (mb_strpos($s, $p) !== false) $mentioned[] = $p;
    // 2026-10-07（m-2）：比較相手を分けて書いた理由「(X型(・Y型)*)との差は…、(Z型)とは…」。区切りごとに理由を拾い、比較相手ごとにその区切りの理由で照合する。
    // 区切りの前（どの相手にも限らない部分）は 'rest' として、区切りに含まれない比較相手に使う
    // 2026-10-07（Reviewer MJ-1）：MBTIタイプ・星座の相手別（「INFPとの差は…、ENFJとは…」）も同じ扱いにする。血液型は従来どおり「とは」だけでも区切るが、
    // タイプ・星座は「とは異なり」「蠍座とは同じ数値」のような相手別でない「とは」があるため、理由の範囲に「(タイプ|星座)との差は」があるときだけ区切る。
    // 区切りの相手は 'b:A'・'m:INFP'・'s:<星座の番号>' のキーで持つ
    $mk = [];
    if ($allowScope) {
        if (preg_match_all('/(?<t>(?:AB|A|B|O)型(?:・(?:AB|A|B|O)型)*)(?:との差は|とは)/u', $s, $x, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) $mk = $x;
        $ent = "(?:$TYPE_RE|$SIGN_RE)";
        if (preg_match("/{$ent}(?:・{$ent})*との差は/u", $s) && preg_match_all("/(?<t>{$ent}(?:・{$ent})*)(?:との差は|とは)/u", $s, $x, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) $mk = array_merge($mk, $x);
        usort($mk, fn($p, $q) => $p[0][1] <=> $q[0][1]);
    }
    if ($mk) {
        $segs = [];
        foreach ($mk as $i => $k) {
            $to = $mk[$i + 1][0][1] ?? strlen($s);
            preg_match_all("/(AB|A|B|O)型|$TYPE_RE|$SIGN_RE/u", $k['t'][0], $tt);
            $keys = array_map(fn($e) => preg_match('/^(AB|A|B|O)型$/u', $e, $y) ? "b:{$y[1]}" : (preg_match("/^$TYPE_RE$/u", $e) ? "m:$e" : 's:' . signIndex($e)), $tt[0]);
            $segs[] = [$keys, $reasonParse(substr($s, $k[0][1], $to - $k[0][1]), $fprims, false), $k['t'][0]];
        }
        $out = $reasonParse(substr($s, 0, $mk[0][0][1]), $fprims, false);
        $out['scoped'] = $segs; $out['mentioned'] = $mentioned;
        $out['forms'][] = '相手別（' . implode('／', array_map(fn($g) => $g[2] . ':' . (implode('・', array_merge($g[1]['main'] !== null ? ['主因' . $g[1]['main']] : [], $g[1]['cited'], array_map(fn($q) => "従因$q", $g[1]['add'] ?? []))) ?: 'なし'), $segs)) . '）';
        return $out;
    }
    // 「主因」の範囲：「(X型(・Y型)*)との差は、…主因」と比較相手を限っていれば、その比較相手についてだけ主因を照合する（b-love の独占欲。A型との差は別の文で述べている）
    if (preg_match("/(?<p>{$P5})(?:(?!{$P5})[^。、])*?(?:が|を)主因/u", $s, $x, PREG_OFFSET_CAPTURE)) {
        $scope = preg_match('/((?:AB|A|B|O)型(?:・(?:AB|A|B|O)型)*)との差は[^。]*主因/u', $s, $y) && preg_match_all('/(AB|A|B|O)型/u', $y[1], $yy) ? $yy[1] : null;
        // 2026-10-07（m-4）：「〜が主因で、(Q)…がそれを(一部|おおむね)(打ち消|補)」の Q と比の語。Q は「主因」と「それを」の間に出てくる最後の Primitive
        $ctr = null;
        $restS = substr($s, $x[0][1] + strlen($x[0][0]));
        if (preg_match('/^(?<seg>[^。]*?)それを(?<k>一部|おおむね)(?:打ち消|補)/u', $restS, $z) && preg_match_all("/{$P5}/u", $z['seg'], $zz)) $ctr = [end($zz[0]), $z['k']];
        // 2026-10-07（Reviewer MJ-1・MJ-2）：「〜が主因で、(Q)…分も加わ」「〜を主因に、(Q)…分も加わ」の従因 Q。Q は「主因」と「分も加わ」の間に出てくる最後の Primitive。
        // 従因は、結論の向きに働き、主因より小さいこと（以前は 5 節の個別の主張の 'add' だけで照合していた。相手の取り違え・差を生まない項を従因に書く誤りを 5e でも検出する）
        $add = [];
        if (preg_match('/^(?<seg>[^。]*?)分も加わ/u', $restS, $z) && preg_match_all("/{$P5}/u", $z['seg'], $zz)) $add = [end($zz[0])];
        return ['main' => $x['p'][0], 'mainScope' => $scope, 'cited' => [$x['p'][0]], 'counter' => [], 'ratio' => $ctr, 'add' => $add, 'forms' => ['主因' . ($scope ? '（' . implode('・', $scope) . '型との差）' : '') . ($ctr ? "・{$ctr[1]}打ち消す側={$ctr[0]}" : '') . ($add ? "・従因={$add[0]}" : '')], 'mentioned' => $mentioned];
    }
    $cited = []; $counter = []; $forms = []; $setup = [];
    $grp = fn(array $m, string $k): string => isset($m[$k]) && $m[$k][1] >= 0 ? $m[$k][0] : '';
    foreach ($REASON_FORMS as $rf) {
        if (!preg_match_all($rf['re'], $s, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) continue;
        foreach ($mm as $m) {
            if (!empty($rf['inMatch'])) { $ps = array_values(array_filter($fprims, fn($p) => mb_strpos($m[0][0], $p) !== false)); }
            elseif ($grp($m, 'l') !== '') { $ps = explode('・', $grp($m, 'l')); }
            elseif ($rf['id'] === 'listNoContrib') { $ps = $fprims; }
            elseif ($rf['id'] === 'letterBy') { $ps = letterPrims($grp($m, 'L')); }
            else { $ps = [$grp($m, 'p') ?: ($grp($m, 'p2') ?: ($grp($m, 'p3') ?: $grp($m, 'p4')))]; }
            $after = mb_substr(substr($s, $m[0][1] + strlen($m[0][0])), 0, 12);  // 2026-10-07：バイト数で切ると UTF-8 の途中で切れて /u の照合が失敗し、譲歩を見落としていた
            // 譲歩：「〜ものの」「〜ありますが」「〜があっても」。2026-10-07：「〜なB型でも」「〜にもかかわらず」を加えた（b-love の恋愛の慎重さ）
            $isCounter = !empty($rf['counter']) || preg_match('/^[^、。]{0,6}?(?:ものの|ありますが|ますが|あっても|でも|にもかかわらず)/u', $after);
            foreach ($ps as $p) { if ($isCounter) $counter[$p] = true; elseif (!empty($rf['setup'])) $setup[$p] = true; else $cited[$p] = true; }
            $forms[] = $rf['id'] . ($isCounter ? '(譲歩)' : '');
        }
    }
    foreach (array_keys($counter) as $p) if (isset($cited[$p])) unset($counter[$p]);
    foreach (array_keys($setup) as $p) if (isset($cited[$p])) unset($setup[$p]);
    return ['main' => null, 'mainScope' => null, 'cited' => array_keys($cited), 'counter' => array_keys($counter), 'setup' => array_keys($setup), 'forms' => array_values(array_unique($forms)), 'mentioned' => $mentioned];
};
/** 2026-10-07（m-3）：「AためXが、BためYが、それぞれ…」の形なら、指標 $mt を挙げた区切りの理由（A または B）だけを返す。形が違えば $R のまま */
$MLIST5 = "(?:$MET_RE)(?:・(?:$MET_RE))*";
/** 理由の範囲から理由に挙げた項（主因・列挙・前置き）を1つでも拾えたか */
$hasReason = fn(array $rp): bool => $rp['main'] !== null || $rp['cited'] !== [] || !empty($rp['setup']) || !empty($rp['scoped']);
$segmentFor = function (string $R, string $mt, array $mts = []) use ($MLIST5, $P5): string {
    // 「(指標1)・(指標2)は…。前者は(P)、後者は(Q)の…を受けるため」：指標1 は P、指標2 は Q だけを理由にする（enfj のまとめ）
    if (count($mts) === 2 && preg_match("/前者は(?<a>{$P5})、後者は(?<b>{$P5})の/u", $R, $y)) return str_replace($y[0], ($mt === $mts[0] ? $y['a'] : $y['b']) . 'の', $R);
    if (!preg_match('/それぞれ\s*$/u', $R) || preg_match_all("/ため(?<m>{$MLIST5})が、/u", $R, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE) < 2) return $R;
    $prev = 0;
    foreach ($mm as $m) {
        if (in_array($mt, explode('・', $m['m'][0]), true)) return substr($R, $prev, $m[0][1] - $prev) . 'ため';
        $prev = $m[0][1] + strlen($m[0][0]);
    }
    return $R;
};
/** 理由の判定。$bases は比較相手の条件の配列、$dir は結論の向き（1／-1） */
$reasonJudge = function (array $rp, string $mt, array $selfF, array $bases, int $dir) use (&$reasonJudge, &$hasReason): array {
    if (!empty($rp['scoped'])) {
        // 相手を分けて書いた理由：比較相手ごとに、その相手を挙げた区切りの理由（無ければ区切りの前の部分）で照合する
        $okAll = true; $infos = [];
        foreach ($bases as $bf) {
            // 比較相手のキー（'b:A'・'m:INFP'・'s:<星座の番号>'）。区切りのキーと同じ形
            $bk = $bf === [] ? 'all' : array_key_first($bf) . ':' . reset($bf);
            $sub = null; foreach ($rp['scoped'] as [$bts, $srp]) if (in_array($bk, $bts, true)) { $sub = $srp; break; }
            $lab = $bf === [] ? '全体' : (isset($bf['b']) ? "{$bf['b']}型" : (isset($bf['s']) ? SEIZA_SIGNS[$bf['s']]['name'] : (string)reset($bf)));
            if ($sub === null) { $rest = $rp; unset($rest['scoped']); $sub = $hasReason($rest) ? $rest : null; }
            if ($sub === null) { $okAll = false; $infos[] = "vs{$lab}：相手を分けて書いた理由のどれにもこの相手が無い"; continue; }
            [$o1, $i1] = $reasonJudge($sub, $mt, $selfF, [$bf], $dir); $okAll = $okAll && $o1; $infos[] = "[vs{$lab}] $i1";
        }
        return [$okAll, implode(' ／ ', $infos)];
    }
    $fo = formulaOf($mt); $cited = array_values(array_intersect($rp['cited'], array_keys($fo))); $bad = []; $ds = []; $nonzero = [];
    // 2026-10-07（m-2）：比較相手が複数あるとき、理由に挙げた項が一部の相手では差を生まない（寄与差が 0）のに、相手を分けずに書いていれば不一致。
    // その項はその相手との差の理由にならないため（例：B型の結婚志向の「誠実性への寄与が無い」は A型との差の主因だが、O型・AB型も誠実性への寄与が無く差を生まない）。
    // docs/love/09-writing-rules.md「主因・従因の書き方」の「比較相手が複数あって主因が相手ごとに違うときは相手を分けて書く」を、寄与差で判定できる形にしたもの。
    // 挙げた項がどの相手とも差を生む場合（A型の積極性：O型・AB型のどちらとも行動主導性・情動性の両方で差がつく）は、主因が相手ごとに違っても列挙でよい
    if ($rp['main'] === null && $rp['mainScope'] === null && count($bases) >= 2) {
        $zeroFor = [];
        foreach ($bases as $bf) { $t0 = termsDiff($mt, $selfF, $bf); if (!mainTerms($t0)) continue; foreach ($cited as $c0) if (abs($t0[$c0]) < 1e-9) $zeroFor[$c0][] = isset($bf['b']) ? "{$bf['b']}型" : json_encode($bf, JSON_UNESCAPED_UNICODE); }
        foreach ($zeroFor as $c0 => $who) $bad[] = "{$c0}は" . implode('・', $who) . 'との差を生まない（寄与差0）のに、相手を分けずに理由に挙げている';
    }
    $setupC = array_values(array_intersect($rp['setup'] ?? [], array_keys($fo)));  // 前置き（letterPair）の項：主因の照合だけに使う
    foreach ($bases as $bf) {
        $t = termsDiff($mt, $selfF, $bf); $mains = mainTerms($t);
        $lab = $bf === [] ? '全体' : implode('', array_map(fn($k, $v) => $k === 'b' ? "{$v}型" : ($k === 's' ? SEIZA_SIGNS[$v]['name'] : $v), array_keys($bf), $bf));
        $ds[] = "vs{$lab} " . termsStr($t) . ' 主因=' . (implode('・', $mains) ?: 'なし');
        if ($rp['main'] !== null) {
            if ($rp['mainScope'] !== null && !in_array($bf['b'] ?? '', $rp['mainScope'], true)) { $ds[count($ds) - 1] .= '（「との差は」の範囲外）'; continue; }
            if (!in_array($rp['main'], $mains, true)) $bad[] = "vs{$lab}：主因と書いた{$rp['main']}は寄与差の最大の項ではない";
            elseif ($t[$rp['main']] * $dir <= 1e-9) $bad[] = "vs{$lab}：主因と書いた{$rp['main']}が結論と逆向き";
            if (!empty($rp['ratio'])) {
                // 打ち消す側の項：結論と逆向きで、主因の項に対する絶対値の比が「一部」＝[0.2, 0.75)、「おおむね」＝[0.75, 1)
                [$cp, $kw] = $rp['ratio']; [$lo, $hi] = $kw === '一部' ? RATIO_PARTIAL : RATIO_MOSTLY;
                $cv = $t[$cp] ?? 0.0; $r = abs($cv) / max(1e-9, abs($t[$rp['main']] ?? 0.0));
                $ds[count($ds) - 1] .= sprintf(' %s/主因の比=%.2f', $cp, $r);
                if (!($cv * $dir < -1e-9)) $bad[] = "vs{$lab}：打ち消す側と書いた{$cp}が結論と逆向きでない";
                elseif ($r < $lo || $r >= $hi) $bad[] = sprintf('vs%s：「%s打ち消す」の比は[%.2f, %.2f)だが%.2f', $lab, $kw, $lo, $hi, $r);
            }
            // 従因（「〜分も加わ」）：結論の向きに働き、主因より小さいこと
            foreach ($rp['add'] ?? [] as $q) {
                $qv = $t[$q] ?? 0.0; $ds[count($ds) - 1] .= sprintf(' 従因%s%+.2f', $q, $qv);
                if (!isset($t[$q])) $bad[] = "vs{$lab}：従因と書いた{$q}は{$mt}の式に無い";
                elseif (!($qv * $dir > 1e-9)) $bad[] = "vs{$lab}：従因と書いた{$q}が結論の向きに働かない（寄与差" . sprintf('%+.2f', $qv) . '）';
                elseif (abs($qv) >= abs($t[$rp['main']] ?? 0.0) - 1e-9) $bad[] = "vs{$lab}：従因と書いた{$q}が主因より小さくない";
            }
            continue;
        }
        if ($mains && !array_intersect($mains, array_merge($cited, $setupC))) $bad[] = "vs{$lab}：主因（" . implode('・', $mains) . '）を理由に挙げていない';
        foreach ($cited as $c) { if ($t[$c] * $dir < -1e-9) $bad[] = "vs{$lab}：{$c}は結論と逆向き"; if (abs($t[$c]) > 1e-9) $nonzero[$c] = true; }
    }
    if ($rp['main'] === null) foreach ($cited as $c) if (!isset($nonzero[$c])) $bad[] = "{$c}は寄与差が0（差を生まない項）";
    if ($rp['main'] === null && $cited === [] && $setupC === []) $bad[] = '理由に挙げた項（' . implode('・', array_merge($rp['cited'], $rp['setup'] ?? [])) . "）が{$mt}の式に無い";
    $info = '挙げた項=' . (implode('・', $rp['cited']) ?: 'なし') . (!empty($rp['setup']) ? '（前置き: ' . implode('・', $rp['setup']) . '）' : '') . ($rp['counter'] ? '（譲歩: ' . implode('・', $rp['counter']) . '）' : '') . ' 形=' . implode(',', $rp['forms']) . ' ／ ' . implode(' ／ ', $ds);
    return [$bad === [] && ($rp['main'] !== null || $cited !== [] || $setupC !== []), ($bad ? implode('；', array_unique($bad)) . ' → ' : '') . $info];
};
$BT_RE = '(?:AB|A|B|O)型';
// 照合できない程度の語を拾う語（比較の形に当てはまらないものを一覧に出すため）。
// 2026-10-07（Reviewer M-1）：「より(大きく|やや|わずかに)?(Highの割合が)?上がる／下がる」「Highの割合が上がる／下がる」「Xの方が(大きく|やや)?高い／低い」
// 「Xと比べると…上がる／下がる」「(大きく|やや|わずかに)上がる／下がる」を加えた（以前はこれらの形が比較の形にも一覧にも出ず、程度の語が照合されていなかった）
$DEG_ANY_RE = '/(?:より(?:は)?|を|と比べて)(?:大きく|やや|わずかに)?(?:低め|高め|低い|高い|低く|高く|上回|下回)|ほぼ同水準|近い水準|全体平均並み'
    . '|より(?:は)?(?:大きく|やや|わずかに)?(?:Highの割合(?:が|は|も))?(?:大きく|やや|わずかに)?(?:上が|下が)'
    . '|High(?:の割合)?(?:が|は|も)(?:大きく|やや|わずかに)?(?:上が|下が)'
    . '|の方が(?:大きく|やや|わずかに)?(?:高|低)'
    . '|と比べ(?:ると|て)、?[^。、]{0,15}?(?:上が|下が)'
    . '|(?:大きく|やや|わずかに)(?:上が|下が)'
    // 2026-10-07（指示 3 の走査）：「よりHighの割合が高く」「よりさらに高い」「より穏やか」「から…下がる」も拾う（以前はどの一覧にも出なかった）
    . '|より(?:は)?Highの割合(?:が|は|も)(?:大きく|やや|わずかに)?(?:高|低)|より(?:は)?さらに(?:高|低)|(?:より(?:は)?|の方が)(?:穏やか|控えめ)|から[^。、]{0,15}?(?:上が|下が)'
    // 2026-10-07（Reviewer MJ-2・MJ-3・Minor）：比較相手の語の無い「高め／低め」（「高めに出やすく」「さらに低めになる」）と、
    // 数値・水準に付く「穏やか／控えめ」（「High16.1%と控えめ」「控えめな水準」）も拾う。比較の形に当てはまれば（「全体平均より低め」等）その比較の範囲に入るので一覧には出ない
    . '|(?:大きく|やや|わずかに|さらに)?(?:高め|低め)|(?:大きく|やや|わずかに)(?:高|低)(?:く|い)|High[\d.]+%と(?:穏やか|控えめ)|(?:穏やか|控えめ)な水準/u';
// 「上がる／下がる」の比較の語尾（$tail・血液型の形で共通）。程度の語は「より」の直後と「Highの割合が」の後のどちらにも置ける
const DEG_UPDOWN_RE = 'より(?:は)?(?<deg5>大きく|やや|わずかに)?(?:Highの割合(?:が|は|も))?(?<deg6>大きく|やや|わずかに)?(?<w5>上が|下が)'
    . '|と比べ(?:ると|て)、?(?:Highの割合(?:が|は|も))?(?<deg7>大きく|やや|わずかに)?(?<w7>上が|下が)'
    // 「X（v%）から(最も)?大きく下がる」「X（v%）からY（w%）へ大きく下がる」「X（v%）よりY（w%）で下がる」「XよりHighの割合が高く」
    . '|から(?:[^。、（]{1,8}（[^）]*）へ)?(?:最も)?(?<deg8>大きく|やや|わずかに)?(?<w8>上が|下が)'
    . '|より[^。、（]{1,8}（[^）]*）で(?<deg9>大きく|やや|わずかに)?(?<w9>上が|下が)'
    . '|より(?:は)?Highの割合(?:が|は|も)(?<deg10>大きく|やや|わずかに)?(?<w10>高め|低め|高い|低い|高く|低く)';
$MAIN5D_RE = "/{$P5}が(?:主軸|主な要素)(?:のため|なので|の指標です|である一方)/u";
foreach ($loaded as $rel => $a) {
    if (!is_array($a)) continue;
    $cat = explode('/', $rel)[0];
    if ($cat === 'mbti-blood') { $DEG_SKIPPED_CAT[$rel] = true; continue; }
    $kind = null; $self = null;
    if ($cat === 'blood') { $kind = 'b'; $self = (string)$a['code']; }
    elseif ($cat === 'mbti') { $kind = 'm'; $self = strtoupper((string)$a['code']); }
    elseif ($cat === 'seiza') { $kind = 's'; $self = signIndex((string)$a['name']); }
    $selfF = $kind !== null ? [$kind => $self] : null;
    foreach (leaves($a) as $where => $text) {
        $ctxMetric = preg_match("/^(?:styles|tendencies)\\.($MET_RE)\\.note$/u", $where, $x) ? $x[1] : null;
        // 比較の形を拾う（バイト位置つき）
        $cmps = [];
        $add = function (string $form, array $m, array $bases, ?array $vals, string $deg, string $w, array $extra = []) use (&$cmps) {
            $cmps[] = ['form' => $form, 'start' => $m[0][1], 'end' => $m[0][1] + strlen($m[0][0]), 'text' => $m[0][0], 'bases' => $bases, 'vals' => $vals, 'deg' => $deg, 'w' => $w] + $extra;
        };
        $g = fn(array $m, string $k): string => isset($m[$k]) && $m[$k][1] >= 0 ? $m[$k][0] : '';
        if ($selfF !== null) {
            // 2026-10-07：「よりさらに高い」「をさらに大きく上回る」の「さらに」は程度の表に無い語なので、取り除いた語（「高い」＝修飾なし、「大きく上回る」）として照合する
            $tail = '(?:より(?:は)?(?:さらに)?' . DEG_WORD_RE . '|' . DEG_UPDOWN_RE . '|を(?:さらに)?(?<deg2>大きく|やや|わずかに)?(?<w2>上回|下回)|(?:と|に)(?<w3>ほぼ同水準|近い水準)|並みか(?<deg4>やや)(?<w4>低め|高め))';
            $degOf = fn(array $m): string => $g($m, 'deg') . $g($m, 'deg2') . $g($m, 'deg4') . $g($m, 'deg5') . $g($m, 'deg6') . $g($m, 'deg7') . $g($m, 'deg8') . $g($m, 'deg9') . $g($m, 'deg10');
            $wOf = fn(array $m): string => $g($m, 'w') . $g($m, 'w2') . $g($m, 'w3') . $g($m, 'w4') . $g($m, 'w5') . $g($m, 'w7') . $g($m, 'w8') . $g($m, 'w9') . $g($m, 'w10');
            if (preg_match_all("/全体平均(?:（(?<v>[\\d.]+)%）)?$tail/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m)
                $add('overall', $m, [[]], $g($m, 'v') !== '' ? ['v' => $g($m, 'v'), 'lv' => 'High'] : null, $degOf($m), $wOf($m));
            if ($kind === 'b') {
                if (preg_match_all("/(?<t>$BT_RE(?:・$BT_RE)*)(?:（(?:High)?(?<v>[\\d.]+)%）)?(?:(?:より(?:は)?|と比べて)" . DEG_WORD_RE . '|' . DEG_UPDOWN_RE . "|を(?<deg2>大きく|やや|わずかに)?(?<w2>上回|下回)|(?:と|に)(?<w3>ほぼ同水準|近い水準))/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                    preg_match_all('/(AB|A|B|O)型/u', $g($m, 't'), $tt); $bs = array_map(fn($b) => ['b' => $b], $tt[1]);
                    $add('blood', $m, $bs, $g($m, 'v') !== '' ? ['v' => $g($m, 'v'), 'lv' => 'High'] : null, $degOf($m), $wOf($m));
                }
                if (preg_match_all('/4血液型の中で(?<deg>突出して|最も)(?<w>高|低)/u', $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                    $rest = substr($text, $m[0][1]); $rest = substr($rest, 0, (strpos($rest, '。') !== false ? strpos($rest, '。') : strlen($rest)));
                    $ties = preg_match('/（((?:AB|A|B|O)型(?:・(?:AB|A|B|O)型)*)と同率）/u', $rest, $y) ? (preg_match_all('/(AB|A|B|O)型/u', $y[1], $tt) ? $tt[1] : []) : [];
                    $bs = []; foreach (BLOODS as $bt) if ($bt !== $self && !in_array($bt, $ties, true)) $bs[] = ['b' => $bt];
                    $add('top', $m, $bs, null, $g($m, 'deg'), $g($m, 'w'), ['ties' => $ties]);
                }
            }
            // 2026-10-07（指示 3 (a)）：星座の数値は省略可（「牡羊座より高く」）。括弧に数値以外の注記があってもよい（「牡羊座（火・活動宮）より」）
            if ($kind === 's' && preg_match_all("/(?<t>$SIGN_RE)(?:（[^）%]*?(?:High)?(?<v>[\\d.]+)%）|（[^）]*）)?$tail/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                if ($g($m, 't') === $a['name']) continue;
                $add('sign', $m, [['s' => signIndex($g($m, 't'))]], $g($m, 'v') !== '' ? ['v' => $g($m, 'v'), 'lv' => 'High'] : null, $degOf($m), $wOf($m));
            }
            // 2026-10-07（指示 3 (a)）：タイプの列挙（「INTP・ENTJより」）と、括弧の注記（「INTP（誠実性はIのみ）より」「INTJ（Pが無くHigh39.2%）より」）も拾う
            if ($kind === 'm' && preg_match_all("/(?<t>$TYPE_RE(?:・$TYPE_RE)*)(?:（[^）%]*?(?:(?<lv>High|Mid|Low)\\s*)?(?<v>[\\d.]+)%）|（[^）]*）)?$tail/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                $ts = array_values(array_diff(explode('・', $g($m, 't')), [$self]));
                if (!$ts) continue;
                $add('type', $m, array_map(fn($t) => ['m' => $t], $ts), $g($m, 'v') !== '' && count($ts) === 1 ? ['v' => $g($m, 'v'), 'lv' => $g($m, 'lv') ?: 'High'] : null, $degOf($m), $wOf($m));
            }
            if ($kind === 'm') {
                // 「（ENFP High88.2%→ENFJ High56.3%）では下がります」：矢印の前が比較相手
                if (preg_match_all("/（(?<t>$TYPE_RE) High(?<v>[\\d.]+)%→$TYPE_RE High[\\d.]+%）(?:では|で)(?<deg>大きく|やや|わずかに)?(?<w>上が|下が)/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m)
                    $add('type', $m, [['m' => $g($m, 't')]], ['v' => $g($m, 'v'), 'lv' => 'High'], $g($m, 'deg'), $g($m, 'w'));
                // 「（INFPの59.0%より低く、ENFPの72.2%より大きく低い）」：「(タイプ)のv%より」
                if (preg_match_all("/(?<t>$TYPE_RE)の(?<v>[\\d.]+)%より(?:は)?" . DEG_WORD_RE . '/u', $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m)
                    if ($g($m, 't') !== $self) $add('type', $m, [['m' => $g($m, 't')]], ['v' => $g($m, 'v'), 'lv' => 'High'], $g($m, 'deg'), $g($m, 'w'));
            }
            // 2026-10-07（Reviewer M-1）：「Xの方が(大きく|やや|わずかに)?(高|低)」。X が比較相手なら向きを反転する（「ENTJの方が高い」＝自身が下）。
            // X が自身なら、直後の括弧（「乙女座の方が高く（High46.2%・山羊座43.1%）」）か、無ければ同じ文の中にただ1つ出てくる別の星座・血液型・タイプを比較相手とする。
            // 比較相手を決められなければ比較の形にしない（「照合できない程度の語」に出る）
            $entRe = $kind === 'b' ? $BT_RE : ($kind === 's' ? $SIGN_RE : $TYPE_RE);
            $entKey = fn(string $t) => $kind === 'b' ? str_replace('型', '', $t) : ($kind === 's' ? signIndex($t) : $t);
            $sentenceAt = function (int $off) use ($text): string { $s = strrpos(substr($text, 0, $off), '。'); $s = $s === false ? 0 : $s + 3; $e = strpos($text, '。', $off); return substr($text, $s, ($e === false ? strlen($text) : $e) - $s); };
            $otherIn = function (string $s) use ($entRe, $entKey, $self): array { preg_match_all("/$entRe/u", $s, $x); return array_values(array_unique(array_filter(array_map($entKey, $x[0]), fn($k) => $k !== $self))); };
            if (preg_match_all("/(?<t>$entRe)(?:（[^）]*）)?の方が(?<deg>大きく|やや|わずかに)?(?<w>高|低)(?:[くいめ]|かった)?(?:（(?<par>[^）]*)）)?/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                $x = $entKey($g($m, 't')); $w = $g($m, 'w'); $vals = null;
                if ($x !== $self) { $other = $x; $w = $w === '高' ? '低' : '高'; }
                else {
                    $cand = $otherIn($g($m, 'par')); if (count($cand) !== 1) $cand = $otherIn($sentenceAt($m[0][1]));
                    if (count($cand) !== 1) continue;
                    $other = $cand[0];
                    $on = $kind === 'b' ? "{$other}型" : ($kind === 's' ? SEIZA_SIGNS[$other]['name'] : $other);
                    if (preg_match('/' . preg_quote($on, '/') . '(?:High)?([\d.]+)%/u', $g($m, 'par'), $y)) $vals = ['v' => $y[1], 'lv' => 'High'];
                }
                $add('hoga', $m, [[$kind => $other]], $vals, $g($m, 'deg'), $w);
            }
            // 「Highの割合が(大きく|やや|わずかに)?上がる／下がる」（「より」が無い形）：同じ文のこの語より前に、ただ1つ出てくる別の星座・血液型・タイプを比較相手とする
            // 2026-10-07：「…惚れやすさで逆に大きく下がる」（entj の因果の説明）も同じ扱い
            if (preg_match_all('/(?:High(?:の割合)?(?:が|は|も)|(?:では|で)(?:逆に)?)(?<deg>大きく|やや|わずかに)?(?<w>上が|下が)/u', $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                $covered = false; foreach ($cmps as $c) if ($m[0][1] >= $c['start'] && $m[0][1] < $c['end']) $covered = true;
                if ($covered) continue;
                $s0 = strrpos(substr($text, 0, $m[0][1]), '。'); $s0 = $s0 === false ? 0 : $s0 + 3;
                $cand = $otherIn(substr($text, $s0, $m[0][1] - $s0));
                if (count($cand) !== 1) continue;
                $add('implicit', $m, [[$kind => $cand[0]]], null, $g($m, 'deg'), $g($m, 'w'));
            }
        }
        // 2026-10-07（指示 3 (a)）：Style／Tendency 記事の血液型・タイプどうしの比較（指標は記事の指標）
        //   「B型（31.1%）は…、A型より高めです」「INTP・INFPの20.7%は、ESTJ・ESFJの34.5%を下回り」
        if ($kind === null && in_array($cat, ['style', 'tendency'], true) && in_array($a['name'] ?? '', $METRICS, true)) {
            if (preg_match_all("/(?<s>$BT_RE)（(?<sv>[\\d.]+)%）は[^。]*?、(?<t>$BT_RE)(?:（(?<v>[\\d.]+)%）)?より(?:は)?" . DEG_WORD_RE . '/u', $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m) {
                $sk = str_replace('型', '', $g($m, 's')); $tk = str_replace('型', '', $g($m, 't'));
                $add('style', $m, [['b' => $tk]], $g($m, 'v') !== '' ? ['v' => $g($m, 'v'), 'lv' => 'High'] : null, $g($m, 'deg'), $g($m, 'w'), ['selfF' => ['b' => $sk], 'subj' => $a['name'], 'om' => $a['name'], 'sv' => $g($m, 'sv')]);
            }
            if (preg_match_all("/(?<s>$TYPE_RE(?:・$TYPE_RE)*)の(?<sv>[\\d.]+)%は、?(?<t>$TYPE_RE(?:・$TYPE_RE)*)の(?<v>[\\d.]+)%を(?<deg2>大きく|やや|わずかに)?(?<w2>上回|下回)/u", $text, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) foreach ($mm as $m)
                foreach (explode('・', $g($m, 's')) as $st)
                    $add('style', $m, array_map(fn($t) => ['m' => $t], explode('・', $g($m, 't'))), ['v' => $g($m, 'v'), 'lv' => 'High'], $g($m, 'deg2'), $g($m, 'w2'), ['selfF' => ['m' => $st], 'subj' => $a['name'], 'om' => $a['name'], 'sv' => $g($m, 'sv')]);
        }
        // 2026-10-07（Reviewer M-2 の bundle_body）：Style／Tendency 記事の「Bundleの主軸が(P)のケースでは(指標)のHigh率が(v)%…、(指標2)（(Q主軸で)?(v2)%）(より…|を…|と…)」。
        // 比較の主体は主軸 P のケース（スナップショットの p1）での記事の指標（または文中の指標）、比較相手は同じケース（括弧に「Q主軸で」があれば Q のケース）での指標2
        if ($kind === null && in_array($cat, ['style', 'tendency'], true) && in_array($a['name'] ?? '', $METRICS, true)) {
            $sb0 = [0]; $p0 = 0; while (($q0 = strpos($text, '。', $p0)) !== false) { $sb0[] = $q0 + 3; $p0 = $q0 + 3; }
            $axis = null; $subj = null;
            foreach ($sb0 as $k0 => $from0) {
                $s = substr($text, $from0, ($sb0[$k0 + 1] ?? strlen($text)) - $from0);
                if (preg_match("/(?:(?<p>{$PRIM_RE})が主軸|主軸が(?<q>{$PRIM_RE}))のケース(?:では|で)(?:(?<m>$MET_RE)(?:のHigh率|は))?/u", $s, $y)) { $axis = P_CODE[($y['p'] ?? '') !== '' ? $y['p'] : $y['q']]; $subj = ($y['m'] ?? '') !== '' ? $y['m'] : $a['name']; }
                if ($axis === null) continue;
                if (!preg_match_all("/(?<t>$MET_RE)（(?:(?<ax>$PRIM_RE)主軸で)?(?<v>[\\d.]+)%）(?:より(?:は)?" . DEG_WORD_RE . "|を(?<deg2>大きく|やや|わずかに)?(?<w2>上回|下回)|(?:と|に)(?<w3>ほぼ同水準|近い水準))/u", $s, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) continue;
                foreach ($mm as $m) {
                    $m[0][1] += $from0; $bAx = $g($m, 'ax') !== '' ? P_CODE[$g($m, 'ax')] : $axis;
                    $add('bundle', $m, [['p1' => $bAx]], ['v' => $g($m, 'v'), 'lv' => 'High'], $g($m, 'deg') . $g($m, 'deg2'), $g($m, 'w') . $g($m, 'w2') . $g($m, 'w3'), ['selfF' => ['p1' => $axis], 'subj' => $subj, 'om' => $g($m, 't')]);
                }
            }
        }
        usort($cmps, fn($x, $y) => $x['start'] <=> $y['start']);
        // 照合できない程度の語（比較の形に当てはまらない）
        if (preg_match_all($DEG_ANY_RE, $text, $mm, PREG_OFFSET_CAPTURE)) foreach ($mm[0] as [$hit, $off]) {
            $covered = false; foreach ($cmps as $c) if ($off >= $c['start'] && $off < $c['end']) $covered = true;
            if (!$covered) { $ss = strrpos(substr($text, 0, $off), '。'); $ss = $ss === false ? 0 : $ss + 3; $se = strpos($text, '。', $off); $sent = substr($text, $ss, ($se === false ? strlen($text) : $se + 3) - $ss); $DEG_UNMATCHED[] = ['rel' => $rel, 'where' => $where, 'sent' => $sent, 'hit' => $hit, 'msg' => "$rel [$where] 「" . mb_strimwidth($sent, 0, 140, '…') . "」の「{$hit}」（比較相手" . ($kind === null ? 'の主体（星座・血液型・MBTI）が記事に無い' : 'を特定できない形') . '）']; }
        }
        // 文の境界（バイト位置）
        $sb = [0]; $p = 0; while (($q = strpos($text, '。', $p)) !== false) { $sb[] = $q + 3; $p = $q + 3; }
        $sentOf = function (int $off) use ($sb): int { $i = 0; foreach ($sb as $k => $b) if ($b <= $off) $i = $k; return $i; };
        $lastMts = null;  // 直前に特定できた指標（同じフィールドの中だけで引き継ぐ）
        // 比較の節の始まり：文頭・直前の比較の終わり・節の中の最後の「一方、」「一方で」の後ろのうち、いちばん後ろ（「…で特に高い値になる一方、…は全体平均より低め」）
        $clauseFrom = function (int $sIdx, int $start) use ($sb, $text, &$prevEnd): int {
            $from = max($sb[$sIdx], $prevEnd); $seg = substr($text, $from, $start - $from);
            if (preg_match_all('/一方(?:、|で、?)/u', $seg, $mm, PREG_OFFSET_CAPTURE)) { $last = end($mm[0]); $from += $last[1] + strlen($last[0]); }
            return $from;
        };
        $prevEnd = 0;
        $inherit = null;  // 同じ文の前の比較の理由（[文の番号, 理由の範囲]）。「AのためXでYを大きく上回り、ZもYより高い」の Z は A を理由とする
        $silent = []; $nextSentUsed = [];  // 理由の形も式の項も無かった比較（文の番号ごと）／次の文を理由の範囲に入れた文の番号
        foreach ($cmps as $ci => $c) {
            $sIdx = $sentOf($c['start']);
            if ($c['form'] === 'style') {
                $hs = high($c['selfF'], $c['subj']); $DEG_N++; $okAll = near($c['sv'], $hs); $di = [];
                foreach ($c['bases'] as $bf) { $hb = high($bf, $c['subj']); [$o1, $why] = degreeJudge($c['deg'], $c['w'], $hs - $hb); $okAll = $okAll && $o1 && ($c['vals'] === null || near($c['vals']['v'], $hb)); $di[] = json_encode($bf, JSON_UNESCAPED_UNICODE) . sprintf(' High=%s 差%+.1f ', r1($hb), $hs - $hb) . $why; }
                chk($rel, "degree:style@$where", $okAll, "「" . mb_strimwidth($c['text'], 0, 60, '…') . "」 {$c['subj']} 主体" . json_encode($c['selfF'], JSON_UNESCAPED_UNICODE) . ' High=' . r1($hs) . '（記事' . $c['sv'] . '） ／ ' . implode(' ／ ', $di), 'SEM', $text);
                $prevEnd = $c['end']; continue;
            }
            if ($c['form'] === 'bundle') {
                // Bundle の主軸別：同じ主軸のケース（または括弧に書いた主軸のケース）での2つの指標の High 率を比べる。理由は照合しない
                $hs = high($c['selfF'], $c['subj']); $hb = high($c['bases'][0], $c['om']); $DEG_N++;
                $valOk = near($c['vals']['v'], $hb); [$ok1, $why] = degreeJudge($c['deg'], $c['w'], $hs - $hb);
                $axJ = fn(array $f) => $P_NAME[$f['p1']] . '主軸';
                chk($rel, "degree:bundle@$where", $valOk && $ok1, "「" . mb_strimwidth($c['text'], 0, 60, '…') . "」 {$axJ($c['selfF'])}の{$c['subj']} High=" . r1($hs) . " ／ {$axJ($c['bases'][0])}の{$c['om']} High=" . r1($hb) . ($valOk ? '' : '（記事の数値と不一致）') . sprintf(' 差%+.1f ', $hs - $hb) . $why, 'SEM', $text);
                $prevEnd = $c['end']; continue;
            }
            // 対象の指標：注記はフィールドの指標。それ以外は、比較の節（文頭または直前の比較の後から、比較の終わりまで）に出てくる指標（「」付きを優先、複数可）。
            // 節に指標が無く「指標」という語も無ければ、同じフィールドで直前に特定できた指標を引き継ぐ（「ただし…A型（85.4%）より大きく低く」等）
            $mts = $ctxMetric !== null ? [$ctxMetric] : [];
            if (!$mts) {
                $from = $clauseFrom($sIdx, $c['start']); $clause = substr($text, $from, $c['end'] - $from);
                // 節の最後の「、」より後ろ（比較の直前の主語）に指標があればそれを使い、無ければ節全体から探す
                $lc = strrpos(substr($clause, 0, $c['start'] - $from), '、'); $near = $lc === false ? $clause : substr($clause, $lc + 3);
                $q = [];
                foreach ([$near, $clause] as $part) {
                    $q = preg_match_all("/「($MET_RE)」/u", $part, $x) ? array_values(array_unique($x[1])) : [];
                    if (!$q) $q = preg_match_all("/$MET_RE/u", $part, $x) ? array_values(array_unique($x[0])) : [];
                    if ($q) break;
                }
                if ($q) $mts = $q;
                elseif (mb_strpos($clause, '指標') === false && $lastMts !== null) $mts = $lastMts;
            }
            if (!$mts) { $sent = substr($text, $sb[$sIdx], ($sb[$sIdx + 1] ?? strlen($text)) - $sb[$sIdx]); $DEG_UNMATCHED[] = ['rel' => $rel, 'where' => $where, 'sent' => $sent, 'hit' => $c['text'], 'msg' => "$rel [$where] 「" . mb_strimwidth($sent, 0, 140, '…') . "」の「{$c['text']}」（対象の指標を特定できない）"]; $prevEnd = $c['end']; continue; }
            $lastMts = $mts;
            $label = mb_strimwidth($c['text'], 0, 60, '…');
            foreach ($mts as $mt) {
                $hs = high($selfF, $mt); $DEG_N++;
                $valOk = true; $valInfo = '';
                if ($c['vals'] !== null) foreach ($c['bases'] as $bf) { $bd = lvDist(sub($bf), $mt); $valOk = $valOk && near($c['vals']['v'], $bd[$c['vals']['lv']]); $valInfo .= " 比較相手{$c['vals']['lv']}=" . r1($bd[$c['vals']['lv']]); }
                if ($c['form'] === 'top') {
                    // 最上級：自身が4血液型の最高（最低）。「（X型と同率）」と書いた血液型は実際に同率（小数1桁で一致）であること。
                    // 同率を書いていない最上級（まとめの「最も低い水準になる」等）は、同率の相手がいても「最も」は成り立つので可とする
                    $all = []; foreach (BLOODS as $bt) $all[$bt] = high(['b' => $bt], $mt);
                    $up = $c['w'] === '高'; $ext = $up ? max($all) : min($all);
                    $eq = array_keys(array_filter($all, fn($v) => round($v, 1) == round($all[$self], 1)));
                    $ok = round($all[$self], 1) == round($ext, 1) && array_diff($c['ties'], $eq) === [];
                    if ($c['ties']) { $e2 = $eq; sort($e2); $exp = array_merge([$self], $c['ties']); sort($exp); $ok = $ok && $e2 === $exp; }
                    $others = $all; foreach ($eq as $e) unset($others[$e]); $gap = $others ? ($up ? $all[$self] - max($others) : min($others) - $all[$self]) : 0;
                    if ($c['deg'] === '突出して') $ok = $ok && $gap >= 20;
                    chk($rel, "degree:top@$where", $ok, "「{$label}」 {$mt} High " . implode('/', array_map(fn($k, $v) => "$k=" . r1($v), array_keys($all), $all)) . ' 書かれた同率=' . (implode('・', $c['ties']) ?: 'なし') . sprintf(' 2番目との差%.1f', $gap) . ($c['deg'] === '突出して' ? '（「突出して」＝20以上）' : ''), 'SEM', $text);
                    $dir = $up ? 1 : -1;
                } else {
                    $okAll = $valOk; $di = [];
                    foreach ($c['bases'] as $bf) { $d = $hs - high($bf, $mt); [$ok1, $why] = degreeJudge($c['deg'], $c['w'], $d); $okAll = $okAll && $ok1; $di[] = sprintf('差%+.1f', $d) . " $why"; }
                    chk($rel, "degree:{$c['form']}@$where", $okAll, "「{$label}」 {$mt} 自身High=" . r1($hs) . $valInfo . ($valOk ? '' : '（記事の数値と不一致）') . ' ' . implode(' ／ ', $di), 'SEM', $text);
                    $dir = in_array($c['w'], ['ほぼ同水準', '近い水準'], true) ? 0 : (preg_match('/^(?:高|上回|上が)/u', $c['w']) ? 1 : -1);
                }
                // 理由の主従
                if ($dir === 0) continue;
                $fprims = array_keys(formulaOf($mt)); $anaphora = false;
                if ($ctxMetric !== null) { $R = substr($text, $prevEnd, $c['start'] - $prevEnd); $whole = $text; $disp = $R . '【' . $c['text'] . '】'; }
                else {
                    // 注記以外：理由は比較の前（節の始まりから）を優先する。前に理由の形が無いときは、同じ文の前の比較の理由を引き継ぐ（「一方」で節が分かれていなければ）。
                    // それも無いときだけ、比較の後ろ（その文の残りと次の文。次の比較の手前まで）を見る。
                    // ただし次の文に別の結論（低め・高め・上回る等）があるか、次の文が別の指標を主語にしていれば（「惚れやすさは…で決まるため」）、それはその文の話なので使わない
                    $from = $clauseFrom($sIdx, $c['start']);
                    if ($inherit !== null && $inherit[0] !== $sIdx) $inherit = null;  // 文が変わった
                    $R = substr($text, $from, $c['start'] - $from); $whole = $R; $disp = $R . '【' . $c['text'] . '】';
                    $rpB = $reasonParse($R, $fprims);
                    if ($hasReason($rpB)) $inherit = [$sIdx, $R, $disp, false];
                    else {
                        // 比較の後ろ：同じ文の残り（次の比較の手前まで）→ 同じ文の前の比較の理由（「一方」をまたいでも引き継ぐ）→ 次の文 の順に探す
                        $next = $cmps[$ci + 1]['start'] ?? strlen($text); $sEnd = $sb[$sIdx + 1] ?? strlen($text);
                        $afterS = substr($text, $c['end'], max(0, min($sEnd, $next) - $c['end']));
                        if (preg_match('/一方(?:、|で、?)/u', $afterS, $y, PREG_OFFSET_CAPTURE)) $afterS = substr($afterS, 0, $y[0][1]);  // 「一方」の後ろは別の節
                        $rpA = $reasonParse($R . $afterS, $fprims);
                        if ($hasReason($rpA)) { $R .= $afterS; $whole = $R; $disp .= $afterS; }
                        elseif ($inherit !== null) { $R = $inherit[1]; $whole = $R; $disp = $inherit[2] . '…' . $disp; $anaphora = true; }  // 引き継いだ理由は前の比較のための理由も含むので、前置き（主因の照合だけ）として使う
                        elseif ($from > $sb[$sIdx] && $hasReason($reasonParse(substr($text, $sb[$sIdx], $from - $sb[$sIdx]), $fprims))) {
                            // 2026-10-07：「Jは誠実性に、Pは変化志向に寄与するため、…一方、変化志向が関わる惚れやすさでは下がります」のように、
                            // 「一方」の後ろに理由が無いときは、文の前半の理由を前置き（setup）として使う（主因が含まれるかだけを照合する）
                            $head = substr($text, $sb[$sIdx], $from - $sb[$sIdx]);
                            $R = $head . $R; $whole = $R; $disp = $head . '…' . $disp; $anaphora = true;
                        }
                        elseif ($sIdx > 0 && preg_match('/^(?:そのため|これにより|この(?:違い|入れ替わり|二重寄与|構造)(?:が|により|から|で))/u', substr($text, $sb[$sIdx]))) {
                            // 2026-10-07：文頭の「そのため」「この違いが」「この入れ替わりが」等は、前の文を理由として受ける（前の文を理由の範囲に加える）
                            $prevS = substr($text, $sb[$sIdx - 1], $sb[$sIdx] - $sb[$sIdx - 1]);
                            // 前の文は「違い」「構造」の説明（ENFP と ENTP の違い等）で、指標によっては逆向きの項も含むため、前置き（setup）として主因の照合だけに使う
                            $R = $prevS . $R; $whole = $R; $disp = $prevS . $disp; $anaphora = true; $inherit = [$sIdx, $R, $disp, true];
                        }
                        else {
                            // 2026-10-07（Reviewer MJ-1）：同じ文の後ろに別の比較があるときも、次の文は（後ろの比較と同じく）この比較の理由の範囲に入れる。
                            // 以前は理由の範囲が次の比較の手前で切れ、次の文（「これは…」）の理由が同じ文の最後の比較にしか付かなかった
                            // （infj の FAQ「INFPより高く、ENFJを大きく上回る…。これは…」で、INFP との比較の理由が照合されず、一覧にも出なかった）。
                            // 次の文の範囲は、次の文の中の最初の比較の手前まで（後ろの比較と同じ範囲）
                            $nextOut = strlen($text); foreach ($cmps as $c2) if ($c2['start'] >= $sEnd) { $nextOut = $c2['start']; break; }
                            $to = min($sb[$sIdx + 2] ?? strlen($text), $nextOut);
                            $nextSent = substr($text, $sEnd, max(0, $to - $sEnd));
                            $after = $next < $sEnd ? substr($text, $c['end'], max(0, $next - $c['end'])) : substr($text, $c['end'], max(0, $sEnd - $c['end']));
                            $otherTopic = preg_match("/^($MET_RE)(?:は|が|の)/u", $nextSent, $y) && $y[1] !== $mt;
                            // 次の文が「これは…」で始まるときは、前の文の結論の理由を述べる文なので、結論の語を含んでいても使う（「これはI（内向）とJ（判断）の両方が…構造によるものです（…さらに高い…）」）
                            if ((!preg_match('/低め|高め|低く|高く|低い|高い|上回|下回/u', $nextSent) || preg_match('/^これは/u', $nextSent)) && !$otherTopic) {
                                $after .= $nextSent;
                                if ($nextSent !== '') $nextSentUsed[$sIdx] = true;
                            } elseif ($next >= $sEnd) $after = '';  // 次の文を使わないときは、以前どおり何も足さない（同じ文の残りは上の $afterS で見ている）
                            $R .= $after; $whole = $R; $disp .= $after;
                        }
                    }
                }
                // 2026-10-07（m-3）：「AためXが、BためYが、それぞれ…」は、指標ごとにその指標の前の理由（A または B）だけを理由の範囲にする
                $R = $segmentFor($R, $mt, $mts);
                $rp = $reasonParse($R, $fprims);
                if ($anaphora && $rp['main'] === null && empty($rp['scoped'])) { $rp['setup'] = array_values(array_unique(array_merge($rp['setup'] ?? [], $rp['cited']))); $rp['cited'] = []; $rp['forms'][] = '前の文を受ける（前置き）'; }
                if (preg_match($MAIN5D_RE, $whole) && $rp['main'] === null) continue;  // 5d 節で照合（「主因」と書いた文は 5d が主因を判定しないので、ここで照合する）
                $dispS = mb_strimwidth(trim($disp), 0, 140, '…');
                if ($hasReason($rp)) {
                    $REASON_N++;
                    [$ok, $info] = $reasonJudge($rp, $mt, $selfF, $c['bases'], $dir);
                    // 末尾の「比較「…」」は、比較の語（degree 行の「…」と同じ）を省略せずに出したもの（degree 行と reason 行の対応を機械で確かめるため）
                    chk($rel, "reason@$where", $ok, "「{$dispS}」 {$mt} $info 比較「{$c['text']}」", 'SEM', $text);
                } elseif ($rp['mentioned'] !== []) $REASON_UNMATCHED[] = ['rel' => $rel, 'where' => $where, 'mt' => $mt, 'cmp' => $c['text'], 'msg' => "$rel [$where] 「{$dispS}」 {$mt}（理由の形を照合できない。出てくる式の項=" . implode('・', $rp['mentioned']) . '）'];
                else $silent[$sIdx][] = ['mt' => $mt, 'cmp' => $c['text'], 'disp' => $dispS];
            }
            $prevEnd = $c['end'];
        }
        // 2026-10-07（Reviewer MJ-1）：同じ文の後ろの比較が次の文の理由を使ったのに、前の比較に理由の形を当てられなかったもの（式の項も出てこない）は、
        // 黙って素通りさせず「照合できない理由」に出す
        foreach ($silent as $si => $list) if (isset($nextSentUsed[$si])) foreach ($list as $u)
            $REASON_UNMATCHED[] = ['rel' => $rel, 'where' => $where, 'mt' => $u['mt'], 'cmp' => $u['cmp'], 'msg' => "$rel [$where] 「{$u['disp']}」 {$u['mt']}（同じ文の後ろの比較には次の文の理由を当てたが、この比較には理由の形を当てられない）"];
    }
}

// ======================================================================
// 5f. 「照合できない」一覧の判断（2026-10-07、Reviewer 差し戻し 3）
//     5e の「照合できない程度の語」「照合できない理由」の各件について、記事の数値・式（inc）・スナップショットから事実を手作業で確かめ、
//     事実と合っていることを確認したうえで、検査では照合できない理由を (c) として登録する（事実と食い違っていた文は記事を直した）。
//     'kind' => 'deg'（程度の語）| 'reason'（理由）, 'rel' => 記事, 'where' => フィールド, 'needle' => 文（理由は表示文）の一部,
//     'hit' => 程度の語として拾った語（任意）, 'mt' => 指標（理由のみ）, 'why' => 照合できない理由と確かめた事実
// ======================================================================
$UNVERIFIABLE = [
    // ---- 程度の語：比較の対象が Style／Tendency の指標ではない（Bundle の集中度・Primitive の最大値・寄与の大小・Low の割合） ----
    ['kind' => 'deg', 'rel' => 'blood/b-love', 'where' => 'topBundle.note', 'hit' => '4血液型の中で最も低', 'needle' => '4血液型の中で最も低い集中度',
     'why' => 'Bundle の集中度（最多の組み合わせの割合）の比較で、指標の High 率ではない。スナップショットで確認：最多の組み合わせの割合 A 46.9%・B 17.2%・O 25.0%・AB 23.6%で、B型が最も低い'],
    ['kind' => 'deg', 'rel' => 'blood/b-love', 'where' => 'matome.4', 'hit' => '4血液型の中で最も低', 'needle' => '集中度は17.2%と4血液型の中で最も低く',
     'why' => '同上（Bundle の集中度。B型 17.2% が4血液型で最も低い）'],
    ['kind' => 'deg', 'rel' => 'seiza/gemini', 'where' => 'faq.0.a', 'hit' => 'より低く', 'needle' => '集中度が19%と、他の星座より低く',
     'why' => 'Bundle の集中度の比較で、指標の High 率ではない。スナップショットで確認：双子座 19.0% が12星座で最も低い（次は天秤座・射手座の 22.5%）'],
    ['kind' => 'deg', 'rel' => 'seiza/taurus', 'where' => 'topBundle.note', 'hit' => '牡羊座（最多の組み合わせで23.7%）より高い', 'needle' => '牡羊座（最多の組み合わせで23.7%）より高い集中度',
     'why' => 'Bundle の集中度の比較で、指標の High 率ではない。スナップショットで確認：牡牛座 35.0%、牡羊座 23.7%（記事の数値どおり）で牡牛座の方が高い'],
    ['kind' => 'deg', 'rel' => 'guide/bundle-guide', 'where' => 'body', 'hit' => 'より低い', 'needle' => '到達しうる最大値（5）',
     'why' => 'Primitive の到達しうる最大値の比較で、指標の High 率ではない。スナップショットで確認：最大値は自立性 5、行動主導性 10・誠実性 16・情動性 10・変化志向 8 で、自立性が最も低い'],
    ['kind' => 'deg', 'rel' => 'mbti/istj', 'where' => 'tendencies.浮気耐性.note', 'hit' => 'を大きく上回', 'needle' => '誠実性の三重寄与が行動主導性のマイナス分を大きく上回るため',
     'why' => '式の項（誠実性×0.7 と 行動主導性×0.3）の大きさの比較で、High 率の比較ではない（程度の表の対象外）。inc で確認：ISTJ は誠実性に I・S・J の3文字、行動主導性に T の1文字が寄与。結論の「Lowが実質的に消滅」はスナップショットで Low 0.0%'],
    ['kind' => 'deg', 'rel' => 'mbti/intp', 'where' => 'styles.恋愛の慎重さ.note', 'hit' => 'と比べてLowが29.3ポイント下が', 'needle' => 'ENTPと比べてLowが29.3ポイント下がり',
     'why' => 'Low の割合の差（ポイント数を明記）で、程度の語の比較ではない。スナップショットで確認：恋愛の慎重さの Low は INTP 50.0%・ENTP 79.3%（差 −29.3）、積極性の High は INTP 27.8%・ENTP 57.3%（差 −29.5）'],
    ['kind' => 'deg', 'rel' => 'mbti/infj', 'where' => 'attracts_body', 'hit' => 'を高い', 'needle' => '高い水準で両立できる',
     'why' => '比較の文ではない（「誠実さ」と「情熱」を「高い水準で」両立する、という性格の説明。数値の比較を含まない）'],
    ['kind' => 'deg', 'rel' => 'seiza/gemini', 'where' => 'styles.惚れやすさ.note', 'hit' => '近い水準', 'needle' => '全体平均にいちばん近い水準',
     'why' => '「他の指標と比べて全体平均にいちばん近い」は指標どうしの比較で、5e の形では照合できない。5節の個別の主張 (12)（seiza/gemini の惚れやすさの注記、required）で、双子座の他の全指標より全体平均との差の絶対値が小さいことを照合している'],
    // ---- 程度の語：MBTI との組み合わせ（部分集合）と MBTI 単独の比較 ----
    ['kind' => 'deg', 'rel' => 'blood/o-love', 'where' => 'mbti_intro', 'hit' => 'を大きく上回', 'needle' => 'MBTI単独の値（57.3%・51.7%）を大きく上回ります',
     'why' => '比較の主体が O型×MBTI（4タイプ）の部分集合で、5e の形（記事の主体そのものとの比較）では照合できない。スナップショットで確認：O型×ENTJ・ENTP・ENFJ・ENFP の積極性 High はいずれも 100%、MBTI 単独は ENTJ・ENTP 57.3%・ENFJ・ENFP 51.7%（差 +42.7・+48.3。「大きく」＝20 以上に合う）'],
    ['kind' => 'deg', 'rel' => 'seiza/leo', 'where' => 'mbti_intro', 'hit' => 'を上回', 'needle' => '積極性のHigh率は70.8%となり、単独の値（57.3%）を上回ります',
     'why' => '比較の主体が 獅子座×ENTJ・ENTP の部分集合。スナップショットで確認：獅子座×ENTJ・ENTP（96件）の積極性 High 70.8%、ENTJ・ENTP 単独 57.3%（差 +13.5。修飾なし＝10〜20 に合う）'],
    ['kind' => 'deg', 'rel' => 'seiza/leo', 'where' => 'matome.3', 'hit' => 'より高く', 'needle' => '行動主導性の高いMBTIタイプと組み合わさると単独の値より高く',
     'why' => '同上（獅子座×ENTJ・ENTP 70.8% と ENTJ・ENTP 単独 57.3%、差 +13.5。修飾なし＝10〜20 に合う）'],
    ['kind' => 'deg', 'rel' => 'seiza/scorpio', 'where' => 'mbti_intro', 'hit' => 'をやや上回', 'needle' => '62.5%で、単独の値（57.3%）をやや上回る程度',
     'why' => '比較の主体が 蠍座×ENTJ・ENTP の部分集合。スナップショットで確認：蠍座×ENTJ・ENTP（96件）の積極性 High 62.5%、ENTJ・ENTP 単独 57.3%（差 +5.2。「やや」＝10 未満に合う）'],
    // ---- 程度の語：Primitive への寄与・Bundle の集中度・Bundle の主軸別の比較（指標の High 率の比較ではない） ----
    // 2026-10-07（Reviewer MJ-3）：蟹座・魚座・蠍座の「積極性・愛情表現が(星座)より穏やか」は、程度の表に無い語を使わない方針で表の語に直した（5e で照合する）ため登録を削除した。
    // 蟹座の topBundle の「穏やか」は High 率の比較ではなく Primitive への寄与の強さの比較なので、表の対象外として残す
    ['kind' => 'deg', 'rel' => 'seiza/cancer', 'where' => 'topBundle.note', 'hit' => 'より穏やか', 'needle' => '行動主導性への寄与が牡羊座より穏やか',
     'why' => '指標ではなく Primitive への寄与の比較。inc で確認：牡羊座は火（行動力）と活動宮の両方から行動主導性に寄与し、蟹座は活動宮だけ（スナップショットの行動主導性の平均でも蟹座の方が低い）'],
    ['kind' => 'deg', 'rel' => 'seiza/aquarius', 'where' => 'topBundle.note', 'hit' => '低め', 'needle' => '射手座（22.5%）に次いで集中度は低めです',
     'why' => 'Bundle の集中度（最多の組み合わせの割合）の比較で、指標の High 率ではない（2026-10-07、比較相手の語の無い「高め／低め」を拾うようにして一覧に出た）。スナップショットで確認：水瓶座 23.3%、双子座 19.0%・天秤座 22.5%・射手座 22.5% に次いで12星座で4番目に低い（他の8星座は 23.7〜35.0%）'],
    ['kind' => 'deg', 'rel' => 'style/shittobukasa-love', 'where' => 'bundle_body', 'hit' => '低め', 'needle' => '独占欲も15.2%と低めにとどまります',
     'why' => '比較の主体が Bundle の主軸が誠実性のケース（4640件）で、5e の bundle の形（「(指標2)（v%）より」等）に当てはまらない（2026-10-07、比較相手の語の無い「高め／低め」を拾うようにして一覧に出た）。スナップショットで確認：誠実性主軸の独占欲 High 15.2%、全体平均 31.1%（差 −15.9。修飾なし＝10〜20 の「低め」に合う）。同じ文の積極性 5.5%・愛情表現 9.2%・惚れやすさ 8.3%（1桁台）、嫉妬深さ 0%（0/4640）も記事どおり'],
    ['kind' => 'deg', 'rel' => 'bundle/sensitivity-type', 'where' => 'causal_explanation', 'hit' => 'やや低く', 'needle' => '情動性型の該当率はやや低くなる傾向があります',
     'why' => 'Bundle の型（主軸）の該当率を火の星座と水の星座で比べた文で、指標の High 率ではない（2026-10-07、比較相手の語の無い「やや高く／低く」を拾うようにして一覧に出た）。スナップショットで確認：主軸が情動性の割合は 火（牡羊座・獅子座・射手座）平均 35.7%、水（蟹座・蠍座・魚座）平均 40.6%（差 −4.9）、主軸が行動主導性の割合は 火 23.7%、水 14.3%（差 +9.5）で、どちらも差 10 未満（「やや」に合う）'],
    ['kind' => 'deg', 'rel' => 'bundle/sensitivity-type', 'where' => 'styleLinks.4.desc', 'hit' => 'やや高い', 'needle' => '情動性型ではHigh率55.8%とやや高い傾向',
     'why' => '関連記事一覧の説明文で、比較相手を書かずに High 率の水準を述べる形（同じ一覧の「86.6%と非常に高い傾向」「81.5%と高い傾向」と同じ書き方）。5e の程度の語（比較相手との差）としては照合できない。スナップショットで確認：主軸が情動性のケース（2460件）の積極性 High 55.8%（記事どおり）、全体平均 28.9%（差 +26.9）。比較の文として読むと「やや」（10 未満）には合わないため、言い回しは Manager の判断待ち（2026-10-07 の報告に記載）'],
    ['kind' => 'deg', 'rel' => 'seiza/pisces', 'where' => 'mbti_intro', 'hit' => 'よりやや低い', 'needle' => '魚座はそれよりやや低い水準です',
     'why' => '比較の主体が 魚座×ENTJ・ENTP、比較相手が 射手座×ENTJ・ENTP の部分集合どうしで、5e の形（記事の主体そのものとの比較）では照合できない（2026-10-07、「上乗せは穏やか」を表の語に直した文）。スナップショットで確認：魚座×ENTJ・ENTP（96件）の積極性 High 62.5%、射手座×ENTJ・ENTP（96件）70.8%（差 −8.3。「やや」＝10 未満に合う）'],
    // ---- 理由：理由を書いていない（「誠実性が絡む指標」は指標の分類で、理由の語ではない） ----
    ['kind' => 'reason', 'rel' => 'mbti/enfj', 'where' => 'matome.1', 'mt' => '包容力', 'needle' => '誠実性が絡む指標',
     'why' => '「誠実性が絡む指標（…）でHighの割合が上がる」は指標の分類で、理由の形を書いていない。程度は 5e で照合済み（ENFP 比 +15.8）。寄与差で確認：ENFJ−ENFP の差は誠実性（J）だけ（情動性 0）'],
    ['kind' => 'reason', 'rel' => 'mbti/enfj', 'where' => 'matome.1', 'mt' => '恋愛の慎重さ', 'needle' => '誠実性が絡む指標',
     'why' => '同上。ENFP 比 +12.8、差は誠実性だけ（自立性 0）'],
    ['kind' => 'reason', 'rel' => 'mbti/enfj', 'where' => 'matome.1', 'mt' => '結婚志向', 'needle' => '誠実性が絡む指標',
     'why' => '同上。ENFP 比 +18.2、主因は誠実性（+1.40）、変化志向が無い分（+0.60）も同じ向き'],
    ['kind' => 'reason', 'rel' => 'mbti/enfj', 'where' => 'matome.1', 'mt' => '浮気耐性', 'needle' => '誠実性が絡む指標',
     'why' => '同上。ENFP 比 +13.2、差は誠実性だけ（行動主導性 0）'],
    ['kind' => 'reason', 'rel' => 'mbti/entj', 'where' => 'matome.1', 'mt' => '包容力', 'needle' => '誠実性が絡む指標',
     'why' => '「誠実性が絡む指標（…）でHighの割合が上がる」は指標の分類で、理由の形を書いていない。程度は 5e で照合済み。寄与差で確認：ENTJ−ENTP の差は誠実性（J）だけ（情動性 0）'],
    ['kind' => 'reason', 'rel' => 'mbti/entj', 'where' => 'matome.1', 'mt' => '恋愛の慎重さ', 'needle' => '誠実性が絡む指標',
     'why' => '同上。差は誠実性だけ（自立性 0）'],
    ['kind' => 'reason', 'rel' => 'mbti/entj', 'where' => 'matome.1', 'mt' => '結婚志向', 'needle' => '誠実性が絡む指標',
     'why' => '同上。主因は誠実性（+1.40）、変化志向が無い分（+0.60）も同じ向き'],
    ['kind' => 'reason', 'rel' => 'mbti/entj', 'where' => 'matome.1', 'mt' => '浮気耐性', 'needle' => '誠実性が絡む指標',
     'why' => '同上。差は誠実性だけ（行動主導性 0）'],
    ['kind' => 'reason', 'rel' => 'mbti/infj', 'where' => 'styles.嫉妬深さ.note', 'mt' => '嫉妬深さ', 'needle' => '情動性の係数の方が大きいため打ち消し合いきらず',
     'why' => '前半の理由（情動性の係数の方が大きい）は INFJ 自身の最頻区分（High 43.1%）の説明で、括弧内の比較（INFP より低く、ENFP より大きく低い）の理由としては書いていない。比較の程度は 5e で照合済み（INFP 比 −16.0、ENFP 比 −29.2）。寄与差で確認：差の主因はどちらも誠実性（INFP とは J、ENFP とは I・J）、情動性の差は 0'],
];

// 「照合できない」一覧の各件に、事実を手作業で確かめた結果（(c) 事実と合っているが検査では照合できない理由）を対応づける。
// 対応づけは記事・フィールド・文の一部（'needle'）・拾った語（'hit'、程度の語のみ）・指標（理由のみ）で行う。文を書き換えると対応が外れ「未判断」になるので、そのときは事実を確かめ直して登録し直す。
// 2026-10-07（Reviewer MJ-4）：
//   (a) 未判断が1件でもあれば FAIL（kind 'UNJUDGED'）にして総合結果を FAIL にする（以前は件数を表示するだけで、表に無い語・比較相手を集合にした書き換えなどが
//       「照合できない」一覧に逃げ込むと、どの検査でも FAIL にならず、required の主張の MISSING だけで検出されていた）。
//   (b) 程度の語の登録は 'hit'（一覧の「拾った語」と完全一致）を必須にし、1つの登録が対応するのは一覧の1件だけにする（最初に対応した件で使い切る）。
//       以前は 'hit' が任意で、同じ文（'needle' を含む文）に新しく入れた別の語（「より穏やかに高く」等）も既存の登録に吸収されて (c) と表示されていた。
//       理由の登録も同じく1件だけに対応させる。'hit' の無い程度の語の登録は、それ自体を FAIL（kind 'UNJUDGED'）にする
$UNV_UNJUDGED = 0; $UNV_USED = [];
foreach ($UNVERIFIABLE as $n) if ($n['kind'] === 'deg' && !isset($n['hit'])) chk($n['rel'], "unverifiable:noHit@{$n['where']}", false, "5f の程度の語の登録に 'hit'（照合する語そのもの）が無い: 「{$n['needle']}」", 'UNJUDGED');
$unvMatch = function (string $kind, array $u) use (&$UNV_USED, $UNVERIFIABLE): ?array {
    foreach ($UNVERIFIABLE as $i => $n) {
        if (isset($UNV_USED[$i]) || $n['kind'] !== $kind || $n['rel'] !== $u['rel'] || $n['where'] !== $u['where']) continue;
        if ($kind === 'deg' && (!isset($n['hit']) || $n['hit'] !== $u['hit'] || mb_strpos($u['sent'], $n['needle']) === false)) continue;
        if ($kind === 'reason' && ($n['mt'] !== $u['mt'] || mb_strpos($u['msg'], $n['needle']) === false)) continue;
        $UNV_USED[$i] = true;
        return $n;
    }
    return null;
};
foreach (['deg' => 'DEG_UNMATCHED', 'reason' => 'REASON_UNMATCHED'] as $kind => $var) foreach ($$var as $k => $u) {
    $n = $unvMatch($kind, $u);
    if ($n !== null) { $$var[$k]['note'] = "      (c) {$n['why']}"; continue; }
    $UNV_UNJUDGED++;
    $$var[$k]['note'] = '      【未判断】事実を確かめて $UNVERIFIABLE に (c) の理由を登録するか、記事を直す';
    chk($u['rel'], "unjudged:{$kind}@{$u['where']}", false, '「照合できない' . ($kind === 'deg' ? '程度の語' : '理由') . '」に (c) の理由が未登録（未判断）: ' . mb_strimwidth($u['msg'], 0, 200, '…'), 'UNJUDGED');
}
$UNV_UNUSED = array_values(array_diff_key($UNVERIFIABLE, $UNV_USED));

// ======================================================================
// 7. 出力
// ======================================================================
$cnt = ['PASS' => 0, 'FAIL' => 0, 'KNOWN' => 0];
foreach ($RESULTS as $r) $cnt[$r[0]]++;
echo "=== Love Article Facts ===\n";
echo "記事ルート: $artDir\n";
echo "スナップショット: tests/cases/love-final-snapshot.php（generatedAt {$SNAP_AT}、{$N_ALL}件）\n";
echo "照合した記事: " . count($ARTICLES_CHECKED) . " / " . count($loaded) . "本　照合した主張: " . count($RESULTS) . "件（PASS {$cnt['PASS']} / FAIL {$cnt['FAIL']} / KNOWN {$cnt['KNOWN']}）\n";
$byCat = [];
foreach ($RESULTS as $r) { $cat = explode('/', $r[1])[0]; $byCat[$cat]['arts'][$r[1]] = true; $byCat[$cat]['n'] = ($byCat[$cat]['n'] ?? 0) + 1; }
foreach ($byCat as $cat => $v) printf("  %-11s %s%3d本 主張%5d件\n", $cat, $cat === 'template' ? 'テンプレート' : '記事', count($v['arts']), $v['n']);
$unchecked = array_diff(array_keys($loaded), array_keys($ARTICLES_CHECKED));
if ($unchecked) echo "照合対象の主張が無かった記事: " . implode(', ', $unchecked) . "\n";
if ($verbose) foreach ($RESULTS as $r) if ($r[0] === 'PASS') echo "[PASS] {$r[1]} {$r[2]} {$r[3]}\n";
foreach ($RESULTS as $r) if ($r[0] === 'KNOWN') echo "[KNOWN] {$r[1]} {$r[2]} {$r[3]}\n        理由: " . $KNOWN["{$r[1]}|{$r[2]}"]['reason'] . "\n";
if ($FAILS) {
    echo "\n--- FAIL 一覧（kind: SEM=誤りの意味検査で検出 / FACT・CLAIM=数値の不一致 / MISSING=修正後の主張が本文に無い） ---\n";
    foreach ($FAILS as $r) echo "[FAIL:{$r[4]}] {$r[1]} {$r[2]} {$r[3]}\n";
}
echo "\n重み関係の主張（5b、式の係数と照合）: {$WEIGHT_N}件を照合\n";
if ($WEIGHT_UNRESOLVED) { echo "照合できなかった重み主張（対象指標を特定できない。FAILには数えない）: " . count($WEIGHT_UNRESOLVED) . "件\n"; foreach ($WEIGHT_UNRESOLVED as $u) echo "  - $u\n"; }
if ($WEIGHT_UNMATCHED) { echo "重み関係の語を含むが 5b の言い回しに当てはまらない文（照合していない。目視で確認）: " . count($WEIGHT_UNMATCHED) . "件\n"; foreach ($WEIGHT_UNMATCHED as $u) echo "  - $u\n"; }
echo "「同じ数値になる理由」の主張（5c、寄与の違うPrimitiveと式・分布を照合）: {$SAME_REASON_N}件を照合\n";
if ($SAME_REASON_UNRESOLVED) { echo "照合できなかった「同じ数値になる理由」（対象指標を特定できない。FAILには数えない）: " . count($SAME_REASON_UNRESOLVED) . "件\n"; foreach ($SAME_REASON_UNRESOLVED as $u) echo "  - $u\n"; }
echo "「主軸を理由にした文」（5d、寄与差の分解で結論との因果を照合）: " . array_sum($MAIN_REASON_N) . "件（成立 {$MAIN_REASON_N['成立']} / 個別の主張で照合 {$MAIN_REASON_N['個別の主張で照合']} / 要判断 {$MAIN_REASON_N['要判断']} / 誤り {$MAIN_REASON_N['誤り']}。要判断・誤りは FAIL）\n";
echo "程度の語（5e、比較相手との High 率の差・向き・書かれた数値を照合）: {$DEG_N}件を照合　理由の主従（5e、寄与差の分解で主因・向きを照合）: {$REASON_N}件を照合\n";
echo "照合できない程度の語（比較相手・対象の指標を特定できない。(c) の理由が登録済みなら FAIL に数えない）: " . count($DEG_UNMATCHED) . "件\n"; foreach ($DEG_UNMATCHED as $u) echo "  - {$u['msg']}\n" . $u['note'] . "\n";
echo "照合できない理由（理由の範囲に式の項が出てくるが、拾える形が無い等。(c) の理由が登録済みなら FAIL に数えない）: " . count($REASON_UNMATCHED) . "件\n"; foreach ($REASON_UNMATCHED as $u) echo "  - {$u['msg']}\n" . $u['note'] . "\n";
echo "「照合できない」のうち (c) の理由が未登録（未判断）: {$UNV_UNJUDGED}件（1件でもあれば FAIL:UNJUDGED として総合結果を FAIL にする）\n";
if ($UNV_UNUSED) { echo "どの一覧の件にも対応しなかった 5f の登録（文を直した後の残り。削除するか登録し直す）: " . count($UNV_UNUSED) . "件\n"; foreach ($UNV_UNUSED as $n) echo "  - {$n['kind']} {$n['rel']} [{$n['where']}] 「{$n['needle']}」" . (isset($n['hit']) ? "の「{$n['hit']}」" : '') . "\n"; }
echo "5e の対象外: mbti-blood " . count($DEG_SKIPPED_CAT) . "本（4-6 節と不変条件テスト love-combo-invariants.php で照合）\n";
echo "\n照合できない主張の種類（網羅外。目視・差分レポートで確認する）:\n";
echo "  - 心理的・解釈的な説明文（「〜な傾向があります」「慎重に見極めるタイプ」等）と相性（compat）の記述\n";
echo "  - 指標名を特定できない自由文中の比較（例：「ENTJより高い傾向」「突出した指標が少ない」「Low寄り」）\n";
echo "  - 「Highが目立つ」等の相対表現（INFP記事のまとめのみ個別に照合）\n";
echo "  - Style/Tendency記事のnormalizer（P33/P67）、guide記事の本文中の概念説明\n";
echo "  - docs/love/*.md（記事ではないため対象外）\n";
echo "  - 重み関係の文のうち、対象の指標を文から特定できないもの・5b の言い回しに当てはまらないもの（上の2つの一覧）\n";
echo "  - 程度の語・理由の主従（5e）のうち、程度の語も比較相手の語も無い比較（「〜より強い」「〜の方が多い」「非常に高い」等、表に無い語・水準だけを述べる語）。\n";
echo "    比較相手の語の無い「高め／低め」「やや／大きく／わずかに＋高い／低い」、数値・水準に付く「穏やか／控えめ」は「照合できない程度の語」に出る（未判断なら FAIL）。\n";
echo "    理由の範囲が2文以上前にある文、理由の形（\$REASON_FORMS）に当てはまらない言い回しは照合しない（tests/README.md「5e 節」の網羅できない形）\n";
echo "\n総合結果: " . ($FAILS ? count($FAILS) . " FAILURE(S)" : 'ALL PASS') . "\n";
exit($FAILS ? 1 : 0);
