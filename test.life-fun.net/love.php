<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/love-orchestrator.php';
require_once __DIR__ . '/inc/mbti-data.php';
require_once __DIR__ . '/inc/blood-data.php';

// ─────────────────────────────────────────────
// APIモード：診断リクエスト（POST）はJSONを返して終了する。
// love_diagnose()自体はPHP資産（axis-engine.php等）に依存するため、
// クライアントサイドJSでは計算できない（既存の占いページ群と異なる点）。
// ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');

    $input = json_decode(file_get_contents('php://input') ?: '', true);
    $mbtiType = is_array($input) ? ($input['mbti'] ?? '') : '';
    $bloodType = is_array($input) ? ($input['blood'] ?? '') : '';
    $birthday = is_array($input) ? ($input['birthday'] ?? '') : '';

    if (!isset(MBTI_DATA[$mbtiType]) || !isset(BLOOD_DATA[$bloodType])
        || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
        http_response_code(400);
        echo json_encode(['error' => '入力が不正です'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    [, $month, $day] = array_map('intval', explode('-', $birthday));

    try {
        $result = love_diagnose($mbtiType, $bloodType, $month, $day, 'U');
        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } catch (Throwable $e) {
        http_response_code(500);
        echo json_encode(['error' => '診断に失敗しました'], JSON_UNESCAPED_UNICODE);
    }
    exit;
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
<link rel="canonical" href="https://life-fun.net/love.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="MBTI×血液型×星座で導く恋愛傾向診断。3つの入力からあなたの恋愛スタイル・傾向をひも解きます。">
<title>恋愛診断｜MBTI×血液型×星座</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<!-- AdSense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #08060f;
  --card:    #1e1738;
  --card2:   #251d42;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.32);
  --gold:    #c9a84c;
  --gold-lt: #e8c96a;
  --violet:  #9b72ef;
  --violet-lt:#c4a8f5;
  --rose:    #e8719a;
  --teal:    #4ecdc4;
  --text:    #e8e2f5;
  --muted:   #8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}
body::before{
  content:'';position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),
    radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);
  pointer-events:none;z-index:0;
}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.8rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--rose) 0%,var(--violet-lt) 50%,var(--gold-lt) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem;margin-bottom:1.5rem}
.tool-desc p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.tool-desc p:last-child{margin-bottom:0}

.shindan-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:2rem;margin-bottom:2rem;position:relative;overflow:hidden}
.shindan-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--rose),var(--violet),var(--gold))}

.progress-wrap{margin-bottom:1.5rem}
.progress-label{display:flex;justify-content:space-between;font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-bottom:.5rem;letter-spacing:.08em}
.progress-bar{height:3px;background:rgba(160,130,220,.15);border-radius:2px}
.progress-fill{height:3px;background:linear-gradient(90deg,var(--rose),var(--gold));border-radius:2px;transition:width .4s ease}

.select-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);margin-bottom:.6rem}
.select-hint{font-size:.8rem;color:var(--muted);margin-bottom:1.2rem;line-height:1.7}
.select-hint a{color:var(--violet-lt);text-decoration:underline;text-underline-offset:3px}

.mbti-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem;margin-bottom:1.5rem}
.mbti-btn{background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.6rem .2rem;text-align:center;font-family:var(--ff-mono);font-size:.8rem;color:var(--muted);cursor:pointer;transition:background .2s,border-color .2s,color .2s;letter-spacing:.04em}
.mbti-btn:hover{background:rgba(155,114,239,.12);color:var(--text)}
.mbti-btn.selected{background:rgba(155,114,239,.2);border-color:var(--violet);color:var(--violet-lt)}

.blood-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.6rem;margin-bottom:1.5rem}
.blood-btn{background:rgba(232,113,154,.06);border:1px solid var(--border);border-radius:8px;padding:1rem .3rem;text-align:center;font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--muted);cursor:pointer;transition:background .2s,border-color .2s,color .2s}
.blood-btn:hover{background:rgba(232,113,154,.12);color:var(--text)}
.blood-btn.selected{background:rgba(232,113,154,.18);border-color:var(--rose);color:var(--rose)}

