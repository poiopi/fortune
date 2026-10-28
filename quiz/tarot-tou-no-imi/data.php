<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-tou-no-imi',
  'series'       => 'B',
  'number'       => 16,
  'published_at' => '2026-10-28',

  'question' => '雷に打たれて崩れ落ちる「塔」のカード。正位置の意味に近いのはどれ？',
  'lead'     => '高い塔に雷が落ち、人が投げ出されている。タロットの16番「塔」は、絵を見ただけで不安になる人が多いカードです。',

  'choices' => [
    'a1' => '安定が続く',
    'a2' => '突然の変化',
    'a3' => '恋の始まり',
    'a4' => '金運の上昇',
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
  'explanation_body' => '正解は「突然の変化」です。塔は、予期していなかった変化や、隠れていたことが明らかになる時を表すとされています。ただし、崩れるのは「偽りの上に積み上げてきたもの」と読むのがこのカードのポイントで、短いあいだは混乱しても、長い目で見れば正しい方向への転換と受け取ることができます。逆位置は、来るべき変化を避けて先送りにしている状態を表すとされます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『突然の変化』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『突然の変化』でした。',
    'a4' => '残念、正解は『突然の変化』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「塔」の正位置の意味は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロット「塔」の正位置の意味は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/tower/',
  'cta_label' => '塔のカードの正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "雷に打たれて崩れ落ちる「塔」のカード。正位置の意味に近いのはどれ？\n\n○ 安定が続く\n○ 突然の変化\n○ 恋の始まり\n○ 金運の上昇\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-tou-no-imi/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
