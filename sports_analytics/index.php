<?php
 include 'navbar.php'; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Football Quiz Home</title>
  <style>
    body { font-family: Arial; background: #f0f0f0; }
    .container { width: 80%; margin: 80px auto; text-align: center; background: white; padding: 50px; border-radius: 12px; box-shadow: 0 3px 8px rgba(0,0,0,0.1); }
    h1 { color: #007bff; }
    p { font-size: 18px; color: #444; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to Football Quiz</h1>
    <p>Test your knowledge of football with our quizzes.</p>
    <button class="button" onclick="location.href='add_quiz.php'">Take Quiz</button>
</div>
</body>
</html>
