// Phase1b-2: 純粋な描画専用モジュール。GameEngineを一切importしない。
// 受け取るのは「盤面の状態を表すプレーンなデータ」のみで、ゲームロジックには関与しない。
// D-0064（Q-030）：DIAGNOSIS_TRAIT_TEXTはGameEngine非依存の静的なラベル辞書のため、
// 上記の制約（GameEngine非依存）には抵触しない。Trait表示名の二重管理を避けるためこれを再利用する。

import { DIAGNOSIS_TRAIT_TEXT } from '../core/diagnosisGlossary.js';

const CELL_SIZE = 56;
const BOARD_PIXELS = CELL_SIZE * 8;
const STONE_RADIUS = CELL_SIZE * 0.38;

// D-0075（実装移植Step1）：黒曜石調の盤面＋C+案の石。ハート型は不採用、円形＋色＋光で
// 恋愛感を表現する（project memory: project_reversi_love_game参照）。演出（波紋・グロー等）は
// Step1のスコープ外で、ここでは静止画として完成した盤面のみを扱う。
const STONE_PALETTE = {
  BLACK: { hi: '#e3d4ff', mid: '#9b72ef', edge: '#3d2470', rim: 'rgba(228,201,255,.55)', fleckHi: '#ffe9c2' },
  WHITE: { hi: '#ffe9c2', mid: '#e8719a', edge: '#5a2338', rim: 'rgba(255,224,170,.55)', fleckHi: '#e3d4ff' },
};

function drawObsidianBg(ctx, size) {
  const diag = ctx.createLinearGradient(0, 0, size, size);
  diag.addColorStop(0, '#2d3244');
  diag.addColorStop(0.5, '#1f2330');
  diag.addColorStop(1, '#14172180');
  ctx.fillStyle = diag;
  ctx.fillRect(0, 0, size, size);
  const vign = ctx.createRadialGradient(size * 0.5, size * 0.42, size * 0.05, size * 0.5, size * 0.5, size * 0.72);
  vign.addColorStop(0, 'rgba(38,42,58,.55)');
  vign.addColorStop(1, 'rgba(24,27,40,0)');
  ctx.fillStyle = vign;
  ctx.fillRect(0, 0, size, size);
}

function drawCellBevel(ctx, size) {
  const cell = size / 8;
  for (let r = 0; r < 8; r++) {
    for (let c = 0; c < 8; c++) {
      const x = c * cell, y = r * cell;
      const cg = ctx.createLinearGradient(x, y, x, y + cell);
      cg.addColorStop(0, 'rgba(255,255,255,.025)');
      cg.addColorStop(1, 'rgba(0,0,0,.055)');
      ctx.fillStyle = cg;
      ctx.fillRect(x, y, cell, cell);
    }
  }
}

/** 星図・天球図風の極薄い魔法陣。「見るもの」ではなく「感じるもの」に留める不透明度にする。 */
function drawMagicCircle(ctx, cx, cy, mr) {
  ctx.save();
  ctx.strokeStyle = '#e8c96a';
  ctx.lineWidth = 1;
  ctx.globalAlpha = 0.04;
  ctx.beginPath(); ctx.arc(cx, cy, mr, 0, Math.PI * 2); ctx.stroke();
  ctx.beginPath(); ctx.arc(cx, cy, mr * 0.16, 0, Math.PI * 2); ctx.stroke();
  for (let i = 0; i < 12; i++) {
    const a = i * (Math.PI * 2 / 12);
    const rIn = mr * (0.5 + (i % 3) * 0.02);
    const rOut = mr * (0.9 + ((i * 7) % 5) * 0.012);
    ctx.beginPath();
    ctx.moveTo(cx + rIn * Math.cos(a), cy + rIn * Math.sin(a));
    ctx.lineTo(cx + rOut * Math.cos(a), cy + rOut * Math.sin(a));
    ctx.stroke();
  }
  ctx.strokeStyle = '#c4a8f5';
  ctx.globalAlpha = 0.032;
  ctx.save(); ctx.translate(cx, cy); ctx.rotate(0.42);
  ctx.beginPath(); ctx.ellipse(0, 0, mr * 0.78, mr * 0.40, 0, 0, Math.PI * 2); ctx.stroke();
  ctx.restore();
  ctx.save(); ctx.translate(cx, cy); ctx.rotate(-0.63);
  ctx.beginPath(); ctx.ellipse(0, 0, mr * 0.66, mr * 0.30, 0, 0, Math.PI * 2); ctx.stroke();
  ctx.restore();
  ctx.globalAlpha = 0.06;
  ctx.fillStyle = '#e8c96a';
  const stars = [[0.32, -0.82], [-0.58, -0.38], [0.68, 0.33], [-0.22, 0.74], [0.02, -0.2], [-0.72, 0.18], [0.5, -0.55], [-0.4, 0.55]];
  stars.forEach(([sx, sy]) => { ctx.beginPath(); ctx.arc(cx + sx * mr, cy + sy * mr, 1.3, 0, Math.PI * 2); ctx.fill(); });
  ctx.restore();
}

