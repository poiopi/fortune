# 三星統合鑑定エンジン設計（Step0 / v1）

> 本設計は三星統合鑑定向けに策定したが、責務分離・データフローの構造は占術横断で再利用可能な汎用アーキテクチャであり、将来九星気学・数秘術等を組み合わせた複合診断コンテンツにも基盤として流用できる。

## 1. 目的

三星統合鑑定を「3占術の結果を並べたランチャー」から、「西洋占星術×四柱推命×タロットを統合解釈した、唯一無二の総合鑑定（レポート）」へアップグレードする。個別占術ページ（seiza.php／shichu.php／tarot.php）との自己競合を避けつつ、サイトの看板コンテンツとして差別化する。

## 2. 設計原則

- 三星は占術知識を持たないオーケストレーターである（偏官・カード名などの意味を三星は解釈しない）
- 占術は「raw → traits」までの責任を持つ（意味の解釈は占術側に閉じる）
- 三星は「traits → IntegratedResult」までの責任を持つ
- 三星は各占術が返したResultDataを書き換えない。集約・重み付け・統合・文章化のみを担当する
- raw は占術側だけが生成する。三星は raw を参照してもよいが、raw から新たな占術解釈を再計算しない
- raw はサーバーサイドの占術エンジンのみが生成する。UI（JavaScript）は計算結果の表示・補助を行ってよいが、正となる占術計算はサーバー側エンジンが担う（ブラウザのみに存在する計算は「唯一の事実ソース」たり得ない。API・バッチ・キャッシュ・CLI・テスト等、将来のあらゆる利用先から参照できることを保証するため）
- 時間軸は占術単位ではなく、各traitの属性として管理する
- 新規占術追加時の変更範囲は最小限にする（Trait辞書への追加＋trait→Axis重み表への追加のみ）
- 新規UIクラス・新規コンポーネントを増やす前に、既存デザインシステム（`.block`、Hero構造、`article-cta.php`等）での実現を優先する
- 三星＝結論（レポート）、個別占術ページ＝深掘り、という役割分担を崩さない

## 3. データフロー

```
raw（占術エンジンが算出した生データ。個別ページ・三星・将来のAPI等、
     すべての利用先が参照する唯一の事実ソース）
  ↓ ①占術が raw → traits へ変換（占術の意味論はここに閉じ込める）
traits（Trait Value Objectの配列）
  ↓ ②三星が trait → Axis 変換（traitsに依存する唯一の箇所）
Axis（5個前後・固定的な人格軸。三星内部でのみ使用する中間表現）
  ↓ ③軸の組み合わせから生成
IntegratedResult（Archetype／Summary／Advice／カテゴリスコア）
  ↓
UI（既存コンポーネントへマッピング）
```

### エンジンとUIの分離（実装確認済みの前提）

`shichu.php`・`tarot.php`・`seiza.php`は現状、命式計算・カード抽選・星座判定のロジックがすべてクライアントサイドJavaScriptにあり、PHP側には計算ロジックが存在しない（2026-07-05コード確認済み）。これは上記の「rawはサーバーサイドの占術エンジンのみが生成する」という原則と矛盾するため、各占術は次の構成へ移行する。

```
            shichu.php（UI）
                │
                ▼
       inc/shichu-engine.php（サーバーサイドPHPエンジン。raw〜traitsを返す唯一の実装）
                ▲
                │
           sansei.php（UI）
```

エンジン化するのは計算ロジックのみであり、各占術ページのUI・UXは変更しない（画面刷新は本設計のスコープ外。UIとEngineの分離だけを行う）。`tarot.php`・`seiza.php`も同様の構成（`inc/tarot-engine.php`・`inc/seiza-engine.php`）へ移行する。

なお、暦計算（グレゴリオ暦→ユリウス日変換）は既に`inc/oracle.php`に実装済みだが、`sansei.php`・`shichu.php`・`sanmei.php`が同一アルゴリズムをそれぞれ独自に再実装している（2026-07-05コード確認済み）。新規エンジンは既存の共通ユーティリティ（`inc/oracle.php`等）を確認したうえで再利用し、重複実装を増やさない。ディレクトリ構成・共通ユーティリティの具体的な配置方針はIMPLEMENTATION_PLAN.mdのStep1-0を参照。

