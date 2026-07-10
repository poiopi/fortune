<?php
// tests/cases/shichu-traits.php
// Trait Snapshot: docs/shichu-trait-mapping.md の対応表を、tests/cases/shichu-golden.php の
// rawに適用した期待値。shichu-engine.php の実装とは独立に計算している。
// 生成元: tests/tools/export-shichu-traits.php
return [
    'generator' => 'docs/shichu-trait-mapping.md（独立再実装：export-shichu-traits.php）',
    'basedOnGolden' => 'tests/cases/shichu-golden.php',
    'generatedAt' => '2026-07-05T13:55:53+00:00',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 4,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
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
                '行動力' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
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
                '独立' => [
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 3,
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
                '行動力' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '直感' => [
                    'score' => 1,
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 2,
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
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '情熱' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 3,
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
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
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
                '直感' => [
                    'score' => 1,
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
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
                '挑戦' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 4,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 2,
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
                '直感' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
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
                '行動力' => [
                    'score' => 5,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 4,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 5,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
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
                '慎重さ' => [
                    'score' => 2,
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 3,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 2,
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
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
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
                '独立' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
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
                '慎重さ' => [
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
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
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '直感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
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
            'expected' => [
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
                '直感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 3,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '独立' => [
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '直感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 3,
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
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 3,
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
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
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
                '慎重さ' => [
                    'score' => 2,
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
            'expected' => [
                '変化' => [
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
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
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
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
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 4,
                    'type' => 'permanent',
                ],
                '直感' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
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
                '慎重さ' => [
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 4,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
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
            'expected' => [
                '安定性' => [
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
                '直感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 3,
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
            'expected' => [
                '情熱' => [
                    'score' => 3,
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 6,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 3,
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 2,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 6,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
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
                '独立' => [
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 4,
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 2,
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
                '行動力' => [
                    'score' => 4,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 3,
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
                '責任感' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
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
                '責任感' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 1,
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
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 2,
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
            'expected' => [
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
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
            'expected' => [
                '変化' => [
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
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
                '独立' => [
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
            'expected' => [
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
                '独立' => [
                    'score' => 1,
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
                '責任感' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 4,
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '直感' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
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
                '行動力' => [
                    'score' => 1,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
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
                '独立' => [
                    'score' => 2,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 4,
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
                '慎重さ' => [
                    'score' => 3,
                    'type' => 'permanent',
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
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '安定性' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '慎重さ' => [
                    'score' => 2,
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
            ],
        ],
    ],
];
