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
  <link rel="canonical" href="https://life-fun.net/articles/shichu/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="四柱推命とは何か、命式・十神・大運・天中殺の意味をわかりやすく解説。年柱・月柱・日柱・時柱の読み方から十干十二支まで四柱推命の基礎を完全ガイド。">
  <title>四柱推命とは？命式・十神・大運・天中殺の意味をわかりやすく解説</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
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
    --bg2:#f2eeff;
    --card-bg:#ffffff;
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

  .cta-box{background:linear-gradient(135deg,#f5f0ff 0%,#fdf4fa 100%);border:1px solid #d4bfff;border-radius:12px;padding:1.25rem 1.5rem;margin:1.5rem 0;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
  .cta-box p{font-size:.9rem;color:var(--text);font-weight:500}
  .cta-box small{display:block;font-size:.78rem;color:var(--muted);margin-top:.2rem;font-weight:400}
  .cta-btn{display:inline-block;background:var(--accent);color:#fff;font-family:var(--ff-sans);font-size:.85rem;font-weight:500;padding:.65rem 1.5rem;border-radius:24px;text-decoration:none;white-space:nowrap;transition:background .2s,transform .15s}
  .cta-btn:hover{background:var(--accent-lt);transform:translateY(-1px)}

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

  /* 四柱テーブル */
  .shichu-table{width:100%;border-collapse:collapse;margin:1rem 0;font-size:.85rem}
  .shichu-table th{background:var(--bg2);border:1px solid var(--border);padding:.65rem .8rem;font-family:var(--ff-serif);font-weight:600;color:var(--text);text-align:center}
  .shichu-table td{border:1px solid var(--border);padding:.65rem .8rem;color:#333;line-height:1.7;vertical-align:top}
  .shichu-table td:first-child{font-weight:500;color:var(--accent);white-space:nowrap;text-align:center}

  /* 十干グリッド */
  .jikkan-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:.5rem;margin:1rem 0}
  .jikkan-card{background:var(--card-bg);border:1px solid var(--border);border-radius:8px;padding:.65rem .5rem;text-align:center}
  .jikkan-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.2rem}
  .jikkan-yomi{font-size:.68rem;color:var(--muted);margin-bottom:.3rem}
  .jikkan-elem{font-size:.7rem;padding:.15rem .5rem;border-radius:10px;display:inline-block}
  .elem-wood{background:#e8f5e9;color:#2e7d32}
  .elem-fire{background:#fce4ec;color:#b71c1c}
  .elem-earth{background:#fff8e1;color:#e65100}
  .elem-metal{background:#e3f2fd;color:#1565c0}
  .elem-water{background:#e0f7fa;color:#006064}

  /* FAQ */
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:400px;padding:.9rem 1.1rem}

  .related-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.75rem;margin-top:1rem}
  .related-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;text-decoration:none;display:block;transition:border-color .2s,transform .15s}
  .related-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .related-card-label{font-size:.7rem;color:var(--muted);margin-bottom:.3rem;font-family:var(--ff-mono)}
  .related-card-title{font-size:.9rem;font-weight:500;color:var(--accent)}

  @media(max-width:600px){
    .cta-box{flex-direction:column;align-items:flex-start}
    .jikkan-grid{grid-template-columns:repeat(5,1fr)}
  }
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "四柱推命は当たりますか？",
        "acceptedAnswer": {"@type":"Answer","text":"四柱推命は生年月日時から算出される統計的な占術で、性格傾向や人生の流れを読むのに優れています。ただし未来を断言するものではなく、自分を知るための羅針盤として活用するのがおすすめです。"}
      },
      {
        "@type": "Question",
        "name": "生まれた時間がわからなくても占えますか？",
        "acceptedAnswer": {"@type":"Answer","text":"はい。当サイトでは時柱なしでも命式を算出できます。時柱がない場合は年柱・月柱・日柱の3柱で鑑定します。精度はやや下がりますが、性格傾向や大運の流れは十分読み取れます。"}
      },
      {
        "@type": "Question",
        "name": "大運とは何ですか？",
        "acceptedAnswer": {"@type":"Answer","text":"大運とは10年ごとに切り替わる運勢の大きな流れのことです。四柱推命では人生を複数の大運期に分けて読み解き、各期にどんな運気が巡るかを示します。"}
      },
      {
        "@type": "Question",
        "name": "天中殺（空亡）とは何ですか？",
        "acceptedAnswer": {"@type":"Answer","text":"天中殺（空亡）とは、十二支のサイクルの中で自分の日柱に該当する2つの支が「空白」になる期間のことです。行動が空回りしやすい時期とされ、新しいことを始めるより現状維持が吉とされます。"}
      }
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
      {"@type":"ListItem","position":3,"name":"四柱推命解説","item":"https://life-fun.net/articles/shichu/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/shichu" class="art-back">🌙 四柱推命を算出 →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span>四柱推命
  </nav>

  <div class="art-hero">
    <span class="art-label">SHICHU SUIMEI · 完全ガイド</span>
    <h1>四柱推命とは？<br>命式・十神・大運・天中殺の意味をわかりやすく解説</h1>
    <p class="art-lead">四柱推命は生年月日と生まれた時刻から「命式」を算出し、性格・才能・人生の流れを読み解く東洋の占術です。年柱・月柱・日柱・時柱の4つの柱と、十干・十二支の組み合わせで導き出す命式は、あなたの人生の設計図といえます。</p>
  </div>

  <div class="cta-box">
    <div>
      <p>🌙 自分の命式を算出してみる</p>
      <small>生年月日を入力するだけ。十神・大運・天中殺まで無料で表示。</small>
    </div>
    <a href="/shichu" class="cta-btn">四柱推命を算出する →</a>
  </div>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">四柱推命とは</a></li>
      <li><a href="#history">四柱推命の歴史</a></li>
      <li><a href="#four-pillars">四柱（年柱・月柱・日柱・時柱）とは</a></li>
      <li><a href="#jikkan">十干とは</a></li>
      <li><a href="#junishi">十二支とは</a></li>
      <li><a href="#juushin">十神（通変星）とは</a></li>
      <li><a href="#daion">大運とは</a></li>
      <li><a href="#chukusat">天中殺（空亡）とは</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>四柱推命とは</h2>
    <p>四柱推命（しちゅうすいめい）は、生年・生月・生日・生時の4つを「柱」として命式を立て、その人の宿命や運命の流れを読む占術です。中国古来の陰陽五行思想を基盤とし、木・火・土・金・水の5つのエネルギーバランスから性格・才能・対人関係・人生の転換期を読み解きます。</p>
    <p>タロットや占星術と大きく異なるのは、「生まれた瞬間」が全ての起点になること。生年月日時さえわかれば、誰でも同じ命式が導き出されるため、再現性が高く本格的な統計占術として知られています。</p>
    <p>日本では「算命学」「九星気学」と並ぶ東洋三大占術のひとつとして定着しており、婚活・就職・起業のタイミングを判断する際に活用する人も多くいます。<br><a href="/articles/kyusei/" style="font-size:.85rem;color:var(--accent);">→ 九星気学について詳しく見る</a></p>
  </section>

  <section class="art-section" id="history">
    <h2>四柱推命の歴史</h2>
    <p>四柱推命の起源は中国・唐代（7〜10世紀）に遡ります。李虚中（りきょちゅう）が年・月・日の3柱で占ったのが始まりとされ、その後の宋代に徐子平（じょしへい）が「時柱」を加えて現在の4柱体系を完成させました。この徐子平の体系を「子平術（しへいじゅつ）」とも呼びます。</p>
    <p>日本には江戸時代に伝わり、明治以降に独自の発展を遂げました。現代日本では「四柱推命」という名称が一般的ですが、台湾・中国では「八字（はちじ）」と呼ばれ、アジア全域で広く親しまれています。</p>
  </section>

  <section class="art-section" id="four-pillars">
    <h2>四柱（年柱・月柱・日柱・時柱）とは</h2>
    <p>命式は4つの柱から構成されます。それぞれに「天干（てんかん）」と「地支（ちし）」が配置され、合計8文字になることから「八字（はちじ）」とも呼ばれます。</p>
    <table class="shichu-table">
      <thead>
        <tr><th>柱</th><th>何を表すか</th><th>関係する領域</th></tr>
      </thead>
      <tbody>
        <tr><td>年柱</td><td>生まれた年の干支</td><td>先祖・社会との関係・人生の土台</td></tr>
        <tr><td>月柱</td><td>生まれた月の干支</td><td>両親・兄弟・仕事・才能傾向</td></tr>
        <tr><td>日柱</td><td>生まれた日の干支</td><td>自分自身・配偶者・本質的な性格</td></tr>
        <tr><td>時柱</td><td>生まれた時間の干支</td><td>子供・晩年・目標・潜在能力</td></tr>
      </tbody>
    </table>
    <p>特に「日柱の天干（日干）」は自分自身を象徴する最重要の要素で、十干のどれにあたるかで基本的な性格や行動パターンが大きく変わります。</p>
  </section>

  <section class="art-section" id="jikkan">
    <h2>十干とは</h2>
    <p>十干（じっかん）は甲・乙・丙・丁・戊・己・庚・辛・壬・癸の10種類。木・火・土・金・水の五行それぞれに「陽（兄）」と「陰（弟）」があり、合計10になります。</p>
    <div class="jikkan-grid">
      <div class="jikkan-card"><div class="jikkan-name">甲</div><div class="jikkan-yomi">きのえ</div><span class="jikkan-elem elem-wood">木（陽）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">乙</div><div class="jikkan-yomi">きのと</div><span class="jikkan-elem elem-wood">木（陰）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">丙</div><div class="jikkan-yomi">ひのえ</div><span class="jikkan-elem elem-fire">火（陽）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">丁</div><div class="jikkan-yomi">ひのと</div><span class="jikkan-elem elem-fire">火（陰）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">戊</div><div class="jikkan-yomi">つちのえ</div><span class="jikkan-elem elem-earth">土（陽）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">己</div><div class="jikkan-yomi">つちのと</div><span class="jikkan-elem elem-earth">土（陰）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">庚</div><div class="jikkan-yomi">かのえ</div><span class="jikkan-elem elem-metal">金（陽）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">辛</div><div class="jikkan-yomi">かのと</div><span class="jikkan-elem elem-metal">金（陰）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">壬</div><div class="jikkan-yomi">みずのえ</div><span class="jikkan-elem elem-water">水（陽）</span></div>
      <div class="jikkan-card"><div class="jikkan-name">癸</div><div class="jikkan-yomi">みずのと</div><span class="jikkan-elem elem-water">水（陰）</span></div>
    </div>
    <p>自分の「日干」が何であるかは、命式算出結果の「日柱」天干で確認できます。甲・乙なら木の気質、丙・丁なら火の気質というように、五行の性質が性格に大きく影響します。</p>
  </section>

  <section class="art-section" id="junishi">
    <h2>十二支とは</h2>
    <p>十二支（じゅうにし）は子・丑・寅・卯・辰・巳・午・未・申・酉・戌・亥の12種類。干支（えと）として年に使われるなじみ深い概念ですが、四柱推命では月・日・時にも使われます。それぞれが五行と季節に対応しており、年・月・日・時の地支を読むことで季節的な運気の波を掴みます。</p>
    <p>十干と十二支を組み合わせた「干支（かんし）」は60通りあり（六十干支）、60年で一巡することから「還暦」の語源にもなっています。</p>
  </section>

  <section class="art-section" id="juushin">
    <h2>十神（通変星）とは</h2>
    <p>十神（じゅうしん）は「比肩・劫財・食神・傷官・偏財・正財・偏官・正官・偏印・印綬」の10種類。日干（自分）と他の干との五行関係から導き出され、対人関係・才能・仕事スタイル・財への意識などを読み解く重要な星です。</p>
    <table class="shichu-table">
      <thead>
        <tr><th>十神</th><th>主な意味</th></tr>
      </thead>
      <tbody>
        <tr><td>比肩・劫財</td><td>自我・競争心・兄弟・同僚との関係</td></tr>
        <tr><td>食神・傷官</td><td>表現力・創造性・話術・子供との関係</td></tr>
        <tr><td>偏財・正財</td><td>金銭感覚・父親との関係・実務能力</td></tr>
        <tr><td>偏官・正官</td><td>行動力・地位・職場環境・夫（女性命式）</td></tr>
        <tr><td>偏印・印綬</td><td>知性・学習能力・母親との関係・直感</td></tr>
      </tbody>
    </table>
    <p>命式の中でどの十神が多いかによって、その人の得意分野や人生のテーマが変わってきます。たとえば傷官が強い人は表現力や芸術センスに優れ、正官が強い人は組織の中で力を発揮しやすい傾向があります。</p>
  </section>

  <section class="art-section" id="daion">
    <h2>大運とは</h2>
    <p>大運（だいうん）とは、10年ごとに切り替わる運勢の大きなサイクルのことです。命式から「大運の起算点（大運起限）」を算出し、その後10年ごとに新しい干支が巡ってきます。</p>
    <p>大運は人生全体の「季節」のようなものです。良い大運のときは行動を起こしやすく成果が出やすい。逆に停滞気味の大運のときは内面を磨く・準備期間として活用するのが賢明とされます。</p>
    <p>大運は生まれた日から次の節入り日（二十四節気）までの日数を3で割って算出します。これが「大運起限（何歳から大運が始まるか）」となり、人によって2歳から始まる人もいれば9歳から始まる人もいます。</p>
  </section>

  <section class="art-section" id="chukusat">
    <h2>天中殺（空亡）とは</h2>
    <p>天中殺（てんちゅうさつ）、または空亡（くうぼう）とは、60干支の中で日干を基準にしたとき、「対応する地支が存在しない2つの支」のことを指します。干が10種・支が12種あるため、必ず2支が余りますが、この余りの2支が「空白（空亡）」になります。</p>
    <p>天中殺の期間（年・月・日）は「行動が空回りしやすい」「計画が狂いやすい」時期とされ、新しい契約・結婚・転職・引越しなどの大きな行動は避けるのが吉とされます。逆に内省・学習・下準備に充てると良い時間になるとも言われます。</p>
    <p>ただし天中殺はあくまで傾向のひとつ。命式全体のバランスや大運との関係も含めて判断するのが正しい読み方です。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">四柱推命は当たりますか？</div>
        <div class="faq-a">四柱推命は生年月日時から算出される統計的な占術で、性格傾向や人生の流れを読むのに優れています。ただし未来を断言するものではなく、自分を知るための羅針盤として活用するのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">生まれた時間がわからなくても占えますか？</div>
        <div class="faq-a">はい。当サイトでは時柱なしでも命式を算出できます。時柱がない場合は年柱・月柱・日柱の3柱で鑑定します。精度はやや下がりますが、性格傾向や大運の流れは十分読み取れます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">大運とは何ですか？</div>
        <div class="faq-a">大運とは10年ごとに切り替わる運勢の大きな流れのことです。四柱推命では人生を複数の大運期に分けて読み解き、各期にどんな運気が巡るかを示します。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">天中殺（空亡）とは何ですか？</div>
        <div class="faq-a">天中殺（空亡）とは、十二支のサイクルの中で日柱に対応する2支が「空白」になる期間のことです。行動が空回りしやすい時期とされ、新しいことを始めるより現状維持・準備期間として活用するのが吉とされます。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>四柱推命で自分の命式を知ったら、他の占術でも多角的に分析してみましょう。</p>
    <div class="related-grid">
      <a href="/" class="related-card" style="border-color:#d4bfff;background:linear-gradient(135deg,#f5f0ff,#fdf4fa)">
        <div class="related-card-label" style="color:var(--accent)">三星統合鑑定</div>
        <div class="related-card-title">四柱推命・タロット・数秘術をまとめて鑑定 →</div>
      </a>
      <a href="/tarot" class="related-card">
        <div class="related-card-label">タロット占い</div>
        <div class="related-card-title">今この瞬間のメッセージを受け取る →</div>
      </a>
      <a href="/kyusei" class="related-card">
        <div class="related-card-label">九星気学</div>
        <div class="related-card-title">今年・来年の運気の周期を知る →</div>
      </a>
      <a href="/numerology" class="related-card">
        <div class="related-card-label">数秘術</div>
        <div class="related-card-title">誕生日から運命数を読み解く →</div>
      </a>
      <a href="/aisho" class="related-card">
        <div class="related-card-label">相性診断</div>
        <div class="related-card-title">気になる相手との相性を占う →</div>
      </a>
    </div>
  </section>

  <div class="cta-box" style="margin:2.5rem 0 0">
    <div>
      <p>🌙 あなたの命式を無料で算出する</p>
      <small>生年月日を入力するだけ。十神・大運・天中殺まで表示します。</small>
    </div>
    <a href="/shichu" class="cta-btn">四柱推命を算出する →</a>
  </div>

</div>


<script>
function toggleFaq(el){
  el.parentElement.classList.toggle('open');
}
</script>
<?php $currentSlug='shichu'; $pageType='article'; require __DIR__.'/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'shichu');
?>
