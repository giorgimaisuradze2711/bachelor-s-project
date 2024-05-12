<?php
if(isset($_POST["ChangeUsername"])){
    include "../class/database.php";
    include "../class/userModel.php";
    include "../class/usernameControl.php";
    include "../class/userView.php";

    session_start();
    $userID = $_SESSION["user_id"];
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    $userView = new UserView();
    $user = $userView->fetchUser($userID);
    $userPassword = $user[0]["password"];

    $username = new UsernameControl($username, $userID, $password, $userPassword);
    $username -> changeUsername();
}
header("location: ../page/profile.php?user_id=".$_SESSION["user_id"]);