<?php
session_start();
require "../database/database.php";
$student_id = $_SESSION["student_id"];
$query = mysqli_query($database, "SELECT teams.id AS team_id, teams.*, team_members.*, team_managers.* FROM team_members LEFT JOIN teams ON team_members.team_id = teams.id  LEFT JOIN team_managers ON teams.manager_id = team_managers.manager_id WHERE team_members.student_id = '$student_id'");
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
        RGU:TEAMS - Welcome <?php echo $_SESSION['student_name']; ?>
    </header>
    <?php include 'nav.php';?>
    <main>
        <h3> <b>My TEAMS</b> </h3>   <hr>
        <?php while($row = mysqli_fetch_array($query)){?>     
            <b><?php echo $row['name']?></b> managed by <b><?php echo $row['full_name']; ?></b> <br><br>
            <b> FIXTURES </b>
        <hr>
        <?php 
            $team_id = $row['team_id'];
            $quert2 = mysqli_query($database, "SELECT * FROM fixtures WHERE team_id = '$team_id'");
        ?>
        <table>
            <tr>
                <th width="20%"> Location </th>
                <th width="20%"> Playing Against </th>            
                <th width="15%"> Game Date </th>
                <th width="10%"> </th>
            </tr>
            <?php while($row2 = mysqli_fetch_array($quert2)){?>
            <tr>
                <td><?php echo $row2['location'];?> <br> </td>
                <td><?php echo $row2['away'];?> </td>
                <td><?php echo $row2['game_date'];?> </td>
                <td>
                <a href="view-fixture-details.php?id=<?php echo $row2['id'];?>">view fixture details </a> <hr>
                    <a href="view-final-selection.php?id=<?php echo $row2['id'];?>">view final selection</a>
                </td>
            </tr>
            <?php }?>
        </table>
        <?php } ?>
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>
    </footer>
</body>
</html>