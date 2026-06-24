<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="名前と生年月日からあなたの守護霊を診断。レアリティ・属性・守護霊名・相性・メッセージを魂のカルテとして表示します。">
<title>守護霊診断｜あなたを守る霊はUR？SSR？</title>
<link rel="canonical" href="https://life-fun.net/guardian" />
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
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh;overflow-x:hidden}

/* ─── HEADER ─── */
header{position:sticky;top:0;z-index:100;background:rgba(8,6,15,.92);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px;padding:0 1.2rem}
.logo{font-family:var(--ff-serif);font-size:1.15rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.05em}
.logo em{color:var(--gold);font-style:normal}
.header-nav{display:flex;gap:1.2rem;align-items:center}
.header-nav a{font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}
.sp-menu-btn{display:none;background:none;border:1px solid var(--border);color:var(--muted);font-size:.7rem;padding:.3rem .7rem;border-radius:6px;cursor:pointer;font-family:var(--ff-mono);letter-spacing:.06em}
.sp-dropdown{display:none;position:absolute;top:54px;left:0;right:0;background:rgba(8,6,15,.97);border-bottom:1px solid var(--border);z-index:200;padding:.5rem 0}
.sp-dropdown a,.sp-dropdown span{display:block;padding:.7rem 1.4rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border)}
.sp-dropdown a:last-child{border-bottom:none}
.sp-dropdown a:hover{color:var(--gold-lt)}
.sp-dropdown span{color:var(--text)}
@media(max-width:700px){.header-nav{display:none}.sp-menu-btn{display:block}}

/* ─── LAYOUT ─── */
.wrap{max-width:900px;margin:0 auto;padding:2rem 1.2rem 4rem}
.page-title{text-align:center;margin-bottom:2.5rem}
.page-title h1{font-family:var(--ff-serif);font-size:1.6rem;font-weight:700;letter-spacing:.1em;margin-bottom:.4rem}
.page-title .subtitle{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--muted);text-transform:uppercase}

