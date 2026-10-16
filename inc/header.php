<?php
/* ══════════════════════════════════════════
   サイトヘッダー（共通部品）
   ・1部品・2テーマ（dark＝占いツール／トップ、light＝解説記事）
   ・サイト名・ロゴ画像のパスは inc/site.php で一元管理
   ・CSS/JSもこのファイル内で完結させる（ページ側のCSS変数に依存しない）

   変数（requireの前にセットする）：
     $currentPage  任意  現在ページのキー。該当するナビ項目を「現在地」表示にする
                         PCナビ：top / tarot / shichu / kyusei
                         SPメニュー：top / sansei / tarot / shichu / sanmei / seiza / mbti / numerology /
                                     kyusei / calendar / rpg / aisho / zense / guardian / seimei / geimei
                         上記以外（privacy / profile / contact / disclaimer / love / reversi 等）や
                         未設定でも可（現在地表示なしになるだけ）
     $headerTheme  任意  'dark'（省略時）または 'light'
     $headerAction 任意  ['label' => 'ボタン文言', 'url' => '/path']。light テーマの右ボタン
                         （文言に絵文字・「→」は入れない。矢印は部品側でSVGを付ける）
                         任意キー 'dir' => 'forward'（省略時。文言の後ろに右向き矢印）
                                         または 'back'（文言の前に左向き矢印。「TOPへ戻る」等の戻る導線）

   使用例（ツール）：
     <?php $currentPage = 'tarot'; require __DIR__.'/inc/header.php'; ?>
   使用例（記事）：
     <?php $headerTheme = 'light'; $headerAction = ['label' => 'タロットを占う', 'url' => '/tarot']; require __DIR__.'/../../../inc/header.php'; ?>

   CSSの詳細度について（COMPONENTS.md参照）：
     .site-header{position/top/z-index} だけは単一クラスで書く。tarot.php の
     header.site-header{z-index:200}（独自スキーム）が勝ち続けるようにするため。
     それ以外の見た目は2クラス以上で書き、各ページに残る旧ヘッダーCSS
     （.site-header / .sp-menu-btn / .sp-dropdown 等）に勝つようにしている。
   JS互換：.site-header / .sp-menu-btn / .sp-dropdown / id="spDropdown" / toggleSpMenu() は
     各ページに残る「外側クリックで閉じる」処理との互換のため名前を維持している。
══════════════════════════════════════════ */
require_once __DIR__.'/site.php';
$_p = $currentPage ?? '';
$_hTheme = (($headerTheme ?? 'dark') === 'light') ? 'light' : 'dark';
$_hAction = (isset($headerAction) && is_array($headerAction) && isset($headerAction['label'], $headerAction['url'])) ? $headerAction : null;
$_hBack = ($_hAction !== null && ($_hAction['dir'] ?? 'forward') === 'back');
if (!function_exists('_navlink')) {
    function _navlink(string $label, string $href, string $key, string $current): string {
        return $current === $key
            ? "<span>{$label}</span>"
            : "<a href=\"{$href}\">{$label}</a>";
    }
}
if (!function_exists('_site_nav_link')) {
    function _site_nav_link(string $label, string $href, string $key, string $current): string {
        return $current === $key
            ? "<a href=\"{$href}\" class=\"cur\" aria-current=\"page\">{$label}</a>"
            : "<a href=\"{$href}\">{$label}</a>";
    }
}
?>
<style>
/* ── SITE HEADER（共通部品 inc/header.php） ── */
.site-header{position:sticky;top:0;z-index:100}
.site-header.site-header--dark{
  display:block;margin:0;padding:0;border:0;border-radius:0;min-width:0;overflow:visible;
  background:rgba(6,4,16,.94);-webkit-backdrop-filter:blur(14px);backdrop-filter:blur(14px);
  font-weight:300;line-height:1.8;
}
.site-header.site-header--light{
  display:block;margin:0;padding:0;border:0;border-radius:0;min-width:0;overflow:visible;
  background:#fff;-webkit-backdrop-filter:none;backdrop-filter:none;
}
.site-header .site-header__inner{
  box-sizing:border-box;max-width:960px;margin:0 auto;padding:0 1.4rem;height:56px;
  display:flex;align-items:center;justify-content:space-between;gap:1rem;
}
.site-header .site-logo{
  display:flex;align-items:center;gap:.5rem;text-decoration:none;line-height:0;flex-shrink:0;
  margin:0;padding:0;border:0;background:none;
}
.site-header .site-logo__mark:empty{display:none}
.site-header .site-logo__type{display:block;height:32px;width:auto;max-width:none;margin:0;padding:0;border:0}
.site-header--dark .site-logo:focus-visible{outline:2px solid #c9a84c;outline-offset:2px}
.site-header--light .site-logo:focus-visible{outline:2px solid #8b6d1f;outline-offset:2px}
@media(max-width:600px){
  .site-header .site-logo__type{height:28px}
}

/* dark：PCナビ（現行トップと同じ値） */
.site-header--dark .site-nav{
  display:flex;align-items:center;gap:1.6rem;position:static;
  margin:0;padding:0;border:0;background:none;
}
.site-header--dark .site-nav a{
  position:relative;display:inline;margin:0;padding:0 0 2px;border:0;background:none;
  font-family:'DM Mono',monospace;font-size:.68rem;font-style:normal;
  color:#8a7db5;text-decoration:none;letter-spacing:.1em;white-space:nowrap;
  transition:color .2s;
}
.site-header--dark .site-nav a::after{
  content:'';position:absolute;bottom:0;left:0;right:0;height:1px;background:#c9a84c;
  transform:scaleX(0);transition:transform .2s;
}
.site-header--dark .site-nav a:hover{color:#e8d48a}
.site-header--dark .site-nav a:hover::after,
.site-header--dark .site-nav a.cur::after{transform:scaleX(1)}
.site-header--dark .site-nav a.cur{color:#c9a84c;pointer-events:none}
.site-header--dark .site-nav a:focus-visible{outline:2px solid #c9a84c;outline-offset:2px}
.site-header--dark .site-header__line{
  display:block;height:2px;margin:0;padding:0;border:0;
  background:linear-gradient(90deg,transparent 0%,rgba(201,168,76,.6) 30%,rgba(201,168,76,1) 50%,rgba(201,168,76,.6) 70%,transparent 100%);
}

/* dark：スマホメニュー（画面幅いっぱいの帯。ヘッダーがbackdrop-filterを持つためfixedではなくabsolute） */
.site-header--dark .sp-menu-btn{
  display:none;align-items:center;gap:.35rem;position:static;margin:0;
  background:none;border:1px solid rgba(160,130,220,.32);border-radius:6px;
  color:#8a7db5;font-family:'DM Mono',monospace;font-size:.72rem;font-style:normal;
  letter-spacing:.08em;padding:.3rem .75rem;cursor:pointer;transition:color .2s,border-color .2s;
}
.site-header--dark .sp-menu-btn:focus-visible{outline:2px solid #c9a84c;outline-offset:2px}
.site-header .sp-dropdown{
  display:none;position:absolute;top:100%;left:0;right:0;bottom:auto;
  margin:0;padding:0;background:rgba(6,4,16,.97);
  border:0;border-bottom:1px solid rgba(160,130,220,.32);border-radius:0;
  min-width:0;overflow:visible;overflow-y:auto;max-height:calc(100vh - 58px);
  z-index:200;-webkit-backdrop-filter:blur(16px);backdrop-filter:blur(16px);
}
.site-header .sp-dropdown.open{display:block}
.site-header .sp-dropdown a,
.site-header .sp-dropdown span{
  display:block;margin:0;padding:.85rem 1.4rem;background:none;
  font-family:'DM Mono',monospace;font-size:.78rem;font-style:normal;letter-spacing:normal;
  color:#8a7db5;text-decoration:none;
  border:0;border-bottom:1px solid rgba(160,130,220,.15);
  transition:color .2s,background .2s;
}
.site-header .sp-dropdown span{color:#e8e2f5}
.site-header .sp-dropdown a:hover{color:#e8d48a;background:rgba(201,168,76,.05)}
.site-header .sp-dropdown a:focus-visible{outline:2px solid #c9a84c;outline-offset:-2px}
@media(max-width:768px){
  .site-header--dark .site-nav{display:none}
  .site-header--dark .sp-menu-btn{display:flex}
}

/* light：記事（ロゴ＋文脈ボタンのみ） */
.site-header--light .site-header__line{
  display:block;height:1px;margin:0;padding:0;border:0;
  background:linear-gradient(90deg,rgba(139,109,31,.15) 0%,rgba(139,109,31,.55) 50%,rgba(139,109,31,.15) 100%);
}
.site-header--light .site-header__action{
  display:inline-flex;align-items:center;gap:.4rem;margin:0;
  font-family:'DM Mono',monospace;font-size:.7rem;font-style:normal;letter-spacing:.04em;
  color:#6b6b8a;text-decoration:none;background:none;
  border:1px solid rgba(139,109,31,.45);border-radius:20px;padding:.3rem .9rem;
  white-space:nowrap;transition:border-color .2s,color .2s;
}
.site-header--light .site-header__action:hover{color:#8b6d1f;border-color:#8b6d1f}
.site-header--light .site-header__action:focus-visible{outline:2px solid #8b6d1f;outline-offset:2px}
</style>
<header class="site-header site-header--<?= $_hTheme ?>">
  <div class="site-header__inner">
    <a href="/" class="site-logo"><span class="site-logo__mark"></span><img class="site-logo__type" src="<?= $_hTheme === 'light' ? LOGO_LIGHT : LOGO_DARK ?>" alt="<?= htmlspecialchars(SITE_NAME, ENT_QUOTES) ?>" width="<?= LOGO_W ?>" height="<?= LOGO_H ?>"></a>
<?php if ($_hTheme === 'dark'): ?>
    <nav class="site-nav" aria-label="メインメニュー">
      <?= _site_nav_link('✦ TOP',   '/',       'top',    $_p) ?>
      <?= _site_nav_link('タロット', '/tarot',  'tarot',  $_p) ?>
      <?= _site_nav_link('四柱推命', '/shichu', 'shichu', $_p) ?>
      <?= _site_nav_link('九星気学', '/kyusei', 'kyusei', $_p) ?>
      <a href="/articles/">解説ガイド</a>
    </nav>
    <div id="google_translate_element"></div>
    <button class="sp-menu-btn" type="button" onclick="toggleSpMenu()" aria-controls="spDropdown">☰ メニュー</button>
<?php elseif ($_hAction !== null && $_hBack): ?>
    <a class="site-header__action" href="<?= htmlspecialchars((string)$_hAction['url'], ENT_QUOTES) ?>"><svg class="site-header__arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" aria-hidden="true" focusable="false"><line x1="10" y1="6" x2="2" y2="6"/><line x1="5" y1="3" x2="2" y2="6"/><line x1="5" y1="9" x2="2" y2="6"/></svg><?= htmlspecialchars((string)$_hAction['label'], ENT_QUOTES) ?></a>
<?php elseif ($_hAction !== null): ?>
    <a class="site-header__action" href="<?= htmlspecialchars((string)$_hAction['url'], ENT_QUOTES) ?>"><?= htmlspecialchars((string)$_hAction['label'], ENT_QUOTES) ?><svg class="site-header__arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" aria-hidden="true" focusable="false"><line x1="2" y1="6" x2="10" y2="6"/><line x1="7" y1="3" x2="10" y2="6"/><line x1="7" y1="9" x2="10" y2="6"/></svg></a>
<?php endif; ?>
  </div>
  <div class="site-header__line"></div>
<?php if ($_hTheme === 'dark'): ?>
  <div class="sp-dropdown" id="spDropdown">
    <?= _navlink('トップ',         '/',           'top',        $_p) ?>
    <?= _navlink('三星統合鑑定',   '/sansei',     'sansei',     $_p) ?>
    <?= _navlink('タロット占い',   '/tarot',      'tarot',      $_p) ?>
    <?= _navlink('四柱推命',       '/shichu',     'shichu',     $_p) ?>
    <?= _navlink('算命学',         '/sanmei',     'sanmei',     $_p) ?>
    <?= _navlink('西洋占星術',     '/seiza',      'seiza',      $_p) ?>
    <?= _navlink('MBTI×星座',      '/mbti',       'mbti',       $_p) ?>
    <?= _navlink('数秘術',         '/numerology', 'numerology', $_p) ?>
    <?= _navlink('九星気学',       '/kyusei',     'kyusei',     $_p) ?>
    <?= _navlink('開運カレンダー', '/calendar',   'calendar',   $_p) ?>
    <?= _navlink('RPG風占い',      '/rpg',        'rpg',        $_p) ?>
    <?= _navlink('相性診断',       '/aisho',      'aisho',      $_p) ?>
    <?= _navlink('前世診断',       '/zense',      'zense',      $_p) ?>
    <?= _navlink('守護霊診断',     '/guardian',   'guardian',   $_p) ?>
    <?= _navlink('姓名判断',       '/seimei',     'seimei',     $_p) ?>
    <?= _navlink('芸名診断',       '/geimei',     'geimei',     $_p) ?>
    <a href="/articles/">解説ガイド</a>
  </div>
<?php endif; ?>
</header>
<?php if ($_hTheme === 'dark'): ?>
<script>
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click', function(e){
  if(!e.target.closest('.sp-menu-btn') && !e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});
</script>
<?php endif; ?>
