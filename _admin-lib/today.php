<?php
declare(strict_types=1);

/**
 * _admin-lib/today.php
 *
 * 「今日」画面（ADMIN_STAGE2_PROPOSAL.md 3-2・3-3）の材料：異常とやること・今日の目標・今日の予定・1本道の手順。
 * 朝のまとめ通知（notify.php）も同じ関数で作る（画面と通知で書いてあることを揃える）。
 *
 * 目標（記事1・SNS1・note1）の数え方：
 *   - SNS：その日に投稿済みになった note 以外の投稿（post_queue）
 *   - note：その日に出した記事の記録（note_posts）
 *   - 記事：その日に本番の sitemap.xml に新しく増えたURL（ページ台帳 pages.first_seen）。管理画面に記事の機能ができるまで（段階4）の代わり。
 *     毎時の照合で見つけるので最大1時間遅れる。初回の照合（設定キー pages_baseline_at）より前からあるページは数えない
 */

/**
 * 異常（kind=alert：全画面の上部に赤で出す）とやること（kind=todo：「今日」画面と朝のまとめだけ）。
 * 各項目：text・link・link_label・kind・category（朝のまとめの区分。notify.php）・priority（小さいほど上）
 */
function admin_status_items(?DateTimeImmutable $now = null): array
{
    $now ??= new DateTimeImmutable('now');
    $db = admin_db();
    $items = [];
    $add = static function (string $kind, string $category, int $priority, string $text, ?string $link, ?string $linkLabel = null) use (&$items): void {
        $items[] = ['kind' => $kind, 'category' => $category, 'priority' => $priority, 'text' => $text, 'link' => $link, 'link_label' => $linkLabel];
    };

    // 異常（赤）
    $cron = admin_cron_health();
    if ($cron['state'] === 'never') {
        $add('alert', 'site', 1, '自動実行（cron）がまだ一度も動いていません（ロリポップのcron設定が未登録の可能性があります）。', '/cron');
    } elseif ($cron['state'] === 'stale') {
        $add('alert', 'site', 1, '自動実行（cron）が' . ADMIN_CRON_STALE_MINUTES . '分以上動いていません（最終実行：' . admin_format_time($cron['last']) . '）。', '/cron');
    }
    $threads = admin_threads_account();
    $tokenDays = null;
    if ($threads['status'] === 'error') {
        $add('alert', 'sns', 2, 'Threadsの連携が切れています。自動投稿は止まっています（投稿時刻が来た枠はスキップされます）。', '/sns/accounts', '連携し直す');
    } elseif ($threads['status'] === 'connected' && $threads['token_expires_at'] !== null) {
        $tokenDays = (int) floor(((new DateTimeImmutable($threads['token_expires_at']))->getTimestamp() - $now->getTimestamp()) / 86400);
        if ($tokenDays <= ADMIN_HEALTH_TOKEN_RED_DAYS) {
            $add('alert', 'sns', 2, 'Threadsのトークンの期限まで残り' . max(0, $tokenDays) . '日です。期限を過ぎると自動投稿が止まります。', '/sns/accounts', '更新・連携し直す');
        }
    }
    $unconfirmed = admin_threads_unconfirmed_sending_count();
    if ($unconfirmed > 0) {
        $add('alert', 'sns', 3, '公開確認待ちの投稿が' . $unconfirmed . '件あります（連携し直すと自動で確認します）。', '/sns/accounts', '連携し直す');
    }
    $failedPosts = (int) $db->query("SELECT COUNT(*) FROM post_queue WHERE status = 'failed' AND slot_date >= date('now', 'localtime', '-7 days')")->fetchColumn();
    if ($failedPosts > 0) {
        $add('alert', 'sns', 3, '自動投稿に失敗した投稿が' . $failedPosts . '件あります（直近7日）。', '/sns/history', '履歴で再試行する');
    }
    $redHealth = $db->query("SELECT check_key FROM health_checks WHERE status = 'red'")->fetchAll(PDO::FETCH_COLUMN);
    if ($redHealth !== []) {
        $add('alert', 'site', 1, 'サイトの見回りで問題が見つかっています：' . implode('、', array_map(static fn (string $k): string => ADMIN_HEALTH_LABELS[$k] ?? $k, $redHealth)), '/health');
    }
    if (admin_notify_channels() === []) {
        $add('alert', 'site', 4, '通知先が1つも有効になっていません。異常が起きても通知されません。', '/settings', '通知先を設定する');
    }

    // やること
    if (admin_post_mode() === 'review') {
        $stmt = $db->prepare(
            "SELECT COUNT(DISTINCT q.slot_date) FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
             WHERE q.status = 'scheduled' AND s.status <> 'approved' AND q.slot_date <= ?"
        );
        $stmt->execute([$now->modify('+1 day')->format('Y-m-d')]);
        $n = (int) $stmt->fetchColumn();
        if ($n > 0) {
            $add('todo', 'sns', 10, '今日・明日の投稿に、未承認のものが' . $n . '枠あります（承認しないと投稿時刻に保留になります）。', '/today-flow', '承認する');
        }
    }
    if ($tokenDays !== null && $tokenDays > ADMIN_HEALTH_TOKEN_RED_DAYS && $tokenDays <= ADMIN_HEALTH_TOKEN_WARN_DAYS) {
        $add('todo', 'sns', 11, 'Threadsのトークンの期限まで残り' . $tokenDays . '日です（毎日の自動更新が失敗している可能性があります）。', '/sns/accounts', '確認する');
    }
    $held = (int) $db->query("SELECT COUNT(DISTINCT slot_date) FROM post_queue WHERE status = 'held' AND slot_date >= date('now', 'localtime', '-7 days')")->fetchColumn();
    if ($held > 0) {
        $add('todo', 'sns', 12, '未承認のため保留になった投稿が' . $held . '枠あります（直近7日）。', '/sns/', '投稿予定を開く');
    }
    // 今日のnote枠は「今日」画面のnoteの区画で扱うので、ここでは前日までに残っているものだけ
    $stmt = $db->prepare("SELECT COUNT(*) FROM post_queue WHERE status = 'manual_pending' AND NOT (platform = 'note' AND slot_date = ?)");
    $stmt->execute([$now->format('Y-m-d')]);
    $manual = (int) $stmt->fetchColumn();
    if ($manual > 0) {
        $add('todo', 'sns', 13, '手動投稿待ちが' . $manual . '件残っています。', '/sns/', '投稿予定を開く');
    }
    $empty = admin_sns_empty_slots($now);
    if ($empty !== []) {
        $add('todo', 'sns', 20, '割り当てるストックが無い日があります：' . implode('、', array_map(static fn (array $e): string => admin_date_label($e['date']) . admin_kind_label($e['kind']), $empty)), '/sns/stock', 'ストックを足す');
    }
    foreach (admin_sns_stock_days_left() as $k) {
        if ($k['per_week'] > 0 && $k['days'] < ADMIN_STOCK_LOW_DAYS) {
            $add('todo', 'sns', 21, $k['label'] . 'のストックが残り' . $k['count'] . '件（約' . $k['days'] . '日分）です。', '/sns/stock', 'ストックを足す');
        }
    }
    $openErrors = (int) $db->query("SELECT COUNT(*) FROM client_errors WHERE status = 'open'")->fetchColumn();
    if ($openErrors > 0) {
        $add('todo', 'js', 30, '公開ページのJSエラーが' . $openErrors . '種類、未対応のままです。', '/errors', '見る');
    }
    $staleIssues = admin_issue_stale_count();
    if ($staleIssues > 0) {
        $add('todo', 'plan', 31, '重要度「高」の不具合が' . $staleIssues . '件、' . ADMIN_ISSUE_STALE_DAYS . '日以上更新されていません。', '/issues', '見る');
    }
    $noteError = (string) admin_setting('note_rss_error');
    if (admin_note_enabled() && $noteError !== '') {
        $add('todo', 'plan', 35, 'noteの更新情報を読めませんでした（' . $noteError . '）。投稿URLは手で記録できます。', '/sns/accounts', '確認する');
    }
    if (!admin_2fa_enabled()) {
        $add('todo', 'plan', 40, '2段階認証が未設定です。パスワードが漏れたときに備えて設定してください。', '/two-factor', '設定する');
    }

    usort($items, static fn (array $a, array $b): int => $a['priority'] <=> $b['priority']);
    return $items;
}

