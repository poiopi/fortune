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

  /* ── COMING SOON ── */
  .article-card.coming{opacity:.55}
  .coming-badge{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.1em;color:var(--muted);border:1px solid var(--border);border-radius:20px;padding:.2rem .6rem;display:inline-block}

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
  .art-footer{background:#fff;border-top:1px solid var(--border);padding:2rem 1.2rem;text-align:center;margin-top:3rem}
  .art-footer p{font-size:.78rem;color:var(--muted)}
  .art-footer a{color:var(--muted);text-decoration:none}
  .art-footer a:hover{color:var(--accent)}
  .footer-links{display:flex;gap:1.5rem;justify-content:center;margin-bottom:.75rem;flex-wrap:wrap}

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
    <h1>占術を知ると、占いが変わる</h1>
    <p>タロット・四柱推命・九星気学など各占術の意味・歴史・活用方法を解説。無料占いをより深く楽しむためのガイドです。</p>
  </div>

  <?php
  $categories = [
    [
      'label' => '✦ 占術を知る',
      'items' => [
        ['icon'=>'🔮','title'=>'タロット占い','desc'=>'22枚の大アルカナの意味、歴史、正位置・逆位置の読み方を解説。','url_article'=>'/articles/tarot/','url_tool'=>'/tarot','ready'=>true],
        ['icon'=>'🌙','title'=>'四柱推命','desc'=>'生まれた年月日時から命式を算出し、大運・年運の流れを読む本格占術。','url_article'=>'/articles/shichu/','url_tool'=>'/shichu','ready'=>false],
        ['icon'=>'⭐','title'=>'九星気学','desc'=>'九つの星で人の性質と運気の周期を読む、日本古来の占術。','url_article'=>'/articles/kyusei/','url_tool'=>'/kyusei','ready'=>false],
        ['icon'=>'🔢','title'=>'数秘術','desc'=>'誕生日と名前から導き出す「運命数」で、人生のテーマを知る。','url_article'=>'/articles/numerology/','url_tool'=>'/numerology','ready'=>false],
        ['icon'=>'✍️','title'=>'姓名判断','desc'=>'漢字の画数から名前の吉凶・運勢を読み解く日本の伝統占術。','url_article'=>'/articles/seimei/','url_tool'=>'/seimei','ready'=>false],
      ]
    ],
    [
      'label' => '✦ 性格・相性を知る',
      'items' => [
        ['icon'=>'🧠','title'=>'MBTI×星座診断','desc'=>'16タイプの性格タイプと星座を掛け合わせた、詳細な性格分析。','url_article'=>'/articles/mbti/','url_tool'=>'/mbti','ready'=>false],
        ['icon'=>'💞','title'=>'相性診断','desc'=>'誕生日・血液型・星座から二人の相性を多角的に分析。','url_article'=>'/articles/aisho/','url_tool'=>'/aisho','ready'=>false],
        ['icon'=>'🌀','title'=>'前世診断','desc'=>'あなたの前世の姿と、今世に引き継いだ魂の傾向を占う。','url_article'=>'/articles/zense/','url_tool'=>'/zense','ready'=>false],
      ]
    ],
    [
      'label' => '✦ 開運・エンタメ',
      'items' => [
        ['icon'=>'📅','title'=>'開運カレンダー','desc'=>'毎日の吉方位・ラッキーカラー・運気の波を一覧で確認。','url_article'=>'/articles/calendar/','url_tool'=>'/calendar','ready'=>false],
        ['icon'=>'⚔️','title'=>'RPG占い','desc'=>'あなたの運命をRPGの勇者クエスト形式で読み解くエンタメ占い。','url_article'=>'/articles/rpg/','url_tool'=>'/rpg','ready'=>false],
        ['icon'=>'🎭','title'=>'芸名診断','desc'=>'大喜利10問で性格タイプを判定し、最強の芸名を命名する診断。','url_article'=>'/articles/geimei/','url_tool'=>'/geimei','ready'=>false],
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
      <div class="article-card<?= $item['ready'] ? '' : ' coming' ?>">
        <div class="article-card-head">
          <span class="article-card-icon"><?= $item['icon'] ?></span>
          <span class="article-card-title"><?= $item['title'] ?></span>
        </div>
        <p class="article-card-desc"><?= $item['desc'] ?></p>
        <?php if($item['ready']): ?>
        <div class="card-btns">
          <a href="<?= $item['url_article'] ?>" class="btn-read">📖 解説を読む</a>
          <a href="<?= $item['url_tool'] ?>" class="btn-fortune">🔮 占う</a>
        </div>
        <?php else: ?>
        <span class="coming-badge">解説ページ準備中</span>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>

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
  <div class="footer-links">
    <a href="/">トップ</a>
    <a href="/tarot">タロット占い</a>
    <a href="/privacy">プライバシーポリシー</a>
    <a href="/contact">お問い合わせ</a>
  </div>
  <p>© 2024 占いPortal</p>
</footer>

</body>
</html>
