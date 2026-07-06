<?php
declare(strict_types=1);

/**
 * inc/shichu-engine.php
 *
 * shichu.php の命式計算ロジック（クライアントサイドJavaScript）をPHPへ忠実に移植したもの。
 * docs/sansei-engine-design.md（Step0）/ IMPLEMENTATION_PLAN.md（Step1-2）に基づく。
 *
 * Step1-4時点で meta・raw・traits・highlights・extras の全キーが揃い、ShichuResult（ResultData）が完成する。
 * rawの構造はStep1-2から、traitsの対応関係はStep1-3から変更していない（追加のみで育てる方針）。
 *
 * ResultDataの各キーの責務（tarot・seizaでも共通の定義。docs/sansei-engine-design.md §4参照）:
 *   meta       : UI見出し（HTMLの<title>タグとは無関係。三星ページの占術カードタイトル用）
 *   raw        : 唯一の事実ソース（占術エンジンが算出した生データ）
 *   traits     : 統合用の特徴量（三星の統合解釈エンジンが読む。占術の意味論はここまでで完結させる）
 *   highlights : 占術側の要約（配列。既存解説文からの抽出であり、新規に文章を生成しない）
 *   extras     : UI付帯情報（配列。表示用の付加データのみ。raw項目の複製は行わない）
 *
 * 完成したResultDataは inc/resultdata-validator.php の validateResultData() で
 * 形だけを検証できる（占術の意味は検証しない。キーの存在・型のみ）。
 *
 * traitsの変換ルールは docs/shichu-trait-mapping.md（Rule ID: S001〜S013）が仕様。
 * このファイルはその実装であり、対応関係の変更は仕様書側を先に直すこと。
 *
 * 正しさの基準は tests/cases/shichu-golden.php（Golden Master）。
 * tests/tools/shichu-calc-snapshot.js（Node Snapshot）は移植元ではない。
 *
 * 律音（getRitchin のスコープ外参照バグ）は移植対象から除外している。
 * 詳細: tests/known-issues/ritchin-collabels-reference-error.md
 *
 * 「今年の流年運勢」「現在大運ハイライト」も、生年月日だけで決まらない値のため対象外。
 *
 * @return array{raw: array}
 */

require_once __DIR__ . '/oracle.php'; // myGregorianToJD() を利用
require_once __DIR__ . '/trait-vocabulary.php';
require_once __DIR__ . '/shichu-trait-mapping.php';

// ═══════════════════════════════════════════════════
// 基本定数（shichu.php の JS 定数と同一）
// ═══════════════════════════════════════════════════
const SHICHU_STEMS      = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
const SHICHU_BRANCHES   = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
const SHICHU_STEM_ELEM  = [0,0,1,1,2,2,3,3,4,4];
const SHICHU_STEM_YIN   = [0,1,0,1,0,1,0,1,0,1];
const SHICHU_ZANGGAN_MAIN = [8,5,0,1,4,2,3,5,6,7,4,8];
const SHICHU_JUSSHIN_NAMES = ['比肩','劫財','食神','傷官','偏財','正財','偏官','正官','偏印','印綬'];
const SHICHU_JUNI_UNSEI  = ['長生','沐浴','冠帯','建禄','帝旺','衰','病','死','墓','絶','胎','養'];
const SHICHU_CHOSEISTART = [11, 6, 2, 9, 2, 9, 5, 0, 8, 3];
const SHICHU_MONTH_BRANCH = [1,2,3,4,5,6,7,8,9,10,11,0];
const SHICHU_ELEMENTS = ['木','火','土','金','水'];

// highlights抽出用の既存解説文（shichu.php本体のNICHISHU_DESC/日主強弱descと同一）。
// 新規に文章を生成するのではなく、既存コンテンツからそのまま抽出するために保持する。
const SHICHU_NICHISHU_DESC = [
    ['name'=>'甲木', 'desc'=>'大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。'],
    ['name'=>'乙木', 'desc'=>'柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。'],
    ['name'=>'丙火', 'desc'=>'太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。'],
    ['name'=>'丁火', 'desc'=>'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。'],
    ['name'=>'戊土', 'desc'=>'山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。'],
    ['name'=>'己土', 'desc'=>'肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。'],
    ['name'=>'庚金', 'desc'=>'刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。'],
    ['name'=>'辛金', 'desc'=>'宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。'],
    ['name'=>'壬水', 'desc'=>'大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。'],
    ['name'=>'癸水', 'desc'=>'恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。'],
];
const SHICHU_STRENGTH_DESC = [
    '身強' => 'エネルギーが旺盛。積極的な行動が吉。',
    '中和' => 'バランスが取れた命式。柔軟な対応が強み。',
    '身弱' => '周囲のサポートを活かすことで力を発揮する。',
];

