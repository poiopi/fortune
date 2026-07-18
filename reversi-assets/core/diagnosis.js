// Deprecated by D-0064（D-0066で明文化）。
// 本番の描画フロー（web/ui/controller.js）からは呼ばれていない。Phase 3のプレイテスト結果を見て、
// D-0066以降の別エントリで削除するかどうかを判断するまで、比較・ロールバック用として一時的に残す。
//
// Q-024/D-0043/D-0044/D-0062対応：Diagnosis層のオーケストレーション。数値計算（diagnosisBands.js）・
// 文言（diagnosisTemplates.js）を一切持たず、SelfRelationとMovementPatternを受け取って両者を
// 合成するだけの層とする（D-0028：事実はRelationshipModel、解釈・文章化はDiagnosis層）。

import { DEFAULT_BAND_EDGES, bandOf } from './diagnosisBands.js';
import { TEMPLATE_SETS, resolveTemplateSet, pickTemplateIndex } from './diagnosisTemplates.js';

/**
 * @typedef {Object} DiagnosisConfig
 * @property {typeof TEMPLATE_SETS} templateSets
 * @property {import('./diagnosisBands.js').BandEdges} bandEdges
 */

export const DEFAULT_DIAGNOSIS_CONFIG = {
  templateSets: TEMPLATE_SETS,
  bandEdges: DEFAULT_BAND_EDGES,
};

/**
 * @typedef {Object} DiagnosisResult
 * @property {string} text 診断文
 * @property {"BASELINE"|"STABLE"|"EVOLVING"|"EXPLORING"} state 元になったSelfRelation.state
 * @property {number} [band] 0-4。BASELINEは未定義
 * @property {number} [concentrationScore] band算出に使ったMovementPattern.concentrationScore生値。BASELINEは未定義
 * @property {string} [bandEdgesSourceLabel] 使用したband境界値の出自（config.bandEdges.sourceLabel、D-0044）。BASELINEは未定義
 * @property {number} templateIndex 選ばれたテンプレートセット内のインデックス（D-0062：直前と同じ文を
 *   避けるため、呼び出し元がavoidIndexとして次回に渡せるよう返す）
 */

/**
 * SelfRelation（D-0028）とMovementPattern（D-0039/D-0040）から診断結果を生成する。
 * configを注入すればband境界値・テンプレートセットを差し替えて比較できる（D-0026のNormalizer比較と同型）。
 * 呼び出し元がband・concentrationScore等のメタ情報を再計算（二重計算）しなくて済むよう、
 * diagnosis.js自身が使った値をそのままDiagnosisResultへ含めて返す（D-0046）。
 * @param {import('./relationshipModel.js').SelfRelation} selfRelation
 * @param {import('./relationshipModel.js').MovementPattern} movementPattern
 * @param {Object} [ctx] base関数に渡す補助情報（例：{traitName, direction}）
 * @param {DiagnosisConfig} [config]
 * @param {Object} [options]
 * @param {number} [options.avoidIndex] 直前に選ばれたテンプレートインデックス（あれば避ける、D-0062）
 * @param {() => number} [options.rng] 0以上1未満の乱数を返す関数。テスト時は差し替え可能
 * @returns {DiagnosisResult}
 */
export function generateDiagnosis(selfRelation, movementPattern, ctx = {}, config = DEFAULT_DIAGNOSIS_CONFIG, options = {}) {
  if (selfRelation.state === 'BASELINE') {
    const set = resolveTemplateSet('BASELINE', undefined, config.templateSets);
    const index = pickTemplateIndex(set.length, options.avoidIndex, options.rng);
    const entry = set[index];
    return { text: `${entry.base(ctx)}${entry.modifier}`, state: selfRelation.state, templateIndex: index };
  }

  const band = bandOf(movementPattern.concentrationScore, config.bandEdges.edges);
  const set = resolveTemplateSet(selfRelation.state, band, config.templateSets);
  const index = pickTemplateIndex(set.length, options.avoidIndex, options.rng);
  const entry = set[index];
  return {
    text: `${entry.base(ctx)}${entry.modifier}`,
    state: selfRelation.state,
    band,
    concentrationScore: movementPattern.concentrationScore,
    bandEdgesSourceLabel: config.bandEdges.sourceLabel,
    templateIndex: index,
  };
}
