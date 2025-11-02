<?php include 'navbar.php'; ?>
<div class="container">
    <h2><?php echo htmlspecialchars($player['p_name']); ?> - Details</h2>
    <?php
    $imagePath = !empty($player['p_image']) ? "uploads/{$player['p_image']}" : 'uploads/default.jpg';
    echo "<img src='$imagePath' alt='Player Image' onerror=\"this.src='uploads/default.jpg'\">";
    ?>
    
    <div class="player-info">
        <p><b>Team:</b> <?php echo htmlspecialchars($player['p_team']); ?></p>
        <p><b>Country:</b> <?php echo htmlspecialchars($player['p_country']); ?></p>
        <p><b>Age:</b> <?php echo htmlspecialchars($player['p_age']); ?></p>
        <p><b>Position:</b> <?php echo htmlspecialchars($player['p_position']); ?></p>
        <p><b>Status:</b> <?php echo htmlspecialchars($player['status']); ?></p>
    </div>

    <h3>Performance Statistics</h3>
    <?php
    if ($stats_result->num_rows > 0) {
        echo "<table>
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