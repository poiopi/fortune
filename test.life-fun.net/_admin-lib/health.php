<?php
declare(strict_types=1);

/**
 * _admin-lib/health.php
 *
 * サイトヘルス（ADMIN_PLAN.md 7章、ADMIN_IMPL_PLAN.md Phase 4）。対象は本番サイト（config の site_url。STGからも本番を見る）。
 *  - 毎時：主要ページの応答
 *  - 毎日 9時：上記＋SSL証明書・sitemap/robots/ads.txt・機密ファイルの非公開・存在しないURLの404
 *  - 管理画面の「今すぐ実行」：すべて
 * 結果は check_key ごとに最新1行。状態が変わったときだけ履歴に残し、🔴になったとき・🔴から戻ったときだけ通知する。
 */

const ADMIN_HEALTH_PAGES = ['/', '/sansei', '/seimei', '/shichu', '/tarot', '/aisho', '/kyusei', '/calendar', '/reversi', '/articles/', '/quiz/'];
const ADMIN_HEALTH_SLOW_SECONDS = 3.0;
const ADMIN_HEALTH_SSL_WARN_DAYS = 14;
const ADMIN_HEALTH_SSL_RED_DAYS = 3;
const ADMIN_HEALTH_ADSENSE_PUB = 'pub-6979913482925873';
/** CLAUDE.md「機密ファイル非公開の運用ルール」の代表パス＋管理画面のデータ・プログラム */
const ADMIN_HEALTH_SECRET_PATHS = [
    'CLAUDE.md', 'README.md', 'ADMIN_PLAN.md', 'ADMIN_IMPL_PLAN.md', 'PROJECT_STATE.md', 'DEVELOPMENT_RULES.md', 'DEPLOY_CHECKLIST.md',
    '.env', '.git/config', '.git/HEAD', '.vscode/sftp.json', '.claude/settings.local.json', '.htpasswd',
    '_admin-data/admin.sqlite', '_admin-data/secret-key.php', '_admin-data/php-error.log', '_admin-lib/config.php',
    'tools/', 'docs/', 'tests/', '_scratch/ai-fortune-chat-mockup.html',
];

const ADMIN_HEALTH_LABELS = [
    'pages'    => '主要ページの応答',
    'ssl'      => 'SSL証明書の期限',
    'sitemap'  => 'sitemap.xml',
    'robots'   => 'robots.txt',
    'ads'      => 'ads.txt',
    'secrets'  => '機密ファイルの非公開',
    'notfound' => '存在しないURLが404を返すか',
];
const ADMIN_HEALTH_DAILY_KEYS = ['ssl', 'sitemap', 'robots', 'ads', 'secrets', 'notfound'];
const ADMIN_HEALTH_STATUS_ICONS = ['green' => '🟢', 'yellow' => '🟡', 'red' => '🔴'];

/**
 * 複数URLを並行して取得する。戻り値：[url => ['code' => int, 'time' => float, 'body' => string, 'error' => ?string]]
 * $withBody=false なら本文は捨てる（状態コードだけ見る）。同じホスト内のリダイレクトは3回まで追う。
 */
