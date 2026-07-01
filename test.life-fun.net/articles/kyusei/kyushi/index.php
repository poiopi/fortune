<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';
ob_start();
    $listUrl   = '/articles/kyusei/#nine-stars';
    $listTitle = '九星一覧';
    $prevTitle = '八白土星'; $prevUrl = '/articles/kyusei/hakkudo/'; $prevLabel = null;
    $nextTitle = null; $nextUrl = null; $nextLabel = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/kyusei/kyushi/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="九星気学「九紫火星」の意味を解説。火の気を持つ第9星が守護する人の性格・直感力・恋愛・仕事・開運のヒントを紹介します。">
  <title>九紫火星とは｜九星気学・太陽の炎が宿す直感と名誉の開運ガイド</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/article-components.css">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{--ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;--accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;--text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f2eeff;--card-bg:#ffffff;--star-color:#fce4ec;--star-text:#b71c1c;}
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
  .tips-box{background:linear-gradient(135deg,#fce4ec 0%,#fff8e1 100%);border:1px solid #ef9a9a;border-radius:12px;padding:1.5rem;margin-top:1rem}
  .tips-box h3{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#b71c1c;margin-bottom:1rem}
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
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},{"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"九星気学解説","item":"https://life-fun.net/articles/kyusei/"},{"@type":"ListItem","position":4,"name":"九紫火星","item":"https://life-fun.net/articles/kyusei/kyushi/"}]}</script>
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/kyusei/">九星気学</a><span>›</span>九紫火星
  </nav>
  <div class="art-hero">
    <span class="art-label">KYUSEI KIGAKU · 第9星</span>
    <div class="star-badge">🔥 火 · 第9星</div>
    <h1>九紫火星とは<br>太陽の炎が宿す直感と名誉</h1>
    <p class="art-lead">九紫火星は九星気学の第9星。火の気を持ち、直感・美意識・名誉・変化をキーワードとする星です。太陽のように輝く存在感と鋭い直感で、美しいものを見分け、時代の変化を先取りする力があります。</p>
    <div class="kw-tags"><span class='kw-tag'>直感</span><span class='kw-tag'>美意識</span><span class='kw-tag'>名誉</span><span class='kw-tag'>変化</span><span class='kw-tag'>火の気</span></div>
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
      <li><a href="#about">九紫火星とは</a></li>
      <li><a href="#traits">性格・特徴</a></li>
      <li><a href="#luck">恋愛・仕事・金運</a></li>
      <li><a href="#fortune">開運のヒント</a></li>
      <li><a href="#compatibility">相性</a></li>
      <li><a href="#faq">よくある質問</a></li>
    </ol>
  </nav>
  <section class="art-section" id="about">
    <h2>九紫火星とは</h2>
    <p>九紫火星（きゅうしかせい）は九星気学の第9星で、五行では「火」の気を持ちます。太陽・炎・光明を象徴する星で、輝くような存在感と鋭い直感力が特徴です。</p><p>火は光をもたらし、周囲を照らします。この「明るさと照射」の性質が九紫火星の人の気質に現れます。自然と注目を集め、美しいものへの鋭い審美眼を持ちます。</p><p>変化との縁が深く、時代の流れを敏感に察知する感覚があります。また名誉・評判との関わりが強く、社会的な評価が運気に大きく影響する星でもあります。</p>
  </section>
  <section class="art-section" id="traits">
    <h2>性格・特徴</h2>
    <p>九紫火星に生まれた人が持つ傾向と特性です。</p>
    <div class="trait-grid"><div class='trait-card'><div class='trait-label'>性格・気質</div><div class='trait-text'>華やかで感受性が豊か。美しいものへの審美眼が高く、センスの良さが際立つ。</div></div><div class='trait-card'><div class='trait-label'>強み</div><div class='trait-text'>直感力と表現力。言語化しにくい本質を瞬時に掴み、それを魅力的に表現する力がある。</div></div><div class='trait-card'><div class='trait-label'>思考スタイル</div><div class='trait-text'>直感重視。じっくり分析するより「ピンとくる」感覚を信じて行動する。</div></div><div class='trait-card'><div class='trait-label'>人間関係</div><div class='trait-text'>華やかさで人を惹きつける。ただし感情の起伏が激しいため関係が不安定になることも。</div></div><div class='trait-card'><div class='trait-label'>弱点・注意点</div><div class='trait-text'>感情的になりやすい。気分の波が激しく、良いときと悪いときの落差が大きい。</div></div><div class='trait-card'><div class='trait-label'>向いている分野</div><div class='trait-text'>デザイン・ファッション・芸術・芸能・教育・メディアなど、美と表現に関わる分野。</div></div></div>
  </section>
  <section class="art-section" id="luck">
    <h2>恋愛・仕事・金運</h2>
    <h3>恋愛</h3><p>華やかな雰囲気で異性を惹きつける魅力があります。情熱的な恋愛をしますが、感情の波が激しく関係が揺れやすい面も。相手の気持ちを大切にしながら、自分の感情を安定させることが長続きのカギです。</p><p>相性の良い星は木生火の関係にある三碧木星・四緑木星。火を剋す水星（一白水星）とは意見が合わない場面もあります。</p><h3>仕事</h3><p>クリエイティブ・美的センスが問われる分野で才能を発揮します。デザイン・ファッション・芸術・メディアなどで評価されやすいです。名誉・評判との縁が深いため、社会的な知名度が上がることで運気が高まります。</p><h3>金運</h3><p>大きく入って大きく出ていく動的な金銭感覚を持ちます。一時的に大きな収入を得ることがある一方、散財しやすい面も。美的なものへの出費には特に注意が必要です。</p>
  </section>
  <section class="art-section" id="fortune">
    <h2>開運のヒント</h2>
    <div class="tips-box">
      <h3>🔥 九紫火星の開運ポイント</h3>
      <p><strong>美しいものに触れる</strong><br>九紫火星は美意識からエネルギーが高まります。美術館・コンサート・美しい景色・センスの良いインテリアなど、美に触れる機会を積極的に作りましょう。</p><p><strong>太陽の光を浴びる</strong><br>太陽を象徴する九紫火星は、日光浴・朝の光を浴びることでエネルギーが高まります。</p><p><strong>評判を大切にする</strong><br>名誉との縁が深い九紫火星は、社会的な評判が運気に直結します。誠実な言動・感謝の表現・丁寧なコミュニケーションが開運につながります。</p><p><strong>ラッキーカラー：赤・紫・オレンジ</strong><br>火の気と共鳴する色が九紫火星のエネルギーを高めます。</p>
    </div>
  </section>
  <section class="art-section" id="compatibility">
    <h2>相性</h2>
    <h3>相性の良い星（五行：木生火）</h3><p><strong>三碧木星・四緑木星</strong>との相性が良いとされます。木が火を生む関係から、木星のエネルギーが九紫火星の輝きを強めます。</p><h3>注意が必要な星（五行：水剋火）</h3><p><strong>一白水星</strong>とは水が火を剋す関係から意見の対立が起きやすいとされます。お互いの個性を尊重することが大切です。</p><h3>同じ星同士（九紫火星×九紫火星）</h3><p>情熱的で刺激的な関係になりますが、両者とも感情の波が激しいため衝突も多くなりやすいです。お互いに冷却期間を設けることが大切です。</p>
  </section>
  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list"><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>九紫火星はどんな性格ですか？</div><div class='faq-a'>華やかで感受性が豊か、直感力と美意識に優れたタイプです。太陽のような輝く存在感と、時代の変化を先取りする感覚を持ちます。名誉・評判との縁が深い星とされます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>九紫火星の吉方位は？</div><div class='faq-a'>年・月の九星盤によって変わります。当サイトの九星気学診断で生年月日を入力すると確認できます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>九紫火星と相性の良い星は？</div><div class='faq-a'>木生火の関係から三碧木星・四緑木星との相性が良いとされます。</div></div></div>
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
echo autoLink($html, 'kyushi');
?>