<?php
 include 'db_connect.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <h2>Select a Quiz</h2>
    <form method="GET" action="quiz.php">
        <label for="quiz_id">Choose a Quiz:</label>
        <select name="quiz_id" required>
            <option value="">-- Select Quiz --</option>
            <?php
            $quiz_result = $conn->query("SELECT * FROM quiz");
            while ($q = $quiz_result->fetch_assoc()) {
                echo "<option value='{$q['quiz_id']}'>{$q['title']}</option>";
            }
            ?>
        </select>
        <button type="submit">Start Quiz</button>
    </form>
</div>
</body>
</html>
