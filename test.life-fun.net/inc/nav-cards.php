<?php
$_NAV_PAGES = [
  'sansei'     => ['name'=>'三星統合鑑定', 'url'=>'/sansei',    'article'=>null,                     'featured_score'=>100, 'icon'=>'✨', 'desc'=>'生年月日×星座×数秘の三位一体鑑定'],
  'tarot'      => ['name'=>'タロット占い',  'url'=>'/tarot',     'article'=>'/articles/tarot/',       'featured_score'=>95,  'icon'=>'🃏', 'desc'=>'22枚のカードが運命を映し出す'],
  'shichu'     => ['name'=>'四柱推命',      'url'=>'/shichu',    'article'=>'/articles/shichu/',      'featured_score'=>90,  'icon'=>'🔯', 'desc'=>'命式・十神・大運を本格算出する'],
  'mbti'       => ['name'=>'MBTI×星座診断','url'=>'/mbti',      'article'=>'/articles/mbti/',        'featured_score'=>80,  'icon'=>'🧠', 'desc'=>'16タイプ×12星座で性格を深掘り'],
  'love'       => ['name'=>'恋愛傾向診断',  'url'=>'/love',      'article'=>'/articles/love/',        'featured_score'=>70,  'icon'=>'💜', 'desc'=>'MBTI×血液型×星座で恋愛スタイルを診断'],
  'calendar'   => ['name'=>'開運カレンダー','url'=>'/calendar',  'article'=>null,                     'featured_score'=>80,  'icon'=>'📅', 'desc'=>'今日・今月の運勢と開運アドバイス'],
  'sanmei'     => ['name'=>'算命学鑑定',    'url'=>'/sanmei',    'article'=>'/articles/sanmei/',      'featured_score'=>75,  'icon'=>'☯️', 'desc'=>'元命・主星・従星で本質と才能を読む'],
  'seiza'      => ['name'=>'西洋占星術',    'url'=>'/seiza',     'article'=>'/articles/seiza/',       'featured_score'=>75,  'icon'=>'⭐', 'desc'=>'太陽星座×内面タイプで個性を深掘り'],
  'aisho'      => ['name'=>'相性診断',      'url'=>'/aisho',     'article'=>'/articles/aisho/',       'featured_score'=>65,  'icon'=>'💑', 'desc'=>'二人の星座と数秘から相性を鑑定'],
  'seimei'     => ['name'=>'姓名判断',      'url'=>'/seimei',    'article'=>'/articles/seimei/',      'featured_score'=>65,  'icon'=>'✍️', 'desc'=>'名前に宿る運命を五格で鑑定する'],
  'rpg'        => ['name'=>'RPG風占い',       'url'=>'/rpg',       'article'=>null,                     'featured_score'=>60,  'icon'=>'⚔️', 'desc'=>'あなたの職業と運命を冒険で解く'],
  'kyusei'     => ['name'=>'九星気学診断',  'url'=>'/kyusei',    'article'=>'/articles/kyusei/',      'featured_score'=>60,  'icon'=>'⭐', 'desc'=>'本命星で読み解く運命と相性'],
  'numerology' => ['name'=>'数秘術診断',    'url'=>'/numerology','article'=>'/articles/numerology/',  'featured_score'=>60,  'icon'=>'🔢', 'desc'=>'生年月日が導く魂の数字の意味'],
  'zense'      => ['name'=>'前世診断',      'url'=>'/zense',     'article'=>'/articles/zense/',       'featured_score'=>60,  'icon'=>'🌀', 'desc'=>'何回目の転生？魂のカルテを解読'],
  'guardian'   => ['name'=>'守護霊診断',    'url'=>'/guardian',  'article'=>'/articles/guardian/',    'featured_score'=>60,  'icon'=>'👻', 'desc'=>'あなたを守る霊のレアリティは？'],
  'geimei'     => ['name'=>'芸名診断',      'url'=>'/geimei',    'article'=>null,                     'featured_score'=>50,  'icon'=>'🎭', 'desc'=>'大喜利で見つける最強の芸名'],
  'reversi'    => ['name'=>'オセロ占い',    'url'=>'/reversi',   'article'=>null,                     'featured_score'=>55,  'icon'=>'🌗', 'desc'=>'対局しながら占う、今日の運勢ゲーム'],
];