function admin_health_fetch_many(array $urls, bool $withBody = true): array
{
    $multi = curl_multi_init();
    $handles = [];
    foreach (array_values($urls) as $i => $url) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_PRIVATE        => (string) $i,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_NOBODY         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
            CURLOPT_PROTOCOLS      => CURLPROTO_HTTPS | CURLPROTO_HTTP,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_USERAGENT      => 'life-fun-admin-health/1.0',
            CURLOPT_ENCODING       => '',
        ]);
        curl_multi_add_handle($multi, $ch);
        $handles[$url] = $ch;
    }
    do {
        $status = curl_multi_exec($multi, $running);
        if ($running > 0) {
            curl_multi_select($multi, 1.0);
        }
    } while ($running > 0 && $status === CURLM_OK);

    // 並行取得では curl_errno() が使えないため、完了メッセージから結果コードを読む
    $codes = [];
    while (($info = curl_multi_info_read($multi)) !== false) {
        $codes[(int) curl_getinfo($info['handle'], CURLINFO_PRIVATE)] = (int) $info['result'];
    }

    $results = [];
    foreach ($handles as $url => $ch) {
        $errno = $codes[(int) curl_getinfo($ch, CURLINFO_PRIVATE)] ?? CURLE_OPERATION_TIMEDOUT;
        $body = (string) curl_multi_getcontent($ch);
        $results[$url] = [
            'code'  => (int) curl_getinfo($ch, CURLINFO_HTTP_CODE),
            'time'  => (float) curl_getinfo($ch, CURLINFO_TOTAL_TIME),
            'body'  => $withBody ? $body : '',
            'error' => $errno !== 0 ? 'curl ' . $errno . '：' . curl_strerror($errno) : null,
        ];
        curl_multi_remove_handle($multi, $ch);
        curl_close($ch);
    }
    curl_multi_close($multi);
    return $results;
}

function admin_health_url(string $path): string
{
    return admin_config()['site_url'] . '/' . ltrim($path, '/');
}

/** 主要ページ。戻り値：[status, message, detail] */
function admin_health_check_pages(): array
{
    $urls = array_map('admin_health_url', ADMIN_HEALTH_PAGES);
    $results = admin_health_fetch_many($urls, false);
    $bad = [];
    $slow = [];
    $lines = [];
    foreach ($results as $url => $r) {
        $path = substr($url, strlen(admin_config()['site_url']));
        $lines[] = $path . '　' . ($r['error'] ?? 'HTTP ' . $r['code']) . '　' . number_format($r['time'], 2) . '秒';
        if ($r['error'] !== null || $r['code'] !== 200) {
            $bad[] = $path . '（' . ($r['error'] !== null ? '応答なし' : 'HTTP ' . $r['code']) . '）';
        } elseif ($r['time'] >= ADMIN_HEALTH_SLOW_SECONDS) {
            $slow[] = $path . '（' . number_format($r['time'], 1) . '秒）';
        }
    }
    $detail = implode("\n", $lines);
    if ($bad !== []) {
        return ['red', '開けないページがあります：' . implode('、', $bad), $detail];
    }
    if ($slow !== []) {
        return ['yellow', ADMIN_HEALTH_SLOW_SECONDS . '秒以上かかったページがあります：' . implode('、', $slow), $detail];
    }
    return ['green', count($results) . 'ページとも正常に開けました', $detail];
}

function admin_health_check_ssl(): array
{
    $host = (string) parse_url(admin_config()['site_url'], PHP_URL_HOST);
    if (!function_exists('openssl_x509_parse')) {
        return ['yellow', 'このサーバーでは証明書を確認できません（openssl 拡張なし）', null];
    }
    $context = stream_context_create(['ssl' => ['capture_peer_cert' => true, 'SNI_enabled' => true, 'peer_name' => $host]]);
    $client = @stream_socket_client('ssl://' . $host . ':443', $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context);
    if ($client === false) {
        return ['red', '証明書を取得できません（' . $errstr . '）', null];
    }
    $params = stream_context_get_params($client);
    fclose($client);
    $cert = openssl_x509_parse($params['options']['ssl']['peer_certificate'] ?? '');
    if (!is_array($cert) || !isset($cert['validTo_time_t'])) {
        return ['yellow', '証明書の期限を読み取れません', null];
    }
    $expires = (new DateTimeImmutable('@' . $cert['validTo_time_t']))->setTimezone(new DateTimeZone(admin_config()['timezone']));
    $days = (int) floor(($cert['validTo_time_t'] - time()) / 86400);
    $message = '期限 ' . $expires->format('Y-m-d') . '（残り' . $days . '日）';
    $detail = '発行者：' . ($cert['issuer']['O'] ?? $cert['issuer']['CN'] ?? '不明');
    if ($days < ADMIN_HEALTH_SSL_RED_DAYS) {
        return ['red', $message, $detail];
    }
    if ($days < ADMIN_HEALTH_SSL_WARN_DAYS) {
        return ['yellow', $message . '。ロリポップの自動更新を確認してください', $detail];
    }
    return ['green', $message, $detail];
}

