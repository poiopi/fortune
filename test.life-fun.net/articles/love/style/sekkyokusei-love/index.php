<?php
$item = [
  'slug' => 'sekkyokusei-love',
  'name' => '積極性',

  'lead' => '「積極性」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。9216パターンの実測データをもとに、この指標が何を測り、どう計算され、MBTIや血液型でどう傾向が変わるのかを解説します。',

  'overview' => '積極性は、恋愛において自分から相手に働きかけるか、それとも相手のペースを待つかという傾向を表す指標です。',
  'measures_body' => '「押しが強い／弱い」という優劣の指標ではなく、恋愛関係における行動の起点がどちらにあるかを示す指標です。Highだからといって恋愛が上手くいきやすいわけではなく、Lowだからといって消極的で不利というわけでもありません。',

  'formula_intro' => '積極性は、Primitive（性格プリミティブ）のうち「行動主導性」と「情動性」の加重和として計算されます。',
  'formula_expr' => '積極性 = 行動主導性 × 0.6 + 情動性 × 0.4',
  'formula_explanation' => '行動主導性の重みが情動性より大きく設定されているため、行動主導性が高い人ほど積極性のスコアが上がりやすい構造です。情動性は補助的な影響にとどまります。この式はinc/love-style.phpのLOVE_STYLE_MAPPINGで定義されており、docs/love/04-style.mdの設計がそのままコード化されたものです。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。境目は、実測データの下から3分の1（P33）・3分の2（P67）の位置です。ただし同じ値の人がまとまって存在するため、実際の割合はHigh28.9%・Mid36.7%・Low34.5%と、ちょうど3分の1ずつにはなりません。',
  'normalizer' => ['p33' => 3.20, 'p67' => 4.60],

  'levels_intro' => '実際の診断結果は6つの段階で文章が変わります。次はHigh・Mid・Lowそれぞれの代表的な文章（Highはいちばん高い段階、Midは真ん中の段階のひとつ、Lowはいちばん低い段階の文章）です（Writing Rulesに基づき、いずれも肯定的な表現で統一しています）。',
  'levels' => [
    'High' => '気になる相手には自分から歩み寄り、想いをまっすぐ伝えていくタイプ。恋のきっかけを自分の手でつかみにいきます。',
    'Mid'  => '押すときと待つときを場面に応じて使い分けるタイプ。相手との距離感を見ながら、自然な流れで関係を進めていけます。',
    'Low'  => '焦って動くより、相手をよく知ってから一歩を踏み出すタイプ。時間をかけて確かめた想いは、相手の心に深く届きます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、積極性が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 28.9, 'mid' => 36.7, 'low' => 34.5],

  'mbti_body' => 'MBTI別に見ると、積極性のHigh率には大きな差があります。最も高いENTJ・ENTPと最も低いISFJ・ISFPでは10倍以上の開きがあります。これは行動主導性がE（外向）とT（思考）の両方から、情動性がN（直感）とF（感情）から寄与するため、E・T・N・Fを多く持つタイプほどHighになりやすいという構造によるものです。',
  'mbtiRanking' => [
    ['type'=>'ENTJ', 'pct'=>57.3, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENTP', 'pct'=>57.3, 'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENFJ', 'pct'=>51.7, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP', 'pct'=>51.7, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ESTJ', 'pct'=>35.4, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESTP', 'pct'=>35.4, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'INTJ', 'pct'=>27.8, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'INTP', 'pct'=>27.8, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ESFJ', 'pct'=>27.8, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ESFP', 'pct'=>27.8, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INFJ', 'pct'=>17.5, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INFP', 'pct'=>17.5, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ISTJ', 'pct'=>8.5,  'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISTP', 'pct'=>8.5,  'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ISFJ', 'pct'=>5.0,  'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISFP', 'pct'=>5.0,  'url'=>'/articles/love/mbti/isfp/'],
  ],

  'blood_body' => '血液型別では、O型が62.3%と突出して高く、A型・B型はどちらも6.3%と低くなっています。これは血液型ごとのTrait Mapping（inc/blood-trait-mapping.php）に由来します。O型は行動主導性・情動性の両方に直接寄与する特性を持つのに対し、A型は誠実性、B型は自立性・変化志向という、積極性の計算式に含まれないプリミティブにのみ寄与するためです。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>6.3],
    ['type'=>'B型', 'pct'=>6.3],
    ['type'=>'O型', 'pct'=>62.3],
    ['type'=>'AB型', 'pct'=>40.5],
  ],

  'bundle_body' => 'Bundle（上位2プリミティブの組み合わせ）の主軸が何であるかによっても、積極性の傾向は大きく変わります。行動主導性が主軸のケースではHigh率60.7%に達する一方、自立性・変化志向が主軸のケースでは0%です。これは積極性の計算式自体が行動主導性・情動性のみを参照し、誠実性・自立性・変化志向を一切参照しないためで、Bundleの実測データが計算式の設計と一致していることを裏付けています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>60.7],
    ['primitive'=>'情動性が主軸',     'pct'=>55.8],
    ['primitive'=>'誠実性が主軸',     'pct'=>5.5],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.0],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '積極性のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ENTJ（High57.3%）', 'url'=>'/articles/love/mbti/entj/', 'highlight'=>true],
    ['label'=>'ENTP（High57.3%）', 'url'=>'/articles/love/mbti/entp/', 'highlight'=>true],
    ['label'=>'ISFJ（High5%）',    'url'=>'/articles/love/mbti/isfj/', 'highlight'=>false],
    ['label'=>'ISFP（High5%）',    'url'=>'/articles/love/mbti/isfp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'積極性が低いと恋愛がうまくいきませんか？',
     'a'=>'そうとは言えません。積極性は「自分から動くか、相手を待つか」という行動の起点を示す指標であり、優劣を示すものではありません。Low判定のうちいちばん低い段階でも「相手をよく知ってから一歩を踏み出す」という前向きな傾向として表示されます。'],
    ['q'=>'積極性はMBTIだけで決まりますか？',
     'a'=>'MBTIの影響が大きい指標ですが、血液型でも大きく変わります（O型62.3%、A型・B型6.3%）。実際の診断結果は、MBTI・血液型・星座の3要素を合算して算出されます。'],
    ['q'=>'なぜHigh/Mid/Lowの境界が33%ずつではないのですか？',
     'a'=>'Love Engineでは、9216通りの実測データの下から3分の1・3分の2の位置（P33・P67）を境目にしています。指標ごとにスコアの分布が違うため、境目の値は指標ごとに異なり、積極性の場合はP33=3.20、P67=4.60という値になっています。また、同じ値の人がまとまって存在するため、実際の割合もちょうど3分の1ずつにはなりません。'],
    ['q'=>'積極性と愛情表現は何が違いますか？',
     'a'=>'どちらも行動主導性と情動性から計算されますが、重みが逆です。積極性は行動主導性が主（0.6）で「自分から動くか」を、愛情表現は情動性が主（0.7）で「感情をどれだけ表に出すか」を測ります。詳しくは愛情表現の記事もあわせてご覧ください。'],
  ],

  'matome' => [
    '積極性は、恋愛において自分から動くか相手を待つかという行動の起点を表すStyle指標。',
    '計算式は「行動主導性×0.6＋情動性×0.4」で、行動主導性の影響が大きい。',
    '9216件の実測では、MBTIでENTJ・ENTP（57.3%）が最も高く、ISFJ・ISFP（5%）が最も低い。',
    '血液型ではO型（62.3%）が突出して高く、A型・B型（6.3%）は低い。行動主導性・情動性のどちらにも寄与しない血液型は積極性が上がりにくい。',
    'Bundleの主軸が行動主導性のケースではHigh率60.7%に達し、計算式の設計と実測データが一致することを裏付けている。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
