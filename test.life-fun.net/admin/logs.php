<?php
declare(strict_types=1);

// 操作ログ一覧（新しい順・50件ずつ）。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

$perPage = 50;
$page = max(1, (int) ($_GET['page'] ?? 1));
$total = (int) admin_db()->query('SELECT COUNT(*) FROM audit_logs')->fetchColumn();
$pages = max(1, (int) ceil($total / $perPage));
$page = min($page, $pages);

$stmt = admin_db()->prepare('SELECT at, action, target, detail, ip FROM audit_logs ORDER BY id DESC LIMIT ? OFFSET ?');
$stmt->bindValue(1, $perPage, PDO::PARAM_INT);
$stmt->bindValue(2, ($page - 1) * $perPage, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();

admin_render_header('操作ログ', 'logs');
?>
<p class="muted">全<?= $total ?>件（<?= $page ?> / <?= $pages ?> ページ）</p>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>日時</th><th>操作</th><th>対象</th><th>詳細</th><th>IP</th></tr></thead>
    <tbody>
<?php if ($rows === []): ?>
      <tr><td colspan="5" class="muted">記録はまだありません。</td></tr>
<?php endif; ?>
<?php foreach ($rows as $row): ?>
      <tr class="<?= in_array($row['action'], ['login_failed', 'login_locked', 'login_blocked', 'csrf_rejected'], true) ? 'is-warn' : '' ?>">
        <td class="nowrap"><?= h(str_replace('T', ' ', substr($row['at'], 0, 19))) ?></td>
        <td><?= h(admin_audit_label($row['action'])) ?></td>
        <td><?= h($row['target']) ?></td>
        <td><?= h($row['detail']) ?></td>
        <td class="nowrap"><?= h($row['ip']) ?></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php if ($pages > 1): ?>
<nav class="pager">
  <?php if ($page > 1): ?><a class="btn btn--ghost" href="<?= h(admin_url('/logs?page=' . ($page - 1))) ?>">← 新しい</a><?php endif; ?>
  <?php if ($page < $pages): ?><a class="btn btn--ghost" href="<?= h(admin_url('/logs?page=' . ($page + 1))) ?>">古い →</a><?php endif; ?>
</nav>
<?php endif; ?>
<?php
admin_render_footer();
