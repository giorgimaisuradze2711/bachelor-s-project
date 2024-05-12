<?php

   class UserControl extends UserModel{

        private $newUsername;
        private $newPassword;
        private $password;

        public function __construct($changedData, $password){
            
            $this->changedData = $changedData;
            $this->password = $password;

        }

        public function changeUsername() {
            if($this->emptyInput() == false) {
                header("location: /page/signup.php?error=emptyInput");
                exit();
            }
    
            if($this->invalidUsername() == false) {
                header("location: /page/signup.php?error=invalidUsername");
                exit();
            }
    
            if($this->invalidPwd() == false){
                header("location: /page/signup.php?error=invalidPwd");
                exit();
            }
    
            $this->setUsername($this->changedData, $this->password);
        }

        public function changeEmail() {
            if($this->emptyInput() == false) {
                header("location: /page/signup.php?error=emptyInput");
                exit();
            }
    
            if($this->invalidUsername() == false) {
                header("location: /page/signup.php?error=invalidUsername");
                exit();
            }
    
            if($this->invalidPwd() == false){
                header("location: /page/signup.php?error=invalidPwd");
                exit();
            }
    
            $this->setEmail($this->changedData, $this->password);
        }

        public function changePassword() {
            if($this->emptyInput() == false) {
                header("location: /page/signup.php?error=emptyInput");
                exit();
            }
    
            if($this->invalidUsername() == false) {
                header("location: /page/signup.php?error=invalidUsername");
                exit();
            }
    
            if($this->invalidPwd() == false){
                header("location: /page/signup.php?error=invalidPwd");
                exit();
            }
    
            $this->setPassword($this->newPassword, $this->password);
        }

   } 