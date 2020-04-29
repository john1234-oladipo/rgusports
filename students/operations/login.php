<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = mysqli_real_escape_string($database, $_POST["student_id"]);
    $password = sha1(mysqli_real_escape_string($database, $_POST["password"])); 

    $sql = "SELECT * FROM students where student_id = '$student_id' AND password = '$password'";
    $query = mysqli_query($database, $sql);    
    $numrow = mysqli_num_rows($query);

    if ($numrow > 0) { 
        $row = mysqli_fetch_array($query);
        $_SESSION["student_id"] = $row['student_id'];
        $_SESSION['student_name'] = $row['full_name'];
        header("location:../home.php");      
    }else {
        $_SESSION['fail'] = "Student ID or password is incorrect";
        header("location:../index.php");
    }
}
?>
