<?php
session_start();
require "../database/database.php";
if(!$_SESSION['manager_id']){
    header('location: index.php');
    die();
}

$team_id = $_SESSION['team_id'];
$query = mysqli_query($database, "SELECT * FROM fixtures WHERE team_id = '$team_id' ORDER BY id ASC");
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
    <table>
        <tr>
            <td colspan="4"> <b>Add Fixture</b> </td>
        </tr>
            <tr>
                <form action="operations/save-fixture.php" method="post">
                    <td>
                        <b>Match Date</b> <br>
                        <input type="date" id="date" name="match_date" required>
                    </td>
                    <td>
                        <b>Playing Against</b> <br>
                        <input type="text" name="away" required>
                    </td>
                    <td>
                        <b>Fixture Location</b> <br>
                        <input type="text" name="location" required>
                    </td>
                    <td><br>
                        <input type="submit" value="Save Fixture">
                    </td>
                </form>
            </tr>
        </table>
        <hr>
        <br>
        <h3> <b>Team Fixtures</b> </h3>    
        <hr>    
        <table>
            <tr>
                <th width="5%"> S/N </th>
                <th width="20%"> Fixture Location </th>
                <th width="15%"> Playing Against </th>            
                <th width="15%"> Game Date </th>
                <th width="20%"> Invite Players </th>
                <th width="15%"> View Available Players </th>
                <th width="15%"> View Swap Requests </th>
            </tr>

            <?php $i = 1; while($row = mysqli_fetch_array($query)){?>
                <tr>
                    <td><?php echo $i++?> </td>
                    <td><?php echo $row['location'];?> <br>
                    <a href="operations/delete-fixture.php?id=<?php echo $row['id'];?>"> delete </a> / <a href="edit.php?id=<?php echo $row['id'];?>"> edit </a>
                    </td>
                    <td><?php echo $row['away'];?> </td>
                    <td><?php echo $row['game_date'];?> </td>
                    <td>
                        <a href="select-squad.php?id=<?php echo $row['id'];?>"> select squad to send invite </a>
                    </td>
                    <td>
                        <a href="view-available.php?id=<?php echo $row['id'];?>"> view  and do final fixture selection  </a>
                    </td>
                    <td>
                        <a href="view-swap-requests.php?id=<?php echo $row['id'];?>"> view  </a>
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