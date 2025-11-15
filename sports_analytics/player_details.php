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

$stats_query = "SELECT * FROM player_statistics WHERE player_id = $player_id";
$stats_result = $conn->query($stats_query);
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlspecialchars($player['p_name']); ?> - Details</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      color: #333;
    }

    .player-details {
      max-width: 900px;
      margin: 100px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px 50px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .player-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .player-header img {
      width: 220px;
      height: 220px;
      border-radius: 12px;
      object-fit: cover;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .player-header h2 {
      font-size: 2.4em;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 5px;
    }

    .player-header p {
      font-size: 1.1em;
      color: #444;
      margin: 5px 0;
    }

    h3 {
      text-align: center;
      color: #00416A;
      margin-top: 40px;
      font-size: 1.8em;
      letter-spacing: 0.5px;
    }

    .stats-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 1em;
    }

    .stats-table th, .stats-table td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: center;
    }

    .stats-table th {
      background: #0072ff;
      color: white;
      font-weight: 600;
    }

    .stats-table tr:nth-child(even) {
      background-color: #f7f9fb;
    }

    .stats-table tr:hover {
      background-color: #e8f3ff;
    }

    .admin-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 25px;
    }

    .admin-buttons button,
    .btn-save {
      padding: 12px 24px;
      border: none;
      border-radius: 30px;
      color: #000;
      background: linear-gradient(90deg, #00c853, #b2ff59);
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .admin-buttons button:hover,
    .btn-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .delete-btn {
      background: linear-gradient(90deg, #ff5252, #ff1744);
      color: #fff;
    }

    .delete-btn:hover {
      background: linear-gradient(90deg, #d32f2f, #b71c1c);
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 40px;
      font-size: 1em;
      text-decoration: none;
      color: #0066cc;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .back-link:hover {
      color: #004bb5;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .player-details {
        padding: 25px 20px;
        width: 90%;
      }

      .player-header img {
        width: 180px;
        height: 180px;
      }

      .stats-table th, .stats-table td {
        font-size: 0.9em;
        padding: 8px;
      }
    }
  </style>
</head>
<body>

<div class="player-details">
  <div class="player-header">
    <?php
      $imagePath = !empty($player['p_image']) ? "uploads/{$player['p_image']}" : 'uploads/default.jpg';
      echo "<img src='$imagePath' alt='Player Image' onerror=\"this.src='uploads/default.jpg'\">";
    ?>
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
            <tr>
              <th>Season</th>
              <th>Matches</th>
              <th>Goals</th>
              <th>Assists</th>
              <th>Saves</th>
              <th>Rating</th>
              <th>Foot</th>
            </tr>";
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
    echo "<p style='text-align:center; color:#666;'>No statistics available for this player.</p>";

    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
      echo "<form action='add_stats.php' method='GET' style='text-align:center; margin-top:20px;'>
              <input type='hidden' name='id' value='{$player['player_id']}'>
              <button type='submit' class='btn-save'>Add Stats</button>
            </form>";
    }
  }
  ?>

  <a href="players.php" class="back-link">← Back to Players</a>

  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
    <div class="admin-buttons">
      <form action="update_player.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $player['player_id']; ?>">
        <button type="submit">Edit Player</button>
      </form>
      <form action="delete_player.php" method="GET" onsubmit="return confirm('Are you sure you want to delete this player?');">
        <input type="hidden" name="id" value="<?php echo $player['player_id']; ?>">
        <button type="submit" class="delete-btn">Delete Player</button>
      </form>
    </div>
  <?php } ?>
</div>

</body>
</html>
