<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="名前と生年月日から前世を診断。何回目の転生か、どの時代のどこで何者だったか、魂のカルテを生成します。">
<title>前世診断｜あなたは何回目の転生？魂のカルテ</title>
<link rel="canonical" href="https://life-fun.net/zense" />
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
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}

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
@media(max-width:700px){
  .header-nav{display:none}
  .sp-menu-btn{display:block}
}

/* ─── LAYOUT ─── */
.wrap{max-width:900px;margin:0 auto;padding:2rem 1.2rem 4rem}
.page-title{text-align:center;margin-bottom:2.5rem}
.page-title h1{font-family:var(--ff-serif);font-size:1.6rem;font-weight:700;letter-spacing:.1em;color:var(--text);margin-bottom:.4rem}
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
.submit-btn{width:100%;padding:1rem;background:linear-gradient(135deg,rgba(155,114,239,.8),rgba(201,168,76,.7));border:none;border-radius:10px;font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;color:#fff;cursor:pointer;margin-top:.5rem;letter-spacing:.12em;transition:opacity .2s;position:relative;overflow:hidden}
.submit-btn:hover{opacity:.88}
.submit-btn::before{content:'✦ ';font-size:.8rem}
.submit-btn::after{content:' ✦';font-size:.8rem}

/* ─── RESULT ─── */
#result{display:none;max-width:600px;margin:0 auto}
.karte{background:linear-gradient(160deg,var(--card) 0%,var(--card2) 100%);border:1px solid rgba(201,168,76,.3);border-radius:20px;padding:2rem;position:relative;overflow:hidden}
.karte::before{content:'';position:absolute;top:-60px;right:-60px;width:200px;height:200px;background:radial-gradient(circle,rgba(201,168,76,.08) 0%,transparent 70%);pointer-events:none}
.karte-header{text-align:center;margin-bottom:1.8rem;padding-bottom:1.2rem;border-bottom:1px solid var(--border)}
.karte-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:.5rem}
.karte-name{font-family:var(--ff-serif);font-size:1.4rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
.life-count{display:inline-block;background:linear-gradient(135deg,rgba(201,168,76,.2),rgba(155,114,239,.15));border:1px solid rgba(201,168,76,.35);border-radius:30px;padding:.3rem 1.2rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.12em;color:var(--gold-lt);margin-top:.4rem}
.soul-age-label{font-size:.65rem;color:var(--muted);margin-top:.5rem;font-family:var(--ff-mono);letter-spacing:.08em}

.karte-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem}
@media(max-width:520px){.karte-grid{grid-template-columns:1fr}}
.karte-item{background:rgba(0,0,0,.25);border:1px solid var(--border);border-radius:12px;padding:.9rem 1rem}
.karte-item-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.35rem}
.karte-item-value{font-family:var(--ff-serif);font-size:.95rem;color:var(--text);font-weight:600}
.karte-item-sub{font-size:.7rem;color:var(--muted);margin-top:.2rem}

.soul-attr{background:linear-gradient(135deg,rgba(155,114,239,.15),rgba(232,113,154,.1));border:1px solid rgba(155,114,239,.3);border-radius:12px;padding:1rem 1.2rem;margin-bottom:1.2rem;text-align:center}
.soul-attr-name{font-family:var(--ff-serif);font-size:1.2rem;font-weight:700;color:var(--violet-lt);margin-bottom:.3rem}
.soul-attr-desc{font-size:.78rem;color:var(--muted);line-height:1.7}

.keywords-row{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.5rem;justify-content:center}
.keyword-tag{background:rgba(78,205,196,.08);border:1px solid rgba(78,205,196,.25);border-radius:20px;padding:.3rem .9rem;font-family:var(--ff-mono);font-size:.68rem;color:var(--teal);letter-spacing:.08em}

