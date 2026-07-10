<?php
declare(strict_types=1);

/**
 * export-love-composer-snapshot.php
 *
 * Composer（inc/love-composer.php）の組立ロジックを9216通り全数で固定する
 * Snapshot。固定したいのは文章ではなくアルゴリズムであるため、文言バンクは
 * ダミー（文言＝"{項目名}:{区分}"というIDそのもの）を使う。
 *
 * このSnapshotが保証する契約：
 *   - Primitive/Style/Tendencyの区分 → 正しいID参照
 *   - articleLinksがInfluence順に並ぶ
 *   - 記事URLが無いsource（候補null）は除外される
 *   - ResultDocumentの出力スキーマが変わらない
 *
 * 本物のText Bank・Writing Rulesを待たない理由：それらを混ぜると「Composerの
 * ロジックが壊れた」のか「文章を直しただけ」なのか差分から判別できなくなる。
 * 文章込みの最終Golden Masterは、Text Bank・Writing Rules実装後に別途作る。
 *
 * bundleTextはBundle選定ロジック（Love Domain側、未実装）が無いため固定ダミー。
 * Bundle実装後もこのSnapshotは更新不要（ComposerはbundleTextを素通しするだけ）。
 *
 * articleLinks候補は現実の状況を模したダミー（mbti/seizaは記事あり、bloodは
 * 記事未作成のためnull）で固定する。
 *
 * 実行方法: php tests/tools/export-love-composer-snapshot.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-primitive-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-style.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-tendency.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-normalizer.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-composer.php';

$snapshot = require __DIR__ . '/../cases/love-style-tendency-snapshot.php';
$stCases = $snapshot['cases'];
$total = count($stCases);
if ($total !== 9216) throw new Exception("love-style-tendency-snapshot.phpは9216件のはずが{$total}件");

// ダミー文言バンク：文言＝ID（"{項目名}:{区分}"）
$styleTextBank = [];
foreach (array_keys(LOVE_STYLE_MAPPING) as $name) {
    $styleTextBank[$name] = ['Low' => "{$name}:Low", 'Mid' => "{$name}:Mid", 'High' => "{$name}:High"];
}
$tendencyTextBank = [];
foreach (array_keys(LOVE_TENDENCY_MAPPING) as $name) {
    $tendencyTextBank[$name] = ['Low' => "{$name}:Low", 'Mid' => "{$name}:Mid", 'High' => "{$name}:High"];
}

// ダミーarticleLinks候補（現実を模す：blood記事は未作成のためnull）
$articleLinkCandidates = [
    'mbti'  => ['url' => 'mbti-article', 'label' => 'MBTI'],
    'blood' => null,
    'seiza' => ['url' => 'seiza-article', 'label' => 'SEIZA'],
];

// Influence算出用に、sourceごとのtraitsを事前計算（export-love-primitives.phpと同じ方針）
$mbtiTraitsByType = [];
foreach (array_keys(MBTI_DATA) as $t) $mbtiTraitsByType[$t] = mbti_computeTraits($t);
$bloodTraitsByType = [];
foreach (array_keys(BLOOD_DATA) as $t) $bloodTraitsByType[$t] = blood_computeTraits($t);
$seizaTraitsByPair = [];
for ($sign = 0; $sign < 12; $sign++) {
    for ($inner = 0; $inner < 12; $inner++) {
        $seizaTraitsByPair["$sign,$inner"] = seiza_computeTraits($sign, $inner);
    }
}

$cases = [];
$articleOrderCounts = [];

foreach ($stCases as $case) {
    $input = $case['input'];
    $normStyles = love_normalizeStyles($case['expected']['styles']);
    $normTendencies = love_normalizeTendencies($case['expected']['tendencies']);

    $influence = axis_computeInfluence([
        'mbti'  => ['traits' => $mbtiTraitsByType[$input['mbti']]],
        'blood' => ['traits' => $bloodTraitsByType[$input['blood']]],
        'seiza' => ['traits' => $seizaTraitsByPair["{$input['seizaSign']},{$input['seizaInnerType']}"]],
    ]);

    $doc = love_composeResult(
        'BUNDLE_PLACEHOLDER',
        $normStyles,
        $normTendencies,
        $styleTextBank,
        $tendencyTextBank,
        $influence,
        $articleLinkCandidates
    );

    $orderKey = implode('>', array_column($doc['articleLinks'], 'source'));
    $articleOrderCounts[$orderKey] = ($articleOrderCounts[$orderKey] ?? 0) + 1;

    $cases[] = [
        'input' => $input,
        'expected' => [
            'influence' => $influence,
            'document' => $doc,
        ],
    ];
}

echo "全数生成: {$total}件\n";
echo "\n=== articleLinks並び順の内訳 ===\n";
arsort($articleOrderCounts);
foreach ($articleOrderCounts as $order => $count) {
    echo sprintf("%-14s %5d件 (%.1f%%)\n", $order, $count, $count / $total * 100);
}

// ─────────────────────────────────────────────
// PHP値変換・書き出し
// ─────────────────────────────────────────────
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

$doc = [
    'generator' => 'love_composeResult()（実運用コード）＋ダミーText Bank（文言=ID）＋ダミーarticle候補',
    'basedOn' => 'tests/cases/love-style-tendency-snapshot.php（9216通り全数）＋axis_computeInfluence()',
    'note' => 'bundleTextは固定ダミー（Bundle選定ロジック未実装のため）。文章の内容ではなくComposerの組立アルゴリズム（ID参照・Influence順ソート・null除外・出力スキーマ）を固定する',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => $total,
    'cases' => $cases,
];

$out = "<?php\n" .
    "// tests/cases/love-composer-snapshot.php\n" .
    "// Composer Snapshot: 組立アルゴリズム（IDベース）を9216通り全件で固定した期待値。\n" .
    "// 文言・Bundle本文は含まない（ダミー）。生成元: tests/tools/export-love-composer-snapshot.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/love-composer-snapshot.php', $out);
echo "\nWrote {$total} cases to tests/cases/love-composer-snapshot.php\n";
