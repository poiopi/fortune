<?php
declare(strict_types=1);
require_once __DIR__.'/inc/dayinfo/DayInfoService.php';
require_once __DIR__.'/inc/dayinfo/day-url.php';
require_once __DIR__.'/inc/dayinfo/render-star-card.php';

// 六曜class→解説記事slugの変換表（class名とslugが一致しない箇所に注意）
// rokuyo.php（Provider）自体は変更しないため、このページ側で保持する。
const ROKUYO_ARTICLE_SLUGS = [
    'taian'      => 'taian',
    'shakku'     => 'shakko',   // class名とslugが違う
    'sensho'     => 'senshou',  // class名とslugが違う
    'tomobiki'   => 'tomobiki',
    'senbu'      => 'senbu',
    'butsumetsu' => 'butsumetsu',
];

// 六曜class→「今日やるべきこと」（おすすめ・避けたいこと）。
// inc/oracle.php・inc/dayinfo/providers/rokuyo.phpは変更しないため、
// このページ側で保持する（ROKUYO_ARTICLE_SLUGSと同じパターン）。
const ROKUYO_TODO = [
    'taian'      => ['good' => ['慶事全般', '新しい始まり'], 'avoid' => '特になし'],
    'shakku'     => ['good' => ['正午前後の用事'], 'avoid' => '朝夕の慶事・刃物の扱い'],
    'sensho'     => ['good' => ['商談・契約', '新しい挑戦'], 'avoid' => '午後の重要な判断'],
    'tomobiki'   => ['good' => ['結婚・慶事', '人との交流'], 'avoid' => '争いごと・弔事関連'],
    'senbu'      => ['good' => ['落ち着いた作業', '見直し・整理'], 'avoid' => '午前中の勝負ごと'],
    'butsumetsu' => ['good' => ['静かに過ごす', '体を休める'], 'avoid' => '新規事・慶事'],
];

// 星座code→実際の記号（占星術記号）への変換表。
// inc/seiza-data.phpのSEIZA_SIGNSにも'symbol'フィールドがあるが、
// 実装5の指定に合わせ、このページ側で明示的な占星術記号を保持する。
const SEIZA_ASTRO_SYMBOLS = [
    'AR'=>'♈','TA'=>'♉','GE'=>'♊','CA'=>'♋','LE'=>'♌','VI'=>'♍',
    'LI'=>'♎','SC'=>'♏','SA'=>'♐','CP'=>'♑','AQ'=>'♒','PI'=>'♓',
];

// 星の数（1〜5）を★/☆の文字列に変換する表示用ヘルパー（DayInfoService・
// Providerには関与しない、このページだけのプレゼンテーション関数）。
function renderStars(int $n): string {
    $n = max(0, min(5, $n));
    return str_repeat('★', $n).str_repeat('☆', 5 - $n);
}

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

// ── 六曜ヒーロー用データ準備 ──
$rokuyoSection     = $dayInfo['sections']['rokuyo'];
$ratingSection     = $dayInfo['sections']['rating'];
$kichijitsuSection = $dayInfo['sections']['kichijitsu'];

$rokuyoSlug = $rokuyoSection['available'] ? (ROKUYO_ARTICLE_SLUGS[$rokuyoSection['class']] ?? null) : null;

$rokuyoTodoParagraph = null;
if ($rokuyoSection['available']) {
    $todo = ROKUYO_TODO[$rokuyoSection['class']] ?? null;
    $rokuyoTodoParagraph = $rokuyoSection['desc'];
    if ($todo !== null) {
        $goodStr = implode(' ', array_map(fn($g) => '✓ '.$g, $todo['good']));
        $rokuyoTodoParagraph .= ' 今日向いていること：'.$goodStr.'。避けたいこと：'.$todo['avoid'].'。';
    }
}

// ── 今日の星まわり用データ準備 ──
$moonSection   = $dayInfo['sections']['moon'];
$seizaSection  = $dayInfo['sections']['seiza'];
$kyuseiSection = $dayInfo['sections']['kyusei'];
$flowerSection = $dayInfo['sections']['flower'];
$stoneSection  = $dayInfo['sections']['stone'];

