<?php declare(strict_types=1);

// ─── 星座 ─────────────────────────────────────────────
$ZODIAC = [
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

function getZodiacIdx(int $m, int $d): int {
  $cuts=[19,18,20,19,20,21,22,22,22,23,21,21];
  return ($d<=$cuts[$m-1])?($m-1):$m%12;
}

function calcLP(int $y,int $m,int $d): int {
  $n=array_sum(str_split(sprintf('%04d%02d%02d',$y,$m,$d)));
  while($n>9&&!in_array($n,[11,22,33])) $n=array_sum(str_split((string)$n));
  return $n;
}

function zodiacScore(string $e1,string $e2): int {
  if($e1===$e2) return 5;
  $best=['火'=>'風','風'=>'火','水'=>'地','地'=>'水'];
  return ($best[$e1]??'')===$e2?4:2;
}

function lpBonus(int $a,int $b): int {
  foreach([[1,5,7],[2,4,8],[3,6,9]] as $g)
    if(in_array($a,$g)&&in_array($b,$g)) return 1;
  return (in_array($a,[11,22,33])||in_array($b,[11,22,33]))?1:0;
}

// 告白の言葉（パーツ組み合わせ）
$CONFESS_OPEN=[
  'ずっと言えなかったんだけど、',
  'こんなこと急に言うのも変かもだけど、',
  'うまく言葉にできるかわからないけど、',
  'ちゃんと伝えたくて。',
  'ずっと気になってて、もう隠しておけないから言います。',
  'なんか急に言うのもアレなんだけど、',
  '今日、どうしても伝えたいことがあって。',
  'ずっと機会を伺ってたんです。',
  'あなたには正直に言いたくて。',
  'うまく伝えられる自信ないけど、',
  'ずっと言いたかったこと、やっと言える気がして。',
  'ごめん、急に真面目な話するね。',
  'これ言ったら関係が変わるかなって不安なんだけど、',
  '笑わないで聞いてほしいんだけど、',
  'なんか緊張してるんだけど、',
  'これ言うの勇気がいったんだけど、',
  'もし迷惑だったら忘れてほしいんだけど、',
  'ちょっと聞いてほしいことがあって、',
  '前から思ってたことを正直に伝えさせてください。',
  'ずっとモヤモヤしてたから、言ってしまいます。',
];
$CONFESS_FEEL=[
  'あなたのことが好きです。',
  'いつの間にか、あなたのことばかり考えるようになってた。',
  'あなたといると、なんか自分らしくいられる気がするんだよね。',
  '一緒にいるとほっとする人って、あなたが初めてかも。',
  'あなたがいる日といない日で、こんなに気持ちが違うなんて思わなかった。',
  '気づいたら、あなたのことを誰よりも大切に思ってた。',
  'あなたのこと、もっとそばで見ていたいって思う。',
  '毎日あなたのことを考えてしまってて、自分でびっくりしてる。',
  '一緒にいるといつも楽しくて、離れたくないって思う。',
  'あなたの笑顔を見ると、なんか胸がきゅってなる。',
  'あなたといる時間が、今一番好きな時間だって気づいた。',
  'こんなに誰かのことを気になったの、久しぶりで。',
  'あなたのことを考えると、自然と顔がにやけてしまう。',
  '最近あなたのことが頭から離れないんだよね。',
  'あなたといると安心するし、一緒にいたいって自然に思える。',
  'あなたのことがどんどん好きになってる気がして。',
  '気がついたら、あなたのことが一番大切になってた。',
  'あなたにとって特別な人になりたいって思ってる。',
  'あなたのそばにいると、時間が経つのが早くて困る。',
  '正直、あなたのことが気になって仕方ない。',
];
$CONFESS_ASK=[
  'よかったら、もっと近くにいさせてほしいです。',
  'もし気持ちが同じだったら、うれしいんだけど。',
  'よかったら、二人でどこか行きませんか？',
  'あなたのことを、もっと知りたいです。',
  '返事はゆっくりでいいので、考えてもらえませんか？',
  'これからも、そばにいてほしいです。',
  '急がなくていいので、気持ちを聞かせてもらえると。',
  '嫌じゃなかったら、もっと話しましょう。',
  '一緒にいると楽しいから、また誘ってもいいですか？',
  'もし同じ気持ちだったら、すごくうれしいです。',
  'これからも、ずっとそばにいてもいいですか？',
  '重く考えなくていいので、気が向いたら教えてください。',
  '一緒に色々なところへ行ってみませんか？',
  'よかったら、もう少し僕（私）を見てほしいです。',
  '急かすつもりはないけど、あなたの気持ちが知りたいです。',
  'もし迷惑じゃなかったら、もう少し一緒にいられませんか？',
  'よかったら、僕（私）のことも気にかけてほしいな。',
  'あなたの答えが何であれ、伝えられてよかったです。',
  'これからも、こうして会えたらいいな。',
  'これからも、あなたの隣にいたいです。',
];
$CONFESS_TIPS=[
  '伝える場所は、二人だけになれる静かな場所がおすすめです。',
  '完璧な言葉じゃなくていい。あなたの言葉で伝えることが大切です。',
  '緊張してもOK。むしろその緊張が、本気の証拠になります。',
  '「好き」の一言より、なぜ好きなのかを添えると伝わりやすいです。',
  '笑顔で伝えると、相手も受け取りやすくなります。',
  '焦らなくて大丈夫。あなたのタイミングで伝えましょう。',
  '手紙に書いて渡すのも、言葉が整理できておすすめです。',
  '伝える前に深呼吸。それだけで声が落ち着きます。',
  'テキストより直接話す方が、気持ちがより伝わります。',
  '相手がリラックスしているときを選ぶと、気持ちが届きやすいです。',
  '長い説明より、シンプルな言葉の方が心に刺さります。',
  '結果がどうであれ、伝えること自体があなたを成長させます。',
  'あなたの言葉に自信を持って。気持ちは必ず伝わります。',
  '伝えた後は、相手のペースに合わせてあげてください。',
  '相手の目を見て話すと、言葉以上のものが伝わりますよ。',
];

// デートスポット候補（元素別・複数）
// デートスポット：場所カテゴリ（重み付き選択）
$DATE_LOC_DAILY=[  // 70%で出る・日常系
  '近所の','家の近くの','駅前の','地元の','実家の近くの',
  '職場の近くの','いつもの','ちょっと遠くの','隣町の','少し足をのばした先の',
  '車で30分の','電車で1時間の','歩いて行ける距離の','自転車でちょうどいい',
  'バス1本で行ける','乗り換えなしで行ける','地元で評判の','地元民しか知らない',
  '穴場の','前から気になってた','友達に教えてもらった','子供の頃に行ってた',
  '海沿いの','山の近くの','川沿いの','下町の','港町の',
  '都心の','郊外の','商店街の','ショッピングモールの','温泉街の',
  '新しくできた','よく通る道沿いの','話題の','地図で見つけた穴場の',
  '口コミで知った','SNSでバズってた','テレビで紹介された','隠れた名所の',
];
$DATE_LOC_GAG=[  // 20%で出る・ギャグ系
  '最初の交差点を曲がった先にある',
  'なぜか前から気になってた',
  'グーグルマップが突然勧めてきた',
  '口コミ★4.2の',
  '行列ができてた',
  '通りすがりに見かけた',
  '誰かのSNSに偶然出てきた',
  '地図アプリに突然表示された',
  '前を通るたびにずっと気になってた',
  '存在を忘れかけてた',
];
$DATE_LOC_OVERSEAS=[  // 10%で出る・海外系
  'パリの','ローマの','バリ島の','ソウルの','ハワイの',
];
$DATE_TYPES=[
  ['type'=>'の水族館','desc'=>'幻想的な海の世界が二人を包みます。暗い空間が自然と距離を縮めてくれます。'],
  ['type'=>'のプラネタリウム','desc'=>'満天の星空を見上げながら語る時間は、特別なロマンを生み出します。'],
  ['type'=>'の夜景スポット','desc'=>'輝く夜景を二人で眺める時間は、言葉がなくても伝わるものがあります。'],
  ['type'=>'の展望台','desc'=>'高さから見る景色は非日常感があり、二人の会話がはずむきっかけになります。'],
  ['type'=>'の美術館・ギャラリー','desc'=>'感性を刺激し合える場所。感想を語り合うことで互いをより深く知れます。'],
  ['type'=>'の動物園','desc'=>'かわいい動物を前にするとリラックスでき、自然と笑顔があふれます。'],
  ['type'=>'の植物園・庭園','desc'=>'季節の花を眺めながらのんびり歩く時間は、安心感と親密感を育てます。'],
  ['type'=>'の温泉・スパ','desc'=>'身も心もほぐれる温泉が、自然と本音の会話を引き出します。'],
  ['type'=>'のクルーズ・屋形船','desc'=>'水上からの眺めと非日常の空間が、特別なデートの雰囲気を演出します。'],
  ['type'=>'の高級レストラン','desc'=>'丁寧に作られた料理と静かな空間が、落ち着いた特別な会話を生みます。'],
  ['type'=>'のカフェ巡り','desc'=>'その土地ならではのカフェで過ごす時間が、旅の思い出を豊かにします。'],
  ['type'=>'のライブ・コンサート','desc'=>'生の音楽を一緒に楽しむ体験は、言葉を超えた共感が生まれます。'],
  ['type'=>'の朝市・市場散策','desc'=>'活気ある市場をぶらつくと、その土地の空気を二人で共有できます。'],
  ['type'=>'の食べ歩き','desc'=>'いろんなものを少しずつ一緒に食べる体験が、自然な会話を生み出します。'],
  ['type'=>'のお花見・フラワーパーク','desc'=>'カラフルな花に囲まれた空間は、自然と気分が上がり笑顔が増えます。'],
  ['type'=>'のテーマパーク','desc'=>'一緒にドキドキワクワクを共有することで、一気に距離が縮まります。'],
  ['type'=>'のハイキング・トレッキング','desc'=>'自然の中で体を動かすと素の姿が見えます。達成感も二人の絆を深めます。'],
  ['type'=>'のサイクリング','desc'=>'並走することで自然な会話が生まれ、街の景色をゆっくり楽しめます。'],
  ['type'=>'のロープウェイ・ケーブルカー','desc'=>'ゆっくりと動く密閉空間は、自然と会話が生まれる不思議なスポット。'],
  ['type'=>'のジャズバー・バー','desc'=>'大人の雰囲気の中で過ごす時間が、二人の会話に深みを加えます。'],
  ['type'=>'の謎解き・エスケープルーム','desc'=>'チームで謎を解く体験は、お互いの思考が見えて意外な面が発見できます。'],
  ['type'=>'の料理・クッキング体験','desc'=>'一緒に作って食べる体験は、協力関係が生まれ仲が深まります。'],
  ['type'=>'の陶芸・ものづくり体験','desc'=>'世界にひとつの作品を二人で作る体験は、忘れられない思い出に。'],
  ['type'=>'のナイトクルーズ','desc'=>'夜の水上から見る景色は、昼間とはまた違う特別なロマンがあります。'],
  ['type'=>'の観光農園・果物狩り','desc'=>'自分で摘む体験は子供心に戻れる感覚で、自然と笑顔があふれます。'],
  ['type'=>'のスポーツ観戦','desc'=>'同じチームを一緒に応援する一体感は、距離を一気に縮めます。'],
  ['type'=>'の映画祭・野外シネマ','desc'=>'特別な空間で映画を見る体験は、その場所の記憶と重なって残ります。'],
  ['type'=>'の星空観察','desc'=>'澄んだ星空を二人で見上げる夜は、不思議なロマンが生まれます。'],
  ['type'=>'の伝統工芸体験','desc'=>'その土地ならではの体験が、旅の思い出をさらに特別なものにします。'],
  ['type'=>'のサウナ＆整い体験','desc'=>'整った後の穏やかな気分が、自然と深い会話を引き出してくれます。'],
];

// プレゼント接頭語：カテゴリ別（重み付き選択）
$PRESENT_PFX_DAILY=[  // 70%・日常系
  '記念日にぴったりな','さりげなく渡せる','長く使える',
  'センスが光る','思い出に残る','日常をちょっと豊かにする',
  '特別な日に贈りたい','サプライズ向けの','二人の記念になる',
  'もらって嬉しい定番の','こだわり派に喜ばれる','大切な気持ちが伝わる',
  '使うたびに思い出す','ちょっと背伸びした','毎日の生活を変える',
  'ありがとうの気持ちをこめた','一生モノになりそうな','予算内でベストを尽くした',
  '口コミで評判の','売り場で迷いに迷った','思い切って奮発した',
  '実はずっと前から用意してた','ネットで調べまくって選んだ','店員さんに相談して決めた',
  'もらって絶対笑顔になれる','ずっと使ってもらえそうな','ちょっとした感謝をこめた',
  '誕生日に間に合わせた','相手のことを考えながら選んだ','定番だけど外さない',
];
$PRESENT_PFX_GAG=[  // 20%・ギャグ系
  '祖母の形見の',
  '駅前で拾った',
  'メルカリで見つけた',
  'フリマで100円だった',
  'なぜかふたつ持ってた',
  '福袋から出てきた',
  'くじ引きで当たった',
  '深夜のテンションで買ってしまった',
  '通販で間違えてふたつ注文した',
  '返品し損ねた',
  'お年玉を全部はたいた',
  'ポイントだけで買えた',
  'おそらく偽物の',
  '本物かどうかわからない',
  '鑑定士も首をかしげた',
  '保証書がなぜかない',
];
$PRESENT_PFX_SPECIAL=[  // 10%・ちょっといい系
  'パリで見つけた','旅先で出会った',
  '現地でしか買えない','海外から取り寄せた','世界に数個しかない',
];
$PRESENT_ALL=[
  ['item'=>'ペアネックレス・ブレスレット','why'=>'いつも身につけていられるペアアクセサリーは、常に相手を思い出させてくれます。'],
  ['item'=>'上質な本革財布','why'=>'長く使える本物志向のアイテムは、気持ちが伝わる実用的な贈り物です。'],
  ['item'=>'ブランド腕時計','why'=>'一生モノの腕時計は、特別なタイミングの贈り物として強く記憶に残ります。'],
  ['item'=>'アロマオイルセット＋ディフューザー','why'=>'香りで空間を整えるアロマは、毎日の生活に癒しを届けます。'],
  ['item'=>'パワーストーンブレスレット','why'=>'運気を高めながら毎日身につけられる。スピリチュアルな贈り物として人気です。'],
  ['item'=>'高品質キッチンツール（ル・クルーゼなど）','why'=>'毎日使える一生モノの道具は、使うたびに贈ってくれた人を思い出します。'],
  ['item'=>'上質なブランドバッグ','why'=>'毎日持ち歩くバッグは、長く愛用してもらえる喜ばれる贈り物です。'],
  ['item'=>'季節の花束＋オリジナルメッセージカード','why'=>'花の美しさと手書きの言葉を組み合わせたシンプルだけど心に刺さる贈り物。'],
  ['item'=>'香水（フレグランス）','why'=>'身につけるたびに贈った人を思い出してもらえる、特別な贈り物です。'],
  ['item'=>'体験型ギフト券（料理教室・陶芸・温泉など）','why'=>'モノより体験の思い出。二人で行けば距離もさらに縮まります。'],
  ['item'=>'旅行用スーツケース','why'=>'次の冒険をイメージさせるアイテム。旅好きな人には特に喜ばれます。'],
  ['item'=>'ルームフレグランス＋キャンドルセット','why'=>'家の空間を豊かにするアイテムは、毎晩その人を思いながら使ってもらえます。'],
  ['item'=>'観葉植物＋おしゃれな鉢','why'=>'育てる楽しさがあり、部屋に飾るたびに贈った人のことを思い出します。'],
  ['item'=>'フォトブック作成サービス','why'=>'二人の記録を形にするギフト。思い出を共有したいときの最高の贈り物。'],
  ['item'=>'アートポスター＋フレームセット','why'=>'部屋に飾れるアートは毎日目に入り、特別な存在感があります。'],
  ['item'=>'高品質な革製システム手帳','why'=>'計画を書き記す道具は、夢に向かって進む人に最高のプレゼントです。'],
  ['item'=>'プラネタリウムペアチケット','why'=>'二人で星空を見上げる体験がセットになった、思い出になる贈り物です。'],
  ['item'=>'高級レストランのペアディナー券','why'=>'記憶に残る食体験を贈ることで、特別な夜の思い出が生まれます。'],
  ['item'=>'スパ＆エステ体験券','why'=>'日々の疲れを癒してもらえる体験は、心から喜ばれます。'],
  ['item'=>'コーヒー・紅茶の高級ギフトセット','why'=>'毎朝のひとときを豊かにするアイテム。毎日使うものだから喜ばれます。'],
  ['item'=>'ハーブティーギフトセット＋マグカップ','why'=>'自分を癒す時間をプレゼント。忙しい人ほど喜ばれます。'],
  ['item'=>'ワイン・日本酒ギフトセット','why'=>'お酒好きの人には種類豊富なセットが特別な夜のお供になります。'],
  ['item'=>'ビジネス手帳＋万年筆セット','why'=>'夢を書き記す道具は、目標に向かって進む人への最高のギフトです。'],
  ['item'=>'Bluetoothスピーカー（高音質）','why'=>'音楽を高音質で楽しめる環境は、毎日の生活を豊かにします。'],
  ['item'=>'ワイヤレスイヤホン（AirPodsなど）','why'=>'音楽好きな人には毎日使うガジェットが実用的で喜ばれます。'],
  ['item'=>'スマートウォッチ・フィットネストラッカー','why'=>'健康意識の高い人に。毎日身につけるものだから特別感があります。'],
  ['item'=>'チェキ・インスタントカメラ','why'=>'二人の思い出を形に残せるカメラは、特別な瞬間を増やしてくれます。'],
  ['item'=>'スキンケアセット（高品質コスメ）','why'=>'毎日使うスキンケアに高品質なものを贈ることで、特別感が伝わります。'],
  ['item'=>'入浴剤＋バスソルトセット','why'=>'毎晩のお風呂時間を贅沢にできる、サプライズにもぴったりの贈り物です。'],
  ['item'=>'シルクのパジャマ・ナイトウェア','why'=>'肌に触れるものをグレードアップするギフトは、意外と喜ばれます。'],
  ['item'=>'名入れギフト（グラス・カッティングボードなど）','why'=>'世界にひとつのオリジナルアイテムは、特別感が抜群の贈り物です。'],
  ['item'=>'ペアグラス・ペアマグカップ','why'=>'日常的に使えるペアアイテムは、毎日の生活に相手を感じさせてくれます。'],
  ['item'=>'電動マッサージャー・ネックマッサージャー','why'=>'疲れた体を癒してくれるアイテムは、心からの「ありがとう」が伝わります。'],
  ['item'=>'高品質なブランケット・ひざ掛け','why'=>'冬に使うたびに温かい気持ちになれる、心のこもった贈り物です。'],
  ['item'=>'料理本（有名シェフ監修など）','why'=>'料理好きの人には丁寧に選んだレシピ本が新しい楽しみを届けます。'],
  ['item'=>'ヨガマット＋フィットネスグッズセット','why'=>'健康・美容に関心のある人に。自分磨きを後押しするプレゼントです。'],
  ['item'=>'アウトドアグッズ（テント・ランタン）','why'=>'アウトドア好きの人に。次の冒険をイメージさせるアイテムです。'],
  ['item'=>'チョコレート専門店のギフトボックス','why'=>'世界中のチョコレートが詰まったセットは、ちょっとした贅沢感があります。'],
  ['item'=>'パン・洋菓子の高級ギフトセット','why'=>'毎日のおやつ時間を豊かにする贈り物は、日常に彩りを添えます。'],
  ['item'=>'映画・音楽ストリーミングのギフトカード','why'=>'好きなコンテンツを楽しんでもらえる実用的かつ嬉しいギフトです。'],
  ['item'=>'プリザーブドフラワー（枯れない花）','why'=>'何年も飾れる花は、長く気持ちを届け続けてくれます。'],
  ['item'=>'ハンドクリーム＋ネイルケアセット','why'=>'手を毎日ケアするアイテムは、繊細な気遣いが伝わる贈り物です。'],
  ['item'=>'電子書籍リーダー（Kindle等）','why'=>'本好きな人に。いつでもどこでも好きな本を読める環境を贈ります。'],
  ['item'=>'ナイトクルーズ・花火クルーズのペアチケット','why'=>'普段とは違う夜を演出できる体験チケットは特別な思い出になります。'],
  ['item'=>'サウナグッズセット（サウナハット・桶など）','why'=>'サウナブームで人気急上昇。サウナ好きな人には最高の贈り物です。'],
  ['item'=>'コーヒーメーカー・全自動エスプレッソマシン','why'=>'カフェ好きな人に自宅でカフェ体験を届けるプレミアムギフトです。'],
  ['item'=>'グルメ食材セット（高級肉・海産物など）','why'=>'家での食事を豪華にできる食材ギフトは、喜ばれる定番の贈り物です。'],
  ['item'=>'アロマキャンドル＋バスグッズセット','why'=>'ゆっくり自分を癒す時間を作れる、リラックス系のプレゼントです。'],
  ['item'=>'ペットグッズ（おしゃれなケア用品セット）','why'=>'ペット好きな人には、愛する動物へのギフトが最高に喜ばれます。'],
  ['item'=>'知的系ボードゲーム・パズル','why'=>'二人で楽しめる知的な体験を贈れば、デートのきっかけにもなります。'],
  ['item'=>'旅行計画グッズ（ノート・ガイドブックセット）','why'=>'次の旅へのワクワクを一緒に届けるコンセプトギフトです。'],
  ['item'=>'ハンドメイド革小物体験チケット','why'=>'自分で作る体験チケットは、ユニークで記憶に残る贈り物です。'],
];

// ─── 結果計算 ─────────────────────────────────────────
$result=null; $errors=[];
$yourName   =htmlspecialchars(trim($_GET['your_name']   ??''),ENT_QUOTES,'UTF-8');
$partnerName=htmlspecialchars(trim($_GET['partner_name']??''),ENT_QUOTES,'UTF-8');
$ym=(int)($_GET['your_month']    ??0);
$yd=(int)($_GET['your_day']      ??0);
$pm=(int)($_GET['partner_month'] ??0);
$pd=(int)($_GET['partner_day']   ??0);

if($ym>0&&$yd>0&&$pm>0&&$pd>0){
  if($ym<1||$ym>12||$yd<1||$yd>31||$pm<1||$pm>12||$pd<1||$pd>31){
    $errors[]='月・日の入力値が正しくありません。';
  } else {
    $yZi=getZodiacIdx($ym,$yd); $pZi=getZodiacIdx($pm,$pd);
    $yZ=$ZODIAC[$yZi]; $pZ=$ZODIAC[$pZi];

    // 1990年固定でライフパスを計算（表示はしない）
    $yLP=calcLP(1990,$ym,$yd); $pLP=calcLP(1990,$pm,$pd);

    $seed=abs(crc32(sprintf('%02d%02d%02d%02d',$ym,$yd,$pm,$pd)));
    $base=zodiacScore($yZ['el'],$pZ['el']);
    $bonus=lpBonus($yLP,$pLP);

    $marriageScore=min(5,max(1,$base+$bonus+($seed%2)-1));
    $loverScore   =min(5,max(1,$base+(($seed>>3)%2)+$bonus-1+($yZ['el']!==$pZ['el']?1:0)));

    // 重み付き場所選択（70%日常 / 20%ギャグ / 10%海外）
    $wloc=function(int $s) use($DATE_LOC_DAILY,$DATE_LOC_GAG,$DATE_LOC_OVERSEAS):string{
      $cat=abs($s)%10;
      if($cat===0) return $DATE_LOC_OVERSEAS[abs($s>>4)%count($DATE_LOC_OVERSEAS)];
      if($cat<=2)  return $DATE_LOC_GAG[abs($s>>4)%count($DATE_LOC_GAG)];
      return $DATE_LOC_DAILY[abs($s>>4)%count($DATE_LOC_DAILY)];
    };
    $nT=count($DATE_TYPES);
    $loc1=$wloc($seed);
    $loc2=$wloc($seed*1013+7); if($loc2===$loc1) $loc2=$wloc($seed*1013+77);
    $t1=$seed%$nT;
    $t2=($seed>>12)%$nT; if($t2===$t1) $t2=($t2+1)%$nT;
    $dateSpot=[
      ['spot'=>$loc1.$DATE_TYPES[$t1]['type'],'desc'=>$DATE_TYPES[$t1]['desc']],
      ['spot'=>$loc2.$DATE_TYPES[$t2]['type'],'desc'=>$DATE_TYPES[$t2]['desc']],
    ];

    // 重み付きプレゼント接頭語選択（70%日常 / 20%ギャグ / 10%特別）
    $wpfx=function(int $s) use($PRESENT_PFX_DAILY,$PRESENT_PFX_GAG,$PRESENT_PFX_SPECIAL):string{
      $cat=abs($s)%10;
      if($cat===0) return $PRESENT_PFX_SPECIAL[abs($s>>4)%count($PRESENT_PFX_SPECIAL)];
      if($cat<=2)  return $PRESENT_PFX_GAG[abs($s>>4)%count($PRESENT_PFX_GAG)];
      return $PRESENT_PFX_DAILY[abs($s>>4)%count($PRESENT_PFX_DAILY)];
    };
    $nPi=count($PRESENT_ALL);
    $pfx1=$wpfx($seed*997+3);
    $pfx2=$wpfx($seed*983+11); if($pfx2===$pfx1) $pfx2=$wpfx($seed*983+111);
    $pi1=($seed>>16)%$nPi;
    $pi2=($seed>>20)%$nPi; if($pi2===$pi1) $pi2=($pi2+1)%$nPi;
    $present=[
      ['item'=>$pfx1.$PRESENT_ALL[$pi1]['item'],'why'=>$PRESENT_ALL[$pi1]['why']],
      ['item'=>$pfx2.$PRESENT_ALL[$pi2]['item'],'why'=>$PRESENT_ALL[$pi2]['why']],
    ];

    $confess='「'.
      $CONFESS_OPEN[$seed%count($CONFESS_OPEN)].
      $CONFESS_FEEL[($seed>>4)%count($CONFESS_FEEL)].
      $CONFESS_ASK[($seed>>8)%count($CONFESS_ASK)].'」';
    $confessTip=$CONFESS_TIPS[($seed>>12)%count($CONFESS_TIPS)];

    $result=compact('yZ','pZ','marriageScore','loverScore',
                    'confess','confessTip','dateSpot','present','yourName','partnerName',
                    'ym','yd','pm','pd');
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/aisho.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="二人の生年月日を入れるだけで相性を鑑定。結婚・恋愛の相性スコア、告白の言葉、おすすめデートスポット、プレゼントまで占います。">
<title>相性診断｜二人の運命を星と数字で占う</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
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
<link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#08060f;--card:#1e1738;--card2:#251d42;
  --border:rgba(160,130,220,.18);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8c96a;--violet:#9b72ef;--violet-lt:#c4a8f5;
  --rose:#e8719a;--teal:#4ecdc4;--text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;--ff-rpg:'DotGothic16',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--rose);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.6rem,5vw,2.6rem);font-weight:700;line-height:1.3;background:linear-gradient(135deg,var(--rose) 0%,var(--gold-lt) 50%,var(--violet-lt) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);line-height:1.8}
.form-card{background:var(--card);border:1px solid var(--border2);border-radius:16px;padding:2rem;margin-bottom:2rem;position:relative;overflow:hidden}
.form-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--rose),var(--gold),var(--violet))}
.form-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);margin-bottom:1.5rem;text-align:center}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem}
@media(max-width:600px){.form-grid{grid-template-columns:1fr}}
.form-group{margin-bottom:1rem}
.form-label{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.12em;color:var(--muted);display:block;margin-bottom:.45rem}
.form-input{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.7rem 1rem;font-family:var(--ff-sans);font-size:1rem;color:var(--text);outline:none;transition:border-color .2s}
.form-input:focus{border-color:var(--violet)}
select.form-input{background-color:#1e1738;color:var(--text);-webkit-appearance:none;appearance:none}
select.form-input option{background:#1e1738;color:var(--text)}
.person-card{background:rgba(0,0,0,.2);border:1px solid var(--border);border-radius:12px;padding:1.2rem}
.person-title{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--rose);margin-bottom:.8rem;text-align:center}
.person-title.you{color:var(--teal)}
.submit-btn{width:100%;padding:.9rem;background:linear-gradient(135deg,var(--rose),var(--violet));border:none;border-radius:10px;font-family:var(--ff-serif);font-size:1rem;font-weight:700;color:#fff;cursor:pointer;margin-top:1.2rem;letter-spacing:.1em;transition:opacity .2s}
.submit-btn:hover{opacity:.85}
.error-box{background:rgba(232,113,154,.1);border:1px solid rgba(232,113,154,.3);border-radius:8px;padding:.9rem 1.2rem;margin-bottom:1rem;font-size:.85rem;color:#e89090}

/* 有名人セクション */
.celeb-section{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:2rem;position:relative;overflow:hidden}
.celeb-section::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--rose))}
.celeb-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt);margin-bottom:.4rem}
.celeb-note{font-size:.72rem;color:var(--muted);margin-bottom:1rem;line-height:1.6}
.celeb-search{width:100%;background:rgba(155,114,239,.06);border:1px solid var(--border);border-radius:8px;padding:.55rem 1rem;font-family:var(--ff-sans);font-size:.9rem;color:var(--text);outline:none;margin-bottom:.8rem;transition:border-color .2s}
.celeb-search:focus{border-color:var(--gold)}
.celeb-list{display:flex;flex-wrap:wrap;gap:.4rem;max-height:180px;overflow-y:auto;margin-bottom:1rem}
.celeb-tag{font-family:var(--ff-mono);font-size:.68rem;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.25);border-radius:20px;padding:.3rem .75rem;color:var(--gold-lt);cursor:pointer;transition:background .15s;white-space:nowrap}
.celeb-tag:hover{background:rgba(201,168,76,.25)}
.celeb-tag.user-added{border-color:rgba(78,205,196,.3);background:rgba(78,205,196,.08);color:var(--teal)}
.celeb-add{display:flex;flex-direction:column;gap:.4rem;margin-top:.5rem}
.celeb-add-row{display:flex;gap:.5rem}
.celeb-add input{flex:1;min-width:0;background:rgba(78,205,196,.06);border:1px solid rgba(78,205,196,.2);border-radius:8px;padding:.5rem .8rem;font-family:var(--ff-sans);font-size:.85rem;color:var(--text);outline:none}
.celeb-add input:focus{border-color:var(--teal)}
@media(max-width:768px){
  .celeb-add{flex-direction:row;flex-wrap:wrap;gap:.4rem}
  .celeb-add-row{flex:1;min-width:0}
}
.celeb-add-btn{background:rgba(78,205,196,.15);border:1px solid rgba(78,205,196,.3);border-radius:8px;padding:.5rem 1rem;font-family:var(--ff-mono);font-size:.72rem;color:var(--teal);cursor:pointer;white-space:nowrap;transition:background .15s}
.celeb-add-btn:hover{background:rgba(78,205,196,.3)}
.celeb-del-btn{font-size:.6rem;color:var(--muted);margin-left:.3rem;cursor:pointer;vertical-align:middle}

