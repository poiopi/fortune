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
  <link rel="canonical" href="https://life-fun.net/articles/love/mbti-blood/<?= $item['slug'] ?>/" />
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
  .class-badge{display:inline-block;font-family:var(--ff-mono);font-size:.7rem;letter-spacing:.05em;color:#fff;background:var(--accent);border-radius:20px;padding:.3rem 1rem;margin-top:.75rem}
  .conclusion-box{background:#fff;border:1.5px solid var(--accent-lt);border-radius:12px;padding:1.25rem 1.5rem;margin:1.5rem 0}
  .conclusion-box .cb-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.1em;color:var(--accent);margin-bottom:.6rem;display:block}
  .conclusion-box p{font-size:.9rem;color:#333;line-height:1.85;margin:0}
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
  .causal-source-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .causal-source-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .causal-source-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border);vertical-align:top}
  .causal-source-table td.win{color:var(--accent);font-weight:700}
  .stat-list{display:flex;flex-direction:column;gap:1.1rem;margin-top:1.25rem}
  .stat-item-name{font-size:.88rem;font-weight:500;margin-bottom:.4rem}
  .stat-bar{display:flex;height:20px;border-radius:6px;overflow:hidden;background:var(--bg2)}
  .stat-seg{display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:#fff}
  .stat-seg.high{background:var(--accent)}
  .stat-seg.mid{background:#b8a4e8}
  .stat-seg.low{background:#e5e3ee;color:var(--muted)}
  .stat-legend{display:flex;gap:1rem;font-size:.68rem;color:var(--muted);margin-top:.4rem;font-family:var(--ff-mono)}
  .rank-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .rank-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rank-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rarity-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.25rem 1.5rem;margin-top:1rem}
  .rarity-box .rb-level{font-family:var(--ff-serif);font-size:1.3rem;font-weight:700;color:var(--accent)}
  .rarity-box .rb-rank{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);margin-left:.6rem}
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
  .concept-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:1.25rem}
  .concept-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.1rem;text-decoration:none;display:block;transition:border-color .2s}
  .concept-card:hover{border-color:var(--accent-lt)}
  .concept-card-title{font-family:var(--ff-serif);font-weight:700;color:var(--accent);font-size:.95rem;margin-bottom:.3rem}
  .concept-card-desc{font-size:.78rem;color:var(--muted);line-height:1.6}
  @media(max-width:560px){ .concept-grid{grid-template-columns:1fr} }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"恋愛傾向診断（Love Engine）解説記事一覧","item":"https://life-fun.net/articles/love/"},
      {"@type":"ListItem","position":4,"name":"MBTI×血液型","item":"https://life-fun.net/articles/love/mbti-blood/"},
      {"@type":"ListItem","position":5,"name":"<?= htmlspecialchars($item['name']) ?>","item":"https://life-fun.net/articles/love/mbti-blood/<?= $item['slug'] ?>/"}
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
    <a href="/articles/love/mbti-blood/">MBTI×血液型</a><span>›</span>
    <?= htmlspecialchars($item['name']) ?>
  </nav>

  <div class="art-hero">
    <span class="art-label">MBTI × Blood × Love Engine</span>
    <h1><?= htmlspecialchars($item['h1']) ?></h1>
    <p class="art-lead"><?= htmlspecialchars($item['lead']) ?></p>
    <span class="class-badge"><?= htmlspecialchars($item['classification']) ?></span>
  </div>

  <div class="conclusion-box">
    <span class="cb-label">この組み合わせの結論</span>
    <p><?= htmlspecialchars($item['conclusion']) ?></p>
  </div>

  <?php
  $ctaTitle = 'あなたの恋愛傾向を診断する';
  $ctaText  = 'MBTI×血液型×星座で、あなただけの恋愛スタイルを診断。';
  $ctaUrl   = '/love';
  $ctaBtn   = '恋愛傾向を診断する →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#classification">分類：<?= htmlspecialchars($item['classification']) ?></a></li>
      <li><a href="#causal">なぜこの結果になるのか</a></li>
      <li><a href="#data">Love Engineの実測データ</a></li>
      <li><a href="#bundle">Bundleの内訳</a></li>
      <li><a href="#rarity">この組み合わせの位置づけ</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="classification">
    <h2>分類：<?= htmlspecialchars($item['classification']) ?></h2>
    <p><?= htmlspecialchars($item['classification_desc']) ?></p>
    <p>MBTI×血液型64通りの分類方法自体は<a href="/articles/love/mbti-blood/" class="al-link">「MBTI×血液型の組み合わせ」一覧ページ</a>で解説しています。</p>
  </section>

  <section class="art-section" id="causal">
    <h2>なぜこの結果になるのか</h2>
    <p><?= htmlspecialchars($item['causal_intro']) ?></p>
    <table class="causal-source-table">
      <tr><th>入力</th><th>単体での主軸</th><th>組み合わせでの採否</th></tr>
      <?php foreach ($item['causalRows'] as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['source']) ?></td>
        <td><?= htmlspecialchars($row['solo']) ?></td>
        <td class="<?= $row['adopted'] ? 'win' : '' ?>"><?= htmlspecialchars($row['result']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><?= htmlspecialchars($item['causal_explanation']) ?></p>
  </section>

  <section class="art-section" id="data">
    <h2>Love Engineの実測データ</h2>
    <p><?= htmlspecialchars($item['data_intro']) ?></p>

    <h3>恋愛スタイル（Style）</h3>
    <div class="stat-list">
      <?php foreach($item['styles'] as $name => $s): ?>
      <div>
        <div class="stat-item-name"><?= htmlspecialchars($name) ?></div>
        <div class="stat-bar">
          <?php if($s['high']>0): ?><div class="stat-seg high" style="width:<?= $s['high'] ?>%"><?= $s['high'] ?>%</div><?php endif; ?>
          <?php if($s['mid']>0): ?><div class="stat-seg mid" style="width:<?= $s['mid'] ?>%"><?= $s['mid'] ?>%</div><?php endif; ?>
          <?php if($s['low']>0): ?><div class="stat-seg low" style="width:<?= $s['low'] ?>%"><?= $s['low'] ?>%</div><?php endif; ?>
        </div>
        <div class="stat-legend"><span>High</span><span>Mid</span><span>Low</span></div>
      </div>
      <?php endforeach; ?>
    </div>

    <h3>推定傾向（Tendency）</h3>
    <div class="stat-list">
      <?php foreach($item['tendencies'] as $name => $t): ?>
      <div>
        <div class="stat-item-name"><?= htmlspecialchars($name) ?></div>
        <div class="stat-bar">
          <?php if($t['high']>0): ?><div class="stat-seg high" style="width:<?= $t['high'] ?>%"><?= $t['high'] ?>%</div><?php endif; ?>
          <?php if($t['mid']>0): ?><div class="stat-seg mid" style="width:<?= $t['mid'] ?>%"><?= $t['mid'] ?>%</div><?php endif; ?>
          <?php if($t['low']>0): ?><div class="stat-seg low" style="width:<?= $t['low'] ?>%"><?= $t['low'] ?>%</div><?php endif; ?>
        </div>
        <div class="stat-legend"><span>High</span><span>Mid</span><span>Low</span></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="bundle">
    <h2>Bundleの内訳</h2>
    <p><?= htmlspecialchars($item['bundle_intro']) ?></p>
    <table class="rank-table">
      <tr><th>組み合わせ</th><th>件数</th><th>比率</th></tr>
      <?php foreach ($item['bundleBreakdown'] as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['label']) ?></td>
        <td><?= $row['count'] ?></td>
        <td><?= $row['pct'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>

  <section class="art-section" id="rarity">
    <h2>この組み合わせの位置づけ</h2>
    <div class="rarity-box">
      <span class="rb-level"><?= htmlspecialchars($item['rarityLevel']) ?></span><span class="rb-rank">64通り中<?= htmlspecialchars($item['rarityRank']) ?></span>
      <p style="margin-top:.6rem"><?= htmlspecialchars($item['rarity_note']) ?></p>
    </div>
  </section>

  <section class="art-section" id="related-links">
    <h2>関連するStyle・Bundle</h2>
    <div class="concept-grid">
      <?php foreach ($item['conceptLinks'] as $cl): ?>
      <a href="<?= htmlspecialchars($cl['url']) ?>" class="concept-card">
        <div class="concept-card-title"><?= htmlspecialchars($cl['name']) ?></div>
        <div class="concept-card-desc"><?= htmlspecialchars($cl['desc']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <?php foreach ($item['faq'] as $f): ?>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)"><?= htmlspecialchars($f['q']) ?></div>
        <div class="faq-a"><?= htmlspecialchars($f['a']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <?php foreach ($item['matome'] as $m): ?>
      <li><?= htmlspecialchars($m) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>

  <?php
  $ctaTitle = 'あなた自身はどうでしょう？';
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
  $listTitle = 'MBTI×血液型 一覧';
  $listUrl   = '/articles/love/mbti-blood/';
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
echo autoLink($html, 'love-mbti-blood-'.$item['slug']);
?>
