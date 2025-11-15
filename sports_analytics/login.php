<?php
include 'db_connect.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Football Quiz</title>
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
      max-width: 400px;
      margin: 120px auto;
      background: rgba(0, 0, 0, 0.8);
      padding: 50px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
      text-align: center;
    }

    h2 {
      font-size: 2em;
      margin-bottom: 25px;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background-color: #f1f1f1;
      font-size: 1em;
      color: #333;
      transition: all 0.3s ease;
    }

    input:focus {
      background-color: #fff;
      box-shadow: 0 0 8px #00c6ff;
      outline: none;
    }

    button {
      margin-top: 20px;
      padding: 12px 0;
      width: 100%;
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

    p {
      margin-top: 20px;
      color: #ddd;
      font-size: 1em;
    }

    a {
      color: #00c6ff;
      text-decoration: none;
      font-weight: 500;
    }

    a:hover {
      text-decoration: underline;
    }

    .error {
      color: #ff5252;
      margin-top: 15px;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 35px 25px;
      }

      h2 {
        font-size: 1.8em;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>

    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
    </form>

    <p>Don’t have an account? <a href="register.php">Register</a></p>

    <?php
    if (isset($_POST['login'])) {
      $u = $_POST['username'];
      $p = $_POST['password'];

      $sql = "SELECT * FROM users WHERE username='$u'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          if (password_verify($p, $row['password'])) {
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['username'] = $row['username'];
              $_SESSION['role'] = $row['role'];
              header("Location: index.php");
          } else {
              echo "<p class='error'>Invalid password!</p>";
          }
      } else {
          echo "<p class='error'>User not found!</p>";
      }
    }
    ?>
  </div>
</body>
</html>
