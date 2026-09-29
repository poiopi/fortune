<?php
declare(strict_types=1);

// ページ台帳：本番の全ページ（ファイル走査 ＋ sitemap）の一覧。更新は SEO点検のたびに自動。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

const PAGES_FILTERS = [
    'all'        => 'すべて',
    'sitemap'    => 'sitemapに載っている',
    'no_sitemap' => 'sitemapに載っていない',
    'not_200'    => '200以外',
    'noindex'    => 'noindex',
    'no_file'    => 'ファイルが無い（sitemapだけ）',
];
$filter = isset($_GET['f'], PAGES_FILTERS[$_GET['f']]) ? (string) $_GET['f'] : 'all';
$q = trim((string) ($_GET['q'] ?? ''));
$where = match ($filter) {
    'sitemap'    => ['in_sitemap = 1'],
    'no_sitemap' => ['in_sitemap = 0'],
    'not_200'    => ['(http_status IS NULL OR http_status <> 200)'],
    'noindex'    => ["robots LIKE '%noindex%'"],
    'no_file'    => ['file IS NULL'],
    default      => [],
};
$params = [];
if ($q !== '') {
    $where[] = '(url LIKE ? OR title LIKE ?)';
    $params[] = '%' . $q . '%';
    $params[] = '%' . $q . '%';
}
$whereSql = $where !== [] ? ' WHERE ' . implode(' AND ', $where) : '';

$perPage = 100;
$countStmt = admin_db()->prepare('SELECT COUNT(*) FROM pages' . $whereSql);
$countStmt->execute($params);
$total = (int) $countStmt->fetchColumn();
$pageCount = max(1, (int) ceil($total / $perPage));
$page = min(max(1, (int) ($_GET['page'] ?? 1)), $pageCount);
$stmt = admin_db()->prepare('SELECT * FROM pages' . $whereSql . ' ORDER BY url LIMIT ' . $perPage . ' OFFSET ' . (($page - 1) * $perPage));
$stmt->execute($params);
$rows = $stmt->fetchAll();

$summary = admin_db()->query(
    "SELECT COUNT(*) AS total, SUM(in_sitemap) AS sitemap, SUM(file IS NOT NULL) AS files,
            SUM(http_status = 200) AS ok, SUM(robots LIKE '%noindex%') AS noindex, MAX(checked_at) AS checked
     FROM pages"
)->fetch();

function pages_query(array $overrides): string
{
    global $filter, $q;
    $params = array_filter(['f' => $filter !== 'all' ? $filter : null, 'q' => $q !== '' ? $q : null] + [], static fn ($v): bool => $v !== null);
    return admin_url('/pages' . (($query = http_build_query(array_merge($params, $overrides))) !== '' ? '?' . $query : ''));
}

admin_render_header('ページ台帳', 'pages');
?>
<?php if ((int) $summary['total'] === 0): ?>
  <p class="alert alert--error">まだ台帳がありません。<a href="<?= h(admin_url('/seo')) ?>">SEO点検</a>で「今すぐ点検する」を押すと作られます。</p>
<?php else: ?>
  <p>全 <?= (int) $summary['total'] ?> ページ（ファイル <?= (int) $summary['files'] ?>・sitemap <?= (int) $summary['sitemap'] ?>・200 <?= (int) $summary['ok'] ?>・noindex <?= (int) $summary['noindex'] ?>）　<span class="muted">最終取得：<?= h(admin_format_time($summary['checked'])) ?></span></p>
<?php endif; ?>
<form method="get" action="<?= h(admin_url('/pages')) ?>" class="form form--inline">
  <select class="form__input" name="f">
    <?php foreach (PAGES_FILTERS as $key => $label): ?><option value="<?= h($key) ?>"<?= $filter === $key ? ' selected' : '' ?>><?= h($label) ?></option><?php endforeach; ?>
  </select>
  <input class="form__input form__input--grow" name="q" value="<?= h($q) ?>" placeholder="URL・titleで絞り込み">
  <button type="submit" class="btn btn--ghost">表示</button>
</form>
<p class="muted"><?= $total ?> 件（<?= $page ?> / <?= $pageCount ?>）</p>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>URL</th><th>状態</th><th>sitemap</th><th>title</th><th>ファイル</th></tr></thead>
    <tbody>
    <?php if ($rows === []): ?><tr><td colspan="5" class="muted">ありません。</td></tr><?php endif; ?>
    <?php foreach ($rows as $r): $noindex = $r['robots'] !== null && str_contains($r['robots'], 'noindex'); ?>
      <tr class="<?= $r['http_status'] !== null && (int) $r['http_status'] !== 200 ? 'is-warn' : '' ?>">
        <td><a href="<?= h(admin_config()['site_url'] . $r['url']) ?>" target="_blank" rel="noopener noreferrer"><?= h($r['url']) ?></a></td>
        <td class="nowrap"><?= $r['http_status'] !== null ? (int) $r['http_status'] : ($r['fetch_error'] !== null ? '応答なし' : '<span class="muted">未取得</span>') ?><?= $noindex ? ' <span class="badge">noindex</span>' : '' ?></td>
        <td class="nowrap"><?= (int) $r['in_sitemap'] === 1 ? '○' : '<span class="muted">—</span>' ?></td>
        <td><?= h(mb_strimwidth((string) $r['title'], 0, 60, '…')) ?></td>
        <td class="muted"><?= h($r['file']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php if ($pageCount > 1): ?>
<nav class="pager">
  <?php if ($page > 1): ?><a class="btn btn--ghost" href="<?= h(pages_query(['page' => $page - 1])) ?>">← 前</a><?php endif; ?>
  <?php if ($page < $pageCount): ?><a class="btn btn--ghost" href="<?= h(pages_query(['page' => $page + 1])) ?>">次 →</a><?php endif; ?>
</nav>
<?php endif; ?>
<?php
admin_render_footer();
