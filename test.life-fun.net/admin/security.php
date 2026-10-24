<?php
declare(strict_types=1);

// 設定 → ログインと2段階認証：前回のログイン・ログイン失敗の回数・2段階認証の状態（設定は /two-factor）・パスワード変更。
// 段階2でダッシュボード（ログイン情報）と設定画面（2段階認証・パスワード変更）から移した。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    if ((string) ($_POST['action'] ?? '') === 'change_password') {
        $result = admin_change_password(
            (string) ($_POST['current_password'] ?? ''),
            (string) ($_POST['new_password'] ?? ''),
            (string) ($_POST['new_password_confirm'] ?? '')
        );
        if ($result === 'ok') {
            admin_audit('password_changed');
            admin_flash_redirect('ok', 'パスワードを変更しました。', '/security');
        }
        admin_audit('password_change_failed', null, $result);
        $messages = [
            'wrong_current' => '現在のパスワードが違います。',
            'too_short'     => '新しいパスワードは' . admin_config()['password_min_length'] . '文字以上にしてください。',
            'mismatch'      => '新しいパスワード（確認）が一致しません。',
        ];
        admin_flash_redirect('error', $messages[$result], '/security');
    }
    admin_flash_redirect('error', '不明な操作です。', '/security');
}

$lastLogin = admin_db()->query(
    "SELECT at, ip FROM audit_logs WHERE action = 'login' ORDER BY id DESC LIMIT 1 OFFSET 1"
)->fetch() ?: null;
$failureStmt = admin_db()->prepare(
    "SELECT COUNT(*) FROM audit_logs WHERE action IN ('login_failed', 'login_blocked', '2fa_failed') AND at > ?"
);
$failureStmt->execute([(new DateTimeImmutable('-1 day'))->format(DATE_ATOM)]);
$recentFailures = (int) $failureStmt->fetchColumn();

admin_render_header('ログインと2段階認証', 'security');
admin_render_flash();
?>
<section class="panel panel--wide">
  <h2 class="panel__title">ログインの記録</h2>
  <p>前回のログイン：<?= $lastLogin !== null ? h(admin_format_time($lastLogin['at'])) . '（' . h($lastLogin['ip']) . '）' : '記録なし' ?></p>
  <p>直近24時間のログイン失敗：<?= $recentFailures ?> 件<?= $recentFailures > 0 ? '（<a href="' . h(admin_url('/logs')) . '">操作ログ</a>で確認できます）' : '' ?></p>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">2段階認証</h2>
<?php if (admin_2fa_enabled()): ?>
  <p>状態：有効（<?= h(admin_format_time(admin_2fa_enabled_at())) ?> から）　予備コードの残り：<?= admin_2fa_backup_remaining() ?> 個</p>
<?php else: ?>
  <p class="alert alert--warn">2段階認証が未設定です。今はパスワードだけでログインできます。</p>
<?php endif; ?>
  <p><a class="btn btn--<?= admin_2fa_enabled() ? 'ghost' : 'primary' ?>" href="<?= h(admin_url('/two-factor')) ?>"><?= admin_2fa_enabled() ? '2段階認証の設定を開く（予備コードの再発行・再設定・無効化）' : '2段階認証を設定する' ?></a></p>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">パスワード変更</h2>
  <form method="post" action="<?= h(admin_url('/security')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="change_password">
    <label class="form__label" for="current_password">現在のパスワード</label>
    <input class="form__input" type="password" id="current_password" name="current_password" autocomplete="current-password" required>
    <label class="form__label" for="new_password">新しいパスワード（<?= (int) admin_config()['password_min_length'] ?>文字以上）</label>
    <input class="form__input" type="password" id="new_password" name="new_password" autocomplete="new-password" required minlength="<?= (int) admin_config()['password_min_length'] ?>">
    <label class="form__label" for="new_password_confirm">新しいパスワード（確認）</label>
    <input class="form__input" type="password" id="new_password_confirm" name="new_password_confirm" autocomplete="new-password" required minlength="<?= (int) admin_config()['password_min_length'] ?>">
    <button type="submit" class="btn btn--primary">パスワードを変更</button>
  </form>
</section>
<?php
admin_render_footer();
