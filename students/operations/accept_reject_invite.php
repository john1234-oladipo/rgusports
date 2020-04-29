<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $fixture_player_id = $_GET['id'];
    $status = $_GET['status'];

    mysqli_query($database, "UPDATE fixture_players SET availability = '$status' WHERE id = '$fixture_player_id'");
    $_SESSION['success'] = $status == 1 ? 'You have accepted the invite' : 'You have rejected the invite';
    header('location: ../invites.php');
}
?>
