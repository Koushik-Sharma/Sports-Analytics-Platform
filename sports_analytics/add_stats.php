<?php

include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Player Statistics</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
<h2>Add Player Statistics</h2>

<form method="POST">
    <label for="player_id">Select Player:</label>
    <select name="player_id" required>
        <option value="">-- Select Player --</option>
        <?php
        $players = $conn->query("SELECT player_id, p_name FROM players");
        while ($p = $players->fetch_assoc()) {
            echo "<option value='{$p['player_id']}'>{$p['p_name']}</option>";
        }
        ?>
    </select>

    <label>Season:</label>
    <input type="text" name="season" placeholder="e.g. 2024/25" required>

    <label>Matches Played:</label>
    <input type="number" name="matches_played" min="0" value="0">

    <label>Goals:</label>
    <input type="number" name="goals" min="0" value="0">

    <label>Assists:</label>
    <input type="number" name="assists" min="0" value="0">

    <label>Saves:</label>
    <input type="number" name="saves" min="0" value="0">

    <label>Rating:</label>
    <input type="number" name="rating" step="0.1" min="0" max="10" value="0">

    <label>Preferred Foot:</label>
    <select name="preferred_foot">
        <option value="Right">Right</option>
        <option value="Left">Left</option>
        <option value="Both">Both</option>
    </select>

    <button type="submit" name="save_stats">Save Statistics</button>
</form>

<?php
if (isset($_POST['save_stats'])) {
    $player_id = $_POST['player_id'];
    $season = $_POST['season'];
    $matches = $_POST['matches_played'];
    $goals = $_POST['goals'];
    $assists = $_POST['assists'];
    $saves = $_POST['saves'];
    $rating = $_POST['rating'];
    $foot = $_POST['preferred_foot'];

    $query = "INSERT INTO player_statistics 
        (player_id, season, matches_played, goals, assists, saves, rating, preferred_foot)
        VALUES ('$player_id', '$season', '$matches', '$goals', '$assists', '$saves', '$rating', '$foot')";

    if ($conn->query($query)) {
        echo "<p style='color:green;'> Player statistics added successfully!</p>";
    } else {
        echo "<p style='color:red;'> Error: " . $conn->error . "</p>";
    }
}
?>

</div>
</body>
</html>
