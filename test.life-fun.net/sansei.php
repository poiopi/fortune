<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 占いロジック（Step3で撤去。sansei.php は占い計算ロジックを持たない。
// 実装は inc/shichu-engine.php・inc/tarot-engine.php・inc/seiza-engine.php・
// inc/axis-engine.php の sanseiEngine() へ移行済み。sanseiEngine()を唯一の
// 情報源とし、旧来の独自簡易ロジックへは戻さない）
// ══════════════════════════════════════════════════════════════════

require_once __DIR__ . '/inc/shichu-engine.php';
require_once __DIR__ . '/inc/tarot-engine.php';
require_once __DIR__ . '/inc/seiza-engine.php';
require_once __DIR__ . '/inc/axis-engine.php';
require_once __DIR__ . '/inc/resultdata-validator.php';

// ══════════════════════════════════════════════════════════════════
// リクエスト処理
// ══════════════════════════════════════════════════════════════════

$result   = null;
$errors   = [];
$name     = '';
$birthday = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']     ?? '');
    $birthday = trim($_POST['birthday'] ?? '');

    if ($name === '')     $errors[] = 'お名前を入力してください。';
    if ($birthday === '') $errors[] = '生年月日を入力してください。';
    if ($birthday !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday))
        $errors[] = '生年月日の形式が正しくありません。';

    if (empty($errors)) {
        $bDate = new DateTimeImmutable($birthday);

        // Step3 Phase1: エンジンへ渡す入力値をここに集約する。
        // フォームは性別・出生時刻・時間帯を収集していないため、暫定値を使う。
        // Phase2でフォームに項目を追加する際は、ここだけを差し替えればよい。
        $engineInput = [
            'year'      => (int)$bDate->format('Y'),
            'month'     => (int)$bDate->format('n'),
            'day'       => (int)$bDate->format('j'),
            // 現在のSanseiResultはdaiyun（性別で順行/逆行が変わる）をtraits・meta・
            // highlights・extrasのいずれにも使用していないため、性別が仮値でも
            // 出力に影響しない（2026-07-05確認済み）。将来daiyunをUI表示または
            // traitへ反映する場合は、フォーム入力へ変更すること。
            'gender'    => 'male',
            'birthTime' => null,
            'timeBand'  => 'U', // 'わからない'。seiza.php本体にも存在する正式な選択肢
        ];

        $shichuResult = shichuEngine([
            'year'   => $engineInput['year'],
            'month'  => $engineInput['month'],
            'day'    => $engineInput['day'],
            'hour'   => $engineInput['birthTime'],
            'gender' => $engineInput['gender'],
        ]);

        $draw = tarot_drawRandomCard();
        $tarotResult = tarotEngine($draw['cardOrder'], $draw['isUpright']);

        $seizaResult = seizaEngine($engineInput['month'], $engineInput['day'], $engineInput['timeBand']);

        validateResultData($shichuResult);
        validateResultData($tarotResult);
        validateResultData($seizaResult);

        $sanseiResult = sanseiEngine([
            'shichu' => $shichuResult,
            'tarot'  => $tarotResult,
            'seiza'  => $seizaResult,
        ]);

        // ── 表示用アダプター ──
        // レイアウト構造（3占術ブロック＋統合鑑定ブロック）はStep3時点では変更しない。
        // 各フィールドは実エンジンの出力から組み立てる。対応するデータがない項目
        // （惑星・星座側のラッキー情報等）は復元せず削除する（理由は各所のコメント参照）。

        $seizaSign = SEIZA_SIGNS[$seizaResult['raw']['signIndex']];
        $zodiac = [
            'symbol' => $seizaSign['symbol'],
            'name'   => $seizaSign['name'],
        ];
        $zodiacReading = [
            // Removed in Step3: 「惑星」はseizaEngineのデータモデルに存在しない概念のため、
            // 旧sansei.php独自データを復元しない。
            // Removed in Step3: 星座側の「ラッキー○○」もseizaEngineに概念が存在しないため削除。
            'message' => $seizaResult['highlights'][0],
        ];

        $tarotCard = TAROT_DATA[$tarotResult['raw']['cardOrder']];
        $tarot = [
            'symbol'  => '🃏', // カードごとの絵文字は旧sansei.php独自データのため復元しない（固定の装飾アイコン）
            'num'     => $tarotCard['num'],
            'name'    => $tarotCard['name'],
            'upright' => $tarotResult['raw']['isUpright'],
            'message' => $tarotResult['highlights'][0],
        ];

        $dayStemIdx    = $shichuResult['raw']['dayPillar']['stem'];
        $dayBranchIdx  = $shichuResult['raw']['dayPillar']['branch'];
        $yearStemIdx   = $shichuResult['raw']['yearPillar']['stem'];
        $yearBranchIdx = $shichuResult['raw']['yearPillar']['branch'];
        $sichu = [
            'dayStem'    => SHICHU_STEMS[$dayStemIdx],
            'element'    => SHICHU_ELEMENTS[SHICHU_STEM_ELEM[$dayStemIdx]],
            'yearPillar' => SHICHU_STEMS[$yearStemIdx] . SHICHU_BRANCHES[$yearBranchIdx],
            'dayPillar'  => SHICHU_STEMS[$dayStemIdx] . SHICHU_BRANCHES[$dayBranchIdx],
            // Removed in Step3: 「キーワード」（成長・発展・柔軟 等）は旧sansei.php独自データの
            // ため復元しない。日主の解説文（message）が実質的な代替になる。
            'extras'     => $shichuResult['extras'], // {type,label,value}形式。旧「lucky」を置換
            'message'    => $shichuResult['highlights'][0],
        ];

        $result = [
            'zodiac'        => $zodiac,
            'zodiacReading' => $zodiacReading,
            'tarot'         => $tarot,
            'sichu'         => $sichu,
            'sansei'        => $sanseiResult,
        ];
    }
}

function stars(int $n, int $max = 5): string {
    $out = '';
    for ($i = 1; $i <= $max; $i++)
        $out .= '<span class="star' . ($i <= $n ? ' filled' : '') . '">★</span>';
    return $out;
}

/**
 * extras（{type,label,value}形式）のvalueを表示用文字列に整形する。
 * valueはスカラー（数値・文字列）、連想配列（例:lucky_colorの{name,meaning}）、
 * リスト配列（例:lucky_itemsの[{cat,item},...]）のいずれかを取り得る。
 */
function sansei_formatExtraValue($value): string {
    if (!is_array($value)) return (string)$value;
    if (isset($value['name'])) return (string)$value['name'];
    $items = [];
    foreach ($value as $entry) {
        if (is_array($entry) && isset($entry['item'])) $items[] = $entry['item'];
        elseif (is_scalar($entry)) $items[] = (string)$entry;
    }
    return implode('、', $items);
}

