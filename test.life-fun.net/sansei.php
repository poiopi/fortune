<?php
declare(strict_types=1);

function getZodiac(int $month, int $day): array {
    $signs = [
        ['name'=>'山羊座','en'=>'Capricorn','symbol'=>'♑','period'=>'12/22〜1/19'],
        ['name'=>'水瓶座','en'=>'Aquarius', 'symbol'=>'♒','period'=>'1/20〜2/18'],
        ['name'=>'魚座',  'en'=>'Pisces',   'symbol'=>'♓','period'=>'2/19〜3/20'],
        ['name'=>'牡羊座','en'=>'Aries',    'symbol'=>'♈','period'=>'3/21〜4/19'],
        ['name'=>'牡牛座','en'=>'Taurus',   'symbol'=>'♉','period'=>'4/20〜5/20'],
        ['name'=>'双子座','en'=>'Gemini',   'symbol'=>'♊','period'=>'5/21〜6/21'],
        ['name'=>'蟹座',  'en'=>'Cancer',   'symbol'=>'♋','period'=>'6/22〜7/22'],
        ['name'=>'獅子座','en'=>'Leo',      'symbol'=>'♌','period'=>'7/23〜8/22'],
        ['name'=>'乙女座','en'=>'Virgo',    'symbol'=>'♍','period'=>'8/23〜9/22'],
        ['name'=>'天秤座','en'=>'Libra',    'symbol'=>'♎','period'=>'9/23〜10/23'],
        ['name'=>'蠍座',  'en'=>'Scorpio',  'symbol'=>'♏','period'=>'10/24〜11/21'],
        ['name'=>'射手座','en'=>'Sagittarius','symbol'=>'♐','period'=>'11/22〜12/21'],
    ];
    $dates = [19,18,20,19,20,21,22,22,22,23,21,21];
    $idx = ($day <= $dates[$month-1]) ? ($month - 1) : $month;
    if ($idx >= 12) $idx = 0;
    return $signs[$idx];
}

function getZodiacReading(string $signName): array {
    $readings = [
        '山羊座' => ['element'=>'土','planet'=>'土星','lucky'=>['色'=>'チャコールグレー','数'=>'8','石'=>'オニキス'],'today'=>['love'=>4,'work'=>5,'money'=>3,'health'=>4],'message'=>'土星の導きにより、今あなたの足元には確かな地盤が築かれています。コツコツと積み上げてきた努力が、静かに、しかし確実に実を結ぼうとしています。焦らず、自分のペースを守ることが吉。恋愛面では、言葉より行動で気持ちを示すことで相手の心が動くでしょう。','advice'=>'「継続は力なり」があなたの今の合言葉。小さな一歩を丁寧に踏み続けてください。'],
        '水瓶座' => ['element'=>'風','planet'=>'天王星','lucky'=>['色'=>'エレクトリックブルー','数'=>'11','石'=>'アメジスト'],'today'=>['love'=>3,'work'=>5,'money'=>4,'health'=>3],'message'=>'天王星の革新的なエネルギーがあなたの感性を研ぎ澄ませています。独自のアイデアや直感を大切に。周囲が「無理だ」と言うことでも、あなたの視点からは新しい道が見えているはずです。人間関係では、少し距離を置いた冷静な観察眼が良縁を引き寄せます。','advice'=>'枠にとらわれない発想こそ、今のあなたの最大の武器です。'],
        '魚座'   => ['element'=>'水','planet'=>'海王星','lucky'=>['色'=>'ラベンダー','数'=>'7','石'=>'アクアマリン'],'today'=>['love'=>5,'work'=>3,'money'=>3,'health'=>4],'message'=>'海王星の夢幻的なエネルギーに包まれ、あなたの感受性は今、最高潮に達しています。直感を信じてください。特に恋愛においては、言葉にならない「感じ」を大切にすることで、魂レベルでのつながりが育まれるでしょう。','advice'=>'今日は理屈より「感じる心」を優先することで扉が開きます。'],
        '牡羊座' => ['element'=>'火','planet'=>'火星','lucky'=>['色'=>'スカーレット','数'=>'9','石'=>'ルビー'],'today'=>['love'=>4,'work'=>5,'money'=>4,'health'=>5],'message'=>'火星の力強いエネルギーが全身を駆け巡っています。今こそ、ずっと温めてきた計画を実行に移す絶好の機会です。多少のリスクを恐れず、先頭に立って進む姿勢が周囲の信頼を集めるでしょう。','advice'=>'迷ったら動く。今のあなたの行動力は、星々が後押ししています。'],
        '牡牛座' => ['element'=>'土','planet'=>'金星','lucky'=>['色'=>'エメラルドグリーン','数'=>'6','石'=>'エメラルド'],'today'=>['love'=>5,'work'=>4,'money'=>5,'health'=>3],'message'=>'金星の恵みがあなたの周囲に美と豊かさをもたらしています。五感で楽しめることに積極的に触れることで、運気がさらに上昇。特に金運は好調で、長期的な視点での計画を立てるには絶好のタイミング。','advice'=>'自分を大切にすることが、最高の開運行動です。'],
        '双子座' => ['element'=>'風','planet'=>'水星','lucky'=>['色'=>'イエロー','数'=>'5','石'=>'シトリン'],'today'=>['love'=>3,'work'=>5,'money'=>3,'health'=>4],'message'=>'水星の知的なエネルギーがあなたのコミュニケーション能力を高めています。今日出会う人、交わす言葉、受け取る情報、すべてに大きな意味が宿っています。複数のことを同時進行させる今の状況は、双子座の本領発揮の時。','advice'=>'情報と人脈が、今のあなたの最大の財産です。'],
        '蟹座'   => ['element'=>'水','planet'=>'月','lucky'=>['色'=>'シルバー','数'=>'2','石'=>'ムーンストーン'],'today'=>['love'=>5,'work'=>3,'money'=>4,'health'=>4],'message'=>'月のやさしい光があなたの感情を穏やかに照らしています。家族や大切な人との時間を大切にすることで、心の深いところから活力が湧いてくるでしょう。直感が鋭くなっている今、第一印象を信じることが大切です。','advice'=>'「ホーム」を整えることが、すべての運気の土台になります。'],
        '獅子座' => ['element'=>'火','planet'=>'太陽','lucky'=>['色'=>'ゴールド','数'=>'1','石'=>'タイガーアイ'],'today'=>['love'=>4,'work'=>5,'money'=>4,'health'=>5],'message'=>'太陽の輝かしいエネルギーがあなたをスポットライトの中心へと導いています。自信を持って自分を表現することで、自然と人が集まり、チャンスが広がります。今のあなたのカリスマ性は最高潮。','advice'=>'堂々と輝くこと。それが今のあなたへの星からのメッセージです。'],
        '乙女座' => ['element'=>'土','planet'=>'水星','lucky'=>['色'=>'ネイビー','数'=>'3','石'=>'サファイア'],'today'=>['love'=>3,'work'=>5,'money'=>4,'health'=>5],'message'=>'水星の分析的なエネルギーと地の安定性が融合し、今のあなたの判断力は非常に冴えています。細部に宿る重要なサインを見逃さないでください。仕事面では、丁寧で几帳面なあなたの仕事ぶりが高く評価される時期。','advice'=>'「完璧を目指す心」が今のあなたを正しい方向へ導きます。'],
        '天秤座' => ['element'=>'風','planet'=>'金星','lucky'=>['色'=>'ローズピンク','数'=>'6','石'=>'ローズクォーツ'],'today'=>['love'=>5,'work'=>4,'money'=>3,'health'=>4],'message'=>'金星の調和のエネルギーが、あなたの周囲に美しいバランスをもたらしています。人間関係において公平で優雅な立ち振る舞いができる今、新たな縁が結ばれやすくなっています。','advice'=>'バランスと美を大切にすることが、今のあなたの開運の鍵です。'],
        '蠍座'   => ['element'=>'水','planet'=>'冥王星','lucky'=>['色'=>'ディープレッド','数'=>'0','石'=>'オブシディアン'],'today'=>['love'=>4,'work'=>4,'money'=>5,'health'=>3],'message'=>'冥王星の深淵なるエネルギーが、あなたの内なる変容を促しています。表面に見えるものだけでなく、その奥に潜む本質を見抜く力が今のあなたには備わっています。','advice'=>'変化を恐れず、深く潜ることで真の宝が見つかります。'],
        '射手座' => ['element'=>'火','planet'=>'木星','lucky'=>['色'=>'パープル','数'=>'9','石'=>'ターコイズ'],'today'=>['love'=>4,'work'=>4,'money'=>5,'health'=>4],'message'=>'木星の拡大のエネルギーがあなたの視野をどこまでも広げています。新しい学びや旅、異文化との出会いが大きな幸運の扉を開きます。楽観的な姿勢が最高の引き寄せになります。','advice'=>'矢は放たなければ的に当たりません。今こそ大きく狙って。'],
    ];
    return $readings[$signName] ?? $readings['山羊座'];
}

