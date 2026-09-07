<?php
declare(strict_types=1);
require_once __DIR__.'/inc/nav-cards.php';
require_once __DIR__.'/inc/oracle.php';

$today      = new DateTimeImmutable();
$todayStr   = $today->format('Y-m-d');
$rokuyo     = getRokuyo((int)$today->format('Y'), (int)$today->format('n'), (int)$today->format('j'));
$luckyItems = getLuckyItems($todayStr);

$weekdayJp = ['日','月','火','水','木','金','土'];
$oracleDateLabel = $today->format('Y年n月j日').'（'.$weekdayJp[(int)$today->format('w')].'）';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="タロット占い・数秘術・九星気学・相性診断・姓名判断など無料の占いが揃う占いポータル。生年月日や名前を入力するだけで鑑定結果をすぐに表示します。">
<title>無料占いポータル｜タロット・数秘術・九星気学・姓名判断</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
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
  font-size: .78rem;
  color: var(--gold-lt);
  text-align: center;
  letter-spacing: .02em;
  margin: -1.3rem auto 1.6rem;
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
  height: 64px;
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
   HEADER
══════════════════════════════════ */
.site-header {
  position: sticky; top: 0; z-index: 200;
  background: rgba(6,4,16,.94);
  backdrop-filter: blur(14px);
}
.header-inner {
  max-width: 960px; margin: 0 auto;
  padding: 0 1.4rem;
  display: flex; align-items: center; justify-content: space-between;
  height: 56px; gap: 1rem;
}
.logo {
  font-family: var(--ff-serif);
  font-size: 1.05rem; font-weight: 700;
  color: var(--text); text-decoration: none;
  display: flex; align-items: center; gap: .5rem;
  letter-spacing: .06em; white-space: nowrap;
}
.logo em { font-style: italic; color: var(--gold); }
.header-nav {
  display: flex; align-items: center; gap: 1.6rem;
}
.header-nav a {
  font-family: var(--ff-mono);
  font-size: .68rem; color: var(--muted);
  text-decoration: none; letter-spacing: .1em;
  white-space: nowrap;
  position: relative; padding-bottom: 2px;
  transition: color .2s;
}
.header-nav a::after {
  content: '';
  position: absolute; bottom: 0; left: 0; right: 0;
  height: 1px; background: var(--gold);
  transform: scaleX(0); transition: transform .2s;
}
.header-nav a:hover { color: var(--gold-lt); }
.header-nav a:hover::after, .header-nav a.cur::after { transform: scaleX(1); }
.header-nav a.cur { color: var(--gold); pointer-events: none; }
.sp-menu-btn {
  display: none;
  background: none; border: 1px solid var(--border2);
  border-radius: 6px; color: var(--muted);
  font-family: var(--ff-mono); font-size: .72rem;
  padding: .3rem .75rem; cursor: pointer;
}
.header-gold-line {
  height: 2px;
  background: linear-gradient(90deg,
    transparent 0%, rgba(201,168,76,.6) 30%,
    rgba(201,168,76,1) 50%, rgba(201,168,76,.6) 70%,
    transparent 100%);
}
.sp-dropdown {
  display: none; position: fixed; top: 58px; left: 0; right: 0;
  background: rgba(6,4,16,.97);
  border-bottom: 1px solid var(--border2);
  z-index: 199; backdrop-filter: blur(16px);
}
.sp-dropdown.open { display: block; }
.sp-dropdown a {
  display: block; padding: .85rem 1.4rem;
  font-family: var(--ff-mono); font-size: .78rem;
  color: var(--muted); text-decoration: none;
  border-bottom: 1px solid var(--border);
  transition: color .2s, background .2s;
}
.sp-dropdown a:hover { color: var(--gold-lt); background: rgba(201,168,76,.05); }

@media (max-width: 768px) {
  .header-nav { display: none; }
  .sp-menu-btn { display: flex; align-items: center; gap: .35rem; }
}

