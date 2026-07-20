<?php
declare(strict_types=1);
require_once __DIR__.'/inc/dayinfo/DayInfoService.php';
require_once __DIR__.'/inc/dayinfo/day-url.php';

// ══════════════════════════════════════════════════════════════════
// 日別詳細ページ
// $_GET['date']（Y-m-d想定）から対象日を決定。不正・未指定の場合は当日にフォールバック。
// ══════════════════════════════════════════════════════════════════
$rawDate = isset($_GET['date']) ? trim((string)$_GET['date']) : '';
$date = null;
if ($rawDate !== '') {
    $parsed = DateTimeImmutable::createFromFormat('Y-m-d', $rawDate);
    // createFromFormatは'2026-13-99'のような値も繰り上げ計算で通してしまうことがあるため、
    // 生成結果を再度Y-m-d形式に戻して入力文字列と一致するかで厳密に検証する。
    if ($parsed !== false && $parsed->format('Y-m-d') === $rawDate) {
        $date = $parsed;
    }
}
if ($date === null) {
    $date = new DateTimeImmutable('today');
}

$dayInfo = getDayInfo($date);

$backYear  = (int)$date->format('Y');
$backMonth = (int)$date->format('n');
$backUrl   = calendarUrl($backYear, $backMonth);

$dateLabel = $date->format('Y年n月j日').'（'.$dayInfo['meta']['weekday'].'）';
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
<link rel="canonical" href="https://life-fun.net/calendar-day?date=<?= htmlspecialchars($dayInfo['meta']['date']) ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= htmlspecialchars($dateLabel) ?>の六曜・星座・九星をまとめて確認できる日別詳細ページ。">
<title><?= htmlspecialchars($dateLabel) ?>の運勢｜開運カレンダー</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #08060f;
  --card:    #1e1738;
  --card2:   #251d42;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.32);
  --gold:    #c9a84c;
  --gold-lt: #e8c96a;
  --violet:  #9b72ef;
  --violet-lt:#c4a8f5;
  --rose:    #e8719a;
  --teal:    #4ecdc4;
  --text:    #e8e2f5;
  --muted:   #8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{
  background:var(--void);
  color:var(--text);
  font-family:var(--ff-sans);
  font-weight:300;
  line-height:1.8;
  min-height:100vh;
}
body::before{
  content:'';position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),
    radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);
  pointer-events:none;z-index:0;
}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

.back-nav{padding:1.2rem 0 0}
.back-link{
  font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.06em;
  color:var(--muted);text-decoration:none;
  display:inline-flex;align-items:center;gap:.35rem;
  transition:color .2s;
}
.back-link:hover{color:var(--gold-lt)}

.hero{text-align:center;padding:2rem 1rem 1.5rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.6rem,5vw,2.4rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

.section-card{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:1.5rem 1.8rem;margin-bottom:1.25rem;position:relative;overflow:hidden}
.section-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal))}
.section-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.16em;color:var(--muted);text-transform:uppercase;margin-bottom:.9rem}

