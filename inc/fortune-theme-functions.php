<?php
declare(strict_types=1);

/**
 * inc/fortune-theme-functions.php
 *
 * AI鑑定チャット（api/fortune-chat.php）専用の薄いオーケストレーター層。
 * 既存の占いエンジン（変更禁止）と、AI鑑定チャット専用に複製した-core/-texts
 * 系ファイルを呼び出して、テーマごとの結果データを組み立てるだけの関数群。
 * 新しい占いロジック・独自の解釈・新しい総括文はここでは追加しない。
 *
 * love-style.php: LOVE_STYLE_MAPPING定義順を実際に読んで確認した並び
 *   （積極性, 愛情表現, 包容力, 独占欲, 惚れやすさ, 嫉妬深さ, 恋愛の慎重さ）
 *   → 出会い（新しい出会いへの心の開きやすさ）は index 4「惚れやすさ」を使用。
 * love-tendency.php: LOVE_TENDENCY_MAPPING定義順を実際に読んで確認した並び
 *   （結婚志向, 浮気耐性）→ 結婚志向は index 0。
 * （love-composer.phpのforeachはPHP連想配列の挿入順を保つため、styleTexts /
 *   tendencyTexts配列のインデックスはLOVE_STYLE_MAPPING / LOVE_TENDENCY_MAPPING
 *   の定義順とそのまま一致する。実測確認済み。）
 */

require_once __DIR__ . '/kyusei-core.php';
require_once __DIR__ . '/kyusei-fortune-texts.php';
require_once __DIR__ . '/sanmei-core.php';
require_once __DIR__ . '/aisho-core.php';
require_once __DIR__ . '/shichu-engine.php'; // 既存、変更しない
require_once __DIR__ . '/shichu-timing-texts.php';
require_once __DIR__ . '/zense-core.php';
require_once __DIR__ . '/love-orchestrator.php'; // 既存、変更しない
require_once __DIR__ . '/mbti-data.php';
require_once __DIR__ . '/blood-data.php';

