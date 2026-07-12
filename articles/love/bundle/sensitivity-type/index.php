<?php
$item = [
  'slug' => 'sensitivity-type',
  'name' => '情動性型',
  'primitiveName' => '情動性',
  'primitiveCode' => 'SEN',
  'pct' => 27.9,
  'sampleSize' => 2573,
  'title' => '情動性型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '情動性型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、情動性が最も強く出る「情動性型」の恋愛傾向をLove Engineの実測データ（9216パターン中27.9%）で解説。愛情表現・惚れやすさ・嫉妬深さが高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「情動性」が最も強く出て決まるのが「情動性型」です。このページでは、情動性型がなぜそうなるのか、Love Engineの実測データ（9216パターン中27.9%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は情動性型です。',
  'selfCheckQuotes' => [
    '心が動いたときの熱量が大きく、その想いが自然と行動につながっていくタイプです。感情の豊かさが恋の原動力になり、二人の距離をぐっと縮める瞬間をつくります。',
    '相手の気持ちに深く共鳴し、豊かな感情で恋を彩っていくタイプです。あふれる想いの根っこには、相手との信頼を守ろうとする誠実さが静かに息づいています。',
    '恋のときめきを深く味わい、感情の動きそのものを楽しめるタイプです。新しい体験に心を開く好奇心も持ち合わせ、二人の毎日に彩りを添えていきます。',
  ],

  'features_lead' => '情動性型は、9216パターン中27.9%（5タイプ中2番目に多い）が該当します。',
  'features_body' => '共通する軸は「感情の動きが恋愛の原動力になる」という点です。愛情表現・惚れやすさ・嫉妬深さが高くなりやすい一方、恋愛の慎重さは低くなりやすい傾向にあります。副軸によって3つのパターンに分かれ（4つ目のパターンは自立性型と文章を共有します）、いずれも情動性が主軸である以上、感情の豊かさ・共感力の高さという核は共通しています。',

  'causal_intro' => '情動性は、MBTI・血液型・星座のいずれからも加算されますが、誠実性ほど経路は多くありません。',
  'causalSources' => [
    ['source' => 'MBTIのN・F', 'example' => 'ENFP・INFJ等、直感(N)・情熱(F)を併せ持つタイプ', 'contribution' => '2つの文字それぞれが情動性に加算（N=直感+2、F=情熱+2）'],
    ['source' => '血液型O型・AB型', 'example' => 'O型の「おおらか」、AB型の「独特な感性」', 'contribution' => 'O型は情熱+2、AB型は直感+2'],
    ['source' => '星座の火・水（エレメント）', 'example' => '牡羊座・獅子座・射手座（火）、蟹座・蠍座・魚座（水）', 'contribution' => '火は情熱+2、水は直感+2。同じ情動性へ同スコアで変換されるため、牡羊座と蟹座のように結果が完全一致するペアが生まれる'],
    ['source' => '星座の内面タイプ', 'example' => '情熱型・感受型・探究型・直感型（12種類中4種類）', 'contribution' => 'それぞれ情熱・直感のいずれかに+1〜+2'],
  ],
  'causal_explanation' => '情動性は「火」と「水」という異なるエレメントが同じスコアで加算されるという特徴を持ちます。これは、感情が動く理由（情熱的に燃え上がる火のタイプと、共感的に感じ取る水のタイプ）は異なっても、恋愛スタイルへの表れ方は同じという設計です。',

  'breakdown_intro' => '情動性型は、副軸によって主に3つの組み合わせパターンに分かれます（情動性×自立性は自立性型と文章を共有する低頻度パターンです）。',
  'breakdown' => [
    ['label' => '情動性×行動主導性', 'count' => 1175, 'pctOfAll' => 12.750, 'pctOfGroup' => 45.7],
    ['label' => '情動性×誠実性', 'count' => 996, 'pctOfAll' => 10.807, 'pctOfGroup' => 38.7],
    ['label' => '情動性×変化志向', 'count' => 356, 'pctOfAll' => 3.863, 'pctOfGroup' => 13.8],
    ['label' => '情動性×自立性', 'count' => 46, 'pctOfAll' => 0.499, 'pctOfGroup' => 1.8],
  ],

  'data_intro' => 'ここからは、情動性型に該当する2573パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>53.3,'mid'=>37.0,'low'=>9.7],
    '愛情表現' => ['high'=>79.6,'mid'=>19.9,'low'=>0.5],
    '包容力' => ['high'=>12.3,'mid'=>44.0,'low'=>43.7],
    '独占欲' => ['high'=>74.3,'mid'=>24.3,'low'=>1.4],
    '惚れやすさ' => ['high'=>85.5,'mid'=>14.5,'low'=>0],
    '嫉妬深さ' => ['high'=>85.5,'mid'=>14.5,'low'=>0],
    '恋愛の慎重さ' => ['high'=>1.3,'mid'=>23.0,'low'=>75.7],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>1.4,'mid'=>37.8,'low'=>60.8],
    '浮気耐性' => ['high'=>1.6,'mid'=>38.9,'low'=>59.6],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。情動性型は5タイプ中2番目に多いタイプです。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>51.226, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>27.919, 'self'=>true, 'url'=>'#'],
    ['name'=>'行動主導性型', 'pct'=>16.092, 'self'=>false, 'url'=>'/articles/love/bundle/action-type/'],
    ['name'=>'変化志向型', 'pct'=>4.416, 'self'=>false, 'url'=>'/articles/love/bundle/transform-type/'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、情動性型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ENFP','pct'=>73.1,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ENFJ','pct'=>64.2,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'INFP','pct'=>63.5,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'INFJ','pct'=>48.3,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ESFP','pct'=>37.3,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>36.6,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ISFP','pct'=>25.0,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESFJ','pct'=>23.3,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>23.3,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ENTP','pct'=>18.8,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENTJ','pct'=>17.4,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ISFJ','pct'=>6.9,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTP','pct'=>6.2,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESTJ','pct'=>1.4,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESTP','pct'=>1.4,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISTJ','pct'=>0.0,'url'=>'/articles/love/mbti/istj/'],
  ],
  'bloodSeizaNote' => '血液型別ではAB型が46.4%・O型が40.0%と高く、A型は3.0%と極めて低くなります（詳しくは血液型×恋愛の各記事）。星座別では魚座・射手座（ともに42.8%）が最も高く、牡牛座（10.4%）が最も低くなります（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '情動性は、次のStyle・Tendencyの計算式に使われています。情動性型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'愛情表現', 'desc'=>'行動主導性×0.3＋情動性×0.7。情動性型ではHigh率79.6%と高い傾向。', 'url'=>'/articles/love/style/aijouhyougen-love/'],
    ['name'=>'独占欲', 'desc'=>'情動性×0.7－自立性×0.3。情動性型ではHigh率74.3%と高い傾向。', 'url'=>'/articles/love/style/dokusenyoku-love/'],
    ['name'=>'惚れやすさ', 'desc'=>'情動性×0.6＋変化志向×0.4。情動性型ではHigh率85.5%と非常に高い傾向。', 'url'=>'/articles/love/style/horeyasusa-love/'],
    ['name'=>'嫉妬深さ', 'desc'=>'情動性×0.6－誠実性×0.4。情動性型ではHigh率85.5%と非常に高い傾向。', 'url'=>'/articles/love/style/shittobukasa-love/'],
    ['name'=>'積極性', 'desc'=>'行動主導性×0.6＋情動性×0.4。情動性型ではHigh率53.3%とやや高い傾向。', 'url'=>'/articles/love/style/sekkyokusei-love/'],
  ],

  'faq' => [
    ['q'=>'情動性型は珍しいタイプですか？', 'a'=>'いいえ、9216パターン中27.9%と、5つの恋愛タイプの中で2番目に多いタイプです。'],
    ['q'=>'情動性型は「嫉妬深さ」が必ず高くなりますか？', 'a'=>'傾向としては高くなりやすいですが（High率85.5%）、必ずHighになるわけではありません。副軸や血液型・星座の組み合わせによって変わります。'],
    ['q'=>'情動性型は「誠実性型」と何が違いますか？', 'a'=>'誠実性型は約束や信頼の積み重ねを恋愛の土台にするのに対し、情動性型は感情の動きそのものが恋愛の原動力になる点が異なります。恋愛の慎重さは誠実性型でHigh69.5%・情動性型でHigh1.3%と対照的です。'],
  ],

  'matome' => [
    '情動性型は、5つのプリミティブのうち情動性が最も強く出て決まる恋愛タイプで、9216パターン中27.9%（5タイプ中2番目）。',
    '副軸によって主に3パターン（情動性×行動主導性／誠実性／変化志向）に分かれ、最多は情動性×行動主導性（12.8%）。',
    '愛情表現・独占欲・惚れやすさ・嫉妬深さがHigh傾向にあり、恋愛の慎重さ・結婚志向・浮気耐性はLow傾向にある。',
    'MBTIではENFP（73.1%）・ENFJ（64.2%）、血液型ではAB型（46.4%）・O型（40.0%）が特に高い該当率を示す。',
    '情動性は「火」と「水」という異なる星座エレメントが同スコアで加算される唯一のプリミティブで、これが牡羊座と蟹座など実測値が完全一致するペアを生む理由になっている。',
  ],

  'prev' => ['title'=>'誠実性型', 'url'=>'/articles/love/bundle/reliability-type/'],
  'next' => ['title'=>'行動主導性型', 'url'=>'/articles/love/bundle/action-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
