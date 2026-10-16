<?php if (!defined('EN_GUIDE')) { http_response_code(404); exit; }

// ---- Fortune levels (Decoder tiles + Try page) ----
// 'main' = shown as a main tile; 'rare' = shown in the "less common" row only.
$EN_RANKS = [
  ['slug'=>'daikichi',    'ja'=>'大吉',   'romaji'=>'daikichi',    'en'=>'Great good luck',        'group'=>'main', 'best'=>true],
  ['slug'=>'kichi',       'ja'=>'吉',     'romaji'=>'kichi',       'en'=>'Good luck',              'group'=>'main'],
  ['slug'=>'chukichi',    'ja'=>'中吉',   'romaji'=>'chūkichi',    'en'=>'Moderate good luck',     'group'=>'main'],
  ['slug'=>'shokichi',    'ja'=>'小吉',   'romaji'=>'shōkichi',    'en'=>'Small good luck',        'group'=>'main'],
  ['slug'=>'hankichi',    'ja'=>'半吉',   'romaji'=>'hankichi',    'en'=>'Half good luck',         'group'=>'main'],
  ['slug'=>'suekichi',    'ja'=>'末吉',   'romaji'=>'suekichi',    'en'=>'Good luck later on',     'group'=>'main'],
  ['slug'=>'sueshokichi', 'ja'=>'末小吉', 'romaji'=>'sueshōkichi', 'en'=>'Small good luck later on','group'=>'main'],
  ['slug'=>'kyo',         'ja'=>'凶',     'romaji'=>'kyō',         'en'=>'Bad luck',               'group'=>'main'],
  ['slug'=>'daikyo',      'ja'=>'大凶',   'romaji'=>'daikyō',      'en'=>'Very bad luck',         'group'=>'main'],
  ['slug'=>'daidaikichi', 'ja'=>'大大吉', 'romaji'=>'daidaikichi', 'en'=>'Exceptional good luck',  'group'=>'rare'],
  ['slug'=>'hei',         'ja'=>'平',     'romaji'=>'hei / taira', 'en'=>'Even (neither good nor bad)', 'group'=>'rare'],
];

// ---- Topic headings (Decoder table). 'also' = variant spellings, shown with a visible "Also written as" label ----
$EN_TOPICS = [
  ['ja'=>'願望', 'also'=>['願事'],           'romaji'=>'ganbō / negaigoto', 'title'=>'Your wish.',              'desc'=>'Whether the thing you are hoping for comes about.'],
  ['ja'=>'待人', 'also'=>['待ち人'],         'romaji'=>'machibito',         'title'=>'The person you are waiting for.', 'desc'=>'Not only a romantic partner: anyone whose arrival or news you are hoping for.'],
  ['ja'=>'失物', 'also'=>['失せ物'],         'romaji'=>'usemono',           'title'=>'Lost things.',            'desc'=>'Whether something you have lost turns up.'],
  ['ja'=>'旅行', 'also'=>['旅立', '旅立ち'], 'romaji'=>'ryokō / tabidachi', 'title'=>'Travel.',                 'desc'=>'Trips and setting out from home.'],
  ['ja'=>'商売', 'also'=>['商い'],           'romaji'=>'shōbai / akinai',   'title'=>'Business.',               'desc'=>'Trade, selling and running a business.'],
  ['ja'=>'学問', 'also'=>['学業'],           'romaji'=>'gakumon / gakugyō', 'title'=>'Study.',                  'desc'=>'Learning, schoolwork and exams.'],
  ['ja'=>'相場', 'also'=>[],                 'romaji'=>'sōba',              'title'=>'Market dealings.',        'desc'=>'Traditionally, buying and selling at market prices. This line is part of a traditional fortune, not financial advice.'],
  ['ja'=>'争事', 'also'=>['争い事'],         'romaji'=>'arasoigoto',        'title'=>'Disputes.',               'desc'=>'Quarrels and conflicts with other people.'],
  ['ja'=>'恋愛', 'also'=>[],                 'romaji'=>'ren\'ai',           'title'=>'Love.',                   'desc'=>'Romance and relationships.'],
  ['ja'=>'縁談', 'also'=>[],                 'romaji'=>'endan',             'title'=>'Marriage prospects.',     'desc'=>'Proposals and matches that may lead to marriage.'],
  ['ja'=>'転居', 'also'=>['家移り'], 'romaji'=>'tenkyo / yautsuri', 'title'=>'Home and moving.', 'desc'=>'Moving to a new home, and anything to do with where you live.'],
  ['ja'=>'出産', 'also'=>['お産'],           'romaji'=>'shussan / osan',    'title'=>'Childbirth.',             'desc'=>'What the slip says about a birth. Traditional wording only, not medical advice.'],
  ['ja'=>'病気', 'also'=>['病', '病事'],             'romaji'=>'byōki / yamai / yamaigoto',     'title'=>'Illness.',                'desc'=>'What the slip says about getting well. Traditional wording only, not medical advice.'],
  ['ja'=>'方角', 'also'=>[],                 'romaji'=>'hōgaku',            'title'=>'Directions.',             'desc'=>'Which directions the slip calls lucky or unlucky.'],
];

