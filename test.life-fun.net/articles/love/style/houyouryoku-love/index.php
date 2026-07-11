<?php
$item = [
  'slug' => 'houyouryoku-love',
  'name' => '包容力',

  'lead' => '「包容力」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。積極性・愛情表現とは異なり、誠実性というプリミティブが主軸になる、Styleの中で初めての指標です。9216パターンの実測データとともに解説します。',

  'overview' => '包容力は、相手をどれだけ受け止め、関係の土台を安定させられるかという傾向を表す指標です。',
  'measures_body' => '積極性・愛情表現が行動主導性・情動性を使うのに対し、包容力は誠実性が主軸（0.6）です。関係にどれだけ安定した基盤を提供できるかを測る指標であり、積極的に動くタイプかどうかとは別の軸です。',

  'formula_intro' => '包容力は、誠実性と情動性の加重和です。誠実性の重みが最も大きく設定されています。',
  'formula_expr' => '包容力 = 誠実性 × 0.6 + 情動性 × 0.4',
  'formula_explanation' => '誠実性の重みが最も大きく、次いで情動性が影響します。誠実性はMBTIのI（内向・慎重さ由来）・J（判断・責任感由来）、血液型のA型（誠実性への強い寄与）から特に伸びやすいプリミティブです。積極性・愛情表現とは参照するプリミティブが異なるため、行動的なタイプが必ずしも包容力が高いとは限りません。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 4.40, 'p67' => 5.80],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます。',
  'levels' => [
    'High' => '相手の気持ちを丸ごと受け止め、関係をじっくり育てていくタイプ。一緒にいるだけでほっとできる存在になれます。',
    'Mid'  => '受け止める優しさと、言うべきことを伝える率直さを併せ持つタイプ。もたれ合わない対等な関係を心地よく保てます。',
    'Low'  => '相手に合わせすぎず、自分の気持ちにも正直でいるタイプ。飾らない素顔の付き合いが、風通しのよい関係をつくります。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、包容力が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 35.9, 'mid' => 27.9, 'low' => 36.2],

  'mbti_body' => 'MBTI別ではISFJ（84.9%）が全16タイプ中最も高く、ENTP（7.3%）が最も低くなっています。誠実性がI・S・Jの三重寄与になるISFJ・ISTJが上位を占め、行動主導性・情動性中心のENTP・ESTPが下位に位置します。',
  'mbtiRanking' => [
    ['type'=>'ISFJ', 'pct'=>84.9, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'INFJ', 'pct'=>71.4, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ISTJ', 'pct'=>56.9, 'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'INTJ', 'pct'=>46.0, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ESFJ', 'pct'=>46.0, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ISFP', 'pct'=>46.0, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'INFP', 'pct'=>32.5, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENFJ', 'pct'=>32.5, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ESTJ', 'pct'=>26.7, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ISTP', 'pct'=>26.7, 'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'INTP', 'pct'=>22.9, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENTJ', 'pct'=>22.9, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ESFP', 'pct'=>22.9, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'ENFP', 'pct'=>18.1, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ESTP', 'pct'=>10.9, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ENTP', 'pct'=>7.3,  'url'=>'/articles/love/mbti/entp/'],
  ],

  'blood_body' => '血液型ではA型が86.9%と突出しており、B型（8.6%）・O型/AB型（24.1%）を大きく引き離しています。A型はTrait MappingでCARE・DUTY・STABILITYの3つすべてが誠実性に寄与するため、包容力の主要プリミティブと強く結びついています。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>86.9],
    ['type'=>'B型', 'pct'=>8.6],
    ['type'=>'O型', 'pct'=>24.1],
    ['type'=>'AB型', 'pct'=>24.1],
  ],

  'bundle_body' => 'Bundleの主軸が誠実性のケースでは包容力のHigh率が63.4%に達する一方、行動主導性が主軸のケースではほぼ0%（0.1%）です。積極性とは正反対の相関パターンで、包容力が誠実性ドリブンの指標であることを裏付けています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>0.1],
    ['primitive'=>'情動性が主軸',     'pct'=>12.3],
    ['primitive'=>'誠実性が主軸',     'pct'=>63.4],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.0],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '包容力のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ISFJ（High84.9%）', 'url'=>'/articles/love/mbti/isfj/', 'highlight'=>true],
    ['label'=>'INFJ（High71.4%）', 'url'=>'/articles/love/mbti/infj/', 'highlight'=>true],
    ['label'=>'ENTP（High7.3%）',  'url'=>'/articles/love/mbti/entp/', 'highlight'=>false],
    ['label'=>'ESTP（High10.9%）', 'url'=>'/articles/love/mbti/estp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'包容力と恋愛の慎重さは同じですか？',
     'a'=>'どちらも誠実性が主軸のプリミティブですが、組み合わせる相手が違います。包容力は誠実性＋情動性で「相手を受け止める力」を、恋愛の慎重さは誠実性＋自立性で「関係を進めるペース」を測ります。同じ誠実性ベースでも意味は異なります。'],
    ['q'=>'包容力が低いと冷たい人ですか？',
     'a'=>'そうではありません。Low判定でも「相手に合わせすぎず、自分の気持ちにも正直でいるタイプ」という前向きな傾向として表示されます。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '包容力は、相手をどれだけ受け止め関係の土台を安定させられるかを表すStyle指標。',
    '計算式は「誠実性×0.6＋情動性×0.4」で、積極性・愛情表現とは異なり誠実性が主軸になる初めての指標。',
    '9216件の実測では、ISFJ（84.9%）が全16タイプ中最も高く、ENTP（7.3%）が最も低い。',
    '血液型ではA型（86.9%）が突出して高い。CARE・DUTY・STABILITYの3特性すべてが誠実性に寄与するため。',
    'Bundle主軸が誠実性のケースでHigh率63.4%、行動主導性が主軸のケースでは0.1%とほぼ逆相関。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
