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
  <link rel="canonical" href="https://life-fun.net/articles/tarot/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="タロット占いとは何か、22枚の大アルカナの意味・歴史・正位置逆位置の読み方をわかりやすく解説。タロットの基礎知識からカード一覧まで完全ガイド。">
  <title>タロット占いとは？大アルカナ22枚の意味と読み方｜完全解説</title>
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
    --bg2:#f8f7fc;
  }
  html{font-size:16px;scroll-behavior:smooth}
  body{background:var(--bg);color:var(--text);font-family:var(--ff-sans);font-weight:400;line-height:1.85}

  /* ── HEADER ── */
  .art-header{
    background:#fff;border-bottom:1px solid var(--border);
    position:sticky;top:0;z-index:100;
  }
  .art-header-inner{
    max-width:780px;margin:0 auto;padding:0 1.2rem;
    display:flex;align-items:center;justify-content:space-between;height:52px;
  }
  .art-logo{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--text);text-decoration:none}
  .art-logo em{font-style:italic;color:var(--gold)}
  .art-back{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.25rem .75rem;border-radius:20px;transition:border-color .2s,color .2s}
  .art-back:hover{border-color:var(--accent-lt);color:var(--accent)}

  /* ── WRAP ── */
  .wrap{max-width:780px;margin:0 auto;padding:0 1.2rem}

  /* ── BREADCRUMB ── */
  .breadcrumb{font-size:.72rem;color:var(--muted);padding:1rem 0 0;font-family:var(--ff-mono);letter-spacing:.04em}
  .breadcrumb a{color:var(--muted);text-decoration:none}
  .breadcrumb a:hover{color:var(--accent)}
  .breadcrumb span{margin:0 .4rem}

  /* ── HERO ── */
  .art-hero{padding:2rem 0 1.5rem;border-bottom:1px solid var(--border)}
  .art-label{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--accent);text-transform:uppercase;margin-bottom:.75rem;display:block}
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}

  /* ── CTA BOX ── */
  .cta-box{
    background:linear-gradient(135deg,#f5f0ff 0%,#fdf4fa 100%);
    border:1px solid #d4bfff;border-radius:12px;
    padding:1.25rem 1.5rem;margin:1.5rem 0;
    display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;
  }
  .cta-box p{font-size:.9rem;color:var(--text);font-weight:500}
  .cta-box small{display:block;font-size:.78rem;color:var(--muted);margin-top:.2rem;font-weight:400}
  .cta-btn{
    display:inline-block;background:var(--accent);color:#fff;
    font-family:var(--ff-sans);font-size:.85rem;font-weight:500;
    padding:.65rem 1.5rem;border-radius:24px;text-decoration:none;
    white-space:nowrap;transition:background .2s,transform .15s;
  }
  .cta-btn:hover{background:var(--accent-lt);transform:translateY(-1px)}

  /* ── TOC ── */
  .toc{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:2rem 0}
  .toc-title{font-size:.8rem;font-weight:500;color:var(--muted);letter-spacing:.1em;margin-bottom:.75rem;font-family:var(--ff-mono)}
  .toc ol{padding-left:1.2rem;display:flex;flex-direction:column;gap:.35rem}
  .toc li{font-size:.88rem}
  .toc a{color:var(--accent);text-decoration:none}
  .toc a:hover{text-decoration:underline}

  /* ── SECTIONS ── */
  .art-section{padding:2.5rem 0;border-bottom:1px solid var(--border)}
  .art-section:last-child{border-bottom:none}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section h3{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--text);margin:1.5rem 0 .6rem}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}
  .art-section p:last-child{margin-bottom:0}

  /* ── CARD GRID ── */
  .card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:.75rem;margin-top:1rem}
  .arc-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s}
  .arc-card:hover{border-color:var(--accent-lt)}
  .arc-num{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.3rem}
  .arc-name{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.35rem}
  .arc-kw{font-size:.75rem;color:var(--muted);line-height:1.6}

  /* ── FAQ ── */
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}

  /* ── RELATED ── */
  .related-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.75rem;margin-top:1rem}
  .related-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;text-decoration:none;display:block;transition:border-color .2s,transform .15s}
  .related-card:hover{border-color:var(--accent-lt);transform:translateY(-2px)}
  .related-card-label{font-size:.7rem;color:var(--muted);margin-bottom:.3rem;font-family:var(--ff-mono)}
  .related-card-title{font-size:.9rem;font-weight:500;color:var(--accent)}

  /* ── FOOTER ── */
  .art-footer{background:var(--bg2);border-top:1px solid var(--border);padding:2.5rem 1.2rem 1.5rem;margin-top:3rem}
  .art-footer-inner{max-width:780px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:2rem}
  .aft-heading{font-size:.68rem;font-weight:500;letter-spacing:.15em;color:var(--accent);text-transform:uppercase;margin-bottom:.6rem;font-family:var(--ff-mono);padding-bottom:.5rem;border-bottom:1px solid var(--border)}
  .art-footer ul{list-style:none;display:flex;flex-direction:column;gap:.45rem}
  .art-footer ul a{font-size:.8rem;color:var(--muted);text-decoration:none;transition:color .2s}
  .art-footer ul a:hover{color:var(--accent)}
  .aft-copy{font-size:.72rem;color:var(--muted);text-align:center;font-family:var(--ff-mono);letter-spacing:.08em}
  @media(max-width:600px){.art-footer-inner{grid-template-columns:1fr;gap:1.5rem}}

  @media(max-width:600px){
    .cta-box{flex-direction:column;align-items:flex-start}
    .card-grid{grid-template-columns:repeat(auto-fill,minmax(130px,1fr))}
  }
  </style>

  <!-- FAQ構造化データ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "タロット占いは当たりますか？",
        "acceptedAnswer": {"@type": "Answer","text": "タロットは未来を断言するツールではなく、現在の状況や潜在意識を映し出すものです。当たる・外れるというより、今の自分の状態や心理を整理するヒントとして活用するのがおすすめです。"}
      },
      {
        "@type": "Question",
        "name": "大アルカナとは何ですか？",
        "acceptedAnswer": {"@type": "Answer","text": "タロット78枚のうち、0〜21番の22枚を「大アルカナ」と呼びます。愚者・魔術師・女帝・皇帝など、人生の大きなテーマや転換点を象徴するカードです。"}
      },
      {
        "@type": "Question",
        "name": "無料タロット占いでも意味はありますか？",
        "acceptedAnswer": {"@type": "Answer","text": "はい。タロットの本質はカードを選ぶ瞬間の直感にあります。有料・無料に関係なく、カードと向き合う気持ちがあれば十分なメッセージを受け取ることができます。"}
      },
      {
        "@type": "Question",
        "name": "毎日タロットを引いても大丈夫ですか？",
        "acceptedAnswer": {"@type": "Answer","text": "問題ありません。ただし同じ質問を繰り返すのは避け、1日1枚を「今日のカード」として引くスタイルがおすすめです。"}
      }
    ]
  }
  </script>

  <!-- パンくずリスト構造化データ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
      {"@type":"ListItem","position":2,"name":"タロット占い","item":"https://life-fun.net/articles/tarot/"}
    ]
  }
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/tarot" class="art-back">🔮 タロットを占う →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span>タロット占い 解説
  </nav>

  <div class="art-hero">
    <span class="art-label">TAROT · 完全ガイド</span>
    <h1>タロット占いとは？<br>大アルカナ22枚の意味と読み方を徹底解説</h1>
    <p class="art-lead">15世紀に生まれたタロットは、78枚のカードで潜在意識と運命の流れを読み解く占術。直感でカードを選ぶことで、今のあなたへのメッセージが浮かび上がります。この記事ではタロットの基礎知識から22枚のカード意味一覧まで、まとめて解説します。</p>
  </div>

  <div class="cta-box">
    <div>
      <p>🔮 実際にカードを引いてみる</p>
      <small>22枚の大アルカナが並ぶ本格タロット。直感で1枚選ぶだけ。</small>
    </div>
    <a href="/tarot" class="cta-btn">タロット占いを始める →</a>
  </div>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#about">タロット占いとは</a></li>
      <li><a href="#history">タロットの歴史</a></li>
      <li><a href="#arcana">大アルカナ・小アルカナとは</a></li>
      <li><a href="#reading">正位置・逆位置の読み方</a></li>
      <li><a href="#cards">大アルカナ22枚 意味一覧</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#related">関連コンテンツ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="about">
    <h2>タロット占いとは</h2>
    <p>タロット占いは、78枚の絵札を使って現在の状況・心理・運勢の流れを読み取る占術です。質問を心に持ちながらカードを引くことで、潜在意識が「今もっとも必要なメッセージ」を引き寄せると考えられています。</p>
    <p>占星術や数秘術と異なり、生年月日や名前といった個人データを必要としないのが特徴。「今この瞬間の直感」を大切にする、即興性の高い占術です。</p>
    <p>心理学者カール・ユングの「集合的無意識」との親和性も指摘されており、自己分析ツールとして活用する人も増えています。「答えはカードが出す」のではなく「カードが自分の内側の声を映す」と捉えると、より深く楽しめます。</p>
  </section>

  <section class="art-section" id="history">
    <h2>タロットの歴史</h2>
    <p>タロットの起源は15世紀のイタリアに遡ります。当初は貴族向けのカードゲーム「タロッキ」として誕生しました。エジプト起源説やユダヤ神秘主義（カバラ）との関連を主張する説もありますが、歴史的証拠としてはイタリア起源が最有力です。</p>
    <p>18世紀のフランスで、神秘主義者たちがタロットを占いツールとして体系化。アントワーヌ・クール・ド・ジェブランが「タロットは古代エジプトの智慧を伝える書」と著作で紹介したことが、占いとしての普及を加速させました。</p>
    <p>現在もっとも広く使われる「ライダー・ウェイト版」は1909年にアーサー・ウェイトとパメラ・コールマン・スミスが制作。各カードに描かれた豊かな絵柄が初心者にも直感的で読みやすく、現代タロットの標準となっています。</p>
  </section>

  <section class="art-section" id="arcana">
    <h2>大アルカナ・小アルカナとは</h2>
    <h3>大アルカナ（22枚）</h3>
    <p>0「愚者」から21「世界」までの22枚。人生の大きなテーマや転換点、魂の成長プロセスを表します。占いでは特に重要なカードとして扱われ、大アルカナだけを使ったスプレッドも多く存在します。</p>
    <h3>小アルカナ（56枚）</h3>
    <p>ワンド・カップ・ソード・ペンタクルの4スートに分かれた56枚。日常的な出来事や具体的な状況を表します。トランプの祖先にあたり、4スートはハート・ダイヤ・クラブ・スペードに対応しています。</p>
    <p>当サイトのタロット占いは大アルカナ22枚を使用しています。</p>
  </section>

  <section class="art-section" id="reading">
    <h2>正位置・逆位置の読み方</h2>
    <h3>正位置</h3>
    <p>カードが正立した状態。そのカードが持つ意味がストレートに現れているとき。たとえば「太陽」の正位置は成功・喜び・明るい未来を示します。</p>
    <h3>逆位置</h3>
    <p>カードが逆さまになった状態。正位置の意味が内向きになる・遅延する・過剰になるといった変化が生じます。「太陽」の逆位置なら、喜びが内にこもる・一時的な停滞といった意味になります。逆位置を採用しないリーダーも多く、初心者は正位置のみから始めるのがおすすめです。</p>
  </section>

  <section class="art-section" id="cards">
    <h2>大アルカナ22枚 意味一覧</h2>
    <p>以下は大アルカナ全22枚のキーワード一覧です。</p>
    <div class="card-grid">
      <?php
      $cards = [
        ['0','愚者','自由・新出発・純粋'],
        ['I','魔術師','意志・技術・実行力'],
        ['II','女教皇','直感・神秘・内なる知恵'],
        ['III','女帝','豊かさ・母性・創造'],
        ['IV','皇帝','権力・安定・リーダーシップ'],
        ['V','教皇','伝統・精神・導き'],
        ['VI','恋人','選択・愛・調和'],
        ['VII','戦車','勝利・前進・意志力'],
        ['VIII','力','勇気・忍耐・内なる強さ'],
        ['IX','隠者','内省・孤独・探求'],
        ['X','運命の輪','転機・サイクル・チャンス'],
        ['XI','正義','公正・真実・バランス'],
        ['XII','吊られた男','試練・待機・視点転換'],
        ['XIII','死神','終わり・変容・再生'],
        ['XIV','節制','調整・癒し・中庸'],
        ['XV','悪魔','束縛・執着・誘惑'],
        ['XVI','塔','崩壊・解放・突然の変化'],
        ['XVII','星','希望・回復・インスピレーション'],
        ['XVIII','月','不安・幻想・直感'],
        ['XIX','太陽','成功・喜び・活力'],
        ['XX','審判','覚醒・再評価・転生'],
        ['XXI','世界','完成・達成・統合'],
      ];
      foreach($cards as $c): ?>
      <div class="arc-card">
        <div class="arc-num"><?= $c[0] ?></div>
        <div class="arc-name"><?= $c[1] ?></div>
        <div class="arc-kw"><?= $c[2] ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">タロット占いは当たりますか？</div>
        <div class="faq-a">タロットは未来を断言するツールではなく、現在の状況や潜在意識を映し出すものです。当たる・外れるというより、今の自分の状態や心理を整理するヒントとして活用するのがおすすめです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">大アルカナとは何ですか？</div>
        <div class="faq-a">タロット78枚のうち、0〜21番の22枚を「大アルカナ」と呼びます。愚者・魔術師・女帝・皇帝など、人生の大きなテーマや転換点を象徴するカードです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">無料タロット占いでも意味はありますか？</div>
        <div class="faq-a">はい。タロットの本質はカードを選ぶ瞬間の直感にあります。有料・無料に関係なく、カードと向き合う気持ちがあれば十分なメッセージを受け取ることができます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">毎日タロットを引いても大丈夫ですか？</div>
        <div class="faq-a">問題ありません。ただし同じ質問を繰り返すのは避け、1日1枚を「今日のカード」として引くスタイルがおすすめです。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="related">
    <h2>関連コンテンツ</h2>
    <p>タロットで引いたカードのテーマをさらに深掘りしたいときは、以下の占いもおすすめです。</p>
    <div class="related-grid">
      <a href="/shichu" class="related-card">
        <div class="related-card-label">四柱推命</div>
        <div class="related-card-title">生まれ持った命式と大運を調べる →</div>
      </a>
      <a href="/numerology" class="related-card">
        <div class="related-card-label">数秘術</div>
        <div class="related-card-title">誕生日から運命数を読み解く →</div>
      </a>
      <a href="/kyusei" class="related-card">
        <div class="related-card-label">九星気学</div>
        <div class="related-card-title">今年・来年の運気の流れを知る →</div>
      </a>
      <a href="/aisho" class="related-card">
        <div class="related-card-label">相性診断</div>
        <div class="related-card-title">気になる相手との相性を占う →</div>
      </a>
    </div>
  </section>

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

<script>
function toggleFaq(el){
  const item = el.parentElement;
  item.classList.toggle('open');
}
</script>

</body>
</html>
