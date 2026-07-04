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
<link rel="canonical" href="https://life-fun.net/sanmei" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="生年月日から算命学の元命・主星・従星を無料で算出。五行バランス・強み・恋愛スタイル・仕事適性まで本格鑑定します。">
<title>算命学｜元命・主星・従星・五行バランスを無料で算出</title>
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
  --sanmei:#2a9d8f;--sanmei2:#3bbcae;--sanmei-bg:rgba(42,157,143,.15);--sanmei-border:rgba(42,157,143,.4);
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
  --wood:#4caf50;--fire:#ef5350;--earth:#ffb300;--metal:#90caf9;--water:#42a5f5;
}
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--bg);color:var(--text);font-family:var(--ff-serif);line-height:1.7;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(42,157,143,.12) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(42,100,143,.10) 0%,transparent 55%);pointer-events:none;z-index:0}
a{color:var(--sanmei2);text-decoration:none}

/* ── Layout ── */
.wrap{position:relative;z-index:1;max-width:860px;margin:0 auto;padding:2rem 1.2rem 4rem}

/* ── HEADER ── */
header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px)}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a,.header-nav span{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold2)}
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
  .sp-dropdown.open{display:block}
  .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold2);background:rgba(201,168,76,.08)}
}

/* ── Page Title ── */
.page-title{text-align:center;padding:2.5rem 0 2rem}
.subtitle{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.22em;color:var(--sanmei2);text-transform:uppercase;margin-bottom:.6rem}
h1{font-size:clamp(1.2rem,3.5vw,1.7rem);letter-spacing:.08em;font-weight:700;line-height:1.4}

