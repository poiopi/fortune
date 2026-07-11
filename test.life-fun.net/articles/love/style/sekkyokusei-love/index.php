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
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。上位33%がHigh、下位33%がLow、残りがMidです。均等な3分割を狙って設計したものではなく、実際の分布に基づいて決めた閾値です。',
  'normalizer' => ['p33' => 3.20, 'p67' => 4.40],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます（Writing Rulesに基づき、いずれも肯定的な表現で統一しています）。',
  'levels' => [
    'High' => '気になる相手には自分から歩み寄り、想いをまっすぐ伝えていくタイプ。恋のきっかけを自分の手でつかみにいきます。',
    'Mid'  => '押すときと待つときを場面に応じて使い分けるタイプ。相手との距離感を見ながら、自然な流れで関係を進めていけます。',
    'Low'  => '焦って動くより、相手をよく知ってから一歩を踏み出すタイプ。時間をかけて確かめた想いは、相手の心に深く届きます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、積極性が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 29.7, 'mid' => 32.2, 'low' => 38.1],

  'mbti_body' => 'MBTI別に見ると、積極性のHigh率には大きな差があります。最も高いENTJ・ENTPと最も低いISFJ・ISFPでは20倍以上の開きがあります。これは行動主導性がE（外向）とT（思考）の両方から、情動性がN（直感）とF（感情）から寄与するため、E・T・N・Fを多く持つタイプほどHighになりやすいという構造によるものです。',
  'mbtiRanking' => [
    ['type'=>'ENTJ', 'pct'=>64.6, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENTP', 'pct'=>64.6, 'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENFJ', 'pct'=>50.7, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP', 'pct'=>50.7, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ESTJ', 'pct'=>38.5, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESTP', 'pct'=>38.5, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'INTJ', 'pct'=>28.8, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'INTP', 'pct'=>28.8, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ESFJ', 'pct'=>28.8, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ESFP', 'pct'=>28.8, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INFJ', 'pct'=>14.2, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INFP', 'pct'=>14.2, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ISTJ', 'pct'=>9.0,  'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISTP', 'pct'=>9.0,  'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ISFJ', 'pct'=>3.1,  'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISFP', 'pct'=>3.1,  'url'=>'/articles/love/mbti/isfp/'],
  ],

  'blood_body' => '血液型別では、O型が63.9%と突出して高く、A型・B型はどちらも5.9%と低くなっています。これは血液型ごとのTrait Mapping（inc/blood-trait-mapping.php）に由来します。O型は行動主導性・情動性の両方に直接寄与する特性を持つのに対し、A型は誠実性、B型は自立性・変化志向という、積極性の計算式に含まれないプリミティブにのみ寄与するためです。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>5.9],
    ['type'=>'B型', 'pct'=>5.9],
    ['type'=>'O型', 'pct'=>63.9],
    ['type'=>'AB型', 'pct'=>43.2],
  ],

  'bundle_body' => 'Bundle（上位2プリミティブの組み合わせ）の主軸が何であるかによっても、積極性の傾向は大きく変わります。行動主導性が主軸のケースではHigh率71.1%に達する一方、自立性・変化志向が主軸のケースではほぼ0%です。これは積極性の計算式自体が行動主導性・情動性のみを参照し、誠実性・自立性・変化志向を一切参照しないためで、Bundleの実測データが計算式の設計と一致していることを裏付けています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>71.1],
    ['primitive'=>'情動性が主軸',     'pct'=>53.3],
    ['primitive'=>'誠実性が主軸',     'pct'=>6.6],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.7],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '積極性のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ENTJ（High64.6%）', 'url'=>'/articles/love/mbti/entj/', 'highlight'=>true],
    ['label'=>'ENTP（High64.6%）', 'url'=>'/articles/love/mbti/entp/', 'highlight'=>true],
    ['label'=>'ISFJ（High3.1%）',  'url'=>'/articles/love/mbti/isfj/', 'highlight'=>false],
    ['label'=>'ISFP（High3.1%）',  'url'=>'/articles/love/mbti/isfp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'積極性が低いと恋愛がうまくいきませんか？',
     'a'=>'そうとは言えません。積極性は「自分から動くか、相手を待つか」という行動の起点を示す指標であり、優劣を示すものではありません。Low判定でも「じっくり相手をよく知ってから一歩を踏み出す」という前向きな傾向として表示されます。'],
    ['q'=>'積極性はMBTIだけで決まりますか？',
     'a'=>'MBTIの影響が大きい指標ですが、血液型でも大きく変わります（O型63.9%、A型・B型5.9%）。実際の診断結果は、MBTI・血液型・星座の3要素を合算して算出されます。'],
    ['q'=>'なぜHigh/Mid/Lowの境界が33%ずつではないのですか？',
     'a'=>'Love Engineでは、あらかじめ均等な3分割を狙うのではなく、9216通りの実測データから実際の分布に基づいて閾値（P33・P67）を決めています。積極性の場合はP33=3.20、P67=4.40という値になっています。'],
    ['q'=>'積極性と愛情表現は何が違いますか？',
     'a'=>'どちらも行動主導性と情動性から計算されますが、重みが逆です。積極性は行動主導性が主（0.6）で「自分から動くか」を、愛情表現は情動性が主（0.7）で「感情をどれだけ表に出すか」を測ります。詳しくは愛情表現の記事もあわせてご覧ください。'],
  ],

  'matome' => [
    '積極性は、恋愛において自分から動くか相手を待つかという行動の起点を表すStyle指標。',
    '計算式は「行動主導性×0.6＋情動性×0.4」で、行動主導性の影響が大きい。',
    '9216件の実測では、MBTIでENTJ・ENTP（64.6%）が最も高く、ISFJ・ISFP（3.1%）が最も低い。',
    '血液型ではO型（63.9%）が突出して高く、A型・B型（5.9%）は低い。行動主導性・情動性のどちらにも寄与しない血液型は積極性が上がりにくい。',
    'Bundleの主軸が行動主導性のケースではHigh率71.1%に達し、計算式の設計と実測データが一致することを裏付けている。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