// ── 今日のラッキー用データ準備 ──
$luckySection = $dayInfo['sections']['lucky'];
$luckyListData = [];
if ($luckySection['available']) {
    $luckyListData = [
        ['color' => '#a97fd1', 'icon' => '●', 'label' => 'ラッキーカラー',   'value' => $luckySection['color']['name']],
        ['color' => '#e0b25c', 'icon' => '#', 'label' => 'ラッキーナンバー', 'value' => (string)$luckySection['number']],
        ['color' => '#e08a5c', 'icon' => '▲', 'label' => 'ラッキーフード',   'value' => getLuckyItemByCat($luckySection, '食べ物')],
        ['color' => '#5cc9a5', 'icon' => '◆', 'label' => 'ラッキープレイス', 'value' => getLuckyItemByCat($luckySection, '場所')],
        ['color' => '#6fa8dc', 'icon' => '▶', 'label' => 'おすすめの行動',   'value' => getLuckyItemByCat($luckySection, '行動')],
        ['color' => '#d4708f', 'icon' => '✦', 'label' => 'おすすめアイテム', 'value' => getLuckyItemByCat($luckySection, 'アイテム')],
    ];
}
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

/* ── セクション共通見出し（今日の星まわり／今日のラッキー） ── */
.day-section-heading{font-family:var(--ff-serif);font-size:1.25rem;font-weight:700;color:var(--gold-lt);letter-spacing:.04em;margin-bottom:1rem}

/* ── 区切り線（六曜ヒーローと星まわりの間に1箇所だけ） ── */
.section-divider{height:1px;margin:2rem 0;background:linear-gradient(90deg,transparent,var(--border2) 15%,var(--border2) 85%,transparent)}

/* ── 六曜ヒーロー ── */
.rokuyo-hero{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:1.7rem 1.9rem;margin-bottom:0;position:relative;overflow:hidden}
.rokuyo-hero::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal))}
.rokuyo-hero-head{display:flex;align-items:center;gap:1rem;flex-wrap:wrap}
.rokuyo-hero-link{
  font-family:var(--ff-mono);font-size:.72rem;letter-spacing:.04em;
  color:var(--violet-lt);text-decoration:none;
  display:inline-flex;align-items:center;gap:.2rem;
  transition:color .2s;
}
.rokuyo-hero-link:hover{color:var(--gold-lt)}

/* 六曜バッジ（既存の明朝体・色分けをそのまま使用） */
.rokuyo-badge{display:inline-block;text-align:center;min-width:100px;padding:.9rem 1.4rem;border-radius:10px;border:2px solid}
.rokuyo-name{font-family:var(--ff-serif);font-size:2rem;font-weight:700;line-height:1}
.rokuyo-en{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.12em;opacity:.7;margin-top:.35rem}
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

/* 吉日バッジ（六曜ヒーロー内、該当日のみ表示） */
.kichijitsu-badges{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.9rem}
.kichijitsu-badge{
  display:inline-flex;align-items:center;gap:.3rem;
  background:rgba(155,114,239,.14);border:1px solid var(--gold);
  border-radius:999px;padding:.35rem .95rem;
  font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.04em;
  color:var(--gold-lt);text-decoration:none;
  transition:background .2s,border-color .2s;
}
.kichijitsu-badge:hover{background:rgba(201,168,76,.2);border-color:var(--gold-lt)}
.kichijitsu-badge-arrow{font-size:.85rem}

/* 総合運・恋愛運・仕事運・金運バー */
.rating-bar{margin-top:1.2rem;padding-top:1.1rem;border-top:1px solid var(--border)}
.rating-overall{text-align:center;margin-bottom:.9rem}
.rating-overall-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.16em;color:var(--muted);text-transform:uppercase;margin-bottom:.35rem}
.rating-stars-lg{font-size:1.5rem;letter-spacing:.18em;color:var(--gold-lt)}
.rating-sub-row{display:flex;justify-content:space-around;gap:.5rem;flex-wrap:wrap}
.rating-sub{display:flex;flex-direction:column;align-items:center;gap:.25rem}
.rating-sub-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.08em;color:var(--muted)}
.rating-stars-sm{font-size:.85rem;letter-spacing:.1em;color:var(--violet-lt)}

