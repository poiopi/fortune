export const ch1Logic = {
    initStage(engine) {
        engine.isCh1BossActive = false;
        engine.isBossEntranceAnimating = false;
    },

    spawnEnemies(engine, now) {
        if (!engine.isCh1BossActive) {
            // ボス未出現時：通常ザコを生成
            if (now - engine.lastEnemyTime > 1500) {
                let enemyX = Math.random() * (engine.canvas.width - 40);
                let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                engine.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                engine.lastEnemyTime = now;
            }
        }
    },

    onEnemyKilled(engine, enemy) {
        // 通常ザコを8体倒したら、ミニボス（スライドイン演出）を起動！
        if (!engine.isCh1BossActive && engine.gameState.killCount >= 8) {
            engine.isCh1BossActive = true;
            engine.enemies = []; 
            engine.enemyBullets = []; 
            engine.isBossEntranceAnimating = true; 
            engine.boss = {
                x: engine.canvas.width / 2 - 25,
                y: -50,
                targetY: 60,
                width: 50,
                height: 50,
                color: '#fcc419', // イエローミニボス
                direction: 1,
                lastShotTime: 0,
                hp: 10 // HP: 10
            };
            document.getElementById('boss-hp-area').style.display = "block";
            document.getElementById('boss-hp-val').innerText = "10";
            document.getElementById('stage-objective').innerHTML = 'ミニボスを撃破せよ！';
        }
        return false;
    },

    onBossHit(engine, bullet) {
        let damage = bullet.isLaser ? 2 : 1;
        engine.boss.hp = (engine.boss.hp || 0) - damage;
        
        const hpValEl = document.getElementById('boss-hp-val');
        if (hpValEl) {
            hpValEl.innerText = Math.max(0, engine.boss.hp);
        }
        
        if (engine.boss.hp <= 0) {
            engine.triggerBossExplosion(); // 撃破大爆発演出へ
        }
    },

    onBossDefeated(engine) {
        engine.endGame(true); // ステージクリアへ
    },

    drawBossEntranceDecoration(engine) {
        // スライド登場中のミニボスの模様を描画
        engine.ctx.fillStyle = '#e64980';
        engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 10, engine.boss.y + engine.boss.height/2 - 2, 20, 4);
    },

    drawBossDecoration(engine) {
        // 戦闘中のミニボスの模様を描画
        engine.ctx.fillStyle = '#e64980';
        engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 10, engine.boss.y + engine.boss.height/2 - 2, 20, 4);
    },

    updateBossAttack(engine, now) {
        // 中ボスのアダプティブ狙い撃ち弾（直進または自機狙い）
        let bSpeed = 4;
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
};