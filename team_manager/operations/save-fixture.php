<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_id = $_SESSION['team_id'];
    
    $away_team = trim($_POST['away']);
    $location = trim($_POST['location']);
    $match_date = trim($_POST['match_date']);


    $query = mysqli_query($database, "INSERT INTO fixtures (team_id, away, location, game_date) VALUES ('$team_id', '$away_team', '$location', '$match_date')");
    $_SESSION['success'] = "Fixture added successfully";
    header("location:../fixtures.php");
    die();
}
?>
