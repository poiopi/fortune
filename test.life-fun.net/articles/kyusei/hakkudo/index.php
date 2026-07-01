<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';
ob_start();
    $listUrl   = '/articles/kyusei/#nine-stars';
    $listTitle = '九星一覧';
    $prevTitle = '七赤金星'; $prevUrl = '/articles/kyusei/shichiseki/'; $prevLabel = null;
    $nextTitle = '九紫火星'; $nextUrl = '/articles/kyusei/kyushi/'; $nextLabel = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/kyusei/hakkudo/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="九星気学「八白土星」の意味を解説。土の気を持つ第8星が守護する人の性格・変革力・恋愛・仕事・開運のヒントを紹介します。">
  <title>八白土星とは｜九星気学・山の不動が宿す誠実と変革の開運ガイド</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/article-components.css">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{--ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;--accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;--text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f2eeff;--card-bg:#ffffff;--star-color:#fff8e1;--star-text:#e65100;}
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
  .tips-box{background:linear-gradient(135deg,#fff8e1 0%,#e8f5e9 100%);border:1px solid #a5d6a7;border-radius:12px;padding:1.5rem;margin-top:1rem}
  .tips-box h3{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#33691e;margin-bottom:1rem}
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
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},{"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},{"@type":"ListItem","position":3,"name":"九星気学解説","item":"https://life-fun.net/articles/kyusei/"},{"@type":"ListItem","position":4,"name":"八白土星","item":"https://life-fun.net/articles/kyusei/hakkudo/"}]}</script>
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/kyusei/">九星気学</a><span>›</span>八白土星
  </nav>
  <div class="art-hero">
    <span class="art-label">KYUSEI KIGAKU · 第8星</span>
    <div class="star-badge">🏔️ 土 · 第8星</div>
    <h1>八白土星とは<br>山の不動が宿す誠実と変革</h1>
    <p class="art-lead">八白土星は九星気学の第8星。土の気を持ち、不動・変革・誠実・蓄積をキーワードとする星です。山のように揺るぎない不動の意志と、時機を見計らって大きく変わる変革力を併せ持ちます。</p>
    <div class="kw-tags"><span class='kw-tag'>不動</span><span class='kw-tag'>変革</span><span class='kw-tag'>誠実</span><span class='kw-tag'>蓄積</span><span class='kw-tag'>土の気</span></div>
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
      <li><a href="#about">八白土星とは</a></li>
      <li><a href="#traits">性格・特徴</a></li>
      <li><a href="#luck">恋愛・仕事・金運</a></li>
      <li><a href="#fortune">開運のヒント</a></li>
      <li><a href="#compatibility">相性</a></li>
      <li><a href="#faq">よくある質問</a></li>
    </ol>
  </nav>
  <section class="art-section" id="about">
    <h2>八白土星とは</h2>
    <p>八白土星（はっぱくどせい）は九星気学の第8星で、五行では「土」の気を持ちます。山・変化・移り変わりを象徴する星で、「山は動かないが、長い時間をかけて形を変える」という性質を持ちます。</p><p>普段は非常に堅固で動じませんが、決断した時の行動は大きく、周囲を驚かせるほどの変化を起こします。この「不動と変革」の二面性が八白土星の最大の特徴です。</p><p>誠実さと蓄積を大切にするため、長期的な視点で物事を積み上げていきます。若い頃は苦労が多くても、中年以降に大きく花開くことが多い星です。</p>
  </section>
  <section class="art-section" id="traits">
    <h2>性格・特徴</h2>
    <p>八白土星に生まれた人が持つ傾向と特性です。</p>
    <div class="trait-grid"><div class='trait-card'><div class='trait-label'>性格・気質</div><div class='trait-text'>誠実で粘り強い。外見は穏やかですが内面に強固な意志を持ち、一度決めたことは最後まで貫く。</div></div><div class='trait-card'><div class='trait-label'>強み</div><div class='trait-text'>蓄積力と変革力。長期にわたってコツコツ積み上げ、適切なタイミングで大きく変革できる。</div></div><div class='trait-card'><div class='trait-label'>思考スタイル</div><div class='trait-text'>慎重で長期的。短期の損得より長期の結果を重視し、じっくり時間をかけて判断する。</div></div><div class='trait-card'><div class='trait-label'>人間関係</div><div class='trait-text'>義理堅く誠実。一度結んだ縁を大切にし、長年の付き合いを重んじる。</div></div><div class='trait-card'><div class='trait-label'>弱点・注意点</div><div class='trait-text'>頑固になりやすい。一度決めたことを変えるのが苦手で、変化への対応が遅いことがある。</div></div><div class='trait-card'><div class='trait-label'>向いている分野</div><div class='trait-text'>不動産・建設・金融・製造・農業など、長期的な蓄積と安定が求められる分野。</div></div></div>
  </section>
  <section class="art-section" id="luck">
    <h2>恋愛・仕事・金運</h2>
    <h3>恋愛</h3><p>誠実で長続きする恋愛をするタイプです。外見から気持ちが読みにくいため「何を考えているかわからない」と言われることがありますが、内面では相手を深く想っています。</p><p>相性の良い星は火生土の関係にある九紫火星。土を剋す木星（三碧・四緑）とは価値観の違いが出やすいとされます。</p><h3>仕事</h3><p>地道な積み上げが評価される仕事で真価を発揮します。若いうちは苦労しても着実にステップアップし、中年以降に大きな地位・実績を得ることが多いです。不動産・建設・金融などとの縁が深いです。</p><h3>金運</h3><p>堅実な金銭感覚で着実に蓄積します。不動産・長期投資・安定資産への投資が向いています。一攫千金より「確実に増やす」アプローチが合っています。</p>
  </section>
  <section class="art-section" id="fortune">
    <h2>開運のヒント</h2>
    <div class="tips-box">
      <h3>🏔️ 八白土星の開運ポイント</h3>
      <p><strong>山・高い場所を訪れる</strong><br>山を象徴する八白土星は、山登り・高い場所への訪問でエネルギーが高まります。展望台や山頂からの景色を眺めることが開運になります。</p><p><strong>変化を恐れない</strong><br>不動を美徳とする八白土星ですが、「変えるべきときに変わる勇気」が開運のカギです。変化を積極的に受け入れることでエネルギーが解放されます。</p><p><strong>長期的な目標を立てる</strong><br>八白土星は短期目標より長期目標が合っています。10年後・20年後のビジョンを描き、コツコツ積み上げることが最大の開運行動です。</p><p><strong>ラッキーカラー：白・ベージュ・茶色</strong><br>山と土の気と共鳴する色が八白土星のエネルギーを高めます。</p>
    </div>
  </section>
  <section class="art-section" id="compatibility">
    <h2>相性</h2>
    <h3>相性の良い星（五行：火生土）</h3><p><strong>九紫火星</strong>との相性が良いとされます。火が土を生む関係から、九紫火星の直感力と八白土星の蓄積力が補い合います。同じ土星（二黒土星・五黄土星）とも価値観が合います。</p><h3>注意が必要な星（五行：木剋土）</h3><p><strong>三碧木星・四緑木星</strong>とは木が土を剋す関係から摩擦が生まれやすいとされます。</p><h3>同じ星同士（八白土星×八白土星）</h3><p>価値観が合い非常に安定した関係になります。ただし両者とも変化が苦手なため、関係がマンネリ化したときに工夫が必要です。</p>
  </section>
  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list"><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>八白土星はどんな性格ですか？</div><div class='faq-a'>誠実で粘り強く、長期的な視点で物事を積み上げるタイプです。普段は穏やかですが、決断したときの変革力は大きいです。若い頃の苦労が中年以降の大成につながる星とされます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>八白土星の吉方位は？</div><div class='faq-a'>年・月の九星盤によって変わります。当サイトの九星気学診断で生年月日を入力すると確認できます。</div></div><div class='faq-item'><div class='faq-q' onclick='toggleFaq(this)'>八白土星と相性の良い星は？</div><div class='faq-a'>火生土の関係から九紫火星との相性が良いとされます。同じ土星（二黒・五黄）とも安定した関係を築きやすいです。</div></div></div>
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
echo autoLink($html, 'hakkudo');
?>