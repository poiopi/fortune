<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 誕生花：月またぎ（月末→翌月1日、または月ハブ→翌月ハブ）専用の
// 前後ナビ描画ヘルパー。
//
// inc/article-nav.php（225ページで使われる共有コンポーネント）は
// 変更せず、誕生花側だけで「次の記事がまだ存在しない場合は近日公開表示」
// を吸収する。翌月分を作成すれば、このファイルを編集しなくても
// 自動的に通常のリンク表示へ切り替わる（file_existsベースの動的判定）。
// ══════════════════════════════════════════════════════════════════

function renderBirthflowerBoundaryNav(array $args): void {
    $prevTitle = $args['prevTitle'] ?? null;
    $prevUrl   = $args['prevUrl'] ?? null;
    $listUrl   = $args['listUrl'] ?? null;
    $listTitle = $args['listTitle'] ?? null;

    if (file_exists($args['nextTargetFile'])) {
        $nextUrl   = $args['nextUrl'];
        $nextTitle = $args['nextTitle'];
        require __DIR__.'/../article-nav.php';
        return;
    }
    ?>
    <div class="article-nav">
      <?php if (!empty($prevUrl)): ?>
      <a href="<?= htmlspecialchars($prevUrl) ?>" class="article-nav-item prev" data-ga-event="article_nav_click" data-nav-type="prev">
        <div class="article-nav-dir">← 前</div>
        <div class="article-nav-name"><?= htmlspecialchars($prevTitle ?? '') ?></div>
      </a>
      <?php else: ?>
      <div class="article-nav-item empty"></div>
      <?php endif; ?>

      <a href="<?= htmlspecialchars($listUrl ?? '/') ?>" class="article-nav-center" data-ga-event="article_nav_click" data-nav-type="hub">
        <div>
          <div class="article-nav-list-label">一覧</div>
          <div class="article-nav-list-name"><?= htmlspecialchars($listTitle ?? '一覧') ?></div>
        </div>
      </a>

      <div class="article-nav-item next article-nav-comingsoon">
        <div class="article-nav-dir">次 →</div>
        <div class="article-nav-name">近日公開</div>
      </div>
    </div>
    <?php
}
