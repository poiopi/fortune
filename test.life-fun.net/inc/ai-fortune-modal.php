<?php
declare(strict_types=1);

/**
 * inc/ai-fortune-modal.php
 *
 * AI鑑定チャットMVP（4テーマ：開運のヒント/自己理解/結婚/相性）のモーダルUI本体。
 * footer.php（全ページ共通部品）から読み込まれる。入口ボタン（fmenu内）は
 * footer.php側にあり、このファイルはモーダル本体（HTML/CSS/JS）のみを持つ。
 *
 * UI構造（overlay/close/ESC/スクロールロック/ステップhidden切り替え）は
 * index.php内の相談テーマ型占いモーダル（旧3テーマ企画、theme-modal-*、
 * api/fortune-theme.php）の実装パターンを参考にしている。ただしCSSクラス名は
 * "aichat-" 接頭辞で完全に独立させ、index.php（旧モーダルを持つページ）上で
 * 両モーダルが共存しても干渉しないようにしている。旧モーダル自体は一切変更していない。
 *
 * API呼び出し先は api/fortune-chat.php（新規）。4テーマの名称・並び順・
 * 入口コピーは仕様で確定済みのため変更しない。
 *
 * XSS対策：APIレスポンスのテキスト系フィールドは必ずtextContentでDOMへ挿入する
 * （innerHTMLは使わない）。
 */
