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
    /* ── HEADER（共通、値は各ページ実測の標準値に合わせている。tarot.phpのみ独自スキームのため対象外）
       セレクタは要素セレクタ header{} ではなく .site-header{} を使用する。
       sansei.phpにはHero部分にも<header class="hero">という別の<header>要素があり、
       bare header{}にすると意図せずHero側にも sticky/背景色 が適用されてしまうため。 ── */
    .site-header{
      border-bottom:1px solid var(--border);padding:0 1.2rem;
      position:sticky;top:0;z-index:100;
      background:rgba(8,6,15,.9);backdrop-filter:blur(12px);
    }
    .header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
    .logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
    .logo em{font-style:italic;color:var(--gold)}
    .header-nav{display:flex;gap:1.5rem}
    .header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
    .header-nav a:hover{color:var(--gold-lt)}
    .sp-menu-btn{display:none}
    .sp-dropdown{display:none}
    @media(max-width:768px){
      .header-nav{display:none}
      .sp-menu-btn{
        display:flex;align-items:center;gap:.4rem;
        font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;
        color:var(--muted);background:none;
        border:1px solid var(--border);border-radius:6px;
        padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s;
      }
      .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
      .sp-dropdown{
        display:none;position:absolute;top:54px;right:1.2rem;
        background:rgba(8,6,15,.97);border:1px solid var(--border2);
        border-radius:12px;overflow:hidden;z-index:200;min-width:180px;
        backdrop-filter:blur(16px);
      }
      .sp-dropdown.open{display:block}
      .sp-dropdown a{
        display:block;padding:.85rem 1.25rem;
        font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
        color:var(--muted);text-decoration:none;
        border-bottom:1px solid var(--border);transition:color .2s,background .2s;
      }
      .sp-dropdown a:last-child{border-bottom:none}
      .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
      .sp-dropdown span{
        display:block;padding:.85rem 1.25rem;
        font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
        color:var(--text);border-bottom:1px solid var(--border);
      }
      .sp-dropdown span:last-child{border-bottom:none}
    }
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
      <?= _navlink('開運カレンダー',   '/calendar',   'calendar',   $_p) ?>
      <?= _navlink('MBTI×星座診断',   '/mbti',       'mbti',       $_p) ?>
      <?= _navlink('数秘術診断',       '/numerology', 'numerology', $_p) ?>
      <?= _navlink('九星気学診断',     '/kyusei',     'kyusei',     $_p) ?>
      <?= _navlink('RPG風占い',          '/rpg',        'rpg',        $_p) ?>
      <?= _navlink('相性診断',         '/aisho',      'aisho',      $_p) ?>
      <?= _navlink('前世診断',         '/zense',      'zense',      $_p) ?>
      <?= _navlink('守護霊診断',       '/guardian',   'guardian',   $_p) ?>
      <?= _navlink('姓名判断',         '/seimei',     'seimei',     $_p) ?>
      <?= _navlink('芸名診断',         '/geimei',     'geimei',     $_p) ?>
    </div>
  </div>
</header>
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
