<?php
declare(strict_types=1);

/**
 * inc/love-composer.php
 *
 * ResultDocumentの組立（docs/love/06-composer.md）。Composerは文章を書くモジュール
 * ではなく、文章の組立規則である。文言そのものは持たず、文言バンク（Style/Tendency
 * の段階別（本番は6段階 L1〜L6）文言。Text Bankフェーズで別途用意する）を引数として受け取り、
 * IDで参照するだけに留める。
 *
 * Composerはraw・Primitive・Axisのいずれも読まない。入力はBundle（選定済み）・
 * Style/Tendency（Normalizer済みの段階区分）・Influence・articleLinks候補
 * （Composerより前段で解決済み）の4系統のみ（06-composer.md「入力の前提」）。
 *
 * 選択ロジックの上限：2つ以上のStyle/Tendency区分の組み合わせで異なる文言IDを
 * 選ぶ分岐は行わない（06-composer.md「選択ロジックの上限」）。本実装は各Style/
 * Tendencyの区分を独立に文言バンクへ引くだけであり、この制約に従う。
 */

/**
 * @param string $bundleText Bundleの選定結果に対応する基本文（既に確定済み）
 * @param array<string, string> $normalizedStyles love_normalizeStyles6()の出力（'L1'〜'L6'。段階の名前はComposerでは解釈しない）
 * @param array<string, string> $normalizedTendencies love_normalizeTendencies()の出力
 * @param array<string, array<string, string>> $styleTextBank [Style名 => ['L1'=>text, …, 'L6'=>text]（段階のキーは$normalizedStylesと同じ）]
 * @param array<string, array<string, string>> $tendencyTextBank 同上、Tendency側
 * @param array<string, int> $influence axis_computeInfluence()の出力（source => 1〜5の星評価）
 * @param array<string, array{url: string, label: string}|null> $articleLinkCandidates
 *   source => 候補（Composerより前段で解決済み。URLが無いsourceはnull）
 * @param array<string, array{label: string, description: string}>|null $labels
 *   [項目名 => ['label' => 表示名, 'description' => 一行説明]]（inc/love-display-labels.php）。
 *   渡したときだけ styleItems・tendencyItems を戻り値に追加する
 * @param string[] $levelOrder 段階を低い順に並べた配列（並び順の算出に使う）
 * @return array{bundleText: string, styleTexts: string[], tendencyTexts: string[], articleLinks: array<int, array{source: string, url: string, label: string}>, styleItems?: array<int, array{name: string, label: string, description: string, text: string}>, tendencyItems?: array<int, array{name: string, label: string, description: string, text: string}>}
 */
function love_composeResult(
    string $bundleText,
    array $normalizedStyles,
    array $normalizedTendencies,
    array $styleTextBank,
    array $tendencyTextBank,
    array $influence,
    array $articleLinkCandidates,
    ?array $labels = null,
    array $levelOrder = ['Low', 'Mid', 'High']
): array {
    $styleTexts = love_composer_lookupTexts($normalizedStyles, $styleTextBank, 'Style');
    $tendencyTexts = love_composer_lookupTexts($normalizedTendencies, $tendencyTextBank, 'Tendency');
    $articleLinks = love_composer_buildArticleLinks($influence, $articleLinkCandidates);

    $document = [
        'bundleText' => $bundleText,
        'styleTexts' => $styleTexts,
        'tendencyTexts' => $tendencyTexts,
        'articleLinks' => $articleLinks,
    ];

    if ($labels !== null) {
        $document['styleItems'] = love_composer_buildItems($normalizedStyles, $styleTextBank, $labels, $levelOrder, 'Style');
        $document['tendencyItems'] = love_composer_buildItems($normalizedTendencies, $tendencyTextBank, $labels, $levelOrder, 'Tendency');
    }

    return $document;
}

/**
 * 結果画面用に、各項目の表示名・一行説明・文章を組にして並べる。
 *
 * 並び順は「真ん中から遠い順」：距離 = abs(段階の位置 − (段階数−1)/2) の大きい順。
 * 距離が同じ項目は入力の順（LOVE_STYLE_MAPPING・LOVE_TENDENCY_MAPPINGの定義順）を
 * 保つ（usortは安定ソートである保証がないため、元の位置を第2キーにする）。
 * 各項目の文言は自分の段階だけで引く。複数項目の段階を組み合わせて文言を選び分ける
 * ことはしない（06-composer.md「選択ロジックの上限」）。
 *
 * @param array<string, string> $normalized [項目名 => 段階]
 * @param array<string, array<string, string>> $textBank
 * @param array<string, array{label: string, description: string}> $labels
 * @param string[] $levelOrder 段階を低い順に並べた配列（本番はLOVE_LEVELS6を明示的に渡す。既定値は3段階用）
 * @return array<int, array{name: string, label: string, description: string, text: string}>
 */
function love_composer_buildItems(array $normalized, array $textBank, array $labels, array $levelOrder, string $kind): array {
    $levelOrder = array_values($levelOrder);
    $center = (count($levelOrder) - 1) / 2;

    $entries = [];
    $position = 0;
    foreach ($normalized as $name => $level) {
        if (!isset($textBank[$name][$level])) {
            throw new InvalidArgumentException("文言バンクに存在しない{$kind}: {$name}[{$level}]");
        }
        if (!isset($labels[$name]['label'], $labels[$name]['description'])) {
            throw new InvalidArgumentException("表示ラベルに存在しない{$kind}: {$name}");
        }
        $levelIndex = array_search($level, $levelOrder, true);
        if ($levelIndex === false) {
            throw new InvalidArgumentException("段階の並びに存在しない{$kind}の段階: {$name}[{$level}]");
        }
        $entries[] = [
            'distance' => abs($levelIndex - $center),
            'position' => $position++,
            'item' => [
                'name' => $name,
                'label' => $labels[$name]['label'],
                'description' => $labels[$name]['description'],
                'text' => $textBank[$name][$level],
            ],
        ];
    }

    usort($entries, function ($a, $b) {
        return [$b['distance'], $a['position']] <=> [$a['distance'], $b['position']];
    });

    return array_column($entries, 'item');
}

/**
 * 各項目の区分（本番は6段階 L1〜L6）を、文言バンクの対応するIDへ引くだけの純粋な参照。
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
