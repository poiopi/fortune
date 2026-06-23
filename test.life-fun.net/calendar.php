<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 六曜計算
// ══════════════════════════════════════════════════════════════════
function getRokuyo(int $year, int $month, int $day): array {
    // 旧暦月日の合計 mod 6 で六曜を算出（簡易版）
    // 旧暦変換は完全実装が複雑なため、広く使われる近似計算を使用
    $lunarMonth = $month;
    $lunarDay   = $day;

    // 簡易旧暦推算（誤差±1日程度）
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
    $lunarEpoch = 2299161; // グレゴリオ暦開始のユリウス日
    $cycle = $jd - 2451550; // 2000/1/6 新月基準
    $monthNum = (int)($cycle / 29.53059) ;
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

    $numbers = range(1, 99);
    shuffle($numbers); // mt_srand済みなのでシード固定

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

// ══════════════════════════════════════════════════════════════════
// カレンダー生成
// ══════════════════════════════════════════════════════════════════
$today     = new DateTimeImmutable();
$year      = (int)$today->format('Y');
$month     = (int)$today->format('n');
$todayDay  = (int)$today->format('j');

// リクエストで月を切り替え可能
if (isset($_GET['y'], $_GET['m'])) {
    $year  = (int)$_GET['y'];
    $month = max(1, min(12, (int)$_GET['m']));
}

$firstDay  = new DateTimeImmutable("$year-$month-01");
$daysInMonth = (int)$firstDay->format('t');
$startWeekday = (int)$firstDay->format('w'); // 0=日, 6=土

$todayStr  = $today->format('Y-m-d');
$luckyItems = getLuckyItems($todayStr);
$rokuyo     = getRokuyo((int)$today->format('Y'), (int)$today->format('n'), (int)$today->format('j'));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
 <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-P1EKB3WWX8');
  </script>
<meta charset="UTF-8">
<!-- calendar.php -->
<link rel="canonical" href="https://life-fun.net/calendar.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="今日の六曜・大安カレンダーとラッキーアイテムを毎日更新。開運情報を一覧でチェック。">
<title>開運カレンダー｜今日の六曜とラッキーアイテム</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<!-- AdSense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #08060f;
  --card:    #1e1738;
  --card2:   #251d42;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.32);
  --gold:    #c9a84c;
  --gold-lt: #e8c96a;
  --violet:  #9b72ef;
  --violet-lt:#c4a8f5;
  --rose:    #e8719a;
  --teal:    #4ecdc4;
  --text:    #e8e2f5;
  --muted:   #8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{
  background:var(--void);
  color:var(--text);
  font-family:var(--ff-sans);
  font-weight:300;
  line-height:1.8;
  min-height:100vh;
}
body::before{
  content:'';position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),
    radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);
  pointer-events:none;z-index:0;
}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

/* ── HEADER ── */
header{
  border-bottom:1px solid var(--border);padding:0 1.2rem;
  position:sticky;top:0;z-index:100;
  background:rgba(8,6,15,.9);backdrop-filter:blur(12px);
}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}

/* ── HERO ── */
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.8rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-date{font-family:var(--ff-serif);font-size:1rem;color:var(--muted);letter-spacing:.08em}

/* ── 今日の運勢ヘッダー ── */
.today-band{
  background:linear-gradient(135deg,rgba(201,168,76,.12),rgba(155,114,239,.08));
  border:1px solid rgba(201,168,76,.25);
  border-radius:14px;padding:1.5rem 1.8rem;margin-bottom:1.5rem;
}
.today-band-inner{display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap}
.rokuyo-badge{
  text-align:center;min-width:80px;
  padding:.8rem 1.2rem;border-radius:10px;
  border:2px solid;
}
.rokuyo-name{font-family:var(--ff-serif);font-size:1.8rem;font-weight:700;line-height:1}
.rokuyo-en{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.12em;opacity:.7;margin-top:.3rem}
.rokuyo-desc{font-size:.82rem;color:var(--muted);flex:1;line-height:1.8}
.today-msg{
  width:100%;font-family:var(--ff-serif);font-size:.95rem;
  color:var(--gold-lt);font-style:italic;line-height:1.7;
  padding-top:1rem;border-top:1px solid var(--border);margin-top:.5rem;
}

