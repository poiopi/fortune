<?php
declare(strict_types=1);

/**
 * inc/axis-engine.php
 *
 * 3占術のResultData（ShichuResult/TarotResult/SeizaResult）を統合し、
 * SanseiResultを生成するEngine。docs/sansei-engine-design.md §5 が仕様。
 *
 * 責務（Step2-0で確定）：
 *   - Trait Aggregation（3占術のtraitsを1つに集約する）
 *   - Axis算出
 *   - Archetype選択・Summary/Advice生成
 *   - Score算出
 *   - Influence算出
 * 内部実装は複数関数に分けるが、公開APIは「ResultData×3 → SanseiResult」の1つに揃える。
 *
 * やらないこと：占術の再計算（rawを再解釈しない）、ResultData自体の書き換え。
 *
 * Step2-2時点では Trait Aggregation・Axis算出 を実装する。
 */

require_once __DIR__ . '/axis-mapping.php';
require_once __DIR__ . '/axis-vocabulary.php';
require_once __DIR__ . '/axis-bundle-data.php';
require_once __DIR__ . '/category-mapping.php';

/**
 * 3占術のResultDataからtraitsだけを取り出し、trait名ごとにtype別（permanent/transient）で
 * 合算する。docs/sansei-engine-design.md §5「Trait Aggregation」が仕様。
 *
 * 3占術は対等に扱う（重み付けをしない）。
 *
 * @param array<int, array{traits: array<string, array{score:int, type:string}>}> $resultDatas
 * @return array<string, array{permanent:int, transient:int, total:int}>
 */
function axis_aggregateTraits(array $resultDatas): array {
    $aggregated = [];

    foreach ($resultDatas as $resultData) {
        foreach ($resultData['traits'] as $traitName => $trait) {
            if (!isset($aggregated[$traitName])) {
                $aggregated[$traitName] = ['permanent' => 0, 'transient' => 0, 'total' => 0];
            }
            if ($trait['type'] === 'permanent') {
                $aggregated[$traitName]['permanent'] += $trait['score'];
            } elseif ($trait['type'] === 'transient') {
                $aggregated[$traitName]['transient'] += $trait['score'];
            }
            $aggregated[$traitName]['total'] += $trait['score'];
        }
    }

    return $aggregated;
}

/**
 * axis_aggregateTraits()の出力（trait名ごとのpermanent/transient/total）を、
 * inc/axis-mapping.php（Rule ID: A001〜A009）に基づいてAxisへ変換する。
 * traitと同じ3値（permanent/transient/total）をAxis側でも保持する
 * （Archetype=permanent参照、Summary/Scores=total参照、Advice=transient重視、という
 * Step0の使い分けをAxisレベルでも維持するため）。
 *
 * @param array<string, array{permanent:int, transient:int, total:int}> $aggregatedTraits
 * @return array<string, array{permanent:int, transient:int, total:int}>
 */
function axis_computeAxes(array $aggregatedTraits): array {
    $axes = [];

    foreach ($aggregatedTraits as $traitName => $values) {
        $rules = AXIS_MAPPING[$traitName] ?? [];
        foreach ($rules as $rule) {
            $axisName = $rule['axis'];
            if (!isset($axes[$axisName])) {
                $axes[$axisName] = ['permanent' => 0, 'transient' => 0, 'total' => 0];
            }
            $axes[$axisName]['permanent'] += $values['permanent'];
            $axes[$axisName]['transient'] += $values['transient'];
            $axes[$axisName]['total'] += $values['total'];
        }
    }

    return $axes;
}

// ═══════════════════════════════════════════════════
// Bundle選択（Step2-3a契約: IdentityBundle/TodayBundleに分離。
// Archetypeはpermanentのみ→不変、Adviceはtransientのみ→タロットの一枚で変化する）
// ═══════════════════════════════════════════════════

/**
 * Axis値を$rankKey（'permanent'または'transient'）の降順で上位2つ選ぶ。
 * 同点の場合はAXIS_PRIORITY_ORDERの並び順で決定的に解決する
 * （全軸0点でも常に同じ2軸が選ばれる＝先頭2つ）。
 *
 * @param array<string, array{permanent:int, transient:int, total:int}> $axisValues
 * @return array{0:string, 1:string} [主軸, 副軸]
 */
function axis_selectTop2(array $axisValues, string $rankKey): array {
    $entries = [];
    foreach (AXIS_PRIORITY_ORDER as $priorityIndex => $axisName) {
        $score = $axisValues[$axisName][$rankKey] ?? 0;
        $entries[] = ['axis' => $axisName, 'score' => $score, 'priorityIndex' => $priorityIndex];
    }
    usort($entries, function ($a, $b) {
        if ($a['score'] !== $b['score']) return $b['score'] <=> $a['score']; // scoreの降順
        return $a['priorityIndex'] <=> $b['priorityIndex']; // 同点はAXIS_PRIORITY_ORDER順
    });
    return [$entries[0]['axis'], $entries[1]['axis']];
}

function axis_bundleId(string $prefix, string $primaryAxis, string $secondaryAxis): string {
    return $prefix . '_' . AXIS_CODE[$primaryAxis] . '_' . AXIS_CODE[$secondaryAxis];
}

/** @return array{id:string, primaryAxis:string, secondaryAxis:string, archetype:string, summaryBase:string} */
function axis_getIdentityBundle(array $axisValues): array {
    [$primary, $secondary] = axis_selectTop2($axisValues, 'permanent');
    $id = axis_bundleId('ID', $primary, $secondary);
    $bundle = IDENTITY_BUNDLES[$id] ?? null;
    if ($bundle === null) {
        throw new InvalidArgumentException("IdentityBundleが見つかりません: {$id}");
    }
    return array_merge(['id' => $id, 'primaryAxis' => $primary, 'secondaryAxis' => $secondary], $bundle);
}

