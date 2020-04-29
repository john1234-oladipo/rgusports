<?php
session_start();
require "../database/database.php";
if(!$_SESSION['manager_id']){
    header('location: index.php');
    die();
}

$team_id = $_SESSION['team_id'];
$query = mysqli_query($database, "SELECT * FROM fixtures WHERE team_id = '$team_id' ORDER BY game_date ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home - RGU:SPORTS </title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body>
    <header>
        RGU:TEAMS - TEAM MANAGER - <?php echo $_SESSION['team_name'];?>
    </header>
    <?php require "nav.php" ?>
    <main>
        <h3> <b>Upcoming Games</b> </h3>        
        <hr>
        <table>
            <tr>
                <th width="5%"> S/N </th>
                <th width="20%"> Location </th>
                <th width="20%"> Playing Against </th>            
                <th width="15%"> Game Date </th>
            </tr>
            <?php $i = 1; while($row = mysqli_fetch_array($query)){?>
                <tr>
                    <td><?php echo $i++?> </td>
                    <td><?php echo $row['location'];?></td>
                    <td><?php echo $row['away'];?> </td>
                    <td><?php echo $row['game_date'];?> </td>
                </tr>
            <?php } ?>            
        </table>
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>    
    </footer>
</body>
</html>