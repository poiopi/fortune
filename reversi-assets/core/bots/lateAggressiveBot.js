// Phase1b-2.5追加：序盤・中盤はSafeBotのように安全に、終盤（残りマスが少ない）だけGreedyBotのように
// 反転数最大化で攻める「終盤特化」Bot。期待特性：終盤にCourage/Initiativeが上がり、OBS-013（終盤逆転）も
// 発生しやすくなるはず。

import { opponent } from '../player.js';
import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

const LATE_GAME_EMPTY_THRESHOLD = 16;

export class LateAggressiveBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    if (board.emptyCount() <= LATE_GAME_EMPTY_THRESHOLD) {
      // 終盤：反転数最大化（GreedyBotと同じ基準）
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

    // 序盤・中盤：安全な手を優先（SafeBotと同じ基準）
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
    return { move: best, thinkTimeSeconds: 3.0 };
  }

  get name() {
    return 'LateAggressiveBot';
  }
}
