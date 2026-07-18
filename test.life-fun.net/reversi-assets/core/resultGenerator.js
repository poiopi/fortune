// 占い結果（総合運%/一言アドバイス/ラッキーカラー/ラッキーアイテム）の生成ロジック。
// コンテンツデータ（content/配下）とロジック（このファイル）を分離してあるため、語彙・文章の追加は
// content/配下のファイルを編集するだけでよく、このファイルを触る必要はない。
//
// 論点⑨〜⑬（docs/DECISIONS.md反映待ち、project memory: project_reversi_love_gameに詳細）で確定した設計：
//   SelfRelation.state × FortuneIndex.intensity（弱/強に丸める）→ 8バケツ → 占い結果へ翻訳
// FortuneIndex.confidenceはPhase1では未使用（Q-019が未解決の暫定値のため）。
//
// D-0073：総合運%は`FORTUNE_SCORE_BASE + FORTUNE_SCORE_RANGE × intensity`の線形写像で算出する。
// intensity自体の式（Q-019、INTENSITY_REFERENCE_SCALE）には手を入れない。intensity=1.0が高頻度で
// 発生し同一スコアに集中することは確認済みだが、Botコーパス2400局で「score+advice+color+item」の
// 完全一致が0件だったため、UX上のテンプレ感には直結しないと判断した（詳細はD-0073参照）。

import { BODY_POOL, CLOSING_POOL } from './content/adviceContent.js';
import { COLOR_MODIFIER_TIERS, COLOR_NAMES } from './content/colorContent.js';
import { ITEM_MODIFIER_TIERS, ITEM_NAMES } from './content/itemContent.js';
import { pickOne, pickFromTiers } from './weightedSelect.js';
import { defaultRng } from './rng.js';

/** intensity(0.0-1.0の連続値)を弱/強の2段階に丸める。将来3段階等に拡張する場合はこの関数だけ変更すればよい。 */
function intensityToBand(intensity) {
  return intensity < 0.5 ? 'WEAK' : 'STRONG';
}

// D-0073：総合運%の基準値・振れ幅。名前付き定数として切り出し、将来Q-019でintensity側の式を
// 見直した際に、ここだけの調整で済むようにする（数式本体にマジックナンバーを埋め込まない）。
const FORTUNE_SCORE_BASE = 58;
const FORTUNE_SCORE_RANGE = 32;

/**
 * @param {import('./fortuneIndex.js').FortuneIndex} fortuneIndex
 * @returns {number}
 */
export function calculateFortuneScore(fortuneIndex) {
  return Math.round(FORTUNE_SCORE_BASE + FORTUNE_SCORE_RANGE * fortuneIndex.intensity);
}

function bodyPoolKey(state, band) {
  return `${state}_${band}`;
}

/**
 * @param {import('./relationshipModel.js').SelfRelation} selfRelation
 * @param {import('./fortuneIndex.js').FortuneIndex} fortuneIndex
 * @param {() => number} [rng]
 * @returns {string}
 */
export function generateAdvice(selfRelation, fortuneIndex, rng = defaultRng) {
  const band = intensityToBand(fortuneIndex.intensity);
  const key = bodyPoolKey(selfRelation.state, band);
  const body = BODY_POOL[key];
  if (!body) {
    throw new Error(`BODY_POOLに該当バケツがありません: ${key}`);
  }
  const bodyLine = pickOne(body, rng);
  const closing = pickOne(CLOSING_POOL[band], rng);
  return `${bodyLine} ${closing}`;
}

/**
 * @param {() => number} [rng]
 * @returns {string}
 */
export function generateLuckyColor(rng = defaultRng) {
  const modifier = pickFromTiers(COLOR_MODIFIER_TIERS, rng);
  const color = pickOne(COLOR_NAMES, rng);
  return `${modifier}${color}`;
}

/**
 * @param {() => number} [rng]
 * @returns {string}
 */
export function generateLuckyItem(rng = defaultRng) {
  const modifier = pickFromTiers(ITEM_MODIFIER_TIERS, rng);
  const item = pickOne(ITEM_NAMES, rng);
  return `${modifier}${item}`;
}

/**
 * @typedef {Object} FortuneResult
 * @property {number} score 総合運%（0-100、D-0073：`FORTUNE_SCORE_BASE + FORTUNE_SCORE_RANGE × intensity`）
 * @property {string} advice
 * @property {string} luckyColor
 * @property {string} luckyItem
 */

/**
 * 総合運%・一言アドバイス・ラッキーカラー・ラッキーアイテムをまとめて生成する（D-0073でQ-020確定）。
 * @param {import('./relationshipModel.js').SelfRelation} selfRelation
 * @param {import('./fortuneIndex.js').FortuneIndex} fortuneIndex
 * @param {() => number} [rng]
 * @returns {FortuneResult}
 */
export function generateFortuneResult(selfRelation, fortuneIndex, rng = defaultRng) {
  return {
    score: calculateFortuneScore(fortuneIndex),
    advice: generateAdvice(selfRelation, fortuneIndex, rng),
    luckyColor: generateLuckyColor(rng),
    luckyItem: generateLuckyItem(rng),
  };
}
