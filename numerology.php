<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// 数秘術計算ロジック
// ══════════════════════════════════════════════════════════════════

// 数字を一桁（またはマスターナンバー11・22・33）になるまで足す
function reduceNumber(int $n): int {
    while ($n > 9 && $n !== 11 && $n !== 22 && $n !== 33) {
        $sum = 0;
        while ($n > 0) { $sum += $n % 10; $n = (int)($n / 10); }
        $n = $sum;
    }
    return $n;
}

// ライフパスナンバー（生年月日の合計）
function calcLifePath(int $y, int $m, int $d): int {
    $sum = 0;
    foreach (str_split((string)$y) as $c) $sum += (int)$c;
    foreach (str_split((string)$m) as $c) $sum += (int)$c;
    foreach (str_split((string)$d) as $c) $sum += (int)$c;
    return reduceNumber($sum);
}

// 誕生日ナンバー（日のみ）
function calcBirthdayNumber(int $d): int {
    return reduceNumber($d);
}

// 運命数（名前のアルファベット変換）
function calcDestinyNumber(string $name): int {
    $map = [
        'a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5,'f'=>6,'g'=>7,'h'=>8,'i'=>9,
        'j'=>1,'k'=>2,'l'=>3,'m'=>4,'n'=>5,'o'=>6,'p'=>7,'q'=>8,'r'=>9,
        's'=>1,'t'=>2,'u'=>3,'v'=>4,'w'=>5,'x'=>6,'y'=>7,'z'=>8,
        // ひらがな・カタカナも数値化（50音順に1〜9循環）
        'あ'=>1,'い'=>2,'う'=>3,'え'=>4,'お'=>5,
        'か'=>6,'き'=>7,'く'=>8,'け'=>9,'こ'=>1,
        'さ'=>2,'し'=>3,'す'=>4,'せ'=>5,'そ'=>6,
        'た'=>7,'ち'=>8,'つ'=>9,'て'=>1,'と'=>2,
        'な'=>3,'に'=>4,'ぬ'=>5,'ね'=>6,'の'=>7,
        'は'=>8,'ひ'=>9,'ふ'=>1,'へ'=>2,'ほ'=>3,
        'ま'=>4,'み'=>5,'む'=>6,'め'=>7,'も'=>8,
        'や'=>9,'ゆ'=>1,'よ'=>2,
        'ら'=>3,'り'=>4,'る'=>5,'れ'=>6,'ろ'=>7,
        'わ'=>8,'を'=>9,'ん'=>1,
        'ア'=>1,'イ'=>2,'ウ'=>3,'エ'=>4,'オ'=>5,
        'カ'=>6,'キ'=>7,'ク'=>8,'ケ'=>9,'コ'=>1,
        'サ'=>2,'シ'=>3,'ス'=>4,'セ'=>5,'ソ'=>6,
        'タ'=>7,'チ'=>8,'ツ'=>9,'テ'=>1,'ト'=>2,
        'ナ'=>3,'ニ'=>4,'ヌ'=>5,'ネ'=>6,'ノ'=>7,
        'ハ'=>8,'ヒ'=>9,'フ'=>1,'ヘ'=>2,'ホ'=>3,
        'マ'=>4,'ミ'=>5,'ム'=>6,'メ'=>7,'モ'=>8,
        'ヤ'=>9,'ユ'=>1,'ヨ'=>2,
        'ラ'=>3,'リ'=>4,'ル'=>5,'レ'=>6,'ロ'=>7,
        'ワ'=>8,'ヲ'=>9,'ン'=>1,
    ];
    $name = mb_strtolower($name, 'UTF-8');
    $chars = preg_split('//u', $name, -1, PREG_SPLIT_NO_EMPTY);
    $sum = 0;
    foreach ($chars as $c) {
        if (isset($map[$c])) $sum += $map[$c];
    }
    return $sum > 0 ? reduceNumber($sum) : 0;
}

