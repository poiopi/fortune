// Q-026対応：Diagnosis文中に特性名を差し込むための、Diagnosis専用の語彙辞書。
//
// GLOSSARY.md（UI表示名、「熟考タイプ」等のバッジ的な名詞）とは別に、文章の中で自然に活用できる
// 表現をここに持つ（本人指摘：GLOSSARYはUI辞書、Diagnosisは文章辞書という二段構え）。
// GLOSSARY.mdのUI表示名自体は変更しない。
//
// Patience/Courageの語はGLOSSARY.mdのQ-016検証結果（熟考タイプ／度胸）と整合させ、「慎重」等の
// Q-016で避けた語には戻さない。Initiative/Logic/Adaptability/StabilityはTRAITS.mdの仮候補をそのまま
// 採用した未検証の値であり、人間プレイテストでの反応を見て見直す前提。
export const DIAGNOSIS_TRAIT_TEXT = {
  initiative: '切り開く力',
  patience: '熟考',
  logic: '見通す力',
  adaptability: '見直す力',
  courage: '度胸',
  stability: '貫く力',
};
