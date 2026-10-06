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
 *
 * 新しい数値主張を記事に足したら、$RULES で拾えない文は $CLAIMS に1行追加すること
 * （DEVELOPMENT_RULES.md「記事の事実検証ルール」）。
 *
 * 実行方法:
 *   php tests/tools/love-article-facts.php                         （既定: test.life-fun.net）
 *   php tests/tools/love-article-facts.php --root=<リポジトリのルート>     （本番用ツリー）
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
/** 「全体平均（X%）を上回る／より低め」等 */
function checkOverallAvg(string $art, string $where, string $text, string $metric, array $f): void {
    if (!preg_match_all('/全体平均（([\d.]+)%）(を(?:大きく)?上回|より(?:大きく|やや)?(?:低|高)|を(?:大きく)?下回)/u', $text, $mm, PREG_SET_ORDER)) return;
    $ov = high([], $metric); $self = high($f, $metric);
    foreach ($mm as $m) {
        $up = (bool)preg_match('/上回|高/u', $m[2]);
        $ok = near($m[1], $ov) && ($up ? $self > $ov : $self < $ov);
        chk($art, "overallAvg:$where", $ok, "$metric 全体平均 記事={$m[1]} 実測=" . r1($ov) . " 自身High=" . r1($self) . " 方向=" . ($up ? '上' : '下'));
    }
}
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
$RULES[] = ['scope' => 'seiza/*', 'desc' => 'Style/Tendency分布・topBundle・MBTI別ランキング（星座内）・注記の全体平均/同一値/理由づけ・本文の指標値', 'fn' => function (string $art, array $a) {
    global $SIGN_RE;
    $si = signIndex($a['name']); $f = ['s' => $si];
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) {
        checkDistArray($art, "$g.$metric", $arr, $f, $metric);
        $note = $arr['note'] ?? ''; if ($note === '') continue;
        checkOverallAvg($art, "$g.$metric", $note, $metric, $f);
        checkNoteMentionsFormula($art, "$g.$metric", $note, $metric);
        checkSameAs($art, "$g.$metric", $note, $metric, $f, 's', $SIGN_RE);
    }
    checkTopBundle($art, $a['topBundle'], $f);
    checkRanking($art, 'mbtiRanking', $a['mbtiRanking'], $a['mbti_intro'], fn($t, $metric) => high(['s' => $si, 'm' => $t], $metric));
    foreach (leaves(['faq' => $a['faq'], 'matome' => $a['matome']]) as $w => $t) { checkMetricParen($art, $w, $t, $f); checkOverallAvgFree($art, $w, $t, $f); }
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
/** 本文の「全体平均（X%）」：直前に出てくる指標名を対象にする */
function checkOverallAvgFree(string $art, string $where, string $text, array $f): void {
    global $MET_RE;
    foreach (sentences($text) as $s) {
        if (!preg_match("/($MET_RE)/u", $s, $m)) continue;
        if (mb_strpos($s, '全体平均') === false) continue;
        if (preg_match_all("/($MET_RE)/u", $s, $all) && count(array_unique($all[1])) > 1) continue; // 指標が複数ある文は対象外
        checkOverallAvg($art, $where, $s, $m[1], $f);
    }
}

// ---- 4-3. 血液型記事（blood/*：血液型単体2304件） ----
$RULES[] = ['scope' => 'blood/*', 'desc' => 'Style/Tendency分布・4血液型の比較表・MBTI別ランキング（血液型内）・topBundle・注記の全体平均', 'fn' => function (string $art, array $a) {
    $B = $a['code']; $f = ['b' => $B];
    foreach (['styles', 'tendencies'] as $g) foreach ($a[$g] as $metric => $arr) {
        checkDistArray($art, "$g.$metric", $arr, $f, $metric);
        $note = $arr['note'] ?? ''; if ($note === '') continue;
        checkOverallAvg($art, "$g.$metric", $note, $metric, $f);
        checkNoteMentionsFormula($art, "$g.$metric", $note, $metric);
    }
    foreach ($a['compareTable'] as $row) foreach (BLOODS as $bt) {
        $v = high(['b' => $bt], $row['metric']);
        chk($art, "compareTable.{$row['metric']}.$bt", near($row[$bt], $v), "記事={$row[$bt]} 実測=" . r1($v));
    }
    checkTopBundle($art, $a['topBundle'], $f);
    checkRanking($art, 'mbtiRanking', $a['mbtiRanking'], $a['mbti_intro'], fn($t, $metric) => high(['b' => $B, 'm' => $t], $metric));
    foreach (leaves(['faq' => $a['faq'], 'matome' => $a['matome']]) as $w => $t) { checkMetricParen($art, $w, $t, $f); checkOverallAvgFree($art, $w, $t, $f); }
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
$sectionQuoteExpect = function (string $quoted) use ($screenSections): array {
    preg_match_all('/「([^」]+)」/u', $quoted, $q); $bad = array_values(array_diff($q[1], $screenSections()));
    return [$q[1] !== [] && $bad === [], $bad ? 'love.php の結果の見出しに無い: ' . implode('・', $bad) : '見出し=' . implode('・', $q[1])];
};
/** 式の Primitive 集合（昇順） */
$fset = function (string $mt): array { $k = array_keys(formulaOf($mt)); sort($k); return $k; };
/** 血液型ごとの Primitive への寄与（inc/blood-trait-mapping.php）：Primitive => 合計スコア */
$bloodContrib = function (string $bt): array { $o = []; foreach (BLOOD_TRAIT_MAPPING[$bt] as $r) { $p = primOfTrait($r['trait']); $o[$p] = ($o[$p] ?? 0) + $r['score']; } ksort($o); return $o; };
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
    ['art' => 'seiza/virgo', 'where' => 'tendencies.結婚志向.note', 'required' => true, 're' => '/^誠実性×0\.7－変化志向×0\.3で決まる指標です。地由来の誠実性がプラスに働くため、柔軟宮由来の変化志向（計算式ではマイナス）があっても全体平均（([\d.]+)%）を上回ります/u',
     'expect' => function ($m) { $fo = formulaOf('結婚志向'); $si = signIndex('乙女座');
        return [abs(($fo['誠実性'] ?? 0) - 0.7) < 1e-9 && abs(($fo['変化志向'] ?? 0) + 0.3) < 1e-9 && count($fo) === 2 && SEIZA_SIGNS[$si]['element'] === 1 && SEIZA_SIGNS[$si]['quality'] === 2 && near($m[1], high([], '結婚志向')) && high(['s' => $si], '結婚志向') > high([], '結婚志向'), '乙女座=' . r1(high(['s' => $si], '結婚志向')) . ' 全体=' . r1(high([], '結婚志向'))]; }],
    ['art' => 'seiza/virgo', 'where' => 'faq', 'required' => true, 're' => '/恋愛の慎重さは完全に同じ数値になります。.*行動主導性がマイナスに働く浮気耐性では乙女座の方が高く（High([\d.]+)%・山羊座([\d.]+)%）、プラスに働く積極性（山羊座([\d.]+)%・乙女座([\d.]+)%）・愛情表現（山羊座([\d.]+)%・乙女座([\d.]+)%）では山羊座の方が高くなります/u',
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
    ['art' => 'blood/*', 'where' => '*', 'required' => false, 're' => '/情動性が主軸(?:に(?:なる)?|の)指標（((?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性)(?:・(?:積極性|愛情表現|包容力|独占欲|惚れやすさ|嫉妬深さ|恋愛の慎重さ|結婚志向|浮気耐性))*)）/u',
     'expect' => function ($m) { $bad = array_values(array_filter(explode('・', $m[1]), fn($mt) => dominantPrim($mt) !== '情動性')); return [$bad === [], $bad ? '情動性が最大の重みでない: ' . implode(' ', array_map('formulaStr', $bad)) : '']; }],
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
    ['art' => 'guide/kekka-no-mikata', 'where' => 'body', 'required' => true, 're' => '/診断結果の画面に表示されるのは、入力した組み合わせ（MBTI・血液型・星座）、恋愛タイプ（Bundle）にもとづく解説文、((?:「[^」]+」)+)の各項目（表示名・一行の説明・解説文）、関連記事へのリンクです/u',
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
];

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
                [$ok, $detail] = ($cl['expect'])($m, $rel, $a);  // 記事のパス・配列も渡す（使わない expect は無視する）
                $label = mb_strimwidth($m[0], 0, 90, '…');
                chk($rel, isset($cl['rule']) ? "{$cl['rule']}@$w" : "claim#$i", $ok, "[$w] 「{$label}」" . ($detail !== '' ? " → $detail" : ''), $cl['required'] ? 'CLAIM' : 'SEM', $t);
            }
        }
    }
    if ($cl['required'] && !$found) chk($cl['art'], "claim#$i", false, "[{$cl['where']}] 修正後の主張が本文に見つからない: " . mb_strimwidth($cl['re'], 0, 110, '…'), 'MISSING');
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
foreach ($byCat as $cat => $v) printf("  %-11s 記事%3d本 主張%5d件\n", $cat, count($v['arts']), $v['n']);
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
echo "\n照合できない主張の種類（網羅外。目視・差分レポートで確認する）:\n";
echo "  - 心理的・解釈的な説明文（「〜な傾向があります」「慎重に見極めるタイプ」等）と相性（compat）の記述\n";
echo "  - 指標名を特定できない自由文中の比較（例：「ENTJより高い傾向」「突出した指標が少ない」「Low寄り」）\n";
echo "  - 「Highが目立つ」等の相対表現（INFP記事のまとめのみ個別に照合）\n";
echo "  - Style/Tendency記事のnormalizer（P33/P67）、guide記事の本文中の概念説明\n";
echo "  - docs/love/*.md（記事ではないため対象外）\n";
echo "  - 重み関係の文のうち、対象の指標を文から特定できないもの・5b の言い回しに当てはまらないもの（上の2つの一覧）\n";
echo "\n総合結果: " . ($FAILS ? count($FAILS) . " FAILURE(S)" : 'ALL PASS') . "\n";
exit($FAILS ? 1 : 0);