// ソウルナンバー（母音のみ）
function calcSoulNumber(string $name): int {
    $vowels = ['a','e','i','o','u','あ','い','う','え','お','ア','イ','ウ','エ','オ'];
    $map = ['a'=>1,'e'=>5,'i'=>9,'o'=>6,'u'=>3,
            'あ'=>1,'い'=>2,'う'=>3,'え'=>4,'お'=>5,
            'ア'=>1,'イ'=>2,'ウ'=>3,'エ'=>4,'オ'=>5];
    $chars = preg_split('//u', mb_strtolower($name,'UTF-8'), -1, PREG_SPLIT_NO_EMPTY);
    $sum = 0;
    foreach ($chars as $c) {
        if (in_array($c, $vowels) && isset($map[$c])) $sum += $map[$c];
    }
    return $sum > 0 ? reduceNumber($sum) : 1;
}

// 数字データ
function getNumberData(int $n): array {
    $data = [
        1  => ['title'=>'開拓者','en'=>'The Leader','color'=>'スカーレットレッド','stone'=>'ルビー',
               'keyword'=>'独立・先駆・意志','planet'=>'太陽',
               'desc'=>'1はすべての数の始まり。強いリーダーシップと独立心を持ち、自らの道を切り開く開拓者です。創造性と意志の強さが際立ちます。',
               'love'=>'一途で情熱的。自分からアプローチするタイプ。','work'=>'起業家・リーダー・クリエイター向き。',
               'lucky'=>['色'=>'赤','日'=>'日曜日','数'=>'1・10・19']],
        2  => ['title'=>'調和者','en'=>'The Mediator','color'=>'シルバーホワイト','stone'=>'ムーンストーン',
               'keyword'=>'協調・感受性・直感','planet'=>'月',
               'desc'=>'2は二極のバランスを司る数。繊細な感受性と高い共感力を持ち、人と人をつなぐ架け橋となります。直感力に優れた平和の使者。',
               'love'=>'思いやり深く、相手を優先するタイプ。','work'=>'カウンセラー・外交官・アーティスト向き。',
               'lucky'=>['色'=>'シルバー','日'=>'月曜日','数'=>'2・11・20']],
        3  => ['title'=>'表現者','en'=>'The Communicator','color'=>'イエロー','stone'=>'シトリン',
               'keyword'=>'創造・表現・喜び','planet'=>'木星',
               'desc'=>'3は創造と表現の数。豊かな想像力と明るいエネルギーで周囲を魅了します。言葉・芸術・音楽など表現の世界で輝く才能の持ち主。',
               'love'=>'楽しい雰囲気を作るのが得意。恋愛も明るく積極的。','work'=>'アーティスト・作家・俳優・教師向き。',
               'lucky'=>['色'=>'黄色','日'=>'木曜日','数'=>'3・12・21']],
        4  => ['title'=>'建設者','en'=>'The Builder','color'=>'エメラルドグリーン','stone'=>'エメラルド',
               'keyword'=>'安定・勤勉・秩序','planet'=>'天王星',
               'desc'=>'4は安定と秩序の数。勤勉さと実直さで着実に物事を積み上げます。信頼できる実務家として、社会の基盤を作る力を持ちます。',
               'love'=>'誠実で安定志向。長期的な関係を大切にする。','work'=>'エンジニア・建築家・会計士・管理職向き。',
               'lucky'=>['色'=>'緑','日'=>'土曜日','数'=>'4・13・22']],
        5  => ['title'=>'冒険者','en'=>'The Explorer','color'=>'ターコイズ','stone'=>'ターコイズ',
               'keyword'=>'自由・変化・冒険','planet'=>'水星',
               'desc'=>'5は自由と変化の数。好奇心旺盛で変化を楽しみ、多様な経験を通じて成長します。枠にとらわれない自由な魂の冒険者。',
               'love'=>'刺激的な恋愛を求める。束縛が苦手。','work'=>'旅行・マーケティング・営業・フリーランス向き。',
               'lucky'=>['色'=>'ターコイズ','日'=>'水曜日','数'=>'5・14・23']],
        6  => ['title'=>'癒し人','en'=>'The Nurturer','color'=>'ローズピンク','stone'=>'ローズクォーツ',
               'keyword'=>'愛・調和・責任','planet'=>'金星',
               'desc'=>'6は愛と調和の数。思いやりと責任感を持ち、家族や周囲の人を温かく包みます。癒しのエネルギーで人々に安らぎをもたらします。',
               'love'=>'献身的で家庭的。パートナーをとことん大切にする。','work'=>'医療・福祉・教育・デザイン向き。',
               'lucky'=>['色'=>'ピンク','日'=>'金曜日','数'=>'6・15・24']],
        7  => ['title'=>'探求者','en'=>'The Seeker','color'=>'バイオレット','stone'=>'アメジスト',
               'keyword'=>'知恵・直感・神秘','planet'=>'海王星',
               'desc'=>'7は神秘と知恵の数。深い洞察力と分析力を持ち、物事の本質を追求します。内省と瞑想を通じて高次の真理に触れる精神の探求者。',
               'love'=>'深い精神的つながりを求める。打ち解けるまでに時間がかかる。','work'=>'研究者・哲学者・占い師・IT専門家向き。',
               'lucky'=>['色'=>'紫','日'=>'土曜日','数'=>'7・16・25']],
        8  => ['title'=>'達成者','en'=>'The Achiever','color'=>'ゴールド','stone'=>'タイガーアイ',
               'keyword'=>'豊かさ・権力・成功','planet'=>'土星',
               'desc'=>'8は物質的成功と豊かさの数。強い野心と実行力で大きな目標を達成します。ビジネスの世界で力を発揮する、成功を引き寄せる数です。',
               'love'=>'情熱的で一途。相手に多くを求めることも。','work'=>'経営者・投資家・政治家・管理職向き。',
               'lucky'=>['色'=>'ゴールド','日'=>'土曜日','数'=>'8・17・26']],
        9  => ['title'=>'完成者','en'=>'The Humanitarian','color'=>'クリムゾン','stone'=>'ガーネット',
               'keyword'=>'慈悲・完成・普遍','planet'=>'火星',
               'desc'=>'9はすべての数の完成形。広い視野と深い慈愛で人類全体の幸福を願います。過去の経験から得た知恵で、多くの人を導く博愛の象徴。',
               'love'=>'深く愛するが、時に理想が高すぎることも。','work'=>'慈善活動・芸術家・医療・スピリチュアル向き。',
               'lucky'=>['色'=>'深紅','日'=>'火曜日','数'=>'9・18・27']],
        11 => ['title'=>'啓示者','en'=>'The Visionary','color'=>'シルバー','stone'=>'ラブラドライト',
               'keyword'=>'直感・啓示・霊感','planet'=>'月・太陽',
               'desc'=>'11はマスターナンバー。高度な直感と霊的な洞察力を持つ特別な数です。人々を精神的に導く使命を持ち、インスピレーションの源となります。',
               'love'=>'深い精神的つながりを求める理想主義者。','work'=>'スピリチュアルリーダー・芸術家・発明家向き。',
               'lucky'=>['色'=>'シルバー','日'=>'月曜日','数'=>'11・29・38']],
        22 => ['title'=>'マスタービルダー','en'=>'The Master Builder','color'=>'クリームゴールド','stone'=>'ゴールデントパーズ',
               'keyword'=>'壮大な夢・実現力・奉仕','planet'=>'土星・天王星',
               'desc'=>'22はマスターナンバーの中で最も強力な数。大きな夢を現実に変える力を持ち、世界規模の変化をもたらす可能性を秘めています。',
               'love'=>'真剣な関係を求める。パートナーへの期待も大きい。','work'=>'建築家・政治家・大規模プロジェクトリーダー向き。',
               'lucky'=>['色'=>'クリームゴールド','日'=>'土曜日','数'=>'22・40・58']],
        33 => ['title'=>'マスターティーチャー','en'=>'The Master Teacher','color'=>'ゴールデンホワイト','stone'=>'ダイヤモンド',
               'keyword'=>'無条件の愛・癒し・奉仕','planet'=>'木星・金星',
               'desc'=>'33はすべてのマスターナンバーの頂点。無条件の愛と深い慈悲で世界を癒す使命を持ちます。人類の精神的な進化を促す最高の数です。',
               'love'=>'愛を与えることに喜びを感じる。見返りを求めない。','work'=>'精神的指導者・ヒーラー・教育者向き。',
               'lucky'=>['色'=>'白金','日'=>'木曜日','数'=>'33・51・69']],
    ];
    return $data[$n] ?? $data[1];
}

