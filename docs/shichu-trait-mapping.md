# shichu Trait Mapping Table（仕様）

`docs/sansei-engine-design.md` §6（Trait辞書・Trait Value Object）の具体化。四柱推命の`raw`から`traits`を導出する対応表。この表自体が仕様であり、実装はこれに従うだけ。新しい占術解釈を加えない（既存のJUSSHIN_MEANINGS等、shichu.php自身が持つ意味付けをtraitへ写像しただけ）。

**この表はコード生成物です。** 単一の情報源は `inc/shichu-trait-mapping.php`。
表を修正する場合は先にそのPHP配列を編集し、`tests/tools/generate-shichu-trait-mapping-doc.php` を再実行してこのファイルを更新すること。手でこのMarkdownだけを編集しない。

## 共有Trait辞書（Vocabulary）

```php
// inc/trait-vocabulary.php（ロジックなし、名前の契約のみ）
const TRAIT_ACTION    = '行動力';
const TRAIT_CARE      = '慎重さ';
const TRAIT_STABILITY = '安定性';
const TRAIT_INDEP     = '独立';
const TRAIT_PASSION   = '情熱';
const TRAIT_CHANGE    = '変化';
const TRAIT_CHALLENGE = '挑戦';
const TRAIT_DUTY      = '責任感';
const TRAIT_INTUITION = '直感';
```

## スコア基準

- **+2** = 命式の中心的な特徴（日主強弱）
- **+1** = 個別の十神の出現（tenGodGrid内の出現回数分だけ加算。存在判定ではなく頻度を使う）

## Mapping Table

| Rule ID | raw項目 | 条件 | trait | score |
|---|---|---|---|---:|
| S001 | dayStrength | 身強 | 行動力 | +2 |
| S002 | dayStrength | 身弱 | 慎重さ | +2 |
| S003 | dayStrength | 中和 | 安定性 | +2 |
| S004 | tenGodGrid | 比肩 | 独立 | +1 |
| S005 | tenGodGrid | 劫財 | 行動力 | +1 |
| S006 | tenGodGrid | 食神 | 情熱 | +1 |
| S007 | tenGodGrid | 傷官 | 変化 | +1 |
| S008 | tenGodGrid | 偏財 | 行動力 | +1 |
| S009 | tenGodGrid | 正財 | 安定性 | +1 |
| S010 | tenGodGrid | 偏官 | 挑戦 | +1 |
| S011 | tenGodGrid | 正官 | 責任感 | +1 |
| S012 | tenGodGrid | 偏印 | 直感 | +1 |
| S013 | tenGodGrid | 印綬 | 慎重さ | +1 |

## Trait Coverage

`tests/tools/shichu-trait-coverage.php` で確認（全9種のtraitが最低1回は出現していることを毎回確認する）。

## 今回の範囲に含めなかったもの

- `tenchusatsuBranches`（天中殺）：性格特性ではなく「注意すべき時期」を示す値のため対象外
- `daiyun`（大運）：Step0で時間軸は v1=2層（Permanent/Transient）と決めており、大運・年運はSemi-Permanentとして将来拡張の対象。位置づけが未確定のため、v1のtraitsマッピングには含めない

## 位置による重み付けについて

tenGodGrid内の出現位置（年干／月干／日支蔵干等）による重み付けの違いは、v1では設けない。実際の見え方を確認してから、必要なら別のRule ID体系（重み付き版）を検討する。

## 今後の拡張

tarot（完了）・seizaも同じ形式（Rule ID: T001〜, Z001〜）でMapping Tableを作成する。Axis変換（trait→Axis）も同様にRule ID（A001〜）を付与した表として仕様化する。