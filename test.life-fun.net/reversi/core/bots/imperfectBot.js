// Java版 ImperfectBot の移植。指定した確率でEvaluatorの最善手を選び、それ以外はランダムに手を選ぶ。
// Trait Validation（Q-012検証）用の、段階的に実力が異なるBot。

import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class ImperfectBot {
  /** @param {number} bestMoveProbability */
  constructor(bestMoveProbability) {
    this.bestMoveProbability = bestMoveProbability;
  }

  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };
    if (Math.random() < this.bestMoveProbability) {
      return { move: Evaluator.bestMove(board, self), thinkTimeSeconds: 3.0 };
    }
    return { move: moves[Math.floor(Math.random() * moves.length)], thinkTimeSeconds: 1.0 };
  }

  get name() {
    return `ImperfectBot(${Math.round(this.bestMoveProbability * 100)}%)`;
  }
}
