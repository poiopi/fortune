<?php
require __DIR__ . '/../_inc/bootstrap.php';
$page = [
    'path'        => '/en/privacy/',
    'title'       => 'Privacy Notice · Omikuji & Shrine Guide',
    'description' => 'What the English Omikuji & Shrine Guide collects through Google Analytics and Google AdSense, what stays on your device, and how to contact us.',
    'nav'         => '',
    'crumbs'      => [['Omikuji & Shrine Guide', '/en/omikuji/'], ['Privacy', null]],
    'og'          => [],
];
require EN_INC . '/head.php';
?>
<div class="hero hero-text">
  <div>
    <div class="eyebrow">Privacy</div>
    <h1>Privacy notice</h1>
    <p class="lead">This notice covers the English pages of the Omikuji &amp; Shrine Guide on life-fun.net (the pages under /en/).</p>
    <div class="meta"><span>Updated October 2026</span></div>
  </div>
</div>

<section>
  <div class="prose">
    <h2>What we collect</h2>
    <p>We use Google Analytics 4 to understand how these pages are used: which pages are visited, roughly where visitors are and which sites sent them, what kind of device and browser they use, and a few actions on the page, such as drawing a practice omikuji (including which level came up), saving or sharing a slip, or clicking a link to a shrine's or temple's official site. When we record a click on an official site, we record which site it was.</p>
    <p>Google Analytics uses cookies and similar technologies to do this. We do not use it to identify you personally, and we do not ask for your name or email address to use these pages. Google's own handling of this data is described in <a href="https://policies.google.com/technologies/partner-sites" target="_blank">How Google uses information from sites or apps that use its services</a>.</p>

    <h2>What stays on your device</h2>
    <p>The practice omikuji remembers today's slip so that you get one draw per day. It stores the date and your result in your browser's local storage. This stored copy stays in your browser and is not sent to us. The level you draw is counted in Google Analytics, as described above, and if you share a link to your slip, the level is part of the link's address. You can remove it at any time by clearing this site's data in your browser.</p>
    <p>If you save a slip as an image, the image is made in your browser and saved to your device. It is not uploaded anywhere.</p>

    <h2>Advertising</h2>
    <p>These pages show ads served by Google AdSense, a third-party advertising service. Google and other third-party ad vendors may use cookies to show ads based on your past visits to this site and other sites. You can learn more in <a href="https://policies.google.com/technologies/ads" target="_blank">Google's advertising policy</a>, and you can turn off personalized ads in <a href="https://adssettings.google.com/" target="_blank">Google's Ad Settings</a>.</p>
    <p>If you are in the European Economic Area, the United Kingdom or Switzerland, you will be asked for your consent before personalized ads are shown.</p>

    <h2>Your choices</h2>
    <p>You can block or delete cookies in your browser settings. Google also offers a <a href="https://tools.google.com/dlpage/gaoptout" target="_blank">browser add-on to opt out of Google Analytics</a>.</p>

    <h2>Contact</h2>
    <p>For questions about this notice, use the site's <a href="/contact">contact form</a>. The form is in Japanese, but you are welcome to write in English.</p>

    <p class="small">The rest of life-fun.net is in Japanese and has its own <a href="/privacy" lang="ja">プライバシーポリシー</a> (privacy policy).</p>
  </div>
</section>
<?php require EN_INC . '/foot.php';
