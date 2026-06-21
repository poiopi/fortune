<?php declare(strict_types=1);

// ─── 星座 ─────────────────────────────────────────────
$ZODIAC = [
  ['name'=>'山羊座','sym'=>'♑','el'=>'地','en'=>'Capricorn'],
  ['name'=>'水瓶座','sym'=>'♒','el'=>'風','en'=>'Aquarius'],
  ['name'=>'魚座',  'sym'=>'♓','el'=>'水','en'=>'Pisces'],
  ['name'=>'牡羊座','sym'=>'♈','el'=>'火','en'=>'Aries'],
  ['name'=>'牡牛座','sym'=>'♉','el'=>'地','en'=>'Taurus'],
  ['name'=>'双子座','sym'=>'♊','el'=>'風','en'=>'Gemini'],
  ['name'=>'蟹座',  'sym'=>'♋','el'=>'水','en'=>'Cancer'],
  ['name'=>'獅子座','sym'=>'♌','el'=>'火','en'=>'Leo'],
  ['name'=>'乙女座','sym'=>'♍','el'=>'地','en'=>'Virgo'],
  ['name'=>'天秤座','sym'=>'♎','el'=>'風','en'=>'Libra'],
  ['name'=>'蠍座',  'sym'=>'♏','el'=>'水','en'=>'Scorpio'],
  ['name'=>'射手座','sym'=>'♐','el'=>'火','en'=>'Sagittarius'],
];

function getZodiacIdx(int $m, int $d): int {
  $cuts=[19,18,20,19,20,21,22,22,22,23,21,21];
  return ($d<=$cuts[$m-1])?($m-1):$m%12;
}

function calcLP(int $y,int $m,int $d): int {
  $n=array_sum(str_split(sprintf('%04d%02d%02d',$y,$m,$d)));
  while($n>9&&!in_array($n,[11,22,33])) $n=array_sum(str_split((string)$n));
  return $n;
}

function zodiacScore(string $e1,string $e2): int {
  if($e1===$e2) return 5;
  $best=['火'=>'風','風'=>'火','水'=>'地','地'=>'水'];
  return ($best[$e1]??'')===$e2?4:2;
}

function lpBonus(int $a,int $b): int {
  foreach([[1,5,7],[2,4,8],[3,6,9]] as $g)
    if(in_array($a,$g)&&in_array($b,$g)) return 1;
  return (in_array($a,[11,22,33])||in_array($b,[11,22,33]))?1:0;
}

// 告白の言葉
$CONFESS=[
  '山羊座'=>'「あなたの誠実さと芯の強さに、ずっと惹かれてきました。一緒に未来を歩んでいきたいです。」',
  '水瓶座'=>'「世界中探しても、あなたみたいな人はいない。あなただけが私の心をわかってくれる気がする。」',
  '魚座'  =>'「あなたのそばにいると、なぜか心が落ち着くんです。もっとそばにいさせてほしい。」',
  '牡羊座'=>'「あなたの情熱と行動力に、気づいたら心を奪われていました。私をもっと刺激してください。」',
  '牡牛座'=>'「あなたと一緒にいる時間が一番ほっとします。これからもずっと隣にいてほしい。」',
  '双子座'=>'「あなたといると毎日が楽しくて、もっと一緒にいたいって思う。正直に言うと、好きです。」',
  '蟹座'  =>'「あなたの優しさに何度も救われました。今度は私が、あなたを大切にしたいんです。」',
  '獅子座'=>'「あなたの輝きに最初から目を奪われていました。あなたの隣に立てる人になりたい。」',
  '乙女座'=>'「あなたの細やかな気遣いと誠実さに、いつの間にか本気になっていました。」',
  '天秤座'=>'「あなたといると自分の中のバランスが取れる気がします。そんな人、初めてです。」',
  '蠍座'  =>'「あなたの奥深さに、どんどん引き込まれていきました。あなたのことをもっと知りたい。」',
  '射手座'=>'「あなたといると世界が広がる気がします。一緒に冒険してみませんか？」',
];

// デートスポット候補（元素別・複数）
$DATE_POOLS=[
  '火'=>[
    ['spot'=>'富士急ハイランド','desc'=>'絶叫系アトラクションで盛り上がり、二人の距離が一気に縮まります。スリルを共有すると恋が加速！'],
    ['spot'=>'山でのハイキング＆ピクニック','desc'=>'自然の中で体を動かすことで、お互いの素の姿が見えてきます。山頂で食べるお弁当は格別。'],
    ['spot'=>'スポーツ観戦（野球・サッカー）','desc'=>'同じチームを応援することで一体感が生まれます。感情を共有できる最高の空間。'],
    ['spot'=>'バーベキュー＆アウトドア','desc'=>'火を囲んで料理を分け合う体験は、原始的な絆を育てます。'],
  ],
  '地'=>[
    ['spot'=>'老舗料亭でのディナー','desc'=>'丁寧に作られた料理と静かな空間が、落ち着いた会話を生みます。本物志向のお相手に響く選択。'],
    ['spot'=>'美術館・博物館巡り','desc'=>'アートや歴史を一緒に味わうことで、お互いの感性を知ることができます。'],
    ['spot'=>'近郊の温泉旅行','desc'=>'日常を離れた特別な空間で、自然と心がほぐれます。温泉宿の夕食も◎。'],
    ['spot'=>'植物園・庭園散策','desc'=>'季節の花を眺めながらのんびり歩く時間は、安心感と親密感を育てます。'],
  ],
  '風'=>[
    ['spot'=>'おしゃれカフェ巡り','desc'=>'話題のカフェをハシゴしながら会話が弾みます。インスタ映えスポット探しも楽しい！'],
    ['spot'=>'映画鑑賞＋感想戦','desc'=>'同じ映画を見て語り合うことで、お互いの価値観が見えてきます。ミニシアター系がおすすめ。'],
    ['spot'=>'読書カフェ・本屋デート','desc'=>'互いが選んだ本を交換する「本交換デート」は知的なお相手に刺さります。'],
    ['spot'=>'新しくオープンしたスポット開拓','desc'=>'「一緒に初めて行く場所」の記憶は特別なもの。最新のグルメスポットを開拓しましょう。'],
  ],
  '水'=>[
    ['spot'=>'水族館デート','desc'=>'幻想的な水の世界でロマンチックな時間を。暗い空間が自然と距離を縮めます。'],
    ['spot'=>'ホテルのアフタヌーンティー','desc'=>'非日常の贅沢な空間で、特別な会話の時間を作りましょう。夕食につなげても◎。'],
    ['spot'=>'夜景スポット＆ドライブ','desc'=>'夜景を見ながら語らう時間は、感受性豊かなお相手の心に深く刻まれます。'],
    ['spot'=>'川沿い・海辺の散歩＋カフェ','desc'=>'水辺の開放的な雰囲気が、自然と本音の会話を引き出します。'],
  ],
];