## 4. ResultData仕様（占術側が返す型：ShichuResult / TarotResult / SeizaResult）

各キーの責務（占術非依存。tarot・seizaでも同じ定義を使う）:

```
meta       … UI見出し（HTMLの<title>タグとは無関係。三星ページの占術カードタイトル用）
raw        … 唯一の事実ソース（占術エンジンが算出した生データ。表示はその利用先の一つに過ぎない）
traits     … 統合用の特徴量（Trait Value Objectの配列。三星の統合解釈エンジンが読む）
highlights … 占術側の要約（配列。既存解説文からの抽出であり、新規に文章を生成しない。1件のみでも配列で統一）
extras     … UI付帯情報（配列。表示用の付加データのみ。raw項目の複製は行わない）
```

完成したResultDataは`inc/resultdata-validator.php`の`validateResultData()`で形だけを検証できる（占術の意味は検証しない。必須キーの存在・型のみ）。全占術エンジンで共通利用する。

`extras`は`{type, label, value}`のオブジェクト配列で統一する（shichu-engine.php・tarot-engine.php共通）。将来項目が増えても要素を追加するだけで済み、UI側の表示ロジックを占術非依存にできる。

scoresは含まない。カテゴリ評価は占術の関心事ではなく、三星（IntegratedResult）の成果物であるため。

ResultDataは生成後に変更しない（Immutable）。不足情報は三星側で別オブジェクト（IntegratedResult）へ集約する。

実装形式はPHPクラスではなく連想配列とする。このプロジェクトの既存コンポーネント（`inc/nav-cards.php`等）はクラスを持たず配列＋ドキュメントコメントの規約（COMPONENTS.mdの「必須変数」方式）で統一されており、この文化に合わせる。型の明示にはPHPDocの`@return array{...}`形式を用いる。

```php
/**
 * @return array{
 *   meta: array,
 *   raw: array,
 *   traits: array,
 *   highlights: string,
 *   extras: array
 * }
 */
```

## 5. SanseiResult仕様（三星が返す型。旧称IntegratedResult）

Axis Engine（Trait Aggregation・Axis算出・Archetype選択・Summary/Advice生成・Score算出・Influence算出）は、内部実装を複数に分けてもよいが、公開APIは「ResultData×3 → SanseiResult」の1つだけとする。

```php
[
    'version'   => '1.0',
    'archetype' => '...',   // IdentityBundleのarchetype
    'summary'   => '...',   // summaryBase + '今日は、' + summaryOverlay
    'advice'    => '...',   // TodayBundleのadvice

    'scores' => [           // カテゴリ別評価（1〜5の★）。inc/category-mapping.phpが単一の情報源
        'love'   => 3,
        'work'   => 1,
        'money'  => 2,
        'health' => 2,
    ],

    'influence' => [        // 各占術の影響度（1〜5の★、簡易近似方式）。UIの影響度バッジ用
        'shichu' => 5,
        'tarot'  => 1,
        'seiza'  => 4,
    ],

    'meta' => [             // デバッグ・解析用情報。表示用データとは分離する
        'identityBundleId' => 'ID_SEN_REL',
        'todayBundleId'    => 'TD_TRA_ACT',
        'identityAxes'     => ['感応性', '堅実性'],
        'todayAxes'        => ['変革性', '行動性'],
        'topTraits'        => ['変化', '直感', '慎重さ'],
        'theme' => [
            'identity' => '共感 × 継続',
            'today'    => '変化 × 勢い',
        ],
    ],
]
```

`scores`は利用者に見せる評価であり、チューニング対象（`inc/category-mapping.php`の重みを調整してよい）。`influence`は常に機械的・一貫した算出のみとし、内容のチューニングは行わない（両者の役割を混同しない）。

`meta.theme`（例：`'共感 × 継続'`）はUIで現時点では使用しないが、将来のアイコン付け・バッジ表示・デバッグ・管理画面等で流用できるよう保持しておく。

### Bundle設計（Step2-3aで確定。旧案「1つのバンドル」からの修正）

