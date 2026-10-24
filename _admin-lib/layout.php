<?php
declare(strict_types=1);

/**
 * _admin-lib/layout.php
 *
 * 管理画面の共通レイアウト。公開サイトのデザイン（DESIGN.md）とは切り離す。
 * CSP でインラインのスタイル・スクリプトを禁止しているため、見た目はすべて admin.css に置く。
 */

/**
 * メニュー（ADMIN_FEATURES_ORGANIZED.md 1-1 の7つ。ADMIN_STAGE2_PROPOSAL.md 3-1）。
 * 各画面は admin_render_header() に「画面のキー」（tabs のキー、タブが無いメニューはメニューのキー）を渡す。
 * URL はメニューに合わせて変えない（Meta に登録した Threads の戻り先などを壊さないため）。
 * ready=false：中身がまだ無いメニュー（数字とふりかえり＝段階3、お問い合わせ＝段階6）。中身ができるまでメニューに出さない（ADMIN_FULLSPEC_PROPOSAL.md 2-1）
 * tabs：[画面のキー => [タブの名前, URL, この画面でできること]]
 * mobile：スマホで画面の下に固定するメニュー
 */
const ADMIN_MENU = [
    // 今日：タブは出さない（「今日の作業」へは画面の主ボタンから入る。tabs は画面のキー・説明文のために持つ）
    'today' => ['label' => '今日', 'path' => '/', 'ready' => true, 'mobile' => true, 'show_tabs' => false, 'tabs' => [
        'today'      => ['今日', '/', '今日やることを上から順に片付けます。'],
        'today_flow' => ['今日の作業', '/today-flow', '今日の作業を、1つずつ「次へ」で進めます。'],
    ]],
    'write' => ['label' => '書いて出す', 'path' => '/sns/', 'ready' => true, 'mobile' => true, 'tabs' => [
        'sns_queue'   => ['投稿予定', '/sns/', 'これから出るSNS・noteの投稿を確認し、差し替え・取り消しをします。'],
        'sns_stock'   => ['ストック', '/sns/stock', '投稿のネタ（ストック）を確認・承認・追加します。'],
        'sns_history' => ['履歴', '/sns/history', '出した投稿の結果を見て、失敗したものを再試行します。'],
        'sns_rules'   => ['投稿のルール', '/sns/rules', '曜日ごとの投稿の種類・時刻と、承認してから出すかどうかを決めます。'],
    ]],
    'numbers' => ['label' => '数字とふりかえり', 'path' => null, 'ready' => false, 'mobile' => false, 'tabs' => []],
    'site' => ['label' => 'サイトを整える', 'path' => '/seo', 'ready' => true, 'mobile' => false, 'tabs' => [
        'seo'   => ['SEO点検', '/seo', '公開ページの検索向けの問題（タイトル・説明文など）を点検します。'],
        'pages' => ['ページ台帳', '/pages', '公開しているページの一覧と、それぞれの状態を見ます。'],
        'kanji' => ['姓名判断の漢字', '/kanji', '姓名判断で使う漢字の画数を追加・確認します。'],
    ]],
    'contact' => ['label' => 'お問い合わせ', 'path' => null, 'ready' => false, 'mobile' => false, 'tabs' => []],
    'trouble' => ['label' => '困ったとき', 'path' => '/health', 'ready' => true, 'mobile' => false, 'tabs' => [
        'health' => ['サイトの見回り', '/health', '本番サイトが正しく動いているかの自動チェックの結果です。'],
        'errors' => ['エラー', '/errors', '公開ページで起きたJSエラーを確認し、対応済みにします。'],
        'issues' => ['既知の不具合', '/issues', '分かっている不具合と、その対応の状況を記録します。'],
    ]],
    'settings' => ['label' => '設定', 'path' => '/settings', 'ready' => true, 'mobile' => false, 'tabs' => [
        'settings'     => ['通知', '/settings', '何を・いつ・どこに知らせるかを決めます。'],
        'security'     => ['ログインと2段階認証', '/security', 'ログインの記録・2段階認証・パスワードの変更です。'],
        'sns_accounts' => ['SNS連携', '/sns/accounts', 'Threadsとの連携と、noteのIDを設定します。'],
        'cron'         => ['自動実行', '/cron', '自動で動く処理（cron）が動いているかを確かめます。'],
        'logs'         => ['操作ログ', '/logs', 'いつ・何をしたかの記録です。'],
    ]],
];

/** 画面のキー → [メニューのキー, タブの定義]。見つからなければ [null, null] */
function admin_menu_lookup(string $screen): array
{
    foreach (ADMIN_MENU as $key => $item) {
        if (isset($item['tabs'][$screen])) {
            return [$key, $item['tabs'][$screen]];
        }
    }
    return [isset(ADMIN_MENU[$screen]) ? $screen : null, null];
}

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

