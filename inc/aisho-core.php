<?php
declare(strict_types=1);

/**
 * inc/aisho-core.php
 *
 * AI鑑定チャット（相性・結婚相性テーマ）専用。aisho.php本体の相性計算ロジック
 * （marriageScore/loverScoreの算出・ラベル・理由文）をそのまま複製したもの。
 * 自己完結ファイルであり、他ファイルへのrequireは持たない。
 *
 * marriageScore/loverScoreの計算式は一字一句変更していない（aisho.php 4-40行目、
 * 291-302行目、607-608行目、638-669行目を複製）。confess/dateSpot/presentは
 * 今回の機能に不要なため複製していない。
 */

// 複製元:aisho.php 4-17行目
const AISHO_ZODIAC = [
  ['name'=>'山羊座','sym'=>'♑','el'=>'地','en'=>'Capricorn'],
  ['name'=>'水瓶座','sym'=>'♒','el'=>'風','en'=>'Aquarius'],
  ['name'=>'魚座',  'sym'=>'♓','el'=>'水','en'=>'Pisces'],
  ['name'=>'牡羊座','sym'=>'♈','el'=>'火','en'=>'Aries'],
  ['name'=>'牡牛座','sym'=>'♉','el'=>'地','en'=>'Taurus'],
  ['name'=>'双子座','sym'=>'♊','el'=>'風','en'=>'Gemini'],
  ['name'=>'蟹座',  'sym'=>'♋','el'=>'水','en'=>'Cancer'],
  ['name'=>'獅子座','sym'=>'♌','el'=>'火','en'=>'Leo'],
  ['name'=>'乙女座','sym'=>'♍','el'=>'地','en'=>'Virgo'],
  ['name'=>'天秤座','sym'=>'♎','el'=>'風','en'=>'Libra'],
  ['name'=>'蠍座',  'sym'=>'♏','el'=>'水','en'=>'Scorpio'],
  ['name'=>'射手座','sym'=>'♐','el'=>'火','en'=>'Sagittarius'],
];
// 複製元:aisho.php 19-22行目
function aisho_getZodiacIdx(int $m, int $d): int {
  $cuts=[19,18,20,19,20,21,22,22,22,23,21,21];
  return ($d<=$cuts[$m-1])?($m-1):$m%12;
}
// 複製元:aisho.php 24-28行目
function aisho_calcLP(int $y,int $m,int $d): int {
  $n=array_sum(str_split(sprintf('%04d%02d%02d',$y,$m,$d)));
  while($n>9&&!in_array($n,[11,22,33])) $n=array_sum(str_split((string)$n));
  return $n;
}
// 複製元:aisho.php 30-34行目
function aisho_zodiacScore(string $e1,string $e2): int {
  if($e1===$e2) return 5;
  $best=['火'=>'風','風'=>'火','水'=>'地','地'=>'水'];
  return ($best[$e1]??'')===$e2?4:2;
}
// 複製元:aisho.php 36-40行目
function aisho_lpBonus(int $a,int $b): int {
  foreach([[1,5,7],[2,4,8],[3,6,9]] as $g)
    if(in_array($a,$g)&&in_array($b,$g)) return 1;
  return (in_array($a,[11,22,33])||in_array($b,[11,22,33]))?1:0;
}

/**
 * @return array{yZ:array,pZ:array,marriageScore:int,marriageLabel:string,marriageReasonText:string,loverScore:int,loverLabel:string,loverReasonText:string}
 */
function aisho_calcCompatibility(int $ym, int $yd, int $pm, int $pd): array {
    $yZi = aisho_getZodiacIdx($ym, $yd);
    $pZi = aisho_getZodiacIdx($pm, $pd);
    $yZ = AISHO_ZODIAC[$yZi];
    $pZ = AISHO_ZODIAC[$pZi];
    // aisho.php 294-295行目相当:1990年固定でライフパスを計算（表示はしない・既存仕様のまま変更しない）
    $yLP = aisho_calcLP(1990, $ym, $yd);
    $pLP = aisho_calcLP(1990, $pm, $pd);
    $seed = abs(crc32(sprintf('%02d%02d%02d%02d', $ym, $yd, $pm, $pd)));
    $base = aisho_zodiacScore($yZ['el'], $pZ['el']);
    $bonus = aisho_lpBonus($yLP, $pLP);
    // aisho.php 301-302行目。この2行の式は一字一句変更禁止
    $marriageScore = min(5, max(1, $base + $bonus + ($seed % 2) - 1));
    $loverScore    = min(5, max(1, $base + (($seed >> 3) % 2) + $bonus - 1 + ($yZ['el'] !== $pZ['el'] ? 1 : 0)));
    // aisho.php 607-608行目のラベル配列を複製
    $marriageLabels = [1=>'縁遠い',2=>'普通',3=>'相性まずまず',4=>'相性良好',5=>'運命的な相手'];
    $loverLabels = [1=>'ドキドキ少なめ',2=>'穏やかな関係',3=>'楽しい恋人',4=>'情熱的な恋',5=>'運命の恋人'];
    // aisho.php 637-646行目の3分岐理由文を複製。名前入力は今回のAPIに存在しないため
    // $yLabel/$pLabelは「あなた」「お相手」に固定する
    if ($yZ['el'] === $pZ['el']) {
        $marriageReasonText = "あなた（{$yZ['name']}）とお相手（{$pZ['name']}）の組み合わせは、同じ{$yZ['el']}のエレメント同士。価値観が近く、長期的な安定が期待できる相性です。";
    } elseif (in_array([$yZ['el'], $pZ['el']], [['火','風'],['風','火'],['水','地'],['地','水']])) {
        $marriageReasonText = "あなた（{$yZ['name']}）とお相手（{$pZ['name']}）の組み合わせは、{$yZ['el']}と{$pZ['el']}の補い合う相性。お互いの弱点を支え合える理想的な関係です。";
    } else {
        $marriageReasonText = "あなた（{$yZ['name']}）とお相手（{$pZ['name']}）の組み合わせは、異なるエレメント同士ですが、だからこそ相手から学べることが多い刺激的な関係になります。";
    }
    // aisho.php 662-667行目の$charms配列を複製（12星座分、一字一句そのまま）
    $charms = [
        '山羊座'=>'堅実さと深い愛情','水瓶座'=>'独自の世界観と知的な会話',
        '魚座'=>'包み込むような優しさ','牡羊座'=>'情熱とストレートな表現',
        '牡牛座'=>'揺るぎない安心感と誠実さ','双子座'=>'軽やかなユーモアと好奇心',
        '蟹座'=>'深い愛情と細やかな気遣い','獅子座'=>'華やかな存在感とリード力',
        '乙女座'=>'誠実さと丁寧な愛し方','天秤座'=>'優雅な雰囲気とバランス感覚',
        '蠍座'=>'情熱的な一途さと深み','射手座'=>'自由な発想と前向きなエネルギー',
    ];
    $charm = $charms[$pZ['name']] ?? '魅力';
    $loverReasonText = "恋愛においては、{$pZ['name']}の{$charm}があなたを惹きつけるポイントになりそうです。";
    return [
        'yZ' => $yZ, 'pZ' => $pZ,
        'marriageScore' => $marriageScore, 'marriageLabel' => $marriageLabels[$marriageScore], 'marriageReasonText' => $marriageReasonText,
        'loverScore' => $loverScore, 'loverLabel' => $loverLabels[$loverScore], 'loverReasonText' => $loverReasonText,
    ];
}
