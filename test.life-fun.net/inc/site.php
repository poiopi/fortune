<?php
/* サイト情報の一元管理。改名時はこのファイルとロゴ画像の差し替えだけで済むようにする。
   使い方: require_once __DIR__.'/site.php';（inc/header.php・inc/breadcrumb.php が読み込む） */
if (!defined('SITE_NAME')) {
    define('SITE_NAME', '占いPortal');
    define('SITE_URL', 'https://life-fun.net');
    define('TITLE_SEP', '｜');
    define('TITLE_SUFFIX', '');   // Phase1は空（title出力を変えない）。改名時に TITLE_SEP.SITE_NAME を入れる
    define('LOGO_DARK', '/img/brand/logo-wordmark-dark.svg');
    define('LOGO_LIGHT', '/img/brand/logo-wordmark-light.svg');
    define('LOGO_W', 121);        // viewBox 520×137.5 を高さ32pxにした幅
    define('LOGO_H', 32);
}
