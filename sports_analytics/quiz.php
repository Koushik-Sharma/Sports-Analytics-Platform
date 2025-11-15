<?php 
include 'db_connect.php';
session_start();

if (!isset($_GET['quiz_id'])) {
  die("<div style='text-align:center;margin-top:50px;'>⚠️ No quiz selected.</div>");
}

$quiz_id = intval($_GET['quiz_id']);
$quiz = $conn->query("SELECT title FROM quiz WHERE quiz_id=$quiz_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Take Quiz - <?php echo htmlspecialchars($quiz['title']); ?></title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      margin: 0;
      padding: 0;
      color: #333;
    }

    .container {
      max-width: 900px;
      background: rgba(255, 255, 255, 0.95);
      margin: 80px auto;
      padding: 50px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2.2em;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .question-block {
      background: #f9fbfc;
      padding: 25px 20px;
      border-radius: 12px;
      border-left: 5px solid #0072ff;
      margin-bottom: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .question-block h3 {
      font-size: 1.15em;
      color: #222;
      margin-bottom: 18px;
    }

    label {
      display: block;
      background: #eef1f5;
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      font-size: 1em;
    }

    input[type="radio"] {
      margin-right: 10px;
      accent-color: #0072ff;
      transform: scale(1.1);
      vertical-align: middle;
    }

    label:hover {
      background-color: #dbe9ff;
      transform: translateX(3px);
    }

    button[type="submit"] {
      display: block;
      width: 100%;
      max-width: 400px;
      margin: 30px auto 10px;
      border: none;
      padding: 14px 0;
      font-size: 1.1em;
      font-weight: 600;
      border-radius: 30px;
      background: linear-gradient(90deg, #00c853, #b2ff59);
      color: #000;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    button[type="submit"]:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .back-link {
      text-align: center;
      margin-top: 25px;
    }

    .back-link a {
      color: #0072ff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .back-link a:hover {
      color: #004bb5;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 35px 25px;
      }

      h2 {
        font-size: 1.8em;
      }

      .question-block h3 {
        font-size: 1em;
      }
    }
  </style>
</head>

<body>

<div class="container">
  <h2>Quiz: <?php echo htmlspecialchars($quiz['title']); ?></h2>

  <form method="POST" action="submit_quiz.php">
    <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">

    <?php
    $questions = $conn->query("SELECT * FROM question WHERE quiz_id=$quiz_id");
    $qno = 1;

    if ($questions->num_rows > 0) {
      while ($q = $questions->fetch_assoc()) {
        echo "<div class='question-block'>";
        echo "<h3>Q{$qno}: " . htmlspecialchars($q['question_text']) . "</h3>";

        $options = $conn->query("SELECT * FROM options WHERE question_id={$q['question_id']}");
        while ($o = $options->fetch_assoc()) {
          echo "<label><input type='radio' name='answer[{$q['question_id']}]' value='{$o['option_id']}'> " . htmlspecialchars($o['option_text']) . "</label>";
        }

        echo "</div>";
        $qno++;
      }
    } else {
      echo "<p style='text-align:center; color:#666;'>No questions available for this quiz.</p>";
    }
    ?>

    <button type="submit">Submit Quiz</button>
  </form>

  <div class="back-link">
    <a href="take_quiz.php">← Back to Quiz Selection</a>
  </div>
</div>

</body>
</html>
