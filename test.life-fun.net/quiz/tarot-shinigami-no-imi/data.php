<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-shinigami-no-imi',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 9,
  'published_at' => '2026-10-28',

  'question' => 'タロットの「死神」のカード。正位置の意味にいちばん近いのはどれ？',
  'lead'     => 'タロットでいちばん誤解されやすいと言われる13番「死神」。名前だけを見ると怖いカードですが、正位置で表すとされる意味は何でしょう。',

  'choices' => [
    'a1' => '不幸の予告',
    'a2' => '終わりと始まり',
    'a3' => '病気への注意',
    'a4' => '別れが確定する',
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
  'explanation_body' => '正解は「終わりと始まり」です。死神は「死」そのものを告げるカードではなく、何かが終わり、新しいものが始まることを告げる使者とされています。絵には、白馬に乗った骸骨の騎士が描かれ、たてがみの白い花は「終わりの中にある希望」の象徴と読まれます。正位置は「終わりを受け入れることで次の扉が開く」、逆位置は「終わるべきものにしがみついている状態」を表すとされます。名前の印象とは違い、前に進むきっかけをくれるカードです。',
  'explanation_intro' => [
    'a1' => '残念、正解は『終わりと始まり』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『終わりと始まり』でした。',
    'a4' => '残念、正解は『終わりと始まり』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「死神」の本当の意味は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロット「死神」の本当の意味は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/death/',
  'cta_label' => '死神の正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "タロットの「死神」のカード。正位置の意味にいちばん近いのはどれ？\n\n○ 不幸の予告\n○ 終わりと始まり\n○ 病気への注意\n○ 別れが確定する\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-shinigami-no-imi/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
