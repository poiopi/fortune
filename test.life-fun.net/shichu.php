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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="生年月日と生まれた時間から四柱推命の命式を無料で算出。年柱・月柱・日柱・時柱・十神・大運をすべて表示します。">
<title>四柱推命｜命式・十神・大運を無料で算出</title>
<link rel="canonical" href="https://life-fun.net/shichu" />
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
:root{
  --bg:#08060f;--surface:#100c1e;--surface2:#16112b;--border:rgba(155,114,239,.18);--border2:rgba(155,114,239,.3);
  --text:#e8e0f8;--muted:#8a7db5;--violet:#9b72ef;--gold:#c9a84c;--gold2:#e8d48a;
  --ff-serif:'Shippori Mincho',serif;--ff-mono:'DM Mono',monospace;
  --wood:#4caf50;--fire:#ef5350;--earth:#ffb300;--metal:#90caf9;--water:#42a5f5;
}
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--bg);color:var(--text);font-family:var(--ff-serif);line-height:1.7;min-height:100vh}
a{color:var(--violet);text-decoration:none}
/* ── Layout ── */
.wrap{max-width:860px;margin:0 auto;padding:2rem 1.2rem 4rem}
/* ── Page title ── */
.page-title{text-align:center;padding:2.5rem 0 2rem}
.subtitle{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.22em;color:var(--gold);text-transform:uppercase;margin-bottom:.6rem}
h1{font-size:clamp(1.2rem,3.5vw,1.7rem);letter-spacing:.08em;font-weight:700;line-height:1.4}
/* ── Form card ── */
.form-card{background:var(--surface);border:1px solid var(--border2);border-radius:16px;padding:2rem;max-width:560px;margin:0 auto 2rem}
.form-section-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.2em;color:var(--gold);text-align:center;margin-bottom:1.5rem}
.form-group{margin-bottom:1.2rem}
.form-label{display:block;font-size:.75rem;color:var(--muted);margin-bottom:.4rem;letter-spacing:.06em}
.form-input{width:100%;background:rgba(8,6,15,.7);border:1px solid var(--border2);border-radius:8px;padding:.6rem .9rem;color:var(--text);font-family:var(--ff-serif);font-size:.9rem;outline:none;transition:border-color .2s;color-scheme:dark}
.form-input:focus{border-color:var(--violet)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
@media(max-width:480px){.form-row{grid-template-columns:1fr}}
.radio-group{display:flex;gap:1rem;flex-wrap:wrap}
.radio-label{display:flex;align-items:center;gap:.4rem;cursor:pointer;font-size:.85rem;color:var(--muted);transition:color .2s}
.radio-label input{accent-color:var(--violet)}
.radio-label:has(input:checked){color:var(--text)}
.time-note{font-size:.7rem;color:var(--muted);margin-top:.3rem;font-family:var(--ff-mono)}
.calc-btn{width:100%;padding:.85rem;background:linear-gradient(135deg,#3a1a7a,#6a30c0);border:1px solid rgba(155,114,239,.5);border-radius:10px;color:#e8e0f8;font-family:var(--ff-serif);font-size:1rem;letter-spacing:.1em;cursor:pointer;margin-top:.5rem;transition:opacity .2s,box-shadow .2s}
.calc-btn:hover{opacity:.9;box-shadow:0 0 20px rgba(155,114,239,.4)}
/* ── Result ── */
#resultSection{display:none}
.result-title{text-align:center;font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.22em;color:var(--gold);margin-bottom:1.5rem;padding-top:1rem}
/* ── 命式盤（4柱カード） ── */
.meishiki-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.7rem;margin-bottom:2rem}
@media(max-width:520px){.meishiki-grid{grid-template-columns:repeat(2,1fr)}}
.pillar-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;overflow:hidden;display:flex;flex-direction:column}
.pillar-card.is-day{border-color:var(--gold);box-shadow:0 0 18px rgba(201,168,76,.18)}
.pillar-card.no-time{opacity:.45;border-style:dashed}
.pillar-header{padding:.5rem .7rem .4rem;background:var(--surface2);display:flex;flex-direction:column;align-items:center;gap:.2rem;border-bottom:1px solid var(--border)}
.pillar-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.16em;color:var(--muted)}
.pillar-god{font-size:.68rem;padding:.1rem .55rem;border-radius:20px;font-family:var(--ff-mono);letter-spacing:.06em}
.pillar-god-day{background:rgba(201,168,76,.2);color:var(--gold);border:1px solid rgba(201,168,76,.35)}
.pillar-god-other{background:var(--surface);color:var(--muted);border:1px solid var(--border)}
.pillar-body{flex:1;display:flex;flex-direction:column;align-items:center;padding:.9rem .5rem .7rem;gap:.1rem}
.pillar-kan{font-size:2.6rem;font-weight:700;line-height:1;letter-spacing:-.02em}
.pillar-elem{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);margin-bottom:.4rem}
.pillar-hr{width:60%;height:1px;background:var(--border);margin:.3rem 0}
.pillar-shi{font-size:2.2rem;font-weight:700;line-height:1}
.pillar-shelem{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted)}
.pillar-zang{padding:.5rem .7rem .6rem;border-top:1px solid var(--border);background:rgba(8,6,15,.3)}
.pillar-zang-label{font-family:var(--ff-mono);font-size:.54rem;letter-spacing:.12em;color:var(--muted);margin-bottom:.25rem}
.pillar-zang-list{display:flex;flex-wrap:wrap;gap:.25rem .5rem;align-items:baseline}
.pillar-zang-list .zs{font-size:.82rem;font-weight:700}
.pillar-zang-list .zg{font-size:.55rem;color:var(--muted);font-family:var(--ff-mono)}
/* Element colors */
.e-wood{color:var(--wood)}.e-fire{color:var(--fire)}.e-earth{color:var(--earth)}.e-metal{color:var(--metal)}.e-water{color:var(--water)}
.bg-wood{background:rgba(76,175,80,.12)}.bg-fire{background:rgba(239,83,80,.12)}.bg-earth{background:rgba(255,179,0,.12)}.bg-metal{background:rgba(144,202,249,.12)}.bg-water{background:rgba(66,165,245,.12)}
/* ── 日主カード ── */
.nichishu-card{background:var(--surface);border:1px solid var(--border2);border-radius:12px;padding:1.5rem;margin-bottom:2rem}
.nichishu-header{display:flex;align-items:center;gap:1rem;margin-bottom:1rem}
.nichishu-kan{font-size:3rem;font-weight:700;line-height:1}
.nichishu-info h3{font-size:.85rem;letter-spacing:.06em;margin-bottom:.2rem}
.nichishu-info .strength{font-family:var(--ff-mono);font-size:.65rem;padding:.2rem .6rem;border-radius:20px;display:inline-block}
.strength-strong{background:rgba(201,168,76,.2);color:var(--gold);border:1px solid rgba(201,168,76,.3)}
.strength-mid{background:rgba(155,114,239,.15);color:var(--violet);border:1px solid var(--border2)}
.strength-weak{background:rgba(66,165,245,.15);color:#90caf9;border:1px solid rgba(66,165,245,.2)}
.nichishu-desc{font-size:.82rem;color:var(--muted);line-height:1.8}
/* ── 十神 ── */
.jusshin-section{margin-bottom:2rem}
.section-heading{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--gold);margin-bottom:1rem;padding-bottom:.4rem;border-bottom:1px solid var(--border)}
.jusshin-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.7rem}
.jusshin-item{background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:.7rem .9rem}
.jusshin-label{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);margin-bottom:.2rem;letter-spacing:.08em}
.jusshin-name{font-size:.95rem;font-weight:700;margin-bottom:.15rem}
.jusshin-pos{font-size:.7rem;color:var(--muted)}
/* ── 大運 ── */
.daiyun-section{margin-bottom:2rem}
.daiyun-meta{font-size:.78rem;color:var(--muted);margin-bottom:1rem;font-family:var(--ff-mono);letter-spacing:.06em}
.daiyun-scroll{overflow-x:auto}
.daiyun-list{display:flex;gap:.7rem;min-width:max-content;padding-bottom:.5rem}
/* ── 4柱ガイド ── */
.guide-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.2rem 1.4rem;margin-bottom:1.5rem}
.guide-title{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.16em;color:var(--muted);text-align:center;margin-bottom:.9rem}
.guide-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.6rem}
@media(max-width:520px){.guide-grid{grid-template-columns:repeat(2,1fr)}}
.guide-item{background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:.7rem .8rem}
.guide-item.is-day-guide{border-color:var(--gold);background:rgba(201,168,76,.06)}
.guide-pillar-name{font-family:var(--ff-mono);font-size:.7rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
.guide-pillar-desc{font-size:.72rem;color:var(--muted);line-height:1.7}
/* ── 天中殺・律音 ── */
.tcs-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.2rem 1.4rem;margin-bottom:1.5rem}
.tcs-row{display:flex;flex-wrap:wrap;gap:1rem}
.tcs-block{flex:1;min-width:200px}
.tcs-label{font-family:var(--ff-mono);font-size:.64rem;letter-spacing:.1em;color:var(--muted);margin-bottom:.35rem}
.tcs-value{font-size:1rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
.tcs-note{font-size:.73rem;color:var(--muted);line-height:1.75;margin-bottom:.3rem}
/* ── 現在大運コメント ── */
.daiyun-current-desc{background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem}
.cur-dy-title{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.1em;color:var(--gold);margin-bottom:.6rem}
.cur-dy-kanshi{font-size:2rem;font-weight:700;margin-bottom:.6rem;line-height:1}
.cur-dy-row{display:flex;align-items:flex-start;gap:.6rem;margin-bottom:.4rem}
.cur-dy-badge{font-family:var(--ff-mono);font-size:.58rem;padding:.15rem .5rem;border-radius:10px;white-space:nowrap;margin-top:.1rem;flex-shrink:0}
.cur-dy-text{font-size:.75rem;color:var(--muted);line-height:1.75}
/* ── 十二運星 凡例 ── */
.juni-legend{background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:1rem 1.2rem;margin-top:.8rem}
.legend-title{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.14em;color:var(--muted);margin-bottom:.7rem}
.legend-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.4rem .8rem}
@media(min-width:600px){.legend-grid{grid-template-columns:repeat(3,1fr)}}
.legend-item{display:flex;gap:.4rem;align-items:baseline}
.legend-name{font-family:var(--ff-mono);font-size:.7rem;font-weight:700;color:var(--gold);white-space:nowrap;min-width:2.2rem}
.legend-desc{font-size:.7rem;color:var(--muted);line-height:1.6}
.daiyun-item{background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:.7rem .6rem;width:96px;text-align:center;flex-shrink:0}
.daiyun-item.current-daiyun{border-color:var(--gold);background:rgba(201,168,76,.08)}
.daiyun-age{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);margin-bottom:.25rem}
.daiyun-kan{font-size:1.3rem;font-weight:700;line-height:1.1}
.daiyun-shi{font-size:1.2rem;font-weight:700;line-height:1.1;margin-bottom:.25rem}
.daiyun-period{font-family:var(--ff-mono);font-size:.55rem;color:var(--muted);margin-bottom:.3rem}
.daiyun-tags{display:flex;flex-direction:column;gap:.2rem;align-items:center}
.daiyun-tag{font-family:var(--ff-mono);font-size:.56rem;padding:.1rem .4rem;border-radius:10px;white-space:nowrap}
.tag-god{background:rgba(155,114,239,.15);color:var(--violet);border:1px solid rgba(155,114,239,.2)}
.tag-juni{background:rgba(201,168,76,.12);color:var(--gold);border:1px solid rgba(201,168,76,.2)}
/* ── 今年の運勢 ── */
.nenun-card{background:var(--surface);border:1px solid var(--border2);border-radius:12px;padding:1.4rem;margin-bottom:2rem}
.nenun-year{font-family:var(--ff-mono);font-size:.65rem;color:var(--gold);margin-bottom:.5rem;letter-spacing:.1em}
.nenun-kanshi{font-size:1.5rem;font-weight:700;margin-bottom:.5rem}
.nenun-desc{font-size:.82rem;color:var(--muted);line-height:1.8}
/* ── Retry ── */
.retry-wrap{text-align:center;margin:2rem 0}
.retry-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.6rem;border:1px solid var(--border2);border-radius:20px;font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);cursor:pointer;background:none;transition:color .2s,border-color .2s}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}
/* ── Disclaimer ── */
.disclaimer{max-width:760px;margin:0 auto 1.5rem;text-align:center;font-size:.7rem;color:var(--muted);line-height:1.8;font-family:var(--ff-mono)}
/* ── Loading ── */
#loadingOverlay{display:none;position:fixed;inset:0;background:rgba(8,6,15,.85);z-index:9999;align-items:center;justify-content:center;flex-direction:column;gap:1rem}
#loadingOverlay.show{display:flex}
.loading-text{font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.2em;color:var(--gold)}
.loading-ring{width:50px;height:50px;border:2px solid rgba(155,114,239,.2);border-top-color:var(--violet);border-radius:50%;animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}

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

