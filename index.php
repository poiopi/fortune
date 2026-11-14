<?php
declare(strict_types=1);
require_once __DIR__.'/inc/oracle.php';
require_once __DIR__.'/inc/site.php';

$today      = new DateTimeImmutable();
$todayStr   = $today->format('Y-m-d');
$rokuyo     = getRokuyo((int)$today->format('Y'), (int)$today->format('n'), (int)$today->format('j'));
$luckyItems = getLuckyItems($todayStr);

$weekdayJp = ['日','月','火','水','木','金','土'];
$oracleDateLabel = $today->format('Y年n月j日').'（'.$weekdayJp[(int)$today->format('w')].'）';

// ── Hero「今日のお楽しみ」（2026-11-13）：今日の暦（日めくり）と今日の4択（おみくじ札）
require_once __DIR__.'/inc/dayinfo/DayInfoService.php';
require_once __DIR__.'/quiz/_list.php';
/** 1〜999 を漢数字に（十一、五十七 など） */
function ht_kanji_num(int $n): string {
    $d = ['', '一', '二', '三', '四', '五', '六', '七', '八', '九'];
    $s = '';
    foreach ([100 => '百', 10 => '十'] as $unit => $kanji) {
        $q = intdiv($n, $unit);
        if ($q > 0) { $s .= ($q > 1 ? $d[$q] : '').$kanji; }
        $n %= $unit;
    }
    return $s.$d[$n];
}
$_htInfo    = getDayInfo($today);
$_htRokuyo  = $_htInfo['sections']['rokuyo']['name'] ?? $rokuyo['name'];
$_htMonth   = ht_kanji_num((int)$today->format('n')).'月';
$_htWeekday = $weekdayJp[(int)$today->format('w')].'曜日';
// 六曜ごとの短い一言（DayInfoServiceの説明文を短くしたもの）
$_htRokuyoShort = [
    '大安' => ['吉', '終日・万事'],
    '先勝' => ['吉', '午前・急ぎ事'],
    '友引' => ['吉', '朝夕・慶事'],
    '先負' => ['吉', '午後・静かに'],
    '赤口' => ['吉', '正午ごろ'],
    '仏滅' => ['心', '控えめに'],
];
$_htKichi = array_column($_htInfo['sections']['kichijitsu']['days'] ?? [], 'name');
$_htMoon  = $_htInfo['sections']['moon']['phase_name'] ?? '';
$_htColor = $_htInfo['sections']['lucky']['color']['name'] ?? '';
$_htRows  = [];
$_htRows[] = $_htKichi !== [] ? ['吉', implode('・', $_htKichi)] : ($_htRokuyoShort[$_htRokuyo] ?? ['吉', '']);
if ($_htMoon !== '')  { $_htRows[] = ['月', $_htMoon]; }
if ($_htColor !== '') { $_htRows[] = ['色', $_htColor]; }
// スマホでは上の3行の代わりに1行の添え書きを出す（吉日があれば吉日を優先）
$_htNote = $_htKichi !== [] ? implode('・', $_htKichi) : implode('・', array_filter([$_htMoon, $_htColor], fn($v) => $v !== ''));
$_htQuiz    = quiz_of_the_day($today);
$_htQuizTag = $_htQuiz !== null ? (quiz_theme_labels()[$_htQuiz['themes'][0] ?? '']['label'] ?? 'みつぼしの4択') : '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php
/* Quirksモード修正（2026-09 Stage3）：inc/nav-cards.phpはPHP終了タグの外側に
   <style>ブロックを持つため、requireした時点でその内容がそのまま出力される。
   以前はrequireがDOCTYPEより前（ファイル冒頭）にあったため、DOCTYPEより前に
   このstyleが出力されQuirksモードの原因になっていた。DOCTYPE出力後・
   $_NAV_PAGES初回使用（Heroピル、669行目付近）より前であるここへ移動する。
   nav-cards.php自体の表示・CSSは無変更。 */
require_once __DIR__.'/inc/nav-cards.php';
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= htmlspecialchars(TOP_DESCRIPTION, ENT_QUOTES) ?>">
<title><?= htmlspecialchars(TOP_TITLE, ENT_QUOTES) ?></title>
<?php if (SITE_WEBSITE_META): ?>
<meta property="og:site_name" content="<?= htmlspecialchars(SITE_NAME, ENT_QUOTES) ?>">
<script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => SITE_NAME, 'alternateName' => SITE_ALT_NAMES, 'url' => SITE_URL . '/'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════
   CSS変数
══════════════════════════════════ */
:root {
  --void:     #060410;
  --deep:     #0a0818;
  --surface:  #120f24;
  --card:     #1a1535;
  --card2:    #221a42;
  --panel:    #0d0b20;
  --border:   rgba(160,130,220,.15);
  --border2:  rgba(160,130,220,.32);
  --gold:     #c9a84c;
  --gold-lt:  #e8d48a;
  --gold-dk:  #8b6914;
  --violet:   #7a4a9e;
  --violet-lt:#b088e0;
  --rose:     #c85080;
  --teal:     #3ab8b0;
  --text:     #e8e2f5;
  --muted:    #8a7db5;
  --text-secondary: #b7acd7; /* 本文用：--mutedより明るく可読性重視。ラベル装飾には使わない */
  --ff-serif: 'Shippori Mincho', serif;
  --ff-sans:  'Zen Kaku Gothic New', sans-serif;
  --ff-mono:  'DM Mono', monospace;
}

*,*::before,*::after { box-sizing: border-box; margin: 0; padding: 0; }
html { font-size: 16px; scroll-behavior: smooth; }
body {
  background: var(--void);
  color: var(--text);
  font-family: var(--ff-sans);
  font-weight: 300;
  line-height: 1.8;
  overflow-x: hidden;
}

/* ══ 共通 ══ */
.wrap { max-width: 960px; margin: 0 auto; padding: 0 1.2rem; }
.section-label {
  font-family: var(--ff-mono);
  font-size: .6rem;
  letter-spacing: .3em;
  color: var(--gold);
  text-transform: uppercase;
  text-align: center;
  display: block;
  margin-bottom: .5rem;
}
.section-title {
  font-family: var(--ff-serif);
  font-size: clamp(1.15rem, 3vw, 1.5rem);
  font-weight: 700;
  text-align: center;
  color: var(--text);
  letter-spacing: .1em;
  margin-bottom: .35rem;
}
.fortune-guide {
  font-size: .875rem;
  color: var(--gold-lt);
  text-align: center;
  letter-spacing: .02em;
  margin: 0 auto 1.6rem;
  max-width: 480px;
}
.section-sub {
  font-size: .85rem;
  color: var(--text-secondary);
  line-height: 1.7;
  text-align: center;
  letter-spacing: .03em;
  margin-bottom: 2rem;
}

/* ══ セクション区切り ══ */
.parallax-band {
  height: 36px;
  display: flex; align-items: center; justify-content: center;
}
.pb-content {
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: 7px; width: 100%;
}
.pb-gold-line {
  width: min(480px, 80%);
  height: 1px;
  background: linear-gradient(90deg,
    transparent, rgba(201,168,76,.55) 30%,
    rgba(201,168,76,.9) 50%,
    rgba(201,168,76,.55) 70%, transparent);
}
.pb-kamon {
  font-size: 1rem;
  color: rgba(201,168,76,.5);
  letter-spacing: .2em;
  font-family: var(--ff-mono);
}

/* フェードイン共通 */
.fade-up {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .7s ease, transform .7s ease;
}
.fade-up.visible { opacity: 1; transform: translateY(0); }

/* ══════════════════════════════════
   HERO
══════════════════════════════════ */
.hero {
  position: relative;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  overflow: hidden;
}
#canvas-stars {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  pointer-events: none;
}
.hero-top-accent {
  position: absolute; top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--gold-dk) 20%, var(--gold) 50%, var(--gold-dk) 80%, transparent);
  z-index: 2;
}
.hero-inner {
  position: relative; z-index: 3;
  text-align: center;
  padding: 1rem 1.2rem .8rem;
  max-width: 1100px;
  width: 100%;
}
.hero-inner > * {
  opacity: 0; transform: translateY(16px);
  animation: hFade .85s ease forwards;
}
.h-d1 { animation-delay: .15s; }
.h-d2 { animation-delay: .35s; }
.h-d3 { animation-delay: .5s; }
.h-d4 { animation-delay: .65s; }
.h-d5 { animation-delay: .85s; }
.h-d6 { animation-delay: 1.05s; }
.h-d7 { animation-delay: 1.3s; }
@keyframes hFade { to { opacity: 1; transform: translateY(0); } }

