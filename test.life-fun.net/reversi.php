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
<meta name="description" content="名前と生年月日を入力後、リバーシ（オセロ）の対局中の一手一手が「布石」となり、あなたの選択パターンから今日の運勢・アドバイスを読み解く新感覚の占いゲームです。">
<title>リバーシ占い｜布石から読み解く今日の運勢【無料占い】</title>
<link rel="canonical" href="https://life-fun.net/reversi" />
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

/* ─── HEADER：inc/header.php側で一元管理（COMPONENTS.md参照） ─── */

.wrap{max-width:900px;margin:0 auto;padding:2rem 1.2rem 4rem;display:flex;flex-direction:column;align-items:center}
.page-title{text-align:center;margin-bottom:1.5rem}
.page-title h1{font-family:var(--ff-serif);font-size:1.6rem;font-weight:700;letter-spacing:.1em;margin-bottom:.4rem}
.page-title .subtitle{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--muted);text-transform:uppercase;margin-bottom:.4rem}
.page-title .page-copy{font-size:.85rem;color:rgba(232,226,245,.78);margin-top:.3rem}

.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1rem 1.4rem;margin-bottom:1.5rem;max-width:520px;width:100%}
.tool-desc p{font-size:.85rem;color:rgba(232,226,245,.78);line-height:1.7;margin-bottom:.5rem}
.tool-desc p:last-child{margin-bottom:0}

