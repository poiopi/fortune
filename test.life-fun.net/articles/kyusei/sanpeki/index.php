<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';
ob_start();
    $listUrl   = '/articles/kyusei/#nine-stars';
    $listTitle = '九星一覧';
    $prevTitle = '二黒土星'; $prevUrl = '/articles/kyusei/nikoku/'; $prevLabel = null;
    $nextTitle = '四緑木星'; $nextUrl = '/articles/kyusei/shiryoku/'; $nextLabel = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/kyusei/sanpeki/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="九星気学「三碧木星」の意味を解説。木の気を持つ第3星が守護する人の性格・行動力・恋愛・仕事・開運のヒントを紹介します。">
  <title>三碧木星とは｜九星気学・春の雷鳴が宿す行動力と開運のヒント</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/article-components.css">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{--ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;--accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;--text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f2eeff;--card-bg:#ffffff;--star-color:#e8f5e9;--star-text:#2e7d32;}
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
  .breadcrumb a{color:var(--muted);text-decoration:none}.breadcrumb a:hover{color:var(--accent)}.breadcrumb span{margin:0 .4rem}
  .art-hero{padding:2rem 0 1.5rem;border-bottom:1px solid var(--border)}
  .art-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}
  .star-badge{display:inline-flex;align-items:center;gap:.5rem;background:var(--star-color);color:var(--star-text);font-family:var(--ff-mono);font-size:.75rem;font-weight:500;padding:.35rem .9rem;border-radius:20px;margin-bottom:1rem}
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:2rem 0}
  .toc-title{font-size:.8rem;font-weight:500;color:var(--muted);letter-spacing:.1em;margin-bottom:.75rem;font-family:var(--ff-mono)}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.35rem}
  .toc li{font-size:.88rem}.toc a{color:var(--accent);text-decoration:none}.toc a:hover{text-decoration:underline}
  .art-section{padding:2.5rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-child{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}.art-section p:last-child{margin-bottom:0}
  .trait-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:.75rem;margin-top:1rem}
  .trait-card{background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1rem 1.1rem}
  .trait-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.12em;color:var(--accent);text-transform:uppercase;margin-bottom:.4rem}
  .trait-text{font-size:.88rem;color:#333;line-height:1.7}
  .tips-box{background:linear-gradient(135deg,#e8f5e9 0%,#f1f8e9 100%);border:1px solid #a5d6a7;border-radius:12px;padding:1.5rem;margin-top:1rem}
  .tips-box h3{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#1b5e20;margin-bottom:1rem}
  .tips-box p{font-size:.9rem;color:#333;line-height:1.85;margin-bottom:.75rem}.tips-box p:last-child{margin-bottom:0}
  .kw-tags{display:flex;flex-wrap:wrap;gap:.4rem;margin:.75rem 0}
  .kw-tag{font-size:.75rem;background:var(--bg2);border:1px solid var(--border);color:var(--accent);padding:.2rem .7rem;border-radius:20px;font-family:var(--ff-mono)}
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:400px;padding:.9rem 1.1rem}
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}.al-link:hover{color:var(--accent-lt)}
  </style>
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},{"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"九星気学解説","item":"https://life-fun.net/articles/kyusei/"},{"@type":"ListItem","position":4,"name":"三碧木星","item":"https://life-fun.net/articles/kyusei/sanpeki/"}]}</script>
</head>
<body>
<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/kyusei" class="art-back">⭐ 本命星を調べる →</a>
  </div>
</header>
<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/kyusei/">九星気学</a><span>›</span>三碧木星
  </nav>
  <div class="art-hero">
    <span class="art-label">KYUSEI KIGAKU · 第3星</span>
    <div class="star-badge">🌿 木 · 第3星</div>
    <h1>三碧木星とは<br>春の雷鳴が宿す行動力と開運</h1>
    <p class="art-lead">三碧木星は九星気学の第3星。木の気を持ち、行動力・独創性・情熱・積極性をキーワードとする星です。春の雷のように突然に動き出し、周囲を驚かせるほどのエネルギーで道を切り開いていきます。</p>
    <div class="kw-tags"><span class='kw-tag'>行動力</span><span class='kw-tag'>独創性</span><span class='kw-tag'>情熱</span><span class='kw-tag'>積極性</span><span class='kw-tag'>木の気</span></div>
  </div>
  <?php
$ctaTitle = '⭐ 自分の本命星を調べてみる';
$ctaText  = '生年月日を入力するだけ。吉方位・運勢・性格まで無料で表示。';
$ctaUrl   = '/kyusei';
$ctaBtn   = '九星気学を診断する →';
require __DIR__.'/../../../inc/article-cta.php';
  ?>
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">三碧木星とは</a></li>
      <li><a href="#traits">性格・特徴</a></li>
      <li><a href="#luck">恋愛・仕事・金運</a></li>
      <li><a href="#fortune">開運のヒント</a></li>
      <li><a href="#compatibility">相性</a></li>
      <li><a href="#faq">よくある質問</a></li>
    </ol>
  </nav>
  <section class="art-section" id="about">
    <h2>三碧木星とは</h2>
    <p>三碧木星（さんぺきもくせい）は九星気学の第3星で、五行では「木」の気を持ちます。春の若木と雷鳴を象徴する星で、突破力・独創性・スピード感が特徴です。</p><p>木は上へ上へと伸びようとします。この「成長と突進」の性質が三碧木星の人の気質に現れます。アイデアが次々と湧き、思い立ったらすぐ行動に移す推進力があります。</p><p>感受性が豊かで芸術的センスも高く、常識に縛られない独自の発想で周囲を驚かせることがあります。</p>
  </section>
  <section class="art-section" id="traits">
    <h2>性格・特徴</h2>
    <p>三碧木星に生まれた人が持つ傾向と特性です。</p>
    <div class="trait-grid"><div class='trait-card'><div class='trait-label'>性格・気質</div><div class='trait-text'>明るく積極的。新しいことへの好奇心が旺盛で、思い立ったらすぐ行動に移す推進力を持つ。</div></div><div class='trait-card'><div class='trait-label'>強み</div><div class='trait-text'>スピードと独創性。人が思いつかないアイデアを即座に形にする実行力がある。</div></div><div class='trait-card'><div class='trait-label'>思考スタイル</div><div class='trait-text'>直感重視。じっくり考えるより「まずやってみる」行動先行型。</div></div><div class='trait-card'><div class='trait-label'>人間関係</div><div class='trait-text'>社交的で初対面でも打ち解けやすい。ただし深い長期的な関係が苦手なことも。</div></div><div class='trait-card'><div class='trait-label'>弱点・注意点</div><div class='trait-text'>継続力が弱点。熱しやすく冷めやすいため途中で興味が移りやすい。</div></div><div class='trait-card'><div class='trait-label'>向いている分野</div><div class='trait-text'>起業・クリエイティブ職・メディア・営業・エンタメなど、スピードと独創性が活きる分野。</div></div></div>
  </section>
  <section class="art-section" id="luck">
    <h2>恋愛・仕事・金運</h2>
    <h3>恋愛</h3><p>積極的に動くタイプで、気になった相手に素直にアプローチします。恋愛のスタートは早いですが、熱が冷めると関係が停滞することも。相手を飽きさせない工夫と長期的な視点を持つことが大切です。</p><p>相性の良い星は水生木の関係にある一白水星。木を剋す金星（六白・七赤）とは衝突が生まれやすい面があります。</p><h3>仕事</h3><p>アイデア出しやプロジェクトの立ち上げ期に最も力を発揮します。ゼロから何かを生み出す仕事・新規開拓・スタートアップ環境が向いています。ルーティン作業や細かい管理業務は苦手な傾向があります。</p><h3>金運</h3><p>入ってきたら使う動的な金銭感覚を持ちます。臨時収入が入りやすい一方、衝動買いや勢いでの散財に注意が必要です。</p>
  </section>
  <section class="art-section" id="fortune">
    <h2>開運のヒント</h2>
    <div class="tips-box">
      <h3>🌿 三碧木星の開運ポイント</h3>
      <p><strong>新しいことを始める</strong><br>三碧木星は「始まり」のエネルギーが強い星です。新しい趣味・習慣・学習を積極的にスタートさせることでエネルギーが高まります。</p><p><strong>声に出す・発信する</strong><br>SNS発信・歌・会話など、声を使うことが運気を上げます。</p><p><strong>朝の時間を大切にする</strong><br>春の夜明けを象徴する三碧木星は朝のエネルギーが最も高まります。朝早く起きてアクティブに動くことが開運につながります。</p><p><strong>ラッキーカラー：青・緑・水色</strong><br>木の気と共鳴する色が三碧木星のエネルギーを高めます。</p>
    </div>
  </section>
  <section class="art-section" id="compatibility">
    <h2>相性</h2>
    <h3>相性の良い星（五行：水生木）</h3><p><strong>一白水星</strong>との相性が良いとされます。水が木を育てる関係から、一白水星の知性と三碧木星の行動力が補い合います。同じ木星（四緑木星）とも似た価値観で理解し合えます。</p><h3>注意が必要な星（五行：金剋木）</h3><p><strong>六白金星・七赤金星</strong>とは金が木を剋す関係から摩擦が生まれやすいとされます。</p><h3>同じ星同士（三碧木星×三碧木星）</h3><p>お互いのエネルギーが共鳴し非常に活発な関係になります。ただし両者とも継続力が課題のため、最後まで完走するための工夫が必要です。</p>
  </section>
  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list"><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>三碧木星はどんな性格ですか？</div><div class='faq-a'>行動力があり積極的、独創的なアイデアと情熱を持つタイプです。スピードを重視し思い立ったらすぐ動く推進力がありますが、継続力が弱点になることがあります。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>三碧木星の吉方位は？</div><div class='faq-a'>年・月の九星盤によって変わります。当サイトの九星気学診断で生年月日を入力すると確認できます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>三碧木星と相性の良い星は？</div><div class='faq-a'>水生木の関係から一白水星との相性が良いとされます。同じ木星（四緑木星）とも価値観が合いやすいです。</div></div></div>
  </section>
  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>三碧木星は九星気学の第3星。木の気が示す行動力・情熱・先駆者・挑戦が基本キーワード。</li>
      <li>スピード感と直感力で真っ先に動く、九星随一のチャレンジャー気質。</li>
      <li>水星（一白）との相性が良く（水生木）、金星（六白・七赤）とは摩擦が生まれやすい（金剋木）。</li>
      <li>起業・営業・クリエイティブ・芸術など、スピードと発想力が活きる分野が向いている。</li>
      <li>新しいことに飛び込む経験の積み重ねが開運のポイント。</li>
    </ul>
  </section>
  <?php require __DIR__.'/../../../inc/article-cta.php'; ?>
  <?php require __DIR__.'/../../../inc/article-nav.php'; ?>
  <section class="art-section" id="related">
    <h2>他の九星を見る</h2>
    <?php
    $relatedItems = [
      ['label'=>'九星気学 完全ガイド', 'title'=>'本命星・月命星・吉方位の意味をわかりやすく解説 →', 'url'=>'/articles/kyusei/'],
      ['label'=>'四柱推命 解説', 'title'=>'命式・十神・大運・天中殺を詳しく知る →', 'url'=>'/articles/shichu/'],
      ['label'=>'算命学 解説', 'title'=>'宿命星・守護神・エネルギーの流れを読む →', 'url'=>'/articles/sanmei/'],
    ];
    require __DIR__.'/../../../inc/article-related.php';
    ?>
  </section>
</div>
<script>function toggleFaq(el){ el.parentElement.classList.toggle('open'); }</script>
<?php $currentSlug='kyusei'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'sanpeki');
?>