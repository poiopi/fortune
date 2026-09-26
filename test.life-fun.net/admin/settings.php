<?php
declare(strict_types=1);

// 設定：通知先・投稿モード・cronの状態（実行時間テスト）・パスワード変更。
// POST は処理後に同じ画面へリダイレクトし、結果はセッションの flash で1回だけ表示する。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';
require_once __DIR__ . '/../_admin-lib/cron-probe.php';

admin_require_login();

function settings_flash(string $type, string $text): never
{
    $_SESSION['flash'] = ['type' => $type, 'text' => $text];
    admin_redirect('/settings');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');

    if ($action === 'save_notify') {
        $emailEnabled = isset($_POST['email_enabled']);
        $emailTo = trim((string) ($_POST['email_to'] ?? ''));
        $discordEnabled = isset($_POST['discord_enabled']);
        $webhook = trim((string) ($_POST['discord_webhook'] ?? ''));
        $deleteWebhook = isset($_POST['discord_webhook_delete']);

        if ($emailTo !== '' && !filter_var($emailTo, FILTER_VALIDATE_EMAIL)) {
            settings_flash('error', 'メールアドレスの形式が正しくありません。');
        }
        if ($emailEnabled && $emailTo === '') {
            settings_flash('error', 'メール通知をONにする場合は、送信先のメールアドレスを入力してください。');
        }
        if ($webhook !== '' && preg_match(ADMIN_DISCORD_WEBHOOK_PATTERN, $webhook) !== 1) {
            settings_flash('error', 'Discord の Webhook URL の形式が正しくありません（https://discord.com/api/webhooks/… の形）。');
        }
        $hasWebhook = !$deleteWebhook && ($webhook !== '' || admin_setting('notify_discord_webhook') !== null);
        if ($discordEnabled && !$hasWebhook) {
            settings_flash('error', 'Discord 通知をONにする場合は、Webhook URL を入力してください。');
        }

        admin_set_setting('notify_email_enabled', $emailEnabled ? '1' : '0');
        admin_set_setting('notify_email_to', $emailTo);
        admin_set_setting('notify_discord_enabled', $discordEnabled ? '1' : '0');
        if ($deleteWebhook) {
            admin_delete_setting('notify_discord_webhook');
        } elseif ($webhook !== '') {
            admin_set_secret_setting('notify_discord_webhook', $webhook);
        }
        // Webhook URL そのものはログに残さない
        admin_audit('settings_notify', null, sprintf(
            'メール:%s / Discord:%s%s',
            $emailEnabled ? 'ON' : 'OFF',
            $discordEnabled ? 'ON' : 'OFF',
            $deleteWebhook ? '（Webhook削除）' : ($webhook !== '' ? '（Webhook更新）' : '')
        ));
        settings_flash('ok', '通知設定を保存しました。');
    }

    if ($action === 'test_notify') {
        if (admin_notify_channels() === []) {
            settings_flash('error', '有効な通知先がありません。先に通知設定を保存してください。');
        }
        $results = admin_notify('test', "テスト送信です。\n送信日時：" . admin_format_time(admin_now()), true);
        $labels = ['email' => 'メール', 'discord' => 'Discord'];
        $summary = [];
        $allOk = true;
        foreach ($results as $channel => $result) {
            $summary[] = $labels[$channel] . '：' . ($result === 'sent' ? '送信しました' : '失敗（' . substr($result, 8) . '）');
            $allOk = $allOk && $result === 'sent';
        }
        admin_audit('notify_test', null, implode(' / ', $summary));
        settings_flash($allOk ? 'ok' : 'error', implode(' / ', $summary) . ($allOk ? '。届いているか確認してください。' : ''));
    }

    if ($action === 'save_post_mode') {
        $mode = (string) ($_POST['post_mode'] ?? '');
        if (!in_array($mode, ['review', 'auto'], true)) {
            settings_flash('error', '投稿モードの値が正しくありません。');
        }
        admin_set_setting('post_mode', $mode);
        admin_audit('settings_post_mode', null, $mode === 'review' ? '確認モード' : '自動モード');
        settings_flash('ok', '投稿モードを保存しました。');
    }

    if ($action === 'request_probe') {
        $probe = admin_cron_probe_view();
        if (in_array($probe['status'], ['requested', 'running'], true)) {
            settings_flash('error', 'cron実行時間テストは予約済み、または実行中です。');
        }
        admin_request_cron_probe();
        admin_audit('cron_probe_request');
        settings_flash('ok', 'cron実行時間テストを予約しました。次のcron（1分以内）で始まり、最大5分かかります。');
    }

    if ($action === 'change_password') {
        $result = admin_change_password(
            (string) ($_POST['current_password'] ?? ''),
            (string) ($_POST['new_password'] ?? ''),
            (string) ($_POST['new_password_confirm'] ?? '')
        );
        if ($result === 'ok') {
            admin_audit('password_changed');
            settings_flash('ok', 'パスワードを変更しました。');
        }
        admin_audit('password_change_failed', null, $result);
        $messages = [
            'wrong_current' => '現在のパスワードが違います。',
            'too_short'     => '新しいパスワードは' . admin_config()['password_min_length'] . '文字以上にしてください。',
            'mismatch'      => '新しいパスワード（確認）が一致しません。',
        ];
        settings_flash('error', $messages[$result]);
    }

    if ($action === 'save_rotation') {
        $kinds = admin_post_kinds(true);
        $allowedPlatforms = admin_sns_rotation_platforms();
        $update = admin_db()->prepare('UPDATE rotation_rules SET kind = ?, post_time = ?, platforms = ?, active = ? WHERE weekday = ?');
        $summary = [];
        admin_db()->exec('BEGIN IMMEDIATE');
        try {
            foreach (range(0, 6) as $weekday) {
                $row = $_POST['rotation'][$weekday] ?? [];
                $kind = (string) ($row['kind'] ?? '');
                $time = (string) ($row['time'] ?? '');
                $platforms = array_values(array_intersect($allowedPlatforms, (array) ($row['platforms'] ?? [])));
                $active = isset($row['active']);
                if (!isset($kinds[$kind]) || preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $time) !== 1) {
                    throw new InvalidArgumentException(ADMIN_WEEKDAY_LABELS[$weekday] . '曜日の種別または時刻が正しくありません。');
                }
                if ($active && $platforms === []) {
                    throw new InvalidArgumentException(ADMIN_WEEKDAY_LABELS[$weekday] . '曜日の投稿先を1つ以上選んでください。');
                }
                $update->execute([$kind, $time, json_encode($platforms), $active ? 1 : 0, $weekday]);
                $summary[] = ADMIN_WEEKDAY_LABELS[$weekday] . ':' . ($active ? $kinds[$kind]['label'] . ' ' . $time : '休み');
            }
            admin_db()->exec('COMMIT');
        } catch (InvalidArgumentException $e) {
            admin_db()->exec('ROLLBACK');
            settings_flash('error', $e->getMessage());
        }
        $reset = isset($_POST['reset_future']);
        if ($reset) {
            admin_sns_reset_future_rotation();
        }
        $assigned = admin_sns_assign();
        admin_audit('rotation_change', null, implode(' ', $summary) . ($reset ? '（未投稿の自動割り当てをやり直し）' : ''));
        settings_flash('ok', 'ローテーションを保存しました。' . ($reset ? '未投稿の自動割り当てをやり直しました（' . $assigned . '枠）。' : '新しい設定は、まだ割り当てられていない日から使われます。'));
    }

    settings_flash('error', '不明な操作です。');
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$emailEnabled = admin_setting('notify_email_enabled') === '1';
$emailTo = admin_setting('notify_email_to') ?? '';
$discordEnabled = admin_setting('notify_discord_enabled') === '1';
$webhook = admin_secret_setting('notify_discord_webhook');
$webhookHint = $webhook === null ? null : '…' . substr($webhook, -6);
$postMode = admin_setting('post_mode') ?? 'review';
$rotation = admin_rotation_rules(false);