function admin_today_alerts(?DateTimeImmutable $now = null): array
{
    return array_values(array_filter(admin_status_items($now), static fn (array $i): bool => $i['kind'] === 'alert'));
}

function admin_today_todos(?DateTimeImmutable $now = null): array
{
    return array_values(array_filter(admin_status_items($now), static fn (array $i): bool => $i['kind'] === 'todo'));
}

/** 指定日の目標の数：['date', 'articles', 'sns', 'note', 'note_enabled', 'achieved'] */
function admin_today_count(string $date, bool $noteEnabled): array
{
    $db = admin_db();
    $sns = $db->prepare("SELECT COUNT(*) FROM post_queue WHERE platform <> 'note' AND status IN ('posted', 'deleted') AND substr(posted_at, 1, 10) = ?");
    $sns->execute([$date]);
    $note = $db->prepare('SELECT COUNT(*) FROM note_posts WHERE posted_on = ?');
    $note->execute([$date]);
    $articles = 0;
    $baseline = admin_setting('pages_baseline_at');
    if ($baseline !== null) {
        $stmt = $db->prepare('SELECT COUNT(*) FROM pages WHERE in_sitemap = 1 AND substr(first_seen, 1, 10) = ? AND first_seen > ?');
        $stmt->execute([$date, $baseline]);
        $articles = (int) $stmt->fetchColumn();
    }
    $result = ['date' => $date, 'articles' => $articles, 'sns' => (int) $sns->fetchColumn(), 'note' => (int) $note->fetchColumn(), 'note_enabled' => $noteEnabled];
    $result['achieved'] = $result['articles'] >= 1 && $result['sns'] >= 1 && (!$noteEnabled || $result['note'] >= 1);
    return $result;
}

