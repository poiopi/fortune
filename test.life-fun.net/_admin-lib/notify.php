<?php
declare(strict_types=1);

/**
 * _admin-lib/notify.php
 *
 * 通知（メール・Discord）。どちらに送るかは設定画面で切り替える（ADMIN_PLAN.md 4章10）。
 * 設定キー：notify_email_enabled / notify_email_to / notify_discord_enabled / notify_discord_webhook（暗号化）
 */

const ADMIN_NOTIFY_DEDUPE_MINUTES = 60;
const ADMIN_DISCORD_WEBHOOK_PATTERN = '#^https://(?:(?:ptb|canary)\.)?discord(?:app)?\.com/api/webhooks/\d+/[A-Za-z0-9_-]+$#';

function admin_notify_channels(): array
{
    $channels = [];
    if (admin_setting('notify_email_enabled') === '1' && filter_var((string) admin_setting('notify_email_to'), FILTER_VALIDATE_EMAIL)) {
        $channels[] = 'email';
    }
    if (admin_setting('notify_discord_enabled') === '1' && admin_setting('notify_discord_webhook') !== null) {
        $channels[] = 'discord';
    }
    return $channels;
}

/**
 * 有効な全チャンネルへ送る。$force=false のとき、同じ event・message を
 * ADMIN_NOTIFY_DEDUPE_MINUTES 分以内に送信済みなら送らない（毎分cronでの連投防止）。
 * 戻り値：[channel => 'sent' | 'failed: 理由' | 'skipped']
 */
function admin_notify(string $event, string $message, bool $force = false): array
{
    $results = [];
    foreach (admin_notify_channels() as $channel) {
        if (!$force && admin_notify_recently_sent($channel, $event, $message)) {
            $results[$channel] = 'skipped';
            continue;
        }
        $error = $channel === 'email' ? admin_notify_email($message) : admin_notify_discord($message);
        admin_db()->prepare(
            'INSERT INTO notifications (channel, event, message, status, error, sent_at) VALUES (?, ?, ?, ?, ?, ?)'
        )->execute([$channel, $event, $message, $error === null ? 'sent' : 'failed', $error, admin_now()]);
        $results[$channel] = $error === null ? 'sent' : 'failed: ' . $error;
    }
    return $results;
}

function admin_notify_recently_sent(string $channel, string $event, string $message): bool
{
    $since = (new DateTimeImmutable('-' . ADMIN_NOTIFY_DEDUPE_MINUTES . ' minutes'))->format(DATE_ATOM);
    $stmt = admin_db()->prepare(
        "SELECT 1 FROM notifications WHERE channel = ? AND event = ? AND message = ? AND status = 'sent' AND sent_at > ? LIMIT 1"
    );
    $stmt->execute([$channel, $event, $message, $since]);
    return $stmt->fetchColumn() !== false;
}

function admin_notify_subject_prefix(): string
{
    return admin_config()['env'] === 'stg' ? '[life-fun 管理画面・検証環境]' : '[life-fun 管理画面]';
}

/** 失敗時は理由、成功時は null。 */
function admin_notify_email(string $message): ?string
{
    $to = (string) admin_setting('notify_email_to');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    $firstLine = strtok($message, "\n");
    $subject = admin_notify_subject_prefix() . ' ' . mb_strimwidth($firstLine === false ? '' : $firstLine, 0, 60, '…');
    // 送信元（From）はサーバー既定のまま。Gmail等の他社アドレスを From に使うと送信ドメイン認証で弾かれるため指定しない。
    return mb_send_mail($to, $subject, $message) ? null : 'mb_send_mail が失敗しました';
}

/** 失敗時は理由、成功時は null。 */
function admin_notify_discord(string $message): ?string
{
    $url = admin_secret_setting('notify_discord_webhook');
    if ($url === null || preg_match(ADMIN_DISCORD_WEBHOOK_PATTERN, $url) !== 1) {
        return 'Webhook URL が読めません（設定し直してください）';
    }
    $content = admin_notify_subject_prefix() . "\n" . $message;
    if (mb_strlen($content) > 1900) {
        $content = mb_substr($content, 0, 1900) . '…';
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => json_encode(['content' => $content], JSON_UNESCAPED_UNICODE),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
    ]);
    curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $errno = curl_errno($ch);
    curl_close($ch);

    if ($errno !== 0) {
        return '接続エラー（curl ' . $errno . '）';
    }
    return $code >= 200 && $code < 300 ? null : 'Discord が HTTP ' . $code . ' を返しました';
}
