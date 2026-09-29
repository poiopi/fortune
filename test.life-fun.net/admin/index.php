<?php
declare(strict_types=1);

// ダッシュボード。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

$lastLogin = admin_db()->query(
    "SELECT at, ip FROM audit_logs WHERE action = 'login' ORDER BY id DESC LIMIT 1 OFFSET 1"
)->fetch() ?: null;
$failureStmt = admin_db()->prepare(
    "SELECT COUNT(*) FROM audit_logs WHERE action IN ('login_failed', 'login_blocked') AND at > ?"
);
$failureStmt->execute([(new DateTimeImmutable('-1 day'))->format(DATE_ATOM)]);
$recentFailures = (int) $failureStmt->fetchColumn();

$cron = admin_cron_health();
$cronLabel = ['ok' => '🟢 正常', 'stale' => '🔴 止まっています', 'never' => '🔴 まだ一度も動いていません'][$cron['state']];
$notifications = admin_db()->query('SELECT channel, event, status, sent_at FROM notifications ORDER BY id DESC LIMIT 5')->fetchAll();
$channelLabels = ['email' => 'メール', 'discord' => 'Discord'];

// SNS：今日以降の投稿枠（4件）
$today = (new DateTimeImmutable('today'))->format('Y-m-d');
$slotStmt = admin_db()->prepare(
    "SELECT q.slot_date, s.title, s.kind, s.status AS stock_status,
            group_concat(q.platform || ':' || q.status, ',') AS rows_info, MIN(q.scheduled_at) AS scheduled_at
     FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
     WHERE q.slot_date >= ? GROUP BY q.slot_date ORDER BY q.slot_date LIMIT 4"
);
$slotStmt->execute([$today]);
$slots = $slotStmt->fetchAll();
$unapproved = (int) admin_db()->query("SELECT COUNT(*) FROM post_stock WHERE status = 'pending_review'")->fetchColumn();
$daysLeft = admin_sns_stock_days_left();

// 自動モード切替の目安：直近14日に承認した（手書き以外の）ストックの数と、そのうち修正したものの数
$reviewStmt = admin_db()->prepare("SELECT COUNT(*) AS approved, COALESCE(SUM(edited), 0) AS edited FROM post_stock WHERE approved_at > ? AND source <> 'manual'");
$reviewStmt->execute([(new DateTimeImmutable('-14 days'))->format(DATE_ATOM)]);
$review = $reviewStmt->fetch();

$health = admin_health_latest();
$healthCounts = array_count_values(array_column($health, 'status'));
$seoCounts = admin_seo_open_counts();
$seoLast = admin_seo_last_run();

admin_render_header('ダッシュボード', 'dashboard');
?>
<section class="panel panel--wide">
  <h2 class="panel__title">ログイン情報</h2>
  <p>前回のログイン：<?= $lastLogin !== null ? h(admin_format_time($lastLogin['at'])) . '（' . h($lastLogin['ip']) . '）' : '記録なし' ?></p>
  <p>直近24時間のログイン失敗：<?= $recentFailures ?> 件<?= $recentFailures > 0 ? '（<a href="' . h(admin_url('/logs')) . '">操作ログ</a>で確認できます）' : '' ?></p>
</section>
<div class="panels">
  <section class="panel">
    <h2 class="panel__title">SNS投稿の予定</h2>
<?php if ($slots === []): ?>
    <p class="muted">予定はありません。</p>
<?php endif; ?>
<?php foreach ($slots as $slot): $parts = array_map(static function (string $r): string { [$p, $st] = explode(':', $r); return admin_sns_label($p) . ' ' . (ADMIN_QUEUE_STATUS_LABELS[$st] ?? $st); }, explode(',', $slot['rows_info'])); ?>
    <p><?= h(admin_date_label($slot['slot_date'], true)) ?> <?= h(substr(admin_format_time($slot['scheduled_at']), 11, 5)) ?>
      <span class="badge"><?= h(admin_kind_label($slot['kind'])) ?></span> <?= h($slot['title']) ?>
      <?= $slot['stock_status'] !== 'approved' ? '<span class="badge badge--pending_review">未承認</span>' : '' ?>
      <br><span class="muted"><?= h(implode(' / ', $parts)) ?></span></p>
