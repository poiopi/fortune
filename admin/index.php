<?php
declare(strict_types=1);

// 今日（ホーム）：今日の目標・今日の予定・note（コピー・noteを開く・投稿URLの記録）・やること（ADMIN_STAGE2_PROPOSAL.md 3-2）。
// 異常（赤）は全画面共通でヘッダーの下に出る（layout.php）。数字（アクセス・収益）は出さない（段階3の週1ふりかえりで扱う）。
// 段階2でダッシュボードを置き換えた。ダッシュボードにあった区画の移動先は ADMIN_STAGE2_PROPOSAL.md 3-6。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

const TODAY_TODO_VISIBLE = 5;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');
    $now = new DateTimeImmutable('now');
    try {
        if ($action === 'note_record') {
            $url = trim((string) ($_POST['note_url'] ?? ''));
            $message = admin_note_record_manual($url, $now);
            admin_audit('note_record', 'note', $url);
            admin_flash_redirect('ok', $message, '/');
        }
        if ($action === 'note_link') {
            $postId = (int) ($_POST['note_post_id'] ?? 0);
            admin_note_link_to_today($postId, $now);
            admin_audit('note_link', 'note', '#' . $postId);
            admin_flash_redirect('ok', '今日のnoteとして記録しました。', '/');
        }
        if ($action === 'note_set_today') {
            $stockId = (int) ($_POST['stock_id'] ?? 0);
            $approved = admin_note_set_today($stockId, $now);
            if ($approved) {
                admin_audit('stock_approve', '#' . $stockId, '修正なしで承認（今日のnoteにする）');
            }
            admin_audit('note_set_today', '#' . $stockId);
            admin_flash_redirect('ok', ($approved ? '承認して、' : '') . '今日のnoteにしました。下の①〜③で投稿してください。', '/#note');
        }
    } catch (InvalidArgumentException | RuntimeException $e) {
        admin_flash_redirect('error', $e->getMessage(), '/');
    }
    admin_flash_redirect('error', '不明な操作です。', '/');
}

$now = new DateTimeImmutable('now');
$goals = admin_today_goals($now);
$schedule = admin_today_schedule($now);
$todos = admin_today_todos($now);
$noteEnabled = admin_note_enabled();
$noteSlot = admin_note_today_slot($now);
$notePosts = admin_note_posts_on($now->format('Y-m-d'));
$noteUnlinked = admin_note_unlinked_today($now);
$noteChecked = admin_setting('note_rss_checked_at');
$noteDone = $notePosts !== [];
$noteOpenUrl = admin_note_profile_url() ?? ADMIN_SNS_PLATFORMS['note']['open_url'];
$noteImages = $noteSlot !== null ? admin_note_images((int) $noteSlot['stock_id']) : [];
$noteCandidates = $noteEnabled && $noteSlot === null && !$noteDone ? admin_note_candidates(5) : [];

/** 目標メーターの1項目 */
function today_goal_item(string $label, int $count, ?bool $enabled = true): string
{
    if ($enabled === false) {
        return '<li class="goal goal--off"><span class="goal__label">' . h($label) . '</span><span class="goal__count">準備中</span></li>';
    }
    $done = $count >= 1;
    return '<li class="goal' . ($done ? ' goal--done' : '') . '"><span class="goal__mark" aria-hidden="true"></span><span class="goal__label">' . h($label) . '</span>'
        . '<span class="goal__count">' . $count . ' / 1</span><span class="visually-hidden">' . ($done ? '（達成）' : '（まだ）') . '</span></li>';
}

admin_render_header('今日', 'today');
admin_render_flash();
?>
<div class="today-head">
  <p class="today-head__date"><?= h($now->format('n月j日')) ?>（<?= h(ADMIN_WEEKDAY_LABELS[(int) $now->format('w')]) ?>）</p>
  <a class="btn btn--primary" href="<?= h(admin_url('/today-flow')) ?>">今日の作業を始める</a>
</div>

<section class="panel panel--wide">
  <h2 class="panel__title">今日の目標<span class="panel__aside">連続達成 <?= (int) $goals['streak'] ?>日</span></h2>
  <ul class="goals">
    <?= today_goal_item('記事', $goals['articles']) ?>
    <?= today_goal_item('SNS', $goals['sns']) ?>
    <?= today_goal_item('note', $goals['note'], $noteEnabled) ?>
  </ul>
  <p class="muted">記事は、本番のサイトマップに今日増えたページの数です（1時間ごとに確認）。<?= $noteEnabled ? '' : 'noteはIDを設定すると数え始めます（設定 → SNS連携）。' ?></p>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">今日の予定</h2>