// ══════════════════════════════════════════════════════════════════
// 開運カレンダー用ロジック（三星統合鑑定とは無関係な別機能。Step3のスコープ外）
//
// 関数名にsansei_cal接頭辞を付けている理由：Step3でinc/shichu-engine.php経由
// inc/oracle.phpをrequireするようになり、oracle.php側にも同名の
// myGregorianToJD()/jdToLunar()/getRokuyo()が存在するため（Step1-0で確認済みの
// 重複実装）、関数名の衝突（Fatal error: Cannot redeclare）を避ける必要がある。
// oracle.php側のgetRokuyo()はclass値の形式が異なる（'taian' vs 'cal-taian'）ため、
// 単純な差し替えはCSSとの対応が崩れる。この開運カレンダー機能自体の重複解消は
// 別タスクとして扱い、ここでは名前衝突の回避のみ行う。
// ══════════════════════════════════════════════════════════════════

function sansei_calGregorianToJD(int $y, int $m, int $d): int {
    if ($m <= 2) { $y--; $m += 12; }
    $a = (int)($y / 100);
    $b = 2 - $a + (int)($a / 4);
    return (int)(365.25 * ($y + 4716)) + (int)(30.6001 * ($m + 1)) + $d + $b - 1524;
}

function sansei_calJdToLunar(int $jd): array {
    $cycle = $jd - 2451550;
    $monthNum = (int)($cycle / 29.53059);
    $monthStart = (int)(2451550 + $monthNum * 29.53059);
    $day = $jd - $monthStart + 1;
    $month = (($monthNum % 12) + 12) % 12 + 1;
    return ['month' => $month, 'day' => $day];
}

function sansei_getRokuyo(int $year, int $month, int $day): array {
    $rokuyoList = [
        ['name'=>'大安', 'kana'=>'たいあん', 'class'=>'cal-taian',  'color'=>'#c9a84c', 'desc'=>'万事に大吉。何を始めるにも最良の日。'],
        ['name'=>'赤口', 'kana'=>'しゃっこう', 'class'=>'cal-shakku', 'color'=>'#e8719a', 'desc'=>'午の刻のみ吉。火や血に注意の日。'],
        ['name'=>'先勝', 'kana'=>'せんしょう', 'class'=>'cal-sensho', 'color'=>'#9b72ef', 'desc'=>'急ぐことが吉。午前中に動くのが吉。'],
        ['name'=>'友引', 'kana'=>'ともびき', 'class'=>'cal-tomobiki','color'=>'#4ecdc4','desc'=>'慶事吉、弔事凶。朝夕は吉の日。'],
        ['name'=>'先負', 'kana'=>'せんぷ', 'class'=>'cal-senbu',  'color'=>'#8a7db5', 'desc'=>'午後が吉。静かに過ごすのが良い日。'],
        ['name'=>'仏滅', 'kana'=>'ぶつめつ', 'class'=>'cal-butsu',  'color'=>'#6b6456', 'desc'=>'控えめに過ごすのが吉とされる日。'],
    ];
    $jd = sansei_calGregorianToJD($year, $month, $day);
    $lunar = sansei_calJdToLunar($jd);
    $idx = ($lunar['month'] + $lunar['day']) % 6;
    return $rokuyoList[$idx];
}

function getLuckyToday(): array {
    $seed = crc32(date('Y-m-d'));
    mt_srand($seed);

    $colors  = ['ゴールド','ラベンダー','エメラルドグリーン','ロイヤルブルー','パールホワイト',
                'ディープレッド','シルバー','コーラルピンク','アンバー','ターコイズ','バイオレット','シャンパンゴールド'];
    $foods   = ['はちみつトースト','抹茶ラテ','赤い果実のタルト','金柑','白桃','カモミールティー',
                'ざくろジュース','生姜湯','ブルーベリームフィン','松の実入りサラダ','ホットチョコレート','れんこんのきんぴら'];
    $items   = ['水晶のさざれ石','白いハンカチ','香りのよいキャンドル','お気に入りの文房具',
                'パール系アクセサリー','天然石ブレスレット','金色のしおり','アロマオイル','シルクのスカーフ','お守り'];
    $actions = ['深呼吸を3回','日記を書く','窓を開けて換気','誰かに感謝を伝える','早起きして朝日を見る',
                '花を飾る','瞑想10分','断捨離を少しだけ','空を見上げる','笑顔で挨拶する'];
    $msgs    = [
        '今日は自分の直感を信じて行動しましょう。',
        '小さな幸せに気づく日。日常に隠れた喜びを見つけて。',
        '感謝の気持ちが奇跡を呼ぶ日。ありがとうを大切に。',
        '人とのつながりが幸運の鍵。誰かのために動くことで豊かになる。',
        '変化を恐れないで。今日の一歩が大きな変容につながっています。',
        '自分を愛することが最高の開運行動。まず自分を大切に。',
        '言葉に力がある日。ポジティブな言葉を意識的に使ってみて。',
        '自然のエネルギーと同調する日。空や緑に触れると運気が整います。',
    ];

    return [
        'color'  => $colors[mt_rand(0, count($colors)-1)],
        'number' => mt_rand(1, 49),
        'food'   => $foods[mt_rand(0, count($foods)-1)],
        'item'   => $items[mt_rand(0, count($items)-1)],
        'action' => $actions[mt_rand(0, count($actions)-1)],
        'msg'    => $msgs[mt_rand(0, count($msgs)-1)],
    ];
}

$todayObj    = new DateTimeImmutable();
$calRokuyo   = sansei_getRokuyo((int)$todayObj->format('Y'), (int)$todayObj->format('n'), (int)$todayObj->format('j'));
$luckyToday  = getLuckyToday();
$weekdayJa   = ['日','月','火','水','木','金','土'][(int)$todayObj->format('w')];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
 <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-P1EKB3WWX8');
  </script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/sansei" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="西洋占星術×タロット×四柱推命の三位一体。名前と生年月日だけで鑑定する三星統合鑑定。">
<title>三星統合鑑定｜西洋占星術×タロット×四柱推命の統合鑑定</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<!-- AdSense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --void:    #08060f;
  --deep:    #0f0b1e;
  --surface: #16112b;
  --card:    #1e1738;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.35);
  --gold:    #c9a84c;
  --gold-lt: #e8c96a;
  --violet:  #9b72ef;
  --violet-lt:#c4a8f5;
  --rose:    #e8719a;
  --teal:    #4ecdc4;
  --text:    #e8e2f5;
  --muted:   #8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}

