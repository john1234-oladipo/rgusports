<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $team_id = $_GET['id'];
    $sql = "UPDATE team_members SET status = 1 WHERE id = '$team_id'";
    $query = mysqli_query($database, $sql);
    $_SESSION['success'] = "Student accepted to the team";
    header("location:../squad.php");
    die();
}
?>
