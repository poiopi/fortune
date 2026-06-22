<?php
declare(strict_types=1);

// /index.php へのアクセスを / にリダイレクト
if (isset($_SERVER['REQUEST_URI']) && preg_match('#^/index\.php#', $_SERVER['REQUEST_URI'])) {
    $query = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: /' . ($query ? '?' . $query : ''), true, 301);
    exit;
}

// ══════════════════════════════════════════════════════════════════
// 占いロジック
// ══════════════════════════════════════════════════════════════════

function getZodiac(int $month, int $day): array {
    $signs = [
        ['name'=>'山羊座','en'=>'Capricorn','symbol'=>'♑','period'=>'12/22〜1/19'],
        ['name'=>'水瓶座','en'=>'Aquarius', 'symbol'=>'♒','period'=>'1/20〜2/18'],
        ['name'=>'魚座',  'en'=>'Pisces',   'symbol'=>'♓','period'=>'2/19〜3/20'],
        ['name'=>'牡羊座','en'=>'Aries',    'symbol'=>'♈','period'=>'3/21〜4/19'],
        ['name'=>'牡牛座','en'=>'Taurus',   'symbol'=>'♉','period'=>'4/20〜5/20'],
        ['name'=>'双子座','en'=>'Gemini',   'symbol'=>'♊','period'=>'5/21〜6/21'],
        ['name'=>'蟹座',  'en'=>'Cancer',   'symbol'=>'♋','period'=>'6/22〜7/22'],
        ['name'=>'獅子座','en'=>'Leo',      'symabol'=>'♌','period'=>'7/23〜8/22'],
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
        '山羊座' => [
            'element' => '土',
            'planet'  => '土星',
            'lucky'   => ['色'=>'チャコールグレー','数'=>'8','石'=>'オニキス'],
            'today'   => ['love'=>4,'work'=>5,'money'=>3,'health'=>4],
            'message' => '土星の導きにより、今あなたの足元には確かな地盤が築かれています。コツコツと積み上げてきた努力が、静かに、しかし確実に実を結ぼうとしています。焦らず、自分のペースを守ることが吉。恋愛面では、言葉より行動で気持ちを示すことで相手の心が動くでしょう。',
            'advice'  => '「継続は力なり」があなたの今の合言葉。小さな一歩を丁寧に踏み続けてください。',
        ],
        '水瓶座' => [
            'element' => '風',
            'planet'  => '天王星',
            'lucky'   => ['色'=>'エレクトリックブルー','数'=>'11','石'=>'アメジスト'],
            'today'   => ['love'=>3,'work'=>5,'money'=>4,'health'=>3],
            'message' => '天王星の革新的なエネルギーがあなたの感性を研ぎ澄ませています。独自のアイデアや直感を大切に。周囲が「無理だ」と言うことでも、あなたの視点からは新しい道が見えているはずです。人間関係では、少し距離を置いた冷静な観察眼が良縁を引き寄せます。',
            'advice'  => '枠にとらわれない発想こそ、今のあなたの最大の武器です。',
        ],
        '魚座' => [
            'element' => '水',
            'planet'  => '海王星',
            'lucky'   => ['色'=>'ラベンダー','数'=>'7','石'=>'アクアマリン'],
            'today'   => ['love'=>5,'work'=>3,'money'=>3,'health'=>4],
            'message' => '海王星の夢幻的なエネルギーに包まれ、あなたの感受性は今、最高潮に達しています。直感を信じてください。特に恋愛においては、言葉にならない「感じ」を大切にすることで、魂レベルでのつながりが育まれるでしょう。芸術的な活動も吉です。',
            'advice'  => '今日は理屈より「感じる心」を優先することで扉が開きます。',
        ],
        '牡羊座' => [
            'element' => '火',
            'planet'  => '火星',
            'lucky'   => ['色'=>'スカーレット','数'=>'9','石'=>'ルビー'],
            'today'   => ['love'=>4,'work'=>5,'money'=>4,'health'=>5],
            'message' => '火星の力強いエネルギーが全身を駆け巡っています。今こそ、ずっと温めてきた計画を実行に移す絶好の機会です。多少のリスクを恐れず、先頭に立って進む姿勢が周囲の信頼を集めるでしょう。恋愛では積極性が鍵。想いは早めに伝えて。',
            'advice'  => '迷ったら動く。今のあなたの行動力は、星々が後押ししています。',
        ],
        '牡牛座' => [
            'element' => '土',
            'planet'  => '金星',
            'lucky'   => ['色'=>'エメラルドグリーン','数'=>'6','石'=>'エメラルド'],
            'today'   => ['love'=>5,'work'=>4,'money'=>5,'health'=>3],
            'message' => '金星の恵みがあなたの周囲に美と豊かさをもたらしています。五感で楽しめることに積極的に触れることで、運気がさらに上昇。特に金運は好調で、長期的な視点での投資や貯蓄の計画を立てるには絶好のタイミング。愛情面でも温かな関係が育まれます。',
            'advice'  => '自分を大切にすることが、最高の開運行動です。',
        ],
        '双子座' => [
            'element' => '風',
            'planet'  => '水星',
            'lucky'   => ['色'=>'イエロー','数'=>'5','石'=>'シトリン'],
            'today'   => ['love'=>3,'work'=>5,'money'=>3,'health'=>4],
            'message' => '水星の知的なエネルギーがあなたのコミュニケーション能力を高めています。今日出会う人、交わす言葉、受け取る情報、すべてに大きな意味が宿っています。複数のことを同時進行させる今の状況は、双子座の本領発揮の時。好奇心の赴くままに行動しましょう。',
            'advice'  => '情報と人脈が、今のあなたの最大の財産です。',
        ],
        '蟹座' => [
            'element' => '水',
            'planet'  => '月',
            'lucky'   => ['色'=>'シルバー','数'=>'2','石'=>'ムーンストーン'],
            'today'   => ['love'=>5,'work'=>3,'money'=>4,'health'=>4],
            'message' => '月のやさしい光があなたの感情を穏やかに照らしています。家族や大切な人との時間を大切にすることで、心の深いところから活力が湧いてくるでしょう。直感が鋭くなっている今、第一印象を信じることが大切です。居心地の良い環境づくりが全運を底上げします。',
            'advice'  => '「ホーム」を整えることが、すべての運気の土台になります。',
        ],
        '獅子座' => [
            'element' => '火',
            'planet'  => '太陽',
            'lucky'   => ['色'=>'ゴールド','数'=>'1','石'=>'タイガーアイ'],
            'today'   => ['love'=>4,'work'=>5,'money'=>4,'health'=>5],
            'message' => '太陽の輝かしいエネルギーがあなたをスポットライトの中心へと導いています。自信を持って自分を表現することで、自然と人が集まり、チャンスが広がります。今のあなたのカリスマ性は最高潮。舞台の上に立つことを恐れないでください。',
            'advice'  => '堂々と輝くこと。それが今のあなたへの星からのメッセージです。',
        ],
        '乙女座' => [
            'element' => '土',
            'planet'  => '水星',
            'lucky'   => ['色'=>'ネイビー','数'=>'3','石'=>'サファイア'],
            'today'   => ['love'=>3,'work'=>5,'money'=>4,'health'=>5],
            'message' => '水星の分析的なエネルギーと地の安定性が融合し、今のあなたの判断力は非常に冴えています。細部に宿る重要なサインを見逃さないでください。仕事面では、丁寧で几帳面なあなたの仕事ぶりが高く評価される時期。健康管理を意識することでさらに運気が安定します。',
            'advice'  => '「完璧を目指す心」が今のあなたを正しい方向へ導きます。',
        ],
        '天秤座' => [
            'element' => '風',
            'planet'  => '金星',
            'lucky'   => ['色'=>'ローズピンク','数'=>'6','石'=>'ローズクォーツ'],
            'today'   => ['love'=>5,'work'=>4,'money'=>3,'health'=>4],
            'message' => '金星の調和のエネルギーが、あなたの周囲に美しいバランスをもたらしています。人間関係において公平で優雅な立ち振る舞いができる今、新たな縁が結ばれやすくなっています。決断を迫られる場面では、「美しい選択」を基準にすることで迷いが消えるでしょう。',
            'advice'  => 'バランスと美を大切にすることが、今のあなたの開運の鍵です。',
        ],
        '蠍座' => [
            'element' => '水',
            'planet'  => '冥王星',
            'lucky'   => ['色'=>'ディープレッド','数'=>'0','石'=>'オブシディアン'],
            'today'   => ['love'=>4,'work'=>4,'money'=>5,'money'=>5,'health'=>3],
            'message' => '冥王星の深淵なるエネルギーが、あなたの内なる変容を促しています。表面に見えるものだけでなく、その奥に潜む本質を見抜く力が今のあなたには備わっています。金運の上昇が見込まれる今、大切なのは「手放すこと」で新たな豊かさへの道が開かれます。',
            'advice'  => '変化を恐れず、深く潜ることで真の宝が見つかります。',
        ],
        '射手座' => [
            'element' => '火',
            'planet'  => '木星',
            'lucky'   => ['色'=>'パープル','数'=>'9','石'=>'ターコイズ'],
            'today'   => ['love'=>4,'work'=>4,'money'=>5,'health'=>4],
            'message' => '木星の拡大のエネルギーがあなたの視野をどこまでも広げています。今の「遠くへ行きたい」「もっと知りたい」という衝動は、宇宙からの正しいサインです。新しい学びや旅、異文化との出会いが大きな幸運の扉を開きます。楽観的な姿勢が最高の引き寄せになります。',
            'advice'  => '矢は放たなければ的に当たりません。今こそ大きく狙って。',
        ],
    ];
    return $readings[$signName] ?? $readings['山羊座'];
}

