<?php

include "./config.php";

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password != $cpassword){
        echo "Passwords do not match.";
        exit();
    }
    $password=password_hash($password,PASSWORD_BCRYPT);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");

    if(mysqli_num_rows($result) > 0){
        echo "User already registered with this email.";
    }
    else{
        $result = mysqli_query($con, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");

        if($result){
            header("Location:")
        }else{
            echo "Something went wrong.";
        }
    }
}
?>