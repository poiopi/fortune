<?php
declare(strict_types=1);

/**
 * export-love-composer-snapshot.php
 *
 * Composer（inc/love-composer.php）の組立ロジックを9216通り全数で固定する
 * Snapshot。固定したいのは文章ではなくアルゴリズムであるため、文言バンクは
 * ダミー（文言＝"{項目名}:{区分}"というIDそのもの）を使う。
 *
 * 区分は本番（inc/love-orchestrator.php）と同じ6段階（love_normalizeStyles6()・
 * love_normalizeTendencies6()の出力 L1〜L6）を使い、並び順の段階一覧もLOVE_LEVELS6を
 * 明示的に渡す（2026-10-06。ダミー文言は"{項目名}:L1"〜"{項目名}:L6"）。
 *
 * このSnapshotが保証する契約：
 *   - Style/Tendencyの6段階の区分 → 正しいID参照
 *   - articleLinksがInfluence順に並ぶ
 *   - 記事URLが無いsource（候補null）は除外される
 *   - ResultDocumentの出力スキーマが変わらない
 *   - styleItems・tendencyItemsの並び順（6段階で真ん中から遠い順＝距離abs(位置−2.5)の
 *     大きい順。L1・L6が2.5、L2・L5が1.5、L3・L4が0.5。同じ距離なら定義順）
 *     → expected.styleItemOrder・tendencyItemOrder（並んだ項目名の配列）
 *
 * 表示ラベルもダミー（label="{項目名}:label"、description="{項目名}:description"）を
 * 渡す。styleItems・tendencyItemsそのものはdocumentに保存せず（文言はstyleTexts等と
 * 重複し、全件保存するとファイルが大きくなるため）、並び順だけを記録する。各項目の
 * label・description・textがダミーと一致することは生成時に検査する（不一致なら例外）。
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

// ダミー文言バンク：文言＝ID（"{項目名}:{区分}"。区分は6段階 L1〜L6）
$styleTextBank = [];
foreach (array_keys(LOVE_STYLE_MAPPING) as $name) {
    foreach (LOVE_LEVELS6 as $lv) $styleTextBank[$name][$lv] = "{$name}:{$lv}";
}
$tendencyTextBank = [];
foreach (array_keys(LOVE_TENDENCY_MAPPING) as $name) {
    foreach (LOVE_LEVELS6 as $lv) $tendencyTextBank[$name][$lv] = "{$name}:{$lv}";
}

// ダミー表示ラベル：label="{項目名}:label"、description="{項目名}:description"
$itemLabels = [];
foreach (array_merge(array_keys(LOVE_STYLE_MAPPING), array_keys(LOVE_TENDENCY_MAPPING)) as $name) {
    $itemLabels[$name] = ['label' => "{$name}:label", 'description' => "{$name}:description"];
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
    $normStyles = love_normalizeStyles6($case['expected']['styles']);
    $normTendencies = love_normalizeTendencies6($case['expected']['tendencies']);

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
        $articleLinkCandidates,
        $itemLabels,
        LOVE_LEVELS6
    );

    // styleItems・tendencyItemsは並び順だけを記録する。各項目の中身はダミーとの一致を検査する
    $itemOrders = [];
    foreach (['styleItems' => [$normStyles, $styleTextBank], 'tendencyItems' => [$normTendencies, $tendencyTextBank]] as $key => [$norm, $bank]) {
        if (count($doc[$key]) !== count($norm)) throw new Exception("{$key}件数不一致");
        foreach ($doc[$key] as $item) {
            $name = $item['name'];
            if ($item['label'] !== "{$name}:label" || $item['description'] !== "{$name}:description"
                || $item['text'] !== $bank[$name][$norm[$name]]) {
                throw new Exception("{$key}の中身がダミーと不一致: {$name}");
            }
        }
        $itemOrders[$key] = array_column($doc[$key], 'name');
        unset($doc[$key]);
    }

    $orderKey = implode('>', array_column($doc['articleLinks'], 'source'));
    $articleOrderCounts[$orderKey] = ($articleOrderCounts[$orderKey] ?? 0) + 1;

    $cases[] = [
        'input' => $input,
        'expected' => [
            'influence' => $influence,
            'document' => $doc,
            'styleItemOrder' => $itemOrders['styleItems'],
            'tendencyItemOrder' => $itemOrders['tendencyItems'],
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
    'note' => 'bundleTextは固定ダミー（Bundle選定ロジック未実装のため）。文章の内容ではなくComposerの組立アルゴリズム（ID参照・Influence順ソート・null除外・出力スキーマ）を固定する。Style/Tendencyの区分は本番と同じ6段階（L1〜L6。love_normalizeStyles6/Tendencies6、levelOrder=LOVE_LEVELS6）で、ダミー文言は"{項目名}:L1"〜"{項目名}:L6"。expected.styleItemOrder・tendencyItemOrderは結果画面の項目の並び順（6段階で真ん中から遠い順＝abs(位置−2.5)の大きい順、同じ距離なら定義順）を項目名の配列で記録する',
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
