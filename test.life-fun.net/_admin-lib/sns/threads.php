<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/threads.php
 *
 * Threads 自動投稿の部品（ADMIN_IMPL_PLAN.md 14節）。
 *  - 連携（OAuth）：認可URLの作成 → 戻り先（admin/sns/threads-callback）で state 照合 → コード→短期→長期トークン → /me で
 *    アカウント名を確認 → 暗号化して保存
 *  - 投稿：毎分cronで1段階ずつ進める（コンテナ作成 → 次の回以降に状態確認 → 公開 → 投稿URL取得）。1回のcronの中では待たない
 *  - 再試行：5分後 → 15分後 → 60分後。それでも失敗なら failed＋通知。内容エラーは再試行しない
 *  - 二重投稿防止：コンテナを作り直す前・公開する前に、保存済みのコンテナの状態を確認し、PUBLISHED なら公開せず自分の最新投稿から探す
 *  - トークン更新：毎日3時（発行／前回更新から7日以上。公式の条件は「発行から24時間以上・期限前」）
 *  - 投稿の削除：DELETE /{media-id}（threads_delete 権限）
 *
 * 通信はすべて admin_threads_transport() の送信関数を通す（既定は curl。検証ではここを差し替えて実際には通信しない）。
 * トークン・アプリシークレット・認可コードは、ログ・画面・通知・DBのエラー欄に出さない（admin_threads_redact() を通す）。
 * API の仕様の出典：Meta公式 Threads API ドキュメント（ADMIN_IMPL_PLAN.md 14-1、2026-10-23 再確認）。
 */

/** API の場所とバージョン（変えるときはここだけ。graph.threads.net でも可：Meta公式 Changelog 2025-06-06） */
const ADMIN_THREADS_GRAPH_BASE = 'https://graph.threads.com';
const ADMIN_THREADS_API_VERSION = 'v1.0';
const ADMIN_THREADS_AUTHORIZE_URL = 'https://threads.com/oauth/authorize';
const ADMIN_THREADS_SCOPES = 'threads_basic,threads_content_publish,threads_delete';

/**
 * アクセストークンの送り方：'header'（Authorization: Bearer）／'query'（access_token=）。
 * ログやURLに残さないため header にしている。公式の例はクエリ。Bearer が通るかは STG の最初の連携で確認する（通らなければ 'query' に変える）。
 * ※トークン交換・更新（oauth/access_token・access_token・refresh_access_token）は公式どおりパラメータで送る（この設定は使わない）。
 */
const ADMIN_THREADS_TOKEN_SEND = 'header';

const ADMIN_THREADS_STATE_TTL_SECONDS = 600;
/** 失敗したときの再試行の間隔（分）。1回目の失敗 → 5分後、2回目 → 15分後、3回目 → 60分後、4回目の失敗で failed */
const ADMIN_THREADS_RETRY_MINUTES = [5, 15, 60];
/** コンテナ作成後、状態を見に行く間隔（分）。公式の推奨「1分に1回」 */
const ADMIN_THREADS_POLL_MINUTES = 1;
/** メディア種別ごとの IN_PROGRESS の待ち上限（分）。公式の推奨「5分まで」。VIDEO を足すときはここに長めの値を足す */
const ADMIN_THREADS_MEDIA_WAIT_MINUTES = ['TEXT' => 5];
/** 連携が切れている間、コンテナ作成済みの行を確認し直す間隔（分） */
const ADMIN_THREADS_DISCONNECTED_WAIT_MINUTES = 60;
const ADMIN_THREADS_REFRESH_AFTER_DAYS = 7;
const ADMIN_THREADS_REFRESH_MIN_HOURS = 24;
const ADMIN_THREADS_REFRESH_FAIL_NOTIFY = 3;
/** 長期トークンの応答に expires_in が無い場合の期限（公式：60日） */
const ADMIN_THREADS_TOKEN_DEFAULT_DAYS = 60;
/** 1回のcron（1プロセス）での API 呼び出しの上限（scheduler の行数上限 5 × 1行最大3回） */
const ADMIN_THREADS_MAX_CALLS_PER_RUN = 15;

const ADMIN_THREADS_ACCOUNT_STATUS_LABELS = [
    'disconnected' => '未連携',
    'connected'    => '連携済み',
    'error'        => 'エラー（連携し直してください）',
];

/* ------------------------------------------------------------------------
 * 通信
 * --------------------------------------------------------------------- */

/**
 * 送信関数の取得・差し替え。送信関数の形：
 *   fn(string $method, string $url, array $headers, ?string $body): array{status:int, body:string, error:?string}
 * 例外を投げた場合は通信エラーとして扱う。$reset=true で既定（curl）に戻す。
 */
function admin_threads_transport(?callable $set = null, bool $reset = false): callable
{
    static $transport = null;
    if ($reset) {
        $transport = null;
    } elseif ($set !== null) {
        $transport = $set;
    }
    return $transport ?? 'admin_threads_curl_transport';
}

/** 既定の送信関数（curl。タイムアウト：接続10秒・全体30秒。リダイレクトは追わない） */
function admin_threads_curl_transport(string $method, string $url, array $headers, ?string $body): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_PROTOCOLS      => CURLPROTO_HTTPS,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_USERAGENT      => 'life-fun-admin/1.0',
    ]);
    if ($body !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    $response = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $errno = curl_errno($ch);
    curl_close($ch);
    return [
        'status' => $status,
        'body'   => is_string($response) ? $response : '',
        // curl_error() は使わない（URLを含む場合があるため）。番号と一般的な説明だけ
        'error'  => $errno !== 0 ? 'curl ' . $errno . '：' . curl_strerror($errno) : null,
    ];
}

/** API 呼び出しの回数（1プロセス＝1回のcron）。$reset=true で0に戻す（scheduler が毎分の処理の最初に呼ぶ） */
function admin_threads_call_count(bool $increment = false, bool $reset = false): int
{
    static $count = 0;
    if ($reset) {
        $count = 0;
    } elseif ($increment) {
        $count++;
    }
    return $count;
}

function admin_threads_begin_run(): void
{
    admin_threads_call_count(false, true);
}

