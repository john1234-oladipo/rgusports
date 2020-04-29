<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $fixture_id = $_GET['id'];
    $query = mysqli_query($database, "DELETE FROM fixtures WHERE id = '$fixture_id'");
    $_SESSION['success'] = "Fixture deleted successfully";
    header("location:../fixtures.php");
    die();
}
?>
