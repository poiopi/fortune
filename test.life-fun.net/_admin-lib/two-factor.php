<?php
declare(strict_types=1);

/**
 * _admin-lib/two-factor.php
 *
 * 2段階認証の保存・照合・予備コード・締め出し時の復旧（計算部分は totp.php）。
 * 保存先：
 *  - settings.totp_secret      … 秘密鍵（Base32）。admin_set_secret_setting で暗号化
 *  - settings.totp_enabled_at  … 有効化した日時（これがあれば「有効」）
 *  - settings.totp_last_step   … 最後に受け付けたステップ番号（これ以下のコードは拒否）
 *  - two_factor_backup_codes   … 予備コード（password_hash のハッシュのみ）
 * セッション：
 *  - admin_2fa_pending    … パスワード確認済み・コード待ち（ログイン時。5分で失効）
 *  - admin_2fa_setup      … 設定中の一時的な秘密鍵（10分で破棄。DBにはまだ保存しない）
 *  - admin_2fa_show_codes … 発行した予備コード（次の画面で1回だけ表示して消す）
 * 復旧：_admin-data/reset-2fa を置くと、次にパスワードが正しく入力されたときに2段階認証を解除する。
 */

const ADMIN_2FA_BACKUP_COUNT = 10;
const ADMIN_2FA_BACKUP_LENGTH = 10;
// 読み間違えやすい文字（i・l・o・0・1）を除く
const ADMIN_2FA_BACKUP_ALPHABET = 'abcdefghjkmnpqrstuvwxyz23456789';
const ADMIN_2FA_RESET_FILE = 'reset-2fa';

function admin_2fa_enabled(): bool
{
    return admin_setting('totp_enabled_at') !== null;
}

function admin_2fa_enabled_at(): ?string
{
    return admin_setting('totp_enabled_at');
}

function admin_2fa_backup_remaining(): int
{
    return (int) admin_db()->query('SELECT COUNT(*) FROM two_factor_backup_codes WHERE used_at IS NULL')->fetchColumn();
}

/** 入力の空白・ハイフンを除き、小文字にそろえる。 */
function admin_2fa_normalize_code(string $input): string
{
    return strtolower((string) preg_replace('/[\s\-]+/u', '', $input));
}

/**
 * 入力されたコードを照合し、受け付けたら使用済みにする。
 * 戻り値：'totp'（認証アプリのコード）／'backup'（予備コード）／null（誤り・未設定）
 */
function admin_2fa_verify(string $input): ?string
{
    if (!admin_2fa_enabled()) {
        return null;
    }
    $code = admin_2fa_normalize_code($input);

    if (preg_match('/^\d{' . ADMIN_TOTP_DIGITS . '}$/', $code) === 1) {
        $secret = admin_secret_setting('totp_secret');
        $key = $secret === null ? null : admin_base32_decode($secret);
        if ($key === null) {
            return null;
        }
        $lastStep = (int) (admin_setting('totp_last_step') ?? '-1');
        $step = admin_totp_verify($key, $code, time(), $lastStep);
        if ($step === null) {
            return null;
        }
        // 同時に2回送られても、ステップを先に進めた方だけを受け付ける
        $stmt = admin_db()->prepare(
            "UPDATE settings SET value = ?, updated_at = ? WHERE key = 'totp_last_step' AND CAST(value AS INTEGER) < ?"
        );
        $stmt->execute([(string) $step, admin_now(), $step]);
        return $stmt->rowCount() === 1 ? 'totp' : null;
    }

    if (strlen($code) === ADMIN_2FA_BACKUP_LENGTH && strspn($code, ADMIN_2FA_BACKUP_ALPHABET) === ADMIN_2FA_BACKUP_LENGTH) {
        $rows = admin_db()->query('SELECT id, code_hash FROM two_factor_backup_codes WHERE used_at IS NULL ORDER BY id')->fetchAll();
        foreach ($rows as $row) {
            if (password_verify($code, (string) $row['code_hash'])) {
                $stmt = admin_db()->prepare('UPDATE two_factor_backup_codes SET used_at = ? WHERE id = ? AND used_at IS NULL');
                $stmt->execute([admin_now(), (int) $row['id']]);
                return $stmt->rowCount() === 1 ? 'backup' : null;
            }
        }
    }
    return null;
}

