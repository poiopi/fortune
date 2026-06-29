<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>【デザイン案】無料占いポータル</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════
   CSS変数
══════════════════════════════════════════ */
:root {
  --void:      #060410;
  --deep:      #0a0818;
  --surface:   #120f24;
  --card:      #1a1535;
  --card2:     #221a42;
  --border:    rgba(160,130,220,.15);
  --border2:   rgba(160,130,220,.32);
  --gold:      #c9a84c;
  --gold-lt:   #e8d48a;
  --gold-dk:   #8b6914;
  --violet:    #7a4a9e;
  --violet-lt: #b088e0;
  --rose:      #c85080;
  --teal:      #3ab8b0;
  --text:      #e8e2f5;
  --muted:     #8a7db5;
  --ff-serif:  'Shippori Mincho', serif;
  --ff-sans:   'Zen Kaku Gothic New', sans-serif;
  --ff-mono:   'DM Mono', monospace;
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

/* ══ 和風区切りライン ══ */
.wa-line {
  height: 1px;
  background: linear-gradient(90deg,
    transparent 0%,
    rgba(201,168,76,.15) 15%,
    rgba(201,168,76,.7) 40%,
    rgba(201,168,76,.9) 50%,
    rgba(201,168,76,.7) 60%,
    rgba(201,168,76,.15) 85%,
    transparent 100%);
  margin: 0;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform .8s ease;
}
.wa-line.visible { transform: scaleX(1); }

.wa-line-thin {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(201,168,76,.25), transparent);
}

/* ══ セクション共通 ══ */
.section-label {
  font-family: var(--ff-mono);
  font-size: .62rem;
  letter-spacing: .28em;
  color: var(--gold);
  text-transform: uppercase;
  text-align: center;
  display: block;
  margin-bottom: .6rem;
}
.section-title {
  font-family: var(--ff-serif);
  font-size: clamp(1.1rem, 3vw, 1.45rem);
  font-weight: 700;
  text-align: center;
  color: var(--text);
  letter-spacing: .1em;
  margin-bottom: .4rem;
}
.section-sub {
  font-size: .8rem;
  color: var(--muted);
  text-align: center;
  letter-spacing: .06em;
  margin-bottom: 1.8rem;
}

.wrap { max-width: 960px; margin: 0 auto; padding: 0 1.2rem; }

/* ══════════════════════════════════════════
   HEADER
══════════════════════════════════════════ */
.site-header {
  position: sticky; top: 0; z-index: 200;
  background: rgba(6,4,16,.94);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
}
.header-inner {
  max-width: 960px; margin: 0 auto;
  padding: 0 1.4rem;
  display: flex; align-items: center; justify-content: space-between;
  height: 56px;
  gap: 1rem;
}
.logo {
  font-family: var(--ff-serif);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--text);
  text-decoration: none;
  display: flex; align-items: center; gap: .5rem;
  letter-spacing: .06em;
  white-space: nowrap;
}
.logo-kamon { font-size: 1.2rem; }
.logo em { font-style: italic; color: var(--gold); }

.header-nav {
  display: flex; align-items: center; gap: 1.6rem;
}
.header-nav a {
  font-family: var(--ff-mono);
  font-size: .68rem;
  color: var(--muted);
  text-decoration: none;
  letter-spacing: .1em;
  transition: color .2s;
  white-space: nowrap;
  position: relative;
  padding-bottom: 2px;
}
.header-nav a::after {
  content: '';
  position: absolute; bottom: 0; left: 0; right: 0;
  height: 1px;
  background: var(--gold);
  transform: scaleX(0);
  transition: transform .2s;
}
.header-nav a:hover { color: var(--gold-lt); }
.header-nav a:hover::after { transform: scaleX(1); }
.header-nav a.current { color: var(--gold); pointer-events: none; }
.header-nav a.current::after { transform: scaleX(1); }

.header-right { display: flex; align-items: center; gap: .8rem; }
.sp-menu-btn {
  display: none;
  background: none;
  border: 1px solid var(--border2);
  border-radius: 6px;
  color: var(--muted);
  font-family: var(--ff-mono);
  font-size: .72rem;
  padding: .3rem .75rem;
  cursor: pointer;
  letter-spacing: .08em;
}

/* ヘッダー下の金線 */
.header-gold-line {
  height: 2px;
  background: linear-gradient(90deg,
    transparent 0%,
    rgba(201,168,76,.0) 5%,
    rgba(201,168,76,.6) 30%,
    rgba(201,168,76,1) 50%,
    rgba(201,168,76,.6) 70%,
    rgba(201,168,76,.0) 95%,
    transparent 100%);
}

/* スマホドロップダウン */
.sp-dropdown {
  display: none;
  position: fixed; top: 58px; left: 0; right: 0;
  background: rgba(6,4,16,.97);
  border-bottom: 1px solid var(--border2);
  z-index: 199;
  backdrop-filter: blur(16px);
}
.sp-dropdown.open { display: block; }
.sp-dropdown a {
  display: block;
  padding: .9rem 1.4rem;
  font-family: var(--ff-mono);
  font-size: .8rem;
  color: var(--muted);
  text-decoration: none;
  border-bottom: 1px solid var(--border);
  transition: color .2s, background .2s;
  letter-spacing: .08em;
}
.sp-dropdown a:hover { color: var(--gold-lt); background: rgba(201,168,76,.06); }

@media (max-width: 768px) {
  .header-nav { display: none; }
  .sp-menu-btn { display: flex; align-items: center; gap: .35rem; }
}

