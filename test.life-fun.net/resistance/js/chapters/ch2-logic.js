export const ch2Logic = {
    initStage(engine) {
        engine.stage2BossHits = 0;
        engine.stage2Phase3Kills = 0; // フェーズ3通常ゾンビ5体撃退用の変数初期化
        document.getElementById('boss-hp-area').style.display = "none";
        document.getElementById('stage-objective').innerHTML = "ステージをクリアせよ！";
    },

    spawnEnemies(engine, now) {
        // フェーズ1（異変前）、または中ボス撃破後のフェーズ3の通常戦の時にザコを生成します
        let isPhase1Active = !engine.isCh2EventStarted;
        let isPhase3Active = engine.isCh2Phase3Active;

        if (isPhase1Active || isPhase3Active) {
            if (now - engine.lastEnemyTime > 1500) {
                let enemyX = Math.random() * (engine.canvas.width - 40);
                let shootType = Math.random() < 0.4 ? 'aimed' : 'straight';
                engine.enemies.push({ x: enemyX, y: -40, width: 35, height: 35, color: '#96f2d7', speed: 2, lastShotTime: now, shootType: shootType });
                engine.lastEnemyTime = now;
            }
        }
    },

    onEnemyKilled(engine, enemy) {
        // 【フェーズ1】通常ザコ9体撃破（3倍化）で中ボスの異変イベント発生
        if (!engine.isCh2EventStarted && engine.gameState.killCount >= 9) {
            engine.isCh2EventStarted = true;
            engine.enemies = [];
            engine.bullets = [];
            engine.cancelLoop();
            engine.onCh2EventTrigger(); // main.jsの異変ダイアログへ
            return true; // 処理の即時遮断
        }

        // ★バグ修正：フェーズ3進行中の、!engine.isCh2EventTriggered の競合チェックを除去
        if (engine.isCh2Phase3Active) { 
            engine.stage2Phase3Kills = (engine.stage2Phase3Kills || 0) + 1;
            if (engine.stage2Phase3Kills >= 5) {
                engine.enemies = [];
                engine.bullets = [];
                engine.cancelLoop();
                
                // 大ボスの出現演出を起動
                engine.isCh2EventTriggered = true; 
                engine.boss = {
                    x: engine.canvas.width / 2 - 50, y: -50, targetY: 60, width: 100, height: 100,
                    color: '#b085f5', direction: 1, lastShotTime: 0
                };
                engine.isBossEntranceAnimating = true; // スライド登場演出ON
                engine.ch2StartTime = Date.now();
                engine.loop();
                return true;
            }
        }
        return false;
    },

    onBossHit(engine, bullet) {
        if (!engine.isCh2MidBossDefeated) {
            // 【フェーズ2：撃破可能な中ボス戦】
            let damage = bullet.isLaser ? 2 : 1;
            engine.boss.hp = (engine.boss.hp || 0) - damage;
            
            const hpValEl = document.getElementById('boss-hp-val');
            if (hpValEl) {
                hpValEl.innerText = Math.max(0, engine.boss.hp);
            }
            
            if (engine.boss.hp <= 0) {
                engine.triggerBossExplosion(); // 撃破大爆発
            }
        } else {
            // 【フェーズ4：無敵の大ボス戦】攻撃を20発命中させると、強制敗北イベントへ遷移
            engine.stage2BossHits = (engine.stage2BossHits || 0) + (bullet.isLaser ? 2 : 1);
            
            // 白い火花エフェクト
            engine.ctx.fillStyle = '#fff';
            engine.ctx.fillRect(bullet.x - 10, bullet.y - 10, 20, 20);

            if (engine.stage2BossHits >= 20 && !engine.isCh2DefeatedSceneActive) {
                engine.isCh2DefeatedSceneActive = true;
                engine.cancelLoop();
                engine.onStageEnd(false, "ch2_scripted_defeat");
            }
        }
    },

    onBossDefeated(engine) {
        // 中ボスを倒したら、メイン側へ通知し、改心（トビーとの合流と2面ボス撃破会話）へ遷移
        if (!engine.isCh2MidBossDefeated) {
            engine.isCh2MidBossDefeated = true;
            engine.boss = null;
            engine.onStageEnd(true, "ch2_midboss_defeated"); // main.jsの中ボス撃破処理へ
        }
    },

    drawBossEntranceDecoration(engine) {
        if (engine.isCh2MidBossDefeated) {
            // 大ボスの顔装飾
            engine.ctx.fillStyle = '#333';
            engine.ctx.fillRect(engine.boss.x + 30, engine.boss.y + 35, 8, 8);
            engine.ctx.fillRect(engine.boss.x + 62, engine.boss.y + 35, 8, 8);
            engine.ctx.fillStyle = '#ff6b8b';
            engine.ctx.fillRect(engine.boss.x + 40, engine.boss.y + 65, 20, 5);
        } else {
            // 中ボスの顔装飾（中ボス用）
            engine.ctx.fillStyle = '#1c7ed6';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 15, engine.boss.y + engine.boss.height/2 - 3, 30, 6);
        }
    },

    drawBossDecoration(engine) {
        if (engine.isCh2MidBossDefeated) {
            // 大ボスの顔装飾
            engine.ctx.fillStyle = '#333';
            engine.ctx.fillRect(engine.boss.x + 30, engine.boss.y + 35, 8, 8);
            engine.ctx.fillRect(engine.boss.x + 62, engine.boss.y + 35, 8, 8);
            engine.ctx.fillStyle = '#ff6b8b';
            engine.ctx.fillRect(engine.boss.x + 40, engine.boss.y + 65, 20, 5);
        } else {
            // 中ボスの顔装飾（中ボス用）
            engine.ctx.fillStyle = '#1c7ed6';
            engine.ctx.fillRect(engine.boss.x + engine.boss.width/2 - 15, engine.boss.y + engine.boss.height/2 - 3, 30, 6);
        }
    },

    // ★中ボスの難易度設計：800ms、2〜3発、弾は巨大、isBossBullet: true
    updateBossAttack(engine, now) {
        if (now - engine.boss.lastShotTime < 800) return;
        engine.boss.lastShotTime = now;

        let bSpeed = 4;
        
        if (engine.isCh2MidBossDefeated) {
            // 大ボス：2〜3発（弾は大型16x16、被弾ダメージ15）
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 16, height: 16, vx: 0, vy: bSpeed, color: '#f03e3e', isBossBullet: true });
            let dx = (engine.player.x + engine.player.width/2) - (engine.boss.x + engine.boss.width/2);
            let dy = (engine.player.y + engine.player.height/2) - (engine.boss.y + engine.boss.height);
            let dist = Math.sqrt(dx*dx + dy*dy);
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 16, height: 16, vx: (dx/dist)*bSpeed, vy: (dy/dist)*bSpeed, color: '#f03e3e', isBossBullet: true });
            if (Math.random() < 0.5) {
                engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 16, height: 16, vx: (Math.random()-0.5)*bSpeed, vy: bSpeed, color: '#f03e3e', isBossBullet: true });
            }
        } else {
            // 中ボス：2〜3発（弾は通常サイズ10x10、被弾ダメージ10）
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 10, height: 10, vx: 0, vy: bSpeed, color: '#f03e3e' });
            let dx = (engine.player.x + engine.player.width/2) - (engine.boss.x + engine.boss.width/2);
            let dy = (engine.player.y + engine.player.height/2) - (engine.boss.y + engine.boss.height);
            let dist = Math.sqrt(dx*dx + dy*dy);
            engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 10, height: 10, vx: (dx/dist)*bSpeed, vy: (dy/dist)*bSpeed, color: '#f03e3e' });
            if (Math.random() < 0.5) {
                engine.enemyBullets.push({ x: engine.boss.x + engine.boss.width/2, y: engine.boss.y + engine.boss.height, width: 10, height: 10, vx: (Math.random()-0.5)*bSpeed, vy: bSpeed, color: '#f03e3e' });
            }
        }
    },

    handleBombDamage(engine) {
        if (!engine.isCh2MidBossDefeated) {
            engine.boss.hp -= 15;
            document.getElementById('boss-hp-val').innerText = Math.max(0, engine.boss.hp);
            if (engine.boss.hp <= 0) {
                engine.triggerBossExplosion();
            }
        } else {
            engine.stage2BossHits = (engine.stage2BossHits || 0) + 15;
            if (engine.stage2BossHits >= 20 && !engine.isCh2DefeatedSceneActive) {
                engine.isCh2DefeatedSceneActive = true;
                engine.cancelLoop();
                engine.onStageEnd(false, "ch2_scripted_defeat");
            }
        }
    },

    isDefeatedSceneActive(engine) {
        return engine.isCh2DefeatedSceneActive;
    }
};
