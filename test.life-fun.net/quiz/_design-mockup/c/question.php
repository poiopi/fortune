<?php
declare(strict_types=1);
// 【比較モックアップ／案C：ペーパー／カード型】① 問題ページ
require __DIR__ . '/../_bootstrap.php';

// 4択それぞれに割り当てるアクセントカラー（チケット風の色分け。装飾優先度は最も低いため最小限）
$accentMap = [
    'a1' => ['fg' => '#c1616a', 'bg' => '#fdf1f1', 'bd' => '#f0c6c9'],
    'a2' => ['fg' => '#3f7fa6', 'bg' => '#eff7fb', 'bd' => '#c7e1ee'],
    'a3' => ['fg' => '#3f9c74', 'bg' => '#eefbf4', 'bd' => '#c3e9d5'],
    'a4' => ['fg' => '#7d63b8', 'bg' => '#f5f0fc', 'bd' => '#dccdf0'],
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>【モックアップ案C】<?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></title>

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
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.5;letter-spacing:.03em;color:var(--text);margin-top:1rem;margin-bottom:1rem}
.quiz-lead{color:var(--muted);font-size:.92rem;line-height:1.9}
.quiz-choices{display:flex;flex-direction:column;gap:1.1rem;padding:2rem 0}
.quiz-choice{
  position:relative;display:flex;align-items:center;gap:1rem;min-height:76px;
  background:var(--paper);border:1.5px dashed var(--card-bd, var(--border2));border-radius:16px;
  padding:1.15rem 1.4rem;text-decoration:none;color:var(--text);
  box-shadow:0 5px 14px rgba(47,42,32,.07);
  transition:transform .18s,box-shadow .18s,background .18s;
}
.quiz-choice::before{
  content:'';position:absolute;left:0;top:.9rem;bottom:.9rem;width:5px;border-radius:4px;
  background:var(--card-fg, var(--gold));
}
.quiz-choice:hover,.quiz-choice:focus-visible{
  transform:translateY(-3px) rotate(-.3deg);
  box-shadow:0 12px 26px rgba(47,42,32,.14);
  background:var(--card-bg, #fff);
}
.quiz-choice:focus-visible{outline:3px solid var(--gold);outline-offset:2px}
.quiz-choice-mark{
  flex-shrink:0;width:2.3rem;height:2.3rem;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  background:var(--card-fg, var(--gold));border:2px solid var(--paper);
  box-shadow:0 0 0 2px var(--card-fg, var(--gold));
  font-family:var(--ff-mono);font-size:.78rem;font-weight:500;color:#fff;
}
.quiz-choice-text{font-size:.94rem;line-height:1.6;font-weight:500;padding-left:.2rem}
.mock-note{margin-top:2rem;padding:1rem 1.2rem;background:var(--paper);border:1px dashed var(--border2);border-radius:10px;font-size:.78rem;color:var(--muted);font-family:var(--ff-mono);line-height:1.7}
@media(max-width:600px){
  .quiz-hero{padding:.5rem .5rem 1.5rem}
}
</style>
</head>
<body>
<div class="mock-badge">DESIGN MOCKUP — 案C：ペーパー／カード型（noindex／本番非公開）</div>
<div class="wrap quiz-wrap" style="margin-top:2rem">

  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $quizNumberStr ?></span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p class="quiz-lead"><?= nl2br(htmlspecialchars($quiz['lead'], ENT_QUOTES, 'UTF-8')) ?></p>
  </section>

  <section class="quiz-choices">
    <?php foreach (['a1','a2','a3','a4'] as $_k): $c = $accentMap[$_k]; ?>
    <a href="result.php?a=<?= $_k ?>" class="quiz-choice" style="--card-fg:<?= $c['fg'] ?>;--card-bg:<?= $c['bg'] ?>;--card-bd:<?= $c['bd'] ?>">
      <span class="quiz-choice-mark"><?= strtoupper($_k) ?></span>
      <span class="quiz-choice-text"><?= htmlspecialchars($quiz['choices'][$_k], ENT_QUOTES, 'UTF-8') ?></span>
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
