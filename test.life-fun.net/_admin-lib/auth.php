<?php
declare(strict_types=1);

/**
 * _admin-lib/auth.php
 *
 * セッション・ログイン・ログイン試行制限・CSRF。
 * 管理者は1人（パスワードのみ）。パスワードハッシュは settings.admin_password_hash。
 */

function admin_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    $config = admin_config();

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.gc_maxlifetime', (string) (24 * 60 * 60));

    // セッションファイルはデータ置き場の中に置く（共有の保存先を使わない）。
    // 作成できない場合はサーバー既定の保存先のまま動かす。
    $sessionDir = admin_ensure_data_dir() . '/sessions';
    if (is_dir($sessionDir) || @mkdir($sessionDir, 0700, true)) {
        if (is_writable($sessionDir)) {
            session_save_path($sessionDir);
            // 保存先を自前にした場合、古いセッションファイルの掃除も自前で有効にする
            ini_set('session.gc_probability', '1');
            ini_set('session.gc_divisor', '100');
        }
    }

    session_name($config['session_name']);
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => $config['admin_base'] . '/',
        'secure'   => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function admin_password_is_set(): bool
{
    return admin_setting('admin_password_hash') !== null;
}

/**
 * 初回パスワード設定。既に設定済みなら何もせず false（同時送信でも上書きしない）。
 */
function admin_set_initial_password(string $password): bool
{
    $stmt = admin_db()->prepare(
        'INSERT INTO settings (key, value, updated_at) VALUES (?, ?, ?) ON CONFLICT(key) DO NOTHING'
    );
    $stmt->execute(['admin_password_hash', password_hash($password, PASSWORD_DEFAULT), admin_now()]);
    return $stmt->rowCount() === 1;
}

function admin_is_logged_in(): bool
{
    admin_session_start();
    if (($_SESSION['admin_auth'] ?? false) !== true) {
        return false;
    }
    $last = (int) ($_SESSION['last_activity'] ?? 0);
    if (time() - $last > admin_config()['idle_timeout']) {
        admin_audit('timeout');
        admin_logout_session();
        return false;
    }
    $_SESSION['last_activity'] = time();
    return true;
}

function admin_require_login(): void
{
    if (!admin_password_is_set()) {
        admin_redirect('/setup');
    }
    if (!admin_is_logged_in()) {
        admin_redirect('/login');
    }
}

function admin_logout_session(): void
{
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires'  => time() - 3600,
            'path'     => $params['path'],
            'secure'   => $params['secure'],
            'httponly' => $params['httponly'],
            'samesite' => $params['samesite'],
        ]);
        session_destroy();
    }
}

/**
 * ロック中なら解除予定のUNIX時刻、ロックされていなければ null。
 * 「最後の成功以降の失敗」のうち直近 login_max_failures 件が login_window 秒以内に
 * 収まっていれば、最新の失敗から login_lock 秒ロックする。
 */
function admin_login_locked_until(string $ip): ?int
{
    $config = admin_config();
    $stmt = admin_db()->prepare(
        'SELECT attempted_at FROM login_attempts
         WHERE ip = ? AND success = 0
           AND attempted_at > COALESCE((SELECT MAX(attempted_at) FROM login_attempts WHERE ip = ? AND success = 1), \'\')
         ORDER BY attempted_at DESC LIMIT ' . (int) $config['login_max_failures']
    );
    $stmt->execute([$ip, $ip]);
    $times = array_map(static fn ($t) => strtotime((string) $t), $stmt->fetchAll(PDO::FETCH_COLUMN));

    if (count($times) < $config['login_max_failures']) {
        return null;
    }
    $newest = $times[0];
    $oldest = $times[count($times) - 1];
    if ($newest - $oldest > $config['login_window']) {
        return null;
    }
    $until = $newest + $config['login_lock'];
    return $until > time() ? $until : null;
}

function admin_record_login_attempt(string $ip, bool $success): void
{
    admin_db()->prepare('INSERT INTO login_attempts (ip, success, attempted_at) VALUES (?, ?, ?)')
        ->execute([$ip, $success ? 1 : 0, admin_now()]);
}

/**
 * ログイン処理。結果：'ok' / 'failed' / 'locked'
 */
function admin_attempt_login(string $password): string
{
    $ip = admin_client_ip();

    if (admin_login_locked_until($ip) !== null) {
        admin_audit('login_blocked');
        return 'locked';
    }

    $hash = admin_setting('admin_password_hash');
    if ($hash !== null && password_verify($password, $hash)) {
        admin_record_login_attempt($ip, true);
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            admin_set_setting('admin_password_hash', password_hash($password, PASSWORD_DEFAULT));
        }
        session_regenerate_id(true);
        $_SESSION['admin_auth'] = true;
        $_SESSION['last_activity'] = time();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        admin_audit('login');
        return 'ok';
    }

    admin_record_login_attempt($ip, false);
    admin_audit('login_failed');
    if (admin_login_locked_until($ip) !== null) {
        admin_audit('login_locked');
        return 'locked';
    }
    return 'failed';
}

/**
 * パスワード変更。結果：'ok' / 'wrong_current' / 'too_short' / 'mismatch'
 */
function admin_change_password(string $current, string $new, string $confirm): string
{
    $hash = admin_setting('admin_password_hash');
    if ($hash === null || !password_verify($current, $hash)) {
        return 'wrong_current';
    }
    if (mb_strlen($new) < admin_config()['password_min_length']) {
        return 'too_short';
    }
    if ($new !== $confirm) {
        return 'mismatch';
    }
    admin_set_setting('admin_password_hash', password_hash($new, PASSWORD_DEFAULT));
    session_regenerate_id(true);
    return 'ok';
}

function admin_csrf_token(): string
{
    admin_session_start();
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function admin_csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . h(admin_csrf_token()) . '">';
}

/**
 * POST のときは必ず呼ぶ。トークン不一致なら 400 で終了。
 */
function admin_verify_csrf(): void
{
    admin_session_start();
    $sent = $_POST['csrf_token'] ?? '';
    $expected = $_SESSION['csrf_token'] ?? '';
    if (!is_string($sent) || !is_string($expected) || $expected === '' || !hash_equals($expected, $sent)) {
        admin_audit('csrf_rejected', (string) ($_SERVER['REQUEST_URI'] ?? ''));
        http_response_code(400);
        admin_render_message('送信を受け付けられませんでした', 'ページの有効期限が切れた可能性があります。ページを開き直してからもう一度操作してください。');
        exit;
    }
}
