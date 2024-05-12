<?php
if(isset($_POST["SignUp"])){
    include "../class/database.php";
    include "../class/signupModel.php";
    include "../class/signupControl.php";
    
    $username = $_POST["Username"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $repeatPassword = $_POST["RepeatPassword"];

    $signup = new SignupContr($username, $email, $password, $repeatPassword);
    $signup -> signupUser();
    header("location: /page/login.php?error=registeredSuccessfully");
} else {
    header("location: /page/signup.php?error=unauthorized");
}