// プレゼント候補（数字別・複数）
$PRESENT_POOLS=[
  1 =>[['item'=>'上質な本革財布','why'=>'一点モノへのこだわりがある1の人には、長く使える本物志向のアイテムを。'],
       ['item'=>'ビジネス手帳＋万年筆セット','why'=>'目標に向かって進む1の人には、夢を書き記す道具が最高のギフトに。']],
  2 =>[['item'=>'ペアネックレス','why'=>'絆を大切にする2の人には、いつも身につけられるペアアクセサリーが◎。'],
       ['item'=>'フォトブック作成サービス','why'=>'思い出を大切にする2の人には、二人の記録を形にするギフトが響きます。']],
  3 =>[['item'=>'季節の花束＋香水','why'=>'美的センスの高い3の人には、感覚に訴える贈り物が喜ばれます。'],
       ['item'=>'アートポスター＋フレームセット','why'=>'創造性あふれる3の人の部屋に飾れるアートは特別な存在に。']],
  4 =>[['item'=>'高品質キッチンツール（ル・クルーゼなど）','why'=>'実直な4の人には、毎日使える一生モノの道具が心に残ります。'],
       ['item'=>'上質なブランドバッグ・財布','why'=>'堅実な4の人が本当に欲しいのは、長く使える確かなもの。']],
  5 =>[['item'=>'旅行用トラベルセット＋スーツケース','why'=>'自由を愛する5の人には、次の冒険をイメージさせるアイテムを。'],
       ['item'=>'体験型ギフト券（料理教室・温泉など）','why'=>'モノより体験を重視する5の人に最適なギフト。']],
  6 =>[['item'=>'ルームフレグランス＋キャンドルセット','why'=>'家と人を大切にする6の人には、空間を豊かにするギフトが刺さります。'],
       ['item'=>'観葉植物＋おしゃれな鉢','why'=>'愛情深い6の人には、育てる楽しさのある贈り物を。']],
  7 =>[['item'=>'知的系ボードゲーム・パズル','why'=>'探究心旺盛な7の人には、一緒に楽しめる知的な体験を。'],
       ['item'=>'プラネタリウムペアチケット＋図鑑','why'=>'宇宙や自然の神秘に惹かれる7の人に最高の組み合わせ。']],
  8 =>[['item'=>'ブランド腕時計','why'=>'成功志向の8の人には、ステータスを感じる一生モノを。'],
       ['item'=>'高級レストランのペアディナー','why'=>'上質な体験を好む8の人には、記憶に残る食体験を贈りましょう。']],
  9 =>[['item'=>'世界各国のフェアトレードチョコ詰め合わせ','why'=>'慈悲深い9の人には、世界とのつながりを感じるエシカルなギフトを。'],
       ['item'=>'寄付付きオルゴール・アクセサリー','why'=>'誰かの役に立つことに喜びを感じる9の人への最高の贈り物。']],
  11=>[['item'=>'パワーストーンブレスレット','why'=>'霊感豊かな11の人には、エネルギーを感じるクリスタルが響きます。'],
       ['item'=>'アロマオイルセット＋ディフューザー','why'=>'感受性の強い11の人には、感覚を豊かにするアロマが最適。']],
  22=>[['item'=>'高品質な革製システム手帳','why'=>'夢を現実にするマスタービルダー22の人には、計画を形にする道具を。'],
       ['item'=>'プロ仕様ツールセット（カメラ・楽器など）','why'=>'大きな夢を持つ22の人には、その夢を支える一流の道具を。']],
  33=>[['item'=>'高級アロマディフューザー＋精油セット','why'=>'癒しの達人33の人には、心身を整えるスパグッズが喜ばれます。'],
       ['item'=>'ハーブティーギフトセット＋マグカップ','why'=>'人を癒す33の人に、自分自身を癒す時間をプレゼント。']],
];

// ─── 結果計算 ─────────────────────────────────────────
$result=null; $errors=[];
$yourBirth   =trim($_GET['your_birth']    ??'');
$partnerBirth=trim($_GET['partner_birth'] ??'');
$partnerName =htmlspecialchars(trim($_GET['partner_name']??''),ENT_QUOTES,'UTF-8');

