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
  <link rel="canonical" href="https://life-fun.net/articles/seimei/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="姓名判断の仕組み、天格・人格・地格・外格・総格の五格と画数の吉凶をわかりやすく解説。">
  <title>姓名判断とは？画数・五格の意味と吉数をわかりやすく解説</title>
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
  .gokaku-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.88rem}
  .gokaku-table th{background:var(--accent);color:#fff;padding:.65rem .9rem;text-align:left;font-family:var(--ff-serif);font-weight:600}
  .gokaku-table td{padding:.65rem .9rem;border-bottom:1px solid var(--border);line-height:1.7}
  .gokaku-table tr:nth-child(even) td{background:var(--bg2)}
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
      {"@type":"Question","name":"姓名判断は当たりますか？","acceptedAnswer":{"@type":"Answer","text":"姓名判断は日本で長く親しまれてきた占術で、名前の画数に宿るエネルギーを読み解くものです。科学的な証明はありませんが、「自分の名前のもつ意味を知る」という観点から自己理解に活用できます。名付けの参考にしている方も多くいます。"}},
      {"@type":"Question","name":"カタカナ・ひらがなの画数はどう数えますか？","acceptedAnswer":{"@type":"Answer","text":"カタカナ・ひらがなで名前を書く場合は、アの字源である「阿」（8画）のように元の漢字の画数を使う流派と、文字そのものの画数を数える流派があります。当サイトでは漢字の画数を基準に鑑定しています。"}},
      {"@type":"Question","name":"旧字体と新字体どちらで数えますか？","acceptedAnswer":{"@type":"Answer","text":"姓名判断では一般的に旧字体（正字）の画数を使う流派が多いです。たとえば「渡辺」の「辺」は新字体では5画ですが、旧字体の「邊」は19画です。当サイトでは一般的な字画数（新字体）を基準としつつ、「邊」「邉」など主要な旧字体にも対応しています。流派によって画数が異なる場合があります。"}},
      {"@type":"Question","name":"名前を変えると運勢が変わりますか？","acceptedAnswer":{"@type":"Answer","text":"姓名判断の観点では「使う名前が変わればエネルギーも変わる」とされています。芸名・ペンネーム・ニックネームも同様です。ただし運勢が変わるかどうかは信念や行動次第の面もあり、名前変更はあくまでひとつのきっかけとして考えるのがよいでしょう。"}}
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
      {"@type":"ListItem","position":3,"name":"姓名判断とは","item":"https://life-fun.net/articles/seimei/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/seimei" class="art-back">✍️ 姓名判断を鑑定する →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>姓名判断とは
  </nav>

  <div class="art-hero">
    <span class="art-label">SEIMEI · 完全ガイド</span>
    <h1>姓名判断とは？<br>画数・五格の意味と吉数をわかりやすく解説</h1>
    <p class="art-lead">姓名判断は漢字の画数を使って名前の吉凶・運勢を読み解く日本の伝統占術です。天格・人格・地格・外格・総格の「五格」を組み合わせることで、その人の本質・社会運・家庭運などを多角的に鑑定します。</p>
  </div>

  <?php
$ctaTitle = '✍️ あなたの名前を鑑定する';
$ctaText  = '姓名を入力するだけで五格・画数・吉凶を自動鑑定。';
$ctaUrl   = '/seimei';
$ctaBtn   = '姓名判断を鑑定する →';
require __DIR__.'/../../inc/article-cta.php';
?>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">カタカナ・ひらがなの画数はどう数えますか？</div>
        <div class="faq-a">カタカナ・ひらがなで名前を書く場合は、アの字源である「阿」（8画）のように元の漢字の画数を使う流派と、文字そのものの画数を数える流派があります。当サイトでは漢字の画数を基準に鑑定しています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">旧字体と新字体どちらで数えますか？</div>
        <div class="faq-a">姓名判断では一般的に旧字体（正字）の画数を使う流派が多いです。たとえば「渡辺」の「辺」は新字体では5画ですが、旧字体の「邊」は19画です。当サイトでは一般的な字画数（新字体）を基準としつつ、「邊」「邉」など主要な旧字体にも対応しています。流派によって画数が異なる場合があります。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">名前を変えると運勢が変わりますか？</div>
        <div class="faq-a">姓名判断の観点では「使う名前が変わればエネルギーも変わる」とされています。芸名・ペンネーム・ニックネームも同様です。ただし運勢が変わるかどうかは信念や行動次第の面もあり、名前変更はあくまでひとつのきっかけとして考えるのがよいでしょう。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>名前の数字を知ったら、次は誕生日の数字も調べてみましょう。</p>
    <?php
    $relatedItems = [
      ['label'=>'三星統合鑑定', 'title'=>'四柱推命・数秘・九星を統合して鑑定する →', 'url'=>'/'],
      ['label'=>'数秘術とは', 'title'=>'誕生日から運命数を計算して読み解く →', 'url'=>'/articles/numerology/'],
      ['label'=>'タロット占いとは', 'title'=>'直感でカードを選んでメッセージを受け取る →', 'url'=>'/articles/tarot/'],
      ['label'=>'四柱推命とは', 'title'=>'命式・大運・年運の流れを知る →', 'url'=>'/articles/shichu/'],
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

<?php $currentSlug='seimei'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'seimei');
?>

