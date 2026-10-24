<?php
declare(strict_types=1);

// 設定 → 自動実行：cronの状態・ジョブごとの最終実行・実行履歴・cron実行時間テスト（段階2で設定画面から分けた）。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';
require_once __DIR__ . '/../_admin-lib/cron-probe.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    if ((string) ($_POST['action'] ?? '') === 'request_probe') {
        $probe = admin_cron_probe_view();
        if (in_array($probe['status'], ['requested', 'running'], true)) {
            admin_flash_redirect('error', 'cron実行時間テストは予約済み、または実行中です。', '/cron');
        }
        admin_request_cron_probe();
        admin_audit('cron_probe_request');
        admin_flash_redirect('ok', 'cron実行時間テストを予約しました。次のcron（1分以内）で始まり、最大5分かかります。', '/cron');
    }
    admin_flash_redirect('error', '不明な操作です。', '/cron');
}

$cron = admin_cron_health();
$cronStateLabel = ['ok' => '正常に動いています', 'stale' => '止まっています', 'never' => 'まだ一度も動いていません'][$cron['state']];
$jobs = admin_db()->query('SELECT * FROM jobs ORDER BY job')->fetchAll();
$runs = admin_db()->query('SELECT * FROM cron_runs ORDER BY id DESC LIMIT 10')->fetchAll();
$probe = admin_cron_probe_view();
$probeLabels = [
    'none'      => '未実施',
    'requested' => '予約済み（次のcronで開始します）',
    'running'   => '実行中',
    'done'      => '完了（' . ADMIN_PROBE_MAX_SECONDS . '秒間止められずに動きました）',
    'stopped'   => '途中で止まりました（下の「動けた秒数」が上限の目安です）',
];

admin_render_header('自動実行', 'cron');
admin_render_flash();
?>
<section class="panel panel--wide">
  <h2 class="panel__title">cronの状態</h2>
  <p>状態：<span class="status status--<?= $cron['state'] === 'ok' ? 'ok' : 'error' ?>"><?= h($cronStateLabel) ?></span>（最終実行：<?= h(admin_format_time($cron['last'])) ?>）</p>
  <div class="table-wrap">
    <table class="table">
      <thead><tr><th>ジョブ</th><th>最終開始</th><th>最終終了</th><th>結果</th><th>メッセージ</th></tr></thead>
      <tbody>
<?php if ($jobs === []): ?>
        <tr><td colspan="5" class="muted">まだ一度も実行されていません。</td></tr>
<?php endif; ?>
<?php foreach ($jobs as $job): ?>
        <tr class="<?= $job['last_status'] === 'failed' ? 'is-warn' : '' ?>">
          <td><?= h(ADMIN_JOBS[$job['job']]['label'] ?? $job['job']) ?></td>
          <td class="nowrap"><?= h(admin_format_time($job['last_started_at'])) ?></td>
          <td class="nowrap"><?= h(admin_format_time($job['last_finished_at'])) ?></td>
          <td><?= h($job['last_status']) ?></td>
          <td><?= h($job['last_message']) ?></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <h3 class="panel__subtitle">実行履歴（毎分以外・直近10件）</h3>
  <div class="table-wrap">
    <table class="table">
      <thead><tr><th>ジョブ</th><th>開始</th><th>結果</th><th>メッセージ</th></tr></thead>
      <tbody>
<?php if ($runs === []): ?>
        <tr><td colspan="4" class="muted">記録はまだありません。</td></tr>
<?php endif; ?>
<?php foreach ($runs as $run): ?>
        <tr class="<?= $run['status'] === 'failed' ? 'is-warn' : '' ?>">
          <td><?= h(ADMIN_JOBS[$run['job']]['label'] ?? $run['job']) ?></td>
          <td class="nowrap"><?= h(admin_format_time($run['started_at'])) ?></td>
          <td><?= h($run['status']) ?></td>
          <td><?= h($run['message']) ?></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">cron実行時間テスト</h2>
  <p class="muted">cronで動かしたとき、何秒まで止められずに動けるかと、外部への接続を確認します（最大<?= ADMIN_PROBE_MAX_SECONDS ?>秒・1回だけ）。</p>
  <p>状態：<?= h($probeLabels[$probe['status']]) ?></p>
<?php if ($probe['result'] !== null): $r = $probe['result'] + ['started_at' => null, 'php_version' => '', 'sapi' => '', 'max_execution_time' => '', 'memory_limit' => '', 'https' => [], 'alive_seconds' => 0, 'last_alive_at' => null]; ?>
  <ul class="kv">
    <li>開始：<?= h(admin_format_time($r['started_at'])) ?></li>
    <li>PHP：<?= h($r['php_version']) ?>（SAPI：<?= h($r['sapi']) ?>）</li>
    <li>max_execution_time：<?= h($r['max_execution_time']) ?>　memory_limit：<?= h($r['memory_limit']) ?></li>
<?php foreach ($r['https'] as $url => $code): ?>
    <li>接続 <?= h($url) ?>：<?= h($code) ?></li>
<?php endforeach; ?>
    <li>動けた秒数：<?= (int) $r['alive_seconds'] ?> 秒（最終記録：<?= h(admin_format_time($r['last_alive_at'])) ?>）</li>
  </ul>
<?php endif; ?>
  <form method="post" action="<?= h(admin_url('/cron')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="request_probe">
    <button type="submit" class="btn btn--ghost"<?= in_array($probe['status'], ['requested', 'running'], true) ? ' disabled' : '' ?>>テストを予約する</button>
  </form>
</section>
<?php
admin_render_footer();
