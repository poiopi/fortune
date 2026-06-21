<?php
declare(strict_types=1);

function calcKyusei(int $y, int $m, int $d): int {
    if ($m === 1 || ($m === 2 && $d <= 3)) $y--;
    $sum = 0;
    foreach (str_split((string)$y) as $c) $sum += (int)$c;
    while ($sum > 9) {
        $s = 0;
        foreach (str_split((string)$sum) as $c) $s += (int)$c;
        $sum = $s;
    }
    $star = 11 - $sum;
    if ($star > 9) $star -= 9;
    if ($star === 0) $star = 9;
    return $star;
}

function calcMonthStar(int $y, int $m, int $d): int {
    if ($m === 1 || ($m === 2 && $d <= 3)) $y--;
    $yearStar = calcKyusei($y, 3, 1);
    $baseMap = [1=>8, 2=>5, 3=>2, 4=>8, 5=>5, 6=>2, 7=>8, 8=>5, 9=>2];
    $base = $baseMap[$yearStar];
    $monthOffset = ($m - 1 + 12) % 12;
    $star = $base - $monthOffset;
    while ($star <= 0) $star += 9;
    while ($star > 9) $star -= 9;
    return $star;
}

function getKyuseiData(int $star): array {
    $data = [
        1 => ['name'=>'一白水星','en'=>'Ippaku Suisei','element'=>'水','color'=>'ホワイト・ブラック','symbol'=>'💧','direction'=>'北','number'=>1,'planet'=>'水星','desc'=>'流れる水のように柔軟で適応力が高く、人の心を読む鋭い直感を持ちます。表面は穏やかですが、内に強い意志を秘めた行動力があります。','personality'=>'知的・感受性豊か・柔軟・忍耐強い・秘密を守る','lucky_color'=>'ホワイト・クリーム','lucky_dir'=>'北・北西','lucky_num'=>'1・6','fortune'=>'流れに逆らわず、直感を信じて進むことで道が開ける。人脈が重要な鍵となる時期。','caution'=>'感情の波に流されやすい面に注意。','job'=>'外交・貿易・水産業・流通・占い師'],
        2 => ['name'=>'二黒土星','en'=>'Jikoku Dosei','element'=>'土','color'=>'ブラック・イエロー','symbol'=>'🌍','direction'=>'南西','number'=>2,'planet'=>'土星','desc'=>'大地のように安定し、勤勉で忍耐強い性格。縁の下の力持ちとして周囲を支えることを得意とします。母性的な温かさと包容力を持ちます。','personality'=>'勤勉・忍耐・慎重・包容力・奉仕精神','lucky_color'=>'イエロー・ブラウン','lucky_dir'=>'南西・北東','lucky_num'=>'2・5・8','fortune'=>'地道な努力が実を結ぶ時期。焦らず着実に積み上げることで大きな成果が。','caution'=>'心配性になりすぎず、自分を信じて。','job'=>'農業・不動産・介護・教育・料理'],
        3 => ['name'=>'三碧木星','en'=>'Sanpeki Mokusei','element'=>'木','color'=>'グリーン','symbol'=>'🌿','direction'=>'東','number'=>3,'planet'=>'木星','desc'=>'新芽が芽吹くような躍動感と行動力を持ちます。好奇心旺盛で発想力豊か。直感的に動き、常に新しいことへの挑戦を楽しみます。','personality'=>'行動力・積極的・明朗・好奇心旺盛・直感的','lucky_color'=>'グリーン・ブルー','lucky_dir'=>'東・南東','lucky_num'=>'3・8','fortune'=>'新しい挑戦が吉。積極的に動くことで運気が開花する。','caution'=>'衝動的な言動に注意。冷静さを保って。','job'=>'音楽・放送・電気・IT・スポーツ'],
        4 => ['name'=>'四緑木星','en'=>'Shiryoku Mokusei','element'=>'木','color'=>'グリーン・ホワイト','symbol'=>'🌳','direction'=>'南東','number'=>4,'planet'=>'木星','desc'=>'風のように自由で社交的。コミュニケーション能力に長け、人と人をつなぐ橋渡し役を自然に担います。信頼と誠実さを大切にする温かい性格。','personality'=>'社交的・誠実・信頼・柔軟・協調性','lucky_color'=>'グリーン・ホワイト','lucky_dir'=>'南東・東','lucky_num'=>'4・9','fortune'=>'人との縁が幸運を運ぶ。信頼関係を大切にすることで道が広がる。','caution'=>'優柔不断にならないよう意識して。','job'=>'貿易・外交・旅行・流通・ブライダル'],
        5 => ['name'=>'五黄土星','en'=>'Goou Dosei','element'=>'土','color'=>'イエロー','symbol'=>'⭐','direction'=>'中央','number'=>5,'planet'=>'土星','desc'=>'九星の中心に位置する帝王星。強烈なカリスマ性と支配力を持ち、吉凶ともに大きく出る波乱万丈な星。困難を乗り越えるたびに強くなります。','personality'=>'カリスマ・強運・波乱・執念・再生力','lucky_color'=>'イエロー・ゴールド','lucky_dir'=>'北西・西','lucky_num'=>'5・0','fortune'=>'大きな変化の時期。覚悟を持って進めば、大きな成功が待っている。','caution'=>'独断専行に注意。周囲の意見も大切に。','job'=>'経営者・政治家・宗教家・医療・投資'],
        6 => ['name'=>'六白金星','en'=>'Roppaku Kinsei','element'=>'金','color'=>'ホワイト・ゴールド','symbol'=>'👑','direction'=>'北西','number'=>6,'planet'=>'金星','desc'=>'天の星のように高い理想と品格を持ちます。リーダーシップと決断力に優れ、周囲から自然と一目置かれる存在。完璧主義で責任感が強い。','personality'=>'高潔・リーダーシップ・決断力・完璧主義・誇り高い','lucky_color'=>'ホワイト・シルバー','lucky_dir'=>'北西・西','lucky_num'=>'6・1','fortune'=>'リーダーシップを発揮する好機。大きな決断が吉と出る時期。','caution'=>'プライドが高すぎると孤立することも。','job'=>'経営・金融・法律・軍事・航空'],
        7 => ['name'=>'七赤金星','en'=>'Shichiseki Kinsei','element'=>'金','color'=>'レッド・ゴールド','symbol'=>'✨','direction'=>'西','number'=>7,'planet'=>'金星','desc'=>'秋の実りを象徴する喜びと豊かさの星。社交的で話術に長け、場を明るくする天性の才能を持ちます。金運・恋愛運ともに強い。','personality'=>'社交的・話術・楽観的・享楽的・金運強い','lucky_color'=>'ゴールド・レッド','lucky_dir'=>'西・北西','lucky_num'=>'7・2','fortune'=>'金運・恋愛運ともに上昇中。楽しむことが運気アップの秘訣。','caution'=>'浪費・口のすべりに注意。','job'=>'芸能・飲食・金融・接客・美容'],
        8 => ['name'=>'八白土星','en'=>'Hakkaku Dosei','element'=>'土','color'=>'ホワイト・イエロー','symbol'=>'⛰️','direction'=>'北東','number'=>8,'planet'=>'土星','desc'=>'山のように堂々とした安定感と変革の力を持ちます。粘り強く努力し、逆境でも諦めない不屈の精神。時間をかけて大きな成果を生み出します。','personality'=>'堅実・粘り強い・変革・蓄財・不屈','lucky_color'=>'ホワイト・イエロー','lucky_dir'=>'北東・南西','lucky_num'=>'8・3','fortune'=>'変化と蓄積の時期。焦らず土台を固めることで大きな飛躍が訪れる。','caution'=>'頑固になりすぎず、変化を恐れないで。','job'=>'不動産・建築・保険・宗教・相続'],
        9 => ['name'=>'九紫火星','en'=>'Kyushi Kasei','element'=>'火','color'=>'パープル・レッド','symbol'=>'🔥','direction'=>'南','number'=>9,'planet'=>'火星','desc'=>'太陽のように輝く美と知性の星。鋭い直感と洗練されたセンスを持ち、芸術や文化の分野で才能を発揮します。名誉と社会的地位に縁があります。','personality'=>'知性・美的センス・直感・名誉・情熱','lucky_color'=>'パープル・レッド','lucky_dir'=>'南・東','lucky_num'=>'9・4','fortune'=>'才能が輝く時期。美しいもの・文化的なことへの投資が吉。','caution'=>'感情的になりやすい面に注意。冷静な判断を。','job'=>'芸術・美容・広告・医療・教育'],
    ];
    return $data[$star];
}

