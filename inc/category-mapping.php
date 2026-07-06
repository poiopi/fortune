<?php
declare(strict_types=1);

/**
 * inc/category-mapping.php
 *
 * Axis→カテゴリスコア（恋愛/仕事/金運/健康）の重み表。単一の情報源。
 * axis-mapping.phpと同じ発想：定数テーブルとして分離し、集計ロジックにベタ書きしない。
 *
 * scoresは「利用者に見せる評価」であり、influence（機械的・一貫した算出）とは役割が異なる。
 * このテーブルはチューニング対象であり、今後の調整はここだけを直せばよい。
 *
 * 重みはAxisのtotal値（permanent+transient）に対して適用する
 * （Step0の「Scores=Axis経由、両方の要素を反映」に基づく）。
 */

require_once __DIR__ . '/axis-vocabulary.php';

const CATEGORY_MAPPING = [
    'love' => [
        AXIS_SENSITIVITY => 1.0,
        AXIS_TRANSFORM   => 0.5,
    ],
    'work' => [
        AXIS_RELIABILITY => 1.0,
        AXIS_ACTION      => 0.5,
    ],
    'money' => [
        AXIS_AUTONOMY    => 1.0,
        AXIS_RELIABILITY => 0.5,
    ],
    'health' => [
        AXIS_RELIABILITY => 1.0,
        AXIS_SENSITIVITY => 0.5,
    ],
];
