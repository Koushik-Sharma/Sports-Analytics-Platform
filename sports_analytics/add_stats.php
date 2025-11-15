<?php 
include 'db_connect.php'; 
include 'navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo "<script>
      alert('Access denied. Admins only!');
      window.location='login.php';
  </script>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Player Statistics</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      margin: 0;
      padding: 0;
      color: #333;
    }
    .container {
      max-width: 800px;
      margin: 60px auto;
      background: rgba(255, 255, 255, 0.98);
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #0072ff;
      background: #fff;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 1.8em;
      font-weight: 600;
    }
    label {
      font-weight: 500;
      color: #0a2784;
      display: block;
      margin-bottom: 8px;
      font-size: 1.1em;
    }
    select, input[type="text"], input[type="number"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1.5px solid #c5d8ee;
      border-radius: 8px;
      font-size: 1.1em;
      background: #f5f6fa;
      transition: border-color 0.2s;
    }
    select:focus, input:focus {
      border-color: #0072ff;
      outline: none;
      background: #fff;
    }
    button {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1.1em;
      cursor: pointer;
      background: linear-gradient(90deg, #00c853, #b2ff59);
      color: #222;
      margin-top: 10px;
      transition: background 0.24s, color 0.24s;
    }
    button:hover {
      background: linear-gradient(90deg, #1db76a, #b2ff59);
      color: #094684;
    }
    .message {
      margin: 15px 0;
      padding: 10px;
      border-radius: 8px;
      font-weight: 500;
    }
    .message.success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .message.error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    @media (max-width: 768px) {
      .container {
        width: 95%;
        padding: 25px 10px;
      }
      h2 {
        font-size: 1.4em;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Add Player Statistics</h2>
  <form method="GET" style="margin-bottom: 20px;">
    <label>Sort Players By:</label>
    <select name="sort" onchange="this.form.submit()">
      <option value="">-- Default (Name) --</option>
      <option value="p_team" <?php if(isset($_GET['sort']) && $_GET['sort']=='p_team') echo 'selected'; ?>>Team</option>
      <option value="p_country" <?php if(isset($_GET['sort']) && $_GET['sort']=='p_country') echo 'selected'; ?>>Country</option>
    </select>
  </form>

  <form method="POST">
    <label for="player_id">Select Player:</label>
    <select name="player_id" required>
      <option value="">-- Select Player --</option>
      <?php
      $sort = isset($_GET['sort']) ? $_GET['sort'] : 'p_name';
      $players = $conn->query("SELECT player_id, p_name, p_team, p_country FROM players ORDER BY $sort ASC");

      while ($p = $players->fetch_assoc()) {
        echo "<option value='{$p['player_id']}'>
                {$p['p_name']} ({$p['p_team']}, {$p['p_country']})
              </option>";
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

    $check = $conn->query("SELECT * FROM player_statistics WHERE player_id='$player_id' AND season='$season'");
    if ($check->num_rows > 0) {
      echo "<p class='message error'>⚠️ Stats for this player and season already exist!</p>";
    } else {
      $query = "INSERT INTO player_statistics 
                (player_id, season, matches_played, goals, assists, saves, rating, preferred_foot)
                VALUES ('$player_id', '$season', '$matches', '$goals', '$assists', '$saves', '$rating', '$foot')";

      if ($conn->query($query)) {
        echo "<p class='message success'>Player statistics added successfully!</p>";
      } else {
        echo "<p class='message error'>Error: " . $conn->error . "</p>";
      }
    }
  }
  ?>
</div>
</body>
</html>
