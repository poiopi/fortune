<?php
declare(strict_types=1);

/**
 * tests/tools/lunar/generate-lunar-table.php
 *
 * 旧暦テーブル test.life-fun.net/inc/lunar-table.php を生成する（開発専用）。
 *
 * 実行方法（プロジェクトルートで）:
 *   php tests/tools/lunar/generate-lunar-table.php
 *   php tests/tools/lunar/generate-lunar-table.php --out=<出力先パス>   ※出力先を変える場合
 *
 * 生成後は必ず `php tests/run-all.php`（Lunar/Rokuyo スイート）を実行して
 * 国立天文台・外部カレンダーとの照合が ALL PASS であることを確認する。
 */

require_once __DIR__ . '/lunar-builder.php';

const LUNAR_GEN_FROM_YEAR = 1899;
const LUNAR_GEN_TO_YEAR   = 2101;

$out = __DIR__ . '/../../../test.life-fun.net/inc/lunar-table.php';
foreach (array_slice($argv, 1) as $arg) {
    if (str_starts_with($arg, '--out=')) $out = substr($arg, 6);
}

$rows = lunar_build(LUNAR_GEN_FROM_YEAR, LUNAR_GEN_TO_YEAR, 'high');

$first = jdtogregorian($rows[0]['jdn']);
$last  = jdtogregorian($rows[count($rows) - 1]['jdn']);
$leaps = [];
foreach ($rows as $r) {
    if ($r['leap']) {
        [$m, $d, $y] = explode('/', jdtogregorian($r['jdn']));
        $leaps[] = "{$y}:閏{$r['month']}";
    }
}

