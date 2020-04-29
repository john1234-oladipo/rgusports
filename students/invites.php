<?php
session_start();
require "../database/database.php";
$student_id = $_SESSION['student_id'];
$query = mysqli_query($database, "SELECT fixture_players.id AS fp_id, teams.id AS tid, fixtures.id AS fid, teams.*, fixtures.*, fixture_players.* FROM fixture_players LEFT JOIN fixtures ON fixture_players.fixture_id = fixtures.id LEFT JOIN teams ON fixtures.team_id = teams.id WHERE fixture_players.student_id = '$student_id' ORDER BY fixtures.game_date ASC") or die(mysqli_error($database));
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
        <h3> <b>Fixtures Invite</b> </h3>  
        <hr>
        <table>
            <tr>
                <th> Team </th>
                <th> Match Date </th>
                <th> Match Location </th>
                <th> Playing Against </th>
                <th> Availability </th>
                <th> Accept/Reject Invite</th>
            </tr>

            <?php while($record = mysqli_fetch_array($query)){ ?>
                <tr>
                    <td><?php echo $record['name']; ?> </td>
                    <td><?php echo $record['game_date']; ?> </td>
                    <td><?php echo $record['location']; ?> </td>
                    <td><?php echo $record['away']; ?> </td>
                    <td>
                        <?php 
                            if($record['availability'] == 1){
                                echo 'Available';
                            }elseif($record['availability'] == 2){
                                echo 'Rejected';
                            }else{
                                echo 'Not yet accepted or rejected';
                            }
                        ?> 
                    </td>
                    <td>
                        <a href="operations/accept_reject_invite.php?id=<?php echo $record['fp_id'] ?>&&status=1">Accept Fixture Invite</a> <br>
                        <a href="operations/accept_reject_invite.php?id=<?php echo $record['fp_id'] ?>&&status=2">Reject Fixture Invite</a>
                    </td>
                </tr>
            <?php } ?>
        </table>      
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>
    </footer>
</body>
</html>