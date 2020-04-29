<?php
session_start();
require "../../database/database.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['fail'] = 'Invalid email address';
            header("location: ../signup.php");
            die();
        }

        if (strlen($_POST["student_id"]) < 7) {
            $_SESSION['fail'] = 'Student ID is too short, must be to 7 characters';
            header("location: ../signup.php");
            die();
        }

        if (strlen($_POST["password"]) < 8) {
            $_SESSION['fail'] = 'Password too short, must be at least 8 characters';
            header("location: ../signup.php");
            die();
        }

        if ($_POST["password"] !== $_POST["confirm"]) {
            $_SESSION['fail'] = 'Passwords do not match';
            header("location: ../signup.php");
            die();
        }

    
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){           
           $_SESSION['fail'] = 'extension not allowed, please choose a JPEG or PNG file.';
           header("location: ../signup.php");
           die();
        }
        
        if($file_size > 2097152){           
           $_SESSION['fail'] = 'File size must be less than 2 MB';
           header("location: ../signup.php");
           die();           
        }
        
        

        $student_id = $_POST['student_id'];
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $password = sha1($_POST['password']);

        $check = "SELECT * FROM students where student_id = '$student_id' OR email = '$email'";
        $query_u = mysqli_query($database, $check);
        $numrow = mysqli_num_rows($query_u);

        if ($numrow > 0) { 
            $_SESSION['error'] = 'Sorry, student already exists';
            header("location: ../signup.php");
            die();
        }

        move_uploaded_file($file_tmp,"../../uploads/students/".$file_name);

        $sql = "INSERT INTO students (student_id, full_name, email, password, image) VALUES ('$student_id', '$full_name', '$email', '$password', '$file_name')";
        $query = mysqli_query($database, $sql);
        $_SESSION['success'] = 'Registration successful. Please login below';    
        header("location: ../index.php");
    }
?>
