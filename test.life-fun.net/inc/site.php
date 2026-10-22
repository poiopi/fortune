<?php
/* サイト情報の一元管理。改名時はこのファイルとロゴ画像の差し替えだけで済むようにする。
   使い方: require_once __DIR__.'/site.php';（header.php・breadcrumb.php・footer.php・チャット部品・各ページの先頭が読み込む）
   ブランド切り替え：SITE_BRAND を 'portal' に戻すと、サイト名・title末尾・ロゴ・トップのtitle/H1/説明文・
   WebSite構造化データ/og:site_name（portalでは出さない）・チャット名・挨拶・メール件名が旧状態に戻る。
   戻し手順は COMPONENTS.md「inc/site.php」。値に ' " < > & を入れないこと（JS文字列・属性にそのまま出す箇所がある）。 */
if (!defined('SITE_NAME')) {
    define('SITE_BRAND', 'mitsuboshi'); // 'portal' に戻すと旧名・旧ロゴ（値は 'portal' か 'mitsuboshi' のみ。それ以外は全ページが壊れる）
    $__siteBrands = [
        'portal' => [
            'name'         => '占いPortal',
            'title_suffix' => false,   // 旧ブランドは title 末尾にサイト名を付けない（Phase1と同じ）
            'logo_dark'    => '/img/brand/logo-wordmark-dark.svg',
            'logo_light'   => '/img/brand/logo-wordmark-light.svg',
            'logo_w'       => 121,     // viewBox 520×137.5 を高さ32pxにした幅
            'alt_names'    => [],
            'website_meta' => false,   // 旧ブランドには WebSite JSON-LD・og:site_name が無かった
            'chat_tab'     => '占いチャット',
            'chat_title'   => 'AI鑑定チャット',
            'chat_bot'     => '',
            'top_title'    => '無料占いポータル｜タロット・数秘術・九星気学・姓名判断',
            'top_desc'     => 'タロット占い・数秘術・九星気学・相性診断・姓名判断など無料の占いが揃う占いポータル。生年月日や名前を入力するだけで鑑定結果をすぐに表示します。',
            'top_eyebrow'  => 'Free Fortune Telling · 占いPortal',
            'top_h1_html'  => '無料占いポータル',
        ],
        'mitsuboshi' => [
            'name'         => 'みつぼし占い',
            'title_suffix' => true,
            'logo_dark'    => '/img/brand/mitsuboshi/logo-pattern2-dark-h96.png',
            'logo_light'   => '/img/brand/mitsuboshi/logo-pattern2-light-h96.png',
            'logo_w'       => 95,      // 286×96 を高さ32pxにした幅
            'alt_names'    => ['みつぼし', 'life-fun.net'],
            'website_meta' => true,
            'chat_tab'     => '占いチャット',            // SPで縦書きタブが伸びて本文に重なるため短いまま（2026-10-22）
            'chat_title'   => '占いチャット みつぼっと',
            'chat_bot'     => 'みつぼっと',
            'top_title'    => 'みつぼし占い｜無料占い（タロット・数秘術・九星気学・姓名判断）',
            'top_desc'     => 'タロット占い・数秘術・九星気学・相性診断・姓名判断など無料の占いが揃う占いポータル「みつぼし占い」。生年月日や名前を入力するだけで鑑定結果をすぐに表示します。',
            'top_eyebrow'  => 'Free Fortune Telling',
            'top_h1_html'  => 'みつぼし占い<span class="hero-h1-desc">無料占いポータル</span>',
        ],
    ];
    $__sb = $__siteBrands[SITE_BRAND];
    define('SITE_NAME', $__sb['name']);
    define('SITE_URL', 'https://life-fun.net');
    define('TITLE_SEP', '｜');
    define('TITLE_SUFFIX', $__sb['title_suffix'] ? TITLE_SEP . SITE_NAME : '');
    define('LOGO_DARK', $__sb['logo_dark']);
    define('LOGO_LIGHT', $__sb['logo_light']);
    define('LOGO_W', $__sb['logo_w']);
    define('LOGO_H', 32);
    define('SITE_ALT_NAMES', $__sb['alt_names']);
    define('SITE_WEBSITE_META', $__sb['website_meta']);
    define('CHAT_TAB_LABEL', $__sb['chat_tab']);
    define('CHAT_TITLE', $__sb['chat_title']);
    define('CHAT_BOT_NAME', $__sb['chat_bot']);
    define('TOP_TITLE', $__sb['top_title']);
    define('TOP_DESCRIPTION', $__sb['top_desc']);
    define('TOP_EYEBROW', $__sb['top_eyebrow']);
    define('TOP_H1_HTML', $__sb['top_h1_html']);
    unset($__siteBrands, $__sb);
}
if (!function_exists('site_title_suffix')) {
    /* title 末尾。サフィックスがあるブランドでは TITLE_SUFFIX、無いブランドでは
       そのページが元々持っていた末尾（$legacy）を返す（portal に戻したとき旧 title とバイト一致させるため） */
    function site_title_suffix(string $legacy = ''): string
    {
        return TITLE_SUFFIX !== '' ? TITLE_SUFFIX : $legacy;
    }
}
