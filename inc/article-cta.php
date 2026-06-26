<?php
// 変数:
//   $ctaTitle  必須  例: '実際にタロットを占う'
//   $ctaText   任意  例: '今のあなたには別のカードが現れるかもしれません'
//   $ctaUrl    必須  例: '/tarot'
//   $ctaBtn    必須  例: 'タロット占いを始める →'
?>
<div class="article-cta">
  <div class="article-cta-text">
    <p><?= htmlspecialchars($ctaTitle ?? '') ?></p>
    <?php if (!empty($ctaText)): ?>
    <small><?= htmlspecialchars($ctaText) ?></small>
    <?php endif; ?>
  </div>
  <a href="<?= htmlspecialchars($ctaUrl ?? '/') ?>" class="article-cta-btn"><?= htmlspecialchars($ctaBtn ?? '試してみる →') ?></a>
</div>
