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
                copy("../images/profileImages/".rand(1,12).".png","../user/".$_SESSION["user_id"]."/profileImage.png");
            }

            if(!file_exists("../user/".$_SESSION["user_id"]."/profileImageBackground.png")){
                copy("../images/profileImageBackgrounds/".rand(1,5).".png","../user/".$_SESSION["user_id"]."/profileImageBackground.png");
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