// フォーム処理
$result = null;
$errors = [];

if (isset($_GET['birthdate']) && $_GET['birthdate'] !== '') {
    $name     = trim($_GET['name'] ?? '');
    $birthdate = trim($_GET['birthdate'] ?? '');

    if (empty($name)) $errors[] = 'お名前を入力してください。';
    if (empty($birthdate)) $errors[] = '生年月日を入力してください。';

    if (empty($errors)) {
        $date = new DateTimeImmutable($birthdate);
        $y = (int)$date->format('Y');
        $m = (int)$date->format('n');
        $d = (int)$date->format('j');

        $lifePathNum    = calcLifePath($y, $m, $d);
        $birthdayNum    = calcBirthdayNumber($d);
        $destinyNum     = calcDestinyNumber($name);
        $soulNum        = calcSoulNumber($name);

        $result = [
            'name'     => $name,
            'birthdate'=> $date->format('Y年n月j日'),
            'numbers'  => [
                ['label'=>'ライフパスナンバー','en'=>'Life Path Number','num'=>$lifePathNum,'desc'=>'人生の目的と使命を示す最重要の数字。生年月日の合計から算出。'],
                ['label'=>'誕生日ナンバー',    'en'=>'Birthday Number',  'num'=>$birthdayNum,'desc'=>'生まれた日が示す、あなたが持って生まれた才能と特性。'],
                ['label'=>'運命数',            'en'=>'Destiny Number',   'num'=>$destinyNum, 'desc'=>'名前から算出される、あなたが人生で達成すべき使命の数字。'],
                ['label'=>'ソウルナンバー',    'en'=>'Soul Number',      'num'=>$soulNum,    'desc'=>'名前の母音から算出される、魂の奥底にある本当の欲求と動機。'],
            ],
            'main' => getNumberData($lifePathNum),
        ];
    }
}
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
<link rel="canonical" href="https://life-fun.net/numerology.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="生年月日と名前から4つの数秘術ナンバーを算出。ライフパス・誕生日・運命数・ソウルナンバーであなたの本質と使命を読み解きます。">
<title>数秘術診断｜生年月日と名前で読み解く人生の数字</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<!-- AdSense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #08060f;
  --card:    #1e1738;
  --card2:   #251d42;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.32);
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
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh;}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0;}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

