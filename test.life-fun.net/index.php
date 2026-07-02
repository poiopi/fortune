<?php
declare(strict_types=1);
require_once __DIR__.'/inc/nav-cards.php';
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
.section-sub {
  font-size: .8rem;
  color: var(--muted);
  text-align: center;
  letter-spacing: .05em;
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

.hero-kamon { font-size: 2.8rem; display: block; margin-bottom: .7rem; filter: drop-shadow(0 0 16px rgba(201,168,76,.5)); }
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
.hero-pillars { display: flex; justify-content: center; flex-wrap: wrap; gap: .6rem; margin-bottom: 2rem; }
.pillar { font-family: var(--ff-mono); font-size: .68rem; letter-spacing: .1em; padding: .28rem .85rem; border: 1px solid rgba(201,168,76,.28); border-radius: 20px; color: rgba(201,168,76,.7); }
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
   占いカルーセル（PC） / グリッド（SP）
══════════════════════════════════ */
.fortune-section {
  padding: 4rem 0 3rem;
  background: var(--deep);
}
.fortune-section-head { margin-bottom: 1.6rem; }

/* ─── PC カルーセル ─── */
.carousel-outer {
  position: relative;
  user-select: none;
}
.carousel-track {
  display: flex;
  gap: .9rem;
  overflow-x: hidden;       /* PCは JS制御 */
  scrollbar-width: none;
  padding: .6rem 0 1rem 1.2rem;
  cursor: grab;
  -webkit-overflow-scrolling: touch;
}
.carousel-track::-webkit-scrollbar { display: none; }
.carousel-track.dragging { cursor: grabbing; }

/* ─── SP グリッド（モバイル上書き） ─── */
@media (max-width: 639px) {
  .carousel-track {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: .65rem;
    overflow-x: visible;
    padding: 0 1rem 1rem;
    cursor: default;
  }
  /* SP: 複製カードを非表示 */
  .carousel-track .fcard[aria-hidden="true"] { display: none; }
}

/* 占いカード共通 */
.fcard {
  flex: 0 0 190px;
  scroll-snap-align: start;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 1.15rem 1rem 1rem;
  display: flex; flex-direction: column; gap: .45rem;
  position: relative; overflow: hidden;
  transition: border-color .22s, transform .22s, box-shadow .22s;
  cursor: pointer;
  text-decoration: none; color: inherit;
}
.fcard::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--c1), var(--c2));
}
.fcard:hover { border-color: var(--border2); transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.35); }

/* SP グリッド時はhoverのtransformを無効化 */
@media (max-width: 639px) {
  .fcard {
    flex: none;
    width: 100%;
    border-radius: 12px;
    padding: .9rem .85rem .85rem;
  }
  .fcard:hover { transform: none; }
}

.fc-icon  { font-size: 1.7rem; line-height: 1; }
.fc-lbl   { font-family: var(--ff-mono); font-size: .53rem; letter-spacing: .18em; color: var(--muted); text-transform: uppercase; }
.fc-name  { font-family: var(--ff-serif); font-size: .93rem; font-weight: 700; color: var(--text); letter-spacing: .04em; }
.fc-desc  { font-size: .69rem; color: var(--muted); line-height: 1.55; flex: 1; }

@media (max-width: 639px) {
  .fc-desc { display: none; } /* SPでは説明文を省略して高さを詰める */
}

.fc-btn {
  display: inline-flex; align-items: center; gap: .3rem;
  font-family: var(--ff-mono); font-size: .65rem; letter-spacing: .06em;
  color: #fff; text-decoration: none;
  padding: .32rem .75rem; border-radius: 20px;
  align-self: flex-start; margin-top: .2rem;
  background: linear-gradient(135deg, var(--c1), var(--c2));
  transition: opacity .2s;
}
.fc-btn:hover { opacity: .85; }

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

/* カルーセルコントロール（PCのみ） */
.carousel-controls {
  display: flex; align-items: center; justify-content: center; gap: .8rem;
  margin-top: .5rem;
}
.c-arr {
  width: 30px; height: 30px; border-radius: 50%;
  border: 1px solid rgba(201,168,76,.35);
  background: rgba(201,168,76,.07);
  color: var(--gold); font-size: .85rem;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: background .2s, border-color .2s;
  user-select: none;
}
.c-arr:hover { background: rgba(201,168,76,.18); border-color: var(--gold); }
.c-pause-hint {
  font-family: var(--ff-mono);
  font-size: .58rem; letter-spacing: .12em;
  color: rgba(201,168,76,.35);
}
@media (max-width: 639px) {
  .carousel-controls { display: none; }
}

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

