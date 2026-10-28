<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tsurusareta-otoko-hyoujou',
  'series'       => 'B',
  'number'       => 7,
  'published_at' => '2026-10-28',

  'question' => 'タロットの「吊るされた男」、男はどんな表情で描かれている？',
  'lead'     => '木から逆さまに吊るされた男が描かれた、大アルカナ12番のカード。絵だけを見ると、つらい場面のようにも見えます。では、その男の顔は、どんな表情で描かれているでしょうか。',

  'choices' => [
    'a1' => '苦しそう',
    'a2' => '怒っている',
    'a3' => '穏やか',
    'a4' => '泣いている',
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
  'explanation_body' => '逆さまに吊るされているのに、男の顔は穏やかに描かれています。苦しんでいるのではなく、自分でそこにいることを選んだ、と読むのがこのカードの特徴です。ライダー版タロットの作者として知られるA・E・ウェイトも、著書の中で、この顔は苦しみではなく深く没頭している表情だと説明しています。逆さの姿勢は、ふだんと上下が入れ替わった世界を見ていることを表し、「視点を変えると別のものが見えてくる」という意味につながります。そのため、正位置の吊るされた男は「今は動かず、待つことに意味がある時」を表すとされ、悪いカードではありません。一方、逆位置では、意味のない我慢を続けている状態や、そろそろ動き出すタイミングを表すとされています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『穏やか』でした。',
    'a2' => '残念、正解は『穏やか』でした。',
    'a3' => '正解です！',
    'a4' => '残念、正解は『穏やか』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「吊るされた男」の表情は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロットの大アルカナ「吊るされた男」にまつわる4択クイズ。答えを選んだあと、正解とカードの意味をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/hanged-man/',
  'cta_label' => '吊るされた男の正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "タロットの「吊るされた男」。逆さに吊るされた男の顔は、どんな表情で描かれている？\n\n○ 苦しそう\n○ 怒っている\n○ 穏やか\n○ 泣いている\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tsurusareta-otoko-hyoujou/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