/* ── HEADER ── */
header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px);}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}

/* ── HERO ── */
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.8rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

/* ── フォームカード ── */
.form-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:2rem;margin-bottom:2rem;position:relative;overflow:hidden;}
.form-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--teal),var(--violet),var(--gold));}
.form-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);margin-bottom:1.5rem}
.form-group{margin-bottom:1.25rem}
.form-label{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.12em;color:var(--muted);display:block;margin-bottom:.5rem}
.form-input{
  width:100%;background:rgba(155,114,239,.06);
  border:1px solid var(--border);border-radius:8px;
  padding:.75rem 1rem;font-family:var(--ff-sans);font-size:1rem;
  color:var(--text);outline:none;transition:border-color .2s;
}
.form-input:focus{border-color:var(--violet)}
.form-input::placeholder{color:var(--muted)}
.submit-btn{
  width:100%;
  background:linear-gradient(135deg,var(--violet),rgba(155,114,239,.7));
  border:none;border-radius:10px;padding:.85rem;
  font-family:var(--ff-serif);font-size:1rem;font-weight:600;
  color:#fff;cursor:pointer;letter-spacing:.06em;
  transition:opacity .2s;margin-top:.5rem;
}
.submit-btn:hover{opacity:.85}
.error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:8px;padding:.75rem 1rem;margin-bottom:1rem;font-size:.88rem;color:var(--rose)}

