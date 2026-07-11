# Love Engine v1.0.0 リリースノート

タグ：`love-engine-v1.0.0`（注釈付き、ローカルのみ。コミット`3f8edbd`を指す）

このファイルは`docs/love/00〜09`（生きた仕様書、今後も更新される）とは性質が異なる。ここは**特定時点のスナップショット記録**であり、以後更新しない（新しい変更は次のリリースノートか、各仕様書自体の更新履歴に委ねる）。

## 概要

MBTI×血液型×星座を統合した恋愛傾向診断（Love Engine）の実装が完了し、公開可能な機能として一区切りした。設計（`docs/love/00〜09`）→実装→9216通り全数検証→導線整備までを一貫して完了している。

## 実装済み

### エンジン本体
- Source Engine：MBTI（`inc/mbti-engine.php`、`docs/engine-template.md`準拠、Golden Master 1024/1024）、Blood（`inc/blood-engine.php`、新規設計、Managerレビュー2回を経た通俗特徴づけ）、Seiza（既存）
- Shared Axis Library接続：`axis_aggregateTraits()`／`axis_computeAxes()`／`axis_computeInfluence()`を無改修で利用（Level1のみ、Level2は再実装しない）
- Primitive（`inc/love-primitive-mapping.php`）：Axisの`permanent`値のみを使用（原則12）
- Normalizer（`inc/love-normalizer.php`）：Primitive/Style/Tendencyそれぞれ独立、9216通り実測の百分位（P33/P67）に基づく
- Style（7項目）・Tendency（2項目）：`inc/love-style.php`／`inc/love-tendency.php`
- Bundle（20通り、`inc/love-bundle.php`）：上位2 Primitive方式、Managerレビューで軸衝突を修正
- Composer（`inc/love-composer.php`）：ResultDocument組立、raw非参照
- 記事URL Resolver（`inc/love-article-links.php`）：Seiza signIndex→slug対応表を新規作成
- orchestrator（`inc/love-orchestrator.php`）・`love.php`本体

### Text Bank（Manager執筆、Writing Rules 7条準拠）
- Style 21本（7項目×3区分）
- Tendency 6本（2項目×3区分）
- Bundle 14本（20 IDのうち低頻度8通りは2本の共有文へ集約）

### 検証・回帰基盤
- MBTI：Golden Master（1024件）、Trait Coverage（9/9）、Trait Snapshot（16件）
- Blood：ResultData Validator（4/4）、Trait Coverage（9/9）、Type Coverage（4/4）、Axisベクトル衝突なし
- Primitive：9216通り全数Snapshot、Coverage・分布分析
- Style/Tendency：9216通り全数Snapshot
- Composer：9216通り全数Snapshot（IDベース、ダミーText Bank）
- **最終Golden Master**：9216通り全数（`tests/cases/love-final-snapshot.php`、ID・分類のみ15MB。全文言を含めると38MBでPHPのデフォルトメモリ制限を超えるため意図的に除外）

### 導線（タグ後の2コミットを含む。下記「タグの範囲について」参照）
- `mbti.php`結果ページ→`love.php`のCTA（MBTIタイプを`?mbti=`で引き継ぎ、Step1をスキップ）
- TOPページ「占いを選ぶ」カルーセルの2番目に掲載
- `inc/nav-cards.php`（`$_NAV_PAGES`）へ追加。既存のランダム抽選ロジックは無改修

## 意図的な保留

- **Presentation Influence**：Structural Influence（`axis_computeInfluence()`そのまま）とは別に、記事リンク順・「最も影響した要素」表示用の正規化された影響度が必要と判明（9216件検証でMBTIが常に1位固定という実測結果）。仕様は未確定、Text Bank・Writing Rules完了後に決める方針で保留中（`02-domain-map.md`4b節）
- `/articles/love/`：SEO受け皿となる解説記事群。未着手
- `footer.php`「人気の占い」・ヘッダーナビへの追加：`get_featured_pages()`への影響範囲が広いため、意図的に別フェーズへ分離

## 次期候補（優先順位、次回検討時の起点）

1. `/articles/love/`の整備（SEO流入の受け皿、Love診断との内部リンク）
2. footer／headerの情報設計（Loveだけでなく今後増える診断も見据えた汎用設計）
3. Presentation Influence仕様策定
4. 実運用で得た知見（離脱率・利用状況）に基づくUX改善

## タグの範囲について

`love-engine-v1.0.0`タグはコミット`3f8edbd`（MBTI CTA統合）を指す。TOPページカード（`1c3851b`）とnav-cards追加（`e724f45`）はタグ作成**後**の2コミットであり、厳密にはタグの外側にある。ただし内容としては同一のフェーズ1（導線整備）に属するため、本リリースノートでは合わせて記載した。タグを付け替える運用は行っていない（タグは不変の時点マーカーとして扱う）。

## 関連ファイル

- 設計：`docs/love/00-overview.md`〜`10-bundle.md`
- 前提手順：`docs/engine-template.md`、`docs/sansei-engine-design.md`
- コミット一覧：`git log --oneline fbf1061..3f8edbd`（Git管理方針の変更からMBTI CTA統合まで、29コミット）
