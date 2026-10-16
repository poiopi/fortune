export const chapter3 = {
    // チャプター3開始時（修行前）の会話データ
    getNovelData: (gameState) => [
        { name: "システム", text: "――ボスはパートナーを連れ去ってしまった。" },
        { name: gameState.name, text: "うぅ……私のせいで、あの子が……。" },
        { name: "トビー", text: "リーダー、落ち込んでいる暇はありません！ あいつらを追うために、一度特訓をしましょう！" },
        { name: "システム", text: "【ステージ3（特訓）】15秒以内に、上から落ちてくる「訓練用マト」を8個以上破壊してください！マトは当たってもダメージを受けません。" }
    ],
    initStage: () => {
        document.getElementById('stage-title').innerText = "STAGE 3 (特訓)";
        document.getElementById('stage-objective').innerHTML = '目標: <span id="ch3-hit-target">8</span>個以上撃破 (残り <span id="ch3-timer">15</span>秒)';
    }
};