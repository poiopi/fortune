<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="姓名判断｜あなたの名前に宿る運命を五格で鑑定。天格・人格・地格・外格・総格から運勢・性格・対人運を読み解きます。">
<title>姓名判断｜名前に宿る運命を五格で鑑定</title>
<link rel="canonical" href="https://life-fun.net/seimei" />
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
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
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#08060f;--card:#1e1738;--card2:#251d42;
  --border:rgba(160,130,220,.18);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8c96a;--violet:#9b72ef;--violet-lt:#c4a8f5;
  --rose:#e8719a;--teal:#4ecdc4;--text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.2) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.12) 0%,transparent 55%);pointer-events:none;z-index:0}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

/* HERO */
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2.5rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;line-height:1.4;letter-spacing:.1em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 60%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.6rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

/* FORM */
.form-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:2rem;max-width:500px;margin:0 auto 2.5rem}
.form-card::before{content:'';display:block;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal));border-radius:2px 2px 0 0;margin:-2rem -2rem 1.8rem}
.form-title{font-family:var(--ff-serif);font-size:.9rem;letter-spacing:.12em;color:var(--gold);text-align:center;margin-bottom:1.5rem}
.form-row{display:flex;gap:1rem;margin-bottom:1.2rem}
.form-group{flex:1;display:flex;flex-direction:column;gap:.4rem}
.form-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.12em;color:var(--muted);text-transform:uppercase}
.form-input{background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.65rem .9rem;font-family:var(--ff-serif);font-size:.95rem;color:var(--text);outline:none;transition:border-color .2s;letter-spacing:.04em;text-align:center;width:100%}
.form-input:focus{border-color:var(--violet)}
.form-input::placeholder{color:rgba(138,125,181,.4);font-size:.9rem}
.form-note{font-family:var(--ff-mono);font-size:.6rem;color:var(--muted);text-align:center;margin-bottom:1.2rem;letter-spacing:.06em}
.sub-btn{width:100%;background:linear-gradient(135deg,var(--gold),var(--violet));border:none;border-radius:10px;padding:.85rem;font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:#fff;cursor:pointer;letter-spacing:.12em;transition:opacity .2s;position:relative;overflow:hidden}
.sub-btn:hover{opacity:.88}
.sub-btn::after{content:'✦ 鑑定する ✦';position:absolute;inset:0;display:flex;align-items:center;justify-content:center}
.sub-btn span{visibility:hidden}

/* ══════════════════════════════════
   ANIMATION OVERLAY
══════════════════════════════════ */
.anim-overlay{
  position:fixed;inset:0;z-index:500;
  background:rgba(8,6,15,.92);backdrop-filter:blur(8px);
  display:none;align-items:center;justify-content:center;flex-direction:column
}
.anim-overlay.on{display:flex}

/* 半紙 */
.washi-stage{position:relative;display:flex;align-items:center;justify-content:center}
.washi-paper{
  position:relative;
  background:linear-gradient(135deg,#f5f0e8 0%,#ede8d8 40%,#f0ead8 100%);
  border-radius:4px;
  padding:2.5rem 3rem;
  min-width:320px;min-height:200px;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 8px 40px rgba(0,0,0,.6),inset 0 0 30px rgba(180,160,120,.15);
  overflow:hidden
}
/* 和紙テクスチャ */
.washi-paper::before{
  content:'';position:absolute;inset:0;
  background-image:repeating-linear-gradient(0deg,transparent,transparent 3px,rgba(180,160,120,.04) 3px,rgba(180,160,120,.04) 4px),
                   repeating-linear-gradient(90deg,transparent,transparent 3px,rgba(180,160,120,.04) 3px,rgba(180,160,120,.04) 4px);
  pointer-events:none
}
.name-display{
  font-family:var(--ff-serif);font-size:clamp(2.4rem,8vw,4rem);
  font-weight:700;letter-spacing:.15em;color:#1a0f05;
  white-space:nowrap;position:relative;z-index:1;
  display:flex;gap:.1em;align-items:center
}
.name-char{
  display:inline-block;opacity:0;position:relative;
}
.name-char.revealed{animation:char-reveal 1.1s cubic-bezier(.25,.1,.25,1) forwards}
@keyframes char-reveal{
  0%  {opacity:1;clip-path:inset(0 0 100% 0)}
  100%{opacity:1;clip-path:inset(0 0 0% 0)}
}
.name-space{display:inline-block;width:.4em}

/* 筆カーソル */
.brush-cursor{
  position:absolute;z-index:10;pointer-events:none;
  font-size:2rem;transform:rotate(40deg) translate(-50%,-50%);
  filter:drop-shadow(0 2px 4px rgba(0,0,0,.4));
  transition:left .05s,top .05s;
  opacity:0
}

/* 額縁 */
.frame-border{
  position:absolute;background:linear-gradient(135deg,#8b6914,#c9a84c,#8b6914);
  transition:all .5s cubic-bezier(.4,0,.2,1);
}
.frame-top{top:0;left:50%;width:0;height:12px;transform:translateX(-50%);border-radius:2px 2px 0 0}
.frame-bottom{bottom:0;left:50%;width:0;height:12px;transform:translateX(-50%);border-radius:0 0 2px 2px}
.frame-left{left:0;top:50%;width:12px;height:0;transform:translateY(-50%);border-radius:2px 0 0 2px}
.frame-right{right:0;top:50%;width:12px;height:0;transform:translateY(-50%);border-radius:0 2px 2px 0}
.frame-border.show-h{width:calc(100% + 12px)!important}
.frame-border.show-v{height:calc(100% + 12px)!important}
/* 額縁コーナー */
.frame-corner{
  position:absolute;width:16px;height:16px;
  background:linear-gradient(135deg,#e8c96a,#8b6914);border-radius:2px;
  opacity:0;transition:opacity .3s;z-index:2
}
.fc-tl{top:-2px;left:-2px}
.fc-tr{top:-2px;right:-2px}
.fc-bl{bottom:-2px;left:-2px}
.fc-br{bottom:-2px;right:-2px}

/* SKIPボタン */
.skip-btn{
  position:fixed;bottom:2rem;right:2rem;
  background:none;border:1px solid rgba(255,255,255,.2);border-radius:20px;
  color:rgba(255,255,255,.5);font-family:var(--ff-mono);font-size:.65rem;
  letter-spacing:.1em;padding:.4rem 1rem;cursor:pointer;transition:all .2s
}
.skip-btn:hover{border-color:rgba(255,255,255,.5);color:rgba(255,255,255,.8)}

/* スパークルcanvas */
#sparkCv{position:fixed;inset:0;pointer-events:none;z-index:600}

/* 鑑定完了後のメッセージ */
.anim-done-msg{
  font-family:var(--ff-serif);font-size:.8rem;letter-spacing:.2em;
  color:var(--gold);margin-top:1.5rem;opacity:0;
  transition:opacity .8s;text-align:center
}
.anim-done-msg.on{opacity:1}
.view-result-btn{
  margin-top:1rem;background:linear-gradient(135deg,var(--gold),var(--violet));
  border:none;border-radius:10px;padding:.65rem 2rem;
  font-family:var(--ff-serif);font-size:.9rem;font-weight:600;
  color:#fff;cursor:pointer;letter-spacing:.1em;
  opacity:0;transition:opacity .8s .3s;display:block
}
.view-result-btn.on{opacity:1}

/* ══════════════════════════════════
   RESULTS
══════════════════════════════════ */
#resultSection{display:none;max-width:680px;margin:0 auto 3rem}
.result-name-display{
  text-align:center;margin-bottom:2rem;
  font-family:var(--ff-serif);font-size:clamp(1.6rem,5vw,2.6rem);
  font-weight:700;letter-spacing:.2em;color:var(--gold-lt);
  text-shadow:0 0 30px rgba(201,168,76,.3)
}
.result-name-display small{display:block;font-size:.5em;letter-spacing:.15em;color:var(--muted);margin-top:.3rem}

.gogaku-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:2rem}
@media(max-width:520px){.gogaku-grid{grid-template-columns:1fr}}
.gogaku-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.2rem;position:relative;overflow:hidden}
.gogaku-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
.gogaku-card.tenkaku::before{background:linear-gradient(90deg,var(--gold),#e8c96a)}
.gogaku-card.jinkaku::before{background:linear-gradient(90deg,var(--violet),var(--violet-lt))}
.gogaku-card.chikaku::before{background:linear-gradient(90deg,var(--teal),#7ef0e8)}
.gogaku-card.gaikaku::before{background:linear-gradient(90deg,var(--rose),#f0a0be)}
.gogaku-card.soukaku::before{background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal));grid-column:1/-1}
.gogaku-card.soukaku{grid-column:1/-1}
.gogaku-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.16em;color:var(--muted);margin-bottom:.3rem}
.gogaku-num{font-family:var(--ff-serif);font-size:2rem;font-weight:700;color:var(--gold-lt);line-height:1;margin-bottom:.4rem}
.gogaku-kichi{display:inline-block;font-family:var(--ff-mono);font-size:.6rem;padding:.1rem .5rem;border-radius:4px;margin-bottom:.5rem}
.kichi-dai{background:rgba(201,168,76,.18);color:var(--gold);border:1px solid rgba(201,168,76,.3)}
.kichi-chu{background:rgba(155,114,239,.18);color:var(--violet-lt);border:1px solid rgba(155,114,239,.3)}
.kichi-kyo{background:rgba(232,113,154,.18);color:var(--rose);border:1px solid rgba(232,113,154,.3)}
.gogaku-title{font-family:var(--ff-serif);font-size:.85rem;font-weight:600;color:var(--text);margin-bottom:.4rem}
.gogaku-desc{font-family:var(--ff-sans);font-size:.78rem;color:var(--muted);line-height:1.7}

.overall-card{background:linear-gradient(135deg,rgba(30,23,56,.9),rgba(37,29,66,.9));border:1px solid var(--border2);border-radius:16px;padding:1.8rem;margin-bottom:2rem;text-align:center}
.overall-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--muted);margin-bottom:.6rem}
.overall-title{font-family:var(--ff-serif);font-size:1.4rem;font-weight:700;color:var(--gold-lt);margin-bottom:.6rem;letter-spacing:.08em}
.overall-desc{font-family:var(--ff-sans);font-size:.85rem;color:var(--text);line-height:1.8}

.retry-wrap{text-align:center;margin:2rem 0}
.retry-btn-link{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.6rem;border:1px solid var(--border2);border-radius:20px;font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);cursor:pointer;text-decoration:none;background:none;transition:color .2s,border-color .2s}
.retry-btn-link:hover{color:var(--text);border-color:var(--violet)}

.disclaimer{max-width:900px;margin:0 auto 1.5rem;padding:0 1.2rem;text-align:center;font-size:.72rem;color:var(--muted);line-height:1.8}

footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

/* ── HEADER ── */
header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px)}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a,.header-nav span{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
  .sp-dropdown.open{display:block}
  .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
}
</style>
</head>
<body>