/**
 * Threads API を呼ぶ。戻り値：
 *   ['ok' => bool, 'status' => int, 'data' => array, 'class' => ?string, 'message' => ?string]
 *   class：network / server / auth / content / rate / param / unknown / deferred（このcronでの呼び出し上限）
 *   message は伏字化済み（トークン・シークレット・コードを含まない）
 * $token：Bearer で送るトークン（ADMIN_THREADS_TOKEN_SEND）。$versioned=false はトークン交換系（/oauth/access_token 等。バージョンなし）
 */
function admin_threads_request(string $method, string $path, array $params = [], ?string $token = null, bool $versioned = true): array
{
    if (admin_threads_call_count() >= ADMIN_THREADS_MAX_CALLS_PER_RUN) {
        return ['ok' => false, 'status' => 0, 'data' => [], 'class' => 'deferred', 'message' => 'このcronでのAPI呼び出しの上限に達したため、次の回に回します'];
    }
    foreach (['access_token', 'client_secret', 'code'] as $secretParam) {
        if (isset($params[$secretParam]) && is_string($params[$secretParam])) {
            admin_threads_register_secret($params[$secretParam]);
        }
    }
    $headers = ['Accept: application/json'];
    if ($token !== null) {
        admin_threads_register_secret($token);
        if (ADMIN_THREADS_TOKEN_SEND === 'header') {
            $headers[] = 'Authorization: Bearer ' . $token;
        } else {
            $params['access_token'] = $token;
        }
    }
    $url = ADMIN_THREADS_GRAPH_BASE . ($versioned ? '/' . ADMIN_THREADS_API_VERSION : '') . '/' . ltrim($path, '/');
    $body = null;
    if ($method === 'POST') {
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $body = http_build_query($params);
    } elseif ($params !== []) {
        $url .= '?' . http_build_query($params);
    }

    admin_threads_call_count(true);
    try {
        $response = (admin_threads_transport())($method, $url, $headers, $body);
    } catch (Throwable $e) {
        return ['ok' => false, 'status' => 0, 'data' => [], 'class' => 'network',
            'message' => admin_threads_redact('通信エラー（' . get_class($e) . '：' . $e->getMessage() . '）')];
    }
    $status = (int) ($response['status'] ?? 0);
    $raw = (string) ($response['body'] ?? '');
    if (($response['error'] ?? null) !== null || $status === 0) {
        return ['ok' => false, 'status' => $status, 'data' => [], 'class' => 'network',
            'message' => admin_threads_redact('通信エラー（' . ($response['error'] ?? '応答なし') . '）')];
    }
    $json = json_decode($raw, true);
    $json = is_array($json) ? $json : null;
    if ($status >= 200 && $status < 300 && $json !== null && !isset($json['error'])) {
        return ['ok' => true, 'status' => $status, 'data' => $json, 'class' => null, 'message' => null];
    }
    return ['ok' => false, 'status' => $status, 'data' => $json ?? [], 'class' => admin_threads_classify_error($status, $json, $raw),
        'message' => admin_threads_error_message($status, $json, $raw)];
}

/**
 * 認証エラーか。HTTP 401、または error.code=190（トークン無効・失効）、または error.code=102（セッション無効）を認証エラーとする。
 * error.type=OAuthException は判定に使わない（Graph API 系は認証以外のエラー（不正なパラメータ・回数制限等）にも付くため）。
 * 判定はこの関数だけ。
 */
function admin_threads_is_auth_error(int $status, ?array $json): bool
{
    $error = is_array($json['error'] ?? null) ? $json['error'] : [];
    return $status === 401 || in_array((int) ($error['code'] ?? 0), [190, 102], true);
}

/**
 * エラーの分類（この順で判定）：
 *   content … THREADS_API__LINK_LIMIT_EXCEEDED（内容。再試行しない）
 *   auth    … admin_threads_is_auth_error()
 *   rate    … HTTP 429、または error.code 4・17・32・613（Graph API の呼び出し回数の制限。Threads で同じかは未確認＝【AIの推論】）
 *   param   … HTTP 400 かつ error.code 100（不正なパラメータ）。コンテナ作成・公開の段階なら内容エラー扱い（admin_threads_handle_error）、
 *              それ以外の段階では再試行
 *   server  … HTTP 5xx
 *   unknown … それ以外（再試行）。通信エラー（network）は admin_threads_request() で先に判定済み
 */
function admin_threads_classify_error(int $status, ?array $json, string $raw): string
{
    if (str_contains($raw, 'THREADS_API__LINK_LIMIT_EXCEEDED')) {
        return 'content';
    }
    if (admin_threads_is_auth_error($status, $json)) {
        return 'auth';
    }
    $code = (int) ($json['error']['code'] ?? 0);
    if ($status === 429 || in_array($code, [4, 17, 32, 613], true)) {
        return 'rate';
    }
    if ($status === 400 && $code === 100) {
        return 'param';
    }
    if ($status >= 500) {
        return 'server';
    }
    return 'unknown';
}

function admin_threads_error_message(int $status, ?array $json, string $raw): string
{
    $error = is_array($json['error'] ?? null) ? $json['error'] : null;
    $parts = ['HTTP ' . $status];
    if ($error !== null) {
        if (isset($error['code'])) {
            $parts[] = 'code ' . (int) $error['code'];
        }
        if (isset($error['error_subcode'])) {
            $parts[] = 'subcode ' . (int) $error['error_subcode'];
        }
        if (isset($error['type']) && is_string($error['type'])) {
            $parts[] = $error['type'];
        }
        $text = trim((string) ($error['error_user_msg'] ?? '') . ' ' . (string) ($error['message'] ?? ''));
    } else {
        $text = mb_substr($raw, 0, 200);
    }
    if (str_contains($raw, 'THREADS_API__LINK_LIMIT_EXCEEDED') && !str_contains($text, 'THREADS_API__LINK_LIMIT_EXCEEDED')) {
        $text .= '（THREADS_API__LINK_LIMIT_EXCEEDED：本文のURLが多すぎます）';
    }
    return admin_threads_redact(mb_substr(implode('・', $parts) . '：' . $text, 0, 400));
}

