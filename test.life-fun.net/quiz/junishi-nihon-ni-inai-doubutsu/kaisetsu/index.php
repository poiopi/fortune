<?php
declare(strict_types=1);
$quiz = require __DIR__ . '/../data.php';

$validChoices = ['a1', 'a2', 'a3', 'a4'];
$rawA = $_GET['a'] ?? null;
$hasValidA = in_array($rawA, $validChoices, true);

if (!empty($quiz['explanation_indexable'])) {
    // 正規版（?aなし）はindex対象として許可。?aが付与されているが不正な値のときのみ①へリダイレクト
    if ($rawA !== null && !$hasValidA) {
        header('Location: /quiz/' . $quiz['slug'] . '/', true, 302);
        exit;
    }
    $quizChoice = $hasValidA ? $rawA : null;
} else {
    if (!$hasValidA) {
        header('Location: /quiz/' . $quiz['slug'] . '/', true, 302);
        exit;
    }
    $quizChoice = $rawA;
}

require __DIR__ . '/../../_quiz-kaisetsu-b.php';
