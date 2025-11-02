<?php

include 'navbar.php';
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM players WHERE player_id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: players.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
