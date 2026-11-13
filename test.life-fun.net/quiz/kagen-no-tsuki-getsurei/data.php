<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'kagen-no-tsuki-getsurei',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'listed'       => true,
  'number'       => 47,
  'published_at' => '2026-11-13',

  'question' => '「下弦の月」。月齢はおよそ何日ごろ？',
  'lead'     => '満月を過ぎた月は、少しずつ欠けていきます。その途中で、ちょうど半分が輝いて見えるのが「下弦の月」です。下弦の月は、月齢でいうとおよそ何日ごろでしょうか。',

  'choices' => [
    'a1' => '約3日',
    'a2' => '約7日',
    'a3' => '約15日',
    'a4' => '約22日',
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
  'explanation_body' => '下弦の月は、月齢およそ22日前後の月です。満月（月齢およそ15日）を過ぎて新月へ向かう途中、月の左半分が輝いて見える半月です（北半球の場合）。上弦の月とちょうど対称の形で、上弦の月は月齢およそ7日前後にあたります。下弦の月は真夜中ごろに昇り、日中の空に見えることが多い月です。占いの考え方では、光が少しずつ欠けていくこの時期は「手放し」や「整理」の時期とされ、部屋の片づけや習慣の見直しなど「引き算」の行動に向くと言われます。年末の大掃除にも重ねやすい月ですね。',
  'explanation_intro' => [
    'a1' => '残念、正解は『約22日』でした。',
    'a2' => '残念、正解は『約22日』でした。',
    'a3' => '残念、正解は『約22日』でした。',
    'a4' => '正解です！',
  ],
  'explanation_indexable' => false,

  'title'       => '「下弦の月」の月齢は？'.site_title_suffix(' - '.SITE_NAME),
  'description' => '下弦の月の月齢を当てる4択クイズ。答えを選んだあと、正解と下弦の月の見え方・意味をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/moon/kagen/',
  'cta_label' => '下弦の月の意味と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "「下弦の月」。月齢はおよそ何日ごろ？\n\n○ 約3日\n○ 約7日\n○ 約15日\n○ 約22日\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/kagen-no-tsuki-getsurei/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