/* ------------------------------------------------------------------------
 * 伏字化（トークン・シークレット・コードをログ・通知・DBに残さない）
 * --------------------------------------------------------------------- */

/** このプロセスで扱った秘密の値（トークン・シークレット・コード）。伏字化に使う */
function admin_threads_register_secret(?string $secret = null): array
{
    static $secrets = [];
    if ($secret !== null && strlen($secret) >= 6) {
        $secrets[$secret] = true;
    }
    return array_keys($secrets);
}

function admin_threads_redact(string $text): string
{
    foreach (admin_threads_register_secret() as $secret) {
        $text = str_replace($secret, '[伏字]', $text);
    }
    $text = (string) preg_replace('/Bearer\s+[A-Za-z0-9._~+\/=-]+/', 'Bearer [伏字]', $text);
    $text = (string) preg_replace('/((?:access_token|client_secret|(?<![A-Za-z_])code)=)[^&\s"\']+/i', '$1[伏字]', $text);
    $text = (string) preg_replace('/("(?:access_token|client_secret)"\s*:\s*")[^"]*"/i', '$1[伏字]"', $text);
    // 念のため：60文字以上続く英数字（トークンらしい文字列）も伏せる
    return (string) preg_replace('/[A-Za-z0-9_-]{60,}/', '[伏字]', $text);
}

/* ------------------------------------------------------------------------
 * アカウント（sns_accounts の threads 行）
 * --------------------------------------------------------------------- */

function admin_threads_account(): array
{
    $stmt = admin_db()->prepare("SELECT * FROM sns_accounts WHERE platform = 'threads'");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row === false) {
        admin_db()->exec("INSERT OR IGNORE INTO sns_accounts (platform, status) VALUES ('threads', 'disconnected')");
        return admin_threads_account();
    }
    return $row;
}

function admin_threads_update_account(array $fields): void
{
    $fields['updated_at'] = admin_now();
    $sets = implode(', ', array_map(static fn (string $k): string => $k . ' = ?', array_keys($fields)));
    admin_db()->prepare("UPDATE sns_accounts SET {$sets} WHERE platform = 'threads'")->execute(array_values($fields));
}

/** 保存済みの長期トークン（復号）。無ければ null */
function admin_threads_token(): ?string
{
    $encoded = admin_threads_account()['token_encrypted'] ?? null;
    $token = $encoded === null ? null : admin_decrypt((string) $encoded);
    if ($token !== null) {
        admin_threads_register_secret($token);
    }
    return $token;
}

function admin_threads_app_secret(): ?string
{
    $encoded = admin_threads_account()['app_secret_encrypted'] ?? null;
    $secret = $encoded === null ? null : admin_decrypt((string) $encoded);
    if ($secret !== null) {
        admin_threads_register_secret($secret);
    }
    return $secret;
}

/**
 * アプリID・アプリシークレットの保存。シークレットが空なら今の値のまま。戻り値：操作ログ用の説明（値は含めない）
 */
function admin_threads_save_app(string $appId, string $secret): string
{
    $appId = trim($appId);
    $secret = trim($secret);
    if (preg_match('/^\d{5,30}$/', $appId) !== 1) {
        throw new RuntimeException('アプリIDは数字で入力してください');
    }
    if ($secret !== '' && preg_match('/^[A-Za-z0-9_-]{10,200}$/', $secret) !== 1) {
        throw new RuntimeException('アプリシークレットの形式が正しくありません（英数字）');
    }
    $account = admin_threads_account();
    if ($secret === '' && $account['app_secret_encrypted'] === null) {
        throw new RuntimeException('アプリシークレットを入力してください');
    }
    $changes = [];
    $fields = ['app_id' => $appId];
    if ($appId !== (string) ($account['app_id'] ?? '')) {
        $changes[] = 'アプリID';
    }
    if ($secret !== '') {
        admin_threads_register_secret($secret);
        $fields['app_secret_encrypted'] = admin_encrypt($secret);
        $changes[] = 'アプリシークレット';
    }
    admin_threads_update_account($fields);
    return $changes === [] ? '変更なし' : implode('・', $changes) . 'を保存（値は記録しない）';
}

/** 戻り先URL（Meta のアプリ設定の「有効なOAuthリダイレクトURI」と完全一致させる） */
function admin_threads_redirect_uri(): string
{
    return admin_config()['admin_origin'] . admin_config()['admin_base'] . '/sns/threads-callback';
}

/** 「Threadsと連携する」：state を作って DB に（ハッシュで）保存し、認可URLを返す */
function admin_threads_begin_auth(?DateTimeImmutable $now = null): string
{
    $now ??= new DateTimeImmutable('now');
    $appId = (string) (admin_threads_account()['app_id'] ?? '');
    if ($appId === '' || admin_threads_app_secret() === null) {
        throw new RuntimeException('先にアプリIDとアプリシークレットを保存してください');
    }
    admin_threads_cleanup_states($now);
    $state = bin2hex(random_bytes(32));
    admin_db()->prepare('INSERT INTO oauth_states (state_hash, platform, created_at) VALUES (?, ?, ?)')
        ->execute([hash('sha256', $state), 'threads', $now->format(DATE_ATOM)]);
    return ADMIN_THREADS_AUTHORIZE_URL . '?' . http_build_query([
        'client_id'     => $appId,
        'redirect_uri'  => admin_threads_redirect_uri(),
        'scope'         => ADMIN_THREADS_SCOPES,
        'response_type' => 'code',
        'state'         => $state,
    ]);
}

function admin_threads_cleanup_states(DateTimeImmutable $now): void
{
    admin_db()->prepare('DELETE FROM oauth_states WHERE created_at < ?')
        ->execute([$now->modify('-' . ADMIN_THREADS_STATE_TTL_SECONDS . ' seconds')->format(DATE_ATOM)]);
}