function getTarotReading(string $name, string $birthdate): array {
    $seed = crc32($name . $birthdate . date('Ymd'));
    $cards = [
        ['name'=>'愚者','num'=>'0','symbol'=>'🌟','upright_msg'=>'新しい旅の始まりを告げる「愚者」が現れました。計算より直感、準備より行動。純粋な心で一歩を踏み出した先に、想像を超えた景色が広がっています。恐れを手放し、今すぐ動いてください。','reversed_msg'=>'焦りや無謀さが足元を危うくしているかもしれません。飛び込む前に少しだけ立ち止まり、地に足をついた判断を取り戻しましょう。'],
        ['name'=>'魔術師','num'=>'I','symbol'=>'🔮','upright_msg'=>'あなたが必要な力はすでに揃っています。才能・知識・情熱——あとは強い意志で一点に集中するだけ。今の目標に向けてエネルギーを集めることで、現実が大きく動き始めます。','reversed_msg'=>'持っている才能を活かしきれていない状況です。まず一つに絞り、そこに全力を注ぐことで好転します。'],
        ['name'=>'女教皇','num'=>'II','symbol'=>'🌙','upright_msg'=>'答えはすでにあなたの内側にあります。外の世界より内なる声に耳を澄ませてください。今は行動より「感じること」を優先する時期です。','reversed_msg'=>'自分の直感を信じることをためらっていませんか？心の奥から聞こえる声に正直に向き合ってみてください。'],
        ['name'=>'女帝','num'=>'III','symbol'=>'🌺','upright_msg'=>'豊穣と愛情のエネルギーに満ちています。与えること、育てること、楽しむこと——この三つを大切にすることで人生はさらに花開きます。','reversed_msg'=>'誰かへの依存や自分を後回しにしすぎている状況が見受けられます。まず自分自身を大切にすることから始めてください。'],
        ['name'=>'皇帝','num'=>'IV','symbol'=>'⚡','upright_msg'=>'今こそ、自分の人生の主役として堂々と立つべき時です。ルールを設け秩序をもたらすことで周囲からの信頼が集まります。感情より論理、計画が吉。','reversed_msg'=>'コントロールへの執着が柔軟性を奪っているかもしれません。時には流れに身を委ねることも大切です。'],
        ['name'=>'法王','num'=>'V','symbol'=>'✨','upright_msg'=>'信頼できる師や先輩との縁が深まる時期です。伝統や慣習の中に重要なヒントが隠れています。学ぶ姿勢が精神的な成長をもたらします。','reversed_msg'=>'古いルールや既成概念があなたを縛っているかもしれません。本当に自分が信じることを改めて問い直してみましょう。'],
        ['name'=>'恋人','num'=>'VI','symbol'=>'💖','upright_msg'=>'心から「Yes」と言える選択が、今のあなたに問われています。魂レベルで「これだ」と感じる方向へ進んでください。','reversed_msg'=>'価値観のズレや選択への迷いを感じているかもしれません。自分の心が本当に求めるものに正直になってみてください。'],
        ['name'=>'戦車','num'=>'VII','symbol'=>'🏆','upright_msg'=>'強い意志と集中力で目標へと突き進む時です。障害はあなたを試すためにあります。前進あるのみ。','reversed_msg'=>'方向性が定まらずエネルギーが分散しているかもしれません。まず「どこへ向かいたいか」を明確にすることが先決です。'],
        ['name'=>'力','num'=>'VIII','symbol'=>'🦁','upright_msg'=>'真の力は激しさではなく優しさから生まれます。愛情を持って向き合うことでどんな困難も乗り越えられます。','reversed_msg'=>'自信を失いかけているかもしれませんが、それは一時的なものです。弱さを認める勇気こそが本当の強さへの第一歩です。'],
        ['name'=>'隠者','num'=>'IX','symbol'=>'🕯️','upright_msg'=>'今は立ち止まり、自分の内側を静かに照らすべき時です。一人の時間を大切にすることで深い洞察が得られます。','reversed_msg'=>'孤立が長すぎると視野が狭まることがあります。信頼できる人に心を開くことで新しい光が見えてくるでしょう。'],
        ['name'=>'運命の輪','num'=>'X','symbol'=>'⚙️','upright_msg'=>'運命の輪が回り、新たなサイクルの始まりを告げています。変化を恐れず乗りこなすことで幸運の波があなたを高みへと運びます。','reversed_msg'=>'変化への抵抗が停滞を生んでいるかもしれません。輪は必ず回ります。今の状況は永遠ではありません。'],
        ['name'=>'正義','num'=>'XI','symbol'=>'⚖️','upright_msg'=>'因果の法則が働いています。正直で公正な行動が今のあなたに最大の幸運をもたらします。','reversed_msg'=>'誰かに対して、あるいは自分自身に対して、不誠実になっていませんか？真実に向き合うことで停滞が動き始めます。'],
        ['name'=>'吊られた男','num'=>'XII','symbol'=>'🌊','upright_msg'=>'今は行動よりも待機の時。逆さまになることでまったく新しい視点が得られます。手放すことを恐れないでください。','reversed_msg'=>'無駄な我慢や変化への抵抗が状況を複雑にしているかもしれません。手放すべきものを手放すことで流れが変わります。'],
        ['name'=>'死神','num'=>'XIII','symbol'=>'🔄','upright_msg'=>'「死神」は終わりではなく変容と再生の象徴です。今感じる「終わり」は次の始まりへの扉。手放す勇気があなたの人生に新鮮な息吹をもたらします。','reversed_msg'=>'変化を恐れて終わるべきものにしがみついていませんか？手放すことへの恐れが新しい出発を遅らせています。'],
        ['name'=>'節制','num'=>'XIV','symbol'=>'🌈','upright_msg'=>'異なるものをうまく組み合わせることで奇跡が生まれます。今のあなたに必要なのはバランスと忍耐、そして癒しの時間です。','reversed_msg'=>'何かが行き過ぎていませんか？バランスが崩れているかもしれません。中庸を取り戻すことが今の課題です。'],
        ['name'=>'悪魔','num'=>'XV','symbol'=>'🗝️','upright_msg'=>'何かがあなたを縛っているように感じていませんか？しかしその鎖は自分でいつでも外せるものです。何があなたを縛っているのかを正直に見つめることが解放への第一歩です。','reversed_msg'=>'執着や恐れからの解放が近づいています。長い間あなたを縛っていたものからようやく自由になれるタイミングです。'],
        ['name'=>'塔','num'=>'XVI','symbol'=>'🌩️','upright_msg'=>'崩れるべきものが崩れ、本質だけが残ります。一見破壊的に見えるこの変化の中に必要だった「解放」が隠れています。変化を受け入れてください。','reversed_msg'=>'内側では大きな変化が起きているのに表面では現状維持しようとしているかもしれません。変化に正直に向き合う時です。'],
        ['name'=>'星','num'=>'XVII','symbol'=>'⭐','upright_msg'=>'あなたの前には確かな可能性の光が灯っています。傷ついた心が癒され夢を信じる力が戻ってきます。希望を手放さないでください。宇宙はあなたの味方です。','reversed_msg'=>'希望を見失いかけているかもしれませんが、星はまだそこにあります。小さな一歩から再び始めましょう。'],
        ['name'=>'月','num'=>'XVIII','symbol'=>'🌙','upright_msg'=>'今は物事がはっきり見えにくい時期かもしれませんが、それはあなたの感性が研ぎ澄まされているサインでもあります。夢や直感を大切にしてください。','reversed_msg'=>'霧が晴れ始め混乱していた状況が明確になってきます。恐れていたことが実は大したことではなかったと気づく時期です。'],
        ['name'=>'太陽','num'=>'XIX','symbol'=>'☀️','upright_msg'=>'大アルカナ最高の幸運カード「太陽」があなたのもとへ！喜びと成功、純粋な心で世界と向き合うことであらゆる願いが光の速さで実現に向かいます。','reversed_msg'=>'喜びや自信が内側に隠れてしまっているかもしれません。今のあなたのままで十分に輝く力があります。'],
        ['name'=>'審判','num'=>'XX','symbol'=>'🎺','upright_msg'=>'覚醒と再生の呼び声が聞こえています。過去を清算し真の使命に気づくタイミング。今こそ本当の自分として生きてください。','reversed_msg'=>'自己批判や後悔が前進を妨げているかもしれません。自分を許すことから始めましょう。'],
        ['name'=>'世界','num'=>'XXI','symbol'=>'🌍','upright_msg'=>'大アルカナの完成形「世界」があなたを祝福しています！一つのサイクルの完全なる達成と成就。次の大きな旅への扉を開いてください。','reversed_msg'=>'あと一歩のところで完成を先延ばしにしていませんか？「今のベスト」でゴールテープを切る勇気が必要です。'],
    ];
    $idx     = abs($seed) % count($cards);
    $upright = (intdiv(abs($seed), count($cards)) % 2) === 0;
    $card    = $cards[$idx];
    $card['upright'] = $upright;
    $card['message'] = $upright ? $card['upright_msg'] : $card['reversed_msg'];
    return $card;
}

