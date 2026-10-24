-- 011_today_notify.sql
-- 段階2（ADMIN_STAGE2_PROPOSAL.md）：「今日」画面の目標・note の投稿記録・朝のまとめ通知。
-- 番号 010 は段階1で「再確認日通知」用に予約済み（ADMIN_IMPL_PLAN.md 15-1）。db.php は未適用のファイルを番号順に適用するだけなので、010 が無くても適用できる。

-- 日ごとの目標の結果（記事1・SNS1・note1）。毎時ジョブが今日と昨日を数え直して上書きする。
-- note_enabled=0 の日（noteのIDが空）は、記事・SNSの2つで達成を判定する。
CREATE TABLE daily_goals (
    goal_date    TEXT PRIMARY KEY,
    articles     INTEGER NOT NULL DEFAULT 0,
    sns          INTEGER NOT NULL DEFAULT 0,
    note         INTEGER NOT NULL DEFAULT 0,
    note_enabled INTEGER NOT NULL DEFAULT 1,
    achieved     INTEGER NOT NULL DEFAULT 0,
    updated_at   TEXT    NOT NULL
);

-- note に投稿した記事。source：manual（URLを手入力・「投稿済にする」）／rss（noteのRSSから自動で拾った）
-- queue_id：今日のnote枠（post_queue）に結び付けたときの行。結び付けていなければ NULL
CREATE TABLE note_posts (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    url        TEXT UNIQUE,
    title      TEXT,
    posted_on  TEXT NOT NULL,
    source     TEXT NOT NULL,
    queue_id   INTEGER REFERENCES post_queue (id),
    created_at TEXT NOT NULL
);
CREATE INDEX idx_note_posts_date ON note_posts (posted_on);

-- 朝のまとめに入れる知らせの溜め置き。sent_at が NULL のものを次の朝のまとめで送る
CREATE TABLE notify_digest (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    event      TEXT NOT NULL,
    category   TEXT NOT NULL,
    message    TEXT NOT NULL,
    created_at TEXT NOT NULL,
    sent_at    TEXT
);
CREATE INDEX idx_notify_digest_pending ON notify_digest (sent_at);

-- 21時のジョブ（翌日の未承認・ストック残少の通知）は廃止。同じ内容は朝のまとめの「やること」に毎朝その時点の状態で載る
DELETE FROM jobs WHERE job = 'evening';
