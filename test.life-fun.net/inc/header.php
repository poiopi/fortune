<?php
// $currentPage をセットしてからrequireすること
// 値: top / tarot / calendar / mbti / numerology / kyusei / rpg / aisho / zense / guardian / privacy / profile / contact
$_p = $currentPage ?? '';
function _navlink(string $label, string $href, string $key, string $current): string {
    return $current === $key
        ? "<span>{$label}</span>"
        : "<a href=\"{$href}\">{$label}</a>";
}
?>
<header class="site-header">
  <div class="header-inner">
    <a href="/" class="logo">占い<em>Portal</em></a>
    <nav class="header-nav">
      <?= $_p==='top' ? '<span class="header-top-link current">✦ TOP</span>' : '<a href="/" class="header-top-link">✦ TOPへ戻る</a>' ?>
    </nav>
    <style>
    .header-top-link{
      display:inline-flex;align-items:center;padding:.3rem .9rem;
      border:1px solid rgba(201,168,76,.45);border-radius:20px;
      font-family:'DM Mono',monospace;font-size:.7rem;letter-spacing:.12em;
      color:#c9a84c;text-decoration:none;white-space:nowrap;
      transition:border-color .2s,color .2s,box-shadow .2s
    }
    .header-top-link:hover{border-color:#c9a84c;color:#e8d48a;box-shadow:0 0 10px rgba(201,168,76,.3)}
    .header-top-link.current{opacity:.45;cursor:default;pointer-events:none}
    </style>
    <div id="google_translate_element"></div>
    <button class="sp-menu-btn" onclick="toggleSpMenu()">☰ メニュー</button>
    <div class="sp-dropdown" id="spDropdown">
      <?= _navlink('トップ',           '/',           'top',        $_p) ?>
      <?= _navlink('タロット',         '/tarot',      'tarot',      $_p) ?>
      <?= _navlink('四柱推命',         '/shichu',     'shichu',     $_p) ?>
      <?= _navlink('芸名診断',         '/geimei',     'geimei',     $_p) ?>
      <?= _navlink('開運カレンダー',   '/calendar',   'calendar',   $_p) ?>
      <?= _navlink('MBTI×星座診断',   '/mbti',       'mbti',       $_p) ?>
      <?= _navlink('数秘術診断',       '/numerology', 'numerology', $_p) ?>
      <?= _navlink('九星気学診断',     '/kyusei',     'kyusei',     $_p) ?>
      <?= _navlink('RPG占い',          '/rpg',        'rpg',        $_p) ?>
      <?= _navlink('相性診断',         '/aisho',      'aisho',      $_p) ?>
      <?= _navlink('前世診断',         '/zense',      'zense',      $_p) ?>
      <?= _navlink('守護霊診断',       '/guardian',   'guardian',   $_p) ?>
    </div>
  </div>
</header>
