// 大規模統計検証用：中級者を模したBot。半分は先読み（Evaluator）で最善手、半分は初心者的な反転数最大化。

import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class IntermediateBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    if (Math.random() < 0.5) {
      return { move: Evaluator.bestMove(board, self), thinkTimeSeconds: 4.0 };
    }
    let best = moves[0];
    let bestFlips = -1;
    for (const m of moves) {
      const before = board.countStones(self);
      const next = board.copy();
      next.applyMove(self, m);
      const flips = next.countStones(self) - before - 1;
      if (flips > bestFlips) {
        bestFlips = flips;
        best = m;
      }
    }
    return { move: best, thinkTimeSeconds: 2.0 };
  }

  get name() {
    return 'IntermediateBot';
  }
}