/* 誕生日カレンダー */
.cal-section{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:2rem;position:relative;overflow:hidden}
.cal-section::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--violet),var(--rose))}
.cal-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--violet-lt);margin-bottom:.4rem}
.cal-note{font-size:.72rem;color:var(--muted);margin-bottom:1rem;line-height:1.6}
.cal-days{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:1rem}
.cal-day-btn{font-family:var(--ff-mono);font-size:.7rem;padding:.3rem .6rem;border-radius:6px;border:1px solid var(--border);background:rgba(155,114,239,.06);color:var(--muted);cursor:pointer;transition:all .15s}
.cal-day-btn:hover{background:rgba(155,114,239,.2);color:var(--violet-lt);border-color:var(--violet)}
.cal-day-btn.active{background:rgba(155,114,239,.3);color:var(--violet-lt);border-color:var(--violet)}
.cal-names{display:flex;flex-wrap:wrap;gap:.4rem;min-height:2rem}
.cal-name-tag{font-family:var(--ff-mono);font-size:.68rem;background:rgba(155,114,239,.1);border:1px solid rgba(155,114,239,.3);border-radius:20px;padding:.3rem .75rem;color:var(--violet-lt);cursor:pointer;transition:background .15s;white-space:nowrap}
.cal-name-tag:hover{background:rgba(155,114,239,.3)}
.cal-empty{font-family:var(--ff-mono);font-size:.68rem;color:var(--muted)}
.cal-month-tabs{display:flex;gap:.4rem;margin-bottom:.8rem;flex-wrap:wrap}
.cal-month-btn{font-family:var(--ff-mono);font-size:.7rem;padding:.3rem .9rem;border-radius:16px;border:1px solid var(--border);background:rgba(155,114,239,.06);color:var(--muted);cursor:pointer;transition:all .15s}
.cal-month-btn:hover{background:rgba(155,114,239,.15);color:var(--violet-lt)}
.cal-month-btn.active{background:rgba(155,114,239,.3);color:var(--violet-lt);border-color:var(--violet)}

