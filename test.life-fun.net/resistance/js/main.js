```javascript
import { chapter1 } from './chapters/chapter1.js';
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

// ルール4：HTML上の各ボタンに対して確実なイベント登録
document.getElementById('next-chapter-btn').addEventListener('click', onNextChapterClick);

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
        changeScreen('screen-shooting');
        // コールバック関数（onStageFinished と 異変イベント）を正しく渡してインスタンス生成
        if (!game) {
            game = new GameEngine(gameState, onStageFinished, triggerCh2AirHeavyEvent);
        }
        // メソッド名をgame.js定義に合わせて initStage に修正
        game.initStage();
    }
}

// チャプター2用のダミー定義（チャプター1クリア時にフリーズさせないため）
function triggerCh2AirHeavyEvent() {
    // 今回はチャプター1確認用のビルドのためダミー配置
}

// 判定コールバック
function onStageFinished(isWin, specialReason) {
    if (gameState.currentChapter === 1 && isWin) {
        document.getElementById('clear-title').innerText = "STAGE 1 CLEAR!";
        document.getElementById('clear-status').innerText = 
            `${gameState.name}さん、最初の戦いを無事に生き延びました！\nアイテムや仲間を連れて、チャプター2に進みます。`;
        document.getElementById('next-chapter-btn').style.display = "block";
        document.getElementById('restart-btn').style.display = "none";
        changeScreen('screen-clear');
    } else if (!isWin) {
        document.getElementById('clear-title').innerText = "GAME OVER";
        document.getElementById('clear-status').innerText = "レジスタンスは壊滅してしまった……。";
        document.getElementById('next-chapter-btn').style.display = "none";
        document.getElementById('restart-btn').style.display = "block";
        changeScreen('screen-clear');
    }
}

function onNextChapterClick() {
    // 段階的導入のため、チャプター1クリア後の「チャプター2へ進む」ボタンは「最初から遊ぶ」ボタンと同じようにリセットさせます
    resetGame();
}

function resetGame() {
    gameState.weaponType = 'normal';
    gameState.bombs = 1;
    gameState.allies = [];
    gameState.playerHP = 100;
    gameState.score = 0;
    changeScreen('screen-title');
}

function triggerBomb() {
    if (game) game.triggerBomb();
}

// ==========================================
// ★重要：ES Modules仕様によるHTMLからの呼び出し対応（グローバルバインド）
// index.htmlの「onclick="..."」が正常に駆動するよう window オブジェクトに紐付けます
// ==========================================
window.goToOpening = goToOpening;
window.skipOpening = skipOpening;
window.nextNovel = nextNovel;
window.triggerBomb = triggerBomb;
window.resetGame = resetGame;
```