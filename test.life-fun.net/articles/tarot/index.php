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
  <link rel="canonical" href="https://life-fun.net/articles/tarot/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="タロット占いとは何か、22枚の大アルカナの意味・歴史・正位置逆位置の読み方をわかりやすく解説。タロットの基礎知識からカード一覧まで完全ガイド。">
  <title>タロット占いとは？大アルカナ22枚の意味と読み方｜完全解説</title>
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

  /* ── HEADER ── */
  .art-header{
    background:#fff;border-bottom:1px solid var(--border);
    position:sticky;top:0;z-index:100;
  }
  .art-header-inner{
    max-width:780px;margin:0 auto;padding:0 1.2rem;
    display:flex;align-items:center;justify-content:space-between;height:52px;
  }
  .art-logo{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);text-decoration:none}
  .art-logo em{font-style:italic;color:var(--gold)}
  .art-back{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.25rem .75rem;border-radius:20px;transition:border-color .2s,color .2s}
  .art-back:hover{border-color:var(--accent-lt);color:var(--accent)}

  /* ── WRAP ── */
  .wrap{max-width:780px;margin:0 auto;padding:0 1.2rem}

  /* ── BREADCRUMB ── */
  .breadcrumb{font-size:.72rem;color:var(--muted);padding:1rem 0 0;font-family:var(--ff-mono);letter-spacing:.04em}
  .breadcrumb a{color:var(--muted);text-decoration:none}
  .breadcrumb a:hover{color:var(--accent)}
  .breadcrumb span{margin:0 .4rem}

  /* ── HERO ── */
  .art-hero{padding:2rem 0 1.5rem;border-bottom:1px solid var(--border)}
  .art-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}

  /* ── CTA BOX ── */

  /* ── TOC ── */
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:2rem 0}
  .toc-title{font-size:.8rem;font-weight:500;color:var(--muted);letter-spacing:.1em;margin-bottom:.75rem;font-family:var(--ff-mono)}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.35rem}
  .toc li{font-size:.88rem}
  .toc a{color:var(--accent);text-decoration:none}
  .toc a:hover{text-decoration:underline}

  /* ── SECTIONS ── */
  .art-section{padding:2.5rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-child{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}
  .art-section p:last-child{margin-bottom:0}

  /* ── CARD GRID ── */
  .card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:.75rem;margin-top:1rem}
  .arc-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s,transform .15s;display:block;text-decoration:none;color:inherit}
  .arc-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .arc-num{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.3rem}
  .arc-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.35rem}
  .arc-kw{font-size:.75rem;color:var(--muted);line-height:1.6;margin-bottom:.5rem}
  .arc-link{font-family:var(--ff-mono);font-size:.68rem;color:var(--accent);letter-spacing:.04em}

  /* ── FAQ ── */
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}

  /* ── RELATED ── */

  /* ── FOOTER ── */

  @media(max-width:600px){
    .card-grid{grid-template-columns:repeat(auto-fill,minmax(130px,1fr))}
  }
.al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  </style>

  <!-- FAQ構造化データ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "タロット占いは当たりますか？",
        "acceptedAnswer": {"@type": "Answer","text": "タロットは未来を断言するツールではなく、現在の状況や潜在意識を映し出すものです。当たる・外れるというより、今の自分の状態や心理を整理するヒントとして活用するのがおすすめです。"}
      },
      {
        "@type": "Question",
        "name": "大アルカナとは何ですか？",
        "acceptedAnswer": {"@type": "Answer","text": "タロット78枚のうち、0〜21番の22枚を「大アルカナ」と呼びます。愚者・魔術師・女帝・皇帝など、人生の大きなテーマや転換点を象徴するカードです。"}
      },
      {
        "@type": "Question",
        "name": "無料タロット占いでも意味はありますか？",
        "acceptedAnswer": {"@type": "Answer","text": "はい。タロットの本質はカードを選ぶ瞬間の直感にあります。有料・無料に関係なく、カードと向き合う気持ちがあれば十分なメッセージを受け取ることができます。"}
      },
      {
        "@type": "Question",
        "name": "毎日タロットを引いても大丈夫ですか？",
        "acceptedAnswer": {"@type": "Answer","text": "問題ありません。ただし同じ質問を繰り返すのは避け、1日1枚を「今日のカード」として引くスタイルがおすすめです。"}
      }
    ]
  }
  </script>

  <!-- パンくずリスト構造化データ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"タロット占い","item":"https://life-fun.net/articles/tarot/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/tarot" class="art-back">🔮 タロットを占う →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span>タロット占い 解説
  </nav>

  <div class="art-hero">
    <span class="art-label">TAROT · 完全ガイド</span>
    <h1>タロット占いとは？<br>大アルカナ22枚の意味と読み方を徹底解説</h1>
    <p class="art-lead">15世紀に生まれたタロットは、78枚のカードで潜在意識と運命の流れを読み解く占術。直感でカードを選ぶことで、今のあなたへのメッセージが浮かび上がります。この記事ではタロットの基礎知識から22枚のカード意味一覧まで、まとめて解説します。</p>
  </div>

  <?php
$ctaTitle = '🔮 実際にカードを引いてみる';
$ctaText  = '22枚の大アルカナが並ぶ本格タロット。直感で1枚選ぶだけ。';
$ctaUrl   = '/tarot';
$ctaBtn   = 'タロット占いを始める →';
require __DIR__.'/../../inc/article-cta.php';
?>
      <?php endif; endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">タロット占いは当たりますか？</div>
        <div class="faq-a">タロットは未来を断言するツールではなく、現在の状況や潜在意識を映し出すものです。当たる・外れるというより、今の自分の状態や心理を整理するヒントとして活用するのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">大アルカナとは何ですか？</div>
        <div class="faq-a">タロット78枚のうち、0〜21番の22枚を「大アルカナ」と呼びます。愚者・魔術師・女帝・皇帝など、人生の大きなテーマや転換点を象徴するカードです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">無料タロット占いでも意味はありますか？</div>
        <div class="faq-a">はい。タロットの本質はカードを選ぶ瞬間の直感にあります。有料・無料に関係なく、カードと向き合う気持ちがあれば十分なメッセージを受け取ることができます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">毎日タロットを引いても大丈夫ですか？</div>
        <div class="faq-a">問題ありません。ただし同じ質問を繰り返すのは避け、1日1枚を「今日のカード」として引くスタイルがおすすめです。</div>
      </div>
    </div>
  </section>
  <section class="art-section">
    <?php
    $ctaTitle = '🔮 22枚の意味を読んだ今、実際に占ってみましょう';
    $ctaText  = '今のあなたにはどのカードが現れるでしょうか。';
    $ctaUrl   = '/tarot';
    $ctaBtn   = 'タロット占いを始める →';
    require __DIR__.'/../../inc/article-cta.php';
    ?>
  </section>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>タロットで引いたカードのテーマをさらに深掘りしたいときは、以下の占いもおすすめです。</p>
    <?php
    $relatedItems = [
      ['label'=>'四柱推命', 'title'=>'生まれ持った命式と大運を調べる →', 'url'=>'/shichu'],
      ['label'=>'数秘術',   'title'=>'誕生日から運命数を読み解く →',     'url'=>'/numerology'],
      ['label'=>'九星気学', 'title'=>'今年・来年の運気の流れを知る →',   'url'=>'/kyusei'],
      ['label'=>'相性診断', 'title'=>'気になる相手との相性を占う →',     'url'=>'/aisho'],
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

<?php $currentSlug='tarot'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'tarot');
?>

