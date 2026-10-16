<?php
require __DIR__ . '/../_inc/bootstrap.php';
$page = [
    'path'        => '/en/shrines-and-temples/',
    'title'       => 'Shrine or Temple? How to Tell and How to Pray at Each',
    'description' => "How to tell a Shinto shrine from a Buddhist temple by the gate, the name and what's inside, what shrine names like jingu and taisha mean, how praying at a temple differs, and why the two often look alike.",
    'nav'         => 'temples',
    'crumbs'      => [['Omikuji & Shrine Guide', '/en/omikuji/'], ['Shrines and temples', null]],
    'og'          => ['og-shrines-and-temples'],
];
require EN_INC . '/head.php';
?>
<div class="hero hero-text">
  <div>
    <div class="eyebrow">Shrines and temples</div>
    <h1>Shrine or temple? How to tell, and how to pray at each</h1>
    <p class="lead">Shrines are Shinto. Temples are Buddhist. They often stand side by side and can look alike, but there are a few reliable clues, and praying at a temple is a little different.</p>
    <div class="meta"><span>Updated October 2026</span><span>Each shrine and temple may have its own rules</span></div>
  </div>
</div>

<section id="at-a-glance" class="glance">
  <h2>At a glance</h2>
  <ol>
    <li>A torii gate usually means a shrine. Temples usually have a roofed gate instead, though some large shrines have roofed gates too.</li>
    <li>Names ending in <i>-jinja</i>, <i>-jingu</i>, <i>-taisha</i> or <i>-gu</i> are usually shrines. Names ending in <i>-ji</i>, <i>-tera</i> or <i>-dera</i> are usually temples.</li>
    <li>The end of a shrine's name, such as <i>-jingu</i> or <i>-taisha</i>, says something about its history.</li>
    <li>At a temple, put your hands together and bow. There is no need to clap.</li>
    <li>If you offer incense, put out the flame by waving your hand, not by blowing.</li>
    <li>You may be asked to take off your shoes before entering a building.</li>
    <li>Watch for signs that ban photos inside halls.</li>
    <li>You can draw an omikuji at both shrines and temples.</li>
  </ol>
</section>

<section id="tell-apart">
  <div class="sec-head">
    <div class="num">01 — Telling them apart</div>
    <div>
      <h2>Three clues: the gate, the name, what's inside</h2>
      <p>No single clue is perfect, but together they usually settle it.</p>
    </div>
  </div>
  <div class="pair">
    <figure><?= en_img('gate-torii', 1000, 1000, 'A simple vermilion torii gate with two pillars and two crossbeams on a gravel path', 'square') ?><figcaption><b>Shrine:</b> a torii gate</figcaption></figure>
    <figure><?= en_img('gate-temple', 1000, 1000, 'A traditional wooden temple gate with a tiled roof and two large doors', 'square') ?><figcaption><b>Temple:</b> a roofed gate</figcaption></figure>
  </div>
  <table class="compare">
    <thead><tr><th scope="col"></th><th scope="col">Shrine <span lang="ja">神社</span></th><th scope="col">Temple <span lang="ja">寺</span></th></tr></thead>
    <tbody>
      <tr><th scope="row">Religion</th><td>Shinto</td><td>Buddhism</td></tr>
      <tr><th scope="row">Gate</th><td>A torii at the entrance. According to JNTO, every shrine has one.</td><td>A <i>sanmon</i> gate. Large ones, such as Todai-ji's and Senso-ji's, have impressive roofs and fierce guardian statues called <i>niōzō</i>.</td></tr>
      <tr><th scope="row">Name</th><td><i>-jinja</i>, <i>-jingu</i>, <i>-taisha</i>, <i>-gu</i>: Yasaka Jinja, Meiji Jingu, Fushimi Inari Taisha, Tsurugaoka Hachimangu</td><td><i>-ji</i>, <i>-tera</i>, <i>-dera</i>: Senso-ji, Todai-ji, Kiyomizu-dera</td></tr>
      <tr><th scope="row">What's inside</th><td>A hall of worship with an offering box, and often a bell</td><td>Buddhist images, and often an incense burner in front of the main hall</td></tr>
    </tbody>
  </table>
  <p class="note">Names are a useful clue, not a rule. Some places don't follow the pattern.</p>
</section>

