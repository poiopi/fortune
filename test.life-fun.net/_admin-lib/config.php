<?php
declare(strict_types=1);

/**
 * _admin-lib/config.php
 *
 * 管理画面の設定を1か所に集約する（ADMIN_PLAN.md 2章「変更容易性」）。
 * データ置き場を移す場合（案B・案C）は data_dir の1行だけを書き換える。
 */

function admin_config(): array
{
    static $config = null;
    if ($config !== null) {
        return $config;
    }

    $libDir = __DIR__;
    $isStg = str_contains(str_replace('\\', '/', $libDir), '/test.life-fun.net/');

    $config = [
        'env'          => $isStg ? 'stg' : 'prod',
        'data_dir'     => dirname($libDir) . '/_admin-data',
        'db_file'      => 'admin.sqlite',
        'lib_dir'      => $libDir,
        // 管理画面のURL上の位置（ドメイン直下からのパス）
        'admin_base'   => '/admin',
        // 通知メール等に載せる管理画面の絶対URLの起点
        'admin_origin' => $isStg ? 'https://test.life-fun.net' : 'https://life-fun.net',
        // ヘルスチェック・SEO点検の対象。STGからも本番を読む（ADMIN_IMPL_PLAN.md P7=B）
        'site_url'     => 'https://life-fun.net',
        // ページ台帳が走査する本番の公開フォルダ。STGは本番の公開フォルダの中（web/test.life-fun.net）にあるため1つ上
        'site_root'    => $isStg ? dirname($libDir, 2) : dirname($libDir),
        'timezone'     => 'Asia/Tokyo',
        // STGと本番でCookieが混ざらないよう名前を分ける
        'session_name' => $isStg ? 'lfadmin_stg' : 'lfadmin',
        'idle_timeout' => 30 * 60,
        // 同一IPで login_window 秒以内に login_max_failures 回失敗 → login_lock 秒ロック
        'login_max_failures' => 5,
        'login_window'       => 15 * 60,
        'login_lock'         => 15 * 60,
        'password_min_length' => 12,
        // 2段階認証。認証アプリに表示される名前（STGと本番を見分けられるように分ける）
        'totp_issuer'  => $isStg ? 'みつぼし占い管理(STG)' : 'みつぼし占い管理',
        'totp_account' => 'admin',
        // パスワード確認後、コード入力を待つ時間／設定中の一時的な秘密鍵を保持する時間
        'two_factor_pending_ttl' => 5 * 60,
        'two_factor_setup_ttl'   => 10 * 60,
        // IPをまたいだコード誤りの上限：直近 two_factor_global_window 秒の誤り（全IP合計）が two_factor_global_max_failures 回以上なら、
        // 全IPでコード入力を拒否し、通知する（IPを変えながらの総当たり対策）
        'two_factor_global_max_failures' => 10,
        'two_factor_global_window'       => 60 * 60,
        // Threads 自動投稿：連携を許可するアカウント名（これ以外のアカウントで許可しても保存しない。ADMIN_IMPL_PLAN.md 14-4）
        'threads_username' => 'lifefun_uranai',
        // note のID（https://note.com/<ID>）の初期値。設定画面（SNS連携）で変えられ、空にすると note の目標は「準備中」になる（note.php）
        'note_username'    => 'lifefun_uranai',
    ];

    return $config;
}
