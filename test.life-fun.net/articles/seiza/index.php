<?php declare(strict_types=1); ?>
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
  <link rel="canonical" href="https://life-fun.net/articles/seiza/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="西洋占星術の基礎知識を解説。12星座・4つのエレメント（火・地・風・水）・活動宮/不動宮/柔軟宮の意味から、太陽星座の読み方・活用方法まで初心者にもわかりやすく説明します。">
  <title>西洋占星術とは？12星座・エレメント・クオリティの意味と読み方をわかりやすく解説</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{
    --ff-serif:'Shippori Mincho',serif;
    --ff-sans:'Zen Kaku Gothic New',sans-serif;
    --ff-mono:'DM Mono',monospace;
    --accent:#c2185b;
    --accent-lt:#e91e63;
    --gold:#c9a84c;
    --text:#1a1a2e;
    --muted:#6b6b8a;
    --border:#e5e3ee;
    --bg:#faf7ff;
    --bg2:#f2eeff;
    --card-bg:#ffffff;
  }
  html{font-size:16px;scroll-behavior:smooth}
  body{background:var(--bg);color:var(--text);font-family:var(--ff-sans);font-weight:400;line-height:1.85}

  .art-header{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:100}
  .art-header-inner{max-width:860px;margin:0 auto;padding:0 1.2rem;display:flex;align-items:center;justify-content:space-between;height:52px}
  .art-logo{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);text-decoration:none}
  .art-logo em{font-style:italic;color:var(--gold)}
  .art-back{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.25rem .75rem;border-radius:20px;transition:border-color .2s,color .2s}
  .art-back:hover{border-color:var(--accent-lt);color:var(--accent)}

  .wrap{max-width:860px;margin:0 auto;padding:0 1.2rem}

  /* ── HERO ── */
  .art-hero{padding:2.5rem 0 2rem;border-bottom:1px solid var(--border)}
  .art-eyebrow{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.3rem,3.5vw,1.9rem);font-weight:700;color:var(--text);letter-spacing:.04em;line-height:1.4;margin-bottom:.75rem}
  .art-hero-desc{font-size:.88rem;color:var(--muted);line-height:1.85}
  .art-meta{display:flex;gap:1rem;flex-wrap:wrap;margin-top:1rem}
  .art-meta-item{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);display:flex;align-items:center;gap:.3rem}

  /* ── BREADCRUMB ── */
  .breadcrumb{padding:.75rem 0;font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);border-bottom:1px solid var(--border)}
  .breadcrumb a{color:var(--muted);text-decoration:none}
  .breadcrumb a:hover{color:var(--accent)}
  .breadcrumb span{margin:0 .4rem}

  /* ── TOC ── */
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.2rem 1.5rem;margin:2rem 0}
  .toc-title{font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:var(--text);margin-bottom:.75rem}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.4rem}
  .toc li{font-size:.82rem}
  .toc a{color:var(--accent);text-decoration:none}
  .toc a:hover{text-decoration:underline}

  /* ── SECTION ── */
  .art-section{padding:2rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-of-type{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.3rem;font-weight:700;color:var(--text);margin-bottom:1.1rem;padding-bottom:.5rem;border-bottom:2px solid var(--accent);display:inline-block}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.9rem;color:#2a2a42;line-height:1.95;margin-bottom:1rem}
  .art-section p:last-child{margin-bottom:0}

  /* ── SIGN GRID ── */
  .sign-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:.75rem;margin:1.2rem 0}
  .sign-card{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1rem;display:flex;align-items:flex-start;gap:.75rem;transition:border-color .2s}
  .sign-card:hover{border-color:rgba(194,24,91,.4)}
  .sign-symbol{font-size:1.6rem;line-height:1;flex-shrink:0}
  .sign-info{}
  .sign-name{font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:var(--text)}
  .sign-period{font-family:var(--ff-mono);font-size:.6rem;color:var(--muted);margin-top:.15rem}
  .sign-elem{font-size:.68rem;color:var(--accent);margin-top:.2rem}

  /* ── ELEMENT CARDS ── */
  .elem-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin:1.2rem 0}
  .elem-card{border-radius:12px;padding:1.2rem;border:1px solid}
  .elem-fire {background:rgba(239,83,80,.06);border-color:rgba(239,83,80,.25)}
  .elem-earth{background:rgba(141,110,99,.06);border-color:rgba(141,110,99,.25)}
  .elem-air  {background:rgba(66,165,245,.06);border-color:rgba(66,165,245,.25)}
  .elem-water{background:rgba(126,87,194,.06);border-color:rgba(126,87,194,.25)}
  .elem-card-icon{font-size:1.4rem;margin-bottom:.4rem}
  .elem-card-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
  .elem-card-signs{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);margin-bottom:.5rem}
  .elem-card-desc{font-size:.8rem;color:#3a3a52;line-height:1.75}

  /* ── QUALITY TABLE ── */
  .quality-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin:1.2rem 0}
  .quality-card{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.1rem;text-align:center}
  .quality-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
  .quality-en{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);margin-bottom:.5rem}
  .quality-signs{font-family:var(--ff-mono);font-size:.62rem;color:var(--accent);margin-bottom:.5rem}
  .quality-desc{font-size:.78rem;color:#3a3a52;line-height:1.7}

  /* ── HIGHLIGHT BOX ── */
  .highlight-box{background:rgba(194,24,91,.06);border:1px solid rgba(194,24,91,.2);border-radius:12px;padding:1.2rem 1.4rem;margin:1.2rem 0}
  .highlight-box p{font-size:.87rem;color:#2a2a42;line-height:1.9;margin-bottom:0}
  .highlight-box strong{color:var(--accent)}

  /* ── FAQ ── */
  .faq-list{display:flex;flex-direction:column;gap:1rem;margin-top:1.2rem}
  .faq-item{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;overflow:hidden}
  .faq-q{font-family:var(--ff-serif);font-size:.92rem;font-weight:700;color:var(--text);padding:1rem 1.2rem;display:flex;align-items:flex-start;gap:.6rem}
  .faq-q::before{content:'Q';font-family:var(--ff-mono);font-size:.72rem;color:var(--accent);font-weight:700;flex-shrink:0;margin-top:.1rem}
  .faq-a{font-size:.85rem;color:#2a2a42;line-height:1.9;padding:.75rem 1.2rem 1rem;border-top:1px solid var(--border);display:flex;gap:.6rem}
  .faq-a::before{content:'A';font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);font-weight:700;flex-shrink:0;margin-top:.05rem}

  /* ── RELATED ── */
  .related-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:.75rem;margin-top:1.2rem}
  .related-card{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1rem;display:flex;gap:.75rem;align-items:flex-start;text-decoration:none;transition:border-color .2s,transform .15s}
  .related-card:hover{border-color:rgba(194,24,91,.4);transform:translateY(-2px)}
  .related-icon{font-size:1.4rem;flex-shrink:0;line-height:1}
  .related-info{}
  .related-name{font-family:var(--ff-serif);font-size:.88rem;font-weight:700;color:var(--text);margin-bottom:.2rem}
  .related-desc{font-size:.72rem;color:var(--muted)}

  /* ── CTA ── */
  .cta-box{background:linear-gradient(135deg,rgba(194,24,91,.08),rgba(155,114,239,.06));border:1px solid rgba(194,24,91,.25);border-radius:16px;padding:2rem;text-align:center;margin:2rem 0}
  .cta-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:.5rem}
  .cta-desc{font-size:.85rem;color:var(--muted);margin-bottom:1.2rem}
  .cta-btn{display:inline-block;padding:.75rem 2rem;background:var(--accent);color:#fff;border-radius:25px;font-family:var(--ff-serif);font-size:.95rem;font-weight:700;text-decoration:none;letter-spacing:.06em;transition:opacity .2s}
  .cta-btn:hover{opacity:.85}

  /* ── FOOTER ── */
  .art-footer{background:#fff;border-top:1px solid var(--border);padding:2.5rem 1.2rem 1.5rem;margin-top:3rem}
  .art-footer-inner{max-width:860px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:2rem}
  .aft-heading{font-size:.68rem;font-weight:500;letter-spacing:.15em;color:var(--accent);text-transform:uppercase;margin-bottom:.6rem;font-family:var(--ff-mono);padding-bottom:.5rem;border-bottom:1px solid var(--border)}
  .art-footer ul{list-style:none;display:flex;flex-direction:column;gap:.45rem}
  .art-footer ul a{font-size:.8rem;color:var(--muted);text-decoration:none;transition:color .2s}
  .art-footer ul a:hover{color:var(--accent)}
  .aft-copy{font-size:.72rem;color:var(--muted);text-align:center;font-family:var(--ff-mono);letter-spacing:.08em}

  @media(max-width:600px){
    .art-footer-inner{grid-template-columns:1fr;gap:1.5rem}
    .elem-grid{grid-template-columns:1fr}
    .quality-grid{grid-template-columns:1fr}
    .sign-grid{grid-template-columns:repeat(2,1fr)}
  }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},
      {"@type":"ListItem","position":3,"name":"西洋占星術とは","item":"https://life-fun.net/articles/seiza/"}
    ]
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "西洋占星術と星占いは同じですか？",
        "acceptedAnswer": {"@type":"Answer","text":"星占いは西洋占星術の中の「太陽星座占い」を指すことが多く、西洋占星術の一部です。本格的な西洋占星術では太陽星座以外に月星座・上昇星座なども組み合わせて鑑定します。"}
      },
      {
        "@type": "Question",
        "name": "エレメントとクオリティはどう違いますか？",
        "acceptedAnswer": {"@type":"Answer","text":"エレメント（火・地・風・水）は「人の基本的な気質・性質」を表し、クオリティ（活動宮・不動宮・柔軟宮）は「物事への取り組み方・エネルギーの使い方」を表します。組み合わせることで、より詳細な性格分析が可能です。"}
      },
      {
        "@type": "Question",
        "name": "内面タイプとは何ですか？",
        "acceptedAnswer": {"@type":"Answer","text":"内面タイプは当サイト独自の概念で、太陽星座（外の顔）に対し、内側の動機・エネルギーのパターンを表します。生年月日から算出され、太陽星座と組み合わせることで「なぜそのように行動するのか」という内面の動機まで読み解けます。"}
      },
      {
        "@type": "Question",
        "name": "同じ星座でも性格が違うのはなぜですか？",
        "acceptedAnswer": {"@type":"Answer","text":"太陽星座は生まれた日付で決まりますが、本格的な占星術では月星座・上昇星座・各惑星の配置も性格に影響します。また、生まれた時間帯・内面タイプなど複数の要素が組み合わさるため、同じ太陽星座でも個人差が生まれます。"}
      }
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/articles/" class="art-back">← 解説一覧</a>
  </div>
