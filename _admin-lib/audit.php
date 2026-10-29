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
    'settings_digest'    => '朝のまとめ通知の設定変更',
    'note_settings'      => 'noteのIDの変更',
    'note_record'        => 'noteの投稿URLを記録',
    'note_link'          => 'RSSで見つけたnoteを今日の枠に結び付け',
    'today_flow_done'    => '今日の作業を最後まで進めた',
    'note_image_upload'  => 'noteの画像を保存',
    'note_image_delete'  => 'noteの画像を削除',
    'threads_image_upload' => 'Threadsの画像を保存',
    'threads_image_delete' => 'Threadsの画像を削除',
    'note_set_today'     => 'ストックを今日のnoteにした',
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
    'queue_post_now'     => '保留を今から投稿',
    'queue_mark_posted'  => '投稿済にする',
    'rotation_change'    => 'ローテーション変更',
    // Threads 自動投稿（トークン・シークレット・コードの値は記録しない）
    'threads_app_settings'   => 'Threadsアプリ設定の変更',
    'threads_auth_start'     => 'Threads連携の開始（許可画面へ）',
    'threads_connect'        => 'Threads連携',
    'threads_connect_failed' => 'Threads連携の失敗',
    'threads_disconnect'     => 'Threads連携の解除',
    'threads_token_refresh'  => 'Threadsトークンの手動更新',
    'queue_retry'            => '失敗した投稿の再試行',
    'queue_schedule_at'      => '日時を指定して予約',
    'threads_delete'         => 'Threadsから削除',
    'threads_delete_failed'  => 'Threadsから削除の失敗',
    'error_status'       => 'JSエラーの状態変更',
    'issue_create'       => '既知の不具合の登録',
    'issue_edit'         => '既知の不具合の編集',
    'kanji_add'          => '姓名判断の漢字を反映待ちに追加',
    'kanji_remove'       => '姓名判断の漢字を反映待ちから削除',
    'kanji_export'       => '姓名判断の画数表を出力',
    'unknown_kanji'      => '未登録の字の扱いを変更',
    'health_run'         => 'サイトヘルスの手動実行',
    'seo_run'            => 'SEO点検の予約',
    'seo_issue'          => 'SEO点検の問題の扱いを変更',
    // 2段階認証（コード・秘密鍵の値は記録しない）
    '2fa_pending'            => 'パスワード確認（2段階認証のコード待ち）',
    '2fa_failed'             => '2段階認証のコード誤り',
    '2fa_backup_login'       => '予備コードでのログイン',
    '2fa_enabled'            => '2段階認証の有効化',
    '2fa_disabled'           => '2段階認証の無効化',
    '2fa_reset'              => '2段階認証の再設定（新しい鍵）',
    '2fa_backup_regenerated' => '予備コードの再発行',
    '2fa_manage_failed'      => '2段階認証の操作の失敗',
    '2fa_file_reset'         => '2段階認証の解除（reset-2fa ファイル）',
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
