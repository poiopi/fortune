<?php
require __DIR__ . '/../_inc/bootstrap.php';
$page = [
    'path'        => '/en/omikuji/',
    'title'       => 'Omikuji Guide: How to Draw and Read a Fortune Slip in Japan',
    'description' => 'How omikuji fortune slips work at Japanese shrines and temples: drawing one, reading the levels, tying or keeping it, and where to find slips in English.',
    'nav'         => 'omikuji',
    'crumbs'      => [],
    'og'          => ['og-omikuji'],
];
require EN_INC . '/head.php';
?>
<div class="hero">
  <div>
    <div class="eyebrow">Omikuji guide</div>
    <h1>Omikuji: the paper fortunes of Japan's shrines and temples</h1>
    <p class="lead">At many shrines and temples in Japan you can draw an omikuji, a small paper slip with a fortune written on it. Here is how to draw one, how to read it, and what to do with it afterward.</p>
    <div class="meta"><span>Updated October 2026</span><span>Not affiliated with any shrine or temple</span></div>
  </div>
  <?= en_img('omikuji-hero', 1600, 900, 'Folded white paper fortune slips tied in rows on wooden racks', 'hero') ?>
</div>

<section>
  <div class="sec-head">
    <div class="num">01 — What it is</div>
    <div>
      <h2>What an omikuji is</h2>
      <p>A slip of paper with an overall fortune and short lines of advice, received at a shrine or temple.</p>
    </div>
  </div>
  <div class="sec-body">
    <p>The largest characters on the slip give your overall fortune level, such as <span lang="ja">大吉</span> (<i>daikichi</i>, great good luck). Below that come short lines on topics such as your wish, travel, study and love.</p>
    <p>According to the Japan National Tourism Organization (JNTO), omikuji have nearly 1,000 years of history and are said to have begun when people drew lots to seek divine guidance on matters such as choosing a successor. JNTO adds that popular slips traditionally carried a classical Chinese or Japanese poem, with an explanation in modern Japanese.</p>
  </div>
</section>

<section>
  <div class="sec-head">
    <div class="num">02 — Drawing one</div>
    <div>
      <h2>How to draw an omikuji</h2>
      <p>The details vary by shrine and temple, but the classic method looks like this.</p>
    </div>
  </div>
  <ol class="howto sec-body">
    <li><b>Make the offering.</b> JNTO says the amount is typically about 100 to 200 yen. If you are not sure, ask at the counter.</li>
    <li><b>Shake the box.</b> Shake the wooden box of numbered sticks until one stick slides out of the small hole.</li>
    <li><b>Read the number.</b> The stick has a number on it. You then receive the slip with that number. How this works differs from place to place, so ask if you are unsure.</li>
    <li><b>Read your slip.</b> Start with the large characters, then the topic lines. The <a href="/en/omikuji/decoder/">Omikuji Decoder</a> lists the kanji you are most likely to see.</li>
  </ol>
  <p class="note sec-body">Some places use other methods, including vending machines. JNTO mentions Nishiki Tenmangu in Kyoto, where a mechanical lion brings you your slip.</p>
</section>

<section>
  <div class="sec-head">
    <div class="num">03 — Levels</div>
    <div>
      <h2>Fortune levels differ from place to place</h2>
      <p>There is no single official list.</p>
    </div>
  </div>
  <div class="sec-body">
    <p>JNTO lists five levels, from best to worst: <span lang="ja">大吉</span> <i>daikichi</i>, <span lang="ja">吉</span> <i>kichi</i>, <span lang="ja">中吉</span> <i>chūkichi</i>, <span lang="ja">小吉</span> <i>shōkichi</i> and <span lang="ja">凶</span> <i>kyō</i>. Many shrines and temples use more, such as <span lang="ja">半吉</span> or <span lang="ja">末吉</span>, and the position of <span lang="ja">吉</span> is not the same everywhere.</p>
    <p>Some omikuji have no fortune level at all. At Meiji Jingu in Tokyo, each slip carries one of 30 waka (short classical Japanese poems) by Emperor Meiji and Empress Shōken instead of a level, and the shrine says the poems come with English translations.</p>
    <p>If you draw <span lang="ja">凶</span> (bad luck), JNTO's advice is not to be discouraged: an omikuji also explains how to improve your fortune, so read the rest of it carefully.</p>
    <a class="more" href="/en/omikuji/decoder/">See every level in the Decoder</a>
  </div>
</section>

<section>
  <div class="sec-head">
    <div class="num">04 — Afterward</div>
    <div>
      <h2>Tie it, or take it home?</h2>
      <p>Either can be right. It depends on the result and on the place.</p>
    </div>
  </div>
  <div class="split sec-body">
    <div>
      <p>JNTO describes the general custom: people take a good result home so the luck stays with them, and tie a bad one at a designated place in the grounds. That place is usually a set of strings or racks put up for omikuji.</p>
      <p>Customs vary by shrine and temple. If you tie your slip, use the place that has been provided for it.</p>
    </div>
    <?= en_img('omikuji-tying', 1000, 1000, 'Two hands tying a narrow folded paper slip onto a thin string beside other tied slips', 'square') ?>
  </div>
</section>

<section>
  <div class="sec-head">
    <div class="num">05 — In English</div>
    <div>
      <h2>Where to find omikuji in English</h2>
      <p>Many slips are printed only in Japanese, but some places offer English versions.</p>
    </div>
  </div>
  <div class="sec-body">
    <p>JNTO lists these places as offering omikuji in English:</p>
    <ul class="plain">
      <li>Senso-ji, a temple in Tokyo</li>
      <li>Narita-san Shinsho-ji, a temple in Chiba</li>
      <li>Tsurugaoka Hachimangu, a shrine in Kamakura, Kanagawa</li>
      <li>Nishiki Tenmangu, a shrine in Kyoto</li>
      <li>Kushida Shrine, a shrine in Fukuoka</li>
    </ul>
    <p>Meiji Jingu offers its waka omikuji with English translations. Things change, so check the official site or ask at the counter before you rely on this list.</p>
  </div>
</section>

<section>
  <div class="cards2">
    <a class="card-link" href="/en/omikuji/decoder/">
      <span class="eyebrow">Read your slip</span>
      <span class="card-title">Omikuji Decoder</span>
      <span class="card-desc">Match the kanji on your slip: levels, topics and common phrases.</span>
    </a>
    <a class="card-link" href="/en/omikuji/try/">
      <span class="eyebrow">Practice before your trip</span>
      <span class="card-title">Try a practice omikuji</span>
      <span class="card-desc">One draw a day, laid out like a real slip.</span>
    </a>
  </div>
  <p class="small sec-body-none">Visiting a shrine first? Read <a href="/en/shrine-etiquette/">shrine etiquette</a> or <a href="/en/shrines-and-temples/">how to tell a shrine from a temple</a>.</p>
</section>

<section class="sources">
  <h2 class="h-small">Sources</h2>
  <ul class="plain small">
    <li>Japan National Tourism Organization (JNTO), "Draw an 'Omikuji' Fortune Slip at Japan's Temples or Shrines", <a href="https://www.japan.travel/" target="_blank">japan.travel</a></li>
    <li>Meiji Jingu, "Omikuji (oracles)", <a href="https://www.meijijingu.or.jp/en/" target="_blank" data-official="meiji-jingu">meijijingu.or.jp</a></li>
    <li>Japan Tourism Agency, "Omikuji and Omigokoro", <a href="https://www.mlit.go.jp/tagengo-db/en/H30-00533.html" target="_blank">mlit.go.jp</a></li>
  </ul>
</section>
<?php require EN_INC . '/foot.php';
