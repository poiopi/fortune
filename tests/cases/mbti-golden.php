<?php
// tests/cases/mbti-golden.php
// Golden Master: 10問の回答パターン2^10=1024ケース全件（サンプリングではなく全数）。
// test.life-fun.net/mbti.php の calcMbti() スコアリング・タイブレーク規則から直接算出。
// 生成元: tests/tools/export-mbti-golden.js（再実行すれば作り直せる）
return [
    'generator' => 'test.life-fun.net/mbti.php (calcMbti())',
    'generatorVersion' => '2026-07-10',
    'generatedAt' => '2026-07-10T06:18:41.815Z',
    'caseCount' => 1024,
    'cases' => [
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ESFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ISFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'ENFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFJ',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INTP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    0,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
        [
            'input' => [
                'answers' => [
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                    1,
                ],
            ],
            'expected' => [
                'mbtiType' => 'INFP',
            ],
        ],
    ],
];
