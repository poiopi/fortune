<?php
declare(strict_types=1);
// 【比較モックアップ／案C：ペーパー／カード型】② 回答ページ
require __DIR__ . '/../_bootstrap.php';
$quizChoice = $quizChoiceParam;
$shortLabel = quizmock_short_label($quiz['choices'][$quizChoice]);

$accentMap = [
    'a1' => ['fg' => '#c1616a', 'bg' => '#fdf1f1', 'bd' => '#f0c6c9'],
    'a2' => ['fg' => '#3f7fa6', 'bg' => '#eff7fb', 'bd' => '#c7e1ee'],
    'a3' => ['fg' => '#3f9c74', 'bg' => '#eefbf4', 'bd' => '#c3e9d5'],
    'a4' => ['fg' => '#7d63b8', 'bg' => '#f5f0fc', 'bd' => '#dccdf0'],
];
$accent = $accentMap[$quizChoice];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>【モックアップ案C・結果】<?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:      #f4efe1;
  --paper:   #fffdf7;
  --border:  #e6dcc2;
  --border2: #d9caa4;
  --gold:    #b8863a;
  --gold-dk: #8f6626;
  --text:    #2f2a20;
  --muted:   #7a7060;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{
  background:
    radial-gradient(circle at 15% 10%, rgba(184,134,58,.05) 0%, transparent 40%),
    radial-gradient(circle at 85% 90%, rgba(125,99,184,.05) 0%, transparent 40%),
    var(--bg);
  color:var(--text);font-family:var(--ff-sans);font-weight:400;line-height:1.8;min-height:100vh
}
.mock-badge{
  position:fixed;top:0;left:0;right:0;z-index:500;
  background:#222;color:#fff;text-align:center;font-family:var(--ff-mono);
  font-size:.68rem;letter-spacing:.08em;padding:.4rem;
}
.wrap{max-width:700px;margin:0 auto;padding:2.6rem 1.2rem 3rem}
.quiz-hero{text-align:center;padding:1rem 1rem 2rem}
.quiz-eyebrow{
  font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.25em;color:var(--gold-dk);
  text-transform:uppercase;margin-bottom:1.2rem;display:inline-block;
  padding:.3rem 1rem;border:1px dashed var(--border2);border-radius:20px;background:var(--paper);
}
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.5;letter-spacing:.03em;color:var(--text);margin-top:1rem}
.quiz-result-block{
  position:relative;background:var(--card-bg, var(--paper));border:1.5px dashed var(--card-bd, var(--border2));
  border-radius:18px;padding:1.9rem;margin:2rem 0;box-shadow:0 6px 18px rgba(47,42,32,.08);
}
.quiz-result-block::before{
  content:'';position:absolute;left:0;top:1.2rem;bottom:1.2rem;width:5px;border-radius:4px;
  background:var(--card-fg, var(--gold));
}
.quiz-your-choice{
  font-family:var(--ff-mono);font-size:.8rem;color:var(--card-fg, var(--gold-dk));
  letter-spacing:.02em;margin-bottom:1.2rem;padding-bottom:1rem;padding-left:.3rem;
  border-bottom:1px dashed var(--border2);
}
.quiz-your-choice b{font-weight:700}
.quiz-result-text{font-size:.95rem;line-height:2;color:var(--text);padding-left:.3rem}
.quiz-btn-primary{
  display:inline-block;margin-top:1.6rem;margin-left:.3rem;padding:.85rem 1.9rem;
  background:var(--card-fg, var(--gold));
  color:#fff;border-radius:24px;text-decoration:none;
  font-family:var(--ff-serif);font-weight:600;font-size:.9rem;letter-spacing:.06em;
  box-shadow:0 6px 16px rgba(47,42,32,.18);transition:opacity .2s,transform .15s;
}
.quiz-btn-primary:hover{opacity:.88;transform:translateY(-1px)}
.mock-note{margin-top:2rem;padding:1rem 1.2rem;background:var(--paper);border:1px dashed var(--border2);border-radius:10px;font-size:.78rem;color:var(--muted);font-family:var(--ff-mono);line-height:1.7}
@media(max-width:600px){
  .quiz-hero{padding:.5rem .5rem 1.5rem}
  .quiz-result-block{padding:1.3rem 1.1rem}
}
</style>
</head>
<body>
<div class="mock-badge">DESIGN MOCKUP — 案C：ペーパー／カード型（noindex／本番非公開）</div>
<div class="wrap quiz-wrap" style="margin-top:2rem">

  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $quizNumberStr ?> · 結果</span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
  </section>

  <section class="quiz-result-block" style="--card-fg:<?= $accent['fg'] ?>;--card-bg:<?= $accent['bg'] ?>;--card-bd:<?= $accent['bd'] ?>">
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