/* ── 結果 ── */
.result-hero{text-align:center;padding:1.5rem 0 1.25rem;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
.result-name-badge{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--teal);background:rgba(78,205,196,.1);border:1px solid rgba(78,205,196,.25);border-radius:20px;padding:.25rem .9rem;display:inline-block;margin-bottom:.75rem}
.result-main-num{font-family:var(--ff-serif);font-size:4rem;font-weight:700;color:var(--gold-lt);line-height:1;margin-bottom:.25rem}
.result-main-title{font-family:var(--ff-serif);font-size:1.3rem;color:var(--violet-lt);margin-bottom:.25rem}
.result-main-en{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.15em;color:var(--muted);margin-bottom:.75rem}
.result-main-desc{font-size:.9rem;color:var(--text);line-height:1.8;max-width:600px;margin:0 auto}

/* ── 4つの数字グリッド ── */
.numbers-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin-bottom:1.5rem}
.number-card{background:var(--card2);border:1px solid var(--border);border-radius:12px;padding:1.1rem;position:relative;overflow:hidden}
.number-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--violet),var(--gold))}
.number-card-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.12em;color:var(--muted);text-transform:uppercase;margin-bottom:.3rem}
.number-card-en{font-family:var(--ff-mono);font-size:.58rem;color:rgba(138,125,181,.6);margin-bottom:.5rem}
.number-card-num{font-family:var(--ff-serif);font-size:2.5rem;font-weight:700;color:var(--gold-lt);line-height:1;margin-bottom:.4rem}
.number-card-desc{font-size:.78rem;color:var(--muted);line-height:1.6}
.master-badge{display:inline-block;font-family:var(--ff-mono);font-size:.58rem;color:var(--rose);background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.25);border-radius:4px;padding:.1rem .4rem;margin-left:.4rem;vertical-align:middle}

/* ── 詳細情報 ── */
.detail-card{background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(155,114,239,.06));border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.25rem 1.5rem;margin-bottom:1.25rem}
.detail-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt);margin-bottom:1rem}
.detail-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem}
.detail-item{background:rgba(0,0,0,.2);border-radius:8px;padding:.75rem}
.detail-item-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.1em;color:var(--muted);margin-bottom:.3rem}
.detail-item-val{font-family:var(--ff-serif);font-size:.95rem;color:var(--text)}

.love-work-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:1.25rem}
.lw-card{background:var(--card2);border:1px solid var(--border);border-radius:12px;padding:1rem}
.lw-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.12em;color:var(--muted);margin-bottom:.4rem}
.lw-text{font-size:.85rem;color:var(--text);line-height:1.7}

.retry-btn{width:100%;font-family:var(--ff-mono);font-size:.72rem;letter-spacing:.1em;background:none;border:1px solid var(--border2);border-radius:8px;padding:.65rem;color:var(--muted);cursor:pointer;margin-top:.5rem;transition:color .2s,border-color .2s;text-decoration:none;display:block;text-align:center}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}
.article-link-box{display:flex;align-items:center;gap:.9rem;background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.article-link-box:hover{border-color:var(--violet-lt);background:rgba(155,114,239,.12)}
.article-link-icon{font-size:1.4rem;flex-shrink:0}
.article-link-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.article-link-body strong{font-family:var(--ff-sans);font-size:.9rem;font-weight:500;color:var(--violet-lt)}
.article-link-body small{font-size:.75rem;color:var(--muted)}
.article-link-arrow{color:var(--violet-lt);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}

/* ── AdSense ── */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
/* ── フッター ── */
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

/* ── スマホメニュー ── */
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s;}
  .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px);}
  .sp-dropdown.open{display:block}
  .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s;}
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
  .sp-dropdown span{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--text);border-bottom:1px solid var(--border);}
  .sp-dropdown span:last-child{border-bottom:none}
}