/** state の照合（1回限り：見つかったら期限内でも期限切れでも削除する）。戻り値：'ok' / 'expired' / 'invalid' */
function admin_threads_consume_state(string $state, DateTimeImmutable $now): string
{
    if ($state === '' || strlen($state) > 200) {
        return 'invalid';
    }
    $hash = hash('sha256', $state);
    $stmt = admin_db()->prepare("SELECT created_at FROM oauth_states WHERE state_hash = ? AND platform = 'threads'");
    $stmt->execute([$hash]);
    $createdAt = $stmt->fetchColumn();
    admin_db()->prepare('DELETE FROM oauth_states WHERE state_hash = ?')->execute([$hash]);
    admin_threads_cleanup_states($now);
    if ($createdAt === false) {
        return 'invalid';
    }
    $age = $now->getTimestamp() - (new DateTimeImmutable((string) $createdAt))->getTimestamp();
    return $age <= ADMIN_THREADS_STATE_TTL_SECONDS ? 'ok' : 'expired';
}

/**
 * 戻り先（threads-callback）の処理。ログイン状態には依存しない（SameSite=Strict のCookieは届かないため。14-4）。
 * $query：$_GET。戻り値：['ok' => bool, 'title' => string, 'message' => string]（トークン・コードは含めない）
 */
function admin_threads_complete_auth(array $query, ?DateTimeImmutable $now = null): array
{
    $now ??= new DateTimeImmutable('now');
    $actor = 'threads-callback（ログイン外）';
    $fail = static function (string $logDetail, string $message) use ($actor): array {
        admin_audit('threads_connect_failed', $actor, admin_threads_redact($logDetail));
        return ['ok' => false, 'title' => 'Threadsと連携できませんでした', 'message' => $message];
    };
    $state = is_string($query['state'] ?? null) ? $query['state'] : '';

    if (isset($query['error'])) {
        if ($state !== '') {
            admin_threads_consume_state($state, $now);
        }
        $error = is_string($query['error']) && preg_match('/^[a-z_]{1,50}$/', $query['error']) === 1 ? $query['error'] : 'unknown';
        admin_audit('threads_connect_failed', $actor, '許可されませんでした（error=' . $error . '）');
        return ['ok' => false, 'title' => '連携が取り消されました',
            'message' => 'Threadsの画面で許可されなかったため、連携していません。連携する場合は、管理画面の「SNS連携」からもう一度「Threadsと連携する」を押してください。'];
    }

    $stateResult = admin_threads_consume_state($state, $now);
    if ($stateResult !== 'ok') {
        return $fail('state ' . ($stateResult === 'expired' ? '期限切れ' : '不一致'),
            'この連携の手続きは無効か、期限（10分）が切れています。管理画面の「SNS連携」から「Threadsと連携する」をやり直してください。');
    }
    $code = is_string($query['code'] ?? null) ? $query['code'] : '';
    // 公式：コードの末尾に「#_」が付く場合がある
    if (str_ends_with($code, '#_')) {
        $code = substr($code, 0, -2);
    }
    if ($code === '' || strlen($code) > 2000) {
        return $fail('認可コードなし', 'Threadsから認可コードが返ってきませんでした。もう一度やり直してください。');
    }
    admin_threads_register_secret($code);
    $account = admin_threads_account();
    $secret = admin_threads_app_secret();
    if ((string) ($account['app_id'] ?? '') === '' || $secret === null) {
        return $fail('アプリ設定なし', 'アプリIDとアプリシークレットが保存されていません。');
    }

    $short = admin_threads_request('POST', '/oauth/access_token', [
        'client_id'     => $account['app_id'],
        'client_secret' => $secret,
        'code'          => $code,
        'grant_type'    => 'authorization_code',
        'redirect_uri'  => admin_threads_redirect_uri(),
    ], null, false);
    $shortToken = is_string($short['data']['access_token'] ?? null) ? $short['data']['access_token'] : '';
    if (!$short['ok'] || $shortToken === '') {
        return $fail('コード→短期トークン：' . ($short['message'] ?? '応答にトークンなし'), 'トークンを取得できませんでした（' . ($short['message'] ?? '応答にトークンがありません') . '）。');
    }
    admin_threads_register_secret($shortToken);

    $long = admin_threads_request('GET', '/access_token', [
        'grant_type'    => 'th_exchange_token',
        'client_secret' => $secret,
        'access_token'  => $shortToken,
    ], null, false);
    $longToken = is_string($long['data']['access_token'] ?? null) ? $long['data']['access_token'] : '';
    if (!$long['ok'] || $longToken === '') {
        return $fail('長期トークン：' . ($long['message'] ?? '応答にトークンなし'), '長期トークンを取得できませんでした（' . ($long['message'] ?? '応答にトークンがありません') . '）。');
    }
    admin_threads_register_secret($longToken);

    $me = admin_threads_request('GET', '/me', ['fields' => 'id,username'], $longToken);
    if (!$me['ok']) {
        return $fail('/me：' . $me['message'], 'アカウントを確認できませんでした（' . $me['message'] . '）。');
    }
    $username = (string) ($me['data']['username'] ?? '');
    $expected = admin_config()['threads_username'];
    if (strcasecmp($username, $expected) !== 0) {
        return $fail('別のアカウント（@' . $username . '）', '別のアカウント（@' . $username . '）で許可されたため、保存していません。Threadsで ' . $expected . ' にログインし直してから、もう一度連携してください。');
    }

    $expiresIn = (int) ($long['data']['expires_in'] ?? 0);
    $expiresAt = $expiresIn > 0 ? $now->modify('+' . $expiresIn . ' seconds') : $now->modify('+' . ADMIN_THREADS_TOKEN_DEFAULT_DAYS . ' days');
    admin_threads_update_account([
        'token_encrypted'    => admin_encrypt($longToken),
        'token_expires_at'   => $expiresAt->format(DATE_ATOM),
        'token_issued_at'    => $now->format(DATE_ATOM),
        'account_id'         => (string) ($me['data']['id'] ?? $short['data']['user_id'] ?? ''),
        'account_name'       => $username,
        'connected_at'       => $now->format(DATE_ATOM),
        'status'             => 'connected',
        'last_error'         => null,
        'refresh_fail_count' => 0,
    ]);
    admin_audit('threads_connect', $actor, '@' . $username . '・期限 ' . $expiresAt->format('Y-m-d'));
    return ['ok' => true, 'title' => 'Threadsと連携しました',
        'message' => '@' . $username . ' と連携しました（トークンの期限 ' . $expiresAt->format('Y-m-d') . '。期限は毎日自動で延長します）。'];
}

