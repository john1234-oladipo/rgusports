<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $details = mysqli_real_escape_string($database, $_POST["details"]);

    $sql = "SELECT * FROM students where student_id = '$details' OR email = '$details'";
    $query = mysqli_query($database, $sql);    
    $numrow = mysqli_num_rows($query);

    if ($numrow === 1) { 
        $row = mysqli_fetch_array($query);
        $_SESSION["reset_id"] = $row['id'];
        $_SESSION["success"] = 'Reset your password below';
        header("location:../update-password.php");      
    }else {
        $_SESSION['fail'] = "Student ID or email is incorrect";
        header("location:../reset.php");
    }
}
?>
