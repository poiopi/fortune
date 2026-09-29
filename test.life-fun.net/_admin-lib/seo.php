<?php
declare(strict_types=1);

/**
 * _admin-lib/seo.php
 *
 * SEO点検（読み取り専用。ADMIN_PLAN.md 8章、ADMIN_IMPL_PLAN.md Phase 5）。
 *  - 毎週月曜4時、または画面の「今すぐ点検」で seo_runs に予約 → 毎分cronが台帳を更新して1分100ページずつ取得
 *  - 取得は同時 ADMIN_SEO_CONCURRENCY 本まで。リダイレクトは追わず、最初の応答を記録する
 *  - 全ページ取得後に規則で判定し、seo_issues を更新。新しい問題があれば1通だけ通知
 * 規則は機械的な食い違いの検出だけ。SEO上の重さの評価はしない（修正時に Google 公式情報を確認して判断する）。
 */

const ADMIN_SEO_BATCH = 100;
const ADMIN_SEO_CONCURRENCY = 5;

const ADMIN_SEO_RULES = [
    'sitemap_not_200'   => 'sitemapに載っているのに 200 以外',
    'sitemap_noindex'   => 'sitemapに載っているのに noindex',
    'not_in_sitemap'    => '公開中なのに sitemap に載っていない',
    'canonical_missing' => 'canonical がない',
    'canonical_other'   => 'canonical が別のURLを指している',
    'canonical_broken'  => 'canonical の指す先が 200 以外',
    'title_missing'     => 'title がない',
    'title_dup'         => 'title がほかのページと重複',
    'desc_missing'      => 'description がない',
    'desc_dup'          => 'description がほかのページと重複',
];
const ADMIN_SEO_ISSUE_STATUS_LABELS = ['open' => '未対応', 'ignored' => '対象外', 'resolved' => '解消'];

/** 予約（すでに予約・実行中なら何もしない）。戻り値：予約したか */
function admin_seo_request_run(string $trigger): bool
{
    $active = (int) admin_db()->query("SELECT COUNT(*) FROM seo_runs WHERE status IN ('queued', 'running')")->fetchColumn();
    if ($active > 0) {
        return false;
    }
    admin_db()->prepare('INSERT INTO seo_runs (trigger, queued_at) VALUES (?, ?)')->execute([$trigger, admin_now()]);
    return true;
}

function admin_seo_active_run(): ?array
{
    return admin_db()->query("SELECT * FROM seo_runs WHERE status IN ('queued', 'running') ORDER BY id LIMIT 1")->fetch() ?: null;
}

function admin_seo_last_run(): ?array
{
    return admin_db()->query('SELECT * FROM seo_runs ORDER BY id DESC LIMIT 1')->fetch() ?: null;
}

/** 毎週（月曜のみ実行） */
function admin_seo_weekly(): string
{
    if ((int) date('N') !== 1) {
        return '月曜以外のため点検なし';
    }
    return admin_seo_request_run('weekly') ? '週次のSEO点検を予約' : 'SEO点検は実行中のため予約なし';
}

