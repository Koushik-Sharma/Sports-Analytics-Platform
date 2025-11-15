<?php
 include 'db_connect.php'; 
 session_start();

if (!isset($_SESSION['user_id'])) {
  echo "<script>
      alert('Please log in to start the quiz.');
      window.location='login.php';
  </script>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Select Quiz</title>
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
      max-width: 600px;
      margin: 120px auto;
      background: rgba(0, 0, 0, 0.8);
      padding: 50px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    h2 {
      font-size: 2.2em;
      margin-bottom: 30px;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 1px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    label {
      font-size: 1.1em;
      margin-bottom: 10px;
      color: #ddd;
    }

    select {
      width: 100%;
      max-width: 400px;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 1em;
      background: #f1f1f1;
      color: #333;
      margin-bottom: 25px;
      transition: all 0.3s ease;
    }

    select:focus {
      outline: none;
      background: #fff;
      box-shadow: 0 0 8px #00c6ff;
    }

    button {
      padding: 12px 0;
      width: 100%;
      max-width: 400px;
      font-size: 1.1em;
      border: none;
      border-radius: 30px;
      background: linear-gradient(90deg, #00c853, #b2ff59);
      color: #000;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    button:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 35px 25px;
      }

      h2 {
        font-size: 1.9em;
      }

      select, button {
        width: 100%;
      }
    }
  </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
  <h2>Select a Quiz</h2>
  <form method="GET" action="quiz.php">
    <label for="quiz_id">Choose a Quiz:</label>
    <select name="quiz_id" required>
      <option value="">-- Select Quiz --</option>
      <?php
      $quiz_result = $conn->query("SELECT * FROM quiz");
      while ($q = $quiz_result->fetch_assoc()) {
        echo "<option value='{$q['quiz_id']}'>{$q['title']}</option>";
      }
      ?>
    </select>
    <button type="submit">Start Quiz</button>
  </form>
</div>
</body>
</html>
