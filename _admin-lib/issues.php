<?php
declare(strict_types=1);

/**
 * _admin-lib/issues.php
 *
 * 既知の不具合の一覧（ADMIN_IMPL_PLAN.md 10章 D）。
 * 重要度「高」で未完了のまま ADMIN_ISSUE_STALE_DAYS 日更新が無いものは、全画面の警告に出す。
 */

const ADMIN_ISSUE_STALE_DAYS = 7;

const ADMIN_ISSUE_SEVERITY_LABELS = [
    'high' => '高',
    'mid'  => '中',
    'low'  => '低',
];
const ADMIN_ISSUE_STATUS_LABELS = [
    'open'    => '未対応',
    'doing'   => '対応中',
    'done'    => '対応済',
    'wontfix' => '見送り',
];

function admin_issue_get(int $id): ?array
{
    $stmt = admin_db()->prepare('SELECT * FROM known_issues WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

/** 入力の検証。問題が無ければ空配列 */
function admin_issue_validate(array $in): array
{
    $errors = [];
    if (trim($in['title']) === '' || mb_strlen($in['title']) > 200) {
        $errors[] = 'タイトルは1〜200文字で入力してください';
    }
    if (!isset(ADMIN_ISSUE_SEVERITY_LABELS[$in['severity']])) {
        $errors[] = '重要度が正しくありません';
    }
    if (!isset(ADMIN_ISSUE_STATUS_LABELS[$in['status']])) {
        $errors[] = '状態が正しくありません';
    }
    if (mb_strlen($in['page']) > 300 || mb_strlen($in['memo']) > 5000) {
        $errors[] = 'ページは300文字、メモは5000文字までです';
    }
    return $errors;
}

/** 新規なら $id=0。戻り値：id */
function admin_issue_save(int $id, array $in, ?int $errorId = null): int
{
    $now = admin_now();
    $page = trim($in['page']) !== '' ? trim($in['page']) : null;
    $memo = trim($in['memo']) !== '' ? trim($in['memo']) : null;
    if ($id === 0) {
        admin_db()->prepare(
            'INSERT INTO known_issues (title, severity, status, page, memo, error_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        )->execute([trim($in['title']), $in['severity'], $in['status'], $page, $memo, $errorId, $now, $now]);
        return (int) admin_db()->lastInsertId();
    }
    admin_db()->prepare('UPDATE known_issues SET title = ?, severity = ?, status = ?, page = ?, memo = ?, updated_at = ? WHERE id = ?')
        ->execute([trim($in['title']), $in['severity'], $in['status'], $page, $memo, $now, $id]);
    return $id;
}

/** 重要度「高」で未完了のまま7日以上更新が無いもの */
function admin_issue_stale_count(): int
{
    $stmt = admin_db()->prepare("SELECT COUNT(*) FROM known_issues WHERE severity = 'high' AND status IN ('open', 'doing') AND updated_at < ?");
    $stmt->execute([(new DateTimeImmutable('-' . ADMIN_ISSUE_STALE_DAYS . ' days'))->format(DATE_ATOM)]);
    return (int) $stmt->fetchColumn();
}