.last-life{background:rgba(0,0,0,.3);border-left:3px solid var(--muted);border-radius:0 10px 10px 0;padding:.8rem 1rem;margin-bottom:1.5rem;font-size:.8rem;color:var(--muted);line-height:1.8;font-style:italic}
.last-life-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.4rem;font-style:normal}

.message-box{background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(155,114,239,.06));border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.2rem 1.4rem;margin-bottom:1.5rem}
.message-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.18em;color:var(--gold);text-transform:uppercase;margin-bottom:.6rem}
.message-text{font-family:var(--ff-serif);font-size:.92rem;color:var(--text);line-height:2}

.mission-box{text-align:center;padding:.8rem 1rem;border-top:1px solid var(--border);margin-top:.5rem}
.mission-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:.4rem}
.mission-text{font-family:var(--ff-serif);font-size:.9rem;color:var(--violet-lt);font-weight:600}

.share-area{text-align:center;margin-top:1.5rem}
.share-label{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.55rem}
.share-btns{display:flex;justify-content:center;gap:.45rem;flex-wrap:wrap;margin-bottom:1rem}
.share-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.5rem 1rem;border-radius:20px;font-size:.75rem;font-family:var(--ff-sans);cursor:pointer;text-decoration:none;border:none;transition:opacity .2s;white-space:nowrap;font-weight:600}
.share-btn:hover{opacity:.8}
.share-line{background:#06C755;color:#fff}
.share-x{background:#000;color:#fff}
.share-fb{background:#1877F2;color:#fff}
.share-copy{background:rgba(155,114,239,.15);border:1px solid rgba(155,114,239,.35)!important;color:var(--violet-lt)}
.retry-btn{display:inline-block;padding:.65rem 1.4rem;background:rgba(155,114,239,.15);border:1px solid var(--border2);color:var(--violet-lt);border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;cursor:pointer}

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
<?php $currentPage='zense'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <div class="page-title">
    <div class="subtitle">Past Life Reading</div>
    <h1>前世診断</h1>
    <p style="font-size:.8rem;color:var(--muted);margin-top:.5rem">あなたは今、何回目の転生を生きているのか。<br>魂のカルテを読み解きます。</p>
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
        <select class="form-input" id="birthYear">
          <option value="">年</option>
        </select>
        <select class="form-input" id="birthMonth">
          <option value="">月</option>
        </select>
        <select class="form-input" id="birthDay">
          <option value="">日</option>
        </select>
      </div>
    </div>
    <button class="submit-btn" onclick="diagnose()">前世を読み解く</button>
    <p style="font-size:.65rem;color:var(--muted);text-align:center;margin-top:.8rem;line-height:1.7">入力された情報はサーバーに送信・保存されません。<br>同じ名前・生年月日からは毎回同じ結果が表示されます。<br><span style="color:rgba(138,125,181,.5)">※本サービスはエンターテインメントです。重要な判断の根拠にはしないでください。</span></p>
  </div>

  <div id="result">
    <div class="karte" id="karteCard">
      <div class="karte-header">
        <div class="karte-label">Soul Record — 魂のカルテ</div>
        <div class="karte-name" id="resName"></div>
        <div class="life-count" id="resLifeCount"></div>
        <div class="soul-age-label" id="resSoulAge"></div>
      </div>

      <div class="karte-grid">
        <div class="karte-item">
          <div class="karte-item-label">Era — 前世の時代</div>
          <div class="karte-item-value" id="resEra"></div>
        </div>
        <div class="karte-item">
          <div class="karte-item-label">Region — 前世の地</div>
          <div class="karte-item-value" id="resRegion"></div>
        </div>
        <div class="karte-item">
          <div class="karte-item-label">Role — 前世の身分</div>
          <div class="karte-item-value" id="resRole"></div>
          <div class="karte-item-sub" id="resRoleSub"></div>
        </div>
        <div class="karte-item">
          <div class="karte-item-label">End — 前世の最期</div>
          <div class="karte-item-value" id="resEnd"></div>
        </div>
      </div>

      <div class="soul-attr">
        <div class="karte-item-label" style="margin-bottom:.4rem">Soul Type — 魂の属性</div>
        <div class="soul-attr-name" id="resSoulType"></div>
        <div class="soul-attr-desc" id="resSoulDesc"></div>
      </div>

      <div class="karte-item-label" style="margin-bottom:.5rem;text-align:center">Keywords — 前世のキーワード</div>
      <div class="keywords-row" id="resKeywords"></div>

      <div class="last-life">
        <div class="last-life-label">前世のストーリー</div>
        <span id="resStory"></span>
      </div>

      <div class="message-box">
        <div class="message-label">✦ 今世へのメッセージ ✦</div>
        <div class="message-text" id="resMessage"></div>
      </div>

      <div class="mission-box">
        <div class="mission-label">今世の使命</div>
        <div class="mission-text" id="resMission"></div>
      </div>
    </div>

    <div class="share-area">
      <p class="share-label">✦ 結果をシェアする</p>
      <div class="share-btns">
        <button class="share-btn share-line" onclick="openShare('line')">LINE</button>
        <button class="share-btn share-x" onclick="openShare('x')">𝕏</button>
        <button class="share-btn share-fb" onclick="openShare('fb')">Facebook</button>
        <button class="share-btn share-copy" onclick="copyShareUrl()">🔗 リンクをコピー</button>
      </div>
      <span class="retry-btn" onclick="resetForm()">もう一度診断</span>
      <?php require_once __DIR__.'/inc/nav-cards.php'; ?>
      <div class="nav-cards-section" style="padding:2rem 0 0"><h3>✦ 次はこれを試してみては？ ✦</h3><?= _nav_cards(3,'zense') ?></div>
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
function seededPick(arr,seed,salt){
  return arr[Math.abs(strHash(String(seed)+String(salt)))%arr.length];
}
function seededNum(min,max,seed,salt){
  return min+Math.abs(strHash(String(seed)+String(salt)))%(max-min+1);
}

// ─── データ ──────────────────────────────────────────────────
const ERAS=[
  '縄文時代','弥生時代','古墳時代','飛鳥時代','奈良時代','平安時代',
  '鎌倉時代','室町時代','戦国時代','江戸時代初期','江戸時代中期','江戸時代末期',
  '明治時代','古代エジプト時代','古代メソポタミア時代','古代ギリシャ時代',
  '古代ローマ時代','中世ヨーロッパ','十字軍の時代','ルネサンス期',
  '大航海時代','産業革命期','古代中国（漢）','古代中国（唐）','中国（明）',
  'モンゴル帝国時代','インダス文明期','マヤ文明期','バイキング時代',
  'ペルシャ帝国時代','オスマン帝国時代','チベット王国時代','アステカ文明期',
  'ビザンツ帝国時代'
];
const REGIONS=[
  '日本（京都・平安京）','日本（江戸・下町）','日本（鎌倉）','日本（東北・山深い村）',
  '日本（沖縄・琉球）','日本（北海道・アイヌの地）','エジプト（ナイル川沿岸）',
  'メソポタミア（チグリス川流域）','ギリシャ（アテネ）','ローマ（コロッセオ周辺）',
  'フランス（パリ）','フランス（南部・プロヴァンス）','イギリス（ロンドン）',
  'イタリア（フィレンツェ）','スペイン（アンダルシア）','ドイツ（ライン川沿い）',
  'スカンジナビア（フィヨルドの地）','北アフリカ（砂漠のオアシス）',
  '中国（長安・都）','中国（江南・水郷）','モンゴル高原','インド（ガンジス川流域）',
  'インド（南端・海辺）','シルクロード沿い（中継都市）','アラビア半島',
  'ペルシャ（現イラン）','チベット高原','東南アジア（熱帯の密林）',
  'メキシコ高原（テオティワカン）','ペルー（アンデス山脈）',
  '西アフリカ（王国の都）','シベリア（遊牧の大地）','中東（エルサレム）',
  'ビザンツ（コンスタンティノープル）','カリブ海の島','北米（大平原）',
  'ポリネシア（南海の島）','バルカン半島'
];
const ROLES=[
  {r:'武士',s:'刀一本で生きた誇り高き戦士'},
  {r:'忍者',s:'闇に潜み、影で歴史を動かした者'},
  {r:'巫女',s:'神と人の間に立ち、祈りを捧げた者'},
  {r:'陰陽師',s:'見えない力を読み、世の調和を保った者'},
  {r:'歌舞伎役者',s:'舞台の上で生き、美を極めた者'},
  {r:'茶人',s:'一服の茶に宇宙を見出した求道者'},
  {r:'商人',s:'道をつなぎ、富と文化を運んだ者'},
  {r:'農民',s:'大地を耕し、命の循環の中に生きた者'},
  {r:'漁師',s:'海と対話しながら自然と生きた者'},
  {r:'鍛冶師',s:'火と鉄を操り、形に魂を吹き込んだ者'},
  {r:'薬草師',s:'自然の恵みで病を癒やした者'},
  {r:'大工・建築家',s:'石と木で時代を超える構造物を建てた者'},
  {r:'ファラオの神官',s:'神殿に仕え、秘儀と知恵を守った者'},
  {r:'奴隷から解放された者',s:'苦難の末に自由と尊厳を手にした魂'},
  {r:'砂漠の商隊長',s:'果てしない砂漠を越え、文明をつないだ者'},
  {r:'哲学者',s:'真理を求め、問いを問い続けた者'},
  {r:'彫刻家・芸術家',s:'美を創ることを使命とした魂'},
  {r:'剣闘士',s:'闘技場で命を賭けて戦い続けた者'},
  {r:'元老院議員',s:'権力の中枢で国の行方を決めた者'},
  {r:'騎士',s:'名誉と信義のために戦った者'},
  {r:'吟遊詩人',s:'言葉と歌で旅をし、記憶を伝えた者'},
  {r:'修道士・修道女',s:'神への奉仕に生涯を捧げた者'},
  {r:'錬金術師',s:'物質と魂の変容を探求し続けた者'},
  {r:'魔女・呪術師',s:'禁じられた知恵を持ち、民に仕えた者'},
  {r:'王族・貴族',s:'権力と孤独の中で生きた者'},
  {r:'探検家',s:'未知の地を求め、海原へ漕ぎ出した者'},
  {r:'海賊',s:'自由を何より愛し、海を駆けた者'},
  {r:'宣教師',s:'信仰を胸に異国の地を歩き続けた者'},
  {r:'儒学者',s:'礼と道を学び、人の在り方を教えた者'},
  {r:'道士',s:'山に籠り、自然の理を体得した者'},
  {r:'遊牧民の族長',s:'広大な草原を率い、民を守った者'},
  {r:'天文学者',s:'星を読み、宇宙の秩序を解こうとした者'},
  {r:'詩人',s:'言葉で魂を揺さぶり続けた者'},
  {r:'チベット僧',s:'輪廻の理を理解し、悟りを目指した者'},
  {r:'狩人',s:'森と動物と共に生き、自然の一部だった者'},
  {r:'宮廷画家',s:'権力者の傍らで美と記録を担った者'},
  {r:'革命家',s:'古い秩序を壊し、新しい時代を切り拓いた者'},
  {r:'医師',s:'人の命と向き合い、救い続けた者'},
  {r:'占い師・預言者',s:'未来を見通し、人々の道を照らした者'},
  {r:'作曲家・音楽家',s:'音で感情を形にし、時代を超えて残した者'},
];
const SOUL_TYPES=[
  {n:'守護の魂',d:'人を守り支えることに喜びを感じる魂。前世でも誰かのために命を懸ける場面があった。今世でも、誰かの支えになることで魂が輝く。'},
  {n:'革命の魂',d:'時代を変える炎を宿した魂。現状に満足できず、常に「もっと良くなれるはず」と動き続ける。その衝動が世界を少しずつ動かしている。'},
  {n:'創造の魂',d:'美と表現で世界を豊かにする魂。作ること、生み出すことに本能的な喜びを感じる。前世でも何かを形にすることで人々の心を動かしていた。'},
  {n:'智慧の魂',d:'真理を探求し続ける魂。なぜ、どうして、という問いが止まらない。知ることそのものが魂の喜びであり、前世でも学びを手放さなかった。'},
  {n:'癒しの魂',d:'傷ついた者に光をもたらす魂。人の痛みに敏感で、自然と寄り添う力がある。前世でも、その優しさで多くの人の心を救っていた。'},
  {n:'伝達の魂',d:'橋をかけ、言葉と想いを運ぶ魂。人と人をつなぐことが使命。前世でも文化や知識を次の世代へと渡す役割を担っていた。'},
  {n:'冒険の魂',d:'未知へと踏み出す勇気の魂。安定よりも新しい地平を求める。前世でも誰も踏み込まなかった場所へと足を向け、歴史を塗り替えていた。'},
  {n:'調和の魂',d:'対立を和らげ、均衡を保つ魂。争いを見ると居ても立ってもいられない。前世でも、その穏やかさが場の空気を一変させていた。'},
  {n:'神秘の魂',d:'見えない世界と繋がる魂。直感が鋭く、夢や予感に意味を感じやすい。前世でも霊的な力や秘密の知恵に関わっていた。'},
  {n:'正義の魂',d:'正しさのために戦う魂。理不尽を黙って見過ごすことができない。前世でも、時に危険を冒してでも筋を通し続けた。'},
  {n:'変容の魂',d:'苦しみを通じて進化する魂。何度も崩れ、何度も再生する。その軌跡こそが最大の財産であり、魂の深みを作っている。'},
  {n:'繁栄の魂',d:'豊かさを生み出し循環させる魂。何もないところから価値を作り出す才能がある。前世でも富や文化を生み出し、多くの人を潤していた。'},
];
const KEYWORDS=[
  '孤独と強さ','愛と別れ','忠誠','秘密','信仰','革命','孤高','愛国心','放浪',
  '探求','沈黙の知者','芸術への執念','無私の奉仕','権力との葛藤','自由への渇望',
  '言葉の力','自然との共存','見えない絆','時代の犠牲','運命への抵抗','師弟の絆',
  '裏切りと赦し','夢と現実','大義のための孤独','禁じられた知恵','海への憧れ',
  '生と死の境界','土地への愛着','未来への伝言','民のための戦い','美への献身',
  '神との対話','身分を超えた愛','戦場の静寂','星の導き','祈りの積み重ね',
  '火の洗礼','大地の記憶','風のような生き様','水のような柔軟さ','鉄の意志',
  '黎明期の証人','時代の狭間','名もなき英雄','記録された知恵','口伝の文化',
  '禁忌への好奇心','変装した賢者','辺境の開拓者','復讐と解放','終わりなき問い',
  '月と太陽','夜明け前の闇','光と影の使者','永遠の旅人','砂漠の一滴',
  '壁の向こう側','消えた文明の記憶','最後の証人','新天地への跳躍'
];
const ENDINGS=[
  '多くの人に看取られた、穏やかな大往生','使命を果たし終えたと感じながらの、静かな旅立ち',
  '戦場で刀を手に散った、壮絶な最期','愛する者を守るために命を捧げた死',
  '真実を語ったために迫害され、倒れた死','旅の途中、異国の地で迎えた孤独な最期',
  '海の彼方へと消えた、謎に包まれた最期','自然の猛威（嵐・地震・洪水）に飲み込まれた死',
  '長命を全うし、弟子たちに囲まれた穏やかな死','病に倒れたが、魂は晴れやかだった死',
  '飢饉の中で民を優先し、自らは空腹のままだった死','陰謀に巻き込まれ、無念を残した死',
  '夢の途中で眠るように逝った死','信じた道を貫いた末の、誇り高い死',
  '裏切りによって倒れた、悲劇的な最期','芸の極みを残し、舞台の上で逝った芸術家の死',
  '一人で山奥に消えた、仙人のような最期','祈りの中で逝った、聖者のような死',
  '民のために生き、民に見送られた死','秘密を誰にも明かさないまま消えた死',
  '革命の炎とともに燃え尽きた死','書物を残し、言葉として生き続けることを選んだ死',
  '異国の文化の中に溶け込み、そこで逝った死','医療が届かない辺境の地で、静かに倒れた死',
  '愛に破れた末の、哀しく美しい最期','時代の変わり目に身を投じた、歴史の一部となった死',
  '弟子に看取られた、師としての最期','海賊として海に還っていった死',
  '転生の準備が整い、自ら旅立つことを選んだ魂の旅立ち','最後まで笑顔だったと伝えられている死'
];
const MESSAGES=[
  '前世で果たせなかった「本当の自分を生きること」が、今世のテーマです。他人の期待より、自分の声に耳を傾けて。',
  '前世であなたは孤独の中で戦い続けました。今世では、人に頼る勇気を持つことが魂の成長につながります。',
  '前世の記憶が、あなたの「なぜか得意なこと」として残っています。それを磨くことで使命が開きます。',
  '前世で誰かを深く愛したあなたへ。今世でも、その愛の深さは変わりません。恐れずに心を開いてください。',
  '何度も繰り返してきた「諦め」のパターンを、今世で終わらせるチャンスがあります。もう一歩だけ進んでみて。',
  '前世での知恵が今世の直感として現れています。「なぜかわかる」と感じることを、もっと信じてください。',
  'あなたの魂は長い旅をしてきました。今世こそ、自分自身を大切にすることを最初の使命にしてください。',
  '前世で「言えなかった言葉」があります。今世では、その想いを素直に伝えることが大切な課題です。',
  '苦労を引き受けすぎる傾向は、前世からの習慣です。今世では、受け取ることも覚えてください。',
  '前世で見ていた景色が、今世のどこかで再現されます。強いデジャヴを感じたとき、それが魂の約束の場所です。',
  '前世での傷が、今世の「過剰な慎重さ」として残っています。安全圏の少し外に、あなたの宝があります。',
  '前世であなたは多くを与え続けました。今世では、受け取ることを罪に思わないでください。',
  '転生を重ねるうちに蓄積した「怒り」を手放すことが、今世の大きなテーマです。許しは相手のためでなく、自分のために。',
  '前世で途中で終わった「夢」があります。今世でそれを形にすることが、魂の本当の望みかもしれません。',
  'あなたが「なぜか惹かれる時代・文化・場所」は、前世の記憶の断片です。その好奇心を大切に。',
  '前世での孤高の生き方が今世の「孤独感」に繋がっています。仲間との絆を築くことで魂が軽くなります。',
  '今世のあなたには、前世では出会えなかった「最高の仲間」と巡り合う予定があります。',
  '前世で信じたものに裏切られた経験が、今世の不信感の根にあります。それでも信じることが、最後の扉を開きます。',
  '何世代にもわたって磨いてきた才能が、今世で開花するタイミングを迎えています。',
  '前世では「自分より他者」で生きました。今世のテーマは「自分を大切にすることが周りを救う」です。',
  '前世の記憶が夢として現れることがあります。繰り返し見る夢は、魂のメッセージかもしれません。',
  '前世で守れなかった大切な人への想いが、今世の「誰かを守りたい」という衝動になっています。',
  '長い転生の旅の中で、あなたは多くの時代を見てきました。その視野の広さが今世の強みです。',
  '前世で「やりたかったのにできなかったこと」こそ、今世で最初に挑戦すべきことです。',
  '魂の記憶には、まだあなたが気づいていない才能が眠っています。直感に従って試してみてください。',
  '今世があなたにとって、ある意味で「最後の大きなチャレンジ」かもしれません。力を出し切って。',
  '前世での「もっと笑えばよかった」という後悔が、今世の「もっと楽しんでいい」というメッセージです。',
  '前世で積んだ徳が、今世の「なぜか助けられる体験」として現れています。その縁を大切に。',
  '魂の疲れを感じることがあるなら、それは転生の数が教えてくれているサインです。立ち止まる勇気も必要です。',
  '前世での「秘密」が今世の「語れない何か」として残っています。少しずつ自分を開いていくことで楽になります。',
];
const MISSIONS=[
  '愛する人を全力で愛し、愛されることを受け入れること',
  '自分が本当にやりたいことを、恐れずに始めること',
  '前世で傷つけた誰かの魂と和解すること（それは今世の誰かとして現れています）',
  '持って生まれた才能を社会のために使うこと',
  '人に頼り、繋がりを深めること',
  '今まで避けてきたことに、正面から向き合うこと',
  '自分の内側の声を信頼し、行動に移すこと',
  '感謝の心を日常の中に取り戻すこと',
  '誰かの人生に、忘れられない光を灯すこと',
  '「足りない」ではなく「十分にある」という視点に転換すること',
  '傷を癒やすのではなく、傷から育つこと',
  '自由を手にし、その自由を誰かと分かち合うこと',
  '今この瞬間を、前世の自分が夢見ていた場所として生きること',
  '魂が望む場所へ、勇気を持って移動すること',
  '自分の言葉で、世界に何かを残すこと',
  '平和な心を保ちながら、激動の時代を生き抜くこと',
  '受け取ることを学び、与えることのバランスを取ること',
  '長年の執着を手放し、軽やかに生きること',
  '過去の自分を赦し、今の自分を丸ごと認めること',
  '子孫や未来の世代への贈り物を残すこと',
];

// ─── ストーリー生成 ──────────────────────────────────────────
function buildStory(era,region,role,ending,seed){
  const openings=[
    `${era}の${region}。あなたの魂は${role}として、`,
    `${era}――${region}の地に生を受けたあなたは、${role}として、`,
    `かつて${region}と呼ばれた地、${era}のこと。${role}だったあなたは、`,
  ];
  const middles=[
    '自らの信念を曲げることなく生き続けました。',
    '多くの出会いと別れを経験しながら、使命を果たそうとしました。',
    '誰も歩まなかった道を、自らの足で切り拓いていきました。',
    '時代の荒波の中で、揺れながらも中心を失わずにいました。',
    '愛するものを守るために、すべてを懸けた日々がありました。',
    '表舞台には出ないが、確かに歴史の裏側を支えていました。',
    '孤独を友として、深い洞察と知恵を磨き続けました。',
  ];
  const endings2=[
    `その生の最後は、「${ending}」でした。`,
    `やがて迎えたのは「${ending}」。`,
    `そしてその命は「${ending}」という形で幕を閉じました。`,
  ];
  return seededPick(openings,seed,'so')+seededPick(middles,seed,'sm')+seededPick(endings2,seed,'se');
}

// ─── 転生回数と魂年齢ラベル ─────────────────────────────────────
function getSoulAgeLabel(n){
  if(n<=10)return '✦ 魂の新参者（生まれたての光）';
  if(n<=50)return '✦ 学びの途中にある魂';
  if(n<=150)return '✦ 経験を重ねた魂';
  if(n<=400)return '✦ 深みを増した古い魂';
  return '✦ 伝説級の古魂（ヴェテラン・ソウル）';
}

// ─── 診断 ───────────────────────────────────────────────────
function diagnose(){
  const name=document.getElementById('userName').value.trim();
  const y=document.getElementById('birthYear').value;
  const mo=document.getElementById('birthMonth').value;
  const d=document.getElementById('birthDay').value;
  if(!name||!y||!mo||!d){alert('名前と生年月日をすべて入力してください');return;}

  const key=name+y+mo+d;
  const seed=strHash(key);

  const lcRaw=Math.abs(strHash(String(seed)+'lc'))%100;
  let lifeCount;
  if(lcRaw<90){lifeCount=1+Math.abs(strHash(String(seed)+'lc2'))%10;}
  else if(lcRaw<95){lifeCount=11+Math.abs(strHash(String(seed)+'lc3'))%90;}
  else{lifeCount=101+Math.abs(strHash(String(seed)+'lc4'))%899;}
  const era=seededPick(ERAS,seed,'er');
  const region=seededPick(REGIONS,seed,'rg');
  const roleObj=seededPick(ROLES,seed,'ro');
  const soulType=seededPick(SOUL_TYPES,seed,'st');
  const ending=seededPick(ENDINGS,seed,'en');
  const message=seededPick(MESSAGES,seed,'ms');
  const mission=seededPick(MISSIONS,seed,'mi');

  // キーワード3つ（重複なし）
  const kwSet=new Set();
  let kwidx=0;
  while(kwSet.size<3){kwSet.add(seededPick(KEYWORDS,seed,'kw'+kwidx));kwidx++;}
  const kws=[...kwSet];

  const story=buildStory(era,region,roleObj.r,ending,seed);

  // DOM更新
  document.getElementById('resName').textContent=name+' さんの前世';
  document.getElementById('resLifeCount').textContent='今世は転生 '+lifeCount+' 回目';
  document.getElementById('resSoulAge').textContent=getSoulAgeLabel(lifeCount);
  document.getElementById('resEra').textContent=era;
  document.getElementById('resRegion').textContent=region;
  document.getElementById('resRole').textContent=roleObj.r;
  document.getElementById('resRoleSub').textContent=roleObj.s;
  document.getElementById('resEnd').textContent=ending.length>20?ending.slice(0,20)+'…':ending;
  document.getElementById('resSoulType').textContent=soulType.n;
  document.getElementById('resSoulDesc').textContent=soulType.d;
  document.getElementById('resStory').textContent=story;
  document.getElementById('resMessage').textContent=message;
  document.getElementById('resMission').textContent=mission;

  const kwEl=document.getElementById('resKeywords');
  kwEl.innerHTML='';
  kws.forEach(k=>{const s=document.createElement('span');s.className='keyword-tag';s.textContent=k;kwEl.appendChild(s);});

  window._shareText=`【前世診断】私の前世は${era}の${region}で生きた「${roleObj.r}」。転生${lifeCount}回目の魂タイプは「${soulType.n}」でした。▼あなたの前世は？ https://life-fun.net/zense`;

  document.getElementById('formArea').style.display='none';
  document.getElementById('result').style.display='block';
  document.getElementById('result').scrollIntoView({behavior:'smooth',block:'start'});
}

function openShare(type){
  const u=encodeURIComponent('https://life-fun.net/zense');
  const txt=window._shareText||'前世診断';
  const urls={
    line:'https://line.me/R/msg/text/?'+encodeURIComponent(txt),
    x:'https://twitter.com/intent/tweet?text='+encodeURIComponent(txt),
    fb:'https://www.facebook.com/sharer/sharer.php?u='+u,
  };
  window.open(urls[type],'_blank','noopener');
}
function copyShareUrl(){
  navigator.clipboard.writeText('https://life-fun.net/zense').then(()=>{
    const b=document.querySelector('.share-copy');const orig=b.textContent;b.textContent='✓ コピーしました！';setTimeout(()=>b.textContent=orig,2000);
  });
}
function resetForm(){
  document.getElementById('formArea').style.display='block';
  document.getElementById('result').style.display='none';
  window.scrollTo({top:0,behavior:'smooth'});
}

</script>
</body>
</html>
