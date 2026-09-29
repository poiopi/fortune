<?php
declare(strict_types=1);

// サイトヘルス：最新の結果・変化の履歴・「今すぐ実行」。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    set_time_limit(120);
    $summary = admin_health_run(true);
    admin_audit('health_run', null, $summary);
    admin_flash_redirect('ok', '実行しました（' . $summary . '）。', '/health');
}

$latest = admin_health_latest();
$changes = admin_db()->query('SELECT * FROM health_changes ORDER BY id DESC LIMIT 30')->fetchAll();
$cron = admin_cron_health();
$openErrors = (int) admin_db()->query("SELECT COUNT(*) FROM client_errors WHERE status = 'open'")->fetchColumn();

admin_render_header('サイトヘルス', 'health');
admin_render_flash();
?>
<p class="muted">本番サイト（<?= h(admin_config()['site_url']) ?>）を自動でチェックしています。主要ページは毎時、そのほかは毎日9時。🔴になったとき・🔴から戻ったときだけ通知します。</p>
<form method="post" action="<?= h(admin_url('/health')) ?>" class="form form--inline">
  <?= admin_csrf_field() ?>
  <button type="submit" class="btn btn--primary">今すぐ全部チェックする</button>
  <span class="muted">10秒ほどかかります</span>
</form>

<div class="table-wrap table-wrap--spaced">
  <table class="table">
    <thead><tr><th></th><th>項目</th><th>結果</th><th>確認日時</th></tr></thead>
    <tbody>
<?php if ($latest === []): ?>
      <tr><td colspan="4" class="muted">まだ一度もチェックしていません。「今すぐ全部チェックする」を押すか、次のcronを待ってください。</td></tr>
<?php endif; ?>
<?php foreach ($latest as $key => $row): ?>
      <tr class="<?= $row['status'] === 'red' ? 'is-warn' : '' ?>">
        <td class="health-icon"><?= ADMIN_HEALTH_STATUS_ICONS[$row['status']] ?? '' ?></td>
        <td class="nowrap"><?= h(ADMIN_HEALTH_LABELS[$key]) ?></td>
        <td>
          <?= h($row['message']) ?>
          <?php if ($row['detail'] !== null && $row['detail'] !== ''): ?>
            <details class="details"><summary>詳細</summary><pre class="preview"><?= h($row['detail']) ?></pre></details>
          <?php endif; ?>
        </td>
        <td class="nowrap"><?= h(admin_format_time($row['checked_at'])) ?></td>
      </tr>
<?php endforeach; ?>
      <tr>
        <td class="health-icon"><?= $cron['state'] === 'ok' ? '🟢' : '🔴' ?></td>
        <td class="nowrap">cronの稼働</td>
        <td><?= $cron['state'] === 'ok' ? '正常に動いています' : ($cron['state'] === 'never' ? 'まだ一度も動いていません' : ADMIN_CRON_STALE_MINUTES . '分以上動いていません') ?></td>
        <td class="nowrap"><?= h(admin_format_time($cron['last'])) ?></td>
      </tr>
      <tr>
        <td class="health-icon"><?= $openErrors === 0 ? '🟢' : '🟡' ?></td>
        <td class="nowrap">公開ページのJSエラー</td>
        <td><?= $openErrors === 0 ? '未対応はありません' : '未対応が' . $openErrors . '種類あります（<a href="' . h(admin_url('/errors')) . '">エラー監視</a>）' ?></td>
        <td class="nowrap">常時</td>
      </tr>
    </tbody>
  </table>
</div>

<section class="panel panel--wide">
  <h2 class="panel__title">変化の履歴（最近30件）</h2>
<?php if ($changes === []): ?>
  <p class="muted">まだありません。</p>
<?php else: ?>
  <div class="table-wrap">
    <table class="table">
      <thead><tr><th>日時</th><th>項目</th><th>変化</th><th>内容</th></tr></thead>
      <tbody>
<?php foreach ($changes as $c): ?>
        <tr>
          <td class="nowrap"><?= h(admin_format_time($c['at'])) ?></td>
          <td class="nowrap"><?= h(ADMIN_HEALTH_LABELS[$c['check_key']] ?? $c['check_key']) ?></td>
          <td class="nowrap"><?= $c['old_status'] !== null ? ADMIN_HEALTH_STATUS_ICONS[$c['old_status']] . ' → ' : '初回 ' ?><?= ADMIN_HEALTH_STATUS_ICONS[$c['new_status']] ?? '' ?></td>
          <td><?= h($c['message']) ?></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
</section>
<?php
admin_render_footer();
