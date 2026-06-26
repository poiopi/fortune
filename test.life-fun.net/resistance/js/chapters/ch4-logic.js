export const ch4Logic = {
    initStage(engine) {
        engine.isCh4MiniBossActive = false;
        engine.isCh4MidBossEventStarted = false;
        engine.isCh4MidBossEventTriggered = false;
        engine.isCh4MidBossDefeated = false;
        engine.isCh4GreatBossSpawnAnimating = false;
        engine.isCh4GreatBossActive = false;
    },

    spawnEnemies(engine, now) {
        if (!engine.isCh4MidBossEventTriggered) {
            if (now - engine.lastEnemyTime > 1500) {
                let enemyX = Math.random() * (engine.canvas.width - 40);
                let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                engine.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                engine.lastEnemyTime = now;
            }
        }
    },

    onEnemyKilled(engine, enemy) {
        // 通常ザコ3体撃破で小ボス（マカロン試作型：HP10）が出現
        if (!engine.isCh4MiniBossActive && !engine.isCh4MidBossEventStarted && engine.gameState.killCount >= 3) {
            engine.isCh4MiniBossActive = true;
            engine.enemies = [];
            engine.bullets = [];
            engine.isBossEntranceAnimating = true;
            engine.boss = {
                x: engine.canvas.width / 2 - 25,
                y: -50,
                targetY: 50,
                width: 50,
                height: 50,
                color: '#fcc419', // ゴールド
                direction: 1,
                lastShotTime: 0,
                hp: 10
            };
            document.getElementById('boss-hp-area').style.display = "block";
            document.getElementById('boss-hp-val').innerText = "10";
            document.getElementById('stage-objective').innerHTML = '小ボスを撃破せよ！';
        }
        return false;
    },

    onBossHit(engine, bullet) {
        let damage = bullet.isLaser ? 2 : 1;
        engine.boss.hp = (engine.boss.hp || 0) - damage;
        document.getElementById('boss-hp-val').innerText = Math.max(0, engine.boss.hp);
        
        if (engine.boss.hp <= 0) {
            engine.cancelLoop();
            if (!engine.isCh4MidBossEventStarted) {
                // 小ボス撃破 ➔ 中ボス出現前ダイアログへ
                engine.isCh4MidBossEventStarted = true;
                engine.boss = null;
                engine.onCh4MidBossTrigger(); // main.jsの中ボス会話へ
            } else if (!engine.isCh4MidBossDefeated) {
                // 中ボス撃破 ➔ 告白ノベル画面へ
                engine.isCh4MidBossDefeated = true;
                engine.boss = null;
                engine.onStageEnd(true, "ch4_midboss_defeated");
            } else {
                // 大ボス撃破
                engine.endGame(true);
            }
        }
    },

    onBossDefeated(engine) {
        // 各種移行処理はonBossHit内部で即時遮断管理するため不要
    },

    drawBossEntranceDecoration(engine) {
        if (engine.isCh4GreatBossActive) {
            engine.ctx.fillStyle = '#e64980';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 25, engine.boss.y + engine.boss.height/2 - 5, 50, 10);
        } else if (engine.isCh4MidBossEventTriggered) {
            engine.ctx.fillStyle = '#1c7ed6';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 15, engine.boss.y + engine.boss.height/2 - 3, 30, 6);
        } else {
            engine.ctx.fillStyle = '#fcc419';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 8, engine.boss.y + engine.boss.height/2 - 2, 16, 4);
        }
    },

    drawBossDecoration(engine) {
        if (engine.isCh4GreatBossActive) {
            engine.ctx.fillStyle = '#e64980';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 25, engine.boss.y + engine.boss.height/2 - 5, 50, 10);
        } else if (engine.isCh4MidBossEventTriggered) {
            engine.ctx.fillStyle = '#1c7ed6';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 15, engine.boss.y + engine.boss.height/2 - 3, 30, 6);
        } else {
            engine.ctx.fillStyle = '#fcc419';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 8, engine.boss.y + engine.boss.height/2 - 2, 16, 4);
        }
    },

    updateBossAttack(engine, now) {
        let bSpeed = 4;
        if (engine.isCh4GreatBossActive) {
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 12, height: 12, vx: 0, vy: bSpeed, color: '#f03e3e' });
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 12, height: 12, vx: Math.sin(-0.3)*bSpeed, vy: Math.cos(-0.3)*bSpeed, color: '#f03e3e' });
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 12, height: 12, vx: Math.sin(0.3)*bSpeed, vy: Math.cos(0.3)*bSpeed, color: '#f03e3e' });
        } else {
            let dx = (engine.player.x + engine.player.width/2) - (engine.boss.x + engine.boss.width/2);
            let dy = (engine.player.y + engine.player.height/2) - (engine.boss.y + engine.boss.height);
            let dist = Math.sqrt(dx*dx + dy*dy);
            let bVx = 0;
            let bVy = bSpeed;
            if (dist > 0 && Math.random() < 0.5) {
                bVx = (dx / dist) * bSpeed;
                bVy = (dy / dist) * bSpeed;
            }
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 10, height: 10, vx: bVx, vy: bVy, color: '#f03e3e' });
        }
    },

    drawSpawnAnimation(engine) {
        // お供巨大化アニメーションの描画
        let progress = engine.bossSpawnFrame / 60;
        let currentX, currentY, currentRadius, currentColor;
        
        if (engine.animatingAllyType) {
            currentX = engine.animatingAllyX + (engine.canvas.width / 2 - engine.animatingAllyX) * progress;
            currentY = engine.animatingAllyY + (100 - engine.animatingAllyY) * progress;
            currentRadius = 10 + (40 - 10) * progress;
            currentColor = engine.animatingAllyType === 'attacker' ? '#ff6b6b' : '#51cf66';
        } else {
            currentX = engine.canvas.width / 2;
            currentY = -50 + (100 - (-50)) * progress;
            currentRadius = 5 + (40 - 5) * progress;
            currentColor = '#f783ac';
        }
        
        engine.ctx.fillStyle = currentColor;
        engine.ctx.beginPath();
        engine.ctx.arc(currentX, currentY, currentRadius, 0, Math.PI * 2);
        engine.ctx.fill();
    },

    isSpawnAnimating(engine) {
        return engine.isCh4GreatBossSpawnAnimating;
    },

    handleBombDamage(engine) {
        engine.boss.hp -= 15;
        document.getElementById('boss-hp-val').innerText = Math.max(0, engine.boss.hp);
        if (engine.boss.hp <= 0) {
            engine.cancelLoop();
            if (!engine.isCh4MidBossEventStarted) {
                engine.isCh4MidBossEventStarted = true;
                engine.boss = null;
                engine.onCh4MidBossTrigger();
            } else if (!engine.isCh4MidBossDefeated) {
                engine.isCh4MidBossDefeated = true;
                engine.boss = null;
                engine.onStageEnd(true, "ch4_midboss_defeated");
            } else {
                engine.endGame(true);
            }
        }
    }
};