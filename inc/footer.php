<?php
$_slug = $currentSlug ?? ($currentPage ?? '');
$_type = $pageType ?? 'tool';
require_once __DIR__.'/nav-cards.php';
$_p = $_slug; // 後方互換（fmenuの current 判定用）

function render_footer(array $opts = []): void {
  global $_NAV_PAGES;
  $slug = $opts['currentSlug'] ?? '';
  $featured  = get_featured_pages(5);
  $articles  = get_article_pages($slug);
  echo '<footer class="site-footer">';
  echo '<div class="site-footer-inner">';
  // 人気の占い
  echo '<div class="sf-col"><p class="sf-heading">人気の占い</p><ul>';
  foreach ($featured as $s => $p) {
    if ($s === $slug) {
      echo '<li><span style="color:var(--muted)">'.$p['name'].'</span></li>';
    } else {
      echo '<li><a href="'.htmlspecialchars($p['url']).'">'.$p['name'].'</a></li>';
    }
  }
  echo '</ul></div>';
  // 解説ガイド
  echo '<div class="sf-col"><p class="sf-heading">解説ガイド</p><ul>';
  echo '<li><a href="/articles/">占い解説ガイド</a></li>';
  foreach ($articles as $s => $p) {
    if ($s === $slug) {
      echo '<li><span style="color:var(--muted)">'.$p['name'].'とは</span></li>';
    } else {
      echo '<li><a href="'.htmlspecialchars($p['article']).'">'.$p['name'].'とは</a></li>';
    }
  }
  echo '</ul></div>';
  // サイト情報
  echo '<div class="sf-col"><p class="sf-heading">サイト情報</p><ul>';
  echo '<li><a href="/profile">運営者情報</a></li>';
  echo '<li><a href="/privacy">プライバシーポリシー</a></li>';
  echo '<li><a href="/disclaimer">免責事項</a></li>';
  echo '<li><a href="/contact">お問い合わせ</a></li>';
  echo '</ul></div>';
  echo '</div>';
  echo '<p class="sf-copy">&copy; '.date('Y').' 占いPortal</p>';
  echo '</footer>';
}
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
<div class="nav-cards-section">
  <h3>✦ おすすめの占い ✦</h3>
  <p class="nav-cards-lead">こちらもあわせてどうぞ</p>
  <?= _nav_cards(9, $_p) ?>
