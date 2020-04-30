<?php
session_start();
require "../../database/database.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_POST["password"] !== $_POST["confirm"]) {
            $_SESSION['fail'] = 'Passwords do not match';
            header("location: ../update-password.php");
            die();
        }

        if (strlen($_POST["password"]) < 8) {
            $_SESSION['fail'] = 'Password too short, must be at least 8 characters';
            header("location: ../update-password.php");
            die();
        }

        $password = sha1($_POST['password']);
        $id = $_SESSION['team_manager_id'];

        $query = mysqli_query($database, "UPDATE team_managers SET password = '$password' WHERE id = '$id'") or die(mysqli_error($database));
        $_SESSION['success'] = 'Password update successful. Please login below with your new password';    
        header("location: ../index.php");
    }
?>
