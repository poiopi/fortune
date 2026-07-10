# Result Composer 仕様

ComposerはApplication / Presentation Boundaryである。確定したドメインモデル（Bundle・Style・Tendency・Influence）を、ユーザー向け結果へ変換する境界を担う。

Composerは**文章を書くモジュールではなく、文章の組立規則**である。出力は完成した文章・HTMLではなく、次の論理構造（ResultDocument）である。

```
ResultDocument {
  bundleText     : string   // Bundleの選定結果に対応する基本文
  styleTexts     : string[] // 表示するStyle項目ごとの文（Normalizerの区分に対応する既存文言を選ぶ）
  tendencyTexts  : string[] // 同上、Tendency側
  articleLinks   : { source, url, label }[]  // Influence順にソートされた記事リンク
}
```

この構造をWeb／API／アプリ／音声読み上げのどの出力先にも渡せる形にし、最終的な接続詞・文体・冗長さ・改行の調整はWriting Rules（別文書）が行う。Composerはこの調整を行わない。

## 責務

- **含める（Composerの責務）**：どのBundle文・Style文・Tendency文・記事リンクを、どの順序・どのグルーピングでResultDocumentに含めるかを決定する
- **含めない（Composerの責務外）**：文言そのものの生成・言い換え・接続。Style/Tendencyの各High/Mid/Low文言は、Normalizerが確定した区分に対応する既存の文言バンクから選ぶだけで、Composerが新たに文章を作らない（文言バンクの置き場所は未確定。別文書で扱う）
- **選択ロジックの上限**：Composerの選択ロジックは「どのIDの文言を含めるか／どの順序か」という組立変数の範囲に限る。**2つ以上のStyle/Tendency区分の組み合わせに応じて異なる文言IDを選ぶ分岐（解釈を伴う分岐）は禁止**する。これは実質的に「AとBの関係性についての新しい説明」をComposerが生成することになり、「文言バンクから選ぶだけ」という原則の抜け穴になるため。そのような概念が必要な場合は、Style/Tendency自体の再定義（原則8条）を先に検討する（Managerレビュー2026-07-10で指摘）

## Composerはrawを読まない

Composerは、いかなるSource Engineの`raw`も直接参照しない。Composerが読むのはBundle（確定済み選定結果）・Style/Tendency（Normalizer済みのHigh/Mid/Low区分）・Influence・articleLinks候補（後述、いずれも既に解決済みの値）のみである。

理由：`raw`はAxisよりさらに手前の生データであり、Composerがこれを読むとAnti-Corruption Layerの境界（[02-domain-map.md](02-domain-map.md)2節）が意味をなさなくなる。加えて、Source Engineごとに`raw`の形状は非対称である（MBTI/Bloodは`raw['type']`という文字列コードを持つが、Seizaは`raw['signIndex']`という整数のみで`'type'`キーを持たない）。もしComposerが`raw`を読む設計にすると、「Composerが各Source Engineのraw形状を個別に知っている」という新しい結合が生まれ、原則6・10に抵触する。

## 入力の前提

- Bundleの選定は、Bundleの判定ロジックのみに基づく（原則9条）。Composerに渡される時点でBundleは既に確定している
- Style／Tendencyの生スコアは、Composerに渡される前にNormalizerでHigh/Mid/Lowへ変換済みである（[02-domain-map.md](02-domain-map.md)4節）
- Influenceは Source EnginesのTraitsから直接算出され、Love Domainを経由しない（同4節）
- **articleLinksの候補は、Composerより前段（未実装のページ／薄いorchestrator）が、Source Engineのraw（MBTIの型コード・星座のsignIndex等）から記事URLを解決した上で、`{source, url, label}[]`という既に確定した配列としてComposerへ渡す**（同4節）。URLが存在しないsource（現状のBlood。血液型記事は未作成）は候補に含まれないか、候補内で除外マークが付いた状態で渡される
- Composerは Bundle・Style・Tendencyの系列、Influenceの系列、articleLinks候補の系列という3つを受け取って初めて統合する唯一の場所である

## articleLinksの並び順

Influenceが最も高いソース（MBTI／血液型／星座のいずれか）の記事を先頭に置く。Composerの仕事は、既に解決済みの候補配列をInfluence順に並べ替え、URLが無いsourceを除外することだけであり、URL自体を組み立てない。文字サイズ等の強調は変えず、並び順のみで表現する（視線誘導の安定性を優先する、既存合意）。

**並び替えに使うInfluenceは、Structural Influence（`axis_computeInfluence()`の生値）ではなくPresentation Influence（仕様未確定）である**（[02-domain-map.md](02-domain-map.md)4b節）。Structural Influenceをそのまま使うと、9216通り全件でMBTIが1位（実測確定）となり、並び順が永久に固定されてソート自体が無意味になるため。Presentation Influenceの仕様が決まるまで、Composerの実装（ソートロジック）は「渡されたInfluence値の降順に並べる」という契約のままでよく、変更は不要——どちらの値を渡すかは呼び出し側の判断であり、Composerは値の由来を知らない。

## 未確定事項

- Style／Tendencyの各High/Mid/Low文言バンクをどこで定義するか（Composerが参照する別ファイルか、Writing Rules文書に含めるか）は未確定。次の検討課題とする
- articleLinks候補を解決する「Composerより前段のorchestrator」の具体的な置き場所（ページ直書き／薄いorchestrator関数）は未確定。Love Domain側のファイル（`love-*.php`）に引き込まないことだけは確定している（原則6の対象外という扱いを明記しておかないと、将来誰かがLove Domain側へ引き込んでしまうリスクがあるとManagerレビューで指摘された）
- Seizaの記事URL解決には、signIndex→英語スラッグ（`articles/seiza/aries/`等）の対応表が新たに必要（現状`inc/`のどこにも存在しない）。Composer設計とは独立した実装タスクとして別途扱う
