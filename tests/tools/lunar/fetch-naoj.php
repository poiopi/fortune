<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/fetch-naoj.php
 *
 * 国立天文台 暦計算室「暦要項 朔弦望」から朔の日時（中央標準時）を採取し、
 * tests/cases/lunar-naoj-saku.php に固定する（開発専用・ネットワーク必須）。
 * 照合テスト（tests/tools/compare-lunar-naoj.php）はこの固定ファイルだけを見るので、
 * テスト実行時にネットワークは不要。
 *
 * URL: https://eco.mtk.nao.ac.jp/koyomi/yoko/{YYYY}/rekiyou{YY}3.html（Shift_JIS）
 * 索引ページには直近の年しか載っていないため、各年のURLを直接確認する。
 * アクセス間隔は 3 秒以上空ける。
 *
 * 実行方法: php tests/tools/lunar/fetch-naoj.php [--from=YYYY] [--to=YYYY]
 */

require_once __DIR__ . '/http.php';

$from = 1990; $to = 2030;
foreach (array_slice($argv, 1) as $arg) {
    if (preg_match('/^--from=(\d{4})$/', $arg, $m)) $from = (int)$m[1];
    if (preg_match('/^--to=(\d{4})$/', $arg, $m)) $to = (int)$m[1];
}

$years = []; $unavailable = [];
for ($y = $from; $y <= $to; $y++) {
    if ($y > $from) sleep(3);
    $url = sprintf('https://eco.mtk.nao.ac.jp/koyomi/yoko/%04d/rekiyou%02d3.html', $y, $y % 100);
    $res = lunar_http_get($url);
    if ($res['status'] !== 200) {
        $unavailable[$y] = "HTTP {$res['status']}";
        echo "{$y}: HTTP {$res['status']}\n";
        continue;
    }
    $html = mb_convert_encoding($res['body'], 'UTF-8', 'SJIS-win');
    preg_match_all('/朔<\/td>\s*<td>\s*(\d+)月\s*(\d+)日<\/td>\s*<td>\s*(\d+)時\s*(\d+)分/u', $html, $mm, PREG_SET_ORDER);
    if (count($mm) < 12) {
        $unavailable[$y] = '朔の抽出件数が不足（' . count($mm) . '件。ページ形式が異なる可能性）';
        echo "{$y}: parse " . count($mm) . "\n";
        continue;
    }
    $list = [];
    foreach ($mm as $r) {
        $list[] = [sprintf('%04d-%02d-%02d', $y, (int)$r[1], (int)$r[2]), sprintf('%02d:%02d', (int)$r[3], (int)$r[4])];
    }
    $years[$y] = $list;
    echo "{$y}: " . count($list) . " 朔\n";
}

$header = "// 国立天文台 暦計算室「暦要項 朔弦望」から採取した朔の日時（中央標準時=JST）。\n"
        . "// 自動生成: tests/tools/lunar/fetch-naoj.php（手で編集しない）\n"
        . '// 採取日時: ' . (new DateTimeImmutable('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s T') . "\n"
        . "// 出典URL: https://eco.mtk.nao.ac.jp/koyomi/yoko/{YYYY}/rekiyou{YY}3.html\n"
        . "// 形式: years[年] = [['YYYY-MM-DD', 'HH:MM'], ...]（時刻は分単位。国立天文台の表記のまま）";
lunar_write_php_array(__DIR__ . '/../../cases/lunar-naoj-saku.php', $header, [
    'source'      => 'https://eco.mtk.nao.ac.jp/koyomi/yoko/{YYYY}/rekiyou{YY}3.html',
    'probed'      => [$from, $to],
    'unavailable' => $unavailable,
    'years'       => $years,
]);
echo '取得できた年: ' . implode(',', array_keys($years)) . "\n";
