<?php 
include 'db_connect.php';
include 'navbar.php';

if (!isset($_SESSION['user_id'])) {
  echo "<script>
      alert('Please log in to start the quiz.');
      window.location='login.php';
  </script>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Players List</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #00416A, #E4E5E6);
      color: #fff;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 100px auto;
      background: rgba(0, 0, 0, 0.75);
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
      text-align: center;
    }

    h2 {
      font-size: 2.4em;
      margin-bottom: 35px;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 0.5px;
    }

    form {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    input[type="text"],
    select {
      padding: 10px 15px;
      font-size: 1em;
      border: none;
      border-radius: 8px;
      background-color: #f1f1f1;
      color: #333;
      transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    select:focus {
      outline: none;
      box-shadow: 0 0 8px #00c6ff;
      background-color: #fff;
    }

    button {
      padding: 10px 20px;
      font-size: 1em;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-weight: 600;
      color: #000;
      background: linear-gradient(90deg, #00c853, #b2ff59);
      transition: all 0.3s ease;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .player-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-top: 30px;
    }

    .card-link {
      text-decoration: none;
      color: inherit;
      transition: transform 0.3s ease;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      padding: 20px;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }

    .card img {
      width: 100%;
      height: 200px;
      border-radius: 12px;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .card h3 {
      color: #0072ff;
      font-size: 1.4em;
      margin-bottom: 10px;
    }

    .card p {
      color: #333;
      font-size: 0.95em;
      margin: 6px 0;
      line-height: 1.4;
    }

    @media (max-width: 768px) {
      .container {
        width: 95%;
        padding: 25px 20px;
      }

      form {
        flex-direction: column;
        align-items: center;
      }

      .player-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Player Directory</h2>

    <form method="GET">
      <input type="text" name="search" placeholder="Search player name..." 
        value="<?php echo $_GET['search'] ?? ''; ?>">
      <select name="sort">
        <option value="">Sort By</option>
        <option value="p_name" <?php if(isset($_GET['sort']) && $_GET['sort']=='p_name') echo 'selected'; ?>>Name</option>
        <option value="p_country" <?php if(isset($_GET['sort']) && $_GET['sort']=='p_country') echo 'selected'; ?>>Country</option>
        <option value="status" <?php if(isset($_GET['sort']) && $_GET['sort']=='status') echo 'selected'; ?>>Status</option>
      </select>
      <button type="submit">Search</button>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <button type="button" onclick="window.location.href='add_player.php'">Add Player</button>
      <?php endif; ?>
    </form>

    <?php
    $query = "SELECT * FROM players";
    if (!empty($_GET['search'])) {
      $search = $conn->real_escape_string($_GET['search']);
      $query .= " WHERE p_name LIKE '%$search%'";
    }
    if (!empty($_GET['sort'])) {
      $sort = $conn->real_escape_string($_GET['sort']);
      $query .= " ORDER BY $sort ASC";
    }

    $result = $conn->query($query);
    ?>

    <div class="player-grid">
      <?php
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $imagePath = !empty($row['p_image']) ? 'uploads/' . $row['p_image'] : 'uploads/default.jpg';
          echo "
          <a href='player_details.php?id={$row['player_id']}' class='card-link'>
            <div class='card'>
              <img src='$imagePath' alt='Player Image'>
              <h3>{$row['p_name']}</h3>
              <p><b>Team:</b> {$row['p_team']}</p>
              <p><b>Country:</b> {$row['p_country']}</p>
              <p><b>Position:</b> {$row['p_position']}</p>
              <p><b>Status:</b> {$row['status']}</p>
            </div>
          </a>";
        }
      } else {
        echo "<p style='text-align:center;'>No players found.</p>";
      }
      ?>
    </div>
  </div>
</body>
</html>
