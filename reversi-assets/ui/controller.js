// Phase1b-2: Canvas click → Controller → GameEngine → GameState → Renderer という一方向の流れを実装する。
// GameEngineはこのファイルの外（core/）にあり、Canvas/DOMの存在を一切知らない。
// Rendererはこのファイルの外（renderer.js）にあり、GameEngineを一切知らない。
// このControllerだけが両方を知っている。

import { GameEngine } from '../core/gameEngine.js';
import { Player } from '../core/player.js';
import { calculateTraits, calculateRawTraits } from '../core/traits.js';
import { RandomBot } from '../core/bots/randomBot.js';
import { SafeBot } from '../core/bots/safeBot.js';
import { renderBoard, renderStones, renderStatus, renderRelationship, renderRecommendations, renderFortuneResult, renderDimOverlay, CELL_PIXEL_SIZE } from './renderer.js';
import { EffectManager } from './effectManager.js';
import { AudioManager } from './audioManager.js';
import { SCHEMA_VERSION, EVENTS_VERSION, TRAITS_VERSION, HIGHLIGHT_VERSION } from '../core/version.js';
import { PlayerProfile } from '../core/playerProfile.js';
import { calculateSelfRelation, calculateMovementPattern } from '../core/relationshipModel.js';
import { calculateFortuneIndex } from '../core/fortuneIndex.js';
import { ZScoreAlgorithm, selectHighlight, DEFAULT_REFERENCE_STD } from '../core/highlightAlgorithms.js';
import { recommendationsFor } from '../core/recommendations.js';
import { generateFortuneResult } from '../core/resultGenerator.js';

const HUMAN = Player.BLACK;
const CPU = Player.WHITE;

// Phase1b-2では「本格占い」に相当する評価関数ベースのBotを暫定CPUとして使う（Q-002は未確定のまま）。
const CPU_STRATEGY = new SafeBot();

export class GameController {
  /**
   * @param {HTMLCanvasElement} canvas
   * @param {HTMLElement} statusEl
   * @param {HTMLElement} traitsEl D-0072以降未使用（Trait可視化UIの呼び出しを停止したため）。呼び出し元のAPI変更を
   *   このタイミングの変更対象にしないため、引数自体は残す
   * @param {HTMLElement} [relationshipEl] SelfRelation/FortuneIndexのデバッグ表示用（任意、開発用に維持）
   * @param {HTMLElement} [highlightEl] D-0072以降未使用（traitsElと同じ理由）
   * @param {HTMLElement} [recommendationsEl] おすすめ占いの表示用（任意、D-0064）
   * @param {HTMLElement} [resultEl] D-0072：占い結果（一言アドバイス/ラッキーカラー/ラッキーアイテム/得点）の表示用（任意）
   */
  constructor(canvas, statusEl, traitsEl, relationshipEl, highlightEl, recommendationsEl, resultEl) {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');
    this.statusEl = statusEl;
    this.traitsEl = traitsEl;
    this.relationshipEl = relationshipEl;
    this.highlightEl = highlightEl;
    this.recommendationsEl = recommendationsEl;
    this.resultEl = resultEl;
    this.turnStartedAt = 0;
    // D-0096：CPUの着手を0.5〜1秒ランダムに遅らせるためのタイマーID。
    // 「もう一度対局する」等で対局をリセットする際、予約済みのCPU着手が新しい対局へ
    // 誤って適用されないようclearTimeout()する必要があるため保持する。
    this._cpuMoveTimeoutId = null;

    // D-0075（Step2）：時間依存演出はEffectManagerに一任する。ControllerはEngine/Renderer/
    // EffectManagerの3者を調停するだけで、演出の中身（波紋の形・タイミング等）は一切知らない。
    this.effectManager = new EffectManager();
    this.effectRafId = null;
    this.lastFrameTime = 0;

    // D-0086：EffectManagerと対称な構造。Controllerは同じイベント（onStonePlaced/onStonesFlipped/
    // onGameFinished）をEffectManagerとAudioManagerの両方へ通知する。AudioManagerは音を鳴らす
    // 責務だけを持ち、ゲーム状態・UI状態は一切知らない。
    this.audioManager = new AudioManager();

    // D-0084：「ゲーム状態」（GameEngine.isFinished()）とは別の「演出状態」。GameEngineは
    // isFinished()の真偽しか持たず、「演出が残っているか」は一切知らない。この2層構造により、
    // 終局演出（Sweep）が再生し終わってからリザルトを表示する、という順序をControllerだけの
    // 責務として実現する。PLAYING→FINISHING（Sweep再生中）→RESULT_SHOWN（結果表示・盤面ディム）。
    this.phase = 'PLAYING';

    canvas.addEventListener('click', (e) => {
      // D-0086：AudioContextはユーザー操作の中で生成・再開する必要があるブラウザの制約のため、
      // 実際のクリックの中で毎回呼ぶ（resume()側で既に開始済みなら何もしないため安全）。
      this.audioManager.resume();
      this._onCanvasClick(e);
    });
    this.gameNumber = 0;
    this.lastGameSummary = null;
    this.sessionId = this._generateSessionId();
    // PlayerProfileは対局ごとにリセットしない。ブラウザタブを開いている間、セッションをまたいで蓄積する
    // （Q-004 Phase1、SelfRelationの自己相対比較の土台）。
    this.playerProfile = new PlayerProfile();
    this.newGame();
  }

