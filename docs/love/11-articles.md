# Love Content Platform v1（記事基盤設計）

`love-engine-v1.0.0`のマイルストーン完了を受けて開始する、次マイルストーン「Love Content Platform v1」の設計文書。目的はエンジンの拡張ではなく、`/articles/love/`配下の記事群によってGoogle→記事→Love診断→他記事という回遊を作ること。

着手前提として、既に完了している[00-overview.md](00-overview.md)〜[10-bundle.md](10-bundle.md)、[RELEASE-v1.0.0.md](RELEASE-v1.0.0.md)を前提知識とする。特にPrimitive／Style／Tendency／Bundleの用語定義は[00-overview.md](00-overview.md)4節・[02-domain-map.md](02-domain-map.md)に従う。

## 1. 設計原則（このドキュメント固有）

### 1-1. FAQの位置づけ

FAQPage構造化データによるリッチリザルトは2026年5月7日付でGoogle検索から完全に廃止された【Google公式、Search Central】。以前の「政府・医療系サイトのみ」からさらに進み、対象が存在しない状態。マークアップ自体は無害だがSERP上の効果はゼロ。

そのため本設計では以下の位置付けに固定する。

- ❌ FAQPageスキーマの実装を目的にFAQを書く
- ✅ ユーザーの疑問に答える・ページの網羅性を上げる・AI検索の参照対象になりやすくするためにFAQを書く

FAQセクション自体は各記事テンプレートに含めるが、`schema.org/FAQPage`のJSON-LD実装は優先度を下げる（工数に対してSERP上の効果がないため）。

### 1-2. 記事の生成単位（3層構造）

同一カテゴリ内の記事（例：MBTI16タイプ×Love）を「名詞だけ差し替えたテンプレート」で量産すると、Googleの「Scaled Content Abuse」ポリシーに抵触するリスクがある【Google公式、2024年3月改定のスパムポリシー】。このポリシーは生成方法（AI／人力／ハイブリッド）を問わず、「検索順位操作が主目的で、ユーザーへの独自価値がない大量ページ」を対象にする。

これを設計段階で回避するため、**全記事を3層構造で固定する**。

```
① 固有情報層（そのタイプだけの記述、他タイプとの使い回し禁止）
   例：ENTPの恋愛観／惹かれる相手／苦手な関係

② Love Engine実測データ層（他サイトが書けない一次データ、これが差別化の核）
   例：Golden Master（9216パターン）を集計すると、ENTPでは
       Style「積極性」がHighになる割合は○%
       なぜそうなるか：ENTPのTrait Mapping → Primitive「行動主導性」「情動性」への
       寄与 → Style「積極性」の加重式 という因果を明示する

③ 診断への導線層（各記事共通のCTA、ここは定型で問題ない）
```

②が最も重要な層である。数値（○%）だけを載せるのは弱い。「なぜそうなるのか」という**MBTI → Primitive → Style/Tendency という因果**を書くことが、Love Engineの内部ロジックを持つこのサイトだけの強みであり、Scaled Content Abuseの定義（独自価値なし）に該当しない根拠になる。

### 1-3. 独自価値・一次データ利用・禁止事項

**独自価値**
- Golden Master（9216パターン、`tests/cases/love-final-snapshot.php`）の実測分布を根拠として利用する
- Primitive→Style/Tendencyの因果式（`inc/love-style.php`／`inc/love-tendency.php`の加重定義）を平易な言葉で解説する
- Bundle（上位2 Primitiveの組み合わせ）の考え方を解説する

**一次データ利用の書式**
記事中でGolden Masterの数値を引用する際は、必ず「Love Engine v1.0.0で9216パターンを分析した結果」等、根拠の出所を明示する。数値のみの提示は禁止し、必ず①の固有記述または②の因果説明とセットで使う。

**禁止事項**
- × 名詞（MBTIタイプ名／星座名／血液型名）だけを差し替えた定型文
- × 複数記事にまたがる定型文コピー（②の因果説明部分を除き、文章の使い回しをしない）
- × 全記事共通の結論（「あなたは魅力的です」等、タイプに依存しない当たり障りのない結び）
- × 根拠のない断定（Golden Masterの数値的裏付けがない性格断定）

## 2. URL設計・カテゴリ構成

```
/articles/love/
├── mbti/
│   ├── entp-love/
│   ├── enfp-love/
│   ...（16タイプ）
│
├── style/
│   ├── sekkyokusei-love/      … 積極性
│   ├── aijouhyougen-love/     … 愛情表現
│   ├── houyouryoku-love/      … 包容力
│   ├── dokusenyoku-love/      … 独占欲
│   ├── horeyasusa-love/       … 惚れやすさ
│   ├── shittobukasa-love/     … 嫉妬深さ
│   └── shinchousa-love/       … 恋愛の慎重さ
│
├── tendency/
│   ├── kekkonshikou-love/     … 結婚志向
│   └── uwakitaisei-love/      … 浮気耐性
│
├── seiza/
│   ├── aries-love/
│   ...（12星座）
│
├── blood/
│   ├── a-love/
│   ...（4血液型）
│
├── bundle/
│   └── （後続フェーズ。4節「優先順位」参照）
│
└── guide/
    └── love-engine-guide/     … Love Engine自体の解説（ピラーページ）
```

`style/`・`tendency/`は診断結果ページから直接リンクする（3節参照）ため、他カテゴリと異なり**結果表示に使われる9項目**という性質を持つ。Primitive（5項目：行動主導性／誠実性／情動性／自立性／変化志向）はAnti-Corruption Layer内部の翻訳語彙であり、ユーザーに提示しない（[02-domain-map.md](02-domain-map.md)）ため、記事カテゴリとしては作らない。

## 2-1. 記事タイプ一覧