require_once __DIR__ . '/mbti-data.php';
require_once __DIR__ . '/blood-data.php';
?>
<style>
.aichat-overlay{position:fixed;inset:0;background:rgba(0,0,0,.55);backdrop-filter:blur(3px);z-index:2099;opacity:0;pointer-events:none;transition:opacity .3s}
.aichat-overlay.open{opacity:1;pointer-events:all}
.aichat-modal{
  position:fixed;z-index:2100;top:50%;left:50%;transform:translate(-50%,calc(-50% + 16px));
  width:min(560px,92vw);max-height:86vh;overflow-y:auto;
  background:linear-gradient(180deg,#0f0b1e 0%,#1a1035 100%);
  border:1px solid rgba(155,114,239,.35);border-radius:18px;
  box-shadow:0 24px 60px rgba(0,0,0,.5);padding:1.9rem 1.6rem 1.7rem;
  opacity:0;pointer-events:none;transition:opacity .3s,transform .3s
}
.aichat-modal.open{opacity:1;pointer-events:all;transform:translate(-50%,-50%)}
@media(max-width:600px){
  .aichat-modal{top:auto;bottom:0;left:0;right:0;transform:translateY(16px);width:100%;max-width:none;max-height:88vh;border-radius:18px 18px 0 0;border-left:none;border-right:none;border-bottom:none}
  .aichat-modal.open{transform:translateY(0)}
}
.aichat-close{position:absolute;top:1rem;right:1rem;background:none;border:1px solid rgba(155,114,239,.3);border-radius:50%;width:30px;height:30px;color:#8a7db5;cursor:pointer;font-size:.85rem;display:flex;align-items:center;justify-content:center;transition:color .2s,border-color .2s}
.aichat-close:hover{color:#c4a8f5;border-color:#9b72ef}
.aichat-step[hidden]{display:none}
.aichat-heading{font-family:'Shippori Mincho',serif;font-size:1.05rem;font-weight:700;color:#e8e0f8;text-align:center;margin:.2rem 0 1.4rem;padding-right:1.6rem}
.aichat-theme-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.7rem}
@media(max-width:480px){.aichat-theme-grid{grid-template-columns:1fr}}
.aichat-theme-card{background:rgba(155,114,239,.08);border:1px solid rgba(155,114,239,.25);border-radius:12px;padding:1.1rem .9rem;display:flex;flex-direction:column;align-items:center;gap:.35rem;text-align:center;cursor:pointer;font-family:inherit;color:#c8c0e0;transition:border-color .2s,background .2s,transform .2s;width:100%}
.aichat-theme-card:hover{border-color:#9b72ef;background:rgba(155,114,239,.15);transform:translateY(-2px)}
.aichat-theme-name{font-family:'Shippori Mincho',serif;font-size:.92rem;font-weight:700;color:#e8e0f8}
.aichat-theme-desc{font-size:.7rem;color:#8a7db5;line-height:1.6}
.aichat-subhead{font-family:'DM Mono',monospace;font-size:.65rem;letter-spacing:.1em;color:#c9a84c;margin:.9rem 0 .5rem}
.aichat-date-group{display:flex;gap:.6rem;margin-bottom:.6rem}
.aichat-date-group select{flex:1;padding:.75rem .5rem;min-height:46px;text-align:center;background:#1e1738;border:1px solid rgba(155,114,239,.3);border-radius:8px;color:#e8e0f8;font-family:inherit;font-size:.82rem;appearance:none;color-scheme:dark;background-image:linear-gradient(45deg,transparent 50%,#8a7db5 50%),linear-gradient(135deg,#8a7db5 50%,transparent 50%);background-position:calc(100% - 14px) center,calc(100% - 9px) center;background-size:5px 5px,5px 5px;background-repeat:no-repeat}
.aichat-date-group select:focus{outline:none;border-color:#9b72ef}
.aichat-mbti-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.4rem;margin-bottom:.4rem}
.aichat-mbti-btn{background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.25);border-radius:8px;padding:.5rem .2rem;text-align:center;font-family:'DM Mono',monospace;font-size:.72rem;color:#8a7db5;cursor:pointer;transition:background .2s,border-color .2s,color .2s}
.aichat-mbti-btn:hover{background:rgba(155,114,239,.12);color:#e8e0f8}
.aichat-mbti-btn.selected{background:rgba(155,114,239,.22);border-color:#9b72ef;color:#c4a8f5}
.aichat-blood-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem;margin-bottom:.4rem}
.aichat-blood-btn{background:rgba(232,113,154,.06);border:1px solid rgba(155,114,239,.25);border-radius:8px;padding:.75rem .3rem;text-align:center;font-family:'Shippori Mincho',serif;font-size:.95rem;font-weight:700;color:#8a7db5;cursor:pointer;transition:background .2s,border-color .2s,color .2s}
.aichat-blood-btn:hover{background:rgba(232,113,154,.12);color:#e8e0f8}
.aichat-blood-btn.selected{background:rgba(232,113,154,.18);border-color:#e8719a;color:#e8719a}
.aichat-nav-row{display:flex;justify-content:space-between;align-items:center;margin-top:1.3rem}
.aichat-nav-row-end{justify-content:center}
.aichat-back-btn{font-family:'DM Mono',monospace;font-size:.7rem;color:#8a7db5;background:none;border:1px solid rgba(155,114,239,.3);border-radius:6px;padding:.45rem 1rem;cursor:pointer;letter-spacing:.05em;transition:color .2s,border-color .2s}
.aichat-back-btn:hover{color:#e8e0f8;border-color:#9b72ef}
.aichat-submit-btn{font-family:'DM Mono',monospace;font-size:.75rem;letter-spacing:.08em;background:linear-gradient(135deg,#9b72ef,#7a4fd6);border:none;border-radius:8px;padding:.6rem 1.5rem;color:#fff;cursor:pointer;transition:opacity .2s}
.aichat-submit-btn:disabled{opacity:.35;cursor:not-allowed}
.aichat-submit-btn:not(:disabled):hover{opacity:.85}
.aichat-error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:10px;padding:.9rem;font-size:.8rem;color:#e8719a;margin-top:.9rem}
.aichat-loading{text-align:center;padding:2.6rem 0;color:#8a7db5;font-size:.9rem}
.aichat-result-badge{font-family:'DM Mono',monospace;font-size:.7rem;letter-spacing:.12em;color:#c9a84c;text-align:center;margin-bottom:.7rem}
.aichat-result-text{font-size:.86rem;color:#c8c0e0;line-height:1.9;white-space:pre-line}
.aichat-result-block{margin-bottom:1.1rem}
.aichat-result-block-title{font-family:'Shippori Mincho',serif;font-size:.85rem;font-weight:700;color:#e8e0f8;margin-bottom:.5rem}
.aichat-result-list{display:flex;flex-direction:column;gap:.45rem;padding-left:1.1rem}
.aichat-result-list li{font-size:.82rem;color:#c8c0e0;line-height:1.7}
.aichat-stars-row{text-align:center;margin-bottom:.5rem}
.aichat-star{font-size:1.3rem;color:rgba(155,114,239,.25)}
.aichat-star.on{color:#c9a84c}
.aichat-score-label{text-align:center;font-family:'DM Mono',monospace;font-size:.78rem;color:#c9a84c;margin-bottom:.8rem}
</style>

<div class="aichat-overlay" id="aichatOverlay"></div>
<div class="aichat-modal" id="aichatModal" role="dialog" aria-modal="true" aria-labelledby="aichatHeading">
  <button type="button" class="aichat-close" id="aichatClose" aria-label="閉じる">✕</button>

  <!-- STEP: テーマ選択 -->
  <div class="aichat-step" id="aichatStepTheme">
    <h3 class="aichat-heading" id="aichatHeading">何について知りたいですか？</h3>
    <div class="aichat-theme-grid">
      <button type="button" class="aichat-theme-card" data-theme="kaiun">
        <span class="aichat-theme-name">開運のヒント</span>
        <span class="aichat-theme-desc">今日から意識したい開運のポイントを知る</span>
      </button>
      <button type="button" class="aichat-theme-card" data-theme="self">
        <span class="aichat-theme-name">自己理解</span>
        <span class="aichat-theme-desc">自分の性格・人との関わり方の傾向を知る</span>
      </button>
      <button type="button" class="aichat-theme-card" data-theme="marriage">
        <span class="aichat-theme-name">結婚</span>
        <span class="aichat-theme-desc">結婚について知りたいことを選ぶ</span>
      </button>
      <button type="button" class="aichat-theme-card" data-theme="compatibility">
        <span class="aichat-theme-name">相性</span>
        <span class="aichat-theme-desc">気になるあの人との相性を知る</span>
      </button>
    </div>
  </div>

  <!-- STEP: 結婚の2択 -->
  <div class="aichat-step" id="aichatStepMarriageChoice" hidden>
    <h3 class="aichat-heading">結婚について知りたいことを選んでください</h3>
    <div class="aichat-theme-grid">
      <button type="button" class="aichat-theme-card" data-theme="marriage_self">
        <span class="aichat-theme-name">自分の結婚志向</span>
      </button>
      <button type="button" class="aichat-theme-card" data-theme="marriage_person">
        <span class="aichat-theme-name">この人との結婚相性</span>
      </button>
    </div>
    <div class="aichat-nav-row aichat-nav-row-end">
      <button type="button" class="aichat-back-btn" data-back>← 戻る</button>
    </div>
  </div>

  <!-- STEP: 入力 -->
  <div class="aichat-step" id="aichatStepInput" hidden>
    <h3 class="aichat-heading" id="aichatInputHeading"></h3>

    <!-- 入力パターンA：生年月日のみ（開運のヒント・自己理解） -->
    <div class="aichat-input-variant" id="aichatInputSingle" hidden>
      <div class="aichat-date-group">
        <select id="aichatSingleYear" aria-label="年"></select>
        <select id="aichatSingleMonth" aria-label="月"></select>
        <select id="aichatSingleDay" aria-label="日"></select>
      </div>
    </div>

    <!-- 入力パターンB：生年月日＋MBTI＋血液型（自分の結婚志向） -->
    <div class="aichat-input-variant" id="aichatInputMarriageSelf" hidden>
      <div class="aichat-date-group">
        <select id="aichatMsYear" aria-label="年"></select>
        <select id="aichatMsMonth" aria-label="月"></select>
        <select id="aichatMsDay" aria-label="日"></select>
      </div>
      <div class="aichat-subhead">あなたのMBTIタイプ</div>
      <div class="aichat-mbti-grid" id="aichatMbtiGrid"></div>
      <div class="aichat-subhead">あなたの血液型</div>
      <div class="aichat-blood-grid" id="aichatBloodGrid"></div>
    </div>

    <!-- 入力パターンC：自分＋相手の生年月日（この人との結婚相性・相性） -->
    <div class="aichat-input-variant" id="aichatInputDual" hidden>
      <div class="aichat-subhead">あなたの生年月日</div>
      <div class="aichat-date-group">
        <select id="aichatYourYear" aria-label="年"></select>
        <select id="aichatYourMonth" aria-label="月"></select>
        <select id="aichatYourDay" aria-label="日"></select>
      </div>
      <div class="aichat-subhead">お相手の生年月日</div>
      <div class="aichat-date-group">
        <select id="aichatPartnerYear" aria-label="年"></select>
        <select id="aichatPartnerMonth" aria-label="月"></select>
        <select id="aichatPartnerDay" aria-label="日"></select>
      </div>
    </div>

    <div id="aichatInputError"></div>
    <div class="aichat-nav-row">
      <button type="button" class="aichat-back-btn" data-back>← 戻る</button>
      <button type="button" class="aichat-submit-btn" id="aichatSubmitBtn" data-ga-event="fortune_submit" disabled>占ってみる</button>
    </div>
  </div>

  <!-- STEP: ローディング -->
  <div class="aichat-step" id="aichatStepLoading" hidden>
    <div class="aichat-loading">鑑定しています……</div>
  </div>

  <!-- STEP: 結果 -->
  <div class="aichat-step" id="aichatStepResult" hidden>
    <h3 class="aichat-heading" id="aichatResultHeading"></h3>

    <!-- 結果パターンA：開運のヒント -->
    <div class="aichat-result-variant" id="aichatResultKaiun" hidden>
      <div class="aichat-result-badge" id="aichatKaiunStar"></div>
      <p class="aichat-result-text" id="aichatKaiunText"></p>
    </div>

    <!-- 結果パターンB：自己理解 -->
    <div class="aichat-result-variant" id="aichatResultSelf" hidden>
      <div class="aichat-result-block">
        <div class="aichat-result-block-title">◎ あなたの強み</div>
        <ul class="aichat-result-list" id="aichatSelfStrengths"></ul>
      </div>
      <div class="aichat-result-block">
        <div class="aichat-result-block-title">△ 気をつけたい傾向</div>
        <ul class="aichat-result-list" id="aichatSelfWeaknesses"></ul>
      </div>
      <div class="aichat-result-block">
        <div class="aichat-result-block-title">👥 人との関わり方</div>
        <p class="aichat-result-text" id="aichatSelfRelations"></p>
      </div>
    </div>

    <!-- 結果パターンC：結婚志向 -->
    <div class="aichat-result-variant" id="aichatResultMarriageSelf" hidden>
      <p class="aichat-result-text" id="aichatMarriageSelfText"></p>
    </div>

    <!-- 結果パターンD：結婚相性・相性（スコア型） -->
    <div class="aichat-result-variant" id="aichatResultScore" hidden>
      <div class="aichat-stars-row" id="aichatScoreStars"></div>
      <div class="aichat-score-label" id="aichatScoreLabel"></div>
      <p class="aichat-result-text" id="aichatScoreReason"></p>
    </div>

    <div class="aichat-nav-row aichat-nav-row-end">
      <button type="button" class="aichat-back-btn" id="aichatRetryBtn">もう一度占う</button>
    </div>
  </div>
</div>

<script>
(function(){
  var overlay = document.getElementById('aichatOverlay');
  var modal = document.getElementById('aichatModal');
  if (!overlay || !modal) return;

  var closeBtn = document.getElementById('aichatClose');
  var inputHeading = document.getElementById('aichatInputHeading');
  var inputError = document.getElementById('aichatInputError');
  var submitBtn = document.getElementById('aichatSubmitBtn');
  var resultHeading = document.getElementById('aichatResultHeading');
  var retryBtn = document.getElementById('aichatRetryBtn');

  var MBTI_TYPES = <?= json_encode(array_keys(MBTI_DATA), JSON_UNESCAPED_UNICODE) ?>;
  var BLOOD_TYPES = <?= json_encode(array_keys(BLOOD_DATA), JSON_UNESCAPED_UNICODE) ?>;

  var INPUT_HEADINGS = {
    kaiun: '開運のヒントを占います',
    self: '自己理解を占います',
    marriage_self: '自分の結婚志向を占います',
    marriage_person: 'この人との結婚相性を占います',
    compatibility: '相性を占います'
  };
  var RESULT_HEADINGS = {
    kaiun: '開運のヒント',
    self: '自己理解',
    marriage_self: '結婚志向',
    marriage_person: 'この人との結婚相性',
    compatibility: '相性'
  };

  var currentTheme = null;
  var stepStack = [];
  var startTracked = false;
  var selectedMbti = null;
  var selectedBlood = null;

  // ── 日付セレクト共通ヘルパー ──
  function pad(n){ return String(n).padStart(2, '0'); }
  function daysInMonth(year, month){
    if(!year || !month) return 31;
    return new Date(year, month, 0).getDate();
  }
  function buildYearOptions(sel){
    var endYear = new Date().getFullYear();
    var startYear = 1920;
    sel.innerHTML = '<option value="">年</option>';
    for(var y = endYear; y >= startYear; y--){
      var o = document.createElement('option');
      o.value = y; o.textContent = y + '年';
      sel.appendChild(o);
    }
  }
  function buildMonthOptions(sel){
    sel.innerHTML = '<option value="">月</option>';
    for(var m = 1; m <= 12; m++){
      var o = document.createElement('option');
      o.value = m; o.textContent = m + '月';
      sel.appendChild(o);
    }
  }
  function refreshDayOptions(yearSel, monthSel, daySel, keepValue){
    var year = parseInt(yearSel.value, 10) || null;
    var month = parseInt(monthSel.value, 10) || null;
    var maxDay = daysInMonth(year, month);
    var current = keepValue ? parseInt(daySel.value, 10) : null;
    daySel.innerHTML = '<option value="">日</option>';
    for(var d = 1; d <= maxDay; d++){
      var o = document.createElement('option');
      o.value = d; o.textContent = d + '日';
      daySel.appendChild(o);
    }
    if(current && current <= maxDay) daySel.value = current;
  }
  function initDateGroup(yearSel, monthSel, daySel){
    buildYearOptions(yearSel);
    buildMonthOptions(monthSel);
    refreshDayOptions(yearSel, monthSel, daySel, false);
    [yearSel, monthSel, daySel].forEach(function(sel){
      sel.addEventListener('change', function(){
        markStart();
        refreshDayOptions(yearSel, monthSel, daySel, true);
        updateSubmitState();
      });
    });
  }
  function resetDateGroup(yearSel, monthSel, daySel){
    yearSel.value = '';
    monthSel.value = '';
    refreshDayOptions(yearSel, monthSel, daySel, false);
  }
  function getDateValue(yearSel, monthSel, daySel){
    if(!yearSel.value || !monthSel.value || !daySel.value) return null;
    return yearSel.value + '-' + pad(monthSel.value) + '-' + pad(daySel.value);
  }

  var singleYear = document.getElementById('aichatSingleYear');
  var singleMonth = document.getElementById('aichatSingleMonth');
  var singleDay = document.getElementById('aichatSingleDay');
  var msYear = document.getElementById('aichatMsYear');
  var msMonth = document.getElementById('aichatMsMonth');
  var msDay = document.getElementById('aichatMsDay');
  var yourYear = document.getElementById('aichatYourYear');
  var yourMonth = document.getElementById('aichatYourMonth');
  var yourDay = document.getElementById('aichatYourDay');
  var partnerYear = document.getElementById('aichatPartnerYear');
  var partnerMonth = document.getElementById('aichatPartnerMonth');
  var partnerDay = document.getElementById('aichatPartnerDay');

  initDateGroup(singleYear, singleMonth, singleDay);
  initDateGroup(msYear, msMonth, msDay);
  initDateGroup(yourYear, yourMonth, yourDay);
  initDateGroup(partnerYear, partnerMonth, partnerDay);

  // ── MBTI／血液型グリッド ──
  function renderMbtiGrid(){
    var g = document.getElementById('aichatMbtiGrid');
    g.innerHTML = '';
    MBTI_TYPES.forEach(function(type){
      var b = document.createElement('button');
      b.type = 'button'; b.className = 'aichat-mbti-btn'; b.textContent = type;
      b.addEventListener('click', function(){
        markStart();
        selectedMbti = type;
        g.querySelectorAll('.aichat-mbti-btn').forEach(function(x){ x.classList.remove('selected'); });
        b.classList.add('selected');
        updateSubmitState();
      });
      g.appendChild(b);
    });
  }
  function renderBloodGrid(){
    var g = document.getElementById('aichatBloodGrid');
    g.innerHTML = '';
    BLOOD_TYPES.forEach(function(type){
      var b = document.createElement('button');
      b.type = 'button'; b.className = 'aichat-blood-btn'; b.textContent = type + '型';
      b.addEventListener('click', function(){
        markStart();
        selectedBlood = type;
        g.querySelectorAll('.aichat-blood-btn').forEach(function(x){ x.classList.remove('selected'); });
        b.classList.add('selected');
        updateSubmitState();
      });
      g.appendChild(b);
    });
  }
  renderMbtiGrid();
  renderBloodGrid();

  function updateSubmitState(){
    var ok = false;
    switch(currentTheme){
      case 'kaiun':
      case 'self':
        ok = !!getDateValue(singleYear, singleMonth, singleDay);
        break;
      case 'marriage_self':
        ok = !!getDateValue(msYear, msMonth, msDay) && !!selectedMbti && !!selectedBlood;
        break;
      case 'marriage_person':
      case 'compatibility':
        ok = !!getDateValue(yourYear, yourMonth, yourDay) && !!getDateValue(partnerYear, partnerMonth, partnerDay);
        break;
    }
    submitBtn.disabled = !ok;
  }

  function markStart(){
    if(startTracked) return;
    startTracked = true;
    if(typeof trackEvent === 'function') trackEvent('fortune_start', { theme: currentTheme });
  }

  // ── ステップ制御 ──
  function currentStepId(){
    var visible = modal.querySelector('.aichat-step:not([hidden])');
    return visible ? visible.id : 'aichatStepTheme';
  }
  function showStep(id){
    modal.querySelectorAll('.aichat-step').forEach(function(s){
      s.hidden = (s.id !== id);
    });
  }
  function pushStep(id){
    stepStack.push(currentStepId());
    showStep(id);
  }
  function goBack(){
    var prev = stepStack.pop() || 'aichatStepTheme';
    showStep(prev);
  }

  function setupInput(theme){
    currentTheme = theme;
    inputError.innerHTML = '';
    modal.querySelectorAll('.aichat-input-variant').forEach(function(v){ v.hidden = true; });
    inputHeading.textContent = INPUT_HEADINGS[theme] || '';

    if(theme === 'kaiun' || theme === 'self'){
      document.getElementById('aichatInputSingle').hidden = false;
      resetDateGroup(singleYear, singleMonth, singleDay);
    } else if(theme === 'marriage_self'){
      document.getElementById('aichatInputMarriageSelf').hidden = false;
      resetDateGroup(msYear, msMonth, msDay);
      selectedMbti = null;
      selectedBlood = null;
      modal.querySelectorAll('#aichatMbtiGrid .aichat-mbti-btn').forEach(function(x){ x.classList.remove('selected'); });
      modal.querySelectorAll('#aichatBloodGrid .aichat-blood-btn').forEach(function(x){ x.classList.remove('selected'); });
    } else if(theme === 'marriage_person' || theme === 'compatibility'){
      document.getElementById('aichatInputDual').hidden = false;
      resetDateGroup(yourYear, yourMonth, yourDay);
      resetDateGroup(partnerYear, partnerMonth, partnerDay);
    }
    updateSubmitState();
    pushStep('aichatStepInput');
  }

  function renderResult(theme, data){
    modal.querySelectorAll('.aichat-result-variant').forEach(function(v){ v.hidden = true; });
    resultHeading.textContent = RESULT_HEADINGS[theme] || '';

    if(theme === 'kaiun'){
      document.getElementById('aichatKaiunStar').textContent = data.star || '';
      document.getElementById('aichatKaiunText').textContent = data.resultText || '';
      document.getElementById('aichatResultKaiun').hidden = false;
    } else if(theme === 'self'){
      var sUl = document.getElementById('aichatSelfStrengths'); sUl.innerHTML = '';
      (data.strengths || []).forEach(function(t){
        var li = document.createElement('li'); li.textContent = t; sUl.appendChild(li);
      });
      var wUl = document.getElementById('aichatSelfWeaknesses'); wUl.innerHTML = '';
      (data.weaknesses || []).forEach(function(t){
        var li = document.createElement('li'); li.textContent = t; wUl.appendChild(li);
      });
      document.getElementById('aichatSelfRelations').textContent = data.relations || '';
      document.getElementById('aichatResultSelf').hidden = false;
    } else if(theme === 'marriage_self'){
      document.getElementById('aichatMarriageSelfText').textContent = data.resultText || '';
      document.getElementById('aichatResultMarriageSelf').hidden = false;
    } else if(theme === 'marriage_person' || theme === 'compatibility'){
      var starsEl = document.getElementById('aichatScoreStars');
      starsEl.innerHTML = '';
      var score = parseInt(data.score, 10) || 0;
      for(var i = 1; i <= 5; i++){
        var s = document.createElement('span');
        s.className = 'aichat-star' + (i <= score ? ' on' : '');
        s.textContent = '★';
        starsEl.appendChild(s);
      }
      document.getElementById('aichatScoreLabel').textContent = data.label || '';
      document.getElementById('aichatScoreReason').textContent = data.reasonText || '';
      document.getElementById('aichatResultScore').hidden = false;
    }
  }

  function resetAll(){
    currentTheme = null;
    stepStack = [];
    startTracked = false;
    selectedMbti = null;
    selectedBlood = null;
    inputError.innerHTML = '';
    modal.querySelectorAll('#aichatMbtiGrid .aichat-mbti-btn').forEach(function(x){ x.classList.remove('selected'); });
    modal.querySelectorAll('#aichatBloodGrid .aichat-blood-btn').forEach(function(x){ x.classList.remove('selected'); });
    resetDateGroup(singleYear, singleMonth, singleDay);
    resetDateGroup(msYear, msMonth, msDay);
    resetDateGroup(yourYear, yourMonth, yourDay);
    resetDateGroup(partnerYear, partnerMonth, partnerDay);
    submitBtn.disabled = true;
    showStep('aichatStepTheme');
  }

  // ── クリック委譲 ──
  modal.addEventListener('click', function(e){
    var backBtn = e.target.closest('[data-back]');
    if(backBtn){ goBack(); return; }

    var themeCard = e.target.closest('.aichat-theme-card');
    if(themeCard){
      var theme = themeCard.dataset.theme;
      if(theme === 'marriage'){
        pushStep('aichatStepMarriageChoice');
      } else {
        setupInput(theme);
      }
      return;
    }
  });

  submitBtn.addEventListener('click', function(){
    if(submitBtn.disabled) return;
    var payload = { theme: currentTheme };
    switch(currentTheme){
      case 'kaiun':
      case 'self':
        payload.birthday = getDateValue(singleYear, singleMonth, singleDay);
        break;
      case 'marriage_self':
        payload.birthday = getDateValue(msYear, msMonth, msDay);
        payload.mbti = selectedMbti;
        payload.blood = selectedBlood;
        break;
      case 'marriage_person':
      case 'compatibility':
        payload.yourBirthday = getDateValue(yourYear, yourMonth, yourDay);
        payload.partnerBirthday = getDateValue(partnerYear, partnerMonth, partnerDay);
        break;
    }
    inputError.innerHTML = '';
    pushStep('aichatStepLoading');

    fetch('/api/fortune-chat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })
    .then(function(res){ return res.json(); })
    .then(function(data){
      if(data.error) throw new Error(data.error);
      renderResult(currentTheme, data);
      showStep('aichatStepResult');
      if(typeof trackEvent === 'function') trackEvent('fortune_result_view', { theme: currentTheme });
    })
    .catch(function(){
      goBack();
      inputError.innerHTML = '<div class="aichat-error-box">診断に失敗しました。もう一度お試しください。</div>';
    });
  });

  retryBtn.addEventListener('click', function(){
    resetAll();
  });

  function openAiChatModal(){
    resetAll();
    overlay.classList.add('open');
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeAiChatModal(){
    overlay.classList.remove('open');
    modal.classList.remove('open');
    document.body.style.overflow = '';
    resetAll();
  }
  window.openAiChatModal = openAiChatModal;

  closeBtn.addEventListener('click', closeAiChatModal);
  overlay.addEventListener('click', closeAiChatModal);
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && modal.classList.contains('open')) closeAiChatModal();
  });
})();
</script>
