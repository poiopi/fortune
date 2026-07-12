<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

$_PUBLISHED = [
  ['slug'=>'entp-a', 'mbti'=>'ENTP', 'blood'=>'A型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸誠実性（75%）'],
  ['slug'=>'entp-b', 'mbti'=>'ENTP', 'blood'=>'B型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（46.5%）'],
  ['slug'=>'entp-o', 'mbti'=>'ENTP', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（86.1%）'],
  ['slug'=>'entp-ab', 'mbti'=>'ENTP', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（57.6%）'],
  ['slug'=>'intp-a', 'mbti'=>'INTP', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'intp-b', 'mbti'=>'INTP', 'blood'=>'B型', 'class'=>'転換型', 'kw'=>'主軸変化志向（39.6%）'],
  ['slug'=>'intp-o', 'mbti'=>'INTP', 'blood'=>'O型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸情動性（58.3%）'],
  ['slug'=>'intp-ab', 'mbti'=>'INTP', 'blood'=>'AB型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸情動性（67.4%）'],
  ['slug'=>'entj-a', 'mbti'=>'ENTJ', 'blood'=>'A型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸誠実性（97.9%）'],
  ['slug'=>'entj-b', 'mbti'=>'ENTJ', 'blood'=>'B型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（63.9%）'],
  ['slug'=>'entj-o', 'mbti'=>'ENTJ', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（84%）'],
  ['slug'=>'entj-ab', 'mbti'=>'ENTJ', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（53.5%）'],
  ['slug'=>'intj-a', 'mbti'=>'INTJ', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'intj-b', 'mbti'=>'INTJ', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（75%）'],
  ['slug'=>'intj-o', 'mbti'=>'INTJ', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（48.6%）'],
  ['slug'=>'intj-ab', 'mbti'=>'INTJ', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（52.1%）'],
  ['slug'=>'enfp-a', 'mbti'=>'ENFP', 'blood'=>'A型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸誠実性（68.1%）'],
  ['slug'=>'enfp-b', 'mbti'=>'ENFP', 'blood'=>'B型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸情動性（67.4%）'],
  ['slug'=>'enfp-o', 'mbti'=>'ENFP', 'blood'=>'O型', 'class'=>'協調型', 'kw'=>'主軸情動性（95.8%）'],
  ['slug'=>'enfp-ab', 'mbti'=>'ENFP', 'blood'=>'AB型', 'class'=>'協調型', 'kw'=>'主軸情動性（98.6%）'],
  ['slug'=>'infp-a', 'mbti'=>'INFP', 'blood'=>'A型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸誠実性（94.4%）'],
  ['slug'=>'infp-b', 'mbti'=>'INFP', 'blood'=>'B型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸情動性（62.5%）'],
  ['slug'=>'infp-o', 'mbti'=>'INFP', 'blood'=>'O型', 'class'=>'協調型', 'kw'=>'主軸情動性（93.1%）'],
  ['slug'=>'infp-ab', 'mbti'=>'INFP', 'blood'=>'AB型', 'class'=>'協調型', 'kw'=>'主軸情動性（93.1%）'],
  ['slug'=>'enfj-a', 'mbti'=>'ENFJ', 'blood'=>'A型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸誠実性（94.4%）'],
  ['slug'=>'enfj-b', 'mbti'=>'ENFJ', 'blood'=>'B型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸情動性（70.8%）'],
  ['slug'=>'enfj-o', 'mbti'=>'ENFJ', 'blood'=>'O型', 'class'=>'協調型', 'kw'=>'主軸情動性（88.9%）'],
  ['slug'=>'enfj-ab', 'mbti'=>'ENFJ', 'blood'=>'AB型', 'class'=>'協調型', 'kw'=>'主軸情動性（91.7%）'],
  ['slug'=>'infj-a', 'mbti'=>'INFJ', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'infj-b', 'mbti'=>'INFJ', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（54.2%）'],
  ['slug'=>'infj-o', 'mbti'=>'INFJ', 'blood'=>'O型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸情動性（75%）'],
  ['slug'=>'infj-ab', 'mbti'=>'INFJ', 'blood'=>'AB型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸情動性（75%）'],
  ['slug'=>'estp-a', 'mbti'=>'ESTP', 'blood'=>'A型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸誠実性（97.9%）'],
  ['slug'=>'estp-b', 'mbti'=>'ESTP', 'blood'=>'B型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（43.8%）'],
  ['slug'=>'estp-o', 'mbti'=>'ESTP', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（97.9%）'],
  ['slug'=>'estp-ab', 'mbti'=>'ESTP', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸行動主導性（88.9%）'],
  ['slug'=>'istp-a', 'mbti'=>'ISTP', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'istp-b', 'mbti'=>'ISTP', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（70.1%）'],
  ['slug'=>'istp-o', 'mbti'=>'ISTP', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（58.3%）'],
  ['slug'=>'istp-ab', 'mbti'=>'ISTP', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（68.1%）'],
  ['slug'=>'estj-a', 'mbti'=>'ESTJ', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'estj-b', 'mbti'=>'ESTJ', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（61.1%）'],
  ['slug'=>'estj-o', 'mbti'=>'ESTJ', 'blood'=>'O型', 'class'=>'転換型', 'kw'=>'主軸行動主導性（81.3%）'],
  ['slug'=>'estj-ab', 'mbti'=>'ESTJ', 'blood'=>'AB型', 'class'=>'転換型', 'kw'=>'主軸行動主導性（61.8%）'],
  ['slug'=>'istj-a', 'mbti'=>'ISTJ', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'istj-b', 'mbti'=>'ISTJ', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'istj-o', 'mbti'=>'ISTJ', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（95.8%）'],
  ['slug'=>'istj-ab', 'mbti'=>'ISTJ', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（97.9%）'],
  ['slug'=>'esfp-a', 'mbti'=>'ESFP', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'esfp-b', 'mbti'=>'ESFP', 'blood'=>'B型', 'class'=>'転換型', 'kw'=>'主軸変化志向（43.1%）'],
  ['slug'=>'esfp-o', 'mbti'=>'ESFP', 'blood'=>'O型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸情動性（58.3%）'],
  ['slug'=>'esfp-ab', 'mbti'=>'ESFP', 'blood'=>'AB型', 'class'=>'拮抗型（血液型優勢）', 'kw'=>'主軸情動性（67.4%）'],
  ['slug'=>'isfp-a', 'mbti'=>'ISFP', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'isfp-b', 'mbti'=>'ISFP', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（63.2%）'],
  ['slug'=>'isfp-o', 'mbti'=>'ISFP', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（54.2%）'],
  ['slug'=>'isfp-ab', 'mbti'=>'ISFP', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（54.9%）'],
  ['slug'=>'esfj-a', 'mbti'=>'ESFJ', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'esfj-b', 'mbti'=>'ESFJ', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（79.2%）'],
  ['slug'=>'esfj-o', 'mbti'=>'ESFJ', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（48.6%）'],
  ['slug'=>'esfj-ab', 'mbti'=>'ESFJ', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（52.1%）'],
  ['slug'=>'isfj-a', 'mbti'=>'ISFJ', 'blood'=>'A型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'isfj-b', 'mbti'=>'ISFJ', 'blood'=>'B型', 'class'=>'協調型', 'kw'=>'主軸誠実性（100%）'],
  ['slug'=>'isfj-o', 'mbti'=>'ISFJ', 'blood'=>'O型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（86.1%）'],
  ['slug'=>'isfj-ab', 'mbti'=>'ISFJ', 'blood'=>'AB型', 'class'=>'拮抗型（MBTI優勢）', 'kw'=>'主軸誠実性（86.1%）'],
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/mbti-blood/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MBTI×血液型64パターンの組み合わせが恋愛にどう影響するかを、Love Engineの実測データで解説。協調型・拮抗型・転換型という4分類で、どちらの入力が結果を支配しているかがわかります。">
  <title>MBTI×血液型の組み合わせ｜64パターンをLove Engineの実測データで解説</title>
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
    --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
    --accent:#7c4dce;--accent-lt:#9b72ef;--gold:#c9a84c;
    --text:#1a1a2e;--muted:#6b6b8a;--border:#e5e3ee;--bg:#faf7ff;--bg2:#f8f7fc;
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
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.4rem,4vw,2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}
  .art-section{padding:2.5rem 0}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .art-section p{font-size:.93rem;line-height:1.9;color:#333;margin-bottom:.9rem}
  .class-grid{display:grid;grid-template-columns:1fr 1fr;gap:.9rem;margin-top:1.25rem}
  .class-card{background:#fff;border:1px solid var(--border);border-radius:12px;padding:1.1rem 1.25rem}
  .class-card-title{font-family:var(--ff-serif);font-weight:700;color:var(--accent);font-size:1rem;margin-bottom:.5rem}
  .class-card-desc{font-size:.82rem;color:#444;line-height:1.7;margin-bottom:.5rem}
  .class-card-count{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted)}
  .type-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.75rem;margin-top:1rem}
  .type-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.1rem;transition:border-color .2s;text-decoration:none;display:block}
  .type-card:hover{border-color:var(--accent-lt)}
  .type-name{font-family:var(--ff-serif);font-weight:700;color:var(--text);font-size:1rem}
  .type-class{font-family:var(--ff-mono);font-size:.65rem;color:var(--accent);margin-top:.3rem}
  .type-kw{font-size:.72rem;color:var(--muted);margin-top:.3rem}
  .note-box{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.25rem;font-size:.82rem;color:var(--muted);margin-top:1.5rem;line-height:1.8}
  @media(max-width:560px){ .class-grid{grid-template-columns:1fr} }
  </style>
</head>
<body>

<header class="art-header">
  <div class="art-header-inner">
    <a href="/" class="art-logo">占い<em>Portal</em></a>
    <a href="/love" class="art-back">💜 恋愛傾向診断を受ける →</a>
  </div>
</header>

<div class="wrap">
  <nav class="breadcrumb">
    <a href="/">占いPortal</a><span>›</span>
    <a href="/love">恋愛傾向診断</a><span>›</span>
    MBTI×血液型
  </nav>

  <div class="art-hero">
    <span class="art-label">MBTI × Blood × Love Engine</span>
    <h1>MBTI×血液型の組み合わせ｜64パターン</h1>
    <p class="art-lead">MBTIと血液型は、それぞれ単体でも恋愛傾向の主軸となるPrimitiveを持ちます。この2つを組み合わせたとき、どちらの影響がより強く出るのか——Love Engineの9216通りの実測データから、64通り全ての組み合わせを分析しています。</p>
  </div>

  <section class="art-section">
    <h2>4つの分類</h2>
    <p>組み合わせた結果の主軸Primitiveが、MBTI単体・血液型単体のどちらの主軸と一致するかで、64パターンを4つに分類しています。分類は数値の閾値を使わず、実際の計算結果だけで機械的に決まります。</p>
    <div class="class-grid">
      <div class="class-card">
        <div class="class-card-title">協調型</div>
        <div class="class-card-desc">MBTI・血液型どちらの主軸とも一致。両方の入力が同じ方向を後押しする組み合わせです。</div>
        <div class="class-card-count">64通り中24通り</div>
      </div>
      <div class="class-card">
        <div class="class-card-title">拮抗型（MBTI優勢）</div>
        <div class="class-card-desc">MBTI・血液型の主軸が異なり、組み合わせるとMBTI側が採用される組み合わせです。</div>
        <div class="class-card-count">64通り中24通り</div>
      </div>
      <div class="class-card">
        <div class="class-card-title">拮抗型（血液型優勢）</div>
        <div class="class-card-desc">MBTI・血液型の主軸が異なり、組み合わせると血液型側が採用される組み合わせです。</div>
        <div class="class-card-count">64通り中12通り</div>
      </div>
      <div class="class-card">
        <div class="class-card-title">転換型</div>
        <div class="class-card-desc">MBTI・血液型のどちらの主軸とも異なる、第3のPrimitiveが組み合わせの主軸になる組み合わせです。</div>
        <div class="class-card-count">64通り中4通り</div>
      </div>
    </div>
    <p class="note-box">「勝った」「負けた」という対戦ではなく、Love Engineが各入力のスコアを計算した結果として、どのPrimitiveが最終的に主軸として採用されるかを示しています。</p>
  </section>

  <section class="art-section">
    <h2>組み合わせ一覧</h2>
    <div class="type-grid">
      <?php foreach ($_PUBLISHED as $t): ?>
      <a href="/articles/love/mbti-blood/<?= htmlspecialchars($t['slug']) ?>/" class="type-card">
        <div class="type-name"><?= htmlspecialchars($t['mbti']) ?>×<?= htmlspecialchars($t['blood']) ?></div>
        <div class="type-class"><?= htmlspecialchars($t['class']) ?></div>
        <div class="type-kw"><?= htmlspecialchars($t['kw']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
    <p class="note-box">現在公開中は<?= count($_PUBLISHED) ?>組み合わせです（全64通り中）。順次追加していきます。</p>
  </section>
</div>

<?php $currentSlug='love'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'love-mbti-blood-index');
?>
