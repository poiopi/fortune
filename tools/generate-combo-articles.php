<?php
declare(strict_types=1);

/**
 * tools/generate-combo-articles.php
 *
 * docs/love/combo-data-64.json（統計）とinc/mbti-trait-mapping.php・
 * inc/blood-trait-mapping.php（因果説明の根拠）から、MBTI×血液型の
 * 組み合わせ記事（articles/love/mbti-blood/{slug}/index.php）を自動生成する。
 *
 * 既に手動実装済みのentp-a・estj-oはスキップする（--force指定時のみ上書き）。
 * causalRowsの行数（2行/3行）はテンプレート仕様（12-combo-classification.md）
 * 通り、分類が「転換型」の場合のみ3行、それ以外は2行にする。
 */

$root = __DIR__ . '/..';
require_once $root . '/test.life-fun.net/inc/trait-vocabulary.php';
require_once $root . '/test.life-fun.net/inc/axis-vocabulary.php';
require_once $root . '/test.life-fun.net/inc/mbti-trait-mapping.php';
require_once $root . '/test.life-fun.net/inc/blood-trait-mapping.php';
require_once $root . '/test.life-fun.net/inc/axis-mapping.php';
require_once $root . '/test.life-fun.net/inc/love-primitive-mapping.php';

$forceOverwrite = in_array('--force', $argv, true);
$alreadyPublished = ['entp-a', 'estj-o'];

$data = json_decode(file_get_contents($root . '/docs/love/combo-data-64.json'), true);
$combos = $data['combos'];

$primCodeToName = ['ACT' => '行動主導性', 'REL' => '誠実性', 'SEN' => '情動性', 'AUT' => '自立性', 'TRA' => '変化志向'];
$primToBundleSlug = ['ACT' => 'action-type', 'REL' => 'reliability-type', 'SEN' => 'sensitivity-type', 'AUT' => 'autonomy-type', 'TRA' => 'transform-type'];
$primToStyleSlug = [
    'ACT' => ['name' => '積極性', 'slug' => '/articles/love/style/sekkyokusei-love/', 'formula' => '行動主導性×0.6＋情動性×0.4'],
    'REL' => ['name' => '恋愛の慎重さ', 'slug' => '/articles/love/style/shinchousa-love/', 'formula' => '誠実性×0.6＋自立性×0.4'],
    'SEN' => ['name' => '愛情表現', 'slug' => '/articles/love/style/aijouhyougen-love/', 'formula' => '行動主導性×0.3＋情動性×0.7'],
    'AUT' => ['name' => '独占欲', 'slug' => '/articles/love/style/dokusenyoku-love/', 'formula' => '情動性×0.7－自立性×0.3'],
    'TRA' => ['name' => '惚れやすさ', 'slug' => '/articles/love/style/horeyasusa-love/', 'formula' => '情動性×0.6＋変化志向×0.4'],
];

function primitiveOfTrait(string $trait): string {
    $axis = AXIS_MAPPING[$trait][0]['axis'];
    foreach (PRIMITIVE_AXIS_MAP as $primName => $axisName) {
        if ($axisName === $axis) return $primName;
    }
    throw new RuntimeException("no primitive for trait $trait");
}

/** @return array<int, array{letter:string, keyword:string, trait:string, score:int}> */
function mbtiContributors(string $mbtiType, string $primNameJa): array {
    $letters = str_split($mbtiType);
    $out = [];
    foreach ($letters as $letter) {
        foreach (MBTI_TRAIT_MAPPING[$letter] as $rule) {
            if (primitiveOfTrait($rule['trait']) === $primNameJa) {
                $out[] = ['letter' => $letter, 'keyword' => $rule['keyword'], 'trait' => $rule['trait'], 'score' => $rule['score']];
            }
        }
    }
    return $out;
}

/** @return array<int, array{keyword:string, trait:string, score:int}> */
function bloodContributors(string $bloodType, string $primNameJa): array {
    $out = [];
    foreach (BLOOD_TRAIT_MAPPING[$bloodType] as $rule) {
        if (primitiveOfTrait($rule['trait']) === $primNameJa) {
            $out[] = ['keyword' => $rule['keyword'], 'trait' => $rule['trait'], 'score' => $rule['score']];
        }
    }
    return $out;
}

