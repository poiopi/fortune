<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tsuki-no-michikake-nannichi',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'listed'       => true,
  'number'       => 13,
  'published_at' => '2026-10-28',

  'question' => '新月から満月になり、また新月に戻るまで。月の満ち欠けは約何日で一巡りする？',
  'lead'     => '細い三日月から、まんまるの満月へ。月は毎晩少しずつ姿を変えていきます。では、ひと回りするのに何日かかるのでしょう。',

  'choices' => [
    'a1' => '約15日',
    'a2' => '約27日',
    'a3' => '約29.5日',
    'a4' => '約31日',
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
  'explanation_body' => '正解は「約29.5日」です。月の満ち欠けは、太陽・地球・月の位置関係によって、地球から見える月の明るい部分が変わることで起こります。新月から次の新月までの、およそ29.5日の一巡りを「1朔望月（さくぼうげつ）」と呼びます。昔の暦の1か月が29日か30日だったのは、この月の周期をもとにしていたためです。新月・三日月・上弦・満月など、満ち欠けのそれぞれの姿には呼び名があります。',
  'explanation_intro' => [
    'a1' => '残念、正解は『約29.5日』でした。',
    'a2' => '残念、正解は『約29.5日』でした。',
    'a3' => '正解です！',
    'a4' => '残念、正解は『約29.5日』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => '月の満ち欠けは約何日で一巡り？'.site_title_suffix(' - '.SITE_NAME),
  'description' => '月の満ち欠けは約何日で一巡り？にまつわる4択クイズ。答えを選んだあと、正解とその背景をわかりやすく解説します。',

  'cta_url'   => '/articles/calendar/moon/',
  'cta_label' => '8つの月の呼び名と意味をくわしく読む',

  'sns' => [
    'threads' => "新月から満月になり、また新月に戻るまで。月の満ち欠けは約何日で一巡りする？\n\n○ 約15日\n○ 約27日\n○ 約29.5日\n○ 約31日\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tsuki-no-michikake-nannichi/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
