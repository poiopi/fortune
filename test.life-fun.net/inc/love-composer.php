<?php
declare(strict_types=1);

/**
 * inc/love-composer.php
 *
 * ResultDocumentの組立（docs/love/06-composer.md）。Composerは文章を書くモジュール
 * ではなく、文章の組立規則である。文言そのものは持たず、文言バンク（Style/Tendency
 * のHigh/Mid/Low文言。Text Bankフェーズで別途用意する）を引数として受け取り、
 * IDで参照するだけに留める。
 *
 * Composerはraw・Primitive・Axisのいずれも読まない。入力はBundle（選定済み）・
 * Style/Tendency（Normalizer済みのHigh/Mid/Low区分）・Influence・articleLinks候補
 * （Composerより前段で解決済み）の4系統のみ（06-composer.md「入力の前提」）。
 *
 * 選択ロジックの上限：2つ以上のStyle/Tendency区分の組み合わせで異なる文言IDを
 * 選ぶ分岐は行わない（06-composer.md「選択ロジックの上限」）。本実装は各Style/
 * Tendencyの区分を独立に文言バンクへ引くだけであり、この制約に従う。
 */

/**
 * @param string $bundleText Bundleの選定結果に対応する基本文（既に確定済み）
 * @param array<string, string> $normalizedStyles love_normalizeStyles()の出力（'Low'|'Mid'|'High'）
 * @param array<string, string> $normalizedTendencies love_normalizeTendencies()の出力
 * @param array<string, array<string, string>> $styleTextBank [Style名 => ['Low'=>text, 'Mid'=>text, 'High'=>text]]
 * @param array<string, array<string, string>> $tendencyTextBank 同上、Tendency側
 * @param array<string, int> $influence axis_computeInfluence()の出力（source => 1〜5の星評価）
 * @param array<string, array{url: string, label: string}|null> $articleLinkCandidates
 *   source => 候補（Composerより前段で解決済み。URLが無いsourceはnull）
 * @return array{bundleText: string, styleTexts: string[], tendencyTexts: string[], articleLinks: array<int, array{source: string, url: string, label: string}>}
 */
function love_composeResult(
    string $bundleText,
    array $normalizedStyles,
    array $normalizedTendencies,
    array $styleTextBank,
    array $tendencyTextBank,
    array $influence,
    array $articleLinkCandidates
): array {
    $styleTexts = love_composer_lookupTexts($normalizedStyles, $styleTextBank, 'Style');
    $tendencyTexts = love_composer_lookupTexts($normalizedTendencies, $tendencyTextBank, 'Tendency');
    $articleLinks = love_composer_buildArticleLinks($influence, $articleLinkCandidates);

    return [
        'bundleText' => $bundleText,
        'styleTexts' => $styleTexts,
        'tendencyTexts' => $tendencyTexts,
        'articleLinks' => $articleLinks,
    ];
}

/**
 * 各項目の区分（Low/Mid/High）を、文言バンクの対応するIDへ引くだけの純粋な参照。
 * 区分の組み合わせによる分岐は行わない（06-composer.md「選択ロジックの上限」）。
 *
 * @param array<string, string> $normalized
 * @param array<string, array<string, string>> $textBank
 * @return string[]
 */
function love_composer_lookupTexts(array $normalized, array $textBank, string $label): array {
    $texts = [];
    foreach ($normalized as $name => $level) {
        if (!isset($textBank[$name][$level])) {
            throw new InvalidArgumentException("文言バンクに存在しない{$label}: {$name}[{$level}]");
        }
        $texts[] = $textBank[$name][$level];
    }
    return $texts;
}

/**
 * articleLinks候補を、Influenceの高い順に並べ替え、URLが無いsourceを除外する。
 * URL自体はここで組み立てない（既に解決済みの候補を受け取るだけ）。
 *
 * @param array<string, int> $influence
 * @param array<string, array{url: string, label: string}|null> $candidates
 * @return array<int, array{source: string, url: string, label: string}>
 */
function love_composer_buildArticleLinks(array $influence, array $candidates): array {
    $available = [];
    foreach ($candidates as $source => $candidate) {
        if ($candidate === null) continue;
        $available[$source] = $candidate;
    }

    $sources = array_keys($available);
    usort($sources, function ($a, $b) use ($influence) {
        return ($influence[$b] ?? 0) <=> ($influence[$a] ?? 0);
    });

    $links = [];
    foreach ($sources as $source) {
        $links[] = [
            'source' => $source,
            'url' => $available[$source]['url'],
            'label' => $available[$source]['label'],
        ];
    }
    return $links;
}
