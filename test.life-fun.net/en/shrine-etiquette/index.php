<?php
require __DIR__ . '/../_inc/bootstrap.php';
$page = [
    'path'        => '/en/shrine-etiquette/',
    'title'       => 'Shrine Etiquette in Japan: What to Do, and Why',
    'description' => 'How to visit a Shinto shrine: the torii, the approach, the water basin, two bows and two claps, with the reason behind each step and rules at specific shrines.',
    'nav'         => 'etiquette',
    'crumbs'      => [['Omikuji & Shrine Guide', '/en/omikuji/'], ['Shrine etiquette', null]],
    'og'          => ['og-shrine-etiquette'],
];
require EN_INC . '/head.php';
?>
<div class="hero hero-text">
  <div>
    <div class="eyebrow">Shrine etiquette</div>
    <h1>How to visit a Shinto shrine, and why each step matters</h1>
    <p class="lead">What to do from the gate to the prayer, with the reason behind each step. If you are in a hurry, the first list is all you need.</p>
    <div class="meta"><span>Updated October 2026</span><span>Each shrine may have its own rules</span></div>
  </div>
</div>

<section id="at-a-glance" class="glance">
  <h2>At a glance</h2>
  <ol>
    <li>Bow once at the torii gate before you walk through.</li>
    <li>Walk a little to the side of the path, not down the middle.</li>
    <li>At the water basin, rinse your left hand, your right hand, then your mouth.</li>
    <li>Drop a coin gently into the offering box.</li>
    <li>If there is a bell, ring it.</li>
    <li>Bow twice, clap twice, pray, then bow once more.</li>
    <li>Don't take photos where people are praying. Eat and drink only where it is allowed.</li>
    <li>If a shrine posts its own rules, follow those first.</li>
  </ol>
</section>

<section id="steps">
  <div class="sec-head">
    <div class="num">01 — Step by step</div>
    <div>
      <h2>What to do, and why</h2>
      <p>The reasons come from the shrines' own guides where possible. Where a reason is only a popular explanation, or where accounts differ, we say so.</p>
    </div>
  </div>

  <article class="item" id="torii">
    <h3><span class="n">1</span>The torii gate</h3>
    <p class="act">Bow lightly once before you pass through the torii, the gate at the entrance.</p>
    <p class="why"><span class="why-label">Why</span>According to JNTO, the torii marks the boundary between sacred ground and the everyday world. JNTO calls a bow there the correct way to enter, though not everyone does it.</p>
  </article>

  <article class="item" id="approach">
    <h3><span class="n">2</span>The approach path</h3>
    <p class="act">Walk a little to the left or right of center, through the gate and along the path to the hall. When it is crowded, follow the flow of people.</p>
    <p class="why"><span class="why-label">Why</span>JNTO describes passing through the torii a little to the left or right of center as the custom. Writing for Nippon.com, Toya Manabu explains that many shrines regard the center of the path, called <i>seichū</i>, as reserved for the kami (the deity). Not every shrine says this.</p>
  </article>

  <article class="item" id="temizu">
    <h3><span class="n">3</span>The water basin</h3>
    <p class="act">Before you pray, purify your hands and mouth at the water basin. Don't put the ladle to your lips, and don't throw coins into the water.</p>
    <div class="steps">
      <div class="step"><?= en_img('temizu-1', 1000, 1000, 'Right hand holding a wooden ladle and pouring water over the left hand at a stone basin', 'square') ?><p><b>1</b>Hold the ladle in your right hand and rinse your left hand.</p></div>
      <div class="step"><?= en_img('temizu-2', 1000, 1000, 'Left hand holding the ladle and pouring water over the right hand', 'square') ?><p><b>2</b>Switch hands and rinse your right hand.</p></div>
      <div class="step"><?= en_img('temizu-3', 1000, 1000, 'Right hand pouring a little water from the ladle into the cupped left palm', 'square') ?><p><b>3</b>Pour a little water into your cupped left hand and rinse your mouth.</p></div>
      <div class="step"><?= en_img('temizu-4', 1000, 1000, 'Both hands holding the ladle upright so the remaining water runs down the handle', 'square') ?><p><b>4</b>Rinse your left hand once more, then tip the ladle upright so the last of the water runs down the handle.</p></div>
    </div>
    <p class="why"><span class="why-label">Why</span>According to Ise Jingu, in Shinto visitors purify themselves with water before praying to the kami. JNTO describes it as purifying body and mind before you stand before the kami. The order above is the one Ise Jingu and Meiji Jingu give. If a basin is set up differently, follow the sign there.</p>
  </article>

  <article class="item" id="offering">
    <h3><span class="n">4</span>The offering</h3>
    <p class="act">At the hall of worship, drop a coin gently into the offering box.</p>
    <p class="why"><span class="why-label">Why</span>Meiji Jingu's guide simply says you may put some coins into the box. It does not set an amount.</p>
  </article>

  <article class="item" id="bell">
    <h3><span class="n">5</span>The bell</h3>
    <p class="act">If a bell hangs above the box on a thick rope, shake the rope to ring it.</p>
    <p class="why"><span class="why-label">Why</span>JNTO explains the bell as a way to greet the kami. Not every shrine has one.</p>
  </article>

  <article class="item" id="prayer">
    <h3><span class="n">6</span>Two bows, two claps, one bow</h3>
    <p class="act">Bow deeply twice. Clap your hands twice. With your hands still together, say your prayer. Then bow deeply once more.</p>
    <div class="steps">
      <div class="step"><?= en_img('prayer-1', 1000, 1000, 'A person seen from behind dropping a coin into a wooden offering box, with a bell rope above', 'square') ?><p><b>1</b>Make your offering, and ring the bell if there is one.</p></div>
      <div class="step"><?= en_img('prayer-2', 1000, 1000, 'A person seen from the side bowing deeply at the waist', 'square') ?><p><b>2</b>Bow deeply, twice.</p></div>
      <div class="step"><?= en_img('prayer-3', 1000, 1000, 'A person seen from the side clapping in front of the chest', 'square') ?><p><b>3</b>Clap twice.</p></div>
      <div class="step"><?= en_img('prayer-4', 1000, 1000, 'A person seen from the side praying with hands pressed together and head lowered', 'square') ?><p><b>4</b>Pray with your hands together, then bow once more.</p></div>
    </div>
    <p class="why"><span class="why-label">Why</span>JNTO describes the claps as expressing joy and respect toward the kami. Meiji Jingu's guide adds that you may make a wish if you like.</p>
    <p class="why"><span class="why-label">Where it comes from</span>Writing for Nippon.com, the religious scholar Shimada Hiromi says the bow-and-clap form began as a procedure for Shinto priests in the Meiji era (1868–1912), and spread to ordinary visitors after the postwar Association of Shinto Shrines (Jinja Honchō) began recommending it.</p>
    <p class="why"><span class="why-label">Not everywhere</span>Some shrines keep their own form. Izumo Taisha in Shimane, for example, says on its official site that its formal manner is two bows, four claps and one bow.</p>
  </article>

  <article class="item" id="manners">
    <h3><span class="n">7</span>Photos, food and noise</h3>
    <p class="act">Don't take photos or videos where people are praying. Eat, drink and smoke only in designated areas, and keep your voice down.</p>
    <p class="why"><span class="why-label">Why</span>Ise Jingu asks visitors not to take pictures at the place of prayer, and allows eating, drinking and smoking only in designated areas. Meiji Jingu's rules begin with a request to "preserve the dignity of this sacred place."</p>
  </article>

  <article class="item" id="clothes">
    <h3><span class="n">8</span>Costumes and photo shoots</h3>
    <p class="act">Some shrines don't allow costumes or photo shoots. Check the shrine's rules before you go.</p>
    <p class="why"><span class="why-label">Why</span>Fushimi Inari Taisha prohibits walking around its grounds in wedding dresses or other costumes that are inappropriate for worship. It gives its reason as maintaining the dignity of a sacred site.</p>
  </article>
