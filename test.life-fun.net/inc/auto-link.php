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
 */

$_autoLinkMap = [
    // キーワード => [リンク先URL, 自ページ除外用slug]
    '四柱推命'   => ['/articles/shichu/',     'shichu'],
    '算命学'     => ['/articles/sanmei/',      'sanmei'],
    '九星気学'   => ['/articles/kyusei/',      'kyusei'],
    '姓名判断'   => ['/articles/seimei/',      'seimei'],
    '数秘術'     => ['/articles/numerology/',  'numerology'],
    'タロット'   => ['/articles/tarot/',       'tarot'],
    'MBTI'       => ['/articles/mbti/',        'mbti'],
    '相性診断'   => ['/articles/aisho/',       'aisho'],
    '前世診断'   => ['/articles/zense/',       'zense'],
    '守護霊'     => ['/articles/guardian/',    'guardian'],
    '開運カレンダー' => ['/articles/calendar/',      'calendar'],
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
];

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