html{font-size:16px;scroll-behavior:smooth}
body{
  background:var(--void);
  color:var(--text);
  font-family:var(--ff-sans);
  font-weight:300;
  line-height:1.8;
  min-height:100vh;
  overflow-x:hidden;
}

/* ── 星空背景 ── */
body::before{
  content:'';
  position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%, rgba(90,50,180,.25) 0%, transparent 50%),
    radial-gradient(ellipse at 80% 80%, rgba(180,50,100,.15) 0%, transparent 50%),
    radial-gradient(ellipse at 50% 50%, rgba(30,20,60,.8) 0%, transparent 100%);
  pointer-events:none;z-index:0;
}

.wrap{position:relative;z-index:1;max-width:1100px;margin:0 auto;padding:0 1.2rem}

/* ── HERO ── */
.hero{
  text-align:center;
  padding:4rem 1rem 3rem;
  border-bottom:1px solid var(--border);
}
.hero-eyebrow{
  font-family:var(--ff-mono);
  font-size:.7rem;
  letter-spacing:.25em;
  color:var(--gold);
  text-transform:uppercase;
  margin-bottom:1.5rem;
  display:block;
}
.hero h1{
  font-family:var(--ff-serif);
  font-size:clamp(2rem,6vw,3.4rem);
  font-weight:700;
  line-height:1.15;
  letter-spacing:.06em;
  background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--rose) 100%);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:.8rem;
}
.hero-sub{
  color:var(--muted);
  font-size:.9rem;
  letter-spacing:.05em;
  margin-bottom:2rem;
}
.pillars{
  display:flex;
  justify-content:center;
  gap:1.5rem;
  flex-wrap:wrap;
}
.pillar{
  font-size:.75rem;
  letter-spacing:.1em;
  padding:.35rem 1rem;
  border:1px solid var(--border2);
  border-radius:20px;
  color:var(--violet-lt);
  font-family:var(--ff-mono);
  text-decoration:none;
  transition:opacity .2s;
}
.pillar:hover{opacity:.8}

/* ── フォーム ── */
.form-section{padding:2.5rem 0}
.form-card{
  background:var(--card);
  border:1px solid var(--border2);
  border-radius:16px;
  padding:2rem 2rem 2.5rem;
  box-shadow:0 8px 40px rgba(0,0,0,.4),inset 0 1px 0 rgba(255,255,255,.05);
}
.form-card h2{
  font-family:var(--ff-serif);
  font-size:1.15rem;
  font-weight:600;
  color:var(--gold-lt);
  margin-bottom:1.8rem;
  text-align:center;
  letter-spacing:.1em;
}
.field{margin-bottom:1.4rem}
label{
  display:block;
  font-size:.78rem;
  letter-spacing:.1em;
  color:var(--muted);
  margin-bottom:.5rem;
  font-family:var(--ff-mono);
}
input[type="text"],input[type="date"]{
  width:100%;
  background:rgba(255,255,255,.04);
  border:1px solid var(--border2);
  border-radius:8px;
  padding:.75rem 1rem;
  color:var(--text);
  font-size:1rem;
  font-family:var(--ff-sans);
  outline:none;
  transition:border-color .2s,box-shadow .2s;
  -webkit-appearance:none;
}
input[type="text"]:focus,input[type="date"]:focus{
  border-color:var(--violet);
  box-shadow:0 0 0 3px rgba(155,114,239,.2);
}
input[type="date"]::-webkit-calendar-picker-indicator{filter:invert(.6)}
.form-input{
  width:100%;
  background:rgba(255,255,255,.04);
  border:1px solid var(--border2);
  border-radius:8px;
  padding:.75rem 1rem;
  color:var(--text);
  font-size:1rem;
  font-family:var(--ff-sans);
  outline:none;
  transition:border-color .2s,box-shadow .2s;
}
select.form-input{background-color:#1a1530;-webkit-appearance:none;appearance:none;color-scheme:dark}
.form-input:focus{border-color:var(--violet);box-shadow:0 0 0 3px rgba(155,114,239,.2)}
.btn-submit{
  width:100%;
  padding:1rem;
  background:linear-gradient(135deg,var(--violet) 0%,var(--rose) 100%);
  color:#fff;
  border:none;
  border-radius:10px;
  font-size:1rem;
  font-family:var(--ff-serif);
  font-weight:600;
  letter-spacing:.15em;
  cursor:pointer;
  margin-top:.5rem;
  transition:opacity .2s,transform .15s;
  box-shadow:0 4px 20px rgba(155,114,239,.4);
}
.btn-submit:hover{opacity:.9;transform:translateY(-1px)}
.btn-submit:active{transform:translateY(0)}
.error-list{
  background:rgba(200,70,70,.12);
  border:1px solid rgba(200,70,70,.3);
  border-radius:8px;
  padding:1rem 1.2rem;
  margin-bottom:1.2rem;
  font-size:.85rem;
  color:#e89090;
}
.error-list li{margin-left:1rem}

/* ── 結果 ── */
.result-section{padding-bottom:4rem}
.result-header{
  text-align:center;
  padding:2.5rem 0 2rem;
  border-bottom:1px solid var(--border);
  margin-bottom:2rem;
}
.result-name{
  font-family:var(--ff-serif);
  font-size:1.5rem;
  font-weight:700;
  color:var(--gold-lt);
  letter-spacing:.1em;
}
.result-date{
  font-family:var(--ff-mono);
  font-size:.75rem;
  color:var(--muted);
  margin-top:.4rem;
}

/* ── Result Hero（Step4-1）：archetype/summaryを結論ファーストで表示 ──
   ページ冒頭の .hero（無料占いポータルの静的タイトル）とは別要素・別クラス。
   視覚言語（グラデーション見出し）は既存の.hero h1と統一する（DESIGN.md準拠） */
.result-hero{
  text-align:center;
  padding:1rem 0 2rem;
}
.result-hero-eyebrow{
  font-family:var(--ff-mono);
  font-size:.68rem;
  letter-spacing:.25em;
  color:var(--gold);
  text-transform:uppercase;
  margin-bottom:1rem;
  display:block;
}
.result-hero h2{
  font-family:var(--ff-serif);
  font-size:clamp(1.6rem,5vw,2.6rem);
  font-weight:700;
  line-height:1.3;
  letter-spacing:.06em;
  background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--rose) 100%);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:1rem;
}
.result-hero-sub{
  font-family:var(--ff-serif);
  font-size:.95rem;
  line-height:2;
  color:var(--text);
  max-width:640px;
  margin:0 auto;
}

