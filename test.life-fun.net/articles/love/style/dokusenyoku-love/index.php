<?php
$item = [
  'slug' => 'dokusenyoku-love',
  'name' => '独占欲',

  'lead' => '「独占欲」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。情動性を主軸とする点は「惚れやすさ」「嫉妬深さ」と共通しますが、組み合わせるプリミティブが異なるため、それぞれ独立した意味を持ちます。9216パターンの実測データとともに解説します。',

  'overview' => '独占欲は、恋愛関係において相手との結びつきをどれだけ強く求めるかという傾向を表す指標です。',
  'measures_body' => '情動性が主軸（0.7）で、自立性がマイナス（−0.3）に働きます。自立性が低い（自分の時間や独立性より相手との関係を優先する）ほど独占欲は高まりやすい構造です。',

  'formula_intro' => '独占欲は、情動性から自立性を差し引く形で計算されます。',
  'formula_expr' => '独占欲 = 情動性 × 0.7 − 自立性 × 0.3',
  'formula_explanation' => '情動性が主軸である点は惚れやすさ・嫉妬深さと共通しますが、負に働く項が異なります。独占欲は自立性（自分の時間・独立を求める度合い）が高いほど下がり、嫉妬深さは誠実性（信頼性）が高いほど下がります。「相手を束縛したいか」（独占欲・自立性と対立）と「相手を疑いやすいか」（嫉妬深さ・誠実性と対立）は、Love Engineの中では別のプリミティブと結びついた別の概念として扱われています。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 2.20, 'p67' => 3.60],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます。',
  'levels' => [
    'High' => '好きになった相手への想いが深く、二人だけの時間や絆を何より大事にするタイプ。その一途さは大きな魅力です。',
    'Mid'  => '相手を想いながらも、縛りすぎない距離感を保てるタイプ。近すぎず遠すぎない関係が、長続きの土台になります。',
    'Low'  => '相手の交友関係や一人の時間を尊重するタイプ。互いを縛らない信頼ベースの関係が、二人をのびやかに保ちます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、独占欲が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 31.1, 'mid' => 30.5, 'low' => 38.4],

  'mbti_body' => 'MBTI別ではENFJ・ENFP（65.6%）が最も高く、ISTJ・ESTJ・ISTP・ESTP（4.2%）が最も低くなっています。情動性が二重に伸びるF型かつP/J型のタイプが上位を占めます。',
  'mbtiRanking' => [
    ['type'=>'ENFJ', 'pct'=>65.6, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP', 'pct'=>65.6, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'INFJ', 'pct'=>62.5, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INFP', 'pct'=>62.5, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENTJ', 'pct'=>29.2, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENTP', 'pct'=>29.2, 'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ESFJ', 'pct'=>29.2, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ESFP', 'pct'=>29.2, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTJ', 'pct'=>27.1, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'INTP', 'pct'=>27.1, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ISFJ', 'pct'=>27.1, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISFP', 'pct'=>27.1, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ISTJ', 'pct'=>4.2,  'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ESTJ', 'pct'=>4.2,  'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ISTP', 'pct'=>4.2,  'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESTP', 'pct'=>4.2,  'url'=>'/articles/love/mbti/estp/'],
  ],

  'blood_body' => '血液型ではO型・AB型（51.6%）が高く、B型（4.2%）が最も低くなっています。B型はTrait MappingでCHANGE・INDEPが自立性に寄与するため、独占欲のマイナス項を強めます。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>17.2],
    ['type'=>'B型', 'pct'=>4.2],
    ['type'=>'O型', 'pct'=>51.6],
    ['type'=>'AB型', 'pct'=>51.6],
  ],

  'bundle_body' => 'Bundleの主軸が情動性のケースでは独占欲のHigh率が74.3%に達し、誠実性が主軸のケースでは15.2%にとどまります。自立性が主軸のケース（n=32、少数）ではHighが0%で、自立性の高さが独占欲を強く抑制することを示しています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>16.2],
    ['primitive'=>'情動性が主軸',     'pct'=>74.3],
    ['primitive'=>'誠実性が主軸',     'pct'=>15.2],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.0],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '独占欲のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ENFJ（High65.6%）', 'url'=>'/articles/love/mbti/enfj/', 'highlight'=>true],
    ['label'=>'ENFP（High65.6%）', 'url'=>'/articles/love/mbti/enfp/', 'highlight'=>true],
    ['label'=>'ISTJ（High4.2%）',  'url'=>'/articles/love/mbti/istj/', 'highlight'=>false],
    ['label'=>'ESTJ（High4.2%）',  'url'=>'/articles/love/mbti/estj/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'独占欲と嫉妬深さは同じ意味ですか？',
     'a'=>'似ていますが計算式が異なります。独占欲は情動性から自立性を差し引き「相手との結びつきの強さ」を、嫉妬深さは情動性から誠実性を差し引き「相手への疑いやすさ」を測ります。独占欲が高くても嫉妬深さは低い（束縛は求めないが浮気は疑わない）、という組み合わせも起こり得ます。'],
    ['q'=>'独占欲が高いと重い恋愛になりますか？',
     'a'=>'Highは「その一途さは大きな魅力」という前向きな傾向として表示されます。優劣を示す指標ではありません。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '独占欲は、相手との結びつきをどれだけ強く求めるかを表すStyle指標。',
    '計算式は「情動性×0.7−自立性×0.3」。同じ情動性主軸の惚れやすさ・嫉妬深さとは、組み合わせるプリミティブ（変化志向・誠実性）が異なり、それぞれ独立した概念。',
    '9216件の実測では、ENFJ・ENFP（65.6%）が最も高く、ISTJ・ESTJ・ISTP・ESTP（4.2%）が最も低い。',
    '血液型ではO型・AB型（51.6%）が高く、自立性への寄与を持つB型（4.2%）が最も低い。',
    'Bundle主軸が自立性のケースではHighが0%で、自立性の高さが独占欲を強く抑制する。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