/** 連携の解除（管理画面のDBからトークンを消す。Meta 側の許可の取り消しは画面で手順を案内する） */
function admin_threads_disconnect(): void
{
    admin_threads_update_account([
        'token_encrypted'    => null,
        'token_expires_at'   => null,
        'token_issued_at'    => null,
        'account_id'         => null,
        'account_name'       => null,
        'connected_at'       => null,
        'status'             => 'disconnected',
        'last_error'         => null,
        'refresh_fail_count' => 0,
    ]);
}

/**
 * 認証エラー（失効・取り消し等）：状態をエラーにして自動投稿を止め、「連携し直してください」を通知する。
 * 連携済み → エラーに変わったときだけ通知（同じ日のスキップ通知は送らない）。
 */
function admin_threads_mark_auth_error(string $message, DateTimeImmutable $now): void
{
    $wasConnected = admin_threads_account()['status'] === 'connected';
    admin_threads_update_account(['status' => 'error', 'last_error' => admin_threads_redact($message)]);
    if ($wasConnected) {
        admin_sns_notify_disconnected('threads', $now, true, '自動投稿を止めました。原因：' . admin_threads_redact($message));
    }
}

/**
 * 連携が切れている（未連携・エラー）間に、コンテナ作成済みのまま公開の確認待ちで残っている送信中の行の数。
 * 連携中は 0（毎分の処理が確認を進めるため）。警告バーと SNS連携の画面に出す。
 */
function admin_threads_unconfirmed_sending_count(): int
{
    if (admin_threads_account()['status'] === 'connected') {
        return 0;
    }
    return (int) admin_db()->query(
        "SELECT COUNT(*) FROM post_queue WHERE platform = 'threads' AND status = 'sending' AND container_id IS NOT NULL AND container_id <> ''"
    )->fetchColumn();
}

/**
 * トークンの更新。$manual=true は画面の「今すぐトークン更新」（7日の条件を見ない・失敗回数を数えない）。
 * 戻り値：['ok' => bool, 'skipped' => bool, 'message' => string]
 */
function admin_threads_refresh(DateTimeImmutable $now, bool $manual): array
{
    $account = admin_threads_account();
    $token = $account['status'] === 'connected' ? admin_threads_token() : null;
    if ($token === null) {
        return ['ok' => false, 'skipped' => true, 'message' => 'Threads：連携していないため更新しません'];
    }
    if ($account['token_expires_at'] !== null && new DateTimeImmutable($account['token_expires_at']) <= $now) {
        admin_threads_mark_auth_error('トークンの期限が切れました（' . admin_format_time($account['token_expires_at']) . '）', $now);
        return ['ok' => false, 'skipped' => false, 'message' => 'Threads：トークンの期限が切れています。連携し直してください'];
    }
    $issued = new DateTimeImmutable($account['token_issued_at'] ?? $account['connected_at'] ?? $now->format(DATE_ATOM));
    $hours = ($now->getTimestamp() - $issued->getTimestamp()) / 3600;
    if ($hours < ADMIN_THREADS_REFRESH_MIN_HOURS) {
        return ['ok' => false, 'skipped' => true, 'message' => 'Threads：発行から24時間たっていないため、まだ更新できません（Threadsの仕様）'];
    }
    if (!$manual && $hours < ADMIN_THREADS_REFRESH_AFTER_DAYS * 24) {
        return ['ok' => false, 'skipped' => true, 'message' => 'Threads：前回の更新から' . ADMIN_THREADS_REFRESH_AFTER_DAYS . '日たっていないため更新しません'];
    }

    $result = admin_threads_request('GET', '/refresh_access_token', ['grant_type' => 'th_refresh_token', 'access_token' => $token], null, false);
    $newToken = is_string($result['data']['access_token'] ?? null) ? $result['data']['access_token'] : '';
    if ($result['ok'] && $newToken !== '') {
        admin_threads_register_secret($newToken);
        $expiresIn = (int) ($result['data']['expires_in'] ?? 0);
        $expiresAt = $expiresIn > 0 ? $now->modify('+' . $expiresIn . ' seconds') : $now->modify('+' . ADMIN_THREADS_TOKEN_DEFAULT_DAYS . ' days');
        admin_threads_update_account([
            'token_encrypted'    => admin_encrypt($newToken),
            'token_expires_at'   => $expiresAt->format(DATE_ATOM),
            'token_issued_at'    => $now->format(DATE_ATOM),
            'refresh_fail_count' => 0,
            'last_error'         => null,
        ]);
        return ['ok' => true, 'skipped' => false, 'message' => 'Threads：トークンを更新しました（期限 ' . $expiresAt->format('Y-m-d') . '）'];
    }

    $message = 'トークンの更新に失敗：' . ($result['message'] ?? '応答にトークンがありません');
    if ($result['class'] === 'auth') {
        admin_threads_mark_auth_error($message, $now);
        return ['ok' => false, 'skipped' => false, 'message' => 'Threads：' . $message];
    }
    $fields = ['last_error' => admin_threads_redact($message)];
    if (!$manual) {
        $count = (int) $account['refresh_fail_count'] + 1;
        $fields['refresh_fail_count'] = $count;
        if ($count === ADMIN_THREADS_REFRESH_FAIL_NOTIFY) {
            admin_notify('threads_refresh_failed', 'Threadsのトークンの自動更新が' . $count . "日続けて失敗しています。\n"
                . '期限（' . admin_format_time($account['token_expires_at']) . "）までに更新できないと自動投稿が止まります。\n原因：" . admin_threads_redact($message)
                . "\n" . admin_absolute_admin_url('/sns/accounts'), true);
        }
    }
    admin_threads_update_account($fields);
    return ['ok' => false, 'skipped' => false, 'message' => 'Threads：' . admin_threads_redact($message)];
}

