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
  <link rel="canonical" href="https://life-fun.net/articles/sanmei/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="算命学とは何か、元命・主星・従星・十大主星・五行バランスの意味と計算方法をわかりやすく解説。四柱推命との違いも紹介。">
  <title>算命学とは？元命・主星・従星の意味と計算方法をわかりやすく解説</title>
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
    --accent:#7c4dce;
    --accent-lt:#9b72ef;
    --gold:#c9a84c;
    --text:#1a1a2e;
    --muted:#6b6b8a;
    --border:#e5e3ee;
    --bg:#faf7ff;
    --bg2:#f8f7fc;
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

  /* 比較表 */
  .compare-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .compare-table th{background:rgba(124,77,206,.12);color:var(--accent);font-weight:600;padding:.65rem .85rem;border:1px solid var(--border);text-align:left;font-family:var(--ff-serif)}
  .compare-table td{padding:.6rem .85rem;border:1px solid var(--border);color:#333;line-height:1.6}
  .compare-table tr:nth-child(even) td{background:var(--bg2)}

  /* 十大主星グリッド */
  .star-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem;margin-top:1rem}
  .star-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.85rem 1rem;transition:border-color .2s}
  .star-card:hover{border-color:var(--accent-lt)}
  .star-name{font-family:var(--ff-serif);font-size:.98rem;font-weight:700;color:var(--accent);margin-bottom:.25rem}
  .star-element{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-bottom:.3rem}
  .star-kw{font-size:.78rem;color:#555;line-height:1.6}

  /* 五行表 */
  .gogyou-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.85rem}
  .gogyou-table th{background:rgba(124,77,206,.1);color:var(--accent);font-weight:600;padding:.55rem .75rem;border:1px solid var(--border);text-align:left;font-family:var(--ff-serif)}
  .gogyou-table td{padding:.5rem .75rem;border:1px solid var(--border);color:#333}
  .gogyou-table tr:nth-child(even) td{background:var(--bg2)}
  .gogyou-dot{display:inline-block;width:10px;height:10px;border-radius:50%;margin-right:.4rem;vertical-align:middle}
  .dot-wood{background:#4caf50}.dot-fire{background:#ef5350}.dot-earth{background:#ffb300}.dot-metal{background:#90caf9}.dot-water{background:#42a5f5}

  /* FAQ */
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}

  /* Related */
  
  
  
  
  
  
  

  /* Footer */
  @media(max-width:600px){
    
    .star-grid{grid-template-columns:1fr}
  }
.al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"算命学と四柱推命はどちらが当たる？","acceptedAnswer":{"@type":"Answer","text":"どちらが優れているということはありません。算命学は生年月日のみで性格・才能・本質を読み解くのに向いており、四柱推命は生年月日時を使い、時期・運勢の流れをより詳細に読む占術です。目的に応じて使い分けるのがおすすめです。"}},
      {"@type":"Question","name":"時刻がわからなくても占える？","acceptedAnswer":{"@type":"Answer","text":"はい、算命学は生年月日のみで鑑定できます。四柱推命は時刻も使いますが、算命学では年柱・日柱の2つから元命・主星・従星・五行バランスをすべて算出します。"}},
      {"@type":"Question","name":"元命は何種類ある？","acceptedAnswer":{"@type":"Answer","text":"十大主星と呼ばれる10種類あります。貫索星・石門星・鳳閣星・調舒星・禄存星・司禄星・車騎星・牽牛星・龍高星・玉堂星の10種で、日干（日柱の十干）から算出します。"}},
      {"@type":"Question","name":"毎年結果が変わる？","acceptedAnswer":{"@type":"Answer","text":"元命・主星・従星は生涯変わりません。これらは生年月日から定まるもので、あなたの本質・社会性・エネルギーを表します。ただし大運（10年ごとの運気テーマ）は変化します。"}}
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
      {"@type":"ListItem","position":3,"name":"算命学とは","item":"https://life-fun.net/articles/sanmei/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/sanmei" class="art-back">☯️ 算命学で鑑定する →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>算命学とは
  </nav>

  <div class="art-hero">
    <span class="art-label">SANMEI-GAKU · 完全ガイド</span>
    <h1>算命学とは？<br>元命・主星・従星の意味と計算方法をわかりやすく解説</h1>
    <p class="art-lead">算命学は中国発祥の東洋占術で、生年月日だけから「元命（十大主星）」「主星」「従星」を算出し、その人の本質・才能・社会的な在り方・エネルギーを読み解きます。日本では高尾義政が体系化し普及させました。</p>
  </div>

  <?php
$ctaTitle = '☯️ あなたの元命・主星・従星を調べる';
$ctaText  = '生年月日を入力するだけで三星と五行バランスを算出。';
$ctaUrl   = '/sanmei';
$ctaBtn   = '算命学で鑑定する →';
require __DIR__.'/../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">算命学とは</a></li>
      <li><a href="#diff">四柱推命との違い</a></li>
      <li><a href="#genme">元命（十大主星）とは</a></li>
      <li><a href="#shusei">主星・従星とは</a></li>
      <li><a href="#gogyou">五行バランスとは</a></li>
      <li><a href="#usage">算命学の活用方法</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>算命学とは</h2>
    <p>算命学（さんめいがく）は、中国の陰陽五行思想を基盤とする東洋占術の一つです。生年月日（年・月・日）を干支（十干十二支）に変換し、そこから「元命」「主星」「従星」という三つの星を読み取ることで、その人の本質・才能・社会的な役割・エネルギーレベルを総合的に鑑定します。</p>
    <p>四柱推命と同じく干支を基本とする占術ですが、算命学の大きな特徴は<strong>生まれた時刻が不要</strong>という点です。年・月・日の3つの情報だけで鑑定が完結するため、時刻がわからない人にも広く活用できます。</p>
    <p>日本には昭和時代に伝わり、高尾義政（たかおよしまさ）氏が日本人向けに体系化・普及させました。現在も性格分析・才能発見・仕事適性・人間関係の改善など、自己理解のツールとして多くの人に親しまれています。</p>
  </section>

  <section class="art-section" id="diff">
    <h2>四柱推命との違い</h2>
    <p>算命学と四柱推命はどちらも干支を使う東洋占術ですが、目的・入力情報・得意分野に違いがあります。</p>
    <table class="compare-table">
      <thead>
        <tr>
          <th>項目</th>
          <th>算命学</th>
          <th>四柱推命</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>起源・体系</td>
          <td>中国発祥、日本で高尾義政が体系化</td>
          <td>中国発祥、命理学の一体系</td>
        </tr>
        <tr>
          <td>必要な入力</td>
          <td>生年月日のみ（年・月・日）</td>
          <td>生年月日＋時刻（四柱）</td>
        </tr>
        <tr>
          <td>基本概念</td>
          <td>三星（元命・主星・従星）</td>
          <td>四柱（年柱・月柱・日柱・時柱）と十神</td>
        </tr>
        <tr>
          <td>得意分野</td>
          <td>性格・才能・本質の把握</td>
          <td>時期・運勢の詳細な流れの把握</td>
        </tr>
        <tr>
          <td>時刻不明でも使える？</td>
          <td>はい（生年月日のみでOK）</td>
          <td>時柱が不完全になる</td>
        </tr>
      </tbody>
    </table>
    <p style="margin-top:1rem">どちらが優れているわけではなく、目的に応じて使い分けるのがベストです。「自分の本質・才能を知りたい」なら算命学、「今年・来年の運気の流れを詳しく知りたい」なら四柱推命が向いています。</p>
  </section>

  <section class="art-section" id="genme">
    <h2>元命（十大主星）とは</h2>
    <p>元命（げんめい）は算命学の中心概念で、日柱の十干（日干）から算出します。「十大主星」とも呼ばれ、10種類の星があり、その人の本質的な性格・才能・生き方のスタイルを表します。</p>
    <h3>十大主星の一覧</h3>
    <div class="star-grid">
      <a href="/articles/sanmei/kansaku/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">貫索星（かんさくせい）</div>
        <div class="star-element">五行：木（陽）</div>
        <div class="star-kw">自立・独立・信念を貫く。マイペースで一人でも強い自立派。</div>
      </a>
      <a href="/articles/sanmei/sekimon/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">石門星（せきもんせい）</div>
        <div class="star-element">五行：木（陰）</div>
        <div class="star-kw">調和・協調・広い人脈。グループの中で輝く調和の達人。</div>
      </a>
      <a href="/articles/sanmei/houkaku/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">鳳閣星（ほうかくせい）</div>
        <div class="star-element">五行：火（陽）</div>
        <div class="star-kw">自由・表現・創造。個性的な発想と表現力に優れた自由人。</div>
      </a>
      <a href="/articles/sanmei/chousho/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">調舒星（ちょうじょせい）</div>
        <div class="star-element">五行：火（陰）</div>
        <div class="star-kw">感性・芸術・完璧主義。繊細な感受性と深い芸術的才能。</div>
      </a>
      <a href="/articles/sanmei/rokuson/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">禄存星（ろくそんせい）</div>
        <div class="star-element">五行：土（陽）</div>
        <div class="star-kw">奉仕・包容・人望。人を助け慕われる面倒見の良い奉仕派。</div>
      </a>
      <a href="/articles/sanmei/shiroku/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">司禄星（しろくせい）</div>
        <div class="star-element">五行：土（陰）</div>
        <div class="star-kw">蓄積・堅実・継続力。地道に積み重ねる信頼の堅実派。</div>
      </a>
      <a href="/articles/sanmei/shaki/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">車騎星（しゃきせい）</div>
        <div class="star-element">五行：金（陽）</div>
        <div class="star-kw">行動・突破・スピード。困難を突き破る行動力あふれる実践家。</div>
      </a>
      <a href="/articles/sanmei/kengyu/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">牽牛星（けんぎゅうせい）</div>
        <div class="star-element">五行：金（陰）</div>
        <div class="star-kw">誠実・完璧・プライド。高い基準と責任感を持つ誠実な完全主義者。</div>
      </a>
      <a href="/articles/sanmei/ryuko/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">龍高星（りゅうこうせい）</div>
        <div class="star-element">五行：水（陽）</div>
        <div class="star-kw">探求・革新・自由発想。型を超えた知的好奇心と革新力。</div>
      </a>
      <a href="/articles/sanmei/gyokudo/" class="star-card" style="text-decoration:none;color:inherit">
        <div class="star-name">玉堂星（ぎょくどうせい）</div>
        <div class="star-element">五行：水（陰）</div>
        <div class="star-kw">知性・学習・伝達力。知識を深め、人に伝える知性派。</div>
      </a>
    </div>
  </section>

  <section class="art-section" id="shusei">
    <h2>主星・従星とは</h2>
    <h3>主星（しゅせい）</h3>
    <p>主星は年柱の十干（年干）から算出します。社会における役割・対外的な在り方・社会的エネルギーを表します。元命が「本質（内なる自分）」を示すのに対し、主星は「社会における自分」を示します。主星も十大主星の中から決まります。</p>
    <h3>従星（じゅうせい）</h3>
    <p>従星は日柱の地支（日支）から算出します。12種類あり（天胡星〜天印星）、その人が持つエネルギーの大きさ・質を示します。「エネルギー大」の従星は行動力・社会的なスケールが大きく、「エネルギー小」の従星は内省的・繊細なエネルギーを持ちます。</p>
    <h3>三星の組み合わせ</h3>
    <p>元命（日干）・主星（年干）・従星（日支）の3つを合わせて「三星」と呼びます。この三星の組み合わせから「二つ名」（タイプ名）が生まれ、その人の総合的な性格・才能・社会的スタイルが読み取れます。</p>
  </section>

  <section class="art-section" id="gogyou">
    <h2>五行バランスとは</h2>
    <p>算命学では、年柱・日柱の干支（天干・地支）それぞれが持つ五行（木・火・土・金・水）を集計し、五行バランスを分析します。どの五行が強く、どれが弱いかによって、その人の個性や偏りを読み取ります。</p>
    <table class="gogyou-table">
      <thead>
        <tr>
          <th>五行</th>
          <th>干支の例</th>
          <th>強い場合の特徴</th>
          <th>弱い場合の特徴</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><span class="gogyou-dot dot-wood"></span>木</td>
          <td>甲・乙・寅・卯</td>
          <td>成長力・向上心・柔軟性</td>
          <td>優柔不断・依存しやすい</td>
        </tr>
        <tr>
          <td><span class="gogyou-dot dot-fire"></span>火</td>
          <td>丙・丁・巳・午</td>
          <td>情熱・表現力・積極性</td>
          <td>冷静さ・計画性が課題</td>
        </tr>
        <tr>
          <td><span class="gogyou-dot dot-earth"></span>土</td>
          <td>戊・己・丑・辰・未・戌</td>
          <td>安定感・包容力・信頼</td>
          <td>頑固・変化への抵抗感</td>
        </tr>
        <tr>
          <td><span class="gogyou-dot dot-metal"></span>金</td>
          <td>庚・辛・申・酉</td>
          <td>決断力・誠実さ・意志力</td>
          <td>融通が利かない・頑固</td>
        </tr>
        <tr>
          <td><span class="gogyou-dot dot-water"></span>水</td>
          <td>壬・癸・子・亥</td>
          <td>知恵・適応力・洞察力</td>
          <td>優柔不断・流されやすい</td>
        </tr>
      </tbody>
    </table>
    <p style="margin-top:1rem">五行はどれかが突出している場合も、均等に分散している場合もあります。特定の五行が0の場合は、その要素を意識的に補うことが開運のヒントとなります。</p>
  </section>

  <section class="art-section" id="usage">
    <h2>算命学の活用方法</h2>
    <h3>自分の強み・才能を発見する</h3>
    <p>元命から自分の本質的な強みと弱みが読み取れます。「自分はなぜこういう行動パターンをとるのか」という疑問への答えが得られ、自己理解が深まります。強みを活かした行動選択が、充実感ある生き方につながります。</p>
    <h3>仕事・キャリア選びに活かす</h3>
    <p>元命の五行と特性は、向いている仕事・職種と深く関連しています。たとえば貫索星（木・陽）は専門職や起業家向き、牽牛星（金・陰）は公務員・管理職向きといった具合に、自分の本質に合ったキャリアを選ぶ指針となります。</p>
    <h3>人間関係の改善に役立てる</h3>
    <p>相手の元命・主星を知ることで「なぜあの人はああいう行動をとるのか」を理解しやすくなります。貫索星タイプには自由を与える、石門星タイプには仲間の一員と感じさせるなど、相手の特性に合ったコミュニケーションが取れるようになります。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">算命学と四柱推命はどちらが当たる？</div>
        <div class="faq-a">どちらが優れているということはありません。算命学は生年月日のみで性格・才能・本質を読み解くのに向いており、四柱推命は生年月日時を使い、時期・運勢の流れをより詳細に読む占術です。目的に応じて使い分けるのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">時刻がわからなくても占える？</div>
        <div class="faq-a">はい、算命学は生年月日のみで鑑定できます。四柱推命は時刻も使いますが、算命学では年柱・日柱の2つから元命・主星・従星・五行バランスをすべて算出します。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">元命は何種類ある？</div>
        <div class="faq-a">十大主星と呼ばれる10種類あります。貫索星・石門星・鳳閣星・調舒星・禄存星・司禄星・車騎星・牽牛星・龍高星・玉堂星の10種で、日干（日柱の十干）から算出します。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">毎年結果が変わる？</div>
        <div class="faq-a">元命・主星・従星は生涯変わりません。これらは生年月日から定まるもので、あなたの本質・社会性・エネルギーを表します。ただし大運（10年ごとの運気テーマ）は変化します。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>算命学で自分の本質を知ったら、他の占術で多角的に深めてみませんか。</p>
    <?php
    $relatedItems = [
      ['label'=>'四柱推命とは', 'title'=>'命式・十神・大運の読み方を解説 →', 'url'=>'/articles/shichu/'],
      ['label'=>'数秘術とは', 'title'=>'運命数の計算方法と意味を解説 →', 'url'=>'/articles/numerology/'],
      ['label'=>'算命学を試す', 'title'=>'元命・主星・従星を無料で算出 →', 'url'=>'/sanmei'],
    ];
    require __DIR__.'/../../inc/article-related.php';
    ?>
  </section>

</div>


<script>
function toggleFaq(el){
  const item = el.parentElement;
  item.classList.toggle('open');
}
</script>

<?php $currentSlug='sanmei'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'sanmei');
?>

