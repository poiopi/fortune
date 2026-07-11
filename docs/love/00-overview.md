# 恋愛診断エンジン設計（Love Domain / v1）

> MBTI×血液型×星座を統合した恋愛特化の診断コンテンツ。既存`mbti.php`（MBTI×星座の汎用性格診断）とは目的が異なる別ページとして新設する。

着手前に必ず`docs/engine-template.md`（占術エンジン新設の正式手順）と`docs/sansei-engine-design.md`（Axis統合の元設計）を読むこと。本ドキュメント群はその2つの上に積み重なる、恋愛ドメイン固有の設計を扱う。

## 1. この機能の位置づけ

恋愛診断は「第5の占術」ではない。MBTI・血液型・星座という3つの入力は、既存の`docs/engine-template.md`の手順でEngine化され、`docs/sansei-engine-design.md`が定義するraw→traits→Axisという変換を経る。恋愛ドメインが担当するのは、そこから先（Axis以降）だけである。

```
Source Engines（MBTI Engine / Blood Engine / Seiza Engine）
        │  各EngineがResultData（meta/raw/traits/highlights/extras）を返す
        ▼
Shared Axis Library（inc/axis-engine.php の一部関数のみ）
        │  traits → Axis → Influence
        ▼
Love Domain（本ドキュメント群が定義する新規レイヤー）
        │  Axis → Primitive → Style / Tendency
        ▼
Presentation（Composer・Writing Rules・Normalizer／結果ページ：Bundle本文・スコア表示・記事リンク）
```

Domainは「値を決める」層（Primitive／Style／Tendency）、Presentationは「値をどう見せるか」を担う層（Composer／Writing Rules／Normalizer）と責務を分ける。Composerは文章を組み立てるだけでドメイン値の計算は行わない。

## 2. Shared Axis Libraryの再利用範囲（誤解しやすい点）

`inc/axis-engine.php`は「まるごと共有」ではない。関数によって再利用できる範囲が異なる。

```text
Shared Axis Library
├── Level 1: Axis計算ライブラリ（完全再利用・sansei固有のデータを参照しない）
│   ├── axis_aggregateTraits()
│   ├── axis_computeAxes()
│   └── axis_computeInfluence()
│
└── Level 2: Sanseiドメイン実装（再利用しない・内部でIDENTITY_BUNDLES/TODAY_BUNDLES/CATEGORY_MAPPINGというsansei専用定数を直接参照する）
    ├── axis_getIdentityBundle()
    ├── axis_getTodayBundle()
    ├── axis_computeScores()
    └── sanseiEngine()（上記を束ねる公開API自体もLevel 2）
```

恋愛ドメインが呼び出してよいのはLevel 1の3関数のみ。`sanseiEngine()`をそのまま呼び出すと、恋愛の入力に対してsanseiのアーキタイプ・スコアが返ってしまうため、絶対に呼ばない。Level 2相当の処理（Bundle選定・Style/Tendency算出）は、恋愛専用のデータテーブルを参照する新規関数として、恋愛ドメイン側のファイルに実装する（詳細は[02-domain-map.md](02-domain-map.md)）。

## 3. ドキュメント構成

| ファイル | 内容 | 状態 |
|---|---|---|
| 00-overview.md | 本ファイル。全体像・前提・用語の位置づけ | 作成済み |
| [01-principles.md](01-principles.md) | 設計原則12条 | 作成済み |
| [02-domain-map.md](02-domain-map.md) | DDD構造（Anti-Corruption Layer）、Shared/Love/Presentationの3層、Level1/Level2の詳細 | 作成済み |
| [03-primitives.md](03-primitives.md) | 性格プリミティブ辞書（5項目、Axisと1:1、permanent値のみ使用） | 作成済み。実装は`inc/love-primitive-mapping.php` |
| [04-style.md](04-style.md) | 恋愛スタイル辞書（Primitiveの組み合わせ） | 作成済み（設計のみ、実装は未着手） |
| [05-tendency.md](05-tendency.md) | 推定傾向辞書（結婚志向等、価値観寄りの項目） | 作成済み（設計のみ、実装は未着手） |
| [06-composer.md](06-composer.md) | Result Composer仕様（Bundle・Style・Tendencyを統合して文章生成） | 作成済み（設計のみ、実装は未着手） |
| [07-implementation.md](07-implementation.md) | 実装順序（MBTI/Blood EngineのEngine化完了を前提とする） | 作成済み。MBTI/Blood Engineとも実装完了 |
| [08-normalizer.md](08-normalizer.md) | Normalizer仕様（Primitive/Style/Tendencyごとの百分位閾値、9216通り実測に基づく） | 作成済み。実装は`inc/love-normalizer.php` |
| [09-writing-rules.md](09-writing-rules.md) | Writing Rules（表示規約7条。Text Bank執筆・最終整形の2箇所で適用） | 作成済み |
| [10-bundle.md](10-bundle.md) | Bundle仕様（上位2 Primitive方式、20通り、Text ID共有） | 作成済み。実装は`inc/love-bundle.php` |
| [RELEASE-v1.0.0.md](RELEASE-v1.0.0.md) | v1.0.0マイルストーンのリリースノート（特定時点のスナップショット、以後更新しない） | 作成済み |
| [11-articles.md](11-articles.md) | Love Content Platform v1：`/articles/love/`のURL設計・記事テンプレート・独自価値/一次データ利用/禁止事項・優先順位・記事チェックリスト | MBTI16記事・Style7記事・Tendency2記事、計25記事完了。横断レビュー済み。次は星座12記事 |

## 4. 用語

ドメイン（値を決める）とプレゼンテーション（どう見せるか）を分けて記載する。「どう書くか」の規約はWriting Rules文書（未作成）に完全に移し、ここには書かない。

### ドメイン

- **Source Engine**：MBTI Engine／Blood Engine／Seiza Engine。`docs/engine-template.md`の10手順でResultDataを返す
- **Primitive**：Shared Axisを恋愛ドメインの語彙へ翻訳した基本特性
- **Style**：複数のPrimitiveから導かれる恋愛スタイル
- **Tendency**：性格プリミティブから推定される恋愛傾向。価値観・経験・年齢などの影響を受ける概念であり、Styleとは区別して扱う

### プレゼンテーション

- **Composer**：Bundle・Style・Tendencyを統合して最終結果を生成するPresentation層
- **Normalizer**：Primitive/Style/Tendencyの生スコアをHigh/Mid/Lowへ変換する。境界値の決定方法はここが持つ
- **Writing Rules**：断定を避ける、ポジティブに言い換える等の表示規約（別文書）
