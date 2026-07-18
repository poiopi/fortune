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
<meta name="description" content="オセロで対局しながら占う無料占いゲーム。今日の運勢・ラッキーカラー・ラッキーアイテムが分かります。">
<title>オセロ占い｜対局で占う今日の運勢</title>
<link rel="canonical" href="https://life-fun.net/reversi" />
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
  --void:#08060f;--card:#1e1738;--gold:#c9a84c;--gold-lt:#e8c96a;
  --violet:#9b72ef;--violet-lt:#c4a8f5;--text:#e8e2f5;--muted:#8a7db5;
  --border:rgba(160,130,220,.18);--border2:rgba(160,130,220,.35);
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
}
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--void);color:var(--text);font-family:var(--ff-serif);line-height:1.7;min-height:100vh}
a{color:var(--violet);text-decoration:none}
/* ── Layout ── */
.wrap{max-width:860px;margin:0 auto;padding:2rem 1.2rem 4rem}
/* ── Page title ── */
.page-title{text-align:center;padding:2.5rem 0 2rem}
.subtitle{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.22em;color:var(--gold);text-transform:uppercase;margin-bottom:.6rem}
h1{font-size:clamp(1.2rem,3.5vw,1.7rem);letter-spacing:.08em;font-weight:700;line-height:1.4}
/* ── Tool description ── */
.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem;margin-bottom:1.5rem}
.tool-desc p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.tool-desc p:last-child{margin-bottom:0}
/* ── Game card ── */
.game-card{background:var(--card);border:1px solid var(--border2);border-radius:16px;padding:1.8rem 1.5rem;margin-bottom:1.5rem;display:flex;flex-direction:column;align-items:center}
.board-wrap{display:flex;justify-content:center;width:100%}
#board{max-width:100%;height:auto;border:2px solid var(--gold);border-radius:8px;box-shadow:0 0 20px rgba(201,168,76,.18),inset 0 0 14px rgba(0,0,0,.35);cursor:pointer}
.game-status{margin-top:1rem;font-size:.95rem;font-weight:700;color:var(--text);text-align:center;min-height:1.4rem}
.game-btn-row{display:flex;gap:.8rem;margin-top:1.2rem;flex-wrap:wrap;justify-content:center}
.game-btn{padding:.7rem 1.6rem;border-radius:20px;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.06em;cursor:pointer;transition:opacity .2s,border-color .2s}
#newGameBtn.game-btn{background:linear-gradient(135deg,#3a1a7a,#6a30c0);border:1px solid rgba(155,114,239,.5);color:#e8e0f8}
#newGameBtn.game-btn:hover{opacity:.9;box-shadow:0 0 20px rgba(155,114,239,.4)}
#audioToggleBtn.game-btn{background:none;border:1px solid var(--border2);color:var(--muted)}
#audioToggleBtn.game-btn:hover{color:var(--text);border-color:var(--violet)}
/* ── Fortune result ── */
.fortune-title{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;text-align:center;margin-bottom:.8rem}
#fortuneResult{background:var(--card);border:1px solid var(--border2);border-radius:14px;padding:1.4rem 1.6rem;min-height:16px;margin-bottom:1.5rem}
.fortune-score{font-size:.95rem;color:var(--gold);margin-bottom:1rem;display:flex;align-items:center;gap:.8rem;justify-content:center;font-family:var(--ff-mono);letter-spacing:.06em}
.fortune-score-stage{position:relative;display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px}
.fortune-score-ring{position:absolute;top:0;left:0;width:56px;height:56px}
.fortune-score-value{position:relative;z-index:1;font-size:1.3rem;font-weight:700;color:var(--gold-lt);font-family:var(--ff-serif)}
.fortune-advice{font-size:.95rem;line-height:1.8;color:var(--text);margin-bottom:1rem;text-align:center}
.fortune-row{display:flex;justify-content:space-between;font-size:.85rem;color:var(--text);padding:.5rem 0;border-top:1px solid var(--border)}
.fortune-label{color:var(--muted)}
.fortune-value{font-weight:700;color:var(--gold-lt)}
/* ── Disclaimer ── */
.disclaimer{max-width:760px;margin:0 auto 1.5rem;text-align:center;font-size:.7rem;color:var(--muted);line-height:1.8;font-family:var(--ff-mono)}
</style>
</head>
<body>
<?php $currentPage='reversi'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <div class="page-title">
    <div class="subtitle">Destiny Reversi</div>
    <h1>オセロ占い｜対局で占う今日の運勢</h1>
  </div>

  <div class="tool-desc">
    <p>盤面をひっくり返すたびに、あなたの今日の運勢が姿を変えていきます。CPUと対局しながら、総合運・ラッキーカラー・ラッキーアイテムを占いましょう。</p>
    <p>ルールは通常のオセロと同じです。あなたは黒、CPUは白として対局し、対局が終わると自動で今日の占い結果が表示されます。</p>
  </div>

  <div class="game-card">
    <div class="board-wrap">
      <canvas id="board" width="448" height="448"></canvas>
    </div>
    <div id="status" class="game-status"></div>
    <div class="game-btn-row">
      <button id="newGameBtn" class="game-btn">もう一度対局する</button>
      <button id="audioToggleBtn" class="game-btn">音: ON</button>
    </div>
  </div>

  <div class="fortune-title">✦ 今日の占い結果 ✦</div>
  <div id="fortuneResult"></div>

  <script type="module">
    import { GameController } from '/reversi-assets/ui/controller.js';

    const canvas = document.getElementById('board');
    const statusEl = document.getElementById('status');
    const resultEl = document.getElementById('fortuneResult');

    // traitsEl・relationshipEl・highlightEl・recommendationsElは本ページでは使用しないためnull。
    const controller = new GameController(canvas, statusEl, null, null, null, null, resultEl);

    // result-footer.phpの「もう一度対局する」ボタンからも呼べるよう、薄いブリッジをグローバルに公開する。
    window.reversiNewGame = () => controller.newGame();

    document.getElementById('newGameBtn').addEventListener('click', () => {
      controller.newGame();
    });

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
  </script>

  <p class="disclaimer">
    本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。
  </p>

  <?php require __DIR__.'/inc/share-btns.php'; ?>
  <?php
  $articleIcon  = '';
  $articleTitle = '';
  $articleDesc  = '';
  $contextKey   = 'reversi';
  $retryLabel   = 'もう一度対局する';
  $retryType    = 'js';
  $retryValue   = 'window.reversiNewGame()';
  require __DIR__.'/inc/result-footer.php';
  ?>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>
</body>
</html>
