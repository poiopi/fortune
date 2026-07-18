// Q-004続き（FortuneIndex）：SelfRelation → FortuneIndex。
// D-0031：FortuneIndexはPersonalityの評価値ではなく、SelfRelationを「今日の運勢」として演出するための
// 中間モデル。Traitの優劣（Courageが上がった＝良い、等）は一切持ち込まない。
// D-0032：intensity（演出用の変化の大きさ）とconfidence（判定品質）は責務を分離する。Phase1では両方とも
// SelfRelation.deltaMagnitudeという同じ元データに由来するため値は相関するが、Phase2でconfidenceが
// 分散ベースに差し替わってもintensity・FortuneIndexのAPI自体は変更不要な設計にする。

/** SelfRelation.state → FortunePhase の1対1対応。isBaselineのようなフラグを別途持たない（状態の二重管理を避ける）。 */
const STATE_TO_PHASE = {
  BASELINE: 'beginning', // 今日から物語が始まる
  STABLE: 'steady', // 流れが安定している
  EVOLVING: 'change', // 新しい流れが生まれている
  EXPLORING: 'challenge', // 試行錯誤・未知への挑戦
};

// Phase1の暫定値。根拠となる実データはまだない（Q-019/Q-020と同様、人間データで調整する前提）。
const INTENSITY_REFERENCE_SCALE = 15; // confidenceの算出（relationshipModel.js）と同じ量から来ているため
// 暫定的に同じ値を使うが、責務分離のため独立した定数として管理する（Phase2で変更不要にするため）。
const DEFAULT_INTENSITY_BASELINE = 1.0; // 初回は比較対象がなく、今回の体験そのものが「満点」の演出強度
const DEFAULT_CONFIDENCE_BASELINE = 1.0; // 初回は「これが基準」という点に迷いがないため高信頼扱い
const DEFAULT_CONFIDENCE_STABLE = 0.7;

/**
 * @typedef {Object} FortuneIndex
 * @property {"beginning"|"steady"|"change"|"challenge"} phase 診断文用
 * @property {number} intensity 0-1、演出の強さ（UI用：ゲージ・円グラフ等）
 * @property {number} confidence 0-1、判定品質（この状態にどれだけ確信を持てるか）
 */

/**
 * @param {import('./relationshipModel.js').SelfRelation} selfRelation
 * @returns {FortuneIndex}
 */
export function calculateFortuneIndex(selfRelation) {
  const phase = STATE_TO_PHASE[selfRelation.state];

  const intensity =
    selfRelation.deltaMagnitude !== undefined
      ? Math.min(1, selfRelation.deltaMagnitude / INTENSITY_REFERENCE_SCALE)
      : DEFAULT_INTENSITY_BASELINE;

  let confidence;
  if (selfRelation.confidence !== undefined) {
    confidence = selfRelation.confidence;
  } else if (selfRelation.state === 'BASELINE') {
    confidence = DEFAULT_CONFIDENCE_BASELINE;
  } else {
    confidence = DEFAULT_CONFIDENCE_STABLE;
  }

  return { phase, intensity, confidence };
}
