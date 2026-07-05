<?php
// 変数:
//   $ctaTitle  必須  例: '実際にタロットを占う'
//   $ctaText   任意  例: '今のあなたには別のカードが現れるかもしれません'
//   $ctaUrl    必須  例: '/tarot'
//   $ctaBtn    必須  例: 'タロット占いを始める →'
require_once __DIR__.'/nav-cards.php';
$_ctaSlug = trim((string)parse_url($ctaUrl ?? '/', PHP_URL_PATH), '/');
$_ctaName = $_NAV_PAGES[$_ctaSlug]['name'] ?? ($ctaBtn ?? 'CTA');
$GLOBALS['_ctaOccurrence'] = ($GLOBALS['_ctaOccurrence'] ?? 0) + 1;
$_ctaPosition = $GLOBALS['_ctaOccurrence'];
?>
<div class="article-cta" data-cta-position="<?= (int)$_ctaPosition ?>" data-cta-name="<?= htmlspecialchars($_ctaName) ?>">
  <div class="article-cta-text">
    <p><?= htmlspecialchars($ctaTitle ?? '') ?></p>
    <?php if (!empty($ctaText)): ?>
    <small><?= htmlspecialchars($ctaText) ?></small>
    <?php endif; ?>
  </div>
  <a href="<?= htmlspecialchars($ctaUrl ?? '/') ?>" class="article-cta-btn" data-ga-event="cta_click" data-cta-name="<?= htmlspecialchars($_ctaName) ?>" data-cta-destination="<?= htmlspecialchars($ctaUrl ?? '/') ?>"><?= htmlspecialchars($ctaBtn ?? '試してみる →') ?></a>
</div>