/* 結果 */
.result-wrap{animation:fadeIn .8s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.result-header{text-align:center;padding:2rem 0 1.5rem;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
.pair-display{display:flex;align-items:center;justify-content:center;gap:1rem;margin-bottom:1rem;flex-wrap:wrap}
.pair-sign{text-align:center}
.pair-sym{font-size:2.2rem;line-height:1}
.pair-name{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-top:.2rem}
.pair-heart{font-size:1.8rem}
.overall-score{font-family:var(--ff-serif);font-size:3.5rem;font-weight:700;background:linear-gradient(135deg,var(--rose),var(--gold-lt));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1}
.overall-label{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em;margin-top:.3rem}
.result-block{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:1.5rem;margin-bottom:1.2rem;position:relative;overflow:hidden}
.result-block::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
.rb-marriage::before{background:linear-gradient(90deg,var(--gold),var(--gold-lt))}
.rb-lover::before{background:linear-gradient(90deg,var(--rose),var(--violet))}
.rb-confess::before{background:linear-gradient(90deg,var(--violet),var(--teal))}
.rb-date::before{background:linear-gradient(90deg,var(--teal),var(--gold))}
.rb-present::before{background:linear-gradient(90deg,var(--rose),var(--gold))}
.rb-label{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.18em;color:var(--muted);margin-bottom:.6rem}
.rb-title{font-family:var(--ff-serif);font-size:1.05rem;font-weight:600;color:var(--gold-lt);margin-bottom:.8rem}
.stars-row{display:flex;gap:.3rem;margin-bottom:.5rem}
.star{font-size:1.4rem;color:rgba(255,255,255,.12)}
.star.on{color:var(--gold)}
.rb-score-txt{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted)}
.rb-text{font-size:.9rem;line-height:1.9;color:var(--text)}
.rb-text strong{color:var(--gold-lt)}
.confess-quote{font-family:var(--ff-serif);font-size:1.05rem;font-style:italic;color:var(--violet-lt);line-height:1.9;padding:1rem 1.2rem;background:rgba(155,114,239,.08);border-left:3px solid var(--violet);border-radius:0 8px 8px 0;margin-bottom:.6rem}
.affiliate-box{display:flex;align-items:center;justify-content:space-between;gap:1rem;background:rgba(201,168,76,.06);border:1px dashed rgba(201,168,76,.3);border-radius:10px;padding:1rem 1.2rem;margin-top:.8rem;flex-wrap:wrap}
.affiliate-item{flex:1;min-width:0}
.affiliate-name{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt);margin-bottom:.3rem}
.affiliate-why{font-size:.8rem;color:var(--muted);line-height:1.7}
.affiliate-btn{display:inline-block;padding:.5rem 1.2rem;background:linear-gradient(135deg,var(--gold),rgba(201,168,76,.7));border-radius:20px;font-family:var(--ff-mono);font-size:.7rem;color:#1a1000;font-weight:600;text-decoration:none;white-space:nowrap;cursor:pointer;border:none;transition:opacity .2s;flex-shrink:0}
.affiliate-btn:hover{opacity:.85}
.retry-btn{width:100%;background:none;border:1px solid var(--border2);border-radius:8px;padding:.65rem;font-family:var(--ff-mono);font-size:.75rem;color:var(--muted);cursor:pointer;margin-top:.5rem;transition:color .2s,border-color .2s;text-decoration:none;display:block;text-align:center}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}
.article-link-box{display:flex;align-items:center;gap:.9rem;background:rgba(155,114,239,.06);border:1px solid rgba(155,114,239,.25);border-radius:12px;padding:1rem 1.2rem;margin-top:1rem;text-decoration:none;transition:border-color .2s,background .2s}
.article-link-box:hover{border-color:var(--violet-lt);background:rgba(155,114,239,.12)}
.article-link-icon{font-size:1.4rem;flex-shrink:0}
.article-link-body{display:flex;flex-direction:column;gap:.2rem;flex:1}
.article-link-body strong{font-family:var(--ff-sans);font-size:.9rem;font-weight:500;color:var(--violet-lt)}
.article-link-body small{font-size:.75rem;color:var(--muted)}
.article-link-arrow{color:var(--violet-lt);font-family:var(--ff-mono);font-size:.9rem;flex-shrink:0}
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
.tool-desc{background:linear-gradient(135deg,rgba(201,168,76,.07),rgba(155,114,239,.06));border:1px solid rgba(160,130,220,.2);border-radius:14px;padding:1.3rem 1.6rem;margin-bottom:1.5rem}
.tool-desc p{font-size:.88rem;color:rgba(232,226,245,.78);line-height:1.9;margin-bottom:.6rem}
.tool-desc p:last-child{margin-bottom:0}
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
/* 2カラムレイアウト */
.main-layout{display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;margin-bottom:2rem}
.main-col{}
.sidebar-col{position:sticky;top:70px}
/* サイドバー内のceleb/calはmargin-bottomのみ */
.sidebar-col .celeb-section{margin-bottom:1.2rem}
.sidebar-col .cal-section{margin-bottom:0}
@media(max-width:768px){
  .main-layout{grid-template-columns:1fr}
  .sidebar-col{position:static;order:2}
  .main-col{order:1}
}
</style>
</head>
<body>
<?php $currentPage='aisho'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">Compatibility Fortune</span>
    <h1>相性診断｜星座×数秘術で恋愛・結婚の相性を占う</h1>
    <p class="hero-sub">生年月日を入力するだけで、星座と数秘術から<br>二人の恋愛・結婚相性を鑑定します。</p>
  </section>

  <div class="adsense-space"></div>

  <div class="tool-desc">
    <p>相性占いは、あなたと大切な人の生年月日や星座の組み合わせから、二人の価値観の傾向や惹かれ合うポイントを読み解く占術です。</p>
    <p>このセルフ鑑定ツールでは、お互いの生年月日を入力するだけで、恋愛・仕事・友人としての相性を自動で算出します。お互いへの理解を深め、より良い関係を築くための参考にどうぞ。</p>
  </div>

  <!-- 2カラムレイアウト -->
  <div class="main-layout">

    <!-- 左：メインカラム（フォーム＋結果） -->
    <div class="main-col">

      <!-- フォーム -->
      <div class="form-card">
        <div class="form-title">✦ 誕生日を入力 ✦</div>
        <?php if(!empty($errors)):?>
        <div class="error-box"><?=implode('<br>',$errors)?></div>
        <?php endif;?>
        <form method="get" action="">
          <div class="form-grid">
            <div class="person-card">
              <div class="person-title you">💙 あなた</div>
              <div class="form-group">
                <label class="form-label">お名前（任意）</label>
                <input class="form-input" type="text" name="your_name" id="your_name"
                  value="<?=$yourName?>" placeholder="例：山田さん">
              </div>
              <div class="form-group">
                <label class="form-label">誕生日</label>
                <div style="display:flex;gap:.5rem;align-items:center">
                  <select class="form-input" name="your_month" id="your_month" required style="flex:1">
                    <option value="">月</option>
                    <?php for($i=1;$i<=12;$i++):?>
                    <option value="<?=$i?>"<?=$ym===$i?' selected':''?>><?=$i?>月</option>
                    <?php endfor;?>
                  </select>
                  <select class="form-input" name="your_day" id="your_day" required style="flex:1">
                    <option value="">日</option>
                    <?php for($i=1;$i<=31;$i++):?>
                    <option value="<?=$i?>"<?=$yd===$i?' selected':''?>><?=$i?>日</option>
                    <?php endfor;?>
                  </select>
                </div>
              </div>
            </div>
            <div class="person-card">
              <div class="person-title">💗 お相手</div>
              <div class="form-group">
                <label class="form-label">お名前（任意）</label>
                <input class="form-input" type="text" name="partner_name" id="partner_name"
                  value="<?=$partnerName?>" placeholder="例：田中さん">
              </div>
              <div class="form-group">
                <label class="form-label">誕生日</label>
                <div style="display:flex;gap:.5rem;align-items:center">
                  <select class="form-input" name="partner_month" id="partner_month" required style="flex:1">
                    <option value="">月</option>
                    <?php for($i=1;$i<=12;$i++):?>
                    <option value="<?=$i?>"<?=$pm===$i?' selected':''?>><?=$i?>月</option>
                    <?php endfor;?>
                  </select>
                  <select class="form-input" name="partner_day" id="partner_day" required style="flex:1">
                    <option value="">日</option>
                    <?php for($i=1;$i<=31;$i++):?>
                    <option value="<?=$i?>"<?=$pd===$i?' selected':''?>><?=$i?>日</option>
                    <?php endfor;?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="submit-btn">💘 相性を鑑定する</button>
        </form>
      </div>

      <!-- 結果 -->
      <?php if($result):
        $r=$result;
        $yLabel=$r['yourName']!==''?$r['yourName'].'さん':'あなた';
        $pLabel=$r['partnerName']!==''?$r['partnerName'].'さん':'お相手';
        $marriageScores=[1=>'縁遠い',2=>'普通',3=>'相性まずまず',4=>'相性良好',5=>'運命的な相手'];
        $loverScores  =[1=>'ドキドキ少なめ',2=>'穏やかな関係',3=>'楽しい恋人',4=>'情熱的な恋',5=>'運命の恋人'];
      ?>
      <div class="result-wrap" id="result">
    <div class="result-header">
      <div class="pair-display">
        <div class="pair-sign">
          <div class="pair-sym"><?=$r['yZ']['sym']?></div>
          <div class="pair-name"><?=$r['yZ']['name']?></div>
        </div>
        <div class="pair-heart">💕</div>
        <div class="pair-sign">
          <div class="pair-sym"><?=$r['pZ']['sym']?></div>
          <div class="pair-name"><?=$pLabel?> <?=$r['pZ']['name']?></div>
        </div>
      </div>
      <div class="overall-score"><?=round(($r['marriageScore']+$r['loverScore'])/10*100)?>%</div>
      <div class="overall-label">TOTAL COMPATIBILITY</div>
    </div>

    <!-- 結婚 -->
    <div class="result-block rb-marriage">
      <div class="rb-label">MARRIAGE SCORE</div>
      <div class="rb-title">💍 結婚に向いている度</div>
      <div class="stars-row">
        <?php for($i=1;$i<=5;$i++):?>
        <span class="star<?=$i<=$r['marriageScore']?' on':''?>">★</span>
        <?php endfor;?>
      </div>
      <div class="rb-score-txt"><?=$marriageScores[$r['marriageScore']]?></div>
      <p class="rb-text" style="margin-top:.7rem">
        <?=$yLabel?>（<?=$r['yZ']['name']?>）と<?=$pLabel?>（<?=$r['pZ']['name']?>）の組み合わせは、
        <?php if($r['yZ']['el']===$r['pZ']['el']):?>
        同じ<strong><?=$r['yZ']['el']?></strong>のエレメント同士。価値観が近く、長期的な安定が期待できる相性です。
        <?php elseif(in_array([$r['yZ']['el'],$r['pZ']['el']],[['火','風'],['風','火'],['水','地'],['地','水']])):?>
        <strong><?=$r['yZ']['el']?></strong>と<strong><?=$r['pZ']['el']?></strong>の補い合う相性。お互いの弱点を支え合える理想的な関係です。
        <?php else:?>
        異なるエレメント同士ですが、だからこそ相手から学べることが多い刺激的な関係になります。
        <?php endif;?>
      </p>
    </div>

    <!-- 恋人 -->
    <div class="result-block rb-lover">
      <div class="rb-label">LOVER SCORE</div>
      <div class="rb-title">💓 恋人に向いている度</div>
      <div class="stars-row">
        <?php for($i=1;$i<=5;$i++):?>
        <span class="star<?=$i<=$r['loverScore']?' on':''?>">★</span>
        <?php endfor;?>
      </div>
      <div class="rb-score-txt"><?=$loverScores[$r['loverScore']]?></div>
      <p class="rb-text" style="margin-top:.7rem">
        恋愛においては、<?=$r['pZ']['name']?>の
        <?php
          $charms=['山羊座'=>'堅実さと深い愛情','水瓶座'=>'独自の世界観と知的な会話',
                   '魚座'=>'包み込むような優しさ','牡羊座'=>'情熱とストレートな表現',
                   '牡牛座'=>'揺るぎない安心感と誠実さ','双子座'=>'軽やかなユーモアと好奇心',
                   '蟹座'=>'深い愛情と細やかな気遣い','獅子座'=>'華やかな存在感とリード力',
                   '乙女座'=>'誠実さと丁寧な愛し方','天秤座'=>'優雅な雰囲気とバランス感覚',
                   '蠍座'=>'情熱的な一途さと深み','射手座'=>'自由な発想と前向きなエネルギー'];
          echo $charms[$r['pZ']['name']]??'魅力';
        ?>があなたを惹きつけるポイントになりそうです。
      </p>
    </div>

    <!-- 告白の言葉 -->
    <div class="result-block rb-confess">
      <div class="rb-label">CONFESSION WORDS</div>
      <div class="rb-title">💌 <?=$pLabel?>へ・こんな一言はいかがですか？<span style="font-size:.7rem;color:var(--teal);font-family:var(--ff-mono);margin-left:.5rem">（おすすめ）</span></div>
      <div class="confess-quote"><?=$r['confess']?></div>
      <p class="rb-text" style="font-size:.78rem">💡 <?=$r['confessTip']?></p>
    </div>

    <!-- デートスポット -->
    <div class="result-block rb-date">
      <div class="rb-label">DATE SPOT</div>
      <div class="rb-title">🗺️ おすすめデートスポット</div>
      <div class="affiliate-box">
        <?php foreach($r['dateSpot'] as $ds): ?>
        <div class="affiliate-item">
          <div class="affiliate-name">📍 <?=$ds['spot']?></div>
          <div class="affiliate-why"><?=$ds['desc']?></div>
          <!-- アフィリエイトURL設定後にこの行を有効化: <a class="affiliate-btn" href="【URL】">詳しく見る →</a> -->
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- プレゼント -->
    <div class="result-block rb-present">
      <div class="rb-label">LUCKY PRESENT</div>
      <div class="rb-title">🎁 運気が上がるプレゼント</div>
      <div class="affiliate-box">
        <?php foreach($r['present'] as $pr): ?>
        <div class="affiliate-item">
          <div class="affiliate-name">✨ <?=$pr['item']?></div>
          <div class="affiliate-why"><?=$pr['why']?></div>
          <!-- アフィリエイトURL設定後にこの行を有効化: <a class="affiliate-btn" href="【URL】">商品を探す →</a> -->
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- シェア -->
    <?php require __DIR__.'/inc/share-btns.php'; ?>

        <?php
        $articleUrl   = '/articles/aisho/';
        $articleIcon  = '📖';
        $articleTitle = '相性診断とは？';
        $articleDesc  = '誕生日・血液型・星座で相性を占う仕組みを解説';
        $contextKey   = 'aisho';
        $retryLabel   = 'もう一度診断する';
        $retryType    = 'link';
        $retryValue   = '/aisho.php';
        require __DIR__.'/inc/result-footer.php';
        ?>
      </div>
      <script>document.addEventListener('DOMContentLoaded',function(){scrollToResult('result');});</script>
      <?php endif;?>

    </div><!-- /main-col -->

    <!-- 右：サイドバー（有名人＋カレンダー） -->
    <div class="sidebar-col">

      <!-- 有名人セクション -->
      <div class="celeb-section">
        <div class="celeb-title">💫 有名人の誕生日から選ぶ</div>
        <p class="celeb-note">※誕生日データは一般公開情報を元にしています。正確性は保証されません。参考としてお楽しみください。<br>自分で追加したデータはこのブラウザに保存されます。</p>
        <input type="text" class="celeb-search" placeholder="名前で検索..." id="celebSearch" oninput="filterCelebs()">
        <div class="celeb-list" id="celebList"></div>
        <div style="font-family:var(--ff-mono);font-size:.62rem;color:var(--teal);margin-bottom:.4rem">+ 有名人を追加する</div>
        <div class="celeb-add">
          <div class="celeb-add-row">
            <input type="text" id="celebNameInput" placeholder="名前（例：山田花子）">
          </div>
          <div class="celeb-add-row">
            <input type="date" id="celebBirthInput">
            <button class="celeb-add-btn" onclick="addCeleb()">追加</button>
          </div>
        </div>
      </div>

      <!-- 誕生日カレンダー -->
      <div class="cal-section">
        <div class="cal-title">📅 誕生日カレンダーから選ぶ</div>
        <p class="cal-note">※日付ボタンをタップすると、その日が誕生日の有名人が表示されます。名前をタップするとお相手欄に自動入力されます。<br>誕生日データは参考情報です。正確性は保証されません。年は参考値として1990年を使用しています。</p>
        <div class="cal-month-tabs" id="calMonthTabs"></div>
        <div class="cal-days" id="calDays"></div>
        <div class="cal-names" id="calNames"><span class="cal-empty">日付を選んでください</span></div>
      </div>

    </div><!-- /sidebar-col -->

  </div><!-- /main-layout -->

  <div class="adsense-space"></div>
