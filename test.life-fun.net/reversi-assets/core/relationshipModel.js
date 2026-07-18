// Q-004 Phase1：RelationshipModel Stage1（SelfRelation）。
// RawTrait → TraitDelta → SelfRelation の3段階変換。D-0027（RawTraitの絶対値に閾値判定しない、相対比較のみ）・
// D-0028（SelfRelationは事実の記述のみ、評価はしない）に従う。
//
// confidenceはPhase1では分散を使わず、差分量ベースの単純なモデルとする。
// 十分なプレイ履歴が集まった段階で、PlayerProfileへ分散（Welford法）を追加し、
// |delta|/σ のような統計的confidenceへ置き換え可能な設計とする（この関数の内部だけで完結する想定）。
//
// Q-021対応（D-0036/D-0038/D-0039）：SelfRelationのEXPLORING判定は「複数特性が連動して1つの戦略を
// 表しているケース」を区別できない。RelationshipModelに意味辞書を持たせず（D-0036）、構造情報のみを
// 返すMovementPatternを追加する。COHERENT/DIVERGENTのラベル付けはDiagnosis層の責務とし、ここでは
// まだ実装しない。concentrationScoreはGini係数（D-0038）、dominantTraitsは持たない（D-0039、
// traitDeltasから必要に応じてDiagnosis層が抽出する）。

import { TRAIT_KEYS } from './playerProfile.js';

// Phase1の暫定リファレンス値。人間のプレイデータがまだ無いため根拠はなく、実データで調整する前提（EVENTS.mdの
// Weight段階制と同じ扱い）。
const CONFIDENCE_REFERENCE_SCALE = 15;
const STABLE_CONFIDENCE_THRESHOLD = 0.2; // これ未満の変化は「意味のある変化なし」とみなす
const EXPLORING_GAP_THRESHOLD = 0.15; // 1位と2位のconfidence差がこれ未満なら「単一の主導特性」とはみなさない

/**
 * @typedef {Object} TraitDelta
 * @property {string} key
 * @property {number} delta
 * @property {"UP"|"DOWN"} direction
 * @property {number} confidence 0-1
 */

/**
 * Phase1の暫定正規化：差分の絶対値をリファレンス値で割り、0-1にクランプするだけの単純なモデル。
 * @param {number} absDelta
 */
function normalizeConfidence(absDelta) {
  return Math.min(1, absDelta / CONFIDENCE_REFERENCE_SCALE);
}

/**
 * @param {Record<string, number>} sessionRawTrait
 * @param {import('./playerProfile.js').PlayerProfile} profile 今回のセッションを反映する「前」の状態であること
 * @returns {TraitDelta[]}
 */
export function calculateTraitDeltas(sessionRawTrait, profile) {
  return TRAIT_KEYS.map((key) => {
    const delta = sessionRawTrait[key] - profile.averageTrait[key];
    return {
      key,
      delta,
      direction: delta >= 0 ? 'UP' : 'DOWN',
      confidence: normalizeConfidence(Math.abs(delta)),
    };
  });
}

/**
 * @typedef {Object} SelfRelation
 * @property {"BASELINE"|"STABLE"|"EVOLVING"|"EXPLORING"} state
 * @property {string} [dominantTrait]
 * @property {"UP"|"DOWN"} [direction]
 * @property {number} [confidence] 判定品質（この状態だとどれだけ確信できるか）。Phase1ではdeltaMagnitudeから暫定算出、
 *   Phase2ではPlayerProfileの分散（Welford法）を使った統計的confidenceへ差し替え可能（D-0032）
 * @property {number} [deltaMagnitude] 主導特性の生の変化量（絶対値）。演出用のintensity算出に使う（D-0032）。
 *   confidenceとは責務が異なる別フィールドとして持つ（Phase1では同じ元データから算出されるため値は相関するが、
 *   Phase2で confidence が分散ベースに変わってもdeltaMagnitude自体は変更不要）
 */

