<?php
session_start();
require "../database/database.php";
if(!$_SESSION['manager_id']){
    header('location: index.php');
    die();
}

$team_id = $_SESSION['team_id'];
$fixture_id = $_GET['id'];
$query = mysqli_query($database, "SELECT team_members.id AS team_table_id, students.*, team_members.* FROM team_members LEFT JOIN students ON team_members.student_id = students.student_id WHERE team_members.team_id = '$team_id' AND team_members.status = 1 ORDER BY team_members.id DESC");
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
    <link rel="stylesheet" href="../assets/css/forms.css">
</head>
<body>
    <header>
        RGU:TEAMS - TEAM MANAGER - <?php echo $_SESSION['team_name'];?>
    </header>
    <?php require "nav.php" ?>
    <main>
        <h3> <b>Current Squad Members</b> </h3>  
        <hr>
        <form action="operations/save-team.php" method="post">
            <table>
                <tr>
                    <th width="5%"> Pick Players </th>
                    <th width="10%"> Picture </th>
                    <th width="70%"> Name </th>              
                </tr>
                <?php $i = 0; while($row = mysqli_fetch_array($query)){?>
                    <tr valign="top">
                        <td valign="top">
                            <input type="checkbox" name="ids[]" value="<?php echo $row['student_id'];?>" required>
                        </td>                    
                        <td valign="top"><img src="../uploads/students/<?php echo $row['image']; ?>" style="width: 100%;"></td>
                        <td valign="top"><?php echo $row['full_name']; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <br>
            <input type="hidden" name="fixture_id" value="<?php echo $fixture_id;?>">
            <input type="submit" name="" value="SEND INVITE" style="width: 20%">
        </form>
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>    
    </footer>
</body>
</html>