<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 誕生石セクション用プロバイダ（Phase2新規ロジック）
//
// 誕生石は日単位ではなく月単位のデータ（全国宝石卸商協同組合 2021年12月改訂版、
// 12ヶ月・29石）。対象日の月（1〜12）で引くだけの単純なテーブル参照。
// ══════════════════════════════════════════════════════════════════

const DAYINFO_MONTHLY_STONES = [
    1 => ['name' => 'ガーネット', 'meaning' => '真実の愛', 'alternates' => []],
    2 => ['name' => 'アメジスト', 'meaning' => '誠実、心の平和', 'alternates' => ['クリソベリル・キャッツアイ']],
    3 => ['name' => 'アクアマリン', 'meaning' => '沈着、勇敢', 'alternates' => ['サンゴ', 'ブラッドストーン', 'アイオライト']],
    4 => ['name' => 'ダイヤモンド', 'meaning' => '永遠の絆、純潔', 'alternates' => ['モルガナイト']],
    5 => ['name' => 'エメラルド', 'meaning' => '幸福、夫婦愛', 'alternates' => ['ヒスイ']],
    6 => ['name' => '真珠', 'meaning' => '健康、富', 'alternates' => ['ムーンストーン', 'アレキサンドライト']],
    7 => ['name' => 'ルビー', 'meaning' => '情熱、愛情', 'alternates' => ['スフェーン']],
    8 => ['name' => 'ペリドット', 'meaning' => '夫婦の幸福', 'alternates' => ['サードニクス', 'スピネル']],
    9 => ['name' => 'サファイア', 'meaning' => '誠実、慈愛', 'alternates' => ['クンツァイト']],
    10 => ['name' => 'オパール', 'meaning' => '希望、純粋', 'alternates' => ['トルマリン']],
    11 => ['name' => 'トパーズ', 'meaning' => '友情、希望', 'alternates' => ['シトリン']],
    12 => ['name' => 'トルコ石', 'meaning' => '成功、繁栄', 'alternates' => ['ラピスラズリ', 'ジルコン', 'タンザナイト']],
];

function getStoneInfo(DateTimeImmutable $date): array {
    $month = (int)$date->format('n');
    $stone = DAYINFO_MONTHLY_STONES[$month];

    return [
        'available'  => true,
        'name'       => $stone['name'],
        'meaning'    => $stone['meaning'],
        'alternates' => $stone['alternates'],
        'url'        => null,
    ];
}