/** 今日の目標 ＋ 連続達成日数（streak：今日を含め、3つとも（noteを使わない日は2つ）達成した日が続いている日数） */
function admin_today_goals(?DateTimeImmutable $now = null): array
{
    $now ??= new DateTimeImmutable('now');
    $goals = admin_today_count($now->format('Y-m-d'), admin_note_enabled());
    $streak = $goals['achieved'] ? 1 : 0;
    $stmt = admin_db()->prepare('SELECT goal_date, achieved FROM daily_goals WHERE goal_date < ? ORDER BY goal_date DESC LIMIT 400');
    $stmt->execute([$goals['date']]);
    $expected = $now->modify('-1 day')->format('Y-m-d');
    foreach ($stmt->fetchAll() as $row) {
        if ($row['goal_date'] !== $expected || (int) $row['achieved'] !== 1) {
            break;
        }
        $streak++;
        $expected = (new DateTimeImmutable($expected))->modify('-1 day')->format('Y-m-d');
    }
    $goals['streak'] = $streak;
    return $goals;
}

function admin_today_save_goals(string $date, bool $noteEnabled): void
{
    $g = admin_today_count($date, $noteEnabled);
    admin_db()->prepare(
        'INSERT INTO daily_goals (goal_date, articles, sns, note, note_enabled, achieved, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)
         ON CONFLICT(goal_date) DO UPDATE SET articles = excluded.articles, sns = excluded.sns, note = excluded.note,
           note_enabled = excluded.note_enabled, achieved = excluded.achieved, updated_at = excluded.updated_at'
    )->execute([$date, $g['articles'], $g['sns'], $g['note'], $noteEnabled ? 1 : 0, $g['achieved'] ? 1 : 0, admin_now()]);
}

/**
 * 毎時：ページ台帳と sitemap の照合（記事の目標）→ noteのRSS → 昨日と今日の目標を記録。
 * どれかが失敗しても残りは続ける（SNSの割り当てなど同じ毎時ジョブの他の処理を止めない）。戻り値：cronの記録用の短い文
 */
function admin_today_hourly(?DateTimeImmutable $now = null): string
{
    $now ??= new DateTimeImmutable('now');
    $messages = [];
    try {
        $first = admin_setting('pages_baseline_at') === null;
        $sync = admin_pages_sync();
        if ($first) {
            // 初回の照合で台帳に入ったページは「今日増えた」に数えない
            admin_set_setting('pages_baseline_at', admin_now());
        }
        $messages[] = '台帳とsitemapの照合 ' . $sync['total'] . '件';
    } catch (Throwable $e) {
        $messages[] = '台帳とsitemapの照合に失敗（' . $e->getMessage() . '）';
    }
    try {
        $messages[] = admin_note_rss_tick($now);
    } catch (Throwable $e) {
        $messages[] = 'note：' . $e->getMessage();
    }
    // 前日の分は日付をまたいだ直後に確定する（23時台の投稿を取りこぼさないよう、毎回昨日も数え直す）。noteを使うかは今の設定で記録する
    $noteEnabled = admin_note_enabled();
    admin_today_save_goals($now->modify('-1 day')->format('Y-m-d'), $noteEnabled);
    admin_today_save_goals($now->format('Y-m-d'), $noteEnabled);
    return implode('、', $messages);
}