.hero-eyebrow { font-family: var(--ff-mono); font-size: .62rem; letter-spacing: .35em; color: var(--gold); text-transform: uppercase; display: block; margin-bottom: .8rem; }
.hero-deco {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  margin: 0 auto .6rem; max-width: 240px;
}
.hero-deco::before, .hero-deco::after {
  content: ''; flex: 1; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(201,168,76,.6));
}
.hero-deco::after { background: linear-gradient(270deg, transparent, rgba(201,168,76,.6)); }
.hero-deco span { font-size: .9rem; color: var(--gold); opacity: .8; }
.hero-h1 {
  font-family: var(--ff-serif);
  font-size: clamp(2rem, 6.5vw, 3.5rem);
  font-weight: 700; line-height: 1.15;
  letter-spacing: .1em;
  background: linear-gradient(140deg, var(--gold-lt) 0%, #fff 45%, var(--violet-lt) 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: .6rem;
  text-shadow: none;
}
.hero-h1-desc { display: block; font-size: .4em; letter-spacing: .3em; margin-top: .55rem; font-weight: 600; }
.hero-sub { font-size: .88rem; color: rgba(200,190,230,.5); letter-spacing: .1em; display: block; margin-bottom: 1.15rem; }
/* 三星統合鑑定カード（2026-11-13改訂。DESIGN.md「フラッグシップカード」） */
.hf-sp{display:none}
.hero-flagship-card{position:relative;max-width:640px;margin:0 auto 1.5rem;padding:.95rem 2.4rem 1.05rem;
 border:1px solid rgba(201,168,76,.42);border-radius:16px;
 background:radial-gradient(120% 90% at 50% 0%,rgba(201,168,76,.10),transparent 55%),
            radial-gradient(80% 70% at 50% 120%,rgba(122,74,158,.22),transparent 60%),var(--panel);
 box-shadow:0 24px 60px rgba(0,0,0,.5),inset 0 1px 0 rgba(232,212,138,.12);text-align:center}
.hf-frame{position:absolute;inset:7px;border:1px solid rgba(201,168,76,.16);border-radius:11px;pointer-events:none}
.hf-orn{position:absolute;width:30px;height:30px;color:var(--gold);opacity:.75}
.hf-orn:nth-child(1){top:4px;left:4px}
.hf-orn:nth-child(2){top:4px;right:4px;transform:scaleX(-1)}
.hf-orn:nth-child(3){bottom:4px;left:4px;transform:scaleY(-1)}
.hf-orn:nth-child(4){bottom:4px;right:4px;transform:scale(-1,-1)}
.hf-crest{display:flex;align-items:center;justify-content:center;gap:1rem;margin:0 auto .15rem}
.hf-rule{display:flex;align-items:center;gap:.8rem;width:150px;font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.34em;text-transform:uppercase;color:var(--gold)}
.hf-rule:first-child{justify-content:flex-end}
.hf-rule:first-child::before,.hf-rule:last-child::after{content:'';flex:1;height:1px}
.hf-rule:first-child::before{background:linear-gradient(90deg,transparent,rgba(201,168,76,.55))}
.hf-rule:last-child::after{background:linear-gradient(270deg,transparent,rgba(201,168,76,.55))}
.hf-emblem{width:88px;height:88px;display:block;margin:-6px 0 -4px;filter:brightness(1.75) saturate(1.1) drop-shadow(0 0 14px rgba(201,168,76,.45))}
.hf-title{font-family:var(--ff-serif);font-size:1.85rem;font-weight:700;letter-spacing:.16em;line-height:1.3;background:linear-gradient(180deg,#fbf3dc 30%,#d8bd78);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;text-indent:.16em;margin-bottom:.4rem}
.hf-methods{display:flex;align-items:center;justify-content:center;gap:.7rem;margin-bottom:.45rem;font-family:var(--ff-serif);font-size:.74rem;letter-spacing:.08em;color:var(--text-secondary)}
.hf-methods span{display:inline-flex;align-items:center;gap:.35rem}
.hf-methods img{width:20px;height:20px}
.hf-methods i{width:3px;height:3px;background:var(--gold);transform:rotate(45deg);opacity:.7}
.hf-desc{font-size:.8rem;line-height:1.75;color:var(--text-secondary);margin-bottom:.85rem;letter-spacing:.03em}
.hf-btn{padding:.72rem 2.3rem;font-size:.9rem;letter-spacing:.14em}
.hf-btn span{display:inline-block;margin-left:.3rem}
.hf-trust{margin-top:.6rem;font-size:.66rem;letter-spacing:.08em;color:var(--muted);display:flex;justify-content:center;align-items:center;gap:.7rem}
.hf-trust b{width:3px;height:3px;border-radius:50%;background:rgba(201,168,76,.55)}
@media (max-width:639px){
 .hf-sp{display:inline}
 .hero-flagship-card{padding:.95rem 1.2rem 1rem;margin-bottom:1.25rem}
 .hf-frame{inset:5px;border-radius:12px}
 .hf-orn{width:24px;height:24px}
 .hf-rule{width:92px;font-size:.5rem;letter-spacing:.24em;gap:.5rem}
 .hf-crest{gap:.6rem}
 .hf-emblem{width:70px;height:70px;margin:-4px 0 -2px}
 .hf-title{font-size:1.45rem;letter-spacing:.12em;margin-bottom:.3rem}
 .hf-methods{font-size:.66rem;gap:.45rem;letter-spacing:.02em}
 .hf-methods img{width:18px;height:18px}
 .hf-desc{font-size:.74rem;line-height:1.65;margin-bottom:.7rem}
 .hf-btn{padding:.7rem 1.6rem;font-size:.86rem;letter-spacing:.1em}
 .hf-trust{font-size:.62rem;gap:.5rem;margin-top:.5rem}
}
/* 今日のお楽しみ（2026-11-13新設。DESIGN.md「今日のお楽しみ」） */
.hero-today{max-width:1040px;margin:0 auto 1.6rem}
.ht-head{display:flex;align-items:baseline;justify-content:center;gap:.9rem;margin:0 0 .8rem}
.ht-h{font-family:var(--ff-serif);font-size:.92rem;font-weight:600;letter-spacing:.24em;color:#e9dfc6}
.ht-s{font-size:.68rem;letter-spacing:.08em;color:var(--muted)}
.ht-head::before,.ht-head::after{content:'';flex:0 0 46px;height:1px;align-self:center;background:linear-gradient(90deg,transparent,rgba(233,223,198,.35))}
.ht-head::after{background:linear-gradient(270deg,transparent,rgba(233,223,198,.35))}
.ht-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem;text-align:left}
.ht-item{display:block;text-decoration:none;color:inherit;filter:drop-shadow(0 10px 18px rgba(0,0,0,.45));transition:transform .2s}
.ht-item:hover{transform:translateY(-2px)}
.ht-paper{--ink:#2d2433;--ink2:#6e6253;--shu:#a8432f;position:relative;height:100%;color:var(--ink);
 background:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='180' height='180'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 .32 0 0 0 0 .25 0 0 0 0 .16 0 0 0 .11 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>"), url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='260' height='260'><filter id='f'><feTurbulence type='fractalNoise' baseFrequency='.012 .09' numOctaves='3' seed='4'/><feColorMatrix values='0 0 0 0 .55 0 0 0 0 .45 0 0 0 0 .3 0 0 0 .07 0'/></filter><rect width='100%' height='100%' filter='url(%23f)'/></svg>"),linear-gradient(180deg,#e6dcc5,#dbcfb4);}
.ht-hm{padding:.95rem 1.1rem .7rem;border-radius:2px 2px 4px 4px;
 -webkit-mask:radial-gradient(circle at 5px 0,transparent 2.2px,#000 2.6px) 0 0/10px 100% repeat-x;
         mask:radial-gradient(circle at 5px 0,transparent 2.2px,#000 2.6px) 0 0/10px 100% repeat-x}
.ht-cal{position:relative}
.ht-cal::before,.ht-cal::after{content:'';position:absolute;left:3px;right:3px;bottom:-3px;height:10px;background:#cdbf9f;border-radius:0 0 4px 4px;z-index:-1}
.ht-cal::after{left:6px;right:6px;bottom:-6px;background:#b3a582}
.ht-hm-top{display:flex;justify-content:space-between;font-family:var(--ff-serif);font-size:.66rem;letter-spacing:.14em;color:var(--ink2);padding-bottom:.35rem;border-bottom:1px solid rgba(45,36,51,.18)}
.ht-hm-body{display:flex;align-items:center;gap:1rem;padding:.35rem 0 .3rem}
.ht-hm-day{font-family:var(--ff-serif);font-weight:700;font-size:3.4rem;line-height:1;letter-spacing:-.02em;color:var(--ink);padding:0 .1rem}
.ht-hm-side{flex:1;display:flex;align-items:center;gap:.8rem;justify-content:space-between}
.ht-hm-stamp{writing-mode:vertical-rl;font-family:var(--ff-serif);font-weight:700;font-size:.9rem;letter-spacing:.14em;color:var(--shu);border:1.5px solid var(--shu);border-radius:3px;padding:.35rem .15rem;line-height:1;opacity:.92;transform:rotate(-2deg)}
.ht-hm-dl{display:grid;gap:.08rem;font-size:.66rem;line-height:1.6;color:var(--ink)}
.ht-hm-dl div{display:flex;gap:.4rem}
.ht-hm-dl dt{font-family:var(--ff-serif);color:var(--shu);font-weight:600}
.ht-hm-dl dd{margin:0}
.ht-hm-note{display:none}
.ht-hm-foot,.ht-mk-foot{display:flex;justify-content:flex-end;align-items:center;gap:.35rem;font-family:var(--ff-serif);font-size:.68rem;font-weight:600;letter-spacing:.1em;color:var(--ink2)}
.ht-hm-foot{border-top:1px dashed rgba(45,36,51,.2);padding-top:.4rem}
.ht-hm-foot span,.ht-mk-foot span{color:var(--shu)}
.ht-mk{display:flex;border-radius:3px;background:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='180' height='180'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 .32 0 0 0 0 .25 0 0 0 0 .16 0 0 0 .11 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>"), url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='260' height='260'><filter id='f'><feTurbulence type='fractalNoise' baseFrequency='.012 .09' numOctaves='3' seed='4'/><feColorMatrix values='0 0 0 0 .55 0 0 0 0 .45 0 0 0 0 .3 0 0 0 .07 0'/></filter><rect width='100%' height='100%' filter='url(%23f)'/></svg>"),linear-gradient(90deg,#e9e0cb,#e0d5bd 57%,#d6caae 58.5%,#e2d8c1 60%,#ddd2b9)}
.ht-mk-band{flex:0 0 38px;display:flex;flex-direction:column;align-items:center;justify-content:space-between;padding:.75rem 0 .6rem;background:linear-gradient(180deg,#3a2950,#2b1f3d);color:#e8d48a;border-radius:3px 0 0 3px}
.ht-mk-v{writing-mode:vertical-rl;font-family:var(--ff-serif);font-size:.74rem;font-weight:600;letter-spacing:.22em}
.ht-mk-no{writing-mode:vertical-rl;font-family:var(--ff-serif);font-size:.6rem;letter-spacing:.12em;color:rgba(232,212,138,.7);border-top:1px solid rgba(232,212,138,.35);padding-top:.35rem}
.ht-mk-body{flex:1;display:flex;flex-direction:column;padding:.85rem 1rem .7rem 1rem}
.ht-mk-tag{align-self:flex-start;font-size:.6rem;letter-spacing:.12em;color:var(--ink2);border-bottom:1px solid rgba(168,67,47,.5);padding-bottom:.05rem;margin-bottom:.45rem}
.ht-tcy{text-combine-upright:all}
.ht-mk-q{word-break:auto-phrase;text-wrap:balance;flex:1;font-family:var(--ff-serif);font-size:.98rem;font-weight:600;line-height:1.7;color:var(--ink);letter-spacing:.02em;margin:0 0 .4rem}
@media (max-width:639px){
 .hero-today{margin-bottom:1.3rem}
 .ht-head{gap:.6rem;margin-bottom:.6rem}
 .ht-head::before,.ht-head::after{flex-basis:22px}
 .ht-h{font-size:.84rem;letter-spacing:.18em}
 .ht-s{display:none}
 .ht-grid{gap:.7rem;grid-template-columns:.9fr 1.1fr}
 .ht-hm{padding:.75rem .7rem .55rem}
 .ht-hm-top{font-size:.56rem;letter-spacing:.06em}
 .ht-hm-top span:first-child{display:none}
 .ht-hm-note{display:block;font-size:.62rem;color:var(--ink2);letter-spacing:.02em;padding:.1rem 0 .35rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
 .ht-hm-body{gap:.55rem}
 .ht-hm-side{flex:0 0 auto}
 .ht-hm-body{gap:.4rem;padding:.3rem 0 .25rem}
 .ht-hm-day{font-size:2.5rem}
 .ht-hm-side{gap:.4rem}
 .ht-hm-stamp{font-size:.78rem;padding:.3rem .1rem}
 .ht-hm-dl{display:none}
 .ht-hm-side{justify-content:flex-start}
 .ht-hm-foot,.ht-mk-foot{font-size:.6rem;letter-spacing:.04em}
 .ht-mk-band{flex-basis:28px;padding:.6rem 0 .5rem}
 .ht-mk-v{font-size:.64rem;letter-spacing:.14em}
 .ht-mk-body{padding:.65rem .55rem .55rem}
 .ht-mk-tag{font-size:.6rem;margin-bottom:.3rem}
 .ht-mk-q{font-size:.74rem;line-height:1.6}
 .hero-sub{font-size:.8rem;letter-spacing:.04em}
}

.btn-gold {
  padding: .78rem 2rem;
  background: linear-gradient(135deg, var(--gold), var(--gold-lt));
  border: none; border-radius: 28px; color: var(--void);
  font-family: var(--ff-serif); font-size: .9rem; font-weight: 700; letter-spacing: .1em;
  text-decoration: none; display: inline-block;
  box-shadow: 0 4px 24px rgba(201,168,76,.45);
  transition: opacity .2s, transform .15s;
}
.btn-gold:hover { opacity: .88; transform: translateY(-2px); }
/* ── Hero 2カラム（2026-11-14）：左＝三星統合鑑定、右＝「いま、知りたいことは」。DESIGN.md「Hero 右側メニュー」 ── */
.hero-main { display: grid; grid-template-columns: minmax(0,68fr) 40px minmax(0,32fr); align-items: center; max-width: 1040px; margin: 0 auto 1.4rem; text-align: left; }
.hero-main .hero-flagship-card { max-width: none; margin: 0; text-align: center; }
.hero-main-rule { align-self: stretch; position: relative; display: flex; align-items: center; justify-content: center; color: var(--gold); }
.hero-main-rule::before { content: ''; position: absolute; top: 6%; bottom: 6%; left: 50%; width: 1px; background: linear-gradient(180deg, transparent, rgba(201,168,76,.55) 20%, rgba(201,168,76,.55) 80%, transparent); }
.hero-main-rule svg { position: relative; width: 18px; height: 18px; background: var(--void); padding: 2px; box-sizing: content-box; }
.hn-head { display: flex; align-items: center; gap: .8rem; margin-bottom: .6rem; font-family: var(--ff-serif); font-size: .95rem; font-weight: 600; letter-spacing: .18em; color: var(--gold-lt); }
.hn-head::before, .hn-head::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, transparent, rgba(201,168,76,.55)); }
.hn-head::after { background: linear-gradient(270deg, transparent, rgba(201,168,76,.55)); }
.hn-list { list-style: none; margin: 0; padding: 0; border-top: 1px solid rgba(201,168,76,.35); }
.hn-list li { border-bottom: 1px solid rgba(201,168,76,.22); }
.hn-list a { display: flex; align-items: baseline; gap: .55rem; padding: .95rem .3rem .9rem .2rem; text-decoration: none; color: var(--text); transition: background .25s; }
.hn-q { font-family: var(--ff-serif); font-size: 1.04rem; font-weight: 600; letter-spacing: .08em; white-space: nowrap; transition: color .25s; }
.hn-dots { flex: 1; min-width: 1rem; border-bottom: 1px dotted rgba(201,168,76,.45); transform: translateY(-.3em); }
.hn-m { font-family: var(--ff-serif); font-size: .76rem; letter-spacing: .1em; color: rgba(201,168,76,.9); white-space: nowrap; }
.hn-chev { width: 6px; height: 10px; color: rgba(201,168,76,.8); align-self: center; transition: transform .25s; }
.hn-list a:hover, .hn-list a:focus-visible { background: linear-gradient(90deg, rgba(201,168,76,.08), transparent 85%); }
.hn-list a:hover .hn-q, .hn-list a:focus-visible .hn-q { color: var(--gold-lt); }
.hn-list a:hover .hn-chev, .hn-list a:focus-visible .hn-chev { transform: translateX(3px); }
.hn-more { position: relative; display: flex; align-items: center; justify-content: center; gap: .7rem; min-height: 46px; margin-top: 5px; padding-top: .35rem; text-decoration: none; color: var(--text-secondary); border-top: 1px solid rgba(201,168,76,.45); }
.hn-more::before { content: ''; position: absolute; left: 0; right: 0; top: -5px; height: 1px; background: rgba(201,168,76,.22); }
.hn-more-t { font-family: var(--ff-serif); font-size: .88rem; letter-spacing: .2em; transition: color .25s; }
.hn-down { width: 9px; height: 13px; color: var(--gold); transition: transform .25s; }
.hn-more:hover .hn-more-t, .hn-more:focus-visible .hn-more-t { color: var(--gold-lt); }
.hn-more:hover .hn-down, .hn-more:focus-visible .hn-down { transform: translateY(2px); }
@media (min-width: 861px) {
  .ht-grid { gap: 1.6rem; }
  .hero-today .ht-head::before, .hero-today .ht-head::after { flex: 1 1 auto; max-width: 300px; }
}
@media (max-width: 860px) {
  /* スマホ・タブレット：三星 → 今日のお楽しみ → 右側メニュー の順に縦に並べる */
  .hero-inner { display: flex; flex-direction: column; padding-bottom: .2rem; }
  .hero-main { display: contents; }
  .hero-main-card { order: 1; margin-bottom: 1.3rem; }
  .hero-main .hero-flagship-card { margin: 0 auto; max-width: 640px; width: 100%; }
  .hero-main-rule { display: none; }
  .hero-today { order: 2; width: 100%; max-width: 640px; }
  section.fortune-section { padding-top: 1.2rem; }
  .hero-nav { order: 3; width: 100%; max-width: 640px; margin: .2rem auto 0; text-align: left; }
  .hn-list { display: grid; grid-template-columns: 1fr 1fr; }
  .hn-list li:nth-child(odd) { border-right: 1px solid rgba(201,168,76,.22); }
  .hn-list a { flex-direction: column; align-items: flex-start; gap: .15rem; padding: .7rem .6rem .65rem .7rem; }
  .hn-dots, .hn-chev { display: none; }
  .hn-q { font-size: .92rem; letter-spacing: .04em; }
  .hn-m { font-size: .66rem; }
  .hn-m::after { content: ' で占う ›'; }
  .parallax-band { display: none; }
}


/* ══════════════════════════════════
   占いカードグリッド（カテゴリ別）
══════════════════════════════════ */
.fortune-section {
  padding: 1.6rem 0 3rem;
  background: var(--deep);
  /* v4: モックアップ由来のローカルトークン。.fortune-sectionにスコープし、グローバル:root(36行目付近)には追記しない */
  --fs-surface-a: hsl(258 28% 26%);
  --fs-surface-b: hsl(258 28% 32%);
  --fs-border: hsl(40 38% 40%);
  --fs-border-hover: hsl(42 45% 58%);
  --fs-gold-dim: hsl(42 32% 48%);
  --fs-r-card: 14px;
}
.fortune-section-head { margin-bottom: 1.6rem; }
/* 「迷ったら〜」との間隔（2026-11-14）：以前は .fortune-guide を margin-top:-1.3rem で引き上げていたが、間に自動広告が入ると広告に重なって文字が隠れるため、上の文の下の空きを詰める形に変更（2rem − 1.3rem = .7rem） */
.fortune-section-head .section-sub { margin-bottom: .7rem; }

/* ─── v4: レーン構成（占いを選ぶ） ─── */
.fs-lanes { max-width: 960px; margin: 0 auto; display: flex; flex-direction: column; gap: 2.6rem; }
.lane + .lane { border-top: 1px solid var(--fs-border); padding-top: 2rem; }
.lane-head { padding: 0 1.2rem; margin-bottom: 1rem; display: flex; flex-direction: column; gap: 4px; }
.lane-eyebrow { display: flex; align-items: baseline; gap: .6rem; }
.lane-num { font-family: var(--ff-mono); font-size: .62rem; color: var(--muted); letter-spacing: .06em; }
.lane-cat { font-family: var(--ff-sans); font-size: .62rem; color: var(--muted); letter-spacing: .1em; }
.lane-title { font-family: var(--ff-serif); font-weight: 700; font-size: 1.15rem; letter-spacing: .08em; color: var(--gold); }
.lane-tagline { font-size: .78rem; color: var(--text-secondary); }

/* ─── カード共通の質感・額縁（feature-card/crow/tile/dcard 4種共通） ─── */
.feature-card, .crow, .tile, .dcard { position: relative; text-decoration: none; color: inherit; transition: border-color .25s ease, transform .25s ease, box-shadow .25s ease; }
.feature-card, .tile, .dcard {
  background: linear-gradient(145deg, var(--fs-surface-b), var(--fs-surface-a));
  border: 1px solid var(--fs-border);
  box-shadow: inset 0 1px 0 0 rgba(255,255,255,.05), 0 4px 20px rgba(0,0,0,.4);
}
.feature-card:hover, .feature-card:focus-visible,
.tile:hover, .tile:focus-visible,
.dcard:hover, .dcard:focus-visible {
  border-color: var(--fs-border-hover); transform: translateY(-3px);
  box-shadow: inset 0 1px 0 0 rgba(255,255,255,.1), 0 12px 28px rgba(201,168,76,.15);
}
/* 四隅ノッチの額縁装飾（4種共通） */
.feature-card::before, .crow::before, .tile::before, .dcard::before {
  content: ''; position: absolute; inset: 5px; pointer-events: none;
  border: 1.5px solid hsl(45 75% 74% / .85); border-radius: calc(var(--fs-r-card) - 6px);
  background-repeat: no-repeat; background-size: 11px 11px, 11px 11px, 11px 11px, 11px 11px;
  background-image:
    url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'><circle cx='6' cy='6' r='5' fill='hsl(257,27%,30%)' stroke='hsl(45,75%,74%)' stroke-width='1.2'/></svg>"),
    url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'><circle cx='6' cy='6' r='5' fill='hsl(257,27%,30%)' stroke='hsl(45,75%,74%)' stroke-width='1.2'/></svg>"),
    url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'><circle cx='6' cy='6' r='5' fill='hsl(257,27%,30%)' stroke='hsl(45,75%,74%)' stroke-width='1.2'/></svg>"),
    url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'><circle cx='6' cy='6' r='5' fill='hsl(257,27%,30%)' stroke='hsl(45,75%,74%)' stroke-width='1.2'/></svg>");
  background-position: top -1px left -1px, top -1px right -1px, bottom -1px left -1px, bottom -1px right -1px;
}
.fs-ic { width: 1em; height: 1em; stroke: currentColor; stroke-width: 1.4; fill: none; stroke-linecap: round; stroke-linejoin: round; vertical-align: -.12em; }
.feature-cta { font-size: .8rem; color: var(--fs-gold-dim); display: inline-flex; align-items: center; gap: 6px; }

/* ─── レーン01：本格占い（フィーチャーカード＋随伴7件・4列dense grid） ─── */
.lane01-grid { padding: 0 1.2rem; display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-flow: row dense; gap: .75rem; }
.companions { display: contents; }
.feature-card {
  grid-column: span 2; grid-row: span 2;
  border-radius: var(--fs-r-card); padding: 1.5rem;
  display: flex; flex-direction: column; gap: .75rem;
}
.feature-card .ic-wrap { width: 44px; height: 44px; color: var(--gold); font-size: 26px; display: flex; align-items: center; justify-content: center; }
.feature-card .ic-wrap svg { filter: drop-shadow(0 0 5px hsl(42 70% 60% / .45)); }
.feature-card h3 { font-family: var(--ff-serif); font-weight: 700; font-size: 1.75rem; letter-spacing: .08em; color: var(--text); }
.feature-card p { font-size: .85rem; color: var(--text-secondary); line-height: 1.7; }
.feature-card .feature-cta { align-self: flex-start; margin-top: auto; }
/* 青海波風の余白装飾（デスクトップのみ。SPでは640行目付近のメディアクエリでcontent:noneにする） */
.feature-card::after {
  content: ''; position: absolute; inset: 9px; pointer-events: none; border-radius: calc(var(--fs-r-card) - 9px);
  background-repeat: repeat; background-size: 40px 20px;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 20'><path d='M0,20 A20,20 0 0,1 40,20' fill='none' stroke='%23c9a84c' stroke-width='1' opacity='0.5'/><path d='M6,20 A14,14 0 0,1 34,20' fill='none' stroke='%23c9a84c' stroke-width='1' opacity='0.5'/><path d='M12,20 A8,8 0 0,1 28,20' fill='none' stroke='%23c9a84c' stroke-width='1' opacity='0.5'/></svg>");
  -webkit-mask-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' preserveAspectRatio='none'><defs><linearGradient id='f' x1='0' y1='0' x2='1' y2='0'><stop offset='0%25' stop-color='white' stop-opacity='0'/><stop offset='65%25' stop-color='white' stop-opacity='1'/></linearGradient><linearGradient id='vt' x1='0' y1='0' x2='0' y2='1'><stop offset='0%25' stop-color='white' stop-opacity='1'/><stop offset='100%25' stop-color='white' stop-opacity='0'/></linearGradient><linearGradient id='vb' x1='0' y1='0' x2='0' y2='1'><stop offset='0%25' stop-color='white' stop-opacity='0'/><stop offset='100%25' stop-color='white' stop-opacity='1'/></linearGradient><mask id='mt'><rect x='0' y='0' width='100' height='34' fill='url(%23vt)'/></mask><mask id='mb'><rect x='0' y='66' width='100' height='34' fill='url(%23vb)'/></mask></defs><rect x='0' y='0' width='100' height='34' fill='url(%23f)' mask='url(%23mt)'/><rect x='0' y='66' width='100' height='34' fill='url(%23f)' mask='url(%23mb)'/></svg>");
  mask-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' preserveAspectRatio='none'><defs><linearGradient id='f' x1='0' y1='0' x2='1' y2='0'><stop offset='0%25' stop-color='white' stop-opacity='0'/><stop offset='65%25' stop-color='white' stop-opacity='1'/></linearGradient><linearGradient id='vt' x1='0' y1='0' x2='0' y2='1'><stop offset='0%25' stop-color='white' stop-opacity='1'/><stop offset='100%25' stop-color='white' stop-opacity='0'/></linearGradient><linearGradient id='vb' x1='0' y1='0' x2='0' y2='1'><stop offset='0%25' stop-color='white' stop-opacity='0'/><stop offset='100%25' stop-color='white' stop-opacity='1'/></linearGradient><mask id='mt'><rect x='0' y='0' width='100' height='34' fill='url(%23vt)'/></mask><mask id='mb'><rect x='0' y='66' width='100' height='34' fill='url(%23vb)'/></mask></defs><rect x='0' y='0' width='100' height='34' fill='url(%23f)' mask='url(%23mt)'/><rect x='0' y='66' width='100' height='34' fill='url(%23f)' mask='url(%23mb)'/></svg>");
  -webkit-mask-size: 100% 100%; mask-size: 100% 100%;
  -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat;
}
.crow {
  grid-column: span 1;
  padding: 1rem; border-radius: 10px;
  display: flex; align-items: center; gap: .8rem;
  background: hsl(258 24% 16%); border: 1px solid var(--fs-border); box-shadow: none;
}
.crow:hover, .crow:focus-visible { background: hsl(258 26% 20%); border-color: var(--fs-border-hover); box-shadow: none; }
.crow .ic-wrap { width: 60px; height: 60px; color: var(--fs-gold-dim); font-size: 40px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.crow-body { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 3px; }
.crow-body h4 { font-family: var(--ff-serif); font-weight: 700; font-size: .85rem; color: var(--text); }
.crow-body span { font-size: .81rem; color: var(--muted); }
.crow .feature-cta { font-size: .62rem; margin-top: 2px; }

@media (max-width: 639px) {
  .lane01-grid { display: block; padding: 0 1.2rem; }
  /* 左paddingでフローティングメニュー(.fmenu-btn 危険域 x≈25.6〜89.6px)との重なりを軽減。
     完全回避(.railの7rem)までは行わず、アイコン主要部・テキストが隠れない程度に留める。 */
  .companions { display: flex; flex-direction: column; gap: .5rem; padding-left: 4rem; }
  .feature-card { grid-column: unset; grid-row: unset; margin-bottom: .9rem; padding: 1.2rem; }
  .feature-card h3 { font-size: 1.15rem; }
  .feature-card::after { content: none; }
  .crow { grid-column: unset; padding: .7rem; background: linear-gradient(145deg, hsl(258 24% 18%), hsl(258 24% 14%)); border-color: transparent; }
  .crow:hover, .crow:focus-visible { border-color: var(--fs-border); }
}

/* ─── レーン02：カード・心理（タイル） ─── */
.tiles { padding: 0 1.2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; } /* 4タイル（2026-10-30、冒険の分かれ道 心理テストを追加）：3列だと4つ目が1枚だけ段落ちするため2×2 */
.tile { border-radius: 12px; padding: 1rem; display: flex; align-items: center; gap: 1rem; min-height: auto; }
.tile .ic-wrap { width: 64px; height: 64px; color: var(--gold); font-size: 43px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.tile-body { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 3px; }
.tile h4 { font-family: var(--ff-serif); font-weight: 700; font-size: .95rem; color: var(--text); margin-top: .5rem; }
.tile-body span { font-size: .84rem; color: var(--muted); line-height: 1.5; flex: 1; }
.tile .feature-cta { font-size: .69rem; margin-top: auto; }

@media (max-width: 639px) {
  .tiles { grid-template-columns: 1fr; gap: .75rem; }
}

/* ─── レーン03：気軽に楽しむ（レール） ─── */
.rail { padding: 0 1.2rem; display: grid; grid-template-columns: repeat(5, 1fr); gap: .75rem; }
.dcard { border-radius: 12px; padding: 1rem; display: flex; align-items: center; gap: .75rem; width: auto; }
.dcard .ic-wrap { width: 56px; height: 56px; color: var(--fs-gold-dim); font-size: 37px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.dcard-body { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 4px; }
.dcard h4 { font-family: var(--ff-serif); font-weight: 700; font-size: .8rem; color: var(--text); margin-bottom: .4rem; line-height: 1.4; }
.dcard .feature-cta { font-size: .69rem; }

@media (max-width: 639px) {
  .rail {
    display: flex;
    flex-wrap: nowrap;
    grid-template-columns: none;
    overflow-x: auto;
    overflow-y: visible;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    gap: .6rem;
    /* 左paddingでフローティングメニュー(.fmenu-btn 危険域 x≈13.6〜101.6px)を回避。
       scroll-padding-leftと同値の7rem(112px)を確保し、静止時(scrollLeft:0)・
       スナップ後のいずれでも1枚目カードの実座標が危険域より右(112px > 101.6px)になるようにする。
       この値は既存.fortune-gridと同一・変更禁止。 */
    padding: 2px 1.2rem 1rem 7rem;
    scroll-padding-left: 7rem;
    scrollbar-width: none;       /* Firefox */
    -ms-overflow-style: none;    /* IE/legacy Edge */
  }
  .rail::-webkit-scrollbar { display: none; } /* Chrome/Safari等WebKit系 */
  .dcard {
    flex: 0 0 auto;
    scroll-snap-align: start;
    width: clamp(170px, calc((100vw - 8.4rem) / 1.1), 230px);
  }
  /* レーン03見出しのみ左paddingでフローティングメニュー(.fmenu-btn 危険域 x≈25.6〜89.6px)との
     重なりを軽減。レーン01・02のlane-headには影響させないためnth-child(3)でスコープ。 */
  .lane:nth-child(3) .lane-head { padding-left: 6rem; }
}

/* カラーテーマ */
.ct-v  { --c1:#7a4a9e; --c2:#c85080; }
.ct-g  { --c1:#c9a84c; --c2:#7a4a9e; }
.ct-t  { --c1:#3ab8b0; --c2:#c9a84c; }
.ct-r  { --c1:#c85080; --c2:#7a4a9e; }
.ct-gn { --c1:#4a9c5a; --c2:#3ab8b0; }
.ct-i  { --c1:#4a3a9e; --c2:#7a4a9e; }
.ct-a  { --c1:#c9a84c; --c2:#c85080; }
.ct-c  { --c1:#3ab8b0; --c2:#4a3a9e; }
.ct-s  { --c1:#9e4a7a; --c2:#c9a84c; } /* 三星 */

/* ══════════════════════════════════
   今日の開運情報
══════════════════════════════════ */
.oracle-section {
  padding: 4rem 0;
  background: linear-gradient(180deg, var(--deep) 0%, var(--surface) 100%);
}
.oracle-card {
  max-width: 820px; margin: 0 auto;
  background: var(--card);
  border: 1px solid var(--border2);
  border-radius: 16px;
  padding: 1.8rem;
  position: relative; overflow: hidden;
  box-shadow: 0 6px 32px rgba(0,0,0,.35);
}
.oracle-card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-dk));
}
.oracle-date { font-family: var(--ff-mono); font-size: .62rem; color: var(--muted); letter-spacing: .12em; margin-bottom: 1.2rem; }
.oracle-grid { display: grid; grid-template-columns: auto 1fr; gap: 1.4rem; align-items: start; }
@media (max-width: 520px) { .oracle-grid { grid-template-columns: 1fr; } }

.rokuyo-box { text-align: center; padding: .9rem 1.1rem; border: 2px solid var(--gold); border-radius: 10px; background: rgba(201,168,76,.07); min-width: 75px; }
.rokuyo-name { font-family: var(--ff-serif); font-size: 1.75rem; font-weight: 700; color: var(--gold); line-height: 1; }
.rokuyo-en   { font-family: var(--ff-mono); font-size: .48rem; letter-spacing: .12em; color: var(--muted); margin-top: .4rem; }

.oracle-desc { font-size: .85rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: .8rem; }
.oracle-msg { font-family: var(--ff-serif); font-size: .86rem; color: var(--gold-lt); font-style: italic; line-height: 1.7; padding: .55rem .85rem; border-left: 2px solid var(--gold); background: rgba(201,168,76,.05); border-radius: 0 6px 6px 0; margin-bottom: .9rem; }
.oracle-chips { display: flex; flex-wrap: wrap; gap: .4rem; padding-top: .8rem; border-top: 1px solid var(--border); }
.ochip { display: flex; align-items: center; gap: .3rem; background: rgba(155,114,239,.08); border: 1px solid rgba(155,114,239,.2); border-radius: 20px; padding: .2rem .65rem; font-size: .7rem; color: var(--violet-lt); }
.ochip-l { font-family: var(--ff-mono); font-size: .53rem; color: var(--muted); letter-spacing: .08em; }
.oracle-more { display: flex; justify-content: flex-end; margin-top: .8rem; }
.oracle-more a { font-family: var(--ff-mono); font-size: .65rem; letter-spacing: .1em; color: var(--muted); text-decoration: none; border: 1px solid var(--border); border-radius: 20px; padding: .28rem .85rem; transition: color .2s, border-color .2s; }
.oracle-more a:hover { color: var(--gold-lt); border-color: rgba(201,168,76,.4); }

/* ══════════════════════════════════
   解説ガイド
══════════════════════════════════ */
.guide-section { padding: 4rem 0; background: var(--deep); }
.guide-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: .85rem; margin-top: 1.4rem;
}
@media (max-width: 640px) { .guide-grid { grid-template-columns: repeat(2, 1fr); gap: .65rem; } }
@media (max-width: 380px) { .guide-grid { grid-template-columns: 1fr; } }

.gcard {
  /* Stage3案B：占い解説ガイド固有の改修。角丸14px・背景グラデーションはTOP「占いを選ぶ」の
     Global Design Principle（新規トークンを追加せず既存の--card/--card2を使う）を抽出したもの。
     四隅ノッチ・HSL surface gradient・レーン構造・.btn-goldは意図的に導入しない。 */
  background: linear-gradient(145deg, var(--card2), var(--card));
  border: 1px solid var(--border);
  border-radius: 14px; padding: 1.1rem 1rem .95rem;
  display: flex; flex-direction: column; gap: .42rem;
  position: relative; overflow: hidden;
  transition: border-color .2s, transform .25s, box-shadow .25s;
  text-decoration: none; color: inherit;
}
.gcard::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--c1), var(--c2)); }
.gcard:hover {
  border-color: var(--border2);
  transform: translateY(-3px);
  box-shadow: 0 10px 22px rgba(0,0,0,.26);
}
.gc-icon {
  width: 36px; height: 36px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.15rem; line-height: 1;
  background: var(--card2); border: 1px solid var(--border);
  margin-bottom: .1rem;
}
.gc-lbl { font-family: var(--ff-mono); font-size: .52rem; letter-spacing: .18em; color: var(--muted); text-transform: uppercase; }
.gc-name { font-family: var(--ff-serif); font-size: .88rem; font-weight: 700; color: var(--text); }
.gc-desc { font-size: .74rem; color: var(--text-secondary); line-height: 1.65; letter-spacing: .01em; flex: 1; }
@media (max-width: 640px) { .gc-desc { display: none; } }
.gc-link { font-family: var(--ff-mono); font-size: .63rem; color: var(--gold); letter-spacing: .06em; margin-top: .15rem; }
.guide-more { display: flex; justify-content: center; margin-top: 1.5rem; }
.guide-more a { font-family: var(--ff-mono); font-size: .72rem; letter-spacing: .12em; color: var(--muted); text-decoration: none; border: 1px solid var(--border2); border-radius: 24px; padding: .48rem 1.5rem; transition: color .2s, border-color .2s; }
.guide-more a:hover { color: var(--gold-lt); border-color: rgba(201,168,76,.4); }

/* ══════════════════════════════════
   FOOTER
══════════════════════════════════ */
footer { background: var(--void); padding: 2rem 1.2rem; text-align: center; }
.footer-line { height: 1px; background: linear-gradient(90deg, transparent, rgba(201,168,76,.45) 30%, rgba(201,168,76,.75) 50%, rgba(201,168,76,.45) 70%, transparent); margin-bottom: 1.5rem; }
.footer-links { display: flex; justify-content: center; flex-wrap: wrap; gap: 1.2rem; margin-bottom: 1rem; }
.footer-links a { font-family: var(--ff-mono); font-size: .63rem; letter-spacing: .1em; color: var(--muted); text-decoration: none; transition: color .2s; }
.closing-cta { padding: 3rem 1.2rem; text-align: center; }
.closing-cta-title { font-family: var(--ff-serif); font-size: clamp(1.1rem, 2.8vw, 1.4rem); font-weight: 700; color: var(--text); letter-spacing: .08em; margin-bottom: .6rem; }
.closing-cta-sub { font-size: .8rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem; }
.footer-links a:hover { color: var(--gold-lt); }
.footer-copy { font-family: var(--ff-mono); font-size: .58rem; color: rgba(138,125,181,.3); letter-spacing: .1em; }
</style>
</head>
<body>

<?php $currentPage = 'top'; require __DIR__.'/inc/header.php'; ?>

<!-- ══ HERO ══ -->
<section class="hero">
  <canvas id="canvas-stars"></canvas>
  <div class="hero-top-accent"></div>

  <div class="hero-inner">
    <span class="hero-eyebrow h-d1"><?= htmlspecialchars(TOP_EYEBROW, ENT_QUOTES) ?></span>
    <div class="hero-deco h-d2"><span>✦ ── ✦ ── ✦</span></div>
    <h1 class="hero-h1 h-d3"><?= TOP_H1_HTML ?></h1>
    <span class="hero-sub h-d4">星と運命の交差点 · さまざまな占術で今を読み解く</span>
    <div class="hero-main h-d5">
    <div class="hero-main-card">
    <div class="hero-flagship-card">
      <span class="hf-frame" aria-hidden="true"><?php for ($_i = 0; $_i < 4; $_i++): ?><svg class="hf-orn" viewBox="0 0 40 40"><path d="M1 22V1h21" fill="none" stroke="currentColor" stroke-width="1"/><path d="M5 14V5h9" fill="none" stroke="currentColor" stroke-width=".7" opacity=".7"/><path d="M5 1.5 6.6 3 5 4.5 3.4 3z" fill="currentColor"/></svg><?php endfor; ?></span>
      <div class="hf-crest">
        <span class="hf-rule">Flagship</span>
        <img class="hf-emblem" src="/img/hero/hero-astrolabe.webp" alt="" width="88" height="88">
        <span class="hf-rule">Reading</span>
      </div>
      <div class="hf-title">三星統合鑑定</div>
      <div class="hf-methods">
        <span><img src="/img/hero/seiza-medallion.webp" alt="" width="20" height="20">西洋占星術</span><i></i>
        <span><img src="/img/hero/tarot-medallion.webp" alt="" width="20" height="20">タロット</span><i></i>
        <span><img src="/img/hero/shichu-medallion.webp" alt="" width="20" height="20">四柱推命</span>
      </div>
      <p class="hf-desc">性格・恋愛・仕事・これからの流れを、<br class="hf-sp">3つの占術を重ねて読み解きます。</p>
      <a href="/sansei" class="btn-gold hf-btn" data-ga-event="cta_click" data-cta-name="hero_flagship_sansei" data-cta-destination="/sansei">三星統合鑑定をはじめる <span>→</span></a>
      <div class="hf-trust">名前と生年月日だけ<b></b>約3分<b></b>登録不要</div>
    </div>
    </div>
    <div class="hero-main-rule" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 0C12.8 7.6 15.6 11 24 12 15.6 13 12.8 16.4 12 24 11.2 16.4 8.4 13 0 12 8.4 11 11.2 7.6 12 0Z" fill="currentColor"/></svg></div>
    <nav class="hero-nav" aria-label="知りたいことから選ぶ">
      <div class="hn-head"><span>いま、知りたいことは</span></div>
      <ul class="hn-list">
      <?php
      // 4つの主要占術：知りたいことを見出しに、占術名を添える（2026-11-14）。URLは$_NAV_PAGES（inc/nav-cards.php）を単一の情報源として使う。
      // 言葉は各ページの中身に合わせている（タロット＝いまの迷いへのメッセージ／西洋占星術＝内面／四柱推命＝大運／算命学＝元命・主星）
      $_heroNav = [
        'tarot'  => ['いまの迷いへの答え', 'タロット'],
        'seiza'  => ['本当の自分の性格', '西洋占星術'],
        'shichu' => ['人生の流れと転機', '四柱推命'],
        'sanmei' => ['生まれ持った才能', '算命学'],
      ];
      foreach ($_heroNav as $_slugKey => [$_q, $_m]):
        $_url = $_NAV_PAGES[$_slugKey]['url'];
      ?>
        <li><a href="<?= htmlspecialchars($_url, ENT_QUOTES, 'UTF-8') ?>" data-ga-event="cta_click" data-cta-name="hero_nav_<?= $_slugKey ?>" data-cta-destination="<?= htmlspecialchars($_url, ENT_QUOTES, 'UTF-8') ?>"><span class="hn-q"><?= htmlspecialchars($_q, ENT_QUOTES, 'UTF-8') ?></span><span class="hn-dots" aria-hidden="true"></span><span class="hn-m"><?= htmlspecialchars($_m, ENT_QUOTES, 'UTF-8') ?></span><svg class="hn-chev" viewBox="0 0 10 16" aria-hidden="true"><path d="M2 2l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.3"/></svg></a></li>
      <?php endforeach; ?>
      </ul>
      <a class="hn-more" href="#fortunes" data-ga-event="cta_click" data-cta-name="hero_browse_fortunes" data-cta-destination="#fortunes"><span class="hn-more-t">他の占いを見る</span><svg class="hn-down" viewBox="0 0 10 14" aria-hidden="true"><path d="M5 1v11M1.5 8.5 5 12l3.5-3.5" fill="none" stroke="currentColor" stroke-width="1.2"/></svg></a>
    </nav>
    </div>
    <div class="hero-today h-d6">
      <div class="ht-head"><span class="ht-h">今日のお楽しみ</span><span class="ht-s">暦と4択、毎日ひとつずつ</span></div>
      <div class="ht-grid">
        <a class="ht-item ht-cal" href="/calendar" data-ga-event="cta_click" data-cta-name="hero_today_calendar" data-cta-destination="/calendar">
          <div class="ht-paper ht-hm">
            <div class="ht-hm-top"><span><?= $today->format('Y') ?></span><span><?= $_htMonth ?></span><span><?= $_htWeekday ?></span></div>
            <div class="ht-hm-body">
              <div class="ht-hm-day"><?= $today->format('j') ?></div>
              <div class="ht-hm-side">
                <span class="ht-hm-stamp"><?= htmlspecialchars($_htRokuyo, ENT_QUOTES, 'UTF-8') ?></span>
                <dl class="ht-hm-dl"><?php foreach ($_htRows as [$_dt, $_dd]): ?><div><dt><?= $_dt ?></dt><dd><?= htmlspecialchars($_dd, ENT_QUOTES, 'UTF-8') ?></dd></div><?php endforeach; ?></dl>
              </div>
            </div>
            <div class="ht-hm-note"><?= htmlspecialchars($_htNote, ENT_QUOTES, 'UTF-8') ?></div>
            <div class="ht-hm-foot">開運カレンダーをめくる<span>→</span></div>
          </div>
        </a>
<?php if ($_htQuiz !== null): ?>
        <a class="ht-item ht-quiz" href="/quiz/<?= htmlspecialchars($_htQuiz['slug'], ENT_QUOTES, 'UTF-8') ?>/" data-ga-event="cta_click" data-cta-name="hero_today_quiz" data-cta-destination="/quiz/<?= htmlspecialchars($_htQuiz['slug'], ENT_QUOTES, 'UTF-8') ?>/">
          <div class="ht-paper ht-mk">
            <div class="ht-mk-band"><span class="ht-mk-v">今日の<span class="ht-tcy">4</span>択</span><span class="ht-mk-no">第<?= ht_kanji_num((int)$_htQuiz['number']) ?>番</span></div>
            <div class="ht-mk-body">
              <span class="ht-mk-tag"><?= htmlspecialchars($_htQuizTag, ENT_QUOTES, 'UTF-8') ?></span>
              <p class="ht-mk-q"><?= htmlspecialchars($_htQuiz['question'], ENT_QUOTES, 'UTF-8') ?></p>
              <div class="ht-mk-foot">四つの中から選ぶ<span>→</span></div>
            </div>
          </div>
        </a>
<?php endif; ?>
      </div>
    </div>
  </div>
</section>

<div class="parallax-band">
  <div class="pb-content">
    <div class="pb-gold-line"></div>
    <div class="pb-gold-line"></div>
  </div>
</div>

<!-- ══ 占いカードグリッド（カテゴリ別） ══ -->
<section class="fortune-section" id="fortunes">
  <div class="wrap fortune-section-head">
    <span class="section-label">Choose Your Fortune</span>
    <h2 class="section-title">占いを選ぶ</h2>
    <p class="section-sub">さまざまな占術から、今のあなたに合ったものを</p>
    <p class="fortune-guide">迷ったら、まずは三星統合鑑定から。名前と生年月日だけで3つの占術を同時に鑑定します。</p>
  </div>

  <?php
  // v4: 「占いを選ぶ」3レーン構成。URL・名称は$_NAV_PAGES（inc/nav-cards.php）を単一の情報源として使用。
  // アイコンはモックアップのSVG意匠をそのまま使用（$_NAV_PAGESのicon絵文字フィールドはこのレーン内では使わない）。
  $_fsIcons = [
    'shichu'     => '<path d="M6 3v18M10 6v15M14 4v17M18 7v14"/>',
    'sansei'     => '<g transform="translate(2,1) scale(0.34)"><path d="M12 2l2.2 6.8H21l-5.6 4.2 2.2 6.8L12 15.6 6.4 19.8l2.2-6.8L3 8.8h6.8z"/></g><g transform="translate(10,0) scale(0.26)"><path d="M12 2l2.2 6.8H21l-5.6 4.2 2.2 6.8L12 15.6 6.4 19.8l2.2-6.8L3 8.8h6.8z"/></g><g transform="translate(9,13) scale(0.2)"><path d="M12 2l2.2 6.8H21l-5.6 4.2 2.2 6.8L12 15.6 6.4 19.8l2.2-6.8L3 8.8h6.8z"/></g>',
    'sanmei'     => '<path d="M12 3a9 9 0 000 18 4.5 4.5 0 010-9 4.5 4.5 0 000-9z"/><circle cx="12" cy="7.5" r="1"/><circle cx="12" cy="16.5" r="1"/>',
    'seiza'      => '<circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3M6 6l2 2M16 16l2 2M6 18l2-2M16 8l2-2"/>',
    'tarot'      => '<rect x="4" y="3" width="7" height="11" rx="1"/><rect x="13" y="6" width="7" height="15" rx="1"/>',
    'kyusei'     => '<circle cx="12" cy="12" r="8.5"/><path d="M12 3.5v3M12 17.5v3M3.5 12h3M17.5 12h3"/>',
    'numerology' => '<path d="M12 2v20M7 6h3M7 10h3M7 14h3M7 18h3M14 6h3M14 10h3M14 14h3M14 18h3"/>',
    'seimei'     => '<path d="M4 18c3-2 7-9 11-13"/><rect x="14" y="13" width="7" height="7" rx="1"/><path d="M16.2 16.5h2.6M16.2 18.5h2.6"/>',
    'mbti'       => '<rect x="4" y="4" width="16" height="16" rx="3"/><path d="M4 10h16M10 10v10"/>',
    'love'       => '<path d="M12 21c-4-3-8-6.5-8-11a5 5 0 019-3 5 5 0 019 3c0 4.5-4 8-8 11z"/>',
    'aisho'      => '<circle cx="9" cy="12" r="6.5"/><circle cx="15" cy="12" r="6.5"/>',
    'rpg'        => '<path d="M4 11l8-6 8 6M6 11v9h12v-9M10 20v-5h4v5"/>',
    'reversi'    => '<circle cx="9" cy="12" r="5" fill="currentColor" stroke="none"/><circle cx="15" cy="12" r="5"/>',
    'adventure-quiz' => '<circle cx="12" cy="12" r="9"/><path d="M15.5 8.5l-2 5-5 2 2-5z"/>',
    'zense'      => '<path d="M18 6a8 8 0 10-1.5 12.5"/><path d="M15 19.8l1.7-2.3 2.6 1.2"/>',
    'guardian'   => '<path d="M12 3c3 3 5 6 5 9a5 5 0 01-10 0c0-3 2-6 5-9z"/>',
    'geimei'     => '<path d="M4 20l3-1 10-10-2-2L5 17z"/><circle cx="18" cy="6" r="1"/>',
  ];

  // レーン01：本格占い（feature=四柱推命、companions=随伴7件）
  $_lane1FeatureSlug = 'shichu';
  $_lane1FeatureDesc = '生年月日を四本の柱に見立て、命式と大運から人生の流れを読み解く、東洋占術の王道。';
  $_lane1Companions = [
    ['slug'=>'sansei',     'sub'=>'三占術を同時に鑑定'],
    ['slug'=>'sanmei',     'sub'=>'陰陽五行で才能を読む'],
    ['slug'=>'seiza',      'sub'=>'太陽星座×内面タイプ'],
    ['slug'=>'tarot',      'sub'=>'1枚引いて今日を読む'],
    ['slug'=>'kyusei',     'sub'=>'吉方位と運気の周期'],
    ['slug'=>'numerology', 'sub'=>'数字が示す性格と運命'],
    ['slug'=>'seimei',     'sub'=>'画数に宿る性格と流れ'],
  ];

  // レーン02：カード・心理
  $_lane2Tiles = [
    ['slug'=>'mbti',  'sub'=>'性格タイプと星座を掛け合わせて診断'],
    ['slug'=>'love',  'sub'=>'あなたの恋のクセを丁寧にひもとく'],
    ['slug'=>'aisho', 'sub'=>'ふたりの生年月日から相性を読む'],
    ['slug'=>'adventure-quiz', 'sub'=>'12の場面の選び方から、性格の傾向を見る'],
  ];

  // レーン03：気軽に楽しむ
  $_lane3Cards = [
    ['slug'=>'rpg',      'cta'=>'遊ぶ →'],
    ['slug'=>'reversi',  'cta'=>'対局 →'],
    ['slug'=>'zense',    'cta'=>'診断 →'],
    ['slug'=>'guardian', 'cta'=>'診断 →'],
    ['slug'=>'geimei',   'cta'=>'診断 →'],
  ];
  ?>

  <div class="fs-lanes">

    <!-- レーン01：本格占い -->
    <div class="lane">
      <div class="lane-head">
        <div class="lane-eyebrow"><span class="lane-num">01</span><span class="lane-cat">本格占い</span></div>
        <span class="lane-title">じっくり向き合う</span>
        <span class="lane-tagline">生年月日から、命の設計図を読み解く。</span>
      </div>
      <div class="lane01-grid">
        <?php $_fp = $_NAV_PAGES[$_lane1FeatureSlug]; ?>
        <a href="<?= htmlspecialchars($_fp['url'], ENT_QUOTES, 'UTF-8') ?>" class="feature-card fade-up">
          <div class="ic-wrap"><svg class="fs-ic" viewBox="0 0 24 24" aria-hidden="true"><?= $_fsIcons[$_lane1FeatureSlug] ?></svg></div>
          <h3><?= htmlspecialchars($_fp['name'], ENT_QUOTES, 'UTF-8') ?></h3>
          <p><?= htmlspecialchars($_lane1FeatureDesc, ENT_QUOTES, 'UTF-8') ?></p>
          <span class="feature-cta">占ってみる →</span>
        </a>
        <div class="companions">
          <?php foreach ($_lane1Companions as $_c): $_p = $_NAV_PAGES[$_c['slug']]; ?>
          <a href="<?= htmlspecialchars($_p['url'], ENT_QUOTES, 'UTF-8') ?>" class="crow fade-up">
            <div class="ic-wrap"><svg class="fs-ic" viewBox="0 0 24 24" aria-hidden="true"><?= $_fsIcons[$_c['slug']] ?></svg></div>
            <div class="crow-body">
              <h4><?= htmlspecialchars($_p['name'], ENT_QUOTES, 'UTF-8') ?></h4>
              <span><?= htmlspecialchars($_c['sub'], ENT_QUOTES, 'UTF-8') ?></span>
              <span class="feature-cta">開く →</span>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- レーン02：カード・心理 -->
    <div class="lane">
      <div class="lane-head">
        <div class="lane-eyebrow"><span class="lane-num">02</span><span class="lane-cat">カード・心理</span></div>
        <span class="lane-title">遊びながら知る</span>
        <span class="lane-tagline">診断を通して、自分の傾向に気づく。</span>
      </div>
      <div class="tiles">
        <?php foreach ($_lane2Tiles as $_t): $_p = $_NAV_PAGES[$_t['slug']]; ?>
        <a href="<?= htmlspecialchars($_p['url'], ENT_QUOTES, 'UTF-8') ?>" class="tile fade-up">
          <div class="ic-wrap"><svg class="fs-ic" viewBox="0 0 24 24" aria-hidden="true"><?= $_fsIcons[$_t['slug']] ?></svg></div>
          <div class="tile-body">
            <h4><?= htmlspecialchars($_p['name'], ENT_QUOTES, 'UTF-8') ?></h4>
            <span><?= htmlspecialchars($_t['sub'], ENT_QUOTES, 'UTF-8') ?></span>
            <span class="feature-cta">診断 →</span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- レーン03：気軽に楽しむ -->
    <div class="lane">
      <div class="lane-head">
        <div class="lane-eyebrow"><span class="lane-num">03</span><span class="lane-cat">気軽に楽しむ</span></div>
        <span class="lane-title">肩の力を抜いて</span>
        <span class="lane-tagline">ひと息つく、軽やかな占い時間。</span>
      </div>
      <div class="rail">
        <?php foreach ($_lane3Cards as $_d): $_p = $_NAV_PAGES[$_d['slug']]; ?>
        <a href="<?= htmlspecialchars($_p['url'], ENT_QUOTES, 'UTF-8') ?>" class="dcard fade-up">
          <div class="ic-wrap"><svg class="fs-ic" viewBox="0 0 24 24" aria-hidden="true"><?= $_fsIcons[$_d['slug']] ?></svg></div>
          <div class="dcard-body">
            <h4><?= htmlspecialchars($_p['name'], ENT_QUOTES, 'UTF-8') ?></h4>
            <span class="feature-cta"><?= htmlspecialchars($_d['cta'], ENT_QUOTES, 'UTF-8') ?></span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<div class="parallax-band">
  <div class="pb-content">
    <div class="pb-gold-line"></div>
    <span class="pb-kamon">✦ ── 🌙 ── ✦</span>
    <div class="pb-gold-line"></div>
  </div>
</div>

<!-- ══ 今日の開運情報 ══ -->
<section class="oracle-section" id="oracle">
  <div class="wrap">
    <span class="section-label">Daily Oracle</span>
    <h2 class="section-title">今日の開運情報</h2>
    <p class="section-sub">六曜・ラッキーアイテム・今日のメッセージ</p>

    <div class="oracle-card fade-up">
      <div class="oracle-date"><?= htmlspecialchars($oracleDateLabel, ENT_QUOTES, 'UTF-8') ?></div>
      <div class="oracle-grid">
        <div class="rokuyo-box">
          <div class="rokuyo-name"><?= htmlspecialchars($rokuyo['name'], ENT_QUOTES, 'UTF-8') ?></div>
          <div class="rokuyo-en"><?= htmlspecialchars(strtoupper($rokuyo['en']), ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <div>
          <p class="oracle-desc"><?= htmlspecialchars($rokuyo['desc'], ENT_QUOTES, 'UTF-8') ?></p>
          <div class="oracle-msg">「<?= htmlspecialchars($luckyItems['message'], ENT_QUOTES, 'UTF-8') ?>」</div>
          <div class="oracle-chips">
            <div class="ochip"><span class="ochip-l">COLOR</span>&nbsp;<?= htmlspecialchars($luckyItems['color']['name'], ENT_QUOTES, 'UTF-8') ?></div>
            <div class="ochip"><span class="ochip-l">NO.</span>&nbsp;<?= (int)$luckyItems['number'] ?></div>
            <div class="ochip"><span class="ochip-l">FOOD</span>&nbsp;<?= htmlspecialchars(getLuckyItemByCat($luckyItems, '食べ物'), ENT_QUOTES, 'UTF-8') ?></div>
            <div class="ochip"><span class="ochip-l">ITEM</span>&nbsp;<?= htmlspecialchars(getLuckyItemByCat($luckyItems, 'アイテム'), ENT_QUOTES, 'UTF-8') ?></div>
            <div class="ochip"><span class="ochip-l">ACTION</span>&nbsp;<?= htmlspecialchars(getLuckyItemByCat($luckyItems, '行動'), ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="oracle-more"><a href="/calendar">詳しい開運カレンダーを見る →</a></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="parallax-band">
  <div class="pb-content">
    <div class="pb-gold-line"></div>
    <span class="pb-kamon">✦ ── ✨ ── ✦</span>
    <div class="pb-gold-line"></div>
  </div>
</div>

<!-- ══ 解説ガイド ══ -->
<section class="guide-section">
  <div class="wrap">
    <span class="section-label">Articles · Guide</span>
    <h2 class="section-title">占い解説ガイド</h2>
    <p class="section-sub">各占術の仕組み・歴史・読み方をわかりやすく解説</p>

    <div class="guide-grid">
      <a href="/articles/tarot/" class="gcard fade-up" style="--c1:#9b72ef;--c2:#c85080">
        <span class="gc-icon" aria-hidden="true">🃏</span>
        <span class="gc-lbl">Tarot</span>
        <div class="gc-name">タロット占いとは</div>
        <div class="gc-desc">22枚の意味・歴史・正位置逆位置の読み方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/shichu/" class="gcard fade-up" style="--c1:#c9a84c;--c2:#9b72ef">
        <span class="gc-icon" aria-hidden="true">🔯</span>
        <span class="gc-lbl">Shichu Suimei</span>
        <div class="gc-name">四柱推命とは</div>
        <div class="gc-desc">命式・十神・大運・天中殺の見方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/numerology/" class="gcard fade-up" style="--c1:#3ab8b0;--c2:#c9a84c">
        <span class="gc-icon" aria-hidden="true">🔢</span>
        <span class="gc-lbl">Numerology</span>
        <div class="gc-name">数秘術とは</div>
        <div class="gc-desc">ライフパスナンバーの計算方法と意味</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/mbti/" class="gcard fade-up" style="--c1:#c85080;--c2:#9b72ef">
        <span class="gc-icon" aria-hidden="true">🧠</span>
        <span class="gc-lbl">MBTI</span>
        <div class="gc-name">MBTIとは</div>
        <div class="gc-desc">16タイプの特徴と星座との組み合わせ</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/kyusei/" class="gcard fade-up" style="--c1:#9b72ef;--c2:#3ab8b0">
        <span class="gc-icon" aria-hidden="true">⭐</span>
        <span class="gc-lbl">Nine Star Ki</span>
        <div class="gc-name">九星気学とは</div>
        <div class="gc-desc">本命星・月命星と吉方位の求め方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/sanmei/" class="gcard fade-up" style="--c1:#c9a84c;--c2:#3ab8b0">
        <span class="gc-icon" aria-hidden="true">☯</span>
        <span class="gc-lbl">Sanmeigaku</span>
        <div class="gc-name">算命学とは</div>
        <div class="gc-desc">元命・主星・従星から才能と本質を読む</div>
        <span class="gc-link">解説を読む →</span>
      </a>
    </div>

    <div class="guide-more">
      <a href="/articles/">すべての解説を見る（全12カテゴリ）→</a>
    </div>
  </div>
</section>

<!-- ══ 締めのCTA（離脱防止・三星統合鑑定への導線強化） ══ -->
<section class="closing-cta">
  <div class="wrap">
    <h2 class="closing-cta-title">さあ、あなたの運命を占ってみましょう</h2>
    <p class="closing-cta-sub">名前と生年月日を入力するだけ。西洋占星術×タロット×四柱推命の三位一体鑑定 ✨三星統合鑑定</p>
    <a href="/sansei" class="btn-gold" data-ga-event="cta_click" data-cta-name="closing_sansei" data-cta-destination="/sansei">三星統合鑑定をはじめる →</a>
  </div>
</section>

<!-- ══ FOOTER（共通フッター：内部リンク構造を移植） ══ -->
<div class="parallax-band">
  <div class="pb-content">
    <div class="pb-gold-line"></div>
    <div class="pb-gold-line"></div>
  </div>
</div>
<?php $currentPage = 'top'; require __DIR__.'/inc/footer.php'; ?>

<script>
/* ══ Canvas 星空 ══ */
(function(){
  const cv = document.getElementById('canvas-stars');
  const cx = cv.getContext('2d');
  let W, H, stars = [], meteors = [], frame = 0;

  function resize(){
    W = cv.width  = cv.offsetWidth;
    H = cv.height = cv.offsetHeight;
    initStars();
  }
  function initStars(){
    stars = [];
    const n = Math.floor(W * H / 3000);
    for(let i = 0; i < n; i++){
      stars.push({ x: Math.random()*W, y: Math.random()*H,
        r: Math.random()*1.2+.2, a: Math.random(),
        sp: Math.random()*.005+.002, ph: Math.random()*Math.PI*2 });
    }
  }
  function spawnMeteor(){
    meteors.push({ x: Math.random()*W*1.5, y: Math.random()*H*.35,
      len: Math.random()*110+60, sp: Math.random()*5+4,
      a: 1, ang: Math.PI/5 });
  }
  function draw(){
    cx.clearRect(0, 0, W, H);
    const t = Date.now()*.001;
    stars.forEach(s => {
      const al = s.a*(.45+.55*Math.sin(t*s.sp*6+s.ph));
      cx.beginPath();
      cx.arc(s.x, s.y, s.r, 0, Math.PI*2);
      cx.fillStyle = `rgba(220,210,255,${al})`;
      cx.fill();
    });
    meteors = meteors.filter(m => m.a > 0);
    meteors.forEach(m => {
      const dx = Math.cos(m.ang)*m.len, dy = Math.sin(m.ang)*m.len;
      const g = cx.createLinearGradient(m.x, m.y, m.x-dx, m.y-dy);
      g.addColorStop(0, `rgba(201,168,76,${m.a})`);
      g.addColorStop(1, 'rgba(201,168,76,0)');
      cx.beginPath(); cx.moveTo(m.x, m.y); cx.lineTo(m.x-dx, m.y-dy);
      cx.strokeStyle = g; cx.lineWidth = 1.5; cx.stroke();
      m.x += Math.cos(m.ang)*m.sp; m.y += Math.sin(m.ang)*m.sp; m.a -= .014;
    });
    if(++frame % 240 === 0) spawnMeteor();
    requestAnimationFrame(draw);
  }
  window.addEventListener('resize', resize);
  resize(); draw();
  setTimeout(spawnMeteor, 1800);
})();

/* ══ IntersectionObserver ══ */
const io = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: .12 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));

/* ══ カテゴリタブ scroll-spy（SPの横スクロール棚と連動。表示上の効果はSP用CSSのみで発火） ══ */
const fcCategories = document.querySelectorAll('.fortune-category');
const fcTabs = document.querySelectorAll('.fc-tab');
if (fcCategories.length && fcTabs.length) {
  const fcSpy = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const activeTab = document.querySelector('.fc-tab[href="#' + entry.target.id + '"]');
      if (!activeTab) return;
      fcTabs.forEach(t => t.classList.remove('fc-tab-active'));
      activeTab.classList.add('fc-tab-active');
    });
  }, { threshold: 0, rootMargin: '-40% 0px -55% 0px' });
  fcCategories.forEach(el => fcSpy.observe(el));
}
</script>
</body>
</html>