// ═══════════════════════════════════════════════════
// ① 節入り日算出
// ═══════════════════════════════════════════════════
function shichu_getSolarTermDay(int $year, int $month): int {
    $C20 = [6.3811,4.6295,6.3826,5.5820,6.3180,6.5000,7.9280,7.9922,8.2587,8.4328,7.3306,7.9584];
    $C21 = [5.4055,3.8708,6.3780,4.8120,5.5200,5.6780,7.1080,7.5008,7.6460,7.9000,6.9000,7.1800];
    $idx = $month - 1;
    if ($year >= 2000) {
        $Y = $year - 2000;
        return (int)floor($C21[$idx] + 0.2422 * $Y) - (int)floor($Y / 4);
    }
    $Y = $year - 1900;
    return (int)floor($C20[$idx] + 0.2422 * $Y) - (int)floor(($Y - 1) / 4);
}

// ═══════════════════════════════════════════════════
// ② 年柱
// ═══════════════════════════════════════════════════
/** @return array{stem:int, branch:int} */
function shichu_getYearPillar(int $year, int $month, int $day): array {
    $y = $year;
    $chunDay = shichu_getSolarTermDay($year, 2);
    if ($month < 2 || ($month === 2 && $day < $chunDay)) $y--;
    return ['stem' => ($y - 4 + 600) % 10, 'branch' => ($y - 4 + 600) % 12];
}

// ═══════════════════════════════════════════════════
// ③ 月柱
// ═══════════════════════════════════════════════════
/** @return array{stem:int, branch:int} */
function shichu_getMonthPillar(int $year, int $month, int $day, int $yearStem): array {
    $termDay = shichu_getSolarTermDay($year, $month);
    $m = $month;
    $y = $year;
    if ($day < $termDay) {
        $m--;
        if ($m === 0) { $m = 12; $y--; }
    }
    $branch = SHICHU_MONTH_BRANCH[$m - 1];
    $monthStartStems = [2, 4, 6, 8, 0];
    $yStem = ($y - 4 + 600) % 10;
    $monthOffset = ($branch - 2 + 12) % 12;
    $stem = ($monthStartStems[$yStem % 5] + $monthOffset) % 10;
    return ['stem' => $stem, 'branch' => $branch];
}

// ═══════════════════════════════════════════════════
// ④ 日柱（myGregorianToJD は inc/oracle.php を再利用）
// ═══════════════════════════════════════════════════
/** @return array{stem:int, branch:int} */
function shichu_getDayPillar(int $year, int $month, int $day): array {
    $jdn = myGregorianToJD($year, $month, $day);
    $cycle = ($jdn + 49) % 60;
    return ['stem' => $cycle % 10, 'branch' => $cycle % 12];
}

// ═══════════════════════════════════════════════════
// ⑤ 時柱
// ═══════════════════════════════════════════════════
function shichu_getHourBranch(int $hour): int {
    if ($hour === 23) return 0;
    return (int)floor(($hour + 1) / 2);
}
/** @return array{stem:int, branch:int} */
function shichu_getHourPillar(int $hour, int $dayStem): array {
    $branch = shichu_getHourBranch($hour);
    $startStems = [0, 2, 4, 6, 8];
    $stem = ($startStems[$dayStem % 5] + $branch) % 10;
    return ['stem' => $stem, 'branch' => $branch];
}

// ═══════════════════════════════════════════════════
// ⑥ 十神（通変星）
// ═══════════════════════════════════════════════════
function shichu_getTenGod(int $dayStem, int $otherStem): int {
    if ($dayStem === $otherStem) return 0;
    $de = SHICHU_STEM_ELEM[$dayStem]; $dy = SHICHU_STEM_YIN[$dayStem];
    $oe = SHICHU_STEM_ELEM[$otherStem]; $oy = SHICHU_STEM_YIN[$otherStem];
    $same = $dy === $oy;
    if ($de === $oe) return $same ? 0 : 1;
    if (($de + 1) % 5 === $oe) return $same ? 2 : 3;
    if (($de + 2) % 5 === $oe) return $same ? 4 : 5;
    if (($de + 3) % 5 === $oe) return $same ? 6 : 7;
    if (($de + 4) % 5 === $oe) return $same ? 8 : 9;
    return -1;
}

