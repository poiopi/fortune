<?php declare(strict_types=1); ?>
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
  <link rel="canonical" href="https://life-fun.net/articles/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="タロット・四柱推命・MBTI・九星気学など各占術の意味・歴史・活用方法をわかりやすく解説。無料占いをより深く楽しむための占い解説ガイド。">
  <title>占い解説ガイド｜タロット・四柱推命・MBTIなど各占術を徹底解説</title>
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

  /* ── HEADER ── */
  .art-header{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:100}
  .art-header-inner{max-width:860px;margin:0 auto;padding:0 1.2rem;display:flex;align-items:center;justify-content:space-between;height:52px}
  .art-logo{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);text-decoration:none}
  .art-logo em{font-style:italic;color:var(--gold)}
  .art-back{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.25rem .75rem;border-radius:20px;transition:border-color .2s,color .2s}
  .art-back:hover{border-color:var(--accent-lt);color:var(--accent)}

  /* ── WRAP ── */
  .wrap{max-width:860px;margin:0 auto;padding:0 1.2rem}

  /* ── HERO ── */
  .hub-hero{padding:2.5rem 0 2rem;text-align:center;border-bottom:1px solid var(--border)}
  .hub-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.22em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .hub-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2rem);font-weight:700;color:var(--text);letter-spacing:.04em;margin-bottom:.75rem}
  .hub-hero p{font-size:.9rem;color:var(--muted);max-width:520px;margin:0 auto}

  /* ── CATEGORY ── */
  .cat-section{padding:2.5rem 0}
  .cat-section + .cat-section{padding-top:0}
  .cat-label{display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem}
  .cat-label-text{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text)}
  .cat-label-line{flex:1;height:1px;background:var(--border)}

  /* ── ARTICLE CARD ── */
  .article-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1rem}
  .article-card{background:var(--card-bg);border:1px solid var(--border);border-radius:14px;padding:1.25rem;display:flex;flex-direction:column;gap:.75rem;transition:border-color .2s,transform .15s}
  .article-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .article-card-head{display:flex;align-items:flex-start;gap:.75rem}
  .article-card-icon{font-size:1.6rem;line-height:1;flex-shrink:0}
  .article-card-title{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);line-height:1.35}
  .article-card-desc{font-size:.8rem;color:var(--muted);line-height:1.7}

  /* ── CARD BTN ROW ── */
  .card-btns{display:flex;gap:.5rem;margin-top:.25rem}
  .btn-read{
    flex:1;display:inline-flex;align-items:center;justify-content:center;gap:.35rem;
    background:var(--accent);color:#fff;
    font-size:.78rem;font-weight:500;padding:.5rem .75rem;border-radius:20px;
    text-decoration:none;transition:background .2s;white-space:nowrap;
  }
  .btn-read:hover{background:var(--accent-lt)}
  .btn-fortune{
    flex:1;display:inline-flex;align-items:center;justify-content:center;gap:.35rem;
    background:transparent;color:var(--accent);
    border:1px solid rgba(124,77,206,.4);
    font-size:.78rem;font-weight:500;padding:.5rem .75rem;border-radius:20px;
    text-decoration:none;transition:border-color .2s,background .2s;white-space:nowrap;
  }
  .btn-fortune:hover{border-color:var(--accent);background:rgba(124,77,206,.05)}

  /* ── POPULAR PICKS ── */
  .popular-picks{padding:1.5rem 0;border-bottom:1px solid var(--border)}
  .popular-picks-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;color:var(--accent);text-transform:uppercase;margin-bottom:.85rem}
  .popular-picks-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.6rem}
  .pick-card{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:.9rem;display:flex;flex-direction:column;gap:.3rem;text-decoration:none;transition:border-color .2s,transform .15s}
  .pick-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .pick-icon{font-size:1.4rem;line-height:1}
  .pick-name{font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:var(--text)}
  .pick-desc{font-size:.72rem;color:var(--muted)}
  .pick-btn{font-size:.72rem;color:var(--accent);margin-top:.2rem}

  /* ── HUB INTRO ── */
  .hub-intro{padding:1.5rem 0;border-bottom:1px solid var(--border)}
  .hub-intro p{font-size:.88rem;color:#444;line-height:1.9;margin-bottom:.75rem}
  .hub-intro p:last-child{margin-bottom:0}

  /* ── COMING SOON ── */
  .btn-coming{background:var(--border)!important;color:var(--muted)!important;cursor:default;pointer-events:none}

  /* ── POPULAR ── */
  .popular-section{background:var(--bg2);border-radius:14px;padding:1.5rem;margin:2rem 0}
  .popular-title{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:1rem}
  .popular-list{display:flex;flex-direction:column;gap:.5rem;counter-reset:popular}
  .popular-item{display:flex;align-items:center;gap:.75rem;text-decoration:none;padding:.5rem .25rem;border-radius:8px;transition:background .2s}
  .popular-item:hover{background:rgba(124,77,206,.06)}
  .popular-item::before{counter-increment:popular;content:counter(popular);font-family:var(--ff-mono);font-size:.75rem;color:var(--accent);font-weight:500;min-width:1.2rem;text-align:center}
  .popular-item-name{font-size:.88rem;color:var(--text);font-weight:500}
  .popular-item-desc{font-size:.75rem;color:var(--muted);margin-left:auto}

  /* ── FOOTER ── */
  .art-footer{background:#fff;border-top:1px solid var(--border);padding:2.5rem 1.2rem 1.5rem;margin-top:3rem}
  .art-footer-inner{max-width:860px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:2rem}
  .aft-heading{font-size:.68rem;font-weight:500;letter-spacing:.15em;color:var(--accent);text-transform:uppercase;margin-bottom:.6rem;font-family:var(--ff-mono);padding-bottom:.5rem;border-bottom:1px solid var(--border)}
  .art-footer ul{list-style:none;display:flex;flex-direction:column;gap:.45rem}
  .art-footer ul a{font-size:.8rem;color:var(--muted);text-decoration:none;transition:color .2s}
  .art-footer ul a:hover{color:var(--accent)}
  .aft-copy{font-size:.72rem;color:var(--muted);text-align:center;font-family:var(--ff-mono);letter-spacing:.08em}
  @media(max-width:600px){.art-footer-inner{grid-template-columns:1fr;gap:1.5rem}}

  @media(max-width:600px){
    .article-grid{grid-template-columns:1fr}
    .card-btns{flex-direction:row}
  }
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/" class="art-back">← TOPへ戻る</a>
  </div>
</header>

<div class="wrap">

  <div class="hub-hero">
    <span class="hub-label">ARTICLES · 占い解説ガイド</span>
    <h1>無料占いをもっと楽しむための解説ガイド</h1>
    <p>タロット・四柱推命・MBTIなど<br>人気占術の意味や活用方法を解説します。</p>
  </div>

  <div class="popular-picks">
    <p class="popular-picks-label">人気コンテンツ</p>
    <div class="popular-picks-grid">
      <a href="/tarot" class="pick-card">
        <span class="pick-icon">🔮</span>
        <span class="pick-name">タロット占い</span>
        <span class="pick-desc">22枚の大アルカナ</span>
        <span class="pick-btn">今すぐ占う →</span>
      </a>
      <a href="/shichu" class="pick-card">
        <span class="pick-icon">🌙</span>
        <span class="pick-name">四柱推命</span>
        <span class="pick-desc">命式・大運・年運</span>
        <span class="pick-btn">今すぐ占う →</span>
      </a>
      <a href="/mbti" class="pick-card">
        <span class="pick-icon">🧠</span>
        <span class="pick-name">MBTI×星座診断</span>
        <span class="pick-desc">16タイプ性格分析</span>
        <span class="pick-btn">今すぐ占う →</span>
      </a>
      <a href="/calendar" class="pick-card">
        <span class="pick-icon">📅</span>
        <span class="pick-name">開運カレンダー</span>
        <span class="pick-desc">今日の吉方位・運勢</span>
        <span class="pick-btn">今すぐ見る →</span>
      </a>
    </div>
  </div>

  <?php
  $categories = [
    [
      'label' => '✦ 占術を知る',
      'items' => [
        ['icon'=>'🔮','title'=>'タロット占い','desc'=>'22枚の大アルカナの意味、歴史、正位置・逆位置の読み方を解説。','url_article'=>'/articles/tarot/','url_tool'=>'/tarot','ready'=>true],
        ['icon'=>'🌙','title'=>'四柱推命','desc'=>'生まれた年月日時から命式を算出し、大運・年運の流れを読む本格占術。','url_article'=>'/articles/shichu/','url_tool'=>'/shichu','ready'=>true],
        ['icon'=>'⭐','title'=>'九星気学','desc'=>'九つの星で人の性質と運気の周期を読む、日本古来の占術。','url_article'=>'/articles/kyusei/','url_tool'=>'/kyusei','ready'=>true],
        ['icon'=>'🔢','title'=>'数秘術','desc'=>'誕生日と名前から導き出す「運命数」で、人生のテーマを知る。','url_article'=>'/articles/numerology/','url_tool'=>'/numerology','ready'=>true],
        ['icon'=>'✍️','title'=>'姓名判断','desc'=>'漢字の画数から名前の吉凶・運勢を読み解く日本の伝統占術。','url_article'=>'/articles/seimei/','url_tool'=>'/seimei','ready'=>true],
        ['icon'=>'☯️','title'=>'算命学','desc'=>'生年月日から元命・主星・従星を算出し、才能・性格・仕事適性を読み解く東洋占術。','url_article'=>'/articles/sanmei/','url_tool'=>'/sanmei','ready'=>true],
      ]
    ],
    [
      'label' => '✦ 性格・相性を知る',
      'items' => [
        ['icon'=>'🧠','title'=>'MBTI×星座診断','desc'=>'16タイプの性格タイプと星座を掛け合わせた、詳細な性格分析。','url_article'=>'/articles/mbti/','url_tool'=>'/mbti','ready'=>true],
        ['icon'=>'💞','title'=>'相性診断','desc'=>'誕生日・血液型・星座から二人の相性を多角的に分析。','url_article'=>'/articles/aisho/','url_tool'=>'/aisho','ready'=>true],
        ['icon'=>'🌀','title'=>'前世診断','desc'=>'あなたの前世の姿と、今世に引き継いだ魂の傾向を占う。','url_article'=>'/articles/zense/','url_tool'=>'/zense','ready'=>true],
      ]
    ],
    [
      'label' => '✦ 開運・エンタメ',
      'items' => [
        ['icon'=>'📅','title'=>'開運カレンダー','desc'=>'毎日の吉方位・ラッキーカラー・運気の波を一覧で確認。','url_article'=>'/articles/calendar/','url_tool'=>'/calendar','ready'=>true],
        ['icon'=>'👻','title'=>'守護霊診断','desc'=>'守護霊・守護獣の種類と役割、あなたを守る存在を診断。','url_article'=>'/articles/guardian/','url_tool'=>'/guardian','ready'=>true],
      ]
    ],
  ];

  foreach($categories as $cat): ?>
  <div class="cat-section">
    <div class="cat-label">
      <span class="cat-label-text"><?= $cat['label'] ?></span>
      <span class="cat-label-line"></span>
    </div>
    <div class="article-grid">
      <?php foreach($cat['items'] as $item): ?>
      <div class="article-card">
        <div class="article-card-head">
          <span class="article-card-icon"><?= $item['icon'] ?></span>
          <span class="article-card-title"><?= $item['title'] ?></span>
        </div>
        <p class="article-card-desc"><?= $item['desc'] ?></p>
        <div class="card-btns">
          <?php if($item['ready']): ?>
          <a href="<?= $item['url_article'] ?>" class="btn-read">📖 解説を読む</a>
          <?php else: ?>
          <span class="btn-read btn-coming">📖 解説準備中</span>
          <?php endif; ?>
          <a href="<?= $item['url_tool'] ?>" class="btn-fortune">🔮 占う</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="hub-intro">
    <p>占いには、タロット占い・四柱推命・九星気学・数秘術・姓名判断・MBTI診断など、様々な種類があります。それぞれ異なる視点から「あなた」を映し出し、活用場面も異なります。</p>
    <p>たとえばタロット占いは「今この瞬間の状況」を直感的に読み取るのに向いており、四柱推命は「生まれ持った性質と人生の流れ」を長期的に分析するのに優れています。九星気学は「今年・来年の運気の周期」を把握したいときに重宝され、数秘術は「人生のテーマと才能」を掘り下げます。</p>
    <p>このページでは、各占術の基礎知識・歴史・読み方・活用シーンをカテゴリ別にまとめています。気になる占術の解説を読んでから占うと、結果がより深く理解できるようになります。</p>
  </div>

  <div class="popular-section">
    <p class="popular-title">人気の占い</p>
    <div class="popular-list">
      <a href="/tarot" class="popular-item">
        <span class="popular-item-name">🔮 タロット占い</span>
        <span class="popular-item-desc">22枚の大アルカナ</span>
      </a>
      <a href="/shichu" class="popular-item">
        <span class="popular-item-name">🌙 四柱推命</span>
        <span class="popular-item-desc">命式・大運・年運</span>
      </a>
      <a href="/calendar" class="popular-item">
        <span class="popular-item-name">📅 開運カレンダー</span>
        <span class="popular-item-desc">今日の運勢</span>
      </a>
      <a href="/mbti" class="popular-item">
        <span class="popular-item-name">🧠 MBTI×星座診断</span>
        <span class="popular-item-desc">16タイプ性格分析</span>
      </a>
      <a href="/aisho" class="popular-item">
        <span class="popular-item-name">💞 相性診断</span>
        <span class="popular-item-desc">誕生日・血液型・星座</span>
      </a>
    </div>
  </div>

</div>

<footer class="art-footer">
  <div class="art-footer-inner">
    <div class="aft-col">
      <p class="aft-heading">人気の占い</p>
      <ul>
        <li><a href="/shichu">三星統合鑑定</a></li>
        <li><a href="/tarot">タロット占い</a></li>
        <li><a href="/shichu">四柱推命</a></li>
        <li><a href="/mbti">MBTI×星座診断</a></li>
        <li><a href="/calendar">開運カレンダー</a></li>
      </ul>
    </div>
    <div class="aft-col">
      <p class="aft-heading">解説ガイド</p>
      <ul>
        <li><a href="/articles/">占い解説ガイド</a></li>
        <li><a href="/articles/tarot/">タロット占いとは</a></li>
        <li><a href="/articles/shichu/">四柱推命とは</a></li>
        <li><a href="/articles/kyusei/">九星気学とは</a></li>
        <li><a href="/articles/numerology/">数秘術とは</a></li>
        <li><a href="/articles/mbti/">MBTI診断とは</a></li>
        <li><a href="/articles/seimei/">姓名判断とは</a></li>
        <li><a href="/articles/sanmei/">算命学とは</a></li>
      </ul>
    </div>
    <div class="aft-col">
      <p class="aft-heading">サイト情報</p>
      <ul>
        <li><a href="/profile">運営者情報</a></li>
        <li><a href="/privacy">プライバシーポリシー</a></li>
        <li><a href="/contact">お問い合わせ</a></li>
      </ul>
    </div>
  </div>
  <p class="aft-copy">© <?= date('Y') ?> 占いPortal</p>
</footer>

</body>
</html>