/** 予備コードを作り直す（旧コードはすべて削除）。トランザクションの中で呼ぶ。戻り値：表示用のコード（xxxxx-xxxxx）。 */
function admin_2fa_replace_backup_codes_in_tx(): array
{
    $db = admin_db();
    $db->exec('DELETE FROM two_factor_backup_codes');
    $insert = $db->prepare('INSERT INTO two_factor_backup_codes (code_hash, created_at) VALUES (?, ?)');
    $now = admin_now();
    $max = strlen(ADMIN_2FA_BACKUP_ALPHABET) - 1;
    $codes = [];
    while (count($codes) < ADMIN_2FA_BACKUP_COUNT) {
        $code = '';
        for ($i = 0; $i < ADMIN_2FA_BACKUP_LENGTH; $i++) {
            $code .= ADMIN_2FA_BACKUP_ALPHABET[random_int(0, $max)];
        }
        if (isset($codes[$code])) {
            continue;
        }
        $insert->execute([password_hash($code, PASSWORD_DEFAULT), $now]);
        $codes[$code] = substr($code, 0, 5) . '-' . substr($code, 5);
    }
    return array_values($codes);
}

/** 予備コードの再発行。戻り値：表示用のコード。 */
function admin_2fa_regenerate_backup_codes(): array
{
    $db = admin_db();
    $db->exec('BEGIN IMMEDIATE');
    try {
        $codes = admin_2fa_replace_backup_codes_in_tx();
        $db->exec('COMMIT');
    } catch (Throwable $e) {
        $db->exec('ROLLBACK');
        throw $e;
    }
    return $codes;
}

/**
 * 有効化（再設定を含む）。秘密鍵を暗号化して保存し、確認に使ったステップを「最後に受け付けたステップ」にする。
 * 予備コードも作り直す。戻り値：表示用の予備コード。
 */
function admin_2fa_enable(string $secret, int $confirmedStep): array
{
    $db = admin_db();
    $db->exec('BEGIN IMMEDIATE');
    try {
        admin_set_secret_setting('totp_secret', $secret);
        admin_set_setting('totp_last_step', (string) $confirmedStep);
        admin_set_setting('totp_enabled_at', admin_now());
        $codes = admin_2fa_replace_backup_codes_in_tx();
        $db->exec('COMMIT');
    } catch (Throwable $e) {
        $db->exec('ROLLBACK');
        throw $e;
    }
    return $codes;
}

/** 無効化。秘密鍵・状態・予備コードを削除する。 */
function admin_2fa_disable(): void
{
    $db = admin_db();
    $db->exec('BEGIN IMMEDIATE');
    try {
        $db->exec("DELETE FROM settings WHERE key IN ('totp_secret', 'totp_enabled_at', 'totp_last_step')");
        $db->exec('DELETE FROM two_factor_backup_codes');
        $db->exec('COMMIT');
    } catch (Throwable $e) {
        $db->exec('ROLLBACK');
        throw $e;
    }
    unset($_SESSION['admin_2fa_setup']);
}

/**
 * 無効化・再発行・再設定の前の本人確認（現在のパスワード＋現在のコードまたは予備コード）。
 * 戻り値：'ok' / 'wrong_password' / 'wrong_code'。パスワードが違うときはコードを照合しない（使用済みにしない）。
 */
function admin_2fa_check_credentials(string $password, string $code): string
{
    $hash = admin_setting('admin_password_hash');
    if ($hash === null || !password_verify($password, $hash)) {
        return 'wrong_password';
    }
    return admin_2fa_verify($code) !== null ? 'ok' : 'wrong_code';
}

/**
 * 無効化・再発行・再設定の画面からの本人確認（試行制限つき）。戻り値：'ok' / 'wrong_password' / 'wrong_code' / 'locked'。
 * ログインと同じ試行制限を使う：ロック中は照合せずに拒否し、失敗は login_attempts に記録する（同一IP 15分で5回 → 15分）。
 * 成功は記録しない（ログインの失敗回数を本人確認の成功で消さない）。
 */
function admin_2fa_manage_check(string $password, string $code, string $action): string
{
    $ip = admin_client_ip();
    if (admin_login_locked_until($ip) !== null) {
        admin_audit('login_blocked', null, '2段階認証の操作：' . $action);
        return 'locked';
    }
    $check = admin_2fa_check_credentials($password, $code);
    if ($check === 'ok') {
        return 'ok';
    }
    admin_record_login_attempt($ip, false);
    admin_audit('2fa_manage_failed', null, $action . ':' . $check);
    if (admin_login_locked_until($ip) !== null) {
        admin_audit('login_locked');
        return 'locked';
    }
    return $check;
}

// ---- 設定中の一時的な秘密鍵（セッション） ----

/** $mode：'enable'（新規）／'reset'（再設定） */
function admin_2fa_setup_begin(string $mode): void
{
    $_SESSION['admin_2fa_setup'] = ['secret' => admin_totp_generate_secret(), 'at' => time(), 'mode' => $mode];
}

