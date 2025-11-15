<?php
session_start();
include 'db_connect.php';

if (!isset($_POST['quiz_id'])) {
    die("Invalid quiz submission.");
}

$quiz_id = intval($_POST['quiz_id']);
$user_id = $_SESSION['user_id'];

$total_q_query = $conn->query("SELECT COUNT(*) AS total FROM question WHERE quiz_id = $quiz_id");
$total_questions = $total_q_query->fetch_assoc()['total'];

$answered_count = isset($_POST['answer']) ? count($_POST['answer']) : 0;

if ($answered_count < $total_questions) {
    echo "<script>
        alert('Please answer all questions before submitting!');
        window.history.back();
    </script>";
    exit;
}

$score = 0;
$correct_answers = 0;
$wrong_answers = 0;

foreach ($_POST['answer'] as $question_id => $selected_option_id) {
    $question_id = intval($question_id);
    $selected_option_id = intval($selected_option_id);

    $is_correct = 0;
    $check = $conn->query("SELECT is_correct FROM options WHERE option_id = $selected_option_id");
    if ($check && $check->num_rows > 0) {
        $is_correct = $check->fetch_assoc()['is_correct'];
    }

    if ($is_correct == 1) {
        $score++;
        $correct_answers++;
    } else {
        $wrong_answers++;
    }
}

$conn->query("INSERT INTO quiz_results (user_id, quiz_id, score, correct_answers, wrong_answers, total_questions)
              VALUES ($user_id, $quiz_id, $score, $correct_answers, $wrong_answers, $total_questions)");
$result_id = $conn->insert_id;

foreach ($_POST['answer'] as $question_id => $selected_option_id) {
    $question_id = intval($question_id);
    $selected_option_id = intval($selected_option_id);

    $is_correct = 0;
    $check = $conn->query("SELECT is_correct FROM options WHERE option_id = $selected_option_id");
    if ($check && $check->num_rows > 0) {
        $is_correct = $check->fetch_assoc()['is_correct'];
    }

    $conn->query("INSERT INTO user_answers (result_id, question_id, selected_answer, is_correct)
                  VALUES ($result_id, $question_id, $selected_option_id, $is_correct)");
}

echo "<script>
    alert('Quiz submitted successfully!');
    window.location='view_answers.php?result_id=$result_id';
</script>";
?>
