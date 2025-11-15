<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access denied.");
}

$question_id = intval($_GET['id']);
$quiz_id = intval($_GET['quiz_id']);

$q = $conn->query("SELECT * FROM question WHERE question_id=$question_id")->fetch_assoc();
$opts = $conn->query("SELECT * FROM options WHERE question_id=$question_id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = $conn->real_escape_string($_POST['question_text']);
    $conn->query("UPDATE question SET question_text='$text' WHERE question_id=$question_id");

    foreach ($_POST['options'] as $opt_id => $opt_text) {
        $opt_text = $conn->real_escape_string($opt_text);
        $is_correct = (isset($_POST['correct_option']) && $_POST['correct_option'] == $opt_id) ? 1 : 0;
        $conn->query("UPDATE options SET option_text='$opt_text', is_correct=$is_correct WHERE option_id=$opt_id");
    }

    echo "<script>alert('Question updated successfully!'); window.location='edit_quiz.php?id=$quiz_id';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Question</title>
  <style>
    body {
      font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      margin: 0;
      padding: 0;
      color: #333;
    }
    .container {
      max-width: 700px;
      margin: 60px auto;
      background: rgba(255, 255, 255, 0.98);
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    h2 {
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
    .form-check {
      margin-top: 10px;
    }
    .form-check-input {
      margin-right: 8px;
    }
    .form-check-label {
      font-size: 1.05em;
      color: #0a2784;
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
    @media (max-width: 768px) {
      .container {
        width: 95%;
        padding: 25px 10px;
      }
      h2 {
        font-size: 1.4em;
      }
    }
  </style>
</head>
<body class="p-4">
<div class="container">
  <h2>Edit Question</h2>

  <form method="POST">
    <div class="mb-3">
      <label>Question Text:</label>
      <textarea name="question_text" class="form-control" required><?php echo htmlspecialchars($q['question_text']); ?></textarea>
    </div>

    <?php while ($o = $opts->fetch_assoc()): ?>
      <div class="mb-3">
        <label>Option:</label>
        <input type="text" name="options[<?php echo $o['option_id']; ?>]" value="<?php echo htmlspecialchars($o['option_text']); ?>" class="form-control" required>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="correct_option" value="<?php echo $o['option_id']; ?>" <?php if ($o['is_correct']) echo 'checked'; ?>>
          <label class="form-check-label">Mark as Correct</label>
        </div>
      </div>
    <?php endwhile; ?>

    <button type="submit" class="btn btn-success">Update Question</button>
  </form>
</div>
</body>
</html>
