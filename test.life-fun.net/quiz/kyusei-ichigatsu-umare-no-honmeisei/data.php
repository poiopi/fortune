<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'kyusei-ichigatsu-umare-no-honmeisei',
  'series'       => 'B',
  'number'       => 46,
  'published_at' => '2026-11-13',

  'question' => '九星気学の本命星。1月15日生まれの人は、どの年で数える？',
  'lead'     => '九星気学では、生まれた年から「本命星」という自分の星を出します。ところが、年の初めに生まれた人は少し注意が必要です。1月15日生まれの人は、どの年で数えるのでしょうか。',

  'choices' => [
    'a1' => '生まれた年',
    'a2' => '前の年',
    'a3' => '次の年',
    'a4' => '生まれた月で決まる',
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
  'explanation_body' => '1月15日生まれの人は、前の年で数えます。九星気学の1年は1月1日ではなく、節分（立春の前日）を区切りにして切り替わるためです。そのため、1月1日〜2月3日ごろに生まれた人は、前の年の生まれとして本命星を出します。たとえば2027年1月15日生まれなら、2026年生まれとして数えることになります。本命星は、その人の本質的な性格や才能の傾向を表すとされる、九星気学でいちばん大切な星です。なお、生まれた月から出す星もあり、こちらは「月命星」と呼ばれ、本命星を補う星として読まれます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『前の年』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『前の年』でした。',
    'a4' => '残念、正解は『前の年』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '1月生まれの本命星はどの年で数える？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '九星気学の本命星の数え方にまつわる4択クイズ。答えを選んだあと、正解と年の区切りをわかりやすく解説します。',

  'cta_url'   => '/articles/kyusei/',
  'cta_label' => '九星気学の成り立ちと9つの星をくわしく読む',

  'sns' => [
    'threads' => "九星気学の本命星。1月15日生まれの人は、どの年で数える？\n\n○ 生まれた年\n○ 前の年\n○ 次の年\n○ 生まれた月で決まる\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/kyusei-ichigatsu-umare-no-honmeisei/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
