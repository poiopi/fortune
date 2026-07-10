<?php
// tests/cases/mbti-traits.php
// Trait Snapshot: inc/mbti-trait-mapping.php を16タイプ全件に適用した期待値。
// 生成元: tests/tools/export-mbti-traits.php
return [
    'generator' => 'inc/mbti-trait-mapping.php（独立再実装：export-mbti-traits.php）',
    'basedOn' => '16タイプ全件（tests/cases/mbti-golden.phpとは無関係。traitsは4文字タイプにのみ依存するため）',
    'generatedAt' => '2026-07-10T06:39:11+00:00',
    'caseCount' => 16,
    'cases' => [
        [
            'input' => [
                'type' => 'INTJ',
            ],
            'expected' => [
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
                '直感' => [
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
                'type' => 'INTP',
            ],
            'expected' => [
                '変化' => [
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
                'type' => 'ENTJ',
            ],
            'expected' => [
                '挑戦' => [
                    'score' => 2,
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
        [
            'input' => [
                'type' => 'ENTP',
            ],
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '挑戦' => [
                    'score' => 2,
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
                'type' => 'INFJ',
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
                '独立' => [
                    'score' => 1,
                    'type' => 'permanent',
                ],
                '直感' => [
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
                'type' => 'INFP',
            ],
            'expected' => [
                '変化' => [
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
                '直感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
        [
            'input' => [
                'type' => 'ENFJ',
            ],
            'expected' => [
                '情熱' => [
                    'score' => 2,
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
        [
            'input' => [
                'type' => 'ENFP',
            ],
            'expected' => [
                '変化' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '情熱' => [
                    'score' => 2,
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
                'type' => 'ISTJ',
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
                    'score' => 2,
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
                'type' => 'ISFJ',
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
        [
            'input' => [
                'type' => 'ESTJ',
            ],
            'expected' => [
                '安定性' => [
                    'score' => 2,
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
                'type' => 'ESFJ',
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
                'type' => 'ISTP',
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
                'type' => 'ISFP',
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
            ],
        ],
        [
            'input' => [
                'type' => 'ESTP',
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
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
        [
            'input' => [
                'type' => 'ESFP',
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
                '情熱' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
                '行動力' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
    ],
];
