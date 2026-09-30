# Love Engine v1.1.0 リリースノート

タグ：未作成（2026-10-01時点ではSTG用コード `test.life-fun.net/` への反映のみ。コミット・STG同期・本番反映は未実施）

このファイルは`docs/love/00〜12`（生きた仕様書、今後も更新される）とは性質が異なる。ここは**特定時点のスナップショット記録**であり、以後更新しない（新しい変更は次のリリースノートか、各仕様書自体の更新履歴に委ねる）。

## 概要

星座（Seiza）のTrait Mappingで、火と水のエレメントがAxis変換後に同じ値になり、恋愛診断（Love Engine）と三星統合鑑定で火の星座と水の星座の区別が消えていた不具合を修正した。修正はエンジン（Trait Mapping）とテスト基準データまで。**解説記事の数値・本文の更新は未実施で、次段階で行う。**

## 不具合

- 症状：恋愛診断で 牡羊座≡蟹座、獅子座≡蠍座、射手座≡魚座 になっていた（9216通りのうち、各星座768件のPrimitive値が、組になる星座と完全に一致）。三星統合鑑定でも同じ原因で火と水の区別が消えていた
- 判明：2026-09-30（SNS投稿ストック作成時に発見）
- 経緯：2026年7月の星座記事作成時にこの一致は見つかっていたが、不具合ではなく「記事の独自性」として扱われていた（[11-articles.md](11-articles.md) 4節の星座12記事の段落。2026-10-01に訂正注記を追加）

## 原因

- `inc/seiza-trait-mapping.php`：火（element 0）＝Z001 情熱（TRAIT_PASSION）+2、水（element 3）＝Z004 直感（TRAIT_INTUITION）+2
- `inc/axis-mapping.php`：A006（TRAIT_INTUITION）とA007（TRAIT_PASSION）がどちらもAXIS_SENSITIVITY（感応性）へ変換される
- 結果：火と水はどちらも「感応性+2」になり、クオリティ（活動宮・不動宮・柔軟宮）が同じ火と水の星座は、element＋qualityからの寄与が完全に同じになっていた

## 修正

- `test.life-fun.net/inc/seiza-trait-mapping.php` の火（element 0）に、Z001を残したまま次のルールを追加した
  - `Z020`：keyword「火・行動的・自ら動く」、TRAIT_ACTION（行動力）、+1
- 水（Z004）・`inc/axis-mapping.php` は変更していない
- `docs/seiza-trait-mapping.md` を `tests/tools/generate-seiza-trait-mapping-doc.php` で再生成した（手編集なし）
- ルート直下（本番用）の `inc/seiza-trait-mapping.php` は未変更。STG確認後に別途反映する

## 影響範囲（実測値）

### 恋愛診断（Love Engine、9216通り全数）

- 星座単位のPrimitive分布（各768件）で、同一になる星座の組：修正前 3組（魚座=射手座、牡羊座=蟹座、獅子座=蠍座）→ 修正後 なし
- primitivesNormalized・stylesNormalized・tendenciesNormalized・bundleId のいずれかが変わる件数：**1,622件**（牡羊座457・獅子座577・射手座588、ほかの9星座は0件）
  - 内訳（項目別、延べ）：primitives（生スコア）2,304件（火の3星座の全件）、primitivesNormalized 984件、stylesNormalized 956件、tendenciesNormalized 179件、bundleId 500件、bundleTextId 497件、influence 1,152件
- Bundle ID の出現件数の変化（修正前→修正後）：

| Bundle ID | 修正前 | 修正後 |
|---|---:|---:|
| LOVE_ACT_AUT | 10 | 10 |
| LOVE_ACT_REL | 714 | 795 |
| LOVE_ACT_SEN | 649 | 762 |
| LOVE_ACT_TRA | 110 | 134 |
| LOVE_AUT_ACT | 0 | 3 |
| LOVE_AUT_REL | 14 | 12 |
| LOVE_AUT_SEN | 4 | 3 |
| LOVE_AUT_TRA | 14 | 14 |
| LOVE_REL_ACT | 1666 | 1741 |
| LOVE_REL_AUT | 201 | 187 |
| LOVE_REL_SEN | 2417 | 2291 |
| LOVE_REL_TRA | 437 | 421 |
| LOVE_SEN_ACT | 1175 | 1221 |
| LOVE_SEN_AUT | 46 | 39 |
| LOVE_SEN_REL | 996 | 887 |
| LOVE_SEN_TRA | 356 | 313 |
| LOVE_TRA_ACT | 156 | 136 |
| LOVE_TRA_AUT | 12 | 12 |
| LOVE_TRA_REL | 148 | 146 |
| LOVE_TRA_SEN | 91 | 89 |

  - LOVE_AUT_ACT は修正前「実測0件」だったが、修正後は3件（INTJ/INTP/ISTP × B型 × 牡羊座 × 内面タイプ8）。bundleTextId は既存の共有文 `text_aut_shared` に割り当てられる（`inc/love-bundle.php` の既存定義どおり）

