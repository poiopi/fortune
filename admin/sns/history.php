<?php
declare(strict_types=1);

// SNS投稿：履歴（送信中・投稿済・保留・取消・失敗・スキップ・削除済み。新しい順・50件ずつ）。
// 失敗行の「再試行」、投稿済み（Threads）の「Threadsから削除」（確認画面 → POST）。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    $queueId = (int) ($_POST['queue_id'] ?? 0);
    try {
        switch ($action) {
            case 'retry':
                admin_sns_retry($queueId);
                admin_audit('queue_retry', '#' . $queueId);
                admin_flash_redirect('ok', '再試行します（次の毎分の処理で、投稿済みかどうかの確認から始めます）。', '/sns/history');
            case 'delete_threads':
                try {
                    admin_threads_delete_post($queueId);
                } catch (RuntimeException $e) {
                    admin_audit('threads_delete_failed', '#' . $queueId, admin_threads_redact($e->getMessage()));
                    throw $e;
                }
                admin_audit('threads_delete', '#' . $queueId);
                admin_flash_redirect('ok', 'Threadsから削除しました（履歴は「削除済み」として残ります）。', '/sns/history');
        }
    } catch (RuntimeException $e) {
        admin_flash_redirect('error', admin_threads_redact($e->getMessage()), '/sns/history');
    }
    admin_flash_redirect('error', '不明な操作です。', '/sns/history');
}

// 「Threadsから削除」の確認画面
if (isset($_GET['delete'])) {
    $stmt = admin_db()->prepare(
        "SELECT q.*, s.title, s.kind FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
         WHERE q.id = ? AND q.platform = 'threads' AND q.status = 'posted'"
    );
    $stmt->execute([(int) $_GET['delete']]);
    $target = $stmt->fetch();
    if ($target === false || (string) $target['external_id'] === '') {
        admin_flash_redirect('error', '削除できる投稿ではありません（投稿済みで、投稿IDが記録されている Threads の投稿だけ削除できます）。', '/sns/history');
    }
    $stock = admin_stock_get((int) $target['stock_id']);
    admin_render_header('履歴', 'sns_history');
    ?>
<section class="panel panel--wide">
  <h2 class="panel__title">Threadsから削除しますか？</h2>
  <p>「<?= h($target['title']) ?>」（<?= h(admin_date_label($target['slot_date'])) ?>・投稿 <?= h(admin_format_time($target['posted_at'])) ?>）</p>
  <?php if ($target['post_url'] !== null): ?><p><a href="<?= h($target['post_url']) ?>" target="_blank" rel="noopener noreferrer">Threadsで投稿を見る</a></p><?php endif; ?>
  <pre class="preview"><?= h($stock !== null ? admin_stock_render_body($stock, 'threads') : '') ?></pre>
  <p class="muted">Threads 上の投稿を削除します。元に戻せません。履歴は「削除済み」として残り、このストックは再び割り当てられません。</p>
  <div class="form--inline">
    <form method="post" action="<?= h(admin_url('/sns/history')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="delete_threads"><input type="hidden" name="queue_id" value="<?= (int) $target['id'] ?>"><button type="submit" class="btn btn--primary">削除する</button></form>
    <a class="btn btn--ghost" href="<?= h(admin_url('/sns/history')) ?>">やめる</a>
  </div>
</section>
    <?php
    admin_render_footer();
    exit;
}

$perPage = 50;
$page = max(1, (int) ($_GET['page'] ?? 1));
$statuses = "('sending', 'posted', 'held', 'canceled', 'failed', 'skipped', 'deleted')";
$total = (int) admin_db()->query("SELECT COUNT(*) FROM post_queue WHERE status IN {$statuses}")->fetchColumn();
$pages = max(1, (int) ceil($total / $perPage));
$page = min($page, $pages);

$stmt = admin_db()->prepare(
    "SELECT q.*, s.title, s.kind,
            (SELECT c.stock_id FROM post_queue c WHERE c.slot_date = q.slot_date ORDER BY c.id DESC LIMIT 1) AS current_stock_id
     FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
     WHERE q.status IN {$statuses} ORDER BY q.slot_date DESC, q.id DESC LIMIT ? OFFSET ?"
);
$stmt->bindValue(1, $perPage, PDO::PARAM_INT);
$stmt->bindValue(2, ($page - 1) * $perPage, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();

admin_render_header('履歴', 'sns_history');
admin_render_flash();
?>
<p class="muted">全<?= $total ?>件（<?= $page ?> / <?= $pages ?> ページ）。自動投稿の失敗は自動で<?= count(ADMIN_THREADS_RETRY_MINUTES) ?>回まで再試行し、それでも失敗したものが「失敗」になります。</p>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>日付</th><th>SNS</th><th>種別</th><th>タイトル</th><th>結果</th><th>投稿日時</th><th>投稿URL・メモ</th><th></th></tr></thead>
    <tbody>
<?php if ($rows === []): ?>
      <tr><td colspan="8" class="muted">履歴はまだありません。</td></tr>
<?php endif; ?>
<?php foreach ($rows as $r): ?>
      <tr class="<?= in_array($r['status'], ['held', 'failed'], true) ? 'is-warn' : '' ?>">
        <td class="nowrap"><?= h(admin_date_label($r['slot_date'])) ?></td>
        <td class="nowrap"><?= h(admin_sns_label($r['platform'])) ?></td>
        <td class="nowrap"><?= h(admin_kind_label($r['kind'])) ?></td>
        <td><a href="<?= h(admin_url('/sns/stock-edit?id=' . $r['stock_id'])) ?>"><?= h($r['title']) ?></a></td>
        <td class="nowrap"><span class="badge badge--<?= h($r['status']) ?>"><?= h(ADMIN_QUEUE_STATUS_LABELS[$r['status']] ?? $r['status']) ?></span><?= $r['status'] === 'deleted' ? '<br><span class="muted">' . h(admin_format_time($r['deleted_at'])) . '</span>' : '' ?></td>
        <td class="nowrap"><?= h(admin_format_time($r['posted_at'])) ?></td>
        <td><?php if ($r['post_url'] !== null): ?><a href="<?= h($r['post_url']) ?>" target="_blank" rel="noopener noreferrer">投稿を見る</a><?php endif; ?> <?= h($r['last_error']) ?></td>
        <td class="nowrap">
          <?php if ($r['status'] === 'failed' && (int) $r['current_stock_id'] === (int) $r['stock_id'] && admin_sns_has_publisher($r['platform'])): ?>
            <form method="post" action="<?= h(admin_url('/sns/history')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="retry"><input type="hidden" name="queue_id" value="<?= (int) $r['id'] ?>"><button type="submit" class="btn btn--primary">再試行</button></form>
          <?php elseif ($r['status'] === 'posted' && $r['platform'] === 'threads' && (string) $r['external_id'] !== ''): ?>
            <a class="btn btn--ghost" href="<?= h(admin_url('/sns/history?delete=' . (int) $r['id'])) ?>">Threadsから削除</a>
          <?php endif; ?>
        </td>
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
