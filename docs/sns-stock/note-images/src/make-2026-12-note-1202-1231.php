<?php
// note 画像の HTML を docs/sns-stock/note-images/src/ に作る（12/2〜12/31：見出し画像 30枚＋本文の図）。各画像の中身は make-2026-12-calls.php。
// 画像化は Chrome headless（NOTE_RULES.md 8章）。デザインは make-2026-10-note-1027-1108.php と同じ。
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

// ---- 本文の図：2系列の棒グラフ（MBTI） ----
$bars2 = function (string $id, string $kicker, string $a, string $b, array $rows, int $seed) use ($dir, $head, $stars, $h) {
    $max = max(55, ceil(max(array_merge(array_column($rows, 1), array_column($rows, 2))) / 5) * 5 + 5);
    $list = '';
    foreach ($rows as [$label, $va, $vb]) {
        $wa = round($va / $max * 100, 1); $wb = round($vb / $max * 100, 1);
        $list .= "<div class=\"row\"><div class=\"lab\">{$h($label)}</div><div class=\"bars\">"
            . "<div class=\"bar a\" style=\"width:{$wa}%\"><span>" . number_format($va, 1) . "%</span></div>"
            . "<div class=\"bar b\" style=\"width:{$wb}%\"><span>" . number_format($vb, 1) . "%</span></div></div></div>\n";
    }
    $html = $head . <<<C
  .line.top { top: 60px; } .line.bottom { top: 610px; }
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

// ---- 本文の図：12星座の1系列の棒グラフ＋平均線 ----
$signBars = function (string $id, string $kicker, array $signs, float $avg, float $scale, int $seed) use ($dir, $head, $stars, $h) {
    $list = '';
    foreach ($signs as [$n, $v]) {
        $w = round($v / $scale * 100, 1);
        $cls = $v > $avg ? 'hi' : '';
        $list .= "<div class=\"row\"><div class=\"lab\">{$h($n)}</div><div class=\"track\"><div class=\"bar $cls\" style=\"width:{$w}%\"><span>" . number_format($v, 1) . "%</span></div></div></div>\n";
    }
    $frac = round($avg / $scale, 4);
    $avgTxt = number_format($avg, 1);
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
  .avg { position: absolute; top: 112px; height: 456px; left: calc(150px + 118px + (1280px - 300px - 118px) * $frac); border-left: 2px dashed rgba(255,255,255,.55); }
  .avgl { position: absolute; top: 574px; left: calc(150px + 118px + (1280px - 300px - 118px) * $frac - 60px); width: 120px; text-align: center; font-size: 18px; color: #d7cbff; }
  .brand { top: 626px; font-size: 22px; }
</style></head>
<body>
<svg class="stars" width="1280" height="670" id="s"></svg>
<div class="line top"></div>
<div class="kicker">{$h($kicker)}</div>
<div class="chart">
$list</div>
<div class="avg"></div><div class="avgl">平均 {$avgTxt}%</div>
<div class="line bottom"></div>
<div class="brand">みつぼし占い ｜ life-fun.net　（Love Engine 全9216通りの診断結果より）</div>

C . $stars($seed);
    file_put_contents($dir . $id . '-1.html', $html);
};

// ---- 本文の図：週の六曜と吉日（weekly-1026-1 と同じ形） ----
$weekImg = function (string $id, string $kicker, array $days, int $seed) use ($dir) {
    $week = '';
    foreach ($days as [$d, $wd, $rk, $rc, $tags]) {
        $hot = ($tags !== [] || $rc !== '') ? ' hot' : '';
        $t = '';
        foreach ($tags as $tag) { [$name, $cls] = array_pad(explode('|', $tag), 2, ''); $t .= "<div class=\"tag $cls\">$name</div>"; }
        $week .= "  <div class=\"day$hot\"><div class=\"date\">$d</div><div class=\"wd\">$wd</div><div class=\"rk $rc\">$rk</div>$t</div>\n";
    }
    $html = file_get_contents($dir . '2026-10-note-weekly-1026-1.html');
    $html = preg_replace('#<div class="kicker">.*?</div>#u', "<div class=\"kicker\">― $kicker ―</div>", $html, 1);
    $html = preg_replace('#<div class="week">.*?</div>\n</div>#su', "<div class=\"week\">\n" . rtrim($week) . "\n</div>", $html, 1);
    $html = str_replace('let seed = 23;', "let seed = $seed;", $html);
    file_put_contents($dir . $id . '-1.html', $html);
};

require __DIR__ . '/make-2026-12-calls.php';
echo "ok
";