/* ── FOOTER ── */
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
</style>
</head>
<body>
<?php $currentPage='shichu'; require __DIR__.'/inc/header.php'; ?>

<div id="loadingOverlay">
  <div class="loading-ring"></div>
  <div class="loading-text">命式を算出中...</div>
</div>

<div class="wrap">
  <div class="page-title">
    <div class="subtitle">Shichusuimei · 四柱推命</div>
    <h1>四柱推命｜命式・十神・大運を無料で算出</h1>
    <p style="font-size:.8rem;color:var(--muted);margin-top:.5rem">
      生年月日と生まれた時間から命式を算出。<br>十神・大運・今年の運勢まで本格鑑定します。
    </p>
  </div>

  <!-- フォーム -->
  <div class="form-card" id="formArea">
    <div class="form-section-label">✦ 生年月日を入力して命式を算出 ✦</div>

    <div class="form-group">
      <label class="form-label" for="userName">お名前（任意）</label>
      <input type="text" id="userName" class="form-input" placeholder="例：山田 太郎">
    </div>

    <div class="form-group">
      <label class="form-label">性別</label>
      <div class="radio-group">
        <label class="radio-label"><input type="radio" name="gender" value="male" checked> 男性</label>
        <label class="radio-label"><input type="radio" name="gender" value="female"> 女性</label>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="birthDate">生年月日</label>
      <input type="date" id="birthDate" class="form-input" min="1900-01-01" max="2099-12-31">
    </div>

    <div class="form-group">
      <label class="form-label" for="birthHour">生まれた時間（わかる場合）</label>
      <select id="birthHour" class="form-input">
        <option value="-1">不明（時柱を除いて鑑定）</option>
        <option value="0">0時台（00:00〜00:59）</option>
        <option value="1">1時台（01:00〜01:59）</option>
        <option value="2">2時台（02:00〜02:59）</option>
        <option value="3">3時台（03:00〜03:59）</option>
        <option value="4">4時台（04:00〜04:59）</option>
        <option value="5">5時台（05:00〜05:59）</option>
        <option value="6">6時台（06:00〜06:59）</option>
        <option value="7">7時台（07:00〜07:59）</option>
        <option value="8">8時台（08:00〜08:59）</option>
        <option value="9">9時台（09:00〜09:59）</option>
        <option value="10">10時台（10:00〜10:59）</option>
        <option value="11">11時台（11:00〜11:59）</option>
        <option value="12">12時台（12:00〜12:59）</option>
        <option value="13">13時台（13:00〜13:59）</option>
        <option value="14">14時台（14:00〜14:59）</option>
        <option value="15">15時台（15:00〜15:59）</option>
        <option value="16">16時台（16:00〜16:59）</option>
        <option value="17">17時台（17:00〜17:59）</option>
        <option value="18">18時台（18:00〜18:59）</option>
        <option value="19">19時台（19:00〜19:59）</option>
        <option value="20">20時台（20:00〜20:59）</option>
        <option value="21">21時台（21:00〜21:59）</option>
        <option value="22">22時台（22:00〜22:59）</option>
        <option value="23">23時台（23:00〜23:59）</option>
      </select>
      <div class="time-note">※ 時間がわからない場合は3柱（年・月・日）で鑑定します</div>
    </div>

    <button class="calc-btn" onclick="calcShichu()">✦ 命式を算出する ✦</button>
  </div>

  <!-- 結果 -->
  <div id="resultSection">
    <div class="result-title">✦ 命式鑑定結果 ✦</div>

    <!-- 命式盤 -->
    <div class="meishiki-grid" id="meishikiGrid"></div>

    <!-- 4柱の読み方 -->
    <div id="pillarsGuide" class="guide-card"></div>

    <!-- 日主カード -->
    <div class="nichishu-card" id="nichishuCard"></div>

    <!-- 天中殺・律音 -->
    <div id="tenchusatsuCard"></div>

    <!-- 十神 -->
    <div class="jusshin-section">
      <div class="section-heading">✦ 十神（通変星） ✦</div>
      <div class="jusshin-grid" id="jusshinGrid"></div>
    </div>

    <!-- 大運 -->
    <div class="daiyun-section">
      <div class="section-heading">✦ 大運（10年ごとの運勢サイクル） ✦</div>
      <div class="daiyun-meta" id="daiyunMeta"></div>
      <div class="daiyun-scroll">
        <div class="daiyun-list" id="daiyunList"></div>
      </div>
      <div id="daiyunCurrentDesc" class="daiyun-current-desc"></div>
      <div class="juni-legend" id="juniLegend"></div>
    </div>

    <!-- 今年の運勢 -->
    <div class="nenun-card" id="nenunCard"></div>

    <?php require __DIR__.'/inc/share-btns.php'; ?>
    <?php
    $articleUrl   = '/articles/shichu/';
    $articleIcon  = '☯️';
    $articleTitle = '四柱推命とは？';
    $articleDesc  = '命式・十干・十二支・通変星の意味をわかりやすく解説';
    $contextKey   = 'shichu';
    $retryLabel   = 'もう一度算出する';
    $retryType    = 'js';
    $retryValue   = 'resetForm()';
    require __DIR__.'/inc/result-footer.php';
    ?>
  </div>

  <p class="disclaimer">
    ※ 月柱の算出には節入り日（二十四節気）を使用しています。生まれた日が節入り日当日の場合、±1日の誤差が生じる場合があります。<br>
    本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。
  </p>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// ═══════════════════════════════════════════════════
