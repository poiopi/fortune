<?php
$item = [
  'slug' => 'action-type',
  'name' => '行動主導性型',
  'primitiveName' => '行動主導性',
  'primitiveCode' => 'ACT',
  'pct' => 18.5,
  'sampleSize' => 1701,
  'title' => '行動主導性型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '行動主導性型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、行動主導性が最も強く出る「行動主導性型」の恋愛傾向をLove Engineの実測データ（9216パターン中18.5%）で解説。積極性が高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「行動主導性」が最も強く出て決まるのが「行動主導性型」です。このページでは、行動主導性型がなぜそうなるのか、Love Engineの実測データ（9216パターン中18.5%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は行動主導性型です。',
  'selfCheckQuotes' => [
    '気になる相手には自分から働きかけ、関係を前へ前へと進めていくタイプです。その行動の一つひとつに、相手を大切にする真摯さが伴っています。',
    '心が決まれば迷わず動いていけるタイプです。まっすぐな行動の裏には熱い想いがあり、その情熱が相手の心を動かしていきます。',
    '自分から動いて恋の景色をどんどん広げていける、勢いのあるタイプです。行動力に変化を楽しむ心が重なり、二人の関係に楽しい展開を次々と呼び込みます。',
  ],

  'features_lead' => '行動主導性型は、9216パターン中18.5%が該当します。',
  'features_body' => '共通する軸は「迷う前に動く」という点です。積極性が非常に高くなりやすい一方、包容力・恋愛の慎重さ・浮気耐性は低くなりやすい傾向にあります。副軸によって主に3つのパターンに分かれ（行動主導性×自立性は極めて低頻度です）、いずれも行動主導性が主軸である以上、自分から関係を動かしていく積極性という核は共通しています。',

  'causal_intro' => '行動主導性は、MBTI・血液型・星座のいずれからも加算されます。',
  'causalSources' => [
    ['source' => 'MBTIのE・T', 'example' => 'ESTP・ENTJ等、外向(E)・思考(T)を併せ持つタイプ', 'contribution' => '2つの文字それぞれが行動主導性に加算（E=行動力+2、T=挑戦+2）'],
    ['source' => '血液型O型', 'example' => '「行動的」という通俗特徴', 'contribution' => '行動力+2（AB型も「型にはまらない発想」＝挑戦+1の副次的な寄与を持つ）'],
    ['source' => '星座の火（エレメント）', 'example' => '牡羊座・獅子座・射手座（火の3星座）', 'contribution' => '行動力+1（火は情熱+2で情動性にも加算される）'],
    ['source' => '星座の活動宮（クオリティ）', 'example' => '牡羊座・蟹座・天秤座・山羊座（活動宮の4星座）', 'contribution' => '行動力+1'],
    ['source' => '星座の内面タイプ', 'example' => '挑戦型（12種類中1種類）', 'contribution' => '挑戦+2'],
  ],
  'causal_explanation' => '行動主導性は誠実性・情動性ほど経路が多くなく、加算されるスコアも1系統あたりでは中程度です。そのため行動主導性型は5タイプ中3番目の出現率（18.5%）にとどまっています。',

  'breakdown_intro' => '行動主導性型は、副軸によって主に3つの組み合わせパターンに分かれます（行動主導性×自立性はごく低頻度です）。',
  'breakdown' => [
    ['label' => '行動主導性×誠実性', 'count' => 795, 'pctOfAll' => 8.626, 'pctOfGroup' => 46.7],
    ['label' => '行動主導性×情動性', 'count' => 762, 'pctOfAll' => 8.268, 'pctOfGroup' => 44.8],
    ['label' => '行動主導性×変化志向', 'count' => 134, 'pctOfAll' => 1.454, 'pctOfGroup' => 7.9],
    ['label' => '行動主導性×自立性', 'count' => 10, 'pctOfAll' => 0.109, 'pctOfGroup' => 0.6],
  ],

  'data_intro' => 'ここからは、行動主導性型に該当する1701パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>60.7,'mid'=>36.6,'low'=>2.7],
    '愛情表現' => ['high'=>32.9,'mid'=>50.4,'low'=>16.8],
    '包容力' => ['high'=>0.5,'mid'=>19.2,'low'=>80.3],
    '独占欲' => ['high'=>19.3,'mid'=>40.2,'low'=>40.4],
    '惚れやすさ' => ['high'=>14.6,'mid'=>36.6,'low'=>48.7],
    '嫉妬深さ' => ['high'=>26.7,'mid'=>57.5,'low'=>15.8],
    '恋愛の慎重さ' => ['high'=>0.1,'mid'=>25.4,'low'=>74.5],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>0.8,'mid'=>39.6,'low'=>59.6],
    '浮気耐性' => ['high'=>0,'mid'=>19.6,'low'=>80.4],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。行動主導性型は5タイプ中3番目です。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>50.347, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>26.693, 'self'=>false, 'url'=>'/articles/love/bundle/sensitivity-type/'],
    ['name'=>'行動主導性型', 'pct'=>18.457, 'self'=>true, 'url'=>'#'],
    ['name'=>'変化志向型', 'pct'=>4.156, 'self'=>false, 'url'=>'/articles/love/bundle/transform-type/'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、行動主導性型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ESTP','pct'=>61.5,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ENTP','pct'=>59.7,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENTJ','pct'=>56.6,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ESTJ','pct'=>49.0,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ISTP','pct'=>16.0,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESFP','pct'=>13.4,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>13.2,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ESFJ','pct'=>8.3,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>8.2,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ISTJ','pct'=>3.3,'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ENFJ','pct'=>2.6,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP','pct'=>2.6,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ISFP','pct'=>0.9,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ISFJ','pct'=>0.2,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'INFJ','pct'=>0.0,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INFP','pct'=>0.0,'url'=>'/articles/love/mbti/infp/'],
  ],
  'bloodSeizaNote' => '血液型別ではO型が32.5%と最も高く、A型は2.0%と極めて低くなります（詳しくは血液型×恋愛の各記事）。星座別では牡羊座（32.6%）・天秤座（30.9%）が高く、牡牛座（9.5%）が最も低くなります（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '行動主導性は、次のStyle・Tendencyの計算式に使われています。行動主導性型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'積極性', 'desc'=>'行動主導性×0.6＋情動性×0.4。行動主導性型ではHigh率60.7%と非常に高い傾向。', 'url'=>'/articles/love/style/sekkyokusei-love/'],
    ['name'=>'愛情表現', 'desc'=>'行動主導性×0.3＋情動性×0.7。行動主導性型ではMid率が最も多い。', 'url'=>'/articles/love/style/aijouhyougen-love/'],
    ['name'=>'浮気耐性', 'desc'=>'誠実性×0.7－行動主導性×0.3。行動主導性型ではHigh率0%と低い傾向。', 'url'=>'/articles/love/tendency/uwakitaisei-love/'],
  ],

  'faq' => [
    ['q'=>'行動主導性型は珍しいタイプですか？', 'a'=>'いいえ、9216パターン中18.5%と、5つの恋愛タイプの中で3番目に多いタイプです。'],
    ['q'=>'行動主導性型は「積極性」が必ず高くなりますか？', 'a'=>'傾向としては非常に高くなりやすいです（High率60.7%）。ただし副軸や血液型・星座の組み合わせによっては異なる結果になることもあります。'],
    ['q'=>'行動主導性型は他のタイプに比べて浮気しやすいのですか？', 'a'=>'そうとは言えません。浮気耐性はTendency（推定傾向）であり、性格由来の構造的な傾向を示すものです。行動主導性型ではHigh率が低い傾向にありますが、実際の行動を断定するものではなく、価値観や経験によって大きく変わります。'],
  ],

  'matome' => [
    '行動主導性型は、5つのプリミティブのうち行動主導性が最も強く出て決まる恋愛タイプで、9216パターン中18.5%（5タイプ中3番目）。',
    '副軸によって主に3パターン（行動主導性×誠実性／情動性／変化志向）に分かれ、最多は行動主導性×誠実性（8.6%）。',
    '積極性がHigh率60.7%と非常に高くなりやすい一方、包容力・恋愛の慎重さ・浮気耐性はLow傾向が強い。',
    'MBTIではESTP（61.5%）・ENTP（59.7%）、血液型ではO型（32.5%）が特に高い該当率を示す。星座では牡羊座（32.6%）・天秤座（30.9%）が高い。',
    '行動主導性は誠実性・情動性ほど加算経路が多くなく、これが5タイプ中3番目の出現率にとどまる理由になっている。',
  ],

  'prev' => ['title'=>'情動性型', 'url'=>'/articles/love/bundle/sensitivity-type/'],
  'next' => ['title'=>'変化志向型', 'url'=>'/articles/love/bundle/transform-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
