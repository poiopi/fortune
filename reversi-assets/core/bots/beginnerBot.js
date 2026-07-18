// 大規模統計検証用：初心者を模したBot。反転数の多さに惹かれる（典型的な初心者のヒューリスティック）が、
// 常にそうするわけではなくランダム性も混ざる。Evaluatorは一切参照しない（先読みなしの初心者像）。

import { PASS } from '../move.js';

export class BeginnerBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    if (Math.random() < 0.5) {
      // 反転数が最も多い手を選ぶ（初心者が惹かれがちな近視眼的な選択）
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
    return { move: moves[Math.floor(Math.random() * moves.length)], thinkTimeSeconds: 1.5 };
  }

  get name() {
    return 'BeginnerBot';
  }
}
