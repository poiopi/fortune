<?php
declare(strict_types=1);
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
<link rel="canonical" href="https://life-fun.net/seiza" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="生年月日と生まれた時間帯から、太陽星座・エレメント・内面タイプを無料で鑑定。恋愛スタイル・仕事適性まで西洋占星術で深掘りします。">
<title>西洋占星術｜太陽星座・エレメント・内面タイプを無料で鑑定</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}

:root{
  --bg:#08060f;--surface:#100c1e;--surface2:#16112b;
  --border:rgba(155,114,239,.18);--border2:rgba(155,114,239,.3);
  --text:#e8e0f8;--muted:#8a7db5;--violet:#9b72ef;--gold:#c9a84c;--gold2:#e8d48a;
  --seiza:#c2185b;--seiza2:#f06292;--seiza-bg:rgba(194,24,91,.12);--seiza-border:rgba(194,24,91,.38);
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
  --elem-fire:#ef5350;--elem-earth:#8d6e63;--elem-air:#42a5f5;--elem-water:#7e57c2;
}
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--bg);color:var(--text);font-family:var(--ff-serif);line-height:1.7;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(194,24,91,.10) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(155,114,239,.12) 0%,transparent 55%);pointer-events:none;z-index:0}
a{color:var(--seiza2);text-decoration:none}

.wrap{position:relative;z-index:1;max-width:860px;margin:0 auto;padding:2rem 1.2rem 4rem}

/* ── HEADER：inc/header.php側で一元管理（COMPONENTS.md参照） ── */

/* ── Page Title ── */
.page-title{text-align:center;padding:2.5rem 0 2rem}
.subtitle{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.22em;color:var(--seiza2);text-transform:uppercase;margin-bottom:.6rem}
h1{font-size:clamp(1.2rem,3.5vw,1.7rem);letter-spacing:.08em;font-weight:700;line-height:1.4}

/* ── Form card ── */
.form-card{background:var(--surface);border:1px solid var(--border2);border-radius:16px;padding:2rem;max-width:520px;margin:0 auto 2rem;position:relative;overflow:hidden}
.form-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--seiza),var(--seiza2),var(--gold))}
.form-section-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--seiza2);text-align:center;margin-bottom:1.5rem}
.form-group{margin-bottom:1.2rem}
.form-label{display:block;font-size:.75rem;color:var(--muted);margin-bottom:.4rem;letter-spacing:.06em}
.form-input{width:100%;background:rgba(8,6,15,.7);border:1px solid var(--border2);border-radius:8px;padding:.6rem .9rem;color:var(--text);font-family:var(--ff-serif);font-size:.9rem;outline:none;transition:border-color .2s;color-scheme:dark}
.form-input:focus{border-color:var(--seiza)}
.date-input-group select.form-input{-webkit-appearance:none;appearance:none}

/* ── 時間帯ラジオ ── */
.time-radio-group{display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem}
.time-radio-label{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.2rem;padding:.65rem .4rem;background:rgba(8,6,15,.6);border:1px solid var(--border);border-radius:10px;cursor:pointer;transition:border-color .2s,background .2s;text-align:center}
.time-radio-label:hover{border-color:var(--seiza-border);background:var(--seiza-bg)}
.time-radio-label input{display:none}
.time-radio-label input:checked ~ .time-radio-icon{filter:none}
.time-radio-label:has(input:checked){border-color:var(--seiza);background:var(--seiza-bg);box-shadow:0 0 12px rgba(194,24,91,.25)}
.time-radio-icon{font-size:1.2rem;line-height:1}
.time-radio-text{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);letter-spacing:.04em}
.time-radio-sub{font-family:var(--ff-mono);font-size:.5rem;color:rgba(138,125,181,.6)}

