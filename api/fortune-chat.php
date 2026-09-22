<?php declare(strict_types=1);

/**
 * api/fortune-chat.php
 *
 * AI鑑定チャット（10テーマ版）専用API。既存 api/fortune-theme.php（旧3テーマ企画）
 * とは無関係の別ファイル・別企画。POSTのみ受け付け、テーマごとにinc/fortune-theme-
 * functions.phpの薄い関数を呼び出して結果をJSONで返す。
 */

require_once __DIR__ . '/../inc/fortune-theme-functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Method Not Allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}
header('Content-Type: application/json; charset=utf-8');
$input = json_decode(file_get_contents('php://input') ?: '', true);
$theme = is_array($input) ? ($input['theme'] ?? '') : '';
$datePattern = '/^\d{4}-\d{2}-\d{2}$/';

try {
    switch ($theme) {
        case 'love':
        case 'encounter':
        case 'marriage_self':
            $birthday = $input['birthday'] ?? '';
            $mbti = $input['mbti'] ?? '';
            $blood = $input['blood'] ?? '';
            if (!preg_match($datePattern, $birthday) || !isset(MBTI_DATA[$mbti]) || !isset(BLOOD_DATA[$blood])) {
                throw new InvalidArgumentException('bad input');
            }
            if ($theme === 'love') {
                $data = fortune_theme_love($birthday, $mbti, $blood);
            } elseif ($theme === 'encounter') {
                $data = fortune_theme_encounter($birthday, $mbti, $blood);
            } else {
                $data = fortune_theme_marriage($birthday, $mbti, $blood);
            }
            break;

        case 'work':
        case 'money':
        case 'self':
        case 'kaiun':
            $birthday = $input['birthday'] ?? '';
            if (!preg_match($datePattern, $birthday)) {
                throw new InvalidArgumentException('bad input');
            }
            if ($theme === 'work') {
                $data = fortune_theme_work($birthday);
            } elseif ($theme === 'money') {
                $data = fortune_theme_money($birthday);
            } elseif ($theme === 'self') {
                $data = fortune_theme_self($birthday);
            } else {
                $data = fortune_theme_kaiun($birthday);
            }
            break;

        case 'compatibility':
        case 'marriage_person':
            $yourBirthday = $input['yourBirthday'] ?? '';
            $partnerBirthday = $input['partnerBirthday'] ?? '';
            if (!preg_match($datePattern, $yourBirthday) || !preg_match($datePattern, $partnerBirthday)) {
                throw new InvalidArgumentException('bad input');
            }
            if ($theme === 'compatibility') {
                $data = fortune_theme_compatibility($yourBirthday, $partnerBirthday);
            } else {
                $data = fortune_theme_marriage_compatibility($yourBirthday, $partnerBirthday);
            }
            break;

        case 'timing':
            $birthday = $input['birthday'] ?? '';
            $gender = $input['gender'] ?? '';
            if (!preg_match($datePattern, $birthday) || !in_array($gender, ['male', 'female'], true)) {
                throw new InvalidArgumentException('bad input');
            }
            $data = fortune_theme_timing($birthday, $gender);
            break;

        case 'zense':
            $birthday = $input['birthday'] ?? '';
            $name = trim((string)($input['name'] ?? ''));
            if (!preg_match($datePattern, $birthday) || $name === '') {
                throw new InvalidArgumentException('bad input');
            }
            $data = fortune_theme_zense($name, $birthday);
            break;

        default:
            throw new InvalidArgumentException('bad theme');
    }
    echo json_encode(['theme' => $theme] + $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(['error' => '入力が不正です'], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => '診断に失敗しました'], JSON_UNESCAPED_UNICODE);
}
