
<?php
include 'db_connect.php'; 
include 'navbar.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("<div style='text-align:center; color:red; margin-top:50px;'>Access denied. Admins only.</div>");
}

if (isset($_POST['submit'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $sql = "INSERT INTO quiz (title) VALUES ('$title')";
    if ($conn->query($sql)) {
        $quiz_id = $conn->insert_id;
        echo "<script>alert('Quiz created successfully!'); window.location='add_quiz.php';</script>";
    } else {
        echo "<script>alert('Error creating quiz: " . $conn->error . "');</script>";
    }
}

if (isset($_GET['delete_quiz'])) {
    $quiz_id = intval($_GET['delete_quiz']);

    $conn->query("DELETE FROM user_answers WHERE question_id IN (SELECT question_id FROM question WHERE quiz_id = $quiz_id)");
    $conn->query("DELETE FROM quiz_results WHERE quiz_id = $quiz_id");
    $conn->query("DELETE FROM options WHERE question_id IN (SELECT question_id FROM question WHERE quiz_id = $quiz_id)");
    $conn->query("DELETE FROM question WHERE quiz_id = $quiz_id");
    $conn->query("DELETE FROM quiz WHERE quiz_id = $quiz_id");

    echo "<script>alert('Quiz deleted successfully!'); window.location='add_quiz.php';</script>";
}


if (isset($_POST['update_quiz'])) {
    $quiz_id = intval($_POST['quiz_id']);
    $new_title = $conn->real_escape_string($_POST['new_title']);
    $conn->query("UPDATE quiz SET title='$new_title' WHERE quiz_id=$quiz_id");
    echo "<script>alert('Quiz title updated!'); window.location='add_quiz.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz</title>
    <style>
        body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #00416A, #E4E5E6);
  margin: 0;
  padding: 0;
  color: #333;
}
.container {
  width: 90%;
  max-width: 650px;
  background: rgba(255,255,255,0.98);
  margin: 80px auto 40px auto;
  padding: 45px 35px 35px 35px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.18);
}
h2 {
  text-align: center;
  font-size: 2em;
  margin-bottom: 20px;
  background: linear-gradient(90deg, #00c6ff, #0072ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
form {
  margin-bottom: 30px;
}
label {
  color: #0a2784;
  font-weight: 500;
  display:block;
  margin-bottom: 8px;
}
input[type=text] {
  width: 100%;
  padding: 13px;
  margin: 9px 0 18px 0;
  border: 1.5px solid #c5d8ee;
  border-radius: 9px;
  font-size: 1em;
  background:#f5f6fa;
  transition: border-color 0.2s;
}
input[type=text]:focus {
  border-color: #0072ff;
  outline: none;
  background: #fff;
}
button, .btn {
  padding: 10px 24px;
  background: linear-gradient(90deg, #00c853, #b2ff59);
  color: #222;
  font-weight: 600;
  border: none;
  border-radius: 8px;
  font-size: 1em;
  cursor: pointer;
  margin-right: 3px;
  transition: background 0.24s, color 0.24s;
  text-decoration: none;
  display: inline-block;
}
button[type=submit] {
  margin-top: 8px;
}
button:hover, .btn:hover {
  background: linear-gradient(90deg,#1db76a,#b2ff59);
  color: #094684;
}
.add-btn {
  background: linear-gradient(90deg, #17a2b8, #7defff);
  color: #fff;
}
.add-btn:hover {
  background: linear-gradient(90deg,#28d4e0,#139aa6);
}
.edit-btn {
  background: linear-gradient(90deg, #ffc107, #ffd877);
  color: #444;
}
.edit-btn:hover {
  background: linear-gradient(90deg, #e0a800, #fff8b0);
}
.delete-btn {
  background: linear-gradient(90deg, #dc3545, #ff8e96);
  color: #fff;
}
.delete-btn:hover {
  background: linear-gradient(90deg, #b02a37, #ffb1b9);
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 18px;
  background: #f9fbfc;
  border-radius: 9px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.07);
  overflow: hidden;
}
th, td {
  padding: 13px;
  text-align: center;
  border: 1px solid #cfd8dc;
}
th {
  background: linear-gradient(90deg, #0072ff, #00c6ff);
  color: #fff;
  font-weight: 600;
  border: none;
}
tr:nth-child(even) { background: #f4faff;}
tr:nth-child(odd) { background: #ffffff;}
hr {
  border: none;
  border-top: 1.5px solid #c2d3e5;
  margin: 28px 0 15px;
}
@media (max-width: 700px) {
  .container {
    width: 97%;
    padding: 25px 10px;
  }
  table, th, td {
    font-size: 0.95em;
    padding: 8px;
  }
  h2 {
    font-size: 1.4em;
  }
}

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

    <hr>

    <h2>Existing Quizzes</h2>

   <?php
$result = $conn->query("SELECT * FROM quiz ORDER BY quiz_id DESC");
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Title</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['quiz_id']}</td>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>

            <a href='edit_quiz.php?id={$row['quiz_id']}' class='btn add-btn' style='background:#17a2b8;'>Edit Questions</a>

            <a href='add_quiz.php?delete_quiz={$row['quiz_id']}' class='btn delete-btn' onclick=\"return confirm('Delete this quiz and its questions?');\">Delete</a>
            </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No quizzes created yet.</p>";
}
?>

</div>

<div id="edit" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
    <div style="background:#fff; width:400px; margin:100px auto; padding:20px; border-radius:10px; text-align:center;">
        <h3>Edit Quiz Title</h3>
        <form method="POST">
            <input type="hidden" name="quiz_id" id="edit_quiz_id">
            <input type="text" name="new_title" id="edit_title" required>
            <br><br>
            <button type="submit" name="update_quiz" style="background:#28a745;">Save</button>
            <button type="button" onclick="closeEditForm()" style="background:#6c757d;">Cancel</button>
        </form>
    </div>
</div>

<script>
function closeEditForm() {
    document.getElementById("edit").style.display = "none";
}
</script>

</body>
</html>

