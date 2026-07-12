<?php
$item = [
  'slug' => 'kekkonshikou-love',
  'name' => '結婚志向',

  'lead' => '「結婚志向」は、Love Engineが算出する2つの推定傾向（Tendency）指標のひとつです。Styleとは異なり、性格だけで決まる指標ではなく、価値観や経験の影響を強く受ける前提で設計されています。9216パターンの実測データとともに解説します。',

  'overview' => '結婚志向は、恋愛の先に安定した関係や将来をどれだけ描きやすいかという傾向を表す指標です。',
  'measures_body' => 'Styleの「恋愛の慎重さ」と近い計算式（誠実性が主軸）ですが、結婚志向は誠実性に変化志向を組み合わせている点が異なります。',

  'formula_intro' => '結婚志向は、誠実性から変化志向を差し引く形で計算されます。',
  'formula_expr' => '結婚志向 = 誠実性 × 0.7 − 変化志向 × 0.3',
  'formula_explanation' => '誠実性の重みが特に大きく（0.7）、変化を求める度合い（変化志向）が高いほどスコアは下がります。恋愛の慎重さ（誠実性×0.6＋自立性×0.4）と主軸は同じ誠実性ですが、副軸が自立性ではなく変化志向である点、そして変化志向がマイナスに働く点が異なります。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 2.14, 'p67' => 4.20],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます（Tendencyは性格だけで決定できない概念のため、Styleより一段強く断定を避けた表現になっています）。',
  'levels' => [
    'High' => '恋愛の先に、安定した関係や将来の暮らしを思い描く傾向があります。長く続く絆を育てることに喜びを感じやすいようです。',
    'Mid'  => '将来を視野に入れつつ、今の関係そのものを味わいながら進む傾向があります。焦らず二人のペースで歩みを重ねていけそうです。',
    'Low'  => '形にとらわれず、今この瞬間の充実を重んじる傾向があります。自由な間柄だからこそ深まる愛情もあります。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、結婚志向が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 32.3, 'mid' => 34.4, 'low' => 33.3],

  'mbti_body' => 'MBTI別ではISTJ・ISFJ（72%）が最も高く、ENTP・ENFP（7.6%）が最も低くなっています。誠実性が三重に伸びるタイプが上位、P型でかつ誠実性への寄与がないタイプが下位に位置します。',
  'mbtiRanking' => [
    ['type'=>'ISTJ', 'pct'=>72.0, 'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISFJ', 'pct'=>72.0, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'INTJ', 'pct'=>39.2, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'INFJ', 'pct'=>39.2, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ESTJ', 'pct'=>39.2, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESFJ', 'pct'=>39.2, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ISTP', 'pct'=>34.5, 'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ISFP', 'pct'=>34.5, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ENTJ', 'pct'=>25.9, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENFJ', 'pct'=>25.9, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'INTP', 'pct'=>20.0, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'INFP', 'pct'=>20.0, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ESTP', 'pct'=>20.0, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ESFP', 'pct'=>20.0, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'ENTP', 'pct'=>7.6,  'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENFP', 'pct'=>7.6,  'url'=>'/articles/love/mbti/enfp/'],
  ],

  'blood_body' => '血液型ではA型（84.9%）が突出して高く、B型（12.1%）が最も低くなっています。恋愛の慎重さと同様、誠実性の主要な出所であるA型が最も高い数値を示しています。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>84.9],
    ['type'=>'B型', 'pct'=>12.1],
    ['type'=>'O型', 'pct'=>16.1],
    ['type'=>'AB型', 'pct'=>16.1],
  ],

  'bundle_body' => 'Bundleの主軸が誠実性のケースでは結婚志向のHigh率が62.1%に達し、それ以外のプリミティブが主軸のケースでは軒並み数%以下にとどまります。結婚志向がほぼ誠実性だけで決まる指標であることを裏付けています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>0.6],
    ['primitive'=>'情動性が主軸',     'pct'=>1.4],
    ['primitive'=>'誠実性が主軸',     'pct'=>62.1],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.0],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '結婚志向のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ISTJ（High72%）',   'url'=>'/articles/love/mbti/istj/', 'highlight'=>true],
    ['label'=>'ISFJ（High72%）',   'url'=>'/articles/love/mbti/isfj/', 'highlight'=>true],
    ['label'=>'ENTP（High7.6%）',  'url'=>'/articles/love/mbti/entp/', 'highlight'=>false],
    ['label'=>'ENFP（High7.6%）',  'url'=>'/articles/love/mbti/enfp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'結婚志向が低いと結婚に向いていないのですか？',
     'a'=>'そうとは言えません。Love Engineが示す結婚志向は性格由来の傾向にすぎず、実際の結婚観は年齢・価値観・パートナーとの関係性によって大きく変わります。Low判定でも「形にとらわれず、今この瞬間の充実を重んじる傾向」という前向きな表現で示されます。'],
    ['q'=>'結婚志向と恋愛の慎重さは同じですか？',
     'a'=>'どちらも誠実性が主軸ですが、副軸が異なります。結婚志向は誠実性−変化志向、恋愛の慎重さは誠実性＋自立性で計算されます。詳しくはStyle「恋愛の慎重さ」の記事もご覧ください。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '結婚志向は、恋愛の先に安定した関係や将来をどれだけ描きやすいかを表すTendency指標。',
    '計算式は「誠実性×0.7−変化志向×0.3」で、誠実性への依存度が特に高い。',
    '9216件の実測では、ISTJ・ISFJ（72%）が最も高く、ENTP・ENFP（7.6%）が最も低い。',
    '血液型ではA型（84.9%）が突出して高い。',
    'Bundle主軸が誠実性のケースでHigh率62.1%、それ以外はほぼ0〜数%で、誠実性への依存度がほぼ全てを説明する。',
    'Tendencyは性格だけで決まる指標ではなく、価値観・経験の影響を強く受ける前提で設計されている点に注意。',
  ],
];
require __DIR__ . '/../_tendency-tpl.php';
