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
│   ├── reliability-type/       … 誠実性型（主軸=誠実性、9216件中51.2%）
│   ├── sensitivity-type/       … 情動性型（主軸=情動性、27.9%）
│   ├── action-type/            … 行動主導性型（主軸=行動主導性、16.1%）
│   ├── transform-type/         … 変化志向型（主軸=変化志向、4.4%）
│   └── autonomy-type/          … 自立性型（主軸=自立性、0.35%、レアタイプ）
│
└── guide/
    ├── kekka-no-mikata/       … 恋愛診断の結果の見方（リファレンス／ハブ記事）
    ├── bundle-guide/          … Bundleとは
    ├── style-guide/           … Styleとは
    ├── tendency-guide/        … Tendencyとは
    ├── 9216-patterns/         … 9216パターンの仕組み
    └── primitive-guide/       … Primitiveとは
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
| Guide | 6 | 全体 | エンジン解説 |
| Bundle | 5 | Bundle | Bundle仕様（[10-bundle.md](10-bundle.md)）。20 Bundle IDを主軸Primitiveで5グループ化 |

半年後に再開する際、「どの記事群を想定していたか」をこの表だけで思い出せることを目的とする。

## 3. 内部リンク方針

- 診断結果ページ（`love.php`の結果表示）：表示されたStyle/Tendency名それぞれから、対応する`/articles/love/style/xxx-love/`または`/articles/love/tendency/xxx-love/`へ直接リンクする
- MBTI/星座/血液型記事：記事末尾から`love.php?mbti=xxx`等、診断への直接遷移を用意する（`mbti.php`→`love.php`のCTAと同じパターンを踏襲）
- カテゴリ間：MBTI記事内で言及したStyle/Tendency名から該当記事へリンクする（例：ENTP記事内で「積極性」に言及する箇所から`style/sekkyokusei-love/`へ）
- guide/kekka-no-mikata：Guideカテゴリのリファレンス記事として、Style/Tendency/MBTI/星座/血液型の各ハブページへのリンクを持つ

## 4. 優先順位

| 順位 | カテゴリ | 本数 | 状態 | 理由 |
|---|---|---|---|---|
| 1 | MBTI | 16 | **完了**（16/16） | 検索ボリューム最大、`mbti.php`との既存連携あり |
| 2 | Style／Tendency | 9 | **完了**（Style 7/7・Tendency 2/2） | 結果ページから直接内部リンクできる。9本と少なく実装コストが低い。Golden Masterとの結びつきが最も強く差別化しやすい |
| 3 | 星座 | 12 | **完了**（12/12） | 検索ボリューム、既存`/articles/seiza/`との回遊性 |
| 4 | 血液型 | 4 | **完了**（4/4） | 検索ボリュームは前2者よりやや小さい |
| 5 | guide（ピラーページ） | 6 | **完了**（6/6） | 他記事公開後にハブとして機能させる |
| 6 | bundle | 5 | **完了**（5/5） | 20 Bundle IDを主軸Primitiveで5グループに再分類。低頻度パターン（自立性が絡む8通り）は個別記事化せず、該当グループ内の1セクションとして扱った |

MBTI16記事は、テンプレート（`articles/love/mbti/_type-tpl.php`）固定＋データ差し替え方式で完成させた。各記事はGolden Master実測値（`tests/cases/love-final-snapshot.php`）と、MBTIの4文字→Trait→Axis→Primitiveという実装コード（`inc/mbti-trait-mapping.php`・`inc/axis-mapping.php`）に基づく因果説明を含む。全16記事完成後、公開順に依存した「ここまでのXタイプ中最も」という相対表現を、全16タイプの実測値に基づく正確な表現へ修正する横断レビューを実施済み（詳細は6節のチェックリストを参照）。

Style／Tendency9記事は、MBTI記事とは異なる「概念解説型」の構成（概要→測定対象→Love Engineでの計算方法→High/Mid/Lowの違い→9216件実測分析→関連MBTI→CTA）で完成させた。各記事は計算式（`inc/love-style.php`・`inc/love-tendency.php`のLOVE_STYLE_MAPPING/LOVE_TENDENCY_MAPPING）とGolden Master実測値（全体分布・MBTI別16タイプ・血液型別・Bundle主軸別相関）を含み、High/Mid/LowのテキストはText Bank（`inc/love-style-texts.php`・`inc/love-tendency-texts.php`）の原文をそのまま引用して診断結果との齟齬を防いでいる。似た指標（積極性/愛情表現、独占欲/嫉妬深さ、包容力/恋愛の慎重さ、結婚志向/浮気耐性）は、計算式のどのプリミティブが異なるかを執筆時点からFAQで明記し、「軸の独立性」を確保した。

星座12記事は、サイン単位（signIndex固定、768件=MBTI16×血液型4×内面タイプ12を集計）でMBTI記事と同型の構成にしたが、既存`/articles/seiza/`との内容重複を避けるため、固有情報を最小限にしGolden Master実測の比重をMBTI記事以上に高めた。エレメント×クオリティの組み合わせは12星座ですべて異なるため、各記事の因果説明・featured軸は自然に分かれたが、副次的な検証として「牡羊座≡蟹座」「獅子座≡蠍座」「射手座≡魚座」という、エレメントは異なるが実測値が完全一致する3ペアを発見し、記事の独自性として活用した（`inc/axis-mapping.php`でTRAIT_PASSION（火）とTRAIT_INTUITION（水）が同じAXIS_SENSITIVITYへ同スコアで変換されるため）。横断レビューで「12星座の中で唯一」という誤った独自性主張（実際は双子座も同型構造を持っていた）とBundle集中度の順位誤りを発見・修正した。内面タイプ（innerType）はGolden Master集計母集団の説明としてのみ使用し、星座固有の因果説明には登場させていない。

