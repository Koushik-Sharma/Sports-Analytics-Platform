<?php
include 'db_connect.php';
include 'navbar.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Football Quiz</title>
    <link rel="stylesheet" href="style.css">
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
