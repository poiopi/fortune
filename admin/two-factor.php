<?php
declare(strict_types=1);

// 2段階認証の設定（メニューでは「設定」→「ログインと2段階認証」の配下）。
// 未設定：有効にする → QRコード読み取り → 6桁コードで確認 → 予備コードを1回だけ表示。
// 有効：状態の表示、予備コードの再発行・再設定（新しい鍵）・無効化。いずれも現在のパスワード＋現在のコード（または予備コード）が必要。
// POST は処理後に同じ画面へリダイレクトし、結果はセッションの flash で1回だけ表示する。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';
require_once __DIR__ . '/../_admin-lib/qr.php';

admin_require_login();

function two_factor_flash(string $type, string $text): never
{
    admin_flash_redirect($type, $text, '/two-factor');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    $enabled = admin_2fa_enabled();

    if ($action === 'start') {
        if ($enabled) {
            two_factor_flash('error', '2段階認証はすでに有効です。');
        }
        admin_2fa_setup_begin('enable');
        admin_redirect('/two-factor');
    }

    if ($action === 'confirm') {
        $result = admin_2fa_setup_confirm((string) ($_POST['code'] ?? ''));
        if ($result === 'ok') {
            admin_redirect('/two-factor');
        }
        if ($result === 'expired') {
            two_factor_flash('error', '設定の有効期限（10分）が切れました。もう一度最初からやり直してください。');
        }
        two_factor_flash('error', 'コードが違います。認証アプリに表示されている6桁の数字を入力してください（スマホの時刻がずれていると合わないことがあります）。');
    }

    if ($action === 'cancel') {
        admin_2fa_setup_cancel();
        two_factor_flash('ok', '設定を取りやめました。' . ($enabled ? '今までの設定がそのまま使われます。' : ''));
    }

    if (in_array($action, ['regenerate', 'reset_start', 'disable'], true)) {
        if (!$enabled) {
            two_factor_flash('error', '2段階認証が有効になっていません。');
        }
        $check = admin_2fa_manage_check((string) ($_POST['current_password'] ?? ''), (string) ($_POST['code'] ?? ''), $action);
        if ($check !== 'ok') {
            two_factor_flash('error', match ($check) {
                'locked'         => '失敗が続いたため、しばらくこの操作はできません。15分ほど待ってからお試しください。',
                'wrong_password' => '現在のパスワードが違います。',
                default          => 'コードが違います。認証アプリの6桁の数字、または未使用の予備コードを入力してください。',
            });
        }

        if ($action === 'regenerate') {
            $_SESSION['admin_2fa_show_codes'] = admin_2fa_regenerate_backup_codes();
            admin_audit('2fa_backup_regenerated');
            admin_redirect('/two-factor');
        }
        if ($action === 'reset_start') {
            admin_2fa_setup_begin('reset');
            admin_redirect('/two-factor');
        }
        admin_2fa_disable();
        admin_audit('2fa_disabled');
        two_factor_flash('ok', '2段階認証を無効にしました。');
    }

    two_factor_flash('error', '不明な操作です。');
}

$shownCodes = admin_2fa_take_shown_codes();
$setup = $shownCodes === null ? admin_2fa_setup_current() : null;
$enabled = admin_2fa_enabled();
$config = admin_config();

admin_render_header('2段階認証', 'security');
admin_render_flash();
?>
<p><a href="<?= h(admin_url('/security')) ?>">「ログインと2段階認証」に戻る</a></p>

<?php if ($shownCodes !== null): ?>
<section class="panel panel--wide">
  <h2 class="panel__title">予備コード</h2>
  <p class="alert alert--warn">この予備コードは、この画面でだけ表示されます。あとから見ることはできません。今すぐ控えてください。</p>
  <p class="muted">スマホを失くすなどして認証アプリが使えないとき、6桁のコードの代わりに入力します。1つにつき1回だけ使えます。パスワードとは別の場所（紙に書く、パスワード管理アプリに保存する等）に保管してください。</p>
  <textarea id="backup-codes" class="backup-codes" rows="<?= count($shownCodes) ?>" readonly><?= h(implode("\n", $shownCodes)) ?></textarea>
  <div class="form--inline">
    <button type="button" class="btn btn--ghost" data-copy-target="backup-codes">コピー</button>
    <a class="btn btn--primary" href="<?= h(admin_url('/two-factor')) ?>">控えたら次へ</a>
  </div>
</section>

