<?php
session_start();
require "../../database/database.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['fail'] = 'Invalid email address';
            header("location: ../signup.php");
            die();
        }

        if (strlen($_POST["manager_id"]) < 7) {
            $_SESSION['fail'] = 'Manager ID is too short, must be to 7 characters';
            header("location: ../signup.php");
            die();
        }

        if (strlen($_POST["password"]) < 8) {
            $_SESSION['fail'] = 'Password too short, must be at least 8 characters';
            header("location: ../signup.php");
            die();
        }

        if ($_POST["password"] !== $_POST["confirm"]) {
            $_SESSION['fail'] = 'Passwords do not match';
            header("location: ../signup.php");
            die();
        }

    
    

        $manager_id = $_POST['manager_id'];
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $password = sha1($_POST['password']);

        $check = "SELECT * FROM team_managers where manager_id = '$manager_id' OR email = '$email'";
        $query_u = mysqli_query($database, $check);
        $numrow = mysqli_num_rows($query_u);

        if ($numrow > 0) { 
            $_SESSION['fail'] = 'Sorry, team manager already exists';
            header("location: ../signup.php");
            die();
        }


        $sql = "INSERT INTO team_managers (manager_id, full_name, email, password) VALUES ('$manager_id', '$full_name', '$email', '$password')";
        $query = mysqli_query($database, $sql);
        $_SESSION['success'] = 'Registration successful. Please login below';    
        header("location: ../index.php");
    }
?>