function drawGridLines(ctx, size, opacity) {
  const cell = size / 8;
  ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
  ctx.lineWidth = 1;
  for (let i = 1; i < 8; i++) {
    ctx.beginPath(); ctx.moveTo(i * cell, 0); ctx.lineTo(i * cell, size); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(0, i * cell); ctx.lineTo(size, i * cell); ctx.stroke();
  }
}

/** セル交点のごく小さな金の鋲。石が増えるほど自然に隠れるよう、石数に応じて薄くする。 */
function drawStuds(ctx, size, opacity) {
  const cell = size / 8;
  ctx.save();
  ctx.globalAlpha = opacity;
  ctx.fillStyle = '#e8c96a';
  for (let r = 1; r < 8; r++) {
    for (let c = 1; c < 8; c++) {
      ctx.beginPath(); ctx.arc(c * cell, r * cell, 1.4, 0, Math.PI * 2); ctx.fill();
    }
  }
  ctx.restore();
}

/** ゴールドの二重額縁。外側はindex.htmlのCSS(border)側で描く前提で、ここでは内側の細い線だけ描く。 */
function drawInnerFrameLine(ctx, size) {
  ctx.strokeStyle = 'rgba(255,215,120,.30)';
  ctx.lineWidth = 1.5;
  ctx.strokeRect(0.75, 0.75, size - 1.5, size - 1.5);
  ctx.strokeStyle = 'rgba(232,201,106,.16)';
  ctx.lineWidth = 1;
  const inset = Math.max(6, size * 0.014);
  ctx.strokeRect(inset, inset, size - inset * 2, size - inset * 2);
}

/**
 * C+案の石。円形＋属性ごとに左右反転したハイライト＋相手の色を淡く忍ばせるフレック。
 * D-0082：反転アニメーション（effectManager.jsの_drawFlip）が同じ描画ロジックを再利用するため
 * export する（Glow実装時にSTONE_PIXEL_RADIUSをexportしたのと同じ理由：実装の重複を避ける）。
 */
export function drawStone(ctx, cx, cy, r, player) {
  const c = STONE_PALETTE[player];
  ctx.save();
  ctx.shadowColor = 'rgba(0,0,0,.5)';
  ctx.shadowBlur = r * 0.35;
  ctx.shadowOffsetY = r * 0.12;
  ctx.beginPath(); ctx.arc(cx, cy, r, 0, Math.PI * 2);
  const g = ctx.createRadialGradient(cx - r * 0.36, cy - r * 0.42, r * 0.12, cx, cy, r * 1.15);
  g.addColorStop(0, c.hi); g.addColorStop(0.42, c.mid); g.addColorStop(1, c.edge);
  ctx.fillStyle = g;
  ctx.fill();
  ctx.restore();

  ctx.beginPath(); ctx.arc(cx, cy, r, 0, Math.PI * 2);
  ctx.lineWidth = Math.max(0.8, r * 0.045);
  ctx.strokeStyle = c.rim;
  ctx.stroke();

  const flip = player === 'WHITE';
  const hx = cx + (flip ? r * 0.32 : -r * 0.32), hy = cy + (flip ? r * 0.38 : -r * 0.36);
  ctx.beginPath(); ctx.ellipse(hx, hy, r * 0.26, r * 0.15, -0.5, 0, Math.PI * 2);
  ctx.fillStyle = 'rgba(255,255,255,.32)';
  ctx.fill();

  const fx = cx + (flip ? -r * 0.5 : r * 0.5), fy = cy + (flip ? -r * 0.45 : r * 0.45);
  ctx.save();
  ctx.globalAlpha = 0.4;
  const f = ctx.createRadialGradient(fx, fy, 0, fx, fy, r * 0.4);
  f.addColorStop(0, c.fleckHi); f.addColorStop(1, 'rgba(0,0,0,0)');
  ctx.beginPath(); ctx.arc(fx, fy, r * 0.34, 0, Math.PI * 2);
  ctx.fillStyle = f;
  ctx.fill();
  ctx.restore();
}

