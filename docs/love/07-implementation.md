# 実装配置

MBTI・血液型は`docs/engine-template.md`の10手順を完了したResultDataを入力とする。本ドキュメントはShared Engineの実装ではなく、その上位に位置するLove Domainの実装配置を扱う。

## ファイル配置

既存の`inc/`はサブディレクトリを持たないフラット構成（`{占術}-{種別}.php`）である。`inc/love/`のような新規サブディレクトリは作らず、既存の命名規則に合わせる。

| ファイル | 内容 | 相当する既存ファイル |
|---|---|---|
| `inc/mbti-engine.php` / `inc/mbti-trait-mapping.php` | MBTI EngineのResultData・Trait Mapping | `inc/shichu-engine.php`等 |
| `inc/blood-engine.php` / `inc/blood-trait-mapping.php` | 血液型EngineのResultData・Trait Mapping | 同上（新規カテゴリ） |
| `inc/love-primitive-mapping.php` | Axis→Primitiveの1:1翻訳（[03-primitives.md](03-primitives.md)） | `inc/axis-mapping.php` |
| `inc/love-style.php` | Style導出式（[04-style.md](04-style.md)） | `inc/category-mapping.php` |
| `inc/love-tendency.php` | Tendency導出式（[05-tendency.md](05-tendency.md)） | 同上 |
| `inc/love-normalizer.php` | Primitive／Style／Tendency、3種の正規化（後述） | - |
| `inc/love-bundle-data.php` | Bundleの文言データ | `inc/axis-bundle-data.php` |
| `inc/love-style-texts.php` / `inc/love-tendency-texts.php` | Style／TendencyのHigh/Mid/Low文言バンク | `inc/tarot-data.php`等 |
| `inc/love-composer.php` | ResultDocument組立（[06-composer.md](06-composer.md)） | - |

Composerは文言バンクからIDでテキストを取得するだけであり、文章を生成しない（06-composer.mdの責務通り）。

## Normalizerは3種に分ける

Primitive／Style／Tendencyは分布が異なるため、単一の閾値テーブルでは正規化できない。

- **Primitive Normalizer**：Axisごとに使用Traitの数が非対称（誠実性は3trait、自立性・変化志向は1traitのみ）なため、Primitiveごとに到達しうるスコアレンジが違う
- **Style Normalizer**：2 Primitiveの加重合成であり、Primitiveとは異なる分布になる
- **Tendency Normalizer**：Styleと導出の仕組みは同じだが、値の意味が異なるため別テーブルとして管理する

`inc/love-normalizer.php`に1ファイルへ集約し、`NORMALIZE_PRIMITIVE_THRESHOLDS`／`NORMALIZE_STYLE_THRESHOLDS`／`NORMALIZE_TENDENCY_THRESHOLDS`のように定数を分ける（`axis-engine.php`が複数の関数を1ファイルに集約する既存パターンに合わせる）。閾値は768通り（MBTI16×血液型4×星座12）の全列挙結果から較正する。

## 手順（`docs/engine-template.md`の10手順に追加する恋愛ドメイン特有の工程）

11. **Text Bank作成**：Bundle文・Style（H/M/L）・Tendency（H/M/L）の文言バンクを作成する。Writing Rulesの規約（断定を避ける、ポジティブに言い換える等）に従って書く
12. **Composer接続**：Normalizer → Text Bank → Composerの順に接続する。Composerが文言バンクを直接生成しないことを確認する

## 未解決の前提（実装前に決めること）

- ~~ソース間重み調整（MBTI・血液型・星座の寄与率）は、768通り列挙による「暗黙の均衡ライン」測定後に判断する~~ → **測定完了・判断済み（2026-07-10）**。9216通り全数でMBTIのStructural Influenceが常に1位（星5固定）と実測確定。重み係数は導入しない（設計思想への波及が大きすぎるため）。代わりにInfluenceをStructural／Presentationの2種に分離した（[02-domain-map.md](02-domain-map.md)4b節）
- **Presentation Influence（UI表示用影響度）の仕様**：新規の検討項目。記事リンクの並び順・「最も影響した要素」表示に使う、ソース間比較可能な正規化済み影響度。重み付け・順位付け・表示方法のいずれを採るかはText Bank・Writing Rules完了後に決める
- Style/Tendency文言バンクの著者・レビュー体制（Writing Rules文書は未作成）
