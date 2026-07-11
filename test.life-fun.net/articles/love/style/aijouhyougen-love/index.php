<?php
$item = [
  'slug' => 'aijouhyougen-love',
  'name' => '愛情表現',

  'lead' => '「愛情表現」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。積極性と同じ2つのプリミティブ（行動主導性・情動性）を使いながら、重みを逆転させることで全く異なる意味を持つ指標になっています。9216パターンの実測データとともに解説します。',

  'overview' => '愛情表現は、好意をどれだけストレートに言葉や態度で示すかという傾向を表す指標です。',
  'measures_body' => '積極性が「行動の起点がどちらにあるか」を測るのに対し、愛情表現は「感情をどれだけ表に出すか」を測ります。同じ2つのプリミティブ（行動主導性・情動性）から計算されますが、重みが逆（積極性は行動主導性0.6・情動性0.4、愛情表現は行動主導性0.3・情動性0.7）のため、似て非なる指標です。',

  'formula_intro' => '愛情表現は、積極性と同じく行動主導性と情動性の加重和ですが、情動性の重みが主になっています。',
  'formula_expr' => '愛情表現 = 情動性 × 0.7 + 行動主導性 × 0.3',
  'formula_explanation' => '積極性（行動主導性0.6・情動性0.4）とは重みが逆転しています。そのため、行動主導性が高くても情動性が低いタイプは積極性ほど愛情表現は高くならず、逆に情動性が高いタイプは積極性以上に愛情表現が高くなります。実測でもこの違いがはっきり表れています（Bundle主軸が情動性のケースで愛情表現High率79.6% vs 積極性53.3%、行動主導性が主軸のケースで愛情表現34.5% vs 積極性71.1%）。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 3.40, 'p67' => 4.80],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます。',
  'levels' => [
    'High' => '好きという気持ちを言葉や態度で惜しみなく伝えるタイプ。そのストレートな表現が、相手の心をあたたかく照らします。',
    'Mid'  => '言葉とさりげない気配りを織り交ぜて想いを届けるタイプ。ふとした一言や仕草に、愛情が自然とにじみます。',
    'Low'  => '想いを言葉より日々の行動でそっと示すタイプ。積み重ねた誠実な振る舞いが、静かに深い信頼を築きます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、愛情表現が実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 31.6, 'mid' => 32.3, 'low' => 36.1],

  'mbti_body' => 'MBTI別ではENFJ・ENFP（66.7%）が最も高く、ISTJ・ISTP（5.2%）が最も低くなっています。F（感情）を持つタイプ全般が情動性への寄与を持つため、Highになりやすい傾向があります。',
  'mbtiRanking' => [
    ['type'=>'ENFJ', 'pct'=>66.7, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'ENFP', 'pct'=>66.7, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'INFJ', 'pct'=>46.9, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'INFP', 'pct'=>46.9, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENTJ', 'pct'=>44.1, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ENTP', 'pct'=>44.1, 'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'INTJ', 'pct'=>31.6, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'INTP', 'pct'=>31.6, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ESFJ', 'pct'=>31.6, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ESFP', 'pct'=>31.6, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'ISFJ', 'pct'=>13.5, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ESTJ', 'pct'=>13.5, 'url'=>'/articles/love/mbti/estj/'],
    ['type'=>'ISFP', 'pct'=>13.5, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESTP', 'pct'=>13.5, 'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISTJ', 'pct'=>5.2,  'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ISTP', 'pct'=>5.2,  'url'=>'/articles/love/mbti/istp/'],
  ],

  'blood_body' => '血液型ではO型（58.2%）・AB型（51%）が高く、A型・B型はどちらも8.7%です。積極性と同様、A型・B型は情動性・行動主導性のどちらにも直接寄与しないため低くなります。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>8.7],
    ['type'=>'B型', 'pct'=>8.7],
    ['type'=>'O型', 'pct'=>58.2],
    ['type'=>'AB型', 'pct'=>51.0],
  ],

  'bundle_body' => 'Bundleの主軸が情動性のケースでは愛情表現のHigh率が79.6%に達し、積極性（53.3%）より高くなります。逆に行動主導性が主軸のケースでは34.5%にとどまり、積極性（71.1%）より低くなります。これは愛情表現が情動性寄りの重み付けであることの直接的な裏付けです。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>34.5],
    ['primitive'=>'情動性が主軸',     'pct'=>79.6],
    ['primitive'=>'誠実性が主軸',     'pct'=>7.6],
    ['primitive'=>'変化志向が主軸',   'pct'=>0.0],
    ['primitive'=>'自立性が主軸',     'pct'=>0.0],
  ],

  'related_intro' => '愛情表現のHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'ENFJ（High66.7%）', 'url'=>'/articles/love/mbti/enfj/', 'highlight'=>true],
    ['label'=>'ENFP（High66.7%）', 'url'=>'/articles/love/mbti/enfp/', 'highlight'=>true],
    ['label'=>'ISTJ（High5.2%）',  'url'=>'/articles/love/mbti/istj/', 'highlight'=>false],
    ['label'=>'ISTP（High5.2%）',  'url'=>'/articles/love/mbti/istp/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'愛情表現と積極性は何が違いますか？',
     'a'=>'どちらも行動主導性と情動性から計算されますが、重みが逆です。積極性は行動主導性が主（0.6）で「自分から動くか」を、愛情表現は情動性が主（0.7）で「感情をどれだけ表に出すか」を測ります。そのため、行動力はあっても感情表現は控えめ、というタイプ（逆もまた然り）が生まれます。'],
    ['q'=>'愛情表現が低いと気持ちが薄いのですか？',
     'a'=>'そうではありません。Low判定でも「想いを言葉より日々の行動でそっと示すタイプ」という前向きな傾向として表示されます。表現方法の違いであり、気持ちの強さを表すものではありません。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '愛情表現は、好意をどれだけストレートに言葉や態度で示すかを表すStyle指標。',
    '計算式は「情動性×0.7＋行動主導性×0.3」で、積極性（行動主導性×0.6＋情動性×0.4）と同じ2つのプリミティブを使いながら重みが逆転している。',
    '9216件の実測では、ENFJ・ENFP（66.7%）が最も高く、ISTJ・ISTP（5.2%）が最も低い。',
    '血液型ではO型（58.2%）が高く、A型・B型（8.7%）は低い。',
    'Bundle主軸が情動性のケースでHigh率79.6%に達し、積極性より情動性への依存が強いことを裏付けている。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
