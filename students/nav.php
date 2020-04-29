<nav>
    <ul>
        <li> <a href="home.php"> Home </a> </li>
        <li> <a href="teams.php"> Teams </a> </li>
        <li> <a href="invites.php"> Invites </a> </li>
        <li> <a href="logout.php"> Logout </a> </li>
    </ul>
</nav>

<?php if (isset($_SESSION['success'])) { ?>
    <div class="status_message">
        <div class="success">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    </div>
<?php } ?>

<?php if (isset($_SESSION['fail'])) { ?>
    <div class="status_message">
        <div class="error">
            <?php echo $_SESSION['fail'];
            unset($_SESSION['fail']); ?>
        </div>
    </div>
<?php } ?>