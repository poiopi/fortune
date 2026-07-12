<?php
$item = [
  'slug' => 'action-type',
  'name' => '行動主導性型',
  'primitiveName' => '行動主導性',
  'primitiveCode' => 'ACT',
  'pct' => 16.1,
  'sampleSize' => 1483,
  'title' => '行動主導性型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '行動主導性型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、行動主導性が最も強く出る「行動主導性型」の恋愛傾向をLove Engineの実測データ（9216パターン中16.1%）で解説。積極性が高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「行動主導性」が最も強く出て決まるのが「行動主導性型」です。このページでは、行動主導性型がなぜそうなるのか、Love Engineの実測データ（9216パターン中16.1%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は行動主導性型です。',
  'selfCheckQuotes' => [
    '気になる相手には自分から働きかけ、関係を前へ前へと進めていくタイプです。その行動の一つひとつに、相手を大切にする真摯さが伴っています。',
    '心が決まれば迷わず動いていけるタイプです。まっすぐな行動の裏には熱い想いがあり、その情熱が相手の心を動かしていきます。',
    '自分から動いて恋の景色をどんどん広げていける、勢いのあるタイプです。行動力に変化を楽しむ心が重なり、二人の関係に楽しい展開を次々と呼び込みます。',
  ],

  'features_lead' => '行動主導性型は、9216パターン中16.1%が該当します。',
  'features_body' => '共通する軸は「迷う前に動く」という点です。積極性が非常に高くなりやすい一方、包容力・恋愛の慎重さ・浮気耐性は低くなりやすい傾向にあります。副軸によって主に3つのパターンに分かれ（行動主導性×自立性は極めて低頻度です）、いずれも行動主導性が主軸である以上、自分から関係を動かしていく積極性という核は共通しています。',

  'causal_intro' => '行動主導性は、MBTI・血液型・星座のいずれからも加算されます。',
  'causalSources' => [
    ['source' => 'MBTIのE・T', 'example' => 'ESTP・ENTJ等、外向(E)・思考(T)を併せ持つタイプ', 'contribution' => '2つの文字それぞれが行動主導性に加算（E=行動力+2、T=挑戦+2）'],
    ['source' => '血液型O型', 'example' => '「行動的」という通俗特徴', 'contribution' => '行動力+2（AB型も「型にはまらない発想」＝挑戦+1の副次的な寄与を持つ）'],
    ['source' => '星座の活動宮（クオリティ）', 'example' => '牡羊座・蟹座・天秤座・山羊座（活動宮の4星座）', 'contribution' => '行動力+1'],
    ['source' => '星座の内面タイプ', 'example' => '挑戦型（12種類中1種類）', 'contribution' => '挑戦+2'],
  ],
  'causal_explanation' => '行動主導性は誠実性・情動性ほど経路が多くなく、加算されるスコアも1系統あたりでは中程度です。そのため行動主導性型は5タイプ中3番目の出現率（16.1%）にとどまっています。',

  'breakdown_intro' => '行動主導性型は、副軸によって主に3つの組み合わせパターンに分かれます（行動主導性×自立性はごく低頻度です）。',
  'breakdown' => [
    ['label' => '行動主導性×誠実性', 'count' => 714, 'pctOfAll' => 7.747, 'pctOfGroup' => 48.1],
    ['label' => '行動主導性×情動性', 'count' => 649, 'pctOfAll' => 7.042, 'pctOfGroup' => 43.8],
    ['label' => '行動主導性×変化志向', 'count' => 110, 'pctOfAll' => 1.194, 'pctOfGroup' => 7.4],
    ['label' => '行動主導性×自立性', 'count' => 10, 'pctOfAll' => 0.109, 'pctOfGroup' => 0.7],
  ],

  'data_intro' => 'ここからは、行動主導性型に該当する1483パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>71.1,'mid'=>25.6,'low'=>3.4],
    '愛情表現' => ['high'=>34.5,'mid'=>47.3,'low'=>18.1],
    '包容力' => ['high'=>0.1,'mid'=>16.7,'low'=>83.1],
    '独占欲' => ['high'=>16.2,'mid'=>42.4,'low'=>41.4],
    '惚れやすさ' => ['high'=>11.1,'mid'=>36.7,'low'=>52.1],
    '嫉妬深さ' => ['high'=>24.2,'mid'=>59.3,'low'=>16.5],
    '恋愛の慎重さ' => ['high'=>0,'mid'=>23.3,'low'=>76.7],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>0.6,'mid'=>38.9,'low'=>60.5],
    '浮気耐性' => ['high'=>0,'mid'=>18.8,'low'=>81.2],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。行動主導性型は5タイプ中3番目です。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>51.226, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>27.919, 'self'=>false, 'url'=>'/articles/love/bundle/sensitivity-type/'],
    ['name'=>'行動主導性型', 'pct'=>16.092, 'self'=>true, 'url'=>'#'],
    ['name'=>'変化志向型', 'pct'=>4.416, 'self'=>false, 'url'=>'/articles/love/bundle/transform-type/'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、行動主導性型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ESTP','pct'=>58.2,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ENTP','pct'=>52.3,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENTJ','pct'=>50.9,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ESTJ','pct'=>45.0,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ISTP','pct'=>11.5,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESFP','pct'=>10.6,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>10.6,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ESFJ','pct'=>6.1,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>6.1,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ENFJ','pct'=>2.3,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP','pct'=>2.1,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ISTJ','pct'=>1.6,'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISFP','pct'=>0.5,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'INFJ','pct'=>0.0,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INFP','pct'=>0.0,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ISFJ','pct'=>0.0,'url'=>'/articles/love/mbti/isfj/'],
  ],
  'bloodSeizaNote' => '血液型別ではO型が29.5%と最も高く、A型は1.5%と極めて低くなります（詳しくは血液型×恋愛の各記事）。星座別では天秤座が30.9%と突出して高く、牡牛座（9.5%）が最も低くなります（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '行動主導性は、次のStyle・Tendencyの計算式に使われています。行動主導性型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'積極性', 'desc'=>'行動主導性×0.6＋情動性×0.4。行動主導性型ではHigh率71.1%と非常に高い傾向。', 'url'=>'/articles/love/style/sekkyokusei-love/'],
    ['name'=>'愛情表現', 'desc'=>'行動主導性×0.3＋情動性×0.7。行動主導性型ではMid率が最も多い。', 'url'=>'/articles/love/style/aijouhyougen-love/'],
    ['name'=>'浮気耐性', 'desc'=>'誠実性×0.7－行動主導性×0.3。行動主導性型ではHigh率0%と低い傾向。', 'url'=>'/articles/love/tendency/uwakitaisei-love/'],
  ],

  'faq' => [
    ['q'=>'行動主導性型は珍しいタイプですか？', 'a'=>'いいえ、9216パターン中16.1%と、5つの恋愛タイプの中で3番目に多いタイプです。'],
    ['q'=>'行動主導性型は「積極性」が必ず高くなりますか？', 'a'=>'傾向としては非常に高くなりやすいです（High率71.1%）。ただし副軸や血液型・星座の組み合わせによっては異なる結果になることもあります。'],
    ['q'=>'行動主導性型は他のタイプに比べて浮気しやすいのですか？', 'a'=>'そうとは言えません。浮気耐性はTendency（推定傾向）であり、性格由来の構造的な傾向を示すものです。行動主導性型ではHigh率が低い傾向にありますが、実際の行動を断定するものではなく、価値観や経験によって大きく変わります。'],
  ],

  'matome' => [
    '行動主導性型は、5つのプリミティブのうち行動主導性が最も強く出て決まる恋愛タイプで、9216パターン中16.1%（5タイプ中3番目）。',
    '副軸によって主に3パターン（行動主導性×誠実性／情動性／変化志向）に分かれ、最多は行動主導性×誠実性（7.7%）。',
    '積極性がHigh率71.1%と非常に高くなりやすい一方、包容力・恋愛の慎重さ・浮気耐性はLow傾向が強い。',
    'MBTIではESTP（58.2%）・ENTP（52.3%）、血液型ではO型（29.5%）が特に高い該当率を示す。星座では天秤座（30.9%）が突出している。',
    '行動主導性は誠実性・情動性ほど加算経路が多くなく、これが5タイプ中3番目の出現率にとどまる理由になっている。',
  ],

  'prev' => ['title'=>'情動性型', 'url'=>'/articles/love/bundle/sensitivity-type/'],
  'next' => ['title'=>'変化志向型', 'url'=>'/articles/love/bundle/transform-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
