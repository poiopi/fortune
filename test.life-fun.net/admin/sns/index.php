<?php
declare(strict_types=1);

// SNS投稿：投稿予定（昨日〜13日後 ＋ それより前に残っている未処理）。差し替え・取消・手動投稿（コピー → 投稿済にする）。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

$datePattern = '/^\d{4}-\d{2}-\d{2}$/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    $date = (string) ($_POST['date'] ?? '');
    if (!in_array($action, ['assign_now', 'mark_posted', 'retry', 'note_lane_cancel'], true) && preg_match($datePattern, $date) !== 1) {
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
                // スキップ・失敗の行（履歴）が残ると、その日は空き枠と見なされず自動割り当ての対象外
                $historyLeft = array_intersect(array_column(admin_sns_slot_rows($date), 'status'), ['failed', 'skipped']) !== [];
                admin_flash_redirect('ok', admin_date_label($date) . 'の枠を外し、ストックに戻しました' . ($historyLeft ? '（履歴の行が残るため、この日は自動では埋め直しません）' : '') . '。', '/sns/');
            case 'post_now':
                $r = admin_sns_held_post_now($date);
                admin_audit('queue_post_now', $date, '自動' . $r['auto'] . '件・手動待ち' . $r['manual'] . '件・未連携' . $r['unconnected'] . '件');
                $parts = [];
                if ($r['auto'] > 0) {
                    $parts[] = 'Threadsは1〜2分後に自動で投稿されます';
                }
                if ($r['manual'] > 0) {
                    $parts[] = 'noteは手動投稿待ちにしました';
                }
                if ($r['unconnected'] > 0) {
                    $parts[] = 'Threadsと連携していないため、Threadsの分は保留のままです（「SNS連携」から連携してください）';
                }
                if ($parts === []) {
                    admin_flash_redirect('error', '承認済みのストックではないため投稿できません。先にストックを承認してください。', '/sns/');
                }
                admin_flash_redirect($r['auto'] + $r['manual'] > 0 ? 'ok' : 'error', implode('。', $parts) . '。', '/sns/');
            case 'mark_posted':
                $queueId = (int) ($_POST['queue_id'] ?? 0);
                $postUrl = trim((string) ($_POST['post_url'] ?? ''));
                if ($postUrl !== '' && (filter_var($postUrl, FILTER_VALIDATE_URL) === false || !str_starts_with($postUrl, 'https://'))) {
                    admin_flash_redirect('error', '投稿URLは https:// で始まるURLを入力してください（空欄でも登録できます）。', '/sns/');
                }
                admin_sns_mark_posted($queueId, $postUrl);
                admin_audit('queue_mark_posted', '#' . $queueId, $postUrl);
                admin_flash_redirect('ok', '投稿済にしました。', '/sns/');
            case 'retry':
                $queueId = (int) ($_POST['queue_id'] ?? 0);
                admin_sns_retry($queueId);
                admin_audit('queue_retry', '#' . $queueId);
                admin_flash_redirect('ok', '再試行します（次の毎分の処理で、投稿済みかどうかの確認から始めます）。', '/sns/');
            case 'note_lane_cancel':
                $queueId = (int) ($_POST['queue_id'] ?? 0);
                admin_note_lane_cancel($queueId);
                admin_audit('queue_cancel', '#' . $queueId, 'noteの別枠');
                admin_flash_redirect('ok', 'noteの別枠を取り消しました（ストックは未使用に戻り、また使えます）。', '/sns/');
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
// 表示範囲（昨日〜）より前でも、手動投稿待ち・保留が残っている日は先頭に出す（警告から辿って片付けられるように）
$overdue = admin_db()->prepare(
    "SELECT DISTINCT slot_date FROM post_queue WHERE slot_date < ? AND status IN ('manual_pending', 'held') ORDER BY slot_date"
);
$overdue->execute([$today->modify('-1 day')->format('Y-m-d')]);
$dates = [];
foreach ($overdue->fetchAll(PDO::FETCH_COLUMN) as $date) {
    $dates[] = [new DateTimeImmutable($date), true];
}
for ($i = -1; $i <= 13; $i++) {
    $dates[] = [$today->modify(($i >= 0 ? '+' : '') . $i . ' day'), false];
}
$days = [];
foreach ($dates as [$day, $isOverdue]) {
    $date = $day->format('Y-m-d');
    $rows = admin_sns_slot_rows($date);
    // 差し替えでスキップ・失敗の行（履歴）が残っている場合があるため、枠のストックは最後に作られた行（今の割り当て）のもの
    $days[] = [
        'date'    => $date,
        'overdue' => $isOverdue,
        'rule'    => $rules[(int) $day->format('w')] ?? null,
        'rows'    => $rows,
        'stock'   => $rows !== [] ? admin_stock_get((int) $rows[count($rows) - 1]['stock_id']) : null,
    ];
}

admin_render_header('投稿予定', 'sns_queue');
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
    <strong><?= h(admin_date_label($date, true)) ?></strong><?= $day['overdue'] ? ' <span class="badge badge--held">過去の未処理</span>' : '' ?>
    <?php if ($day['overdue']): ?>
    <?php elseif ($day['rule'] !== null): ?>
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
    <?php foreach ($day['rows'] as $row): $rowStock = (int) $row['stock_id'] === (int) $stock['id'] ? $stock : admin_stock_get((int) $row['stock_id']); ?>
      <div class="slot__row">
        <?php if ($rowStock !== $stock): ?><p class="muted">差し替え前のストック：<?= h($rowStock['title'] ?? '（削除済み）') ?></p><?php endif; ?>
        <p>
          <strong><?= h(admin_sns_label($row['platform'])) ?></strong>
          <?= h(admin_format_time($row['scheduled_at'])) ?>
          <span class="badge badge--<?= h($row['status']) ?>"><?= h(ADMIN_QUEUE_STATUS_LABELS[$row['status']] ?? $row['status']) ?></span>
          <?php if ($row['post_url'] !== null): ?><a href="<?= h($row['post_url']) ?>" rel="noopener noreferrer" target="_blank">投稿を見る</a><?php endif; ?>
        </p>
        <?php if ($row['status'] === 'scheduled'): ?>
          <details class="details"><summary>投稿される本文を見る</summary><pre class="preview"><?= h(admin_stock_render_body($rowStock ?? ['bodies' => []], $row['platform'])) ?></pre></details>
        <?php endif; ?>
        <?php if ($row['status'] === 'manual_pending'): $bodyId = 'body-' . $row['id']; ?>
          <?php if ($row['platform'] === 'note' && ($rowStock['bodies']['note']['title'] ?? null) !== null): ?>
            <p class="muted">noteのタイトル：<?= h($rowStock['bodies']['note']['title']) ?></p>
          <?php endif; ?>
          <textarea class="form__input copy-src" id="<?= h($bodyId) ?>" readonly rows="5"><?= h(admin_stock_render_body($rowStock ?? ['bodies' => []], $row['platform'])) ?></textarea>
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
        <?php if ($row['status'] === 'failed' && $rowStock === $stock && admin_sns_has_publisher($row['platform'])): ?>
          <form method="post" action="<?= h(admin_url('/sns/')) ?>" class="form form--inline"><?= admin_csrf_field() ?><input type="hidden" name="action" value="retry"><input type="hidden" name="queue_id" value="<?= (int) $row['id'] ?>"><button type="submit" class="btn btn--primary">再試行</button></form>
        <?php endif; ?>
        <?php if ($row['status'] === 'posted' && $row['platform'] === 'threads' && (string) $row['external_id'] !== ''): ?>
          <a class="btn btn--ghost" href="<?= h(admin_url('/sns/history?delete=' . (int) $row['id'])) ?>">Threadsから削除</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

    <?php $statuses = array_column($day['rows'], 'status'); $unconfirmed = admin_sns_slot_has_unconfirmed($day['rows']); ?>
    <?php if ($unconfirmed): ?><p class="muted"><?= h(ADMIN_SNS_UNCONFIRMED_MESSAGE) ?>。</p><?php endif; ?>
    <div class="form--inline">
      <?php if (!array_intersect($statuses, ['posted', 'manual_pending', 'sending', 'deleted']) && !$unconfirmed): ?>
        <a class="btn btn--ghost" href="<?= h(admin_url('/sns/?replace=' . $date)) ?>#slot-<?= h($date) ?>">差し替え</a>
      <?php endif; ?>
      <?php if (in_array('held', $statuses, true)): ?>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="post_now"><input type="hidden" name="date" value="<?= h($date) ?>"><button type="submit" class="btn btn--ghost" data-confirm="承認済みの投稿を今から投稿しますか？（Threadsは自動で投稿、noteは手動投稿待ちになります）">承認済みなら今から投稿する</button></form>
      <?php endif; ?>
      <?php if (array_intersect($statuses, ['scheduled', 'held', 'manual_pending'])): ?>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="cancel"><input type="hidden" name="date" value="<?= h($date) ?>"><button type="submit" class="btn btn--ghost" data-confirm="この日の投稿を取り消しますか？（自動では埋め直しません）">取消</button></form>
      <?php endif; ?>
      <?php if (array_intersect($statuses, ['canceled', 'held']) && !array_intersect($statuses, ['posted', 'manual_pending', 'sending', 'deleted']) && !$unconfirmed): ?>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="release"><input type="hidden" name="date" value="<?= h($date) ?>"><button type="submit" class="btn btn--ghost">枠を外してストックに戻す</button></form>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php foreach (admin_note_lane_rows($date) as $lane): ?>
    <div class="slot__row slot__row--lane">
      <p>
        <strong>note（別枠）</strong>
        <a href="<?= h(admin_url('/sns/stock-edit?id=' . (int) $lane['stock_id'])) ?>"><?= h($lane['title']) ?></a>
        <span class="badge badge--<?= h($lane['status']) ?>"><?= h(ADMIN_QUEUE_STATUS_LABELS[$lane['status']] ?? $lane['status']) ?></span>
        <?php if ($lane['post_url'] !== null): ?><a href="<?= h($lane['post_url']) ?>" rel="noopener noreferrer" target="_blank">投稿を見る</a><?php endif; ?>
      </p>
      <?php if (in_array($lane['status'], ['scheduled', 'manual_pending'], true)): ?>
        <p class="muted">本文のコピー・画像・投稿URLの記録は、その日の「今日」画面で行います。</p>
        <form method="post" action="<?= h(admin_url('/sns/')) ?>" class="form form--inline"><?= admin_csrf_field() ?><input type="hidden" name="action" value="note_lane_cancel"><input type="hidden" name="queue_id" value="<?= (int) $lane['id'] ?>"><button type="submit" class="btn btn--ghost" data-confirm="このnoteの別枠を取り消しますか？（同じ日のThreadsには影響しません）">noteの別枠を取消</button></form>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

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
