<?php
session_start();
require "../database/database.php";
$query = mysqli_query($database, "SELECT teams.id AS team_id, teams.*, team_managers.* FROM teams LEFT JOIN team_managers ON teams.manager_id = team_managers.manager_id ORDER BY teams.name ASC");
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
    <?php if(isset($_SESSION['success'])){?>
        <div class="status_message">
            <div class="success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        </div>
    <?php } ?>

    <?php if(isset($_SESSION['fail'])){?>
        <div class="status_message">
            <div class="error">
                <?php echo $_SESSION['fail']; unset($_SESSION['fail']); ?>
            </div>
        </div>
    <?php } ?>
    <main>
        <h3> Fixtures </h3>  
        <hr>
        <table>
            <tr>
                <th> Team Name </th>
                <th> Manager Name </th>
                <th> Apply For Membership </th>
            </tr>

            <?php while($record = mysqli_fetch_array($query)){ ?>
            <tr>
                <td> <?php echo $record['name']; ?> </td>
                <td> <?php echo $record['full_name']; ?> </td>
                <td> <a href="operations/apply-to-team.php?id=<?php echo $record['team_id'];?>"> apply to join team </a> </td>
            </tr>
            <?php } ?>
        </table>      
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>    
    </footer>
</body>
</html>