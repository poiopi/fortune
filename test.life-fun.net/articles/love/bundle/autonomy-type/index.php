<?php
$item = [
  'slug' => 'autonomy-type',
  'name' => '自立性型',
  'primitiveName' => '自立性',
  'primitiveCode' => 'AUT',
  'pct' => 0.35,
  'sampleSize' => 32,
  'title' => '自立性型の恋愛傾向｜Love Engineの実測データで解説',
  'h1' => '自立性型の恋愛傾向｜Love Engineの実測データで解説',
  'description' => '恋愛タイプ（Bundle）のうち、自立性が最も強く出る「自立性型」の恋愛傾向をLove Engineの実測データ（9216パターン中0.35%）で解説。5タイプの中で最も出現数が少ない、レアな組み合わせの理由を紹介。',
  'lead' => '恋愛診断の結果画面に表示される文章のうち、5つの性格プリミティブの中で「自立性」が最も強く出て決まるのが「自立性型」です。9216パターン中わずか32パターン（0.35%）しか出現しない、5タイプの中で最もレアな組み合わせです。このページでは、なぜこれほど珍しいのか、Love Engineの実測データをもとに解説します。',

  'selfCheckIntro' => '診断結果に、次の文章が表示された方は自立性型です。自立性型は出現数が非常に少ないため、Love Engineでは1つの共通する文章で表現されています。',
  'selfCheckQuotes' => [
    '恋愛の中でも自分の世界や時間を大切にできる、自立心の際立つタイプです。互いに寄りかかりすぎない対等な関係を心地よく感じ、相手を尊重しながら恋を育てていきます。',
  ],

  'features_lead' => '自立性型は、9216パターン中0.35%（32パターン）と、5つの恋愛タイプの中で最も出現数が少ないタイプです。',
  'features_body' => '珍しい＝望ましくない、という意味ではありません。共通する軸は「相手と適度な距離を保ちながら関係を築く」という点です。積極性・愛情表現・独占欲・包容力はいずれも低くなりやすい一方、これは「相手に依存しすぎない」という自立性型ならではの持ち味の表れでもあります。',

  'causal_intro' => '自立性がこれほど出現しにくいのには、明確な構造上の理由があります。他の4つのプリミティブと違い、星座のエレメント（火・地・風・水）・クオリティ（活動宮・不動宮・柔軟宮）のいずれからも自立性への寄与が一切ありません。',
  'causalSources' => [
    ['source' => 'MBTIのI', 'example' => 'INTJ・ISFP等、内向(I)を持つ8タイプ全て', 'contribution' => '独立+1（副次特性。慎重さ+2が主特性のため、自立性への寄与は小さい）'],
    ['source' => '血液型B型', 'example' => '「マイペース」という通俗特徴', 'contribution' => '独立+2'],
    ['source' => '星座の内面タイプ', 'example' => '表現型・自由型（12種類中2種類のみ）', 'contribution' => '独立+1〜+2'],
    ['source' => '星座のエレメント・クオリティ', 'example' => '（該当なし）', 'contribution' => '寄与なし。火・地・風・水、活動宮・不動宮・柔軟宮のいずれも自立性には変換されない'],
  ],
  'causal_explanation' => 'つまり自立性は、MBTIのI（弱め）・血液型B型・星座の一部の内面タイプという限られた経路からしか加算されません。他の4プリミティブが複数の経路を持つのに対し、自立性が主軸まで届くには、これらの条件が特定の組み合わせで重ならないといけないため、9216パターン中32パターンという極めてレアな結果になっています。',

  'breakdown_intro' => '自立性型は、副軸によって次の組み合わせパターンに分かれます。自立性×行動主導性（LOVE_AUT_ACT）は9216パターン中1件も出現しませんでした。',
  'breakdown' => [
    ['label' => '自立性×誠実性', 'count' => 14, 'pctOfAll' => 0.152, 'pctOfGroup' => 43.8],
    ['label' => '自立性×変化志向', 'count' => 14, 'pctOfAll' => 0.152, 'pctOfGroup' => 43.8],
    ['label' => '自立性×情動性', 'count' => 4, 'pctOfAll' => 0.043, 'pctOfGroup' => 12.5],
    ['label' => '自立性×行動主導性', 'count' => 0, 'pctOfAll' => 0.000, 'pctOfGroup' => 0.0],
  ],

  'data_intro' => 'ここからは、自立性型に該当する32パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。サンプル数が少ないため、他タイプ以上に参考値としてご覧ください。',
  'styles' => [
    '積極性' => ['high'=>0,'mid'=>12.5,'low'=>87.5],
    '愛情表現' => ['high'=>0,'mid'=>12.5,'low'=>87.5],
    '包容力' => ['high'=>0,'mid'=>0,'low'=>100.0],
    '独占欲' => ['high'=>0,'mid'=>0,'low'=>100.0],
    '惚れやすさ' => ['high'=>21.9,'mid'=>34.4,'low'=>43.8],
    '嫉妬深さ' => ['high'=>0,'mid'=>68.8,'low'=>31.2],
    '恋愛の慎重さ' => ['high'=>0,'mid'=>100.0,'low'=>0],
  ],
  'tendencies' => [
    '結婚志向' => ['high'=>0,'mid'=>6.2,'low'=>93.8],
    '浮気耐性' => ['high'=>0,'mid'=>71.9,'low'=>28.1],
  ],

  'compare_intro' => '恋愛タイプ（Bundle）は、主軸プリミティブによって5つに分類されます。自立性型は5タイプ中最少です。',
  'groupCompare' => [
    ['name'=>'誠実性型', 'pct'=>51.226, 'self'=>false, 'url'=>'/articles/love/bundle/reliability-type/'],
    ['name'=>'情動性型', 'pct'=>27.919, 'self'=>false, 'url'=>'/articles/love/bundle/sensitivity-type/'],
    ['name'=>'行動主導性型', 'pct'=>16.092, 'self'=>false, 'url'=>'/articles/love/bundle/action-type/'],
    ['name'=>'変化志向型', 'pct'=>4.416, 'self'=>false, 'url'=>'/articles/love/bundle/transform-type/'],
    ['name'=>'自立性型', 'pct'=>0.347, 'self'=>true, 'url'=>'#'],
  ],

  'mbti_intro' => 'MBTI16タイプ別に見ても、自立性型への該当率は全体的に低く、多くのタイプで0%です。',
  'mbtiRanking' => [
    ['type'=>'INTP','pct'=>1.7,'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'INTJ','pct'=>1.0,'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ISFP','pct'=>0.9,'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ISTP','pct'=>0.9,'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'INFP','pct'=>0.7,'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'INFJ','pct'=>0.3,'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ENFJ','pct'=>0.0,'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP','pct'=>0.0,'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ENTJ','pct'=>0.0,'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENTP','pct'=>0.0,'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ESFJ','pct'=>0.0,'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ESFP','pct'=>0.0,'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'ESTJ','pct'=>0.0,'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESTP','pct'=>0.0,'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISFJ','pct'=>0.0,'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTJ','pct'=>0.0,'url'=>'/articles/love/mbti/istj/'],
  ],
  'bloodSeizaNote' => '自立性型が出現するのは、MBTIのIタイプ（内向）に限られます。血液型別ではB型のみで1.4%、A型・O型・AB型では0%です。星座別でも天秤座0.8%が最も高い程度で、全体的に極めて低い水準です。',

  'styleLinksIntro' => '自立性は、次のStyle・Tendencyの計算式に使われています。',
  'styleLinks' => [
    ['name'=>'独占欲', 'desc'=>'情動性×0.7－自立性×0.3。自立性型ではHigh率0%、Low率100%。', 'url'=>'/articles/love/style/dokusenyoku-love/'],
    ['name'=>'恋愛の慎重さ', 'desc'=>'誠実性×0.6＋自立性×0.4。自立性型ではMid率100%という結果になっている。', 'url'=>'/articles/love/style/shinchousa-love/'],
  ],

  'faq' => [
    ['q'=>'自立性型は珍しいタイプですか？', 'a'=>'はい、9216パターン中0.35%（32パターン）と、5つの恋愛タイプの中で最も出現数が少ないタイプです。ただし、珍しいことは「望ましくない」という意味ではなく、それだけ限られた条件でしか成立しない特徴的な組み合わせということです。'],
    ['q'=>'なぜ自立性型はこれほど珍しいのですか？', 'a'=>'自立性は、MBTIのI（弱め）・血液型B型・星座の一部の内面タイプという限られた経路からしか加算されないプリミティブです。特に星座のエレメント・クオリティからは一切寄与がなく、他の4プリミティブより加算経路が少ないことが理由です。'],
    ['q'=>'自立性型に他のタイプのような詳しい文章バリエーションがないのはなぜですか？', 'a'=>'出現数が32パターンと少なく、かつ副軸パターンごとの件数もさらに少ないため、Love Engineでは自立性型を1つの共通する文章で表現しています。同じ理由で、Bundle全体でも出現率が低い8パターンは共通の文章を使う設計になっています（詳しくは「Bundleとは」）。'],
    ['q'=>'自立性型は変化志向型と同じような文章になりますか？', 'a'=>'自立性×変化志向（LOVE_AUT_TRA）は自立性型の文章を使いますが、変化志向×自立性（LOVE_TRA_AUT、主軸が変化志向のケース）は変化志向型の文章を使います。主軸がどちらかによって、表示される文章が変わります。'],
  ],

  'matome' => [
    '自立性型は、5つのプリミティブのうち自立性が最も強く出て決まる恋愛タイプで、9216パターン中0.35%（32パターン）と5タイプ中最少。',
    '自立性は、星座のエレメント・クオリティからは一切寄与がなく、MBTIのI（弱め）・血液型B型・星座の一部の内面タイプという限られた経路からしか加算されない。',
    '出現数が少ないため、Love Engineでは自立性型を1つの共通する文章で表現している。',
    '独占欲・包容力はLow傾向が強く、恋愛の慎重さはMidに集中するという結果になっている。',
    '珍しいことは「望ましくない」という意味ではなく、相手と適度な距離を保つという自立性型ならではの持ち味の表れでもある。',
  ],

  'prev' => ['title'=>'変化志向型', 'url'=>'/articles/love/bundle/transform-type/'],
];
require __DIR__ . '/../_bundle-tpl.php';