// 診断結果の型ごとの解説記事URL（result-footer.php が type-aware 呼び出し時に参照）
// contextKey => [ typeKey => url ]。URLの管理元をここに一本化する（他ファイルではURLを組み立てない）。
// このキーが存在しない contextKey は従来通りカテゴリ単位の $articleUrl のみが使われる（後方互換）。
$_RESULT_TYPE_ARTICLES = [
  'guardian' => [
    'ryujin'        => '/articles/guardian/ryujin/',
    'hakko'         => '/articles/guardian/hakko/',
    'hoo'           => '/articles/guardian/hoo/',
    'buke-senzo'    => '/articles/guardian/buke-senzo/',
    'miko-senzo'    => '/articles/guardian/miko-senzo/',
    'onmyoji-senzo' => '/articles/guardian/onmyoji-senzo/',
    'sou-senzo'     => '/articles/guardian/sou-senzo/',
    'tenshi'        => '/articles/guardian/tenshi/',
    'daichi'        => '/articles/guardian/daichi/',
    'umi'           => '/articles/guardian/umi/',
    'hoshi'         => '/articles/guardian/hoshi/',
    'kaze'          => '/articles/guardian/kaze/',
    'honoo'         => '/articles/guardian/honoo/',
    'tsuki'         => '/articles/guardian/tsuki/',
    'taiyou'        => '/articles/guardian/taiyou/',
    'mori-kenja'    => '/articles/guardian/mori-kenja/',
    'iyashi'        => '/articles/guardian/iyashi/',
    'yami'          => '/articles/guardian/yami/',
    'dochaku-senzo' => '/articles/guardian/dochaku-senzo/',
  ],
  'mbti' => [
    'intj' => '/articles/mbti/intj/', 'intp' => '/articles/mbti/intp/',
    'entj' => '/articles/mbti/entj/', 'entp' => '/articles/mbti/entp/',
    'infj' => '/articles/mbti/infj/', 'infp' => '/articles/mbti/infp/',
    'enfj' => '/articles/mbti/enfj/', 'enfp' => '/articles/mbti/enfp/',
    'istj' => '/articles/mbti/istj/', 'isfj' => '/articles/mbti/isfj/',
    'estj' => '/articles/mbti/estj/', 'esfj' => '/articles/mbti/esfj/',
    'istp' => '/articles/mbti/istp/', 'isfp' => '/articles/mbti/isfp/',
    'estp' => '/articles/mbti/estp/', 'esfp' => '/articles/mbti/esfp/',
  ],
  'seiza' => [
    'CP' => '/articles/seiza/capricorn/',   'AQ' => '/articles/seiza/aquarius/',
    'PI' => '/articles/seiza/pisces/',      'AR' => '/articles/seiza/aries/',
    'TA' => '/articles/seiza/taurus/',      'GE' => '/articles/seiza/gemini/',
    'CA' => '/articles/seiza/cancer/',      'LE' => '/articles/seiza/leo/',
    'VI' => '/articles/seiza/virgo/',       'LI' => '/articles/seiza/libra/',
    'SC' => '/articles/seiza/scorpio/',     'SA' => '/articles/seiza/sagittarius/',
  ],
  'tarot' => [
    'fool' => '/articles/tarot/fool/',               'magician' => '/articles/tarot/magician/',
    'high-priestess' => '/articles/tarot/high-priestess/', 'empress' => '/articles/tarot/empress/',
    'emperor' => '/articles/tarot/emperor/',         'hierophant' => '/articles/tarot/hierophant/',
    'lovers' => '/articles/tarot/lovers/',           'chariot' => '/articles/tarot/chariot/',
    'strength' => '/articles/tarot/strength/',       'hermit' => '/articles/tarot/hermit/',
    'wheel' => '/articles/tarot/wheel/',             'justice' => '/articles/tarot/justice/',
    'hanged-man' => '/articles/tarot/hanged-man/',   'death' => '/articles/tarot/death/',
    'temperance' => '/articles/tarot/temperance/',   'devil' => '/articles/tarot/devil/',
    'tower' => '/articles/tarot/tower/',             'star' => '/articles/tarot/star/',
    'moon' => '/articles/tarot/moon/',               'sun' => '/articles/tarot/sun/',
    'judgement' => '/articles/tarot/judgement/',     'world' => '/articles/tarot/world/',
  ],
  'sanmei' => [
    'GM00' => '/articles/sanmei/kansaku/', 'GM01' => '/articles/sanmei/sekimon/',
    'GM02' => '/articles/sanmei/houkaku/', 'GM03' => '/articles/sanmei/chousho/',
    'GM04' => '/articles/sanmei/rokuson/', 'GM05' => '/articles/sanmei/shiroku/',
    'GM06' => '/articles/sanmei/shaki/',   'GM07' => '/articles/sanmei/kengyu/',
    'GM08' => '/articles/sanmei/ryuko/',   'GM09' => '/articles/sanmei/gyokudo/',
  ],
  'shichu' => [
    '甲' => '/articles/shichu/kinoe/',      '乙' => '/articles/shichu/kinoto/',
    '丙' => '/articles/shichu/hinoe/',      '丁' => '/articles/shichu/hinoto/',
    '戊' => '/articles/shichu/tsuchinoe/',  '己' => '/articles/shichu/tsuchinoto/',
    '庚' => '/articles/shichu/kanoe/',      '辛' => '/articles/shichu/kanoto/',
    '壬' => '/articles/shichu/mizunoe/',    '癸' => '/articles/shichu/mizunoto/',
  ],
  'kyusei' => [
    '1' => '/articles/kyusei/ippaku/',     '2' => '/articles/kyusei/nikoku/',
    '3' => '/articles/kyusei/sanpeki/',    '4' => '/articles/kyusei/shiryoku/',
    '5' => '/articles/kyusei/goko/',       '6' => '/articles/kyusei/roppaku/',
    '7' => '/articles/kyusei/shichiseki/', '8' => '/articles/kyusei/hakkudo/',
    '9' => '/articles/kyusei/kyushi/',
  ],
  'numerology' => [
    '1' => '/articles/numerology/1/', '2' => '/articles/numerology/2/',
    '3' => '/articles/numerology/3/', '4' => '/articles/numerology/4/',
    '5' => '/articles/numerology/5/', '6' => '/articles/numerology/6/',
    '7' => '/articles/numerology/7/', '8' => '/articles/numerology/8/',
    '9' => '/articles/numerology/9/', '11' => '/articles/numerology/11/',
    '22' => '/articles/numerology/22/', '33' => '/articles/numerology/33/',
  ],
];

// featured_score上位N件を返す
function get_featured_pages(int $n = 5): array {
  global $_NAV_PAGES;
  $sorted = $_NAV_PAGES;
  uasort($sorted, fn($a, $b) => ($b['featured_score'] ?? 0) <=> ($a['featured_score'] ?? 0));
  return array_slice($sorted, 0, $n, true);
}

// article URLを持つページ一覧（自ページ除外可）
function get_article_pages(string $excludeSlug = ''): array {
  global $_NAV_PAGES;
  return array_filter(
    $_NAV_PAGES,
    fn($p, $slug) => !empty($p['article']) && $slug !== $excludeSlug,
    ARRAY_FILTER_USE_BOTH
  );
}

// ランダムナビカード（自ページ除外可）
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
.nav-cards-section h3{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:.4rem;text-align:center}
.nav-cards-lead{font-size:.75rem;color:var(--muted);text-align:center;margin-bottom:1rem}
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
