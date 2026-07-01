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
  <link rel="canonical" href="https://life-fun.net/articles/calendar/rokuyo/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="六曜（先勝・友引・先負・仏滅・大安・赤口）の意味と由来、それぞれの日にすべき行動・避けるべき行動をわかりやすく解説。">
  <title>六曜とは？先勝・友引・先負・仏滅・大安・赤口の意味を完全解説</title>
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
  .rokuyo-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.88rem}
  .rokuyo-table th{background:var(--accent);color:#fff;padding:.65rem .9rem;text-align:left;font-family:var(--ff-serif);font-weight:600}
  .rokuyo-table td{padding:.65rem .9rem;border-bottom:1px solid var(--border);line-height:1.7}
  .rokuyo-table tr:nth-child(even) td{background:var(--bg2)}
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
      {"@type":"ListItem","position":4,"name":"六曜とは","item":"https://life-fun.net/articles/calendar/rokuyo/"}
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/calendar/">開運カレンダーとは</a><span>›</span>六曜とは
  </nav>

  <div class="art-hero">
    <span class="art-label">ROKUYO · 完全ガイド</span>
    <h1>六曜とは？<br>先勝・友引・先負・仏滅・大安・赤口の意味を完全解説</h1>
    <p class="art-lead">六曜（ろくよう）は、暦の上で6日周期で巡る「先勝・友引・先負・仏滅・大安・赤口」の吉凶日です。結婚式・引越し・契約など、日本の生活に今も根付く伝統的な吉凶判断の指標を、由来からそれぞれの日の過ごし方まで詳しく解説します。</p>
  </div>

  <?php
  $ctaTitle = '📅 今日の六曜を確認する';
  $ctaText  = '今日が大安か仏滅か、開運カレンダーで毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">六曜とは</a></li>
      <li><a href="#list">六曜一覧</a></li>
      <li><a href="#order">六曜の順番と決まり方</a></li>
      <li><a href="#types">六曜の種類</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>六曜とは</h2>
    <p>六曜（ろくよう）とは、中国から伝わった暦注（れきちゅう）の一つで、「先勝・友引・先負・仏滅・大安・赤口」の6種類が日ごとに順番に巡ってくる吉凶の指標です。現在の日本では冠婚葬祭のスケジュールを決める際の目安として広く使われており、カレンダーや手帳にも小さく記載されていることが多い、最も身近な暦注です。</p>
    <p>六曜は旧暦の月日をもとに機械的に決まる周期で、月が変わるタイミングで一度順番がリセットされる特徴があります。そのため西暦のカレンダー上では規則性がないように見えますが、実際には旧暦のルールに基づいた一定の計算方法があります。</p>
  </section>

  <section class="art-section" id="list">
    <h2>六曜一覧</h2>
    <table class="rokuyo-table">
      <tr><th>六曜</th><th>意味</th><th>向いていること</th></tr>
      <tr><td><strong>先勝</strong>（せんしょう）</td><td>「先んずれば即ち勝つ」。午前中が吉、午後は凶。</td><td>急ぎの用事・訴訟・勝負事</td></tr>
      <tr><td><strong>友引</strong>（ともびき）</td><td>「友を引く」。祝い事は吉、葬儀は凶とされる。</td><td>結婚式・お祝い事</td></tr>
      <tr><td><strong>先負</strong>（せんぶ・さきまけ）</td><td>「先んずれば即ち負ける」。午前中が凶、午後は吉。</td><td>静かに過ごす・急用を避ける</td></tr>
      <tr><td><strong>仏滅</strong>（ぶつめつ）</td><td>六曜の中で最も凶とされる日。「仏も滅する」ほどの凶日。</td><td>静養・新しいことは避ける</td></tr>
      <tr><td><strong>大安</strong>（たいあん）</td><td>六曜の中で最も縁起が良いとされる日。すべてに吉。</td><td>結婚式・入籍・引越し・開業</td></tr>
      <tr><td><strong>赤口</strong>（しゃっこう・しゃっく）</td><td>正午のみ吉、それ以外は凶とされる日。</td><td>火や刃物に注意、正午前後の用事</td></tr>
    </table>
  </section>

  <section class="art-section" id="order">
    <h2>六曜の順番と決まり方</h2>
    <p>六曜は「先勝→友引→先負→仏滅→大安→赤口」の順で毎日1つずつ進みます。この順番は旧暦の1日（ついたち）を基準にリセットされ、旧暦1月1日・7月1日は必ず「先勝」から始まる、といったルールで決まっています。</p>
    <p>そのため新暦カレンダー上では不規則な巡りに見えますが、月の変わり目（特に旧暦の月初め）で順番が飛ぶことがあり、これが「今日は仏滅の次が友引じゃない」といった違和感の正体です。</p>
  </section>

  <section class="art-section" id="types">
    <h2>六曜の種類</h2>
    <div class="type-grid">
      <a href="/articles/calendar/rokuyo/senshou/" class="type-card"><div class="type-code">先勝</div><div class="type-name">せんしょう</div><div class="type-kw">午前は吉、午後は凶</div></a>
      <div class="type-card"><div class="type-code">友引</div><div class="type-name">ともびき</div><div class="type-kw">祝い事に良い日</div></div>
      <div class="type-card"><div class="type-code">先負</div><div class="type-name">せんぶ</div><div class="type-kw">午後が吉の日</div></div>
      <div class="type-card"><div class="type-code">仏滅</div><div class="type-name">ぶつめつ</div><div class="type-kw">最も凶とされる日</div></div>
      <div class="type-card"><div class="type-code">大安</div><div class="type-name">たいあん</div><div class="type-kw">最も縁起が良い日</div></div>
      <div class="type-card"><div class="type-code">赤口</div><div class="type-name">しゃっこう</div><div class="type-kw">正午のみ吉の日</div></div>
    </div>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">六曜に科学的な根拠はありますか？</div>
        <div class="faq-a">六曜は中国の占術に由来する暦注で、科学的な根拠があるものではありません。ただし日本の冠婚葬祭文化に深く根付いており、特に結婚式場や葬儀場の予約状況・料金設定に影響を与えるなど、社会的な慣習として今も強く機能しています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">仏滅に結婚式を挙げてはいけないのですか？</div>
        <div class="faq-a">絶対に避けなければならないわけではありません。近年は六曜を気にしないカップルも増えており、仏滅の結婚式場は割引になることもあります。ただし年配の親族が気にするケースもあるため、招待客の顔ぶれを考慮して決めるのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">友引に葬儀を避けるのはなぜですか？</div>
        <div class="faq-a">「友を引く」という字面から、友引の葬儀は「故人が友人をあの世に引き連れていく」と連想されるため、古くから避けられてきました。この慣習が根強く残っているため、多くの火葬場が友引を休業日にしています。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul>
      <li>六曜は先勝・友引・先負・仏滅・大安・赤口の6日周期で巡る伝統的な吉凶日。</li>
      <li>旧暦の月初めを基準に順番がリセットされるため、新暦カレンダー上では不規則に見える。</li>
      <li>大安は最も縁起が良く、仏滅は最も凶とされ、冠婚葬祭の日取りに今も強く影響する。</li>
      <li>科学的根拠はないが、社会的な慣習として結婚式場・葬儀場の運営にも影響を与えている。</li>
    </ul>
  </section>

  <?php
  $ctaTitle = '📅 今日の六曜を確認する';
  $ctaText  = '吉方位・ラッキーカラー・運気の波を毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?php
  $prevUrl   = null;
  $prevTitle = null;
  $nextUrl   = '/articles/calendar/rokuyo/senshou/';
  $nextTitle = '先勝';
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
      ['label'=>'数秘術とは', 'title'=>'誕生日から運命数を計算して読み解く →', 'url'=>'/articles/numerology/'],
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

<?php $currentSlug='calendar-rokuyo'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'rokuyo');
?>
