export const chapter1 = {
    getNovelData: (gameState) => [
        { name: gameState.partnerName, text: "ついにここまで来たね…！街はかわいいゾンビたちでいっぱいだ。" },
        { name: gameState.partnerName, text: "私の後ろについてきて。画面を左右にスライドして、ゾンビをやっつけよう！" },
        { name: "システム", text: "【ステージ1】10体のゾンビを撃破してください！(スコア: 1000点以上目標)" }
    ],
    initStage: () => {
        document.getElementById('stage-title').innerText = "STAGE 1";
        document.getElementById('stage-objective').innerHTML = "10体倒せばクリア！";
    }
};