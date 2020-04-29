<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> RGU Sport Teams </title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/reset.css" rel="stylesheet">
    <link href="assets/css/forms.css" rel="stylesheet">
</head>
<body>


<main>
    <section class="form-wrapper">
        <div class="form-box">
            <h4> RGU:TEAMS <br> WELCOME PAGE </h4>
        </div>
        <div style="font-size: 20px !important">
            <div class="form-box">
                <label> <a href="students/index.php">Student Login</a> </label>
            </div>

            <div class="form-box">
                <label> <a href="team_manager/index.php">Team Manager Login</a> </label>
            </div>  
        </div>
    </section>
</main>


<footer>
    © All rights reserved • <?php echo date("Y"); ?>
</footer>
</body>
</html>