当初は「軸の上位2つの組み合わせ」を1つのキーとした単一バンドルから archetype／summary／advice を生成する設計だったが、これは「Archetype=Permanentのみで不変」「Advice=Transient重視で毎回変わり得る」という設計原則と両立しない（単一キーをtotalで選ぶとArchetypeがタロットの一枚で変化してしまう。permanentで選ぶとAdviceが毎回同じになり新鮮さがなくなる）。そのため、キーをIdentityBundle／TodayBundleの2種類に分離する。

```
IdentityBundle（本質・不変） … 上位2軸をpermanent降順で選ぶ
    → archetype, summaryBase を格納

TodayBundle（今日の流れ・可変） … 上位2軸をtransient降順で選ぶ
    → advice, summaryOverlay を格納

summary = summaryBase + summaryOverlay
```

**同点時の優先順位**（固定・`inc/axis-vocabulary.php`の`AXIS_PRIORITY_ORDER`）：

```
行動性 > 堅実性 > 感応性 > 自律性 > 変革性
```

**Bundle ID仕様**：`{種別}_{主軸コード}_{副軸コード}`（種別は`ID`または`TD`で区別。主軸＝上位1位、副軸＝上位2位）。5軸から異なる2軸を順序ありで選ぶため5×4=20通り×2種別＝40テンプレート単位。

```php
const AXIS_CODE = [
    AXIS_ACTION      => 'ACT',
    AXIS_RELIABILITY => 'REL',
    AXIS_SENSITIVITY => 'SEN',
    AXIS_AUTONOMY    => 'AUT',
    AXIS_TRANSFORM   => 'TRA',
];
```

IdentityBundleは`{archetype, summaryBase}`のみを持ち、TodayBundleは`{advice, summaryOverlay}`のみを持つ（互いに使わないフィールドを持たせない）。

### Trait Aggregation（3占術のtraitsを1つに集約する契約）

```php
[
    '情熱' => ['permanent' => 4, 'transient' => 1, 'total' => 5],
    '直感' => ['permanent' => 2, 'transient' => 3, 'total' => 5],
    // ...trait名ごとに、全ResultDataのtraitsをtype別に合算したもの
]
```

3占術は対等に扱い、占術ごとの重み付け（四柱を2倍にする等）は行わない。`total`は`permanent+transient`を都度再計算しなくて済むよう、あらかじめ保存しておく。この出力形式を正式契約とし、Axis算出・Snapshot・将来のリファクタはすべてこれを前提にする。

## 6. Trait辞書（Vocabulary）とTrait Value Object

Trait名は占術非依存の共有定数リスト（例：行動力・慎重さ・情熱・直感・社交・変化・挑戦・警戒 等）。変換ロジックは持たず、名前の契約のみを提供する（tag-mapperではない）。

Traitの値は単なる数値ではなく、Value Objectとして扱う（実装は配列でよいが、設計上は以下の構造を持つ概念として定義する）。

```
Trait
 ├ score
 ├ type（permanent / transient）
 └ (将来拡張) sources, confidence, reason
```

## 7. Axis仕様

5個で固定する：**行動性・堅実性・感応性・自律性・変革性**（Rule ID: A001〜、`inc/axis-mapping.php`が単一の情報源）。traitsは将来増える前提だが、Axisは増やさない。trait→Axisの重み変換が、traits依存の唯一の場所であり、カテゴリスコアもAxis経由で算出することで、Axisを唯一のハブとする。

Axis名はTrait名と重複させない（Step0初期案では軸名を「安定性」としていたが、trait名の「安定性」と衝突し、`axis['安定性']`と`trait['安定性']`が紛らわしくなるため「堅実性」に変更した）。

| Rule ID | trait | Axis |
|---|---|---|
| A001 | 行動力 | 行動性 |
| A002 | 挑戦 | 行動性 |
| A003 | 慎重さ | 堅実性 |
| A004 | 責任感 | 堅実性 |
| A005 | 安定性 | 堅実性 |
| A006 | 直感 | 感応性 |
| A007 | 情熱 | 感応性 |
| A008 | 独立 | 自律性 |
| A009 | 変化 | 変革性 |

