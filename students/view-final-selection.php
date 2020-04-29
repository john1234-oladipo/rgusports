<?php
session_start();
require "../database/database.php";
$student_id = $_SESSION["student_id"];
$id = $_GET['id'];
$fixture_details = mysqli_query($database, "SELECT * FROM fixtures WHERE id = '$id'");
$res = mysqli_fetch_array($fixture_details);
$query = mysqli_query($database, "SELECT * FROM fixture_team LEFT JOIN students ON fixture_team.student_id = students.student_id WHERE fixture_team.fixture_id = '$id' ORDER BY students.full_name ASC");
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
        RGU:TEAMS - Welcome <?php echo $_SESSION['student_name']; ?>
    </header>
    <?php include 'nav.php';?>
    <main>
        <h3> 
            Final Team Selection for match against <b><?php echo $res['away'] ?></b> in <b><?php echo $res['location'];?></b> on <b><?php echo $res['game_date'];?></b> 
        </h3>   
        <hr>
        <table>
            <tr>
                <th width="10%"> Picture </th>
                <th width="70%"> Name </th>              
            </tr>
            <?php $i = 0; while($row = mysqli_fetch_array($query)){?>
                <tr valign="top">                
                    <td valign="top"><img src="../uploads/students/<?php echo $row['image']; ?>" style="width: 100%;"></td>
                    <td valign="top"><?php echo $row['full_name']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <hr>
        <div style='width: 400px'>
        <h6> Submit Swap Request </h6> <hr>
            <form action='operations/swap-request.php' method='post'>
                <textarea name="message" required></textarea> <br>
                <input type="hidden" value="<?php echo $id; ?>" name="fixture_id">
                <input type="submit" name="submit" value="SUBMIT">
            </form>
        </div>
    </main>
    <footer>
        <b>Copyright 2020 RGU:Teams</b>
    </footer>
</body>
</html>