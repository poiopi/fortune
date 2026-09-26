<?php
declare(strict_types=1);

/**
 * _admin-lib/audit.php
 *
 * 操作ログ（audit_logs）。1人運用でも「いつ・何をしたか」を残す。
 */

const ADMIN_AUDIT_LABELS = [
    'setup'         => '初回パスワード設定',
    'login'         => 'ログイン',
    'login_failed'  => 'ログイン失敗',
    'login_locked'  => 'ログインロック',
    'login_blocked' => 'ロック中のログイン試行',
    'logout'        => 'ログアウト',
    'timeout'       => '無操作による自動ログアウト',
    'csrf_rejected' => '不正な送信を拒否（CSRF）',
    'settings_notify'    => '通知設定の変更',
    'notify_test'        => '通知のテスト送信',
    'settings_post_mode' => '投稿モードの変更',
    'cron_probe_request' => 'cron実行時間テストの予約',
    'password_changed'   => 'パスワード変更',
    'password_change_failed' => 'パスワード変更の失敗',
    'stock_import'       => 'ストック取り込み（JSON）',
    'quiz_import'        => 'ストック取り込み（既存クイズ）',
    'stock_create'       => 'ストック作成',
    'stock_edit'         => 'ストック編集',
    'stock_approve'      => 'ストック承認',
    'stock_unapprove'    => 'ストック承認取消',
    'stock_archive'      => 'ストックのアーカイブ',
    'stock_restore'      => 'ストックのアーカイブ解除',
    'queue_replace'      => '投稿枠の差し替え',
    'queue_cancel'       => '投稿枠の取消',
    'queue_release'      => '投稿枠を外してストックに戻す',
    'queue_to_manual'    => '保留を手動投稿待ちに変更',
    'queue_mark_posted'  => '投稿済にする',
    'rotation_change'    => 'ローテーション変更',
];

function admin_client_ip(): string
{
    return (string) ($_SERVER['REMOTE_ADDR'] ?? 'cli');
}

function admin_audit(string $action, ?string $target = null, ?string $detail = null): void
{
    admin_db()->prepare('INSERT INTO audit_logs (at, action, target, detail, ip) VALUES (?, ?, ?, ?, ?)')
        ->execute([admin_now(), $action, $target, $detail, admin_client_ip()]);
}

function admin_audit_label(string $action): string
{
    return ADMIN_AUDIT_LABELS[$action] ?? $action;
}
