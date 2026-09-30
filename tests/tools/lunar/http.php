<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/http.php
 *
 * 採取スクリプト用の最小HTTP GET（開発専用）。
 * PHP に openssl 拡張が無い環境でも動くよう、curl コマンドを呼び出す。
 */

/** @return array{status:int, body:string} */
function lunar_http_get(string $url): array {
    $tmp = tempnam(sys_get_temp_dir(), 'lunar');
    $cmd = 'curl -s -L -m 60 -A ' . escapeshellarg('Mozilla/5.0 (life-fun.net lunar-table verification; low-rate)')
         . ' -o ' . escapeshellarg($tmp) . ' -w "%{http_code}" ' . escapeshellarg($url);
    $out = [];
    exec($cmd, $out, $code);
    $body = (string)@file_get_contents($tmp);
    @unlink($tmp);
    $status = $code === 0 ? (int)trim(implode('', $out)) : 0;
    return ['status' => $status, 'body' => $body];
}

/** PHP配列を tests/cases/ 形式のファイルとして書き出す（UTF-8 BOMなし・LF） */
function lunar_write_php_array(string $path, string $headerComment, array $data): void {
    $php = "<?php\n" . $headerComment . "\nreturn " . var_export($data, true) . ";\n";
    $php = str_replace("\r\n", "\n", $php);
    if (file_put_contents($path, $php) === false) {
        throw new RuntimeException("書き込み失敗: {$path}");
    }
}
