<?php
declare(strict_types=1);

/**
 * inc/axis-mapping.php
 *
 * docs/sansei-engine-design.md §7（Rule ID: A001〜A009）の実体。
 * trait→Axisの対応をコードにベタ書きせず、定数テーブルとして分離する（単一の情報源）。
 *
 * v1は「1trait→1axis」のシンプルな対応だが、各traitの値をルールの配列にしておくことで、
 * 将来「1trait→複数axis」への拡張が必要になった場合も、集計ロジック（axis_computeAxes）を
 * 変更せず、この配列に行を追加するだけで対応できる。
 *
 * 各traitのpermanent/transient/total（axis_aggregateTraits()の出力）は、対応するAxisへ
 * そのまま転記する（v1では重み付けをしない。将来重み付けが必要になれば、この配列に
 * weightフィールドを追加する）。
 */

require_once __DIR__ . '/trait-vocabulary.php';
require_once __DIR__ . '/axis-vocabulary.php';

const AXIS_MAPPING = [
    TRAIT_ACTION    => [['id' => 'A001', 'axis' => AXIS_ACTION]],
    TRAIT_CHALLENGE => [['id' => 'A002', 'axis' => AXIS_ACTION]],
    TRAIT_CARE      => [['id' => 'A003', 'axis' => AXIS_RELIABILITY]],
    TRAIT_DUTY      => [['id' => 'A004', 'axis' => AXIS_RELIABILITY]],
    TRAIT_STABILITY => [['id' => 'A005', 'axis' => AXIS_RELIABILITY]],
    TRAIT_INTUITION => [['id' => 'A006', 'axis' => AXIS_SENSITIVITY]],
    TRAIT_PASSION   => [['id' => 'A007', 'axis' => AXIS_SENSITIVITY]],
    TRAIT_INDEP     => [['id' => 'A008', 'axis' => AXIS_AUTONOMY]],
    TRAIT_CHANGE    => [['id' => 'A009', 'axis' => AXIS_TRANSFORM]],
];
