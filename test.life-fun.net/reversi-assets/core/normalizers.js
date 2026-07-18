// Q-015対応：RawTrait（生の集計値）→表示用0-100値への変換を、差し替え可能な戦略として切り出す。
// 「原因調査中はWeight調整をしない」という方針と同じく、Normalizerの最終決定も人間プレイデータが
// 揃うまで確定しない。ここでは複数の実装を用意し、同じ生データに対して比較できるようにする。

function clampValue(v) {
  return Math.max(0, Math.min(100, v));
}

// 現状のTraitCalculatorと同じ既定オフセット。Logicだけ+50（BAD_MOVEの減点で負に振れるため）、他は0。
const DEFAULT_OFFSETS = {
  initiative: 0,
  patience: 0,
  logic: 50,
  adaptability: 0,
  courage: 0,
  stability: 0,
};

/**
 * 現行方式：raw + オフセット を 0-100 にクランプするだけの単純な線形正規化。
 * D-0016以前からの実装と完全に同じ挙動（デフォルトNormalizer、当面の表示式）。
 */
export function createLinearNormalizer(offsets = DEFAULT_OFFSETS) {
  return {
    name: 'linear',
    normalize(raw, key) {
      return clampValue(raw + (offsets[key] ?? 0));
    },
  };
}

/**
 * シグモイド変換：100 / (1 + e^(-raw/k))。
 * どんなに極端な生の値でも理論上0/100に完全到達しないため、識別能力（Q-015）の低下を避けられる可能性がある。
 * kは傾きの調整パラメータ（大きいほど緩やか）。
 */
export function createSigmoidNormalizer(k = 30) {
  return {
    name: `sigmoid(k=${k})`,
    normalize(raw) {
      return 100 / (1 + Math.exp(-raw / k));
    },
  };
}

/**
 * Min-Max正規化：観測された生の値の実際の範囲を[0,100]へ線形マッピングする。
 * ranges: { [traitKey]: { min, max } }。範囲外にクランプする。
 * 実データの分布に強く依存するため、Bot構成やWeightを変えるたびに再キャリブレーションが必要になる。
 */
export function createMinMaxNormalizer(ranges) {
  return {
    name: 'minmax',
    normalize(raw, key) {
      const r = ranges[key];
      if (!r || r.max === r.min) return clampValue(raw);
      return clampValue(((raw - r.min) / (r.max - r.min)) * 100);
    },
  };
}

// 現行の表示式（D-0016時点のTraitCalculatorと同一の挙動）。当面はこれをデフォルトのまま使う。
export const DEFAULT_NORMALIZER = createLinearNormalizer();
