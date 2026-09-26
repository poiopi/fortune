<?php
declare(strict_types=1);

// SNS投稿：履歴（投稿済・保留・取消・失敗。新しい順・50件ずつ）。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

$perPage = 50;
$page = max(1, (int) ($_GET['page'] ?? 1));
$statuses = "('posted', 'held', 'canceled', 'failed')";
$total = (int) admin_db()->query("SELECT COUNT(*) FROM post_queue WHERE status IN {$statuses}")->fetchColumn();
$pages = max(1, (int) ceil($total / $perPage));
$page = min($page, $pages);

$stmt = admin_db()->prepare(
    "SELECT q.*, s.title, s.kind FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
     WHERE q.status IN {$statuses} ORDER BY q.slot_date DESC, q.id DESC LIMIT ? OFFSET ?"
);
$stmt->bindValue(1, $perPage, PDO::PARAM_INT);
$stmt->bindValue(2, ($page - 1) * $perPage, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();

admin_render_header('SNS投稿', 'sns');
admin_render_sns_tabs('history');
?>
<p class="muted">全<?= $total ?>件（<?= $page ?> / <?= $pages ?> ページ）</p>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>日付</th><th>SNS</th><th>種別</th><th>タイトル</th><th>結果</th><th>投稿日時</th><th>投稿URL・メモ</th></tr></thead>
    <tbody>
<?php if ($rows === []): ?>
      <tr><td colspan="7" class="muted">履歴はまだありません。</td></tr>
<?php endif; ?>
<?php foreach ($rows as $r): ?>
      <tr class="<?= in_array($r['status'], ['held', 'failed'], true) ? 'is-warn' : '' ?>">
        <td class="nowrap"><?= h(admin_date_label($r['slot_date'])) ?></td>
        <td class="nowrap"><?= h(admin_sns_label($r['platform'])) ?></td>
        <td class="nowrap"><?= h(admin_kind_label($r['kind'])) ?></td>
        <td><a href="<?= h(admin_url('/sns/stock-edit?id=' . $r['stock_id'])) ?>"><?= h($r['title']) ?></a></td>
        <td class="nowrap"><?= h(ADMIN_QUEUE_STATUS_LABELS[$r['status']] ?? $r['status']) ?></td>
        <td class="nowrap"><?= h(admin_format_time($r['posted_at'])) ?></td>
        <td><?php if ($r['post_url'] !== null): ?><a href="<?= h($r['post_url']) ?>" target="_blank" rel="noopener noreferrer">投稿を見る</a><?php endif; ?> <?= h($r['last_error']) ?></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php if ($pages > 1): ?>
<nav class="pager">
  <?php if ($page > 1): ?><a class="btn btn--ghost" href="<?= h(admin_url('/sns/history?page=' . ($page - 1))) ?>">← 新しい</a><?php endif; ?>
  <?php if ($page < $pages): ?><a class="btn btn--ghost" href="<?= h(admin_url('/sns/history?page=' . ($page + 1))) ?>">古い →</a><?php endif; ?>
</nav>
<?php endif; ?>
<?php
admin_render_footer();
