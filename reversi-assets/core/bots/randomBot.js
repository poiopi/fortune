// Java版 RandomBot の移植。完全ランダム着手。EVENTS.mdの仮説検証における対照群（ベースライン）。

import { PASS } from '../move.js';

export class RandomBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };
    const chosen = moves[Math.floor(Math.random() * moves.length)];
    return { move: chosen, thinkTimeSeconds: 1.0 };
  }

  get name() {
    return 'RandomBot';
  }
}
