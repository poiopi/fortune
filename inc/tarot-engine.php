<?php
declare(strict_types=1);

/**
 * inc/tarot-engine.php
 *
 * tarot.php のカード抽選（クライアントサイドJavaScript）に代わる、サーバーサイドの
 * タロットエンジン。docs/sansei-engine-design.md（Step0）/ IMPLEMENTATION_PLAN.md（Step1-5〜1-8）に基づく。
 *
 * shichu-engine.php とは異なり、生年月日のような「利用者が持つ入力」がない。
 * かわりに「どのカードを引いたか（cardOrder, isUpright）」が入力に相当する。
 *
 * 責務を2つに分離する：
 *   - tarot_drawRandomCard(): 実際にランダムにカードを引く（サーバー側の乱数）
 *   - tarotEngine(cardOrder, isUpright): 与えられたカードからResultDataを組み立てる純粋関数
 *
 * こうすることで、22枚×正逆=44通り全件をGolden Masterで検証できる
 * （shichuの生年月日のような無限に近い入力空間と異なり、全数検証が可能）。
 *
 * Step1-6時点では raw のみを返す。traits・meta・highlights・extras はStep1-7・1-8で追加する
 * （既存キーの変更・削除は行わず、追加のみで育てる）。
 *
 * raw = {deckVersion, cardOrder, isUpright} のみとし、名前・キーワード・メッセージ等は
 * inc/tarot-data.php（唯一のカードデータ資産）からの参照であり、rawには複製しない。
 *
 * 正しさの基準は tests/cases/tarot-golden.php（Golden Master、22枚×正逆=44件全数）。
 */

require_once __DIR__ . '/tarot-data.php';
require_once __DIR__ . '/tarot-trait-mapping.php';

/**
 * サーバー側でカードをランダムに1枚引く。
 *
 * @return array{cardOrder:int, isUpright:bool}
 */
function tarot_drawRandomCard(): array {
    return [
        'cardOrder' => random_int(0, 21),
        'isUpright' => random_int(0, 99) < 65, // shichu.php本体JS版と同じ確率(65%表・35%裏)
    ];
}

/**
 * inc/tarot-trait-mapping.php（Rule ID: T001〜T044）に基づき、traitsを算出する。
 * 全カードが必ず何らかのtraitへ寄与するとは限らない（寄与なしのカードもある）。
 *
 * @return array<string, array{score:int, type:string}>
 */
function tarot_computeTraits(int $cardOrder, bool $isUpright): array {
    $rules = TAROT_TRAIT_MAPPING[$cardOrder][$isUpright ? 'upright' : 'reversed'];
    $traits = [];
    foreach ($rules as $rule) {
        $trait = $rule['trait'];
        if (!isset($traits[$trait])) {
            $traits[$trait] = ['score' => 0, 'type' => 'transient'];
        }
        $traits[$trait]['score'] += $rule['score'];
    }
    return $traits;
}

// ═══════════════════════════════════════════════════
// meta: ResultData自身の見出し。HTMLの<title>とは無関係
// ═══════════════════════════════════════════════════
/** @return array{title:string, subtitle:string} */
function tarot_computeMeta(int $cardOrder, bool $isUpright): array {
    $card = TAROT_DATA[$cardOrder];
    $dir = $isUpright ? '正位置' : '逆位置';
    return [
        'title' => 'タロット',
        'subtitle' => "{$card['name']}（{$dir}）",
    ];
}

// ═══════════════════════════════════════════════════
// highlights: 既存メッセージ文からの抽出（新規に文章を生成しない）
// 引用元は inc/tarot-data.php の upright_msg / reversed_msg のみ
// ═══════════════════════════════════════════════════
/** @return string[] */
function tarot_computeHighlights(int $cardOrder, bool $isUpright): array {
    $card = TAROT_DATA[$cardOrder];
    return [
        $isUpright ? $card['upright_msg'] : $card['reversed_msg'],
    ];
}

// ═══════════════════════════════════════════════════
// extras: 表示用の付加データのみ（raw項目の複製はしない）
// {type, label, value} のオブジェクト配列で統一する（shichu-engine.php と同じ形式）
// ═══════════════════════════════════════════════════
/** @return array<int, array{type:string, label:string, value:mixed}> */
function tarot_computeExtras(int $cardOrder, bool $isUpright): array {
    $card = TAROT_DATA[$cardOrder];
    $keywordStr = $isUpright ? $card['upright'] : $card['reversed'];
    return [
        ['type' => 'card_image', 'label' => 'カード画像', 'value' => $card['img']],
        ['type' => 'keywords', 'label' => 'キーワード', 'value' => explode('・', $keywordStr)],
    ];
}

/**
 * 与えられたカード（cardOrder, isUpright）からResultDataを組み立てる純粋関数。
 *
 * @return array{
 *   meta: array{title:string, subtitle:string},
 *   raw: array{deckVersion:int, cardOrder:int, isUpright:bool},
 *   traits: array,
 *   highlights: string[],
 *   extras: array
 * }
 */
function tarotEngine(int $cardOrder, bool $isUpright): array {
    if (!isset(TAROT_DATA[$cardOrder])) {
        throw new InvalidArgumentException("Invalid cardOrder: {$cardOrder}");
    }

    return [
        'meta' => tarot_computeMeta($cardOrder, $isUpright),
        'raw' => [
            'deckVersion' => TAROT_DECK_VERSION,
            'cardOrder' => $cardOrder,
            'isUpright' => $isUpright,
        ],
        'traits' => tarot_computeTraits($cardOrder, $isUpright),
        'highlights' => tarot_computeHighlights($cardOrder, $isUpright),
        'extras' => tarot_computeExtras($cardOrder, $isUpright),
    ];
}
