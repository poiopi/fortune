<?php
declare(strict_types=1);

// 既知の不具合：一覧・登録・編集。?id= で編集、?new=1 で新規、?from_error= でエラー監視から登録。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$fromError = isset($_GET['from_error']) ? (int) $_GET['from_error'] : 0;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $id = (int) ($_POST['id'] ?? 0);
    $in = [
        'title'    => (string) ($_POST['title'] ?? ''),
        'severity' => (string) ($_POST['severity'] ?? ''),
        'status'   => (string) ($_POST['status'] ?? ''),
        'page'     => (string) ($_POST['page'] ?? ''),
        'memo'     => (string) ($_POST['memo'] ?? ''),
    ];
    $errorId = (int) ($_POST['error_id'] ?? 0);
    if ($id > 0 && admin_issue_get($id) === null) {
        admin_flash_redirect('error', '不具合が見つかりません。', '/issues');
    }
    $errors = admin_issue_validate($in);
    if ($errors === []) {
        $saved = admin_issue_save($id, $in, $id === 0 && $errorId > 0 ? $errorId : null);
        admin_audit($id === 0 ? 'issue_create' : 'issue_edit', '#' . $saved, $in['title'] . '（' . ADMIN_ISSUE_STATUS_LABELS[$in['status']] . '）');
        admin_flash_redirect('ok', $id === 0 ? '登録しました。' : '保存しました。', '/issues?id=' . $saved);
    }
    $current = $in + ['id' => $id, 'error_id' => $errorId ?: null];
}

$showForm = $id > 0 || $fromError > 0 || isset($_GET['new']) || $errors !== [];

if ($showForm && !isset($current)) {
    if ($id > 0) {
        $current = admin_issue_get($id);
        if ($current === null) {
            admin_flash_redirect('error', '不具合が見つかりません。', '/issues');
        }
        $current['page'] ??= '';
        $current['memo'] ??= '';
    } else {
        $current = ['id' => 0, 'title' => '', 'severity' => 'mid', 'status' => 'open', 'page' => '', 'memo' => '', 'error_id' => null];
        if ($fromError > 0) {
            $stmt = admin_db()->prepare('SELECT * FROM client_errors WHERE id = ?');
            $stmt->execute([$fromError]);
            $error = $stmt->fetch();
            if ($error !== false) {
                $pages = admin_monitor_error_pages($fromError);
                $current['title'] = mb_strimwidth('JSエラー：' . $error['message'], 0, 200, '…');
                $current['page'] = $pages[0]['page'] ?? '';
                $current['memo'] = $error['source'] . ($error['line'] > 0 ? ':' . $error['line'] : '') . ' で ' . $error['count'] . '回（エラー監視 #' . $fromError . '）';
                $current['error_id'] = $fromError;
            }
        }
    }
}