function getLuckyDirections(int $star): array {
    $dirs = [
        1 => ['吉'=>['北','西','北西'],'凶'=>['南','東','南東']],
        2 => ['吉'=>['南西','北東','中央'],'凶'=>['東','北','南東']],
        3 => ['吉'=>['東','南東','南'],'凶'=>['西','北西','北']],
        4 => ['吉'=>['南東','東','南'],'凶'=>['北西','西','北']],
        5 => ['吉'=>['北西','西','南西'],'凶'=>['東','南東','南']],
        6 => ['吉'=>['北西','西','北'],'凶'=>['南東','東','南']],
        7 => ['吉'=>['西','北西','南西'],'凶'=>['東','南東','南']],
        8 => ['吉'=>['北東','南西','中央'],'凶'=>['南','東','南東']],
        9 => ['吉'=>['南','東','南東'],'凶'=>['北','西','北西']],
    ];
    return $dirs[$star];
}

$result = null;
$errors = [];

if (isset($_GET['birthdate']) && $_GET['birthdate'] !== '') {
    $birthdate = trim($_GET['birthdate'] ?? '');
    if (empty($birthdate)) {
        $errors[] = '生年月日を入力してください。';
    }
    if (empty($errors)) {
        $date  = new DateTimeImmutable($birthdate);
        $y     = (int)$date->format('Y');
        $m     = (int)$date->format('n');
        $d     = (int)$date->format('j');
        $star  = calcKyusei($y, $m, $d);
        $mstar = calcMonthStar($y, $m, $d);
        $data  = getKyuseiData($star);
        $mdata = getKyuseiData($mstar);
        $dirs  = getLuckyDirections($star);
        $result = ['birthdate'=>$date->format('Y年n月j日'),'star'=>$star,'mstar'=>$mstar,'data'=>$data,'mdata'=>$mdata,'dirs'=>$dirs];
    }
}
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
<link rel="canonical" href="https://life-fun.net/kyusei.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="生年月日から九星気学の本命星・月命星を算出。吉方位・運勢・性格を無料で診断します。">
<title>九星気学診断｜生年月日で導く本命星と吉方位</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#08060f;--card:#1e1738;--card2:#251d42;
  --border:rgba(160,130,220,.18);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8c96a;--violet:#9b72ef;--violet-lt:#c4a8f5;
  --rose:#e8719a;--teal:#4ecdc4;--text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}
