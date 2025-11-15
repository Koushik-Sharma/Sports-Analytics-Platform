<?php
include 'db_connect.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quiz Answers</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      color: #333;
    }

    .container {
      width: 85%;
      max-width: 950px;
      margin: 80px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 50px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    h2, h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    h2 {
      font-size: 2.2em;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 15px;
    }

    h3 {
      font-size: 1.3em;
      color: #0072ff;
      margin-bottom: 30px;
    }

    .question-block {
      background: #f9fbfc;
      border-left: 6px solid #00c6ff;
      border-radius: 10px;
      padding: 20px 25px;
      margin-bottom: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .question-block h4 {
      font-size: 1.1em;
      color: #222;
      margin-bottom: 12px;
    }

    .option {
      padding: 10px 15px;
      margin: 6px 0;
      border-radius: 8px;
      font-size: 0.98em;
      letter-spacing: 0.2px;
      transition: all 0.25s ease;
    }

    .correct {
      background-color: #d4edda;
      color: #155724;
      border-left: 5px solid #28a745;
    }

    .wrong {
      background-color: #f8d7da;
      color: #721c24;
      border-left: 5px solid #dc3545;
    }

    .neutral {
      background-color: #f8f9fa;
      color: #333;
      border-left: 5px solid #ccc;
    }

    .option:hover {
      transform: translateX(4px);
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    hr {
      border: none;
      border-top: 1px solid #ddd;
      margin: 20px 0;
    }

    .summary {
      text-align: center;
      margin-top: 30px;
    }

    .summary a {
      color: #0072ff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .summary a:hover {
      color: #004bb5;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        width: 92%;
        padding: 35px 25px;
      }

      .question-block {
        padding: 18px 20px;
      }

      h2 {
        font-size: 1.9em;
      }

      h4 {
        font-size: 1em;
      }
    }
  </style>
</head>
<body>

<div class="container">
<?php
if (!isset($_GET['result_id'])) {
  die("<p>Invalid result ID.</p>");
}

$result_id = intval($_GET['result_id']);

$quiz_info_sql = "
  SELECT q.title, qr.score, qr.total_questions 
  FROM quiz_results qr
  JOIN quiz q ON qr.quiz_id = q.quiz_id
  WHERE qr.result_id = $result_id
";
$quiz_info = $conn->query($quiz_info_sql)->fetch_assoc();

if ($quiz_info) {
  echo "<h2>Quiz: " . htmlspecialchars($quiz_info['title']) . "</h2>";
  echo "<h3>Your Score: {$quiz_info['score']} / {$quiz_info['total_questions']}</h3><hr>";
} else {
  echo "<p>Quiz information not found.</p>";
  exit;
}

$answers_sql = "
  SELECT 
    q.question_id,
    q.question_text,
    ua.selected_answer,
    ua.is_correct
  FROM user_answers ua
  JOIN question q ON ua.question_id = q.question_id
  WHERE ua.result_id = $result_id
";

$answers = $conn->query($answers_sql);

if ($answers && $answers->num_rows > 0) {
  $qno = 1;
  while ($a = $answers->fetch_assoc()) {
    echo "<div class='question-block'>";
    echo "<h4>Q{$qno}: " . htmlspecialchars($a['question_text']) . "</h4>";

    $question_id = $a['question_id'];
    $selected_option = $a['selected_answer'];

    $options_sql = "SELECT * FROM options WHERE question_id = $question_id";
    $options_res = $conn->query($options_sql);

    if ($options_res && $options_res->num_rows > 0) {
      while ($opt = $options_res->fetch_assoc()) {
        $class = "neutral";

        if ($opt['option_id'] == $selected_option && $opt['is_correct'] == 1) {
          $class = "correct";
        } elseif ($opt['option_id'] == $selected_option && $opt['is_correct'] == 0) {
          $class = "wrong";
        } elseif ($opt['is_correct'] == 1) {
          $class = "correct";
        }

        echo "<div class='option $class'>" . htmlspecialchars($opt['option_text']) . "</div>";
      }
    }

    echo "</div><hr>";
    $qno++;
  }
} else {
  echo "<p>No answers found for this result.</p>";
}
?>
  <div class="summary">
    <a href="take_quiz.php">← Back to Quizzes</a>
  </div>
</div>

</body>
</html>