.calc-btn{width:100%;padding:.85rem;background:linear-gradient(135deg,#7b1340,#c2185b);border:1px solid rgba(194,24,91,.5);border-radius:10px;color:#ffe8f0;font-family:var(--ff-serif);font-size:1rem;letter-spacing:.1em;cursor:pointer;margin-top:.5rem;transition:opacity .2s,box-shadow .2s}
.calc-btn:hover{opacity:.9;box-shadow:0 0 20px rgba(194,24,91,.5)}

/* ── Loading ── */
#loadingOverlay{display:none;position:fixed;inset:0;background:rgba(8,6,15,.85);z-index:9999;align-items:center;justify-content:center;flex-direction:column;gap:1rem}
#loadingOverlay.show{display:flex}
.loading-text{font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.2em;color:var(--seiza2)}
.loading-ring{width:50px;height:50px;border:2px solid rgba(194,24,91,.2);border-top-color:var(--seiza);border-radius:50%;animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}

/* ── Result ── */
#resultSection{display:none}
.result-title{text-align:center;font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.22em;color:var(--seiza2);margin-bottom:1.5rem;padding-top:1rem}

/* ── Type card ── */
.type-card{background:linear-gradient(135deg,rgba(194,24,91,.15),rgba(155,114,239,.10));border:1px solid var(--seiza-border);border-radius:18px;padding:2rem 1.5rem;margin-bottom:2rem;text-align:center;position:relative;overflow:hidden}
.type-card::before{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;background:radial-gradient(circle,rgba(194,24,91,.2),transparent 70%);pointer-events:none}
.type-badge{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.2em;color:var(--seiza2);background:var(--seiza-bg);border:1px solid var(--seiza-border);border-radius:20px;padding:.25rem .8rem;display:inline-block;margin-bottom:.8rem}
.type-sign{font-size:2.2rem;margin-bottom:.3rem;line-height:1}
.type-nickname{font-family:var(--ff-serif);font-size:clamp(1.4rem,4vw,2.1rem);font-weight:700;background:linear-gradient(135deg,var(--seiza2) 0%,var(--gold2) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem;letter-spacing:.06em}
.type-label{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em}

/* ── Badge row ── */
.badge-row{display:flex;justify-content:center;gap:.5rem;flex-wrap:wrap;margin:1rem 0 .5rem}
.elem-badge{display:inline-flex;align-items:center;gap:.35rem;padding:.35rem .9rem;border-radius:20px;font-family:var(--ff-mono);font-size:.65rem;font-weight:500;border:1px solid}
.elem-fire  {background:rgba(239,83,80,.12);border-color:rgba(239,83,80,.4);color:#ef9a9a}
.elem-earth {background:rgba(141,110,99,.12);border-color:rgba(141,110,99,.4);color:#bcaaa4}
.elem-air   {background:rgba(66,165,245,.12);border-color:rgba(66,165,245,.4);color:#90caf9}
.elem-water {background:rgba(126,87,194,.12);border-color:rgba(126,87,194,.4);color:#b39ddb}
.quality-badge{display:inline-flex;align-items:center;gap:.35rem;padding:.35rem .9rem;border-radius:20px;font-family:var(--ff-mono);font-size:.65rem;font-weight:500;border:1px solid;background:rgba(201,168,76,.08);border-color:rgba(201,168,76,.3);color:#e8d48a}

/* ── Section heading ── */
.section-heading{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--seiza2);margin-bottom:1rem;padding-bottom:.4rem;border-bottom:1px solid var(--border)}

/* ── Result blocks ── */
.result-block{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.4rem;margin-bottom:1.2rem}
.result-block-title{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.18em;color:var(--seiza2);margin-bottom:.75rem;text-transform:uppercase}
.result-block-body{font-size:.88rem;color:#d0cae8;line-height:1.85}

/* ── Jobs grid ── */
.jobs-grid{display:flex;flex-wrap:wrap;gap:.5rem}
.job-tag{background:var(--seiza-bg);border:1px solid var(--seiza-border);border-radius:20px;padding:.3rem .85rem;font-size:.8rem;color:var(--seiza2)}

/* ── Share ── */
.share-wrap{text-align:center;margin:1.5rem 0}
.share-label{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.55rem}
.share-btns{display:flex;justify-content:center;gap:.45rem;flex-wrap:wrap}
.share-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.45rem .85rem;border-radius:20px;font-size:.7rem;font-family:var(--ff-mono);cursor:pointer;text-decoration:none;border:none;transition:opacity .2s;white-space:nowrap}
.share-btn:hover{opacity:.8}
.share-x{background:#000;color:#fff}
.share-line{background:#06C755;color:#fff}
.share-copy{background:var(--seiza-bg);border:1px solid var(--seiza-border)!important;color:var(--seiza2)}

/* ── Article link box ── */
.article-link-box{display:flex;align-items:center;gap:.9rem;background:var(--seiza-bg);border:1px solid var(--seiza-border);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.article-link-box:hover{border-color:var(--seiza2);background:rgba(194,24,91,.18)}
.article-link-icon{font-size:1.4rem;flex-shrink:0}
.article-link-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.article-link-body strong{font-size:.9rem;font-weight:500;color:var(--seiza2)}
.article-link-body small{font-size:.75rem;color:var(--muted)}
.article-link-arrow{color:var(--seiza2);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}

/* ── Retry ── */
.retry-wrap{text-align:center;margin:2rem 0}
.retry-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.6rem;border:1px solid var(--border2);border-radius:20px;font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);cursor:pointer;background:none;transition:color .2s,border-color .2s}
.retry-btn:hover{color:var(--text);border-color:var(--seiza)}

/* ── Disclaimer ── */
.disclaimer{max-width:760px;margin:0 auto 1.5rem;text-align:center;font-size:.7rem;color:var(--muted);line-height:1.8;font-family:var(--ff-mono)}

/* ── AdSense space ── */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem;margin-bottom:1.5rem}
.tool-desc p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.tool-desc p:last-child{margin-bottom:0}

footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
</style>
</head>
<body>

<?php $currentPage='seiza'; require __DIR__.'/inc/header.php'; ?>

<div id="loadingOverlay">
  <div class="loading-ring"></div>
  <div class="loading-text">星座を読み解いています...</div>
</div>

<div class="wrap">
  <div class="page-title">
    <div class="subtitle">Western Astrology · 西洋占星術</div>
    <h1>西洋占星術｜太陽星座・エレメント・内面タイプを無料で鑑定</h1>
    <p style="font-size:.8rem;color:var(--muted);margin-top:.5rem">
      生年月日と生まれた時間帯から、太陽星座・エレメント・内面タイプを算出。<br>恋愛スタイル・仕事適性まで個性あふれる星座鑑定をお届けします。
    </p>
  </div>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="tool-desc">
    <p>西洋占星術の12星座占いは、生まれたときに太陽がどの星座に位置していたかを基に、基本性格や行動パターンを読み解く占術です。</p>
    <p>このセルフ鑑定ツールでは、あなたの星座から本質的な強みや、恋愛・仕事での適性を算出します。自分を客観的に見つめ直し、毎日をより前向きに過ごすためのヒントとしてお気軽にご活用ください。</p>
  </div>

  <!-- フォーム -->
  <div class="form-card" id="formArea">
    <div class="form-section-label">✦ 生年月日と生まれた時間帯を入力 ✦</div>
    <div class="form-group">
      <label class="form-label">生年月日</label>
      <?php
        require_once __DIR__.'/inc/birthday-input.php';
        render_birthdate_input([
          'prefix'     => 'birth',
          'hiddenName' => 'birthDate',
          'startYear'  => 1900,
          'endYear'    => 2099,
        ]);
      ?>
    </div>
    <div class="form-group">
      <label class="form-label">生まれた時間帯</label>
      <div class="time-radio-group">
        <label class="time-radio-label">
          <input type="radio" name="timeZone" value="M">
          <span class="time-radio-icon">🌅</span>
          <span class="time-radio-text">朝</span>
          <span class="time-radio-sub">6〜11時</span>
        </label>
        <label class="time-radio-label">
          <input type="radio" name="timeZone" value="D">
          <span class="time-radio-icon">☀️</span>
          <span class="time-radio-text">昼</span>
          <span class="time-radio-sub">12〜17時</span>
        </label>
        <label class="time-radio-label">
          <input type="radio" name="timeZone" value="N">
          <span class="time-radio-icon">🌙</span>
          <span class="time-radio-text">夜</span>
          <span class="time-radio-sub">18〜24時</span>
        </label>
        <label class="time-radio-label">
          <input type="radio" name="timeZone" value="L">
          <span class="time-radio-icon">⭐</span>
          <span class="time-radio-text">深夜</span>
          <span class="time-radio-sub">0〜5時</span>
        </label>
        <label class="time-radio-label" style="grid-column:span 2">
          <input type="radio" name="timeZone" value="U" checked>
          <span class="time-radio-icon">🌌</span>
          <span class="time-radio-text">わからない</span>
          <span class="time-radio-sub">　</span>
        </label>
      </div>
    </div>
    <button class="calc-btn" onclick="calcSeiza()">✦ 星座で鑑定する ✦</button>
  </div>

  <!-- 結果 -->
  <div id="resultSection">
    <div class="result-title">✦ 西洋占星術 鑑定結果 ✦</div>
    <div class="type-card" id="typeCard"></div>
    <div class="result-block" id="signBlock"></div>
    <div class="result-block" id="innerBlock"></div>
    <div class="result-block" id="timeBlock"></div>
    <div class="result-block" id="elemBlock"></div>
    <div class="result-block" id="loveBlock"></div>
    <div class="result-block" id="jobsBlock"></div>

    <div class="share-wrap" id="shareWrap"></div>

    <?php
    $articleUrl   = '/articles/seiza/';
    $articleIcon  = '⭐';
    $articleTitle = '西洋占星術とは？';
    $articleDesc  = '12星座・エレメント・クオリティの意味と活用方法を解説';
    $contextKey   = 'seiza';
    $retryLabel   = 'もう一度鑑定する';
    $retryType    = 'js';
    $retryValue   = 'resetForm()';
    require __DIR__.'/inc/result-footer.php';
    ?>
  </div>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <p class="disclaimer">
    本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。
  </p>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// ══════════════════════════════════════════════
// データ定義
// ══════════════════════════════════════════════

// 12星座 (インデックス0=山羊座、順に水瓶,魚,牡羊,牡牛,双子,蟹,獅子,乙女,天秤,蠍,射手)
const SIGNS = [
  {code:'CP',name:'山羊座',symbol:'♑',element:1,quality:0,period:'12/22〜1/19',  suffix:'開拓者'},
  {code:'AQ',name:'水瓶座',symbol:'♒',element:2,quality:1,period:'1/20〜2/18',   suffix:'革命家'},
  {code:'PI',name:'魚座',  symbol:'♓',element:3,quality:2,period:'2/19〜3/20',   suffix:'夢見人'},
  {code:'AR',name:'牡羊座',symbol:'♈',element:0,quality:0,period:'3/21〜4/19',   suffix:'先駆者'},
  {code:'TA',name:'牡牛座',symbol:'♉',element:1,quality:1,period:'4/20〜5/20',   suffix:'守護者'},
  {code:'GE',name:'双子座',symbol:'♊',element:2,quality:2,period:'5/21〜6/21',   suffix:'語り部'},
  {code:'CA',name:'蟹座',  symbol:'♋',element:3,quality:0,period:'6/22〜7/22',   suffix:'守り手'},
  {code:'LE',name:'獅子座',symbol:'♌',element:0,quality:1,period:'7/23〜8/22',   suffix:'輝き人'},
  {code:'VI',name:'乙女座',symbol:'♍',element:1,quality:2,period:'8/23〜9/22',   suffix:'探求者'},
  {code:'LI',name:'天秤座',symbol:'♎',element:2,quality:0,period:'9/23〜10/23',  suffix:'調和者'},
  {code:'SC',name:'蠍座',  symbol:'♏',element:3,quality:1,period:'10/24〜11/21', suffix:'変革者'},
  {code:'SA',name:'射手座',symbol:'♐',element:0,quality:2,period:'11/22〜12/21', suffix:'旅人'},
];

// エレメント: 0=火, 1=地, 2=風, 3=水
const ELEMENTS = [
  {code:'F',name:'火',label:'ファイア',cls:'elem-fire',
   desc:'情熱・創造・直感のエレメント。エネルギーに満ち、行動力と発想力が豊か。感情表現が豊かで、周囲に活力を与える存在です。直感を信じて動くことで最大の力を発揮します。'},
  {code:'E',name:'地',label:'アース',cls:'elem-earth',
   desc:'安定・現実・継続のエレメント。地に足ついた判断力と、物事を形にする実行力があります。信頼性と誠実さが特徴で、着実に積み重ねることで大きな成果を生み出します。'},
  {code:'A',name:'風',label:'エア',cls:'elem-air',
   desc:'知性・コミュニケーション・変化のエレメント。思考が速く、情報を素早く処理します。社交的で、言葉を使って世界を動かす力があります。アイデアと人脈が武器です。'},
  {code:'W',name:'水',label:'ウォーター',cls:'elem-water',
   desc:'感情・直感・共感のエレメント。深い感受性と洞察力を持ち、人の心に寄り添う共感力が強みです。精神的な深さと豊かな想像力で、目に見えない世界を感じ取ります。'},
];

// クオリティ: 0=活動宮, 1=不動宮, 2=柔軟宮
const QUALITIES = [
  {name:'活動宮',en:'Cardinal',
   desc:'新しいサイクルを始める力の持ち主。行動を起こすイニシアチブと、物事を動かすエネルギーがあります。リーダーシップを発揮しやすく、変化の起点となる存在です。'},
  {name:'不動宮',en:'Fixed',
   desc:'一度始めたことをやり抜く強さを持ちます。変化に対してブレない意志力と深い集中力が特徴で、信頼と安定感を周囲に与えます。粘り強さが最大の武器です。'},
  {name:'柔軟宮',en:'Mutable',
   desc:'変化に適応する柔軟さを持ちます。季節の変わり目に生まれた転換と調整の力があり、橋渡し役として周囲をつなぎます。どんな状況にも馴染む適応力が光ります。'},
];

// 内面タイプ: 0-11、(month * 31 + day) % 12 で算出
const INNER_TYPES = [
  {code:'PA',name:'情熱型',prefix:'情熱的な',
   desc:'行動が先でとにかく熱い。自分の気持ちに正直で、やると決めたら全力を注ぐタイプです。感情の起伏があっても、その情熱が周囲を引き込む原動力になります。'},
  {code:'ST',name:'安定型',prefix:'大地のような',
   desc:'揺るぎない価値観を持ち、着実に積み重ねることを好みます。焦らず自分のペースで確かな結果を出し、人間関係でも信頼を大切にします。'},
  {code:'EX',name:'表現型',prefix:'輝きあふれる',
   desc:'自分の世界を外に出すことに喜びを感じます。言葉・アート・音楽など何かを通じて自己を表現することで輝く、感性豊かで創造力旺盛なタイプです。'},
  {code:'SE',name:'感受型',prefix:'星に感応する',
   desc:'周囲のエネルギーや感情を敏感に受け取ります。共感力が高く、人の気持ちに寄り添うのが得意。感情の深さが繊細な洞察力を生み出します。'},
  {code:'AN',name:'分析型',prefix:'深く見通す',
   desc:'物事を多角的に見て、根拠を持って判断します。データや事実を重視し、論理的な思考で最善策を見つける。細部への注意力が最大の強みです。'},
  {code:'HA',name:'調和型',prefix:'風のような',
   desc:'場のバランスを保つことを大切にします。対立を嫌い、みんなが心地よくいられる空間を作るのが得意な、高い協調性と社交性の持ち主です。'},
  {code:'QU',name:'探究型',prefix:'宇宙を旅する',
   desc:'未知への好奇心が絶えません。知らないことを知りたいという衝動が、深い専門知識や独自の視点を生みます。知的探求そのものが生きがいのタイプです。'},
  {code:'RE',name:'責任型',prefix:'使命を生きる',
   desc:'任されたことへの責任感が強く、最後まで誠実にやり遂げます。信頼を大切にし、約束を守ることで周囲から揺るぎない信用を集めます。'},
  {code:'FR',name:'自由型',prefix:'型破りな',
   desc:'枠や制約を嫌い、自分なりの生き方を追求します。縛られることへの抵抗感が強く、独自の価値観で人生を開拓していく個性の強いタイプです。'},
  {code:'CH',name:'挑戦型',prefix:'嵐を制す',
   desc:'困難や壁があるほど燃えるタイプ。リスクを恐れず正面から向き合う姿勢が、成長と突破口を生みます。強い競争心と向上心が特徴です。'},
  {code:'IV',name:'革新型',prefix:'時代を変える',
   desc:'現状に満足せず、変化を起こすことに情熱を持ちます。古い枠組みを壊し、新しいものを作ることが使命感につながる、先見性あるタイプです。'},
  {code:'DI',name:'直感型',prefix:'月光を纏う',
   desc:'論理より感覚で物事を捉えます。第六感や閃きが鋭く、言葉にならない「感じ」を大切にします。宇宙的なつながりを感じやすい神秘的なタイプです。'},
];

// 時間帯
const TIME_ZONES = [
  {code:'M',label:'朝（6〜11時）',icon:'🌅',
   desc:'物事の始まりに力強いエネルギーを持ちます。清々しい感覚を大切にし、午前中に集中力が高まる傾向があります。新しいスタートへの感受性が高く、朝の時間の使い方が人生を決めるタイプです。'},
  {code:'D',label:'昼（12〜17時）',icon:'☀️',
   desc:'活動のピーク時間に生まれた行動力旺盛なタイプ。社交的で人との交流を楽しみます。エネルギーが充実しており、実務的な力を最大限に発揮しやすい素質があります。'},
  {code:'N',label:'夜（18〜24時）',icon:'🌙',
   desc:'深い感受性と内省の力を持ちます。夕暮れ以降に思考が深まり、直感や創造性が花開くタイプです。感情の豊かさと物事の本質を見抜く洞察力に優れています。'},
  {code:'L',label:'深夜（0〜5時）',icon:'⭐',
   desc:'神秘的な感性と深い思索力を持ちます。夜の静寂の中でアイデアや洞察が湧き上がります。独特の世界観と精神的な深みが魅力で、常人とは異なる感受性を持ちます。'},
  {code:'U',label:'わからない',icon:'🌌',
   desc:'時間を超えた柔軟な感受性を持ちます。どんな時間帯にも適応し、状況に応じて自分のリズムを変えられる適応力が強みです。特定のパターンに縛られない自由さが個性です。'},
];

// 星座の説明文
const SIGN_DESC = [
  '目標達成への強い意志と現実的な行動力を持つ山羊座。責任感が強く、着実に実績を積み上げることで信頼を得ます。自己管理能力が高く、長期的な視点で物事を判断する経営者タイプです。',
  '独自の視点と革新的な思考を持つ水瓶座。型にはまることを嫌い、自分の信念に従って生きるタイプです。社会全体への貢献や未来志向のビジョンを大切にする理想主義者でもあります。',
  '豊かな想像力と深い感受性を持つ魚座。他者への共感力が高く、芸術や精神的な世界に引き寄せられます。境界線を越えた愛情と包容力が最大の魅力で、癒しの力を持ちます。',
  '先頭に立って道を切り開くリーダー気質の牡羊座。行動力と決断力に優れ、新しいことへの挑戦を恐れません。情熱的でエネルギッシュな生命力が周囲を引き連れていきます。',
  '安定と豊かさを愛する現実主義者の牡牛座。五感で美しいものを感じ取る感性があり、自分のペースで着実に物事を進めます。愛情深く誠実で、信頼できる存在として慕われます。',
  '好奇心旺盛でコミュニケーション能力が高い双子座。様々な情報や人との交流を楽しみ、多彩な才能を発揮します。軽やかさと適応力が武器で、どんな場にも自然に溶け込めます。',
  '家族や仲間への深い愛情を持つ蟹座。感情が豊かで、大切な人を守る本能が強いタイプです。直感力が鋭く、居心地の良い環境づくりが得意で、包み込むような安心感があります。',
  '生まれながらのカリスマと表現力を持つ獅子座。舞台の中心に立つことが自然なタイプで、周囲を温め、率いる力があります。創造性と誇りが特徴で、太陽のように輝く存在感があります。',
  '細部への注意力と分析力に優れる乙女座。完璧を追求し、丁寧で誠実な仕事ぶりで信頼されます。実用的な解決策を見つける才能があり、縁の下の力持ちとして周囲に貢献します。',
  '美的センスと調和への感覚が優れる天秤座。人間関係のバランスを重視し、公平で優雅な判断力を持ちます。社交的で対人関係が得意で、どんな相手とも心地よい関係を築けます。',
  '深く激しい感情と洞察力を持つ蠍座。表面に見えないものを見抜く力があり、変容と再生のサイクルを体験しながら成長します。情熱的で意志が強く、一度決めたら揺るがない強さがあります。',
  '自由と探求を愛する哲学者タイプの射手座。広い視野と楽観的な精神で、遠くへ向かう冒険心が人生を豊かにします。真実を探し続け、知的な成長を生涯続けることを喜びとします。',
];

// 恋愛スタイル（星座別）
const LOVE_STYLE = [
  '慎重に相手を見極める真剣恋愛派。一度心を開いたら誠実に尽くしますが、感情を素直に表現するには時間がかかります。長期的な関係に向いており、信頼関係が愛情の土台になります。',
  '友達のような関係を理想とするタイプ。束縛を嫌い、お互いの自由を尊重できるパートナーを求めます。知的な刺激が恋愛の土台になり、精神的なつながりを何より大切にします。',
  '相手と魂で溶け合うような深い愛を求めます。ロマンチックで献身的な恋愛スタイルですが、理想が高い分、傷つきやすい繊細さも持ちます。共感できる相手に深く惹かれます。',
  '一目惚れの激しい恋愛をするタイプ。積極的にアプローチし、情熱が冷めないよう常に新鮮さを大切にします。スピード感のある恋愛を好み、直感で行動します。',
  '安定した長期的な関係を好みます。じっくりと信頼を築き、愛情を物質的・身体的に表現することが多いです。誠実さと継続性が最大の魅力で、パートナーを大切に育てます。',
  '会話とコミュニケーションを大切にする恋愛スタイル。刺激的な相手に惹かれ、常に新鮮な関係を求めます。自由人のため複数の交友を楽しみながら、真剣な相手を見極めます。',
  '深い絆と安心感を大切にするタイプ。保護本能が強く、相手をしっかり支えますが、傷つくことへの恐れから慎重になることも。心を開いた相手には全てを与えます。',
  '情熱的でドラマチックな恋愛を好みます。愛情表現が豊かで、相手を特別な存在として扱います。プライドと愛情が共存し、尊敬し合える関係が最も長続きします。',
  '細やかな気配りで愛情を表現するタイプ。相手の良いところを見つけ、実用的に支える誠実なパートナーです。完璧を求めすぎて自分や相手を追い詰めないよう注意が必要です。',
  '調和とロマンスを大切にします。パートナーとの関係を理想的に保ちたいという願望が強い恋愛派です。不公平な関係を嫌い、バランスのとれた対等な愛を求めます。',
  '深くて独占欲のある愛情スタイル。心から信頼できる相手には全てを捧げる強さと忠誠心を持ちます。表面的な関係には興味がなく、魂レベルでのつながりを求めます。',
  '恋愛にも冒険と自由を求めます。精神的・知的な成長ができる相手との恋愛が長続きします。束縛は禁物で、共に遠くへ向かえる冒険仲間のようなパートナーが理想です。',
];

// 仕事適性（星座別）
const JOBS = [
  ['経営者・起業家','政治家・官僚','ファイナンシャルプランナー'],
  ['ITエンジニア','社会起業家・活動家','発明家・研究者'],
  ['アーティスト・音楽家','カウンセラー・セラピスト','医療・福祉職'],
  ['起業家・フリーランス','スポーツ選手','営業・セールス'],
  ['デザイナー・職人','料理人・パティシエ','不動産・資産管理'],
  ['ライター・ジャーナリスト','PR・広報・マーケター','教育者・講師'],
  ['保育士・看護師','料理人・栄養士','インテリアコーディネーター'],
  ['俳優・パフォーマー','マネージャー・プロデューサー','インフルエンサー・クリエイター'],
  ['データアナリスト・研究者','編集者・校正者','医師・薬剤師'],
  ['弁護士・調停者','ファッション・美容','外交官・通訳'],
  ['心理士・精神科医','調査・分析の専門家','外科医・研究者'],
  ['旅行・観光業','哲学者・出版・編集','国際ビジネス・貿易'],
];

// ══════════════════════════════════════════════
// 計算ロジック
// ══════════════════════════════════════════════

function getZodiacIndex(month, day) {
  const FIRST_SIGN = [0,1,2,3,4,5,6,7,8,9,10,11];
  const CUTOFF     = [19,18,20,19,20,21,22,22,22,23,21,21];
  const m = month - 1;
  return day <= CUTOFF[m] ? FIRST_SIGN[m] : (FIRST_SIGN[m] + 1) % 12;
}

function getInnerTypeIndex(month, day) {
  return (month * 31 + day) % 12;
}

function getTimeZoneIndex(code) {
  const map = {M:0,D:1,N:2,L:3,U:4};
  return map[code] ?? 4;
}

// ══════════════════════════════════════════════
// メイン計算・描画
// ══════════════════════════════════════════════

function calcSeiza() {
  const dateVal = window.BirthdayInput.getValue('birth');
  if (!dateVal) { alert('生年月日を入力してください'); return; }
  const [year, month, day] = dateVal.split('-').map(Number);
  if (year < 1900 || year > 2099) { alert('1900年〜2099年の範囲で入力してください'); return; }

  const tzRadio = document.querySelector('input[name="timeZone"]:checked');
  const tzCode = tzRadio ? tzRadio.value : 'U';

  document.getElementById('loadingOverlay').classList.add('show');
  setTimeout(() => {
    try { _calcAndRender(year, month, day, tzCode); }
    finally { document.getElementById('loadingOverlay').classList.remove('show'); }
  }, 800);
}

function _renderResult(signIdx, innerIdx, tzCode, dateLine) {
  const sign    = SIGNS[signIdx];
  const inner   = INNER_TYPES[innerIdx];
  const tz      = TIME_ZONES[getTimeZoneIndex(tzCode)];
  const elem    = ELEMENTS[sign.element];
  const quality = QUALITIES[sign.quality];
  const nickname = inner.prefix + sign.suffix;

  document.getElementById('typeCard').innerHTML = `
    <div class="type-badge">西洋占星術 個性鑑定</div>
    <div class="type-sign">${sign.symbol}</div>
    <div class="type-nickname">${nickname}</div>
    <div class="badge-row">
      <span class="elem-badge ${elem.cls}">🔥 ${elem.name}エレメント（${elem.label}）</span>
      <span class="quality-badge">⚡ ${quality.name}（${quality.en}）</span>
    </div>
    <div class="type-label">${sign.name}・${inner.name}・${tz.icon} ${tz.label}</div>
    ${dateLine ? `<div style="margin-top:.8rem;font-family:var(--ff-mono);font-size:.6rem;color:var(--muted)">${dateLine} ／ ${sign.period}</div>` : ''}
  `;

  document.getElementById('signBlock').innerHTML = `
    <div class="result-block-title">⭐ あなたの太陽星座 ─ ${sign.name}</div>
    <div class="result-block-body">${SIGN_DESC[signIdx]}</div>
    <div style="margin-top:.75rem">
      <span style="font-family:var(--ff-mono);font-size:.65rem;background:var(--seiza-bg);border:1px solid var(--seiza-border);border-radius:12px;padding:.2rem .6rem;color:var(--seiza2)">${sign.symbol} ${sign.name}（${sign.period}）</span>
    </div>
  `;

  document.getElementById('innerBlock').innerHTML = `
    <div class="result-block-title">🌙 内面タイプ ─ ${inner.name}</div>
    <div class="result-block-body">${inner.desc}</div>
    <div style="margin-top:.75rem;font-family:var(--ff-mono);font-size:.65rem;color:var(--muted)">太陽星座が「外の顔」なら、内面タイプは「内なる動機」を映します。</div>
  `;

  document.getElementById('timeBlock').innerHTML = `
    <div class="result-block-title">${tz.icon} 生まれた時間帯 ─ ${tz.label}</div>
    <div class="result-block-body">${tz.desc}</div>
  `;

  document.getElementById('elemBlock').innerHTML = `
    <div class="result-block-title">🔥 エレメント ─ ${elem.name}（${elem.label}） ／ ${quality.name}</div>
    <div class="result-block-body">${elem.desc}<br><br><strong style="color:var(--gold2)">${quality.name}について：</strong>${quality.desc}</div>
  `;

  document.getElementById('loveBlock').innerHTML = `
    <div class="result-block-title">❤ 恋愛スタイル</div>
    <div class="result-block-body">${LOVE_STYLE[signIdx]}</div>
  `;

  document.getElementById('jobsBlock').innerHTML = `
    <div class="result-block-title">💼 向いている仕事</div>
    <div class="jobs-grid">${JOBS[signIdx].map(j=>`<span class="job-tag">${j}</span>`).join('')}</div>
  `;

  const shareText = encodeURIComponent(`私は「${nickname}」タイプの${sign.name}でした #西洋占星術診断`);
  const shareUrl  = encodeURIComponent(location.href);
  document.getElementById('shareWrap').innerHTML = `
    <div class="share-label">鑑定結果をシェアする</div>
    <div class="share-btns">
      <a href="https://twitter.com/intent/tweet?text=${shareText}&url=${shareUrl}" target="_blank" rel="noopener noreferrer" class="share-btn share-x">𝕏 シェア</a>
      <a href="https://social-plugins.line.me/lineit/share?url=${shareUrl}" target="_blank" rel="noopener noreferrer" class="share-btn share-line">LINE</a>
      <button onclick="openShare('fb')" class="share-btn share-fb">Facebook</button>
      <button onclick="copyPageUrl()" class="share-btn share-copy" id="copyUrlBtn">🔗 URLをコピー</button>
    </div>
  `;

  document.getElementById('formArea').style.display = 'none';
  scrollToResult('resultSection');
}

function _calcAndRender(year, month, day, tzCode) {
  const signIdx  = getZodiacIndex(month, day);
  const innerIdx = getInnerTypeIndex(month, day);
  const sign = SIGNS[signIdx];
  const inner = INNER_TYPES[innerIdx];
  const elem = ELEMENTS[sign.element];
  const resultCode = `${sign.code}-${inner.code}-${tzCode}-${elem.code}`;
  history.pushState(null, '', '/seiza?r=' + resultCode);
  _renderResult(signIdx, innerIdx, tzCode, `${year}年${month}月${day}日生まれ`);
}

function copyPageUrl() {
  navigator.clipboard.writeText(location.href).then(() => {
    const btn = document.getElementById('copyUrlBtn');
    const orig = btn.textContent;
    btn.textContent = '✓ コピーしました！';
    setTimeout(() => { btn.textContent = orig; }, 2000);
  });
}

function resetForm() {
  history.pushState(null, '', '/seiza');
  document.getElementById('formArea').style.display = 'block';
  document.getElementById('resultSection').style.display = 'none';
  window.scrollTo({top:0,behavior:'smooth'});
}

// ?r= パラメータがあれば自動で結果表示
(function() {
  const params = new URLSearchParams(location.search);
  const r = params.get('r');
  if (!r) return;
  const m = r.match(/^([A-Z]{2})-([A-Z]{2})-([A-Z])-([A-Z])$/);
  if (!m) return;
  const [, signCode, innerCode, tzCode] = m;
  const signIdx  = SIGNS.findIndex(s => s.code === signCode);
  const innerIdx = INNER_TYPES.findIndex(t => t.code === innerCode);
  if (signIdx < 0 || innerIdx < 0) return;
  _renderResult(signIdx, innerIdx, tzCode, '');
})();
</script>
</body>
</html>
