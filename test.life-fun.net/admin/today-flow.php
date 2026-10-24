<?php
declare(strict_types=1);

// 今日の作業（1本道）：異常の確認 → note → SNSの承認 → 終わり を「次へ」で順に進める（ADMIN_STAGE2_PROPOSAL.md 3-3）。
// やることが無い手順は飛ばす。「あとで」で飛ばした手順はその日のうちは飛ばしたまま（セッションに保存）。
// 途中でやめても、次に開くと終わっていない手順から始まる（終わったかどうかは毎回データから判定する）。
// 記事の承認は段階4で SNS の後に足す。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

$now = new DateTimeImmutable('now');
$today = $now->format('Y-m-d');
if (($_SESSION['today_flow']['date'] ?? null) !== $today) {
    $_SESSION['today_flow'] = ['date' => $today, 'skip' => [], 'skip_stock' => [], 'done_logged' => false];
}
$state = &$_SESSION['today_flow'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    try {
        switch ($action) {
            case 'skip':
                $step = (string) ($_POST['step'] ?? '');
                if (in_array($step, ['alerts', 'note'], true)) {
                    $state['skip'][$step] = true;
                }
                admin_redirect('/today-flow');
            case 'note_set_today':
                $stockId = (int) ($_POST['stock_id'] ?? 0);
                $approved = admin_note_set_today($stockId, $now);
                if ($approved) {
                    admin_audit('stock_approve', '#' . $stockId, '修正なしで承認（今日のnoteにする）');
                }
                admin_audit('note_set_today', '#' . $stockId);
                admin_flash_redirect('ok', ($approved ? '承認して、' : '') . '今日のnoteにしました。', '/today-flow');
            case 'note_record':
                $url = trim((string) ($_POST['note_url'] ?? ''));
                $message = admin_note_record_manual($url, $now);
                admin_audit('note_record', 'note', $url);
                admin_flash_redirect('ok', $message, '/today-flow');
            case 'approve':
                $stockId = (int) ($_POST['stock_id'] ?? 0);
                $stock = admin_stock_get($stockId);
                if ($stock === null || $stock['status'] !== 'pending_review') {
                    admin_flash_redirect('error', 'このストックは承認できません（すでに承認済みか、アーカイブ済みです）。', '/today-flow');
                }
                admin_stock_set_status($stockId, 'approved');
                admin_audit('stock_approve', '#' . $stockId, '修正なしで承認（今日の作業）');
                admin_sns_assign();
                admin_flash_redirect('ok', '「' . $stock['title'] . '」を承認しました。', '/today-flow');
            case 'skip_stock':
                $state['skip_stock'][] = (int) ($_POST['stock_id'] ?? 0);
                admin_redirect('/today-flow');
        }
    } catch (InvalidArgumentException | RuntimeException $e) {
        admin_flash_redirect('error', $e->getMessage(), '/today-flow');
    }
    admin_flash_redirect('error', '不明な操作です。', '/today-flow');
}

$alerts = admin_today_alerts($now);
$noteEnabled = admin_note_enabled();
$noteDone = admin_note_posts_on($today) !== [];
$noteSlot = admin_note_today_slot($now);
$unapprovedAll = admin_today_unapproved_stocks($now);
$unapproved = array_values(array_filter(
    $unapprovedAll,
    static fn (array $r): bool => !in_array((int) $r['id'], $state['skip_stock'], true)
));

// 手順：applies＝今日やることがあるか、done＝終わったか（飛ばしたものを含む）
$steps = [
    'alerts' => ['label' => '異常の確認', 'applies' => $alerts !== [], 'done' => !empty($state['skip']['alerts'])],
    'note'   => ['label' => 'noteに投稿する', 'applies' => $noteEnabled, 'done' => $noteDone || !empty($state['skip']['note'])],
    'sns'    => ['label' => 'SNSの承認' . ($unapproved !== [] ? '（' . count($unapproved) . '件）' : ''), 'applies' => $unapprovedAll !== [], 'done' => $unapproved === []],
];
$current = 'finish';
foreach ($steps as $key => $step) {
    if ($step['applies'] && !$step['done']) {
        $current = $key;
        break;
    }
}
$stepKeys = array_keys($steps);
$position = $current === 'finish' ? count($steps) + 1 : array_search($current, $stepKeys, true) + 1;