| 種類 | 本数 | 入力 | 主な根拠 |
|---|---:|---|---|
| MBTI | 16 | MBTI | Golden Master + MBTI特性 |
| Style | 7 | Style | Style導出・実測分布 |
| Tendency | 2 | Tendency | Tendency導出・実測分布 |
| 星座 | 12 | Seiza | Golden Master + 星座特性 |
| 血液型 | 4 | Blood | Golden Master + 血液型特性 |
| Guide | 数本 | 全体 | エンジン解説 |
| Bundle | 14または共有 | Bundle | Bundle仕様（[10-bundle.md](10-bundle.md)） |

半年後に再開する際、「どの記事群を想定していたか」をこの表だけで思い出せることを目的とする。

## 3. 内部リンク方針

- 診断結果ページ（`love.php`の結果表示）：表示されたStyle/Tendency名それぞれから、対応する`/articles/love/style/xxx-love/`または`/articles/love/tendency/xxx-love/`へ直接リンクする
- MBTI/星座/血液型記事：記事末尾から`love.php?mbti=xxx`等、診断への直接遷移を用意する（`mbti.php`→`love.php`のCTAと同じパターンを踏襲）
- カテゴリ間：MBTI記事内で言及したStyle/Tendency名から該当記事へリンクする（例：ENTP記事内で「積極性」に言及する箇所から`style/sekkyokusei-love/`へ）
- guide/love-engine-guide：ピラーページとして全カテゴリへのハブリンクを持つ

## 4. 優先順位

| 順位 | カテゴリ | 本数 | 状態 | 理由 |
|---|---|---|---|---|
| 1 | MBTI | 16 | **完了**（16/16） | 検索ボリューム最大、`mbti.php`との既存連携あり |
| 2 | Style／Tendency | 9 | 未着手 | 結果ページから直接内部リンクできる。9本と少なく実装コストが低い。Golden Masterとの結びつきが最も強く差別化しやすい |
| 3 | 星座 | 12 | 未着手 | 検索ボリューム、既存`/articles/seiza/`との回遊性 |
| 4 | 血液型 | 4 | 未着手 | 検索ボリュームは前2者よりやや小さい |
| 5 | guide（ピラーページ） | 1 | 未着手 | 他記事公開後にハブとして機能させる |
| 6 | bundle | 未定 | 未着手 | 20通り中8通りはテキスト共有（[10-bundle.md](10-bundle.md)）で出現率が低く、個別記事化の優先度が低い。低頻度パターンを1記事にまとめる等、この段階では個別記事数を確定しない |

MBTI16記事は、テンプレート（`articles/love/mbti/_type-tpl.php`）固定＋データ差し替え方式で完成させた。各記事はGolden Master実測値（`tests/cases/love-final-snapshot.php`）と、MBTIの4文字→Trait→Axis→Primitiveという実装コード（`inc/mbti-trait-mapping.php`・`inc/axis-mapping.php`）に基づく因果説明を含む。全16記事完成後、公開順に依存した「ここまでのXタイプ中最も」という相対表現を、全16タイプの実測値に基づく正確な表現へ修正する横断レビューを実施済み（詳細は6節のチェックリストを参照）。

Style／Tendencyを2位に上げた理由：ユーザー提案の当初案（MBTI→星座→血液型→guide→bundle）ではPrimitive相当の概念が含まれていなかったが、結果ページからの直接内部リンクという強い流入経路を持ち、本数が少なく（9本）実装コストが低いため、3位以降より先に着手する方が費用対効果が高いと判断した。

## 5. KPI

- 各カテゴリのインデックス登録率（Search Console）
- 記事→Love診断のクリック率
- Love診断結果ページ→Style/Tendency記事のクリック率（新規追加する内部リンクの効果測定）
- Love関連記事間の回遊率（MBTI記事↔星座記事等）
- FAQPageスキーマは効果測定対象に含めない（1-1節）

## 6. 記事チェックリスト

ENTP記事（`articles/love/mbti/entp/`、[RELEASE-v1.0.0.md](RELEASE-v1.0.0.md)後の最初の記事実装）をリファレンス実装として確定する。以降の記事は、テンプレート（`_type-tpl.php`）を固定してデータ部分のみ差し替える方式で量産する。1記事ごとに以下を確認し、「ENTPで確認済みのはずが別タイプで漏れる」事故を防ぐ。

- [ ] title・meta descriptionにタイプ名／カテゴリ名が正しく入っている
- [ ] H1がtitleと重複しすぎず、かつ内容を正確に表している
- [ ] canonicalが正しいURLを指している
- [ ] パンくずの階層・リンク先が正しい
- [ ] CTA（上）：`/love?xxx=`のクエリで診断側の事前選択と一致するパラメータになっている
- [ ] Golden Master実測値：`tests/cases/love-final-snapshot.php`から**実際に集計した値**であり、手で作った数値でない
- [ ] 因果説明：`inc/mbti-trait-mapping.php`／`inc/axis-mapping.php`等、実装コードの対応関係と一致している（1-2節・1-3節の禁止事項参照）
- [ ] FAQ：本文コンテンツとして書かれており、FAQPageスキーマを実装していない（1-1節）
- [ ] CTA（下）：CTA（上）と同じ遷移先になっている
- [ ] 内部リンク（関連コンテンツ）：存在しないカテゴリ（Style/Tendency等、未公開のもの）へリンクしていない
- [ ] auto-link：意図しないキーワードリンクが挿入されていないか実機で確認する
- [ ] モバイル表示：375px幅で横スクロールが発生しない（`.nav-cards`等、意図的なもの以外）
- [ ] ハブページ（`articles/love/mbti/index.php`の`$_PUBLISHED`等）に新規記事を追記している