/** @return array{id:string, primaryAxis:string, secondaryAxis:string, advice:string, summaryOverlay:string} */
function axis_getTodayBundle(array $axisValues): array {
    [$primary, $secondary] = axis_selectTop2($axisValues, 'transient');
    $id = axis_bundleId('TD', $primary, $secondary);
    $bundle = TODAY_BUNDLES[$id] ?? null;
    if ($bundle === null) {
        throw new InvalidArgumentException("TodayBundleが見つかりません: {$id}");
    }
    return array_merge(['id' => $id, 'primaryAxis' => $primary, 'secondaryAxis' => $secondary], $bundle);
}

/**
 * summaryBase と summaryOverlay を固定の接続ルールで結合する（Step2-3a確定仕様）。
 * summaryOverlayは「今日は」を含まない前提で書かれている。
 */
function axis_composeSummary(string $summaryBase, string $summaryOverlay): string {
    return $summaryBase . '今日は、' . $summaryOverlay;
}

// ═══════════════════════════════════════════════════
// Scores（カテゴリスコア：恋愛/仕事/金運/健康）
// inc/category-mapping.php（単一の情報源）に基づき、Axisのtotal値から算出する。
// scoresは利用者に見せる評価であり、influenceとは異なりチューニング対象として扱う。
// ═══════════════════════════════════════════════════

/** 1〜5の★評価に変換する閾値（v1の暫定値。実データを見ながら調整する）。 */
function axis_scoreToStars(float $rawScore): int {
    if ($rawScore >= 14) return 5;
    if ($rawScore >= 10) return 4;
    if ($rawScore >= 6) return 3;
    if ($rawScore >= 3) return 2;
    return 1;
}

/**
 * @param array<string, array{permanent:int, transient:int, total:int}> $axisValues
 * @return array{love:int, work:int, money:int, health:int}
 */
function axis_computeScores(array $axisValues): array {
    $scores = [];
    foreach (CATEGORY_MAPPING as $category => $weights) {
        $raw = 0.0;
        foreach ($weights as $axisName => $weight) {
            $raw += ($axisValues[$axisName]['total'] ?? 0) * $weight;
        }
        $scores[$category] = axis_scoreToStars($raw);
    }
    return $scores;
}

// ═══════════════════════════════════════════════════
// Influence（各占術の影響度：簡易近似方式）
// docs/sansei-engine-design.md §8：各占術が返したtraitベクトルの大きさを単純比較する。
// scoresと違い、influenceは常に機械的・一貫した算出のみで、内容のチューニングは行わない。
// ═══════════════════════════════════════════════════

/**
 * @param array<string, array{traits: array<string, array{score:int, type:string}>}> $resultDatas
 *   キー（'shichu'等）ごとのResultData
 * @return array<string, int> キーごとの影響度（1〜5の★評価。寄与が全くない場合は0）
 */
function axis_computeInfluence(array $resultDatas): array {
    $magnitudes = [];
    foreach ($resultDatas as $label => $resultData) {
        $sum = 0;
        foreach ($resultData['traits'] as $trait) {
            $sum += abs($trait['score']);
        }
        $magnitudes[$label] = $sum;
    }

    $max = max($magnitudes);
    if ($max === 0) {
        return array_map(fn() => 0, $magnitudes);
    }

    $stars = [];
    foreach ($magnitudes as $label => $m) {
        $stars[$label] = $m === 0 ? 0 : max(1, (int)round(5 * $m / $max));
    }
    return $stars;
}

// ═══════════════════════════════════════════════════
// sanseiEngine: 公開API（ResultData×3 → SanseiResult）
// docs/sansei-engine-design.md §5 が仕様。
// ═══════════════════════════════════════════════════

/**
 * @param array<string, array> $resultDatas 例: ['shichu'=>ShichuResult, 'tarot'=>TarotResult, 'seiza'=>SeizaResult]
 * @return array{
 *   version: string,
 *   archetype: string,
 *   summary: string,
 *   advice: string,
 *   scores: array{love:int, work:int, money:int, health:int},
 *   influence: array<string, int>,
 *   meta: array
 * }
 */
function sanseiEngine(array $resultDatas): array {
    $aggregated = axis_aggregateTraits(array_values($resultDatas));
    $axisValues = axis_computeAxes($aggregated);

    $identity = axis_getIdentityBundle($axisValues);
    $today = axis_getTodayBundle($axisValues);
    $summary = axis_composeSummary($identity['summaryBase'], $today['summaryOverlay']);
    $scores = axis_computeScores($axisValues);
    $influence = axis_computeInfluence($resultDatas);

    $sortedTraits = $aggregated;
    uasort($sortedTraits, fn($a, $b) => $b['total'] <=> $a['total']);
    $topTraits = array_slice(array_keys($sortedTraits), 0, 3);

    return [
        'version' => '1.0',
        'archetype' => $identity['archetype'],
        'summary' => $summary,
        'advice' => $today['advice'],
        'scores' => $scores,
        'influence' => $influence,
        'meta' => [
            'identityBundleId' => $identity['id'],
            'todayBundleId' => $today['id'],
            'identityAxes' => [$identity['primaryAxis'], $identity['secondaryAxis']],
            'todayAxes' => [$today['primaryAxis'], $today['secondaryAxis']],
            'topTraits' => $topTraits,
            'theme' => [
                'identity' => IDENTITY_BUNDLES[$identity['id']]['theme'],
                'today' => TODAY_BUNDLES[$today['id']]['theme'],
            ],
        ],
    ];
}