// ═══════════════════════════════════════════════════
// ⑦ 日主の強弱
// ═══════════════════════════════════════════════════
/**
 * @param int[] $allStems
 * @return array{label:string, cls:string}
 */
function shichu_getDayStrength(int $dayStem, int $monthBranch, array $allStems): array {
    $de = SHICHU_STEM_ELEM[$dayStem];
    $seasonScores = [
        [2, 1, 4, 4, 2, 1, 1, 1, 0, 0, 1, 3],
        [0, 0, 2, 2, 1, 4, 4, 2, 0, 0, 1, 1],
        [1, 3, 0, 0, 3, 2, 3, 3, 2, 2, 3, 1],
        [2, 2, 0, 0, 1, 0, 0, 1, 4, 4, 2, 2],
        [4, 3, 1, 1, 2, 0, 0, 0, 2, 2, 2, 4],
    ];
    $score = $seasonScores[$de][$monthBranch];
    foreach ($allStems as $s) {
        $g = shichu_getTenGod($dayStem, $s);
        if ($g === 0 || $g === 1 || $g === 8 || $g === 9) $score += 1;
        else $score -= 0.5;
    }
    if ($score >= 6) return ['label' => '身強', 'cls' => 'strength-strong'];
    if ($score >= 3) return ['label' => '中和', 'cls' => 'strength-mid'];
    return ['label' => '身弱', 'cls' => 'strength-weak'];
}

// ═══════════════════════════════════════════════════
// ⑧ 十二運星
// ═══════════════════════════════════════════════════
function shichu_getJuniUnsei(int $dayStem, int $branch): string {
    $start = SHICHU_CHOSEISTART[$dayStem];
    $yang = SHICHU_STEM_YIN[$dayStem] === 0;
    $steps = $yang ? (($branch - $start + 12) % 12) : (($start - $branch + 12) % 12);
    return SHICHU_JUNI_UNSEI[$steps];
}

// ═══════════════════════════════════════════════════
// ⑨ 天中殺
// ═══════════════════════════════════════════════════
/** @return int[] */
function shichu_getTenchusatsu(int $dayCycle): array {
    $missing = [[10,11],[8,9],[6,7],[4,5],[2,3],[0,1]];
    return $missing[(int)floor($dayCycle / 10)];
}

// ═══════════════════════════════════════════════════
// ⑩ 大運算出
// ═══════════════════════════════════════════════════
/** @return array{forward:bool, startAge:int, daiyun: array<int, array{stem:int, branch:int, startAge:int}>} */
function shichu_getDaiyun(int $birthYear, int $birthMonth, int $birthDay, string $gender, int $yearStem, int $monthStem, int $monthBranch): array {
    $yearYang = $yearStem % 2 === 0;
    $forward = ($gender === 'male' && $yearYang) || ($gender === 'female' && !$yearYang);

    $days = 0;
    if ($forward) {
        $m = $birthMonth; $y = $birthYear;
        $termDay = shichu_getSolarTermDay($y, $m);
        if ($birthDay >= $termDay) { $m++; if ($m > 12) { $m = 1; $y++; } }
        $nextTerm = new DateTimeImmutable(sprintf('%04d-%02d-%02d', $y, $m, shichu_getSolarTermDay($y, $m)));
        $birth = new DateTimeImmutable(sprintf('%04d-%02d-%02d', $birthYear, $birthMonth, $birthDay));
        $days = (int)round(($nextTerm->getTimestamp() - $birth->getTimestamp()) / 86400);
    } else {
        $m = $birthMonth; $y = $birthYear;
        $termDay = shichu_getSolarTermDay($y, $m);
        if ($birthDay < $termDay) {
            $m--; if ($m === 0) { $m = 12; $y--; }
            $prevTermDate = new DateTimeImmutable(sprintf('%04d-%02d-%02d', $y, $m, shichu_getSolarTermDay($y, $m)));
        } else {
            $prevTermDate = new DateTimeImmutable(sprintf('%04d-%02d-%02d', $y, $m, $termDay));
        }
        $birth = new DateTimeImmutable(sprintf('%04d-%02d-%02d', $birthYear, $birthMonth, $birthDay));
        $days = (int)round(($birth->getTimestamp() - $prevTermDate->getTimestamp()) / 86400);
    }
    $startAge = (int)round($days / 3);

    $daiyun = [];
    $s = $monthStem; $b = $monthBranch;
    for ($i = 0; $i < 8; $i++) {
        if ($forward) { $s = ($s + 1) % 10; $b = ($b + 1) % 12; }
        else          { $s = ($s + 9) % 10; $b = ($b + 11) % 12; }
        $daiyun[] = ['stem' => $s, 'branch' => $b, 'startAge' => $startAge + $i * 10];
    }
    return ['forward' => $forward, 'startAge' => $startAge, 'daiyun' => $daiyun];
}

