-- 002_jobs.sql
-- cron ディスパッチャのジョブ状態（ADMIN_IMPL_PLAN.md Phase 2）。
-- 毎分ジョブは cron_runs に毎回は書かず、ここだけを更新する（行数の増えすぎ防止）。

CREATE TABLE jobs (
    job              TEXT PRIMARY KEY,
    last_started_at  TEXT,
    last_finished_at TEXT,
    last_status      TEXT,
    last_message     TEXT
);