function describeMbtiContributors(array $contributors): string {
    $parts = array_map(fn($c) => "{$c['letter']}（{$c['trait']}）", $contributors);
    return implode('・', $parts);
}

function describeBloodContributors(string $bloodType, array $contributors): string {
    $parts = array_map(fn($c) => "「{$c['keyword']}」（{$c['trait']}）", $contributors);
    return implode('・', $parts);
}

function totalScore(array $contributors): int {
    return array_sum(array_column($contributors, 'score'));
}

function buildArticle(array $c, ?array $prevCombo, ?array $nextCombo): array {
    global $primCodeToName, $primToBundleSlug, $primToStyleSlug;

    $mbti = $c['mbti']; $blood = $c['blood'];
    $mbtiPrimJa = $primCodeToName[$c['mbtiPrimary']];
    $bloodPrimJa = $primCodeToName[$c['bloodPrimary']];
    $comboPrimJa = $primCodeToName[$c['comboPrimary']];
    $comboSecJa = $primCodeToName[$c['comboSecondary']];
    $class = $c['classification'];

    $mbtiOwnContrib = mbtiContributors($mbti, $mbtiPrimJa);
    $bloodOwnContrib = bloodContributors($blood, $bloodPrimJa);
    $mbtiOwnDesc = describeMbtiContributors($mbtiOwnContrib);
    $bloodOwnDesc = describeBloodContributors($blood, $bloodOwnContrib);

    $name = "{$mbti}×{$blood}型";
    $bloodLabel = "{$blood}型";

    // ---- classification-specific blocks ----
    if ($class === '協調型') {
        $classDesc = "{$mbti}単体の主軸も{$bloodLabel}単体の主軸も{$comboPrimJa}です。2つの入力が同じ方向を向いているため「協調型」に分類されます。";
        $conclusion = "この組み合わせは「協調型」です。{$mbti}と{$bloodLabel}はどちらも単体で{$comboPrimJa}が主軸になりやすく（MBTI単体{$c['mbtiPrimaryRate']}%、{$bloodLabel}単体{$c['bloodPrimaryRate']}%）、2つの入力が同じ方向を後押しするため、組み合わせるとさらに強く{$comboPrimJa}へ集中します（{$c['comboPrimaryRate']}%）。";
        $causalIntro = "{$mbti}と{$bloodLabel}は、単体で見てもどちらも{$comboPrimJa}が主軸になりやすいタイプです。組み合わせでどれだけ強まるかを実測データで確認します。";
        $causalRows = [
            ['source' => "{$mbti}（MBTI）単体", 'solo' => "{$mbtiPrimJa} {$c['mbtiPrimaryRate']}%（576パターン中）", 'result' => "組み合わせでも同じ方向（一致）", 'adopted' => true],
            ['source' => "{$bloodLabel}（血液型）単体", 'solo' => "{$bloodPrimJa} {$c['bloodPrimaryRate']}%（2304パターン中）", 'result' => "組み合わせでも同じ方向（一致）", 'adopted' => true],
        ];
        $causalExplanation = "{$mbti}では{$mbtiOwnDesc}が{$comboPrimJa}へ、{$bloodLabel}では{$bloodOwnDesc}が同じく{$comboPrimJa}へ寄与します。2つの入力が同じ方向を後押しするため、単体（MBTI{$c['mbtiPrimaryRate']}%・{$bloodLabel}{$c['bloodPrimaryRate']}%）よりも高い集中度（{$c['comboPrimaryRate']}%）になります。";
        $faqQ2 = ["q" => "なぜMBTIと血液型の両方が同じ方向になるのですか？", "a" => "{$mbti}と{$bloodLabel}が、たまたま同じPrimitive（{$comboPrimJa}）に強く寄与する構造を持っているためです。全てのMBTI×血液型の組み合わせがこうなるわけではなく、64通り中24通りがこの「協調型」に該当します。"];
    } elseif ($class === '拮抗型（MBTI優勢）') {
        $classDesc = "{$mbti}単体の主軸は{$mbtiPrimJa}、{$bloodLabel}単体の主軸は{$bloodPrimJa}と、2つの入力は異なる方向を向いています。組み合わせた実測データでは、MBTI由来の{$mbtiPrimJa}側が主軸として採用されるため「拮抗型（MBTI優勢）」に分類されます。";
        $conclusion = "この組み合わせは「拮抗型（MBTI優勢）」です。{$name}では、{$mbti}由来の{$mbtiPrimJa}が組み合わせの主軸として採用されます（144パターン中{$c['comboPrimaryRate']}%）。ただし{$bloodLabel}由来の{$bloodPrimJa}は主軸を譲っても消えるわけではなく、{$mbtiPrimJa}が主軸になったケースの{$c['comboSecondaryRate']}%で副軸として残ります。";
        $causalIntro = "{$mbti}と{$bloodLabel}は、それぞれ単体で見ると異なるPrimitiveを主軸に持ちます。組み合わせたとき、どちらが採用されるかを実測データで確認します。";
        $causalRows = [
            ['source' => "{$mbti}（MBTI）単体", 'solo' => "{$mbtiPrimJa} {$c['mbtiPrimaryRate']}%（576パターン中）", 'result' => "主軸として採用（{$c['comboPrimaryRate']}%）", 'adopted' => true],
            ['source' => "{$bloodLabel}（血液型）単体", 'solo' => "{$bloodPrimJa} {$c['bloodPrimaryRate']}%（2304パターン中）", 'result' => "主軸としては不採用。副軸として高確率で残る", 'adopted' => false],
        ];
        $causalExplanation = "{$mbti}では{$mbtiOwnDesc}が{$mbtiPrimJa}へ寄与し、単体でも{$c['mbtiPrimaryRate']}%と主軸になりやすい構造を持ちます。{$bloodLabel}は{$bloodOwnDesc}が{$bloodPrimJa}へ寄与しますが、{$mbti}側の寄与の方が強く働くため、組み合わせでは{$mbtiPrimJa}が主軸として採用されます（{$c['comboPrimaryRate']}%）。{$bloodPrimJa}は、{$mbtiPrimJa}が主軸になったケース（{$c['primaryMatchCount']}件）のうち{$c['comboSecondaryRate']}%（{$c['comboSecondaryCount']}件）で副軸として残ります。";
        $faqQ2 = ["q" => "{$bloodLabel}の性格はこの組み合わせで消えてしまうのですか？", "a" => "消えません。主軸としては採用されにくいものの、{$mbtiPrimJa}が主軸になったケースの{$c['comboSecondaryRate']}%で{$bloodPrimJa}が副軸として残ります。"];
    } elseif ($class === '拮抗型（血液型優勢）') {
        $classDesc = "{$mbti}単体の主軸は{$mbtiPrimJa}、{$bloodLabel}単体の主軸は{$bloodPrimJa}と、2つの入力は異なる方向を向いています。組み合わせた実測データでは、血液型由来の{$bloodPrimJa}側が主軸として採用されるため「拮抗型（血液型優勢）」に分類されます。";
        $conclusion = "この組み合わせは「拮抗型（血液型優勢）」です。{$name}では、{$bloodLabel}由来の{$bloodPrimJa}が組み合わせの主軸として採用されます（144パターン中{$c['comboPrimaryRate']}%）。ただし{$mbti}由来の{$mbtiPrimJa}は主軸を譲っても消えるわけではなく、{$bloodPrimJa}が主軸になったケースの{$c['comboSecondaryRate']}%で副軸として残ります。";
        $causalIntro = "{$mbti}と{$bloodLabel}は、それぞれ単体で見ると異なるPrimitiveを主軸に持ちます。組み合わせたとき、どちらが採用されるかを実測データで確認します。";
        $causalRows = [
            ['source' => "{$mbti}（MBTI）単体", 'solo' => "{$mbtiPrimJa} {$c['mbtiPrimaryRate']}%（576パターン中）", 'result' => "主軸としては不採用。副軸として高確率で残る", 'adopted' => false],
            ['source' => "{$bloodLabel}（血液型）単体", 'solo' => "{$bloodPrimJa} {$c['bloodPrimaryRate']}%（2304パターン中）", 'result' => "主軸として採用（{$c['comboPrimaryRate']}%）", 'adopted' => true],
        ];
        $causalExplanation = "{$bloodLabel}では{$bloodOwnDesc}が{$bloodPrimJa}へ寄与し、単体でも{$c['bloodPrimaryRate']}%と主軸になりやすい構造を持ちます。{$mbti}は{$mbtiOwnDesc}が{$mbtiPrimJa}へ寄与しますが、{$bloodLabel}側の寄与の方が強く働くため、組み合わせでは{$bloodPrimJa}が主軸として採用されます（{$c['comboPrimaryRate']}%）。{$mbtiPrimJa}は、{$bloodPrimJa}が主軸になったケース（{$c['primaryMatchCount']}件）のうち{$c['comboSecondaryRate']}%（{$c['comboSecondaryCount']}件）で副軸として残ります。";
        $faqQ2 = ["q" => "{$mbti}の性格はこの組み合わせで消えてしまうのですか？", "a" => "消えません。主軸としては採用されにくいものの、{$bloodPrimJa}が主軸になったケースの{$c['comboSecondaryRate']}%で{$mbtiPrimJa}が副軸として残ります。"];
    } else { // 転換型
        $samePrimary = ($c['mbtiPrimary'] === $c['bloodPrimary']);
        $classDesc = "{$mbti}単体の主軸は{$mbtiPrimJa}、{$bloodLabel}単体の主軸は{$bloodPrimJa}です。組み合わせた実測データでは、そのどちらでもない{$comboPrimJa}が主軸として採用されるため「転換型」に分類されます。64通り中、この現象が起きるのは4通りだけです。";
        $conclusion = "この組み合わせは「転換型」です。{$name}では、MBTI単体の主軸（{$mbtiPrimJa}）でも血液型単体の主軸（{$bloodPrimJa}）でもなく、第3の性質である{$comboPrimJa}が組み合わせの主軸として採用されます（144パターン中{$c['comboPrimaryRate']}%）。";
        $causalIntro = $samePrimary
            ? "{$mbti}と{$bloodLabel}は、単体で見るとどちらも{$mbtiPrimJa}が主軸です。ところが組み合わせた結果はそのどちらでもありません。3つの数値を並べて確認します。"
            : "{$mbti}と{$bloodLabel}は、それぞれ単体で見ると異なるPrimitiveを主軸に持ちますが、組み合わせた結果はそのどちらでもありません。3つの数値を並べて確認します。";
        $causalRows = [
            ['source' => "{$mbti}（MBTI）単体", 'solo' => "{$mbtiPrimJa} {$c['mbtiPrimaryRate']}%（576パターン中）", 'result' => "主軸としては不採用", 'adopted' => false],
            ['source' => "{$bloodLabel}（血液型）単体", 'solo' => "{$bloodPrimJa} {$c['bloodPrimaryRate']}%（2304パターン中）", 'result' => "主軸としては不採用", 'adopted' => false],
            ['source' => "{$name}（組み合わせ）", 'solo' => '―', 'result' => "{$comboPrimJa} {$c['comboPrimaryRate']}%（採用）", 'adopted' => true],
        ];
        $comboOwnContribM = mbtiContributors($mbti, $comboPrimJa);
        $comboOwnContribB = bloodContributors($blood, $comboPrimJa);
        $mDesc = $comboOwnContribM ? describeMbtiContributors($comboOwnContribM) : 'なし';
        $bDesc = $comboOwnContribB ? describeBloodContributors($blood, $comboOwnContribB) : 'なし';
        $soloSummary = $samePrimary
            ? "{$mbti}単体・{$bloodLabel}単体はどちらも{$mbtiPrimJa}が優勢です（それぞれ{$c['mbtiPrimaryRate']}%・{$c['bloodPrimaryRate']}%）が、{$comboPrimJa}への寄与も同時に持っています。"
            : "{$mbti}単体では{$mbtiPrimJa}（{$c['mbtiPrimaryRate']}%）が、{$bloodLabel}単体では{$bloodPrimJa}（{$c['bloodPrimaryRate']}%）が優勢ですが、{$comboPrimJa}への寄与も同時に持っています。";
        $causalExplanation = "{$soloSummary}{$comboPrimJa}への寄与は{$mbti}側が{$mDesc}、{$bloodLabel}側が{$bDesc}です。単体では前面に出なかったこの寄与が組み合わさることで、{$comboPrimJa}が組み合わせの主軸として浮上します（{$c['comboPrimaryRate']}%）。";
        $faqQ2 = ["q" => "転換型は珍しいのですか？", "a" => "はい。MBTI16×血液型4＝64通り中、転換型に分類されるのは4通りだけです。ただし集中度そのもの（{$c['comboPrimaryRate']}%）は「{$c['concentrationLevel']}」であり、極端に珍しい数値というわけではありません。"];
    }

    // ---- shared blocks ----
    $lead = "{$mbti}は{$mbtiPrimJa}が、{$bloodLabel}は{$bloodPrimJa}が、それぞれ単体では恋愛傾向の主軸になりやすいタイプです。この2つを組み合わせたとき、どちらの影響がより強く出るのかを、Love Engineの実測データから解説します。";
    $title = "{$name}の恋愛傾向｜Love Engineで解説する{$comboPrimJa}主軸の理由";

    $bundleIntro = "{$name}の144パターンを、実際に採用されるBundle（主軸×副軸の組み合わせ）別に見ると、次のようになります。";
    $bundleBreakdown = array_map(fn($b) => ['label' => $b['label'], 'count' => $b['count'], 'pct' => $b['pct']], $c['bundleBreakdown']);

    $rarityNote = "{$name}の集中度（{$c['comboPrimaryRate']}%）を64通りの実測分布に照らすと「{$c['concentrationLevel']}」に位置します。集中度の高低と、分類（協調型/拮抗型/転換型）の珍しさは別の軸であり、この組み合わせは64通り中{$c['concentrationRank']}位（上位{$c['concentrationPercentile']}%相当）です。";

    $conceptLinks = [
        ['name' => $primCodeToName[$c['comboPrimary']] . '型', 'desc' => "{$name}の{$c['comboPrimaryRate']}%が該当するBundle。", 'url' => "/articles/love/bundle/{$primToBundleSlug[$c['comboPrimary']]}/"],
        ['name' => $primCodeToName[$c['comboSecondary']] . '型', 'desc' => "{$name}の副軸として{$c['comboSecondaryRate']}%残るBundle。", 'url' => "/articles/love/bundle/{$primToBundleSlug[$c['comboSecondary']]}/"],
        ['name' => $primToStyleSlug[$c['comboPrimary']]['name'], 'desc' => $primToStyleSlug[$c['comboPrimary']]['formula'] . '。主軸Primitiveが反映される指標。', 'url' => $primToStyleSlug[$c['comboPrimary']]['slug']],
        ['name' => $primToStyleSlug[$c['comboSecondary']]['name'], 'desc' => $primToStyleSlug[$c['comboSecondary']]['formula'] . '。副軸Primitiveが反映される指標。', 'url' => $primToStyleSlug[$c['comboSecondary']]['slug']],
    ];

    $faq = [
        ['q' => "{$name}は珍しい組み合わせですか？", 'a' => "組み合わせ自体（144パターン）は64通り中どれも同じ件数です。主軸の集中度（{$c['comboPrimaryRate']}%）は64通り中{$c['concentrationRank']}位で「{$c['concentrationLevel']}」に位置します。"],
        $faqQ2,
        ['q' => "なぜ{$comboPrimJa}が主軸になりやすいのですか？", 'a' => "Love Engineでは、MBTI・血液型それぞれの入力がPrimitiveへスコアを加算し、最終的にスコアが最も高いPrimitiveが主軸として採用されます。この組み合わせでは{$comboPrimJa}への寄与が最も大きくなるため、主軸として採用されます。詳しくは「Bundleとは」で解説しています。"],
    ];

    $matome = [
        "{$name}は、MBTI単体の主軸（{$mbtiPrimJa}）・血液型単体の主軸（{$bloodPrimJa}）の関係から「{$class}」に分類される組み合わせ。",
        "組み合わせた144パターンでは、{$comboPrimJa}が主軸として採用される割合が{$c['comboPrimaryRate']}%。",
        "{$comboSecJa}は、{$comboPrimJa}が主軸のケースの{$c['comboSecondaryRate']}%で副軸として残る。",
        "主軸集中度{$c['comboPrimaryRate']}%は64通り中{$c['concentrationRank']}位で「{$c['concentrationLevel']}」に位置する。",
        "この組み合わせの傾向は、MBTI・血液型それぞれのTrait寄与という構造的な理由に基づいている。",
    ];

    $relatedItems = [
        ['label' => '恋愛傾向診断', 'title' => 'MBTI×血液型×星座で診断する →', 'url' => '/love'],
        ['label' => "{$mbti}×恋愛", 'title' => "{$mbti}の恋愛傾向を詳しく見る →", 'url' => "/articles/love/mbti/" . strtolower($mbti) . "/"],
        ['label' => "{$bloodLabel}×恋愛", 'title' => "{$bloodLabel}の恋愛傾向を詳しく見る →", 'url' => "/articles/love/blood/" . strtolower($blood) . "-love/"],
        ['label' => 'MBTI×血液型 一覧', 'title' => '他の組み合わせを見る →', 'url' => '/articles/love/mbti-blood/'],
    ];

    return [
        'slug' => $c['slug'],
        'name' => $name,
        'title' => $title,
        'h1' => $title,
        'description' => "{$name}の組み合わせでは、MBTI単体の主軸（{$mbtiPrimJa}）と血液型単体の主軸（{$bloodPrimJa}）のうち、どちらの影響が恋愛傾向により強く出るのかをLove Engineの実測データ（144パターン）で解説。",
        'lead' => $lead,
        'classification' => $class,
        'classification_desc' => $classDesc,
        'conclusion' => $conclusion,
        'causal_intro' => $causalIntro,
        'causalRows' => $causalRows,
        'causal_explanation' => $causalExplanation,
        'data_intro' => "ここからは、{$name}に該当する144パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。",
        'styles' => $c['styles'],
        'tendencies' => $c['tendencies'],
        'bundle_intro' => $bundleIntro,
        'bundleBreakdown' => $bundleBreakdown,
        'rarityLevel' => $c['concentrationLevel'],
        'rarityRank' => "{$c['concentrationRank']}位（主軸集中度{$c['comboPrimaryRate']}%、上位{$c['concentrationPercentile']}%相当）",
        'rarity_note' => $rarityNote,
        'conceptLinks' => $conceptLinks,
        'faq' => $faq,
        'matome' => $matome,
        'relatedItems' => $relatedItems,
        'prev' => $prevCombo ? ['title' => "{$prevCombo['mbti']}×{$prevCombo['blood']}型", 'url' => "/articles/love/mbti-blood/{$prevCombo['slug']}/"] : null,
        'next' => $nextCombo ? ['title' => "{$nextCombo['mbti']}×{$nextCombo['blood']}型", 'url' => "/articles/love/mbti-blood/{$nextCombo['slug']}/"] : null,
    ];
}

