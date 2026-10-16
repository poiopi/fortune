<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/auto-link.php';

$_CATEGORIES = [
  ['slug'=>'guide', 'name'=>'使い方ガイド', 'icon'=>'📖', 'kw'=>'診断結果の読み方・Style/Tendency/Bundle/Primitiveの意味（6記事）'],
  ['slug'=>'mbti', 'name'=>'MBTI×恋愛', 'icon'=>'🧠', 'kw'=>'16タイプ別の恋愛傾向（16記事）'],
  ['slug'=>'style', 'name'=>'恋愛スタイル（Style）', 'icon'=>'💫', 'kw'=>'積極性・愛情表現など7指標（7記事）'],
  ['slug'=>'tendency', 'name'=>'推定傾向（Tendency）', 'icon'=>'💍', 'kw'=>'結婚志向・浮気耐性（2記事）'],
  ['slug'=>'seiza', 'name'=>'星座×恋愛', 'icon'=>'⭐', 'kw'=>'12星座別の恋愛傾向（12記事）'],
  ['slug'=>'blood', 'name'=>'血液型×恋愛', 'icon'=>'🩸', 'kw'=>'A・B・O・AB型別の恋愛傾向（4記事）'],
  ['slug'=>'bundle', 'name'=>'恋愛タイプ（Bundle）', 'icon'=>'💜', 'kw'=>'5つの恋愛タイプの分類ロジック（5記事）'],
  ['slug'=>'mbti-blood', 'name'=>'MBTI×血液型', 'icon'=>'🔀', 'kw'=>'64通りの組み合わせをどちらが優勢か分析（1/64記事・公開中）'],
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MBTI×血液型×星座で診断する恋愛傾向診断（Love Engine）の解説記事一覧。使い方ガイド・MBTI・恋愛スタイル・推定傾向・星座・血液型・恋愛タイプ・組み合わせ分析をカテゴリ別に掲載。">
  <title>恋愛傾向診断×解説記事一覧｜Love Engineをやさしく解説</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/article-components.css">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{
    --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
    --accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;
    --text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f8f7fc;
  }
  html{font-size:16px;scroll-behavior:smooth}
  body{background:var(--bg);color:var(--text);font-family:var(--ff-sans);font-weight:400;line-height:1.85}
  .wrap{max-width:860px;margin:0 auto;padding:0 1.2rem}
  .breadcrumb{font-size:.72rem;color:var(--muted);padding:1rem 0 0;font-family:var(--ff-mono);letter-spacing:.04em}
  .breadcrumb a{color:var(--muted);text-decoration:none}
  .breadcrumb a:hover{color:var(--accent)}
  .breadcrumb span{margin:0 .4rem}
  .art-hero{padding:2rem 0 1.5rem;border-bottom:1px solid var(--border)}
  .art-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}
  .art-section{padding:2.5rem 0}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .cat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:.9rem;margin-top:1rem}
  .cat-card{background:#fff;border:1px solid var(--border);border-radius:14px;padding:1.25rem;transition:border-color .2s,transform .15s;text-decoration:none;display:block}
  .cat-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .cat-icon{font-size:1.6rem;line-height:1;margin-bottom:.6rem;display:block}
  .cat-name{font-family:var(--ff-serif);font-weight:700;color:var(--text);font-size:1.05rem;margin-bottom:.4rem}
  .cat-kw{font-size:.78rem;color:var(--muted);line-height:1.6}
  .note-box{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.25rem;font-size:.82rem;color:var(--muted);margin-top:1.5rem;line-height:1.8}
  </style>
</head>
<body>

<?php $headerTheme = 'light'; $headerAction = ['label' => '恋愛傾向診断を受ける', 'url' => '/love']; require __DIR__.'/../../inc/header.php'; ?>

<div class="wrap">
  <?php $bcPath = '/articles/love/'; $bcName = '恋愛傾向診断'; require __DIR__.'/../../inc/breadcrumb.php'; ?>

  <div class="art-hero">
    <span class="art-label">Love Engine × 解説記事</span>
    <h1>恋愛傾向診断（Love Engine）解説記事一覧</h1>
    <p class="art-lead">MBTI×血液型×星座を組み合わせた恋愛傾向診断「Love Engine」の仕組みと、9216パターンの実測データに基づく解説記事、全52本をカテゴリ別に掲載しています。まず何から読めばいいか迷ったら、使い方ガイドの「<a href="/articles/love/guide/kekka-no-mikata/" style="color:var(--accent)">恋愛診断の結果の見方</a>」から始めるのがおすすめです。</p>
  </div>

  <section class="art-section">
    <h2>カテゴリ一覧</h2>
    <div class="cat-grid">
      <?php foreach ($_CATEGORIES as $c): ?>
      <a href="/articles/love/<?= htmlspecialchars($c['slug']) ?>/" class="cat-card">
        <span class="cat-icon"><?= $c['icon'] ?></span>
        <div class="cat-name"><?= htmlspecialchars($c['name']) ?></div>
        <div class="cat-kw"><?= htmlspecialchars($c['kw']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
    <p class="note-box">基本7カテゴリ（52記事）に加え、MBTI×血液型の組み合わせ記事を順次追加中です。各記事は、恋愛傾向診断エンジンが9216通りの組み合わせパターンを実際に計算した実測データに基づいて解説しています。</p>
  </section>
</div>

<?php $currentSlug='love'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'love-articles-index');
?>
