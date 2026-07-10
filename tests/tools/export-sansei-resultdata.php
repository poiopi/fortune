<?php
declare(strict_types=1);

/**
 * export-sansei-resultdata.php
 *
 * axis-aggregation-snapshot.php と同じ50組み合わせに対して sanseiEngine() を実行し、
 * 完成したSanseiResult（version/archetype/summary/advice/scores/influence/meta）を
 * tests/cases/sansei-resultdata-snapshot.php へ全件保存する（shichu/tarot/seizaと同じ
 * 「全件保存」方式）。
 *
 * 実行方法: php tests/tools/export-sansei-resultdata.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/shichu-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/tarot-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';

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

$aggSnapshot = require __DIR__ . '/../cases/axis-aggregation-snapshot.php';

$snapshotCases = [];
foreach ($aggSnapshot['cases'] as $case) {
    $shichuResult = shichuEngine([
        'year' => $case['shichuInput']['year'], 'month' => $case['shichuInput']['month'],
        'day' => $case['shichuInput']['day'], 'hour' => $case['shichuInput']['hour'],
        'gender' => $case['shichuInput']['gender'],
    ]);
    $tarotResult = tarotEngine($case['tarotInput']['cardOrder'], $case['tarotInput']['isUpright']);
    $seizaResult = seizaEngine($case['seizaInput']['month'], $case['seizaInput']['day'], $case['seizaInput']['timeZoneCode']);

    $sanseiResult = sanseiEngine(['shichu' => $shichuResult, 'tarot' => $tarotResult, 'seiza' => $seizaResult]);

    $snapshotCases[] = [
        'shichuInput' => $case['shichuInput'],
        'tarotInput' => $case['tarotInput'],
        'seizaInput' => $case['seizaInput'],
        'sanseiResult' => $sanseiResult,
    ];
}

$doc = [
    'generator' => 'test.life-fun.net/inc/axis-engine.php sanseiEngine() (Step2-4完成版)',
    'note' => 'version/archetype/summary/advice/scores/influence/metaを含む完全なSanseiResultのスナップショット。50件全件保存。',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => count($snapshotCases),
    'cases' => $snapshotCases,
];

$out = "<?php\n" .
    "// tests/cases/sansei-resultdata-snapshot.php\n" .
    "// SanseiResult（完成形）のスナップショット。\n" .
    "// 生成元: tests/tools/export-sansei-resultdata.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/sansei-resultdata-snapshot.php', $out);
echo "Wrote " . count($snapshotCases) . " SanseiResult snapshots to tests/cases/sansei-resultdata-snapshot.php\n";
