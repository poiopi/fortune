<?php
declare(strict_types=1);

/**
 * love-level6-consistency.php
 *
 * 恋愛傾向診断のNormalizer 6段階（L1〜L6。結果画面の文章と並び順に使う区分）が、
 * 3段階（Low/Mid/High。記事・事実照合の基準）と矛盾しないことを検査する
 * （docs/love/08-normalizer.md「6段階」）。
 *
 * チェック内容:
 *   (a) 6段階のp33・p67が、3段階の定数（NORMALIZE_STYLE_THRESHOLDS等）と同じ値
 *   (b) 各項目の5つの境目（p17<p33<p50<p67<p83）が狭義に増えている
 *   (c) 境目が、9216件の値から同じ方法（線形補間の百分位、位置＝(n−1)×k/6、小数第2位に丸め）で
 *       計算し直した値と一致する
 *   (d) STGのincで、final スナップショットのprimitivesからStyle・Tendencyを計算し直し、
 *       9216件×9項目すべてで love_level6To3(6段階) == 3段階
 *   (e) スナップショットのstylesLevel6・tendenciesLevel6が計算し直した値と一致し、
 *       2つずつまとめるとstylesNormalized・tendenciesNormalizedと一致する
 *   (f) 各項目で6段階すべてに1件以上入る（各段階の割合を表示する）
 *   (g) 文言バンク（inc/love-style-texts.php・inc/love-tendency-texts.php）に9項目×L1〜L6がそろい、空でない
 *   (h) LOVE_ITEM_LABELS（inc/love-display-labels.php）のキーが9項目と一致する
 *
 * 実行方法: php tests/tools/love-level6-consistency.php
 */

// final スナップショット（9216件・約20MB）の読み込みにデフォルトの128MBでは足りない
ini_set('memory_limit', '2G');

$inc = __DIR__ . '/../../test.life-fun.net/inc';
require_once $inc . '/love-primitive-mapping.php';
require_once $inc . '/love-style.php';
require_once $inc . '/love-tendency.php';
require_once $inc . '/love-normalizer.php';
require_once $inc . '/love-style-texts.php';
require_once $inc . '/love-tendency-texts.php';
require_once $inc . '/love-display-labels.php';

$fail = 0;
$log = [];

function check(string $label, bool $ok, string $detail = ''): void {
    global $fail, $log;
    if (!$ok) $fail++;
    $log[] = sprintf("[%s] %s%s", $ok ? 'PASS' : 'FAIL', $label, $detail !== '' ? " — {$detail}" : '');
}

/** 先頭数件と残り件数だけを示す */
function firstFew(array $errs): string {
    return $errs ? ($errs[0] . (count($errs) > 1 ? ' (+' . (count($errs) - 1) . ' more)' : '')) : '';
}

$styleNames = array_keys(LOVE_STYLE_MAPPING);
$tendencyNames = array_keys(LOVE_TENDENCY_MAPPING);
$items = array_merge($styleNames, $tendencyNames);
$thresholds6 = NORMALIZE_STYLE_THRESHOLDS6 + NORMALIZE_TENDENCY_THRESHOLDS6;
$thresholds3 = NORMALIZE_STYLE_THRESHOLDS + NORMALIZE_TENDENCY_THRESHOLDS;
$bounds = ['p17', 'p33', 'p50', 'p67', 'p83'];

check('9項目（Style7＋Tendency2）', count($items) === 9 && count(array_unique($items)) === 9, implode('・', $items));
check('6段階の境目の定義が9項目と一致', array_keys(NORMALIZE_STYLE_THRESHOLDS6) === $styleNames && array_keys(NORMALIZE_TENDENCY_THRESHOLDS6) === $tendencyNames);

// ---- (a) p33・p67が3段階と同じ ----
$errs = [];
foreach ($items as $name) {
    foreach (['p33', 'p67'] as $p) {
        if (!isset($thresholds6[$name][$p], $thresholds3[$name][$p]) || $thresholds6[$name][$p] !== $thresholds3[$name][$p]) {
            $errs[] = "{$name}.{$p} 6段階=" . var_export($thresholds6[$name][$p] ?? null, true) . ' 3段階=' . var_export($thresholds3[$name][$p] ?? null, true);
        }
    }
}
check('(a) 6段階のp33・p67が3段階の定数と同じ', $errs === [], firstFew($errs));

