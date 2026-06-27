export const ch2Logic = {
    initStage(engine) {
        engine.stage2BossHits = 0;
        document.getElementById('boss-hp-area').style.display = "none";
        document.getElementById('stage-objective').innerHTML = "ステージをクリアせよ！";
    },

    spawnEnemies(engine, now) {
        if (!engine.isCh2EventTriggered) {
            if (now - engine.lastEnemyTime > 1500) {
                let enemyX = Math.random() * (engine.canvas.width - 40);
                let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                engine.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                engine.lastEnemyTime = now;
            }
        }
    },

    onEnemyKilled(engine, enemy) {
        // 通常ザコ3体撃破で異変イベント発生
        if (!engine.isCh2EventStarted && engine.gameState.killCount >= 3) {
            engine.isCh2EventStarted = true;
            engine.enemies = [];
            engine.bullets = [];
            engine.cancelLoop();
            engine.onCh2EventTrigger(); // main.jsの異変ダイアログへ
            return true; // 処理の即時遮断
        }
        return false;
    },

    onBossHit(engine, bullet) {
        // 2面ボスは無敵。20発（レーザーは2ダメージ換算で10発）当たったら強制敗北へ遷移
        engine.stage2BossHits = (engine.stage2BossHits || 0) + (bullet.isLaser ? 2 : 1);
        
        // 白い火花エフェクト
        engine.ctx.fillStyle = '#fff';
        engine.ctx.fillRect(bullet.x - 10, bullet.y - 10, 20, 20);

        if (engine.stage2BossHits >= 20 && !engine.isCh2DefeatedSceneActive) {
            engine.isCh2DefeatedSceneActive = true;
            engine.cancelLoop();
            engine.onStageEnd(false, "ch2_scripted_defeat");
        }
    },

    onBossDefeated(engine) {
        // 2面ボスは死なないため、本処理は呼ばれません
    },

    drawBossEntranceDecoration(engine) {
        // 2面巨大ボスの登場中模様
        engine.ctx.fillStyle = '#333';
        engine.ctx.fillRect(engine.boss.x + 30, engine.boss.y + 35, 8, 8);
        engine.ctx.fillRect(engine.boss.x + 62, engine.boss.y + 35, 8, 8);
        engine.ctx.fillStyle = '#ff6b8b';
        engine.ctx.fillRect(engine.boss.x + 40, engine.boss.y + 65, 20, 5);
    },

    drawBossDecoration(engine) {
        // 2面巨大ボスの戦闘中模様
        engine.ctx.fillStyle = '#333';
        engine.ctx.fillRect(engine.boss.x + 30, engine.boss.y + 35, 8, 8);
        engine.ctx.fillRect(engine.boss.x + 62, engine.boss.y + 35, 8, 8);
        engine.ctx.fillStyle = '#ff6b8b';
        engine.ctx.fillRect(engine.boss.x + 40, engine.boss.y + 65, 20, 5);
    },

    updateBossAttack(engine, now) {
        if (now - engine.boss.lastShotTime < 800) return;
        engine.boss.lastShotTime = now;

        let bSpeed = 4;
        engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 16, height: 16, vx: 0, vy: bSpeed, color: '#f03e3e', isBossBullet: true });
        let dx = (engine.player.x + engine.player.width/2) - (engine.boss.x + engine.boss.width/2);
        let dy = (engine.player.y + engine.player.height/2) - (engine.boss.y + engine.boss.height);
        let dist = Math.sqrt(dx*dx + dy*dy);
        engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 16, height: 16, vx: (dx/dist)*bSpeed, vy: (dy/dist)*bSpeed, color: '#f03e3e', isBossBullet: true });
        if (Math.random() < 0.5) {
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 16, height: 16, vx: (Math.random()-0.5)*bSpeed, vy: bSpeed, color: '#f03e3e', isBossBullet: true });
        }
    },

    handleBombDamage(engine) {
        // 2面ボスへのボム使用は、一撃で15発分の被弾カウンターを加算します
        engine.stage2BossHits = (engine.stage2BossHits || 0) + 15;
        if (engine.stage2BossHits >= 20 && !engine.isCh2DefeatedSceneActive) {
            engine.isCh2DefeatedSceneActive = true;
            engine.cancelLoop();
            engine.onStageEnd(false, "ch2_scripted_defeat");
        }
    },

    isDefeatedSceneActive(engine) {
        return engine.isCh2DefeatedSceneActive;
    }
};