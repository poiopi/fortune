<?php
declare(strict_types=1);

/**
 * _admin-lib/layout.php
 *
 * 管理画面の共通レイアウト。公開サイトのデザイン（DESIGN.md）とは切り離す。
 * CSP でインラインのスタイル・スクリプトを禁止しているため、見た目はすべて admin.css に置く。
 */

/** 左メニュー。ready=false は未実装（Phase 2以降）で「準備中」表示。 */
const ADMIN_MENU = [
    'dashboard' => ['label' => 'ダッシュボード', 'path' => '/',        'ready' => true],
    'sns'       => ['label' => 'SNS投稿',       'path' => '/sns/',    'ready' => true],
    'health'    => ['label' => 'サイトヘルス',   'path' => '/health',  'ready' => false],
    'seo'       => ['label' => 'SEO点検',       'path' => '/seo',     'ready' => false],
    'pages'     => ['label' => 'ページ台帳',     'path' => '/pages',   'ready' => false],
    'settings'  => ['label' => '設定',          'path' => '/settings', 'ready' => true],
    'logs'      => ['label' => '操作ログ',       'path' => '/logs',    'ready' => true],
];

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function admin_url(string $path): string
{
    return admin_config()['admin_base'] . $path;
}

/**
 * 管理画面の CSS・JS のURL。末尾にファイルの更新日時を付け、更新後にブラウザが古いファイルを使い続けないようにする。
 */
function admin_asset_url(string $file): string
{
    $path = dirname(admin_config()['lib_dir']) . admin_config()['admin_base'] . '/assets/' . $file;
    $version = is_file($path) ? (string) filemtime($path) : '0';
    return admin_url('/assets/' . $file) . '?v=' . $version;
}

function admin_absolute_admin_url(string $path): string
{
    return admin_config()['admin_origin'] . admin_url($path);
}

function admin_redirect(string $path): never
{
    header('Location: ' . admin_url($path), true, 303);
    exit;
}

function admin_env_badge(): string
{
    return admin_config()['env'] === 'stg'
        ? '<span class="env-badge env-badge--stg">検証環境</span>'
        : '<span class="env-badge env-badge--prod">本番</span>';
}

function admin_render_head(string $title, string $bodyClass): void
{
    echo '<!DOCTYPE html><html lang="ja"><head><meta charset="utf-8">'
        . '<meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<meta name="robots" content="noindex, nofollow">'
        . '<title>' . h($title) . ' | life-fun 管理画面</title>'
        . '<link rel="stylesheet" href="' . h(admin_asset_url('admin.css')) . '">'
        . '<script src="' . h(admin_asset_url('admin.js')) . '" defer></script>'
        . '</head><body class="' . h($bodyClass) . '">';
}

/** ログイン後の画面の先頭（左メニュー付き）。 */
function admin_render_header(string $title, string $active): void
{
    admin_render_head($title, 'admin');
    echo '<header class="topbar"><a class="topbar__brand" href="' . h(admin_url('/')) . '">life-fun 管理画面</a>'
        . admin_env_badge()
        . '<form class="topbar__logout" method="post" action="' . h(admin_url('/logout')) . '">'
        . admin_csrf_field()
        . '<button type="submit" class="btn btn--ghost">ログアウト</button></form></header>';

    echo '<div class="layout"><nav class="sidenav"><ul>';
    foreach (ADMIN_MENU as $key => $item) {
        $classes = 'sidenav__item' . ($key === $active ? ' is-active' : '');
        if ($item['ready']) {
            echo '<li class="' . $classes . '"><a href="' . h(admin_url($item['path'])) . '">' . h($item['label']) . '</a></li>';
        } else {
            echo '<li class="' . $classes . ' is-disabled"><span>' . h($item['label']) . '</span><small>準備中</small></li>';
        }
    }
    echo '</ul></nav><main class="main">';
    foreach (admin_collect_warnings() as $warning) {
        echo '<p class="warnbar">' . h($warning['text'])
            . ($warning['link'] !== null ? ' <a href="' . h(admin_url($warning['link'])) . '">確認する</a>' : '')
            . '</p>';
    }
    echo '<h1 class="page-title">' . h($title) . '</h1>';
}

