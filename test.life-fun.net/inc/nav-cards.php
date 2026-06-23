<?php
// ページデータ
$_NAV_PAGES = [
  'tarot'      => ['name'=>'タロット占い',   'url'=>'/tarot',      'desc'=>'22枚のカードが運命を映し出す',     'icon'=>'🃏'],
  'calendar'   => ['name'=>'開運カレンダー', 'url'=>'/calendar',   'desc'=>'今日・今月の運勢と開運アドバイス', 'icon'=>'📅'],
  'mbti'       => ['name'=>'MBTI×星座診断', 'url'=>'/mbti',       'desc'=>'16タイプ×12星座で性格を深掘り',   'icon'=>'🧠'],
  'numerology' => ['name'=>'数秘術診断',     'url'=>'/numerology', 'desc'=>'生年月日が導く魂の数字の意味',     'icon'=>'🔢'],
  'kyusei'     => ['name'=>'九星気学診断',   'url'=>'/kyusei',     'desc'=>'本命星で読み解く運命と相性',       'icon'=>'⭐'],
  'rpg'        => ['name'=>'RPG占い',        'url'=>'/rpg',        'desc'=>'あなたの職業と運命を冒険で解く',   'icon'=>'⚔️'],
  'aisho'      => ['name'=>'相性診断',       'url'=>'/aisho',      'desc'=>'二人の星座と数秘から相性を鑑定',   'icon'=>'💑'],
  'zense'      => ['name'=>'前世診断',       'url'=>'/zense',      'desc'=>'何回目の転生？魂のカルテを解読',   'icon'=>'🌀'],
  'guardian'   => ['name'=>'守護霊診断',     'url'=>'/guardian',   'desc'=>'あなたを守る霊のレアリティは？',   'icon'=>'👻'],
  'seimei'     => ['name'=>'姓名判断',       'url'=>'/seimei',     'desc'=>'名前に宿る運命を五格で鑑定する',     'icon'=>'✍️'],
];

// $count枚カードを出力（$excludeは現在ページキー）
function _nav_cards(int $count, string $exclude = ''): string {
  global $_NAV_PAGES;
  $pool = $_NAV_PAGES;
  if ($exclude && isset($pool[$exclude])) unset($pool[$exclude]);
  $keys = array_keys($pool);
  shuffle($keys);
  $keys = array_slice($keys, 0, $count);
  $html = '<div class="nav-cards">';
  foreach ($keys as $k) {
    $p = $pool[$k];
    $html .= '<a href="'.$p['url'].'" class="nav-card">'
           . '<span class="nav-card-icon">'.$p['icon'].'</span>'
           . '<span class="nav-card-name">'.$p['name'].'</span>'
           . '<span class="nav-card-desc">'.$p['desc'].'</span>'
           . '</a>';
  }
  $html .= '</div>';
  return $html;
}
?>
<style>
.nav-cards-section{padding:2.5rem 1.2rem 1rem;max-width:900px;margin:0 auto}
.nav-cards-section h3{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:1rem;text-align:center}
.nav-cards{display:flex;gap:.75rem;overflow-x:auto;padding-bottom:.5rem;scrollbar-width:thin;scrollbar-color:var(--border2) transparent}
.nav-cards::-webkit-scrollbar{height:4px}
.nav-cards::-webkit-scrollbar-track{background:transparent}
.nav-cards::-webkit-scrollbar-thumb{background:var(--border2);border-radius:2px}
.nav-card{flex:0 0 140px;display:flex;flex-direction:column;align-items:center;gap:.4rem;padding:1rem .75rem;background:var(--card);border:1px solid var(--border);border-radius:12px;text-decoration:none;transition:border-color .2s,background .2s;text-align:center}
.nav-card:hover{border-color:var(--violet);background:var(--card2)}
.nav-card-icon{font-size:1.6rem;line-height:1}
.nav-card-name{font-family:var(--ff-serif);font-size:.78rem;font-weight:600;color:var(--text);letter-spacing:.04em}
.nav-card-desc{font-family:var(--ff-sans);font-size:.62rem;color:var(--muted);line-height:1.5}
</style>