<?php $currentPage='seimei'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">Seimei Handan · 姓名判断</span>
    <h1>名前に宿る運命を鑑定する</h1>
    <p class="hero-sub">五格（天格・人格・地格・外格・総格）から<br>あなたの運勢・性格・対人運を読み解きます。</p>
  </section>

  <div class="form-card">
    <div class="form-title">✦ お名前を入力してください ✦</div>
    <div class="form-row">
      <div class="form-group">
        <span class="form-label">姓（名字）</span>
        <input class="form-input" type="text" id="inputSei" placeholder="山田" maxlength="8">
      </div>
      <div class="form-group">
        <span class="form-label">名（名前）</span>
        <input class="form-input" type="text" id="inputMei" placeholder="花子" maxlength="8">
      </div>
    </div>
    <p class="form-note">漢字・ひらがな・カタカナで入力してください</p>
    <button class="sub-btn" onclick="startSeimei()"><span>鑑定する</span></button>
  </div>
</div>

<!-- ANIMATION OVERLAY -->
<div class="anim-overlay" id="animOverlay">
  <div class="washi-stage" id="washiStage">
    <div class="washi-paper" id="washiPaper">
      <div class="name-display" id="nameDisplay"></div>
      <div class="brush-cursor" id="brushCursor">🖌️</div>
      <div class="frame-border frame-top" id="fTop"></div>
      <div class="frame-border frame-bottom" id="fBot"></div>
      <div class="frame-border frame-left" id="fLeft"></div>
      <div class="frame-border frame-right" id="fRight"></div>
      <div class="frame-corner fc-tl" id="fcTL"></div>
      <div class="frame-corner fc-tr" id="fcTR"></div>
      <div class="frame-corner fc-bl" id="fcBL"></div>
      <div class="frame-corner fc-br" id="fcBR"></div>
    </div>
  </div>
  <div class="anim-done-msg" id="animDoneMsg">✦ 鑑定が完了しました ✦</div>
  <button class="view-result-btn" id="viewResultBtn" onclick="showResult()">結果を見る →</button>
  <button class="skip-btn" id="skipBtn" onclick="skipAnim()">SKIP ▶</button>
</div>
<canvas id="sparkCv"></canvas>

<!-- RESULTS -->
<div class="wrap" id="resultSection">
  <div class="result-name-display" id="resultNameDisplay"></div>
  <div class="overall-card" id="overallCard"></div>
  <div class="gogaku-grid" id="gogakuGrid"></div>
  <?php require __DIR__.'/inc/share-btns.php'; ?>
  <div class="retry-wrap">
    <button class="retry-btn-link" onclick="resetForm()">← もう一度鑑定する</button>
  </div>
</div>

