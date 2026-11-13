<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tsuchinotomi-no-hi-yomikata',
  'series'       => 'B',
  'themes'       => ['kinun', 'mame'],
  'season'       => [],
  'listed'       => true,
  'number'       => 11,
  'published_at' => '2026-10-28',

  'question' => '弁財天の縁日とされる「己巳の日」。なんと読む？',
  'lead'     => '金運の吉日として知られる「己巳の日」。漢字は見たことがあっても、読み方は意外と知られていません。',

  'choices' => [
    'a1' => 'きしのひ',
    'a2' => 'みのとのひ',
    'a3' => 'つちのとみのひ',
    'a4' => 'こしのひ',
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
  'explanation_body' => '正解は「つちのとみのひ」です。十干の「己（つちのと）」と十二支の「巳（み）」が重なる日で、60日に1度しかめぐってきません。蛇（巳）が弁財天の使いとされることから、巳の日は弁財天の縁日とされ、その中でも己巳の日は特に大切な日とされています。弁財天は金運だけでなく、芸術や音楽、学問の神様でもあるので、音楽や絵などの芸術活動を始める日に選ぶ人もいます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『つちのとみのひ』でした。',
    'a2' => '残念、正解は『つちのとみのひ』でした。',
    'a3' => '正解です！',
    'a4' => '残念、正解は『つちのとみのひ』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '「己巳の日」の読み方は？'.site_title_suffix(' - '.SITE_NAME),
  'description' => '「己巳の日」の読み方は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/kichijitsu/tsuchinotomi/',
  'cta_label' => '己巳の日の由来と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "弁財天の縁日とされる「己巳の日」。なんと読む？\n\n○ きしのひ\n○ みのとのひ\n○ つちのとみのひ\n○ こしのひ\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tsuchinotomi-no-hi-yomikata/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
