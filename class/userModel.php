<?php
    class UserModel extends Database{
        protected function getUser($userID){
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE user_id = ?;");

            if(!$stmt->execute(array($userID))){
                $stmt = null;
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }

        protected function updateUsername($username, $userID){
            $stmt = $this->connect()->prepare("UPDATE users SET username = ? WHERE user_id = ?;");

            if(!$stmt->execute(array($username, $userID))){
                $stmt = null;
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }
        }
        
        protected function userDoesntExists($userID){

            $stmt = $this->connect()->prepare("SELECT Username FROM users WHERE UserID = ?;");

            if(!$stmt->execute(array($userID))){

                $stmt = null;
                header("location: ../profile.php?error=stmtfailed");
                exit();

            }

            $result = null;

            if($stmt->rowCount() > 0){

                $result = false;

            } else {

                $result = true;

            }

            return $result;

        }

    }