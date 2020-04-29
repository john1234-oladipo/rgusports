<?php
session_start();
require "../../database/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = mysqli_real_escape_string($database, $_POST["manager_id"]);
    $password = sha1(mysqli_real_escape_string($database, $_POST["password"])); 

    $sql = "SELECT * FROM team_managers where manager_id = '$staff_id' AND password = '$password'";
    $query = mysqli_query($database, $sql);    
    $numrow = mysqli_num_rows($query);

    if ($numrow > 0) { 
        $row = mysqli_fetch_array($query);
        $manager_id = $row['manager_id'];
        //get team details
        $query = mysqli_query($database, "SELECT * FROM teams WHERE manager_id = '$manager_id'");
        $team_info = mysqli_fetch_array($query);
        

        $_SESSION["manager_id"] = $row['id'];
        $_SESSION['manager_name'] = $row['full_name'];

        $_SESSION['team_id'] = $team_info['id'];
        $_SESSION['team_name'] = $team_info['name'];        
        header("location:../home.php");      
    }else {
        $_SESSION['fail'] = "Team manager ID or password is incorrect";
        header("location:../index.php");
    }
}
?>
