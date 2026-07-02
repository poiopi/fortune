<?php
/**
 * 文脈リンク自動挿入
 *
 * 使い方：
 *   ob_start();
 *   // ...記事HTML...
 *   $html = ob_get_clean();
 *   require_once __DIR__ . '/auto-link.php';
 *   echo autoLink($html, 'shichu'); // 第2引数は自ページのslug
 *
 * ルール：
 *   - <p> タグ内のみ処理（見出し・ナビ等は対象外）
 *   - 既存 <a> タグの中は置換しない
 *   - 1キーワードにつき記事全体で1回のみリンク（初出のみ）
 *   - 自ページへのリンクは生成しない
 *   - キーワードを追加するときは $_autoLinkMap に追記するだけ
 *   - キーワードは処理前に文字数の降順（長い順）に自動ソートされる。
 *     「運命数1」と「運命数11」のように短いキーワードが長いキーワードの
 *     一部を誤って奪う事故を防ぐための仕様。登録順は気にしなくてよい。
 *
 * 【厳守】1文字キーワードの登録は禁止：
 *   このリンク処理は正規表現の単語境界判定を行わない単純な部分一致方式。
 *   「木」「火」「甲」のような1文字キーワードを登録すると、「植木」「決断力」
 *   のような無関係な熟語の中の1文字にまで誤ってリンクを貼ってしまう。
 *   1文字でしか表現できない単語（十干・五行・タロットの一部カード名等）は、
 *   「甲（きのえ）」のように読み仮名付きの複合語にして2文字以上にするか、
 *   登録を諦めてハブページのカードリンクに委ねること。
 */

