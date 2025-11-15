<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access denied. Admins only.");
}

if (!isset($_GET['id'])) {
    die("No quiz selected.");
}
$quiz_id = intval($_GET['id']);
$quiz = $conn->query("SELECT * FROM quiz WHERE quiz_id = $quiz_id")->fetch_assoc();

if (!$quiz) {
    die("Quiz not found.");
}

if (isset($_POST['update_quiz'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $conn->query("UPDATE quiz SET title='$title' WHERE quiz_id=$quiz_id");
    echo "<script>alert('Quiz title updated successfully!'); window.location='edit_quiz.php?id=$quiz_id';</script>";
}

if (isset($_GET['delete_qid'])) {
    $qid = intval($_GET['delete_qid']);
    $conn->query("DELETE FROM options WHERE question_id=$qid");
    $conn->query("DELETE FROM question WHERE question_id=$qid");
    echo "<script>alert('Question deleted successfully!'); window.location='edit_quiz.php?id=$quiz_id';</script>";
}

if (isset($_POST['add_question'])) {
    $question_text = $conn->real_escape_string($_POST['question_text']);
    $conn->query("INSERT INTO question (quiz_id, question_text) VALUES ($quiz_id, '$question_text')");
    $question_id = $conn->insert_id;

    foreach ($_POST['options'] as $index => $opt_text) {
        $opt_text = $conn->real_escape_string($opt_text);
        $is_correct = ($_POST['correct_option'] == $index) ? 1 : 0;
        $conn->query("INSERT INTO options (question_id, option_text, is_correct) VALUES ($question_id, '$opt_text', $is_correct)");
    }

    echo "<script>alert('Question added successfully!'); window.location='edit_quiz.php?id=$quiz_id';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Quiz</title>
  <style>
    body {
      font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      margin: 0;
      padding: 0;
      color: #333;
    }
    .container {
      max-width: 1000px;
      margin: 60px auto;
      background: rgba(255, 255, 255, 0.98);
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    h2, h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #0072ff;
      background: #fff;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 1.8em;
      font-weight: 600;
    }
    label {
      font-weight: 500;
      color: #0a2784;
      display: block;
      margin-bottom: 8px;
      font-size: 1.1em;
    }
    .form-control {
      width: 100%;
      padding: 14px;
      margin: 10px 0;
      border: 1.5px solid #c5d8ee;
      border-radius: 8px;
      font-size: 1.1em;
      background: #f5f6fa;
      transition: border-color 0.2s;
      line-height: 1.5;
    }
    .form-control:focus {
      border-color: #0072ff;
      outline: none;
      background: #fff;
    }
    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1.1em;
      cursor: pointer;
      margin-right: 5px;
      transition: background 0.24s, color 0.24s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-success {
      background: linear-gradient(90deg, #00c853, #b2ff59);
      color: #222;
    }
    .btn-success:hover {
      background: linear-gradient(90deg, #1db76a, #b2ff59);
      color: #094684;
    }
    .btn-warning {
      background: linear-gradient(90deg, #ffc107, #ffd877);
      color: #444;
    }
    .btn-warning:hover {
      background: linear-gradient(90deg, #e0a800, #fff8b0);
    }
    .btn-danger {
      background: linear-gradient(90deg, #dc3545, #ff8e96);
      color: #fff;
    }
    .btn-danger:hover {
      background: linear-gradient(90deg, #b02a37, #ffb1b9);
    }
    .btn-secondary {
      background: linear-gradient(90deg, #6c757d, #a0a8b0);
      color: #fff;
    }
    .btn-secondary:hover {
      background: linear-gradient(90deg, #545b62, #868e96);
    }
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #f9fbfc;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.07);
    }
    .table th, .table td {
      padding: 14px;
      text-align: center;
      border: 1px solid #cfd8dc;
      font-size: 1.05em;
      line-height: 1.5;
    }
    .table th {
      background: #0072ff;
      color: #fff;
      font-weight: 600;
      border: none;
    }
    .table tbody tr:nth-child(even) {
      background: #f4faff;
    }
    .table tbody tr:nth-child(odd) {
      background: #ffffff;
    }
    hr {
      border: none;
      border-top: 1.5px solid #c2d3e5;
      margin: 25px 0;
    }
    textarea.form-control {
      min-height: 100px;
      resize: vertical;
      font-size: 1.1em;
      line-height: 1.5;
    }
    .btn-sm {
      padding: 6px 12px;
      font-size: 0.875em;
      margin: 0 2px;
    }
    @media (max-width: 768px) {
      .container {
        width: 95%;
        padding: 25px 10px;
      }
      .table th, .table td {
        font-size: 0.95em;
        padding: 8px;
      }
      h2, h3 {
        font-size: 1.4em;
      }
    }
  </style>
</head>
<body class="p-4">
<div class="container">
  <h2>Edit Quiz: <?php echo htmlspecialchars($quiz['title']); ?></h2>

  <form method="POST" class="mb-4">
    <div class="mb-3">
      <label>Quiz Title:</label>
      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($quiz['title']); ?>" required>
    </div>
    <button type="submit" name="update_quiz" class="btn btn-success">Update Quiz</button>
    <a href="add_quiz.php" class="btn btn-secondary">Back</a>
  </form>

  <hr>

  <h3>Questions</h3>
  <?php
  $q_result = $conn->query("SELECT * FROM question WHERE quiz_id=$quiz_id");
  if ($q_result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>ID</th><th>Question</th><th>Options</th><th>Action</th></tr></thead><tbody>";

    while ($q = $q_result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>{$q['question_id']}</td>";
      echo "<td>" . htmlspecialchars($q['question_text']) . "</td>";

      $opt_result = $conn->query("SELECT * FROM options WHERE question_id={$q['question_id']}");
      echo "<td>";
      while ($o = $opt_result->fetch_assoc()) {
        $mark = $o['is_correct'] ? "<b>(Correct)</b>" : "";
        echo htmlspecialchars($o['option_text']) . " $mark<br>";
      }
      echo "</td>";

      echo "<td>
              <a href='edit_question.php?id={$q['question_id']}&quiz_id=$quiz_id' class='btn btn-warning btn-sm'>Edit</a>
              <a href='edit_quiz.php?id=$quiz_id&delete_qid={$q['question_id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Delete this question?');\">Delete</a>
            </td>";
      echo "</tr>";
    }

    echo "</tbody></table>";
  } else {
    echo "<p>No questions added yet.</p>";
  }
  ?>

  <hr>

  <h3>Add New Question</h3>
  <form method="POST">
    <div class="mb-3">
      <label>Question Text:</label>
      <textarea name="question_text" class="form-control" required></textarea>
    </div>

    <?php for ($i = 1; $i <= 4; $i++): ?>
      <div class="mb-3">
        <label>Option <?php echo $i; ?>:</label>
        <input type="text" name="options[<?php echo $i; ?>]" class="form-control" required>
      </div>
    <?php endfor; ?>

    <div class="mb-3">
      <label>Correct Option (1-4):</label>
      <input type="number" name="correct_option" min="1" max="4" class="form-control" required>
    </div>

    <button type="submit" name="add_question" class="btn btn-primary">Add Question</button>
  </form>
</div>
</body>
</html>
