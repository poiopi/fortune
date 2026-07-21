<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 星座セクション用プロバイダ
//
// inc/seiza-data.php の SEIZA_SIGNS（各星座の period フィールド）を参照し、
// 該当する月日がどの星座の期間に入るかを判定する。SEIZA_SIGNS 自体は
// 変更しない。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../../seiza-data.php';

// 星座code→解説記事slugの変換表
const DAYINFO_SEIZA_ARTICLE_SLUGS = [
    'AR'=>'aries','TA'=>'taurus','GE'=>'gemini','CA'=>'cancer',
    'LE'=>'leo','VI'=>'virgo','LI'=>'libra','SC'=>'scorpio',
    'SA'=>'sagittarius','CP'=>'capricorn','AQ'=>'aquarius','PI'=>'pisces',
];

function getSeizaInfo(DateTimeImmutable $date): array {
    $month = (int)$date->format('n');
    $day   = (int)$date->format('j');

    foreach (SEIZA_SIGNS as $sign) {
        // period例: '12/22〜1/19'（区切り文字は全角波ダッシュ U+301C）
        [$startStr, $endStr] = explode('〜', $sign['period']);
        [$sm, $sd] = array_map('intval', explode('/', $startStr));
        [$em, $ed] = array_map('intval', explode('/', $endStr));

        if ($sm < $em || ($sm === $em && $sd <= $ed)) {
            // 通常期間（年をまたがない。例: 3/21〜4/19）
            $inRange =
                ($month > $sm || ($month === $sm && $day >= $sd)) &&
                ($month < $em || ($month === $em && $day <= $ed));
        } else {
            // 年をまたぐ期間（例: 山羊座 12/22〜1/19）
            $inRange =
                ($month > $sm || ($month === $sm && $day >= $sd)) ||
                ($month < $em || ($month === $em && $day <= $ed));
        }

        if ($inRange) {
            $elementName = SEIZA_ELEMENTS[$sign['element']]['name'];
            $qualityName = SEIZA_QUALITIES[$sign['quality']]['name'];
            $slug        = DAYINFO_SEIZA_ARTICLE_SLUGS[$sign['code']] ?? null;

            return [
                'available'    => true,
                'name'         => $sign['name'],
                'code'         => $sign['code'],
                'symbol'       => $sign['symbol'],
                'suffix'       => $sign['suffix'],
                'period'       => $sign['period'],
                'element_name' => $elementName,
                'quality_name' => $qualityName,
                'url'          => $slug !== null ? "/articles/seiza/{$slug}/" : null,
            ];
        }
    }

    // 理論上、SEIZA_SIGNSは1年366日をすべてカバーしているため到達しない。
    // 万一データ不整合があった場合に備えたフォールバック。
    return ['available' => false];
}
