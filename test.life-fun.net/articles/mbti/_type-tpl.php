<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/auto-link.php';

// 全16タイプ（ナビゲーション用）
$_ALL_TYPES = [
  ['slug'=>'intj',  'code'=>'INTJ',  'name'=>'建築家'],
  ['slug'=>'intp',  'code'=>'INTP',  'name'=>'論理学者'],
  ['slug'=>'entj',  'code'=>'ENTJ',  'name'=>'指揮官'],
  ['slug'=>'entp',  'code'=>'ENTP',  'name'=>'討論者'],
  ['slug'=>'infj',  'code'=>'INFJ',  'name'=>'提唱者'],
  ['slug'=>'infp',  'code'=>'INFP',  'name'=>'仲介者'],
  ['slug'=>'enfj',  'code'=>'ENFJ',  'name'=>'主人公'],
  ['slug'=>'enfp',  'code'=>'ENFP',  'name'=>'運動家'],
  ['slug'=>'istj',  'code'=>'ISTJ',  'name'=>'管理者'],
  ['slug'=>'isfj',  'code'=>'ISFJ',  'name'=>'擁護者'],
  ['slug'=>'estj',  'code'=>'ESTJ',  'name'=>'幹部'],
  ['slug'=>'esfj',  'code'=>'ESFJ',  'name'=>'領事'],
  ['slug'=>'istp',  'code'=>'ISTP',  'name'=>'巨匠'],
  ['slug'=>'isfp',  'code'=>'ISFP',  'name'=>'冒険家'],
  ['slug'=>'estp',  'code'=>'ESTP',  'name'=>'起業家'],
  ['slug'=>'esfp',  'code'=>'ESFP',  'name'=>'エンターテイナー'],
];