if($yourBirth!==''&&$partnerBirth!==''){
  try{
    $yD=new DateTimeImmutable($yourBirth);
    $pD=new DateTimeImmutable($partnerBirth);
    $ym=(int)$yD->format('n');$yd=(int)$yD->format('j');$yy=(int)$yD->format('Y');
    $pm=(int)$pD->format('n');$pd=(int)$pD->format('j');$py=(int)$pD->format('Y');
    $yZi=getZodiacIdx($ym,$yd); $pZi=getZodiacIdx($pm,$pd);
    $yZ=$ZODIAC[$yZi]; $pZ=$ZODIAC[$pZi];
    $yLP=calcLP($yy,$ym,$yd); $pLP=calcLP($py,$pm,$pd);

    $seed=abs(crc32($yourBirth.$partnerBirth));
    $base=zodiacScore($yZ['el'],$pZ['el']);
    $bonus=lpBonus($yLP,$pLP);

    $marriageScore=min(5,max(1,$base+$bonus+($seed%2)-1));
    $loverScore   =min(5,max(1,$base+(($seed>>3)%2)+$bonus-1+($yZ['el']!==$pZ['el']?1:0)));

    // デートスポット・プレゼントをシードで固定選択
    $datePool =$DATE_POOLS[$pZ['el']];
    $dateSpot =$datePool[$seed%count($datePool)];
    $presPool =$PRESENT_POOLS[$pLP]??$PRESENT_POOLS[9];
    $present  =$presPool[$seed%count($presPool)];

    $confess=$CONFESS[$pZ['name']]??$CONFESS['獅子座'];

    $result=compact('yZ','pZ','yLP','pLP','marriageScore','loverScore',
                    'confess','dateSpot','present','partnerName');
  }catch(Exception $e){$errors[]='生年月日の形式が正しくありません。';}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/aisho.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="二人の生年月日を入れるだけで相性を鑑定。結婚・恋愛の相性スコア、告白の言葉、おすすめデートスポット、プレゼントまで占います。">
<title>相性診断｜二人の運命を星と数字で占う</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#08060f;--card:#1e1738;--card2:#251d42;
  --border:rgba(160,130,220,.18);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8c96a;--violet:#9b72ef;--violet-lt:#c4a8f5;
  --rose:#e8719a;--teal:#4ecdc4;--text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;--ff-rpg:'DotGothic16',monospace;
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
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--rose);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.6rem,5vw,2.6rem);font-weight:700;line-height:1.3;background:linear-gradient(135deg,var(--rose) 0%,var(--gold-lt) 50%,var(--violet-lt) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);line-height:1.8}
.form-card{background:var(--card);border:1px solid var(--border2);border-radius:16px;padding:2rem;margin-bottom:2rem;position:relative;overflow:hidden}
.form-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--rose),var(--gold),var(--violet))}
.form-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);margin-bottom:1.5rem;text-align:center}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem}
@media(max-width:600px){.form-grid{grid-template-columns:1fr}}
.form-group{margin-bottom:1rem}
.form-label{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.12em;color:var(--muted);display:block;margin-bottom:.45rem}
.form-input{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.7rem 1rem;font-family:var(--ff-sans);font-size:1rem;color:var(--text);outline:none;transition:border-color .2s}
.form-input:focus{border-color:var(--violet)}
.person-card{background:rgba(0,0,0,.2);border:1px solid var(--border);border-radius:12px;padding:1.2rem}
.person-title{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--rose);margin-bottom:.8rem;text-align:center}
.person-title.you{color:var(--teal)}
.submit-btn{width:100%;padding:.9rem;background:linear-gradient(135deg,var(--rose),var(--violet));border:none;border-radius:10px;font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#fff;cursor:pointer;margin-top:1.2rem;letter-spacing:.1em;transition:opacity .2s}
.submit-btn:hover{opacity:.85}
.error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:8px;padding:.9rem 1.2rem;margin-bottom:1rem;font-size:.85rem;color:#e89090}

/* 有名人セクション */
.celeb-section{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:2rem;position:relative;overflow:hidden}
.celeb-section::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--rose))}
.celeb-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt);margin-bottom:.4rem}
.celeb-note{font-size:.72rem;color:var(--muted);margin-bottom:1rem;line-height:1.6}
.celeb-search{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.55rem 1rem;font-family:var(--ff-sans);font-size:.9rem;color:var(--text);outline:none;margin-bottom:.8rem;transition:border-color .2s}
.celeb-search:focus{border-color:var(--gold)}
.celeb-list{display:flex;flex-wrap:wrap;gap:.4rem;max-height:180px;overflow-y:auto;margin-bottom:1rem}
.celeb-tag{font-family:var(--ff-mono);font-size:.68rem;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.25);border-radius:20px;padding:.3rem .75rem;color:var(--gold-lt);cursor:pointer;transition:background .15s;white-space:nowrap}
.celeb-tag:hover{background:rgba(201,168,76,.25)}
.celeb-tag.user-added{border-color:rgba(78,205,196,.3);background:rgba(78,205,196,.08);color:var(--teal)}
.celeb-add{display:flex;gap:.5rem;margin-top:.5rem}
.celeb-add input{flex:1;background:rgba(78,205,196,.06);border:1px solid rgba(78,205,196,.2);border-radius:8px;padding:.5rem .8rem;font-family:var(--ff-sans);font-size:.85rem;color:var(--text);outline:none}
.celeb-add input:focus{border-color:var(--teal)}
.celeb-add-btn{background:rgba(78,205,196,.15);border:1px solid rgba(78,205,196,.3);border-radius:8px;padding:.5rem 1rem;font-family:var(--ff-mono);font-size:.72rem;color:var(--teal);cursor:pointer;white-space:nowrap;transition:background .15s}
.celeb-add-btn:hover{background:rgba(78,205,196,.3)}
.celeb-del-btn{font-size:.6rem;color:var(--muted);margin-left:.3rem;cursor:pointer;vertical-align:middle}

/* 誕生日カレンダー */
.cal-section{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:2rem;position:relative;overflow:hidden}
.cal-section::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--violet),var(--rose))}
.cal-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--violet-lt);margin-bottom:.4rem}
.cal-note{font-size:.72rem;color:var(--muted);margin-bottom:1rem;line-height:1.6}
.cal-days{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:1rem}
.cal-day-btn{font-family:var(--ff-mono);font-size:.7rem;padding:.3rem .6rem;border-radius:6px;border:1px solid var(--border);background:rgba(155,114,239,.06);color:var(--muted);cursor:pointer;transition:all .15s}
.cal-day-btn:hover{background:rgba(155,114,239,.2);color:var(--violet-lt);border-color:var(--violet)}
.cal-day-btn.active{background:rgba(155,114,239,.3);color:var(--violet-lt);border-color:var(--violet)}
.cal-names{display:flex;flex-wrap:wrap;gap:.4rem;min-height:2rem}
.cal-name-tag{font-family:var(--ff-mono);font-size:.68rem;background:rgba(155,114,239,.1);border:1px solid rgba(155,114,239,.3);border-radius:20px;padding:.3rem .75rem;color:var(--violet-lt);cursor:pointer;transition:background .15s;white-space:nowrap}
.cal-name-tag:hover{background:rgba(155,114,239,.3)}
.cal-empty{font-family:var(--ff-mono);font-size:.68rem;color:var(--muted)}

