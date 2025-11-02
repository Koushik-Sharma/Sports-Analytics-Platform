<!-- navbar.php -->

<style>
/* 🌟 Basic Navigation Bar Style */
nav {
  background: #007bff;
  padding: 12px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

nav .logo {
  color: white;
  font-size: 20px;
  font-weight: bold;
  text-decoration: none;
}

nav ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

nav ul li {
  margin-left: 20px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-weight: 500;
}

nav ul li a:hover {
  text-decoration: underline;
}
</style>

<?php
session_start(); // ensure session is active
?>

<nav class="navbar">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="players.php">Players</a></li>
    <li><a href="add_stats.php">Add Stats</a></li>
    <li><a href="take_quiz.php">Quiz</a></li>
    <li><a href="dashboard.php">Dashboard</a></li>

    <?php if (isset($_SESSION['user_id'])): ?>
        <li style="float:right;"><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
    <?php else: ?>
        <li style="float:right;"><a href="login.php">Login</a></li>
        <li style="float:right;"><a href="register.php">Register</a></li>
    <?php endif; ?>
  </ul>
</nav>

