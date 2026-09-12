<?php
declare(strict_types=1);

return [
  'slug'         => 'omikuji-junban',
  'series'       => 'B',
  'number'       => 6,
  'published_at' => '2026-09-17',

  'question' => 'おみくじの吉凶の順番について、正しいのはどれ？',
  'lead'     => '大吉、中吉、小吉……おみくじにはおなじみの順番がありますが、実はこの順番、ある共通認識があります。',

  'choices' => [
    'a1' => '全国どの神社でも同じ順番に統一されている',
    'a2' => '神社によって順番が違うことがある',
    'a3' => '大吉が一番運が悪い',
    'a4' => '凶より大凶の方が運が良い',
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
  'explanation_body' => '多くの神社で『大吉→吉→中吉→小吉→末吉→凶→大凶』の順が使われていますが、吉と中吉・小吉の位置が入れ替わった神社もあり、17種類以上の細かい段階や『半吉』『平』といった珍しい表記を用意している神社も存在します。おみくじの順番に全国共通の公式ルールがあるわけではない、という点は複数の神社解説サイトで一致しています。',
  'explanation_intro' => [
    'a1' => '残念、正解は『神社によって順番が違うことがある』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『神社によって順番が違うことがある』でした。',
    'a4' => '残念、正解は『神社によって順番が違うことがある』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'おみくじの順番、全国共通だと思ってた？｜Daily Quiz - 占いPortal',
  'description' => 'おみくじの吉凶の順番にまつわる4択クイズ。正解と、意外と知られていない背景を解説します。',

  'cta_url'   => '/calendar',
  'cta_label' => '開運カレンダーで、日々の運勢の見方をもっと知る',

  'sns' => [
    'threads' => "おみくじの吉凶の順番について、正しいのはどれ？\n\n○ 全国どの神社でも同じ順番に統一されている\n○ 神社によって順番が違うことがある\n○ 大吉が一番運が悪い\n○ 凶より大凶の方が運が良い\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/omikuji-junban/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
