<?php
declare(strict_types=1);

/**
 * _admin-lib/seimei-kanji.php
 *
 * 姓名判断の画数表（公開サイトの js/seimei-kanji.js）への漢字追加（ADMIN_IMPL_PLAN.md 10章 X）。
 * 管理画面は表を直接書き換えない。チェック → 反映待ち → 差し替え用ファイルを出力 → いつもどおり
 * リポジトリ → 検証環境 → 本番の順で反映する。サーバー上のファイルに入ったら自動で「反映済み」になる。
 */

const ADMIN_KANJI_STROKES_MIN = 1;
const ADMIN_KANJI_STROKES_MAX = 40;
const ADMIN_KANJI_MAX_LINES = 100;

/** この環境の公開サイト上の画数表ファイル */
function admin_seimei_kanji_path(): string
{
    return dirname(admin_config()['lib_dir']) . '/js/seimei-kanji.js';
}

/**
 * 画数表の文字列（JSのオブジェクトリテラル部分）から [字 => 画数]。
 * 同じ字が複数あれば、JSと同じく後のものが有効。$dups に重複した字 => [値...] を返す。
 */
function admin_seimei_kanji_parse(string $source, ?array &$dups = null): array
{
    preg_match_all("/'(.)':(\d+)/u", $source, $m, PREG_SET_ORDER);
    $map = [];
    $seen = [];
    foreach ($m as [, $ch, $n]) {
        $seen[$ch][] = (int) $n;
        $map[$ch] = (int) $n;
    }
    $dups = array_filter($seen, static fn (array $values): bool => count($values) > 1);
    return $map;
}

/** サーバー上の画数表。読めなければ null */
function admin_seimei_kanji_current(): ?array
{
    $path = admin_seimei_kanji_path();
    if (!is_file($path)) {
        return null;
    }
    $source = file_get_contents($path);
    return $source === false ? null : admin_seimei_kanji_parse($source);
}

/** 字の分類（並べ順）：漢字 → ひらがな → カタカナ → その他 */
function admin_seimei_kanji_group(string $ch): int
{
    return match (true) {
        preg_match('/^\p{Han}$/u', $ch) === 1      => 0,
        preg_match('/^\p{Hiragana}$/u', $ch) === 1 => 1,
        preg_match('/^\p{Katakana}$/u', $ch) === 1 => 2,
        default                                    => 3,
    };
}

/** [字 => 画数] から js/seimei-kanji.js の中身を作る。漢字は画数ごと、同じ画数の中は文字コード順 */
function admin_seimei_kanji_render(array $map): string
{
    $groups = [[], [], [], []];
    foreach ($map as $ch => $n) {
        $groups[admin_seimei_kanji_group((string) $ch)][(string) $ch] = $n;
    }
    $out = "/**\n"
        . " * js/seimei-kanji.js — 姓名判断（seimei.php）の画数表\n"
        . " * 画数は一般的な字画数（新字体）。旧字体・異体字は個別に登録。\n"
        . " * 「々」は表に入れず、seimei.php 側で直前の字と同じ画数として数える。\n"
        . " * このファイルは管理画面「姓名判断の漢字」が出力する。手で直す場合も1字1件を守ること（重複させない）。\n"
        . " */\n"
        . "window.SEIMEI_KK={\n";

    $byStrokes = [];
    foreach ($groups[0] as $ch => $n) {
        $byStrokes[$n][] = $ch;
    }
    ksort($byStrokes);
    foreach ($byStrokes as $n => $chars) {
        usort($chars, static fn (string $a, string $b): int => mb_ord($a) <=> mb_ord($b));
        $out .= "  // {$n}画\n" . admin_seimei_kanji_render_line(array_fill_keys($chars, $n));
    }
    foreach ([1 => 'ひらがな', 2 => 'カタカナ', 3 => 'その他'] as $g => $label) {
        if ($groups[$g] === []) {
            continue;
        }
        uksort($groups[$g], static fn (string $a, string $b): int => mb_ord($a) <=> mb_ord($b));
        $out .= "  // {$label}\n" . admin_seimei_kanji_render_line($groups[$g]);
    }
    return $out . "};\n";
}

/** 1行20字ずつ */
function admin_seimei_kanji_render_line(array $map): string
{
    $items = [];
    foreach ($map as $ch => $n) {
        $items[] = "'" . $ch . "':" . $n;
    }
    $lines = '';
    foreach (array_chunk($items, 20) as $chunk) {
        $lines .= '  ' . implode(',', $chunk) . ",\n";
    }
    return $lines;
}

/**
 * 入力（1行に「字 画数」）のチェック。
 * 戻り値：[['line' => 行番号, 'raw', 'ch', 'strokes', 'result' => 結果コード, 'current' => 表の画数|null], ...]
 * 結果コード：new（追加できる）/ same（すでに登録があります）/ differs（登録済みで画数が違う）/
 *           pending（反映待ちにある）/ dup（この入力の中で重複）/ not_kanji / range / format
 */
