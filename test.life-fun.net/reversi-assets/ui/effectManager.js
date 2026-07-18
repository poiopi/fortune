// D-0075：controller.js/renderer.jsから完全に独立した「時間依存演出」専用モジュール。
// GameEngineを一切知らない。row/col（Move等の既存コードと同じ座標系）でイベントを受け取り、
// 内部で経過時間を管理し、draw(ctx)で描画するだけ。rendererはこのモジュールの存在を知らない
// （一方向の関係：EffectManagerはrenderer.jsのCELL_PIXEL_SIZEを参照するが、逆はない）。
//
// 公開APIは最小限に保つ（YAGNI）。Step3以降の拡張（グロー・盤面の呼吸・終局の光）は、
// onStonePlaced()内部でthis._createGlow()等の呼び出しを増やすだけで済むようにし、
// 公開APIの形は変えない。

import { CELL_PIXEL_SIZE, STONE_PIXEL_RADIUS, BOARD_PIXEL_SIZE, drawStone } from './renderer.js';

const HALF_CELL = CELL_PIXEL_SIZE / 2;

// D-0078：Glowは石と同じ色（属性色）を、石の色そのものではなく光として使う。
const GLOW_RGB = {
  BLACK: '138,108,255', // バイオレット
  WHITE: '233,176,152', // ローズゴールド
};

function easeOutCubic(t) {
  return 1 - Math.pow(1 - t, 3);
}

// D-0080：終局の光（Sweep）。「盤面がわずかに明るくなる→紫→ローズの光が斜めに流れる→静止」の3フェーズ。
const SWEEP_BRIGHTEN_MS = 150;
const SWEEP_BAND_MS = 320;
const SWEEP_HOLD_MS = 280; // このフェーズでは何も描画しない＝「静止」そのもの
const SWEEP_START_RGB = [138, 108, 255]; // バイオレット（GLOW_RGB.BLACKと同じ色）
const SWEEP_END_RGB = [233, 176, 152]; // ローズゴールド（GLOW_RGB.WHITEと同じ色）

function lerpColor(a, b, t) {
  const r = Math.round(a[0] + (b[0] - a[0]) * t);
  const g = Math.round(a[1] + (b[1] - a[1]) * t);
  const b2 = Math.round(a[2] + (b[2] - a[2]) * t);
  return `${r},${g},${b2}`;
}

export class EffectManager {
  constructor() {
    this._effects = [];
  }

  /**
   * 石が置かれた（反転を含む）ことの通知。
   * @param {{row: number, col: number, player: string, isFinalMove?: boolean}} event
   */
  onStonePlaced({ row, col, player, isFinalMove = false }) {
    this._createBoardBreathe();
    this._createRipple(row, col);
    // 「運命が確定した石」＝最後の一手だけ、通常の1.6倍のスケールでGlowを強調する（意味づけであり演出だけの都合ではない）
    this._createGlow({ row, col, player, scale: isFinalMove ? 1.6 : 1.0 });
  }

  /**
   * D-0080：対局終了の通知。演出側は「終了した」という事実だけを受け取り、勝敗・スコア・
   * 終局理由等のゲームロジックには一切依存しない（Result生成・表示側の責務）。optionsは
   * 将来の拡張（引き分け専用演出等）の受け口だが、現時点では中身を参照しない（YAGNI）。
   * @param {object} [options]
   */
  onGameFinished(options = {}) {
    this._createSweep();
  }

  /**
   * D-0082：「石を置いた」（onStonePlaced）とは別の事実——「既存の石が反転した」ことの通知。
   * 1回の着手で0〜20個以上発生しうる。flippedCellsは{row,col,fromPlayer,toPlayer}のみを
   * 受け取り、アニメーション時間・progress・easing・描画情報はここで生成する
   * （Controllerは「何が反転したか」を伝えるだけに責務を留める）。
   * @param {{row:number, col:number, fromPlayer:string, toPlayer:string}[]} flippedCells
   */
  onStonesFlipped(flippedCells) {
    for (const cell of flippedCells) {
      this._createFlip(cell);
    }
  }

  /**
   * @param {{row:number, col:number, fromPlayer:string, toPlayer:string}} args
   */
  _createFlip({ row, col, fromPlayer, toPlayer }) {
    this._effects.push({
      type: 'flip',
      row,
      col,
      fromPlayer,
      toPlayer,
      elapsed: 0,
      duration: 260, // project memory確定値：カードめくり型、260ms
    });
  }