$cron = admin_cron_health();
$cronStateLabel = ['ok' => '🟢 正常', 'stale' => '🔴 止まっています', 'never' => '🔴 まだ一度も動いていません'][$cron['state']];
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

admin_render_header('設定', 'settings');
?>
<?php if ($flash !== null): ?>
  <p class="alert alert--<?= $flash['type'] === 'ok' ? 'ok' : 'error' ?>"><?= h($flash['text']) ?></p>
<?php endif; ?>

<section class="panel panel--wide">
  <h2 class="panel__title">通知</h2>
  <p class="muted">エラー・投稿失敗・トークン期限などの通知先です。メールとDiscordは両方ONにもできます。</p>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_notify">
    <label class="check"><input type="checkbox" name="email_enabled" value="1"<?= $emailEnabled ? ' checked' : '' ?>> メールで通知する</label>
    <label class="form__label" for="email_to">送信先メールアドレス</label>
    <input class="form__input" type="email" id="email_to" name="email_to" value="<?= h($emailTo) ?>" autocomplete="email">

    <label class="check"><input type="checkbox" name="discord_enabled" value="1"<?= $discordEnabled ? ' checked' : '' ?>> Discordで通知する</label>
    <label class="form__label" for="discord_webhook">Discord Webhook URL</label>
    <?php if ($webhookHint !== null): ?>
      <p class="muted">設定済み（末尾 <?= h($webhookHint) ?>）。変更するときだけ新しいURLを入力してください。</p>
      <label class="check"><input type="checkbox" name="discord_webhook_delete" value="1"> 保存済みのWebhook URLを削除する</label>
    <?php endif; ?>
    <input class="form__input" type="password" id="discord_webhook" name="discord_webhook" autocomplete="off" placeholder="https://discord.com/api/webhooks/...">
    <button type="submit" class="btn btn--primary">通知設定を保存</button>
  </form>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="test_notify">
    <button type="submit" class="btn btn--ghost">テスト送信</button>
    <span class="muted">保存済みの設定で、有効な通知先すべてに送ります。</span>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">投稿モード</h2>
  <p class="muted">確認モードでは、承認したストックだけが投稿されます（未承認のまま投稿時刻になると保留）。自動モードでは、取り込んだストックがそのまま投稿対象になります。目安：確認モードで修正ゼロが2週間続いたら切り替えを検討（ダッシュボードに直近14日の承認数・修正数を表示）。</p>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_post_mode">
    <label class="check"><input type="radio" name="post_mode" value="review"<?= $postMode === 'review' ? ' checked' : '' ?>> 確認モード（投稿前に自分で確認・承認する）</label>
    <label class="check"><input type="radio" name="post_mode" value="auto"<?= $postMode === 'auto' ? ' checked' : '' ?>> 自動モード（確認せずに投稿する）</label>
    <button type="submit" class="btn btn--primary">投稿モードを保存</button>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">SNS投稿のローテーション</h2>
  <p class="muted">曜日ごとに、投稿する種別・時刻・投稿先を決めます（1日1枠）。noteは、ストックにnote用の本文があるときだけ自動で加わります。</p>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_rotation">
    <?php $rotationKinds = admin_post_kinds(true); ?>
    <?php foreach ([1, 2, 3, 4, 5, 6, 0] as $weekday): $rule = $rotation[$weekday] ?? ['kind' => array_key_first($rotationKinds), 'post_time' => '20:00', 'platforms' => [], 'active' => 0]; ?>
      <div class="rotation-row">
        <strong><?= h(ADMIN_WEEKDAY_LABELS[$weekday]) ?></strong>
        <select class="form__input" name="rotation[<?= $weekday ?>][kind]" aria-label="<?= h(ADMIN_WEEKDAY_LABELS[$weekday]) ?>曜日の種別">
          <?php foreach ($rotationKinds as $key => $k): ?><option value="<?= h($key) ?>"<?= $rule['kind'] === $key ? ' selected' : '' ?>><?= h($k['label']) ?></option><?php endforeach; ?>
        </select>
        <input class="form__input" type="time" name="rotation[<?= $weekday ?>][time]" value="<?= h($rule['post_time']) ?>" aria-label="<?= h(ADMIN_WEEKDAY_LABELS[$weekday]) ?>曜日の時刻" required>
        <span>
          <?php foreach (admin_sns_rotation_platforms() as $platform): ?>
            <label class="check"><input type="checkbox" name="rotation[<?= $weekday ?>][platforms][]" value="<?= h($platform) ?>"<?= in_array($platform, $rule['platforms'], true) ? ' checked' : '' ?>> <?= h(admin_sns_label($platform)) ?></label>
          <?php endforeach; ?>
        </span>
        <label class="check"><input type="checkbox" name="rotation[<?= $weekday ?>][active]" value="1"<?= (int) $rule['active'] === 1 ? ' checked' : '' ?>> 投稿する</label>
      </div>
    <?php endforeach; ?>
    <label class="check"><input type="checkbox" name="reset_future" value="1"> すでに自動で割り当て済みの未投稿分も、新しい設定で割り当て直す</label>
    <button type="submit" class="btn btn--primary">ローテーションを保存</button>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">cronの状態</h2>
  <p>状態：<?= h($cronStateLabel) ?>（最終実行：<?= h(admin_format_time($cron['last'])) ?>）</p>
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

  <h3 class="panel__subtitle">cron実行時間テスト</h3>
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
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="request_probe">
    <button type="submit" class="btn btn--ghost"<?= in_array($probe['status'], ['requested', 'running'], true) ? ' disabled' : '' ?>>テストを予約する</button>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">パスワード変更</h2>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="change_password">
    <label class="form__label" for="current_password">現在のパスワード</label>
    <input class="form__input" type="password" id="current_password" name="current_password" autocomplete="current-password" required>
    <label class="form__label" for="new_password">新しいパスワード（<?= (int) admin_config()['password_min_length'] ?>文字以上）</label>
    <input class="form__input" type="password" id="new_password" name="new_password" autocomplete="new-password" required minlength="<?= (int) admin_config()['password_min_length'] ?>">
    <label class="form__label" for="new_password_confirm">新しいパスワード（確認）</label>
    <input class="form__input" type="password" id="new_password_confirm" name="new_password_confirm" autocomplete="new-password" required minlength="<?= (int) admin_config()['password_min_length'] ?>">
    <button type="submit" class="btn btn--primary">パスワードを変更</button>
  </form>
</section>
<?php
admin_render_footer();