</div>

<p style="max-width:900px;margin:0 auto 1.5rem;padding:0 1.2rem;text-align:center;font-size:.72rem;color:var(--muted);line-height:1.8">本サービスはエンターテインメントを目的とした占いコンテンツです。結果は楽しみや気づきの参考としてご活用ください。</p>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
// ─── 誕生日カレンダーデータ（1月）──────────────────
const BIRTHDAY_DB = {
  '01-01':['尾田栄一郎','堂本光一','箕輪はるか','ポール・リビア','J・D・サリンジャー','ベッツィ・ロス','雪村千鶴','木之本桜','四葉環','爆豪勝己'],
  '01-02':['アイザック・アシモフ','キューバ・グッディング・ジュニア','浦沢直樹','竹野内豊','豊口めぐみ','水樹奈々','カルナ','鏡音リン','猿飛アスマ','神宮寺レン'],
  '01-03':['メル・ギブソン','マイケル・シューマッハ','ダンテ・アリギエーリ','岩下志麻','柳葉敏郎','小沢真珠','ロロノア・ゾロ','日向ネジ','七海建人','我妻善逸'],
  '01-04':['アイザック・ニュートン','ティルダ・スウィントン','マイケル・スタイプ','竹内力','衛藤美彩','子安武人','緑谷出久','竈門炭治郎','沖田総悟','朽木ルキア'],
  '01-05':['宮崎駿','ロバート・デュヴァル','ダイアン・キートン','深水元基','小池徹平','元ちとせ','モンキー・D・ルフィ','黒崎一護','爆豪勝己','シエル・ファントムハイヴ'],
  '01-06':['エディ・レッドメイン','ローワン・アトキンソン','大場つぐみ','CHAGE','中畑清','ノーマン・リーダス','不死川玄弥','神楽','渚カヲル','トラファルガー・ロー'],
  '01-07':['ニコラス・ケイジ','ルイス・ハミルトン','ケニー・ロギンス','水木一郎','青木琴美','森政弘','うずまきナルト','五条悟','エレン・イェーガー','キリト'],
  '01-08':['エルヴィス・プレスリー','デヴィッド・ボウイ','スティーヴン・ホーキング','小泉純一郎','田中裕二','井上麻里奈','綾波レイ','煉獄杏寿郎','アスナ','伏黒恵'],
  '01-09':['リチャード・ニクソン','ジミー・ペイジ','デイヴ・マシューズ','岸部一徳','伴都美子','岡本真夜','冨岡義勇','日番谷冬獅郎','神威','我愛羅'],
  '01-10':['ロッド・スチュワート','ジョージ・フォアマン','パット・ベネター','財前直見','田中裕二','三浦建太郎','嘴平伊之助','サンジ','キルア＝ゾルディック','碇シンジ'],
  '01-11':['デヴィッド・ボウイ','深津絵里','持田香織','メアリー・J・ブライジ','アマンダ・ピート','ジェイミー・ヴァーディ','カカシ','中野三玖','エミリア','轟焦凍'],
  '01-12':['村上春樹','ジェフ・ベック','オリバー・プラット','楠田枝里子','井上雄彦','ロビー・ベンソン','ベジータ','ミカサ・アッカーマン','朽木白哉','我妻由乃'],
  '01-13':['オーランド・ブルーム','リーアム・ヘムズワース','秋本治','中山優馬','柴田純','パトリック・デンプシー','孫悟空','エドワード・エルリック','江戸川コナン','めぐみん'],
  '01-14':['三島由紀夫','デイヴ・グロール','LL・クール・J','玉木宏','山崎弘也','田中真弓','綾小路清隆','夜神月','時透無一郎','セイバー'],
  '01-15':['マーティン・ルーサー・キング・ジュニア','ピットブル','樹木希林','吉岡里帆','石原良純','アリストテレス・オナシス','リヴァイ','竈門禰豆子','坂田銀時','惣流・アスカ・ラングレー'],
  '01-16':['ケイト・モス','ジョン・カーペンター','リン＝マニュエル・ミランダ','藪宏太','木下隆行','桂文枝','ロロノア・ゾロ','日向翔陽','レム','伊黒小芭内'],
  '01-17':['モハメド・アリ','ジム・キャリー','ミシェル・オバマ','山口百恵','平井堅','坂本龍一','我愛羅','嘴平伊之助','影山飛雄','ゼロツー'],
  '01-18':['ケビン・コスナー','オリバー・ハーディ','キャリー・グラント','ビートたけし','中山忍','長谷部誠','黒崎一護','エレン・イェーガー','宇髄天元','キルア＝ゾルディック'],
  '01-19':['エドガー・アラン・ポー','ジャニス・ジョプリン','ドリー・パートン','松任谷由実','宇多田ヒカル','柴門ふみ','冨岡義勇','ベジータ','アルフォンス・エルリック','赤司征十郎'],
  '01-20':['フェデリコ・フェリーニ','デヴィッド・リンチ','レイン・ウィルソン','南果歩','IKKO','矢口真里','竈門炭治郎','五条悟','モンキー・D・ルフィ','ミカサ・アッカーマン'],
  '01-21':['プラシド・ドミンゴ','ジーナ・デイヴィス','ロビー・ベンソン','京本政樹','水樹奈々','稲盛和夫','胡蝶しのぶ','サスケ','及川徹','アルミン・アルレルト'],
  '01-22':['ダイアン・レイン','リンダ・ブレア','フランシス・ベーコン','中田英寿','高橋惠子','HEATH','我妻善逸','エース','爆豪勝己','エドワード・エルリック'],
  '01-23':['ジャンゴ・ラインハルト','ジョン・ハンコック','千葉真一','葉加瀬太郎','トリンドル玲奈','吉田鋼太郎','日向翔陽','煉獄杏寿郎','キリト','江戸川コナン'],
  '01-24':['ニール・ダイアモンド','ナスターシャ・キンスキー','エド・ヘルムズ','五輪真弓','岩井俊二','前田日明','禪院真希','竈門禰豆子','ロロノア・ゾロ','エレン・イェーガー'],
  '01-25':['ヴァージニア・ウルフ','アリシア・キーズ','毛利元就','北野誠','さとう宗幸','石ノ森章太郎','伏黒恵','リヴァイ','トラファルガー・ロー','うちはイタチ'],
  '01-26':['ポール・ニューマン','エレン・デジェネレス','エディ・ヴァン・ヘイレン','長嶋一茂','hitomi','綾小路翔','中野一花','胡蝶カナエ','ヒソカ','アスナ'],
  '01-27':['モーツァルト','ルイス・キャロル','ブリジット・フォンダ','雛形あきこ','清水ミチコ','三田寛子','中野二乃','我妻善逸','エース','爆豪勝己'],
  '01-28':['ジャクソン・ポロック','イライジャ・ウッド','アラン・アルダ','乙葉','新庄剛志','星野源','中野三玖','時透無一郎','キルア＝ゾルディック','五条悟'],
  '01-29':['アントン・チェーホフ','オプラ・ウィンフリー','トム・セレック','濱口優','宝生舞','きゃりーぱみゅぱみゅ','中野四葉','伊之助','サンジ','夜神月'],
  '01-30':['フランクリン・ルーズベルト','ジーン・ハックマン','フィル・コリンズ','石川さゆり','吉村由美','春風亭昇太','中野五月','禪院真希','冨岡義勇','リヴァイ'],
  '01-31':['フランツ・シューベルト','ジャスティン・ティンバーレイク','ケリー・リンチ','真矢みき','香取慎吾','石野真子','中野五月','伏黒恵','ロロノア・ゾロ','ミカサ・アッカーマン'],
  '02-01':['クラーク・ゲーブル','ブランドン・リー','リサ・マリー・プレスリー','布袋寅泰','磯野貴理子','吉沢亮','胡蝶しのぶ','うちはサスケ','影山飛雄','アスナ'],
  '02-02':['ジェームズ・ジョイス','ファラ・フォーセット','シャキーラ','劇団ひとり','浅尾美和','桐山照史','我妻善逸','ロロノア・ゾロ','綾波レイ','キルア＝ゾルディック'],
  '02-03':['ノーマン・ロックウェル','モーガン・フェアチャイルド','ネイサン・レイン','川合俊一','有田哲平','柳原可奈子','竈門炭治郎','五条悟','モンキー・D・ルフィ','エレン・イェーガー'],
  '02-04':['ローザ・パークス','アリス・クーパー','ナタリー・インブルーリア','石破茂','時任三郎','桐谷健太','冨岡義勇','夜神月','リヴァイ','ベジータ'],
  '02-05':['ハンク・アーロン','クリスティアーノ・ロナウド','ネイマール','大地真央','中島美嘉','山田五郎','嘴平伊之助','サンジ','ミカサ・アッカーマン','伏黒恵'],
  '02-06':['ボブ・マーリー','フランソワ・トリュフォー','リック・アストリー','福山雅治','坂井泉水','小沢仁志','宇髄天元','キリト','エドワード・エルリック','赤司征十郎'],
  '02-07':['チャールズ・ディケンズ','クリス・ロック','アシュトン・カッチャー','向井理','香坂みゆき','石毛宏典','我愛羅','煉獄杏寿郎','アルミン・アルレルト','キルア＝ゾルディック'],
  '02-08':['ジュール・ヴェルヌ','ジャック・レモン','ジェームズ・ディーン','田中卓志','松下奈緒','高岡蒼佑','冨岡義勇','サスケ','夜神月','リヴァイ'],
  '02-09':['ミア・ファロー','ジョー・ペシ','トム・ヒドルストン','ラモス瑠偉','春日俊彰','鈴木亜美','五条悟','ロロノア・ゾロ','竈門炭治郎','綾波レイ'],
  '02-10':['バート・レイノルズ','ロブ・トーマス','エマ・ロバーツ','島田洋七','市川由衣','川口春奈','嘴平伊之助','トラファルガー・ロー','エレン・イェーガー','ベジータ'],
  '02-11':['トーマス・エジソン','ジェニファー・アニストン','シェリル・クロウ','鳩山由紀夫','ホリ','山本モナ','煉獄杏寿郎','キリト','リヴァイ','エース'],
  '02-12':['エイブラハム・リンカーン','チャールズ・ダーウィン','フランコ・ゼフィレッリ','下平さやか','榮倉奈々','市川美織','うちはイタチ','時透無一郎','夜神月','赤司征十郎'],
  '02-13':['ピーター・ガブリエル','ロビー・ウィリアムズ','ジェリー・スプリンガー','南原清隆','出川哲朗','有村架純','胡蝶しのぶ','ロロノア・ゾロ','我愛羅','ミカサ・アッカーマン'],
  '02-14':['マイケル・ブルームバーグ','サイモン・ペッグ','フレデリック・ダグラス','酒井法子','ヒロシ','JUJU','竈門炭治郎','サンジ','アルミン・アルレルト','ベジータ'],
  '02-15':['ガリレオ・ガリレイ','マット・グレーニング','クリストファー・マクドナルド','堀ちえみ','浅田美代子','インリン','五条悟','エレン・イェーガー','嘴平伊之助','キルア＝ゾルディック'],
  '02-16':['ジョン・マッケンロー','アイス-T','リロイ・サンチェス','オダギリジョー','香椎由宇','相川七瀬','胡蝶しのぶ','ロロノア・ゾロ','綾波レイ','夜神月'],
  '02-17':['マイケル・ジョーダン','パリス・ヒルトン','エド・シーラン','吉瀬美智子','YUKI','舞の海秀平','竈門炭治郎','我愛羅','ミカサ・アッカーマン','赤司征十郎'],
  '02-18':['ジョン・トラボルタ','マット・ディロン','ヨーコ・オノ','影山ヒロノブ','Dr.コパ','安藤サクラ','冨岡義勇','キリト','リヴァイ','エース'],
  '02-19':['ニコラウス・コペルニクス','スモーキー・ロビンソン','ジェフ・ダニエルズ','藤岡弘','かとうれいこ','村上龍','嘴平伊之助','サスケ','アルミン・アルレルト','ベジータ'],
  '02-20':['カート・コバーン','シンディ・クロフォード','リアーナ','志村けん','森田剛','小出恵介','五条悟','トラファルガー・ロー','エレン・イェーガー','時透無一郎'],
  '02-21':['ニーナ・シモン','アラン・リックマン','ジェニファー・ラブ・ヒューイット','要潤','酒井美紀','ハイヒール・モモコ','リヴァイ','我妻善逸','キルア＝ゾルディック','夜神月'],
  '02-22':['ジョージ・ワシントン','ドリュー・バリモア','ジェームズ・ブラント','陣内智則','高崎晃','渡瀬マキ','ロロノア・ゾロ','うちはイタチ','エレン・イェーガー','ベジータ'],
  '02-23':['ジョージ・フレデリック・ヘンデル','ピーター・フォンダ','ダコタ・ファニング','中島みゆき','野口五郎','亀梨和也','冨岡義勇','サンジ','ミカサ・アッカーマン','赤司征十郎'],
  '02-24':['スティーブ・ジョブズ','ビリー・ゼイン','フロイド・メイウェザー','草野仁','ASKA','北山たけし','竈門炭治郎','我愛羅','キリト','エース'],
  '02-25':['ピエール＝オーギュスト・ルノワール','ジョージ・ハリスン','ティア・レオーニ','寺脇康文','森久保祥太郎','最上もが','五条悟','嘴平伊之助','アルミン・アルレルト','トラファルガー・ロー'],
  '02-26':['ヴィクトル・ユーゴー','ジョニー・キャッシュ','エリカ・バドゥ','三浦知良','桑田佳祐','藤本美貴','煉獄杏寿郎','ロロノア・ゾロ','リヴァイ','ベジータ'],
  '02-27':['エリザベス・テイラー','ジョアン・ベネット','アダム・ボールドウィン','徳永英明','富野由悠季','新沼謙治','竈門炭治郎','うちはサスケ','エレン・イェーガー','赤司征十郎'],
  '02-28':['ミケランジェロ','ブライアン・ジョーンズ','ジェイソン・アルディーン','田原俊彦','菊川怜','芳根京子','我妻善逸','トラファルガー・ロー','キルア＝ゾルディック','夜神月'],
  '02-29':['ジョアキーノ・ロッシーニ','ハーマン・ホレリス','デニス・ファリーナ','飯島直子','峰竜太','赤川次郎','冨岡義勇','ミカサ・アッカーマン','サンジ','五条悟'],
  '03-01':['野川さくら','中山美穂','エミ・マイヤー','斉藤秀翼','音無さやか','野本かりあ','西川弘志','水原ゆき','平沢麗奈','美波わかな','中津留章仁','成田梨紗','大野真緒','床田寛樹','三浦弦太','李俊龍','ウォノ','Newspeak','MeloMance','KnightA-騎士A-'],
  '03-02':['トン・ニノ','浅野愛子','島崎和歌子','佐藤史果','伊澤麻璃也','岡本菜摘','水萌みず','亜里沙','秋田真琴','藤崎直','前田利恵','千葉れみ','小倉星羅','小川千菜美','小林麗菜','早川諒','松山友紀','宮内龍汰','イ・ホンギ','ウォンビン','キム・ダヨン','川尻蓮','桃鈴ねね'],
  '03-03':['川島海荷','中野公美子','ムラタメグミ','永井裕子','影山一郎','山口桃子','吉沢明歩','荒井萌','坂口杏里','岡野洋祐','権田修一','猶本光','有永一生','ソン・ユリ','パク・チョロン','ユジン','キム・ボラ','神楽坂淳','柴田柚菜','花咲みやび'],
  '03-04':['真崎ゆか','笹峯愛','関口愛美','田口華','藤井梨央','小林弥生','中村蒼','相楽樹','中村世渚','細田善彦','牧野翔矢','山岡哲也','セリン','TOMORROW X TOGETHER','shela'],
  '03-05':['テディ','引田香織','矢野妃菜喜','山口茜','松山ケンイチ','忍成修吾','山田まりや','山本一輝','志尊淳','後藤駿太','田中耀飛','永井謙佑','イェリ','杉山愛佳','鈴木絢音','さくらみこ'],
  '03-06':['嗣永桃子','有村竜太朗','小泉真也','ベッキー','南壽あさ子','松下洸平','中島礼香','時田愛梨','七海薫子','嘉門洋子','大森拓郎','岩田剛典','山根和馬','西野勇士','青木亮太','チョア'],
  '03-07':['間宮梨花','はねだえりか','菊池風磨','羽賀朱音','田野優花','永山絢斗','山川恵里佳','矢作穂香','姫野昂志','櫻井敦司','チェ・ジョンフン','イム・ヒョンシク','IRyS'],
  '03-08':['須藤元気','桜井和寿','佐武宇綺','松井珠理奈','山口乃々華','立花彩野','藤澤ノリマサ','増田俊樹','橋本大翔','愛川あやの','和田桜子','竹内実生','内田讓','前田知恵','原愛実','山崎裕太','カン・ヒョンホ','ユン・ジソン','チェ・ウンジョン','小嶋菜月','髙地優吾','天宮こころ'],
  '03-09':['西尾悦子','カノン','千葉雄大','水谷瞬','テヨン','チュ・ハンニョン','ソ・スジン','チョン・ソミ','イ・ウンジュ','加藤るみ','稲熊ひな','SUGA'],
  '03-10':['藤井隆','米津玄師','杉浦太陽','永尾まりや','高橋光臣','篠原愛実','川本まゆ','廣井ゆう','斉藤みのり','広瀬仁美','高橋理','ミル','プニエル','林美澪'],
  '03-11':['土屋アンナ','東山奈央','ピコ','滝ありさ','高木延秀','篠田麻里子','ささの友間','児玉真菜','川口翔子','新山のぞみ','菊池涼介','三浦伊織','西舘勇陽','鈴木研一','中澤日菜子','安田叶'],
  '03-12':['椎名へきる','ユースケ・サンタマリア','小田さくら','小野真弓','ØMI','我那覇美奈','斎藤千和','大塚千弘','坂田将人','有吉優樹','吉住晴斗','西森正明','ダイアモンド☆ユカイ','江崎ひかる','アーニャ・メルフィッサ'],
  '03-13':['中島健人','羽多野渉','南里侑香','小渕健太郎','向井太一','五十嵐玲央','大東駿介','夏目鈴','星野大地','佐藤輝明','イライ','クォン・ナラ','エル','ボムギュ','スミン','矢作有紀奈','片岡成美'],
  '03-14':['出口陽','姿月あさと','仲村みう','磯貝龍虎','青木崇高','岡田絵里香','酒井高徳','山崎亮平','高田一憲','ムン・ヒジュン','行天優莉奈','谷口愛理','坂井新奈','オーロ・クロニー'],
  '03-15':['北乃きい','梅田悠','豊田萌絵','大谷映美里','有安杏果','渋谷桃子','渋江譲二','かとうかな子','マイコ','上尾野辺めぐみ','田中舜','ユギョン','ジンジン','仲村和泉','博衣こより','根本凪'],
  '03-16':['工藤晴香','野島健児','坂上庸介','高野千恵','花谷麻妃','永田杏奈','咲妃みゆ','濵口遥大','土岐田洸平','田口泰士','高丘陽平','北川莉央'],
  '03-17':['藤森慎吾','神谷えり','早見あかり','玉森裕太','髙木俊','冨手麻妙','内村賢介','香川真司','笠原祥太郎','スユン','石田千穂','中西アルノ'],
  '03-18':['西野カナ','上西恵','黒田俊介','渡部真一','寺田拓哉','坂田めぐみ','吉井怜','守田菜生','松本華奈','岩渕真奈','立仙愛理','ベスティア・ゼータ','Annabel'],
  '03-19':['市川実和子','下川みくに','宮脇咲良','後藤浩輝','矢野奨吾','佐藤翔','小林豊','宇野愛海','金丸将也','田城飛翔','ジュヨン','桜もこ','ソン・ウンソク','犬塚あさな'],
  '03-20':['大石恵','岸本梓','井上正大','遠藤雄弥','野村佑香','今井仁美','吉川あいみ','大谷龍太','清武功暉','湊あかね','オク・チュヒョン','サンドゥル','ヒョンジン','梅田綾乃','小久保柚乃','不知火フレア','真柴あずき'],
  '03-21':['佐藤健','東山義久','水沢エレナ','加藤良輔','秋吉亮','金光栄大','イ・ジン','ユンサナ','アントン','三島ゆたか','森杏奈','セレス・ファウナ','山猿','音尾琢真'],
  '03-22':['土岐麻子','橋本美加子','大石参月','田辺修斗','島村幸大','服部美穂','鈴木博志','ハ・ソンウン','永野恵','八木愛月','川後陽菜','星街すいせい','ミライアカリ'],
  '03-23':['千賀健永','山本琴乃','夢輝のあ','黒木あすか','諸星あずな','安藤咲桜','紗倉まな','小池城太朗','川口翔平','平田良介','遠藤一星','宇賀神友弥','ロンジュン','佐藤楓','武元唯衣'],
  '03-24':['綾瀬はるか','持田香織','丹下桜','村上雄信','青木瑠璃子','竜星涼','初音映莉子','大津祐樹','パク・ボム','中野愛理','山田麻莉奈','鈴木裕乃'],
  '03-25':['はいだしょうこ','Machico','中里アミ','佐藤峻','原田善友','小山翔平','西川史礁','小深田大地','宮舘涼太','miko','小谷嘉一'],
  '03-26':['渡辺麻友','髙木雄也','清水愛','後藤久美子','相川茉穂','松本嘉菜','三好康児','ソン・ホヨン','シウミン','キム・キョンジュ','ハンドン','ミレ','チュ・ミジョン','中林里茉'],
  '03-27':['悠木碧','嶋村瞳','知花くらら','南翔太','八代目市川染五郎','内田篤人','リサ','ヨウォン','イ・ジフン','永野芹佳','鶴崎仁香','弦月藤士郎'],
  '03-28':['岸尾だいすけ','いとうかなこ','島津亜矢','高橋龍輝','小林彩子','高宮千夏','武子直輝','吉川麻衣子','大平真嗣','安田良子','根本慎太郎','ビキ','イ・ホウォン','ジャクソン','出口恵理','要ゆうじ'],
  '03-29':['里田まい','滝沢秀明','松澤由美','傳田真央','篠原ともえ','高田由香','屋宜照悟','河野大樹','箭内翔太','ユ・ソヨン','ソルリ','アイリーン','江籠裕奈','工藤理子','深川麻衣','柏木ひなた'],
  '03-30':['川澄綾子','小松未歩','新谷良子','岡田淳一','96猫','島崎遥香','マリウス葉','橋爪大佑','イ・ギグァン','チャウヌ','ソン・ミンホ','宮里莉羅','村瀬紗英','女王蜂'],
  '03-31':['坂本真綾','宮迫博之','日高慎二','バン・ヨングク','キム・ボヒョン','ク・ジュンフェ','山崎将平','倉内沙莉','大川雅大','山岸門人','斎藤幸乃','平川蓮','根本悠楓'],
  '04-01':['モモイヒトミ','岡本圭人','伊藤智恵理','岸本ゆめの','杉本有美','竹内結子','日高優月','柴田阿弥','夜霧','健屋花那'],
  '04-02':['Zeebra','浪川大輔','林勇','村田琳','凪沙','下野由貴','宮崎由加','花芽すみれ'],
  '04-03':['大泉洋','山田菜々','前田公輝','我那覇美紀','黒沢薫','髙橋海人','大場美奈','パク・ジョンミン','星化','下尾みう'],
  '04-04':['菅谷梨沙子','伊藤美裕','朝長真弥','ウニョク','ジホ','西野未姫','森カリオペ','ムーナ・ホシノヴァ'],
  '04-05':['三浦春馬','山田まりや','中田あすみ','イ・ジェウォン','渡辺温斗','木全翔也'],
  '04-06':['宮沢りえ','森本龍太郎','ミンギュ','ケン','相笠萌','内木志','勝田里奈'],
  '04-07':['島袋寛子','竹財輝之助','玉山鉄二','チェ・シウォン','長井陽菜'],
  '04-08':['沢尻エリカ','高橋みなみ','高橋瞳','遠藤久美子','ジョンヒョン','勝村摩耶'],
  '04-09':['山下智久','天野浩成','ユグォン','ユイ','平岡海月'],
  '04-10':['堂本剛','木村佳乃','ミッツ・マングローブ','新井ひとみ','黒沢ともよ','セミ'],
  '04-11':['有岡大貴','真野恵里菜','露崎春女','岸明日香','前田健太','ダニエル','カリナ'],
  '04-12':['鈴木愛理','吉澤ひとみ','藤原基央','セフン','谷口愛季','上村ひなの'],
  '04-13':['中元日芽香','水島ヒロ','ナンシー','ジウ','大平祥生'],
  '04-14':['谷本貴義','工藤静香','ジョヒョン','ユン','古石ビジュー','こぼ・かなえる'],
  '04-15':['安田レイ','大谷映美里','有安杏果','キム・ナムジュ','キム・グクホン'],
  '04-16':['BONNIE PINK','池田エライザ','小芝風花','岡崎慎司','カン・スンシク','緑仙'],
  '04-17':['リュジン','ホンソク','ジノ','熊沢世莉奈','NCT DOJAEJUNG'],
  '04-18':['上地雄輔','星村麻衣','Fayray','ジェシカ','大園玲'],
  '04-19':['小嶋陽菜','チョウミ','ヒムチャン','御伽原江良'],
  '04-20':['鹿晗','チ・スヨン','野中美郷','音乃瀬奏'],
  '04-21':['下野紘','高木紗友希','安田美沙子','チェ・ヒョンソク','ヘイン'],
  '04-22':['斉藤壮馬','千葉雄喜','リュ・ヒョヨン','青木詩織','天音かなた'],
  '04-23':['阿部サダヲ','諸星すみれ','森山直太朗','ジェノ','チェヨン','和田まあや','長沢菜々香'],
  '04-24':['名塚佳織','山本梓','本田圭佑','ヨンミン'],
  '04-25':['森永理科','ジェイ・パーク','キム・ジョングク','小田えりな'],
  '04-26':['蒼井そら','野口衣織','ナム・ギュリ','D-LITE','三山凌輝'],
  '04-27':['鈴木杏','南乃彩希','ワン・フェイフェイ','松田好花','間野春香'],
  '04-28':['大橋歩夕','豊永利行','逢坂ここあ','江口のりこ','ソングユ','ウォンピル','宮田愛萌'],
  '04-29':['鈴木まりや','武藤彩未','堀内まり菜'],
  '04-30':['EXILE ATSUSHI','小袋成彬','三浦祐太朗','柳英里紗','ウヨン','樋渡結依'],
  '05-01':['吉川友','小山慶一郎','坂本美雨','イ・チャンミン','ハニ','ミミ','金澤有希','奏手イヅル'],
  '05-02':['北出菜奈','佐藤利奈','Pile','チョン・ジヌン','ソンミ','ベンベン','馬場彩華'],
  '05-03':['森翼','平井大'],
  '05-04':['小野大輔','光永亮太','伊藤沙莉','谷花音','音ノ乃のの'],
  '05-05':['中川翔子','与田祐希','深澤辰哉','ソン・ジウン','ナウン','風楽奏斗'],
  '05-06':['ベクヒョン','ダソム','ファンヒ','井上春華','金城碧海'],
  '05-07':['紺野あさ美','窪塚洋介','佐藤優樹','段原瑠々','林田真尋','レイナ','バン・イェダム','ミンジ','荒井優希','原田葵','石森虹花'],
  '05-08':['たかはし智秋','飛蘭','杉﨑寧々','パン・ジミン','影山優佳','明楽レイ'],
  '05-09':['山田涼介','横山裕','平原綾香','ジョンウ','向井純葉'],
  '05-10':['船木結','志田未来','ベ・ジニョン','向田茉夏'],
  '05-11':['Dream Ami','イム・スロン','フィヨン','長久玲奈'],
  '05-12':['石黒彩','中西智代梨','池田瑛紗'],
  '05-13':['岩田華怜','熊田曜子','パン・ミナ'],
  '05-14':['橋本みゆき','吉野紗香','ジヘ','イ・チェヨン','ダヨン','周防パトラ'],
  '05-15':['南明奈','山本涼介','西野七瀬','ヘリン','ときのそら'],
  '05-16':['今井麻美','大倉忠義','横尾渉','イ・シヨン','桜井玲香','渡辺梨加'],
  '05-17':['井ノ原快彦','坂井真紀','朝長美桜','ジユ','岩本照'],
  '05-18':['瀬戸康史','ホ・ガユン','鈴木佑捺'],
  '05-19':['久保ユリカ','神木隆之介','E:U','永島聖羅'],
  '05-20':['河村隆一','後藤萌咲','菅本裕子'],
  '05-21':['梨花','河野マリナ','パク・ギュリ','山崎怜奈'],
  '05-22':['田中麗奈','スホ','ヤン・イェナ','イム・ジミン'],
  '05-23':['夏菜','Eve','板垣心和','ロボ子さん'],
  '05-24':['松下優也','上杉昇','イヴ','一ノ瀬美空'],
  '05-25':['石田ひかり','上野樹里','SHINee','橋本陽菜','北野瑠華','西野七瀬','ラプラス・ダークネス'],
  '05-26':['つるの剛士','SEVENTEEN','イェジ','伊藤かりん','イェウン'],
  '05-27':['本田理沙','清竜人','キム・ジェファン','ウンソ','松本利夫'],
  '05-28':['黒木メイサ','鞘師里保','林明日香','佐々木莉佳子','ダヒョン','上西怜'],
  '05-29':['早見沙織','高橋美佳子','金田朋子','パク・ジフン','田中裕二'],
  '05-30':['釘宮理恵','保志総一朗','内田朝陽','石川由依','福士蒼汰','ヒョミン','ウナ','小嶋真子','豆原一成'],
  '05-31':['やなぎなぎ','山内惠介','眞鍋かをり','本村碧唯'],
  '06-01':['玉置成実','村川梨衣','本田望結','堀あかり','ドン','前田亜美','樋口楓'],
  '06-02':['沢城みゆき','齋藤彩夏','團遥香','乾貴士','花芽なずな'],
  '06-03':['やくしまるえつこ','潘めぐみ','長澤まさみ','三浦翔平','チョ・スンヒ','シンビ'],
  '06-04':['玉井詩織','ファーストサマーウイカ','鈴木拡樹','ユチョン','チェリ'],
  '06-05':['中島愛','駿河太郎','チェリョン','北澤早紀'],
  '06-06':['キム・ヒョナ','ヘチャン','角巻わため','オリバー・エバンス','アステル・レダ'],
  '06-07':['矢部美穂','ジヨン','トニー・アン','名取稚菜','田中優香','轟はじめ'],
  '06-08':['野中藍','宮野真守','小関裕太','ウン・ジウォン','イ・ジニョク','筒井あやめ'],
  '06-09':['国仲涼子','三枝夕夏','植田佳奈','ヘリ','シム・ヒョンソン'],
  '06-10':['松たか子','ジュン','リゼ・ヘルエスタ'],
  '06-11':['新垣結衣','栗林みな実','佐々木彩夏','ジェシー','吉本実憂'],
  '06-12':['川島茉樹代','室田瑞希','丸高愛実','井上瑠夏','小林歌穂'],
  '06-13':['加賀美セイラ','佐々木恵梨','野波麻帆','ジンソル','ソン・ハンビン'],
  '06-14':['溝端淳平','比嘉愛未','中川大志','ムン・テイル','ツウィ','壱百満天原サロメ'],
  '06-15':['miwa','日高里菜','南沢奈央','ホシ','田中樹','村山彩希'],
  '06-16':['星野英彦','シヌゥ'],
  '06-17':['二宮和也','辻希美','波瑠','鈴木福','風間俊介','菊池雄星','桐生ココ'],
  '06-18':['三吉彩花','岡本玲','谷村美月','矢吹奈子','ショヌ','アリン','松村北斗'],
  '06-19':['中澤裕子','佐咲紗花','広瀬すず','松原夏海'],
  '06-20':['May J.','鬼龍院翔','相武紗季','カン・テオ','栗原紗英','がうる・ぐら'],
  '06-21':['岡井千聖','高城れに','手嶌葵','リョウク','向井康二'],
  '06-22':['加藤ミリヤ','伊野尾慧','加藤ローサ','ジョン・ヨンファ','沙花叉クロヱ'],
  '06-23':['芦田愛菜','竹達彩奈','シシド・カフカ','チェ・ドンハ','川西拓実'],
  '06-24':['LiSA','北原里英','ニックン','鈴原るる'],
  '06-25':['松浦亜弥','藤ヶ谷太輔','平手友梨奈'],
  '06-26':['ペク・イェリン','岡田栞奈'],
  '06-27':['安本彩花','本田翼','優香','ラウール','大竹ひとみ','若月佑美'],
  '06-28':['分島花音','三森すずこ','昆夏美','濱田岳','カン・ミンヒョク','ソヒョン','山﨑愛生'],
  '06-29':['菅原紗由理','木村昴','シン・ドンホ','上野圭澄'],
  '06-30':['天月-あまつき-','夏帆','菊地あやか','キズナアイ'],
  '07-01':['チャラン・ポ・ランタン','AZKi','イトゥク'],
  '07-02':['三宅健','金澤朋子','大空スバル'],
  '07-03':['板野友美','岡崎体育','賀来賢人'],
  '07-04':['増田貴久','菊地最愛','ユン・ドゥジュン'],
  '07-05':['山田優','大谷翔平','宝鐘マリン'],
  '07-06':['齊藤なぎさ','小鳥遊キアラ'],
  '07-07':['生田衣梨奈','真彩希帆'],
  '07-08':['古畑星夏','パク・キョン'],
  '07-09':['草彅剛','Aimer','池松壮亮'],
  '07-10':['前田敦子','田中圭','キム・ヒチョル','森田ひかる'],
  '07-11':['加藤シゲアキ'],
  '07-12':['百田夏菜子','石橋杏奈','インソン','鈴谷アキ'],
  '07-13':['道重さゆみ','のん'],
  '07-14':['山本彩','久保史緒里'],
  '07-15':['柏木由紀','橋本良亮','森本慎太郎'],
  '07-16':['宇野実彩子','山田哲人','小嶋花梨','勇気ちひろ'],
  '07-17':['井上玲音','北野日奈子'],
  '07-18':['広末涼子','テミン','山本美月'],
  '07-19':['藤木直人','オ・ハヨン'],
  '07-20':['石神のぞみ'],
  '07-21':['はるな愛','SoRi','ベクホ'],
  '07-22':['吉高由里子','タブロ','夏色まつり'],
  '07-23':['内田彩','ファサ','後藤楽々','河田陽菜','伏見ガク'],
  '07-24':['坂本昌行','水川あさみ','ハン・スンヨン'],
  '07-25':['仲俣汐里','平山遊季'],
  '07-26':['秋元才加','加藤夏希','山下美月'],
  '07-27':['星野真里','渡邉理佐','ヒュニン・バヒエ'],
  '07-28':['矢井田瞳','逢沢りな','ヒョジョン','レオス・ヴィンセント'],
  '07-29':['望月理世','村重杏奈','五百城茉央'],
  '07-30':['木村良平','宮崎美穂','小瀧望'],
  '07-31':['愛内里菜','遠藤舞','ニコラス・エドワーズ','リジ'],
  '08-01':['和田彩花','ティファニー・ヤング','ヨンウ','キム・チェウォン','黒川智花','柊瑠美','清宮レイ'],
  '08-02':['マーク','ジョンア'],
  '08-03':['熊井友理奈','白石隼也','カン・ミンギョン','キム・ヒョンジュン'],
  '08-04':['白濱亜嵐','七詩ムメイ','小野ゆり子'],
  '08-05':['柴咲コウ','王一博','シヒョン','チョ・スンヨン'],
  '08-06':['奥菜恵','石原夏織','麻生夏子','二階堂高嗣'],
  '08-07':['ロウン','大西流星','藤嶌果歩'],
  '08-08':['逢田梨香子','橋本マナミ','エスクプス','シャオジュン','賀喜遥香','常闇トワ'],
  '08-09':['木南晴夏','ファン・ミニョン','中村一葉'],
  '08-10':['安倍なつみ','中島裕翔','速水もこみち','齋藤飛鳥','赤井はあと'],
  '08-11':['蒼井翔太','チャンビン'],
  '08-12':['宮澤佐江','ルナ','チェ・ユジン','電脳少女シロ'],
  '08-13':['篠原涼子','ジェミン','ユン・ボミ'],
  '08-14':['ゴンチャン','ヒュニンカイ','矢久保美緒'],
  '08-15':['岡田将生','小倉唯','ナオト・インティライミ','椎名唯華'],
  '08-16':['西田ひかる','斉藤朱夏','リナ・サワヤマ','ダルビッシュ有','ニエル'],
  '08-17':['華原朋美','戸田恵梨香','山本由伸','オム・ジョンファ'],
  '08-18':['中居正広','成海璃子','鈴木誠也','G-DRAGON','チョン・ウンジ'],
  '08-19':['ディーン・フジオカ','チョンジン','オムジ','エリン','ボナ'],
  '08-20':['白石麻衣','森山未來','秋元真夏','カウン','大神ミオ'],
  '08-21':['萩原聖人','ソン・スンヒョン','キム・キボム'],
  '08-22':['斎藤工','菅野美穂','北川景子','チョン・ソミン'],
  '08-23':['五十嵐健人','東村芽依','中井りか'],
  '08-24':['三浦大知','NCT DREAM','吉田麻也','イェソン','ボミン','早川聖来'],
  '08-25':['夏焼雅','クリス・ハート','オン・ソンウ','ドウン','渋谷凪咲'],
  '08-26':['重岡大毅','キム・ミンソク','キム・ユンジ'],
  '08-27':['剛力彩芽','松村沙友理','イ・ソンヨル','猫又おかゆ'],
  '08-28':['福原遥','雨宮天','AK-69','チョ・グォン','金世正'],
  '08-29':['片寄涼太','浜辺美波','千葉翔也','藤吉夏鈴','ソンフン'],
  '08-30':['松本潤','チャオ・ルー','ホ・ヨンジ'],
  '08-31':['桐山照史','チャン・ウォニョン','本間ひまわり'],
  '09-01':['JUNG KOOK','アン・ユジン','三浦理恵子'],
  '09-02':['今市隆二','鈴木くるみ'],
  '09-03':['梶裕貴','染谷将太','ジョイ','浅倉樹々'],
  '09-04':['島谷ひとみ','中丸雄一','あの','長濱ねる'],
  '09-05':['BoA','齊藤京子'],
  '09-06':['氷川きよし','百鬼あやめ'],
  '09-07':['山﨑賢人','小坂菜緒'],
  '09-08':['本仮屋ユイカ','関智一','獅白ぼたん'],
  '09-09':['大塚愛','酒井若菜','堀米悠斗'],
  '09-10':['松田翔太','上木彩矢','金村美玖'],
  '09-11':['倉持明日香','安田章大','大島麻衣'],
  '09-12':['長友佑都','RM','田中美久'],
  '09-13':['ヨンジュン','玉置浩二','大園桃子'],
  '09-14':['上戸彩','安達祐実','ジコ','ハン'],
  '09-15':['アンジェラ・アキ','フィリックス'],
  '09-16':['森下純菜','山岸奈津美'],
  '09-17':['松岡禎丞','北山宏光','ユア'],
  '09-18':['大貫亜美','大森靖子','杉野遥亮','エンバ','冨里奈央'],
  '09-19':['西川貴教','渡辺美優紀'],
  '09-20':['安室奈美恵','堀江由衣','一青窈','ガイン'],
  '09-21':['二階堂ふみ','チェン','ミナ','不破湊'],
  '09-22':['今井絵理子','宮近海斗','ジニョン','ヒョヨン'],
  '09-23':['後藤真希','キー','ウギ','寺田蘭世'],
  '09-24':['早乙女太一','イ・テイル','瀧野由美子'],
  '09-25':['高槻かなこ'],
  '09-26':['上間綾乃','キム・ジヌ'],
  '09-27':['中田敦彦','内田理央','クォン・ウンビ','髙橋未来虹'],
  '09-28':['山﨑天','工藤由愛'],
  '09-29':['岸優太','チェ・イェナ'],
  '09-30':['今泉佑唯'],
  '10-01':['神田沙也加','鈴木みのり','戌神ころね'],
  '10-02':['杉咲花','林瑠奈'],
  '10-03':['高橋朱里','遠藤さくら'],
  '10-04':['上田竜也','岩立沙穂','ジョンハン'],
  '10-05':['小野賢章','白上フブキ'],
  '10-06':['堀北真希','本田仁美'],
  '10-07':['生田斗真','加藤和樹'],
  '10-08':['平野綾','ウエンツ瑛士','ホ・ユンジン'],
  '10-09':['長野博','夏川りみ'],
  '10-10':['栗山千明','ペ・スジ','姫森ルーナ'],
  '10-11':['秦基博','金城武'],
  '10-12':['ともさかりえ','伊藤美来'],
  '10-13':['益若つばさ','石川界人','JIMIN'],
  '10-14':['白間美瑠','ちゃんみな'],
  '10-15':['水原希子','ドンヘ','ヒスン','堀未央奈'],
  '10-16':['瀧本美織'],
  '10-17':['大島優子','松坂桃李'],
  '10-18':['仲里依紗','まふまふ'],
  '10-19':['ヒジン'],
  '10-20':['山田孝之','チュウ'],
  '10-21':['May\'n','田村芽実','太田遥香'],
  '10-22':['チョ・ユリ','B.I'],
  '10-23':['渡辺直美','ミンニ','ニンニン','小林由依'],
  '10-24':['木村カエラ','クリスタル','上國料萌衣'],
  '10-25':['高垣彩陽','リノ'],
  '10-26':['飯田里穂','中本悠太'],
  '10-27':['青山テルマ','工藤遥','キム・ウソク'],
  '10-28':['倉木麻衣','豊崎愛生'],
  '10-29':['YURiKA'],
  '10-30':['仲間由紀恵','鬼束ちひろ','佐藤勝利','ジゼル'],
  '10-31':['須田亜香里','山本耕史'],
  '11-01':['小倉優子','ジョンヨン','渡辺みり愛'],
  '11-02':['深田恭子','諏訪ななか','パク・ウジン'],
  '11-03':['錦戸亮','北村匠海','そらる','佐々木朗希'],
  '11-04':['尾野真千子','T.O.P'],
  '11-05':['鈴木このみ','BoA','渡辺翔太'],
  '11-06':['SUPER JUNIOR','ウー・イーファン','大矢真那'],
  '11-07':['長瀬智也','片瀬那奈','ディエイト'],
  '11-08':['高橋メアリージュン','チェウォン','物述有栖'],
  '11-09':['モモ','笹木咲','葛葉'],
  '11-10':['田中れいな','手越祐也','本間日陽'],
  '11-11':['鈴木達央','チェ・ミンファン','アルランディス'],
  '11-12':['ナナヲアカリ','パク・サンダラ','平祐奈'],
  '11-13':['木村拓哉','倖田來未'],
  '11-14':['小池美波'],
  '11-15':['峯岸みなみ','髙橋優斗','本郷奏多','雪花ラミィ'],
  '11-16':['内田有紀','パク・ヒョンシク','佐藤詩織'],
  '11-17':['城島茂','ユギョム'],
  '11-18':['岡田准一','渡辺満里奈','名取さな'],
  '11-19':['ゴウォン'],
  '11-20':['山崎エリイ','小池栄子','久保怜音'],
  '11-21':['指原莉乃','キム・ドンワン'],
  '11-22':['aiko','清水佐紀','ウジ','キヒョン','川島如恵留'],
  '11-23':['竹内朱莉'],
  '11-24':['井之脇海','白銀ノエル'],
  '11-25':['武藤十夢','ケビン'],
  '11-26':['大野智','丸山隆平','福山潤','剣持刀也'],
  '11-27':['浅野忠信','チャンヨル','阿部亮平'],
  '11-28':['河北麻友子'],
  '11-29':['田口淳之介','菅井友香','ミニョク'],
  '11-30':['満島ひかり','知念侑李','藍井エイル'],
  '12-01':['宮本佳林','任時完','湊あくあ','花譜'],
  '12-02':['八乙女光','水瀬いのり'],
  '12-03':['高岡早紀','壇蜜','入山杏奈','京本大我'],
  '12-04':['JIN'],
  '12-05':['観月ありさ','太田奈緒'],
  '12-06':['保田圭','林遣都'],
  '12-07':['桜田通','松尾レミ'],
  '12-08':['横山由依','稲垣吾郎','ミンホ'],
  '12-09':['高橋一生','NI-KI'],
  '12-10':['カン・ダニエル','新田恵海'],
  '12-11':['広瀬アリス','ヒョリン'],
  '12-12':['瀬戸朝香','加藤あい','貫地谷しほり','V.I'],
  '12-13':['家入レオ','永山瑛太'],
  '12-14':['高畑充希','オニュ','井上小百合'],
  '12-15':['ジュンス'],
  '12-16':['桐谷美玲','DECO*27'],
  '12-17':['福田明日香','Jessi','佐々木美玲'],
  '12-18':['絢香','戌亥とこ'],
  '12-19':['反町隆史','佐藤江梨子'],
  '12-20':['中元すず香','道枝咲'],
  '12-21':['馬嘉伶','松本日向'],
  '12-22':['忽那汐里','ムンビョル'],
  '12-23':['亀井絵里','倉科カナ','坂口渚沙'],
  '12-24':['相葉雅紀','石原さとみ','中村倫也'],
  '12-25':['武井咲'],
  '12-26':['城田優','小栗旬','小栗有以'],
  '12-27':['内田真礼','テギョン','稲場愛香'],
  '12-28':['新川優愛','大家志津香'],
  '12-29':['生駒里奈','サナ'],
  '12-30':['藤原さくら','植村あかり','ユナ'],
  '12-31':['市井紗耶香'],
};