/** sitemap.xml・robots.txt・ads.txt。戻り値：[key => [status, message, detail]] */
function admin_health_check_site_files(): array
{
    $urls = ['sitemap' => admin_health_url('sitemap.xml'), 'robots' => admin_health_url('robots.txt'), 'ads' => admin_health_url('ads.txt')];
    $r = admin_health_fetch_many(array_values($urls));
    $out = [];

    $s = $r[$urls['sitemap']];
    if ($s['error'] !== null || $s['code'] !== 200) {
        $out['sitemap'] = ['red', '取得できません（' . ($s['error'] ?? 'HTTP ' . $s['code']) . '）', null];
    } else {
        $prev = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($s['body']);
        libxml_use_internal_errors($prev);
        $count = $xml !== false ? count($xml->children()) : 0;
        $out['sitemap'] = $xml === false
            ? ['red', 'XMLとして読めません', null]
            : ($count === 0 ? ['red', 'URLが1件もありません', null] : ['green', $count . '件のURLが載っています', null]);
    }

    $s = $r[$urls['robots']];
    if ($s['error'] !== null || $s['code'] !== 200) {
        $out['robots'] = ['red', '取得できません（' . ($s['error'] ?? 'HTTP ' . $s['code']) . '）', null];
    } elseif (preg_match('#^\s*Disallow:\s*/\s*$#mi', $s['body']) === 1) {
        $out['robots'] = ['red', 'サイト全体のクロールを拒否する行（Disallow: /）があります', $s['body']];
    } elseif (stripos($s['body'], 'Sitemap:') === false) {
        $out['robots'] = ['yellow', 'Sitemap: の行がありません', $s['body']];
    } else {
        $out['robots'] = ['green', '正常です', $s['body']];
    }

    $s = $r[$urls['ads']];
    if ($s['error'] !== null || $s['code'] !== 200) {
        $out['ads'] = ['red', '取得できません（' . ($s['error'] ?? 'HTTP ' . $s['code']) . '）', null];
    } elseif (!str_contains($s['body'], ADMIN_HEALTH_ADSENSE_PUB)) {
        $out['ads'] = ['red', 'AdSenseのID（' . ADMIN_HEALTH_ADSENSE_PUB . '）が見つかりません', $s['body']];
    } else {
        $out['ads'] = ['green', '正常です', $s['body']];
    }
    return $out;
}

/** 機密ファイル：403・404・401・410 なら非公開。200 は🔴（中身が読める）、それ以外は🟡 */
function admin_health_check_secrets(): array
{
    $urls = [];
    foreach (ADMIN_HEALTH_SECRET_PATHS as $path) {
        $urls[admin_health_url($path)] = $path;
    }
    $results = admin_health_fetch_many(array_keys($urls), false);
    $open = [];
    $odd = [];
    $lines = [];
    foreach ($results as $url => $r) {
        $path = $urls[$url];
        $lines[] = $path . '　' . ($r['error'] ?? 'HTTP ' . $r['code']);
        if ($r['error'] !== null) {
            $odd[] = $path . '（応答なし）';
        } elseif ($r['code'] === 200) {
            $open[] = $path;
        } elseif (!in_array($r['code'], [401, 403, 404, 410], true)) {
            $odd[] = $path . '（HTTP ' . $r['code'] . '）';
        }
    }
    $detail = implode("\n", $lines);
    if ($open !== []) {
        return ['red', '中身が読める状態です：' . implode('、', $open) . '。すぐに削除するか、公開しない設定を確認してください', $detail];
    }
    if ($odd !== []) {
        return ['yellow', '想定外の応答があります：' . implode('、', $odd), $detail];
    }
    return ['green', count($results) . 'か所とも非公開です', $detail];
}