/* ─── タスク1：占い開始前の入力フロー（D-0068⑥、既存fortune系入力パターンを踏襲） ─── */
.form-card{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:2rem;margin-bottom:1.5rem;max-width:448px;width:100%}
.form-section-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:1.2rem;text-align:center}
.error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:8px;padding:.75rem 1rem;margin-bottom:1rem;font-size:.88rem;color:var(--rose);display:none}
.form-group{margin-bottom:1.6rem}
.form-label{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.1em;color:var(--muted);display:block;margin-bottom:.4rem}
.form-input{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.75rem 1rem;font-family:var(--ff-sans);font-size:1rem;color:var(--text);outline:none;transition:border-color .2s}
.form-input:focus{border-color:var(--violet)}
.date-input-group select.form-input{background-color:#1e1738;-webkit-appearance:none;appearance:none;color-scheme:dark}
.submit-btn{width:100%;padding:1rem;background:linear-gradient(135deg,rgba(155,114,239,.8),rgba(201,168,76,.7));border:none;border-radius:10px;font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;color:#fff;cursor:pointer;margin-top:.4rem;letter-spacing:.12em;transition:opacity .2s}
.submit-btn:hover{opacity:.88}

canvas#board{border:2px solid var(--gold);box-shadow:0 0 20px rgba(212,170,80,.18),inset 0 0 14px rgba(0,0,0,.35);border-radius:8px;cursor:pointer;max-width:100%;height:auto}
#status{margin-top:12px;font-size:15px;font-weight:bold;color:var(--text)}
.game-controls{display:flex;gap:.6rem;margin-top:12px}
.game-controls button{padding:.5rem 1.2rem;font-size:.85rem;font-family:var(--ff-sans);border:1px solid var(--border2);border-radius:8px;background:rgba(155,114,239,.15);color:var(--violet-lt);cursor:pointer}
.game-controls button:hover{background:rgba(155,114,239,.28)}

.disclaimer{font-size:.65rem;color:var(--muted);text-align:center;margin-top:1.2rem;line-height:1.7;max-width:448px}

#fortuneResultWrapper{margin-top:20px;width:100%;max-width:448px}
.fortune-title{color:var(--muted);font-size:.7rem;margin-bottom:.5rem;font-family:var(--ff-mono);letter-spacing:.1em}
#fortuneResult{padding:14px 16px;background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.3);border-radius:10px;min-height:16px}
.fortune-score{font-size:14px;color:var(--gold-lt);margin-bottom:8px;display:flex;align-items:center;gap:8px}
.fortune-score-stage{position:relative;display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px}
.fortune-score-ring{position:absolute;top:0;left:0;width:56px;height:56px}
.fortune-score-value{position:relative;z-index:1;font-size:22px;font-weight:bold;color:var(--text)}
.fortune-advice{font-size:15px;line-height:1.7;color:var(--text);margin-bottom:10px}
.fortune-row{display:flex;justify-content:space-between;font-size:14px;color:var(--text);padding:4px 0}
.fortune-label{color:var(--muted)}
.fortune-value{font-weight:bold}

.share-area{margin-top:1rem}

/* ─── 開発者向けプレイテストログパネル（本番life-fun.netでは非表示。D-0088） ─── */
#logPanel{margin-top:20px;width:100%;max-width:448px;padding:12px;background:var(--card);border:1px solid var(--border);border-radius:8px}
#logPanel h2{font-size:14px;margin:0 0 8px;color:var(--text)}
#logPanel h3{font-size:13px;margin:14px 0 6px;color:var(--muted)}
#noteInput,#diagnosisFeedbackInput{width:100%;box-sizing:border-box;height:60px;font-size:13px;padding:6px;background:var(--void);color:var(--text);border:1px solid var(--border)}
.logActions{margin-top:8px;display:flex;gap:8px}
.logActions button{padding:6px 14px;font-size:13px;cursor:pointer}
#savedCount{font-size:12px;color:var(--muted);margin-top:6px}
</style>
</head>
<body>

<?php $currentPage='reversi'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <!-- タイトル構成確定（2026-07-18、D-0089）：サブブランド／H1／コピーの3層構造。
       サブブランド＝世界観補助（Destiny Reversi、正式ブランド名への昇格はQ-005で将来検討）
       H1＝商品名（既存15占術と同じ「即理解できる」命名規則に合わせる）
       コピー＝独自性（D-0011「石＝選択の軌跡」を「布石」で表現、H1に直接入れると攻略記事的に読めるためコピー側に配置） -->
  <div class="page-title">
    <p class="subtitle">Destiny Reversi</p>
    <h1>リバーシ占い</h1>
    <p class="page-copy">布石から読み解く今日の運勢</p>
  </div>

  <div class="tool-desc">
    <p>リバーシ占いは、名前と生年月日を入力したあと、実際の対局中のあなたの打ち方（選択のパターン）から性格の傾向を読み解き、今日の運勢・一言アドバイスを診断する占いゲームです。一手一手の選択が、今日のあなたを映す「布石」になります。</p>
    <p>対局を最後まで打ち終えると、あなたのプレイスタイルに応じた今日の総合運・一言アドバイス・ラッキーカラー・ラッキーアイテムが表示されます。結果は対局ごとに変わります。</p>
  </div>

  <!-- タスク1：占い開始前の入力フロー（D-0068⑥）。aisho.php連携・診断ロジックへの反映は範囲外、
       ゲーム開始前の入力儀式としてのみ実装する。 -->
  <div class="form-card" id="startScreen">
    <div class="form-section-label">✦ あなたの情報を入力 ✦</div>
    <div class="error-box" id="startFormError"></div>
    <div class="form-group">
      <label class="form-label" for="userName">お名前（任意・ニックネーム可）</label>
      <input class="form-input" type="text" id="userName" placeholder="例：山田 花子" maxlength="30">
    </div>
    <div class="form-group">
      <label class="form-label">生年月日</label>
      <?php require_once __DIR__.'/inc/birthday-input.php'; render_birthdate_input(['prefix' => 'birth', 'hiddenName' => 'birthday']); ?>
    </div>
    <button class="submit-btn" id="startGameBtn">占いを始める</button>
    <p class="disclaimer" style="margin-top:1.3rem">入力された情報はサーバーに送信・保存されません。<br>※本サービスはエンターテインメントです。重要な判断の根拠にはしないでください。</p>
  </div>

  <div id="gameArea" style="display:none">
    <canvas id="board" width="448" height="448"></canvas>
    <div id="status"></div>
    <div class="game-controls">
      <button id="newGameBtn" data-ga-event="retry_click">もう一度対局する</button>
      <button id="audioToggleBtn">音: ON</button>
    </div>
  </div>

  <div id="fortuneResultWrapper" style="display:none">
    <div class="fortune-title">今日の占い結果</div>
    <div id="fortuneResult"></div>

    <div class="share-area">
      <?php require __DIR__.'/inc/share-btns.php'; ?>
      <?php
      // 【要レビュー】$articleIcon/$articleTitle/$articleDescは草案。解説記事(/articles/reversi/)は未作成のため
      // nav-cards.php未登録の間は$articleUrl=nullとなり実際には表示されない（sansei/calendar/rpg/geimeiと同じ扱い）。
      $articleIcon  = '⚫️';
      $articleTitle = 'リバーシ占いとは？';
      $articleDesc  = '対局の打ち方から運勢を読み解く仕組みを解説';
      $contextKey   = 'reversi';
      $retryLabel   = 'もう一度対局する';
      $retryType    = 'js';
      $retryValue   = 'reversiNewGame()';
      require __DIR__.'/inc/result-footer.php';
      ?>
    </div>
  </div>

  <!-- 開発者向け：Bot検証・演出確認用のプレイテストログパネル。本番(life-fun.net)では非表示（D-0088） -->
  <div id="logPanel" style="display:none">
    <h2>この対局の感想を記録する（開発用）</h2>
    <h3>プレイ内容について</h3>
    <textarea id="noteInput" placeholder="どんな打ち方を意識しましたか？"></textarea>
    <h3>結果画面について</h3>
    <textarea id="diagnosisFeedbackInput" placeholder="結果画面について、気になった点や違和感があれば自由に教えてください。"></textarea>
    <div class="logActions">
      <button id="saveLogBtn">この対局を記録する</button>
      <button id="downloadLogBtn">記録した全ログをダウンロード（JSON）</button>
    </div>
    <div id="savedCount">記録済み：0件</div>
  </div>
</div>

<?php require __DIR__.'/inc/retry-reset.php'; ?>
<?php require __DIR__.'/inc/form-error-inline.php'; ?>
<?php require __DIR__.'/inc/footer.php'; ?>

<script type="module">
  import { GameController } from './reversi-assets/ui/controller.js';

  const canvas = document.getElementById('board');
  const statusEl = document.getElementById('status');
  const resultEl = document.getElementById('fortuneResult');
  const resultWrapper = document.getElementById('fortuneResultWrapper');
  const controller = new GameController(canvas, statusEl, null, null, null, null, resultEl);

  // D-0088：result-footer.phpの共通リトライボタン（inline onclick）から呼べるよう、
  // moduleスコープのcontrollerをグローバル関数経由でのみ公開する（window直下には出さない）。
  window.reversiNewGame = function () {
    resultEl.innerHTML = '';
    resultWrapper.style.display = 'none';
    // D-0088バグ修正：開発用ログパネルは#logPanel自体が非表示なだけでDOMからは消えないため、
    // 本番判定に関わらず毎回リセットして問題ない（存在チェックは念のため）。
    const saveLogBtn = document.getElementById('saveLogBtn');
    const noteInput = document.getElementById('noteInput');
    const diagnosisFeedbackInput = document.getElementById('diagnosisFeedbackInput');
    if (saveLogBtn) {
      saveLogBtn.disabled = false;
      saveLogBtn.textContent = 'この対局を記録する';
    }
    if (noteInput) noteInput.value = '';
    if (diagnosisFeedbackInput) diagnosisFeedbackInput.value = '';
    controller.newGame();
    // D-0095：他ページのresetResultView()がトップへスクロールするのに合わせ、
    // 対局画面（#gameArea）まで自動スクロールする。result-footer.phpのボタンは
    // 結果パネルの下にあるため、押した後の視点をゲーム画面に戻す必要がある。
    gameArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };
  document.getElementById('newGameBtn').addEventListener('click', reversiNewGame);

  const audioToggleBtn = document.getElementById('audioToggleBtn');
  function syncAudioButtonLabel() {
    audioToggleBtn.textContent = `音: ${controller.audioManager.enabled ? 'ON' : 'OFF'}`;
  }
  syncAudioButtonLabel();
  audioToggleBtn.addEventListener('click', () => {
    controller.audioManager.resume();
    controller.audioManager.setEnabled(!controller.audioManager.enabled);
    syncAudioButtonLabel();
  });

  // タスク1：占い開始前の入力フロー（D-0068⑥）。生年月日はaisho.php連携・診断ロジックには使わず、
  // ゲーム開始前の入力儀式としてのみ扱う（今回のスコープ外）。
  // fortune_startは`inc/birthday-input.php`のBirthdayInput.init()が年月日いずれかを最初に操作した
  // 時点で自動発火する（他ページと同じ計測タイミング）ため、ここで重複して発火させない。
  const startScreen = document.getElementById('startScreen');
  const gameArea = document.getElementById('gameArea');
  document.getElementById('startGameBtn').addEventListener('click', () => {
    // D-0092：名前は任意入力。診断ロジックには使わず、結果タイトルの表示にのみ使うため、
    // 未入力時は汎用表示（「あなたへの」）にフォールバックする。
    const name = document.getElementById('userName').value.trim();
    const birthday = window.BirthdayInput ? window.BirthdayInput.getValue('birth') : document.getElementById('birth-hidden').value;
    if (!birthday) {
      showInlineError('startFormError', '生年月日を入力してください');
      return;
    }
    hideInlineError('startFormError');
    document.querySelector('.fortune-title').textContent = name ? `${name}さんへの今日の占い結果` : 'あなたへの今日の占い結果';
    startScreen.style.display = 'none';
    gameArea.style.display = 'block';
  });

  // D-0091：開発者向けプレイテストログパネルは、ローカル開発時のみ表示する（本番・STGとも非表示）。
  // 以前はSTG（test.life-fun.net）でも表示する設計だったが、本人からSTGでの実機確認時に
  // 「出っぱなし」と指摘されたため、localhostのみに変更した。
  function isLocalDev() {
    return location.hostname === 'localhost' || location.hostname === '127.0.0.1';
  }
  const logPanel = document.getElementById('logPanel');
  if (isLocalDev()) {
    logPanel.style.display = 'block';

    const noteInput = document.getElementById('noteInput');
    const diagnosisFeedbackInput = document.getElementById('diagnosisFeedbackInput');
    const savedCountEl = document.getElementById('savedCount');
    const sessionLogs = [];
    let lastSavedGameNumber = null;
    const saveLogBtn = document.getElementById('saveLogBtn');

    saveLogBtn.addEventListener('click', () => {
      const summary = controller.getLastGameSummary();
      if (!summary) return;
      if (summary.gameNumber === lastSavedGameNumber) return;
      sessionLogs.push({ ...summary, subjectiveNote: noteInput.value, diagnosisFeedback: diagnosisFeedbackInput.value });
      lastSavedGameNumber = summary.gameNumber;
      savedCountEl.textContent = `記録済み：${sessionLogs.length}件`;
      saveLogBtn.disabled = true;
      saveLogBtn.textContent = '記録済み（次の対局から再度記録できます）';
    });

    document.getElementById('downloadLogBtn').addEventListener('click', () => {
      const blob = new Blob([JSON.stringify(sessionLogs, null, 2)], { type: 'application/json' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = `destiny-reversi-playtest-${Date.now()}.json`;
      a.click();
      URL.revokeObjectURL(url);
    });
  }
</script>
</body>
</html>