/** 毎分：予約・実行中の点検を1回分進める。戻り値：cronの記録用 */
function admin_seo_tick(): string
{
    $run = admin_seo_active_run();
    if ($run === null) {
        return '';
    }
    $id = (int) $run['id'];
    try {
        if ($run['status'] === 'queued') {
            $sync = admin_pages_sync();
            admin_db()->prepare("UPDATE seo_runs SET status = 'running', started_at = ?, total = ?, message = ? WHERE id = ?")
                ->execute([admin_now(), $sync['total'], 'ファイル ' . $sync['files'] . '件・sitemap ' . $sync['sitemap'] . '件', $id]);
            $run = admin_seo_active_run();
        }
        $stmt = admin_db()->prepare('SELECT url FROM pages WHERE checked_at IS NULL OR checked_at < ? ORDER BY url LIMIT ' . ADMIN_SEO_BATCH);
        $stmt->execute([$run['started_at']]);
        $urls = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if ($urls !== []) {
            admin_seo_fetch_and_store($urls);
            admin_db()->prepare('UPDATE seo_runs SET done = done + ? WHERE id = ?')->execute([count($urls), $id]);
            return 'SEO点検 ' . count($urls) . 'ページ取得';
        }
        $new = admin_seo_evaluate();
        admin_db()->prepare("UPDATE seo_runs SET status = 'done', finished_at = ?, new_issues = ? WHERE id = ?")
            ->execute([admin_now(), $new, $id]);
        if ($new > 0) {
            admin_notify('seo_new_issues', 'SEO点検で新しい問題が ' . $new . '件 見つかりました。' . "\n" . admin_seo_summary_text() . "\n" . admin_absolute_admin_url('/seo'), true);
        }
        return 'SEO点検 完了（新しい問題 ' . $new . '件）';
    } catch (Throwable $e) {
        admin_db()->prepare("UPDATE seo_runs SET status = 'failed', finished_at = ?, message = ? WHERE id = ?")
            ->execute([admin_now(), mb_substr($e->getMessage(), 0, 300), $id]);
        throw $e;
    }
}

/** 取得して台帳に書く（リダイレクトは追わない） */
function admin_seo_fetch_and_store(array $urls): void
{
    $site = admin_config()['site_url'];
    $update = admin_db()->prepare(
        'UPDATE pages SET http_status = ?, redirect_to = ?, title = ?, description = ?, canonical = ?, robots = ?, fetch_error = ?, checked_at = ? WHERE url = ?'
    );
    foreach (array_chunk($urls, ADMIN_SEO_CONCURRENCY) as $chunk) {
        $multi = curl_multi_init();
        $handles = [];
        foreach ($chunk as $i => $path) {
            $ch = curl_init($site . $path);
            curl_setopt_array($ch, [
                CURLOPT_PRIVATE        => (string) $i,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_PROTOCOLS      => CURLPROTO_HTTPS | CURLPROTO_HTTP,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT        => 10,
                CURLOPT_USERAGENT      => 'life-fun-admin-seo/1.0',
                CURLOPT_ENCODING       => '',
            ]);
            curl_multi_add_handle($multi, $ch);
            $handles[$path] = $ch;
        }
        do {
            $status = curl_multi_exec($multi, $running);
            if ($running > 0) {
                curl_multi_select($multi, 1.0);
            }
        } while ($running > 0 && $status === CURLM_OK);
        $codes = [];
        while (($info = curl_multi_info_read($multi)) !== false) {
            $codes[(int) curl_getinfo($info['handle'], CURLINFO_PRIVATE)] = (int) $info['result'];
        }
        foreach ($handles as $path => $ch) {
            $errno = $codes[(int) curl_getinfo($ch, CURLINFO_PRIVATE)] ?? CURLE_OPERATION_TIMEDOUT;
            $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $redirect = (string) curl_getinfo($ch, CURLINFO_REDIRECT_URL);
            $meta = $errno === 0 && $code === 200 ? admin_seo_extract((string) curl_multi_getcontent($ch)) : [];
            $update->execute([
                $errno === 0 ? $code : null,
                $redirect !== '' ? $redirect : null,
                $meta['title'] ?? null,
                $meta['description'] ?? null,
                $meta['canonical'] ?? null,
                $meta['robots'] ?? null,
                $errno !== 0 ? 'curl ' . $errno . '：' . curl_strerror($errno) : null,
                admin_now(),
                $path,
            ]);
            curl_multi_remove_handle($multi, $ch);
            curl_close($ch);
        }
        curl_multi_close($multi);
    }
}

