// Java版 com.oserofortune.core.Traits / TraitCalculator の移植。
// Q-015対応：Raw集計（何が起きたか）と表示用への正規化（どう見せるか）を分離した。
// Normalizerは差し替え可能（normalizers.js参照）。人間プレイデータが揃うまで最終方式は確定しない。

import { ObservationId } from './observation.js';
import { DEFAULT_NORMALIZER } from './normalizers.js';

/**
 * @typedef {Object} Traits
 * @property {number} initiative
 * @property {number} patience
 * @property {number} logic
 * @property {number} adaptability
 * @property {number} courage
 * @property {number} stability
 */

/** @returns {Traits} */
function emptyTraits() {
  return { initiative: 0, patience: 0, logic: 0, adaptability: 0, courage: 0, stability: 0 };
}

// 暫定の段階→数値マッピング。根拠となる実データはまだない（EVENTS.md「未確定・要検証」参照）。
const TINY = 1;
const SMALL = 2;
const MEDIUM = 4;
const LARGE = 7;
const CRITICAL = 12;

/**
 * EVENTS.mdの対応表をそのままコード化したもの。Java版TraitCalculatorと同一ロジック（D-0016/D-0017の修正込み）。
 * クランプ・正規化は一切行わない、生の集計値（Raw Trait）を返す。
 * @param {import('./observation.js').ObservationLog} log
 * @returns {Traits}
 */
export function calculateRawTraits(log) {
  const t = emptyTraits();
  for (const o of log.entries) {
    switch (o.id) {
      case ObservationId.OBS_001_CORNER_CAPTURED:
        t.stability += LARGE;
        t.initiative += SMALL;
        break;
      case ObservationId.OBS_002_CORNER_LOST:
        // EVENTS.md: 相手の成功であり、OBS-011(悪手)との二重計上を避けるため変換しない
        break;
      case ObservationId.OBS_003_RISKY_MOVE:
        t.courage += LARGE;
        break;
      case ObservationId.OBS_004_LONG_THINK:
        t.patience += MEDIUM;
        break;
      case ObservationId.OBS_005_QUICK_DECISION:
        t.initiative += SMALL;
        break;
      case ObservationId.OBS_006_PASS:
        t.patience += MEDIUM;
        break;
      case ObservationId.OBS_011_BAD_MOVE:
        // Q-012対応：段階(Small)を基準値とし、局面難易度で正規化したmagnitudeを乗じる
        t.logic -= SMALL * o.magnitude;
        break;
      case ObservationId.OBS_012_GOOD_MOVE:
        t.logic += SMALL * o.magnitude;
        break;
      case ObservationId.OBS_013_ENDGAME_REVERSAL:
        t.courage += MEDIUM;
        t.adaptability += MEDIUM;
        break;
      case ObservationId.OBS_014_STRATEGY_CONSISTENT:
        // Q-011対応：OBS-011/012と同じくmagnitude（難易度正規化）を乗じる
        t.stability += MEDIUM * o.magnitude;
        break;
      case ObservationId.OBS_015_STRATEGY_CHANGED:
        t.adaptability += LARGE;
        break;
      case ObservationId.OBS_016_STABLE_STONE_GAINED:
        t.stability += MEDIUM;
        break;
      default:
        break;
    }
  }
  return t;
}

/**
 * Raw Traitを、指定したNormalizerで表示用0-100値に変換する。
 * @param {Traits} raw
 * @param {{normalize: (raw: number, key: string) => number}} [normalizer]
 * @returns {Traits}
 */
export function normalizeTraits(raw, normalizer = DEFAULT_NORMALIZER) {
  const out = emptyTraits();
  for (const key of Object.keys(out)) {
    out[key] = normalizer.normalize(raw[key], key);
  }
  return out;
}

/**
 * Observationログから表示用Traitを算出する（Raw集計＋正規化を一括で行う従来通りのAPI）。
 * normalizerを省略した場合はDEFAULT_NORMALIZER（現行のLinear方式、D-0016時点と同一の挙動）を使う。
 * @param {import('./observation.js').ObservationLog} log
 * @param {{normalize: (raw: number, key: string) => number}} [normalizer]
 * @returns {Traits}
 */
export function calculateTraits(log, normalizer = DEFAULT_NORMALIZER) {
  return normalizeTraits(calculateRawTraits(log), normalizer);
}
