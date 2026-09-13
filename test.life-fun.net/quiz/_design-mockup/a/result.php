<?php
declare(strict_types=1);
// 【比較モックアップ／案A：ライト・マガジン型】② 回答ページ
require __DIR__ . '/../_bootstrap.php';
$quizChoice = $quizChoiceParam;
$shortLabel = quizmock_short_label($quiz['choices'][$quizChoice]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>【モックアップ案A・結果】<?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:      #faf6ef;
  --surface: #ffffff;
  --card:    #ffffff;
  --border:  #e7dfcb;
  --border2: #d8ccae;
  --accent:  #b8863a;
  --accent-dk:#8f6626;
  --accent2: #c14f68;
  --tint:    #fbf1e2;
  --text:    #2b2620;
  --muted:   #756c5c;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:var(--ff-sans);font-weight:400;line-height:1.8;min-height:100vh}
.mock-badge{
  position:fixed;top:0;left:0;right:0;z-index:500;
  background:#222;color:#fff;text-align:center;font-family:var(--ff-mono);
  font-size:.68rem;letter-spacing:.08em;padding:.4rem;
}
.wrap{max-width:700px;margin:0 auto;padding:2.6rem 1.2rem 3rem}
.quiz-hero{text-align:center;padding:1rem 1rem 2rem;border-bottom:2px solid var(--border)}
.quiz-eyebrow{
  font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.25em;color:var(--accent-dk);
  text-transform:uppercase;margin-bottom:1.2rem;display:inline-block;
  padding:.3rem .9rem;border:1px solid var(--border2);border-radius:20px;background:var(--tint);
}
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.5;letter-spacing:.03em;color:var(--text);margin-top:1rem}
.quiz-result-block{
  background:var(--card);border:1.5px solid var(--border2);border-radius:18px;
  padding:1.9rem;margin:2rem 0;box-shadow:0 4px 16px rgba(43,38,32,.06);
}
.quiz-your-choice{
  font-family:var(--ff-mono);font-size:.8rem;color:var(--accent-dk);
  letter-spacing:.02em;margin-bottom:1.2rem;padding-bottom:1rem;
  border-bottom:1px dashed var(--border2);
}
.quiz-your-choice b{color:var(--accent2);font-weight:700}
.quiz-result-text{font-size:.95rem;line-height:2;color:var(--text)}
.quiz-btn-primary{
  display:inline-block;margin-top:1.6rem;padding:.85rem 1.9rem;
  background:linear-gradient(135deg,var(--accent) 0%,var(--accent2) 100%);
  color:#fff;border-radius:24px;text-decoration:none;
  font-family:var(--ff-serif);font-weight:600;font-size:.9rem;letter-spacing:.06em;
  box-shadow:0 6px 18px rgba(184,134,58,.3);transition:opacity .2s,transform .15s;
}
.quiz-btn-primary:hover{opacity:.9;transform:translateY(-1px)}
.mock-note{margin-top:2rem;padding:1rem 1.2rem;background:#fff;border:1px dashed var(--border2);border-radius:10px;font-size:.78rem;color:var(--muted);font-family:var(--ff-mono);line-height:1.7}
@media(max-width:600px){
  .quiz-hero{padding:.5rem .5rem 1.5rem}
  .quiz-result-block{padding:1.3rem 1.1rem}
}
</style>
</head>
<body>
<div class="mock-badge">DESIGN MOCKUP — 案A：ライト・マガジン型（noindex／本番非公開）</div>
<div class="wrap quiz-wrap" style="margin-top:2rem">

  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $quizNumberStr ?> · 結果</span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
  </section>

  <section class="quiz-result-block">
    <p class="quiz-your-choice">あなたが選んだのは「<b><?= htmlspecialchars($shortLabel, ENT_QUOTES, 'UTF-8') ?></b>」でした。</p>
    <p class="quiz-result-text"><?= nl2br(htmlspecialchars($quiz['results'][$quizChoice], ENT_QUOTES, 'UTF-8')) ?></p>
    <a href="question.php" class="quiz-btn-primary">← 別の選択肢を見る（モックアップ内移動）</a>
  </section>

  <div class="mock-note">
    比較用モックアップです。コピー修正：「あなたが選んだのは『<?= htmlspecialchars($quiz['choices'][$quizChoice], ENT_QUOTES, 'UTF-8') ?>』」の二重鉤括弧を解消し、
    「あなたが選んだのは『<?= htmlspecialchars($shortLabel, ENT_QUOTES, 'UTF-8') ?>』でした。」に短縮表示しています（表示方法の実験、恒久実装は別途検討）。
  </div>

</div>
</body>
</html>
