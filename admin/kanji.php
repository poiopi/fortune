<?php
declare(strict_types=1);

// 姓名判断の漢字：まとめてチェック → 反映待ちに追加 → 差し替え用 js/seimei-kanji.js を出力。未登録だった字の一覧。

require_once __DIR__ . '/../_admin-lib/bootstrap.php';

admin_require_login();

$current = admin_seimei_kanji_current();
$text = '';
$checked = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $action = (string) ($_POST['action'] ?? '');

    if ($current === null && $action !== 'unknown') {
        admin_flash_redirect('error', 'サーバー上の画数表（js/seimei-kanji.js）が読めません。先にファイルをアップロードしてください。', '/kanji');
    }

    if ($action === 'check' || $action === 'add') {
        $text = (string) ($_POST['text'] ?? '');
        $checked = admin_seimei_kanji_check($text, $current);
        if ($action === 'add') {
            $n = admin_seimei_kanji_add($checked, isset($_POST['overwrite']));
            if ($n > 0) {
                $chars = implode('', array_column(array_filter($checked, static fn (array $r): bool => $r['result'] === 'new' || (isset($_POST['overwrite']) && $r['result'] === 'differs')), 'ch'));
                admin_audit('kanji_add', null, $n . '字：' . $chars);
            }
            admin_flash_redirect($n > 0 ? 'ok' : 'error', $n > 0 ? $n . '字を反映待ちに追加しました。' : '追加できる字がありませんでした。', '/kanji');
        }
    } elseif ($action === 'remove') {
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = admin_db()->prepare("SELECT ch FROM kanji_additions WHERE id = ? AND status = 'pending'");
        $stmt->execute([$id]);
        $ch = $stmt->fetchColumn();
        if ($ch !== false) {
            admin_db()->prepare('DELETE FROM kanji_additions WHERE id = ?')->execute([$id]);
            admin_audit('kanji_remove', (string) $ch);
        }
        admin_flash_redirect('ok', '反映待ちから外しました。', '/kanji');
    } elseif ($action === 'export') {
        $pending = (int) admin_db()->query("SELECT COUNT(*) FROM kanji_additions WHERE status = 'pending'")->fetchColumn();
        admin_audit('kanji_export', null, '反映待ち' . $pending . '字');
        header('Content-Type: application/javascript; charset=utf-8');
        header('Content-Disposition: attachment; filename="seimei-kanji.js"');
        echo admin_seimei_kanji_render(admin_seimei_kanji_merged($current));
        exit;
    } elseif ($action === 'unknown') {
        $ch = (string) ($_POST['ch'] ?? '');
        $to = (string) ($_POST['to'] ?? '');
        if (in_array($to, ['ignored', 'open'], true)) {
            admin_db()->prepare('UPDATE unknown_kanji SET status = ? WHERE ch = ?')->execute([$to, $ch]);
            admin_audit('unknown_kanji', $ch, ADMIN_UNKNOWN_KANJI_STATUS_LABELS[$to]);
        }
        admin_flash_redirect('ok', '「' . $ch . '」を「' . ADMIN_UNKNOWN_KANJI_STATUS_LABELS[$to] . '」にしました。', '/kanji');
    } else {
        admin_flash_redirect('error', '不明な操作です。', '/kanji');
    }
}

