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
        'timezone'     => 'Asia/Tokyo',
        // STGと本番でCookieが混ざらないよう名前を分ける
        'session_name' => $isStg ? 'lfadmin_stg' : 'lfadmin',
        'idle_timeout' => 30 * 60,
        // 同一IPで login_window 秒以内に login_max_failures 回失敗 → login_lock 秒ロック
        'login_max_failures' => 5,
        'login_window'       => 15 * 60,
        'login_lock'         => 15 * 60,
        'password_min_length' => 12,
    ];

    return $config;
}