/* 六曜色 */
.taian{border-color:#c9a84c;background:rgba(201,168,76,.08)}
.taian .rokuyo-name{color:#c9a84c}
.shakku{border-color:#e8719a;background:rgba(232,113,154,.08)}
.shakku .rokuyo-name{color:#e8719a}
.sensho{border-color:#9b72ef;background:rgba(155,114,239,.08)}
.sensho .rokuyo-name{color:#9b72ef}
.tomobiki{border-color:#4ecdc4;background:rgba(78,205,196,.08)}
.tomobiki .rokuyo-name{color:#4ecdc4}
.senbu{border-color:#8a7db5;background:rgba(138,125,181,.08)}
.senbu .rokuyo-name{color:#8a7db5}
.butsumetsu{border-color:#6b6456;background:rgba(107,100,86,.08)}
.butsumetsu .rokuyo-name{color:#8a7db5}

/* ── LUCKY ITEMS ── */
.lucky-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;margin-bottom:1.5rem}
.lucky-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.2rem;position:relative;overflow:hidden}
.lucky-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--violet),var(--gold))}
.lucky-cat{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.14em;color:var(--muted);text-transform:uppercase;margin-bottom:.5rem}
.lucky-value{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);line-height:1.3}
.lucky-note{font-size:.75rem;color:var(--muted);margin-top:.4rem;line-height:1.6}

.lucky-number{
  display:inline-flex;align-items:center;justify-content:center;
  width:48px;height:48px;
  border-radius:50%;
  background:linear-gradient(135deg,var(--violet),var(--rose));
  font-family:var(--ff-serif);font-size:1.5rem;font-weight:700;
  color:#fff;margin-bottom:.4rem;
}

/* ── AdSense ── */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
/* ── カレンダー ── */
.cal-section{margin-bottom:2.5rem}
.cal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
.cal-title{font-family:var(--ff-serif);font-size:1.2rem;font-weight:700;color:var(--gold-lt);letter-spacing:.06em}
.cal-nav{display:flex;gap:.5rem}
.cal-nav a{
  font-family:var(--ff-mono);font-size:.72rem;padding:.35rem .9rem;
  border:1px solid var(--border2);border-radius:6px;color:var(--muted);
  text-decoration:none;transition:all .15s;
}
.cal-nav a:hover{background:var(--violet);color:#fff;border-color:var(--violet)}

.cal-grid{background:var(--card);border:1px solid var(--border);border-radius:14px;overflow:hidden}
.cal-weekdays{display:grid;grid-template-columns:repeat(7,1fr);border-bottom:1px solid var(--border)}
.cal-weekday{text-align:center;padding:.6rem .2rem;font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.06em;color:var(--muted)}
.cal-weekday:first-child{color:#e87070}
.cal-weekday:last-child{color:#7090e8}

.cal-days{display:grid;grid-template-columns:repeat(7,1fr);gap:1px;background:var(--border)}
.cal-day{background:var(--card);padding:.5rem .3rem;min-height:72px;position:relative;transition:background .15s;cursor:default}
.cal-day:hover{background:var(--card2)}
.cal-day.empty{background:rgba(0,0,0,.2);cursor:default}
.cal-day.today{background:linear-gradient(135deg,rgba(155,114,239,.15),rgba(201,168,76,.1));outline:1px solid var(--gold)}
.day-num{font-family:var(--ff-mono);font-size:.8rem;text-align:right;margin-bottom:.2rem;padding-right:.2rem}
.cal-day.today .day-num{color:var(--gold-lt);font-weight:700}
.sun .day-num{color:#e87070}
.sat .day-num{color:#7090e8}
.day-rokuyo{font-family:var(--ff-serif);font-size:.62rem;text-align:center;padding:.1rem .2rem;border-radius:3px;margin-top:.2rem;line-height:1.2}
.day-rokuyo.taian{background:rgba(201,168,76,.2);color:#c9a84c;font-weight:700}
.day-rokuyo.shakku{background:rgba(232,113,154,.15);color:#e8719a}
.day-rokuyo.sensho{background:rgba(155,114,239,.15);color:#c4a8f5}
.day-rokuyo.tomobiki{background:rgba(78,205,196,.15);color:#4ecdc4}
.day-rokuyo.senbu{background:rgba(138,125,181,.12);color:#8a7db5}
.day-rokuyo.butsumetsu{background:rgba(107,100,86,.12);color:#6b6456}

/* ── フッター ── */
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

@media(max-width:600px){
  .today-band-inner{flex-direction:column;align-items:flex-start}
  .lucky-grid{grid-template-columns:1fr 1fr}
  .cal-day{min-height:56px;padding:.3rem .2rem}
  .day-rokuyo{font-size:.55rem}
}
/* ======================
   三星鑑定について
====================== */
.about-box{
    max-width:900px;
    margin:2rem auto 3rem;
    padding:2rem;
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.1);
    border-radius:24px;
    backdrop-filter:blur(8px);
}

.about-box h2{
    text-align:center;
    margin-bottom:1.8rem;
    font-size:1.5rem;
    color:#ffe6a8;
}

.about-item{
    display:flex;
    align-items:flex-start;
    gap:1rem;
    margin-bottom:1.5rem;
}

.about-item:last-child{
    margin-bottom:0;
}

.about-item span{
    font-size:1.5rem;
    flex-shrink:0;
}

.about-item p{
    margin:0;
    line-height:1.9;
    color:#ddd;
}

@media(max-width:768px){

    .about-box{
        margin:1.5rem 1rem 2rem;
        padding:1.5rem;
    }

    .about-item{
        gap:.8rem;
    }

    .about-item span{
        font-size:1.3rem;
    }

    .about-box h2{
        font-size:1.2rem;
    }

}
/* ── スマホメニュー ── */
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{
    display:flex;align-items:center;gap:.4rem;
    font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;
    color:var(--muted);background:none;
    border:1px solid var(--border);border-radius:6px;
    padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s;
  }
  .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
  .sp-dropdown{
    display:none;position:absolute;top:54px;right:1.2rem;
    background:rgba(8,6,15,.97);border:1px solid var(--border2);
    border-radius:12px;overflow:hidden;z-index:200;min-width:180px;
    backdrop-filter:blur(16px);
  }
  .sp-dropdown.open{display:block}
  .sp-dropdown a{
    display:block;padding:.85rem 1.25rem;
    font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
    color:var(--muted);text-decoration:none;
    border-bottom:1px solid var(--border);transition:color .2s,background .2s;
  }
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
  .sp-dropdown span{
    display:block;padding:.85rem 1.25rem;
    font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
    color:var(--text);border-bottom:1px solid var(--border);
  }
  .sp-dropdown span:last-child{border-bottom:none}
}
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
</style>
<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>
<?php $currentPage='calendar'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">Lucky Calendar</span>
    <h1>開運カレンダー</h1>
    <p class="hero-date"><?= $today->format('Y年n月j日（') . ['日','月','火','水','木','金','土'][(int)$today->format('w')] . '）' ?></p>
  </section>

  <!-- 今日の六曜＋メッセージ -->
  <div class="today-band">
    <div class="today-band-inner">
      <div class="rokuyo-badge <?= $rokuyo['class'] ?>">
        <div class="rokuyo-name"><?= $rokuyo['name'] ?></div>
        <div class="rokuyo-en"><?= $rokuyo['en'] ?></div>
      </div>
      <div class="rokuyo-desc">
        <strong style="color:var(--text)">今日は「<?= $rokuyo['name'] ?>」</strong><br>
        <?= $rokuyo['desc'] ?>
      </div>
      <div class="today-msg">&#x2726; <?= $luckyItems['message'] ?></div>
    </div>
  </div>

  <!-- ラッキーアイテム -->
  <div class="lucky-grid">

    <!-- ラッキーカラー -->
    <div class="lucky-card">
      <div class="lucky-cat">Lucky Color</div>
      <div style="display:flex;align-items:center;gap:.7rem;margin-bottom:.4rem">
        <div style="width:32px;height:32px;border-radius:50%;background:<?= '#d4a83a' ?>;border:2px solid rgba(255,255,255,.2)"></div>
        <div class="lucky-value"><?= $luckyItems['color']['name'] ?></div>
      </div>
      <div class="lucky-note"><?= $luckyItems['color']['meaning'] ?></div>
    </div>

    <!-- ラッキーナンバー -->
    <div class="lucky-card">
      <div class="lucky-cat">Lucky Number</div>
      <div class="lucky-number"><?= $luckyItems['number'] ?></div>
      <div class="lucky-note">今日のあなたを導く数字。<br>日常の中で意識してみて。</div>
    </div>

    <!-- ラッキーアイテム各種 -->
    <?php foreach($luckyItems['items'] as $item): ?>
    <div class="lucky-card">
      <div class="lucky-cat"><?= $item['cat'] ?></div>
      <div class="lucky-value"><?= $item['item'] ?></div>
      <div class="lucky-note">今日の開運アイテム</div>
    </div>
    <?php endforeach; ?>

  </div>

  <!-- AdSense枠 -->
  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <!-- カレンダー -->
  <section class="cal-section">
    <div class="cal-header">
      <div class="cal-title"><?= $year ?>年 <?= $month ?>月</div>
      <div class="cal-nav">
        <?php
          $prev = new DateTimeImmutable("$year-$month-01");
          $prev = $prev->modify('-1 month');
          $next = new DateTimeImmutable("$year-$month-01");
          $next = $next->modify('+1 month');
        ?>
        <a href="?y=<?= $prev->format('Y') ?>&m=<?= $prev->format('n') ?>">&#9664; 前月</a>
        <a href="?y=<?= $next->format('Y') ?>&m=<?= $next->format('n') ?>">翌月 &#9654;</a>
      </div>
    </div>

    <div class="cal-grid">
      <div class="cal-weekdays">
        <?php foreach(['日','月','火','水','木','金','土'] as $w): ?>
        <div class="cal-weekday"><?= $w ?></div>
        <?php endforeach; ?>
      </div>

      <div class="cal-days">
        <?php
          // 空白セル
          for($i = 0; $i < $startWeekday; $i++):
        ?>
        <div class="cal-day empty"></div>
        <?php endfor; ?>

        <?php for($d = 1; $d <= $daysInMonth; $d++):
          $thisDate   = new DateTimeImmutable("$year-$month-$d");
          $weekday    = (int)$thisDate->format('w');
          $isToday    = ($year === (int)$today->format('Y') && $month === (int)$today->format('n') && $d === $todayDay);
          $dayRokuyo  = getRokuyo($year, $month, $d);
          $dayClass   = 'cal-day';
          if($weekday === 0) $dayClass .= ' sun';
          if($weekday === 6) $dayClass .= ' sat';
          if($isToday)       $dayClass .= ' today';
        ?>
        <div class="<?= $dayClass ?>">
          <div class="day-num"><?= $d ?></div>
          <div class="day-rokuyo <?= $dayRokuyo['class'] ?>"><?= $dayRokuyo['name'] ?></div>
        </div>
        <?php endfor; ?>
      </div>
    </div>
 <div class="about-box">
    <h2>開運カレンダーについて</h2>
    <div class="about-item">
      <span>📅</span>
    <p>毎日更新される開運カレンダーで、今日の六曜（大安・友引・先勝など）とラッキーアイテムをチェックできます。</p>
  </div>
  <div class="about-item">
    <span>🌟</span>
    <p>カレンダーで月ごとの六曜を確認しながら、ラッキーカラーやラッキーナンバー、開運アイテムを参考に一日を過ごしてみてください。前月・翌月ボタンで他の月にも切り替えられます。</p>
  </div>
  <div class="about-item">
    <span>🌙</span>
    <p>本サービスはエンターテインメントを目的とした開運情報です。医学・法律・投資などの専門的な助言を行うものではありません。</p>
  </div>
</div>
  </section>

  <?php require __DIR__.'/inc/share-btns.php'; ?>

  <!-- AdSense枠 -->
  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="nav-cards-section" style="padding:2rem 0 0"><h3>✦ 次はこれを試してみては？ ✦</h3><?= _nav_cards(3,'calendar') ?></div>

</div>

<?php require __DIR__.'/inc/footer.php'; ?>
<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});
</script>
</body>
</html>
