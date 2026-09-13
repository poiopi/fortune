<?php
declare(strict_types=1);
// 【比較モックアップ／案A：ライト・マガジン型】① 問題ページ
// 本番テンプレート(_quiz-tpl.php)とは独立。sitemap.xml等の変更を伴わない。
require __DIR__ . '/../_bootstrap.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>【モックアップ案A】<?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></title>

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
  --accent:  #b8863a;   /* マスタード系（従来のgoldを明所用に濃く調整） */
  --accent-dk:#8f6626;
  --accent2: #c14f68;   /* ローズ系（明所用に彩度・濃度を調整） */
  --tint:    #fbf1e2;   /* ホバー時の淡いアクセント背景 */
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
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.5;letter-spacing:.03em;color:var(--text);margin-top:1rem;margin-bottom:1rem}
.quiz-lead{color:var(--muted);font-size:.92rem;line-height:1.9}
.quiz-choices{display:grid;grid-template-columns:1fr;gap:.9rem;padding:2rem 0}
@media(min-width:560px){.quiz-choices{grid-template-columns:1fr 1fr}}
.quiz-choice{
  display:flex;align-items:center;gap:1rem;min-height:72px;
  background:var(--card);border:1.5px solid var(--border);border-radius:16px;
  padding:1.1rem 1.3rem;text-decoration:none;color:var(--text);
  box-shadow:0 1px 3px rgba(43,38,32,.05);
  transition:border-color .18s,transform .15s,background .18s,box-shadow .18s;
}
.quiz-choice:hover,.quiz-choice:focus-visible{
  border-color:var(--accent);background:var(--tint);
  transform:translateY(-3px);box-shadow:0 8px 20px rgba(184,134,58,.18);
}
.quiz-choice:focus-visible{outline:3px solid var(--accent2);outline-offset:2px}
.quiz-choice-mark{
  flex-shrink:0;width:2.3rem;height:2.3rem;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,var(--accent),var(--accent2));
  font-family:var(--ff-mono);font-size:.8rem;font-weight:500;color:#fff;
}
.quiz-choice-text{font-size:.94rem;line-height:1.6;font-weight:500}
.quiz-choice-arrow{margin-left:auto;flex-shrink:0;color:var(--border2);font-size:1rem;transition:color .18s,transform .18s}
.quiz-choice:hover .quiz-choice-arrow{color:var(--accent2);transform:translateX(3px)}
.mock-note{margin-top:2rem;padding:1rem 1.2rem;background:#fff;border:1px dashed var(--border2);border-radius:10px;font-size:.78rem;color:var(--muted);font-family:var(--ff-mono);line-height:1.7}
.mock-note a{color:var(--accent-dk)}
@media(max-width:600px){
  .quiz-hero{padding:.5rem .5rem 1.5rem}
}
</style>
</head>
<body>
<div class="mock-badge">DESIGN MOCKUP — 案A：ライト・マガジン型（noindex／本番非公開）</div>
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