if ($current !== null) {
    admin_seimei_kanji_sync_reflected($current);
    // すでに表に入っている字は、未登録の一覧から外す
    foreach (admin_db()->query("SELECT ch FROM unknown_kanji WHERE status = 'open'")->fetchAll(PDO::FETCH_COLUMN) as $ch) {
        if (isset($current[$ch])) {
            admin_db()->prepare("UPDATE unknown_kanji SET status = 'added' WHERE ch = ?")->execute([$ch]);
        }
    }
}
if ($text === '' && isset($_GET['prefill'])) {
    $chars = preg_split('//u', (string) $_GET['prefill'], -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $text = implode("\n", array_map(static fn (string $c): string => $c . ' ', array_slice(array_unique($chars), 0, ADMIN_KANJI_MAX_LINES)));
}

$pendingRows = admin_db()->query("SELECT * FROM kanji_additions WHERE status = 'pending' ORDER BY id")->fetchAll();
$reflectedRows = admin_db()->query("SELECT * FROM kanji_additions WHERE status = 'reflected' ORDER BY reflected_at DESC LIMIT 50")->fetchAll();
$unknownRows = admin_db()->query("SELECT * FROM unknown_kanji WHERE status = 'open' ORDER BY count DESC, last_seen DESC LIMIT 200")->fetchAll();

admin_render_header('姓名判断の漢字', 'kanji');
admin_render_flash();
?>
<?php if ($current === null): ?>
  <p class="alert alert--error">サーバー上の画数表（js/seimei-kanji.js）が読めません。ファイルがアップロードされているか確認してください。</p>
<?php else: ?>
  <p class="muted">サーバー上の画数表：<?= count($current) ?>字（この環境の js/seimei-kanji.js）。画数は一般的な字画数（新字体）で数えます。「々」は表に入れず、直前の字と同じ画数で数えます。</p>
<?php endif; ?>

<section class="panel panel--wide">
  <h2 class="panel__title">1. まとめてチェック</h2>
  <form method="post" action="<?= h(admin_url('/kanji')) ?>" class="form">
    <?= admin_csrf_field() ?>
    <label class="form__label" for="text">1行に「字 画数」（例：凪 6）。<?= ADMIN_KANJI_MAX_LINES ?>行まで</label>
    <textarea class="form__input" id="text" name="text" rows="10" placeholder="凪 6&#10;琥 12"><?= h($text) ?></textarea>
    <div class="form--inline">
      <button type="submit" name="action" value="check" class="btn btn--ghost">チェックする</button>
    </div>
  </form>

  <?php if ($checked !== null): $addable = count(array_filter($checked, static fn (array $r): bool => $r['result'] === 'new')); $differs = count(array_filter($checked, static fn (array $r): bool => $r['result'] === 'differs')); ?>
    <div class="table-wrap table-wrap--spaced">
      <table class="table">
        <thead><tr><th>行</th><th>字</th><th>画数</th><th>結果</th></tr></thead>
        <tbody>
        <?php foreach ($checked as $r): ?>
          <tr class="<?= $r['result'] === 'new' ? '' : ($r['result'] === 'differs' ? 'is-warn' : 'is-muted') ?>">
            <td><?= (int) $r['line'] ?></td>
            <td class="kanji-cell"><?= h($r['ch'] ?? $r['raw']) ?></td>
            <td><?= $r['strokes'] !== null ? (int) $r['strokes'] : '—' ?></td>
            <td>
              <?= h(ADMIN_KANJI_RESULT_LABELS[$r['result']]) ?>
              <?php if ($r['result'] === 'differs'): ?>（今の表では <?= (int) $r['current'] ?> 画）<?php endif; ?>
              <?php if ($r['result'] === 'pending'): ?>（反映待ちでは <?= (int) $r['pending'] ?> 画）<?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <form method="post" action="<?= h(admin_url('/kanji')) ?>" class="form">
      <?= admin_csrf_field() ?>
      <input type="hidden" name="text" value="<?= h($text) ?>">
      <?php if ($differs > 0): ?>
        <label class="check"><input type="checkbox" name="overwrite" value="1"> 「画数が違います」の <?= $differs ?> 字も、入力した画数で登録する（表の修正）</label>
      <?php endif; ?>
      <div class="form--inline">
        <button type="submit" name="action" value="add" class="btn btn--primary"<?= $addable + $differs === 0 ? ' disabled' : '' ?>>「追加できます」の <?= $addable ?> 字を反映待ちに追加</button>
      </div>
    </form>
  <?php endif; ?>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">2. 反映待ち（<?= count($pendingRows) ?>字）</h2>
  <?php if ($pendingRows === []): ?>
    <p class="muted">ありません。</p>
  <?php else: ?>
    <div class="table-wrap">
      <table class="table">
        <thead><tr><th>字</th><th>画数</th><th>メモ</th><th>追加日時</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($pendingRows as $r): ?>
          <tr>
            <td class="kanji-cell"><?= h($r['ch']) ?></td>
            <td><?= (int) $r['strokes'] ?></td>
            <td><?= h($r['note']) ?></td>
            <td class="nowrap"><?= h(admin_format_time($r['created_at'])) ?></td>
            <td><form method="post" action="<?= h(admin_url('/kanji')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="remove"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><button type="submit" class="btn btn--ghost">外す</button></form></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <form method="post" action="<?= h(admin_url('/kanji')) ?>" class="form">
      <?= admin_csrf_field() ?>
      <input type="hidden" name="action" value="export">
      <div class="form--inline">
        <button type="submit" class="btn btn--primary">差し替え用の seimei-kanji.js をダウンロード</button>
      </div>
      <p class="muted">ダウンロードしたファイルは、リポジトリの js/seimei-kanji.js と差し替えて、検証環境 → 本番の順で反映します。サーバー上のファイルに入ると、この画面を開いたときに自動で「反映済み」になります。</p>
    </form>
  <?php endif; ?>
</section>

<section class="panel panel--wide">
  <h2 class="panel__title">3. 入力されたが未登録だった字（<?= count($unknownRows) ?>字）</h2>
  <p class="muted">姓名判断で入力されて「未対応」になった字です（回数の多い順）。画数を調べてから「追加候補へ」でチェック欄に送れます。</p>
  <?php if ($unknownRows === []): ?>
    <p class="muted">ありません。</p>
  <?php else: ?>
    <p><a class="btn btn--ghost" href="<?= h(admin_url('/kanji?prefill=' . rawurlencode(implode('', array_column($unknownRows, 'ch'))))) ?>#text">全部をチェック欄に送る</a></p>
    <div class="table-wrap">
      <table class="table">
        <thead><tr><th>字</th><th>回数</th><th>最後</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($unknownRows as $r): ?>
          <tr>
            <td class="kanji-cell"><?= h($r['ch']) ?></td>
            <td><?= (int) $r['count'] ?></td>
            <td class="nowrap"><?= h(admin_format_time($r['last_seen'])) ?></td>
            <td><div class="form--inline form--tight">
              <a class="btn btn--ghost" href="<?= h(admin_url('/kanji?prefill=' . rawurlencode($r['ch']))) ?>#text">追加候補へ</a>
              <form method="post" action="<?= h(admin_url('/kanji')) ?>"><?= admin_csrf_field() ?><input type="hidden" name="action" value="unknown"><input type="hidden" name="ch" value="<?= h($r['ch']) ?>"><input type="hidden" name="to" value="ignored"><button type="submit" class="btn btn--ghost">対象外にする</button></form>
            </div></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</section>

<?php if ($reflectedRows !== []): ?>
<section class="panel panel--wide">
  <h2 class="panel__title">反映済み（最近の50字）</h2>
  <p><?php foreach ($reflectedRows as $r): ?><span class="badge"><?= h($r['ch']) ?> <?= (int) $r['strokes'] ?>画</span> <?php endforeach; ?></p>
</section>
<?php endif; ?>
<?php
admin_render_footer();
