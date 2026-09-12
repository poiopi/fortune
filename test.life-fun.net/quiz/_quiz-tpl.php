<?php
declare(strict_types=1);
// ①問題ページ・②回答ページ 共通テンプレート
// 呼び出し元で以下を定義してからrequireすること：
//   $quiz      : <slug>/data.php が return する配列
//   $quizStep  : 'question'（①）または 'result'（②）
//   $quizChoice: $quizStep==='result' のときのみ、'a1'〜'a4' のいずれか

if (!isset($quiz) || !isset($quizStep)) {
    http_response_code(500);
    exit('quiz template: missing required variables');
}

$_isResult   = ($quizStep === 'result');
$_numberStr  = str_pad((string)$quiz['number'], 3, '0', STR_PAD_LEFT);
$_canonical  = 'https://life-fun.net/quiz/' . $quiz['slug'] . '/';
if ($_isResult) {
    $_canonical = 'https://life-fun.net/quiz/' . $quiz['slug'] . '/kekka/?a=' . $quizChoice;
}
$_ogImage = 'https://life-fun.net/favicon.png';

$currentPage = $quiz['slug'];
$currentSlug = $quiz['slug'];
$pageType    = 'quiz';
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
<?php if ($_isResult): ?>
<meta name="robots" content="noindex, follow">
<?php endif; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= htmlspecialchars($quiz['description'], ENT_QUOTES, 'UTF-8') ?>">
<title><?= htmlspecialchars($quiz['title'], ENT_QUOTES, 'UTF-8') ?></title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<meta property="og:type" content="website">
<meta property="og:url" content="<?= htmlspecialchars($_canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:title" content="<?= htmlspecialchars($quiz['title'], ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($quiz['description'], ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="<?= htmlspecialchars($_ogImage, ENT_QUOTES, 'UTF-8') ?>">

