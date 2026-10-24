<?php
declare(strict_types=1);

/**
 * _admin-lib/notify.php
 *
 * 通知（メール・Discord）。どちらに送るかは設定画面で切り替える（ADMIN_PLAN.md 4章10）。
 * 設定キー：notify_email_enabled / notify_email_to / notify_discord_enabled / notify_discord_webhook（暗号化）
 * 段階2：「すぐ届く」種類と「朝のまとめ（1日1通）」に分ける（ADMIN_STAGE2_PROPOSAL.md 1-1・3-4）。
 *   設定キー：notify_digest_<区分>（'0' でオフ）／notify_digest_hour（朝のまとめの時刻）
 */

const ADMIN_NOTIFY_DEDUPE_MINUTES = 60;
const ADMIN_DISCORD_WEBHOOK_PATTERN = '#^https://(?:(?:ptb|canary)\.)?discord(?:app)?\.com/api/webhooks/\d+/[A-Za-z0-9_-]+$#';

/**
 * すぐ届く通知（オフにできない。ADMIN_FEATURES_ORGANIZED.md 1-3 の4種類＋ログインの異常＝ADMIN_STAGE2_PROPOSAL.md 6章Q2）。
 * 設定画面の表示に使う。ここにも下の ADMIN_NOTIFY_DIGEST_EVENTS にも無い event は、念のため「すぐ届く」として扱う。
 */
const ADMIN_NOTIFY_IMMEDIATE_GROUPS = [
    'site'    => ['label' => 'サイトが落ちた（主要ページが応答しない）',           'events' => ['site_down']],
    'threads' => ['label' => 'Threadsの連携切れ・トークン切れ・投稿の失敗',       'events' => ['sns_disconnected', 'sns_failed', 'threads_refresh_failed', 'threads_token']],
    'secrets' => ['label' => '見られてはいけないファイルが見える',                 'events' => ['secret_exposed']],
    'adsense' => ['label' => 'AdSenseのポリシー警告（段階3で取り込みをつなぎます）', 'events' => ['adsense_policy']],
    'login'   => ['label' => 'ログインの異常（2段階認証のコード誤りが続いた・reset-2faで解除した）', 'events' => ['2fa_global_locked', '2fa_file_reset']],
];

/** 朝のまとめの区分（設定画面で区分ごとにオン/オフ。設定キー notify_digest_<区分>、既定はオン） */
const ADMIN_NOTIFY_DIGEST_CATEGORIES = [
    'plan' => '今日の予定と目標・やること',
    'sns'  => 'SNS：未承認・保留・ストック残少',
    'js'   => '公開ページのJSエラー',
    'seo'  => 'SEO点検の新しい問題',
    'site' => 'サイトの見回り（SSL・sitemap・バックアップなど）・自動実行の失敗',
];

/**
 * 朝のまとめに回す event → 区分。null は「朝のまとめの『やること』に毎回その時点の状態が載るので、溜め置かない」もの
 * （投稿時刻のnote・翌日の未承認・ストック残少。溜めると同じことが2回書かれる）。
 */
const ADMIN_NOTIFY_DIGEST_EVENTS = [
    'sns_held'                => 'sns',
    'sns_manual'              => null,
    'sns_tomorrow_unapproved' => null,
    'sns_stock_low'           => null,
    'client_error_new'        => 'js',
    'seo_new_issues'          => 'seo',
    'health_change'           => 'site',
    'cron_job_failed'         => 'site',
];

/** 朝のまとめに入れる溜め置きの古さの上限（日）。これより古いものは送らずに片付ける（通知先が無かった間の分など） */
const ADMIN_NOTIFY_DIGEST_MAX_AGE_DAYS = 7;
const ADMIN_NOTIFY_DIGEST_DEFAULT_HOUR = 7;

/** 通知の記録（notifications.event）を画面に出すときの名前 */
function admin_notify_event_label(string $event): string
{
    if ($event === 'digest') {
        return '朝のまとめ';
    }
    if ($event === 'test') {
        return 'テスト送信';
    }
    foreach (ADMIN_NOTIFY_IMMEDIATE_GROUPS as $group) {
        if (in_array($event, $group['events'], true)) {
            return $group['label'];
        }
    }
    $category = ADMIN_NOTIFY_DIGEST_EVENTS[$event] ?? null;
    return $category !== null ? ADMIN_NOTIFY_DIGEST_CATEGORIES[$category] : $event;
}

function admin_notify_is_immediate(string $event): bool
{
    return !array_key_exists($event, ADMIN_NOTIFY_DIGEST_EVENTS);
}

function admin_notify_digest_enabled(string $category): bool
{
    return admin_setting('notify_digest_' . $category) !== '0';
}

/** 朝のまとめの時刻（時。0〜23） */
function admin_notify_digest_hour(): int
{
    $hour = admin_setting('notify_digest_hour');
    return $hour !== null && preg_match('/^(?:[01]?\d|2[0-3])$/', $hour) === 1 ? (int) $hour : ADMIN_NOTIFY_DIGEST_DEFAULT_HOUR;
}

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
 * 通知の入口。すぐ届く種類は今すぐ送り（admin_notify_send_now）、それ以外は朝のまとめに溜める（admin_notify_queue_digest）。
 * 戻り値：すぐ送ったとき [channel => 'sent' | 'failed: 理由' | 'skipped']、朝のまとめに回したとき []
 */