// ═══════════════════════════════════════════════════
// traits変換（inc/shichu-trait-mapping.php が単一の情報源。Rule ID: S001〜S013）
// tarot-engine.phpと同じデータ駆動方式（PHP配列を参照するだけ。ルールをコードに埋め込まない）
// ═══════════════════════════════════════════════════
/**
 * @param array $raw shichuEngine()のraw（dayStrength, tenGodGridを利用）
 * @return array<string, array{score:int, type:string}>
 */
function shichu_computeTraits(array $raw): array {
    $traits = [];
    $add = function (string $trait, int $score) use (&$traits) {
        if (!isset($traits[$trait])) {
            $traits[$trait] = ['score' => 0, 'type' => 'permanent'];
        }
        $traits[$trait]['score'] += $score;
    };

    // S001-S003: dayStrength
    $dayStrengthRules = SHICHU_TRAIT_MAPPING['dayStrength'][$raw['dayStrength']['label']] ?? [];
    foreach ($dayStrengthRules as $rule) {
        $add($rule['trait'], $rule['score']);
    }

    // S004-S013: tenGodGrid（出現回数分だけ加算。存在判定ではなく頻度を使う）
    foreach ($raw['tenGodGrid'] as $entry) {
        $rules = SHICHU_TRAIT_MAPPING['tenGod'][$entry['tenGodIndex']] ?? [];
        foreach ($rules as $rule) {
            $add($rule['trait'], $rule['score']);
        }
    }

    return $traits;
}

// ═══════════════════════════════════════════════════
// meta: ResultData自身の見出し。HTMLの<title>とは無関係
// （三星ページの各占術カードのタイトルとして使う想定）
// ═══════════════════════════════════════════════════
/** @return array{title:string, subtitle:string} */
function shichu_computeMeta(array $raw): array {
    $dayStem = $raw['dayPillar']['stem'];
    $nd = SHICHU_NICHISHU_DESC[$dayStem];
    $yin = SHICHU_STEM_YIN[$dayStem] ? '陰' : '陽';
    return [
        'title' => '四柱推命',
        'subtitle' => "日主：{$nd['name']}（{$yin}）",
    ];
}

// ═══════════════════════════════════════════════════
// highlights: 既存解説文からの抽出（新規に文章を生成しない）
// ═══════════════════════════════════════════════════
/** @return string[] */
function shichu_computeHighlights(array $raw): array {
    $dayStem = $raw['dayPillar']['stem'];
    $nd = SHICHU_NICHISHU_DESC[$dayStem];
    $strengthDesc = SHICHU_STRENGTH_DESC[$raw['dayStrength']['label']] ?? '';
    return [
        $nd['desc'],
        $strengthDesc,
    ];
}

// ═══════════════════════════════════════════════════
// extras: 表示用の付加データのみ（raw項目の複製はしない）
// inc/oracle.php の getLuckyItems() を再利用する
//
// {type, label, value} のオブジェクト配列で統一する（tarot-engine.php と同じ形式）。
// 将来「ラッキータイム」等が増えても、この形式なら要素を追加するだけで済み、UI側の
// 表示ロジックも占術非依存にできる。
// ═══════════════════════════════════════════════════
/** @return array<int, array{type:string, label:string, value:mixed}> */
function shichu_computeExtras(int $year, int $month, int $day): array {
    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
    $lucky = getLuckyItems($dateStr);
    return [
        ['type' => 'lucky_color', 'label' => 'ラッキーカラー', 'value' => $lucky['color']],
        ['type' => 'lucky_number', 'label' => 'ラッキーナンバー', 'value' => $lucky['number']],
        ['type' => 'lucky_items', 'label' => 'ラッキーアイテム', 'value' => $lucky['items']],
    ];
}

