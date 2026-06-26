import { chapter1 } from './chapters/chapter1.js';
import { chapter2 } from './chapters/chapter2.js'; 
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

// ルール4：HTML上の各ボタンに対して確実なイベント登録
document.getElementById('next-chapter-btn').addEventListener('click', onNextChapterClick);

// ★重要：ノベル画面全体へのクリックリスナー登録（画面全体のどこを押しても会話が進みます）
document.getElementById('screen-novel').addEventListener('click', nextNovel);

// ★重要：シューティング画面全体のクリックリスナー登録（割り込み会話の発生時、画面のどこをクリックしても進みます）
document.getElementById('screen-shooting').addEventListener('click', (e) => {
    const talkBox = document.getElementById('battle-talk-box');
    // 会話ウインドウが表示されているときだけ動作
    if (talkBox && talkBox.style.display === 'block') {
        advanceBattleTalk();
        // イベントの伝播を防ぎ、意図しない自機のワープ移動や自機ショットの中断を防ぎます
        e.stopPropagation();
    }
});

// ★重要（ボムワープバグ防止）：ボムボタンへの確実なイベント登録と、自機移動の干渉防止
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
}

function showNovelStep() {
    const current = gameState.currentNovelData[gameState.novelIndex];
    updateDialogueStyle('novel-box', current.name);

    document.getElementById('novel-name').innerText = current.name;
    let text = current.text.replace("パートナー", gameState.partnerName);
    document.getElementById('novel-text').innerText = text;
}

function nextNovel() {
    gameState.novelIndex++;
    if (gameState.novelIndex < gameState.currentNovelData.length) {
        showNovelStep();
    } else {
        // ルール3適用：安全な文字列フラグの比較で次のフローへ遷移
        if (gameState.currentScene === "ch2_defeat") {
            // チャプター2の敗北（拉致イベント）が終了した場合、テストプレイ完了画面へ
            showChapter2ClearDemoScreen();
        } else {
            changeScreen('screen-shooting');
            adjustViewportHeight();
            if (!game) {
                game = new GameEngine(gameState, onStageFinished, triggerCh2AirHeavyEvent);
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
                color: '#b085f5', direction: 1, lastShotTime: 0
            };
            game.ch2StartTime = Date.now();
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
                game.isCh2EventTriggered = true;
                
                game.boss = {
                    x: game.canvas.width / 2 - 50, y: 50, width: 100, height: 100,
                    color: '#b085f5', direction: 1, lastShotTime: 0
                };
                game.ch2StartTime = Date.now();
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

    // ★HP 1 減少＆フラッシュの発生タイミング（ボスが叫んだ瞬間）
    if (battleTalkStep === 2) {
        game.flashScreen();
        gameState.playerHP = 1;
        document.getElementById('hp-value').innerText = gameState.playerHP;
        const hpBar = document.getElementById('hp-gauge-bar');
        if (hpBar) {
            hpBar.style.width = '1%'; // 視覚的にも1%に激減
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

// チャプター2：敗北（パートナー拉致）のフルノベル開始
function startChapter2DefeatNovel() {
    gameState.currentScene = "ch2_defeat"; 
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter2.getNovelDataDefeat(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
}

// チャプター2テスト完了デモ終了画面
function showChapter2ClearDemoScreen() {
    changeScreen('screen-clear');
    document.getElementById('clear-title').innerText = "STAGE 2 END (STG DEMO)";
    document.getElementById('clear-status').innerText = 
        `パートナーの「${gameState.partnerName}」が連れ去られてしまいました……！\n\nここでチャプター2のテストプレイは終了です。\n次は「チャプター3：涙の特訓（修行ステージ）」の追加となります！`;
    
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

    if (gameState.currentChapter === 1 && isWin) {
        document.getElementById('clear-title').innerText = "STAGE 1 CLEAR!";
        document.getElementById('clear-status').innerText = 
            `${gameState.name}さん、最初の戦いを無事に生き延びました！\nアイテムや仲間を連れて、チャプター2に進みます。`;
        document.getElementById('next-chapter-btn').style.display = "block";
        document.getElementById('restart-btn').style.display = "none";
        changeScreen('screen-clear');
        adjustViewportHeight();
    } else if (!isWin) {
        document.getElementById('clear-title').innerText = "GAME OVER";
        document.getElementById('clear-status').innerText = "レジスタンスは壊滅してしまった……。";
        document.getElementById('next-chapter-btn').style.display = "none";
        document.getElementById('restart-btn').style.display = "block";
        changeScreen('screen-clear');
        adjustViewportHeight();
    }
}

function onNextChapterClick() {
    if (gameState.currentChapter === 1) {
        startChapter2();
    } else {
        resetGame();
    }
}

function startChapter2() {
    gameState.currentChapter = 2;
    gameState.currentScene = "ch2_intro";
    gameState.novelIndex = 0;
    gameState.currentNovelData = chapter2.getNovelDataIntro(gameState);
    showNovelStep();
    changeScreen('screen-novel');
    adjustViewportHeight();
}

// ★バグ解消箇所：最初から遊ぶ（リセット）した際、ゲーム内Chapter情報やシーン状態も完全に初期化します
function resetGame() {
    gameState.currentChapter = 1; // 完全に1に戻す
    gameState.currentScene = "ch1_intro"; // シーンも初期化
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