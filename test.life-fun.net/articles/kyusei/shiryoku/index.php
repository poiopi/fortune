<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';
ob_start();
    $listUrl   = '/articles/kyusei/#nine-stars';
    $listTitle = '九星一覧';
    $prevTitle = '三碧木星'; $prevUrl = '/articles/kyusei/sanpeki/'; $prevLabel = null;
    $nextTitle = '五黄土星'; $nextUrl = '/articles/kyusei/goko/'; $nextLabel = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/kyusei/shiryoku/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="九星気学「四緑木星」の意味を解説。木の気を持つ第4星が守護する人の性格・調和力・恋愛・仕事・開運のヒントを紹介します。">
  <title>四緑木星とは｜九星気学・風のように巡る調和と信頼の開運ガイド</title>
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
  .tips-box{background:linear-gradient(135deg,#e8f5e9 0%,#e0f2f1 100%);border:1px solid #80cbc4;border-radius:12px;padding:1.5rem;margin-top:1rem}
  .tips-box h3{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#004d40;margin-bottom:1rem}
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
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},{"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"九星気学解説","item":"https://life-fun.net/articles/kyusei/"},{"@type":"ListItem","position":4,"name":"四緑木星","item":"https://life-fun.net/articles/kyusei/shiryoku/"}]}</script>
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/kyusei/">九星気学</a><span>›</span>四緑木星
  </nav>
  <div class="art-hero">
    <span class="art-label">KYUSEI KIGAKU · 第4星</span>
    <div class="star-badge">🍃 木 · 第4星</div>
    <h1>四緑木星とは<br>風のように巡る調和と信頼</h1>
    <p class="art-lead">四緑木星は九星気学の第4星。木の気を持ち、調和・社交性・信頼・旅運をキーワードとする星です。風のように広くしなやかに関係を結び、人と人をつなぐ架け橋として力を発揮します。</p>
    <div class="kw-tags"><span class='kw-tag'>調和</span><span class='kw-tag'>社交性</span><span class='kw-tag'>信頼</span><span class='kw-tag'>旅運</span><span class='kw-tag'>木の気</span></div>
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
      <li><a href="#about">四緑木星とは</a></li>
      <li><a href="#traits">性格・特徴</a></li>
      <li><a href="#luck">恋愛・仕事・金運</a></li>
      <li><a href="#fortune">開運のヒント</a></li>
      <li><a href="#compatibility">相性</a></li>
      <li><a href="#faq">よくある質問</a></li>
    </ol>
  </nav>
  <section class="art-section" id="about">
    <h2>四緑木星とは</h2>
    <p>四緑木星（しりょくもくせい）は九星気学の第4星で、五行では「木」の気を持ちます。風に揺れる木々や、旅をする風を象徴する星です。柔軟に方向を変え、どんな場所にも適応できる社交性と調和力が特徴です。</p><p>三碧木星が「雷」なら四緑木星は「風」。強引に突き進むより、周囲との調和を図りながら進む柔軟なスタイルです。人との縁を大切にし、信頼関係をゆっくり丁寧に育てます。</p><p>旅や移動との縁が深く、遠方や海外との関わりで運が開けることが多い星でもあります。</p>
  </section>
  <section class="art-section" id="traits">
    <h2>性格・特徴</h2>
    <p>四緑木星に生まれた人が持つ傾向と特性です。</p>
    <div class="trait-grid"><div class='trait-card'><div class='trait-label'>性格・気質</div><div class='trait-text'>穏やかで社交的。場の空気を読み、誰とでも自然に馴染める適応力がある。</div></div><div class='trait-card'><div class='trait-label'>強み</div><div class='trait-text'>コミュニケーション力と調整力。対立する意見を上手くまとめ、円滑な人間関係を作る。</div></div><div class='trait-card'><div class='trait-label'>思考スタイル</div><div class='trait-text'>柔軟で協調的。一つの考えに固執せず、様々な視点を取り入れながら判断する。</div></div><div class='trait-card'><div class='trait-label'>人間関係</div><div class='trait-text'>広い交友関係を持ち、異なる属性の人をつなぐネットワーカー的存在。</div></div><div class='trait-card'><div class='trait-label'>弱点・注意点</div><div class='trait-text'>優柔不断になりやすい。調和を重んじるあまり、自分の意見を言えないことがある。</div></div><div class='trait-card'><div class='trait-label'>向いている分野</div><div class='trait-text'>外交・貿易・旅行業・コンサル・広報・仲介業など、人と人をつなぐ仕事。</div></div></div>
  </section>
  <section class="art-section" id="luck">
    <h2>恋愛・仕事・金運</h2>
    <h3>恋愛</h3><p>自然体で人を惹きつける魅力があります。恋愛においても調和を大切にし、争いを嫌います。相手の気持ちに寄り添える一方で、はっきり意見を言えずに関係が曖昧になりやすい面があります。</p><p>相性の良い星は水生木の関係にある一白水星と、同じ木のエネルギーを持つ三碧木星。金剋木の関係から六白・七赤金星とは注意が必要です。</p><h3>仕事</h3><p>調整役・橋渡し役として組織の中心になりやすいです。営業・交渉・コーディネートなど、人と人をつなぐ仕事で実力を発揮します。また旅行や遠方との縁も深く、出張の多い仕事や海外ビジネスで運が開けます。</p><h3>金運</h3><p>人付き合いへの出費が多くなりがちです。交際費・旅費など「縁」にまつわる支出が多い一方、人脈から得られる収入チャンスも豊富です。</p>
  </section>
  <section class="art-section" id="fortune">
    <h2>開運のヒント</h2>
    <div class="tips-box">
      <h3>🍃 四緑木星の開運ポイント</h3>
      <p><strong>旅に出る</strong><br>四緑木星は「旅運」が強い星です。遠方への旅行・小旅行・新しい場所への外出が運気を大きく上げます。</p><p><strong>人との縁を大切にする</strong><br>四緑木星は人脈から運が開く星です。久しぶりの人への連絡・新しい出会いへの積極的な参加が開運につながります。</p><p><strong>風通しを良くする</strong><br>部屋の換気・整理整頓・不要なものの処分など、空間に流れを作ることが四緑木星のエネルギーを高めます。</p><p><strong>ラッキーカラー：緑・白・空色</strong><br>風と木の気と共鳴する色が四緑木星のエネルギーを高めます。</p>
    </div>
  </section>
  <section class="art-section" id="compatibility">
    <h2>相性</h2>
    <h3>相性の良い星（五行：水生木）</h3><p><strong>一白水星・三碧木星</strong>との相性が良いとされます。一白水星の知性が四緑木星の社交性と調和し、三碧木星とは木同士で似た価値観を持ちます。</p><h3>注意が必要な星（五行：金剋木）</h3><p><strong>六白金星・七赤金星</strong>とは金が木を剋す関係から摩擦が生まれやすいとされます。</p><h3>同じ星同士（四緑木星×四緑木星）</h3><p>穏やかで居心地の良い関係になりますが、どちらも決断が苦手なため重要な場面での決断をどちらが主導するかが課題です。</p>
  </section>
  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list"><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>四緑木星はどんな性格ですか？</div><div class='faq-a'>社交的で調和を大切にするタイプです。誰とでも自然に馴染める適応力があり、人と人をつなぐ橋渡し役として活躍します。旅や移動との縁も深い星です。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>四緑木星の吉方位は？</div><div class='faq-a'>年・月の九星盤によって変わります。当サイトの九星気学診断で生年月日を入力すると確認できます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>四緑木星と相性の良い星は？</div><div class='faq-a'>水生木の関係から一白水星との相性が良く、同じ木星の三碧木星とも価値観が合います。</div></div></div>
  </section>
  <?php require __DIR__.'/../../../inc/article-cta.php'; ?>
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
  <?php require __DIR__.'/../../../inc/article-nav.php'; ?>
</div>
<script>function toggleFaq(el){ el.parentElement.classList.toggle('open'); }</script>
<?php $currentSlug='kyusei'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'shiryoku');
?>