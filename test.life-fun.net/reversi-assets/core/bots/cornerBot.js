// Java版 CornerBot の移植。角が取れるなら必ず取る。それ以外はEvaluatorの最善手。期待特性：Stability高め。

import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class CornerBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };
    const corner = moves.find((m) => m.isCorner());
    if (corner) return { move: corner, thinkTimeSeconds: 2.0 };
    return { move: Evaluator.bestMove(board, self), thinkTimeSeconds: 2.0 };
  }

  get name() {
    return 'CornerBot';
  }
}