// ① 恋愛
function fortune_theme_love(string $birthday, string $mbtiType, string $bloodType): array {
    [, $month, $day] = array_map('intval', explode('-', $birthday));
    $result = love_diagnose($mbtiType, $bloodType, $month, $day, 'U');
    return ['resultText' => $result['document']['bundleText']];
}
// ② 仕事・キャリア
function fortune_theme_work(string $birthday): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    $star = calcKyusei($year, $month, $day);
    return ['star' => getKyuseiData($star)['name'], 'resultText' => KYUSEI_WORK_TEXTS[$star]];
}
// ③ 金運
function fortune_theme_money(string $birthday): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    $star = calcKyusei($year, $month, $day);
    return ['star' => getKyuseiData($star)['name'], 'resultText' => KYUSEI_MONEY_TEXTS[$star]];
}
// ④ 自己理解
function fortune_theme_self(string $birthday): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    $gmIdx = sanmei_calcGmIdx($year, $month, $day);
    return ['strengths' => sanmei_getStrengths($gmIdx), 'weaknesses' => sanmei_getWeaknesses($gmIdx), 'relations' => sanmei_getRelations($gmIdx)];
}
// ⑤ 出会い（love-style.php実測確認: index4 = 惚れやすさ）
function fortune_theme_encounter(string $birthday, string $mbtiType, string $bloodType): array {
    [, $month, $day] = array_map('intval', explode('-', $birthday));
    $result = love_diagnose($mbtiType, $bloodType, $month, $day, 'U');
    return ['resultText' => $result['document']['styleTexts'][4]];
}
// ⑥ 相性
function fortune_theme_compatibility(string $yourBirthday, string $partnerBirthday): array {
    [, $ym, $yd] = array_map('intval', explode('-', $yourBirthday));
    [, $pm, $pd] = array_map('intval', explode('-', $partnerBirthday));
    $calc = aisho_calcCompatibility($ym, $yd, $pm, $pd);
    return ['score' => $calc['loverScore'], 'label' => $calc['loverLabel'], 'reasonText' => $calc['loverReasonText']];
}
// ⑦-a 結婚→自分の結婚志向（love-tendency.php実測確認: index0 = 結婚志向）
function fortune_theme_marriage(string $birthday, string $mbtiType, string $bloodType): array {
    [, $month, $day] = array_map('intval', explode('-', $birthday));
    $result = love_diagnose($mbtiType, $bloodType, $month, $day, 'U');
    return ['resultText' => $result['document']['tendencyTexts'][0]];
}
// ⑦-b 結婚→この人との結婚相性
function fortune_theme_marriage_compatibility(string $yourBirthday, string $partnerBirthday): array {
    [, $ym, $yd] = array_map('intval', explode('-', $yourBirthday));
    [, $pm, $pd] = array_map('intval', explode('-', $partnerBirthday));
    $calc = aisho_calcCompatibility($ym, $yd, $pm, $pd);
    return ['score' => $calc['marriageScore'], 'label' => $calc['marriageLabel'], 'reasonText' => $calc['marriageReasonText']];
}
// ⑧ 運気の流れ（既存shichu-engine.phpの関数を呼ぶだけ、新規計算式は作らない）
function fortune_theme_timing(string $birthday, string $gender): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    $dp = shichu_getDayPillar($year, $month, $day);
    $yp = shichu_getYearPillar($year, $month, $day);
    $mp = shichu_getMonthPillar($year, $month, $day, $yp['stem']);
    $thisYear = (int)date('Y');
    $typStem = ($thisYear - 4 + 600) % 10;
    $nenunIdx = shichu_getTenGod($dp['stem'], $typStem);
    $nenunBase = ($nenunIdx >= 0 && $nenunIdx < 10) ? $nenunIdx : (SHICHU_STEM_ELEM[$typStem] * 2) % 10;
    $yearText = SHICHU_NENUN_TEXT[$nenunBase];
    $dy = shichu_getDaiyun($year, $month, $day, $gender, $yp['stem'], $mp['stem'], $mp['branch']);
    $currentAge = $thisYear - $year;
    $currentDy = null;
    foreach ($dy['daiyun'] as $d) {
        if ($currentAge >= $d['startAge'] && $currentAge < $d['startAge'] + 10) { $currentDy = $d; break; }
    }
    $decadeGodText = ''; $decadeJuniText = '';
    if ($currentDy !== null) {
        $cgIdx = shichu_getTenGod($dp['stem'], $currentDy['stem']);
        $cgName = $cgIdx >= 0 ? SHICHU_JUSSHIN_NAMES[$cgIdx] : '';
        $cjName = shichu_getJuniUnsei($dp['stem'], $currentDy['branch']);
        $decadeGodText = SHICHU_JUSSHIN_GOD_DESC[$cgName] ?? '';
        $decadeJuniText = SHICHU_JUNI_DESC[$cjName] ?? '';
    }
    return ['yearText' => $yearText, 'decadeGodText' => $decadeGodText, 'decadeJuniText' => $decadeJuniText];
}
// ⑨ 開運のヒント
function fortune_theme_kaiun(string $birthday): array {
    [$year, $month, $day] = array_map('intval', explode('-', $birthday));
    $star = calcKyusei($year, $month, $day);
    return ['star' => getKyuseiData($star)['name'], 'resultText' => KYUSEI_KAIUN_TEXTS[$star]];
}
// ⑩ 前世・運命（name/y/mo/dはゼロ埋め文字列のまま結合。intval変換しない）
function fortune_theme_zense(string $name, string $birthday): array {
    [$yStr, $moStr, $dStr] = explode('-', $birthday);
    $key = $name . $yStr . $moStr . $dStr;
    $seed = zense_strHash($key);
    return ['message' => zense_seededPick(ZENSE_MESSAGES, $seed, 'ms'), 'mission' => zense_seededPick(ZENSE_MISSIONS, $seed, 'mi')];
}
