<?php
class Signup extends Database {
    protected function setUser($username, $password, $email){
        $stmt = $this->connect()->prepare("INSERT INTO users (username, password, email) VALUE (?, ?, ?);");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($username, $hashedPassword, $email))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    }

    protected function checkUser($username){
        $stmt = $this->connect()->prepare("SELECT username FROM users WHERE username = ?");

        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $resultCheck = null;

        if($stmt->rowCount() > 0){
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
        
    }

    protected function checkEmail($email){

        $stmt = $this->connect()->prepare("SELECT username FROM users WHERE email = ?");

        if(!$stmt->execute(array($email))){

            $stmt = null;

            header("location: ../signup.php?error=stmtfailed");

            exit();

        }

        $resultCheck = null;

        if($stmt->rowCount() > 0){
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}