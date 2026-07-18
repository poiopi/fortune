// Java版 com.oserofortune.core.GameEngine / GameResult の移植＋Phase1b-2向けのステップ実行API追加。
// UI（Canvas等）には一切依存しない。ARCHITECTURE.mdの GameState → Observation の変換をここで行う。
//
// play()：Bot同士の完全自動対局用（Simulator.js等）。従来通り、開始から終局まで一括実行する。
// applyMove()：UI（Controller）から1手ずつ進めるためのステップ実行用API。人間の操作もCPUの応答も
//              同じこのメソッドを通す。GameEngineはCanvas/UIの存在を一切知らない。

import { Board } from './board.js';
import { Player, opponent } from './player.js';
import { ObservationId, ObservationLog } from './observation.js';
import * as Evaluator from './evaluator.js';

// 暫定閾値。プレイテスト後に見直す前提（OBSERVATIONS.md「未確定・要検証」参照）。
const LONG_THINK_SECONDS = 15.0;
const QUICK_DECISION_SECONDS = 3.0;
const ENDGAME_EMPTY_THRESHOLD = 10;

// Q-012対応：Best-Second間のギャップが小さい局面で分母が0近くにならないようにする下限値
const MIN_DIFFICULTY_GAP = 1.0;
const BAD_MOVE_THRESHOLD = 1.0; // 正規化した悪さがこれ以上でOBS-011
const GOOD_MOVE_THRESHOLD = 0.15; // 正規化した悪さがこれ以下でOBS-012
const MAGNITUDE_CAP = 3.0;

/**
 * @typedef {Object} Decision
 * @property {import('./move.js').Move} move
 * @property {number} thinkTimeSeconds
 */

/**
 * @typedef {Object} CpuStrategy
 * @property {(board: Board, self: string) => Decision} decide
 * @property {string} name
 */

export class GameResult {
  constructor(blackScore, whiteScore, winner, blackLog, whiteLog, totalMoves) {
    this.blackScore = blackScore;
    this.whiteScore = whiteScore;
    this.winner = winner; // nullなら引き分け
    this.blackLog = blackLog;
    this.whiteLog = whiteLog;
    this.totalMoves = totalMoves;
  }
}

export class GameEngine {
  /**
   * @param {CpuStrategy} blackStrategy
   * @param {CpuStrategy} whiteStrategy
   */
  constructor(blackStrategy, whiteStrategy) {
    this.board = new Board();
    this.blackStrategy = blackStrategy;
    this.whiteStrategy = whiteStrategy;
    this.blackLog = new ObservationLog();
    this.whiteLog = new ObservationLog();
    this.endgameLeader = null;
    this.moveNumber = 0;
    this.currentTurn = Player.BLACK;
    this.consecutivePasses = 0;
    this.finished = false;
  }

  // ===== Bot同士の完全自動対局用（従来のAPI、Simulator.js等） =====

  play() {
    while (!this.finished) {
      const current = this.currentTurn;
      if (this.getLegalMoves(current).length === 0) {
        this._advanceAsPass();
        continue;
      }
      const strategy = current === Player.BLACK ? this.blackStrategy : this.whiteStrategy;
      const decision = strategy.decide(this.board, current);
      this.applyMove(decision.move, decision.thinkTimeSeconds);
    }
    return this.getResult();
  }

  // ===== UI（Controller）向けのステップ実行API =====

  getCurrentPlayer() {
    return this.currentTurn;
  }

  getLegalMoves(player = this.currentTurn) {
    return this.board.legalMoves(player);
  }

  isFinished() {
    return this.finished;
  }

  /**
   * 現在の手番のプレイヤーが、指定した手を打つ。人間の入力もCPUの応答も、必ずこのメソッドを通す。
   * 合法手がない場合は呼び出し側でパス処理（advancePass）を行う。
   * @param {import('./move.js').Move} move
   * @param {number} [thinkTimeSeconds] 人間の場合はクリックまでの実測時間、CPUの場合はDecisionの値
   */
  applyMove(move, thinkTimeSeconds = 1.0) {
    if (this.finished) throw new Error('対局は既に終了しています');
    const current = this.currentTurn;
    this.moveNumber++;
    const log = current === Player.BLACK ? this.blackLog : this.whiteLog;

    this._recordPreMoveObservations(log, current, move, thinkTimeSeconds);
    this.board.applyMove(current, move);
    this._recordPostMoveObservations(log, current, move);
    this._checkEndgameLeader();

    this.consecutivePasses = 0;
    this.currentTurn = opponent(current);
    this._checkFinished();
  }

  /** 現在の手番に合法手がない場合、呼び出し側からパスを明示的に進める。 */
  advancePass() {
    if (this.finished) throw new Error('対局は既に終了しています');
    this._advanceAsPass();
  }