/** 設定中なら ['secret', 'at', 'mode']、なければ（10分を過ぎたら破棄して）null。 */
function admin_2fa_setup_current(): ?array
{
    $setup = $_SESSION['admin_2fa_setup'] ?? null;
    if (!is_array($setup) || !isset($setup['secret'], $setup['at'], $setup['mode'])) {
        unset($_SESSION['admin_2fa_setup']);
        return null;
    }
    if (time() - (int) $setup['at'] > admin_config()['two_factor_setup_ttl']) {
        unset($_SESSION['admin_2fa_setup']);
        return null;
    }
    return $setup;
}

function admin_2fa_setup_cancel(): void
{
    unset($_SESSION['admin_2fa_setup']);
}

/**
 * 設定中の秘密鍵で6桁コードを確認し、合えば保存・有効化する。
 * 戻り値：'ok' / 'expired' / 'wrong'。ok のとき、予備コードを admin_2fa_show_codes に入れる（次の画面で1回だけ表示）。
 */
function admin_2fa_setup_confirm(string $input): string
{
    $setup = admin_2fa_setup_current();
    if ($setup === null) {
        return 'expired';
    }
    $key = admin_base32_decode((string) $setup['secret']);
    $step = $key === null ? null : admin_totp_verify($key, admin_2fa_normalize_code($input), time(), -1);
    if ($step === null) {
        return 'wrong';
    }
    $wasEnabled = admin_2fa_enabled();
    $codes = admin_2fa_enable((string) $setup['secret'], $step);
    unset($_SESSION['admin_2fa_setup']);
    $_SESSION['admin_2fa_show_codes'] = $codes;
    admin_audit($wasEnabled ? '2fa_reset' : '2fa_enabled', null, '予備コード' . count($codes) . '個を発行');
    return 'ok';
}

/** 発行した予備コードを1回だけ取り出す（取り出したらセッションから消す）。 */
function admin_2fa_take_shown_codes(): ?array
{
    $codes = $_SESSION['admin_2fa_show_codes'] ?? null;
    unset($_SESSION['admin_2fa_show_codes']);
    return is_array($codes) ? $codes : null;
}

// ---- ログイン時のコード待ち（セッション） ----

function admin_2fa_pending_start(): void
{
    $_SESSION['admin_2fa_pending'] = ['at' => time()];
}

/** コード待ちが有効か（5分を過ぎていたら消して false）。 */
function admin_2fa_pending_valid(): bool
{
    $pending = $_SESSION['admin_2fa_pending'] ?? null;
    if (!is_array($pending) || !isset($pending['at']) || time() - (int) $pending['at'] > admin_config()['two_factor_pending_ttl']) {
        unset($_SESSION['admin_2fa_pending']);
        return false;
    }
    return true;
}

function admin_2fa_pending_clear(): void
{
    unset($_SESSION['admin_2fa_pending']);
}

// ---- 締め出し時の復旧（_admin-data/reset-2fa） ----

function admin_2fa_reset_file(): string
{
    return admin_assert_writable_path(admin_data_path(ADMIN_2FA_RESET_FILE));
}

/**
 * パスワードが正しかったときにだけ呼ぶ。reset-2fa ファイルがあれば2段階認証を解除し、ファイルを削除・記録・通知する。
 * 戻り値：解除した（有効だったものを無効にした）なら true。
 */
function admin_2fa_apply_reset_file(): bool
{
    $file = admin_2fa_reset_file();
    if (!is_file($file)) {
        return false;
    }
    $wasEnabled = admin_2fa_enabled();
    if ($wasEnabled) {
        admin_2fa_disable();
    }
    $deleted = @unlink($file);
    $detail = ($wasEnabled ? '2段階認証を解除' : '2段階認証は未設定だった')
        . ($deleted ? '・ファイルを削除' : '・ファイルを削除できませんでした（FTPで削除してください）');
    admin_audit('2fa_file_reset', null, $detail);
    if ($wasEnabled) {
        admin_notify('2fa_file_reset', "サーバーに置かれた reset-2fa ファイルにより、管理画面の2段階認証を解除しました。\n"
            . '日時：' . admin_format_time(admin_now()) . "\n"
            . 'IP：' . admin_client_ip() . "\n"
            . ($deleted ? '' : "reset-2fa ファイルを削除できませんでした。FTPで削除してください。\n")
            . '心当たりがない場合は、すぐにパスワードを変更し、2段階認証を設定し直してください。', true);
    }
    return $wasEnabled;
}