$_autoLinkMap = [
    // キーワード => [リンク先URL, 自ページ除外用slug]
    '四柱推命'   => ['/articles/shichu/',     'shichu'],
    '算命学'     => ['/articles/sanmei/',      'sanmei'],
    '九星気学'   => ['/articles/kyusei/',      'kyusei'],
    '姓名判断'   => ['/articles/seimei/',      'seimei'],
    '数秘術'     => ['/articles/numerology/',  'numerology'],
    'ライフパスナンバー' => ['/articles/numerology/', 'numerology'],
    '誕生数'     => ['/articles/numerology/',  'numerology'],
    'タロット'   => ['/articles/tarot/',       'tarot'],
    'タロットカード' => ['/articles/tarot/',   'tarot'],
    'MBTI'       => ['/articles/mbti/',        'mbti'],
    '相性診断'   => ['/articles/aisho/',       'aisho'],
    '前世診断'   => ['/articles/zense/',       'zense'],
    '守護霊'     => ['/articles/guardian/',    'guardian'],
    '開運カレンダー' => ['/articles/calendar/',      'calendar'],
    '開運日'         => ['/articles/calendar/',      'calendar'],
    '吉日'           => ['/articles/calendar/',      'calendar'],
    '六曜'       => ['/articles/calendar/rokuyo/',   'calendar-rokuyo'],
    '先勝'       => ['/articles/calendar/rokuyo/senshou/', 'senshou'],
    '一白水星'   => ['/articles/kyusei/ippaku/',    'ippaku'],
    '二黒土星'   => ['/articles/kyusei/nikoku/',    'nikoku'],
    '三碧木星'   => ['/articles/kyusei/sanpeki/',   'sanpeki'],
    '四緑木星'   => ['/articles/kyusei/shiryoku/',  'shiryoku'],
    '五黄土星'   => ['/articles/kyusei/goko/',      'goko'],
    '六白金星'   => ['/articles/kyusei/roppaku/',   'roppaku'],
    '七赤金星'   => ['/articles/kyusei/shichiseki/','shichiseki'],
    '八白土星'   => ['/articles/kyusei/hakkudo/',   'hakkudo'],
    '九紫火星'   => ['/articles/kyusei/kyushi/',    'kyushi'],
    '西洋占星術' => ['/articles/seiza/',       'seiza'],
    '占星術'     => ['/articles/seiza/',       'seiza'],
    '12星座'     => ['/articles/seiza/',       'seiza'],
    '牡羊座'     => ['/articles/seiza/aries/',       'aries'],
    '牡牛座'     => ['/articles/seiza/taurus/',      'taurus'],
    '双子座'     => ['/articles/seiza/gemini/',      'gemini'],
    '蟹座'       => ['/articles/seiza/cancer/',      'cancer'],
    '獅子座'     => ['/articles/seiza/leo/',         'leo'],
    '乙女座'     => ['/articles/seiza/virgo/',       'virgo'],
    '天秤座'     => ['/articles/seiza/libra/',       'libra'],
    '蠍座'       => ['/articles/seiza/scorpio/',     'scorpio'],
    '射手座'     => ['/articles/seiza/sagittarius/', 'sagittarius'],
    '山羊座'     => ['/articles/seiza/capricorn/',   'capricorn'],
    '水瓶座'     => ['/articles/seiza/aquarius/',    'aquarius'],
    '魚座'       => ['/articles/seiza/pisces/',      'pisces'],

    // 四柱推命 十干（複合語表記で安全に登録）
    '甲（きのえ）' => ['/articles/shichu/kinoe/',      'kinoe'],
    '乙（きのと）' => ['/articles/shichu/kinoto/',     'kinoto'],
    '丙（ひのえ）' => ['/articles/shichu/hinoe/',      'hinoe'],
    '丁（ひのと）' => ['/articles/shichu/hinoto/',     'hinoto'],
    '戊（つちのえ）' => ['/articles/shichu/tsuchinoe/', 'tsuchinoe'],
    '己（つちのと）' => ['/articles/shichu/tsuchinoto/', 'tsuchinoto'],
    '庚（かのえ）' => ['/articles/shichu/kanoe/',      'kanoe'],
    '辛（かのと）' => ['/articles/shichu/kanoto/',     'kanoto'],
    '壬（みずのえ）' => ['/articles/shichu/mizunoe/',   'mizunoe'],
    '癸（みずのと）' => ['/articles/shichu/mizunoto/',  'mizunoto'],

    // 算命学 十大主星
    '貫索星' => ['/articles/sanmei/kansaku/', 'kansaku'],
    '石門星' => ['/articles/sanmei/sekimon/', 'sekimon'],
    '鳳閣星' => ['/articles/sanmei/houkaku/', 'houkaku'],
    '調舒星' => ['/articles/sanmei/chousho/', 'chousho'],
    '禄存星' => ['/articles/sanmei/rokuson/', 'rokuson'],
    '司禄星' => ['/articles/sanmei/shiroku/', 'shiroku'],
    '車騎星' => ['/articles/sanmei/shaki/',   'shaki'],
    '牽牛星' => ['/articles/sanmei/kengyu/',  'kengyu'],
    '龍高星' => ['/articles/sanmei/ryuko/',   'ryuko'],
    '玉堂星' => ['/articles/sanmei/gyokudo/', 'gyokudo'],

    // 数秘術 運命数（助詞バリエーション込み。並び順は自動ソートされるため任意）
    '運命数1'   => ['/articles/numerology/1/',  'numerology-1'],
    '運命数が1' => ['/articles/numerology/1/',  'numerology-1'],
    '運命数は1' => ['/articles/numerology/1/',  'numerology-1'],
    '運命数の1' => ['/articles/numerology/1/',  'numerology-1'],
    '運命数2'   => ['/articles/numerology/2/',  'numerology-2'],
    '運命数が2' => ['/articles/numerology/2/',  'numerology-2'],
    '運命数は2' => ['/articles/numerology/2/',  'numerology-2'],
    '運命数の2' => ['/articles/numerology/2/',  'numerology-2'],
    '運命数3'   => ['/articles/numerology/3/',  'numerology-3'],
    '運命数が3' => ['/articles/numerology/3/',  'numerology-3'],
    '運命数は3' => ['/articles/numerology/3/',  'numerology-3'],
    '運命数の3' => ['/articles/numerology/3/',  'numerology-3'],
    '運命数4'   => ['/articles/numerology/4/',  'numerology-4'],
    '運命数が4' => ['/articles/numerology/4/',  'numerology-4'],
    '運命数は4' => ['/articles/numerology/4/',  'numerology-4'],
    '運命数の4' => ['/articles/numerology/4/',  'numerology-4'],
    '運命数5'   => ['/articles/numerology/5/',  'numerology-5'],
    '運命数が5' => ['/articles/numerology/5/',  'numerology-5'],
    '運命数は5' => ['/articles/numerology/5/',  'numerology-5'],
    '運命数の5' => ['/articles/numerology/5/',  'numerology-5'],
    '運命数6'   => ['/articles/numerology/6/',  'numerology-6'],
    '運命数が6' => ['/articles/numerology/6/',  'numerology-6'],
    '運命数は6' => ['/articles/numerology/6/',  'numerology-6'],
    '運命数の6' => ['/articles/numerology/6/',  'numerology-6'],
    '運命数7'   => ['/articles/numerology/7/',  'numerology-7'],
    '運命数が7' => ['/articles/numerology/7/',  'numerology-7'],
    '運命数は7' => ['/articles/numerology/7/',  'numerology-7'],
    '運命数の7' => ['/articles/numerology/7/',  'numerology-7'],
    '運命数8'   => ['/articles/numerology/8/',  'numerology-8'],
    '運命数が8' => ['/articles/numerology/8/',  'numerology-8'],
    '運命数は8' => ['/articles/numerology/8/',  'numerology-8'],
    '運命数の8' => ['/articles/numerology/8/',  'numerology-8'],
    '運命数9'   => ['/articles/numerology/9/',  'numerology-9'],
    '運命数が9' => ['/articles/numerology/9/',  'numerology-9'],
    '運命数は9' => ['/articles/numerology/9/',  'numerology-9'],
    '運命数の9' => ['/articles/numerology/9/',  'numerology-9'],
    '運命数11'   => ['/articles/numerology/11/', 'numerology-11'],
    '運命数が11' => ['/articles/numerology/11/', 'numerology-11'],
    '運命数は11' => ['/articles/numerology/11/', 'numerology-11'],
    '運命数の11' => ['/articles/numerology/11/', 'numerology-11'],
    '運命数22'   => ['/articles/numerology/22/', 'numerology-22'],
    '運命数が22' => ['/articles/numerology/22/', 'numerology-22'],
    '運命数は22' => ['/articles/numerology/22/', 'numerology-22'],
    '運命数の22' => ['/articles/numerology/22/', 'numerology-22'],
    '運命数33'   => ['/articles/numerology/33/', 'numerology-33'],
    '運命数が33' => ['/articles/numerology/33/', 'numerology-33'],
    '運命数は33' => ['/articles/numerology/33/', 'numerology-33'],
    '運命数の33' => ['/articles/numerology/33/', 'numerology-33'],

    // タロット大アルカナ（単一漢字カードは除外：月・星・力・塔）
    '愚者'         => ['/articles/tarot/fool/',           'fool'],
    '魔術師'       => ['/articles/tarot/magician/',       'magician'],
    '女教皇'       => ['/articles/tarot/high-priestess/', 'high-priestess'],
    '女帝'         => ['/articles/tarot/empress/',        'empress'],
    '皇帝'         => ['/articles/tarot/emperor/',        'emperor'],
    '法王'         => ['/articles/tarot/hierophant/',     'hierophant'],
    '恋人'         => ['/articles/tarot/lovers/',         'lovers'],
    '戦車'         => ['/articles/tarot/chariot/',        'chariot'],
    '隠者'         => ['/articles/tarot/hermit/',         'hermit'],
    '運命の輪'     => ['/articles/tarot/wheel/',          'wheel'],
    '正義'         => ['/articles/tarot/justice/',        'justice'],
    '吊るされた男' => ['/articles/tarot/hanged-man/',     'hanged-man'],
    '死神'         => ['/articles/tarot/death/',          'death'],
    '節制'         => ['/articles/tarot/temperance/',     'temperance'],
    '悪魔'         => ['/articles/tarot/devil/',          'devil'],
    '審判'         => ['/articles/tarot/judgement/',      'judgement'],
    '世界'         => ['/articles/tarot/world/',          'world'],

    // MBTI 16タイプ
    'INTJ' => ['/articles/mbti/intj/', 'intj'],
    'INTP' => ['/articles/mbti/intp/', 'intp'],
    'ENTJ' => ['/articles/mbti/entj/', 'entj'],
    'ENTP' => ['/articles/mbti/entp/', 'entp'],
    'INFJ' => ['/articles/mbti/infj/', 'infj'],
    'INFP' => ['/articles/mbti/infp/', 'infp'],
    'ENFJ' => ['/articles/mbti/enfj/', 'enfj'],
    'ENFP' => ['/articles/mbti/enfp/', 'enfp'],
    'ISTJ' => ['/articles/mbti/istj/', 'istj'],
    'ISFJ' => ['/articles/mbti/isfj/', 'isfj'],
    'ESTJ' => ['/articles/mbti/estj/', 'estj'],
    'ESFJ' => ['/articles/mbti/esfj/', 'esfj'],
    'ISTP' => ['/articles/mbti/istp/', 'istp'],
    'ISFP' => ['/articles/mbti/isfp/', 'isfp'],
    'ESTP' => ['/articles/mbti/estp/', 'estp'],
    'ESFP' => ['/articles/mbti/esfp/', 'esfp'],

    // 守護霊
    '武家の先祖霊'   => ['/articles/guardian/buke-senzo/',     'buke-senzo'],
    '大地の精霊'     => ['/articles/guardian/daichi/',         'daichi'],
    '土着の先祖霊'   => ['/articles/guardian/dochaku-senzo/',  'dochaku-senzo'],
    '白狐の精霊'     => ['/articles/guardian/hakko/',          'hakko'],
    '炎の守護者'     => ['/articles/guardian/honoo/',          'honoo'],
    '鳳凰の守護者'   => ['/articles/guardian/hoo/',            'hoo'],
    '星の使者'       => ['/articles/guardian/hoshi/',          'hoshi'],
    '癒しの精霊'     => ['/articles/guardian/iyashi/',         'iyashi'],
    '風の精霊'       => ['/articles/guardian/kaze/',           'kaze'],
    '巫女の先祖霊'   => ['/articles/guardian/miko-senzo/',     'miko-senzo'],
    '陰陽師の先祖霊' => ['/articles/guardian/onmyoji-senzo/',  'onmyoji-senzo'],
    '龍神'           => ['/articles/guardian/ryujin/',         'ryujin'],
    '僧侶の先祖霊'   => ['/articles/guardian/sou-senzo/',      'sou-senzo'],
    '太陽の神使'     => ['/articles/guardian/taiyou/',         'taiyou'],
    '天女・天使'     => ['/articles/guardian/tenshi/',         'tenshi'],
    '月の女神'       => ['/articles/guardian/tsuki/',          'tsuki'],
    '海の守護者'     => ['/articles/guardian/umi/',            'umi'],
    '闇の精霊'       => ['/articles/guardian/yami/',           'yami'],

    // 開運カレンダー 六曜
    '友引' => ['/articles/calendar/rokuyo/tomobiki/',    'tomobiki'],
    '先負' => ['/articles/calendar/rokuyo/senbu/',       'senbu'],
    '仏滅' => ['/articles/calendar/rokuyo/butsumetsu/',  'butsumetsu'],
    '大安' => ['/articles/calendar/rokuyo/taian/',       'taian'],
    '赤口' => ['/articles/calendar/rokuyo/shakko/',      'shakko'],

    // 開運カレンダー 陰陽五行（単一漢字の木・火・土・金・水は除外）
    '陰陽五行' => ['/articles/calendar/gogyo/', 'calendar-gogyo'],

    // 開運カレンダー 特別な吉日
    '特別な吉日'   => ['/articles/calendar/kichijitsu/',               'calendar-kichijitsu'],
    '一粒万倍日'   => ['/articles/calendar/kichijitsu/ichiryumanbai/', 'ichiryumanbai'],
    '天赦日'       => ['/articles/calendar/kichijitsu/tenshabi/',      'tenshabi'],
    '寅の日'       => ['/articles/calendar/kichijitsu/tora/',          'tora'],
    '己巳の日'     => ['/articles/calendar/kichijitsu/tsuchinotomi/', 'tsuchinotomi'],
];

