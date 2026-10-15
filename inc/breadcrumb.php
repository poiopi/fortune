<?php
/* ══════════════════════════════════════════
   パンくず（共通部品）
   1つの配列から「表示パンくず（nav.breadcrumb）」と「JSON-LD（BreadcrumbList）」の両方を出力する。
   ・先頭はサイト名（inc/site.php の SITE_NAME）
   ・中間階層の名前は inc/breadcrumb-map.php の辞書（BREADCRUMB_MAP）で一元管理
   ・JSON-LDは json_encode で組み立てる（htmlspecialchars は使わない）

   必須変数（requireの前にセットする）：
     $bcPath  このページのURLパス（例 '/articles/tarot/fool/'）
     $bcName  このページの表示名（表示パンくずの最後の文字列。エスケープ前の生の文字列で渡す）
   任意変数：
     $bcTrail 例外ページ用。先頭〜自ページまでを丸ごと指定する
              [['name' => SITE_NAME, 'url' => '/'], ..., ['name' => '自ページ', 'url' => '/path/']]
              指定時は $bcPath / $bcName より優先。呼び出し後に unset される

   使用例：
     <?php $bcPath = '/articles/tarot/fool/'; $bcName = '愚者（THE FOOL）'; require __DIR__.'/../../../inc/breadcrumb.php'; ?>
   使用例（テンプレート）：
     <?php $bcPath = '/articles/seiza/'.$sign['slug'].'/'; $bcName = $sign['name'].'とは'; require __DIR__.'/../../inc/breadcrumb.php'; ?>

   辞書に無い祖先パスがあると E_USER_WARNING を出し、その段は飛ばす（機械チェックで検出するため）。
══════════════════════════════════════════ */
require_once __DIR__.'/site.php';
require_once __DIR__.'/breadcrumb-map.php';

if (isset($bcTrail) && is_array($bcTrail) && $bcTrail) {
    $_bcItems = [];
    foreach ($bcTrail as $_bcT) {
        $_bcItems[] = ['name' => (string)$_bcT['name'], 'url' => (string)$_bcT['url']];
    }
} else {
    $_bcItems = [['name' => SITE_NAME, 'url' => '/']];
    $_bcSelf  = (string)($bcPath ?? '');
    $_bcSegs  = array_values(array_filter(explode('/', trim($_bcSelf, '/')), 'strlen'));
    $_bcAcc   = '/';
    for ($_bcI = 0; $_bcI < count($_bcSegs) - 1; $_bcI++) {
        $_bcAcc .= $_bcSegs[$_bcI].'/';
        if (isset(BREADCRUMB_MAP[$_bcAcc])) {
            $_bcItems[] = ['name' => BREADCRUMB_MAP[$_bcAcc], 'url' => $_bcAcc];
        } else {
            trigger_error('breadcrumb.php: BREADCRUMB_MAP にパスがありません: '.$_bcAcc.'（'.$_bcSelf.'）', E_USER_WARNING);
        }
    }
    $_bcItems[] = ['name' => (string)($bcName ?? ''), 'url' => $_bcSelf];
}

$_bcLast = count($_bcItems) - 1;
$_bcHtml = [];
$_bcLd   = [];
foreach ($_bcItems as $_bcI => $_bcItem) {
    $_bcEsc = htmlspecialchars($_bcItem['name'], ENT_QUOTES);
    $_bcHtml[] = ($_bcI === $_bcLast)
        ? $_bcEsc
        : '<a href="'.htmlspecialchars($_bcItem['url'], ENT_QUOTES).'">'.$_bcEsc.'</a>';
    $_bcLd[] = [
        '@type'    => 'ListItem',
        'position' => $_bcI + 1,
        'name'     => $_bcItem['name'],
        'item'     => SITE_URL.$_bcItem['url'],
    ];
}
echo '<nav class="breadcrumb" aria-label="パンくずリスト">'.implode('<span>›</span>', $_bcHtml).'</nav>'."\n";
echo '<script type="application/ld+json">'.json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => $_bcLd,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG).'</script>'."\n";

unset($bcTrail, $_bcItems, $_bcSelf, $_bcSegs, $_bcAcc, $_bcI, $_bcItem, $_bcT, $_bcLast, $_bcHtml, $_bcLd, $_bcEsc);
