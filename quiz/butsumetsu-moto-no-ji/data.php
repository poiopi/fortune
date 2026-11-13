<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'butsumetsu-moto-no-ji',
  'series'       => 'B',
  'themes'       => ['kinun'],
  'season'       => [],
  'listed'       => true,
  'number'       => 20,
  'published_at' => '2026-10-28',

  'question' => '六曜の「仏滅」は、もとは別の字で書かれていたという説があります。その字はどれ？',
  'lead'     => '六曜でいちばん縁起が悪いとされる「仏滅」。仏教の言葉のように見えますが、実は仏教とは関係がないと言われています。',

  'choices' => [
    'a1' => '物滅',
    'a2' => '不滅',
    'a3' => '仏没',
    'a4' => '打滅',
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

  'correct_choice'   => 'a1',
  'explanation_body' => '正解は「物滅」です。仏滅はもともと「空亡」「虚亡」と書かれ、「すべてが空しくなる日」という意味だったとされます。それが「物滅」と書かれるようになり、さらに「仏」の字が当てられた、という説が知られています。ただし、古い資料では「仏滅」の字のほうが先に出てくるという指摘もあり、はっきりしない部分もあります。いずれにしても、仏教の教えとは直接の関係はありません。',
  'explanation_intro' => [
    'a1' => '正解です！',
    'a2' => '残念、正解は『物滅』でした。',
    'a3' => '残念、正解は『物滅』でした。',
    'a4' => '残念、正解は『物滅』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '「仏滅」のもとの字は？'.site_title_suffix(' - '.SITE_NAME),
  'description' => '「仏滅」のもとの字は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/rokuyo/butsumetsu/',
  'cta_label' => '仏滅の由来と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "六曜の「仏滅」は、もとは別の字で書かれていたという説があります。その字はどれ？\n\n○ 物滅\n○ 不滅\n○ 仏没\n○ 打滅\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/butsumetsu-moto-no-ji/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