(function(){
  const MONTHS = [
    {mm:'01', label:'1月', days:31},
    {mm:'02', label:'2月', days:29},
    {mm:'03', label:'3月', days:31},
    {mm:'04', label:'4月', days:30},
    {mm:'05', label:'5月', days:31},
    {mm:'06', label:'6月', days:30},
    {mm:'07', label:'7月', days:31},
    {mm:'08', label:'8月', days:31},
    {mm:'09', label:'9月', days:30},
    {mm:'10', label:'10月', days:31},
    {mm:'11', label:'11月', days:30},
    {mm:'12', label:'12月', days:31},
  ];
  const tabsEl  = document.getElementById('calMonthTabs');
  const daysEl  = document.getElementById('calDays');
  const namesEl = document.getElementById('calNames');
  let activeDay = null;
  let activeMonthBtn = null;

  function renderDays(mm, days) {
    daysEl.innerHTML = '';
    namesEl.innerHTML = '<span class="cal-empty">日付を選んでください</span>';
    activeDay = null;
    for (let d = 1; d <= days; d++) {
      const key = mm + '-' + String(d).padStart(2,'0');
      if (!BIRTHDAY_DB[key]) continue;
      const btn = document.createElement('button');
      btn.className = 'cal-day-btn';
      btn.textContent = d + '日';
      btn.onclick = () => {
        if (activeDay) activeDay.classList.remove('active');
        btn.classList.add('active');
        activeDay = btn;
        namesEl.innerHTML = '';
        BIRTHDAY_DB[key].forEach(n => {
          const s = document.createElement('span');
          s.className = 'cal-name-tag';
          s.textContent = n;
          s.onclick = () => selectFromCal(n, key);
          namesEl.appendChild(s);
        });
      };
      daysEl.appendChild(btn);
    }
  }

  MONTHS.forEach((m, i) => {
    const btn = document.createElement('button');
    btn.className = 'cal-month-btn' + (i === 0 ? ' active' : '');
    btn.textContent = m.label;
    btn.onclick = () => {
      if (activeMonthBtn) activeMonthBtn.classList.remove('active');
      btn.classList.add('active');
      activeMonthBtn = btn;
      renderDays(m.mm, m.days);
    };
    tabsEl.appendChild(btn);
    if (i === 0) activeMonthBtn = btn;
  });

  renderDays(MONTHS[0].mm, MONTHS[0].days);
})();

