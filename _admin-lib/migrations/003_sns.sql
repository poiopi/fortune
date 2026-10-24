-- 003_sns.sql
-- SNS投稿（ADMIN_PLAN.md 8章・10章、ADMIN_IMPL_PLAN.md Phase 3）。
-- post_stock.status は確認の状態のみ（pending_review / approved / archived）。
-- 予約・投稿済・保留などの状態は post_queue 側で持つ（ADMIN_IMPL_PLAN.md 9-4）。

CREATE TABLE post_kinds (
    kind         TEXT PRIMARY KEY,
    label        TEXT    NOT NULL,
    utm_campaign TEXT    NOT NULL,
    sort         INTEGER NOT NULL DEFAULT 0,
    active       INTEGER NOT NULL DEFAULT 1
);
INSERT INTO post_kinds (kind, label, utm_campaign, sort) VALUES
    ('quiz',        'クイズ',     'daily_quiz',        1),
    ('trivia',      '豆知識',     'daily_trivia',      2),
    ('personality', '性格診断',   'daily_personality', 3),
    ('guide',       'サイト誘導', 'site_guide',        4);

-- weekday：0=日〜6=土。画面は曜日ごとに1枠（ユーザー決定「1日1回」）
CREATE TABLE rotation_rules (
    id        INTEGER PRIMARY KEY AUTOINCREMENT,
    weekday   INTEGER NOT NULL UNIQUE,
    kind      TEXT    NOT NULL REFERENCES post_kinds (kind),
    post_time TEXT    NOT NULL,
    platforms TEXT    NOT NULL,
    active    INTEGER NOT NULL DEFAULT 1
);
-- 初期値（ADMIN_PLAN.md 10章。根拠データのない仮の値、設定画面で変更可）
INSERT INTO rotation_rules (weekday, kind, post_time, platforms) VALUES
    (1, 'quiz',        '20:00', '["threads"]'),
    (2, 'trivia',      '20:00', '["threads"]'),
    (3, 'personality', '20:00', '["threads"]'),
    (4, 'quiz',        '20:00', '["threads"]'),
    (5, 'guide',       '20:00', '["threads"]'),
    (6, 'personality', '12:00', '["threads"]'),
    (0, 'trivia',      '12:00', '["threads"]');

CREATE TABLE import_batches (
    id             INTEGER PRIMARY KEY AUTOINCREMENT,
    source         TEXT    NOT NULL,
    filename       TEXT    NOT NULL,
    sha256         TEXT    NOT NULL,
    item_count     INTEGER NOT NULL,
    imported_count INTEGER NOT NULL,
    skipped_count  INTEGER NOT NULL,
    error_count    INTEGER NOT NULL,
    errors         TEXT,
    imported_at    TEXT    NOT NULL
);

CREATE TABLE post_stock (
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    ext_id          TEXT UNIQUE,
    kind            TEXT    NOT NULL REFERENCES post_kinds (kind),
    title           TEXT    NOT NULL,
    link_url        TEXT,
    source          TEXT    NOT NULL,
    status          TEXT    NOT NULL,
    edited          INTEGER NOT NULL DEFAULT 0,
    import_batch_id INTEGER REFERENCES import_batches (id),
    notes           TEXT,
    created_at      TEXT    NOT NULL,
    approved_at     TEXT,
    updated_at      TEXT    NOT NULL
);
CREATE INDEX idx_post_stock_kind_status ON post_stock (kind, status);

CREATE TABLE post_stock_bodies (
    stock_id INTEGER NOT NULL REFERENCES post_stock (id) ON DELETE CASCADE,
    platform TEXT    NOT NULL,
    title    TEXT,
    body     TEXT    NOT NULL,
    PRIMARY KEY (stock_id, platform)
);

-- 1行＝1ネタ×1SNS。slot_date が同じ行の集まりが「その日の投稿枠」
CREATE TABLE post_queue (
    id           INTEGER PRIMARY KEY AUTOINCREMENT,
    stock_id     INTEGER NOT NULL REFERENCES post_stock (id),
    platform     TEXT    NOT NULL,
    slot_date    TEXT    NOT NULL,
    scheduled_at TEXT    NOT NULL,
    assigned_by  TEXT    NOT NULL,
    status       TEXT    NOT NULL,
    attempts     INTEGER NOT NULL DEFAULT 0,
    last_error   TEXT,
    posted_at    TEXT,
    post_url     TEXT,
    external_id  TEXT,
    created_at   TEXT    NOT NULL,
    updated_at   TEXT    NOT NULL
);
CREATE INDEX idx_post_queue_status_time ON post_queue (status, scheduled_at);
CREATE INDEX idx_post_queue_slot ON post_queue (slot_date);
CREATE INDEX idx_post_queue_stock ON post_queue (stock_id);

CREATE TABLE sns_accounts (
    platform         TEXT PRIMARY KEY,
    account_name     TEXT,
    token_encrypted  TEXT,
    token_expires_at TEXT,
    status           TEXT NOT NULL DEFAULT 'disconnected',
    updated_at       TEXT
);