// ---- (b) 境目が狭義に増加 ----
$errs = [];
foreach ($items as $name) {
    if (array_keys($thresholds6[$name]) !== $bounds) { $errs[] = "{$name}: キーが" . implode(',', array_keys($thresholds6[$name])); continue; }
    for ($i = 1; $i < count($bounds); $i++) {
        if (!($thresholds6[$name][$bounds[$i - 1]] < $thresholds6[$name][$bounds[$i]])) {
            $errs[] = "{$name}: {$bounds[$i - 1]}={$thresholds6[$name][$bounds[$i - 1]]} >= {$bounds[$i]}={$thresholds6[$name][$bounds[$i]]}";
        }
    }
}
check('(b) 各項目の5つの境目が狭義に増加', $errs === [], firstFew($errs));

// ---- final スナップショットの読み込みと再計算 ----
$snapshot = require __DIR__ . '/../cases/love-final-snapshot.php';
$cases = $snapshot['cases'];
check('final スナップショットが9216件', count($cases) === 9216, 'actual=' . count($cases));

$values = [];      // 項目名 => 9216件の値（round(,6)）
$level6Calc = [];  // 件番号 => [項目名 => L1〜L6]
$level3Calc = [];  // 件番号 => [項目名 => Low/Mid/High]
foreach ($cases as $i => $c) {
    $p = $c['expected']['primitives'];
    $styles = love_computeStyles($p);
    $tendencies = love_computeTendencies($p);
    foreach ($styles + $tendencies as $name => $v) $values[$name][] = round((float)$v, 6);
    $level6Calc[$i] = love_normalizeStyles6($styles) + love_normalizeTendencies6($tendencies);
    $level3Calc[$i] = love_normalizeStyles($styles) + love_normalizeTendencies($tendencies);
}

// ---- (c) 境目を計算し直して一致 ----
/** 線形補間の百分位（位置＝(n−1)×q）。3段階の閾値と同じ方法 */
function percentileLinear(array $sorted, float $q): float {
    $n = count($sorted);
    $pos = ($n - 1) * $q;
    $lo = (int)floor($pos);
    $frac = $pos - $lo;
    if ($lo + 1 >= $n) return (float)$sorted[$lo];
    return $sorted[$lo] + $frac * ($sorted[$lo + 1] - $sorted[$lo]);
}
$errs = [];
foreach ($items as $name) {
    $sorted = $values[$name] ?? [];
    sort($sorted);
    if (count($sorted) !== 9216) { $errs[] = "{$name}: 値が" . count($sorted) . '件'; continue; }
    foreach ($bounds as $k => $p) {
        $calc = round(percentileLinear($sorted, ($k + 1) / 6), 2);
        if (abs($calc - (float)$thresholds6[$name][$p]) > 1e-9) $errs[] = "{$name}.{$p} 定数={$thresholds6[$name][$p]} 再計算={$calc}";
    }
}
check('(c) 境目が9216件から計算し直した値（線形補間・小数第2位）と一致', $errs === [], firstFew($errs));

// ---- (d) 2つずつまとめると3段階と一致 ----
$errs = [];
foreach ($level6Calc as $i => $lv6) {
    foreach ($items as $name) {
        if (!isset($lv6[$name], $level3Calc[$i][$name]) || love_level6To3($lv6[$name]) !== $level3Calc[$i][$name]) {
            $in = $cases[$i]['input'];
            $errs[] = "{$in['mbti']}/{$in['blood']}/{$in['seizaSign']}/{$in['seizaInnerType']} {$name}: 6段階=" . ($lv6[$name] ?? '-') . ' 3段階=' . ($level3Calc[$i][$name] ?? '-');
        }
    }
}
check('(d) 9216件×9項目で love_level6To3(6段階) == 3段階（STGのincで再計算）', $errs === [], firstFew($errs));

