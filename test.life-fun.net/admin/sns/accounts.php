<?php
declare(strict_types=1);

// 設定 → SNS連携。Threads はアプリ設定・連携（OAuth）・解除・トークン更新（ADMIN_IMPL_PLAN.md 14節）。
// note は常に手動投稿。ここでは note のID（投稿URLを RSS から自動で拾うため。note.php）を設定する。
// トークン・アプリシークレットは画面に出さない（保存済みかどうかだけ表示）。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    try {
        switch ($action) {
            case 'save_app':
                $detail = admin_threads_save_app((string) ($_POST['app_id'] ?? ''), (string) ($_POST['app_secret'] ?? ''));
                admin_audit('threads_app_settings', 'threads', $detail);
                admin_flash_redirect('ok', 'アプリ設定を保存しました（' . $detail . '）。', '/sns/accounts');
            case 'connect':
                $url = admin_threads_begin_auth();
                admin_audit('threads_auth_start', 'threads');
                // 認可画面（threads.com）へ。戻り先は admin/sns/threads-callback
                header('Location: ' . $url, true, 303);
                exit;
            case 'disconnect':
                admin_threads_disconnect();
                admin_audit('threads_disconnect', 'threads');
                admin_flash_redirect('ok', '連携を解除しました（管理画面からトークンを消しました）。Threads側の許可も取り消す場合は、下の手順を行ってください。', '/sns/accounts');
            case 'save_note':
                $noteId = trim((string) ($_POST['note_user_id'] ?? ''));
                if ($noteId !== '' && preg_match(ADMIN_NOTE_ID_PATTERN, $noteId) !== 1) {
                    admin_flash_redirect('error', 'noteのIDは、半角英数字と _ で入力してください（https://note.com/〇〇 の〇〇の部分）。', '/sns/accounts');
                }
                admin_set_setting('note_user_id', $noteId);
                admin_set_setting('note_rss_error', '');
                admin_audit('note_settings', 'note', $noteId === '' ? '使わない' : $noteId);
                admin_flash_redirect('ok', $noteId === '' ? 'noteのIDを空にしました（noteの目標は「準備中」になります）。' : 'noteのIDを保存しました。次の毎時の確認から、投稿URLを自動で拾います。', '/sns/accounts');
            case 'refresh':
                $result = admin_threads_refresh(new DateTimeImmutable('now'), true);
                admin_audit('threads_token_refresh', 'threads', $result['message']);
                admin_flash_redirect($result['ok'] ? 'ok' : 'error', $result['message'], '/sns/accounts');
        }
    } catch (RuntimeException $e) {
        admin_flash_redirect('error', admin_threads_redact($e->getMessage()), '/sns/accounts');
    }
    admin_flash_redirect('error', '不明な操作です。', '/sns/accounts');
}

$account = admin_threads_account();
$connected = $account['status'] === 'connected';
$limit = $connected ? admin_threads_publishing_limit() : null;
$unconfirmed = admin_threads_unconfirmed_sending_count();
// 連携すると自動投稿になる予約中の枠（Threads 宛の予約中・保留）
$pending = admin_db()->query(
    "SELECT q.*, s.title FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
     WHERE q.platform = 'threads' AND q.status IN ('scheduled', 'held') ORDER BY q.scheduled_at, q.id"
)->fetchAll();

// 「Threadsと連携する」は POST の後に threads.com へ移動する。CSP の form-action で止められないよう、この画面だけ threads.com を許可する
header("Content-Security-Policy: default-src 'self'; style-src 'self'; script-src 'self'; img-src 'self' data:; frame-ancestors 'none'; form-action 'self' https://threads.com https://www.threads.com; base-uri 'none'");

admin_render_header('SNS連携', 'sns_accounts');
admin_render_flash();
?>
<section class="panel panel--wide">
  <h2 class="panel__title">Threads（自動投稿）</h2>
<?php if ($unconfirmed > 0): ?>
  <p class="alert alert--error">公開確認待ちの投稿が<?= $unconfirmed ?>件あります（連携し直すと自動で確認します）。</p>
<?php endif; ?>
  <div class="table-wrap">
    <table class="table">
      <tbody>
        <tr><th>状態</th><td><?= $connected ? '🟢 ' : ($account['status'] === 'error' ? '🔴 ' : '') ?><?= h(ADMIN_THREADS_ACCOUNT_STATUS_LABELS[$account['status']] ?? $account['status']) ?></td></tr>
        <tr><th>アカウント</th><td><?= $account['account_name'] !== null ? '@' . h($account['account_name']) : '—' ?>（連携できるのは @<?= h(admin_config()['threads_username']) ?> だけです）</td></tr>
        <tr><th>トークンの期限</th><td><?= h(admin_format_time($account['token_expires_at'])) ?></td></tr>
        <tr><th>最終更新</th><td><?= h(admin_format_time($account['token_issued_at'])) ?>（毎日3時、前回から<?= ADMIN_THREADS_REFRESH_AFTER_DAYS ?>日たっていれば自動で更新）</td></tr>
        <tr><th>連携した日時</th><td><?= h(admin_format_time($account['connected_at'])) ?></td></tr>
        <tr><th>今日の投稿数</th><td><?= $limit !== null ? (int) $limit['usage'] . ' / ' . (int) $limit['total'] . '（24時間）' : ($connected ? '取得できませんでした' : '—') ?></td></tr>
        <tr><th>最後のエラー</th><td><?= h($account['last_error'] ?? '—') ?></td></tr>
      </tbody>
    </table>
  </div>

  <div class="form--inline">
    <?php if ($account['app_id'] !== null && $account['app_secret_encrypted'] !== null): ?>
      <form method="post" action="<?= h(admin_url('/sns/accounts')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="connect"><button type="submit" class="btn btn--primary"><?= $account['status'] === 'disconnected' ? 'Threadsと連携する' : 'Threadsと連携し直す' ?></button></form>
    <?php endif; ?>
    <?php if ($connected): ?>
      <form method="post" action="<?= h(admin_url('/sns/accounts')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="refresh"><button type="submit" class="btn btn--ghost">今すぐトークン更新</button></form>
    <?php endif; ?>
    <?php if ($account['status'] !== 'disconnected'): ?>
      <form method="post" action="<?= h(admin_url('/sns/accounts')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="disconnect"><button type="submit" class="btn btn--ghost" data-confirm="Threadsとの連携を解除しますか？（解除すると、投稿時刻が来た Threads の枠はスキップされます）">連携を解除</button></form>
    <?php endif; ?>
  </div>
  <p class="muted">「連携する」を押すと Threads の許可画面が開きます。@<?= h(admin_config()['threads_username']) ?> でログインして「許可」を押し、表示される「管理画面に戻る」を押してください。トークンは暗号化して保存し、画面には表示しません。</p>

