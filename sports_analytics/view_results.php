<?php 
include 'db_connect.php';
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Quiz Results</title>
  <link rel="stylesheet" href="style.css">
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
    h2 {
      text-align: center;
      font-size: 2.2em;
      margin-bottom: 25px;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 35px;
      font-size: 1.08em;
      background: #f9fbfc;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.07);
    }
    th, td {
      padding: 12px;
      text-align: center;
      border: 1px solid #e6e6e6;
    }
    th {
      background: linear-gradient(90deg, #0072ff, #00c6ff);
      color: #fff;
      font-weight: 600;
      letter-spacing: 0.5px;
      border: none;
    }
    tr:nth-child(even) {
      background: #f4f6ff;
    }
    tr:nth-child(odd) {
      background: #ffffff;
    }
    a {
      color: #0072ff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    a:hover {
      color: #004bb5;
      text-decoration: underline;
    }
    .summary-box {
      background: #e9ecef;
      padding: 18px 22px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
      font-size: 1.08em;
      margin-bottom: 20px;
      text-align: center;
    }
    .summary-box h3 {
      margin-top: 0;
      margin-bottom: 14px;
      color: #0072ff;
      font-size: 1.17em;
    }
    @media (max-width: 768px) {
      .container {
        width: 92%;
        padding: 35px 15px;
      }
      th, td {
        font-size: 0.97em;
        padding: 9px;
      }
      h2 {
        font-size: 1.7em;
      }
    }
  </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
  <h2>My Quiz Results</h2>

  <?php
  if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to view your quiz results.</p>";
    exit;
  }

  $user_id = $_SESSION['user_id']; 

  $sql = "SELECT r.*, q.title 
          FROM quiz_results r
          JOIN quiz q ON r.quiz_id = q.quiz_id
          WHERE r.user_id = '$user_id'
          ORDER BY r.result_id DESC";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
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
              <td>".htmlspecialchars($row['title'])."</td>
              <td>".$row['score']."</td>
              <td>".$row['correct_answers']."</td>
              <td>".$row['wrong_answers']."</td>
              <td>".$row['total_questions']."</td>
              <td><a href='view_answers.php?result_id={$row['result_id']}'>View</a></td>
            </tr>";
    }
    echo "</table>";

    $agg_sql = "SELECT 
                  COUNT(*) AS total_attempts,
                  AVG(score) AS avg_score,
                  MAX(score) AS highest_score,
                  MIN(score) AS lowest_score
                FROM quiz_results
                WHERE user_id = '$user_id'";
    $agg_result = $conn->query($agg_sql);
    $agg = $agg_result->fetch_assoc();

    echo "<div class='summary-box'>";
    echo "<h3>📊 Performance Summary</h3>";
    echo "<p><strong>Total Quizzes Attempted:</strong> " . $agg['total_attempts'] . "</p>";
    echo "<p><strong>Average Score:</strong> " . round($agg['avg_score'], 2) . "</p>";
    echo "<p><strong>Highest Score:</strong> " . $agg['highest_score'] . "</p>";
    echo "<p><strong>Lowest Score:</strong> " . $agg['lowest_score'] . "</p>";
    echo "</div>";

  } else {
    echo "<p>No quiz results found.</p>";
  }
  ?>
</div>
</body>
</html>
