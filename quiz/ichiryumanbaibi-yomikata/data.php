<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'ichiryumanbaibi-yomikata',
  'series'       => 'B',
  'themes'       => ['kinun'],
  'season'       => [],
  'number'       => 18,
  'published_at' => '2026-10-28',

  'question' => '何かを始めるのに良い日とされる「一粒万倍日」。なんと読む？',
  'lead'     => 'カレンダーや手帳で見かけることが増えた「一粒万倍日」。財布を新しくする日としても人気ですが、読み方は知っていますか？',

  'choices' => [
    'a1' => 'いちつぶまんばいび',
    'a2' => 'いちりゅうまんばいび',
    'a3' => 'ひとつぶまんばいにち',
    'a4' => 'いちりゅうばんばいにち',
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
  'explanation_body' => '正解は「いちりゅうまんばいび」です。「一粒の籾（もみ）が万倍にも実って稲穂になる」という意味の吉日で、この日に始めたことは大きく育つと言われています。月に4〜6日ほどあり、新しい事業や貯金を始める日、財布を新しくする日に選ばれます。一方で、増えてほしくないこと、たとえば借金や人から物を借りることは避けたほうがいい、とも言われています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『いちりゅうまんばいび』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『いちりゅうまんばいび』でした。',
    'a4' => '残念、正解は『いちりゅうまんばいび』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '「一粒万倍日」の読み方は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '「一粒万倍日」の読み方は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/kichijitsu/ichiryumanbai/',
  'cta_label' => '一粒万倍日の意味と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "何かを始めるのに良い日とされる「一粒万倍日」。なんと読む？\n\n○ いちつぶまんばいび\n○ いちりゅうまんばいび\n○ ひとつぶまんばいにち\n○ いちりゅうばんばいにち\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/ichiryumanbaibi-yomikata/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
