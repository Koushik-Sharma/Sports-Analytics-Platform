<?php

include 'db_connect.php';
include 'navbar.php';



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$quiz_id = 1;

if (isset($_POST['submit_quiz'])) {
    $answers = $_POST['answer'];
    $score = 0;
    $total = count($answers);

    foreach ($answers as $qid => $ans) {
        $correct = $conn->query("SELECT correct_answer FROM question WHERE question_id = $qid")->fetch_assoc()['correct_answer'];
        $is_correct = ($ans == $correct) ? 1 : 0;
        if ($is_correct) $score++;

        $conn->query("INSERT INTO user_answers (result_id, question_id, selected_answer, is_correct)
                      VALUES (NULL, '$qid', '$ans', '$is_correct')");
    }

    $conn->query("INSERT INTO quiz_results (user_id, quiz_id, score, total_questions, correct_answers, wrong_answers)
                  VALUES ('$user_id', '$quiz_id', '$score', '$total', '$score', '".($total-$score)."')");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Your Score: <?php echo $score . "/" . $total; ?></h2>
<p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
