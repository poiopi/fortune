<?php
// シェアボタン共通パーツ
// 使い方: <?php require __DIR__.'/inc/share-btns.php'; ?>
?>
<style>
.share-wrap{text-align:center;margin:1.5rem 0 1rem}
.share-label{font-family:'DM Mono',monospace;font-size:.62rem;color:#8a7db5;letter-spacing:.1em;margin-bottom:.55rem}
.share-btns{display:flex;justify-content:center;gap:.45rem;flex-wrap:wrap}
.share-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.45rem .85rem;border-radius:20px;font-size:.7rem;font-family:'DM Mono',monospace;cursor:pointer;text-decoration:none;border:none;transition:opacity .2s;white-space:nowrap}
.share-btn:hover{opacity:.8}
.share-line{background:#06C755;color:#fff}
.share-x{background:#000;color:#fff}
.share-fb{background:#1877F2;color:#fff}
.share-copy{background:rgba(155,114,239,.15);border:1px solid rgba(155,114,239,.35)!important;color:#c4a8f5}
</style>
<div class="share-wrap">
  <p class="share-label">✦ 結果をシェアする</p>
  <div class="share-btns">
    <button class="share-btn share-line" onclick="openShare('line')">LINE</button>
    <button class="share-btn share-x"    onclick="openShare('x')">𝕏</button>
    <button class="share-btn share-fb"   onclick="openShare('fb')">Facebook</button>
    <button class="share-btn share-copy" onclick="copyShareUrl()">🔗 リンクをコピー</button>
  </div>
</div>
<script>
if(typeof openShare==='undefined'){
  function openShare(type){
    const u=encodeURIComponent(location.href);
    const t=encodeURIComponent(document.title);
    const urls={
      line:'https://social-plugins.line.me/lineit/share?url='+u,
      x:'https://twitter.com/intent/tweet?url='+u+'&text='+t,
      fb:'https://www.facebook.com/sharer/sharer.php?u='+u
    };
    window.open(urls[type],'_blank','noopener,noreferrer,width=600,height=400');
  }
  function copyShareUrl(){
    navigator.clipboard.writeText(location.href).then(()=>{
      const b=document.querySelector('.share-copy');
      const orig=b.textContent;
      b.textContent='✓ コピーしました！';
      setTimeout(()=>b.textContent=orig,2000);
    });
  }
}
</script>