function getTarotReading(string $name, string $birthdate): array {
    $seed = crc32($name . $birthdate . date('Ymd'));
    srand($seed);

    $cards = [
        ['name'=>'愚者',        'num'=>'0',   'symbol'=>'🌟','upright'=>true,
         'message'=>'新しい冒険の始まりを告げる「愚者」が現れました。ゼロから踏み出す勇気こそが、今のあなたに必要なもの。計算より直感、準備より行動。純粋な心で一歩を踏み出した先に、想像を超えた景色が広がっています。'],
        ['name'=>'魔術師',      'num'=>'I',   'symbol'=>'🔮','upright'=>true,
         'message'=>'全ての力があなたの手の中に揃っています。「魔術師」は、あなたが必要なリソースをすでに持っていることを示しています。あとは意志と集中力。今の目標に向けてエネルギーを一点に集めることで、現実が動き始めます。'],
        ['name'=>'女教皇',      'num'=>'II',  'symbol'=>'🌙','upright'=>true,
         'message'=>'静寂の中に答えが宿っています。「女教皇」は内なる知恵と直感の象徴。今は外の世界より内側の声に耳を澄ませるとき。表面には見えない真実が、瞑想や夢、ふとした閃きの中にあなたへのメッセージを届けようとしています。'],
        ['name'=>'女帝',        'num'=>'III', 'symbol'=>'🌺','upright'=>true,
         'message'=>'豊穣と愛情のエネルギーに満ちた「女帝」が今のあなたを照らしています。与えること、受け取ること、そして自分自身を大切にすること。この三つのバランスが整ったとき、あなたの人生はさらに花開きます。創造的な活動にも吉の兆し。'],
        ['name'=>'皇帝',        'num'=>'IV',  'symbol'=>'⚡','upright'=>true,
         'message'=>'「皇帝」の安定と権威のエネルギーがあなたを支えています。今こそ、自分の人生における「責任者」として堂々と立つべき時。ルールを作り、秩序をもたらす側に回ることで、周囲からの信頼が一気に高まります。基盤固めが大きな成果につながります。'],
        ['name'=>'法王',        'num'=>'V',   'symbol'=>'✨','upright'=>true,
         'message'=>'「法王」は伝統と精神的な導きの象徴。師との出会い、または自身が誰かの導き手となる暗示があります。今は信頼できる人の教えに耳を傾けるとき。精神的な成長が物質的な豊かさを呼び込むタイミングでもあります。'],
        ['name'=>'恋人',        'num'=>'VI',  'symbol'=>'💖','upright'=>true,
         'message'=>'「恋人」のカードが示すのは、選択と愛の調和。心から「Yes」と言える選択をすることで、人生が大きく開きます。恋愛だけでなく、仕事や生き方においても「本当に好きなもの」を選ぶ勇気が今のあなたに問われています。'],
        ['name'=>'戦車',        'num'=>'VII', 'symbol'=>'🏆','upright'=>true,
         'message'=>'「戦車」の力強い前進エネルギーが今のあなたを包んでいます。相反する力をコントロールし、目標に向かって突き進む時。意志の力と集中力が勝利の鍵。周囲の意見に流されず、自分の方向性を信じて進み続けてください。'],
        ['name'=>'力',          'num'=>'VIII','symbol'=>'🦁','upright'=>true,
         'message'=>'真の「力」は、激しさではなく優しさから生まれます。このカードは、あなたの内に秘められた穏やかな強さを示しています。感情を力で押さえ込むのではなく、愛情を持って受け入れることで、あなたは獅子をも従わせる力を手にします。'],
        ['name'=>'隠者',        'num'=>'IX',  'symbol'=>'🕯️','upright'=>true,
         'message'=>'「隠者」は内省と知恵の象徴。今は立ち止まり、自分の内側を静かに照らすべき時かもしれません。孤独を恐れず、一人の時間を大切にすることで、次のステージへ向けた確かな洞察が得られます。答えはすでにあなたの中にあります。'],
        ['name'=>'運命の輪',    'num'=>'X',   'symbol'=>'⚙️','upright'=>true,
         'message'=>'「運命の輪」が回り、新たなサイクルの始まりを告げています。変化は必然。流れに逆らうのではなく、乗りこなすことで幸運の波があなたを高みへと運びます。今起きていることには必ず意味があります。宇宙の采配を信頼してください。'],
        ['name'=>'正義',        'num'=>'XI',  'symbol'=>'⚖️','upright'=>true,
         'message'=>'「正義」のカードは、因果の法則とバランスの象徴。正直で公正な行動が、今のあなたに最大の幸運をもたらします。過去の誠実な努力が正当に評価される時期でもあります。迷ったときは「正しいこと」を選ぶ。それだけで道は開けます。'],
        ['name'=>'吊られた男',  'num'=>'XII', 'symbol'=>'🌊','upright'=>false,
         'message'=>'「吊られた男」は逆説の知恵を示しています。今は行動よりも待機、前進よりも受容の時。一見不利に見える状況の中に、新しい視点と大きな気づきが眠っています。手放すことを恐れないでください。執着を離れた先に、真の豊かさが待っています。'],
        ['name'=>'死神',        'num'=>'XIII','symbol'=>'🔄','upright'=>true,
         'message'=>'「死神」は終わりではなく、変容と再生の象徴です。古いものが終わりを告げ、新しいものが生まれようとしています。今感じる「終わり」は、実は次の始まりへの扉。手放す勇気が、あなたの人生に新鮮な息吹をもたらします。'],
        ['name'=>'節制',        'num'=>'XIV', 'symbol'=>'🌈','upright'=>true,
         'message'=>'「節制」は調和と錬金術の象徴。異なるものをうまく組み合わせることで、奇跡が生まれます。焦らず、じっくりと。時間をかけて物事を育てることで、やがて黄金が生まれます。今のあなたに必要なのは、バランスと忍耐です。'],
        ['name'=>'悪魔',        'num'=>'XV',  'symbol'=>'🗝️','upright'=>false,
         'message'=>'「悪魔」は束縛と執着を映し出すカード。しかし、その鎖は実は自分でいつでも外せるものです。何があなたを縛っているのか、正直に見つめてください。恐れや欲望からの解放が、今のあなたへの最大のテーマです。'],
        ['name'=>'塔',          'num'=>'XVI', 'symbol'=>'⚡','upright'=>false,
         'message'=>'「塔」は突然の変化と解放を示しています。崩れるべきものが崩れ、本質だけが残る。一見破壊的に見えるこの変化の中に、実は長い間必要だった「解放」が隠れています。嵐が過ぎた後の空は、必ず澄み渡っています。'],
        ['name'=>'星',          'num'=>'XVII','symbol'=>'⭐','upright'=>true,
         'message'=>'「星」のカードは希望と刷新の象徴。あなたの前には、確かな可能性の光が灯っています。傷ついた心が癒され、夢を信じる力が戻ってきます。今のあなたの願いは、星の力を借りて現実へと近づいています。希望を手放さないでください。'],
        ['name'=>'月',          'num'=>'XVIII','symbol'=>'🌙','upright'=>false,
         'message'=>'「月」は幻想と直感の領域を示しています。今は物事がはっきり見えにくい時期かもしれませんが、それはあなたの内なる感性が研ぎ澄まされているサインでもあります。夢や直感からのメッセージに敏感になることで、見えない真実が浮かび上がってきます。'],
        ['name'=>'太陽',        'num'=>'XIX', 'symbol'=>'☀️','upright'=>true,
         'message'=>'大アルカナ最高の幸運カード「太陽」があなたのもとへ！喜びと成功、子供のような純粋さで世界と向き合うことで、あらゆる願いが光の速さで実現に向かいます。今のあなたには、その輝きを受け取る準備ができています。'],
        ['name'=>'審判',        'num'=>'XX',  'symbol'=>'🎺','upright'=>true,
         'message'=>'「審判」は覚醒と再生の呼び声。高いところからの呼びかけに、今のあなたは応える準備ができています。過去を清算し、真の使命に気づくタイミング。大きな転換点に立つあなたへの星からのメッセージは「今こそ本当の自分として生きよ」です。'],
        ['name'=>'世界',        'num'=>'XXI', 'symbol'=>'🌍','upright'=>true,
         'message'=>'大アルカナの完成形「世界」があなたを祝福しています！一つのサイクルの完全なる達成と成就。今のあなたには、物事を完成に導く力が宿っています。喜んで受け取り、次の大きな旅への準備をしてください。'],
    ];

    $idx = abs($seed) % count($cards);
    return $cards[$idx];
}

