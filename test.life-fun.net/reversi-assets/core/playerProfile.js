// Q-004 Phase1：PlayerProfile。RelationshipModel Stage1（SelfRelation）の入力となる、
// 複数セッションの蓄積（P-06）。現段階ではaverageとplayCountのみを持つ（分散はPhase2でWelford法により追加、D-0028）。

const TRAIT_KEYS = ['initiative', 'patience', 'logic', 'adaptability', 'courage', 'stability'];

export class PlayerProfile {
  constructor() {
    this.playCount = 0;
    /** @type {Record<string, number>} 過去セッションのRawTrait平均値 */
    this.averageTrait = Object.fromEntries(TRAIT_KEYS.map((k) => [k, 0]));
  }

  /**
   * 今回のセッションをPlayerProfileへ反映する。
   * 重要：RelationshipModelでのTraitDelta計算は、必ずこのメソッドを呼ぶ「前」に行うこと（D-0028）。
   * 先に反映してから比較すると、SelfRelationが常にSTABLE寄りに歪む。
   * @param {Record<string, number>} sessionRawTrait
   */
  recordSession(sessionRawTrait) {
    const newCount = this.playCount + 1;
    for (const key of TRAIT_KEYS) {
      this.averageTrait[key] = (this.averageTrait[key] * this.playCount + sessionRawTrait[key]) / newCount;
    }
    this.playCount = newCount;
  }
}

export { TRAIT_KEYS };
