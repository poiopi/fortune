<?php
declare(strict_types=1);
/**
 * Daily Quiz 視覚デザイン比較モックアップ 専用ブートストラップ
 *
 * これは本番テンプレート（_quiz-tpl.php 等）とは完全に独立した比較検討用ファイルである。
 * 実データ確認のため既存の data.php を「読み取り専用」で require するのみで、
 * data.php 自体・本番テンプレート・sitemap.xml 等には一切変更を加えない。
 *
 * 対象データ：quiz/hatsutaimen-saisho-ni-miru-mono/data.php（A-001）
 */

$quiz = require __DIR__ . '/../hatsutaimen-saisho-ni-miru-mono/data.php';

/**
 * 比較モックアップ限定の簡易処理。
 *
 * choices の文言（例：「その人の『目』」）から核となる単語（「目」）だけを抜き出し、
 * ②回答ページの「あなたが選んだのは『◯◯』」の二重鉤括弧を解消するために使う。
 *
 * 注意：これは実データ構造を変更する話ではなく、今回の3案モックアップにおける
 * 表示方法の実験に過ぎない。恒久実装でこの短縮ラベルをどう構造化するか
 * （data.phpに新規フィールドを追加するか等）は、この場では決定しない。
 */
function quizmock_short_label(string $full): string
{
    if (preg_match('/『(.+?)』/u', $full, $m)) {
        return $m[1];
    }
    return $full;
}

// ローカル確認用：?a=a1〜a4 で回答結果ページの表示を切り替える（本番のGET仕様とは無関係の簡易実装）
$quizChoiceParam = $_GET['a'] ?? 'a1';
if (!in_array($quizChoiceParam, ['a1', 'a2', 'a3', 'a4'], true)) {
    $quizChoiceParam = 'a1';
}

$quizNumberStr = str_pad((string)$quiz['number'], 3, '0', STR_PAD_LEFT);
