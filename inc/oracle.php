<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Tokyo');

// ══════════════════════════════════════════════════════════════════
// 六曜計算
// ══════════════════════════════════════════════════════════════════
function getRokuyo(int $year, int $month, int $day): array {
    // 旧暦月日の合計 mod 6 で六曜を算出（簡易版）
    // 旧暦変換は完全実装が複雑なため、広く使われる近似計算を使用
    $jd = myGregorianToJD($year, $month, $day);
    $lunarInfo = jdToLunar($jd);
    $lunarMonth = $lunarInfo['month'];
    $lunarDay   = $lunarInfo['day'];

    $rokuyoList = [
        ['name'=>'大安', 'en'=>'Taian',    'class'=>'taian',   'color'=>'#c9a84c',
         'desc'=>'六曜の中で最も縁起が良い日。婚礼・開業・旅行など万事に大吉。'],
        ['name'=>'赤口', 'en'=>'Shakku',   'class'=>'shakku',  'color'=>'#e8719a',
         'desc'=>'午の刻（11〜13時）のみ吉。それ以外は凶とされ、特に血や火に注意。'],
        ['name'=>'先勝', 'en'=>'Sensho',   'class'=>'sensho',  'color'=>'#9b72ef',
         'desc'=>'急ぐことが吉の日。午前中が吉、午後は凶。訴訟・交渉事に向く。'],
        ['name'=>'友引', 'en'=>'Tomobiki', 'class'=>'tomobiki','color'=>'#4ecdc4',
         'desc'=>'友を引く日。慶事は吉、弔事は凶。正午は凶、朝夕は吉とされる。'],
        ['name'=>'先負', 'en'=>'Senbu',    'class'=>'senbu',   'color'=>'#8a7db5',
         'desc'=>'急ぐことを避ける日。午前中は凶、午後は吉。静かに過ごすが吉。'],
        ['name'=>'仏滅', 'en'=>'Butsumetsu','class'=>'butsumetsu','color'=>'#6b6456',
         'desc'=>'六曜で最も縁起が悪い日とされる。物事は控えめに。新規着手は避けて。'],
    ];

    $idx = ($lunarMonth + $lunarDay) % 6;
    return $rokuyoList[$idx];
}

function myGregorianToJD(int $y, int $m, int $d): int {
    if ($m <= 2) { $y--; $m += 12; }
    $a = (int)($y / 100);
    $b = 2 - $a + (int)($a / 4);
    return (int)(365.25 * ($y + 4716)) + (int)(30.6001 * ($m + 1)) + $d + $b - 1524;
}

function jdToLunar(int $jd): array {
    // 簡易旧暦推算
    $cycle = $jd - 2451550; // 2000/1/6 新月基準
    $monthNum = (int)($cycle / 29.53059);
    $monthStart = (int)(2451550 + $monthNum * 29.53059);
    $day = $jd - $monthStart + 1;
    $month = (($monthNum % 12) + 12) % 12 + 1;
    return ['month' => $month, 'day' => $day];
}

