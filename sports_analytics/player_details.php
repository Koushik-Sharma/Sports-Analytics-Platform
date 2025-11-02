<?php

include 'db_connect.php';
include 'navbar.php';

if (!isset($_GET['id'])) {
    die("Player not found.");
}

$player_id = $_GET['id'];
$query = "SELECT * FROM players WHERE player_id = $player_id";
$result = $conn->query($query);
$player = $result->fetch_assoc();

if (!$player) {
    die("No player found.");
}

// Get stats
$stats_query = "SELECT * FROM player_statistics WHERE player_id = $player_id";
$stats_result = $conn->query($stats_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($player['p_name']); ?> - Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .player-details {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .player-details img {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;
            display: block;
            margin: 0 auto 20px;
        }
        .player-info {
            text-align: center;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .stats-table th, .stats-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .stats-table th {
            background: #f4f4f4;
        }
    </style>
</head>
<body>

<div class="player-details">
    <?php
    $imagePath = !empty($player['p_image']) ? "uploads/{$player['p_image']}" : 'uploads/default.jpg';
    echo "<img src='$imagePath' alt='Player Image' onerror=\"this.src='uploads/default.jpg'\">";
    ?>
    
    <div class="player-info">
        <h2><?php echo htmlspecialchars($player['p_name']); ?></h2>
        <p><b>Team:</b> <?php echo htmlspecialchars($player['p_team']); ?></p>
        <p><b>Country:</b> <?php echo htmlspecialchars($player['p_country']); ?></p>
        <p><b>Age:</b> <?php echo htmlspecialchars($player['p_age']); ?></p>
        <p><b>Position:</b> <?php echo htmlspecialchars($player['p_position']); ?></p>
        <p><b>Status:</b> <?php echo htmlspecialchars($player['status']); ?></p>
    </div>

    <h3>Performance Statistics</h3>
    <?php
    if ($stats_result->num_rows > 0) {
        echo "<table class='stats-table'>
                <tr><th>Season</th><th>Matches</th><th>Goals</th><th>Assists</th><th>Saves</th><th>Rating</th><th>Foot</th></tr>";
        while ($s = $stats_result->fetch_assoc()) {
            echo "<tr>
                    <td>{$s['season']}</td>
                    <td>{$s['matches_played']}</td>
                    <td>{$s['goals']}</td>
                    <td>{$s['assists']}</td>
                    <td>{$s['saves']}</td>
                    <td>{$s['rating']}</td>
                    <td>{$s['preferred_foot']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No statistics available for this player.</p>";
    }
    ?>

    <p style="text-align:center;"><a href="players.php">← Back to Players</a></p>
</div>

</body>
</html>
