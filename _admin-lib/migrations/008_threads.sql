-- 008_threads.sql
-- Threads 自動投稿（ADMIN_IMPL_PLAN.md 14節）。
-- 番号 008 は 14-3 で Threads 用に予約したもの（009 は2段階認証で先に使用。db.php は未適用のファイルを名前順に適用するだけ）。
-- トークン・アプリシークレットは admin_encrypt()（crypto.php）で暗号化した値だけを保存する。平文は保存しない。

-- sns_accounts（003）に連携の情報を足す。
--   status：disconnected（未連携）/ connected（連携済み）/ error（エラー：認証切れ・失効など。自動投稿は止まる）
--   account_name（003）＝ Threads のアカウント名（username）、token_encrypted（003）＝ 長期トークン（暗号化）
ALTER TABLE sns_accounts ADD COLUMN app_id TEXT;                 -- アプリID（秘密ではないので平文）
ALTER TABLE sns_accounts ADD COLUMN app_secret_encrypted TEXT;   -- アプリシークレット（暗号化）
ALTER TABLE sns_accounts ADD COLUMN account_id TEXT;             -- Threads のユーザーID
ALTER TABLE sns_accounts ADD COLUMN token_issued_at TEXT;        -- 長期トークンの発行／前回更新の日時
ALTER TABLE sns_accounts ADD COLUMN connected_at TEXT;           -- 連携した日時
ALTER TABLE sns_accounts ADD COLUMN last_error TEXT;             -- 最後のエラー（トークン等は伏字にしてから保存）
ALTER TABLE sns_accounts ADD COLUMN refresh_fail_count INTEGER NOT NULL DEFAULT 0; -- 毎日の自動更新の連続失敗回数

INSERT OR IGNORE INTO sns_accounts (platform, status) VALUES ('threads', 'disconnected');

-- post_queue（003）に自動投稿の途中経過を足す。既存の attempts（失敗回数）・last_error・posted_at・post_url・external_id（投稿ID）はそのまま使う。
--   status に sending（送信中）・skipped（スキップ）・deleted（削除済み）が加わる（failed は 003 の時点で定義済み）
--   media_type：コンテナ作成時の種類。今は TEXT のみ。VIDEO 等を足すときは threads.php の種類別の部品と、本文以外の素材（動画URL等）の列を足す
ALTER TABLE post_queue ADD COLUMN media_type TEXT NOT NULL DEFAULT 'TEXT';
ALTER TABLE post_queue ADD COLUMN container_id TEXT;             -- Threads のコンテナID（二重投稿防止の確認に使う）
ALTER TABLE post_queue ADD COLUMN container_created_at TEXT;     -- コンテナを作った日時（IN_PROGRESS の待ち上限の判定）
ALTER TABLE post_queue ADD COLUMN next_attempt_at TEXT;          -- 送信中の行を次に処理する日時
ALTER TABLE post_queue ADD COLUMN deleted_at TEXT;               -- 「Threadsから削除」した日時
CREATE INDEX idx_post_queue_sending ON post_queue (status, next_attempt_at);

-- OAuth の state（1回限り・作成から10分で無効）。state そのものではなく sha256 を保存する。
CREATE TABLE oauth_states (
    state_hash TEXT PRIMARY KEY,
    platform   TEXT NOT NULL,
    created_at TEXT NOT NULL
);