### 三星統合鑑定（sanseiEngine）

- 既存テストの50組み合わせ（四柱推命・タロットの入力）に対し、各星座の誕生日（各月5日、時間帯U）を当てはめて比較した場合の変化件数（meta を除く archetype/summary/advice/scores/influence で比較）：牡羊座13/50・獅子座17/50・射手座50/50、ほかの9星座は0/50（meta を含めると牡羊座29/50・獅子座21/50・射手座50/50、ほかの9星座は0/50）
- 追加した12星座テストケース（下記）では、牡羊座（archetype・summary・influence・meta）と射手座（influence・meta）が変化、獅子座を含むほかの10件は変化なし

## テスト基準データの再生成

実質差分（generatedAt 以外の差分）があるものだけを既存の export ツールで再生成した。

| ファイル | 結果 |
|---|---|
| `tests/cases/seiza-traits.php` | 再生成（1830件中、火の星座の日付の455件が変化） |
| `tests/cases/seiza-resultdata-snapshot.php` | 再生成（牡羊座150・獅子座155・射手座150件が変化） |
| `tests/cases/love-primitives-snapshot.php` | 再生成（火の3星座の2,304件が変化） |
| `tests/cases/love-style-tendency-snapshot.php` | 再生成（同上2,304件） |
| `tests/cases/love-composer-snapshot.php` | 再生成（1,718件が変化、すべて火の星座） |
| `tests/cases/love-final-snapshot.php` | 再生成（上記の1,622件のほか、下記「注意」の articleLinkSources 差分を含む） |
| `tests/cases/axis-aggregation-snapshot.php` ほか axis-values・bundle-id・sansei-resultdata | 既存50件は全件山羊座のため差分なし。下記のテスト追加で62件に拡張して再生成（既存50件は内容そのまま） |

- 旧実装のGolden Master（`tests/tools/export-*.js`）は対象外
- 注意：`love-final-snapshot.php` は旧版（2026-07-11生成）の時点から `articleLinkSources` が現行コードと食い違っていた（2026-07-12 の `inc/love-article-links.php` 修正で血液型記事リンクが追加された後、再生成されていなかった）。今回の再生成で全9216件の `articleLinkSources` に `blood` が加わっている。これはZ020とは無関係の差分

## テストの追加

- `tests/tools/export-axis-aggregation.php`：既存の50件（seiza-resultdata の先頭50件＝全件山羊座）はそのまま残し、12星座カバレッジとして signIndex 0〜11 それぞれの最初の1件（1/1・1/20・2/19・3/21・4/20・5/21・6/22・7/23・8/23・9/23・10/24・11/22、時間帯M）を追加した。四柱推命・タロットは既存ループと同じく通し番号（50〜61）の剰余で選ぶ
- axis-values・bundle-id・sansei-resultdata は axis-aggregation の cases を入力にしているため、自動的に62件になる
- `php tests/run-all.php`：修正前・修正後とも ALL PASS

## 未実施・次段階

### 記事の数値・本文の更新（未実施）

`test.life-fun.net/articles/love/` 配下（本番 `articles/love/` も同様）で、次の更新が必要になる。

- 星座12記事（`seiza/`）
  - 火の3記事（aries・leo・sagittarius）：本文の因果説明から書き直し（「蟹座／蠍座／魚座と完全に一致」の記述を含む）
  - 水の3記事（cancer・scorpio・pisces）：「牡羊座／獅子座／射手座と完全に一致」「数値はすべて〇〇座の記事と同じ」の記述の書き直し
  - 残りの記事：「全体平均」の数値の更新
  - 星座一覧（`seiza/index.php`）
