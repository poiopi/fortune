// D-0064：「おすすめ占い」はMovementPatternを使った内部ロジックの担当領域だが、
// Phase 2は最小実装としてHighlight Traitからの固定マッピングにとどめる（本人指示：UI先行、Q-030）。
// より精緻な選定（MovementPattern・SelfRelation活用）はPhase 3以降、人間プレイの反応を見てから検討する。
//
// hrefは仮のパス。実際にlife-fun.net配下へ統合する際に正式なURLへ差し替える（本ファイルはosero-fortune側の
// プロトタイプであり、fortuneリポジトリの実ページ構成とはまだ接続していない）。

export const RECOMMENDATIONS_BY_TRAIT = {
  initiative: [
    { label: '相性占い', href: '/aisho.php' },
    { label: '九星気学', href: '/kyusei.php' },
  ],
  patience: [
    { label: '算命学', href: '/sanmei.php' },
    { label: '相性占い', href: '/aisho.php' },
  ],
  logic: [
    { label: '算命学', href: '/sanmei.php' },
    { label: '九星気学', href: '/kyusei.php' },
  ],
  adaptability: [
    { label: '相性占い', href: '/aisho.php' },
    { label: '算命学', href: '/sanmei.php' },
  ],
  courage: [
    { label: 'タロット占い', href: '/tarot.php' },
    { label: '相性占い', href: '/aisho.php' },
  ],
  stability: [
    { label: '算命学', href: '/sanmei.php' },
    { label: '九星気学', href: '/kyusei.php' },
  ],
};

/** @param {string} traitKey @returns {{label: string, href: string}[]} */
export function recommendationsFor(traitKey) {
  return RECOMMENDATIONS_BY_TRAIT[traitKey] ?? RECOMMENDATIONS_BY_TRAIT.stability;
}
