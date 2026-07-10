<?php
declare(strict_types=1);

/**
 * inc/blood-trait-mapping.php
 *
 * 血液型（A/B/O/AB）には既存ページ・既存実装が存在しないため、Trait Mappingを
 * 先に設計してから他の工程（Blood Data／Engine／Validator／Coverage／Snapshot）に
 * 進めた（docs/love/07-implementation.mdでの合意事項）。
 *
 * 各行は「通俗特徴 → Trait → 選定理由」で独立に説明できることを設計時に確認済み
 * （Managerレビューにより、Axisベクトルの衝突回避を目的とした数値調整ではないことを
 * 検証している）。
 *
 * スコア基準：+2=中心的テーマ、+1=副次的テーマ（shichu・seiza・tarot・mbtiと同じ基準）。
 * スコアは血液型を説明する際の「中心的特徴」か「副次的特徴」かを表すものであり、
 * Traitの強さや優劣を表すものではない。異なる血液型間で総得点を比較する目的には
 * 用いない（docs/engine-template.mdの手順6を参照。A型が5点・AB型が3点なのは、
 * 各血液型が独立に持つ通俗特徴の数・濃淡の違いであり、意図的に揃えていない）。
 *
 * | 血液型 | 通俗特徴 | Trait | 選定理由 |
 * |---|---|---|---|
 * | A  | 几帳面 | CARE      | 慎重さを最もよく表す |
 * | A  | 真面目 | DUTY      | 責任感そのもの |
 * | A  | 調和   | STABILITY | 几帳面・責任感から自然に伴う安定志向。前二者の帰結にあたるため副次 |
 * | B  | 自由   | CHANGE    | 変化志向そのもの |
 * | B  | マイペース | INDEP  | 自立性そのもの |
 * | O  | 行動的 | ACTION    | 行動力そのもの |
 * | O  | おおらか | PASSION | 感情表現・熱量 |
 * | AB | 独特な感性 | INTUITION | AB型を語る際に最も先に挙がる、最頻出のheadline特徴 |
 * | AB | 型にはまらない発想 | CHALLENGE | 独特さに次ぐ副次的特徴（既成概念への挑戦性） |
 */

require_once __DIR__ . '/trait-vocabulary.php';

const BLOOD_TRAIT_MAPPING = [
    'A' => [
        ['id' => 'B001', 'keyword' => '几帳面', 'trait' => TRAIT_CARE, 'score' => 2],
        ['id' => 'B002', 'keyword' => '真面目', 'trait' => TRAIT_DUTY, 'score' => 2],
        ['id' => 'B003', 'keyword' => '調和', 'trait' => TRAIT_STABILITY, 'score' => 1],
    ],
    'B' => [
        ['id' => 'B004', 'keyword' => '自由', 'trait' => TRAIT_CHANGE, 'score' => 2],
        ['id' => 'B005', 'keyword' => 'マイペース', 'trait' => TRAIT_INDEP, 'score' => 2],
    ],
    'O' => [
        ['id' => 'B006', 'keyword' => '行動的', 'trait' => TRAIT_ACTION, 'score' => 2],
        ['id' => 'B007', 'keyword' => 'おおらか', 'trait' => TRAIT_PASSION, 'score' => 2],
    ],
    'AB' => [
        ['id' => 'B008', 'keyword' => '独特な感性', 'trait' => TRAIT_INTUITION, 'score' => 2],
        ['id' => 'B009', 'keyword' => '型にはまらない発想', 'trait' => TRAIT_CHALLENGE, 'score' => 1],
    ],
];