/* ══════════════════════════════════
   HERO
══════════════════════════════════ */
.hero {
  position: relative;
  min-height: 100svh;
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
  padding: 1.5rem 1.2rem 0;
  max-width: 680px;
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
  margin: 0 auto .9rem; max-width: 240px;
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
.hero-sub { font-size: .88rem; color: rgba(200,190,230,.5); letter-spacing: .1em; display: block; margin-bottom: 1.5rem; }
.hero-flagship-card {
  position: relative;
  max-width: 620px;
  margin: 0 auto 1.6rem;
  padding: 1.8rem 1.6rem 1.6rem;
  border: 1px solid rgba(201,168,76,.45);
  border-radius: 22px;
  background: linear-gradient(180deg, rgba(26,21,53,.55) 0%, rgba(18,15,36,.72) 100%);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  box-shadow: 0 0 0 1px rgba(201,168,76,.12) inset, 0 12px 40px rgba(0,0,0,.45);
}
.hf-eyebrow { display: block; font-family: var(--ff-mono); font-size: .6rem; letter-spacing: .3em; color: var(--gold); text-transform: uppercase; margin-bottom: .5rem; }
.hf-title { font-family: var(--ff-serif); font-size: 1.25rem; font-weight: 700; color: var(--text); letter-spacing: .06em; margin-bottom: .5rem; }
.hf-desc { font-size: .8rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.1rem; }
.hf-steps { display: flex; align-items: center; justify-content: center; gap: .6rem; margin-bottom: 1.3rem; flex-wrap: wrap; }
.hf-step { display: flex; flex-direction: column; align-items: center; gap: .3rem; }
.hf-step-icon { font-size: 1.3rem; }
.hf-step-label { font-family: var(--ff-mono); font-size: .6rem; color: var(--muted); letter-spacing: .04em; white-space: nowrap; }
.hf-arrow { color: var(--gold); opacity: .6; font-size: .8rem; }
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
@media (max-width: 639px) {
  .hero-flagship-card { padding: 1.4rem 1.1rem 1.3rem; border-radius: 18px; }
  .hf-steps { flex-direction: column; gap: .7rem; }
  .hf-arrow { transform: rotate(90deg); }
}
.hero-pillars { display: flex; justify-content: center; flex-wrap: wrap; gap: .6rem; margin-bottom: 2rem; }
.pillar { font-family: var(--ff-mono); font-size: .68rem; letter-spacing: .1em; padding: .28rem .85rem; border: 1px solid rgba(201,168,76,.28); border-radius: 20px; color: rgba(201,168,76,.7); text-decoration: none; display: inline-block; cursor: pointer; transition: background .2s, border-color .2s, color .2s; }
.pillar:hover, .pillar:focus-visible { background: rgba(201,168,76,.1); border-color: rgba(201,168,76,.5); color: rgba(201,168,76,.9); }
.pillar:focus-visible { outline: 2px solid var(--gold-lt); outline-offset: 2px; }
.pillar-flagship { border-color: var(--gold); color: var(--gold-lt); background: rgba(201,168,76,.12); }
.pillar-flagship:hover, .pillar-flagship:focus-visible { background: rgba(201,168,76,.2); border-color: var(--gold-lt); color: var(--gold-lt); }
@media (max-width: 600px) {
  .pillar { padding: .8rem .9rem; min-height: 44px; display: inline-flex; align-items: center; }
}
.hero-cta { display: flex; justify-content: center; flex-wrap: wrap; gap: .7rem; }
.btn-primary { padding: .72rem 1.9rem; background: linear-gradient(135deg, var(--violet), var(--rose)); border: none; border-radius: 28px; color: #fff; font-family: var(--ff-serif); font-size: .9rem; font-weight: 700; letter-spacing: .12em; cursor: pointer; text-decoration: none; display: inline-block; box-shadow: 0 4px 22px rgba(122,74,158,.4); transition: opacity .2s, transform .15s; }
.btn-primary:hover { opacity: .88; transform: translateY(-2px); }
.btn-outline { padding: .68rem 1.6rem; background: transparent; border: 1px solid rgba(201,168,76,.4); border-radius: 28px; color: var(--gold-lt); font-family: var(--ff-mono); font-size: .76rem; letter-spacing: .1em; cursor: pointer; text-decoration: none; display: inline-block; transition: border-color .2s, background .2s; }
.btn-outline:hover { border-color: var(--gold); background: rgba(201,168,76,.08); }

/* スクロール誘導 */
.hero-scroll {
  position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
  display: flex; flex-direction: column; align-items: center; gap: .35rem;
  z-index: 3;
  opacity: 0; animation: hFade .8s ease 1.6s forwards;
}
.scroll-txt { font-family: var(--ff-mono); font-size: .55rem; letter-spacing: .3em; color: rgba(201,168,76,.35); }
.scroll-ln { width: 1px; height: 38px; background: linear-gradient(180deg, rgba(201,168,76,.4), transparent); animation: scDown 1.9s ease infinite; }
@keyframes scDown {
  0%   { transform: scaleY(0); transform-origin: top; }
  50%  { transform: scaleY(1); transform-origin: top; }
  51%  { transform: scaleY(1); transform-origin: bottom; }
  100% { transform: scaleY(0); transform-origin: bottom; }
}

/* ══════════════════════════════════
   占いカードグリッド（カテゴリ別）
══════════════════════════════════ */
.fortune-section {
  padding: 4rem 0 3rem;
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
.crow-body span { font-size: .65rem; color: var(--muted); }
.crow .feature-cta { font-size: .62rem; margin-top: 2px; }

@media (max-width: 639px) {
  .lane01-grid { display: block; padding: 0 1.2rem; }
  .companions { display: flex; flex-direction: column; gap: .5rem; }
  .feature-card { grid-column: unset; grid-row: unset; margin-bottom: .9rem; padding: 1.2rem; }
  .feature-card h3 { font-size: 1.15rem; }
  .feature-card::after { content: none; }
  .crow { grid-column: unset; padding: .7rem; background: linear-gradient(145deg, hsl(258 24% 18%), hsl(258 24% 14%)); border-color: transparent; }
  .crow:hover, .crow:focus-visible { border-color: var(--fs-border); }
}

/* ─── レーン02：カード・心理（タイル） ─── */
.tiles { padding: 0 1.2rem; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
.tile { border-radius: 12px; padding: 1rem; display: flex; align-items: center; gap: 1rem; min-height: auto; }
.tile .ic-wrap { width: 64px; height: 64px; color: var(--gold); font-size: 43px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.tile-body { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 3px; }
.tile h4 { font-family: var(--ff-serif); font-weight: 700; font-size: .95rem; color: var(--text); margin-top: .5rem; }
.tile-body span { font-size: .69rem; color: var(--muted); line-height: 1.5; flex: 1; }
.tile .feature-cta { font-size: .69rem; margin-top: auto; }

@media (max-width: 639px) {
  .tiles { grid-template-columns: repeat(2, 1fr); gap: .75rem; }
  .tile { min-height: 132px; }
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
  background: var(--card); border: 1px solid var(--border);
  border-radius: 12px; padding: 1.1rem 1rem .95rem;
  display: flex; flex-direction: column; gap: .42rem;
  position: relative; overflow: hidden;
  transition: border-color .2s, transform .2s;
  text-decoration: none; color: inherit;
}
.gcard::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--c1), var(--c2)); }
.gcard:hover { border-color: var(--border2); transform: translateY(-2px); }
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

<!-- ══ HEADER ══ -->
<header class="site-header">
  <div class="header-inner">
    <a href="/" class="logo">占い<em>Portal</em></a>
    <nav class="header-nav">
      <a href="/" class="cur">✦ TOP</a>
      <a href="/tarot">タロット</a>
      <a href="/shichu">四柱推命</a>
      <a href="/kyusei">九星気学</a>
      <a href="/articles/">解説ガイド</a>
    </nav>
    <div id="google_translate_element"></div>
    <button class="sp-menu-btn" onclick="toggleMenu()">☰ メニュー</button>
  </div>
  <div class="header-gold-line"></div>
</header>

<div class="sp-dropdown" id="spMenu">
  <a href="/">✦ トップ</a>
  <a href="/sansei">✨ 三星統合鑑定</a>
  <a href="/tarot">🃏 タロット占い</a>
  <a href="/shichu">🔯 四柱推命</a>
  <a href="/sanmei">☯ 算命学</a>
  <a href="/seiza">⭐ 西洋占星術</a>
  <a href="/mbti">🧠 MBTI×星座</a>
  <a href="/numerology">🔢 数秘術</a>
  <a href="/kyusei">⭐ 九星気学</a>
  <a href="/rpg">⚔️ RPG風占い</a>
  <a href="/aisho">💑 相性診断</a>
  <a href="/zense">🌀 前世診断</a>
  <a href="/guardian">👻 守護霊診断</a>
  <a href="/seimei">✍️ 姓名判断</a>
  <a href="/geimei">🎭 芸名診断</a>
  <a href="/articles/">📖 解説ガイド</a>
</div>

<!-- ══ HERO ══ -->
<section class="hero">
  <canvas id="canvas-stars"></canvas>
  <div class="hero-top-accent"></div>

  <div class="hero-inner">
    <span class="hero-eyebrow h-d1">Free Fortune Telling · 占いPortal</span>
    <div class="hero-deco h-d2"><span>✦ ── ✦ ── ✦</span></div>
    <h1 class="hero-h1 h-d3">無料占いポータル</h1>
    <span class="hero-sub h-d4">星と運命の交差点 · 16種類の占術で今を読み解く</span>
    <div class="hero-flagship-card h-d5">
      <span class="hf-eyebrow">Flagship Reading</span>
      <div class="hf-title">✨ 三星統合鑑定</div>
      <p class="hf-desc">西洋占星術×タロット×四柱推命の三位一体。名前と生年月日だけで鑑定。</p>
      <div class="hf-steps">
        <div class="hf-step"><span class="hf-step-icon">🔮</span><span class="hf-step-label">何がわかるか</span></div>
        <span class="hf-arrow">→</span>
        <div class="hf-step"><span class="hf-step-icon">📝</span><span class="hf-step-label">名前・生年月日を入力</span></div>
        <span class="hf-arrow">→</span>
        <div class="hf-step"><span class="hf-step-icon">✨</span><span class="hf-step-label">その場で鑑定結果</span></div>
      </div>
      <a href="/sansei" class="btn-gold" data-ga-event="cta_click" data-cta-name="hero_flagship_sansei" data-cta-destination="/sansei">
        ✨ 三星統合鑑定をはじめる →
      </a>
    </div>
    <div class="hero-pillars h-d6">
      <?php
      // Hero直下のピル：URL・アイコンは$_NAV_PAGES（inc/nav-cards.php）を単一の情報源として利用（二重管理を避ける）。
      // 表示名のみHero専用の短縮ラベルを使う（Heroは「入口」であり、カード一覧の正式名称とは役割が異なるため）。
      $_heroPills = [
        'sansei' => '三星鑑定',
        'seiza'  => '西洋占星術',
        'tarot'  => 'タロット',
        'shichu' => '四柱推命',
        'sanmei' => '算命学',
      ];
      foreach ($_heroPills as $_slugKey => $_shortLabel):
        $_heroPill = $_NAV_PAGES[$_slugKey];
        $_cls = $_slugKey === 'sansei' ? 'pillar pillar-flagship' : 'pillar';
        $_gaAttrs = $_slugKey === 'sansei' ? ' data-ga-event="cta_click" data-cta-name="hero_pillar_sansei" data-cta-destination="/sansei"' : '';
      ?>
      <a href="<?= htmlspecialchars($_heroPill['url'], ENT_QUOTES, 'UTF-8') ?>" class="<?= $_cls ?>"<?= $_gaAttrs ?>><?= htmlspecialchars($_heroPill['icon'], ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($_shortLabel, ENT_QUOTES, 'UTF-8') ?></a>
      <?php endforeach; ?>
    </div>
    <div class="hero-cta h-d7">
      <a href="#fortunes" class="btn-primary" data-ga-event="cta_click" data-cta-name="hero_browse_fortunes" data-cta-destination="#fortunes">占いを選ぶ ▼</a>
      <a href="#oracle" class="btn-outline" data-ga-event="cta_click" data-cta-name="hero_oracle" data-cta-destination="#oracle">今日の開運情報</a>
    </div>
  </div>

  <div class="hero-scroll">
    <span class="scroll-txt">Scroll</span>
    <div class="scroll-ln"></div>
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
    <p class="section-sub">16種類の占術から、今のあなたに合ったものを</p>
    <p class="fortune-guide">迷ったら、まずは✨三星統合鑑定から。名前と生年月日だけで3つの占術を同時に鑑定します。</p>
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
        <span class="gc-lbl">Tarot</span>
        <div class="gc-name">🃏 タロット占いとは</div>
        <div class="gc-desc">22枚の意味・歴史・正位置逆位置の読み方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/shichu/" class="gcard fade-up" style="--c1:#c9a84c;--c2:#9b72ef">
        <span class="gc-lbl">Shichu Suimei</span>
        <div class="gc-name">🔯 四柱推命とは</div>
        <div class="gc-desc">命式・十神・大運・天中殺の見方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/numerology/" class="gcard fade-up" style="--c1:#3ab8b0;--c2:#c9a84c">
        <span class="gc-lbl">Numerology</span>
        <div class="gc-name">🔢 数秘術とは</div>
        <div class="gc-desc">ライフパスナンバーの計算方法と意味</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/mbti/" class="gcard fade-up" style="--c1:#c85080;--c2:#9b72ef">
        <span class="gc-lbl">MBTI</span>
        <div class="gc-name">🧠 MBTIとは</div>
        <div class="gc-desc">16タイプの特徴と星座との組み合わせ</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/kyusei/" class="gcard fade-up" style="--c1:#9b72ef;--c2:#3ab8b0">
        <span class="gc-lbl">Nine Star Ki</span>
        <div class="gc-name">⭐ 九星気学とは</div>
        <div class="gc-desc">本命星・月命星と吉方位の求め方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="/articles/sanmei/" class="gcard fade-up" style="--c1:#c9a84c;--c2:#3ab8b0">
        <span class="gc-lbl">Sanmeigaku</span>
        <div class="gc-name">☯ 算命学とは</div>
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

/* ══ スマホメニュー ══ */
window.toggleMenu = function(){
  document.getElementById('spMenu').classList.toggle('open');
};
document.addEventListener('click', e => {
  if(!e.target.closest('.sp-menu-btn') && !e.target.closest('.sp-dropdown'))
    document.getElementById('spMenu').classList.remove('open');
});
</script>
</body>
</html>
