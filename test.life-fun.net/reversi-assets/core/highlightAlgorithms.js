// Q-030：Highlight Trait（最も特徴的な1特性）の選定アルゴリズムを差し替え可能にする。
// D-0026（Normalizer）・D-0044（band境界値）と同じ「アルゴリズムと較正値を分離し、注入可能にする」パターン。
//
// 候補は最初から全部実装しない（D-0037：必要最小限の検証、Q-030）。まずHighest/MeanGap/ZScoreの3つ。
// 差が見えた場合のみ追加候補（Percentile等）を検討する。追加時もこのファイルに新しいアルゴリズムオブジェクトを
// 足すだけで、比較基盤（web/sim/analyzeHighlightAlgorithms.mjs）側の変更は不要な設計にしてある。

import { TRAIT_KEYS } from './playerProfile.js';

// 出自：Q-027と同一のBot群（UltraCautiousBot/SafeBot/DefensiveBot/CornerBot/SlowBot/GreedyBot/
// MobilityBot/RandomBot）×各125局（計1000局）、gapベース（rawTrait − PlayerProfile平均）の標準偏差。
// 2026-07-14、web/sim/analyzeHighlightAlgorithms.mjs のcalibrate()で算出（D-0065）。
// diagnosisBands.jsのDEFAULT_BAND_EDGESと同型：アルゴリズムと較正値を分離し、差し替え可能にする。
// 人間データが集まった段階で同スクリプトを再実行し、この値を置き換えること。
export const DEFAULT_REFERENCE_STD = {
  initiative: 6.22,
  patience: 1.96,
  logic: 13.59,
  adaptability: 9.69,
  courage: 24.29,
  stability: 17.39,
};
export const REFERENCE_STD_SOURCE_LABEL = 'bot-corpus-8bots-125games-gap-based-2026-07-14';

/**
 * @typedef {Object} HighlightResult
 * @property {string} trait 選ばれた特性キー
 * @property {number} score 選定に使った値（アルゴリズムごとにスケールが異なる。比較にはscoreそのものではなく
 *   各アルゴリズムのselect結果内で完結させ、cross-algorithm比較はweb/sim側の相対指標（closeCall率等）で行う）
 */

function argmax(record) {
  let bestKey = null;
  let bestVal = -Infinity;
  for (const key of TRAIT_KEYS) {
    if (record[key] > bestVal) {
      bestVal = record[key];
      bestKey = key;
    }
  }
  return { trait: bestKey, score: bestVal };
}

/**
 * 上位1位・2位のスコア差（Q-030 指標3）を、選定に使った同じrecordから計算する。
 * @param {Record<string, number>} record
 */
export function topGap(record) {
  const sorted = TRAIT_KEYS.map((k) => record[k]).sort((a, b) => b - a);
  return { top1: sorted[0], top2: sorted[1], gap: sorted[0] - sorted[1] };
}

/**
 * Highest：今回のセッションの正規化済みTraitスコア（0-100、UIのステータスバーと同じ値）が最も高い特性を選ぶ。
 * 履歴（PlayerProfile）を必要としないため、BASELINE（初回プレイ）でも常に定義できる。
 * 他アルゴリズムがBASELINEで使えない場合のフォールバック先でもある。
 */
export const HighestAlgorithm = {
  name: 'Highest',
  requiresHistory: false,
  /** @param {{normalizedTraits: Record<string, number>}} ctx */
  select(ctx) {
    return argmax(ctx.normalizedTraits);
  },
};

/**
 * MeanGap：今回のRawTraitと、PlayerProfile.averageTrait（過去セッションの平均）との差が最も大きい特性を選ぶ。
 * D-0028の実装上の注意（averageTraitは今回のセッションを反映する前の値で比較すること）に従う。
 * PlayerProfile.playCount === 0（BASELINE）では比較対象が存在しないためnullを返す（呼び出し側はHighestへフォールバック）。
 */
