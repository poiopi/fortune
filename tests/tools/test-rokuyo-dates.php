<?php
declare(strict_types=1);

/**
 * test-rokuyo-dates.php
 *
 * 個別日付の旧暦・六曜を、oracle.php の getRokuyo() と sansei.php の sansei_getRokuyo()
 * の両方で確認する（sansei 側は class 名が cal-* で異なるため name で比較）。
 *
 * 期待値の根拠
 *   2026-02-17 旧1/1 先勝 / 2026-09-30 旧8/20 先負 / 2026-11-09 旧10/1 仏滅
 *       … 国立天文台の朔（tests/cases/lunar-naoj-saku.php）と外部カレンダー（arachne）で確認済みの値
 *   2033-12-22 旧閏11/1 大安 … 2033年問題の閏11月（日本カレンダー暦文化振興協会推奨）の初日
 *   1900-01-01 旧12/1 赤口 / 2100-12-31 旧12/1 赤口 … テーブル範囲の両端。
 *       旧暦月日は外部資料で確認（2026-09-30。六曜は旧暦月日から (月+日)%6 で導いた値）:
 *       1900-01-01 … 外部資料で確認：https://sinocal.sinica.edu.tw/ （中央研究院「兩千年中西曆轉換」
 *                    西曆→中曆 1900/1/1 → 光緒25年(己亥)12月1日、閏月ではない。同表で 1900-01-31 が 1/1）
 *                    日本の資料でも確認：明治33年 略本暦（神宮司庁、早稲田大学図書館 古典籍総合データベース）
 *                    https://www.wul.waseda.ac.jp/kotenseki/html/ni05/ni05_02199_0150/index.html
 *                    一月の頁、旧暦欄の 1日 に「己亥十二月大 朔」、新月「後十時五十三分」
 *                    （テーブルの朔 22:51:55 JST と約1分差）。1900-01-31 は「庚子正月小 朔」。
 *       2100-12-31 … 外部資料で確認：https://www.hko.gov.hk/tc/gts/time/calendar/text/files/T2100c.txt
 *                    （香港天文台 公曆與農曆日期對照表 2100年。2100-12-31 が「十二月」の初日）
 *
 * 実行方法: php tests/tools/test-rokuyo-dates.php
 */

require __DIR__ . '/lunar/test-bootstrap.php';

$cases = [
    ['1900-01-01', 12, 1, false, '赤口'],
    ['2100-12-31', 12, 1, false, '赤口'],
    ['2033-12-22', 11, 1, true,  '大安'],
    ['2026-02-17', 1,  1, false, '先勝'],
    ['2026-09-30', 8, 20, false, '先負'],
    ['2026-11-09', 10, 1, false, '仏滅'],
];

$pass = 0; $fails = [];
foreach ($cases as [$date, $em, $ed, $eleap, $ename]) {
    [$y, $m, $d] = array_map('intval', explode('-', $date));
    try {
        $l = lunarFromJdn(myGregorianToJD($y, $m, $d));
        $o = getRokuyo($y, $m, $d)['name'];
        $s = sansei_getRokuyo($y, $m, $d)['name'];
        $lstr = $l === null ? 'null' : ($l['leap'] ? '閏' : '') . "{$l['month']}/{$l['day']}";
        $estr = ($eleap ? '閏' : '') . "{$em}/{$ed}";
        $ok = $l !== null && $l['month'] === $em && $l['day'] === $ed && $l['leap'] === $eleap && $o === $ename && $s === $ename;
    } catch (Throwable $e) {
        $ok = false; $lstr = '例外: ' . $e->getMessage(); $estr = ''; $o = $s = '-';
    }
    $line = sprintf('%s  期待 旧%s %s ／ 旧暦 %s  getRokuyo=%s  sansei_getRokuyo=%s', $date, $estr, $ename, $lstr, $o, $s);
    echo ($ok ? '  OK   ' : '  FAIL ') . $line . "\n";
    if ($ok) $pass++; else $fails[] = $line;
}

echo "個別日付: {$pass} / " . count($cases) . " 件一致\n";
if ($fails) { echo "FAIL\n"; exit(1); }
echo "PASS\n";
exit(0);
