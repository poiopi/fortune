<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/site.php';
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
<link rel="canonical" href="https://life-fun.net/adventure-quiz" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="12の冒険シナリオを直感で選ぶだけ。探求心・共感性・理論力・行動力・安定感の5つの視点から、あなたの傾向をレーダーチャートで見られる無料の心理テストです。ゲームとして楽しむための目安です。">
<title>冒険の分かれ道 心理テスト｜12の場面で見る性格の傾向（無料）<?= TITLE_SUFFIX ?></title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<!-- AdSense -->
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
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">

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
body{
  background:var(--void);
  color:var(--text);
  font-family:var(--ff-sans);
  font-weight:300;
  line-height:1.8;
  min-height:100vh;
}
body::before{
  content:'';position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),
    radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);
  pointer-events:none;z-index:0;
}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

/* ── HEADER：inc/header.php側で一元管理（COMPONENTS.md参照） ── */

/* ── HERO ── */
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.8rem);font-weight:700;line-height:1.3;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

/* ══════════════════════════════════════════
   冒険の分かれ道 心理テスト本体（.adv 配下に閉じる）
   配色は占いチャット「みつぼっと」（inc/ai-fortune-modal.php の --aic-*）と同じ値。
   サイト共通部品（ヘッダー・フッター・シェア・result-footer）のCSSと衝突しないよう、
   クラス名はすべて adv- 接頭辞、セレクタは .adv 配下に限定している。
══════════════════════════════════════════ */
.adv{
  --adv-ink:#05070d; --adv-plate:#02040a; --adv-panel-2:#161c29; --adv-panel-3:#1d2432;
  --adv-brass:#c0913c; --adv-brass-lt:#e8ce93; --adv-brass-pale:#f2e3bd; --adv-brass-dk:#7e5c1e;
  --adv-rule:rgba(232,206,147,.14); --adv-rule-2:rgba(232,206,147,.30); --adv-rule-3:rgba(232,206,147,.52);
  --adv-star:#f0ead9; --adv-text:#c7cedd; --adv-muted:#7a8399; --adv-dim:#525c72;
  --adv-serif:'Shippori Mincho',Georgia,serif;
  --adv-sans:'Zen Kaku Gothic New',sans-serif;
  --adv-mono:'DM Mono',monospace;
  position:relative;width:100%;max-width:640px;margin:0 auto 2rem;
  background:radial-gradient(140% 46% at 50% 0%,rgba(58,80,140,.24),transparent 68%),linear-gradient(180deg,#070a13,var(--adv-plate) 55%);
  border:1px solid var(--adv-rule-2);border-radius:16px;
  box-shadow:0 0 30px rgba(0,0,0,.6);
  overflow:clip; /* 角丸で子要素を切る（overflow:hidden だとスティッキーの進捗バーが効かなくなるため clip） */
  color:var(--adv-text);font-family:var(--adv-sans);font-weight:400;line-height:1.6;
  scroll-margin-top:72px;
  -webkit-font-smoothing:antialiased;
}

/* 進捗バー（サイト共通ヘッダー：高さ56px＋下線2px の直下に貼り付く） */
.adv .adv-progress{
  width:100%;background:var(--adv-plate);border-bottom:1px solid var(--adv-rule);
  padding:8px 16px;display:flex;align-items:center;gap:12px;
  position:sticky;top:58px;z-index:20;
}
.adv .adv-pbar{flex:1;height:4px;background:rgba(232,206,147,.1);border-radius:2px;overflow:hidden}
.adv .adv-pfill{height:100%;width:0%;background:linear-gradient(90deg,var(--adv-brass-dk),var(--adv-brass-lt));transition:width .3s ease}
.adv .adv-pcount{font-family:var(--adv-mono);font-size:12px;color:var(--adv-brass-lt);letter-spacing:.05em;min-width:48px;text-align:right}

.adv .adv-main{padding:20px 16px 32px;display:flex;flex-direction:column;gap:20px}

/* 画面切り替え */
.adv .adv-screen{display:none;flex-direction:column;gap:20px;width:100%;animation:advFadeIn .3s ease-out}
.adv .adv-screen.active{display:flex}
@keyframes advFadeIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}

/* スタート画面 */
.adv .adv-start{
  padding:20px 8px 12px;text-align:center;display:flex;flex-direction:column;align-items:center;gap:16px;
}
.adv .adv-start-icon{width:48px;height:48px;color:var(--adv-brass-lt)}
.adv .adv-start-desc{font-size:14px;color:var(--adv-text);line-height:1.7}