v1では1trait→1axisのシンプルな対応とし、複数軸への分散は行わない。

Axisは三星内部でのみ使用する中間表現であり、個別ページ・UI・URL・SEOには一切露出しない。

## 8. 時間軸

v1は2層構成とする。

```
Permanent（星座・四柱推命の命式/十神 等）
Transient（タロットの一枚。将来的に四柱推命の大運・年運、西洋占星術のトランジット等もここに含めうる）
```

3層目（Semi-Permanent）は将来拡張の余地として内部設計上は残すが、v1では実装しない。用途別の使い分け：Archetype＝Permanentのみ／Summary＝両方／Advice＝Transient重視／Scores＝両方。

影響度バッジは簡易近似方式を採用する：各占術が返したtraitベクトルの大きさを単純比較するのみとし、将来より厳密な寄与度追跡（Traitの`sources`活用）へ差し替え可能な設計にしておく。

## 9. UIとの責務

```
Hero（アーキタイプ＝一言診断。既存Hero構造 eyebrow→h1グラデーション→sub→pillar を流用）
  ↓
Summary（総合運の説明文。数値ではなく文章）
  ↓
4カテゴリスコア（恋愛/仕事/金運/健康）
  ↓
開運アドバイス
  ↓
各占術の根拠（🌙西洋占星術/🃏タロット/☯四柱推命。表示順は固定＋影響度バッジ。「もっと詳しく見る」で個別ページへ誘導）
  ↓
関連記事
```

Hero直下に総合運の数値スコアは置かない（4カテゴリと重複し「何をもって総合か」が不明瞭になるため）。既存コンポーネント（`result-footer.php`、`article-cta.php`、`share-btns.php`の例外パターン）へのマッピングとして扱い、UI専用の新規データモデルは持たない。

なお、4カテゴリとAdviceの表示順序（Advice→4カテゴリ、または4カテゴリ→Advice）はUXの好みの領域であり、設計では固定しない。STGでの実装・比較を経て最終判断する。

## 10. 将来拡張

- 新規占術（九星気学・数秘術・姓名判断 等）は、raw→traits変換の実装＋Trait辞書への追加＋trait→Axis重み表への追加のみで対応可能
- Traitに`sources`属性を追加すれば、影響度バッジを簡易近似から厳密方式へ強化できる
- 時間軸を2層から3層（Semi-Permanent）へ拡張できる余地を残す
- `version`フィールドにより、Axis改訂・テンプレート刷新をキャッシュ／A-Bテストと安全に切り替えられる
- 「Explainable Fortune」という設計思想は、UI上では「この結果になった理由を見る」等の自然な表現に翻訳して展開する

---

## 採用しなかった設計

| 案 | 不採用理由 |
|---|---|
| tag-mapper（共通変換レイヤー） | 占術の意味論を三星側に集約すると責務が肥大化する。代わりに共有Trait辞書（名前の契約のみ）を採用 |
| 占術単位での時間軸管理 | 四柱推命のように固定/変動が同一占術内に混在するケースを表現できない。trait単位のtype属性管理を採用 |
| traits→カテゴリスコアの直接変換 | Axis導入後は責務が重複する。Axis経由に統一 |
| 動的な占術表示順序 | 「なぜ今日はこの順なのか」という説明責任が発生し、DOM/テンプレートの安定性も損なわれる。固定順＋影響度バッジを採用 |
| 三星のランチャー型（3ページ単純集約） | 個別ページとの自己競合、看板コンテンツとしての差別化不足。統合鑑定型（結論を主役にする）を採用 |
| Heroの下に総合運の数値スコアを置く | 4カテゴリスコアと重複し「何をもって総合か」が不明瞭になる。Summary（文章）で代替 |

---

## Step1（実装フェーズ）

Step0で定義した設計に基づき、以下を実施する。詳細な作業順序・検証手順は`IMPLEMENTATION_PLAN.md`を参照。

1. shichu.php の ResultData対応
2. tarot.php の ResultData対応
3. seiza.php の ResultData対応
4. Axis変換テーブル実装
5. IntegratedResult生成エンジン実装
6. sansei.php を統合エンジンへ移行