/** HTML から title・description・canonical・robots（robots と googlebot の meta をまとめる） */
function admin_seo_extract(string $html): array
{
    $head = preg_match('#<head\b.*?</head>#is', $html, $m) === 1 ? $m[0] : $html;
    $dom = new DOMDocument();
    $prev = libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="UTF-8">' . $head, LIBXML_NONET | LIBXML_NOWARNING | LIBXML_NOERROR);
    libxml_clear_errors();
    libxml_use_internal_errors($prev);

    $out = ['title' => null, 'description' => null, 'canonical' => null, 'robots' => null];
    $title = $dom->getElementsByTagName('title')->item(0);
    if ($title !== null) {
        $out['title'] = trim(preg_replace('/\s+/u', ' ', $title->textContent) ?? '');
    }
    $robots = [];
    foreach ($dom->getElementsByTagName('meta') as $meta) {
        $name = strtolower($meta->getAttribute('name'));
        if ($name === 'description') {
            $out['description'] = trim($meta->getAttribute('content'));
        } elseif ($name === 'robots' || $name === 'googlebot') {
            $robots[] = strtolower(trim($meta->getAttribute('content')));
        }
    }
    foreach ($dom->getElementsByTagName('link') as $link) {
        if (in_array('canonical', preg_split('/\s+/', strtolower($link->getAttribute('rel'))) ?: [], true)) {
            $out['canonical'] = trim($link->getAttribute('href'));
            break;
        }
    }
    $out['robots'] = $robots !== [] ? implode(', ', $robots) : null;
    foreach (['title', 'description', 'canonical'] as $k) {
        if ($out[$k] === '') {
            $out[$k] = null;
        }
    }
    return $out;
}

/** canonical を「サイト内のパス」にそろえる。他サイトなら絶対URLのまま */
function admin_seo_canonical_path(string $canonical, string $pagePath): string
{
    $site = admin_config()['site_url'];
    if (str_starts_with($canonical, $site . '/') || $canonical === $site) {
        return substr($canonical, strlen($site)) ?: '/';
    }
    if (str_starts_with($canonical, '/') && !str_starts_with($canonical, '//')) {
        return $canonical;
    }
    if (preg_match('#^[a-z][a-z0-9+.-]*:#i', $canonical) === 1 || str_starts_with($canonical, '//')) {
        return $canonical;
    }
    return rtrim(dirname($pagePath . 'x'), '/') . '/' . $canonical;
}

