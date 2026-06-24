<?php
/**
 * 解説ページ テンプレート
 *
 * 使い方：
 *   このファイルを articles/[key]/index.php にコピーして
 *   [PLACEHOLDER] 部分を書き換えるだけ。
 *   CSS・構造・色は変更しない。
 *
 * アクセントカラー：#7c4dce（紫・全解説ページ共通）
 * 基準ページ：articles/tarot/index.php
 */
declare(strict_types=1); ?>
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
  <link rel="canonical" href="https://life-fun.net/articles/[KEY]/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="[META_DESCRIPTION]">
  <title>[PAGE_TITLE]</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <style>
  /* ===================================================
   * 解説ページ共通CSS — 変更禁止
   * アクセントカラー #7c4dce は全解説ページで統一
   * =================================================== */
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

  /* Header */
  .art-header{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:100}
  .art-header-inner{max-width:780px;margin:0 auto;padding:0 1.2rem;display:flex;align-items:center;justify-content:space-between;height:52px}
  .art-logo{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);text-decoration:none}
  .art-logo em{font-style:italic;color:var(--gold)}
  .art-back{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.25rem .75rem;border-radius:20px;transition:border-color .2s,color .2s}
  .art-back:hover{border-color:var(--accent-lt);color:var(--accent)}

  /* Layout */
  .wrap{max-width:780px;margin:0 auto;padding:0 1.2rem}

  /* Breadcrumb */
  .breadcrumb{font-size:.72rem;color:var(--muted);padding:1rem 0 0;font-family:var(--ff-mono);letter-spacing:.04em}
  .breadcrumb a{color:var(--muted);text-decoration:none}
  .breadcrumb a:hover{color:var(--accent)}
  .breadcrumb span{margin:0 .4rem}

  /* Hero */
  .art-hero{padding:2rem 0 1.5rem;border-bottom:1px solid var(--border)}
  .art-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}

  /* CTA Box */
  .cta-box{background:linear-gradient(135deg,#f5f0ff 0%,#fdf4fa 100%);border:1px solid #d4bfff;border-radius:12px;padding:1.25rem 1.5rem;margin:1.5rem 0;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
  .cta-box p{font-size:.9rem;color:var(--text);font-weight:500}
  .cta-box small{display:block;font-size:.78rem;color:var(--muted);margin-top:.2rem;font-weight:400}
  .cta-btn{display:inline-block;background:var(--accent);color:#fff;font-family:var(--ff-sans);font-size:.85rem;font-weight:500;padding:.65rem 1.5rem;border-radius:24px;text-decoration:none;white-space:nowrap;transition:background .2s,transform .15s}
  .cta-btn:hover{background:var(--accent-lt);transform:translateY(-1px)}

  /* TOC */
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:2rem 0}
  .toc-title{font-size:.8rem;font-weight:500;color:var(--muted);letter-spacing:.1em;margin-bottom:.75rem;font-family:var(--ff-mono)}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.35rem}
  .toc li{font-size:.88rem}
  .toc a{color:var(--accent);text-decoration:none}
  .toc a:hover{text-decoration:underline}

  /* Sections */
  .art-section{padding:2.5rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-child{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}
  .art-section p:last-child{margin-bottom:0}

  /* FAQ */
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}

  /* Related */
  .related-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.75rem;margin-top:1rem}
  .related-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;text-decoration:none;display:block;transition:border-color .2s,transform .15s}
  .related-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .related-card.featured{background:linear-gradient(135deg,#f5f0ff,#fdf4fa);border-color:#d4bfff}
  .related-card.featured:hover{border-color:#9b72ef}
  .related-card-label{font-size:.7rem;color:var(--muted);margin-bottom:.3rem;font-family:var(--ff-mono)}
  .related-card-title{font-size:.9rem;font-weight:500;color:var(--accent)}
  .related-card.featured .related-card-title{color:#7c4dce}

  /* Footer */
  .art-footer{background:var(--bg2);border-top:1px solid var(--border);padding:2.5rem 1.2rem 1.5rem;margin-top:3rem}
  .art-footer-inner{max-width:780px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:2rem}
  .aft-heading{font-size:.68rem;font-weight:500;letter-spacing:.15em;color:var(--accent);text-transform:uppercase;margin-bottom:.6rem;font-family:var(--ff-mono);padding-bottom:.5rem;border-bottom:1px solid var(--border)}
  .art-footer ul{list-style:none;display:flex;flex-direction:column;gap:.45rem}
  .art-footer ul a{font-size:.8rem;color:var(--muted);text-decoration:none;transition:color .2s}
  .art-footer ul a:hover{color:var(--accent)}
  .aft-copy{font-size:.72rem;color:var(--muted);text-align:center;font-family:var(--ff-mono);letter-spacing:.08em}

  @media(max-width:600px){
    .art-footer-inner{grid-template-columns:1fr;gap:1.5rem}
    .cta-box{flex-direction:column;align-items:flex-start}
  }

  /* ===================================================
   * ページ固有CSS はここより下に追加
   * =================================================== */
  </style>

  <!-- FAQPage構造化データ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"[FAQ_Q1]","acceptedAnswer":{"@type":"Answer","text":"[FAQ_A1]"}},
      {"@type":"Question","name":"[FAQ_Q2]","acceptedAnswer":{"@type":"Answer","text":"[FAQ_A2]"}},
      {"@type":"Question","name":"[FAQ_Q3]","acceptedAnswer":{"@type":"Answer","text":"[FAQ_A3]"}},
      {"@type":"Question","name":"[FAQ_Q4]","acceptedAnswer":{"@type":"Answer","text":"[FAQ_A4]"}}
    ]
  }
  </script>

  <!-- BreadcrumbList構造化データ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},
      {"@type":"ListItem","position":3,"name":"[ARTICLE_TITLE_SHORT]","item":"https://life-fun.net/articles/[KEY]/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/[KEY]" class="art-back">[TOOL_ICON] [TOOL_NAME]を占う →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>[ARTICLE_TITLE_SHORT]
  </nav>

  <div class="art-hero">
    <span class="art-label">[EN_LABEL] · 完全ガイド</span>
    <h1>[H1_TITLE]</h1>
    <p class="art-lead">[LEAD_TEXT]</p>
  </div>

  <div class="cta-box">
    <div>
      <p>[TOOL_ICON] [CTA_TEXT]</p>
      <small>[CTA_SUBTEXT]</small>
    </div>
    <a href="/[KEY]" class="cta-btn">[TOOL_NAME]を始める →</a>
  </div>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">[SECTION1_TITLE]</a></li>
      <li><a href="#section2">[SECTION2_TITLE]</a></li>
      <li><a href="#section3">[SECTION3_TITLE]</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>[SECTION1_TITLE]</h2>
    <p>[SECTION1_CONTENT]</p>
  </section>

  <section class="art-section" id="section2">
    <h2>[SECTION2_TITLE]</h2>
    <p>[SECTION2_CONTENT]</p>
  </section>

  <section class="art-section" id="section3">
    <h2>[SECTION3_TITLE]</h2>
    <p>[SECTION3_CONTENT]</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">[FAQ_Q1]</div>
        <div class="faq-a">[FAQ_A1]</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">[FAQ_Q2]</div>
        <div class="faq-a">[FAQ_A2]</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">[FAQ_Q3]</div>
        <div class="faq-a">[FAQ_A3]</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">[FAQ_Q4]</div>
        <div class="faq-a">[FAQ_A4]</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>[RELATED_LEAD_TEXT]</p>
    <div class="related-grid">
      <a href="/[RELATED1_URL]" class="related-card featured">
        <div class="related-card-label">[RELATED1_LABEL]</div>
        <div class="related-card-title">[RELATED1_TITLE] →</div>
      </a>
      <a href="/[RELATED2_URL]" class="related-card">
        <div class="related-card-label">[RELATED2_LABEL]</div>
        <div class="related-card-title">[RELATED2_TITLE] →</div>
      </a>
      <a href="/[RELATED3_URL]" class="related-card">
        <div class="related-card-label">[RELATED3_LABEL]</div>
        <div class="related-card-title">[RELATED3_TITLE] →</div>
      </a>
      <a href="/articles/" class="related-card">
        <div class="related-card-label">解説ガイド一覧</div>
        <div class="related-card-title">すべての占術解説を見る →</div>
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
        <li><a href="/articles/tarot/">タロット占いとは</a></li>
        <li><a href="/articles/shichu/">四柱推命とは</a></li>
        <li><a href="/articles/seiza/">西洋占星術とは</a></li>
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

<script>
function toggleFaq(el){
  el.parentElement.classList.toggle('open');
}
</script>

</body>
</html>
