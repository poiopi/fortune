<?php
declare(strict_types=1);

// SEO点検：問題の一覧（規則ごと）・対象外にする・Claudeに渡す用のテキスト・「今すぐ点検」。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    if ($action === 'run') {
        $ok = admin_seo_request_run('manual');
        if ($ok) {
            admin_audit('seo_run');
        }
        admin_flash_redirect($ok ? 'ok' : 'error', $ok ? '点検を予約しました。1分以内に始まり、全ページで6分ほどかかります。' : 'すでに点検中です。', '/seo');
    }
    if ($action === 'status') {
        $id = (int) ($_POST['id'] ?? 0);
        $to = (string) ($_POST['to'] ?? '');
        if (in_array($to, ['ignored', 'open'], true)) {
            $stmt = admin_db()->prepare('SELECT url, rule FROM seo_issues WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            if ($row !== false) {
                admin_db()->prepare('UPDATE seo_issues SET status = ? WHERE id = ?')->execute([$to, $id]);
                admin_audit('seo_issue', $row['url'], (ADMIN_SEO_RULES[$row['rule']] ?? $row['rule']) . '：' . ADMIN_SEO_ISSUE_STATUS_LABELS[$to]);
            }
        }
        admin_flash_redirect('ok', '変更しました。', '/seo' . (isset($_POST['rule']) && isset(ADMIN_SEO_RULES[$_POST['rule']]) ? '?rule=' . $_POST['rule'] : ''));
    }
    admin_flash_redirect('error', '不明な操作です。', '/seo');
}

$rule = isset($_GET['rule'], ADMIN_SEO_RULES[$_GET['rule']]) ? (string) $_GET['rule'] : null;
$showIgnored = isset($_GET['ignored']);
$active = admin_seo_active_run();
$last = admin_seo_last_run();
$counts = admin_seo_open_counts();
$ignoredCount = (int) admin_db()->query("SELECT COUNT(*) FROM seo_issues WHERE status = 'ignored'")->fetchColumn();

$issues = [];
if ($rule !== null || $showIgnored) {
    $stmt = admin_db()->prepare(
        'SELECT i.*, p.file, p.in_sitemap FROM seo_issues i LEFT JOIN pages p ON p.url = i.url WHERE i.status = ?' . ($rule !== null ? ' AND i.rule = ?' : '') . ' ORDER BY i.url LIMIT 500'
    );
    $stmt->execute($rule !== null ? [$showIgnored ? 'ignored' : 'open', $rule] : ['ignored']);
    $issues = $stmt->fetchAll();
}

admin_render_header('SEO点検', 'seo');
admin_render_flash();
?>
<p class="muted">本番サイトの全ページ（<a href="<?= h(admin_url('/pages')) ?>">ページ台帳</a>）を毎週月曜の朝に自動で点検します。機械的にわかる食い違いだけを出しています。直すかどうか・SEO上の重さは、Claudeと一緒に Google の公式情報を確認して判断します。</p>

<section class="panel panel--wide">
  <?php if ($active !== null): ?>
    <p><strong>点検中</strong>：<?= $active['status'] === 'queued' ? '開始待ち（1分以内に始まります）' : (int) $active['done'] . ' / ' . (int) $active['total'] . ' ページ' ?>　<span class="muted">画面を開き直すと進み具合が更新されます</span></p>
  <?php else: ?>
    <form method="post" action="<?= h(admin_url('/seo')) ?>" class="form form--inline">
      <?= admin_csrf_field() ?>
      <input type="hidden" name="action" value="run">
      <button type="submit" class="btn btn--primary">今すぐ点検する</button>
      <?php if ($last !== null): ?>
        <span class="muted">前回：<?= h(admin_format_time($last['finished_at'] ?? $last['queued_at'])) ?>（<?= $last['status'] === 'done' ? (int) $last['total'] . 'ページ・新しい問題 ' . (int) $last['new_issues'] . '件' : ($last['status'] === 'failed' ? '失敗：' . h($last['message']) : h($last['status'])) ?>）</span>
      <?php endif; ?>
    </form>
  <?php endif; ?>
</section>

<div class="table-wrap">
  <table class="table">
    <thead><tr><th>検出するもの</th><th>未対応</th></tr></thead>
    <tbody>
    <?php foreach (ADMIN_SEO_RULES as $key => $label): $n = $counts[$key] ?? 0; ?>
      <tr class="<?= $rule === $key ? 'is-warn' : '' ?>">
        <td><?= $n > 0 ? '<a href="' . h(admin_url('/seo?rule=' . $key)) . '">' . h($label) . '</a>' : h($label) ?></td>
        <td class="nowrap"><?= $n > 0 ? $n . ' 件' : '<span class="muted">0</span>' ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<p class="muted"><?= $ignoredCount > 0 ? '<a href="' . h(admin_url('/seo?ignored=1')) . '">対象外にしたもの（' . $ignoredCount . '件）</a>' : '' ?></p>

<?php if (array_sum($counts) > 0): $text = admin_seo_export_text($rule); ?>
<section class="panel panel--wide">
  <h2 class="panel__title">Claudeに渡す用（<?= $rule !== null ? h(ADMIN_SEO_RULES[$rule]) : '未対応すべて' ?>）</h2>
  <textarea class="form__input copy-src" id="seo-export" readonly rows="6"><?= h($text) ?></textarea>
  <div class="form--inline"><button type="button" class="btn btn--primary" data-copy-target="seo-export">コピーする</button><span class="muted">コピーして Claude のチャットに貼り付けてください</span></div>
</section>
<?php endif; ?>

<?php if ($issues !== []): ?>
<h2 class="panel__subtitle"><?= $showIgnored && $rule === null ? '対象外にしたもの' : h(ADMIN_SEO_RULES[$rule]) ?>（<?= count($issues) ?>件）</h2>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th>URL</th><th>内容</th><?= $rule === null ? '<th>検出</th>' : '' ?><th>初めて検出</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($issues as $i): ?>
      <tr>
        <td><a href="<?= h(admin_config()['site_url'] . $i['url']) ?>" target="_blank" rel="noopener noreferrer"><?= h($i['url']) ?></a></td>
        <td><?= h($i['detail']) ?></td>
        <?= $rule === null ? '<td>' . h(ADMIN_SEO_RULES[$i['rule']] ?? $i['rule']) . '</td>' : '' ?>
        <td class="nowrap"><?= h(substr(admin_format_time($i['first_seen']), 0, 10)) ?></td>
        <td>
          <form method="post" action="<?= h(admin_url('/seo')) ?>"><?= admin_csrf_field() ?>
            <input type="hidden" name="action" value="status"><input type="hidden" name="id" value="<?= (int) $i['id'] ?>">
            <?php if ($rule !== null): ?><input type="hidden" name="rule" value="<?= h($rule) ?>"><?php endif; ?>
            <input type="hidden" name="to" value="<?= $i['status'] === 'ignored' ? 'open' : 'ignored' ?>">
            <button type="submit" class="btn btn--ghost"><?= $i['status'] === 'ignored' ? '対象外をやめる' : '対象外にする' ?></button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<p class="muted">「対象外にする」と、次の点検からも未対応に数えません（意図して sitemap に載せていないページなど）。</p>
<?php endif; ?>
<?php
admin_render_footer();