// 基本定数
// ═══════════════════════════════════════════════════
const STEMS    = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
const BRANCHES = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
const ELEMENTS = ['木','火','土','金','水'];
const STEM_ELEM = [0,0,1,1,2,2,3,3,4,4]; // 甲乙=木, 丙丁=火, 戊己=土, 庚辛=金, 壬癸=水
const STEM_YIN  = [0,1,0,1,0,1,0,1,0,1]; // 0=陽, 1=陰
const BRANCH_ELEM = [4,2,0,0,2,1,1,2,3,3,2,4]; // 子=水,丑=土,寅=木,卯=木,辰=土,巳=火,午=火,未=土,申=金,酉=金,戌=土,亥=水
const ELEM_COLOR = ['e-wood','e-fire','e-earth','e-metal','e-water'];
const ELEM_BG    = ['bg-wood','bg-fire','bg-earth','bg-metal','bg-water'];

// 蔵干（主気）
const ZANGGAN_MAIN = [8,5,0,1,4,2,3,5,6,7,4,8];
// 蔵干（全蔵干）branch -> [主気, 中気?, 余気?]
const ZANGGAN = [
  [8,9],     // 子: 壬,癸
  [5,9,7],   // 丑: 己,癸,辛
  [0,2,4],   // 寅: 甲,丙,戊
  [1],       // 卯: 乙
  [4,1,9],   // 辰: 戊,乙,癸
  [2,4,6],   // 巳: 丙,戊,庚
  [3,5],     // 午: 丁,己
  [5,3,1],   // 未: 己,丁,乙
  [6,8,4],   // 申: 庚,壬,戊
  [7],       // 酉: 辛
  [4,7,3],   // 戌: 戊,辛,丁
  [8,0],     // 亥: 壬,甲
];

