<?php
declare(strict_types=1);

// 9216件分のネストしたResultDocumentをphpVal()で再帰的に文字列連結するため、
// デフォルトの128MBでは不足する（実測：文字列生成時にメモリ枯渇）。
ini_set('memory_limit', '1024M');

/**
 * export-love-final-snapshot.php
 *
 * Love Engine全体（Source Engine→Trait集約→Axis→Primitive→Normalizer→
 * Style/Tendency/Bundle→Composer→articleLinks）の最終Golden Master。
 * 9216通り全数（MBTI16×Blood4×Seiza144）で、実際に本番コードを通した
 * 中間状態（Primitive値・各層の区分・Bundle ID・Text ID・Influence・記事リンクの
 * ソース順）を固定する。
 *
 * 目的：Text Bank修正・Normalizer調整・Bundle追加等、今後のリファクタリング時に
 * 「何が変わったか」を機械的に検知できるようにする（実装ではなく回帰検知）。
 *
 * 全文言（bundleText/styleTexts/tendencyTexts）はスナップショットに含めない。
 * 9216件×全文言を保存すると38MB超となり、読み込み側がPHPのデフォルト
 * memory_limit（128MB）を超えて失敗する（実測）。文言そのものの正しさは
 * tests/cases/love-composer-snapshot.php（IDベースのダミー文言でロジックのみ検証）
 * と、単一の情報源であるinc/love-*-texts.phpが担保するため、ここでは
 * ID・分類ラベルのみを記録する（Style/Tendencyの実測値は
 * tests/cases/love-style-tendency-snapshot.phpに既にある）。
 *
 * love_diagnose()（inc/love-orchestrator.php）はseizaEngine(month,day,tz)を
 * 経由するが、本スクリプトはsignIndex×innerTypeIndexの144通りを直接列挙するため、
 * love_diagnose()は使わず、同じ処理を signIndex/innerTypeIndex から直接組み立てる
 * （date→index変換は既存のseiza-golden.phpで別途検証済み）。
 *
 * 実行方法: php tests/tools/export-love-final-snapshot.php
 */

require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/mbti-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/blood-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-data.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-trait-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/seiza-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/axis-engine.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-primitive-mapping.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-style.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-tendency.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-normalizer.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-bundle.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-bundle-texts.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-style-texts.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-tendency-texts.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-composer.php';
require_once __DIR__ . '/../../test.life-fun.net/inc/love-article-links.php';

$mbtiTypes = array_keys(MBTI_DATA);
$bloodTypes = array_keys(BLOOD_DATA);

// MBTI・BloodのResultDataは型ごとに1回だけ構築すればよい
$mbtiResultByType = [];
foreach ($mbtiTypes as $t) $mbtiResultByType[$t] = mbtiEngineFromType($t);
$bloodResultByType = [];
foreach ($bloodTypes as $t) $bloodResultByType[$t] = bloodEngine($t);

// Seizaは(signIndex, innerTypeIndex)の144通りごとに、seizaEngine()相当のResultData
// （raw/traits）を構築する（timeZoneIndexはtraitsに寄与しないため固定値でよい）
$seizaResultByPair = [];
for ($sign = 0; $sign < 12; $sign++) {
    for ($inner = 0; $inner < 12; $inner++) {
        $raw = ['signIndex' => $sign, 'innerTypeIndex' => $inner, 'timeZoneIndex' => 4];
        $seizaResultByPair["$sign,$inner"] = [
            'raw' => $raw,
            'traits' => seiza_computeTraits($sign, $inner),
        ];
    }
}

$cases = [];
$count = 0;
$start = microtime(true);