if ($current === 'finish' && !$state['done_logged']) {
    $state['done_logged'] = true;
    admin_audit('today_flow_done');
}

admin_render_header('今日の作業', 'today_flow');
admin_render_flash();
?>
<ol class="flow-steps" aria-label="手順の一覧">
<?php foreach ($steps as $key => $step): $label = !$step['applies'] ? '対象なし' : ($key === $current ? '今ここ' : ($step['done'] || array_search($key, $stepKeys, true) + 1 < $position ? '済み' : 'これから')); ?>
  <li class="flow-steps__item<?= $key === $current ? ' is-current' : '' ?><?= $label === '済み' || $label === '対象なし' ? ' is-done' : '' ?>"><?= h($step['label']) ?><span class="flow-steps__state"><?= h($label) ?></span></li>
<?php endforeach; ?>
  <li class="flow-steps__item<?= $current === 'finish' ? ' is-current' : '' ?>">終わり</li>
</ol>
<?php if ($current !== 'finish'): ?>
<p class="flow-quit"><a href="<?= h(admin_url('/')) ?>">やめる（「今日」に戻る。次に開くと続きから始まります）</a></p>
<?php endif; ?>

<section class="panel panel--wide flow">
<?php if ($current === 'alerts'): ?>
  <h2 class="panel__title">手順 <?= $position ?>：異常の確認</h2>
  <p>次の異常があります。急ぐものから対応してください（対応は別の画面で行い、終わったらこの画面に戻れば続きから始まります）。</p>
  <ul class="todo">
<?php foreach ($alerts as $alert): ?>
    <li class="todo__item"><span><?= h($alert['text']) ?></span><?php if ($alert['link'] !== null): ?> <a class="btn btn--ghost btn--small" href="<?= h(admin_url($alert['link'])) ?>"><?= h($alert['link_label'] ?? '確認する') ?></a><?php endif; ?></li>
<?php endforeach; ?>
  </ul>
  <form method="post" action="<?= h(admin_url('/today-flow')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="skip">
    <input type="hidden" name="step" value="alerts">
    <button type="submit" class="btn btn--primary">確認したので次へ</button>
  </form>

<?php elseif ($current === 'note'): ?>
  <h2 class="panel__title">手順 <?= $position ?>：noteに投稿する</h2>
<?php if (admin_note_slot_is_open($noteSlot)): ?>
  <p>① タイトルと本文をコピーする</p>
  <div class="copy-row">
    <input class="form__input copy-src" id="flow-note-title" type="text" readonly value="<?= h($noteSlot['note_title']) ?>">
    <button type="button" class="btn btn--ghost" data-copy-target="flow-note-title">タイトルをコピー</button>
  </div>
  <textarea class="form__input copy-src" id="flow-note-body" readonly rows="8"><?= h($noteSlot['note_body']) ?></textarea>
  <div class="form--inline"><button type="button" class="btn btn--ghost" data-copy-target="flow-note-body">本文をコピー</button></div>
  <?= admin_note_render_images(admin_note_images((int) $noteSlot['stock_id']), $noteSlot['note_body']) ?>
<?php elseif (($candidates = admin_note_candidates(5)) !== []): ?>
  <p>① 今日のnoteを選ぶ（選ぶと、タイトル・本文・画像が出ます）</p>
  <ul class="pick">
<?php foreach ($candidates as $c): $cs = admin_stock_get((int) $c['id']); ?>
    <li class="pick__item">
      <span><span class="badge"><?= h(admin_kind_label($c['kind'])) ?></span> <?= h($cs['bodies']['note']['title'] ?? $c['title']) ?><?= $c['status'] !== 'approved' ? ' <span class="badge badge--pending_review">未承認</span>' : '' ?></span>
      <form method="post" action="<?= h(admin_url('/today-flow')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="note_set_today"><input type="hidden" name="stock_id" value="<?= (int) $c['id'] ?>"><button type="submit" class="btn btn--primary btn--small"<?= $c['status'] !== 'approved' ? ' data-confirm="このストックは未承認です。承認して今日のnoteにしますか？"' : '' ?>>今日のnoteにする</button></form>
    </li>
