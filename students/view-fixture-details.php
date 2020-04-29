<?php
session_start();
require "../database/database.php";
$student_id = $_SESSION["student_id"];
$fixture_id = $_GET['id'];
$query = mysqli_query($database, "SELECT * FROM fixtures WHERE id = '$fixture_id'");
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
        <h3> <b> FIXTURE DETAILS </b> </h3>   <hr>
        <table>
            <tr>
                <th width="20%"> Location </th>
                <th width="20%"> Playing Against </th>            
                <th width="15%"> Game Date </th>
            </tr>
            <?php while($row2 = mysqli_fetch_array($query)){?>
            <tr>
                <td><?php echo $row2['location'];?> <br> </td>
                <td><?php echo $row2['away'];?> </td>
                <td><?php echo $row2['game_date'];?> </td>
            </tr>
            <?php }?>
        </table>
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>
    </footer>
</body>
</html>