<!-- AdSense -->
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
.wrap{position:relative;z-index:1;max-width:700px;margin:0 auto;padding:0 1.2rem}
.quiz-wrap{padding-bottom:2rem}
.quiz-hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border)}
.quiz-eyebrow{font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1.2rem;display:block}
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.4;letter-spacing:.04em;color:var(--text);margin-bottom:1rem}
.quiz-lead{color:var(--muted);font-size:.9rem;line-height:1.9}
.quiz-choices{display:flex;flex-direction:column;gap:.9rem;padding:2rem 0}
.quiz-choice{
  display:flex;align-items:center;gap:1rem;
  background:var(--card);border:1px solid var(--border2);border-radius:14px;
  padding:1.1rem 1.3rem;text-decoration:none;color:var(--text);
  transition:border-color .2s,transform .15s,background .2s;
}
.quiz-choice:hover{border-color:var(--violet);transform:translateY(-2px);background:var(--surface)}
.quiz-choice-mark{
  flex-shrink:0;width:2.2rem;height:2.2rem;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,var(--violet),var(--rose));
  font-family:var(--ff-mono);font-size:.8rem;font-weight:400;color:#fff;
}
.quiz-choice-text{font-size:.92rem;line-height:1.6}
.quiz-result-block,.quiz-kaisetsu-block{
  background:var(--card);border:1px solid var(--border2);border-radius:16px;
  padding:1.8rem;margin:2rem 0;
}
.quiz-your-choice{
  font-family:var(--ff-mono);font-size:.78rem;color:var(--gold-lt);
  letter-spacing:.04em;margin-bottom:1.1rem;padding-bottom:1rem;
  border-bottom:1px solid var(--border);
}
.quiz-kaisetsu-intro{
  font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;
  color:var(--gold-lt);margin-bottom:1rem;
}
.quiz-result-text,.quiz-kaisetsu-text{font-size:.92rem;line-height:2;color:var(--text)}
.quiz-btn-primary{
  display:inline-block;margin-top:1.5rem;padding:.8rem 1.8rem;
  background:linear-gradient(135deg,var(--violet) 0%,var(--rose) 100%);
  color:#fff;border-radius:10px;text-decoration:none;
  font-family:var(--ff-serif);font-weight:600;font-size:.9rem;letter-spacing:.06em;
  box-shadow:0 4px 20px rgba(155,114,239,.35);transition:opacity .2s,transform .15s;
}
.quiz-btn-primary:hover{opacity:.9;transform:translateY(-1px)}
.quiz-cta-wrap{margin:2rem 0}
.quiz-back-to-hub{text-align:center;margin:1.5rem 0 0}
.quiz-back-to-hub a{
  font-family:var(--ff-mono);font-size:.75rem;color:var(--muted);
  text-decoration:none;letter-spacing:.06em;transition:color .2s;
}
.quiz-back-to-hub a:hover{color:var(--violet-lt)}
.article-cta{
  background:var(--surface);border:1px solid var(--border2);border-radius:14px;
  padding:1.3rem 1.5rem;display:flex;flex-direction:column;gap:.8rem;
  align-items:center;text-align:center;
}
.article-cta-text p{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)}
.article-cta-text small{display:block;margin-top:.3rem;font-size:.78rem;color:var(--muted)}
.article-cta-btn{
  display:inline-block;padding:.7rem 1.6rem;border-radius:10px;
  background:linear-gradient(135deg,var(--gold) 0%,var(--violet) 100%);
  color:#fff;text-decoration:none;font-family:var(--ff-serif);font-weight:600;
  font-size:.85rem;letter-spacing:.05em;transition:opacity .2s;
}
.article-cta-btn:hover{opacity:.88}
@media(max-width:600px){
  .quiz-hero{padding:2.2rem .5rem 1.5rem}
  .quiz-result-block,.quiz-kaisetsu-block{padding:1.3rem 1.1rem}
}
</style>
</head>
<body>
<?php require __DIR__.'/../inc/header.php'; ?>
<div class="wrap quiz-wrap">

  <?php if (!$_isResult): ?>
  <!-- ① 問題ページ -->
  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $_numberStr ?></span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p class="quiz-lead"><?= nl2br(htmlspecialchars($quiz['lead'], ENT_QUOTES, 'UTF-8')) ?></p>
  </section>

  <section class="quiz-choices">
    <?php foreach (['a1','a2','a3','a4'] as $_k): ?>
    <a href="/quiz/<?= htmlspecialchars($quiz['slug']) ?>/kekka/?a=<?= $_k ?>" class="quiz-choice" onclick="return quizAnswer(this,'<?= $_k ?>')">
      <span class="quiz-choice-mark"><?= strtoupper($_k) ?></span>
      <span class="quiz-choice-text"><?= htmlspecialchars($quiz['choices'][$_k], ENT_QUOTES, 'UTF-8') ?></span>
    </a>
    <?php endforeach; ?>
  </section>

  <script>
  function quizAnswer(el, choice){
    if (typeof trackEvent === 'function') { trackEvent('quiz_answer', {choice: choice}); }
    var href = el.getAttribute('href');
    setTimeout(function(){ window.location.href = href; }, 100);
    return false;
  }
  </script>

  <?php else: ?>
  <!-- ② 回答結果ページ -->
  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $_numberStr ?> · 結果</span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
  </section>

  <section class="quiz-result-block">
    <p class="quiz-your-choice">あなたが選んだのは「<?= htmlspecialchars($quiz['choices'][$quizChoice], ENT_QUOTES, 'UTF-8') ?>」</p>
    <?php if (($quiz['series'] ?? null) === 'B'): ?>
    <p class="quiz-kaisetsu-intro"><?= htmlspecialchars($quiz['explanation_intro'][$quizChoice], ENT_QUOTES, 'UTF-8') ?></p>
    <?php elseif (!empty($quiz['results'][$quizChoice])): ?>
    <p class="quiz-result-text"><?= nl2br(htmlspecialchars($quiz['results'][$quizChoice], ENT_QUOTES, 'UTF-8')) ?></p>
    <?php endif; ?>
    <a href="/quiz/<?= htmlspecialchars($quiz['slug']) ?>/kaisetsu/?a=<?= $quizChoice ?>" class="quiz-btn-primary">解説を見る →</a>
  </section>

  <?php require __DIR__ . '/../inc/share-btns.php'; ?>
  <?php endif; ?>

</div>
<?php require __DIR__.'/../inc/footer.php'; ?>
</body>
</html>
