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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

<?php if ($_SESSION['role'] == 'admin'): ?>
    <p><a href="players.php">Manage Players</a></p>
<?php endif; ?>

<p><a href="quiz.php">Take Quiz</a></p>
<p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