<p class="disclaimer">※ 画数は熊崎式に基づいて算出していますが、一部の漢字は正確でない場合があります。<br>本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。</p>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// ══════════════════════════════════════════════════════
// 画数テーブル（常用漢字・人名漢字 主要）
// ══════════════════════════════════════════════════════
const KK={
  // 1画
  '一':1,'乙':1,
  // 2画
  '二':2,'人':2,'入':2,'八':2,'力':2,'刀':2,'十':2,'又':2,'丁':2,
  // 3画
  '三':3,'上':3,'下':3,'山':3,'川':3,'土':3,'大':3,'小':3,'子':3,'女':3,'口':3,'万':3,'千':3,'久':3,'丸':3,'凡':3,'也':3,'亡':3,'弓':3,'之':3,'己':3,'干':3,'工':3,'丈':3,'叉':3,'士':3,'弋':3,
  // 4画
  '中':4,'元':4,'内':4,'六':4,'円':4,'化':4,'天':4,'太':4,'少':4,'心':4,'月':4,'木':4,'水':4,'火':4,'父':4,'今':4,'公':4,'友':4,'以':4,'分':4,'切':4,'仁':4,'区':4,'午':4,'幻':4,'斗':4,'日':4,'比':4,'毛':4,'牛':4,'犬':4,'王':4,'止':4,'文':4,'方':4,'升':4,'手':4,'支':4,'引':4,'互':4,'介':4,'允':4,'井':4,'夫':4,'丹':4,'云':4,'及':4,'勾':4,'屯':4,'氏':4,'氷':4,'片':4,'爪':4,'爿':4,
  // 5画
  '主':5,'代':5,'出':5,'加':5,'功':5,'古':5,'右':5,'左':5,'四':5,'外':5,'市':5,'本':5,'生':5,'白':5,'目':5,'石':5,'立':5,'冬':5,'北':5,'平':5,'弘':5,'央':5,'永':5,'玄':5,'由':5,'田':5,'正':5,'民':5,'末':5,'未':5,'札':5,'兄':5,'写':5,'仙':5,'令':5,'充':5,'史':5,'司':5,'台':5,'弁':5,'広':5,'弥':5,'付':5,'仕':5,'他':5,'冊':5,'処':5,'辺':5,'丘':5,'凸':5,'凹':5,'刊':5,'包':5,'叫':5,'叱':5,'占':5,'印':5,'卯':5,'囚':5,'圧':5,'奴':5,'孕':5,'尻':5,'布':5,'幼':5,'払':5,'旦':5,'旧':5,'玉':5,'甲':5,'皮':5,'皿':5,'矢':5,'示':5,'礼':5,'穴':5,
  // 6画
  '名':6,'年':6,'地':6,'多':6,'宇':6,'安':6,'寺':6,'光':6,'全':6,'共':6,'兆':6,'先':6,'字':6,'曲':6,'有':6,'行':6,'西':6,'会':6,'伊':6,'伍':6,'任':6,'仲':6,'伎':6,'休':6,'件':6,'伏':6,'企':6,'向':6,'各':6,'回':6,'団':6,'在':6,'圭':6,'壮':6,'好':6,'如':6,'妃':6,'宅':6,'州':6,'朱':6,'江':6,'池':6,'百':6,'竹':6,'糸':6,'耳':6,'臼':6,'舌':6,'舟':6,'色':6,'虫':6,'血':6,'衣':6,'成':6,'旭':6,'吉':6,'羽':6,'庄':6,'亘':6,'仮':6,'仰':6,'再':6,'危':6,'吃':6,'吊':6,'吐':6,'廷':6,'次':6,'此':6,'死':6,'汗':6,'汚':6,'芋':6,'芸':6,'亦':6,'至':6,'早':6,'同':6,'当':6,'合':6,'気':6,'米':6,'肉':6,'自':6,'老':6,'号':6,'式':6,'灰':6,'机':6,'収':6,'而':6,'吏':6,'旬':6,'汁':6,'扱':6,'后':6,
  // 7画
  '花':7,'男':7,'町':7,'里':7,'村':7,'見':7,'言':7,'谷':7,'走':7,'身':7,'車':7,'形':7,'志':7,'孝':7,'宏':7,'希':7,'序':7,'応':7,'我':7,'麦':7,'李':7,'来':7,'伸':7,'住':7,'体':7,'作':7,'克':7,'助':7,'初':7,'努':7,'労':7,'均':7,'声':7,'妙':7,'妥':7,'妨':7,'孜':7,'完':7,'寿':7,'択':7,'投':7,'抑':7,'改':7,'攻':7,'材':7,'杉':7,'束':7,'条':7,'汐':7,'沙':7,'沢':7,'沖':7,'決':7,'状':7,'社':7,'秀':7,'私':7,'究':7,'系':7,'良':7,'芙':7,'芝':7,'芳':7,'角':7,'豆':7,'貝':7,'赤':7,'足':7,'辛':7,'防':7,'亨':7,'佐':7,'坂':7,'那':7,'汪':7,'杏':7,'亜':7,'低':7,'何':7,'但':7,'位':7,'余':7,'免':7,'典':7,'刺':7,'坑':7,'坐':7,'岐':7,'床':7,'弄':7,'把':7,'汽':7,'串':7,'伺':7,'役':7,'折':7,'尾':7,'局':7,
  // 8画
  '和':8,'知':8,'東':8,'金':8,'長':8,'門':8,'明':8,'学':8,'岡':8,'岸':8,'岩':8,'岳':8,'典':8,'制':8,'刷':8,'券':8,'取':8,'受':8,'命':8,'固':8,'国':8,'坪':8,'妻':8,'姓':8,'委':8,'宗':8,'宙':8,'定':8,'宜':8,'実':8,'居':8,'届':8,'弦':8,'径':8,'往':8,'彼':8,'松':8,'林':8,'枝':8,'果':8,'柔':8,'武':8,'波':8,'沿':8,'泳':8,'注':8,'治':8,'炎':8,'版':8,'玩':8,'直':8,'空':8,'青':8,'昌':8,'旺':8,'昂':8,'昆':8,'奈':8,'阿':8,'忠':8,'昇':8,'岬':8,'牧':8,'依':8,'侑':8,'茅':8,'佳':8,'拓':8,'昔':8,'昏':8,'旻':8,'育':8,'英':8,'茂':8,'妹':8,'並':8,'乳':8,'享':8,'使':8,'例':8,'其':8,'刻':8,'到':8,'卒':8,'協':8,'参':8,'叔':8,'孤':8,
  // 9画
  '春':9,'南':9,'思':9,'相':9,'美':9,'風':9,'飛':9,'食':9,'香':9,'品':9,'革':9,'音':9,'研':9,'祐':9,'祖':9,'紀':9,'信':9,'俊':9,'保':9,'侍':9,'侃':9,'便':9,'係':9,'冠':9,'前':9,'則':9,'勇':9,'勉':9,'単':9,'城':9,'姿':9,'威':9,'室':9,'宣':9,'客':9,'宮':9,'帝':9,'巷':9,'建':9,'律':9,'恒':9,'恵':9,'拝':9,'指':9,'政':9,'施':9,'映':9,'染':9,'柳':9,'栄':9,'洋':9,'洲':9,'海':9,'炭':9,'玲':9,'珍':9,'珠':9,'界':9,'省':9,'眉':9,'神':9,'秋':9,'紅':9,'虹':9,'訂':9,'持':9,'咲':9,'後':9,'待':9,'星':9,'重':9,'活':9,'彦':9,'泉':9,'柊':9,'柚':9,'哉':9,'契':9,'洸':9,'皇':9,'砂':9,'亭':9,'俗':9,'急':9,'型':9,'県':9,'派':9,'砕':9,'祈':9,'胃':9,'背':9,'勅':9,'叙':9,'垂':9,'封':9,'峡':9,'幽':9,'拾':9,'昭':9,'炉':9,'狭':9,'祉':9,'突':9,'要':9,'貞':9,'茜':9,'柾':9,'昴':9,
  // 10画
  '夏':10,'原':10,'高':10,'時':10,'真':10,'桜':10,'桃':10,'格':10,'核':10,'桔':10,'根':10,'栗':10,'案':10,'桂':10,'倫':10,'修':10,'倉':10,'個':10,'候':10,'剣':10,'剛':10,'員':10,'哲':10,'家':10,'宰':10,'宴':10,'容':10,'展':10,'島':10,'座':10,'庭':10,'恭':10,'悦':10,'振':10,'旅':10,'栞':10,'浩':10,'浪':10,'浜':10,'流':10,'消':10,'烈':10,'特':10,'祥':10,'記':10,'純':10,'素':10,'紙':10,'航':10,'般':10,'草':10,'荒':10,'連':10,'郊':10,'郎':10,'都':10,'馬':10,'莉':10,'竜':10,'凌':10,'浬':10,'倖':10,'峻':10,'珀':10,'班':10,'奏':10,'倹':10,'値':10,'俸':10,'桐':10,'益':10,'席':10,'粉':10,'倒':10,'恋':10,'兼':10,'剥':10,'唐':10,'宮':10,'悟':10,'扇':10,'晋':10,'桂':10,'殊':10,'泰':10,'浦':10,'烏':10,'珠':10,'疾':10,'砲':10,'租':10,'耕':10,'訓':10,'財':10,'透':10,'酌':10,'陣':10,'降':10,'隼':10,
  // 11画
  '雪':11,'鳥':11,'鹿':11,'麻':11,'望':11,'深':11,'移':11,'清':11,'淳':11,'渉':11,'球':11,'琢':11,'略':11,'眼':11,'祭':11,'粒':11,'絆':11,'経':11,'健':11,'偉':11,'偲':11,'副':11,'勘':11,'勤':11,'動':11,'務':11,'唯':11,'問':11,'商':11,'基':11,'堂':11,'執':11,'培':11,'崇':11,'崎':11,'帯':11,'彩':11,'情':11,'捜':11,'探':11,'採':11,'授':11,'教':11,'梅':11,'梨':11,'渓':11,'淡':11,'混':11,'添':11,'第':11,'累':11,'細':11,'組':11,'終':11,'紳':11,'船':11,'苗':11,'菊':11,'設':11,'訪':11,'野':11,'悠':11,'萌':11,'部':11,'斎':11,'紬':11,'梢':11,'淑':11,'淡':11,'渚':11,'爽':11,'習':11,'亀':11,'菖':11,'陸':11,'康':11,'彬':11,'紺':11,'紋':11,'崔':11,'崩':11,'帳':11,'患':11,'掃':11,'描':11,'捻':11,'推':11,'接':11,'掘':11,'控':11,'曹':11,'望':11,'条':11,'梓':11,'笛':11,'符':11,'菓':11,'蛇':11,'赦':11,'軟':11,'野':11,'頂':11,'魚':11,'鹿':11,'黄':11,
  // 12画
  '晴':12,'森':12,'晶':12,'景':12,'結':12,'絵':12,'葵':12,'葉':12,'道':12,'雄':12,'幾':12,'貴':12,'開':12,'間':12,'博':12,'善':12,'喜':12,'報':12,'富':12,'寒':12,'寛':12,'尊':12,'就':12,'幸':12,'復':12,'朝':12,'期':12,'棟':12,'棒':12,'植':12,'湖':12,'湧':12,'無':12,'登':12,'発':12,'皓':12,'着':12,'短':12,'紫':12,'給':12,'統':12,'菅':12,'菜':12,'菱':12,'視':12,'貿':12,'超':12,'距':12,'遊':12,'量':12,'隆':12,'集':12,'渡':12,'翔':12,'陽':12,'暁':12,'湊':12,'琴':12,'絡':12,'紫':12,'晃':12,'創':12,'智':12,'竣':12,'勝':12,'温':12,'奥':12,'換':12,'揺':12,'敬':12,'棋':12,'款':12,'淵':12,'游':12,'焦':12,'番':12,'絞':12,'絡':12,'腕':12,'葛':12,'街':12,'裂':12,'覚':12,'診':12,'詞':12,'軸':12,'遂':12,'閑':12,'雲':12,'項':12,'順':12,'須':12,'飯':12,'黒':12,
  // 13画
  '福':13,'義':13,'照':13,'意':13,'愛':13,'慈':13,'新':13,'歳':13,'源':13,'滋':13,'瑞':13,'禄':13,'絹':13,'聖':13,'裕':13,'豊':13,'鈴':13,'楓':13,'楠':13,'楽':13,'業':13,'概':13,'準':13,'溜':13,'滑':13,'煌':13,'煙':13,'瑚':13,'睦':13,'稔':13,'稚':13,'群':13,'落':13,'蓮':13,'話':13,'賃':13,'路':13,'農':13,'遠':13,'電':13,'預':13,'園':13,'暇':13,'鼓':13,'鳩':13,'慎':13,'歳':13,'禽':13,'暖':13,'滝':13,'督':13,'稲':13,'経':13,'蓄':13,'解':13,'詩':13,'資':13,'跡':13,'鉄':13,'鉛':13,'隔':13,'頑':13,'鼓':13,
  // 14画
  '誠':14,'徳':14,'像':14,'緑':14,'瑠':14,'寧':14,'察':14,'漢':14,'漠':14,'漫':14,'熊':14,'碩':14,'禎':14,'綺':14,'維':14,'綸':14,'網':14,'菫':14,'蒼':14,'語':14,'誉':14,'豪':14,'輔':14,'酸':14,'銀':14,'関':14,'颯':14,'魁':14,'綾':14,'碧':14,'様':14,'彰':14,'境':14,'態':14,'精':14,'説':14,'読':14,'際':14,'障':14,'静':14,'領':14,'駅':14,'鳴':14,'凜':14,'逢':14,'槙':14,'髪':14,
  // 15画
  '養':15,'賢':15,'輝':15,'確':15,'緒':15,'縁':15,'諒':15,'諫':15,'遵':15,'震':15,'億':15,'審':15,'影':15,'徹':15,'慧':15,'毅':15,'潔':15,'潤':15,'熟':15,'箱':15,'緊':15,'線':15,'蝶':15,'諦':15,'踊':15,'遷':15,'銭':15,'穂':15,'澄':15,'凛':15,'課':15,'調':15,'談':15,'論':15,'範':15,'熱':15,'賛':15,'趣':15,'駆':15,
  // 16画
  '橘':16,'憲':16,'穏':16,'縦':16,'融':16,'燈':16,'璃':16,'磨':16,'興':16,'謙':16,'錦':16,'頼':16,'龍':16,'樹':16,'橋':16,'薫':16,'親':16,'積':16,'糖':16,'諸':16,'頭':16,'頻':16,'錯':16,'薬':16,'壁':16,'激':16,'縮':16,
  // 17画
  '優':17,'翼':17,'謡':17,'瞳':17,'穫':17,'縫':17,'總':17,'謹':17,'醒':17,'講':17,'謝':17,'績':17,'環':17,'観':17,'懸':17,
  // 18画
  '藤':18,'織':18,'騎':18,'覇':18,'藍':18,'鎮':18,'顔':18,'題':18,'類':18,'簡':18,'職':18,'難':18,
  // 19画
  '警':19,'鏡':19,'願':19,'麗':19,'羅':19,'識':19,
  // 20画
  '競':20,'議':20,'護':20,'響':20,
  // 19画
  '麗':19,'羅':19,'識':19,'鏡':19,'願':19,
  // 21画
  '露':21,'灘':21,'躍':21,
  // ひらがな
  'あ':3,'い':3,'う':2,'え':2,'お':3,'か':3,'き':3,'く':1,'け':3,'こ':2,
  'さ':3,'し':1,'す':3,'せ':3,'そ':2,'た':4,'ち':3,'つ':3,'て':2,'と':2,
  'な':4,'に':3,'ぬ':4,'ね':4,'の':1,'は':4,'ひ':3,'ふ':3,'へ':1,'ほ':4,
  'ま':3,'み':2,'む':3,'め':2,'も':3,'や':3,'ゆ':2,'よ':3,
  'ら':2,'り':2,'る':2,'れ':2,'ろ':3,'わ':2,'ゐ':3,'ゑ':2,'を':3,'ん':2,
  'が':3,'ぎ':3,'ぐ':1,'げ':3,'ご':2,'ざ':3,'じ':1,'ず':3,'ぜ':3,'ぞ':2,
  'だ':4,'ぢ':3,'づ':3,'で':2,'ど':2,'ば':4,'び':3,'ぶ':3,'べ':1,'ぼ':4,
  'ぱ':4,'ぴ':3,'ぷ':3,'ぺ':1,'ぽ':4,
  // カタカナ
  'ア':2,'イ':2,'ウ':3,'エ':2,'オ':3,'カ':2,'キ':3,'ク':2,'ケ':3,'コ':2,
  'サ':3,'シ':3,'ス':2,'セ':3,'ソ':2,'タ':3,'チ':3,'ツ':3,'テ':3,'ト':2,
  'ナ':2,'ニ':2,'ヌ':2,'ネ':4,'ノ':1,'ハ':2,'ヒ':2,'フ':1,'ヘ':1,'ホ':4,
  'マ':2,'ミ':3,'ム':2,'メ':2,'モ':3,'ヤ':2,'ユ':2,'ヨ':3,
  'ラ':2,'リ':2,'ル':2,'レ':2,'ロ':3,'ワ':2,'ヲ':3,'ン':2,
};

