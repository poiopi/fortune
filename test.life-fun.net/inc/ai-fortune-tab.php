<?php
declare(strict_types=1);

/**
 * inc/ai-fortune-tab.php
 *
 * 画面右端に常時表示する「占いチャット」タブ。footer.phpからrequireされ、
 * 全ページ共通で1つだけ出力される。クリックすると既存のAI鑑定チャットモーダル
 * （inc/ai-fortune-modal.phpが公開するwindow.openAiChatModal()）をそのまま開く。
 * モーダル自体はここでは一切変更しない。既存のドロワー「AI鑑定チャット」項目
 * （footer.php内 #fmenuAiChatBtn）とは別の、もう一つの入口を追加するだけ。
 *
 * UI・操作パターンの参照元：_scratch/ai-fortune-chat-tab-demo.html
 * （Claude Artifact上でユーザーが実機検証したモックアップ）。
 *
 * モックアップとの差分（技術的な理由によるもの）：
 * - モックアップはスマホ画面デモ枠(.frame)内にposition:absoluteで配置していたが、
 *   実サイトには枠が存在しないため、position:fixedで実ビューポート基準に配置する。
 *   top位置の計算・クランプ処理もwindow.innerHeight基準に置き換える。
 * - リサイズ（画面回転等）でタブが画面外に出ないよう、resizeイベントで
 *   位置を再クランプする処理を追加（モックアップにはPC/SP切替ボタンがあり、
 *   その切替時に同等の再クランプ処理を行っていたことに相当）。
 * - タブ静止時のホバー反応（軽いscale）を追加（仕様確定事項。モックアップ自体には
 *   hover専用スタイルの明記はなかったため、既存.fmenu-btnのhover演出を参考に
 *   ごく控えめな値で実装）。
 * - ドラッグ実装（pointerdownはタブ要素、pointermove/pointerup は window に登録し、
 *   setPointerCapture を使わない）は、モックアップの実装をそのまま踏襲している
 *   （クリックとドラッグの競合を避けるための確定パターン）。
 *
 * 色・意匠は inc/footer.php の .fmenu-btn（紫×金のradial-gradient、金色リング）を
 * 踏襲しているが、.fmenu-btn が持つ常時ループのアニメーション（回転リング／
 * パルス／オーラ）は仕様により踏襲しない。footer.php はこれらの色をCSS変数化
 * しておらず直接指定しているため、本ファイルでも同じ値を直接指定している。
 */
