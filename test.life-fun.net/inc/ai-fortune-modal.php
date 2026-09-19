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
.aic-picker-sheet{position:fixed;left:0;right:0;bottom:-100%;z-index:9996;background:#12172a;border:1px solid var(--aic-rule-2);border-top-left-radius:16px;border-top-right-radius:16px;box-shadow:0 -14px 40px rgba(0,0,0,.6);transition:bottom .28s cubic-bezier(.22,1,.3,1);max-height:60%;display:flex;flex-direction:column;max-width:380px;margin:0 auto;font-family:var(--aic-ff-sans)}
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

var aicState = null;
// 結果ラップ要素のid重複防止用カウンタ（「もう一度占う」で過去の結果ターンが
// history配列にHTML文字列として蓄積されるため、固定idだと2周目以降に
// document.getElementById()が古い履歴側の要素を返してしまう。連番idで一意化する）
var aicResultSeq = 0;
function aicInitialState(keepHistory){
  return {
    phase:'theme', theme:null, effectiveTheme:null,
    single:{y:'',m:'',d:''}, ms:{y:'',m:'',d:''}, mbti:null, blood:null,
    sg:{y:'',m:'',d:''}, gender:null, name:'',
    your:{y:'',m:'',d:''}, partner:{y:'',m:'',d:''},
    openDD:null, resultData:null, errorMsg:null,
    history: keepHistory ? aicState.history : [],
    scrollTarget: null
  };
}
aicState = aicInitialState();

function aicEsc(s){
  return String(s == null ? '' : s).replace(/[&<>"']/g, function(c){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
  });
}

// ── 日付ドロップダウン（自前実装。ネイティブ<select>は使わない） ──
var aicDdFieldDefs = {};
function aicDdField(prefix, part, list, current, suffix, placeholder){
  var key = prefix+'-'+part;
  var label = current ? (current+suffix) : placeholder;
  aicDdFieldDefs[key] = { list:list, current:current, suffix:suffix, title:placeholder+'を選択' };
  return '<div class="aic-dd-wrap">'
    + '<button type="button" class="aic-dd-btn'+(current?'':' ph')+'" data-aic-dd-toggle="'+key+'">'+aicEsc(label)+'<span class="aic-dd-caret">▾</span></button>'
    + '</div>';
}
function aicDateRow(prefix, d){
  return '<div class="aic-date-row">'
    + aicDdField(prefix,'y',AIC_YEARS,d.y,'年','年')
    + aicDdField(prefix,'m',AIC_MONTHS,d.m,'月','月')
    + aicDdField(prefix,'d',AIC_DAYS,d.d,'日','日')
    + '</div>';
}
function aicDateReady(d){ return !!(d.y && d.m && d.d); }
function aicThemeInputType(){
  if(aicState.effectiveTheme==='marriage_self') return 'ms';
  if(aicState.effectiveTheme==='marriage_person' || aicState.effectiveTheme==='compatibility') return 'dual';
  var t = AIC_THEMES.filter(function(x){return x.key===aicState.effectiveTheme;})[0];
  return t ? t.input : 'single';
}
function aicInputReady(){
  var type = aicThemeInputType();
  if(type==='single') return aicDateReady(aicState.single);
  if(type==='sg') return aicDateReady(aicState.sg) && !!aicState.gender;
  if(type==='sn') return aicDateReady(aicState.single) && !!(aicState.name && aicState.name.trim());
  if(type==='ms') return aicDateReady(aicState.ms) && !!aicState.mbti && !!aicState.blood;
  if(type==='dual') return aicDateReady(aicState.your) && aicDateReady(aicState.partner);
  return false;
}
function aicPad2(n){ n=String(n); return n.length<2 ? '0'+n : n; }
function aicBirthdayStr(d){ return d.y+'-'+aicPad2(d.m)+'-'+aicPad2(d.d); }

function aicInputTurn(){
  var type = aicThemeInputType(), body;
  if(type==='single'){
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + aicDateRow('single', aicState.single) + '</div>';
  } else if(type==='sg'){
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + aicDateRow('sg', aicState.sg)
      + '<span class="aic-date-legend">性別</span><div class="aic-grid4" style="grid-template-columns:1fr 1fr">'
        + '<button type="button" class="aic-pick-btn'+(aicState.gender==='male'?' picked':'')+'" data-aic-gender="male">男性</button>'
        + '<button type="button" class="aic-pick-btn'+(aicState.gender==='female'?' picked':'')+'" data-aic-gender="female">女性</button>'
      + '</div>'
      + '<span class="aic-footnote" style="display:block">※大運（10年ごとの運気サイクル）の順行・逆行の判定に使います</span>'
      + '</div>';
  } else if(type==='sn'){
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + aicDateRow('single', aicState.single)
      + '<span class="aic-date-legend">お名前</span>'
      + '<input type="text" class="aic-name-input" data-aic-name-input placeholder="例：山田 太郎" maxlength="20" value="'+aicEsc(aicState.name||'')+'">'
      + '<span class="aic-footnote" style="display:block">※前世からのメッセージの抽出に使います（外部へは送信されません）</span>'
      + '</div>';
  } else if(type==='ms'){
    body = '<div class="aic-date-inline"><span class="aic-date-legend">birth date</span>' + aicDateRow('ms', aicState.ms)
      + '<span class="aic-date-legend">MBTI</span><div class="aic-grid4">' + AIC_MBTI_TYPES.map(function(t){
          return '<button type="button" class="aic-pick-btn'+(aicState.mbti===t?' picked':'')+'" data-aic-mbti="'+t+'">'+t+'</button>';
        }).join('') + '</div>'
      + '<span class="aic-date-legend">血液型</span><div class="aic-grid4">' + AIC_BLOOD_TYPES.map(function(t){
          return '<button type="button" class="aic-pick-btn aic-blood-btn'+(aicState.blood===t?' picked':'')+'" data-aic-blood="'+t+'">'+t+'型</button>';
        }).join('') + '</div>'
      + '</div>';
  } else {
    body = '<div class="aic-date-inline"><span class="aic-date-legend">あなたの生年月日</span>' + aicDateRow('your', aicState.your)
      + '<span class="aic-date-legend">お相手の生年月日</span>' + aicDateRow('partner', aicState.partner)
      + '</div>';
  }
  var ready = aicInputReady();
  return '<div class="aic-row bot"><div class="aic-stack">'
    + '<div class="aic-bubble">'+(type==='sg' ? '生年月日と性別を教えてください' : type==='sn' ? '生年月日とお名前を教えてください' : '生年月日を教えてください')+'<span class="aic-sub">'+aicEsc(AIC_INPUT_SUB[aicState.effectiveTheme])+'</span></div>'
    + body
    + '<div class="aic-qr"><button type="button" class="aic-qr-btn ghost" data-aic-back>← 最初から</button>'
    + '<button type="button" class="aic-qr-btn" data-aic-submit style="background:linear-gradient(180deg,#f5e4b8,#c0913c);color:#1d1407;border-color:#6d4f19"'+(ready?'':' disabled')+'>読み解いてもらう</button></div>'
    + '</div></div>';
}

// ── 結果表示（本文はプレースホルダーのみ生成し、実データはrender()後にtextContentで挿入する） ──
function aicResultTurn(){
  var t = aicState.effectiveTheme, badge = '';
  var r = aicState.resultData || {};
  if(t==='kaiun') badge = r.star || '';
  var bodyHtml = '';
  if(t==='self'){
    bodyHtml = '<div class="aic-angle-block"><p class="aic-angle-title">◎ あなたの強み</p><ul class="aic-angle-list" data-aic-list="strengths"></ul></div>'
      + '<div class="aic-angle-block"><p class="aic-angle-title">△ 気をつけたい傾向</p><ul class="aic-angle-list" data-aic-list="weaknesses"></ul></div>'
      + '<div class="aic-angle-block"><p class="aic-angle-title">👥 人との関わり方</p><p class="aic-result-body" data-aic-text="relations"></p></div>';
  } else if(t==='marriage_person' || t==='compatibility'){
    bodyHtml = '<div class="aic-stars" data-aic-stars></div><div class="aic-score-label" data-aic-text="label"></div><p class="aic-result-body" style="margin-top:.5rem" data-aic-text="reasonText"></p>';
  } else if(t==='timing'){
    bodyHtml = '<div class="aic-angle-block"><p class="aic-angle-title">今年の運気</p><p class="aic-result-body" data-aic-text="yearText"></p></div>'
      + '<div class="aic-angle-block"><p class="aic-angle-title">今の10年の運気</p>'
      + '<p class="aic-angle-subtitle">傾向</p><p class="aic-result-body" data-aic-text="decadeGodText"></p>'
      + '<p class="aic-angle-subtitle" style="margin-top:.5rem">エネルギーの流れ</p><p class="aic-result-body" data-aic-text="decadeJuniText"></p></div>';
  } else if(t==='zense'){
    bodyHtml = '<p class="aic-result-body" data-aic-text="message"></p><p class="aic-mission-line">今世の使命：<span data-aic-text="mission"></span></p>';
  } else {
    bodyHtml = '<p class="aic-result-body" data-aic-text="resultText"></p>';
  }
  var link = AIC_RESULT_LINKS[t];
  return '<div class="aic-row bot" id="'+aicEsc(aicState.resultRowId)+'"><div class="aic-stack" style="max-width:100%">'
    + '<div class="aic-bubble headline">'+aicEsc(AIC_RESULT_HEADINGS[t])+'、読み解きました' + (badge?'<span class="aic-sub"><span class="aic-result-badge" data-aic-text="star"></span></span>':'') + '</div>'
    + aicTimeTag()
    + '<div class="aic-stack" style="max-width:100%"><div class="aic-result-wrap" id="'+aicEsc(aicState.resultId)+'">'+bodyHtml+'</div></div>'
    + '<span class="aic-footnote">※既存の占いデータに基づく鑑定結果です。</span>'
    + (link ? '<a href="'+link.url+'" class="aic-result-link">'+aicEsc(link.label)+' →</a>' : '')
    + '<div class="aic-qr"><button type="button" class="aic-qr-btn ghost" data-aic-retry>もう一度占う</button></div>'
    + '</div></div>';
}
// resultTurn描画後、APIレスポンスの実データをtextContentで流し込む（innerHTML不使用）
function aicFillResultData(){
  var wrap = document.getElementById(aicState.resultId);
  if(!wrap) return;
  var r = aicState.resultData || {};
  var t = aicState.effectiveTheme;
  wrap.querySelectorAll('[data-aic-text]').forEach(function(el){
    var key = el.getAttribute('data-aic-text');
    el.textContent = (r[key] != null) ? r[key] : '';
  });
  var badgeEl = wrap.querySelector('.aic-result-badge[data-aic-text="star"]');
  if(badgeEl) badgeEl.textContent = r.star || '';
  wrap.querySelectorAll('[data-aic-list]').forEach(function(ul){
    var key = ul.getAttribute('data-aic-list');
    var arr = r[key] || [];
    ul.innerHTML = '';
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

function aicRender(){
  var thread = document.getElementById('aicThread');
  if(!thread) return;

  var stepEl = document.getElementById('aicStepCount');
  var fillEl = document.getElementById('aicProgressFill');
  var step = aicPhaseStep();
  if(stepEl) stepEl.textContent = step + ' / 4';
  if(fillEl) fillEl.style.width = (step*25) + '%';

  var html = '';
  html += aicState.history.join('');

  var isFirstTurn = aicState.history.length === 0;
  var themeStackClass = 'aic-stack' + (aicState.phase==='theme' ? ' aic-stack-full' : '');
  html += '<div class="aic-row bot"'+(isFirstTurn ? '' : ' id="aicContinueRow"')+'><div class="'+themeStackClass+'">'
    + '<div class="aic-bubble headline">'+(isFirstTurn ? 'こんにちは。<br>何について知りたいですか？' : '他にも知りたいことはありますか？')+'</div>'
    + aicTimeTag()
    + (aicState.phase==='theme'
        ? '<div class="aic-qr grid2">'+AIC_THEMES.map(function(t){
            return '<button type="button" class="aic-qr-btn" data-aic-theme="'+t.key+'"><span class="aic-card-icon">'+(AIC_THEME_ICONS[t.key]||'')+'</span>'+aicEsc(t.name)+'<span class="aic-tag">'+aicEsc(t.desc)+'</span></button>';
          }).join('')+'</div>'
          + '<span class="aic-footnote" style="display:block;margin-top:.2rem">他にも準備中のテーマがあります（'+AIC_SOON.join('・')+'）</span>'
        : '')
    + '</div></div>';

  if(aicState.phase!=='theme'){
    var picked = AIC_THEMES.filter(function(t){return t.key===aicState.theme;})[0];
    html += '<div class="aic-row user"><div class="aic-stack" style="align-items:flex-end"><div class="aic-bubble user">'+(picked?aicEsc(picked.name):'')+'</div>'+aicTimeTag()+'</div></div>';
    if(aicState.theme!=='marriage' && picked){
      html += '<div class="aic-row bot"><div class="aic-stack"><div class="aic-bubble">'+aicEsc(picked.ack)+'</div>'+aicTimeTag()+'</div></div>';
    }
  }

  if(aicState.theme==='marriage'){
    var marriageStackClass = 'aic-stack' + (aicState.phase==='marriageChoice' ? ' aic-stack-full' : '');
    html += '<div class="aic-row bot"><div class="'+marriageStackClass+'">'
      + '<div class="aic-bubble">結婚について知りたいことを選んでください。</div>'
      + (aicState.phase==='marriageChoice'
          ? '<div class="aic-qr grid2">'+AIC_MARRIAGE_CHOICES.map(function(c){return '<button type="button" class="aic-qr-btn" data-aic-marriage="'+c.key+'">'+aicEsc(c.name)+'</button>';}).join('')+'</div>'
          : aicTimeTag())
      + '</div></div>';
    if(aicState.effectiveTheme){
      var pickedC = AIC_MARRIAGE_CHOICES.filter(function(c){return c.key===aicState.effectiveTheme;})[0];
      html += '<div class="aic-row user"><div class="aic-stack" style="align-items:flex-end"><div class="aic-bubble user">'+(pickedC?aicEsc(pickedC.name):'')+'</div>'+aicTimeTag()+'</div></div>';
      if(pickedC) html += '<div class="aic-row bot"><div class="aic-stack"><div class="aic-bubble">'+aicEsc(pickedC.ack)+'</div>'+aicTimeTag()+'</div></div>';
    }
  }

  if(aicState.phase==='input') html += aicInputTurn();
  if(aicState.phase==='loading' || aicState.phase==='result' || aicState.phase==='error'){
    html += '<div class="aic-row user"><div class="aic-stack" style="align-items:flex-end"><div class="aic-bubble user">入力しました</div>'+aicTimeTag()+'</div></div>';
  }
  if(aicState.phase==='loading'){
    html += '<div class="aic-row bot"><div class="aic-stack"><div class="aic-bubble">ありがとうございます。</div><div class="aic-bubble"><span class="aic-typing"><span></span><span></span><span></span></span></div></div></div>';
  }
  if(aicState.phase==='error'){
    html += '<div class="aic-row bot"><div class="aic-stack"><div class="aic-bubble aic-error-bubble">うまく読み解けませんでした。もう一度お試しください。</div>'+aicTimeTag()
      + '<div class="aic-qr"><button type="button" class="aic-qr-btn ghost" data-aic-retry-input>もう一度入力する</button></div></div></div>';
  }
  if(aicState.phase==='result') html += aicResultTurn();

  thread.innerHTML = html;

  if(aicState.phase==='result') aicFillResultData();

  if(aicState.scrollTarget === 'continue'){
    var continueRow = document.getElementById('aicContinueRow');
    if(continueRow) continueRow.scrollIntoView({ behavior: 'smooth', block: 'start' });
  } else if(aicState.scrollTarget === 'result' && aicState.resultRowId){
    // 結果表示時は「最下部へジャンプ」ではなく、新しい結果ターンの先頭
    // （見出しを含む行）が画面上部に来るようscrollIntoViewする。履歴が
    // 積み上がった2回目以降でも、最下部ジャンプだと見出しが視野外に
    // 置き去りになるため（「もう一度占う」を繰り返すと再現）。
    var resultRow = document.getElementById(aicState.resultRowId);
    if(resultRow) resultRow.scrollIntoView({ behavior: 'smooth', block: 'start' });
    else thread.scrollTo({ top: thread.scrollHeight, behavior: 'smooth' });
  } else {
    thread.scrollTo({ top: thread.scrollHeight, behavior: 'smooth' });
  }
  aicState.scrollTarget = null;
  aicRenderPicker();
}

function aicNowTime(){
  var d = new Date();
  return String(d.getHours()).padStart(2,'0')+':'+String(d.getMinutes()).padStart(2,'0');
}
function aicTimeTag(){ return '<span class="aic-msg-time">'+aicNowTime()+'</span>'; }
function aicPhaseStep(){
  if(aicState.phase==='theme' || aicState.phase==='marriageChoice') return 1;
  if(aicState.phase==='input') return 2;
  if(aicState.phase==='loading') return 3;
  return 4;
}

// PC幅（461px以上）ではモーダルがタブの位置に応じて画面上を移動するため、
// pickerシート（.aic-picker-sheet、.aic-overlay/.aic-modalとは別ツリーの兄弟要素で
// 画面全体基準のposition:fixed）を、開くたびにモーダルのgetBoundingClientRect()に
// 合わせてインラインスタイルで追従させる。スマホ幅では画面全体基準のまま
// （インラインスタイルをクリアしてCSSのデフォルト位置に戻す）。
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
  if(!aicState.openDD){ overlay.classList.remove('open'); return; }
  var def = aicDdFieldDefs[aicState.openDD];
  if(!def){ overlay.classList.remove('open'); return; }
  titleEl.textContent = def.title;
  listEl.innerHTML = def.list.map(function(v){
    return '<button type="button" class="aic-dd-option'+(String(v)===String(def.current)?' sel':'')+'" data-aic-dd-pick="'+aicState.openDD+'|'+v+'">'+v+def.suffix+'</button>';
  }).join('');
  aicPositionPickerSheet(sheet);
  overlay.classList.add('open');
  var targetValue = def.current || (aicState.openDD.slice(-2)==='-y' ? '2000' : null);
  if(targetValue){
    var idx = def.list.findIndex(function(v){ return String(v)===String(targetValue); });
    if(idx >= 0){
      var opts = listEl.querySelectorAll('.aic-dd-option');
      if(opts[idx]) opts[idx].scrollIntoView({ block:'center' });
    }
  }
}

// ── API呼び出し ──
function aicBuildPayload(){
  var type = aicThemeInputType(), theme = aicState.effectiveTheme, payload = { theme: theme };
  if(type==='single'){
    payload.birthday = aicBirthdayStr(aicState.single);
  } else if(type==='sg'){
    payload.birthday = aicBirthdayStr(aicState.sg);
    payload.gender = aicState.gender;
  } else if(type==='sn'){
    payload.birthday = aicBirthdayStr(aicState.single);
    payload.name = aicState.name.trim();
  } else if(type==='ms'){
    payload.birthday = aicBirthdayStr(aicState.ms);
    payload.mbti = aicState.mbti;
    payload.blood = aicState.blood;
  } else if(type==='dual'){
    payload.yourBirthday = aicBirthdayStr(aicState.your);
    payload.partnerBirthday = aicBirthdayStr(aicState.partner);
  }
  return payload;
}
function aicSubmit(){
  if(!aicInputReady()) return;
  aicState.phase='loading';
  aicRender();
  var payload = aicBuildPayload();
  var startedAt = Date.now();
  var MIN_DELAY = 900;
  fetch('/api/fortune-chat.php', {
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  }).then(function(res){
    return res.json().then(function(data){ return { ok: res.ok, data: data }; });
  }).then(function(result){
    var elapsed = Date.now() - startedAt;
    var wait = Math.max(0, MIN_DELAY - elapsed);
    setTimeout(function(){
      if(!result.ok || result.data.error){
        aicState.phase = 'error';
      } else {
        aicState.resultData = result.data;
        ++aicResultSeq;
        aicState.resultId = 'aicResultWrap-' + aicResultSeq;
        aicState.resultRowId = 'aicResultRow-' + aicResultSeq;
        aicState.phase = 'result';
        aicState.scrollTarget = 'result';
      }
      aicRender();
    }, wait);
  }).catch(function(){
    var elapsed = Date.now() - startedAt;
    var wait = Math.max(0, MIN_DELAY - elapsed);
    setTimeout(function(){
      aicState.phase = 'error';
      aicRender();
    }, wait);
  });
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
      // .aic-modalはdisplay:noneにはならず常時レイアウトされている（非表示はopacity:0で
      // 行っている）ため、offsetHeightは呼び出し時点で必ず実測値を返す。
      // 右側のフォールバック（window.innerHeight*0.9）は実質到達しないが、
      // 万一CSSが変更されoffsetHeightが0になるケースに備えて保持する。
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
  aicState = aicInitialState();
  aicRender();
}
window.openAiChatModal = function(anchorRect){
  aicOpen(anchorRect);
  aicRender();
};

// ── イベント委譲（クリック） ──
document.addEventListener('click', function(e){
  var root = document.querySelector('.aic-root');
  if(!root) return;

  if(e.target.id==='aicCloseBtn' || e.target.id==='aicOverlay'){ aicClose(); return; }

  if(!root.contains(e.target)) return;

  var themePick = e.target.closest('[data-aic-theme]');
  if(themePick){
    var key = themePick.dataset.aicTheme;
    aicState.theme = key;
    if(key==='marriage'){ aicState.phase='marriageChoice'; } else { aicState.effectiveTheme=key; aicState.phase='input'; }
    aicRender(); return;
  }
  var marriagePick = e.target.closest('[data-aic-marriage]');
  if(marriagePick){ aicState.effectiveTheme = marriagePick.dataset.aicMarriage; aicState.phase='input'; aicRender(); return; }

  var mbti = e.target.closest('[data-aic-mbti]'); if(mbti){ aicState.mbti = mbti.dataset.aicMbti; aicRender(); return; }
  var blood = e.target.closest('[data-aic-blood]'); if(blood){ aicState.blood = blood.dataset.aicBlood; aicRender(); return; }
  var gender = e.target.closest('[data-aic-gender]'); if(gender){ aicState.gender = gender.dataset.aicGender; aicRender(); return; }

  if(e.target.closest('[data-aic-back]')){ aicState = aicInitialState(); aicRender(); return; }
  if(e.target.closest('[data-aic-retry-input]')){ aicState.phase='input'; aicRender(); return; }
  if(e.target.closest('[data-aic-retry]')){
    var pastThread = document.getElementById('aicThread');
    var tmp = document.createElement('div');
    tmp.innerHTML = pastThread ? pastThread.innerHTML : '';
    tmp.querySelectorAll('[data-aic-retry],[data-aic-back],[data-aic-retry-input]').forEach(function(btn){
      var row = btn.closest('.aic-qr') || btn;
      row.remove();
    });
    aicState = aicInitialState(true);
    aicState.history.push(tmp.innerHTML);
    aicState.scrollTarget = 'continue';
    aicRender();
    return;
  }

  if(e.target.closest('[data-aic-submit]')){ aicSubmit(); return; }

  var ddToggle = e.target.closest('[data-aic-dd-toggle]');
  if(ddToggle){
    var k = ddToggle.dataset.aicDdToggle;
    aicState.openDD = (aicState.openDD === k) ? null : k;
    aicRender();
    return;
  }
  var ddPick = e.target.closest('[data-aic-dd-pick]');
  if(ddPick){
    var pair = ddPick.dataset.aicDdPick.split('|');
    var fieldKey = pair[0], value = pair[1];
    var fp = fieldKey.split('-');
    var map = { single:aicState.single, sg:aicState.sg, ms:aicState.ms, your:aicState.your, partner:aicState.partner };
    var target = map[fp[0]];
    if(target){ target[fp[1]] = value; }
    aicState.openDD = null;
    aicRender();
    return;
  }
  if(e.target.id==='aicPickerOverlay'){
    aicState.openDD = null;
    aicRender();
    return;
  }
});

// 名前入力欄：キー入力のたびに全体render()を呼ぶとフォーカスが外れるため、
// 状態更新と送信ボタンの有効/無効切り替えだけを直接行う。
document.addEventListener('input', function(e){
  if(e.target.matches('[data-aic-name-input]')){
    aicState.name = e.target.value;
    var submitBtn = document.querySelector('[data-aic-submit]');
    if(submitBtn) submitBtn.disabled = !aicInputReady();
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
