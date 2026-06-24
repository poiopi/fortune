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
    '西洋占星術' => ['/articles/seiza/',       'seiza'],
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
