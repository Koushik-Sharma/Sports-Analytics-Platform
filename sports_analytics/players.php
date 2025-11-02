<?php include 'navbar.php'; ?>
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
        <button type="submit" class="button">Search</button>
        <a href="add_player.php"><button type="button" class="button">Add Player</button></a>
    </form>

    <div class="player-grid">
    <?php
    // Build query
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

    <?php
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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
          </a>" ;
        }
    } else {
        echo "<p style='text-align:center;'>No players found.</p>";
    }
    ?>
    </div>
</div>