/**
 * @typedef {Object} MovementPattern
 * @property {TraitDelta[]} traitDeltas 全6特性のdelta/direction/confidence（D-0034）
 * @property {number} concentrationScore Gini係数（0-1）。abs(delta)の分布の不均等度。
 *   意味づけ（COHERENT/DIVERGENT等）はDiagnosis層の責務であり、ここでは判定しない（D-0036/D-0038）
 * @property {number} [top2Share] 補助デバッグ値。上位2特性のabs(delta)が全体に占める割合（D-0038）。
 *   Diagnosis層の判定には使わない、開発時の目視確認用
 */

/**
 * abs(delta)の分布に対するGini係数を計算する。値が大きいほど少数の特性に変化が集中していることを示す
 * （D-0038：Top2/Top3/HHIとの比較検証の結果、飽和せず単調に反応する指標として採用）。
 * @param {number[]} absDeltas
 * @returns {number}
 */
function giniCoefficient(absDeltas) {
  const n = absDeltas.length;
  const total = absDeltas.reduce((a, b) => a + b, 0);
  if (total === 0) return 0;
  const sorted = [...absDeltas].sort((a, b) => a - b);
  let sumOfDiffs = 0;
  for (let i = 0; i < n; i++) {
    for (let j = 0; j < n; j++) {
      sumOfDiffs += Math.abs(sorted[i] - sorted[j]);
    }
  }
  return sumOfDiffs / (2 * n * total);
}

/**
 * 上位2特性のabs(delta)が全体に占める割合。補助デバッグ値（D-0038）。
 * @param {number[]} absDeltas
 * @returns {number}
 */
function calculateTop2Share(absDeltas) {
  const total = absDeltas.reduce((a, b) => a + b, 0);
  if (total === 0) return 0;
  const sorted = [...absDeltas].sort((a, b) => b - a);
  return (sorted[0] + sorted[1]) / total;
}

/**
 * RawTrait → TraitDelta → MovementPattern（構造情報のみ、意味づけなし）。
 * dominantTraitsは持たない（D-0039）。特性を名指しする必要がある場合はDiagnosis層がtraitDeltasから
 * 都度抽出する。
 * @param {Record<string, number>} sessionRawTrait
 * @param {import('./playerProfile.js').PlayerProfile} profile 今回のセッションを反映する「前」の状態であること
 * @returns {MovementPattern}
 */
export function calculateMovementPattern(sessionRawTrait, profile) {
  const traitDeltas = calculateTraitDeltas(sessionRawTrait, profile);
  const absDeltas = traitDeltas.map((d) => Math.abs(d.delta));
  return {
    traitDeltas,
    concentrationScore: giniCoefficient(absDeltas),
    top2Share: calculateTop2Share(absDeltas),
  };
}

/**
 * RawTrait → TraitDelta → SelfRelation。Stage1（自己相対比較のみ）。
 * @param {Record<string, number>} sessionRawTrait
 * @param {import('./playerProfile.js').PlayerProfile} profile
 * @returns {SelfRelation}
 */
export function calculateSelfRelation(sessionRawTrait, profile) {
  if (profile.playCount === 0) {
    return { state: 'BASELINE' };
  }

  const deltas = calculateTraitDeltas(sessionRawTrait, profile);
  const sorted = [...deltas].sort((a, b) => b.confidence - a.confidence);
  const top = sorted[0];
  const second = sorted[1];
  const topDeltaMagnitude = Math.abs(top.delta);

  if (top.confidence < STABLE_CONFIDENCE_THRESHOLD) {
    return { state: 'STABLE', deltaMagnitude: topDeltaMagnitude };
  }
  if (second && top.confidence - second.confidence < EXPLORING_GAP_THRESHOLD) {
    return { state: 'EXPLORING', confidence: top.confidence, deltaMagnitude: topDeltaMagnitude };
  }
  return {
    state: 'EVOLVING',
    dominantTrait: top.key,
    direction: top.direction,
    confidence: top.confidence,
    deltaMagnitude: topDeltaMagnitude,
  };
}
