<?php
declare(strict_types=1);

/**
 * _admin-lib/backup.php
 *
 * 管理画面DBの毎日の自動バックアップ（ADMIN_FEATURES_ORGANIZED.md 6章 段階1「データ置き場の保護・自動バックアップ」、
 * ADMIN_PLAN.md 7章「バックアップ」行）。
 *  - cron の backup ジョブ（jobs.php）から1日1回
 *  - 方式：VACUUM INTO（SQLite 3.27以上）→ 使えなければ SQLite3::backup()。どちらもWAL中でも整合した複製になる。
 *    ファイルのコピーは使わない（WALの未反映分が欠ける・書き込み途中を写す恐れがあるため）
 *  - 一時名で作る → 開いて PRAGMA integrity_check が ok → rename で確定 → 0600
 *  - 保存先：_admin-data/backups/admin-YYYYMMDD-HHMMSS.sqlite（config の timezone）。14世代保持
 *  - 書き込み・削除はすべて paths.php のガードを通す
 *  - 記録（settings）：backup_last_success_at / backup_last_file（ファイル名のみ）/ backup_last_size、
 *    失敗時 backup_last_error（日時＋理由。パスはデータ置き場からの相対）
 *  - 失敗の通知は、例外を投げて jobs.php の admin_run_job() の「cronジョブ失敗」通知（admin_notify）に任せる（二重通知を避ける）
 *
 * 復元：バックアップファイルは単体で完結した SQLite ファイル（journal_mode=DELETE、-wal/-shm 不要）。
 * cron を止め、admin.sqlite・admin.sqlite-wal・admin.sqlite-shm を退避してから、バックアップを admin.sqlite として置く。
 */

const ADMIN_BACKUP_DIR = 'backups';
const ADMIN_BACKUP_KEEP = 14;
const ADMIN_BACKUP_FILE_PATTERN = '/^admin-\d{8}-\d{6}\.sqlite$/';
const ADMIN_BACKUP_TMP_PATTERN = '/^\.tmp-admin-\d{8}-\d{6}\.sqlite-[0-9a-f]{8}(?:-wal|-shm|-journal)?$/';
/** サイトヘルスの判定：最終成功からの時間 */
const ADMIN_BACKUP_GREEN_HOURS = 26;
const ADMIN_BACKUP_YELLOW_HOURS = 50;

/** backups/ を用意する（0700、念のため拒否の .htaccess も置く）。戻り値：絶対パス */
function admin_backup_dir(): string
{
    admin_ensure_data_dir();
    $dir = admin_assert_writable_path(admin_data_path(ADMIN_BACKUP_DIR));
    if (!is_dir($dir)) {
        if (file_exists($dir)) {
            throw new RuntimeException('_admin-data/' . ADMIN_BACKUP_DIR . ' がフォルダではありません');
        }
        if (!@mkdir($dir, 0700) && !is_dir($dir)) {
            throw new RuntimeException('_admin-data/' . ADMIN_BACKUP_DIR . ' を作成できません');
        }
    }
    @chmod($dir, 0700);
    $htaccess = admin_assert_writable_path($dir . '/.htaccess');
    if (!is_file($htaccess)) {
        if (file_put_contents($htaccess, ADMIN_DENY_HTACCESS, LOCK_EX) === false) {
            throw new RuntimeException('_admin-data/' . ADMIN_BACKUP_DIR . '/.htaccess を作成できません');
        }
        @chmod($htaccess, 0644);
    }
    return $dir;
}

/** backups/ 内のバックアップファイル名（古い順）。フォルダが無ければ空。 */
function admin_backup_files(): array
{
    $dir = admin_data_path(ADMIN_BACKUP_DIR);
    if (!is_dir($dir)) {
        return [];
    }
    $names = array_values(array_filter(scandir($dir) ?: [], static fn (string $n): bool => preg_match(ADMIN_BACKUP_FILE_PATTERN, $n) === 1));
    sort($names, SORT_STRING);
    return $names;
}

/** 例外メッセージからデータ置き場・公開フォルダの絶対パスを消す（記録・通知に機密を含めない）。 */
function admin_backup_sanitize(string $message): string
{
    $config = admin_config();
    $replace = [];
    foreach ([$config['data_dir'], realpath($config['data_dir']) ?: null] as $p) {
        if ($p !== null) {
            $replace[str_replace('\\', '/', $p)] = '_admin-data';
            $replace[str_replace('/', '\\', $p)] = '_admin-data';
        }
    }
    foreach ([$config['site_root'], $config['lib_dir']] as $p) {
        $replace[str_replace('\\', '/', $p)] = '(server)';
        $replace[str_replace('/', '\\', $p)] = '(server)';
    }
    uksort($replace, static fn (string $a, string $b): int => strlen($b) <=> strlen($a));
    return mb_strimwidth(strtr($message, $replace), 0, 500, '…');
}

