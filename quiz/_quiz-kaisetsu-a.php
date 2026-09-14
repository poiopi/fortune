<?php
declare(strict_types=1);
// ③解説ページ A系統専用テンプレート（常にnoindex）
// 呼び出し元で以下を定義してからrequireすること：
//   $quiz       : <slug>/data.php が return する配列（series==='A'）
//   $quizChoice : 'a1'〜'a4' のいずれか（バリデーション済み）

if (!isset($quiz) || !isset($quizChoice)) {
    http_response_code(500);
    exit('quiz kaisetsu-a template: missing required variables');
}

$_numberStr = str_pad((string)$quiz['number'], 3, '0', STR_PAD_LEFT);
$_canonical = 'https://life-fun.net/quiz/' . $quiz['slug'] . '/kaisetsu/?a=' . $quizChoice;
$_ogImage   = 'https://life-fun.net/favicon.png';

$currentPage = $quiz['slug'];
$currentSlug = $quiz['slug'];
$pageType    = 'quiz';

$ctaTitle = 'あわせてどうぞ';
$ctaText  = null;
$ctaUrl   = $quiz['cta_url'];
$ctaBtn   = $quiz['cta_label'];

// 4択の丸バッジに割り当てる控えめなアクセントカラー（確定デザイン：a-plus案より）
$_accentMap = [
    'a1' => '#c1616a',
    'a2' => '#3f7fa6',
    'a3' => '#3f9c74',
    'a4' => '#b8863a',
];
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
<meta name="robots" content="noindex, follow">
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
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  /* ── 確定デザイン（a-plus案）：ライト・マガジン型 ── */
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
  /* ── inc/header.php・inc/footer.php・inc/nav-cards.php（共通コンポーネント）が
     参照する変数名との互換のためのエイリアス。共通コンポーネント本体は変更しないため、
     これらの変数名はそのまま維持し、値のみ確定デザインの配色に合わせている。 ── */
  --gold:    var(--accent);
  --gold-lt: #e8c96a;
  --violet:  var(--accent2);
  --card2:   var(--tint);
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:var(--ff-sans);font-weight:400;line-height:1.8;min-height:100vh}
.wrap{max-width:700px;margin:0 auto;padding:0 1.2rem}
.quiz-wrap{padding-bottom:2rem}
.quiz-hero{text-align:center;padding:2.6rem 1rem 2rem;border-bottom:2px solid var(--border)}
.quiz-eyebrow{
  font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.25em;color:var(--accent-dk);
  text-transform:uppercase;margin-bottom:1.2rem;display:inline-block;
  padding:.3rem .9rem;border:1px solid var(--border2);border-radius:20px;background:var(--tint);
}
.quiz-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,5vw,2rem);font-weight:700;line-height:1.5;letter-spacing:.03em;color:var(--text);margin-top:1rem;margin-bottom:1rem}
.quiz-lead{color:var(--muted);font-size:.92rem;line-height:1.9}
.quiz-result-block,.quiz-kaisetsu-block{
  background:var(--card);border:1.5px solid var(--border2);border-radius:18px;
  padding:1.9rem;margin:2rem 0;box-shadow:0 4px 16px rgba(43,38,32,.06);
}
.quiz-your-choice{
  display:flex;align-items:center;gap:.6rem;
  font-family:var(--ff-mono);font-size:.8rem;color:var(--accent-dk);
  letter-spacing:.02em;margin-bottom:1.2rem;padding-bottom:1rem;
  border-bottom:1px dashed var(--border2);
}
.quiz-your-choice-mark{
  flex-shrink:0;width:1.6rem;height:1.6rem;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-family:var(--ff-mono);font-size:.68rem;font-weight:500;
}
.quiz-your-choice b{color:var(--accent2);font-weight:700}
.quiz-kaisetsu-intro{
  font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;
  color:var(--accent-dk);margin-bottom:1rem;
}
.quiz-result-text,.quiz-kaisetsu-text{font-size:.95rem;line-height:2;color:var(--text)}
.quiz-btn-primary{
  display:inline-block;margin-top:1.6rem;padding:.85rem 1.9rem;
  background:linear-gradient(135deg,var(--accent) 0%,var(--accent2) 100%);
  color:#fff;border-radius:24px;text-decoration:none;
  font-family:var(--ff-serif);font-weight:600;font-size:.9rem;letter-spacing:.06em;
  box-shadow:0 6px 18px rgba(184,134,58,.3);transition:opacity .2s,transform .15s;
}
.quiz-btn-primary:hover{opacity:.9;transform:translateY(-1px)}
.quiz-cta-wrap{margin:2rem 0}
.quiz-back-to-hub{text-align:center;margin:1.5rem 0 0}
.quiz-back-to-hub a{
  font-family:var(--ff-mono);font-size:.75rem;color:var(--muted);
  text-decoration:none;letter-spacing:.06em;transition:color .2s;
}
.quiz-back-to-hub a:hover{color:var(--accent-dk)}
.article-cta{
  background:var(--surface);border:1px solid var(--border2);border-radius:14px;
  padding:1.3rem 1.5rem;display:flex;flex-direction:column;gap:.8rem;
  align-items:center;text-align:center;
}
.article-cta-text p{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)}
.article-cta-text small{display:block;margin-top:.3rem;font-size:.78rem;color:var(--muted)}
.article-cta-btn{
  display:inline-block;padding:.7rem 1.6rem;border-radius:10px;
  background:linear-gradient(135deg,var(--accent) 0%,var(--accent2) 100%);
  color:#fff;text-decoration:none;font-family:var(--ff-serif);font-weight:600;
  font-size:.85rem;letter-spacing:.05em;transition:opacity .2s;
}
.article-cta-btn:hover{opacity:.88}
.quiz-ad-slot{
  margin:2rem 0 0;padding:1.2rem 1rem;
  background:var(--surface);border:1px dashed var(--border2);border-radius:14px;
  text-align:center;
}
.quiz-ad-label{
  font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.15em;color:var(--muted);
  text-transform:uppercase;margin-bottom:.8rem;
}
@media(max-width:600px){
  .quiz-hero{padding:1.6rem .5rem 1.5rem}
  .quiz-result-block,.quiz-kaisetsu-block{padding:1.3rem 1.1rem}
  .quiz-ad-slot{padding:1rem .7rem}
}
</style>
</head>
<body>
<?php require __DIR__.'/../inc/header.php'; ?>
<div class="wrap quiz-wrap">

  <section class="quiz-hero">
    <span class="quiz-eyebrow">Daily Quiz #<?= $_numberStr ?> · 解説</span>
    <h1><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></h1>
  </section>

  <section class="quiz-kaisetsu-block">
    <p class="quiz-your-choice">
      <span class="quiz-your-choice-mark" style="background:<?= $_accentMap[$quizChoice] ?>"><?= strtoupper($quizChoice) ?></span>
      あなたが選んだのは「<b><?= htmlspecialchars($quiz['choices'][$quizChoice], ENT_QUOTES, 'UTF-8') ?></b>」でした。
    </p>
    <p class="quiz-kaisetsu-text"><?= nl2br(htmlspecialchars($quiz['explanations'][$quizChoice], ENT_QUOTES, 'UTF-8')) ?></p>
  </section>

  <div class="quiz-cta-wrap">
    <?php require __DIR__.'/../inc/article-cta.php'; ?>
  </div>

  <div class="quiz-back-to-hub">
    <a href="/quiz/">← 過去のDaily Quiz一覧</a>
  </div>

  <?php require __DIR__ . '/../inc/share-btns.php'; ?>

  <?php if (!empty($quiz['ad_enabled'])): ?>
  <?php require __DIR__ . '/../inc/quiz-ad-slot.php'; ?>
  <?php endif; ?>

</div>
<?php require __DIR__.'/../inc/footer.php'; ?>
</body>
</html>