/* 今日やるべきこと */
.rokuyo-todo{margin-top:1.2rem;padding-top:1.1rem;border-top:1px solid var(--border)}
.rokuyo-todo-heading{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--gold-lt);margin-bottom:.55rem}
.rokuyo-todo-text{font-size:.85rem;color:var(--muted);line-height:1.9}

/* ── 今日の星まわり ── */
.star-section{margin-bottom:1.75rem}
.star-subgroup{margin-bottom:1.4rem}
.star-subgroup:last-of-type{margin-bottom:0}
.star-group-heading{
  font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.16em;
  color:var(--muted);text-transform:uppercase;
  display:flex;align-items:center;gap:.7rem;margin-bottom:.9rem;
}
.star-group-heading::after{content:'';flex:1;height:1px;background:var(--border)}
.star-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:.9rem}
.star-card{
  background:var(--card);border:1px solid var(--border);border-radius:12px;
  padding:1rem 1.1rem;position:relative;overflow:hidden;
  display:flex;flex-direction:column;
}
.star-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal))}
a.star-card{text-decoration:none;color:inherit;transition:border-color .2s,background .2s,transform .15s}
a.star-card:hover{border-color:var(--violet-lt);background:rgba(155,114,239,.06);transform:translateY(-2px)}
.star-card-symbol{font-size:1.7rem;line-height:1;margin-bottom:.4rem}
.star-card-label{font-family:var(--ff-mono);font-size:.56rem;letter-spacing:.1em;color:var(--muted);text-transform:uppercase;margin-bottom:.3rem}
.star-card-name{font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:var(--gold-lt);margin-bottom:.35rem;line-height:1.3}
.star-card-meta{font-size:.73rem;color:var(--muted);line-height:1.6}
.star-card-desc{font-size:.78rem;color:var(--text);line-height:1.7;margin-top:.4rem;opacity:.95}
.star-card-link{
  margin-top:.7rem;padding-top:.1rem;
  font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.04em;
  color:var(--violet-lt);text-align:right;
}
.star-card-arrow{font-size:.85rem}
.star-card-comingsoon{
  margin-top:.7rem;
  font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.04em;
  color:#4a4066;text-align:right;
}
.star-group-footnote{font-size:.72rem;color:var(--muted);margin-top:.9rem;line-height:1.6}

/* ── 今日のラッキー ── */
.lucky-section{margin-bottom:1.5rem}
.lucky-msg{font-family:var(--ff-serif);font-size:.92rem;color:var(--gold-lt);font-style:italic;line-height:1.7;margin-bottom:1.1rem}
.lucky-list{list-style:none;display:flex;flex-direction:column;gap:.7rem}
.lucky-list-item{
  display:flex;align-items:center;gap:.9rem;
  background:var(--card);border:1px solid var(--border);border-radius:10px;
  padding:.85rem 1.1rem;
}
.lucky-icon{
  font-size:1.1rem;line-height:1;flex-shrink:0;width:1.5rem;text-align:center;
  color:var(--lucky-color, var(--gold-lt));
}
.lucky-text{font-size:.85rem;color:var(--text)}
.lucky-label{color:var(--muted)}
.lucky-value-text{color:var(--gold-lt);font-weight:600}

.unavailable{font-size:.85rem;color:var(--muted)}

.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}

footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