<?php if (!$connected): ?>
  <h3 class="panel__subtitle">連携すると自動投稿になる予約中の枠（<?= count($pending) ?>件）</h3>
  <?php if ($pending === []): ?>
    <p class="muted">ありません。</p>
  <?php else: ?>
    <p class="muted">連携すると、下の枠は投稿時刻に Threads へ自動で投稿されます。投稿したくない枠は、連携する前に取り消してください。</p>
    <div class="table-wrap">
      <table class="table">
        <thead><tr><th>投稿日時</th><th>タイトル</th><th>状態</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($pending as $p): ?>
          <tr>
            <td class="nowrap"><?= h(admin_format_time($p['scheduled_at'])) ?></td>
            <td><a href="<?= h(admin_url('/sns/stock-edit?id=' . $p['stock_id'])) ?>"><?= h($p['title']) ?></a></td>
            <td class="nowrap"><?= h(ADMIN_QUEUE_STATUS_LABELS[$p['status']] ?? $p['status']) ?></td>
            <td><form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="cancel"><input type="hidden" name="date" value="<?= h($p['slot_date']) ?>"><button type="submit" class="btn btn--ghost" data-confirm="<?= h(admin_date_label($p['slot_date'])) ?>の投稿を取り消しますか？（自動では埋め直しません）">取消</button></form></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
<?php endif; ?>

  <h3 class="panel__subtitle">アプリ設定（Meta for Developers の「Threads APIにアクセス」→「設定」）</h3>
  <form method="post" action="<?= h(admin_url('/sns/accounts')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_app">
    <label class="form__label" for="app_id">Threads アプリID</label>
    <input class="form__input" id="app_id" name="app_id" inputmode="numeric" autocomplete="off" value="<?= h((string) ($account['app_id'] ?? '')) ?>" required>
    <label class="form__label" for="app_secret">Threads アプリシークレット<?= $account['app_secret_encrypted'] !== null ? '（保存済み。変えるときだけ入力）' : '' ?></label>
    <input class="form__input" id="app_secret" name="app_secret" type="password" autocomplete="new-password" value=""<?= $account['app_secret_encrypted'] === null ? ' required' : '' ?>>
    <p class="muted">アプリの「有効なOAuthリダイレクトURI」には次のURLを入れてください：<br><code><?= h(admin_threads_redirect_uri()) ?></code></p>
    <button type="submit" class="btn btn--ghost">保存</button>
  </form>

  <h3 class="panel__subtitle">Threads 側の許可も取り消すとき</h3>
  <p class="muted">「連携を解除」は管理画面からトークンを消すだけです。Threads 側の許可も取り消すときは、Threads で @<?= h(admin_config()['threads_username']) ?> にログインし、「設定 → アカウント → ウェブサイトのアクセス許可」からこのアプリを削除してください（画面の項目名は変わることがあります）。</p>
</section>

<?php $noteId = admin_note_user_id(); $noteChecked = admin_setting('note_rss_checked_at'); $noteError = (string) admin_setting('note_rss_error'); ?>
<section class="panel panel--wide">
  <h2 class="panel__title">note（手動投稿）</h2>
  <p class="muted">noteには公式の投稿APIが無いため、投稿は手動です。「今日」画面で本文をコピーして投稿し、投稿URLを貼ってください。IDを入れておくと、noteの更新情報（RSS）から1時間ごとに投稿URLを自動で拾います。</p>
  <p>状態：
<?php if ($noteId === null): ?>
    IDが未設定（noteの目標は「準備中」）
<?php elseif ($noteError !== ''): ?>
    <span class="status status--error">更新情報を読めませんでした（<?= h($noteError) ?>）</span>
<?php else: ?>
    <a href="<?= h((string) admin_note_profile_url()) ?>" rel="noopener noreferrer" target="_blank">@<?= h($noteId) ?></a>　最後に確認：<?= h($noteChecked === null ? 'まだ（次の毎時の確認で取得します）' : admin_format_time($noteChecked)) ?>
<?php endif; ?>
  </p>
  <form method="post" action="<?= h(admin_url('/sns/accounts')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_note">
    <label class="form__label" for="note_user_id">noteのID（https://note.com/〇〇 の〇〇）</label>
    <input class="form__input form__input--narrow" type="text" id="note_user_id" name="note_user_id" value="<?= h($noteId ?? '') ?>" pattern="[A-Za-z0-9_]{1,50}" autocomplete="off">
    <p class="muted">空にして保存すると、noteを使わない設定になります（目標は記事とSNSの2つで数えます）。</p>
    <button type="submit" class="btn btn--primary">noteのIDを保存</button>
  </form>
</section>
<?php
admin_render_footer();
