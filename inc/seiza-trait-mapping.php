<?php
declare(strict_types=1);

/**
 * inc/seiza-trait-mapping.php
 *
 * docs/seiza-trait-mapping.md（Rule ID: Z001〜Z019）の実体。
 * Mapping Table自体をこのPHP配列として持つ（単一の情報源。shichu・tarotと同じ方式）。
 *
 * element・quality・innerTypeIndexという「インデックス」だけをキーにする（表示名には依存しない）。
 * 表示名（'情熱型'等）が将来変更されても、このMapping Tableは壊れない
 * （tarotがcardOrderをキーにし、カード名で判定しないのと同じ設計）。
 *
 * element・qualityはraw（signIndex）から導出される派生値であり、rawには保存しない
 * （rawは計算に必要な最小限の事実のみを持つ）。
 *
 * スコア基準：+2 = 中心的テーマ、+1 = 副次的テーマ
 *
 * 各要素: ['id'=>string, 'keyword'=>string（根拠となった既存の名称）, 'trait'=>string, 'score'=>int]
 */

require_once __DIR__ . '/trait-vocabulary.php';

const SEIZA_TRAIT_MAPPING = [
    // element: 0=火, 1=地, 2=風, 3=水（SEIZA_ELEMENTSのインデックスと対応）
    'element' => [
        0 => [['id' => 'Z001', 'keyword' => '火・情熱・創造・直感', 'trait' => TRAIT_PASSION, 'score' => 2]],
        1 => [['id' => 'Z002', 'keyword' => '地・安定・現実・継続', 'trait' => TRAIT_STABILITY, 'score' => 2]],
        2 => [['id' => 'Z003', 'keyword' => '風・知性・変化', 'trait' => TRAIT_CHANGE, 'score' => 1]],
        3 => [['id' => 'Z004', 'keyword' => '水・感情・直感・共感', 'trait' => TRAIT_INTUITION, 'score' => 2]],
    ],
    // quality: 0=活動宮, 1=不動宮, 2=柔軟宮（SEIZA_QUALITIESのインデックスと対応）
    'quality' => [
        0 => [['id' => 'Z005', 'keyword' => '活動宮・行動を起こすイニシアチブ', 'trait' => TRAIT_ACTION, 'score' => 1]],
        1 => [['id' => 'Z006', 'keyword' => '不動宮・やり抜く強さ・粘り強さ', 'trait' => TRAIT_STABILITY, 'score' => 1]],
        2 => [['id' => 'Z007', 'keyword' => '柔軟宮・変化に適応する柔軟さ', 'trait' => TRAIT_CHANGE, 'score' => 1]],
    ],
    // innerTypeIndex: 0〜11（SEIZA_INNER_TYPESのインデックスと対応。表示名には依存しない）
    'innerType' => [
        0 => [['id' => 'Z008', 'keyword' => '情熱型・行動が先で熱い', 'trait' => TRAIT_PASSION, 'score' => 2]],
        1 => [['id' => 'Z009', 'keyword' => '安定型・揺るぎない価値観', 'trait' => TRAIT_STABILITY, 'score' => 2]],
        2 => [['id' => 'Z010', 'keyword' => '表現型・自分の世界を外に出す', 'trait' => TRAIT_INDEP, 'score' => 1]],
        3 => [['id' => 'Z011', 'keyword' => '感受型・周囲のエネルギーを敏感に受け取る', 'trait' => TRAIT_INTUITION, 'score' => 1]],
        4 => [['id' => 'Z012', 'keyword' => '分析型・根拠を持って判断する', 'trait' => TRAIT_CARE, 'score' => 2]],
        5 => [['id' => 'Z013', 'keyword' => '調和型・場のバランスを保つ', 'trait' => TRAIT_STABILITY, 'score' => 1]],
        6 => [['id' => 'Z014', 'keyword' => '探究型・未知への好奇心', 'trait' => TRAIT_INTUITION, 'score' => 1]],
        7 => [['id' => 'Z015', 'keyword' => '責任型・責任感が強い', 'trait' => TRAIT_DUTY, 'score' => 2]],
        8 => [['id' => 'Z016', 'keyword' => '自由型・枠や制約を嫌う', 'trait' => TRAIT_INDEP, 'score' => 2]],
        9 => [['id' => 'Z017', 'keyword' => '挑戦型・困難があるほど燃える', 'trait' => TRAIT_CHALLENGE, 'score' => 2]],
        10 => [['id' => 'Z018', 'keyword' => '革新型・変化を起こすことに情熱', 'trait' => TRAIT_CHANGE, 'score' => 2]],
        11 => [['id' => 'Z019', 'keyword' => '直感型・論理より感覚で捉える', 'trait' => TRAIT_INTUITION, 'score' => 2]],
    ],
];