header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px)}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.8rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}
.form-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:2rem;margin-bottom:2rem;position:relative;overflow:hidden}
.form-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal))}
.form-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);margin-bottom:1.5rem}
.form-group{margin-bottom:1.25rem}
.form-label{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.12em;color:var(--muted);display:block;margin-bottom:.5rem}
.form-input{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.75rem 1rem;font-family:var(--ff-sans);font-size:1rem;color:var(--text);outline:none;transition:border-color .2s}
.form-input:focus{border-color:var(--violet)}
.submit-btn{width:100%;background:linear-gradient(135deg,var(--gold),var(--violet));border:none;border-radius:10px;padding:.85rem;font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:#fff;cursor:pointer;letter-spacing:.06em;transition:opacity .2s;margin-top:.5rem}
.submit-btn:hover{opacity:.85}
.error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:8px;padding:.75rem 1rem;margin-bottom:1rem;font-size:.88rem;color:var(--rose)}
.result-hero{text-align:center;padding:1.5rem 0 1.25rem;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
.star-symbol{font-size:3rem;margin-bottom:.5rem;display:block}
.result-star-num{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--gold);background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.25);border-radius:20px;padding:.25rem .9rem;display:inline-block;margin-bottom:.6rem}
.result-star-name{font-family:var(--ff-serif);font-size:2rem;font-weight:700;color:var(--gold-lt);margin-bottom:.2rem;letter-spacing:.08em}
.result-star-en{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--muted);margin-bottom:.75rem}
.result-desc{font-size:.9rem;color:var(--text);line-height:1.8;max-width:600px;margin:0 auto}
.info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;margin-bottom:1.25rem}
.info-card{background:var(--card2);border:1px solid var(--border);border-radius:10px;padding:.9rem;text-align:center}
.info-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.12em;color:var(--muted);margin-bottom:.3rem}
.info-val{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt)}
.personality-box{background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(155,114,239,.06));border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.25rem 1.5rem;margin-bottom:1.25rem}
.box-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt);margin-bottom:.75rem}
.tag-list{display:flex;flex-wrap:wrap;gap:.4rem;margin-bottom:.75rem}
.tag{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);background:rgba(160,130,220,.08);border:1px solid var(--border);border-radius:4px;padding:.2rem .6rem;letter-spacing:.04em}
.detail-text{font-size:.85rem;color:var(--muted);line-height:1.7}
.direction-box{background:var(--card2);border:1px solid var(--border);border-radius:12px;padding:1.25rem 1.5rem;margin-bottom:1.25rem}
.dir-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:.75rem}
.dir-item{background:rgba(0,0,0,.2);border-radius:8px;padding:.75rem}
.dir-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.1em;margin-bottom:.3rem}
.dir-label.good{color:var(--teal)}
.dir-label.bad{color:var(--rose)}
.dir-tag{font-family:var(--ff-serif);font-size:.85rem;color:var(--text);margin-right:.3rem}
.month-star-box{background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:12px;padding:1.25rem 1.5rem;margin-bottom:1.25rem}
.fortune-box{background:linear-gradient(135deg,rgba(78,205,196,.08),rgba(155,114,239,.06));border:1px solid rgba(78,205,196,.2);border-radius:12px;padding:1.25rem 1.5rem;margin-bottom:1.25rem}
.explain-grid{display:grid;gap:.75rem;margin-bottom:1.5rem}
.explain-item{background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.9rem 1rem}
.explain-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.1em;color:var(--gold);margin-bottom:.3rem}
.explain-text{font-size:.85rem;color:var(--muted);line-height:1.7}
.retry-btn{width:100%;font-family:var(--ff-mono);font-size:.72rem;letter-spacing:.1em;background:none;border:1px solid var(--border2);border-radius:8px;padding:.65rem;color:var(--muted);cursor:pointer;margin-top:.5rem;transition:color .2s,border-color .2s;text-decoration:none;display:block;text-align:center}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
.share-wrap{text-align:center;margin:1.5rem 0 1rem}
.share-label{font-family:var(--ff-rpg);font-size:.62rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.55rem}
.share-btns{display:flex;justify-content:center;gap:.45rem;flex-wrap:wrap}
.share-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.45rem .85rem;border-radius:20px;font-size:.7rem;font-family:var(--ff-rpg);cursor:pointer;text-decoration:none;border:none;transition:opacity .2s;white-space:nowrap}
.share-btn:hover{opacity:.8}
.share-line{background:#06C755;color:#fff}
.share-x{background:#000;color:#fff}
.share-fb{background:#1877F2;color:#fff}
.share-copy{background:rgba(155,114,239,.15);border:1px solid rgba(155,114,239,.35)!important;color:var(--violet-lt)}
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s}
  .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
  .sp-dropdown.open{display:block}
  .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
  .sp-dropdown span{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--text);border-bottom:1px solid var(--border)}
  .sp-dropdown span:last-child{border-bottom:none}
  .info-grid{grid-template-columns:1fr 1fr}
  .dir-grid{grid-template-columns:1fr}
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

<header>
  <div class="header-inner">
    <a href="/" class="logo">占い<em>Portal</em></a>
    <nav class="header-nav">
      <a href="/">トップ</a>
      <a href="/tarot.php">タロット</a>
      <a href="/calendar.php">カレンダー</a>
      <a href="/mbti.php">MBTI×星座</a>
      <a href="/numerology.php">数秘術</a>
      九星気学
      <a href="/rpg.php">RPG占い</a>
      <a href="/aisho.php">相性診断</a>
      <a href="/zense">前世診断</a>
    </nav>
    <div id="google_translate_element"></div>
    <button class="sp-menu-btn" onclick="toggleSpMenu()">☰ メニュー</button>
    <div class="sp-dropdown" id="spDropdown">
      <a href="/">トップ</a>
      <a href="/tarot.php">タロット</a>
      <a href="/calendar.php">開運カレンダー</a>
      <a href="/mbti.php">MBTI×星座</a>
      <a href="/numerology.php">数秘術</a>
      <span>九星気学</span>
      <a href="/rpg.php">RPG占い</a>
      <a href="/aisho.php">相性診断</a>
      <a href="/zense">前世診断</a>
    </div>
  </div>
</header>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">Kyusei Kigaku</span>
    <h1>九星気学診断</h1>
    <p class="hero-sub">生年月日から本命星・月命星を算出し、<br>あなたの吉方位・運勢・本質的な性格を読み解きます。</p>
  </section>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <?php if ($result === null): ?>

  <div class="form-card">
    <div class="form-title">生年月日を入力してください</div>
    <?php if (!empty($errors)): ?>
    <div class="error-box"><?php foreach ($errors as $e): ?><?= htmlspecialchars($e) ?><?php endforeach; ?></div>
    <?php endif; ?>
    <form method="get" action="">
      <div class="form-group">
        <label class="form-label" for="birthdate">生年月日</label>
        <input class="form-input" type="date" id="birthdate" name="birthdate" value="<?= htmlspecialchars($_GET['birthdate'] ?? '') ?>">
      </div>
      <button class="submit-btn" type="submit">本命星を算出する ✦</button>
    </form>
  </div>

  <div class="form-card">
    <div class="form-title">九星気学とは</div>
    <div class="explain-grid">
      <div class="explain-item"><div class="explain-label">本命星</div><div class="explain-text">生まれた年（節分基準）から算出される最も重要な星。その人の本質的な性格・運命・適職を示します。</div></div>
      <div class="explain-item"><div class="explain-label">月命星</div><div class="explain-text">生まれた月から算出される星。本命星を補完し、才能や対人関係の傾向を示します。</div></div>
      <div class="explain-item"><div class="explain-label">吉方位</div><div class="explain-text">本命星ごとに定まる運気の上がる方角。引越し・旅行・仕事の方角選びに活用できます。</div></div>
      <div class="explain-item"><div class="explain-label">節分について</div><div class="explain-text">九星気学では2月3日（節分）が年の切り替わり。1〜2月3日生まれの方は前年の星が本命星になります。</div></div>
    </div>
  </div>

  <?php else: ?>

  <div class="form-card">
    <div class="result-hero">
      <span class="star-symbol"><?= $result['data']['symbol'] ?></span>
      <div class="result-star-num">本命星 第<?= $result['star'] ?>星</div>
      <div class="result-star-name"><?= $result['data']['name'] ?></div>
      <div class="result-star-en"><?= $result['data']['en'] ?></div>
      <div class="result-desc"><?= $result['data']['desc'] ?></div>
    </div>

    <div class="info-grid">
      <div class="info-card"><div class="info-label">五行元素</div><div class="info-val"><?= $result['data']['element'] ?></div></div>
      <div class="info-card"><div class="info-label">象徴方位</div><div class="info-val"><?= $result['data']['direction'] ?></div></div>
      <div class="info-card"><div class="info-label">守護星</div><div class="info-val"><?= $result['data']['planet'] ?></div></div>
      <div class="info-card"><div class="info-label">ラッキーカラー</div><div class="info-val" style="font-size:.85rem"><?= $result['data']['lucky_color'] ?></div></div>
      <div class="info-card"><div class="info-label">ラッキーナンバー</div><div class="info-val"><?= $result['data']['lucky_num'] ?></div></div>
      <div class="info-card"><div class="info-label">適職</div><div class="info-val" style="font-size:.75rem;line-height:1.4"><?= $result['data']['job'] ?></div></div>
    </div>

    <div class="personality-box">
      <div class="box-title">性格・特性</div>
      <div class="tag-list">
        <?php foreach (explode('・', $result['data']['personality']) as $p): ?>
        <span class="tag"><?= $p ?></span>
        <?php endforeach; ?>
      </div>
      <div class="detail-text">
        <strong style="color:var(--text)">恋愛：</strong><?= $result['data']['love'] ?><br>
        <strong style="color:var(--text)">仕事：</strong><?= $result['data']['work'] ?>
      </div>
    </div>

    <div class="direction-box">
      <div class="box-title">吉方位・凶方位</div>
      <div class="dir-grid">
        <div class="dir-item">
          <div class="dir-label good">✦ 吉方位（運気が上がる方角）</div>
          <?php foreach ($result['dirs']['吉'] as $d): ?><span class="dir-tag">【<?= $d ?>】</span><?php endforeach; ?>
        </div>
        <div class="dir-item">
          <div class="dir-label bad">✦ 凶方位（避けたい方角）</div>
          <?php foreach ($result['dirs']['凶'] as $d): ?><span class="dir-tag">【<?= $d ?>】</span><?php endforeach; ?>
        </div>
      </div>
      <div style="font-size:.75rem;color:var(--muted);margin-top:.75rem;line-height:1.6">※吉方位への引越し・旅行・仕事は運気上昇につながるとされています。</div>
    </div>

    <div class="month-star-box">
      <div class="box-title">月命星：<?= $result['mdata']['symbol'] ?> <?= $result['mdata']['name'] ?>（第<?= $result['mstar'] ?>星）</div>
      <div style="font-size:.85rem;color:var(--muted);line-height:1.7"><?= $result['mdata']['desc'] ?></div>
      <div style="font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-top:.5rem">キーワード：<?= $result['mdata']['personality'] ?></div>
    </div>

    <div class="fortune-box">
      <div class="box-title">今の運勢メッセージ</div>
      <div style="font-family:var(--ff-serif);font-size:1rem;color:var(--gold-lt);font-style:italic;line-height:1.8;margin-bottom:.5rem"><?= $result['data']['fortune'] ?></div>
      <div style="font-size:.82rem;color:var(--rose)">⚠ <?= $result['data']['caution'] ?></div>
    </div>

    <div class="share-wrap">
      <p class="share-label">✦ 結果をシェアする</p>
      <div class="share-btns">
        <button class="share-btn share-line" onclick="openShare('line')">LINE</button>
        <button class="share-btn share-x" onclick="openShare('x')">𝕏</button>
        <button class="share-btn share-fb" onclick="openShare('fb')">Facebook</button>
        <button class="share-btn share-copy" onclick="copyShareUrl()">🔗 リンクをコピー</button>
      </div>
    </div>
    <a href="/kyusei.php" class="retry-btn">もう一度診断する</a>
  </div>

  <?php endif; ?>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

</div>

<p style="max-width:900px;margin:0 auto 1.5rem;padding:0 1.2rem;text-align:center;font-size:.72rem;color:var(--muted);line-height:1.8">本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。</p>

<footer>
  <a href="/">占いポータル トップ</a> &nbsp;/&nbsp;
  <a href="/tarot.php">タロット占い</a> &nbsp;/&nbsp;
  <a href="/calendar.php">開運カレンダー</a> &nbsp;/&nbsp;
  <a href="/mbti.php">MBTI×星座診断</a> &nbsp;/&nbsp;
  <a href="/numerology.php">数秘術診断</a> &nbsp;/&nbsp;
  九星気学診断 &nbsp;/&nbsp;
  <a href="/rpg.php">RPG占い</a> &nbsp;/&nbsp;
  <a href="/aisho.php">相性診断</a> &nbsp;/&nbsp;
  <a href="/zense">前世診断</a> &nbsp;/&nbsp;
  <a href="/privacy.php">プライバシーポリシー</a> &nbsp;/&nbsp;
  <a href="/profile.php">運営者情報</a> &nbsp;/&nbsp;
  <a href="/contact.php">お問い合わせ</a><br>
  &copy; <?= date('Y') ?> 三星統合鑑定
</footer>

<script>
function openShare(type){
  const u=encodeURIComponent(location.href);
  const t=encodeURIComponent(document.title);
  const urls={line:'https://social-plugins.line.me/lineit/share?url='+u,x:'https://twitter.com/intent/tweet?url='+u+'&text='+t,fb:'https://www.facebook.com/sharer/sharer.php?u='+u};
  window.open(urls[type],'_blank','noopener,noreferrer,width=600,height=400');
}
function copyShareUrl(){
  navigator.clipboard.writeText(location.href).then(()=>{
    const b=document.querySelector('.share-copy');const orig=b.textContent;b.textContent='✓ コピーしました！';setTimeout(()=>b.textContent=orig,2000);
  });
}
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
