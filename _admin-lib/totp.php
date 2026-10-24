<?php
declare(strict_types=1);

/**
 * _admin-lib/totp.php
 *
 * 2段階認証の計算部分（保存・画面は two-factor.php）。
 *  - Base32（RFC 4648、パディングなし）
 *  - HOTP（RFC 4226）／TOTP（RFC 6238：HMAC-SHA1、30秒、6桁、T0=0）
 * 照合は時刻ずれ ±1 ステップまで。最後に受け付けたステップ以下のコードは拒否する（同じコードの使い回し防止）。
 */

const ADMIN_TOTP_PERIOD = 30;
const ADMIN_TOTP_DIGITS = 6;
const ADMIN_TOTP_SECRET_BYTES = 20;
const ADMIN_BASE32_ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

function admin_base32_encode(string $binary): string
{
    $out = '';
    $buffer = 0;
    $bits = 0;
    $length = strlen($binary);
    for ($i = 0; $i < $length; $i++) {
        $buffer = ($buffer << 8) | ord($binary[$i]);
        $bits += 8;
        while ($bits >= 5) {
            $bits -= 5;
            $out .= ADMIN_BASE32_ALPHABET[($buffer >> $bits) & 31];
        }
        $buffer &= (1 << $bits) - 1;
    }
    if ($bits > 0) {
        $out .= ADMIN_BASE32_ALPHABET[($buffer << (5 - $bits)) & 31];
    }
    return $out;
}

/** 空白・末尾の「=」・小文字は許す。使えない文字があれば null。 */
function admin_base32_decode(string $text): ?string
{
    $text = rtrim(strtoupper((string) preg_replace('/\s+/', '', $text)), '=');
    if ($text === '' || strspn($text, ADMIN_BASE32_ALPHABET) !== strlen($text)) {
        return null;
    }
    $out = '';
    $buffer = 0;
    $bits = 0;
    $length = strlen($text);
    for ($i = 0; $i < $length; $i++) {
        $buffer = ($buffer << 5) | strpos(ADMIN_BASE32_ALPHABET, $text[$i]);
        $bits += 5;
        if ($bits >= 8) {
            $bits -= 8;
            $out .= chr(($buffer >> $bits) & 0xFF);
        }
        $buffer &= (1 << $bits) - 1;
    }
    return $out;
}

/** HOTP（RFC 4226）。$digits 桁の文字列（先頭0埋め）。 */
function admin_hotp(string $key, int $counter, int $digits = ADMIN_TOTP_DIGITS): string
{
    $hash = hash_hmac('sha1', pack('J', $counter), $key, true);
    $offset = ord($hash[19]) & 0x0F;
    $value = ((ord($hash[$offset]) & 0x7F) << 24)
        | (ord($hash[$offset + 1]) << 16)
        | (ord($hash[$offset + 2]) << 8)
        | ord($hash[$offset + 3]);
    return str_pad((string) ($value % (10 ** $digits)), $digits, '0', STR_PAD_LEFT);
}

/** UNIX時刻 → TOTPのステップ番号（T0=0）。 */
function admin_totp_step(int $time): int
{
    return intdiv($time, ADMIN_TOTP_PERIOD);
}

function admin_totp_code(string $key, int $time): string
{
    return admin_hotp($key, admin_totp_step($time));
}

/**
 * 6桁コードの照合。現在のステップ ±1 のうち、$lastStep より大きいステップで一致すればそのステップ番号、なければ null。
 * 比較は hash_equals。
 */
function admin_totp_verify(string $key, string $code, int $time, int $lastStep): ?int
{
    if (preg_match('/^\d{' . ADMIN_TOTP_DIGITS . '}$/', $code) !== 1) {
        return null;
    }
    $current = admin_totp_step($time);
    $matched = null;
    foreach ([-1, 0, 1] as $delta) {
        $step = $current + $delta;
        if ($step < 0) {
            continue;
        }
        if (hash_equals(admin_hotp($key, $step), $code) && $step > $lastStep) {
            $matched = $step;
        }
    }
    return $matched;
}

/** 新しい秘密鍵（20バイトの乱数を Base32 にしたもの）。 */
function admin_totp_generate_secret(): string
{
    return admin_base32_encode(random_bytes(ADMIN_TOTP_SECRET_BYTES));
}

/** 手入力用に4文字ずつ区切る。 */
function admin_totp_format_secret(string $secret): string
{
    return trim(chunk_split($secret, 4, ' '));
}

/** 認証アプリに読ませる otpauth URI（Key Uri Format）。 */
function admin_totp_uri(string $secret): string
{
    $config = admin_config();
    $issuer = $config['totp_issuer'];
    return 'otpauth://totp/' . rawurlencode($issuer) . ':' . rawurlencode($config['totp_account'])
        . '?secret=' . $secret
        . '&issuer=' . rawurlencode($issuer)
        . '&algorithm=SHA1&digits=' . ADMIN_TOTP_DIGITS . '&period=' . ADMIN_TOTP_PERIOD;
}