function phpExport($value, int $indent = 1): string {
    $pad = str_repeat('  ', $indent);
    if (is_array($value)) {
        $isList = array_keys($value) === range(0, count($value) - 1);
        $lines = [];
        foreach ($value as $k => $v) {
            $keyPart = $isList ? '' : var_export((string)$k, true) . ' => ';
            $lines[] = $pad . $keyPart . phpExport($v, $indent + 1) . ',';
        }
        return "[\n" . implode("\n", $lines) . "\n" . str_repeat('  ', $indent - 1) . "]";
    }
    if (is_bool($value)) return $value ? 'true' : 'false';
    if (is_int($value) || is_float($value)) return (string)$value;
    if ($value === null) return 'null';
    return var_export($value, true);
}

$generated = [];
$skipped = [];
$n = count($combos);
foreach ($combos as $i => $c) {
    if (!$forceOverwrite && in_array($c['slug'], $alreadyPublished, true)) {
        $skipped[] = $c['slug'];
        continue;
    }
    $prevCombo = $i > 0 ? $combos[$i - 1] : null;
    $nextCombo = $i < $n - 1 ? $combos[$i + 1] : null;
    $item = buildArticle($c, $prevCombo, $nextCombo);
    $dir = $root . '/test.life-fun.net/articles/love/mbti-blood/' . $item['slug'];
    if (!is_dir($dir)) mkdir($dir, 0777, true);

    $php = "<?php\n\$item = " . phpExport($item, 1) . ";\nrequire __DIR__ . '/../_combo-tpl.php';\n";
    file_put_contents($dir . '/index.php', $php);
    $generated[] = $item['slug'];
}

echo "Generated: " . count($generated) . "\n";
echo "Skipped (already published): " . implode(', ', $skipped) . "\n";