  /** ブラウザのタブを開いてからのプレイ全体を識別するID（対局ごとではない）。 */
  _generateSessionId() {
    if (typeof crypto !== 'undefined' && crypto.randomUUID) return crypto.randomUUID();
    return `session-${Date.now()}-${Math.random().toString(16).slice(2)}`;
  }

  newGame() {
    // D-0096：予約済みのCPU着手（setTimeout）が残っていれば、新しい対局へ誤って適用されないよう破棄する。
    clearTimeout(this._cpuMoveTimeoutId);
    this.gameNumber++;
    // ダミーの黒側strategy（人間の手番ではControllerが直接applyMoveを呼ぶため実際には使われない）
    this.engine = new GameEngine(new RandomBot(), CPU_STRATEGY);
    this.lastGameSummary = null;
    this.turnStartedAt = performance.now();
    this._stopEffectLoop();
    this.effectManager.clear();
    // D-0084：「もう一度対局する」はFINISHING（Sweep再生中）でも常に押せる（本人承認：Ripple/Glow/
    // Breathe同様、途中リセットに一貫性を持たせるため）。したがって演出状態も必ずPLAYINGへ戻す。
    this.phase = 'PLAYING';
    this._render();
    this._advanceUntilHumanTurnOrFinished();
  }

  _onCanvasClick(event) {
    if (this.engine.isFinished()) return;
    if (this.engine.getCurrentPlayer() !== HUMAN) return;

    // D-0094：CSSで`max-width:100%`等によりcanvasが448x448の内部解像度より縮小表示される
    // （モバイル幅等）と、表示座標と内部座標がズレて正しいマスを算出できないバグがあった。
    // 内部解像度÷表示サイズの比率で補正する。
    const rect = this.canvas.getBoundingClientRect();
    const scaleX = this.canvas.width / rect.width;
    const scaleY = this.canvas.height / rect.height;
    const x = (event.clientX - rect.left) * scaleX;
    const y = (event.clientY - rect.top) * scaleY;
    const col = Math.floor(x / CELL_PIXEL_SIZE);
    const row = Math.floor(y / CELL_PIXEL_SIZE);

    const legal = this.engine.getLegalMoves(HUMAN);
    const chosen = legal.find((m) => m.row === row && m.col === col);
    if (!chosen) return;

    const thinkTimeSeconds = (performance.now() - this.turnStartedAt) / 1000;
    const beforeCells = this.engine.board.cells.map((r) => r.slice());
    this.engine.applyMove(chosen, thinkTimeSeconds);
    this._notifyStonePlaced(beforeCells, chosen.row, chosen.col, HUMAN);
    this._render();
    this._advanceUntilHumanTurnOrFinished();
  }

