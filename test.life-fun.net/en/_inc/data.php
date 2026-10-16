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
// Overall reading (総評) on the practice slip: 2 per level, picked by slip number (no % 2).
// Japanese and kana readings checked by the site owner (2026-10-17); romaji is Hepburn from those readings.
// No illness or money. Even 凶 ends with how to spend the time. English uses "may", never a promise.
$EN_TRY_SUMMARY = [
  'daikichi' => [
    ['ja'=>'月雲を出でて光さやかなり。おごらず正しき心を保てば、望み事おのずから成るべし。', 'romaji'=>'Tsuki kumo o idete hikari sayaka nari. Ogorazu tadashiki kokoro o tamoteba, nozomigoto onozukara naru beshi.', 'en'=>'Like the moon coming out from behind the clouds, things grow clear. Stay humble and steady, and what you hope for may come in its own time.'],
    ['ja'=>'春の野に花咲きそろうがごとし。人の恩を忘れず励めば、喜びいよいよ重なるべし。', 'romaji'=>'Haru no no ni hana sakisorou ga gotoshi. Hito no on o wasurezu hagemeba, yorokobi iyoiyo kasanaru beshi.', 'en'=>'Like a spring field in full bloom. Keep working and remember those who helped you, and your joys may keep multiplying.'],
  ],
  'kichi' => [
    ['ja'=>'朝日の山の端を照らすがごとし。焦らず一歩ずつ進めば、道はおのずと開くべし。', 'romaji'=>'Asahi no yama no ha o terasu ga gotoshi. Aserazu ippo zutsu susumeba, michi wa onozuto hiraku beshi.', 'en'=>'Like the morning sun lighting the ridge of a mountain. Go one step at a time without rushing, and the way may open.'],
    ['ja'=>'穏やかなる流れに舟を進むるがごとし。身の程を守りて油断せざれば、事なく運ぶべし。', 'romaji'=>'Odayaka naru nagare ni fune o susumuru ga gotoshi. Mi no hodo o mamorite yudan sezareba, koto naku hakobu beshi.', 'en'=>'Like a boat moving down a calm river. Know your limits and stay alert, and things may go smoothly.'],
  ],
  'chukichi' => [
    ['ja'=>'木々の芽の日ごとにふくらむがごとし。今の努めを怠らねば、やがて実を結ぶべし。', 'romaji'=>'Kigi no me no higoto ni fukuramu ga gotoshi. Ima no tsutome o okotaraneba, yagate mi o musubu beshi.', 'en'=>'Like buds swelling a little more each day. Keep up your efforts now, and they may bear fruit in time.'],
    ['ja'=>'雨上がりの空しだいに晴るるがごとし。人と和して事を進むれば、よき知らせあるべし。', 'romaji'=>'Ameagari no sora shidai ni haruru ga gotoshi. Hito to washite koto o susumureba, yoki shirase aru beshi.', 'en'=>'Like the sky slowly clearing after rain. Work in harmony with others, and good news may come.'],
  ],
  'shokichi' => [
    ['ja'=>'小川の水の絶えず流るるがごとし。小さき事を大切にすれば、幸い少しずつ来たるべし。', 'romaji'=>'Ogawa no mizu no taezu nagaruru ga gotoshi. Chiisaki koto o taisetsu ni sureba, saiwai sukoshi zutsu kitaru beshi.', 'en'=>'Like a small stream that never stops flowing. Take care of small things, and good fortune may come little by little.'],
    ['ja'=>'庭の草木に水をやるがごとし。欲を張らず日々を丁寧に送れば、心安らかなるべし。', 'romaji'=>'Niwa no kusaki ni mizu o yaru ga gotoshi. Yoku o harazu hibi o teinei ni okureba, kokoro yasuraka naru beshi.', 'en'=>'Like watering the plants in a garden. Keep your wants modest and live each day with care, and your mind may be at peace.'],
  ],
  'hankichi' => [
    ['ja'=>'霧の中に道を探すがごとし。急がず足元を確かめて進めば、迷うことなかるべし。', 'romaji'=>'Kiri no naka ni michi o sagasu ga gotoshi. Isogazu ashimoto o tashikamete susumeba, mayou koto nakaru beshi.', 'en'=>'Like finding your way through mist. Don\'t hurry, check each step, and you need not lose your way.'],
    ['ja'=>'月の半ば雲に隠るるがごとし。良きことも悪しきことも半ばなれば、心を静かに保つべし。', 'romaji'=>'Tsuki no nakaba kumo ni kakururu ga gotoshi. Yoki koto mo ashiki koto mo nakaba nareba, kokoro o shizuka ni tamotsu beshi.', 'en'=>'Like a moon half hidden by clouds. Good and bad come in equal parts for now, so keep your mind calm.'],
  ],
  'suekichi' => [
    ['ja'=>'冬の木の春を待つがごとし。今は根を養う時なれば、やがて花咲くべし。', 'romaji'=>'Fuyu no ki no haru o matsu ga gotoshi. Ima wa ne o yashinau toki nareba, yagate hana saku beshi.', 'en'=>'Like a winter tree waiting for spring. For now, tend your roots; in time, flowers may bloom.'],
    ['ja'=>'遠き山道を一歩ずつ登るがごとし。初めは苦しくとも、終わりには良き眺めあるべし。', 'romaji'=>'Tōki yamamichi o ippo zutsu noboru ga gotoshi. Hajime wa kurushiku tomo, owari ni wa yoki nagame aru beshi.', 'en'=>'Like climbing a long mountain path one step at a time. The climb is hard at first, but a fine view may be waiting at the end.'],
  ],
  'sueshokichi' => [
    ['ja'=>'夜明け前の空のほのかに白むがごとし。望みを捨てず待てば、小さき喜び来たるべし。', 'romaji'=>'Yoake mae no sora no honoka ni shiromu ga gotoshi. Nozomi o sutezu mateba, chiisaki yorokobi kitaru beshi.', 'en'=>'Like the sky just starting to pale before dawn. Don\'t give up hope, and a small joy may come.'],
    ['ja'=>'蒔きし種のまだ土の中にあるがごとし。焦らず世話を続ければ、いずれ芽吹くべし。', 'romaji'=>'Makishi tane no mada tsuchi no naka ni aru ga gotoshi. Aserazu sewa o tsuzukereba, izure mebuku beshi.', 'en'=>'Like a seed still under the soil. Keep tending it without rushing, and it may sprout in time.'],
  ],
  'kyo' => [
    ['ja'=>'冬枯れの野にも春は来たる。今はつつしみて時を待てば、やがて道ひらくべし。', 'romaji'=>'Fuyugare no no ni mo haru wa kitaru. Ima wa tsutsushimite toki o mateba, yagate michi hiraku beshi.', 'en'=>'Even a winter field sees spring. Hold back for now and wait for the right time, and a way may open.'],
    ['ja'=>'嵐の夜の明くるを待つがごとし。無理をせず身を慎めば、災いおのずから去るべし。', 'romaji'=>'Arashi no yo no akuru o matsu ga gotoshi. Muri o sezu mi o tsutsushimeba, wazawai onozukara saru beshi.', 'en'=>'Like waiting for a stormy night to end. Don\'t push yourself and act with care, and the trouble may pass on its own.'],
  ],
];
// Romaji for the practice-slip topic headings and lines (readings checked by the site owner, 2026-10-17).
$EN_TRY_TOPIC_ROMAJI = ['願望'=>'ganbō', '待人'=>'machibito', '失物'=>'usemono', '旅行'=>'ryokō', '学問'=>'gakumon', '恋愛'=>'ren\'ai', '転居'=>'tenkyo'];
$EN_TRY_LINE_ROMAJI = [
  '叶う'=>'kanau', '遅けれど叶う'=>'osokeredo kanau', '急ぐな'=>'isogu na',
  '来る'=>'kitaru', '来るが遅し'=>'kitaru ga ososhi', '来ず'=>'kozu',
  '出る'=>'deru', '遅けれど出る'=>'osokeredo deru', '出がたし'=>'degatashi',
  '良し'=>'yoshi', '近きは良し'=>'chikaki wa yoshi', '控えよ'=>'hikaeyo',
  '安心せよ'=>'anshin seyo', '努力せよ'=>'doryoku seyo', '油断すべからず'=>'yudan subekarazu',
  '急ぐべからず'=>'isogu bekarazu', '慎め'=>'tsutsushime', '障りあり'=>'sawari ari',
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
