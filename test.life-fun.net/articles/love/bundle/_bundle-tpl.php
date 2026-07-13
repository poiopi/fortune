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
  <link rel="canonical" href="https://life-fun.net/articles/love/bundle/<?= $item['slug'] ?>/" />
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
  .engine-note{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1rem 1.25rem;margin:1.5rem 0;font-size:.82rem;color:var(--muted);line-height:1.8}
  .engine-note strong{color:var(--accent)}
  .selfcheck-box{background:#fff;border:1.5px solid var(--accent-lt);border-radius:12px;padding:1.25rem 1.5rem;margin:1.5rem 0}
  .selfcheck-box .sc-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.1em;color:var(--accent);margin-bottom:.6rem;display:block}
  .sc-quote{background:var(--bg2);border-radius:8px;padding:.85rem 1rem;font-size:.85rem;color:#333;line-height:1.8;margin-bottom:.6rem;border-left:3px solid var(--accent-lt)}
  .sc-quote:last-of-type{margin-bottom:0}
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
  .rank-table td.self{color:var(--accent);font-weight:700}
  .rank-table a{color:var(--accent);text-decoration:none}
  .rank-table a:hover{text-decoration:underline}
  .causal-source-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .causal-source-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .causal-source-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border);vertical-align:top}
  .concept-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:1.25rem}
  .concept-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.1rem;text-decoration:none;display:block;transition:border-color .2s}
  .concept-card:hover{border-color:var(--accent-lt)}
  .concept-card-title{font-family:var(--ff-serif);font-weight:700;color:var(--accent);font-size:.95rem;margin-bottom:.3rem}
  .concept-card-desc{font-size:.78rem;color:var(--muted);line-height:1.6}
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
  @media(max-width:560px){ .concept-grid{grid-template-columns:1fr} }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"恋愛傾向診断（Love Engine）解説記事一覧","item":"https://life-fun.net/articles/love/"},
      {"@type":"ListItem","position":4,"name":"恋愛タイプ（Bundle）","item":"https://life-fun.net/articles/love/bundle/"},
      {"@type":"ListItem","position":5,"name":"<?= htmlspecialchars($item['name']) ?>","item":"https://life-fun.net/articles/love/bundle/<?= $item['slug'] ?>/"}
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
    <a href="/articles/love/bundle/">恋愛タイプ（Bundle）</a><span>›</span>
    <?= htmlspecialchars($item['name']) ?>
  </nav>

  <div class="art-hero">
    <span class="art-label">Bundle × Love Engine</span>
    <h1><?= htmlspecialchars($item['h1']) ?></h1>
    <p class="art-lead"><?= htmlspecialchars($item['lead']) ?></p>
  </div>

  <div class="selfcheck-box">
    <span class="sc-label">診断結果にこの文章が表示された方へ</span>
    <p style="font-size:.85rem;color:#333;margin-bottom:.8rem"><?= htmlspecialchars($item['selfCheckIntro']) ?></p>
    <?php foreach ($item['selfCheckQuotes'] as $q): ?>
    <div class="sc-quote">「<?= htmlspecialchars($q) ?>」</div>
    <?php endforeach; ?>
    <p style="font-size:.78rem;color:var(--muted);margin-top:.8rem;line-height:1.7">※「<?= htmlspecialchars($item['name']) ?>」という型名は、診断結果の画面には表示されません。上記のような診断文や特徴をわかりやすく解説するための、記事上の分類です。</p>
  </div>

  <div class="engine-note">
    このページの「Love Engineの実測データ」は、恋愛傾向診断エンジンの9216通りの組み合わせパターンのうち、<strong><?= htmlspecialchars($item['primitiveName']) ?>が最も強く出て「<?= htmlspecialchars($item['name']) ?>」と判定される<?= number_format($item['sampleSize']) ?>パターン（全体の<?= $item['pct'] ?>%）</strong>を集計した結果です。恋愛タイプ（Bundle）は5つに分類されるため、他の4タイプとの比較（4節）もあわせてご覧ください。
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
      <li><a href="#features"><?= htmlspecialchars($item['name']) ?>の特徴</a></li>
      <li><a href="#causal">なぜこのタイプになるのか</a></li>
      <li><a href="#breakdown"><?= htmlspecialchars($item['name']) ?>の内訳</a></li>
      <li><a href="#data">Love Engineの実測データ</a></li>
      <li><a href="#compare">5つの恋愛タイプとの比較</a></li>
      <li><a href="#mbti">MBTIとの相関</a></li>
      <li><a href="#related-style">関連するStyle・Tendency</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="features">
    <h2><?= htmlspecialchars($item['name']) ?>の特徴</h2>
    <p><?= htmlspecialchars($item['features_lead']) ?></p>
    <p><?= htmlspecialchars($item['features_body']) ?></p>
  </section>

  <section class="art-section" id="causal">
    <h2>なぜこのタイプになるのか</h2>
    <p><?= htmlspecialchars($item['causal_intro']) ?></p>
    <table class="causal-source-table">
      <tr><th>入力</th><th>具体例</th><th><?= htmlspecialchars($item['primitiveName']) ?>への寄与</th></tr>
      <?php foreach ($item['causalSources'] as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['source']) ?></td>
        <td><?= htmlspecialchars($row['example']) ?></td>
        <td><?= htmlspecialchars($row['contribution']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><?= htmlspecialchars($item['causal_explanation']) ?></p>
  </section>

  <section class="art-section" id="breakdown">
    <h2><?= htmlspecialchars($item['name']) ?>の内訳</h2>
    <p><?= htmlspecialchars($item['breakdown_intro']) ?></p>
    <table class="rank-table">
      <tr><th>組み合わせ</th><th>件数</th><th>全体比</th><th>グループ内比</th></tr>
      <?php foreach ($item['breakdown'] as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['label']) ?></td>
        <td><?= number_format($row['count']) ?></td>
        <td><?= $row['pctOfAll'] ?>%</td>
        <td><?= $row['pctOfGroup'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>
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

  <section class="art-section" id="compare">
    <h2>5つの恋愛タイプとの比較</h2>
    <p><?= htmlspecialchars($item['compare_intro']) ?></p>
    <table class="rank-table">
      <tr><th>タイプ</th><th>出現率</th></tr>
      <?php foreach ($item['groupCompare'] as $row): ?>
      <tr>
        <td class="<?= $row['self'] ? 'self' : '' ?>"><?= $row['self'] ? htmlspecialchars($row['name']).'（このページ）' : '<a href="'.htmlspecialchars($row['url']).'">'.htmlspecialchars($row['name']).'</a>' ?></td>
        <td class="<?= $row['self'] ? 'self' : '' ?>"><?= $row['pct'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>

  <section class="art-section" id="mbti">
    <h2>MBTIとの相関</h2>
    <p><?= htmlspecialchars($item['mbti_intro']) ?></p>
    <table class="rank-table">
      <tr><th>MBTIタイプ</th><th>該当率</th></tr>
      <?php foreach ($item['mbtiRanking'] as $r): ?>
      <tr>
        <td><a href="<?= htmlspecialchars($r['url']) ?>"><?= htmlspecialchars($r['type']) ?></a></td>
        <td><?= $r['pct'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php if (!empty($item['bloodSeizaNote'])): ?>
    <p style="margin-top:1rem"><?= htmlspecialchars($item['bloodSeizaNote']) ?></p>
    <?php endif; ?>
  </section>

  <section class="art-section" id="related-style">
    <h2>関連するStyle・Tendency</h2>
    <p><?= htmlspecialchars($item['styleLinksIntro']) ?></p>
    <div class="concept-grid">
      <?php foreach ($item['styleLinks'] as $sl): ?>
      <a href="<?= htmlspecialchars($sl['url']) ?>" class="concept-card">
        <div class="concept-card-title"><?= htmlspecialchars($sl['name']) ?></div>
        <div class="concept-card-desc"><?= htmlspecialchars($sl['desc']) ?></div>
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
  $listTitle = '恋愛タイプ（Bundle） 一覧';
  $listUrl   = '/articles/love/bundle/';
  require __DIR__.'/../../../inc/article-nav.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <?php
    $relatedItems = [
      ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
      ['label'=>'Bundleとは', 'title'=>'恋愛タイプの分類ロジックを見る →', 'url'=>'/articles/love/guide/bundle-guide/'],
      ['label'=>'MBTI×恋愛', 'title'=>'16タイプ別の恋愛傾向を見る →', 'url'=>'/articles/love/mbti/'],
      ['label'=>'結果の見方', 'title'=>'診断結果の読み方を最初から見る →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
    ];
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
echo autoLink($html, 'love-bundle-'.$item['slug']);
?>