function strokes(ch){
  return KK[ch] || 3; // 不明な場合は3画とみなす
}

// ══════════════════════════════════════════════════════
// 五格計算
// ══════════════════════════════════════════════════════
function calcGogaku(sei, mei){
  const sArr=[...sei], mArr=[...mei];
  const sSum=sArr.reduce((a,c)=>a+strokes(c),0);
  const mSum=mArr.reduce((a,c)=>a+strokes(c),0);

  const tenkaku = sSum;
  const jinkaku = strokes(sArr[sArr.length-1]) + strokes(mArr[0]);
  const chikaku = mSum;
  const soukaku = sSum + mSum;
  const gaikaku = soukaku - jinkaku + (sArr.length===1 ? 1 : 0) + (mArr.length===1 ? 1 : 0);

  return {tenkaku, jinkaku, chikaku, gaikaku, soukaku};
}

// ══════════════════════════════════════════════════════
// 五格 解釈
// ══════════════════════════════════════════════════════
function kichi(n){
  const daikichi=new Set([1,3,5,6,7,8,11,13,15,16,17,21,23,24,25,29,31,32,33,35,37,38,39,41,45,47,48,52,57,58,63,65,67,68,69,73,81]);
  const kyo     =new Set([2,4,9,10,12,14,19,20,22,26,28,34,36,40,44,46,50,53,54,55,56,59,60,62,64,66,72,74,75,76,78,79,80]);
  const n0=n<=0 ? 1 : ((n-1)%80)+1;
  const r=daikichi.has(n0)?'daikichi':kyo.has(n0)?'kyo':'chu';
  console.log('kichi(',n,')→ n0=',n0,'→',r);
  return r;
}