.oracle-desc { font-size: .8rem; color: var(--muted); line-height: 1.75; margin-bottom: .8rem; }
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
.gc-desc { font-size: .69rem; color: var(--muted); line-height: 1.5; flex: 1; }
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
.footer-links a:hover { color: var(--gold-lt); }
.footer-copy { font-family: var(--ff-mono); font-size: .58rem; color: rgba(138,125,181,.3); letter-spacing: .1em; }
</style>
</head>
<body>

<!-- ══ HEADER ══ -->
<header class="site-header">
  <div class="header-inner">
    <a href="/" class="logo">⛩ 占い<em>Portal</em></a>
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
  <a href="/rpg">⚔️ RPG占い</a>
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
    <span class="hero-kamon h-d1">⛩</span>
    <span class="hero-eyebrow h-d2">Free Fortune Telling · 占いPortal</span>
    <div class="hero-deco h-d3"><span>✦ ── ✦ ── ✦</span></div>
    <h1 class="hero-h1 h-d4">無料占いポータル</h1>
    <span class="hero-sub h-d5">星と運命の交差点 · 14種類の占術で今を読み解く</span>
    <div class="hero-pillars h-d6">
      <span class="pillar">♈ 西洋占星術</span>
      <span class="pillar">🔮 タロット</span>
      <span class="pillar">☯ 四柱推命</span>
      <span class="pillar">🌙 算命学</span>
    </div>
    <div class="hero-cta h-d7">
      <a href="#fortunes" class="btn-primary">占いを選ぶ ▼</a>
      <a href="#oracle" class="btn-outline">今日の開運情報</a>
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
    <span class="pb-kamon">✦ ── ⛩ ── ✦</span>
    <div class="pb-gold-line"></div>
  </div>
</div>