function getSichu(string $birthdate): array {
    $date  = new DateTimeImmutable($birthdate);
    $year  = (int)$date->format('Y');
    $month = (int)$date->format('n');
    $day   = (int)$date->format('j');
    $stems    = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
    $branches = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
    $stemElem = ['甲'=>'木','乙'=>'木','丙'=>'火','丁'=>'火','戊'=>'土','己'=>'土','庚'=>'金','辛'=>'金','壬'=>'水','癸'=>'水'];
    $yearStemIdx   = ($year - 4)  % 10; if($yearStemIdx < 0) $yearStemIdx += 10;
    $yearBranchIdx = ($year - 4)  % 12; if($yearBranchIdx < 0) $yearBranchIdx += 12;
    $dayStemIdx    = (intval(($year*365.25 + $month*30.4 + $day + 10)) % 10);
    $dayBranchIdx  = (intval(($year*365.25 + $month*30.4 + $day + 10)) % 12);
    $yearStem   = $stems[$yearStemIdx];
    $yearBranch = $branches[$yearBranchIdx];
    $dayStem    = $stems[$dayStemIdx];
    $dayBranch  = $branches[$dayBranchIdx];
    $element    = $stemElem[$dayStem];
    $readings = [
        '木'=>['keyword'=>'成長・発展・柔軟','nature'=>'春の木のような生命力を持つあなた。根を張りながらも天へと伸びる柔軟さと粘り強さが特徴です。','message'=>'日干「'.$dayStem.'」を持つあなたは、木の気の持ち主。新しいことを始める才能と、人を育てる優しさが備わっています。焦らず、じっくりと根を張ることで、やがて大きな実りが得られます。','lucky'=>['方位'=>'東','色'=>'グリーン','季節'=>'春']],
        '火'=>['keyword'=>'情熱・輝き・変容','nature'=>'燃える炎のような情熱と輝きを持つあなた。周囲を温め、照らす存在です。','message'=>'日干「'.$dayStem.'」を持つあなたは、火の気の持ち主。行動力と情熱、そして人を惹きつけるカリスマ性が特徴です。感情豊かなあなたの表現力は、今最大の武器となります。','lucky'=>['方位'=>'南','色'=>'レッド','季節'=>'夏']],
        '土'=>['keyword'=>'安定・信頼・包容','nature'=>'大地のような包容力と安定感を持つあなた。すべてを受け入れ、育む力があります。','message'=>'日干「'.$dayStem.'」を持つあなたは、土の気の持ち主。信頼感と誠実さ、そして人を包み込む温かさが最大の魅力です。足元をしっかり固めることが運気向上の鍵。','lucky'=>['方位'=>'中央','色'=>'イエロー','季節'=>'土用']],
        '金'=>['keyword'=>'鋭敏・義理・変革','nature'=>'磨かれた金属のように、鋭い感性と強い意志を持つあなた。義理と筋を重んじます。','message'=>'日干「'.$dayStem.'」を持つあなたは、金の気の持ち主。鋭い判断力と揺るぎない意志、そして美的センスが特徴です。不要なものを整理することで新たな価値が生まれます。','lucky'=>['方位'=>'西','色'=>'ホワイト','季節'=>'秋']],
        '水'=>['keyword'=>'知恵・流動・深み','nature'=>'深い海のような知恵と、川のような流動性を持つあなた。本質を見抜く力があります。','message'=>'日干「'.$dayStem.'」を持つあなたは、水の気の持ち主。深い洞察力と柔軟な適応力、そして知的好奇心の旺盛さが特徴です。流れに逆らわず進めることでスムーズに目標へとたどり着けます。','lucky'=>['方位'=>'北','色'=>'ブラック','季節'=>'冬']],
    ];
    $reading = $readings[$element];
    return ['yearPillar'=>$yearStem.$yearBranch,'dayPillar'=>$dayStem.$dayBranch,'dayStem'=>$dayStem,'element'=>$element,'keyword'=>$reading['keyword'],'nature'=>$reading['nature'],'message'=>$reading['message'],'lucky'=>$reading['lucky']];
}

