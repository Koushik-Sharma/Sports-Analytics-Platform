<?php include 'db_connect.php'; ?>
<?php
if (!isset($_GET['quiz_id'])) {
    die("No quiz selected.");
}
$quiz_id = $_GET['quiz_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <h2>
        <?php
        $quiz = $conn->query("SELECT title FROM quiz WHERE quiz_id=$quiz_id")->fetch_assoc();
        echo "Quiz: " . $quiz['title'];
        ?>
    </h2>

    <form method="POST" action="submit_quiz.php">
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">

        <?php
        $questions = $conn->query("SELECT * FROM question WHERE quiz_id=$quiz_id");
        $qno = 1;
        while ($q = $questions->fetch_assoc()) {
            echo "<div class='question-block'>";
            echo "<h3>Q{$qno}: {$q['question_text']}</h3>";

            $options = $conn->query("SELECT * FROM options WHERE question_id={$q['question_id']}");
            while ($o = $options->fetch_assoc()) {
                echo "<label><input type='radio' name='answer[{$q['question_id']}]' value='{$o['option_id']}'> {$o['option_text']}</label><br>";
            }

            echo "</div><br>";
            $qno++;
        }
        ?>
        <button type="submit">Submit Quiz</button>
    </form>
</div>
</body>
</html>
