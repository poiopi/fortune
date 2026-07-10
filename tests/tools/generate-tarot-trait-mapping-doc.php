<?php
declare(strict_types=1);

/**
 * generate-tarot-trait-mapping-doc.php
 *
 * inc/tarot-trait-mapping.php（単一の情報源）から docs/tarot-trait-mapping.md を生成する。
 * 手で表を書き写すとdocsと実装がずれるため、常にこのスクリプトで再生成する。
 *
 * 実行方法: php tests/tools/generate-tarot-trait-mapping-doc.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-trait-mapping.php';

$cardNames = [
    0=>'愚者',1=>'魔術師',2=>'女教皇',3=>'女帝',4=>'皇帝',5=>'法王',6=>'恋人',7=>'戦車',
    8=>'力',9=>'隠者',10=>'運命の輪',11=>'正義',12=>'吊られた男',13=>'死神',14=>'節制',
    15=>'悪魔',16=>'塔',17=>'星',18=>'月',19=>'太陽',20=>'審判',21=>'世界',
];

$rows = [];
foreach (TAROT_TRAIT_MAPPING as $order => $orientations) {
    foreach ([['upright', '正'], ['reversed', '逆']] as [$dir, $label]) {
        $rules = $orientations[$dir];
        $cardLabel = "{$cardNames[$order]}({$label})";
        if (count($rules) === 0) {
            $rows[] = "| — | {$cardLabel} | （寄与なし） | — | — |";
            continue;
        }
        foreach ($rules as $rule) {
            $rows[] = "| {$rule['id']} | {$cardLabel} | {$rule['keyword']} | {$rule['trait']} | +{$rule['score']} |";
        }
    }
}

$md = <<<MD
# tarot Trait Mapping Table（仕様）

`docs/sansei-engine-design.md` §6 の具体化。タロット大アルカナ22枚×正逆=44状態から`traits`を導出する対応表。

**この表はコード生成物です。** 単一の情報源は `inc/tarot-trait-mapping.php`。
表を修正する場合は先にそのPHP配列を編集し、`tests/tools/generate-tarot-trait-mapping-doc.php` を再実行してこのファイルを更新すること。手でこのMarkdownだけを編集しない。

## スコア基準

- **+2** = カードの中心テーマ
- **+1** = 副次的テーマ
- 全カードが必ず何らかのtraitへ寄与する必要はない。意味が薄い場合は「寄与なし」を許容する

## 逆位置の扱いについて

逆位置は一律に「正位置の逆」ではない（エネルギーの停滞・内向化・遅延・過剰・解放・克服など様々な意味を持つ）。カードごとに実際の逆位置の意味を個別に判断し、機械的な符号反転は行わない。

負スコアは使わない。traitは「傾向の有無」を表す層であり、評価（良い/悪い）はAxis以降（Summary・Advice）の責務とする。

## Mapping Table


MD;

$md .= "| Rule ID | カード(向き) | 根拠keyword | trait | score |\n";
$md .= "|---|---|---|---|---:|\n";
$md .= implode("\n", $rows) . "\n";

$md .= <<<MD

## Trait Coverage

`tests/tools/tarot-trait-coverage.php` で確認（全9種のtraitが最低1回は出現していることを毎回確認する）。

## 今後の拡張

seizaも同じ形式（Rule ID: Z001〜）でMapping Tableを作成する。
MD;

file_put_contents(__DIR__ . '/../../docs/tarot-trait-mapping.md', $md);
echo "Wrote docs/tarot-trait-mapping.md (" . count($rows) . " rows)\n";