if ($showForm) {
    admin_render_header((int) $current['id'] > 0 ? '既知の不具合の編集' : '既知の不具合を登録', 'issues');
    admin_render_flash();
    ?>
<?php if ($errors !== []): ?>
  <div class="alert alert--error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div>
<?php endif; ?>
<form method="post" action="<?= h(admin_url('/issues')) ?>" class="form panel panel--wide">
  <?= admin_csrf_field() ?>
  <input type="hidden" name="id" value="<?= (int) $current['id'] ?>">
  <input type="hidden" name="error_id" value="<?= (int) ($current['error_id'] ?? 0) ?>">
  <label class="form__label" for="title">タイトル</label>
  <input class="form__input" id="title" name="title" value="<?= h($current['title']) ?>" maxlength="200" required>
  <label class="form__label" for="severity">重要度</label>
  <select class="form__input" id="severity" name="severity">
    <?php foreach (ADMIN_ISSUE_SEVERITY_LABELS as $key => $label): ?><option value="<?= h($key) ?>"<?= $current['severity'] === $key ? ' selected' : '' ?>><?= h($label) ?></option><?php endforeach; ?>
  </select>
  <label class="form__label" for="status">状態</label>
  <select class="form__input" id="status" name="status">
    <?php foreach (ADMIN_ISSUE_STATUS_LABELS as $key => $label): ?><option value="<?= h($key) ?>"<?= $current['status'] === $key ? ' selected' : '' ?>><?= h($label) ?></option><?php endforeach; ?>
  </select>
  <label class="form__label" for="page">ページ（例：/seimei）</label>
  <input class="form__input" id="page" name="page" value="<?= h($current['page']) ?>" maxlength="300">
  <label class="form__label" for="memo">メモ（原因・対応の予定など）</label>
  <textarea class="form__input" id="memo" name="memo" rows="6"><?= h($current['memo']) ?></textarea>
  <?php if (!empty($current['error_id'])): ?>
    <p class="muted">関連するエラー：<a href="<?= h(admin_url('/errors?id=' . (int) $current['error_id'])) ?>">エラー監視 #<?= (int) $current['error_id'] ?></a></p>
  <?php endif; ?>
  <div class="form--inline">
    <button type="submit" class="btn btn--primary">保存</button>
    <a class="btn btn--ghost" href="<?= h(admin_url('/issues')) ?>">一覧へ</a>
  </div>
</form>
    <?php
    admin_render_footer();
    exit;
}

$filter = (string) ($_GET['filter'] ?? 'active');
$where = $filter === 'all' ? '' : "WHERE status IN ('open', 'doing')";
$rows = admin_db()->query(
    "SELECT * FROM known_issues {$where}
     ORDER BY CASE status WHEN 'doing' THEN 0 WHEN 'open' THEN 1 ELSE 2 END, CASE severity WHEN 'high' THEN 0 WHEN 'mid' THEN 1 ELSE 2 END, updated_at DESC"
)->fetchAll();
$staleBefore = (new DateTimeImmutable('-' . ADMIN_ISSUE_STALE_DAYS . ' days'))->format(DATE_ATOM);

admin_render_header('既知の不具合', 'issues');
admin_render_flash();
?>
<p class="muted">わかっているが、まだ直していない不具合の一覧です。重要度「高」で <?= ADMIN_ISSUE_STALE_DAYS ?> 日以上更新が無いものは、上部に警告を出します。</p>
<div class="form--inline">
  <a class="btn btn--primary" href="<?= h(admin_url('/issues?new=1')) ?>">登録する</a>
  <a class="btn btn--ghost" href="<?= h(admin_url('/issues' . ($filter === 'all' ? '' : '?filter=all'))) ?>"><?= $filter === 'all' ? '未完了だけ表示' : '対応済・見送りも表示' ?></a>
</div>
<div class="table-wrap table-wrap--spaced">
  <table class="table">
    <thead><tr><th>重要度</th><th>タイトル</th><th>状態</th><th>ページ</th><th>更新</th></tr></thead>
    <tbody>
<?php if ($rows === []): ?>
      <tr><td colspan="5" class="muted">ありません。</td></tr>
<?php endif; ?>
<?php foreach ($rows as $r): $stale = $r['severity'] === 'high' && in_array($r['status'], ['open', 'doing'], true) && $r['updated_at'] < $staleBefore; ?>
      <tr class="<?= $stale ? 'is-warn' : '' ?>">
        <td class="nowrap"><span class="badge badge--sev-<?= h($r['severity']) ?>"><?= h(ADMIN_ISSUE_SEVERITY_LABELS[$r['severity']]) ?></span></td>
        <td><a href="<?= h(admin_url('/issues?id=' . $r['id'])) ?>"><?= h($r['title']) ?></a></td>
        <td class="nowrap"><?= h(ADMIN_ISSUE_STATUS_LABELS[$r['status']]) ?></td>
        <td><?= h($r['page']) ?></td>
        <td class="nowrap"><?= h(admin_format_time($r['updated_at'])) ?><?= $stale ? ' <span class="muted">（' . ADMIN_ISSUE_STALE_DAYS . '日以上更新なし）</span>' : '' ?></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php
admin_render_footer();