function getSichu(string $birthdate): array {
    $date  = new DateTimeImmutable($birthdate);
    $year  = (int)$date->format('Y');
    $month = (int)$date->format('n');
    $day   = (int)$date->format('j');

    $stems  = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
    $branches = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
    $elements = ['木','木','火','火','土','土','金','金','水','水'];
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
        '木' => [
            'keyword' => '成長・発展・柔軟',
            'nature'  => '春の木のような生命力を持つあなた。根を張りながらも天へと伸びる柔軟さと粘り強さが特徴です。',
            'message' => '日干「'.$dayStem.'」を持つあなたは、木の気の持ち主。新しいことを始める才能と、人を育てる優しさが備わっています。今の時期は、種を丁寧に蒔くことが重要です。焦らず、じっくりと根を張ることで、やがて大きな実りが得られます。人間関係では、自然体でいることが最大の魅力を引き出します。',
            'lucky'   => ['方位'=>'東','色'=>'グリーン','季節'=>'春'],
        ],
        '火' => [
            'keyword' => '情熱・輝き・変容',
            'nature'  => '燃える炎のような情熱と輝きを持つあなた。周囲を温め、照らす存在です。',
            'message' => '日干「'.$dayStem.'」を持つあなたは、火の気の持ち主。行動力と情熱、そして人を惹きつけるカリスマ性が特徴です。今の時期は、あなたの情熱を具体的な形にするチャンス。ただし、燃えすぎないよう、時には休息を取ることも重要です。感情豊かなあなたの表現力は、今最大の武器となります。',
            'lucky'   => ['方位'=>'南','色'=>'レッド','季節'=>'夏'],
        ],
        '土' => [
            'keyword' => '安定・信頼・包容',
            'nature'  => '大地のような包容力と安定感を持つあなた。すべてを受け入れ、育む力があります。',
            'message' => '日干「'.$dayStem.'」を持つあなたは、土の気の持ち主。信頼感と誠実さ、そして人を包み込む温かさが最大の魅力です。今の時期は、足元をしっかり固めることが運気向上の鍵。中心にドンと構えることで、周囲が自然と集まってきます。長期的な視点を持つことで、大きな成果が得られます。',
            'lucky'   => ['方位'=>'中央','色'=>'イエロー','季節'=>'土用'],
        ],
        '金' => [
            'keyword' => '鋭敏・義理・変革',
            'nature'  => '磨かれた金属のように、鋭い感性と強い意志を持つあなた。義理と筋を重んじます。',
            'message' => '日干「'.$dayStem.'」を持つあなたは、金の気の持ち主。鋭い判断力と揺るぎない意志、そして美的センスが特徴です。今の時期は、不要なものを思い切って整理することで、新たな価値が生まれます。完璧主義な面が才能を磨きますが、時には「十分」と言える柔軟さも大切です。',
            'lucky'   => ['方位'=>'西','色'=>'ホワイト','季節'=>'秋'],
        ],
        '水' => [
            'keyword' => '知恵・流動・深み',
            'nature'  => '深い海のような知恵と、川のような流動性を持つあなた。本質を見抜く力があります。',
            'message' => '日干「'.$dayStem.'」を持つあなたは、水の気の持ち主。深い洞察力と柔軟な適応力、そして知的好奇心の旺盛さが特徴です。今の時期は、情報収集と深い思索があなたの道を切り開きます。流れに逆らわず、自然な形で物事を進めることで、スムーズに目標へとたどり着けます。',
            'lucky'   => ['方位'=>'北','色'=>'ブラック','季節'=>'冬'],
        ],
    ];

    $reading = $readings[$element];

    return [
        'yearPillar'  => $yearStem . $yearBranch,
        'dayPillar'   => $dayStem  . $dayBranch,
        'dayStem'     => $dayStem,
        'element'     => $element,
        'keyword'     => $reading['keyword'],
        'nature'      => $reading['nature'],
        'message'     => $reading['message'],
        'lucky'       => $reading['lucky'],
    ];
}

