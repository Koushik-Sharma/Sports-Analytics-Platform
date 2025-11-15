<?php

include 'db_connect.php';


$user_id = $_SESSION['user_id'] ?? 1;
$quiz_id = $_POST['quiz_id'];

$answers = $_POST['answer'] ?? [];

$total_questions = count($answers);
$correct = 0;
$wrong = 0;

$conn->query("INSERT INTO quiz_results (user_id, quiz_id, score, total_questions, correct_answers, wrong_answers)
              VALUES ('$user_id', '$quiz_id', 0, '$total_questions', 0, 0)");
$result_id = $conn->insert_id;

foreach ($answers as $question_id => $selected) {
    $query = $conn->query("SELECT correct_answer FROM question WHERE question_id='$question_id'");
    $correct_answer = $query->fetch_assoc()['correct_answer'];

    $is_correct = ($selected == $correct_answer) ? 1 : 0;
    if ($is_correct) $correct++; else $wrong++;

    $conn->query("INSERT INTO user_answers (result_id, question_id, selected_answer, is_correct)
                  VALUES ('$result_id', '$question_id', '$selected', '$is_correct')");
}

$score = ($correct / $total_questions) * 100;
$conn->query("UPDATE quiz_results 
              SET score='$score', correct_answers='$correct', wrong_answers='$wrong' 
              WHERE result_id='$result_id'");

echo "<div style='font-family:Arial; background:#f7f7f7; padding:30px; text-align:center;'>
        <h2>Quiz Completed!</h2>
        <p><b>Total Questions:</b> $total_questions</p>
        <p><b>Correct Answers:</b> $correct</p>
        <p><b>Wrong Answers:</b> $wrong</p>
        <p><b>Score:</b> $score%</p>
        <a href='add_quiz.php'>← Back to Quizzes</a>
      </div>";
?>
