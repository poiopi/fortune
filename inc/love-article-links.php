<?php
declare(strict_types=1);

/**
 * inc/love-article-links.php
 *
 * Source Engineのraw（型コード等）から記事URLを解決する。Composerより前段
 * （orchestrator側）で使う、Presentation層のヘルパー（docs/love/02-domain-map.md
 * 4節・06-composer.md「入力の前提」）。
 *
 * Composerはこのファイルを一切参照しない。Composerが受け取るのは、ここで
 * 解決済みの{source => {url, label}|null}という候補配列のみ（原則10：
 * Love DomainはPresentationの概念を参照しない、の逆方向＝Presentationヘルパーが
 * rawを扱うこと自体は問題ないが、Composer側からこのファイルへの依存は作らない）。
 *
 * 2026-07-12、Bundle設計レビュー時に2つの内部リンク不具合を発見・修正：
 * ①血液型記事4本（articles/love/blood/）公開後もlove_resolveBloodArticleLink()が
 *   常にnullを返す実装のまま放置されていた。
 * ②love_resolveSeizaArticleLink()が、Love版星座12記事（articles/love/seiza/）
 *   公開後も旧・汎用星座記事（articles/seiza/）へのURLを返し続けていた
 *   （love_resolveMbtiArticleLink()で既に修正済みだったのと同種の不具合）。
 */

require_once __DIR__ . '/seiza-data.php';

/**
 * SEIZA_SIGNSのインデックス（signIndex）→articles/seiza/配下の英語slug対応表。
 * 既存コードのどこにも存在しなかったため新規作成（Managerレビュー2026-07-10で
 * 指摘された欠落）。SEIZA_SIGNSの並び順（0=山羊座起点）と一致させている。
 */
const SEIZA_ARTICLE_SLUGS = [
    0 => 'capricorn',   // 山羊座
    1 => 'aquarius',    // 水瓶座
    2 => 'pisces',      // 魚座
    3 => 'aries',       // 牡羊座
    4 => 'taurus',      // 牡牛座
    5 => 'gemini',      // 双子座
    6 => 'cancer',      // 蟹座
    7 => 'leo',         // 獅子座
    8 => 'virgo',       // 乙女座
    9 => 'libra',       // 天秤座
    10 => 'scorpio',    // 蠍座
    11 => 'sagittarius', // 射手座
];

/**
 * @param array{raw: array{type: string}} $mbtiResult mbtiEngine()の出力
 * @return array{url: string, label: string}
 */
function love_resolveMbtiArticleLink(array $mbtiResult): array {
    $type = strtolower($mbtiResult['raw']['type']);
    return [
        'url' => "/articles/love/mbti/{$type}/",
        'label' => "{$mbtiResult['raw']['type']}恋愛解説",
    ];
}

/**
 * BLOOD_DATAのキー（'A'|'B'|'O'|'AB'）→articles/love/blood/配下のslug対応表。
 */
const BLOOD_ARTICLE_SLUGS = [
    'A' => 'a-love',
    'B' => 'b-love',
    'O' => 'o-love',
    'AB' => 'ab-love',
];

/**
 * @param array{raw: array{type: string}} $bloodResult bloodEngine()の出力
 * @return array{url: string, label: string}|null
 */
function love_resolveBloodArticleLink(array $bloodResult): ?array {
    $type = $bloodResult['raw']['type'];
    if (!isset(BLOOD_ARTICLE_SLUGS[$type])) return null;
    $slug = BLOOD_ARTICLE_SLUGS[$type];
    return [
        'url' => "/articles/love/blood/{$slug}/",
        'label' => "{$type}型の恋愛解説",
    ];
}

/**
 * @param array{raw: array{signIndex: int}} $seizaResult seizaEngine()の出力
 * @return array{url: string, label: string}|null
 */
function love_resolveSeizaArticleLink(array $seizaResult): ?array {
    $signIndex = $seizaResult['raw']['signIndex'];
    if (!isset(SEIZA_ARTICLE_SLUGS[$signIndex])) return null;
    $slug = SEIZA_ARTICLE_SLUGS[$signIndex];
    $signName = SEIZA_SIGNS[$signIndex]['name'];
    return [
        'url' => "/articles/love/seiza/{$slug}/",
        'label' => "{$signName}の恋愛解説",
    ];
}

/**
 * MBTI・Blood・SeizaのResultDataから、Composerへ渡すarticleLinks候補を
 * まとめて構築する。
 *
 * @return array<string, array{url: string, label: string}|null>
 */
function love_resolveArticleLinkCandidates(array $mbtiResult, array $bloodResult, array $seizaResult): array {
    return [
        'mbti' => love_resolveMbtiArticleLink($mbtiResult),
        'blood' => love_resolveBloodArticleLink($bloodResult),
        'seiza' => love_resolveSeizaArticleLink($seizaResult),
    ];
}
