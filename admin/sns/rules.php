<?php
declare(strict_types=1);

// 書いて出す → 投稿のルール：確認モード／自動モード・曜日ごとのローテーション・確認モードの目安（直近14日）。
// 段階2で設定画面（投稿モード・ローテーション）とダッシュボード（確認モードの目安）から移した。

require_once __DIR__ . '/../../_admin-lib/bootstrap.php';

admin_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');

    if ($action === 'save_post_mode') {
        $mode = (string) ($_POST['post_mode'] ?? '');
        if (!in_array($mode, ['review', 'auto'], true)) {
            admin_flash_redirect('error', '投稿モードの値が正しくありません。', '/sns/rules');
        }
        admin_set_setting('post_mode', $mode);
        admin_audit('settings_post_mode', null, $mode === 'review' ? '確認モード' : '自動モード');
        admin_flash_redirect('ok', '投稿モードを保存しました。', '/sns/rules');
    }

    if ($action === 'save_rotation') {
        $kinds = admin_post_kinds(true);
        $allowedPlatforms = admin_sns_rotation_platforms();
        $update = admin_db()->prepare('UPDATE rotation_rules SET kind = ?, post_time = ?, platforms = ?, active = ? WHERE weekday = ?');
        $summary = [];
        admin_db()->exec('BEGIN IMMEDIATE');
        try {
            foreach (range(0, 6) as $weekday) {
                $row = $_POST['rotation'][$weekday] ?? [];
                $kind = (string) ($row['kind'] ?? '');
                $time = (string) ($row['time'] ?? '');
                $platforms = array_values(array_intersect($allowedPlatforms, (array) ($row['platforms'] ?? [])));
                $active = isset($row['active']);
                if (!isset($kinds[$kind]) || preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $time) !== 1) {
                    throw new InvalidArgumentException(ADMIN_WEEKDAY_LABELS[$weekday] . '曜日の種別または時刻が正しくありません。');
                }
                if ($active && $platforms === []) {
                    throw new InvalidArgumentException(ADMIN_WEEKDAY_LABELS[$weekday] . '曜日の投稿先を1つ以上選んでください。');
                }
                $update->execute([$kind, $time, json_encode($platforms), $active ? 1 : 0, $weekday]);
                $summary[] = ADMIN_WEEKDAY_LABELS[$weekday] . ':' . ($active ? $kinds[$kind]['label'] . ' ' . $time : '休み');
            }
            admin_db()->exec('COMMIT');
        } catch (InvalidArgumentException $e) {
            admin_db()->exec('ROLLBACK');
            admin_flash_redirect('error', $e->getMessage(), '/sns/rules');
        }
        $reset = isset($_POST['reset_future']);
        if ($reset) {
            admin_sns_reset_future_rotation();
        }
        $assigned = admin_sns_assign();
        admin_audit('rotation_change', null, implode(' ', $summary) . ($reset ? '（未投稿の自動割り当てをやり直し）' : ''));
        admin_flash_redirect('ok', 'ローテーションを保存しました。' . ($reset ? '未投稿の自動割り当てをやり直しました（' . $assigned . '枠）。' : '新しい設定は、まだ割り当てられていない日から使われます。'), '/sns/rules');
    }

    admin_flash_redirect('error', '不明な操作です。', '/sns/rules');
}

$postMode = admin_post_mode();
$rotation = admin_rotation_rules(false);
// 自動モード切替の目安：直近14日に承認した（手書き以外の）ストックの数と、そのうち修正したものの数
$reviewStmt = admin_db()->prepare("SELECT COUNT(*) AS approved, COALESCE(SUM(edited), 0) AS edited FROM post_stock WHERE approved_at > ? AND source <> 'manual'");
$reviewStmt->execute([(new DateTimeImmutable('-14 days'))->format(DATE_ATOM)]);
$review = $reviewStmt->fetch();

admin_render_header('投稿のルール', 'sns_rules');
admin_render_flash();
?>
<section class="panel panel--wide">
  <h2 class="panel__title">確認モード／自動モード</h2>
  <p class="muted">確認モードでは、承認したストックだけが投稿されます（未承認のまま投稿時刻になると保留）。自動モードでは、取り込んだストックがそのまま投稿対象になります。</p>
  <p>直近14日：承認 <?= (int) $review['approved'] ?> 件 ／ うち修正あり <?= (int) $review['edited'] ?> 件<span class="muted">（目安：修正ゼロが2週間続いたら、自動モードへの切り替えを検討）</span></p>
  <form method="post" action="<?= h(admin_url('/sns/rules')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_post_mode">
    <label class="check"><input type="radio" name="post_mode" value="review"<?= $postMode === 'review' ? ' checked' : '' ?>> 確認モード（投稿前に自分で確認・承認する）</label>
    <label class="check"><input type="radio" name="post_mode" value="auto"<?= $postMode === 'auto' ? ' checked' : '' ?>> 自動モード（確認せずに投稿する）</label>
    <button type="submit" class="btn btn--primary">投稿モードを保存</button>
  </form>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">曜日ごとの投稿（ローテーション）</h2>
  <p class="muted">曜日ごとに、投稿する種別・時刻・投稿先を決めます（1日1枠）。noteは、ストックにnote用の本文があるときだけ自動で加わります。</p>
  <form method="post" action="<?= h(admin_url('/sns/rules')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <input type="hidden" name="action" value="save_rotation">
    <?php $rotationKinds = admin_post_kinds(true); ?>
    <?php foreach ([1, 2, 3, 4, 5, 6, 0] as $weekday): $rule = $rotation[$weekday] ?? ['kind' => array_key_first($rotationKinds), 'post_time' => '20:00', 'platforms' => [], 'active' => 0]; ?>
      <div class="rotation-row">
        <strong><?= h(ADMIN_WEEKDAY_LABELS[$weekday]) ?></strong>
        <select class="form__input" name="rotation[<?= $weekday ?>][kind]" aria-label="<?= h(ADMIN_WEEKDAY_LABELS[$weekday]) ?>曜日の種別">
          <?php foreach ($rotationKinds as $key => $k): ?><option value="<?= h($key) ?>"<?= $rule['kind'] === $key ? ' selected' : '' ?>><?= h($k['label']) ?></option><?php endforeach; ?>
        </select>
        <input class="form__input" type="time" name="rotation[<?= $weekday ?>][time]" value="<?= h($rule['post_time']) ?>" aria-label="<?= h(ADMIN_WEEKDAY_LABELS[$weekday]) ?>曜日の時刻" required>
        <span>
          <?php foreach (admin_sns_rotation_platforms() as $platform): ?>
            <label class="check"><input type="checkbox" name="rotation[<?= $weekday ?>][platforms][]" value="<?= h($platform) ?>"<?= in_array($platform, $rule['platforms'], true) ? ' checked' : '' ?>> <?= h(admin_sns_label($platform)) ?></label>
          <?php endforeach; ?>
        </span>
        <label class="check"><input type="checkbox" name="rotation[<?= $weekday ?>][active]" value="1"<?= (int) $rule['active'] === 1 ? ' checked' : '' ?>> 投稿する</label>
      </div>
    <?php endforeach; ?>
    <label class="check"><input type="checkbox" name="reset_future" value="1"> すでに自動で割り当て済みの未投稿分も、新しい設定で割り当て直す</label>
    <button type="submit" class="btn btn--primary">ローテーションを保存</button>
  </form>
</section>
<?php
admin_render_footer();