foreach ($mbtiTypes as $mbtiType) {
    $mbtiResult = $mbtiResultByType[$mbtiType];
    foreach ($bloodTypes as $bloodType) {
        $bloodResult = $bloodResultByType[$bloodType];
        foreach ($seizaResultByPair as $pairKey => $seizaResult) {
            [$sign, $inner] = explode(',', $pairKey);

            $resultDatas = ['mbti' => $mbtiResult, 'blood' => $bloodResult, 'seiza' => $seizaResult];

            $aggregated = axis_aggregateTraits(array_values($resultDatas));
            $axisValues = axis_computeAxes($aggregated);
            $primitives = love_computePrimitives($axisValues);
            $primitivesNormalized = love_normalizePrimitives($primitives);

            $styles = love_computeStyles($primitives);
            $tendencies = love_computeTendencies($primitives);
            $stylesNormalized = love_normalizeStyles($styles);
            $tendenciesNormalized = love_normalizeTendencies($tendencies);

            $bundle = love_selectBundle($primitives);
            $bundleTextId = love_resolveBundleTextId($bundle['id']);
            $bundleText = LOVE_BUNDLE_TEXTS[$bundleTextId];

            $influence = axis_computeInfluence($resultDatas);
            $articleLinkCandidates = love_resolveArticleLinkCandidates($mbtiResult, $bloodResult, $seizaResult);

            // love_composeResult()を実際に通す（例外が出ないこと・スキーマが崩れないこと
            // 自体の検証が目的）。ただし全文言（bundleText/styleTexts/tendencyTexts）は
            // スナップショットへ保存しない。これらはID（bundleTextId・区分ラベル）から
            // 一意に復元できる冗長データであり、9216件分保存すると38MB超・読み込み時に
            // メモリ枯渇するため（実測）。IDと分類だけを固定し、文言そのものの正しさは
            // 別途 tests/cases/love-composer-snapshot.php（IDベース）と
            // inc/love-*-texts.php（単一の情報源）が担保する。
            $document = love_composeResult(
                $bundleText,
                $stylesNormalized,
                $tendenciesNormalized,
                LOVE_STYLE_TEXTS,
                LOVE_TENDENCY_TEXTS,
                $influence,
                $articleLinkCandidates
            );
            if (count($document['styleTexts']) !== count($stylesNormalized)) {
                throw new Exception("styleTexts件数不一致: {$mbtiType}/{$bloodType}/{$sign}/{$inner}");
            }
            if ($document['bundleText'] === '') {
                throw new Exception("bundleText空: {$mbtiType}/{$bloodType}/{$sign}/{$inner}");
            }

            $cases[] = [
                'input' => [
                    'mbti' => $mbtiType,
                    'blood' => $bloodType,
                    'seizaSign' => (int)$sign,
                    'seizaInnerType' => (int)$inner,
                ],
                'expected' => [
                    'primitives' => $primitives,
                    'primitivesNormalized' => $primitivesNormalized,
                    'stylesNormalized' => $stylesNormalized,
                    'tendenciesNormalized' => $tendenciesNormalized,
                    'bundleId' => $bundle['id'],
                    'bundleTextId' => $bundleTextId,
                    'influence' => $influence,
                    'articleLinkSources' => array_column($document['articleLinks'], 'source'),
                ],
            ];
            $count++;
        }
    }
}

$elapsed = microtime(true) - $start;
echo "生成: {$count}件（{$elapsed}秒）\n";
if ($count !== 9216) throw new Exception("9216件のはずが{$count}件");

// 整合性チェック（空文言・スキーマ不一致）はループ内で都度実施済み（例外を投げる）。
$emptyArticleLinks = 0;
foreach ($cases as $c) {
    if (count($c['expected']['articleLinkSources']) === 0) $emptyArticleLinks++;
}
echo "articleLinkSources空: {$emptyArticleLinks}件（MBTI/Seizaは記事があるため通常0件のはず）\n";

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
    'generator' => 'love-orchestrator相当の全パイプライン（実運用コード）を9216通り全件に適用',
    'basedOn' => 'MBTI16 x Blood4 x Seiza(signIndex12 x innerTypeIndex12=144) = 9216通り全数',
    'generatedAt' => (new DateTimeImmutable())->format('c'),
    'caseCount' => $count,
    'cases' => $cases,
];

$out = "<?php\n" .
    "// tests/cases/love-final-snapshot.php\n" .
    "// 最終Golden Master: Love Engine全体（Primitive/Normalizer区分/Bundle/\n" .
    "// Composer出力/articleLinks）を9216通り全件で固定した期待値。\n" .
    "// 生成元: tests/tools/export-love-final-snapshot.php\n" .
    "return " . phpVal($doc, 0) . ";\n";

file_put_contents(__DIR__ . '/../cases/love-final-snapshot.php', $out);
echo "\nWrote {$count} cases to tests/cases/love-final-snapshot.php\n";