$now = (new DateTimeImmutable('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s T');
$lines = [];
$lines[] = '<?php';
$lines[] = '// ══════════════════════════════════════════════════════════════════';
$lines[] = '// 旧暦テーブル（自動生成ファイル。手で編集しないこと）';
$lines[] = '//';
$lines[] = '// 生成元  : tests/tools/lunar/generate-lunar-table.php';
$lines[] = '//            （天文計算は tests/tools/lunar/astro.php、月番号付けは lunar-builder.php）';
$lines[] = "// 生成日時: {$now}";
$lines[] = '// 再生成  : プロジェクトルートで `php tests/tools/lunar/generate-lunar-table.php` を実行し、';
$lines[] = '//            続けて `php tests/run-all.php`（Lunar/Rokuyo スイート）が ALL PASS であることを確認する。';
$lines[] = '//';
$lines[] = '// アルゴリズム';
$lines[] = '//   朔（新月）: Meeus "Astronomical Algorithms" 2nd ed. ch.49';
$lines[] = '//   中気      : 太陽視黄経が30°の倍数になる時刻。Meeus ch.32 の VSOP87 省略版（Appendix III の地球 L/B/R 項）';
$lines[] = '//               ＋ch.25 の FK5 補正＋ch.22 章動（表22.A 全63項）＋光行差 による視黄経をニュートン法で逆算';
$lines[] = '//   ΔT        : Espenak & Meeus の多項式近似（NASA "Polynomial Expressions for Delta T"。1900年未満は0秒）';
$lines[] = '//   日付      : すべて日本時間(JST=UT+9h)の暦日で判定';
$lines[] = '//';
$lines[] = '// 0時(JST)ぎりぎりの朔・中気（注意）';
$lines[] = '//   将来のΔTは外挿値のため、朔・中気が0時に極端に近い日は実際の暦と1日ずれる可能性がある。';
$lines[] = '//   （時刻は本テーブルの計算値。2026-09-30 時点の確認。詳細は tests/README.md）';
$lines[] = '//   ・朔（2026年以降で0時から60秒以内）。六曜に影響しうる：朔の日付が翌日にずれると、';
$lines[] = '//     その旧暦月（約29〜30日間）の六曜が1つずつずれる。';
$lines[] = '//       2051-11-03 23:59:09（-51秒）、2074-08-22 23:59:07（-53秒）、2097-01-13 23:59:56（-4秒）';
$lines[] = '//     参考（2026年以降で0時から5分以内）: 2035-01-10 +3分5秒、2044-11-19 -2分26秒、2050-02-22 +3分9秒、';
$lines[] = '//       2051-08-07 +4分44秒、2052-10-23 +3分4秒、2071-04-01 +3分2秒、2092-02-08 +2分35秒';
$lines[] = '//   ・中気（1900〜2100年で0時から70秒以内）。いずれも0時の反対側へずらしても全月の月番号・閏が';
$lines[] = '//     変わらないことを確認済みで、六曜に影響しない。';
$lines[] = '//       1917-09-24 00:00:14（+14秒）、1927-03-21 23:59:08（-52秒）、1950-01-20 23:59:42（-18秒）、';
$lines[] = '//       2019-11-22 23:58:53（-67秒）、2030-02-18 23:59:40（-20秒）、2053-01-19 23:58:51（-69秒）、';
$lines[] = '//       2095-12-22 00:00:27（+27秒）';
$lines[] = '//   ΔTの式を更新して再生成したとき、または国立天文台が該当年の暦要項を公開したときに再確認する';
$lines[] = '//   （最初の該当は2051年分。暦要項の公開は2050年2月頃の見込み）。';
$lines[] = '//';
$lines[] = '// 閏月ルール（冬至ルール）';
$lines[] = '//   冬至(270°)を含む月を11月とする。冬至月から次の冬至月までが13ヶ月のときだけ、';
$lines[] = '//   その間で最初の「中気を含まない月」を閏月とし、前月と同じ月番号を付ける。例外処理なし。';
$lines[] = '//   ※このルールの結果、2033年は「閏11月」になる（いわゆる2033年問題。2015年に日本カレンダー';
$lines[] = '//     暦文化振興協会が閏11月を推奨し、事実上の標準になっている）。';
$lines[] = '//';
$lines[] = '// データ形式: 1行 = 1朔望月、朔の日付の昇順';
$lines[] = '//   [0] 朔の日付の JDN（int。JST暦日。gregoriantojd()/myGregorianToJD() と同じ正午基準の暦日番号）';
$lines[] = '//   [1] 旧暦の月（int 1〜12。閏月は元の月と同じ番号）';
$lines[] = '//   [2] 閏フラグ（0=平月 / 1=閏月）';
$lines[] = '//   [3] 朔の瞬間（float。「JST基準ユリウス日」= JD(UT) + 9/24。小数6桁≒0.09秒。';
$lines[] = '//       floor(値 + 0.5) が [0] の JDN になる）';
$lines[] = "//   収録範囲: 朔 {$first}〜{$last}（m/d/Y）、" . count($rows) . '朔望月。';
$lines[] = '//   最終行の月は長さが確定しないため、旧暦日付としては最終行の朔の前日までが有効範囲。';
$lines[] = '//   閏月（朔の年:閏月番号）:';
foreach (array_chunk($leaps, 12) as $chunk) $lines[] = '//     ' . implode(' ', $chunk);
$lines[] = '//';
$lines[] = '// 読み出しは inc/lunar-calendar.php の lunarFromJdn() / lunarNewMoonMomentsJst() / lunarTable() を使う。';
$lines[] = '// ══════════════════════════════════════════════════════════════════';
$lines[] = 'return [';
foreach ($rows as $r) {
    $lines[] = sprintf('[%d,%d,%d,%.6f],', $r['jdn'], $r['month'], $r['leap'] ? 1 : 0, $r['moment']);
}
$lines[] = '];';

$content = implode("\n", $lines) . "\n";
if (file_put_contents($out, $content) === false) {
    fwrite(STDERR, "書き込み失敗: {$out}\n");
    exit(1);
}
echo "生成完了: {$out}\n";
echo '  朔望月数: ' . count($rows) . "\n";
echo "  範囲    : {$first} 〜 {$last}\n";
echo '  閏月    : ' . count($leaps) . "件\n";
exit(0);