/** 毎日3時のジョブから呼ぶ */
function admin_threads_refresh_daily(?DateTimeImmutable $now = null): string
{
    return admin_threads_refresh($now ?? new DateTimeImmutable('now'), false)['message'];
}

/** 投稿上限の使用状況（24時間で250件）。取得できなければ null */
function admin_threads_publishing_limit(): ?array
{
    $account = admin_threads_account();
    $token = $account['status'] === 'connected' ? admin_threads_token() : null;
    if ($token === null || (string) $account['account_id'] === '') {
        return null;
    }
    $result = admin_threads_request('GET', '/' . rawurlencode((string) $account['account_id']) . '/threads_publishing_limit', ['fields' => 'quota_usage,config'], $token);
    $data = $result['data']['data'][0] ?? null;
    if (!$result['ok'] || !is_array($data)) {
        return null;
    }
    return ['usage' => (int) ($data['quota_usage'] ?? 0), 'total' => (int) ($data['config']['quota_total'] ?? 250)];
}

/* ------------------------------------------------------------------------
 * 投稿
 * --------------------------------------------------------------------- */

/**
 * 投稿するデータ。メディア種別は post_queue.media_type（今は TEXT のみ）。
 * VIDEO 等を足すとき：素材（動画URL等）の列を追加するマイグレーション → ここで素材を読む →
 * admin_threads_container_params() に種別の分岐 → ADMIN_THREADS_MEDIA_WAIT_MINUTES に待ち上限を足す。
 */
function admin_threads_build_post(array $row, array $stock): array
{
    $type = (string) ($row['media_type'] ?? '');
    return ['media_type' => $type !== '' ? $type : 'TEXT', 'text' => admin_stock_render_body($stock, 'threads')];
}

/** コンテナ作成に渡すパラメータ（メディア種別ごと）。戻り値：['ok' => true, 'params' => [..]] / ['ok' => false, 'error' => string] */
function admin_threads_container_params(array $post): array
{
    switch ($post['media_type']) {
        case 'TEXT':
            return ['ok' => true, 'params' => ['media_type' => 'TEXT', 'text' => $post['text']]];
        default:
            // VIDEO（video_url）・IMAGE（image_url）等は未対応
            return ['ok' => false, 'error' => '未対応のメディア種別です（' . $post['media_type'] . '）'];
    }
}

function admin_threads_update_row(int $id, array $fields): void
{
    $fields['updated_at'] = admin_now();
    $sets = implode(', ', array_map(static fn (string $k): string => $k . ' = ?', array_keys($fields)));
    admin_db()->prepare("UPDATE post_queue SET {$sets} WHERE id = ?")->execute([...array_values($fields), $id]);
}

function admin_threads_after(DateTimeImmutable $now, int $minutes): string
{
    return $now->modify('+' . $minutes . ' minutes')->format(DATE_ATOM);
}

/**
 * 自動投稿の入口（platforms.php の約束）。投稿時刻が来た行・送信中で次の処理時刻が来た行を1段階進める。
 * 戻り値：処理後の状態（sending / posted / failed / skipped）
 */
function admin_sns_threads_publish(array $row, ?DateTimeImmutable $now = null): string
{
    $now ??= new DateTimeImmutable('now');
    $id = (int) $row['id'];
    $account = admin_threads_account();
    $token = $account['status'] === 'connected' ? admin_threads_token() : null;
    $containerId = (string) ($row['container_id'] ?? '');
    $stock = admin_stock_get((int) $row['stock_id']);
    $title = (string) ($row['stock_title'] ?? $stock['title'] ?? '');

    if ($token === null || (string) $account['account_id'] === '') {
        if ($containerId !== '') {
            // コンテナ作成済み（公開したかもしれない）の行はスキップせず、連携し直されたら状態確認から続ける（二重投稿防止）
            admin_threads_update_row($id, [
                'status' => 'sending',
                'next_attempt_at' => admin_threads_after($now, ADMIN_THREADS_DISCONNECTED_WAIT_MINUTES),
                'last_error' => '連携が切れているため、投稿済みかどうかの確認を待っています（連携し直すと続きから確認します）',
            ]);
            return 'sending';
        }
        admin_sns_skip_unconnected($row + ['stock_title' => $title], $now);
        return 'skipped';
    }
    if ($stock === null) {
        return admin_threads_fail_final($row, $title, 'ストックが見つかりません', true);
    }
    $post = admin_threads_build_post($row, $stock);
    $userPath = '/' . rawurlencode((string) $account['account_id']);

    if ($containerId !== '') {
        $result = admin_threads_request('GET', '/' . rawurlencode($containerId), ['fields' => 'status,error_message'], $token);
        if (!$result['ok']) {
            return admin_threads_handle_error($row, $title, $result, $now, false, 'コンテナの状態確認');
        }
        $status = (string) ($result['data']['status'] ?? '');
        switch ($status) {
            case 'PUBLISHED':
                return admin_threads_recover_published($row, $post, $token, $userPath, $now);
            case 'FINISHED':
                return admin_threads_publish_container($row, $title, $containerId, $token, $userPath, $now);
            case 'IN_PROGRESS':
                $limit = ADMIN_THREADS_MEDIA_WAIT_MINUTES[$post['media_type']] ?? ADMIN_THREADS_MEDIA_WAIT_MINUTES['TEXT'];
                $created = new DateTimeImmutable((string) ($row['container_created_at'] ?? $now->format(DATE_ATOM)));
                if ($now->getTimestamp() - $created->getTimestamp() > $limit * 60) {
                    return admin_threads_fail_retry($row, $title, 'コンテナの処理が' . $limit . '分以内に終わりませんでした', $now, true);
                }
                admin_threads_update_row($id, ['status' => 'sending', 'next_attempt_at' => admin_threads_after($now, ADMIN_THREADS_POLL_MINUTES)]);
                return 'sending';
            case 'ERROR':
                return admin_threads_fail_retry($row, $title, 'コンテナがエラーになりました：' . admin_threads_redact(mb_substr((string) ($result['data']['error_message'] ?? '不明'), 0, 200)), $now, true);
            case 'EXPIRED':
                return admin_threads_fail_retry($row, $title, 'コンテナの期限が切れました（24時間以内に公開されませんでした）', $now, true);
            default:
                return admin_threads_fail_retry($row, $title, '想定外のコンテナの状態です（' . mb_substr($status, 0, 30) . '）', $now, false);
        }
    }

    // コンテナ作成（内容の確認に通らなければ API を呼ばずに失敗）
    $errors = $post['media_type'] === 'TEXT' ? admin_sns_text_errors('threads', $post['text']) : [];
    if (trim($post['text']) === '' && $post['media_type'] === 'TEXT') {
        $errors[] = 'Threads：本文が空です';
    }
    $params = admin_threads_container_params($post);
    if (!$params['ok']) {
        $errors[] = $params['error'];
    }
    if ($errors !== []) {
        return admin_threads_fail_content($row, $title, implode("\n", $errors));
    }
    $result = admin_threads_request('POST', $userPath . '/threads', $params['params'], $token);
    if (!$result['ok']) {
        return admin_threads_handle_error($row, $title, $result, $now, true, 'コンテナの作成', true);
    }
    $newContainer = (string) ($result['data']['id'] ?? '');
    if ($newContainer === '') {
        return admin_threads_fail_retry($row, $title, 'コンテナ作成の応答にIDがありません', $now, true);
    }
    admin_threads_update_row($id, [
        'status'               => 'sending',
        'media_type'           => $post['media_type'],
        'container_id'         => $newContainer,
        'container_created_at' => $now->format(DATE_ATOM),
        'next_attempt_at'      => admin_threads_after($now, ADMIN_THREADS_POLL_MINUTES),
        'last_error'           => null,
    ]);
    return 'sending';
}