@media(max-width:600px){
  .star-grid{grid-template-columns:1fr}
  .rokuyo-hero{padding:1.4rem 1.3rem}
  .rating-sub-row{gap:.8rem}
}
@media(max-width:900px) and (min-width:601px){
  .star-grid{grid-template-columns:1fr 1fr}
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

  <!-- 六曜ヒーロー -->
  <div class="rokuyo-hero">
    <?php if ($rokuyoSection['available']): ?>
      <div class="rokuyo-hero-head">
        <div class="rokuyo-badge <?= htmlspecialchars($rokuyoSection['class']) ?>">
          <div class="rokuyo-name"><?= htmlspecialchars($rokuyoSection['name']) ?></div>
          <div class="rokuyo-en"><?= htmlspecialchars($rokuyoSection['en']) ?></div>
        </div>
        <?php if ($rokuyoSlug !== null): ?>
        <a class="rokuyo-hero-link" href="/articles/calendar/rokuyo/<?= htmlspecialchars($rokuyoSlug) ?>/">詳しく見る <span class="star-card-arrow">&#8250;</span></a>
        <?php endif; ?>
      </div>

      <?php if ($kichijitsuSection['available']): ?>
      <div class="kichijitsu-badges">
        <?php foreach ($kichijitsuSection['days'] as $day): ?>
        <a class="kichijitsu-badge" href="<?= htmlspecialchars($day['url']) ?>">
          <?= htmlspecialchars($day['name']) ?> <span class="kichijitsu-badge-arrow">&#8250;</span>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if ($ratingSection['available']): ?>
      <div class="rating-bar">
        <div class="rating-overall">
          <div class="rating-overall-label">総合運</div>
          <div class="rating-stars-lg"><?= renderStars($ratingSection['overall']) ?></div>
        </div>
        <div class="rating-sub-row">
          <div class="rating-sub">
            <span class="rating-sub-label">恋愛運</span>
            <span class="rating-stars-sm"><?= renderStars($ratingSection['love']) ?></span>
          </div>
          <div class="rating-sub">
            <span class="rating-sub-label">仕事運</span>
            <span class="rating-stars-sm"><?= renderStars($ratingSection['work']) ?></span>
          </div>
          <div class="rating-sub">
            <span class="rating-sub-label">金運</span>
            <span class="rating-stars-sm"><?= renderStars($ratingSection['money']) ?></span>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($rokuyoTodoParagraph !== null): ?>
      <div class="rokuyo-todo">
        <div class="rokuyo-todo-heading">今日やるべきこと</div>
        <p class="rokuyo-todo-text"><?= htmlspecialchars($rokuyoTodoParagraph) ?></p>
      </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="unavailable">情報がありません</div>
    <?php endif; ?>
  </div>

  <div class="section-divider"></div>

  <!-- 今日の星まわり -->
  <section class="star-section">
    <h2 class="day-section-heading">今日の星まわり</h2>

    <div class="star-subgroup">
      <div class="star-group-heading">空模様</div>
      <div class="star-grid">
        <?php
          // 月齢（アイコンは☾に統一。urlは常にnullのためcomingSoon扱い）
          echo renderStarCard([
            'label'      => '月齢・月相',
            'available'  => $moonSection['available'],
            'symbol'     => $moonSection['available'] ? '☾' : null,
            'name'       => $moonSection['available'] ? $moonSection['phase_name'] : null,
            'meta'       => $moonSection['available'] ? ('月齢'.$moonSection['age']) : null,
            'desc'       => $moonSection['available'] ? $moonSection['description'] : null,
            'url'        => null,
            'comingSoon' => $moonSection['available'],
          ]);

          // 星座（アイコンは実際の占星術記号に変更。strengthはこのカードでは非表示）
          $seizaSymbol = $seizaSection['available'] ? (SEIZA_ASTRO_SYMBOLS[$seizaSection['code']] ?? $seizaSection['symbol']) : null;
          echo renderStarCard([
            'label'     => '星座',
            'available' => $seizaSection['available'],
            'symbol'    => $seizaSymbol,
            'name'      => $seizaSection['available'] ? ($seizaSection['name'].'（'.$seizaSection['suffix'].'タイプ）') : null,
            'meta'      => $seizaSection['available'] ? ($seizaSection['period'].'・'.$seizaSection['element_name'].'・'.$seizaSection['quality_name']) : null,
            'desc'      => $seizaSection['available'] ? $seizaSection['personality'] : null,
            'url'       => $seizaSection['available'] ? ($seizaSection['url'] ?? null) : null,
          ]);
        ?>
      </div>
    </div>

    <div class="star-subgroup">
      <div class="star-group-heading">気学</div>
      <div class="star-grid">
        <?php
          // 年九星（アイコンは◈に統一。meta=personality、desc=fortune）
          echo renderStarCard([
            'label'     => '年九星',
            'available' => $kyuseiSection['available'],
            'symbol'    => $kyuseiSection['available'] ? '◈' : null,
            'name'      => $kyuseiSection['available'] ? $kyuseiSection['year']['name'] : null,
            'meta'      => $kyuseiSection['available'] ? $kyuseiSection['year']['personality'] : null,
            'desc'      => $kyuseiSection['available'] ? $kyuseiSection['year']['fortune'] : null,
            'url'       => $kyuseiSection['available'] ? ($kyuseiSection['year']['url'] ?? null) : null,
          ]);

          // 月九星
          echo renderStarCard([
            'label'     => '月九星',
            'available' => $kyuseiSection['available'],
            'symbol'    => $kyuseiSection['available'] ? '◈' : null,
            'name'      => $kyuseiSection['available'] ? $kyuseiSection['month']['name'] : null,
            'meta'      => $kyuseiSection['available'] ? $kyuseiSection['month']['personality'] : null,
            'desc'      => $kyuseiSection['available'] ? $kyuseiSection['month']['fortune'] : null,
            'url'       => $kyuseiSection['available'] ? ($kyuseiSection['month']['url'] ?? null) : null,
          ]);
        ?>
      </div>
    </div>

    <div class="star-subgroup">
      <div class="star-group-heading">今日という日</div>
      <div class="star-grid">
        <?php
          // 誕生花（アイコンは❀に統一。urlは常にnullのためcomingSoon扱い）
          echo renderStarCard([
            'label'      => '誕生花',
            'available'  => $flowerSection['available'],
            'symbol'     => $flowerSection['available'] ? '❀' : null,
            'name'       => $flowerSection['available'] ? $flowerSection['name'] : null,
            'meta'       => $flowerSection['available'] ? ('花言葉「'.$flowerSection['meaning'].'」') : null,
            'desc'       => $flowerSection['available'] ? ($flowerSection['feature'] ?: null) : null,
            'url'        => null,
            'comingSoon' => $flowerSection['available'],
          ]);

          // 今月の誕生石（アイコンは◆に統一。urlは常にnullのためcomingSoon扱い）
          echo renderStarCard([
            'label'      => '今月の誕生石',
            'available'  => $stoneSection['available'],
            'symbol'     => $stoneSection['available'] ? '◆' : null,
            'name'       => $stoneSection['available'] ? $stoneSection['name'] : null,
            'meta'       => $stoneSection['available'] ? ('石言葉「'.$stoneSection['meaning'].'」') : null,
            'desc'       => $stoneSection['available'] ? ($stoneSection['feature'] ?? null) : null,
            'url'        => null,
            'comingSoon' => $stoneSection['available'],
          ]);
        ?>
      </div>
    </div>

    <p class="star-group-footnote">※誕生花には複数の体系があり、本サイトでは一般的な体系の一つを採用しています。</p>
  </section>

  <!-- 今日のラッキー -->
  <section class="lucky-section">
    <h2 class="day-section-heading">今日のラッキー</h2>
    <?php if ($luckySection['available']): ?>
      <div class="lucky-msg">&#x2726; <?= htmlspecialchars($luckySection['message']) ?></div>
      <ul class="lucky-list">
        <?php foreach ($luckyListData as $item): ?>
        <li class="lucky-list-item">
          <span class="lucky-icon" style="--lucky-color:<?= htmlspecialchars($item['color']) ?>"><?= htmlspecialchars($item['icon']) ?></span>
          <span class="lucky-text"><span class="lucky-label"><?= htmlspecialchars($item['label']) ?>：</span><span class="lucky-value-text"><?= htmlspecialchars($item['value']) ?></span></span>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <div class="unavailable">情報がありません</div>
    <?php endif; ?>
  </section>

  <!-- AdSense枠 -->
  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="nav-cards-section" style="padding:2rem 0 0"><h3>✦ 次はこれを試してみては？ ✦</h3><?php require_once __DIR__.'/inc/nav-cards.php'; echo _nav_cards(3,'calendar'); ?></div>

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
