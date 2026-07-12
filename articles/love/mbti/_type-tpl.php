<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

// Style/Tendency名 → 記事slugの対応表（articles/love/style/index.php・
// articles/love/tendency/index.phpの$_PUBLISHEDと同じ対応）。
const MBTI_TPL_STYLE_SLUGS = [
  '積極性' => 'sekkyokusei-love',
  '愛情表現' => 'aijouhyougen-love',
  '包容力' => 'houyouryoku-love',
  '独占欲' => 'dokusenyoku-love',
  '惚れやすさ' => 'horeyasusa-love',
  '嫉妬深さ' => 'shittobukasa-love',
  '恋愛の慎重さ' => 'shinchousa-love',
];
const MBTI_TPL_TENDENCY_SLUGS = [
  '結婚志向' => 'kekkonshikou-love',
  '浮気耐性' => 'uwakitaisei-love',
];
// Primitive名 → Bundle記事slugの対応表（articles/love/bundle/配下）。
const MBTI_TPL_BUNDLE_SLUGS = [
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
  <link rel="canonical" href="https://life-fun.net/articles/love/mbti/<?= $type['slug'] ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($type['code']) ?>（<?= htmlspecialchars($type['name']) ?>）の恋愛傾向をLove Engineの実測データ（9216パターン分析）で解説。恋愛スタイル・結婚観・相性・浮気耐性の傾向を、なぜそうなるかという理由つきで紹介。">
  <title><?= htmlspecialchars($type['code']) ?>（<?= htmlspecialchars($type['name']) ?>）の恋愛傾向｜恋愛スタイル・結婚観をLove Engineで解説</title>
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
    --ff-serif:'Shippori Mincho',serif;
    --ff-sans:'Zen Kaku Gothic New',sans-serif;
    --ff-mono:'DM Mono',monospace;
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
  /* エンジン注記 */
  .engine-note{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1rem 1.25rem;margin:1.5rem 0;font-size:.82rem;color:var(--muted);line-height:1.8}
  .engine-note strong{color:var(--accent)}
  /* TOC */
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:2rem 0}
  .toc-title{font-size:.8rem;font-weight:500;color:var(--muted);letter-spacing:.1em;margin-bottom:.75rem;font-family:var(--ff-mono)}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.35rem}
  .toc li{font-size:.88rem}
  .toc a{color:var(--accent);text-decoration:none}
  .toc a:hover{text-decoration:underline}
  /* セクション */
  .art-section{padding:2.5rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-child{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}
  .art-section p:last-child{margin-bottom:0}
  .trait-list{display:flex;flex-direction:column;gap:.5rem;margin-top:.75rem}
  .trait-item{font-size:.9rem;padding:.6rem .9rem;border-radius:8px;line-height:1.7;background:#f0fbf4;border-left:3px solid #4caf7d;color:#1a3a2a}
  .trait-item.caution{background:#fff8ee;border-left:3px solid #e0a34c;color:#3a2a10}
  /* 因果チェーン */
  .causal-chain{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;margin:1.25rem 0;font-family:var(--ff-mono);font-size:.78rem}
  .causal-node{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:.4rem .8rem;color:var(--text)}
  .causal-arrow{color:var(--accent-lt)}
  /* Style/Tendency バー */
  .stat-list{display:flex;flex-direction:column;gap:1.1rem;margin-top:1.25rem}
  .stat-item-name{font-size:.88rem;font-weight:500;margin-bottom:.4rem;display:flex;justify-content:space-between}
  .stat-bar{display:flex;height:20px;border-radius:6px;overflow:hidden;background:var(--bg2)}
  .stat-seg{display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:#fff;white-space:nowrap;overflow:hidden}
  .stat-seg.high{background:var(--accent)}
  .stat-seg.mid{background:#b8a4e8}
  .stat-seg.low{background:#e5e3ee;color:var(--muted)}
  .stat-legend{display:flex;gap:1rem;font-size:.68rem;color:var(--muted);margin-top:.4rem;font-family:var(--ff-mono)}
  .stat-note{font-size:.82rem;color:#444;margin-top:.5rem;line-height:1.8}
  /* Bundle */
  .bundle-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.25rem 1.5rem;margin:1.25rem 0}
  .bundle-pct{font-family:var(--ff-mono);font-size:1.8rem;color:var(--accent);font-weight:400}
  /* 相性 */
  .compat-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .compat-box{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.25rem;display:grid;grid-template-columns:auto 1fr;gap:.5rem 1rem;align-items:start}
  .compat-badge{display:flex;flex-direction:column;align-items:center;gap:.25rem;min-width:56px}
  .compat-type-tag{font-family:var(--ff-mono);font-size:.85rem;font-weight:500;padding:.3rem .7rem;border-radius:6px;white-space:nowrap}
  .compat-type-tag.best{background:#e8f5e9;color:#2e7d32}
  .compat-type-tag.good{background:#e3f2fd;color:#1565c0}
  .compat-type-tag.caution{background:#fff3e0;color:#e65100}
  .compat-label-text{font-family:var(--ff-mono);font-size:.6rem;color:var(--muted);letter-spacing:.08em;text-align:center}
  .compat-reason{font-size:.85rem;color:#444;line-height:1.8;padding-top:.1rem}
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
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"恋愛傾向診断","item":"https://life-fun.net/love"},
      {"@type":"ListItem","position":3,"name":"MBTI×恋愛","item":"https://life-fun.net/articles/love/mbti/"},
      {"@type":"ListItem","position":4,"name":"<?= htmlspecialchars($type['code'].'（'.$type['name'].'）の恋愛傾向') ?>","item":"https://life-fun.net/articles/love/mbti/<?= $type['slug'] ?>/"}
    ]
  }
  </script>
  <!--
    FAQPageスキーマは実装しない（docs/love/11-articles.md 1-1節）。
    FAQPageのリッチリザルトは2026-05-07付でGoogle検索から完全廃止済みのため、
    このFAQセクションは本文コンテンツとしてのみ提供する。
  -->
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
    <a href="/love">恋愛傾向診断</a><span>›</span>
    <a href="/articles/love/mbti/">MBTI×恋愛</a><span>›</span>
    <?= htmlspecialchars($type['code'].'（'.$type['name'].'）') ?>
  </nav>

  <div class="art-hero">
    <span class="art-label">MBTI × Love Engine</span>
    <h1><?= htmlspecialchars($type['code']) ?>（<?= htmlspecialchars($type['name']) ?>）の恋愛傾向｜恋愛スタイル・結婚観を実測データで解説</h1>
    <p class="art-lead"><?= htmlspecialchars($type['lead']) ?></p>
  </div>

  <div class="engine-note">
    このページの「Love Engineの実測データ」は、当サイトの恋愛傾向診断エンジン（<a href="/love" class="al-link">Love診断</a>）が持つ9216通りの組み合わせパターン（MBTI16 × 血液型4 × 星座144）のうち、<strong><?= htmlspecialchars($type['code']) ?>に該当する<?= (int)$type['sampleSize'] ?>パターン</strong>を集計した結果です。血液型・星座の組み合わせによって結果は変わるため、ここでの数値は「<?= htmlspecialchars($type['code']) ?>という性格タイプが持つ構造的な傾向」を表します。
  </div>

  <?php
  $ctaTitle = 'あなた自身の恋愛傾向を診断する';
  $ctaText  = 'MBTI×血液型×星座で、あなただけの恋愛スタイルを診断。';
  $ctaUrl   = '/love?mbti=' . urlencode($type['code']);
  $ctaBtn   = '恋愛傾向を診断する →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#features"><?= htmlspecialchars($type['code']) ?>の恋愛の特徴</a></li>
      <li><a href="#attracts">恋愛で魅力を発揮する場面</a></li>
      <li><a href="#struggles">苦手になりやすいポイント</a></li>
      <li><a href="#golden-master">Love Engineの実測データで見る傾向</a></li>
      <li><a href="#bundle">恋愛タイプの組み合わせ</a></li>
      <li><a href="#compat">相性の良いタイプ</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="features">
    <h2><?= htmlspecialchars($type['code']) ?>の恋愛の特徴</h2>
    <p><?= htmlspecialchars($type['features_lead']) ?></p>
    <p><?= htmlspecialchars($type['features_body']) ?></p>
  </section>

  <section class="art-section" id="attracts">
    <h2>恋愛で魅力を発揮する場面</h2>
    <div class="trait-list">
      <?php foreach($type['attracts'] as $a): ?>
      <div class="trait-item">✓ <?= htmlspecialchars($a) ?></div>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:1.25rem"><?= htmlspecialchars($type['attracts_body']) ?></p>
  </section>

  <section class="art-section" id="struggles">
    <h2>苦手になりやすいポイント</h2>
    <div class="trait-list">
      <?php foreach($type['struggles'] as $s): ?>
      <div class="trait-item caution">△ <?= htmlspecialchars($s) ?></div>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:1.25rem"><?= htmlspecialchars($type['struggles_body']) ?></p>
  </section>

  <section class="art-section" id="golden-master">
    <h2>Love Engineの実測データで見る<?= htmlspecialchars($type['code']) ?>の傾向</h2>
    <p><?= htmlspecialchars($type['causal_intro']) ?></p>

    <div class="causal-chain">
      <?php foreach($type['causal_letters'] as $i => $c): ?>
      <span class="causal-node"><?= htmlspecialchars($c['letter'].'（'.$c['label'].'）') ?></span>
      <span class="causal-arrow">→</span>
      <span class="causal-node"><?= htmlspecialchars($c['trait']) ?></span>
      <span class="causal-arrow">→</span>
      <span class="causal-node"><?= htmlspecialchars($c['primitive']) ?></span>
      <?php if ($i < count($type['causal_letters']) - 1): ?><span class="causal-arrow">／</span><?php endif; ?>
      <?php endforeach; ?>
    </div>
    <p><?= htmlspecialchars($type['causal_explanation']) ?></p>

    <h3>恋愛スタイル（Style）</h3>
    <div class="stat-list">
      <?php foreach($type['styles'] as $name => $s): ?>
      <div>
        <div class="stat-item-name"><span><?php if (isset(MBTI_TPL_STYLE_SLUGS[$name])): ?><a href="/articles/love/style/<?= MBTI_TPL_STYLE_SLUGS[$name] ?>/" class="al-link"><?= htmlspecialchars($name) ?></a><?php else: ?><?= htmlspecialchars($name) ?><?php endif; ?></span></div>
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
      <?php foreach($type['tendencies'] as $name => $t): ?>
      <div>
        <div class="stat-item-name"><span><?php if (isset(MBTI_TPL_TENDENCY_SLUGS[$name])): ?><a href="/articles/love/tendency/<?= MBTI_TPL_TENDENCY_SLUGS[$name] ?>/" class="al-link"><?= htmlspecialchars($name) ?></a><?php else: ?><?= htmlspecialchars($name) ?><?php endif; ?></span></div>
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

  <section class="art-section" id="bundle">
    <h2>恋愛タイプの組み合わせ（Bundle）</h2>
    <p><?= htmlspecialchars($type['bundle_intro']) ?></p>
    <?php
    $bp = $type['topBundle']['primary'];
    $bs = $type['topBundle']['secondary'];
    $bpLink = isset(MBTI_TPL_BUNDLE_SLUGS[$bp]) ? '<a href="/articles/love/bundle/'.MBTI_TPL_BUNDLE_SLUGS[$bp].'/" class="al-link">'.htmlspecialchars($bp).'</a>' : htmlspecialchars($bp);
    $bsLink = isset(MBTI_TPL_BUNDLE_SLUGS[$bs]) ? '<a href="/articles/love/bundle/'.MBTI_TPL_BUNDLE_SLUGS[$bs].'/" class="al-link">'.htmlspecialchars($bs).'</a>' : htmlspecialchars($bs);
    ?>
    <div class="bundle-box">
      <div class="bundle-pct"><?= $type['topBundle']['pct'] ?>%</div>
      <p style="margin-top:.5rem"><strong><?= $bpLink ?> × <?= $bsLink ?></strong>の組み合わせが最も多く出現します（<?= (int)$type['sampleSize'] ?>パターン中）。</p>
      <p style="margin-top:.5rem"><?= htmlspecialchars($type['topBundle']['note']) ?></p>
    </div>
  </section>

  <section class="art-section" id="compat">
    <h2>相性の良いタイプ</h2>
    <p class="stat-note" style="margin-bottom:1rem">ここではMBTI理論一般の相性傾向を紹介します（Golden Master実測ではなく一般論）。実際の相性は血液型・星座によっても変わるため、正確な傾向は<a href="/love" class="al-link">恋愛傾向診断</a>で確認できます。</p>
    <div class="compat-list">
      <?php foreach($type['compat'] as $c): ?>
      <div class="compat-box">
        <div class="compat-badge">
          <span class="compat-type-tag <?= htmlspecialchars($c['level']) ?>"><?= htmlspecialchars($c['type']) ?></span>
          <span class="compat-label-text"><?= htmlspecialchars($c['label']) ?></span>
        </div>
        <p class="compat-reason"><?= htmlspecialchars($c['reason']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <?php foreach($type['faq'] as $f): ?>
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
      <?php foreach($type['matome'] as $m): ?>
      <li><?= htmlspecialchars($m) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>

  <?php
  $ctaTitle = 'あなた自身はどうでしょう？';
  $ctaText  = 'MBTI×血液型×星座で、あなただけの恋愛傾向を診断できます。';
  $ctaUrl   = '/love?mbti=' . urlencode($type['code']);
  $ctaBtn   = '恋愛傾向診断はこちら →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?php
  $prevTitle = !empty($type['prev']) ? $type['prev']['title'] : null;
  $prevUrl   = !empty($type['prev']) ? $type['prev']['url'] : null;
  $nextTitle = !empty($type['next']) ? $type['next']['title'] : null;
  $nextUrl   = !empty($type['next']) ? $type['next']['url'] : null;
  $listTitle = 'MBTI×恋愛 一覧';
  $listUrl   = '/articles/love/mbti/';
  require __DIR__.'/../../../inc/article-nav.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <?php
    $relatedItems = [
      ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love?mbti=' . urlencode($type['code'])],
      ['label'=>'結果の見方', 'title'=>'Style・Bundleなど用語をまとめて理解する →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
      ['label'=>'Style指標一覧', 'title'=>'積極性・愛情表現など7指標を見る →', 'url'=>'/articles/love/style/'],
      ['label'=>$type['code'].'の性格', 'title'=>'性格・強み・仕事・相性を詳しく見る →', 'url'=>'/articles/mbti/'.$type['slug'].'/'],
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
echo autoLink($html, 'love-'.$type['slug']);
?>