  // 盤面全体を斜めに流れる、紫→ローズの光の帯。row/colを持たない盤面全体のエフェクト。
  _createSweep() {
    this._effects.push({
      type: 'sweep',
      elapsed: 0,
      duration: SWEEP_BRIGHTEN_MS + SWEEP_BAND_MS + SWEEP_HOLD_MS,
    });
  }

  /**
   * D-0079：盤面全体がごく短く「息を吸う」ような明るさの変化。row/colを持たない盤面全体のエフェクト。
   * D-0081：Breatheは「個々の着手」ではなく「盤面の状態」を表す単一エフェクトのため、常に1つだけ
   * 存在させる（Ripple/Glowのように着手ごとに複数存在してよいものとは性質が異なる）。CPUが1フレーム
   * 内で連続して着手した場合でも、新しいBreatheを積む前に既存のBreatheを取り除き、多重の加算合成に
   * よる明るさの二重化を防ぐ。
   */
  _createBoardBreathe() {
    this._effects = this._effects.filter((e) => e.type !== 'breathe');
    this._effects.push({
      type: 'breathe',
      elapsed: 0,
      duration: 110,
    });
  }

  _createRipple(row, col) {
    this._effects.push({
      type: 'ripple',
      row,
      col,
      elapsed: 0,
      duration: 200,
      gapAngle: Math.random() * Math.PI * 2,
      gapSize: 0.30 + (Math.random() * 2 - 1) * 0.14,
    });
  }

  /**
   * @param {{row: number, col: number, player: string, scale?: number}} args
   */
  _createGlow({ row, col, player, scale = 1.0 }) {
    this._effects.push({
      type: 'glow',
      row,
      col,
      player,
      scale,
      elapsed: 0,
      duration: 165,
    });
  }

  /**
   * 経過時間を進め、寿命が尽きたエフェクトを取り除く。
   * requestAnimationFrameのタイムスタンプとperformance.now()の計測タイミングのずれにより、
   * ごく稀にdeltaTimeが負の値になることがある（実機で確認済み：これによりelapsedが負に
   * なり、波紋の半径計算がマイナスになってCanvas APIの例外を引き起こし、以降の描画が
   * 全て失敗し続けるバグが実際に発生した）。deltaTimeを0未満にしないことで、根本から防ぐ。
   */
  update(deltaTime) {
    const dt = Math.max(0, deltaTime);
    for (const e of this._effects) e.elapsed += dt;
    this._effects = this._effects.filter((e) => e.elapsed < e.duration);
  }

  hasActiveEffects() {
    return this._effects.length > 0;
  }

  /** 対局リセット時に古いエフェクトを残さないためのクリア。 */
  clear() {
    this._effects = [];
  }

  /** 盤面側のエフェクト（盤面の呼吸）。石より前に描くため、石の内部には構造的に影響しない。 */
  drawBelowStone(ctx) {
    this._drawBoardBreathe(ctx);
  }

  /**
   * 石側のエフェクト（波紋・グロー・終局の光）。D-0081でRipple/Sweepの重なり順を正式確定：
   * Rippleは半径が盤面の4.6セル分まで広がるため、密集した盤面では既存の石と重なることが
   * ほぼ確実に起きる。実機比較の結果、石より下（drawBelowStone側）に置くと石に隠れて
   * ほとんど視認できなくなることを確認したため、`drawAboveStone()`を正式採用とする
   * （Sweepと同じ「盤面が埋まっているほど下のレイヤーは見えなくなる」という構造的理由）。
   * 描画順はRipple→Glow→Sweep：Rippleを先に描くことで、後から重なる加算合成のGlowが
   * Rippleの通常合成によって打ち消されない。Sweepは最後（最上位）で全てを覆う。
   */
  drawAboveStone(ctx) {
    this._drawFlips(ctx);
    this._drawRipples(ctx);
    this._drawGlows(ctx);
    this._drawSweep(ctx);
  }