function buildIntegratedReading(string $name, array $zodiac, array $zodiacReading, array $tarot, array $sichu): string {
    $direction = $tarot['upright'] ? '正位置' : '逆位置';
    $themes = [
        '自分自身の力を信じ、新たな一歩を踏み出す時が来ている',
        '内なる知恵と宇宙の流れが、あなたを正しい方向へ導いている',
        '変化を恐れず受け入れることで、大きな恵みが訪れる',
        '今の努力は必ず実を結ぶ。焦らず、信じて進め',
        'あなたの持つ本来の輝きを、今こそ世界に解き放つとき',
    ];
    $themeIdx = crc32($name . date('Ymd')) % count($themes);
    $t = "{name}さん、三つの叡智があなたへのメッセージを届けています。\n\n{zodiac_symbol}【星の導き】{zodiac_symbol}\n{zodiac_name}を宿すあなたは、{planet}の加護のもと、{zodiac_advice}\n\n{tarot_symbol}【カードの啓示】{tarot_symbol}\n「{tarot_name}（{direction}）」が示す通り、今のあなたには{tarot_keyword}の力が宿っています。\n\n☯【命式が示す本質】☯\n{sichu_element}の気を持つあなたの本質は「{sichu_keyword}」。{sichu_nature}\n\n✨【統合された鑑定より】✨\n宇宙の三つの言語、西洋占星術・タロット・四柱推命が、今この瞬間に同じ方向を指しています。それは「{integrated_theme}」というメッセージです。\n\n今のあなたにとって最も大切なことは、自分の内なる声を信頼すること。星があなたを見守り、カードがあなたの力を証明し、命式があなたの本質を示しています。すべての鑑定が伝えるのは、あなたにはその道を歩む力が十分に備わっているということです。";
    return str_replace(
        ['{name}','{zodiac_symbol}','{zodiac_name}','{planet}','{zodiac_advice}','{tarot_symbol}','{tarot_name}','{direction}','{tarot_keyword}','{sichu_element}','{sichu_keyword}','{sichu_nature}','{integrated_theme}'],
        [$name,$zodiac['symbol'],$zodiac['name'],$zodiacReading['planet'],$zodiacReading['advice'],$tarot['symbol'],$tarot['name'],$direction,mb_substr($tarot['message'],0,30),$sichu['element'],$sichu['keyword'],$sichu['nature'],$themes[abs($themeIdx)]],
        $t
    );
}

function stars(int $n, int $max = 5): string {
    $out = '';
    for ($i = 1; $i <= $max; $i++)
        $out .= '<span class="star'.($i<=$n?' filled':'').'">★</span>';
    return $out;
}

$result = null; $errors = []; $name = ''; $birthday = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']     ?? '');
    $birthday = trim($_POST['birthday'] ?? '');
    if ($name === '')     $errors[] = 'お名前を入力してください。';
    if ($birthday === '') $errors[] = '生年月日を入力してください。';
    if ($birthday !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday))
        $errors[] = '生年月日の形式が正しくありません。';
    if (empty($errors)) {
        $bDate         = new DateTimeImmutable($birthday);
        $zodiac        = getZodiac((int)$bDate->format('n'), (int)$bDate->format('j'));
        $zodiacReading = getZodiacReading($zodiac['name']);
        $tarot         = getTarotReading($name, $birthday);
        $sichu         = getSichu($birthday);
        $integrated    = buildIntegratedReading($name, $zodiac, $zodiacReading, $tarot, $sichu);
        $result = compact('zodiac','zodiacReading','tarot','sichu','integrated');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/sansei" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="西洋占星術・タロット・四柱推命の3つの占術を組み合わせた三星統合鑑定。生年月日と名前を入力するだけで、あなたへの統合メッセージを無料でお届けします。">
<title>三星統合鑑定｜西洋占星術×タロット×四柱推命の統合鑑定</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#060410;--deep:#0a0818;--surface:#120f24;--card-bg:#1a1535;
  --border:rgba(160,130,220,.15);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8d48a;--gold-dk:#8b6914;
  --violet:#7a4a9e;--violet-lt:#b088e0;--rose:#c85080;--teal:#3ab8b0;
  --text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh;overflow-x:hidden}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0}
