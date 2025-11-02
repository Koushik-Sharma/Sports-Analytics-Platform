<style>
    .header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
    }

    .header ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .header ul li {
        display: inline-block;
        margin-right: 20px;
    }

    .header ul li a {
        color: #fff;
        text-decoration: none;
    }

    .header ul li a:hover {
        text-decoration: underline;
    }
</style>

<nav class="header">
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