@media(max-width:600px){
  .numbers-grid{grid-template-columns:1fr}
  .detail-grid{grid-template-columns:1fr}
  .love-work-grid{grid-template-columns:1fr}
}
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
</style>
<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>

<?php $currentPage='numerology'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">Numerology</span>
    <h1>数秘術診断｜ライフパスナンバー・運命数を無料算出</h1>
    <p class="hero-sub">生年月日と名前から4つの数字を算出し、<br>あなたの人生の使命・才能・魂の欲求を読み解きます。</p>
  </section>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <?php if ($result === null): ?>

  <div class="form-card">
    <div class="form-title">あなたの情報を入力してください</div>

    <?php if (!empty($errors)): ?>
    <div class="error-box">
      <?php foreach ($errors as $e): ?><?= htmlspecialchars($e) ?><br><?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form method="get" action="">
      <div class="form-group">
        <label class="form-label" for="name">お名前（ひらがな・カタカナ・アルファベットで入力してください。漢字は使えません）</label>
        <input class="form-input" type="text" id="name" name="name" placeholder="例：やまだ はなこ" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label class="form-label" for="birthdate">生年月日</label>
        <input class="form-input" type="date" id="birthdate" name="birthdate" value="<?= htmlspecialchars($_GET['birthdate'] ?? '') ?>">
      </div>
      <button class="submit-btn" type="submit">数字を算出する ✦</button>
    </form>
  </div>

  <!-- 数秘術の説明 -->
  <div class="form-card">
    <div class="form-title">4つの数秘術ナンバーについて</div>
    <div style="display:grid;gap:.75rem">
      <?php
      $explains = [
        ['ライフパスナンバー','最も重要な数字。生年月日の合計から算出され、人生の目的と魂の使命を示します。'],
        ['誕生日ナンバー','生まれた「日」だけから算出。持って生まれた才能と特別なギフトを表します。'],
        ['運命数','名前の文字をすべて数値化して算出。人生で達成すべき使命と潜在能力を示します。'],
        ['ソウルナンバー','名前の母音のみから算出。魂の奥底にある本当の欲求と内なる動機を表します。'],
      ];
      foreach ($explains as $ex):
      ?>
      <div style="background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.9rem 1rem">
        <div style="font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.1em;color:var(--gold);margin-bottom:.3rem"><?= $ex[0] ?></div>
        <div style="font-size:.85rem;color:var(--muted);line-height:1.7"><?= $ex[1] ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php else: ?>

  <!-- 結果表示 -->
  <div class="form-card" id="resultSection">

    <div class="result-hero">
      <div class="result-name-badge"><?= htmlspecialchars($result['name']) ?> さん ／ <?= $result['birthdate'] ?></div>
      <div class="result-main-num">
        <?= $result['numbers'][0]['num'] ?>
        <?php if (in_array($result['numbers'][0]['num'], [11,22,33])): ?>
        <span class="master-badge">Master</span>
        <?php endif; ?>
      </div>
      <div class="result-main-title"><?= $result['main']['title'] ?></div>
      <div class="result-main-en"><?= $result['main']['en'] ?></div>
      <div class="result-main-desc"><?= $result['main']['desc'] ?></div>
    </div>

    <!-- 4つの数字 -->
