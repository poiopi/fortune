<?php
$item = [
  'slug' => 'transform-type',
  'name' => '変化志向型',
  'primitiveName' => '変化志向',
  'primitiveCode' => 'TRA',
  'pct' => 4.2,
  'sampleSize' => 383,
  'title' => '変化志向型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '変化志向型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、変化志向が最も強く出る「変化志向型」の恋愛傾向をLove Engineの実測データ（9216パターン中4.2%）で解説。惚れやすさが高くなる理由、MBTI・血液型との相関を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「変化志向」が最も強く出て決まるのが「変化志向型」です。このページでは、変化志向型がなぜそうなるのか、Love Engineの実測データ（9216パターン中4.2%）をもとに解説します。',

  'selfCheckIntro' => '診断結果に、次のような文章が表示された方は変化志向型です。',
  'selfCheckQuotes' => [
    '恋にいつも新鮮さを求め、待つよりも自分から動いてそれを叶えていくタイプです。関係が同じ景色に落ち着く前に変化を起こせる身軽さが、恋をいきいきと保ちます。',
    '新しいことを二人で楽しみたい気持ちが、恋の真ん中にあるタイプです。変化を求めながらも相手との信頼は手放さない、その芯のある柔軟さが魅力になります。',
    '恋に新しい風を吹き込み、変化そのものを楽しめるタイプです。昨日と同じではない二人の時間を面白がる姿勢が、関係にみずみずしさをもたらします。',
  ],

  'features_lead' => '変化志向型は、9216パターン中4.2%と、5つの恋愛タイプの中では自立性型に次いで少ないタイプです。',
  'features_body' => '共通する軸は「関係に新しい風を取り入れることを恋愛の原動力にする」という点です。惚れやすさが高くなりやすい一方、包容力・独占欲・結婚志向は低くなりやすい傾向にあります。副軸によって主に3つのパターンに分かれ、いずれも変化志向が主軸である以上、同じ景色に留まらない柔軟さという核は共通しています。',

  'causal_intro' => '変化志向は、AXIS_TRANSFORMへ1:1で対応するTRAIT_CHANGE、ただ1つのtraitからのみ加算されるプリミティブです。同じく1つのtraitからのみ加算される自立性に次いで、加算される経路が限られています。',
  'causalSources' => [
    ['source' => 'MBTIのP', 'example' => 'ENTP・ISFP等、知覚(P)を持つ8タイプ', 'contribution' => '変化+2（Pが持つ唯一のtrait）'],
    ['source' => '血液型B型', 'example' => '「自由」という通俗特徴', 'contribution' => '変化+2'],
    ['source' => '星座の風（エレメント）・柔軟宮（クオリティ）', 'example' => '双子座・天秤座・水瓶座（風）、双子座・乙女座・射手座・魚座（柔軟宮）', 'contribution' => '風は変化+1、柔軟宮は変化+1。ともに副次スコアのため単独では弱い'],
    ['source' => '星座の内面タイプ', 'example' => '革新型（12種類中1種類）', 'contribution' => '変化+2'],
  ],
  'causal_explanation' => '変化志向はTRAIT_CHANGEという単一のtraitのみに支えられており、かつ星座からの寄与（風・柔軟宮）はいずれも副次スコア（+1）にとどまります。MBTIのPと血液型B型が同時に揃うといった条件が重ならないと主軸まで届きにくいため、変化志向型は5タイプ中4番目という低い出現率になっています。',

  'breakdown_intro' => '変化志向型は、副軸によって主に3つの組み合わせパターンに分かれます（変化志向×自立性はごく低頻度です）。',
  'breakdown' => [
    ['label' => '変化志向×誠実性', 'count' => 146, 'pctOfAll' => 1.584, 'pctOfGroup' => 38.1],
    ['label' => '変化志向×行動主導性', 'count' => 136, 'pctOfAll' => 1.476, 'pctOfGroup' => 35.5],
    ['label' => '変化志向×情動性', 'count' => 89, 'pctOfAll' => 0.966, 'pctOfGroup' => 23.2],
    ['label' => '変化志向×自立性', 'count' => 12, 'pctOfAll' => 0.130, 'pctOfGroup' => 3.1],
  ],

  'data_intro' => 'ここからは、変化志向型に該当する383パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => ['high'=>0,'mid'=>25.6,'low'=>74.4],
    '愛情表現' => ['high'=>0.3,'mid'=>23.2,'low'=>76.5],
    '包容力' => ['high'=>0,'mid'=>1.0,'low'=>99.0],
    '独占欲' => ['high'=>0,'mid'=>8.1,'low'=>91.9],
    '惚れやすさ' => ['high'=>50.1,'mid'=>25.1,'low'=>24.8],
    '嫉妬深さ' => ['high'=>9.4,'mid'=>64.2,'low'=>26.4],
    '恋愛の慎重さ' => ['high'=>0.5,'mid'=>41.5,'low'=>58.0],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>0,'mid'=>0,'low'=>100.0],
    '浮気耐性' => ['high'=>0.3,'mid'=>37.1,'low'=>62.7],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。変化志向型は5タイプ中4番目です。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>50.347, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>26.693, 'self'=>false, 'url'=>'/articles/love/bundle/sensitivity-type/'],
    ['name'=>'行動主導性型', 'pct'=>18.457, 'self'=>false, 'url'=>'/articles/love/bundle/action-type/'],
    ['name'=>'変化志向型', 'pct'=>4.156, 'self'=>true, 'url'=>'#'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>false, 'url'=>'/articles/love/bundle/autonomy-type/'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に、変化志向型への該当率を見ると、大きな差があります。',
  'mbtiRanking' => [
    ['type'=>'ESFP','pct'=>11.8,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTP','pct'=>10.9,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENTP','pct'=>8.5,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ESTP','pct'=>7.8,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISTP','pct'=>6.9,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ENFP','pct'=>6.6,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ISFP','pct'=>5.6,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'INFP','pct'=>4.9,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENFJ','pct'=>0.7,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENTJ','pct'=>0.7,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ESFJ','pct'=>0.7,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTJ','pct'=>0.7,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ESTJ','pct'=>0.3,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'INFJ','pct'=>0.3,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ISFJ','pct'=>0.0,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTJ','pct'=>0.0,'url'=>'/articles/love/mbti/istj/'],
  ],
  'bloodSeizaNote' => '血液型別ではB型が15.4%と突出して高く、A型は0.1%とほぼ存在しません（詳しくは血液型×恋愛の各記事）。星座別では双子座（風・柔軟宮）が13.3%と最も高く、風・柔軟宮のどちらも持たない6星座はいずれも0.8%以下です。地の星座でも、柔軟宮の乙女座は6.8%です（詳しくは星座×恋愛の各記事）。',

  'styleLinksIntro' => '変化志向は、次のStyle・Tendencyの計算式に使われています。変化志向型に該当する方は、これらの項目もあわせてご覧いただくと理解が深まります。',
  'styleLinks' => [
    ['name'=>'惚れやすさ', 'desc'=>'情動性×0.6＋変化志向×0.4。変化志向型ではHigh率50.1%と高い傾向。', 'url'=>'/articles/love/style/horeyasusa-love/'],
    ['name'=>'結婚志向', 'desc'=>'誠実性×0.7－変化志向×0.3。変化志向型ではHigh率0%、Low率100%。', 'url'=>'/articles/love/tendency/kekkonshikou-love/'],
  ],

  'faq' => [
    ['q'=>'変化志向型は珍しいタイプですか？', 'a'=>'はい、9216パターン中4.2%と、5つの恋愛タイプの中では自立性型に次いで少ないタイプです。'],
    ['q'=>'変化志向型は結婚に向いていないのですか？', 'a'=>'そうとは言えません。結婚志向はTendency（推定傾向）であり、性格由来の構造的な傾向を示すものです。変化志向型ではLow率が高い傾向にありますが、実際の結婚観を断定するものではなく、価値観や経験によって大きく変わります。'],
    ['q'=>'なぜ変化志向型は珍しいのですか？', 'a'=>'変化志向は、TRAIT_CHANGEという単一のtraitのみに支えられているプリミティブです。星座からの寄与（風・柔軟宮）も副次スコアにとどまるため、他のプリミティブに比べて主軸まで届きにくい構造になっています。'],
  ],

  'matome' => [
    '変化志向型は、5つのプリミティブのうち変化志向が最も強く出て決まる恋愛タイプで、9216パターン中4.2%（5タイプ中4番目）。',
    '副軸によって主に3パターン（変化志向×行動主導性／誠実性／情動性）に分かれ、最多は変化志向×誠実性（1.6%）。',
    '惚れやすさがHigh率50.1%と高くなりやすい一方、包容力・独占欲・結婚志向はLow傾向が強い。',
    'MBTIではESFP（11.8%）・INTP（10.9%）、血液型ではB型（15.4%）が特に高い該当率を示す。星座では双子座（13.3%）が最も高い。',
    '変化志向はTRAIT_CHANGEという単一のtraitのみに支えられており、これが5タイプ中4番目という低い出現率の理由になっている。',
  ],

  'prev' => ['title'=>'行動主導性型', 'url'=>'/articles/love/bundle/action-type/'],
  'next' => ['title'=>'自立性型', 'url'=>'/articles/love/bundle/autonomy-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