const GOGAKU_MSG={
  tenkaku:{
    name:'天格',ruby:'てんかく',
    desc:'姓の画数から成る格。先祖から受け継いだ運命的な土台を示します。自分では変えられない宿命的な運を表し、人生全体に影響します。'
  },
  jinkaku:{
    name:'人格',ruby:'じんかく',
    desc:'姓の最後の字と名の最初の字の画数の合計。最も重要な格で、性格・意志・能力・対人関係など人生の中核を表します。'
  },
  chikaku:{
    name:'地格',ruby:'ちかく',
    desc:'名の画数から成る格。幼少期から青年期にかけての運勢や才能、内面の気質を示します。その人の素質と成長力を表します。'
  },
  gaikaku:{
    name:'外格',ruby:'がいかく',
    desc:'対外的な運・社会での運勢を示す格。他者との関係、社会的な評価、環境や人縁に関わる運命を表します。'
  },
  soukaku:{
    name:'総格',ruby:'そうかく',
    desc:'全画数の合計。人生の総合的な運勢・晩年の運を示す最も重要な格のひとつです。人生全体の傾向と終盤の幸運を示します。'
  }
};

function numMsg(n){
  const msgs={
    1:'リーダーシップと独立心に恵まれた数。物事を切り開く力があり、強い意志で道を進む。孤独になりがちだが、一本の道を貫く力を持つ。',
    2:'協調性と感受性が豊かな数。人と人をつなぐ橋渡し的存在。繊細な心を持ち、パートナーシップや支援の才能に恵まれる。',
    3:'創造力と表現力に満ちた数。コミュニケーション能力が高く、芸術・文芸・話術で才能を発揮する。明るく社交的な星の下に生まれた数。',
    4:'安定と勤勉さを示す数。堅実な努力家で、基盤を作る力がある。苦労を伴いやすいが、着実な積み重ねが実を結ぶ。',
    5:'自由と変化を愛する数。好奇心旺盛で多才。冒険心があり変化に富んだ人生を歩む。適応力が高く、新しい分野で才能を発揮する。',
    6:'責任感と愛情深さが魅力の数。家庭・仕事において信頼される存在。調和を大切にし、周囲の人々を守り支える力を持つ。',
    7:'内省と探求を示す数。知的で分析力に優れ、真理を追い求める。精神的な深みがあり、独自の世界観を持つ。',
    8:'実行力と目標達成の数。物質的な成功と権力を引き寄せる力がある。強い意志と組織力で大きな夢を現実にする。',
    9:'完成と普遍性を示す数。広い心で人類に貢献する使命を持つ。感受性が豊かで芸術・奉仕の分野で力を発揮する。',
    10:'一度ゼロに戻す数。試練を経て再生する力を持ち、変化の中に真の成長がある。浮き沈みを乗り越え開花する運命。',
    11:'直感と霊感に優れた数。精神的なインスピレーションをもたらし、理想を追い続けるビジョナリーの素質を持つ。',
    12:'不安定だが可能性を秘めた数。苦労を通じて知恵を磨く。支援を得て才能が開花するタイプ。',
    13:'才能と変化の数。創造性が高く、多方面に才能を発揮するが、集中が課題。エネルギーを一点に集めると大きな成果が生まれる。',
    14:'変動と波乱を示す数。困難に直面しやすいが、それを乗り越える力も持つ。試練が人を磨く典型的な数。',
    15:'人望と幸福の数。人を惹きつけるカリスマと優しさがあり、周囲から慕われる。安定した幸福を引き寄せる吉数。',
    16:'強い意志と成功の数。指導力と先見性を持ち、困難を乗り越えて頂点へ向かう。苦労があっても最後は成功する。',
    17:'積極性と意志の強さを示す数。自分の信念を貫く力がある。リーダーとして活躍し、独立心が強く道を切り開く。',
    18:'発展と強運の数。強い生命力と活動力を持ち、積極的に事に当たることで大きな成果を得る。',
    19:'障害と波乱を示す数。高い志を持つが逆境が続きやすい。精神的な強さで苦難を乗り越えることが人生の課題となる。',
    20:'困難と苦労の数。努力が報われにくい暗示があるが、精神的な成長が期待できる。慎重な判断が吉。',
    21:'独立と成功の数。強い個性とリーダーシップで自力で道を切り開く。中年期以降に大きな飛躍が期待できる吉数。',
    22:'苦労が多い数。志は高いが達成が困難なことが多い。精神の鍛錬と忍耐が求められる。',
    23:'武勇と才能の数。先駆者精神があり、活動的に道を切り開く力がある。向上心が強く自己実現への意欲が高い。',
    24:'財運と幸福の数。穏やかな幸福と物質的な豊かさを示す。人の助けを借りながら安定した人生を歩む。',
    25:'独創性と成功の数。個性的な発想で独自の分野を切り開く。時に孤独だが、才能が認められ成功する。',
    26:'波乱と英雄の数。激しい浮き沈みを伴うが、困難を乗り越えることで英雄的な存在になれる。強い精神力が求められる。',
    27:'独立と博識の数。知識欲が旺盛で学問や専門分野で才能を発揮する。孤高の存在になりやすいが、深い知恵が宝となる。',
    28:'波乱万丈の数。才能がありながら環境や対人関係で苦労しやすい。精神的な強さと忍耐が求められる。',
    29:'成功と財運の数。指導力と機転があり、多くの人を引き付ける魅力がある。努力が実を結ぶ吉数。',
    30:'吉凶相半ばする数。博才多芸だが成功と失敗の波がある。大きな夢を持ちながら波乱の人生を歩む傾向。',
    31:'人望と成功の数。人望が厚く多くの協力を得て成功する。リーダーとして周囲を引っ張る才能がある。',
    32:'幸運と人縁の数。人に恵まれ、他者の助けで運が開ける。社交的で好かれる人物になる暗示がある。',
    33:'指導力と波乱の数。カリスマ的な指導者の素質があるが、その分波乱も多い。強い意志で目標を達成する。',
    34:'破壊と苦労の数。努力が実らず苦難に見舞われやすい。精神的な安定と慎重な行動が重要。',
    35:'温和と才能の数。芸術・文化方面の才能があり、穏やかな幸福を得る。学問や技術分野で成功する。',
    36:'英雄と苦難の数。正義感が強く人のために動くが、そのため苦労が多い。強い精神力で困難を乗り越える。',
    37:'意志と成功の数。強い意志と積極性で道を切り開く。自分の才能を信じて突き進むことで成功をつかむ。',
    38:'文武両道の数。才能と行動力を兼ね備え、様々な分野で活躍できる。ただし分散しやすいのが課題。',
    39:'才能と名誉の数。高い才能と強運を持ち、社会的な地位や名誉を得る可能性がある吉数。',
    40:'不安定と孤独の数。才能はあるが孤独になりやすく、努力が実りにくい面がある。精神的な強さが鍵。',
    41:'大成と強運の数。努力が確実に実り、大きな成功を掴む強運の数。人望と財運を兼ね備えた吉数。',
    42:'苦労と病弱の数。身体的・精神的な苦労を伴いやすい。健康に気をつけながら着実に歩むことが大切。',
    43:'才能と散漫の数。多才だが集中力が続かず、才能を活かしきれない場合がある。一つのことに集中することが吉。',
    44:'苦難の数。多くの困難に直面しやすく、苦労が続く傾向がある。強い精神力で乗り越えることが課題。',
    45:'大成と知恵の数。深い知恵と広い視野で大きな成功を収める。指導者として社会に貢献できる吉数。',
    46:'波乱と苦難の数。人生に変化が多く苦労を伴いやすい。精神的な安定と忍耐強さが求められる。',
    47:'成功と幸運の数。努力が確実に報われ、人生の後半に大きな幸運が訪れる。継続する力が吉を呼ぶ。',
    48:'名声と財運の数。才能と努力で名声と財運を得る可能性がある。社会的な評価が高まる吉数。',
    49:'浮き沈みの数。成功と失敗の波が激しく、常に変化にさらされる。柔軟な対応力が重要。',
    50:'浮沈相半ばする数。高い理想を持つが達成が難しく、波乱が続く傾向。精神的な強さが鍵。',
    51:'成功と障害の数。才能はあるが途中で障害に遭いやすい。粘り強く取り組むことで最終的に成功する。',
    52:'成功と発展の数。積極的な行動力で運を切り開く。チャンスを逃さない機敏さが成功の鍵。',
    53:'動乱と苦労の数。環境の変化が激しく苦労が多い。しかし苦難が人を磨き、深みのある人格を育てる。',
    54:'苦難と病弱の数。健康面や精神面での苦労を伴いやすい。養生と精神修養が重要。',
    55:'浮き沈みの数。成功と失敗の繰り返しが多い。大きな成果を上げながらも失うこともある波乱の数。',
    56:'苦労と意志の数。苦難が多いが、それが精神的な成長につながる。強い意志で乗り越えることが大切。',
    57:'努力と成功の数。努力が実を結び、晩年に向けて運が開ける。コツコツとした積み重ねが吉。',
    58:'晩年開花の数。前半は苦労が多いが後半から運が好転し、晩年に幸福が訪れる。',
    59:'不安定の数。才能はあるが精神的な不安定さが課題。安定した環境を整えることが重要。',
    60:'苦難と変化の数。環境や立場が変わりやすく、苦労が続く傾向がある。柔軟な思考と適応力が鍵。',
    61:'名声と成功の数。人望と才能で社会的な名声を得る。信念を持って取り組むことで大きな成功を手にする。',
    62:'苦難の数。努力が報われにくく、孤独になりやすい。精神的な充実を大切にすることが重要。',
    63:'幸福と発展の数。穏やかな幸福と安定した発展を示す。人間関係に恵まれ、豊かな人生を歩む。',
    64:'苦難と障害の数。多くの障害に直面しやすい。諦めずに取り組む精神力が運を切り開く。',
    65:'長寿と幸福の数。安定した幸福と長寿を示す吉数。努力が確実に実り、豊かな老後が期待できる。',
    66:'苦労と発展の数。苦労を経て成長し、後半に向けて運が開ける。粘り強さが成功を呼ぶ。',
    67:'成功と幸運の数。才能と運に恵まれ、着実に成功への道を歩む。周囲の協力も得やすい。',
    68:'発展と財運の数。積極性と才能で財運を引き寄せる。努力が確実に成果として現れる吉数。',
    69:'苦難と変動の数。状況の変化が激しく精神的な苦労が多い。内面の強さで乗り越えることが課題。',
    70:'空虚と苦難の数。空虚さを感じやすく、努力が空回りしやすい。精神的な充実を求めることが重要。',
    71:'成功への努力の数。才能はあるが努力が必要。継続的な取り組みが最終的な成功につながる。',
    72:'苦難と障害の数。苦難に見舞われやすいが、それを乗り越える中で真の強さが生まれる。',
    73:'独立と成功の数。個性的な才能で独自の分野で成功する。自分の道を信じて突き進むことが吉。',
    74:'苦労と不安の数。精神的な不安や苦労を伴いやすい。心の安定を保つことが重要。',
    75:'安定と成功の数。着実な努力で安定した成功を手にする。焦らず地道に歩むことが吉。',
    76:'苦難の数。様々な困難が重なりやすい。周囲のサポートを大切にしながら乗り越えることが鍵。',
    77:'独立と意志の数。強い意志と独立心で道を切り開く。孤高だが確固たる信念が運を開く。',
    78:'発展と成功の数。才能と行動力で着実に発展し、多くの人から評価される。',
    79:'苦難と試練の数。多くの試練に見舞われるが、乗り越えることで大きく成長する。',
    80:'空虚と変化の数。状況の変化が多く、安定を求めながらも変化の中にある数。精神の安定が重要。',
    81:'完成と再生の数。1に戻る完成の数。大きな成功を収めた後、新たなサイクルが始まる特別な数。',
  };
  const n0=((n-1)%80)+1;
  return msgs[n0] || msgs[n0] || '独自の運命を歩む特別な数です。';
}

