<?php
/**
 * 星座個別記事テンプレート
 * 各星座の index.php から $sign データをセットして require する
 */
declare(strict_types=1);
require_once __DIR__ . '/../../inc/auto-link.php';

// 全12星座ナビデータ（他の星座リンク用）
$_ALL_SIGNS = [
  ['slug'=>'aries',       'name'=>'牡羊座', 'symbol'=>'♈', 'period'=>'3/21〜4/19'],
  ['slug'=>'taurus',      'name'=>'牡牛座', 'symbol'=>'♉', 'period'=>'4/20〜5/20'],
  ['slug'=>'gemini',      'name'=>'双子座', 'symbol'=>'♊', 'period'=>'5/21〜6/21'],
  ['slug'=>'cancer',      'name'=>'蟹座',   'symbol'=>'♋', 'period'=>'6/22〜7/22'],
  ['slug'=>'leo',         'name'=>'獅子座', 'symbol'=>'♌', 'period'=>'7/23〜8/22'],
  ['slug'=>'virgo',       'name'=>'乙女座', 'symbol'=>'♍', 'period'=>'8/23〜9/22'],
  ['slug'=>'libra',       'name'=>'天秤座', 'symbol'=>'♎', 'period'=>'9/23〜10/23'],
  ['slug'=>'scorpio',     'name'=>'蠍座',   'symbol'=>'♏', 'period'=>'10/24〜11/22'],
  ['slug'=>'sagittarius', 'name'=>'射手座', 'symbol'=>'♐', 'period'=>'11/23〜12/21'],
  ['slug'=>'capricorn',   'name'=>'山羊座', 'symbol'=>'♑', 'period'=>'12/22〜1/19'],
  ['slug'=>'aquarius',    'name'=>'水瓶座', 'symbol'=>'♒', 'period'=>'1/20〜2/18'],
  ['slug'=>'pisces',      'name'=>'魚座',   'symbol'=>'♓', 'period'=>'2/19〜3/20'],
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/seiza/<?= $sign['slug'] ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($sign['description']) ?>">
  <title><?= htmlspecialchars($sign['name']) ?>とは？性格・恋愛・仕事・相性を西洋占星術で徹底解説</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{--ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;--accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;--text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f8f7fc}
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
  .cta-box{background:linear-gradient(135deg,rgba(124,77,206,.06) 0%,rgba(155,114,239,.04) 100%);border:1px solid rgba(124,77,206,.2);border-radius:12px;padding:1.25rem 1.5rem;margin:1.5rem 0;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
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
  .info-table{width:100%;border-collapse:collapse;margin-top:1rem;font-size:.88rem}
  .info-table th{background:rgba(124,77,206,.08);color:var(--accent);font-weight:600;padding:.65rem .85rem;border:1px solid var(--border);text-align:left;font-family:var(--ff-serif);width:30%}
  .info-table td{padding:.65rem .85rem;border:1px solid var(--border);color:#333;line-height:1.7}
  .trait-list{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.75rem}
  .trait-tag{background:rgba(124,77,206,.08);border:1px solid rgba(124,77,206,.22);color:var(--accent);font-size:.78rem;padding:.3rem .75rem;border-radius:20px;font-family:var(--ff-mono)}
  .trait-tag.weak{background:rgba(255,152,0,.08);border-color:rgba(255,152,0,.25);color:#e65100}
  .compat-box{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.2rem;margin-top:1rem}
  .compat-box-head{font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:var(--text);margin-bottom:.35rem}
  .compat-box-signs{font-family:var(--ff-mono);font-size:.72rem;color:var(--accent);margin-bottom:.4rem}
  .compat-box.caution .compat-box-signs{color:#f57c00}
  .compat-box p{font-size:.83rem;color:#444;line-height:1.75;margin-bottom:0}
  .highlight-box{background:rgba(124,77,206,.05);border:1px solid rgba(124,77,206,.18);border-radius:10px;padding:1.1rem 1.3rem;margin:1rem 0}
  .highlight-box p{font-size:.88rem;color:#333;line-height:1.9;margin-bottom:0}
  .highlight-box strong{color:var(--accent)}
  .faq-list{display:flex;flex-direction:column;gap:.75rem;margin-top:1rem}
  .faq-item{border:1px solid var(--border);border-radius:10px;overflow:hidden}
  .faq-q{font-size:.9rem;font-weight:500;padding:.9rem 1.1rem;background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.5rem}
  .faq-q::after{content:'＋';font-family:var(--ff-mono);color:var(--accent);flex-shrink:0;transition:transform .2s}
  .faq-item.open .faq-q::after{transform:rotate(45deg)}
  .faq-a{font-size:.88rem;color:#444;line-height:1.85;padding:0 1.1rem;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
  .faq-item.open .faq-a{max-height:300px;padding:.9rem 1.1rem}
  .signs-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.6rem;margin-top:1rem}
  .sign-nav-card{display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.7rem .5rem;background:var(--bg2);border:1px solid var(--border);border-radius:10px;text-decoration:none;transition:border-color .2s,background .2s;text-align:center}
  .sign-nav-card:hover{border-color:var(--accent-lt);background:#fff}
  .sign-nav-card.current{border-color:var(--accent);background:rgba(124,77,206,.06);pointer-events:none}
  .sign-nav-symbol{font-size:1.3rem;line-height:1}
  .sign-nav-name{font-family:var(--ff-serif);font-size:.75rem;font-weight:600;color:var(--text)}
  .sign-nav-period{font-family:var(--ff-mono);font-size:.55rem;color:var(--muted)}
  .hub-link-box{background:#fff;border:1px solid rgba(124,77,206,.25);border-radius:12px;padding:1.1rem 1.4rem;margin:2rem 0 0;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
  .hub-link-box p{font-size:.88rem;color:var(--muted)}
  .hub-link-box strong{display:block;font-size:.93rem;color:var(--text);margin-bottom:.2rem;font-family:var(--ff-serif)}
  .hub-link-btn{font-family:var(--ff-mono);font-size:.72rem;color:var(--accent);text-decoration:none;border:1px solid rgba(124,77,206,.3);padding:.35rem .9rem;border-radius:20px;white-space:nowrap;transition:border-color .2s,background .2s}
  .hub-link-btn:hover{border-color:var(--accent);background:rgba(124,77,206,.06)}
  .al-link{color:var(--accent);text-decoration:underline;text-decoration-style:dotted;text-underline-offset:3px;transition:color .2s}
  .al-link:hover{color:var(--accent-lt)}
  @media(max-width:600px){
    .cta-box{flex-direction:column;align-items:flex-start}
    .signs-grid{grid-template-columns:repeat(3,1fr)}
    .hub-link-box{flex-direction:column;align-items:flex-start}
  }
  </style>

  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"FAQPage","mainEntity":[<?php
    $faqs = [];
    foreach ($sign['faq'] as $f) {
      $faqs[] = '{"@type":"Question","name":'.json_encode($f['q']).',"acceptedAnswer":{"@type":"Answer","text":'.json_encode($f['a']).'}}';
    }
    echo implode(',', $faqs);
  ?>]}
  </script>
  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
    {"@type":"ListItem","position":1,"name":"占いPortal","item":"https://life-fun.net/"},
    {"@type":"ListItem","position":2,"name":"占い解説ガイド","item":"https://life-fun.net/articles/"},
    {"@type":"ListItem","position":3,"name":"西洋占星術とは","item":"https://life-fun.net/articles/seiza/"},
    {"@type":"ListItem","position":4,"name":"<?= htmlspecialchars($sign['name']) ?>とは","item":"https://life-fun.net/articles/seiza/<?= $sign['slug'] ?>/"}
  ]}
  </script>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/seiza" class="art-back">⭐ 西洋占星術で鑑定する →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span><a href="/articles/">占い解説ガイド</a><span>›</span><a href="/articles/seiza/">西洋占星術とは</a><span>›</span><?= htmlspecialchars($sign['name']) ?>とは
  </nav>

  <div class="art-hero">
    <span class="art-label"><?= strtoupper($sign['name_en']) ?> · <?= $sign['period'] ?> · <?= $sign['element'] ?>のエレメント</span>
    <h1><?= htmlspecialchars($sign['name']) ?>とは？<br>性格・恋愛・仕事・相性を西洋占星術で徹底解説</h1>
    <p class="art-lead"><?= htmlspecialchars($sign['lead']) ?></p>
  </div>

  <div class="cta-box">
    <div>
      <p>⭐ あなたの星座タイプを無料で調べる</p>
      <small>生年月日と生まれた時間帯から、太陽星座・エレメント・内面タイプを鑑定できます。</small>
    </div>
    <a href="/seiza" class="cta-btn">西洋占星術で鑑定する →</a>
  </div>

  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#whatis"><?= htmlspecialchars($sign['name']) ?>とは</a></li>
      <li><a href="#basic">基本情報</a></li>
      <li><a href="#personality">性格と特徴</a></li>
      <li><a href="#love">恋愛傾向</a></li>
      <li><a href="#work">仕事適性</a></li>
      <li><a href="#compat-good">相性の良い星座</a></li>
      <li><a href="#compat-caution">相性に注意が必要な星座</a></li>
      <li><a href="#faq">よくある質問</a></li>
    </ol>
  </nav>

  <article>

    <section class="art-section" id="whatis">
      <h2><?= htmlspecialchars($sign['name']) ?>とは</h2>
      <?php foreach ($sign['intro'] as $p): ?>
      <p><?= htmlspecialchars($p) ?></p>
      <?php endforeach; ?>
      <div class="highlight-box">
        <p><?= htmlspecialchars($sign['intro_highlight']) ?></p>
      </div>
    </section>

    <section class="art-section" id="basic">
      <h2><?= htmlspecialchars($sign['name']) ?>の基本情報</h2>
      <table class="info-table">
        <tr><th>誕生日</th><td><?= htmlspecialchars($sign['period_full']) ?></td></tr>
        <tr><th>エレメント</th><td><?= htmlspecialchars($sign['element_full']) ?></td></tr>
        <tr><th>クオリティ</th><td><?= htmlspecialchars($sign['quality_full']) ?></td></tr>
        <tr><th>守護星</th><td><?= htmlspecialchars($sign['planet']) ?></td></tr>
        <tr><th>象徴</th><td><?= htmlspecialchars($sign['symbol_name']) ?></td></tr>
        <tr><th>誕生石</th><td><?= htmlspecialchars($sign['stone']) ?></td></tr>
        <tr><th>ラッキーカラー</th><td><?= htmlspecialchars($sign['color']) ?></td></tr>
        <tr><th>対極星座</th><td><?= htmlspecialchars($sign['opposite']) ?></td></tr>
      </table>
      <?php foreach ($sign['basic_sections'] as $bs): ?>
      <h3><?= htmlspecialchars($bs['title']) ?></h3>
      <p><?= htmlspecialchars($bs['text']) ?></p>
      <?php endforeach; ?>
    </section>

    <section class="art-section" id="personality">
      <h2><?= htmlspecialchars($sign['name']) ?>の性格と特徴</h2>
      <p><?= htmlspecialchars($sign['personality_lead']) ?></p>
      <h3><?= htmlspecialchars($sign['name']) ?>の強み</h3>
      <div class="trait-list">
        <?php foreach ($sign['strengths'] as $t): ?>
        <span class="trait-tag"><?= htmlspecialchars($t) ?></span>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:1rem"><?= htmlspecialchars($sign['strengths_text']) ?></p>
      <h3><?= htmlspecialchars($sign['name']) ?>の課題</h3>
      <div class="trait-list">
        <?php foreach ($sign['weaknesses'] as $t): ?>
        <span class="trait-tag weak"><?= htmlspecialchars($t) ?></span>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:1rem"><?= htmlspecialchars($sign['weaknesses_text']) ?></p>
    </section>

    <section class="art-section" id="love">
      <h2><?= htmlspecialchars($sign['name']) ?>の恋愛傾向</h2>
      <p><?= htmlspecialchars($sign['love_lead']) ?></p>
      <h3>恋愛での強み</h3>
      <p><?= htmlspecialchars($sign['love_strengths']) ?></p>
      <h3>恋愛での課題</h3>
      <p><?= htmlspecialchars($sign['love_weaknesses']) ?></p>
      <div class="highlight-box">
        <p><?= htmlspecialchars($sign['love_highlight']) ?></p>
      </div>
    </section>

    <section class="art-section" id="work">
      <h2><?= htmlspecialchars($sign['name']) ?>の仕事適性</h2>
      <p><?= htmlspecialchars($sign['work_lead']) ?></p>
      <h3>向いている仕事・環境</h3>
      <p><?= htmlspecialchars($sign['work_suitable']) ?></p>
      <h3>仕事での注意点</h3>
      <p><?= htmlspecialchars($sign['work_caution']) ?></p>
    </section>

    <!-- 中盤CTA -->
    <div class="cta-box" style="margin:0">
      <div>
        <p>⭐ <?= htmlspecialchars($sign['name']) ?>の詳細鑑定を試してみる</p>
        <small>太陽星座×内面タイプで、あなただけの個性を読み解きます。</small>
      </div>
      <a href="/seiza" class="cta-btn">西洋占星術で鑑定する →</a>
    </div>

    <section class="art-section" id="compat-good">
      <h2><?= htmlspecialchars($sign['name']) ?>と相性の良い星座</h2>
      <div class="compat-box">
        <div class="compat-box-head">✦ 特に相性が良い星座</div>
        <div class="compat-box-signs"><?= htmlspecialchars($sign['compat_good_signs']) ?></div>
        <p><?= htmlspecialchars($sign['compat_good_text']) ?></p>
      </div>
      <p style="margin-top:1rem;font-size:.82rem;color:var(--muted)">※ 相性は太陽星座だけで決まるものではありません。月星座・上昇星座・内面タイプなど複数の要素が影響します。</p>
    </section>

    <section class="art-section" id="compat-caution">
      <h2><?= htmlspecialchars($sign['name']) ?>と相性に注意が必要な星座</h2>
      <div class="compat-box caution">
        <div class="compat-box-head">△ 摩擦が生まれやすい星座</div>
        <div class="compat-box-signs"><?= htmlspecialchars($sign['compat_caution_signs']) ?></div>
        <p><?= htmlspecialchars($sign['compat_caution_text']) ?></p>
      </div>
      <p style="margin-top:1rem;font-size:.82rem;color:var(--muted)">※ 相性が難しい組み合わせでも、互いの違いを理解することで深い関係を築けるケースは多くあります。</p>
    </section>

    <section class="art-section" id="faq">
      <h2>よくある質問</h2>
      <div class="faq-list">
        <?php foreach ($sign['faq'] as $f): ?>
        <div class="faq-item">
          <div class="faq-q" onclick="this.parentElement.classList.toggle('open')"><?= htmlspecialchars($f['q']) ?></div>
          <div class="faq-a"><?= htmlspecialchars($f['a']) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- 記事末尾CTA -->
    <div class="cta-box" style="margin:0 0 2rem">
      <div>
        <p>⭐ あなたの星座を無料で鑑定する</p>
        <small>生年月日と時間帯を入力するだけ。<?= htmlspecialchars($sign['name']) ?>の詳細な鑑定結果が分かります。</small>
      </div>
      <a href="/seiza" class="cta-btn">今すぐ無料診断 →</a>
    </div>

    <!-- 他の星座を見る -->
    <section class="art-section" id="other-signs">
      <h2>他の星座も見る</h2>
      <div class="signs-grid">
        <?php foreach ($_ALL_SIGNS as $s): ?>
        <?php if ($s['slug'] === $sign['slug']): ?>
        <span class="sign-nav-card current">
          <span class="sign-nav-symbol"><?= $s['symbol'] ?></span>
          <span class="sign-nav-name"><?= $s['name'] ?></span>
          <span class="sign-nav-period"><?= $s['period'] ?></span>
        </span>
        <?php else: ?>
        <a href="/articles/seiza/<?= $s['slug'] ?>/" class="sign-nav-card">
          <span class="sign-nav-symbol"><?= $s['symbol'] ?></span>
          <span class="sign-nav-name"><?= $s['name'] ?></span>
          <span class="sign-nav-period"><?= $s['period'] ?></span>
        </a>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </section>

    <div class="hub-link-box">
      <div>
        <strong>📋 西洋占星術 完全ガイドを見る</strong>
        <p>12星座・エレメント・クオリティの意味をまとめて解説しています。</p>
      </div>
      <a href="/articles/seiza/" class="hub-link-btn">西洋占星術ガイドへ →</a>
    </div>

  </article>
</div>

<?php $currentSlug = $sign['slug']; $pageType = 'article'; require __DIR__ . '/../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, $sign['slug']);
?>