<!-- ══ 占いカルーセル / SPグリッド ══ -->
<section class="fortune-section" id="fortunes">
  <div class="wrap fortune-section-head">
    <span class="section-label">Choose Your Fortune</span>
    <h2 class="section-title">占いを選ぶ</h2>
    <p class="section-sub">14種類の占術から、今のあなたに合ったものを</p>
  </div>

  <div class="carousel-outer">
    <div class="carousel-track" id="cTrack">

      <a href="/sansei" class="fcard ct-s fade-up">
        <span class="fc-icon">✨</span>
        <span class="fc-lbl">Integrated</span>
        <div class="fc-name">三星統合鑑定</div>
        <div class="fc-desc">西洋占星術×タロット×四柱推命の三位一体。名前と生年月日だけで鑑定。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>

      <a href="/tarot" class="fcard ct-v fade-up">
        <span class="fc-icon">🃏</span>
        <span class="fc-lbl">Tarot</span>
        <div class="fc-name">タロット占い</div>
        <div class="fc-desc">大アルカナ22枚から1枚を選ぶ。直感でカードを引き、今のメッセージを受け取る。</div>
        <span class="fc-btn">カードを引く →</span>
      </a>

      <a href="/shichu" class="fcard ct-g fade-up">
        <span class="fc-icon">🔯</span>
        <span class="fc-lbl">Shichu Suimei</span>
        <div class="fc-name">四柱推命</div>
        <div class="fc-desc">命式・十神・大運を本格算出。生年月日から人生の流れを読み解く。</div>
        <span class="fc-btn">算出する →</span>
      </a>

      <a href="/sanmei" class="fcard ct-t fade-up">
        <span class="fc-icon">☯</span>
        <span class="fc-lbl">Sanmeigaku</span>
        <div class="fc-name">算命学鑑定</div>
        <div class="fc-desc">元命・主星・従星から才能・恋愛・仕事適性を読む性格占術。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>

      <a href="/seiza" class="fcard ct-r fade-up">
        <span class="fc-icon">⭐</span>
        <span class="fc-lbl">Western Astrology</span>
        <div class="fc-name">西洋占星術</div>
        <div class="fc-desc">太陽星座×内面タイプで個性・恋愛・仕事適性を深掘り鑑定。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>

      <a href="/mbti" class="fcard ct-i fade-up">
        <span class="fc-icon">🧠</span>
        <span class="fc-lbl">MBTI × Zodiac</span>
        <div class="fc-name">MBTI×星座診断</div>
        <div class="fc-desc">10の質問で性格タイプと星座の組み合わせ運命を診断する。</div>
        <span class="fc-btn">診断する →</span>
      </a>

      <a href="/numerology" class="fcard ct-t fade-up">
        <span class="fc-icon">🔢</span>
        <span class="fc-lbl">Numerology</span>
        <div class="fc-name">数秘術診断</div>
        <div class="fc-desc">生年月日と名前から4つの数字で人生の使命を読み解く。</div>
        <span class="fc-btn">診断する →</span>
      </a>

      <a href="/kyusei" class="fcard ct-a fade-up">
        <span class="fc-icon">⭐</span>
        <span class="fc-lbl">Nine Star Ki</span>
        <div class="fc-name">九星気学診断</div>
        <div class="fc-desc">本命星・月命星・吉方位を無料診断。今年の運勢の流れを知る。</div>
        <span class="fc-btn">診断する →</span>
      </a>

      <a href="/rpg" class="fcard ct-gn fade-up">
        <span class="fc-icon">⚔️</span>
        <span class="fc-lbl">RPG Fortune</span>
        <div class="fc-name">RPG占いの村</div>
        <div class="fc-desc">勇者となって占いの村を冒険しながら運命を知る。</div>
        <span class="fc-btn">冒険する →</span>
      </a>

      <a href="/aisho" class="fcard ct-r fade-up">
        <span class="fc-icon">💑</span>
        <span class="fc-lbl">Compatibility</span>
        <div class="fc-name">二人の相性診断</div>
        <div class="fc-desc">星座と数秘術で恋愛・結婚の相性を鑑定する。</div>
        <span class="fc-btn">診断する →</span>
      </a>

      <a href="/zense" class="fcard ct-c fade-up">
        <span class="fc-icon">🌀</span>
        <span class="fc-lbl">Past Life</span>
        <div class="fc-name">前世診断</div>
        <div class="fc-desc">あなたは何回目の転生？魂のカルテを読み解く。</div>
        <span class="fc-btn">診断する →</span>
      </a>

      <a href="/guardian" class="fcard ct-g fade-up">
        <span class="fc-icon">👻</span>
        <span class="fc-lbl">Guardian Spirit</span>
        <div class="fc-name">守護霊診断</div>
        <div class="fc-desc">あなたを守る霊はUR？SSR？レアリティ付き守護霊を召喚。</div>
        <span class="fc-btn">召喚する →</span>
      </a>

      <a href="/seimei" class="fcard ct-v fade-up">
        <span class="fc-icon">✍️</span>
        <span class="fc-lbl">Seimei</span>
        <div class="fc-name">姓名判断</div>
        <div class="fc-desc">名前に宿る運命を五格で鑑定。天格・人格・総格から運勢を読む。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>

      <a href="/geimei" class="fcard ct-a fade-up">
        <span class="fc-icon">🎭</span>
        <span class="fc-lbl">Geimei</span>
        <div class="fc-name">芸名診断</div>
        <div class="fc-desc">大喜利で見つける最強の芸名。</div>
        <span class="fc-btn">診断する →</span>
      </a>

    </div><!-- /carousel-track -->

    <div class="carousel-controls">
      <button class="c-arr" id="cPrev">‹</button>
      <span class="c-pause-hint">hover / drag to pause</span>
      <button class="c-arr" id="cNext">›</button>
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
      <div class="oracle-date">2026年6月30日（月）</div>
      <div class="oracle-grid">
        <div class="rokuyo-box">
          <div class="rokuyo-name">赤口</div>
          <div class="rokuyo-en">SHAKKU</div>
        </div>
        <div>
          <p class="oracle-desc">午の刻（11〜13時）のみ吉。火や血に関することは慎む日とされています。静かに過ごすことが運気を保つ秘訣です。</p>
          <div class="oracle-msg">「直感を信じて行動しましょう。日常に隠れた小さな幸せに気づく日。」</div>
          <div class="oracle-chips">
            <div class="ochip"><span class="ochip-l">COLOR</span>&nbsp;ラベンダー</div>
            <div class="ochip"><span class="ochip-l">NO.</span>&nbsp;7</div>
            <div class="ochip"><span class="ochip-l">FOOD</span>&nbsp;抹茶ラテ</div>
            <div class="ochip"><span class="ochip-l">ITEM</span>&nbsp;天然石ブレスレット</div>
            <div class="ochip"><span class="ochip-l">ACTION</span>&nbsp;深呼吸を3回</div>
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

<!-- ══ FOOTER（共通フッター：内部リンク構造を移植） ══ -->
<div class="parallax-band">
  <div class="pb-content">
    <div class="pb-gold-line"></div>
    <span class="pb-kamon">✦ ── ⛩ ── ✦</span>
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

