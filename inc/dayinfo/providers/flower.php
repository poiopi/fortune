<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// DayInfoService: 誕生花セクション用プロバイダ（Phase2新規ロジック、Phase3でfeature追加）
//
// inc/dayinfo/birth-flowers-data.php の366日分データ（DAYINFO_BIRTH_FLOWERS）
// をそのまま参照する。データ内容自体はこのファイルでは一切変更しない。
//
// inc/dayinfo/flower-descriptions-data.php の花の種類ごとの特徴・見頃・印象
// データ（DAYINFO_FLOWER_DESCRIPTIONS、花の名前がキー）も合わせて参照する。
//
// 2/29（うるう日）も含め366日分すべてにデータがあるため、通常の日と同様に
// 誕生花が表示される（isset()によるデータ駆動判定のため、該当キーが存在すれば
// available=true を返す）。
// ══════════════════════════════════════════════════════════════════

require_once __DIR__.'/../birth-flowers-data.php';
require_once __DIR__.'/../flower-descriptions-data.php';

// 月数値(1〜12)→記事URLの月スラッグの変換表
const FLOWER_ARTICLE_MONTH_SLUGS = [
    1=>'jan', 2=>'feb', 3=>'mar', 4=>'apr', 5=>'may', 6=>'jun',
    7=>'jul', 8=>'aug', 9=>'sep', 10=>'oct', 11=>'nov', 12=>'dec',
];

function getFlowerInfo(DateTimeImmutable $date): array {
    $key = $date->format('m-d');

    if (!isset(DAYINFO_BIRTH_FLOWERS[$key])) {
        return ['available' => false];
    }

    $flower = DAYINFO_BIRTH_FLOWERS[$key];

    // 解説記事の有無はfile_existsで実ファイルの存在を都度確認する（静的な月リストではない）。
    // これにより、記事を追加した月から自動的にリンクが有効になり、
    // このファイルを毎月編集する二重管理を避けられる。
    $monthSlug = FLOWER_ARTICLE_MONTH_SLUGS[(int)$date->format('n')] ?? null;
    $mmdd      = $date->format('md');
    $url       = null;
    if ($monthSlug !== null) {
        $articleFile = __DIR__."/../../../articles/calendar/birthflower/{$monthSlug}/{$mmdd}/index.php";
        if (file_exists($articleFile)) {
            $url = "/articles/calendar/birthflower/{$monthSlug}/{$mmdd}/";
        }
    }

    return [
        'available' => true,
        'name'      => $flower['name'],
        'meaning'   => $flower['meaning'],
        'feature'   => DAYINFO_FLOWER_DESCRIPTIONS[$flower['name']] ?? '', // 万一データにない場合は空文字
        'url'       => $url,
    ];
}
