<?php
declare(strict_types=1);

/**
 * _admin-lib/auth.php
 *
 * セッション・ログイン・ログイン試行制限・CSRF。
 * 管理者は1人。パスワードハッシュは settings.admin_password_hash。
 * 2段階認証（two-factor.php）が有効なときは、パスワードの後にコード入力（admin_attempt_login_2fa）が必要。
 * コード待ちの間は admin_auth を立てないため、admin_require_login は他の管理ページをログイン画面へ戻す。
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
 * ログイン処理（パスワード）。結果：
 *  'ok'        … ログイン完了
 *  'need_2fa'  … パスワードは正しい。2段階認証のコード入力待ち（まだログインしていない）
 *  'reset_2fa' … reset-2fa ファイルにより2段階認証を解除してログイン完了（設定し直しを促す）
 *  'failed' / 'locked'
 * 2段階認証が有効なときは、パスワードが正しくても成功として記録しない（コード入力の失敗と合わせて数え、
 * パスワードの再入力で失敗回数が消えないようにするため）。成功の記録はコードを受け付けたとき。
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
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            admin_set_setting('admin_password_hash', password_hash($password, PASSWORD_DEFAULT));
        }
        $reset = admin_2fa_apply_reset_file();
        if (admin_2fa_enabled()) {
            // コード待ちに入る前にセッションIDを振り直す（パスワード確認前のIDを引き継がない）
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_regenerate_id(true);
            }
            admin_2fa_pending_start();
            admin_audit('2fa_pending');
            return 'need_2fa';
        }
        admin_complete_login($ip);
        if ($reset) {
            $_SESSION['flash'] = ['type' => 'error', 'text' => '2段階認証を解除しました（サーバーの reset-2fa ファイルによる解除）。設定し直してください。'];
            return 'reset_2fa';
        }
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

/** 直近 two_factor_global_window 秒の2段階認証のコード誤り（全IP合計。操作ログ 2fa_failed の件数） */
function admin_2fa_recent_global_failures(): int
{
    $since = (new DateTimeImmutable('-' . (int) admin_config()['two_factor_global_window'] . ' seconds', new DateTimeZone(admin_config()['timezone'])))->format(DATE_ATOM);
    $stmt = admin_db()->prepare("SELECT COUNT(*) FROM audit_logs WHERE action = '2fa_failed' AND at > ?");
    $stmt->execute([$since]);
    return (int) $stmt->fetchColumn();
}

/** 秒数を通知用の「N時間」「N分」にする */
function admin_2fa_window_label(int $seconds): string
{
    return $seconds >= 3600 && $seconds % 3600 === 0 ? intdiv($seconds, 3600) . '時間' : intdiv($seconds, 60) . '分';
}

/** IPをまたいだ上限に達しているか（達していれば通知する。同じ文面は通知の重複防止（60分）に従う） */
function admin_2fa_global_locked(): bool
{
    $config = admin_config();
    if (admin_2fa_recent_global_failures() < $config['two_factor_global_max_failures']) {
        return false;
    }
    admin_notify('2fa_global_locked', '管理画面の2段階認証のコード誤りが、直近' . intdiv((int) $config['two_factor_global_window'], 60) . '分で'
        . $config['two_factor_global_max_failures'] . "回以上ありました（全IPの合計）。\n"
        . "そのため、すべてのIPからのコード入力を一時的に止めています（誤りが減ると自動で再開します）。\n"
        . '心当たりがない場合は、上限が解けてから（最長' . admin_2fa_window_label((int) $config['two_factor_global_window']) . '）ログインし、パスワードを変更してください。'
        . "\n" . admin_absolute_admin_url('/logs'));
    return true;
}

/**
 * ログイン処理（2段階認証のコード）。admin_attempt_login が 'need_2fa' を返した後に使う。
 * 結果：'ok' / 'failed' / 'locked' / 'global_locked'（全IP合計の上限） / 'expired'（コード待ちが無い・5分を過ぎた → パスワードからやり直し）
 * 失敗はパスワードの失敗と同じ login_attempts に記録し、同じロック（同一IP 15分で5回 → 15分）に合算する。
 * さらに、直近1時間のコード誤りが全IP合計で10回以上なら、全IPでコード入力を拒否する（値は config）。
 */
function admin_attempt_login_2fa(string $code): string
{
    $ip = admin_client_ip();

    if (!admin_2fa_pending_valid()) {
        return 'expired';
    }
    if (admin_login_locked_until($ip) !== null) {
        admin_audit('login_blocked');
        return 'locked';
    }
    if (admin_2fa_global_locked()) {
        admin_audit('login_blocked', null, '2段階認証：全IP合計の上限');
        return 'global_locked';
    }
    if (!admin_2fa_enabled()) {
        admin_2fa_pending_clear();
        return 'expired';
    }

    $method = admin_2fa_verify($code);
    if ($method !== null) {
        admin_complete_login($ip, $method === 'backup' ? '2段階認証：予備コード' : '2段階認証：認証アプリ');
        if ($method === 'backup') {
            admin_audit('2fa_backup_login', null, '予備コードの残り' . admin_2fa_backup_remaining() . '個');
        }
        return 'ok';
    }

    admin_record_login_attempt($ip, false);
    admin_audit('2fa_failed');
    // 上限に達したらこの時点で通知する（IPのロックより先に判定し、通知を漏らさない）
    $globalLocked = admin_2fa_global_locked();
    if (admin_login_locked_until($ip) !== null) {
        admin_audit('login_locked');
        return 'locked';
    }
    return $globalLocked ? 'global_locked' : 'failed';
}

/** ログイン完了（成功の記録・セッションIDの振り直し・ログイン状態の設定）。 */
function admin_complete_login(string $ip, ?string $detail = null): void
{
    admin_record_login_attempt($ip, true);
    session_regenerate_id(true);
    admin_2fa_pending_clear();
    $_SESSION['admin_auth'] = true;
    $_SESSION['last_activity'] = time();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    admin_audit('login', null, $detail);
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
