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
        this.isBossEntranceAnimating = false; // ボスが画面外から登場する演出中フラグ

        // ★ボス撃破時の爆発エフェクト管理用パラメータ
        this.isBossExploding = false;
        this.bossExplosionStartTime = 0;
        this.particles = [];

        // ★チャプター2被弾カウンター（20発命中トリガー用）
        this.stage2BossHits = 0;

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
        // 画面全体（#screen-shooting）でスライド入力を監視します。
        const shootScreen = document.getElementById('screen-shooting');

        // マウス移動（PC） - 上下左右（360度）の追従移動
        shootScreen.addEventListener('mousemove', function(e) {
            if (self.isGameOver || self.isCh2DefeatedSceneActive || self.isCh4GreatBossSpawnAnimating || self.isBossExploding) return;
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
            if (self.isGameOver || self.isCh2DefeatedSceneActive || self.isCh4GreatBossSpawnAnimating || self.isBossExploding) return;
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
        this.isCh1BossActive = false; 
        this.isBossEntranceAnimating = false; 
        this.isBossExploding = false; 
        this.particles = [];          
        this.isCh2EventStarted = false; 
        this.isCh2EventTriggered = false; 
        this.isCh2DefeatedSceneActive = false;
        this.stage2BossHits = 0; // 初期化

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

        // ステージタイトルを現在のチャプター数に動的に書き換え
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
        if (this.gameState.bombs <= 0 || this.isGameOver || this.isCh2DefeatedSceneActive || this.isCh4GreatBossSpawnAnimating || this.isBossEntranceAnimating || this.isBossExploding) return;
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
            if (this.gameState.currentChapter === 2) {
                // 2面ボスにボムを使った場合は、撃破せず被弾カウンターを15発分増やす（一撃でイベントを引き寄せられます）
                this.stage2BossHits = (this.stage2BossHits || 0) + 15;
                if (this.stage2BossHits >= 20 && !this.isCh2DefeatedSceneActive) {
                    this.isCh2DefeatedSceneActive = true;
                    this.cancelLoop();
                    this.onStageEnd(false, "ch2_scripted_defeat");
                    return;
                }
            } else {
                // 1面、4面ボスへのダメージ処理
                this.boss.hp -= 15;
                document.getElementById('boss-hp-val').innerText = Math.max(0, this.boss.hp);
                if (this.boss.hp <= 0) {
                    this.triggerBossExplosion();
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

    triggerBossExplosion() {
        this.isBossExploding = true;
        this.bossExplosionStartTime = Date.now();
        this.flashScreen();

        this.particles = [];
        for (let k = 0; k < 30; k++) {
            let angle = Math.random() * Math.PI * 2;
            let speed = 2 + Math.random() * 5;
            this.particles.push({
                x: this.boss.x + this.boss.width / 2,
                y: this.boss.y + this.boss.height / 2,
                vx: Math.sin(angle) * speed,
                vy: Math.cos(angle) * speed,
                radius: 3 + Math.random() * 5,
                color: ['#ff6b6b', '#fcc419', '#51cf66', '#339af0', '#ae3ec9'][Math.floor(Math.random() * 5)],
                alpha: 1
            });
        }
    }

    loop() {
        if (this.isGameOver) return;

        this.ctx.fillStyle = '#e3fafc';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        // 自機の描画（無敵時間中は100msごとに点滅、ボス爆発中も操作だけは可能）
        let now = Date.now();
        let shouldDrawPlayer = (now - this.player.lastHitTime >= 1000) || (Math.floor(now / 100) % 2 === 0);

        if (shouldDrawPlayer) {
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

        // シューティング弾自動射撃（★ボス登場演出中、およびボス爆発中は弾が出ない）
        let canShoot = !this.isCh2DefeatedSceneActive && !this.isCh4GreatBossSpawnAnimating && !this.isBossEntranceAnimating && !this.isBossExploding;
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

        // --- ザコゾンビの生成（チャプター個別） ---
        if (this.gameState.currentChapter === 1) {
            let canSpawnZombies = !this.isBossEntranceAnimating && !this.isBossExploding;
            let spawnInterval = this.isCh1BossActive ? 2500 : 1500;
            if (canSpawnZombies && (now - this.lastEnemyTime > spawnInterval)) {
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
            if (!this.isCh4MidBossEventTriggered) {
                if (now - this.lastEnemyTime > 1500) {
                    let enemyX = Math.random() * (this.canvas.width - 40);
                    let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                    this.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                    this.lastEnemyTime = now;
                }
            }
        }

        // --- ボス登場演出（グローバル共通処理） ---
        if (this.isBossEntranceAnimating && this.boss) {
            this.boss.y += 2; 
            if (this.boss.y >= this.boss.targetY) {
                this.boss.y = this.boss.targetY;
                this.isBossEntranceAnimating = false; // 到着したら戦闘開始
                this.boss.lastShotTime = Date.now();
            }

            // 登場中のボスを画面に描画
            this.ctx.fillStyle = this.boss.color;
            this.ctx.beginPath();
            this.ctx.arc(this.boss.x + this.boss.width/2, this.boss.y + this.boss.height/2, this.boss.width/2, 0, Math.PI * 2);
            this.ctx.fill();

            if (this.gameState.currentChapter === 1) {
                this.ctx.fillStyle = '#e64980';
                this.ctx.fillRect(this.boss.x + this.boss.width/2 - 10, this.boss.y + this.boss.height/2 - 2, 20, 4);
            }
        }
        // --- 大ボス巨大化演出（Ch.4専用） ---
        else if (this.gameState.currentChapter === 4 && this.isCh4GreatBossSpawnAnimating) {
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
        }
        // ★不具合解消箇所：共通のアクティブなボス（STAGE1/STAGE2/STAGE4のボス共通）の動作と描画
        else if (this.boss && !this.isBossExploding) {
            this.boss.x += this.boss.direction * 3;
            if (this.boss.x < 10 || this.boss.x > this.canvas.width - this.boss.width - 10) {
                this.boss.direction *= -1;
            }

            // ボス本体の描画
            this.ctx.fillStyle = this.boss.color;
            this.ctx.beginPath();
            this.ctx.arc(this.boss.x + this.boss.width/2, this.boss.y + this.boss.height/2, this.boss.width/2, 0, Math.PI * 2);
            this.ctx.fill();

            // チャプターごとの専用グラフィック装飾
            if (this.gameState.currentChapter === 4 && this.isCh4GreatBossActive) {
                // 大ボス
                this.ctx.fillStyle = '#e64980';
                this.ctx.fillRect(this.boss.x + this.boss.width/2 - 25, this.boss.y + this.boss.height/2 - 5, 50, 10);
            } else if (this.gameState.currentChapter === 4 && this.isCh4MidBossEventTriggered) {
                // 中ボス
                this.ctx.fillStyle = '#1c7ed6';
                this.ctx.fillRect(this.boss.x + this.boss.width/2 - 15, this.boss.y + this.boss.height/2 - 3, 30, 6);
            } else if (this.gameState.currentChapter === 4 && this.isCh4MiniBossActive) {
                // 小ボス
                this.ctx.fillStyle = '#fcc419';
                this.ctx.fillRect(this.boss.x + this.boss.width/2 - 8, this.boss.y + this.boss.height/2 - 2, 16, 4);
            } else if (this.gameState.currentChapter === 2) {
                // 2面巨大ボス
                this.ctx.fillStyle = '#333';
                this.ctx.fillRect(this.boss.x + 30, this.boss.y + 35, 8, 8);
                this.ctx.fillRect(this.boss.x + 62, this.boss.y + 35, 8, 8);
                this.ctx.fillStyle = '#ff6b8b';
                this.ctx.fillRect(this.boss.x + 40, this.boss.y + 65, 20, 5);
            } else if (this.gameState.currentChapter === 1) {
                // 1面ミニボス
                this.ctx.fillStyle = '#e64980';
                this.ctx.fillRect(this.boss.x + this.boss.width/2 - 10, this.boss.y + this.boss.height/2 - 2, 20, 4);
            }

            // ボス攻撃
            if (now - this.boss.lastShotTime > 1000) {
                let bSpeed = 4;
                if (this.gameState.currentChapter === 4 && this.isCh4GreatBossActive) {
                    this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 12, height: 12, vx: 0, vy: bSpeed, color: '#f03e3e' });
                    this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 12, height: 12, vx: Math.sin(-0.3)*bSpeed, vy: Math.cos(-0.3)*bSpeed, color: '#f03e3e' });
                    this.enemyBullets.push({ x: this.boss.x + this.boss.width/2, y: this.boss.y + this.boss.height, width: 12, height: 12, vx: Math.sin(0.3)*bSpeed, vy: Math.cos(0.3)*bSpeed, color: '#f03e3e' });
                } else if (this.gameState.currentChapter === 1 || this.gameState.currentChapter === 2 || this.gameState.currentChapter === 4) {
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

        // ボス大爆発・フラッシュの1秒間の非同期エフェクト処理
        if (this.isBossExploding) {
            let nextParticles = [];
            for (let k = 0; k < this.particles.length; k++) {
                let p = this.particles[k];
                p.x += p.vx;
                p.y += p.vy;
                p.alpha -= 0.02; // スーッとフェードアウト
                
                if (p.alpha > 0) {
                    nextParticles.push(p);
                    this.ctx.save();
                    this.ctx.globalAlpha = p.alpha;
                    this.ctx.fillStyle = p.color;
                    this.ctx.beginPath();
                    this.ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    this.ctx.fill();
                    this.ctx.restore();
                }
            }
            this.particles = nextParticles;

            if (now - this.bossExplosionStartTime > 1000) {
                this.isBossExploding = false;
                this.cancelLoop();
                
                let savedChapter = this.gameState.currentChapter;
                let isMidBossDefeatedLocal = this.isCh4MidBossDefeated;
                this.boss = null; // ボスを消去

                if (savedChapter === 1) {
                    this.endGame(true); // 1面クリア！
                } else if (savedChapter === 4 && !this.isCh4MidBossEventStarted) {
                    this.isCh4MidBossEventStarted = true;
                    this.onCh4MidBossTrigger();
                } else if (savedChapter === 4 && this.isCh4MidBossEventTriggered && !isMidBossDefeatedLocal) {
                    this.isCh4MidBossDefeated = true;
                    this.onStageEnd(true, "ch4_midboss_defeated");
                } else {
                    this.endGame(true); // 4面大ボス撃破！
                }
                return;
            }
        }

        // ザコ反撃（ボス登場演出中・巨大化中・ボス大爆発中は攻撃してこない）
        let canZombiesAttack = !this.isBossEntranceAnimating && !this.isCh4GreatBossSpawnAnimating && !this.isBossExploding;
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

            // ボス登場中・爆発中はボスへの攻撃が無効化されます
            if (this.boss && !this.isBossEntranceAnimating && !this.isBossExploding) {
                if (b.x < this.boss.x + this.boss.width && b.x + b.width > this.boss.x &&
                    b.y < this.boss.y + this.boss.height && b.y + b.height > this.boss.y) {
                    bulletRemoved = true;
                    
                    if (this.gameState.currentChapter === 2) {
                        // ★重要：ステージ2のボスは無敵。20発（レーザーは2ダメージ換算で10発）当たったら強制敗北へ遷移
                        this.stage2BossHits = (this.stage2BossHits || 0) + (b.isLaser ? 2 : 1);
                        
                        // 白い火花エフェクト
                        this.ctx.fillStyle = '#fff';
                        this.ctx.fillRect(b.x - 10, b.y - 10, 20, 20);

                        if (this.stage2BossHits >= 20 && !this.isCh2DefeatedSceneActive) {
                            this.isCh2DefeatedSceneActive = true;
                            this.cancelLoop();
                            this.onStageEnd(false, "ch2_scripted_defeat");
                            return; // 即時遮断
                        }
                    } else {
                        // 通常ボス（1面、4面中ボス・大ボス・小ボス）の当たり判定
                        let damage = b.isLaser ? 2 : 1;
                        this.boss.hp = (this.boss.hp || 0) - damage;
                        
                        const hpValEl = document.getElementById('boss-hp-val');
                        if (hpValEl && this.boss.hp !== undefined) {
                            hpValEl.innerText = Math.max(0, this.boss.hp);
                        }
                        
                        if (this.boss.hp !== undefined && this.boss.hp <= 0) {
                            this.triggerBossExplosion();
                        }
                    }
                }
            } else if (this.gameState.currentChapter === 2 && this.boss && !this.isBossEntranceAnimating && !this.isBossExploding) {
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

                        // ザコ撃破時の各ボス起動トリガー
                        if (this.gameState.currentChapter === 1 && !this.isCh1BossActive && this.gameState.killCount >= 8) {
                            this.isCh1BossActive = true;
                            this.enemies = []; 
                            this.enemyBullets = []; 
                            this.isBossEntranceAnimating = true; 
                            this.boss = {
                                x: this.canvas.width / 2 - 25,
                                y: -50,
                                targetY: 60,
                                width: 50,
                                height: 50,
                                color: '#fcc419', 
                                direction: 1,
                                lastShotTime: 0,
                                hp: 10 
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
                e.toRemove = true; 

                // 修行ステージのマト（isTarget）であれば衝突してもダメージを受けない
                if (!e.isTarget && (now - this.player.lastHitTime >= 1000)) {
                    this.player.lastHitTime = now; // 被弾時間記録
                    
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
                            return; 
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

        // 3. 敵弾更新（ボス登場中・巨大化中・爆発中は被弾判定を一時停止）
        let nextEnemyBullets = [];
        let canTakeBulletDamage = !this.isBossEntranceAnimating && !this.isCh4GreatBossSpawnAnimating && !this.isBossExploding;
        for (let i = 0; i < this.enemyBullets.length; i++) {
            let eb = this.enemyBullets[i];
            eb.x += eb.vx || 0;
            eb.y += eb.vy || 0;

            let hitPlayer = false;

            if (canTakeBulletDamage && eb.x < this.player.x + this.player.width && eb.x + eb.width > this.player.x &&
                eb.y < this.player.y + this.player.height && eb.y + eb.height > this.player.y) {
                
                hitPlayer = true;

                if (now - this.player.lastHitTime >= 1000) {
                    this.player.lastHitTime = now; 

                    if (this.gameState.allies.length > 0) {
                        this.gameState.allies.pop();
                        this.updateAllyUI();
                        this.flashScreen();
                    } else {
                        this.gameState.playerHP -= 10;
                        document.getElementById('hp-value').innerText = this.gameState.playerHP;
                        
                        const hpBar = document.getElementById('hp-gauge-bar');
                        if (hpBar) {
                            hpBar.style.width = Math.max(0, this.gameState.playerHP) + '%';
                        }

                        this.flashScreen();
                        if (this.gameState.playerHP <= 0) {
                            this.endGame(false);
                            return; 
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

        // 4. アイテム更新（ボス登場中・巨大化中・爆発中はアイテム獲得判定を一時停止）
        let nextItems = [];
        let canCollectItems = !this.isBossEntranceAnimating && !this.isCh4GreatBossSpawnAnimating && !this.isBossExploding;
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