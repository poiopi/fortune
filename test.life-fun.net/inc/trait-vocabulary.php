<?php
declare(strict_types=1);

/**
 * inc/trait-vocabulary.php
 *
 * 占術非依存の共有Trait名の契約（Vocabulary）。ロジックは持たない。
 * docs/sansei-engine-design.md §6 参照。
 *
 * 各占術エンジン（shichu-engine.php等）は、raw→traits変換の際に
 * ここで定義された定数だけを使う。タイプミスによるtrait名のズレ
 * （例: '慎重さ' と '慎重' の混在）を防ぐための仕組み。
 */

const TRAIT_ACTION    = '行動力';
const TRAIT_CARE      = '慎重さ';
const TRAIT_STABILITY = '安定性';
const TRAIT_INDEP     = '独立';
const TRAIT_PASSION   = '情熱';
const TRAIT_CHANGE    = '変化';
const TRAIT_CHALLENGE = '挑戦';
const TRAIT_DUTY      = '責任感';
const TRAIT_INTUITION = '直感';