// ══════════════════════════════════════════════════════════════════
// ラッキーアイテム生成
// ══════════════════════════════════════════════════════════════════
function getLuckyItems(string $dateStr): array {
    $seed = crc32($dateStr);
    mt_srand($seed);

    $colors = [
        ['name'=>'ゴールド',       'meaning'=>'成功と繁栄を引き寄せる'],
        ['name'=>'ラベンダー',     'meaning'=>'直感と霊感を高める'],
        ['name'=>'エメラルドグリーン','meaning'=>'癒しと成長をもたらす'],
        ['name'=>'ロイヤルブルー', 'meaning'=>'信頼と知性を象徴する'],
        ['name'=>'パールホワイト', 'meaning'=>'純粋さと新しい始まりの色'],
        ['name'=>'ディープレッド', 'meaning'=>'情熱と生命力を強化する'],
        ['name'=>'シルバー',       'meaning'=>'月のエネルギーで直感が冴える'],
        ['name'=>'コーラルピンク', 'meaning'=>'愛情運と人間関係を向上させる'],
        ['name'=>'アンバー',       'meaning'=>'安定と地に足のついた運を呼ぶ'],
        ['name'=>'ターコイズ',     'meaning'=>'コミュニケーション力が高まる'],
        ['name'=>'バイオレット',   'meaning'=>'精神的な覚醒と変容を促す'],
        ['name'=>'シャンパンゴールド','meaning'=>'喜びと豊かさのエネルギー'],
    ];

    $items = [
        ['cat'=>'食べ物', 'list'=>['はちみつトースト','抹茶ラテ','赤い果実のタルト','金柑','白桃','栗ご飯','カモミールティー','柚子入り和菓子','ざくろジュース','生姜湯','ブルーベリームフィン','塩麹のおにぎり','松の実入りサラダ','ホットチョコレート','れんこんのきんぴら']],
        ['cat'=>'場所',   'list'=>['神社の境内','水辺のベンチ','花屋の前','図書館の窓際','丘の上','朝の公園','老舗の喫茶店','海が見える場所','雑貨屋さん','竹林の小道','星空の見える屋上','静かな寺院','美術館のカフェ','川沿いの散歩道','植物園']],
        ['cat'=>'行動',   'list'=>['深呼吸を3回','日記を書く','好きな音楽を聴く','窓を開けて換気','誰かに感謝を伝える','手紙を書く','瞑想10分','花を飾る','早起きして朝日を見る','お気に入りの香りを嗅ぐ','断捨離を少しだけ','新しいルートを歩く','星座を調べる','笑顔で挨拶する','空を見上げる']],
        ['cat'=>'アイテム','list'=>['水晶のさざれ石','白いハンカチ','香りのよいキャンドル','お気に入りの文房具','四葉のクローバー押し花','パール系のアクセサリー','新しい手帳','天然石のブレスレット','木製のコースター','金色のしおり','アロマオイル','お守り','シルクのスカーフ','銀のコイン','お気に入りの本']],
    ];

    $result = [];

    // ラッキーカラー
    $colorIdx = mt_rand(0, count($colors) - 1);
    $result['color'] = $colors[$colorIdx];

    // ラッキーナンバー（1〜49から）
    $result['number'] = mt_rand(1, 49);

    // 各カテゴリからランダムに1つ
    foreach ($items as $cat) {
        $idx = mt_rand(0, count($cat['list']) - 1);
        $result['items'][] = [
            'cat'  => $cat['cat'],
            'item' => $cat['list'][$idx],
        ];
    }

    // 今日のメッセージ
    $messages = [
        '今日は自分の直感を信じて行動しましょう。迷ったときは心の声に従って。',
        '小さな幸せに気づく日。日常の中に隠れた喜びを見つけてみて。',
        '新しい出会いや情報が幸運を呼ぶ日。アンテナを高く張っておいて。',
        '過去を手放し、今この瞬間に集中することで運気が上昇します。',
        '感謝の気持ちを大切にする日。ありがとうの一言が奇跡を呼びます。',
        '創造性が高まる日。アイデアをメモしておくことで後で開花します。',
        '人とのつながりが幸運の鍵。誰かのために動くことで自分も豊かになる。',
        '休息も運気のうち。無理をせず、心と体をいたわる日にしましょう。',
        '変化を恐れないで。今日の小さな一歩が大きな変容につながっています。',
        '自分を愛することが最高の開運行動。まず自分を大切にしましょう。',
        '言葉に力がある日。ポジティブな言葉を意識的に使ってみましょう。',
        '自然のエネルギーと同調する日。空や緑に触れると運気が整います。',
    ];
    $msgIdx = mt_rand(0, count($messages) - 1);
    $result['message'] = $messages[$msgIdx];

    return $result;
}

// カテゴリ名から今日のアイテムを1つ取り出す
function getLuckyItemByCat(array $luckyItems, string $cat): string {
    foreach ($luckyItems['items'] as $item) {
        if ($item['cat'] === $cat) return $item['item'];
    }
    return '';
}
