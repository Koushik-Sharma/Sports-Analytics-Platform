<?php
include 'db_connect.php';
include 'navbar.php';

if (isset($_POST['submit'])) {
    $name = $_POST['p_name'];
    $age = $_POST['p_age'];
    $team = $_POST['p_team'];
    $position = $_POST['p_position'];
    $height = $_POST['p_height'];
    $weight = $_POST['p_weight'];
    $country = $_POST['p_country'];
    $status = $_POST['status'];
    $image_name = "";

  
    if (isset($_FILES['p_image']) && $_FILES['p_image']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($_FILES['p_image']['name'], PATHINFO_EXTENSION));
        $file_size = $_FILES['p_image']['size'];
        $file_tmp = $_FILES['p_image']['tmp_name'];
        $file_type = $_FILES['p_image']['type'];

        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<p style='color:red;text-align:center;'>Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
        } elseif ($file_size > 2097152) { 
            echo "<p style='color:red;text-align:center;'>File size must be less than 2MB.</p>";
        } elseif (!getimagesize($file_tmp)) {
            echo "<p style='color:red;text-align:center;'>Uploaded file is not a valid image.</p>";
        } else {
            $target_dir = "uploads/";
            $image_name = basename($_FILES["p_image"]["name"]);
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
                echo "<p style='color:green;text-align:center;'>Image uploaded successfully!</p>";
            } else {
                echo "<p style='color:red;text-align:center;'>Image upload failed.</p>";
            }
        }
    }

    $sql = "INSERT INTO players (p_name, p_age, p_team, p_position, p_height, p_weight, p_country, status, p_image)
            VALUES ('$name', '$age', '$team', '$position', '$height', '$weight', '$country', '$status', '$image_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;text-align:center;'>Player added successfully!</p>";
    } else {
        echo "<p style='color:red;text-align:center;'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Player</title>
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
    input[type="text"], input[type="number"], input[type="file"], select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1.5px solid #c5d8ee;
      border-radius: 8px;
      font-size: 1.1em;
      background: #f5f6fa;
      transition: border-color 0.2s;
    }
    input:focus, select:focus {
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
      text-align: center;
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
    a {
      color: #0072ff;
      text-decoration: none;
      font-weight: 500;
    }
    a:hover {
      text-decoration: underline;
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
  <h2>Add New Player</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="text" name="p_name" placeholder="Player Name" required>
    <input type="number" name="p_age" placeholder="Age" required>
    <input type="text" name="p_team" placeholder="Team" required>
    <input type="text" name="p_position" placeholder="Position" required><br>
    <input type="number" name="p_height" placeholder="Height (cm)" required>
    <input type="number" name="p_weight" placeholder="Weight (kg)" required>
    <input type="text" name="p_country" placeholder="Country" required>

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

  <p style="text-align:center;"><a href="players.php">View All Players</a></p>
</div>
</body>
</html>
