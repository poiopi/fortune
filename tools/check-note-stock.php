<?php
declare(strict_types=1);

/**
 * tools/check-note-stock.php
 *
 * note 用の本文が入ったストック（管理画面の取り込みJSON）を、NOTE_RULES.md の決まりで機械的に確かめる（8章の①）。
 * 使い方：php tools/check-note-stock.php docs/sns-stock/2026-10.json [ext_id ...]
 *         ext_id を付けるとその記事だけ。付けなければ note 本文のある全件
 *
 * - NG：決まりに合っていない（直してから渡す）。1件でもあれば終了コード1
 * - 注意：決まりの範囲だが確かめたほうがよいもの（人の読み直しで判断する）
 * - 文章の中身（出典で確かめたことだけか・断定していないか・読後感）は機械では判定しない（8章の②で Claude が読み直す）
 * - 数値は NOTE_RULES.md 4章の初期値。見直したら、ここの定数も合わせて直す
 */

const NOTE_BODY_MIN = 1000;      // 本文の字数（空白・改行を除く）
const NOTE_BODY_MAX = 3000;      // ここを超えたら注意
const NOTE_BODY_HARD_MAX = 3500; // ここを超えたらNG
const NOTE_TITLE_MIN = 20;
const NOTE_TITLE_MAX = 40;
const NOTE_HEADINGS_MIN = 3;     // 小見出し（「### 」で始まる行）。3個以上で noteに目次を入れる
const NOTE_HEADINGS_MAX = 8;
const NOTE_LINKS_MIN = 1;        // {link} と https:// の合計
const NOTE_LINKS_MAX = 3;
const NOTE_LINK_TAIL_RATIO = 0.8; // リンクは本文の後ろ2割（締め）だけに置く
const NOTE_OLD_BRANDS = ['占いPortal'];
const NOTE_SITE_ORIGIN = 'https://life-fun.net/';

if ($argc < 2) {
    fwrite(STDERR, "使い方：php tools/check-note-stock.php <ストックのJSON> [ext_id ...]\n");
    exit(2);
}
$file = $argv[1];
$only = array_slice($argv, 2);
$json = json_decode((string) @file_get_contents($file), true);
if (!is_array($json) || !isset($json['items']) || !is_array($json['items'])) {
    fwrite(STDERR, "JSONを読めません：{$file}\n");
    exit(2);
}
$imageDir = dirname(__DIR__) . '/docs/sns-stock/note-images';

/** 文字数（書記素ごと。絵文字・結合文字も1字） */
function note_len(string $s): int
{
    return function_exists('grapheme_strlen') ? (int) grapheme_strlen($s) : mb_strlen($s);
}

