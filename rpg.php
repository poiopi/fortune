<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/rpg.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="RPG風の村を歩いてキャラクターに話しかけ、星座・数秘術・ジョブクラスで運命を占います。">
<title>RPG占い｜村を歩いて運命を探せ</title>
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
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-rpg);font-size:clamp(1.4rem,4vw,2.2rem);font-weight:400;line-height:1.4;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

/* ── GAME SHELL ── */
.game-outer{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:2rem;position:relative}
.game-outer::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal));z-index:1}

/* HUD */
.game-hud{background:rgba(0,0,0,.55);padding:.55rem 1rem;display:flex;align-items:center;gap:.8rem;flex-wrap:wrap;border-bottom:1px solid var(--border)}
.hud-group{display:flex;align-items:center;gap:.35rem}
.hud-lbl{font-family:var(--ff-rpg);font-size:.62rem;color:var(--muted)}
.hud-bar-wrap{width:60px;height:7px;background:rgba(255,255,255,.1);border-radius:3px;overflow:hidden}
.hud-bar{height:7px;border-radius:3px;transition:width .3s}
.hud-bar.hp{background:linear-gradient(90deg,#e55,#f88)}
.hud-bar.mp{background:linear-gradient(90deg,#66e,#aaf)}
.hud-num{font-family:var(--ff-rpg);font-size:.62rem;color:var(--text);min-width:36px}
.hud-items{display:flex;gap:.3rem;margin-left:auto}
.hud-chip{font-family:var(--ff-rpg);font-size:.6rem;color:var(--teal);background:rgba(78,205,196,.1);border:1px solid rgba(78,205,196,.25);border-radius:4px;padding:.1rem .35rem}
.hud-talk{font-family:var(--ff-rpg);font-size:.62rem;color:var(--gold)}

/* VIEWPORT */
.game-viewport{position:relative;overflow:hidden;background:#1e3320;touch-action:none;user-select:none;-webkit-user-select:none;display:flex;justify-content:center}
#gc{display:block;flex-shrink:0}
.player-pin{position:absolute;pointer-events:none;z-index:5;transform:translate(-50%,-55%);line-height:1;transition:none}
.talk-btn-canvas{position:absolute;bottom:10px;left:50%;transform:translateX(-50%);z-index:10;background:rgba(201,168,76,.92);border:none;border-radius:20px;padding:.4rem 1.4rem;font-family:var(--ff-rpg);font-size:.78rem;color:#1a1000;cursor:pointer;display:none;-webkit-tap-highlight-color:transparent;box-shadow:0 2px 12px rgba(0,0,0,.5);animation:pulse .8s infinite alternate}
@keyframes pulse{from{box-shadow:0 2px 12px rgba(201,168,76,.3)}to{box-shadow:0 2px 20px rgba(201,168,76,.8)}}

/* CONTROLS */
.game-controls{background:rgba(0,0,0,.35);padding:.6rem 1rem;display:flex;justify-content:space-between;align-items:center;border-top:1px solid var(--border);flex-wrap:wrap;gap:.5rem}
.dpad{display:grid;grid-template-columns:repeat(3,42px);grid-template-rows:repeat(3,42px);gap:2px}
.db{background:rgba(155,114,239,.15);border:1px solid var(--border2);border-radius:8px;color:var(--violet-lt);font-size:1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;-webkit-tap-highlight-color:transparent;touch-action:manipulation;transition:background .1s}
.db:active{background:rgba(155,114,239,.4)}
.db.act{background:rgba(201,168,76,.15);border-color:rgba(201,168,76,.3);color:var(--gold);font-family:var(--ff-rpg);font-size:.6rem;text-align:center;line-height:1.3}
.db.empty{visibility:hidden}
.ghint{font-family:var(--ff-rpg);font-size:.65rem;color:var(--muted);line-height:1.7;max-width:200px}

/* OVERLAY */
.ov{display:none;position:fixed;inset:0;z-index:300;background:rgba(8,6,15,.88);backdrop-filter:blur(10px);align-items:center;justify-content:center;padding:1rem}
.ov.on{display:flex}
.ob{background:var(--card);border:2px solid var(--violet);border-radius:16px;padding:1.5rem;width:100%;max-width:420px;max-height:88vh;overflow-y:auto}
.ot{font-family:var(--ff-rpg);font-size:.88rem;color:var(--gold);margin-bottom:.6rem;padding-bottom:.5rem;border-bottom:1px solid var(--border)}
.osp{font-family:var(--ff-rpg);font-size:.72rem;color:var(--violet-lt);margin-bottom:.35rem}
.otx{font-family:var(--ff-rpg);font-size:.8rem;color:var(--text);line-height:2;margin-bottom:.9rem}
.ochoices{display:flex;flex-direction:column;gap:.45rem}
.cbtn{background:rgba(155,114,239,.1);border:1px solid var(--border2);border-radius:8px;padding:.6rem .9rem;font-family:var(--ff-rpg);font-size:.76rem;color:var(--violet-lt);cursor:pointer;text-align:left;transition:background .15s;-webkit-tap-highlight-color:transparent}
.cbtn::before{content:'▶ ';color:var(--gold)}
.cbtn:hover,.cbtn:active{background:rgba(155,114,239,.25)}
.cbtn.bad{color:var(--rose);border-color:rgba(232,113,154,.25)}
.cbtn.bad::before{color:var(--rose)}
.ocls{width:100%;background:none;border:1px solid var(--border);border-radius:8px;padding:.5rem;font-family:var(--ff-rpg);font-size:.7rem;color:var(--muted);cursor:pointer;margin-top:.6rem;transition:color .2s}
.ocls:hover{color:var(--text)}

/* COMBAT */
.cbtfield{background:rgba(0,0,0,.4);border:1px solid var(--border);border-radius:10px;padding:1rem;margin-bottom:.9rem;text-align:center}
.cenemy{font-size:2.5rem;margin-bottom:.3rem}
.cename{font-family:var(--ff-rpg);font-size:.78rem;color:var(--rose);margin-bottom:.4rem}
.cehpw{height:7px;background:rgba(255,255,255,.1);border-radius:3px;overflow:hidden;margin-bottom:.3rem}
.cehpb{height:7px;background:linear-gradient(90deg,#e55,#f88);border-radius:3px;transition:width .4s}
.cehpv{font-family:var(--ff-rpg);font-size:.62rem;color:var(--muted)}
.clog{font-family:var(--ff-rpg);font-size:.74rem;color:var(--muted);min-height:2.2rem;line-height:1.8;margin-bottom:.7rem}
.cacts{display:grid;grid-template-columns:1fr 1fr;gap:.45rem}
.cact{background:rgba(155,114,239,.1);border:1px solid var(--border2);border-radius:8px;padding:.6rem;font-family:var(--ff-rpg);font-size:.72rem;color:var(--violet-lt);cursor:pointer;transition:background .15s;-webkit-tap-highlight-color:transparent}
.cact:hover{background:rgba(155,114,239,.25)}
.cact.mag{color:var(--teal);border-color:rgba(78,205,196,.3)}
.cact.itm{color:var(--gold);border-color:rgba(201,168,76,.3)}
.cact.run{color:var(--muted)}
.cact:disabled{opacity:.35;cursor:default;pointer-events:none}

/* ITEM POPUP */
.ipop{position:fixed;bottom:28%;left:50%;transform:translateX(-50%);background:rgba(30,23,56,.97);border:1px solid var(--gold);border-radius:10px;padding:.5rem 1.1rem;font-family:var(--ff-rpg);font-size:.76rem;color:var(--gold);z-index:200;opacity:0;transition:opacity .3s;pointer-events:none;white-space:nowrap;text-align:center}
.ipop.on{opacity:1}

/* FORTUNE FORM */
.fform{display:flex;flex-direction:column;gap:.7rem}
.fform label{font-family:var(--ff-rpg);font-size:.7rem;color:var(--muted)}
.fform input{background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.6rem .9rem;font-family:var(--ff-sans);font-size:1rem;color:var(--text);outline:none;transition:border-color .2s;width:100%}
.fform input:focus{border-color:var(--violet)}
.fsub{background:linear-gradient(135deg,var(--gold),var(--violet));border:none;border-radius:10px;padding:.72rem;font-family:var(--ff-rpg);font-size:.82rem;color:#fff;cursor:pointer;transition:opacity .2s;margin-top:.4rem}
.fsub:hover{opacity:.85}

/* RESULT */
.rsec{margin-bottom:1.1rem;padding:.9rem 1rem;background:rgba(0,0,0,.3);border:1px solid var(--border);border-radius:10px}
.rlbl{font-family:var(--ff-rpg);font-size:.6rem;letter-spacing:.14em;color:var(--muted);margin-bottom:.35rem}
.rbig{font-family:var(--ff-rpg);font-size:1.3rem;color:var(--gold-lt);margin-bottom:.25rem}
.rsub{font-family:var(--ff-rpg);font-size:.76rem;color:var(--text);line-height:1.9}
.rbadge{display:inline-block;font-family:var(--ff-rpg);font-size:.62rem;background:rgba(155,114,239,.18);border:1px solid rgba(155,114,239,.35);border-radius:4px;padding:.12rem .45rem;color:var(--violet-lt);margin:.1rem}
.rtry{width:100%;background:none;border:1px solid var(--border2);border-radius:8px;padding:.6rem;font-family:var(--ff-rpg);font-size:.75rem;color:var(--muted);cursor:pointer;margin-top:.7rem;transition:color .2s,border-color .2s}
.rtry:hover{color:var(--text);border-color:var(--violet)}

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
  .ghint{display:none}
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
      RPG占い
      <a href="/aisho.php">相性診断</a>
      <a href="/zense">前世診断</a>
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
      <span>RPG占い</span>
      <a href="/aisho.php">相性診断</a>
      <a href="/zense">前世診断</a>
    </div>
  </div>
</header>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">RPG Fortune</span>
    <h1>村を歩いて運命を探せ</h1>
    <p class="hero-sub">ソラリス村を自由に歩き、村人に話しかけ、アイテムを集めよう。<br>教会の神父があなたの星座・数秘術・隠れたジョブを占います。</p>
  </section>

  <div class="adsense-space"></div>

  <div class="game-outer">
    <div class="game-hud">
      <div class="hud-group">
        <span class="hud-lbl">HP</span>
        <div class="hud-bar-wrap"><div class="hud-bar hp" id="hpBar"></div></div>
        <span class="hud-num" id="hpVal">30/30</span>
      </div>
      <div class="hud-group">
        <span class="hud-lbl">MP</span>
        <div class="hud-bar-wrap"><div class="hud-bar mp" id="mpBar"></div></div>
        <span class="hud-num" id="mpVal">20/20</span>
      </div>
      <div class="hud-items" id="hudItems"></div>
      <span class="hud-talk" id="hudTalk">👥 0/5人</span>
    </div>

    <div class="game-viewport" id="gvp">
      <canvas id="gc"></canvas>
      <div class="player-pin" id="pin" style="font-size:0">🧙</div>
      <canvas id="playerCanvas" style="position:absolute;pointer-events:none;z-index:6;display:none"></canvas>
      <button class="talk-btn-canvas" id="talkBtn" onclick="talk()">💬 話す / Space</button>
    </div>

    <div class="game-controls">
      <div class="dpad">
        <div class="db empty"></div>
        <button class="db" id="bU">▲</button>
        <div class="db empty"></div>
        <button class="db" id="bL">◀</button>
        <button class="db act" id="bA">話す<br>Space</button>
        <button class="db" id="bR">▶</button>
        <div class="db empty"></div>
        <button class="db" id="bD">▼</button>
        <div class="db empty"></div>
      </div>
      <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.5rem">
        <button id="bgmBtn" onclick="toggleBgm()" style="background:rgba(155,114,239,.15);border:1px solid var(--border2);border-radius:8px;color:var(--muted);font-family:var(--ff-rpg);font-size:.65rem;padding:.35rem .7rem;cursor:pointer;-webkit-tap-highlight-color:transparent">🔇 BGM OFF</button>
        <div class="ghint">🎮 矢印キー or WASD で移動<br>Space / Enterで話しかける<br>アイテムは踏むと自動取得</div>
      </div>
    </div>
  </div>

  <div class="adsense-space"></div>
</div>

<!-- DIALOG -->
<div class="ov" id="dlgOv">
  <div class="ob">
    <div class="ot" id="dlgTitle"></div>
    <div class="osp" id="dlgSp"></div>
    <div class="otx" id="dlgTx"></div>
    <div class="ochoices" id="dlgCh"></div>
    <button class="ocls" id="dlgCls" onclick="closeDlg()">▶ 話を終える</button>
  </div>
</div>

<!-- COMBAT -->
<div class="ov" id="cbtOv">
  <div class="ob">
    <div class="ot">⚔️ バトル！</div>
    <div class="cbtfield">
      <div class="cenemy" id="cEmo"></div>
      <div class="cename" id="cName"></div>
      <div class="cehpw"><div class="cehpb" id="cHpB"></div></div>
      <div class="cehpv" id="cHpV"></div>
    </div>
    <div class="clog" id="cLog"></div>
    <div class="cacts">
      <button class="cact" onclick="ca('atk')">⚔️ たたかう</button>
      <button class="cact mag" id="cMag" onclick="ca('mag')">✨ 魔法(5MP)</button>
      <button class="cact itm" id="cItm" onclick="ca('itm')">🌿 薬草を使う</button>
      <button class="cact run" onclick="ca('run')">💨 にげる</button>
    </div>
  </div>
</div>

<!-- FORTUNE FORM -->
<div class="ov" id="frmOv">
  <div class="ob">
    <div class="ot">⛪ 神父の占い</div>
    <div class="otx">旅人よ、よく来てくれた。生年月日を教えてくれれば、星と数と天の意志があなたの運命を示そう。</div>
    <div class="fform">
      <label>生年月日</label>
      <input type="date" id="bdate" max="<?= date('Y-m-d') ?>">
      <button class="fsub" onclick="calcFortune()">✦ 占ってもらう</button>
    </div>
  </div>
</div>

<!-- RESULT -->
<div class="ov" id="resOv">
  <div class="ob">
    <div class="ot">✦ 占い結果 ✦</div>
    <div id="resContent"></div>
    <div class="share-wrap">
      <p class="share-label">✦ 結果をシェアする</p>
      <div class="share-btns">
        <button class="share-btn share-line" onclick="openShare('line')">LINE</button>
        <button class="share-btn share-x" onclick="openShare('x')">𝕏</button>
        <button class="share-btn share-fb" onclick="openShare('fb')">Facebook</button>
        <button class="share-btn share-copy" onclick="copyShareUrl()">🔗 リンクをコピー</button>
      </div>
    </div>
    <button class="rtry" onclick="resetGame()">▶ もう一度遊ぶ</button>
  </div>
</div>

<div class="ipop" id="ipop"></div>

<p style="max-width:900px;margin:0 auto 1.5rem;padding:0 1.2rem;text-align:center;font-size:.72rem;color:var(--muted);line-height:1.8">本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。</p>

<footer>
  <a href="/">占いポータル トップ</a> &nbsp;/&nbsp;
  <a href="/tarot.php">タロット占い</a> &nbsp;/&nbsp;
  <a href="/calendar.php">開運カレンダー</a> &nbsp;/&nbsp;
  <a href="/mbti.php">MBTI×星座診断</a> &nbsp;/&nbsp;
  <a href="/numerology.php">数秘術診断</a> &nbsp;/&nbsp;
  <a href="/kyusei.php">九星気学</a> &nbsp;/&nbsp;
  RPG占い &nbsp;/&nbsp;
  <a href="/aisho.php">相性診断</a> &nbsp;/&nbsp;
  <a href="/zense">前世診断</a> &nbsp;/&nbsp;
  <a href="/privacy.php">プライバシーポリシー</a> &nbsp;/&nbsp;
  <a href="/profile.php">運営者情報</a> &nbsp;/&nbsp;
  <a href="/contact.php">お問い合わせ</a><br>
  &copy; <?= date('Y') ?> 三星統合鑑定
</footer>

<script>
// ════════════════════════════════════════════
// SPRITES
// ════════════════════════════════════════════
const CHAR_FILES={
  player:'A', witch:'B',   healer:'C', smith:'D',
  knight:'E', bard:'F',    grandma:'G',merchant:'H',
  priest:'I', thug:'J',    guardian:'K',slime:'N',
};
const FILE_DIRS=['front','back','left','right'];
const DIR_MAP={down:'front',up:'back',left:'left',right:'right'};

const CHAR_IMGS={};
let _imgLoaded=0;
const _imgTotal=Object.keys(CHAR_FILES).length*4;
let _imgReady=0;

Object.entries(CHAR_FILES).forEach(([key,letter])=>{
  CHAR_IMGS[key]={};
  FILE_DIRS.forEach(d=>{
    const img=new Image();
    img.src='/sprites/'+letter+'_'+d+'.png';
    img.onload=img.onerror=()=>{
      _imgLoaded++;
      if(_imgLoaded>=_imgTotal){_imgReady=2;draw();}
    };
    CHAR_IMGS[key][d]=img;
  });
});

const TCOL={0:'#3d6b3e',1:'#b0894e',2:'#2b4a26',3:'#2a5caa'};
function drawTile(type,dx,dy){
  ctx.fillStyle=TCOL[type]||'#3d6b3e';
  ctx.fillRect(dx,dy,TS,TS);
}

function drawChar(key,dx,dy,dir='down'){
  if(_imgReady<2) return;
  const fileDir=DIR_MAP[dir]||'front';
  const img=CHAR_IMGS[key]?.[fileDir];
  if(!img||!img.complete||!img.naturalWidth) return;
  const dh=Math.round(TS*1.8);
  const dw=Math.round(dh*img.naturalWidth/img.naturalHeight);
  const ddx=dx+(TS-dw)/2, ddy=dy-dh+TS;
  ctx.drawImage(img,0,0,img.naturalWidth,img.naturalHeight,ddx,ddy,dw,dh);
}

// ════════════════════════════════════════════
// MAP & CONSTANTS
// ════════════════════════════════════════════
const TS=40, VPC=13, VPR=11, MW=20, MH=20;
const G=0,P=1,T=2,W=3;

const MAP=[
  [T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,P,P,P,P,P,P,P,P,P,P,P,P,P,P,P,P,G,T],
  [T,G,P,G,G,G,G,G,G,G,G,G,G,G,G,G,G,P,G,T],
  [T,G,P,G,G,G,G,G,G,G,G,G,G,G,G,G,G,P,G,T],
  [T,G,P,G,G,G,W,W,G,G,G,G,W,W,G,G,G,P,G,T],
  [T,G,P,G,G,G,W,W,G,G,G,G,W,W,G,G,G,P,G,T],
  [T,G,P,G,G,G,G,G,G,G,G,G,G,G,G,G,G,P,G,T],
  [T,G,P,G,G,G,G,G,G,G,G,G,G,G,G,G,G,P,G,T],
  [T,G,P,G,G,G,G,G,G,G,G,G,G,G,G,G,G,P,G,T],
  [T,G,P,P,P,P,P,P,P,P,P,P,P,P,P,P,P,P,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,G,T],
  [T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T,T],
];

// buildings: {x,y,w,h,name,emoji,doorX,doorY}
const BLDS=[
  {x:3, y:1,w:4,h:4,name:'宿屋',      emoji:'🏨',doorX:5, doorY:4},
  {x:13,y:1,w:4,h:4,name:'市場',      emoji:'🏪',doorX:15,doorY:4},
  {x:3, y:6,w:3,h:6,name:'鍛冶屋',   emoji:'⚒️',doorX:4, doorY:11},
  {x:14,y:6,w:3,h:6,name:'詰所',      emoji:'🏰',doorX:15,doorY:11},
  {x:3, y:14,w:4,h:5,name:'魔女の小屋',emoji:'🔮',doorX:5, doorY:14,church:false},
  {x:10,y:14,w:8,h:5,name:'⛪ 教会（占いの聖地）',emoji:'⛪',doorX:13,doorY:14,church:true},
];

// impassable set
const WALL=new Set();
BLDS.forEach(b=>{
  for(let bx=b.x;bx<b.x+b.w;bx++)
    for(let by=b.y;by<b.y+b.h;by++)
      if(bx!==b.doorX||by!==b.doorY) WALL.add(bx+','+by);
});

function passable(x,y){
  if(x<0||y<0||x>=MW||y>=MH) return false;
  const t=MAP[y][x];
  if(t===T||t===W) return false;
  if(WALL.has(x+','+y)) return false;
  return true;
}


// ════════════════════════════════════════════
// NPCs
// ════════════════════════════════════════════
const NPCS=[
  {id:'grandma',name:'村の老婆',emoji:'👵',x:0,y:0,
   dlg:[
     {tx:'おや、見かけない顔じゃ。この村に何の用かい？',
      ch:[{t:'強くなりたくて来ました',sc:{battle:2}},
          {t:'知恵を借りたくて来ました',sc:{wisdom:2}},
          {t:'旅の途中ですよ',sc:{free:2}}]},
     {tx:'なるほどのう。お前さんの目には芯の強さがある。きっと大きな使命があるじゃろよ。'}
   ]},
  {id:'smith',name:'鍛冶屋のゴルド',emoji:'⚒️',x:0,y:0,
   dlg:[
     {tx:'おう！剣でも買いにきたか？',
      ch:[{t:'最強の剣をください！',sc:{battle:3}},
          {t:'軽くて動ける装備がほしい',sc:{agility:2}},
          {t:'道具より知恵が大事ですよ',sc:{wisdom:2}},
          {t:'財布を盗んで逃げる！',bad:true,enemy:'thug'}]},
     {tx:'戦場で生き残るのは力だけじゃない。守る心があってこそ真の戦士だ。'}
   ]},
  {id:'witch',name:'魔女のシルヴィア',emoji:'🧙‍♀️',x:0,y:0,
   dlg:[
     {tx:'珍しい来客ね。あなたから不思議なオーラを感じるわ。',
      ch:[{t:'魔法を教えてください',sc:{magic:3}},
          {t:'占いをしてください',sc:{wisdom:2}},
          {t:'薬草が欲しいんです',sc:{nature:2}},
          {t:'魔法石を奪う！',bad:true,enemy:'guardian'}]},
     {tx:'魔力は心の鏡よ。あなたが何を信じるかで、使える力が変わってくる。'}
   ]},
  {id:'merchant',name:'商人のリカルド',emoji:'🪙',x:0,y:0,
   dlg:[
     {tx:'いらっしゃい！今日は何が必要かな？',
      ch:[{t:'情報が欲しいです',sc:{wisdom:2}},
          {t:'一番高い物を！',sc:{battle:1,magic:1}},
          {t:'値切り交渉しましょう',sc:{free:3}}]},
     {tx:'賢い客は価値がわかる。世の中をうまく渡れるもんだ。'}
   ]},
  {id:'knight',name:'騎士団長のアルス',emoji:'⚔️',x:0,y:0,
   dlg:[
     {tx:'貴様、何者だ。この村に何の用だ？',
      ch:[{t:'仲間になりたいのです！',sc:{battle:3}},
          {t:'旅の冒険者です',sc:{agility:2}},
          {t:'守るべきものがあります',sc:{heal:2}}]},
     {tx:'その目、気に入った。真の騎士は力だけでなく、守る心を持つ者だ。'}
   ]},
  {id:'healer',name:'薬師のルナ',emoji:'💚',x:0,y:0,
   dlg:[
     {tx:'こんにちは旅人さん。お体の調子はいかがですか？',
      ch:[{t:'元気いっぱいです！',sc:{heal:1}},
          {t:'少し疲れました…',sc:{heal:3},healHp:10},
          {t:'薬草の使い方を教えて',sc:{nature:2}}]},
     {tx:'癒しとは他者への思いやりから生まれます。あなたの優しい心が周りを救うでしょう。'}
   ]},
  {id:'bard',name:'吟遊詩人のフィン',emoji:'🎵',x:0,y:0,
   dlg:[
     {tx:'♪ 旅人よ、歌を聴いてゆかないか？',
      ch:[{t:'ぜひ聴かせてください！',sc:{free:2,magic:1}},
          {t:'急いでいるので遠慮します',sc:{battle:1}},
          {t:'一緒に歌いましょう！',sc:{free:3},healMp:5}]},
     {tx:'♪ 風よ、星よ、この旅人に幸運の歌を授けよ…素敵な旅を！'}
   ]},
  {id:'priest',name:'神父のオルフェウス',emoji:'✝️',x:13,y:13,priest:true,
   dlg:[{tx:'よく来られた旅人よ。村の皆と十分に話したならば、星と数の占いをしましょう。'}]},
];

// ════════════════════════════════════════════
// ITEMS
// ════════════════════════════════════════════
const IDEF=[
  {id:'h1',type:'herb',  emoji:'🌿',x:0,y:0,name:'薬草',   desc:'HP+10'},
  {id:'h2',type:'herb',  emoji:'🌿',x:0,y:0,name:'薬草',   desc:'HP+10'},
  {id:'h3',type:'herb',  emoji:'🌿',x:0,y:0,name:'薬草',   desc:'HP+10'},
  {id:'c1',type:'crystal',emoji:'💎',x:0,y:0,name:'魔法石', desc:'占い精度UP'},
  {id:'c2',type:'crystal',emoji:'💎',x:0,y:0,name:'魔法石', desc:'占い精度UP'},
  {id:'s1',type:'scroll', emoji:'📜',x:0,y:0,name:'謎の巻物',desc:'神父がより詳しく占う'},
];

// ── 日替わり配置（BFSで到達可能タイルのみ）──────────
(function placeActors(){
  // BFSでプレイヤースタート(10,9)から到達可能な全タイルを列挙
  const reach=new Set(['10,9']);
  const q=[[10,9]];
  while(q.length){
    const[x,y]=q.shift();
    for(const[nx,ny] of[[x-1,y],[x+1,y],[x,y-1],[x,y+1]]){
      const k=nx+','+ny;
      if(!reach.has(k)&&passable(nx,ny)){reach.add(k);q.push([nx,ny]);}
    }
  }

  // 到達可能 & 通行可能 & 特定位置除外 & 隣接可能タイルを選定
  const pool=[];
  for(let y=1;y<MH-1;y++)
    for(let x=1;x<MW-1;x++){
      if(!reach.has(x+','+y)) continue;
      if(x===10&&y===9)  continue; // プレイヤースタート
      // 教会入口周辺（神父＋入口3タイル以内）は除外
      if(Math.abs(x-13)+Math.abs(y-13)<=3) continue;
      // 上下左右に通行可能な隣接タイルが2つ以上あること（行き止まりは除外）
      const nb=[[x-1,y],[x+1,y],[x,y-1],[x,y+1]].filter(([nx,ny])=>passable(nx,ny)).length;
      if(nb>=2) pool.push([x,y]);
    }

  // 日付シードでシャッフル
  const d=new Date();
  let _s=(d.getFullYear()*10000+d.getMonth()*100+d.getDate())*2654435761>>>0;
  const rng=()=>{_s=Math.imul(_s^(_s>>>16),0x45d9f3b)>>>0;return _s/4294967296};
  for(let i=pool.length-1;i>0;i--){const j=0|rng()*(i+1);[pool[i],pool[j]]=[pool[j],pool[i]];}

  // 最低距離4を保ちながら配置（より分散させる）
  const used=[];
  const pick=()=>{
    for(const[x,y] of pool){
      if(used.every(([ux,uy])=>Math.abs(ux-x)+Math.abs(uy-y)>=4)){used.push([x,y]);return{x,y};}
    }
    // 距離3に緩める
    for(const[x,y] of pool){
      if(used.every(([ux,uy])=>Math.abs(ux-x)+Math.abs(uy-y)>=3)){used.push([x,y]);return{x,y};}
    }
    return{x:9,y:8}; // フォールバック
  };

  NPCS.forEach(n=>{if(!n.priest){const p=pick();n.x=p.x;n.y=p.y}});
  IDEF.forEach(it=>{const p=pick();it.x=p.x;it.y=p.y});
})();

// ════════════════════════════════════════════
// ENEMIES
// ════════════════════════════════════════════
const ENEM={
  thug:    {name:'ゴロツキ',    emoji:'🗡️', hp:12,atk:5,def:1,rew:'薬草',rewT:'herb'},
  guardian:{name:'魔法の使い魔',emoji:'🐈‍⬛',hp:10,atk:4,def:2,rew:'魔法石',rewT:'crystal'},
  slime:   {name:'スライム',   emoji:'🟢', hp:8, atk:3,def:0,rew:'薬草',rewT:'herb'},
};

// ════════════════════════════════════════════
// GAME STATE
// ════════════════════════════════════════════
let pl={x:10,y:9,hp:30,mhp:30,mp:20,mmp:20,dir:'down'};
let inv={herb:0,crystal:0,scroll:false};
let picked=new Set(), visited=new Set();
let sc={battle:0,magic:0,wisdom:0,agility:0,heal:0,free:0,nature:0};
let curNpc=null, dlgIdx=0;
let curEn=null, enHp=0, enMHp=0;
let phase='explore'; // explore|dialog|combat|fortune|result

// ════════════════════════════════════════════
// CANVAS
// ════════════════════════════════════════════
const cv=document.getElementById('gc');
const ctx=cv.getContext('2d');
const gvp=document.getElementById('gvp');
const pin=document.getElementById('pin');

let _scale=1;
function resize(){
  const w=Math.min(gvp.parentElement.clientWidth-2, VPC*TS);
  _scale=w/(VPC*TS);
  const h=Math.round(VPR*TS*_scale);
  cv.width=VPC*TS; cv.height=VPR*TS;
  cv.style.width=w+'px'; cv.style.height=h+'px';
  gvp.style.height=h+'px';
  pin.style.fontSize=Math.round(TS*_scale*.72)+'px';
  draw();
}

function updatePin(){
  const{cx,cy}=cam();
  const px=Math.round((pl.x-cx)*TS*_scale+TS*_scale/2);
  const py=Math.round((pl.y-cy)*TS*_scale+TS*_scale/2);
  pin.style.left=px+'px';
  pin.style.top=py+'px';
}

function cam(){
  let cx=pl.x-Math.floor(VPC/2), cy=pl.y-Math.floor(VPR/2);
  cx=Math.max(0,Math.min(MW-VPC,cx));
  cy=Math.max(0,Math.min(MH-VPR,cy));
  return{cx,cy};
}

function draw(){
  ctx.clearRect(0,0,cv.width,cv.height);
  const{cx,cy}=cam();

  // tiles
  for(let r=0;r<VPR;r++){
    for(let c=0;c<VPC;c++){
      const mx=c+cx,my=r+cy;
      if(mx<0||my<0||mx>=MW||my>=MH) continue;
      const t=MAP[my][mx];
      if(t===T){
        drawTile(G,c*TS,r*TS);
        ctx.font=Math.round(TS*.6)+'px serif';
        ctx.textAlign='center'; ctx.textBaseline='middle';
        ctx.fillText('🌲',c*TS+TS/2,r*TS+TS/2);
      } else {
        drawTile(t,c*TS,r*TS);
        ctx.strokeStyle='rgba(0,0,0,.12)';
        ctx.strokeRect(c*TS,r*TS,TS,TS);
      }
    }
  }

  // buildings
  BLDS.forEach(b=>{
    const sx=(b.x-cx)*TS, sy=(b.y-cy)*TS;
    if(sx+b.w*TS<0||sx>VPC*TS||sy+b.h*TS<0||sy>VPR*TS) return;
    if(b.church){
      // 教会は特別デザイン（石造り・大きな十字架）
      ctx.fillStyle='#4a3d6e'; ctx.fillRect(sx,sy,b.w*TS,b.h*TS);
      ctx.fillStyle='#2e2448'; ctx.fillRect(sx,sy,b.w*TS,TS*1.2);
      // 光る縁取り
      ctx.strokeStyle='rgba(201,168,76,.6)'; ctx.lineWidth=3;
      ctx.strokeRect(sx+1,sy+1,b.w*TS-2,b.h*TS-2);
      ctx.lineWidth=1;
      // 大きな⛪アイコン
      ctx.font=Math.round(TS*1.4)+'px serif';
      ctx.textAlign='center'; ctx.textBaseline='middle';
      ctx.fillText('⛪',sx+b.w*TS/2,sy+b.h*TS/2);
      // 名前ラベル
      ctx.font='bold '+Math.round(TS*.26)+'px DotGothic16,monospace';
      ctx.fillStyle='#e8c96a'; ctx.textAlign='center'; ctx.textBaseline='top';
      ctx.fillText('⛪ 教会（占いの聖地）',sx+b.w*TS/2,sy+TS*1.3);
    } else {
      ctx.fillStyle='#5c4a30'; ctx.fillRect(sx,sy,b.w*TS,b.h*TS);
      ctx.fillStyle='#3d2e1a'; ctx.fillRect(sx,sy,b.w*TS,TS*1.1);
      ctx.font=Math.round(TS*.55)+'px serif';
      ctx.textAlign='center'; ctx.textBaseline='middle';
      ctx.fillText(b.emoji,sx+b.w*TS/2,sy+TS*.6);
      ctx.font=Math.round(TS*.23)+'px DotGothic16,monospace';
      ctx.fillStyle='#e8d08a'; ctx.textAlign='center'; ctx.textBaseline='top';
      ctx.fillText(b.name,sx+b.w*TS/2,sy+TS+2);
    }
    // 扉（共通）
    const dx=(b.doorX-cx)*TS, dy=(b.doorY-cy)*TS;
    ctx.fillStyle=b.church?'#c9a84c':'#7a5a14';
    ctx.fillRect(dx+TS*.2,dy+(b.church?0:TS*.1),TS*.6,b.church?TS:TS*.85);
  });

  // items（金色の台座付き・明るく目立つ）
  IDEF.forEach(it=>{
    if(picked.has(it.id)) return;
    const sx=(it.x-cx)*TS, sy=(it.y-cy)*TS;
    if(sx<-TS||sx>=VPC*TS||sy<-TS||sy>=VPR*TS) return;
    // 金色の台座
    ctx.fillStyle='rgba(201,168,76,.35)';
    ctx.beginPath();
    ctx.arc(sx+TS/2,sy+TS/2,TS*.38,0,Math.PI*2);
    ctx.fill();
    // 輝き
    ctx.shadowColor='#e8c96a'; ctx.shadowBlur=14;
    ctx.font=Math.round(TS*.55)+'px serif';
    ctx.textAlign='center'; ctx.textBaseline='middle';
    ctx.fillText(it.emoji,sx+TS/2,sy+TS/2);
    ctx.shadowBlur=0;
    // 「アイテム」ラベル
    ctx.font=Math.round(TS*.2)+'px DotGothic16,monospace';
    ctx.fillStyle='#e8c96a'; ctx.textAlign='center'; ctx.textBaseline='top';
    ctx.fillText('★アイテム',sx+TS/2,sy+TS*.72);
  });

  // NPCs（y座標順=奥から手前の順に描画して重なりを正しくする）
  [...NPCS].sort((a,b)=>a.y-b.y).forEach(n=>{
    const sx=(n.x-cx)*TS, sy=(n.y-cy)*TS;
    if(sx<-TS||sx>=VPC*TS||sy<-TS||sy>=VPR*TS) return;
    // 背景（未訪問=紫、訪問済み=ティール）
    ctx.fillStyle=visited.has(n.id)?'rgba(78,205,196,.35)':'rgba(155,114,239,.35)';
    ctx.fillRect(sx+3,sy+3,TS-6,TS-6);
    // 枠線
    ctx.strokeStyle=visited.has(n.id)?'rgba(78,205,196,.7)':'rgba(155,114,239,.7)';
    ctx.strokeRect(sx+3,sy+3,TS-6,TS-6);
    // キャラクタースプライト（またはフォールバック絵文字）
    // NPC向き: 4方向対応。プレイヤーの方を向く
    let nDir='down';
    if(adj(n.x,n.y)){
      if(pl.x<n.x)      nDir='left';
      else if(pl.x>n.x) nDir='right';
      else if(pl.y<n.y) nDir='up';
    }
    const nFileDir=DIR_MAP[nDir]||'front';
    const nImg=CHAR_IMGS[n.id]?.[nFileDir];
    if(nImg&&nImg.complete&&nImg.naturalWidth>0){
      drawChar(n.id,sx,sy,nDir);
    } else {
      ctx.font=Math.round(TS*.65)+'px serif';
      ctx.textAlign='center'; ctx.textBaseline='middle';
      ctx.fillText(n.emoji,sx+TS/2,sy+TS*.45);
    }
    // 名前
    ctx.font=Math.round(TS*.18)+'px DotGothic16,monospace';
    ctx.fillStyle=visited.has(n.id)?'#4ecdc4':'#c4a8f5';
    ctx.textAlign='center'; ctx.textBaseline='bottom';
    ctx.fillText(n.name,sx+TS/2,sy+TS-.5);
    // 隣接時の「！」
    if(adj(n.x,n.y)){
      ctx.font=Math.round(TS*.38)+'px DotGothic16,monospace';
      ctx.fillStyle='#e8c96a'; ctx.textAlign='center'; ctx.textBaseline='bottom';
      ctx.shadowColor='#e8c96a'; ctx.shadowBlur=8;
      ctx.fillText('！',sx+TS/2,sy-2);
      ctx.shadowBlur=0;
    }
  });

  // プレイヤーピン位置を更新
  updatePin();

  // プレイヤースプライト描画
  const plFileDir=DIR_MAP[pl.dir]||'front';
  const plImg=CHAR_IMGS['player']?.[plFileDir];
  if(plImg&&plImg.complete&&plImg.naturalWidth>0){
    const{cx,cy}=cam();
    const px=(pl.x-cx)*TS, py=(pl.y-cy)*TS;
    drawChar('player',px,py,pl.dir);
    pin.style.fontSize='0';
  } else {
    pin.style.fontSize='';
  }

  // 5人達成後の教会誘導メッセージ
  if(visited.size>=5 && phase==='explore'){
    ctx.fillStyle='rgba(201,168,76,.92)';
    ctx.fillRect(4,4,VPC*TS-8,26);
    ctx.font='bold '+Math.round(TS*.28)+'px DotGothic16,monospace';
    ctx.fillStyle='#1a1000'; ctx.textAlign='center'; ctx.textBaseline='middle';
    ctx.fillText('⛪ 南の教会へ行って神父に話しかけよう！',VPC*TS/2,17);
  }
}

function adj(x,y){
  return Math.abs(x-pl.x)<=1&&Math.abs(y-pl.y)<=1&&!(x===pl.x&&y===pl.y);
}

function updateTalkBtn(){
  const btn=document.getElementById('talkBtn');
  const bA=document.getElementById('bA');
  const priest=NPCS.find(n=>n.priest&&adj(n.x,n.y));
  const other=NPCS.find(n=>!n.priest&&adj(n.x,n.y));
  if(priest){
    btn.style.display='block';
    btn.textContent='🔮 占う / Space';
    bA.innerHTML='占う<br>Space';
  } else if(other){
    btn.style.display='block';
    btn.textContent='💬 話す / Space';
    bA.innerHTML='話す<br>Space';
  } else {
    btn.style.display='none';
    bA.innerHTML='話す<br>Space';
  }
}

// ════════════════════════════════════════════
// HUD
// ════════════════════════════════════════════
function hud(){
  document.getElementById('hpBar').style.width=(pl.hp/pl.mhp*100)+'%';
  document.getElementById('hpVal').textContent=pl.hp+'/'+pl.mhp;
  document.getElementById('mpBar').style.width=(pl.mp/pl.mmp*100)+'%';
  document.getElementById('mpVal').textContent=pl.mp+'/'+pl.mmp;
  document.getElementById('hudTalk').textContent='👥 '+visited.size+'/5人';
  let h='';
  if(inv.herb>0)    h+=`<span class="hud-chip">🌿×${inv.herb}</span>`;
  if(inv.crystal>0) h+=`<span class="hud-chip">💎×${inv.crystal}</span>`;
  if(inv.scroll)    h+=`<span class="hud-chip">📜×1</span>`;
  document.getElementById('hudItems').innerHTML=h;
}

// ════════════════════════════════════════════
// MOVEMENT
// ════════════════════════════════════════════
const DMAP={ArrowUp:'u',ArrowDown:'d',ArrowLeft:'l',ArrowRight:'r',
            w:'u',s:'d',a:'l',d:'r',W:'u',S:'d',A:'l',D:'r'};

document.addEventListener('keydown',e=>{
  if(phase!=='explore') return;
  const dir=DMAP[e.key];
  if(dir){e.preventDefault();move(dir);return;}
  if(e.key===' '||e.key==='Enter'){e.preventDefault();talk();}
});

['bU','bD','bL','bR'].forEach((id,i)=>{
  const dirs=['u','d','l','r'];
  document.getElementById(id).addEventListener('click',()=>{if(phase==='explore')move(dirs[i]);});
});
document.getElementById('bA').addEventListener('click',()=>{if(phase==='explore')talk();});

// touch swipe on canvas
let tx0,ty0;
cv.addEventListener('touchstart',e=>{tx0=e.touches[0].clientX;ty0=e.touches[0].clientY;e.preventDefault();},{passive:false});
cv.addEventListener('touchend',e=>{
  if(phase!=='explore') return;
  const dx=e.changedTouches[0].clientX-tx0, dy=e.changedTouches[0].clientY-ty0;
  if(Math.abs(dx)<8&&Math.abs(dy)<8){talk();return;}
  Math.abs(dx)>Math.abs(dy)?move(dx>0?'r':'l'):move(dy>0?'d':'u');
  e.preventDefault();
},{passive:false});

function move(dir){
  let nx=pl.x,ny=pl.y;
  if(dir==='u'){ny--;pl.dir='up';}
  if(dir==='d'){ny++;pl.dir='down';}
  if(dir==='l'){nx--;pl.dir='left';}
  if(dir==='r'){nx++;pl.dir='right';}
  if(!passable(nx,ny)) return;
  pl.x=nx; pl.y=ny;
  pickup();
  draw();
  updateTalkBtn();
}

function pickup(){
  IDEF.forEach(it=>{
    if(picked.has(it.id)||it.x!==pl.x||it.y!==pl.y) return;
    picked.add(it.id);
    if(it.type==='herb')    inv.herb++;
    if(it.type==='crystal') inv.crystal++;
    if(it.type==='scroll')  inv.scroll=true;
    popup(it.emoji+' '+it.name+'を手に入れた！（'+it.desc+'）');
    hud();
  });
}

let _talkLock=false;
function popup(msg){
  const el=document.getElementById('ipop');
  el.textContent=msg; el.classList.add('on');
  // アイテム取得直後のSpace誤爆防止（0.6秒ロック）
  _talkLock=true;
  clearTimeout(el._t);
  el._lt=setTimeout(()=>{_talkLock=false;},600);
  el._t=setTimeout(()=>el.classList.remove('on'),2600);
}

// ════════════════════════════════════════════
// DIALOG
// ════════════════════════════════════════════
function talk(){
  if(_talkLock) return;
  const n=NPCS.find(n=>adj(n.x,n.y));
  if(!n) return;
  curNpc=n; dlgIdx=0;
  if(n.priest){openPriest();return;}
  openDlg();
}

function openDlg(){
  const n=curNpc, d=n.dlg[dlgIdx];
  document.getElementById('dlgTitle').textContent=n.emoji+' '+n.name;
  document.getElementById('dlgSp').textContent=n.name;
  document.getElementById('dlgTx').textContent=d.tx;
  const ch=document.getElementById('dlgCh');
  ch.innerHTML='';
  const cls=document.getElementById('dlgCls');
  if(d.ch){
    cls.style.display='none';
    d.ch.forEach(c=>{
      const b=document.createElement('button');
      b.className='cbtn'+(c.bad?' bad':'');
      b.textContent=c.t;
      b.onclick=()=>pick(c);
      ch.appendChild(b);
    });
  } else {
    cls.style.display='block';
    visited.add(n.id); hud();
  }
  phase='dialog';
  document.getElementById('dlgOv').classList.add('on');
}

function pick(c){
  if(c.bad){closeDlg();startCombat(ENEM[c.enemy]||ENEM.slime);return;}
  Object.entries(c.sc||{}).forEach(([k,v])=>sc[k]=(sc[k]||0)+v);
  if(c.healHp){pl.hp=Math.min(pl.mhp,pl.hp+c.healHp);popup('💚 HPが'+c.healHp+'回復した！');}
  if(c.healMp){pl.mp=Math.min(pl.mmp,pl.mp+c.healMp);popup('✨ MPが'+c.healMp+'回復した！');}
  dlgIdx++;
  if(dlgIdx<curNpc.dlg.length){openDlg();}
  else{visited.add(curNpc.id);hud();closeDlg();}
}

function closeDlg(){
  document.getElementById('dlgOv').classList.remove('on');
  phase='explore'; draw();
}

function openPriest(){
  phase='dialog';
  const need=5, got=visited.size;
  if(got<need){
    document.getElementById('dlgTitle').textContent='✝️ 神父のオルフェウス';
    document.getElementById('dlgSp').textContent='神父のオルフェウス';
    document.getElementById('dlgTx').textContent=`まだ村の者たちをよく知らぬようじゃ。もう少し皆と話してから来るがよい。（あと${need-got}人に話しかけよう）`;
    document.getElementById('dlgCh').innerHTML='';
    document.getElementById('dlgCls').style.display='block';
    document.getElementById('dlgOv').classList.add('on');
    return;
  }
  closeDlg();
  phase='fortune';
  document.getElementById('frmOv').classList.add('on');
}

// ════════════════════════════════════════════
// COMBAT
// ════════════════════════════════════════════
function startCombat(en){
  curEn={...en}; enMHp=en.hp; enHp=en.hp;
  phase='combat';
  document.getElementById('cEmo').textContent=en.emoji;
  document.getElementById('cName').textContent=en.name;
  updCbt();
  document.getElementById('cLog').textContent=en.name+'が現れた！';
  document.getElementById('cMag').disabled=pl.mp<5;
  document.getElementById('cItm').disabled=inv.herb<=0;
  document.getElementById('cbtOv').classList.add('on');
}

function updCbt(){
  const p=Math.max(0,enHp/enMHp*100);
  document.getElementById('cHpB').style.width=p+'%';
  document.getElementById('cHpV').textContent='HP '+Math.max(0,enHp)+'/'+enMHp;
  hud();
}

function ca(act){
  const log=document.getElementById('cLog');
  let dmg=0;
  if(act==='atk'){
    dmg=Math.max(1,5+Math.floor(Math.random()*4)-curEn.def);
    enHp-=dmg; updCbt();
    log.textContent='⚔️ '+dmg+'のダメージ！';
  } else if(act==='mag'){
    if(pl.mp<5) return;
    dmg=Math.max(1,9+Math.floor(Math.random()*5)-curEn.def);
    pl.mp-=5; enHp-=dmg; sc.magic=(sc.magic||0)+1;
    updCbt(); log.textContent='✨ 魔法で'+dmg+'のダメージ！';
  } else if(act==='itm'){
    if(inv.herb<=0) return;
    inv.herb--; pl.hp=Math.min(pl.mhp,pl.hp+15);
    updCbt(); log.textContent='🌿 薬草でHPが15回復！';
    setTimeout(enAtk,600); return;
  } else if(act==='run'){
    if(Math.random()<.5){endCbt(false,true);return;}
    log.textContent='逃げられなかった！';
    setTimeout(enAtk,600); return;
  }
  if(enHp<=0){endCbt(true,false);return;}
  setTimeout(enAtk,600);
}

function enAtk(){
  const d=Math.max(1,curEn.atk-1+Math.floor(Math.random()*3));
  pl.hp=Math.max(0,pl.hp-d); updCbt();
  document.getElementById('cLog').textContent=curEn.name+'の攻撃！'+d+'のダメージ！';
  document.getElementById('cMag').disabled=pl.mp<5;
  document.getElementById('cItm').disabled=inv.herb<=0;
  if(pl.hp<=0) setTimeout(()=>endCbt(false,false),600);
}

function endCbt(won,fled){
  document.getElementById('cbtOv').classList.remove('on');
  phase='explore';
  if(won){
    if(curEn.rewT==='herb') inv.herb++;
    if(curEn.rewT==='crystal') inv.crystal++;
    popup('✨ 勝利！'+curEn.rew+'を手に入れた！'); hud();
  } else if(fled){
    popup('💨 逃げ出した…');
  } else {
    pl.hp=Math.floor(pl.mhp*.5);
    popup('😵 宿屋で目が覚めた。HPが回復した。'); hud();
  }
  draw();
}

// ════════════════════════════════════════════
// FORTUNE
// ════════════════════════════════════════════
function calcFortune(){
  const v=document.getElementById('bdate').value;
  if(!v){alert('生年月日を入力してください');return;}
  const[y,m,d]=v.split('-').map(Number);
  const zod=zodiac(m,d);
  const lp=lifePath(y,m,d);
  const job=jobClass();

  let h='';
  h+=rsec('⭐ 星座（生まれの星）','<div class="rbig">'+zod.sym+' '+zod.name+'</div><div class="rsub">'+zod.msg+'</div>');
  h+=rsec('🔢 数秘術（運命数）','<div class="rbig">ライフパス数：'+lp+'</div><div class="rsub">'+lpMsg(lp)+'</div>');
  h+=rsec('⚔️ 隠されたジョブ','<div class="rbig">'+job.emoji+' '+job.name+'</div><div class="rsub">'+job.desc+'</div><div style="margin-top:.4rem">'+job.tags.map(t=>'<span class="rbadge">'+t+'</span>').join('')+'</div>');
  if(inv.crystal>0){
    h+=rsec('💎 魔法石の祝福','<div class="rsub">集めた魔法石が今日の吉方位を示しています。<br>吉方位：<strong style="color:var(--gold)">'+zod.dir+'</strong>　ラッキーカラー：<strong style="color:var(--teal)">'+zod.col+'</strong></div>');
  }
  if(inv.scroll){
    h+=rsec('📜 謎の巻物の啓示','<div class="rsub">'+zod.name+'の旅人よ、運命数'+lp+'と「'+job.name+'」の組み合わせは極めて稀です。'+zod.msg+' そして'+lpMsg(lp)+' この二つの力を持つ'+job.name+'として、あなたの人生は多くの人の光となるでしょう。</div>');
  }
  h+=rsec('💬 神父からの言葉','<div class="rsub">「'+zod.name+'の'+job.name+'よ、'+lp+'の運命数を持つあなたには、'+job.proph+'」</div>');

  document.getElementById('resContent').innerHTML=h;
  document.getElementById('frmOv').classList.remove('on');
  document.getElementById('resOv').classList.add('on');
  phase='result';
  window._shareText=`RPG占い結果：${zod.name}の${job.emoji}${job.name}（運命数${lp}）✨`;
}

function rsec(lbl,body){
  return '<div class="rsec"><div class="rlbl">'+lbl+'</div>'+body+'</div>';
}

function zodiac(m,d){
  const list=[
    {name:'山羊座',sym:'♑',cut:[12,22],msg:'堅実な努力が今まさに実を結ぼうとしています。焦らず自分のペースを守ることが吉。',dir:'北',col:'チャコールグレー'},
    {name:'水瓶座',sym:'♒',cut:[1,20], msg:'革新的な発想があなたを際立たせます。独自の視点を大切に。',dir:'西',col:'エレクトリックブルー'},
    {name:'魚座',  sym:'♓',cut:[2,19], msg:'豊かな感受性と直感があなたの宝。夢を信じてください。',dir:'北西',col:'ラベンダー'},
    {name:'牡羊座',sym:'♈',cut:[3,21], msg:'行動力と情熱があなたの原動力。今こそ前に進む時です。',dir:'東',col:'スカーレット'},
    {name:'牡牛座',sym:'♉',cut:[4,20], msg:'美と豊かさを引き寄せる力があります。感覚を大切に。',dir:'南東',col:'エメラルドグリーン'},
    {name:'双子座',sym:'♊',cut:[5,21], msg:'知識と縁があなたに集まる季節。好奇心のままに動いて。',dir:'南',col:'イエロー'},
    {name:'蟹座',  sym:'♋',cut:[6,22], msg:'家族や大切な人との絆が力の源。直感を信じてください。',dir:'北',col:'シルバー'},
    {name:'獅子座',sym:'♌',cut:[7,23], msg:'自信を持って輝いてください。カリスマが人を動かします。',dir:'南',col:'ゴールド'},
    {name:'乙女座',sym:'♍',cut:[8,23], msg:'細部への注意と誠実さがあなたを高みへ連れていきます。',dir:'北西',col:'ネイビー'},
    {name:'天秤座',sym:'♎',cut:[9,23], msg:'バランスと調和を大切にすることで良縁が訪れます。',dir:'西',col:'ローズピンク'},
    {name:'蠍座',  sym:'♏',cut:[10,24],msg:'深い洞察と変容の力があります。手放すことで扉が開く。',dir:'北',col:'ディープレッド'},
    {name:'射手座',sym:'♐',cut:[11,23],msg:'自由と冒険があなたを成長させます。遠くに目を向けて。',dir:'東南',col:'パープル'},
  ];
  const cuts=[19,18,20,19,20,21,22,22,22,23,21,21];
  let i=(d<=cuts[m-1])?(m-1):m%12;
  return list[i];
}

function lifePath(y,m,d){
  const s=(String(y)+String(m).padStart(2,'0')+String(d).padStart(2,'0')).split('').reduce((a,c)=>a+Number(c),0);
  let n=s;
  while(n>9&&n!==11&&n!==22&&n!==33) n=String(n).split('').reduce((a,c)=>a+Number(c),0);
  return n;
}

function lpMsg(n){
  const m={1:'リーダーシップと独立心の持ち主。道を切り開く力があります。',
    2:'協調性と感受性が豊か。人と人をつなぐ橋渡し役です。',
    3:'創造性と表現力に恵まれています。言葉や芸術で人を惹きつけます。',
    4:'勤勉で信頼性が高い。着実な努力が大きな実りをもたらします。',
    5:'自由と変化を愛する冒険家。多才な才能が世界へ導きます。',
    6:'責任感と愛情深さが魅力。家族や仲間を支える力があります。',
    7:'分析力と直感に優れた探求者。真実の追求があなたを輝かせます。',
    8:'実行力と組織力の持ち主。大きな目標を達成する運命にあります。',
    9:'慈悲と智慧を持つ完成者。人類全体への貢献があなたの使命です。',
    11:'直感と霊感の持ち主。精神的なインスピレーションをもたらします。',
    22:'マスタービルダー。大きな夢を現実に変える力があります。',
    33:'マスターティーチャー。愛と叡智で世界を照らす存在です。'};
  return m[n]||m[n%9]||'特別な運命数を持つあなたは独自の道を歩みます。';
}

function jobClass(){
  const entries=Object.entries(sc).sort((a,b)=>b[1]-a[1]);
  const top=entries[0]?entries[0][0]:'free';
  const jobs={
    battle:{name:'勇者',    emoji:'⚔️',desc:'困難に立ち向かう強さを持ち、周囲を引っ張るリーダー。',tags:['力強さ','勇気','行動力'],proph:'試練を超えるたびに真の輝きを放つでしょう。'},
    magic: {name:'魔法使い',emoji:'🔮',desc:'知識と魔力を操る者。隠された真実を見抜く洞察力を持つ。',tags:['知性','神秘','探求'],proph:'知識の深みに宿る光があなたを照らすでしょう。'},
    wisdom:{name:'賢者',    emoji:'📚',desc:'深い知恵と冷静な判断力で仲間を導く存在。',tags:['叡智','洞察','冷静'],proph:'知恵の言葉が多くの命を救うでしょう。'},
    agility:{name:'盗賊',   emoji:'🗡️',desc:'素早さと機転で道を切り開く天才的な観察眼を持つ。',tags:['俊敏','機転','自由'],proph:'誰も見えない道を切り開いていくでしょう。'},
    heal:  {name:'聖職者',  emoji:'✨',desc:'癒しと光の力で仲間を守る。深い愛情と信念を持つ存在。',tags:['癒し','愛','信念'],proph:'あなたの優しさが世界に平和をもたらすでしょう。'},
    free:  {name:'吟遊詩人',emoji:'🎵',desc:'自由な発想と語りで人々の心を動かす。縛られない精神が武器。',tags:['自由','創造','共感'],proph:'あなたの物語が世界を動かすでしょう。'},
    nature:{name:'薬師',    emoji:'🌿',desc:'自然の力と命の流れを理解する者。地に足のついた知恵で癒す。',tags:['自然','癒し','智慧'],proph:'自然との絆があなたに無限の力を与えるでしょう。'},
  };
  return jobs[top]||jobs.free;
}

// ════════════════════════════════════════════
// SP MENU / RESET
// ════════════════════════════════════════════
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
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
function toggleSpMenu(){document.getElementById('spDropdown').classList.toggle('open');}
document.addEventListener('click',e=>{
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown'))
    document.getElementById('spDropdown').classList.remove('open');
});

function resetGame(){
  pl={x:10,y:9,hp:30,mhp:30,mp:20,mmp:20};
  inv={herb:0,crystal:0,scroll:false};
  picked=new Set(); visited=new Set();
  sc={battle:0,magic:0,wisdom:0,agility:0,heal:0,free:0,nature:0};
  phase='explore';
  document.getElementById('resOv').classList.remove('on');
  document.getElementById('frmOv').classList.remove('on');
  hud(); draw();
}

// ════════════════════════════════════════════
// BGM (Web Audio API チップチューン)
// ════════════════════════════════════════════
let _ac=null, _bgmOn=false, _bgmNodes=[];
const _BPM=112, _B=60/_BPM;

// 村のテーマ メロディー（音名→Hz）
const N={
  C4:261.63,D4:293.66,E4:329.63,F4:349.23,G4:392.00,A4:440.00,B4:493.88,
  C5:523.25,D5:587.33,E5:659.25,G5:783.99,A5:880.00,_:0
};
// [周波数, 音長(拍)]
const MELODY=[
  [N.E5,1],[N.D5,1],[N.C5,2],
  [N.E5,1],[N.G5,1],[N.A5,2],
  [N.G5,1],[N.E5,1],[N.D5,2],
  [N.C5,1],[N.D5,1],[N.E5,1],[N.C5,1],
  [N.E5,1],[N.D5,1],[N.C5,2],
  [N.D5,1],[N.E5,1],[N.F4,2],
  [N.E4,1],[N.F4,1],[N.G4,1],[N.A4,1],
  [N.G4,2],[N.C5,2],
];
const BASS=[
  [N.C4,2],[N.G4,2],[N.A4,2],[N.E4,2],
  [N.F4,2],[N.C4,2],[N.G4,2],[N.G4,2],
];

function _playSeq(notes,type,gain,loop){
  if(!_ac) return null;
  const g=_ac.createGain(); g.gain.value=gain; g.connect(_ac.destination);
  let t=_ac.currentTime+0.05;
  const total=notes.reduce((s,[,d])=>s+d*_B,0);
  function schedule(offset){
    notes.forEach(([freq,dur])=>{
      if(freq===0){t+=dur*_B;return;}
      const o=_ac.createOscillator();
      o.type=type; o.frequency.value=freq;
      const eg=_ac.createGain();
      eg.gain.setValueAtTime(gain,t);
      eg.gain.linearRampToValueAtTime(0,t+dur*_B*0.85);
      o.connect(eg); eg.connect(_ac.destination);
      o.start(t); o.stop(t+dur*_B*0.9);
      t+=dur*_B;
    });
  }
  schedule(0);
  if(loop){
    const id=setInterval(()=>{
      if(!_bgmOn){clearInterval(id);return;}
      schedule(0);
    }, total*1000);
    return id;
  }
  return null;
}

function startBgm(){
  if(!_ac) _ac=new(window.AudioContext||window.webkitAudioContext)();
  if(_ac.state==='suspended') _ac.resume();
  _bgmNodes.forEach(id=>clearInterval(id));
  _bgmNodes=[];
  _bgmNodes.push(_playSeq(MELODY,'square',0.07,true));
  _bgmNodes.push(_playSeq(BASS,'triangle',0.05,true));
}

function stopBgm(){
  _bgmNodes.forEach(id=>clearInterval(id));
  _bgmNodes=[];
  if(_ac) _ac.suspend();
}

function toggleBgm(){
  _bgmOn=!_bgmOn;
  const btn=document.getElementById('bgmBtn');
  if(_bgmOn){
    startBgm();
    btn.textContent='🔊 BGM ON';
    btn.style.color='var(--gold)';
    btn.style.borderColor='rgba(201,168,76,.4)';
  } else {
    stopBgm();
    btn.textContent='🔇 BGM OFF';
    btn.style.color='var(--muted)';
    btn.style.borderColor='var(--border2)';
  }
}

// ════════════════════════════════════════════
// INIT
// ════════════════════════════════════════════
resize();
hud();
window.addEventListener('resize',resize);
</script>
</body>
</html>

