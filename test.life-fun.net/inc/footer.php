<?php $_p = $currentPage ?? ''; ?>
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
  &copy; <?= date('Y') ?> life-fun.net
</footer>
<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});
</script>
