<?php
declare(strict_types=1);

/**
 * inc/ai-fortune-modal.php
 *
 * AI鑑定チャット（10テーマ版）のUI本体。footer.phpからrequireされ、全ページ共通で
 * 1つだけ出力される（起動はfooter.phpのフローティングメニュー「AI鑑定チャット」
 * ボタン→window.openAiChatModal()）。
 *
 * UI正本：_scratch/ai-fortune-chat-mockup.html（実機検証済み）。本ファイルは
 * そのモックアップの構造・文言・演出を、サイト側のJS/CSS規約（クラス名の衝突を
 * 避けるため全クラスに aic- を付与、CSS変数は:rootではなく.aic-rootにスコープ）
 * に合わせて移植したもの。
 *
 * モックアップとの差分（技術的な理由によるもの）：
 * - モックアップは「スマホ画面のデモ枠(.frame)」の中にposition:absoluteで
 *   モーダルを描画していたが、実サイトには枠が存在しないため、
 *   position:fixedで実ビューポート基準に描画する。
 * - デスクトップ幅ではモーダル本体の横幅をmax-width:380pxで中央寄せする
 *   （モバイル幅ではモックアップ同様、画面下からせり上がるボトムシートになる）。
 * - 星座リング装飾（arc）はモックアップと同一の計算式で静的に1回だけ生成する
 *   （render()のたびに再生成する必要がないため）。
 * - 結果データはAPI（/api/fortune-chat.php）から取得する。APIレスポンスの
 *   テキストはすべてtextContentで挿入し、innerHTMLでは挿入しない（XSS対策）。
 */
?>
<style>
/* ═══ AI鑑定チャット（aic- prefix, .aic-root配下にのみ影響するスコープ） ═══ */
.aic-root{
  --aic-ink:#05070d; --aic-ink-2:#080c14; --aic-plate:#02040a;
  --aic-panel-2:#161c29;
  --aic-brass:#c0913c; --aic-brass-lt:#e8ce93; --aic-brass-pale:#f2e3bd; --aic-brass-dk:#7e5c1e;
  --aic-panel-3:#1d2432;
  --aic-rule:rgba(232,206,147,.14); --aic-rule-2:rgba(232,206,147,.30); --aic-rule-3:rgba(232,206,147,.52);
  --aic-star:#f0ead9; --aic-text:#c7cedd; --aic-muted:#7a8399; --aic-dim:#525c72;
  --aic-ff-mincho:'Shippori Mincho',"Hiragino Mincho ProN","Yu Mincho",serif;
  --aic-ff-sans:'Zen Kaku Gothic New',"Hiragino Sans","Yu Gothic",sans-serif;
  --aic-ff-mono:'DM Mono',ui-monospace,monospace;
  --aic-gut:1.1rem;
}
.aic-root *{box-sizing:border-box}
.aic-root{font-family:var(--aic-ff-sans)}

