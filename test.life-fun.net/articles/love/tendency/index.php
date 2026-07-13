<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

$_PUBLISHED = [
  ['slug'=>'kekkonshikou-love', 'name'=>'結婚志向', 'kw'=>'恋愛の先に将来を描きやすいか'],
  ['slug'=>'uwakitaisei-love',  'name'=>'浮気耐性', 'kw'=>'一度決めた相手を守り抜こうとするか'],
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/tendency/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Love Engineが算出する推定傾向指標（結婚志向・浮気耐性）を、9216パターンの実測データで解説。">
  <title>推定傾向指標（Tendency）とは｜Love Engineの計算方法を実測データで解説</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
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
  .art-header{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:100}
  .art-header-inner{max-width:780px;margin:0 auto;padding:0 1.2rem;display:flex;align-items:center;justify-content:space-between;height:52px}
  .art-logo{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);text-decoration:none}
  .art-logo em{font-style:italic;color:var(--gold)}
  .art-back{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.25rem .75rem;border-radius:20px;transition:border-color .2s,color .2s}
  .art-back:hover{border-color:var(--accent-lt);color:var(--accent)}
  .wrap{max-width:780px;margin:0 auto;padding:0 1.2rem}
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
  .type-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.75rem;margin-top:1rem}
  .type-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s;text-decoration:none;display:block}
  .type-card:hover{border-color:var(--accent-lt)}
  .type-name{font-family:var(--ff-serif);font-weight:700;color:var(--text);font-size:1.05rem}
  .type-kw{font-size:.72rem;color:var(--muted);margin-top:.3rem}
  .note-box{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.25rem;font-size:.82rem;color:var(--muted);margin-top:1.5rem;line-height:1.8}
  </style>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/love" class="art-back">💜 恋愛傾向診断を受ける →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span>
    <a href="/articles/">占い解説ガイド</a><span>›</span>
    推定傾向指標
  </nav>

  <div class="art-hero">
    <span class="art-label">Tendency × Love Engine</span>
    <h1>推定傾向指標（Tendency）とは</h1>
    <p class="art-lead">Love Engineは、性格プリミティブから2つの推定傾向（Tendency）を算出します。結婚志向・浮気耐性は、Styleと違い性格だけで決定できない概念であるため、断定を避けた表現で扱います。9216パターンの実測データとともに解説します。</p>
  </div>

  <section class="art-section">
    <h2>指標一覧</h2>
    <div class="type-grid">
      <?php foreach ($_PUBLISHED as $t): ?>
      <a href="/articles/love/tendency/<?= htmlspecialchars($t['slug']) ?>/" class="type-card">
        <div class="type-name"><?= htmlspecialchars($t['name']) ?></div>
        <div class="type-kw"><?= htmlspecialchars($t['kw']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
    <p class="note-box">Tendency（推定傾向）の全2指標が揃っています。あわせて<a href="/articles/love/style/" style="color:var(--accent)">Style（恋愛スタイル）の7指標</a>もご覧いただけます。</p>
  </section>
</div>

<?php $currentSlug='love'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'love-tendency-index');
?>