/**
 * @typedef {Object} BoardViewState
 * @property {(string|null)[][]} cells 8x8、'BLACK'|'WHITE'|null
 * @property {{row:number, col:number}[]} legalMoves 現在の手番が置ける場所（人間の手番のときだけ渡す）
 * @property {string} currentPlayer 'BLACK'|'WHITE'
 * @property {boolean} finished
 */

/**
 * @param {CanvasRenderingContext2D} ctx
 * @param {BoardViewState} state
 */
export function renderBoard(ctx, state) {
  ctx.clearRect(0, 0, BOARD_PIXELS, BOARD_PIXELS);
  drawObsidianBg(ctx, BOARD_PIXELS);
  drawCellBevel(ctx, BOARD_PIXELS);
  drawMagicCircle(ctx, BOARD_PIXELS / 2, BOARD_PIXELS / 2, CELL_SIZE * 1.85);
  drawGridLines(ctx, BOARD_PIXELS, 0.04);

  const stoneCount = state.cells.flat().filter(Boolean).length;
  drawStuds(ctx, BOARD_PIXELS, Math.max(0.04, 0.30 - stoneCount * 0.0045));
  drawInnerFrameLine(ctx, BOARD_PIXELS);

  // 置ける場所のヒント：ゴールド寄りの控えめな不透明度（黒曜石・額縁・魔法陣で既に金色要素が
  // 多いため、「気付けば見える」程度に抑える）
  if (!state.finished) {
    ctx.fillStyle = 'rgba(232,201,106,.28)';
    for (const m of state.legalMoves) {
      const cx = m.col * CELL_SIZE + CELL_SIZE / 2;
      const cy = m.row * CELL_SIZE + CELL_SIZE / 2;
      ctx.beginPath();
      ctx.arc(cx, cy, STONE_RADIUS * 0.4, 0, Math.PI * 2);
      ctx.fill();
    }
  }
}

/**
 * D-0077：石だけを描画する。renderBoard()（盤面装飾のみ）と責務を分離し、Controller側で
 * EffectManagerのdrawBelowStone()/drawAboveStone()をこの前後に挟めるようにする
 * （盤面→盤面側エフェクト→石→石側エフェクト、という重なり順を実現するため）。
 * @param {CanvasRenderingContext2D} ctx
 * @param {BoardViewState} state
 */
export function renderStones(ctx, state) {
  for (let r = 0; r < 8; r++) {
    for (let c = 0; c < 8; c++) {
      const p = state.cells[r][c];
      if (!p) continue;
      const cx = c * CELL_SIZE + CELL_SIZE / 2;
      const cy = r * CELL_SIZE + CELL_SIZE / 2;
      drawStone(ctx, cx, cy, STONE_RADIUS, p);
    }
  }
}

/**
 * D-0084：結果表示中、盤面全体を落ち着かせるための固定の暗転。時間経過を伴わない「状態」であり
 * アニメーションではないため、EffectManagerではなくRenderer側の静的な描画として扱う。
 * @param {CanvasRenderingContext2D} ctx
 * @param {boolean} dimmed
 */
export function renderDimOverlay(ctx, dimmed) {
  if (!dimmed) return;
  ctx.save();
  ctx.fillStyle = 'rgba(0,0,0,0.2)';
  ctx.fillRect(0, 0, BOARD_PIXELS, BOARD_PIXELS);
  ctx.restore();
}

/** @param {HTMLElement} el @param {string} text */
export function renderStatus(el, text) {
  el.textContent = text;
}

/**
 * Deprecated by D-0072（D-0067の方針をUI接続で反映：ユーザーに見せる主役はTraitではなく占い結果）。
 * web/ui/controller.jsからは呼ばれていない。D-0066と同様の方針で関数自体は削除せず残す。
 *
 * D-0064：Traitバーが結果画面の主役になったため、表示名はGLOSSARY.md/DIAGNOSIS_TRAIT_TEXTの
 * 確定名称を使う（英語キーの直接表示はしない）。highlightedTraitを渡すと、その行を強調表示する。
 * @param {HTMLElement} el
 * @param {import('../core/traits.js').Traits} traits
 * @param {string} [highlightedTrait] Highlight Trait（Q-030・D-0065、ZScoreで選定）のキー
 */
