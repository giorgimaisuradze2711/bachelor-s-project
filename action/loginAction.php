<?php
if(isset($_POST["LogIn"])){
    include "../class/database.php";
    include "../class/loginModel.php";
    include "../class/loginControl.php";
    
    $email = $_POST["Email"];
    $password = $_POST["Password"];

    $login = new LoginContr($email, $password);
    $login->loginUser();

} else {
    header("location: /page/login.php?error=unauthorized");
}