<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// AI鑑定チャットMVP（4テーマ：開運のヒント/自己理解/結婚/相性）の
// テーマ別エントリポイント関数群。api/fortune-chat.php から呼び出される。
//
// ここに新しい占いロジック・新しい解釈は一切追加しない。既存資産
// （kyusei-core.php / sanmei-core.php / aisho-core.php / love-orchestrator.php）
// を呼び出して結果を整形するだけの薄いラッパー。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__ . '/kyusei-core.php';
require_once __DIR__ . '/kyusei-fortune-tips.php';
require_once __DIR__ . '/sanmei-core.php';
require_once __DIR__ . '/aisho-core.php';
require_once __DIR__ . '/love-orchestrator.php';
require_once __DIR__ . '/mbti-data.php';
require_once __DIR__ . '/blood-data.php';

// ① 開運のヒント
function fortune_theme_kaiun(string $birthday): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    return fortune_theme_kaiun_data($year, $month, $day);
}

// ② 自己理解
function fortune_theme_self(string $birthday): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    $gmIdx = sanmei_calcGmIdx($year, $month, $day);
    return [
        'strengths' => sanmei_getStrengths($gmIdx),
        'weaknesses' => sanmei_getWeaknesses($gmIdx),
        'relations' => sanmei_getRelations($gmIdx),
    ];
}

// ③ 結婚→自分の結婚志向
function fortune_theme_marriage(string $birthday, string $mbtiType, string $bloodType): array {
    [, $month, $day] = array_map('intval', explode('-', $birthday));
    // love.php 30行目と全く同じ呼び出し。love_diagnose()自体・下位計算は一切変更・再実装しない
    $result = love_diagnose($mbtiType, $bloodType, (int)$month, (int)$day, 'U');
    // 重要：tendencyTexts[0]は inc/love-tendency.php の LOVE_TENDENCY_MAPPING 定義順(結婚志向→浮気耐性)により
    // 「結婚志向」に対応する(Manager検証済み、2026-09-16)。この定義順が変わらない限り有効。
    $marriageTendencyText = $result['document']['tendencyTexts'][0];
    return ['resultText' => $marriageTendencyText];
}

// ④ 結婚→この人との結婚相性
function fortune_theme_marriage_compatibility(string $yourBirthday, string $partnerBirthday): array {
    // 年は受け取るがaisho.phpの既存仕様（月日のみで計算）に合わせて破棄する
    [, $ym, $yd] = array_map('intval', explode('-', $yourBirthday));
    [, $pm, $pd] = array_map('intval', explode('-', $partnerBirthday));
    $calc = aisho_calcCompatibility($ym, $yd, $pm, $pd);
    return [
        'score' => $calc['marriageScore'],
        'label' => $calc['marriageLabel'],
        'reasonText' => $calc['marriageReasonText'],
    ];
}

// ⑤ 相性
function fortune_theme_compatibility(string $yourBirthday, string $partnerBirthday): array {
    [, $ym, $yd] = array_map('intval', explode('-', $yourBirthday));
    [, $pm, $pd] = array_map('intval', explode('-', $partnerBirthday));
    $calc = aisho_calcCompatibility($ym, $yd, $pm, $pd);
    return [
        'score' => $calc['loverScore'],
        'label' => $calc['loverLabel'],
        'reasonText' => $calc['loverReasonText'],
    ];
}
