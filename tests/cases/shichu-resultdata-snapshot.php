<?php
// tests/cases/shichu-resultdata-snapshot.php
// ShichuResult（完全なResultData）のスナップショット。tarot・seizaの完成見本。
// 生成元: tests/tools/export-shichu-resultdata.php
return [
    'generator' => 'test.life-fun.net/inc/shichu-engine.php (Step1-4完成版)',
    'note' => 'meta/raw/traits/highlights/extrasを含む完全なResultData（ShichuResult）のスナップショット。tarot・seizaのResultData化の完成見本、および将来のリファクタ時の回帰基準として使う。',
    'generatedAt' => '2026-07-06T07:55:35+09:00',
    'caseCount' => 100,
    'cases' => [
        [
            'input' => [
                'year' => 1990,
                'month' => 1,
                'day' => 1,
                'hour' => null,
                'gender' => 'male',
                'note' => '通常ケース・時刻なし',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 5,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 8,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 18,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 28,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 38,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 48,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 58,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 68,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 78,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 15,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ざくろジュース',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '好きな音楽を聴く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1990,
                'month' => 1,
                'day' => 5,
                'hour' => 10,
                'gender' => 'female',
                'note' => '小寒節入り前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 5,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 0,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 10,
                                'tenGodIndex' => 8,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 20,
                                'tenGodIndex' => 9,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 30,
                                'tenGodIndex' => 0,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 40,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 50,
                                'tenGodIndex' => 2,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 60,
                                'tenGodIndex' => 3,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 70,
                                'tenGodIndex' => 4,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'アンバー',
                            'meaning' => '安定と地に足のついた運を呼ぶ',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 24,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ホットチョコレート',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '断捨離を少しだけ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1988,
                'month' => 2,
                'day' => 3,
                'hour' => 23,
                'gender' => 'male',
                'note' => '立春前日・子の刻境界(hour=23)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 8,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 9,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 19,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 29,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 39,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 49,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 59,
                                'tenGodIndex' => 1,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 69,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 79,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 2,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1988,
                'month' => 2,
                'day' => 5,
                'hour' => 0,
                'gender' => 'female',
                'note' => '立春後・子の刻(hour=0)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 0,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 0,
                                'tenGodIndex' => 3,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 10,
                                'tenGodIndex' => 2,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 20,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 30,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 40,
                                'tenGodIndex' => 9,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 50,
                                'tenGodIndex' => 8,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 60,
                                'tenGodIndex' => 7,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 70,
                                'tenGodIndex' => 6,
                                'juniName' => '沐浴',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'パールホワイト',
                            'meaning' => '純粋さと新しい始まりの色',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 6,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '断捨離を少しだけ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2000,
                'month' => 2,
                'day' => 29,
                'hour' => 12,
                'gender' => 'male',
                'note' => '閏年2/29(21世紀係数)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 2,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 12,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 22,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 32,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 42,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 52,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 62,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 72,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 20,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1996,
                'month' => 2,
                'day' => 29,
                'hour' => 6,
                'gender' => 'female',
                'note' => '閏年2/29(20世紀係数)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 3,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 8,
                                'tenGodIndex' => 3,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 18,
                                'tenGodIndex' => 2,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 28,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 38,
                                'tenGodIndex' => 0,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 48,
                                'tenGodIndex' => 9,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 58,
                                'tenGodIndex' => 8,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 68,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 78,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 11,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '神社の境内',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2024,
                'month' => 2,
                'day' => 29,
                'hour' => 18,
                'gender' => 'male',
                'note' => '閏年2/29(直近)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：癸水（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 9,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 2,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 12,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 22,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 32,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 42,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 52,
                                'tenGodIndex' => 1,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 62,
                                'tenGodIndex' => 0,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 72,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 24,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ホットチョコレート',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1985,
                'month' => 12,
                'day' => 31,
                'hour' => 23,
                'gender' => 'female',
                'note' => '年末・子の刻',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 2,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 12,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 22,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 32,
                                'tenGodIndex' => 8,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 42,
                                'tenGodIndex' => 9,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 52,
                                'tenGodIndex' => 0,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 62,
                                'tenGodIndex' => 1,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 72,
                                'tenGodIndex' => 2,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 36,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '空を見上げる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1999,
                'month' => 12,
                'day' => 31,
                'hour' => 0,
                'gender' => 'male',
                'note' => '世紀またぎ前日',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 8,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 18,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 28,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 38,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 48,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 58,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 68,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 78,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 28,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2000,
                'month' => 1,
                'day' => 1,
                'hour' => 1,
                'gender' => 'female',
                'note' => '世紀またぎ当日',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 1,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 11,
                                'tenGodIndex' => 0,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 21,
                                'tenGodIndex' => 1,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 31,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 41,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 51,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 61,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 71,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 39,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '丘の上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1975,
                'month' => 6,
                'day' => 15,
                'hour' => null,
                'gender' => 'male',
                'note' => '通常ケース・時刻なし',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 4,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 3,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 13,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 23,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 33,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 43,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 53,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 63,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 73,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'パールホワイト',
                            'meaning' => '純粋さと新しい始まりの色',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 13,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '笑顔で挨拶する',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1982,
                'month' => 7,
                'day' => 20,
                'hour' => 14,
                'gender' => 'female',
                'note' => '通常ケース',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 4,
                                'tenGodIndex' => 2,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 14,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 24,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 34,
                                'tenGodIndex' => 9,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 2,
                                'startAge' => 44,
                                'tenGodIndex' => 8,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 1,
                                'startAge' => 54,
                                'tenGodIndex' => 7,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 0,
                                'startAge' => 64,
                                'tenGodIndex' => 6,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 74,
                                'tenGodIndex' => 5,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 16,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1960,
                'month' => 3,
                'day' => 5,
                'hour' => 3,
                'gender' => 'male',
                'note' => '驚蟄前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 4,
                    ],
                    'hourPillar' => [
                        'stem' => 8,
                        'branch' => 2,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 0,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 10,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 20,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 30,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 40,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 50,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 60,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 70,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'アンバー',
                            'meaning' => '安定と地に足のついた運を呼ぶ',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 15,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'パール系のアクセサリー',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2010,
                'month' => 4,
                'day' => 4,
                'hour' => 9,
                'gender' => 'female',
                'note' => '清明前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 8,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 10,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 10,
                                'tenGodIndex' => 4,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 20,
                                'tenGodIndex' => 3,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 30,
                                'tenGodIndex' => 2,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 40,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 50,
                                'tenGodIndex' => 0,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 60,
                                'tenGodIndex' => 9,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 70,
                                'tenGodIndex' => 8,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 80,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 47,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '好きな音楽を聴く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1993,
                'month' => 5,
                'day' => 5,
                'hour' => 21,
                'gender' => 'male',
                'note' => '立夏前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 11,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 0,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 10,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 20,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 30,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 40,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 50,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 60,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 70,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 12,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '抹茶ラテ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '図書館の窓際',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '早起きして朝日を見る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1978,
                'month' => 8,
                'day' => 7,
                'hour' => 15,
                'gender' => 'female',
                'note' => '立秋前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：辛金（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 4,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 7,
                        'branch' => 1,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 4,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 0,
                                'tenGodIndex' => 8,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 10,
                                'tenGodIndex' => 9,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 20,
                                'tenGodIndex' => 6,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 30,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 40,
                                'tenGodIndex' => 4,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 50,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 60,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 70,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 15,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2005,
                'month' => 11,
                'day' => 7,
                'hour' => 2,
                'gender' => 'male',
                'note' => '立冬前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 3,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 0,
                                'tenGodIndex' => 3,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 10,
                                'tenGodIndex' => 0,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 20,
                                'tenGodIndex' => 1,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 30,
                                'tenGodIndex' => 8,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 40,
                                'tenGodIndex' => 9,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 50,
                                'tenGodIndex' => 6,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 60,
                                'tenGodIndex' => 7,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 70,
                                'tenGodIndex' => 4,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 17,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '植物園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1965,
                'month' => 10,
                'day' => 8,
                'hour' => 17,
                'gender' => 'female',
                'note' => '寒露前後',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 5,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 10,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 10,
                                'tenGodIndex' => 2,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 20,
                                'tenGodIndex' => 5,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 30,
                                'tenGodIndex' => 4,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 40,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 50,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 60,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 70,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 80,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 23,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'れんこんのきんぴら',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '手紙を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1900,
                'month' => 1,
                'day' => 1,
                'hour' => null,
                'gender' => 'male',
                'note' => '対応範囲下限(1900年)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 11,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 10,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 8,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 18,
                                'tenGodIndex' => 0,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 28,
                                'tenGodIndex' => 9,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 38,
                                'tenGodIndex' => 8,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 48,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 58,
                                'tenGodIndex' => 6,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 68,
                                'tenGodIndex' => 5,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 78,
                                'tenGodIndex' => 4,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 3,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '空を見上げる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2099,
                'month' => 12,
                'day' => 31,
                'hour' => 23,
                'gender' => 'female',
                'note' => '対応範囲上限(2099年)',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 1,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 11,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 21,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 31,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 41,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 51,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 61,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 71,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 41,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '花屋の前',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '空を見上げる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1939,
                'month' => 11,
                'day' => 14,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #1',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 3,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 8,
                                'tenGodIndex' => 3,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 18,
                                'tenGodIndex' => 2,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 28,
                                'tenGodIndex' => 5,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 38,
                                'tenGodIndex' => 4,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 48,
                                'tenGodIndex' => 7,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 58,
                                'tenGodIndex' => 6,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 68,
                                'tenGodIndex' => 9,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 78,
                                'tenGodIndex' => 8,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 44,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '柚子入り和菓子',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '早起きして朝日を見る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2067,
                'month' => 11,
                'day' => 12,
                'hour' => 12,
                'gender' => 'male',
                'note' => 'seed生成 #3',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'monthPillar' => [
                        'stem' => 7,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'hourPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 2,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 12,
                                'tenGodIndex' => 4,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 22,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 32,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 42,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 52,
                                'tenGodIndex' => 0,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 62,
                                'tenGodIndex' => 1,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 72,
                                'tenGodIndex' => 8,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 2,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '断捨離を少しだけ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'シルクのスカーフ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1928,
                'month' => 4,
                'day' => 16,
                'hour' => 14,
                'gender' => 'male',
                'note' => 'seed生成 #4',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 4,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 1,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 7,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 17,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 27,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 37,
                                'tenGodIndex' => 4,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 47,
                                'tenGodIndex' => 5,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 57,
                                'tenGodIndex' => 6,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 67,
                                'tenGodIndex' => 7,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 77,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 40,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2070,
                'month' => 6,
                'day' => 11,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #5',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 9,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 19,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 29,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 39,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 49,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 59,
                                'tenGodIndex' => 3,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 69,
                                'tenGodIndex' => 2,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 79,
                                'tenGodIndex' => 5,
                                'juniName' => '死',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 24,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '赤い果実のタルト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '日記を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1957,
                'month' => 10,
                'day' => 1,
                'hour' => 5,
                'gender' => 'female',
                'note' => 'seed生成 #6',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 3,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 2,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 12,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 22,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 32,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 42,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 52,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 62,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 72,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 21,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ホットチョコレート',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2018,
                'month' => 5,
                'day' => 28,
                'hour' => 8,
                'gender' => 'male',
                'note' => 'seed生成 #7',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 4,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 3,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 13,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 23,
                                'tenGodIndex' => 0,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 33,
                                'tenGodIndex' => 1,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 43,
                                'tenGodIndex' => 2,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 53,
                                'tenGodIndex' => 3,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 63,
                                'tenGodIndex' => 4,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 73,
                                'tenGodIndex' => 5,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 24,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '赤い果実のタルト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2027,
                'month' => 6,
                'day' => 16,
                'hour' => 11,
                'gender' => 'male',
                'note' => 'seed生成 #8',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '身強',
                        'cls' => 'strength-strong',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 3,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 13,
                                'tenGodIndex' => 8,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 23,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 2,
                                'startAge' => 33,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 1,
                                'startAge' => 43,
                                'tenGodIndex' => 5,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 0,
                                'startAge' => 53,
                                'tenGodIndex' => 4,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 63,
                                'tenGodIndex' => 3,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 73,
                                'tenGodIndex' => 2,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '行動力' => [
                        'score' => 5,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    'エネルギーが旺盛。積極的な行動が吉。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 24,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '抹茶ラテ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2089,
                'month' => 7,
                'day' => 20,
                'hour' => 12,
                'gender' => 'female',
                'note' => 'seed生成 #9',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 6,
                        'periods' => [
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 6,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 16,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 26,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 36,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 46,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 56,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 66,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 76,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 30,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '星座を調べる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1988,
                'month' => 2,
                'day' => 3,
                'hour' => 0,
                'gender' => 'male',
                'note' => 'seed生成 #11',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 8,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 9,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 19,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 29,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 39,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 49,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 59,
                                'tenGodIndex' => 1,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 69,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 79,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 2,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1994,
                'month' => 4,
                'day' => 29,
                'hour' => 11,
                'gender' => 'female',
                'note' => 'seed生成 #12',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 8,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 18,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 28,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 38,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 48,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 58,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 68,
                                'tenGodIndex' => 6,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 78,
                                'tenGodIndex' => 7,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 5,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 39,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'れんこんのきんぴら',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1911,
                'month' => 2,
                'day' => 18,
                'hour' => 12,
                'gender' => 'male',
                'note' => 'seed生成 #13',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 11,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 4,
                                'tenGodIndex' => 0,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 14,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 24,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 34,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 44,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 54,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 64,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 74,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 37,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '植物園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2062,
                'month' => 2,
                'day' => 22,
                'hour' => 9,
                'gender' => 'male',
                'note' => 'seed生成 #14',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 4,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 14,
                                'tenGodIndex' => 8,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 24,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 34,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 44,
                                'tenGodIndex' => 1,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 54,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 64,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 74,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'アンバー',
                            'meaning' => '安定と地に足のついた運を呼ぶ',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 3,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '笑顔で挨拶する',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2090,
                'month' => 2,
                'day' => 28,
                'hour' => 13,
                'gender' => 'male',
                'note' => 'seed生成 #15',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 2,
                                'tenGodIndex' => 0,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 12,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 22,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 32,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 42,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 52,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 62,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 72,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 5,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '柚子入り和菓子',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1932,
                'month' => 1,
                'day' => 22,
                'hour' => 7,
                'gender' => 'male',
                'note' => 'seed生成 #16',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 5,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 15,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 25,
                                'tenGodIndex' => 8,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 35,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 45,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 55,
                                'tenGodIndex' => 5,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 65,
                                'tenGodIndex' => 4,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 75,
                                'tenGodIndex' => 3,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 39,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '赤い果実のタルト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '早起きして朝日を見る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2092,
                'month' => 6,
                'day' => 19,
                'hour' => 1,
                'gender' => 'male',
                'note' => 'seed生成 #17',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：辛金（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 0,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'dayPillar' => [
                        'stem' => 7,
                        'branch' => 11,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 6,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 6,
                                'tenGodIndex' => 6,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 16,
                                'tenGodIndex' => 9,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 26,
                                'tenGodIndex' => 8,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 36,
                                'tenGodIndex' => 1,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 46,
                                'tenGodIndex' => 0,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 56,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 66,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 76,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 35,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '神社の境内',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1925,
                'month' => 9,
                'day' => 15,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #18',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 2,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 2,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 12,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 22,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 32,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 42,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 52,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 62,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 72,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 2,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '好きな音楽を聴く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お守り',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1960,
                'month' => 10,
                'day' => 28,
                'hour' => 11,
                'gender' => 'female',
                'note' => 'seed生成 #19',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 1,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 6,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 7,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 17,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 27,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 37,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 47,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 57,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 67,
                                'tenGodIndex' => 0,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 77,
                                'tenGodIndex' => 1,
                                'juniName' => '死',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 9,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '柚子入り和菓子',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '手紙を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1956,
                'month' => 11,
                'day' => 18,
                'hour' => 2,
                'gender' => 'female',
                'note' => 'seed生成 #20',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 1,
                    ],
                    'hourPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 1,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 4,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 14,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 24,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 34,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 44,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 54,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 64,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 74,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ラベンダー',
                            'meaning' => '直感と霊感を高める',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 48,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1944,
                'month' => 3,
                'day' => 19,
                'hour' => 2,
                'gender' => 'female',
                'note' => 'seed生成 #21',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 8,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 4,
                                'tenGodIndex' => 4,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 14,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 24,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 34,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 44,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 54,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 64,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 74,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 32,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '塩麹のおにぎり',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1939,
                'month' => 11,
                'day' => 5,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #22',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 0,
                        'branch' => 10,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 1,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 11,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 21,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 31,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 41,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 51,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 61,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 71,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 43,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '生姜湯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'シルクのスカーフ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1974,
                'month' => 8,
                'day' => 13,
                'hour' => 10,
                'gender' => 'male',
                'note' => 'seed生成 #23',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 9,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 19,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 29,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 39,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 49,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 59,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 69,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 79,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 15,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '丘の上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '日記を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1911,
                'month' => 3,
                'day' => 3,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #24',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 11,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 8,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 9,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 19,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 29,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 39,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 49,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 59,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 69,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 79,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 34,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'れんこんのきんぴら',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2013,
                'month' => 8,
                'day' => 16,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #25',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 5,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 7,
                                'tenGodIndex' => 7,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 17,
                                'tenGodIndex' => 8,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 27,
                                'tenGodIndex' => 9,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 37,
                                'tenGodIndex' => 0,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 47,
                                'tenGodIndex' => 1,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 57,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 67,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 77,
                                'tenGodIndex' => 4,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 28,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '赤い果実のタルト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '神社の境内',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お守り',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1900,
                'month' => 12,
                'day' => 6,
                'hour' => 18,
                'gender' => 'male',
                'note' => 'seed生成 #27',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：癸水（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 9,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 1,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 11,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 21,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 31,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 41,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 51,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 61,
                                'tenGodIndex' => 3,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 71,
                                'tenGodIndex' => 2,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 45,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'シルクのスカーフ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1951,
                'month' => 9,
                'day' => 12,
                'hour' => 13,
                'gender' => 'male',
                'note' => 'seed生成 #28',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 3,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 1,
                                'tenGodIndex' => 3,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 11,
                                'tenGodIndex' => 0,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 21,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 31,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 41,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 51,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 61,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 71,
                                'tenGodIndex' => 4,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 33,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ブルーベリームフィン',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '星座を調べる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2051,
                'month' => 12,
                'day' => 31,
                'hour' => 10,
                'gender' => 'male',
                'note' => 'seed生成 #29',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 8,
                                'tenGodIndex' => 9,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 18,
                                'tenGodIndex' => 8,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 28,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 38,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 48,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 58,
                                'tenGodIndex' => 4,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 68,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 78,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 3,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'れんこんのきんぴら',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '金色のしおり',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1978,
                'month' => 1,
                'day' => 4,
                'hour' => 22,
                'gender' => 'male',
                'note' => 'seed生成 #30',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 11,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 9,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 19,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 29,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 39,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 49,
                                'tenGodIndex' => 1,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 59,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 69,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 79,
                                'tenGodIndex' => 8,
                                'juniName' => '冠帯',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 21,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1980,
                'month' => 3,
                'day' => 14,
                'hour' => 10,
                'gender' => 'male',
                'note' => 'seed生成 #31',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 7,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 17,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 27,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 37,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 47,
                                'tenGodIndex' => 8,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 57,
                                'tenGodIndex' => 9,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 67,
                                'tenGodIndex' => 0,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 77,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 19,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ブルーベリームフィン',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '図書館の窓際',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '笑顔で挨拶する',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1978,
                'month' => 11,
                'day' => 21,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #32',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 4,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 5,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 15,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 25,
                                'tenGodIndex' => 5,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 35,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 45,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 55,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 65,
                                'tenGodIndex' => 1,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 75,
                                'tenGodIndex' => 8,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 42,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '柚子入り和菓子',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '水晶のさざれ石',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2003,
                'month' => 12,
                'day' => 3,
                'hour' => 19,
                'gender' => 'male',
                'note' => 'seed生成 #33',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 9,
                                'tenGodIndex' => 2,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 19,
                                'tenGodIndex' => 1,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 29,
                                'tenGodIndex' => 0,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 39,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 49,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 59,
                                'tenGodIndex' => 7,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 69,
                                'tenGodIndex' => 6,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 79,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 10,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ざくろジュース',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'シルクのスカーフ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2090,
                'month' => 11,
                'day' => 29,
                'hour' => 8,
                'gender' => 'female',
                'note' => 'seed生成 #34',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：癸水（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 9,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 7,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 8,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 18,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 28,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 38,
                                'tenGodIndex' => 0,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 48,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 58,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 68,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 78,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'アンバー',
                            'meaning' => '安定と地に足のついた運を呼ぶ',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 38,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '赤い果実のタルト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '丘の上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2081,
                'month' => 3,
                'day' => 24,
                'hour' => 1,
                'gender' => 'male',
                'note' => 'seed生成 #35',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 7,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 6,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 6,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 16,
                                'tenGodIndex' => 3,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 26,
                                'tenGodIndex' => 2,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 36,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 46,
                                'tenGodIndex' => 0,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 56,
                                'tenGodIndex' => 9,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 66,
                                'tenGodIndex' => 8,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 76,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 42,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '塩麹のおにぎり',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '星座を調べる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1910,
                'month' => 12,
                'day' => 18,
                'hour' => 1,
                'gender' => 'male',
                'note' => 'seed生成 #36',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 7,
                                'tenGodIndex' => 2,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 17,
                                'tenGodIndex' => 5,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 27,
                                'tenGodIndex' => 4,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 37,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 47,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 57,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 67,
                                'tenGodIndex' => 8,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 77,
                                'tenGodIndex' => 1,
                                'juniName' => '沐浴',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 45,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '赤い果実のタルト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '図書館の窓際',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの本',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2075,
                'month' => 12,
                'day' => 17,
                'hour' => 7,
                'gender' => 'male',
                'note' => 'seed生成 #37',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 3,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 13,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 23,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 33,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 43,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 53,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 63,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 73,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 12,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'れんこんのきんぴら',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2002,
                'month' => 8,
                'day' => 11,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #38',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：辛金（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 7,
                        'branch' => 11,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 9,
                                'tenGodIndex' => 8,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 19,
                                'tenGodIndex' => 1,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 29,
                                'tenGodIndex' => 0,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 39,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 49,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 59,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 69,
                                'tenGodIndex' => 4,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 79,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 10,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '星座を調べる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1992,
                'month' => 5,
                'day' => 27,
                'hour' => 22,
                'gender' => 'female',
                'note' => 'seed生成 #39',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：癸水（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 8,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 5,
                    ],
                    'dayPillar' => [
                        'stem' => 9,
                        'branch' => 3,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 7,
                                'tenGodIndex' => 3,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 17,
                                'tenGodIndex' => 0,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 2,
                                'startAge' => 27,
                                'tenGodIndex' => 1,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 1,
                                'startAge' => 37,
                                'tenGodIndex' => 8,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 0,
                                'startAge' => 47,
                                'tenGodIndex' => 9,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 57,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 67,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 77,
                                'tenGodIndex' => 4,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 40,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '柚子入り和菓子',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '花屋の前',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2099,
                'month' => 4,
                'day' => 4,
                'hour' => 16,
                'gender' => 'female',
                'note' => 'seed生成 #40',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：辛金（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'dayPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 10,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 10,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 20,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 30,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 40,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 50,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 60,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 70,
                                'tenGodIndex' => 4,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 80,
                                'tenGodIndex' => 7,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 17,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '植物園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1937,
                'month' => 12,
                'day' => 8,
                'hour' => 0,
                'gender' => 'female',
                'note' => 'seed生成 #41',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 0,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 5,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 10,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 10,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 20,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 30,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 40,
                                'tenGodIndex' => 9,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 50,
                                'tenGodIndex' => 8,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 60,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 70,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 80,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 10,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '早起きして朝日を見る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1943,
                'month' => 10,
                'day' => 26,
                'hour' => 15,
                'gender' => 'female',
                'note' => 'seed生成 #42',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 10,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'hourPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 4,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 14,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 24,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 34,
                                'tenGodIndex' => 1,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 44,
                                'tenGodIndex' => 0,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 54,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 64,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 74,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'パールホワイト',
                            'meaning' => '純粋さと新しい始まりの色',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 44,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '好きな音楽を聴く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1920,
                'month' => 1,
                'day' => 11,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #43',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 8,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 18,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 28,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 38,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 48,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 58,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 68,
                                'tenGodIndex' => 8,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 78,
                                'tenGodIndex' => 9,
                                'juniName' => '死',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 29,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '手紙を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2084,
                'month' => 1,
                'day' => 6,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #44',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 8,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 9,
                                'tenGodIndex' => 4,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 19,
                                'tenGodIndex' => 5,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 29,
                                'tenGodIndex' => 6,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 39,
                                'tenGodIndex' => 7,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 49,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 59,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 69,
                                'tenGodIndex' => 0,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 79,
                                'tenGodIndex' => 1,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ディープレッド',
                            'meaning' => '情熱と生命力を強化する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 4,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '抹茶ラテ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '神社の境内',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2093,
                'month' => 5,
                'day' => 22,
                'hour' => 7,
                'gender' => 'female',
                'note' => 'seed生成 #45',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 5,
                                'tenGodIndex' => 0,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 15,
                                'tenGodIndex' => 1,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 25,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 35,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 45,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 55,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 65,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 75,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ラベンダー',
                            'meaning' => '直感と霊感を高める',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 45,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '日記を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2059,
                'month' => 11,
                'day' => 6,
                'hour' => 15,
                'gender' => 'male',
                'note' => 'seed生成 #46',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 0,
                        'branch' => 10,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 1,
                    ],
                    'hourPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 10,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 10,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 20,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 30,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 40,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 50,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 60,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 70,
                                'tenGodIndex' => 0,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 80,
                                'tenGodIndex' => 1,
                                'juniName' => '死',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 28,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '塩麹のおにぎり',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2023,
                'month' => 9,
                'day' => 24,
                'hour' => 21,
                'gender' => 'female',
                'note' => 'seed生成 #47',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 7,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 3,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 9,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 5,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 15,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 25,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 35,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 45,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 55,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 65,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 75,
                                'tenGodIndex' => 4,
                                'juniName' => '沐浴',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'アンバー',
                            'meaning' => '安定と地に足のついた運を呼ぶ',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 18,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの文房具',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2086,
                'month' => 2,
                'day' => 28,
                'hour' => 15,
                'gender' => 'male',
                'note' => 'seed生成 #48',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 2,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 12,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 22,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 32,
                                'tenGodIndex' => 6,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 42,
                                'tenGodIndex' => 7,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 52,
                                'tenGodIndex' => 8,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 62,
                                'tenGodIndex' => 9,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 72,
                                'tenGodIndex' => 0,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'パールホワイト',
                            'meaning' => '純粋さと新しい始まりの色',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 12,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '花屋の前',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お守り',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2035,
                'month' => 10,
                'day' => 5,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #50',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 11,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 9,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 19,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 29,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 39,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 49,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 59,
                                'tenGodIndex' => 0,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 69,
                                'tenGodIndex' => 1,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 79,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'パールホワイト',
                            'meaning' => '純粋さと新しい始まりの色',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 2,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ホットチョコレート',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1947,
                'month' => 7,
                'day' => 18,
                'hour' => 13,
                'gender' => 'male',
                'note' => 'seed生成 #51',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '身強',
                        'cls' => 'strength-strong',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 3,
                                'tenGodIndex' => 8,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 13,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 23,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 33,
                                'tenGodIndex' => 5,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 2,
                                'startAge' => 43,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 1,
                                'startAge' => 53,
                                'tenGodIndex' => 3,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 0,
                                'startAge' => 63,
                                'tenGodIndex' => 2,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 73,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '行動力' => [
                        'score' => 6,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'エネルギーが旺盛。積極的な行動が吉。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 40,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '抹茶ラテ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2063,
                'month' => 8,
                'day' => 13,
                'hour' => 14,
                'gender' => 'male',
                'note' => 'seed生成 #52',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：癸水（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 9,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 2,
                                'tenGodIndex' => 6,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 12,
                                'tenGodIndex' => 7,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 22,
                                'tenGodIndex' => 4,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 32,
                                'tenGodIndex' => 5,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 42,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 52,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 62,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 72,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 47,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '生姜湯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '花屋の前',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '金色のしおり',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2082,
                'month' => 9,
                'day' => 12,
                'hour' => 22,
                'gender' => 'male',
                'note' => 'seed生成 #53',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：癸水（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 2,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 9,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 8,
                                'tenGodIndex' => 9,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 18,
                                'tenGodIndex' => 8,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 28,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 38,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 48,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 58,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 68,
                                'tenGodIndex' => 5,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 78,
                                'tenGodIndex' => 4,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '恵みの雨のような直感と感受性が特徴。柔軟で洞察力があり、秘密を守る力も持ちます。内省的な深みがあります。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 25,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '図書館の窓際',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1921,
                'month' => 1,
                'day' => 24,
                'hour' => 13,
                'gender' => 'male',
                'note' => 'seed生成 #54',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'monthPillar' => [
                        'stem' => 7,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 11,
                    ],
                    'hourPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 7,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 3,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        6,
                        7,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 8,
                                'branch' => 2,
                                'startAge' => 4,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 3,
                                'startAge' => 14,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 24,
                                'tenGodIndex' => 9,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 34,
                                'tenGodIndex' => 8,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 44,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 54,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 64,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 74,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 41,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '手紙を書く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1980,
                'month' => 1,
                'day' => 23,
                'hour' => 5,
                'gender' => 'female',
                'note' => 'seed生成 #55',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 4,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 14,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 24,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 34,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 44,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 54,
                                'tenGodIndex' => 0,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 64,
                                'tenGodIndex' => 3,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 74,
                                'tenGodIndex' => 2,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 6,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 7,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '星空の見える屋上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '好きな音楽を聴く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '香りのよいキャンドル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1993,
                'month' => 5,
                'day' => 16,
                'hour' => 8,
                'gender' => 'female',
                'note' => 'seed生成 #57',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 3,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 7,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 17,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 27,
                                'tenGodIndex' => 5,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 37,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 47,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 57,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 67,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 77,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ラベンダー',
                            'meaning' => '直感と霊感を高める',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 3,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2048,
                'month' => 1,
                'day' => 31,
                'hour' => 7,
                'gender' => 'female',
                'note' => 'seed生成 #58',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 1,
                                'tenGodIndex' => 6,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 11,
                                'tenGodIndex' => 7,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 21,
                                'tenGodIndex' => 8,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 31,
                                'tenGodIndex' => 9,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 41,
                                'tenGodIndex' => 0,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 51,
                                'tenGodIndex' => 1,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 61,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 71,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 5,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '金色のしおり',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1946,
                'month' => 4,
                'day' => 14,
                'hour' => 4,
                'gender' => 'female',
                'note' => 'seed生成 #60',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 4,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 3,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 13,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 23,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 33,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 43,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 53,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 63,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 73,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 25,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2018,
                'month' => 1,
                'day' => 19,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #61',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：辛金（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 7,
                        'branch' => 11,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 5,
                                'tenGodIndex' => 7,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 15,
                                'tenGodIndex' => 6,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 25,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 35,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 45,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 55,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 65,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 75,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 46,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2023,
                'month' => 12,
                'day' => 4,
                'hour' => 5,
                'gender' => 'female',
                'note' => 'seed生成 #62',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 3,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 3,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 9,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        4,
                        5,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 1,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 11,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 21,
                                'tenGodIndex' => 0,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 31,
                                'tenGodIndex' => 1,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 41,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 51,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 61,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 71,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 30,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1934,
                'month' => 12,
                'day' => 3,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #64',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 10,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 2,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 2,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 2,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 12,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 22,
                                'tenGodIndex' => 0,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 3,
                                'startAge' => 32,
                                'tenGodIndex' => 1,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 42,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 52,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 62,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 72,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 47,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '塩麹のおにぎり',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '早起きして朝日を見る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1995,
                'month' => 9,
                'day' => 20,
                'hour' => 7,
                'gender' => 'female',
                'note' => 'seed生成 #65',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 11,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 4,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 6,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 6,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 16,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 26,
                                'tenGodIndex' => 4,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 36,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 46,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 56,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 66,
                                'tenGodIndex' => 8,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 76,
                                'tenGodIndex' => 9,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 29,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '香りのよいキャンドル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2053,
                'month' => 11,
                'day' => 6,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #66',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 11,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 10,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 10,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 20,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 30,
                                'tenGodIndex' => 0,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 40,
                                'tenGodIndex' => 1,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 50,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 60,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 70,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 80,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'アンバー',
                            'meaning' => '安定と地に足のついた運を呼ぶ',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 29,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'シルクのスカーフ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1941,
                'month' => 3,
                'day' => 2,
                'hour' => 23,
                'gender' => 'female',
                'note' => 'seed生成 #68',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 5,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 1,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 11,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 21,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 31,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 41,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 51,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 61,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 71,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ロイヤルブルー',
                            'meaning' => '信頼と知性を象徴する',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 23,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2086,
                'month' => 8,
                'day' => 9,
                'hour' => 1,
                'gender' => 'female',
                'note' => 'seed生成 #69',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 3,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 1,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 11,
                                'tenGodIndex' => 4,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 21,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 31,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 41,
                                'tenGodIndex' => 1,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 51,
                                'tenGodIndex' => 0,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 61,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 71,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 15,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ブルーベリームフィン',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '丘の上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '金色のしおり',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1908,
                'month' => 8,
                'day' => 28,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #70',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'monthPillar' => [
                        'stem' => 6,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 3,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 4,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 6,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 7,
                                'tenGodIndex' => 4,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 17,
                                'tenGodIndex' => 5,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 27,
                                'tenGodIndex' => 2,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 37,
                                'tenGodIndex' => 3,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 47,
                                'tenGodIndex' => 0,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 57,
                                'tenGodIndex' => 1,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 67,
                                'tenGodIndex' => 8,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 77,
                                'tenGodIndex' => 9,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シャンパンゴールド',
                            'meaning' => '喜びと豊かさのエネルギー',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 29,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ざくろジュース',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '図書館の窓際',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '断捨離を少しだけ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'パール系のアクセサリー',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1952,
                'month' => 3,
                'day' => 12,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #71',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 8,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 5,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 8,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 4,
                                'startAge' => 8,
                                'tenGodIndex' => 9,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 5,
                                'startAge' => 18,
                                'tenGodIndex' => 8,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 6,
                                'startAge' => 28,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 7,
                                'startAge' => 38,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 8,
                                'startAge' => 48,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 58,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 68,
                                'tenGodIndex' => 5,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 78,
                                'tenGodIndex' => 4,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ラベンダー',
                            'meaning' => '直感と霊感を高める',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 8,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '好きな音楽を聴く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1925,
                'month' => 9,
                'day' => 21,
                'hour' => 20,
                'gender' => 'female',
                'note' => 'seed生成 #72',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'hourPillar' => [
                        'stem' => 8,
                        'branch' => 10,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 8,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 6,
                        'periods' => [
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 6,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 16,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 26,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 36,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 46,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 56,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 66,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 76,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 22,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1985,
                'month' => 3,
                'day' => 20,
                'hour' => 3,
                'gender' => 'female',
                'note' => 'seed生成 #73',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 6,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 5,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 15,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 25,
                                'tenGodIndex' => 4,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 35,
                                'tenGodIndex' => 5,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 45,
                                'tenGodIndex' => 6,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 55,
                                'tenGodIndex' => 7,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 65,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 75,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 41,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1907,
                'month' => 8,
                'day' => 29,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #74',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 10,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 3,
                                'tenGodIndex' => 9,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 13,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 23,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 33,
                                'tenGodIndex' => 2,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 43,
                                'tenGodIndex' => 3,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 53,
                                'tenGodIndex' => 4,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 63,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 73,
                                'tenGodIndex' => 6,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 27,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '栗ご飯',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '空を見上げる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お気に入りの本',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2084,
                'month' => 4,
                'day' => 29,
                'hour' => 18,
                'gender' => 'female',
                'note' => 'seed生成 #75',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 9,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 8,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 8,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 2,
                                'startAge' => 18,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 28,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 38,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 48,
                                'tenGodIndex' => 5,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 58,
                                'tenGodIndex' => 4,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 68,
                                'tenGodIndex' => 3,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 78,
                                'tenGodIndex' => 2,
                                'juniName' => '病',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 37,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '白桃',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '川沿いの散歩道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'シルクのスカーフ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1991,
                'month' => 9,
                'day' => 3,
                'hour' => 0,
                'gender' => 'male',
                'note' => 'seed生成 #76',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丙火（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 2,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 4,
                        'branch' => 0,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 4,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 9,
                                'tenGodIndex' => 9,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 19,
                                'tenGodIndex' => 8,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 5,
                                'startAge' => 29,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 4,
                                'startAge' => 39,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 3,
                                'startAge' => 49,
                                'tenGodIndex' => 5,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 59,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 69,
                                'tenGodIndex' => 3,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 79,
                                'tenGodIndex' => 2,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '太陽のように明るく積極的。人を照らす存在感と、誰にでも分け隔てなく接する開放性が魅力。やや飽きっぽい面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 27,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2086,
                'month' => 6,
                'day' => 21,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #78',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：辛金（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 0,
                        'branch' => 6,
                    ],
                    'dayPillar' => [
                        'stem' => 7,
                        'branch' => 5,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 0,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 7,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 5,
                                'tenGodIndex' => 4,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 15,
                                'tenGodIndex' => 7,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 25,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 35,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 45,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 0,
                                'startAge' => 55,
                                'tenGodIndex' => 1,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 1,
                                'startAge' => 65,
                                'tenGodIndex' => 0,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 2,
                                'startAge' => 75,
                                'tenGodIndex' => 3,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '宝石のような美的感覚とプライドを持ちます。繊細で完璧主義的な面がある一方、芸術・美の分野に才能を発揮。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ゴールド',
                            'meaning' => '成功と繁栄を引き寄せる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 5,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '朝の公園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '窓を開けて換気',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '金色のしおり',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2080,
                'month' => 7,
                'day' => 5,
                'hour' => 2,
                'gender' => 'male',
                'note' => 'seed生成 #79',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 6,
                        'branch' => 0,
                    ],
                    'monthPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 0,
                    ],
                    'hourPillar' => [
                        'stem' => 1,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 6,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 8,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 1,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 0,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 10,
                                'tenGodIndex' => 0,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 20,
                                'tenGodIndex' => 1,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 30,
                                'tenGodIndex' => 2,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 40,
                                'tenGodIndex' => 3,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 0,
                                'startAge' => 50,
                                'tenGodIndex' => 4,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 1,
                                'startAge' => 60,
                                'tenGodIndex' => 5,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 2,
                                'startAge' => 70,
                                'tenGodIndex' => 6,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 20,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ざくろジュース',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '老舗の喫茶店',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '深呼吸を3回',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '四葉のクローバー押し花',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2089,
                'month' => 3,
                'day' => 3,
                'hour' => 8,
                'gender' => 'male',
                'note' => 'seed生成 #80',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 9,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 9,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 19,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 29,
                                'tenGodIndex' => 6,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 39,
                                'tenGodIndex' => 7,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 49,
                                'tenGodIndex' => 4,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 59,
                                'tenGodIndex' => 5,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 69,
                                'tenGodIndex' => 2,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 79,
                                'tenGodIndex' => 3,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'ターコイズ',
                            'meaning' => 'コミュニケーション力が高まる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 32,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '塩麹のおにぎり',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '海が見える場所',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '空を見上げる',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1945,
                'month' => 3,
                'day' => 14,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #81',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：壬水（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 9,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 8,
                        'branch' => 6,
                    ],
                    'hourPillar' => null,
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 7,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 4,
                                'startAge' => 7,
                                'tenGodIndex' => 8,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 5,
                                'startAge' => 17,
                                'tenGodIndex' => 9,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 6,
                                'startAge' => 27,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 7,
                                'startAge' => 37,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 8,
                                'startAge' => 47,
                                'tenGodIndex' => 2,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 9,
                                'startAge' => 57,
                                'tenGodIndex' => 3,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 10,
                                'startAge' => 67,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 11,
                                'startAge' => 77,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大海のような包容力と知恵を持ちます。流動性が高く変化に強い一方、集中力の継続が課題になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 28,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'カモミールティー',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '植物園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'お守り',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2051,
                'month' => 5,
                'day' => 24,
                'hour' => 5,
                'gender' => 'female',
                'note' => 'seed生成 #82',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：己土（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 7,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 5,
                    ],
                    'dayPillar' => [
                        'stem' => 5,
                        'branch' => 9,
                    ],
                    'hourPillar' => [
                        'stem' => 3,
                        'branch' => 3,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 3,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 4,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 6,
                                'startAge' => 4,
                                'tenGodIndex' => 7,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 7,
                                'startAge' => 14,
                                'tenGodIndex' => 6,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 8,
                                'startAge' => 24,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 9,
                                'startAge' => 34,
                                'tenGodIndex' => 8,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 10,
                                'startAge' => 44,
                                'tenGodIndex' => 1,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 11,
                                'startAge' => 54,
                                'tenGodIndex' => 0,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 0,
                                'startAge' => 64,
                                'tenGodIndex' => 3,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 1,
                                'startAge' => 74,
                                'tenGodIndex' => 2,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '肥沃な大地のように受容力が高く、人の気持ちに寄り添えます。心配性な面もありますが、包みこむような温かさが魅力。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 36,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '柚子入り和菓子',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '花屋の前',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '断捨離を少しだけ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '銀のコイン',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1997,
                'month' => 9,
                'day' => 5,
                'hour' => 9,
                'gender' => 'female',
                'note' => 'seed生成 #83',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 3,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 10,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 3,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 9,
                                'startAge' => 1,
                                'tenGodIndex' => 9,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 10,
                                'startAge' => 11,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 11,
                                'startAge' => 21,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 0,
                                'startAge' => 31,
                                'tenGodIndex' => 2,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 41,
                                'tenGodIndex' => 3,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 51,
                                'tenGodIndex' => 4,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 61,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 71,
                                'tenGodIndex' => 6,
                                'juniName' => '養',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 23,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ざくろジュース',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '植物園',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '瞑想10分',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '金色のしおり',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1955,
                'month' => 3,
                'day' => 20,
                'hour' => 16,
                'gender' => 'male',
                'note' => 'seed生成 #85',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 1,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 5,
                        'branch' => 3,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 4,
                    ],
                    'hourPillar' => [
                        'stem' => 0,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 1,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 1,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 0,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 4,
                                'branch' => 2,
                                'startAge' => 5,
                                'tenGodIndex' => 8,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 1,
                                'startAge' => 15,
                                'tenGodIndex' => 7,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 25,
                                'tenGodIndex' => 6,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 35,
                                'tenGodIndex' => 5,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 45,
                                'tenGodIndex' => 4,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 55,
                                'tenGodIndex' => 3,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 65,
                                'tenGodIndex' => 2,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 75,
                                'tenGodIndex' => 1,
                                'juniName' => '冠帯',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'パールホワイト',
                            'meaning' => '純粋さと新しい始まりの色',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 24,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '丘の上',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '誰かに感謝を伝える',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2033,
                'month' => 9,
                'day' => 26,
                'hour' => 9,
                'gender' => 'male',
                'note' => 'seed生成 #86',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：庚金（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'monthPillar' => [
                        'stem' => 7,
                        'branch' => 9,
                    ],
                    'dayPillar' => [
                        'stem' => 6,
                        'branch' => 4,
                    ],
                    'hourPillar' => [
                        'stem' => 7,
                        'branch' => 5,
                    ],
                    'dayStrength' => [
                        'label' => '中和',
                        'cls' => 'strength-mid',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 9,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 7,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 6,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        8,
                        9,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 6,
                        'periods' => [
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 6,
                                'tenGodIndex' => 0,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 16,
                                'tenGodIndex' => 9,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 26,
                                'tenGodIndex' => 8,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 36,
                                'tenGodIndex' => 7,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 46,
                                'tenGodIndex' => 6,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 56,
                                'tenGodIndex' => 5,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 66,
                                'tenGodIndex' => 4,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 1,
                                'startAge' => 76,
                                'tenGodIndex' => 3,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '安定性' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '慎重さ' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '刀のような意志の強さと決断力があります。プライドが高く、正義感も旺盛。時に攻撃的になることも。',
                    'バランスが取れた命式。柔軟な対応が強み。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 7,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'はちみつトースト',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '竹林の小道',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '断捨離を少しだけ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '白いハンカチ',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2024,
                'month' => 3,
                'day' => 5,
                'hour' => 1,
                'gender' => 'male',
                'note' => 'seed生成 #87',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：戊土（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'hourPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 8,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 6,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 9,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 1,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        10,
                        11,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 0,
                        'periods' => [
                            [
                                'stem' => 3,
                                'branch' => 3,
                                'startAge' => 0,
                                'tenGodIndex' => 9,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 4,
                                'startAge' => 10,
                                'tenGodIndex' => 0,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 20,
                                'tenGodIndex' => 1,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 30,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 40,
                                'tenGodIndex' => 3,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 50,
                                'tenGodIndex' => 4,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 60,
                                'tenGodIndex' => 5,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 70,
                                'tenGodIndex' => 6,
                                'juniName' => '墓',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '挑戦' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '直感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '山のように安定感があり、信頼される存在。包容力があり、粘り強さが持ち味です。行動は遅くとも着実。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'コーラルピンク',
                            'meaning' => '愛情運と人間関係を向上させる',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 41,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ホットチョコレート',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '花屋の前',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '花を飾る',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '木製のコースター',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 2087,
                'month' => 1,
                'day' => 20,
                'hour' => 4,
                'gender' => 'male',
                'note' => 'seed生成 #88',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：甲木（陽）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 2,
                        'branch' => 6,
                    ],
                    'monthPillar' => [
                        'stem' => 9,
                        'branch' => 1,
                    ],
                    'dayPillar' => [
                        'stem' => 0,
                        'branch' => 2,
                    ],
                    'hourPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 2,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 3,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 9,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 5,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 0,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 2,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 0,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        0,
                        1,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 5,
                        'periods' => [
                            [
                                'stem' => 0,
                                'branch' => 2,
                                'startAge' => 5,
                                'tenGodIndex' => 0,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 3,
                                'startAge' => 15,
                                'tenGodIndex' => 1,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 4,
                                'startAge' => 25,
                                'tenGodIndex' => 2,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 3,
                                'branch' => 5,
                                'startAge' => 35,
                                'tenGodIndex' => 3,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 45,
                                'tenGodIndex' => 4,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 55,
                                'tenGodIndex' => 5,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 65,
                                'tenGodIndex' => 6,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 75,
                                'tenGodIndex' => 7,
                                'juniName' => '胎',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '独立' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '大樹のような強さと正直さを持ちます。向上心が高く、まっすぐに上を目指す気質。リーダーシップがあり、頑固さも持ち合わせています。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'エメラルドグリーン',
                            'meaning' => '癒しと成長をもたらす',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 16,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '松の実入りサラダ',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '雑貨屋さん',
                            ],
                            [
                                'cat' => '行動',
                                'item' => 'お気に入りの香りを嗅ぐ',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => 'アロマオイル',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1964,
                'month' => 4,
                'day' => 28,
                'hour' => 15,
                'gender' => 'male',
                'note' => 'seed生成 #89',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：丁火（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 0,
                        'branch' => 4,
                    ],
                    'monthPillar' => [
                        'stem' => 4,
                        'branch' => 4,
                    ],
                    'dayPillar' => [
                        'stem' => 3,
                        'branch' => 7,
                    ],
                    'hourPillar' => [
                        'stem' => 4,
                        'branch' => 8,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 0,
                            'tenGodIndex' => 9,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 2,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 4,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 6,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => true,
                        'startAge' => 3,
                        'periods' => [
                            [
                                'stem' => 5,
                                'branch' => 5,
                                'startAge' => 3,
                                'tenGodIndex' => 2,
                                'juniName' => '帝旺',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 6,
                                'startAge' => 13,
                                'tenGodIndex' => 5,
                                'juniName' => '建禄',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 7,
                                'startAge' => 23,
                                'tenGodIndex' => 4,
                                'juniName' => '冠帯',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 8,
                                'startAge' => 33,
                                'tenGodIndex' => 7,
                                'juniName' => '沐浴',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 9,
                                'startAge' => 43,
                                'tenGodIndex' => 6,
                                'juniName' => '長生',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 10,
                                'startAge' => 53,
                                'tenGodIndex' => 9,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 1,
                                'branch' => 11,
                                'startAge' => 63,
                                'tenGodIndex' => 8,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 2,
                                'branch' => 0,
                                'startAge' => 73,
                                'tenGodIndex' => 1,
                                'juniName' => '絶',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 4,
                        'type' => 'permanent',
                    ],
                    '情熱' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    'ろうそくの炎のような繊細さと情熱を持ちます。集中力が高く、内側に深い感受性を秘めています。神秘的な雰囲気も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'バイオレット',
                            'meaning' => '精神的な覚醒と変容を促す',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 13,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => 'ブルーベリームフィン',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '静かな寺院',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '新しいルートを歩く',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '新しい手帳',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'input' => [
                'year' => 1979,
                'month' => 2,
                'day' => 7,
                'hour' => 8,
                'gender' => 'male',
                'note' => 'seed生成 #90',
            ],
            'resultData' => [
                'meta' => [
                    'title' => '四柱推命',
                    'subtitle' => '日主：乙木（陰）',
                ],
                'raw' => [
                    'yearPillar' => [
                        'stem' => 5,
                        'branch' => 7,
                    ],
                    'monthPillar' => [
                        'stem' => 2,
                        'branch' => 2,
                    ],
                    'dayPillar' => [
                        'stem' => 1,
                        'branch' => 5,
                    ],
                    'hourPillar' => [
                        'stem' => 6,
                        'branch' => 4,
                    ],
                    'dayStrength' => [
                        'label' => '身弱',
                        'cls' => 'strength-weak',
                    ],
                    'tenGodGrid' => [
                        [
                            'label' => '年干',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '年支（蔵干）',
                            'stem' => 5,
                            'tenGodIndex' => 4,
                        ],
                        [
                            'label' => '月干',
                            'stem' => 2,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '月支（蔵干）',
                            'stem' => 0,
                            'tenGodIndex' => 1,
                        ],
                        [
                            'label' => '日支（蔵干）',
                            'stem' => 2,
                            'tenGodIndex' => 3,
                        ],
                        [
                            'label' => '時干',
                            'stem' => 6,
                            'tenGodIndex' => 7,
                        ],
                        [
                            'label' => '時支（蔵干）',
                            'stem' => 4,
                            'tenGodIndex' => 5,
                        ],
                    ],
                    'tenchusatsuBranches' => [
                        2,
                        3,
                    ],
                    'daiyun' => [
                        'forward' => false,
                        'startAge' => 1,
                        'periods' => [
                            [
                                'stem' => 1,
                                'branch' => 1,
                                'startAge' => 1,
                                'tenGodIndex' => 0,
                                'juniName' => '衰',
                            ],
                            [
                                'stem' => 0,
                                'branch' => 0,
                                'startAge' => 11,
                                'tenGodIndex' => 1,
                                'juniName' => '病',
                            ],
                            [
                                'stem' => 9,
                                'branch' => 11,
                                'startAge' => 21,
                                'tenGodIndex' => 8,
                                'juniName' => '死',
                            ],
                            [
                                'stem' => 8,
                                'branch' => 10,
                                'startAge' => 31,
                                'tenGodIndex' => 9,
                                'juniName' => '墓',
                            ],
                            [
                                'stem' => 7,
                                'branch' => 9,
                                'startAge' => 41,
                                'tenGodIndex' => 6,
                                'juniName' => '絶',
                            ],
                            [
                                'stem' => 6,
                                'branch' => 8,
                                'startAge' => 51,
                                'tenGodIndex' => 7,
                                'juniName' => '胎',
                            ],
                            [
                                'stem' => 5,
                                'branch' => 7,
                                'startAge' => 61,
                                'tenGodIndex' => 4,
                                'juniName' => '養',
                            ],
                            [
                                'stem' => 4,
                                'branch' => 6,
                                'startAge' => 71,
                                'tenGodIndex' => 5,
                                'juniName' => '長生',
                            ],
                        ],
                    ],
                ],
                'traits' => [
                    '慎重さ' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '行動力' => [
                        'score' => 3,
                        'type' => 'permanent',
                    ],
                    '変化' => [
                        'score' => 2,
                        'type' => 'permanent',
                    ],
                    '責任感' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                    '安定性' => [
                        'score' => 1,
                        'type' => 'permanent',
                    ],
                ],
                'highlights' => [
                    '柔軟なつる草のような適応力が特徴。社交的で協調性があり、環境に応じて自らを変えられます。美的センスに優れた面も。',
                    '周囲のサポートを活かすことで力を発揮する。',
                ],
                'extras' => [
                    [
                        'type' => 'lucky_color',
                        'label' => 'ラッキーカラー',
                        'value' => [
                            'name' => 'シルバー',
                            'meaning' => '月のエネルギーで直感が冴える',
                        ],
                    ],
                    [
                        'type' => 'lucky_number',
                        'label' => 'ラッキーナンバー',
                        'value' => 13,
                    ],
                    [
                        'type' => 'lucky_items',
                        'label' => 'ラッキーアイテム',
                        'value' => [
                            [
                                'cat' => '食べ物',
                                'item' => '金柑',
                            ],
                            [
                                'cat' => '場所',
                                'item' => '美術館のカフェ',
                            ],
                            [
                                'cat' => '行動',
                                'item' => '笑顔で挨拶する',
                            ],
                            [
                                'cat' => 'アイテム',
                                'item' => '天然石のブレスレット',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
