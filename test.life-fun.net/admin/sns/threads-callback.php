<?php
declare(strict_types=1);

// Threads の許可画面から戻ってくる先（ADMIN_IMPL_PLAN.md 14-4）。URL：/admin/sns/threads-callback
// threads.com からの移動では SameSite=Strict のログインCookieが届かないため、ログイン状態は使わない（セッションも開始しない）。
// 本人の操作かどうかは、DBに保存した1回限りの state（10分で無効）で確かめる。
// 処理のあとは自動で移動せず、「管理画面に戻る」リンクを押してもらう（同じサイト内の移動なのでCookieが届く）。
// この画面にはトークンも認可コードも表示しない。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

// URLに認可コードが付いているため、この画面から読み込む CSS・JS やリンク先に Referer として送らない（既存の same-origin より厳しくする）
header('Referrer-Policy: no-referrer');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    admin_render_message('受け付けられません', 'この画面は Threads の許可画面から戻ってくるときにだけ使います。');
    exit;
}

$result = admin_threads_complete_auth($_GET);
if (!$result['ok']) {
    http_response_code(400);
}

admin_render_simple_header($result['title']);
?>
<p class="alert alert--<?= $result['ok'] ? 'ok' : 'error' ?>"><?= h($result['message']) ?></p>
<p><a class="btn btn--primary" href="<?= h(admin_url('/sns/accounts')) ?>">管理画面に戻る</a></p>
<?php
admin_render_simple_footer();
