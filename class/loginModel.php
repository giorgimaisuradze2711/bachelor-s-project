<?php
class Login extends Database {
    protected function getUser($email, $password) {

        $stmt = $this->connect()->prepare("SELECT password FROM users WHERE email = ?;");

        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location: /page/login.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: /page/login.php?error=emailnotfound");
            exit();
        }

        $hashedPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $chechkPassword = password_verify($password, $hashedPassword[0]["password"]);

        if($chechkPassword == false) {
            $stmt = null;
            header("location: /page/login.php?error=wrongpassword");
            exit();
        } elseif ($chechkPassword == true) {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ? AND password = ?;");
            if(!$stmt->execute(array($email, $hashedPassword[0]["password"]))) {
                $stmt = null;
                header("location: /page/login.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: /page/login.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["user_id"] = $user[0]["user_id"];

            if(!file_exists("../user/".$_SESSION["user_id"])){
                mkdir("../user/".$_SESSION["user_id"], 0777, true);
            }

            if(!file_exists("../user/".$_SESSION["user_id"]."/post")){
                mkdir("../user/".$_SESSION["user_id"]."/post", 0777, true);
            }

            if(!file_exists("../user/".$_SESSION["user_id"]."/profileImage.png")){
                $mainImage = imagecreatefrompng("../images/profileImageBackgrounds/".rand(1,5).".png");
                $mergeImage = imagecreatefrompng("../images/profileImages/".rand(1,12).".png");

                $mergeWidth = imagesx($mergeImage);
                $mergeHeight = imagesy($mergeImage);

                $mainWidth = imagesx($mainImage);
                $mainHeight = imagesy($mainImage);

                $mergeX = ($mainWidth - $mergeWidth) / 2;
                $mergeY = ($mainHeight - $mergeHeight) / 2;
                
                imagecopymerge($mainImage, $mergeImage, $mergeX, $mergeY, 0, 0, $mergeWidth, $mergeHeight,50);
                imagepng($mainImage,"../user/".$_SESSION["user_id"]."/profileImage.png",0);
            }

            if(!file_exists("../user/".$_SESSION["user_id"]."/profileBanner.png")){
                copy("../images/profileBanners/".rand(1,8).".png","../user/".$_SESSION["user_id"]."/profileBanner.png");
            }

            header("location: /page/profile.php?user_id=".$user[0]["user_id"]);
            $stmt = null;
        }
        $stmt = null;
    }
}