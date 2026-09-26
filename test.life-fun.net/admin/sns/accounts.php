<?php
declare(strict_types=1);

// SNS投稿：SNS連携の状態。MVPでは連携機能が無いため、全SNSを「未連携（手動投稿）」と表示する。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

admin_render_header('SNS投稿', 'sns');
admin_render_sns_tabs('accounts');
?>
<p class="muted">連携していないSNSは、投稿時刻に「手動投稿待ち」になり、通知が届きます。管理画面で本文をコピーして投稿し、「投稿済にする」を押してください。</p>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>SNS</th><th>状態</th><th>説明</th></tr></thead>
    <tbody>
<?php foreach (ADMIN_SNS_PLATFORMS as $platform => $def): ?>
      <tr>
        <td><?= h($def['label']) ?></td>
        <td><?= admin_sns_is_connected($platform) ? '🟢 連携済み（自動投稿）' : '未連携（手動投稿）' ?></td>
        <td class="muted"><?= $platform === 'note'
            ? 'noteには公式の投稿APIが無いため、常に手動投稿です。'
            : 'アカウントを作成したあと、自動投稿の連携を追加できます。' ?></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php
admin_render_footer();
