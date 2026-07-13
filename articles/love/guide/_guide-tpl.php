<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/guide/<?= $item['slug'] ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($item['description']) ?>">
  <title><?= htmlspecialchars($item['title']) ?></title>
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
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,4vw,2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:2rem 0}
  .toc-title{font-size:.8rem;font-weight:500;color:var(--muted);letter-spacing:.1em;margin-bottom:.75rem;font-family:var(--ff-mono)}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.35rem}
  .toc li{font-size:.88rem}
  .toc a{color:var(--accent);text-decoration:none}
  .toc a:hover{text-decoration:underline}
  .art-section{padding:2.5rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-child{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}
  .art-section p:last-child{margin-bottom:0}
  .concept-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:1.25rem}
  .concept-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.1rem;text-decoration:none;display:block;transition:border-color .2s}
  .concept-card:hover{border-color:var(--accent-lt)}
  .concept-card-title{font-family:var(--ff-serif);font-weight:700;color:var(--accent);font-size:.95rem;margin-bottom:.3rem}
  .concept-card-desc{font-size:.78rem;color:var(--muted);line-height:1.6}
  .flow-chain{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;margin:1.25rem 0;font-family:var(--ff-mono);font-size:.8rem}
  .flow-node{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:.5rem 1rem;color:var(--text)}
  .flow-arrow{color:var(--accent-lt)}
  .norm-box{display:flex;justify-content:space-between;gap:.5rem;margin:1.25rem 0;font-family:var(--ff-mono);font-size:.75rem;text-align:center}
  .norm-seg{flex:1;padding:.75rem .5rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border)}
  .norm-seg .lv{font-weight:700;color:var(--accent);display:block;margin-bottom:.3rem;font-family:var(--ff-serif);font-size:.9rem}
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:400px;padding:.9rem 1.1rem}
  .matome-list{padding-left:1.2rem;display:flex;flex-direction:column;gap:.6rem}
  .matome-list li{font-size:.92rem;line-height:1.8;color:#333}
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px}
  .rank-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .rank-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rank-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  @media(max-width:560px){ .concept-grid{grid-template-columns:1fr} }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"恋愛傾向診断（Love Engine）解説記事一覧","item":"https://life-fun.net/articles/love/"},
      {"@type":"ListItem","position":4,"name":"使い方ガイド","item":"https://life-fun.net/articles/love/guide/"},
      {"@type":"ListItem","position":5,"name":"<?= htmlspecialchars($item['title']) ?>","item":"https://life-fun.net/articles/love/guide/<?= $item['slug'] ?>/"}
    ]
  }
  </script>
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
    <a href="/articles/love/">恋愛傾向診断（Love Engine）解説記事一覧</a><span>›</span>
    <a href="/articles/love/guide/">使い方ガイド</a><span>›</span>
    <?= htmlspecialchars($item['navTitle']) ?>
  </nav>

  <div class="art-hero">
    <span class="art-label">Guide × Love Engine</span>
    <h1><?= htmlspecialchars($item['h1']) ?></h1>
    <p class="art-lead"><?= htmlspecialchars($item['lead']) ?></p>
  </div>

  <?php
  $ctaTitle = 'あなたの恋愛傾向を診断する';
  $ctaText  = 'MBTI×血液型×星座で、あなただけの恋愛スタイルを診断。';
  $ctaUrl   = '/love';
  $ctaBtn   = '恋愛傾向を診断する →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?= $item['body'] ?>

  <?php
  $ctaTitle = 'あなた自身の結果を見てみましょう';
  $ctaText  = 'MBTI×血液型×星座で、あなただけの恋愛傾向を診断できます。';
  $ctaUrl   = '/love';
  $ctaBtn   = '恋愛傾向診断はこちら →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?php
  $prevTitle = !empty($item['prev']) ? $item['prev']['title'] : null;
  $prevUrl   = !empty($item['prev']) ? $item['prev']['url'] : null;
  $nextTitle = !empty($item['next']) ? $item['next']['title'] : null;
  $nextUrl   = !empty($item['next']) ? $item['next']['url'] : null;
  $listTitle = '使い方ガイド 一覧';
  $listUrl   = '/articles/love/guide/';
  require __DIR__.'/../../../inc/article-nav.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <?php
    $relatedItems = $item['relatedItems'];
    require __DIR__.'/../../../inc/article-related.php';
    ?>
  </section>

</div>

<script>
function toggleFaq(el){
  el.parentElement.classList.toggle('open');
}
</script>

<?php $currentSlug='love'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'love-guide-'.$item['slug']);
?>