  _advanceAsPass() {
    this.moveNumber++;
    const log = this.currentTurn === Player.BLACK ? this.blackLog : this.whiteLog;
    log.record(ObservationId.OBS_006_PASS, this.moveNumber);
    this.consecutivePasses++;
    this.currentTurn = opponent(this.currentTurn);
    if (this.consecutivePasses >= 2 || this.board.isGameOver()) {
      this.finished = true;
    }
  }

  _checkFinished() {
    if (this.board.isGameOver()) {
      this.finished = true;
    }
  }

  /** 終局後に呼ぶ。GameResultを返す。 */
  getResult() {
    const blackScore = this.board.countStones(Player.BLACK);
    const whiteScore = this.board.countStones(Player.WHITE);
    const winner = blackScore === whiteScore ? null : blackScore > whiteScore ? Player.BLACK : Player.WHITE;

    if (this.endgameLeader !== null && winner !== null && this.endgameLeader !== winner) {
      this._recordReversalForBoth();
    }

    return new GameResult(blackScore, whiteScore, winner, this.blackLog, this.whiteLog, this.moveNumber);
  }

  // ===== Observation記録（Java版と同一ロジック） =====

  _recordPreMoveObservations(log, player, move, thinkTime) {
    if (thinkTime >= LONG_THINK_SECONDS) {
      log.record(ObservationId.OBS_004_LONG_THINK, this.moveNumber);
    } else if (thinkTime < QUICK_DECISION_SECONDS) {
      log.record(ObservationId.OBS_005_QUICK_DECISION, this.moveNumber);
    }

    const { best: bestScore, second: secondScore } = Evaluator.bestTwoScores(this.board, player);
    const chosenScore = Evaluator.evaluateMove(this.board, player, move);
    const difficultyGap = Math.max(bestScore - secondScore, MIN_DIFFICULTY_GAP);
    const normalizedBadness = (bestScore - chosenScore) / difficultyGap;

    if (normalizedBadness >= BAD_MOVE_THRESHOLD) {
      const magnitude = Math.min(normalizedBadness, MAGNITUDE_CAP);
      log.record(ObservationId.OBS_011_BAD_MOVE, this.moveNumber, magnitude);
    } else if (normalizedBadness <= GOOD_MOVE_THRESHOLD) {
      const magnitude = Math.min(1.0 - normalizedBadness, MAGNITUDE_CAP);
      log.record(ObservationId.OBS_012_GOOD_MOVE, this.moveNumber, magnitude);
    }

    const afterMove = this.board.copy();
    afterMove.applyMove(player, move);
    if (afterMove.canTakeAnyCorner(opponent(player))) {
      log.record(ObservationId.OBS_003_RISKY_MOVE, this.moveNumber);
    }

    this._recordAdaptabilityObservations(log, player, move, normalizedBadness);
  }

  _recordAdaptabilityObservations(log, player, move, normalizedBadness) {
    const selfScore = Evaluator.evaluate(this.board, player);
    const trailing = selfScore < 0;
    const isBadMove = normalizedBadness >= BAD_MOVE_THRESHOLD;

    if (trailing) {
      const mobilityChoice = Evaluator.mostMobileMove(this.board, player);
      if (move.equals(mobilityChoice) && !isBadMove) {
        log.record(ObservationId.OBS_015_STRATEGY_CHANGED, this.moveNumber);
      }
    } else if (normalizedBadness <= GOOD_MOVE_THRESHOLD) {
      const magnitude = Math.min(1.0 - normalizedBadness, MAGNITUDE_CAP);
      log.record(ObservationId.OBS_014_STRATEGY_CONSISTENT, this.moveNumber, magnitude);
    }
  }

  _recordPostMoveObservations(log, player, move) {
    if (move.isCorner()) {
      log.record(ObservationId.OBS_001_CORNER_CAPTURED, this.moveNumber);
      const opponentLog = player === Player.BLACK ? this.whiteLog : this.blackLog;
      opponentLog.record(ObservationId.OBS_002_CORNER_LOST, this.moveNumber);
    }
    const stableAfter = this.board.countStableStones(player);
    if (stableAfter > 0 && move.isCorner()) {
      log.record(ObservationId.OBS_016_STABLE_STONE_GAINED, this.moveNumber);
    }
  }

  _checkEndgameLeader() {
    if (this.endgameLeader === null && this.board.emptyCount() <= ENDGAME_EMPTY_THRESHOLD) {
      const black = this.board.countStones(Player.BLACK);
      const white = this.board.countStones(Player.WHITE);
      if (black !== white) {
        this.endgameLeader = black > white ? Player.BLACK : Player.WHITE;
      }
    }
  }

  _recordReversalForBoth() {
    this.blackLog.record(ObservationId.OBS_013_ENDGAME_REVERSAL, this.moveNumber);
    this.whiteLog.record(ObservationId.OBS_013_ENDGAME_REVERSAL, this.moveNumber);
  }
}
