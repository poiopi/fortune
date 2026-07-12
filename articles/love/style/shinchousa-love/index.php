<?php
$item = [
  'slug' => 'shinchousa-love',
  'name' => '恋愛の慎重さ',

  'lead' => '「恋愛の慎重さ」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。MBTI記事シリーズでも繰り返し登場した、誠実性・自立性という2つのプリミティブから決まる指標です。9216パターンの実測データとともに解説します。',

  'overview' => '恋愛の慎重さは、関係を進めるペースをどれだけ慎重に見極めるかという傾向を表す指標です。',
  'measures_body' => '誠実性（0.6）と自立性（0.4）の加重和です。包容力も誠実性を主軸にしていますが、組み合わせる相手が情動性ではなく自立性である点が異なります。',

  'formula_intro' => '恋愛の慎重さは、誠実性と自立性の加重和です。',
  'formula_expr' => '恋愛の慎重さ = 誠実性 × 0.6 + 自立性 × 0.4',
  'formula_explanation' => '包容力（誠実性×0.6＋情動性×0.4）と主軸の重みは同じですが、副軸が自立性である点が異なります。自立性はMBTIのI（内向・独立由来）からのみ伸びるプリミティブで、E型には一切寄与しません。そのため、恋愛の慎重さはE/Iの違いが最も色濃く出る指標です（MBTI記事シリーズでも、E型ペアとI型ペアの対比として繰り返し取り上げてきました）。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 3.00, 'p67' => 4.60],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます。',
  'levels' => [
    'High' => '勢いに流されず、相手との相性や将来をよく見極めてから関係を進めるタイプ。納得して選んだ恋は揺らぎにくいものです。',
    'Mid'  => '心の高鳴りと冷静さ、その両方を大切にするタイプ。恋を楽しみながらも、要所ではきちんと立ち止まれます。',
    'Low'  => '心が動いたときに、ためらわず流れに乗れるタイプ。フィーリングを信じる恋が、思いがけない縁を運んでくれます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、恋愛の慎重さが実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 36.0, 'mid' => 27.3, 'low' => 36.7],

  'mbti_body' => 'MBTI別ではISTJ・ISFJ（85.4%）が最も高く、ENTP・ENFP（5.7%）が最も低くなっています。誠実性・自立性のどちらもE型には全く寄与しないため、I型が軒並み上位を占める結果になっています。',
  'mbtiRanking' => [
    ['type'=>'ISTJ', 'pct'=>85.4, 'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISFJ', 'pct'=>85.4, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'INTJ', 'pct'=>47.7, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'INFJ', 'pct'=>47.7, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ISTP', 'pct'=>47.7, 'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ISFP', 'pct'=>47.7, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESTJ', 'pct'=>34.9, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ESFJ', 'pct'=>34.9, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'INTP', 'pct'=>28.0, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'INFP', 'pct'=>28.0, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENTJ', 'pct'=>19.3, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENFJ', 'pct'=>19.3, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ESTP', 'pct'=>19.3, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ESFP', 'pct'=>19.3, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'ENTP', 'pct'=>5.7,  'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ENFP', 'pct'=>5.7,  'url'=>'/articles/love/mbti/enfp/'],
  ],

  'blood_body' => '血液型ではA型（84.1%）が突出して高く、O型・AB型（15.5%）が低くなっています。誠実性の主要な出所であるA型が、この指標でも最も高い数値を示しています。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>84.1],
    ['type'=>'B型', 'pct'=>28.8],
    ['type'=>'O型', 'pct'=>15.5],
    ['type'=>'AB型', 'pct'=>15.5],
  ],

  'bundle_body' => 'Bundleの主軸が誠実性のケースでは恋愛の慎重さのHigh率が69.5%に達し、包容力（誠実性主軸で63.4%）と近い水準です。一方、情動性が主軸のケースでは恋愛の慎重さは1.3%にとどまり、包容力（情動性主軸で12.3%）より低くなります。これは自立性が誠実性以上に情動性と相性が悪いプリミティブであることを示しています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>0.0],
    ['primitive'=>'情動性が主軸',     'pct'=>1.3],
    ['primitive'=>'誠実性が主軸',     'pct'=>69.5],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.5],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '恋愛の慎重さのHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ISTJ（High85.4%）', 'url'=>'/articles/love/mbti/istj/', 'highlight'=>true],
    ['label'=>'ISFJ（High85.4%）', 'url'=>'/articles/love/mbti/isfj/', 'highlight'=>true],
    ['label'=>'ENTP（High5.7%）',  'url'=>'/articles/love/mbti/entp/', 'highlight'=>false],
    ['label'=>'ENFP（High5.7%）',  'url'=>'/articles/love/mbti/enfp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'恋愛の慎重さと包容力は何が違いますか？',
     'a'=>'どちらも誠実性が主軸ですが、組み合わせる相手が異なります。恋愛の慎重さは誠実性＋自立性で「関係を進めるペース」を、包容力は誠実性＋情動性で「相手を受け止める力」を測ります。'],
    ['q'=>'なぜE型は恋愛の慎重さが低くなりやすいのですか？',
     'a'=>'恋愛の慎重さの計算式に含まれる自立性というプリミティブは、MBTIのI（内向）からのみ伸び、E（外向）からは伸びません。そのためE型はI型に比べて構造的に低くなりやすい傾向があります。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '恋愛の慎重さは、関係を進めるペースをどれだけ慎重に見極めるかを表すStyle指標。',
    '計算式は「誠実性×0.6＋自立性×0.4」。包容力と同じ誠実性主軸だが、副軸が自立性である点が異なる。',
    '9216件の実測では、ISTJ・ISFJ（85.4%）が最も高く、ENTP・ENFP（5.7%）が最も低い。',
    '血液型ではA型（84.1%）が突出して高い。',
    '自立性はE型に一切寄与しないため、E/Iの違いが最も色濃く出る指標。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
