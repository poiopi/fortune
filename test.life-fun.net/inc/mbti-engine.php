<?php
declare(strict_types=1);

/**
 * inc/mbti-engine.php
 *
 * mbti.php の10問診断ロジック（calcMbti()、クライアントサイドJavaScript）を
 * PHPへ忠実に移植したもの。docs/engine-template.md / docs/love/07-implementation.md
 * の手順に基づく（Phase 1-3：Engine(raw)のみ）。
 *
 * この段階ではrawのみを返す。meta・traits・highlights・extrasはPhase 1-5〜以降で追加する。
 *
 * 正しさの基準は tests/cases/mbti-golden.php（Golden Master、1024件全数）。
 */

require_once __DIR__ . '/mbti-data.php';

/**
 * calcMbti()のスコアリング・タイブレーク規則をそのまま移植する。
 * 同点の場合はE/S/T/Jを優先する（mbti.php本体と同一）。
 *
 * @param array<int, int> $answers 10問分の回答（各0または1）
 */
function mbti_calcType(array $answers): string {
    $scores = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];
    foreach (MBTI_QUESTION_DIMS as $i => $dim) {
        $letters = str_split($dim);
        $scores[$letters[$answers[$i]]]++;
    }
    return ($scores['E'] >= $scores['I'] ? 'E' : 'I')
         . ($scores['S'] >= $scores['N'] ? 'S' : 'N')
         . ($scores['T'] >= $scores['F'] ? 'T' : 'F')
         . ($scores['J'] >= $scores['P'] ? 'J' : 'P');
}

/**
 * @param array<int, int> $answers 10問分の回答（各0または1）
 * @return array{raw: array{type: string}}
 */
function mbtiEngine(array $answers): array {
    $raw = [
        'type' => mbti_calcType($answers),
    ];

    return [
        'raw' => $raw,
    ];
}
