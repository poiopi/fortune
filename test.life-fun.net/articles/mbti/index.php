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
  <link rel="canonical" href="https://life-fun.net/articles/mbti/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MBTIの16タイプ性格診断と星座占いを組み合わせた性格分析。各タイプの特徴・相性・強みを解説。">
  <title>MBTI診断とは？16タイプの性格と星座の組み合わせをわかりやすく解説</title>
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
  .type-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s}
  .type-card:hover{border-color:var(--accent-lt)}
  .type-code{font-family:var(--ff-mono);font-size:.8rem;color:var(--accent);letter-spacing:.08em;margin-bottom:.25rem}
  .type-name{font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:var(--text);margin-bottom:.25rem}
  .type-kw{font-size:.75rem;color:var(--muted);line-height:1.6}
  .group-label{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);margin:1.5rem 0 .5rem;padding:.4rem .8rem;background:var(--bg2);border-radius:6px;display:inline-block}
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
      {"@type":"Question","name":"MBTIは科学的ですか？","acceptedAnswer":{"@type":"Answer","text":"MBTIはユング心理学をベースに開発された心理測定ツールで、学術的な研究でも多く使用されています。ただし「性格タイプ」という概念は科学的に完全に証明されたわけではなく、あくまで傾向を把握するためのモデルとして捉えるのが適切です。自己理解のツールとして楽しく活用しましょう。"}},
      {"@type":"Question","name":"MBTIのタイプは変わることがありますか？","acceptedAnswer":{"@type":"Answer","text":"はい、変わることがあります。特に若いうちや大きなライフイベントの後は変化しやすいとされています。MBTIは「その時点での傾向」を示すもので、人間の成長や環境変化を反映します。定期的に診断してみると変化を楽しめます。"}},
      {"@type":"Question","name":"星座との組み合わせにはどんな意味がありますか？","acceptedAnswer":{"@type":"Answer","text":"MBTIは心理的傾向（思考・行動パターン）を、星座は感情的・直感的な面を表すとされます。両者を組み合わせることで「論理的だけど感情面では繊細」など、より立体的な性格像が浮かび上がります。あくまで参考として楽しむのがおすすめです。"}},
      {"@type":"Question","name":"診断には何分かかりますか？","acceptedAnswer":{"@type":"Answer","text":"当サイトのMBTI×星座診断は生年月日と簡単な質問に答えるだけで、約2〜3分で結果が出ます。本格的なMBTI公式テストは90問以上あり20〜30分かかりますが、当サイトは手軽さを重視した簡易診断版です。"}}
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
      {"@type":"ListItem","position":3,"name":"MBTI診断とは","item":"https://life-fun.net/articles/mbti/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/mbti" class="art-back">🧠 MBTI×星座を診断する →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>MBTI診断とは
  </nav>

  <div class="art-hero">
    <span class="art-label">MBTI · 完全ガイド</span>
    <h1>MBTI診断とは？<br>16タイプの性格と星座の組み合わせをわかりやすく解説</h1>
    <p class="art-lead">MBTI（Myers-Briggs Type Indicator）は、ユング心理学をベースに開発された世界最大規模の性格タイプ診断です。E/I・S/N・T/F・J/Pの4軸16タイプで性格傾向を把握し、星座占いと組み合わせることで、より立体的な自己理解が得られます。</p>
  </div>

  <?php
$ctaTitle = '🧠 あなたのMBTI×星座タイプを調べる';
$ctaText  = '生年月日と簡単な質問に答えるだけで16タイプの詳細解説が出力。';
$ctaUrl   = '/mbti';
$ctaBtn   = 'MBTI×星座を診断する →';
require __DIR__.'/../../inc/article-cta.php';
  ?>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">MBTI診断とは</a></li>
      <li><a href="#axes">4つの指標（E/I, S/N, T/F, J/P）</a></li>
      <li><a href="#types">16タイプ一覧</a></li>
      <li><a href="#zodiac">星座との組み合わせ</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>MBTI診断とは</h2>
    <p>MBTI（Myers-Briggs Type Indicator）は、1940年代にキャサリン・ブリッグスとイザベル・マイヤーズ親子がカール・ユングの「心理学的タイプ論」をもとに開発した性格タイプ診断です。世界170カ国以上で年間2000万人以上が受検するとされ、企業の採用・チームビルディング・自己啓発など多くの場面で活用されています。</p>
    <p>MBTIの特徴は、人間の認知・判断のパターンを「どちらかの傾向が強いか」という二項対立で捉える点にあります。優劣をつけるのではなく、すべてのタイプに等しく長所があることが前提となっています。</p>
    <p>当サイトではMBTIタイプと星座を組み合わせた診断を提供しています。MBTIが「思考・行動の傾向」を、星座が「感情・直感的な面」を補完し合うことで、よりリアルな性格分析が得られます。</p>
  </section>

  <section class="art-section" id="axes">
    <h2>4つの指標</h2>
    <h3>E（外向）/ I（内向）— エネルギーの方向</h3>
    <p>Extraversion（外向）は外の世界・人との交流でエネルギーを充電するタイプ。Introversion（内向）は内面の思考・独処でエネルギーを回復するタイプ。社交性の高低ではなく「エネルギー源がどこか」を示します。</p>
    <h3>S（感覚）/ N（直感）— 情報収集の方法</h3>
    <p>Sensing（感覚）は五感で感じる具体的な事実・現実を重視。iNtuition（直感）は全体像・パターン・可能性・未来を重視します。</p>
    <h3>T（思考）/ F（感情）— 意思決定の方法</h3>
    <p>Thinking（思考）は論理・客観的分析で決断。Feeling（感情）は価値観・人への影響・感情的な調和を優先して決断します。</p>
    <h3>J（判断）/ P（知覚）— 外の世界への接し方</h3>
    <p>Judging（判断）は計画・秩序・決断を好む傾向。Perceiving（知覚）は柔軟性・自発性・選択肢を開いておくことを好む傾向です。</p>
  </section>

  <section class="art-section" id="types">
    <h2>16タイプ一覧</h2>
    <p>4軸の組み合わせで生まれる16タイプをグループ別に紹介します。</p>

    <p class="group-label">🔵 アナリスト（NT）</p>
    <div class="type-grid">
      <a href="/articles/mbti/intj/" class="type-card"><div class="type-code">INTJ</div><div class="type-name">建築家</div><div class="type-kw">戦略的・独立・完璧主義</div></a>
      <div class="type-card"><div class="type-code">INTP</div><div class="type-name">論理学者</div><div class="type-kw">分析的・創造的・内向的</div></div>
      <div class="type-card"><div class="type-code">ENTJ</div><div class="type-name">指揮官</div><div class="type-kw">リーダー・断固・カリスマ</div></div>
      <div class="type-card"><div class="type-code">ENTP</div><div class="type-name">討論者</div><div class="type-kw">革新的・挑戦的・機知</div></div>
    </div>

    <p class="group-label">🟢 外交官（NF）</p>
    <div class="type-grid">
      <div class="type-card"><div class="type-code">INFJ</div><div class="type-name">提唱者</div><div class="type-kw">理想主義・洞察力・使命感</div></div>
      <div class="type-card"><div class="type-code">INFP</div><div class="type-name">仲介者</div><div class="type-kw">詩的・繊細・忠実</div></div>
      <div class="type-card"><div class="type-code">ENFJ</div><div class="type-name">主人公</div><div class="type-kw">カリスマ・共感・指導力</div></div>
      <div class="type-card"><div class="type-code">ENFP</div><div class="type-name">運動家</div><div class="type-kw">熱狂的・創造的・社交的</div></div>
    </div>

    <p class="group-label">🟡 番人（SJ）</p>
    <div class="type-grid">
      <div class="type-card"><div class="type-code">ISTJ</div><div class="type-name">管理者</div><div class="type-kw">誠実・責任感・伝統重視</div></div>
      <div class="type-card"><div class="type-code">ISFJ</div><div class="type-name">擁護者</div><div class="type-kw">思いやり・勤勉・献身</div></div>
      <div class="type-card"><div class="type-code">ESTJ</div><div class="type-name">幹部</div><div class="type-kw">組織力・実直・リーダー</div></div>
      <div class="type-card"><div class="type-code">ESFJ</div><div class="type-name">領事</div><div class="type-kw">協調性・思いやり・社交</div></div>
    </div>

    <p class="group-label">🔴 探検家（SP）</p>
    <div class="type-grid">
      <div class="type-card"><div class="type-code">ISTP</div><div class="type-name">巨匠</div><div class="type-kw">大胆・実用的・器用</div></div>
      <div class="type-card"><div class="type-code">ISFP</div><div class="type-name">冒険家</div><div class="type-kw">柔軟・魅力的・自発的</div></div>
      <div class="type-card"><div class="type-code">ESTP</div><div class="type-name">起業家</div><div class="type-kw">行動的・エネルギッシュ・観察力</div></div>
      <div class="type-card"><div class="type-code">ESFP</div><div class="type-name">エンターテイナー</div><div class="type-kw">自発的・楽観的・明るい</div></div>
    </div>
  </section>

  <section class="art-section" id="zodiac">
    <h2>星座との組み合わせ</h2>
    <p>西洋占星術の12星座は、太陽が位置する星座（生まれた月の星座）によって決まります。牡羊座・牡牛座・双子座・蟹座・獅子座・乙女座・天秤座・蠍座・射手座・山羊座・水瓶座・魚座の12種類です。</p>
    <p>MBTIが「思考・行動パターンの傾向」を示すのに対し、星座は「感情・直感・潜在的な欲求」の面を補います。たとえばINTJ（建築家）でも、蟹座なら「論理的だが感情面では家族や親しい人を大切にする」という傾向が浮かび上がります。</p>
    <p>MBTIタイプ×星座の組み合わせは192通りに上り、同じMBTIタイプでも星座によって微妙に異なる性格の「陰影」が現れます。診断結果を読むときは、MBTIの基本特性と星座の特性が重なる部分に注目してみてください。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">MBTIは科学的ですか？</div>
        <div class="faq-a">MBTIはユング心理学をベースに開発された心理測定ツールで、学術的な研究でも多く使用されています。ただし「性格タイプ」という概念は科学的に完全に証明されたわけではなく、傾向を把握するためのモデルとして捉えるのが適切です。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">MBTIのタイプは変わることがありますか？</div>
        <div class="faq-a">はい、変わることがあります。特に若いうちや大きなライフイベントの後は変化しやすいとされています。MBTIは「その時点での傾向」を示すもので、人間の成長や環境変化を反映します。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">星座との組み合わせにはどんな意味がありますか？</div>
        <div class="faq-a">MBTIは心理的傾向（思考・行動パターン）を、星座は感情的・直感的な面を表すとされます。両者を組み合わせることで「論理的だけど感情面では繊細」など、より立体的な性格像が浮かび上がります。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">診断には何分かかりますか？</div>
        <div class="faq-a">当サイトのMBTI×星座診断は生年月日と簡単な質問に答えるだけで、約2〜3分で結果が出ます。本格的なMBTI公式テストは90問以上あり20〜30分かかりますが、当サイトは手軽さを重視した簡易診断版です。</div>
      </div>
    </div>
    </section>

  <?php require __DIR__.'/../../inc/article-cta.php'; ?>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>性格・相性をさらに多角的に知りたい方はこちらもどうぞ。</p>
    <?php
    $relatedItems = [
      ['label'=>'三星統合鑑定', 'title'=>'四柱推命・数秘・九星を統合して鑑定する →', 'url'=>'/'],
      ['label'=>'相性診断とは', 'title'=>'誕生日・血液型・星座で相性を占う仕組みを解説 →', 'url'=>'/articles/aisho/'],
      ['label'=>'数秘術とは', 'title'=>'運命数の計算方法と意味を解説 →', 'url'=>'/articles/numerology/'],
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

<?php $currentSlug='mbti'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'mbti');
?>

