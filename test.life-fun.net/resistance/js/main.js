import { chapter1 } from './chapters/chapter1.js';
import { chapter2 } from './chapters/chapter2.js'; 
import { chapter3 } from './chapters/chapter3.js'; // ★チャプター3をインポート
import { chapter4 } from './chapters/chapter4.js'; // ★チャプター4をインポート
import { GameEngine } from './game.js';

// ゲーム内グローバル状態
const gameState = {
    name: "", dob: "", gender: "",
    partnerName: "", // ジム または キャシー
    currentChapter: 1,
    currentScene: "ch1_intro", // ルール3適用：文字列フラグで状態管理
    killCount: 0,
    score: 0,
    novelIndex: 0,
    currentNovelData: [],
    
    // 引き継ぎパラメータ
    weaponType: 'normal',
    bombs: 1,
    allies: [],
    playerHP: 100
};

let game = null;

// 自動送り用タイマーの参照保持変数
let battleTalkTimeoutId = null;
let novelTimeoutId = null; // 通常のストーリー画面（ノベル画面）用オート進行タイマー

// ルール4：HTML上の各ボタンに対して確実なイベント登録
document.getElementById('title-start-btn').addEventListener('click', goToOpening);
document.getElementById('op-skip-btn').addEventListener('click', skipOpening);
document.getElementById('op-next-btn').addEventListener('click', skipOpening);
document.getElementById('restart-btn').addEventListener('click', resetGame);
document.getElementById('next-chapter-btn').addEventListener('click', onNextChapterClick);

// ★重要：ノベル画面全体へのクリックリスナー登録（画面全体のどこを押しても会話が進みます）
document.getElementById('screen-novel').addEventListener('click', nextNovel);

// ★重要：シューティング画面全体のクリックリスナー登録（割り込み会話の発生時、画面のどこをクリックしても進みます）
document.getElementById('screen-shooting').addEventListener('click', (e) => {
    const talkBox = document.getElementById('battle-talk-box');
    // 会話ウインドウが表示されているときだけ動作
    if (talkBox && talkBox.style.display === 'block') {
        advanceBattleTalk();
        // イベントの伝播を防ぎ、自機が右下に勝手に動いたりショットが中断するのを防止
        e.stopPropagation();
    }
});

// ★重要（ボムワープバグ防止）：ボムボタンへの確実なイベント登録
const bombBtn = document.getElementById('bomb-button');
bombBtn.addEventListener('click', (e) => {
    triggerBomb();
    e.stopPropagation(); // クリックイベントをシューティング画面に流さない
});
bombBtn.addEventListener('touchstart', (e) => {
    triggerBomb();
    e.stopPropagation(); 
    e.preventDefault(); // 自機が右下にワープして移動してしまうのを100%完全に防止
}, { passive: false });

// スマホのアドレスバー対策（--vh設定）
function adjustViewportHeight() {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}
window.addEventListener('resize', adjustViewportHeight);
window.addEventListener('orientationchange', adjustViewportHeight);
adjustViewportHeight(); // 起動時実行

function changeScreen(screenId) {
    document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
    document.getElementById(screenId).classList.add('active');
}

function updateDialogueStyle(boxId, speakerName) {
    const box = document.getElementById(boxId);
    box.classList.remove('talk-top', 'talk-left', 'talk-right');

    if (speakerName === "ボス" || speakerName === "警備ドローン" || speakerName === "システム") {
        box.classList.add('talk-top');
    } else if (speakerName === gameState.name || speakerName === "リーダー") {
        box.classList.add('talk-left');
    } else {
        box.classList.add('talk-right');
    }
}

function goToOpening() {
    gameState.name = document.getElementById('player-name').value || "リーダー";
    gameState.dob = document.getElementById('player-dob').value;
    gameState.gender = document.getElementById('player-gender').value;

    gameState.partnerName = (gameState.gender === 'female') ? 'ジム' : 'キャシー';

    localStorage.setItem('resistance_player_info', JSON.stringify({
        name: gameState.name, dob: gameState.dob, gender: gameState.gender, partnerName: gameState.partnerName
    }));

    changeScreen('screen-opening');
    adjustViewportHeight();
}

function skipOpening() {
    startChapter1();
}