/* ── 影響度バッジ（各占術カード内、Step4-1） ── */
.influence-row{
  display:flex;
  align-items:center;
  gap:.5rem;
  margin-bottom:1rem;
  font-size:.72rem;
  font-family:var(--ff-mono);
  color:var(--muted);
}

.block{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:14px;
  padding:1.8rem;
  margin-bottom:1.5rem;
  position:relative;
  overflow:hidden;
}
.block::before{
  content:'';
  position:absolute;top:0;left:0;right:0;height:2px;
}
.block-astro::before{background:linear-gradient(90deg,var(--gold),var(--violet))}
.block-tarot::before{background:linear-gradient(90deg,var(--violet),var(--rose))}
.block-sichu::before{background:linear-gradient(90deg,var(--teal),var(--violet))}
.block-scores::before{background:linear-gradient(90deg,var(--gold),var(--violet),var(--rose))}
.block-advice::before{background:linear-gradient(90deg,var(--rose),var(--gold))}

.block-label{
  font-family:var(--ff-mono);
  font-size:.68rem;
  letter-spacing:.2em;
  text-transform:uppercase;
  color:var(--muted);
  margin-bottom:1rem;
}
.block-title{
  font-family:var(--ff-serif);
  font-size:1.4rem;
  font-weight:700;
  margin-bottom:1.2rem;
  display:flex;
  align-items:center;
  gap:.6rem;
}
.block-symbol{font-size:1.8rem;line-height:1}

.scores{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:.6rem;
  margin:1.2rem 0;
}
.score-row{
  display:flex;
  align-items:center;
  justify-content:space-between;
  font-size:.78rem;
}
.score-label{color:var(--muted);font-family:var(--ff-mono)}
.stars{display:flex;gap:2px}
.star{color:rgba(255,255,255,.15);font-size:.85rem}
.star.filled{color:var(--gold)}

.lucky-row{
  display:flex;
  gap:1rem;
  flex-wrap:wrap;
  margin-top:1rem;
  padding-top:1rem;
  border-top:1px solid var(--border);
}
.lucky-item{
  font-size:.75rem;
  font-family:var(--ff-mono);
  color:var(--violet-lt);
  background:rgba(155,114,239,.1);
  padding:.2rem .7rem;
  border-radius:20px;
  border:1px solid rgba(155,114,239,.2);
}
.lucky-item span{color:var(--muted);margin-right:.3rem}

.block-message{
  font-size:.9rem;
  line-height:2;
  color:var(--text);
  border-top:1px solid var(--border);
  padding-top:1.2rem;
  margin-top:1.2rem;
}

.tarot-direction{
  font-size:.72rem;
  font-family:var(--ff-mono);
  letter-spacing:.1em;
  padding:.15rem .6rem;
  border-radius:4px;
  margin-left:.5rem;
}
.upright{background:rgba(78,205,196,.15);color:var(--teal);border:1px solid rgba(78,205,196,.3)}
.reversed{background:rgba(232,113,154,.15);color:var(--rose);border:1px solid rgba(232,113,154,.3)}

.pillar-badges{
  display:flex;gap:.6rem;flex-wrap:wrap;margin:.8rem 0 1rem;
}
.pillar-badge{
  font-family:var(--ff-mono);
  font-size:.78rem;
  padding:.25rem .8rem;
  border-radius:6px;
  background:rgba(78,205,196,.1);
  border:1px solid rgba(78,205,196,.25);
  color:var(--teal);
}

/* ── AdSense枠 ── */
.adsense-space{
  min-height:100px;
  background:rgba(255,255,255,.02);
  border:1px dashed rgba(255,255,255,.08);
  border-radius:8px;
  margin:1.5rem 0;
  display:flex;
  align-items:center;
  justify-content:center;
  font-family:var(--ff-mono);
  font-size:.65rem;
  color:rgba(255,255,255,.1);
  letter-spacing:.1em;
}
.adsense-space::after{content:'AD SPACE'}

/* ── フッター ── */
footer{
  border-top:1px solid var(--border);
  padding:2rem;
  text-align:center;
  font-family:var(--ff-mono);
  font-size:.68rem;
  color:var(--muted);
  letter-spacing:.08em;
}

/* ── 2カラムレイアウト ── */
.main-layout{
  display:grid;
  grid-template-columns:1fr 300px;
  gap:1.5rem;
  align-items:start;
  margin-bottom:2rem;
}
/* サイドバー（カレンダー）はstickyで追従 */
.sidebar-col{
  position:sticky;
  top:90px;
}
/* メインコンテンツ列 */
.main-col{}

/* スマホ：縦並びに切り替え */
@media(max-width:768px){
  .main-layout{
    grid-template-columns:1fr;
  }
  .sidebar-col{
    position:static;
    order:3; /* スマホではフォーム→結果→カレンダーの順 */
  }
  .main-col{
    order:1;
  }
}

/* ── 開運カレンダー ── */
.cal-block{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:16px;
  overflow:hidden;
}
.cal-block-head{
  background:linear-gradient(135deg,rgba(201,168,76,.12),rgba(155,114,239,.08));
  border-bottom:1px solid var(--border);
  padding:1rem 1.2rem;
  display:flex;align-items:center;justify-content:space-between;gap:.5rem;flex-wrap:wrap;
}
.cal-block-title{font-family:var(--ff-serif);font-size:.95rem;font-weight:700;color:var(--gold-lt);letter-spacing:.08em}
.cal-today-date{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.08em}
.cal-body{padding:1.2rem;display:grid;grid-template-columns:auto 1fr;gap:1rem;align-items:start}
@media(max-width:400px){.cal-body{grid-template-columns:1fr}}

