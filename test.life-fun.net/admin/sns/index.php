<?php
declare(strict_types=1);

// SNS投稿：投稿予定（昨日〜13日後）。差し替え・取消・手動投稿（コピー → 投稿済にする）。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

$datePattern = '/^\d{4}-\d{2}-\d{2}$/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    $date = (string) ($_POST['date'] ?? '');
    if ($action !== 'assign_now' && $action !== 'mark_posted' && preg_match($datePattern, $date) !== 1) {
        admin_flash_redirect('error', '日付が正しくありません。', '/sns/');
    }

    try {
        switch ($action) {
            case 'replace':
                $stockId = (int) ($_POST['stock_id'] ?? 0);
                admin_sns_replace_slot($date, $stockId);
                admin_audit('queue_replace', $date, 'ストック#' . $stockId);
                admin_flash_redirect('ok', admin_date_label($date) . 'の投稿を差し替えました。', '/sns/');
            case 'cancel':
                admin_sns_cancel_slot($date);
                admin_audit('queue_cancel', $date);
                admin_flash_redirect('ok', admin_date_label($date) . 'の投稿を取り消しました（この日は自動では埋め直しません）。', '/sns/');
            case 'release':
                admin_sns_release_slot($date);
                admin_sns_assign();
                admin_audit('queue_release', $date);
                admin_flash_redirect('ok', admin_date_label($date) . 'の枠を外し、ストックに戻しました。', '/sns/');
            case 'to_manual':
                $n = admin_sns_held_to_manual($date);
                admin_audit('queue_to_manual', $date, $n . '件');
                admin_flash_redirect($n > 0 ? 'ok' : 'error', $n > 0 ? '手動投稿待ちにしました。' : '承認済みのストックではないため変更できません。先にストックを承認してください。', '/sns/');
            case 'mark_posted':
                $queueId = (int) ($_POST['queue_id'] ?? 0);
                $postUrl = trim((string) ($_POST['post_url'] ?? ''));
                if ($postUrl !== '' && (filter_var($postUrl, FILTER_VALIDATE_URL) === false || !str_starts_with($postUrl, 'https://'))) {
                    admin_flash_redirect('error', '投稿URLは https:// で始まるURLを入力してください（空欄でも登録できます）。', '/sns/');
                }
                admin_sns_mark_posted($queueId, $postUrl);
                admin_audit('queue_mark_posted', '#' . $queueId, $postUrl);
                admin_flash_redirect('ok', '投稿済にしました。', '/sns/');
            case 'assign_now':
                $n = admin_sns_assign();
                admin_flash_redirect('ok', '割り当てを実行しました（' . $n . '枠）。', '/sns/');
        }
    } catch (RuntimeException $e) {
        admin_flash_redirect('error', $e->getMessage(), '/sns/');
    }
    admin_flash_redirect('error', '不明な操作です。', '/sns/');
}

$replaceDate = isset($_GET['replace']) && preg_match($datePattern, (string) $_GET['replace']) === 1 ? (string) $_GET['replace'] : null;

$today = new DateTimeImmutable('today');
$rules = admin_rotation_rules();
$days = [];
for ($i = -1; $i <= 13; $i++) {
    $day = $today->modify(($i >= 0 ? '+' : '') . $i . ' day');
    $date = $day->format('Y-m-d');
    $rows = admin_sns_slot_rows($date);
    $days[] = [
        'date'  => $date,
        'rule'  => $rules[(int) $day->format('w')] ?? null,
        'rows'  => $rows,
        'stock' => $rows !== [] ? admin_stock_get((int) $rows[0]['stock_id']) : null,
    ];
}

admin_render_header('SNS投稿', 'sns');
admin_render_sns_tabs('queue');
admin_render_flash();
?>
<p class="muted">投稿モード：<?= admin_post_mode() === 'review' ? '確認モード（承認したものだけ投稿）' : '自動モード' ?>　／　割り当ては毎時自動で行います（先<?= ADMIN_ASSIGN_DAYS ?>日分）。</p>
<form method="post" action="<?= h(admin_url('/sns/')) ?>" class="form form--inline">
  <?= admin_csrf_field() ?>
  <input type="hidden" name="action" value="assign_now">
  <button type="submit" class="btn btn--ghost">今すぐ割り当てる</button>
</form>

