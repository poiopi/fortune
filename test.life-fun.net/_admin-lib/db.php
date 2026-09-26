<?php
declare(strict_types=1);

/**
 * _admin-lib/db.php
 *
 * SQLite 接続とマイグレーション。
 * データ置き場が無ければ作成し、アクセス拒否の .htaccess が無ければ自動で置く
 * （アップロード漏れ対策。本来はアップロードされた .htaccess が使われる）。
 */

const ADMIN_DENY_HTACCESS = "# 管理画面のデータ置き場。Webからは一切読ませない（db.php が自動生成）。\n"
    . "Require all denied\n"
    . "RewriteEngine On\n"
    . "RewriteRule ^ - [R=404,L]\n";

function admin_now(): string
{
    return (new DateTimeImmutable('now', new DateTimeZone(admin_config()['timezone'])))->format(DATE_ATOM);
}

function admin_ensure_data_dir(): string
{
    $dir = admin_config()['data_dir'];
    if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
        throw new RuntimeException('データ置き場を作成できません');
    }
    $htaccess = $dir . '/.htaccess';
    if (!is_file($htaccess)) {
        if (file_put_contents($htaccess, ADMIN_DENY_HTACCESS, LOCK_EX) === false) {
            throw new RuntimeException('データ置き場の .htaccess を作成できません');
        }
        chmod($htaccess, 0644);
    }
    return $dir;
}

function admin_db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $path = admin_ensure_data_dir() . '/' . admin_config()['db_file'];
    $isNew = !is_file($path);

    $pdo = new PDO('sqlite:' . $path, null, null, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec('PRAGMA busy_timeout = 5000');
    $pdo->exec('PRAGMA journal_mode = WAL');
    $pdo->exec('PRAGMA foreign_keys = ON');

    if ($isNew) {
        chmod($path, 0600);
    }

    admin_migrate($pdo);

    return $pdo;
}

/**
 * migrations/*.sql を番号順に、未適用のものだけ適用する。
 * 同時アクセスで二重適用しないよう BEGIN IMMEDIATE の中で適用済みかを再確認する。
 */
function admin_migrate(PDO $pdo): void
{
    $pdo->exec('CREATE TABLE IF NOT EXISTS schema_migrations (version TEXT PRIMARY KEY, applied_at TEXT NOT NULL)');

    $files = glob(admin_config()['lib_dir'] . '/migrations/*.sql') ?: [];
    sort($files, SORT_STRING);

    $applied = array_flip($pdo->query('SELECT version FROM schema_migrations')->fetchAll(PDO::FETCH_COLUMN));

    foreach ($files as $file) {
        $version = basename($file, '.sql');
        if (isset($applied[$version])) {
            continue;
        }

        $pdo->exec('BEGIN IMMEDIATE');
        try {
            $check = $pdo->prepare('SELECT 1 FROM schema_migrations WHERE version = ?');
            $check->execute([$version]);
            if ($check->fetchColumn() === false) {
                $sql = file_get_contents($file);
                if ($sql === false) {
                    throw new RuntimeException('マイグレーションを読めません: ' . $version);
                }
                $pdo->exec($sql);
                $pdo->prepare('INSERT INTO schema_migrations (version, applied_at) VALUES (?, ?)')
                    ->execute([$version, admin_now()]);
            }
            $pdo->exec('COMMIT');
        } catch (Throwable $e) {
            $pdo->exec('ROLLBACK');
            throw $e;
        }
    }
}

function admin_setting(string $key): ?string
{
    $stmt = admin_db()->prepare('SELECT value FROM settings WHERE key = ?');
    $stmt->execute([$key]);
    $value = $stmt->fetchColumn();
    return $value === false ? null : (string) $value;
}

function admin_set_setting(string $key, string $value): void
{
    admin_db()->prepare(
        'INSERT INTO settings (key, value, updated_at) VALUES (?, ?, ?)
         ON CONFLICT(key) DO UPDATE SET value = excluded.value, updated_at = excluded.updated_at'
    )->execute([$key, $value, admin_now()]);
}
