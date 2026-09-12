<?php
declare(strict_types=1);

// Daily Quiz 一覧・アーカイブハブ
$_quizSlugs = [
    'hatsutaimen-saisho-ni-miru-mono',
    'yotei-no-nai-kyuujitsu',
    'erabu-toki-saisho-ni-kininaru',
    'junishi-nihon-ni-inai-doubutsu',
    'doyo-no-ushi-unagi',
    'omikuji-junban',
];

$_quizzes = [];
foreach ($_quizSlugs as $_slug) {
    $_quizzes[] = require __DIR__ . '/' . $_slug . '/data.php';
}

// number降順（新しい順）
usort($_quizzes, fn($a, $b) => $b['number'] <=> $a['number']);

$currentPage = 'quiz';
$currentSlug = 'quiz';
$pageType    = 'quiz';

$_canonical = 'https://life-fun.net/quiz/';
$_title       = 'Daily Quiz一覧｜占いPortal';
$_description = '毎回4択で楽しむDaily Quiz一覧。気づき系のミニクイズと、雑学系のクイズを配信しています。';
$_ogImage = 'https://life-fun.net/favicon.png';
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
<link rel="canonical" href="<?= htmlspecialchars($_canonical, ENT_QUOTES, 'UTF-8') ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= htmlspecialchars($_description, ENT_QUOTES, 'UTF-8') ?>">
<title><?= htmlspecialchars($_title, ENT_QUOTES, 'UTF-8') ?></title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<meta property="og:type" content="website">
<meta property="og:url" content="<?= htmlspecialchars($_canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:title" content="<?= htmlspecialchars($_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($_description, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="<?= htmlspecialchars($_ogImage, ENT_QUOTES, 'UTF-8') ?>">

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #08060f;
  --deep:    #0f0b1e;
  --surface: #16112b;
  --card:    #1e1738;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.35);
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
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh;overflow-x:hidden}
body::before{
  content:'';position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%, rgba(90,50,180,.25) 0%, transparent 50%),
    radial-gradient(ellipse at 80% 80%, rgba(180,50,100,.15) 0%, transparent 50%),
    radial-gradient(ellipse at 50% 50%, rgba(30,20,60,.8) 0%, transparent 100%);
  pointer-events:none;z-index:0;
}
.wrap{position:relative;z-index:1;max-width:760px;margin:0 auto;padding:0 1.2rem}
.quiz-hub-hero{text-align:center;padding:3rem 1rem 2.2rem;border-bottom:1px solid var(--border)}
.quiz-hub-eyebrow{font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1.2rem;display:block}
.quiz-hub-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,5vw,2.2rem);font-weight:700;line-height:1.4;letter-spacing:.04em;color:var(--text);margin-bottom:1rem}
.quiz-hub-sub{color:var(--muted);font-size:.88rem;line-height:1.9}
.quiz-hub-list{display:flex;flex-direction:column;gap:1rem;padding:2.2rem 0}
.quiz-hub-card{
  display:block;background:var(--card);border:1px solid var(--border2);border-radius:14px;
  padding:1.3rem 1.5rem;text-decoration:none;color:var(--text);
  transition:border-color .2s,transform .15s,background .2s;
}
.quiz-hub-card:hover{border-color:var(--violet);transform:translateY(-2px);background:var(--surface)}
.quiz-hub-card-head{display:flex;align-items:center;gap:.7rem;margin-bottom:.6rem}
.quiz-hub-badge{
  font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.1em;
  padding:.2rem .6rem;border-radius:20px;flex-shrink:0;
}
.quiz-hub-badge-a{background:rgba(78,205,196,.12);color:var(--teal);border:1px solid rgba(78,205,196,.3)}
.quiz-hub-badge-b{background:rgba(201,168,76,.12);color:var(--gold-lt);border:1px solid rgba(201,168,76,.3)}
.quiz-hub-number{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);letter-spacing:.05em}
.quiz-hub-question{font-family:var(--ff-serif);font-size:1rem;font-weight:600;line-height:1.6}
@media(max-width:600px){
  .quiz-hub-hero{padding:2.2rem .5rem 1.6rem}
  .quiz-hub-card{padding:1.1rem 1.2rem}
}
</style>
</head>
<body>
<?php require __DIR__.'/../inc/header.php'; ?>
<div class="wrap">

  <section class="quiz-hub-hero">
    <span class="quiz-hub-eyebrow">Daily Quiz</span>
    <h1>今日の4択クイズ一覧</h1>
    <p class="quiz-hub-sub">気軽に楽しめる4択クイズを配信しています。答えを選んで、解説まで読んでみてください。</p>
  </section>

  <section class="quiz-hub-list">
    <?php foreach ($_quizzes as $_q): ?>
    <a href="/quiz/<?= htmlspecialchars($_q['slug']) ?>/" class="quiz-hub-card">
      <div class="quiz-hub-card-head">
        <span class="quiz-hub-badge quiz-hub-badge-<?= strtolower($_q['series']) ?>"><?= htmlspecialchars($_q['series']) ?></span>
        <span class="quiz-hub-number">Daily Quiz #<?= str_pad((string)$_q['number'], 3, '0', STR_PAD_LEFT) ?></span>
      </div>
      <p class="quiz-hub-question"><?= htmlspecialchars($_q['question'], ENT_QUOTES, 'UTF-8') ?></p>
    </a>
    <?php endforeach; ?>
  </section>

</div>
<?php require __DIR__.'/../inc/footer.php'; ?>
</body>
</html>
