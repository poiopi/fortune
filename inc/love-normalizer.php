<?php
declare(strict_types=1);

/**
 * inc/love-normalizer.php
 *
 * Primitive／Style／Tendencyの生スコアをHigh/Mid/Lowへ変換する（docs/love/08-normalizer.md）。
 * スコアの絶対値ではなく、9216通り全数（tests/cases/love-primitives-snapshot.php・
 * tests/cases/love-style-tendency-snapshot.php）から算出した実測百分位（P33/P67）に
 * おける母集団上の位置を表す。
 *
 * Primitive／Style／Tendencyそれぞれ独立した閾値を持つ（共通の閾値テーブルは
 * 採用しない。docs/love/08-normalizer.md参照：分布の形も値域も異なるため）。
 *
 * 実際のLow/Mid/High比率は33/33/33に均等ではない（例：自立性はLow65.6%等）。
 * これは離散値かつ特定の値に集中する分布から生じる自然な結果であり、意図的な調整は
 * 行わない（母集団上の真の相対位置を表すことを優先する）。
 *
 * 【6段階（L1〜L6）について（2026-10-06追加。docs/love/08-normalizer.md「6段階」）】
 * - 6段階は、結果画面の文章（inc/love-style-texts.php・inc/love-tendency-texts.php）を
 *   選ぶためのもの。対象はStyle 7項目とTendency 2項目だけで、Primitiveは3段階のまま。
 *   段階名（L1〜L6）は内部名であり、画面には出さない。
 * - 3段階（Low/Mid/High）は、記事の数値・事実照合テスト（tests/tools/love-article-facts.php）
 *   の基準として、定数・関数とも従来どおり使い続ける。
 * - 6段階を2つずつまとめると3段階と全件一致する（L1・L2→Low、L3・L4→Mid、L5・L6→High。
 *   love_level6To3()）。6段階のP33・P67は3段階の定数をそのまま参照しているため。
 *   一致はtests/tools/love-level6-consistency.phpで9216件全数を検査する。
 * - 生成器（tools/build-combo-data.php）の5段階（主軸の集中度「集中しやすい〜非常に
 *   分散しやすい」。docs/love/12-combo-classification.md）とは別の尺度。混同しないため、
 *   6段階の名前に「集中」「分散」などの言葉は使わない。
 */

require_once __DIR__ . '/love-primitive-mapping.php';
require_once __DIR__ . '/love-style.php';
require_once __DIR__ . '/love-tendency.php';

const NORMALIZE_PRIMITIVE_THRESHOLDS = [
    PRIMITIVE_ACTION      => ['p33' => 3, 'p67' => 4],
    PRIMITIVE_RELIABILITY => ['p33' => 4, 'p67' => 7],
    PRIMITIVE_SENSITIVITY => ['p33' => 4, 'p67' => 6],
    PRIMITIVE_AUTONOMY    => ['p33' => 1, 'p67' => 2],
    PRIMITIVE_TRANSFORM   => ['p33' => 2, 'p67' => 3],
];

const NORMALIZE_STYLE_THRESHOLDS = [
    '積極性'     => ['p33' => 3.20, 'p67' => 4.60],
    '愛情表現'   => ['p33' => 3.40, 'p67' => 4.90],
    '包容力'     => ['p33' => 4.40, 'p67' => 5.80],
    '独占欲'     => ['p33' => 2.20, 'p67' => 3.60],
    '惚れやすさ' => ['p33' => 3.20, 'p67' => 4.20],
    '嫉妬深さ'   => ['p33' => -0.40, 'p67' => 1.60],
    '恋愛の慎重さ' => ['p33' => 3.00, 'p67' => 4.60],
];

const NORMALIZE_TENDENCY_THRESHOLDS = [
    '結婚志向' => ['p33' => 2.17, 'p67' => 4.20],
    '浮気耐性' => ['p33' => 1.60, 'p67' => 3.70],
];

/**
 * @param array<string, int|float> $scores
 * @param array<string, array{p33: int|float, p67: int|float}> $thresholds
 * @param string $label エラーメッセージ用（'Primitive'|'Style'|'Tendency'）
 * @return array<string, string> 名前 => 'Low'|'Mid'|'High'
 */
