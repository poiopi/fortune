<?php
/**
 * tests/tools/lib/love-article-render-router.php
 *
 * 恋愛記事の事実検証ツール（love-article-render-compare.php・love-article-prod-verify.php）が
 * PHPビルトインサーバーを起動するときのルーター。直接実行しない。
 *
 *   php -S 127.0.0.1:<port> -t <サイトのルート> tests/tools/lib/love-article-render-router.php
 *
 * - 乱数シードを固定する（mt_srand(424242)）。ナビカード等のランダム表示を修正前後で同じにし、
 *   HTMLのバイト比較を可能にするため。
 * - ディレクトリへのリクエストは index.php を実行する。.php 以外の静的ファイルはビルトインサーバーに任せる。
 */
mt_srand(424242);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$docroot = $_SERVER['DOCUMENT_ROOT'];
$f = $docroot . $uri;
if (is_dir($f)) $f = rtrim($f, '/') . '/index.php';
if (is_file($f) && substr($f, -4) === '.php') { chdir(dirname($f)); $_SERVER['SCRIPT_FILENAME']=$f; $_SERVER['SCRIPT_NAME']=$uri; require $f; return true; }
return false;
