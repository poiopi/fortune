<?php
declare(strict_types=1);

// ログインの2段階目（2段階認証のコード入力）。パスワードが正しかった後、5分以内に入力する。
// 失敗はパスワードの失敗と合わせて数え、同じロック（同一IP 15分で5回 → 15分）にかける。
// 全IP合計で直近1時間に10回以上の誤りがあれば、全IPでコード入力を止める（値は config）。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

if (!admin_password_is_set()) {
    admin_redirect('/setup');
}
if (admin_is_logged_in()) {
    admin_redirect('/');
}
if (!admin_2fa_pending_valid()) {
    admin_redirect('/login?expired=1');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $result = admin_attempt_login_2fa((string) ($_POST['code'] ?? ''));
    if ($result === 'ok') {
        admin_redirect('/');
    }
    if ($result === 'expired') {
        admin_redirect('/login?expired=1');
    }
    $error = match ($result) {
        'locked'        => 'ログインの失敗が続いたため、しばらくログインできません。15分ほど待ってからお試しください。',
        'global_locked' => 'コードの誤りが続いているため、コードの入力を一時的に止めています。しばらく時間をおいてください。',
        default         => 'コードが違います。認証アプリに表示されている6桁の数字、または未使用の予備コードを入力してください。',
    };
}

admin_render_simple_header('2段階認証');
?>
<?php if ($error !== null): ?>
  <p class="alert alert--error"><?= h($error) ?></p>
<?php endif; ?>
<p>認証アプリ（「<?= h(admin_config()['totp_issuer']) ?>」）に表示されている6桁の数字を入力してください。</p>
<form method="post" action="<?= h(admin_url('/login-2fa')) ?>" class="form">
  <?= admin_csrf_field() ?>
  <label class="form__label" for="code">6桁の数字</label>
  <input class="form__input" type="text" id="code" name="code" autocomplete="one-time-code" maxlength="20" required autofocus>
  <button type="submit" class="btn btn--primary">ログイン</button>
</form>
<p class="muted">スマホが手元に無いときは、6桁の数字の代わりに予備コード（xxxxx-xxxxx の形）を入力できます。各予備コードは1回だけ使えます。</p>
<p class="muted">5分以内に入力してください。<a href="<?= h(admin_url('/login')) ?>">パスワードの入力からやり直す</a></p>
<?php
admin_render_simple_footer();