.nav-row{display:flex;justify-content:space-between;align-items:center;margin-top:1.5rem}
.back-btn{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.4rem .9rem;cursor:pointer;letter-spacing:.06em;transition:color .2s,border-color .2s}
.back-btn:hover{color:var(--text);border-color:var(--border2)}
.next-btn{font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;background:linear-gradient(135deg,var(--rose),rgba(232,113,154,.7));border:none;border-radius:8px;padding:.55rem 1.5rem;color:#fff;cursor:pointer;transition:opacity .2s}
.next-btn:disabled{opacity:.3;cursor:default}
.next-btn:not(:disabled):hover{opacity:.85}
.next-btn.full-btn{width:100%}

.step{display:none}
.step.active{display:block}

.result-hero{text-align:center;padding:1.5rem 0;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
.result-badge{display:inline-block;font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.15em;color:var(--rose);background:rgba(232,113,154,.12);border:1px solid rgba(232,113,154,.3);border-radius:20px;padding:.25rem .9rem;margin-bottom:.75rem}
.bundle-text{font-size:1rem;color:var(--text);line-height:1.9;padding:1.2rem 0}

.result-section{margin-top:1.5rem}
.result-section-title{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.15em;color:var(--gold);text-transform:uppercase;margin-bottom:.8rem}
.result-list{display:flex;flex-direction:column;gap:.6rem}
.result-item{background:var(--card2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1.1rem;font-size:.85rem;color:rgba(232,226,245,.85);line-height:1.8}

.article-link-box{display:flex;align-items:center;gap:.9rem;background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:.6rem;text-decoration:none;transition:border-color .2s,background .2s}
.article-link-box:hover{border-color:var(--violet-lt);background:rgba(155,114,239,.12)}
.article-link-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.article-link-body strong{font-family:var(--ff-sans);font-size:.9rem;font-weight:500;color:var(--violet-lt)}
.article-link-arrow{color:var(--violet-lt);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}

.retry-btn{width:100%;font-family:var(--ff-mono);font-size:.72rem;letter-spacing:.1em;background:none;border:1px solid var(--border2);border-radius:8px;padding:.65rem;color:var(--muted);cursor:pointer;margin-top:1.2rem;transition:color .2s,border-color .2s}
.retry-btn:hover{color:var(--text);border-color:var(--rose)}

.error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:10px;padding:1rem;font-size:.85rem;color:var(--rose);margin-top:1rem}

.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}

footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

@media(max-width:600px){
  .shindan-card{padding:1.25rem}
  .mbti-grid{grid-template-columns:repeat(4,1fr)}
  .blood-grid{grid-template-columns:repeat(2,1fr)}
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

<?php $currentPage='love'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">MBTI × Blood × Zodiac</span>
    <h1>恋愛傾向診断</h1>
    <p class="hero-sub">MBTI・血液型・星座の3つから、あなたの恋愛スタイルと傾向をひも解きます。</p>
  </section>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="tool-desc">
    <p>MBTI・血液型・星座という3つの異なる性格分析を組み合わせ、恋愛における行動パターンや傾向を診断します。</p>
    <p>この診断ではMBTIタイプ・血液型・生年月日の3つを入力していただきます。MBTIタイプが分からない方は、先にMBTI診断でタイプを調べてからお越しください。</p>
  </div>

  <div class="shindan-card">

    <!-- ステップ1：MBTI選択 -->
    <div class="step active" id="step-mbti">
      <div class="progress-wrap">
        <div class="progress-label"><span>STEP 1 / 3</span><span>MBTIタイプ</span></div>
        <div class="progress-bar"><div class="progress-fill" style="width:33%"></div></div>
      </div>
      <div class="select-title">あなたのMBTIタイプを選んでください</div>
      <div class="select-hint">MBTIタイプが分からない方は約3分で無料診断できます。 <a href="/mbti" target="_blank" rel="noopener">MBTIを診断する →</a></div>
      <div class="mbti-grid" id="mbti-grid"></div>
      <div class="nav-row" style="justify-content:flex-end">
        <button class="next-btn" id="mbti-next" onclick="goStep('step-blood')" disabled>次へ →</button>
      </div>
    </div>

    <!-- ステップ2：血液型選択 -->
    <div class="step" id="step-blood">
      <div class="progress-wrap">
        <div class="progress-label"><span>STEP 2 / 3</span><span>血液型</span></div>
        <div class="progress-bar"><div class="progress-fill" style="width:66%"></div></div>
      </div>
      <div class="select-title">あなたの血液型を選んでください</div>
      <div class="blood-grid" id="blood-grid"></div>
      <div class="nav-row">
        <button class="back-btn" onclick="goStep('step-mbti')">← 戻る</button>
        <button class="next-btn" id="blood-next" onclick="goStep('step-birthday')" disabled>次へ →</button>
      </div>
    </div>

    <!-- ステップ3：生年月日 -->
    <div class="step" id="step-birthday">
      <div class="progress-wrap">
        <div class="progress-label"><span>STEP 3 / 3</span><span>生年月日</span></div>
        <div class="progress-bar"><div class="progress-fill" style="width:100%"></div></div>
      </div>
      <div class="select-title">生年月日を選んでください</div>
      <?php
      require_once __DIR__.'/inc/birthday-input.php';
      render_birthdate_input(['prefix' => 'birth', 'hiddenName' => 'birthday', 'defaultYear' => null]);
      ?>
      <div id="submit-error"></div>
      <div class="nav-row">
        <button class="back-btn" onclick="goStep('step-blood')">← 戻る</button>
        <button class="next-btn" id="submit-btn" onclick="submitDiagnosis()" disabled data-ga-event="fortune_submit">診断結果を見る →</button>
      </div>
    </div>

    <!-- ステップ4：結果 -->
    <div class="step" id="step-result">
      <div class="result-hero">
        <div class="result-badge" id="r-badge"></div>
        <div class="bundle-text" id="r-bundle"></div>
      </div>

      <div class="result-section">
        <div class="result-section-title">恋愛スタイル</div>
        <div class="result-list" id="r-styles"></div>
      </div>

      <div class="result-section">
        <div class="result-section-title">推定される傾向</div>
        <div class="result-list" id="r-tendencies"></div>
      </div>

      <div class="result-section" id="r-articles-section">
        <div class="result-section-title">もっと詳しく知る</div>
        <div id="r-articles"></div>
      </div>

      <?php require __DIR__.'/inc/share-btns.php'; ?>
      <button class="retry-btn" onclick="restart()">もう一度診断する</button>
    </div>

  </div><!-- /.shindan-card -->

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

</div><!-- /.wrap -->

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
const mbtiTypes = <?= json_encode(array_keys(MBTI_DATA)) ?>;
const bloodTypes = <?= json_encode(array_keys(BLOOD_DATA)) ?>;

let selectedMbti = null;
let selectedBlood = null;
let _started = false;

function markStart() {
  if (_started) return;
  _started = true;
  if (typeof trackEvent === 'function') trackEvent('fortune_start', {});
}

function goStep(id) {
  document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  document.getElementById('submit-error').innerHTML = '';
}

function renderMbtiGrid() {
  const g = document.getElementById('mbti-grid');
  g.innerHTML = '';
  mbtiTypes.forEach(type => {
    const b = document.createElement('button');
    b.className = 'mbti-btn';
    b.textContent = type;
    b.onclick = () => {
      markStart();
      selectedMbti = type;
      document.querySelectorAll('#mbti-grid .mbti-btn').forEach(x => x.classList.remove('selected'));
      b.classList.add('selected');
      document.getElementById('mbti-next').disabled = false;
    };
    g.appendChild(b);
  });
}

function renderBloodGrid() {
  const g = document.getElementById('blood-grid');
  g.innerHTML = '';
  bloodTypes.forEach(type => {
    const b = document.createElement('button');
    b.className = 'blood-btn';
    b.textContent = type + '型';
    b.onclick = () => {
      selectedBlood = type;
      document.querySelectorAll('#blood-grid .blood-btn').forEach(x => x.classList.remove('selected'));
      b.classList.add('selected');
      document.getElementById('blood-next').disabled = false;
    };
    g.appendChild(b);
  });
}

document.addEventListener('DOMContentLoaded', function(){
  renderMbtiGrid();
  renderBloodGrid();
  // birth-hiddenはBirthdayInput側がJSで直接値を書き込むため、hidden自体のchangeは
  // 発火しない。年・月・日の各selectに個別にリスナーを付ける（sansei.phpと同様、
  // BirthdayInput.getValue('birth')で判定する）。
  ['birth-year', 'birth-month', 'birth-day'].forEach(function(id){
    document.getElementById(id).addEventListener('change', function(){
      document.getElementById('submit-btn').disabled = !window.BirthdayInput.getValue('birth');
    });
  });
});

async function submitDiagnosis() {
  const birthday = document.getElementById('birth-hidden').value;
  const btn = document.getElementById('submit-btn');
  const errorBox = document.getElementById('submit-error');
  errorBox.innerHTML = '';
  btn.disabled = true;
  btn.textContent = '診断中…';

  try {
    const res = await fetch(location.pathname, {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({ mbti: selectedMbti, blood: selectedBlood, birthday: birthday })
    });
    if (!res.ok) throw new Error('request failed');
    const data = await res.json();
    if (data.error) throw new Error(data.error);
    renderResult(data);
    goStep('step-result');
    if (typeof scrollToResult === 'function') scrollToResult('step-result');
  } catch (e) {
    errorBox.innerHTML = '<div class="error-box">診断に失敗しました。もう一度お試しください。</div>';
    btn.disabled = false;
    btn.textContent = '診断結果を見る →';
  }
}

function renderResult(data) {
  const badge = data.badge;
  document.getElementById('r-badge').textContent = badge.mbti + ' × ' + badge.blood + ' × ' + badge.seiza;
  document.getElementById('r-bundle').textContent = data.document.bundleText;

  const styleList = document.getElementById('r-styles');
  styleList.innerHTML = '';
  data.document.styleTexts.forEach(t => {
    const d = document.createElement('div');
    d.className = 'result-item';
    d.textContent = t;
    styleList.appendChild(d);
  });

  const tendencyList = document.getElementById('r-tendencies');
  tendencyList.innerHTML = '';
  data.document.tendencyTexts.forEach(t => {
    const d = document.createElement('div');
    d.className = 'result-item';
    d.textContent = t;
    tendencyList.appendChild(d);
  });

  const articlesSection = document.getElementById('r-articles-section');
  const articles = document.getElementById('r-articles');
  articles.innerHTML = '';
  if (data.document.articleLinks.length === 0) {
    articlesSection.style.display = 'none';
  } else {
    articlesSection.style.display = '';
    data.document.articleLinks.forEach(link => {
      const a = document.createElement('a');
      a.className = 'article-link-box';
      a.href = link.url;
      a.target = '_blank';
      a.rel = 'noopener';
      a.innerHTML = '<div class="article-link-body"><strong>' + link.label + '</strong></div><span class="article-link-arrow">→</span>';
      articles.appendChild(a);
    });
  }

  window._shareText = `恋愛診断結果：${badge.mbti} × ${badge.blood} × ${badge.seiza} でした！✨`;
}

function restart() {
  selectedMbti = null;
  selectedBlood = null;
  document.querySelectorAll('.mbti-btn.selected, .blood-btn.selected').forEach(x => x.classList.remove('selected'));
  document.getElementById('mbti-next').disabled = true;
  document.getElementById('blood-next').disabled = true;
  document.getElementById('submit-btn').disabled = true;
  document.getElementById('submit-btn').textContent = '診断結果を見る →';
  goStep('step-mbti');
}
</script>
<script>
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
