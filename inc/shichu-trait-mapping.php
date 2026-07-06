<?php
declare(strict_types=1);

/**
 * inc/shichu-trait-mapping.php
 *
 * docs/shichu-trait-mapping.md（Rule ID: S001〜S013）の実体。
 * Mapping Table自体をこのPHP配列として持つ（単一の情報源。tarot-trait-mapping.phpと同じ方式）。
 * shichu-engine.phpのtraits計算・Coverageレポート・仕様書（docs/）は
 * すべてこの配列から生成・参照する。ここを直接書き換えたら、docs側も再生成する。
 *
 * スコア基準：+2 = 命式の中心的な特徴（日主強弱）、+1 = 個別の十神の出現（頻度で加算）
 *
 * 各要素: ['id'=>string, 'keyword'=>string（根拠となった既存の名称）, 'trait'=>string, 'score'=>int]
 */

require_once __DIR__ . '/trait-vocabulary.php';

const SHICHU_TRAIT_MAPPING = [
    // 日主強弱（1回のみ判定）
    'dayStrength' => [
        '身強' => [
            ['id' => 'S001', 'keyword' => '身強', 'trait' => TRAIT_ACTION, 'score' => 2],
        ],
        '身弱' => [
            ['id' => 'S002', 'keyword' => '身弱', 'trait' => TRAIT_CARE, 'score' => 2],
        ],
        '中和' => [
            ['id' => 'S003', 'keyword' => '中和', 'trait' => TRAIT_STABILITY, 'score' => 2],
        ],
    ],
    // 十神（tenGodGridの出現回数分だけ加算。存在判定ではなく頻度を使う）
    'tenGod' => [
        0 => [['id' => 'S004', 'keyword' => '比肩', 'trait' => TRAIT_INDEP, 'score' => 1]],
        1 => [['id' => 'S005', 'keyword' => '劫財', 'trait' => TRAIT_ACTION, 'score' => 1]],
        2 => [['id' => 'S006', 'keyword' => '食神', 'trait' => TRAIT_PASSION, 'score' => 1]],
        3 => [['id' => 'S007', 'keyword' => '傷官', 'trait' => TRAIT_CHANGE, 'score' => 1]],
        4 => [['id' => 'S008', 'keyword' => '偏財', 'trait' => TRAIT_ACTION, 'score' => 1]],
        5 => [['id' => 'S009', 'keyword' => '正財', 'trait' => TRAIT_STABILITY, 'score' => 1]],
        6 => [['id' => 'S010', 'keyword' => '偏官', 'trait' => TRAIT_CHALLENGE, 'score' => 1]],
        7 => [['id' => 'S011', 'keyword' => '正官', 'trait' => TRAIT_DUTY, 'score' => 1]],
        8 => [['id' => 'S012', 'keyword' => '偏印', 'trait' => TRAIT_INTUITION, 'score' => 1]],
        9 => [['id' => 'S013', 'keyword' => '印綬', 'trait' => TRAIT_CARE, 'score' => 1]],
    ],
];