export function renderTraits(el, traits, highlightedTrait) {
  const rows = Object.keys(DIAGNOSIS_TRAIT_TEXT).map((key) => [key, DIAGNOSIS_TRAIT_TEXT[key], traits[key]]);
  el.innerHTML = rows
    .map(
      ([key, label, value]) => `
      <div class="trait-row${key === highlightedTrait ? ' trait-row-highlighted' : ''}">
        <span class="trait-label">${label}</span>
        <div class="trait-bar-bg"><div class="trait-bar-fill" style="width:${value}%"></div></div>
        <span class="trait-value">${value.toFixed(1)}</span>
      </div>`
    )
    .join('');
}

/**
 * Deprecated by D-0072（renderTraitsと同じ理由）。web/ui/controller.jsからは呼ばれていない。
 *
 * D-0064/Q-030（D-0065）：Highlight Trait（最も特徴的な1特性）と、それに対応する短文コメントを表示する。
 * 短文はTraitのみを入力とする最小テンプレート（highlightText.js、Phase 2は1特性1文のみ）。
 * @param {HTMLElement} el
 * @param {{traitKey: string, text: string}} highlight
 */
export function renderHighlight(el, highlight) {
  const label = DIAGNOSIS_TRAIT_TEXT[highlight.traitKey] ?? highlight.traitKey;
  el.innerHTML = `
    <div class="highlight-label">今回もっとも目立った特性</div>
    <div class="highlight-trait">${label}</div>
    <div class="highlight-text">${highlight.text}</div>
  `;
}

/**
 * D-0064：おすすめ占い（回遊導線）。MovementPatternを使った内部ロジックの担当だが、
 * Phase 2はrecommendations.jsの固定マッピングによる最小実装。
 * @param {HTMLElement} el
 * @param {{label: string, href: string}[]} items
 */
export function renderRecommendations(el, items) {
  el.innerHTML = `
    <div class="reco-label">あなたにおすすめの占い</div>
    ${items.map((i) => `<a class="reco-link" href="${i.href}">${i.label}</a>`).join('')}
  `;
}

function easeOutBack(t) {
  const c1 = 1.70158;
  const c3 = c1 + 1;
  return 1 + c3 * Math.pow(t - 1, 3) + c1 * Math.pow(t - 1, 2);
}

/** D-0085：静かな装飾のみの金の二重リング。スコア数値の「舞台」として背後に据え置く（動かさない）。 */
function renderGoldRing() {
  return `
    <svg class="fortune-score-ring" viewBox="0 0 120 120" width="120" height="120" aria-hidden="true">
      <circle cx="60" cy="60" r="54" fill="none" stroke="#e8c96a" stroke-width="1.5" opacity="0.35"/>
      <circle cx="60" cy="60" r="44" fill="none" stroke="#b58d45" stroke-width="1" opacity="0.25"/>
    </svg>
  `;
}

/**
 * D-0085：スコア以外（アドバイス／ラッキーカラー／ラッキーアイテム／オセロの得点）の静的表示。
 * @param {{advice: string, luckyColor: string, luckyItem: string, blackScore: number, whiteScore: number}} result
 */
function renderStaticFields(result) {
  return `
    <div class="fortune-advice">${result.advice}</div>
    <div class="fortune-row"><span class="fortune-label">ラッキーカラー</span><span class="fortune-value">${result.luckyColor}</span></div>
    <div class="fortune-row"><span class="fortune-label">ラッキーアイテム</span><span class="fortune-value">${result.luckyItem}</span></div>
    <div class="fortune-row"><span class="fortune-label">オセロの得点</span><span class="fortune-value">${result.blackScore} - ${result.whiteScore}</span></div>
  `;
}

/**
 * D-0085：スコア数値を0→targetへ900msでカウントアップする。ease-out-backで一度targetを
 * 超えてから収束させる「オーバーシュート」を表現するが、最終フレームは必ずtargetそのものに
 * 固定する（丸め誤差でtargetからずれたまま止まることを防ぐ）。
 * @param {HTMLElement} el
 * @param {number} target
 */
function animateScore(el, target, duration = 900) {
  const start = performance.now();
  function tick(now) {
    const t = Math.min(1, (now - start) / duration);
    if (t < 1) {
      el.textContent = `${Math.round(target * easeOutBack(t))}%`;
      requestAnimationFrame(tick);
    } else {
      el.textContent = `${target}%`;
    }
  }
  requestAnimationFrame(tick);
}

