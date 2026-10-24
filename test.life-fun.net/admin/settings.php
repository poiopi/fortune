<?php
declare(strict_types=1);

// 設定 → 通知：送り先（メール・Discord）・テスト送信・すぐ届く通知の一覧・朝のまとめ（時刻・区分ごとのオン/オフ）・最近の通知。
// 段階2で、投稿モード・ローテーションは「書いて出す → 投稿のルール」、cron は「設定 → 自動実行」、
// 2段階認証・パスワード変更は「設定 → ログインと2段階認証」へ移した。
// POST は処理後に同じ画面へリダイレクトし、結果はセッションの flash で1回だけ表示する。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

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
        settings_flash('ok', '通知の送り先を保存しました。');
    }

    if ($action === 'test_notify') {
        if (admin_notify_channels() === []) {
            settings_flash('error', '有効な送り先がありません。先に通知の送り先を保存してください。');
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

    if ($action === 'save_digest') {
        $hour = (string) ($_POST['digest_hour'] ?? '');
        if (preg_match('/^(?:[01]?\d|2[0-3])$/', $hour) !== 1) {
            settings_flash('error', '朝のまとめの時刻が正しくありません。');
        }
        $on = [];
        foreach (array_keys(ADMIN_NOTIFY_DIGEST_CATEGORIES) as $category) {
            $enabled = isset($_POST['digest'][$category]);
            admin_set_setting('notify_digest_' . $category, $enabled ? '1' : '0');
            if ($enabled) {
                $on[] = $category;
            }
        }
        admin_set_setting('notify_digest_hour', (string) (int) $hour);
        admin_audit('settings_digest', null, (int) $hour . '時 / オン：' . ($on === [] ? 'なし' : implode(',', $on)));
        settings_flash('ok', '朝のまとめの設定を保存しました。');
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
$digestHour = admin_notify_digest_hour();
$notifications = admin_db()->query('SELECT channel, event, status, sent_at FROM notifications ORDER BY id DESC LIMIT 10')->fetchAll();
$pendingDigest = (int) admin_db()->query('SELECT COUNT(*) FROM notify_digest WHERE sent_at IS NULL')->fetchColumn();
$channelLabels = ['email' => 'メール', 'discord' => 'Discord'];

admin_render_header('通知', 'settings');
?>
<?php if ($flash !== null): ?>
  <p class="alert alert--<?= $flash['type'] === 'ok' ? 'ok' : 'error' ?>"><?= h($flash['text']) ?></p>
<?php endif; ?>

<section class="panel panel--wide">
  <h2 class="panel__title">送り先</h2>
  <p class="muted">メールとDiscordは両方ONにもできます。</p>
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
    <input class="form__input" type="password" id="discord_webhook" name="discord_webhook" autocomplete="new-password" placeholder="https://discord.com/api/webhooks/...">
    <button type="submit" class="btn btn--primary">送り先を保存</button>
  </form>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="test_notify">
    <button type="submit" class="btn btn--ghost">テスト送信</button>
    <span class="muted">保存済みの設定で、有効な送り先すべてに送ります。</span>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">すぐ届く通知（オフにできません）</h2>
  <p class="muted">起きたらすぐ対応が要るものだけです。同じ内容は<?= ADMIN_NOTIFY_DEDUPE_MINUTES ?>分以内に重ねて送りません。</p>
  <ul class="kv">
<?php foreach (ADMIN_NOTIFY_IMMEDIATE_GROUPS as $group): ?>
    <li><?= h($group['label']) ?></li>
<?php endforeach; ?>
  </ul>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">朝のまとめ（1日1通）</h2>
  <p class="muted">すぐ届く通知以外は、毎朝1通にまとめて送ります。オフにした区分は、まとめに入りません（「今日」画面にはいつも出ます）。送る内容が何も無い日は送りません。</p>
  <form method="post" action="<?= h(admin_url('/settings')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_digest">
    <label class="form__label" for="digest_hour">送る時刻</label>
    <select class="form__input form__input--narrow" id="digest_hour" name="digest_hour">
<?php foreach (range(0, 23) as $hour): ?>
      <option value="<?= $hour ?>"<?= $hour === $digestHour ? ' selected' : '' ?>><?= sprintf('%02d:00', $hour) ?></option>
<?php endforeach; ?>
    </select>
    <span class="form__label">まとめに入れるもの</span>
<?php foreach (ADMIN_NOTIFY_DIGEST_CATEGORIES as $category => $label): ?>
    <label class="check"><input type="checkbox" name="digest[<?= h($category) ?>]" value="1"<?= admin_notify_digest_enabled($category) ? ' checked' : '' ?>> <?= h($label) ?></label>
<?php endforeach; ?>
    <button type="submit" class="btn btn--primary">朝のまとめを保存</button>
  </form>
  <p class="muted">次のまとめに入る知らせ：<?= $pendingDigest ?> 件</p>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">最近の通知（10件）</h2>
<?php if ($notifications === []): ?>
  <p class="muted">まだ通知はありません。</p>
<?php else: ?>
  <div class="table-wrap">
    <table class="table">
      <thead><tr><th>日時</th><th>送り先</th><th>種類</th><th>結果</th></tr></thead>
      <tbody>
<?php foreach ($notifications as $n): ?>
        <tr class="<?= $n['status'] === 'sent' ? '' : 'is-warn' ?>">
          <td class="nowrap"><?= h(admin_format_time($n['sent_at'])) ?></td>
          <td><?= h($channelLabels[$n['channel']] ?? $n['channel']) ?></td>
          <td><?= h(admin_notify_event_label($n['event'])) ?></td>
          <td><?= $n['status'] === 'sent' ? '送信' : '<strong>失敗</strong>' ?></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
</section>

<p class="muted">以前この画面にあった項目の移動先：投稿モード・曜日ごとの投稿 →「書いて出す」→「投稿のルール」／cronの状態 →「設定」→「自動実行」／2段階認証・パスワード変更 →「設定」→「ログインと2段階認証」</p>
<?php
admin_render_footer();
