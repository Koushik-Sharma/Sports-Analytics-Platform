<style>
nav {
  background: #007bff;
  padding: 12px 25px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

nav .logo {
  display: flex;
  align-items: center;
  gap: 10px;
}

nav .logo img {
  height: 40px;
  width: 40px;
  border-radius: 50%;
}

nav .logo span {
  color: white;
  font-size: 22px;
  font-weight: bold;
}

nav ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
  align-items: center;
}

nav ul li {
  margin-left: 25px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

nav ul li a:hover {
  text-decoration: underline;
  color: #dfe9ff;
}
</style>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
  <div class="logo">
    <img src="logos/logo2.png" alt="Logo">
    <span>Sports Analytics</span>
  </div>

  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="players.php">Players</a></li>
    <li><a href="take_quiz.php">Take Quiz</a></li>
    <li><a href="view_results.php">View Results</a></li>
    <li><a href="dashboard.php">Dashboard</a></li>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <li><a href="add_quiz.php">Create Quiz</a></li>
        <li><a href="add_stats.php">Add Stats</a></li>
        <li><a href="add_player.php">Add Player</a></li>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
    <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    <?php endif; ?>
  </ul>
</nav>