<?php if ($schedule === []): ?>
  <p class="muted">今日の投稿の予定はありません。</p>
<?php else: ?>
  <ul class="plan">
<?php foreach ($schedule as $row): ?>
    <li class="plan__row">
      <span class="plan__time"><?= h($row['time'] ?? '時刻なし') ?></span>
      <span class="plan__what"><strong><?= h($row['label']) ?></strong> <span class="badge"><?= h($row['kind']) ?></span> <?= h($row['title']) ?>
        <?php if ($row['head'] !== ''): ?><br><span class="muted"><?= h($row['head']) ?></span><?php endif; ?></span>
      <span class="plan__state"><span class="badge badge--<?= h($row['status']) ?>"><?= h($row['status_label']) ?></span><?= $row['approved'] ? '' : ' <span class="badge badge--pending_review">未承認</span>' ?></span>
    </li>
<?php endforeach; ?>
  </ul>
<?php endif; ?>
  <p><a href="<?= h(admin_url('/sns/')) ?>">これからの投稿予定を見る</a></p>
</section>

<?php if ($noteEnabled): ?>
<section class="panel panel--wide" id="note">
  <h2 class="panel__title">note（今日の分）</h2>
<?php if ($noteDone): ?>
  <p class="status status--ok">今日のnoteは記録済みです。</p>
  <ul class="kv">
<?php foreach ($notePosts as $post): ?>
    <li><?php if ($post['url'] !== null): ?><a href="<?= h($post['url']) ?>" rel="noopener noreferrer" target="_blank"><?= h($post['title'] ?? $post['url']) ?></a><?php else: ?><?= h($post['title'] ?? '（URLなし）') ?><?php endif; ?>
      <span class="muted">（<?= $post['source'] === 'rss' ? '自動で記録' : '手で記録' ?>）</span></li>
<?php endforeach; ?>
  </ul>
<?php if ($noteImages !== [] && !admin_note_slot_is_open($noteSlot)): ?>
  <details class="details">
    <summary>このnoteの画像（入れ忘れたときに保存し直せます）</summary>
    <?= admin_note_render_images($noteImages, (string) ($noteSlot['note_body'] ?? '')) ?>
  </details>
<?php endif; ?>
<?php endif; ?>
<?php foreach ($noteUnlinked as $post): ?>
  <form method="post" action="<?= h(admin_url('/')) ?>" class="form form--inline notice">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="note_link">
    <input type="hidden" name="note_post_id" value="<?= (int) $post['id'] ?>">
    <span>noteの新しい投稿を見つけました：<a href="<?= h($post['url']) ?>" rel="noopener noreferrer" target="_blank"><?= h($post['title'] ?? $post['url']) ?></a></span>
    <button type="submit" class="btn btn--ghost">今日のnote枠に結び付ける</button>
  </form>
<?php endforeach; ?>
<?php if (!$noteDone || admin_note_slot_is_open($noteSlot)): ?>
<?php if ($noteSlot !== null && admin_note_slot_is_open($noteSlot)): ?>
  <p class="step-label">① タイトルと本文をコピーする</p>
  <div class="copy-row">
    <input class="form__input copy-src" id="note-title" type="text" readonly value="<?= h($noteSlot['note_title']) ?>" aria-label="タイトル">
    <button type="button" class="btn btn--ghost" data-copy-target="note-title">タイトルをコピー</button>
  </div>
  <textarea class="form__input copy-src copy-src--body" id="note-body" readonly rows="8" aria-label="本文"><?= h($noteSlot['note_body']) ?></textarea>
  <div class="form--inline">
    <button type="button" class="btn btn--ghost" data-copy-target="note-body">本文をコピー</button>
  </div>
<?php if ($noteImages !== []): ?>
  <p class="step-label">画像を保存する</p>
  <?= admin_note_render_images($noteImages, $noteSlot['note_body']) ?>
<?php else: ?>
  <p class="muted">このストックには画像がありません（<a href="<?= h(admin_url('/sns/stock-edit?id=' . (int) $noteSlot['stock_id'])) ?>#note-images">ストックで画像を付ける</a>）。</p>
<?php endif; ?>
<?php elseif (!$noteDone && $noteCandidates !== []): ?>
  <p class="step-label">① 今日のnoteを選ぶ</p>
  <p class="muted">note用の本文があるストックです。選ぶと、ここにタイトル・本文・画像が出ます。</p>
  <ul class="pick">
