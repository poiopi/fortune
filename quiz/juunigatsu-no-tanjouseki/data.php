<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'juunigatsu-no-tanjouseki',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [12],
  'number'       => 40,
  'published_at' => '2026-11-13',

  'question' => '12月の誕生石として、日本でよく知られている石は？',
  'lead'     => '誕生石は、生まれた月ごとに決められた宝石です。では、1年の最後の月、12月の誕生石はどれでしょうか。',

  'choices' => [
    'a1' => 'ガーネット',
    'a2' => 'アメジスト',
    'a3' => 'トパーズ',
    'a4' => 'トルコ石',
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

  'correct_choice'   => 'a4',
  'explanation_body' => '12月の誕生石として日本で広く知られているのは、トルコ石（ターコイズ）です。空を思わせる鮮やかな青緑色が特徴で、世界で最も古くから使われてきた宝石の一つとされています。名前に「トルコ」とありますが、産地がトルコなのではなく、かつて交易路を通じてトルコ経由でヨーロッパに伝わったことが由来とされています。石言葉は「成功、繁栄」。古代から魔除けや旅のお守りとして身につけられてきました。ほかの選択肢は、ガーネットが1月、アメジストが2月、トパーズが11月の誕生石です。',
  'explanation_intro' => [
    'a1' => '残念、正解は『トルコ石』でした。',
    'a2' => '残念、正解は『トルコ石』でした。',
    'a3' => '残念、正解は『トルコ石』でした。',
    'a4' => '正解です！',
  ],
  'explanation_indexable' => false,

  'title'       => '12月の誕生石は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '12月の誕生石にまつわる4択クイズ。答えを選んだあと、正解と石言葉・名前の由来をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/birthstone/december/',
  'cta_label' => 'トルコ石の石言葉と魅力をくわしく読む',

  'sns' => [
    'threads' => "12月の誕生石として、日本でよく知られている石は？\n\n○ ガーネット\n○ アメジスト\n○ トパーズ\n○ トルコ石\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/juunigatsu-no-tanjouseki/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
