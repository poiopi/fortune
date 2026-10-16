<?php
declare(strict_types=1);

/**
 * tools/stg-prod-parity.php
 *
 * STG（test.life-fun.net/）と本番（リポジトリ直下）の中身が一致しているかを数える。
 * 使い方：php tools/stg-prod-parity.php        … 想定外の差分の件数と一覧
 *         php tools/stg-prod-parity.php --all  … 許可リストで除外したものも表示
 *
 * - 改行コード（CRLF/LF）だけの違いは差分に数えない
 * - 違っていてよいもの・一時的にSTGだけに置くものは tools/stg-prod-parity-allow.txt に書く
 * - 想定外の差分が0件なら終了コード0、1件以上なら1
 * 同期のあとの公開チェックと一緒に実行する（CLAUDE.md・DEVELOPMENT_RULES.md）。
 */

$root = dirname(__DIR__);
$stg  = $root . '/test.life-fun.net';

// 本番サーバーに上がらないもの・ローカル専用のもの（.vscode/sftp.json の ignore と揃える）
$skipDirs = ['.git', '.claude', '.vscode', 'test.life-fun.net', 'docs', 'tools', 'tests', '_scratch', 'node_modules'];
$skipFile = static function (string $rel): bool {
    $base = basename($rel);
    return preg_match('/\.md$/i', $base) === 1
        || str_starts_with($base, 'README')
        || $base === '.gitignore'
        || preg_match('/^\.env(\..*)?$/', $base) === 1
        || preg_match('/\.(pem|key)$/', $base) === 1
        || str_starts_with($base, 'deploy_chunk_') || $base === 'deploy_config_body.txt';
};

function listFiles(string $base, array $skipDirs, callable $skipFile): array
{
    $out = [];
    $it = new RecursiveIteratorIterator(
        new RecursiveCallbackFilterIterator(
            new RecursiveDirectoryIterator($base, FilesystemIterator::SKIP_DOTS),
            static function (SplFileInfo $f) use ($base, $skipDirs): bool {
                if (!$f->isDir()) return true;
                $rel = ltrim(str_replace('\\', '/', substr($f->getPathname(), strlen($base))), '/');
                // 除外するのは直下のフォルダだけ（例：test.life-fun.net/ の中の tools/ は比べる）
                return strpos($rel, '/') !== false || !in_array($rel, $skipDirs, true);
            }
        )
    );
    foreach ($it as $f) {
        $rel = ltrim(str_replace('\\', '/', substr($f->getPathname(), strlen($base))), '/');
        if (in_array(explode('/', $rel)[0], $skipDirs, true) || $skipFile($rel)) continue;
        $out[$rel] = $f->getPathname();
    }
    return $out;
}

// 許可リスト：1行1件「パターン<TAB>種別<TAB>理由」。パターンは fnmatch（* は / をまたぐ）
$allow = [];
$allowFile = __DIR__ . '/stg-prod-parity-allow.txt';
if (is_file($allowFile)) {
    foreach (file($allowFile, FILE_IGNORE_NEW_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        $cols = array_map('trim', explode("\t", $line));
        // 4列目（任意）は正規表現。指定すると「その部分を除けば一致する」場合だけ許可する（例：footer の管理画面用 script）
        $allow[] = ['pat' => $cols[0], 'type' => $cols[1] ?? '', 'why' => $cols[2] ?? '', 'only' => $cols[3] ?? ''];
    }
}
$allowed = static function (string $rel) use ($allow): ?array {
    foreach ($allow as $a) {
        if (fnmatch($a['pat'], $rel, FNM_PATHNAME) || fnmatch($a['pat'], $rel)) return $a;
    }
    return null;
};

$norm = static fn(string $p): string => str_replace("\r\n", "\n", (string) file_get_contents($p));

$prod = listFiles($root, $skipDirs, $skipFile);
$stgf = listFiles($stg, ['.git', '.claude', '.vscode', 'docs', 'tools', 'tests', '_scratch', 'node_modules'], $skipFile);

$diffs = [];
foreach (array_unique(array_merge(array_keys($prod), array_keys($stgf))) as $rel) {
    $inP = isset($prod[$rel]);
    $inS = isset($stgf[$rel]);
    if ($inP && $inS) {
        if (filesize($prod[$rel]) === filesize($stgf[$rel]) && md5_file($prod[$rel]) === md5_file($stgf[$rel])) continue;
        if ($norm($prod[$rel]) === $norm($stgf[$rel])) continue;
        $kind = '内容が違う';
    } else {
        $kind = $inP ? '本番だけにある' : 'STGだけにある';
    }
    $a = $allowed($rel);
    if ($a !== null && $a['only'] !== '' && $inP && $inS) {
        $strip = static fn(string $s): string => (string) preg_replace('~' . $a['only'] . '~su', '', $s);
        if ($strip($norm($prod[$rel])) !== $strip($norm($stgf[$rel]))) $a = null; // 許可した部分以外にも差がある
    }
    $diffs[] = ['rel' => $rel, 'kind' => $kind, 'allow' => $a];
}
sort($diffs);

$showAll = in_array('--all', $argv, true);
$unexpected = array_values(array_filter($diffs, static fn($d) => $d['allow'] === null));
$known = array_values(array_filter($diffs, static fn($d) => $d['allow'] !== null));

echo '比較したファイル：本番 ' . count($prod) . '件／STG ' . count($stgf) . "件\n";
echo '想定外の差分：' . count($unexpected) . "件（許可リストで除外：" . count($known) . "件）\n";
foreach ($unexpected as $d) echo "  [{$d['kind']}] {$d['rel']}\n";
if ($showAll && $known) {
    echo "--- 許可リストで除外したもの\n";
    foreach ($known as $d) echo "  [{$d['kind']}] {$d['rel']}  … {$d['allow']['type']}：{$d['allow']['why']}\n";
}
exit($unexpected ? 1 : 0);
