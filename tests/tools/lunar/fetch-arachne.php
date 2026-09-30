<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/fetch-arachne.php
 *
 * 外部カレンダー（暦のページ arachne.jp「大安カレンダー」）から日別の六曜を採取し、
 * tests/cases/lunar-arachne-rokuyo.php に固定する（開発専用・ネットワーク必須）。
 * 照合テスト（tests/tools/compare-lunar-arachne.php）はこの固定ファイルだけを見る。
 *
 * URL: https://www.arachne.jp/onlinecalendar/taian/{YYYY}/{MM}/（UTF-8）
 * 抽出: <time datetime='YYYY-MM-DD'>d</time></p><p class="rokuyou">六曜</p>
 * アクセス間隔は 5 秒以上空ける。
 *
 * 対象月（生成テーブルに依存しないよう固定で列挙）
 *   - 2026年の全月
 *   - 閏月とその前後の旧暦月を含むグレゴリオ月（閏月の前後1か月ずつ余分に含める）
 *       2012 閏3月(4/21〜5/20)  → 2012-03〜06
 *       2014 閏9月(10/24〜11/21)→ 2014-09〜12
 *       2017 閏5月(6/24〜7/22)  → 2017-05〜08
 *       2020 閏4月(5/23〜6/20)  → 2020-04〜07
 *       2023 閏2月(3/22〜4/19)  → 2023-02〜05
 *       2025 閏6月(7/25〜8/22)  → 2025-06〜09
 *       2028 閏5月(6/23〜7/21)  → 2028-05〜08
 *       2033 閏11月(12/22〜1/19)→ 2033-11〜2034-02
 *   - 朔が0時の前後5分以内になる境界ケース18件の月
 *   - 中気が0時近くで朔と重なる境界ケースのうち 2012-05・2017-07（上に含まれる）
 *
 * 実行方法: php tests/tools/lunar/fetch-arachne.php
 */

require_once __DIR__ . '/http.php';

function lunar_arachne_months(): array {
    $months = [];
    $add = function (int $y, int $mFrom, int $yTo, int $mTo) use (&$months) {
        $t = $y * 12 + $mFrom - 1; $e = $yTo * 12 + $mTo - 1;
        for (; $t <= $e; $t++) $months[] = sprintf('%04d-%02d', intdiv($t, 12), $t % 12 + 1);
    };
    $add(2026, 1, 2026, 12);
    $add(2012, 3, 2012, 6);
    $add(2014, 9, 2014, 12);
    $add(2017, 5, 2017, 8);
    $add(2020, 4, 2020, 7);
    $add(2023, 2, 2023, 5);
    $add(2025, 6, 2025, 9);
    $add(2028, 5, 2028, 8);
    $add(2033, 11, 2034, 2);
    foreach (lunar_saku_boundary_dates() as $d) $months[] = substr($d, 0, 7);
    $months[] = '2012-05';
    $months[] = '2017-07';
    $months = array_values(array_unique($months));
    sort($months);
    return $months;
}

/** 朔が JST 0時の前後5分以内になる境界ケース（指示書の18件） */
function lunar_saku_boundary_dates(): array {
    return ['1908-09-25', '1913-12-27', '1932-10-29', '1934-10-09', '1967-05-09', '2005-12-02',
            '2012-06-20', '2017-02-26', '2035-01-10', '2044-11-19', '2050-02-22', '2051-08-07',
            '2051-11-03', '2052-10-23', '2071-04-01', '2074-08-22', '2092-02-08', '2097-01-13'];
}

if (realpath($argv[0] ?? '') !== realpath(__FILE__)) return; // ライブラリとして require された場合はここまで

$names = ['大安', '赤口', '先勝', '友引', '先負', '仏滅'];
$days = []; $fetched = []; $unavailable = [];
foreach (lunar_arachne_months() as $i => $ym) {
    if ($i > 0) sleep(5);
    [$y, $m] = explode('-', $ym);
    $url = "https://www.arachne.jp/onlinecalendar/taian/{$y}/{$m}/";
    $res = lunar_http_get($url);
    if ($res['status'] !== 200) {
        $unavailable[$ym] = "HTTP {$res['status']}";
        echo "{$ym}: HTTP {$res['status']}\n";
        continue;
    }
    preg_match_all("/<time datetime='(\d{4}-\d{2}-\d{2})'>\d+<\/time><\/p><p class=\"rokuyou\">([^<]+)<\/p>/u", $res['body'], $mm, PREG_SET_ORDER);
    $n = 0;
    foreach ($mm as $r) {
        if (substr($r[1], 0, 7) !== $ym) continue; // 前後月のはみ出し表示は除外
        $name = trim($r[2]);
        if (!in_array($name, $names, true)) continue;
        $days[$r[1]] = $name; $n++;
    }
    $expected = cal_days_in_month(CAL_GREGORIAN, (int)$m, (int)$y);
    if ($n !== $expected) {
        $unavailable[$ym] = "日数不一致（抽出{$n}件 / 暦{$expected}日）";
        echo "{$ym}: parse {$n}/{$expected}\n";
        continue;
    }
    $fetched[] = $ym;
    echo "{$ym}: {$n}日\n";
}
ksort($days);

$header = "// 暦のページ arachne.jp「大安カレンダー」から採取した日別の六曜（外部カレンダーによる正解データ）。\n"
        . "// 自動生成: tests/tools/lunar/fetch-arachne.php（手で編集しない）\n"
        . '// 採取日時: ' . (new DateTimeImmutable('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s T') . "\n"
        . "// 出典URL: https://www.arachne.jp/onlinecalendar/taian/{YYYY}/{MM}/\n"
        . "// 形式: days['YYYY-MM-DD'] = 六曜名";
lunar_write_php_array(__DIR__ . '/../../cases/lunar-arachne-rokuyo.php', $header, [
    'source'      => 'https://www.arachne.jp/onlinecalendar/taian/{YYYY}/{MM}/',
    'fetched'     => $fetched,
    'unavailable' => $unavailable,
    'days'        => $days,
]);
echo '取得月数: ' . count($fetched) . ' / 取得不可: ' . count($unavailable) . ' / 日数: ' . count($days) . "\n";
