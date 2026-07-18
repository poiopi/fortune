// Java版 MobilityBot の移植。着手後に自分の合法手数が最大になる手を選ぶ。期待特性：Adaptability高め。

import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class MobilityBot {
  decide(board, self) {
    if (board.legalMoves(self).length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };
    return { move: Evaluator.mostMobileMove(board, self), thinkTimeSeconds: 2.0 };
  }

  get name() {
    return 'MobilityBot';
  }
}