/* 六曜 */
.rokuyo-badge{display:inline-block;text-align:center;min-width:100px;padding:.9rem 1.4rem;border-radius:10px;border:2px solid;margin-bottom:.9rem}
.rokuyo-name{font-family:var(--ff-serif);font-size:2rem;font-weight:700;line-height:1}
.rokuyo-en{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.12em;opacity:.7;margin-top:.35rem}
.rokuyo-desc{font-size:.85rem;color:var(--muted);line-height:1.8}
.taian{border-color:#c9a84c;background:rgba(201,168,76,.08)}
.taian .rokuyo-name{color:#c9a84c}
.shakku{border-color:#e8719a;background:rgba(232,113,154,.08)}
.shakku .rokuyo-name{color:#e8719a}
.sensho{border-color:#9b72ef;background:rgba(155,114,239,.08)}
.sensho .rokuyo-name{color:#9b72ef}
.tomobiki{border-color:#4ecdc4;background:rgba(78,205,196,.08)}
.tomobiki .rokuyo-name{color:#4ecdc4}
.senbu{border-color:#8a7db5;background:rgba(138,125,181,.08)}
.senbu .rokuyo-name{color:#8a7db5}
.butsumetsu{border-color:#6b6456;background:rgba(107,100,86,.08)}
.butsumetsu .rokuyo-name{color:#8a7db5}

/* 星座 */
.seiza-row{display:flex;align-items:center;gap:1rem}
.seiza-symbol{font-size:2.4rem;line-height:1}
.seiza-name{font-family:var(--ff-serif);font-size:1.3rem;font-weight:700;color:var(--gold-lt)}
.seiza-suffix{font-size:.82rem;color:var(--muted);margin-top:.2rem}

/* 九星 */
.kyusei-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.kyusei-item{background:var(--card2);border:1px solid var(--border);border-radius:10px;padding:1rem}
.kyusei-item-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.12em;color:var(--muted);margin-bottom:.4rem}
.kyusei-item-symbol{font-size:1.6rem;margin-bottom:.2rem}
.kyusei-item-name{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--gold-lt)}

.unavailable{font-size:.85rem;color:var(--muted)}

.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}

footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

@media(max-width:600px){
  .kyusei-grid{grid-template-columns:1fr}
}
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
</style>
<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>
<?php $currentPage='calendar'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">

  <nav class="back-nav">
    <a href="<?= htmlspecialchars($backUrl) ?>" class="back-link">&#9664; カレンダーへ戻る</a>
  </nav>

  <section class="hero">
    <span class="hero-eyebrow">Day Detail</span>
    <h1><?= htmlspecialchars($dateLabel) ?></h1>
  </section>

  <?php foreach ($dayInfo['sections'] as $sectionKey => $section): ?>

    <?php if ($sectionKey === 'rokuyo'): ?>
      <div class="section-card">
        <div class="section-label">六曜</div>
        <?php if ($section['available']): ?>
          <div class="rokuyo-badge <?= htmlspecialchars($section['class']) ?>">
            <div class="rokuyo-name"><?= htmlspecialchars($section['name']) ?></div>
            <div class="rokuyo-en"><?= htmlspecialchars($section['en']) ?></div>
          </div>
          <div class="rokuyo-desc"><?= htmlspecialchars($section['desc']) ?></div>
        <?php else: ?>
          <div class="unavailable">情報がありません</div>
        <?php endif; ?>
      </div>

    <?php elseif ($sectionKey === 'seiza'): ?>
      <div class="section-card">
        <div class="section-label">星座</div>
        <?php if ($section['available']): ?>
          <div class="seiza-row">
            <div class="seiza-symbol"><?= htmlspecialchars($section['symbol']) ?></div>
            <div>
              <div class="seiza-name"><?= htmlspecialchars($section['name']) ?></div>
              <div class="seiza-suffix"><?= htmlspecialchars($section['suffix']) ?>タイプ</div>
            </div>
          </div>
        <?php else: ?>
          <div class="unavailable">情報がありません</div>
        <?php endif; ?>
      </div>

    <?php elseif ($sectionKey === 'kyusei'): ?>
      <div class="section-card">
        <div class="section-label">九星（年家九星・月家九星）</div>
        <?php if ($section['available']): ?>
          <div class="kyusei-grid">
            <div class="kyusei-item">
              <div class="kyusei-item-label">年九星</div>
              <div class="kyusei-item-symbol"><?= htmlspecialchars($section['year']['symbol']) ?></div>
              <div class="kyusei-item-name"><?= htmlspecialchars($section['year']['name']) ?></div>
            </div>
            <div class="kyusei-item">
              <div class="kyusei-item-label">月九星</div>
              <div class="kyusei-item-symbol"><?= htmlspecialchars($section['month']['symbol']) ?></div>
              <div class="kyusei-item-name"><?= htmlspecialchars($section['month']['name']) ?></div>
            </div>
          </div>
        <?php else: ?>
          <div class="unavailable">情報がありません</div>
        <?php endif; ?>
      </div>

    <?php endif; ?>

  <?php endforeach; ?>

  <!-- AdSense枠 -->
  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <nav class="back-nav" style="padding-bottom:1.2rem">
    <a href="<?= htmlspecialchars($backUrl) ?>" class="back-link">&#9664; カレンダーへ戻る</a>
  </nav>

</div>

<?php require __DIR__.'/inc/footer.php'; ?>
<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
</script>
</body>
</html>
