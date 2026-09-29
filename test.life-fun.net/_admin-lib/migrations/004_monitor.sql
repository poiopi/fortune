-- 004_monitor.sql
-- 段階3.5（ADMIN_IMPL_PLAN.md 10章）：公開ページのJSエラー監視・姓名判断の未登録字・既知の不具合・漢字追加。

-- 公開ページのJSエラー。同じエラー（種類・メッセージ・発生場所・行）は1行にまとめて回数を数える。
-- status：open（未対応）/ resolved（対応済）/ ignored（無視）。対応済のエラーが再発したら open に戻して再通知する。
CREATE TABLE client_errors (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    fingerprint TEXT    NOT NULL UNIQUE,
    kind        TEXT    NOT NULL,
    message     TEXT    NOT NULL,
    source      TEXT    NOT NULL,
    line        INTEGER NOT NULL DEFAULT 0,
    col         INTEGER NOT NULL DEFAULT 0,
    stack       TEXT,
    ua          TEXT,
    count       INTEGER NOT NULL DEFAULT 1,
    first_seen  TEXT    NOT NULL,
    last_seen   TEXT    NOT NULL,
    status      TEXT    NOT NULL DEFAULT 'open',
    notified    INTEGER NOT NULL DEFAULT 0
);
CREATE INDEX client_errors_status ON client_errors (status, last_seen);

-- エラーが起きたページ（パスのみ・クエリなし）。1エラーあたり最大20ページ
CREATE TABLE client_error_pages (
    error_id INTEGER NOT NULL REFERENCES client_errors (id) ON DELETE CASCADE,
    page     TEXT    NOT NULL,
    count    INTEGER NOT NULL DEFAULT 1,
    PRIMARY KEY (error_id, page)
);

-- 受付の回数制限（IPのハッシュ × 10分枠）。IPそのものは保存しない
CREATE TABLE client_log_rate (
    ip_hash TEXT    NOT NULL,
    win     INTEGER NOT NULL,
    count   INTEGER NOT NULL DEFAULT 1,
    PRIMARY KEY (ip_hash, win)
);

-- 姓名判断で入力されたが画数表に無かった字。status：open / added（追加候補に送った）/ ignored
CREATE TABLE unknown_kanji (
    ch         TEXT    PRIMARY KEY,
    count      INTEGER NOT NULL DEFAULT 1,
    first_seen TEXT    NOT NULL,
    last_seen  TEXT    NOT NULL,
    status     TEXT    NOT NULL DEFAULT 'open'
);

-- 既知の不具合。severity：high / mid / low。status：open（未対応）/ doing（対応中）/ done（対応済）/ wontfix（見送り）
CREATE TABLE known_issues (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    title      TEXT    NOT NULL,
    severity   TEXT    NOT NULL DEFAULT 'mid',
    status     TEXT    NOT NULL DEFAULT 'open',
    page       TEXT,
    memo       TEXT,
    error_id   INTEGER REFERENCES client_errors (id) ON DELETE SET NULL,
    created_at TEXT    NOT NULL,
    updated_at TEXT    NOT NULL
);

-- 姓名判断の画数表への追加（反映待ち → 反映済み）。反映済みはサーバー上の js/seimei-kanji.js に入ったら自動で付く
CREATE TABLE kanji_additions (
    id           INTEGER PRIMARY KEY AUTOINCREMENT,
    ch           TEXT    NOT NULL UNIQUE,
    strokes      INTEGER NOT NULL,
    note         TEXT,
    status       TEXT    NOT NULL DEFAULT 'pending',
    created_at   TEXT    NOT NULL,
    reflected_at TEXT
);

-- 最初の登録（2026-09-29 の調査で判明したもの）
INSERT INTO known_issues (title, severity, status, page, memo, created_at, updated_at) VALUES
    ('姓名判断：「々」が未対応（佐々木などが占えない）', 'high', 'doing', '/seimei',
     '段階3.5で「直前の字と同じ画数」で数えるよう修正（ユーザー決定 a）。検証環境で確認できたら対応済にする。',
     strftime('%Y-%m-%dT%H:%M:%S+09:00', 'now', 'localtime'), strftime('%Y-%m-%dT%H:%M:%S+09:00', 'now', 'localtime')),
    ('姓名判断：画数表で17字の画数が食い違っている（典・宮・凧・禰など）', 'mid', 'open', '/seimei',
     '旧 seimei.php の表に同じ字が2回以上書かれ、値が違っていた。今は後に書いた値が使われている。正しい画数を調べ、ユーザー承認後に修正する。',
     strftime('%Y-%m-%dT%H:%M:%S+09:00', 'now', 'localtime'), strftime('%Y-%m-%dT%H:%M:%S+09:00', 'now', 'localtime'));