.wrap{position:relative;z-index:1;max-width:860px;margin:0 auto;padding:0 1rem}

/* ══ HEADER ══ */
.site-header{position:sticky;top:0;z-index:200;background:rgba(6,4,16,.94);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
.header-inner{max-width:960px;margin:0 auto;padding:0 1.4rem;display:flex;align-items:center;justify-content:space-between;height:56px;gap:1rem}
.logo{font-family:var(--ff-serif);font-size:1.05rem;font-weight:700;color:var(--text);text-decoration:none;display:flex;align-items:center;gap:.5rem;letter-spacing:.06em;white-space:nowrap}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;align-items:center;gap:1.6rem}
.header-nav a{font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);text-decoration:none;letter-spacing:.1em;white-space:nowrap;position:relative;padding-bottom:2px;transition:color .2s}
.header-nav a::after{content:'';position:absolute;bottom:0;left:0;right:0;height:1px;background:var(--gold);transform:scaleX(0);transition:transform .2s}
.header-nav a:hover{color:var(--gold-lt)}
.header-nav a:hover::after{transform:scaleX(1)}
.header-nav a.cur{color:var(--gold);pointer-events:none}
.header-nav a.cur::after{transform:scaleX(1)}
.header-gold-line{height:2px;background:linear-gradient(90deg,transparent 0%,rgba(201,168,76,.6) 30%,rgba(201,168,76,1) 50%,rgba(201,168,76,.6) 70%,transparent 100%)}
.sp-menu-btn{display:none;background:none;border:1px solid var(--border2);border-radius:6px;color:var(--muted);font-family:var(--ff-mono);font-size:.72rem;padding:.3rem .75rem;cursor:pointer;letter-spacing:.08em}
.sp-dropdown{display:none;position:fixed;top:58px;left:0;right:0;background:rgba(6,4,16,.97);border-bottom:1px solid var(--border2);z-index:199;backdrop-filter:blur(16px)}
.sp-dropdown.open{display:block}
.sp-dropdown a{display:block;padding:.85rem 1.4rem;font-family:var(--ff-mono);font-size:.78rem;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
.sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.05)}
@media(max-width:768px){.header-nav{display:none}.sp-menu-btn{display:flex;align-items:center;gap:.35rem}}

/* ══ HERO ══ */
.hero{text-align:center;padding:3rem 1rem 2.5rem;border-bottom:1px solid var(--border);margin-bottom:0;position:relative}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.28em;color:var(--gold);text-transform:uppercase;margin-bottom:.8rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.55rem,4.5vw,2.4rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--rose) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.6rem}
.hero-sub{color:var(--muted);font-size:.88rem;letter-spacing:.04em}

/* ══ 三角ビジュアル ══ */
.trinity-visual{display:flex;flex-direction:column;align-items:center;padding:2.5rem 1rem 2rem;gap:1.2rem}
.trinity-orbs{display:flex;justify-content:center;align-items:flex-end;gap:2.5rem;position:relative}
.trinity-orbs::before{
  content:'';position:absolute;
  left:50%;top:50%;
  width:200px;height:160px;
  transform:translate(-50%,-60%);
  background:
    linear-gradient(135deg,rgba(201,168,76,.08),rgba(122,74,158,.06));
  clip-path:polygon(50% 0%,100% 100%,0% 100%);
  pointer-events:none;
}
.t-orb{display:flex;flex-direction:column;align-items:center;gap:.5rem;position:relative;z-index:1}
.t-orb-circle{
  width:72px;height:72px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.6rem;
  position:relative;
}
.t-orb-circle::before{content:'';position:absolute;inset:-3px;border-radius:50%;z-index:-1;opacity:.5}
.t-orb-circle::after{content:'';position:absolute;inset:0;border-radius:50%;z-index:-1}
.orb-star .t-orb-circle{animation:floatA 4s ease-in-out infinite}
.orb-star .t-orb-circle::after{background:radial-gradient(circle,rgba(176,136,224,.25),transparent 70%);border:1px solid rgba(176,136,224,.4)}
.orb-tarot .t-orb-circle{animation:floatB 4.5s ease-in-out infinite}
.orb-tarot .t-orb-circle::after{background:radial-gradient(circle,rgba(201,168,76,.2),transparent 70%);border:1px solid rgba(201,168,76,.35)}
.orb-sichu .t-orb-circle{animation:floatC 3.8s ease-in-out infinite}
.orb-sichu .t-orb-circle::after{background:radial-gradient(circle,rgba(58,184,176,.2),transparent 70%);border:1px solid rgba(58,184,176,.35)}
.t-orb-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.12em;color:var(--muted)}
.t-orb-en{font-family:var(--ff-mono);font-size:.5rem;letter-spacing:.08em;color:rgba(138,125,181,.5)}

@keyframes floatA{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes floatB{0%,100%{transform:translateY(-4px)}50%{transform:translateY(4px)}}
@keyframes floatC{0%,100%{transform:translateY(-2px)}50%{transform:translateY(-10px)}}

.trinity-connector{display:flex;align-items:center;gap:.6rem;font-family:var(--ff-mono);font-size:.6rem;color:rgba(138,125,181,.4);letter-spacing:.1em}
.trinity-connector span{flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(201,168,76,.25),transparent)}