/** 公開 → 投稿ID → 投稿URL（URLだけ取れなくても posted にし、URLは後の回で埋める） */
function admin_threads_publish_container(array $row, string $title, string $containerId, string $token, string $userPath, DateTimeImmutable $now): string
{
    $result = admin_threads_request('POST', $userPath . '/threads_publish', ['creation_id' => $containerId], $token);
    if (!$result['ok']) {
        // 応答が切れても実際には公開されている場合があるので、コンテナIDは残す（次の回は状態確認から）
        return admin_threads_handle_error($row, $title, $result, $now, false, '公開', true);
    }
    $mediaId = (string) ($result['data']['id'] ?? '');
    if ($mediaId === '') {
        return admin_threads_fail_retry($row, $title, '公開の応答に投稿IDがありません（次の回に状態を確認します）', $now, false);
    }
    admin_threads_mark_posted((int) $row['id'], $mediaId, null, null, $now);
    $link = admin_threads_request('GET', '/' . rawurlencode($mediaId), ['fields' => 'permalink'], $token);
    $permalink = (string) ($link['data']['permalink'] ?? '');
    if ($link['ok'] && admin_threads_valid_permalink($permalink)) {
        admin_threads_update_row((int) $row['id'], ['post_url' => $permalink]);
    }
    return 'posted';
}

function admin_threads_valid_permalink(string $url): bool
{
    return $url !== '' && str_starts_with($url, 'https://') && filter_var($url, FILTER_VALIDATE_URL) !== false;
}

function admin_threads_mark_posted(int $id, ?string $mediaId, ?string $permalink, ?string $note, DateTimeImmutable $now): void
{
    admin_threads_update_row($id, [
        'status'          => 'posted',
        'posted_at'       => $now->format(DATE_ATOM),
        'external_id'     => $mediaId,
        'post_url'        => $permalink,
        'next_attempt_at' => null,
        'last_error'      => $note,
    ]);
}

/** コンテナが PUBLISHED だった（前の公開の応答が切れた等）：再公開せず、自分の最新投稿から本文が一致するものを探す */
function admin_threads_recover_published(array $row, array $post, string $token, string $userPath, DateTimeImmutable $now): string
{
    $result = admin_threads_request('GET', $userPath . '/threads', ['fields' => 'id,text,permalink,timestamp', 'limit' => 10], $token);
    $normalize = static fn (string $s): string => trim(str_replace("\r\n", "\n", $s));
    if ($result['ok'] && is_array($result['data']['data'] ?? null)) {
        foreach ($result['data']['data'] as $item) {
            if (is_array($item) && $normalize((string) ($item['text'] ?? '')) === $normalize($post['text'])) {
                $permalink = (string) ($item['permalink'] ?? '');
                admin_threads_mark_posted((int) $row['id'], (string) ($item['id'] ?? '') ?: null,
                    admin_threads_valid_permalink($permalink) ? $permalink : null, null, $now);
                return 'posted';
            }
        }
    }
    admin_threads_mark_posted((int) $row['id'], null, null, '投稿済みだがURL未取得（Threads上で投稿を確認してください）', $now);
    return 'posted';
}

/**
 * 失敗の分類ごとの扱い。$clearContainer：失敗したのがコンテナ作成など「公開されていないと確実な」段階か。
 * $paramIsContent：不正なパラメータ（HTTP 400・code 100）を内容エラー（即 failed＋通知）として扱う段階か（コンテナ作成・公開）。
 * 公開の段階の内容エラーはコンテナIDを残す（公開されたか確認できていない行として差し替えを止め、再試行は状態確認から始める）。
 */
function admin_threads_handle_error(array $row, string $title, array $result, DateTimeImmutable $now, bool $clearContainer, string $step, bool $paramIsContent = false): string
{
    if ($result['class'] === 'param') {
        $result['class'] = $paramIsContent ? 'content' : 'unknown';
    }
    $message = $step . 'に失敗：' . ($result['message'] ?? '不明なエラー');
    switch ($result['class']) {
        case 'deferred':
            admin_threads_update_row((int) $row['id'], ['status' => 'sending', 'next_attempt_at' => admin_threads_after($now, ADMIN_THREADS_POLL_MINUTES)]);
            return 'sending';
        case 'auth':
            admin_threads_mark_auth_error($message, $now);
            if (!$clearContainer && (string) ($row['container_id'] ?? '') !== '') {
                admin_threads_update_row((int) $row['id'], [
                    'status' => 'sending',
                    'next_attempt_at' => admin_threads_after($now, ADMIN_THREADS_DISCONNECTED_WAIT_MINUTES),
                    'last_error' => admin_threads_redact($message) . '（連携し直すと続きから確認します）',
                ]);
                return 'sending';
            }
            admin_threads_update_row((int) $row['id'], [
                'status' => 'skipped', 'next_attempt_at' => null, 'container_id' => null,
                'last_error' => admin_threads_redact($message) . '（連携が切れているためスキップ。ストックは未使用に戻りました）',
            ]);
            return 'skipped';
        case 'content':
            return admin_threads_fail_content($row, $title, $message, $clearContainer);
        default:
            return admin_threads_fail_retry($row, $title, $message, $now, $clearContainer);
    }
}

