<?php
// 変数:
//   $relatedItems  必須  例:
//     [
//       ['label'=>'タロット占い', 'title'=>'実際に占ってみる →', 'url'=>'/tarot'],
//       ['label'=>'大アルカナ一覧', 'title'=>'22枚の意味を見る →', 'url'=>'/articles/tarot/'],
//     ]
?>
<div class="article-related-grid">
  <?php foreach ($relatedItems ?? [] as $item): ?>
  <a href="<?= htmlspecialchars($item['url']) ?>" class="article-related-item" data-ga-event="article_related_click" data-related-destination="<?= htmlspecialchars($item['url']) ?>">
    <div class="article-related-label"><?= htmlspecialchars($item['label']) ?></div>
    <div class="article-related-title"><?= htmlspecialchars($item['title']) ?></div>
  </a>
  <?php endforeach; ?>
</div>