  /**
   * 盤面全体がごく短く明るさを増す「呼吸」。石を塗るGlowとは独立させるため、盤面全体を覆う
   * オーバーレイとして描くが、drawBelowStone()（石より前）で描画するため、石の内部には
   * 一切影響しない（レイヤー順序そのものが独立性を担保する）。
   */
  _drawBoardBreathe(ctx) {
    for (const e of this._effects) {
      if (e.type !== 'breathe') continue;
      const t = Math.max(0, Math.min(1, e.elapsed / e.duration));
      const intensity = Math.sin(Math.PI * t);
      const alpha = 0.03 * intensity;

      ctx.save();
      ctx.globalCompositeOperation = 'lighter';
      ctx.globalAlpha = alpha;
      ctx.fillStyle = 'rgb(255,240,200)';
      ctx.fillRect(0, 0, BOARD_PIXEL_SIZE, BOARD_PIXEL_SIZE);
      ctx.restore();
    }
  }

  _drawFlips(ctx) {
    for (const e of this._effects) {
      if (e.type !== 'flip') continue;
      const t = Math.max(0, Math.min(1, e.elapsed / e.duration));
      this._drawFlip(ctx, e, t);
    }
  }

  /**
   * 反転中セルを一時的に描画する（D-0082）。renderStones()は既に最終色（toPlayer）を描いて
   * いるが、このセルの上に不透明なカードめくりを描くことで、その下の最終色の石を自然に覆う
   * ——「覆い隠すこと」自体が目的ではなく、あくまで「反転中セルの描画」という責務。
   * scaleXが1→0→-1と変化し、t<0.5はfromPlayerの色、t>=0.5はtoPlayerの色を描く。
   */
  _drawFlip(ctx, e, t) {
    const cx = e.col * CELL_PIXEL_SIZE + HALF_CELL;
    const cy = e.row * CELL_PIXEL_SIZE + HALF_CELL;
    const scaleX = Math.cos(Math.PI * t);
    const player = t < 0.5 ? e.fromPlayer : e.toPlayer;

    ctx.save();
    ctx.globalCompositeOperation = 'source-over';
    ctx.translate(cx, cy);
    ctx.scale(scaleX, 1);
    ctx.translate(-cx, -cy);
    drawStone(ctx, cx, cy, STONE_PIXEL_RADIUS, player);
    ctx.restore();
  }

  _drawRipples(ctx) {
    for (const e of this._effects) {
      if (e.type !== 'ripple') continue;
      const t = Math.max(0, Math.min(1, e.elapsed / e.duration));
      this._drawRipple(ctx, e, t);
    }
  }

