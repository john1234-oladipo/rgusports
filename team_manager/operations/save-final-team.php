<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $fixture_id = $_POST['fixture_id'];
    $players = $_POST['ids'];
    mysqli_query($database, "DELETE FROM fixture_team WHERE fixture_id = '$fixture_id'");
    foreach($players as $player){
        $query = mysqli_query($database, "INSERT INTO fixture_team (fixture_id, student_id) VALUES ('$fixture_id', '$player')");
    }

    $_SESSION['success'] = 'Players have been selected for fixture';
    header("location:../view-available.php?id=$fixture_id");
    die();
}
?>
