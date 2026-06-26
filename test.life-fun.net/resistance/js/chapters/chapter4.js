export const chapter4 = {
    // チャプター4開始時（トビーの裏切り告白）の会話データ
    getNovelDataIntro: (gameState) => [
        { name: gameState.name, text: "ついにボスの本拠地近くまで来たね、トビー。" },
        { name: "トビー", text: "リーダー、実は……本当にごめんなさい！" },
        { name: "トビー", text: "ボスの情報を敵に売ってしまったのは、僕なんです。おじいちゃんの治療薬と引き換えにするって言われて……。" },
        { name: "トビー", text: "傷つけるつもりはなかったんです。でも、これ以上先にはリーダーを進ませるわけにはいかないんです！" },
        { name: "トビー", text: "僕の警備ドローン『マカロン』、起動！！" }
    ],
    // ドローン撃破後（トビー改心）の会話データ
    getNovelDataClear: (gameState) => [
        { name: "トビー", text: "うぅ……負けました。本当にごめんなさい……。" },
        { name: gameState.name, text: `大丈夫だよ、トビー。一緒におじいちゃんも、さらわれた${gameState.partnerName}も救い出そう。` },
        { name: "トビー", text: "リーダー……！ これ、お詫びと応援の気持ちです。持って行ってください！" },
        { name: "システム", text: "（トビーから「強力な回復スプレー」と「ボム」を貰った！HPが最大まで回復し、ボムが2個増えました）" }
    ],
    initStage: () => {
        document.getElementById('stage-title').innerText = "STAGE 4 (BOSS)";
        document.getElementById('stage-objective').innerHTML = '警備ドローン『マカロン』を破壊せよ！';
    }
};