function selectFromCal(name, mmdd) {
  // mmdd = '01-15' など
  const parts = mmdd.split('-');
  document.getElementById('partner_month').value = parseInt(parts[0]);
  document.getElementById('partner_day').value = parseInt(parts[1]);
  document.getElementById('partner_name').value = name;
  document.getElementById('partner_name').closest('form').scrollIntoView({behavior:'smooth', block:'start'});
}

// ─── 有名人データ ──────────────────────────────────
const PRESET_CELEBS = [
  {name:'大谷翔平',      birth:'1994-07-05'},
  {name:'石原さとみ',    birth:'1986-12-24'},
  {name:'新垣結衣',      birth:'1988-06-11'},
  {name:'菅田将暉',      birth:'1993-02-21'},
  {name:'橋本環奈',      birth:'1999-02-03'},
  {name:'山崎賢人',      birth:'1994-09-07'},
  {name:'有村架純',      birth:'1993-02-13'},
  {name:'吉沢亮',        birth:'1994-01-31'},
  {name:'広瀬すず',      birth:'1998-06-19'},
  {name:'坂口健太郎',    birth:'1991-06-07'},
  {name:'星野源',        birth:'1981-01-28'},
  {name:'本田翼',        birth:'1992-06-27'},
  {name:'浜崎あゆみ',    birth:'1978-10-02'},
  {name:'木村拓哉',      birth:'1972-11-13'},
  {name:'二宮和也',      birth:'1983-06-17'},
  {name:'松本潤',        birth:'1983-08-30'},
  {name:'BTS RM',        birth:'1994-09-12'},
  {name:'BTS ジョングク',birth:'1997-09-01'},
  {name:'藤原竜也',      birth:'1982-05-15'},
  {name:'綾瀬はるか',    birth:'1985-03-24'},
  {name:'長澤まさみ',    birth:'1987-06-03'},
  {name:'福山雅治',      birth:'1969-02-06'},
  {name:'宮崎あおい',    birth:'1985-11-30'},
  {name:'堺雅人',        birth:'1973-10-14'},
  {name:'天海祐希',      birth:'1967-08-08'},
];

