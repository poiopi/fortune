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

// 星座code→性格・長所（既存のarticles/seiza/記事から抽出した内容を1文に凝縮したもの）
const DAYINFO_SEIZA_TRAITS = [
    'AR' => ['personality' => '何事も真っ先に取り組み、新しい道を開拓することに喜びを感じるタイプです。', 'strength' => '困難な状況でも前に進む勇気と、周囲を引っ張るリーダーシップが持ち味です。'],
    'TA' => ['personality' => '急いで動くより、時間をかけてじっくり積み上げることを好むタイプです。', 'strength' => '一度決めたことをやり遂げる粘り強さと、美しいものを見抜く審美眼が持ち味です。'],
    'GE' => ['personality' => '話すことも聞くことも得意で、初対面でも自然と打ち解けられる社交性を持ちます。', 'strength' => '様々な知識を持つ幅広い教養と、場の雰囲気を読む機転が持ち味です。'],
    'CA' => ['personality' => '心を許した相手には深い愛情と温かさを注ぐ、家族的な優しさを持ちます。', 'strength' => '相手の気持ちを感じ取る共感力と、困っている人へ自然と手を差し伸べる面倒見の良さが持ち味です。'],
    'LE' => ['personality' => '自分らしさを全力で表現することに喜びを感じ、人から認められることで輝きを増すタイプです。', 'strength' => '自己表現の才能と、周囲を巻き込む熱量・面倒見の良さが持ち味です。'],
    'VI' => ['personality' => '何事も細かく見て、改善できるポイントを自然と見つけるタイプです。', 'strength' => '几帳面さと、周囲が気づかない問題を発見する鋭い観察力が持ち味です。'],
    'LI' => ['personality' => 'どんな状況でも公平に物事を見て、みんなが納得できる答えを探すタイプです。', 'strength' => '多角的な視点から物事を判断できるバランス感覚と、洗練された審美眼が持ち味です。'],
    'SC' => ['personality' => '物事の表面ではなく本質や真実を追い求め、一度惹かれたものには深く没頭するタイプです。', 'strength' => '人の本質を見抜く洞察力と、困難を乗り越える強い意志力が持ち味です。'],
    'SA' => ['personality' => '人生を大きな冒険と捉え、常に新しい経験と知識を求めるタイプです。', 'strength' => '困難な状況でも前向きに考えられる楽観性と、広い視野で物事を捉える大局観が持ち味です。'],
    'CP' => ['personality' => '目標を定めたら何年かかっても諦めない粘り強さを持つタイプです。', 'strength' => '着実に積み上げる忍耐力と、高い自己管理能力・責任感が持ち味です。'],
    'AQ' => ['personality' => '他人と違うことを恐れず、自分の独自の視点で世界を見るタイプです。', 'strength' => '固定観念に縛られない独創的な思考と、新しい可能性を提示する力が持ち味です。'],
    'PI' => ['personality' => '他者の感情に自然と共鳴し、豊かな内面世界を持つタイプです。', 'strength' => '他者の痛みや喜びを自分のことのように感じられる深い共感力と、豊かなイマジネーションが持ち味です。'],
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
            $traits      = DAYINFO_SEIZA_TRAITS[$sign['code']] ?? null;

            return [
                'available'    => true,
                'name'         => $sign['name'],
                'code'         => $sign['code'],
                'symbol'       => $sign['symbol'],
                'suffix'       => $sign['suffix'],
                'period'       => $sign['period'],
                'element_name' => $elementName,
                'quality_name' => $qualityName,
                'personality'  => $traits['personality'] ?? '',
                'strength'     => $traits['strength'] ?? '',
                'url'          => $slug !== null ? "/articles/seiza/{$slug}/" : null,
            ];
        }
    }

    // 理論上、SEIZA_SIGNSは1年366日をすべてカバーしているため到達しない。
    // 万一データ不整合があった場合に備えたフォールバック。
    return ['available' => false];
}