<?php foreach ($days as $day): $date = $day['date']; $stock = $day['stock']; $isPast = $date < $today->format('Y-m-d'); ?>
<section class="slot<?= $date === $today->format('Y-m-d') ? ' slot--today' : '' ?>">
  <header class="slot__head">
    <strong><?= h(admin_date_label($date)) ?><?= $date === $today->format('Y-m-d') ? '（今日）' : '' ?></strong>
    <?php if ($day['rule'] !== null): ?>
      <span class="muted"><?= h(admin_kind_label($day['rule']['kind'])) ?> <?= h($day['rule']['post_time']) ?></span>
    <?php else: ?>
      <span class="muted">投稿枠なし</span>
    <?php endif; ?>
  </header>

  <?php if ($stock === null): ?>
    <?php if ($day['rule'] !== null && !$isPast): ?>
      <p class="muted">まだ割り当てがありません。</p>
      <a class="btn btn--ghost" href="<?= h(admin_url('/sns/?replace=' . $date)) ?>#slot-<?= h($date) ?>">ストックを選んで割り当てる</a>
    <?php endif; ?>
  <?php else: ?>
    <p>
      <span class="badge"><?= h(admin_kind_label($stock['kind'])) ?></span>
      <a href="<?= h(admin_url('/sns/stock-edit?id=' . $stock['id'])) ?>"><?= h($stock['title']) ?></a>
      <span class="badge badge--<?= h($stock['status']) ?>"><?= h(ADMIN_STOCK_STATUS_LABELS[$stock['status']]) ?></span>
    </p>
    <?php foreach ($day['rows'] as $row): ?>
      <div class="slot__row">
        <p>
          <strong><?= h(admin_sns_label($row['platform'])) ?></strong>
          <?= h(admin_format_time($row['scheduled_at'])) ?>
          <span class="badge badge--<?= h($row['status']) ?>"><?= h(ADMIN_QUEUE_STATUS_LABELS[$row['status']] ?? $row['status']) ?></span>
          <?php if ($row['post_url'] !== null): ?><a href="<?= h($row['post_url']) ?>" rel="noopener noreferrer" target="_blank">投稿を見る</a><?php endif; ?>
        </p>
        <?php if ($row['status'] === 'scheduled'): ?>
          <details class="details"><summary>投稿される本文を見る</summary><pre class="preview"><?= h(admin_stock_render_body($stock, $row['platform'])) ?></pre></details>
        <?php endif; ?>
        <?php if ($row['status'] === 'manual_pending'): $bodyId = 'body-' . $row['id']; ?>
          <?php if ($row['platform'] === 'note' && ($stock['bodies']['note']['title'] ?? null) !== null): ?>
            <p class="muted">noteのタイトル：<?= h($stock['bodies']['note']['title']) ?></p>
          <?php endif; ?>
          <textarea class="form__input copy-src" id="<?= h($bodyId) ?>" readonly rows="5"><?= h(admin_stock_render_body($stock, $row['platform'])) ?></textarea>
          <div class="form--inline">
            <button type="button" class="btn btn--ghost" data-copy-target="<?= h($bodyId) ?>">本文をコピー</button>
            <a class="btn btn--ghost" href="<?= h(ADMIN_SNS_PLATFORMS[$row['platform']]['open_url'] ?? '#') ?>" target="_blank" rel="noopener noreferrer"><?= h(admin_sns_label($row['platform'])) ?>を開く</a>
          </div>
          <form method="post" action="<?= h(admin_url('/sns/')) ?>" class="form form--inline">
            <?= admin_csrf_field() ?>
            <input type="hidden" name="action" value="mark_posted">
            <input type="hidden" name="queue_id" value="<?= (int) $row['id'] ?>">
            <input class="form__input form__input--grow" type="url" name="post_url" placeholder="投稿のURL（任意）">
            <button type="submit" class="btn btn--primary">投稿済にする</button>
          </form>
        <?php endif; ?>
        <?php if ($row['last_error'] !== null): ?><p class="muted"><?= h($row['last_error']) ?></p><?php endif; ?>
      </div>
    <?php endforeach; ?>

    <?php $statuses = array_column($day['rows'], 'status'); ?>
    <div class="form--inline">
      <?php if (!array_intersect($statuses, ['posted', 'manual_pending'])): ?>
        <a class="btn btn--ghost" href="<?= h(admin_url('/sns/?replace=' . $date)) ?>#slot-<?= h($date) ?>">差し替え</a>
      <?php endif; ?>
      <?php if (in_array('held', $statuses, true)): ?>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="to_manual"><input type="hidden" name="date" value="<?= h($date) ?>"><button type="submit" class="btn btn--ghost">承認済みなら手動投稿待ちにする</button></form>
      <?php endif; ?>
      <?php if (array_intersect($statuses, ['scheduled', 'held', 'manual_pending'])): ?>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="cancel"><input type="hidden" name="date" value="<?= h($date) ?>"><button type="submit" class="btn btn--ghost" data-confirm="この日の投稿を取り消しますか？（自動では埋め直しません）">取消</button></form>
      <?php endif; ?>
      <?php if (array_intersect($statuses, ['canceled', 'held']) && !array_intersect($statuses, ['posted', 'manual_pending'])): ?>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="release"><input type="hidden" name="date" value="<?= h($date) ?>"><button type="submit" class="btn btn--ghost">枠を外してストックに戻す</button></form>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if ($replaceDate === $date): $candidates = admin_sns_candidates(null, 200); $ruleKind = $day['rule']['kind'] ?? null;
      usort($candidates, static fn (array $a, array $b): int => [($a['kind'] !== $ruleKind), $a['status'] !== 'approved', $a['id']] <=> [($b['kind'] !== $ruleKind), $b['status'] !== 'approved', $b['id']]); ?>
    <form method="post" action="<?= h(admin_url('/sns/')) ?>" class="form" id="slot-<?= h($date) ?>">
      <?= admin_csrf_field() ?>
      <input type="hidden" name="action" value="replace">
      <input type="hidden" name="date" value="<?= h($date) ?>">
      <label class="form__label" for="stock-<?= h($date) ?>">割り当てるストック（同じ種別・承認済が上）</label>
      <?php if ($candidates === []): ?>
        <p class="muted">割り当てられるストックがありません。<a href="<?= h(admin_url('/sns/stock')) ?>">ストック</a>を追加してください。</p>
      <?php else: ?>
        <select class="form__input" id="stock-<?= h($date) ?>" name="stock_id">
          <?php foreach ($candidates as $c): ?>
            <option value="<?= (int) $c['id'] ?>">[<?= h(admin_kind_label($c['kind'])) ?>] <?= h($c['title']) ?>（<?= h(ADMIN_STOCK_STATUS_LABELS[$c['status']]) ?>）</option>
          <?php endforeach; ?>
        </select>
        <div class="form--inline">
          <button type="submit" class="btn btn--primary">この日に割り当てる</button>
          <a class="btn btn--ghost" href="<?= h(admin_url('/sns/')) ?>">やめる</a>
        </div>
      <?php endif; ?>
    </form>
  <?php endif; ?>
</section>
<?php endforeach; ?>
<?php
admin_render_footer();
