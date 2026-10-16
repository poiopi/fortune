<?php
require __DIR__ . '/../../_inc/bootstrap.php';
$page = [
    'path'        => '/en/omikuji/decoder/',
    'title'       => 'Omikuji Decoder: Read Your Japanese Fortune Slip',
    'description' => 'Match the kanji on your omikuji to this chart: fortune levels such as 大吉 and 末吉, common topic headings with their other spellings, and frequent phrases.',
    'nav'         => 'decoder',
    'crumbs'      => [['Omikuji & Shrine Guide', '/en/omikuji/'], ['Decoder', null]],
    'og'          => ['og-decoder'],
];
require EN_INC . '/head.php';
?>
<div class="hero">
  <div>
    <div class="eyebrow">Omikuji Decoder</div>
    <h1>Read the fortune slip you drew in Japan</h1>
    <p class="lead">Many omikuji are printed only in Japanese. Hold your slip next to this page and match the characters. You don't need to know any Japanese.</p>
    <div class="meta"><span>Updated October 2026</span><span>Not affiliated with any shrine or temple</span></div>
  </div>
  <?= en_img('omikuji-hero', 1600, 900, 'Folded white paper fortune slips tied in rows on wooden racks', 'hero') ?>
</div>

<section id="levels">
  <div class="sec-head">
    <div class="num">01 — Level</div>
    <div>
      <h2>Find your fortune level</h2>
      <p>Look for the largest characters, usually near the top of your slip. That is your overall fortune.</p>
    </div>
  </div>
  <div class="ranks">
    <?php foreach ($EN_RANKS as $r): if ($r['group'] !== 'main') continue; ?>
      <div class="rank<?= !empty($r['best']) ? ' best' : '' ?>"><span class="k" lang="ja"><?= en_e($r['ja']) ?></span><span class="r"><?= en_e($r['romaji']) ?></span><span class="m"><?= en_e($r['en']) ?></span></div>
    <?php endforeach; ?>
  </div>
  <p class="rare-row">Less common:
    <?php foreach ($EN_RANKS as $r): if ($r['group'] !== 'rare') continue; ?>
      <span class="rare"><span lang="ja"><?= en_e($r['ja']) ?></span> <i><?= en_e($r['romaji']) ?></i> — <?= en_e($r['en']) ?></span>
    <?php endforeach; ?>
  </p>
  <p class="note">The levels, and their order, vary by shrine and temple. Some places use only a few levels; some list <span lang="ja">吉</span> above <span lang="ja">中吉</span>, others below it. If you want to know where your result ranks, ask at the place where you drew it.</p>
</section>

