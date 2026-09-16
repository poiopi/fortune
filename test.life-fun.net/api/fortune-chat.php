<?php declare(strict_types=1);
require_once __DIR__ . '/../inc/fortune-theme-functions.php';

// ─────────────────────────────────────────────
// AI鑑定チャットMVP: API単体
// 「開運のヒント/自己理解/結婚/相性」→ inc/fortune-theme-functions.php の
// 各テーマ関数を呼び出して結果を返すだけ。新しい占い的解釈・主張は
// 一切追加しない。api/fortune-theme.php（旧3テーマ企画）とは無関係の別ファイル。
// ─────────────────────────────────────────────

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
        case 'kaiun':
        case 'self':
            $birthday = $input['birthday'] ?? '';
            if (!preg_match($datePattern, $birthday)) throw new InvalidArgumentException('bad input');
            $data = $theme === 'kaiun' ? fortune_theme_kaiun($birthday) : fortune_theme_self($birthday);
            break;
        case 'marriage_self':
            $birthday = $input['birthday'] ?? '';
            $mbti = $input['mbti'] ?? '';
            $blood = $input['blood'] ?? '';
            if (!preg_match($datePattern, $birthday) || !isset(MBTI_DATA[$mbti]) || !isset(BLOOD_DATA[$blood])) {
                throw new InvalidArgumentException('bad input');
            }
            $data = fortune_theme_marriage($birthday, $mbti, $blood);
            break;
        case 'marriage_person':
        case 'compatibility':
            $yourBirthday = $input['yourBirthday'] ?? '';
            $partnerBirthday = $input['partnerBirthday'] ?? '';
            if (!preg_match($datePattern, $yourBirthday) || !preg_match($datePattern, $partnerBirthday)) {
                throw new InvalidArgumentException('bad input');
            }
            $data = $theme === 'marriage_person'
                ? fortune_theme_marriage_compatibility($yourBirthday, $partnerBirthday)
                : fortune_theme_compatibility($yourBirthday, $partnerBirthday);
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
