<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

// Style/Tendency名 → 記事slugの対応表（articles/love/style/index.php・
// articles/love/tendency/index.phpの$_PUBLISHEDと同じ対応）。
const BLOOD_TPL_STYLE_SLUGS = [
  '積極性' => 'sekkyokusei-love',
  '愛情表現' => 'aijouhyougen-love',
  '包容力' => 'houyouryoku-love',
  '独占欲' => 'dokusenyoku-love',
  '惚れやすさ' => 'horeyasusa-love',
  '嫉妬深さ' => 'shittobukasa-love',
  '恋愛の慎重さ' => 'shinchousa-love',
];
const BLOOD_TPL_TENDENCY_SLUGS = [
  '結婚志向' => 'kekkonshikou-love',
  '浮気耐性' => 'uwakitaisei-love',
];
// Primitive名 → Bundle記事slugの対応表（articles/love/bundle/配下）。
const BLOOD_TPL_BUNDLE_SLUGS = [
  '行動主導性' => 'action-type',
  '誠実性' => 'reliability-type',
  '情動性' => 'sensitivity-type',
  '自立性' => 'autonomy-type',
  '変化志向' => 'transform-type',
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/blood/<?= $item['slug'] ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($item['name']) ?>の恋愛傾向を、Love Engineの実測データ（<?= (int)$item['sampleSize'] ?>パターン分析）で解説。恋愛スタイル・結婚観の傾向を、なぜそうなるかという理由つきで紹介。">
  <title><?= htmlspecialchars($item['name']) ?>の恋愛傾向｜Love Engineの実測データで解説</title>
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
  .causal-chain{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;margin:1.25rem 0;font-family:var(--ff-mono);font-size:.78rem}
  .causal-node{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:.4rem .8rem;color:var(--text)}
  .causal-arrow{color:var(--accent-lt)}
  .stat-list{display:flex;flex-direction:column;gap:1.1rem;margin-top:1.25rem}
  .stat-item-name{font-size:.88rem;font-weight:500;margin-bottom:.4rem}
  .stat-bar{display:flex;height:20px;border-radius:6px;overflow:hidden;background:var(--bg2)}
  .stat-seg{display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:#fff}
  .stat-seg.high{background:var(--accent)}
  .stat-seg.mid{background:#b8a4e8}
  .stat-seg.low{background:#e5e3ee;color:var(--muted)}
  .stat-legend{display:flex;gap:1rem;font-size:.68rem;color:var(--muted);margin-top:.4rem;font-family:var(--ff-mono)}
  .stat-note{font-size:.82rem;color:#444;margin-top:.5rem;line-height:1.8}
  .compare-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .compare-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .compare-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .compare-table td.self{color:var(--accent);font-weight:700}
  .rank-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .rank-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rank-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rank-table a{color:var(--accent);text-decoration:none}
  .rank-table a:hover{text-decoration:underline}
  .bundle-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.25rem 1.5rem;margin:1.25rem 0}
  .bundle-pct{font-family:var(--ff-mono);font-size:1.8rem;color:var(--accent);font-weight:400}
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
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"恋愛傾向診断（Love Engine）解説記事一覧","item":"https://life-fun.net/articles/love/"},
      {"@type":"ListItem","position":4,"name":"血液型×恋愛","item":"https://life-fun.net/articles/love/blood/"},
      {"@type":"ListItem","position":5,"name":"<?= htmlspecialchars($item['name'].'の恋愛傾向') ?>","item":"https://life-fun.net/articles/love/blood/<?= $item['slug'] ?>/"}
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
    <a href="/articles/love/blood/">血液型×恋愛</a><span>›</span>
    <?= htmlspecialchars($item['name']) ?>
  </nav>

  <div class="art-hero">
    <span class="art-label">Blood × Love Engine</span>
    <h1><?= htmlspecialchars($item['name']) ?>の恋愛傾向｜Love Engineの実測データで解説</h1>
    <p class="art-lead"><?= htmlspecialchars($item['lead']) ?></p>
  </div>

  <div class="engine-note">
    このページの「Love Engineの実測データ」は、恋愛傾向診断エンジンの9216通りの組み合わせパターンのうち、<strong><?= htmlspecialchars($item['name']) ?>に該当する<?= (int)$item['sampleSize'] ?>パターン</strong>（MBTI16×星座144）を集計した結果です。血液型は4種類しかないため、他の3タイプとの比較（4節）もあわせてご覧ください。
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
      <li><a href="#features"><?= htmlspecialchars($item['name']) ?>の恋愛の特徴</a></li>
      <li><a href="#causal">なぜこの傾向になるのか</a></li>
      <li><a href="#data">Love Engineの実測データ</a></li>
      <li><a href="#compare">4つの血液型との比較</a></li>
      <li><a href="#mbti">MBTIとの組み合わせ</a></li>
      <li><a href="#bundle">恋愛タイプの組み合わせ</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="features">
    <h2><?= htmlspecialchars($item['name']) ?>の恋愛の特徴</h2>
    <p><?= htmlspecialchars($item['features_lead']) ?></p>
    <p><?= htmlspecialchars($item['features_body']) ?></p>
  </section>

  <section class="art-section" id="causal">
    <h2>なぜこの傾向になるのか</h2>
    <p><?= htmlspecialchars($item['causal_intro']) ?></p>
    <div class="causal-chain">
      <?php foreach($item['causal_factors'] as $i => $c): ?>
      <span class="causal-node"><?= htmlspecialchars($c['trait']) ?></span>
      <span class="causal-arrow">→</span>
      <span class="causal-node"><?= htmlspecialchars($c['primitive']) ?></span>
      <?php if ($i < count($item['causal_factors']) - 1): ?><span class="causal-arrow">／</span><?php endif; ?>
      <?php endforeach; ?>
    </div>
    <p><?= htmlspecialchars($item['causal_explanation']) ?></p>
  </section>

  <section class="art-section" id="data">
    <h2>Love Engineの実測データ</h2>
    <p><?= htmlspecialchars($item['data_intro']) ?></p>

    <h3>恋愛スタイル（Style）</h3>
    <div class="stat-list">
      <?php foreach($item['styles'] as $name => $s): ?>
      <div>
        <div class="stat-item-name"><?php if (isset(BLOOD_TPL_STYLE_SLUGS[$name])): ?><a href="/articles/love/style/<?= BLOOD_TPL_STYLE_SLUGS[$name] ?>/" class="al-link"><?= htmlspecialchars($name) ?></a><?php else: ?><?= htmlspecialchars($name) ?><?php endif; ?></div>
        <div class="stat-bar">
          <?php if($s['high']>0): ?><div class="stat-seg high" style="width:<?= $s['high'] ?>%"><?= $s['high'] ?>%</div><?php endif; ?>
          <?php if($s['mid']>0): ?><div class="stat-seg mid" style="width:<?= $s['mid'] ?>%"><?= $s['mid'] ?>%</div><?php endif; ?>
          <?php if($s['low']>0): ?><div class="stat-seg low" style="width:<?= $s['low'] ?>%"><?= $s['low'] ?>%</div><?php endif; ?>
        </div>
        <div class="stat-legend"><span>High</span><span>Mid</span><span>Low</span></div>
        <p class="stat-note"><?= htmlspecialchars($s['note']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <h3>推定傾向（Tendency）</h3>
    <div class="stat-list">
      <?php foreach($item['tendencies'] as $name => $t): ?>
      <div>
        <div class="stat-item-name"><?php if (isset(BLOOD_TPL_TENDENCY_SLUGS[$name])): ?><a href="/articles/love/tendency/<?= BLOOD_TPL_TENDENCY_SLUGS[$name] ?>/" class="al-link"><?= htmlspecialchars($name) ?></a><?php else: ?><?= htmlspecialchars($name) ?><?php endif; ?></div>
        <div class="stat-bar">
          <?php if($t['high']>0): ?><div class="stat-seg high" style="width:<?= $t['high'] ?>%"><?= $t['high'] ?>%</div><?php endif; ?>
          <?php if($t['mid']>0): ?><div class="stat-seg mid" style="width:<?= $t['mid'] ?>%"><?= $t['mid'] ?>%</div><?php endif; ?>
          <?php if($t['low']>0): ?><div class="stat-seg low" style="width:<?= $t['low'] ?>%"><?= $t['low'] ?>%</div><?php endif; ?>
        </div>
        <div class="stat-legend"><span>High</span><span>Mid</span><span>Low</span></div>
        <p class="stat-note"><?= htmlspecialchars($t['note']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="compare">
    <h2>4つの血液型との比較</h2>
    <p><?= htmlspecialchars($item['compare_intro']) ?></p>
    <table class="compare-table">
      <tr><th>指標</th><th>A型</th><th>B型</th><th>O型</th><th>AB型</th></tr>
      <?php foreach ($item['compareTable'] as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['metric']) ?></td>
        <?php foreach (['A','B','O','AB'] as $bt): ?>
        <td class="<?= $bt === $item['code'] ? 'self' : '' ?>"><?= $row[$bt] ?>%</td>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>

  <section class="art-section" id="mbti">
    <h2>MBTIとの組み合わせ</h2>
    <p><?= htmlspecialchars($item['mbti_intro']) ?></p>
    <table class="rank-table">
      <tr><th>MBTIタイプ</th><th>積極性のHigh率</th></tr>
      <?php foreach ($item['mbtiRanking'] as $r): ?>
      <tr>
        <td><a href="<?= htmlspecialchars($r['url']) ?>"><?= htmlspecialchars($r['type']) ?></a></td>
        <td><?= $r['pct'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>

  <section class="art-section" id="bundle">
    <h2>恋愛タイプの組み合わせ（Bundle）</h2>
    <p><?= htmlspecialchars($item['bundle_intro']) ?></p>
    <?php
    $bp = $item['topBundle']['primary'];
    $bs = $item['topBundle']['secondary'];
    $bpLink = isset(BLOOD_TPL_BUNDLE_SLUGS[$bp]) ? '<a href="/articles/love/bundle/'.BLOOD_TPL_BUNDLE_SLUGS[$bp].'/" class="al-link">'.htmlspecialchars($bp).'</a>' : htmlspecialchars($bp);
    $bsLink = isset(BLOOD_TPL_BUNDLE_SLUGS[$bs]) ? '<a href="/articles/love/bundle/'.BLOOD_TPL_BUNDLE_SLUGS[$bs].'/" class="al-link">'.htmlspecialchars($bs).'</a>' : htmlspecialchars($bs);
    ?>
    <div class="bundle-box">
      <div class="bundle-pct"><?= $item['topBundle']['pct'] ?>%</div>
      <p style="margin-top:.5rem"><strong><?= $bpLink ?> × <?= $bsLink ?></strong>の組み合わせが最も多く出現します（<?= (int)$item['sampleSize'] ?>パターン中）。</p>
      <p style="margin-top:.5rem"><?= htmlspecialchars($item['topBundle']['note']) ?></p>
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
  $listTitle = '血液型×恋愛 一覧';
  $listUrl   = '/articles/love/blood/';
  require __DIR__.'/../../../inc/article-nav.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <?php
    $relatedItems = [
      ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
      ['label'=>'MBTI×恋愛', 'title'=>'16タイプ別の恋愛傾向を見る →', 'url'=>'/articles/love/mbti/'],
      ['label'=>'星座×恋愛', 'title'=>'12星座別の恋愛傾向を見る →', 'url'=>'/articles/love/seiza/'],
      ['label'=>'結果の見方', 'title'=>'Style・Bundleなど用語をまとめて理解する →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
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
echo autoLink($html, 'love-blood-'.$item['slug']);
?>