  _drawRipple(ctx, e, t) {
    const cx = e.col * CELL_PIXEL_SIZE + HALF_CELL;
    const cy = e.row * CELL_PIXEL_SIZE + HALF_CELL;
    const maxRadius = CELL_PIXEL_SIZE * 4.6;
    const radius = easeOutCubic(t) * maxRadius;
    const thickness = Math.max(2, maxRadius * 0.22 * (1 - t * 0.4));
    // 終盤（最後の5%程度）は線形ではなく急に落ちるカーブにし、「消える」のではなく
    // 「盤面に溶けて吸収される」ように見せる（project memory: project_reversi_love_game参照）。
    const fade = Math.pow(1 - t, 1.7);

    ctx.save();
    ctx.globalAlpha = 0.20 * fade;
    ctx.strokeStyle = '#e8c96a';
    ctx.lineWidth = thickness;
    // 完全な円ではなく、途中を少し欠けさせて「機械的な波紋」を避ける（欠ける角度・大きさは毎回ランダム）
    ctx.beginPath();
    ctx.arc(cx, cy, radius, e.gapAngle + e.gapSize, e.gapAngle + Math.PI * 2, false);
    ctx.stroke();
    ctx.restore();

    // 波紋に沿って流れる、ごく小さな光の粒（2つだけ・控えめ）
    ctx.save();
    ctx.globalAlpha = 0.32 * fade;
    ctx.fillStyle = '#fff3d6';
    for (let i = 0; i < 2; i++) {
      const a = e.gapAngle + Math.PI * (0.75 + i * 0.9) + t * 0.5;
      const mx = cx + radius * Math.cos(a), my = cy + radius * Math.sin(a);
      ctx.beginPath();
      ctx.arc(mx, my, 1.5, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.restore();
  }

  _drawGlows(ctx) {
    for (const e of this._effects) {
      if (e.type !== 'glow') continue;
      const t = Math.max(0, Math.min(1, e.elapsed / e.duration));
      this._drawGlow(ctx, e, t);
    }
  }

  /**
   * 石を塗るのではなく、石の縁から漏れる柔らかい光として描く。石の内部（半径の内側）は
   * ほぼ変えず、縁のすぐ外側で最も強くなるグラデーションにする。加算合成（lighter）で
   * 「光が漏れている」質感にし、範囲は石の半径+数px程度に抑える（Glowが主役にならないように）。
   */
  _drawGlow(ctx, e, t) {
    const cx = e.col * CELL_PIXEL_SIZE + HALF_CELL;
    const cy = e.row * CELL_PIXEL_SIZE + HALF_CELL;
    // ease-in-outの山型：0%→100%→0%（ピークで止めない）
    const intensity = Math.sin(Math.PI * t);
    const baseAlpha = e.player === 'BLACK' ? 0.28 : 0.26;
    const alpha = baseAlpha * intensity * Math.min(1.4, e.scale);
    const margin = 6 * e.scale;
    const glowRadius = STONE_PIXEL_RADIUS + margin;
    const edgeOffset = Math.min(0.96, STONE_PIXEL_RADIUS / glowRadius);
    const peakOffset = Math.min(0.97, edgeOffset + (1 - edgeOffset) * 0.4);
    const rgb = GLOW_RGB[e.player];

    ctx.save();
    ctx.globalCompositeOperation = 'lighter';
    ctx.globalAlpha = alpha;
    const g = ctx.createRadialGradient(cx, cy, 0, cx, cy, glowRadius);
    g.addColorStop(0, `rgba(${rgb},0)`);
    g.addColorStop(edgeOffset, `rgba(${rgb},0)`);
    g.addColorStop(peakOffset, `rgba(${rgb},1)`);
    g.addColorStop(1, `rgba(${rgb},0)`);
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx, cy, glowRadius, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  }

  /**
   * 終局の光。3フェーズ：①盤面がわずかに明るくなる(150ms)②紫→ローズの光の帯が斜めに流れる(320ms)
   * ③静止(280ms、何も描画しない)。①②はそれぞれ独立した山型（Math.sin(Math.PI*t)）で完結させ、
   * フェーズをまたいで値を持ち越さない（Breathe/Glowと同じイージングの流儀に揃えた）。
   */
  _drawSweep(ctx) {
    for (const e of this._effects) {
      if (e.type !== 'sweep') continue;
      const t = Math.max(0, e.elapsed);

      if (t < SWEEP_BRIGHTEN_MS) {
        const p = t / SWEEP_BRIGHTEN_MS;
        const alpha = 0.05 * Math.sin(Math.PI * p);
        ctx.save();
        ctx.globalCompositeOperation = 'lighter';
        ctx.globalAlpha = alpha;
        ctx.fillStyle = 'rgb(255,245,220)';
        ctx.fillRect(0, 0, BOARD_PIXEL_SIZE, BOARD_PIXEL_SIZE);
        ctx.restore();
      } else if (t < SWEEP_BRIGHTEN_MS + SWEEP_BAND_MS) {
        const p = (t - SWEEP_BRIGHTEN_MS) / SWEEP_BAND_MS;
        this._drawSweepBand(ctx, p);
      }
      // SWEEP_HOLD_MS区間：意図的に何も描画しない（「静止」）
    }
  }

  /** 盤面の対角線に沿って、隅から隅へ流れる光の帯。色はp（0→1）に応じて紫→ローズへ遷移する。 */
  _drawSweepBand(ctx, p) {
    const diag = BOARD_PIXEL_SIZE * Math.SQRT2;
    const bandWidth = BOARD_PIXEL_SIZE * 0.4;
    const travel = diag + bandWidth;
    const bandCenter = -travel / 2 + p * travel;
    const rgb = lerpColor(SWEEP_START_RGB, SWEEP_END_RGB, p);

    ctx.save();
    ctx.globalCompositeOperation = 'lighter';
    ctx.translate(BOARD_PIXEL_SIZE / 2, BOARD_PIXEL_SIZE / 2);
    ctx.rotate(Math.PI / 4);
    const grad = ctx.createLinearGradient(bandCenter - bandWidth / 2, 0, bandCenter + bandWidth / 2, 0);
    grad.addColorStop(0, `rgba(${rgb},0)`);
    grad.addColorStop(0.5, `rgba(${rgb},0.35)`);
    grad.addColorStop(1, `rgba(${rgb},0)`);
    ctx.fillStyle = grad;
    ctx.fillRect(bandCenter - bandWidth / 2, -diag, bandWidth, diag * 2);
    ctx.restore();
  }
}