</div>
<?php render_footer(['currentSlug' => $_slug, 'pageType' => $_type]); ?>
<style>
.site-footer{border-top:1px solid rgba(160,130,220,.18);padding:2.5rem 1.2rem 1.5rem;margin-top:2rem}
.site-footer-inner{max-width:860px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:2rem}
.sf-heading{font-family:'DM Mono',monospace;font-size:.62rem;letter-spacing:.18em;color:#c9a84c;text-transform:uppercase;margin-bottom:.6rem;padding-bottom:.5rem;border-bottom:1px solid rgba(160,130,220,.18)}
.site-footer ul{list-style:none;display:flex;flex-direction:column;gap:.45rem}
.site-footer ul a{font-size:.8rem;color:#8a7db5;text-decoration:none;transition:color .2s}
.site-footer ul a:hover{color:#c4a8f5}
.sf-copy{font-family:'DM Mono',monospace;font-size:.68rem;color:rgba(138,125,181,.45);text-align:center;letter-spacing:.1em}
@media(max-width:600px){
  .site-footer-inner{grid-template-columns:1fr;gap:1.5rem}
}
</style>
<!-- ═══ フローティングメニュー ═══ -->
<style>
/* SPではヘッダーのハンバーガーを非表示 → フローティングに一本化 */
@media(max-width:767px){
  .sp-menu-btn,.sp-dropdown{display:none!important}
}

/* オーバーレイ */
.fmenu-overlay{position:fixed;inset:0;background:rgba(0,0,0,.55);backdrop-filter:blur(3px);z-index:1999;opacity:0;pointer-events:none;transition:opacity .3s}
.fmenu-overlay.open{opacity:1;pointer-events:all}

/* ドロワー */
.fmenu-drawer{
  position:fixed;top:0;left:0;height:100%;width:280px;
  background:linear-gradient(180deg,#0f0b1e 0%,#1a1035 100%);
  border-right:1px solid rgba(155,114,239,.35);
  box-shadow:4px 0 40px rgba(90,50,180,.4);
  z-index:2000;transform:translateX(-100%);transition:transform .35s cubic-bezier(.4,0,.2,1);
  display:flex;flex-direction:column;overflow:hidden
}
.fmenu-drawer.open{transform:translateX(0)}

/* ドロワーヘッダー */
.fmenu-head{
  padding:1.4rem 1.2rem 1rem;
  border-bottom:1px solid rgba(155,114,239,.2);
  display:flex;align-items:center;justify-content:space-between
}
.fmenu-head-title{
  font-family:'Shippori Mincho',serif;font-size:.8rem;letter-spacing:.2em;
  color:#c4a8f5;text-transform:uppercase
}
.fmenu-close-btn{
  background:none;border:1px solid rgba(155,114,239,.3);border-radius:50%;
  width:28px;height:28px;color:#8a7db5;cursor:pointer;font-size:.8rem;
  display:flex;align-items:center;justify-content:center;transition:color .2s,border-color .2s
}
.fmenu-close-btn:hover{color:#c4a8f5;border-color:#9b72ef}

/* ナビリスト */
.fmenu-nav{flex:1;overflow-y:auto;padding:.75rem 0;scrollbar-width:thin;scrollbar-color:rgba(155,114,239,.3) transparent}
.fmenu-item{
  display:flex;align-items:center;gap:.7rem;padding:.7rem 1.4rem;
  font-family:'Shippori Mincho',serif;font-size:.85rem;letter-spacing:.04em;
  color:#c8c0e0;text-decoration:none;transition:background .2s,color .2s;
  border-left:2px solid transparent
}
.fmenu-item:hover{background:rgba(155,114,239,.12);color:#e8e0f8;border-left-color:#9b72ef}
.fmenu-item.current{
  background:rgba(155,114,239,.18);color:#c4a8f5;
  border-left-color:#c9a84c;cursor:default;pointer-events:none
}
.fmenu-item-icon{font-size:1.1rem;width:1.4rem;text-align:center;flex-shrink:0}
.fmenu-section-label{
  padding:.5rem 1.4rem .25rem;
  font-family:'DM Mono',monospace;font-size:.58rem;letter-spacing:.18em;
  color:rgba(138,125,181,.5);text-transform:uppercase
}

/* フローティングボタン */
.fmenu-btn{
  position:fixed;bottom:1.6rem;left:1.6rem;z-index:1998;
  width:64px;height:64px;border-radius:50%;border:none;
  background:radial-gradient(circle at 35% 35%,#4a20a0,#1a0a40);
  cursor:pointer;
  box-shadow:0 0 0 2px rgba(201,168,76,.7),0 0 28px rgba(130,70,240,.9),0 0 60px rgba(100,50,200,.5),0 4px 20px rgba(0,0,0,.7);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;
  transition:box-shadow .3s,transform .2s
}
.fmenu-btn:hover{
  transform:scale(1.1);
  box-shadow:0 0 0 2px #c9a84c,0 0 40px rgba(160,90,255,1),0 0 80px rgba(120,60,220,.7),0 4px 24px rgba(0,0,0,.8)
}
/* 回転リング */
.fmenu-ring{
  position:absolute;inset:-5px;border-radius:50%;
  border:2px solid transparent;
  border-top-color:#c9a84c;border-right-color:#9b72ef;
  animation:fmenu-spin 4s linear infinite
}
.fmenu-ring2{
  position:absolute;inset:-10px;border-radius:50%;
  border:1px dashed rgba(201,168,76,.35);
  animation:fmenu-spin 10s linear infinite reverse
}
@keyframes fmenu-spin{to{transform:rotate(360deg)}}
/* パルス */
.fmenu-btn::after{
  content:'';position:absolute;inset:-3px;border-radius:50%;
  border:2px solid rgba(201,168,76,.6);
  animation:fmenu-pulse 2s ease-in-out infinite
}
@keyframes fmenu-pulse{
  0%,100%{transform:scale(1);opacity:.7}
  50%{transform:scale(1.25);opacity:0}
}
/* オーラ */
.fmenu-btn::before{
  content:'';position:absolute;inset:-12px;border-radius:50%;
  background:radial-gradient(circle,rgba(130,60,240,.45) 0%,rgba(201,168,76,.15) 50%,transparent 70%);
  animation:fmenu-aura 3s ease-in-out infinite
}
@keyframes fmenu-aura{
  0%,100%{transform:scale(.85);opacity:.5}
  50%{transform:scale(1.35);opacity:1}
}
.fmenu-btn-label{font-family:'DM Mono',monospace;font-size:.5rem;letter-spacing:.18em;color:#e8d48a;line-height:1;text-shadow:0 0 8px rgba(201,168,76,.8)}
.fmenu-btn-lines{display:flex;flex-direction:column;gap:3px}
.fmenu-btn-line{width:20px;height:1.5px;background:linear-gradient(90deg,#c9a84c,#b87fff);border-radius:1px;box-shadow:0 0 4px rgba(201,168,76,.6)}
</style>

<!-- ドロワー本体 -->
<div class="fmenu-overlay" id="fmenuOverlay"></div>
<div class="fmenu-drawer" id="fmenuDrawer">
  <div class="fmenu-head">
    <span class="fmenu-head-title">✦ Fortune Menu ✦</span>
    <button class="fmenu-close-btn" id="fmenuClose">✕</button>
  </div>
  <nav class="fmenu-nav">
    <?php
    echo '<div class="fmenu-section-label">占い一覧</div>';
    foreach($_NAV_PAGES as $key => $pg):
      $isCurrent = ($key === $_slug);
      $cls = $isCurrent ? 'fmenu-item current' : 'fmenu-item';
      if ($isCurrent):
    ?>
    <span class="<?= $cls ?>"><span class="fmenu-item-icon"><?= $pg['icon'] ?></span><?= $pg['name'] ?></span>
    <?php else: ?>
    <a href="<?= $pg['url'] ?>" class="<?= $cls ?>"><span class="fmenu-item-icon"><?= $pg['icon'] ?></span><?= $pg['name'] ?></a>
    <?php endif; endforeach; ?>
    <div class="fmenu-section-label" style="margin-top:.5rem">サイト情報</div>
    <a href="/privacy"    class="fmenu-item <?= $_p==='privacy'?'current':'' ?>"><span class="fmenu-item-icon">📜</span>プライバシーポリシー</a>
    <a href="/disclaimer" class="fmenu-item <?= $_p==='disclaimer'?'current':'' ?>"><span class="fmenu-item-icon">⚠️</span>免責事項</a>
    <a href="/profile"    class="fmenu-item <?= $_p==='profile'?'current':'' ?>"><span class="fmenu-item-icon">👤</span>運営者情報</a>
    <a href="/contact"    class="fmenu-item <?= $_p==='contact'?'current':'' ?>"><span class="fmenu-item-icon">✉️</span>お問い合わせ</a>
  </nav>
</div>

<!-- フローティングボタン -->
<button class="fmenu-btn" id="fmenuBtn" aria-label="メニューを開く">
  <span class="fmenu-ring"></span>
  <span class="fmenu-ring2"></span>
  <div class="fmenu-btn-lines">
    <span class="fmenu-btn-line"></span>
    <span class="fmenu-btn-line"></span>
    <span class="fmenu-btn-line"></span>
  </div>
  <span class="fmenu-btn-label">MENU</span>
</button>

<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    var sd=document.getElementById('spDropdown');
    if(sd)sd.classList.remove('open');
  }
});

// リザルト表示＆スクロール（リザルトがある全ページで使用）
function scrollToResult(id){
  var el=document.getElementById(id);
  if(!el)return;
  el.style.display='block';
  setTimeout(function(){el.scrollIntoView({behavior:'smooth',block:'start'});},80);
}

// シェアボタン
function openShare(type){
  var u=encodeURIComponent(location.href);
  var t=encodeURIComponent(document.title);
  var urls={line:'https://social-plugins.line.me/lineit/share?url='+u,x:'https://twitter.com/intent/tweet?url='+u+'&text='+t,fb:'https://www.facebook.com/sharer/sharer.php?u='+u};
  window.open(urls[type],'_blank','noopener,noreferrer,width=600,height=400');
}
function copyShareUrl(){
  navigator.clipboard.writeText(location.href).then(function(){
    var b=document.querySelector('.share-copy');if(!b)return;
    var orig=b.textContent;b.textContent='✓ コピーしました！';setTimeout(function(){b.textContent=orig;},2000);
  });
}

// フローティングメニュー
(function(){
  var btn=document.getElementById('fmenuBtn');
  var drawer=document.getElementById('fmenuDrawer');
  var overlay=document.getElementById('fmenuOverlay');
  var closeBtn=document.getElementById('fmenuClose');
  function open(){drawer.classList.add('open');overlay.classList.add('open');document.body.style.overflow='hidden';}
  function close(){drawer.classList.remove('open');overlay.classList.remove('open');document.body.style.overflow='';}
  btn.addEventListener('click',function(){drawer.classList.contains('open')?close():open();});
  overlay.addEventListener('click',close);
  closeBtn.addEventListener('click',close);
  document.addEventListener('keydown',function(e){if(e.key==='Escape')close();});
})();
</script>
