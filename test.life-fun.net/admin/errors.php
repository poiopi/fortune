<?php
declare(strict_types=1);

// エラー監視：公開ページで起きたJSエラーの一覧・詳細・状態変更。id 付きで開くと詳細。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $id = (int) ($_POST['id'] ?? 0);
    $status = (string) ($_POST['status'] ?? '');
    $back = (string) ($_POST['back'] ?? '') === 'detail' ? '/errors?id=' . $id : '/errors';
    if ($id <= 0 || !isset(ADMIN_ERROR_STATUS_LABELS[$status])) {
        admin_flash_redirect('error', '不明な操作です。', '/errors');
    }
    // 未対応に戻すときは通知済みのままにする（手で戻したものを再通知しない）
    admin_db()->prepare('UPDATE client_errors SET status = ? WHERE id = ?')->execute([$status, $id]);
    admin_audit('error_status', '#' . $id, ADMIN_ERROR_STATUS_LABELS[$status]);
    admin_flash_redirect('ok', '「' . ADMIN_ERROR_STATUS_LABELS[$status] . '」にしました。', $back);
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$filter = isset($_GET['status'], ADMIN_ERROR_STATUS_LABELS[$_GET['status']]) ? (string) $_GET['status'] : 'open';

function errors_status_buttons(array $e, string $back): string
{
    $html = '';
    foreach (['resolved' => '対応済にする', 'ignored' => '無視する', 'open' => '未対応に戻す'] as $status => $label) {
        if ($e['status'] === $status) {
            continue;
        }
        $html .= '<form method="post" action="' . h(admin_url('/errors')) . '">' . admin_csrf_field()
            . '<input type="hidden" name="id" value="' . (int) $e['id'] . '">'
            . '<input type="hidden" name="status" value="' . h($status) . '">'
            . '<input type="hidden" name="back" value="' . h($back) . '">'
            . '<button type="submit" class="btn btn--ghost">' . h($label) . '</button></form>';
    }
    return $html;
}

if ($id > 0) {
    $stmt = admin_db()->prepare('SELECT * FROM client_errors WHERE id = ?');
    $stmt->execute([$id]);
    $error = $stmt->fetch();
    if ($error === false) {
        admin_flash_redirect('error', 'エラーが見つかりません。', '/errors');
    }
    $issues = admin_db()->prepare('SELECT id, title, status FROM known_issues WHERE error_id = ? ORDER BY id');
    $issues->execute([$id]);
    $issues = $issues->fetchAll();

    admin_render_header('エラーの詳細', 'errors');
    admin_render_flash();
    ?>
<section class="panel panel--wide">
  <p><span class="badge badge--err-<?= h($error['status']) ?>"><?= h(ADMIN_ERROR_STATUS_LABELS[$error['status']]) ?></span> <?= $error['kind'] === 'rejection' ? '未処理のPromiseエラー' : 'JSエラー' ?></p>
  <pre class="preview"><?= h($error['message']) ?></pre>
  <ul class="kv">
    <li>発生場所：<?= h($error['source']) ?><?= $error['line'] > 0 ? ' ' . (int) $error['line'] . '行目' . ($error['col'] > 0 ? ' ' . (int) $error['col'] . '文字目' : '') : '' ?></li>
    <li>回数：<?= (int) $error['count'] ?> 回</li>
    <li>最初：<?= h(admin_format_time($error['first_seen'])) ?>　最後：<?= h(admin_format_time($error['last_seen'])) ?></li>
    <li>最後の端末：<?= h(admin_monitor_ua_label($error['ua'])) ?> <span class="muted"><?= h($error['ua']) ?></span></li>
  </ul>
  <h2 class="panel__subtitle">起きたページ</h2>
  <ul class="kv">
    <?php foreach (admin_monitor_error_pages($id) as $p): ?>
      <li><a href="<?= h(admin_config()['admin_origin'] . $p['page']) ?>" target="_blank" rel="noopener noreferrer"><?= h($p['page']) ?></a>（<?= (int) $p['count'] ?>回）</li>
    <?php endforeach; ?>
  </ul>
  <?php if ($error['stack'] !== null): ?>
    <h2 class="panel__subtitle">スタックトレース</h2>
    <pre class="preview"><?= h($error['stack']) ?></pre>
  <?php endif; ?>
  <h2 class="panel__subtitle">既知の不具合</h2>
  <?php if ($issues === []): ?>
    <p class="muted">まだ登録されていません。</p>
  <?php else: ?>
    <ul class="kv"><?php foreach ($issues as $i): ?><li><a href="<?= h(admin_url('/issues?id=' . $i['id'])) ?>">#<?= (int) $i['id'] ?> <?= h($i['title']) ?></a>（<?= h(ADMIN_ISSUE_STATUS_LABELS[$i['status']]) ?>）</li><?php endforeach; ?></ul>
  <?php endif; ?>
  <div class="form--inline">
    <?= errors_status_buttons($error, 'detail') ?>
    <a class="btn btn--primary" href="<?= h(admin_url('/issues?from_error=' . $id)) ?>">既知の不具合として登録</a>
    <a class="btn btn--ghost" href="<?= h(admin_url('/errors')) ?>">一覧へ</a>
  </div>
</section>
    <?php
    admin_render_footer();
    exit;
}

$stmt = admin_db()->prepare('SELECT * FROM client_errors WHERE status = ? ORDER BY last_seen DESC LIMIT 200');
$stmt->execute([$filter]);
$errors = $stmt->fetchAll();
$counts = [];
foreach (admin_db()->query('SELECT status, COUNT(*) AS n FROM client_errors GROUP BY status') as $row) {
    $counts[$row['status']] = (int) $row['n'];
}

admin_render_header('エラー監視', 'errors');
admin_render_flash();
?>
<p class="muted">公開ページのブラウザで起きたJSエラーです（自サイトのファイルで起きたものだけ・URLはパスのみ）。新しい種類のエラーは通知します。対応済にしたエラーが再発すると未対応に戻り、もう一度通知します。</p>
<nav class="tabs">
  <?php foreach (ADMIN_ERROR_STATUS_LABELS as $status => $label): ?>
    <a class="tabs__item<?= $filter === $status ? ' is-active' : '' ?>" href="<?= h(admin_url('/errors?status=' . $status)) ?>"><?= h($label) ?>（<?= $counts[$status] ?? 0 ?>）</a>
  <?php endforeach; ?>
</nav>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>メッセージ</th><th>発生場所</th><th>ページ</th><th>回数</th><th>最後</th><th></th></tr></thead>
    <tbody>
<?php if ($errors === []): ?>
      <tr><td colspan="6" class="muted">ありません。</td></tr>
<?php endif; ?>
<?php foreach ($errors as $e): $pages = admin_monitor_error_pages((int) $e['id']); ?>
      <tr>
        <td><a href="<?= h(admin_url('/errors?id=' . $e['id'])) ?>"><?= h(mb_strimwidth($e['message'], 0, 120, '…')) ?></a></td>
        <td class="nowrap"><?= h($e['source']) ?><?= $e['line'] > 0 ? ':' . (int) $e['line'] : '' ?></td>
        <td><?= h($pages[0]['page'] ?? '') ?><?= count($pages) > 1 ? ' <span class="muted">ほか' . (count($pages) - 1) . 'ページ</span>' : '' ?></td>
        <td class="nowrap"><?= (int) $e['count'] ?></td>
        <td class="nowrap"><?= h(admin_format_time($e['last_seen'])) ?></td>
        <td><div class="form--inline form--tight"><?= errors_status_buttons($e, 'list') ?></div></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php
admin_render_footer();