function buildIntegratedReading(string $name, array $zodiac, array $zodiacReading, array $tarot, array $sichu): string {
    $direction = $tarot['upright'] ? '正位置' : '逆位置';
    $templates = [
        "{name}さん、三つの叡智があなたへのメッセージを届けています。\n\n{zodiac_symbol}【星の導き】{zodiac_symbol}\n{zodiac_name}を宿すあなたは、{planet}の加護のもと、{zodiac_advice}\n\n{tarot_symbol}【カードの啓示】{tarot_symbol}\n「{tarot_name}（{direction}）」が示す通り、今のあなたには{tarot_keyword}の力が宿っています。\n\n☯【命式が示す本質】☯\n{sichu_element}の気を持つあなたの本質は「{sichu_keyword}」。{sichu_nature}\n\n✨【統合された鑑定より】✨\n宇宙の三つの言語、西洋占星術・タロット・四柱推命が、今この瞬間に同じ方向を指しています。それは「{integrated_theme}」というメッセージです。\n\n今のあなたにとって最も大切なことは、自分の内なる声を信頼すること。星があなたを見守り、カードがあなたの力を証明し、命式があなたの本質を示しています。すべての鑑定が伝えるのは、あなたにはその道を歩む力が十分に備わっているということです。",
    ];

    $themes = [
        '自分自身の力を信じ、新たな一歩を踏み出す時が来ている',
        '内なる知恵と宇宙の流れが、あなたを正しい方向へ導いている',
        '変化を恐れず受け入れることで、大きな恵みが訪れる',
        '今の努力は必ず実を結ぶ。焦らず、信じて進め',
        'あなたの持つ本来の輝きを、今こそ世界に解き放つとき',
    ];

    $themeIdx = crc32($name . date('Ymd')) % count($themes);

    return str_replace(
        ['{name}','{zodiac_symbol}','{zodiac_name}','{planet}','{zodiac_advice}',
         '{tarot_symbol}','{tarot_name}','{direction}','{tarot_keyword}',
         '{sichu_element}','{sichu_keyword}','{sichu_nature}','{integrated_theme}'],
        [$name, $zodiac['symbol'], $zodiac['name'], $zodiacReading['planet'], $zodiacReading['advice'],
         $tarot['symbol'], $tarot['name'], $direction, mb_substr($tarot['message'], 0, 30),
         $sichu['element'], $sichu['keyword'], $sichu['nature'], $themes[abs($themeIdx)]],
        $templates[0]
    );
}