/** 存在しないURLが404を返すか（200だとソフト404） */
function admin_health_check_notfound(): array
{
    $url = admin_health_url('lf-health-check-' . bin2hex(random_bytes(6)));
    $r = admin_health_fetch_many([$url], false)[$url];
    if ($r['error'] !== null) {
        return ['yellow', '確認できません（' . $r['error'] . '）', $url];
    }
    if ($r['code'] === 404 || $r['code'] === 410) {
        return ['green', 'HTTP ' . $r['code'] . ' を返しています', $url];
    }
    if ($r['code'] === 200) {
        return ['red', '存在しないURLに HTTP 200 を返しています（ソフト404）', $url];
    }
    return ['yellow', '存在しないURLに HTTP ' . $r['code'] . ' を返しています', $url];
}

/**
 * チェックを実行して保存する。$daily=false なら主要ページだけ。
 * 戻り値：cronの記録用の短い文
 */
function admin_health_run(bool $daily): string
{
    $results = ['pages' => admin_health_check_pages()];
    if ($daily) {
        $results['ssl'] = admin_health_check_ssl();
        $results += admin_health_check_site_files();
        $results['secrets'] = admin_health_check_secrets();
        $results['notfound'] = admin_health_check_notfound();
    }

    $alerts = [];
    foreach ($results as $key => [$status, $message, $detail]) {
        $change = admin_health_save($key, $status, $message, $detail);
        if ($change === 'red') {
            $alerts[] = '🔴 ' . ADMIN_HEALTH_LABELS[$key] . '：' . $message;
        } elseif ($change === 'recovered') {
            $alerts[] = ADMIN_HEALTH_STATUS_ICONS[$status] . ' 回復：' . ADMIN_HEALTH_LABELS[$key] . '：' . $message;
        }
    }
    if ($alerts !== []) {
        admin_notify('health_change', "サイトヘルスに変化がありました。\n" . implode("\n", $alerts) . "\n" . admin_absolute_admin_url('/health'), true);
    }

    $counts = array_count_values(array_column($results, 0));
    return 'サイトヘルス：🟢' . ($counts['green'] ?? 0) . ' 🟡' . ($counts['yellow'] ?? 0) . ' 🔴' . ($counts['red'] ?? 0);
}

/**
 * 1項目を保存。戻り値：'red'（🔴になった）/ 'recovered'（🔴から戻った）/ null（通知不要）
 */
function admin_health_save(string $key, string $status, string $message, ?string $detail): ?string
{
    $now = admin_now();
    $stmt = admin_db()->prepare('SELECT status FROM health_checks WHERE check_key = ?');
    $stmt->execute([$key]);
    $old = $stmt->fetchColumn();
    $old = $old === false ? null : (string) $old;

    admin_db()->prepare(
        'INSERT INTO health_checks (check_key, status, message, detail, checked_at, changed_at) VALUES (?, ?, ?, ?, ?, ?)
         ON CONFLICT(check_key) DO UPDATE SET status = excluded.status, message = excluded.message, detail = excluded.detail,
           checked_at = excluded.checked_at, changed_at = CASE WHEN health_checks.status <> excluded.status THEN excluded.changed_at ELSE health_checks.changed_at END'
    )->execute([$key, $status, $message, $detail, $now, $now]);

    if ($old === $status) {
        return null;
    }
    admin_db()->prepare('INSERT INTO health_changes (check_key, old_status, new_status, message, at) VALUES (?, ?, ?, ?, ?)')
        ->execute([$key, $old, $status, $message, $now]);
    if ($status === 'red') {
        return 'red';
    }
    return $old === 'red' ? 'recovered' : null;
}

/** 最新の結果 [check_key => row]（ADMIN_HEALTH_LABELS の順） */
function admin_health_latest(): array
{
    $rows = [];
    foreach (admin_db()->query('SELECT * FROM health_checks') as $row) {
        $rows[$row['check_key']] = $row;
    }
    $ordered = [];
    foreach (array_keys(ADMIN_HEALTH_LABELS) as $key) {
        if (isset($rows[$key])) {
            $ordered[$key] = $rows[$key];
        }
    }
    return $ordered;
}
