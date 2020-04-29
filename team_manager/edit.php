<?php
session_start();
require "../database/database.php";
if(!$_SESSION['manager_id']){
    header('location: index.php');
    die();
}

$id = $_GET['id'];
$query = mysqli_query($database, "SELECT * FROM fixtures WHERE id = '$id'");
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
    <h3> <b>Edit Fixture</b> </h3> 
    <hr>
    <?php while($row = mysqli_fetch_array($query)){?>
        <div style="width: 500px">
            <form action="operations/edit-fixture.php" method="post">
                <table>
                    <tr>
                        <td> <b>Location</b> </td>
                        <td> 
                        <input type="text" name="location" required value="<?php echo $row['location']?>"> 
                        <input type="hidden" name="id" required value="<?php echo $row['id']?>">
                        </td>
                    </tr>
                    <tr>
                        <td> <b>Playing Against</b> </td>
                        <td> <input type="text" name="away" required value="<?php echo $row['away']?>"> </td>
                    </tr> 
                    <tr>
                        <td> <b>Match Date</b> </td>
                        <td> <input type="date" id="date" name="match_date" required <?php echo $row['game_date']?>> </td>
                    </tr> 
                    <tr>
                        <td colspan="2"> <input type="submit" value="Edit Fixture"> </td>
                    </tr>             
                </table>
            </form>   
        </div>
    <?php } ?>    

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