// Java版 com.oserofortune.core.ObservationId / Observation / ObservationLog の移植。

/** OBSERVATIONS.mdで定義された観測事実のID。アイテム関連（OBS-007〜010）はPhase1a.6の範囲外のため未実装。 */
export const ObservationId = Object.freeze({
  OBS_001_CORNER_CAPTURED: 'OBS_001_CORNER_CAPTURED',
  OBS_002_CORNER_LOST: 'OBS_002_CORNER_LOST',
  OBS_003_RISKY_MOVE: 'OBS_003_RISKY_MOVE',
  OBS_004_LONG_THINK: 'OBS_004_LONG_THINK',
  OBS_005_QUICK_DECISION: 'OBS_005_QUICK_DECISION',
  OBS_006_PASS: 'OBS_006_PASS',
  OBS_011_BAD_MOVE: 'OBS_011_BAD_MOVE',
  OBS_012_GOOD_MOVE: 'OBS_012_GOOD_MOVE',
  OBS_013_ENDGAME_REVERSAL: 'OBS_013_ENDGAME_REVERSAL',
  OBS_014_STRATEGY_CONSISTENT: 'OBS_014_STRATEGY_CONSISTENT',
  OBS_015_STRATEGY_CHANGED: 'OBS_015_STRATEGY_CHANGED',
  OBS_016_STABLE_STONE_GAINED: 'OBS_016_STABLE_STONE_GAINED',
});

export class Observation {
  /**
   * @param {string} id
   * @param {number} moveNumber
   * @param {number} [magnitude] 段階(Tiny〜Critical)の基準値に乗じる倍率。通常は1.0。
   */
  constructor(id, moveNumber, magnitude = 1.0) {
    this.id = id;
    this.moveNumber = moveNumber;
    this.magnitude = magnitude;
  }
}

export class ObservationLog {
  constructor() {
    /** @type {Observation[]} */
    this.entries = [];
  }

  /**
   * @param {string} id
   * @param {number} moveNumber
   * @param {number} [magnitude]
   */
  record(id, moveNumber, magnitude = 1.0) {
    this.entries.push(new Observation(id, moveNumber, magnitude));
  }

  count(id) {
    return this.entries.filter((o) => o.id === id).length;
  }
}
