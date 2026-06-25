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
  <link rel="canonical" href="https://life-fun.net/articles/guardian/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="守護霊・守護獣とは何か、その役割と種類、守護霊診断の楽しみ方をわかりやすく解説。">
  <title>守護霊診断とは？守護霊・守護獣の意味をわかりやすく解説</title>
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
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"守護霊は誰にでもいますか？","acceptedAnswer":{"@type":"Answer","text":"日本のスピリチュアルな考え方では、すべての人には守護霊がいるとされています。先祖霊・指導霊・天使など呼び方は様々ですが、生まれた時から見守り続ける存在として信じられています。その存在を感じるかどうかは個人の感受性や信仰によります。"}},
      {"@type":"Question","name":"守護霊を感じる方法はありますか？","acceptedAnswer":{"@type":"Answer","text":"静かな環境で瞑想する・感謝の気持ちを日々持つ・自分の直感を大切にするなどが、守護霊とつながりやすくなる方法として挙げられます。「ふと思いついたアイデア」「なんとなく避けた結果助かった体験」なども守護霊のサインとして解釈される場合があります。"}},
      {"@type":"Question","name":"守護霊と守護獣の違いは何ですか？","acceptedAnswer":{"@type":"Answer","text":"守護霊は人間の霊的存在が守護する概念で、先祖の霊や高次の存在が主なものです。守護獣は動物の霊（神使・眷属など）や神話的な動物がその人を守るという概念で、主に日本や東アジアの信仰に見られます。当サイトでは両方の観点から診断しています。"}},
      {"@type":"Question","name":"守護霊が変わることはありますか？","acceptedAnswer":{"@type":"Answer","text":"スピリチュアルな考え方では、人生のステージや課題の変化によって守護霊が変わる・複数の守護霊が入れ替わるという説もあります。一方で一生を通じて同じ守護霊が見守るという考え方もあり、流派によって異なります。"}}
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
      {"@type":"ListItem","position":3,"name":"守護霊診断とは","item":"https://life-fun.net/articles/guardian/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/guardian" class="art-back">👻 守護霊を診断する →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>守護霊診断とは
  </nav>

  <div class="art-hero">
    <span class="art-label">GUARDIAN · 完全ガイド</span>
    <h1>守護霊診断とは？<br>守護霊・守護獣の意味をわかりやすく解説</h1>
    <p class="art-lead">守護霊診断とは、あなたを見守る霊的存在や守護獣のタイプを読み解く占いです。日本古来の霊的信仰と現代のスピリチュアル文化が融合した独自の診断で、自分を守る存在の特性を知ることで、人生の歩み方に新たな視点が加わります。</p>
  </div>

  <?php
$ctaTitle = '👻 あなたの守護霊を診断する';
$ctaText  = '生年月日からあなたの守護霊・守護獣タイプを判定。';
$ctaUrl   = '/guardian';
$ctaBtn   = '守護霊を診断する →';
require __DIR__.'/../../inc/article-cta.php';
?>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">守護霊を感じる方法はありますか？</div>
        <div class="faq-a">静かな環境で瞑想する・感謝の気持ちを日々持つ・自分の直感を大切にするなどが、守護霊とつながりやすくなる方法として挙げられます。「ふと思いついたアイデア」「なんとなく避けた結果助かった体験」なども守護霊のサインとして解釈される場合があります。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">守護霊と守護獣の違いは何ですか？</div>
        <div class="faq-a">守護霊は人間の霊的存在が守護する概念で、先祖の霊や高次の存在が主なものです。守護獣は動物の霊（神使・眷属など）や神話的な動物がその人を守るという概念で、主に日本や東アジアの信仰に見られます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">守護霊が変わることはありますか？</div>
        <div class="faq-a">人生のステージや課題の変化によって守護霊が変わる・複数の守護霊が入れ替わるという説もあります。一方で一生を通じて同じ守護霊が見守るという考え方もあり、流派によって異なります。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>見えない力のつながりをさらに探求してみましょう。</p>
    <?php
    $relatedItems = [
      ['label'=>'三星統合鑑定', 'title'=>'四柱推命・数秘・九星を統合して鑑定する →', 'url'=>'/'],
      ['label'=>'前世診断とは', 'title'=>'前世・輪廻転生・カルマの意味を解説 →', 'url'=>'/articles/zense/'],
      ['label'=>'数秘術とは', 'title'=>'誕生日から運命数を読み解く →', 'url'=>'/articles/numerology/'],
      ['label'=>'タロット占いとは', 'title'=>'22枚の大アルカナの意味と読み方 →', 'url'=>'/articles/tarot/'],
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

<?php $currentSlug='guardian'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'guardian');
?>