// ---- (e) スナップショットの6段階欄 ----
$errs = [];
foreach ($cases as $i => $c) {
    $e = $c['expected'];
    $in = $c['input'];
    $id = "{$in['mbti']}/{$in['blood']}/{$in['seizaSign']}/{$in['seizaInnerType']}";
    if (!isset($e['stylesLevel6'], $e['tendenciesLevel6'])) { $errs[] = "{$id}: stylesLevel6・tendenciesLevel6が無い"; continue; }
    $snap6 = $e['stylesLevel6'] + $e['tendenciesLevel6'];
    if ($e['stylesLevel6'] !== love_normalizeStyles6(love_computeStyles($e['primitives'])) || $e['tendenciesLevel6'] !== love_normalizeTendencies6(love_computeTendencies($e['primitives']))) {
        $errs[] = "{$id}: スナップショットの6段階が再計算と不一致";
    }
    $snap3 = $e['stylesNormalized'] + $e['tendenciesNormalized'];
    foreach ($items as $name) {
        if (!isset($snap6[$name]) || love_level6To3($snap6[$name]) !== ($snap3[$name] ?? null)) $errs[] = "{$id} {$name}: まとめると3段階と不一致";
    }
}
check('(e) スナップショットのstylesLevel6・tendenciesLevel6が再計算と一致し、まとめると3段階の欄と一致', $errs === [], firstFew($errs));

// ---- (f) 各段階に1件以上・割合 ----
$dist = [];
foreach ($items as $name) $dist[$name] = array_fill_keys(LOVE_LEVELS6, 0);
foreach ($level6Calc as $lv6) foreach ($lv6 as $name => $l) $dist[$name][$l]++;
$errs = [];
$table = [];
foreach ($items as $name) {
    $row = [];
    foreach (LOVE_LEVELS6 as $l) {
        if ($dist[$name][$l] < 1) $errs[] = "{$name}.{$l}=0件";
        $row[] = sprintf('%s %4.1f%%', $l, $dist[$name][$l] / 9216 * 100);
    }
    $table[] = sprintf('    %s: %s', $name, implode('  ', $row));
}
check('(f) 各項目で6段階すべてに1件以上', $errs === [], firstFew($errs));

// ---- (g) 文言バンク ----
$errs = [];
foreach ([[LOVE_STYLE_TEXTS, $styleNames, 'Style'], [LOVE_TENDENCY_TEXTS, $tendencyNames, 'Tendency']] as [$bank, $names, $kind]) {
    if (array_keys($bank) !== $names) $errs[] = "{$kind}: 項目が" . implode(',', array_keys($bank));
    foreach ($names as $name) {
        $keys = array_keys($bank[$name] ?? []);
        sort($keys);
        if ($keys !== LOVE_LEVELS6) $errs[] = "{$kind} {$name}: 段階が" . implode(',', $keys);
        foreach (LOVE_LEVELS6 as $l) {
            if (!is_string($bank[$name][$l] ?? null) || trim($bank[$name][$l]) === '') $errs[] = "{$kind} {$name}.{$l}: 空";
        }
    }
}
check('(g) 文言バンクに9項目×L1〜L6がそろい、空でない', $errs === [], firstFew($errs));

// ---- (h) 表示ラベル ----
$labelKeys = array_keys(LOVE_ITEM_LABELS);
$a = $labelKeys; sort($a);
$b = $items; sort($b);
check('(h) LOVE_ITEM_LABELSのキーが9項目と一致', $a === $b, implode('・', $labelKeys));

// ---- 結果出力 ----
echo "=== Love Level6 Consistency ===\n\n";
foreach ($log as $line) echo $line . "\n";
echo "\n各段階の割合（9216件、STGのincで再計算）:\n";
foreach ($table as $line) echo $line . "\n";
echo "\n";

if ($fail === 0) {
    echo "総合結果: ALL PASS\n";
    exit(0);
}
echo "総合結果: {$fail} FAILURE(S)\n";
exit(1);
