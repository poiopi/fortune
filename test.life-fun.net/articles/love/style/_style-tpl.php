<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

// 血液型ラベル → 記事slugの対応表（articles/love/blood/index.phpの$_PUBLISHEDと同じ対応）。
const STYLE_TPL_BLOOD_SLUGS = [
  'A型' => 'a-love',
  'B型' => 'b-love',
  'O型' => 'o-love',
  'AB型' => 'ab-love',
];
// 主軸ラベル → Bundle記事slugの対応表（articles/love/bundle/配下）。
const STYLE_TPL_BUNDLE_SLUGS = [
  '行動主導性が主軸' => 'action-type',
  '誠実性が主軸' => 'reliability-type',
  '情動性が主軸' => 'sensitivity-type',
  '自立性が主軸' => 'autonomy-type',
  '変化志向が主軸' => 'transform-type',
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/style/<?= $item['slug'] ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Love Engineの恋愛スタイル指標「<?= htmlspecialchars($item['name']) ?>」とは何か、どう計算されるかを9216パターンの実測データで解説。High/Mid/Lowの違いとMBTI・血液型別の傾向を紹介。">
  <title><?= htmlspecialchars($item['name']) ?>（Style）とは｜Love Engineの計算方法と実測データを解説</title>
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
  /* 計算式 */
  .formula-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin:1.25rem 0;text-align:center}
  .formula-expr{font-family:var(--ff-mono);font-size:1.05rem;color:var(--accent);letter-spacing:.02em}
  .formula-note{font-size:.78rem;color:var(--muted);margin-top:.6rem}
  .norm-box{display:flex;justify-content:space-between;gap:.5rem;margin:1.25rem 0;font-family:var(--ff-mono);font-size:.75rem;text-align:center}
  .norm-seg{flex:1;padding:.75rem .5rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border)}
  .norm-seg .lv{font-weight:700;color:var(--accent);display:block;margin-bottom:.3rem;font-family:var(--ff-serif);font-size:.9rem}
  /* Level box（Text Bank原文） */
  .level-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1.25rem}
  .level-box{border:1px solid var(--border);border-radius:10px;padding:1rem 1.25rem;background:var(--bg2)}
  .level-tag{font-family:var(--ff-mono);font-size:.7rem;color:var(--accent);letter-spacing:.1em;margin-bottom:.4rem;display:block}
  .level-text{font-size:.9rem;color:#333;line-height:1.8}
  /* 実測データ */
  .stat-bar{display:flex;height:22px;border-radius:6px;overflow:hidden;background:var(--bg2);margin:1rem 0 .3rem}
  .stat-seg{display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.62rem;color:#fff}
  .stat-seg.high{background:var(--accent)}
  .stat-seg.mid{background:#b8a4e8}
  .stat-seg.low{background:#e5e3ee;color:var(--muted)}
  .rank-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .rank-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rank-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .rank-table a{color:var(--accent);text-decoration:none}
  .rank-table a:hover{text-decoration:underline}
  .rank-bar-mini{display:inline-block;height:8px;background:var(--accent);border-radius:3px;vertical-align:middle;margin-right:.4rem}
  .blood-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.6rem;margin-top:1rem}
  .blood-card{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:.75rem;text-align:center;text-decoration:none;color:inherit;display:block;transition:border-color .2s}
  a.blood-card:hover{border-color:var(--accent-lt)}
  .blood-card .bt{font-family:var(--ff-serif);font-weight:700;color:var(--text)}
  .blood-card .bp{font-family:var(--ff-mono);color:var(--accent);font-size:1.1rem;margin-top:.3rem}
  .bundle-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .bundle-table th{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:left;padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  .bundle-table td{padding:.5rem .6rem;border-bottom:1px solid var(--border)}
  /* 関連MBTI */
  .mbti-links{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1rem}
  .mbti-link{font-family:var(--ff-mono);font-size:.8rem;padding:.4rem .9rem;border-radius:20px;text-decoration:none;border:1px solid var(--border);color:var(--text);transition:border-color .2s,color .2s}
  .mbti-link:hover{border-color:var(--accent-lt);color:var(--accent)}
  .mbti-link.high{background:#ede9fb}
  /* FAQ */
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
  @media(max-width:560px){ .blood-grid{grid-template-columns:repeat(2,1fr)} }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},
      {"@type":"ListItem","position":3,"name":"恋愛スタイル指標","item":"https://life-fun.net/articles/love/style/"},
      {"@type":"ListItem","position":4,"name":"<?= htmlspecialchars($item['name']) ?>とは","item":"https://life-fun.net/articles/love/style/<?= $item['slug'] ?>/"}
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
    <a href="/articles/love/style/">恋愛スタイル指標</a><span>›</span>
    <?= htmlspecialchars($item['name']) ?>とは
  </nav>

  <div class="art-hero">
    <span class="art-label">Style × Love Engine</span>
    <h1><?= htmlspecialchars($item['name']) ?>（Style）とは｜Love Engineの計算方法と実測データを解説</h1>
    <p class="art-lead"><?= htmlspecialchars($item['lead']) ?></p>
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
      <li><a href="#overview"><?= htmlspecialchars($item['name']) ?>とは何を測る指標か</a></li>
      <li><a href="#formula">Love Engineでの計算方法</a></li>
      <li><a href="#levels">High・Mid・Lowの違い</a></li>
      <li><a href="#data">9216件の実測分析</a></li>
      <li><a href="#mbti">関連するMBTIタイプ</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2><?= htmlspecialchars($item['name']) ?>とは何を測る指標か</h2>
    <p><?= htmlspecialchars($item['overview']) ?></p>
    <p><?= htmlspecialchars($item['measures_body']) ?></p>
  </section>

  <section class="art-section" id="formula">
    <h2>Love Engineでの計算方法</h2>
    <p><?= htmlspecialchars($item['formula_intro']) ?></p>
    <div class="formula-box">
      <div class="formula-expr"><?= htmlspecialchars($item['formula_expr']) ?></div>
      <div class="formula-note">Primitive（性格プリミティブ）の加重和として算出</div>
    </div>
    <p><?= htmlspecialchars($item['formula_explanation']) ?></p>
    <h3>Normalizer：High/Mid/Lowへの変換</h3>
    <p><?= htmlspecialchars($item['normalizer_body']) ?></p>
    <div class="norm-box">
      <div class="norm-seg"><span class="lv">Low</span>〜<?= $item['normalizer']['p33'] ?></div>
      <div class="norm-seg"><span class="lv">Mid</span><?= $item['normalizer']['p33'] ?>〜<?= $item['normalizer']['p67'] ?></div>
      <div class="norm-seg"><span class="lv">High</span><?= $item['normalizer']['p67'] ?>〜</div>
    </div>
  </section>

  <section class="art-section" id="levels">
    <h2>High・Mid・Lowの違い</h2>
    <p><?= htmlspecialchars($item['levels_intro']) ?></p>
    <div class="level-list">
      <?php foreach (['High','Mid','Low'] as $lv): ?>
      <div class="level-box">
        <span class="level-tag"><?= $lv ?></span>
        <p class="level-text"><?= htmlspecialchars($item['levels'][$lv]) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="data">
    <h2>9216件の実測分析</h2>
    <p><?= htmlspecialchars($item['data_intro']) ?></p>

    <h3>全体の分布</h3>
    <div class="stat-bar">
      <div class="stat-seg high" style="width:<?= $item['overall']['high'] ?>%"><?= $item['overall']['high'] ?>%</div>
      <div class="stat-seg mid" style="width:<?= $item['overall']['mid'] ?>%"><?= $item['overall']['mid'] ?>%</div>
      <div class="stat-seg low" style="width:<?= $item['overall']['low'] ?>%"><?= $item['overall']['low'] ?>%</div>
    </div>
    <p style="font-size:.78rem;color:var(--muted)">High <?= $item['overall']['high'] ?>% ／ Mid <?= $item['overall']['mid'] ?>% ／ Low <?= $item['overall']['low'] ?>%（9216件中）</p>

    <h3>MBTIタイプ別の傾向</h3>
    <p><?= htmlspecialchars($item['mbti_body']) ?></p>
    <table class="rank-table">
      <tr><th>タイプ</th><th>High率</th></tr>
      <?php foreach ($item['mbtiRanking'] as $r): ?>
      <tr>
        <td><?php if (!empty($r['url'])): ?><a href="<?= htmlspecialchars($r['url']) ?>"><?= htmlspecialchars($r['type']) ?></a><?php else: ?><?= htmlspecialchars($r['type']) ?><?php endif; ?></td>
        <td><span class="rank-bar-mini" style="width:<?= (int)($r['pct']*0.6) ?>px"></span><?= $r['pct'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>

    <h3>血液型別の傾向</h3>
    <p><?= htmlspecialchars($item['blood_body']) ?></p>
    <div class="blood-grid">
      <?php foreach ($item['bloodBreakdown'] as $b): ?>
      <?php $bloodSlug = STYLE_TPL_BLOOD_SLUGS[$b['type']] ?? null; ?>
      <?php if ($bloodSlug): ?>
      <a href="/articles/love/blood/<?= $bloodSlug ?>/" class="blood-card"><div class="bt"><?= htmlspecialchars($b['type']) ?></div><div class="bp"><?= $b['pct'] ?>%</div></a>
      <?php else: ?>
      <div class="blood-card"><div class="bt"><?= htmlspecialchars($b['type']) ?></div><div class="bp"><?= $b['pct'] ?>%</div></div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <h3>Bundle（主軸プリミティブ）との相関</h3>
    <p><?= htmlspecialchars($item['bundle_body']) ?></p>
    <table class="bundle-table">
      <tr><th>Bundleの主軸</th><th><?= htmlspecialchars($item['name']) ?>のHigh率</th></tr>
      <?php foreach ($item['bundleCorrelation'] as $bc): ?>
      <?php $bundleSlug = STYLE_TPL_BUNDLE_SLUGS[$bc['primitive']] ?? null; ?>
      <tr>
        <td><?php if ($bundleSlug): ?><a href="/articles/love/bundle/<?= $bundleSlug ?>/" class="al-link"><?= htmlspecialchars($bc['primitive']) ?></a><?php else: ?><?= htmlspecialchars($bc['primitive']) ?><?php endif; ?></td>
        <td><?= $bc['pct'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>

  <section class="art-section" id="mbti">
    <h2>関連するMBTIタイプ</h2>
    <p><?= htmlspecialchars($item['related_intro']) ?></p>
    <div class="mbti-links">
      <?php foreach ($item['relatedMbti'] as $m): ?>
      <a href="<?= htmlspecialchars($m['url']) ?>" class="mbti-link <?= $m['highlight'] ? 'high' : '' ?>"><?= htmlspecialchars($m['label']) ?></a>
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
  $ctaTitle = 'あなた自身の積極性はどうでしょう？';
  $ctaText  = 'MBTI×血液型×星座で、あなただけの恋愛傾向を診断できます。';
  $ctaUrl   = '/love';
  $ctaBtn   = '恋愛傾向診断はこちら →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <?php
    $relatedItems = [
      ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
      ['label'=>'MBTI×恋愛', 'title'=>'16タイプ別の恋愛傾向を見る →', 'url'=>'/articles/love/mbti/'],
      ['label'=>'Bundleとは', 'title'=>'恋愛タイプの分類ロジックを見る →', 'url'=>'/articles/love/guide/bundle-guide/'],
      ['label'=>'MBTI×星座診断', 'title'=>'16タイプ×12星座で性格を深掘り →', 'url'=>'/mbti'],
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
echo autoLink($html, 'love-style-'.$item['slug']);
?>
