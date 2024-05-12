<?php

    session_start();

    include "../class/database.class.php";
    include "../class/changeUsername.class.php";
    include "../class/changeUsername.contr.php";

    if(isset($_POST["changeProfileImage"])){

        $targetProfileImage = "../user/".$_SESSION["userId"]."/profileImage.pngg";
    
        $newImage = $_FILES["profileImage"];

        if(move_uploaded_file($newImage["tmp_name"],$targetProfileImage)){

        }

    }

    if(isset($_POST["changeUsername"])){

        $username = $_SESSION["username"];
        $newUsername = $_POST["newUsername"];
        $userId = $_SESSION["userid"];

        $changeUsername = new changeUserInfo($newUsername,$userId,$username);
        $changeUsername->changeUsername();

    }

    header("location: ../profile.php");