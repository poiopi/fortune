<?php declare(strict_types=1); ?>
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
<link rel="canonical" href="https://life-fun.net/tarot" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="22枚の大アルカナが円形に並ぶ本格タロット占い。直感でカードを選び、恋愛・仕事・運勢へのメッセージを無料で受け取ってください。">
<title>本格タロット占い｜大アルカナ22枚で運命を読む</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#060410;--deep:#0a0818;--surface:#120f24;--card-bg:#1a1535;
  --border:rgba(160,130,220,.15);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8d48a;--gold-dk:#8b6914;
  --violet:#7a4a9e;--violet-lt:#b088e0;--rose:#c85080;--teal:#3ab8b0;
  --text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh;overflow-x:hidden}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0}
.wrap{position:relative;z-index:1;max-width:860px;margin:0 auto;padding:0 1rem}

/* ══ HEADER ══ */
.site-header{position:sticky;top:0;z-index:200;background:rgba(6,4,16,.94);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
.header-inner{max-width:960px;margin:0 auto;padding:0 1.4rem;display:flex;align-items:center;justify-content:space-between;height:56px;gap:1rem}
.logo{font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;color:var(--text);text-decoration:none;display:flex;align-items:center;gap:.5rem;letter-spacing:.06em;white-space:nowrap}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;align-items:center;gap:1.6rem}
.header-nav a{font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);text-decoration:none;letter-spacing:.1em;white-space:nowrap;position:relative;padding-bottom:2px;transition:color .2s}
.header-nav a::after{content:'';position:absolute;bottom:0;left:0;right:0;height:1px;background:var(--gold);transform:scaleX(0);transition:transform .2s}
.header-nav a:hover{color:var(--gold-lt)}
.header-nav a:hover::after{transform:scaleX(1)}
.header-nav a.cur{color:var(--gold);pointer-events:none}
.header-nav a.cur::after{transform:scaleX(1)}
.header-gold-line{height:2px;background:linear-gradient(90deg,transparent 0%,rgba(201,168,76,.6) 30%,rgba(201,168,76,1) 50%,rgba(201,168,76,.6) 70%,transparent 100%)}
.sp-menu-btn{display:none;background:none;border:1px solid var(--border2);border-radius:6px;color:var(--muted);font-family:var(--ff-mono);font-size:.72rem;padding:.3rem .75rem;cursor:pointer;letter-spacing:.08em}
.sp-dropdown{display:none;position:fixed;top:58px;left:0;right:0;background:rgba(6,4,16,.97);border-bottom:1px solid var(--border2);z-index:199;backdrop-filter:blur(16px)}
.sp-dropdown.open{display:block}
.sp-dropdown a{display:block;padding:.85rem 1.4rem;font-family:var(--ff-mono);font-size:.78rem;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
.sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.05)}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.35rem}
}

/* ══ HERO ══ */
.hero{text-align:center;padding:2.5rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.28em;color:var(--gold);text-transform:uppercase;margin-bottom:.8rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.7rem,5vw,2.6rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--rose) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{color:var(--muted);font-size:.88rem;letter-spacing:.04em}

/* ══ 説明文 ══ */
.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem;margin-bottom:1.5rem}
.tool-desc p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.tool-desc p:last-child{margin-bottom:0}

/* ══ AdSense ══ */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}

/* ══ カード選択ステージ ══ */
.stage{display:none;flex-direction:column;align-items:center;padding:1rem 0 2rem}
.stage.active{display:flex}
.instruction{text-align:center;margin-bottom:1rem}
.instruction p{color:var(--muted);font-size:.88rem;line-height:1.8}
.hint{display:inline-block;margin-top:.6rem;font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.12em;color:var(--violet-lt);border:1px solid rgba(155,114,239,.3);padding:.25rem .9rem;border-radius:20px}

/* ── シャッフルボタン ── */
.shuffle-btn{
  margin:.9rem 0 1.2rem;
  padding:.65rem 2rem;
  background:transparent;
  border:1px solid rgba(201,168,76,.4);border-radius:28px;
  color:var(--gold-lt);
  font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.14em;
  cursor:pointer;
  display:flex;align-items:center;gap:.5rem;
  transition:border-color .2s,background .2s,transform .15s;
}
.shuffle-btn:hover{border-color:var(--gold);background:rgba(201,168,76,.08);transform:translateY(-1px)}
.shuffle-btn .s-icon{display:inline-block}

/* ══ 円形エリア（22枚対応） ══ */
.circle-area{position:relative;width:min(620px,94vw);height:min(620px,94vw);margin:0 auto}

