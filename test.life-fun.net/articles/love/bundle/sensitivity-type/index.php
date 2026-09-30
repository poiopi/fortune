<?php
$item = [
  'slug' => 'sensitivity-type',
  'name' => '情動性型',
  'primitiveName' => '情動性',
  'primitiveCode' => 'SEN',
  'pct' => 26.7,
  'sampleSize' => 2460,
  'title' => '情動性型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '情動性型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、情動性が最も強く出る「情動性型」の恋愛傾向をLove Engineの実測データ（9216パターン中26.7%）で解説。愛情表現・惚れやすさ・嫉妬深さが高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「情動性」が最も強く出て決まるのが「情動性型」です。このページでは、情動性型がなぜそうなるのか、Love Engineの実測データ（9216パターン中26.7%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は情動性型です。',
  'selfCheckQuotes' => [
    '心が動いたときの熱量が大きく、その想いが自然と行動につながっていくタイプです。感情の豊かさが恋の原動力になり、二人の距離をぐっと縮める瞬間をつくります。',
    '相手の気持ちに深く共鳴し、豊かな感情で恋を彩っていくタイプです。あふれる想いの根っこには、相手との信頼を守ろうとする誠実さが静かに息づいています。',
    '恋のときめきを深く味わい、感情の動きそのものを楽しめるタイプです。新しい体験に心を開く好奇心も持ち合わせ、二人の毎日に彩りを添えていきます。',
  ],

  'features_lead' => '情動性型は、9216パターン中26.7%（5タイプ中2番目に多い）が該当します。',
  'features_body' => '共通する軸は「感情の動きが恋愛の原動力になる」という点です。愛情表現・惚れやすさ・嫉妬深さが高くなりやすい一方、恋愛の慎重さは低くなりやすい傾向にあります。副軸によって3つのパターンに分かれ（4つ目のパターンは自立性型と文章を共有します）、いずれも情動性が主軸である以上、感情の豊かさ・共感力の高さという核は共通しています。',

  'causal_intro' => '情動性は、MBTI・血液型・星座のいずれからも加算されますが、誠実性ほど経路は多くありません。',
  'causalSources' => [
    ['source' => 'MBTIのN・F', 'example' => 'ENFP・INFJ等、直感(N)・情熱(F)を併せ持つタイプ', 'contribution' => '2つの文字それぞれが情動性に加算（N=直感+2、F=情熱+2）'],
    ['source' => '血液型O型・AB型', 'example' => 'O型の「おおらか」、AB型の「独特な感性」', 'contribution' => 'O型は情熱+2、AB型は直感+2'],
    ['source' => '星座の火・水（エレメント）', 'example' => '牡羊座・獅子座・射手座（火）、蟹座・蠍座・魚座（水）', 'contribution' => '火は情熱+2、水は直感+2で、どちらも情動性へ同じスコアで変換される。火はさらに行動力+1（行動主導性）も持つため、牡羊座と蟹座のようにクオリティが同じ火と水の星座でも結果は分かれる'],
    ['source' => '星座の内面タイプ', 'example' => '情熱型・感受型・探究型・直感型（12種類中4種類）', 'contribution' => 'それぞれ情熱・直感のいずれかに+1〜+2'],
  ],
  'causal_explanation' => '情動性は「火」と「水」という異なるエレメントが同じスコアで加算されるという特徴を持ちます。これは、感情が動く理由（情熱的に燃え上がる火のタイプと、共感的に感じ取る水のタイプ）は異なっても、情動性としては同じ強さで扱うという設計です。ただし火のエレメントは行動力（行動主導性）にも加算されるため、火の星座は水の星座に比べて行動主導性が主軸になるケースがやや多く、情動性型の該当率はやや低くなる傾向があります。',

  'breakdown_intro' => '情動性型は、副軸によって主に3つの組み合わせパターンに分かれます（情動性×自立性は自立性型と文章を共有する低頻度パターンです）。',
  'breakdown' => [
    ['label' => '情動性×行動主導性', 'count' => 1221, 'pctOfAll' => 13.249, 'pctOfGroup' => 49.6],
    ['label' => '情動性×誠実性', 'count' => 887, 'pctOfAll' => 9.625, 'pctOfGroup' => 36.1],
    ['label' => '情動性×変化志向', 'count' => 313, 'pctOfAll' => 3.396, 'pctOfGroup' => 12.7],
    ['label' => '情動性×自立性', 'count' => 39, 'pctOfAll' => 0.423, 'pctOfGroup' => 1.6],
  ],

  'data_intro' => 'ここからは、情動性型に該当する2460パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>55.8,'mid'=>36.3,'low'=>8.0],
    '愛情表現' => ['high'=>81.5,'mid'=>18.1,'low'=>0.4],
    '包容力' => ['high'=>10.9,'mid'=>46.5,'low'=>42.6],
    '独占欲' => ['high'=>74.5,'mid'=>24.3,'low'=>1.2],
    '惚れやすさ' => ['high'=>86.6,'mid'=>13.4,'low'=>0],
    '嫉妬深さ' => ['high'=>85.7,'mid'=>14.3,'low'=>0],
    '恋愛の慎重さ' => ['high'=>0.1,'mid'=>25.2,'low'=>74.8],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>1.5,'mid'=>38.0,'low'=>60.5],
    '浮気耐性' => ['high'=>2.0,'mid'=>36.9,'low'=>61.1],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。情動性型は5タイプ中2番目に多いタイプです。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>50.347, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>26.693, 'self'=>true, 'url'=>'#'],
    ['name'=>'行動主導性型', 'pct'=>18.457, 'self'=>false, 'url'=>'/articles/love/bundle/action-type/'],
    ['name'=>'変化志向型', 'pct'=>4.156, 'self'=>false, 'url'=>'/articles/love/bundle/transform-type/'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、情動性型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ENFP','pct'=>72.6,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ENFJ','pct'=>63.9,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'INFP','pct'=>63.5,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'INFJ','pct'=>48.3,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ESFP','pct'=>35.2,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>34.7,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ISFP','pct'=>24.8,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESFJ','pct'=>22.2,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>22.2,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ENTP','pct'=>13.5,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENTJ','pct'=>12.5,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ISFJ','pct'=>6.9,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTP','pct'=>5.2,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESTJ','pct'=>0.7,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESTP','pct'=>0.7,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISTJ','pct'=>0.0,'url'=>'/articles/love/mbti/istj/'],
  ],
  'bloodSeizaNote' => '血液型別ではAB型が44.2%・O型が38.2%と高く、A型は2.8%と極めて低くなります（詳しくは血液型×恋愛の各記事）。星座別では魚座（42.8%）が最も高く、牡牛座（10.4%）が最も低くなります（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '情動性は、次のStyle・Tendencyの計算式に使われています。情動性型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'愛情表現', 'desc'=>'行動主導性×0.3＋情動性×0.7。情動性型ではHigh率81.5%と高い傾向。', 'url'=>'/articles/love/style/aijouhyougen-love/'],
    ['name'=>'独占欲', 'desc'=>'情動性×0.7－自立性×0.3。情動性型ではHigh率74.5%と高い傾向。', 'url'=>'/articles/love/style/dokusenyoku-love/'],
    ['name'=>'惚れやすさ', 'desc'=>'情動性×0.6＋変化志向×0.4。情動性型ではHigh率86.6%と非常に高い傾向。', 'url'=>'/articles/love/style/horeyasusa-love/'],
    ['name'=>'嫉妬深さ', 'desc'=>'情動性×0.6－誠実性×0.4。情動性型ではHigh率85.7%と非常に高い傾向。', 'url'=>'/articles/love/style/shittobukasa-love/'],
    ['name'=>'積極性', 'desc'=>'行動主導性×0.6＋情動性×0.4。情動性型ではHigh率55.8%とやや高い傾向。', 'url'=>'/articles/love/style/sekkyokusei-love/'],
  ],

  'faq' => [
    ['q'=>'情動性型は珍しいタイプですか？', 'a'=>'いいえ、9216パターン中26.7%と、5つの恋愛タイプの中で2番目に多いタイプです。'],
    ['q'=>'情動性型は「嫉妬深さ」が必ず高くなりますか？', 'a'=>'傾向としては高くなりやすいですが（High率85.7%）、必ずHighになるわけではありません。副軸や血液型・星座の組み合わせによって変わります。'],
    ['q'=>'情動性型は「誠実性型」と何が違いますか？', 'a'=>'誠実性型は約束や信頼の積み重ねを恋愛の土台にするのに対し、情動性型は感情の動きそのものが恋愛の原動力になる点が異なります。恋愛の慎重さは誠実性型でHigh63.9%・情動性型でHigh0.1%と対照的です。'],
  ],

  'matome' => [
    '情動性型は、5つのプリミティブのうち情動性が最も強く出て決まる恋愛タイプで、9216パターン中26.7%（5タイプ中2番目）。',
    '副軸によって主に3パターン（情動性×行動主導性／誠実性／変化志向）に分かれ、最多は情動性×行動主導性（13.2%）。',
    '愛情表現・独占欲・惚れやすさ・嫉妬深さがHigh傾向にあり、恋愛の慎重さ・結婚志向・浮気耐性はLow傾向にある。',
    'MBTIではENFP（72.6%）・ENFJ（63.9%）、血液型ではAB型（44.2%）・O型（38.2%）が特に高い該当率を示す。',
    '情動性は「火」と「水」という異なる星座エレメントが同スコアで加算される唯一のプリミティブ。ただし火は行動主導性にも加算されるため、火と水の星座で実測値は分かれる。',
  ],

  'prev' => ['title'=>'誠実性型', 'url'=>'/articles/love/bundle/reliability-type/'],
  'next' => ['title'=>'行動主導性型', 'url'=>'/articles/love/bundle/action-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
