<?php
// tests/known-issues/ritchin-collabels-cases.php
// 律音バグ（tests/known-issues/ritchin-collabels-reference-error.md）により、
// Golden Masterから除外した入力ケース。expectedは未採取（現行JSがReferenceErrorになるため）。
// 生成元: tests/tools/export-shichu-golden.js
return [
    'generator' => 'test.life-fun.net/shichu.php (JS)',
    'generatorVersion' => '2026-07-05',
    'generatedAt' => '2026-07-05T13:42:11.339Z',
    'seed' => 20260705,
    'note' => '律音（getRitchinのcolLabelsスコープ外参照）により現行JS版ではReferenceErrorになるケース。バグ修正後、この入力でGolden Masterを再生成すればexpectedを採取できる。',
    'cases' => [
        [
            'input' => [
                'year' => 1938,
                'month' => 10,
                'day' => 4,
                'hour' => 9,
                'gender' => 'female',
                'note' => 'seed生成 #2',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1954,
                'month' => 4,
                'day' => 10,
                'hour' => 11,
                'gender' => 'male',
                'note' => 'seed生成 #10',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 2099,
                'month' => 6,
                'day' => 20,
                'hour' => 13,
                'gender' => 'female',
                'note' => 'seed生成 #26',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1909,
                'month' => 2,
                'day' => 18,
                'hour' => 13,
                'gender' => 'female',
                'note' => 'seed生成 #49',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 2082,
                'month' => 2,
                'day' => 11,
                'hour' => 9,
                'gender' => 'female',
                'note' => 'seed生成 #56',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1999,
                'month' => 5,
                'day' => 17,
                'hour' => 20,
                'gender' => 'female',
                'note' => 'seed生成 #59',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1956,
                'month' => 8,
                'day' => 17,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #63',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1944,
                'month' => 9,
                'day' => 17,
                'hour' => 8,
                'gender' => 'male',
                'note' => 'seed生成 #67',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1961,
                'month' => 3,
                'day' => 9,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #77',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
        [
            'input' => [
                'year' => 1902,
                'month' => 11,
                'day' => 24,
                'hour' => 10,
                'gender' => 'female',
                'note' => 'seed生成 #84',
            ],
            'reason' => '律音成立（既知バグのためGolden Masterから除外）',
        ],
    ],
];
