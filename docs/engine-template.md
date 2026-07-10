# Engine Template（新占術を追加する手順）

shichu・tarotの実装で確立した、占術エンジンの共通実装パターン。九星気学・数秘術・易・ルーン等、将来の新占術はこの手順に従う。

前提として `docs/sansei-engine-design.md`（Step0の全体設計）を先に読むこと。本ページは「手順」、Step0は「なぜそうするか」を定義する。

## 設計原則（Step0の原則をEngine実装レベルで具体化したもの）

- **Rule 1: rawは計算に必要な最小限の入力・結果だけ持つ**。信号源から導出できる派生値（例：seizaのelement/qualityはsignIndexから100%決まる）はrawへ保存せず、Engine内部でその場で導出する。使わない入力（seizaは太陽星座の判定に「年」を一切使わないため、Engineの引数から除外した）も持たせない
- **Rule 2: 有限入力ならGolden Masterは全数を基本方針とする**。目安として1万件未満なら全数を優先する（tarotの44件、seizaの1830件はいずれも全数で問題なく生成・検証できた）。それ以上、または実質無限に近い入力空間（shichuの生年月日×時刻×性別）はサンプリング（固定境界ケース＋シード固定疑似乱数）にする
- **Trait Mapping Tableは表示名ではなくインデックス／IDをキーにする**。tarotの`cardOrder`、seizaの`innerTypeIndex`のように、将来表示名（カード名・タイプ名）が変更されてもMapping Tableが壊れないようにする

## 手順

1. **既存計算ロジックの所在確認**：対象ページの計算ロジックがどこにあるか（クライアントサイドJS／サーバーサイドPHP）を確認する。JSのみの場合、PHPへの移植が必要になる（shichu・tarotは両方ともJSのみだった）
2. **データ切り出し**：静的なコンテンツデータ（カード・キーワード・解説文等）がページに直書きされている場合、`inc/{占術}-data.php`へ切り出す。手動転記はタイポのリスクがあるため、可能ならNode.js等でファイルから直接抽出する（`tests/tools/export-tarot-data.js`が実例）。Engine←Data→UIという依存方向にし、UI専用の資産にしない
3. **Golden Master作成**：正しさの基準を先に固定する
   - 入力空間が有限（例：tarotの22枚×正逆=44）なら**全数**を対象にする
   - 入力空間が無限に近い（例：shichuの生年月日）なら固定ケース＋シード固定疑似乱数でサンプリングする
   - 既存JSがある場合、Node Snapshot（採取専用。移植元ではない）経由で採取する
   - 移植中に発見した既知の不具合は、Golden Masterから除外し`tests/known-issues/`へ記録する（忠実移植完了後に別途修正する）
4. **Engine(raw)実装**：`inc/{占術}-engine.php`に`{占術}Engine(...): array`を実装し、まず`['raw'=>[...]]`のみを返す。設計変更は入れない。生年月日のような利用者入力がない占術（tarot等）は、「ランダムに引く関数」と「与えられた入力からResultDataを組み立てる純粋関数」に分離する
   - Golden Masterと100%一致することを確認する
5. **ResultData Validator適用**：`inc/resultdata-validator.php`の`validateResultData()`を使い、形式検証の対象に含める（占術固有のロジックは書かない）
6. **Trait Mapping Table作成**：`inc/{占術}-trait-mapping.php`（PHP配列。単一の情報源）として先に仕様を確定する。既存コンテンツの意味をtraitへ写像するだけで、新しい占術解釈は加えない
   - スコア基準：+2=中心的テーマ、+1=副次的テーマ
   - 全項目が必ず何らかのtraitへ寄与する必要はない（意味が薄ければ「寄与なし」でよい）
   - 負スコアは使わない（traitは「傾向の有無」を表す層。評価はAxis以降の責務）
   - `docs/{占術}-trait-mapping.md`はこのPHP配列から`tests/tools/generate-{占術}-trait-mapping-doc.php`で生成する（手で書かない）
7. **Trait Coverage確認**：`tests/tools/{占術}-trait-coverage.php`で、共有Trait辞書の全trait種が最低1回は出現していることを確認する。0件のtraitがあればMappingの偏りに気付ける
8. **Trait Snapshot作成**：Mapping Tableの独立実装（Engineのコードを呼ばない別実装）でGolden Masterのrawから期待値を算出し、`tests/cases/{占術}-traits.php`として固定。Engineのtraits出力と比較する
9. **ResultData化**：`meta`/`highlights`/`extras`を追加する
   - `meta`：`{title, subtitle}`。HTMLの`<title>`とは無関係
   - `highlights`：配列（1件でも配列で統一）。既存解説文からの抽出であり、新規に文章を生成しない
   - `extras`：`{type, label, value}`のオブジェクト配列で統一する
10. **ResultData Snapshot作成**：Golden Masterの全入力に対しEngineを実行し、完成した`{占術}Result`を`tests/cases/{占術}-resultdata-snapshot.php`として保存する。ResultData Validatorで全件検証する

## Engine DoD（完了条件）

新占術は以下すべてを満たすこと。

| 項目 | 内容 |
|---|---|
| Golden Master | 既存ロジックとの一致を確認済み（サンプリングまたは全数） |
| Engine(raw) | Golden Masterと100%一致。rawは追加のみで育てる（構造・キー名を変更しない） |
| Trait Mapping Table | PHP配列（単一の情報源）として作成。docsはそこから生成 |
| Trait Coverage | 全trait種が最低1回は出現していることを確認 |
| Trait Snapshot | Mapping Tableの独立実装との比較でPASS |
| ResultData | meta/raw/traits/highlights/extrasの5キーが揃っている |
| ResultData Validator | 全件PASS |
| ResultData Snapshot | Golden Masterの全入力に対して作成済み |

## 参考実装

- shichu：`inc/shichu-engine.php` / `inc/shichu-trait-mapping.php`（利用者入力＝生年月日＋時刻＋性別。実質無限に近い入力空間のためサンプリング方式）
- tarot：`inc/tarot-engine.php` / `inc/tarot-trait-mapping.php`（利用者入力なし、ランダム抽選と純粋関数を分離。44通りの全数検証方式）
- seiza：`inc/seiza-engine.php` / `inc/seiza-trait-mapping.php`（利用者入力＝月日＋時間帯のみ、年は不使用。1830通りの全数検証方式。ResultData Snapshotのみファイルサイズの都合で代表サンプルに絞っている）