/* ══════════════════════════════════════════
   HERO
══════════════════════════════════════════ */
.hero {
  position: relative;
  min-height: 88vh;
  display: flex; align-items: center; justify-content: center;
  overflow: hidden;
}
#canvas-stars {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  pointer-events: none;
}
/* 上下の金装飾線 */
.hero-top-line {
  position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, transparent, var(--gold-dk) 20%, var(--gold) 50%, var(--gold-dk) 80%, transparent);
  z-index: 2;
}
.hero-bottom-line {
  position: absolute; bottom: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(201,168,76,.5), transparent);
  z-index: 2;
}

.hero-inner {
  position: relative; z-index: 3;
  text-align: center;
  padding: 2rem 1.2rem;
  max-width: 720px;
}

/* フェードイン */
.hero-inner > * {
  opacity: 0;
  transform: translateY(18px);
  animation: heroFadeUp .9s ease forwards;
}
.hero-kamon    { animation-delay: .1s; }
.hero-eyebrow  { animation-delay: .3s; }
.hero-deco     { animation-delay: .5s; }
.hero-h1       { animation-delay: .6s; }
.hero-sub      { animation-delay: .8s; }
.hero-pillars  { animation-delay: 1.0s; }
.hero-cta      { animation-delay: 1.2s; }
.hero-scroll   { animation-delay: 1.5s; }

@keyframes heroFadeUp {
  to { opacity: 1; transform: translateY(0); }
}

.hero-kamon {
  font-size: 2.8rem;
  display: block;
  margin-bottom: .8rem;
  filter: drop-shadow(0 0 16px rgba(201,168,76,.5));
}
.hero-eyebrow {
  font-family: var(--ff-mono);
  font-size: .65rem;
  letter-spacing: .35em;
  color: var(--gold);
  text-transform: uppercase;
  display: block;
  margin-bottom: .8rem;
}

/* 家紋風デコレーター */
.hero-deco {
  display: flex; align-items: center; justify-content: center; gap: 10px;
  margin: 0 auto .9rem;
  max-width: 260px;
}
.hero-deco::before, .hero-deco::after {
  content: '';
  flex: 1;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(201,168,76,.6));
}
.hero-deco::after {
  background: linear-gradient(270deg, transparent, rgba(201,168,76,.6));
}
.hero-deco-sym {
  font-size: 1rem;
  color: var(--gold);
  line-height: 1;
  opacity: .85;
}

.hero-h1 {
  font-family: var(--ff-serif);
  font-size: clamp(2.1rem, 6.5vw, 3.5rem);
  font-weight: 700;
  line-height: 1.15;
  letter-spacing: .1em;
  color: var(--text);
  text-shadow: 0 2px 20px rgba(0,0,0,.7);
  margin-bottom: .65rem;
}
.hero-h1 span {
  background: linear-gradient(135deg, var(--gold-lt) 0%, #fff 50%, var(--violet-lt, #c4a8f5) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.hero-sub {
  font-size: clamp(.82rem, 2vw, .95rem);
  color: rgba(200,190,230,.55);
  letter-spacing: .1em;
  margin-bottom: 1.6rem;
  display: block;
}

.hero-pillars {
  display: flex; justify-content: center; flex-wrap: wrap; gap: .65rem;
  margin-bottom: 2rem;
}
.pillar {
  font-family: var(--ff-mono);
  font-size: .7rem;
  letter-spacing: .12em;
  padding: .3rem .9rem;
  border: 1px solid rgba(201,168,76,.3);
  border-radius: 20px;
  color: rgba(201,168,76,.75);
}

.hero-cta {
  display: flex; justify-content: center; flex-wrap: wrap; gap: .75rem;
  margin-bottom: 2.5rem;
}
.btn-primary {
  padding: .75rem 2rem;
  background: linear-gradient(135deg, var(--violet) 0%, var(--rose) 100%);
  border: none;
  border-radius: 28px;
  color: #fff;
  font-family: var(--ff-serif);
  font-size: .9rem;
  font-weight: 600;
  letter-spacing: .12em;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  box-shadow: 0 4px 22px rgba(122,74,158,.4);
  transition: opacity .2s, transform .15s;
}
.btn-primary:hover { opacity: .88; transform: translateY(-2px); }
.btn-outline {
  padding: .72rem 1.8rem;
  background: transparent;
  border: 1px solid rgba(201,168,76,.45);
  border-radius: 28px;
  color: var(--gold-lt);
  font-family: var(--ff-mono);
  font-size: .78rem;
  letter-spacing: .12em;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  transition: border-color .2s, background .2s;
}
.btn-outline:hover { border-color: var(--gold); background: rgba(201,168,76,.08); }

.hero-scroll {
  display: flex; flex-direction: column; align-items: center; gap: .35rem;
}
.scroll-text {
  font-family: var(--ff-mono);
  font-size: .58rem;
  letter-spacing: .3em;
  color: rgba(201,168,76,.4);
  text-transform: uppercase;
}
.scroll-line {
  width: 1px; height: 40px;
  background: linear-gradient(180deg, rgba(201,168,76,.4), transparent);
  animation: scrollDown 1.8s ease infinite;
}
@keyframes scrollDown {
  0%   { transform: scaleY(0); transform-origin: top; }
  50%  { transform: scaleY(1); transform-origin: top; }
  51%  { transform: scaleY(1); transform-origin: bottom; }
  100% { transform: scaleY(0); transform-origin: bottom; }
}

/* ══════════════════════════════════════════
   CAROUSEL セクション
══════════════════════════════════════════ */
.carousel-section {
  padding: 3rem 0 2.5rem;
  background: var(--deep);
}
.carousel-header { margin-bottom: 1.4rem; padding: 0 1.2rem; }

.carousel-wrap-outer {
  position: relative;
}
.carousel-track {
  display: flex;
  gap: .85rem;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
  padding: .5rem 1.2rem 1rem;
}
.carousel-track::-webkit-scrollbar { display: none; }

.fortune-card {
  flex: 0 0 200px;
  scroll-snap-align: start;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 1.2rem 1rem 1rem;
  display: flex; flex-direction: column; gap: .5rem;
  position: relative; overflow: hidden;
  transition: border-color .2s, transform .2s, box-shadow .2s;
  cursor: pointer;
  text-decoration: none; color: inherit;
}
.fortune-card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--c1), var(--c2));
}
.fortune-card:hover {
  border-color: var(--border2);
  transform: translateY(-3px);
  box-shadow: 0 8px 28px rgba(0,0,0,.35);
}
.fc-icon  { font-size: 1.8rem; line-height: 1; }
.fc-label { font-family: var(--ff-mono); font-size: .56rem; letter-spacing: .18em; color: var(--muted); text-transform: uppercase; }
.fc-name  { font-family: var(--ff-serif); font-size: .95rem; font-weight: 700; color: var(--text); letter-spacing: .04em; }
.fc-desc  { font-size: .7rem; color: var(--muted); line-height: 1.55; flex: 1; }
.fc-btn   {
  display: inline-flex; align-items: center; gap: .3rem;
  font-family: var(--ff-mono); font-size: .68rem; letter-spacing: .06em;
  color: #fff; text-decoration: none;
  padding: .35rem .8rem;
  border-radius: 20px;
  align-self: flex-start;
  margin-top: .25rem;
  background: linear-gradient(135deg, var(--c1), var(--c2));
  transition: opacity .2s;
}
.fc-btn:hover { opacity: .85; }

