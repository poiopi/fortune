<?php
$item = [
  'slug' => 'transform-type',
  'name' => '変化志向型',
  'primitiveName' => '変化志向',
  'primitiveCode' => 'TRA',
  'pct' => 4.4,
  'sampleSize' => 407,
  'title' => '変化志向型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '変化志向型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、変化志向が最も強く出る「変化志向型」の恋愛傾向をLove Engineの実測データ（9216パターン中4.4%）で解説。惚れやすさが高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「変化志向」が最も強く出て決まるのが「変化志向型」です。このページでは、変化志向型がなぜそうなるのか、Love Engineの実測データ（9216パターン中4.4%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は変化志向型です。',
  'selfCheckQuotes' => [
    '恋にいつも新鮮さを求め、待つよりも自分から動いてそれを叶えていくタイプです。関係が同じ景色に落ち着く前に変化を起こせる身軽さが、恋をいきいきと保ちます。',
    '新しいことを二人で楽しみたい気持ちが、恋の真ん中にあるタイプです。変化を求めながらも相手との信頼は手放さない、その芯のある柔軟さが魅力になります。',
    '恋に新しい風を吹き込み、変化そのものを楽しめるタイプです。昨日と同じではない二人の時間を面白がる姿勢が、関係にみずみずしさをもたらします。',
  ],

  'features_lead' => '変化志向型は、9216パターン中4.4%と、5つの恋愛タイプの中では自立性型に次いで少ないタイプです。',
  'features_body' => '共通する軸は「関係に新しい風を取り入れることを恋愛の原動力にする」という点です。惚れやすさが高くなりやすい一方、包容力・独占欲・結婚志向は低くなりやすい傾向にあります。副軸によって主に3つのパターンに分かれ、いずれも変化志向が主軸である以上、同じ景色に留まらない柔軟さという核は共通しています。',

  'causal_intro' => '変化志向は、AXIS_TRANSFORMへ1:1で対応するTRAIT_CHANGE、ただ1つのtraitからのみ加算される、5つの中でも経路がとりわけ限定的なプリミティブです。',
  'causalSources' => [
    ['source' => 'MBTIのP', 'example' => 'ENTP・ISFP等、知覚(P)を持つ8タイプ', 'contribution' => '変化+2（Pが持つ唯一のtrait）'],
    ['source' => '血液型B型', 'example' => '「自由」という通俗特徴', 'contribution' => '変化+2'],
    ['source' => '星座の風（エレメント）・柔軟宮（クオリティ）', 'example' => '双子座・天秤座・水瓶座（風）、双子座・乙女座・射手座・魚座（柔軟宮）', 'contribution' => '風は変化+1、柔軟宮は変化+1。ともに副次スコアのため単独では弱い'],
    ['source' => '星座の内面タイプ', 'example' => '革新型（12種類中1種類）', 'contribution' => '変化+2'],
  ],
  'causal_explanation' => '変化志向はTRAIT_CHANGEという単一のtraitのみに支えられており、かつ星座からの寄与（風・柔軟宮）はいずれも副次スコア（+1）にとどまります。MBTIのPと血液型B型が同時に揃うといった条件が重ならないと主軸まで届きにくいため、変化志向型は5タイプ中4番目という低い出現率になっています。',

  'breakdown_intro' => '変化志向型は、副軸によって主に3つの組み合わせパターンに分かれます（変化志向×自立性はごく低頻度です）。',
  'breakdown' => [
    ['label' => '変化志向×行動主導性', 'count' => 156, 'pctOfAll' => 1.693, 'pctOfGroup' => 38.3],
    ['label' => '変化志向×誠実性', 'count' => 148, 'pctOfAll' => 1.606, 'pctOfGroup' => 36.4],
    ['label' => '変化志向×情動性', 'count' => 91, 'pctOfAll' => 0.987, 'pctOfGroup' => 22.4],
    ['label' => '変化志向×自立性', 'count' => 12, 'pctOfAll' => 0.130, 'pctOfGroup' => 2.9],
  ],

  'data_intro' => 'ここからは、変化志向型に該当する407パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>0.7,'mid'=>21.9,'low'=>77.4],
    '愛情表現' => ['high'=>0,'mid'=>20.4,'low'=>79.6],
    '包容力' => ['high'=>0,'mid'=>1.0,'low'=>99.0],
    '独占欲' => ['high'=>0,'mid'=>7.9,'low'=>92.1],
    '惚れやすさ' => ['high'=>50.4,'mid'=>24.3,'low'=>25.3],
    '嫉妬深さ' => ['high'=>9.8,'mid'=>64.1,'low'=>26.0],
    '恋愛の慎重さ' => ['high'=>0.5,'mid'=>40.3,'low'=>59.2],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>0,'mid'=>0,'low'=>100.0],
    '浮気耐性' => ['high'=>0.2,'mid'=>35.4,'low'=>64.4],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。変化志向型は5タイプ中4番目です。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>51.226, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>27.919, 'self'=>false, 'url'=>'/articles/love/bundle/sensitivity-type/'],
    ['name'=>'行動主導性型', 'pct'=>16.092, 'self'=>false, 'url'=>'/articles/love/bundle/action-type/'],
    ['name'=>'変化志向型', 'pct'=>4.416, 'self'=>true, 'url'=>'#'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、変化志向型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ESFP','pct'=>12.0,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>11.1,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENTP','pct'=>9.7,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ESTP','pct'=>9.7,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISTP','pct'=>7.3,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ENFP','pct'=>6.6,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ISFP','pct'=>5.6,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'INFP','pct'=>4.9,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENTJ','pct'=>0.9,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENFJ','pct'=>0.7,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ESFJ','pct'=>0.7,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>0.7,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ESTJ','pct'=>0.5,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'INFJ','pct'=>0.3,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ISFJ','pct'=>0.0,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTJ','pct'=>0.0,'url'=>'/articles/love/mbti/istj/'],
  ],
  'bloodSeizaNote' => '血液型別ではB型が16.4%と突出して高く、A型は0.1%とほぼ存在しません（詳しくは血液型×恋愛の各記事）。星座別では双子座が13.3%と最も高く、地のエレメントを持つ星座はいずれも0.8%程度にとどまります（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '変化志向は、次のStyle・Tendencyの計算式に使われています。変化志向型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'惚れやすさ', 'desc'=>'情動性×0.6＋変化志向×0.4。変化志向型ではHigh率50.4%と高い傾向。', 'url'=>'/articles/love/style/horeyasusa-love/'],
    ['name'=>'結婚志向', 'desc'=>'誠実性×0.7－変化志向×0.3。変化志向型ではHigh率0%、Low率100%。', 'url'=>'/articles/love/tendency/kekkonshikou-love/'],
  ],

  'faq' => [
    ['q'=>'変化志向型は珍しいタイプですか？', 'a'=>'はい、9216パターン中4.4%と、5つの恋愛タイプの中では自立性型に次いで少ないタイプです。'],
    ['q'=>'変化志向型は結婚に向いていないのですか？', 'a'=>'そうとは言えません。結婚志向はTendency（推定傾向）であり、性格由来の構造的な傾向を示すものです。変化志向型ではLow率が高い傾向にありますが、実際の結婚観を断定するものではなく、価値観や経験によって大きく変わります。'],
    ['q'=>'なぜ変化志向型は珍しいのですか？', 'a'=>'変化志向は、TRAIT_CHANGEという単一のtraitのみに支えられているプリミティブです。星座からの寄与（風・柔軟宮）も副次スコアにとどまるため、他のプリミティブに比べて主軸まで届きにくい構造になっています。'],
  ],

  'matome' => [
    '変化志向型は、5つのプリミティブのうち変化志向が最も強く出て決まる恋愛タイプで、9216パターン中4.4%（5タイプ中4番目）。',
    '副軸によって主に3パターン（変化志向×行動主導性／誠実性／情動性）に分かれ、最多は変化志向×行動主導性（1.7%）。',
    '惚れやすさがHigh率50.4%と高くなりやすい一方、包容力・独占欲・結婚志向はLow傾向が強い。',
    'MBTIではESFP（12.0%）・INTP（11.1%）、血液型ではB型（16.4%）が特に高い該当率を示す。星座では双子座（13.3%）が最も高い。',
    '変化志向はTRAIT_CHANGEという単一のtraitのみに支えられており、これが5タイプ中4番目という低い出現率の理由になっている。',
  ],

  'prev' => ['title'=>'行動主導性型', 'url'=>'/articles/love/bundle/action-type/'],
  'next' => ['title'=>'自立性型', 'url'=>'/articles/love/bundle/autonomy-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
