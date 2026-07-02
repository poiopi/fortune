<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';
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
  <link rel="canonical" href="https://life-fun.net/articles/calendar/gogyo/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="陰陽五行説の「木・火・土・金・水」5つの要素の意味・相性・ラッキーカラーをわかりやすく解説。">
  <title>陰陽五行とは？木・火・土・金・水5つの要素の意味を完全解説</title>
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
  .type-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.75rem;margin-top:1rem}
  .type-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s;display:block;text-decoration:none;color:inherit}
  .type-card:hover{border-color:var(--accent-lt)}
  .type-code{font-family:var(--ff-mono);font-size:.8rem;color:var(--accent);letter-spacing:.08em;margin-bottom:.25rem}
  .type-name{font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;margin-bottom:.3rem}
  .type-kw{font-size:.75rem;color:var(--muted)}
  .gogyo-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.88rem}
  .gogyo-table th{background:var(--accent);color:#fff;padding:.65rem .9rem;text-align:left;font-family:var(--ff-serif);font-weight:600}
  .gogyo-table td{padding:.65rem .9rem;border-bottom:1px solid var(--border);line-height:1.7}
  .gogyo-table tr:nth-child(even) td{background:var(--bg2)}
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},
      {"@type":"ListItem","position":3,"name":"開運カレンダーとは","item":"https://life-fun.net/articles/calendar/"},
      {"@type":"ListItem","position":4,"name":"陰陽五行とは","item":"https://life-fun.net/articles/calendar/gogyo/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/calendar" class="art-back">📅 開運カレンダーを見る →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/calendar/">開運カレンダーとは</a><span>›</span>陰陽五行とは
  </nav>

  <div class="art-hero">
    <span class="art-label">GOGYO · 完全ガイド</span>
    <h1>陰陽五行とは？<br>木・火・土・金・水5つの要素の意味を完全解説</h1>
    <p class="art-lead">陰陽五行説（いんようごぎょうせつ）は、古代中国発祥の自然哲学で、万物を「木・火・土・金・水」の5つの要素（五行）に分類する考え方です。開運カレンダーのラッキーカラーや相性判断の基礎となる五行の意味と関係性を詳しく解説します。</p>
  </div>

  <?php
  $ctaTitle = '📅 今日のラッキーカラーを確認する';
  $ctaText  = '五行に基づいたラッキーカラーを毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">陰陽五行とは</a></li>
      <li><a href="#relation">五行の相生・相剋</a></li>
      <li><a href="#elements">五行の種類</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>陰陽五行とは</h2>
    <p>陰陽五行説とは、古代中国で生まれた自然哲学で、万物のエネルギーを「陰」と「陽」の2つの性質、そして「木・火・土・金・水」の5つの要素（五行）に分類する考え方です。この思想は暦・方位・色・体質・性格判断など、東洋占術のあらゆる分野の基礎になっています。</p>
    <p>五行はそれぞれ異なる性質・季節・色・方角を持ち、互いに影響を与え合いながら循環しています。開運カレンダーのラッキーカラーも、この五行の考え方に基づいて日々算出されています。</p>
  </section>

  <section class="art-section" id="relation">
    <h2>五行の相生・相剋</h2>
    <p>五行には「相生（そうしょう）」と「相剋（そうこく）」という2種類の関係性があります。相生は互いを生み育てる関係、相剋は互いを打ち消し合う関係です。</p>
    <table class="gogyo-table">
      <tr><th>関係</th><th>意味</th><th>例</th></tr>
      <tr><td><strong>相生</strong></td><td>木は火を生み、火は土を生み、土は金を生み、金は水を生み、水は木を生む（循環的に助け合う）</td><td>木→火→土→金→水→木</td></tr>
      <tr><td><strong>相剋</strong></td><td>木は土を剋し、土は水を剋し、水は火を剋し、火は金を剋し、金は木を剋す（打ち消し合う）</td><td>木→土、土→水、水→火、火→金、金→木</td></tr>
    </table>
    <p>この相生・相剋の関係は、四柱推命・九星気学などの占術で相性判断の基礎として使われます。自分の五行と相手の五行の関係を見ることで、相性の傾向を読み解くことができます。</p>
  </section>

  <section class="art-section" id="elements">
    <h2>五行の種類</h2>
    <div class="type-grid">
      <a href="/articles/calendar/gogyo/ki/" class="type-card"><div class="type-code">木</div><div class="type-name">もく</div><div class="type-kw">成長・発展のエネルギー</div></a>
      <a href="/articles/calendar/gogyo/hi/" class="type-card"><div class="type-code">火</div><div class="type-name">か</div><div class="type-kw">情熱・活力のエネルギー</div></a>
      <a href="/articles/calendar/gogyo/tsuchi/" class="type-card"><div class="type-code">土</div><div class="type-name">ど</div><div class="type-kw">安定・信頼のエネルギー</div></a>
      <a href="/articles/calendar/gogyo/kin/" class="type-card"><div class="type-code">金</div><div class="type-name">こん</div><div class="type-kw">清潔・収穫のエネルギー</div></a>
      <a href="/articles/calendar/gogyo/mizu/" class="type-card"><div class="type-code">水</div><div class="type-name">すい</div><div class="type-kw">知恵・流れのエネルギー</div></a>
    </div>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">自分の五行はどうやって調べますか？</div>
        <div class="faq-a">生年月日から算出する四柱推命・九星気学などの占術で、自分の五行（属性）を調べることができます。生まれた年・月・日それぞれに五行が割り当てられており、その組み合わせで性格や運勢の傾向を読み解きます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">五行と星座は関係がありますか？</div>
        <div class="faq-a">直接的な関係はありません。五行は中国発祥の陰陽五行説に基づく概念で、西洋占星術の12星座とは体系が異なります。ただし、どちらも「自然界のエネルギーを分類する」という発想は共通しています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">五行のバランスが崩れるとどうなりますか？</div>
        <div class="faq-a">東洋医学や占術の考え方では、五行のバランスが崩れると体調や運気に影響が出るとされています。自分に不足している五行の色・食材・方角を意識的に取り入れることで、バランスを整えるという活用法があります。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul>
      <li>陰陽五行説は万物を「木・火・土・金・水」の5要素に分類する古代中国の自然哲学。</li>
      <li>五行には互いを生み育てる「相生」と、打ち消し合う「相剋」の関係がある。</li>
      <li>開運カレンダーのラッキーカラーも五行の考え方に基づいて算出されている。</li>
      <li>四柱推命・九星気学など、東洋占術の相性判断の基礎になっている。</li>
    </ul>
  </section>

  <?php
  $ctaTitle = '📅 今日のラッキーカラーを確認する';
  $ctaText  = '吉方位・ラッキーカラー・運気の波を毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?php
  $prevUrl   = '/articles/calendar/rokuyo/';
  $prevTitle = '六曜とは';
  $prevLabel = '← 前のカテゴリ';
  $nextUrl   = '/articles/calendar/kichijitsu/';
  $nextTitle = '特別な吉日とは';
  $nextLabel = '次のカテゴリ →';
  $listUrl   = '/articles/calendar/';
  $listTitle = '開運カレンダーとは';
  require __DIR__.'/../../../inc/article-nav.php';
  ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>暦や運気についてさらに詳しく知りたい方はこちら。</p>
    <?php
    $relatedItems = [
      ['label'=>'開運カレンダーとは', 'title'=>'吉方位・ラッキーカラー・吉日の意味を知る →', 'url'=>'/articles/calendar/'],
      ['label'=>'九星気学とは', 'title'=>'今年・来年の運気の流れを知る →', 'url'=>'/articles/kyusei/'],
      ['label'=>'四柱推命とは', 'title'=>'生年月日から運命を読み解く →', 'url'=>'/articles/shichu/'],
    ];
    require __DIR__.'/../../../inc/article-related.php';
    ?>
  </section>

</div>

<script>
function toggleFaq(el){
  const item = el.parentElement;
  item.classList.toggle('open');
}
</script>

<?php $currentSlug='calendar-gogyo'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'gogyo');
?>