/* カード色テーマ */
.ct-violet  { --c1: #7a4a9e; --c2: #c85080; }
.ct-gold    { --c1: #c9a84c; --c2: #7a4a9e; }
.ct-teal    { --c1: #3ab8b0; --c2: #c9a84c; }
.ct-rose    { --c1: #c85080; --c2: #7a4a9e; }
.ct-green   { --c1: #4a9c5a; --c2: #3ab8b0; }
.ct-indigo  { --c1: #4a3a9e; --c2: #7a4a9e; }
.ct-amber   { --c1: #c9a84c; --c2: #c85080; }
.ct-cyan    { --c1: #3ab8b0; --c2: #4a3a9e; }

/* ドット・矢印 */
.carousel-controls {
  display: flex; align-items: center; justify-content: center; gap: 1rem;
  margin-top: .6rem; padding: 0 1.2rem;
}
.carousel-dots { display: flex; gap: 5px; }
.cdot {
  width: 5px; height: 5px; border-radius: 50%;
  background: rgba(160,130,220,.25);
  transition: all .3s;
  cursor: pointer;
}
.cdot.active { width: 16px; border-radius: 3px; background: var(--gold); }
.carousel-arrow {
  width: 28px; height: 28px; border-radius: 50%;
  border: 1px solid rgba(201,168,76,.35);
  background: rgba(201,168,76,.08);
  color: var(--gold);
  font-size: .8rem;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  transition: background .2s, border-color .2s;
}
.carousel-arrow:hover { background: rgba(201,168,76,.18); border-color: var(--gold); }

/* ══════════════════════════════════════════
   今日の開運情報 セクション
══════════════════════════════════════════ */
.oracle-section {
  padding: 3.5rem 0;
  background: linear-gradient(180deg, var(--deep) 0%, var(--surface) 100%);
  position: relative;
}
.oracle-inner {
  max-width: 860px; margin: 0 auto; padding: 0 1.2rem;
}
.oracle-date {
  font-family: var(--ff-mono);
  font-size: .65rem;
  color: var(--muted);
  letter-spacing: .15em;
  text-align: center;
  display: block;
  margin-bottom: 1.6rem;
}

.oracle-grid {
  display: grid;
  grid-template-columns: auto 1fr;
  gap: 1.6rem;
  align-items: start;
  background: var(--card);
  border: 1px solid var(--border2);
  border-radius: 16px;
  padding: 1.8rem;
  box-shadow: 0 6px 32px rgba(0,0,0,.35);
  position: relative; overflow: hidden;
}
.oracle-grid::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-dk));
}

.rokuyo-box {
  text-align: center;
  padding: 1rem 1.2rem;
  border-radius: 10px;
  border: 2px solid var(--gold);
  background: rgba(201,168,76,.07);
  min-width: 80px;
}
.rokuyo-name { font-family: var(--ff-serif); font-size: 1.8rem; font-weight: 700; color: var(--gold); line-height: 1; }
.rokuyo-en   { font-family: var(--ff-mono); font-size: .5rem; letter-spacing: .12em; color: var(--muted); margin-top: .4rem; }

.oracle-right {}
.oracle-desc {
  font-size: .82rem;
  color: var(--muted);
  line-height: 1.75;
  margin-bottom: .85rem;
}
.oracle-msg {
  font-family: var(--ff-serif);
  font-size: .88rem;
  color: var(--gold-lt);
  font-style: italic;
  line-height: 1.7;
  padding: .6rem .9rem;
  border-left: 2px solid var(--gold);
  background: rgba(201,168,76,.05);
  border-radius: 0 6px 6px 0;
  margin-bottom: 1rem;
}

.oracle-chips {
  display: flex; flex-wrap: wrap; gap: .45rem;
  padding-top: .85rem;
  border-top: 1px solid var(--border);
}
.ochip {
  display: flex; align-items: center; gap: .3rem;
  background: rgba(155,114,239,.08);
  border: 1px solid rgba(155,114,239,.2);
  border-radius: 20px;
  padding: .22rem .7rem;
  font-size: .72rem;
  color: var(--violet-lt, #b088e0);
}
.ochip-label { font-family: var(--ff-mono); font-size: .56rem; color: var(--muted); letter-spacing: .08em; }

.oracle-link {
  display: flex; justify-content: flex-end; margin-top: .85rem;
}
.oracle-link a {
  font-family: var(--ff-mono);
  font-size: .68rem;
  letter-spacing: .1em;
  color: var(--muted);
  text-decoration: none;
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: .3rem .9rem;
  transition: color .2s, border-color .2s;
}
.oracle-link a:hover { color: var(--gold-lt); border-color: rgba(201,168,76,.4); }

@media (max-width: 580px) {
  .oracle-grid { grid-template-columns: 1fr; }
  .rokuyo-box { display: flex; align-items: center; gap: 1rem; padding: .7rem 1rem; }
  .rokuyo-name { font-size: 2.2rem; }
}

/* ══════════════════════════════════════════
   三星鑑定フォーム セクション
══════════════════════════════════════════ */
.sansei-section {
  padding: 3.5rem 0 4rem;
  background: var(--surface);
}
.form-card {
  background: var(--card);
  border: 1px solid var(--border2);
  border-radius: 18px;
  padding: 2.2rem 2rem 2.5rem;
  box-shadow: 0 8px 40px rgba(0,0,0,.4), inset 0 1px 0 rgba(255,255,255,.04);
  max-width: 560px;
  margin: 0 auto;
  position: relative; overflow: hidden;
}
.form-card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--violet), var(--gold), var(--rose));
}
.form-card h2 {
  font-family: var(--ff-serif);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--gold-lt);
  text-align: center;
  letter-spacing: .12em;
  margin-bottom: .5rem;
}
.form-card-sub {
  font-size: .75rem;
  color: var(--muted);
  text-align: center;
  letter-spacing: .06em;
  margin-bottom: 1.8rem;
}
.field { margin-bottom: 1.3rem; }
.field label {
  display: block;
  font-family: var(--ff-mono);
  font-size: .72rem;
  letter-spacing: .12em;
  color: var(--muted);
  margin-bottom: .45rem;
}
.field input {
  width: 100%;
  background: rgba(255,255,255,.04);
  border: 1px solid var(--border2);
  border-radius: 9px;
  padding: .8rem 1rem;
  color: var(--text);
  font-size: 1rem;
  font-family: var(--ff-sans);
  outline: none;
  transition: border-color .2s, box-shadow .2s;
  -webkit-appearance: none;
}
.field input:focus {
  border-color: var(--violet);
  box-shadow: 0 0 0 3px rgba(122,74,158,.2);
}
.field input::placeholder { color: rgba(200,190,230,.2); font-size: .9rem; }
.field input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(.5); }

.btn-submit {
  width: 100%;
  padding: 1rem;
  background: linear-gradient(135deg, var(--violet) 0%, var(--rose) 100%);
  border: none; border-radius: 10px;
  color: #fff;
  font-family: var(--ff-serif);
  font-size: 1rem; font-weight: 700;
  letter-spacing: .18em;
  cursor: pointer;
  box-shadow: 0 4px 22px rgba(122,74,158,.45);
  transition: opacity .2s, transform .15s;
  margin-top: .4rem;
}
.btn-submit:hover { opacity: .9; transform: translateY(-2px); }

.form-note {
  font-size: .7rem;
  color: var(--muted);
  text-align: center;
  margin-top: 1rem;
  letter-spacing: .04em;
  line-height: 1.6;
}

/* ══════════════════════════════════════════
   解説ガイド セクション
══════════════════════════════════════════ */
.guide-section {
  padding: 3.5rem 0;
  background: var(--deep);
}
.guide-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: .9rem;
  margin-top: 1.4rem;
}
@media (max-width: 640px) { .guide-grid { grid-template-columns: 1fr; } }
@media (max-width: 900px) and (min-width: 641px) { .guide-grid { grid-template-columns: repeat(2, 1fr); } }

