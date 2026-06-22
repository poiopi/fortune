<?php
$_p = $currentPage ?? '';
require_once __DIR__.'/nav-cards.php';
?>
<div class="nav-cards-section">
  <h3>✦ 他の占いも試してみる ✦</h3>
  <?= _nav_cards(9, $_p) ?>
</div>
<footer>
  <?= $_p==='top' ? '占いポータル トップ' : '<a href="/">占いポータル トップ</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='tarot' ? 'タロット占い' : '<a href="/tarot">タロット占い</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='calendar' ? '開運カレンダー' : '<a href="/calendar">開運カレンダー</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='mbti' ? 'MBTI×星座診断' : '<a href="/mbti">MBTI×星座診断</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='numerology' ? '数秘術診断' : '<a href="/numerology">数秘術診断</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='kyusei' ? '九星気学診断' : '<a href="/kyusei">九星気学診断</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='rpg' ? 'RPG占い' : '<a href="/rpg">RPG占い</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='aisho' ? '相性診断' : '<a href="/aisho">相性診断</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='zense' ? '前世診断' : '<a href="/zense">前世診断</a>' ?> &nbsp;/&nbsp;
  <?= $_p==='guardian' ? '守護霊診断' : '<a href="/guardian">守護霊診断</a>' ?> &nbsp;/&nbsp;
  <a href="/privacy">プライバシーポリシー</a> &nbsp;/&nbsp;
  <a href="/profile">運営者情報</a> &nbsp;/&nbsp;
  <a href="/contact">お問い合わせ</a><br>
  &copy; <?= date('Y') ?> 三星統合鑑定
</footer>
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
  width:58px;height:58px;border-radius:50%;border:none;
  background:radial-gradient(circle at 35% 35%,#2a1a5e,#0f0b1e);
  cursor:pointer;
  box-shadow:0 0 0 1px rgba(155,114,239,.5),0 0 20px rgba(90,50,180,.6),0 4px 20px rgba(0,0,0,.5);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;
  transition:box-shadow .3s,transform .2s
}
.fmenu-btn:hover{
  transform:scale(1.08);
  box-shadow:0 0 0 1px rgba(155,114,239,.8),0 0 30px rgba(120,70,220,.8),0 4px 24px rgba(0,0,0,.6)
}
/* 回転リング */
.fmenu-ring{
  position:absolute;inset:-4px;border-radius:50%;
  border:1px solid rgba(155,114,239,.4);
  border-top-color:#9b72ef;border-right-color:#c9a84c;
  animation:fmenu-spin 6s linear infinite
}
.fmenu-ring2{
  position:absolute;inset:-8px;border-radius:50%;
  border:1px dashed rgba(155,114,239,.18);
  animation:fmenu-spin 12s linear infinite reverse
}
@keyframes fmenu-spin{to{transform:rotate(360deg)}}
/* パルス */
.fmenu-btn::after{
  content:'';position:absolute;inset:-2px;border-radius:50%;
  border:1px solid rgba(155,114,239,.35);
  animation:fmenu-pulse 2.4s ease-in-out infinite
}
@keyframes fmenu-pulse{
  0%,100%{transform:scale(1);opacity:.5}
  50%{transform:scale(1.18);opacity:0}
}
.fmenu-btn-label{font-family:'DM Mono',monospace;font-size:.48rem;letter-spacing:.18em;color:#9b72ef;line-height:1}
.fmenu-btn-lines{display:flex;flex-direction:column;gap:3px}
.fmenu-btn-line{width:18px;height:1px;background:linear-gradient(90deg,#9b72ef,#c9a84c);border-radius:1px}
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
    $fmenu_pages = [
      'top'        => ['icon'=>'🏠', 'name'=>'トップ',              'url'=>'/'],
      'tarot'      => ['icon'=>'🃏', 'name'=>'タロット占い',        'url'=>'/tarot'],
      'calendar'   => ['icon'=>'📅', 'name'=>'開運カレンダー',      'url'=>'/calendar'],
      'mbti'       => ['icon'=>'🧠', 'name'=>'MBTI×星座診断',      'url'=>'/mbti'],
      'numerology' => ['icon'=>'🔢', 'name'=>'数秘術診断',          'url'=>'/numerology'],
      'kyusei'     => ['icon'=>'⭐', 'name'=>'九星気学診断',        'url'=>'/kyusei'],
      'rpg'        => ['icon'=>'⚔️', 'name'=>'RPG占い',             'url'=>'/rpg'],
      'aisho'      => ['icon'=>'💑', 'name'=>'相性診断',            'url'=>'/aisho'],
      'zense'      => ['icon'=>'🌀', 'name'=>'前世診断',            'url'=>'/zense'],
      'guardian'   => ['icon'=>'👻', 'name'=>'守護霊診断',          'url'=>'/guardian'],
    ];
    echo '<div class="fmenu-section-label">占い一覧</div>';
    foreach($fmenu_pages as $key=>$pg):
      $cls = ($key===$_p) ? 'fmenu-item current' : 'fmenu-item';
      if($key===$_p):
    ?>
    <span class="<?= $cls ?>"><span class="fmenu-item-icon"><?= $pg['icon'] ?></span><?= $pg['name'] ?></span>
    <?php else: ?>
    <a href="<?= $pg['url'] ?>" class="<?= $cls ?>"><span class="fmenu-item-icon"><?= $pg['icon'] ?></span><?= $pg['name'] ?></a>
    <?php endif; endforeach; ?>
    <div class="fmenu-section-label" style="margin-top:.5rem">サイト情報</div>
    <a href="/privacy"  class="fmenu-item <?= $_p==='privacy'?'current':'' ?>"><span class="fmenu-item-icon">📜</span>プライバシーポリシー</a>
    <a href="/profile"  class="fmenu-item <?= $_p==='profile'?'current':'' ?>"><span class="fmenu-item-icon">👤</span>運営者情報</a>
    <a href="/contact"  class="fmenu-item <?= $_p==='contact'?'current':'' ?>"><span class="fmenu-item-icon">✉️</span>お問い合わせ</a>
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
