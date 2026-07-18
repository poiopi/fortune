// Java版 SafeBot の移植。相手に角を与えない手を優先し、その中でEvaluatorの評価値が最も高い手を選ぶ。
// 期待特性：Stability高め・Logic高め。

import { opponent } from '../player.js';
import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class SafeBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    const safeMoves = moves.filter((m) => {
      const next = board.copy();
      next.applyMove(self, m);
      return !next.canTakeAnyCorner(opponent(self));
    });
    const candidates = safeMoves.length > 0 ? safeMoves : moves;

    let best = candidates[0];
    let bestScore = -Infinity;
    for (const m of candidates) {
      const score = Evaluator.evaluateMove(board, self, m);
      if (score > bestScore) {
        bestScore = score;
        best = m;
      }
    }
    return { move: best, thinkTimeSeconds: 2.5 };
  }

  get name() {
    return 'SafeBot';
  }
}
