<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'kyureki-ganjitsu-no-rokuyo',
  'series'       => 'B',
  'number'       => 12,
  'published_at' => '2026-10-28',

  'question' => '旧暦の1月1日は、毎年必ず同じ六曜になります。それはどれ？',
  'lead'     => 'カレンダーに小さく書かれている「大安」「仏滅」などの六曜。実は、旧暦の1月1日は毎年決まった六曜から始まります。',

  'choices' => [
    'a1' => '大安',
    'a2' => '先勝',
    'a3' => '仏滅',
    'a4' => '友引',
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
  'explanation_body' => '正解は「先勝」です。六曜は「先勝→友引→先負→仏滅→大安→赤口」の順に1日ずつ進みますが、旧暦の各月の1日になると、決まった六曜から数え直します。旧暦の1月1日と7月1日は、必ず先勝から始まります。いまのカレンダーで六曜の順番がときどき飛んで見えるのは、この数え直しがあるためです。',
  'explanation_intro' => [
    'a1' => '残念、正解は『先勝』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『先勝』でした。',
    'a4' => '残念、正解は『先勝』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '旧暦の元日の六曜は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '旧暦の元日の六曜は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/rokuyo/',
  'cta_label' => '六曜の順番と決まり方をくわしく読む',

  'sns' => [
    'threads' => "旧暦の1月1日は、毎年必ず同じ六曜になります。それはどれ？\n\n○ 大安\n○ 先勝\n○ 仏滅\n○ 友引\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/kyureki-ganjitsu-no-rokuyo/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
