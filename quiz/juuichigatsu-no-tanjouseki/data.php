<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'juuichigatsu-no-tanjouseki',
  'series'       => 'B',
  'number'       => 21,
  'published_at' => '2026-10-28',

  'question' => '11月の誕生石として知られる宝石はどれ？',
  'lead'     => '生まれた月ごとに決まっている誕生石。11月生まれの人の誕生石は、どの宝石でしょう。',

  'choices' => [
    'a1' => 'トパーズ',
    'a2' => 'ルビー',
    'a3' => 'ガーネット',
    'a4' => 'アクアマリン',
  ],

  'results' => [
    'a1' => null,
    'a2' => null,
    'a3' => null,
    'a4' => null,
  ],

  'explanations' => [
    'a1' => null,
    'a2' => null,
    'a3' => null,
    'a4' => null,
  ],

  'correct_choice'   => 'a1',
  'explanation_body' => '正解は「トパーズ」です。トパーズは黄色や橙色を中心に、さまざまな色合いを持つ宝石で、石言葉は「友情、希望」です。太陽のような明るい色合いから、大切な人との絆を深めるお守りとして親しまれてきました。ほかの選択肢は、ルビーが7月、ガーネットが1月、アクアマリンが3月の誕生石です。',
  'explanation_intro' => [
    'a1' => '正解です！',
    'a2' => '残念、正解は『トパーズ』でした。',
    'a3' => '残念、正解は『トパーズ』でした。',
    'a4' => '残念、正解は『トパーズ』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '11月の誕生石は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '11月の誕生石は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/birthstone/november/',
  'cta_label' => 'トパーズの石言葉と魅力をくわしく読む',

  'sns' => [
    'threads' => "11月の誕生石として知られる宝石はどれ？\n\n○ トパーズ\n○ ルビー\n○ ガーネット\n○ アクアマリン\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/juuichigatsu-no-tanjouseki/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
