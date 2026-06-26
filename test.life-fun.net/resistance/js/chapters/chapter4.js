export const chapter4 = {
    // ★修正：ステージ4開始時の「トビー案内＆応援会話」ノベルデータ
    getNovelDataIntro: (gameState) => [
        { name: gameState.name, text: "どうしたトビー、浮かない顔して。" },
        { name: "トビー", text: "えっ！そんなことないですよ！ せっかく伝説の武器を手に入れたんですから、どんどん敵を倒しましょう！" },
        { name: gameState.name, text: `そうだね。早く${gameState.partnerName}を助け出さないと！` },
        { name: "トビー", text: "僕はこの辺りの地形に詳しいので案内します！ ついてきてください！" },
        { name: gameState.name, text: "頼むぞトビー、信頼しているよ！" }
    ],
    // ★修正：中ボス撃破後の「裏切り告白」ノベルデータ
    getNovelDataConfession: (gameState) => [
        { name: gameState.name, text: "やった、中ボスも撃破したぞ！ これで本拠地まで一直線だね、トビー。" },
        { name: "トビー", text: "リーダー……本当に、本当にごめんなさい……。" },
        { name: gameState.name, text: "えっ……？ トビー、どうしたの？" },
        { name: "トビー", text: "ボスの情報を敵に売って、リーダーたちをこの罠に誘い込んだのは……僕なんです。" },
        { name: "トビー", text: "ゾンビになったおじいちゃんを治す薬をあげるってボスに言われて、仕方がなかったんです……！" },
        { name: "トビー", text: "傷つけるつもりはありませんでした。でも、これ以上先へリーダーを進ませるわけにはいかないんです！" },
        { name: "トビー", text: "僕の警備ドローン『マカロン』最終形態、起動！！" }
    ],
    // 大ボス撃破後の改心・プレゼント会話データ
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
```