// ═══════════════════════════════════════════════════
// 節入り日算出（二十四節気の「節」12個）
// ═══════════════════════════════════════════════════
// 各月の「節」： 1月=小寒, 2月=立春, 3月=驚蟄, 4月=清明, 5月=立夏, 6月=芒種
//              7月=小暑, 8月=立秋, 9月=白露, 10月=寒露, 11月=立冬, 12月=大雪
function getSolarTermDay(year, month) {
  // C1定数（20世紀・21世紀）
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
// 年柱
// ═══════════════════════════════════════════════════
function getYearPillar(year, month, day) {
  // 立春（2月の節入り）前は前年の干支
  let y = year;
  const chunDay = getSolarTermDay(year, 2);
  if (month < 2 || (month === 2 && day < chunDay)) y--;
  return { stem: (y - 4 + 600) % 10, branch: (y - 4 + 600) % 12 };
}

// ═══════════════════════════════════════════════════
// 月柱
// ═══════════════════════════════════════════════════
// 月支: 1月節(小寒後)=丑, 2月節(立春後)=寅, ..., 12月節(大雪後)=子
const MONTH_BRANCH = [1,2,3,4,5,6,7,8,9,10,11,0]; // month 1-12 → branch after 節
function getMonthPillar(year, month, day, yearStem) {
  const termDay = getSolarTermDay(year, month);
  let m = month;
  let y = year;
  if (day < termDay) {
    // 前月の節
    m--;
    if (m === 0) { m = 12; y--; }
  }
  // 月支
  const branch = MONTH_BRANCH[m - 1];
  // 月干: 五虎遁年（年干 % 5 → 寅月の干）
  // 甲己年→丙寅, 乙庚年→戊寅, 丙辛年→庚寅, 丁壬年→壬寅, 戊癸年→甲寅
  const monthStartStems = [2, 4, 6, 8, 0]; // 丙,戊,庚,壬,甲
  const yStem = (y - 4 + 600) % 10;
  // 寅月=branch2, 月支順でのインデックス(寅月から数えた歩数)
  // 寅=2, 卯=3,...→ branch - 2, ただし丑=1は-1なので+12してmod12
  const monthOffset = (branch - 2 + 12) % 12;
  const stem = (monthStartStems[yStem % 5] + monthOffset) % 10;
  return { stem, branch };
}

// ═══════════════════════════════════════════════════
// 日柱（ユリウス通日を使用）
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
  // 校正: 1900/1/1 = 甲戌 (stem=0, branch=10, cycle=10)
  // JDN(1900/1/1)=2415021, (2415021+offset)%60=10 → offset=49
  const cycle = (jdn + 49) % 60;
  return { stem: cycle % 10, branch: cycle % 12 };
}

// ═══════════════════════════════════════════════════
// 時柱
// ═══════════════════════════════════════════════════
// 時支: 子=23-1時, 丑=1-3時, 寅=3-5時, ...
function getHourBranch(hour) {
  if (hour === 23) return 0; // 子
  return Math.floor((hour + 1) / 2);
}
function getHourPillar(hour, dayStem) {
  const branch = getHourBranch(hour);
  // 五鼠遁日: 甲己日→甲子時, 乙庚日→丙子時, 丙辛日→戊子時, 丁壬日→庚子時, 戊癸日→壬子時
  const startStems = [0, 2, 4, 6, 8];
  const stem = (startStems[dayStem % 5] + branch) % 10;
  return { stem, branch };
}

// ═══════════════════════════════════════════════════
// 十神（通変星）
// ═══════════════════════════════════════════════════
const JUSSHIN_NAMES = ['比肩','劫財','食神','傷官','偏財','正財','偏官','正官','偏印','印綬'];
const JUSSHIN_MEANINGS = [
  '自立心・独立・競争心。同じ価値観を持つ仲間。',
  '行動力・積極性。時に強引さも。友人・兄弟の星。',
  '才能・表現力・自由。芸術や趣味の才能。',
  '個性・反骨精神。型破りな才能と変革の力。',
  '財運・投資力。流動的な収入と行動範囲の広さ。',
  '安定した財運・誠実さ。正当な努力による収入。',
  '権力・克己心（七殺）。強いプレッシャーと変革。',
  '名誉・規律・責任感。社会的地位と信用の星。',
  '直感・独創性（梟神）。時に常識にとらわれない発想。',
  '知恵・保護・学習能力。母性・育成の才能。',
];
function getTenGod(dayStem, otherStem) {
  if (dayStem === otherStem) return 0; // 比肩（同じ干は比肩扱い）
  const de = STEM_ELEM[dayStem], dy = STEM_YIN[dayStem];
  const oe = STEM_ELEM[otherStem], oy = STEM_YIN[otherStem];
  const same = dy === oy;
  if (de === oe) return same ? 0 : 1;           // 比肩/劫財
  if ((de + 1) % 5 === oe) return same ? 2 : 3; // 食神/傷官
  if ((de + 2) % 5 === oe) return same ? 4 : 5; // 偏財/正財
  if ((de + 3) % 5 === oe) return same ? 6 : 7; // 偏官/正官
  if ((de + 4) % 5 === oe) return same ? 8 : 9; // 偏印/印綬
  return -1;
}

