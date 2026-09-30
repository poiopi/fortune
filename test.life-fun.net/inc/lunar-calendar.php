<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 旧暦（太陰太陽暦）ルックアップ
//
// データは inc/lunar-table.php（天文計算で事前生成した静的テーブル。手で編集しない）。
// 生成・再生成は tests/tools/lunar/generate-lunar-table.php（開発専用、公開しない）。
//
// テーブルは関数が最初に呼ばれた時だけ require する（遅延ロード）。
// oracle.php は shichu-engine.php 等からも require されるため、六曜を使わない
// ページでテーブルを読み込まないようにしている。
//
// 閏月ルールは冬至ルール（冬至を含む月を11月、13ヶ月の年だけ最初の中気のない月を閏月）。
// その結果 2033年は閏11月になる（いわゆる2033年問題。詳細は lunar-table.php のヘッダ）。
//
// 注意: 将来のΔTは外挿値のため、朔・中気が0時(JST)に極端に近い日は実際の暦と1日ずれる可能性がある
// （例: 今後最初の該当は 2051-11-03 の朔 23:59:09（0時の51秒前）。該当日の一覧は lunar-table.php のヘッダと tests/README.md）。
// ══════════════════════════════════════════════════════════════════

if (!function_exists('lunarTable')) {
    /**
     * 旧暦テーブル全体。1行 = [朔日のJDN(int, JST暦日), 旧暦月(int 1-12), 閏(0/1), 朔の瞬間(float, JST基準ユリウス日)]。
     * 朔の瞬間 = JD(UT) + 9/24。floor(値 + 0.5) が朔日のJDN。朔日の昇順。
     */
    function lunarTable(): array {
        static $table = null;
        if ($table === null) {
            $table = require __DIR__ . '/lunar-table.php';
        }
        return $table;
    }
}

if (!function_exists('lunarNewMoonMomentsJst')) {
    /**
     * 朔の瞬間（JST基準ユリウス日 = JD(UT) + 9/24 の実数）の昇順配列。
     * 例: 2026-02-17 21:01 JST の朔 → 約 2461089.375...
     */
    function lunarNewMoonMomentsJst(): array {
        static $moments = null;
        if ($moments === null) {
            $moments = array_map(static fn(array $r): float => (float)$r[3], lunarTable());
        }
        return $moments;
    }
}

if (!function_exists('lunarFromJdn')) {
    /**
     * JST暦日のJDN（gregoriantojd()/myGregorianToJD() と同じ体系）→ 旧暦の月・日・閏。
     * テーブルの範囲外（最初の朔より前、または最終行の朔以降）は null。
     *
     * @return array{month:int, day:int, leap:bool}|null
     */
    function lunarFromJdn(int $jdn): ?array {
        $t = lunarTable();
        $n = count($t);
        if ($n < 2 || $jdn < $t[0][0] || $jdn >= $t[$n - 1][0]) {
            return null;
        }
        // 朔日 <= $jdn を満たす最後の行を二分探索
        $lo = 0; $hi = $n - 2;
        while ($lo < $hi) {
            $mid = ($lo + $hi + 1) >> 1;
            if ($t[$mid][0] <= $jdn) {
                $lo = $mid;
            } else {
                $hi = $mid - 1;
            }
        }
        return [
            'month' => (int)$t[$lo][1],
            'day'   => $jdn - (int)$t[$lo][0] + 1,
            'leap'  => (bool)$t[$lo][2],
        ];
    }
}