// ---- Common phrases (Decoder) ----
$EN_PHRASES = [
  ['ja'=>'叶う',     'romaji'=>'kanau',       'en'=>'Comes true.'],
  ['ja'=>'叶わず',   'romaji'=>'kanawazu',    'en'=>'Does not come true.'],
  ['ja'=>'遅し',     'romaji'=>'ososhi',      'en'=>'Slow; it takes time.'],
  ['ja'=>'来る',     'romaji'=>'kitaru / kuru',      'en'=>'They come.'],
  ['ja'=>'来ず',     'romaji'=>'kozu',        'en'=>'They do not come.'],
  ['ja'=>'出る',     'romaji'=>'deru',        'en'=>'It turns up; it is found.'],
  ['ja'=>'良し',     'romaji'=>'yoshi',       'en'=>'Good.'],
  ['ja'=>'利あり',   'romaji'=>'ri ari',      'en'=>'There is profit in it.'],
  ['ja'=>'障りあり', 'romaji'=>'sawari ari',  'en'=>'Something may get in the way.'],
  ['ja'=>'慎め',     'romaji'=>'tsutsushime', 'en'=>'Be careful; show restraint.'],
  ['ja'=>'控えよ',   'romaji'=>'hikaeyo',     'en'=>'Hold back for now.'],
  ['ja'=>'急ぐな',   'romaji'=>'isogu na',    'en'=>'Don\'t rush.'],
];

// ---- Other things printed on a slip (Decoder section 04) ----
$EN_SLIP_PARTS = [
  ['ja'=>'御神籤', 'also'=>['御籤', 'おみくじ'], 'romaji'=>'omikuji', 'en'=>'The title: "omikuji" itself. Temples may use other titles.'],
  ['ja'=>'第〇番', 'also'=>[], 'romaji'=>'dai … ban', 'en'=>'The slip number, written in kanji numerals. 第二十三番 means "No. 23".'],
  ['ja'=>'和歌',   'also'=>[], 'romaji'=>'waka', 'en'=>'A short classical Japanese poem, often printed near the top.'],
  ['ja'=>'漢詩',   'also'=>[], 'romaji'=>'kanshi', 'en'=>'A poem in classical Chinese, used on some slips instead of a waka.'],
];

