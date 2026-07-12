<?php
$item = [
  'slug' => 'shittobukasa-love',
  'name' => '嫉妬深さ',

  'lead' => '「嫉妬深さ」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。「独占欲」と同じく情動性が主軸ですが、負に働くプリミティブが誠実性である点が異なります。9216パターンの実測データとともに解説します。',

  'overview' => '嫉妬深さは、相手の言動に対してどれだけ感情が揺れ動きやすいかという傾向を表す指標です。',
  'measures_body' => '情動性（0.6）から誠実性（0.4）を差し引く形で計算されます。誠実性が高い（信頼をベースに考える度合いが強い）ほど、嫉妬深さのスコアは下がります。',

  'formula_intro' => '嫉妬深さは、情動性から誠実性を差し引く形で計算されます。',
  'formula_expr' => '嫉妬深さ = 情動性 × 0.6 − 誠実性 × 0.4',
  'formula_explanation' => '独占欲（情動性−自立性）と混同されやすい指標ですが、負に働く項が異なります。誠実性が高いタイプ（I・J・S・A型など）は、情動性が高くても嫉妬深さは相殺されて低くなりやすい一方、独占欲はそのまま高く出ることがあります。「束縛したいが疑ってはいない」というタイプは、この2指標の違いによって表現されます。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。嫉妬深さは加重和が負の値を取りうるため、P33も負の値（-0.40）になっています。',
  'normalizer' => ['p33' => -0.40, 'p67' => 1.60],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます。',
  'levels' => [
    'High' => '相手のささいな変化にもすぐ気づく、感受性の細やかなタイプ。心が揺れるのは、それだけ真剣に恋と向き合っている証です。',
    'Mid'  => '気になることは受け止めつつ、感情の波に飲み込まれないタイプ。気持ちを素直に共有できれば、二人の関係はさらに深まります。',
    'Low'  => '相手の行動に一喜一憂せず、どっしり構えていられるタイプ。その落ち着きが、相手にのびのびとした安心感を与えます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、嫉妬深さが実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 28.2, 'mid' => 34.5, 'low' => 37.3],

  'mbti_body' => 'MBTI別ではENFP（72.2%）が最も高く、ISTJ（0%）が最も低くなっています。誠実性への寄与を持たないP型のF型が上位、誠実性が三重に伸びるISTJ・ISFJが下位に集まります。',
  'mbtiRanking' => [
    ['type'=>'ENFP', 'pct'=>72.2, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'INFP', 'pct'=>59.0, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENFJ', 'pct'=>59.0, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENTP', 'pct'=>49.0, 'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'INFJ', 'pct'=>43.1, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INTP', 'pct'=>32.6, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENTJ', 'pct'=>32.6, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ESFP', 'pct'=>32.6, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTJ', 'pct'=>16.7, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ESFJ', 'pct'=>16.7, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ISFP', 'pct'=>16.7, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESTP', 'pct'=>8.3,  'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISFJ', 'pct'=>6.9,  'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ESTJ', 'pct'=>2.8,  'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ISTP', 'pct'=>2.8,  'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ISTJ', 'pct'=>0.0,  'url'=>'/articles/love/mbti/istj/'],
  ],

  'blood_body' => '血液型ではO型・AB型（45.2%）が高く、A型（1.7%）が最も低くなっています。A型はCARE・DUTY・STABILITYすべてが誠実性に寄与するため、嫉妬深さのマイナス項が最も強く働きます。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>1.7],
    ['type'=>'B型', 'pct'=>20.7],
    ['type'=>'O型', 'pct'=>45.2],
    ['type'=>'AB型', 'pct'=>45.2],
  ],

  'bundle_body' => 'Bundleの主軸が誠実性のケースでは嫉妬深さのHigh率が0%です。積極性・愛情表現・惚れやすさは誠実性主軸でHigh率が1桁台、独占欲も15.2%と低めにとどまりますが、嫉妬深さは唯一0%ちょうどになっており、誠実性が嫉妬深さを最も強く抑制するプリミティブであることを示しています。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>24.2],
    ['primitive'=>'情動性が主軸',     'pct'=>85.5],
    ['primitive'=>'誠実性が主軸',     'pct'=>0.0],
    ['primitive'=>'変化志向が主軸',   'pct'=>9.8],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '嫉妬深さのHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ENFP（High72.2%）', 'url'=>'/articles/love/mbti/enfp/', 'highlight'=>true],
    ['label'=>'INFP（High59%）',   'url'=>'/articles/love/mbti/infp/', 'highlight'=>true],
    ['label'=>'ISTJ（High0%）',    'url'=>'/articles/love/mbti/istj/', 'highlight'=>false],
    ['label'=>'ESTJ（High2.8%）',  'url'=>'/articles/love/mbti/estj/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'嫉妬深さと独占欲は同じですか？',
     'a'=>'似ていますが別の指標です。独占欲は情動性から自立性を差し引き「相手との結びつきの強さ」を、嫉妬深さは情動性から誠実性を差し引き「感情の揺れやすさ」を測ります。詳しくは独占欲の記事もあわせてご覧ください。'],
    ['q'=>'嫉妬深さが高いと重いですか？',
     'a'=>'そうではありません。Highは「それだけ真剣に恋と向き合っている証です」という前向きな傾向として表示されます。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '嫉妬深さは、相手の言動にどれだけ感情が揺れ動きやすいかを表すStyle指標。',
    '計算式は「情動性×0.6−誠実性×0.4」。独占欲（情動性−自立性）とは負に働くプリミティブが異なり、別の概念として設計されている。',
    '9216件の実測では、ENFP（72.2%）が最も高く、ISTJ（0%）が全16タイプ中唯一のHigh0%。',
    '血液型ではO型・AB型（45.2%）が高く、A型（1.7%）が最も低い。',
    'Bundle主軸が誠実性のケースではHigh率が0%ちょうどで、他のStyleより誠実性の抑制効果が最も強く出る。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
