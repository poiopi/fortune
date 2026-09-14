<?php
// Quiz解説ページ専用 広告枠（Phase 5-B、初回試験導入：A-001のみ）
//
// 呼び出し元（例：quiz/_quiz-kaisetsu-a.php）で $quiz['ad_enabled'] === true のときのみ
// require される想定。$quiz['ad_enabled']が立っていない他のQuizには一切表示されない。
//
// 【重要・本番反映前に必ず対応】
// data-ad-slot は STG検証用のプレースホルダーである。DAILY_QUIZ_AD_MONETIZATION.md
// K-3-2の方針（原則新規作成／例外は既存の休眠ユニットが仕様に完全適合すると
// 確認できた場合のみ再利用）に従い、実際にAdSenseで発行されたad-slot IDに
// 置き換えてから本番反映すること。
?>
<div class="quiz-ad-slot">
  <p class="quiz-ad-label">広告</p>
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-6979913482925873"
       data-ad-slot="0000000000"
       data-ad-format="auto"
       data-full-width-responsive="true"></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