export const MeanGapAlgorithm = {
  name: 'MeanGap',
  requiresHistory: true,
  /** @param {{rawTraits: Record<string, number>, profile: import('./playerProfile.js').PlayerProfile}} ctx */
  select(ctx) {
    if (ctx.profile.playCount === 0) return null;
    const gap = {};
    for (const key of TRAIT_KEYS) {
      gap[key] = ctx.rawTraits[key] - ctx.profile.averageTrait[key];
    }
    return argmax(gap);
  },
};

/**
 * ZScore：MeanGapの分子（今回のRawTrait − PlayerProfile平均）を、特性ごとの基準偏差（referenceStd、
 * コーパス由来の較正値。DEFAULT_BAND_EDGESと同型の「較正値」であり本ファイルには持たせず注入する）で割った値が
 * 最も大きい特性を選ぶ。目的はQ-015で確認された「特性ごとに生の値のレンジが異なる」問題を補正し、
 * 特性間で比較可能なスケールに揃えること。referenceStdが無い特性は1で除算する（無補正、フォールバック）。
 * MeanGapと同じくPlayerProfileの履歴を必要とするため、BASELINEではnullを返す。
 */
export const ZScoreAlgorithm = {
  name: 'ZScore',
  requiresHistory: true,
  /** @param {{rawTraits: Record<string, number>, profile: import('./playerProfile.js').PlayerProfile, referenceStd?: Record<string, number>}} ctx */
  select(ctx) {
    if (ctx.profile.playCount === 0) return null;
    const z = {};
    for (const key of TRAIT_KEYS) {
      const std = ctx.referenceStd?.[key] || 1;
      z[key] = (ctx.rawTraits[key] - ctx.profile.averageTrait[key]) / std;
    }
    return argmax(z);
  },
};

/**
 * Percentile：MeanGapと同じ「今回のRawTrait − PlayerProfile平均」を分子にするが、その値を
 * referenceStdで割るのではなく、特性ごとの分布内での相対順位（percentile、0-1）に変換してから比較する。
 * Z-scoreは分布の「広がり（標準偏差）」だけを揃えるのに対し、Percentileは分布の「形（歪度等）」ごと
 * 揃えるため、各特性のgap分布が持つ非対称性（EVENTS.mdの重み付けが特性ごとに異なることに起因する可能性）
 * の影響をより強く補正できる（Phase 1で実測したうえでの仮説、要検証）。
 * 較正値は`referenceGapPercentile`（特性ごとのpercentile関数、コーパスから算出し注入する）。
 */
export const PercentileAlgorithm = {
  name: 'Percentile',
  requiresHistory: true,
  /** @param {{rawTraits: Record<string, number>, profile: import('./playerProfile.js').PlayerProfile, referenceGapPercentile?: Record<string, (v: number) => number>}} ctx */
  select(ctx) {
    if (ctx.profile.playCount === 0) return null;
    const p = {};
    for (const key of TRAIT_KEYS) {
      const gap = ctx.rawTraits[key] - ctx.profile.averageTrait[key];
      p[key] = ctx.referenceGapPercentile?.[key] ? ctx.referenceGapPercentile[key](gap) : gap;
    }
    return argmax(p);
  },
};

export const HIGHLIGHT_ALGORITHMS = [HighestAlgorithm, MeanGapAlgorithm, ZScoreAlgorithm, PercentileAlgorithm];

/**
 * 指定アルゴリズムでHighlight Traitを選ぶ。requiresHistory=trueのアルゴリズムがBASELINEで使えない場合、
 * Highestへフォールバックする（SelfRelation.confidenceがBASELINEで未定義になるD-0028と同型の設計、Q-030で確定）。
 * @param {{name: string, requiresHistory: boolean, select: (ctx: any) => ({trait: string, score: number} | null)}} algorithm
 * @param {any} ctx
 * @returns {{trait: string, score: number, algorithm: string, fellBackToHighest: boolean}}
 */
export function selectHighlight(algorithm, ctx) {
  const result = algorithm.select(ctx);
  if (result) {
    return { ...result, algorithm: algorithm.name, fellBackToHighest: false };
  }
  const fallback = HighestAlgorithm.select(ctx);
  return { ...fallback, algorithm: algorithm.name, fellBackToHighest: true };
}