/* 結果 */
.result-wrap{animation:fadeIn .8s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.result-header{text-align:center;padding:2rem 0 1.5rem;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
.pair-display{display:flex;align-items:center;justify-content:center;gap:1rem;margin-bottom:1rem;flex-wrap:wrap}
.pair-sign{text-align:center}
.pair-sym{font-size:2.2rem;line-height:1}
.pair-name{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-top:.2rem}
.pair-heart{font-size:1.8rem}
.overall-score{font-family:var(--ff-serif);font-size:3.5rem;font-weight:700;background:linear-gradient(135deg,var(--rose),var(--gold-lt));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1}
.overall-label{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em;margin-top:.3rem}
.result-block{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:1.5rem;margin-bottom:1.2rem;position:relative;overflow:hidden}
.result-block::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
.rb-marriage::before{background:linear-gradient(90deg,var(--gold),var(--gold-lt))}
.rb-lover::before{background:linear-gradient(90deg,var(--rose),var(--violet))}
.rb-confess::before{background:linear-gradient(90deg,var(--violet),var(--teal))}
.rb-date::before{background:linear-gradient(90deg,var(--teal),var(--gold))}
.rb-present::before{background:linear-gradient(90deg,var(--rose),var(--gold))}
.rb-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.18em;color:var(--muted);margin-bottom:.6rem}
.rb-title{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--gold-lt);margin-bottom:.8rem}
.stars-row{display:flex;gap:.3rem;margin-bottom:.5rem}
.star{font-size:1.4rem;color:rgba(255,255,255,.12)}
.star.on{color:var(--gold)}
.rb-score-txt{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted)}
.rb-text{font-size:.9rem;line-height:1.9;color:var(--text)}
.rb-text strong{color:var(--gold-lt)}
.confess-quote{font-family:var(--ff-serif);font-size:1.05rem;font-style:italic;color:var(--violet-lt);line-height:1.9;padding:1rem 1.2rem;background:rgba(155,114,239,.08);border-left:3px solid var(--violet);border-radius:0 8px 8px 0;margin-bottom:.6rem}
.affiliate-box{display:flex;align-items:center;justify-content:space-between;gap:1rem;background:rgba(201,168,76,.06);border:1px dashed rgba(201,168,76,.3);border-radius:10px;padding:1rem 1.2rem;margin-top:.8rem;flex-wrap:wrap}
.affiliate-item{flex:1;min-width:0}
.affiliate-name{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt);margin-bottom:.3rem}
.affiliate-why{font-size:.8rem;color:var(--muted);line-height:1.7}
.affiliate-btn{display:inline-block;padding:.5rem 1.2rem;background:linear-gradient(135deg,var(--gold),rgba(201,168,76,.7));border-radius:20px;font-family:var(--ff-mono);font-size:.7rem;color:#1a1000;font-weight:600;text-decoration:none;white-space:nowrap;cursor:pointer;border:none;transition:opacity .2s;flex-shrink:0}
.affiliate-btn:hover{opacity:.85}
.retry-btn{width:100%;background:none;border:1px solid var(--border2);border-radius:8px;padding:.65rem;font-family:var(--ff-mono);font-size:.75rem;color:var(--muted);cursor:pointer;margin-top:.5rem;transition:color .2s,border-color .2s;text-decoration:none;display:block;text-align:center}
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
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
  .sp-dropdown.open{display:block}
  .sp-dropdown a,.sp-dropdown span{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
  .sp-dropdown span{color:var(--text)}
  .sp-dropdown a:last-child,.sp-dropdown span:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
}
</style>
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
      <a href="/kyusei.php">九星気学</a>
      <a href="/rpg.php">RPG占い</a>
      相性診断
    </nav>
    <div id="google_translate_element"></div>
    <button class="sp-menu-btn" onclick="toggleSpMenu()">☰ メニュー</button>
    <div class="sp-dropdown" id="spDropdown">
      <a href="/">トップ</a>
      <a href="/tarot.php">タロット</a>
      <a href="/calendar.php">開運カレンダー</a>
      <a href="/mbti.php">MBTI×星座診断</a>
      <a href="/numerology.php">数秘術診断</a>
      <a href="/kyusei.php">九星気学</a>
      <a href="/rpg.php">RPG占い</a>
      <span>相性診断</span>
    </div>
  </div>
</header>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">Compatibility Fortune</span>
    <h1>二人の相性診断</h1>
    <p class="hero-sub">生年月日を入力するだけで、星座と数秘術から<br>二人の恋愛・結婚相性を鑑定します。</p>
  </section>

  <div class="adsense-space"></div>

  <!-- 有名人セクション -->
  <div class="celeb-section">
    <div class="celeb-title">💫 有名人の誕生日から選ぶ</div>
    <p class="celeb-note">※誕生日データは一般公開情報を元にしています。正確性は保証されません。参考としてお楽しみください。<br>自分で追加したデータはこのブラウザに保存されます。</p>
    <input type="text" class="celeb-search" placeholder="名前で検索..." id="celebSearch" oninput="filterCelebs()">
    <div class="celeb-list" id="celebList"></div>
    <div style="font-family:var(--ff-mono);font-size:.62rem;color:var(--teal);margin-bottom:.4rem">+ 有名人を追加する</div>
    <div class="celeb-add">
      <input type="text" id="celebNameInput" placeholder="名前（例：山田花子）">
      <input type="date" id="celebBirthInput" style="width:150px;flex:none">
      <button class="celeb-add-btn" onclick="addCeleb()">追加</button>
    </div>
  </div>

  <!-- 誕生日カレンダー -->
  <div class="cal-section">
    <div class="cal-title">📅 誕生日カレンダーから選ぶ（1月）</div>
    <p class="cal-note">※日付ボタンをタップすると、その日が誕生日の有名人・キャラクターが表示されます。名前をタップするとお相手欄に自動入力されます。<br>誕生日データは参考情報です。正確性は保証されません。年は参考値として1990年を使用しています。</p>
    <div class="cal-days" id="calDays"></div>
    <div class="cal-names" id="calNames"><span class="cal-empty">日付を選んでください</span></div>
  </div>

  <!-- フォーム -->
  <div class="form-card">
    <div class="form-title">✦ 生年月日を入力 ✦</div>
    <?php if(!empty($errors)):?>
    <div class="error-box"><?=implode('<br>',$errors)?></div>
    <?php endif;?>
    <form method="get" action="">
      <div class="form-grid">
        <div class="person-card">
          <div class="person-title you">💙 あなた</div>
          <div class="form-group">
            <label class="form-label">お名前（任意）</label>
            <input class="form-input" type="text" name="your_name" id="your_name"
              value="<?=htmlspecialchars(trim($_GET['your_name']??''),ENT_QUOTES)?>" placeholder="例：山田さん">
          </div>
          <div class="form-group">
            <label class="form-label">生年月日</label>
            <input class="form-input" type="date" name="your_birth" id="your_birth"
              value="<?=htmlspecialchars($yourBirth,ENT_QUOTES)?>" max="<?=date('Y-m-d')?>" required>
          </div>
        </div>
        <div class="person-card">
          <div class="person-title">💗 お相手</div>
          <div class="form-group">
            <label class="form-label">お名前（任意）</label>
            <input class="form-input" type="text" name="partner_name" id="partner_name"
              value="<?=htmlspecialchars($partnerName,ENT_QUOTES)?>" placeholder="例：田中さん">
          </div>
          <div class="form-group">
            <label class="form-label">生年月日</label>
            <input class="form-input" type="date" name="partner_birth" id="partner_birth"
              value="<?=htmlspecialchars($partnerBirth,ENT_QUOTES)?>" max="<?=date('Y-m-d')?>" required>
          </div>
        </div>
      </div>
      <button type="submit" class="submit-btn">💘 相性を鑑定する</button>
    </form>
  </div>

  <!-- 結果 -->
  <?php if($result):
    $r=$result;
    $pLabel=$r['partnerName']!==''?$r['partnerName'].'さん':'お相手';
    $marriageScores=[1=>'縁遠い',2=>'普通',3=>'相性まずまず',4=>'相性良好',5=>'運命的な相手'];
    $loverScores  =[1=>'ドキドキ少なめ',2=>'穏やかな関係',3=>'楽しい恋人',4=>'情熱的な恋',5=>'運命の恋人'];
  ?>
  <div class="result-wrap">
    <div class="result-header">
      <div class="pair-display">
        <div class="pair-sign">
          <div class="pair-sym"><?=$r['yZ']['sym']?></div>
          <div class="pair-name"><?=$r['yZ']['name']?></div>
        </div>
        <div class="pair-heart">💕</div>
        <div class="pair-sign">
          <div class="pair-sym"><?=$r['pZ']['sym']?></div>
          <div class="pair-name"><?=$pLabel?> <?=$r['pZ']['name']?></div>
        </div>
      </div>
      <div class="overall-score"><?=round(($r['marriageScore']+$r['loverScore'])/10*100)?>%</div>
      <div class="overall-label">TOTAL COMPATIBILITY</div>
    </div>

    <!-- 結婚 -->
    <div class="result-block rb-marriage">
      <div class="rb-label">MARRIAGE SCORE</div>
      <div class="rb-title">💍 結婚に向いている度</div>
      <div class="stars-row">
        <?php for($i=1;$i<=5;$i++):?>
        <span class="star<?=$i<=$r['marriageScore']?' on':''?>">★</span>
        <?php endfor;?>
      </div>
      <div class="rb-score-txt"><?=$marriageScores[$r['marriageScore']]?></div>
      <p class="rb-text" style="margin-top:.7rem">
        <?=$r['yZ']['name']?>と<?=$r['pZ']['name']?>の組み合わせは、
        <?php if($r['yZ']['el']===$r['pZ']['el']):?>
        同じ<strong><?=$r['yZ']['el']?></strong>のエレメント同士。価値観が近く、長期的な安定が期待できる相性です。
        <?php elseif(in_array([$r['yZ']['el'],$r['pZ']['el']],[['火','風'],['風','火'],['水','地'],['地','水']])):?>
        <strong><?=$r['yZ']['el']?></strong>と<strong><?=$r['pZ']['el']?></strong>の補い合う相性。お互いの弱点を支え合える理想的な関係です。
        <?php else:?>
        異なるエレメント同士ですが、だからこそ相手から学べることが多い刺激的な関係になります。
        <?php endif;?>
        数秘術では<?=$r['yLP']?>と<?=$r['pLP']?>の組み合わせで、
        <?php if(lpBonus($r['yLP'],$r['pLP'])>0):?>互いを高め合える相性です。<?php else:?>異なる力で補い合える相性です。<?php endif;?>
      </p>
    </div>

    <!-- 恋人 -->
    <div class="result-block rb-lover">
      <div class="rb-label">LOVER SCORE</div>
      <div class="rb-title">💓 恋人に向いている度</div>
      <div class="stars-row">
        <?php for($i=1;$i<=5;$i++):?>
        <span class="star<?=$i<=$r['loverScore']?' on':''?>">★</span>
        <?php endfor;?>
      </div>
      <div class="rb-score-txt"><?=$loverScores[$r['loverScore']]?></div>
      <p class="rb-text" style="margin-top:.7rem">
        恋愛においては、<?=$r['pZ']['name']?>の
        <?php
          $charms=['山羊座'=>'堅実さと深い愛情','水瓶座'=>'独自の世界観と知的な会話',
                   '魚座'=>'包み込むような優しさ','牡羊座'=>'情熱とストレートな表現',
                   '牡牛座'=>'揺るぎない安心感と誠実さ','双子座'=>'軽やかなユーモアと好奇心',
                   '蟹座'=>'深い愛情と細やかな気遣い','獅子座'=>'華やかな存在感とリード力',
                   '乙女座'=>'誠実さと丁寧な愛し方','天秤座'=>'優雅な雰囲気とバランス感覚',
                   '蠍座'=>'情熱的な一途さと深み','射手座'=>'自由な発想と前向きなエネルギー'];
          echo $charms[$r['pZ']['name']]??'魅力';
        ?>があなたを惹きつけるポイントになりそうです。
      </p>
    </div>

    <!-- 告白の言葉 -->
    <div class="result-block rb-confess">
      <div class="rb-label">CONFESSION WORDS</div>
      <div class="rb-title">💌 <?=$pLabel?>への告白の言葉</div>
      <div class="confess-quote"><?=$r['confess']?></div>
      <p class="rb-text"><?=$r['pZ']['name']?>には<strong>素直でまっすぐな言葉</strong>が一番響きます。飾りすぎず、あなたの本音を伝えましょう。</p>
    </div>

    <!-- デートスポット -->
    <div class="result-block rb-date">
      <div class="rb-label">DATE SPOT</div>
      <div class="rb-title">🗺️ おすすめデートスポット</div>
      <div class="affiliate-box">
        <div class="affiliate-item">
          <div class="affiliate-name">📍 <?=$r['dateSpot']['spot']?></div>
          <div class="affiliate-why"><?=$r['dateSpot']['desc']?></div>
        </div>
        <!-- アフィリエイトURL設定後にこの行を有効化: <a class="affiliate-btn" href="【URL】">詳しく見る →</a> -->
      </div>
    </div>

    <!-- プレゼント -->
    <div class="result-block rb-present">
      <div class="rb-label">LUCKY PRESENT</div>
      <div class="rb-title">🎁 運気が上がるプレゼント</div>
      <div class="affiliate-box">
        <div class="affiliate-item">
          <div class="affiliate-name">✨ <?=$r['present']['item']?></div>
          <div class="affiliate-why"><?=$r['present']['why']?></div>
        </div>
        <!-- アフィリエイトURL設定後にこの行を有効化: <a class="affiliate-btn" href="【URL】">商品を探す →</a> -->
      </div>
    </div>

    <!-- シェア -->
    <div class="share-wrap">
      <p class="share-label">✦ 結果をシェアする</p>
      <div class="share-btns">
        <button class="share-btn share-line" onclick="openShare('line')">LINE</button>
        <button class="share-btn share-x" onclick="openShare('x')">𝕏</button>
        <button class="share-btn share-fb" onclick="openShare('fb')">Facebook</button>
        <button class="share-btn share-copy" onclick="copyShareUrl()">🔗 リンクをコピー</button>
      </div>
    </div>

    <a href="/aisho.php" class="retry-btn">▶ もう一度診断する</a>
  </div>
  <?php endif;?>

  <div class="adsense-space"></div>
</div>

<p style="max-width:900px;margin:0 auto 1.5rem;padding:0 1.2rem;text-align:center;font-size:.72rem;color:var(--muted);line-height:1.8">本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。</p>

<footer>
  <a href="/">占いポータル トップ</a> &nbsp;/&nbsp;
  <a href="/tarot.php">タロット占い</a> &nbsp;/&nbsp;
  <a href="/calendar.php">開運カレンダー</a> &nbsp;/&nbsp;
  <a href="/mbti.php">MBTI×星座診断</a> &nbsp;/&nbsp;
  <a href="/numerology.php">数秘術診断</a> &nbsp;/&nbsp;
  <a href="/kyusei.php">九星気学</a> &nbsp;/&nbsp;
  <a href="/rpg.php">RPG占い</a> &nbsp;/&nbsp;
  相性診断 &nbsp;/&nbsp;
  <a href="/privacy.php">プライバシーポリシー</a> &nbsp;/&nbsp;
  <a href="/profile.php">運営者情報</a> &nbsp;/&nbsp;
  <a href="/contact.php">お問い合わせ</a><br>
  &copy; <?=date('Y')?> 三星統合鑑定
</footer>

<script>
// ─── 誕生日カレンダーデータ（1月）──────────────────
const BIRTHDAY_DB = {
  '01-01':['尾田栄一郎','堂本光一','箕輪はるか','ポール・リビア','J・D・サリンジャー','ベッツィ・ロス','雪村千鶴','木之本桜','四葉環','爆豪勝己'],
  '01-02':['アイザック・アシモフ','キューバ・グッディング・ジュニア','浦沢直樹','竹野内豊','豊口めぐみ','水樹奈々','カルナ','鏡音リン','猿飛アスマ','神宮寺レン'],
  '01-03':['メル・ギブソン','マイケル・シューマッハ','ダンテ・アリギエーリ','岩下志麻','柳葉敏郎','小沢真珠','ロロノア・ゾロ','日向ネジ','七海建人','我妻善逸'],
  '01-04':['アイザック・ニュートン','ティルダ・スウィントン','マイケル・スタイプ','竹内力','衛藤美彩','子安武人','緑谷出久','竈門炭治郎','沖田総悟','朽木ルキア'],
  '01-05':['宮崎駿','ロバート・デュヴァル','ダイアン・キートン','深水元基','小池徹平','元ちとせ','モンキー・D・ルフィ','黒崎一護','爆豪勝己','シエル・ファントムハイヴ'],
  '01-06':['エディ・レッドメイン','ローワン・アトキンソン','大場つぐみ','CHAGE','中畑清','ノーマン・リーダス','不死川玄弥','神楽','渚カヲル','トラファルガー・ロー'],
  '01-07':['ニコラス・ケイジ','ルイス・ハミルトン','ケニー・ロギンス','水木一郎','青木琴美','森政弘','うずまきナルト','五条悟','エレン・イェーガー','キリト'],
  '01-08':['エルヴィス・プレスリー','デヴィッド・ボウイ','スティーヴン・ホーキング','小泉純一郎','田中裕二','井上麻里奈','綾波レイ','煉獄杏寿郎','アスナ','伏黒恵'],
  '01-09':['リチャード・ニクソン','ジミー・ペイジ','デイヴ・マシューズ','岸部一徳','伴都美子','岡本真夜','冨岡義勇','日番谷冬獅郎','神威','我愛羅'],
  '01-10':['ロッド・スチュワート','ジョージ・フォアマン','パット・ベネター','財前直見','田中裕二','三浦建太郎','嘴平伊之助','サンジ','キルア＝ゾルディック','碇シンジ'],
  '01-11':['デヴィッド・ボウイ','深津絵里','持田香織','メアリー・J・ブライジ','アマンダ・ピート','ジェイミー・ヴァーディ','カカシ','中野三玖','エミリア','轟焦凍'],
  '01-12':['村上春樹','ジェフ・ベック','オリバー・プラット','楠田枝里子','井上雄彦','ロビー・ベンソン','ベジータ','ミカサ・アッカーマン','朽木白哉','我妻由乃'],
  '01-13':['オーランド・ブルーム','リーアム・ヘムズワース','秋本治','中山優馬','柴田純','パトリック・デンプシー','孫悟空','エドワード・エルリック','江戸川コナン','めぐみん'],
  '01-14':['三島由紀夫','デイヴ・グロール','LL・クール・J','玉木宏','山崎弘也','田中真弓','綾小路清隆','夜神月','時透無一郎','セイバー'],
  '01-15':['マーティン・ルーサー・キング・ジュニア','ピットブル','樹木希林','吉岡里帆','石原良純','アリストテレス・オナシス','リヴァイ','竈門禰豆子','坂田銀時','惣流・アスカ・ラングレー'],
  '01-16':['ケイト・モス','ジョン・カーペンター','リン＝マニュエル・ミランダ','藪宏太','木下隆行','桂文枝','ロロノア・ゾロ','日向翔陽','レム','伊黒小芭内'],
  '01-17':['モハメド・アリ','ジム・キャリー','ミシェル・オバマ','山口百恵','平井堅','坂本龍一','我愛羅','嘴平伊之助','影山飛雄','ゼロツー'],
  '01-18':['ケビン・コスナー','オリバー・ハーディ','キャリー・グラント','ビートたけし','中山忍','長谷部誠','黒崎一護','エレン・イェーガー','宇髄天元','キルア＝ゾルディック'],
  '01-19':['エドガー・アラン・ポー','ジャニス・ジョプリン','ドリー・パートン','松任谷由実','宇多田ヒカル','柴門ふみ','冨岡義勇','ベジータ','アルフォンス・エルリック','赤司征十郎'],
  '01-20':['フェデリコ・フェリーニ','デヴィッド・リンチ','レイン・ウィルソン','南果歩','IKKO','矢口真里','竈門炭治郎','五条悟','モンキー・D・ルフィ','ミカサ・アッカーマン'],
  '01-21':['プラシド・ドミンゴ','ジーナ・デイヴィス','ロビー・ベンソン','京本政樹','水樹奈々','稲盛和夫','胡蝶しのぶ','サスケ','及川徹','アルミン・アルレルト'],
  '01-22':['ダイアン・レイン','リンダ・ブレア','フランシス・ベーコン','中田英寿','高橋惠子','HEATH','我妻善逸','エース','爆豪勝己','エドワード・エルリック'],
  '01-23':['ジャンゴ・ラインハルト','ジョン・ハンコック','千葉真一','葉加瀬太郎','トリンドル玲奈','吉田鋼太郎','日向翔陽','煉獄杏寿郎','キリト','江戸川コナン'],
  '01-24':['ニール・ダイアモンド','ナスターシャ・キンスキー','エド・ヘルムズ','五輪真弓','岩井俊二','前田日明','禪院真希','竈門禰豆子','ロロノア・ゾロ','エレン・イェーガー'],
  '01-25':['ヴァージニア・ウルフ','アリシア・キーズ','毛利元就','北野誠','さとう宗幸','石ノ森章太郎','伏黒恵','リヴァイ','トラファルガー・ロー','うちはイタチ'],
  '01-26':['ポール・ニューマン','エレン・デジェネレス','エディ・ヴァン・ヘイレン','長嶋一茂','hitomi','綾小路翔','中野一花','胡蝶カナエ','ヒソカ','アスナ'],
  '01-27':['モーツァルト','ルイス・キャロル','ブリジット・フォンダ','雛形あきこ','清水ミチコ','三田寛子','中野二乃','我妻善逸','エース','爆豪勝己'],
  '01-28':['ジャクソン・ポロック','イライジャ・ウッド','アラン・アルダ','乙葉','新庄剛志','星野源','中野三玖','時透無一郎','キルア＝ゾルディック','五条悟'],
  '01-29':['アントン・チェーホフ','オプラ・ウィンフリー','トム・セレック','濱口優','宝生舞','きゃりーぱみゅぱみゅ','中野四葉','伊之助','サンジ','夜神月'],
  '01-30':['フランクリン・ルーズベルト','ジーン・ハックマン','フィル・コリンズ','石川さゆり','吉村由美','春風亭昇太','中野五月','禪院真希','冨岡義勇','リヴァイ'],
  '01-31':['フランツ・シューベルト','ジャスティン・ティンバーレイク','ケリー・リンチ','真矢みき','香取慎吾','石野真子','中野五月','伏黒恵','ロロノア・ゾロ','ミカサ・アッカーマン'],
};

(function(){
  const daysEl = document.getElementById('calDays');
  const namesEl = document.getElementById('calNames');
  let activeDay = null;
  for (let d = 1; d <= 31; d++) {
    const key = '01-' + String(d).padStart(2,'0');
    if (!BIRTHDAY_DB[key]) continue;
    const btn = document.createElement('button');
    btn.className = 'cal-day-btn';
    btn.textContent = d + '日';
    btn.onclick = () => {
      if (activeDay) activeDay.classList.remove('active');
      btn.classList.add('active');
      activeDay = btn;
      namesEl.innerHTML = BIRTHDAY_DB[key].map(n =>
        `<span class="cal-name-tag" onclick="selectFromCal('${n.replace(/'/g,"\\'")}','1990-${key}')">${n}</span>`
      ).join('');
    };
    daysEl.appendChild(btn);
  }
})();

function selectFromCal(name, birth) {
  document.getElementById('partner_birth').value = birth;
  document.getElementById('partner_name').value = name;
  document.getElementById('partner_birth').closest('form').scrollIntoView({behavior:'smooth', block:'center'});
}

// ─── 有名人データ ──────────────────────────────────
const PRESET_CELEBS = [
  {name:'大谷翔平',      birth:'1994-07-05'},
  {name:'石原さとみ',    birth:'1986-12-24'},
  {name:'新垣結衣',      birth:'1988-06-11'},
  {name:'菅田将暉',      birth:'1993-02-21'},
  {name:'橋本環奈',      birth:'1999-02-03'},
  {name:'山崎賢人',      birth:'1994-09-07'},
  {name:'有村架純',      birth:'1993-02-13'},
  {name:'吉沢亮',        birth:'1994-01-31'},
  {name:'広瀬すず',      birth:'1998-06-19'},
  {name:'坂口健太郎',    birth:'1991-06-07'},
  {name:'星野源',        birth:'1981-01-28'},
  {name:'本田翼',        birth:'1992-06-27'},
  {name:'浜崎あゆみ',    birth:'1978-10-02'},
  {name:'木村拓哉',      birth:'1972-11-13'},
  {name:'二宮和也',      birth:'1983-06-17'},
  {name:'松本潤',        birth:'1983-08-30'},
  {name:'BTS RM',        birth:'1994-09-12'},
  {name:'BTS ジョングク',birth:'1997-09-01'},
  {name:'藤原竜也',      birth:'1982-05-15'},
  {name:'綾瀬はるか',    birth:'1985-03-24'},
  {name:'長澤まさみ',    birth:'1987-06-03'},
  {name:'福山雅治',      birth:'1969-02-06'},
  {name:'宮崎あおい',    birth:'1985-11-30'},
  {name:'堺雅人',        birth:'1973-10-14'},
  {name:'天海祐希',      birth:'1967-08-08'},
];

const LS_KEY = 'lf_celebs_v1';

function getUserCelebs() {
  try { return JSON.parse(localStorage.getItem(LS_KEY)||'[]'); } catch(e){ return []; }
}
function saveUserCelebs(arr) {
  localStorage.setItem(LS_KEY, JSON.stringify(arr));
}

function allCelebs() {
  return [...PRESET_CELEBS, ...getUserCelebs()];
}

function renderCelebs(filter='') {
  const list = document.getElementById('celebList');
  const userCelebs = getUserCelebs();
  const userNames = new Set(userCelebs.map(c=>c.name));
  const all = allCelebs();
  const filtered = filter ? all.filter(c=>c.name.includes(filter)) : all;

  list.innerHTML = '';
  filtered.forEach(c => {
    const isUser = userNames.has(c.name);
    const span = document.createElement('span');
    span.className = 'celeb-tag' + (isUser ? ' user-added' : '');
    span.textContent = c.name;
    span.onclick = () => selectCeleb(c.birth, c.name);
    if (isUser) {
      const del = document.createElement('span');
      del.className = 'celeb-del-btn';
      del.textContent = '✕';
      del.onclick = (e) => { e.stopPropagation(); deleteCeleb(c.name); };
      span.appendChild(del);
    }
    list.appendChild(span);
  });
}

function filterCelebs() {
  renderCelebs(document.getElementById('celebSearch').value.trim());
}

function selectCeleb(birth, name) {
  document.getElementById('partner_birth').value = birth;
  document.getElementById('partner_name').value = name;
  document.getElementById('partner_birth').closest('form').scrollIntoView({behavior:'smooth', block:'center'});
}

function addCeleb() {
  const name = document.getElementById('celebNameInput').value.trim();
  const birth = document.getElementById('celebBirthInput').value;
  if (!name || !birth) { alert('名前と生年月日を入力してください'); return; }
  const arr = getUserCelebs();
  if (arr.find(c=>c.name===name)) { alert('すでに登録されています'); return; }
  arr.push({name, birth});
  saveUserCelebs(arr);
  document.getElementById('celebNameInput').value = '';
  document.getElementById('celebBirthInput').value = '';
  renderCelebs(document.getElementById('celebSearch').value.trim());
}

function deleteCeleb(name) {
  const arr = getUserCelebs().filter(c=>c.name!==name);
  saveUserCelebs(arr);
  renderCelebs(document.getElementById('celebSearch').value.trim());
}

renderCelebs();

// ─── シェア ──────────────────────────────────────────
<?php if($result):
  $pn = $result['partnerName']!=='' ? $result['partnerName'] : 'お相手';
  $shareText = "相性診断結果：{$result['yZ']['name']}×{$result['pZ']['name']} 相性".round(($result['marriageScore']+$result['loverScore'])/10*100)."% ✨";
?>
window._shareText = <?=json_encode($shareText)?>;
<?php endif;?>

function openShare(type){
  const url=location.href;
  const u=encodeURIComponent(url);
  const txt=(window._shareText||document.title);
  const urls={
    line:'https://line.me/R/msg/text/?'+encodeURIComponent(txt+'\n'+url),
    x:'https://twitter.com/intent/tweet?text='+encodeURIComponent(txt+' ')+u,
    fb:'https://www.facebook.com/sharer/sharer.php?u='+u,
  };
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
function toggleSpMenu(){document.getElementById('spDropdown').classList.toggle('open');}
document.addEventListener('click',e=>{
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown'))
    document.getElementById('spDropdown').classList.remove('open');
});
</script>
</body>
</html>
