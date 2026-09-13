<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/seiza-engine.php';

// ─────────────────────────────────────────────
// 相談テーマ型占いモーダル Phase1: API単体
// 「恋愛/仕事/自分のこと」→ 生年月日 → 西洋占星術(seiza-engine.php)で占う。
// このファイルは既存のseizaEngine()の結果を定型文で組み立てるだけで、
// 新しい占い的解釈・主張は一切追加しない。
// ─────────────────────────────────────────────

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Method Not Allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

header('Content-Type: application/json; charset=utf-8');

$input = json_decode(file_get_contents('php://input') ?: '', true);
$category = is_array($input) ? ($input['category'] ?? '') : '';
$birthday = is_array($input) ? ($input['birthday'] ?? '') : '';

if (!in_array($category, ['love', 'work', 'self'], true)
    || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
    http_response_code(400);
    echo json_encode(['error' => '入力が不正です'], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * category・seizaEngine()の結果から、既存source_dataのみを組み合わせてresultTextを作る。
 * 新しい主張・説明文はここで生成しない（既存文章の抽出・定型文での連結のみ）。
 */
function build_theme_result_text(string $category, array $engineResult): string {
    $extras = $engineResult['extras'];
    $highlights = $engineResult['highlights'];

    if ($category === 'love') {
        foreach ($extras as $extra) {
            if ($extra['type'] === 'love_style') {
                return $extra['value'];
            }
        }
        return '';
    }

    if ($category === 'self') {
        $innerType = SEIZA_INNER_TYPES[$engineResult['raw']['innerTypeIndex']];
        $elementName = '';
        $qualityName = '';
        foreach ($extras as $extra) {
            if ($extra['type'] === 'element') {
                $elementName = $extra['value']['name'];
            } elseif ($extra['type'] === 'quality') {
                $qualityName = $extra['value']['name'];
            }
        }
        return $innerType['desc'] . ' エレメントは' . $elementName . '、クオリティは' . $qualityName . 'です。';
    }

    // work
    foreach ($extras as $extra) {
        if ($extra['type'] === 'jobs') {
            $jobs = $extra['value'];
            return 'あなたに向いているのは、' . $jobs[0] . 'や' . $jobs[1] . '、' . $jobs[2] . 'といった仕事です。';
        }
    }
    return '';
}

try {
    [$year, $month, $day] = explode('-', $birthday);
    $engineResult = seizaEngine((int)$month, (int)$day, 'U');

    $sign = SEIZA_SIGNS[$engineResult['raw']['signIndex']]['name'];
    $resultText = build_theme_result_text($category, $engineResult);

    echo json_encode([
        'engine' => 'seiza',
        'category' => $category,
        'sign' => $sign,
        'resultText' => $resultText,
        'articleUrl' => '/articles/seiza/',
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => '診断に失敗しました'], JSON_UNESCAPED_UNICODE);
}
