<?php
declare(strict_types=1);

// ログアウトは POST＋CSRF のみ受け付ける（リンク1つで勝手にログアウトさせられないように）。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    admin_redirect('/');
}

admin_verify_csrf();
if (admin_is_logged_in()) {
    admin_audit('logout');
}
admin_logout_session();
admin_redirect('/login');
