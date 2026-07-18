// Deprecated by D-0064（D-0066で明文化）。
// 本番の描画フロー（web/ui/controller.js）からは呼ばれていない。Phase 3のプレイテスト結果を見て、
// D-0066以降の別エントリで削除するかどうかを判断するまで、比較・ロールバック用として一時的に残す。
//
// Q-024/D-0043/D-0044対応：SelfRelation.state × concentrationBand の文章化テンプレート。
//
// D-0062：テンプレートセット方式。state×bandの単位ごとに、自己完結した{base, modifier}のペアを
// 複数（テンプレートセット）持ち、実行時にセット単位で1つ選ぶ。異なるセットのbaseとmodifierを
// 組み合わせることはしない（本人方針）。「ベース×修飾を独立に組み合わせて多様性を作る」設計（D-0043の
// 案Yの発展形）は不採用とした。理由：組み合わせ次第で読んだときに不自然な接続が生まれるリスクがあり、
// 「自然に読めること」を優先するため。
//
// DEFAULT_MODIFIER_TEXTはband単位の共通修飾文言（唯一のソース）。専用の複数バリエーションを用意して
// いないstate×bandは、baseはstate固有・modifierはDEFAULT_MODIFIER_TEXTを使う1要素セットにフォールバック
// する（D-0051：EXPLORING専用オーバーライドは「必要最小限の例外」に限定する、という考え方を踏襲）。
//
// Q-027対応（D-0049〜D-0051）：concentrationScoreは「特性間の変化の集中度」という構造的事実のみを表し、
// 「方向性」「戦略性」「意図」を意味しない。この境界に反する表現（「方向の定まらない」「特定の方向へ
// 向かっている」等、集中度から方向性・確信を導く言い回し）は採用しない。

/**
 * @typedef {Object} TemplateSetEntry
 * @property {(ctx: Object) => string} base
 * @property {string} modifier
 */

const BASELINE_BASE = () => '今日の一局は、あなたの心の動きを読み解くための最初の記録です。';
const STABLE_BASE = () => '大きな変化はなく、これまでの傾向を維持しています';
const EVOLVING_BASE = (ctx = {}) =>
  `${ctx.traitName ?? 'ある特性'}が${ctx.direction === 'DOWN' ? '控えめになって' : '伸びて'}きています`;
const EXPLORING_BASE = () => '様々な形を試しながら、変化を模索しています';

// band単位の共通修飾文言（唯一のソース）。専用セットを持たないstate×bandはここから1要素セットを作る。
const DEFAULT_MODIFIER_TEXT = {
  0: '。今日の選択には、一つに定まらない動きが見られました',
  1: '。いくつかの要素にまたがって変化しています',
  2: '',
  3: '。特定の要素を中心に変化しています',
  4: '。一つの要素に集中して変化しています',
};

/** @returns {TemplateSetEntry[]} */
function defaultSet(baseFn, band) {
  return [{ base: baseFn, modifier: DEFAULT_MODIFIER_TEXT[band] }];
}

/** state×band → テンプレートセット（TemplateSetEntry[]）。 */
export const TEMPLATE_SETS = {
  BASELINE: [{ base: BASELINE_BASE, modifier: '' }],
  STABLE: {
    0: defaultSet(STABLE_BASE, 0),
    1: defaultSet(STABLE_BASE, 1),
    2: defaultSet(STABLE_BASE, 2),
    3: defaultSet(STABLE_BASE, 3),
    4: defaultSet(STABLE_BASE, 4),
  },
  EVOLVING: {
    0: defaultSet(EVOLVING_BASE, 0),
    1: defaultSet(EVOLVING_BASE, 1),
    2: defaultSet(EVOLVING_BASE, 2),
    3: defaultSet(EVOLVING_BASE, 3),
    4: defaultSet(EVOLVING_BASE, 4),
  },
  EXPLORING: {
    // D-0062：D-0060のプレイテストで最も頻繁に出現し、かつ「毎回同じ」という指摘が集中したband0のみ、
    // 3件の自己完結したセットを用意する。他のband0/1/2/3/4はdefaultSet（1要素）のまま。
    0: [
      {
        base: () => '様々な形を試しながら、変化を模索しています。',
        modifier: '今日の選択には、一つに定まらない動きが見られました。',
      },
      {
        base: () => 'まだ答えを決めず、いろいろ試している段階です。',
        modifier: '選択は一つに偏らず、少しずつ広がっています。',
      },
      {
        base: () => '今はいろいろな可能性を確かめているようです。',
        modifier: '今日の選択には幅のある変化が見られました。',
      },
    ],
    1: defaultSet(EXPLORING_BASE, 1),
    2: defaultSet(EXPLORING_BASE, 2),
    3: [{ base: EXPLORING_BASE, modifier: '。様々な変化が起きていますが、変化は一部の要素に集まりつつあります' }],
    4: [{ base: EXPLORING_BASE, modifier: '。今日の選択には、特に大きく動いた流れがありました' }],
  },
};

/**
 * state・bandに対応するテンプレートセットを取得する。
 * @param {string} state
 * @param {number|undefined} band BASELINEはundefined
 * @param {typeof TEMPLATE_SETS} [templateSets]
 * @returns {TemplateSetEntry[]}
 */
export function resolveTemplateSet(state, band, templateSets = TEMPLATE_SETS) {
  if (state === 'BASELINE') return templateSets.BASELINE;
  const table = templateSets[state] ?? templateSets.EXPLORING; // 未知stateへの最低限のフォールバック
  return table[band] ?? [{ base: () => '', modifier: '' }];
}

/**
 * テンプレートセットから1件を選ぶ。直前に選んだインデックス（avoidIndex）があり、かつセットが
 * 2件以上あれば、それを避けて選ぶ（本人方針：完全ランダムより「直前と同じ文を避ける」程度でよい）。
 * @param {number} setLength
 * @param {number} [avoidIndex]
 * @param {() => number} [rng] 0以上1未満の乱数を返す関数。テスト時は差し替え可能
 * @returns {number}
 */
export function pickTemplateIndex(setLength, avoidIndex, rng = Math.random) {
  if (setLength <= 1) return 0;
  let index = Math.floor(rng() * setLength);
  if (index === avoidIndex) {
    index = (index + 1) % setLength;
  }
  return index;
}
