export const chapter2 = {
    // チャプター2開始時の会話データ
    getNovelDataIntro: (gameState) => [
        { name: gameState.partnerName, text: "楽勝だったな、この調子でいこう！" },
        { name: gameState.name, text: `油断は禁物だよ、${gameState.partnerName}！ 慎重に進もう。` }
    ],
    // 弾切れ強制敗北イベント時の会話データ（拉致演出）
    getNovelDataDefeat: (gameState) => [
        { name: "システム", text: "（ボスの強烈な一撃により、リーダーの武器が粉々に破壊されてしまった！）" },
        { name: gameState.name, text: "う、動けない……。弾も、弾も切れてしまった……！" },
        { name: "ボス", text: "フッ、フッ、フッ……ギャァオオオーン！！" },
        { name: "システム", text: `（巨大ボスが牙を剥き、動けない${gameState.name}に襲いかかる！）` },
        { name: gameState.partnerName, text: `危ない、リーダー！！！（${gameState.partnerName}が身代わりになってボスゾンビに捕まってしまう！）` },
        { name: gameState.partnerName, text: "私に構わず逃げて……！ もっと強くなって、絶対に助けにきてね……！" },
        { name: "システム", text: "――ボスはパートナーを連れ去り、去っていった。こうして、さらわれたパートナーを救い出すための、過酷な「特訓（修行）」の日々が始まる……。" }
    ],
    initStage: () => {
        document.getElementById('stage-title').innerText = "STAGE 2";
        document.getElementById('stage-objective').innerHTML = "このエリアのゾンビを掃討せよ";
    }
};