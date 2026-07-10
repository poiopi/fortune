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

## 入力の前提

- Bundleの選定は、Bundleの判定ロジックのみに基づく（原則9条）。Composerに渡される時点でBundleは既に確定している
- Style／Tendencyの生スコアは、Composerに渡される前にNormalizerでHigh/Mid/Lowへ変換済みである（[02-domain-map.md](02-domain-map.md)4節）
- Influenceは Source EnginesのTraitsから直接算出され、Love Domainを経由しない（同4節）。Composerは Bundle・Style・Tendencyの系列とInfluenceの系列、両方を受け取って初めて統合する唯一の場所である

## articleLinksの並び順

Influenceが最も高いソース（MBTI／血液型／星座のいずれか）の記事を先頭に置く。文字サイズ等の強調は変えず、並び順のみで表現する（視線誘導の安定性を優先する、既存合意）。

## 未確定事項

Style／Tendencyの各High/Mid/Low文言バンクをどこで定義するか（Composerが参照する別ファイルか、Writing Rules文書に含めるか）は未確定。次の検討課題とする。
