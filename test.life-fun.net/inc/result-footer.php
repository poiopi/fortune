<?php
/**
 * Result Footer — 結果ページ共通導線
 *
 * ※ シェアボタンは各ページの実装に委ねる（share-btnsはここに含めない）
 *   呼び出し前にシェアボタンを出力し、その直後にこのファイルをrequireする。
 *
 * 呼び出し側で事前に以下の変数をセットしてから require すること：
 *
 *   $articleIcon  string       アイコン絵文字                    例: '📖'
 *   $articleTitle string       リンクタイトル                    例: 'タロット占いとは？'
 *   $articleDesc  string       サブテキスト                      例: '22枚の大アルカナの意味を解説'
 *   $contextKey   string       nav-cards除外キー・記事URL参照キー  例: 'tarot'
 *   $retryLabel   string       ボタンラベル                      例: 'もう一度占う'
 *   $retryType    string       'js' または 'link'
 *   $retryValue   string       JS関数名 or URL                   例: 'resetAll()' / '/tarot'
 *
 * $articleUrl は呼び出し側でセットしない。nav-cards.php の $_NAV_PAGES[$contextKey]['article']
 * から自動導出する（URLの管理元を nav-cards.php に一本化するため）。
 */
require_once __DIR__.'/nav-cards.php';
$articleUrl = null;
if (isset($contextKey, $_NAV_PAGES[$contextKey]['article'])) {
  $articleUrl = $_NAV_PAGES[$contextKey]['article'];
}
$articleTypeMap = null;
if (isset($contextKey, $_RESULT_TYPE_ARTICLES[$contextKey])) {
  $articleTypeMap = $_RESULT_TYPE_ARTICLES[$contextKey];
}
?>
<style>
.rf-article-link{display:flex;align-items:center;gap:.9rem;background:rgba(124,77,206,.06);border:1px solid rgba(124,77,206,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.rf-article-link:hover{border-color:#9b72ef;background:rgba(124,77,206,.12)}
.rf-article-icon{font-size:1.4rem;flex-shrink:0}
.rf-article-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.rf-article-body strong{font-family:var(--ff-sans);font-size:.9rem;font-weight:500;color:#9b72ef}
.rf-article-body small{font-size:.75rem;color:var(--muted,#6b6b8a)}
.rf-article-arrow{color:#9b72ef;font-family:var(--ff-mono,monospace);font-size:.9rem;flex-shrink:0}
.rf-retry-btn{display:block;width:100%;padding:.9rem;background:#7c4dce;color:#fff;border:none;border-radius:10px;font-family:var(--ff-sans,sans-serif);font-size:.9rem;font-weight:500;cursor:pointer;text-align:center;text-decoration:none;margin-top:1.5rem;transition:background .2s;letter-spacing:.04em}
.rf-retry-btn:hover{background:#6a3fc2}
</style>

<?php if ($articleUrl !== null): ?>
<a href="<?= htmlspecialchars($articleUrl) ?>" id="rfArticleLink" class="rf-article-link">
  <span class="rf-article-icon"><?= $articleIcon ?></span>
  <span class="rf-article-body">
    <strong><?= htmlspecialchars($articleTitle) ?></strong>
    <small><?= htmlspecialchars($articleDesc) ?></small>
  </span>
  <span class="rf-article-arrow">→</span>
</a>
<?php endif; ?>

<?php if ($articleTypeMap !== null): ?>
<script type="application/json" id="rf-type-map"><?= json_encode($articleTypeMap, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?></script>
<script>
window.rfUpdateArticleLink = function(typeKey, title, desc){
  var mapEl = document.getElementById('rf-type-map');
  if(!mapEl) return;
  try{
    var map = JSON.parse(mapEl.textContent);
    var url = map[typeKey];
    if(!url) return;
    var a = document.getElementById('rfArticleLink');
    if(!a) return;
    a.setAttribute('href', url);
    var strongEl = a.querySelector('strong');
    var smallEl = a.querySelector('small');
    if(strongEl && title) strongEl.textContent = title;
    if(smallEl && desc) smallEl.textContent = desc;
  }catch(e){}
};
</script>
<?php endif; ?>

<div class="nav-cards-section" style="padding:2rem 0 0">
  <h3>✦ 次はこれを試してみては？ ✦</h3>
  <?php echo _nav_cards(3, $contextKey); ?>
</div>

<?php if ($retryType === 'js'): ?>
<button class="rf-retry-btn" onclick="<?= htmlspecialchars($retryValue) ?>" data-ga-event="retry_click"><?= htmlspecialchars($retryLabel) ?></button>
<?php else: ?>
<a href="<?= htmlspecialchars($retryValue) ?>" class="rf-retry-btn" data-ga-event="retry_click"><?= htmlspecialchars($retryLabel) ?></a>
<?php endif; ?>
