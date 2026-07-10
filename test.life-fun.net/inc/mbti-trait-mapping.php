<?php
declare(strict_types=1);

/**
 * inc/mbti-trait-mapping.php
 *
 * MBTIの4文字タイプコードは、16個の名前（INTJ等）ではなく、E/I・S/N・T/F・J/Pという
 * 4つの独立した二分法の組み合わせが本質である（docs/engine-template.mdのRule3：
 * 表示名ではなくインデックス/IDをキーにする、という原則をここでは「8文字」に適用する）。
 * そのため、16タイプそれぞれに個別マッピングを持たせず、8文字それぞれのTrait寄与を
 * 定義し、Engine側で4文字分を合算する。
 *
 * スコア基準：+2 = 中心的テーマ、+1 = 副次的テーマ（shichu・seiza・tarotと同じ基準）。
 * scoreは各ルールに埋め込む（Traitごとの固定重みテーブルは持たない）。同じTraitでも
 * 文脈（どの文字由来か）によってスコアが異なりうるという、既存3エンジンと同じ表現力を
 * 保つため。
 *
 * Iのみ2つのTraitを持つ（非対称）：内向性は「外部からの刺激を慎重に吟味する」性質と
 * 「自分の内面世界・価値観を保つ」性質という二面性を持つため、CARE（慎重さ）と
 * INDEP（独立）の両方へ分配する。他の7文字は単一の性質に絞れるため1Traitのみ。
 */

require_once __DIR__ . '/trait-vocabulary.php';

const MBTI_TRAIT_MAPPING = [
    'E' => [['id' => 'M001', 'keyword' => '外向・自分から動く', 'trait' => TRAIT_ACTION, 'score' => 2]],
    'I' => [
        ['id' => 'M002', 'keyword' => '内向・外部刺激を慎重に吟味する', 'trait' => TRAIT_CARE, 'score' => 2],
        ['id' => 'M003', 'keyword' => '内向・自分の内面世界を保つ', 'trait' => TRAIT_INDEP, 'score' => 1],
    ],
    'S' => [['id' => 'M004', 'keyword' => '感覚・現実的で地に足のついた志向', 'trait' => TRAIT_STABILITY, 'score' => 2]],
    'N' => [['id' => 'M005', 'keyword' => '直感・可能性やパターンへの感度', 'trait' => TRAIT_INTUITION, 'score' => 2]],
    'T' => [['id' => 'M006', 'keyword' => '思考・論理で物事に挑み議論を楽しむ', 'trait' => TRAIT_CHALLENGE, 'score' => 2]],
    'F' => [['id' => 'M007', 'keyword' => '感情・共感と情熱', 'trait' => TRAIT_PASSION, 'score' => 2]],
    'J' => [['id' => 'M008', 'keyword' => '判断・計画性と責任感', 'trait' => TRAIT_DUTY, 'score' => 2]],
    'P' => [['id' => 'M009', 'keyword' => '知覚・柔軟性と変化への適応', 'trait' => TRAIT_CHANGE, 'score' => 2]],
];
