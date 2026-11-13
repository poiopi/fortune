<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-insha-ga-kakageru-mono',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 42,
  'published_at' => '2026-11-13',

  'question' => 'タロットの「隠者」。老人が高く掲げているものは？',
  'lead'     => '大アルカナ9番「隠者」は、雪深い山の上に立つ老人のカードです。老人は、あるものを手に高く掲げています。それは何でしょうか。',

  'choices' => [
    'a1' => '鍵',
    'a2' => 'ランタン',
    'a3' => '鏡',
    'a4' => '剣',
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
  'explanation_body' => '隠者が掲げているのは、ランタンです。雪深い山頂で、老人がランタンを高く掲げている姿が描かれています。老人は道に迷っているのではなく、世界の喧騒から離れ、自分の内側に向かうために、あえてそこにいると読まれます。ランタンは「自分だけの光」、つまり誰かの答えではなく、自分自身の答えを照らす光を表すとされます。そのため、正位置の隠者は「静かに自分と向き合う時」を表し、ひとりの時間を前向きにとらえるカードです。逆位置では、孤立を恐れて周りに合わせすぎている状態や、反対にこもりすぎている状態を表すとされています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『ランタン』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『ランタン』でした。',
    'a4' => '残念、正解は『ランタン』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「隠者」が掲げているものは？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロットの大アルカナ「隠者」にまつわる4択クイズ。答えを選んだあと、正解とカードの意味をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/hermit/',
  'cta_label' => '隠者の正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "タロットの「隠者」。老人が高く掲げているものは？\n\n○ 鍵\n○ ランタン\n○ 鏡\n○ 剣\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-insha-ga-kakageru-mono/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