/** 台帳から問題を判定して seo_issues を更新する。戻り値：新しく未対応になった件数 */
function admin_seo_evaluate(): int
{
    $pages = [];
    foreach (admin_db()->query('SELECT * FROM pages') as $row) {
        $pages[$row['url']] = $row;
    }
    $found = [];
    $add = static function (string $url, string $rule, ?string $detail) use (&$found): void {
        $found[$url . "\n" . $rule] = [$url, $rule, $detail];
    };

    $indexable = [];
    foreach ($pages as $url => $p) {
        $status = $p['http_status'] !== null ? (int) $p['http_status'] : null;
        $noindex = $p['robots'] !== null && str_contains($p['robots'], 'noindex');
        if ((int) $p['in_sitemap'] === 1 && $status !== 200) {
            $add($url, 'sitemap_not_200', $status === null ? ($p['fetch_error'] ?? '応答なし') : 'HTTP ' . $status . ($p['redirect_to'] !== null ? ' → ' . $p['redirect_to'] : ''));
        }
        if ($status !== 200) {
            continue;
        }
        if ((int) $p['in_sitemap'] === 1 && $noindex) {
            $add($url, 'sitemap_noindex', $p['robots']);
        }
        if ($noindex) {
            continue;
        }
        $canonical = $p['canonical'] !== null ? admin_seo_canonical_path($p['canonical'], $url) : null;
        if ($canonical === null) {
            $add($url, 'canonical_missing', null);
        } elseif ($canonical !== $url) {
            $add($url, 'canonical_other', $p['canonical']);
            if (isset($pages[$canonical]) && (int) ($pages[$canonical]['http_status'] ?? 0) !== 200) {
                $add($url, 'canonical_broken', $p['canonical'] . '（HTTP ' . ($pages[$canonical]['http_status'] ?? '—') . '）');
            }
            continue; // 別URLを正とするページは、sitemap漏れ・重複の判定から外す
        }
        if ((int) $p['in_sitemap'] === 0 && $p['file'] !== null) {
            $add($url, 'not_in_sitemap', $p['file']);
        }
        $indexable[$url] = $p;
    }

    foreach (['title' => ['title_missing', 'title_dup'], 'description' => ['desc_missing', 'desc_dup']] as $field => [$missing, $dup]) {
        $groups = [];
        foreach ($indexable as $url => $p) {
            if ($p[$field] === null) {
                $add($url, $missing, null);
            } else {
                $groups[$p[$field]][] = $url;
            }
        }
        foreach ($groups as $value => $urls) {
            if (count($urls) > 1) {
                foreach ($urls as $url) {
                    $others = array_values(array_diff($urls, [$url]));
                    $add($url, $dup, '「' . mb_strimwidth((string) $value, 0, 60, '…') . '」 同じもの：' . implode('、', array_slice($others, 0, 3)) . (count($others) > 3 ? ' ほか' . (count($others) - 3) . '件' : ''));
                }
            }
        }
    }

    $db = admin_db();
    $now = admin_now();
    $new = 0;
    $db->exec('BEGIN IMMEDIATE');
    try {
        $get = $db->prepare('SELECT status FROM seo_issues WHERE url = ? AND rule = ?');
        $insert = $db->prepare('INSERT INTO seo_issues (url, rule, detail, first_seen, last_seen) VALUES (?, ?, ?, ?, ?)');
        $update = $db->prepare("UPDATE seo_issues SET detail = ?, last_seen = ?, status = CASE WHEN status = 'resolved' THEN 'open' ELSE status END WHERE url = ? AND rule = ?");
        foreach ($found as [$url, $rule, $detail]) {
            $get->execute([$url, $rule]);
            $old = $get->fetchColumn();
            if ($old === false) {
                $insert->execute([$url, $rule, $detail, $now, $now]);
                $new++;
            } else {
                $update->execute([$detail, $now, $url, $rule]);
                if ($old === 'resolved') {
                    $new++;
                }
            }
        }
        // 今回検出されなかった未対応は解消に（対象外にしたものはそのまま）
        $db->prepare("UPDATE seo_issues SET status = 'resolved' WHERE status = 'open' AND last_seen <> ?")->execute([$now]);
        $db->exec('COMMIT');
    } catch (Throwable $e) {
        $db->exec('ROLLBACK');
        throw $e;
    }
    return $new;
}

/** 未対応の件数（規則ごと） */
function admin_seo_open_counts(): array
{
    $counts = [];
    foreach (admin_db()->query("SELECT rule, COUNT(*) AS n FROM seo_issues WHERE status = 'open' GROUP BY rule") as $row) {
        $counts[$row['rule']] = (int) $row['n'];
    }
    return $counts;
}

function admin_seo_summary_text(): string
{
    $lines = [];
    foreach (admin_seo_open_counts() as $rule => $n) {
        $lines[] = '・' . (ADMIN_SEO_RULES[$rule] ?? $rule) . '：' . $n . '件';
    }
    return $lines === [] ? '未対応の問題はありません' : implode("\n", $lines);
}

/** Claude に渡す用のテキスト（未対応のみ） */
function admin_seo_export_text(?string $rule): string
{
    $sql = "SELECT url, rule, detail FROM seo_issues WHERE status = 'open'" . ($rule !== null ? ' AND rule = ?' : '') . ' ORDER BY rule, url';
    $stmt = admin_db()->prepare($sql);
    $stmt->execute($rule !== null ? [$rule] : []);
    $out = "life-fun.net SEO点検の未対応の問題（" . admin_now() . " 時点・管理画面から出力）\n";
    $current = null;
    foreach ($stmt as $row) {
        if ($row['rule'] !== $current) {
            $current = $row['rule'];
            $out .= "\n## " . (ADMIN_SEO_RULES[$current] ?? $current) . "\n";
        }
        $out .= '- ' . $row['url'] . ($row['detail'] !== null ? '　' . $row['detail'] : '') . "\n";
    }
    return $out;
}
