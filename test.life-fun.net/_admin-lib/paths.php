<?php
declare(strict_types=1);

/**
 * _admin-lib/paths.php
 *
 * 書き込み先のガード（ADMIN_FEATURES_ORGANIZED.md 1-4「守りの原則」2：書き込み先は自分の環境のフォルダに固定する）。
 * config の site_root はSTGのとき本番の公開フォルダを指すため、管理画面がファイルを書くときは
 * 必ずデータ置き場（config の data_dir）の中であることをここで確かめる。
 *  - admin_data_path()          … データ置き場の中の相対パスから絶対パスを作る（抜け道になる書き方は拒否）
 *  - admin_assert_writable_path() … 絶対パスがデータ置き場の中かを、実在する最も近い親を realpath で解決して確かめる
 */

/**
 * データ置き場の中の絶対パスを返す。
 * 拒否するもの：空・NULバイト・バックスラッシュ・絶対パス（/ やドライブ名で始まる）・コロン（ストリームラッパー等）・
 * 「.」「..」・空の区切り（//）。
 */
function admin_data_path(string $relative): string
{
    if ($relative === '' || str_contains($relative, "\0") || str_contains($relative, '\\') || str_contains($relative, ':')) {
        throw new InvalidArgumentException('データ置き場のパスとして使えない文字が含まれています');
    }
    if ($relative[0] === '/') {
        throw new InvalidArgumentException('データ置き場のパスに絶対パスは使えません');
    }
    foreach (explode('/', rtrim($relative, '/')) as $segment) {
        if ($segment === '' || $segment === '.' || $segment === '..') {
            throw new InvalidArgumentException('データ置き場のパスに「.」「..」・空の区切りは使えません');
        }
    }
    return rtrim(str_replace('\\', '/', admin_config()['data_dir']), '/') . '/' . rtrim($relative, '/');
}

/** 比較用にパスを正規化する（区切りを / に。Windows では大文字小文字を区別しない）。 */
function admin_path_normalize(string $path): string
{
    $path = rtrim(str_replace('\\', '/', $path), '/');
    return PHP_OS_FAMILY === 'Windows' ? strtolower($path) : $path;
}

/**
 * 書き込み先がデータ置き場の中（データ置き場そのものを含む）であることを保証する。違えば RuntimeException。
 * パスが既にあればそれ自体を、無ければ実在する最も近い親を realpath で解決して比べる（シンボリックリンクで外に出るのも拒否）。
 * まだ無い部分に「..」があると realpath で解決できないため、「..」を含むパスはそれだけで拒否する。
 * 戻り値：渡されたパスそのもの（呼び出し側でそのまま使える）。
 */
function admin_assert_writable_path(string $absPath): string
{
    if ($absPath === '' || str_contains($absPath, "\0") || str_contains($absPath, '://')) {
        throw new RuntimeException('書き込み先のパスが不正です');
    }
    $normalized = str_replace('\\', '/', $absPath);
    if (in_array('..', explode('/', $normalized), true)) {
        throw new RuntimeException('書き込み先のパスに「..」は使えません');
    }

    $dataReal = realpath(admin_config()['data_dir']);
    if ($dataReal === false) {
        throw new RuntimeException('データ置き場がありません');
    }

    $existing = $normalized;
    while (!file_exists($existing)) {
        $parent = dirname($existing);
        if ($parent === $existing || $parent === '.' || $parent === '') {
            throw new RuntimeException('書き込み先の親フォルダが見つかりません');
        }
        $existing = $parent;
    }
    $real = realpath($existing);
    if ($real === false) {
        throw new RuntimeException('書き込み先の親フォルダを解決できません');
    }

    $base = admin_path_normalize($dataReal);
    $target = admin_path_normalize($real);
    if ($target !== $base && !str_starts_with($target, $base . '/')) {
        throw new RuntimeException('データ置き場の外には書き込めません');
    }
    return $absPath;
}
