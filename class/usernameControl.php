<?php
   class UsernameControl extends UserModel{
        private $userID;    
        private $newUsername;
        private $password;
        private $userPassword;

        public function __construct($userID, $newUsername, $password, $userPassword){
            
            $this->userID = $userID;
            $this->newUsername = $newUsername;
            $this->password = $password;
            $this->userPassword = $userPassword;

        }

        public function changeUsername() {
            if($this->emptyInput() == true) {
                header("location: ../page/changeUser.php?error=emptyInput");
                exit();
            }

            if($this->invalidPassword() == true) {
                header("location: ../page/changeUser.php?error=invalidPassword");
                exit();
            }
    
            $this->updateUsername($this->newUsername, $this->userID);
        }

        private function emptyInput() {
            $result = null;
    
            if(empty($this->newUsername)||empty($this->password)){
                $result = true;
            } else {
                $result = false;
            }
    
            return $result;
        }

private function invalidPassword() {
    $result = null;

    if(!password_verify($this->password, $this->userPassword)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
    }