/* ══ フォームセクション ══ */
.form-section{padding:0 0 2rem}
.form-card{
  background:linear-gradient(160deg,rgba(30,21,60,.95),rgba(10,8,24,.98));
  border:1px solid rgba(201,168,76,.25);
  border-radius:20px;
  padding:2.2rem;
  box-shadow:0 0 60px rgba(122,74,158,.12),0 20px 60px rgba(0,0,0,.5);
  position:relative;overflow:hidden;
}
.form-card::before{content:'';position:absolute;top:-1px;left:10%;right:10%;height:1px;background:linear-gradient(90deg,transparent,rgba(201,168,76,.6),transparent)}
.form-card::after{content:'';position:absolute;bottom:-1px;left:10%;right:10%;height:1px;background:linear-gradient(90deg,transparent,rgba(201,168,76,.3),transparent)}
.form-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--gold-lt);text-align:center;letter-spacing:.14em;margin-bottom:1.8rem}
.form-title small{display:block;font-family:var(--ff-mono);font-size:.58rem;font-weight:400;color:var(--muted);letter-spacing:.2em;margin-top:.3rem}
.field{margin-bottom:1.3rem}
.field label{display:block;font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.14em;color:var(--muted);margin-bottom:.5rem}
.field input{width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(201,168,76,.2);border-radius:8px;padding:.8rem 1rem;color:var(--text);font-size:1rem;font-family:var(--ff-sans);outline:none;transition:border-color .2s,box-shadow .2s;-webkit-appearance:none}
.field input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12)}
.btn-submit{
  width:100%;padding:1rem;
  background:linear-gradient(135deg,rgba(201,168,76,.9),rgba(139,105,20,.9));
  color:#0a0818;
  border:none;border-radius:10px;
  font-family:var(--ff-serif);font-size:1rem;font-weight:700;
  letter-spacing:.18em;cursor:pointer;
  transition:opacity .2s,transform .15s,box-shadow .2s;
  margin-top:.5rem;
  box-shadow:0 4px 24px rgba(201,168,76,.25);
}
.btn-submit:hover{opacity:.92;transform:translateY(-2px);box-shadow:0 8px 32px rgba(201,168,76,.35)}
.error-list{background:rgba(200,80,128,.1);border:1px solid rgba(200,80,128,.3);border-radius:8px;padding:.8rem 1rem;margin-bottom:1rem;list-style:none}
.error-list li{font-size:.85rem;color:var(--rose)}

/* ══ AdSense ══ */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}

/* ══ 結果ヘッダー ══ */
.result-header{
  text-align:center;
  padding:2.5rem 1rem;
  position:relative;
  margin-bottom:2rem;
}
.result-header::before,.result-header::after{
  content:'';display:block;
  height:1px;
  background:linear-gradient(90deg,transparent,rgba(201,168,76,.4),transparent);
  margin:1.2rem 0;
}
.result-seal{
  width:64px;height:64px;border-radius:50%;
  background:linear-gradient(135deg,rgba(201,168,76,.15),rgba(122,74,158,.1));
  border:1px solid rgba(201,168,76,.3);
  display:flex;align-items:center;justify-content:center;
  font-size:1.6rem;margin:0 auto .8rem;
  box-shadow:0 0 24px rgba(201,168,76,.15);
}
.result-name{font-family:var(--ff-serif);font-size:1.5rem;font-weight:700;color:var(--gold-lt);letter-spacing:.1em;margin-bottom:.25rem}
.result-date{font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);letter-spacing:.12em}

/* ══ 結果ブロック共通 ══ */
.result-block{
  border-radius:16px;
  padding:0;
  margin-bottom:1.6rem;
  position:relative;
  overflow:hidden;
  opacity:0;
  transform:translateY(24px);
  transition:opacity .7s ease, transform .7s ease;
}
.result-block.visible{opacity:1;transform:translateY(0)}
.block-inner{padding:1.8rem}

/* 各ブロックの外枠カラー */
.block-astro{background:linear-gradient(160deg,rgba(122,74,158,.12),rgba(26,21,53,.98));border:1px solid rgba(176,136,224,.25)}
.block-tarot{background:linear-gradient(160deg,rgba(201,168,76,.08),rgba(26,21,53,.98));border:1px solid rgba(201,168,76,.22)}
.block-sichu{background:linear-gradient(160deg,rgba(58,184,176,.1),rgba(26,21,53,.98));border:1px solid rgba(58,184,176,.22)}
.block-integrated{background:linear-gradient(160deg,rgba(201,168,76,.06),rgba(122,74,158,.08),rgba(26,21,53,.98));border:1px solid rgba(201,168,76,.3)}

/* 各ブロック上部ライン */
.block-astro::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--violet),var(--violet-lt),var(--rose))}
.block-tarot::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold-dk),var(--gold),var(--gold-lt))}
.block-sichu::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--teal),rgba(58,184,176,.4),var(--teal))}
.block-integrated::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--rose))}

/* 背景シンボル */
.block-bg-symbol{
  position:absolute;right:1rem;top:50%;transform:translateY(-50%);
  font-size:5rem;opacity:.04;line-height:1;pointer-events:none;
  user-select:none;
}

.block-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.22em;text-transform:uppercase;color:var(--muted);margin-bottom:.6rem}
.block-title{font-family:var(--ff-serif);font-size:1.2rem;font-weight:700;color:var(--gold-lt);letter-spacing:.06em;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;flex-wrap:wrap}
.block-symbol{font-size:1.3rem}
.tarot-direction{font-family:var(--ff-mono);font-size:.62rem;padding:.18rem .7rem;border-radius:4px;letter-spacing:.06em}
.upright{background:rgba(58,184,176,.15);color:var(--teal);border:1px solid rgba(58,184,176,.3)}
.reversed{background:rgba(200,80,128,.15);color:var(--rose);border:1px solid rgba(200,80,128,.3)}

.scores{display:grid;grid-template-columns:repeat(2,1fr);gap:.7rem 1rem;margin-bottom:1rem}
.score-row{display:flex;align-items:center;gap:.6rem;font-size:.82rem}
.score-label{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);letter-spacing:.06em;width:3.2em;flex-shrink:0}
.stars{display:flex;gap:2px}
.star{color:rgba(160,130,220,.18);font-size:.85rem}
.star.filled{color:var(--gold)}

.lucky-row{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1rem}
.lucky-item{font-size:.72rem;background:rgba(122,74,158,.1);border:1px solid rgba(122,74,158,.2);border-radius:6px;padding:.2rem .65rem;color:var(--violet-lt)}
.lucky-item span{color:var(--muted);margin-right:.3rem;font-family:var(--ff-mono);font-size:.58rem}
.pillar-badges{display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1rem}
.pillar-badge{font-family:var(--ff-mono);font-size:.68rem;background:rgba(58,184,176,.1);border:1px solid rgba(58,184,176,.2);border-radius:6px;padding:.2rem .65rem;color:var(--teal)}
.block-message{font-size:.92rem;line-height:2.1;color:rgba(232,226,245,.88);border-top:1px solid var(--border);padding-top:1rem;margin-top:.5rem}