</header>

<div class="wrap">

  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span>
    <a href="/articles/">占い解説ガイド</a><span>›</span>
    西洋占星術とは
  </nav>

  <div class="art-hero">
    <span class="art-eyebrow">Western Astrology · 西洋占星術解説</span>
    <h1>西洋占星術とは？12星座・エレメント・クオリティの意味と読み方をわかりやすく解説</h1>
    <p class="art-hero-desc">
      西洋占星術は、惑星と星座の位置関係から人の性格・運命・相性を読み解く占術です。
      この記事では、12星座の意味・4つのエレメント・3つのクオリティをわかりやすく解説します。
    </p>
    <div class="art-meta">
      <span class="art-meta-item">📅 2026年6月</span>
      <span class="art-meta-item">⏱ 約8分で読める</span>
      <span class="art-meta-item">⭐ 西洋占星術・入門</span>
    </div>
  </div>

  <nav class="toc">
    <p class="toc-title">📋 目次</p>
    <ol>
      <li><a href="#whatis">西洋占星術とは</a></li>
      <li><a href="#signs">12星座の特徴</a></li>
      <li><a href="#elements">4つのエレメント（火・地・風・水）</a></li>
      <li><a href="#qualities">クオリティ（活動宮・不動宮・柔軟宮）</a></li>
      <li><a href="#howto">西洋占星術の活用方法</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <!-- ① 西洋占星術とは -->
  <section class="art-section" id="whatis">
    <h2>西洋占星術とは</h2>
    <p>西洋占星術（Western Astrology）は、太陽・月・惑星が黄道十二宮のどの星座に位置するかをもとに、人の性格・運命・相性などを読み解く占術です。その起源は古代バビロニアにさかのぼり、現代に至るまで数千年の歴史を持ちます。</p>
    <p>最もよく知られているのは「太陽星座」——生まれた日に太陽が位置していた星座で、一般的に「あなたは何座?」と聞くときの「星座」はこれを指します。太陽星座は人の「外の顔」すなわち意識的な性格・目標・自己表現の傾向を表します。</p>

    <div class="highlight-box">
      <p>西洋占星術では太陽星座のほかに、<strong>月星座（感情・本能）</strong>、<strong>上昇星座（第一印象・外見的な雰囲気）</strong>など複数の要素を組み合わせて鑑定します。本サイトの鑑定ツールでは太陽星座・エレメント・内面タイプ（独自概念）・生まれた時間帯を組み合わせた個性分析を行っています。</p>
    </div>

    <h3>東洋占術との違い</h3>
    <p>算命学・四柱推命などの東洋占術が「年・月・日・時の干支」をベースに命運を読むのに対し、西洋占星術は「惑星の位置と星座」を中心に宇宙的な視点からアプローチします。東洋が「運命の流れ」に重点を置くのに対し、西洋占星術は「個人の気質・性格・対人関係」の分析に強みがあります。</p>
  </section>

  <!-- ② 12星座 -->
  <section class="art-section" id="signs">
    <h2>12星座の特徴</h2>
    <p>黄道を12等分した星座を「黄道十二宮」と呼び、太陽が各星座に滞在する時期が誕生日となる人の太陽星座になります。それぞれの星座には固有の気質と支配星（ルーラー）があります。</p>

    <div class="sign-grid">
      <div class="sign-card"><span class="sign-symbol">♈</span><div class="sign-info"><div class="sign-name">牡羊座</div><div class="sign-period">3/21〜4/19</div><div class="sign-elem">火 ／ 活動宮 ／ 支配星：火星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♉</span><div class="sign-info"><div class="sign-name">牡牛座</div><div class="sign-period">4/20〜5/20</div><div class="sign-elem">地 ／ 不動宮 ／ 支配星：金星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♊</span><div class="sign-info"><div class="sign-name">双子座</div><div class="sign-period">5/21〜6/21</div><div class="sign-elem">風 ／ 柔軟宮 ／ 支配星：水星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♋</span><div class="sign-info"><div class="sign-name">蟹座</div><div class="sign-period">6/22〜7/22</div><div class="sign-elem">水 ／ 活動宮 ／ 支配星：月</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♌</span><div class="sign-info"><div class="sign-name">獅子座</div><div class="sign-period">7/23〜8/22</div><div class="sign-elem">火 ／ 不動宮 ／ 支配星：太陽</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♍</span><div class="sign-info"><div class="sign-name">乙女座</div><div class="sign-period">8/23〜9/22</div><div class="sign-elem">地 ／ 柔軟宮 ／ 支配星：水星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♎</span><div class="sign-info"><div class="sign-name">天秤座</div><div class="sign-period">9/23〜10/23</div><div class="sign-elem">風 ／ 活動宮 ／ 支配星：金星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♏</span><div class="sign-info"><div class="sign-name">蠍座</div><div class="sign-period">10/24〜11/21</div><div class="sign-elem">水 ／ 不動宮 ／ 支配星：冥王星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♐</span><div class="sign-info"><div class="sign-name">射手座</div><div class="sign-period">11/22〜12/21</div><div class="sign-elem">火 ／ 柔軟宮 ／ 支配星：木星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♑</span><div class="sign-info"><div class="sign-name">山羊座</div><div class="sign-period">12/22〜1/19</div><div class="sign-elem">地 ／ 活動宮 ／ 支配星：土星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♒</span><div class="sign-info"><div class="sign-name">水瓶座</div><div class="sign-period">1/20〜2/18</div><div class="sign-elem">風 ／ 不動宮 ／ 支配星：天王星</div></div></div>
      <div class="sign-card"><span class="sign-symbol">♓</span><div class="sign-info"><div class="sign-name">魚座</div><div class="sign-period">2/19〜3/20</div><div class="sign-elem">水 ／ 柔軟宮 ／ 支配星：海王星</div></div></div>
    </div>

    <p>12星座は春分（牡羊座）から始まり、一年をかけて一巡します。各星座は「エレメント（4種）」と「クオリティ（3種）」の組み合わせで構成されており、それが性格の大きな枠組みになります。</p>
  </section>

  <!-- ③ エレメント -->
  <section class="art-section" id="elements">
    <h2>4つのエレメント（火・地・風・水）</h2>
    <p>エレメントは、星座を大きく4つのグループに分類する概念です。人の気質・行動パターン・感じ方の傾向を表し、同じエレメントを持つ星座どうしは相互理解がしやすいとされています。</p>

    <div class="elem-grid">
      <div class="elem-card elem-fire">
        <div class="elem-card-icon">🔥</div>
        <div class="elem-card-name">火（ファイア）</div>
        <div class="elem-card-signs">♈ 牡羊座・♌ 獅子座・♐ 射手座</div>
        <div class="elem-card-desc">情熱・行動力・創造性が特徴。直感を信じて動き、周囲にエネルギーを与えます。自発的で表現力が豊か。先頭に立つリーダー気質があります。</div>
      </div>
      <div class="elem-card elem-earth">
        <div class="elem-card-icon">🌍</div>
        <div class="elem-card-name">地（アース）</div>
        <div class="elem-card-signs">♉ 牡牛座・♍ 乙女座・♑ 山羊座</div>
        <div class="elem-card-desc">安定・忍耐・実務能力が特徴。物事を現実的に捉え、着実に積み上げます。信頼性と誠実さが高く、計画を着実に実行する力があります。</div>
      </div>
      <div class="elem-card elem-air">
        <div class="elem-card-icon">💨</div>
        <div class="elem-card-name">風（エア）</div>
        <div class="elem-card-signs">♊ 双子座・♎ 天秤座・♒ 水瓶座</div>
        <div class="elem-card-desc">知性・コミュニケーション・適応力が特徴。情報処理が速く、社交的です。言葉とアイデアを使って世界を動かし、知的なつながりを大切にします。</div>
      </div>
      <div class="elem-card elem-water">
        <div class="elem-card-icon">🌊</div>
        <div class="elem-card-name">水（ウォーター）</div>
        <div class="elem-card-signs">♋ 蟹座・♏ 蠍座・♓ 魚座</div>
        <div class="elem-card-desc">感情・共感・直感が特徴。他者の感情に敏感で、深い洞察力を持ちます。精神的なつながりを大切にし、豊かな感受性と想像力を持つタイプです。</div>
      </div>
    </div>

    <div class="highlight-box">
      <p>相性の観点では、<strong>同じエレメントの星座は理解し合いやすく</strong>、<strong>隣り合うエレメント（火と地、地と風、風と水、水と火）は補い合う関係</strong>になります。反対のエレメント（火と水、地と風）は引き合うこともありますが、摩擦が生じることもあります。</p>
    </div>
  </section>

  <!-- ④ クオリティ -->
  <section class="art-section" id="qualities">
    <h2>クオリティ（活動宮・不動宮・柔軟宮）</h2>
    <p>クオリティは、各星座が「物事にどのようなエネルギーでアプローチするか」を表す分類です。12星座を3つのグループに分け、エレメントと組み合わせることで、より細かい性格分析が可能になります。</p>

    <div class="quality-grid">
      <div class="quality-card">
        <div class="quality-name">活動宮</div>
        <div class="quality-en">Cardinal</div>
        <div class="quality-signs">♈♋♎♑</div>
        <div class="quality-desc">新しいことを始める「開始」の力。積極的に行動を起こし、物事の起点となります。リーダーシップと推進力が特徴で、変化のきっかけを作るのが得意です。</div>
      </div>
      <div class="quality-card">
        <div class="quality-name">不動宮</div>
        <div class="quality-en">Fixed</div>
        <div class="quality-signs">♉♌♏♒</div>
        <div class="quality-desc">継続と安定の「維持」の力。一度始めたことをやり抜く強さと意志力があります。目標を持続させ、深く集中する力が特徴。頑固な面も持ちます。</div>
      </div>
      <div class="quality-card">
        <div class="quality-name">柔軟宮</div>
        <div class="quality-en">Mutable</div>
        <div class="quality-signs">♊♍♐♓</div>
        <div class="quality-desc">変化への「適応」の力。季節の境目に位置し、転換期を担います。柔軟に状況に合わせ、橋渡し役として機能するのが得意です。多才さが魅力です。</div>
      </div>
    </div>

    <p>エレメントとクオリティを組み合わせると12通りになり、これが12星座の基本的な性格の枠組みになります。例えば「牡羊座」は火エレメント×活動宮で「情熱的に新しいことを始める」タイプ、「牡牛座」は地エレメント×不動宮で「安定して着実に継続する」タイプとなります。</p>
  </section>

  <!-- ⑤ 活用方法 -->
  <section class="art-section" id="howto">
    <h2>西洋占星術の活用方法</h2>

    <h3>自己理解に活かす</h3>
    <p>太陽星座とエレメントを知ることで、自分の行動パターンや動機がわかります。「なぜ自分はこう感じるのか」「なぜこういう選択をするのか」という自己理解の道具として活用できます。強みを活かし、弱みを補う生き方を見つけましょう。</p>

    <h3>恋愛・人間関係に活かす</h3>
    <p>エレメントの相性は、恋愛・友人関係・職場関係にも応用できます。同じエレメントの相手とは波長が合いやすく、異なるエレメントの相手とは「補い合う」関係になることもあります。相手のエレメントを知ることで、コミュニケーションの取り方を工夫できます。</p>

    <h3>仕事・キャリアに活かす</h3>
    <p>太陽星座・クオリティは、どんな仕事スタイルが向いているかのヒントを与えてくれます。活動宮は「新規開拓・立ち上げ」、不動宮は「管理・継続・専門職」、柔軟宮は「サポート・調整・多業務」が向いているとされています。</p>

    <div class="highlight-box">
      <p><strong>大切なのは、占いを「決め付け」ではなく「気づきのツール」として使うこと。</strong>星座は一つの傾向を示しますが、あなたの可能性を制限するものではありません。自分を知るきっかけとして、軽やかに活用してください。</p>
    </div>
  </section>

  <!-- ⑥ FAQ -->
  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q">西洋占星術と星占いは同じですか？</div>
        <div class="faq-a">星占いは西洋占星術の中の「太陽星座占い」を指すことが多く、西洋占星術の一部です。本格的な西洋占星術では太陽星座以外に月星座・上昇星座なども組み合わせて鑑定します。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q">エレメントとクオリティはどう違いますか？</div>
        <div class="faq-a">エレメント（火・地・風・水）は「人の基本的な気質・性質」を表し、クオリティ（活動宮・不動宮・柔軟宮）は「物事への取り組み方・エネルギーの使い方」を表します。組み合わせることで、より詳細な性格分析が可能です。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q">内面タイプとは何ですか？</div>
        <div class="faq-a">内面タイプは当サイト独自の概念で、太陽星座（外の顔）に対し、内側の動機・エネルギーのパターンを表します。生年月日から算出され、太陽星座と組み合わせることで「なぜそのように行動するのか」という内面の動機まで読み解けます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q">同じ星座でも性格が違うのはなぜですか？</div>
        <div class="faq-a">太陽星座は生まれた日付で決まりますが、本格的な占星術では月星座・上昇星座・各惑星の配置も性格に影響します。また、生まれた時間帯・内面タイプなど複数の要素が組み合わさるため、同じ太陽星座でも個人差が生まれます。</div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <div class="cta-box">
    <div class="cta-title">⭐ 実際に西洋占星術で鑑定してみる</div>
    <p class="cta-desc">生年月日と生まれた時間帯を入力するだけで、太陽星座・エレメント・内面タイプを算出します。</p>
    <a href="/seiza" class="cta-btn">✦ 無料で鑑定する →</a>
  </div>

  <!-- 関連 -->
  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <div class="related-grid">
      <a href="/articles/sanmei/" class="related-card">
        <span class="related-icon">☯️</span>
        <div class="related-info">
          <div class="related-name">算命学とは</div>
          <div class="related-desc">東洋の命術。元命・主星・従星で本質を読む</div>
        </div>
      </a>
      <a href="/articles/shichu/" class="related-card">
        <span class="related-icon">🔯</span>
        <div class="related-info">
          <div class="related-name">四柱推命とは</div>
          <div class="related-desc">命式・大運・年運を本格算出する東洋占術</div>
        </div>
      </a>
      <a href="/articles/mbti/" class="related-card">
        <span class="related-icon">🧠</span>
        <div class="related-info">
          <div class="related-name">MBTI×星座診断とは</div>
          <div class="related-desc">16タイプ×12星座の性格分析ガイド</div>
        </div>
      </a>
      <a href="/articles/" class="related-card">
        <span class="related-icon">📚</span>
        <div class="related-info">
          <div class="related-name">占い解説ガイド一覧</div>
          <div class="related-desc">タロット・数秘術・九星気学など各占術の解説</div>
        </div>
      </a>
    </div>
  </section>