/**
 * 今日の予定（時刻順）：['time', 'platform', 'label', 'kind', 'title', 'head', 'status', 'status_label', 'approved']
 * note の枠は時刻なし（いつ投稿してもよい）として先頭に置かず、最後に出す
 */
function admin_today_schedule(?DateTimeImmutable $now = null): array
{
    $now ??= new DateTimeImmutable('now');
    $stmt = admin_db()->prepare(
        "SELECT q.*, s.title, s.kind, s.status AS stock_status FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
         WHERE q.slot_date = ? AND q.status NOT IN ('canceled', 'skipped') ORDER BY q.platform = 'note', q.scheduled_at, q.id"
    );
    $stmt->execute([$now->format('Y-m-d')]);
    $rows = [];
    foreach ($stmt->fetchAll() as $row) {
        $stock = admin_stock_get((int) $row['stock_id']);
        $body = $stock !== null ? admin_stock_render_body($stock, $row['platform']) : '';
        $rows[] = [
            'time'         => $row['platform'] === 'note' ? null : substr(admin_format_time($row['scheduled_at']), 11, 5),
            'platform'     => $row['platform'],
            'label'        => admin_sns_label($row['platform']),
            'kind'         => admin_kind_label($row['kind']),
            'title'        => $row['title'],
            'head'         => mb_strimwidth(preg_replace('/\s+/u', ' ', $body) ?? '', 0, 60, '…'),
            'status'       => $row['status'],
            'status_label' => ADMIN_QUEUE_STATUS_LABELS[$row['status']] ?? $row['status'],
            'approved'     => $row['stock_status'] === 'approved',
            'post_url'     => $row['post_url'],
        ];
    }
    return $rows;
}

/** 目標の1行（朝のまとめ用） */
function admin_today_goal_text(array $goals): string
{
    $parts = ['記事 ' . $goals['articles'] . '/1', 'SNS ' . $goals['sns'] . '/1', $goals['note_enabled'] ? 'note ' . $goals['note'] . '/1' : 'note 準備中'];
    return implode('・', $parts) . '（連続達成 ' . $goals['streak'] . '日）';
}

/** 今日の予定（朝のまとめ用） */
function admin_today_schedule_text(?DateTimeImmutable $now = null): string
{
    $now ??= new DateTimeImmutable('now');
    $lines = [];
    foreach (admin_today_schedule($now) as $row) {
        $lines[] = ($row['time'] ?? '時刻なし') . ' ' . $row['label'] . '「' . $row['title'] . '」' . $row['status_label'] . ($row['approved'] ? '' : '（未承認）');
    }
    if (admin_note_enabled() && admin_note_today_slot($now) === null && admin_note_posts_on($now->format('Y-m-d')) === []) {
        $lines[] = 'note：今日の分の本文がストックにありません（自分で書いて投稿し、URLを記録すれば目標に数えます）';
    }
    return $lines === [] ? '予定はありません。' : implode("\n", $lines);
}

/** 1本道で順に承認する、未承認の投稿（7日以内に予約中・保留の枠に載っているストック。日付順） */
function admin_today_unapproved_stocks(?DateTimeImmutable $now = null): array
{
    if (admin_post_mode() !== 'review') {
        return [];
    }
    $now ??= new DateTimeImmutable('now');
    $stmt = admin_db()->prepare(
        "SELECT s.id, MIN(q.slot_date) AS slot_date FROM post_queue q JOIN post_stock s ON s.id = q.stock_id
         WHERE q.status IN ('scheduled', 'held') AND s.status = 'pending_review' AND q.slot_date BETWEEN ? AND ?
         GROUP BY s.id ORDER BY MIN(q.slot_date), s.id"
    );
    $stmt->execute([$now->modify('-7 days')->format('Y-m-d'), $now->modify('+' . ADMIN_ASSIGN_DAYS . ' days')->format('Y-m-d')]);
    return $stmt->fetchAll();
}