// ═══════════════════════════════════════════════════
// 日主の強弱
// ═══════════════════════════════════════════════════
function getDayStrength(dayStem, monthBranch, allStems, allBranches) {
  const de = STEM_ELEM[dayStem];
  // 月支による得令スコア（旺=4,相=3,休=2,囚=1,死=0の簡易版）
  // 月支index: 子0,丑1,寅2,卯3,辰4,巳5,午6,未7,申8,酉9,戌10,亥11
  const seasonScores = [
  // 子  丑  寅  卯  辰  巳  午  未  申  酉  戌  亥
    [2, 1, 4, 4, 2, 1, 1, 1, 0, 0, 1, 3], // 木
    [0, 0, 2, 2, 1, 4, 4, 2, 0, 0, 1, 1], // 火
    [1, 3, 0, 0, 3, 2, 3, 3, 2, 2, 3, 1], // 土
    [2, 2, 0, 0, 1, 0, 0, 1, 4, 4, 2, 2], // 金
    [4, 3, 1, 1, 2, 0, 0, 0, 2, 2, 2, 4], // 水
  ];
  let score = seasonScores[de][monthBranch];
  // 他の天干からのサポート
  for (const s of allStems) {
    const g = getTenGod(dayStem, s);
    if (g === 0 || g === 1 || g === 8 || g === 9) score += 1; // 比肩劫財偏印印綬
    else score -= 0.5;
  }
  if (score >= 6) return { label:'身強', cls:'strength-strong', desc:'エネルギーが旺盛。積極的な行動が吉。' };
  if (score >= 3) return { label:'中和', cls:'strength-mid', desc:'バランスが取れた命式。柔軟な対応が強み。' };
  return { label:'身弱', cls:'strength-weak', desc:'周囲のサポートを活かすことで力を発揮する。' };
}

// ═══════════════════════════════════════════════════
// 日主タイプ説明
// ═══════════════════════════════════════════════════
const NICHISHU_DESC = [
  { name:'甲木', elem:'木', desc:'大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。' },
  { name:'乙木', elem:'木', desc:'柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。' },
  { name:'丙火', elem:'火', desc:'太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。' },
  { name:'丁火', elem:'火', desc:'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。' },
  { name:'戊土', elem:'土', desc:'山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。' },
  { name:'己土', elem:'土', desc:'肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。' },
  { name:'庚金', elem:'金', desc:'刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。' },
  { name:'辛金', elem:'金', desc:'宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。' },
  { name:'壬水', elem:'水', desc:'大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。' },
  { name:'癸水', elem:'水', desc:'恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。' },
];

// ═══════════════════════════════════════════════════
// 十二運星
// ═══════════════════════════════════════════════════
const JUNI_UNSEI = ['長生','沐浴','冠帯','建禄','帝旺','衰','病','死','墓','絶','胎','養'];
const JUNI_DESC = {
  '長生':'新しいサイクルの始まり。エネルギーが生まれ、物事がスタートしやすい伸びやかな時期。',
  '沐浴':'感受性と直感が高まる。衝動的になりやすいが、個性や魅力が輝き、恋愛運も活発に。',
  '冠帯':'実力がつき自信が芽生える成長期。積極的な行動が実を結びやすく、出世・昇格の機会も。',
  '建禄':'安定と充実の時期。努力が認められ、実力が正当に評価される。生活基盤が固まる。',
  '帝旺':'絶頂期。エネルギーが最高潮に達し、大きな成果を掴みやすい。リーダーシップが輝く。',
  '衰':'少しずつ力が落ちてくる移行期。無理をせず方向転換の準備を始めるとよい。',
  '病':'体調や運気に注意が必要な時期。休養と内省を大切に。焦らず養生が吉。',
  '死':'古いものが終わる静養期。焦らず次のサイクルを待つことで新たな力が宿る。',
  '墓':'蓄積と整理の時期。過去の経験を活かし、次のステージの土台を固める。',
  '絶':'変革の時期。古い自分が崩れ、新しい自分へ生まれ変わる準備が始まる。',
  '胎':'新しいものが宿る受胎期。内側での準備と充電が大切な、静かな転換点。',
  '養':'周囲のサポートを受けながら育まれる時期。焦らず力を蓄えることが吉。',
};
const CHOSEISTART = [11, 6, 2, 9, 2, 9, 5, 0, 8, 3];
function getJuniUnsei(dayStem, branch) {
  const start = CHOSEISTART[dayStem];
  const yang = STEM_YIN[dayStem] === 0;
  const steps = yang ? (branch - start + 12) % 12 : (start - branch + 12) % 12;
  return JUNI_UNSEI[steps];
}

// ═══════════════════════════════════════════════════
// 天中殺・律音
// ═══════════════════════════════════════════════════
// 日柱の60サイクル番号から天中殺（空亡）の2支を返す
function getTenchusatsu(dayCycle) {
  // グループ0〜5ごとに「当たらない2支」
  const missing = [[10,11],[8,9],[6,7],[4,5],[2,3],[0,1]];
  return missing[Math.floor(dayCycle / 10)];
}
// 同一干支が複数柱に現れる「律音」を検出
function getRitchin(pillars) {
  const results = [];
  for (let i = 0; i < pillars.length - 1; i++) {
    for (let j = i + 1; j < pillars.length; j++) {
      if (pillars[i].stem === pillars[j].stem && pillars[i].branch === pillars[j].branch) {
        results.push({ label1: colLabels[i], label2: colLabels[j],
          kanshi: STEMS[pillars[i].stem] + BRANCHES[pillars[i].branch] });
      }
    }
  }
  return results;
}
const JUSSHIN_GOD_DESC = {
  '比肩':'独立・自我。自力で切り拓く力が強まる時期。自分らしさを貫くことで運が開く。',
  '劫財':'競争・決断。変化や争いの中で力を発揮する。過度な強引さには注意。',
  '食神':'表現・豊穣。才能や個性が自然に花開く。食・趣味・創作に縁が深まる。',
  '傷官':'創造・反骨。既存の枠を超える革新の時。才覚は輝くが、権威との摩擦に注意。',
  '偏財':'行動・財運。活動的に動くことで金運が拓ける。対人・ビジネスチャンスに富む。',
  '正財':'堅実・蓄財。地道な努力が着実な財運につながる。家庭・実務が安定する。',
  '偏官':'変化・勝負。スピード感ある行動が吉。リスクを取る決断が運命を動かす。',
  '正官':'地位・規律。信頼と責任が高まる。キャリアや社会的評価が向上しやすい。',
  '偏印':'探求・直観。学びや精神世界との縁が深まる。独自の世界観が武器になる。',
  '印綬':'保護・学業。目上の人のサポートが得やすい。勉強・資格取得に最適な時期。',
};

