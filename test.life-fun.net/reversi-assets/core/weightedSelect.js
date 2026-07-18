// 占い結果の組み合わせ生成で共通利用する、重み付き選択のユーティリティ。
// aisho.php の $wpfx 関数（プレゼント接頭語を70%/20%/10%の重みで選ぶ仕組み）と同じ思想をJSへ移植したもの。
// 一言アドバイス・ラッキーカラー・ラッキーアイテムのいずれもこの関数を共通で使う（ロジックの重複を避ける）。

/**
 * @typedef {Object} WeightedTier
 * @property {number} weight 0〜1。全tierのweight合計は1になるようにする
 * @property {string[]} pool
 */

/**
 * プールから乱数で1件選ぶ。
 * @param {string[]} pool
 * @param {() => number} rng 0以上1未満の乱数を返す関数（rng.jsのdefaultRng等）
 * @returns {string}
 */
export function pickOne(pool, rng) {
  return pool[Math.floor(rng() * pool.length)];
}

/**
 * 重み付き複数階層（例：日常系80%／特別感系20%）から、まず階層を確率で選び、その階層内から1件選ぶ。
 * @param {WeightedTier[]} tiers
 * @param {() => number} rng
 * @returns {string}
 */
export function pickFromTiers(tiers, rng) {
  const r = rng();
  let cumulative = 0;
  for (const tier of tiers) {
    cumulative += tier.weight;
    if (r < cumulative) return pickOne(tier.pool, rng);
  }
  // 浮動小数の丸め誤差でどのtierにも該当しなかった場合のフォールバック
  return pickOne(tiers[tiers.length - 1].pool, rng);
}
