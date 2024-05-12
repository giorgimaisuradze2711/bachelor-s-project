<?php
session_start();
$targetProfileImage = "../user/".$_SESSION["user_id"]."/profileImage.png";
$newImage = $_FILES["profileImage"];

if(move_uploaded_file($newImage["tmp_name"],$targetProfileImage)){
    header("location: ../page/profile.php?user_id=".$_SESSION["user_id"]);
}
?>