<?php
class SignupContr extends Signup {
    private $username;
    private $email;
    private $password;
    private $repeatPassword;

    public function __construct($username, $email, $password, $repeatPassword) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
    }

    public function signupUser() {
        if($this->emptyInput() == false) {
            header("location: /page/signup.php?error=emptyInput");
            exit();
        }

        if($this->invalidUsername() == false) {
            header("location: /page/signup.php?error=invalidUsername");
            exit();
        }

        if($this->usernameTaken() == false){
            header("location: /page/signup.php?error=usernameTaken");
            exit();
        }

        if($this->emailTaken() == false){
            header("location: /page/signup.php?error=emailTaken");
            exit();
        }

        if($this->invalidPwd() == false){
            header("location: /page/signup.php?error=invalidPwd");
            exit();
        }

        if($this->pwdMatch() == false) {
            header("location: /page/signup.php?error=pwdDontMatch");
            exit();
        }

        $this->setUser($this->username, $this->password, $this->email);
    }

    private function emptyInput() {
        $result = null;

        if(empty($this->username) || empty($this->email) || empty($this->password) || empty($this->repeatPassword)){
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function invalidUsername() {
        $result = null;

        if(!preg_match("/^[a-zA-Z0-9ა-ზ ]*$/", $this->username)){
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function usernameTaken() {
        $result = null;

        if(!$this->checkUser($this->username)){
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function emailTaken() {
        $result = null;

        if(!$this->checkEmail($this->email)){
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function invalidPwd(){
        $result = null;

        if(!preg_match("/^[a-zA-Z0-9!@#$%^&*() ]{8,16}$/", $this->password)){
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function pwdMatch() {
        $result = null;

        if($this->password !== $this->repeatPassword){
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}