<?php if (!defined('EN_GUIDE')) { http_response_code(404); exit; }
/**
 * en/_inc/foot.php — closes <main>, site footer, scripts.
 * Then replaces <!--EN_JA_FONT--> (head.php) with a Noto Serif JP link limited (text=) to the
 * Japanese characters that actually appear in this page's output, including the JSON for try.js.
 */
?>
</main>
<footer class="site-footer">
  <div class="wrap foot">
    <div>
      <p><strong>How this guide was made.</strong> Written by life-fun.net and checked against the official websites of the shrines and temples it quotes, the Japan National Tourism Organization (JNTO) and Nippon.com. The illustrations are AI-generated and do not show any real shrine or temple.</p>
      <p>Not affiliated with any shrine or temple. The practice omikuji is for learning and fun only.</p>
      <p>© life-fun.net</p>
    </div>
    <nav aria-label="Footer">
      <ul>
        <li><a href="/en/omikuji/">Omikuji guide</a></li>
        <li><a href="/en/omikuji/decoder/">Omikuji Decoder</a></li>
        <li><a href="/en/omikuji/try/">Practice omikuji</a></li>
        <li><a href="/en/shrine-etiquette/">Shrine etiquette</a></li>
        <li><a href="/en/shrines-and-temples/">Shrines and temples</a></li>
        <li><a href="/en/privacy/">Privacy</a></li>
        <li><a href="/">fortune-telling (Japanese)</a></li>
      </ul>
    </nav>
  </div>
</footer>
<script src="<?= en_e(en_asset('en.js')) ?>" defer></script>
<?php foreach (($page['scripts'] ?? []) as $enScript): ?>
<script src="<?= en_e(en_asset($enScript)) ?>" defer></script>
<?php endforeach; ?>
</body>
</html>
<?php
$enHtml = (string) ob_get_clean();
$enChars = [];
if (preg_match_all('/[\x{3000}-\x{30FF}\x{3400}-\x{9FFF}\x{F900}-\x{FAFF}\x{FF00}-\x{FFEF}]/u', $enHtml, $enM)) {
    $enChars = array_values(array_unique($enM[0]));
    usort($enChars, static fn(string $a, string $b): int => mb_ord($a, 'UTF-8') <=> mb_ord($b, 'UTF-8'));
}
$enFont = '';
if ($enChars) {
    $enFontUrl = 'https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@500;700&display=swap&text=' . rawurlencode(implode('', $enChars));
    $enFont = '<link rel="stylesheet" href="' . en_e($enFontUrl) . '">';
}
echo str_replace('<!--EN_JA_FONT-->', $enFont, $enHtml);
