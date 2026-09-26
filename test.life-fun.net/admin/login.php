<?php
declare(strict_types=1);

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

if (!admin_password_is_set()) {
    admin_redirect('/setup');
}
if (admin_is_logged_in()) {
    admin_redirect('/');
}

$error = null;
$notice = isset($_GET['setup']) ? 'パスワードを設定しました。ログインしてください。' : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $result = admin_attempt_login((string) ($_POST['password'] ?? ''));
    if ($result === 'ok') {
        admin_redirect('/');
    }
    $error = $result === 'locked'
        ? 'ログインの失敗が続いたため、しばらくログインできません。15分ほど待ってからお試しください。'
        : 'パスワードが違います。';
    $notice = null;
}

admin_render_simple_header('ログイン');
?>
<?php if ($notice !== null): ?>
  <p class="alert alert--ok"><?= h($notice) ?></p>
<?php endif; ?>
<?php if ($error !== null): ?>
  <p class="alert alert--error"><?= h($error) ?></p>
<?php endif; ?>
<form method="post" action="<?= h(admin_url('/login')) ?>" class="form">
  <?= admin_csrf_field() ?>
  <label class="form__label" for="password">パスワード</label>
  <input class="form__input" type="password" id="password" name="password" autocomplete="current-password" required autofocus>
  <button type="submit" class="btn btn--primary">ログイン</button>
</form>
<?php
admin_render_simple_footer();
