<?php
// tests/cases/axis-values-snapshot.php
// Axis Snapshot: Aggregation SnapshotにAxis変換（A001〜A009）を適用した期待値。
// 生成元: tests/tools/export-axis-values.php
return [
    'generator' => 'inc/axis-mapping.php（独立再実装：export-axis-values.php）',
    'basedOn' => 'tests/cases/axis-aggregation-snapshot.php',
    'generatedAt' => '2026-07-05T23:26:32+00:00',
    'caseCount' => 50,
    'cases' => [
        [
            'shichuInput' => [
                'year' => 1990,
                'month' => 1,
                'day' => 1,
                'hour' => null,
                'gender' => 'male',
                'note' => '通常ケース・時刻なし',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 2,
                    'total' => 4,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1990,
                'month' => 1,
                'day' => 5,
                'hour' => 10,
                'gender' => 'female',
                'note' => '小寒節入り前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1988,
                'month' => 2,
                'day' => 3,
                'hour' => 23,
                'gender' => 'male',
                'note' => '立春前日・子の刻境界(hour=23)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 0,
                    'total' => 7,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 2,
                    'total' => 7,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1988,
                'month' => 2,
                'day' => 5,
                'hour' => 0,
                'gender' => 'female',
                'note' => '立春後・子の刻(hour=0)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 4,
                    'transient' => 1,
                    'total' => 5,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2000,
                'month' => 2,
                'day' => 29,
                'hour' => 12,
                'gender' => 'male',
                'note' => '閏年2/29(21世紀係数)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 0,
                    'transient' => 2,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1996,
                'month' => 2,
                'day' => 29,
                'hour' => 6,
                'gender' => 'female',
                'note' => '閏年2/29(20世紀係数)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 1,
                    'total' => 7,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2024,
                'month' => 2,
                'day' => 29,
                'hour' => 18,
                'gender' => 'male',
                'note' => '閏年2/29(直近)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 3,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 2,
                    'total' => 4,
                ],
                '行動性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1985,
                'month' => 12,
                'day' => 31,
                'hour' => 23,
                'gender' => 'female',
                'note' => '年末・子の刻',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 3,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 1,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1999,
                'month' => 12,
                'day' => 31,
                'hour' => 0,
                'gender' => 'male',
                'note' => '世紀またぎ前日',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 4,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 2,
                    'total' => 9,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2000,
                'month' => 1,
                'day' => 1,
                'hour' => 1,
                'gender' => 'female',
                'note' => '世紀またぎ当日',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 4,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 1,
                    'total' => 8,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1975,
                'month' => 6,
                'day' => 15,
                'hour' => null,
                'gender' => 'male',
                'note' => '通常ケース・時刻なし',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 5,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 2,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1982,
                'month' => 7,
                'day' => 20,
                'hour' => 14,
                'gender' => 'female',
                'note' => '通常ケース',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 5,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 0,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 3,
                    'transient' => 1,
                    'total' => 4,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1960,
                'month' => 3,
                'day' => 5,
                'hour' => 3,
                'gender' => 'male',
                'note' => '驚蟄前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 6,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 2,
                    'total' => 5,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2010,
                'month' => 4,
                'day' => 4,
                'hour' => 9,
                'gender' => 'female',
                'note' => '清明前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 6,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 1,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1993,
                'month' => 5,
                'day' => 5,
                'hour' => 21,
                'gender' => 'male',
                'note' => '立夏前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 7,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '変革性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 3,
                    'total' => 6,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1978,
                'month' => 8,
                'day' => 7,
                'hour' => 15,
                'gender' => 'female',
                'note' => '立秋前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 7,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 1,
                    'total' => 4,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2005,
                'month' => 11,
                'day' => 7,
                'hour' => 2,
                'gender' => 'male',
                'note' => '立冬前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 8,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 2,
                    'total' => 7,
                ],
                '感応性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1965,
                'month' => 10,
                'day' => 8,
                'hour' => 17,
                'gender' => 'female',
                'note' => '寒露前後',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 8,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 1,
                    'total' => 6,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1900,
                'month' => 1,
                'day' => 1,
                'hour' => null,
                'gender' => 'male',
                'note' => '対応範囲下限(1900年)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 9,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 1,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 5,
                    'transient' => 1,
                    'total' => 6,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2099,
                'month' => 12,
                'day' => 31,
                'hour' => 23,
                'gender' => 'female',
                'note' => '対応範囲上限(2099年)',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 9,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 1,
                    'total' => 3,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1939,
                'month' => 11,
                'day' => 14,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #1',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 10,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
                '変革性' => [
                    'permanent' => 0,
                    'transient' => 2,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2067,
                'month' => 11,
                'day' => 12,
                'hour' => 12,
                'gender' => 'male',
                'note' => 'seed生成 #3',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 10,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 1,
                    'total' => 8,
                ],
                '感応性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1928,
                'month' => 4,
                'day' => 16,
                'hour' => 14,
                'gender' => 'male',
                'note' => 'seed生成 #4',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 11,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 2,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2070,
                'month' => 6,
                'day' => 11,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #5',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 11,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 0,
                    'total' => 7,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 1,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1957,
                'month' => 10,
                'day' => 1,
                'hour' => 5,
                'gender' => 'female',
                'note' => 'seed生成 #6',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 12,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 8,
                    'transient' => 2,
                    'total' => 10,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2018,
                'month' => 5,
                'day' => 28,
                'hour' => 8,
                'gender' => 'male',
                'note' => 'seed生成 #7',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 12,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 1,
                    'total' => 8,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2027,
                'month' => 6,
                'day' => 16,
                'hour' => 11,
                'gender' => 'male',
                'note' => 'seed生成 #8',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 13,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 4,
                    'transient' => 0,
                    'total' => 4,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 2,
                    'total' => 3,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2089,
                'month' => 7,
                'day' => 20,
                'hour' => 12,
                'gender' => 'female',
                'note' => 'seed生成 #9',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 13,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 8,
                    'transient' => 1,
                    'total' => 9,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1988,
                'month' => 2,
                'day' => 3,
                'hour' => 0,
                'gender' => 'male',
                'note' => 'seed生成 #11',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 14,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 9,
                    'transient' => 2,
                    'total' => 11,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1994,
                'month' => 4,
                'day' => 29,
                'hour' => 11,
                'gender' => 'female',
                'note' => 'seed生成 #12',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 14,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 10,
                    'transient' => 0,
                    'total' => 10,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 1,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1911,
                'month' => 2,
                'day' => 18,
                'hour' => 12,
                'gender' => 'male',
                'note' => 'seed生成 #13',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 15,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2062,
                'month' => 2,
                'day' => 22,
                'hour' => 9,
                'gender' => 'male',
                'note' => 'seed生成 #14',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 15,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 1,
                    'total' => 3,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2090,
                'month' => 2,
                'day' => 28,
                'hour' => 13,
                'gender' => 'male',
                'note' => 'seed生成 #15',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 16,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 2,
                    'total' => 3,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1932,
                'month' => 1,
                'day' => 22,
                'hour' => 7,
                'gender' => 'male',
                'note' => 'seed生成 #16',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 16,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 8,
                    'transient' => 1,
                    'total' => 9,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2092,
                'month' => 6,
                'day' => 19,
                'hour' => 1,
                'gender' => 'male',
                'note' => 'seed生成 #17',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 17,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
                '変革性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 2,
                    'total' => 4,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1925,
                'month' => 9,
                'day' => 15,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #18',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 17,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 1,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1960,
                'month' => 10,
                'day' => 28,
                'hour' => 11,
                'gender' => 'female',
                'note' => 'seed生成 #19',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 18,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 2,
                    'total' => 4,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1956,
                'month' => 11,
                'day' => 18,
                'hour' => 2,
                'gender' => 'female',
                'note' => 'seed生成 #20',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 18,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 1,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1944,
                'month' => 3,
                'day' => 19,
                'hour' => 2,
                'gender' => 'female',
                'note' => 'seed生成 #21',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 19,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 8,
                    'transient' => 0,
                    'total' => 8,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 2,
                    'total' => 5,
                ],
                '行動性' => [
                    'permanent' => 1,
                    'transient' => 1,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1939,
                'month' => 11,
                'day' => 5,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #22',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 19,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 1,
                    'total' => 4,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1974,
                'month' => 8,
                'day' => 13,
                'hour' => 10,
                'gender' => 'male',
                'note' => 'seed生成 #23',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 20,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 1,
                    'total' => 8,
                ],
                '変革性' => [
                    'permanent' => 0,
                    'transient' => 1,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1911,
                'month' => 3,
                'day' => 3,
                'hour' => null,
                'gender' => 'male',
                'note' => 'seed生成 #24',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 20,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 1,
                    'total' => 8,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2013,
                'month' => 8,
                'day' => 16,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #25',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 21,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 3,
                    'total' => 10,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1900,
                'month' => 12,
                'day' => 6,
                'hour' => 18,
                'gender' => 'male',
                'note' => 'seed生成 #27',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 21,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 0,
                    'total' => 7,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1951,
                'month' => 9,
                'day' => 12,
                'hour' => 13,
                'gender' => 'male',
                'note' => 'seed生成 #28',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '行動性' => [
                    'permanent' => 4,
                    'transient' => 2,
                    'total' => 6,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2051,
                'month' => 12,
                'day' => 31,
                'hour' => 10,
                'gender' => 'male',
                'note' => 'seed生成 #29',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 0,
                    'total' => 6,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1978,
                'month' => 1,
                'day' => 4,
                'hour' => 22,
                'gender' => 'male',
                'note' => 'seed生成 #30',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 5,
                    'transient' => 0,
                    'total' => 5,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 5,
                    'transient' => 2,
                    'total' => 7,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1980,
                'month' => 3,
                'day' => 14,
                'hour' => 10,
                'gender' => 'male',
                'note' => 'seed生成 #31',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 1,
                    'total' => 8,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 1978,
                'month' => 11,
                'day' => 21,
                'hour' => null,
                'gender' => 'female',
                'note' => 'seed生成 #32',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => true,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 7,
                    'transient' => 0,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '感応性' => [
                    'permanent' => 0,
                    'transient' => 2,
                    'total' => 2,
                ],
                '自律性' => [
                    'permanent' => 1,
                    'transient' => 0,
                    'total' => 1,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
        [
            'shichuInput' => [
                'year' => 2003,
                'month' => 12,
                'day' => 3,
                'hour' => 19,
                'gender' => 'male',
                'note' => 'seed生成 #33',
            ],
            'tarotInput' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => false,
            ],
            'seizaInput' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                '堅実性' => [
                    'permanent' => 6,
                    'transient' => 1,
                    'total' => 7,
                ],
                '変革性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
                '感応性' => [
                    'permanent' => 3,
                    'transient' => 0,
                    'total' => 3,
                ],
                '行動性' => [
                    'permanent' => 2,
                    'transient' => 0,
                    'total' => 2,
                ],
            ],
        ],
    ],
];
