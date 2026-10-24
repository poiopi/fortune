<?php
declare(strict_types=1);

/**
 * _admin-lib/monitor.php
 *
 * 公開ページのJSエラー監視と、姓名判断の未登録字の記録（ADMIN_IMPL_PLAN.md 10章 A）。
 * 受け口は api/client-error.php。送り元は inc/footer.php の小さなスクリプト（window.lfReport）。
 *  - 自サイトのファイルで起きたエラーだけ記録する。URLはパスだけ残し、クエリ（入力内容が入りうる）は捨てる
 *  - 同じエラーは1行にまとめて回数を数える
 *  - 通知は受付時ではなく毎分cronがまとめて送る（公開ページの応答を遅くしないため）
 */

const ADMIN_MONITOR_MAX_BODY = 4096;
/** 同じIPから10分で受け付ける件数 */
const ADMIN_MONITOR_RATE_LIMIT = 30;
/** 1時間に新しく登録するエラーの種類の上限（いたずらでDBや通知があふれないように） */
const ADMIN_MONITOR_NEW_PER_HOUR = 50;
const ADMIN_MONITOR_PAGES_PER_ERROR = 20;
const ADMIN_MONITOR_HOSTS = ['life-fun.net', 'www.life-fun.net', 'test.life-fun.net'];

const ADMIN_ERROR_STATUS_LABELS = [
    'open'     => '未対応',
    'resolved' => '対応済',
    'ignored'  => '無視',
];
const ADMIN_UNKNOWN_KANJI_STATUS_LABELS = [
    'open'    => '未確認',
    'added'   => '追加済み',
    'ignored' => '対象外',
];

/** 自サイトのURLならパスだけ（クエリ・#以降なし）を返す。他サイトなら null。空文字は空文字 */
function admin_monitor_clean_url(string $url): ?string
{
    $url = trim($url);
    if ($url === '') {
        return '';
    }
    $parts = parse_url($url);
    if ($parts === false) {
        return null;
    }
    if (isset($parts['host']) && !in_array(strtolower($parts['host']), ADMIN_MONITOR_HOSTS, true)) {
        return null;
    }
    if (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true)) {
        return null;
    }
    $path = (string) ($parts['path'] ?? '/');
    return mb_substr($path !== '' ? $path : '/', 0, 300);
}

/** スタックトレースからクエリ文字列を取り除き、長さを制限する */
function admin_monitor_clean_stack(string $stack): string
{
    $stack = preg_replace('#https?://[^/\s()]+#', '', $stack) ?? '';
    $stack = preg_replace('#\?[^\s():]*#', '', $stack) ?? '';
    return mb_substr(trim($stack), 0, 1500);
}

/** 回数制限。超えていたら false */
function admin_monitor_rate_ok(): bool
{
    $ipHash = hash('sha256', admin_client_ip() . '|' . admin_config()['env']);
    $window = intdiv(time(), 600);
    admin_db()->prepare(
        'INSERT INTO client_log_rate (ip_hash, win, count) VALUES (?, ?, 1)
         ON CONFLICT(ip_hash, win) DO UPDATE SET count = count + 1'
    )->execute([$ipHash, $window]);
    $stmt = admin_db()->prepare('SELECT count FROM client_log_rate WHERE ip_hash = ? AND win = ?');
    $stmt->execute([$ipHash, $window]);
    return (int) $stmt->fetchColumn() <= ADMIN_MONITOR_RATE_LIMIT;
}

/** 受け口の本体。不正な内容は黙って捨てる（送り元に理由は返さない） */
function admin_monitor_receive(string $raw): void
{
    if ($raw === '' || strlen($raw) > ADMIN_MONITOR_MAX_BODY) {
        return;
    }
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        return;
    }
    $page = admin_monitor_clean_url(is_string($data['p'] ?? null) ? $data['p'] : '');
    if ($page === null || $page === '') {
        return;
    }
    $type = $data['t'] ?? '';
    if (!in_array($type, ['error', 'rejection', 'kanji'], true)) {
        return;
    }
    if (!admin_monitor_rate_ok()) {
        return;
    }
    if ($type === 'kanji') {
        admin_monitor_record_kanji(is_string($data['m'] ?? null) ? $data['m'] : '');
        return;
    }

    $message = mb_substr(trim(is_string($data['m'] ?? null) ? $data['m'] : ''), 0, 300);
    if ($message === '' || $message === 'Script error.') {
        return;
    }
    $source = admin_monitor_clean_url(is_string($data['s'] ?? null) ? $data['s'] : '');
    if ($source === null) {
        return;
    }
    admin_monitor_record_error([
        'kind'    => $type,
        'message' => $message,
        'source'  => $source !== '' ? $source : $page,
        'line'    => max(0, (int) ($data['l'] ?? 0)),
        'col'     => max(0, (int) ($data['c'] ?? 0)),
        'stack'   => admin_monitor_clean_stack(is_string($data['st'] ?? null) ? $data['st'] : ''),
        'page'    => $page,
        'ua'      => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 250),
    ]);
}

