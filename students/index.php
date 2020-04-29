<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> RGU Sport Teams </title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/reset.css" rel="stylesheet">
    <link href="../assets/css/forms.css" rel="stylesheet">
</head>
<body>

<main>
    <section class="form-wrapper">
        <div class="form-box">
            <h4> RGU:TEAMS <br> STUDENT LOGIN </h4>
        </div>
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
        <form action="operations/login.php" method="post">
            <div class="form-box">
                <label>  Student ID </label>
                <input type="text" required name="student_id">
            </div>        
            <div class="form-box">
                <label>  Password </label>
                <input type="password" required name="password">
            </div>
            <div class="form-box">
                <input type="submit" value="Login" name="submit">
            </div>
            <section>
                <p>
                    <a href="signup.php"> Register here </a> <br>
                    <a href="reset.php"> Forgot Password </a> 
                </p>
            </section>
        </form>
    </section>
</main>
<footer>
    © All rights reserved • <?php echo date("Y"); ?>
</footer>
</body>
</html>