// ══════════════════════════════════════════════════════════════════
// リクエスト処理
// ══════════════════════════════════════════════════════════════════

$result   = null;
$errors   = [];
$name     = '';
$birthday = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim(htmlspecialchars($_POST['name']     ?? '', ENT_QUOTES, 'UTF-8'));
    $birthday = trim(htmlspecialchars($_POST['birthday'] ?? '', ENT_QUOTES, 'UTF-8'));

    if ($name === '')     $errors[] = 'お名前を入力してください。';
    if ($birthday === '') $errors[] = '生年月日を入力してください。';
    if ($birthday !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday))
        $errors[] = '生年月日の形式が正しくありません。';

    if (empty($errors)) {
        $bDate        = new DateTimeImmutable($birthday);
        $month        = (int)$bDate->format('n');
        $day          = (int)$bDate->format('j');
        $zodiac       = getZodiac($month, $day);
        $zodiacReading= getZodiacReading($zodiac['name']);
        $tarot        = getTarotReading($name, $birthday);
        $sichu        = getSichu($birthday);
        $integrated   = buildIntegratedReading($name, $zodiac, $zodiacReading, $tarot, $sichu);

        $result = compact('zodiac','zodiacReading','tarot','sichu','integrated');
    }
}

function stars(int $n, int $max = 5): string {
    $out = '';
    for ($i = 1; $i <= $max; $i++)
        $out .= '<span class="star' . ($i <= $n ? ' filled' : '') . '">★</span>';
    return $out;
}

