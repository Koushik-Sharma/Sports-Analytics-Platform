<?php 

include 'db_connect.php'; 
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Football Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>User Registration</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password" required>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

<?php
if (isset($_POST['register'])) {
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $r = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$u', '$e', '$p', '$r')";
    if ($conn->query($sql)) {
        echo "<p class='success'>Registration successful! <a href='login.php'>Login</a></p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>
</div>
</body>
</html>