  /**
   * CPUの手番・パスが続く間は自動で進め、人間の手番になったら止まる。
   * D-0096：CPUが実際に石を置く直前だけ0.5〜1秒ランダムに待たせる（元のJavaFXプロトタイプ
   * `Osero.java`にあった0.5秒のPauseTransitionと同じ意図。Web移植時に引き継がれていなかった）。
   * パス（置く場所がない）は「考えて石を置く」動作ではないため遅延の対象にしない。
   */
  _advanceUntilHumanTurnOrFinished() {
    if (!this.engine.isFinished() && this.engine.getCurrentPlayer() !== HUMAN) {
      const current = this.engine.getCurrentPlayer();
      const legal = this.engine.getLegalMoves(current);
      if (legal.length === 0) {
        this.engine.advancePass();
        this._render();
        this._advanceUntilHumanTurnOrFinished();
        return;
      }
      // ここまでの_render()で「CPUが考えています…」がステータスに表示された状態のまま待たせる。
      const delayMs = 500 + Math.random() * 500;
      this._cpuMoveTimeoutId = setTimeout(() => {
        const decision = CPU_STRATEGY.decide(this.engine.board, current);
        const beforeCells = this.engine.board.cells.map((r) => r.slice());
        this.engine.applyMove(decision.move, decision.thinkTimeSeconds);
        this._notifyStonePlaced(beforeCells, decision.move.row, decision.move.col, current);
        this._render();
        this._advanceUntilHumanTurnOrFinished();
      }, delayMs);
      return;
    }

    // 人間の手番だが合法手がない場合は自動パス
    if (!this.engine.isFinished() && this.engine.getCurrentPlayer() === HUMAN) {
      if (this.engine.getLegalMoves(HUMAN).length === 0) {
        this.engine.advancePass();
        this._render();
        this._advanceUntilHumanTurnOrFinished();
        return;
      }
      this.turnStartedAt = performance.now();
    }

    if (this.engine.isFinished()) {
      // D-0084：ここでは演出状態をFINISHINGにするだけで、_renderResult()はまだ呼ばない。
      // Sweep（終局の光）が再生し終わる（_effectFrame内でhasActiveEffects()がfalseになる）まで
      // リザルト表示を待たせることで、「盤面が明るくなる→光の帯→静止→結果パネル表示」という
      // 逐次シーケンスにする（D-0080時点では同時に呼んでいたため、この順序になっていなかった）。
      this.phase = 'FINISHING';
      this.effectManager.onGameFinished();
      this.audioManager.onGameFinished();
      this._startEffectLoop();
      // D-0088：GA4のfortune_submit（診断単位イベント）。trackEventはサイト側（inc/footer.php）が
      // 提供するグローバル関数で、Node上のsim/*.mjsテストやサイト非統合の単体プロトタイプ実行時には
      // 存在しないため、存在チェックしてから呼ぶ（controller.jsをサイト固有のanalyticsに依存させないため）。
      if (typeof trackEvent === 'function') trackEvent('fortune_submit', {});
    }
  }

  /**
   * D-0082：「石を置いた」（onStonePlaced）と「既存の石が反転した」（onStonesFlipped）を
   * この順でEffectManagerへ通知する。反転セルの検出はここ（Controller）に閉じ込め、
   * EffectManagerへは{row,col,fromPlayer,toPlayer}という抽象データのみを渡す
   * （board.js/gameEngine.jsのapplyMove()は変更しない。将来applyMove()自体が反転セルを
   * 返す実装に変わっても、この差分検出ロジックを差し替えるだけで済む）。
   */
  _notifyStonePlaced(beforeCells, row, col, player) {
    this.effectManager.onStonePlaced({ row, col, player, isFinalMove: this.engine.isFinished() });
    this.audioManager.onStonePlaced();
    const flippedCells = this._detectFlippedCells(beforeCells, row, col);
    this.effectManager.onStonesFlipped(flippedCells);
    this.audioManager.onStonesFlipped(flippedCells);
    this._startEffectLoop();
  }

  /** applyMove()前後のboard.cellsの差分から、反転したセル（新しく置かれたセル自体は除く）を検出する。 */
  _detectFlippedCells(beforeCells, placedRow, placedCol) {
    const afterCells = this.engine.board.cells;
    const flipped = [];
    for (let r = 0; r < beforeCells.length; r++) {
      for (let c = 0; c < beforeCells[r].length; c++) {
        if (r === placedRow && c === placedCol) continue;
        const from = beforeCells[r][c];
        const to = afterCells[r][c];
        if (from !== null && to !== null && from !== to) {
          flipped.push({ row: r, col: c, fromPlayer: from, toPlayer: to });
        }
      }
    }
    return flipped;
  }

  _startEffectLoop() {
    if (this.effectRafId !== null) return;
    this.lastFrameTime = performance.now();
    this.effectRafId = requestAnimationFrame(this._effectFrame);
  }