// ═══════════════════════════════════════════════════
// 大運算出
// ═══════════════════════════════════════════════════
function getDaiyun(birthYear, birthMonth, birthDay, gender, yearStem, monthStem, monthBranch) {
  const yearYang = yearStem % 2 === 0;
  // 男性陽年 or 女性陰年 → 順行
  const forward = (gender === 'male' && yearYang) || (gender === 'female' && !yearYang);

  // 大運起限: 生日から次(順行)or前(逆行)の節入りまでの日数 ÷ 3
  let days = 0;
  if (forward) {
    // 生まれた月の節入り日の次の月の節を探す
    let m = birthMonth, y = birthYear;
    const termDay = getSolarTermDay(y, m);
    if (birthDay >= termDay) { m++; if (m > 12) { m = 1; y++; } }
    const nextTerm = new Date(y, m - 1, getSolarTermDay(y, m));
    const birth = new Date(birthYear, birthMonth - 1, birthDay);
    days = Math.round((nextTerm - birth) / 86400000);
  } else {
    // 生まれた月またはその前の節入り日を探す
    let m = birthMonth, y = birthYear;
    const termDay = getSolarTermDay(y, m);
    let prevTermDate;
    if (birthDay < termDay) {
      // 前月の節
      m--; if (m === 0) { m = 12; y--; }
      prevTermDate = new Date(y, m - 1, getSolarTermDay(y, m));
    } else {
      prevTermDate = new Date(y, m - 1, termDay);
    }
    const birth = new Date(birthYear, birthMonth - 1, birthDay);
    days = Math.round((birth - prevTermDate) / 86400000);
  }
  const startAge = Math.round(days / 3);

  // 大運干支を8期分生成
  const daiyun = [];
  let s = monthStem, b = monthBranch;
  for (let i = 0; i < 8; i++) {
    if (forward) { s = (s + 1) % 10; b = (b + 1) % 12; }
    else          { s = (s + 9) % 10; b = (b + 11) % 12; }
    daiyun.push({ stem: s, branch: b, startAge: startAge + i * 10 });
  }
  return { forward, startAge, daiyun };
}

// ═══════════════════════════════════════════════════
// 今年の流年運勢
// ═══════════════════════════════════════════════════
const NENUN_TEXT = [
  '種を蒔く年。新たな始まりに向けて土台を固める時期。焦らず計画を立てましょう。',
  '芽吹きの年。昨年蒔いた種が少しずつ形になります。地道な努力が報われます。',
  '成長の年。エネルギーが高まり、積極的な行動が実を結びます。チャレンジに好機。',
  '発展の年。才能や実力が外に開花する時期。人間関係が広がり、評価も高まります。',
  '充実の年。物事が最高潮を迎えます。感謝を忘れずに成果を分かち合いましょう。',
  '転換の年。変化の兆しが現れます。手放すべきものを見極め、新しい流れに乗る準備を。',
  '整理の年。不要なものを手放し、内面を見つめ直す時期。焦らず丁寧に。',
  '再生の年。古いサイクルが終わり、新たなサイクルへの移行期。静かに備えましょう。',
  '完成の年。長年の努力が集約されます。人とのつながりを大切にすると吉。',
  '調和の年。自他のバランスを保ちながら進む時期。無理をせず流れに乗りましょう。',
];

// ═══════════════════════════════════════════════════
// HTML生成ユーティリティ
// ═══════════════════════════════════════════════════
function elemClass(stemOrBranch, type) {
  const e = type === 'stem' ? STEM_ELEM[stemOrBranch] : BRANCH_ELEM[stemOrBranch];
  return ELEM_COLOR[e];
}
function elemBgClass(stemOrBranch, type) {
  const e = type === 'stem' ? STEM_ELEM[stemOrBranch] : BRANCH_ELEM[stemOrBranch];
  return ELEM_BG[e];
}
function kanshiHTML(stem, branch) {
  const se = STEM_ELEM[stem], be = BRANCH_ELEM[branch];
  return `<span class="${ELEM_COLOR[se]}">${STEMS[stem]}</span><span class="${ELEM_COLOR[be]}">${BRANCHES[branch]}</span>`;
}
function elemLabel(stem) {
  return `<span class="${ELEM_COLOR[STEM_ELEM[stem]]}">${ELEMENTS[STEM_ELEM[stem]]}</span>`;
}

// ═══════════════════════════════════════════════════
// メイン計算
// ═══════════════════════════════════════════════════
function calcShichu() {
  const dateVal = document.getElementById('birthDate').value;
  if (!dateVal) { alert('生年月日を入力してください'); return; }
  const [year, month, day] = dateVal.split('-').map(Number);
  if (year < 1900 || year > 2099) { alert('1900年〜2099年の範囲で入力してください'); return; }

  const hourVal = parseInt(document.getElementById('birthHour').value);
  const hasHour = hourVal >= 0;
  const gender = document.querySelector('input[name="gender"]:checked').value;
  const name = document.getElementById('userName').value.trim();

  document.getElementById('loadingOverlay').classList.add('show');
  setTimeout(() => {
    try {
      _calcAndRender(year, month, day, hourVal, hasHour, gender, name);
    } finally {
      document.getElementById('loadingOverlay').classList.remove('show');
    }
  }, 600);
}

