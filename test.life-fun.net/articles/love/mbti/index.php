<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../inc/auto-link.php';

// 公開済みタイプのみ掲載（残り15タイプは順次追加）
$_PUBLISHED = [
  ['slug'=>'entp', 'code'=>'ENTP', 'name'=>'討論者',   'kw'=>'知的な刺激・率直な対話'],
  ['slug'=>'intp', 'code'=>'INTP', 'name'=>'論理学者', 'kw'=>'静かな知的探求・慎重な関係構築'],
  ['slug'=>'enfp', 'code'=>'ENFP', 'name'=>'運動家',   'kw'=>'情熱・共感・惚れやすさ'],
  ['slug'=>'infp', 'code'=>'INFP', 'name'=>'仲介者',   'kw'=>'誠実な理想・静かな情熱'],
  ['slug'=>'entj', 'code'=>'ENTJ', 'name'=>'指揮官',   'kw'=>'明確な意志・揺るがない誠実さ'],
  ['slug'=>'intj', 'code'=>'INTJ', 'name'=>'建築家',   'kw'=>'静かな観察・一貫した献身'],
  ['slug'=>'enfj', 'code'=>'ENFJ', 'name'=>'主人公',   'kw'=>'深い共感・まっすぐな誠実さ'],
  ['slug'=>'infj', 'code'=>'INFJ', 'name'=>'提唱者',   'kw'=>'静かな誠実さ・深い共感'],
  ['slug'=>'estp', 'code'=>'ESTP', 'name'=>'起業家',   'kw'=>'今この瞬間・行動力'],
  ['slug'=>'istp', 'code'=>'ISTP', 'name'=>'巨匠',     'kw'=>'静かな観察・実直な行動'],
  ['slug'=>'esfp', 'code'=>'ESFP', 'name'=>'エンターテイナー', 'kw'=>'明るさ・開放的な魅力'],
  ['slug'=>'isfp', 'code'=>'ISFP', 'name'=>'冒険家',   'kw'=>'静かな優しさ・素直な感情'],
  ['slug'=>'estj', 'code'=>'ESTJ', 'name'=>'幹部',     'kw'=>'揺るぎない誠実さ・行動力'],
  ['slug'=>'istj', 'code'=>'ISTJ', 'name'=>'管理者',   'kw'=>'着実な信頼・揺るぎない誠実さ'],
  ['slug'=>'esfj', 'code'=>'ESFJ', 'name'=>'領事',     'kw'=>'温かい思いやり・誠実さ'],
  ['slug'=>'isfj', 'code'=>'ISFJ', 'name'=>'擁護者',   'kw'=>'静かな献身・揺るぎない誠実さ'],
];

ob_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/articles/love/mbti/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MBTIタイプ別の恋愛傾向を、Love Engineの実測データ（9216パターン分析）で解説。恋愛スタイル・結婚観・相性の傾向とその理由を紹介。">
  <title>MBTI×恋愛傾向｜タイプ別の恋愛スタイル・結婚観を実測データで解説</title>
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
  .art-hero h1{font-family:var(--ff-serif);font-size:clamp(1.5rem,4vw,2.2rem);font-weight:700;line-height:1.3;letter-spacing:.04em;color:var(--text);margin-bottom:.75rem}
  .art-lead{font-size:.95rem;color:var(--muted);line-height:1.9}
  .art-section{padding:2.5rem 0}
  .art-section h2{font-family:var(--ff-serif);font-size:1.35rem;font-weight:700;color:var(--text);margin-bottom:1rem;padding-left:.9rem;border-left:3px solid var(--accent)}
  .type-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.75rem;margin-top:1rem}
  .type-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.9rem 1rem;transition:border-color .2s;text-decoration:none;display:block}
  .type-card:hover{border-color:var(--accent-lt)}
  .type-code{font-family:var(--ff-mono);font-size:1rem;color:var(--accent)}
  .type-name{font-family:var(--ff-serif);font-weight:700;color:var(--text);margin:.2rem 0}
  .type-kw{font-size:.72rem;color:var(--muted)}
  .type-card.soon{opacity:.45;pointer-events:none}
  .note-box{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem 1.25rem;font-size:.82rem;color:var(--muted);margin-top:1.5rem;line-height:1.8}
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
    MBTI×恋愛
  </nav>

  <div class="art-hero">
    <span class="art-label">MBTI × Love Engine</span>
    <h1>MBTIタイプ別の恋愛傾向</h1>
    <p class="art-lead">Love Engineが9216パターンの診断結果を分析した実測データをもとに、MBTI16タイプそれぞれの恋愛スタイル・結婚観・相性の傾向を、なぜそうなるかという理由つきで解説します。</p>
  </div>

  <section class="art-section">
    <h2>タイプ一覧</h2>
    <div class="type-grid">
      <?php foreach ($_PUBLISHED as $t): ?>
      <a href="/articles/love/mbti/<?= htmlspecialchars($t['slug']) ?>/" class="type-card">
        <div class="type-code"><?= htmlspecialchars($t['code']) ?></div>
        <div class="type-name"><?= htmlspecialchars($t['name']) ?></div>
        <div class="type-kw"><?= htmlspecialchars($t['kw']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
    <p class="note-box">MBTI16タイプすべての恋愛傾向記事が揃っています。各タイプの一般的な性格解説は<a href="/articles/mbti/" style="color:var(--accent)">MBTI診断とは（16タイプ完全ガイド）</a>もあわせてご覧いただけます。</p>
  </section>
</div>

<?php $currentSlug='love'; $pageType='article'; require __DIR__.'/../../../inc/footer.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();
echo autoLink($html, 'love-mbti-index');
?>
