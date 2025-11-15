<?php

include 'db_connect.php';
include 'navbar.php';



if (!isset($_GET['id'])) {
    header("Location: players.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM players WHERE player_id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<p style='color:red;text-align:center;'>Player not found!</p>";
    exit;
}

$player = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['p_name'];
    $age = $_POST['p_age'];
    $team = $_POST['p_team'];
    $position = $_POST['p_position'];
    $height = $_POST['p_height'];
    $weight = $_POST['p_weight'];
    $country = $_POST['p_country'];
    $status = $_POST['status'];

    $updateSQL = "UPDATE players 
                  SET p_name='$name', p_age='$age', p_team='$team', p_position='$position', 
                      p_height='$height', p_weight='$weight', p_country='$country', status='$status'
                  WHERE player_id=$id";

    if ($conn->query($updateSQL) === TRUE) {
        echo "<p style='color:green;text-align:center;'>Player updated successfully!</p>";
    } else {
        echo "<p style='color:red;text-align:center;'>Error updating record: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Player</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Edit Player Details</h2>

<form method="POST">
    <input type="text" name="p_name" value="<?php echo $player['p_name']; ?>" required>
    <input type="number" name="p_age" value="<?php echo $player['p_age']; ?>" required>
    <input type="text" name="p_team" value="<?php echo $player['p_team']; ?>">
    <input type="text" name="p_position" value="<?php echo $player['p_position']; ?>"><br>
    <input type="number" step="0.1" name="p_height" value="<?php echo $player['p_height']; ?>">
    <input type="number" step="0.1" name="p_weight" value="<?php echo $player['p_weight']; ?>">
    <input type="text" name="p_country" value="<?php echo $player['p_country']; ?>">
    <select name="status">
        <option value="Active" <?php if($player['status']=='Active') echo 'selected'; ?>>Active</option>
        <option value="Retired" <?php if($player['status']=='Retired') echo 'selected'; ?>>Retired</option>
    </select>
    <br><br>
    <button type="submit" name="update">Update Player</button>
</form>

<p style="text-align:center;"><a href="players.php">Back to Players</a></p>
</div>
</body>
</html>