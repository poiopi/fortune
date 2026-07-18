// 大規模統計検証用：相手の着手後の合法手数を最小化する手を選ぶ（相手の選択肢を積極的に奪う守備的戦略）。
// SafeBot/UltraCautiousBot（自分の安全）とは異なり、相手の行動を制限することに焦点を当てる。

import { opponent } from '../player.js';
import { PASS } from '../move.js';
import * as Evaluator from '../evaluator.js';

export class DefensiveBot {
  decide(board, self) {
    const moves = board.legalMoves(self);
    if (moves.length === 0) return { move: PASS, thinkTimeSeconds: 0.5 };

    const opp = opponent(self);
    let best = moves[0];
    let minOpponentMobility = Infinity;
    let bestScore = -Infinity;
    for (const m of moves) {
      const next = board.copy();
      next.applyMove(self, m);
      const opponentMobility = next.legalMoves(opp).length;
      if (opponentMobility < minOpponentMobility) {
        minOpponentMobility = opponentMobility;
        best = m;
        bestScore = Evaluator.evaluateMove(board, self, m);
      } else if (opponentMobility === minOpponentMobility) {
        const score = Evaluator.evaluateMove(board, self, m);
        if (score > bestScore) {
          bestScore = score;
          best = m;
        }
      }
    }
    return { move: best, thinkTimeSeconds: 3.5 };
  }

  get name() {
    return 'DefensiveBot';
  }
}