/** 再試行できる失敗：5分後 → 15分後 → 60分後。4回目の失敗で failed＋通知 */
function admin_threads_fail_retry(array $row, string $title, string $message, DateTimeImmutable $now, bool $clearContainer): string
{
    $attempts = (int) ($row['attempts'] ?? 0) + 1;
    $message = admin_threads_redact($message);
    if ($attempts > count(ADMIN_THREADS_RETRY_MINUTES)) {
        admin_threads_update_row((int) $row['id'], ['attempts' => $attempts] + ($clearContainer ? ['container_id' => null, 'container_created_at' => null] : []));
        return admin_threads_fail_final($row, $title, $message . '（自動の再試行' . count(ADMIN_THREADS_RETRY_MINUTES) . '回のあとも失敗）', false);
    }
    $next = admin_threads_after($now, ADMIN_THREADS_RETRY_MINUTES[$attempts - 1]);
    admin_threads_update_row((int) $row['id'], [
        'status' => 'sending',
        'attempts' => $attempts,
        'next_attempt_at' => $next,
        'last_error' => $message . '（' . $attempts . '回目の失敗。' . substr($next, 11, 5) . 'に再試行）',
    ] + ($clearContainer ? ['container_id' => null, 'container_created_at' => null] : []));
    return 'sending';
}

/** 再試行しない失敗（内容エラー）：すぐ failed＋通知。$clearContainer=false（公開の段階）はコンテナIDを残す */
function admin_threads_fail_content(array $row, string $title, string $message, bool $clearContainer = true): string
{
    return admin_threads_fail_final($row, $title, '投稿できない内容です（再試行しません）：' . $message, $clearContainer);
}

function admin_threads_fail_final(array $row, string $title, string $message, bool $clearContainer): string
{
    $message = admin_threads_redact($message);
    admin_threads_update_row((int) $row['id'], [
        'status' => 'failed', 'next_attempt_at' => null, 'last_error' => mb_substr($message, 0, 500),
    ] + ($clearContainer ? ['container_id' => null, 'container_created_at' => null] : []));
    admin_notify('sns_failed', "Threadsへの自動投稿に失敗しました。\n「{$title}」（" . admin_date_label((string) $row['slot_date']) . "）\nエラー：{$message}\n"
        . '直したあと、履歴の「再試行」でもう一度試せます。' . "\n" . admin_absolute_admin_url('/sns/history'), true);
    return 'failed';
}

/** 投稿済みで投稿URLだけ取れなかった行（投稿IDあり・24時間以内）の補完。$limit：処理する行数の上限 */
function admin_threads_backfill_permalinks(DateTimeImmutable $now, int $limit): int
{
    $account = admin_threads_account();
    $token = $account['status'] === 'connected' ? admin_threads_token() : null;
    if ($token === null || $limit <= 0) {
        return 0;
    }
    $stmt = admin_db()->prepare(
        "SELECT id, external_id FROM post_queue WHERE platform = 'threads' AND status = 'posted' AND post_url IS NULL
           AND external_id IS NOT NULL AND external_id <> '' AND posted_at >= ? ORDER BY id LIMIT " . (int) $limit
    );
    $stmt->execute([$now->modify('-1 day')->format(DATE_ATOM)]);
    $filled = 0;
    foreach ($stmt->fetchAll() as $row) {
        $result = admin_threads_request('GET', '/' . rawurlencode((string) $row['external_id']), ['fields' => 'permalink'], $token);
        $permalink = (string) ($result['data']['permalink'] ?? '');
        if ($result['ok'] && admin_threads_valid_permalink($permalink)) {
            admin_threads_update_row((int) $row['id'], ['post_url' => $permalink]);
            $filled++;
        }
    }
    return $filled;
}

/**
 * 「Threadsから削除」：DELETE /{media-id}（threads_delete 権限）。成功で deleted。失敗は RuntimeException（状態は変えない）
 */
function admin_threads_delete_post(int $queueId, ?DateTimeImmutable $now = null): void
{
    $now ??= new DateTimeImmutable('now');
    $stmt = admin_db()->prepare("SELECT * FROM post_queue WHERE id = ? AND platform = 'threads'");
    $stmt->execute([$queueId]);
    $row = $stmt->fetch();
    if ($row === false || $row['status'] !== 'posted') {
        throw new RuntimeException('投稿済みの Threads の投稿ではありません');
    }
    if ((string) $row['external_id'] === '') {
        throw new RuntimeException('投稿IDが記録されていないため、管理画面からは削除できません。Threadsのアプリで削除してください');
    }
    $token = admin_threads_account()['status'] === 'connected' ? admin_threads_token() : null;
    if ($token === null) {
        throw new RuntimeException('Threadsと連携していないため削除できません');
    }
    $result = admin_threads_request('DELETE', '/' . rawurlencode((string) $row['external_id']), [], $token);
    if (!$result['ok'] || ($result['data']['success'] ?? false) !== true) {
        if ($result['class'] === 'auth') {
            admin_threads_mark_auth_error('削除に失敗：' . $result['message'], $now);
        }
        throw new RuntimeException('Threadsから削除できませんでした（' . ($result['message'] ?? '削除の応答が成功ではありません') . '）');
    }
    admin_threads_update_row($queueId, ['status' => 'deleted', 'deleted_at' => $now->format(DATE_ATOM)]);
}