function love_classify(array $scores, array $thresholds, string $label): array {
    $result = [];
    foreach ($scores as $name => $score) {
        $t = $thresholds[$name] ?? null;
        if ($t === null) {
            throw new InvalidArgumentException("Normalizer閾値が未定義の{$label}: {$name}");
        }
        // Style/Tendencyは小数の重み付き和のため、浮動小数点誤差で閾値と同値のスコアが
        // わずかに上回り（例：5.8 → 5.8000000000000007）High側へ誤判定される。
        // 比較前に丸めて、同じスコアが常に同じ区分になるようにする（2026-10-01修正）。
        $score = round((float)$score, 6);
        if ($score <= $t['p33']) {
            $result[$name] = 'Low';
        } elseif ($score <= $t['p67']) {
            $result[$name] = 'Mid';
        } else {
            $result[$name] = 'High';
        }
    }
    return $result;
}

/**
 * @param array<string, int> $primitives love_computePrimitives()の出力
 * @return array<string, string> Primitive名 => 'Low'|'Mid'|'High'
 */
function love_normalizePrimitives(array $primitives): array {
    return love_classify($primitives, NORMALIZE_PRIMITIVE_THRESHOLDS, 'Primitive');
}

/**
 * @param array<string, float> $styles love_computeStyles()の出力
 * @return array<string, string> Style名 => 'Low'|'Mid'|'High'
 */
function love_normalizeStyles(array $styles): array {
    return love_classify($styles, NORMALIZE_STYLE_THRESHOLDS, 'Style');
}

/**
 * @param array<string, float> $tendencies love_computeTendencies()の出力
 * @return array<string, string> Tendency名 => 'Low'|'Mid'|'High'
 */
function love_normalizeTendencies(array $tendencies): array {
    return love_classify($tendencies, NORMALIZE_TENDENCY_THRESHOLDS, 'Tendency');
}

// ─────────────────────────────────────────────
// 6段階（L1〜L6）：結果画面の文章を選ぶための区分（docs/love/08-normalizer.md「6段階」）
// ─────────────────────────────────────────────

/** 6段階の内部名（低い順）。画面には出さない */
const LOVE_LEVELS6 = ['L1', 'L2', 'L3', 'L4', 'L5', 'L6'];

/**
 * Style 6段階の境目。p33・p67は3段階の定数を参照する（二重管理にしない）。
 * p17・p50・p83は9216通り全数（tests/cases/love-style-tendency-snapshot.php）から、
 * 3段階と同じ方法（線形補間の百分位、位置＝(n−1)×k/6）で算出し小数第2位に丸めた値（2026-10-06）。
 */
const NORMALIZE_STYLE_THRESHOLDS6 = [
    '積極性'     => ['p17' => 2.60, 'p33' => NORMALIZE_STYLE_THRESHOLDS['積極性']['p33'], 'p50' => 3.80, 'p67' => NORMALIZE_STYLE_THRESHOLDS['積極性']['p67'], 'p83' => 5.20],
    '愛情表現'   => ['p17' => 2.60, 'p33' => NORMALIZE_STYLE_THRESHOLDS['愛情表現']['p33'], 'p50' => 4.20, 'p67' => NORMALIZE_STYLE_THRESHOLDS['愛情表現']['p67'], 'p83' => 5.80],
    '包容力'     => ['p17' => 3.60, 'p33' => NORMALIZE_STYLE_THRESHOLDS['包容力']['p33'], 'p50' => 5.20, 'p67' => NORMALIZE_STYLE_THRESHOLDS['包容力']['p67'], 'p83' => 6.80],
    '独占欲'     => ['p17' => 1.10, 'p33' => NORMALIZE_STYLE_THRESHOLDS['独占欲']['p33'], 'p50' => 2.80, 'p67' => NORMALIZE_STYLE_THRESHOLDS['独占欲']['p67'], 'p83' => 4.20],
    '惚れやすさ' => ['p17' => 2.40, 'p33' => NORMALIZE_STYLE_THRESHOLDS['惚れやすさ']['p33'], 'p50' => 3.60, 'p67' => NORMALIZE_STYLE_THRESHOLDS['惚れやすさ']['p67'], 'p83' => 4.80],
    '嫉妬深さ'   => ['p17' => -1.60, 'p33' => NORMALIZE_STYLE_THRESHOLDS['嫉妬深さ']['p33'], 'p50' => 0.40, 'p67' => NORMALIZE_STYLE_THRESHOLDS['嫉妬深さ']['p67'], 'p83' => 2.60],
    '恋愛の慎重さ' => ['p17' => 2.00, 'p33' => NORMALIZE_STYLE_THRESHOLDS['恋愛の慎重さ']['p33'], 'p50' => 3.80, 'p67' => NORMALIZE_STYLE_THRESHOLDS['恋愛の慎重さ']['p67'], 'p83' => 5.80],
];

