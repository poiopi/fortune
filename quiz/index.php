<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/site.php';

// みつぼしの4択 一覧（旧名 Daily Quiz。URL は /quiz/ のまま）
// 一覧に載せるクイズは quiz/_list.php がフォルダから集める（data.php に 'listed' => true があるものだけ）
require_once __DIR__ . '/_list.php';
$_quizzes = quiz_all_listed();

// 区分の表示名と説明は quiz/_list.php の quiz_theme_labels()
$_genres = quiz_theme_labels();

// この時季：今月か来月が season に入っているもの（サーバーの日付で決まる）
$_m1 = (int) date('n');
$_m2 = $_m1 === 12 ? 1 : $_m1 + 1;
$_seasonList = array_values(array_filter($_quizzes, fn($q) => array_intersect([$_m1, $_m2], $q['season'] ?? []) !== []));

$_card = function (array $q) use ($_genres): string {
    $isB   = ($q['series'] ?? '') === 'B';
    $type  = $isB ? '正解はどれ？' : 'あなたはどれ？';
    $genre = '<span class="quiz-hub-genre">' . htmlspecialchars($_genres[$q['themes'][0] ?? '']['label'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>';
    return '<a href="/quiz/' . htmlspecialchars($q['slug'], ENT_QUOTES, 'UTF-8') . '/" class="quiz-hub-card">'
        . '<div class="quiz-hub-card-head"><span class="quiz-hub-type quiz-hub-type-' . ($isB ? 'b' : 'a') . '">' . $type . '</span>' . $genre
        . '<span class="quiz-hub-number">No.' . str_pad((string) $q['number'], 3, '0', STR_PAD_LEFT) . '</span></div>'
        . '<p class="quiz-hub-question">' . htmlspecialchars($q['question'], ENT_QUOTES, 'UTF-8') . '</p></a>';
};

$currentPage = 'quiz';
$currentSlug = 'quiz';
$pageType    = 'quiz';

$_canonical = 'https://life-fun.net/quiz/';
$_title       = 'みつぼしの4択｜暦と星の豆知識、「あなたはどれ？」の問い'.site_title_suffix(TITLE_SEP.SITE_NAME);
$_description = '4つの中から1つ選ぶだけ。タロット・暦・干支・星座の豆知識を当てる問いと、正解のない「あなたはどれ？」の問いを集めました。答えを選ぶと解説を読めます。';
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
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
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
.wrap{position:relative;z-index:1;max-width:920px;margin:0 auto;padding:0 1.2rem}
.quiz-hub-hero{text-align:center;padding:2.6rem 1rem 1.6rem}
.quiz-hub-hero h1{font-family:var(--ff-serif);font-size:clamp(1.6rem,5vw,2.3rem);font-weight:700;line-height:1.4;letter-spacing:.06em;color:var(--text)}
.quiz-hub-sub{color:var(--muted);font-size:.88rem;line-height:1.9;margin:.8rem auto 0;max-width:34em}
/* 区分へ飛ぶボタン：ヘッダー（高さ56px・sticky）の下に固定 */
.quiz-hub-nav{position:sticky;top:56px;z-index:50;margin:0 -1.2rem;padding:.7rem 1.2rem;background:transparent;border-bottom:1px solid transparent;transition:background .2s,border-color .2s}
/* 上に固定されたときだけ色を付ける（is-stuck は下の script で付け外し） */
.quiz-hub-nav-sentinel{height:1px}
.quiz-hub-nav.is-stuck{background:rgba(8,6,15,.92);-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);border-bottom-color:var(--border)}
.quiz-hub-nav-list{display:flex;gap:.5rem;flex-wrap:wrap;justify-content:center;list-style:none}
.quiz-hub-nav a{display:block;font-size:.8rem;color:var(--text);text-decoration:none;border:1px solid var(--border2);border-radius:999px;padding:.35rem .9rem;background:rgba(30,23,56,.6);white-space:nowrap;transition:border-color .2s}
.quiz-hub-nav a:hover{border-color:var(--violet)}
.quiz-hub-nav li:first-child a{border-color:rgba(201,168,76,.6);color:var(--gold-lt)}
.quiz-hub-sec{padding:1.8rem 0 .4rem;scroll-margin-top:120px}
.quiz-hub-cat{display:flex;align-items:baseline;gap:.8rem;font-family:var(--ff-serif);font-size:1.15rem;font-weight:600;letter-spacing:.05em}
.quiz-hub-cat::after{content:'';flex:1;height:1px;background:var(--border2);order:1}
.quiz-hub-cat small{font-family:var(--ff-sans);font-size:.75rem;color:var(--muted);font-weight:300;order:2}
.quiz-hub-sec-desc{font-size:.8rem;color:var(--muted);margin:.3rem 0 .9rem}
.quiz-hub-season .quiz-hub-cat span{color:var(--gold-lt)}
.quiz-hub-season .quiz-hub-grid{margin-top:.9rem}
.quiz-hub-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.7rem}
.quiz-hub-card{display:block;background:var(--card);border:1px solid var(--border2);border-radius:12px;padding:.85rem 1.1rem;text-decoration:none;color:var(--text);transition:border-color .2s,background .2s}
.quiz-hub-card:hover{border-color:var(--violet);background:var(--surface)}
.quiz-hub-card-head{display:flex;align-items:center;gap:.5rem;margin-bottom:.35rem;font-size:.7rem}
.quiz-hub-type{padding:.08rem .55rem;border-radius:20px;font-weight:400;flex-shrink:0}
.quiz-hub-type-a{background:rgba(78,205,196,.12);color:var(--teal);border:1px solid rgba(78,205,196,.3)}
.quiz-hub-type-b{background:rgba(201,168,76,.12);color:var(--gold-lt);border:1px solid rgba(201,168,76,.3)}
.quiz-hub-genre{color:var(--violet-lt)}
.quiz-hub-number{margin-left:auto;font-family:var(--ff-mono);color:var(--muted);font-size:.65rem}
.quiz-hub-question{font-family:var(--ff-serif);font-size:.98rem;font-weight:600;line-height:1.6}
.breadcrumb{font-size:.72rem;color:var(--muted);padding:1rem 0 0;font-family:var(--ff-mono);letter-spacing:.04em}
.breadcrumb a{color:var(--muted);text-decoration:none}
.breadcrumb a:hover{color:var(--gold)}
.breadcrumb span{margin:0 .4rem}
@media(max-width:600px){
  .quiz-hub-hero{padding:1.8rem .5rem 1.2rem}
  /* スマホ：ボタンは横1列でスクロール。右端を薄く消して、続きがあることを示す */
  .quiz-hub-nav-list{flex-wrap:nowrap;justify-content:flex-start;overflow-x:auto;scrollbar-width:none;padding-right:2.5rem;
    -webkit-mask-image:linear-gradient(to right,#000 calc(100% - 3rem),transparent);mask-image:linear-gradient(to right,#000 calc(100% - 3rem),transparent)}
  .quiz-hub-nav-list::-webkit-scrollbar{display:none}
  .quiz-hub-grid{gap:.5rem}
  .quiz-hub-card{padding:.8rem .9rem}
  .quiz-hub-card-head{flex-wrap:wrap;gap:.3rem}
  .quiz-hub-question{font-size:.88rem}
}
</style>
</head>
<body>
<?php require __DIR__.'/../inc/header.php'; ?>
<div class="wrap">
  <?php $bcPath = '/quiz/'; $bcName = 'みつぼしの4択'; require __DIR__.'/../inc/breadcrumb.php'; ?>

  <section class="quiz-hub-hero">
    <h1>みつぼしの4択</h1>
    <p class="quiz-hub-sub">4つの中から1つ選ぶだけ。暦や星の豆知識を当てる問いと、正解のない「あなたはどれ？」の問いがあります。答えを選ぶと、その答えに合わせた解説を読めます。</p>
  </section>

  <div class="quiz-hub-nav-sentinel" aria-hidden="true"></div>
  <nav class="quiz-hub-nav" aria-label="区分へ移動">
    <ul class="quiz-hub-nav-list">
      <?php if ($_seasonList !== []): ?><li><a href="#season">この時季</a></li><?php endif; ?>
      <?php foreach ($_genres as $_gk => $_g): ?><li><a href="#<?= $_gk ?>"><?= htmlspecialchars($_g['label'], ENT_QUOTES, 'UTF-8') ?></a></li><?php endforeach; ?>
    </ul>
  </nav>

  <?php if ($_seasonList !== []): ?>
  <section class="quiz-hub-sec quiz-hub-season" id="season">
    <h2 class="quiz-hub-cat"><span>この時季の4択</span><small><?= $_m1 ?>月・<?= $_m2 ?>月</small></h2>
    <div class="quiz-hub-grid">
      <?php foreach ($_seasonList as $_q) echo $_card($_q); ?>
    </div>
  </section>
  <?php endif; ?>

  <?php foreach ($_genres as $_gk => $_g):
      $_list = array_values(array_filter($_quizzes, fn($q) => in_array($_gk, $q['themes'] ?? [], true)));
      if ($_list === []) continue; ?>
  <section class="quiz-hub-sec" id="<?= $_gk ?>">
    <h2 class="quiz-hub-cat"><span><?= htmlspecialchars($_g['label'], ENT_QUOTES, 'UTF-8') ?></span><small><?= count($_list) ?>問</small></h2>
    <p class="quiz-hub-sec-desc"><?= htmlspecialchars($_g['desc'], ENT_QUOTES, 'UTF-8') ?></p>
    <div class="quiz-hub-grid">
      <?php foreach ($_list as $_q) echo $_card($_q); ?>
    </div>
  </section>
  <?php endforeach; ?>
</div>

<script>
// 区分ボタンの帯が上に固定されたら is-stuck を付ける（目印の要素がヘッダーの下に隠れたら固定中）
(function () {
  var nav = document.querySelector('.quiz-hub-nav');
  var mark = document.querySelector('.quiz-hub-nav-sentinel');
  if (!nav || !mark || !('IntersectionObserver' in window)) return;
  new IntersectionObserver(function (entries) {
    nav.classList.toggle('is-stuck', !entries[0].isIntersecting && entries[0].boundingClientRect.top < 57);
  }, { rootMargin: '-57px 0px 0px 0px', threshold: 0 }).observe(mark);
})();
</script>
<?php require __DIR__.'/../inc/footer.php'; ?>
</body>
</html>
