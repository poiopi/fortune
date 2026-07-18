// Phase1b-2.5追加：SafeBotの安全な手選択＋SlowBotの長考を組み合わせた「超慎重」Bot。
// 期待特性：Patience高め・Stability高め・Courage低め。

import { opponent } from '../player.js';
import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class UltraCautiousBot {
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
    // SafeBotとの違い：常に長考する（Patienceのシグナルを強く出す）
    return { move: best, thinkTimeSeconds: 25.0 };
  }

  get name() {
    return 'UltraCautiousBot';
  }
}