// ══════════════════════════════════════════════════════════════════
// 開運カレンダー用ロジック
// ══════════════════════════════════════════════════════════════════

function myGregorianToJD(int $y, int $m, int $d): int {
    if ($m <= 2) { $y--; $m += 12; }
    $a = (int)($y / 100);
    $b = 2 - $a + (int)($a / 4);
    return (int)(365.25 * ($y + 4716)) + (int)(30.6001 * ($m + 1)) + $d + $b - 1524;
}

function jdToLunar(int $jd): array {
    $cycle = $jd - 2451550;
    $monthNum = (int)($cycle / 29.53059);
    $monthStart = (int)(2451550 + $monthNum * 29.53059);
    $day = $jd - $monthStart + 1;
    $month = (($monthNum % 12) + 12) % 12 + 1;
    return ['month' => $month, 'day' => $day];
}

function getRokuyo(int $year, int $month, int $day): array {
    $rokuyoList = [
        ['name'=>'大安', 'class'=>'cal-taian',  'color'=>'#c9a84c', 'desc'=>'万事に大吉。何を始めるにも最良の日。'],
        ['name'=>'赤口', 'class'=>'cal-shakku', 'color'=>'#e8719a', 'desc'=>'午の刻のみ吉。火や血に注意の日。'],
        ['name'=>'先勝', 'class'=>'cal-sensho', 'color'=>'#9b72ef', 'desc'=>'急ぐことが吉。午前中に動くのが吉。'],
        ['name'=>'友引', 'class'=>'cal-tomobiki','color'=>'#4ecdc4','desc'=>'慶事吉、弔事凶。朝夕は吉の日。'],
        ['name'=>'先負', 'class'=>'cal-senbu',  'color'=>'#8a7db5', 'desc'=>'午後が吉。静かに過ごすのが良い日。'],
        ['name'=>'仏滅', 'class'=>'cal-butsu',  'color'=>'#6b6456', 'desc'=>'控えめに過ごすのが吉とされる日。'],
    ];
    $jd = myGregorianToJD($year, $month, $day);
    $lunar = jdToLunar($jd);
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
$calRokuyo   = getRokuyo((int)$todayObj->format('Y'), (int)$todayObj->format('n'), (int)$todayObj->format('j'));
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
<link rel="canonical" href="https://life-fun.net/" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="西洋占星術・タロット・四柱推命の3大占いを一度に体験。生年月日を入力するだけで、あなただけの統合鑑定書を無料でお届けします。">
<title>三星鑑定 ── 西洋占星術・タロット・四柱推命</title>
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
}

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
.block-integrated::before{background:linear-gradient(90deg,var(--gold),var(--rose),var(--violet))}

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

