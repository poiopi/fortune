<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-unmei-no-wa-nanban',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 17,
  'published_at' => '2026-10-28',

  'question' => '回り続ける輪が描かれた、タロットの「運命の輪」。大アルカナの何番？',
  'lead'     => '大きな輪の周りに、スフィンクスや蛇が描かれたカード「運命の輪」。転機を表すとされるこのカードは、何番でしょう。',

  'choices' => [
    'a1' => '1番',
    'a2' => '10番',
    'a3' => '13番',
    'a4' => '20番',
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
  'explanation_body' => '正解は「10番」です。運命の輪は、止まらずに回り続ける輪で「巡り」を表すカードです。輪の周りにはスフィンクスやアヌビス、蛇が描かれ、四隅には四大元素の象徴が置かれています。上がることと下がることは表裏一体で、今の状況がずっと続くわけではない、という意味が込められているとされます。正位置は運気の転換点やチャンス、逆位置は同じパターンをくり返している状態を表すとされます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『10番』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『10番』でした。',
    'a4' => '残念、正解は『10番』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「運命の輪」は何番？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロット「運命の輪」は何番？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/wheel/',
  'cta_label' => '運命の輪の正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "回り続ける輪が描かれた、タロットの「運命の輪」。大アルカナの何番？\n\n○ 1番\n○ 10番\n○ 13番\n○ 20番\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-unmei-no-wa-nanban/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
