<?php
session_start();
require "../../database/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['student_id'];
    $fixture_id = $_POST['fixture_id'];
    $message = $_POST['message'];


    $insert = mysqli_query($database, "INSERT INTO swap_requests (fixture_id, student_id, message) VALUES ('$fixture_id', '$student_id', '$message')") or die(mysqli_error($database));
    $_SESSION['success'] = "Swap requests has been sent to your team manager";
    header("location:../view-final-selection.php?id=$fixture_id");
}