</section>

<section id="local-rules">
  <div class="sec-head">
    <div class="num">02 — Local rules</div>
    <div>
      <h2>Rules at specific shrines</h2>
      <p>Many shrines post their own rules, and those take priority over general advice. A few examples from their official English pages:</p>
    </div>
  </div>
  <div class="rules">
    <div class="rule">
      <h3>Fushimi Inari Taisha <span class="where">Shrine · Kyoto</span></h3>
      <p>Its "Request for All Visitors" prohibits, among other things:</p>
      <ul>
        <li>Smoking or fires, and flying drones</li>
        <li>Putting anything on top of lanterns or other structures</li>
        <li>Eating or drinking outside the marked rest areas, including eating while walking or standing</li>
        <li>Blocking narrow paths while taking photos or filming</li>
        <li>Commercial photography, or photography in prohibited areas</li>
        <li>Approaching or feeding wild birds and animals</li>
      </ul>
      <p class="small">Visitors who do not stop when asked may be asked to leave. <a href="https://inari.jp/en/request/" target="_blank" data-official="fushimi-inari">Read the full list</a></p>
    </div>
    <div class="rule">
      <h3>Meiji Jingu <span class="where">Shrine · Tokyo</span></h3>
      <ul>
        <li>No photos or videos at the main sanctuary, where people pray.</li>
        <li>No drones, running or sports.</li>
        <li>Stay on the paths in the forest, and take nothing into or out of it: no living things, flowers, branches or nuts.</li>
      </ul>
      <p class="small"><a href="https://www.meijijingu.or.jp/en/etiquette/" target="_blank" data-official="meiji-jingu">Meiji Jingu's etiquette page</a></p>
    </div>
  </div>
  <p class="small">For temple rules, including Todai-ji's, see <a href="/en/shrines-and-temples/#local-rules">shrines and temples</a>.</p>
</section>

<section id="official-sites">
  <div class="sec-head">
    <div class="num">03 — Official sites</div>
    <div>
      <h2>Check the official site before you go</h2>
      <p>Hours, rules and English-language information can change. These shrines have official pages in English.</p>
    </div>
  </div>
  <?php en_official_list('Shrine'); ?>
</section>

<section class="sources">
  <h2 class="h-small">Sources</h2>
  <ul class="plain small">
    <li>Ise Jingu, "Pray" (temizu, how to pray to kami, etiquette)</li>
    <li>Meiji Jingu, "Etiquette"</li>
    <li>Fushimi Inari Taisha, "Request for All Visitors"</li>
    <li>Japan National Tourism Organization (JNTO), "Shrine and Temple Traditions", <a href="https://www.japan.travel/" target="_blank">japan.travel</a></li>
    <li>Izumo Taisha, FAQ (in Japanese), <a href="https://izumooyashiro.or.jp/archives/faq/7898" target="_blank">izumooyashiro.or.jp</a></li>
    <li>Toya Manabu, "Sandō: The Worshipper's Path", <a href="https://www.nippon.com/en/views/b05203/" target="_blank">Nippon.com</a></li>
    <li>Shimada Hiromi, "Is There a 'Correct' Way to Pray at Temples and Shrines?", <a href="https://www.nippon.com/en/japan-topics/g02571/" target="_blank">Nippon.com</a></li>
  </ul>
</section>
<?php require EN_INC . '/foot.php';
