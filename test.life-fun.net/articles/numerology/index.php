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
  <link rel="canonical" href="https://life-fun.net/articles/numerology/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="数秘術とは何か、運命数（ライフパスナンバー）の計算方法と1〜9+11・22の意味をわかりやすく解説。">
  <title>数秘術とは？運命数・誕生数の意味と計算方法をわかりやすく解説</title>
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
  .num-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:.75rem;margin-top:1rem}
  .num-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s}
  .num-card:hover{border-color:var(--accent-lt)}
  .num-n{font-family:var(--ff-mono);font-size:1.4rem;font-weight:300;color:var(--accent);margin-bottom:.3rem}
  .num-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.3rem}
  .num-kw{font-size:.75rem;color:var(--muted);line-height:1.6}
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
      {"@type":"Question","name":"数秘術は当たりますか？","acceptedAnswer":{"@type":"Answer","text":"数秘術は「当たる・外れる」という性質のものではなく、数字を通じて自分の本質や傾向を見つめ直すツールです。運命数が示すテーマは多くの人に「確かにそういう面がある」と感じさせる傾向があり、自己理解のヒントとして活用するのがおすすめです。"}},
      {"@type":"Question","name":"運命数が11や22になる場合は？","acceptedAnswer":{"@type":"Answer","text":"11・22・33はマスターナンバーと呼ばれる特別な数字で、そのまま使用します（さらに足して2や4にはしません）。強いエネルギーと大きな使命を持つとされ、プレッシャーも大きい反面、高い精神性や指導力を持つとされます。"}},
      {"@type":"Question","name":"名前の数字も使うの？","acceptedAnswer":{"@type":"Answer","text":"はい。数秘術では誕生日だけでなく名前のアルファベット（またはひらがなをローマ字に変換）から「表現数」「魂の衝動数」「個性数」などを算出するシステムもあります。当サイトの診断は誕生日をベースにした運命数を中心に解説しています。"}},
      {"@type":"Question","name":"運命数は毎年変わりますか？","acceptedAnswer":{"@type":"Answer","text":"基本の運命数（ライフパスナンバー）は生年月日から算出するため、一生変わりません。ただし「個人年数」という概念では、その年の数字によって運気の周期が変わると考えられています。"}}
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
      {"@type":"ListItem","position":3,"name":"数秘術とは","item":"https://life-fun.net/articles/numerology/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/numerology" class="art-back">🔢 数秘術を診断する →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>数秘術とは
  </nav>

  <div class="art-hero">
    <span class="art-label">NUMEROLOGY · 完全ガイド</span>
    <h1>数秘術とは？<br>運命数・誕生数の意味と計算方法をわかりやすく解説</h1>
    <p class="art-lead">数秘術（ニューメロロジー）は、誕生日を数字に還元することで「運命数」を導き出し、その人の本質・才能・人生テーマを読み解く占術です。古代ピタゴラスの時代から続く数の神秘を、現代の視点でわかりやすく解説します。</p>
  </div>

      <?php endforeach; ?>
    </div>
  </section>

  <?php
$ctaTitle = '🔢 あなたの運命数を調べる';
$ctaText  = '生年月日を入力するだけで運命数と詳細な解説を表示。';
$ctaUrl   = '/numerology';
$ctaBtn   = '数秘術を診断する →';
require __DIR__.'/../../inc/article-cta.php';
?>

  <section class="art-section" id="birthday">
    <h2>誕生日数とは</h2>
    <p>運命数（ライフパスナンバー）とは別に、「誕生日数（バースデーナンバー）」という概念もあります。こちらは生まれた日（1日〜31日）の数字をそのまま、もしくは足して1桁にしたもの。その人が持つ特定の才能や隠れた資質を示すとされます。</p>
    <p>たとえば23日生まれなら2＋3＝5。誕生日数5は「変化・自由・多才」といったキーワードを持ちます。運命数と誕生日数を組み合わせることで、より立体的な自己理解が可能になります。</p>
    <p>数秘術はシンプルな計算から深い洞察を得られるのが魅力。まずは自分の運命数を計算してみて、それぞれの数字が持つテーマと照らし合わせてみてください。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">数秘術は当たりますか？</div>
        <div class="faq-a">数秘術は「当たる・外れる」という性質のものではなく、数字を通じて自分の本質や傾向を見つめ直すツールです。運命数が示すテーマは多くの人に「確かにそういう面がある」と感じさせる傾向があり、自己理解のヒントとして活用するのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">運命数が11や22になる場合は？</div>
        <div class="faq-a">11・22・33はマスターナンバーと呼ばれる特別な数字で、そのまま使用します。強いエネルギーと大きな使命を持つとされ、プレッシャーも大きい反面、高い精神性や指導力を持つとされます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">名前の数字も使うの？</div>
        <div class="faq-a">はい。数秘術では誕生日だけでなく名前のアルファベットから「表現数」「魂の衝動数」「個性数」などを算出するシステムもあります。当サイトの診断は誕生日をベースにした運命数を中心に解説しています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">運命数は毎年変わりますか？</div>
        <div class="faq-a">基本の運命数（ライフパスナンバー）は生年月日から算出するため、一生変わりません。ただし「個人年数」という概念では、その年の数字によって運気の周期が変わると考えられています。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>数字で自分を知ったら、他の占術でさらに深掘りしてみませんか。</p>
    <?php
    $relatedItems = [
      ['label'=>'三星統合鑑定', 'title'=>'四柱推命・数秘・九星を統合して鑑定する →', 'url'=>'/'],
      ['label'=>'姓名判断とは', 'title'=>'名前の画数から運勢を読む →', 'url'=>'/articles/seimei/'],
      ['label'=>'タロット占いとは', 'title'=>'直感でカードを選んでメッセージを受け取る →', 'url'=>'/articles/tarot/'],
      ['label'=>'九星気学とは', 'title'=>'今年の運気の流れを九星で知る →', 'url'=>'/articles/kyusei/'],
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

<?php $currentSlug='numerology'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'numerology');
?>