- MBTI別16記事（`mbti/`）・血液型別4記事（`blood/`）：割合の更新（計画書の試算で16/16、4/4に変化あり）
- Style 7記事（`style/`）・Tendency 2記事（`tendency/`）：9216件の実測分布の更新
- Bundle 5記事（`bundle/`）：出現率の更新（LOVE_AUT_ACT 0件→3件を含む）
- Guide 6記事（`guide/`）：特に「9216パターンの仕組み」「Bundleとは」の数値
- MBTI×血液型64記事（`mbti-blood/`）：`tools/build-combo-data.php`（`love-final-snapshot.php` を読む）→`docs/love/combo-data-64.json`→`tools/generate-combo-articles.php` で再生成できるか確認する
- 各カテゴリの一覧ページ（`index.php`）
- 仕様書：`docs/love/10-bundle.md`（出現率）、`docs/love/12-combo-classification.md`、`docs/love/combo-data-64.json`・`combo-master-64.json`
- SNS投稿ストック `docs/sns-stock/2026-10.json` の「12星座別・恋愛の傾向」（2026-10-personality-002）は、数値を取り直してから公開する

### Normalizer 閾値の見直し（判断待ち）

`docs/love/08-normalizer.md` は「Trait Mappingが変わった場合、スナップショットを再生成し、閾値表を見直す必要があるかを確認する」と定めている。修正後の9216件で P33/P67 を算出し直すと、次の項目が現行の閾値（`inc/love-normalizer.php`）と食い違う。

| 項目 | 現行閾値（P33 / P67） | 修正後の実測（P33 / P67） |
|---|---|---|
| 行動主導性（Primitive） | 2 / 4 | 3 / 4 |
| 積極性（Style） | 3.20 / 4.40 | 3.20 / 4.60 |
| 愛情表現（Style） | 3.40 / 4.80 | 3.40 / 4.90 |
| 浮気耐性（Tendency） | 1.70 / 3.90 | 1.60 / 3.70 |

ほかの10項目は一致。今回の修正では閾値を変更していない（上記「影響範囲」の件数はすべて現行閾値のまま）。閾値を更新するかどうかは未決定で、更新する場合は影響範囲が変わるため、記事の数値更新より前に決める必要がある。

**→ 2026-10-01 決定・実施（ユーザー承認）：閾値を更新した。** あわせて、判定時の浮動小数点誤差の不具合を修正した。上の「影響範囲」の Normalizer 関連の件数（primitivesNormalized・stylesNormalized・tendenciesNormalized）は、この更新前の値であり、最終値は下記。

- 閾値の更新（`test.life-fun.net/inc/love-normalizer.php`）：行動主導性P33 2→3、積極性P67 4.40→4.60、愛情表現P67 4.80→4.90、浮気耐性 1.70/3.90→1.60/3.70、結婚志向P33 2.14→2.17（分類結果は同一）。詳細は [08-normalizer.md](08-normalizer.md)
- 浮動小数点誤差の修正：`love_classify()` で比較前に `round(score, 6)` を行う。修正前は、閾値と同値のスコアの一部がHighに誤判定されていた（本番の修正前エンジンで692件／9216件。包容力366・恋愛の慎重さ348・浮気耐性86）
- 検証：修正後のエンジンの判定は、丸めた値による判定と9216件すべてで一致。`php tests/run-all.php` ALL PASS
- 再生成：`tests/cases/love-composer-snapshot.php`、`tests/cases/love-final-snapshot.php`（Normalizer以外の項目＝primitives・bundleId・bundleTextId・influence・articleLinkSources に差分がないことを確認）
- **最終的な影響（本番の修正前エンジンと比べて、診断結果に表示されるStyle 7項目・Tendency 2項目の区分が変わる件数）：1,860件／9216件**
  - 星座別：山羊座106・水瓶座100・魚座85・牡羊座223・牡牛座140・双子座73・蟹座125・獅子座374・乙女座67・天秤座114・蠍座120・射手座333
  - 項目別：積極性918・愛情表現418・包容力366・恋愛の慎重さ348・浮気耐性263
  - 火の星座の修正・閾値の更新・誤差の修正の3つの合計。火以外の星座の変化は、閾値の更新と誤差の修正によるもの

### その他

- STG（test.life-fun.net）への同期、本番（ルート直下 `inc/`）への反映は未実施
- コメント内の「Rule ID: Z001〜Z019」表記が `inc/seiza-engine.php`（42行目）・`tests/tools/export-seiza-traits.php`・`tests/tools/seiza-trait-coverage.php` に残っている（動作には影響しない）

## 関連ファイル

- 修正：`test.life-fun.net/inc/seiza-trait-mapping.php`、`docs/seiza-trait-mapping.md`、`test.life-fun.net/inc/love-normalizer.php`、`docs/love/08-normalizer.md`
- テスト：`tests/tools/export-axis-aggregation.php`、`tests/tools/export-sansei-resultdata.php`、`tests/cases/` 配下の再生成ファイル
- 前版：[RELEASE-v1.0.0.md](RELEASE-v1.0.0.md)
