<?php
// 変数:
//   $prevTitle  必須  例: '世界'
//   $prevUrl    必須  例: '/articles/tarot/world/'
//   $prevLabel  任意  デフォルト: '← 前'
//   $nextTitle  必須  例: '魔術師'
//   $nextUrl    必須  例: '/articles/tarot/magician/'
//   $nextLabel  任意  デフォルト: '次 →'
//   $listTitle  任意  デフォルト: '一覧'
//   $listUrl    必須  例: '/articles/tarot/'
$_prevLabel  = $prevLabel  ?? '← 前';
$_nextLabel  = $nextLabel  ?? '次 →';
$_listTitle  = $listTitle  ?? '一覧';
?>
<div class="article-nav">
  <?php if (!empty($prevUrl)): ?>
  <a href="<?= htmlspecialchars($prevUrl) ?>" class="article-nav-item prev">
    <div class="article-nav-dir"><?= htmlspecialchars($_prevLabel) ?></div>
    <div class="article-nav-name"><?= htmlspecialchars($prevTitle ?? '') ?></div>
  </a>
  <?php else: ?>
  <div class="article-nav-item empty"></div>
  <?php endif; ?>

  <a href="<?= htmlspecialchars($listUrl ?? '/') ?>" class="article-nav-center">
    <div>
      <div class="article-nav-list-label">一覧</div>
      <div class="article-nav-list-name"><?= htmlspecialchars($_listTitle) ?></div>
    </div>
  </a>

  <?php if (!empty($nextUrl)): ?>
  <a href="<?= htmlspecialchars($nextUrl) ?>" class="article-nav-item next">
    <div class="article-nav-dir"><?= htmlspecialchars($_nextLabel) ?></div>
    <div class="article-nav-name"><?= htmlspecialchars($nextTitle ?? '') ?></div>
  </a>
  <?php else: ?>
  <div class="article-nav-item empty"></div>
  <?php endif; ?>
</div>
