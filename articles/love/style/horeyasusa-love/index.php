<?php
$item = [
  'slug' => 'horeyasusa-love',
  'name' => '惚れやすさ',

  'lead' => '「惚れやすさ」は、Love Engineが算出する7つの恋愛スタイル（Style）指標のひとつです。情動性に加えて変化志向というプリミティブを組み合わせる、MBTI記事シリーズでも度々登場した指標です。9216パターンの実測データとともに解説します。',

  'overview' => '惚れやすさは、新しい出会いや刺激に対して心が動きやすいかという傾向を表す指標です。',
  'measures_body' => '情動性（0.6）と変化志向（0.4）の加重和です。変化志向はMBTIのP（知覚）から主に伸びるプリミティブで、P型は総じて惚れやすさが高くなりやすい構造です。',

  'formula_intro' => '惚れやすさは、情動性と変化志向の加重和です。',
  'formula_expr' => '惚れやすさ = 情動性 × 0.6 + 変化志向 × 0.4',
  'formula_explanation' => '変化志向はE/IやT/Fの違いには影響されず、もっぱらJ/P（P型か否か）で決まります。そのためMBTI16タイプの中でも、Pを持つタイプ同士（例：ENTP・INTP）は惚れやすさが完全に一致することがあります。実際、ENTPとINTPはどちらもHigh42.9%で同じ値です。',
  'normalizer_body' => '算出されたスコアは、9216通りの実測分布から求めた百分位（P33・P67）によってHigh/Mid/Lowへ分類されます。',
  'normalizer' => ['p33' => 3.20, 'p67' => 4.20],

  'levels_intro' => '実際の診断結果では、High/Mid/Lowそれぞれ次のように表示されます。',
  'levels' => [
    'High' => '出会いの中で心が動きやすく、恋の始まりを敏感にキャッチするタイプ。そのときめきの多さが毎日を彩ります。',
    'Mid'  => '直感と見極めの両方を働かせ、ピンときた相手とは自然に距離が縮まるタイプ。恋の入り口で無理をしません。',
    'Low'  => '恋に落ちるまで時間をかけ、相手の内面を知ってから心を開くタイプ。一度芽生えた想いは、長く静かに続いていきます。',
  ],

  'data_intro' => 'ここからは、Love Engineの9216通り全パターンを対象に、惚れやすさが実際にどう分布しているかを見ていきます。',
  'overall' => ['high' => 32.2, 'mid' => 25.1, 'low' => 42.7],

  'mbti_body' => 'MBTI別ではINFP・ENFP（88.2%）が最も高く、ISTJ・ESTJ（0%）が最も低くなっています。F（感情）とP（知覚）を両方持つタイプが上位に、J（判断）を持つタイプ（変化志向への寄与が無い）が下位に集まります。',
  'mbtiRanking' => [
    ['type'=>'INFP', 'pct'=>88.2, 'url'=>'/articles/love/mbti/infp/'],
    ['type'=>'ENFP', 'pct'=>88.2, 'url'=>'/articles/love/mbti/enfp/'],
    ['type'=>'INFJ', 'pct'=>56.3, 'url'=>'/articles/love/mbti/infj/'],
    ['type'=>'ENFJ', 'pct'=>56.3, 'url'=>'/articles/love/mbti/enfj/'],
    ['type'=>'INTP', 'pct'=>42.9, 'url'=>'/articles/love/mbti/intp/'],
    ['type'=>'ENTP', 'pct'=>42.9, 'url'=>'/articles/love/mbti/entp/'],
    ['type'=>'ISFP', 'pct'=>42.9, 'url'=>'/articles/love/mbti/isfp/'],
    ['type'=>'ESFP', 'pct'=>42.9, 'url'=>'/articles/love/mbti/esfp/'],
    ['type'=>'INTJ', 'pct'=>10.8, 'url'=>'/articles/love/mbti/intj/'],
    ['type'=>'ENTJ', 'pct'=>10.8, 'url'=>'/articles/love/mbti/entj/'],
    ['type'=>'ISFJ', 'pct'=>10.8, 'url'=>'/articles/love/mbti/isfj/'],
    ['type'=>'ESFJ', 'pct'=>10.8, 'url'=>'/articles/love/mbti/esfj/'],
    ['type'=>'ISTP', 'pct'=>5.6,  'url'=>'/articles/love/mbti/istp/'],
    ['type'=>'ESTP', 'pct'=>5.6,  'url'=>'/articles/love/mbti/estp/'],
    ['type'=>'ISTJ', 'pct'=>0.0,  'url'=>'/articles/love/mbti/istj/'],
    ['type'=>'ESTJ', 'pct'=>0.0,  'url'=>'/articles/love/mbti/estj/'],
  ],

  'blood_body' => '血液型ではO型・AB型（42.6%）が高く、A型（12.3%）が最も低くなっています。B型（31.1%）はCHANGEが変化志向に直接寄与するため、A型より高めです。',
  'bloodBreakdown' => [
    ['type'=>'A型', 'pct'=>12.3],
    ['type'=>'B型', 'pct'=>31.1],
    ['type'=>'O型', 'pct'=>42.6],
    ['type'=>'AB型', 'pct'=>42.6],
  ],

  'bundle_body' => 'Bundleの主軸が情動性のケースでは惚れやすさのHigh率が85.5%に達します。注目すべきは、少数派である自立性主軸（n=32）でも21.9%、変化志向が主軸のケースでは50.4%と、他の指標では0%近くになりがちな自立性・変化志向主軸でも一定のHigh率が出る点です。これは惚れやすさの計算式に変化志向という正の項が含まれているためです。',
  'bundleCorrelation' => [
    ['primitive'=>'行動主導性が主軸', 'pct'=>11.1],
    ['primitive'=>'情動性が主軸',     'pct'=>85.5],
    ['primitive'=>'誠実性が主軸',     'pct'=>8.2],
    ['primitive'=>'変化志向が主軸',   'pct'=>50.4],
    ['primitive'=>'自立性が主軸',     'pct'=>21.9],
  ],

  'related_intro' => '惚れやすさのHigh率が特に高い・低いMBTIタイプの恋愛傾向記事です。',
  'relatedMbti' => [
    ['label'=>'INFP（High88.2%）', 'url'=>'/articles/love/mbti/infp/', 'highlight'=>true],
    ['label'=>'ENFP（High88.2%）', 'url'=>'/articles/love/mbti/enfp/', 'highlight'=>true],
    ['label'=>'ISTJ（High0%）',    'url'=>'/articles/love/mbti/istj/', 'highlight'=>false],
    ['label'=>'ESTJ（High0%）',    'url'=>'/articles/love/mbti/estj/', 'highlight'=>false],
  ],

  'faq' => [
    ['q'=>'惚れやすさが高いのは軽い性格ということですか？',
     'a'=>'そうではありません。Highは「そのときめきの多さが毎日を彩ります」という前向きな傾向として表示されます。新しい出会いへの心の開き方の違いであり、真剣さの度合いを示すものではありません。'],
    ['q'=>'なぜJ型は惚れやすさが低くなりやすいのですか？',
     'a'=>'惚れやすさの計算式に含まれる変化志向というプリミティブは、MBTIのP（知覚）からのみ伸び、J（判断）からは伸びません。そのためJ型はP型に比べて惚れやすさが構造的に低くなりやすい傾向があります。'],
    ['q'=>'血液型や星座でも結果は変わりますか？',
     'a'=>'変わります。ここで紹介したMBTI別・血液型別の数値は、それぞれ単独で576パターン・2304パターンを集計したものです。実際の診断では、MBTI・血液型・星座の3要素が合算されます。'],
  ],

  'matome' => [
    '惚れやすさは、新しい出会いや刺激に心が動きやすいかを表すStyle指標。',
    '計算式は「情動性×0.6＋変化志向×0.4」。変化志向はMBTIのP（知覚）から主に伸びるため、P型はJ型より惚れやすさが高くなりやすい。',
    '9216件の実測では、INFP・ENFP（88.2%）が最も高く、ISTJ・ESTJ（0%）が最も低い。',
    '血液型ではO型・AB型（42.6%）が高く、A型（12.3%）が最も低い。',
    '変化志向を含む唯一のStyleのため、自立性・変化志向が主軸のケースでもHigh率が0にならない、他のStyleにはない分布パターンを持つ。',
  ],
];
require __DIR__ . '/../_style-tpl.php';
