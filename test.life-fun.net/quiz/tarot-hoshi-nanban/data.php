<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-hoshi-nanban',
  'series'       => 'B',
  'number'       => 15,
  'published_at' => '2026-10-28',

  'question' => '嵐のあとの希望を表すとされる、タロットの「星」。大アルカナの何番？',
  'lead'     => '夜空に大きな星と小さな星が輝くカード「星」。希望や回復を表すとされるこのカードは、大アルカナの何番でしょう。',

  'choices' => [
    'a1' => '7番',
    'a2' => '13番',
    'a3' => '17番',
    'a4' => '21番',
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
  'explanation_body' => '正解は「17番」です。星は、雷に打たれて塔が崩れる16番「塔」のすぐあとに来るカードで、嵐が過ぎたあとの静かな夜空を表すとされています。絵には、星の光の下で、大地と水に杯の水を注ぐ女性が描かれています。正位置は「癒しと回復の時期」、逆位置は「希望を見失っている」状態を表すとされます。苦しい時期のあとにこのカードが出たら、少しずつ良くなっていくサインと読むことができます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『17番』でした。',
    'a2' => '残念、正解は『17番』でした。',
    'a3' => '正解です！',
    'a4' => '残念、正解は『17番』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「星」は何番のカード？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロット「星」は何番のカード？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/star/',
  'cta_label' => '星のカードの正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "嵐のあとの希望を表すとされる、タロットの「星」。大アルカナの何番？\n\n○ 7番\n○ 13番\n○ 17番\n○ 21番\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-hoshi-nanban/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