/* 個別カード */
.tcard{position:absolute;width:56px;height:89px;transform-origin:center center;cursor:pointer;transition:filter .25s,transform .25s;margin-left:-28px;margin-top:-44px}
@media(max-width:480px){.tcard{width:38px;height:60px;margin-left:-19px;margin-top:-30px}}
.tcard:hover .tcard-back{box-shadow:0 0 18px rgba(155,114,239,.7);border-color:var(--violet-lt)}
.tcard.dimmed{opacity:.2;pointer-events:none;transition:opacity .5s}
.tcard-inner{width:100%;height:100%;position:relative;transform-style:preserve-3d;transition:transform .0s}
.tcard-face{position:absolute;inset:0;border-radius:6px;backface-visibility:hidden;-webkit-backface-visibility:hidden;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px}
.tcard-back{background:linear-gradient(160deg,#1a1040,#0d082a);border:1.5px solid rgba(155,114,239,.4);box-shadow:0 4px 16px rgba(0,0,0,.5)}
.tcard-back-icon{font-size:1.2rem;opacity:.5}
@media(max-width:480px){.tcard-back-icon{font-size:.85rem}}
.tcard-back-line{width:55%;height:1px;background:rgba(155,114,239,.3)}
.tcard-front{transform:rotateY(180deg);background:linear-gradient(170deg,#1e0e42,#0d051f);border:1.5px solid var(--gold);box-shadow:0 0 16px rgba(201,168,76,.35);padding:4px 2px 3px;justify-content:space-between;overflow:hidden}
.tcard-front::before,.tcard-front::after{content:'';position:absolute;width:5px;height:5px;border:1px solid rgba(201,168,76,.65)}
.tcard-front::before{top:2px;left:2px;border-right:none;border-bottom:none}
.tcard-front::after{bottom:2px;right:2px;border-left:none;border-top:none}
.tcard-front-num{font-family:var(--ff-mono);font-size:.3rem;color:rgba(201,168,76,.7);line-height:1;flex-shrink:0}
.tcard-front-img{flex:1;display:flex;align-items:center;justify-content:center;width:100%;min-height:0;padding:2px 0}
.tcard-front-img img{max-width:80%;max-height:100%;object-fit:contain}
.tcard-front-name{
  font-family:var(--ff-serif);font-size:.36rem;font-weight:700;
  color:var(--gold-lt);text-align:center;line-height:1.15;
  width:100%;padding:0 1px;
  overflow:hidden;
  /* 長い名前は自動的に縮小 */
  word-break:break-all;
  flex-shrink:0;
}

/* ══ オーバーレイ ══ */
.overlay{display:none;position:fixed;inset:0;background:rgba(5,3,15,.88);z-index:200;align-items:center;justify-content:center;flex-direction:column;padding:1.5rem}
.overlay.active{display:flex}
.big-card-wrap{width:160px;perspective:1000px;margin-bottom:1.5rem;flex-shrink:0}
@media(max-width:480px){.big-card-wrap{width:120px}}
.big-card-inner{width:100%;padding-bottom:158%;position:relative;transform-style:preserve-3d}
.big-card-face{position:absolute;inset:0;border-radius:14px;backface-visibility:hidden;-webkit-backface-visibility:hidden;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;padding:10px 6px;overflow:hidden}
.big-back{background:linear-gradient(160deg,#1a1040,#0d082a);border:2px solid rgba(155,114,239,.4)}
.big-back-icon{font-size:3rem;opacity:.5}
@media(max-width:480px){.big-back-icon{font-size:2rem}}
.big-front{transform:rotateY(180deg);background:linear-gradient(170deg,#1e0e42,#0d051f);border:2px solid var(--gold);box-shadow:0 0 40px rgba(201,168,76,.5),0 0 80px rgba(155,114,239,.25);justify-content:flex-start;gap:4px;padding:10px 6px}
.big-front::before,.big-front::after{content:'';position:absolute;width:10px;height:10px;border:1.5px solid rgba(201,168,76,.7)}
.big-front::before{top:5px;left:5px;border-right:none;border-bottom:none}
.big-front::after{bottom:5px;right:5px;border-left:none;border-top:none}
.big-img{flex:1;display:flex;align-items:center;justify-content:center;width:100%;min-height:0}
.big-img img{max-width:80%;max-height:100%;object-fit:contain}
.big-num{font-family:var(--ff-mono);font-size:.65rem;color:rgba(201,168,76,.8);letter-spacing:.1em;flex-shrink:0}
/* カード名・英語名はカードの外に出す */
.big-card-info{display:flex;flex-direction:column;align-items:center;gap:.15rem;margin-bottom:.3rem;opacity:0;transition:opacity .4s .2s}
.big-card-info.visible{opacity:1}
.big-name{font-family:var(--ff-serif);font-size:clamp(.95rem,4vw,1.3rem);font-weight:700;color:var(--gold-lt);text-align:center;line-height:1.2}
.big-en{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);letter-spacing:.1em}
.big-dir{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.06em;padding:.22rem .9rem;border-radius:4px;margin-top:.6rem;display:none}
.big-dir:not(:empty){display:inline-block}
.dir-up{background:rgba(58,184,176,.15);color:var(--teal);border:1px solid rgba(58,184,176,.3)}
.dir-rev{background:rgba(200,80,128,.15);color:var(--rose);border:1px solid rgba(200,80,128,.3)}
.overlay-msg{font-family:var(--ff-serif);font-size:1rem;color:var(--gold-lt);text-align:center;letter-spacing:.06em}
.overlay-sub{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);margin-top:.4rem;text-align:center}

/* ══ 結果 ══ */
.result-section{display:none;padding-bottom:4rem}
.result-header{text-align:center;padding:1.5rem 0;border-bottom:1px solid var(--border);margin-bottom:1.8rem}
.chosen-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.8rem}
.chosen-card-wrap{display:inline-flex;flex-direction:column;align-items:center;gap:.5rem;margin:.6rem 0}
.chosen-card{width:110px;background:linear-gradient(170deg,#1e0e42,#0d051f);border:2px solid var(--gold);border-radius:10px;padding:.6rem .5rem .7rem;display:flex;flex-direction:column;align-items:center;position:relative;box-shadow:0 0 32px rgba(201,168,76,.45),0 0 64px rgba(155,114,239,.2)}
.chosen-card::before,.chosen-card::after{content:'';position:absolute;width:9px;height:9px;border:1.5px solid rgba(201,168,76,.7)}
.chosen-card::before{top:5px;left:5px;border-right:none;border-bottom:none}
.chosen-card::after{bottom:5px;right:5px;border-left:none;border-top:none}
.chosen-num{font-family:var(--ff-mono);font-size:.55rem;color:rgba(201,168,76,.8);letter-spacing:.12em;margin-bottom:.4rem}
.chosen-img{width:76px;height:76px;display:flex;align-items:center;justify-content:center;margin-bottom:.5rem}
.chosen-img img{max-width:100%;max-height:100%;object-fit:contain}
.chosen-en{font-family:var(--ff-mono);font-size:.5rem;color:rgba(201,168,76,.65);letter-spacing:.14em;text-transform:uppercase;margin-bottom:.25rem}
.chosen-name{font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:var(--gold-lt)}
.chosen-dir{font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.08em;padding:.2rem .8rem;border-radius:4px;margin-top:.1rem}
.result-block{background:var(--card-bg);border:1px solid var(--border);border-radius:14px;padding:1.6rem;margin-bottom:1.2rem;position:relative;overflow:hidden}
.result-block::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet))}
.block-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);margin-bottom:.8rem}
.keyword-row{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:.5rem}
.keyword{font-size:.73rem;font-family:var(--ff-mono);background:rgba(155,114,239,.1);border:1px solid rgba(155,114,239,.2);color:var(--violet-lt);padding:.18rem .65rem;border-radius:20px;letter-spacing:.04em}
.result-message{font-size:.92rem;line-height:2.1;color:var(--text);border-top:1px solid var(--border);padding-top:1rem;margin-top:.5rem}
.rf-retry-btn{display:block;width:100%;padding:.9rem;background:var(--violet);color:#fff;border:none;border-radius:10px;font-family:var(--ff-sans);font-size:.9rem;font-weight:500;cursor:pointer;text-align:center;margin-top:1.5rem;transition:background .2s,transform .15s;letter-spacing:.04em}
.rf-retry-btn:hover{background:#6a3fc2;transform:translateY(-1px)}
.rf-article-link{display:flex;align-items:center;gap:.9rem;background:rgba(122,74,158,.06);border:1px solid rgba(122,74,158,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.rf-article-link:hover{border-color:var(--violet-lt);background:rgba(122,74,158,.12)}
.rf-article-icon{font-size:1.4rem;flex-shrink:0}
.rf-article-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.rf-article-body strong{font-family:var(--ff-sans);font-size:.9rem;font-weight:500;color:var(--violet-lt)}
.rf-article-body small{font-size:.75rem;color:var(--muted)}
.rf-article-arrow{color:var(--violet-lt);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}
.nav-cards-section{padding:2rem 0 0}
.nav-cards-section h3{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:1rem;text-align:center}
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(6,4,16,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
@keyframes fadeIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
.fade-in{animation:fadeIn .6s ease both}
.fade-in-2{animation:fadeIn .6s ease .15s both}
.fade-in-3{animation:fadeIn .6s ease .3s both}
</style>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php require_once __DIR__.'/inc/nav-cards.php'; $tarotNavCards = _nav_cards(3,'tarot'); ?>
</head>
<body>

<?php $currentPage = 'tarot'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">Interactive Tarot Reading</span>
    <h1>本格タロット占い｜大アルカナ22枚で運命を読む</h1>
    <p class="hero-sub">円形に並ぶ22枚の中から、直感で1枚を選んでください</p>
  </section>

  <div class="adsense-space"></div>

  <div class="tool-desc">
    <p>タロット占いは、78枚のカードに描かれたシンボルを通じて、潜在意識や気になる問題の現状、少し先の流れを映し出す占術です。</p>
    <p>このツールでは、大アルカナ22枚すべてを円形に並べ、あなたが選んだカードから今必要なメッセージを導き出します。現在の悩みへの気づきや、選択を迷ったときのヒントとしてお役立てください。</p>
  </div>

  <!-- カード選択ステージ -->
  <div class="stage active" id="stage-select">
    <div class="instruction">
      <p>心を静め、今の悩みや状況を思い浮かべながら<br>引き寄せられるカードを1枚選んでください</p>
      <span class="hint">&#10022; タップ / クリックで選ぶ &#10022;</span>
    </div>
    <button class="shuffle-btn" id="shuffleBtn" onclick="shuffleCards()">
      <span class="s-icon">🔀</span>シャッフル（何度でも）
    </button>
    <div class="circle-area" id="circle-area"></div>
  </div>

  <!-- 結果 -->
  <div class="result-section" id="result-section"></div>

  <!-- 次の診断へ -->
  <div id="tarot-nav-cards" style="display:none">
    <div class="nav-cards-section">
      <h3>✦ 次はこれを試してみては？ ✦</h3>
      <?= $tarotNavCards ?>
    </div>
  </div>
</div>

<!-- オーバーレイ -->
<div class="overlay" id="overlay">
  <div class="big-card-wrap">
    <div class="big-card-inner" id="big-card-inner">
      <div class="big-card-face big-back"><div class="big-back-icon">&#9670;</div></div>
      <div class="big-card-face big-front" id="big-front">
        <div class="big-num" id="big-num"></div>
        <div class="big-img" id="big-img"></div>
      </div>
    </div>
  </div>
  <div class="big-card-info" id="big-card-info">
    <div class="big-name" id="big-name"></div>
    <div class="big-en" id="big-en"></div>
  </div>
  <span class="big-dir" id="big-dir"></span>
  <div class="overlay-msg" id="overlay-msg">カードが語りかけています...</div>
  <div class="overlay-sub" id="overlay-sub"></div>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
const TAROT = [
  {num:'0',   order:0,  name:'愚者',       en:'The Fool',           img:'fool',
   upright:'新しい始まり・純粋さ・冒険・無限の可能性', reversed:'無謀・無責任・現実逃避・準備不足',
   upright_msg:'新たな旅の始まりを告げるカードです。恐れを手放し、純粋な心で一歩を踏み出してください。計算より直感、準備より行動。あなたの前には、想像を超えた可能性が広がっています。今こそ、魂の声に従って動くとき。',
   reversed_msg:'焦りや無謀さが行動を妨げているかもしれません。飛び込む前に少しだけ立ち止まり、状況を整理しましょう。地に足をつけた判断が今のあなたには必要です。'},
  {num:'I',   order:1,  name:'魔術師',     en:'The Magician',       img:'magician',
   upright:'意志の力・スキル・集中・現実化', reversed:'才能の無駄遣い・欺き・優柔不断',
   upright_msg:'あなたには、目標を実現するためのすべてが揃っています。才能・知識・情熱——必要なものはすでに手の中にあります。あとは強い意志で一点に集中するだけ。今のあなたには、思い描いたものを現実に変える力が宿っています。',
   reversed_msg:'持っている才能を活かしきれていないかもしれません。散漫になっているエネルギーを一つのことに集中させることで、状況が大きく動き始めます。'},
  {num:'II',  order:2,  name:'女教皇',     en:'The High Priestess', img:'high-priestess',
   upright:'直感・内なる知恵・神秘・静寂', reversed:'感情の抑圧・秘密・直感の無視',
   upright_msg:'答えはすでにあなたの内側にあります。外の世界より、内なる声に耳を澄ませてください。夢、直感、ふとした閃き——すべてが宇宙からのメッセージです。今は行動より「感じること」を優先する時期です。',
   reversed_msg:'自分の直感を信じることをためらっていませんか？心の奥から聞こえる声を無視せず、正直に向き合ってみてください。'},
  {num:'III', order:3,  name:'女帝',       en:'The Empress',        img:'empress',
   upright:'豊かさ・愛・創造・母性・繁栄', reversed:'依存・創造性の停滞・過保護',
   upright_msg:'豊穣と愛情のエネルギーに満ちています。与えること、育てること、楽しむこと——この三つを大切にすることで、あなたの人生はさらに花開きます。創造的な活動や自然との触れ合いが、今の運気を高めます。',
   reversed_msg:'誰かへの依存や、自分を後回しにしすぎている状況が見受けられます。まず自分自身を大切にすることから始めてください。'},
  {num:'IV',  order:4,  name:'皇帝',       en:'The Emperor',        img:'emperor',
   upright:'権威・安定・秩序・リーダーシップ', reversed:'支配・頑固・感情の抑圧',
   upright_msg:'今こそ、自分の人生における主役として堂々と立つべき時です。ルールを設け、秩序をもたらすことで、周囲からの信頼が集まります。感情より論理、直感より計画。しっかりとした基盤を築くことが吉。',
   reversed_msg:'コントロールへの執着が、柔軟性を奪っているかもしれません。時には流れに身を委ねることも、大切なリーダーシップです。'},
  {num:'V',   order:5,  name:'法王',       en:'The Hierophant',     img:'hierophant',
   upright:'伝統・精神的導き・師との縁・信念', reversed:'既成概念への反発・形式主義・偽善',
   upright_msg:'信頼できる師や先輩との縁が深まる時期です。伝統や慣習の中に、あなたへの重要なヒントが隠れています。学ぶ姿勢を持ち続けることで、精神的な成長が物質的な豊かさをも呼び込みます。',
   reversed_msg:'古いルールや既成概念があなたを縛っているかもしれません。本当に自分が信じることは何か、改めて問い直してみましょう。'},
  {num:'VI',  order:6,  name:'恋人',       en:'The Lovers',         img:'lovers',
   upright:'愛・選択・調和・価値観の一致', reversed:'不一致・選択の困難・価値観の衝突',
   upright_msg:'心から「Yes」と言える選択が、今のあなたに問われています。恋愛だけでなく、仕事や生き方においても「本当に好きなもの」を選ぶ勇気が開運の鍵。魂レベルで「これだ」と感じる方向へ進んでください。',
   reversed_msg:'価値観のズレや、選択への迷いを感じているかもしれません。誰かに合わせすぎず、自分の心が本当に求めるものに正直になってみてください。'},
  {num:'VII', order:7,  name:'戦車',       en:'The Chariot',        img:'chariot',
   upright:'勝利・意志・前進・自制心', reversed:'方向性の欠如・攻撃性・コントロール不能',
   upright_msg:'強い意志と集中力で、目標へと突き進む時です。相反する力をコントロールし、一つの方向へエネルギーを集めてください。障害はあなたを止めるためにあるのではなく、強さを試すためにあります。前進あるのみ。',
   reversed_msg:'方向性が定まらず、エネルギーが分散しているかもしれません。まず「どこへ向かいたいか」を明確にすることが先決です。'},
  {num:'VIII',order:8,  name:'力',         en:'Strength',           img:'strength',
   upright:'内なる強さ・勇気・忍耐・優しさ', reversed:'自信の喪失・弱さ・疑念',
   upright_msg:'真の力は、激しさではなく優しさから生まれます。感情を力で押さえ込むのではなく、愛情を持って向き合うことで、どんな困難も乗り越えられます。あなたの内側には、獅子をも従わせる穏やかな強さが宿っています。',
   reversed_msg:'自信を失いかけているかもしれませんが、それは一時的なものです。弱さを認める勇気こそが、本当の強さへの第一歩です。'},
  {num:'IX',  order:9,  name:'隠者',       en:'The Hermit',         img:'hermit',
   upright:'内省・知恵・孤独・内なる指針', reversed:'孤立・引きこもり・頑固',
   upright_msg:'今は立ち止まり、自分の内側を静かに照らすべき時です。孤独を恐れず、一人の時間を大切にすることで、次のステージへ向けた深い洞察が得られます。答えはすでにあなたの中にあります。静寂の中で耳を澄ませてください。',
   reversed_msg:'孤立が長すぎると、視野が狭まることがあります。信頼できる人に心を開くことで、新しい光が見えてくるでしょう。'},
  {num:'X',   order:10, name:'運命の輪',   en:'Wheel of Fortune',   img:'wheel',
   upright:'転機・サイクル・幸運・変化', reversed:'不運・停滞・変化への抵抗',
   upright_msg:'運命の輪が回り、新たなサイクルの始まりを告げています。変化を恐れず乗りこなすことで、幸運の波があなたを高みへと運びます。今起きていることには必ず宇宙的な意味があります。流れを信頼してください。',
   reversed_msg:'変化への抵抗が、停滞を生んでいるかもしれません。輪は必ず回ります。今の状況は永遠ではありません。'},
  {num:'XI',  order:11, name:'正義',       en:'Justice',            img:'justice',
   upright:'公正・真実・因果・バランス', reversed:'不公平・不誠実・責任逃れ',
   upright_msg:'因果の法則が働いています。正直で公正な行動が、今のあなたに最大の幸運をもたらします。過去の誠実な努力が正当に評価される時期でもあります。迷ったときは「正しいこと」を選ぶ。それだけで道は開けます。',
   reversed_msg:'誰かに対して、あるいは自分自身に対して、不誠実になっていませんか？真実に向き合うことで、停滞が動き始めます。'},
  {num:'XII', order:12, name:'吊られた男', en:'The Hanged Man',     img:'hanged-man',
   upright:'犠牲・新視点・待機・悟り', reversed:'無駄な犠牲・停滞・変化への拒絶',
   upright_msg:'今は行動よりも待機の時。逆さまになることで、まったく新しい視点が得られます。手放すことを恐れないでください。執着を離れた先に、真の豊かさと深い気づきが待っています。この静止の時間には深い意味があります。',
   reversed_msg:'無駄な我慢や、変化への頑固な抵抗が状況を複雑にしているかもしれません。手放すべきものを手放すことで、流れが変わります。'},
  {num:'XIII',order:13, name:'死神',       en:'Death',              img:'death',
   upright:'変容・終わりと始まり・手放し・再生', reversed:'変化への抵抗・停滞・執着',
   upright_msg:'「死神」は終わりではなく、変容と再生の象徴です。古いものが終わりを告げ、新しいものが生まれようとしています。今感じる「終わり」は、次の始まりへの扉。手放す勇気が、あなたの人生に新鮮な息吹をもたらします。',
   reversed_msg:'変化を恐れて、終わるべきものにしがみついていませんか？手放すことへの恐れが、新しい出発を遅らせています。'},
  {num:'XIV', order:14, name:'節制',       en:'Temperance',         img:'temperance',
   upright:'調和・バランス・忍耐・癒し', reversed:'不均衡・過剰・焦り',
   upright_msg:'異なるものをうまく組み合わせることで、奇跡が生まれます。焦らず、じっくりと。時間をかけて物事を育てることで、やがて黄金が生まれます。今のあなたに必要なのは、バランスと忍耐、そして癒しの時間です。',
   reversed_msg:'何かが行き過ぎていませんか？仕事・感情・生活習慣のどこかでバランスが崩れているかもしれません。中庸を取り戻すことが今の課題です。'},
  {num:'XV',  order:15, name:'悪魔',       en:'The Devil',          img:'devil',
   upright:'束縛・執着・物質主義・解放への鍵', reversed:'解放・自由・執着からの脱出',
   upright_msg:'何かがあなたを縛っているように感じていませんか？しかしその鎖は、実は自分でいつでも外せるものです。恐れや欲望、習慣——何があなたを縛っているのかを正直に見つめることが、解放への第一歩です。',
   reversed_msg:'執着や恐れからの解放が近づいています。長い間あなたを縛っていたものから、ようやく自由になれるタイミングです。'},
  {num:'XVI', order:16, name:'塔',         en:'The Tower',          img:'tower',
   upright:'突然の変化・崩壊・解放・真実の露出', reversed:'変化の回避・内なる混乱・崩壊の先延ばし',
   upright_msg:'崩れるべきものが崩れ、本質だけが残ります。一見破壊的に見えるこの変化の中に、長い間必要だった「解放」が隠れています。嵐が過ぎた後の空は、必ず澄み渡っています。変化を恐れず、受け入れてください。',
   reversed_msg:'内側では大きな変化が起きているのに、表面では現状維持しようとしているかもしれません。迫りくる変化に正直に向き合う時です。'},
  {num:'XVII',order:17, name:'星',         en:'The Star',           img:'star',
   upright:'希望・刷新・インスピレーション・信頼', reversed:'希望の喪失・失望・自信のなさ',
   upright_msg:'あなたの前には、確かな可能性の光が灯っています。傷ついた心が癒され、夢を信じる力が戻ってきます。今のあなたの願いは、星の力を借りて現実へと近づいています。希望を手放さないでください。宇宙はあなたの味方です。',
   reversed_msg:'希望を見失いかけているかもしれませんが、星はまだそこにあります。曇り空の向こうにも、光は消えていません。'},
  {num:'XVIII',order:18,name:'月',         en:'The Moon',           img:'moon',
   upright:'幻想・直感・潜在意識・不安', reversed:'混乱の解消・真実の露出・恐れの克服',
   upright_msg:'今は物事がはっきり見えにくい時期かもしれませんが、それはあなたの内なる感性が研ぎ澄まされているサインでもあります。夢や直感を大切にしてください。見えない世界からのメッセージに耳を傾けることで、真実が浮かび上がります。',
   reversed_msg:'霧が晴れ始め、混乱していた状況が明確になってきます。恐れていたことが実は大したことではなかったと気づく時期です。'},
  {num:'XIX', order:19, name:'太陽',       en:'The Sun',            img:'sun',
   upright:'喜び・成功・活力・明るさ・達成', reversed:'一時的な陰り・過信・楽観すぎ',
   upright_msg:'大アルカナ最高の幸運カードがあなたのもとへ届きました！喜びと成功のエネルギーに満ちています。子供のような純粋さで世界と向き合うことで、あらゆる願いが光の速さで実現に向かいます。今のあなたは、太陽のように輝いています。',
   reversed_msg:'幸運の光は続いていますが、少し過信や見落としがあるかもしれません。謙虚さを忘れずに、喜びを大切にしてください。'},
  {num:'XX',  order:20, name:'審判',       en:'Judgement',          img:'judgement',
   upright:'覚醒・再生・召命・清算', reversed:'自己批判・過去への固執・決断の先延ばし',
   upright_msg:'高いところからの呼びかけに、今のあなたは応える準備ができています。過去を清算し、真の使命に目覚めるタイミング。大きな転換点に立つあなたへのメッセージは「今こそ本当の自分として生きよ」です。',
   reversed_msg:'過去の失敗や後悔を手放せていないかもしれません。自分を責めることをやめ、前を向く勇気を持つことが今の課題です。'},
  {num:'XXI', order:21, name:'世界',       en:'The World',          img:'world',
   upright:'完成・統合・達成・新サイクルの扉', reversed:'未完成・遅延・近道を探す',
   upright_msg:'大アルカナの完成形があなたを祝福しています！一つのサイクルの完全なる達成と成就。今のあなたには、物事を完成に導く力が宿っています。喜んで受け取り、次の大きな旅への扉を開いてください。すべてが整っています。',
   reversed_msg:'もう少しで完成というところで、何かが滞っているかもしれません。焦らず、残りのピースを丁寧に埋めていきましょう。'},
];

let pickedCards = [];
let selected = null;

window.addEventListener('DOMContentLoaded', init);

function init() {
  // 22枚全部・正位置/逆位置をランダムに設定・順序もシャッフル
  pickedCards = TAROT.map(c => ({ ...c, isUpright: Math.random() > .35 }));
  pickedCards.sort(() => Math.random() - .5);
  selected = null;
  renderCircle();
}

// シャッフル — 収束→再配置→展開アニメーション
function shuffleCards() {
  if (selected !== null) return;

  const btn  = document.getElementById('shuffleBtn');
  const area = document.getElementById('circle-area');
  const size = area.offsetWidth;
  const cx   = size / 2;
  const cy   = size / 2;

  btn.disabled = true;
  btn.style.opacity = '.5';

  // ── Phase 1: 全カードを中央へ収束 ──
  const cardEls = area.querySelectorAll('.tcard');
  cardEls.forEach(card => {
    const dx = cx - parseFloat(card.style.left);
    const dy = cy - parseFloat(card.style.top);
    card.style.transition = 'transform .35s cubic-bezier(.55,0,1,.7)';
    card.style.transform  = `translate(${dx}px,${dy}px) scale(.18)`;
  });

  // ── Phase 2: データ更新＋再描画（中央位置から即セット） ──
  setTimeout(() => {
    pickedCards = pickedCards.map(c => ({ ...c, isUpright: Math.random() > .35 }));
    pickedCards.sort(() => Math.random() - .5);

    renderCircle(); // 新しい left/top で DOM 再構築

    // 再描画直後のカードを中央に固定（transition なしで）
    const newEls = area.querySelectorAll('.tcard');
    newEls.forEach(card => {
      const dx = cx - parseFloat(card.style.left);
      const dy = cy - parseFloat(card.style.top);
      card.style.transition = 'none';
      card.style.transform  = `translate(${dx}px,${dy}px) scale(.18)`;
    });

    // ── Phase 3: 新しい位置へ展開（時差あり） ──
    // 2フレーム待ってから transition を有効にする
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        newEls.forEach((card, i) => {
          card.style.transition =
            `transform .45s cubic-bezier(.2,.8,.4,1) ${i * 18}ms`;
          card.style.transform = 'translate(0,0) scale(1)';
        });

        // 展開完了後にボタンを戻す
        const totalMs = 450 + (newEls.length - 1) * 18 + 60;
        setTimeout(() => {
          btn.disabled = false;
          btn.style.opacity = '';
        }, totalMs);
      });
    });
  }, 370);
}

// 22枚を円形に配置
function renderCircle() {
  const area = document.getElementById('circle-area');
  const size = area.offsetWidth || 580;
  const cx = size / 2, cy = size / 2;
  const r  = size * 0.42;
  const n  = pickedCards.length;

  area.innerHTML = '';

  pickedCards.forEach((card, i) => {
    const angle = (i / n) * 2 * Math.PI - Math.PI / 2;
    const x = cx + r * Math.cos(angle);
    const y = cy + r * Math.sin(angle);

    const wrap = document.createElement('div');
    wrap.className = 'tcard';
    wrap.style.left = x + 'px';
    wrap.style.top  = y + 'px';
    wrap.innerHTML = `
      <div class="tcard-inner">
        <div class="tcard-face tcard-back">
          <div class="tcard-back-icon">&#9670;</div>
          <div class="tcard-back-line"></div>
        </div>
        <div class="tcard-face tcard-front">
          <div class="tcard-front-num">${card.num}</div>
          <div class="tcard-front-img"><img src="/cards/${card.img}.png" alt="${card.name}" loading="lazy"></div>
          <div class="tcard-front-name">${card.name}</div>
        </div>
      </div>`;
    wrap.addEventListener('click', () => onSelect(i));
    area.appendChild(wrap);
  });
}

function onSelect(idx) {
  if (selected !== null) return;
  selected = idx;
  const card = pickedCards[idx];

  // シャッフルボタン非表示
  document.getElementById('shuffleBtn').style.display = 'none';

  document.querySelectorAll('.tcard').forEach((el, i) => {
    if (i !== idx) el.classList.add('dimmed');
  });

  const isUp = card.isUpright;
  const dirClass = isUp ? 'dir-up' : 'dir-rev';
  const dirLabel = isUp ? '正位置' : '逆位置';
  const imgStyle = isUp ? '' : 'transform:rotate(180deg)';

  document.getElementById('big-img').innerHTML  = `<img src="/cards/${card.img}.png" alt="${card.name}" style="max-width:80%;max-height:100%;object-fit:contain;${imgStyle}">`;
  document.getElementById('big-num').textContent  = '第' + card.order + '番';
  document.getElementById('big-name').textContent = card.name;
  document.getElementById('big-en').textContent   = card.en;
  const dirEl = document.getElementById('big-dir');
  dirEl.textContent = '';
  dirEl.className   = 'big-dir';

  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';

  const inner = document.getElementById('big-card-inner');
  inner.style.transition = 'none';
  inner.style.transform  = 'rotateY(0deg)';

  setTimeout(() => {
    document.getElementById('overlay-msg').textContent = 'カードが語りかけています...';
    document.getElementById('overlay-sub').textContent = '';
  }, 50);
  setTimeout(() => {
    inner.style.transition = 'transform .9s cubic-bezier(.4,0,.2,1)';
    inner.style.transform  = 'rotateY(180deg)';
  }, 600);
  setTimeout(() => {
    document.getElementById('overlay-msg').textContent = '';
    document.getElementById('overlay-sub').textContent = 'タップして結果を見る';
    document.getElementById('big-card-info').classList.add('visible');
    dirEl.textContent = dirLabel;
    dirEl.className   = 'big-dir ' + dirClass;
    overlay.addEventListener('click', showResult, {once: true});
  }, 1600);
}

function showResult() {
  const card  = pickedCards[selected];
  const isUp  = card.isUpright;
  const kwStr = isUp ? card.upright : card.reversed;
  const msg   = isUp ? card.upright_msg : card.reversed_msg;
  const dirClass = isUp ? 'dir-up' : 'dir-rev';
  const dirLabel = isUp ? '正位置' : '逆位置';
  const keywords = (kwStr || '').split('・');

  document.getElementById('stage-select').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';

  const sec = document.getElementById('result-section');
  sec.style.display = 'block';
  sec.innerHTML = `
    <div class="result-header fade-in">
      <div class="chosen-label">あなたが選んだカード</div>
      <div class="chosen-card-wrap">
        <div class="chosen-card">
          <div class="chosen-num">${card.num}</div>
          <div class="chosen-img"><img src="/cards/${card.img}.png" alt="${card.name}" ${isUp ? '' : 'style="transform:rotate(180deg)"'}></div>
          <div class="chosen-en">${card.en}</div>
          <div class="chosen-name">${card.name}</div>
        </div>
        <span class="chosen-dir ${dirClass}">${dirLabel}</span>
      </div>
    </div>
    <div class="result-block fade-in">
      <div class="block-label">&#10022; キーワード</div>
      <div class="keyword-row">${keywords.map(k => `<span class="keyword">${k}</span>`).join('')}</div>
    </div>
    <div class="adsense-space"></div>
    <div class="result-block fade-in-2">
      <div class="block-label">&#10022; カードからのメッセージ</div>
      <div class="result-message">${msg}</div>
    </div>
    <div class="adsense-space"></div>
    <div class="result-block fade-in-3">
      <div class="block-label">&#10022; このカードについて</div>
      <div class="result-message">
        <strong style="color:var(--gold-lt);font-family:var(--ff-serif)">${card.num}. ${card.name}（${card.en}）</strong>は大アルカナのカードです。<br><br>
        正位置のキーワード：${card.upright}<br>
        逆位置のキーワード：${card.reversed}
      </div>
    </div>
    <a href="/articles/tarot/" class="rf-article-link">
      <span class="rf-article-icon">📖</span>
      <span class="rf-article-body">
        <strong>タロット占いとは？</strong>
        <small>22枚の大アルカナや正位置・逆位置の意味を解説</small>
      </span>
      <span class="rf-article-arrow">→</span>
    </a>
    <button class="rf-retry-btn" onclick="resetAll()">🔀 もう一度カードを引く</button>
  `;

  document.getElementById('tarot-nav-cards').style.display = 'block';
  sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function resetAll() {
  document.getElementById('result-section').style.display = 'none';
  document.getElementById('result-section').innerHTML = '';
  document.getElementById('tarot-nav-cards').style.display = 'none';

  const stage = document.getElementById('stage-select');
  stage.style.display = 'flex';
  document.getElementById('shuffleBtn').style.display = '';

  const inner = document.getElementById('big-card-inner');
  inner.style.transition = 'none';
  inner.style.transform  = 'rotateY(0deg)';
  document.getElementById('big-card-info').classList.remove('visible');
  document.getElementById('overlay').style.display = 'none';

  init();
  // ページ最上部ではなくカード選択エリアへスクロール
  document.getElementById('stage-select').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

window.addEventListener('resize', () => {
  if (selected === null) renderCircle();
});
</script>
<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({
    pageLanguage:'ja',
    includedLanguages:'en,zh-TW,zh-CN,ko',
    layout:google.translate.TranslateElement.InlineLayout.SIMPLE
  },'google_translate_element');
}
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click', function(e){
  if(!e.target.closest('.sp-menu-btn') && !e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});
</script>
</body>
</html>
