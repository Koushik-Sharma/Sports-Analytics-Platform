<?php
include 'navbar.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Football Quiz</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
       body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #00416A, #E4E5E6);
  color: #333;
}
.dashboard-container {
  max-width: 1000px;
  margin: 60px auto 40px auto;
  text-align: center;
  background: rgba(255,255,255,0.97);
  padding: 50px 35px 40px 35px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
h2 {
  margin-bottom: 10px;
  font-size: 2.3em;
  letter-spacing: .5px;
  background: linear-gradient(90deg, #00c6ff, #0072ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.dashboard-container > p {
  color: #777;
  margin-bottom: 25px;
}

.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(245px, 1fr));
  gap: 25px;
  margin-top: 25px;
}

.card {
  background: linear-gradient(120deg, #f8fcff 65%, #e4f1ff 100%);
  padding: 30px 18px 24px 18px;
  border-radius: 15px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.07);
  transition: transform 0.2s cubic-bezier(.3,1.5,.6,1), box-shadow .2s;
  text-align: center;
  min-height: 200px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

.card:hover {
  transform: translateY(-7px) scale(1.04);
  box-shadow: 0 10px 26px rgba(0,0,0,0.18);
}

.card h3 {
  font-size: 1.2em;
  color: #094684;
  margin: 0 0 10px 0;
  letter-spacing: .3px;
}

.card p {
  margin: 0 0 20px;
  color: #636363;
  font-size: 1em;
  line-height: 1.5;
}

.card a {
  display: inline-block;
  background: linear-gradient(90deg, #00c853, #b2ff59);
  color: #222;
  padding: 9px 22px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  font-size: 1em;
  margin-top: 10px;
  transition: background .25s, color .25s;
}

.card a:hover {
  background: linear-gradient(90deg,#1db76a,#b2ff59);
  color: #094684;
}

@media (max-width: 768px) {
  .dashboard-container {
    padding: 25px 6px 25px 6px;
    width: 95%;
  }
  .dashboard-grid {
    grid-template-columns: 1fr;
    gap: 17px;
  }
  .card {
    min-height: 150px;
    padding: 18px 10px 15px 10px;
  }
  h2 {
    font-size: 1.5em;
  }
}

    </style>
</head>

<body>
<div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>
    <p style="color: gray;">Here’s your control panel. Choose an action below:</p>

    <div class="dashboard-grid">
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <div class="card">
                <h3>⚽ Manage Players</h3>
                <p>Add, edit, or remove players and stats.</p>
                <a href="players.php">Go to Players</a>
            </div>

            <div class="card">
                <h3>📝 Create Quiz</h3>
                <p>Build new quizzes for users to take.</p>
                <a href="add_quiz.php">Create Quiz</a>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>🎯 Take Quiz</h3>
            <p>Test your football knowledge!</p>
            <a href="take_quiz.php">Start Quiz</a>
        </div>

        <div class="card">
            <h3>📊 My Results</h3>
            <p>View your past quiz scores and stats.</p>
            <a href="view_results.php">View Results</a>
        </div>

        <div class="card">
            <h3>🚪 Logout</h3>
            <p>Sign out of your account safely.</p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>
</body>
</html>