/** 一時ファイル（と付随する -wal/-shm/-journal）を消す。ガードを通し、一時ファイルの名前に一致するものだけ。 */
function admin_backup_remove_tmp(string $tmp): void
{
    foreach (['', '-wal', '-shm', '-journal'] as $suffix) {
        $file = $tmp . $suffix;
        if (preg_match(ADMIN_BACKUP_TMP_PATTERN, basename($file)) === 1 && is_file($file)) {
            @unlink(admin_assert_writable_path($file));
        }
    }
}

/** DBの整合した複製を $tmp に作る。戻り値：使った方式 */
function admin_backup_write(string $tmp): string
{
    try {
        admin_db()->prepare('VACUUM INTO ?')->execute([$tmp]);
        return 'VACUUM INTO';
    } catch (PDOException $e) {
        admin_backup_remove_tmp($tmp);
        if (!class_exists('SQLite3')) {
            throw new RuntimeException('VACUUM INTO が使えず（' . $e->getMessage() . '）、SQLite3 拡張もありません');
        }
    }

    $src = new SQLite3(admin_assert_writable_path(admin_data_path(admin_config()['db_file'])), SQLITE3_OPEN_READWRITE);
    $src->busyTimeout(5000);
    $dst = new SQLite3($tmp);
    try {
        if (!$src->backup($dst)) {
            throw new RuntimeException('SQLite3::backup が失敗しました（' . $dst->lastErrorMsg() . '）');
        }
    } finally {
        $dst->close();
        $src->close();
    }
    return 'SQLite3::backup';
}

/** 複製を開いて単体ファイルにし（journal_mode=DELETE）、整合性を確かめる。ok でなければ例外。 */
function admin_backup_verify(string $tmp): void
{
    $pdo = new PDO('sqlite:' . $tmp, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
        $pdo->exec('PRAGMA busy_timeout = 5000');
        $pdo->query('PRAGMA journal_mode = DELETE')->fetchAll();
        $stmt = $pdo->query('PRAGMA integrity_check');
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $stmt->closeCursor();
        $stmt = null;
        if ($rows !== ['ok']) {
            throw new RuntimeException('整合性チェックが ok になりません（' . mb_strimwidth(implode(' / ', $rows), 0, 200, '…') . '）');
        }
        $stmt = $pdo->query('SELECT COUNT(*) FROM schema_migrations');
        $migrations = (int) $stmt->fetchColumn();
        $stmt->closeCursor();
        $stmt = null;
        if ($migrations === 0) {
            throw new RuntimeException('複製にマイグレーションの記録がありません');
        }
    } finally {
        $pdo = null;
    }
}

/** 古い世代を消す（名前順で新しい ADMIN_BACKUP_KEEP 個を残す）。戻り値：消した数 */
function admin_backup_prune(string $dir): int
{
    $names = admin_backup_files();
    $deleted = 0;
    foreach (array_slice($names, 0, max(0, count($names) - ADMIN_BACKUP_KEEP)) as $name) {
        if (@unlink(admin_assert_writable_path($dir . '/' . $name))) {
            $deleted++;
        }
    }
    return $deleted;
}

/** 失敗で残った一時ファイルを消す（同時に動くのは dispatch のロックで1本だけ）。 */
function admin_backup_cleanup_tmp(string $dir): void
{
    foreach (scandir($dir) ?: [] as $name) {
        if (preg_match(ADMIN_BACKUP_TMP_PATTERN, $name) === 1) {
            @unlink(admin_assert_writable_path($dir . '/' . $name));
        }
    }
}

/**
 * バックアップを1回作る。失敗時は backup_last_error を記録して RuntimeException（cronジョブ失敗として通知される）。
 * 戻り値：cronの記録用の短い文
 */