.aic-overlay{position:fixed;inset:0;z-index:9990;background:rgba(2,4,9,.94);backdrop-filter:blur(7px);opacity:0;pointer-events:none;transition:opacity .25s}
.aic-overlay.open{opacity:1;pointer-events:all}
.aic-modal{position:fixed;left:0;right:0;margin:0 auto;width:min(460px,100vw);max-width:460px;bottom:-100%;top:8vh;display:flex;flex-direction:column;overflow:hidden;isolation:isolate;background:radial-gradient(140% 46% at 50% 0%,rgba(58,80,140,.24),transparent 68%),linear-gradient(180deg,#070a13,var(--aic-plate) 55%);border:1px solid var(--aic-rule-2);border-radius:20px 20px 0 0;box-shadow:0 -20px 60px rgba(0,0,0,.8),inset 0 1px 0 rgba(232,206,147,.14);opacity:0;transition:bottom .34s cubic-bezier(.22,1,.3,1),opacity .34s;color:var(--aic-text)}
.aic-overlay.open .aic-modal{bottom:0;opacity:1}
/* PC幅（461px以上）：占いチャットタブの位置に連動して開くため、下からのせり上がり
   ではなく右からの水平スライドインに変更する。位置計算のためheightを固定値にし、
   topはJS（aicOpen）でタブの位置に応じてインラインスタイルとして動的に設定する
   （anchorRectが渡されない場合はこのtop:5vhがデフォルト値として使われる）。
   このブレークポイントではleft:autoになりwidthの明示指定が無いと、position:fixed要素の
   幅がCSS仕様上「shrink-to-fit」（内容物の幅に応じた可変値）で計算されてしまい、
   テーマ選択画面（2カラムのカードグリッドを含む）だけパネル自体の横幅が
   通常の会話画面より広くなる不具合があったため、widthを明示して内容物に依存しない
   固定値にする（右16px・左16px相当の余白を確保しつつ380px上限は維持。380pxは
   _scratch/ai-fortune-chat-mockup.htmlの.frame{width:min(94vw,380px)}に合わせた
   正本の値。旧460pxはshrink-to-fitバグ修正時の暫定値だった）。 */
@media(min-width:461px){
  .aic-modal{top:5vh;bottom:auto;height:min(72vh,520px);border-radius:20px;right:16px;left:auto;margin:0;width:min(380px,calc(100vw - 32px));transform:translateX(calc(100% + 16px));transition:transform .34s cubic-bezier(.22,1,.3,1),opacity .34s}
  .aic-overlay.open .aic-modal{bottom:auto;transform:translateX(0)}
  .aic-picker-sheet{max-width:380px}
}
.aic-grabber{width:34px;height:4px;border-radius:2px;background:var(--aic-rule-2);margin:.6rem auto -.1rem;flex-shrink:0}
.aic-modal-crest{position:absolute;top:-70px;left:50%;transform:translateX(-50%);width:230px;height:230px;opacity:.55;pointer-events:none;z-index:0}
.aic-modal-crest svg{width:100%;height:100%;display:block}
.aic-chat-head{position:relative;z-index:1;display:flex;flex-direction:column;align-items:center;text-align:center;gap:.4rem;padding:1.1rem var(--aic-gut) .7rem;flex-shrink:0}
.aic-seal{border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:radial-gradient(circle at 34% 28%,#1e2432,#0a0e17 70%);border:1px solid var(--aic-rule-3);color:var(--aic-brass-lt);box-shadow:inset 0 0 12px rgba(232,206,147,.16),0 0 0 3px rgba(232,206,147,.05)}
.aic-chat-head .aic-seal{width:46px;height:46px;font-size:1.3rem;animation:aicSealBreathe 4.5s ease-in-out infinite}
@keyframes aicSealBreathe{0%,100%{box-shadow:inset 0 0 12px rgba(232,206,147,.16),0 0 0 3px rgba(232,206,147,.05)}50%{box-shadow:inset 0 0 16px rgba(232,206,147,.24),0 0 0 3px rgba(232,206,147,.08),0 0 26px rgba(232,206,147,.28)}}
.aic-chat-head-text strong{display:block;font-family:var(--aic-ff-mincho);font-size:1.15rem;font-weight:700;color:var(--aic-star);letter-spacing:.06em}
.aic-chat-head-text span{display:block;font-family:var(--aic-ff-mono);font-size:.52rem;letter-spacing:.14em;color:var(--aic-dim);text-transform:uppercase;margin-top:.15rem}
.aic-step-count{position:absolute;top:.85rem;left:var(--aic-gut);font-family:var(--aic-ff-mono);font-size:.6rem;letter-spacing:.1em;color:var(--aic-brass);z-index:2}
.aic-progress-track{height:2px;background:rgba(232,206,147,.09);flex-shrink:0;position:relative;z-index:1}
.aic-progress-fill{height:100%;background:linear-gradient(90deg,var(--aic-brass-dk),var(--aic-brass));box-shadow:0 0 6px rgba(232,206,147,.32);transition:width .4s cubic-bezier(.22,1,.3,1)}
.aic-modal-close{position:absolute;top:.65rem;right:var(--aic-gut);width:26px;height:26px;border-radius:50%;border:1px solid rgba(255,255,255,.1);background:rgba(5,7,13,.4);color:var(--aic-muted);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.7rem;z-index:2}
.aic-modal-close:hover{color:var(--aic-brass-lt);border-color:var(--aic-rule-3)}
.aic-mute-btn{position:absolute;top:.65rem;right:calc(var(--aic-gut) + 34px);width:26px;height:26px;border-radius:50%;border:1px solid rgba(255,255,255,.1);background:rgba(5,7,13,.4);color:var(--aic-muted);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.68rem;z-index:2}
.aic-mute-btn:hover{color:var(--aic-brass-lt);border-color:var(--aic-rule-3)}
.aic-qr-btn:disabled,.aic-pick-btn:disabled{opacity:.4;cursor:not-allowed}

.aic-thread{padding:.9rem var(--aic-gut) 1.1rem;overflow-y:auto;display:flex;flex-direction:column;gap:.7rem;flex:1;scrollbar-width:thin;scrollbar-color:var(--aic-panel-3) transparent}
.aic-thread::-webkit-scrollbar{width:6px}
.aic-thread::-webkit-scrollbar-thumb{background:var(--aic-panel-3);border-radius:3px}
.aic-row{display:flex;max-width:100%;animation:aicMsgIn .32s cubic-bezier(.22,1,.3,1) both}
@keyframes aicMsgIn{from{opacity:0;transform:translateY(7px)}to{opacity:1;transform:translateY(0)}}
.aic-row.bot{justify-content:flex-start}
.aic-row.user{justify-content:flex-end}
.aic-stack{display:flex;flex-direction:column;gap:.5rem;max-width:92%;align-items:flex-start}
/* テーマ選択・結婚2択のカードグリッド（.aic-qr.grid2）を含むstackは、
   通常のチャット吹き出し用92%制限を適用せずフル幅で表示する。 */
.aic-stack.aic-stack-full{max-width:100%}
.aic-bubble{background:linear-gradient(180deg,var(--aic-panel-2),#121722);border:1px solid rgba(255,255,255,.06);border-radius:3px 16px 16px 16px;padding:.7rem .9rem;font-size:.92rem;line-height:1.75;color:var(--aic-text)}
.aic-bubble.headline{font-family:var(--aic-ff-mincho);font-size:1.15rem;font-weight:700;line-height:1.55;color:var(--aic-star)}
.aic-bubble .aic-sub{display:block;font-family:var(--aic-ff-sans);font-size:.78rem;color:var(--aic-muted);margin-top:.4rem;line-height:1.6}
.aic-bubble.user{background:linear-gradient(180deg,rgba(232,206,147,.17),rgba(232,206,147,.07));border:1px solid var(--aic-rule-2);color:var(--aic-brass-pale);border-radius:16px 3px 16px 16px;font-size:.86rem;font-weight:500}
.aic-msg-time{display:block;font-family:var(--aic-ff-mono);font-size:.6rem;color:var(--aic-dim);margin-top:.25rem;letter-spacing:.03em}
.aic-row.user .aic-msg-time{text-align:right}

.aic-qr{display:flex;gap:.35rem;flex-wrap:wrap}
.aic-qr.grid2{display:grid;grid-template-columns:1fr 1fr;gap:.4rem;align-items:stretch}
.aic-qr.grid2 .aic-qr-btn{width:100%;border-radius:12px;min-height:82px;display:flex;flex-direction:column;justify-content:flex-start;padding-top:.65rem}
.aic-card-icon{display:block;width:20px;height:20px;color:var(--aic-brass-lt);margin-bottom:.4rem}
.aic-card-icon svg{width:100%;height:100%;display:block}
.aic-qr-btn{padding:.55rem .9rem;border-radius:999px;font-weight:500;font-size:.82rem;color:var(--aic-star);background:linear-gradient(180deg,rgba(232,206,147,.08),rgba(232,206,147,.02));border:1px solid var(--aic-rule-2);cursor:pointer;transition:.16s;font-family:var(--aic-ff-sans);text-align:left}
.aic-qr-btn:hover{border-color:var(--aic-brass);background:linear-gradient(180deg,rgba(232,206,147,.16),rgba(232,206,147,.05));transform:translateY(-1px)}
.aic-qr-btn .aic-tag{display:block;font-size:.68rem;color:var(--aic-muted);margin-top:.15rem;font-weight:400}
.aic-qr-btn.ghost{background:none;color:var(--aic-muted);border-color:rgba(255,255,255,.1)}
.aic-qr-btn.ghost:hover{color:var(--aic-brass-lt);border-color:var(--aic-rule-2)}
.aic-qr-btn:disabled{opacity:.35;cursor:not-allowed;pointer-events:none}

.aic-date-inline{background:linear-gradient(180deg,#141a26,#0e131d);border:1px solid var(--aic-rule);border-radius:14px;padding:.75rem;display:flex;flex-direction:column;gap:.55rem;width:100%;max-width:280px}
.aic-date-legend{font-family:var(--aic-ff-mono);font-size:.56rem;letter-spacing:.1em;color:var(--aic-brass);text-transform:uppercase}
.aic-date-row{display:grid;grid-template-columns:1.35fr 1fr 1fr;gap:.32rem}
.aic-dd-wrap{position:relative}
.aic-dd-btn{width:100%;font-family:var(--aic-ff-mono);font-size:.74rem;color:var(--aic-star);background:#080c14;border:1px solid rgba(255,255,255,.09);border-radius:9px;padding:.48rem .5rem;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.3rem}
.aic-dd-btn.ph{color:var(--aic-dim)}
.aic-dd-btn:hover{border-color:var(--aic-rule-2)}
.aic-dd-caret{font-size:.55rem;color:var(--aic-brass-lt);flex-shrink:0}
.aic-name-input{width:100%;font-family:var(--aic-ff-mincho);font-size:.8rem;color:var(--aic-star);background:#080c14;border:1px solid rgba(255,255,255,.09);border-radius:9px;padding:.5rem .6rem}
.aic-name-input::placeholder{color:var(--aic-dim);font-family:var(--aic-ff-mono);font-size:.68rem}
.aic-name-input:focus{outline:none;border-color:var(--aic-rule-2)}

.aic-picker-overlay{position:fixed;inset:0;background:rgba(2,4,9,.7);z-index:9995;opacity:0;pointer-events:none;transition:opacity .2s}
.aic-picker-overlay.open{opacity:1;pointer-events:all}
.aic-picker-sheet{position:fixed;left:0;right:0;bottom:-100%;z-index:9996;background:#12172a;border:1px solid var(--aic-rule-2);border-top-left-radius:16px;border-top-right-radius:16px;box-shadow:0 -14px 40px rgba(0,0,0,.6);transition:bottom .28s cubic-bezier(.22,1,.3,1);max-height:60%;display:flex;flex-direction:column;max-width:460px;margin:0 auto;font-family:var(--aic-ff-sans)}
.aic-picker-overlay.open .aic-picker-sheet{bottom:0}
.aic-picker-title{font-family:var(--aic-ff-mono);font-size:.62rem;letter-spacing:.1em;color:var(--aic-brass);text-transform:uppercase;padding:.9rem 1rem .5rem;flex-shrink:0}
.aic-picker-list{overflow-y:auto;padding:.25rem .5rem .8rem}
.aic-dd-option{display:block;background:none;border:none;color:var(--aic-text);font-family:var(--aic-ff-mono);font-size:.85rem;padding:.6rem .6rem;text-align:left;cursor:pointer;border-radius:8px;width:100%}
.aic-dd-option:hover{background:rgba(232,206,147,.12);color:var(--aic-star)}
.aic-dd-option.sel{color:var(--aic-brass-lt);background:rgba(232,206,147,.08)}
.aic-grid4{display:grid;grid-template-columns:repeat(4,1fr);gap:.3rem}
.aic-pick-btn{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.09);border-radius:8px;padding:.4rem .1rem;text-align:center;font-family:var(--aic-ff-mono);font-size:.64rem;color:var(--aic-muted);cursor:pointer;transition:.16s}
.aic-pick-btn:hover{border-color:var(--aic-rule-2);color:var(--aic-star)}
.aic-pick-btn.picked{background:rgba(232,206,147,.14);border-color:var(--aic-brass);color:var(--aic-brass-lt)}
.aic-blood-btn{font-family:var(--aic-ff-mincho);font-weight:700;font-size:.78rem}

.aic-typing{display:inline-flex;align-items:center;gap:5px;padding:.8rem .95rem}
.aic-typing span{width:5px;height:5px;border-radius:50%;background:var(--aic-brass-lt);animation:aicTypeBounce 1.2s ease-in-out infinite}
.aic-typing span:nth-child(2){animation-delay:.16s}
.aic-typing span:nth-child(3){animation-delay:.32s}
@keyframes aicTypeBounce{0%,60%,100%{opacity:.25;transform:translateY(0)}30%{opacity:1;transform:translateY(-3px)}}

.aic-result-wrap{display:flex;flex-direction:column;gap:.6rem;width:100%}
.aic-result-badge{display:inline-block;font-family:var(--aic-ff-mono);font-size:.62rem;letter-spacing:.1em;color:var(--aic-brass);text-transform:uppercase;background:rgba(232,206,147,.08);border:1px solid var(--aic-rule-2);border-radius:999px;padding:.22rem .65rem}
.aic-angle-block{border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:.65rem .75rem;background:rgba(255,255,255,.02)}
.aic-angle-title{font-family:var(--aic-ff-mincho);font-size:.8rem;color:var(--aic-star);margin:0 0 .35rem;display:flex;align-items:center;gap:.4rem}
.aic-angle-subtitle{font-family:var(--aic-ff-mono);font-size:.62rem;letter-spacing:.06em;color:var(--aic-muted);margin:0 0 .2rem;text-transform:uppercase}
.aic-angle-list{margin:0;padding-left:1rem;display:flex;flex-direction:column;gap:.3rem}
.aic-angle-list li{font-size:.76rem;color:var(--aic-text);line-height:1.6}
.aic-stars{font-size:1.1rem;letter-spacing:.08em}
.aic-star-on{color:var(--aic-brass)}
.aic-star-off{color:rgba(232,206,147,.2)}
.aic-score-label{font-family:var(--aic-ff-mono);font-size:.7rem;color:var(--aic-brass-lt)}
.aic-footnote{font-family:var(--aic-ff-mono);font-size:.58rem;color:var(--aic-dim);letter-spacing:.03em}
.aic-result-link{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--aic-ff-mono);font-size:.68rem;color:var(--aic-brass-lt);text-decoration:none;border-bottom:1px solid var(--aic-rule-2);padding-bottom:2px;align-self:flex-start;margin-top:.2rem}
.aic-result-link:hover{color:var(--aic-brass-pale);border-color:var(--aic-brass)}
.aic-result-body{margin:0;font-size:.83rem;line-height:1.85;color:var(--aic-text)}
.aic-mission-line{font-size:.76rem;color:var(--aic-muted);line-height:1.7;margin:0}

.aic-error-bubble{color:#e8a3a3!important}
</style>

<div class="aic-root">
  <div class="aic-overlay" id="aicOverlay">
    <div class="aic-modal">
      <span class="aic-grabber"></span>
      <div class="aic-modal-crest"><?php
        // 星座リング装飾（モックアップのarc()関数と同一計算式・静的1回生成）
        $lines = '';
        for ($i = 0; $i < 36; $i++) {
            $a = $i * 10 * M_PI / 180;
            $r1 = 96; $r2 = ($i % 3 === 0) ? 86 : 91;
            $lines .= '<line x1="' . round(115 + $r1 * cos($a), 1) . '" y1="' . round(115 + $r1 * sin($a), 1) . '" x2="' . round(115 + $r2 * cos($a), 1) . '" y2="' . round(115 + $r2 * sin($a), 1) . '"/>';
        }
        echo '<svg viewBox="0 0 230 230" fill="none" aria-hidden="true">'
            . '<circle cx="115" cy="115" r="96" stroke="rgba(232,206,147,.42)" stroke-width="1"/>'
            . '<circle cx="115" cy="115" r="82" stroke="rgba(232,206,147,.22)" stroke-width="1"/>'
            . '<g stroke="rgba(232,206,147,.42)" stroke-width="1">' . $lines . '</g>'
            . '<circle cx="115" cy="19" r="2.4" fill="#f2e3bd"/>'
            . '<circle cx="197" cy="163" r="1.7" fill="#f2e3bd" opacity=".6"/>'
            . '</svg>';
      ?></div>
      <div class="aic-chat-head">
        <span class="aic-step-count" id="aicStepCount">1 / 4</span>
        <button type="button" class="aic-mute-btn" id="aicMuteBtn" aria-label="通知音を消す">🔊</button>
        <button type="button" class="aic-modal-close" id="aicCloseBtn" aria-label="閉じる">✕</button>
        <span class="aic-seal">🔮</span>
        <div class="aic-chat-head-text"><strong>AI鑑定チャット</strong><span>fortune consultation</span></div>
      </div>
      <div class="aic-progress-track"><div class="aic-progress-fill" id="aicProgressFill" style="width:25%"></div></div>
      <div class="aic-thread" id="aicThread"></div>
    </div>
  </div>
  <div class="aic-picker-overlay" id="aicPickerOverlay">
    <div class="aic-picker-sheet">
      <div class="aic-picker-title" id="aicPickerTitle"></div>
      <div class="aic-picker-list" id="aicPickerList"></div>
    </div>
  </div>
</div>

<script>
(function(){
'use strict';

// ── アイコン（モックアップと同一のSVG線画） ──
var AIC_THEME_ICONS = {
  love:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M10 16.8C5.2 13.4 2.2 10.4 2.2 7.2c0-2.3 1.9-4.2 4.2-4.2 1.4 0 2.7.7 3.6 1.9 .9-1.2 2.2-1.9 3.6-1.9 2.3 0 4.2 1.9 4.2 4.2 0 3.2-3 6.2-7.8 9.6z"/></svg>',
  work:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="2.2" y="6.5" width="15.6" height="10" rx="1.6"/><path d="M7 6.5V5c0-.9.7-1.6 1.6-1.6h2.8c.9 0 1.6.7 1.6 1.6v1.5M2.2 10.8h15.6"/></svg>',
  money:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><circle cx="10" cy="10" r="7.3"/><path d="M10 6.2v7.6M12.2 8c0-1-1-1.7-2.2-1.7s-2.2.7-2.2 1.6c0 2.2 4.4 1 4.4 3.2 0 .9-1 1.6-2.2 1.6S7.8 12 7.8 11"/></svg>',
  self:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><circle cx="10" cy="10" r="6.8"/><circle cx="10" cy="10" r="1.7" fill="currentColor" stroke="none"/><path d="M10 1.7v2M10 16.3v2M1.7 10h2M16.3 10h2"/></svg>',
  encounter:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M6.5 2.2h7v15.6h-7z"/><path d="M6.5 2.2 2.8 3.6v13l3.7-1.4"/><circle cx="8.6" cy="10" r=".75" fill="currentColor" stroke="none"/></svg>',
  compatibility:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M6.6 12.2C4 10.4 2.4 8.7 2.4 6.7c0-1.8 1.5-3.2 3.2-3.2 1 0 2 .5 2.6 1.3M13.4 12.2c2.6-1.8 4.2-3.5 4.2-5.5 0-1.8-1.5-3.2-3.2-3.2-1 0-2 .5-2.6 1.3"/><path d="M10 8.4c-1.6 1.7-3.6 3.2-3.6 5 0 1.7 1.4 2.8 3.6 4.3 2.2-1.5 3.6-2.6 3.6-4.3 0-1.8-2-3.3-3.6-5z"/></svg>',
  marriage:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><circle cx="7.4" cy="11" r="4.3"/><circle cx="12.6" cy="11" r="4.3"/><path d="M8.6 4.4 10 2l1.4 2.4"/></svg>',
  timing:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M5 2.5h10M5 17.5h10M6 2.5c0 3 1.6 4.7 4 6-2.4 1.3-4 3-4 6M14 2.5c0 3-1.6 4.7-4 6 2.4 1.3 4 3 4 6"/></svg>',
  kaiun:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M10 1.8c.7 3.6 2.1 5.9 6.2 6.7-4.1 1-5.5 3.3-6.2 6.9-.7-3.6-2.1-5.9-6.2-6.9 4.1-.8 5.5-3.1 6.2-6.7z" fill="currentColor" stroke="none"/></svg>',
  zense:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M10 2.2c3.4 1.1 5.6 3.6 5.6 6.8 0 4.3-3.4 7.8-5.6 8.8-2.2-1-5.6-4.5-5.6-8.8 0-1.9 1-3.5 2.4-4.7"/><path d="M10 5.6c1.7.7 2.8 2 2.8 3.6 0 2.3-1.8 4.1-2.8 4.8-1-.7-2.8-2.5-2.8-4.8"/></svg>'
};

// ── 10テーマ確定内容（順番・key・desc・ack・inputは仕様確定分。改変しない） ──
var AIC_THEMES = [
  { key:'love', name:'恋愛', desc:'恋愛の傾向やタイプを知る', ack:'恋愛についてですね。生年月日・MBTI・血液型から、恋愛の傾向を見ていきますね。', input:'ms' },
  { key:'work', name:'仕事・キャリア', desc:'向いている仕事の傾向を知る', ack:'仕事についてですね。生まれ持った気質から、向いている働き方を見ていきますね。', input:'single' },
  { key:'money', name:'金運', desc:'お金との付き合い方の傾向を知る', ack:'金運についてですね。本命星から、お金との付き合い方の傾向を見ていきますね。', input:'single' },
  { key:'self', name:'自己理解', desc:'自分の性格・強み弱みを知る', ack:'自己理解についてですね。生まれ持った気質から、強み・弱みを見ていきますね。', input:'single' },
  { key:'encounter', name:'出会い', desc:'新しい出会いへの心の開きやすさを知る', ack:'出会いについてですね。生年月日・MBTI・血液型から、新しい出会いへの向き合い方を見ていきますね。', input:'ms' },
  { key:'compatibility', name:'相性', desc:'気になるあの人との相性を知る', ack:'相性についてですね。お二人の生年月日から読み解いていきますね。', input:'dual' },
  { key:'marriage', name:'結婚', desc:'結婚について知りたいことを選ぶ', ack:null, input:null },
  { key:'timing', name:'運気の流れ', desc:'今年・今の運気の流れを知る', ack:'運気の流れについてですね。生年月日と性別から、今の運気の流れを見ていきますね。', input:'sg' },
  { key:'kaiun', name:'開運のヒント', desc:'今日から意識したい開運のポイントを知る', ack:'開運のヒントについてですね。本命星から、今すぐ試せるヒントを見ていきますね。', input:'single' },
  { key:'zense', name:'前世・運命', desc:'前世からのメッセージを知る', ack:'前世・運命についてですね。生年月日とお名前から、前世からのメッセージを見ていきますね。', input:'sn' }
];
var AIC_SOON = ['家族','学業・進路','選択・決断','健康','転職','復縁','相手の気持ち'];
var AIC_MARRIAGE_CHOICES = [
  { key:'marriage_self', name:'自分の結婚志向', ack:'自分の結婚志向についてですね。生年月日とタイプから、結婚観の傾向を見ていきますね。' },
  { key:'marriage_person', name:'この人との結婚相性', ack:'この人との結婚相性についてですね。お二人の生年月日から読み解いていきますね。' }
];
var AIC_INPUT_SUB = {
  love:'MBTIタイプと血液型もあわせて、恋愛傾向を読み解きます。',
  work:'本命星から、向いている働き方を読み解きます。',
  money:'九星気学の本命星から、お金との付き合い方を読み解きます。',
  self:'算命学の考え方で、あなたの気質を読み解きます。',
  encounter:'MBTIタイプと血液型もあわせて、新しい出会いへの心の開きやすさを読み解きます。',
  timing:'四柱推命の考え方で、今の運気の流れを読み解きます。',
  kaiun:'生年月日から、あなたの本命星を割り出します。',
  zense:'生年月日とお名前から、前世からのメッセージを読み解きます。',
  marriage_self:'MBTIタイプと血液型もあわせて、結婚観の傾向を読み解きます。',
  marriage_person:'お二人の生年月日から、星座の組み合わせで相性を見ます。',
  compatibility:'お二人の生年月日から、星座の組み合わせで相性を見ます。'
};
var AIC_RESULT_HEADINGS = { love:'恋愛', work:'仕事・キャリア', money:'金運', self:'自己理解', encounter:'出会い', timing:'運気の流れ', kaiun:'開運のヒント', zense:'前世・運命', marriage_self:'結婚志向', marriage_person:'この人との結婚相性', compatibility:'相性' };
var AIC_RESULT_LINKS = {
  love:{ url:'/love', label:'恋愛傾向診断で詳しく見る' },
  work:{ url:'/kyusei', label:'九星気学診断で詳しく見る' },
  money:{ url:'/kyusei', label:'九星気学診断で詳しく見る' },
  self:{ url:'/sanmei', label:'算命学鑑定で詳しく見る' },
  encounter:{ url:'/love', label:'恋愛傾向診断で詳しく見る' },
  timing:{ url:'/shichu', label:'四柱推命で詳しく見る' },
  kaiun:{ url:'/kyusei', label:'九星気学診断で詳しく見る' },
  zense:{ url:'/zense', label:'前世診断で詳しく見る' },
  marriage_self:{ url:'/love', label:'恋愛傾向診断で詳しく見る' },
  marriage_person:{ url:'/aisho', label:'相性診断で詳しく見る' },
  compatibility:{ url:'/aisho', label:'相性診断で詳しく見る' }
};

var AIC_MBTI_TYPES = ['INTJ','INTP','ENTJ','ENTP','INFJ','INFP','ENFJ','ENFP','ISTJ','ISFJ','ESTJ','ESFJ','ISTP','ISFP','ESTP','ESFP'];
var AIC_BLOOD_TYPES = ['A','B','O','AB'];
var AIC_YEARS = (function(){ var a=[],cy=new Date().getFullYear(); for(var y=cy;y>=1930;y--) a.push(y); return a; })();
var AIC_MONTHS = Array.from({length:12},function(_,i){return i+1;});
var AIC_DAYS = Array.from({length:31},function(_,i){return i+1;});

function aicEsc(s){
  return String(s == null ? '' : s).replace(/[&<>"']/g, function(c){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
  });
}
function aicNowTime(){
  var d = new Date();
  return String(d.getHours()).padStart(2,'0')+':'+String(d.getMinutes()).padStart(2,'0');
}
function aicTimeTag(){ return '<span class="aic-msg-time">'+aicNowTime()+'</span>'; }

// ── 通知音（吹き出しを1つ追加するたびに鳴らす軽いノイズ音） ──
// 「行を1つ追加する」処理そのものに紐付けることで、音と表示は常に1対1になる。
var aicAudioCtx = null;
var aicMuted = false;
try { aicMuted = localStorage.getItem('aic_muted') === '1'; } catch(e) {}
function aicGetAudioCtx(){
  var AC = window.AudioContext || window.webkitAudioContext;
  if(!AC) return null;
  if(!aicAudioCtx) aicAudioCtx = new AC();
  if(aicAudioCtx.state === 'suspended') aicAudioCtx.resume();
  return aicAudioCtx;
}
function aicPlayPop(){
  if(aicMuted) return;
  try {
    var c = aicGetAudioCtx();
    if(!c) return;
    var duration = 0.045, gainPeak = 0.5;
    var bufferSize = Math.ceil(c.sampleRate * duration);
    var buffer = c.createBuffer(1, bufferSize, c.sampleRate);
    var data = buffer.getChannelData(0);
    for(var i=0;i<bufferSize;i++){ data[i] = Math.random()*2-1; }
    var src = c.createBufferSource();
    src.buffer = buffer;
    var filter = c.createBiquadFilter();
    filter.type = 'highpass';
    filter.frequency.setValueAtTime(4500, c.currentTime);
    filter.frequency.exponentialRampToValueAtTime(6000, c.currentTime + duration);
    filter.Q.value = 0.9;
    var gain = c.createGain();
    gain.gain.setValueAtTime(gainPeak, c.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.0001, c.currentTime + duration);
    src.connect(filter);
    filter.connect(gain);
    gain.connect(c.destination);
    src.start(c.currentTime);
    src.stop(c.currentTime + duration + 0.02);
  } catch(e) {}
}
function aicUpdateMuteBtn(){
  var btn = document.getElementById('aicMuteBtn');
  if(!btn) return;
  btn.textContent = aicMuted ? '🔇' : '🔊';
  btn.setAttribute('aria-label', aicMuted ? '通知音をオンにする' : '通知音を消す');
}

// ── スレッドへの追加（土台となる唯一の描画操作） ──
// 新しいメッセージは必ずこの関数で「1行追加」される。既存の行の中身を
// 書き換えることはあっても（結果を待つ「入力中」を実際の結果に差し替える等）、
// 既存の行を丸ごと作り直す・消して出し直すことは一切しない。
function aicAddRow(side, stackHtml, opts){
  var thread = document.getElementById('aicThread');
  if(!thread) return null;
  var row = document.createElement('div');
  row.className = 'aic-row ' + side;
  if(opts && opts.id) row.id = opts.id;
  var stackClass = 'aic-stack' + (opts && opts.full ? ' aic-stack-full' : '');
  var stackStyle = side === 'user' ? ' style="align-items:flex-end"' : '';
  row.innerHTML = '<div class="' + stackClass + '"' + stackStyle + '>' + stackHtml + '</div>';
  thread.appendChild(row);
  aicPlayPop();
  var stepEl = document.getElementById('aicStepCount');
  var fillEl = document.getElementById('aicProgressFill');
  if(opts && opts.step){
    if(stepEl) stepEl.textContent = opts.step + ' / 4';
    if(fillEl) fillEl.style.width = (opts.step*25) + '%';
  }
  // 初回の挨拶＋テーマ一覧だけは自動スクロールしない。テーマ一覧が縦に長い場合、
  // 一番下までスクロールすると挨拶文が画面外に押し出されてしまうため
  // （スレッドが空の状態で開いた直後はscrollTopが既に0なので、何もしなくてよい）。
  if(!(opts && opts.noScroll)){
    thread.scrollTo({ top: thread.scrollHeight, behavior: 'smooth' });
  }
  return row;
}

// ── 日付ドロップダウン（自前実装。ネイティブ<select>は使わない） ──
// 開いているピッカーが、今どの日付オブジェクト・どのボタン要素に対応しているかだけを
// 覚えておく。ピッカーはスレッドの外にある共有の1つのオーバーレイなので、
// 値が選ばれたら「そのボタンの表示」と「対応する日付オブジェクト」だけを更新する。
var aicOpenPicker = null; // { list, current, suffix, title, onPick }
function aicDdField(dateObj, part, list, suffix, placeholder, onChangeCheck){
  var btnId = 'aicdd-' + Math.random().toString(36).slice(2);
  var current = dateObj[part];
  var label = current ? (current+suffix) : placeholder;
  var html = '<div class="aic-dd-wrap">'
    + '<button type="button" class="aic-dd-btn'+(current?'':' ph')+'" id="'+btnId+'">'+aicEsc(label)+'<span class="aic-dd-caret">▾</span></button>'
    + '</div>';
  // DOM挿入後にイベントを配線する必要があるため、呼び出し側でsetupを実行してもらう。
  return { html: html, setup: function(){
    var btn = document.getElementById(btnId);
    if(!btn) return;
    btn.addEventListener('click', function(){
      aicOpenPicker = {
        list: list, current: dateObj[part], suffix: suffix, title: placeholder+'を選択',
        onPick: function(v){
          dateObj[part] = v;
          btn.textContent = v + suffix;
          btn.classList.remove('ph');
          var caret = document.createElement('span');
          caret.className = 'aic-dd-caret'; caret.textContent = '▾';
          btn.appendChild(caret);
          if(onChangeCheck) onChangeCheck();
        }
      };
      aicRenderPicker();
    });
  }};
}
function aicDateRow(dateObj, onChangeCheck){
  var y = aicDdField(dateObj, 'y', AIC_YEARS, '年', '年', onChangeCheck);
  var m = aicDdField(dateObj, 'm', AIC_MONTHS, '月', '月', onChangeCheck);
  var d = aicDdField(dateObj, 'd', AIC_DAYS, '日', '日', onChangeCheck);
  return { html: '<div class="aic-date-row">' + y.html + m.html + d.html + '</div>', setup: function(){ y.setup(); m.setup(); d.setup(); } };
}
function aicDateReady(d){ return !!(d.y && d.m && d.d); }
function aicPad2(n){ n=String(n); return n.length<2 ? '0'+n : n; }
function aicBirthdayStr(d){ return d.y+'-'+aicPad2(d.m)+'-'+aicPad2(d.d); }

function aicPositionPickerSheet(sheet){
  if(!sheet) return;
  var isPcWidth = window.matchMedia('(min-width:461px)').matches;
  var modal = document.querySelector('.aic-modal');
  if(isPcWidth && modal){
    var rect = modal.getBoundingClientRect();
    sheet.style.left = rect.left + 'px';
    sheet.style.right = 'auto';
    sheet.style.width = rect.width + 'px';
    sheet.style.margin = '0';
    sheet.style.bottom = Math.max(0, window.innerHeight - rect.bottom) + 'px';
  } else {
    sheet.style.left = '';
    sheet.style.right = '';
    sheet.style.width = '';
    sheet.style.margin = '';
    sheet.style.bottom = '';
  }
}
function aicRenderPicker(){
  var overlay = document.getElementById('aicPickerOverlay');
  var sheet = overlay ? overlay.querySelector('.aic-picker-sheet') : null;
  var titleEl = document.getElementById('aicPickerTitle');
  var listEl = document.getElementById('aicPickerList');
  if(!overlay) return;
  if(!aicOpenPicker){ overlay.classList.remove('open'); return; }
  var def = aicOpenPicker;
  titleEl.textContent = def.title;
  listEl.innerHTML = def.list.map(function(v){
    return '<button type="button" class="aic-dd-option'+(String(v)===String(def.current)?' sel':'')+'" data-v="'+aicEsc(String(v))+'">'+v+def.suffix+'</button>';
  }).join('');
  aicPositionPickerSheet(sheet);
  overlay.classList.add('open');
  var targetValue = def.current || (def.suffix==='年' ? '2000' : null);
  if(targetValue){
    var idx = def.list.findIndex(function(v){ return String(v)===String(targetValue); });
    if(idx >= 0){
      var opts = listEl.querySelectorAll('.aic-dd-option');
      if(opts[idx]) opts[idx].scrollIntoView({ block:'center' });
    }
  }
}
document.addEventListener('click', function(e){
  var pick = e.target.closest('[data-v]');
  if(pick && pick.closest('#aicPickerList') && aicOpenPicker){
    aicOpenPicker.onPick(pick.dataset.v);
    aicOpenPicker = null;
    aicRenderPicker();
    return;
  }
  if(e.target.id === 'aicPickerOverlay'){
    aicOpenPicker = null;
    aicRenderPicker();
  }
});

// ── 入力欄の組み立て（テーマごとの入力タイプに応じて変わる） ──
function aicThemeInputType(effectiveTheme){
  if(effectiveTheme==='marriage_self') return 'ms';
  if(effectiveTheme==='marriage_person' || effectiveTheme==='compatibility') return 'dual';
  var t = AIC_THEMES.filter(function(x){return x.key===effectiveTheme;})[0];
  return t ? t.input : 'single';
}

// 現在開いている入力ターンの状態（1度に1つしか開かないため単一のオブジェクトでよい）。
var aicForm = null;

function aicInputReady(){
  if(!aicForm) return false;
  var type = aicForm.type;
  if(type==='single') return aicDateReady(aicForm.single);
  if(type==='sg') return aicDateReady(aicForm.sg) && !!aicForm.gender;
  if(type==='sn') return aicDateReady(aicForm.single) && !!(aicForm.name && aicForm.name.trim());
  if(type==='ms') return aicDateReady(aicForm.ms) && !!aicForm.mbti && !!aicForm.blood;
  if(type==='dual') return aicDateReady(aicForm.your) && aicDateReady(aicForm.partner);
  return false;
}
function aicBuildPayload(){
  var type = aicForm.type, theme = aicForm.effectiveTheme, payload = { theme: theme };
  if(type==='single'){
    payload.birthday = aicBirthdayStr(aicForm.single);
  } else if(type==='sg'){
    payload.birthday = aicBirthdayStr(aicForm.sg);
    payload.gender = aicForm.gender;
  } else if(type==='sn'){
    payload.birthday = aicBirthdayStr(aicForm.single);
    payload.name = aicForm.name.trim();
  } else if(type==='ms'){
    payload.birthday = aicBirthdayStr(aicForm.ms);
    payload.mbti = aicForm.mbti;
    payload.blood = aicForm.blood;
  } else if(type==='dual'){
    payload.yourBirthday = aicBirthdayStr(aicForm.your);
    payload.partnerBirthday = aicBirthdayStr(aicForm.partner);
  }
  return payload;
}

// 入力フォームの行を組み立てて追加する。送信ボタンの有効/無効判定用に
// updateReady()を都度呼べるようにし、フォーム内の要素だけを更新する。
function aicShowInputForm(effectiveTheme){
  var type = aicThemeInputType(effectiveTheme);
  aicForm = {
    type: type, effectiveTheme: effectiveTheme,
    single:{y:'',m:'',d:''}, ms:{y:'',m:'',d:''}, mbti:null, blood:null,
    sg:{y:'',m:'',d:''}, gender:null, name:'',
    your:{y:'',m:'',d:''}, partner:{y:'',m:'',d:''}
  };
  var submitBtnId = 'aic-submit-' + Math.random().toString(36).slice(2);
  var setups = [];
  var body;

  function updateReady(){
    var btn = document.getElementById(submitBtnId);
    if(btn) btn.disabled = !aicInputReady();
  }

  if(type==='single'){
    var r = aicDateRow(aicForm.single, updateReady); setups.push(r.setup);
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + r.html + '</div>';
  } else if(type==='sg'){
    var r = aicDateRow(aicForm.sg, updateReady); setups.push(r.setup);
    var genderId1 = 'aic-g-' + Math.random().toString(36).slice(2);
    var genderId2 = 'aic-g-' + Math.random().toString(36).slice(2);
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + r.html
      + '<span class="aic-date-legend">性別</span><div class="aic-grid4" style="grid-template-columns:1fr 1fr">'
        + '<button type="button" class="aic-pick-btn" id="'+genderId1+'">男性</button>'
        + '<button type="button" class="aic-pick-btn" id="'+genderId2+'">女性</button>'
      + '</div>'
      + '<span class="aic-footnote" style="display:block">※大運（10年ごとの運気サイクル）の順行・逆行の判定に使います</span>'
      + '</div>';
    setups.push(function(){
      var b1=document.getElementById(genderId1), b2=document.getElementById(genderId2);
      function pick(v,btn,other){ aicForm.gender=v; btn.classList.add('picked'); other.classList.remove('picked'); updateReady(); }
      if(b1) b1.addEventListener('click', function(){ pick('male', b1, b2); });
      if(b2) b2.addEventListener('click', function(){ pick('female', b2, b1); });
    });
  } else if(type==='sn'){
    var r = aicDateRow(aicForm.single, updateReady); setups.push(r.setup);
    var nameId = 'aic-name-' + Math.random().toString(36).slice(2);
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + r.html
      + '<span class="aic-date-legend">お名前</span>'
      + '<input type="text" class="aic-name-input" id="'+nameId+'" placeholder="例：山田 太郎" maxlength="20">'
      + '<span class="aic-footnote" style="display:block">※前世からのメッセージの抽出に使います（外部へは送信されません）</span>'
      + '</div>';
    setups.push(function(){
      var input = document.getElementById(nameId);
      if(input) input.addEventListener('input', function(){ aicForm.name = input.value; updateReady(); });
    });
  } else if(type==='ms'){
    var r = aicDateRow(aicForm.ms, updateReady); setups.push(r.setup);
    var mbtiIds = AIC_MBTI_TYPES.map(function(){ return 'aic-mbti-' + Math.random().toString(36).slice(2); });
    var bloodIds = AIC_BLOOD_TYPES.map(function(){ return 'aic-blood-' + Math.random().toString(36).slice(2); });
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + r.html
      + '<span class="aic-date-legend">MBTI</span><div class="aic-grid4">' + AIC_MBTI_TYPES.map(function(t,i){
          return '<button type="button" class="aic-pick-btn" id="'+mbtiIds[i]+'">'+t+'</button>';
        }).join('') + '</div>'
      + '<span class="aic-date-legend">血液型</span><div class="aic-grid4">' + AIC_BLOOD_TYPES.map(function(t,i){
          return '<button type="button" class="aic-pick-btn aic-blood-btn" id="'+bloodIds[i]+'">'+t+'型</button>';
        }).join('') + '</div>'
      + '</div>';
    setups.push(function(){
      var mbtiBtns = mbtiIds.map(function(id){ return document.getElementById(id); });
      mbtiBtns.forEach(function(btn, i){
        if(!btn) return;
        btn.addEventListener('click', function(){
          aicForm.mbti = AIC_MBTI_TYPES[i];
          mbtiBtns.forEach(function(b){ b && b.classList.remove('picked'); });
          btn.classList.add('picked');
          updateReady();
        });
      });
      var bloodBtns = bloodIds.map(function(id){ return document.getElementById(id); });
      bloodBtns.forEach(function(btn, i){
        if(!btn) return;
        btn.addEventListener('click', function(){
          aicForm.blood = AIC_BLOOD_TYPES[i];
          bloodBtns.forEach(function(b){ b && b.classList.remove('picked'); });
          btn.classList.add('picked');
          updateReady();
        });
      });
    });
  } else {
    var ry = aicDateRow(aicForm.your, updateReady); setups.push(ry.setup);
    var rp = aicDateRow(aicForm.partner, updateReady); setups.push(rp.setup);
    body = '<div class="aic-date-inline"><span class="aic-date-legend">あなたの生年月日</span>' + ry.html
      + '<span class="aic-date-legend">お相手の生年月日</span>' + rp.html
      + '</div>';
  }

  var backBtnId = 'aic-back-' + Math.random().toString(36).slice(2);
  var promptText = type==='sg' ? '生年月日と性別を教えてください' : type==='sn' ? '生年月日とお名前を教えてください' : '生年月日を教えてください';
  var html = '<div class="aic-bubble">'+promptText+'<span class="aic-sub">'+aicEsc(AIC_INPUT_SUB[effectiveTheme])+'</span></div>'
    + body
    + '<div class="aic-qr"><button type="button" class="aic-qr-btn ghost" id="'+backBtnId+'">← 最初から</button>'
    + '<button type="button" class="aic-qr-btn" id="'+submitBtnId+'" style="background:linear-gradient(180deg,#f5e4b8,#c0913c);color:#1d1407;border-color:#6d4f19" disabled>読み解いてもらう</button></div>';

  var row = aicAddRow('bot', html, { step: 2 });
  setups.forEach(function(fn){ fn(); });
  var backBtn = document.getElementById(backBtnId);
  var submitBtn = document.getElementById(submitBtnId);
  if(backBtn) backBtn.addEventListener('click', function(){ aicHandleBack(); });
  if(submitBtn) submitBtn.addEventListener('click', function(){ aicHandleSubmit(row, submitBtn, backBtn); });
  return row;
}

function aicFreezeRowButtons(row){
  if(!row) return;
  row.querySelectorAll('button').forEach(function(b){ b.disabled = true; });
}

// ── 送信〜結果表示 ──
function aicHandleSubmit(formRow, submitBtn, backBtn){
  if(!aicInputReady()) return;
  aicFreezeRowButtons(formRow);
  var input = formRow.querySelector('.aic-name-input');
  if(input) input.disabled = true;

  aicAddRow('user', '<div class="aic-bubble user">入力しました</div>' + aicTimeTag(), { step: 3 });

  var payload = aicBuildPayload();
  var startedAt = Date.now();
  var MIN_DELAY = 900;
  var typingRow = null;

  setTimeout(function(){
    typingRow = aicAddRow('bot', '<div class="aic-bubble">ありがとうございます。</div><div class="aic-bubble"><span class="aic-typing"><span></span><span></span><span></span></span></div>', { step: 3 });
  }, 500);

  fetch('/api/fortune-chat.php', {
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  }).then(function(res){
    return res.json().then(function(data){ return { ok: res.ok, data: data }; });
  }).then(function(result){
    finish(result, null);
  }).catch(function(err){
    finish(null, err);
  });

  function finish(result, err){
    var elapsed = Date.now() - startedAt;
    var wait = Math.max(0, MIN_DELAY - elapsed);
    setTimeout(function(){
      if(!typingRow){
        // まだ「ありがとうございます」ターンが来ていない場合は、それを先に出してから結果へ。
        typingRow = aicAddRow('bot', '<div class="aic-bubble">ありがとうございます。</div><div class="aic-bubble"><span class="aic-typing"><span></span><span></span><span></span></span></div>', { step: 3 });
      }
      if(err || !result.ok || result.data.error){
        aicPlayPop();
        var stepEl = document.getElementById('aicStepCount');
        var fillEl = document.getElementById('aicProgressFill');
        if(stepEl) stepEl.textContent = '4 / 4';
        if(fillEl) fillEl.style.width = '100%';
        var bubble = typingRow.querySelector('.aic-bubble:last-child');
        if(bubble) bubble.outerHTML = '<div class="aic-bubble aic-error-bubble">うまく読み解けませんでした。もう一度お試しください。</div>' + aicTimeTag();
        var retryBtnId = 'aic-retryinput-' + Math.random().toString(36).slice(2);
        var stack = typingRow.querySelector('.aic-stack');
        stack.insertAdjacentHTML('beforeend', '<div class="aic-qr"><button type="button" class="aic-qr-btn ghost" id="'+retryBtnId+'">もう一度入力する</button></div>');
        document.getElementById(retryBtnId).addEventListener('click', function(){
          aicFreezeRowButtons(typingRow);
          aicShowInputForm(aicForm.effectiveTheme);
        });
        return;
      }
      aicShowResult(typingRow, aicForm.effectiveTheme, result.data);
    }, wait);
  }
}

function aicResultBodyHtml(t){
  if(t==='self'){
    return '<div class="aic-angle-block"><p class="aic-angle-title">◎ あなたの強み</p><ul class="aic-angle-list" data-aic-list="strengths"></ul></div>'
      + '<div class="aic-angle-block"><p class="aic-angle-title">△ 気をつけたい傾向</p><ul class="aic-angle-list" data-aic-list="weaknesses"></ul></div>'
      + '<div class="aic-angle-block"><p class="aic-angle-title">👥 人との関わり方</p><p class="aic-result-body" data-aic-text="relations"></p></div>';
  } else if(t==='marriage_person' || t==='compatibility'){
    return '<div class="aic-stars" data-aic-stars></div><div class="aic-score-label" data-aic-text="label"></div><p class="aic-result-body" style="margin-top:.5rem" data-aic-text="reasonText"></p>';
  } else if(t==='timing'){
    return '<div class="aic-angle-block"><p class="aic-angle-title">今年の運気</p><p class="aic-result-body" data-aic-text="yearText"></p></div>'
      + '<div class="aic-angle-block"><p class="aic-angle-title">今の10年の運気</p>'
      + '<p class="aic-angle-subtitle">傾向</p><p class="aic-result-body" data-aic-text="decadeGodText"></p>'
      + '<p class="aic-angle-subtitle" style="margin-top:.5rem">エネルギーの流れ</p><p class="aic-result-body" data-aic-text="decadeJuniText"></p></div>';
  } else if(t==='zense'){
    return '<p class="aic-result-body" data-aic-text="message"></p><p class="aic-mission-line">今世の使命：<span data-aic-text="mission"></span></p>';
  }
  return '<p class="aic-result-body" data-aic-text="resultText"></p>';
}
// APIレスポンスの実データは、生成したプレースホルダー(data-aic-text等)に対して
// textContentで挿入する（innerHTMLは使わない＝XSS対策）。この関数はwrap要素
// 1つに対してのみ作用する、常にスコープの絞られた操作。
function aicFillResultData(wrap, r){
  wrap.querySelectorAll('[data-aic-text]').forEach(function(el){
    var key = el.getAttribute('data-aic-text');
    el.textContent = (r[key] != null) ? r[key] : '';
  });
  var badgeEl = wrap.querySelector('.aic-result-badge[data-aic-text="star"]');
  if(badgeEl) badgeEl.textContent = r.star || '';
  wrap.querySelectorAll('[data-aic-list]').forEach(function(ul){
    var key = ul.getAttribute('data-aic-list');
    var arr = r[key] || [];
    arr.forEach(function(item){
      var li = document.createElement('li');
      li.textContent = item;
      ul.appendChild(li);
    });
  });
  var starsEl = wrap.querySelector('[data-aic-stars]');
  if(starsEl){
    var score = r.score || 0, html = '';
    for(var i=1;i<=5;i++) html += '<span class="'+(i<=score?'aic-star-on':'aic-star-off')+'">★</span>';
    starsEl.innerHTML = html;
  }
}

// 「入力中」の吹き出しを、見出しに置き換える → 少し間を置いて本文を新しい行として
// 追加する、という2段階。触るのはtypingRowという1行だけで、それより上には触れない。
function aicShowResult(typingRow, effectiveTheme, resultData){
  var t = effectiveTheme, badge = '';
  if(t==='kaiun') badge = resultData.star || '';
  aicPlayPop();
  var headlineHtml = '<div class="aic-bubble headline">'+aicEsc(AIC_RESULT_HEADINGS[t])+'、読み解きました' + (badge?'<span class="aic-sub"><span class="aic-result-badge" data-aic-text="star"></span></span>':'') + '</div>' + aicTimeTag();
  var bubble = typingRow.querySelector('.aic-bubble:last-child');
  if(bubble) bubble.outerHTML = headlineHtml;
  if(badge){
    var badgeEl = typingRow.querySelector('.aic-result-badge[data-aic-text="star"]');
    if(badgeEl) badgeEl.textContent = badge;
  }

  setTimeout(function(){
    ++aicResultSeq;
    var resultId = 'aicResultWrap-' + aicResultSeq;
    var link = AIC_RESULT_LINKS[t];
    var retryBtnId = 'aic-retry-' + Math.random().toString(36).slice(2);
    var html = '<div class="aic-result-wrap" id="'+resultId+'">' + aicResultBodyHtml(t) + '</div>'
      + '<span class="aic-footnote">※既存の占いデータに基づく鑑定結果です。</span>'
      + (link ? '<a href="'+link.url+'" class="aic-result-link">'+aicEsc(link.label)+' →</a>' : '')
      + '<div class="aic-qr"><button type="button" class="aic-qr-btn ghost" id="'+retryBtnId+'">もう一度占う</button></div>';
    var row = aicAddRow('bot', html, { step: 4, full: true });
    var wrap = document.getElementById(resultId);
    if(wrap) aicFillResultData(wrap, resultData);
    document.getElementById(retryBtnId).addEventListener('click', function(){
      aicFreezeRowButtons(row);
      aicShowContinue();
    });
  }, 650);
}

// ── テーマ選択・結婚分岐 ──
var aicResultSeq = 0;

function aicShowThemeGrid(isFirst){
  var greeting = isFirst ? 'こんにちは。<br>何について知りたいですか？' : '他にも知りたいことはありますか？';
  var html = '<div class="aic-bubble headline">'+greeting+'</div>' + aicTimeTag()
    + '<div class="aic-qr grid2">'+AIC_THEMES.map(function(t){
        return '<button type="button" class="aic-qr-btn" data-aic-theme="'+t.key+'"><span class="aic-card-icon">'+(AIC_THEME_ICONS[t.key]||'')+'</span>'+aicEsc(t.name)+'<span class="aic-tag">'+aicEsc(t.desc)+'</span></button>';
      }).join('')+'</div>'
    + '<span class="aic-footnote" style="display:block;margin-top:.2rem">他にも準備中のテーマがあります（'+AIC_SOON.join('・')+'）</span>';
  var row = aicAddRow('bot', html, { full: true, step: 1, noScroll: isFirst });
  row.querySelectorAll('[data-aic-theme]').forEach(function(btn){
    btn.addEventListener('click', function(){ aicHandleThemePick(btn, btn.dataset.aicTheme); });
  });
  return row;
}
function aicShowContinue(){
  aicShowThemeGrid(false);
}

function aicHandleThemePick(gridRow, key){
  aicFreezeRowButtons(gridRow);
  var picked = AIC_THEMES.filter(function(t){return t.key===key;})[0];
  aicAddRow('user', '<div class="aic-bubble user">'+(picked?aicEsc(picked.name):'')+'</div>'+aicTimeTag(), { step: 1 });

  if(key==='marriage'){
    setTimeout(function(){
      var html = '<div class="aic-bubble">結婚について知りたいことを選んでください。</div>'
        + '<div class="aic-qr grid2">'+AIC_MARRIAGE_CHOICES.map(function(c){return '<button type="button" class="aic-qr-btn" data-aic-marriage="'+c.key+'">'+aicEsc(c.name)+'</button>';}).join('')+'</div>';
      var row = aicAddRow('bot', html, { full: true, step: 1 });
      row.querySelectorAll('[data-aic-marriage]').forEach(function(btn){
        btn.addEventListener('click', function(){ aicHandleMarriagePick(row, btn.dataset.aicMarriage); });
      });
    }, 550);
    return;
  }

  setTimeout(function(){
    aicAddRow('bot', '<div class="aic-bubble">'+aicEsc(picked.ack)+'</div>'+aicTimeTag(), { step: 1 });
    setTimeout(function(){
      aicShowInputForm(key);
    }, 550);
  }, 550);
}

function aicHandleMarriagePick(choiceRow, key){
  aicFreezeRowButtons(choiceRow);
  var pickedC = AIC_MARRIAGE_CHOICES.filter(function(c){return c.key===key;})[0];
  aicAddRow('user', '<div class="aic-bubble user">'+(pickedC?aicEsc(pickedC.name):'')+'</div>'+aicTimeTag(), { step: 1 });
  setTimeout(function(){
    aicAddRow('bot', '<div class="aic-bubble">'+aicEsc(pickedC.ack)+'</div>'+aicTimeTag(), { step: 1 });
    setTimeout(function(){
      aicShowInputForm(key);
    }, 550);
  }, 550);
}

function aicHandleBack(){
  var thread = document.getElementById('aicThread');
  if(thread) thread.innerHTML = '';
  aicForm = null;
  aicShowThemeGrid(true);
}

// ── モーダル開閉 ──
// anchorRect: 占いチャットタブ（#aftWrap）のgetBoundingClientRect()。
// PC幅（461px以上）の場合のみ、タブの縦中心に合わせてモーダルのtopを動的に設定する。
// anchorRectが渡されない場合（ドロワー「AI鑑定チャット」項目からの起動等）や
// スマホ幅の場合は、CSSのデフォルト位置（top:5vh／top:8vh）をそのまま使う。
function aicOpen(anchorRect){
  var overlay = document.getElementById('aicOverlay');
  if(!overlay) return;
  var modal = overlay.querySelector('.aic-modal');
  if(modal){
    var isPcWidth = window.matchMedia('(min-width:461px)').matches;
    if(anchorRect && isPcWidth){
      var modalHeight = modal.offsetHeight || Math.round(window.innerHeight * 0.9);
      var centerY = anchorRect.top + anchorRect.height / 2;
      var top = centerY - modalHeight / 2;
      top = Math.max(12, Math.min(top, window.innerHeight - modalHeight - 12));
      modal.style.top = top + 'px';
    } else {
      modal.style.top = '';
    }
  }
  overlay.classList.add('open');
}
function aicClose(){
  var overlay = document.getElementById('aicOverlay');
  if(overlay) overlay.classList.remove('open');
  var thread = document.getElementById('aicThread');
  if(thread) thread.innerHTML = '';
  aicForm = null;
  aicOpenPicker = null;
}
window.openAiChatModal = function(anchorRect){
  aicOpen(anchorRect);
  aicUpdateMuteBtn();
  var thread = document.getElementById('aicThread');
  if(thread && !thread.firstChild){
    aicShowThemeGrid(true);
  }
};

// ── イベント委譲（クリック） ──
document.addEventListener('click', function(e){
  var root = document.querySelector('.aic-root');
  if(!root) return;

  if(e.target.id==='aicCloseBtn' || e.target.id==='aicOverlay'){ aicClose(); return; }
  if(e.target.id==='aicMuteBtn'){
    aicMuted = !aicMuted;
    try { localStorage.setItem('aic_muted', aicMuted ? '1' : '0'); } catch(err) {}
    aicUpdateMuteBtn();
    return;
  }
});

document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){
    var overlay = document.getElementById('aicOverlay');
    if(overlay && overlay.classList.contains('open')) aicClose();
  }
});

})();

</script>
