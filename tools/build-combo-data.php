<?php
declare(strict_types=1);

/**
 * tools/build-combo-data.php
 *
 * docs/love/combo-master-64.jsonの分類サマリーに加え、各記事の執筆に必要な
 * フル統計（Style7項目・Tendency2項目・Bundle内訳・Primitive平均・
 * 血液型/星座ハイライト）を計算し、docs/love/combo-data-64.jsonへ保存する。
 *
 * 生成ロジックはtools/generate-combo-articles.phpが読み込む。
 */

$data = require __DIR__ . '/../tests/cases/love-final-snapshot.php';
$cases = $data['cases'];

function primaryOf(string $bundleId): string { return explode('_', $bundleId)[1]; }
function secondaryOf(string $bundleId): string { return explode('_', $bundleId)[2]; }

function dominant(array $subset): array {
    $counts = [];
    foreach ($subset as $c) { $p = primaryOf($c['expected']['bundleId']); $counts[$p] = ($counts[$p] ?? 0) + 1; }
    arsort($counts);
    $top = array_key_first($counts);
    return [$top, round($counts[$top] / count($subset) * 100, 1)];
}

$primNames = ['ACT' => '行動主導性', 'REL' => '誠実性', 'SEN' => '情動性', 'AUT' => '自立性', 'TRA' => '変化志向'];
$bundleLabels = [
    'ACT' => '行動主導性', 'REL' => '誠実性', 'SEN' => '情動性', 'AUT' => '自立性', 'TRA' => '変化志向',
];
$primToBundleSlug = ['ACT' => 'action-type', 'REL' => 'reliability-type', 'SEN' => 'sensitivity-type', 'AUT' => 'autonomy-type', 'TRA' => 'transform-type'];

$mbtiTypes = ['ENTP','INTP','ENTJ','INTJ','ENFP','INFP','ENFJ','INFJ','ESTP','ISTP','ESTJ','ISTJ','ESFP','ISFP','ESFJ','ISFJ'];
$bloodTypes = ['A','B','O','AB'];

$mbtiDom = [];
foreach ($mbtiTypes as $m) { $sub = array_filter($cases, fn($c) => $c['input']['mbti'] === $m); $mbtiDom[$m] = dominant($sub); }
$bloodDom = [];
foreach ($bloodTypes as $b) { $sub = array_filter($cases, fn($c) => $c['input']['blood'] === $b); $bloodDom[$b] = dominant($sub); }

// rank + level (同ロジック、combo-master-64.json生成時と同じ)
$prelim = [];
foreach ($mbtiTypes as $m) foreach ($bloodTypes as $b) {
    $sub = array_filter($cases, fn($c) => $c['input']['mbti'] === $m && $c['input']['blood'] === $b);
    [$cP, $cRate] = dominant($sub);
    $prelim[] = ['key' => "$m-$b", 'mbti' => $m, 'blood' => $b, 'rate' => $cRate];
}
usort($prelim, function ($a, $b) {
    if ($a['rate'] !== $b['rate']) return $b['rate'] <=> $a['rate'];
    if ($a['mbti'] !== $b['mbti']) return strcmp($a['mbti'], $b['mbti']);
    return strcmp($a['blood'], $b['blood']);
});
$rankMap = []; $percentileMap = [];
$total = count($prelim);
foreach ($prelim as $i => $row) {
    $rank = $i + 1;
    $rankMap[$row['key']] = $rank;
    $percentileMap[$row['key']] = round((1 - ($rank - 1) / $total) * 100, 1);
}
$allRatesAsc = array_column($prelim, 'rate'); sort($allRatesAsc);
$p20 = $allRatesAsc[(int) round(0.2 * 63)]; $p40 = $allRatesAsc[(int) round(0.4 * 63)];
$p60 = $allRatesAsc[(int) round(0.6 * 63)]; $p80 = $allRatesAsc[(int) round(0.8 * 63)];
function levelOf(float $rate, float $p20, float $p40, float $p60, float $p80): string {
    if ($rate > $p80) return '集中しやすい';
    if ($rate > $p60) return 'やや集中しやすい';
    if ($rate > $p40) return '平均的';
    if ($rate > $p20) return '分散しやすい';
    return '非常に分散しやすい';
}

$styleNames = ['積極性','愛情表現','包容力','独占欲','惚れやすさ','嫉妬深さ','恋愛の慎重さ'];
$tendNames = ['結婚志向','浮気耐性'];
$bundleIdLabel = function (string $id): string {
    [, $p, $s] = explode('_', $id);
    global $primNames;
    return $primNames[$p] . '×' . $primNames[$s];
};

