<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'jikkan-mizunoto-no-ji',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 48,
  'published_at' => '2026-11-13',

  'question' => '十干のうち「みずのと」と読む字は？',
  'lead'     => '甲（きのえ）・乙（きのと）から始まる十干。四柱推命や暦で使われる10の字です。そのうち、最後の10番目にあたる「みずのと」は、どの字でしょうか。',

  'choices' => [
    'a1' => '壬',
    'a2' => '癸',
    'a3' => '己',
    'a4' => '辛',
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

  'correct_choice'   => 'a2',
  'explanation_body' => '「みずのと」と読むのは、癸です。十干の10番目で、五行では「水」、陰陽では「陰」に分類されます。自然物にたとえると雨や露で、静かに染み込み、物事を潤す性質を表すとされています。読みの「みずのと」は「水の弟（と）」から来ていて、すぐ前の壬（みずのえ）が「水の兄（え）」。十干は、このように五行それぞれを「兄（陽）」と「弟（陰）」に分けた10の字です。ほかの選択肢は、己が「つちのと」、辛が「かのと」と読みます。四柱推命では、生まれた日の十干（日干）を、その人らしさの中心として読みます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『癸』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『癸』でした。',
    'a4' => '残念、正解は『癸』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '十干で「みずのと」と読む字は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '十干の読み方にまつわる4択クイズ。答えを選んだあと、正解と癸（みずのと）の意味をわかりやすく解説します。',

  'cta_url'   => '/articles/shichu/mizunoto/',
  'cta_label' => '癸（みずのと）の性格・恋愛運・相性をくわしく読む',

  'sns' => [
    'threads' => "十干のうち「みずのと」と読む字は？\n\n○ 壬\n○ 癸\n○ 己\n○ 辛\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/jikkan-mizunoto-no-ji/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