// 短いキーワードが長いキーワードの一部を誤って奪わないよう、
// 文字数の降順（長い順）に並べ替える。登録順は気にしなくてよい。
uksort($_autoLinkMap, fn($a, $b) => mb_strlen($b) <=> mb_strlen($a));

function autoLink(string $html, string $currentSlug): string {
    global $_autoLinkMap;
    $linked = [];

    return preg_replace_callback(
        '/<p([^>]*)>(.*?)<\/p>/su',
        function ($pMatch) use (&$linked, $currentSlug) {
            global $_autoLinkMap;
            $inner = $pMatch[2];

            foreach ($_autoLinkMap as $keyword => [$url, $slug]) {
                // 自ページ・既リンク済みはスキップ
                if ($slug === $currentSlug || isset($linked[$keyword])) continue;
                if (mb_strpos($inner, $keyword) === false) continue;

                // 既存 <a> タグの中は置換しないよう分割処理
                $parts = preg_split('/(<a\b[^>]*>.*?<\/a>)/su', $inner, -1, PREG_SPLIT_DELIM_CAPTURE);
                $replaced = false;
                foreach ($parts as &$part) {
                    if ($replaced) break;
                    if (preg_match('/^<a\b/iu', $part)) continue;
                    $new = preg_replace(
                        '/' . preg_quote($keyword, '/') . '/u',
                        '<a href="' . $url . '" class="al-link">' . $keyword . '</a>',
                        $part, 1, $count
                    );
                    if ($count > 0) {
                        $part = $new;
                        $replaced = true;
                        $linked[$keyword] = true;
                    }
                }
                $inner = implode('', $parts);
            }

            return '<p' . $pMatch[1] . '>' . $inner . '</p>';
        },
        $html
    );
}
