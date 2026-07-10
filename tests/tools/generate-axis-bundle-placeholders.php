<?php
declare(strict_types=1);

/**
 * generate-axis-bundle-placeholders.php
 *
 * 5軸から2軸を順序ありで選ぶ20通り全てについて、IdentityBundle・TodayBundleの
 * プレースホルダーを生成し、inc/axis-bundle-data.php へ書き出す。
 *
 * Step2-3b（Bundle選択エンジン）の時点では文章は仮でよい（Step2-3cで本文を書く）。
 * ここではID漏れ・タイポを防ぐため、20件全てを機械的に生成する。
 *
 * 実行方法: php tests/tools/generate-axis-bundle-placeholders.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-vocabulary.php';

function phpVal($v, int $indent): string {
    $pad = str_repeat('    ', $indent);
    $pad1 = str_repeat('    ', $indent + 1);
    if ($v === null) return 'null';
    if (is_bool($v)) return $v ? 'true' : 'false';
    if (is_int($v) || is_float($v)) return (string)$v;
    if (is_string($v)) return "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], $v) . "'";
    if (is_array($v)) {
        if (count($v) === 0) return '[]';
        $isList = array_keys($v) === range(0, count($v) - 1);
        $items = [];
        foreach ($v as $k => $item) {
            $keyPart = $isList ? '' : "'" . $k . "' => ";
            $items[] = $pad1 . $keyPart . phpVal($item, $indent + 1);
        }
        return "[\n" . implode(",\n", $items) . ",\n" . $pad . ']';
    }
    throw new Exception('unsupported type');
}

$axes = AXIS_PRIORITY_ORDER;
$identityBundles = [];
$todayBundles = [];

foreach ($axes as $primary) {
    foreach ($axes as $secondary) {
        if ($primary === $secondary) continue;
        $id1 = 'ID_' . AXIS_CODE[$primary] . '_' . AXIS_CODE[$secondary];
        $identityBundles[$id1] = [
            'archetype' => "[PLACEHOLDER] {$primary}×{$secondary}のアーキタイプ",
            'summaryBase' => "[PLACEHOLDER] あなたの本質は{$primary}と{$secondary}に支えられています。",
        ];
        $id2 = 'TD_' . AXIS_CODE[$primary] . '_' . AXIS_CODE[$secondary];
        $todayBundles[$id2] = [
            'advice' => "[PLACEHOLDER] 今日は{$primary}と{$secondary}を意識しましょう。",
            'summaryOverlay' => "[PLACEHOLDER] 今日は{$primary}・{$secondary}のエネルギーが高まっています。",
        ];
    }
}

$out = "<?php\n" .
    "declare(strict_types=1);\n\n" .
    "/**\n" .
    " * inc/axis-bundle-data.php\n" .
    " *\n" .
    " * IdentityBundle（Rule ID: ID_xxx_yyy）・TodayBundle（Rule ID: TD_xxx_yyy）の実体。\n" .
    " * 5軸から2軸を順序ありで選ぶ20通り全てを機械的に生成したプレースホルダー\n" .
    " * （tests/tools/generate-axis-bundle-placeholders.php で生成。本文はStep2-3cで書き換える）。\n" .
    " *\n" .
    " * IdentityBundle: archetype・summaryBaseのみを持つ（advice等は持たない）\n" .
    " * TodayBundle: advice・summaryOverlayのみを持つ（archetype等は持たない）\n" .
    " */\n\n" .
    "const IDENTITY_BUNDLES = " . phpVal($identityBundles, 0) . ";\n\n" .
    "const TODAY_BUNDLES = " . phpVal($todayBundles, 0) . ";\n";

file_put_contents(__DIR__ . '/../../test.life-fun.net/inc/axis-bundle-data.php', $out);
echo "Wrote " . count($identityBundles) . " IdentityBundle + " . count($todayBundles) . " TodayBundle placeholders to inc/axis-bundle-data.php\n";