<?php foreach ($noteCandidates as $c): $cs = admin_stock_get((int) $c['id']); ?>
    <li class="pick__item">
      <span><span class="badge"><?= h(admin_kind_label($c['kind'])) ?></span> <?= h($cs['bodies']['note']['title'] ?? $c['title']) ?>
        <?php if ($c['status'] !== 'approved'): ?><span class="badge badge--pending_review">未承認</span><?php endif; ?>
        <?php if (admin_note_images((int) $c['id']) === []): ?><span class="muted">（画像なし）</span><?php endif; ?></span>
      <span class="form--inline">
        <a class="btn btn--ghost btn--small" href="<?= h(admin_url('/sns/stock-edit?id=' . (int) $c['id'])) ?>">中身を見る</a>
        <form method="post" action="<?= h(admin_url('/')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="note_set_today"><input type="hidden" name="stock_id" value="<?= (int) $c['id'] ?>"><button type="submit" class="btn btn--primary btn--small"<?= $c['status'] !== 'approved' ? ' data-confirm="このストックは未承認です。承認して今日のnoteにしますか？"' : '' ?>>今日のnoteにする</button></form>
      </span>
    </li>
<?php endforeach; ?>
  </ul>
  <p class="muted">ここに無い記事を自分で書いて投稿したときも、③でURLを記録すれば目標に数えます。</p>
<?php elseif (!$noteDone): ?>
  <p class="step-label">① 書く</p>
  <p>note用の本文があるストックがありません。自分で書いて投稿したときも、URLを記録すれば目標に数えます。</p>
  <div class="form--inline">
    <a class="btn btn--ghost" href="<?= h(admin_url('/sns/stock-edit')) ?>">ストックでnote本文を書く</a>
  </div>
<?php endif; ?>
  <p class="step-label">② noteを開いて、貼り付けて公開する<?= $noteImages !== [] ? '（画像も入れる）' : '' ?></p>
  <p class="muted">本文は空の行に貼り付けます（「### 」の行は小見出しになります）。小見出しが3つ以上なら、書き出しのあとに「＋」→「目次」を入れます。</p>
  <div class="form--inline">
    <a class="btn btn--ghost" href="<?= h($noteOpenUrl) ?>" rel="noopener noreferrer" target="_blank">noteを開く</a>
  </div>
  <form method="post" action="<?= h(admin_url('/')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="note_record">
    <label class="step-label" for="note-url">③ 公開したら、記事のURLを貼る</label>
    <div class="copy-row">
      <input class="form__input form__input--grow" id="note-url" type="url" name="note_url" required placeholder="https://note.com/<?= h((string) admin_note_user_id()) ?>/n/…">
      <button type="submit" class="btn btn--primary">記録する</button>
    </div>
  </form>
<?php endif; ?>
  <p class="muted">自動で拾う：noteの更新情報から1時間ごとに確認します（最後に確認：<?= h($noteChecked === null ? 'まだ' : admin_format_time($noteChecked)) ?>）。拾えたら自分で貼る必要はありません。</p>
</section>
<?php endif; ?>

<section class="panel panel--wide">
  <h2 class="panel__title">やること</h2>
<?php if ($todos === []): ?>
  <p class="muted">やることはありません。</p>
<?php else: ?>
  <ol class="todo">
<?php foreach (array_slice($todos, 0, TODAY_TODO_VISIBLE) as $todo): ?>
    <li class="todo__item"><span><?= h($todo['text']) ?></span><?php if ($todo['link'] !== null): ?> <a class="btn btn--ghost btn--small" href="<?= h(admin_url($todo['link'])) ?>"><?= h($todo['link_label'] ?? '確認する') ?></a><?php endif; ?></li>
<?php endforeach; ?>
  </ol>
<?php if (count($todos) > TODAY_TODO_VISIBLE): ?>
  <details class="details">
    <summary>ほかに<?= count($todos) - TODAY_TODO_VISIBLE ?>件</summary>
    <ol class="todo" start="<?= TODAY_TODO_VISIBLE + 1 ?>">
<?php foreach (array_slice($todos, TODAY_TODO_VISIBLE) as $todo): ?>
      <li class="todo__item"><span><?= h($todo['text']) ?></span><?php if ($todo['link'] !== null): ?> <a class="btn btn--ghost btn--small" href="<?= h(admin_url($todo['link'])) ?>"><?= h($todo['link_label'] ?? '確認する') ?></a><?php endif; ?></li>
<?php endforeach; ?>
    </ol>
  </details>
<?php endif; ?>
<?php endif; ?>
</section>
<?php
admin_render_footer();
