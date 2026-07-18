// Deprecated by D-0064（D-0066で明文化）。
// 本番の描画フロー（web/ui/controller.js）からは呼ばれていない。Phase 3のプレイテスト結果を見て、
// D-0066以降の別エントリで削除するかどうかを判断するまで、比較・ロールバック用として一時的に残す。
//
// Q-024/D-0044対応：concentrationScore（Gini係数、連続値）を、Diagnosis層のテンプレート選択に使う
// 5段階バンド(0〜4)へ変換する。境界値は「アルゴリズム」と「特定コーパスに対する計算結果」を分離し、
// 差し替え可能な形で注入する（D-0026のNormalizerパターンと同型）。
//
// Q-019の教訓（D-0044）：暫定値が調整しづらくなった原因は(a)出自が未記録、(b)再計算スクリプトが
// 後付け、(c)関数内へのハードコード、の3点。ここではこの3点を最初から解消する。

/**
 * @typedef {Object} BandEdges
 * @property {number[]} edges 昇順4値。5段階(0-4)の境界（percentile相当）
 * @property {string} sourceLabel 値の出自（どのコーパス・いつ・どのスクリプトで算出したか）
 */

// 出自：Bot16種×200局（n=3184）、2026-07-14、web/sim/calculateDiagnosisBandEdges.mjs で算出。
// 人間データが集まった段階（Q-025、現状スコープ外）で同スクリプトを再実行し、この配列を置き換えること。
// analyzeBandEdgeStability.mjsの検証により、コーパスの構成（サイズ・Botの傾向）が変わると境界値も
// 動くことが確認済み（最大0.024のズレ、隣接境界の間隔0.05〜0.06に対して無視できない大きさ）。
// この値は固定的な正解ではなく、現時点でのBotコーパスに基づく初期値として扱うこと。
export const DEFAULT_BAND_EDGES = {
  edges: [0.396, 0.45, 0.496, 0.556],
  sourceLabel: 'bot-corpus-16bots-200games-2026-07-14',
};

/**
 * 値の配列から昇順4値の境界（20/40/60/80パーセンタイル相当）を算出する純粋関数。
 * web/sim/calculateDiagnosisBandEdges.mjs（再計算スクリプト）と本体実装の両方から呼ばれる、
 * 唯一の境界値算出ロジック（D-0044 決定1-2：重複コピーを避け1箇所に統合する）。
 * @param {number[]} values
 * @param {number[]} [percentiles] 0-1の昇順4値。省略時は20/40/60/80%
 * @returns {number[]} 昇順4値
 */
export function computeBandEdges(values, percentiles = [0.2, 0.4, 0.6, 0.8]) {
  const sorted = [...values].sort((a, b) => a - b);
  const n = sorted.length;
  return percentiles.map((p) => sorted[Math.min(n - 1, Math.floor(n * p))]);
}

/**
 * concentrationScore（0-1）を、境界値に基づき0〜4のバンド番号へ変換する。
 * 境界値は引数で注入可能（デフォルトは省略時にDEFAULT_BAND_EDGES）。
 * @param {number} score
 * @param {number[]} [edges] 昇順4値。省略時はDEFAULT_BAND_EDGES.edges
 * @returns {number} 0-4
 */
export function bandOf(score, edges = DEFAULT_BAND_EDGES.edges) {
  let band = 0;
  for (const edge of edges) {
    if (score >= edge) band += 1;
  }
  return band;
}
