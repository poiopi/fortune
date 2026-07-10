<?php
// tests/cases/tarot-traits.php
// Trait Snapshot: inc/tarot-trait-mapping.php を44入力に適用した期待値。
// 生成元: tests/tools/export-tarot-traits.php
return [
    'generator' => 'inc/tarot-trait-mapping.php（独立再実装：export-tarot-traits.php）',
    'basedOnGolden' => 'tests/cases/tarot-golden.php',
    'generatedAt' => '2026-07-05T14:20:27+00:00',
    'caseCount' => 44,
    'cases' => [
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => true,
            ],
            'expected' => [
                '挑戦' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => false,
            ],
            'expected' => [],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => true,
            ],
            'expected' => [
                '行動力' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => false,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => true,
            ],
            'expected' => [
                '直感' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => false,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 3,
                'isUpright' => true,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 3,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 4,
                'isUpright' => true,
            ],
            'expected' => [
                '責任感' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 4,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 5,
                'isUpright' => true,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 5,
                'isUpright' => false,
            ],
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 6,
                'isUpright' => true,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 6,
                'isUpright' => false,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 7,
                'isUpright' => true,
            ],
            'expected' => [
                '挑戦' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 7,
                'isUpright' => false,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 8,
                'isUpright' => true,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 8,
                'isUpright' => false,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 9,
                'isUpright' => true,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
                '直感' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 9,
                'isUpright' => false,
            ],
            'expected' => [
                '独立' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 10,
                'isUpright' => true,
            ],
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 10,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 11,
                'isUpright' => true,
            ],
            'expected' => [
                '責任感' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 11,
                'isUpright' => false,
            ],
            'expected' => [
                '独立' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 12,
                'isUpright' => true,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 12,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 13,
                'isUpright' => true,
            ],
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 13,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 14,
                'isUpright' => true,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 14,
                'isUpright' => false,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 15,
                'isUpright' => true,
            ],
            'expected' => [],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 15,
                'isUpright' => false,
            ],
            'expected' => [
                '独立' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 16,
                'isUpright' => true,
            ],
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 16,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 17,
                'isUpright' => true,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
                '直感' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 17,
                'isUpright' => false,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 18,
                'isUpright' => true,
            ],
            'expected' => [
                '直感' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 18,
                'isUpright' => false,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 19,
                'isUpright' => true,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
                '行動力' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 19,
                'isUpright' => false,
            ],
            'expected' => [
                '情熱' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 20,
                'isUpright' => true,
            ],
            'expected' => [
                '変化' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 20,
                'isUpright' => false,
            ],
            'expected' => [
                '慎重さ' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 21,
                'isUpright' => true,
            ],
            'expected' => [
                '安定性' => [
                    'score' => 2,
                    'type' => 'transient',
                ],
                '責任感' => [
                    'score' => 1,
                    'type' => 'transient',
                ],
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 21,
                'isUpright' => false,
            ],
            'expected' => [],
        ],
    ],
];
