<?php

include 'db_connect.php'; 

?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Answers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
<?php
if (!isset($_GET['result_id'])) {
    die("Invalid result ID.");
}
$result_id = $_GET['result_id'];

$sql = "SELECT ua.question_id, ua.selected_answer, ua.is_correct, 
               q.question_text, o.option_text AS user_option,
               (SELECT option_text FROM options WHERE question_id = q.question_id AND is_correct = 1) AS correct_option
        FROM user_answers ua
        JOIN question q ON ua.question_id = q.question_id
        JOIN options o ON ua.selected_answer = o.option_id
        WHERE ua.result_id = $result_id";

$res = $conn->query($sql);

if ($res->num_rows > 0) {
    echo "<h2>Quiz Answers</h2>";
    while ($row = $res->fetch_assoc()) {
        $color = $row['is_correct'] ? "green" : "red";
        echo "<div class='question-block'>";
        echo "<h4>{$row['question_text']}</h4>";
        echo "<p><b>Your Answer:</b> <span style='color:$color'>{$row['user_option']}</span></p>";
        echo "<p><b>Correct Answer:</b> {$row['correct_option']}</p>";
        echo "</div><hr>";
    }
} else {
    echo "<p>No answers found for this result.</p>";
}
?>
</div>
</body>
</html>