?>
<style>
.aft-wrap{
  position:fixed;top:40vh;right:0;z-index:1998;
  display:flex;flex-direction:column;
  border:1px solid #c9a84c;border-right:none;border-radius:12px 0 0 12px;
  overflow:hidden;box-shadow:-4px 0 20px rgba(90,40,200,.5),0 4px 16px rgba(0,0,0,.5);
  cursor:grab;touch-action:none;user-select:none;-webkit-user-select:none;
  transform-origin:right center;
  transition:box-shadow .2s,transform .2s,opacity .2s;
}
.aft-wrap.aft-hide{opacity:0;pointer-events:none}
.aft-wrap:hover:not(.aft-dragging){transform:scale(1.04)}
.aft-wrap:active{cursor:grabbing}
.aft-wrap.aft-dragging{box-shadow:-6px 0 26px rgba(120,70,255,.65),0 4px 16px rgba(0,0,0,.5)}
.aft-min-btn{
  display:block;width:100%;margin:0;
  background:radial-gradient(circle at 35% 35%,#4a20a0,#1a0a40);
  color:#e8d48a;border:none;border-bottom:1px solid rgba(201,168,76,.35);
  font-size:12px;line-height:1;padding:5px 0;cursor:pointer;
  transition:background .2s;
}
.aft-min-btn:hover{background:radial-gradient(circle at 35% 35%,#5c2ec0,#220d50)}
.aft-body{
  display:block;margin:0;border:none;
  writing-mode:vertical-rl;text-orientation:upright;
  background:radial-gradient(circle at 35% 35%,#4a20a0,#1a0a40);
  color:#e8d48a;font-family:'DM Mono',monospace;font-size:13px;letter-spacing:.15em;font-weight:500;
  padding:14px 9px;cursor:inherit;
  transition:background .2s;
}
.aft-body:hover{background:radial-gradient(circle at 35% 35%,#5c2ec0,#220d50)}
.aft-wrap.aft-min{border-radius:50%}
.aft-wrap.aft-min .aft-body{display:none}
.aft-wrap.aft-min .aft-min-btn{
  width:38px;height:38px;padding:0;border:none;border-radius:50%;
  display:flex;align-items:center;justify-content:center;font-size:16px;
}
@media(max-width:480px){
  .aft-body{font-size:12px;padding:12px 8px}
}
</style>

<div class="aft-wrap" id="aftWrap">
  <button type="button" class="aft-min-btn" id="aftMinBtn" aria-label="最小化する">&minus;</button>
  <button type="button" class="aft-body" id="aftBody" aria-label="占いチャットを開く">占いチャット</button>
</div>

<script>
(function(){
'use strict';
var wrap = document.getElementById('aftWrap');
var minBtn = document.getElementById('aftMinBtn');
var body = document.getElementById('aftBody');
if(!wrap || !minBtn || !body) return;

function aftClamp(v, min, max){ return Math.max(min, Math.min(max, v)); }

// 画面上端はヘッダー(sticky, 54px)と重ならないよう72pxの余白を確保する。
// 下端はモックアップ（_scratch/ai-fortune-chat-tab-demo.html）と同じ36pxに揃える。
function aftClampPosition(){
  var vh = window.innerHeight, th = wrap.offsetHeight;
  var top = parseFloat(wrap.style.top);
  if (isNaN(top)) top = vh * 0.4;
  wrap.style.top = aftClamp(top, 72, Math.max(72, vh - th - 36)) + 'px';
}
aftClampPosition();
window.addEventListener('resize', aftClampPosition);

// ── ドラッグ実装 ──
// pointerdownはタブ要素(wrap)に登録するが、pointermove/pointerupはwindowに登録する。
// wrap自体にsetPointerCapture()は使わない（子要素=最小化ボタン・タブ本体への
// クリックイベントが親に横取りされ、クリックが効かなくなる不具合を避けるため）。
var aftDragging = false, aftMoved = false, aftStartY = 0, aftStartTop = 0;
function aftOnDragMove(e){
  if (!aftDragging) return;
  var dy = e.clientY - aftStartY;
  if (Math.abs(dy) > 6) aftMoved = true;
  var vh = window.innerHeight, th = wrap.offsetHeight;
  wrap.style.top = aftClamp(aftStartTop + dy, 72, Math.max(72, vh - th - 36)) + 'px';
}
function aftOnDragEnd(){
  aftDragging = false;
  wrap.classList.remove('aft-dragging');
  window.removeEventListener('pointermove', aftOnDragMove);
  window.removeEventListener('pointerup', aftOnDragEnd);
}
wrap.addEventListener('pointerdown', function(e){
  aftDragging = true;
  aftMoved = false;
  aftStartY = e.clientY;
  aftStartTop = parseFloat(wrap.style.top) || (window.innerHeight * 0.4);
  wrap.classList.add('aft-dragging');
  window.addEventListener('pointermove', aftOnDragMove);
  window.addEventListener('pointerup', aftOnDragEnd);
});

// チャットモーダル(inc/ai-fortune-modal.php)が開いている間はタブを隠す。
// モーダル本体には手を加えず、.aic-overlay要素のclass変化をMutationObserverで
// 監視することで、閉じ方（✕ボタン／オーバーレイクリック／ESC等）に関わらず
// 正しく表示・非表示を切り替える。
var aicOverlay = document.getElementById('aicOverlay');
if (aicOverlay) {
  var aftModalObserver = new MutationObserver(function(){
    if (aicOverlay.classList.contains('open')) {
      wrap.classList.add('aft-hide');
    } else {
      wrap.classList.remove('aft-hide');
    }
  });
  aftModalObserver.observe(aicOverlay, { attributes: true, attributeFilter: ['class'] });
}

// タブ本体クリック → 既存のAI鑑定チャットモーダルを開く（新規実装しない）
body.addEventListener('click', function(){
  if (aftMoved) { aftMoved = false; return; }
  if (wrap.classList.contains('aft-min')) return; // 最小化中はクリックしても開かない（誤操作防止）
  if (typeof window.openAiChatModal === 'function') window.openAiChatModal();
});

// 最小化トグル
minBtn.addEventListener('click', function(e){
  e.stopPropagation();
  if (aftMoved) { aftMoved = false; return; }
  var isMin = wrap.classList.toggle('aft-min');
  minBtn.innerHTML = isMin ? '&#128302;' : '&minus;';
  minBtn.setAttribute('aria-label', isMin ? '占いチャットタブを元に戻す' : '最小化する');
});
})();
</script>
