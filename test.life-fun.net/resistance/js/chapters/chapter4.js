export const chapter4 = {
    // 中ボス撃破後：トビーの衝撃的な裏切り告白ノベルデータ
    getNovelDataIntro: (gameState) => [
        { name: gameState.name, text: "やった、中ボスを倒したぞ！ 先を急ごう、トビー。" },
        { name: "トビー", text: "リーダー……本当に、本当にごめんなさい……。" },
        { name: gameState.name, text: "えっ……？ トビー、どうしたの？" },
        { name: "トビー", text: "ボスの情報を敵に売って、リーダーたちをこの罠に誘い込んだのは……僕なんです。" },
        { name: "トビー", text: "ゾンビになったおじいちゃんを治す薬をくれるって言われて、仕方がなかったんです……！" },
        { name: "トビー", text: "傷つけるつもりはありませんでした。でも、これ以上先へ進ませるわけにはいかないんです！" },
        { name: "トビー", text: "僕の警備ドローン『マカロン』最終形態、起動！！" }
    ],
    // 大ボス撃破後：トビー改心会話データ
    getNovelDataClear: (gameState) => [
        { name: "トビー", text: "うぅ……負けました。僕の負けです。本当にごめんなさい……。" },
        { name: gameState.name, text: `大丈夫だよ、トビー。一緒におじいちゃんも、さらわれた${gameState.partnerName}も救い出そう。` },
        { name: "トビー", text: "リーダー……！ これ、お詫びと応援の気持ちです。持って行ってください！" },
        { name: "システム", text: "（トビーから「強力な回復スプレー」と「ボム」を貰った！HPが最大まで回復し、ボムが2個増えました）" }
    ],
    initStage: () => {
        document.getElementById('stage-title').innerText = "STAGE 4";
        document.getElementById('stage-objective').innerHTML = "本拠地周辺を索敵せよ";
    }
};