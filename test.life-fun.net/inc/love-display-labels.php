<?php
declare(strict_types=1);

/**
 * inc/love-display-labels.php
 *
 * 恋愛傾向診断の結果画面で、Style/Tendencyの各項目に添える表示名と一行説明。
 * 表示用の文言なので、Composer（inc/love-composer.php）自身は持たず、
 * 引数として受け取る（docs/love/06-composer.md）。
 *
 * - 正式な項目名（積極性など）・段階名・点数は結果画面に出さない（ユーザー決定 2026-10-06）。
 * - 表示名は、どの段階の文章にも合う「話題の名前」にする（docs/love/09-writing-rules.md）。
 * - キーは inc/love-style.php（LOVE_STYLE_MAPPING）・inc/love-tendency.php
 *   （LOVE_TENDENCY_MAPPING）の項目名と同じにする。
 */

const LOVE_ITEM_LABELS = [
    '積極性' => [
        'label' => '恋の進め方',
        'description' => '気になる相手との距離の縮め方',
    ],
    '愛情表現' => [
        'label' => '愛情の伝え方',
        'description' => '「好き」という気持ちの届け方',
    ],
    '包容力' => [
        'label' => '相手の受け止め方',
        'description' => '相手の気持ちとの向き合い方',
    ],
    '独占欲' => [
        'label' => '二人の距離感',
        'description' => '相手とどのくらい近くにいたいか',
    ],
    '惚れやすさ' => [
        'label' => '恋の始まり方',
        'description' => '心が動いてから恋になるまでのペース',
    ],
    '嫉妬深さ' => [
        'label' => '心の揺れとの付き合い方',
        'description' => '相手の言動に気持ちがどう動くか',
    ],
    '恋愛の慎重さ' => [
        'label' => '相手の見極め方',
        'description' => '勢いと見極めのバランス',
    ],
    '結婚志向' => [
        'label' => '将来の描き方',
        'description' => '恋愛の先に思い描く関係のかたち',
    ],
    '浮気耐性' => [
        'label' => 'ときめきとの付き合い方',
        'description' => '決めた相手との関係と、新しい刺激とのバランス',
    ],
];
