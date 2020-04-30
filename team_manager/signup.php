<?php session_start();
require '../database/database.php';
$teams = mysqli_query($database, "SELECT * FROM teams WHERE manager_id = 0");
?>
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
            <h4> RGU:TEAMS <br> TEAM MANAGER REGISTER </h4>
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
        <form action="operations/register.php" method="post">
            <div class="form-box">
                <label> Full Name </label>
                <input type="text" required name="full_name">
            </div>         
            <div class="form-box">
                <label>  Manager ID </label>
                <input type="text" required name="manager_id">
            </div>        
            <div class="form-box">
                <label>  Email </label>
                <input type="text" required name="email">
            </div>             
            <div class="form-box">
                <label>  Password </label>
                <input type="password" required name="password">
            </div>
            <div class="form-box">
                <label> Confirm Password </label>
                <input type="password" required name="confirm">
            </div>  
            <div class="form-box">
                <label> Select Team </label>
                <select name="team" required>
                    <option value="" selected> 
                    <?php while($row = mysqli_fetch_array($teams)){?>
                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                    <?php }?>
                </option>
            </div>                      
            <div class="form-box">
                <input type="submit" value="Register" name="submit">
            </div>
        </form>
    </section>
</main>
<footer>
    © All rights reserved • <?php echo date("Y"); ?>
</footer>
</body>
</html>


