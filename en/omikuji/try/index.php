<?php
require __DIR__ . '/../../_inc/bootstrap.php';

// ?r= : a shared practice result. Only the 8 practice slugs are accepted; the raw value is never echoed.
$shared = null;
$enR = $_GET['r'] ?? null;
if (is_string($enR) && array_key_exists($enR, $EN_TRY_WEIGHTS)) {
    foreach ($EN_RANKS as $enRow) {
        if ($enRow['slug'] === $enR) { $shared = $enRow; break; }
    }
}

$page = [
    'path'        => '/en/omikuji/try/',   // canonical is always /en/omikuji/try/, with or without ?r=
    'title'       => 'Try a Practice Omikuji Online (One Draw a Day)',
    'description' => 'Draw one practice omikuji a day, laid out like a real Japanese fortune slip with kanji and English. For practice only, not issued by any shrine or temple.',
    'nav'         => 'try',
    'crumbs'      => [['Omikuji & Shrine Guide', '/en/omikuji/'], ['Practice omikuji', null]],
    'og'          => $shared ? ['og-try-' . $shared['slug'], 'og-try'] : ['og-try'],
    'scripts'     => ['try.js'],
];
require EN_INC . '/head.php';
?>
<div class="hero">
  <div>
    <div class="eyebrow">Practice omikuji</div>
    <h1>Draw a practice omikuji</h1>
    <p class="lead">One slip a day, laid out like a real one: the kanji as you'd see them on paper, with English underneath. Then try reading it with the Decoder.</p>
    <div class="meta"><span>One draw per day</span><span>No sign-up</span><span>Practice only. Not issued by any shrine or temple</span></div>
  </div>
  <?= en_img('try-box', 1000, 1000, 'Two hands holding a hexagonal wooden box upside down as a thin stick slides out of the hole', 'square') ?>
</div>

<?php if ($shared): ?>
<section class="shared" id="shared">
  <p class="eyebrow">A shared slip</p>
  <p>Someone shared a practice slip with you: <span class="k" lang="ja"><?= en_e($shared['ja']) ?></span> <i><?= en_e($shared['romaji']) ?></i>, <?= en_e(strtolower($shared['en'])) ?>. Draw your own below.</p>
</section>
<?php endif; ?>

<section id="draw" class="draw">
  <div class="draw-box" id="draw-box">
    <!-- state A (not drawn today) -->
    <div class="draw-start" id="draw-start">
      <h2>Today's slip</h2>
      <p>Take a breath, think of a question if you like, and draw. You get one slip per day, so you can't draw again for a better result.</p>
      <button type="button" class="btn" id="draw-btn">Draw today's slip</button>
    </div>
    <!-- state B (drawn): JS fills #slip and shows #after -->
    <div class="slip" id="slip" hidden aria-live="polite"></div>
    <div class="after" id="after" hidden>
      <p class="small" id="after-note">You've drawn today's slip. Come back tomorrow for another.</p>
      <div class="after-actions">
        <button type="button" class="btn" id="save-btn">Save as image</button>
        <button type="button" class="btn btn-line" id="share-btn">Share link</button>
      </div>
      <p class="small" id="share-msg" role="status"></p>
    </div>
  </div>
  <p class="note">This is a practice slip made by this site, for learning to read omikuji. It is not issued by, or connected with, any shrine or temple. The levels and lines are chosen at random and are not based on any real shrine's or temple's slips. The English shows what the Japanese says. Neither is a prediction.</p>
</section>

<section id="how-to-read">
  <div class="sec-head">
    <div class="num">How to read it</div>
    <div>
      <h2>Read it like a real slip</h2>
      <p>Real slips are laid out much the same way, so you can practice here.</p>
    </div>
  </div>
  <ol class="howto sec-body">
    <li><b>The number.</b> <span lang="ja">第〇番</span> at the top is the slip number, written in kanji numerals.</li>
    <li><b>The level.</b> The large characters are your overall fortune. Find them in the <a href="/en/omikuji/decoder/#levels">level chart</a>.</li>
    <li><b>The poem.</b> On a real slip a poem usually sits here. This practice slip leaves the space blank, because a real poem deserves a real translation.</li>
    <li><b>The overall reading.</b> Some slips include a short passage about your fortune as a whole. The practice slip has one under the poem space, written in classical Japanese.</li>
    <li><b>The topics.</b> Each line starts with a topic heading, such as <span lang="ja">願望</span> or <span lang="ja">待人</span>. Look them up in the <a href="/en/omikuji/decoder/#topics">topic table</a>, then find the ending in the <a href="/en/omikuji/decoder/#phrases">phrase list</a>.</li>
  </ol>
  <p class="small sec-body">Practice slips leave out illness, childbirth and market dealings. Real slips often include them. The Decoder covers those too.</p>
