# Bundle 仕様

BundleはPrimitiveのみを入力として選定する（原則3・9。Style／Tendency／Influenceは参照しない）。sanseiの`axis_getIdentityBundle()`と同じ選定パターン（Level2相当。コードは共有しない、独自実装。原則6）を恋愛ドメイン向けに適用する。

Love DomainはPermanent Engineであり、Today Bundle相当（transientベースの動的な部分）を持たない。したがってsanseiの40通り（IdentityBundle20＋TodayBundle20）と異なり、**20通り1種類のみ**。

## 選定メカニズム

1. 5つのPrimitiveをpermanentスコアで降順ソートする
2. 同点の場合は`PRIMITIVE_PRIORITY_ORDER`で決定的にタイブレークする
3. 上位2つを主軸・副軸として選ぶ（順序を区別するため5×4=20通り）

```php
const PRIMITIVE_PRIORITY_ORDER = [
    PRIMITIVE_ACTION, PRIMITIVE_RELIABILITY, PRIMITIVE_SENSITIVITY, PRIMITIVE_AUTONOMY, PRIMITIVE_TRANSFORM,
];
```

この並び順は、`AXIS_PRIORITY_ORDER`（`inc/axis-vocabulary.php`）をPrimitive名に1:1で置き換えたもの。sansei自身、この優先順位の決定根拠はどこにも文書化されていない（`docs/sansei-engine-design.md`・`axis-vocabulary.php`のコメント・CHANGELOG.mdのいずれにも記載なし、Managerレビューで確認済み）。新たな恣意的基準を作らず、既存の順序をそのまま継承する（Managerレビュー2026-07-10の提案採用）。タイブレークは9216件中13.6%で発動するが、優先順位を逆にしても結論（後述の出現率の偏り）は変わらない頑健な結果であることも確認済み。

## Bundle ID命名

```
LOVE_{主軸コード}_{副軸コード}
```

Primitiveコード（`AXIS_CODE`のPrimitive版）：

| Primitive | コード |
|---|---|
| 行動主導性 | ACT |
| 誠実性 | REL |
| 情動性 | SEN |
| 自立性 | AUT |
| 変化志向 | TRA |

例：`LOVE_REL_SEN`（主軸=誠実性、副軸=情動性）。`ID`／`TD`というsanseiのプレフィックスとは衝突しないよう`LOVE`を用いる。

## 出現率（9216通り全数、2026-07-10算出）

| 順位 | Bundle ID | 組み合わせ | 件数 | 出現率 |
|---|---|---|---|---|
| 1 | LOVE_REL_SEN | 誠実性_情動性 | 2417 | 26.226% |
| 2 | LOVE_REL_ACT | 誠実性_行動主導性 | 1666 | 18.077% |
| 3 | LOVE_SEN_ACT | 情動性_行動主導性 | 1175 | 12.750% |
| 4 | LOVE_SEN_REL | 情動性_誠実性 | 996 | 10.807% |
| 5 | LOVE_ACT_REL | 行動主導性_誠実性 | 714 | 7.747% |
| 6 | LOVE_ACT_SEN | 行動主導性_情動性 | 649 | 7.042% |
| 7 | LOVE_REL_TRA | 誠実性_変化志向 | 437 | 4.742% |
| 8 | LOVE_SEN_TRA | 情動性_変化志向 | 356 | 3.863% |
| 9 | LOVE_REL_AUT | 誠実性_自立性 | 201 | 2.181% |
| 10 | LOVE_TRA_ACT | 変化志向_行動主導性 | 156 | 1.693% |
| 11 | LOVE_TRA_REL | 変化志向_誠実性 | 148 | 1.606% |
| 12 | LOVE_ACT_TRA | 行動主導性_変化志向 | 110 | 1.194% |
| 13 | LOVE_TRA_SEN | 変化志向_情動性 | 91 | 0.987% |
| 14 | LOVE_SEN_AUT | 情動性_自立性 | 46 | 0.499% |
| 15 | LOVE_AUT_REL | 自立性_誠実性 | 14 | 0.152% |
| 16 | LOVE_AUT_TRA | 自立性_変化志向 | 14 | 0.152% |
| 17 | LOVE_TRA_AUT | 変化志向_自立性 | 12 | 0.130% |
| 18 | LOVE_ACT_AUT | 行動主導性_自立性 | 10 | 0.109% |
| 19 | LOVE_AUT_SEN | 自立性_情動性 | 4 | 0.043% |
| 20 | LOVE_AUT_ACT | 自立性_行動主導性 | 0 | 0% |

合計9216/9216。上位6通り（誠実性・情動性・行動主導性の3者間の順列）で82.6%。自立性が絡む8通り（15〜20位＋9位・14位）は合計約3.27%（自立性のPrimitiveレンジが他より狭いという構造的事実、[08-normalizer.md](08-normalizer.md)と整合）。

## Text ID（文言バンクの共有単位）

**20個のBundle IDは全て定義するが、文言（Text ID）は共有してよい。** IDの定義を省略すると、将来trait mapping変更で該当ケースが増えた際にID未定義エラーになるため、20エントリは必ず保持する。

| Bundle ID | Text ID |
|---|---|
| LOVE_REL_SEN | text_rel_sen |
| LOVE_REL_ACT | text_rel_act |
| LOVE_SEN_ACT | text_sen_act |
| LOVE_SEN_REL | text_sen_rel |
| LOVE_ACT_REL | text_act_rel |
| LOVE_ACT_SEN | text_act_sen |
| LOVE_REL_TRA | text_rel_tra |
| LOVE_SEN_TRA | text_sen_tra |
| LOVE_REL_AUT | text_rel_aut |
| LOVE_TRA_ACT | text_tra_act |
| LOVE_TRA_REL | text_tra_rel |
| LOVE_ACT_TRA | text_act_tra |
| LOVE_TRA_SEN | **text_tra_shared**（共有） |
| LOVE_SEN_AUT | **text_aut_shared**（共有） |
| LOVE_AUT_REL | **text_aut_shared**（共有） |
| LOVE_AUT_TRA | **text_aut_shared**（共有） |
| LOVE_TRA_AUT | **text_aut_shared**（共有） |
| LOVE_ACT_AUT | **text_aut_shared**（共有） |
| LOVE_AUT_SEN | **text_aut_shared**（共有） |
| LOVE_AUT_ACT | **text_aut_shared**（共有） |

1〜12位（累計97.9%）はユニークな文章。13位（変化志向_情動性、0.987%）のみ単独で低頻度のため専用の共有文（`text_tra_shared`）とし、14位以降（自立性が主軸または副軸に必ず含まれる7通り、累計約1.09%）は「自立性が際立つタイプ」として1本の共有文（`text_aut_shared`）にまとめる。したがって実際に執筆する文章は**12＋1＋1＝14本**。

この振り分けは実装時の初期案であり、実際に文章を書く段階で調整してよい（`10-bundle.md`を都度更新する）。

## 実装ファイル

`inc/love-bundle.php`：`PRIMITIVE_PRIORITY_ORDER`・`love_selectTop2Primitives()`・`love_selectBundle()`（Bundle ID決定）・`BUNDLE_TEXT_ID_MAP`（Bundle ID→Text ID）を実装する。Bundle本文（14本）は`inc/love-bundle-texts.php`（Text Bankフェーズ、Managerが執筆）で別途用意する。
