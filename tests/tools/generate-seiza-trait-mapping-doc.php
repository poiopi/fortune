<?php
declare(strict_types=1);

/**
 * generate-seiza-trait-mapping-doc.php
 *
 * inc/seiza-trait-mapping.php（単一の情報源）から docs/seiza-trait-mapping.md を生成する。
 * shichu・tarotと同じ方式。
 *
 * 実行方法: php tests/tools/generate-seiza-trait-mapping-doc.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-trait-mapping.php';

$groupLabels = ['element' => 'element', 'quality' => 'quality', 'innerType' => 'innerTypeIndex'];

$rows = [];
foreach (['element', 'quality', 'innerType'] as $group) {
    foreach (SEIZA_TRAIT_MAPPING[$group] as $key => $rules) {
        if (count($rules) === 0) {
            $rows[] = "| — | {$groupLabels[$group]} | {$key} | （寄与なし） | — | — |";
            continue;
        }
        foreach ($rules as $rule) {
            $rows[] = "| {$rule['id']} | {$groupLabels[$group]} | {$key} | {$rule['keyword']} | {$rule['trait']} | +{$rule['score']} |";
        }
    }
}

$md = <<<MD
# seiza Trait Mapping Table（仕様）

`docs/sansei-engine-design.md` §6 の具体化。西洋星座の`raw`（signIndex→element/quality、innerTypeIndex）から`traits`を導出する対応表。

**この表はコード生成物です。** 単一の情報源は `inc/seiza-trait-mapping.php`。
表を修正する場合は先にそのPHP配列を編集し、`tests/tools/generate-seiza-trait-mapping-doc.php` を再実行してこのファイルを更新すること。手でこのMarkdownだけを編集しない。

## キーは「インデックス」であり表示名ではない

`element`・`quality`・`innerTypeIndex`という数値インデックスのみをキーにする（'情熱型'等の表示名では判定しない）。表示名が将来変更されても、この対応表は壊れない（tarotがcardOrderをキーにし、カード名で判定しないのと同じ設計）。

`element`・`quality`は`signIndex`から導出される派生値であり、`raw`には保存しない（`raw`は計算に必要な最小限の事実のみを持つ）。

`timeZoneIndex`はtraitsマッピングの対象外（性格特性ではなく文脈情報のため）。

## スコア基準

- **+2** = 中心的テーマ
- **+1** = 副次的テーマ

## Mapping Table


MD;

$md .= "| Rule ID | raw項目 | index | 根拠keyword | trait | score |\n";
$md .= "|---|---|---|---|---|---:|\n";
$md .= implode("\n", $rows) . "\n";

$md .= <<<MD

## Trait Coverage

`tests/tools/seiza-trait-coverage.php` で確認（全9種のtraitが最低1回は出現していることを毎回確認する）。
MD;

file_put_contents(__DIR__ . '/../../docs/seiza-trait-mapping.md', $md);
echo "Wrote docs/seiza-trait-mapping.md (" . count($rows) . " rows)\n";