</div>

<footer class="art-footer">
  <div class="art-footer-inner">
    <div class="aft-col">
      <p class="aft-heading">人気の占い</p>
      <ul>
        <li><a href="/">三星統合鑑定</a></li>
        <li><a href="/tarot">タロット占い</a></li>
        <li><a href="/shichu">四柱推命</a></li>
        <li><a href="/seiza">西洋占星術</a></li>
        <li><a href="/sanmei">算命学</a></li>
        <li><a href="/mbti">MBTI×星座診断</a></li>
      </ul>
    </div>
    <div class="aft-col">
      <p class="aft-heading">解説ガイド</p>
      <ul>
        <li><a href="/articles/">占い解説ガイド</a></li>
        <li><a href="/articles/seiza/">西洋占星術とは</a></li>
        <li><a href="/articles/tarot/">タロット占いとは</a></li>
        <li><a href="/articles/shichu/">四柱推命とは</a></li>
        <li><a href="/articles/sanmei/">算命学とは</a></li>
        <li><a href="/articles/numerology/">数秘術とは</a></li>
        <li><a href="/articles/seimei/">姓名判断とは</a></li>
      </ul>
    </div>
    <div class="aft-col">
      <p class="aft-heading">サイト情報</p>
      <ul>
        <li><a href="/profile">運営者情報</a></li>
        <li><a href="/privacy">プライバシーポリシー</a></li>
        <li><a href="/contact">お問い合わせ</a></li>
      </ul>
    </div>
  </div>
  <p class="aft-copy">© <?= date('Y') ?> 占いPortal</p>
</footer>

</body>
</html>