/* ══ PC カルーセル（無限じわスクロール + ドラッグ） ══ */
(function(){
  const isMobile = () => window.innerWidth < 640;
  const track = document.getElementById('cTrack');
  const origCards = Array.from(track.querySelectorAll('.fcard'));

  const SPEED   = 0.45;   // px/frame（遅め）
  const CARD_GAP = 14;    // .9rem ≈ 14px

  let pos       = 0;
  let targetPos = 0;   // イージング用の目標位置
  let paused    = false;
  let dragging  = false;
  let dragStartX   = 0;
  let dragStartPos = 0;
  let raf = null;
  let cloned = false;

  /* カードを複製してDOMに追加（1セット追加で無限ループ） */
  function setupClones(){
    if(cloned) return;
    origCards.forEach(c => {
      const cl = c.cloneNode(true);
      cl.setAttribute('aria-hidden', 'true');
      track.appendChild(cl);
    });
    cloned = true;
  }

  /* 1セット分の幅 */
  function origWidth(){
    if(!origCards[0]) return 0;
    return (origCards[0].offsetWidth + CARD_GAP) * origCards.length;
  }

  /* メインループ */
  function tick(){
    if(!isMobile()){
      const ow = origWidth();
      if(!paused && !dragging){
        /* 自動スクロール：targetPosも一緒に進める */
        pos += SPEED;
        targetPos += SPEED;
        if(ow > 0 && pos >= ow) { pos -= ow; targetPos -= ow; }
      }
      /* イージング：posをtargetPosに向かってなめらかに近づける */
      if(Math.abs(targetPos - pos) > 0.1){
        pos += (targetPos - pos) * 0.1;
        /* ループ境界処理 */
        if(ow > 0 && pos >= ow) pos -= ow;
        if(pos < 0) pos += ow;
      }
      track.scrollLeft = pos;
    }
    raf = requestAnimationFrame(tick);
  }

  /* 矢印：1枚分なめらかに移動 */
  function jump(dir){
    if(isMobile()) return;
    const cardW = origCards[0] ? origCards[0].offsetWidth + CARD_GAP : 200;
    targetPos += dir * cardW;
    const ow = origWidth();
    if(targetPos < 0)   targetPos += ow;
    if(targetPos >= ow) targetPos -= ow;
  }

  document.getElementById('cPrev').addEventListener('click', () => jump(-1));
  document.getElementById('cNext').addEventListener('click', () => jump(1));

  /* ホバーで一時停止 */
  track.addEventListener('mouseenter', () => { if(!isMobile()) paused = true;  });
  track.addEventListener('mouseleave', () => { if(!isMobile()) paused = false; });

  /* ドラッグ（一定距離動いたときだけドラッグ扱いにし、単純クリックはリンクとして機能させる） */
  const DRAG_THRESHOLD = 6; // px
  let pointerIsDown = false;
  let pointerDownX = 0;
  let downTargetLink = null;

  track.addEventListener('pointerdown', e => {
    if(isMobile()) return;
    pointerIsDown = true;
    pointerDownX = e.clientX;
    dragStartX   = e.clientX;
    dragStartPos = pos;
    downTargetLink = e.target.closest('.fcard');
    track.setPointerCapture(e.pointerId);
  });
  track.addEventListener('pointermove', e => {
    if(!pointerIsDown) return;
    if(!dragging){
      if(Math.abs(e.clientX - pointerDownX) < DRAG_THRESHOLD) return;
      /* しきい値を超えたらここで初めてドラッグ開始 */
      dragging = true;
      track.classList.add('dragging');
    }
    e.preventDefault();
    const dx = dragStartX - e.clientX;
    const ow = origWidth();
    let next = dragStartPos + dx;
    if(next < 0)   next += ow;
    if(next >= ow) next -= ow;
    pos = targetPos = next;       /* ドラッグ中はイージングをバイパス */
    track.scrollLeft = pos;
  });
  ['pointerup','pointercancel'].forEach(ev => {
    track.addEventListener(ev, () => {
      pointerIsDown = false;
      if(dragging){
        dragging = false;
        track.classList.remove('dragging');
        targetPos = pos;  /* 離した位置から自動スクロール再開 */
        /* ドラッグ操作の終わりなので、直後のクリックでのページ遷移を止める */
        if(downTargetLink) downTargetLink.addEventListener('click', ev2 => ev2.preventDefault(), { once: true });
      }
      downTargetLink = null;
    });
  });

  /* 初期化 */
  function init(){
    if(!isMobile()){
      setupClones();
      track.scrollLeft = 0;
      pos = 0;
    }
    if(!raf) raf = requestAnimationFrame(tick);
  }

  window.addEventListener('resize', () => {
    /* リサイズ時にSP⇔PCを切り替え */
    track.scrollLeft = pos = 0;
  });

  init();
})();

/* ══ IntersectionObserver ══ */
const io = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: .12 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));

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
