<?php
session_start();
require "../database/database.php";
if(!$_SESSION['manager_id']){
    header('location: index.php');
    die();
}

$fixture_id = $_GET['id'];
$query = mysqli_query($database, "SELECT * FROM swap_requests LEFT JOIN students ON swap_requests.student_id = students.student_id LEFT JOIN fixtures ON swap_requests.fixture_id = fixtures.id WHERE swap_requests.fixture_id = '$fixture_id' ORDER BY swap_requests.id ASC");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
    <header>
        RGU:TEAMS - TEAM MANAGER - <?php echo $_SESSION['team_name'];?>
    </header>
    <?php require "nav.php" ?>
    <main>

        <h3> <b>Fixtures Swap Requests</b> </h3>    
        <hr>    
        <table>
            <tr>
                <th width="5%"> S/N </th>
                <th width="20%"> Fixture Details</th>
                <th width="15%"> Player Name </th>            
                <th width="15%"> Swap Request Details </th>
            </tr>

            <?php $i = 1; while($row = mysqli_fetch_array($query)){?>
                <tr>
                    <td><?php echo $i++?> </td>
                    <td>
                        <b>Playing Against:</b> <?php echo $row['away'] ?> <br>
                        <b>Venue:</b> <?php echo $row['location'] ?> <br>
                        <b>Game Date:</b> <?php echo $row['game_date'] ?> <br>
                    </td>
                    <td>
                        <?php echo $row['full_name'];?>
                    </td>
                    <td>
                        <?php echo $row['message'];?>
                    </td>
                </tr>
            <?php } ?>            
        </table>
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>    
    </footer>
    <script>
        flatpickr("#date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
</body>
</html>