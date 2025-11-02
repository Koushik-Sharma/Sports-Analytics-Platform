<?php
include 'db_connect.php'; 
include 'navbar.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; }
        .container { width: 40%; margin: 60px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        input[type=text] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        a { text-decoration: none; display: inline-block; margin-top: 15px; color: #007bff; }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Quiz</h2>
    <form method="POST">
        <label>Quiz Title:</label>
        <input type="text" name="title" placeholder="Enter quiz title" required>
        <button type="submit" name="submit">Create Quiz</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $sql = "INSERT INTO quiz (title) VALUES ('$title')";
        if ($conn->query($sql)) {
            $quiz_id = $conn->insert_id;
            echo "<p style='color:green;'>Quiz created successfully!</p>";
            echo "<a href='add_question.php?quiz_id=$quiz_id'>Add Questions to this Quiz</a>";
        } else {
            echo "<p style='color:red;'>Error creating quiz: " . $conn->error . "</p>";
        }
    }
    ?>
</div>

</body>
</html>
