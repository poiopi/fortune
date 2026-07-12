<?php
$item = [
  'slug' => 'isfp-a',
  'name' => 'ISFP×A型',
  'title' => 'ISFP×A型の恋愛傾向｜Love Engineで解説する誠実性主軸の理由',
  'h1' => 'ISFP×A型の恋愛傾向｜Love Engineで解説する誠実性主軸の理由',
  'description' => 'ISFP×A型の組み合わせでは、MBTI単体の主軸（誠実性）と血液型単体の主軸（誠実性）のうち、どちらの影響が恋愛傾向により強く出るのかをLove Engineの実測データ（144パターン）で解説。',
  'lead' => 'ISFPは誠実性が、A型は誠実性が、それぞれ単体では恋愛傾向の主軸になりやすいタイプです。この2つを組み合わせたとき、どちらの影響がより強く出るのかを、Love Engineの実測データから解説します。',
  'classification' => '協調型',
  'classification_desc' => 'ISFP単体の主軸もA型単体の主軸も誠実性です。2つの入力が同じ方向を向いているため「協調型」に分類されます。',
  'conclusion' => 'この組み合わせは「協調型」です。ISFPとA型はどちらも単体で誠実性が主軸になりやすく（MBTI単体68.1%、A型単体95.5%）、2つの入力が同じ方向を後押しするため、組み合わせるとさらに強く誠実性へ集中します（100%）。',
  'causal_intro' => 'ISFPとA型は、単体で見てもどちらも誠実性が主軸になりやすいタイプです。組み合わせでどれだけ強まるかを実測データで確認します。',
  'causalRows' => [
    [
      'source' => 'ISFP（MBTI）単体',
      'solo' => '誠実性 68.1%（576パターン中）',
      'result' => '組み合わせでも同じ方向（一致）',
      'adopted' => true,
    ],
    [
      'source' => 'A型（血液型）単体',
      'solo' => '誠実性 95.5%（2304パターン中）',
      'result' => '組み合わせでも同じ方向（一致）',
      'adopted' => true,
    ],
  ],
  'causal_explanation' => 'ISFPではI（慎重さ）・S（安定性）が誠実性へ、A型では「几帳面」（慎重さ）・「真面目」（責任感）・「調和」（安定性）が同じく誠実性へ寄与します。2つの入力が同じ方向を後押しするため、単体（MBTI68.1%・A型95.5%）よりも高い集中度（100%）になります。',
  'data_intro' => 'ここからは、ISFP×A型に該当する144パターンを対象に、Style（恋愛スタイル）7項目とTendency（推定傾向）2項目の分布を見ていきます。',
  'styles' => [
    '積極性' => [
      'high' => 0,
      'mid' => 1.4,
      'low' => 98.6,
    ],
    '愛情表現' => [
      'high' => 0,
      'mid' => 18.1,
      'low' => 81.9,
    ],
    '包容力' => [
      'high' => 100,
      'mid' => 0,
      'low' => 0,
    ],
    '独占欲' => [
      'high' => 8.3,
      'mid' => 41.7,
      'low' => 50,
    ],
    '惚れやすさ' => [
      'high' => 9.7,
      'mid' => 28.5,
      'low' => 61.8,
    ],
    '嫉妬深さ' => [
      'high' => 0,
      'mid' => 5.6,
      'low' => 94.4,
    ],
    '恋愛の慎重さ' => [
      'high' => 100,
      'mid' => 0,
      'low' => 0,
    ],
  ],
  'tendencies' => [
    '結婚志向' => [
      'high' => 100,
      'mid' => 0,
      'low' => 0,
    ],
    '浮気耐性' => [
      'high' => 100,
      'mid' => 0,
      'low' => 0,
    ],
  ],
  'bundle_intro' => 'ISFP×A型の144パターンを、実際に採用されるBundle（主軸×副軸の組み合わせ）別に見ると、次のようになります。',
  'bundleBreakdown' => [
    [
      'label' => '誠実性×情動性',
      'count' => 102,
      'pct' => 70.8,
    ],
    [
      'label' => '誠実性×変化志向',
      'count' => 34,
      'pct' => 23.6,
    ],
    [
      'label' => '誠実性×自立性',
      'count' => 5,
      'pct' => 3.5,
    ],
    [
      'label' => '誠実性×行動主導性',
      'count' => 3,
      'pct' => 2.1,
    ],
  ],
  'rarityLevel' => '集中しやすい',
  'rarityRank' => '9位（主軸集中度100%、上位87.5%相当）',
  'rarity_note' => 'ISFP×A型の集中度（100%）を64通りの実測分布に照らすと「集中しやすい」に位置します。集中度の高低と、分類（協調型/拮抗型/転換型）の珍しさは別の軸であり、この組み合わせは64通り中9位（上位87.5%相当）です。',
  'conceptLinks' => [
    [
      'name' => '誠実性型',
      'desc' => 'ISFP×A型の100%が該当するBundle。',
      'url' => '/articles/love/bundle/reliability-type/',
    ],
    [
      'name' => '情動性型',
      'desc' => 'ISFP×A型の副軸として70.8%残るBundle。',
      'url' => '/articles/love/bundle/sensitivity-type/',
    ],
    [
      'name' => '恋愛の慎重さ',
      'desc' => '誠実性×0.6＋自立性×0.4。主軸Primitiveが反映される指標。',
      'url' => '/articles/love/style/shinchousa-love/',
    ],
    [
      'name' => '愛情表現',
      'desc' => '行動主導性×0.3＋情動性×0.7。副軸Primitiveが反映される指標。',
      'url' => '/articles/love/style/aijouhyougen-love/',
    ],
  ],
  'faq' => [
    [
      'q' => 'ISFP×A型は珍しい組み合わせですか？',
      'a' => '組み合わせ自体（144パターン）は64通り中どれも同じ件数です。主軸の集中度（100%）は64通り中9位で「集中しやすい」に位置します。',
    ],
    [
      'q' => 'なぜMBTIと血液型の両方が同じ方向になるのですか？',
      'a' => 'ISFPとA型が、たまたま同じPrimitive（誠実性）に強く寄与する構造を持っているためです。全てのMBTI×血液型の組み合わせがこうなるわけではなく、64通り中24通りがこの「協調型」に該当します。',
    ],
    [
      'q' => 'なぜ誠実性が主軸になりやすいのですか？',
      'a' => 'Love Engineでは、MBTI・血液型それぞれの入力がPrimitiveへスコアを加算し、最終的にスコアが最も高いPrimitiveが主軸として採用されます。この組み合わせでは誠実性への寄与が最も大きくなるため、主軸として採用されます。詳しくは「Bundleとは」で解説しています。',
    ],
  ],
  'matome' => [
    'ISFP×A型は、MBTI単体の主軸（誠実性）・血液型単体の主軸（誠実性）の関係から「協調型」に分類される組み合わせ。',
    '組み合わせた144パターンでは、誠実性が主軸として採用される割合が100%。',
    '情動性は、誠実性が主軸のケースの70.8%で副軸として残る。',
    '主軸集中度100%は64通り中9位で「集中しやすい」に位置する。',
    'この組み合わせの傾向は、MBTI・血液型それぞれのTrait寄与という構造的な理由に基づいている。',
  ],
  'relatedItems' => [
    [
      'label' => '恋愛傾向診断',
      'title' => 'MBTI×血液型×星座で診断する →',
      'url' => '/love',
    ],
    [
      'label' => 'ISFP×恋愛',
      'title' => 'ISFPの恋愛傾向を詳しく見る →',
      'url' => '/articles/love/mbti/isfp/',
    ],
    [
      'label' => 'A型×恋愛',
      'title' => 'A型の恋愛傾向を詳しく見る →',
      'url' => '/articles/love/blood/a-love/',
    ],
    [
      'label' => 'MBTI×血液型 一覧',
      'title' => '他の組み合わせを見る →',
      'url' => '/articles/love/mbti-blood/',
    ],
  ],
  'prev' => [
    'title' => 'ESFP×AB型',
    'url' => '/articles/love/mbti-blood/esfp-ab/',
  ],
  'next' => [
    'title' => 'ISFP×B型',
    'url' => '/articles/love/mbti-blood/isfp-b/',
  ],
];
require __DIR__ . '/../_combo-tpl.php';
