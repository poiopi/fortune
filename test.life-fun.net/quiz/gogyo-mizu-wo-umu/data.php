<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'gogyo-mizu-wo-umu',
  'series'       => 'B',
  'number'       => 23,
  'published_at' => '2026-10-28',

  'question' => '五行（木・火・土・金・水）で、「水」を生み出すのはどれ？',
  'lead'     => '東洋の占いの土台になっている「五行」。木・火・土・金・水の5つには、お互いを生み出す順番があります。',

  'choices' => [
    'a1' => '木',
    'a2' => '火',
    'a3' => '土',
    'a4' => '金',
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
  'explanation_body' => '正解は「金」です。五行には「相生（そうしょう）」という、お互いを生み出す順番があります。木は火を生み、火は土を生み、土は金を生み、金は水を生み、水は木を生む、という循環です。金属の表面に水滴がつく様子から「金は水を生む」と説明されることがあります。反対に、水は火を消す、というように、お互いを抑える関係は「相剋（そうこく）」と呼ばれます。',
  'explanation_intro' => [
    'a1' => '残念、正解は『金』でした。',
    'a2' => '残念、正解は『金』でした。',
    'a3' => '残念、正解は『金』でした。',
    'a4' => '正解です！',
  ],
  'explanation_indexable' => false,

  'title'       => '五行で「水」を生むのは？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '五行で「水」を生むのは？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/gogyo/',
  'cta_label' => '五行の意味と相性をくわしく読む',

  'sns' => [
    'threads' => "五行（木・火・土・金・水）で、「水」を生み出すのはどれ？\n\n○ 木\n○ 火\n○ 土\n○ 金\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/gogyo-mizu-wo-umu/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
