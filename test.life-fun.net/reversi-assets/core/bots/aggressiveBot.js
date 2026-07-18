// 大規模統計検証用：角があれば必ず取り、なければ反転数最大化。安全性は一切考慮しない
// （CornerBotとの違い：フォールバックがEvaluatorではなく貪欲な反転数最大化）。

import { PASS } from '../move.js';

export class AggressiveBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    const corner = moves.find((m) => m.isCorner());
    if (corner) return { move: corner, thinkTimeSeconds: 1.0 };

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
    return 'AggressiveBot';
  }
}
