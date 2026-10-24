<?php
declare(strict_types=1);

/**
 * _admin-lib/sns/import.php
 *
 * ストックの取り込み。
 *  - JSONファイル（Claude Code で生成。形式は ADMIN_PLAN.md 9章、見本は tools/admin-stock-sample.json）
 *  - 既存クイズ（quiz/<slug>/data.php の sns.threads / sns.note。サイト側のファイルは読むだけ）
 * 取り込み結果は import_batches に記録する。
 */

const ADMIN_IMPORT_FORMAT_VERSION = 1;
const ADMIN_IMPORT_MAX_BYTES = 2 * 1024 * 1024;

/**
 * 戻り値：['ok' => bool, 'fatal' => ?string, 'imported' => int, 'skipped' => [..], 'errors' => [..]]
 */
function admin_import_stock_json(string $json, string $filename): array
{
    $result = ['ok' => false, 'fatal' => null, 'imported' => 0, 'skipped' => [], 'errors' => []];

    if (strlen($json) > ADMIN_IMPORT_MAX_BYTES) {
        $result['fatal'] = 'ファイルが大きすぎます（2MBまで）';
        return $result;
    }
    $data = json_decode($json, true);
    if (!is_array($data)) {
        $result['fatal'] = 'JSONとして読めません（' . json_last_error_msg() . '）';
        return $result;
    }
    if (($data['format_version'] ?? null) !== ADMIN_IMPORT_FORMAT_VERSION) {
        $result['fatal'] = 'format_version が ' . ADMIN_IMPORT_FORMAT_VERSION . ' ではありません';
        return $result;
    }
    if (!is_array($data['items'] ?? null) || !array_is_list($data['items'])) {
        $result['fatal'] = 'items が配列ではありません';
        return $result;
    }

    $items = [];
    foreach ($data['items'] as $i => $item) {
        $no = '#' . ($i + 1);
        if (!is_array($item)) {
            $result['errors'][] = $no . '：項目の形式が正しくありません';
            continue;
        }
        $extId = $item['ext_id'] ?? null;
        if (!is_string($extId) || preg_match('/^[A-Za-z0-9_.:-]{1,100}$/', $extId) !== 1) {
            $result['errors'][] = $no . '：ext_id が正しくありません（英数字と _ . : - の1〜100文字）';
            continue;
        }
        $bodies = [];
        foreach ((array) ($item['bodies'] ?? []) as $platform => $body) {
            $bodies[$platform] = is_array($body) ? $body : ['body' => $body];
        }
        $items[] = ['no' => $no, 'ext_id' => $extId, 'data' => [
            'kind' => $item['kind'] ?? null, 'title' => $item['title'] ?? null,
            'link_url' => $item['link_url'] ?? '', 'notes' => $item['notes'] ?? '', 'bodies' => $bodies,
        ]];
    }

    return admin_import_items($items, 'generated', $filename, hash('sha256', $json), count($data['items']), $result);
}

/** 既存クイズ（このサーバーの quiz/ 配下）を取り込む */
function admin_import_quiz_data(): array
{
    $result = ['ok' => false, 'fatal' => null, 'imported' => 0, 'skipped' => [], 'errors' => []];
    $quizDir = dirname(admin_config()['lib_dir']) . '/quiz';
    $files = glob($quizDir . '/*/data.php') ?: [];
    sort($files, SORT_STRING);

    $items = [];
    foreach ($files as $file) {
        $slug = basename(dirname($file));
        if (str_starts_with($slug, '_')) {
            continue;
        }
        $quiz = admin_read_quiz_data($file);
        $no = 'quiz/' . $slug;
        if (!is_array($quiz) || !is_string($quiz['sns']['threads'] ?? null)) {
            $result['errors'][] = $no . '：data.php に sns.threads がありません';
            continue;
        }
        $title = (string) ($quiz['question'] ?? $slug);
        $bodies = ['threads' => ['body' => $quiz['sns']['threads']]];
        if (is_string($quiz['sns']['note'] ?? null) && trim($quiz['sns']['note']) !== '') {
            $bodies['note'] = ['title' => $title, 'body' => $quiz['sns']['note']];
        }
        $items[] = ['no' => $no, 'ext_id' => 'quiz:' . $slug, 'data' => [
            'kind' => 'quiz', 'title' => mb_substr($title, 0, 100),
            'link_url' => admin_config()['site_url'] . '/quiz/' . $slug . '/', 'notes' => '', 'bodies' => $bodies,
        ]];
    }

    return admin_import_items($items, 'quiz_data', 'quiz/*/data.php', hash('sha256', implode("\n", $files)), count($files), $result);
}

/** data.php は配列を return するだけのファイル。管理画面側の変数を汚さないよう関数の中で読む */
function admin_read_quiz_data(string $file): mixed
{
    return (static fn (string $f): mixed => include $f)($file);
}

/** 検証済みでない items を検証し、重複を除いて1トランザクションで登録する */
function admin_import_items(array $items, string $source, string $filename, string $sha256, int $total, array $result): array
{
    $pdo = admin_db();
    $pdo->exec('BEGIN IMMEDIATE');
    try {
        $pdo->prepare(
            'INSERT INTO import_batches (source, filename, sha256, item_count, imported_count, skipped_count, error_count, imported_at)
             VALUES (?, ?, ?, ?, 0, 0, 0, ?)'
        )->execute([$source, $filename, $sha256, $total, admin_now()]);
        $batchId = (int) $pdo->lastInsertId();

        $exists = $pdo->prepare('SELECT 1 FROM post_stock WHERE ext_id = ?');
        $seen = [];
        foreach ($items as $item) {
            if (isset($seen[$item['ext_id']])) {
                $result['skipped'][] = $item['no'] . '（' . $item['ext_id'] . '）：ファイル内で ext_id が重複';
                continue;
            }
            $seen[$item['ext_id']] = true;
            $exists->execute([$item['ext_id']]);
            if ($exists->fetchColumn() !== false) {
                $result['skipped'][] = $item['no'] . '（' . $item['ext_id'] . '）：取り込み済み';
                continue;
            }
            $errors = admin_stock_validate($item['data']);
            if ($errors !== []) {
                $result['errors'][] = $item['no'] . '（' . $item['ext_id'] . '）：' . implode(' / ', $errors);
                continue;
            }
            admin_stock_create(admin_stock_normalize($item['data']), $source, $item['ext_id'], $batchId);
            $result['imported']++;
        }

        $pdo->prepare('UPDATE import_batches SET imported_count = ?, skipped_count = ?, error_count = ?, errors = ? WHERE id = ?')
            ->execute([
                $result['imported'], count($result['skipped']), count($result['errors']),
                $result['errors'] === [] ? null : json_encode($result['errors'], JSON_UNESCAPED_UNICODE), $batchId,
            ]);
        $pdo->exec('COMMIT');
    } catch (Throwable $e) {
        $pdo->exec('ROLLBACK');
        throw $e;
    }
    $result['ok'] = true;
    return $result;
}
