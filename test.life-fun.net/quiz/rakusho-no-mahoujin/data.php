<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'rakusho-no-mahoujin',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 14,
  'published_at' => '2026-10-28',

  'question' => '九星気学のルーツとされる「洛書」。縦・横・斜め、どの列を足しても同じになる数は？',
  'lead'     => '古代中国の「洛書（らくしょ）」は、1から9の数字を3×3に並べた図です。縦・横・斜め、どの列を足しても同じ数になります。',

  'choices' => [
    'a1' => '9',
    'a2' => '12',
    'a3' => '15',
    'a4' => '18',
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

  'correct_choice'   => 'a3',
  'explanation_body' => '正解は「15」です。1から9までを全部足すと45。それを3つの列に等しく分けるので、1列は15になります。洛書は、中央に5、上に9、下に1が来る並びで、このように縦・横・斜めの和がそろう図を「魔方陣」と呼びます。九星気学は、この9つの数字に五行や陰陽の考え方を組み合わせたのが始まりとされ、9つの星（一白水星から九紫火星）につながっています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『15』でした。',
    'a2' => '残念、正解は『15』でした。',
    'a3' => '正解です！',
    'a4' => '残念、正解は『15』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '九星気学のルーツ「洛書」の魔方陣｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '九星気学のルーツ「洛書」の魔方陣にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/kyusei/',
  'cta_label' => '九星気学の成り立ちと9つの星をくわしく読む',

  'sns' => [
    'threads' => "九星気学のルーツとされる「洛書」。縦・横・斜め、どの列を足しても同じになる数は？\n\n○ 9\n○ 12\n○ 15\n○ 18\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/rakusho-no-mahoujin/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
