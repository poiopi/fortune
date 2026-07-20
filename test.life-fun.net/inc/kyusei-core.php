<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
// kyusei.php から抽出した純粋関数群（九星気学の計算ロジック本体）
//
// kyusei.php はページ単体として完結したHTML出力を行うファイルであり、
// そのままrequireすると不要なHTML出力やGETパラメータ処理が発生してしまう。
// そのため、DayInfoService（inc/dayinfo/providers/kyusei.php）から安全に
// 計算ロジックだけを再利用できるよう、この3関数をここへ切り出した。
//
// 各関数のロジック自体はkyusei.phpにあったものと完全に同一（一切変更していない）。
// kyusei.php側はこのファイルをrequire_onceして利用する。
// ══════════════════════════════════════════════════════════════════

function calcKyusei(int $y, int $m, int $d): int {
    if ($m === 1 || ($m === 2 && $d <= 3)) $y--;
    $sum = 0;
    foreach (str_split((string)$y) as $c) $sum += (int)$c;
    while ($sum > 9) {
        $s = 0;
        foreach (str_split((string)$sum) as $c) $s += (int)$c;
        $sum = $s;
    }
    $star = 11 - $sum;
    if ($star > 9) $star -= 9;
    if ($star === 0) $star = 9;
    return $star;
}

function calcMonthStar(int $y, int $m, int $d): int {
    if ($m === 1 || ($m === 2 && $d <= 3)) $y--;
    $yearStar = calcKyusei($y, 3, 1);
    $baseMap = [1=>8, 2=>5, 3=>2, 4=>8, 5=>5, 6=>2, 7=>8, 8=>5, 9=>2];
    $base = $baseMap[$yearStar];
    $monthOffset = ($m - 1 + 12) % 12;
    $star = $base - $monthOffset;
    while ($star <= 0) $star += 9;
    while ($star > 9) $star -= 9;
    return $star;
}

