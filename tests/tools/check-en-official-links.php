<?php
declare(strict_types=1);

/**
 * tests/tools/check-en-official-links.php
 *
 * 英語区画（test.life-fun.net/en/）の外部リンクのリンク切れを確認する。
 * OVERSEAS_PAGE_PROPOSAL.md 詳細設計1「リンク切れの確認」の実装。
 *
 * 対象：
 *   - test.life-fun.net/en/_inc/data.php の $EN_OFFICIAL（寺社の公式サイト）の URL
 *   - test.life-fun.net/en/ 配下のすべての *.php に書かれた href="https://…"
 * 各URLへ GET（User-Agent "Mozilla/5.0"、タイムアウト20秒、リダイレクトは追う）し、
 * 最終的なステータスコードを1行ずつ表示する。2xx/3xx 以外が1件でもあれば終了コード1。
 *
 * ネットワークに依存するため tests/run-all.php には入れていない。必要なときに手で実行する。
 *
 * 実行方法: php tests/tools/check-en-official-links.php
 */

$enDir = dirname(__DIR__, 2) . '/test.life-fun.net/en';
if (!is_dir($enDir)) {
    fwrite(STDERR, "英語区画のフォルダが見つかりません: {$enDir}\n");
    exit(1);
}

// 1. $EN_OFFICIAL（data.php は EN_GUIDE が定義されていないと読めない作りなので定義してから読む）
define('EN_GUIDE', true);
$EN_OFFICIAL = [];
require $enDir . '/_inc/data.php';

$urls = [];
foreach ($EN_OFFICIAL as $o) {
    $urls[$o['url']][] = '_inc/data.php ($EN_OFFICIAL ' . $o['key'] . ')';
}

// 2. en/ 配下の *.php に書かれた href="https://…"
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($enDir, FilesystemIterator::SKIP_DOTS));
foreach ($it as $f) {
    if (strtolower($f->getExtension()) !== 'php') continue;
    $rel = ltrim(str_replace('\\', '/', substr($f->getPathname(), strlen($enDir))), '/');
    if (preg_match_all('~href="(https://[^"]+)"~', (string) file_get_contents($f->getPathname()), $m)) {
        foreach ($m[1] as $u) {
            // Google Fonts の preconnect 先（リンクではない）は対象外
            if (preg_match('~^https://fonts\.(googleapis|gstatic)\.com/?$~', $u)) continue;
            $urls[html_entity_decode($u, ENT_QUOTES, 'UTF-8')][] = $rel;
        }
    }
}
ksort($urls);

/** @return array{0:int,1:string} [ステータスコード(取得できなければ0), 補足] */
function fetchStatus(string $url): array
{
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_CONNECTTIMEOUT => 20,
            CURLOPT_USERAGENT      => 'Mozilla/5.0',
        ]);
        curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $err = curl_error($ch);
        $final = (string) curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        return [$code, $err !== '' ? $err : ($final !== $url ? '-> ' . $final : '')];
    }
    $ctx = stream_context_create(['http' => [
        'method' => 'GET', 'timeout' => 20, 'follow_location' => 1, 'max_redirects' => 10,
        'user_agent' => 'Mozilla/5.0', 'ignore_errors' => true,
    ]]);
    $body = @file_get_contents($url, false, $ctx);
    $code = 0;
    foreach ($http_response_header ?? [] as $h) {
        if (preg_match('~^HTTP/\S+\s+(\d{3})~', $h, $mm)) $code = (int) $mm[1]; // リダイレクト後の最後の値が残る
    }
    return [$code, $body === false && $code === 0 ? '接続できませんでした' : ''];
}

$bad = 0;
echo '確認するURL：' . count($urls) . "件\n";
foreach ($urls as $url => $where) {
    [$code, $note] = fetchStatus($url);
    $ok = $code >= 200 && $code < 400;
    if (!$ok) $bad++;
    printf("%s %3s  %s%s\n      （%s）\n", $ok ? 'OK ' : 'NG ', $code ?: '---', $url, $note !== '' ? '  ' . $note : '', implode(', ', array_unique($where)));
}
echo $bad ? "リンク切れの可能性：{$bad}件\n" : "すべて 2xx/3xx でした\n";
exit($bad ? 1 : 0);