function admin_backup_run(?DateTimeImmutable $now = null): string
{
    $now = ($now ?? new DateTimeImmutable('now'))->setTimezone(new DateTimeZone(admin_config()['timezone']));
    $tmp = null;
    try {
        $dir = admin_backup_dir();
        admin_backup_cleanup_tmp($dir);

        $name = 'admin-' . $now->format('Ymd-His') . '.sqlite';
        $final = admin_assert_writable_path($dir . '/' . $name);
        if (file_exists($final)) {
            throw new RuntimeException('同じ名前のバックアップが既にあります（' . ADMIN_BACKUP_DIR . '/' . $name . '）');
        }
        $tmp = admin_assert_writable_path($dir . '/.tmp-' . $name . '-' . bin2hex(random_bytes(4)));

        $method = admin_backup_write($tmp);
        admin_backup_verify($tmp);
        if (!@rename($tmp, $final)) {
            throw new RuntimeException('バックアップの確定（名前の変更）に失敗しました');
        }
        admin_backup_remove_tmp($tmp);
        $tmp = null;
        @chmod($final, 0600);
        clearstatcache(true, $final);
        $size = (int) filesize($final);
        $deleted = admin_backup_prune($dir);

        admin_set_setting('backup_last_success_at', admin_now());
        admin_set_setting('backup_last_file', $name);
        admin_set_setting('backup_last_size', (string) $size);
        admin_delete_setting('backup_last_error');
        admin_health_save('backup', ...admin_health_check_backup());

        return 'バックアップ作成：' . $name . '（' . admin_backup_format_size($size) . '・' . $method . '）'
            . ($deleted > 0 ? '、古い世代を' . $deleted . '個削除' : '');
    } catch (Throwable $e) {
        if ($tmp !== null) {
            try {
                admin_backup_remove_tmp($tmp);
            } catch (Throwable $ignored) {
                // 片付けの失敗は元の失敗理由を優先する
            }
        }
        $reason = admin_backup_sanitize($e->getMessage());
        try {
            admin_set_setting('backup_last_error', admin_now() . ' ' . $reason);
            admin_health_save('backup', ...admin_health_check_backup());
        } catch (Throwable $ignored) {
            // DB自体に書けない場合は、例外の通知だけを頼りにする
        }
        throw new RuntimeException('バックアップに失敗しました：' . $reason, 0, $e);
    }
}

function admin_backup_format_size(int $bytes): string
{
    if ($bytes >= 1024 * 1024) {
        return number_format($bytes / 1024 / 1024, 1) . ' MB';
    }
    return number_format($bytes / 1024, 1) . ' KB';
}

/**
 * サイトヘルスの「バックアップ」行。戻り値：[status, message, detail]
 * 🟢 最終成功が26時間以内 / 🟡 26〜50時間 / 🔴 50時間超、または実行されたのに一度も成功していない。
 * ジョブがまだ一度も動いていないとき（公開直後）は🟡「まだ実行されていません」。
 */
function admin_health_check_backup(?DateTimeImmutable $now = null): array
{
    $now ??= new DateTimeImmutable('now');
    $last = admin_setting('backup_last_success_at');
    $error = admin_setting('backup_last_error');
    $files = admin_backup_files();
    $detailLines = [];
    if ($files !== []) {
        $latest = end($files);
        $latestSize = @filesize(admin_data_path(ADMIN_BACKUP_DIR . '/' . $latest));
        $detailLines[] = '最新：' . $latest . (is_int($latestSize) ? '（' . admin_backup_format_size($latestSize) . '）' : '');
    }
    $detailLines[] = '保存先：_admin-data/' . ADMIN_BACKUP_DIR . '/（' . ADMIN_BACKUP_KEEP . '世代まで保持・毎日' . ADMIN_JOBS['backup']['hour'] . '時）';
    if ($error !== null) {
        $detailLines[] = '直近の失敗：' . $error;
    }
    $detail = implode("\n", $detailLines);

    if ($last === null) {
        $job = admin_job_state('backup');
        if ($job === null || $job['last_started_at'] === null) {
            return ['yellow', 'まだ実行されていません（毎日' . ADMIN_JOBS['backup']['hour'] . '時に自動で作成します）', $detail];
        }
        return ['red', 'バックアップが一度も成功していません', $detail];
    }

    $hours = ($now->getTimestamp() - (new DateTimeImmutable($last))->getTimestamp()) / 3600;
    $size = admin_setting('backup_last_size');
    $message = '最終成功 ' . (new DateTimeImmutable($last))->setTimezone(new DateTimeZone(admin_config()['timezone']))->format('Y-m-d H:i')
        . '・' . count($files) . '世代'
        . ($size !== null ? '・最新 ' . admin_backup_format_size((int) $size) : '');
    if ($hours <= ADMIN_BACKUP_GREEN_HOURS) {
        return ['green', $message, $detail];
    }
    if ($hours <= ADMIN_BACKUP_YELLOW_HOURS) {
        return ['yellow', $message . '（' . ADMIN_BACKUP_GREEN_HOURS . '時間以上たっています）', $detail];
    }
    return ['red', $message . '（' . ADMIN_BACKUP_YELLOW_HOURS . '時間以上バックアップできていません）', $detail];
}
