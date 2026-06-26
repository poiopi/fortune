export class GameEngine {
    constructor(gameState, onStageEnd, onCh2EventTrigger, onCh4MidBossTrigger) {
        this.gameState = gameState;
        this.onStageEnd = onStageEnd;
        this.onCh2EventTrigger = onCh2EventTrigger;
        this.onCh4MidBossTrigger = onCh4MidBossTrigger; 

        this.canvas = document.getElementById('gameCanvas');
        this.ctx = this.canvas.getContext('2d');
        
        // プレイヤーの移動と無敵状態を保持するパラメータ
        this.player = { 
            x: 200, y: 550, width: 40, height: 40, color: '#ffb7c5',
            lastHitTime: 0 // 無敵時間（クールタイム）計算用の最終被弾ミリ秒
        };
        this.bullets = [];
        this.enemies = [];
        this.enemyBullets = [];
        this.items = [];
        this.boss = null;

        this.isGameOver = false;
        this.isCh2EventStarted = false; 
        this.isCh2EventTriggered = false; 
        this.isCh2DefeatedSceneActive = false;
        this.ch2StartTime = 0;

        // ★チャプター1進行管理フラグ
        this.isCh1BossActive = false; // 1面ボス出現フラグ
        this.isBossEntranceAnimating = false; // ボスが画面外からスーッと登場する演出中フラグ

        // ★チャプター4進行管理フラグ
        this.isCh4MiniBossActive = false;       
        this.isCh4MidBossEventStarted = false;  
        this.isCh4MidBossEventTriggered = false; 
        this.isCh4MidBossDefeated = false;       
        this.isCh4GreatBossSpawnAnimating = false; 
        this.isCh4GreatBossActive = false;       

        this.bossSpawnFrame = 0;
        this.animatingAllyType = null;
        this.animatingAllyX = 0;
        this.animatingAllyY = 0;

        // 特訓ステージ用
        this.ch3Timer = 15;
        this.ch3TargetsHit = 0;
        this.ch3GameStartTime = 0;
        this.ch3LastSpawnTime = 0;

        this.lastEnemyTime = 0;
        this.lastShootTime = 0;
        this.lastAllyShootTime = 0;
        this.lastHealTime = 0;
        this.animationId = null;

        // イベントリスナーの登録（多重登録を防止するため、コンストラクタで1度だけ実行）
        this.setupControls();
    }

    setupControls() {
        const self = this;
        const shootScreen = document.getElementById('screen-shooting');

        // マウス移動（PC） - 上下左右（360度）の追従移動
        shootScreen.addEventListener('mousemove', function(e) {
            if (self.isGameOver || self.isCh2DefeatedSceneActive || self.isCh4GreatBossSpawnAnimating) return;
            const rect = self.canvas.getBoundingClientRect();
            const scaleX = self.canvas.width / rect.width;
            const scaleY = self.canvas.height / rect.height;

            self.player.x = (e.clientX - rect.left) * scaleX - self.player.width / 2;
            self.player.y = (e.clientY - rect.top) * scaleY - self.player.height / 2;

            // クランプ
            self.player.x = Math.max(0, Math.min(self.canvas.width - self.player.width, self.player.x));
            self.player.y = Math.max(0, Math.min(self.canvas.height - self.player.height, self.player.y));
        });

        // タッチ移動（スマートフォン） - 上下左右（360度）の追従移動
        shootScreen.addEventListener('touchmove', function(e) {
            if (self.isGameOver || self.isCh2DefeatedSceneActive || self.isCh4GreatBossSpawnAnimating) return;
            e.preventDefault();
            const rect = self.canvas.getBoundingClientRect();
            const scaleX = self.canvas.width / rect.width;
            const scaleY = self.canvas.height / rect.height;

            self.player.x = (e.touches[0].clientX - rect.left) * scaleX - self.player.width / 2;
            self.player.y = (e.touches[0].clientY - rect.top) * scaleY - self.player.height / 2;

            self.player.x = Math.max(0, Math.min(self.canvas.width - self.player.width, self.player.x));
            self.player.y = Math.max(0, Math.min(self.canvas.height - self.player.height, self.player.y));
        }, { passive: false });
    }

    initStage() {
        this.canvas.width = this.canvas.parentNode.clientWidth;
        this.canvas.height = this.canvas.parentNode.clientHeight;

        this.player.x = this.canvas.width / 2 - this.player.width / 2;
        this.player.y = this.canvas.height - 100;
        this.player.lastHitTime = 0; 

        this.isGameOver = false;
        this.isCh1BossActive = false; // 初期化
        this.isBossEntranceAnimating = false; // 初期化
        this.isCh2EventStarted = false; 
        this.isCh2EventTriggered = false; 
        this.isCh2DefeatedSceneActive = false;

        this.isCh4MiniBossActive = false;
        this.isCh4MidBossEventStarted = false;
        this.isCh4MidBossEventTriggered = false;
        this.isCh4MidBossDefeated = false;
        this.isCh4GreatBossSpawnAnimating = false;
        this.isCh4GreatBossActive = false;

        this.bullets = [];
        this.enemies = [];
        this.enemyBullets = [];
        this.items = [];
        this.boss = null;

        this.updateBombUI();
        this.updateAllyUI();

        this.gameState.killCount = 0;
        document.getElementById('kill-count').innerText = this.gameState.killCount;
        document.getElementById('score-val').innerText = this.gameState.score;
        document.getElementById('boss-hp-area').style.display = "none";

        // ★バグ修正：左上のステージタイトルを現在のチャプター数に動的に書き換えます
        document.getElementById('stage-title').innerText = "STAGE " + this.gameState.currentChapter;

        if (this.gameState.currentChapter === 2) {
            this.ch2StartTime = 0;
        } else if (this.gameState.currentChapter === 3) {
            this.ch3TargetsHit = 0;
            this.ch3GameStartTime = Date.now();
            this.ch3LastSpawnTime = 0;
        } else if (this.gameState.currentChapter === 4) {
            document.getElementById('boss-hp-area').style.display = "block";
            document.getElementById('boss-hp-val').innerText = "100";
            this.boss = {
                x: this.canvas.width / 2 - 40, y: 50, width: 80, height: 80,
                color: '#f783ac', direction: 1, lastShotTime: 0, hp: 100
            };
        }

        // HP同期
        document.getElementById('hp-value').innerText = this.gameState.playerHP;
        const hpBar = document.getElementById('hp-gauge-bar');
        if (hpBar) {
            hpBar.style.width = this.gameState.playerHP + '%';
        }

        this.lastEnemyTime = Date.now();
        this.loop();
    }

    updateBombUI() {
        const btn = document.getElementById('bomb-button');
        if (this.gameState.bombs > 0 && this.gameState.currentChapter !== 3) {
            btn.style.display = 'flex';
            document.getElementById('bomb-count').innerText = this.gameState.bombs;
        } else {
            btn.style.display = 'none';
        }
    }

    updateAllyUI() {
        const area = document.getElementById('ally-status');
        if (this.gameState.allies.length > 0) {
            let alliesText = this.gameState.allies.map(a => a === 'attacker' ? '援護射撃' : '自動回復').join(' + ');
            area.innerText = `同伴中: ${alliesText}`;
        } else {
            area.innerText = "";
        }
    }

    triggerBomb() {
        if (this.gameState.bombs <= 0 || this.isGameOver || this.isCh2DefeatedSceneActive || this.isCh4GreatBossSpawnAnimating || this.isBossEntranceAnimating) return;
        this.gameState.bombs--;
        this.updateBombUI();
        this.flashScreen();

        if (this.gameState.currentChapter === 1 || (this.gameState.currentChapter === 2 && !this.isCh2EventTriggered) || (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventTriggered)) {
            this.gameState.killCount += this.enemies.length;
            this.gameState.score += this.enemies.length * 100;
            document.getElementById('kill-count').innerText = this.gameState.killCount;
            document.getElementById('score-val').innerText = this.gameState.score;
            this.enemies = [];
            // ボス未出現時のみボムでステージ1クリア
            if (this.gameState.currentChapter === 1 && !this.isCh1BossActive && this.gameState.killCount >= 10) this.endGame(true);
        } else if (this.boss) {
            // ボスへのダメージ（ボムは一撃でHP 15分のダメージに設定）
            this.boss.hp -= 15;
            document.getElementById('boss-hp-val').innerText = Math.max(0, this.boss.hp);
            if (this.boss.hp <= 0) {
                this.cancelLoop();
                if (this.gameState.currentChapter === 1) {
                    this.endGame(true);
                } else if (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventStarted) {
                    this.isCh4MidBossEventStarted = true;
                    this.boss = null;
                    this.onCh4MidBossTrigger();
                } else if (this.gameState.currentChapter === 4 && this.isCh4MidBossEventTriggered && !this.isCh4MidBossDefeated) {
                    this.isCh4MidBossDefeated = true;
                    this.boss = null;
                    this.onStageEnd(true, "ch4_midboss_defeated");
                } else {
                    this.endGame(true);
                }
            }
        }
        this.enemyBullets = [];
    }

    flashScreen() {
        const flash = document.getElementById('screen-flash');
        flash.style.opacity = '1';
        setTimeout(() => { flash.style.opacity = '0'; }, 300);
    }

    loop() {
        if (this.isGameOver) return;

        this.ctx.fillStyle = '#e3fafc';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        let now = Date.now();
        let isInvincible = (now - this.player.lastHitTime < 1000);
        let shouldDrawPlayer = (!isInvincible || (Math.floor(now / 100) % 2 === 0)) && !this.isCh4GreatBossSpawnAnimating;

        if (shouldDrawPlayer) {
            // 自機の描画
            this.ctx.fillStyle = this.player.color;
            this.ctx.beginPath();
            this.ctx.arc(this.player.x + this.player.width/2, this.player.y + this.player.height/2, this.player.width/2, 0, Math.PI * 2);
            this.ctx.fill();
            this.ctx.fillStyle = '#ffffff';
            this.ctx.font = '10px sans-serif';
            this.ctx.fillText("L", this.player.x + 16, this.player.y + 24);
        }

        // ヒーラー自動回復
        if (this.gameState.allies.includes('healer') && !this.isCh4GreatBossSpawnAnimating) {
            if (now - this.lastHealTime > 3000) {
                this.gameState.playerHP = Math.min(100, this.gameState.playerHP + 5);
                document.getElementById('hp-value').innerText = this.gameState.playerHP;
                const hpBar = document.getElementById('hp-gauge-bar');
                if (hpBar) {
                    hpBar.style.width = this.gameState.playerHP + '%';
                }
                this.lastHealTime = now;
            }
        }

        // Ch.2 強制敗北用タイマー
        if (this.gameState.currentChapter === 2 && this.isCh2EventTriggered && !this.isCh2DefeatedSceneActive) {
            let elapsed = now - this.ch2StartTime;
            if (elapsed > 10000) { 
                this.isCh2DefeatedSceneActive = true;
                this.cancelLoop();
                this.onStageEnd(false, "ch2_scripted_defeat");
                return; 
            }
        }

        // ★ボス出現演出中は「自機は動かせるが、弾（ショット）は出ない」仕様に制御
        let canShoot = !this.isCh2DefeatedSceneActive && !this.isCh4GreatBossSpawnAnimating && !this.isBossEntranceAnimating;
        if (canShoot && now - this.lastShootTime > 150) {
            this.firePlayerBullet(this.player.x + this.player.width / 2, this.player.y);
            this.lastShootTime = now;
        }

        // 仲間アタッカー援護射撃
        if (canShoot && this.gameState.allies.includes('attacker') && now - this.lastAllyShootTime > 300) {
            this.bullets.push({ x: this.player.x - 10, y: this.player.y + 10, width: 6, height: 12, vx: 0, vy: -6, isLaser: false });
            this.bullets.push({ x: this.player.x + this.player.width + 5, y: this.player.y + 10, width: 6, height: 12, vx: 0, vy: -6, isLaser: false });
            this.lastAllyShootTime = now;
        }

        // 仲間たちの描画
        if (!this.isCh4GreatBossSpawnAnimating) {
            this.gameState.allies.forEach((ally, index) => {
                this.ctx.fillStyle = ally === 'attacker' ? '#ff6b6b' : '#51cf66';
                this.ctx.beginPath();
                let offset = index === 0 ? -25 : 25;
                this.ctx.arc(this.player.x + this.player.width/2 + offset, this.player.y + this.player.height + 10, 10, 0, Math.PI * 2);
                this.ctx.fill();
            });
        }

        // ゾンビ生成
        if (this.gameState.currentChapter === 1 && !this.isCh1BossActive) {
            // ボス未出現時のみザコを生成
            if (now - this.lastEnemyTime > 1500) {
                let enemyX = Math.random() * (this.canvas.width - 40);
                let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                this.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                this.lastEnemyTime = now;
            }
        } else if (this.gameState.currentChapter === 2) {
            if (!this.isCh2EventTriggered) {
                if (now - this.lastEnemyTime > 1500) {
                    let enemyX = Math.random() * (this.canvas.width - 40);
                    let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                    this.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                    this.lastEnemyTime = now;
                }
            } else if (this.boss && !this.isBossEntranceAnimating) {
                // 異変イベント会話が終了し、演出が終わったらボスが動き出す
                this.boss.x += this.boss.direction * 2;
                if (this.boss.x < 10 || this.boss.x > this.canvas.width - this.boss.width - 10) this.boss.direction *= -1;

                this.ctx.fillStyle = this.boss.color;
                this.ctx.beginPath();
                this.ctx.arc(this.boss.x + this.boss.width/2, this.boss.y + this.boss.height/2, this.boss.width/2, 0, Math.PI * 2);
                this.ctx.fill();

                this.ctx.fillStyle = '#333';
                this.ctx.fillRect(this.boss.x + 30, this.boss.y + 35, 8, 8);
                this.ctx.fillRect(this.boss.x + 62, this.boss.y + 35, 8, 8);
                this.ctx.fillStyle = '#ff6b8b';
                this.ctx.fillRect(this.boss.x + 40, this.boss.y + 65, 20, 5);

                if (now - this.boss.lastShotTime > 800) {
                    this.enemyBullets.push({ x: this.boss.x + this.boss.width / 2 - 10, y: this.boss.y + this.boss.height, width: 20, height: 20, vx: 0, vy: 4, color: '#ff8787' });
                    this.boss.lastShotTime = now;
                }
            }
        } else if (this.gameState.currentChapter === 3) {
            let elapsedSec = Math.floor((now - this.ch3GameStartTime) / 1000);
            let remaining = Math.max(0, this.ch3Timer - elapsedSec);
            
            const timerEl = document.getElementById('ch3-timer');
            if (timerEl) {
                timerEl.innerText = remaining;
            }

            if (remaining <= 0) {
                this.cancelLoop();
                this.onStageEnd(true, "ch3_time_up");
                return; 
            }

            if (now - this.ch3LastSpawnTime > 1000) {
                let targetX = Math.random() * (this.canvas.width - 40);
                this.enemies.push({ x: targetX, y: -40, width: 30, height: 30, color: '#1c7ed6', speed: 3, isTarget: true });
                this.ch3LastSpawnTime = now;
            }
        } else if (this.gameState.currentChapter === 4) {
            // チャプター4のザコ戦・ボス戦処理
            if (!this.isCh4MidBossEventTriggered) {
                // 中ボス出現前の通常索敵
                if (now - this.lastEnemyTime > 1500) {
                    let enemyX = Math.random() * (this.canvas.width - 40);
                    let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                    this.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                    this.lastEnemyTime = now;
                }
            } else if (this.isCh4GreatBossSpawnAnimating) {
                // お供吸い込み＆巨大化アニメ
                this.bossSpawnFrame++;
                let progress = this.bossSpawnFrame / 60; 
                
                let currentX, currentY, currentRadius, currentColor;
                
                if (this.animatingAllyType) {
                    currentX = this.animatingAllyX + (this.canvas.width / 2 - this.animatingAllyX) * progress;
                    currentY = this.animatingAllyY + (100 - this.animatingAllyY) * progress;
                    currentRadius = 10 + (40 - 10) * progress;
                    currentColor = this.animatingAllyType === 'attacker' ? '#ff6b6b' : '#51cf66';
                } else {
                    currentX = this.canvas.width / 2;
                    currentY = -50 + (100 - (-50)) * progress;
                    currentRadius = 5 + (40 - 5) * progress;
                    currentColor = '#f783ac';
                }
                
                this.ctx.fillStyle = currentColor;
                this.ctx.beginPath();
                this.ctx.arc(currentX, currentY, currentRadius, 0, Math.PI * 2);
                this.ctx.fill();
                
                if (this.bossSpawnFrame >= 60) {
                    this.isCh4GreatBossSpawnAnimating = false;
                    this.isCh4GreatBossActive = true;
                    this.boss = {
                        x: this.canvas.width / 2 - 40,
                        y: 60,
                        width: 80,
                        height: 80,
                        hp: 40, 
                        color: '#f783ac',
                        direction: 1,
                        lastShotTime: Date.now()
                    };
                }
            } else if (this.boss && !this.isBossEntranceAnimating && (this.isCh4GreatBossActive || (this.isCh4MidBossEventTriggered && !this.isCh4MidBossDefeated) || (this.isCh4MiniBossActive && !this.isCh4MidBossEventStarted))) {
                // アクティブなボス（小ボス・中ボス・大ボス）の動作と移動
                this.boss.x += this.boss.direction * 3;
                if (this.boss.x < 10 || this.boss.x > this.canvas.width - this.boss.width - 10) {
                    this.boss.direction *= -1;
                }

                this.ctx.fillStyle = this.boss.color;
                this.ctx.beginPath();
                this.ctx.arc(this.boss.x + this.boss.width/2, this.boss.y + this.boss.height/2, this.boss.width/2, 0, Math.PI * 2);
                this.ctx.fill();

                if (this.isCh4GreatBossActive) {
                    this.ctx.fillStyle = '#e64980';
                    this.ctx.fillRect(this.boss.x + this.boss.width/2 - 25, this.boss.y + this.boss.height/2 - 5, 50, 10);
                } else if (this.isCh4MidBossEventTriggered) {
                    this.ctx.fillStyle = '#1c7ed6';
                    this.ctx.fillRect(this.boss.x + this.boss.width/2 - 15, this.boss.y + this.boss.height/2 - 3, 30, 6);
                } else {
                    this.ctx.fillStyle = '#fcc419';
                    this.ctx.fillRect(this.boss.x + this.boss.width/2 - 8, this.boss.y + this.boss.height/2 - 2, 16, 4);
                }

                if (now - this.boss.lastShotTime > 1000) {
                    let bSpeed = 4;
                    if (this.isCh4GreatBossActive) {
                        this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 12, height: 12, vx: 0, vy: bSpeed, color: '#f03e3e' });
                        this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 12, height: 12, vx: Math.sin(-0.3)*bSpeed, vy: Math.cos(-0.3)*bSpeed, color: '#f03e3e' });
                        this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 12, height: 12, vx: Math.sin(0.3)*bSpeed, vy: Math.cos(0.3)*bSpeed, color: '#f03e3e' });
                    } else {
                        let dx = (this.player.x + this.player.width/2) - (this.boss.x + this.boss.width/2);
                        let dy = (this.player.y + this.player.height/2) - (this.boss.y + this.boss.height);
                        let dist = Math.sqrt(dx*dx + dy*dy);
                        let bVx = 0;
                        let bVy = bSpeed;
                        if (dist > 0 && Math.random() < 0.5) {
                            bVx = (dx / dist) * bSpeed;
                            bVy = (dy / dist) * bSpeed;
                        }
                        this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 10, height: 10, vx: bVx, vy: bVy, color: '#f03e3e' });
                    }
                    this.boss.lastShotTime = now;
                }
            }
        }

        // ★ボス登場時の「画面外からスーッと降りてくる」汎用演出処理
        if (this.isBossEntranceAnimating && this.boss) {
            this.boss.y += 2; // スピード調整
            if (this.boss.y >= this.boss.targetY) {
                this.boss.y = this.boss.targetY;
                this.isBossEntranceAnimating = false; // 演出終了、戦闘（ボス攻撃）開始！
                this.boss.lastShotTime = Date.now();
            }

            // 登場中のボスを画面に描画
            this.ctx.fillStyle = this.boss.color;
            this.ctx.beginPath();
            this.ctx.arc(this.boss.x + this.boss.width/2, this.boss.y + this.boss.height/2, this.boss.width/2, 0, Math.PI * 2);
            this.ctx.fill();

            // 1面のミニボスには簡単な装飾線をいれます
            if (this.gameState.currentChapter === 1) {
                this.ctx.fillStyle = '#e64980';
                this.ctx.fillRect(this.boss.x + this.boss.width/2 - 10, this.boss.y + this.boss.height/2 - 2, 20, 4);
            }
        }

        // ザコ反撃（ボスの登場演出中は反撃しない）
        let canZombiesAttack = !this.isBossEntranceAnimating && !this.isCh4GreatBossSpawnAnimating;
        if (canZombiesAttack && (this.gameState.currentChapter === 1 || (this.gameState.currentChapter === 2 && !this.isCh2EventTriggered) || (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventTriggered))) {
            this.enemies.forEach(e => {
                if (now - e.lastShotTime > 2000) {
                    let bulletVx = 0;
                    let bulletVy = 4;
                    let bulletColor = '#f03e3e';

                    if (e.shootType === 'aimed') {
                        let dx = (this.player.x + this.player.width/2) - (e.x + e.width/2);
                        let dy = (this.player.y + this.player.height/2) - (e.y + e.height);
                        let dist = Math.sqrt(dx*dx + dy*dy);
                        if (dist > 0) {
                            bulletVx = (dx / dist) * 4;
                            bulletVy = (dy / dist) * 4;
                        }
                        bulletColor = '#fd7e14';
                    }

                    this.enemyBullets.push({ 
                        x: e.x + e.width/2 - 4, 
                        y: e.y + e.height, 
                        width: 8, 
                        height: 8, 
                        vx: bulletVx, 
                        vy: bulletVy, 
                        color: bulletColor 
                    });
                    e.lastShotTime = now;
                }
            });
        }

        // --- ルール1適用：forEach+spliceを完全に排除した新配列判定 ---
        // 1. プレイヤー弾更新
        let nextBullets = [];
        for (let i = 0; i < this.bullets.length; i++) {
            let b = this.bullets[i];
            b.x += b.vx || 0;
            b.y += b.vy || 0;

            this.ctx.fillStyle = b.isLaser ? '#4dabf7' : '#ff6b8b';
            this.ctx.fillRect(b.x, b.y, b.width, b.height);

            let bulletRemoved = false;

            if (this.boss && !this.isBossEntranceAnimating) {
                // 1面ボス、2面ボス、4面ボスの当たり判定を一元化
                if (b.x < this.boss.x + this.boss.width && b.x + b.width > this.boss.x &&
                    b.y < this.boss.y + this.boss.height && b.y + b.height > this.boss.y) {
                    bulletRemoved = true;
                    
                    let damage = b.isLaser ? 2 : 1;
                    this.boss.hp = (this.boss.hp || 0) - damage;
                    
                    // ボスHP表示用のタグが存在していれば、数値を更新
                    const hpValEl = document.getElementById('boss-hp-val');
                    if (hpValEl && this.boss.hp !== undefined) {
                        hpValEl.innerText = Math.max(0, this.boss.hp);
                    }
                    
                    if (this.boss.hp !== undefined && this.boss.hp <= 0) {
                        this.cancelLoop();
                        if (this.gameState.currentChapter === 1) {
                            // ★1面ボス撃破時のクリア処理
                            this.endGame(true);
                            return; 
                        } else if (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventStarted) {
                            this.isCh4MidBossEventStarted = true;
                            this.boss = null;
                            this.onCh4MidBossTrigger();
                            return; 
                        } else if (this.gameState.currentChapter === 4 && this.isCh4MidBossEventTriggered && !this.isCh4MidBossDefeated) {
                            this.isCh4MidBossDefeated = true;
                            this.boss = null;
                            this.onStageEnd(true, "ch4_midboss_defeated");
                            return; 
                        } else {
                            this.endGame(true);
                            return; 
                        }
                    }
                }
            } else if (this.gameState.currentChapter === 2 && this.boss) {
                if (b.x < this.boss.x + this.boss.width && b.x + b.width > this.boss.x &&
                    b.y < this.boss.y + this.boss.height && b.y + b.height > this.boss.y) {
                    bulletRemoved = true;
                    this.ctx.fillStyle = '#fff';
                    this.ctx.fillRect(b.x - 10, b.y - 10, 20, 20);
                }
            }

            for (let j = 0; j < this.enemies.length; j++) {
                let e = this.enemies[j];
                if (!e.toRemove && b.x < e.x + e.width && b.x + b.width > e.x &&
                    b.y < e.y + e.height && b.y + b.height > e.y) {
                    
                    e.toRemove = true;
                    if (!b.isLaser) bulletRemoved = true;

                    if (this.gameState.currentChapter === 1 || (this.gameState.currentChapter === 2 && !this.isCh2EventTriggered) || (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventTriggered)) {
                        this.gameState.killCount++;
                        this.gameState.score += 100;
                        document.getElementById('kill-count').innerText = this.gameState.killCount;
                        document.getElementById('score-val').innerText = this.gameState.score;
                        
                        if (Math.random() < 0.4) this.spawnItem(e.x, e.y);

                        // 通常ザコ撃破による各イベントトリガーの制御（ボスの登場演出中はトリガーさせない）
                        if (this.gameState.currentChapter === 1 && !this.isCh1BossActive && this.gameState.killCount >= 8) {
                            // ★1面の撃破数が8に達した瞬間に、画面外からミニボスがスーッと出現する演出を起動
                            this.isCh1BossActive = true;
                            this.enemies = []; // 雑魚を一度消去
                            this.enemyBullets = []; // 敵の弾もリセット
                            this.isBossEntranceAnimating = true; // ボス登場アニメON
                            this.boss = {
                                x: this.canvas.width / 2 - 25,
                                y: -50,
                                targetY: 60,
                                width: 50,
                                height: 50,
                                color: '#fcc419', // 黄色いミニボス
                                direction: 1,
                                lastShotTime: 0,
                                hp: 10 // 通常攻撃10発分（レーザーなら5発）
                            };
                            document.getElementById('boss-hp-area').style.display = "block";
                            document.getElementById('boss-hp-val').innerText = "10";
                            document.getElementById('stage-objective').innerHTML = 'ミニボスを撃破せよ！';
                        } else if (this.gameState.currentChapter === 2 && !this.isCh2EventStarted && this.gameState.killCount >= 3) {
                            this.isCh2EventStarted = true; 
                            this.enemies = [];
                            this.bullets = [];
                            this.cancelLoop();
                            this.onCh2EventTrigger();
                            return; 
                        } else if (this.gameState.currentChapter === 4 && !this.isCh4MiniBossActive && !this.isCh4MidBossEventStarted && this.gameState.killCount >= 3) {
                            this.isCh4MiniBossActive = true;
                            this.enemies = [];
                            this.bullets = [];
                            
                            // ★4面の小ボス(HP: 10)も画面外（y: -50）からスーッと登場する演出を起動します
                            this.isBossEntranceAnimating = true;
                            this.boss = {
                                x: this.canvas.width / 2 - 25,
                                y: -50,
                                targetY: 50,
                                width: 50,
                                height: 50,
                                color: '#fcc419', 
                                direction: 1,
                                lastShotTime: 0,
                                hp: 10
                            };
                            document.getElementById('boss-hp-area').style.display = "block";
                            document.getElementById('boss-hp-val').innerText = "10";
                            document.getElementById('stage-objective').innerHTML = '小ボスを撃破せよ！';
                        }
                    } else if (this.gameState.currentChapter === 3 && e.isTarget) {
                        this.ch3TargetsHit++;
                        document.getElementById('kill-count').innerText = this.ch3TargetsHit;
                        const hitTargetEl = document.getElementById('ch3-hit-target');
                        if (hitTargetEl) {
                            hitTargetEl.innerText = this.ch3TargetsHit;
                        }
                    }
                }
            }

            if (b.y >= -20 && b.y <= this.canvas.height + 20 && !bulletRemoved) {
                nextBullets.push(b);
            }
        }
        this.bullets = nextBullets;

        // 2. 敵更新＆体当たり判定
        let nextEnemies = [];
        for (let i = 0; i < this.enemies.length; i++) {
            let e = this.enemies[i];
            e.y += e.speed;

            // 自機との直接的な衝突（体当たり）判定
            let hitPlayerByBody = false;
            if (!e.toRemove && e.x < this.player.x + this.player.width && e.x + e.width > this.player.x &&
                e.y < this.player.y + this.player.height && e.y + e.height > this.player.y) {
                
                hitPlayerByBody = true;
                e.toRemove = true; // 衝突したゾンビ（またはマト）は消滅

                // ★修行ステージのマト（isTarget）であれば衝突してもダメージを受けない安全対策
                if (!e.isTarget && (now - this.player.lastHitTime >= 1000)) {
                    this.player.lastHitTime = now; // 被弾時間の記録（1秒間の無敵開始）
                    
                    if (this.gameState.allies.length > 0) {
                        this.gameState.allies.pop();
                        this.updateAllyUI();
                        this.flashScreen();
                    } else {
                        // 体当たりダメージ
                        this.gameState.playerHP -= 15;
                        document.getElementById('hp-value').innerText = this.gameState.playerHP;
                        
                        const hpBar = document.getElementById('hp-gauge-bar');
                        if (hpBar) {
                            hpBar.style.width = Math.max(0, this.gameState.playerHP) + '%';
                        }
                        this.flashScreen();
                        if (this.gameState.playerHP <= 0) {
                            this.endGame(false);
                            return; // ★重要
                        }
                    }
                }
            }
            
            if (!e.toRemove && e.y <= this.canvas.height + 40) {
                nextEnemies.push(e);

                this.ctx.fillStyle = e.color;
                this.ctx.beginPath();
                this.ctx.arc(e.x + e.width/2, e.y + e.height/2, e.width/2, 0, Math.PI * 2);
                this.ctx.fill();

                if (this.gameState.currentChapter === 3) {
                    this.ctx.fillStyle = '#ffffff';
                    this.ctx.beginPath();
                    this.ctx.arc(e.x + e.width/2, e.y + e.height/2, e.width/4, 0, Math.PI * 2);
                    this.ctx.fill();
                }
            }
        }
        this.enemies = nextEnemies;

        // 3. 敵弾更新（ボス登場中や大ボス巨大化演出中は被弾判定を一時停止）
        let nextEnemyBullets = [];
        let canTakeBulletDamage = !this.isBossEntranceAnimating && !this.isCh4GreatBossSpawnAnimating;
        for (let i = 0; i < this.enemyBullets.length; i++) {
            let eb = this.enemyBullets[i];
            eb.x += eb.vx || 0;
            eb.y += eb.vy || 0;

            let hitPlayer = false;

            if (canTakeBulletDamage && eb.x < this.player.x + this.player.width && eb.x + eb.width > this.player.x &&
                eb.y < this.player.y + this.player.height && eb.y + eb.height > this.player.y) {
                
                hitPlayer = true;

                if (now - this.player.lastHitTime >= 1000) {
                    this.player.lastHitTime = now; // 被弾時間の記録（1秒間の無敵開始）

                    if (this.gameState.allies.length > 0) {
                        this.gameState.allies.pop();
                        this.updateAllyUI();
                        this.flashScreen();
                    } else {
                        // 弾被弾ダメージ
                        this.gameState.playerHP -= 10;
                        document.getElementById('hp-value').innerText = this.gameState.playerHP;
                        
                        // HPビジュアルゲージバーの更新
                        const hpBar = document.getElementById('hp-gauge-bar');
                        if (hpBar) {
                            hpBar.style.width = Math.max(0, this.gameState.playerHP) + '%';
                        }

                        this.flashScreen();
                        if (this.gameState.playerHP <= 0) {
                            this.endGame(false);
                            return; // ★重要
                        }
                    }
                }
            }

            if (eb.y <= this.canvas.height + 20 && eb.y >= -20 && !hitPlayer) {
                nextEnemyBullets.push(eb);

                this.ctx.fillStyle = eb.color;
                this.ctx.beginPath();
                this.ctx.arc(eb.x + eb.width/2, eb.y + eb.height/2, eb.width/2, 0, Math.PI * 2);
                this.ctx.fill();
            }
        }
        this.enemyBullets = nextEnemyBullets;

        // 4. アイテム更新（ボス登場中や大ボス巨大化演出中はアイテム獲得判定を一時停止）
        let nextItems = [];
        let canCollectItems = !this.isBossEntranceAnimating && !this.isCh4GreatBossSpawnAnimating;
        for (let i = 0; i < this.items.length; i++) {
            let item = this.items[i];
            item.y += 2;

            let collected = false;

            if (canCollectItems && item.x < this.player.x + this.player.width && item.x + item.width > this.player.x &&
                item.y < this.player.y + this.player.height && item.y + item.height > this.player.y) {
                
                collected = true;
                this.collectItem(item);
            }

            if (item.y <= this.canvas.height + 20 && !collected) {
                nextItems.push(item);

                this.ctx.fillStyle = item.color;
                this.ctx.fillRect(item.x, item.y, item.width, item.height);
                this.ctx.fillStyle = '#000000';
                this.ctx.font = 'bold 10px sans-serif';
                this.ctx.fillText(item.label, item.x + 5, item.y + 12);
            }
        }
        this.items = nextItems;

        // 次フレームの予約
        this.animationId = requestAnimationFrame(() => this.loop());
    }

    firePlayerBullet(x, y) {
        let type = this.gameState.weaponType;
        let bSpeed = 8;
        if (type === 'normal') {
            this.bullets.push({ x: x - 4, y: y, width: 8, height: 15, vx: 0, vy: -bSpeed, isLaser: false });
        } else if (type === 'double') {
            this.bullets.push({ x: x - 15, y: y, width: 8, height: 15, vx: 0, vy: -bSpeed, isLaser: false });
            this.bullets.push({ x: x + 7, y: y, width: 8, height: 15, vx: 0, vy: -bSpeed, isLaser: false });
        } else if (type === 'laser') {
            this.bullets.push({ x: x - 3, y: y - 50, width: 6, height: 80, vx: 0, vy: -12, isLaser: true });
        } else if (type === 'legend') {
            // ルール2：3方向ショットもvx / vy分解を徹底
            this.bullets.push({ x: x - 4, y: y, width: 8, height: 15, vx: 0, vy: -bSpeed, isLaser: false });
            this.bullets.push({ x: x - 15, y: y, width: 8, height: 15, vx: Math.sin(-0.2) * bSpeed, vy: -Math.cos(-0.2) * bSpeed, isLaser: false });
            this.bullets.push({ x: x + 7, y: y, width: 8, height: 15, vx: Math.sin(0.2) * bSpeed, vy: -Math.cos(0.2) * bSpeed, isLaser: false });
        }
    }

    spawnItem(x, y) {
        const types = [
            { label: 'W', color: '#e5dbff', type: 'weapon_double' },
            { label: 'L', color: '#c5f6fa', type: 'weapon_laser' },
            { label: 'B', color: '#ffc9c9', type: 'bomb' },
            { label: 'A', color: '#ffdeeb', type: 'ally_attacker' },
            { label: 'H', color: '#d3f9d8', type: 'ally_healer' }
        ];
        let select = types[Math.floor(Math.random() * types.length)];
        this.items.push({ x: x, y: y, width: 20, height: 20, color: select.color, label: select.label, type: select.type });
    }

    collectItem(item) {
        if (item.type === 'weapon_double') this.gameState.weaponType = 'double';
        if (item.type === 'weapon_laser') this.gameState.weaponType = 'laser';
        if (item.type === 'bomb') {
            this.gameState.bombs++;
            this.updateBombUI();
        }
        if (item.type === 'ally_attacker') {
            if (!this.gameState.allies.includes('attacker')) this.gameState.allies.push('attacker');
            this.updateAllyUI();
        }
        if (item.type === 'ally_healer') {
            if (!this.gameState.allies.includes('healer')) this.gameState.allies.push('healer');
            this.updateAllyUI();
        }
    }

    cancelLoop() {
        cancelAnimationFrame(this.animationId);
    }

    endGame(isWin) {
        this.isGameOver = true;
        cancelAnimationFrame(this.animationId);
        this.onStageEnd(isWin);
    }
}