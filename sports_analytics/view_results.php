<?php 

include 'db_connect.php';

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Quiz Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <h2>My Quiz Results</h2>

    <?php
    session_start();
    $user_id = $_SESSION['user_id']; 
    
    $sql = "SELECT r.*, q.title 
            FROM quiz_results r
            JOIN quiz q ON r.quiz_id = q.quiz_id
            WHERE r.user_id = '$user_id'
            ORDER BY r.result_id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Quiz Title</th>
                    <th>Score</th>
                    <th>Correct</th>
                    <th>Wrong</th>
                    <th>Total</th>
                    <th>View Answers</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['score']}</td>
                    <td>{$row['correct_answers']}</td>
                    <td>{$row['wrong_answers']}</td>
                    <td>{$row['total_questions']}</td>
                    <td><a href='view_answers.php?result_id={$row['result_id']}'>View</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No quiz results found.</p>";
    }
    ?>
</div>
</body>
</html>