function _calcAndRender(year, month, day, hour, hasHour, gender, name) {
  // ── 4柱算出 ──
  const yp = getYearPillar(year, month, day);
  const mp = getMonthPillar(year, month, day, yp.stem);
  const dp = getDayPillar(year, month, day);
  const hp = hasHour ? getHourPillar(hour, dp.stem) : null;

  // ── 命式盤（4柱カード） ──
  const allStems = hasHour ? [yp.stem, mp.stem, hp.stem] : [yp.stem, mp.stem];
  const cols = hasHour ? [hp, dp, mp, yp] : [null, dp, mp, yp];
  const colLabels = ['時柱','日柱','月柱','年柱'];

  function makePillarCard(col, label, isDayMaster) {
    if (col === null) {
      return `<div class="pillar-card no-time">
        <div class="pillar-header">
          <div class="pillar-label">${label}</div>
          <div class="pillar-god pillar-god-other">――</div>
        </div>
        <div class="pillar-body">
          <div class="pillar-kan" style="font-size:1.6rem;color:var(--muted)">?</div>
          <div class="pillar-elem">時間不明</div>
          <div class="pillar-hr"></div>
          <div class="pillar-shi" style="font-size:1.6rem;color:var(--muted)">?</div>
          <div class="pillar-shelem">――</div>
        </div>
      </div>`;
    }
    const se = STEM_ELEM[col.stem], be = BRANCH_ELEM[col.branch];
    const godIdx = getTenGod(dp.stem, col.stem);
    const godLabel = isDayMaster ? '日 主' : (godIdx >= 0 ? JUSSHIN_NAMES[godIdx] : '');
    const godCls = isDayMaster ? 'pillar-god-day' : 'pillar-god-other';
    const zangItems = ZANGGAN[col.branch].map(s => {
      const g = getTenGod(dp.stem, s);
      const gn = (s === dp.stem) ? '日主' : (g >= 0 ? JUSSHIN_NAMES[g] : '');
      return `<span class="zs ${ELEM_COLOR[STEM_ELEM[s]]}">${STEMS[s]}</span><span class="zg">${gn}</span>`;
    }).join('');
    return `<div class="pillar-card${isDayMaster?' is-day':''}">
      <div class="pillar-header">
        <div class="pillar-label">${label}</div>
        <div class="pillar-god ${godCls}">${godLabel}</div>
      </div>
      <div class="pillar-body">
        <div class="pillar-kan ${ELEM_COLOR[se]}">${STEMS[col.stem]}</div>
        <div class="pillar-elem">${ELEMENTS[se]}・${STEM_YIN[col.stem]?'陰':'陽'}</div>
        <div class="pillar-hr"></div>
        <div class="pillar-shi ${ELEM_COLOR[be]}">${BRANCHES[col.branch]}</div>
        <div class="pillar-shelem">${ELEMENTS[be]}</div>
      </div>
      <div class="pillar-zang">
        <div class="pillar-zang-label">蔵 干</div>
        <div class="pillar-zang-list">${zangItems}</div>
      </div>
    </div>`;
  }

  const grid = document.getElementById('meishikiGrid');
  grid.innerHTML = cols.map((col, i) =>
    makePillarCard(col, colLabels[i], i === 1)
  ).join('');

  // ── 4柱の読み方 ──
  document.getElementById('pillarsGuide').innerHTML = `
    <div class="guide-title">✦ 4柱の読み方 ✦</div>
    <div class="guide-grid">
      <div class="guide-item"><div class="guide-pillar-name">年柱</div><div class="guide-pillar-desc">祖先・幼少期（〜15歳）の運命的素地。他人から見た外面的な印象も表す。</div></div>
      <div class="guide-item"><div class="guide-pillar-name">月柱</div><div class="guide-pillar-desc">親・兄弟・青年期（16〜30歳）と仕事・社会運。命式の中心的な力を持つ柱。</div></div>
      <div class="guide-item is-day-guide"><div class="guide-pillar-name">日柱 ⭐</div><div class="guide-pillar-desc">あなた自身の本質・中年期（31〜45歳）。日干が「日主」として命式全体の基準点になる。</div></div>
      <div class="guide-item"><div class="guide-pillar-name">時柱</div><div class="guide-pillar-desc">子供・晩年期（46歳〜）の運勢。将来への意志や目標、老後の環境を示す。</div></div>
    </div>
  `;

  // ── 日主カード ──
  const nd = NICHISHU_DESC[dp.stem];
  const elemIdx = STEM_ELEM[dp.stem];
  const strength = getDayStrength(dp.stem, mp.branch, allStems, [yp.branch, mp.branch]);
  document.getElementById('nichishuCard').innerHTML = `
    <div class="nichishu-header">
      <div class="nichishu-kan ${ELEM_COLOR[elemIdx]}" style="font-size:2.8rem">${STEMS[dp.stem]}</div>
      <div class="nichishu-info">
        <h3>日主：${nd.name}（${STEM_YIN[dp.stem]?'陰':'陽'}${ELEMENTS[elemIdx]}）</h3>
        <span class="nichishu-info strength ${strength.cls}">${strength.label} — ${strength.desc}</span>
      </div>
    </div>
    <p class="nichishu-desc">${nd.desc}</p>
  `;

  // ── 天中殺・律音 ──
  const dayCycle = (getJDN(year, month, day) + 49) % 60;
  const tcsBranches = getTenchusatsu(dayCycle);
  const tcsNames = tcsBranches.map(b => BRANCHES[b]).join('・');
  const tcsYears = tcsBranches.map(b => {
    // 干支12支のうちtcsBranchに当たる西暦年の近い例を示す（参考）
    const currentY = new Date().getFullYear();
    const base = (currentY - 4 + 600) % 12;
    const diff1 = (b - base + 12) % 12;
    return `${currentY + diff1}年`;
  }).join('・');

  const validCols = cols.filter(c => c !== null);
  const ritchinList = getRitchin(validCols);

  let ritchinHTML = '';
  if (ritchinList.length > 0) {
    ritchinHTML = `<div class="tcs-block">
      <div class="tcs-label">⚡ 律音（りっちん）あり</div>
      ${ritchinList.map(r=>`<div class="tcs-value">${r.label1}・${r.label2}が同じ「<strong>${r.kanshi}</strong>」</div>
        <div class="tcs-note">同一干支が重なることで、その干支のエネルギーが倍増します。強烈な個性や突出した才能が現れやすい半面、行き過ぎに注意が必要です。</div>`).join('')}
    </div>`;
  }

  document.getElementById('tenchusatsuCard').innerHTML = `
    <div class="tcs-card">
      <div class="tcs-row">
        <div class="tcs-block">
          <div class="tcs-label">🌑 天中殺（空亡）</div>
          <div class="tcs-value">${tcsNames}年・月・日</div>
          <div class="tcs-note">天干の届かない2つの地支。この地支が巡る年・月・日は天のサポートが薄れ、物事が不安定になりやすい時期。大きな決断・開業・投資は避け、内を固める準備期間として活かすのが吉。</div>
          <div class="tcs-note">次の該当年の目安：${tcsYears}</div>
        </div>
        ${ritchinHTML}
      </div>
    </div>
  `;

  // ── 十神グリッド ──
  const positions = hasHour
    ? [
        { label:'年干', stem: yp.stem }, { label:'年支（蔵干）', stem: ZANGGAN_MAIN[yp.branch] },
        { label:'月干', stem: mp.stem }, { label:'月支（蔵干）', stem: ZANGGAN_MAIN[mp.branch] },
        { label:'日支（蔵干）', stem: ZANGGAN_MAIN[dp.branch] },
        { label:'時干', stem: hp.stem }, { label:'時支（蔵干）', stem: ZANGGAN_MAIN[hp.branch] },
      ]
    : [
        { label:'年干', stem: yp.stem }, { label:'年支（蔵干）', stem: ZANGGAN_MAIN[yp.branch] },
        { label:'月干', stem: mp.stem }, { label:'月支（蔵干）', stem: ZANGGAN_MAIN[mp.branch] },
        { label:'日支（蔵干）', stem: ZANGGAN_MAIN[dp.branch] },
      ];

  const jGrid = document.getElementById('jusshinGrid');
  jGrid.innerHTML = '';
  positions.forEach(pos => {
    const g = getTenGod(dp.stem, pos.stem);
    if (g < 0) return;
    const e = STEM_ELEM[pos.stem];
    jGrid.innerHTML += `
      <div class="jusshin-item ${ELEM_BG[e]}">
        <div class="jusshin-label">${pos.label}</div>
        <div class="jusshin-name ${ELEM_COLOR[e]}">${JUSSHIN_NAMES[g]}（${STEMS[pos.stem]}）</div>
        <div class="jusshin-pos">${JUSSHIN_MEANINGS[g]}</div>
      </div>`;
  });

  // ── 大運 ──
  const dy = getDaiyun(year, month, day, gender, yp.stem, mp.stem, mp.branch);
  const currentYear = new Date().getFullYear();
  const currentAge = currentYear - year;

  document.getElementById('daiyunMeta').textContent =
    `${dy.forward ? '順行' : '逆行'} ／ 大運起限 ${dy.startAge}歳`;

  const list = document.getElementById('daiyunList');
  list.innerHTML = '';
  dy.daiyun.forEach(d => {
    const isCurrent = currentAge >= d.startAge && currentAge < d.startAge + 10;
    const se = STEM_ELEM[d.stem], be = BRANCH_ELEM[d.branch];
    const godIdx = getTenGod(dp.stem, d.stem);
    const godName = godIdx >= 0 ? JUSSHIN_NAMES[godIdx] : '―';
    const juniName = getJuniUnsei(dp.stem, d.branch);
    list.innerHTML += `
      <div class="daiyun-item${isCurrent?' current-daiyun':''}">
        <div class="daiyun-age">${d.startAge}歳〜</div>
        <div class="daiyun-kan ${ELEM_COLOR[se]}">${STEMS[d.stem]}</div>
        <div class="daiyun-shi ${ELEM_COLOR[be]}">${BRANCHES[d.branch]}</div>
        <div class="daiyun-period">${year+d.startAge}年〜</div>
        <div class="daiyun-tags">
          <span class="daiyun-tag tag-god">${godName}</span>
          <span class="daiyun-tag tag-juni">${juniName}</span>
        </div>
        ${isCurrent?'<div style="font-size:.55rem;color:var(--gold);margin-top:.3rem;font-family:var(--ff-mono)">▶ 現在</div>':''}
      </div>`;
  });

  // ── 現在大運コメント ──
  const currentDy = dy.daiyun.find(d => currentAge >= d.startAge && currentAge < d.startAge + 10);
  if (currentDy) {
    const cgIdx = getTenGod(dp.stem, currentDy.stem);
    const cgName = cgIdx >= 0 ? JUSSHIN_NAMES[cgIdx] : '';
    const cjName = getJuniUnsei(dp.stem, currentDy.branch);
    const cse = STEM_ELEM[currentDy.stem], cbe = BRANCH_ELEM[currentDy.branch];
    const godDescText = JUSSHIN_GOD_DESC[cgName] || '';
    const juniDescText = JUNI_DESC[cjName] || '';
    document.getElementById('daiyunCurrentDesc').innerHTML = `
      <div class="cur-dy-title">▶ 現在の大運（${currentDy.startAge}歳〜）の読み解き</div>
      <div class="cur-dy-kanshi">
        <span class="${ELEM_COLOR[cse]}">${STEMS[currentDy.stem]}</span><span class="${ELEM_COLOR[cbe]}">${BRANCHES[currentDy.branch]}</span>
      </div>
      <div class="cur-dy-row"><span class="cur-dy-badge tag-god">${cgName}</span><span class="cur-dy-text">${godDescText}</span></div>
      <div class="cur-dy-row"><span class="cur-dy-badge tag-juni">${cjName}</span><span class="cur-dy-text">${juniDescText}</span></div>
    `;
  }

  // ── 十二運星 凡例 ──
  document.getElementById('juniLegend').innerHTML = `
    <div class="legend-title">十二運星の意味</div>
    <div class="legend-grid">
      ${JUNI_UNSEI.map(n=>`<div class="legend-item"><span class="legend-name">${n}</span><span class="legend-desc">${JUNI_DESC[n].split('。')[0]}。</span></div>`).join('')}
    </div>
  `;

  // ── 今年の流年運勢 ──
  const thisYear = new Date().getFullYear();
  const typ = { stem: (thisYear - 4 + 600) % 10, branch: (thisYear - 4 + 600) % 12 };
  const nenunIdx = getTenGod(dp.stem, typ.stem);
  const nenunBase = (nenunIdx >= 0 && nenunIdx < 10) ? nenunIdx : (STEM_ELEM[typ.stem] * 2) % 10;
  const nenunSE = STEM_ELEM[typ.stem], nenunBE = BRANCH_ELEM[typ.branch];
  document.getElementById('nenunCard').innerHTML = `
    <div class="nenun-year">✦ ${thisYear}年の流年運勢 ✦</div>
    <div class="nenun-kanshi">
      <span class="${ELEM_COLOR[nenunSE]}">${STEMS[typ.stem]}</span><span class="${ELEM_COLOR[nenunBE]}">${BRANCHES[typ.branch]}</span>年
      <span style="font-size:.75rem;color:var(--muted);margin-left:.6rem;font-family:var(--ff-mono)">→ 日主との関係：${nenunIdx>=0?JUSSHIN_NAMES[nenunIdx]:'中立'}</span>
    </div>
    <p class="nenun-desc">${NENUN_TEXT[nenunBase]}</p>
  `;

  // ── 表示 ──
  document.getElementById('formArea').style.display = 'none';
  scrollToResult('resultSection');
}

function resetForm() {
  document.getElementById('formArea').style.display = 'block';
  document.getElementById('resultSection').style.display = 'none';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
</body>
</html>