<?php elseif ($setup !== null): ?>
<?php $secret = (string) $setup['secret']; ?>
<section class="panel panel--wide">
  <h2 class="panel__title"><?= $setup['mode'] === 'reset' ? '新しい鍵で設定し直す' : '2段階認証を有効にする' ?></h2>
  <ol class="steps">
    <li>スマホの認証アプリ（Google Authenticator、Microsoft Authenticator など）で、下のQRコードを読み取ります。</li>
    <li>アプリに「<?= h($config['totp_issuer']) ?>」が追加され、6桁の数字が表示されます。</li>
    <li>その6桁の数字を下に入力して「確認して有効にする」を押します。</li>
  </ol>
  <?= admin_qr_svg(admin_totp_uri($secret), '認証アプリに読み取らせるQRコード') ?>
  <p class="muted">QRコードを読み取れないときは、アプリで「キーを入力」を選び、次のキーを入力してください（種類：時間ベース）。</p>
  <p class="secret-key"><?= h(admin_totp_format_secret($secret)) ?></p>
  <p class="muted">アプリでの表示名：<?= h($config['totp_issuer']) ?>（<?= h($config['totp_account']) ?>）。この画面は10分で無効になります（その場合は最初からやり直してください）。<?= $setup['mode'] === 'reset' ? '確認が済むまでは、今までの設定がそのまま使われます。' : '' ?></p>
  <form method="post" action="<?= h(admin_url('/two-factor')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="confirm">
    <label class="form__label" for="code">認証アプリの6桁の数字</label>
    <input class="form__input" type="text" id="code" name="code" inputmode="numeric" autocomplete="one-time-code" maxlength="10" required autofocus>
    <button type="submit" class="btn btn--primary">確認して有効にする</button>
  </form>
  <form method="post" action="<?= h(admin_url('/two-factor')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="cancel">
    <button type="submit" class="btn btn--ghost">やめる</button>
  </form>
</section>

<?php elseif (!$enabled): ?>
<section class="panel panel--wide">
  <h2 class="panel__title">状態：未設定</h2>
  <p class="alert alert--warn">2段階認証が未設定です。今はパスワードだけでログインできます。</p>
  <p>2段階認証を有効にすると、ログインのときにパスワードに加えて、スマホの認証アプリに表示される6桁の数字が必要になります。パスワードが漏れても、スマホが無ければ第三者はログインできません。</p>
  <p class="muted">用意するもの：認証アプリ（Google Authenticator、Microsoft Authenticator など）を入れたスマホ。設定の最後に、スマホを失くしたとき用の予備コードが10個表示されます。</p>
  <form method="post" action="<?= h(admin_url('/two-factor')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="start">
    <button type="submit" class="btn btn--primary">2段階認証を有効にする</button>
  </form>
</section>

<?php else: ?>
<?php $remaining = admin_2fa_backup_remaining(); ?>
<section class="panel panel--wide">
  <h2 class="panel__title">状態：有効</h2>
  <ul class="kv">
    <li>有効にした日時：<?= h(admin_format_time(admin_2fa_enabled_at())) ?></li>
    <li>予備コードの残り：<?= $remaining ?> 個（全<?= ADMIN_2FA_BACKUP_COUNT ?>個）</li>
  </ul>
<?php if ($remaining <= 3): ?>
  <p class="alert alert--warn">予備コードの残りが少なくなっています。下の「予備コードを再発行」で作り直してください。</p>
<?php endif; ?>
  <p class="muted">以下の操作には、現在のパスワードと、認証アプリの6桁の数字（または未使用の予備コード）が必要です。</p>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">予備コードを再発行</h2>
  <p class="muted">新しい予備コードを10個作ります。今までの予備コードは、使っていないものも含めてすべて使えなくなります。</p>
  <form method="post" action="<?= h(admin_url('/two-factor')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="regenerate">
    <label class="form__label" for="regenerate_password">現在のパスワード</label>
    <input class="form__input" type="password" id="regenerate_password" name="current_password" autocomplete="current-password" required>
    <label class="form__label" for="regenerate_code">6桁の数字または予備コード</label>
    <input class="form__input" type="text" id="regenerate_code" name="code" autocomplete="one-time-code" maxlength="20" required>
    <button type="submit" class="btn btn--primary">予備コードを再発行</button>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">再設定（新しい鍵）</h2>
  <p class="muted">スマホを機種変更したとき、またはQRコードを他人に見られたおそれがあるときに使います。新しいQRコードを読み取り、確認が済んだ時点で今までの鍵と予備コードは使えなくなります（予備コードも新しく作り直します）。</p>
  <form method="post" action="<?= h(admin_url('/two-factor')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="reset_start">
    <label class="form__label" for="reset_password">現在のパスワード</label>
    <input class="form__input" type="password" id="reset_password" name="current_password" autocomplete="current-password" required>
    <label class="form__label" for="reset_code">6桁の数字または予備コード</label>
    <input class="form__input" type="text" id="reset_code" name="code" autocomplete="one-time-code" maxlength="20" required>
    <button type="submit" class="btn btn--primary">新しい鍵で設定し直す</button>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">2段階認証を無効にする</h2>
  <p class="muted">無効にすると、パスワードだけでログインできる状態に戻ります。鍵と予備コードは削除されます。</p>
  <form method="post" action="<?= h(admin_url('/two-factor')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="disable">
    <label class="form__label" for="disable_password">現在のパスワード</label>
    <input class="form__input" type="password" id="disable_password" name="current_password" autocomplete="current-password" required>
    <label class="form__label" for="disable_code">6桁の数字または予備コード</label>
    <input class="form__input" type="text" id="disable_code" name="code" autocomplete="one-time-code" maxlength="20" required>
    <button type="submit" class="btn btn--ghost" data-confirm="2段階認証を無効にします。パスワードだけでログインできる状態に戻りますが、よろしいですか？">2段階認証を無効にする</button>
  </form>
</section>
<?php endif; ?>
<?php
admin_render_footer();
