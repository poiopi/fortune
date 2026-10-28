<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tenshabi-nannichi',
  'series'       => 'B',
  'number'       => 19,
  'published_at' => '2026-10-28',

  'question' => '暦の中でいちばんの吉日とされる「天赦日」。1年に何日くらいある？',
  'lead'     => '「最強の開運日」として話題になる「天赦日（てんしゃにち）」。結婚や開業の日取りに選ばれることも多い吉日です。',

  'choices' => [
    'a1' => '1〜2日',
    'a2' => '5〜6日',
    'a3' => '約30日',
    'a4' => '約60日',
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
  'explanation_body' => '正解は「5〜6日」です。天赦日は「天がすべての罪を赦す日」とされる吉日で、季節と干支の組み合わせで決まるため、1年に5〜6日ほどしかありません。春は戊寅（つちのえとら）、夏は甲午（きのえうま）、秋は戊申（つちのえさる）、冬は甲子（きのえね）の日です。一粒万倍日や大安と重なる日は、特に縁起の良い日として注目されます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『5〜6日』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『5〜6日』でした。',
    'a4' => '残念、正解は『5〜6日』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '天赦日は1年に何日くらい？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '天赦日は1年に何日くらい？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/kichijitsu/tenshabi/',
  'cta_label' => '天赦日の意味と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "暦の中でいちばんの吉日とされる「天赦日」。1年に何日くらいある？\n\n○ 1〜2日\n○ 5〜6日\n○ 約30日\n○ 約60日\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tenshabi-nannichi/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
