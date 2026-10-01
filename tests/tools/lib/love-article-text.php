<?php
/**
 * tests/tools/lib/love-article-text.php
 *
 * 描画済みHTMLから本文領域のテキストを取り出す共通関数
 * （love-article-prod-expect.php・love-article-prod-verify.php から require する。直接実行しない）。
 *
 * 記事ページは <div class="art-hero"> から <div class="nav-cards-section">（ランダム表示のナビカード）の手前までを本文とする。
 * 見つからないページ（ハブ等）は <body> から header/footer/nav/script/style とナビカードを除いた部分。
 * GAタグ・構造化データ（script）・日付を含む共通フッター・ランダム要素はここで除外される。
 */
function mainRegion(string $html): string {
    $s = strpos($html, '<div class="art-hero"');
    if ($s !== false) {
        $e = strpos($html, '<div class="nav-cards-section"', $s);
        if ($e === false) $e = strpos($html, '<footer', $s);
        $body = substr($html, $s, $e === false ? null : $e - $s);
    } else {
        $body = preg_replace('#^.*?<body[^>]*>#is', '', $html);
        $body = preg_replace('#<div class="nav-cards-section".*?(?=<footer)#is', '', $body);
        $body = preg_replace('#<(header|footer|nav)\b.*?</\1>#is', ' ', $body);
    }
    return preg_replace('#<(script|style|noscript)\b.*?</\1>#is', ' ', $body);
}
function mainText(string $html): string {
    $t = mainRegion($html);
    $t = preg_replace('#<(br|/p|/div|/li|/td|/th|/tr|/h[1-6]|/dt|/dd|/table)\b[^>]*>#i', "\n", $t);
    $t = html_entity_decode(strip_tags($t), ENT_QUOTES, 'UTF-8');
    $lines = array_filter(array_map(fn($l) => trim(preg_replace('/[ \t\x{3000}]+/u', ' ', $l)), preg_split('/\n+/u', $t)), fn($l) => $l !== '');
    return implode("\n", $lines);
}
function mainSentences(string $html): array {
    $o = [];
    foreach (explode("\n", mainText($html)) as $line) foreach (preg_split('/(?<=。)/u', $line) as $s) { $s = trim($s); if ($s !== '') $o[] = $s; }
    return $o;
}