.guide-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 1.2rem 1.1rem 1rem;
  display: flex; flex-direction: column; gap: .45rem;
  position: relative; overflow: hidden;
  transition: border-color .2s, transform .2s;
  text-decoration: none; color: inherit;
}
.guide-card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, var(--c1), var(--c2));
}
.guide-card:hover { border-color: var(--border2); transform: translateY(-2px); }
.gc-label { font-family: var(--ff-mono); font-size: .55rem; letter-spacing: .18em; color: var(--muted); text-transform: uppercase; }
.gc-title { font-family: var(--ff-serif); font-size: .9rem; font-weight: 700; color: var(--text); }
.gc-desc  { font-size: .7rem; color: var(--muted); line-height: 1.55; flex: 1; }
.gc-link  { font-family: var(--ff-mono); font-size: .65rem; color: var(--gold); letter-spacing: .06em; margin-top: .2rem; }

.guide-all {
  display: flex; justify-content: center; margin-top: 1.6rem;
}
.guide-all a {
  font-family: var(--ff-mono);
  font-size: .75rem;
  letter-spacing: .12em;
  color: var(--muted);
  text-decoration: none;
  border: 1px solid var(--border2);
  border-radius: 24px;
  padding: .5rem 1.6rem;
  transition: color .2s, border-color .2s;
}
.guide-all a:hover { color: var(--gold-lt); border-color: rgba(201,168,76,.4); }