// ══════════════════════════════════════════════════════
// アニメーション制御
// ══════════════════════════════════════════════════════
let _animRunning=false;
let _animResult=null;
let _skipFlag=false;

function startSeimei(){
  const sei=document.getElementById('inputSei').value.trim();
  const mei=document.getElementById('inputMei').value.trim();
  if(!sei||!mei){alert('姓と名を両方入力してください');return;}

  _animResult={sei, mei, gogaku: calcGogaku(sei,mei)};
  _skipFlag=false;

  // 名前を半紙に配置
  const nd=document.getElementById('nameDisplay');
  nd.innerHTML='';
  const fullName=[...sei,...mei];
  fullName.forEach((ch,i)=>{
    if(i===sei.length){
      const sp=document.createElement('span');
      sp.className='name-space';
      nd.appendChild(sp);
    }
    const s=document.createElement('span');
    s.className='name-char';
    s.textContent=ch;
    s.id='nc'+i;
    nd.appendChild(s);
  });

  document.getElementById('resultSection').style.display='none';
  document.getElementById('animOverlay').classList.add('on');
  document.getElementById('animDoneMsg').classList.remove('on');
  document.getElementById('viewResultBtn').classList.remove('on');
  resetFrame();

  setTimeout(()=>runAnim(fullName, sei.length), 300);
}

