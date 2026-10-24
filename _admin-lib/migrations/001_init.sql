-- 001_init.sql
-- 管理画面の基盤テーブル（ADMIN_PLAN.md 8章、ADMIN_IMPL_PLAN.md Phase 1）。
-- 日時はすべて ISO 8601（+09:00）の TEXT。
-- schema_migrations は db.php が作成する。

CREATE TABLE settings (
    key        TEXT PRIMARY KEY,
    value      TEXT NOT NULL,
    updated_at TEXT NOT NULL
);

CREATE TABLE login_attempts (
    id           INTEGER PRIMARY KEY AUTOINCREMENT,
    ip           TEXT    NOT NULL,
    success      INTEGER NOT NULL,
    attempted_at TEXT    NOT NULL
);
CREATE INDEX idx_login_attempts_ip_time ON login_attempts (ip, attempted_at);

CREATE TABLE audit_logs (
    id     INTEGER PRIMARY KEY AUTOINCREMENT,
    at     TEXT NOT NULL,
    action TEXT NOT NULL,
    target TEXT,
    detail TEXT,
    ip     TEXT
);
CREATE INDEX idx_audit_logs_at ON audit_logs (at);

CREATE TABLE cron_runs (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    job         TEXT NOT NULL,
    started_at  TEXT NOT NULL,
    finished_at TEXT,
    status      TEXT NOT NULL,
    message     TEXT
);
CREATE INDEX idx_cron_runs_job_started ON cron_runs (job, started_at);

CREATE TABLE notifications (
    id      INTEGER PRIMARY KEY AUTOINCREMENT,
    channel TEXT NOT NULL,
    event   TEXT NOT NULL,
    message TEXT NOT NULL,
    status  TEXT NOT NULL,
    error   TEXT,
    sent_at TEXT NOT NULL
);
