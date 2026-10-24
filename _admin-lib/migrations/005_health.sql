-- 005_health.sql
-- 段階4：サイトヘルス（ADMIN_PLAN.md 7章、ADMIN_IMPL_PLAN.md Phase 4）。
-- 最新の結果だけを check_key ごとに1行持つ。状態が変わったときだけ health_changes に残し、通知する。
-- status：green / yellow / red

CREATE TABLE health_checks (
    check_key  TEXT PRIMARY KEY,
    status     TEXT NOT NULL,
    message    TEXT NOT NULL,
    detail     TEXT,
    checked_at TEXT NOT NULL,
    changed_at TEXT NOT NULL
);

CREATE TABLE health_changes (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    check_key  TEXT NOT NULL,
    old_status TEXT,
    new_status TEXT NOT NULL,
    message    TEXT NOT NULL,
    at         TEXT NOT NULL
);
CREATE INDEX health_changes_at ON health_changes (at);