// ナビ計算
$_count      = count($_ALL_TYPES);
$_slugs      = array_column($_ALL_TYPES, 'slug');
$_currentIdx = array_search($type['slug'], $_slugs);
$_prevType   = $_currentIdx > 0               ? $_ALL_TYPES[$_currentIdx - 1] : null;
$_nextType   = $_currentIdx < $_count - 1     ? $_ALL_TYPES[$_currentIdx + 1] : null;

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/mbti/<?= $type['slug'] ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($type['code']) ?>（<?= htmlspecialchars($type['name']) ?>）の性格・強み・弱み・恋愛・仕事・相性を詳しく解説。16タイプ性格診断の<?= htmlspecialchars($type['group']) ?>グループ。">
  <title><?= htmlspecialchars($type['code']) ?>（<?= htmlspecialchars($type['name']) ?>）の性格・特徴・恋愛・仕事を徹底解説｜MBTIガイド</title>
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
  /* 基本情報ボックス */
  .type-info-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.25rem 1.5rem;margin:1.5rem 0;display:grid;grid-template-columns:1fr 1fr;gap:.75rem}
  .type-info-item{font-size:.85rem}
  .type-info-label{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.2rem}
  .type-info-val{font-weight:500;color:var(--text)}
  .type-code-badge{font-family:var(--ff-mono);font-size:1.5rem;font-weight:400;color:var(--accent);letter-spacing:.15em}
  .type-kw-list{display:flex;flex-wrap:wrap;gap:.35rem;margin-top:.3rem}
  .type-kw-tag{font-size:.73rem;background:#ede9fb;color:var(--accent);padding:.2rem .6rem;border-radius:20px}
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
  /* 強み・弱みリスト */
  .trait-list{display:flex;flex-direction:column;gap:.5rem;margin-top:.75rem}
  .trait-item{font-size:.9rem;padding:.6rem .9rem;border-radius:8px;line-height:1.7}
  .trait-item.good{background:#f0fbf4;border-left:3px solid #4caf7d;color:#1a3a2a}
  .trait-item.bad{background:#fff5f5;border-left:3px solid #e57373;color:#3a1a1a}
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
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  @media(max-width:560px){
    .type-info-box{grid-template-columns:1fr}
    .compat-grid{grid-template-columns:1fr}
  }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      <?php foreach($type['faq'] as $i => $f): ?>
      {"@type":"Question","name":<?= json_encode($f['q'], JSON_UNESCAPED_UNICODE) ?>,"acceptedAnswer":{"@type":"Answer","text":<?= json_encode($f['a'], JSON_UNESCAPED_UNICODE) ?>}}<?= $i < count($type['faq'])-1 ? ',' : '' ?>
      <?php endforeach; ?>
    ]
  }
  </script>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},
      {"@type":"ListItem","position":3,"name":"MBTI診断とは","item":"https://life-fun.net/articles/mbti/"},
      {"@type":"ListItem","position":4,"name":"<?= htmlspecialchars($type['code'].'（'.$type['name'].'）') ?>","item":"https://life-fun.net/articles/mbti/<?= $type['slug'] ?>/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/mbti" class="art-back">🧠 MBTI×星座を診断する →</a>
  </div>
</header>

<div class="wrap">

  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span>
    <a href="/articles/">占い解説ガイド</a><span>›</span>
    <a href="/articles/mbti/">MBTI診断とは</a><span>›</span>
    <?= htmlspecialchars($type['code'].'（'.$type['name'].'）') ?>
  </nav>

  <div class="art-hero">
    <span class="art-label"><?= htmlspecialchars($type['group_color'].' '.$type['group'].'（'.$type['group_code'].'）· MBTI') ?></span>
    <h1><?= htmlspecialchars($type['code']) ?>（<?= htmlspecialchars($type['name']) ?>）の性格・特徴・恋愛・仕事を徹底解説</h1>
    <p class="art-lead"><?= htmlspecialchars($type['lead']) ?></p>
  </div>

  <div class="type-info-box">
    <div class="type-info-item" style="grid-column:1/-1">
      <div class="type-info-label">TYPE CODE</div>
      <div class="type-code-badge"><?= htmlspecialchars($type['code']) ?></div>
      <div style="font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;margin-top:.25rem"><?= htmlspecialchars($type['name']) ?></div>
    </div>
    <div class="type-info-item">
      <div class="type-info-label">GROUP</div>
      <div class="type-info-val"><?= htmlspecialchars($type['group_color'].' '.$type['group']) ?></div>
    </div>
    <div class="type-info-item">
      <div class="type-info-label">POPULATION</div>
      <div class="type-info-val"><?= htmlspecialchars($type['population']) ?></div>
    </div>
    <div class="type-info-item" style="grid-column:1/-1">
      <div class="type-info-label">KEYWORDS</div>
      <div class="type-kw-list">
        <?php foreach($type['keywords'] as $kw): ?>
        <span class="type-kw-tag"><?= htmlspecialchars($kw) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php
  $ctaTitle = 'あなたのMBTI×星座タイプを調べる';
  $ctaText  = '生年月日と簡単な質問に答えるだけで16タイプの詳細解説が出力。';
  $ctaUrl   = '/mbti';
  $ctaBtn   = 'MBTI×星座を診断する →';
  require __DIR__.'/../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#strengths">強み</a></li>
      <li><a href="#weaknesses">弱み・課題</a></li>
      <li><a href="#love">恋愛傾向</a></li>
      <li><a href="#work">仕事・キャリア</a></li>
      <li><a href="#compat">相性</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="strengths">
    <h2>強み</h2>
    <div class="trait-list">
      <?php foreach($type['strengths'] as $s): ?>
      <div class="trait-item good">✓ <?= htmlspecialchars($s) ?></div>
      <?php endforeach; ?>
    </div>
    <?php if(!empty($type['strengths_body'])): ?>
    <p style="margin-top:1.25rem"><?= htmlspecialchars($type['strengths_body']) ?></p>
    <?php endif; ?>
  </section>

  <section class="art-section" id="weaknesses">
    <h2>弱み・課題</h2>
    <div class="trait-list">
      <?php foreach($type['weaknesses'] as $w): ?>
      <div class="trait-item bad">△ <?= htmlspecialchars($w) ?></div>
      <?php endforeach; ?>
    </div>
    <?php if(!empty($type['weaknesses_body'])): ?>
    <p style="margin-top:1.25rem"><?= htmlspecialchars($type['weaknesses_body']) ?></p>
    <?php endif; ?>
  </section>

  <section class="art-section" id="love">
    <h2>恋愛傾向</h2>
    <p><?= htmlspecialchars($type['love_lead']) ?></p>
    <p><?= htmlspecialchars($type['love_body']) ?></p>
  </section>

  <section class="art-section" id="work">
    <h2>仕事・キャリア</h2>
    <p><?= htmlspecialchars($type['work_lead']) ?></p>
    <p><?= htmlspecialchars($type['work_body']) ?></p>
  </section>

  <section class="art-section" id="compat">
    <h2>相性</h2>
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
  $ctaTitle = 'あなたのMBTI×星座タイプを調べる';
  $ctaText  = '生年月日と簡単な質問に答えるだけで16タイプの詳細解説が出力。';
  $ctaUrl   = '/mbti';
  $ctaBtn   = 'MBTI×星座を診断する →';
  require __DIR__.'/../../inc/article-cta.php';
  ?>

  <?php
  $prevTitle = $_prevType ? $_prevType['code'].'（'.$_prevType['name'].'）' : null;
  $prevUrl   = $_prevType ? '/articles/mbti/'.$_prevType['slug'].'/' : null;
  $nextTitle = $_nextType ? $_nextType['code'].'（'.$_nextType['name'].'）' : null;
  $nextUrl   = $_nextType ? '/articles/mbti/'.$_nextType['slug'].'/' : null;
  $listTitle = '16タイプ一覧';
  $listUrl   = '/articles/mbti/#types';
  require __DIR__.'/../../inc/article-nav.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <?php
    $relatedItems = [
      ['label'=>'MBTI診断とは', 'title'=>'16タイプ完全ガイドを読む →', 'url'=>'/articles/mbti/'],
      ['label'=>'数秘術とは',   'title'=>'運命数の計算方法と意味を解説 →', 'url'=>'/articles/numerology/'],
      ['label'=>'九星気学とは', 'title'=>'生まれ年でわかる9つの気質を解説 →', 'url'=>'/articles/kyusei/'],
      ['label'=>'星座とは',     'title'=>'12星座の特徴と相性を解説 →', 'url'=>'/articles/seiza/'],
    ];
    require __DIR__.'/../../inc/article-related.php';
    ?>
  </section>

</div>

<script>
function toggleFaq(el){
  el.parentElement.classList.toggle('open');
}
</script>

<?php $currentSlug='mbti'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, $type['slug']);
?>
