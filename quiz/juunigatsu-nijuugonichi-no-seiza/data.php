<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'juunigatsu-nijuugonichi-no-seiza',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [12],
  'number'       => 41,
  'published_at' => '2026-11-13',

  'question' => '12月25日生まれの人の星座は？',
  'lead'     => 'クリスマスの12月25日。この日に生まれた人の星座は、12星座のうちどれでしょうか。12月は、星座が切り替わる月でもあります。',

  'choices' => [
    'a1' => '蠍座',
    'a2' => '射手座',
    'a3' => '山羊座',
    'a4' => '水瓶座',
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
  'explanation_body' => '12月25日生まれの人の星座は、山羊座です。山羊座は12月22日〜1月19日生まれの人の太陽星座で、12星座の10番目にあたります。12月は星座が切り替わる月で、12月21日までは射手座（11月23日〜12月21日）、22日からは山羊座になります。山羊座の守護星は土星、エレメントは「地」。西洋占星術では、目標に向かって一歩ずつ積み上げていく力を持つ星座とされています。2026年は、12月22日がちょうど冬至にあたります。',
  'explanation_intro' => [
    'a1' => '残念、正解は『山羊座』でした。',
    'a2' => '残念、正解は『山羊座』でした。',
    'a3' => '正解です！',
    'a4' => '残念、正解は『山羊座』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '12月25日生まれの星座は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '12月25日生まれの星座を当てる4択クイズ。答えを選んだあと、正解と山羊座の期間・特徴をわかりやすく解説します。',

  'cta_url'   => '/articles/seiza/capricorn/',
  'cta_label' => '山羊座の性格・恋愛・相性をくわしく読む',

  'sns' => [
    'threads' => "12月25日生まれの人の星座は？\n\n○ 蠍座\n○ 射手座\n○ 山羊座\n○ 水瓶座\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/juunigatsu-nijuugonichi-no-seiza/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