/* ══ 統合鑑定 特別レイアウト ══ */
.integrated-scroll{
  position:relative;
  background:rgba(0,0,0,.15);
  border:1px solid rgba(201,168,76,.15);
  border-radius:10px;
  padding:1.5rem 1.6rem;
  margin-top:.5rem;
}
.integrated-scroll::before,.integrated-scroll::after{
  content:'✦  ✦  ✦';
  display:block;text-align:center;
  font-family:var(--ff-mono);font-size:.62rem;
  color:rgba(201,168,76,.35);letter-spacing:.3em;
  margin:.2rem 0 .8rem;
}
.integrated-scroll::after{margin:.8rem 0 .2rem}
.integrated-text{font-size:.92rem;line-height:2.2;color:rgba(232,226,245,.88);white-space:pre-wrap}

/* ══ もう一度ボタン ══ */
.retry-btn{display:block;text-align:center;margin:2.5rem auto;padding:.85rem 2.5rem;border:1px solid rgba(201,168,76,.3);border-radius:30px;color:var(--gold);font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.14em;text-decoration:none;transition:color .2s,border-color .2s,background .2s;width:fit-content}
.retry-btn:hover{color:var(--gold-lt);border-color:var(--gold);background:rgba(201,168,76,.06)}

/* ══ 他ページへ ══ */
.nav-section{padding:2rem 0 0;border-top:1px solid var(--border);margin-top:1rem}
.nav-section h3{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;margin-bottom:1rem;text-align:center}
.nav-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem}
@media(max-width:480px){.nav-grid{grid-template-columns:1fr}}
.nav-card{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1rem 1.1rem;text-decoration:none;display:flex;flex-direction:column;gap:.2rem;transition:border-color .2s,background .2s}
.nav-card:hover{border-color:var(--border2);background:rgba(160,130,220,.06)}
.nav-card-title{font-family:var(--ff-sans);font-size:.88rem;font-weight:500;color:var(--text)}
.nav-card-desc{font-size:.74rem;color:var(--muted);line-height:1.6}

#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(6,4,16,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:3rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
</style>
</head>
<body>

<!-- HEADER -->
<header class="site-header">
  <div class="header-inner">
    <a href="/" class="logo">⛩ 占い<em>Portal</em></a>
    <nav class="header-nav">
      <a href="/">✦ TOP</a>
      <a href="/sansei" class="cur">✨ 三星鑑定</a>
      <a href="/tarot">🃏 タロット</a>
      <a href="/shichu">🔯 四柱推命</a>
      <a href="/seiza">⭐ 星座</a>
    </nav>
    <div id="google_translate_element"></div>
    <button class="sp-menu-btn" onclick="toggleSpMenu()">☰ メニュー</button>
  </div>
  <div class="header-gold-line"></div>
</header>

<div class="sp-dropdown" id="spDropdown">
  <a href="/">✦ トップ</a>
  <a href="/sansei">✨ 三星統合鑑定</a>
  <a href="/tarot">🃏 タロット占い</a>
  <a href="/shichu">🔯 四柱推命</a>
  <a href="/sanmei">☯ 算命学</a>
  <a href="/seiza">⭐ 西洋占星術</a>
  <a href="/mbti">🧠 MBTI×星座</a>
  <a href="/numerology">🔢 数秘術</a>
  <a href="/kyusei">⭐ 九星気学</a>
  <a href="/rpg">⚔️ RPG占い</a>
  <a href="/aisho">💑 相性診断</a>
  <a href="/zense">🌀 前世診断</a>
  <a href="/guardian">👻 守護霊診断</a>
  <a href="/seimei">✍️ 姓名判断</a>
  <a href="/geimei">🎭 芸名診断</a>