.integrated-text{
  font-family:var(--ff-serif);
  font-size:.95rem;
  line-height:2.1;
  white-space:pre-line;
  color:var(--text);
}

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
/* ── HEADER ── */
header.site-header{
  border-bottom:1px solid var(--border);padding:0 1.2rem;
  position:sticky;top:0;z-index:100;
  background:rgba(8,6,15,.9);backdrop-filter:blur(12px);
}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}
/* ======================
   三星鑑定について
====================== */
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
/* ── スマホメニュー ── */
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{
    display:flex;align-items:center;gap:.4rem;
    font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;
    color:var(--muted);background:none;
    border:1px solid var(--border);border-radius:6px;
    padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s;
  }
  .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
  .sp-dropdown{
    display:none;position:absolute;top:54px;right:1.2rem;
    background:rgba(8,6,15,.97);border:1px solid var(--border2);
    border-radius:12px;overflow:hidden;z-index:200;min-width:180px;
    backdrop-filter:blur(16px);
  }
  .sp-dropdown.open{display:block}
  .sp-dropdown a{
    display:block;padding:.85rem 1.25rem;
    font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
    color:var(--muted);text-decoration:none;
    border-bottom:1px solid var(--border);transition:color .2s,background .2s;
  }
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
  .sp-dropdown span{
    display:block;padding:.85rem 1.25rem;
    font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
    color:var(--text);border-bottom:1px solid var(--border);
  }
  .sp-dropdown span:last-child{border-bottom:none}
}
</style>
</head>
<body>
<?php $currentPage='top'; require __DIR__.'/inc/header.php'; ?>
<div class="wrap">

  <!-- HERO -->
  <header class="hero">
    <span class="hero-eyebrow">Free Fortune Telling</span>
    <h1>三星鑑定</h1>
    <p class="hero-sub">西洋占星術・タロット・四柱推命 ── 三つの叡智による統合鑑定</p>
    <div class="pillars">
      <span class="pillar">♈ 西洋占星術</span>
      <span class="pillar">🔮 タロット</span>
      <span class="pillar">☯ 四柱推命</span>
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
          <form method="post" action="">
            <div class="field">
              <label for="name">お名前（ニックネーム可）</label>
              <input type="text" id="name" name="name" value="<?= $name ?>" placeholder="例：さくら" required>
            </div>
            <div class="field">
              <label for="birthday">生年月日</label>
              <input type="date" id="birthday" name="birthday" value="<?= $birthday ?>"
                     min="1920-01-01" max="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" class="btn-submit">✦ 三星鑑定を開始する ✦</button>
          </form>
        </div>
      </section>

      <!-- タロット占いへの導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(155,114,239,.12) 0%,rgba(232,113,154,.08) 100%);border:1px solid rgba(155,114,239,.3);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--violet-lt);text-transform:uppercase;margin-bottom:.3rem">New</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">本格タロット占い</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">カードをめくって今のあなたへのメッセージを</div>
        </div>
        <a href="/tarot.php" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--teal),var(--violet));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(78,205,196,.35);">
        カードを引く &#8594;
        </a>
      </div>
      <!-- MBTI診断への導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(201,168,76,.1) 0%,rgba(155,114,239,.08) 100%);border:1px solid rgba(201,168,76,.25);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--gold);text-transform:uppercase;margin-bottom:.3rem">MBTI × Zodiac</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">MBTI×星座 性格診断</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">10の質問で性格タイプと星座の組み合わせ運命を診断</div>
        </div>
        <a href="/mbti.php" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--gold),var(--violet));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(201,168,76,.3);">
          診断する &#8594;
        </a>
      </div>
      <!-- 数秘術への導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(78,205,196,.1) 0%,rgba(201,168,76,.08) 100%);border:1px solid rgba(78,205,196,.25);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--teal);text-transform:uppercase;margin-bottom:.3rem">Numerology</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">数秘術診断</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">生年月日と名前から4つの数字で人生の使命を読み解く</div>
        </div>
        <a href="/numerology.php" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--teal),var(--gold));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(78,205,196,.3);">
          診断する &#8594;
        </a>
      </div>
      <!-- 九星気学への導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(232,113,154,.1) 0%,rgba(155,114,239,.08) 100%);border:1px solid rgba(232,113,154,.25);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--rose);text-transform:uppercase;margin-bottom:.3rem">Nine Star Ki</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">九星気学診断</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">生まれ年の九星から運勢・相性・吉方位を鑑定</div>
        </div>
        <a href="/kyusei.php" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--rose),var(--violet));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(232,113,154,.3);">
          診断する &#8594;
        </a>
      </div>
      <!-- RPG占いへの導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(46,90,60,.3) 0%,rgba(43,74,38,.2) 100%);border:1px solid rgba(78,150,90,.3);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:#7ecf8a;text-transform:uppercase;margin-bottom:.3rem">RPG Fortune</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">RPG占いの村</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">勇者となって占いの村を冒険しながら運命を知る</div>
        </div>
        <a href="/rpg.php" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,#4a9c5a,#2b7a3a);color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(74,156,90,.3);">
          冒険する &#8594;
        </a>
      </div>
      <!-- 相性診断への導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(232,113,154,.12) 0%,rgba(201,168,76,.08) 100%);border:1px solid rgba(232,113,154,.3);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--rose);text-transform:uppercase;margin-bottom:.3rem">Compatibility</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">二人の相性診断</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">星座と数秘術で恋愛・結婚の相性を鑑定する</div>
        </div>
        <a href="/aisho" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--rose),var(--gold));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(232,113,154,.3);">
          診断する &#8594;
        </a>
      </div>
      <!-- 前世診断への導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(155,114,239,.12) 0%,rgba(78,205,196,.08) 100%);border:1px solid rgba(155,114,239,.3);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--violet-lt);text-transform:uppercase;margin-bottom:.3rem">Past Life Reading</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">前世診断</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">あなたは何回目の転生？魂のカルテを読み解く</div>
        </div>
        <a href="/zense" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--violet),var(--teal));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(155,114,239,.3);">
          診断する &#8594;
        </a>
      </div>
      <!-- 守護霊診断への導線 -->
      <div style="margin:0 0 1.5rem;background:linear-gradient(135deg,rgba(201,168,76,.1) 0%,rgba(155,114,239,.1) 100%);border:1px solid rgba(201,168,76,.3);border-radius:14px;padding:1.2rem 1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
        <div>
          <div style="font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--gold-lt);text-transform:uppercase;margin-bottom:.3rem">Guardian Spirit</div>
          <div style="font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text)">守護霊診断</div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">あなたを守る霊はUR？SSR？レアリティ付き守護霊を召喚</div>
        </div>
        <a href="/guardian" style="display:inline-block;padding:.6rem 1.2rem;background:linear-gradient(135deg,var(--gold),var(--violet));color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.85rem;font-weight:600;letter-spacing:.08em;text-decoration:none;white-space:nowrap;box-shadow:0 4px 16px rgba(201,168,76,.3);">
          召喚する &#8594;
        </a>
      </div>

      <!-- 結果（main-colの内側） -->
      <?php if ($result): ?>
      <section class="result-section" id="result">

    <div class="result-header">
      <div class="result-name"><?= $name ?> さんの鑑定書</div>
      <div class="result-date"><?= (new DateTimeImmutable($birthday))->format('Y年n月j日生まれ') ?></div>
    </div>

    <!-- 西洋占星術 -->
    <div class="block block-astro">
      <div class="block-label">Western Astrology</div>
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
        <?php foreach($result['zodiacReading']['lucky'] as $k=>$v): ?>
        <span class="lucky-item"><span><?= $k ?></span><?= $v ?></span>
        <?php endforeach; ?>
      </div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['zodiacReading']['message'])) ?></div>
    </div>

    <!-- AdSense枠 1 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- タロット -->
    <div class="block block-tarot">
      <div class="block-label">Tarot Reading</div>
      <div class="block-title">
        <span class="block-symbol"><?= $result['tarot']['symbol'] ?></span>
        <?= $result['tarot']['num'] ?>. <?= $result['tarot']['name'] ?>
        <span class="tarot-direction <?= $result['tarot']['upright'] ? 'upright' : 'reversed' ?>">
          <?= $result['tarot']['upright'] ? '正位置' : '逆位置' ?>
        </span>
      </div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['tarot']['message'])) ?></div>
    </div>

    <!-- AdSense枠 2 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- 四柱推命 -->
    <div class="block block-sichu">
      <div class="block-label">四柱推命 · Shichū Suimei</div>
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
        <?php foreach($result['sichu']['lucky'] as $k=>$v): ?>
        <span class="lucky-item"><span><?= $k ?></span><?= $v ?></span>
        <?php endforeach; ?>
      </div>
      <div class="block-message"><?= nl2br(htmlspecialchars($result['sichu']['message'])) ?></div>
    </div>

    <!-- AdSense枠 3 -->
    <div class="adsense-space">
      <!-- ここに AdSense コードを貼り付けてください -->
    </div>

    <!-- 統合鑑定 -->
    <div class="block block-integrated">
      <div class="block-label">Integrated Reading · 統合鑑定</div>
      <div class="block-title">
        <span class="block-symbol">✨</span>三星統合鑑定書
      </div>
      <div class="integrated-text"><?= htmlspecialchars($result['integrated']) ?></div>
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
            <div class="rokuyo-kana">Rokuyo</div>
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