  _effectFrame = (time) => {
    const dt = time - this.lastFrameTime;
    this.lastFrameTime = time;
    this.effectManager.update(dt);

    // D-0084：FINISHING中、Sweep等の演出が全て自然終了した瞬間にRESULT_SHOWNへ遷移し、
    // ここで初めて_renderResult()を呼ぶ（終局検知と同時ではなく、演出が終わってから）。
    if (this.phase === 'FINISHING' && !this.effectManager.hasActiveEffects()) {
      this.phase = 'RESULT_SHOWN';
      this._renderResult();
    }

    this._render();
    if (this.effectManager.hasActiveEffects()) {
      this.effectRafId = requestAnimationFrame(this._effectFrame);
    } else {
      this.effectRafId = null;
    }
  };

  _stopEffectLoop() {
    if (this.effectRafId !== null) {
      cancelAnimationFrame(this.effectRafId);
      this.effectRafId = null;
    }
  }

  _render() {
    const state = {
      cells: this.engine.board.cells,
      legalMoves: this.engine.isFinished() || this.engine.getCurrentPlayer() !== HUMAN
        ? []
        : this.engine.getLegalMoves(HUMAN),
      currentPlayer: this.engine.getCurrentPlayer(),
      finished: this.engine.isFinished(),
      dimmed: this.phase === 'RESULT_SHOWN',
    };
    // D-0081：盤面→盤面側エフェクト（Breathe）→石→石側エフェクト（Flip→Ripple→Glow→Sweep）、
    // という確定した重なり順。D-0084：RESULT_SHOWN中は最後に暗転オーバーレイを重ねる
    // （時間経過を伴わない状態のため、EffectManagerではなくRenderer側の静的な描画）。
    renderBoard(this.ctx, state);
    this.effectManager.drawBelowStone(this.ctx);
    renderStones(this.ctx, state);
    this.effectManager.drawAboveStone(this.ctx);
    renderDimOverlay(this.ctx, state.dimmed);

    // D-0080：終局後は_renderResult()が確定させたステータス文言（「対局終了：...」）を保持する。
    // Sweep等のアニメーションループはisFinished()後も_render()を毎フレーム呼び続けるが、
    // 盤面・エフェクトの描画（上記）は継続したまま、ステータス文言の上書きだけをここで止める。
    if (this.engine.isFinished()) return;

    const black = this.engine.board.countStones(Player.BLACK);
    const white = this.engine.board.countStones(Player.WHITE);
    const turnLabel = this.engine.getCurrentPlayer() === HUMAN ? 'あなたの番です' : 'CPUが考えています…';
    renderStatus(this.statusEl, `黒(あなた): ${black}　白(CPU): ${white}　${this.engine.isFinished() ? '' : turnLabel}`);
  }

