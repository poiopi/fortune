<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'gogyo-kin-no-iro',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'listed'       => true,
  'number'       => 45,
  'published_at' => '2026-11-13',

  'question' => '五行の「金（こん）」。昔から結びつけられてきた色は？',
  'lead'     => '木・火・土・金・水の五行には、それぞれ色が結びつけられています。名前に「金」とつくこの要素。その代表の色は何色でしょうか。',

  'choices' => [
    'a1' => '緑',
    'a2' => '赤',
    'a3' => '黄',
    'a4' => '白',
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
  'explanation_body' => '五行の「金（こん）」に対応する代表の色は、白です。ラッキーカラーとしては、白のほかにゴールド・シルバーも金の色とされます（黄は「土」の色です）。金は、鉱物や金属が磨かれて価値を持つ様子を表し、清潔・収穫・決断・完成を象徴します。季節では、実りの秋に対応します。五行の色は、木が緑、火が赤、土が黄、金が白、水が黒という組み合わせで知られています。五行どうしの関係では、金は水を生み（金属の表面に水滴が生じる）、木を切る（金剋木）とされています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『白』でした。',
    'a2' => '残念、正解は『白』でした。',
    'a3' => '残念、正解は『白』でした。',
    'a4' => '正解です！',
  ],
  'explanation_indexable' => false,

  'title'       => '五行「金」の色は？'.site_title_suffix(' - '.SITE_NAME),
  'description' => '陰陽五行の「金」に対応する色を当てる4択クイズ。答えを選んだあと、正解と金の意味をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/gogyo/kin/',
  'cta_label' => '五行「金」の意味とラッキーカラーをくわしく読む',

  'sns' => [
    'threads' => "五行の「金（こん）」。昔から結びつけられてきた色は？\n\n○ 緑\n○ 赤\n○ 黄\n○ 白\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/gogyo-kin-no-iro/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
