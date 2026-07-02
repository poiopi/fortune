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
  <link rel="canonical" href="https://life-fun.net/articles/calendar/kichijitsu/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="一粒万倍日・天赦日・寅の日・己巳の日など、特別な吉日の意味とおすすめの行動をわかりやすく解説。">
  <title>特別な吉日とは？一粒万倍日・天赦日・寅の日の意味を完全解説</title>
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
  .kichijitsu-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.88rem}
  .kichijitsu-table th{background:var(--accent);color:#fff;padding:.65rem .9rem;text-align:left;font-family:var(--ff-serif);font-weight:600}
  .kichijitsu-table td{padding:.65rem .9rem;border-bottom:1px solid var(--border);line-height:1.7}
  .kichijitsu-table tr:nth-child(even) td{background:var(--bg2)}
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
      {"@type":"ListItem","position":4,"name":"特別な吉日とは","item":"https://life-fun.net/articles/calendar/kichijitsu/"}
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/calendar/">開運カレンダーとは</a><span>›</span>特別な吉日とは
  </nav>

  <div class="art-hero">
    <span class="art-label">KICHIJITSU · 完全ガイド</span>
    <h1>特別な吉日とは？<br>一粒万倍日・天赦日・寅の日の意味を完全解説</h1>
    <p class="art-lead">日本の暦には、六曜とは別に「一粒万倍日」「天赦日」「寅の日」「己巳の日」など、特定の周期で巡ってくる特別な吉日があります。それぞれの意味・由来・おすすめの行動を詳しく解説します。</p>
  </div>

  <?php
  $ctaTitle = '📅 今日の吉日を確認する';
  $ctaText  = '一粒万倍日・天赦日などの重なりを毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">特別な吉日とは</a></li>
      <li><a href="#list">吉日一覧</a></li>
      <li><a href="#kasane">重ね吉日とは</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>特別な吉日とは</h2>
    <p>特別な吉日とは、六曜とは異なる周期で巡ってくる、縁起が良いとされる日のことです。「一粒万倍日」「天赦日」のように暦注として古くから伝わるものや、「寅の日」「己巳の日」のように干支や十二支に基づくものなど、由来や周期はさまざまです。</p>
    <p>これらの吉日は、それぞれ得意分野（金運・新規開始・全般的な吉事など）が異なるため、目的に合わせて使い分けるのが効果的です。開運カレンダーでは毎日、これらの吉日の重なりをチェックすることができます。</p>
  </section>

  <section class="art-section" id="list">
    <h2>吉日一覧</h2>
    <table class="kichijitsu-table">
      <tr><th>吉日名</th><th>意味・特徴</th><th>おすすめの行動</th></tr>
      <tr><td><strong>一粒万倍日</strong></td><td>一粒の籾（もみ）が万倍に実るという日。何かを始めると大きな成果につながるとされる。月に4〜6日ある。</td><td>新規事業の開始・貯金スタート・財布の購入・種まき</td></tr>
      <tr><td><strong>天赦日</strong></td><td>天が万物の罪を赦す最高の吉日。年に5〜6日しかない最も強力な吉日とされる。</td><td>何か新しいことを始める・重要な決断・結婚・開業</td></tr>
      <tr><td><strong>大安（六曜）</strong></td><td>六曜の中で最も縁起が良い日。すべての事柄に吉とされる。</td><td>結婚式・入籍・引越し・開業・大切な取引</td></tr>
      <tr><td><strong>寅の日</strong></td><td>寅（虎）が「千里行って千里戻る」という言い伝えから、金運の日とされる。</td><td>財布の購入・金運アップのお参り・旅行開始</td></tr>
      <tr><td><strong>己巳の日</strong></td><td>弁財天の縁日。金運・財運・芸術運アップに良いとされる。</td><td>弁財天へのお参り・財布の新調・芸術活動の開始</td></tr>
    </table>
  </section>

  <section class="art-section" id="detail">
    <h2>吉日の種類</h2>
    <div class="type-grid">
      <a href="/articles/calendar/kichijitsu/ichiryumanbai/" class="type-card"><div class="type-code">一粒万倍日</div><div class="type-name">いちりゅうまんばいび</div><div class="type-kw">始まりの日</div></a>
      <a href="/articles/calendar/kichijitsu/tenshabi/" class="type-card"><div class="type-code">天赦日</div><div class="type-name">てんしゃにち</div><div class="type-kw">年に5〜6日の最強吉日</div></a>
      <a href="/articles/calendar/rokuyo/taian/" class="type-card"><div class="type-code">大安（六曜）</div><div class="type-name">たいあん</div><div class="type-kw">六曜の最良日</div></a>
      <a href="/articles/calendar/kichijitsu/tora/" class="type-card"><div class="type-code">寅の日</div><div class="type-name">とらのひ</div><div class="type-kw">金運の日</div></a>
      <a href="/articles/calendar/kichijitsu/tsuchinotomi/" class="type-card"><div class="type-code">己巳の日</div><div class="type-name">つちのとみのひ</div><div class="type-kw">弁財天の縁日</div></a>
    </div>
  </section>

  <section class="art-section" id="kasane">
    <h2>重ね吉日とは</h2>
    <p>複数の吉日が同じ日に重なることを「重ね吉日」と呼びます。例えば「一粒万倍日」と「天赦日」が重なる日、「大安」と「一粒万倍日」が重なる日は、それぞれの吉日のパワーが掛け合わされ、特に縁起が良いとされています。</p>
    <p>逆に一粒万倍日と不成就日（ふじょうじゅび、何事も成就しないとされる凶日）が重なることもあり、この場合は吉凶が相殺されると考えられています。開運カレンダーで毎日の吉日の重なりを確認することで、大切なイベントの日取りをより効果的に選ぶことができます。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">一粒万倍日に何をすれば良いですか？</div>
        <div class="faq-a">一粒万倍日は「始まりの日」として最適とされます。新規事業の開始・貯金スタート・種まき・恋愛の告白などが縁起が良いとされます。逆に借金・弔事への参加は避けるべきとする説もあります。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">天赦日はどれくらいの頻度でありますか？</div>
        <div class="faq-a">天赦日は年に5〜6日しかない非常に貴重な吉日です。暦の上で最高の吉日とされ、結婚・開業・引越しなど人生の大きな決断に選ばれることが多いです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">寅の日と己巳の日はどちらも金運の日ですか？</div>
        <div class="faq-a">はい、どちらも金運アップに関連する吉日です。寅の日は「出したお金が戻ってくる」、己巳の日は「弁財天のご利益で金運・財運が高まる」とされ、財布の購入や新調に特に選ばれます。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul>
      <li>特別な吉日には一粒万倍日・天赦日・寅の日・己巳の日などがある。</li>
      <li>それぞれ得意分野が異なり、目的に合わせて使い分けると効果的。</li>
      <li>複数の吉日が重なる「重ね吉日」は特に縁起が良いとされる。</li>
      <li>開運カレンダーで毎日の吉日の重なりをチェックできる。</li>
    </ul>
  </section>

  <?php
  $ctaTitle = '📅 今日の吉日を確認する';
  $ctaText  = '吉方位・ラッキーカラー・運気の波を毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?php
  $prevUrl   = '/articles/calendar/gogyo/';
  $prevTitle = '陰陽五行とは';
  $prevLabel = '← 前のカテゴリ';
  $nextUrl   = null;
  $nextTitle = null;
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
      ['label'=>'六曜とは', 'title'=>'先勝・友引・大安など6つの日を知る →', 'url'=>'/articles/calendar/rokuyo/'],
      ['label'=>'九星気学とは', 'title'=>'今年・来年の運気の流れを知る →', 'url'=>'/articles/kyusei/'],
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

<?php $currentSlug='calendar-kichijitsu'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'kichijitsu');
?>
