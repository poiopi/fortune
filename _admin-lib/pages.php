<?php
declare(strict_types=1);

/**
 * _admin-lib/pages.php
 *
 * ページ台帳（ADMIN_PLAN.md 8章、ADMIN_IMPL_PLAN.md Phase 5）。
 * 本番の公開フォルダ（config の site_root）のファイル走査と sitemap.xml の和集合を pages に入れる。
 * ページとみなさないもの：部品・管理画面・開発用のフォルダ、名前が _ や . で始まるフォルダ・ファイル、
 * ドメイン名のフォルダ（test.life-fun.net 等）、data.php。
 */

const ADMIN_PAGES_EXCLUDED_DIRS = ['inc', 'api', 'admin', 'tools', 'docs', 'tests', 'css', 'img', 'js', 'cards', 'sprites', 'reversi-assets', 'cgi-bin'];
const ADMIN_PAGES_EXCLUDED_FILES = ['data.php'];
const ADMIN_PAGES_MAX_FILES = 5000;

/** 公開ファイルから URL（パス）を作る。戻り値：[path => 相対ファイル名] */
function admin_pages_scan_files(): array
{
    $root = rtrim(str_replace('\\', '/', admin_config()['site_root']), '/');
    $pages = [];
    $stack = [''];
    while ($stack !== [] && count($pages) < ADMIN_PAGES_MAX_FILES) {
        $rel = array_pop($stack);
        $entries = @scandir($root . ($rel !== '' ? '/' . $rel : ''));
        if ($entries === false) {
            continue;
        }
        foreach ($entries as $name) {
            if ($name === '.' || $name === '..' || $name[0] === '.' || $name[0] === '_') {
                continue;
            }
            $path = $rel !== '' ? $rel . '/' . $name : $name;
            $full = $root . '/' . $path;
            if (is_dir($full)) {
                // 最上位のみ：除外フォルダ・ドメイン名のフォルダ（サブドメインの公開フォルダ）
                if ($rel === '' && (in_array($name, ADMIN_PAGES_EXCLUDED_DIRS, true) || str_contains($name, '.'))) {
                    continue;
                }
                if (substr_count($path, '/') < 8) {
                    $stack[] = $path;
                }
                continue;
            }
            if (!str_ends_with($name, '.php') || in_array($name, ADMIN_PAGES_EXCLUDED_FILES, true)) {
                continue;
            }
            $url = $name === 'index.php'
                ? '/' . ($rel !== '' ? $rel . '/' : '')
                : '/' . substr($path, 0, -4);
            $pages[$url] = $path;
        }
    }
    ksort($pages);
    return $pages;
}

/** sitemap.xml の URL（自サイトのパス）。sitemap index なら1段だけたどる。読めなければ null */
function admin_pages_sitemap_paths(): ?array
{
    $site = admin_config()['site_url'];
    $queue = [$site . '/sitemap.xml'];
    $paths = [];
    $fetched = 0;
    while ($queue !== [] && $fetched < 20) {
        $url = array_shift($queue);
        $fetched++;
        $r = admin_health_fetch_many([$url])[$url];
        if ($r['error'] !== null || $r['code'] !== 200) {
            return $fetched === 1 ? null : $paths;
        }
        $prev = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($r['body']);
        libxml_use_internal_errors($prev);
        if ($xml === false) {
            return $fetched === 1 ? null : $paths;
        }
        $isIndex = $xml->getName() === 'sitemapindex';
        foreach ($xml->children() as $child) {
            $loc = trim((string) $child->loc);
            if ($loc === '') {
                continue;
            }
            if ($isIndex) {
                $queue[] = $loc;
            } elseif (str_starts_with($loc, $site . '/') || $loc === $site) {
                $paths[] = substr($loc, strlen($site)) ?: '/';
            }
        }
    }
    return array_values(array_unique($paths));
}

/**
 * 台帳を最新のファイル・sitemapにそろえる。どちらにも無くなったURLは台帳から消す。
 * 戻り値：['files' => 件数, 'sitemap' => 件数|null, 'total' => 件数]
 */
function admin_pages_sync(): array
{
    $files = admin_pages_scan_files();
    if ($files === []) {
        throw new RuntimeException('本番の公開フォルダ（' . admin_config()['site_root'] . '）のファイルを読めません');
    }
    $sitemap = admin_pages_sitemap_paths();
    if ($sitemap === null) {
        throw new RuntimeException('sitemap.xml を読めないため、台帳を更新できません');
    }
    $sitemapSet = array_flip($sitemap);
    $all = array_unique(array_merge(array_keys($files), $sitemap));
    $now = admin_now();

    $db = admin_db();
    $db->exec('BEGIN IMMEDIATE');
    try {
        $upsert = $db->prepare(
            'INSERT INTO pages (url, file, in_sitemap, first_seen, last_seen) VALUES (?, ?, ?, ?, ?)
             ON CONFLICT(url) DO UPDATE SET file = excluded.file, in_sitemap = excluded.in_sitemap, last_seen = excluded.last_seen'
        );
        foreach ($all as $url) {
            $upsert->execute([$url, $files[$url] ?? null, isset($sitemapSet[$url]) ? 1 : 0, $now, $now]);
        }
        $db->prepare('DELETE FROM pages WHERE last_seen <> ?')->execute([$now]);
        $db->exec('COMMIT');
    } catch (Throwable $e) {
        $db->exec('ROLLBACK');
        throw $e;
    }
    return ['files' => count($files), 'sitemap' => count($sitemap), 'total' => count($all)];
}