// ═══════════════════════════════════════════════════
// 律音チェック（Golden Masterから除外する既知バグの入力を弾くため）
// tests/known-issues/ritchin-collabels-reference-error.md 参照
// ═══════════════════════════════════════════════════
function shichu_hasRitchin(array $pillars): bool {
    $n = count($pillars);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ($pillars[$i] !== null && $pillars[$j] !== null
                && $pillars[$i]['stem'] === $pillars[$j]['stem']
                && $pillars[$i]['branch'] === $pillars[$j]['branch']) {
                return true;
            }
        }
    }
    return false;
}

// ═══════════════════════════════════════════════════
// ⑪ Engine エントリポイント（Step1-2: raw のみ返す）
// ═══════════════════════════════════════════════════
/**
 * @param array{year:int, month:int, day:int, hour:?int, gender:string} $birth
 * @return array{raw: array}
 */
function shichuEngine(array $birth): array {
    $year = $birth['year'];
    $month = $birth['month'];
    $day = $birth['day'];
    $hour = $birth['hour'] ?? null;
    $gender = $birth['gender'];
    $hasHour = $hour !== null;

    $yp = shichu_getYearPillar($year, $month, $day);
    $mp = shichu_getMonthPillar($year, $month, $day, $yp['stem']);
    $dp = shichu_getDayPillar($year, $month, $day);
    $hp = $hasHour ? shichu_getHourPillar($hour, $dp['stem']) : null;

    $allStems = $hasHour ? [$yp['stem'], $mp['stem'], $hp['stem']] : [$yp['stem'], $mp['stem']];
    $dayStrength = shichu_getDayStrength($dp['stem'], $mp['branch'], $allStems);

    $positions = $hasHour
        ? [
            ['label' => '年干', 'stem' => $yp['stem']],
            ['label' => '年支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$yp['branch']]],
            ['label' => '月干', 'stem' => $mp['stem']],
            ['label' => '月支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$mp['branch']]],
            ['label' => '日支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$dp['branch']]],
            ['label' => '時干', 'stem' => $hp['stem']],
            ['label' => '時支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$hp['branch']]],
        ]
        : [
            ['label' => '年干', 'stem' => $yp['stem']],
            ['label' => '年支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$yp['branch']]],
            ['label' => '月干', 'stem' => $mp['stem']],
            ['label' => '月支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$mp['branch']]],
            ['label' => '日支（蔵干）', 'stem' => SHICHU_ZANGGAN_MAIN[$dp['branch']]],
        ];

    $tenGodGrid = [];
    foreach ($positions as $pos) {
        $g = shichu_getTenGod($dp['stem'], $pos['stem']);
        if ($g < 0) continue;
        $tenGodGrid[] = ['label' => $pos['label'], 'stem' => $pos['stem'], 'tenGodIndex' => $g];
    }

    $dayCycle = (myGregorianToJD($year, $month, $day) + 49) % 60;
    $tenchusatsuBranches = shichu_getTenchusatsu($dayCycle);

    $dy = shichu_getDaiyun($year, $month, $day, $gender, $yp['stem'], $mp['stem'], $mp['branch']);
    $daiyunPeriods = array_map(function ($d) use ($dp) {
        return [
            'stem' => $d['stem'],
            'branch' => $d['branch'],
            'startAge' => $d['startAge'],
            'tenGodIndex' => shichu_getTenGod($dp['stem'], $d['stem']),
            'juniName' => shichu_getJuniUnsei($dp['stem'], $d['branch']),
        ];
    }, $dy['daiyun']);

    $raw = [
        'yearPillar' => $yp,
        'monthPillar' => $mp,
        'dayPillar' => $dp,
        'hourPillar' => $hp,
        'dayStrength' => $dayStrength,
        'tenGodGrid' => $tenGodGrid,
        'tenchusatsuBranches' => $tenchusatsuBranches,
        'daiyun' => ['forward' => $dy['forward'], 'startAge' => $dy['startAge'], 'periods' => $daiyunPeriods],
    ];

    return [
        'meta' => shichu_computeMeta($raw),
        'raw' => $raw,
        'traits' => shichu_computeTraits($raw),
        'highlights' => shichu_computeHighlights($raw),
        'extras' => shichu_computeExtras($year, $month, $day),
    ];
}
