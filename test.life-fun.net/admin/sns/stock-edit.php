<?php
declare(strict_types=1);

// SNS投稿：ストック1件の確認・編集・承認・アーカイブ。id なしで開くと手書きの新規作成。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stock = $id > 0 ? admin_stock_get($id) : null;
if ($id > 0 && $stock === null) {
    admin_flash_redirect('error', 'ストックが見つかりません。', '/sns/stock');
}
$selfPath = '/sns/stock-edit' . ($id > 0 ? '?id=' . $id : '');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');

    if (in_array($action, ['save', 'save_approve'], true)) {
        $input = [
            'kind'     => (string) ($_POST['kind'] ?? ''),
            'title'    => (string) ($_POST['title'] ?? ''),
            'link_url' => (string) ($_POST['link_url'] ?? ''),
            'notes'    => (string) ($_POST['notes'] ?? ''),
            'bodies'   => [],
        ];
        foreach (array_keys(ADMIN_SNS_PLATFORMS) as $platform) {
            $body = trim((string) ($_POST['body'][$platform] ?? ''));
            if ($body !== '') {
                $input['bodies'][$platform] = ['title' => (string) ($_POST['body_title'][$platform] ?? ''), 'body' => $body];
            }
        }
        $errors = admin_stock_validate($input);
        if ($errors === []) {
            $data = admin_stock_normalize($input);
            if ($stock === null) {
                $id = admin_stock_create($data, 'manual', null, null);
                admin_audit('stock_create', '#' . $id, $data['title']);
                $changed = false;
            } else {
                $changed = admin_stock_update($id, $data);
                if ($changed) {
                    admin_audit('stock_edit', '#' . $id, $data['title']);
                }
            }
            if ($action === 'save_approve') {
                admin_stock_set_status($id, 'approved');
                admin_audit('stock_approve', '#' . $id, $changed ? '修正して承認' : '修正なしで承認');
            }
            admin_sns_assign();
            admin_flash_redirect('ok', $action === 'save_approve' ? '保存して承認しました。' : '保存しました。', '/sns/stock-edit?id=' . $id);
        }
        // エラー時は入力内容を残して再表示
        $stock = ($stock ?? ['id' => 0, 'status' => 'pending_review', 'source' => 'manual', 'edited' => 0, 'ext_id' => null])
            + [];
        $stock = array_merge($stock, admin_stock_normalize($input));
    } elseif ($stock !== null && in_array($action, ['approve', 'unapprove', 'archive', 'restore'], true)) {
        $map = [
            'approve'   => ['approved', 'stock_approve', '承認しました。'],
            'unapprove' => ['pending_review', 'stock_unapprove', '未承認に戻しました。'],
            'archive'   => ['archived', 'stock_archive', 'アーカイブしました（まだ投稿時刻が来ていない予約は外しました）。'],
            'restore'   => ['pending_review', 'stock_restore', 'アーカイブを解除しました（未承認に戻りました）。'],
        ];
        [$status, $auditAction, $message] = $map[$action];
        if ($action === 'archive') {
            admin_sns_unschedule_stock($id);
        }
        admin_stock_set_status($id, $status);
        admin_audit($auditAction, '#' . $id, $action === 'approve' ? '修正なしで承認' : null);
        admin_sns_assign();
        admin_flash_redirect('ok', $message, $selfPath);
    } else {
        admin_flash_redirect('error', '不明な操作です。', $selfPath);
    }
}

$kinds = admin_post_kinds(true);
$isNew = $stock === null || (int) ($stock['id'] ?? 0) === 0;
$current = $stock ?? ['kind' => array_key_first($kinds), 'title' => '', 'link_url' => '', 'notes' => '', 'bodies' => [], 'status' => 'pending_review'];

$queueRows = [];
if (!$isNew) {
    $q = admin_db()->prepare('SELECT * FROM post_queue WHERE stock_id = ? ORDER BY slot_date, id');
    $q->execute([$id]);
    $queueRows = $q->fetchAll();
}

admin_render_header($isNew ? 'ストックを作る' : 'ストックの確認・編集', 'sns');
admin_render_sns_tabs('stock');
admin_render_flash();
?>
<?php if ($errors !== []): ?>
  <div class="alert alert--error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div>
<?php endif; ?>