<div class="numbers-grid">
      <?php foreach ($result['numbers'] as $num):
        $nd = getNumberData($num['num']);
      ?>
      <div class="number-card">
        <div class="number-card-label"><?= $num['label'] ?></div>
        <div class="number-card-en"><?= $num['en'] ?></div>
        <div class="number-card-num">
          <?= $num['num'] ?>
          <?php if (in_array($num['num'], [11,22,33])): ?><span class="master-badge">Master</span><?php endif; ?>
        </div>
        <div class="number-card-desc"><?= $num['desc'] ?></div>
        <div style="margin-top:.75rem;padding-top:.75rem;border-top:1px solid var(--border)">
          <div style="font-family:var(--ff-serif);font-size:.95rem;font-weight:600;color:var(--gold-lt);margin-bottom:.3rem"><?= $nd['title'] ?>（<?= $nd['en'] ?>）</div>
          <div style="font-size:.78rem;color:var(--text);line-height:1.7;margin-bottom:.4rem"><?= $nd['desc'] ?></div>
          <div style="font-size:.72rem;color:var(--muted)">キーワード：<?= $nd['keyword'] ?></div>
          <div style="font-size:.72rem;color:var(--muted)">恋愛：<?= $nd['love'] ?></div>
          <div style="font-size:.72rem;color:var(--muted)">仕事：<?= $nd['work'] ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- 詳細情報 -->
    <div class="detail-card">
      <div class="detail-title">ライフパスナンバー <?= $result['numbers'][0]['num'] ?> の詳細</div>
      <div class="detail-grid">
        <div class="detail-item">
          <div class="detail-item-label">キーワード</div>
          <div class="detail-item-val"><?= $result['main']['keyword'] ?></div>
        </div>
        <div class="detail-item">
          <div class="detail-item-label">守護星</div>
          <div class="detail-item-val"><?= $result['main']['planet'] ?></div>
        </div>
        <div class="detail-item">
          <div class="detail-item-label">ラッキーカラー</div>
          <div class="detail-item-val"><?= $result['main']['color'] ?></div>
        </div>
        <div class="detail-item">
          <div class="detail-item-label">パワーストーン</div>
          <div class="detail-item-val"><?= $result['main']['stone'] ?></div>
        </div>
        <div class="detail-item">
          <div class="detail-item-label">ラッキーカラー</div>
          <div class="detail-item-val"><?= $result['main']['lucky']['色'] ?></div>
        </div>
        <div class="detail-item">
          <div class="detail-item-label">ラッキーデイ</div>
          <div class="detail-item-val"><?= $result['main']['lucky']['日'] ?></div>
        </div>
      </div>
    </div>

    <div class="love-work-grid">
      <div class="lw-card">
        <div class="lw-label">恋愛傾向</div>
        <div class="lw-text"><?= $result['main']['love'] ?></div>
      </div>
      <div class="lw-card">
        <div class="lw-label">適職・仕事傾向</div>
        <div class="lw-text"><?= $result['main']['work'] ?></div>
      </div>
    </div>

    <?php require __DIR__.'/inc/share-btns.php'; ?>
    <a href="/numerology.php" class="retry-btn">もう一度診断する</a>
<a href="/articles/numerology/" class="article-link-box">
  <span class="article-link-icon">📖</span>
  <span class="article-link-body">
    <strong>数秘術とは？</strong>
    <small>運命数の計算方法と1〜9の意味を解説</small>
  </span>
  <span class="article-link-arrow">→</span>
</a>
    <script>document.addEventListener('DOMContentLoaded',function(){scrollToResult('resultSection');});</script>
    <div class="nav-cards-section" style="padding:2rem 0 0">
      <h3>✦ 次はこれを試してみては？ ✦</h3>
      <?php require_once __DIR__.'/inc/nav-cards.php'; echo _nav_cards(3,'numerology'); ?>
    </div>
  </div>

  <?php endif; ?>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

</div><!-- /.wrap -->

<p style="max-width:900px;margin:0 auto 1.5rem;padding:0 1.2rem;text-align:center;font-size:.72rem;color:var(--muted);line-height:1.8">本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。</p>

<?php require __DIR__.'/inc/footer.php'; ?>

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