$checked = 0;
$ngTotal = 0;
foreach ($json['items'] as $item) {
    $id = (string) ($item['ext_id'] ?? '');
    $note = $item['bodies']['note'] ?? null;
    if ($note === null || ($only !== [] && !in_array($id, $only, true))) {
        continue;
    }
    $checked++;
    $ng = [];
    $warn = [];
    $title = trim((string) ($note['title'] ?? ''));
    $body = (string) ($note['body'] ?? '');

    $titleLen = note_len($title);
    if ($titleLen < NOTE_TITLE_MIN || $titleLen > NOTE_TITLE_MAX) {
        $ng[] = 'タイトル ' . $titleLen . '字（' . NOTE_TITLE_MIN . '〜' . NOTE_TITLE_MAX . '字）';
    }

    $plain = preg_replace('/\{link\}|https?:\/\/\S+|^#{1,3} /mu', '', $body) ?? $body;
    $bodyLen = note_len(preg_replace('/\s+/u', '', $plain) ?? $plain);
    if ($bodyLen < NOTE_BODY_MIN || $bodyLen > NOTE_BODY_HARD_MAX) {
        $ng[] = '本文 ' . $bodyLen . '字（' . NOTE_BODY_MIN . '〜' . NOTE_BODY_MAX . '字。' . NOTE_BODY_HARD_MAX . '字を超えない）';
    } elseif ($bodyLen > NOTE_BODY_MAX) {
        $warn[] = '本文 ' . $bodyLen . '字（' . NOTE_BODY_MAX . '字を超えている。' . NOTE_BODY_HARD_MAX . '字までは可）';
    }

    // 見出しは「### 」（noteに貼り付けると小見出しになる。2026-10-24 確認）。「■」の行は見出しにならないので使わない
    $headings = preg_match_all('/^### \S/mu', $body);
    if (preg_match('/^\s*■/mu', $body) === 1) {
        $ng[] = '「■」の見出しが残っている（「### 」に直す）';
    }
    if (preg_match('/^#{1,2} \S/mu', $body) === 1) {
        $warn[] = '「# 」「## 」の見出しがある（小見出し「### 」にそろえる）';
    }
    if ($headings < NOTE_HEADINGS_MIN || $headings > NOTE_HEADINGS_MAX) {
        $ng[] = '小見出し ' . $headings . '個（' . NOTE_HEADINGS_MIN . '〜' . NOTE_HEADINGS_MAX . '個）';
    }

    preg_match_all('/\{link\}|https?:\/\/\S+/u', $body, $m, PREG_OFFSET_CAPTURE);
    $links = $m[0];
    if (count($links) < NOTE_LINKS_MIN || count($links) > NOTE_LINKS_MAX) {
        $ng[] = 'リンク ' . count($links) . '本（' . NOTE_LINKS_MIN . '〜' . NOTE_LINKS_MAX . '本）';
    }
    $bodyBytes = strlen($body);
    foreach ($links as [$text, $offset]) {
        if ($bodyBytes > 0 && $offset / $bodyBytes < NOTE_LINK_TAIL_RATIO) {
            $ng[] = '本文の途中にリンク：' . mb_strimwidth($text, 0, 50, '…') . '（締めにだけ置く）';
        }
        if ($text !== '{link}' && !str_starts_with($text, NOTE_SITE_ORIGIN)) {
            $warn[] = 'サイト以外へのリンク：' . mb_strimwidth($text, 0, 50, '…');
        }
    }
    if (!str_contains($body, '{link}')) {
        $ng[] = '締めに {link} が無い（UTMが自動で付かない）';
    }
    $linkUrl = (string) ($item['link_url'] ?? '');
    if (!str_starts_with($linkUrl, NOTE_SITE_ORIGIN)) {
        $ng[] = 'link_url が ' . NOTE_SITE_ORIGIN . ' で始まっていない';
    }

    $all = $title . "\n" . $body . "\n" . (string) ($item['title'] ?? '');
    foreach (NOTE_OLD_BRANDS as $old) {
        if (str_contains($all, $old)) {
            $ng[] = '旧サイト名「' . $old . '」が残っている';
        }
    }

    if (trim((string) ($item['notes'] ?? '')) === '') {
        $ng[] = 'メモ欄（notes）が空（確かめた出典・根拠を書く）';
    } elseif (!preg_match('/出典|確認|根拠|一致|記載|基づ|国立|公式|ページ|算出|データ|書き出し/u', (string) $item['notes'])) {
        $warn[] = 'メモ欄に出典・根拠らしい記述が見当たらない';
    }

    if (!is_file($imageDir . '/' . $id . '.png')) {
        $ng[] = '見出し画像が無い（docs/sns-stock/note-images/' . $id . '.png）';
    }
    if (glob($imageDir . '/' . $id . '-*.png') === []) {
        $warn[] = '本文中の画像が無い（docs/sns-stock/note-images/' . $id . '-1.png など。NOTE_RULES.md 4章：入れられる回だけ。図解が合う回なら作る）';
    }

    $ngTotal += count($ng);
    echo ($ng === [] ? 'OK  ' : 'NG  ') . $id . '「' . $title . '」 タイトル' . $titleLen . '字・本文' . $bodyLen . '字・見出し' . $headings . '・リンク' . count($links) . "\n";
    foreach ($ng as $line) {
        echo '    NG   ' . $line . "\n";
    }
    foreach ($warn as $line) {
        echo '    注意 ' . $line . "\n";
    }
}

if ($checked === 0) {
    echo "note 本文のあるストックがありません。\n";
    exit(2);
}
echo "\n{$checked}件を確認：NG " . $ngTotal . "件\n";
exit($ngTotal === 0 ? 0 : 1);