<section id="topics">
  <div class="sec-head">
    <div class="num">02 — Topics</div>
    <div>
      <h2>Find each topic on your slip</h2>
      <p>Below the level, the slip gives a line or two on each topic. The heading is usually the first word of the line. The same topic can be written in more than one way, so we show the other spellings too.</p>
    </div>
  </div>
  <table class="topics">
    <thead><tr><th scope="col">On your slip</th><th scope="col">Reading</th><th scope="col">What it's about</th></tr></thead>
    <tbody>
    <?php foreach ($EN_TOPICS as $t): ?>
      <tr>
        <td class="k"><span lang="ja"><?= en_e($t['ja']) ?></span><?php if ($t['also']): ?><small><span class="also">Also written as</span> <span lang="ja"><?= implode('</span><span class="sep">, </span><span lang="ja">', array_map('en_e', $t['also'])) ?></span></small><?php endif; ?></td>
        <td class="r"><?= en_e($t['romaji']) ?></td>
        <td class="m"><strong><?= en_e($t['title']) ?></strong> <?= en_e($t['desc']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <p class="note">Not every slip has every topic, and some slips have topics that are not listed here.</p>
</section>

<section id="phrases">
  <div class="sec-head">
    <div class="num">03 — Phrases</div>
    <div>
      <h2>Words you'll see again and again</h2>
      <p>Topic lines are short, and many end with one of these. The English is a translation of what the slip says, not a promise about your future.</p>
    </div>
  </div>
  <div class="phrases">
    <?php foreach ($EN_PHRASES as $p): ?>
      <div class="phrase"><div class="k" lang="ja"><?= en_e($p['ja']) ?></div><div class="r"><?= en_e($p['romaji']) ?></div><p><?= en_e($p['en']) ?></p></div>
    <?php endforeach; ?>
  </div>
  <p class="note">Slips are often written in an older, formal style, so the same idea can appear in slightly different forms from the ones shown here.</p>
</section>

<section id="slip-parts">
  <div class="sec-head">
    <div class="num">04 — The rest</div>
    <div>
      <h2>The other parts of the slip</h2>
      <p>Besides the level and the topics, you may see these.</p>
    </div>
  </div>
  <table class="topics">
    <thead><tr><th scope="col">On your slip</th><th scope="col">Reading</th><th scope="col">What it is</th></tr></thead>
    <tbody>
    <?php foreach ($EN_SLIP_PARTS as $t): ?>
      <tr>
        <td class="k"><span lang="ja"><?= en_e($t['ja']) ?></span><?php if ($t['also']): ?><small><span class="also">Also written as</span> <span lang="ja"><?= implode('</span><span class="sep">, </span><span lang="ja">', array_map('en_e', $t['also'])) ?></span></small><?php endif; ?></td>
        <td class="r"><?= en_e($t['romaji']) ?></td>
        <td class="m"><?= en_e($t['en']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <div class="sec-body">
    <p>The poem is part of the message, not decoration: at Meiji Jingu, the omikuji is built around the poem instead of a fortune level. A classical poem needs more than a word list to translate, so if your slip has one, ask at the counter or look for an English version of that slip.</p>
    <p>Some slips also include a short passage about your fortune as a whole. Where it sits on the slip, and whether it has a heading, varies. JNTO notes that omikuji always explain how to improve your fortune. The <a href="/en/omikuji/try/">practice slip</a> has an overall passage you can read.</p>
  </div>
</section>

<section>
  <div class="try">
    <?= en_img('try-box', 1000, 1000, 'Two hands tilting a hexagonal wooden box so a thin stick slides out of the hole at the top', 'square') ?>
    <div>
      <div class="eyebrow">Practice before your trip</div>
      <h2>Try a practice omikuji</h2>
      <p>Draw one slip a day, laid out like the real thing, and read it with this page. It is for practice only: a real omikuji is received at a shrine or temple.</p>
      <a class="btn" href="/en/omikuji/try/">Draw today's slip</a>
      <p class="small">One draw per day · No sign-up</p>
    </div>
  </div>
</section>

<section>
  <div class="sec-head">
    <div class="num">05 — When you arrive</div>
    <div>
      <h2>Purify your hands and mouth before you pray</h2>
      <p>At a shrine, you rinse your hands and mouth at the water basin before you pray. This is the order Ise Jingu and Meiji Jingu give in their English guides.</p>
    </div>
  </div>
  <div class="steps">
    <div class="step"><?= en_img('temizu-1', 1000, 1000, 'Right hand holding a wooden ladle and pouring water over the left hand at a stone basin', 'square') ?><p><b>1</b>Hold the ladle in your right hand and rinse your left hand.</p></div>
    <div class="step"><?= en_img('temizu-2', 1000, 1000, 'Left hand holding the ladle and pouring water over the right hand', 'square') ?><p><b>2</b>Switch hands and rinse your right hand.</p></div>
    <div class="step"><?= en_img('temizu-3', 1000, 1000, 'Right hand pouring a little water from the ladle into the cupped left palm', 'square') ?><p><b>3</b>Pour a little water into your cupped left hand and rinse your mouth. Don't put the ladle to your lips.</p></div>
    <div class="step"><?= en_img('temizu-4', 1000, 1000, 'Both hands holding the ladle upright so the remaining water runs down the handle', 'square') ?><p><b>4</b>Rinse your left hand once more, then tip the ladle upright so the last of the water runs down the handle.</p></div>
  </div>
  <a class="more" href="/en/shrine-etiquette/">Read the full shrine etiquette guide</a>
</section>

<section class="sources">
  <h2 class="h-small">Sources</h2>
  <ul class="plain small">
    <li>Japan National Tourism Organization (JNTO), "Draw an 'Omikuji' Fortune Slip at Japan's Temples or Shrines", <a href="https://www.japan.travel/" target="_blank">japan.travel</a></li>
    <li>Meiji Jingu, "Omikuji (oracles)" and "Etiquette", <a href="https://www.meijijingu.or.jp/en/" target="_blank" data-official="meiji-jingu">meijijingu.or.jp</a></li>
    <li>Japan Tourism Agency, "Omikuji and Omigokoro", <a href="https://www.mlit.go.jp/tagengo-db/en/H30-00533.html" target="_blank">mlit.go.jp</a></li>
    <li>Ise Jingu, "Pray", <a href="https://www.isejingu.or.jp/en/" target="_blank" data-official="ise-jingu">isejingu.or.jp</a></li>
  </ul>
</section>
<?php require EN_INC . '/foot.php';