/** Tendency 6段階の境目（算出方法はNORMALIZE_STYLE_THRESHOLDS6と同じ） */
const NORMALIZE_TENDENCY_THRESHOLDS6 = [
    '結婚志向' => ['p17' => 0.90, 'p33' => NORMALIZE_TENDENCY_THRESHOLDS['結婚志向']['p33'], 'p50' => 3.00, 'p67' => NORMALIZE_TENDENCY_THRESHOLDS['結婚志向']['p67'], 'p83' => 5.70],
    '浮気耐性' => ['p17' => 0.50, 'p33' => NORMALIZE_TENDENCY_THRESHOLDS['浮気耐性']['p33'], 'p50' => 2.70, 'p67' => NORMALIZE_TENDENCY_THRESHOLDS['浮気耐性']['p67'], 'p83' => 5.40],
];

/**
 * @param array<string, int|float> $scores
 * @param array<string, array{p17: int|float, p33: int|float, p50: int|float, p67: int|float, p83: int|float}> $thresholds
 * @param string $label エラーメッセージ用（'Style'|'Tendency'）
 * @return array<string, string> 名前 => 'L1'〜'L6'
 */
function love_classify6(array $scores, array $thresholds, string $label): array {
    $result = [];
    foreach ($scores as $name => $score) {
        $t = $thresholds[$name] ?? null;
        if ($t === null) {
            throw new InvalidArgumentException("Normalizer閾値（6段階）が未定義の{$label}: {$name}");
        }
        // love_classify()と同じく、浮動小数点誤差による境目での誤判定を避けるため丸めてから比較する
        $score = round((float)$score, 6);
        if ($score <= $t['p17']) {
            $result[$name] = 'L1';
        } elseif ($score <= $t['p33']) {
            $result[$name] = 'L2';
        } elseif ($score <= $t['p50']) {
            $result[$name] = 'L3';
        } elseif ($score <= $t['p67']) {
            $result[$name] = 'L4';
        } elseif ($score <= $t['p83']) {
            $result[$name] = 'L5';
        } else {
            $result[$name] = 'L6';
        }
    }
    return $result;
}

/**
 * @param array<string, float> $styles love_computeStyles()の出力
 * @return array<string, string> Style名 => 'L1'〜'L6'
 */
function love_normalizeStyles6(array $styles): array {
    return love_classify6($styles, NORMALIZE_STYLE_THRESHOLDS6, 'Style');
}

/**
 * @param array<string, float> $tendencies love_computeTendencies()の出力
 * @return array<string, string> Tendency名 => 'L1'〜'L6'
 */
function love_normalizeTendencies6(array $tendencies): array {
    return love_classify6($tendencies, NORMALIZE_TENDENCY_THRESHOLDS6, 'Tendency');
}

/**
 * 6段階を3段階へまとめる（L1・L2→Low、L3・L4→Mid、L5・L6→High）。
 */
function love_level6To3(string $level6): string {
    switch ($level6) {
        case 'L1':
        case 'L2':
            return 'Low';
        case 'L3':
        case 'L4':
            return 'Mid';
        case 'L5':
        case 'L6':
            return 'High';
    }
    throw new InvalidArgumentException("6段階の区分ではない値: {$level6}");
}
