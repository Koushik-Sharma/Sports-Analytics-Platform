<?php

include 'db_connect.php';



// ---- Step 1: Get user and quiz info ----
$user_id =  $_SESSION['user_id']; // Replace this with $_SESSION['user_id'] when login is added
$quiz_id = $_POST['quiz_id'];
$answers = $_POST['answer'];

// ---- Step 2: Calculate results ----
$total_questions = count($answers);
$correct_answers = 0;
$wrong_answers = 0;

foreach ($answers as $question_id => $option_id) {
    $check = $conn->query("SELECT is_correct FROM options WHERE option_id = $option_id")->fetch_assoc();
    $is_correct = $check['is_correct'];

    if ($is_correct) $correct_answers++;
    else $wrong_answers++;
}

$score = $correct_answers;

// ---- Step 3: Insert into quiz_results ----
$conn->query("INSERT INTO quiz_results (user_id, quiz_id, score, total_questions, correct_answers, wrong_answers)
              VALUES ('$user_id', '$quiz_id', '$score', '$total_questions', '$correct_answers', '$wrong_answers')");

$result_id = $conn->insert_id;

// ---- Step 4: Insert each answer into user_answers ----
foreach ($answers as $question_id => $option_id) {
    $check = $conn->query("SELECT is_correct FROM options WHERE option_id = $option_id")->fetch_assoc();
    $is_correct = $check['is_correct'];

    $conn->query("INSERT INTO user_answers (result_id, question_id, selected_answer, is_correct)
                  VALUES ('$result_id', '$question_id', '$option_id', '$is_correct')");
}

// ---- Step 5: Redirect or show message ----
echo "<script>
    alert('Quiz submitted successfully! You scored $correct_answers out of $total_questions.');
    window.location='view_results.php';
</script>";
?>
