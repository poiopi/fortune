<?php
declare(strict_types=1);

// 初回パスワード設定。パスワードが未設定のときだけ動作し、設定後はログイン画面へ回す。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

if (admin_password_is_set()) {
    admin_redirect('/login');
}

admin_session_start();
$minLength = admin_config()['password_min_length'];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $password = (string) ($_POST['password'] ?? '');
    $confirm = (string) ($_POST['password_confirm'] ?? '');

    if (mb_strlen($password) < $minLength) {
        $error = "パスワードは{$minLength}文字以上にしてください。";
    } elseif ($password !== $confirm) {
        $error = '確認用のパスワードが一致しません。';
    } else {
        if (admin_set_initial_password($password)) {
            admin_audit('setup');
        }
        admin_redirect('/login?setup=1');
    }
}

admin_render_simple_header('初回パスワード設定');
?>
<p>管理画面のパスワードを設定します。この画面は最初の1回だけ使えます。</p>
<?php if ($error !== null): ?>
  <p class="alert alert--error"><?= h($error) ?></p>
<?php endif; ?>
<form method="post" action="<?= h(admin_url('/setup')) ?>" class="form">
  <?= admin_csrf_field() ?>
  <label class="form__label" for="password">パスワード（<?= (int) $minLength ?>文字以上）</label>
  <input class="form__input" type="password" id="password" name="password" autocomplete="new-password" required minlength="<?= (int) $minLength ?>">
  <label class="form__label" for="password_confirm">パスワード（確認）</label>
  <input class="form__input" type="password" id="password_confirm" name="password_confirm" autocomplete="new-password" required minlength="<?= (int) $minLength ?>">
  <button type="submit" class="btn btn--primary">設定する</button>
</form>
<?php
admin_render_simple_footer();
