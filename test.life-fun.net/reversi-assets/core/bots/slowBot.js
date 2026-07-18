// Java版 SlowBot の移植。手の選択はEvaluatorの最善手だが、常に長考する（模擬思考時間を高く固定）。
// 期待特性：Patience高め。Q-009（PatienceとStabilityの分離検証）のための対照ボット。

import * as Evaluator from '../evaluator.js';

export class SlowBot {
  decide(board, self) {
    const move = Evaluator.bestMove(board, self);
    return { move, thinkTimeSeconds: 20.0 };
  }

  get name() {
    return 'SlowBot';
  }
}
