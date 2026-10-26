<?php
// note 画像の HTML を docs/sns-stock/note-images/src/ に作る（見出し画像 11枚＋本文の図 5枚）。
// 画像化は Chrome headless（NOTE_RULES.md 8章）。デザインは 2026-10-note-weekly-1026*.html と同じ。
$dir = 'C:/Users/sende/fortune/docs/sns-stock/note-images/src/';
$head = <<<'H'
<!doctype html>
<html lang="ja"><head><meta charset="utf-8">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700;900&display=block">
<style>
  html, body { margin: 0; width: 1280px; height: 670px; overflow: hidden; }
  body { font-family: "Noto Sans JP", "Yu Gothic", sans-serif; background: radial-gradient(ellipse at 75% 0%, #7a4fd6 0%, #4a2f9a 38%, #24164f 75%, #1a1130 100%); color: #f4f0ff; position: relative; }
  .stars { position: absolute; inset: 0; }
  .line { position: absolute; left: 80px; right: 80px; height: 2px; background: #a98a4f; opacity: .8; }
  .brand { position: absolute; width: 100%; text-align: center; color: #b9a9e6; opacity: .85; }
  .kicker { position: absolute; width: 100%; text-align: center; color: #f2c95a; font-weight: 700; letter-spacing: .04em; text-shadow: 0 2px 6px rgba(0,0,0,.4); }
H;
$stars = fn (int $seed) => <<<S
<script>
  let seed = $seed; const rnd = () => (seed = (seed * 16807) % 2147483647) / 2147483647;
  const s = document.getElementById('s');
  for (let i = 0; i < 220; i++) { const c = document.createElementNS('http://www.w3.org/2000/svg', 'circle'); c.setAttribute('cx', (rnd() * 1280).toFixed(1)); c.setAttribute('cy', (rnd() * 670).toFixed(1)); c.setAttribute('r', (rnd() * 1.3 + 0.4).toFixed(2)); c.setAttribute('fill', '#ffffff'); c.setAttribute('opacity', (rnd() * 0.6 + 0.25).toFixed(2)); s.appendChild(c); }
</script>
</body></html>
S;
$h = fn (string $s) => htmlspecialchars($s, ENT_QUOTES);

// ---- 見出し画像 ----
$eye = function (string $id, string $kicker, string $title, string $sub, int $seed, int $titleSize = 68) use ($dir, $head, $stars, $h) {
    $html = $head . <<<C
  .line.top { top: 150px; } .line.bottom { top: 520px; }
  .kicker { top: 190px; font-size: 34px; }
  .title { position: absolute; top: 262px; width: 100%; text-align: center; font-weight: 900; font-size: {$titleSize}px; letter-spacing: .02em; text-shadow: 0 4px 10px rgba(0,0,0,.5); }
  .sub { position: absolute; top: 410px; width: 100%; text-align: center; font-size: 32px; color: #d7cbff; }
  .brand { top: 578px; font-size: 26px; }
</style></head>
<body>
<svg class="stars" width="1280" height="670" id="s"></svg>
<div class="line top"></div>
<div class="kicker">― {$h($kicker)} ―</div>
<div class="title">{$h($title)}</div>
<div class="sub">{$h($sub)}</div>
<div class="line bottom"></div>
<div class="brand">みつぼし占い ｜ life-fun.net</div>

C . $stars($seed);
    file_put_contents($dir . $id . '.html', $html);
};
$eye('2026-10-note-ichiryumanbai', '暦と行事の豆知識', '一粒万倍日とは？', '始めるのに良いこと・避けたいこと', 31);
$eye('2026-10-note-numerology', '占いのしくみ', '数秘術は何を見ている？', '生年月日から「運命数」を出すしくみ', 37);
$eye('2026-10-note-byakko', '守護霊の読み物', 'お稲荷さんの狐は神様？', '守護霊「白狐」にこめられた意味', 41);
$eye('2026-10-note-mbti-ei', 'MBTI×恋愛', 'EとIで恋の進め方はどう違う？', '恋愛傾向診断のデータで比べる', 43, 60);
$eye('2026-11-note-tower', 'タロット1枚ずつ', '「塔」は不吉なカード？', '崩れることの本当の意味', 47);
$eye('2026-11-note-rittou', '暦と行事の豆知識', '11月7日は立冬', '暦の上で冬が始まる日と二十四節気', 53);
$eye('2026-11-note-seiza-kekkon', '12星座の恋愛', '結婚を意識しやすい星座は？', '恋愛傾向診断のデータで比べる', 59, 64);
$eye('2026-11-note-kyusei', '占いのしくみ', '九星気学は何を見ている？', '本命星の出し方と「立春」の区切り', 61, 64);
$eye('2026-11-note-zense', '前世の読み物', '前世診断はどう楽しむ？', '「輪廻転生」と「カルマ」の考え方', 67);
$eye('2026-11-note-mbti-jp', 'MBTI×恋愛', 'JとPで恋愛はどう違う？', '恋愛傾向診断のデータで比べる', 71);
$eye('2026-11-note-weekly-1109', '来週の吉日・暦', '11/9〜11/15の吉日', '新月と寅の日・巳の日', 73);

// ---- 本文の図：棒グラフ（2系列） ----
$bars2 = function (string $id, string $kicker, string $a, string $b, array $rows, int $seed) use ($dir, $head, $stars, $h) {
    $max = 50;
    $list = '';
    foreach ($rows as [$label, $va, $vb]) {
        $wa = round($va / $max * 100, 1); $wb = round($vb / $max * 100, 1);
        $list .= "<div class=\"row\"><div class=\"lab\">{$h($label)}</div><div class=\"bars\">"
            . "<div class=\"bar a\" style=\"width:{$wa}%\"><span>" . number_format($va, 1) . "%</span></div>"
            . "<div class=\"bar b\" style=\"width:{$wb}%\"><span>" . number_format($vb, 1) . "%</span></div></div></div>\n";
    }
    $html = $head . <<<C
  .line.top { top: 60px; } .line.bottom { top: 600px; }
  .kicker { top: 78px; font-size: 30px; }
  .legend { position: absolute; top: 132px; width: 100%; text-align: center; font-size: 22px; color: #d7cbff; }
  .legend i { display: inline-block; width: 22px; height: 14px; border-radius: 4px; margin: 0 8px 0 22px; vertical-align: middle; }
  .chart { position: absolute; top: 174px; left: 100px; right: 100px; display: flex; flex-direction: column; gap: 10px; }
  .row { display: flex; align-items: center; gap: 18px; }
  .lab { width: 170px; text-align: right; font-size: 24px; font-weight: 700; }
  .bars { flex: 1; display: flex; flex-direction: column; gap: 3px; }
  .bar { height: 18px; border-radius: 0 6px 6px 0; position: relative; min-width: 4px; }
  .bar span { position: absolute; left: calc(100% + 10px); top: -5px; font-size: 19px; white-space: nowrap; }
  .a { background: #f2c95a; } .b { background: #9b86e8; }
  .line.bottom { top: 610px; }
  .brand { top: 624px; font-size: 22px; }
  .note { position: absolute; top: 576px; width: 100%; text-align: center; font-size: 18px; color: #b9a9e6; }
</style></head>
<body>
<svg class="stars" width="1280" height="670" id="s"></svg>
<div class="line top"></div>
<div class="kicker">{$h($kicker)}</div>
<div class="legend"><i style="background:#f2c95a"></i>{$h($a)}<i style="background:#9b86e8"></i>{$h($b)}</div>
<div class="chart">
$list</div>
<div class="note">Love Engine 全9216通りの診断結果で「高め」と出た割合（診断のしくみの上での傾向）</div>
<div class="line bottom"></div>
<div class="brand">みつぼし占い ｜ life-fun.net</div>

C . $stars($seed);
    file_put_contents($dir . $id . '-1.html', $html);
};
$bars2('2026-10-note-mbti-ei', 'MBTIの「E」と「I」で比べる恋愛傾向', 'E（外向）', 'I（内向）', [
    ['積極性', 43.1, 14.7], ['愛情表現', 39.4, 25.5], ['惚れやすさ', 32.2, 32.2],
    ['包容力', 19.8, 44.1], ['恋愛の慎重さ', 19.1, 45.4], ['結婚志向', 23.2, 41.4], ['浮気耐性', 20.2, 46.1],
], 79);
$bars2('2026-11-note-mbti-jp', 'MBTIの「J」と「P」で比べる恋愛傾向', 'J（判断）', 'P（知覚）', [
    ['結婚志向', 44.1, 20.5], ['恋愛の慎重さ', 42.9, 21.5], ['包容力', 44.1, 19.8], ['浮気耐性', 42.3, 24.0],
    ['惚れやすさ', 19.4, 44.9], ['嫉妬深さ', 22.2, 34.2], ['積極性', 28.9, 28.9],
], 83);

// ---- 本文の図：12星座の結婚志向 ----
$signs = [['牡牛座', 64.8], ['山羊座', 43.2], ['乙女座', 39.3], ['獅子座', 38.3], ['蠍座', 38.3], ['水瓶座', 32.0],
    ['牡羊座', 25.3], ['蟹座', 25.3], ['双子座', 20.3], ['天秤座', 20.3], ['射手座', 20.3], ['魚座', 20.3]];
$list = '';
foreach ($signs as [$n, $v]) {
    $w = round($v / 70 * 100, 1);
    $cls = $v > 32.3 ? 'hi' : '';
    $list .= "<div class=\"row\"><div class=\"lab\">$n</div><div class=\"track\"><div class=\"bar $cls\" style=\"width:{$w}%\"><span>" . number_format($v, 1) . "%</span></div></div></div>\n";
}
$html = $head . <<<C
  .line.top { top: 46px; } .line.bottom { top: 612px; }
  .kicker { top: 62px; font-size: 30px; }
  .chart { position: absolute; top: 118px; left: 150px; right: 150px; display: flex; flex-direction: column; gap: 8px; }
  .row { display: flex; align-items: center; gap: 18px; height: 30px; }
  .lab { width: 100px; text-align: right; font-size: 22px; font-weight: 700; }
  .track { flex: 1; position: relative; }
  .bar { height: 22px; border-radius: 0 6px 6px 0; background: #9b86e8; position: relative; }
  .bar.hi { background: #f2c95a; }
  .bar span { position: absolute; left: calc(100% + 10px); top: -3px; font-size: 20px; white-space: nowrap; }
  .avg { position: absolute; top: 112px; height: 456px; left: calc(150px + 118px + (1280px - 300px - 118px) * 0.4614); border-left: 2px dashed rgba(255,255,255,.55); }
  .avgl { position: absolute; top: 574px; left: calc(150px + 118px + (1280px - 300px - 118px) * 0.4614 - 60px); width: 120px; text-align: center; font-size: 18px; color: #d7cbff; }
  .brand { top: 626px; font-size: 22px; }
</style></head>
<body>
<svg class="stars" width="1280" height="670" id="s"></svg>
<div class="line top"></div>
<div class="kicker">12星座別「結婚志向」が高めに出る割合</div>
<div class="chart">
$list</div>
<div class="avg"></div><div class="avgl">平均 32.3%</div>
<div class="line bottom"></div>
<div class="brand">みつぼし占い ｜ life-fun.net　（Love Engine 全9216通りの診断結果より）</div>

C . $stars(89);
file_put_contents($dir . '2026-11-note-seiza-kekkon-1.html', $html);

// ---- 本文の図：洛書 ----
$cells = [4, 9, 2, 3, 5, 7, 8, 1, 6];
$grid = implode('', array_map(fn ($n) => "<div class=\"c\">$n</div>", $cells));
$html = $head . <<<C
  .line.top { top: 60px; } .line.bottom { top: 600px; }
  .kicker { top: 78px; font-size: 30px; }
  .grid { position: absolute; top: 150px; left: 150px; width: 400px; height: 400px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
  .c { border: 2px solid rgba(242,201,90,.6); border-radius: 14px; background: rgba(20,12,45,.4); display: flex; align-items: center; justify-content: center; font-size: 72px; font-weight: 900; }
  .grid .c:nth-child(5) { background: rgba(242,201,90,.18); border-color: #f2c95a; }
  .exp { position: absolute; top: 180px; left: 640px; right: 100px; font-size: 30px; line-height: 1.75; }
  .exp b { color: #f2c95a; }
  .brand { top: 616px; font-size: 22px; }
</style></head>
<body>
<svg class="stars" width="1280" height="670" id="s"></svg>
<div class="line top"></div>
<div class="kicker">九星気学のルーツとされる「洛書（らくしょ）」</div>
<div class="grid">$grid</div>
<div class="exp">1〜9の数字を3×3に並べた図。<br>縦・横・斜め、<br>どの列を足しても<br><b>15</b> になる「魔方陣」です。<br>4＋5＋6＝15　2＋5＋8＝15</div>
<div class="line bottom"></div>
<div class="brand">みつぼし占い ｜ life-fun.net</div>

C . $stars(97);
file_put_contents($dir . '2026-11-note-kyusei-1.html', $html);

// ---- 本文の図：11/9〜11/15 の週（weekly-1026-1 と同じ形） ----
$days = [
    ['11/9', '月', '仏滅', '', ['新月|moon']], ['11/10', '火', '大安', 'taian', []], ['11/11', '水', '赤口', '', []],
    ['11/12', '木', '先勝', '', ['寅の日']], ['11/13', '金', '友引', '', []], ['11/14', '土', '先負', '', []],
    ['11/15', '日', '仏滅', '', ['巳の日']],
];
$week = '';
foreach ($days as [$d, $wd, $rk, $rc, $tags]) {
    $hot = ($tags !== [] || $rc !== '') ? ' hot' : '';
    $t = '';
    foreach ($tags as $tag) { [$name, $cls] = array_pad(explode('|', $tag), 2, ''); $t .= "<div class=\"tag $cls\">$name</div>"; }
    $week .= "  <div class=\"day$hot\"><div class=\"date\">$d</div><div class=\"wd\">$wd</div><div class=\"rk $rc\">$rk</div>$t</div>\n";
}
$html = file_get_contents($dir . '2026-10-note-weekly-1026-1.html');
$html = preg_replace('#<div class="kicker">.*?</div>#u', '<div class="kicker">― 11/9〜11/15 の六曜と吉日 ―</div>', $html, 1);
$html = preg_replace('#<div class="week">.*?</div>\n</div>#su', "<div class=\"week\">\n" . rtrim($week) . "\n</div>", $html, 1);
$html = str_replace('let seed = 23;', 'let seed = 101;', $html);
file_put_contents($dir . '2026-11-note-weekly-1109-1.html', $html);

echo "ok\n";