function admin_seimei_kanji_check(string $text, array $current): array
{
    $pending = [];
    foreach (admin_db()->query("SELECT ch, strokes FROM kanji_additions WHERE status = 'pending'") as $row) {
        $pending[$row['ch']] = (int) $row['strokes'];
    }
    $rows = [];
    $seenInInput = [];
    $lines = preg_split('/\R/u', $text) ?: [];
    foreach (array_slice($lines, 0, ADMIN_KANJI_MAX_LINES) as $i => $raw) {
        $line = trim(mb_convert_kana($raw, 'as'));
        if ($line === '') {
            continue;
        }
        $row = ['line' => $i + 1, 'raw' => $raw, 'ch' => null, 'strokes' => null, 'current' => null, 'pending' => null];
        if (preg_match('/^(\X)\s*[:：,、=]?\s*(\d{1,3})$/u', $line, $m) !== 1) {
            $rows[] = $row + ['result' => 'format'];
            continue;
        }
        $ch = $m[1];
        $strokes = (int) $m[2];
        $row['ch'] = $ch;
        $row['strokes'] = $strokes;
        $row['current'] = $current[$ch] ?? null;
        $row['pending'] = $pending[$ch] ?? null;
        $result = match (true) {
            mb_strlen($ch) !== 1 || preg_match('/^\p{Han}$/u', $ch) !== 1 || $ch === '々' => 'not_kanji',
            $strokes < ADMIN_KANJI_STROKES_MIN || $strokes > ADMIN_KANJI_STROKES_MAX     => 'range',
            isset($seenInInput[$ch])                                                     => 'dup',
            isset($pending[$ch])                                                         => 'pending',
            !isset($current[$ch])                                                        => 'new',
            $current[$ch] === $strokes                                                   => 'same',
            default                                                                      => 'differs',
        };
        if ($ch !== '') {
            $seenInInput[$ch] = true;
        }
        $rows[] = $row + ['result' => $result];
    }
    return $rows;
}

const ADMIN_KANJI_RESULT_LABELS = [
    'new'       => '追加できます',
    'same'      => 'すでに登録があります',
    'differs'   => '登録済みですが画数が違います',
    'pending'   => '反映待ちにすでにあります',
    'dup'       => 'この入力の中で重複しています',
    'not_kanji' => '漢字1字ではありません',
    'range'     => '画数が範囲外です（' . ADMIN_KANJI_STROKES_MIN . '〜' . ADMIN_KANJI_STROKES_MAX . '）',
    'format'    => '「字 画数」の形になっていません',
];

/**
 * 反映待ちに追加。$overwrite=true なら「画数が違う」字も入力の画数で登録する（表の修正）。
 * 戻り値：追加した件数
 */
function admin_seimei_kanji_add(array $checked, bool $overwrite): int
{
    $insert = admin_db()->prepare("INSERT INTO kanji_additions (ch, strokes, note, status, created_at) VALUES (?, ?, ?, 'pending', ?)
        ON CONFLICT(ch) DO UPDATE SET strokes = excluded.strokes, note = excluded.note, status = 'pending', created_at = excluded.created_at, reflected_at = NULL");
    $added = 0;
    foreach ($checked as $row) {
        if ($row['result'] === 'new' || ($overwrite && $row['result'] === 'differs')) {
            $note = $row['result'] === 'differs' ? '画数の修正（' . $row['current'] . '画 → ' . $row['strokes'] . '画）' : null;
            $insert->execute([$row['ch'], $row['strokes'], $note, admin_now()]);
            $added++;
        }
    }
    return $added;
}

/** 反映待ちのうち、サーバー上の表に入ったものを「反映済み」にする。戻り値：件数 */
function admin_seimei_kanji_sync_reflected(array $current): int
{
    $rows = admin_db()->query("SELECT id, ch, strokes FROM kanji_additions WHERE status = 'pending'")->fetchAll();
    $done = admin_db()->prepare("UPDATE kanji_additions SET status = 'reflected', reflected_at = ? WHERE id = ?");
    $unknown = admin_db()->prepare("UPDATE unknown_kanji SET status = 'added' WHERE ch = ? AND status = 'open'");
    $n = 0;
    foreach ($rows as $row) {
        if (($current[$row['ch']] ?? null) === (int) $row['strokes']) {
            $done->execute([admin_now(), $row['id']]);
            $unknown->execute([$row['ch']]);
            $n++;
        }
    }
    return $n;
}

/** 差し替え用ファイル：サーバー上の表 ＋ 反映待ち */
function admin_seimei_kanji_merged(array $current): array
{
    foreach (admin_db()->query("SELECT ch, strokes FROM kanji_additions WHERE status = 'pending'") as $row) {
        $current[$row['ch']] = (int) $row['strokes'];
    }
    return $current;
}
