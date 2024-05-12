<?php
session_start();
$targetProfileBanner = "../user/".$_SESSION["user_id"]."/profileBanner.png";
$newBanner = $_FILES["profileBanner"];  

if (move_uploaded_file($newBanner["tmp_name"],$targetProfileBanner)) {
    header("location: ../page/profile.php?user_id=".$_SESSION["user_id"]);
}
?>