const LS_KEY = 'lf_celebs_v1';

function getUserCelebs() {
  try { return JSON.parse(localStorage.getItem(LS_KEY)||'[]'); } catch(e){ return []; }
}
function saveUserCelebs(arr) {
  localStorage.setItem(LS_KEY, JSON.stringify(arr));
}

function allCelebs() {
  return [...PRESET_CELEBS, ...getUserCelebs()];
}

function renderCelebs(filter='') {
  const list = document.getElementById('celebList');
  const userCelebs = getUserCelebs();
  const userNames = new Set(userCelebs.map(c=>c.name));
  const all = allCelebs();
  const filtered = filter ? all.filter(c=>c.name.includes(filter)) : all;

  list.innerHTML = '';
  filtered.forEach(c => {
    const isUser = userNames.has(c.name);
    const span = document.createElement('span');
    span.className = 'celeb-tag' + (isUser ? ' user-added' : '');
    span.textContent = c.name;
    span.onclick = () => selectCeleb(c.birth, c.name);
    if (isUser) {
      const del = document.createElement('span');
      del.className = 'celeb-del-btn';
      del.textContent = '✕';
      del.onclick = (e) => { e.stopPropagation(); deleteCeleb(c.name); };
      span.appendChild(del);
    }
    list.appendChild(span);
  });
}