function admin_monitor_record_error(array $e): void
{
    $db = admin_db();
    $now = admin_now();
    $fingerprint = hash('sha256', implode("\n", [$e['kind'], $e['message'], $e['source'], $e['line']]));

    $db->exec('BEGIN IMMEDIATE');
    try {
        $stmt = $db->prepare('SELECT id, status FROM client_errors WHERE fingerprint = ?');
        $stmt->execute([$fingerprint]);
        $row = $stmt->fetch();
        if ($row !== false) {
            $id = (int) $row['id'];
            // 対応済のエラーが再発したら未対応に戻し、もう一度通知する
            $reopen = $row['status'] === 'resolved';
            $db->prepare(
                "UPDATE client_errors SET count = count + 1, last_seen = ?, ua = ?, stack = CASE WHEN ? <> '' THEN ? ELSE stack END"
                . ($reopen ? ", status = 'open', notified = 0" : '') . ' WHERE id = ?'
            )->execute([$now, $e['ua'], $e['stack'], $e['stack'], $id]);
        } else {
            $since = (new DateTimeImmutable('-1 hour'))->format(DATE_ATOM);
            $recent = $db->prepare('SELECT COUNT(*) FROM client_errors WHERE first_seen > ?');
            $recent->execute([$since]);
            if ((int) $recent->fetchColumn() >= ADMIN_MONITOR_NEW_PER_HOUR) {
                $db->exec('COMMIT');
                return;
            }
            $db->prepare(
                'INSERT INTO client_errors (fingerprint, kind, message, source, line, col, stack, ua, first_seen, last_seen)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
            )->execute([$fingerprint, $e['kind'], $e['message'], $e['source'], $e['line'], $e['col'], $e['stack'] !== '' ? $e['stack'] : null, $e['ua'], $now, $now]);
            $id = (int) $db->lastInsertId();
        }

        $pages = $db->prepare('SELECT COUNT(*) FROM client_error_pages WHERE error_id = ?');
        $pages->execute([$id]);
        $known = $db->prepare('SELECT 1 FROM client_error_pages WHERE error_id = ? AND page = ?');
        $known->execute([$id, $e['page']]);
        if ($known->fetchColumn() !== false) {
            $db->prepare('UPDATE client_error_pages SET count = count + 1 WHERE error_id = ? AND page = ?')->execute([$id, $e['page']]);
        } elseif ((int) $pages->fetchColumn() < ADMIN_MONITOR_PAGES_PER_ERROR) {
            $db->prepare('INSERT INTO client_error_pages (error_id, page) VALUES (?, ?)')->execute([$id, $e['page']]);
        }
        $db->exec('COMMIT');
    } catch (Throwable $ex) {
        $db->exec('ROLLBACK');
        throw $ex;
    }
}

/** 漢字1字だけ受け付ける（々 も Unicode では漢字の扱い） */
function admin_monitor_record_kanji(string $ch): void
{
    if (mb_strlen($ch) !== 1 || preg_match('/^\p{Han}$/u', $ch) !== 1) {
        return;
    }
    $now = admin_now();
    admin_db()->prepare(
        'INSERT INTO unknown_kanji (ch, first_seen, last_seen) VALUES (?, ?, ?)
         ON CONFLICT(ch) DO UPDATE SET count = count + 1, last_seen = excluded.last_seen'
    )->execute([$ch, $now, $now]);
}

/** 毎分：まだ通知していない未対応エラーをまとめて1通で知らせる */
function admin_monitor_notify_new(): string
{
    $rows = admin_db()->query(
        "SELECT id, message, source, line, count FROM client_errors WHERE status = 'open' AND notified = 0 ORDER BY id LIMIT 20"
    )->fetchAll();
    if ($rows === []) {
        return '';
    }
    $lines = array_map(
        static fn (array $r): string => '・' . mb_strimwidth($r['message'], 0, 120, '…') . '（' . $r['source'] . ($r['line'] > 0 ? ':' . $r['line'] : '') . '）',
        $rows
    );
    admin_notify('client_error_new', '公開ページで新しいJSエラーが見つかりました（' . count($rows) . '種類）。' . "\n"
        . implode("\n", $lines) . "\n" . admin_absolute_admin_url('/errors'));
    $ids = array_map('intval', array_column($rows, 'id'));
    admin_db()->exec('UPDATE client_errors SET notified = 1 WHERE id IN (' . implode(',', $ids) . ')');
    return 'JSエラーの通知 ' . count($rows) . '種類';
}

/** 回数制限の記録は1日で不要になる */
function admin_monitor_cleanup(): string
{
    $stmt = admin_db()->prepare('DELETE FROM client_log_rate WHERE win < ?');
    $stmt->execute([intdiv(time(), 600) - 144]);
    return 'client_log_rate ' . $stmt->rowCount() . '件';
}

/** その エラーが起きたページ（多い順） */
function admin_monitor_error_pages(int $errorId): array
{
    $stmt = admin_db()->prepare('SELECT page, count FROM client_error_pages WHERE error_id = ? ORDER BY count DESC, page');
    $stmt->execute([$errorId]);
    return $stmt->fetchAll();
}

/** UA から「iPhone / Safari」程度の短い表示 */
function admin_monitor_ua_label(?string $ua): string
{
    if ($ua === null || $ua === '') {
        return '—';
    }
    $os = match (true) {
        str_contains($ua, 'iPhone')  => 'iPhone',
        str_contains($ua, 'iPad')    => 'iPad',
        str_contains($ua, 'Android') => 'Android',
        str_contains($ua, 'Windows') => 'Windows',
        str_contains($ua, 'Mac OS')  => 'Mac',
        default                      => 'その他',
    };
    $browser = match (true) {
        str_contains($ua, 'Edg/')                                        => 'Edge',
        str_contains($ua, 'CriOS') || str_contains($ua, 'Chrome/')       => 'Chrome',
        str_contains($ua, 'FxiOS') || str_contains($ua, 'Firefox/')      => 'Firefox',
        str_contains($ua, 'Line/')                                       => 'LINE',
        str_contains($ua, 'Safari/')                                     => 'Safari',
        default                                                          => 'その他',
    };
    return $os . ' / ' . $browser;
}
