<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'senbu-kichi-no-jikantai',
  'series'       => 'B',
  'themes'       => ['kinun'],
  'season'       => [],
  'number'       => 44,
  'published_at' => '2026-11-13',

  'question' => '六曜の「先負（せんぶ）」の日。吉とされる時間帯は？',
  'lead'     => 'カレンダーでよく見かける六曜の「先負」。「先んずれば即ち負ける」という意味をもつ日です。では、この日のうちで吉とされるのは、どの時間帯でしょうか。',

  'choices' => [
    'a1' => '朝と夕方',
    'a2' => '午前中',
    'a3' => '正午ごろ',
    'a4' => '午後',
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
  'explanation_body' => '先負の日に吉とされるのは、午後（13時以降）です。午前中は凶とされ、「午前は静かに、午後から動く」のが先負の日の過ごし方の基本とされています。読み方は「せんぶ」のほか「さきまけ」とも読みます。名前のとおり「先に動くと負ける」と解釈されるため、大事な決断や新しいことの始まりは午後に回すのがよい、と言われます。ちょうど逆なのが「先勝（せんしょう）」で、こちらは午前が吉、午後が凶。なお、「正午ごろだけ吉」とされているのは「赤口（しゃっこう）」、「朝と夕方が吉」とされるのは「友引」です。六曜の巡りでは、先負は友引の後、仏滅の前に来ます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『午後』でした。',
    'a2' => '残念、正解は『午後』でした。',
    'a3' => '残念、正解は『午後』でした。',
    'a4' => '正解です！',
  ],
  'explanation_indexable' => false,

  'title'       => '「先負」の日、吉の時間帯は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '六曜「先負」の吉の時間帯を当てる4択クイズ。答えを選んだあと、正解と先負の意味・過ごし方をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/rokuyo/senbu/',
  'cta_label' => '先負の意味と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "六曜の「先負（せんぶ）」の日。吉とされる時間帯は？\n\n○ 朝と夕方\n○ 午前中\n○ 正午ごろ\n○ 午後\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/senbu-kichi-no-jikantai/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
