<?php
declare(strict_types=1);

// SNS投稿：ストック一覧・JSON取り込み・既存クイズの取り込み。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

function stock_import_message(array $result): array
{
    if (!$result['ok']) {
        return ['error', '取り込めませんでした：' . $result['fatal']];
    }
    $lines = ['登録 ' . $result['imported'] . '件 ／ スキップ ' . count($result['skipped']) . '件 ／ エラー ' . count($result['errors']) . '件'];
    foreach ($result['skipped'] as $s) {
        $lines[] = 'スキップ：' . $s;
    }
    foreach ($result['errors'] as $e) {
        $lines[] = 'エラー：' . $e;
    }
    return [$result['errors'] === [] ? 'ok' : 'error', implode("\n", $lines)];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');

    if ($action === 'import_json') {
        $file = $_FILES['file'] ?? null;
        if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
            admin_flash_redirect('error', 'ファイルを選んでください。', '/sns/stock');
        }
        $name = mb_substr(basename((string) $file['name']), 0, 100);
        $result = admin_import_stock_json((string) file_get_contents($file['tmp_name']), $name);
        admin_audit('stock_import', $name, $result['ok'] ? "登録{$result['imported']} スキップ" . count($result['skipped']) . ' エラー' . count($result['errors']) : $result['fatal']);
        if ($result['imported'] > 0) {
            admin_sns_assign();
        }
        [$type, $text] = stock_import_message($result);
        admin_flash_redirect($type, $text, '/sns/stock');
    }

    if ($action === 'import_quiz') {
        $result = admin_import_quiz_data();
        admin_audit('quiz_import', null, "登録{$result['imported']} スキップ" . count($result['skipped']) . ' エラー' . count($result['errors']));
        if ($result['imported'] > 0) {
            admin_sns_assign();
        }
        [$type, $text] = stock_import_message($result);
        admin_flash_redirect($type, $text, '/sns/stock');
    }

    admin_flash_redirect('error', '不明な操作です。', '/sns/stock');
}

$kinds = admin_post_kinds();
$filterKind = isset($_GET['kind'], $kinds[$_GET['kind']]) ? (string) $_GET['kind'] : '';
$filterStatus = isset($_GET['status'], ADMIN_STOCK_STATUS_LABELS[$_GET['status']]) ? (string) $_GET['status'] : '';

$where = [];
$params = [];
if ($filterKind !== '') {
    $where[] = 's.kind = ?';
    $params[] = $filterKind;
}
if ($filterStatus !== '') {
    $where[] = 's.status = ?';
    $params[] = $filterStatus;
} else {
    $where[] = "s.status <> 'archived'";
}
$stmt = admin_db()->prepare(
    "SELECT s.*,
       (SELECT group_concat(platform, ',') FROM post_stock_bodies b WHERE b.stock_id = s.id) AS platforms,
       (SELECT q.slot_date || '|' || q.status FROM post_queue q WHERE q.stock_id = s.id AND q.status <> 'canceled' ORDER BY q.id DESC LIMIT 1) AS queue_info
     FROM post_stock s WHERE " . implode(' AND ', $where) . ' ORDER BY s.id DESC LIMIT 300'
);
$stmt->execute($params);
$stocks = $stmt->fetchAll();
$daysLeft = admin_sns_stock_days_left();

admin_render_header('SNS投稿', 'sns');
admin_render_sns_tabs('stock');
admin_render_flash();
?>
<div class="panels">
<?php foreach ($daysLeft as $k): ?>
  <section class="panel">
    <h2 class="panel__title"><?= h($k['label']) ?></h2>
    <p>未使用 <?= $k['count'] ?> 件<?= $k['per_week'] > 0 ? '（週' . $k['per_week'] . '回・約' . $k['days'] . '日分）' : '（ローテーションに無し）' ?></p>
  </section>
<?php endforeach; ?>
</div>

<section class="panel panel--wide">
  <h2 class="panel__title">取り込み</h2>
  <form method="post" action="<?= h(admin_url('/sns/stock')) ?>" enctype="multipart/form-data" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="import_json">
    <input type="file" name="file" accept=".json,application/json" required>
    <button type="submit" class="btn btn--primary">JSONを取り込む</button>
  </form>
  <form method="post" action="<?= h(admin_url('/sns/stock')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="import_quiz">
    <button type="submit" class="btn btn--ghost">既存クイズの投稿文を取り込む</button>
    <span class="muted">このサーバーの quiz/ にあるクイズの Threads 用投稿文を取り込みます（取り込み済みは増えません）。</span>
  </form>
  <p class="muted">取り込み直後の状態：<?= admin_post_mode() === 'review' ? '未承認（確認モード）' : '承認済（自動モード）' ?>　<a href="<?= h(admin_url('/sns/stock-edit')) ?>">手書きで1件作る</a></p>
</section>

<form method="get" action="<?= h(admin_url('/sns/stock')) ?>" class="form form--inline">
  <select class="form__input" name="kind">
    <option value="">すべての種別</option>
    <?php foreach ($kinds as $key => $k): ?><option value="<?= h($key) ?>"<?= $filterKind === $key ? ' selected' : '' ?>><?= h($k['label']) ?></option><?php endforeach; ?>
  </select>
  <select class="form__input" name="status">
    <option value="">アーカイブ以外</option>
    <?php foreach (ADMIN_STOCK_STATUS_LABELS as $key => $label): ?><option value="<?= h($key) ?>"<?= $filterStatus === $key ? ' selected' : '' ?>><?= h($label) ?></option><?php endforeach; ?>
  </select>
  <button type="submit" class="btn btn--ghost">絞り込む</button>
</form>

<div class="table-wrap">
  <table class="table">
    <thead><tr><th>ID</th><th>種別</th><th>タイトル</th><th>状態</th><th>SNS</th><th>予定・結果</th><th>出所</th></tr></thead>
    <tbody>
<?php if ($stocks === []): ?>
      <tr><td colspan="7" class="muted">ストックはまだありません。</td></tr>
<?php endif; ?>
<?php foreach ($stocks as $s): [$qDate, $qStatus] = $s['queue_info'] !== null ? explode('|', $s['queue_info']) : [null, null]; ?>
      <tr>
        <td><?= (int) $s['id'] ?></td>
        <td class="nowrap"><?= h(admin_kind_label($s['kind'])) ?></td>
        <td><a href="<?= h(admin_url('/sns/stock-edit?id=' . $s['id'])) ?>"><?= h($s['title']) ?></a><?= (int) $s['edited'] === 1 ? ' <span class="badge">修正あり</span>' : '' ?></td>
        <td class="nowrap"><span class="badge badge--<?= h($s['status']) ?>"><?= h(ADMIN_STOCK_STATUS_LABELS[$s['status']]) ?></span></td>
        <td class="nowrap"><?= h(implode(' / ', array_map('admin_sns_label', array_filter(explode(',', (string) $s['platforms']))))) ?></td>
        <td class="nowrap"><?= $qDate !== null ? h(admin_date_label($qDate)) . ' ' . h(ADMIN_QUEUE_STATUS_LABELS[$qStatus] ?? $qStatus) : '<span class="muted">未使用</span>' ?></td>
        <td class="nowrap"><?= h(ADMIN_STOCK_SOURCE_LABELS[$s['source']] ?? $s['source']) ?></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php
admin_render_footer();
