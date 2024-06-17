<?php 
class UserView extends UserModel{
        public function fetchUser($userID){
            $user = $this->getUser($userID);
            return $user;
        }

        public function checkUser($userID){
            if($this->userDoesntExists($userID)){
                header("location: ../profile.php?error=UserDoesntExsist");
                exit(); 
            }
        }
    }