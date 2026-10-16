<?php if (!defined('EN_GUIDE')) { http_response_code(404); exit; }
/**
 * en/_inc/head.php — <head>, site header and breadcrumb. Opens <main>; en/_inc/foot.php closes it.
 * Expects $page = [
 *   'path' => '/en/…/',           canonical / og:url = EN_BASE_URL . path (never includes the query string)
 *   'title', 'description',
 *   'nav' => 'omikuji'|'decoder'|'try'|'etiquette'|'temples'|'' (current header item),
 *   'crumbs' => [[label, url|null], …] (BreadcrumbList + visible breadcrumb when 2 or more),
 *   'og' => [slug, …]              og:image chain under img/en/og/ (first existing file; og-omikuji is appended),
 *   'scripts' => [file, …]         extra files under en/assets/ loaded by foot.php (optional),
 * ]
 */
ob_start();

$enCanonical = EN_BASE_URL . $page['path'];
$enOgChain = array_values(array_unique(array_merge((array) ($page['og'] ?? []), ['og-omikuji'])));
$enOgImage = en_og_image($enOgChain);
$enCrumbs = $page['crumbs'] ?? [];
$enNav = [
    'omikuji'   => ['Omikuji', '/en/omikuji/'],
    'decoder'   => ['Decoder', '/en/omikuji/decoder/'],
    'try'       => ['Practice omikuji', '/en/omikuji/try/'],
    'etiquette' => ['Shrine etiquette', '/en/shrine-etiquette/'],
    'temples'   => ['Shrines &amp; temples', '/en/shrines-and-temples/'],
];
?>
<!doctype html>
<html lang="en">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= EN_GA_ID ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?= EN_GA_ID ?>');
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= en_e($page['title']) ?></title>
<meta name="description" content="<?= en_e($page['description']) ?>">
<link rel="canonical" href="<?= en_e($enCanonical) ?>">
<meta property="og:title" content="<?= en_e($page['title']) ?>">
<meta property="og:description" content="<?= en_e($page['description']) ?>">
<meta property="og:url" content="<?= en_e($enCanonical) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= en_e(EN_SITE_NAME) ?>">
<meta property="og:locale" content="en_US">
<?php if ($enOgImage !== null): ?>
<meta property="og:image" content="<?= en_e($enOgImage) ?>">
<meta name="twitter:card" content="summary_large_image">
<?php else: ?>
<meta name="twitter:card" content="summary">
<?php endif; ?>
<link rel="icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&amp;display=swap">
<!--EN_JA_FONT-->
<link rel="stylesheet" href="<?= en_e(en_asset('en.css')) ?>">
<?php if (count($enCrumbs) >= 2):
    $enLd = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => []];
    foreach ($enCrumbs as $i => $c) {
        $item = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => html_entity_decode($c[0], ENT_QUOTES, 'UTF-8')];
        if ($c[1] !== null) $item['item'] = EN_BASE_URL . $c[1];
        $enLd['itemListElement'][] = $item;
    }
?>
<script type="application/ld+json"><?= json_encode($enLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<?php endif; ?>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<header class="site-header">
  <div class="wrap bar">
    <a class="brand" href="/en/omikuji/">Omikuji <i>&amp;</i> Shrine Guide</a>
    <nav class="site-nav" aria-label="Main">
<?php foreach ($enNav as $key => [$label, $href]): $on = ($page['nav'] ?? '') === $key; ?>
      <a<?= $on ? ' class="on" aria-current="page"' : '' ?> href="<?= $href ?>"><?= $label ?></a>
<?php endforeach; ?>
    </nav>
  </div>
</header>
<main class="wrap" id="main">
<?php if (count($enCrumbs) >= 2): ?>
  <nav class="crumb" aria-label="Breadcrumb">
    <ol>
<?php foreach ($enCrumbs as $c): ?>
<?php if ($c[1] !== null): ?>
      <li><a href="<?= en_e($c[1]) ?>"><?= en_e($c[0]) ?></a></li>
<?php else: ?>
      <li aria-current="page"><?= en_e($c[0]) ?></li>
<?php endif; ?>
<?php endforeach; ?>
    </ol>
  </nav>
<?php endif; ?>
