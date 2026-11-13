<?php
declare(strict_types=1);
require_once __DIR__ . '/../../inc/site.php';

return [
  'slug'         => 'tarot-sessei-no-tenshi',
  'series'       => 'B',
  'themes'       => ['mame'],
  'season'       => [],
  'number'       => 43,
  'published_at' => '2026-11-13',

  'question' => 'タロットの「節制」。描かれている天使は、何をしている？',
  'lead'     => '大アルカナ14番「節制」には、翼を持つ天使が描かれています。片足は陸に、もう片足は水の中。その天使は、両手で何をしているのでしょうか。',

  'choices' => [
    'a1' => 'ラッパを吹いている',
    'a2' => '杯から杯へ水を注いでいる',
    'a3' => '剣を構えている',
    'a4' => '本を読んでいる',
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
  'explanation_body' => '節制の天使は、一方の杯からもう一方の杯へ、水を静かに注いでいます。片足は陸に、もう片足は水の中に置き、天と地のあいだでバランスを保つ姿です。このカードが表すのは「ちょうどいい」を探すこと。過剰でも不足でもなく、状況に合わせて調整し続ける、生きたバランス感覚とされています。正位置では「急がず着実に進む時」、逆位置では仕事や感情など、どこかが「やりすぎ」になっている状態を表すとされます。なお、ラッパを吹く天使が描かれているのは、大アルカナ20番の「審判」のカードです。',
  'explanation_intro' => [
    'a1' => '残念、正解は『杯から杯へ水を注いでいる』でした。',
    'a2' => '正解です！',
    'a3' => '残念、正解は『杯から杯へ水を注いでいる』でした。',
    'a4' => '残念、正解は『杯から杯へ水を注いでいる』でした。',
  ],
  'explanation_indexable' => false,

  'title'       => 'タロット「節制」の天使は何をしている？｜Daily Quiz'.site_title_suffix(' - '.SITE_NAME),
  'description' => 'タロットの大アルカナ「節制」にまつわる4択クイズ。答えを選んだあと、正解とカードの意味をわかりやすく解説します。',

  'cta_url'   => '/articles/tarot/temperance/',
  'cta_label' => '節制の正位置・逆位置・恋愛での意味をくわしく読む',

  'sns' => [
    'threads' => "タロットの「節制」。描かれている天使は、何をしている？\n\n○ ラッパを吹いている\n○ 杯から杯へ水を注いでいる\n○ 剣を構えている\n○ 本を読んでいる\n\nあなたはどれ？\n答えと解説はこちら → https://life-fun.net/quiz/tarot-sessei-no-tenshi/?utm_source=threads&utm_medium=social&utm_campaign=daily_quiz",
    'note' => null,
  ],
];
