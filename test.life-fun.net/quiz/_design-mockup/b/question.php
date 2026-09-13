<?php
declare(strict_types=1);
// 【比較モックアップ／案B：ソフト・ダーク型】① 問題ページ
require __DIR__ . '/../_bootstrap.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>【モックアップ案B】<?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #1b1f2c;   /* 従来の#08060f(ほぼ黒)から濃紺〜チャコールへ */
  --surface: #232838;
  --card:    #2a3042;   /* bodyより明るく、選択肢が浮き上がって見える */
  --card-hi: #323952;
  --border:  rgba(180,170,220,.16);
  --border2: rgba(180,170,220,.36);
  --gold:    #d8b45e;
  --gold-lt: #eed08c;
  --violet:  #8c7ce0;
  --violet-lt:#c2b6f2;
  --rose:    #dd90ab;
  --text:    #ede9f5;
  --muted:   #9aa2c4;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh;overflow-x:hidden}
body::before{
  content:'';position:fixed;inset:0;
  /* 従来の強い紫/薔薇の放射状グラデーションを弱め、単一の淡いグローに */
  background: radial-gradient(ellipse at 50% -10%, rgba(140,124,224,.14) 0%, transparent 55%);
  pointer-events:none;z-index:0;
}
.mock-badge{
  position:fixed;top:0;left:0;right:0;z-index:500;
  background:#000;color:#fff;text-align:center;font-family:var(--ff-mono);
  font-size:.68rem;letter-spacing:.08em;padding:.4rem;
}
.wrap{position:relative;z-index:1;max-width:700px;margin:0 auto;padding:2.6rem 1.2rem 3rem}
.quiz-hero{text-align:center;padding:1rem 1rem 2rem;border-bottom:1px solid var(--border)}
.quiz-eyebrow{font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1.2rem;display:block}
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.5;letter-spacing:.04em;color:var(--text);margin-bottom:1rem}
.quiz-lead{color:var(--muted);font-size:.9rem;line-height:1.9}
.quiz-choices{display:flex;flex-direction:column;gap:1rem;padding:2rem 0}
.quiz-choice{
  display:flex;align-items:center;gap:1rem;min-height:64px;
  background:var(--card);border:1px solid var(--border2);border-radius:14px;
  padding:1.15rem 1.35rem;text-decoration:none;color:var(--text);
  transition:border-color .18s,transform .15s,background .18s,box-shadow .18s;
}
.quiz-choice:hover,.quiz-choice:focus-visible{
  border-color:var(--gold);background:var(--card-hi);transform:translateY(-2px);
  box-shadow:0 6px 22px rgba(216,180,94,.16);
}
.quiz-choice:focus-visible{outline:2px solid var(--gold-lt);outline-offset:2px}
.quiz-choice-mark{
  flex-shrink:0;width:2.2rem;height:2.2rem;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,var(--violet),var(--gold));
  font-family:var(--ff-mono);font-size:.8rem;font-weight:400;color:#1b1f2c;
}
.quiz-choice-text{font-size:.94rem;line-height:1.7}
.quiz-choice-arrow{margin-left:auto;flex-shrink:0;color:var(--muted);font-size:1rem;transition:color .18s,transform .18s}
.quiz-choice:hover .quiz-choice-arrow{color:var(--gold-lt);transform:translateX(3px)}
.mock-note{margin-top:2rem;padding:1rem 1.2rem;background:var(--surface);border:1px dashed var(--border2);border-radius:10px;font-size:.78rem;color:var(--muted);font-family:var(--ff-mono);line-height:1.7}
@media(max-width:600px){
  .quiz-hero{padding:.5rem .5rem 1.5rem}
}
</style>
</head>
<body>
<div class="mock-badge">DESIGN MOCKUP — 案B：ソフト・ダーク型（noindex／本番非公開）</div>
<div class="wrap quiz-wrap" style="margin-top:2rem">

  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $quizNumberStr ?></span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p class="quiz-lead"><?= nl2br(htmlspecialchars($quiz['lead'], ENT_QUOTES, 'UTF-8')) ?></p>
  </section>

  <section class="quiz-choices">
    <?php foreach (['a1','a2','a3','a4'] as $_k): ?>
    <a href="result.php?a=<?= $_k ?>" class="quiz-choice">
      <span class="quiz-choice-mark"><?= strtoupper($_k) ?></span>
      <span class="quiz-choice-text"><?= htmlspecialchars($quiz['choices'][$_k], ENT_QUOTES, 'UTF-8') ?></span>
      <span class="quiz-choice-arrow">→</span>
    </a>
    <?php endforeach; ?>
  </section>

  <div class="mock-note">
    比較用モックアップです。実際のQuiz機能（GA4計測・AdSense等）は含まれていません。<br>
    選択肢をクリックすると同案の回答ページ（result.php）へ遷移します。
  </div>

</div>
</body>
</html>
