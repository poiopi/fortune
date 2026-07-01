<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/auto-link.php';
ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-P1EKB3WWX8');
  </script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/kyusei/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="九星気学とは何か、本命星・月命星・吉方位・9つの星の意味をわかりやすく解説。生年月日から本命星を調べる方法から九星それぞれの性格・特徴まで完全ガイド。">
  <title>九星気学とは？本命星・月命星・吉方位の意味をわかりやすく解説</title>
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
    --text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;
    --bg:#faf7ff;--bg2:#f2eeff;--card-bg:#ffffff;
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
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
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

  /* 九星グリッド */
  .star-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:.6rem;margin:1rem 0}
  .star-card{background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s}
  .star-card:hover{border-color:var(--accent-lt)}
  .star-num{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-bottom:.25rem}
  .star-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
  .star-elem{font-size:.72rem;padding:.15rem .5rem;border-radius:10px;display:inline-block;margin-bottom:.35rem}
  .star-kw{font-size:.75rem;color:var(--muted);line-height:1.6}
  .elem-water{background:#e0f7fa;color:#006064}
  .elem-earth{background:#fff8e1;color:#e65100}
  .elem-wood{background:#e8f5e9;color:#2e7d32}
  .elem-metal{background:#e3f2fd;color:#1565c0}
  .elem-fire{background:#fce4ec;color:#b71c1c}

  /* 吉方位テーブル */
  .dir-table{width:100%;border-collapse:collapse;margin:1rem 0;font-size:.83rem}
  .dir-table th{background:var(--bg2);border:1px solid var(--border);padding:.6rem .75rem;font-weight:600;color:var(--text);text-align:center}
  .dir-table td{border:1px solid var(--border);padding:.6rem .75rem;color:#333;vertical-align:top;line-height:1.6}
  .dir-table td:first-child{font-weight:500;color:var(--accent);text-align:center;white-space:nowrap}

  /* FAQ */
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:400px;padding:.9rem 1.1rem}

  
  
  
  
  

  @media(max-width:600px){
    
  }
.al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"九星気学と四柱推命の違いは何ですか？","acceptedAnswer":{"@type":"Answer","text":"四柱推命は生年月日時の4柱から詳細な命式を算出する占術で、性格・運命・大運の流れを精密に読みます。九星気学は生まれ年（節分基準）から本命星を導き、吉方位・運気の年サイクルを読むのが得意です。手軽さとサイクル把握は九星気学、深い命式分析は四柱推命と使い分けるのがおすすめです。"}},
      {"@type":"Question","name":"本命星はどうやって調べますか？","acceptedAnswer":{"@type":"Answer","text":"生まれた年の数字を足して1桁にし、11から引いた数が本命星の番号です。ただし九星気学では2月3日（節分）が年の切り替わりのため、1月1日〜2月3日生まれの方は前年で計算します。当サイトの九星気学診断で自動算出できます。"}},
      {"@type":"Question","name":"吉方位とは何ですか？","acceptedAnswer":{"@type":"Answer","text":"吉方位とは、本命星ごとに定まる「運気が上がりやすい方角」のことです。引越し・旅行・通勤ルートなどにこの方角を取り入れることで、運気向上を図ります。五黄殺・暗剣殺などの凶方位は避けることが推奨されます。"}},
      {"@type":"Question","name":"九星気学は毎年変わりますか？","acceptedAnswer":{"@type":"Answer","text":"本命星は一生変わりませんが、年・月ごとに盤が変化するため、運気の吉凶は毎年・毎月変わります。本命星が中宮（中央）に回座する年は特に重要な転機とされます。"}}
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
      {"@type":"ListItem","position":3,"name":"九星気学解説","item":"https://life-fun.net/articles/kyusei/"}
    ]
  }
  </script>
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>九星気学
  </nav>

  <div class="art-hero">
    <span class="art-label">KYUSEI KIGAKU · 完全ガイド</span>
    <h1>九星気学とは？<br>本命星・月命星・吉方位の意味をわかりやすく解説</h1>
    <p class="art-lead">九星気学は生年月日から「本命星」を算出し、性格・吉方位・運気の年サイクルを読む東洋の占術です。一白水星から九紫火星まで9つの星がそれぞれ異なる気質を持ち、毎年・毎月変わる九星盤から運気の流れを掴むことができます。</p>
  </div>

  <?php
$ctaTitle = '⭐ 自分の本命星を調べてみる';
$ctaText  = '生年月日を入力するだけ。吉方位・運勢・性格まで無料で表示。';
$ctaUrl   = '/kyusei';
$ctaBtn   = '九星気学を診断する →';
require __DIR__.'/../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">九星気学とは</a></li>
      <li><a href="#history">九星気学の歴史</a></li>
      <li><a href="#honmeisei">本命星・月命星とは</a></li>
      <li><a href="#nine-stars">九星（一白〜九紫）一覧</a></li>
      <li><a href="#direction">吉方位・凶方位とは</a></li>
      <li><a href="#setsubun">節分と年の切り替わり</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>九星気学とは</h2>
    <p>九星気学（きゅうせいきがく）は、一白水星・二黒土星・三碧木星・四緑木星・五黄土星・六白金星・七赤金星・八白土星・九紫火星の9つの星を使い、人の性格・運気・吉方位を読む占術です。</p>
    <p>四柱推命・算命学と並ぶ東洋三大占術のひとつで、<a href="/articles/shichu/" style="color:var(--accent)">四柱推命</a>が「命式の精密分析」に優れるのに対し、九星気学は「運気の年サイクルと方位」を読むのが得意です。</p>
    <p>生まれ年から求める「本命星」が基本となり、さらに生まれ月から「月命星」を求めることで、より詳細な性格分析ができます。方位学としても活用され、引越し・旅行・開業などのタイミングと方角を決める際に使われています。</p>
  </section>

  <section class="art-section" id="history">
    <h2>九星気学の歴史</h2>
    <p>九星気学の源流は中国古代の「洛書（らくしょ）」に遡ります。洛書は古代中国の亀の甲羅に刻まれた9つの数字の配列とされ、縦・横・斜めどの列も合計が15になる「魔方陣」が元になっています。この9つの数字に五行思想と陰陽論を組み合わせたのが九星の始まりです。</p>
    <p>日本には奈良〜平安時代に伝わり、陰陽道と融合しながら独自の発展を遂げました。明治時代に園田真次郎が体系化し、現在の「九星気学」として広まりました。現代でも開運・方位学・家相などの分野で広く活用されています。</p>
  </section>

  <section class="art-section" id="honmeisei">
    <h2>本命星・月命星とは</h2>
    <h3>本命星</h3>
    <p>生まれた年（節分基準）から算出される最重要の星。その人の本質的な性格・才能・運命の傾向を示します。九星気学の中心となる要素で、吉方位もこの本命星から導き出されます。</p>
    <h3>月命星</h3>
    <p>生まれた月から算出される星。本命星を補完する形で、対人関係・才能の発揮スタイル・感情面の傾向を示します。本命星と月命星の組み合わせを読むことで、より立体的な性格分析ができます。</p>
    <h3>本命星の求め方（簡易）</h3>
    <p>生まれた年の西暦の各桁を足して1桁にし、11から引いた数が本命星の番号です。例：1990年生まれ → 1+9+9+0=19 → 1+9=10 → 1+0=1 → 11-1=10 → 1+0=<strong>1</strong>（一白水星）。ただし1月1日〜2月3日生まれは前年で計算します。</p>
  </section>

  <section class="art-section" id="nine-stars">
    <h2>九星（一白〜九紫）一覧</h2>
    <div class="star-grid">
      <a href="/articles/kyusei/ippaku/" class="star-card">
        <div class="star-num">第1星</div>
        <div class="star-name">一白水星</div>
        <span class="star-elem elem-water">水</span>
        <div class="star-kw">柔軟・知性・流動性・忍耐</div>
      </a>
      <a href="/articles/kyusei/nikoku/" class="star-card">
        <div class="star-num">第2星</div>
        <div class="star-name">二黒土星</div>
        <span class="star-elem elem-earth">土</span>
        <div class="star-kw">勤勉・堅実・母性・奉仕</div>
      </a>
      <a href="/articles/kyusei/sanpeki/" class="star-card">
        <div class="star-num">第3星</div>
        <div class="star-name">三碧木星</div>
        <span class="star-elem elem-wood">木</span>
        <div class="star-kw">行動力・独創性・情熱・積極性</div>
      </a>
      <a href="/articles/kyusei/shiryoku/" class="star-card">
        <div class="star-num">第4星</div>
        <div class="star-name">四緑木星</div>
        <span class="star-elem elem-wood">木</span>
        <div class="star-kw">調和・社交性・信頼・旅運</div>
      </a>
      <a href="/articles/kyusei/goko/" class="star-card">
        <div class="star-num">第5星</div>
        <div class="star-name">五黄土星</div>
        <span class="star-elem elem-earth">土</span>
        <div class="star-kw">カリスマ・強運・波乱・再生力</div>
      </a>
      <a href="/articles/kyusei/roppaku/" class="star-card">
        <div class="star-num">第6星</div>
        <div class="star-name">六白金星</div>
        <span class="star-elem elem-metal">金</span>
        <div class="star-kw">完全主義・高貴・統率力・天運</div>
      </a>
      <a href="/articles/kyusei/shichiseki/" class="star-card">
        <div class="star-num">第7星</div>
        <div class="star-name">七赤金星</div>
        <span class="star-elem elem-metal">金</span>
        <div class="star-kw">社交・楽天・弁舌・金運</div>
      </a>
      <a href="/articles/kyusei/hakkudo/" class="star-card">
        <div class="star-num">第8星</div>
        <div class="star-name">八白土星</div>
        <span class="star-elem elem-earth">土</span>
        <div class="star-kw">不動・変革・誠実・蓄積</div>
      </a>
      <a href="/articles/kyusei/kyushi/" class="star-card">
        <div class="star-num">第9星</div>
        <div class="star-name">九紫火星</div>
        <span class="star-elem elem-fire">火</span>
        <div class="star-kw">直感・美意識・名誉・変化</div>
      </a>
    </div>
  </section>

  <section class="art-section" id="direction">
    <h2>吉方位・凶方位とは</h2>
    <p>九星気学では、本命星ごとに「運気が上がりやすい方角（吉方位）」と「避けるべき方角（凶方位）」があります。引越し・旅行・出張などの方角をこの吉方位に合わせることで、開運効果が期待できるとされています。</p>
    <h3>特に注意が必要な凶方位</h3>
    <table class="dir-table">
      <thead><tr><th>凶方位</th><th>内容</th></tr></thead>
      <tbody>
        <tr><td>五黄殺</td><td>五黄土星が飛ぶ方位。最も凶とされ、健康・金運・運気全般に悪影響とされる。</td></tr>
        <tr><td>暗剣殺</td><td>五黄殺の正反対の方位。五黄殺と同等の凶作用があるとされる。</td></tr>
        <tr><td>本命殺</td><td>本命星が飛ぶ方位。自分自身を傷める方位とされ、大きな移動には不向き。</td></tr>
        <tr><td>本命的殺</td><td>本命殺の正反対の方位。本命殺と同様に注意が必要とされる。</td></tr>
      </tbody>
    </table>
    <p>吉方位・凶方位は毎年・毎月変わります。特に大きな決断（引越し・転職・結婚）の際は、その年・月の方位盤を確認するのがおすすめです。</p>
  </section>

  <section class="art-section" id="setsubun">
    <h2>節分と年の切り替わり</h2>
    <p>九星気学では、一般的な1月1日ではなく「節分（2月3日前後）」が年の切り替わりとなります。そのため、1月1日〜節分前日までに生まれた方は、前年の本命星が適用されます。</p>
    <p>例えば2000年1月15日生まれの場合、九星気学上は1999年生まれとして本命星を計算します。生年月日を入力する際は、この点に注意してください。当サイトの診断ツールでは自動的に節分補正を行っています。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">九星気学と四柱推命の違いは何ですか？</div>
        <div class="faq-a">四柱推命は生年月日時の4柱から詳細な命式を算出する占術で、性格・運命・大運の流れを精密に読みます。九星気学は生まれ年から本命星を導き、吉方位・運気の年サイクルを読むのが得意です。手軽さとサイクル把握は九星気学、深い命式分析は四柱推命と使い分けるのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">本命星はどうやって調べますか？</div>
        <div class="faq-a">生まれた年の数字を足して1桁にし、11から引いた数が本命星の番号です。ただし九星気学では節分が年の切り替わりのため、1月1日〜2月3日生まれの方は前年で計算します。当サイトの九星気学診断で自動算出できます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">吉方位とは何ですか？</div>
        <div class="faq-a">吉方位とは、本命星ごとに定まる「運気が上がりやすい方角」のことです。引越し・旅行・通勤ルートなどにこの方角を取り入れることで、運気向上を図ります。五黄殺・暗剣殺などの凶方位は避けることが推奨されます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">九星気学は毎年変わりますか？</div>
        <div class="faq-a">本命星は一生変わりませんが、年・月ごとに盤が変化するため、運気の吉凶は毎年・毎月変わります。本命星が中宮（中央）に回座する年は特に重要な転機とされます。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>九星気学と組み合わせると、より多角的に運勢を読み解けます。</p>
    <?php
    $relatedItems = [
      ['label'=>'四柱推命 解説', 'title'=>'命式・十神・大運・天中殺を詳しく知る →', 'url'=>'/articles/shichu/'],
      ['label'=>'タロット占い', 'title'=>'今この瞬間のメッセージを受け取る →', 'url'=>'/tarot'],
      ['label'=>'数秘術', 'title'=>'誕生日から運命数を読み解く →', 'url'=>'/numerology'],
    ];
    require __DIR__.'/../../inc/article-related.php';
    ?>
  </section>


</div>


<script>
function toggleFaq(el){ el.parentElement.classList.toggle('open'); }
</script>
<?php $currentSlug='kyusei'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'kyusei');
?>