</section>

<section>
  <div class="cards2">
    <a class="card-link" href="/en/omikuji/decoder/">
      <span class="eyebrow">Read your slip</span>
      <span class="card-title">Omikuji Decoder</span>
      <span class="card-desc">Levels, topics and common phrases, in kanji with English.</span>
    </a>
    <a class="card-link" href="/en/omikuji/">
      <span class="eyebrow">At the shrine</span>
      <span class="card-title">How to draw a real omikuji</span>
      <span class="card-desc">Drawing, reading, and whether to tie it or take it home.</span>
    </a>
  </div>
</section>

<?php /* JS slip template (rendered into #slip), all text from data:
  <div class="slip-paper">
    <div class="slip-title" lang="ja">おみくじ</div>          (vertical-feel title; small)
    <div class="slip-no"><span lang="ja">第二十三番</span><span class="en">No. 23</span></div>
    <div class="slip-rank"><span class="k" lang="ja">大吉</span><span class="r">daikichi</span><span class="en">Great good luck</span></div>
    <p class="slip-note">{EN_TRY_NOTE[rank]}</p>
    <div class="slip-poem"><span>Poem space</span></div>
    <div class="slip-sum"><p lang="ja">{summary ja}</p><p class="r">{romaji}</p><p class="en">{English}</p></div>   ($EN_TRY_SUMMARY[rank][no % 2])
    <dl class="slip-lines">  (7 rows, order of $EN_TRY_LINES)
      <div><dt><span lang="ja">願望</span><span class="r">ganbō</span></dt><dd><span lang="ja">叶う</span><span class="r">kanau</span><span class="en">Your wish: It comes true.</span></dd></div>
    </dl>
    <div class="slip-foot">Practice slip · life-fun.net · not issued by any shrine or temple</div>
  </div>
  English topic label in dd uses $EN_TOPICS title without the period, e.g. "Your wish", "The person you are waiting for".
*/ ?>
<?php
// Data for en/assets/try.js. Every character drawn on the slip (page or canvas) is in here,
// so the Noto Serif JP text= subset built in foot.php covers it.
$enTryRanks = [];
foreach ($EN_RANKS as $enRow) {
    if (isset($EN_TRY_WEIGHTS[$enRow['slug']])) {
        $enTryRanks[] = ['slug' => $enRow['slug'], 'ja' => $enRow['ja'], 'romaji' => $enRow['romaji'], 'en' => $enRow['en']];
    }
}
$enTryTopics = [];
foreach ($EN_TOPICS as $enT) {
    $enTryTopics[$enT['ja']] = rtrim($enT['title'], '.');
}
$enTryData = [
    'ranks'   => $enTryRanks,
    'weights' => $EN_TRY_WEIGHTS,
    'tone'    => $EN_TRY_TONE,
    'lines'   => $EN_TRY_LINES,
    'note'    => $EN_TRY_NOTE,
    'summary' => $EN_TRY_SUMMARY,
    'topicRomaji' => $EN_TRY_TOPIC_ROMAJI,
    'lineRomaji'  => $EN_TRY_LINE_ROMAJI,
    'topics'  => $enTryTopics,
    // Slip title and the kanji used for the slip number (第〇番).
    // Practice-slip title: plain おみくじ (御神籤 is a shrine word; this slip stands for shrines and temples alike).
    'slip'    => ['title' => 'おみくじ', 'dai' => '第', 'ban' => '番', 'digits' => ['', '一', '二', '三', '四', '五', '六', '七', '八', '九'], 'ten' => '十', 'hundred' => '百'],
];
?>
<script id="en-try-data" type="application/json"><?= json_encode($enTryData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<?php require EN_INC . '/foot.php';
