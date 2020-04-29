<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $fixture_id = $_POST['fixture_id'];
    $players = $_POST['ids'];
    mysqli_query($database, "DELETE FROM fixture_players WHERE fixture_id = '$fixture_id'");
    foreach($players as $player){
        $query = mysqli_query($database, "INSERT INTO fixture_players (fixture_id, student_id, availability) VALUES ('$fixture_id', '$player', 0)");
    }

    $_SESSION['success'] = 'Match invitation has been sent to player(s)';
    header("location:../select-squad.php?id=$fixture_id");
    die();
}
?>