/* ボタン */
.adv .adv-btn{
  appearance:none;border:1px solid var(--adv-brass);background:linear-gradient(180deg,#241c10,#120e08);
  color:var(--adv-brass-pale);font-family:var(--adv-serif);font-size:15px;padding:12px 28px;border-radius:4px;
  cursor:pointer;transition:all .2s ease;display:inline-flex;align-items:center;justify-content:center;gap:8px;
  text-decoration:none;width:100%;max-width:280px;
}
.adv .adv-btn:hover{border-color:var(--adv-brass-lt);background:linear-gradient(180deg,#322615,#1c150b);color:#fff}
.adv .adv-btn:focus-visible{outline:2px solid var(--adv-brass-lt);outline-offset:2px}

/* チャット吹き出し */
.adv .adv-bot{display:flex;gap:12px;align-items:flex-start;max-width:90%;align-self:flex-start;scroll-margin-top:124px}
.adv .adv-avatar{
  width:32px;height:32px;border-radius:50%;background:var(--adv-panel-3);border:1px solid var(--adv-rule-2);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--adv-brass-lt);
}
.adv .adv-botbody{
  background:var(--adv-panel-2);border:1px solid var(--adv-rule-2);border-radius:2px 12px 12px 12px;
  padding:14px 16px;color:var(--adv-star);font-size:14px;line-height:1.6;box-shadow:0 2px 8px rgba(0,0,0,.3);
}
.adv .adv-cat{font-family:var(--adv-mono);font-size:11px;color:var(--adv-brass-lt);margin-bottom:6px;display:block;letter-spacing:.05em}
.adv .adv-qtext{font-family:var(--adv-serif);font-size:15px;color:var(--adv-brass-pale);font-weight:500}
.adv .adv-user{
  align-self:flex-end;max-width:80%;
  background:linear-gradient(135deg,rgba(192,145,60,.15),rgba(126,92,30,.25));border:1px solid var(--adv-brass-dk);
  border-radius:12px 2px 12px 12px;padding:10px 14px;color:var(--adv-brass-pale);font-size:13px;line-height:1.5;margin:4px 0;
}

/* 選択肢 */
.adv .adv-options{display:flex;flex-direction:column;gap:10px;width:100%;margin-top:8px}
.adv .adv-option{
  appearance:none;background:var(--adv-panel-2);border:1px solid var(--adv-rule-2);border-radius:6px;
  padding:12px 14px;text-align:left;color:var(--adv-text);font-family:var(--adv-sans);font-size:13px;line-height:1.6;
  cursor:pointer;transition:all .2s ease;display:flex;align-items:center;gap:12px;width:100%;
}
.adv .adv-option:hover{border-color:var(--adv-brass);background:var(--adv-panel-3);color:var(--adv-star)}
.adv .adv-option:focus-visible{outline:2px solid var(--adv-brass-lt);outline-offset:1px}
.adv .adv-olabel{
  font-family:var(--adv-mono);font-size:12px;color:var(--adv-brass);background:rgba(192,145,60,.1);
  border:1px solid var(--adv-rule-2);width:24px;height:24px;border-radius:4px;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.adv .adv-otext{flex:1}

/* 戻る */
.adv .adv-quiznav{display:flex;justify-content:space-between;align-items:center;margin-top:12px;padding-top:12px;border-top:1px solid var(--adv-rule)}
.adv .adv-back{
  appearance:none;background:transparent;border:none;color:var(--adv-muted);font-family:var(--adv-sans);font-size:12px;cursor:pointer;
  display:flex;align-items:center;gap:4px;padding:4px 8px;border-radius:4px;
}
.adv .adv-back:hover{color:var(--adv-brass-lt)}
.adv .adv-back:focus-visible{outline:1px solid var(--adv-brass-lt)}
.adv .adv-back:disabled{opacity:.3;cursor:not-allowed}
.adv .adv-hint{font-size:11px;color:var(--adv-muted)}

/* 結果 */
.adv .adv-result{display:flex;flex-direction:column;gap:24px;width:100%}
.adv .adv-rhead{
  background:var(--adv-panel-2);border:1px solid var(--adv-rule-2);border-radius:8px;padding:24px 18px;
  text-align:center;display:flex;flex-direction:column;align-items:center;gap:12px;
}
.adv .adv-rlabel{font-family:var(--adv-mono);font-size:11px;color:var(--adv-brass);letter-spacing:.1em}
.adv .adv-rtitle{font-family:var(--adv-serif);font-size:22px;color:var(--adv-brass-pale);font-weight:700;line-height:1.5}
.adv .adv-rsub{font-size:13px;color:var(--adv-brass-lt);font-style:italic;line-height:1.5}
.adv .adv-rdesc{font-size:13px;color:var(--adv-text);line-height:1.7;text-align:left;margin-top:4px}

.adv .adv-radar{width:100%;max-width:280px;margin:0 auto;aspect-ratio:1/1;position:relative}
.adv .adv-radar-svg{width:100%;height:100%;overflow:visible}

.adv .adv-metrics{
  display:flex;flex-direction:column;gap:12px;width:100%;background:var(--adv-panel-2);
  border:1px solid var(--adv-rule-2);border-radius:8px;padding:16px;
}
.adv .adv-mitem{display:flex;flex-direction:column;gap:4px}
.adv .adv-mhead{display:flex;justify-content:space-between;font-size:12px}
.adv .adv-mname{color:var(--adv-brass-pale)}
.adv .adv-mval{font-family:var(--adv-mono);color:var(--adv-brass-lt)}
.adv .adv-mbar{height:6px;background:var(--adv-plate);border-radius:3px;border:1px solid var(--adv-rule);overflow:hidden}
.adv .adv-mfill{height:100%;background:linear-gradient(90deg,var(--adv-brass-dk),var(--adv-brass-lt));border-radius:3px;width:0%;transition:width .6s ease}

.adv .adv-tend{
  display:flex;gap:12px;width:100%;background:var(--adv-panel-3);border:1px solid var(--adv-rule);
  border-radius:6px;padding:12px 14px;font-size:12px;
}
.adv .adv-tend-item{flex:1;display:flex;flex-direction:column;gap:2px}
.adv .adv-tend-label{color:var(--adv-muted);font-size:11px}
.adv .adv-tend-val{color:var(--adv-brass-pale);font-weight:500}
.adv .adv-tend-sep{width:1px;background:var(--adv-rule)}

.adv .adv-detail{
  background:var(--adv-panel-2);border:1px solid var(--adv-rule-2);border-radius:8px;padding:18px;
  display:flex;flex-direction:column;gap:12px;
}
.adv .adv-dtitle{
  font-family:var(--adv-serif);font-size:15px;font-weight:600;color:var(--adv-brass-lt);display:flex;align-items:center;gap:8px;
  border-bottom:1px solid var(--adv-rule);padding-bottom:8px;
}
.adv .adv-dtitle svg{width:16px;height:16px;color:var(--adv-brass);stroke-width:1.3;flex-shrink:0}
.adv .adv-dlist{list-style:none;display:flex;flex-direction:column;gap:8px}
.adv .adv-dlist li{font-size:13px;color:var(--adv-text);position:relative;padding-left:16px;line-height:1.6}
.adv .adv-dlist li::before{content:"・";position:absolute;left:0;color:var(--adv-brass)}
.adv .adv-dtext{font-size:13px;color:var(--adv-text);line-height:1.6}
.adv .adv-disclaimer{font-size:11px;color:var(--adv-muted);text-align:center;line-height:1.6;margin-top:4px;padding:0 12px}

.adv .adv-actions{display:flex;flex-direction:column;gap:10px;align-items:center;margin-top:4px}

/* アイコン共通 */
.adv .adv-ico{display:inline-block;vertical-align:middle;fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round}

/* コピー結果の表示（ボタン直下。画面下の固定表示は自動広告のアンカー広告に隠れるため使わない） */
.adv .adv-copy-status{min-height:1.6em;margin-top:2px;font-size:12px;line-height:1.6;color:var(--adv-brass-pale);text-align:center;opacity:0;transition:opacity .2s ease}
.adv .adv-copy-status.show{opacity:1}
.adv .adv-btn.is-copied{border-color:var(--adv-brass-lt);color:#fff}

/* 結果の後ろ（シェア・おすすめ・もう一度）。テスト本体と同じ幅に揃える */
.adv-after{max-width:640px;margin:0 auto 2rem}

@media (prefers-reduced-motion:reduce){
  .adv *,.adv ::before,.adv ::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important;scroll-behavior:auto!important}
}

/* ── この心理テストについて ── */
.adv-about{max-width:640px;margin:0 auto 2rem;background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem}
.adv-about h2{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--gold-lt);margin-bottom:.8rem;letter-spacing:.04em}
.adv-about p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.adv-about p:last-child{margin-bottom:0}

@media(max-width:600px){
  .hero{padding:2.2rem .5rem 1.5rem}
  .adv-about{padding:1.1rem 1.1rem}
}
</style>
</head>
<body>

<?php $currentPage='adventure-quiz'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">Adventure Scenario</span>
    <h1>冒険の分かれ道<br>心理テスト</h1>
    <p class="hero-sub">12の場面での選び方から、あなたの傾向を見る心理テストです。</p>
  </section>

  <div class="adv" id="advApp">

    <!-- 進捗バー（質問中のみ表示） -->
    <div id="progress-wrap" class="adv-progress" style="display:none">
      <div class="adv-pbar"><div id="progress-fill" class="adv-pfill"></div></div>
      <div id="progress-counter" class="adv-pcount" aria-live="polite">1 / 12</div>
    </div>

    <div class="adv-main">

      <!-- スタート画面 -->
      <section id="screen-start" class="adv-screen active">
        <div class="adv-start">
          <svg class="adv-ico adv-start-icon" viewBox="0 0 24 24" stroke-width="1.2" aria-hidden="true" focusable="false">
            <circle cx="12" cy="12" r="9"/>
            <path d="M15.5 8.5l-2 5-5 2 2-5z"/>
          </svg>
          <p class="adv-start-desc">12の場面での直感的な選択から、あなたの行動の選び方や思考の傾向を可視化します。深呼吸をして、直感でお選びください。</p>
          <button type="button" class="adv-btn" onclick="startQuiz()">
            選択をはじめる
            <svg class="adv-ico" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" focusable="false"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>
      </section>

      <!-- 質問画面 -->
      <section id="screen-quiz" class="adv-screen">
        <div id="chat-history" style="display:flex;flex-direction:column;gap:16px"></div>
        <div id="active-question-area" style="display:flex;flex-direction:column;gap:12px;margin-top:8px"></div>
        <div class="adv-quiznav">
          <button type="button" id="btn-back" class="adv-back" onclick="prevQuestion()" disabled>
            <svg class="adv-ico" width="14" height="14" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" focusable="false"><polyline points="15 18 9 12 15 6"/></svg>
            前の場面へ戻る
          </button>
          <span class="adv-hint">直感で選択してください</span>
        </div>
      </section>

      <!-- 結果画面 -->
      <section id="screen-result" class="adv-screen">
        <div class="adv-result">

          <div class="adv-rhead">
            <span class="adv-rlabel">今回の選び方から見えた傾向</span>
            <h2 id="res-type-title" class="adv-rtitle">-</h2>
            <div id="res-type-sub" class="adv-rsub">-</div>
            <p id="res-type-desc" class="adv-rdesc">-</p>
          </div>

          <div class="adv-metrics">
            <div class="adv-radar">
              <svg id="radar-svg" class="adv-radar-svg" viewBox="0 0 200 200" role="img" aria-label="5つの視点のバランスを示すレーダーチャート"></svg>
            </div>
            <div id="metric-bars-container" style="display:flex;flex-direction:column;gap:10px;margin-top:8px"></div>
            <div class="adv-tend">
              <div class="adv-tend-item">
                <span class="adv-tend-label">主傾向</span>
                <span id="res-primary-axis" class="adv-tend-val">-</span>
              </div>
              <div class="adv-tend-sep"></div>
              <div class="adv-tend-item">
                <span class="adv-tend-label">副傾向</span>
                <span id="res-secondary-axis" class="adv-tend-val">-</span>
              </div>
            </div>
          </div>

          <div class="adv-detail">
            <h3 class="adv-dtitle">
              <svg class="adv-ico" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              特徴と強みの傾向
            </h3>
            <ul id="res-strengths" class="adv-dlist"></ul>
          </div>

          <div class="adv-detail">
            <h3 class="adv-dtitle">
              <svg class="adv-ico" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
              意識しておきたい注意点
            </h3>
            <ul id="res-weaknesses" class="adv-dlist"></ul>
          </div>

          <div class="adv-detail">
            <h3 class="adv-dtitle">
              <svg class="adv-ico" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
              向いている環境の傾向
            </h3>
            <p id="res-jobs" class="adv-dtext"></p>
          </div>

          <div class="adv-detail">
            <h3 class="adv-dtitle">
              <svg class="adv-ico" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              相性の傾向
            </h3>
            <p id="res-match" class="adv-dtext"></p>
          </div>

          <div class="adv-detail">
            <h3 class="adv-dtitle">
              <svg class="adv-ico" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              コミュニケーションのコツ
            </h3>
            <p id="res-comm" class="adv-dtext"></p>
          </div>

          <p class="adv-disclaimer">
            ゲームとして楽しむための目安です。性格や能力を決めつけるものではなく、日によって変わります。
          </p>

          <div class="adv-actions">
            <button type="button" class="adv-btn" onclick="copyResultText()">
              <svg class="adv-ico" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" focusable="false"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              <span id="advCopyLabel">結果をコピー</span>
            </button>
            <p id="advCopyStatus" class="adv-copy-status" role="status" aria-live="polite"></p>
          </div>

        </div>
      </section>

    </div><!-- /.adv-main -->
  </div><!-- /.adv -->

  <!-- 結果表示後だけ出す：シェア → おすすめ3件 → もう一度ためす（占いツール共通の並び。COMPONENTS.md「結果系コンポーネントの設計」） -->
  <div id="advAfter" class="adv-after" hidden>
    <?php require __DIR__.'/inc/share-btns.php'; ?>
    <?php
    $contextKey = 'adventure-quiz';
    $retryLabel = 'もう一度ためす';
    $retryType  = 'js';
    $retryValue = 'restartQuiz()';
    require __DIR__.'/inc/result-footer.php';
    ?>
  </div>

  <div class="adv-about">
    <h2>この心理テストについて</h2>
    <p>冒険の場面を12回選んでいくと、「探求心」「共感性」「理論力」「行動力」「安定感」の5つの視点それぞれの得点が積み上がり、レーダーチャートと割合で今回の選び方の傾向を見ることができます。</p>
    <p>各視点の割合は、その視点の満点に対してどれだけ選んだかを示しています。いちばん高い視点が「主傾向」、次に高い視点が「副傾向」として表示されます。</p>
    <p>本サービスはエンターテインメントを目的としています。結果は性格や能力を決めつけるものではなく、医学・心理学などの専門的な診断や助言を行うものでもありません。選択内容はサーバーに送信・保存されません。</p>
  </div>

</div><!-- /.wrap -->

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// --- SITE CONSTANTS ---
const SITE_NAME = <?= json_encode(SITE_NAME, JSON_UNESCAPED_UNICODE) ?>;

// --- DATASET DEFINITION ---
const QUIZ_DATA = {
    axes: {
        INT: { name: '探求心', maxScore: 0 },
        EMP: { name: '共感性', maxScore: 0 },
        LOG: { name: '理論力', maxScore: 0 },
        ACT: { name: '行動力', maxScore: 0 },
        STA: { name: '安定感', maxScore: 0 }
    },
    questions: [
        {
            id: 1,
            category: "場面 1: 冒険の始まり",
            title: "未知の森の入口で、道が2つに分かれています。どちらを選びますか？",
            options: [
                { text: "古びた地図に載っている安全そうな整備された道", scores: { STA: 3, LOG: 1 } },
                { text: "怪しい光が奥に見える、誰も通ったことがなさそうな道", scores: { INT: 2, ACT: 2 } },
                { text: "仲間や通行人に話を聞いて情報を集めてから決める", scores: { EMP: 2, LOG: 2 } },
                { text: "直感でピンと来た方を迷わず突き進む", scores: { ACT: 3, INT: 1 } }
            ]
        },
        {
            id: 2,
            category: "場面 2: 古代遺跡の謎",
            title: "遺跡の奥で読めない文字が刻まれた開かない扉を発見しました。どう行動しますか？",
            options: [
                { text: "周囲の壁画や文字の法則性をじっくり解読しようとする", scores: { LOG: 3, INT: 2 } },
                { text: "触ったり動かしたりして仕掛けの反応を確かめる", scores: { ACT: 3, INT: 1 } },
                { text: "周りの人が困っていないか、安全を第一に考える", scores: { EMP: 2, STA: 2 } },
                { text: "扉の背後に眠る未知の歴史や物語に想いを馳せる", scores: { INT: 2, EMP: 2 } }
            ]
        },
        {
            id: 3,
            category: "場面 3: 村の危機",
            title: "立ち寄った村で二つのグループが激しい意見対立をしています。あなたは？",
            options: [
                { text: "両者の言い分をしっかり聞き、感情に寄り添い和解を目指す", scores: { EMP: 3, STA: 1 } },
                { text: "事実関係と論点を整理し、客観的な解決案を提示する", scores: { LOG: 3, STA: 2 } },
                { text: "自分がリーダーシップをとって新しい第三の案を実行する", scores: { ACT: 3, LOG: 1 } },
                { text: "なぜ対立が起きたのか構造的な背景や根本原因を調べる", scores: { INT: 2, LOG: 2 } }
            ]
        },
        {
            id: 4,
            category: "場面 4: 魔法の道具",
            title: "1つだけ宝物を選べるとしたら、どれを選びますか？",
            options: [
                { text: "世界のあらゆる知識が書かれた無限の書物", scores: { INT: 3, LOG: 2 } },
                { text: "どんな人の感情も理解できるようになる指輪", scores: { EMP: 2, STA: 2 } },
                { text: "行きたい場所に一瞬で移動できる魔法のブーツ", scores: { ACT: 3, INT: 2 } },
                { text: "どんな危険からも身を守ることができる絶対の盾", scores: { STA: 3, LOG: 1 } }
            ]
        },
        {
            id: 5,
            category: "場面 5: 予想外のトラブル",
            title: "旅の途中で大切なアイテムを失くしてしまいました。最初の反応は？",
            options: [
                { text: "冷静に今日の行動ルートを逆算して探す計画を立てる", scores: { LOG: 2, STA: 2 } },
                { text: "すぐに元いた場所へ全力で走って探しに戻る", scores: { ACT: 3, INT: 1 } },
                { text: "「きっと何かの意味がある」と切り替えて前進する", scores: { STA: 3, INT: 1 } },
                { text: "落ち込んでいる自分や周りを励まし合い助けを求める", scores: { EMP: 3, ACT: 1 } }
            ]
        },
        {
            id: 6,
            category: "場面 6: 休息の夜",
            title: "焚き火の囲みで、あなたは主にどんな役割になりますか？",
            options: [
                { text: "面白い話や新しく得た知見を披露してみんなを賑やかせる", scores: { INT: 2, ACT: 2 } },
                { text: "静かにみんなの話に耳を傾け、温かく頷く", scores: { EMP: 3, STA: 1 } },
                { text: "明日の行程や備品チェックを念入りに行う", scores: { LOG: 3, STA: 2 } },
                { text: "夜空を見上げながら、今後の大きな目標について語る", scores: { INT: 3, ACT: 2 } }
            ]
        },
        {
            id: 7,
            category: "場面 7: 試練の壁",
            title: "目の前にそびえ立つ断崖絶壁。どうやって超えますか？",
            options: [
                { text: "風向きや岩肌の強度を計算し、最もリスクの低いルートを登る", scores: { LOG: 3, STA: 1 } },
                { text: "道具を使って工夫し、誰も思いつかないユニークな方法を試す", scores: { INT: 3, ACT: 2 } },
                { text: "チーム全員が脱落しないよう声を掛け合い足並みを揃えて登る", scores: { EMP: 2, STA: 2 } },
                { text: "考えるより先に手足を動かし、一番乗りを目指して登る", scores: { ACT: 3, LOG: 2 } }
            ]
        },
        {
            id: 8,
            category: "場面 8: 幻の都市",
            title: "誰も見たことがない美しい空中都市に到着しました。一番最初にしたいことは？",
            options: [
                { text: "都市の歴史や動力の仕組みを調べに向かう", scores: { INT: 3, LOG: 2 } },
                { text: "住人たちと挨拶を交わし、彼らの暮らしを知る", scores: { EMP: 3, ACT: 1 } },
                { text: "街全体を一望できる一番高い場所へ登ってみる", scores: { ACT: 3, INT: 1 } },
                { text: "宿や食事の場所を確保し、旅の疲れを癒やす", scores: { STA: 3, LOG: 1 } }
            ]
        },
        {
            id: 9,
            category: "場面 9: 究極の選択",
            title: "世界を救うための最終試練。あなたの行動方針は？",
            options: [
                { text: "勝率が一番高い綿密な作戦を組み立てて実行する", scores: { LOG: 3, ACT: 1 } },
                { text: "全員の絆と想いを信じ、力を合わせて立ち向かう", scores: { EMP: 3, ACT: 1 } },
                { text: "誰も思いつかなかった奇策・裏ルートを探し出す", scores: { INT: 3, LOG: 2 } },
                { text: "ブレない意志でどっしり構え、前線の盾となる", scores: { STA: 3, EMP: 3 } }
            ]
        },
        {
            id: 10,
            category: "場面 10: 約束の場所",
            title: "友人から「絶対に秘密にしてほしい」と大事な悩みを打ち明けられました。",
            options: [
                { text: "誰にも言わず、ただ親身に相手の心に寄り添い続ける", scores: { EMP: 2, STA: 2 } },
                { text: "解決のための具体的なステップを提示して手助けする", scores: { LOG: 3, ACT: 2 } },
                { text: "相手の視野が広がるような新しい視点やアイデアを与える", scores: { INT: 3, LOG: 1 } },
                { text: "「大丈夫、なんとかなる」とドンと受け止めて安らぎを与える", scores: { STA: 2, EMP: 2 } }
            ]
        },
        {
            id: 11,
            category: "場面 11: 新世界の創造",
            title: "もし自分が新しい理想の街を作るとしたら、何を最重視しますか？",
            options: [
                { text: "誰もが安心して穏やかに暮らせる秩序と安全性", scores: { STA: 2, LOG: 1 } },
                { text: "先進的な技術や刺激的なアートがあふれる未来感", scores: { INT: 3, ACT: 2 } },
                { text: "住民同士の温かい助け合いと豊かなコミュニティ", scores: { EMP: 3, STA: 1 } },
                { text: "無駄がなく効率的で、挑戦が生まれやすい環境", scores: { LOG: 3, ACT: 2 } }
            ]
        },
        {
            id: 12,
            category: "場面 12: 旅の終わり",
            title: "長い旅を終えて手に入れた一番の成果は何だと感じますか？",
            options: [
                { text: "世界に対する新しい発見と深まった見識", scores: { INT: 3, LOG: 1 } },
                { text: "一生モノの仲間たちとの深い絆と共感", scores: { EMP: 3, STA: 1 } },
                { text: "どんな困難も乗り越えられるようになった自分の行動力", scores: { ACT: 3, INT: 1 } },
                { text: "何事にも動じない揺るぎないブレない心", scores: { STA: 3, LOG: 1 } }
            ]
        }
    ],
    types: {
        INT: {
            title: "探求を好む傾向",
            sub: "知性と直感で可能性を拓くスタイル",
            desc: "強い好奇心と探求心を持ち、物事の裏にある背景や新しいアイデアを求める傾向があります。知的な刺激を好み、柔軟な発想で道を切り拓くかもしれません。",
            strengths: ["抽象的な概念や複雑な仕組みを理解する着眼点", "枠にとらわれない独自のアイデア発想力", "関心のあるテーマを掘り下げる学習意欲"],
            weaknesses: ["単調なルーティン作業に興味を失いやすい傾向", "アイデアの構想に夢中で実行が後回しになること", "現実的な細部や制約を見落としがちな点"],
            jobs: "新しい企画の試行錯誤や調査・検証、アイデアを形にする環境で力が発揮されやすいでしょう。",
            match: "【安定感の傾向が高い方】着実な視点が、あなたの独創的なアイデアをカタチにする助けになります。",
            comm: "自分のビジョンを共有する際は、相手がイメージしやすいよう具体的例を添えるとスムーズです。"
        },
        EMP: {
            title: "共感を重視する傾向",
            sub: "心に寄り添い関係性を結ぶスタイル",
            desc: "周囲の感情や雰囲気を感じ取り、互いの気持ちを尊重することを大切にする傾向があります。温かいコミュニケーションで場を和ませるかもしれません。",
            strengths: ["相手の気持ちや意図に寄り添う高い受容力", "チームの空気感を和らげる傾聴力", "場の調和と関係性を育む優しさ"],
            weaknesses: ["他人の感情に影響されて疲弊しやすい傾向", "自分の意見や希望を後回しにしがちな点", "対立を避けて判断を迷ってしまうこと"],
            jobs: "人と直接向き合う役割や、チーム間の協働を支える温かい環境で力を発揮しやすいでしょう。",
            match: "【理論力の傾向が高い方】客観的で冷静な視点が、迷ったときの頼れる道しるべになります。",
            comm: "相手に配慮しつつも、時には自分の考えや希望を素直に伝えていくことが良好な関係につながります。"
        },
        LOG: {
            title: "理論的な整理を好む傾向",
            sub: "客観的分析と構造化で導くスタイル",
            desc: "感情に流されず、事実や筋道をもとに物事を判断しようとする傾向があります。課題を構造化し、効率的な解を見出すのが得意かもしれません。",
            strengths: ["複雑な問題を整理・分解する分析的な着眼点", "事実やデータに基づいた客観的な視点", "再現性の高い効率的な仕組みを作る工夫"],
            weaknesses: ["感情的な背景や数値化できない要素に戸惑うこと", "意見をストレートに伝えすぎて堅い印象を与える点", "完璧を期すあまり判断に慎重になりすぎる傾向"],
            jobs: "目的や基準が明確で、客観的な論理性が評価される環境で真価を発揮しやすいでしょう。",
            match: "【共感性の傾向が高い方】配慮深い視点が、円滑なコミュニケーションを促すヒントをくれます。",
            comm: "客観的な指摘を行う前に、相手の立場や感情に一言配慮を添えると受け入れられやすくなります。"
        },
        ACT: {
            title: "行動力を重視する傾向",
            sub: "素早い判断と試行で切り拓くスタイル",
            desc: "考えるよりもまず行動を起こし、実践の中から学びを得ようとする傾向があります。変化に対して柔軟で、素早いアプローチが得意かもしれません。",
            strengths: ["状況の変化に対する素早い対応力と試行速度", "前例のない場面でも動じずに進む積極性", "周囲に勢いを与えて前進を促すエネルギー"],
            weaknesses: ["事前準備や確認が不十分なまま動き出しがちな点", "細かな維持管理や確認作業に窮屈さを感じる傾向", "自分のペースを周囲にも求めてしまいがちなこと"],
            jobs: "変化が速く、自発的なアプローチが成果につながる動きのある環境で真価を発揮しやすいでしょう。",
            match: "【安定感の傾向が高い方】堅実で慎重なサポートが、あなたの行動の足元をしっかり固めてくれます。",
            comm: "進行のペースを少し緩め、周囲の状況や足並みを確認する時間を持つことで一体感が高まります。"
        },
        STA: {
            title: "安定感を求める傾向",
            sub: "誠実さと着実さで支えるスタイル",
            desc: "穏やかで着実、物事を丁寧に進めようとする傾向があります。リスクを事前に察知し、確実な土台を築くことで周りに安心感を与えるかもしれません。",
            strengths: ["計画通りに着実・丁寧に最後までやり遂げる力", "細かな懸念点や不備も見逃さない確かな目", "周囲にブレない安心感をもたらす安定度"],
            weaknesses: ["急な変更や不確定要素が多い状況への抵抗感", "新しいやり方に対して慎重になりすぎる傾向", "周囲のために抱え込みすぎて負担を感じる点"],
            jobs: "順序や体制が明確で、じっくりとクオリティを高められる環境で高い力を発揮しやすいでしょう。",
            match: "【行動力の傾向が高い方】積極的なアクションが、新しい視点や挑戦の機会をもたらしてくれます。",
            comm: "慎重さを保ちつつも、時には変化を柔軟に受け入れてみる姿勢が新しい広がりを生みます。"
        }
    }
};

// --- TRACKING HOOK ---
// すべてのイベント送信はサイト共通の trackEvent()（inc/footer.php）経由。fortune_type はページの $currentPage（adventure-quiz）が使われる。
function track(name, params) {
    if (typeof window.trackEvent === 'function') {
        window.trackEvent(name, params);
    }
}

// --- CALCULATE DYNAMIC MAXIMUM SCORES ---
function calculateMaxScores() {
    Object.keys(QUIZ_DATA.axes).forEach(axis => {
        let maxPossible = 0;
        QUIZ_DATA.questions.forEach(q => {
            let qMax = 0;
            q.options.forEach(opt => {
                const score = opt.scores[axis] || 0;
                if (score > qMax) qMax = score;
            });
            maxPossible += qMax;
        });
        QUIZ_DATA.axes[axis].maxScore = maxPossible;
    });
}

// --- STATE MANAGEMENT ---
let currentQuestionIdx = 0;
let userAnswers = []; // Array of selected option index per question
let answersHistory = []; // Tracks user selection detail for tie-breaking

// --- INITIALIZATION ---
window.addEventListener('DOMContentLoaded', () => {
    calculateMaxScores();
});

// --- SCREEN NAVIGATION ---
function showScreen(screenId) {
    document.querySelectorAll('.adv-screen').forEach(s => s.classList.remove('active'));
    const target = document.getElementById(`screen-${screenId}`);
    if (target) target.classList.add('active');

    document.getElementById('progress-wrap').style.display = (screenId === 'quiz') ? 'flex' : 'none';
    // 結果のときだけ、シェア・おすすめ・もう一度ためすを出す
    document.getElementById('advAfter').hidden = (screenId !== 'result');
    // サイト共通ヘッダー（sticky）の下に診断パネルの先頭を合わせる
    document.getElementById('advApp').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

let copyStatusTimer = null;
function showCopyStatus(ok) {
    const status = document.getElementById('advCopyStatus');
    const label = document.getElementById('advCopyLabel');
    const btn = label ? label.closest('.adv-btn') : null;
    if (!status) return;
    status.textContent = ok ? 'クリップボードにコピーしました' : 'コピーできませんでした。お手数ですが、結果を選択してコピーしてください';
    status.classList.add('show');
    if (ok && label && btn) {
        label.textContent = 'コピーしました';
        btn.classList.add('is-copied');
    }
    clearTimeout(copyStatusTimer);
    copyStatusTimer = setTimeout(() => {
        status.classList.remove('show');
        if (label && btn) {
            label.textContent = '結果をコピー';
            btn.classList.remove('is-copied');
        }
    }, 3500);
}

// --- QUIZ FLOW ENGINE ---
function startQuiz() {
    track('fortune_start', { fortune_type: 'adventure-quiz' });
    currentQuestionIdx = 0;
    userAnswers = new Array(QUIZ_DATA.questions.length).fill(null);
    answersHistory = [];

    showScreen('quiz');
    renderQuizStep();
}

function renderQuizStep() {
    const totalQ = QUIZ_DATA.questions.length;
    const q = QUIZ_DATA.questions[currentQuestionIdx];

    // Update Progress
    const fillPercent = Math.round(((currentQuestionIdx + 1) / totalQ) * 100);
    document.getElementById('progress-fill').style.width = `${fillPercent}%`;
    document.getElementById('progress-counter').textContent = `${currentQuestionIdx + 1} / ${totalQ}`;

    // Render Chat History (Previous Questions Answered)
    const chatHistoryContainer = document.getElementById('chat-history');
    chatHistoryContainer.innerHTML = '';

    for (let i = 0; i < currentQuestionIdx; i++) {
        const prevQ = QUIZ_DATA.questions[i];
        const selectedOptIdx = userAnswers[i];
        const selectedOpt = prevQ.options[selectedOptIdx];

        // Bot Question Bubble
        const botBubble = document.createElement('div');
        botBubble.className = 'adv-bot';
        botBubble.innerHTML = `
            <div class="adv-avatar"><svg class="adv-ico" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/></svg></div>
            <div class="adv-botbody">
                <span class="adv-cat">${prevQ.category}</span>
                <div class="adv-qtext">${prevQ.title}</div>
            </div>
        `;
        chatHistoryContainer.appendChild(botBubble);

        // User Answer Bubble
        const userBubble = document.createElement('div');
        userBubble.className = 'adv-user';
        userBubble.textContent = selectedOpt ? selectedOpt.text : '';
        chatHistoryContainer.appendChild(userBubble);
    }

    // Current Question Bot Bubble
    const currentBotBubble = document.createElement('div');
    currentBotBubble.className = 'adv-bot';
    currentBotBubble.innerHTML = `
        <div class="adv-avatar"><svg class="adv-ico" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
        <div class="adv-botbody">
            <span class="adv-cat">${q.category}</span>
            <div class="adv-qtext">${q.title}</div>
        </div>
    `;
    chatHistoryContainer.appendChild(currentBotBubble);

    // Render Active Option Buttons
    const activeArea = document.getElementById('active-question-area');
    activeArea.innerHTML = '';

    const optionsList = document.createElement('div');
    optionsList.className = 'adv-options';

    const labels = ['A', 'B', 'C', 'D'];
    q.options.forEach((opt, idx) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'adv-option';
        btn.onclick = () => handleSelectOption(idx);

        const isSelected = userAnswers[currentQuestionIdx] === idx;
        if (isSelected) {
            btn.style.borderColor = 'var(--adv-brass)';
            btn.style.background = 'var(--adv-panel-3)';
        }

        btn.innerHTML = `
            <span class="adv-olabel">${labels[idx]}</span>
            <span class="adv-otext">${opt.text}</span>
        `;
        optionsList.appendChild(btn);
    });
    activeArea.appendChild(optionsList);

    // Update Back Button
    const backBtn = document.getElementById('btn-back');
    backBtn.disabled = currentQuestionIdx === 0;

    // Scroll to current active area
    setTimeout(() => {
        currentBotBubble.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 50);
}

function handleSelectOption(optionIdx) {
    userAnswers[currentQuestionIdx] = optionIdx;

    if (currentQuestionIdx < QUIZ_DATA.questions.length - 1) {
        currentQuestionIdx++;
        renderQuizStep();
    } else {
        // 最後の場面を選んだ時点を「診断実行」とする（診断ファネル：fortune_start → fortune_submit → fortune_result_view）
        track('fortune_submit', { fortune_type: 'adventure-quiz' });
        finishQuiz();
    }
}

function prevQuestion() {
    if (currentQuestionIdx > 0) {
        currentQuestionIdx--;
        renderQuizStep();
    }
}

// --- CALCULATIONS & DETERMINISTIC TIE-BREAKING ---
function finishQuiz() {
    // Calculate raw scores and 3-point selections count
    const scores = { INT: 0, EMP: 0, LOG: 0, ACT: 0, STA: 0 };
    const topScoreCounts = { INT: 0, EMP: 0, LOG: 0, ACT: 0, STA: 0 };
    const lastChosenIdx = { INT: -1, EMP: -1, LOG: -1, ACT: -1, STA: -1 };

    userAnswers.forEach((optIdx, qIdx) => {
        const opt = QUIZ_DATA.questions[qIdx].options[optIdx];
        for (const [axis, val] of Object.entries(opt.scores)) {
            scores[axis] += val;
            if (val === 3) {
                topScoreCounts[axis] += 1;
            }
            lastChosenIdx[axis] = qIdx;
        }
    });

    // Sort Axes by Score -> Top Score Counts -> Last Chosen Index
    const axisKeys = Object.keys(QUIZ_DATA.axes);
    axisKeys.sort((a, b) => {
        if (scores[b] !== scores[a]) {
            return scores[b] - scores[a];
        }
        if (topScoreCounts[b] !== topScoreCounts[a]) {
            return topScoreCounts[b] - topScoreCounts[a];
        }
        return lastChosenIdx[b] - lastChosenIdx[a];
    });

    const primaryAxis = axisKeys[0];
    const secondaryAxis = axisKeys[1];

    // Normalize Scores to 0-100%
    const normalized = {};
    for (const axis of axisKeys) {
        const max = QUIZ_DATA.axes[axis].maxScore;
        normalized[axis] = Math.min(100, Math.round((scores[axis] / max) * 100));
    }

    renderResults(primaryAxis, secondaryAxis, normalized, scores);
    showScreen('result');
    track('fortune_result_view', { fortune_type: 'adventure-quiz' });

    // Save state safely
    try {
        localStorage.setItem('mitsuboshi_quiz_result', JSON.stringify({
            primaryAxis, secondaryAxis, normalized, date: new Date().toISOString()
        }));
    } catch (e) {
        // Storage fallback
    }
}

// --- RESULT RENDERER ---
function renderResults(primaryKey, secondaryKey, normalizedScores, rawScores) {
    const primaryType = QUIZ_DATA.types[primaryKey];
    const secondaryAxisObj = QUIZ_DATA.axes[secondaryKey];

    // Title & Descriptions
    document.getElementById('res-type-title').textContent = primaryType.title;
    document.getElementById('res-type-sub').textContent = primaryType.sub;
    document.getElementById('res-type-desc').textContent = primaryType.desc;

    document.getElementById('res-primary-axis').textContent = QUIZ_DATA.axes[primaryKey].name;
    document.getElementById('res-secondary-axis').textContent = secondaryAxisObj.name;

    // Render Radar Chart SVG
    renderRadarSVG(normalizedScores);

    // Render Bar Metrics
    const barsContainer = document.getElementById('metric-bars-container');
    barsContainer.innerHTML = '';

    Object.keys(QUIZ_DATA.axes).forEach(axisKey => {
        const axis = QUIZ_DATA.axes[axisKey];
        const pct = normalizedScores[axisKey];

        const item = document.createElement('div');
        item.className = 'adv-mitem';
        item.innerHTML = `
            <div class="adv-mhead">
                <span class="adv-mname">${axis.name}</span>
                <span class="adv-mval">${pct}%</span>
            </div>
            <div class="adv-mbar">
                <div class="adv-mfill" style="width: ${pct}%"></div>
            </div>
        `;
        barsContainer.appendChild(item);
    });

    // Detailed Sections
    renderList('res-strengths', primaryType.strengths);
    renderList('res-weaknesses', primaryType.weaknesses);
    document.getElementById('res-jobs').textContent = primaryType.jobs;
    document.getElementById('res-match').textContent = primaryType.match;
    document.getElementById('res-comm').textContent = primaryType.comm;
}

function renderList(elemId, items) {
    const container = document.getElementById(elemId);
    container.innerHTML = items.map(it => `<li>${it}</li>`).join('');
}

// --- RADAR CHART (INLINE SVG) ---
function renderRadarSVG(normalized) {
    const svg = document.getElementById('radar-svg');
    const center = 100;
    const radius = 70;
    const axes = ['INT', 'EMP', 'LOG', 'ACT', 'STA'];
    const total = axes.length;

    // Generate Pentagram Grid (4 Rings)
    let svgContent = '';
    for (let ring = 1; ring <= 4; ring++) {
        const r = (radius / 4) * ring;
        const points = [];
        for (let i = 0; i < total; i++) {
            const angle = (Math.PI * 2 / total) * i - (Math.PI / 2);
            const x = center + r * Math.cos(angle);
            const y = center + r * Math.sin(angle);
            points.push(`${x.toFixed(1)},${y.toFixed(1)}`);
        }
        svgContent += `<polygon points="${points.join(' ')}" fill="none" stroke="rgba(232, 206, 147, 0.15)" stroke-width="1"/>`;
    }

    // Axis Lines and Labels
    const dataPoints = [];
    axes.forEach((axisKey, i) => {
        const angle = (Math.PI * 2 / total) * i - (Math.PI / 2);
        const x2 = center + radius * Math.cos(angle);
        const y2 = center + radius * Math.sin(angle);

        // Axis Line
        svgContent += `<line x1="${center}" y1="${center}" x2="${x2.toFixed(1)}" y2="${y2.toFixed(1)}" stroke="rgba(232, 206, 147, 0.2)" stroke-width="1"/>`;

        // Value Point calculation
        const valRatio = (normalized[axisKey] || 0) / 100;
        const vx = center + radius * valRatio * Math.cos(angle);
        const vy = center + radius * valRatio * Math.sin(angle);
        dataPoints.push(`${vx.toFixed(1)},${vy.toFixed(1)}`);

        // Label Placement
        const lx = center + (radius + 18) * Math.cos(angle);
        const ly = center + (radius + 18) * Math.sin(angle);
        const labelName = QUIZ_DATA.axes[axisKey].name;

        svgContent += `<text x="${lx.toFixed(1)}" y="${ly.toFixed(1)}" fill="#e8ce93" font-size="9" font-family="Zen Kaku Gothic New" text-anchor="middle" dominant-baseline="central">${labelName}</text>`;
    });

    // User Score Polygon
    svgContent += `<polygon points="${dataPoints.join(' ')}" fill="rgba(192, 145, 60, 0.3)" stroke="#e8ce93" stroke-width="1.8"/>`;

    // Data Points Circles
    dataPoints.forEach(pt => {
        const [px, py] = pt.split(',');
        svgContent += `<circle cx="${px}" cy="${py}" r="3" fill="#f2e3bd" stroke="#05070d" stroke-width="1"/>`;
    });

    svg.innerHTML = svgContent;
}

// --- COPY FUNCTION ---
async function copyResultText() {
    const title = document.getElementById('res-type-title').textContent;
    const primary = document.getElementById('res-primary-axis').textContent;
    const secondary = document.getElementById('res-secondary-axis').textContent;

    const textToCopy = `【${SITE_NAME}】冒険の分かれ道 心理テスト\n` +
                       `今回の選び方から見えた傾向：${title}\n` +
                       `（主傾向：${primary} / 副傾向：${secondary}）`;

    let success = false;
    if (navigator.clipboard && navigator.clipboard.writeText) {
        try {
            await navigator.clipboard.writeText(textToCopy);
            success = true;
        } catch (e) {
            success = false;
        }
    }

    if (!success) {
        // Fallback using textarea
        const area = document.createElement('textarea');
        area.value = textToCopy;
        area.style.position = 'fixed';
        area.style.opacity = '0';
        document.body.appendChild(area);
        area.select();
        try {
            document.execCommand('copy');
            success = true;
        } catch (e) {
            success = false;
        }
        document.body.removeChild(area);
    }

    showCopyStatus(success);
}

function restartQuiz() {
    startQuiz();
}
</script>
</body>
</html>