function resetFrame(){
  ['fTop','fBot','fLeft','fRight'].forEach(id=>{
    const el=document.getElementById(id);
    el.classList.remove('show-h','show-v');
    el.style.width=''; el.style.height='';
  });
  ['fcTL','fcTR','fcBL','fcBR'].forEach(id=>{
    document.getElementById(id).style.opacity='0';
  });
}

async function runAnim(chars, seiLen){
  _animRunning=true;
  const brush=document.getElementById('brushCursor');
  brush.style.opacity='1';

  for(let i=0;i<chars.length;i++){
    if(_skipFlag) break;
    const el=document.getElementById('nc'+i);
    if(!el) continue;

    // 筆カーソルを文字の左上へ移動
    const rect=el.getBoundingClientRect();
    const paperRect=document.getElementById('washiPaper').getBoundingClientRect();
    brush.style.left=(rect.left-paperRect.left+rect.width*.15)+'px';
    brush.style.top=(rect.top-paperRect.top)+'px';
    brush.style.transition='left .1s,top .1s';

    // clip-path reveal 開始
    el.classList.add('revealed');

    // アニメーション中（1.1s）にブラシを下へ追従
    const revealStart=performance.now();
    await new Promise(resolve=>{
      function trackBrush(){
        const elapsed=performance.now()-revealStart;
        const t=Math.min(1, elapsed/1100);
        const r=el.getBoundingClientRect();
        const pr=document.getElementById('washiPaper').getBoundingClientRect();
        brush.style.top=(r.top-pr.top + t*r.height*1.1)+'px';
        if(t<1 && !_skipFlag) requestAnimationFrame(trackBrush);
        else resolve();
      }
      requestAnimationFrame(trackBrush);
    });

    await sleep(80);
  }

  brush.style.opacity='0';
  if(_skipFlag){finishAnim();return;}

  await sleep(400);
  if(_skipFlag){finishAnim();return;}

  // 額縁
  await animFrame();
  if(_skipFlag){finishAnim();return;}

  // スパークル
  startSparkle();
  await sleep(1800);
  stopSparkle();

  finishAnim();
}

function finishAnim(){
  _animRunning=false;
  document.getElementById('brushCursor').style.opacity='0';
  showFrameInstant();
  document.getElementById('animDoneMsg').classList.add('on');
  document.getElementById('viewResultBtn').classList.add('on');
}

