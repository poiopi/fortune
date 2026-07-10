# 恋愛診断エンジン 設計原則

本原則は、Love Domainを既存のShared Axis Library上に構築する際の設計判断を定める。不変の設計方針のみを記載し、実装手順・レビュー項目・ライティング規約は別文書で管理する（[00-overview.md](00-overview.md)のドキュメント構成を参照）。

1. 新しいTraitは追加しない（既存9個のTrait語彙のみを使う）
2. 新しいAxisは追加しない（既存5軸のみを使う）
3. Bundle・Style・Tendencyは、いずれもPrimitiveから独立に導出する（並列出力とし、互いの出力を参照しない）
4. Influenceは既存実装（`axis_computeInfluence()`）をそのまま利用する
5. 共有ファイル（`axis-engine.php`／`axis-mapping.php`／`trait-vocabulary.php`等）は変更しない
6. 恋愛専用ロジックは新規ファイルへ集約する。Shared Axis LibraryのうちLevel 2相当の処理（Bundle選定・カテゴリスコア相当の算出）は共有関数を呼ばず、恋愛ドメイン側に新規実装する
7. 恋愛スコア・概念の定義は、trait mappingやBundle設計より先に文章で確定する
8. 既存Trait・Axisで自然に説明できない概念は、新設よりも先に項目自体の見直し（改名・再定義・統合・削除）を優先する
9. Bundleの選定と結果文章の生成は分離する。Bundleの選定はBundleの判定ロジックのみに基づき、恋愛スタイル・推定傾向は結果文章の生成時（Composer）のみ参照する
10. 依存方向はShared Axis Library→Love Domain→Presentationの一方向のみとする。Love DomainはPresentationの概念（文章・表示形式・星評価・閾値）を参照しない
11. 各Primitiveの意味は固定され、Style／Tendencyの複数の導出式にわたって一貫して解釈されなければならない。導出式は負の係数を使ってよいが、それはPrimitiveの意味を反転させるのではなく、導出される概念とPrimitiveとの関係が逆であることを表す
12. Love DomainはShared Axis Libraryの`permanent`値のみを入力とする。`transient`および`total`はLove Domainの導出に使用しない（恋愛エンジンはPermanent Engineであり、同一入力では常に同一結果を返す。将来transientを持つSource Engine（タロット等）を追加する場合も、その寄与はLove Domainの外側にある別レイヤー（今日のアドバイス等）としてのみ扱う）
