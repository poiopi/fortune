<?php
declare(strict_types=1);
$quiz = require __DIR__ . '/../data.php';

$validChoices = ['a1', 'a2', 'a3', 'a4'];
$a = $_GET['a'] ?? null;
if (!in_array($a, $validChoices, true)) {
    header('Location: /quiz/' . $quiz['slug'] . '/', true, 302);
    exit;
}

$quizChoice = $a;
require __DIR__ . '/../../_quiz-kaisetsu-a.php';
