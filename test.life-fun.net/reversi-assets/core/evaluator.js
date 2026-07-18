// Java版 com.oserofortune.core.Evaluator の移植。
// Q-002/Q-003（CPU思考アルゴリズム・実力算出）の暫定実装。位置の重み表 + モビリティによる1手読みヒューリスティック。

import { opponent } from './player.js';
import { Move, PASS } from './move.js';

const WEIGHTS = [
  [100, -20, 10, 5, 5, 10, -20, 100],
  [-20, -50, -2, -2, -2, -2, -50, -20],
  [10, -2, -1, -1, -1, -1, -2, 10],
  [5, -2, -1, -1, -1, -1, -2, 5],
  [5, -2, -1, -1, -1, -1, -2, 5],
  [10, -2, -1, -1, -1, -1, -2, 10],
  [-20, -50, -2, -2, -2, -2, -50, -20],
  [100, -20, 10, 5, 5, 10, -20, 100],
];

/** playerから見た盤面評価値。高いほどplayerに有利。 */
export function evaluate(board, player) {
  const opp = opponent(player);
  let positional = 0;
  for (let r = 0; r < 8; r++) {
    for (let c = 0; c < 8; c++) {
      const p = board.at(r, c);
      if (p === player) positional += WEIGHTS[r][c];
      else if (p === opp) positional -= WEIGHTS[r][c];
    }
  }
  const mobility = board.legalMoves(player).length - board.legalMoves(opp).length;
  return positional + mobility * 2.0;
}

/** 指定した手を打った結果の評価値。OBS-011/012（悪手/好手）判定に使う。 */
export function evaluateMove(board, player, move) {
  const next = board.copy();
  next.applyMove(player, move);
  return evaluate(next, player);
}

/** 現在の合法手の中で最も評価値が高い手を返す（1手読み）。 */
export function bestMove(board, player) {
  return bestTwoScoresAndMove(board, player).bestMove;
}

/**
 * その局面の合法手のうち、評価値が最も高い手と2番目に高い手のスコア。
 * Q-012対応：局面の難易度（best-secondの差）を使ってLogicトレイトの識別能力を上げるために使う。
 * @returns {{best: number, second: number}}
 */
export function bestTwoScores(board, player) {
  const { best, second } = bestTwoScoresAndMove(board, player);
  return { best, second };
}

function bestTwoScoresAndMove(board, player) {
  const moves = board.legalMoves(player);
  if (moves.length === 0) {
    const v = evaluate(board, player);
    return { best: v, second: v, bestMove: PASS };
  }
  let best = -Infinity;
  let second = -Infinity;
  let bestMoveResult = moves[0];
  for (const m of moves) {
    const score = evaluateMove(board, player, m);
    if (score > best) {
      second = best;
      best = score;
      bestMoveResult = m;
    } else if (score > second) {
      second = score;
    }
  }
  if (second === -Infinity) second = best;
  return { best, second, bestMove: bestMoveResult };
}

/** その局面での最善手の評価値（合法手がなければ現局面の評価値）。 */
export function bestPossibleScore(board, player) {
  return bestTwoScores(board, player).best;
}

/** 着手後に自分の合法手数（モビリティ）が最大になる手を返す。Adaptability(Q-011)の判定に使う。 */
export function mostMobileMove(board, player) {
  const moves = board.legalMoves(player);
  if (moves.length === 0) return PASS;
  let best = moves[0];
  let bestMobility = -1;
  for (const m of moves) {
    const next = board.copy();
    next.applyMove(player, m);
    const mobility = next.legalMoves(player).length;
    if (mobility > bestMobility) {
      bestMobility = mobility;
      best = m;
    }
  }
  return best;
}