</div>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">Integrated Fortune Reading</span>
    <h1>三星統合鑑定</h1>
    <p class="hero-sub">西洋占星術・タロット・四柱推命 ── 三つの叡智が同じ方向を指すとき、そこに真実がある</p>
  </section>

  <!-- 三角ビジュアル -->
  <div class="trinity-visual">
    <div class="trinity-orbs">
      <div class="t-orb orb-star">
        <div class="t-orb-circle">♈</div>
        <div class="t-orb-label">西洋占星術</div>
        <div class="t-orb-en">Astrology</div>
      </div>
      <div class="t-orb orb-tarot" style="margin-bottom:2rem">
        <div class="t-orb-circle">🃏</div>
        <div class="t-orb-label">タロット</div>
        <div class="t-orb-en">Tarot</div>
      </div>
      <div class="t-orb orb-sichu">
        <div class="t-orb-circle">☯</div>
        <div class="t-orb-label">四柱推命</div>
        <div class="t-orb-en">Shichū</div>
      </div>
    </div>
    <div class="trinity-connector">
      <span></span>三つの叡智が統合される<span></span>
    </div>
  </div>

  <div class="adsense-space"></div>

  <!-- フォーム -->
  <div class="form-section">
    <div class="form-card">
      <div class="form-title">
        ✦ 鑑定情報を入力 ✦
        <small>YOUR INFORMATION</small>
      </div>
      <?php if (!empty($errors)): ?>
      <ul class="error-list">
        <?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <form method="post" action="">
        <div class="field">
          <label for="name">お名前（ニックネーム可）</label>
          <input type="text" id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" placeholder="例：さくら" required>
        </div>
        <div class="field">
          <label for="birthday">生年月日</label>
          <input type="date" id="birthday" name="birthday" value="<?= htmlspecialchars($birthday) ?>" min="1920-01-01" max="<?= date('Y-m-d') ?>" required>
        </div>
        <button type="submit" class="btn-submit">✦ 三星鑑定を開始する ✦</button>
      </form>
    </div>
  </div>

  <!-- 結果 -->
  <?php if ($result): ?>
  <section id="result">

    <div class="result-header">
      <div class="result-seal">✨</div>
      <div class="result-name"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?> さんの鑑定書</div>
      <div class="result-date"><?= (new DateTimeImmutable($birthday))->format('Y年n月j日生まれ') ?></div>
    </div>

    <!-- 西洋占星術 -->
    <div class="result-block block-astro" data-delay="0">
      <div class="block-bg-symbol"><?= $result['zodiac']['symbol'] ?></div>
      <div class="block-inner">
        <div class="block-label">Western Astrology · 第一の叡智</div>
        <div class="block-title">
          <span class="block-symbol"><?= $result['zodiac']['symbol'] ?></span>
          <?= $result['zodiac']['name'] ?> ── <?= $result['zodiacReading']['planet'] ?>
        </div>
        <div class="scores">
          <div class="score-row"><span class="score-label">恋愛運</span><div class="stars"><?= stars($result['zodiacReading']['today']['love']) ?></div></div>
          <div class="score-row"><span class="score-label">仕事運</span><div class="stars"><?= stars($result['zodiacReading']['today']['work']) ?></div></div>
          <div class="score-row"><span class="score-label">金　運</span><div class="stars"><?= stars($result['zodiacReading']['today']['money']) ?></div></div>
          <div class="score-row"><span class="score-label">健康運</span><div class="stars"><?= stars($result['zodiacReading']['today']['health']) ?></div></div>
        </div>
        <div class="lucky-row">
          <?php foreach($result['zodiacReading']['lucky'] as $k => $v): ?>
          <span class="lucky-item"><span><?= $k ?></span><?= $v ?></span>
          <?php endforeach; ?>
        </div>
        <div class="block-message"><?= nl2br(htmlspecialchars($result['zodiacReading']['message'])) ?></div>
      </div>
    </div>

    <div class="adsense-space"></div>

    <!-- タロット -->
    <div class="result-block block-tarot" data-delay="150">
      <div class="block-bg-symbol">🃏</div>
      <div class="block-inner">
        <div class="block-label">Tarot Reading · 第二の叡智</div>
        <div class="block-title">
          <span class="block-symbol"><?= $result['tarot']['symbol'] ?></span>
          <?= $result['tarot']['num'] ?>. <?= $result['tarot']['name'] ?>
          <span class="tarot-direction <?= $result['tarot']['upright'] ? 'upright' : 'reversed' ?>">
            <?= $result['tarot']['upright'] ? '正位置' : '逆位置' ?>
          </span>
        </div>
        <div class="block-message"><?= nl2br(htmlspecialchars($result['tarot']['message'])) ?></div>
      </div>
    </div>

    <div class="adsense-space"></div>

    <!-- 四柱推命 -->
    <div class="result-block block-sichu" data-delay="300">
      <div class="block-bg-symbol">☯</div>
      <div class="block-inner">
        <div class="block-label">四柱推命 · 第三の叡智</div>
        <div class="block-title">
          <span class="block-symbol">☯</span>
          日干「<?= $result['sichu']['dayStem'] ?>」── <?= $result['sichu']['element'] ?>の気
        </div>
        <div class="pillar-badges">
          <span class="pillar-badge">年柱 <?= $result['sichu']['yearPillar'] ?></span>
          <span class="pillar-badge">日柱 <?= $result['sichu']['dayPillar'] ?></span>
          <span class="pillar-badge">キーワード：<?= $result['sichu']['keyword'] ?></span>
        </div>
        <div class="lucky-row">
          <?php foreach($result['sichu']['lucky'] as $k => $v): ?>
          <span class="lucky-item"><span><?= $k ?></span><?= $v ?></span>
          <?php endforeach; ?>
        </div>
        <div class="block-message"><?= nl2br(htmlspecialchars($result['sichu']['message'])) ?></div>
      </div>
    </div>

    <div class="adsense-space"></div>

    <!-- 統合鑑定 -->
    <div class="result-block block-integrated" data-delay="500">
      <div class="block-bg-symbol">✨</div>
      <div class="block-inner">
        <div class="block-label">Integrated Reading · 三星統合鑑定書</div>
        <div class="block-title">
          <span class="block-symbol">✨</span>三つの叡智からの統合メッセージ
        </div>
        <div class="integrated-scroll">
          <div class="integrated-text"><?= htmlspecialchars($result['integrated']) ?></div>
        </div>
      </div>
    </div>

    <a href="/sansei" class="retry-btn">↩ もう一度鑑定する</a>

  </section>
  <?php endif; ?>

  <!-- 他のページへ -->
  <div class="nav-section">
    <h3>✦ 他の占いも試してみる ✦</h3>
    <div class="nav-grid">
      <a href="/tarot" class="nav-card"><span class="nav-card-title">🃏 本格タロット占い</span><span class="nav-card-desc">22枚の大アルカナから1枚選ぶ直感型タロット</span></a>
      <a href="/shichu" class="nav-card"><span class="nav-card-title">🔯 四柱推命</span><span class="nav-card-desc">命式・十神・大運を本格算出する</span></a>
      <a href="/seiza" class="nav-card"><span class="nav-card-title">⭐ 西洋占星術</span><span class="nav-card-desc">太陽星座から個性・恋愛・仕事適性を鑑定</span></a>
      <a href="/numerology" class="nav-card"><span class="nav-card-title">🔢 数秘術</span><span class="nav-card-desc">生年月日と名前から人生の使命を読み解く</span></a>
      <a href="/kyusei" class="nav-card"><span class="nav-card-title">⭐ 九星気学</span><span class="nav-card-desc">生まれ年の九星から運勢・相性・吉方位を鑑定</span></a>
      <a href="/aisho" class="nav-card"><span class="nav-card-title">💑 相性診断</span><span class="nav-card-desc">星座と数秘術で恋愛・結婚の相性を鑑定</span></a>
    </div>
  </div>

</div>

<footer>
  <p style="margin-bottom:.5rem">
    <a href="/privacy">プライバシーポリシー</a>&ensp;|&ensp;
    <a href="/disclaimer">免責事項</a>&ensp;|&ensp;
    <a href="/contact">お問い合わせ</a>
  </p>
  <p>&copy; <?= date('Y') ?> 占いPortal</p>
</footer>

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

// 結果ブロックを時差でフェードイン
<?php if($result): ?>
document.addEventListener('DOMContentLoaded', function(){
  document.getElementById('result').scrollIntoView({behavior:'smooth', block:'start'});

  const blocks = document.querySelectorAll('.result-block[data-delay]');
  blocks.forEach(function(block){
    const delay = parseInt(block.dataset.delay) || 0;
    setTimeout(function(){
      block.classList.add('visible');
    }, 300 + delay);
  });
});
<?php else: ?>
// スクロールで出現（フォームページ）
const observer = new IntersectionObserver(function(entries){
  entries.forEach(function(e){
    if(e.isIntersecting) e.target.classList.add('visible');
  });
},{threshold:0.1});
document.querySelectorAll('.result-block').forEach(function(el){observer.observe(el)});
<?php endif; ?>
</script>
</body>
</html>