function admin_notify(string $event, string $message, bool $force = false): array
{
    if (!admin_notify_is_immediate($event)) {
        admin_notify_queue_digest($event, $message);
        return [];
    }
    return admin_notify_send_now($event, $message, $force);
}

/**
 * 朝のまとめに溜める。区分がオフ・溜め置かない種類（区分が null）なら何もしない。
 * まだ送っていない同じ event・message があれば重ねない。
 */
function admin_notify_queue_digest(string $event, string $message): void
{
    $category = ADMIN_NOTIFY_DIGEST_EVENTS[$event] ?? null;
    if ($category === null || !admin_notify_digest_enabled($category)) {
        return;
    }
    $stmt = admin_db()->prepare('SELECT 1 FROM notify_digest WHERE event = ? AND message = ? AND sent_at IS NULL LIMIT 1');
    $stmt->execute([$event, $message]);
    if ($stmt->fetchColumn() !== false) {
        return;
    }
    admin_db()->prepare('INSERT INTO notify_digest (event, category, message, created_at) VALUES (?, ?, ?, ?)')
        ->execute([$event, $category, $message, admin_now()]);
}

/**
 * 朝のまとめを1通送る（朝のジョブ）。中身：まだ続いている異常／今日の予定と目標／やること（その時点の状態）／前回のまとめ以降に溜まった知らせ。
 * 区分がオフのものは入れない。入れるものが何も無ければ送らない。
 * 戻り値：cronの記録用の短い文
 */
function admin_notify_send_digest(?DateTimeImmutable $now = null): string
{
    $now ??= new DateTimeImmutable('now');
    $sections = [];

    // まだ続いている異常（すぐ届く通知で知らせた後も直っていないもの）。区分に関係なく入れる
    $alerts = admin_today_alerts($now);
    if ($alerts !== []) {
        $sections[] = "■ 異常（まだ続いています）\n" . implode("\n", array_map(static fn (array $a): string => '・' . $a['text'], $alerts));
    }
    if (admin_notify_digest_enabled('plan')) {
        $sections[] ="■ 今日の目標\n" . admin_today_goal_text(admin_today_goals($now)) . "\n\n■ 今日の予定\n" . admin_today_schedule_text($now);
    }
    $todos = array_values(array_filter(admin_today_todos($now), static fn (array $t): bool => admin_notify_digest_enabled($t['category'])));
    if ($todos !== []) {
        $sections[] = "■ やること\n" . implode("\n", array_map(static fn (array $t, int $i): string => ($i + 1) . '. ' . $t['text'], $todos, array_keys($todos)));
    }

    $since = $now->modify('-' . ADMIN_NOTIFY_DIGEST_MAX_AGE_DAYS . ' days')->format(DATE_ATOM);
    $stmt = admin_db()->prepare('SELECT * FROM notify_digest WHERE sent_at IS NULL AND created_at > ? ORDER BY id');
    $stmt->execute([$since]);
    $queued = [];
    foreach ($stmt->fetchAll() as $row) {
        if (admin_notify_digest_enabled($row['category'])) {
            $queued[$row['category']][] = admin_format_time($row['created_at']) . "\n" . mb_strimwidth($row['message'], 0, 600, '…');
        }
    }
    if ($queued !== []) {
        $lines = [];
        foreach (ADMIN_NOTIFY_DIGEST_CATEGORIES as $category => $label) {
            if (isset($queued[$category])) {
                $lines[] = '【' . $label . '】' . "\n" . implode("\n\n", $queued[$category]);
            }
        }
        $sections[] = "■ 前回のまとめ以降の知らせ\n" . implode("\n\n", $lines);
    }
    // 送ったかどうかに関係なく、溜め置きは片付ける（区分がオフ・古すぎるものも次に持ち越さない）
    admin_db()->prepare('UPDATE notify_digest SET sent_at = ? WHERE sent_at IS NULL')->execute([admin_now()]);

    if ($sections === []) {
        return '朝のまとめ：送る内容なし';
    }
    $message = '朝のまとめ ' . admin_date_label($now->format('Y-m-d')) . "\n\n" . implode("\n\n", $sections) . "\n\n" . admin_absolute_admin_url('/');
    $results = admin_notify_send_now('digest', $message, true);
    return '朝のまとめ：' . ($results === [] ? '通知先なし' : implode('、', array_map(static fn (string $c, string $r): string => $c . ' ' . $r, array_keys($results), $results)));
}

/**
 * 有効な全チャンネルへ今すぐ送る。$force=false のとき、同じ event・message を
 * ADMIN_NOTIFY_DEDUPE_MINUTES 分以内に送信済みなら送らない（毎分cronでの連投防止）。
 * 戻り値：[channel => 'sent' | 'failed: 理由' | 'skipped']
 */
function admin_notify_send_now(string $event, string $message, bool $force = false): array
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
