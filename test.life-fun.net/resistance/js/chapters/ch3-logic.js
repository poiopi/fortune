export const ch3Logic = {
    initStage(engine) {
        engine.isCh3BossActive = false;
        engine.ch3TargetsHit = 0;
        engine.ch3GameStartTime = Date.now();
        engine.ch3LastSpawnTime = 0;
    },

    spawnEnemies(engine, now) {
        if (!engine.isCh3BossActive) {
            let elapsedSec = Math.floor((now - engine.ch3GameStartTime) / 1000);
            let remaining = Math.max(0, engine.ch3Timer - elapsedSec);
            
            const timerEl = document.getElementById('ch3-timer');
            if (timerEl) {
                timerEl.innerText = remaining;
            }

            if (remaining <= 0) {
                // 15秒経過：修行終了、ではなく修行ボス出現演出！
                engine.isCh3BossActive = true;
                engine.enemies = []; // マト全消去
                engine.enemyBullets = [];
                engine.isBossEntranceAnimating = true; // 登場演出ON
                engine.boss = {
                    x: engine.canvas.width / 2 - 25,
                    y: -50,
                    targetY: 60,
                    width: 50,
                    height: 50,
                    color: '#15aabf', // 修行ボスカラー
                    direction: 1,
                    lastShotTime: 0,
                    hp: 50 // HP: 50
                };
                document.getElementById('boss-hp-area').style.display = "block";
                document.getElementById('boss-hp-val').innerText = "50";
                document.getElementById('stage-objective').innerHTML = '特訓終了！修行の成果を見せ、ボスを撃破せよ！';
                return;
            }

            // マト3倍化：330ms周期での出現
            if (now - engine.ch3LastSpawnTime > 330) {
                let targetX = Math.random() * (engine.canvas.width - 40);
                engine.enemies.push({ x: targetX, y: -40, width: 30, height: 30, color: '#1c7ed6', speed: 3, isTarget: true });
                engine.ch3LastSpawnTime = now;
            }
        }
    },

    onEnemyKilled(engine, enemy) {
        if (enemy.isTarget) {
            engine.ch3TargetsHit++;
            document.getElementById('kill-count').innerText = engine.ch3TargetsHit;
            const hitTargetEl = document.getElementById('ch3-hit-target');
            if (hitTargetEl) {
                hitTargetEl.innerText = engine.ch3TargetsHit;
            }
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
        engine.onStageEnd(true, "ch3_boss_defeated"); // 特訓ボス撃破クリアをmain.jsへ通知
    },

    drawBossEntranceDecoration(engine) {
        // 修行マト風のデザイン装飾を描画
        engine.ctx.fillStyle = '#ffffff';
        engine.ctx.beginPath();
        engine.ctx.arc(engine.boss.x + engine.boss.width/2, engine.boss.y + engine.boss.height/2, engine.boss.width/4, 0, Math.PI * 2);
        engine.ctx.fill();
    },

    drawBossDecoration(engine) {
        engine.ctx.fillStyle = '#ffffff';
        engine.ctx.beginPath();
        engine.ctx.arc(engine.boss.x + engine.boss.width/2, engine.boss.y + engine.boss.height/2, engine.boss.width/4, 0, Math.PI * 2);
        engine.ctx.fill();
    },

    updateBossAttack(engine, now) {
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
    },

    handleBombDamage(engine) {
        engine.boss.hp -= 15;
        document.getElementById('boss-hp-val').innerText = Math.max(0, engine.boss.hp);
        if (engine.boss.hp <= 0) {
            engine.triggerBossExplosion();
        }
    }
};