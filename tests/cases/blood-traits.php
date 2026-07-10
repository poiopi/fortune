<?php
// tests/cases/blood-traits.php
// Trait Snapshot: inc/blood-trait-mapping.php を4型全件に適用した期待値。
// 生成元: tests/tools/export-blood-traits.php
return [
    'generator' => 'inc/blood-trait-mapping.php（独立再実装：export-blood-traits.php）',
    'basedOn' => '4型全件（A/B/O/AB）',
    'generatedAt' => '2026-07-10T07:50:32+00:00',
    'caseCount' => 4,
    'cases' => [
        [
            'input' => [
                'type' => 'A',
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
                '責任感' => [
                    'score' => 2,
                    'type' => 'permanent',
                ],
            ],
        ],
        [
            'input' => [
                'type' => 'B',
            ],
            'expected' => [
                '変化' => [
                    'score' => 2,
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
                'type' => 'O',
            ],
            'expected' => [
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
        [
            'input' => [
                'type' => 'AB',
            ],
            'expected' => [
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
    ],
];