<?php endforeach; ?>
    <p><a href="<?= h(admin_url('/sns/')) ?>">投稿予定を開く</a></p>
  </section>
  <section class="panel">
    <h2 class="panel__title">投稿ストック</h2>
    <p>未承認：<?= $unapproved ?> 件<?= $unapproved > 0 ? '（<a href="' . h(admin_url('/sns/stock?status=pending_review')) . '">確認する</a>）' : '' ?></p>
<?php foreach ($daysLeft as $k): if ($k['per_week'] === 0) { continue; } ?>
    <p><?= h($k['label']) ?>：残り <?= $k['count'] ?> 件（約<?= (int) $k['days'] ?>日分）<?= $k['days'] < ADMIN_STOCK_LOW_DAYS ? ' <span class="badge badge--failed">少ない</span>' : '' ?></p>
<?php endforeach; ?>
  </section>
  <section class="panel">
    <h2 class="panel__title">確認モードの目安（直近14日）</h2>
    <p>承認 <?= (int) $review['approved'] ?> 件 ／ うち修正あり <?= (int) $review['edited'] ?> 件</p>
    <p class="muted">修正ゼロが2週間続いたら、自動モードへの切り替えを検討（<a href="<?= h(admin_url('/settings')) ?>">設定</a>）。現在：<?= admin_post_mode() === 'review' ? '確認モード' : '自動モード' ?></p>
  </section>
  <section class="panel">
    <h2 class="panel__title">サイトの状態</h2>
<?php if ($health === []): ?>
    <p class="muted">まだチェックしていません。</p>
<?php else: ?>
    <p>🟢 <?= $healthCounts['green'] ?? 0 ?>　🟡 <?= $healthCounts['yellow'] ?? 0 ?>　🔴 <?= $healthCounts['red'] ?? 0 ?></p>
<?php foreach ($health as $key => $row): if ($row['status'] === 'green') { continue; } ?>
    <p><?= ADMIN_HEALTH_STATUS_ICONS[$row['status']] ?> <?= h(ADMIN_HEALTH_LABELS[$key]) ?>：<?= h($row['message']) ?></p>
<?php endforeach; ?>
<?php endif; ?>
    <p><a href="<?= h(admin_url('/health')) ?>">サイトヘルスを開く</a></p>
  </section>
  <section class="panel">
    <h2 class="panel__title">cronの状態</h2>
    <p><?= h($cronLabel) ?></p>
    <p class="muted">最終実行：<?= h(admin_format_time($cron['last'])) ?>（<a href="<?= h(admin_url('/settings')) ?>">詳細</a>）</p>
  </section>
  <section class="panel">
    <h2 class="panel__title">最近の通知</h2>
<?php if ($notifications === []): ?>
    <p class="muted">まだ通知はありません。</p>
<?php endif; ?>
<?php foreach ($notifications as $n): ?>
    <p><?= h(admin_format_time($n['sent_at'])) ?> <?= h($channelLabels[$n['channel']] ?? $n['channel']) ?> <?= $n['status'] === 'sent' ? '送信' : '<strong>失敗</strong>' ?>（<?= h($n['event']) ?>）</p>
<?php endforeach; ?>
  </section>
  <section class="panel">
    <h2 class="panel__title">SEO点検</h2>
<?php if ($seoLast === null): ?>
    <p class="muted">まだ点検していません。</p>
<?php else: ?>
    <p>未対応：<?= array_sum($seoCounts) ?> 件</p>
<?php foreach ($seoCounts as $rule => $n): ?>
    <p class="muted"><?= h(ADMIN_SEO_RULES[$rule] ?? $rule) ?>：<?= $n ?>件</p>
<?php endforeach; ?>
    <p class="muted">前回：<?= h(admin_format_time($seoLast['finished_at'] ?? $seoLast['queued_at'])) ?></p>
<?php endif; ?>
    <p><a href="<?= h(admin_url('/seo')) ?>">SEO点検を開く</a>　<a href="<?= h(admin_url('/pages')) ?>">ページ台帳</a></p>
  </section>
</div>
<?php
admin_render_footer();
