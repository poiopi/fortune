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

| Rule ID | raw項目 | index | 根拠keyword | trait | score |
|---|---|---|---|---|---:|
| Z001 | element | 0 | 火・情熱・創造・直感 | 情熱 | +2 |
| Z002 | element | 1 | 地・安定・現実・継続 | 安定性 | +2 |
| Z003 | element | 2 | 風・知性・変化 | 変化 | +1 |
| Z004 | element | 3 | 水・感情・直感・共感 | 直感 | +2 |
| Z005 | quality | 0 | 活動宮・行動を起こすイニシアチブ | 行動力 | +1 |
| Z006 | quality | 1 | 不動宮・やり抜く強さ・粘り強さ | 安定性 | +1 |
| Z007 | quality | 2 | 柔軟宮・変化に適応する柔軟さ | 変化 | +1 |
| Z008 | innerTypeIndex | 0 | 情熱型・行動が先で熱い | 情熱 | +2 |
| Z009 | innerTypeIndex | 1 | 安定型・揺るぎない価値観 | 安定性 | +2 |
| Z010 | innerTypeIndex | 2 | 表現型・自分の世界を外に出す | 独立 | +1 |
| Z011 | innerTypeIndex | 3 | 感受型・周囲のエネルギーを敏感に受け取る | 直感 | +1 |
| Z012 | innerTypeIndex | 4 | 分析型・根拠を持って判断する | 慎重さ | +2 |
| Z013 | innerTypeIndex | 5 | 調和型・場のバランスを保つ | 安定性 | +1 |
| Z014 | innerTypeIndex | 6 | 探究型・未知への好奇心 | 直感 | +1 |
| Z015 | innerTypeIndex | 7 | 責任型・責任感が強い | 責任感 | +2 |
| Z016 | innerTypeIndex | 8 | 自由型・枠や制約を嫌う | 独立 | +2 |
| Z017 | innerTypeIndex | 9 | 挑戦型・困難があるほど燃える | 挑戦 | +2 |
| Z018 | innerTypeIndex | 10 | 革新型・変化を起こすことに情熱 | 変化 | +2 |
| Z019 | innerTypeIndex | 11 | 直感型・論理より感覚で捉える | 直感 | +2 |

## Trait Coverage

`tests/tools/seiza-trait-coverage.php` で確認（全9種のtraitが最低1回は出現していることを毎回確認する）。