  _renderResult() {
    const result = this.engine.getResult();
    const rawTraits = calculateRawTraits(result.blackLog);
    const traits = calculateTraits(result.blackLog);

    // 重要：SelfRelation/MovementPattern/Highlightの算出は、PlayerProfileへ今回のセッションを反映する
    // 「前」に行う（D-0028）。先に反映すると「自分自身と比較」した状態になり、常にSTABLE寄りに歪む。
    // Q-021対応：SelfRelationは最大変化量のTraitだけを要約するため、後から「複数Traitが連動していたか」を
    // 分析できるよう、MovementPattern経由で全Traitの内訳（TraitDelta）もログに残す。
    // 注意：playCount==0（初回プレイ）のtraitDeltasは、平均0との比較になるため参考値程度（selfRelation.state
    // がBASELINEのエントリは、この値を「変化」として解釈しないこと）。
    // D-0046：calculateMovementPatternは内部でcalculateTraitDeltasを呼び出すため、直接の重複呼び出しはしない。
    // D-0064/D-0065：SelfRelation/MovementPattern/FortuneIndexはUIの主経路（Trait表示・短文）からは外れ、
    // 内部解析・おすすめ占い選定用途として保持する（本エントリ時点ではおすすめ占いはHighlight Traitからの
    // 固定マッピングのみで、MovementPatternはまだ接続していない。将来の拡張余地として計算だけは残す）。
    const movementPattern = calculateMovementPattern(rawTraits, this.playerProfile);
    const traitDeltas = movementPattern.traitDeltas;
    const selfRelation = calculateSelfRelation(rawTraits, this.playerProfile);
    const fortuneIndex = calculateFortuneIndex(selfRelation);

    // D-0064/Q-030（D-0065）：Highlight Traitの選定はZScoreアルゴリズムを使う。BASELINE（playCount===0）は
    // 比較対象がないためHighestへ自動フォールバックする（selectHighlight内部、highlightAlgorithms.js）。
    const highlight = selectHighlight(ZScoreAlgorithm, {
      rawTraits,
      normalizedTraits: traits,
      profile: this.playerProfile,
      referenceStd: DEFAULT_REFERENCE_STD,
    });

    this.playerProfile.recordSession(rawTraits);

    if (this.relationshipEl) {
      renderRelationship(this.relationshipEl, selfRelation, fortuneIndex);
    }
    if (this.recommendationsEl) {
      renderRecommendations(this.recommendationsEl, recommendationsFor(highlight.trait));
    }

    // D-0072/D-0073：UI接続。プレイヤーに見せる主役はTraitではなく占い結果（D-0067）。
    // resultGenerator.jsの結果生成は対局確定時にここで1回だけ行い、lastGameSummaryに保持する
    // （D-0071「結果生成は1回のみ・再描画では再生成しない」）。総合運%はD-0073（Q-020確定）で
    // fortuneResult.scoreとして生成される。
    const fortuneResult = generateFortuneResult(selfRelation, fortuneIndex);
    if (this.resultEl) {
      renderFortuneResult(this.resultEl, {
        ...fortuneResult,
        blackScore: result.blackScore,
        whiteScore: result.whiteScore,
      });
    }

    // D-0088：サイト統合時のみ有効な処理（reversi-assetsとして動作していない単体プロトタイプ・
    // Node上のsim/*.mjsテストでは、これらのグローバル関数・DOM要素は存在しない）。
    // scrollToResult()はinc/footer.phpが提供する共通関数で、表示・スクロール・GA4の
    // fortune_result_view送信をまとめて行う（他の占いページと同じ導線）。
    if (typeof scrollToResult === 'function' && document.getElementById('fortuneResultWrapper')) {
      scrollToResult('fortuneResultWrapper');
    }
    // 将来のマイページ連携を見越し、他ページと同じ`life_fun_<ページ名>`規約でlocalStorageに保存する。
    // 保存フォーマットは後から拡張可能なJSON（現時点ではscore/advice/state/timestampのみ）。
    try {
      localStorage.setItem('life_fun_reversi', JSON.stringify({
        score: fortuneResult.score,
        advice: fortuneResult.advice,
        state: selfRelation.state,
        timestamp: Date.now(),
      }));
    } catch (e) {
      // localStorage不可の環境（プライベートモード等）でも対局自体は継続できるよう握りつぶす
    }

    let resultText;
    if (result.winner === null) {
      resultText = '引き分け';
    } else if (result.winner === HUMAN) {
      resultText = 'あなたの勝ちです';
    } else {
      resultText = 'CPUの勝ちです';
    }
    renderStatus(
      this.statusEl,
      `対局終了：黒${result.blackScore} - 白${result.whiteScore}（${resultText}）`
    );

    // Phase1b-2.5：主観・Observation・Traitの3層比較のため、Observationログも保持しておく。
    // バージョン情報を埋め込み、後で「このデータはどのロジックで生成されたか」を追跡できるようにする。
    this.lastGameSummary = {
      schemaVersion: SCHEMA_VERSION,
      eventsVersion: EVENTS_VERSION,
      traitsVersion: TRAITS_VERSION,
      highlightVersion: HIGHLIGHT_VERSION,
      sessionId: this.sessionId,
      gameNumber: this.gameNumber,
      timestamp: new Date().toISOString(),
      blackScore: result.blackScore,
      whiteScore: result.whiteScore,
      winner: result.winner,
      totalMoves: result.totalMoves,
      traits,
      selfRelation, // 事実（D-0028）。D-0064以降はUI表示ではなく内部解析用途
      fortuneIndex, // 演出パラメータ（D-0031）。D-0064以降はUI表示ではなく内部解析用途
      highlight, // D-0064/D-0065：{trait, score, algorithm, fellBackToHighest}。D-0072以降はUI表示ではなく内部解析・おすすめ占い選定用途
      fortuneResult, // D-0072：{advice, luckyColor, luckyItem}。UIに実際に表示される占い結果。将来項目追加時もこの配下に足すだけでよいようネスト構造で保持
      traitDeltas, // Q-021調査用：全Traitの内訳（key/delta/direction/confidence）。movementPatternと同一データのため独立キーの重複は持たせない
      observations: result.blackLog.entries.map((o) => ({
        id: o.id,
        moveNumber: o.moveNumber,
        magnitude: o.magnitude,
      })),
    };
  }

  /** Phase1b-2.5：直近の対局のTrait・Observationログを取得する（記録UI用）。 */
  getLastGameSummary() {
    return this.lastGameSummary;
  }
}
