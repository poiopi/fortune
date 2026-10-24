-- 012_note_images.sql
-- 段階2（note支援の仕上げ）：ストックに付ける note 用の画像。ファイルはデータ置き場の note-images/ に置き、ここには情報だけを持つ。
-- role：eyecatch（見出し画像・1枚）／body（本文中の画像・seq 1〜5。本文の「［画像1］」などの目印と番号を合わせる）
-- 画像はアップロード時にサーバーで作り直してから保存する（note-images.php）。

CREATE TABLE post_stock_images (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    stock_id   INTEGER NOT NULL REFERENCES post_stock (id) ON DELETE CASCADE,
    role       TEXT    NOT NULL,
    seq        INTEGER NOT NULL DEFAULT 0,
    file       TEXT    NOT NULL,
    mime       TEXT    NOT NULL,
    width      INTEGER NOT NULL,
    height     INTEGER NOT NULL,
    bytes      INTEGER NOT NULL,
    created_at TEXT    NOT NULL,
    UNIQUE (stock_id, role, seq)
);