血液型4記事は、他カテゴリでの反省を踏まえ、執筆前に4血液型全9指標・Bundle・MBTI相関を一括計算するフェーズを先に実施してから書いた（`inc/blood-trait-mapping.php`のTrait Mapping：A型=誠実性へ3特性が集約・スコア5、B型=変化志向+自立性、O型=行動主導性+情動性ともにスコア2、AB型=情動性スコア2+行動主導性スコア1）。各記事に4血液型横断の実測値比較表を新設。この事前一括計算により、横断レビューで相対表現の誤りが0件だった（MBTI・星座フェーズでは複数件の誤りを事後修正していた）。O型は牡羊座・蟹座と同じ構造を持ち、MBTI相乗効果が最も顕著（ENTJ/ENTP/ENFJ/ENFPで積極性がHigh100%）。AB型はO型とスコア配分が異なるため、Style/Tendency9指標中6指標がO型と完全一致するという構造を持つ。

Style／Tendencyを2位に上げた理由：ユーザー提案の当初案（MBTI→星座→血液型→guide→bundle）ではPrimitive相当の概念が含まれていなかったが、結果ページからの直接内部リンクという強い流入経路を持ち、本数が少なく（9本）実装コストが低いため、3位以降より先に着手する方が費用対効果が高いと判断した。

Guide6記事（Love Content Platform v1.2）は、既存41記事とは異なるテンプレート（`articles/love/guide/_guide-tpl.php`）で実装した。MBTI・Style・Tendency・星座・血液型のように固定スキーマのデータを差し替える構成ではなく、記事ごとに自由なHTML本文（`$item['body']`のヒアドキュメント）を持つ「概念解説・ハブ」型として設計した。リファレンス記事「恋愛診断の結果の見方」（`kekka-no-mikata`）を最初に実装し、41記事すべてを束ねる知識ベースとして機能させたうえで、テンプレートを固定して残り5記事（Bundleとは→Styleとは→Tendencyとは→9216パターンの仕組み→Primitiveとは、この順は「検索される概念を先に・開発思想寄りのPrimitiveを最後に」というユーザー方針による）を横展開した。Bundleとはの出現率データ（9216件中、誠実性×情動性26.2%が最多、自立性が絡む8通り合計約3.3%、LOVE_AUT_ACT実測0件）は[10-bundle.md](10-bundle.md)の実測値をそのまま引用している。_guide-tpl.phpには既存の共有コンポーネント`inc/article-nav.php`を新規に組み込み、Guide6記事間にprev/next導線を追加した（他カテゴリでは各テンプレートに個別実装済みだったが、Guideでは当初未実装だったため今回追加）。横断レビューでは、内部リンクの参照先がすべて実在する記事であること、相対表現（「最も」「唯一」）がいずれも既存カテゴリの横断レビューで検証済みの事実の再掲であり新規の未検証数値でないことを確認した。

Guide実装中の検証で、`primitive-guide`のFAQに事実誤認（「自立性はMBTIのIからのみ」）を発見・修正した。実際は血液型B型（+2）・星座の一部内面タイプ（表現型+1／自由型+2）からも加算されており、`inc/mbti-trait-mapping.php`・`inc/blood-trait-mapping.php`・`inc/seiza-trait-mapping.php`・`inc/axis-mapping.php`を確認し直して裏付けを取った。同時に、`inc/love-article-links.php`の`love_resolveBloodArticleLink()`が血液型記事4本公開後もnullを返し続けていたバグと、`love_resolveSeizaArticleLink()`が旧・汎用星座記事へのURLを返し続けていたバグ（MBTIで既に修正済みだったのと同種）を発見し、Bundle着手前に独立コミットで修正した。

Bundle5記事（Love Content Platform v1.2最終フェーズ）は、20 Bundle ID（[10-bundle.md](10-bundle.md)）を主軸Primitiveで5グループ化する設計（誠実性型/情動性型/行動主導性型/変化志向型/自立性型）で実装した。設計レビューで、5グループの出現率を実測から再集計したところ51.2%（誠実性型）〜0.35%（自立性型）という極端な偏りが判明したため、自立性型のみ「レアタイプ」として他4記事より簡潔な構成にする方針とした。Bundleは結果画面に型名が表示されない（`bundleText`本文のみ表示、`love.php:397`）という他カテゴリにない制約があるため、各記事冒頭に実際の診断文をそのまま引用する「自己照合リード」を新設し、「※型名は診断結果の画面には表示されません」という注記も添えた。Style/Tendencyへの内部リンクは推測ではなく、`inc/love-style.php`・`inc/love-tendency.php`の計算式にそのPrimitiveが係数として含まれる指標のみを機械的に抽出している。因果テーブルの再検証により、自立性は星座のエレメント・クオリティからは一切寄与がなく、MBTIのI（弱め）・血液型B型・星座の一部内面タイプという限られた経路のみで加算されることを確認し、これが自立性型の出現率が5タイプ中最少（0.35%）である構造的な理由として記事に明記した。横断レビューでは、5記事の相対表現（「最も」「唯一」等）を全てソースコード・Golden Master実測値で裏付け、内部リンクが全て実在するページを指していることを確認した。

## 5. KPI

- 各カテゴリのインデックス登録率（Search Console）
- 記事→Love診断のクリック率
- Love診断結果ページ→Style/Tendency記事のクリック率（新規追加する内部リンクの効果測定）
- Love関連記事間の回遊率（MBTI記事↔星座記事等）
- Bundle記事の直帰率・滞在時間（型名が結果画面に出ない制約下で、自己照合リードが機能しているかの間接指標）
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
