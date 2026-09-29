-- 006_pages_seo.sql
-- 段階5：ページ台帳・SEO点検（ADMIN_PLAN.md 8章、ADMIN_IMPL_PLAN.md Phase 5）。
-- pages：台帳（1URL＝1行）。ファイル走査と sitemap.xml の和集合。点検のたびに取得結果を上書きする。
-- seo_issues：検出した問題。同じ URL・規則は1行にまとめ、検出されなくなったら resolved にする。
-- seo_runs：点検の実行（毎分cronが cursor から続きを処理する）。

CREATE TABLE pages (
    url          TEXT PRIMARY KEY,
    file         TEXT,
    in_sitemap   INTEGER NOT NULL DEFAULT 0,
    http_status  INTEGER,
    redirect_to  TEXT,
    title        TEXT,
    description  TEXT,
    canonical    TEXT,
    robots       TEXT,
    fetch_error  TEXT,
    first_seen   TEXT NOT NULL,
    last_seen    TEXT NOT NULL,
    checked_at   TEXT
);

CREATE TABLE seo_runs (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    trigger     TEXT    NOT NULL,
    status      TEXT    NOT NULL DEFAULT 'queued',
    total       INTEGER NOT NULL DEFAULT 0,
    done        INTEGER NOT NULL DEFAULT 0,
    new_issues  INTEGER NOT NULL DEFAULT 0,
    message     TEXT,
    queued_at   TEXT    NOT NULL,
    started_at  TEXT,
    finished_at TEXT
);

CREATE TABLE seo_issues (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    url        TEXT NOT NULL,
    rule       TEXT NOT NULL,
    detail     TEXT,
    status     TEXT NOT NULL DEFAULT 'open',
    first_seen TEXT NOT NULL,
    last_seen  TEXT NOT NULL,
    UNIQUE (url, rule)
);
CREATE INDEX seo_issues_status ON seo_issues (status, rule);
