<?php
include 'db_connect.php';
include 'navbar.php'; 

?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Player</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Add New Player</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="p_name" placeholder="Player Name" required>
    <input type="number" name="p_age" placeholder="Age" required>
    <input type="text" name="p_team" placeholder="Team">
    <input type="text" name="p_position" placeholder="Position"><br>
    <input type="number" name="p_height" placeholder="Height (m)">
    <input type="number"name="p_weight" placeholder="Weight (kg)">
    <input type="text" name="p_country" placeholder="Country">

    <label>Player Image:</label>
    <input type="file" name="p_image" accept="image/*">

    <select name="status">
        <option value="Active">Active</option>
        <option value="Retired">Retired</option>
    </select>
    <br><br>
    
    <a href="add_stats.php"><button type="button">Add Player Stats</button></a>
    <button type="submit" name="submit">Add Player</button>

</form>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['p_name'];
    $age = $_POST['p_age'];
    $team = $_POST['p_team'];
    $position = $_POST['p_position'];
    $height = $_POST['p_height'];
    $weight = $_POST['p_weight'];
    $country = $_POST['p_country'];
    $status = $_POST['status'];

    // Handle image upload
    $image_name = "";
    if (isset($_FILES['p_image']) && $_FILES['p_image']['error'] == 0) {
        $target_dir = "uploads/";
        $image_name = basename($_FILES["p_image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Move uploaded file
        if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) {
            echo "<p style='color:green;text-align:center;'>Image uploaded successfully!</p>";
        } else {
            echo "<p style='color:red;text-align:center;'>Image upload failed.</p>";
        }
    }

    // Insert player info into database
    $sql = "INSERT INTO players (p_name, p_age, p_team, p_position, p_height, p_weight, p_country, status, p_image)
            VALUES ('$name', '$age', '$team', '$position', '$height', '$weight', '$country', '$status', '$image_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;text-align:center;'>Player added successfully!</p>";
    } else {
        echo "<p style='color:red;text-align:center;'>Error: " . $conn->error . "</p>";
    }
}
?>

<p style="text-align:center;"><a href="players.php">View All Players</a></p>
</div>
</body>
</html>
