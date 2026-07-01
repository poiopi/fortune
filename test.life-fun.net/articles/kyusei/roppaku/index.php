<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';
ob_start();
    $listUrl   = '/articles/kyusei/#nine-stars';
    $listTitle = '九星一覧';
    $prevTitle = '五黄土星'; $prevUrl = '/articles/kyusei/goko/'; $prevLabel = null;
    $nextTitle = '七赤金星'; $nextUrl = '/articles/kyusei/shichiseki/'; $nextLabel = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/kyusei/roppaku/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="九星気学「六白金星」の意味を解説。金の気を持つ第6星が守護する人の性格・完璧主義・恋愛・仕事・開運のヒントを紹介します。">
  <title>六白金星とは｜九星気学・天の意志が宿す完璧主義と開運のヒント</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/article-components.css">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{--ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;--accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;--text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f2eeff;--card-bg:#ffffff;--star-color:#e3f2fd;--star-text:#1565c0;}
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
  .tips-box{background:linear-gradient(135deg,#e3f2fd 0%,#e8eaf6 100%);border:1px solid #90caf9;border-radius:12px;padding:1.5rem;margin-top:1rem}
  .tips-box h3{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#0d47a1;margin-bottom:1rem}
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
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},{"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"九星気学解説","item":"https://life-fun.net/articles/kyusei/"},{"@type":"ListItem","position":4,"name":"六白金星","item":"https://life-fun.net/articles/kyusei/roppaku/"}]}</script>
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/kyusei/">九星気学</a><span>›</span>六白金星
  </nav>
  <div class="art-hero">
    <span class="art-label">KYUSEI KIGAKU · 第6星</span>
    <div class="star-badge">✨ 金 · 第6星</div>
    <h1>六白金星とは<br>天の意志が宿す完璧主義と統率力</h1>
    <p class="art-lead">六白金星は九星気学の第6星。金の気を持ち、完全主義・高貴・統率力・天運をキーワードとする星です。天の意志を体現するような高い志と、卓越した統率力で周囲を導く力があります。</p>
    <div class="kw-tags"><span class='kw-tag'>完全主義</span><span class='kw-tag'>高貴</span><span class='kw-tag'>統率力</span><span class='kw-tag'>天運</span><span class='kw-tag'>金の気</span></div>
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
      <li><a href="#about">六白金星とは</a></li>
      <li><a href="#traits">性格・特徴</a></li>
      <li><a href="#luck">恋愛・仕事・金運</a></li>
      <li><a href="#fortune">開運のヒント</a></li>
      <li><a href="#compatibility">相性</a></li>
      <li><a href="#faq">よくある質問</a></li>
    </ol>
  </nav>
  <section class="art-section" id="about">
    <h2>六白金星とは</h2>
    <p>六白金星（ろっぱくきんせい）は九星気学の第6星で、五行では「金」の気を持ちます。天・乾（けん）を象徴する星で、高い理想・強い意志・卓越したリーダーシップが特徴です。</p><p>金は輝き、純粋さを持ち、曲がらない強さを象徴します。この「純粋さと強さ」が六白金星の人の気質に現れます。妥協を嫌い、常に最高を目指す完璧主義的な傾向があります。</p><p>「天運」を持つとされ、努力が実を結ぶ際の規模が大きい星でもあります。高い理想を持ち続けることで、晩年に大きな成功を収めることが多いとされます。</p>
  </section>
  <section class="art-section" id="traits">
    <h2>性格・特徴</h2>
    <p>六白金星に生まれた人が持つ傾向と特性です。</p>
    <div class="trait-grid"><div class='trait-card'><div class='trait-label'>性格・気質</div><div class='trait-text'>誇り高く意志が強い。高い理想を持ち、妥協を嫌うストイックな面がある。</div></div><div class='trait-card'><div class='trait-label'>強み</div><div class='trait-text'>統率力と判断力。チームや組織をまとめる力があり、目標達成への推進力が高い。</div></div><div class='trait-card'><div class='trait-label'>思考スタイル</div><div class='trait-text'>論理的で原則重視。ルールや筋道を大切にし、正攻法で物事を進めようとする。</div></div><div class='trait-card'><div class='trait-label'>人間関係</div><div class='trait-text'>リーダー的立場になりやすい。高い基準を周囲にも求めるため、関係が窮屈になることも。</div></div><div class='trait-card'><div class='trait-label'>弱点・注意点</div><div class='trait-text'>完璧主義が強すぎると自他ともに苦しくなる。肩の力を抜くことが課題。</div></div><div class='trait-card'><div class='trait-label'>向いている分野</div><div class='trait-text'>経営者・管理職・法律家・医師・政治家など、高い責任と判断力が求められる分野。</div></div></div>
  </section>
  <section class="art-section" id="luck">
    <h2>恋愛・仕事・金運</h2>
    <h3>恋愛</h3><p>高い理想を持つため、理想のパートナー像がはっきりしており妥協しにくい面があります。一度愛した相手への誠実さは非常に高いですが、完璧を求めすぎて相手に窮屈さを感じさせることも。</p><p>相性の良い星は土生金の関係にある二黒土星・五黄土星・八白土星。金を剋す火星（九紫火星）とは意見が対立しやすいとされます。</p><h3>仕事</h3><p>組織のトップや管理職として最も輝きます。目標設定・チームマネジメント・高い品質管理が得意です。下積み期間は長いですが、努力が実ったときの評価は非常に高くなります。</p><h3>金運</h3><p>一攫千金より堅実な高収入を得るタイプです。高い職位・専門職・独立などを通じて、長期的に安定した収入を得る傾向があります。</p>
  </section>
  <section class="art-section" id="fortune">
    <h2>開運のヒント</h2>
    <div class="tips-box">
      <h3>✨ 六白金星の開運ポイント</h3>
      <p><strong>高い目標を持ち続ける</strong><br>六白金星は高い志があってこそ力を発揮します。妥協しない目標を掲げ続けることが最大の開運行動です。</p><p><strong>空・太陽・天に感謝する</strong><br>天を象徴する六白金星は、空を見上げる・太陽の光を浴びるなど「天」とつながる行動でエネルギーが高まります。</p><p><strong>完璧主義を手放す練習をする</strong><br>逆説的ですが、80点で手放す練習をすることで六白金星のエネルギーが解放されます。</p><p><strong>ラッキーカラー：金・白・シルバー</strong><br>金の気と共鳴する色が六白金星のエネルギーを高めます。</p>
    </div>
  </section>
  <section class="art-section" id="compatibility">
    <h2>相性</h2>
    <h3>相性の良い星（五行：土生金）</h3><p><strong>二黒土星・五黄土星・八白土星</strong>との相性が良いとされます。土が金を生む五行の関係から、安定と統率力が高め合われます。</p><h3>注意が必要な星（五行：火剋金）</h3><p><strong>九紫火星</strong>とは火が金を剋す関係から意見の対立が起きやすいとされます。お互いの強さが衝突しやすい組み合わせです。</p><h3>同じ星同士（六白金星×六白金星）</h3><p>高い志を共有できますが、二人ともリーダー気質のため主導権争いが生まれることがあります。</p>
  </section>
  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list"><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>六白金星はどんな性格ですか？</div><div class='faq-a'>誇り高く完璧主義で統率力がある星です。高い理想と強い意志を持ち、組織をまとめるリーダーシップがあります。天運を持つとされ、晩年に大きな成功を収めることが多いとされます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>六白金星の吉方位は？</div><div class='faq-a'>年・月の九星盤によって変わります。当サイトの九星気学診断で生年月日を入力すると確認できます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>六白金星と相性の良い星は？</div><div class='faq-a'>土生金の関係から二黒土星・五黄土星・八白土星との相性が良いとされます。</div></div></div>
  </section>
  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>六白金星は九星気学の第6星。金の気が示す統率・完璧主義・天・リーダーが基本キーワード。</li>
      <li>高い理想と完璧主義を持ち、組織の長として頂点を目指す気質。</li>
      <li>土星（二黒・五黄・八白）との相性が良く（土生金）、火星（九紫）とは注意（火剋金）。</li>
      <li>経営・管理職・法律・金融など、秩序と権威が求められる分野が向いている。</li>
      <li>柔軟性を意識し、完璧主義を手放す瞬間を作ることが開運のポイント。</li>
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
echo autoLink($html, 'roppaku');
?>