.rokuyo-badge{
  text-align:center;padding:.7rem .9rem;border-radius:10px;border:2px solid;min-width:68px;
}
.rokuyo-name{font-family:var(--ff-serif);font-size:1.4rem;font-weight:700;line-height:1}
.rokuyo-kana{font-family:var(--ff-mono);font-size:.52rem;letter-spacing:.1em;opacity:.7;margin-top:.3rem}
.rokuyo-desc{font-size:.75rem;color:var(--muted);line-height:1.6;margin-bottom:.7rem}
.today-msg-line{
  font-family:var(--ff-serif);font-size:.8rem;font-style:italic;
  color:var(--gold-lt);line-height:1.6;
  padding:.6rem .8rem;
  background:rgba(201,168,76,.06);
  border-left:2px solid var(--gold);
  border-radius:0 6px 6px 0;
}
.cal-taian{border-color:#c9a84c;background:rgba(201,168,76,.08)} .cal-taian .rokuyo-name{color:#c9a84c}
.cal-shakku{border-color:#e8719a;background:rgba(232,113,154,.08)} .cal-shakku .rokuyo-name{color:#e8719a}
.cal-sensho{border-color:#9b72ef;background:rgba(155,114,239,.08)} .cal-sensho .rokuyo-name{color:#c4a8f5}
.cal-tomobiki{border-color:#4ecdc4;background:rgba(78,205,196,.08)} .cal-tomobiki .rokuyo-name{color:#4ecdc4}
.cal-senbu{border-color:#8a7db5;background:rgba(138,125,181,.08)} .cal-senbu .rokuyo-name{color:#8a7db5}
.cal-butsu{border-color:#6b6456;background:rgba(107,100,86,.08)} .cal-butsu .rokuyo-name{color:#8a7db5}

.lucky-row{
  display:flex;gap:.4rem;flex-wrap:wrap;padding:.8rem 1.2rem;
  border-top:1px solid var(--border);
}
.lucky-chip{
  display:flex;align-items:center;gap:.3rem;
  font-size:.7rem;
  background:rgba(155,114,239,.08);border:1px solid rgba(155,114,239,.2);
  border-radius:20px;padding:.25rem .7rem;
}
.lucky-chip-label{font-family:var(--ff-mono);font-size:.55rem;color:var(--muted);letter-spacing:.06em;white-space:nowrap}
.lucky-chip-val{color:var(--violet-lt);font-weight:400}
.lucky-number-badge{
  display:inline-flex;align-items:center;justify-content:center;
  width:20px;height:20px;border-radius:50%;
  background:linear-gradient(135deg,var(--violet),var(--rose));
  font-family:var(--ff-serif);font-size:.72rem;font-weight:700;color:#fff;flex-shrink:0;
}
.cal-more-link{
  display:block;text-align:center;
  font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.1em;
  color:var(--muted);text-decoration:none;
  padding:.6rem;border-top:1px solid var(--border);
  transition:color .2s;
}
.cal-more-link:hover{color:var(--gold-lt)}

@media(max-width:600px){
  .form-card{padding:1.5rem 1.2rem 2rem}
  .block{padding:1.4rem 1.2rem}
  .scores{grid-template-columns:1fr}
  .hero{padding:3rem .5rem 2rem}
  .lucky-row{padding:.6rem 1rem}
}
/* ── ページ導線グリッド ── */
.page-grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:.9rem;
  margin-bottom:1.8rem;
}
@media(max-width:560px){.page-grid{grid-template-columns:1fr}}
.page-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:14px;
  padding:1.1rem 1.2rem 1rem;
  display:flex;flex-direction:column;gap:.45rem;
  position:relative;overflow:hidden;
  transition:border-color .2s,transform .15s;
}
.page-card:hover{border-color:var(--border2);transform:translateY(-2px)}
.page-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
.pc-violet::before{background:linear-gradient(90deg,var(--violet),var(--rose))}
.pc-gold::before  {background:linear-gradient(90deg,var(--gold),var(--violet))}
.pc-teal::before  {background:linear-gradient(90deg,var(--teal),var(--gold))}
.pc-rose::before  {background:linear-gradient(90deg,var(--rose),var(--violet))}
.pc-green::before {background:linear-gradient(90deg,#4a9c5a,#7ecf8a)}
.pc-compat::before{background:linear-gradient(90deg,var(--rose),var(--gold))}
.pc-zense::before {background:linear-gradient(90deg,var(--violet),var(--teal))}
.pc-guardian::before{background:linear-gradient(90deg,var(--gold-lt),var(--violet))}
.pc-seimei::before{background:linear-gradient(90deg,#c9a84c,#8b6914,#c9a84c)}
.pc-shichu::before{background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal))}
.page-card-label{font-family:var(--ff-mono);font-size:.58rem;letter-spacing:.15em;text-transform:uppercase;color:var(--muted)}
.page-card-title{font-family:var(--ff-serif);font-size:.95rem;font-weight:600;color:var(--text)}
.page-card-desc {font-size:.72rem;color:var(--muted);line-height:1.5;flex:1}
.page-card-btn{
  display:inline-block;text-align:center;
  padding:.45rem .8rem;border-radius:7px;
  font-family:var(--ff-serif);font-size:.78rem;font-weight:600;
  color:#fff;text-decoration:none;letter-spacing:.06em;
  transition:opacity .2s;margin-top:.25rem;align-self:flex-start;
}
.page-card-btn:hover{opacity:.85}
.btn-violet{background:linear-gradient(135deg,var(--teal),var(--violet));box-shadow:0 3px 12px rgba(78,205,196,.3)}
.btn-gold  {background:linear-gradient(135deg,var(--gold),var(--violet));box-shadow:0 3px 12px rgba(201,168,76,.3)}
.btn-teal  {background:linear-gradient(135deg,var(--teal),var(--gold));box-shadow:0 3px 12px rgba(78,205,196,.3)}
.btn-rose  {background:linear-gradient(135deg,var(--rose),var(--violet));box-shadow:0 3px 12px rgba(232,113,154,.3)}
.btn-green {background:linear-gradient(135deg,#4a9c5a,#2b7a3a);box-shadow:0 3px 12px rgba(74,156,90,.3)}
.btn-compat{background:linear-gradient(135deg,var(--rose),var(--gold));box-shadow:0 3px 12px rgba(232,113,154,.3)}
.btn-zense {background:linear-gradient(135deg,var(--violet),var(--teal));box-shadow:0 3px 12px rgba(155,114,239,.3)}
.btn-guardian{background:linear-gradient(135deg,var(--gold),var(--violet));box-shadow:0 3px 12px rgba(201,168,76,.3)}
.btn-seimei{background:linear-gradient(135deg,#c9a84c,#8b5e00);box-shadow:0 3px 12px rgba(201,168,76,.35)}
.btn-shichu{background:linear-gradient(135deg,var(--gold),var(--violet));box-shadow:0 3px 12px rgba(155,114,239,.35)}
.pc-geimei::before{background:linear-gradient(90deg,var(--rose),var(--violet),var(--teal))}
.btn-geimei{background:linear-gradient(135deg,var(--rose),var(--violet));box-shadow:0 3px 12px rgba(232,113,154,.35)}

/* 鑑定中画面 */
#loading-overlay{
    position:fixed;
    inset:0;
    background:rgba(8,6,15,.92);
    backdrop-filter:blur(8px);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.loader-box{
    text-align:center;
}

.crystal{
    font-size:4rem;
    animation: float 2s ease-in-out infinite;
}

.loading-text{
    margin-top:1rem;
    font-size:1.3rem;
    color:#e8c96a;
    font-family:'Shippori Mincho',serif;
}

.loading-sub{
    margin-top:.5rem;
    color:#9b72ef;
    font-size:.9rem;
}

@keyframes float{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-10px);
    }
}

/* 結果フェードイン */
.result-section{
    animation:fadeResult 1.2s ease;
}

@keyframes fadeResult{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
/* ── HEADER：inc/header.php側で一元管理（COMPONENTS.md参照） ── */
/* ======================
   三星鑑定について
====================== */
.guide-block{margin:1.5rem 0;padding:1.25rem 1.5rem;background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.22);border-radius:14px}
.guide-block-label{font-family:'DM Mono',monospace;font-size:.6rem;letter-spacing:.2em;color:var(--gold);text-transform:uppercase;margin-bottom:.5rem}
.guide-block-title{font-family:'Shippori Mincho',serif;font-size:1rem;font-weight:700;color:var(--text-lt);margin-bottom:.35rem}
.guide-block-desc{font-size:.8rem;color:var(--muted);line-height:1.7;margin-bottom:.9rem}
.guide-block-links{display:flex;flex-wrap:wrap;gap:.4rem;margin-bottom:.85rem}
.guide-link-tag{font-size:.72rem;color:var(--muted);text-decoration:none;padding:.25rem .65rem;border:1px solid rgba(155,114,239,.25);border-radius:20px;transition:border-color .2s,color .2s}
.guide-link-tag:hover{border-color:var(--violet-lt);color:var(--violet-lt)}
.guide-block-btn{display:inline-flex;align-items:center;gap:.4rem;font-family:'DM Mono',monospace;font-size:.72rem;letter-spacing:.08em;color:var(--violet-lt);text-decoration:none;border:1px solid rgba(155,114,239,.35);border-radius:20px;padding:.4rem 1rem;transition:border-color .2s,background .2s}
.guide-block-btn:hover{border-color:var(--violet-lt);background:rgba(155,114,239,.1)}

.about-box{
    max-width:900px;
    margin:2rem auto 3rem;
    padding:2rem;
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.1);
    border-radius:24px;
    backdrop-filter:blur(8px);
}

.about-box h2{
    text-align:center;
    margin-bottom:1.8rem;
    font-size:1.5rem;
    color:#ffe6a8;
}

.about-item{
    display:flex;
    align-items:flex-start;
    gap:1rem;
    margin-bottom:1.5rem;
}

.about-item:last-child{
    margin-bottom:0;
}

.about-item span{
    font-size:1.5rem;
    flex-shrink:0;
}

.about-item p{
    margin:0;
    line-height:1.9;
    color:#ddd;
}

@media(max-width:768px){

    .about-box{
        margin:1.5rem 1rem 2rem;
        padding:1.5rem;
    }

    .about-item{
        gap:.8rem;
    }

    .about-item span{
        font-size:1.3rem;
    }

    .about-box h2{
        font-size:1.2rem;
    }

}
/* ── スマホメニュー：inc/header.php側で一元管理（COMPONENTS.md参照） ── */
</style>
</head>
<body>
<?php $currentPage='sansei'; require __DIR__.'/inc/header.php'; ?>
<div class="wrap">

  <!-- HERO -->
  <header class="hero">
    <span class="hero-eyebrow">Free Fortune Telling</span>
    <h1>無料占いポータル｜三星統合鑑定</h1>
    <p class="hero-sub">タロット・数秘術・九星気学・姓名判断 ── 複数の占術で運命を読み解く</p>
    <div class="pillars">
      <a class="pillar" href="/seiza">♈ 西洋占星術</a>
      <a class="pillar" href="/tarot">🔮 タロット</a>
      <a class="pillar" href="/shichu">☯ 四柱推命</a>
    </div>
  </header>

  <!-- 2カラムレイアウト -->
  <div class="main-layout">

    <!-- 左：メインコンテンツ（フォーム＋結果） -->
    <div class="main-col">

      <!-- フォーム -->
      <section class="form-section" style="padding-top:0">
        <div class="form-card">
          <h2>✦ 鑑定情報を入力 ✦</h2>
          <?php if (!empty($errors)): ?>
            <ul class="error-list">
              <?php foreach($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <form method="post" action="" onsubmit="return validateBirthdate()">
            <div class="field">
              <label for="name">お名前（ニックネーム可）</label>
              <input type="text" id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" placeholder="例：さくら" required>
            </div>
            <div class="field">
              <label>生年月日</label>
              <?php
                [$by,$bm,$bdd] = $birthday !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)
                  ? explode('-', $birthday)
                  : ['', '', ''];
                require_once __DIR__.'/inc/birthday-input.php';
                render_birthdate_input([
                  'prefix'       => 'birth',
                  'hiddenName'   => 'birthday',
                  'defaultYear'  => $by !== '' ? (int)$by : 1990,
                  'defaultMonth' => $bm !== '' ? (int)$bm : null,
                  'defaultDay'   => $bdd !== '' ? (int)$bdd : null,
                ]);
              ?>
            </div>
            <button type="submit" class="btn-submit" data-ga-event="fortune_submit">✦ 三星鑑定を開始する ✦</button>
          </form>
          <script>
          function validateBirthdate(){
            if(!window.BirthdayInput.getValue('birth')){alert('生年月日をすべて選択してください');return false;}
            return true;
          }
          </script>
        </div>
      </section>

      <!-- 占いページ 2列グリッド -->
      <div class="page-grid">
        <div class="page-card pc-violet">
          <div class="page-card-label">Tarot</div>
          <div class="page-card-title">🃏 本格タロット占い</div>
          <div class="page-card-desc">カードをめくって今のあなたへのメッセージを受け取る</div>
          <a href="/tarot" class="page-card-btn btn-violet">カードを引く →</a>
        </div>
        <div class="page-card pc-shichu">
          <div class="page-card-label">Shichu Suimei</div>
          <div class="page-card-title">🔯 四柱推命</div>
          <div class="page-card-desc">生年月日から命式・十神・大運・天中殺を本格算出する</div>
          <a href="/shichu" class="page-card-btn btn-shichu">算出する →</a>
        </div>
        <div class="page-card pc-teal">
          <div class="page-card-label">Sanmeigaku</div>
          <div class="page-card-title">☯ 算命学</div>
          <div class="page-card-desc">元命・主星・従星から才能・恋愛・仕事適性を読み解く性格占術</div>
          <a href="/sanmei" class="page-card-btn btn-teal">鑑定する →</a>
        </div>
        <div class="page-card pc-rose">
          <div class="page-card-label">Western Astrology</div>
          <div class="page-card-title">⭐ 西洋占星術</div>
          <div class="page-card-desc">太陽星座×内面タイプ×時間帯で個性・恋愛・仕事適性を深掘り鑑定</div>
          <a href="/seiza" class="page-card-btn btn-rose">鑑定する →</a>
        </div>
        <div class="page-card pc-gold">
          <div class="page-card-label">MBTI × Zodiac</div>
          <div class="page-card-title">🧠 MBTI×星座 性格診断</div>
          <div class="page-card-desc">10の質問で性格タイプと星座の組み合わせ運命を診断</div>
          <a href="/mbti" class="page-card-btn btn-gold">診断する →</a>
        </div>
        <div class="page-card pc-teal">
          <div class="page-card-label">Numerology</div>
          <div class="page-card-title">🔢 数秘術診断</div>
          <div class="page-card-desc">生年月日と名前から4つの数字で人生の使命を読み解く</div>
          <a href="/numerology" class="page-card-btn btn-teal">診断する →</a>
        </div>
        <div class="page-card pc-rose">
          <div class="page-card-label">Nine Star Ki</div>
          <div class="page-card-title">⭐ 九星気学診断</div>
          <div class="page-card-desc">生まれ年の九星から運勢・相性・吉方位を鑑定</div>
          <a href="/kyusei" class="page-card-btn btn-rose">診断する →</a>
        </div>
        <div class="page-card pc-green">
          <div class="page-card-label">RPG Fortune</div>
          <div class="page-card-title">⚔️ RPG風占いの村</div>
          <div class="page-card-desc">勇者となって占いの村を冒険しながら運命を知る</div>
          <a href="/rpg" class="page-card-btn btn-green">冒険する →</a>
        </div>
        <div class="page-card pc-compat">
          <div class="page-card-label">Compatibility</div>
          <div class="page-card-title">💑 二人の相性診断</div>
          <div class="page-card-desc">星座と数秘術で恋愛・結婚の相性を鑑定する</div>
          <a href="/aisho" class="page-card-btn btn-compat">診断する →</a>
        </div>
        <div class="page-card pc-zense">
          <div class="page-card-label">Past Life Reading</div>
          <div class="page-card-title">🌀 前世診断</div>
          <div class="page-card-desc">あなたは何回目の転生？魂のカルテを読み解く</div>
          <a href="/zense" class="page-card-btn btn-zense">診断する →</a>
        </div>
        <div class="page-card pc-guardian">
          <div class="page-card-label">Guardian Spirit</div>
          <div class="page-card-title">👻 守護霊診断</div>
          <div class="page-card-desc">あなたを守る霊はUR？SSR？レアリティ付き守護霊を召喚</div>
          <a href="/guardian" class="page-card-btn btn-guardian">召喚する →</a>
        </div>
        <div class="page-card pc-seimei">
          <div class="page-card-label">Seimei Handan</div>
          <div class="page-card-title">✍️ 姓名判断</div>
          <div class="page-card-desc">名前に宿る運命を五格で鑑定。天格・人格・総格から運勢を読む</div>
          <a href="/seimei" class="page-card-btn btn-seimei">鑑定する →</a>
        </div>
        <div class="page-card pc-geimei">
          <div class="page-card-label">Geimei Shindan</div>
          <div class="page-card-title">🎭 芸名診断</div>
          <div class="page-card-desc">大喜利ゲームで芸風を判定！画数から大吉の芸名を3パターン提案</div>
          <a href="/geimei" class="page-card-btn btn-geimei">診断する →</a>
        </div>
      </div>

      <!-- 解説ガイド導線 -->
      <div class="guide-block">
        <p class="guide-block-label">ARTICLES · 占い解説ガイド</p>
        <p class="guide-block-title">📖 占いをもっと深く知りたい方へ</p>
        <p class="guide-block-desc">タロット・四柱推命・MBTIなど各占術の意味・歴史・活用方法をわかりやすく解説しています。</p>
        <div class="guide-block-links">
          <a href="/articles/tarot/" class="guide-link-tag">タロット占いとは</a>
          <a href="/articles/shichu/" class="guide-link-tag">四柱推命とは</a>
          <a href="/articles/mbti/" class="guide-link-tag">MBTIとは</a>
        </div>
        <a href="/articles/" class="guide-block-btn">すべての解説を見る →</a>
      </div>

      <!-- 結果（main-colの内側） -->
      <?php if ($result): ?>
      <script>document.addEventListener('DOMContentLoaded',function(){ if(typeof trackEvent==='function') trackEvent('fortune_result_view', {}); });</script>
      <section class="result-section" id="result">

    <div class="result-header">
      <div class="result-name"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?> さんの鑑定書</div>
      <div class="result-date"><?= (new DateTimeImmutable($birthday))->format('Y年n月j日生まれ') ?></div>
    </div>

    <!-- Step4-1: 結論ファースト（archetype → summary → scores → advice → 各占術の根拠） -->

    <!-- Result Hero：archetype（本質・不変） + summary（本質＋今日の流れ） -->
    <div class="result-hero">
      <span class="result-hero-eyebrow">✨ Integrated Reading · 三星統合鑑定</span>
      <h2><?= htmlspecialchars($result['sansei']['archetype']) ?></h2>
      <p class="result-hero-sub"><?= nl2br(htmlspecialchars($result['sansei']['summary'])) ?></p>
    </div>

    <!-- 4カテゴリスコア：SanseiResult.scores（3占術統合値） -->
    <div class="block block-scores">
      <div class="block-label">Today's Fortune</div>
      <div class="block-title"><span class="block-symbol">⭐</span>総合運スコア</div>
      <div class="scores">
        <div class="score-row"><span class="score-label">恋愛運</span><div class="stars"><?= stars($result['sansei']['scores']['love']) ?></div></div>
        <div class="score-row"><span class="score-label">仕事運</span><div class="stars"><?= stars($result['sansei']['scores']['work']) ?></div></div>
        <div class="score-row"><span class="score-label">金　運</span><div class="stars"><?= stars($result['sansei']['scores']['money']) ?></div></div>
        <div class="score-row"><span class="score-label">健康運</span><div class="stars"><?= stars($result['sansei']['scores']['health']) ?></div></div>
      </div>
    </div>

    <!-- AdSense枠 1 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- 開運アドバイス：TodayBundle由来（毎回変わり得る） -->
    <div class="block block-advice">
      <div class="block-label">Today's Advice</div>
      <div class="block-title"><span class="block-symbol">🔮</span>今日の開運アドバイス</div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['sansei']['advice'])) ?></div>
    </div>

    <!-- AdSense枠 2 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- ここから各占術の根拠（固定順：西洋占星術→タロット→四柱推命。影響度バッジ付き） -->

    <!-- 西洋占星術 -->
    <div class="block block-astro">
      <div class="block-label">Western Astrology · 根拠</div>
      <div class="block-title">
        <span class="block-symbol"><?= $result['zodiac']['symbol'] ?></span>
        <?= $result['zodiac']['name'] ?>
      </div>
      <div class="influence-row">影響度 <span class="stars"><?= stars($result['sansei']['influence']['seiza']) ?></span></div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['zodiacReading']['message'])) ?></div>
    </div>

    <!-- AdSense枠 3 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- タロット -->
    <div class="block block-tarot">
      <div class="block-label">Tarot Reading · 根拠</div>
      <div class="block-title">
        <span class="block-symbol"><?= $result['tarot']['symbol'] ?></span>
        <?= $result['tarot']['num'] ?>. <?= $result['tarot']['name'] ?>
        <span class="tarot-direction <?= $result['tarot']['upright'] ? 'upright' : 'reversed' ?>">
          <?= $result['tarot']['upright'] ? '正位置' : '逆位置' ?>
        </span>
      </div>
      <div class="influence-row">影響度 <span class="stars"><?= stars($result['sansei']['influence']['tarot']) ?></span></div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['tarot']['message'])) ?></div>
    </div>

    <!-- AdSense枠 4 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- 四柱推命 -->
    <div class="block block-sichu">
      <div class="block-label">四柱推命 · Shichū Suimei · 根拠</div>
      <div class="block-title">
        <span class="block-symbol">☯</span>
        日干「<?= $result['sichu']['dayStem'] ?>」── <?= $result['sichu']['element'] ?>の気
      </div>
      <div class="influence-row">影響度 <span class="stars"><?= stars($result['sansei']['influence']['shichu']) ?></span></div>
      <div class="pillar-badges">
        <span class="pillar-badge">年柱 <?= $result['sichu']['yearPillar'] ?></span>
        <span class="pillar-badge">日柱 <?= $result['sichu']['dayPillar'] ?></span>
      </div>
      <!-- Step3: shichuEngine()のextras（{type,label,value}形式）に置換 -->
      <div class="lucky-row">
        <?php foreach ($result['sichu']['extras'] as $extra): ?>
        <span class="lucky-item"><span><?= htmlspecialchars($extra['label']) ?></span><?= htmlspecialchars(sansei_formatExtraValue($extra['value'])) ?></span>
        <?php endforeach; ?>
      </div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['sichu']['message'])) ?></div>
    </div>

    <!-- もう一度 -->
    <div style="text-align:center;margin-top:2rem">
      <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" style="
        display:inline-block;padding:.75rem 2rem;
        border:1px solid var(--border2);border-radius:8px;
        color:var(--muted);font-family:var(--ff-mono);font-size:.78rem;
        letter-spacing:.1em;text-decoration:none;transition:color .2s,border-color .2s;
      " onmouseover="this.style.color='var(--violet-lt)';this.style.borderColor='var(--violet)'"
         onmouseout="this.style.color='var(--muted)';this.style.borderColor='var(--border2)'">
        ↩ もう一度鑑定する
      </a>
    </div>

  </section>
      <?php endif; ?>

    </div><!-- /.main-col -->

    <!-- 右：サイドバー（開運カレンダー） -->
    <div class="sidebar-col">
      <div class="cal-block">
        <div class="cal-block-head">
          <div class="cal-block-title">&#x2726; 今日の開運情報</div>
          <div class="cal-today-date"><?= $todayObj->format('Y年n月j日（') . $weekdayJa . '）' ?></div>
        </div>
        <div class="cal-body">
          <div class="rokuyo-badge <?= $calRokuyo['class'] ?>">
            <div class="rokuyo-name"><?= $calRokuyo['name'] ?></div>
            <div class="rokuyo-kana"><?= $calRokuyo['kana'] ?></div>
          </div>
          <div>
            <div class="rokuyo-desc"><?= $calRokuyo['desc'] ?></div>
            <div class="today-msg-line"><?= $luckyToday['msg'] ?></div>
          </div>
        </div>
        <div class="lucky-row">
          <div class="lucky-chip">
            <span class="lucky-chip-label">COLOR</span>
            <span class="lucky-chip-val"><?= $luckyToday['color'] ?></span>
          </div>
          <div class="lucky-chip">
            <span class="lucky-chip-label">NO.</span>
            <span class="lucky-number-badge"><?= $luckyToday['number'] ?></span>
          </div>
          <div class="lucky-chip">
            <span class="lucky-chip-label">FOOD</span>
            <span class="lucky-chip-val"><?= $luckyToday['food'] ?></span>
          </div>
          <div class="lucky-chip">
            <span class="lucky-chip-label">ITEM</span>
            <span class="lucky-chip-val"><?= $luckyToday['item'] ?></span>
          </div>
          <div class="lucky-chip">
            <span class="lucky-chip-label">ACTION</span>
            <span class="lucky-chip-val"><?= $luckyToday['action'] ?></span>
          </div>
        </div>
        <a href="/calendar.php" class="cal-more-link">詳しい開運カレンダーを見る &#8594;</a>
      </div>
    </div><!-- /.sidebar-col -->

  </div><!-- /.main-layout -->