/* ─── FORM ─── */
.form-card{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:2rem;margin-bottom:2rem;max-width:520px;margin-left:auto;margin-right:auto}
.form-section-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:1.2rem;text-align:center}
.form-group{margin-bottom:1.2rem}
.form-label{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.1em;color:var(--muted);display:block;margin-bottom:.4rem}
.form-input{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.75rem 1rem;font-family:var(--ff-sans);font-size:1rem;color:var(--text);outline:none;transition:border-color .2s}
.form-input:focus{border-color:var(--violet)}
.date-row{display:flex;gap:.6rem}
.date-row select.form-input{flex:1;background-color:#1e1738;-webkit-appearance:none;appearance:none}
.date-row select.form-input option{background:#1e1738;color:var(--text)}
.submit-btn{width:100%;padding:1rem;background:linear-gradient(135deg,rgba(155,114,239,.8),rgba(201,168,76,.7));border:none;border-radius:10px;font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;color:#fff;cursor:pointer;margin-top:.5rem;letter-spacing:.12em;transition:opacity .2s}
.submit-btn:hover{opacity:.88}

/* ─── 演出オーバーレイ ─── */
#overlay{position:fixed;inset:0;z-index:999;display:none;align-items:center;justify-content:center;flex-direction:column;pointer-events:none}
#overlay.active{display:flex}
.overlay-bg{position:absolute;inset:0;background:#000;opacity:0;transition:opacity .6s}
.burst{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0}
.burst-ring{border-radius:50%;position:absolute;transform:scale(0)}
.rank-reveal{font-family:var(--ff-serif);font-size:3rem;font-weight:700;color:#fff;position:relative;z-index:2;opacity:0;text-shadow:0 0 40px currentColor;letter-spacing:.2em}
#particles{position:absolute;inset:0;pointer-events:none;overflow:hidden}

/* ─── RESULT ─── */
#result{display:none;max-width:600px;margin:0 auto}

/* レアリティバッジ */
.rarity-badge{display:inline-block;font-family:var(--ff-mono);font-size:1rem;font-weight:700;letter-spacing:.2em;padding:.3rem 1.4rem;border-radius:30px;margin-bottom:1rem}
.rarity-UR{background:linear-gradient(135deg,#ff6b35,#f7c59f,#ffffd4,#a8edea,#fed6e3,#ff6b35);background-size:300% 300%;animation:rainbow 2s ease infinite;color:#1a0a00;box-shadow:0 0 30px rgba(255,200,50,.6)}
.rarity-SSR{background:linear-gradient(135deg,#f7971e,#ffd200);color:#1a0a00;box-shadow:0 0 20px rgba(255,210,0,.5)}
.rarity-SR{background:linear-gradient(135deg,#4facfe,#00f2fe);color:#001a2e;box-shadow:0 0 15px rgba(79,172,254,.4)}
.rarity-R{background:linear-gradient(135deg,#a18cd1,#fbc2eb);color:#1a0a2e}
.rarity-C{background:rgba(138,125,181,.2);border:1px solid var(--border2);color:var(--muted)}
@keyframes rainbow{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}

.karte{background:linear-gradient(160deg,var(--card) 0%,var(--card2) 100%);border-radius:20px;padding:2rem;position:relative;overflow:hidden}
.karte-ur{border:2px solid transparent;background-clip:padding-box;box-shadow:0 0 40px rgba(255,200,50,.3),inset 0 0 40px rgba(255,200,50,.05)}
.karte-ssr{border:1px solid rgba(255,210,0,.4);box-shadow:0 0 25px rgba(255,210,0,.2)}
.karte-sr{border:1px solid rgba(79,172,254,.3);box-shadow:0 0 15px rgba(79,172,254,.15)}
.karte-r{border:1px solid rgba(161,140,209,.3)}
.karte-c{border:1px solid var(--border)}

.karte-header{text-align:center;margin-bottom:1.8rem;padding-bottom:1.2rem;border-bottom:1px solid var(--border)}
.guardian-emoji{font-size:3rem;margin-bottom:.5rem;display:block}
.guardian-name{font-family:var(--ff-serif);font-size:1.6rem;font-weight:700;margin-bottom:.3rem;letter-spacing:.1em}
.guardian-type-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--muted);margin-bottom:.8rem}
.attr-badge{display:inline-block;padding:.25rem .9rem;border-radius:20px;font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.1em;margin:.2rem}

.karte-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem}
@media(max-width:520px){.karte-grid{grid-template-columns:1fr}}
.karte-item{background:rgba(0,0,0,.25);border:1px solid var(--border);border-radius:12px;padding:.9rem 1rem}
.karte-item-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.35rem}
.karte-item-value{font-family:var(--ff-serif);font-size:.92rem;color:var(--text);font-weight:600}
.karte-item-sub{font-size:.7rem;color:var(--muted);margin-top:.2rem}

.guard-power{margin-bottom:1.5rem}
.power-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.6rem}
.power-bars{display:flex;flex-direction:column;gap:.5rem}
.power-row{display:flex;align-items:center;gap:.7rem}
.power-name{font-size:.72rem;color:var(--muted);min-width:60px}
.power-bar-bg{flex:1;height:6px;background:rgba(255,255,255,.08);border-radius:3px;overflow:hidden}
.power-bar-fill{height:100%;border-radius:3px;transition:width 1s ease}
.power-val{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);min-width:28px;text-align:right}

.compat-box{background:rgba(0,0,0,.2);border:1px solid var(--border);border-radius:12px;padding:1rem 1.2rem;margin-bottom:1.2rem}
.compat-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.6rem}
.compat-row{display:flex;gap:.5rem;flex-wrap:wrap}
.compat-tag{font-size:.7rem;padding:.25rem .8rem;border-radius:12px;border:1px solid rgba(78,205,196,.25);background:rgba(78,205,196,.08);color:var(--teal)}
.compat-tag.bad{border-color:rgba(232,113,154,.25);background:rgba(232,113,154,.08);color:var(--rose)}

.message-box{background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(155,114,239,.06));border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.2rem 1.4rem;margin-bottom:1.2rem}
.message-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.18em;color:var(--gold);text-transform:uppercase;margin-bottom:.6rem}
.message-text{font-family:var(--ff-serif);font-size:.92rem;color:var(--text);line-height:2}

.advice-box{background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.2);border-radius:12px;padding:1rem 1.2rem;margin-bottom:1.5rem}
.advice-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;color:var(--violet-lt);text-transform:uppercase;margin-bottom:.5rem}
.advice-text{font-size:.82rem;color:var(--muted);line-height:1.9}

/* シェア */
.share-area{text-align:center;margin-top:1.5rem}
.retry-btn{display:inline-block;padding:.65rem 1.4rem;background:rgba(155,114,239,.15);border:1px solid var(--border2);color:var(--violet-lt);border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;cursor:pointer}
.article-link-box{display:flex;align-items:center;gap:.9rem;background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.article-link-box:hover{border-color:var(--violet-lt);background:rgba(155,114,239,.12)}
.article-link-icon{font-size:1.4rem;flex-shrink:0}
.article-link-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.article-link-body strong{font-family:var(--ff-sans);font-size:.9rem;font-weight:500;color:var(--violet-lt)}
.article-link-body small{font-size:.75rem;color:var(--muted)}
.article-link-arrow{color:var(--violet-lt);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}

/* ─── FOOTER ─── */
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
.footer-inner{max-width:900px;margin:0 auto}
.footer-nav{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.06em;line-height:2.4;color:var(--muted)}
.footer-nav a{color:var(--muted);text-decoration:none}
.footer-nav a:hover{color:var(--gold-lt)}
.footer-copy{font-family:var(--ff-mono);font-size:.6rem;color:rgba(138,125,181,.4);letter-spacing:.1em;margin-top:.8rem}
</style>
</head>
<body>

<!-- 演出オーバーレイ -->
<div id="overlay">
  <div class="overlay-bg" id="overlayBg"></div>
  <div id="particles"></div>
  <div class="burst" id="burst">
    <div class="burst-ring" id="ring1"></div>
    <div class="burst-ring" id="ring2"></div>
    <div class="burst-ring" id="ring3"></div>
  </div>
  <div class="rank-reveal" id="rankReveal"></div>
</div>

<?php $currentPage='guardian'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <div class="page-title">
    <div class="subtitle">Guardian Spirit Reading</div>
    <h1>守護霊診断｜あなたを守る霊はUR・SSR・SR？無料鑑定</h1>
    <p style="font-size:.8rem;color:var(--muted);margin-top:.5rem">あなたを守る霊は何者か。<br>レアリティ・属性・守護霊名を今すぐ鑑定します。</p>
  </div>

  <div class="form-card" id="formArea">
    <div class="form-section-label">✦ あなたの情報を入力 ✦</div>
    <div class="form-group">
      <label class="form-label" for="userName">名前（フルネームほど精度が上がります）</label>
      <input class="form-input" type="text" id="userName" placeholder="例：山田 花子" maxlength="30">
    </div>
    <div class="form-group">
      <label class="form-label">生年月日</label>
      <div class="date-row">
        <select class="form-input" id="birthYear"><option value="">年</option></select>
        <select class="form-input" id="birthMonth"><option value="">月</option></select>
        <select class="form-input" id="birthDay"><option value="">日</option></select>
      </div>
    </div>
    <button class="submit-btn" onclick="diagnose()">✦ 守護霊を召喚する ✦</button>
    <p style="font-size:.65rem;color:var(--muted);text-align:center;margin-top:.8rem;line-height:1.7">入力された情報はサーバーに送信・保存されません。<br>同じ名前・生年月日からは毎回同じ結果が表示されます。<br><span style="color:rgba(138,125,181,.5)">※本サービスはエンターテインメントです。重要な判断の根拠にはしないでください。</span></p>
  </div>

  <div id="result">
    <div style="text-align:center;margin-bottom:1.2rem">
      <span class="rarity-badge" id="rarityBadge"></span>
    </div>
    <div class="karte" id="karteCard">
      <div class="karte-header">
        <span class="guardian-emoji" id="guardianEmoji"></span>
        <div class="guardian-type-label" id="guardianTypeLabel"></div>
        <div class="guardian-name" id="guardianName"></div>
        <div id="attrBadges"></div>
        <div style="font-size:.75rem;color:var(--muted);margin-top:.6rem" id="resNameLabel"></div>
      </div>

      <div class="karte-grid">
        <div class="karte-item">
          <div class="karte-item-label">Tribe — 種族</div>
          <div class="karte-item-value" id="resTribe"></div>
          <div class="karte-item-sub" id="resTribeSub"></div>
        </div>
        <div class="karte-item">
          <div class="karte-item-label">Relation — 前世との縁</div>
          <div class="karte-item-value" id="resRelation"></div>
          <div class="karte-item-sub" id="resRelationSub"></div>
        </div>
        <div class="karte-item">
          <div class="karte-item-label">Count — 守護霊の数</div>
          <div class="karte-item-value" id="resCount"></div>
        </div>
        <div class="karte-item">
          <div class="karte-item-label">Specialty — 得意分野</div>
          <div class="karte-item-value" id="resSpecialty"></div>
        </div>
      </div>

      <div class="guard-power">
        <div class="power-label">Guardian Power</div>
        <div class="power-bars" id="powerBars"></div>
      </div>

      <div class="compat-box">
        <div class="compat-label">Compatibility — 相性のいい守護霊</div>
        <div class="compat-row" id="compatGood"></div>
        <div class="compat-label" style="margin-top:.7rem">相性の注意が必要な守護霊</div>
        <div class="compat-row" id="compatBad"></div>
      </div>

      <div class="message-box">
        <div class="message-label">✦ 守護霊からのメッセージ ✦</div>
        <div class="message-text" id="resMessage"></div>
      </div>

      <div class="advice-box">
        <div class="advice-label">今世でのアドバイス</div>
        <div class="advice-text" id="resAdvice"></div>
      </div>
    </div>

    <div class="share-area">
      <?php require __DIR__.'/inc/share-btns.php'; ?>
      <?php
      $articleUrl   = '/articles/guardian/';
      $articleIcon  = '📖';
      $articleTitle = '守護霊診断とは？';
      $articleDesc  = '守護霊・守護獣の意味と種類をわかりやすく解説';
      $contextKey   = 'guardian';
      $retryLabel   = 'もう一度診断する';
      $retryType    = 'js';
      $retryValue   = 'resetForm()';
      require __DIR__.'/inc/result-footer.php';
      ?>
    </div>
  </div>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// ─── セレクト生成 ───────────────────────────────────────────
(function(){
  const y=document.getElementById('birthYear');
  const m=document.getElementById('birthMonth');
  const d=document.getElementById('birthDay');
  const now=new Date().getFullYear();
  for(let i=now;i>=1920;i--){const o=document.createElement('option');o.value=i;o.textContent=i+'年';y.appendChild(o);}
  for(let i=1;i<=12;i++){const o=document.createElement('option');o.value=i;o.textContent=i+'月';m.appendChild(o);}
  for(let i=1;i<=31;i++){const o=document.createElement('option');o.value=i;o.textContent=i+'日';d.appendChild(o);}
})();

// ─── ハッシュ ────────────────────────────────────────────────
function strHash(str){
  let h=5381;
  for(let i=0;i<str.length;i++){h=Math.imul(31,h)+str.charCodeAt(i)|0;}
  return Math.abs(h);
}
function pick(arr,seed,salt){return arr[Math.abs(strHash(String(seed)+String(salt)))%arr.length];}
function pickN(arr,n,seed,salt){
  const res=[];const used=new Set();let i=0;
  while(res.length<n&&res.length<arr.length){
    const idx=Math.abs(strHash(String(seed)+String(salt)+String(i)))%arr.length;
    if(!used.has(idx)){used.add(idx);res.push(arr[idx]);}
    i++;
  }
  return res;
}
function num(min,max,seed,salt){return min+Math.abs(strHash(String(seed)+String(salt)))%(max-min+1);}

// ─── データ ──────────────────────────────────────────────────
const TRIBES=[
  {r:'龍神（天龍）',e:'🐲',s:'天空を司る最上位の龍神。風と雷を操り、高い場所から守護する。',compat:['鳳凰の守護者','星の使者'],bad:['地の精霊','土着の先祖霊']},
  {r:'龍神（水龍）',e:'🌊',s:'深海と川を司る龍神。流れと変化を読み、魂を清める力を持つ。',compat:['海の守護者','月の女神'],bad:['炎の守護者','太陽の神使']},
  {r:'龍神（金龍）',e:'✨',s:'富と繁栄を司る最強の龍神。財運と成功をもたらす最高位の存在。',compat:['太陽の神使','鳳凰の守護者'],bad:['闇の精霊','月の女神']},
  {r:'白狐の精霊',e:'🦊',s:'稲荷神の使いである白狐。鋭い知恵と変化の力で主を導く。',compat:['月の女神','風の精霊'],bad:['龍神（天龍）','武家の先祖霊']},
  {r:'鳳凰の守護者',e:'🔥',s:'炎と再生を司る神鳥。苦難のたびに主を蘇らせる力を持つ。',compat:['龍神（金龍）','太陽の神使'],bad:['水龍','海の守護者']},
  {r:'武家の先祖霊',e:'⚔️',s:'戦国や武家の時代を生きた先祖の魂。勇気と忠義の心で守護する。',compat:['土着の先祖霊','地の精霊'],bad:['白狐の精霊','天女']},
  {r:'巫女の先祖霊',e:'⛩️',s:'神に仕えた巫女の霊。清浄な気を持ち、邪気を祓う守護霊。',compat:['月の女神','天女'],bad:['龍神（天龍）','炎の守護者']},
  {r:'陰陽師の先祖霊',e:'☯️',s:'陰陽の理を極めた先祖霊。見えない力を読み解き、バランスを保つ。',compat:['星の使者','風の精霊'],bad:['土着の先祖霊','武家の先祖霊']},
  {r:'僧侶の先祖霊',e:'🪷',s:'深い修行を積んだ僧の霊。慈悲の心で主を穏やかに包み込む。',compat:['天女','癒しの精霊'],bad:['炎の守護者','海の守護者']},
  {r:'天女・天使',e:'👼',s:'天界から遣わされた光の存在。純粋な愛と癒しのエネルギーで包む。',compat:['巫女の先祖霊','僧侶の先祖霊'],bad:['闇の精霊','白狐の精霊']},
  {r:'大地の精霊',e:'🌿',s:'大地と木々に宿る精霊。根を張り、揺るぎない安定をもたらす。',compat:['土着の先祖霊','武家の先祖霊'],bad:['龍神（天龍）','星の使者']},
  {r:'海の守護者',e:'🌊',s:'広大な海を統べる存在。深い包容力と自由な魂を与える守護霊。',compat:['龍神（水龍）','月の女神'],bad:['鳳凰の守護者','炎の守護者']},
  {r:'星の使者',e:'⭐',s:'宇宙の果てから来た星の精霊。時間と宇宙の理を超えた知恵を持つ。',compat:['陰陽師の先祖霊','風の精霊'],bad:['大地の精霊','土着の先祖霊']},
  {r:'風の精霊',e:'🌬️',s:'風に乗って世界を巡る自由な精霊。変化と旅の力を与える。',compat:['星の使者','白狐の精霊'],bad:['大地の精霊','僧侶の先祖霊']},
  {r:'炎の守護者',e:'🔥',s:'業火を制する炎の守護霊。強烈な意志と情熱を魂に灯す。',compat:['鳳凰の守護者','太陽の神使'],bad:['龍神（水龍）','海の守護者']},
  {r:'月の女神',e:'🌙',s:'月光を司る女神の霊。直感と感受性を研ぎ澄ませ、深夜に力を増す。',compat:['白狐の精霊','巫女の先祖霊'],bad:['太陽の神使','龍神（金龍）']},
  {r:'太陽の神使',e:'☀️',s:'太陽に仕える神の使い。生命力と行動力を与え、光で道を照らす。',compat:['鳳凰の守護者','龍神（金龍）'],bad:['月の女神','闇の精霊']},
  {r:'森の賢者霊',e:'🌳',s:'古代の森に宿る知恵の霊。長い時間をかけて積んだ叡智を授ける。',compat:['大地の精霊','癒しの精霊'],bad:['炎の守護者','星の使者']},
  {r:'癒しの精霊',e:'💚',s:'傷ついた魂を癒す精霊。どんな苦しみも優しく溶かす回復の力を持つ。',compat:['天女','僧侶の先祖霊'],bad:['武家の先祖霊','炎の守護者']},
  {r:'闇の精霊',e:'🌑',s:'影と夜を司る精霊。表には見えない力で主を守り、真実を見通す目を与える。',compat:['月の女神','陰陽師の先祖霊'],bad:['太陽の神使','天女']},
  {r:'土着の先祖霊',e:'🏺',s:'この土地に長く眠る先祖の霊。生活に根ざした実直な守護をする。',compat:['大地の精霊','武家の先祖霊'],bad:['星の使者','陰陽師の先祖霊']},
];

const ATTRS=[
  {n:'火',c:'#ff6b35',bg:'rgba(255,107,53,.15)'},
  {n:'水',c:'#4facfe',bg:'rgba(79,172,254,.15)'},
  {n:'風',c:'#a8edea',bg:'rgba(168,237,234,.12)'},
  {n:'地',c:'#c9a84c',bg:'rgba(201,168,76,.15)'},
  {n:'光',c:'#ffffd4',bg:'rgba(255,255,212,.1)'},
  {n:'闇',c:'#9b72ef',bg:'rgba(155,114,239,.15)'},
  {n:'雷',c:'#ffd200',bg:'rgba(255,210,0,.15)'},
  {n:'花',c:'#fbc2eb',bg:'rgba(251,194,235,.12)'},
  {n:'月',c:'#c4a8f5',bg:'rgba(196,168,245,.12)'},
  {n:'太陽',c:'#f7c59f',bg:'rgba(247,197,159,.12)'},
];

const RELATIONS=[
  {r:'前世の師匠',s:'あなたの前世を見守っていた霊的な師。今世でも導き続けている。'},
  {r:'魂の双子',s:'魂の次元で繋がった最も近い守護存在。呼ばずとも常にそこにいる。'},
  {r:'前世の恋人',s:'前世で深く愛し合った魂。今世でも愛の形を変えて守護している。'},
  {r:'前世の家族',s:'幾度もの転生を共にした家族の霊。最も長い縁で結ばれた存在。'},
  {r:'宿縁の守護者',s:'遠い過去から決められた守護の縁。初対面でも深い安心感がある。'},
  {r:'同じ使命の同志',s:'この世界で同じ使命を持って戦った存在。今世の使命も知っている。'},
  {r:'救われた恩返し',s:'前世であなたに命を救われた魂。その恩を返すために守護に就いた。'},
  {r:'天界からの派遣',s:'あなたの魂の格に合わせて天界が選んだ守護霊。特別な意味がある。'},
];

const SPECIALTIES=[
  '金運・財運の守護','恋愛・縁結びの守護','健康・長寿の守護',
  '仕事運・出世の守護','直感・霊感の強化','創造力・芸術の守護',
  '家族・人間関係の守護','旅と冒険の守護','学業・知恵の守護',
  '精神的な安定の守護','危機回避・厄除け','勝負運の守護',
];

const NAME_PREFIX=['蒼夜','白露','金剛','紅蓮','碧水','黒耀','天光','暁紫','銀月','翠嵐','玄武','朱雀','蒼龍','白虎','麒麟','迦楼','摩利','不動','大日','妙見','観世','弥勒','地蔵','虚空','阿修','帝釈','梵天','毘沙','吉祥','弁財'];
const NAME_SUFFIX=['龍','姫','尊','神','霊','王','丸','光','炎','水','風','天','界','帝','聖','翼','牙','刃','鏡','珠','玉','環','炬','波','嵐','雷','星','月','陽','闇'];

const MESSAGES=[
  'あなたの魂が迷ったとき、私はいつもそこにいる。静けさの中に耳を傾けなさい。答えはすでにあなたの中にある。',
  '恐れることはない。あなたが思う以上に、あなたは守られている。その安心感を力に変えなさい。',
  '今感じている壁は、越えるためにそこにある。私はあなたが乗り越える瞬間を待っている。',
  'あなたの優しさは弱さではない。その心が、あなたを守る最大の鎧だということを忘れないで。',
  '今世で出会う人たちは偶然ではない。魂の次元で約束されたご縁だ。大切にしなさい。',
  '立ち止まることを恐れるな。休むことも、前へ進む力になる。',
  'あなたが諦めかけた夢は、まだ諦めなくていい。私はその夢を知っている。',
  '怒りを抑える必要はない。ただ、その炎を正しい方向へ向けなさい。',
  '孤独を感じるとき、それは魂が深化している証だ。私はあなたの隣にいる。',
  '小さな親切が、大きな運命を変える。今日誰かに優しくすることを忘れないで。',
  '自分を信じることが、最初の奇跡を起こす鍵だ。',
  'あなたの過去は、あなたの弱さではなく、強さの源だ。',
  '今は見えなくても、正しい方向へ歩んでいる。私が保証する。',
  '感謝の心が、守護の力を何倍にも増やす。それを忘れないでほしい。',
  'あなたには人が気づかない美しさがある。それをもっと世界に見せなさい。',
  '迷ったときは、心が軽くなる方を選びなさい。それが魂の声だ。',
  '今世であなたが経験する苦労は、すべて次の転生への贈り物になる。',
  '誰かを許すことは、自分自身を解放することだ。その勇気を持ちなさい。',
  '夢を語ることを恥ずかしがらないで。言葉には力がある。',
  '直感を信じなさい。それは私たちからのメッセージだ。',
];

const ADVICES=[
  '朝起きたら窓を開けて、深呼吸をしてください。そのとき守護霊との繋がりが強まります。',
  '水辺に行くと守護霊のエネルギーが充電されます。月に一度、海や川を訪れてみてください。',
  '感謝の言葉を声に出すことで、守護霊との絆が深まります。毎晩、今日の感謝を一つ口にして。',
  '白や金のアイテムを身につけると守護霊のエネルギーが通りやすくなります。',
  'ろうそくの火を見ながら瞑想すると、守護霊からのメッセージを受け取りやすくなります。',
  '夢日記をつけてください。守護霊はしばしば夢を通してメッセージを送ります。',
  '自然の中を歩くことで守護霊との繋がりが強くなります。月に数回、土の上を歩いて。',
  '感情が揺れたとき、胸に手を当てて「守護霊さん、助けてください」と心の中で呼んでください。',
  '清潔な空間を保つことが守護霊を呼び込む基本です。特に玄関と寝室を整えてください。',
  '月の満ち欠けに合わせて行動すると、守護霊の力を最大限に受け取れます。',
];

const RARITY_TABLE=[
  {r:'UR',label:'★UR★',prob:1},
  {r:'SSR',label:'SSR',prob:10},
  {r:'SR',label:'SR',prob:30},
  {r:'R',label:'R',prob:59},
  {r:'C',label:'C',prob:100},
];

function getRarity(seed){
  const v=Math.abs(strHash(String(seed)+'rarity'))%100;
  if(v<1)return 'UR';
  if(v<10)return 'SSR';
  if(v<30)return 'SR';
  if(v<60)return 'R';
  return 'C';
}

// ─── 演出 ────────────────────────────────────────────────────
function createParticles(rarity){
  const p=document.getElementById('particles');
  p.innerHTML='';
  const colors=rarity==='UR'?['#ffd700','#ff6b35','#ff69b4','#00ffff','#7fff00']:
               rarity==='SSR'?['#ffd700','#ffec8b','#fff8dc']:
               ['#4facfe','#a8edea','#fff'];
  const count=rarity==='UR'?80:rarity==='SSR'?50:30;
  for(let i=0;i<count;i++){
    const d=document.createElement('div');
    const size=Math.random()*6+2;
    const color=colors[Math.floor(Math.random()*colors.length)];
    d.style.cssText=`position:absolute;width:${size}px;height:${size}px;background:${color};border-radius:50%;left:${Math.random()*100}%;top:${Math.random()*100}%;opacity:0;animation:fall ${Math.random()*2+1}s ${Math.random()*2}s ease-in forwards`;
    p.appendChild(d);
  }
  if(!document.getElementById('fallStyle')){
    const s=document.createElement('style');
    s.id='fallStyle';
    s.textContent='@keyframes fall{0%{opacity:1;transform:translateY(-20px) rotate(0deg)}100%{opacity:0;transform:translateY(100vh) rotate(720deg)}}';
    document.head.appendChild(s);
  }
}

function runAnimation(rarity,cb){
  if(rarity==='C'){cb();return;}
  const overlay=document.getElementById('overlay');
  const bg=document.getElementById('overlayBg');
  const burst=document.getElementById('burst');
  const ring1=document.getElementById('ring1');
  const ring2=document.getElementById('ring2');
  const ring3=document.getElementById('ring3');
  const rankEl=document.getElementById('rankReveal');
  overlay.style.pointerEvents='all';
  overlay.classList.add('active');

  const colorMap={
    UR:{bg:'rgba(0,0,0,.95)',ring:'#ffd700',ring2:'#ff69b4',ring3:'#00ffff',text:'transparent',grad:'linear-gradient(135deg,#ff6b35,#ffd700,#ff69b4,#00ffff,#7fff00)'},
    SSR:{bg:'rgba(0,0,0,.9)',ring:'#ffd200',ring2:'#f7971e',ring3:'#ffffd4',text:'#ffd200',grad:null},
    SR:{bg:'rgba(0,0,0,.85)',ring:'#4facfe',ring2:'#00f2fe',ring3:'#a8edea',text:'#4facfe',grad:null},
    R:{bg:'rgba(0,0,0,.8)',ring:'#a18cd1',ring2:'#fbc2eb',ring3:'#c4a8f5',text:'#c4a8f5',grad:null},
  };
  const c=colorMap[rarity];
  createParticles(rarity);

  // 暗転
  setTimeout(()=>{bg.style.opacity='1';},50);
  // バースト
  setTimeout(()=>{
    burst.style.opacity='1';
    const size=rarity==='UR'?'600px':rarity==='SSR'?'450px':'300px';
    [ring1,ring2,ring3].forEach((r,i)=>{
      r.style.cssText=`width:${size};height:${size};border:${3-i}px solid ${[c.ring,c.ring2,c.ring3][i]};opacity:.8;border-radius:50%;position:absolute;transform:scale(0);transition:transform ${.4+i*.1}s ease-out ${i*.1}s, opacity .5s ${.3+i*.1}s`;
    });
    setTimeout(()=>{
      [ring1,ring2,ring3].forEach(r=>{r.style.transform='scale(1)';r.style.opacity='0';});
    },100);
  },400);
  // テキスト
  setTimeout(()=>{
    rankEl.textContent=rarity==='UR'?'★ U R ★':rarity;
    if(c.grad){rankEl.style.background=c.grad;rankEl.style.webkitBackgroundClip='text';rankEl.style.webkitTextFillColor='transparent';}
    else{rankEl.style.color=c.text;rankEl.style.webkitTextFillColor=c.text;}
    if(rarity==='UR')rankEl.style.animation='rainbow 1s ease infinite';
    rankEl.style.opacity='1';rankEl.style.transition='opacity .5s';
    if(rarity==='UR')rankEl.style.fontSize='4rem';
  },700);
  // 終了
  const dur=rarity==='UR'?3200:rarity==='SSR'?2400:1800;
  setTimeout(()=>{
    bg.style.opacity='0';
    burst.style.opacity='0';
    rankEl.style.opacity='0';
    setTimeout(()=>{
      overlay.classList.remove('active');
      overlay.style.pointerEvents='none';
      document.getElementById('particles').innerHTML='';
      cb();
    },700);
  },dur);
}

// ─── 診断 ────────────────────────────────────────────────────
function diagnose(){
  const name=document.getElementById('userName').value.trim();
  const y=document.getElementById('birthYear').value;
  const mo=document.getElementById('birthMonth').value;
  const d=document.getElementById('birthDay').value;
  if(!name||!y||!mo||!d){alert('名前と生年月日をすべて入力してください');return;}
  const key=name+y+mo+d;
  const seed=strHash(key);
  const rarity=getRarity(seed);
  const tribe=pick(TRIBES,seed,'tr');
  const attr1=pick(ATTRS,seed,'a1');
  const attr2=pick(ATTRS.filter(a=>a.n!==attr1.n),seed,'a2');
  const relation=pick(RELATIONS,seed,'rl');
  const specialty=pick(SPECIALTIES,seed,'sp');
  const pname=pick(NAME_PREFIX,seed,'np')+pick(NAME_SUFFIX,seed,'ns');
  const message=pick(MESSAGES,seed,'ms');
  const advice=pick(ADVICES,seed,'av');
  const guardCount=num(1,7,seed,'gc');

  // パワー値（レアリティで底上げ）
  const base={UR:70,SSR:55,SR:40,R:25,C:10}[rarity];
  const powers=[
    {n:'守護力',v:Math.min(99,base+num(0,29,seed,'pw1'))},
    {n:'癒し力',v:Math.min(99,base+num(0,29,seed,'pw2'))},
    {n:'霊格',  v:Math.min(99,base+num(0,29,seed,'pw3'))},
    {n:'縁結び',v:Math.min(99,base+num(0,29,seed,'pw4'))},
    {n:'厄除け',v:Math.min(99,base+num(0,29,seed,'pw5'))},
  ];
  const pwColors={UR:'linear-gradient(90deg,#ff6b35,#ffd700)',SSR:'linear-gradient(90deg,#f7971e,#ffd200)',SR:'linear-gradient(90deg,#4facfe,#00f2fe)',R:'linear-gradient(90deg,#a18cd1,#fbc2eb)',C:'linear-gradient(90deg,#8a7db5,#c4a8f5)'};

  window._shareText=`【守護霊診断】私の守護霊は${rarity}「${pname}」(${tribe.r})でした！守護力${powers[0].v}の${attr1.n}属性✨ ▼あなたの守護霊は？ https://life-fun.net/guardian`;

  // LocalStorage保存（将来のマイページ用）
  try{localStorage.setItem('life_fun_guardian',JSON.stringify({name:pname,tribe:tribe.r,rarity,attr:attr1.n,emoji:tribe.e,updatedAt:Date.now()}));}catch(e){}

  runAnimation(rarity,()=>{
    // DOM更新
    document.getElementById('rarityBadge').textContent=rarity==='UR'?'★ UR ★':rarity;
    document.getElementById('rarityBadge').className='rarity-badge rarity-'+rarity;
    document.getElementById('guardianEmoji').textContent=tribe.e;
    document.getElementById('guardianTypeLabel').textContent=tribe.r;
    document.getElementById('guardianName').textContent=pname;
    document.getElementById('resNameLabel').textContent=name+' さんの守護霊';
    document.getElementById('resTribe').textContent=tribe.r;
    document.getElementById('resTribeSub').textContent=tribe.s;
    document.getElementById('resRelation').textContent=relation.r;
    document.getElementById('resRelationSub').textContent=relation.s;
    document.getElementById('resCount').textContent=guardCount+'体の守護霊';
    document.getElementById('resSpecialty').textContent=specialty;
    document.getElementById('resMessage').textContent=message;
    document.getElementById('resAdvice').textContent=advice;

    // 属性バッジ
    const ab=document.getElementById('attrBadges');
    ab.innerHTML='';
    [attr1,attr2].forEach(a=>{
      const s=document.createElement('span');
      s.className='attr-badge';
      s.style.cssText=`background:${a.bg};color:${a.c};border:1px solid ${a.c}40`;
      s.textContent=a.n+'属性';
      ab.appendChild(s);
    });

    // パワーバー
    const pb=document.getElementById('powerBars');
    pb.innerHTML='';
    powers.forEach(p=>{
      pb.innerHTML+=`<div class="power-row"><span class="power-name">${p.n}</span><div class="power-bar-bg"><div class="power-bar-fill" style="width:0%;background:${pwColors[rarity]}" data-val="${p.v}"></div></div><span class="power-val">${p.v}</span></div>`;
    });
    setTimeout(()=>{document.querySelectorAll('.power-bar-fill').forEach(el=>{el.style.width=el.dataset.val+'%';});},100);

    // 相性
    const cg=document.getElementById('compatGood');
    const cb2=document.getElementById('compatBad');
    cg.innerHTML='';cb2.innerHTML='';
    tribe.compat.forEach(t=>{const s=document.createElement('span');s.className='compat-tag';s.textContent='✓ '+t;cg.appendChild(s);});
    tribe.bad.forEach(t=>{const s=document.createElement('span');s.className='compat-tag bad';s.textContent='△ '+t;cb2.appendChild(s);});

    // カードスタイル
    const karte=document.getElementById('karteCard');
    karte.className='karte karte-'+rarity.toLowerCase();

    document.getElementById('formArea').style.display='none';
    scrollToResult('result');
  });
}

function resetForm(){
  document.getElementById('formArea').style.display='block';
  document.getElementById('result').style.display='none';
  window.scrollTo({top:0,behavior:'smooth'});
}
function toggleSpMenu(){
  const d=document.getElementById('spDropdown');
  d.style.display=d.style.display==='block'?'none':'block';
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    const d=document.getElementById('spDropdown');if(d)d.style.display='none';
  }
});
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
</script>
</body>
</html>
