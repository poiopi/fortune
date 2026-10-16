<?php
if (basename($_SERVER['SCRIPT_FILENAME'] ?? '') === 'bootstrap.php') { http_response_code(404); exit; }

/**
 * en/_inc/bootstrap.php
 *
 * English section "Omikuji & Shrine Guide" (/en/). Required first by every page under en/.
 * Defines EN_GUIDE (the guard used by the other partials), loads data.php and the helpers.
 *
 * Image slots (files go in img/en/ at the document root; .webp, .jpg or .png, first found wins.
 * Until a file is placed, a gray placeholder is shown in its place):
 *   - omikuji-hero 1600x900 (#1) — used on /en/omikuji/ and decoder
 *   - temizu-1..4 1000x1000 (#2-1..2-4) — decoder + shrine-etiquette
 *   - prayer-1..4 1000x1000 (#3-1..3-4) — shrine-etiquette
 *   - temple-prayer 1000x1000 (#4) — shrines-and-temples
 *   - gate-torii, gate-temple 1000x1000 (#5-1, #5-2) — shrines-and-temples
 *   - try-box 1000x1000 (#6) — try + decoder
 *   - omikuji-tying 1000x1000 (#7) — omikuji guide
 *   - og/og-omikuji, og/og-decoder, og/og-try, og/og-shrine-etiquette, og/og-shrines-and-temples 1200x630 (#8);
 *     og/og-try-{rank} 1200x630 optional per rank (daikichi, kichi, chukichi, shokichi, hankichi, suekichi,
 *     sueshokichi, kyo) — fallback chain og-try-{rank} -> og-try -> og-omikuji -> none.
 *     Same fallback for other pages: page og -> og-omikuji -> none.
 */

define('EN_GUIDE', true);
define('EN_INC', __DIR__);
define('EN_DOCROOT', dirname(__DIR__, 2));
define('EN_BASE_URL', 'https://life-fun.net');
define('EN_GA_ID', 'G-P1EKB3WWX8');
define('EN_SITE_NAME', 'Omikuji & Shrine Guide');

require EN_INC . '/data.php';

/** HTML-escape. */
function en_e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Cache-busting version for a file under en/assets/. */
function en_asset(string $file): string
{
    $path = EN_DOCROOT . '/en/assets/' . $file;
    $v = is_file($path) ? (string) filemtime($path) : '0';
    return '/en/assets/' . $file . '?v=' . $v;
}

/**
 * Find an image under img/en/ by slug. Returns the file name relative to img/en/ or null.
 * @param string[] $exts
 */
function en_find_img(string $slug, array $exts = ['webp', 'jpg', 'png']): ?string
{
    foreach ($exts as $ext) {
        $rel = $slug . '.' . $ext;
        if (is_file(EN_DOCROOT . '/img/en/' . $rel)) return $rel;
    }
    return null;
}

/** Illustration slot: the image if the file exists, otherwise a placeholder. */
function en_img(string $slug, int $w, int $h, string $alt, string $variant): string
{
    $file = en_find_img($slug);
    if ($file !== null) {
        $load = $variant === 'hero' ? 'fetchpriority="high"' : 'loading="lazy"';
        return '<img src="/img/en/' . en_e($file) . '" width="' . $w . '" height="' . $h . '" alt="' . en_e($alt)
            . '" ' . $load . ' decoding="async" class="ill ill-' . en_e($variant) . '">';
    }
    return '<div class="ph ph-' . en_e($variant) . '" role="img" aria-label="' . en_e($alt) . '"><span>Illustration slot<br>img/en/'
        . en_e($slug) . '.webp<br>' . $w . ' × ' . $h . '</span></div>';
}

/**
 * Absolute og:image URL for the first existing slug in the chain, or null.
 * @param string[] $chain slugs under img/en/og/
 */
function en_og_image(array $chain): ?string
{
    foreach ($chain as $slug) {
        $file = en_find_img('og/' . $slug, ['jpg', 'png', 'webp']);
        if ($file !== null) return EN_BASE_URL . '/img/en/' . $file;
    }
    return null;
}

/**
 * Official sites list ($EN_OFFICIAL).
 * $type 'Shrine' or 'Temple' lists only that type (shrine etiquette page: shrines only).
 * null lists both, each under its own heading, so shrines and temples are never mixed in one row.
 */
function en_official_list(?string $type = null): void
{
    global $EN_OFFICIAL;
    $groups = $type === null ? ['Shrine' => 'Shrines', 'Temple' => 'Temples'] : [$type => null];
    foreach ($groups as $t => $heading) {
        if ($heading !== null) echo '<h3 class="official-h">' . en_e($heading) . '</h3>';
        echo '<ul class="official">';
        foreach ($EN_OFFICIAL as $o) {
            if ($o['type'] !== $t) continue;
            echo '<li><a class="o-name" href="' . en_e($o['url']) . '" target="_blank" data-official="' . en_e($o['key']) . '">'
                . en_e($o['name']) . '</a><span class="o-meta">' . en_e($o['type']) . ' · ' . en_e($o['place']) . '</span>'
                . '<span class="o-note">' . en_e($o['note']) . '</span></li>';
        }
        echo '</ul>';
    }
    $who = $type === 'Shrine' ? 'these shrines' : ($type === 'Temple' ? 'these temples' : 'these shrines and temples');
    echo '<p class="small">Links open the official site in a new tab. We are not affiliated with ' . $who . '.</p>';
}
