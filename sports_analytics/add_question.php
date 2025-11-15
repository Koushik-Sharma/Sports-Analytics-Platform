<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_id = $_POST['quiz_id'];
    $question_text = $_POST['question_text'];
    $options = $_POST['options'];
    $correct_option = $_POST['correct_option'];

   
    $insert_question = "INSERT INTO question (quiz_id, question_text) VALUES ('$quiz_id', '$question_text')";
    if ($conn->query($insert_question) === TRUE) {
        $question_id = $conn->insert_id; 

        foreach ($options as $index => $option_text) {
            $is_correct = ($index == $correct_option) ? 1 : 0;
            $insert_option = "INSERT INTO options (question_id, option_text, is_correct)
                              VALUES ('$question_id', '$option_text', '$is_correct')";
            $conn->query($insert_option);
        }

        echo "<script>alert('Question and options added successfully!'); window.location='add_question.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Add Question</h2>
    <form method="POST">
        <label>Quiz ID:</label>
        <input type="number" name="quiz_id" required><br>

        <label>Question Text:</label>
        <input type="text" name="question_text" required><br>

        <label>Options:</label><br>
        <input type="text" name="options[]" placeholder="Option A" required><br>
        <input type="text" name="options[]" placeholder="Option B" required><br>
        <input type="text" name="options[]" placeholder="Option C" required><br>
        <input type="text" name="options[]" placeholder="Option D" required><br>

        <label>Correct Option (0=A, 1=B, 2=C, 3=D):</label>
        <input type="number" name="correct_option" min="0" max="3" required><br>

        <button type="submit">Add Question</button>
    </form>
</div>
</body>
</html>
