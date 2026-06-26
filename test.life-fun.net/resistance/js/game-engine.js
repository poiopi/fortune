export class GameEngine {
    constructor(gameState, onStageEnd, onCh2EventTrigger, onCh4MidBossTrigger) {
        this.gameState = gameState;
        this.onStageEnd = onStageEnd;
        this.onCh2EventTrigger = onCh2EventTrigger;
        this.onCh4MidBossTrigger = onCh4MidBossTrigger;

        this.canvas = document.getElementById('gameCanvas');
        this.ctx = this.canvas.getContext('2d');
        
        this.player = { 
            x: 200, y: 550, width: 40, height: 40, color: '#ffb7c5',
            lastHitTime: 0 
        };
        this.bullets = [];
        this.enemies = [];
        this.enemyBullets = [];
        this.items = [];
        this.boss = null;

        this.isGameOver = false;
        this.isBossEntranceAnimating = false;
        this.isBossExploding = false;
        this.bossExplosionStartTime = 0;
        this.particles = [];
        this.animationId = null;

        this.lastEnemyTime = 0;
        this.lastShootTime = 0;
        this.lastAllyShootTime = 0;
        this.lastHealTime = 0;

        // 動的に注入されるチャプターごとの個別ロジックオブジェクト
        this.chapterLogic = null;

        this.setupControls();
    }

    setupControls() {
        const self = this;
        const shootScreen = document.getElementById('screen-shooting');

        shootScreen.addEventListener('mousemove', function(e) {
            if (self.isGameOver || (self.chapterLogic && self.chapterLogic.isDefeatedSceneActive && self.chapterLogic.isDefeatedSceneActive(self)) || (self.chapterLogic && self.chapterLogic.isSpawnAnimating && self.chapterLogic.isSpawnAnimating(self)) || self.isBossExploding) return;
            const rect = self.canvas.getBoundingClientRect();
            const scaleX = self.canvas.width / rect.width;
            const scaleY = self.canvas.height / rect.height;

            self.player.x = (e.clientX - rect.left) * scaleX - self.player.width / 2;
            self.player.y = (e.clientY - rect.top) * scaleY - self.player.height / 2;

            self.player.x = Math.max(0, Math.min(self.canvas.width - self.player.width, self.player.x));
            self.player.y = Math.max(0, Math.min(self.canvas.height - self.player.height, self.player.y));
        });

        shootScreen.addEventListener('touchmove', function(e) {
            if (self.isGameOver || (self.chapterLogic && self.chapterLogic.isDefeatedSceneActive && self.chapterLogic.isDefeatedSceneActive(self)) || (self.chapterLogic && self.chapterLogic.isSpawnAnimating && self.chapterLogic.isSpawnAnimating(self)) || self.isBossExploding) return;
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

    // 各面の開始時に、メイン制御側から個別チャプターロジックオブジェクトを注入します
    initStage(chapterLogic) {
        this.chapterLogic = chapterLogic;
        this.canvas.width = this.canvas.parentNode.clientWidth;
        this.canvas.height = this.canvas.parentNode.clientHeight;

        this.player.x = this.canvas.width / 2 - this.player.width / 2;
        this.player.y = this.canvas.height - 100;
        this.player.lastHitTime = 0; 

        this.isGameOver = false;
        this.isBossEntranceAnimating = false;
        this.isBossExploding = false;
        this.particles = [];
        this.bullets = [];
        this.enemies = [];
        this.enemyBullets = [];
        this.items = [];
        this.boss = null;
        this.isCh2EventTriggered = false;
        this.isCh4MidBossEventTriggered = false;

        this.updateBombUI();
        this.updateAllyUI();

        this.gameState.killCount = 0;
        document.getElementById('kill-count').innerText = this.gameState.killCount;
        document.getElementById('score-val').innerText = this.gameState.score;
        document.getElementById('boss-hp-area').style.display = "none";

        document.getElementById('stage-title').innerText = "STAGE " + this.gameState.currentChapter;

        // チャプターごとの固有初期化処理をコールバック
        if (this.chapterLogic && typeof this.chapterLogic.initStage === 'function') {
            this.chapterLogic.initStage(this);
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
        if (this.gameState.bombs <= 0 || this.isGameOver || (this.chapterLogic && this.chapterLogic.isDefeatedSceneActive && this.chapterLogic.isDefeatedSceneActive(this)) || (this.chapterLogic && this.chapterLogic.isSpawnAnimating && this.chapterLogic.isSpawnAnimating(this)) || this.isBossEntranceAnimating || this.isBossExploding) return;
        this.gameState.bombs--;
        this.updateBombUI();
        this.flashScreen();

        // ボス出現前のボム全滅処理
        if (this.gameState.currentChapter === 1 || (this.gameState.currentChapter === 2 && !this.isCh2EventTriggered) || (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventTriggered)) {
            this.gameState.killCount += this.enemies.length;
            this.gameState.score += this.enemies.length * 100;
            document.getElementById('kill-count').innerText = this.gameState.killCount;
            document.getElementById('score-val').innerText = this.gameState.score;
            this.enemies = [];
            
            if (this.gameState.currentChapter === 1 && !this.isCh1BossActive && this.gameState.killCount >= 10) {
                this.endGame(true);
            }
        } else if (this.boss) {
            // ボス存在時のボム処理をチャプターロジックへ委譲
            if (this.chapterLogic && typeof this.chapterLogic.handleBombDamage === 'function') {
                this.chapterLogic.handleBombDamage(this);
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

        let now = Date.now();
        let isInvincible = (now - this.player.lastHitTime < 1000);
        let isCh4GreatBossSpawnAnimating = (this.chapterLogic && this.chapterLogic.isSpawnAnimating && this.chapterLogic.isSpawnAnimating(this));
        let shouldDrawPlayer = (!isInvincible || (Math.floor(now / 100) % 2 === 0)) && !isCh4GreatBossSpawnAnimating;

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
        if (this.gameState.allies.includes('healer') && !isCh4GreatBossSpawnAnimating) {
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

        // チャプターごとの特有の継続タイマーや更新処理を実行
        if (this.chapterLogic && typeof this.chapterLogic.updateFrame === 'function') {
            const shouldStop = this.chapterLogic.updateFrame(this, now);
            if (shouldStop) return; // 各ロジックがcancelLoop()を呼び出して終了した場合は処理を遮断
        }

        // プレイヤー弾丸自動射撃
        let isCh2DefeatedSceneActive = (this.chapterLogic && this.chapterLogic.isDefeatedSceneActive && this.chapterLogic.isDefeatedSceneActive(this));
        let canShoot = !isCh2DefeatedSceneActive && !isCh4GreatBossSpawnAnimating && !this.isBossEntranceAnimating && !this.isBossExploding;
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
        if (!isCh4GreatBossSpawnAnimating) {
            this.gameState.allies.forEach((ally, index) => {
                this.ctx.fillStyle = ally === 'attacker' ? '#ff6b6b' : '#51cf66';
                this.ctx.beginPath();
                let offset = index === 0 ? -25 : 25;
                this.ctx.arc(this.player.x + this.player.width/2 + offset, this.player.y + this.player.height + 10, 10, 0, Math.PI * 2);
                this.ctx.fill();
            });
        }

        // --- ゾンビの生成処理（個別チャプターロジックへ委譲） ---
        if (this.chapterLogic && typeof this.chapterLogic.spawnEnemies === 'function') {
            this.chapterLogic.spawnEnemies(this, now);
        }

        // --- ボス登場演出（グローバル共通処理：y:-50 から targetY までスーッと降りてきます） ---
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

            if (this.chapterLogic && typeof this.chapterLogic.drawBossEntranceDecoration === 'function') {
                this.chapterLogic.drawBossEntranceDecoration(this);
            }
        }
        // --- 大ボス巨大化演出（Ch.4専用：個別チャプター側で描画制御） ---
        else if (this.chapterLogic && typeof this.chapterLogic.drawSpawnAnimation === 'function' && isCh4GreatBossSpawnAnimating) {
            this.chapterLogic.drawSpawnAnimation(this);
        }
        // --- 共通アクティブボス（戦闘中）の制御 ---
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

            // チャプターごとの専用装飾を委譲
            if (this.chapterLogic && typeof this.chapterLogic.drawBossDecoration === 'function') {
                this.chapterLogic.drawBossDecoration(this);
            }

            // ボス弾丸発射の委譲
            if (this.chapterLogic && typeof this.chapterLogic.updateBossAttack === 'function') {
                this.chapterLogic.updateBossAttack(this, now);
            }
        }

        // ボス撃破時の1秒間の大爆発エフェクト処理（共通）
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
                
                // 撃破後の章切り替え処理は各チャプターロジックの管理に完全に委譲します
                if (this.chapterLogic && typeof this.chapterLogic.onBossDefeated === 'function') {
                    this.chapterLogic.onBossDefeated(this);
                }
                return;
            }
        }

        // 通常ザコゾンビの反撃射撃処理（共通）
        let canZombiesAttack = !this.isBossEntranceAnimating && !isCh4GreatBossSpawnAnimating && !this.isBossExploding;
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

        // --- ルール1：新配列方式での衝突判定処理 ---
        // 1. プレイヤー弾更新
        let nextBullets = [];
        for (let i = 0; i < this.bullets.length; i++) {
            let b = this.bullets[i];
            b.x += b.vx || 0;
            b.y += b.vy || 0;

            this.ctx.fillStyle = b.isLaser ? '#4dabf7' : '#ff6b8b';
            this.ctx.fillRect(b.x, b.y, b.width, b.height);

            let bulletRemoved = false;

            // ボスへの当たり判定を委譲
            if (this.boss && !this.isBossEntranceAnimating && !this.isBossExploding) {
                if (b.x < this.boss.x + this.boss.width && b.x + b.width > this.boss.x &&
                    b.y < this.boss.y + this.boss.height && b.y + b.height > this.boss.y) {
                    
                    bulletRemoved = true;
                    
                    if (this.chapterLogic && typeof this.chapterLogic.onBossHit === 'function') {
                        this.chapterLogic.onBossHit(this, b);
                    }
                }
            }

            for (let j = 0; j < this.enemies.length; j++) {
                let e = this.enemies[j];
                if (!e.toRemove && b.x < e.x + e.width && b.x + b.width > e.x &&
                    b.y < e.y + e.height && b.y + b.height > e.y) {
                    
                    e.toRemove = true;
                    if (!b.isLaser) bulletRemoved = true;

                    // スコア更新処理
                    if (this.gameState.currentChapter === 1 || (this.gameState.currentChapter === 2 && !this.isCh2EventTriggered) || (this.gameState.currentChapter === 4 && !this.isCh4MidBossEventTriggered)) {
                        this.gameState.killCount++;
                        this.gameState.score += 100;
                        document.getElementById('kill-count').innerText = this.gameState.killCount;
                        document.getElementById('score-val').innerText = this.gameState.score;
                        
                        if (Math.random() < 0.4) this.spawnItem(e.x, e.y);

                        // ザコ敵撃退時のトリガー進行をチャプターロジックへ委譲
                        if (this.chapterLogic && typeof this.chapterLogic.onEnemyKilled === 'function') {
                            const shouldStop = this.chapterLogic.onEnemyKilled(this, e);
                            if (shouldStop) return; // 強制終了時はフレーム予約を即時遮断
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

            let hitPlayerByBody = false;
            if (!e.toRemove && e.x < this.player.x + this.player.width && e.x + e.width > this.player.x &&
                e.y < this.player.y + this.player.height && e.y + e.height > this.player.y) {
                
                hitPlayerByBody = true;
                e.toRemove = true; // 衝突した敵は消滅

                // 修行マト（isTarget）は接触ダメージを受けない
                if (!e.isTarget && (now - this.player.lastHitTime >= 1000)) {
                    this.player.lastHitTime = now;
                    
                    if (this.gameState.allies.length > 0) {
                        this.gameState.allies.pop();
                        this.updateAllyUI();
                        this.flashScreen();
                    } else {
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
        let canTakeBulletDamage = !this.isBossEntranceAnimating && !isCh4GreatBossSpawnAnimating && !this.isBossExploding;
        let canCollectItems = !this.isBossEntranceAnimating && !isCh4GreatBossSpawnAnimating && !this.isBossExploding;
        let nextEnemyBullets = [];
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

        // 4. アイテム更新
        let nextItems = [];
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
}