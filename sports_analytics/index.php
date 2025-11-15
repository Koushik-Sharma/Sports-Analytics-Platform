<?php
 include 'navbar.php'; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Football Analytics</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      color: #fff;
    }

    .container {
      width: 85%;
      max-width: 900px;
      margin: 120px auto;
      background: rgba(0, 0, 0, 0.75);
      padding: 60px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
      text-align: center;
    }

    h1 {
      font-size: 2.8em;
      margin-bottom: 20px;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 1px;
    }

    p {
      font-size: 1.2em;
      color: #ddd;
      margin: 10px 0;
      line-height: 1.6;
    }

    .btn {
      display: inline-block;
      margin-top: 25px;
      padding: 12px 24px;
      font-size: 1.1em;
      border: none;
      border-radius: 30px;
      background: linear-gradient(90deg, #00c853, #b2ff59);
      color: #000;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 40px 25px;
      }

      h1 {
        font-size: 2.2em;
      }

      p {
        font-size: 1.05em;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to the Football Quiz Portal</h1>
    <p>Manage players, create football quizzes, and test your knowledge!</p>
    <p>Use the navigation bar above to get started.</p>
    <a class="btn" href="take_quiz.php" style="text-decoration: none";>Start Quiz</a>
  </div>
</body>
</html>