<?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>① 今日のnote本文はストックにありません。自分で書いて投稿したときも、URLを記録すれば目標に数えます。</p>
<?php endif; ?>
  <p>② noteを開いて、貼り付けて公開する</p>
  <p class="muted">本文は空の行に貼り付けます（「### 」の行は小見出しになります）。小見出しが3つ以上なら、書き出しのあとに「＋」→「目次」を入れます。</p>
  <div class="form--inline"><a class="btn btn--ghost" href="<?= h(admin_note_profile_url() ?? ADMIN_SNS_PLATFORMS['note']['open_url']) ?>" rel="noopener noreferrer" target="_blank">noteを開く</a></div>
  <form method="post" action="<?= h(admin_url('/today-flow')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="note_record">
    <label class="form__label" for="flow-note-url">③ 公開したら、記事のURLを貼る</label>
    <input class="form__input" id="flow-note-url" type="url" name="note_url" required placeholder="https://note.com/<?= h((string) admin_note_user_id()) ?>/n/…">
    <p class="muted">貼らなくても、1時間以内にnoteの更新情報から自動で拾います（拾えたらこの手順は「済み」になります）。</p>
    <button type="submit" class="btn btn--primary">記録して次へ</button>
  </form>
  <form method="post" action="<?= h(admin_url('/today-flow')) ?>" class="form form--inline">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="skip">
    <input type="hidden" name="step" value="note">
    <button type="submit" class="btn btn--ghost">あとで（次へ）</button>
  </form>

<?php elseif ($current === 'sns'): $item = $unapproved[0]; $stock = admin_stock_get((int) $item['id']); ?>
  <h2 class="panel__title">手順 <?= $position ?>：SNSの承認（残り <?= count($unapproved) ?>件）</h2>
  <p><?= h(admin_date_label($item['slot_date'], true)) ?> に出る予定の投稿です。本文を読んで、よければ承認してください。</p>
  <p><span class="badge"><?= h(admin_kind_label($stock['kind'])) ?></span> <strong><?= h($stock['title']) ?></strong></p>
<?php foreach ($stock['bodies'] as $platform => $body): ?>
  <p class="form__label"><?= h(admin_sns_label($platform)) ?></p>
  <pre class="preview"><?= h(admin_stock_render_body($stock, $platform)) ?></pre>
<?php endforeach; ?>
  <div class="form--inline">
    <form method="post" action="<?= h(admin_url('/today-flow')) ?>">
      <?= admin_csrf_field() ?>
      <input type="hidden" name="action" value="approve">
      <input type="hidden" name="stock_id" value="<?= (int) $stock['id'] ?>">
      <button type="submit" class="btn btn--primary">承認する</button>
    </form>
    <a class="btn btn--ghost" href="<?= h(admin_url('/sns/stock-edit?id=' . (int) $stock['id'])) ?>">直す（編集画面へ）</a>
    <form method="post" action="<?= h(admin_url('/today-flow')) ?>">
      <?= admin_csrf_field() ?>
      <input type="hidden" name="action" value="skip_stock">
      <input type="hidden" name="stock_id" value="<?= (int) $stock['id'] ?>">
      <button type="submit" class="btn btn--ghost">今日は見ない（次へ）</button>
    </form>
  </div>
  <p class="muted">「今日は見ない」にした投稿は、承認されないまま投稿時刻になると保留になります。</p>

<?php else: $goals = admin_today_goals($now); ?>
  <h2 class="panel__title">今日の作業は終わりです</h2>
  <p>今日の目標：<?= h(admin_today_goal_text($goals)) ?></p>
<?php if (!$goals['achieved']): ?>
  <p class="muted">まだ数に入っていない目標があります。記事は公開してサイトマップに載ると、SNSは投稿時刻に出ると数えられます。</p>
<?php endif; ?>
<?php $tomorrow = admin_today_schedule($now->modify('+1 day')); ?>
  <h3 class="panel__subtitle">明日の予定</h3>
<?php if ($tomorrow === []): ?>
  <p class="muted">明日の投稿の予定はありません。</p>
<?php else: ?>
  <ul class="kv">
<?php foreach ($tomorrow as $row): ?>
    <li><?= h($row['time'] ?? '時刻なし') ?> <?= h($row['label']) ?>「<?= h($row['title']) ?>」<?= $row['approved'] ? '' : '（未承認）' ?></li>
<?php endforeach; ?>
  </ul>
<?php endif; ?>
  <p><a class="btn btn--primary" href="<?= h(admin_url('/')) ?>">「今日」に戻る</a></p>
<?php endif; ?>
</section>
<?php
admin_render_footer();