$combos = [];
foreach ($mbtiTypes as $m) {
    foreach ($bloodTypes as $b) {
        $sub = array_values(array_filter($cases, fn($c) => $c['input']['mbti'] === $m && $c['input']['blood'] === $b));
        $n = count($sub);
        [$cP, $cRate] = dominant($sub);
        [$mP, $mRate] = $mbtiDom[$m];
        [$bP, $bRate] = $bloodDom[$b];

        if ($cP === $mP && $cP === $bP) $class = '協調型';
        elseif ($cP === $bP) $class = '拮抗型（血液型優勢）';
        elseif ($cP === $mP) $class = '拮抗型（MBTI優勢）';
        else $class = '転換型';

        $primaryMatch = array_filter($sub, fn($c) => primaryOf($c['expected']['bundleId']) === $cP);
        $secCounts = [];
        foreach ($primaryMatch as $c) { $s = secondaryOf($c['expected']['bundleId']); $secCounts[$s] = ($secCounts[$s] ?? 0) + 1; }
        arsort($secCounts);
        $secTop = array_key_first($secCounts);
        $secRate = round($secCounts[$secTop] / count($primaryMatch) * 100, 1);
        $secCountAbs = $secCounts[$secTop];
        $primaryMatchCount = count($primaryMatch);

        // Style / Tendency distributions
        $styles = [];
        foreach ($styleNames as $sn) {
            $counts = ['High' => 0, 'Mid' => 0, 'Low' => 0];
            foreach ($sub as $c) $counts[$c['expected']['stylesNormalized'][$sn]]++;
            $styles[$sn] = [
                'high' => round($counts['High'] / $n * 100, 1),
                'mid' => round($counts['Mid'] / $n * 100, 1),
                'low' => round($counts['Low'] / $n * 100, 1),
            ];
        }
        $tendencies = [];
        foreach ($tendNames as $tn) {
            $counts = ['High' => 0, 'Mid' => 0, 'Low' => 0];
            foreach ($sub as $c) $counts[$c['expected']['tendenciesNormalized'][$tn]]++;
            $tendencies[$tn] = [
                'high' => round($counts['High'] / $n * 100, 1),
                'mid' => round($counts['Mid'] / $n * 100, 1),
                'low' => round($counts['Low'] / $n * 100, 1),
            ];
        }

        // Bundle breakdown (full, sorted desc)
        $bundleCounts = [];
        foreach ($sub as $c) { $id = $c['expected']['bundleId']; $bundleCounts[$id] = ($bundleCounts[$id] ?? 0) + 1; }
        arsort($bundleCounts);
        $bundleBreakdown = [];
        foreach ($bundleCounts as $id => $cnt) {
            $bundleBreakdown[] = ['id' => $id, 'label' => $bundleIdLabel($id), 'count' => $cnt, 'pct' => round($cnt / $n * 100, 1)];
        }

        // Primitive averages
        $primAvg = [];
        foreach (['行動主導性','誠実性','情動性','自立性','変化志向'] as $pn) {
            $sum = 0;
            foreach ($sub as $c) $sum += $c['expected']['primitives'][$pn];
            $primAvg[$pn] = round($sum / $n, 2);
        }

        $key = "$m-$b";
        $combos[] = [
            'slug' => strtolower($m) . '-' . strtolower($b),
            'mbti' => $m,
            'blood' => $b,
            'sampleSize' => $n,
            'classification' => $class,
            'mbtiPrimary' => $mP, 'mbtiPrimaryRate' => $mRate,
            'bloodPrimary' => $bP, 'bloodPrimaryRate' => $bRate,
            'comboPrimary' => $cP, 'comboPrimaryRate' => $cRate,
            'comboSecondary' => $secTop, 'comboSecondaryRate' => $secRate,
            'comboSecondaryCount' => $secCountAbs, 'primaryMatchCount' => $primaryMatchCount,
            'concentrationRank' => $rankMap[$key],
            'concentrationPercentile' => $percentileMap[$key],
            'concentrationLevel' => levelOf($cRate, $p20, $p40, $p60, $p80),
            'causalRowsType' => $class === '転換型' ? 3 : 2,
            'bundleSlug' => $primToBundleSlug[$cP],
            'secondaryBundleSlug' => $primToBundleSlug[$secTop],
            'styles' => $styles,
            'tendencies' => $tendencies,
            'bundleBreakdown' => $bundleBreakdown,
            'primitiveAverages' => $primAvg,
        ];
    }
}

$out = [
    '_meta' => [
        'generatedAt' => date('c'),
        'source' => 'tests/cases/love-final-snapshot.php (9216 cases)',
        'note' => 'combo-master-64.jsonの分類サマリーに、記事執筆に必要なフル統計（Style/Tendency分布・Bundle内訳・Primitive平均）を追加したもの。tools/generate-combo-articles.phpが読み込む。',
    ],
    'combos' => $combos,
];

file_put_contents(__DIR__ . '/../docs/love/combo-data-64.json', json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Saved " . count($combos) . " combos to docs/love/combo-data-64.json\n";