/* ── Form card ── */
.form-card{background:var(--surface);border:1px solid var(--border2);border-radius:16px;padding:2rem;max-width:520px;margin:0 auto 2rem;position:relative;overflow:hidden}
.form-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--sanmei),var(--sanmei2),var(--gold))}
.form-section-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--sanmei2);text-align:center;margin-bottom:1.5rem}
.form-group{margin-bottom:1.2rem}
.form-label{display:block;font-size:.75rem;color:var(--muted);margin-bottom:.4rem;letter-spacing:.06em}
.form-input{width:100%;background:rgba(8,6,15,.7);border:1px solid var(--border2);border-radius:8px;padding:.6rem .9rem;color:var(--text);font-family:var(--ff-serif);font-size:.9rem;outline:none;transition:border-color .2s;color-scheme:dark}
.form-input:focus{border-color:var(--sanmei)}
.calc-btn{width:100%;padding:.85rem;background:linear-gradient(135deg,#0d5c54,#2a9d8f);border:1px solid rgba(42,157,143,.5);border-radius:10px;color:#e8f8f7;font-family:var(--ff-serif);font-size:1rem;letter-spacing:.1em;cursor:pointer;margin-top:.5rem;transition:opacity .2s,box-shadow .2s}
.calc-btn:hover{opacity:.9;box-shadow:0 0 20px rgba(42,157,143,.5)}

/* ── Loading ── */
#loadingOverlay{display:none;position:fixed;inset:0;background:rgba(8,6,15,.85);z-index:9999;align-items:center;justify-content:center;flex-direction:column;gap:1rem}
#loadingOverlay.show{display:flex}
.loading-text{font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.2em;color:var(--sanmei2)}
.loading-ring{width:50px;height:50px;border:2px solid rgba(42,157,143,.2);border-top-color:var(--sanmei);border-radius:50%;animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}

/* ── Result ── */
#resultSection{display:none}
.result-title{text-align:center;font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.22em;color:var(--sanmei2);margin-bottom:1.5rem;padding-top:1rem}

/* ── Type card (top) ── */
.type-card{background:linear-gradient(135deg,rgba(42,157,143,.18),rgba(42,100,143,.12));border:1px solid var(--sanmei-border);border-radius:18px;padding:2rem 1.5rem;margin-bottom:2rem;text-align:center;position:relative;overflow:hidden}
.type-card::before{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;background:radial-gradient(circle,rgba(42,157,143,.25),transparent 70%);pointer-events:none}
.type-badge{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.2em;color:var(--sanmei2);background:rgba(42,157,143,.12);border:1px solid var(--sanmei-border);border-radius:20px;padding:.25rem .8rem;display:inline-block;margin-bottom:.8rem}
.type-stars{font-size:1.1rem;color:var(--sanmei2);margin-bottom:.5rem;letter-spacing:.05em}
.type-nickname{font-family:var(--ff-serif);font-size:clamp(1.4rem,4vw,2.2rem);font-weight:700;background:linear-gradient(135deg,var(--sanmei2) 0%,var(--gold2) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem;letter-spacing:.06em}
.type-label{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em}

/* ── Section heading ── */
.section-heading{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--sanmei2);margin-bottom:1rem;padding-bottom:.4rem;border-bottom:1px solid var(--border)}

/* ── Result blocks ── */
.result-block{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.4rem;margin-bottom:1.2rem}
.result-block-title{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.18em;color:var(--sanmei2);margin-bottom:.75rem;text-transform:uppercase}
.result-block-body{font-size:.88rem;color:#d0cae8;line-height:1.85}

/* ── 五行グラフ ── */
.gogyou-section{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.4rem;margin-bottom:1.2rem}
.gogyou-title{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.18em;color:var(--sanmei2);margin-bottom:1rem;text-transform:uppercase}
.gogyou-row{display:flex;align-items:center;gap:.7rem;margin-bottom:.55rem}
.gogyou-label{font-family:var(--ff-serif);font-size:.85rem;font-weight:700;min-width:1.4rem;text-align:center}
.gogyou-bar-wrap{flex:1;background:rgba(255,255,255,.06);border-radius:6px;height:14px;overflow:hidden}
.gogyou-bar{height:100%;border-radius:6px;transition:width .6s ease;min-width:4px}
.gogyou-count{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);min-width:1.5rem;text-align:right}
.gogyou-wood .gogyou-bar{background:linear-gradient(90deg,var(--wood),#81c784)}
.gogyou-fire .gogyou-bar{background:linear-gradient(90deg,var(--fire),#ef9a9a)}
.gogyou-earth .gogyou-bar{background:linear-gradient(90deg,var(--earth),#ffd54f)}
.gogyou-metal .gogyou-bar{background:linear-gradient(90deg,#78909c,var(--metal))}
.gogyou-water .gogyou-bar{background:linear-gradient(90deg,var(--water),#90caf9)}
.gogyou-label.wood{color:var(--wood)}
.gogyou-label.fire{color:var(--fire)}
.gogyou-label.earth{color:var(--earth)}
.gogyou-label.metal{color:var(--metal)}
.gogyou-label.water{color:var(--water)}

/* ── Strength/Weakness list ── */
.strength-list,.weakness-list{list-style:none;display:flex;flex-direction:column;gap:.5rem}
.strength-list li,.weakness-list li{display:flex;align-items:flex-start;gap:.5rem;font-size:.88rem;color:#d0cae8;line-height:1.7}
.strength-list li::before{content:'◎';color:var(--sanmei2);flex-shrink:0;margin-top:.05em}
.weakness-list li::before{content:'△';color:#e57373;flex-shrink:0;margin-top:.05em}

/* ── Jobs grid ── */
.jobs-grid{display:flex;flex-wrap:wrap;gap:.5rem}
.job-tag{background:var(--sanmei-bg);border:1px solid var(--sanmei-border);border-radius:20px;padding:.3rem .85rem;font-size:.8rem;color:var(--sanmei2)}

/* ── 大運テーマ ── */
.daiyun-theme-card{background:linear-gradient(135deg,rgba(42,157,143,.1),rgba(201,168,76,.06));border:1px solid rgba(42,157,143,.25);border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:1.2rem}
.daiyun-theme-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.14em;color:var(--sanmei2);margin-bottom:.4rem}
.daiyun-theme-value{font-family:var(--ff-serif);font-size:1.2rem;font-weight:700;color:var(--gold2);margin-bottom:.3rem}
.daiyun-theme-note{font-size:.8rem;color:var(--muted);line-height:1.7}

/* ── Result code ── */
.result-code-wrap{text-align:center;margin:1.2rem 0}
.result-code{font-family:var(--ff-mono);font-size:.68rem;color:rgba(138,125,181,.6);letter-spacing:.08em;cursor:pointer;transition:color .2s;background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:8px;padding:.4rem .9rem;display:inline-block}
.result-code:hover{color:var(--sanmei2)}
.result-code-tip{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);text-align:center;margin-top:.3rem}

/* ── Share ── */
.share-wrap{text-align:center;margin:1.5rem 0}
.share-label{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.55rem}
.share-btns{display:flex;justify-content:center;gap:.45rem;flex-wrap:wrap}
.share-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.45rem .85rem;border-radius:20px;font-size:.7rem;font-family:var(--ff-mono);cursor:pointer;text-decoration:none;border:none;transition:opacity .2s;white-space:nowrap}
.share-btn:hover{opacity:.8}
.share-x{background:#000;color:#fff}
.share-line{background:#06C755;color:#fff}
.share-copy{background:rgba(42,157,143,.15);border:1px solid rgba(42,157,143,.35)!important;color:var(--sanmei2)}

/* ── Article link box ── */
.article-link-box{display:flex;align-items:center;gap:.9rem;background:rgba(42,157,143,.07);border:1px solid rgba(42,157,143,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.article-link-box:hover{border-color:var(--sanmei2);background:rgba(42,157,143,.14)}
.article-link-icon{font-size:1.4rem;flex-shrink:0}
.article-link-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.article-link-body strong{font-size:.9rem;font-weight:500;color:var(--sanmei2)}
.article-link-body small{font-size:.75rem;color:var(--muted)}
.article-link-arrow{color:var(--sanmei2);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}

/* ── Retry ── */
.retry-wrap{text-align:center;margin:2rem 0}
.retry-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.6rem;border:1px solid var(--border2);border-radius:20px;font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);cursor:pointer;background:none;transition:color .2s,border-color .2s}
.retry-btn:hover{color:var(--text);border-color:var(--sanmei)}

/* ── Disclaimer ── */
.disclaimer{max-width:760px;margin:0 auto 1.5rem;text-align:center;font-size:.7rem;color:var(--muted);line-height:1.8;font-family:var(--ff-mono)}

/* ── AdSense space ── */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem;margin-bottom:1.5rem}
.tool-desc p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.tool-desc p:last-child{margin-bottom:0}

/* ── FOOTER ── */
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
</style>
</head>
<body>

<?php $currentPage='sanmei'; require __DIR__.'/inc/header.php'; ?>

<div id="loadingOverlay">
  <div class="loading-ring"></div>
  <div class="loading-text">算命学で鑑定中...</div>
</div>

<div class="wrap">
  <div class="page-title">
    <div class="subtitle">Sanmei-gaku · 算命学</div>
    <h1>算命学｜元命・主星・従星・五行バランスを無料で算出</h1>
    <p style="font-size:.8rem;color:var(--muted);margin-top:.5rem">
      生年月日から算命学の三星（元命・主星・従星）を算出。<br>五行バランス・強み・恋愛・仕事適性まで本格鑑定します。
    </p>
  </div>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="tool-desc">
    <p>算命学は、古代中国を起源とする東洋占術のひとつで、生年月日から「陰陽五行」のバランスを読み解きます。生まれ持った本質・才能・運気のリズムを、干支の組み合わせから導き出します。</p>
    <p>このセルフ鑑定ツールでは、あなたの「元命・主星・従星」と五行バランスを自動で算出します。自分の強みや個性を知り、日々の暮らしや人間関係を見直すきっかけとしてお役立てください。</p>
  </div>

  <!-- フォーム -->
  <div class="form-card" id="formArea">
    <div class="form-section-label">✦ 生年月日を入力して算命学鑑定 ✦</div>
    <div class="form-group">
      <label class="form-label" for="birthDate">生年月日</label>
      <input type="date" id="birthDate" class="form-input" min="1900-01-01" max="2099-12-31">
    </div>
    <button class="calc-btn" onclick="calcSanmei()">✦ 算命学で鑑定する ✦</button>
  </div>

  <!-- 結果 -->
  <div id="resultSection">
    <div class="result-title">✦ 算命学鑑定結果 ✦</div>

    <!-- タイプカード -->
    <div class="type-card" id="typeCard"></div>

    <!-- 五行グラフ -->
    <div class="gogyou-section" id="gogyouSection"></div>

    <!-- 元命 -->
    <div class="result-block" id="genmeBlock"></div>

    <!-- 強み -->
    <div class="result-block" id="strengthBlock"></div>

    <!-- 弱み -->
    <div class="result-block" id="weaknessBlock"></div>

    <!-- 恋愛スタイル -->
    <div class="result-block" id="loveBlock"></div>

    <!-- 仕事 -->
    <div class="result-block" id="jobsBlock"></div>

    <!-- 人間関係 -->
    <div class="result-block" id="relationsBlock"></div>

    <!-- 大運テーマ -->
    <div class="daiyun-theme-card" id="daiyunBlock"></div>

    <!-- result_code -->
    <div class="result-code-wrap">
      <div id="resultCode" style="display:none"></div>
    </div>

    <!-- シェア -->
    <div class="share-wrap" id="shareWrap"></div>

    <?php
    $articleUrl   = '/articles/sanmei/';
    $articleIcon  = '☯️';
    $articleTitle = '算命学とは？';
    $articleDesc  = '元命・主星・従星・十大主星の意味と計算方法を解説';
    $contextKey   = 'sanmei';
    $retryLabel   = 'もう一度鑑定する';
    $retryType    = 'js';
    $retryValue   = 'resetForm()';
    require __DIR__.'/inc/result-footer.php';
    ?>
  </div>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <p class="disclaimer">
    ※ 年柱の算出には節入り日（立春）を使用しています。2月の節入り前後の方は±1日の誤差が生じる場合があります。<br>
    本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。
  </p>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// ═══════════════════════════════════════════════════
// 基本定数（shichu.phpから流用）
// ═══════════════════════════════════════════════════
const STEMS    = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
const BRANCHES = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
const STEM_ELEM = [0,0,1,1,2,2,3,3,4,4]; // 木木火火土土金金水水
const STEM_YIN  = [0,1,0,1,0,1,0,1,0,1];
const BRANCH_ELEM = [4,2,0,0,2,1,1,2,3,3,2,4];
const ELEM_NAMES = ['木','火','土','金','水'];

// ═══════════════════════════════════════════════════
// 節入り日算出（shichu.phpから流用）
// ═══════════════════════════════════════════════════
function getSolarTermDay(year, month) {
  const C20 = [6.3811,4.6295,6.3826,5.5820,6.3180,6.5000,7.9280,7.9922,8.2587,8.4328,7.3306,7.9584];
  const C21 = [5.4055,3.8708,6.3780,4.8120,5.5200,5.6780,7.1080,7.5008,7.6460,7.9000,6.9000,7.1800];
  const idx = month - 1;
  if (year >= 2000) {
    const Y = year - 2000;
    return Math.floor(C21[idx] + 0.2422 * Y) - Math.floor(Y / 4);
  } else {
    const Y = year - 1900;
    return Math.floor(C20[idx] + 0.2422 * Y) - Math.floor((Y - 1) / 4);
  }
}

// ═══════════════════════════════════════════════════
// 年柱（shichu.phpから流用）
// ═══════════════════════════════════════════════════
function getYearPillar(year, month, day) {
  let y = year;
  const chunDay = getSolarTermDay(year, 2);
  if (month < 2 || (month === 2 && day < chunDay)) y--;
  return { stem: (y - 4 + 600) % 10, branch: (y - 4 + 600) % 12 };
}

// ═══════════════════════════════════════════════════
// 日柱（shichu.phpから流用）
// ═══════════════════════════════════════════════════
function getJDN(year, month, day) {
  const a = Math.floor((14 - month) / 12);
  const y = year + 4800 - a;
  const m = month + 12 * a - 3;
  return day + Math.floor((153 * m + 2) / 5) + 365 * y +
    Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;
}
function getDayPillar(year, month, day) {
  const jdn = getJDN(year, month, day);
  const cycle = (jdn + 49) % 60;
  return { stem: cycle % 10, branch: cycle % 12 };
}

// ═══════════════════════════════════════════════════
// 算命学データ
// ═══════════════════════════════════════════════════

// 元命（日干インデックス 0-9）
const GENME = [
  { id:'GM00', name:'貫索星', prefix:'孤高の',         element:'木', yin:false },
  { id:'GM01', name:'石門星', prefix:'人情厚い',       element:'木', yin:true  },
  { id:'GM02', name:'鳳閣星', prefix:'自由奔放な',     element:'火', yin:false },
  { id:'GM03', name:'調舒星', prefix:'感性豊かな',     element:'火', yin:true  },
  { id:'GM04', name:'禄存星', prefix:'愛情深い',       element:'土', yin:false },
  { id:'GM05', name:'司禄星', prefix:'堅実な',         element:'土', yin:true  },
  { id:'GM06', name:'車騎星', prefix:'情熱的な',       element:'金', yin:false },
  { id:'GM07', name:'牽牛星', prefix:'誠実な',         element:'金', yin:true  },
  { id:'GM08', name:'龍高星', prefix:'探求心旺盛な',   element:'水', yin:false },
  { id:'GM09', name:'玉堂星', prefix:'知性派の',       element:'水', yin:true  },
];

// 主星（年干インデックス 0-9）
const SHUSEI = [
  { id:'SY00', name:'貫索星', suffix:'一匹狼'         },
  { id:'SY01', name:'石門星', suffix:'ムードメーカー' },
  { id:'SY02', name:'鳳閣星', suffix:'クリエイター'   },
  { id:'SY03', name:'調舒星', suffix:'アーティスト'   },
  { id:'SY04', name:'禄存星', suffix:'人気者'         },
  { id:'SY05', name:'司禄星', suffix:'縁の下の力持ち' },
  { id:'SY06', name:'車騎星', suffix:'チャレンジャー' },
  { id:'SY07', name:'牽牛星', suffix:'完璧主義者'     },
  { id:'SY08', name:'龍高星', suffix:'革新者'         },
  { id:'SY09', name:'玉堂星', suffix:'知識人'         },
];

// 従星（日支インデックス 0-11）
const JUSEI = [
  { id:'TJ00', name:'天胡星', energy:'大' },
  { id:'TJ01', name:'天将星', energy:'大' },
  { id:'TJ02', name:'天禄星', energy:'大' },
  { id:'TJ03', name:'天貴星', energy:'中' },
  { id:'TJ04', name:'天恍星', energy:'中' },
  { id:'TJ05', name:'天南星', energy:'中' },
  { id:'TJ06', name:'天涛星', energy:'小' },
  { id:'TJ07', name:'天庫星', energy:'小' },
  { id:'TJ08', name:'天極星', energy:'小' },
  { id:'TJ09', name:'天碍星', energy:'小' },
  { id:'TJ10', name:'天馳星', energy:'中' },
  { id:'TJ11', name:'天印星', energy:'大' },
];

// 元命の解説テキスト
const GENME_DESC = [
  '甲木（貫索星）の日生まれ。大樹のように根を張り、自分の信念に従って生きるタイプです。独立心と自立心が高く、マイペースに自分の道を歩みます。',
  '乙木（石門星）の日生まれ。柔らかな草木のように人の輪に溶け込む調和の達人です。広いネットワークと共感力で、人と人をつなぐ架け橋となります。',
  '丙火（鳳閣星）の日生まれ。太陽のように明るく自由な表現者です。独自の世界観と豊かな想像力で、人を楽しませる才能に恵まれています。',
  '丁火（調舒星）の日生まれ。ろうそくの炎のような繊細な感受性と鋭い美的センスを持ちます。芸術・表現の世界で深い輝きを放つタイプです。',
  '戊土（禄存星）の日生まれ。山のような安定感と包容力で人を守り育てます。面倒見の良さと奉仕の精神が人に慕われる秘訣です。',
  '己土（司禄星）の日生まれ。肥沃な大地のように着実に積み重ねる堅実派です。継続力と計画性で、安定した人生の基盤を築きます。',
  '庚金（車騎星）の日生まれ。刀のような決断力と行動力で道を切り開くタイプです。スピード感ある行動とリーダーシップが武器です。',
  '辛金（牽牛星）の日生まれ。宝石のような高い誠実さとプライドを持ちます。責任感が強く、完璧を追求する完全主義的な気質があります。',
  '壬水（龍高星）の日生まれ。大海のような知的好奇心と探求心を持つ革新者です。未知の世界に踏み込み、独自の哲学を築きます。',
  '癸水（玉堂星）の日生まれ。恵みの雨のような深い知性と洞察力の持ち主です。学びを積み重ね、知識を人に伝える才能に優れています。',
];

// 強み候補（元命インデックス: 5候補）
const STRENGTHS = {
  0: ['自分の信念を貫く強さがある','独自の価値観を持ち流されにくい','一度決めたことをやり遂げる','責任感が強く頼りにされる','自立心が高く一人でも進める'],
  1: ['人の輪の中心になれる','調整力と共感力が高い','仲間を大切にする','チームをまとめる力がある','広いネットワークを持てる'],
  2: ['自由な発想で人を楽しませる','表現力が豊かで個性的','場の雰囲気を明るくできる','多才で様々なことに挑戦できる','直感が鋭く新しいものを掴む'],
  3: ['感性が鋭く独創的な才能がある','芸術・表現分野で光る','深い感受性で人の心を動かす','独自の世界観を持つ','完璧を求める向上心がある'],
  4: ['面倒見が良く人に好かれる','人を助ける奉仕の精神がある','信頼関係を大切にする','共感力が高く相談されやすい','人脈を大切に育てられる'],
  5: ['地道な努力を積み重ねられる','安定した収入を築く力がある','計画的に物事を進められる','堅実で信頼される','継続力と忍耐力が強い'],
  6: ['行動力と突破力が抜群','困難にも怯まない勇気がある','スピード感のある決断ができる','競争に強く結果を出せる','リーダーシップを発揮できる'],
  7: ['責任感が強く誠実','完璧を追求する高い基準がある','信用と評判を大切にする','真面目で信頼される','規律を守り組織に貢献できる'],
  8: ['深く探求する知的好奇心','革新的なアイデアを生み出す','過去の経験から学び成長できる','独自の哲学を持つ','枠を超えた発想ができる'],
  9: ['高い知性と学習能力がある','専門知識を深く蓄積できる','論理的思考力が優れている','知識を人に伝える才能がある','伝統や文化を大切にする'],
};

// 弱み（元命インデックス: 3候補）
const WEAKNESSES = {
  0: ['頑固で人の意見を受け入れにくい','協調性に欠ける場面がある','孤立しやすい'],
  1: ['八方美人になりやすい','自分の意見を主張しにくい','周りに流されることがある'],
  2: ['飽きっぽく継続が苦手','自由すぎて計画性がない','責任から逃げる傾向がある'],
  3: ['感情の波が激しい','神経質になりすぎる','孤独を感じやすい'],
  4: ['人の目を気にしすぎる','お人好しで損をする','依存されやすい'],
  5: ['変化を嫌い保守的になる','慎重すぎてチャンスを逃す','融通がきかない場面がある'],
  6: ['猪突猛進で周りを傷つける','短気で衝動的な行動をする','繊細さが不足する場面がある'],
  7: ['完璧主義で自分を追い詰める','融通がきかない','プライドが高く謝れない場面がある'],
  8: ['現実から浮遊しがち','継続より変化を求めすぎる','人間関係より探求を優先しがち'],
  9: ['頭でっかちで行動が遅い','プライドが高い','理屈っぽくなる場面がある'],
};

// 恋愛スタイル（元命インデックス）
const LOVE_STYLE = [
  '一途で真剣。相手を決めたら全力で向き合います。束縛はしませんが、自分の世界を尊重してほしいタイプ。',
  '恋愛でも友達感覚を大切にします。仲間の延長線上に愛があるタイプで、広い人間関係の中から自然に縁が生まれます。',
  '恋愛を楽しむ自由人。縛られるのが苦手で、お互いの個性を尊重できるパートナーが理想です。',
  '感受性豊かで深い絆を求めます。表面的な付き合いには満足できず、魂レベルで通じ合える相手を探しています。',
  '愛情表現が豊かで尽くすタイプ。相手を大切に育てる愛情深さが魅力ですが、見返りを求めすぎないよう注意。',
  '真面目で安定重視。派手な恋愛より、日々の積み重ねで信頼関係を育てるタイプです。',
  '情熱的でまっすぐ。好きになったら猛アタックするタイプ。スピード感のある恋愛を好みます。',
  '誠実さが武器。約束を守り、きちんとした交際を大切にします。完璧な関係を求める傾向があります。',
  '独自の価値観を持ち、個性的なパートナーに惹かれます。知的な刺激がある関係を好みます。',
  '知性的な会話ができる相手を求めます。深い対話から生まれる精神的なつながりを最も大切にします。',
];

// 仕事適性（元命インデックス: 3種）
const JOBS = [
  ['起業家・フリーランス','専門職（職人・士業）','研究者'],
  ['コンサルタント','人事・採用','コーディネーター'],
  ['クリエイター・芸術家','エンタメ・芸能','企画・マーケター'],
  ['アーティスト・作家','カウンセラー','デザイナー'],
  ['医療・介護職','教育者','ソーシャルワーカー'],
  ['経理・財務','不動産・保険','管理職'],
  ['営業・セールス','スポーツ・武道','警察・消防・自衛隊'],
  ['公務員・官僚','法律・会計','品質管理'],
  ['研究者・学者','IT・エンジニア','探偵・調査員'],
  ['教授・講師','出版・ライター','文化財・歴史研究'],
];

// 人間関係（元命インデックス）
const RELATIONS = [
  '少数の深い友人を大切にするタイプ。広く浅くより、狭く深い人間関係を好みます。',
  '人の輪の中に自然に溶け込めます。誰とでも仲良くなれる社交性が武器ですが、本音を出せる仲間を大切に。',
  '人を楽しませるのが得意。ただし深い関係になるには時間がかかるタイプです。',
  '感受性が豊かで、共感できる人との関係を好みます。傷つきやすい面があるため、安心できる環境が大切。',
  '面倒見が良く慕われます。人のために動くことで関係が深まりますが、自分も大切にしてください。',
  '信頼できる少数の仲間を長く大切にするタイプ。新しい人間関係より既存の絆を深めることを好みます。',
  '行動力でリーダーになりやすい。ただし強引さが出ると周囲との摩擦になることも。',
  '礼儀や誠実さで信頼を得るタイプ。深い人間関係より、誠実な付き合いを大切にします。',
  '知的好奇心で人と繋がります。刺激的な会話ができる人を好みますが、孤独な時間も必要。',
  '知識と経験を分かち合える人との関係を大切にします。師匠と弟子のような関係を好む傾向があります。',
];

// 大運テーマ
const DAIYUN_THEMES = ['挑戦と拡大','基盤形成','成熟と収穫','変革と転換'];

// ═══════════════════════════════════════════════════
// メイン計算
// ═══════════════════════════════════════════════════
function calcSanmei() {
  const dateVal = document.getElementById('birthDate').value;
  if (!dateVal) { alert('生年月日を入力してください'); return; }
  const [year, month, day] = dateVal.split('-').map(Number);
  if (year < 1900 || year > 2099) { alert('1900年〜2099年の範囲で入力してください'); return; }

  document.getElementById('loadingOverlay').classList.add('show');
  setTimeout(() => {
    try {
      _calcAndRender(year, month, day);
    } finally {
      document.getElementById('loadingOverlay').classList.remove('show');
    }
  }, 700);
}

function _calcAndRender(year, month, day) {
  // ── 年柱・日柱算出 ──
  const yp = getYearPillar(year, month, day);
  const dp = getDayPillar(year, month, day);

  // ── 元命・主星・従星 ──
  const genme   = GENME[dp.stem];       // 日干
  const shusei  = SHUSEI[yp.stem];      // 年干
  const jusei   = JUSEI[dp.branch];     // 日支

  // ── 二つ名 ──
  const nickname = genme.prefix + shusei.suffix;

  // ── 五行バランス（年柱+日柱の干支4点） ──
  const elemCounts = [0,0,0,0,0]; // 木火土金水
  elemCounts[STEM_ELEM[yp.stem]]++;
  elemCounts[BRANCH_ELEM[yp.branch]]++;
  elemCounts[STEM_ELEM[dp.stem]]++;
  elemCounts[BRANCH_ELEM[dp.branch]]++;

  // ── result_code ──
  const resultCode = `${genme.id}-${shusei.id}-${jusei.id}-W${elemCounts.join('')}`;

  // ── 大運テーマ ──
  const currentYear = new Date().getFullYear();
  const age = currentYear - year;
  const themeIndex = Math.floor(age / 10) % 4;
  const periodStart = currentYear - (age % 10);
  const periodLabel = `${periodStart}〜${periodStart+9}年のテーマ`;

  // ── 強み（インデックス 0,2,4 を選択） ──
  const strengthArr = STRENGTHS[dp.stem];
  const selectedStrengths = [strengthArr[0], strengthArr[2], strengthArr[4]];

  // ── 弱み（2つ選択） ──
  const weaknessArr = WEAKNESSES[dp.stem];
  const selectedWeaknesses = [weaknessArr[0], weaknessArr[1]];

  // ══ HTML描画 ══

  // タイプカード
  document.getElementById('typeCard').innerHTML = `
    <div class="type-badge">算命学 三星鑑定</div>
    <div class="type-stars">${genme.name}（元命）× ${shusei.name}（主星）× ${jusei.name}（従星）</div>
    <div class="type-nickname">${nickname}</div>
    <div class="type-label">エネルギー：${jusei.energy}　／　五行：${genme.element}（${genme.yin?'陰':'陽'}）</div>
    <div style="margin-top:.8rem;font-family:var(--ff-mono);font-size:.6rem;color:var(--muted)">${year}年${month}月${day}日生まれ</div>
  `;

  // 五行グラフ
  const maxCount = Math.max(...elemCounts, 1);
  const gogyouNames = ['木','火','土','金','水'];
  const gogyouClasses = ['wood','fire','earth','metal','water'];
  let gogyouHTML = `<div class="gogyou-title">五行バランス</div>`;
  elemCounts.forEach((cnt, i) => {
    const pct = Math.round((cnt / maxCount) * 100);
    gogyouHTML += `
      <div class="gogyou-row">
        <div class="gogyou-label ${gogyouClasses[i]}">${gogyouNames[i]}</div>
        <div class="gogyou-bar-wrap gogyou-${gogyouClasses[i]}">
          <div class="gogyou-bar" style="width:${pct}%"></div>
        </div>
        <div class="gogyou-count">${cnt}</div>
      </div>`;
  });
  // 五行解説文
  const gogyouDesc = ['木','火','土','金','水'];
  const gogyouTraits = ['創造力・成長力・柔軟性','情熱・行動力・表現力','安定感・包容力・誠実さ','決断力・効率・集中力','直感力・適応力・知性'];
  const gogyouLack  = ['継続力や粘り強さ','慎重さや客観性','変化への柔軟さ','感受性や協調性','安定感や持続力'];
  const maxElem = elemCounts.indexOf(Math.max(...elemCounts));
  const minElem = elemCounts.indexOf(Math.min(...elemCounts));
  const maxSame = elemCounts.filter(v => v === elemCounts[maxElem]).length;
  let gogyouComment = '';
  if (maxSame >= 4) {
    gogyouComment = `五行がバランス良く分布しています。特定の偏りが少なく、状況に応じて様々な力を発揮できる柔軟なタイプです。`;
  } else {
    gogyouComment = `あなたは「${gogyouDesc[maxElem]}」の気が強く、${gogyouTraits[maxElem]}に優れています。`;
    if (elemCounts[minElem] === 0) {
      gogyouComment += `一方で「${gogyouDesc[minElem]}」が少ないため、${gogyouLack[minElem]}を意識するとさらにバランスが取れるでしょう。`;
    }
  }
  gogyouHTML += `
    <div style="margin-top:.85rem;font-size:.82rem;color:var(--text-lt);line-height:1.85;border-top:1px solid rgba(255,255,255,.07);padding-top:.75rem">${gogyouComment}</div>
    <div style="margin-top:.5rem;font-family:var(--ff-mono);font-size:.6rem;color:var(--muted)">生年月日をもとに算出</div>`;
  document.getElementById('gogyouSection').innerHTML = gogyouHTML;

  // 元命ブロック
  document.getElementById('genmeBlock').innerHTML = `
    <div class="result-block-title">☯ あなたの本質 ─ 元命「${genme.name}」</div>
    <div class="result-block-body">${GENME_DESC[dp.stem]}</div>
    <div style="margin-top:.75rem;display:flex;gap:.5rem;flex-wrap:wrap">
      <span style="font-family:var(--ff-mono);font-size:.65rem;background:var(--sanmei-bg);border:1px solid var(--sanmei-border);border-radius:12px;padding:.2rem .6rem;color:var(--sanmei2)">元命：${genme.name}</span>
      <span style="font-family:var(--ff-mono);font-size:.65rem;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.25);border-radius:12px;padding:.2rem .6rem;color:var(--gold2)">主星：${shusei.name}（${shusei.suffix}）</span>
      <span style="font-family:var(--ff-mono);font-size:.65rem;background:rgba(155,114,239,.1);border:1px solid rgba(155,114,239,.25);border-radius:12px;padding:.2rem .6rem;color:#c4a8f5">従星：${jusei.name}（エネルギー${jusei.energy}）</span>
    </div>
  `;

  // 強みブロック
  document.getElementById('strengthBlock').innerHTML = `
    <div class="result-block-title">◎ あなたの強み</div>
    <ul class="strength-list">
      ${selectedStrengths.map(s => `<li>${s}</li>`).join('')}
    </ul>
  `;

  // 弱みブロック
  document.getElementById('weaknessBlock').innerHTML = `
    <div class="result-block-title">△ 気をつけたい傾向</div>
    <ul class="weakness-list">
      ${selectedWeaknesses.map(w => `<li>${w}</li>`).join('')}
    </ul>
  `;

  // 恋愛ブロック
  document.getElementById('loveBlock').innerHTML = `
    <div class="result-block-title">❤ 恋愛スタイル</div>
    <div class="result-block-body">${LOVE_STYLE[dp.stem]}</div>
  `;

  // 仕事ブロック
  document.getElementById('jobsBlock').innerHTML = `
    <div class="result-block-title">💼 向いている仕事</div>
    <div class="jobs-grid">
      ${JOBS[dp.stem].map(j => `<span class="job-tag">${j}</span>`).join('')}
    </div>
  `;

  // 人間関係ブロック
  document.getElementById('relationsBlock').innerHTML = `
    <div class="result-block-title">👥 人間関係の傾向</div>
    <div class="result-block-body">${RELATIONS[dp.stem]}</div>
  `;

  // 大運テーマ
  document.getElementById('daiyunBlock').innerHTML = `
    <div class="daiyun-theme-label">✦ この10年間のテーマ（${periodLabel}）</div>
    <div class="daiyun-theme-value">${DAIYUN_THEMES[themeIndex]}</div>
    <div class="daiyun-theme-note">算命学では10年ごとに人生のテーマが変わります。現在あなたは「${DAIYUN_THEMES[themeIndex]}」の時期にあたります。</div>
  `;

  // URLにresult_codeを埋め込む
  history.pushState(null, '', '/sanmei?r=' + resultCode);

  // result_code表示（小さくラベルのみ）
  document.getElementById('resultCode').textContent = resultCode;

  // シェアボタン（URLはlocation.hrefを使う → result_code入りURLをシェア）
  renderShareWrap(nickname);

  // 表示切り替え
  document.getElementById('formArea').style.display = 'none';
  scrollToResult('resultSection');
}

// 鑑定結果のシェアボタンを生成（通常診断・?r=復元の両方から呼び出す共通処理）
function renderShareWrap(nickname) {
  const shareText = encodeURIComponent(`私は「${nickname}」タイプでした #算命学診断`);
  const shareUrl = encodeURIComponent(location.href);
  document.getElementById('shareWrap').innerHTML = `
    <div class="share-label">鑑定結果をシェアする</div>
    <div class="share-btns">
      <a href="https://twitter.com/intent/tweet?text=${shareText}&url=${shareUrl}" target="_blank" rel="noopener noreferrer" class="share-btn share-x">𝕏 シェア</a>
      <a href="https://social-plugins.line.me/lineit/share?url=${shareUrl}" target="_blank" rel="noopener noreferrer" class="share-btn share-line">LINE</a>
      <button onclick="openShare('fb')" class="share-btn share-fb">Facebook</button>
      <button onclick="copyPageUrl()" class="share-btn share-copy" id="copyUrlBtn">🔗 URLをコピー</button>
    </div>
  `;
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
  history.pushState(null, '', '/sanmei');
  document.getElementById('formArea').style.display = 'block';
  document.getElementById('resultSection').style.display = 'none';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ページ読み込み時に?r=パラメータがあれば自動で結果表示
(function() {
  const params = new URLSearchParams(location.search);
  const r = params.get('r');
  if (!r) return;
  // GM00-SY00-TJ00-W00000 形式をパース
  const m = r.match(/^GM(\d{2})-SY(\d{2})-TJ(\d{2})-W(\d{5})$/);
  if (!m) return;
  const gmIdx = parseInt(m[1]);
  const syIdx = parseInt(m[2]);
  const tjIdx = parseInt(m[3]);
  const wStr  = m[4];
  if (gmIdx > 9 || syIdx > 9 || tjIdx > 11) return;
  const elemCounts = wStr.split('').map(Number);

  const genme  = GENME[gmIdx];
  const shusei = SHUSEI[syIdx];
  const jusei  = JUSEI[tjIdx];
  const nickname = genme.prefix + shusei.suffix;

  const currentYear = new Date().getFullYear();
  // 大運テーマはresult_codeから生年が取れないためデフォルト表示
  const themeIndex = 0;
  const periodLabel = '現在の大運';

  const strengthArr = STRENGTHS[gmIdx];
  const selectedStrengths = [strengthArr[0], strengthArr[2], strengthArr[4]];
  const weaknessArr = WEAKNESSES[gmIdx];
  const selectedWeaknesses = [weaknessArr[0], weaknessArr[1]];

  // タイプカード
  document.getElementById('typeCard').innerHTML = `
    <div class="type-badge">算命学 三星鑑定</div>
    <div class="type-stars">${genme.name}（元命）× ${shusei.name}（主星）× ${jusei.name}（従星）</div>
    <div class="type-nickname">${nickname}</div>
    <div class="type-label">エネルギー：${jusei.energy}　／　五行：${genme.element}（${genme.yin?'陰':'陽'}）</div>
  `;

  // 五行グラフ
  const maxCount = Math.max(...elemCounts, 1);
  const gogyouNames = ['木','火','土','金','水'];
  const gogyouClasses = ['wood','fire','earth','metal','water'];
  let gogyouHTML = `<div class="gogyou-title">五行バランス</div>`;
  elemCounts.forEach((cnt, i) => {
    const pct = Math.round((cnt / maxCount) * 100);
    gogyouHTML += `<div class="gogyou-row"><div class="gogyou-label ${gogyouClasses[i]}">${gogyouNames[i]}</div><div class="gogyou-bar-wrap gogyou-${gogyouClasses[i]}"><div class="gogyou-bar" style="width:${pct}%"></div></div><div class="gogyou-count">${cnt}</div></div>`;
  });
  const gogyouDesc2 = ['木','火','土','金','水'];
  const gogyouTraits2 = ['創造力・成長力・柔軟性','情熱・行動力・表現力','安定感・包容力・誠実さ','決断力・効率・集中力','直感力・適応力・知性'];
  const gogyouLack2  = ['継続力や粘り強さ','慎重さや客観性','変化への柔軟さ','感受性や協調性','安定感や持続力'];
  const maxElem2 = elemCounts.indexOf(Math.max(...elemCounts));
  const minElem2 = elemCounts.indexOf(Math.min(...elemCounts));
  const maxSame2 = elemCounts.filter(v => v === elemCounts[maxElem2]).length;
  let gogyouComment2 = '';
  if (maxSame2 >= 4) {
    gogyouComment2 = `五行がバランス良く分布しています。特定の偏りが少なく、状況に応じて様々な力を発揮できる柔軟なタイプです。`;
  } else {
    gogyouComment2 = `あなたは「${gogyouDesc2[maxElem2]}」の気が強く、${gogyouTraits2[maxElem2]}に優れています。`;
    if (elemCounts[minElem2] === 0) {
      gogyouComment2 += `一方で「${gogyouDesc2[minElem2]}」が少ないため、${gogyouLack2[minElem2]}を意識するとさらにバランスが取れるでしょう。`;
    }
  }
  gogyouHTML += `<div style="margin-top:.85rem;font-size:.82rem;color:var(--text-lt);line-height:1.85;border-top:1px solid rgba(255,255,255,.07);padding-top:.75rem">${gogyouComment2}</div><div style="margin-top:.5rem;font-family:var(--ff-mono);font-size:.6rem;color:var(--muted)">生年月日をもとに算出</div>`;
  document.getElementById('gogyouSection').innerHTML = gogyouHTML;

  document.getElementById('genmeBlock').innerHTML = `<div class="result-block-title">☯ あなたの本質 ─ 元命「${genme.name}」</div><div class="result-block-body">${GENME_DESC[gmIdx]}</div>`;
  document.getElementById('strengthBlock').innerHTML = `<div class="result-block-title">◎ あなたの強み</div><ul class="strength-list">${selectedStrengths.map(s=>`<li>${s}</li>`).join('')}</ul>`;
  document.getElementById('weaknessBlock').innerHTML = `<div class="result-block-title">△ 気をつけたい傾向</div><ul class="weakness-list">${selectedWeaknesses.map(w=>`<li>${w}</li>`).join('')}</ul>`;
  document.getElementById('loveBlock').innerHTML = `<div class="result-block-title">❤ 恋愛スタイル</div><div class="result-block-body">${LOVE_STYLE[gmIdx]}</div>`;
  document.getElementById('jobsBlock').innerHTML = `<div class="result-block-title">💼 向いている仕事</div><div class="jobs-grid">${JOBS[gmIdx].map(j=>`<span class="job-tag">${j}</span>`).join('')}</div>`;
  document.getElementById('relationsBlock').innerHTML = `<div class="result-block-title">👥 人間関係の傾向</div><div class="result-block-body">${RELATIONS[gmIdx]}</div>`;
  document.getElementById('daiyunBlock').innerHTML = `<div class="daiyun-theme-label">✦ 現在の大運テーマ</div><div class="daiyun-theme-value">${DAIYUN_THEMES[themeIndex]}</div>`;
  document.getElementById('resultCode').textContent = r;

  renderShareWrap(nickname);

  document.getElementById('formArea').style.display = 'none';
  scrollToResult('resultSection');
})();
</script>
</body>
</html>