<section class="about-box">

<h2>三星鑑定について</h2>

<div class="about-item">
    <span>✨</span>
    <p>
    占いPortalの「三星鑑定」は、西洋占星術・タロット・四柱推命を組み合わせた無料の統合鑑定サービスです。
    </p>
</div>

<div class="about-item">
    <span>🔮</span>
    <p>
    お名前（ニックネーム可）と生年月日を入力するだけで、簡単に鑑定結果をお楽しみいただけます。
    </p>
</div>

<div class="about-item">
    <span>🌙</span>
    <p>
    本サービスはエンターテインメントを目的とした占いコンテンツです。
    結果は楽しみや気づきの参考としてご活用ください。
    </p>
</div>

</section>
<?php require __DIR__.'/inc/form-error-scroll.php'; ?>
<?php require __DIR__.'/inc/footer.php'; ?>
</div>
<div id="loading-overlay">
  <div class="loader-box">
    <div class="crystal">🔮</div>
    <div class="loading-text">鑑定中…</div>
    <div class="loading-sub">星々からのメッセージを受信しています</div>
  </div>
</div>
<script>

const form = document.querySelector('form');

form.addEventListener('submit', function(){

    document.getElementById('loading-overlay').style.display = 'flex';

});

<?php if ($result): ?>

window.addEventListener('load', function(){

    setTimeout(function(){

        document.getElementById('result').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    }, 100);

});

<?php endif; ?>

</script>
<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});
</script>
</body>
</html>