function filterCelebs() {
  renderCelebs(document.getElementById('celebSearch').value.trim());
}

function selectCeleb(birth, name) {
  // birth = 'YYYY-MM-DD' or 'MM-DD'
  const parts = birth.split('-');
  const m = parts.length === 3 ? parseInt(parts[1]) : parseInt(parts[0]);
  const d = parts.length === 3 ? parseInt(parts[2]) : parseInt(parts[1]);
  document.getElementById('partner_month').value = m;
  document.getElementById('partner_day').value = d;
  document.getElementById('partner_name').value = name;
  document.getElementById('partner_name').closest('form').scrollIntoView({behavior:'smooth', block:'start'});
}

function addCeleb() {
  const name = document.getElementById('celebNameInput').value.trim();
  const birth = document.getElementById('celebBirthInput').value;
  if (!name || !birth) { alert('名前と生年月日を入力してください'); return; }
  const arr = getUserCelebs();
  if (arr.find(c=>c.name===name)) { alert('すでに登録されています'); return; }
  arr.push({name, birth});
  saveUserCelebs(arr);
  document.getElementById('celebNameInput').value = '';
  document.getElementById('celebBirthInput').value = '';
  renderCelebs(document.getElementById('celebSearch').value.trim());
}

function deleteCeleb(name) {
  const arr = getUserCelebs().filter(c=>c.name!==name);
  saveUserCelebs(arr);
  renderCelebs(document.getElementById('celebSearch').value.trim());
}

renderCelebs();

// ─── シェア ──────────────────────────────────────────
<?php if($result):
  $pn = $result['partnerName']!=='' ? $result['partnerName'] : 'お相手';
  $shareText = "相性診断結果：{$result['yZ']['name']}×{$result['pZ']['name']} 相性".round(($result['marriageScore']+$result['loverScore'])/10*100)."% ✨";
?>
window._shareText = <?=json_encode($shareText)?>;
<?php endif;?>

function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
function toggleSpMenu(){document.getElementById('spDropdown').classList.toggle('open');}
document.addEventListener('click',e=>{
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown'))
    document.getElementById('spDropdown').classList.remove('open');
});
</script>
</body>
</html>
