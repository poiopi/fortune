<?php
declare(strict_types=1);

/**
 * inc/tarot-trait-mapping.php
 *
 * docs/tarot-trait-mapping.md（Rule ID: T001〜T044）の実体。
 * Mapping Table自体をこのPHP配列として持つ（単一の情報源）。
 * tarot-engine.phpのtraits計算・比較ツール・Coverageレポート・仕様書（docs/）は
 * すべてこの配列から生成・参照する。ここを直接書き換えたら、docs側も再生成する。
 *
 * スコア基準：+2 = カードの中心テーマ、+1 = 副次的テーマ
 * 全カードが必ず何らかのtraitへ寄与する必要はない。意味が薄い場合は空配列（寄与なし）を許容する
 * （T002・T031・T044 は寄与なしと判断した）。
 *
 * 各要素: ['id'=>string, 'keyword'=>string（根拠となった既存キーワード）, 'trait'=>string, 'score'=>int]
 */

require_once __DIR__ . '/trait-vocabulary.php';

const TAROT_TRAIT_MAPPING = [
    0 => [ // 愚者 The Fool
        'upright' => [
            ['id' => 'T001', 'keyword' => '新しい始まり・冒険', 'trait' => TRAIT_CHALLENGE, 'score' => 2],
        ],
        'reversed' => [], // T002: 寄与なし（無謀・準備不足は明確な傾向として断定しがたい）
    ],
    1 => [ // 魔術師 The Magician
        'upright' => [
            ['id' => 'T003', 'keyword' => '意志の力・現実化', 'trait' => TRAIT_ACTION, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T004', 'keyword' => '優柔不断', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
    ],
    2 => [ // 女教皇 The High Priestess
        'upright' => [
            ['id' => 'T005', 'keyword' => '直感・内なる知恵', 'trait' => TRAIT_INTUITION, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T006', 'keyword' => '秘密・感情の抑圧', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
    ],
    3 => [ // 女帝 The Empress
        'upright' => [
            ['id' => 'T007', 'keyword' => '豊かさ・愛・創造', 'trait' => TRAIT_PASSION, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T008', 'keyword' => '依存・過保護', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    4 => [ // 皇帝 The Emperor
        'upright' => [
            ['id' => 'T009', 'keyword' => '権威・秩序', 'trait' => TRAIT_DUTY, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T010', 'keyword' => '支配・頑固', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    5 => [ // 法王 The Hierophant
        'upright' => [
            ['id' => 'T011a', 'keyword' => '伝統・信念', 'trait' => TRAIT_DUTY, 'score' => 1],
            ['id' => 'T011b', 'keyword' => '伝統・信念', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T012', 'keyword' => '既成概念への反発', 'trait' => TRAIT_CHANGE, 'score' => 1],
        ],
    ],
    6 => [ // 恋人 The Lovers
        'upright' => [
            ['id' => 'T013', 'keyword' => '愛・選択・調和', 'trait' => TRAIT_PASSION, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T014', 'keyword' => '選択の困難', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
    ],
    7 => [ // 戦車 The Chariot
        'upright' => [
            ['id' => 'T015a', 'keyword' => '勝利・前進', 'trait' => TRAIT_ACTION, 'score' => 2],
            ['id' => 'T015b', 'keyword' => '勝利・前進', 'trait' => TRAIT_CHALLENGE, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T016', 'keyword' => '攻撃性・方向性の欠如', 'trait' => TRAIT_PASSION, 'score' => 1],
        ],
    ],
    8 => [ // 力 Strength
        'upright' => [
            ['id' => 'T017a', 'keyword' => '内なる強さ・忍耐', 'trait' => TRAIT_STABILITY, 'score' => 1],
            ['id' => 'T017b', 'keyword' => '内なる強さ・忍耐', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T018', 'keyword' => '自信の喪失・疑念', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
    ],
    9 => [ // 隠者 The Hermit
        'upright' => [
            ['id' => 'T019a', 'keyword' => '内省・知恵', 'trait' => TRAIT_INTUITION, 'score' => 1],
            ['id' => 'T019b', 'keyword' => '内省・知恵', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T020', 'keyword' => '孤立・頑固', 'trait' => TRAIT_INDEP, 'score' => 1],
        ],
    ],
    10 => [ // 運命の輪 Wheel of Fortune
        'upright' => [
            ['id' => 'T021', 'keyword' => '転機・変化', 'trait' => TRAIT_CHANGE, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T022', 'keyword' => '変化への抵抗', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    11 => [ // 正義 Justice
        'upright' => [
            ['id' => 'T023', 'keyword' => '公正・バランス', 'trait' => TRAIT_DUTY, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T024', 'keyword' => '責任逃れ', 'trait' => TRAIT_INDEP, 'score' => 1],
        ],
    ],
    12 => [ // 吊られた男 The Hanged Man
        'upright' => [
            ['id' => 'T025', 'keyword' => '待機・悟り', 'trait' => TRAIT_CARE, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T026', 'keyword' => '変化への拒絶', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    13 => [ // 死神 Death
        'upright' => [
            ['id' => 'T027', 'keyword' => '変容・再生', 'trait' => TRAIT_CHANGE, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T028', 'keyword' => '変化への抵抗・執着', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    14 => [ // 節制 Temperance
        'upright' => [
            ['id' => 'T029', 'keyword' => '調和・バランス', 'trait' => TRAIT_STABILITY, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T030', 'keyword' => '過剰・焦り', 'trait' => TRAIT_PASSION, 'score' => 1],
        ],
    ],
    15 => [ // 悪魔 The Devil
        'upright' => [], // T031: 寄与なし（執着・物質主義は安定性と性質が異なるため）
        'reversed' => [
            ['id' => 'T032', 'keyword' => '解放・自由', 'trait' => TRAIT_INDEP, 'score' => 1],
        ],
    ],
    16 => [ // 塔 The Tower
        'upright' => [
            ['id' => 'T033', 'keyword' => '突然の変化・崩壊', 'trait' => TRAIT_CHANGE, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T034', 'keyword' => '変化の回避', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    17 => [ // 星 The Star
        'upright' => [
            ['id' => 'T035a', 'keyword' => '希望・インスピレーション', 'trait' => TRAIT_PASSION, 'score' => 1],
            ['id' => 'T035b', 'keyword' => '希望・インスピレーション', 'trait' => TRAIT_INTUITION, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T036', 'keyword' => '失望・自信のなさ', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
    ],
    18 => [ // 月 The Moon
        'upright' => [
            ['id' => 'T037', 'keyword' => '幻想・直感', 'trait' => TRAIT_INTUITION, 'score' => 2],
        ],
        'reversed' => [
            ['id' => 'T038', 'keyword' => '混乱の解消・恐れの克服', 'trait' => TRAIT_STABILITY, 'score' => 1],
        ],
    ],
    19 => [ // 太陽 The Sun
        'upright' => [
            ['id' => 'T039a', 'keyword' => '喜び・成功・活力', 'trait' => TRAIT_PASSION, 'score' => 2],
            ['id' => 'T039b', 'keyword' => '喜び・成功・活力', 'trait' => TRAIT_ACTION, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T040', 'keyword' => '過信・楽観すぎ', 'trait' => TRAIT_PASSION, 'score' => 1],
        ],
    ],
    20 => [ // 審判 Judgement
        'upright' => [
            ['id' => 'T041a', 'keyword' => '覚醒・再生', 'trait' => TRAIT_CHANGE, 'score' => 1],
            ['id' => 'T041b', 'keyword' => '覚醒・再生', 'trait' => TRAIT_DUTY, 'score' => 1],
        ],
        'reversed' => [
            ['id' => 'T042', 'keyword' => '自己批判・固執', 'trait' => TRAIT_CARE, 'score' => 1],
        ],
    ],
    21 => [ // 世界 The World
        'upright' => [
            ['id' => 'T043a', 'keyword' => '完成・統合', 'trait' => TRAIT_STABILITY, 'score' => 2],
            ['id' => 'T043b', 'keyword' => '完成・統合', 'trait' => TRAIT_DUTY, 'score' => 1],
        ],
        'reversed' => [], // T044: 寄与なし（未完成・遅延は行動力と性質が異なるため）
    ],
];