/**
 * D-0072：占い結果画面（総合運%／一言アドバイス／ラッキーカラー／ラッキーアイテム／オセロの得点）。
 * D-0067でユーザー向け表示の主役をTraitからこちらへ戻した。総合運%はD-0073（Q-020確定）で追加。
 * D-0085：総合運%にゴールドリング（静的装飾）とease-out-backのカウントアップを追加。
 * controller.jsからは今まで通り1回呼ぶだけでよく、タイミング調整（D-0084のRESULT_SHOWN遷移）は
 * 呼び出し側の責務のまま変えていない。この関数の中だけで「見せ方」を完結させる。
 * @param {HTMLElement} el
 * @param {{score: number, advice: string, luckyColor: string, luckyItem: string, blackScore: number, whiteScore: number}} result
 */
export function renderFortuneResult(el, result) {
  el.innerHTML = `
    <div class="fortune-score">総合運 <span class="fortune-score-stage">${renderGoldRing()}<span class="fortune-score-value">0%</span></span></div>
    ${renderStaticFields(result)}
  `;
  animateScore(el.querySelector('.fortune-score-value'), result.score);
}

/**
 * Phase1b-3準備：SelfRelation/FortuneIndexのデバッグ表示。D-0072以降はユーザー向けUIではなく、
 * 開発用デバッグ表示として維持する（Q-020の総合運％算出式の検討・内部ロジック検証に使う）。
 * @param {HTMLElement} el
 * @param {import('../core/relationshipModel.js').SelfRelation} selfRelation
 * @param {import('../core/fortuneIndex.js').FortuneIndex} fortuneIndex
 */
export function renderRelationship(el, selfRelation, fortuneIndex, diagnosis) {
  const dominant = selfRelation.dominantTrait
    ? `${selfRelation.dominantTrait} ${selfRelation.direction === 'UP' ? '↑' : '↓'}`
    : '—';
  const fmt = (v) => (v === undefined ? '—' : v.toFixed(2));
  // D-0055：diagnosis.band/concentrationScoreは開発者向けのデバッグ情報。プレイヤー向けの診断結果パネル
  // （renderDiagnosisText）には含めず、こちらの内部値デバッグ表示にのみ出す（プレイテストで「参考値を
  // どう見ればいいのか」という混乱を招いたため分離した）。
  const diagnosisMeta = diagnosis && diagnosis.band !== undefined
    ? `<div class="rel-row">Diagnosis band: ${diagnosis.band}（concentrationScore: ${diagnosis.concentrationScore.toFixed(3)}）</div>`
    : '';
  el.innerHTML = `
    <div class="rel-row">Phase: <strong>${fortuneIndex.phase}</strong> （SelfRelation: ${selfRelation.state}）</div>
    <div class="rel-row">Dominant: ${dominant}</div>
    <div class="rel-row">Intensity: ${fmt(fortuneIndex.intensity)}</div>
    <div class="rel-row">Confidence: ${fmt(fortuneIndex.confidence)}</div>
    <div class="rel-row">deltaMagnitude: ${fmt(selfRelation.deltaMagnitude)}</div>
    ${diagnosisMeta}
  `;
}

/**
 * Deprecated by D-0064（D-0066で明文化）。web/ui/controller.jsからは呼ばれていない
 * （renderHighlight/renderRecommendationsに置き換わった）。diagnosis.js等と同様、Phase 3の結果を見て
 * 削除するかどうかを判断するまで残す。
 *
 * D-0045〜D-0047：Diagnosis層が生成した診断文を表示する。SelfRelation/FortuneIndexのデバッグ表示
 * （renderRelationship）とは別関数として分離する（Diagnosisは「文章表現」という独立した責務のため、
 * 数値デバッグ表示と混ぜない）。
 * D-0055：band/concentrationScoreの参考表示は、プレイヤー向けのこの関数からは削除した（プレイテストで
 * デバッグ情報の露出が診断文評価の妨げになったため）。開発者向けの値はrenderRelationship側に移した。
 * @param {HTMLElement} el
 * @param {import('../core/diagnosis.js').DiagnosisResult} diagnosis
 */
export function renderDiagnosisText(el, diagnosis) {
  el.innerHTML = `
    <div class="diagnosis-text">${diagnosis.text}</div>
  `;
}

export const BOARD_PIXEL_SIZE = BOARD_PIXELS;
export const CELL_PIXEL_SIZE = CELL_SIZE;
export const STONE_PIXEL_RADIUS = STONE_RADIUS;