<section id="names">
  <div class="sec-head">
    <div class="num">02 — Shrine names</div>
    <div>
      <h2>What the end of a shrine's name tells you</h2>
      <p>The last part of a shrine's name is its title, called <i>shagō</i>. Kokugakuin University's <i>Encyclopedia of Shinto</i> and its <i>Basic Terms of Shinto</i> explain the common ones.</p>
    </div>
  </div>
  <table class="compare">
    <thead><tr><th scope="col">Title</th><th scope="col">What it means</th><th scope="col">Named in this guide</th></tr></thead>
    <tbody>
      <tr><th scope="row"><i>jinja</i> <span lang="ja">神社</span></th><td>The most common title.</td><td>Yasaka Jinja</td></tr>
      <tr><th scope="row"><i>sha</i> <span lang="ja">社</span></th><td>A general title, like <i>jinja</i>.</td><td>—</td></tr>
      <tr><th scope="row"><i>gū</i> <span lang="ja">宮</span></th><td><i>Basic Terms of Shinto</i> says it is used only for shrines dedicated to the spirit of an emperor or a member of the imperial family, or for shrines with some other special historical significance.</td><td>Tsurugaoka Hachimangu</td></tr>
      <tr><th scope="row"><i>jingū</i> <span lang="ja">神宮</span></th><td>Traditionally the most exalted title, according to <i>Basic Terms of Shinto</i>. Used on its own, <i>Jingū</i> means the Grand Shrines of Ise. Other shrines use it as part of their names.</td><td>Ise Jingu, Meiji Jingu</td></tr>
      <tr><th scope="row"><i>taisha</i> <span lang="ja">大社</span></th><td>A shrine that holds a prominent place in its area, such as Izumo Taisha.</td><td>Fushimi Inari Taisha</td></tr>
    </tbody>
  </table>
  <p class="note">The right-hand column lists shrines mentioned elsewhere in this guide whose names use each title. They are not examples given by Kokugakuin.</p>
  <div class="sec-body">
    <p>Titles were standardized under the Meiji-era shrine system. After World War II, many shrines changed their titles voluntarily, and many that had been ranked <i>Kanpei Taisha</i> or <i>Kokuhei Taisha</i> shortened their titles to simply <i>Taisha</i>.</p>
    <p>You may also see older titles. Since ancient times some shrines have been called <i>Myōjin</i>, "eminent kami." In the centuries when kami and buddhas were worshipped together (see below), shrines were often called <i>Gongen</i>, "avatar," meaning a buddha appearing in the form of a kami.</p>
    <p class="note">Titles reflect a shrine's history and status. In our view, they don't tell you how worth visiting a shrine is.</p>
  </div>
</section>