/* ══════════════════════════════════════════
   FOOTER
══════════════════════════════════════════ */
footer {
  background: var(--void);
  padding: 2rem 1.2rem;
  text-align: center;
}
.footer-gold {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(201,168,76,.4) 30%, rgba(201,168,76,.7) 50%, rgba(201,168,76,.4) 70%, transparent);
  margin-bottom: 1.6rem;
}
.footer-links {
  display: flex; justify-content: center; flex-wrap: wrap; gap: 1.2rem;
  margin-bottom: 1rem;
}
.footer-links a {
  font-family: var(--ff-mono);
  font-size: .65rem;
  letter-spacing: .1em;
  color: var(--muted);
  text-decoration: none;
  transition: color .2s;
}
.footer-links a:hover { color: var(--gold-lt); }
.footer-copy {
  font-family: var(--ff-mono);
  font-size: .6rem;
  color: rgba(138,125,181,.35);
  letter-spacing: .1em;
}

/* ══════════════════════════════════════════
   ローディングオーバーレイ（三星鑑定用）
══════════════════════════════════════════ */
#loading-overlay {
  position: fixed; inset: 0;
  background: rgba(6,4,16,.93);
  backdrop-filter: blur(8px);
  display: none;
  justify-content: center; align-items: center;
  z-index: 9999;
}
.loader-box { text-align: center; }
.loader-crystal {
  font-size: 4.5rem;
  animation: float 2.2s ease-in-out infinite;
  filter: drop-shadow(0 0 20px rgba(122,74,158,.6));
}
@keyframes float {
  0%,100% { transform: translateY(0); }
  50%      { transform: translateY(-12px); }
}
.loader-text { margin-top: 1.2rem; font-family: var(--ff-serif); font-size: 1.2rem; color: var(--gold-lt); }
.loader-sub  { margin-top: .4rem; font-family: var(--ff-mono); font-size: .8rem; color: var(--violet-lt, #b088e0); }

/* ══ Intersection Observer アニメ ══ */
.fade-in {
  opacity: 0; transform: translateY(24px);
  transition: opacity .7s ease, transform .7s ease;
}
.fade-in.visible { opacity: 1; transform: translateY(0); }
.fade-in:nth-child(2) { transition-delay: .1s; }
.fade-in:nth-child(3) { transition-delay: .2s; }
.fade-in:nth-child(4) { transition-delay: .3s; }
.fade-in:nth-child(5) { transition-delay: .4s; }
.fade-in:nth-child(6) { transition-delay: .5s; }
.fade-in:nth-child(7) { transition-delay: .6s; }
.fade-in:nth-child(8) { transition-delay: .7s; }

@media (max-width: 600px) {
  .hero-h1 { letter-spacing: .06em; }
  .form-card { padding: 1.6rem 1.1rem 2rem; }
}
</style>
</head>
<body>

<!-- ══ HEADER ══ -->
<header class="site-header">
  <div class="header-inner">
    <a href="#" class="logo">
      <span class="logo-kamon">⛩</span>
      占い<em>Portal</em>
    </a>
    <nav class="header-nav">
      <a href="#" class="current">✦ TOP</a>
      <a href="#">タロット</a>
      <a href="#">四柱推命</a>
      <a href="#">九星気学</a>
      <a href="#">解説ガイド</a>
    </nav>
    <div class="header-right">
      <button class="sp-menu-btn" onclick="toggleMenu()">☰ メニュー</button>
    </div>
  </div>
  <div class="header-gold-line"></div>
</header>

<!-- スマホドロップダウン -->
<div class="sp-dropdown" id="spMenu">
  <a href="#">✦ トップ</a>
  <a href="#">🃏 タロット占い</a>
  <a href="#">🔯 四柱推命</a>
  <a href="#">☯ 算命学</a>
  <a href="#">⭐ 西洋占星術</a>
  <a href="#">🧠 MBTI×星座</a>
  <a href="#">🔢 数秘術</a>
  <a href="#">⭐ 九星気学</a>
  <a href="#">⚔️ RPG占い</a>
  <a href="#">💑 相性診断</a>
  <a href="#">🌀 前世診断</a>
  <a href="#">👻 守護霊診断</a>
  <a href="#">✍️ 姓名判断</a>
  <a href="#">🎭 芸名診断</a>
  <a href="#">📖 解説ガイド</a>
</div>

<!-- ══ HERO ══ -->
<section class="hero">
  <canvas id="canvas-stars"></canvas>
  <div class="hero-top-line"></div>
  <div class="hero-bottom-line"></div>

  <div class="hero-inner">
    <span class="hero-kamon">⛩</span>
    <span class="hero-eyebrow">Free Fortune Telling · 占いPortal</span>
    <div class="hero-deco"><span class="hero-deco-sym">✦ ── ✦ ── ✦</span></div>
    <h1 class="hero-h1"><span>無料占いポータル</span></h1>
    <span class="hero-sub">星と運命の交差点 · 12種類の占術で今を読み解く</span>
    <div class="hero-pillars">
      <span class="pillar">♈ 西洋占星術</span>
      <span class="pillar">🔮 タロット</span>
      <span class="pillar">☯ 四柱推命</span>
      <span class="pillar">🌙 算命学</span>
    </div>
    <div class="hero-cta">
      <a href="#sansei" class="btn-primary">✦ 三星鑑定を始める</a>
      <a href="#carousel" class="btn-outline">占いを選ぶ ▼</a>
    </div>
    <div class="hero-scroll">
      <span class="scroll-text">Scroll</span>
      <div class="scroll-line"></div>
    </div>
  </div>
</section>

<!-- wa-line -->
<div class="wa-line" id="waline1"></div>

<!-- ══ CAROUSEL ══ -->
<section class="carousel-section" id="carousel">
  <div class="wrap carousel-header">
    <span class="section-label">Choose Your Fortune</span>
    <h2 class="section-title">占いを選ぶ</h2>
    <p class="section-sub">12種類の占術から、今のあなたに合ったものを</p>
  </div>

  <div class="carousel-wrap-outer">
    <div class="carousel-track" id="carouselTrack">
      <a href="#" class="fortune-card ct-violet fade-in">
        <span class="fc-icon">🃏</span>
        <span class="fc-label">Tarot</span>
        <div class="fc-name">タロット占い</div>
        <div class="fc-desc">22枚の大アルカナから1枚を選ぶ。今のあなたへのメッセージを受け取る。</div>
        <span class="fc-btn">カードを引く →</span>
      </a>
      <a href="#" class="fortune-card ct-gold fade-in">
        <span class="fc-icon">🔯</span>
        <span class="fc-label">Shichu Suimei</span>
        <div class="fc-name">四柱推命</div>
        <div class="fc-desc">命式・十神・大運を本格算出。生年月日から人生の流れを読み解く。</div>
        <span class="fc-btn">算出する →</span>
      </a>
      <a href="#" class="fortune-card ct-teal fade-in">
        <span class="fc-icon">☯</span>
        <span class="fc-label">Sanmeigaku</span>
        <div class="fc-name">算命学鑑定</div>
        <div class="fc-desc">元命・主星・従星から才能・恋愛・仕事適性を読む性格占術。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>
      <a href="#" class="fortune-card ct-rose fade-in">
        <span class="fc-icon">⭐</span>
        <span class="fc-label">Western Astrology</span>
        <div class="fc-name">西洋占星術</div>
        <div class="fc-desc">太陽星座×内面タイプで個性・恋愛・仕事適性を深掘り鑑定。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>
      <a href="#" class="fortune-card ct-indigo fade-in">
        <span class="fc-icon">🧠</span>
        <span class="fc-label">MBTI × Zodiac</span>
        <div class="fc-name">MBTI×星座 診断</div>
        <div class="fc-desc">10の質問で性格タイプと星座の組み合わせ運命を診断する。</div>
        <span class="fc-btn">診断する →</span>
      </a>
      <a href="#" class="fortune-card ct-teal fade-in">
        <span class="fc-icon">🔢</span>
        <span class="fc-label">Numerology</span>
        <div class="fc-name">数秘術診断</div>
        <div class="fc-desc">生年月日と名前から4つの数字で人生の使命を読み解く。</div>
        <span class="fc-btn">診断する →</span>
      </a>
      <a href="#" class="fortune-card ct-amber fade-in">
        <span class="fc-icon">⭐</span>
        <span class="fc-label">Nine Star Ki</span>
        <div class="fc-name">九星気学診断</div>
        <div class="fc-desc">本命星・月命星・吉方位を無料診断。今年の運勢を読む。</div>
        <span class="fc-btn">診断する →</span>
      </a>
      <a href="#" class="fortune-card ct-green fade-in">
        <span class="fc-icon">⚔️</span>
        <span class="fc-label">RPG Fortune</span>
        <div class="fc-name">RPG占いの村</div>
        <div class="fc-desc">勇者となって占いの村を冒険しながら運命を知る。</div>
        <span class="fc-btn">冒険する →</span>
      </a>
      <a href="#" class="fortune-card ct-rose fade-in">
        <span class="fc-icon">💑</span>
        <span class="fc-label">Compatibility</span>
        <div class="fc-name">二人の相性診断</div>
        <div class="fc-desc">星座と数秘術で恋愛・結婚の相性を鑑定する。</div>
        <span class="fc-btn">診断する →</span>
      </a>
      <a href="#" class="fortune-card ct-cyan fade-in">
        <span class="fc-icon">🌀</span>
        <span class="fc-label">Past Life</span>
        <div class="fc-name">前世診断</div>
        <div class="fc-desc">あなたは何回目の転生？魂のカルテを読み解く。</div>
        <span class="fc-btn">診断する →</span>
      </a>
      <a href="#" class="fortune-card ct-gold fade-in">
        <span class="fc-icon">👻</span>
        <span class="fc-label">Guardian Spirit</span>
        <div class="fc-name">守護霊診断</div>
        <div class="fc-desc">あなたを守る霊はUR？SSR？レアリティ付き守護霊を召喚。</div>
        <span class="fc-btn">召喚する →</span>
      </a>
      <a href="#" class="fortune-card ct-violet fade-in">
        <span class="fc-icon">✍️</span>
        <span class="fc-label">Seimei Handan</span>
        <div class="fc-name">姓名判断</div>
        <div class="fc-desc">名前に宿る運命を五格で鑑定。天格・人格・総格から運勢を読む。</div>
        <span class="fc-btn">鑑定する →</span>
      </a>
      <a href="#" class="fortune-card ct-amber fade-in">
        <span class="fc-icon">🎭</span>
        <span class="fc-label">Geimei</span>
        <div class="fc-name">芸名診断</div>
        <div class="fc-desc">大喜利ゲームで芸風を判定！画数から大吉の芸名を3パターン提案。</div>
        <span class="fc-btn">診断する →</span>
      </a>
    </div><!-- /carousel-track -->

    <div class="carousel-controls">
      <button class="carousel-arrow" id="prevBtn" onclick="slideCarousel(-1)">‹</button>
      <div class="carousel-dots" id="carouselDots"></div>
      <button class="carousel-arrow" id="nextBtn" onclick="slideCarousel(1)">›</button>
    </div>
  </div>
</section>

<div class="wa-line" id="waline2"></div>

<!-- ══ 今日の開運情報 ══ -->
<section class="oracle-section">
  <div class="oracle-inner">
    <span class="section-label">Daily Oracle</span>
    <h2 class="section-title">今日の開運情報</h2>
    <span class="oracle-date">2026年6月30日（月）· Rokuyo · Lucky Guide</span>

    <div class="oracle-grid fade-in">
      <div class="rokuyo-box">
        <div class="rokuyo-name">赤口</div>
        <div class="rokuyo-en">SHAKKU</div>
      </div>
      <div class="oracle-right">
        <p class="oracle-desc">
          午の刻（11〜13時）のみ吉。火や血に関することは慎む日とされています。
          静かに過ごすことが運気を保つ秘訣。焦らず、丁寧に一歩一歩進みましょう。
        </p>
        <div class="oracle-msg">
          「直感を信じて行動しましょう。日常に隠れた小さな幸せに気づく日。」
        </div>
        <div class="oracle-chips">
          <div class="ochip"><span class="ochip-label">COLOR</span>&nbsp;ラベンダー</div>
          <div class="ochip"><span class="ochip-label">NO.</span>&nbsp;7</div>
          <div class="ochip"><span class="ochip-label">FOOD</span>&nbsp;抹茶ラテ</div>
          <div class="ochip"><span class="ochip-label">ITEM</span>&nbsp;天然石ブレスレット</div>
          <div class="ochip"><span class="ochip-label">ACTION</span>&nbsp;深呼吸を3回</div>
        </div>
        <div class="oracle-link">
          <a href="#">詳しい開運カレンダーを見る →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="wa-line" id="waline3"></div>

<!-- ══ 三星鑑定フォーム ══ -->
<section class="sansei-section" id="sansei">
  <div class="wrap">
    <span class="section-label">Integrated Reading</span>
    <h2 class="section-title">三星統合鑑定</h2>
    <p class="section-sub">西洋占星術 × タロット × 四柱推命 — 三つの叡智で運命を読み解く</p>

    <div class="form-card fade-in">
      <h2>✦ 鑑定情報を入力 ✦</h2>
      <p class="form-card-sub">お名前と生年月日だけで鑑定開始</p>
      <div class="field">
        <label for="name">お名前（ニックネーム可）</label>
        <input type="text" id="name" placeholder="例：さくら">
      </div>
      <div class="field">
        <label for="birthday">生年月日</label>
        <input type="date" id="birthday">
      </div>
      <button class="btn-submit" onclick="showLoader()">✦ 三星鑑定を開始する ✦</button>
      <p class="form-note">
        ※ エンターテインメント目的の占いコンテンツです<br>
        入力情報はサーバーに保存されません
      </p>
    </div>
  </div>
</section>

<div class="wa-line" id="waline4"></div>

<!-- ══ 解説ガイド ══ -->
<section class="guide-section">
  <div class="wrap">
    <span class="section-label">Articles · Guide</span>
    <h2 class="section-title">占い解説ガイド</h2>
    <p class="section-sub">各占術の仕組み・歴史・読み方をわかりやすく解説</p>

    <div class="guide-grid">
      <a href="#" class="guide-card fade-in" style="--c1:#9b72ef;--c2:#e8719a">
        <span class="gc-label">Tarot</span>
        <div class="gc-title">🃏 タロット占いとは</div>
        <div class="gc-desc">大アルカナ22枚の意味・歴史・正位置逆位置の読み方を完全解説</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="#" class="guide-card fade-in" style="--c1:#c9a84c;--c2:#9b72ef">
        <span class="gc-label">Shichu Suimei</span>
        <div class="gc-title">🔯 四柱推命とは</div>
        <div class="gc-desc">命式・十神・大運・天中殺の見方と意味をわかりやすく解説</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="#" class="guide-card fade-in" style="--c1:#4ecdc4;--c2:#c9a84c">
        <span class="gc-label">Numerology</span>
        <div class="gc-title">🔢 数秘術とは</div>
        <div class="gc-desc">ライフパスナンバー・運命数・魂の数字の計算方法と意味</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="#" class="guide-card fade-in" style="--c1:#e8719a;--c2:#9b72ef">
        <span class="gc-label">MBTI</span>
        <div class="gc-title">🧠 MBTIとは</div>
        <div class="gc-desc">16タイプの性格分類・各タイプの特徴と相性を徹底解説</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="#" class="guide-card fade-in" style="--c1:#9b72ef;--c2:#4ecdc4">
        <span class="gc-label">Nine Star Ki</span>
        <div class="gc-title">⭐ 九星気学とは</div>
        <div class="gc-desc">本命星・月命星の求め方と吉方位・今年の運勢の見方</div>
        <span class="gc-link">解説を読む →</span>
      </a>
      <a href="#" class="guide-card fade-in" style="--c1:#c9a84c;--c2:#4ecdc4">
        <span class="gc-label">Sanmeigaku</span>
        <div class="gc-title">☯ 算命学とは</div>
        <div class="gc-desc">元命・主星・従星から才能と本質を読み解く東洋占術の基礎</div>
        <span class="gc-link">解説を読む →</span>
      </a>
    </div>

    <div class="guide-all">
      <a href="#">すべての解説を見る（全12カテゴリ）→</a>
    </div>
  </div>
</section>

<!-- ══ FOOTER ══ -->
<footer>
  <div class="footer-gold"></div>
  <div class="footer-links">
    <a href="#">プライバシーポリシー</a>
    <a href="#">免責事項</a>
    <a href="#">お問い合わせ</a>
    <a href="#">プロフィール</a>
  </div>
  <p class="footer-copy">© 2026 占いPortal — Entertainment Fortune Telling</p>
</footer>

<!-- ローディング -->
<div id="loading-overlay">
  <div class="loader-box">
    <div class="loader-crystal">🔮</div>
    <div class="loader-text">鑑定中…</div>
    <div class="loader-sub">星々からのメッセージを受信しています</div>
  </div>
</div>

<!-- ══════════════════════════════════════════
   JavaScript
══════════════════════════════════════════ -->
<script>
/* ── Canvas 星空 ── */
(function() {
  const canvas = document.getElementById('canvas-stars');
  const ctx    = canvas.getContext('2d');
  let W, H, stars = [], meteors = [];

  function resize() {
    W = canvas.width  = canvas.offsetWidth;
    H = canvas.height = canvas.offsetHeight;
  }

  function initStars() {
    stars = [];
    const n = Math.floor(W * H / 3200);
    for (let i = 0; i < n; i++) {
      stars.push({
        x: Math.random() * W,
        y: Math.random() * H,
        r: Math.random() * 1.2 + .2,
        a: Math.random(),
        speed: Math.random() * .004 + .002,
        phase: Math.random() * Math.PI * 2
      });
    }
  }

  function spawnMeteor() {
    meteors.push({
      x: Math.random() * W * 1.5,
      y: Math.random() * H * .4,
      len: Math.random() * 120 + 60,
      speed: Math.random() * 6 + 4,
      a: 1,
      angle: Math.PI / 5
    });
  }

  let frame = 0;
  function draw() {
    ctx.clearRect(0, 0, W, H);

    /* 星 */
    const t = Date.now() * .001;
    stars.forEach(s => {
      const alpha = s.a * (.5 + .5 * Math.sin(t * s.speed * 6 + s.phase));
      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(220,210,255,${alpha})`;
      ctx.fill();
    });

    /* 流星 */
    meteors = meteors.filter(m => m.a > 0);
    meteors.forEach(m => {
      const dx = Math.cos(m.angle) * m.len;
      const dy = Math.sin(m.angle) * m.len;
      const g  = ctx.createLinearGradient(m.x, m.y, m.x - dx, m.y - dy);
      g.addColorStop(0, `rgba(201,168,76,${m.a})`);
      g.addColorStop(1, 'rgba(201,168,76,0)');
      ctx.beginPath();
      ctx.moveTo(m.x, m.y);
      ctx.lineTo(m.x - dx, m.y - dy);
      ctx.strokeStyle = g;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      m.x += Math.cos(m.angle) * m.speed;
      m.y += Math.sin(m.angle) * m.speed;
      m.a -= .015;
    });

    if (++frame % 220 === 0) spawnMeteor();
    requestAnimationFrame(draw);
  }

  window.addEventListener('resize', () => { resize(); initStars(); });
  resize(); initStars(); draw();
  setTimeout(spawnMeteor, 1500);
})();

/* ── カルーセル ── */
(function() {
  const track  = document.getElementById('carouselTrack');
  const dotsWrap = document.getElementById('carouselDots');
  const cards  = track.querySelectorAll('.fortune-card');
  const perView = () => window.innerWidth < 600 ? 1 : window.innerWidth < 900 ? 2 : 3;
  let current  = 0;

  /* ドット生成 */
  function buildDots() {
    dotsWrap.innerHTML = '';
    const pages = Math.ceil(cards.length / perView());
    for (let i = 0; i < pages; i++) {
      const d = document.createElement('div');
      d.className = 'cdot' + (i === current ? ' active' : '');
      d.onclick = () => goTo(i);
      dotsWrap.appendChild(d);
    }
  }

  function goTo(idx) {
    const pages = Math.ceil(cards.length / perView());
    current = Math.max(0, Math.min(idx, pages - 1));
    const cardW = cards[0].offsetWidth + 13; /* gap */
    track.scrollTo({ left: current * perView() * cardW, behavior: 'smooth' });
    dotsWrap.querySelectorAll('.cdot').forEach((d, i) =>
      d.classList.toggle('active', i === current));
  }

  window.slideCarousel = (dir) => goTo(current + dir);

  track.addEventListener('scroll', () => {
    const cardW = cards[0].offsetWidth + 13;
    const idx = Math.round(track.scrollLeft / (perView() * cardW));
    current = idx;
    dotsWrap.querySelectorAll('.cdot').forEach((d, i) =>
      d.classList.toggle('active', i === current));
  }, { passive: true });

  window.addEventListener('resize', () => { buildDots(); });
  buildDots();
})();

/* ── IntersectionObserver：wa-line & fade-in ── */
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
    }
  });
}, { threshold: .15 });

document.querySelectorAll('.wa-line, .fade-in').forEach(el => io.observe(el));

/* ── スマホメニュー ── */
window.toggleMenu = function() {
  document.getElementById('spMenu').classList.toggle('open');
};
document.addEventListener('click', e => {
  if (!e.target.closest('.sp-menu-btn') && !e.target.closest('.sp-dropdown'))
    document.getElementById('spMenu').classList.remove('open');
});

/* ── ローディング（デモ用） ── */
window.showLoader = function() {
  document.getElementById('loading-overlay').style.display = 'flex';
  setTimeout(() => {
    document.getElementById('loading-overlay').style.display = 'none';
    alert('※ デザインデモのため鑑定結果は表示されません');
  }, 2200);
};
</script>
</body>
</html>