/** 全画面の上部に出す警告。問題が無ければ空配列。 */
function admin_collect_warnings(): array
{
    $warnings = [];
    $cron = admin_cron_health();
    if ($cron['state'] === 'never') {
        $warnings[] = ['text' => 'cronがまだ一度も動いていません（ロリポップのcron設定が未登録の可能性があります）。', 'link' => '/settings'];
    } elseif ($cron['state'] === 'stale') {
        $warnings[] = ['text' => 'cronが' . ADMIN_CRON_STALE_MINUTES . '分以上動いていません（最終実行：' . admin_format_time($cron['last']) . '）。', 'link' => '/settings'];
    }
    $pending = (int) admin_db()->query("SELECT COUNT(*) FROM post_queue WHERE status = 'manual_pending'")->fetchColumn();
    if ($pending > 0) {
        $warnings[] = ['text' => '手動投稿待ちが' . $pending . '件あります。', 'link' => '/sns/'];
    }
    $held = (int) admin_db()->query("SELECT COUNT(DISTINCT slot_date) FROM post_queue WHERE status = 'held' AND slot_date >= date('now', 'localtime', '-7 days')")->fetchColumn();
    if ($held > 0) {
        $warnings[] = ['text' => '未承認のため保留になった投稿が' . $held . '枠あります（直近7日）。', 'link' => '/sns/'];
    }
    if (admin_post_mode() === 'review') {
        $stmt = admin_db()->prepare("SELECT COUNT(DISTINCT q.slot_date) FROM post_queue q JOIN post_stock s ON s.id = q.stock_id WHERE q.status = 'scheduled' AND s.status <> 'approved' AND q.scheduled_at <= ?");
        $stmt->execute([(new DateTimeImmutable('+1 day'))->format(DATE_ATOM)]);
        if ((int) $stmt->fetchColumn() > 0) {
            $warnings[] = ['text' => '24時間以内に投稿予定の、未承認の投稿があります。', 'link' => '/sns/'];
        }
    }
    $empty = admin_sns_empty_slots();
    if ($empty !== []) {
        $warnings[] = ['text' => '割り当てるストックが無い日があります：' . implode('、', array_map(static fn (array $e): string => admin_date_label($e['date']) . admin_kind_label($e['kind']), $empty)), 'link' => '/sns/stock'];
    }
    foreach (admin_sns_stock_days_left() as $k) {
        if ($k['per_week'] > 0 && $k['days'] < ADMIN_STOCK_LOW_DAYS) {
            $warnings[] = ['text' => $k['label'] . 'のストックが残り' . $k['count'] . '件（約' . $k['days'] . '日分）です。', 'link' => '/sns/stock'];
        }
    }
    if (admin_notify_channels() === []) {
        $warnings[] = ['text' => '通知先が1つも有効になっていません。エラーが起きても通知されません。', 'link' => '/settings'];
    }
    return $warnings;
}

/** ISO 8601 → 「2026-09-26 03:00:00」 */
function admin_format_time(?string $iso): string
{
    return $iso === null ? '—' : str_replace('T', ' ', substr($iso, 0, 19));
}

function admin_render_footer(): void
{
    echo '</main></div></body></html>';
}

/** ログイン画面・初回設定画面など、メニューなしの1カラム画面。 */
function admin_render_simple_header(string $title): void
{
    admin_render_head($title, 'admin admin--simple');
    echo '<main class="simple"><div class="simple__card"><p class="simple__brand">life-fun 管理画面 ' . admin_env_badge() . '</p>'
        . '<h1 class="page-title">' . h($title) . '</h1>';
}

function admin_render_simple_footer(): void
{
    echo '</div></main></body></html>';
}

/** エラー等の単独メッセージ画面。 */
function admin_render_message(string $title, string $message): void
{
    admin_render_simple_header($title);
    echo '<p>' . h($message) . '</p><p><a href="' . h(admin_url('/')) . '">管理画面トップへ</a></p>';
    admin_render_simple_footer();
}

/** 処理結果を次の画面で1回だけ表示するためにセッションへ入れてリダイレクトする */
function admin_flash_redirect(string $type, string $text, string $path): never
{
    $_SESSION['flash'] = ['type' => $type, 'text' => $text];
    admin_redirect($path);
}

function admin_render_flash(): void
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    if (is_array($flash)) {
        echo '<p class="alert alert--' . ($flash['type'] === 'ok' ? 'ok' : 'error') . '">' . nl2br(h($flash['text'])) . '</p>';
    }
}

/** SNS投稿の画面上部のタブ */
function admin_render_sns_tabs(string $active): void
{
    $tabs = ['queue' => ['投稿予定', '/sns/'], 'stock' => ['ストック', '/sns/stock'], 'history' => ['履歴', '/sns/history'], 'accounts' => ['SNS連携', '/sns/accounts']];
    echo '<nav class="tabs">';
    foreach ($tabs as $key => [$label, $path]) {
        echo '<a class="tabs__item' . ($key === $active ? ' is-active' : '') . '" href="' . h(admin_url($path)) . '">' . h($label) . '</a>';
    }
    echo '</nav>';
}