// ---- Try page: practice slip ----
// Only these 8 levels are drawn. Weights are invented for practice and do not copy any shrine or temple.
$EN_TRY_WEIGHTS = ['daikichi'=>14, 'kichi'=>18, 'chukichi'=>16, 'shokichi'=>14, 'hankichi'=>6, 'suekichi'=>14, 'sueshokichi'=>6, 'kyo'=>12];
// Chance of a "good" / "mixed" / "careful" line for each level.
$EN_TRY_TONE = [
  'daikichi'=>[90,10,0], 'kichi'=>[70,25,5], 'chukichi'=>[60,30,10], 'shokichi'=>[45,40,15],
  'hankichi'=>[35,45,20], 'suekichi'=>[25,55,20], 'sueshokichi'=>[20,55,25], 'kyo'=>[5,40,55],
];
// Topics printed on the practice slip (病気・相場・出産 are deliberately left out of the practice slip).
$EN_TRY_LINES = [
  '願望' => ['good'=>['叶う','It comes true.'],      'mixed'=>['遅けれど叶う','Slow, but it comes true.'],   'careful'=>['急ぐな','Don\'t rush.']],
  '待人' => ['good'=>['来る','They come.'],          'mixed'=>['来るが遅し','They come, but late.'],        'careful'=>['来ず','They do not come.']],
  '失物' => ['good'=>['出る','It turns up.'],        'mixed'=>['遅けれど出る','It turns up, but late.'],     'careful'=>['出がたし','Hard to find.']],
  '旅行' => ['good'=>['良し','Good.'],               'mixed'=>['近きは良し','Short trips are good.'],      'careful'=>['控えよ','Hold back for now.']],
  '学問' => ['good'=>['安心せよ','Rest easy.'],      'mixed'=>['努力せよ','Keep working at it.'],         'careful'=>['油断すべからず','Don\'t let your guard down.']],
  '恋愛' => ['good'=>['良し','Good.'],               'mixed'=>['急ぐべからず','Don\'t rush.'],          'careful'=>['慎め','Be careful; show restraint.']],
  '転居' => ['good'=>['良し','Good.'],               'mixed'=>['急ぐな','Don\'t rush.'],                  'careful'=>['障りあり','Something may get in the way.']],
];
// One short English note per level, shown under the level on the practice slip.
$EN_TRY_NOTE = [
  'daikichi'    => 'The top level on most slips. Read the lines below: even a 大吉 slip usually comes with advice.',
  'kichi'       => 'A good result. Where 吉 sits among the other levels differs from place to place.',
  'chukichi'    => 'A good result, a step or so below the best.',
  'shokichi'    => 'A modest good result.',
  'hankichi'    => 'Half good luck: a level that not every shrine or temple uses.',
  'suekichi'    => 'Good luck that comes later.',
  'sueshokichi' => 'A little good luck, coming later.',
  'kyo'         => 'Bad luck. Real slips usually pair 凶 with advice on what to watch out for, so the lines below matter most.',
];

// ---- Official sites (verified 2026-10-16; see report). Dazaifu Tenmangu: NOT linked (user decision).
// Itsukushima Shrine: NOT linked (hidden "no links" statement found in its page source; pending user decision).
$EN_OFFICIAL = [
  ['key'=>'meiji-jingu',      'name'=>'Meiji Jingu',             'type'=>'Shrine', 'place'=>'Tokyo',    'url'=>'https://www.meijijingu.or.jp/en/',     'note'=>'Visiting etiquette and shrine rules in English. Its omikuji are waka poems with English translations.'],
  ['key'=>'senso-ji',         'name'=>'Senso-ji',                'type'=>'Temple', 'place'=>'Tokyo',    'url'=>'https://www.senso-ji.jp/english/',     'note'=>'History, buildings and annual events.'],
  ['key'=>'tsurugaoka',       'name'=>'Tsurugaoka Hachimangu',   'type'=>'Shrine', 'place'=>'Kamakura', 'url'=>'https://www.hachimangu.or.jp/en/',     'note'=>'History, festivals, prayers and amulets.'],
  ['key'=>'fushimi-inari',    'name'=>'Fushimi Inari Taisha',    'type'=>'Shrine', 'place'=>'Kyoto',    'url'=>'https://inari.jp/en/',                 'note'=>'Includes its "Request for All Visitors" list of prohibited acts.'],
  ['key'=>'yasaka',           'name'=>'Yasaka Jinja',            'type'=>'Shrine', 'place'=>'Kyoto',    'url'=>'https://www.yasaka-jinja.or.jp/en/',   'note'=>'History, festivals and access.'],
  ['key'=>'kiyomizu-dera',    'name'=>'Kiyomizu-dera',           'type'=>'Temple', 'place'=>'Kyoto',    'url'=>'https://www.kiyomizudera.or.jp/en/',   'note'=>'How to pray and offer incense, plus an FAQ with visitor rules.'],
  ['key'=>'todai-ji',         'name'=>'Todai-ji',                'type'=>'Temple', 'place'=>'Nara',     'url'=>'https://www.todaiji.or.jp/en/',        'note'=>'Opening hours, halls and visitor notices.'],
  ['key'=>'ise-jingu',        'name'=>'Ise Jingu',               'type'=>'Shrine', 'place'=>'Mie',      'url'=>'https://www.isejingu.or.jp/en/',       'note'=>'How to purify at the water basin and how to pray, in English.'],
];
