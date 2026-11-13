<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-zero-ban-no-card',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 8,
  'published_at' => '2026-10-28',

  'question' => 'タロットの大アルカナで、ただ1枚だけ「0番」がついているカードはどれ？',
  'lead'     => 'タロットの大アルカナは全部で22枚。1番から21番までの番号がついていますが、1枚だけ「0番」のカードがあります。',

  'choices' => [
    'a1' => '魔術師',
    'a2' => '愚者',
    'a3' => '世界',
    'a4' => '星',
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
  'explanation_body' => '正解は「愚者」です。愚者は大アルカナ22枚の中で、ただ1枚「0番」を持つカードです。1番の魔術師から始まる旅の出発点、あるいは21番の世界の先にある「次の始まり」を表すとも読まれます。ライダー・ウェイト版では、崖のふちに立つ若者が空を見上げ、軽やかに一歩を踏み出す姿で描かれています。「愚か」という名前ですが、悪い意味のカードではありません。経験や知識にしばられない自由さ、新しいことを始める勇気を表すとされています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『愚者』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『愚者』でした。',
    'a4' => '残念、正解は『愚者』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロットで「0番」のカードはどれ？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロットで「0番」のカードはどれ？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/fool/',
  'cta_label' => '愚者の正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "タロットの大アルカナで、ただ1枚だけ「0番」がついているカードはどれ？\n\n○ 魔術師\n○ 愚者\n○ 世界\n○ 星\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-zero-ban-no-card/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