/**
 * ログイン後の画面の先頭（PCは左メニュー、スマホは画面の下に「今日」「書いて出す」「ほかの画面」）。
 * $screen：画面のキー（ADMIN_MENU の tabs のキー）。上部には異常（赤）だけを全画面に出す。やることは「今日」画面と朝のまとめだけ。
 */
function admin_render_header(string $title, string $screen): void
{
    [$activeMenu, $tab] = admin_menu_lookup($screen);
    $items = admin_status_items();
    $alerts = array_filter($items, static fn (array $i): bool => $i['kind'] === 'alert');
    // メニューの点：今日＝やることがある、困ったとき＝サイトの異常がある
    $dots = [
        'today'   => count($items) > count($alerts),
        'trouble' => array_filter($alerts, static fn (array $i): bool => $i['category'] === 'site') !== [],
    ];

    admin_render_head($title, 'admin');
    echo '<header class="topbar"><a class="topbar__brand" href="' . h(admin_url('/')) . '">life-fun 管理画面</a>'
        . admin_env_badge()
        . '<form class="topbar__logout" method="post" action="' . h(admin_url('/logout')) . '">'
        . admin_csrf_field()
        . '<button type="submit" class="btn btn--ghost">ログアウト</button></form></header>';

    echo '<div class="layout"><nav class="sidenav" aria-label="メニュー"><ul>';
    foreach (ADMIN_MENU as $key => $item) {
        if ($item['ready']) {
            echo admin_menu_link($key, $item, $key === $activeMenu, $dots[$key] ?? false, 'sidenav__item');
        }
    }
    echo '</ul></nav>';
    admin_render_bottomnav($activeMenu, $dots);
    echo '<main class="main">';
    foreach ($alerts as $alert) {
        echo '<p class="warnbar">' . h($alert['text'])
            . ($alert['link'] !== null ? ' <a href="' . h(admin_url($alert['link'])) . '">' . h($alert['link_label'] ?? '確認する') . '</a>' : '')
            . '</p>';
    }
    // 見出し：タブと同じ名前の画面はメニューの名前（タブと見出しが同じ言葉を2回並べないため）。詳細画面などは画面の名前
    $heading = $tab !== null && $tab[0] === $title && (ADMIN_MENU[$activeMenu]['show_tabs'] ?? true) ? ADMIN_MENU[$activeMenu]['label'] : $title;
    echo '<h1 class="page-title">' . h($heading) . '</h1>';
    if ($activeMenu !== null && (ADMIN_MENU[$activeMenu]['show_tabs'] ?? true) && count(ADMIN_MENU[$activeMenu]['tabs']) > 1) {
        echo '<nav class="tabs" aria-label="' . h(ADMIN_MENU[$activeMenu]['label']) . 'の画面">';
        foreach (ADMIN_MENU[$activeMenu]['tabs'] as $key => [$label, $path]) {
            echo '<a class="tabs__item' . ($key === $screen ? ' is-active' : '') . '" href="' . h(admin_url($path)) . '"'
                . ($key === $screen ? ' aria-current="page"' : '') . '>' . h($label) . '</a>';
        }
        echo '</nav>';
    }
    if ($tab !== null) {
        echo '<p class="page-lead">' . h($tab[2]) . '</p>';
    }
}

/** メニューの1項目（<li>）。点は文字の右に出す丸（CSS）。読み上げ用に「（お知らせあり）」を添える */
function admin_menu_link(string $key, array $item, bool $active, bool $dot, string $class): string
{
    return '<li class="' . $class . ($active ? ' is-active' : '') . '"><a href="' . h(admin_url($item['path'])) . '"' . ($active ? ' aria-current="page"' : '') . '>'
        . h($item['label']) . ($dot ? '<span class="menu-dot menu-dot--' . h($key) . '"><span class="visually-hidden">（お知らせあり）</span></span>' : '')
        . '</a></li>';
}

/** スマホの下部メニュー：mobile=true のメニューを固定で並べ、残りは「ほかの画面」（<details>。JS不要）に入れる */
function admin_render_bottomnav(?string $activeMenu, array $dots): void
{
    $fixed = '';
    $others = '';
    $otherActive = false;
    foreach (ADMIN_MENU as $key => $item) {
        if (!$item['ready']) {
            continue;
        }
        if ($item['mobile']) {
            $fixed .= admin_menu_link($key, $item, $key === $activeMenu, $dots[$key] ?? false, 'bottomnav__item');
        } else {
            $others .= admin_menu_link($key, $item, $key === $activeMenu, $dots[$key] ?? false, 'bottomnav__menuitem');
            $otherActive = $otherActive || $key === $activeMenu;
        }
    }
    echo '<nav class="bottomnav" aria-label="メニュー"><ul class="bottomnav__list">' . $fixed
        . '<li class="bottomnav__item bottomnav__item--more' . ($otherActive ? ' is-active' : '') . '"><details class="bottomnav__more"><summary>ほかの画面</summary>'
        . '<ul class="bottomnav__menu">' . $others . '</ul></details></li></ul></nav>';
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
