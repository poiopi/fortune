// Java版 GreedyBot の移植。反転数が最大になる手を優先する（位置の価値は無視）。
// 期待特性：Initiative高め・Logic低め。

import { PASS } from '../move.js';

export class GreedyBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };
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
    return { move: best, thinkTimeSeconds: 1.0 };
  }

  get name() {
    return 'GreedyBot';
  }
}
