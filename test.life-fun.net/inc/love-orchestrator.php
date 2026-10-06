<?php
declare(strict_types=1);

/**
 * inc/love-orchestrator.php
 *
 * love.phpが使う、Source Engine呼び出しからComposerまでを1回で実行する
 * エントリポイント。docs/love/07-implementation.mdの「Composer接続」工程。
 *
 * Love Domainのファイルではない（love-primitive-mapping.php等とは異なり、
 * Primitive/Style/Tendency/Bundleの計算ロジックを一切持たない）。Source Engine
 * ・Shared Axis Library・Love Domain・Presentationの全部品を呼び出して束ねる
 * だけの、ページ側の薄いorchestrator（docs/love/02-domain-map.md、Manager
 * レビュー2026-07-10で「Love Domain側ファイルに引き込まない」と確認済みの
 * articleLinks解決も、ここで行う）。
 */

require_once __DIR__ . '/mbti-engine.php';
require_once __DIR__ . '/blood-engine.php';
require_once __DIR__ . '/seiza-engine.php';
require_once __DIR__ . '/axis-engine.php';
require_once __DIR__ . '/love-primitive-mapping.php';
require_once __DIR__ . '/love-style.php';
require_once __DIR__ . '/love-tendency.php';
require_once __DIR__ . '/love-normalizer.php';
require_once __DIR__ . '/love-bundle.php';
require_once __DIR__ . '/love-bundle-texts.php';
require_once __DIR__ . '/love-style-texts.php';
require_once __DIR__ . '/love-tendency-texts.php';
require_once __DIR__ . '/love-composer.php';
require_once __DIR__ . '/love-display-labels.php';
require_once __DIR__ . '/love-article-links.php';

/**
 * @param string $mbtiType 4文字のMBTIタイプコード（例：'ENTP'）
 * @param string $bloodType 'A'|'B'|'O'|'AB'
 * @param int $month 1-12
 * @param int $day 1-31
 * @param string $timeZoneCode SEIZA_TIME_ZONESのコード（traitsには寄与しない）
 * @return array{
 *   badge: array{mbti: string, blood: string, seiza: string},
 *   document: array{bundleText: string, styleTexts: string[], tendencyTexts: string[], articleLinks: array<int, array{source: string, url: string, label: string}>, styleItems: array<int, array{name: string, label: string, description: string, text: string}>, tendencyItems: array<int, array{name: string, label: string, description: string, text: string}>}
 * }
 */
function love_diagnose(string $mbtiType, string $bloodType, int $month, int $day, string $timeZoneCode): array {
    $mbtiResult = mbtiEngineFromType($mbtiType);
    $bloodResult = bloodEngine($bloodType);
    $seizaResult = seizaEngine($month, $day, $timeZoneCode);

    $resultDatas = ['mbti' => $mbtiResult, 'blood' => $bloodResult, 'seiza' => $seizaResult];

    $aggregated = axis_aggregateTraits(array_values($resultDatas));
    $axisValues = axis_computeAxes($aggregated);
    $primitives = love_computePrimitives($axisValues);

    // 画面の文章と並び順には6段階（L1〜L6）を使う（docs/love/08-normalizer.md「6段階」）。
    // 3段階（love_normalizeStyles等）は記事・事実照合の基準として別に残している。
    $normalizedStyles = love_normalizeStyles6(love_computeStyles($primitives));
    $normalizedTendencies = love_normalizeTendencies6(love_computeTendencies($primitives));

    $bundle = love_selectBundle($primitives);
    $bundleText = LOVE_BUNDLE_TEXTS[love_resolveBundleTextId($bundle['id'])];

    $influence = axis_computeInfluence($resultDatas);
    $articleLinkCandidates = love_resolveArticleLinkCandidates($mbtiResult, $bloodResult, $seizaResult);

    $document = love_composeResult(
        $bundleText,
        $normalizedStyles,
        $normalizedTendencies,
        LOVE_STYLE_TEXTS,
        LOVE_TENDENCY_TEXTS,
        $influence,
        $articleLinkCandidates,
        LOVE_ITEM_LABELS,
        LOVE_LEVELS6
    );

    return [
        'badge' => [
            'mbti' => $mbtiResult['raw']['type'],
            'blood' => $bloodResult['meta']['subtitle'],
            'seiza' => SEIZA_SIGNS[$seizaResult['raw']['signIndex']]['name'],
        ],
        'document' => $document,
    ];
}