function getKyuseiData(int $star): array {
    $data = [
        1 => ['name'=>'一白水星','en'=>'Ippaku Suisei','element'=>'水','color'=>'ホワイト・ブラック','symbol'=>'💧','direction'=>'北','number'=>1,'planet'=>'水星','desc'=>'流れる水のように柔軟で適応力が高く、人の心を読む鋭い直感を持ちます。表面は穏やかですが、内に強い意志を秘めた行動力があります。','personality'=>'知的・感受性豊か・柔軟・忍耐強い・秘密を守る','lucky_color'=>'ホワイト・クリーム','lucky_dir'=>'北・北西','lucky_num'=>'1・6','fortune'=>'流れに逆らわず、直感を信じて進むことで道が開ける。人脈が重要な鍵となる時期。','caution'=>'感情の波に流されやすい面に注意。','job'=>'外交・貿易・水産業・流通・占い師'],
        2 => ['name'=>'二黒土星','en'=>'Jikoku Dosei','element'=>'土','color'=>'ブラック・イエロー','symbol'=>'🌍','direction'=>'南西','number'=>2,'planet'=>'土星','desc'=>'大地のように安定し、勤勉で忍耐強い性格。縁の下の力持ちとして周囲を支えることを得意とします。母性的な温かさと包容力を持ちます。','personality'=>'勤勉・忍耐・慎重・包容力・奉仕精神','lucky_color'=>'イエロー・ブラウン','lucky_dir'=>'南西・北東','lucky_num'=>'2・5・8','fortune'=>'地道な努力が実を結ぶ時期。焦らず着実に積み上げることで大きな成果が。','caution'=>'心配性になりすぎず、自分を信じて。','job'=>'農業・不動産・介護・教育・料理'],
        3 => ['name'=>'三碧木星','en'=>'Sanpeki Mokusei','element'=>'木','color'=>'グリーン','symbol'=>'🌿','direction'=>'東','number'=>3,'planet'=>'木星','desc'=>'新芽が芽吹くような躍動感と行動力を持ちます。好奇心旺盛で発想力豊か。直感的に動き、常に新しいことへの挑戦を楽しみます。','personality'=>'行動力・積極的・明朗・好奇心旺盛・直感的','lucky_color'=>'グリーン・ブルー','lucky_dir'=>'東・南東','lucky_num'=>'3・8','fortune'=>'新しい挑戦が吉。積極的に動くことで運気が開花する。','caution'=>'衝動的な言動に注意。冷静さを保って。','job'=>'音楽・放送・電気・IT・スポーツ'],
        4 => ['name'=>'四緑木星','en'=>'Shiryoku Mokusei','element'=>'木','color'=>'グリーン・ホワイト','symbol'=>'🌳','direction'=>'南東','number'=>4,'planet'=>'木星','desc'=>'風のように自由で社交的。コミュニケーション能力に長け、人と人をつなぐ橋渡し役を自然に担います。信頼と誠実さを大切にする温かい性格。','personality'=>'社交的・誠実・信頼・柔軟・協調性','lucky_color'=>'グリーン・ホワイト','lucky_dir'=>'南東・東','lucky_num'=>'4・9','fortune'=>'人との縁が幸運を運ぶ。信頼関係を大切にすることで道が広がる。','caution'=>'優柔不断にならないよう意識して。','job'=>'貿易・外交・旅行・流通・ブライダル'],
        5 => ['name'=>'五黄土星','en'=>'Goou Dosei','element'=>'土','color'=>'イエロー','symbol'=>'⭐','direction'=>'中央','number'=>5,'planet'=>'土星','desc'=>'九星の中心に位置する帝王星。強烈なカリスマ性と支配力を持ち、吉凶ともに大きく出る波乱万丈な星。困難を乗り越えるたびに強くなります。','personality'=>'カリスマ・強運・波乱・執念・再生力','lucky_color'=>'イエロー・ゴールド','lucky_dir'=>'北西・西','lucky_num'=>'5・0','fortune'=>'大きな変化の時期。覚悟を持って進めば、大きな成功が待っている。','caution'=>'独断専行に注意。周囲の意見も大切に。','job'=>'経営者・政治家・宗教家・医療・投資'],
        6 => ['name'=>'六白金星','en'=>'Roppaku Kinsei','element'=>'金','color'=>'ホワイト・ゴールド','symbol'=>'👑','direction'=>'北西','number'=>6,'planet'=>'金星','desc'=>'天の星のように高い理想と品格を持ちます。リーダーシップと決断力に優れ、周囲から自然と一目置かれる存在。完璧主義で責任感が強い。','personality'=>'高潔・リーダーシップ・決断力・完璧主義・誇り高い','lucky_color'=>'ホワイト・シルバー','lucky_dir'=>'北西・西','lucky_num'=>'6・1','fortune'=>'リーダーシップを発揮する好機。大きな決断が吉と出る時期。','caution'=>'プライドが高すぎると孤立することも。','job'=>'経営・金融・法律・軍事・航空'],
        7 => ['name'=>'七赤金星','en'=>'Shichiseki Kinsei','element'=>'金','color'=>'レッド・ゴールド','symbol'=>'✨','direction'=>'西','number'=>7,'planet'=>'金星','desc'=>'秋の実りを象徴する喜びと豊かさの星。社交的で話術に長け、場を明るくする天性の才能を持ちます。金運・恋愛運ともに強い。','personality'=>'社交的・話術・楽観的・享楽的・金運強い','lucky_color'=>'ゴールド・レッド','lucky_dir'=>'西・北西','lucky_num'=>'7・2','fortune'=>'金運・恋愛運ともに上昇中。楽しむことが運気アップの秘訣。','caution'=>'浪費・口のすべりに注意。','job'=>'芸能・飲食・金融・接客・美容'],
        8 => ['name'=>'八白土星','en'=>'Hakkaku Dosei','element'=>'土','color'=>'ホワイト・イエロー','symbol'=>'⛰️','direction'=>'北東','number'=>8,'planet'=>'土星','desc'=>'山のように堂々とした安定感と変革の力を持ちます。粘り強く努力し、逆境でも諦めない不屈の精神。時間をかけて大きな成果を生み出します。','personality'=>'堅実・粘り強い・変革・蓄財・不屈','lucky_color'=>'ホワイト・イエロー','lucky_dir'=>'北東・南西','lucky_num'=>'8・3','fortune'=>'変化と蓄積の時期。焦らず土台を固めることで大きな飛躍が訪れる。','caution'=>'頑固になりすぎず、変化を恐れないで。','job'=>'不動産・建築・保険・宗教・相続'],
        9 => ['name'=>'九紫火星','en'=>'Kyushi Kasei','element'=>'火','color'=>'パープル・レッド','symbol'=>'🔥','direction'=>'南','number'=>9,'planet'=>'火星','desc'=>'太陽のように輝く美と知性の星。鋭い直感と洗練されたセンスを持ち、芸術や文化の分野で才能を発揮します。名誉と社会的地位に縁があります。','personality'=>'知性・美的センス・直感・名誉・情熱','lucky_color'=>'パープル・レッド','lucky_dir'=>'南・東','lucky_num'=>'9・4','fortune'=>'才能が輝く時期。美しいもの・文化的なことへの投資が吉。','caution'=>'感情的になりやすい面に注意。冷静な判断を。','job'=>'芸術・美容・広告・医療・教育'],
    ];
    return $data[$star];
}
