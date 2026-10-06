<?php
$item = [
  'slug' => 'uwakitaisei-love',
  'name' => '浮気耐性',

  'lead' => '「浮気耐性」は、Love Engineが算出する2つの推定傾向（Tendency）指標のひとつです。結婚志向と同じく誠実性が主軸ですが、組み合わせる相手が行動主導性である点が異なります。9216パターンの実測データとともに解説します。',

  'overview' => '浮気耐性は、一度心を決めた相手への気持ちをどれだけ守り抜こうとするかという傾向を表す指標です。',
  'measures_body' => '誠実性が主軸（0.7）で、行動主導性がマイナス（−0.3）に働きます。MBTI記事シリーズでも、行動主導性が高いタイプ（ENTP等）ほど浮気耐性が低くなりやすいという構造として繰り返し登場しました。',

  'formula_intro' => '浮気耐性は、誠実性から行動主導性を差し引く形で計算されます。',
  'formula_expr' => '浮気耐性 = 誠実性 × 0.7 − 行動主導性 × 0.3',
  'formula_explanation' => '誠実性が高いほど、また行動主導性が低いほどスコアが上がります。結婚志向（誠実性−変化志向）とは負に働くプリミティブが異なり、行動主導性が高くても変化志向は低い（あるいはその逆）というタイプでは、結婚志向と浮気耐性の高低が一致しないことがあります。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 1.60, 'p67' => 3.70],

  'levels_intro' => '実際の診断結果は6つの段階で文章が変わります。次はHigh・Mid・Lowそれぞれの代表的な文章（Highはいちばん高い段階、Midは真ん中の段階のひとつ、Lowはいちばん低い段階の文章）です（Tendencyは性格だけで決定できない概念のため、Styleより一段強く断定を避けた表現になっています）。',
  'levels' => [
    'High' => '一度心を決めた相手を、誘惑があっても守り抜こうとする傾向があります。その誠実さが、揺るがない信頼につながります。',
    'Mid'  => '目の前の関係を大事にしつつ、心の揺れとも上手に付き合える傾向があります。対話を重ねるほど、関係はより確かになりそうです。',
    'Low'  => '新しい出会いや刺激に心が開かれている傾向があります。日々ときめきを感じられる関係の中で、想いはまっすぐ育ちそうです。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、浮気耐性が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 33.2, 'mid' => 33.0, 'low' => 33.9],

  'mbti_body' => 'MBTI別ではISFJ（82.6%）が全16タイプ中最も高く、ENTP（5%）が最も低くなっています。誠実性が高く行動主導性が低いタイプほどHighになりやすい構造です。',
  'mbtiRanking' => [
    ['type'=>'ISFJ', 'pct'=>82.6, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ISTJ', 'pct'=>66.5, 'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'INFJ', 'pct'=>48.1, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ISFP', 'pct'=>48.1, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'INTJ', 'pct'=>35.8, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ESFJ', 'pct'=>35.8, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ISTP', 'pct'=>35.8, 'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESTJ', 'pct'=>29.7, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'INFP', 'pct'=>28.3, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'INTP', 'pct'=>23.8, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENFJ', 'pct'=>23.8, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ESFP', 'pct'=>23.8, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'ENTJ', 'pct'=>16.5, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ESTP', 'pct'=>16.5, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ENFP', 'pct'=>10.6, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'ENTP', 'pct'=>5.0,  'url'=>'/articles/love/mbti/entp/'],
  ],

  'blood_body' => '血液型ではA型（85.4%）が突出して高く、O型（11%）が最も低くなっています。O型は行動主導性への直接寄与を持つため、浮気耐性のマイナス項を強めます。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>85.4],
    ['type'=>'B型', 'pct'=>19.9],
    ['type'=>'O型', 'pct'=>11.0],
    ['type'=>'AB型', 'pct'=>16.4],
  ],

  'bundle_body' => 'Bundleの主軸が誠実性のケースでは浮気耐性のHigh率が64.8%に達し、結婚志向（63.1%）とほぼ同水準です。一方、行動主導性が主軸のケースではHighが0%で、行動主導性の強さが浮気耐性を大きく下げることを示しています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>0.0],
    ['primitive'=>'情動性が主軸',     'pct'=>2.0],
    ['primitive'=>'誠実性が主軸',     'pct'=>64.8],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.3],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '浮気耐性のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ISFJ（High82.6%）', 'url'=>'/articles/love/mbti/isfj/', 'highlight'=>true],
    ['label'=>'ISTJ（High66.5%）', 'url'=>'/articles/love/mbti/istj/', 'highlight'=>true],
    ['label'=>'ENTP（High5%）',    'url'=>'/articles/love/mbti/entp/', 'highlight'=>false],
    ['label'=>'ENFP（High10.6%）', 'url'=>'/articles/love/mbti/enfp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'浮気耐性が低いと浮気しやすいのですか？',
     'a'=>'そうとは言えません。Love Engineが示す浮気耐性は性格由来の傾向にすぎず、実際の行動を断定するものではありません。Low判定のうちいちばん低い段階でも「新しい出会いや刺激に心が開かれている傾向」という前向きな表現で示されます。'],
    ['q'=>'浮気耐性と結婚志向は同じ結果になりますか？',
     'a'=>'誠実性が主軸である点は共通しますが、負に働くプリミティブが異なります（浮気耐性は行動主導性、結婚志向は変化志向）。そのため、必ずしも同じ高低にはなりません。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '浮気耐性は、一度心を決めた相手への気持ちをどれだけ守り抜こうとするかを表すTendency指標。',
    '計算式は「誠実性×0.7−行動主導性×0.3」で、結婚志向（誠実性−変化志向）とは負に働くプリミティブが異なる。',
    '9216件の実測では、ISFJ（82.6%）が全16タイプ中最も高く、ENTP（5%）が最も低い。',
    '血液型ではA型（85.4%）が突出して高く、行動主導性への寄与を持つO型（11%）が最も低い。',
    'Bundle主軸が誠実性のケースでHigh率64.8%、行動主導性が主軸のケースでは0%と明確な逆相関。',
  ],
];
require __DIR__ . '/../_tendency-tpl.php';