async function animFrame(){
  const paper=document.getElementById('washiPaper');
  const w=paper.offsetWidth, h=paper.offsetHeight;

  const fTop=document.getElementById('fTop');
  const fBot=document.getElementById('fBot');
  const fLeft=document.getElementById('fLeft');
  const fRight=document.getElementById('fRight');

  fTop.style.transition='width .4s ease-out';
  fBot.style.transition='width .4s ease-out';
  fLeft.style.transition='height .4s ease-out';
  fRight.style.transition='height .4s ease-out';

  fTop.style.width=(w+12)+'px';
  fBot.style.width=(w+12)+'px';
  await sleep(200);
  fLeft.style.height=(h+12)+'px';
  fRight.style.height=(h+12)+'px';
  await sleep(450);

  ['fcTL','fcTR','fcBL','fcBR'].forEach(id=>{
    document.getElementById(id).style.opacity='1';
  });
  await sleep(200);
}

function showFrameInstant(){
  const paper=document.getElementById('washiPaper');
  const w=paper.offsetWidth, h=paper.offsetHeight;
  const fTop=document.getElementById('fTop');
  const fBot=document.getElementById('fBot');
  const fLeft=document.getElementById('fLeft');
  const fRight=document.getElementById('fRight');
  fTop.style.transition='none'; fTop.style.width=(w+12)+'px';
  fBot.style.transition='none'; fBot.style.width=(w+12)+'px';
  fLeft.style.transition='none'; fLeft.style.height=(h+12)+'px';
  fRight.style.transition='none'; fRight.style.height=(h+12)+'px';
  ['fcTL','fcTR','fcBL','fcBR'].forEach(id=>{
    document.getElementById(id).style.opacity='1';
  });
}

function skipAnim(){
  _skipFlag=true;
  document.getElementById('brushCursor').style.opacity='0';
  document.querySelectorAll('.name-char').forEach(el=>{
    el.style.animation='none';
    el.style.opacity='1';
    el.style.clipPath='none';
  });
  stopSparkle();
  finishAnim();
}

function showResult(){
  document.getElementById('animOverlay').classList.remove('on');
  stopSparkle();
  renderResult(_animResult);
  const rs=document.getElementById('resultSection');
  rs.style.display='block';
  setTimeout(()=>rs.scrollIntoView({behavior:'smooth',block:'start'}),80);
}

function resetForm(){
  document.getElementById('resultSection').style.display='none';
  document.getElementById('inputSei').value='';
  document.getElementById('inputMei').value='';
  window.scrollTo({top:0,behavior:'smooth'});
}

function sleep(ms){return new Promise(r=>setTimeout(r,ms));}

// ══════════════════════════════════════════════════════
// スパークル
// ══════════════════════════════════════════════════════
const sparkCv=document.getElementById('sparkCv');
const sparkCtx=sparkCv.getContext('2d');
let _sparkAF=null;
let _particles=[];

function startSparkle(){
  sparkCv.width=window.innerWidth;
  sparkCv.height=window.innerHeight;
  const paper=document.getElementById('washiPaper');
  const rect=paper.getBoundingClientRect();
  const cx=rect.left+rect.width/2, cy=rect.top+rect.height/2;

  function addParticles(){
    for(let i=0;i<6;i++){
      const angle=Math.random()*Math.PI*2;
      const speed=1+Math.random()*3;
      _particles.push({
        x:cx+(Math.random()-.5)*rect.width*.8,
        y:cy+(Math.random()-.5)*rect.height*.8,
        vx:Math.cos(angle)*speed,
        vy:Math.sin(angle)*speed-2,
        life:1,decay:.012+Math.random()*.01,
        size:2+Math.random()*4,
        color:`hsl(${40+Math.random()*30},90%,${60+Math.random()*20}%)`
      });
    }
  }

  let frameCount=0;
  function loop(){
    sparkCtx.clearRect(0,0,sparkCv.width,sparkCv.height);
    if(frameCount%3===0) addParticles();
    frameCount++;
    _particles=_particles.filter(p=>{
      p.x+=p.vx; p.y+=p.vy; p.vy+=0.08; p.life-=p.decay;
      if(p.life<=0) return false;
      sparkCtx.save();
      sparkCtx.globalAlpha=p.life;
      sparkCtx.fillStyle=p.color;
      sparkCtx.shadowColor=p.color;
      sparkCtx.shadowBlur=8;
      sparkCtx.beginPath();
      sparkCtx.arc(p.x,p.y,p.size*p.life,0,Math.PI*2);
      sparkCtx.fill();
      sparkCtx.restore();
      return true;
    });
    _sparkAF=requestAnimationFrame(loop);
  }
  loop();
}

function stopSparkle(){
  if(_sparkAF) cancelAnimationFrame(_sparkAF);
  sparkCtx.clearRect(0,0,sparkCv.width,sparkCv.height);
  _particles=[];
}

// ══════════════════════════════════════════════════════
// 結果表示
// ══════════════════════════════════════════════════════
function renderResult({sei, mei, gogaku}){
  document.getElementById('resultNameDisplay').innerHTML=
    sei+' '+mei+'<small>の鑑定結果</small>';

  const {tenkaku,jinkaku,chikaku,gaikaku,soukaku}=gogaku;

  // 総合評価
  const jk=kichi(soukaku);
  const jkLabel=jk==='daikichi'?'大吉':jk==='kyo'?'凶':'吉';
  const jkClass=jk==='daikichi'?'kichi-dai':jk==='kyo'?'kichi-kyo':'kichi-chu';
  document.getElementById('overallCard').innerHTML=`
    <div class="overall-label">✦ 総合運 ✦</div>
    <div class="overall-title">${sei} ${mei}さんの運命数は <span style="color:var(--gold-lt)">${soukaku}</span></div>
    <span class="gogaku-kichi ${jkClass}" style="font-size:.75rem;margin-bottom:.8rem">${jkLabel}</span>
    <div class="overall-desc">${numMsg(soukaku)}</div>
  `;

  // 五格カード
  const grids=[
    {key:'tenkaku', val:tenkaku, cls:'tenkaku'},
    {key:'jinkaku', val:jinkaku, cls:'jinkaku'},
    {key:'chikaku', val:chikaku, cls:'chikaku'},
    {key:'gaikaku', val:gaikaku, cls:'gaikaku'},
    {key:'soukaku', val:soukaku, cls:'soukaku'},
  ];
  document.getElementById('gogakuGrid').innerHTML=grids.map(g=>{
    const info=GOGAKU_MSG[g.key];
    const jk=kichi(g.val);
    const jkLabel=jk==='daikichi'?'大吉':jk==='kyo'?'凶':'吉';
    const jkClass=jk==='daikichi'?'kichi-dai':jk==='kyo'?'kichi-kyo':'kichi-chu';
    return `<div class="gogaku-card ${g.cls}">
      <div class="gogaku-label">${info.name}（${info.ruby}）</div>
      <div class="gogaku-num">${g.val}</div>
      <span class="gogaku-kichi ${jkClass}">${jkLabel}</span>
      <div class="gogaku-title">${numMsg(g.val).split('。')[0]}。</div>
      <div class="gogaku-desc">${info.desc}</div>
    </div>`;
  }).join('');
}
</script>
</body>
</html>
