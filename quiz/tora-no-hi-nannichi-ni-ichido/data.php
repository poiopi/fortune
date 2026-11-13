<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tora-no-hi-nannichi-ni-ichido',
  'series'       => 'B',
  'themes'       => ['kinun'],
  'season'       => [],
  'listed'       => true,
  'number'       => 10,
  'published_at' => '2026-10-28',

  'question' => '財布を新しくする日として人気の「寅の日」。何日に1度めぐってくる？',
  'lead'     => 'カレンダーで見かけることが増えた「寅の日」。金運の吉日として知られていますが、どのくらいの間隔でめぐってくるのでしょう。',

  'choices' => [
    'a1' => '6日に1度',
    'a2' => '12日に1度',
    'a3' => '30日に1度',
    'a4' => '60日に1度',
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
  'explanation_body' => '正解は「12日に1度」です。寅の日は、日ごとにめぐる十二支の「寅」が割り当てられた日なので、12日ごとにやってきます。「虎は千里行って千里戻る」という中国の言い伝えから、出ていったものが戻ってくる日とされ、使ったお金が戻ってくるように、と財布を新しくする日に選ぶ人が多い吉日です。同じ理由で、旅行の出発日にも良いとされています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『12日に1度』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『12日に1度』でした。',
    'a4' => '残念、正解は『12日に1度』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '寅の日は何日に1度？'.site_title_suffix(' - '.SITE_NAME),
  'description' => '寅の日は何日に1度？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/kichijitsu/tora/',
  'cta_label' => '寅の日の由来と過ごし方をくわしく読む',

  'sns' => [
    'threads' => "財布を新しくする日として人気の「寅の日」。何日に1度めぐってくる？\n\n○ 6日に1度\n○ 12日に1度\n○ 30日に1度\n○ 60日に1度\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tora-no-hi-nannichi-ni-ichido/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
