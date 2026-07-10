<?php
// tests/cases/seiza-golden.php
// Golden Master: 月日366通り×時間帯5種=1830ケース全件（サンプリングではなく全数）。
// test.life-fun.net/seiza.php の計算ロジックから直接算出。
// 生成元: tests/tools/export-seiza-data.js（再実行すれば作り直せる）
return [
    'generator' => 'test.life-fun.net/seiza.php (getZodiacIndex/getInnerTypeIndex/getTimeZoneIndex)',
    'generatorVersion' => '2026-07-05',
    'generatedAt' => '2026-07-05T22:59:55.379Z',
    'caseCount' => 1830,
    'cases' => [
        [
            'input' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 1,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 1,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 2,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 2,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 3,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 3,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 4,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 4,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 5,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 5,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 6,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 6,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 7,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 7,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 8,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 8,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 9,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 9,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 10,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 10,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 11,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 1,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 1,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 1,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 1,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 1,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 2,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 2,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 2,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 2,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 2,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 3,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 3,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 3,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 3,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 3,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 4,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 4,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 4,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 4,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 4,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 5,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 5,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 5,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 5,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 5,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 6,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 6,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 6,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 6,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 6,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 7,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 7,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 7,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 7,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 7,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 8,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 8,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 8,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 8,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 8,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 9,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 9,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 9,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 9,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 9,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 10,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 10,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 10,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 10,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 10,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 11,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 11,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 11,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 11,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 11,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 12,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 12,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 12,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 12,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 12,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 13,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 13,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 13,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 13,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 13,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 14,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 14,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 14,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 14,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 14,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 15,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 15,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 15,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 15,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 15,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 16,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 16,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 16,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 16,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 16,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 17,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 17,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 17,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 17,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 17,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 18,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 18,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 18,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 18,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 18,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 19,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 19,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 19,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 19,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 19,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 20,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 20,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 20,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 20,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 20,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 8,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 21,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 21,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 21,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 21,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 21,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 11,
                'innerTypeIndex' => 9,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 22,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 22,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 22,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 22,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 22,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 10,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 23,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 23,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 23,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 23,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 23,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 11,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 24,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 24,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 24,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 24,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 24,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 0,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 25,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 25,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 25,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 25,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 25,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 1,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 26,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 26,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 26,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 26,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 26,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 2,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 27,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 27,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 27,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 27,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 27,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 3,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 28,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 28,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 28,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 28,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 28,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 4,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 29,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 29,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 29,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 29,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 29,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 5,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 30,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 30,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 30,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 30,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 30,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 6,
                'timeZoneIndex' => 4,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 31,
                'timeZoneCode' => 'M',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 0,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 31,
                'timeZoneCode' => 'D',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 1,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 31,
                'timeZoneCode' => 'N',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 2,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 31,
                'timeZoneCode' => 'L',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 3,
            ],
        ],
        [
            'input' => [
                'month' => 12,
                'day' => 31,
                'timeZoneCode' => 'U',
            ],
            'expected' => [
                'signIndex' => 0,
                'innerTypeIndex' => 7,
                'timeZoneIndex' => 4,
            ],
        ],
    ],
];
