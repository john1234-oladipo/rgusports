<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $student_id = $_SESSION['student_id'];
    $team_id = $_GET['id'];

    $sql = "SELECT * FROM team_members where student_id = '$student_id' AND team_id = '$team_id'";
    $query = mysqli_query($database, $sql);    
    $numrow = mysqli_num_rows($query);

    if ($numrow > 0) { 
        $fetch = mysqli_fetch_array($query);
        $status = $fetch['status'];
        if($status){
            $_SESSION['fail'] = "You are already a squad member in this team";
            header("location:../teams.php");
            die();
        }else{
            $_SESSION['fail'] = "You have a pending request to join this team";
            header("location:../teams.php");
            die();
        }
    }else {
        $insert = mysqli_query($database, "INSERT INTO team_members (team_id, student_id) VALUES ('$team_id', '$student_id')") or die(mysqli_error($database));
        $_SESSION['success'] = "Request to join this team has been sent";
        header("location:../teams.php");
    }
}
?>