<section id="temple-steps">
  <div class="sec-head">
    <div class="num">03 — At a temple</div>
    <div>
      <h2>How to pray at a temple, and why</h2>
      <p>JNTO notes that temples are not as strict as shrines about how you pray. Be calm and respectful, and follow anything the temple posts.</p>
    </div>
  </div>

  <article class="item" id="temple-water">
    <h3><span class="n">1</span>The water basin</h3>
    <p class="act">If the temple has a water basin, rinse your hands and mouth the same way you would at a shrine.</p>
    <p class="why"><span class="why-label">Why</span>Kiyomizu-dera explains that the palm of the hand is also called <i>tanagokoro</i>, "the heart of the hand," so to purify your hands is to cleanse your heart. It adds that there are no strict rules: simply rinse your hands and calm your mind.</p>
  </article>

  <article class="item" id="incense">
    <h3><span class="n">2</span>Incense</h3>
    <p class="act">Many temples sell incense for a small offering. Light a stick from the candle, put out the flame by waving your hand (don't blow it out), and stand it in the incense burner.</p>
    <p class="why"><span class="why-label">Why</span>Kiyomizu-dera describes the scent and smoke as a way to purify body and soul and calm your mind before you pray. You may see people waving the smoke toward themselves: JNTO says the smoke is believed to have healing powers.</p>
  </article>

  <article class="item" id="temple-prayer">
    <h3><span class="n">3</span>The prayer</h3>
    <div class="split">
      <div>
        <p class="act">Make your offering, put your hands together quietly, and bow. There is no need to clap.</p>
        <p class="why"><span class="why-label">Why</span>JNTO says there is no need to clap at a temple. The religious scholar Shimada Hiromi, writing for Nippon.com, notes that Buddhism has many schools and no single prescribed way to pray. Joining your hands, a gesture called <i>gasshō</i>, is in his words simply a natural gesture, not something the temple imposes.</p>
      </div>
      <?= en_img('temple-prayer', 1000, 1000, 'A person seen from the side with palms pressed together in front of an incense burner, head bowed', 'square') ?>
    </div>
  </article>

  <article class="item" id="temple-inside">
    <h3><span class="n">4</span>Inside the halls</h3>
    <p class="act">Take off your shoes where asked, and look for signs before taking photos.</p>
    <p class="why"><span class="why-label">Why</span>JNTO notes that you may need to remove your shoes in temple buildings, and that photography is forbidden inside some temples. At Todai-ji, for example, photos are not allowed inside any hall except the Great Buddha Hall.</p>
  </article>
</section>

<section id="history">
  <div class="sec-head">
    <div class="num">04 — Why they look alike</div>
    <div>
      <h2>Kami and buddhas were worshipped together for centuries</h2>
      <p>From at least the eighth century until 1868, the line between shrines and temples was blurred. This is called <i>shinbutsu shūgō</i>, the combining of kami and buddhas.</p>
    </div>
  </div>
  <div class="sec-body history">
    <h3>Buddhism arrives</h3>
    <p>Buddhism was officially introduced to the imperial court in the sixth century. The <i>Nihon shoki</i> chronicle gives the year 552; other early sources give 538.</p>
    <h3>Temples at shrines</h3>
    <p>By the Nara period (710–794), the two traditions were combining. Buddhist temples called <i>jingūji</i>, "shrine temples," were built at shrines across the country, and sutras were recited before the kami.</p>
    <h3>Kami as forms of buddhas</h3>
    <p>A later idea, <i>honji suijaku</i>, held that buddhas took on the form of kami to save people in Japan: the buddhas were the "original ground," and the kami were their "manifest traces." In the Kamakura period, some Shinto thinkers proposed the reverse: that the kami were the original ground and the buddhas their traces.</p>
    <h3>Separated in 1868</h3>
    <p>Religious scholar Shimada Hiromi explains that many sites combined a shrine and a temple. Tsurugaoka Hachimangu in Kamakura, now a shrine, was both when it was founded in the eleventh century, and its grounds once held Buddhist buildings, including a pagoda.</p>
    <p>In 1868 the new Meiji government ordered Shinto and Buddhism separated, a policy known as <i>shinbutsu bunri</i>. Buddhist titles for kami, such as <i>gongen</i>, were banned. Buddhist priests serving at shrines were told to give up their Buddhist status and serve as Shinto priests; those who refused had to leave. At Tsurugaoka Hachimangu, Shimada writes, all traces of Buddhist worship were removed.</p>
    <p>Some local officials took the order as a call to destroy Buddhism. Their campaigns, known as <i>haibutsu kishaku</i>, destroyed many temples and Buddhist treasures. The central government said this was not its aim, but its efforts to restrain the campaigns had little effect until 1871.</p>
    <h3>Today</h3>
    <p>As Shimada notes, many people making New Year visits today pay little attention to whether a place is a shrine or a temple.</p>
  </div>
</section>

<section id="omikuji-both">
  <div class="sec-head">
    <div class="num">05 — Omikuji</div>
    <div>
      <h2>You can draw omikuji at both</h2>
      <p>Senso-ji is a temple; Meiji Jingu is a shrine. Both offer omikuji.</p>
    </div>
  </div>
  <div class="sec-body">
    <p>Omikuji are found at shrines and temples alike. What is printed on them, and how many fortune levels there are, varies from place to place.</p>
    <a class="more" href="/en/omikuji/decoder/">Read your slip with the Decoder</a>
  </div>
</section>

<section id="local-rules">
  <div class="sec-head">
    <div class="num">06 — Local rules</div>
    <div>
      <h2>Rules at a specific temple</h2>
      <p>An example from an official English page. Many other places post similar rules.</p>
    </div>
  </div>
  <div class="rules">
    <div class="rule">
      <h3>Kiyomizu-dera <span class="where">Temple · Kyoto</span></h3>
      <ul>
        <li>Smoking is prohibited throughout the temple, with no smoking areas.</li>
        <li>No eating or drinking while walking around; eat and drink in the cafes and tea houses.</li>
        <li>No drones, monopods or tripods; no wedding, cosplay or fashion photo shoots.</li>
        <li>Lower your voice in the temple grounds.</li>
      </ul>
      <p class="small"><a href="https://www.kiyomizudera.or.jp/en/faq/" target="_blank" data-official="kiyomizu-dera">Kiyomizu-dera's FAQ</a></p>
    </div>
  </div>
  <p class="small">For shrine rules, including Fushimi Inari Taisha's, see <a href="/en/shrine-etiquette/#local-rules">shrine etiquette</a>.</p>
</section>

<section id="official-sites">
  <div class="sec-head">
    <div class="num">07 — Official sites</div>
    <div>
      <h2>Check the official site before you go</h2>
      <p>Hours, rules and English-language information can change. These shrines and temples have official pages in English.</p>
    </div>
  </div>
  <?php en_official_list(); ?>
</section>

<section class="sources">
  <h2 class="h-small">Sources</h2>
  <ul class="plain small">
    <li>Japan National Tourism Organization (JNTO), "Shrine and Temple Traditions", <a href="https://www.japan.travel/" target="_blank">japan.travel</a></li>
    <li>Kiyomizu-dera, "Pray" and "FAQ"</li>
    <li>Todai-ji, "Tourist Information"</li>
    <li>Kokugakuin University, Encyclopedia of Shinto: Inoue Nobutaka, "Shagō"; Satō Makoto, "Shinto and Buddhism"; Sakamoto Koremaru, "Shinbutsu Bunri", <a href="https://d-museum.kokugakuin.ac.jp/eos/" target="_blank">d-museum.kokugakuin.ac.jp</a></li>
    <li>Kokugakuin University, Basic Terms of Shinto, "Shagô" and "Honji-suijaku setsu", <a href="https://d-museum.kokugakuin.ac.jp/bts/" target="_blank">d-museum.kokugakuin.ac.jp/bts</a></li>
    <li>Shimada Hiromi, "Is There a 'Correct' Way to Pray at Temples and Shrines?", <a href="https://www.nippon.com/en/japan-topics/g02571/" target="_blank">Nippon.com</a></li>
  </ul>
</section>
<?php require EN_INC . '/foot.php';
