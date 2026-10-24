-- 009_two_factor.sql
-- 2段階認証の予備コード（段階1「B：2段階認証」）。
-- 平文は保存しない（password_hash のハッシュのみ）。1回使うと used_at が入り、以後は使えない。
-- 秘密鍵・有効化日時・最後に受け付けたステップは settings（totp_secret は暗号化）に置く。
-- 番号 008 は Threads 用に予約済み。db.php は未適用のファイルを番号順に適用するだけなので、008 が無くても適用できる。

CREATE TABLE two_factor_backup_codes (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    code_hash  TEXT NOT NULL,
    created_at TEXT NOT NULL,
    used_at    TEXT
);
