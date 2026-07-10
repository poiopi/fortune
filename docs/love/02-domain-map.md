# Love Domain マップ

アーキテクチャ文書。辞書（Primitive/Style/Tendencyの個別定義）・実装手順は扱わない（[03-primitives.md](03-primitives.md)以降を参照）。

## 1. ドメイン境界（Bounded Context）

恋愛エンジンは第五の占術ではない。次の3層のみで構成される。

- **Shared Axis Library**：`inc/axis-engine.php`の一部関数。全占術・全診断コンテンツで共有
- **Love Domain**：本ドキュメント群が定義する、恋愛専用の新規レイヤー
- **Presentation**：結果ページ。文章・表示形式を担う

## 2. Anti-Corruption Layer

```
MBTI
Blood
Seiza
      │
      ▼
 Shared Axis Library
      │ Axis
      ▼
 Primitive  ← Anti-Corruption Layer
      │
      ├─ Bundle
      ├─ Style
      └─ Tendency
```

- Axisは Shared Axis Library側の語彙である
- Primitiveは恋愛ドメインの語彙である。Axisの別名ではなく、恋愛ドメインでの意味付けを持つ翻訳である
- UIはAxisを知らない
- ComposerもAxisを知らない

Love Domain以降のすべての処理（Bundle／Style／Tendency／Composer）は、Primitiveの語彙のみを扱う。Axisという他ドメインの概念は、Primitiveへの翻訳が完了した時点で境界の外に出ない。

## 3. Level1 / Level2

| Level | 再利用 | 例 |
|---|---|---|
| Level1 | ○ | `axis_aggregateTraits()` / `axis_computeAxes()` / `axis_computeInfluence()` |
| Level2 | × | `axis_getIdentityBundle()` / `axis_computeScores()` / `sanseiEngine()` |

Love EngineはLevel1のみを利用し、Level2はLove Domain側で再実装する。

## 4. データフロー

責務のみを示す。導出式は[03-primitives.md](03-primitives.md)以降の辞書側の責務であり、ここには書かない。

```
Source Engines
        │  Traits（source別）
        ├──────────────┐
        ▼              ▼
    aggregate      computeInfluence
        ▼              │
      Axes             │
        │              │
    Primitive          │
      ├─ Bundle        │
      ├─ Style         │
      └─ Tendency      │
        │              │
        └──────┬───────┘
               ▼
          Normalizer
               │
           Composer
               │
         Writing Rules
               │
            Result
```

NormalizerがStyle／Tendencyの生スコアをHigh/Mid/Lowへ変換した後、Composerがその区分に対応する文言を選び、ResultDocumentとして組み立てる。Composerの時点で既に文言が決まっているため、区分（Normalizer）は必ずComposerより前に完了している必要がある。

Influenceは Source EnginesのTraitsから直接算出される（Level1の`axis_computeInfluence()`）。Primitive／Bundle／Style／Tendencyという Love Domainの変換を一切経由しない。Composerが両方の系列（Love Domainの出力とInfluence）を受け取って統合する。

## 5. Presentation

- **Normalizer**：Primitive／Style／Tendencyの生スコアをHigh/Mid/Lowへ変換する。境界値の決定方法はここが持つ
- **Composer**：Bundle・Style・Tendency・Influenceを統合し、ResultDocument（論理構造）を組み立てる。Bundleの選定根拠には関与しない（原則9条）。文章の最終的な整形は行わない
- **Writing Rules**：断定を避ける、ポジティブに言い換える、接続詞・文体・冗長さ・改行を整える等の表示規約（別文書）

## 6. 依存方向

Presentation層は、Love Domainが生成したドメイン値を文章・表示形式へ変換する。すべての出力が必ずLove Domainを経由するわけではなく、Influence（Shared Axis Library由来）はLove Domainを経由せず直接Presentationへ渡る（4節参照）。

依存方向のルールそのものは[01-principles.md](01-principles.md)の原則10を参照。