function startChapter1() {
    gameState.currentChapter = 1;
    gameState.currentScene = "ch1_intro"; 
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter1.getNovelData(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay(); // 自動進行（3.5秒）を開始
}

// 通常ストーリー（ノベル）画面用の自動送りタイマー設定関数（標準3500ms）
function startNovelAutoplay() {
    if (novelTimeoutId) clearTimeout(novelTimeoutId);
    novelTimeoutId = setTimeout(() => {
        nextNovel();
    }, 3500);
}

function showNovelStep() {
    const current = gameState.currentNovelData[gameState.novelIndex];
    updateDialogueStyle('novel-box', current.name);

    document.getElementById('novel-name').innerText = current.name;
    let text = current.text.replace("パートナー", gameState.partnerName);
    document.getElementById('novel-text').innerText = text;
}

function nextNovel() {
    // 手動で画面クリックがあった場合は自動進行用のタイマーをキャンセルします
    if (novelTimeoutId) clearTimeout(novelTimeoutId);

    gameState.novelIndex++;
    if (gameState.novelIndex < gameState.currentNovelData.length) {
        showNovelStep();
        startNovelAutoplay(); // 引き続き自動進行タイマーをセット
    } else {
        // ルール3適用：安全な文字列フラグの比較で次のフローへ遷移
        if (gameState.currentScene === "ch2_defeat") {
            // ★バグ修正：拉致イベント終了後は、一時デモ画面ではなく、明確に「チャプター2クリア画面」に切り替えます
            showChapter2ClearScreen();
        } else if (gameState.currentScene === "ch3_clear") {
            // ★バグ修正：3面会話終了後は、一時デモ画面ではなく、「チャプター3クリア画面」に切り替えます
            showChapter3ClearScreen();
        } else if (gameState.currentScene === "ch4_confession") {
            // 裏切り告白終了後：大ボス起動用のゲームループを開始
            changeScreen('screen-shooting');
            adjustViewportHeight();
            if (game) {
                game.initGreatBossStage();
            }
        } else if (gameState.currentScene === "ch4_clear") {
            // 改心会話終了後は、チャプター4デモ終了画面へ
            showChapter4ClearDemoScreen();
        } else {
            changeScreen('screen-shooting');
            adjustViewportHeight();
            if (!game) {
                game = new GameEngine(gameState, onStageFinished, triggerCh2AirHeavyEvent, triggerCh4MidBossEvent);
            }
            game.initStage();
        }
    }
}

// ボス戦中会話イベントの自動進行タイマー
function startBattleTalkAutoplay(callback, delay = 2500) {
    if (battleTalkTimeoutId) clearTimeout(battleTalkTimeoutId);
    battleTalkTimeoutId = setTimeout(callback, delay);
}

// チャプター2：通常戦中（3体撃破時）の異変
let ch2EventStep = 0;
let ch2EventTalks = [];

function triggerCh2AirHeavyEvent() {
    ch2EventTalks = [
        { speaker: gameState.name, text: "……なんだか、急に空気が重くなってきた？" },
        { speaker: gameState.partnerName, text: "えっ、な、なにこれ！？ 画面が不気味に揺れて……" }
    ];

    document.getElementById('battle-talk-box').style.display = 'block';
    ch2EventStep = 0;
    showCh2EventTalk();
}

function showCh2EventTalk() {
    let current = ch2EventTalks[ch2EventStep];
    updateDialogueStyle('battle-talk-box', current.speaker);
    document.getElementById('battle-talk-speaker').innerText = current.speaker;
    document.getElementById('battle-talk-text').innerText = current.text.replace("パートナー", gameState.partnerName);

    startBattleTalkAutoplay(() => {
        ch2EventStep++;
        if (ch2EventStep < ch2EventTalks.length) {
            showCh2EventTalk();
        } else {
            document.getElementById('battle-talk-box').style.display = 'none';
            game.isCh2EventTriggered = true; 
            
            // ボス出現
            game.boss = {
                x: game.canvas.width / 2 - 50, y: 50, width: 100, height: 100,
                color: '#b085f5', targetY: 60, direction: 1, lastShotTime: 0
            };
            // 登場演出を有効にする
            game.isBossEntranceAnimating = true;
            game.loop();
        }
    }, 2500);
}

// チャプター4の中ボス出現前ダイアログ制御
let ch4MidBossStep = 0;
let ch4MidBossTalks = [];

function triggerCh4MidBossEvent() {
    ch4MidBossTalks = [
        { speaker: "トビー", text: "リーダー、こっちです！ 安全な裏道があります！" },
        { speaker: gameState.name, text: "わかった、トビー！ 急ごう！" }
    ];
    document.getElementById('battle-talk-box').style.display = 'block';
    ch4MidBossStep = 0;
    showCh4MidBossTalk();
}

function showCh4MidBossTalk() {
    let current = ch4MidBossTalks[ch4MidBossStep];
    updateDialogueStyle('battle-talk-box', current.speaker);
    document.getElementById('battle-talk-speaker').innerText = current.speaker;
    document.getElementById('battle-talk-text').innerText = current.text;

    startBattleTalkAutoplay(() => {
        ch4MidBossStep++;
        if (ch4MidBossStep < ch4MidBossTalks.length) {
            showCh4MidBossTalk();
        } else {
            document.getElementById('battle-talk-box').style.display = 'none';
            game.isCh4MidBossEventTriggered = true; // 中ボス戦闘フラグON
            
            // 中ボスの出現（HP: 20）
            game.boss = {
                x: game.canvas.width / 2 - 40, y: -50, targetY: 50, width: 80, height: 80,
                color: '#a5d8ff', direction: 1, lastShotTime: 0, hp: 20
            };
            game.isBossEntranceAnimating = true; // 登場演出ON
            document.getElementById('boss-hp-area').style.display = "block";
            document.getElementById('boss-hp-val').innerText = "20";
            game.loop();
        }
    }, 2500);
}

function advanceBattleTalk() {
    if (battleTalkTimeoutId) clearTimeout(battleTalkTimeoutId);

    if (gameState.currentChapter === 2) {
        if (!game.isCh2EventTriggered) {
            ch2EventStep++;
            if (ch2EventStep < ch2EventTalks.length) {
                showCh2EventTalk();
            } else {
                document.getElementById('battle-talk-box').style.display = 'none';
                game.isCh2EventTriggered = true; // ボス出現
                
                game.boss = {
                    x: game.canvas.width / 2 - 50, y: -50, targetY: 60, width: 100, height: 100,
                    color: '#b085f5', direction: 1, lastShotTime: 0
                };
                game.isBossEntranceAnimating = true;
                game.loop();
            }
        } else {
            // 弾切れ強制敗北シーンのダイアログ送り
            battleTalkStep++;
            if (battleTalkStep < battleTalkData.length) {
                showBattleTalk();
            } else {
                document.getElementById('battle-talk-box').style.display = 'none';
                startChapter2DefeatNovel();
            }
        }
    } else if (gameState.currentChapter === 4) {
        // チャプター4中ボス警告の手動送り
        ch4MidBossStep++;
        if (ch4MidBossStep < ch4MidBossTalks.length) {
            showCh4MidBossTalk();
        } else {
            document.getElementById('battle-talk-box').style.display = 'none';
            game.isCh4MidBossEventTriggered = true; // 中ボス戦闘フラグON
            
            game.boss = {
                x: game.canvas.width / 2 - 40, y: -50, targetY: 50, width: 80, height: 80,
                color: '#a5d8ff', direction: 1, lastShotTime: 0, hp: 20
            };
            game.isBossEntranceAnimating = true;
            document.getElementById('boss-hp-area').style.display = "block";
            document.getElementById('boss-hp-val').innerText = "20";
            game.loop();
        }
    }
}

// チャプター2：弾切れ時の敗北ダイアログ呼び出し
let battleTalkStep = 0;
let battleTalkData = [];

function triggerCh2ScriptedDefeat() {
    battleTalkData = [
        { speaker: "リーダー", text: "弾が切れた！？ どうして、こんな時に…！" },
        { speaker: "リーダー", text: "うわーっ！ やめろーっ！！" },
        { speaker: "ボス", text: "フッ、フッ、フッ……ギャァオオオーン！！" }
    ];

    document.getElementById('battle-talk-box').style.display = 'block';
    battleTalkStep = 0;
    showBattleTalk();
}

function showBattleTalk() {
    let current = battleTalkData[battleTalkStep];
    updateDialogueStyle('battle-talk-box', current.speaker);
    document.getElementById('battle-talk-speaker').innerText = current.speaker;
    document.getElementById('battle-talk-text').innerText = current.text;

    // ★可視化バグ修正：1行目のセリフ（「弾が切れた！？」）が表示された瞬間に画面がフラッシュし、HPが即時1に減少します。
    // これにより、会話を読んでいる間（最大7.5秒間）、HPゲージが1%になっている状態を戦闘画面上で確実かつ鮮明に目視できます。
    if (battleTalkStep === 0) {
        game.flashScreen();
        gameState.playerHP = 1;
        document.getElementById('hp-value').innerText = gameState.playerHP;
        const hpBar = document.getElementById('hp-gauge-bar');
        if (hpBar) {
            hpBar.style.width = '1%'; 
        }
    }

    startBattleTalkAutoplay(() => {
        battleTalkStep++;
        if (battleTalkStep < battleTalkData.length) {
            showBattleTalk();
        } else {
            document.getElementById('battle-talk-box').style.display = 'none';
            startChapter2DefeatNovel();
        }
    }, 2500);
}

function startChapter2() {
    gameState.currentChapter = 2;
    gameState.currentScene = "ch2_intro";
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter2.getNovelDataIntro(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay();
}

// チャプター2：敗北（パートナー拉致）のフルノベル開始
function startChapter2DefeatNovel() {
    gameState.currentScene = "ch2_defeat"; 
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter2.getNovelDataDefeat(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay(); 
}

// チャプター3：涙の特訓ノベル開始
function startChapter3Intro() {
    gameState.currentChapter = 3;
    gameState.currentScene = "ch3_intro";
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter3.getNovelData(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay(); // 修行イントロも自動進行
}

// チャプター3：特訓結果判定と会話処理
function endCh3Training() {
    // ★HPクリア特典：修行から生還したため、HPを100に完全回復！
    gameState.playerHP = 100;

    if (game.ch3TargetsHit >= 8) {
        gameState.weaponType = 'legend'; // 伝説の3方向ショットを永続解放！
        gameState.currentScene = "ch3_clear";
        gameState.novelIndex = 0;
        gameState.currentNovelData = [
            { name: "トビー", text: `素晴らしいです、リーダー！ マトを ${game.ch3TargetsHit} 個も壊せましたね！` },
            { name: "リーダー", text: "うん！ 力が湧いてきた。あの子を助けるための伝説の力を感じる……！" },
            { name: "システム", text: "【伝説 of 3方向ショット】が解放されました！次回ステージから永続的に使用可能になります。HPも完全回復しました！" }
        ];
    } else {
        gameState.currentScene = "ch3_clear";
        gameState.novelIndex = 0;
        gameState.currentNovelData = [
            { name: "トビー", text: `特訓終了です、リーダー。壊したマトは ${game.ch3TargetsHit} 個でしたね。（目標8個）` },
            { name: "リーダー", text: "う、あの子を想うと焦ってしまって……でも、立ち止まってはいられない！" },
            { name: "システム", text: "伝説の武器は解放できませんでしたが、次のエリアへ向かいましょう！HPは完全回復しました！" }
        ];
    }
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay();
}

// ★追加：チャプター2クリア（拉致イベント完了）画面表示
function showChapter2ClearScreen() {
    changeScreen('screen-clear');
    document.getElementById('clear-title').innerText = "STAGE 2 COMPLETE!";
    document.getElementById('clear-status').innerText = 
        `パートナーの「${gameState.partnerName}」がさらわれてしまいました……！\n\nここからはトビーの案内の元、リーダー自身を鍛える「特訓」へと突入します。`;
    
    document.getElementById('next-chapter-btn').style.display = "block";
    document.getElementById('next-chapter-btn').innerText = "チャプター3へ進む";
    document.getElementById('restart-btn').style.display = "none";
    adjustViewportHeight();
}

// ★追加：チャプター3クリア（特訓＆ボス撃破完了）画面表示
function showChapter3ClearScreen() {
    changeScreen('screen-clear');
    document.getElementById('clear-title').innerText = "STAGE 3 CLEAR!";
    document.getElementById('clear-status').innerText = 
        `マト当て特訓および、特訓ボスを無事撃破しました！\n（目標の8個以上を撃退できていれば、これより3方向伝説ショットが解放されます）\n\n特訓をやり切ったお礼に、体力は100に完全回復しました！`;
    
    document.getElementById('next-chapter-btn').style.display = "block";
    document.getElementById('next-chapter-btn').innerText = "チャプター4へ進む";
    document.getElementById('restart-btn').style.display = "none";
    adjustViewportHeight();
}

// チャプター4導入ノベル（トビーの案内＆応援）開始
function startChapter4Intro() {
    gameState.currentChapter = 4;
    gameState.currentScene = "ch4_intro";
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter4.getNovelDataIntro(gameState); 
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay(); 
}

// 中ボス撃破時、トビーの裏切り告白ノベルへの遷移
function triggerCh4Confession() {
    gameState.currentScene = "ch4_confession"; 
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter4.getNovelDataConfession(gameState); 
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay();
}

// チャプター4ドローン撃破・トビー改心会話
function triggerChapter4ClearScenario() {
    gameState.currentScene = "ch4_clear"; 
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter4.getNovelDataClear(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
    startNovelAutoplay(); 
}

// チャプター4クリアデモ終了画面
function showChapter4ClearDemoScreen() {
    gameState.playerHP = 100;
    gameState.bombs += 2;

    changeScreen('screen-clear');
    document.getElementById('clear-title').innerText = "STAGE 4 END (STG DEMO)";
    document.getElementById('clear-status').innerText = 
        `裏切り者のトビーを許し、再び仲間に引き入れました！\nHPが最大まで回復し、ボムが2個増えました。\n\nここでチャプター4のテストプレイは終了です。\n次は「チャプター5：運命の救出（決戦・マルチ分岐ステージ）」の追加となります！`;
    
    document.getElementById('next-chapter-btn').style.display = "none";
    document.getElementById('restart-btn').style.display = "block";
    adjustViewportHeight();
}

// 判定コールバック
function onStageFinished(isWin, specialReason) {
    if (specialReason === "ch2_scripted_defeat") {
        triggerCh2ScriptedDefeat();
        return;
    }
    // ★追加：特訓時間切れではなく、3面特訓ボスを無事撃退した際のコールバック処理
    if (specialReason === "ch3_boss_defeated") {
        endCh3Training();
        return;
    }
    // 中ボス撃破、告白ノベルへ遷移する処理
    if (specialReason === "ch4_midboss_defeated") {
        triggerCh4Confession();
        return;
    }

    if (gameState.currentChapter === 1 && isWin) {
        document.getElementById('clear-title').innerText = "STAGE 1 CLEAR!";
        document.getElementById('clear-status').innerText = 
            `${gameState.name}さん、最初の戦いを無事に生き延びました！\nアイテムや仲間を連れて、チャプター2に進みます。`;
        document.getElementById('next-chapter-btn').style.display = "block";
        document.getElementById('next-chapter-btn').innerText = "チャプター2へ進む";
        document.getElementById('restart-btn').style.display = "none";
        changeScreen('screen-clear');
        adjustViewportHeight();
    } else if (gameState.currentChapter === 4 && isWin) {
        triggerChapter4ClearScenario();
    } else if (!isWin) {
        document.getElementById('clear-title').innerText = "GAME OVER";
        document.getElementById('clear-status').innerText = "レジスタンスは壊滅してしまった……。";
        document.getElementById('next-chapter-btn').style.display = "none";
        document.getElementById('restart-btn').style.display = "block";
        changeScreen('screen-clear');
        adjustViewportHeight();
    }
}

// 次のチャプターに進むボタンクリックイベントの動的切り替え
function onNextChapterClick() {
    if (gameState.currentChapter === 1) {
        startChapter2();
    } else if (gameState.currentChapter === 2) {
        startChapter3Intro();
    } else if (gameState.currentChapter === 3) {
        startChapter4Intro();
    } else {
        resetGame();
    }
}

// 最初から遊ぶ（リセット）
function resetGame() {
    if (novelTimeoutId) clearTimeout(novelTimeoutId);
    if (battleTalkTimeoutId) clearTimeout(battleTalkTimeoutId);

    gameState.currentChapter = 1; 
    gameState.currentScene = "ch1_intro"; 
    gameState.weaponType = 'normal';
    gameState.bombs = 1;
    gameState.allies = [];
    gameState.playerHP = 100;
    gameState.score = 0;
    changeScreen('screen-title');
    adjustViewportHeight();
}

function triggerBomb() {
    if (game) game.triggerBomb();
}

// ==========================================
// ★重要：ES Modules仕様によるHTMLからの呼び出し対応（グローバルバインド）
// ==========================================
window.goToOpening = goToOpening;
window.skipOpening = skipOpening;
window.nextNovel = nextNovel;
window.triggerBomb = triggerBomb;
window.resetGame = resetGame;
window.advanceBattleTalk = advanceBattleTalk;