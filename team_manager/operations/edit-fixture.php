<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $away_team = trim($_POST['away']);
    $location = trim($_POST['location']);
    $match_date = trim($_POST['match_date']);
    $id = trim($_POST['id']);

    $query = mysqli_query($database, "UPDATE fixtures SET away = '$away_team', location = '$location', game_date = '$match_date' WHERE id = '$id'");
    $_SESSION['success'] = "Fixture updated successfully";
    header("location:../fixtures.php");
    die();
}
?>
