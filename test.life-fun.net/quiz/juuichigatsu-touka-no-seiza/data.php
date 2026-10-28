<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'juuichigatsu-touka-no-seiza',
  'series'       => 'B',
  'number'       => 22,
  'published_at' => '2026-10-28',

  'question' => '11月10日生まれの人の星座はどれ？',
  'lead'     => '星占いでよく聞く「あなたは何座？」。11月10日生まれの人は、どの星座にあたるでしょう。',

  'choices' => [
    'a1' => '天秤座',
    'a2' => '蠍座',
    'a3' => '射手座',
    'a4' => '山羊座',
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
  'explanation_body' => '正解は「蠍座」です。蠍座は、10月24日から11月22日ごろに生まれた人の太陽星座で、12星座の8番目にあたります。西洋占星術では「水」のエレメントに分けられ、守護星は冥王星と火星とされています。キーワードは「洞察・情熱・変容・深さ」。物事の表面ではなく本質を見抜く力がある星座と言われています。星座の境目の日は年によって1日ほどずれるので、境目の近くに生まれた人は生まれた年で確かめてみてください。',
  'explanation_intro' => [
    'a1' => '残念、正解は『蠍座』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『蠍座』でした。',
    'a4' => '残念、正解は『蠍座』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '11月10日生まれの星座は？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => '11月10日生まれの星座は？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/seiza/scorpio/',
  'cta_label' => '蠍座の性格・恋愛・相性をくわしく読む',

  'sns' => [
    'threads' => "11月10日生まれの人の星座はどれ？\n\n○ 天秤座\n○ 蠍座\n○ 射手座\n○ 山羊座\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/juuichigatsu-touka-no-seiza/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
