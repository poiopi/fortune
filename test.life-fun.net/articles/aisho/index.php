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
  <link rel="canonical" href="https://life-fun.net/articles/aisho/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="誕生日・血液型・星座を使った相性診断の仕組みと読み方をわかりやすく解説。">
  <title>相性診断とは？誕生日・血液型・星座で相性を占う方法をわかりやすく解説</title>
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
      {"@type":"Question","name":"相性が悪いと付き合えませんか？","acceptedAnswer":{"@type":"Answer","text":"相性診断はあくまで傾向の参考であり、相性が悪いからといって絶対に付き合えないわけではありません。相性が難しいとされる組み合わせでも、お互いの理解と努力によって深い関係を築いているカップルはたくさんいます。診断結果はコミュニケーションのヒントとして使うのがベストです。"}},
      {"@type":"Question","name":"血液型相性は科学的に証明されていますか？","acceptedAnswer":{"@type":"Answer","text":"現時点では、血液型と性格・相性の間に科学的な因果関係は証明されていません。ただし日本では長年にわたって文化的に親しまれており、会話のきっかけや自己理解のツールとして楽しまれています。科学的事実としてではなく、エンターテインメントとして楽しむのがおすすめです。"}},
      {"@type":"Question","name":"相性100%はあり得ますか？","acceptedAnswer":{"@type":"Answer","text":"当サイトの相性診断では複数の指標（誕生日・血液型・星座）を組み合わせて総合スコアを算出しています。すべての指標で高い相性が重なった場合に高スコアが出ますが、100%という数字はあくまで算出上の目安です。実際の関係は努力と理解で育まれるものです。"}},
      {"@type":"Question","name":"相性が良い組み合わせはどれですか？","acceptedAnswer":{"@type":"Answer","text":"星座では一般的に同じ元素（火・土・風・水）同士、または補完し合う元素（火×風、土×水など）が相性良しとされます。血液型ではO型は誰とでも合わせやすく、A型とはA型・AB型が相性良しとされます。ただしこれらはあくまで傾向であり、個人差があります。"}}
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
      {"@type":"ListItem","position":3,"name":"相性診断とは","item":"https://life-fun.net/articles/aisho/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/aisho" class="art-back">💞 相性診断をする →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>相性診断とは
  </nav>

  <div class="art-hero">
    <span class="art-label">COMPATIBILITY · 完全ガイド</span>
    <h1>相性診断とは？<br>誕生日・血液型・星座で相性を占う方法をわかりやすく解説</h1>
    <p class="art-lead">相性診断は恋愛・友情・仕事など、あらゆる人間関係の「合いやすさ」を占う手法です。誕生日・血液型・星座という身近な情報を組み合わせることで、二人の関係をより深く理解するヒントが得られます。</p>
  </div>

  <?php
$ctaTitle = '💞 二人の相性を診断する';
$ctaText  = '誕生日・血液型・星座を入力して二人の相性スコアを算出。';
$ctaUrl   = '/aisho';
$ctaBtn   = '相性診断をする →';
require __DIR__.'/../../inc/article-cta.php';
?>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">血液型相性は科学的に証明されていますか？</div>
        <div class="faq-a">現時点では、血液型と性格・相性の間に科学的な因果関係は証明されていません。ただし日本では長年にわたって文化的に親しまれており、会話のきっかけや自己理解のツールとして楽しまれています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">相性100%はあり得ますか？</div>
        <div class="faq-a">当サイトの相性診断では複数の指標を組み合わせて総合スコアを算出しています。すべての指標で高い相性が重なった場合に高スコアが出ますが、100%という数字はあくまで算出上の目安です。実際の関係は努力と理解で育まれるものです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">相性が良い組み合わせはどれですか？</div>
        <div class="faq-a">星座では同じ元素同士、または補完し合う元素同士が相性良しとされます。血液型ではO型は誰とでも合わせやすいとされます。ただしこれらはあくまで傾向であり、個人差があります。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>相性を知ったら、それぞれの個性もさらに深く知ってみましょう。</p>
    <?php
    $relatedItems = [
      ['label'=>'三星統合鑑定', 'title'=>'四柱推命・数秘・九星を統合して鑑定する →', 'url'=>'/'],
      ['label'=>'MBTI診断とは', 'title'=>'16タイプの性格と4つの指標を解説 →', 'url'=>'/articles/mbti/'],
      ['label'=>'数秘術とは', 'title'=>'運命数で二人の相性を深掘り →', 'url'=>'/articles/numerology/'],
      ['label'=>'タロット占いとは', 'title'=>'二人の関係をタロットで読む →', 'url'=>'/articles/tarot/'],
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

<?php $currentSlug='aisho'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'aisho');
?>

