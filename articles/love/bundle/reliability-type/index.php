<?php
$item = [
  'slug' => 'reliability-type',
  'name' => '誠実性型',
  'primitiveName' => '誠実性',
  'primitiveCode' => 'REL',
  'pct' => 51.2,
  'sampleSize' => 4721,
  'title' => '誠実性型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '誠実性型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、誠実性が最も強く出る「誠実性型」の恋愛傾向をLove Engineの実測データ（9216パターン中51.2%）で解説。包容力・恋愛の慎重さ・結婚志向が高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面には、あなたの恋愛タイプを表す短い文章が表示されます。その文章の多くは、5つの性格プリミティブのうち「誠実性」が最も強く出て決まる「誠実性型」に該当します。このページでは、誠実性型がなぜそうなるのか、Love Engineの実測データ（9216パターン中51.2%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は誠実性型です。',
  'selfCheckQuotes' => [
    '相手との信頼をじっくり育てながら、心を通わせていくタイプです。約束や積み重ねを重んじる誠実さの奥に、相手の気持ちに寄り添う細やかさが宿っています。',
    '信頼をていねいに積み重ねることを恋の土台にしつつ、ここぞという場面では自分から一歩を踏み出せるタイプです。堅実さに行動力が加わり、恋を着実に前へ進めていきます。',
    '安定した信頼関係を保ちながら、二人の時間にささやかな変化を取り入れていけるタイプです。落ち着きと遊び心が同居し、長く一緒にいても飽きのこない関係を育てます。',
    '相手との信頼を何より大切にしながら、自分の時間や軸もきちんと保てるタイプです。信頼とほどよい距離感の両立が、安定した大人の関係を支えていきます。',
  ],

  'features_lead' => '誠実性型は、5つの恋愛タイプの中で最も多く、9216パターン中51.2%（約2人に1人）が該当します。',
  'features_body' => '共通する軸は「信頼を積み重ねることを恋愛の土台にする」という点です。副軸（2番目に強いプリミティブ）によって4つのパターンに分かれますが、いずれも誠実性が主軸である以上、約束を守る・関係を長期的に見る・相手との信頼を大切にするという核は共通しています。',

  'causal_intro' => '誠実性は、5つのプリミティブの中で最も多くの入力から加算される軸です。MBTI・血液型・星座のいずれからも誠実性への寄与があり、これが誠実性型が全体の過半数を占める理由になっています。',
  'causalSources' => [
    ['source' => 'MBTIのI・S・J', 'example' => 'ISTJ・ISFJ等、慎重さ(I)・安定性(S)・責任感(J)を併せ持つタイプ', 'contribution' => '3つの文字それぞれが誠実性に加算（I=慎重さ+2、S=安定性+2、J=責任感+2）'],
    ['source' => '血液型A型', 'example' => '几帳面・真面目・調和という3つの通俗特徴すべて', 'contribution' => '慎重さ+2・責任感+2・安定性+1＝合計5点。血液型単独では最大の集中度'],
    ['source' => '星座の地・不動宮', 'example' => '牡牛座(地・不動宮)・乙女座(地・柔軟宮)・山羊座(地・活動宮)等', 'contribution' => 'エレメント「地」で安定+2、クオリティ「不動宮」で安定+1'],
    ['source' => '星座の内面タイプ', 'example' => '分析型・責任型・安定型・調和型（12種類中4種類）', 'contribution' => 'それぞれ慎重さ・責任感・安定性のいずれかに+1〜+2'],
  ],
  'causal_explanation' => 'このように誠実性は、MBTI・血液型・星座の3系統すべてから、複数の経路で加算されます。他の4つのプリミティブは特定の文字・血液型・エレメントに限定される寄与が中心である一方、誠実性は「入りやすい経路」が多いため、結果として誠実性型が5タイプ中最多（51.2%）になっています。',

  'breakdown_intro' => '誠実性型は、副軸（2番目に強いプリミティブ）によって4つの組み合わせパターンに分かれます。',
  'breakdown' => [
    ['label' => '誠実性×情動性', 'count' => 2417, 'pctOfAll' => 26.226, 'pctOfGroup' => 51.2],
    ['label' => '誠実性×行動主導性', 'count' => 1666, 'pctOfAll' => 18.077, 'pctOfGroup' => 35.3],
    ['label' => '誠実性×変化志向', 'count' => 437, 'pctOfAll' => 4.742, 'pctOfGroup' => 9.3],
    ['label' => '誠実性×自立性', 'count' => 201, 'pctOfAll' => 2.181, 'pctOfGroup' => 4.3],
  ],

  'data_intro' => 'ここからは、誠実性型に該当する4721パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>6.6,'mid'=>32.6,'low'=>60.8],
    '愛情表現' => ['high'=>7.6,'mid'=>35.5,'low'=>57.0],
    '包容力' => ['high'=>63.4,'mid'=>25.2,'low'=>11.4],
    '独占欲' => ['high'=>15.2,'mid'=>32.2,'low'=>52.6],
    '惚れやすさ' => ['high'=>8.2,'mid'=>27.3,'low'=>64.5],
    '嫉妬深さ' => ['high'=>0,'mid'=>34.7,'low'=>65.3],
    '恋愛の慎重さ' => ['high'=>69.5,'mid'=>29.3,'low'=>1.2],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>62.1,'mid'=>34.2,'low'=>3.7],
    '浮気耐性' => ['high'=>62.6,'mid'=>37.4,'low'=>0],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。誠実性型は5タイプ中最多です。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>51.226, 'self'=>true, 'url'=>'#'],
    ['name'=>'情動性型', 'pct'=>27.919, 'self'=>false, 'url'=>'/articles/love/bundle/sensitivity-type/'],
    ['name'=>'行動主導性型', 'pct'=>16.092, 'self'=>false, 'url'=>'/articles/love/bundle/action-type/'],
    ['name'=>'変化志向型', 'pct'=>4.416, 'self'=>false, 'url'=>'/articles/love/bundle/transform-type/'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、誠実性型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ISTJ','pct'=>98.4,'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISFJ','pct'=>93.1,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTP','pct'=>74.1,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESFJ','pct'=>70.0,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>68.9,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ISFP','pct'=>68.1,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESTJ','pct'=>53.1,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'INFJ','pct'=>51.0,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ESFP','pct'=>40.1,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>39.9,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENFJ','pct'=>32.8,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENTJ','pct'=>30.9,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'INFP','pct'=>30.9,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ESTP','pct'=>30.7,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ENTP','pct'=>19.3,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENFP','pct'=>18.2,'url'=>'/articles/love/mbti/enfp/'],
  ],
  'bloodSeizaNote' => '血液型別ではA型が95.5%と圧倒的に高く、B型46.4%・AB型33.0%・O型30.0%が続きます（詳しくは血液型×恋愛の各記事）。星座別では牡牛座79.3%・乙女座67.8%・山羊座66.9%と、地のエレメントを持つ星座が上位を占めます（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '誠実性は、次のStyle・Tendencyの計算式に使われています。誠実性型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'包容力', 'desc'=>'誠実性×0.6＋情動性×0.4。誠実性型ではHigh率63.4%と高い傾向。', 'url'=>'/articles/love/style/houyouryoku-love/'],
    ['name'=>'恋愛の慎重さ', 'desc'=>'誠実性×0.6＋自立性×0.4。誠実性型ではHigh率69.5%と高い傾向。', 'url'=>'/articles/love/style/shinchousa-love/'],
    ['name'=>'嫉妬深さ', 'desc'=>'情動性×0.6－誠実性×0.4。誠実性が高いほど下がる方向に働く。', 'url'=>'/articles/love/style/shittobukasa-love/'],
    ['name'=>'結婚志向', 'desc'=>'誠実性×0.7－変化志向×0.3。誠実性型ではHigh率62.1%と高い傾向。', 'url'=>'/articles/love/tendency/kekkonshikou-love/'],
    ['name'=>'浮気耐性', 'desc'=>'誠実性×0.7－行動主導性×0.3。誠実性型ではHigh率62.6%と高い傾向。', 'url'=>'/articles/love/tendency/uwakitaisei-love/'],
  ],

  'faq' => [
    ['q'=>'誠実性型は珍しいタイプですか？', 'a'=>'いいえ、9216パターン中51.2%と、5つの恋愛タイプの中で最も多いタイプです。約2人に1人が誠実性型に該当します。'],
    ['q'=>'誠実性型の中でも人によって違いがあるのはなぜですか？', 'a'=>'誠実性型は副軸（2番目に強いプリミティブ）によって4パターンに分かれます（上記「誠実性型の内訳」参照）。同じ誠実性型でも、副軸が情動性か行動主導性かで恋愛の表れ方が変わります。'],
    ['q'=>'誠実性型は「恋愛の慎重さ」「結婚志向」が必ず高くなりますか？', 'a'=>'傾向としては高くなりやすいですが（恋愛の慎重さHigh69.5%、結婚志向High62.1%）、必ずHighになるわけではありません。副軸や血液型・星座の組み合わせによって変わります。'],
  ],

  'matome' => [
    '誠実性型は、5つのプリミティブのうち誠実性が最も強く出て決まる恋愛タイプで、9216パターン中51.2%と最多。',
    '副軸によって4パターン（誠実性×情動性／行動主導性／変化志向／自立性）に分かれ、最多は誠実性×情動性（26.2%）。',
    '包容力・恋愛の慎重さ・結婚志向・浮気耐性がHigh傾向にあり、嫉妬深さはHigh0%という結果になっている。',
    'MBTIではISTJ（98.4%）・ISFJ（93.1%）、血液型ではA型（95.5%）が特に高い該当率を示す。',
    '誠実性は、MBTIのI・S・J、血液型A型、星座の地・不動宮など複数の入力から加算される、最も裾野の広いプリミティブ。',
  ],

  'next' => ['title'=>'情動性型', 'url'=>'/articles/love/bundle/sensitivity-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
