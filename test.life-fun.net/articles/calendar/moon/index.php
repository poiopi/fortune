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
  <link rel="canonical" href="https://life-fun.net/articles/calendar/moon/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="新月・満月など月の満ち欠け（月相）の意味とスピリチュアルな解釈をわかりやすく解説。8つの月相の特徴とおすすめの過ごし方を紹介します。">
  <title>月の満ち欠け（月相）とは？8つの月相の意味を完全解説</title>
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
      {"@type":"ListItem","position":4,"name":"月の満ち欠けとは","item":"https://life-fun.net/articles/calendar/moon/"}
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
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/calendar/">開運カレンダーとは</a><span>›</span>月の満ち欠けとは
  </nav>

  <div class="art-hero">
    <span class="art-label">MOON PHASE · 完全ガイド</span>
    <h1>月の満ち欠け（月相）とは？<br>8つの月相の意味を完全解説</h1>
    <p class="art-lead">月は新月から満月を経て再び新月に戻るまで、およそ29.5日かけて姿を変えていきます。この一巡りの中で月が見せる8つの表情を「月相」と呼び、それぞれに異なる意味やおすすめの過ごし方があるとされています。</p>
  </div>

  <?php
  $ctaTitle = '📅 今日の月齢を確認する';
  $ctaText  = '今日の月相・月齢を毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">月相とは</a></li>
      <li><a href="#list">8つの月相一覧</a></li>
      <li><a href="#enjoy">月相ごとの楽しみ方</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>月相とは</h2>
    <p>月相とは、地球から見た月の満ち欠けの状態を指す言葉です。太陽・地球・月の位置関係によって、月に当たる太陽光のうち地球から見える部分の割合が変化し、新月から満月、そして再び新月へと、およそ29.5日（1朔望月）かけて姿を変えていきます。占いやスピリチュアルの分野では、この周期を「始まり」から「集大成」、そして「手放し」へと続く一つの物語として捉え、日々の過ごし方の参考にする考え方があります。</p>
  </section>

  <section class="art-section" id="list">
    <h2>8つの月相一覧</h2>
    <table class="kichijitsu-table">
      <tr><th>月相名</th><th>読み方</th><th>意味・特徴</th><th>おすすめの過ごし方</th></tr>
      <tr><td><strong>新月</strong></td><td>しんげつ</td><td>太陽の光が当たる面が見えなくなる状態。すべての始まりを象徴する。</td><td>新しい習慣を始める・目標や願い事を書き出す</td></tr>
      <tr><td><strong>三日月</strong></td><td>みかづき</td><td>新月から数日、細い光の弧が見え始める成長初期の月。芽生えを象徴する。</td><td>情報収集や準備・小さな行動を積み重ねる</td></tr>
      <tr><td><strong>上弦の月</strong></td><td>じょうげんのつき</td><td>右半分が輝く半月。新月と満月の中間で、決断と行動を象徴する。</td><td>迷っていたことを決断する・新しい挑戦</td></tr>
      <tr><td><strong>十三夜月</strong></td><td>じゅうさんやづき</td><td>満月の一歩手前、丸みを帯びたふっくらとした形。仕上げと集中を象徴する。</td><td>進めてきたことの仕上げ・最終調整に集中</td></tr>
      <tr><td><strong>満月</strong></td><td>まんげつ</td><td>丸く満ちて輝く、最も明るい状態の月。物事の集大成を象徴する。</td><td>努力を振り返る・成果に感謝する</td></tr>
      <tr><td><strong>十六夜月</strong></td><td>いざよいづき</td><td>満月の翌晩、わずかに欠け始めた月。余韻を味わう時期を象徴する。</td><td>満月で得た気づきをゆっくり振り返る</td></tr>
      <tr><td><strong>下弦の月</strong></td><td>かげんのつき</td><td>左半分が輝く半月。満月から新月へ向かい、手放しと整理を象徴する。</td><td>部屋やデータの整理・不要な習慣の見直し</td></tr>
      <tr><td><strong>二十六夜月</strong></td><td>にじゅうろくやづき</td><td>新月直前、光がごく細くなった月。静けさと内省を象徴する。</td><td>休息をとる・これまでの一巡りを振り返る</td></tr>
    </table>
  </section>

  <section class="art-section" id="detail">
    <h2>月相の種類</h2>
    <div class="type-grid">
      <a href="/articles/calendar/moon/shingetsu/" class="type-card"><div class="type-code">New Moon</div><div class="type-name">新月</div><div class="type-kw">始まり</div></a>
      <a href="/articles/calendar/moon/mikazuki/" class="type-card"><div class="type-code">Waxing Crescent</div><div class="type-name">三日月</div><div class="type-kw">芽生え</div></a>
      <a href="/articles/calendar/moon/jougen/" class="type-card"><div class="type-code">First Quarter Moon</div><div class="type-name">上弦の月</div><div class="type-kw">決断</div></a>
      <a href="/articles/calendar/moon/juusanya/" class="type-card"><div class="type-code">Waxing Gibbous Moon</div><div class="type-name">十三夜月</div><div class="type-kw">仕上げ</div></a>
      <a href="/articles/calendar/moon/mangetsu/" class="type-card"><div class="type-code">Full Moon</div><div class="type-name">満月</div><div class="type-kw">集大成</div></a>
      <a href="/articles/calendar/moon/izayoi/" class="type-card"><div class="type-code">Waning Gibbous Moon</div><div class="type-name">十六夜月</div><div class="type-kw">余韻</div></a>
      <a href="/articles/calendar/moon/kagen/" class="type-card"><div class="type-code">Last Quarter Moon</div><div class="type-name">下弦の月</div><div class="type-kw">手放し</div></a>
      <a href="/articles/calendar/moon/nijuurokuya/" class="type-card"><div class="type-code">Waning Crescent Moon</div><div class="type-name">二十六夜月</div><div class="type-kw">静けさ</div></a>
    </div>
  </section>

  <section class="art-section" id="enjoy">
    <h2>月相ごとの楽しみ方</h2>
    <p>月相は一つひとつを個別に楽しむこともできますが、新月から満月、そして次の新月までの一巡りをストーリーとして意識すると、日々の過ごし方にリズムが生まれます。開運カレンダーでは今日の月相を毎日確認できるので、気になる月相の日にその過ごし方を試してみるのもおすすめです。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">月相はいくつありますか？</div>
        <div class="faq-a">一般的には新月・三日月・上弦の月・十三夜月・満月・十六夜月・下弦の月・二十六夜月の8つに分類されます。実際の月の満ち欠けは連続的に変化していますが、区切りやすいようにこの8区分が広く使われています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">月相はどのくらいの周期で一巡りしますか？</div>
        <div class="faq-a">新月から次の新月まで、およそ29.5日（1朔望月）かけて一巡りします。1年におよそ12〜13回、この周期が繰り返されます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">月相占いに科学的な根拠はありますか？</div>
        <div class="faq-a">月相の満ち欠け自体は天文学的な事実ですが、それが運勢や気分に影響するという考え方は、科学的に実証されたものではありません。あくまで一つの文化・楽しみ方として参考にするのがおすすめです。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul>
      <li>月相とは、地球から見た月の満ち欠けの状態を8つに分類したもの。</li>
      <li>新月から満月、再び新月まで、およそ29.5日の周期で一巡りする。</li>
      <li>占いの分野では「始まり」から「集大成」「手放し」へ続く物語として捉えられる。</li>
      <li>開運カレンダーで今日の月相を確認しながら、日々の過ごし方の参考にできる。</li>
    </ul>
  </section>

  <?php
  $ctaTitle = '📅 今日の月齢を確認する';
  $ctaText  = '今日のラッキーアイテムや運気の波も毎日更新でお届け。';
  $ctaUrl   = '/calendar';
  $ctaBtn   = '開運カレンダーを見る →';
  require __DIR__.'/../../../inc/article-cta.php';
  ?>

  <?php
  $prevUrl   = null;
  $prevTitle = null;
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
      ['label'=>'特別な吉日とは', 'title'=>'一粒万倍日・天赦日・寅の日を知る →', 'url'=>'/articles/calendar/kichijitsu/'],
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

<?php $currentSlug='calendar-moon'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'moon');
?>
