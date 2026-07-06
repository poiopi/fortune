<?php
declare(strict_types=1);

/**
 * inc/axis-vocabulary.php
 *
 * Axis名の契約（Vocabulary）。ロジックは持たない。trait-vocabulary.phpと同じ発想。
 * docs/sansei-engine-design.md §7 参照。5個で固定し、Trait名とは重複させない
 * （旧案の軸名「安定性」がtrait名「安定性」と衝突したため「堅実性」に変更した経緯がある）。
 */

const AXIS_ACTION       = '行動性';
const AXIS_RELIABILITY  = '堅実性';
const AXIS_SENSITIVITY  = '感応性';
const AXIS_AUTONOMY     = '自律性';
const AXIS_TRANSFORM    = '変革性';

/**
 * 同点時の優先順位（この配列の並び順がそのまま優先順位になる）。
 * Bundle ID生成時の短縮コードもここで定義する。
 */
const AXIS_PRIORITY_ORDER = [AXIS_ACTION, AXIS_RELIABILITY, AXIS_SENSITIVITY, AXIS_AUTONOMY, AXIS_TRANSFORM];

const AXIS_CODE = [
    AXIS_ACTION      => 'ACT',
    AXIS_RELIABILITY => 'REL',
    AXIS_SENSITIVITY => 'SEN',
    AXIS_AUTONOMY    => 'AUT',
    AXIS_TRANSFORM   => 'TRA',
];