<?php if (!$isNew): ?>
<section class="panel panel--wide">
  <p>
    <span class="badge badge--<?= h($current['status']) ?>"><?= h(ADMIN_STOCK_STATUS_LABELS[$current['status']]) ?></span>
    ID <?= (int) $id ?>　出所：<?= h(ADMIN_STOCK_SOURCE_LABELS[$current['source']] ?? $current['source']) ?>
    <?= $current['ext_id'] !== null ? '　ext_id：' . h($current['ext_id']) : '' ?>
    <?= (int) $current['edited'] === 1 ? '　<span class="badge">修正あり</span>' : '' ?>
  </p>
  <?php if ($queueRows !== []): ?>
    <p class="muted">投稿予定：<?php foreach ($queueRows as $r): ?><?= h(admin_date_label($r['slot_date'])) ?> <?= h(admin_sns_label($r['platform'])) ?> <?= h(ADMIN_QUEUE_STATUS_LABELS[$r['status']] ?? $r['status']) ?>　<?php endforeach; ?></p>
  <?php endif; ?>
  <div class="form--inline">
    <?php foreach (['approve' => ['承認する（修正なし）', $current['status'] === 'pending_review'], 'unapprove' => ['未承認に戻す', $current['status'] === 'approved'], 'archive' => ['アーカイブ', $current['status'] !== 'archived'], 'restore' => ['アーカイブ解除', $current['status'] === 'archived']] as $act => [$label, $show]): ?>
      <?php if ($show): ?>
        <form method="post" action="<?= h(admin_url($selfPath)) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="<?= h($act) ?>"><button type="submit" class="btn <?= $act === 'approve' ? 'btn--primary' : 'btn--ghost' ?>"<?= $act === 'archive' ? ' data-confirm="アーカイブしますか？（未投稿の予約は外れます）"' : '' ?>><?= h($label) ?></button></form>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<form method="post" action="<?= h(admin_url($selfPath)) ?>" class="form panel panel--wide">
  <?= admin_csrf_field() ?>
  <label class="form__label" for="kind">種別</label>
  <select class="form__input" id="kind" name="kind">
    <?php foreach ($kinds as $key => $k): ?><option value="<?= h($key) ?>"<?= $current['kind'] === $key ? ' selected' : '' ?>><?= h($k['label']) ?></option><?php endforeach; ?>
  </select>
  <label class="form__label" for="title">管理用タイトル</label>
  <input class="form__input" id="title" name="title" value="<?= h($current['title']) ?>" maxlength="100" required>
  <label class="form__label" for="link_url">リンク先URL（本文の {link} がUTM付きのこのURLになります）</label>
  <input class="form__input" id="link_url" name="link_url" type="url" value="<?= h((string) ($current['link_url'] ?? '')) ?>" placeholder="<?= h(admin_config()['site_url']) ?>/...">

  <?php foreach (ADMIN_SNS_PLATFORMS as $platform => $def): $b = $current['bodies'][$platform] ?? ['title' => '', 'body' => '']; ?>
    <fieldset class="fieldset">
      <legend><?= h($def['label']) ?>の本文<?= $def['max_chars'] !== null ? '（リンク込み' . $def['max_chars'] . '文字まで）' : '' ?>　<span class="muted">空欄ならこのSNSには投稿しません</span></legend>
      <?php if ($def['needs_title']): ?>
        <label class="form__label" for="bt-<?= h($platform) ?>">タイトル</label>
        <input class="form__input" id="bt-<?= h($platform) ?>" name="body_title[<?= h($platform) ?>]" value="<?= h((string) ($b['title'] ?? '')) ?>">
      <?php endif; ?>
      <textarea class="form__input" name="body[<?= h($platform) ?>]" rows="<?= $platform === 'note' ? 12 : 6 ?>" data-count="<?= (int) ($def['max_chars'] ?? 0) ?>"><?= h((string) ($b['body'] ?? '')) ?></textarea>
      <?php if (!$isNew && isset($current['bodies'][$platform])): ?>
        <p class="muted">投稿される本文（{link} 置換後）：</p>
        <pre class="preview"><?= h(admin_stock_render_body($current + ['link_url' => $current['link_url'] ?? null], $platform)) ?></pre>
      <?php endif; ?>
    </fieldset>
  <?php endforeach; ?>

  <label class="form__label" for="notes">メモ</label>
  <textarea class="form__input" id="notes" name="notes" rows="2"><?= h((string) ($current['notes'] ?? '')) ?></textarea>
  <div class="form--inline">
    <button type="submit" name="action" value="save" class="btn btn--ghost">保存</button>
    <button type="submit" name="action" value="save_approve" class="btn btn--primary">保存して承認</button>
  </div>
</form>
<?php
admin_render_footer();
