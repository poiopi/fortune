// Phase1b-2.5追加：あえて相手に角を与えてしまう手（最もリスクの高い手）を選ぶ「ギャンブル」Bot。
// 期待特性：Courage高め・Logic低め・Stability低め。SafeBotの対極として、Trait設計の穴を探す対照群。

import { opponent } from '../player.js';
import { PASS } from '../move.js';

export class GamblerBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    const riskyMoves = moves.filter((m) => {
      const next = board.copy();
      next.applyMove(self, m);
      return next.canTakeAnyCorner(opponent(self));
    });
    const pool = riskyMoves.length > 0 ? riskyMoves : moves;
    const chosen = pool[Math.floor(Math.random() * pool.length)];
    return { move: chosen, thinkTimeSeconds: 1.5 };
  }

  get name() {
    return 'GamblerBot';
  }
}
