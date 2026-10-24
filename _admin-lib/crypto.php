<?php
declare(strict_types=1);

/**
 * _admin-lib/crypto.php
 *
 * 設定値の暗号化（Discord Webhook URL、将来のSNSトークン）。sodium の secretbox を使う。
 * 鍵は初回に自動生成して _admin-data/secret-key.php に置く。
 * .php なので万一URLで開かれても中身は出力されない（.htaccess で拒否済み、.gitignore / sftp.json の secret* で除外済み）。
 * 鍵ファイルを消すと暗号化済みの設定は読めなくなる（設定し直せば復旧できる）。
 */

function admin_secret_key(): string
{
    static $key = null;
    if ($key !== null) {
        return $key;
    }

    $file = admin_ensure_data_dir() . '/secret-key.php';
    if (!is_file($file)) {
        $content = "<?php\n// 管理画面の暗号化鍵（自動生成）。削除・変更すると暗号化済みの設定が読めなくなる。\nreturn '"
            . base64_encode(random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES)) . "';\n";
        // 'x' モード：同時に2つの処理が作ろうとしても、先に作った方だけが書く
        $fp = @fopen($file, 'x');
        if ($fp !== false) {
            fwrite($fp, $content);
            fclose($fp);
            chmod($file, 0600);
        }
    }

    $decoded = base64_decode((string) (include $file), true);
    if ($decoded === false || strlen($decoded) !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
        throw new RuntimeException('暗号化鍵を読み込めません');
    }
    $key = $decoded;
    return $key;
}

function admin_encrypt(string $plain): string
{
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    return base64_encode($nonce . sodium_crypto_secretbox($plain, $nonce, admin_secret_key()));
}

function admin_decrypt(string $encoded): ?string
{
    $raw = base64_decode($encoded, true);
    if ($raw === false || strlen($raw) <= SODIUM_CRYPTO_SECRETBOX_NONCEBYTES) {
        return null;
    }
    $plain = sodium_crypto_secretbox_open(
        substr($raw, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES),
        substr($raw, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES),
        admin_secret_key()
    );
    return $plain === false ? null : $plain;
}

function admin_secret_setting(string $key): ?string
{
    $encoded = admin_setting($key);
    return $encoded === null ? null : admin_decrypt($encoded);
}

function admin_set_secret_setting(string $key, string $plain): void
{
    admin_set_setting($key, admin_encrypt($plain));
}

function admin_delete_setting(string $key): void
{
    admin_db()->prepare('DELETE FROM settings WHERE key = ?')->execute([$key]);
}
